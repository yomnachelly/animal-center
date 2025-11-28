<?php

namespace App\Http\Controllers;

use App\Services\PaymeeService;
use App\Models\Hebergement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PaymeeController extends Controller
{
    protected $paymeeService;

    public function __construct(PaymeeService $paymeeService)
    {
        $this->paymeeService = $paymeeService;
    }

    // CETTE MÉTHODE S'APPELLE "payer" → c'est celle que tu appelles avec le bouton
    public function payer($id)
    {
        try {
            $hebergement = Hebergement::with(['demande', 'animal'])->findOrFail($id);

            // Vérifications
            if (optional($hebergement->demande)->etat !== 'accepte') {
                return back()->with('error', 'La demande n\'est pas encore acceptée.');
            }

            if ($hebergement->est_paye) {
                return back()->with('error', 'Cet hébergement est déjà payé.');
            }

            $user = Auth::user();
            $prix = $hebergement->prix ?? 50.0;
            $orderId = 'HEB_' . $hebergement->id . '_' . time();

            // Appel à Paymee
            $result = $this->paymeeService->createPayment(
                amount: $prix,
                orderId: $orderId,
                firstName: $user->prenom ?? $user->name ?? 'Client',
                lastName: $user->nom ?? '',
                email: $user->email ?? 'client@exemple.tn',
                phone: $user->telephone ?? '+21600000000'
            );

            if ($result['success'] && !empty($result['payment_url'])) {
                // On sauvegarde en session pour le webhook
                session([
                    'payment_order_id' => $orderId,
                    'hebergement_id'   => $hebergement->id,
                    'payment_token'    => $result['data']['data']['token'] ?? null,
                ]);

                return redirect()->away($result['payment_url']);
            }

            return back()->with('error', 'Erreur Paymee : ' . ($result['error'] ?? 'Inconnue'));

        } catch (\Exception $e) {
            Log::error('Erreur PaymeeController@payer : ' . $e->getMessage());
            return back()->with('error', 'Une erreur est survenue.');
        }
    }

    // Page de retour après paiement réussi
    public function success()
    {
        return view('paiement.success'); // tu peux créer cette vue ou juste afficher un message
    }

    // Page si l'utilisateur annule
    public function cancel()
    {
        return view('paiement.cancel');
    }

    // Webhook appelé automatiquement par Paymee (LE PLUS IMPORTANT)
    public function webhook(Request $request)
    {
        $payload = $request->json()->all();
        Log::info('Webhook Paymee reçu', $payload);

        if (isset($payload['data']['payment_status']) && $payload['data']['payment_status'] === 'paid') {
            $orderId = $payload['data']['order_id'] ?? null;

            if ($orderId && str_starts_with($orderId, 'HEB_')) {
                $hebergementId = explode('_', $orderId)[1] ?? null;

                $hebergement = Hebergement::find($hebergementId);
                if ($hebergement && !$hebergement->est_paye) {
                    $hebergement->est_paye = true;
                    $hebergement->paye_le = now();
                    $hebergement->save();

                    Log::info("Hébergement {$hebergement->id} marqué comme payé via webhook");
                }
            }
        }

        return response('OK', 200);
    }
}