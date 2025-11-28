<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Hebergement;
use App\Models\Paiement;
use Carbon\Carbon;

class StripeController extends Controller
{
    public function payer($id)
    {
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
        $paiement = Paiement::first();
        if (!$paiement) {
            return back()->with('error', "Aucun frais journalier trouvé.");
        }

        $fraisJour = $paiement->frais_jour;

        // Calcul du nombre de jours exactement comme pour le PDF
        $dateDebut = strtotime($hebergement->date_debut);
        $dateFin = strtotime($hebergement->date_fin);
        $jours = ($dateFin - $dateDebut) / (60 * 60 * 24) + 1;

        if ($jours <= 0) {
            return back()->with('error', "Les dates d'hébergement sont invalides.");
        }

        // Calcul total
        $montant = $jours * $fraisJour;      // ex: 5 jours × 30 dt = 150 dt
        $montantStripe = $montant * 100;     // Stripe → centimes

        // Clé API Stripe
        Stripe::setApiKey(config('services.stripe.secret'));

        // Créer la session Stripe
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',   // ou 'eur'
                    'product_data' => [
                        'name' => 'Paiement Hébergement de : ' . $hebergement->animal->nom,
                    ],
                    'unit_amount' => $montantStripe,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('stripe.cancel'),
        ]);

        return redirect($session->url);
    }

    public function success(Request $request)
    {
        return view('paiement.success');
    }

    public function cancel()
    {
        return view('paiement.cancel');
    }
}
