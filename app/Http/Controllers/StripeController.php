<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe as StripeSDK;
use Stripe\Checkout\Session;
use Stripe\PaymentIntent;
use App\Models\Hebergement;
use App\Models\Paiement;
use App\Models\Stripe as StripeModel;
use Carbon\Carbon;

class StripeController extends Controller
{
    public function payer($id)
    {
        try {
            // Charger l'hébergement + relations
            $hebergement = Hebergement::with('demande', 'animal')->findOrFail($id);

            // Vérifier si la demande est acceptée
            if (!$hebergement->demande || $hebergement->demande->etat !== 'accepte') {
                return back()->with('error', "La demande n'est pas encore acceptée.");
            }

            // Vérifier que la date fin existe
            if (!$hebergement->date_fin) {
                return back()->with('error', "La date de fin n'est pas définie.");
            }

            // Récupérer frais fixe depuis table Paiement
            $paiementConfig = Paiement::first();
            if (!$paiementConfig) {
                return back()->with('error', "Aucun frais journalier trouvé.");
            }

            $fraisJour = $paiementConfig->frais_jour;

            // Calcul du nombre de jours
            $dateDebut = Carbon::parse($hebergement->date_debut);
            $dateFin = Carbon::parse($hebergement->date_fin);
            $jours = $dateDebut->diffInDays($dateFin) + 1;

            if ($jours <= 0) {
                return back()->with('error', "Les dates d'hébergement sont invalides.");
            }

            // Calcul total en DT
            $montantDT = $jours * $fraisJour;
            
            // Conversion DT → USD pour Stripe
            $tauxChange = config('services.stripe.usd_rate', 0.32);
            $montantUSD = $montantDT * $tauxChange;
            $montantUSD = round($montantUSD, 2);
            $montantStripe = (int)($montantUSD * 100);

            // Clé API Stripe
            StripeSDK::setApiKey(config('services.stripe.secret'));

            // Créer la session Stripe
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Paiement Hébergement de : ' . $hebergement->animal->nom,
                            'description' => "{$jours} jours × {$fraisJour} DT/jour = {$montantDT} DT",
                        ],
                        'unit_amount' => $montantStripe,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('stripe.cancel'),
                'metadata' => [
                    'hebergement_id' => $id,
                    'montant_dt' => $montantDT,
                    'jours' => $jours,
                    'frais_jour' => $fraisJour,
                ]
            ]);

            // Debug: Log les données avant insertion
            Log::info('Tentative d\'insertion Stripe:', [
                'hebergement_id' => $id,
                'stripe_session_id' => $session->id,
                'montant_dt' => $montantDT,
                'montant_usd' => $montantUSD,
                'taux_change' => $tauxChange,
                'nombre_jours' => $jours,
                'frais_jour' => $fraisJour,
            ]);

            // Enregistrer le paiement en base de données dans la table stripe
            $stripeRecord = StripeModel::create([
                'hebergement_id' => $id,
                'stripe_session_id' => $session->id,
                'montant_dt' => $montantDT,
                'montant_usd' => $montantUSD,
                'taux_change' => $tauxChange,
                'nombre_jours' => $jours,
                'frais_jour' => $fraisJour,
                'statut' => 'pending',
            ]);

            Log::info('Insertion Stripe réussie:', ['id' => $stripeRecord->id]);

            return redirect($session->url);

        } catch (\Exception $e) {
            Log::error('Erreur lors du paiement Stripe:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'hebergement_id' => $id
            ]);
            return back()->with('error', 'Erreur lors de la création du paiement: ' . $e->getMessage());
        }
    }

    public function success(Request $request)
    {
        $sessionId = $request->get('session_id');
        
        if (!$sessionId) {
            return redirect()->route('stripe.cancel')->with('error', 'Session ID manquant.');
        }

        StripeSDK::setApiKey(config('services.stripe.secret'));
        
        try {
            $session = Session::retrieve($sessionId);
            $paymentIntent = PaymentIntent::retrieve($session->payment_intent);

            // Mettre à jour le paiement dans la base de données
            $stripe = StripeModel::where('stripe_session_id', $sessionId)->first();
            
            if (!$stripe) {
                Log::error('Session Stripe non trouvée en base:', ['session_id' => $sessionId]);
                return view('paiement.success')->with('error', 'Paiement non trouvé en base de données.');
            }

            $stripe->update([
                'statut' => 'completed',
                'stripe_payment_intent_id' => $session->payment_intent,
                'stripe_customer_id' => $session->customer,
                'customer_email' => $session->customer_details->email ?? null,
                'paid_at' => now(),
                'metadata' => json_encode($session->metadata)
            ]);

            // Marquer l'hébergement comme payé si nécessaire
            $hebergement = Hebergement::find($stripe->hebergement_id);
            if ($hebergement) {
                $hebergement->update(['statut_paiement' => 'payé']);
                Log::info('Hébergement marqué comme payé:', ['hebergement_id' => $hebergement->id]);
            }

            return view('paiement.success', [
                'stripe' => $stripe,
                'session' => $session
            ]);

        } catch (\Exception $e) {
            Log::error('Erreur dans success Stripe:', [
                'error' => $e->getMessage(),
                'session_id' => $sessionId
            ]);
            return view('paiement.success')->with('error', 'Erreur lors de la confirmation du paiement: ' . $e->getMessage());
        }
    }

    public function cancel()
    {
        return view('paiement.cancel');
    }

    // Webhook pour mettre à jour les statuts
    public function webhook(Request $request)
    {
        StripeSDK::setApiKey(config('services.stripe.secret'));
        
        $payload = $request->getContent();
        $sig_header = $request->header('Stripe-Signature');
        $endpoint_secret = config('services.stripe.webhook_secret');

        if (!$endpoint_secret) {
            Log::error('Webhook secret non configuré');
            return response()->json(['error' => 'Webhook non configuré'], 400);
        }

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            Log::error('Payload Stripe webhook invalide:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Payload invalide'], 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            Log::error('Signature Stripe webhook invalide:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Signature invalide'], 400);
        } catch (\Exception $e) {
            Log::error('Erreur webhook Stripe:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Erreur de traitement'], 400);
        }

        Log::info('Webhook Stripe reçu:', ['type' => $event->type]);

        switch ($event->type) {
            case 'checkout.session.completed':
                $session = $event->data->object;
                $this->handleCheckoutSessionCompleted($session);
                break;
                
            case 'payment_intent.succeeded':
                $paymentIntent = $event->data->object;
                $this->handlePaymentSucceeded($paymentIntent);
                break;
                
            case 'payment_intent.payment_failed':
                $paymentIntent = $event->data->object;
                $this->handlePaymentFailed($paymentIntent);
                break;
        }

        return response()->json(['status' => 'success']);
    }

    private function handleCheckoutSessionCompleted($session)
    {
        try {
            $stripe = StripeModel::where('stripe_session_id', $session->id)->first();
            
            if ($stripe) {
                $stripe->update([
                    'statut' => 'completed',
                    'stripe_payment_intent_id' => $session->payment_intent,
                    'stripe_customer_id' => $session->customer,
                    'customer_email' => $session->customer_details->email ?? null,
                    'paid_at' => now(),
                    'metadata' => json_encode($session->metadata)
                ]);

                // Marquer l'hébergement comme payé
                $hebergement = Hebergement::find($stripe->hebergement_id);
                if ($hebergement) {
                    $hebergement->update(['statut_paiement' => 'payé']);
                }

                Log::info('Webhook: Paiement complété via checkout.session.completed', [
                    'stripe_id' => $stripe->id,
                    'hebergement_id' => $stripe->hebergement_id
                ]);
            } else {
                Log::warning('Webhook: Session Stripe non trouvée en base', ['session_id' => $session->id]);
            }
        } catch (\Exception $e) {
            Log::error('Erreur dans handleCheckoutSessionCompleted:', ['error' => $e->getMessage()]);
        }
    }

    private function handlePaymentSucceeded($paymentIntent)
    {
        try {
            $stripe = StripeModel::where('stripe_payment_intent_id', $paymentIntent->id)->first();
            
            if ($stripe) {
                $stripe->update([
                    'statut' => 'completed',
                    'paid_at' => now()
                ]);

                Log::info('Webhook: Paiement réussi via payment_intent.succeeded', [
                    'stripe_id' => $stripe->id,
                    'payment_intent_id' => $paymentIntent->id
                ]);
            } else {
                Log::warning('Webhook: PaymentIntent non trouvé en base', ['payment_intent_id' => $paymentIntent->id]);
            }
        } catch (\Exception $e) {
            Log::error('Erreur dans handlePaymentSucceeded:', ['error' => $e->getMessage()]);
        }
    }

    private function handlePaymentFailed($paymentIntent)
    {
        try {
            $stripe = StripeModel::where('stripe_payment_intent_id', $paymentIntent->id)->first();
            
            if ($stripe) {
                $stripe->update([
                    'statut' => 'failed'
                ]);

                Log::info('Webhook: Paiement échoué via payment_intent.payment_failed', [
                    'stripe_id' => $stripe->id,
                    'payment_intent_id' => $paymentIntent->id
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Erreur dans handlePaymentFailed:', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Méthode de test pour vérifier l'insertion en base
     */
    public function testInsertion()
    {
        try {
            $test = StripeModel::create([
                'hebergement_id' => 1, // Remplacez par un ID existant
                'stripe_session_id' => 'test_' . uniqid(),
                'montant_dt' => 100.00,
                'montant_usd' => 32.00,
                'taux_change' => 0.32,
                'nombre_jours' => 5,
                'frais_jour' => 20.00,
                'statut' => 'pending',
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Insertion test réussie',
                'data' => $test
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur d\'insertion: ' . $e->getMessage()
            ], 500);
        }
    }
    public function indexAdmin()
    {
        // Récupérer tous les paiements Stripe avec leurs relations
        $paiements = StripeModel::with('hebergement.animal', 'hebergement.demande.user')
                          ->orderBy('created_at', 'desc')
                          ->paginate(15);

        // Statistiques des paiements
        $stats = [
            'total' => StripeModel::count(),
            'completed' => StripeModel::where('statut', 'completed')->count(),
            'pending' => StripeModel::where('statut', 'pending')->count(),
            'failed' => StripeModel::where('statut', 'failed')->count(),
            'total_amount' => StripeModel::where('statut', 'completed')->sum('montant_dt'),
            'total_usd' => StripeModel::where('statut', 'completed')->sum('montant_usd'),
        ];

        return view('admin.paiements.index', compact('paiements', 'stats'));
    }
   public function showAdmin($id)
    {
        $paiement = StripeModel::with('hebergement.animal', 'hebergement.demande.user')->findOrFail($id);
        
        return view('admin.paiements.show', compact('paiement'));
    }

    /**
     * Afficher le formulaire de modification des frais
     */
    public function editFrais()
    {
        $frais = Paiement::first();
        
        if (!$frais) {
            // Créer des frais par défaut si aucun n'existe
            $frais = Paiement::create([
                'frais_jour' => 30.00,
                'description' => 'Frais journalier d\'hébergement'
            ]);
        }

        return view('admin.paiements.frais', compact('frais'));
    }

    /**
     * Mettre à jour les frais journaliers
     */
    public function updateFrais(Request $request)
    {
        $request->validate([
            'frais_jour' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:255'
        ]);

        $frais = Paiement::first();
        
        if (!$frais) {
            $frais = new Paiement();
        }

        $frais->update([
            'frais_jour' => $request->frais_jour,
            'description' => $request->description
        ]);

        return redirect()->route('admin.historiques.index')
                         ->with('success', 'Frais journalier mis à jour avec succès!');
    }

      public function historiques()
    {
        // Récupérer tous les paiements Stripe avec leurs relations
        $paiements = StripeModel::with('hebergement.animal', 'hebergement.demande.user')
                          ->orderBy('created_at', 'desc')
                          ->paginate(15);

        // Statistiques des paiements
        $stats = [
            'total' => StripeModel::count(),
            'completed' => StripeModel::where('statut', 'completed')->count(),
            'pending' => StripeModel::where('statut', 'pending')->count(),
            'failed' => StripeModel::where('statut', 'failed')->count(),
            'total_amount' => StripeModel::where('statut', 'completed')->sum('montant_dt'),
            'total_usd' => StripeModel::where('statut', 'completed')->sum('montant_usd'),
            'revenus_mois' => StripeModel::where('statut', 'completed')
                                   ->whereMonth('created_at', now()->month)
                                   ->sum('montant_dt'),
        ];

        return view('admin.historiques.index', compact('paiements', 'stats'));
    }

    /**
     * Afficher les détails d'un paiement
     */
    public function showHistorique($id)
    {
        $paiement = StripeModel::with('hebergement.animal', 'hebergement.demande.user')->findOrFail($id);
        
        return view('admin.historiques.show', compact('paiement'));
    }

    /**
     * Rechercher dans les historiques
     */
    public function searchHistoriques(Request $request)
    {
        $query = StripeModel::with('hebergement.animal', 'hebergement.demande.user');

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('stripe_session_id', 'like', "%{$search}%")
                  ->orWhere('stripe_payment_intent_id', 'like', "%{$search}%")
                  ->orWhere('customer_email', 'like', "%{$search}%")
                  ->orWhereHas('hebergement.animal', function($q) use ($search) {
                      $q->where('nom', 'like', "%{$search}%");
                  })
                  ->orWhereHas('hebergement.demande.user', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->has('statut') && $request->statut) {
            $query->where('statut', $request->statut);
        }

        if ($request->has('date_debut') && $request->date_debut) {
            $query->whereDate('created_at', '>=', $request->date_debut);
        }

        if ($request->has('date_fin') && $request->date_fin) {
            $query->whereDate('created_at', '<=', $request->date_fin);
        }

        $paiements = $query->orderBy('created_at', 'desc')->paginate(15);

        // Recalculer les stats pour les résultats filtrés
        $stats = [
            'total' => $paiements->total(),
            'completed' => $query->clone()->where('statut', 'completed')->count(),
            'pending' => $query->clone()->where('statut', 'pending')->count(),
            'failed' => $query->clone()->where('statut', 'failed')->count(),
            'total_amount' => $query->clone()->where('statut', 'completed')->sum('montant_dt'),
        ];

        return view('admin.historiques.index', compact('paiements', 'stats'));
    }

    /**
     * Exporter les historiques en CSV
     */
    /**
 * Exporter les historiques en CSV
 */
/**
 * Exporter les historiques en CSV - Version simplifiée
 */
public function exportHistoriques()
{
    try {
        $paiements = StripeModel::with([
            'hebergement.animal', 
            'hebergement.demande.user'
        ])->orderBy('created_at', 'desc')->get();

        // Créer le contenu CSV manuellement
        $csvContent = "\xEF\xBB\xBF"; // BOM UTF-8
        
        // En-tête
        $csvContent .= "ID;Date;Animal;Client;Email;Montant DT;Montant USD;Taux Change;Jours;Frais/Jour;Statut;Session Stripe;Payment Intent\n";
        
        // Données
        foreach ($paiements as $paiement) {
            $animalNom = 'N/A';
            $clientNom = 'N/A';
            $clientEmail = $paiement->customer_email ?? 'N/A';

            if ($paiement->hebergement && $paiement->hebergement->animal) {
                $animalNom = $paiement->hebergement->animal->nom;
            }

            if ($paiement->hebergement && $paiement->hebergement->demande && $paiement->hebergement->demande->user) {
                $clientNom = $paiement->hebergement->demande->user->name;
                $clientEmail = $paiement->hebergement->demande->user->email ?? $clientEmail;
            }

            $csvContent .= implode(';', [
                $paiement->id,
                $paiement->created_at->format('Y-m-d H:i'),
                $animalNom,
                $clientNom,
                $clientEmail,
                number_format($paiement->montant_dt, 2, '.', ''),
                number_format($paiement->montant_usd, 2, '.', ''),
                number_format($paiement->taux_change, 4, '.', ''),
                $paiement->nombre_jours,
                number_format($paiement->frais_jour, 2, '.', ''),
                $paiement->statut,
                $paiement->stripe_session_id,
                $paiement->stripe_payment_intent_id ?? 'N/A'
            ]) . "\n";
        }

        $fileName = 'historique-paiements-' . date('Y-m-d') . '.csv';

        return response($csvContent, 200, [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ]);

    } catch (\Exception $e) {
        Log::error('Erreur lors de l\'export CSV:', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);

        return back()->with('error', 'Erreur lors de l\'export: ' . $e->getMessage());
    }
}
}