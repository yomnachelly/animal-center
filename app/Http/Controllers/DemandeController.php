<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Demande;
use App\Models\Adoption;
use App\Models\Hebergement;
use App\Models\NotificationApp;

class DemandeController extends Controller
{
    // Affichage de toutes les demandes
    public function index()
    {
        $demandes = Demande::with(['user', 'animal'])->get();

        foreach ($demandes as $demande) {
            if (Adoption::where('demande_id', $demande->id)->exists()) {
                $demande->type = "adoption";
            } elseif (Hebergement::where('demande_id', $demande->id)->exists()) {
                $demande->type = "hebergement";
            } else {
                $demande->type = "demande";
            }
        }

        return view('admin.demandes.index', compact('demandes'));
    }

    // Voir les détails d'une demande
    public function details($id)
    {
        $demande = Demande::with(['user', 'animal'])->findOrFail($id);

        $type = "demande";
        $details = null;

        if ($details = Adoption::where('demande_id', $id)->first()) {
            $type = "adoption";
        } elseif ($details = Hebergement::where('demande_id', $id)->first()) {
            $type = "hebergement";
        }

        return view('admin.demandes.details', compact('demande', 'details', 'type'));
    }

    // Accepter une demande et envoyer une notification
    public function accepter($id)
    {
        $demande = Demande::with('animal')->findOrFail($id);
        $demande->etat = 'accepte';
        $demande->save();

        // Créer la notification
        NotificationApp::create([
            'id_destinataire' => $demande->user_id,  // destinataire = utilisateur de la demande
            'id_expediteur'   => Auth::id(),         // expéditeur = admin connecté
            'contenu'         => "Votre demande pour l'animal '{$demande->animal->nom}' a été acceptée.",
            'date'            => now(),
        ]);

        return back()->with('success', 'Demande acceptée et notification envoyée.');
    }

    // Rejeter une demande et envoyer une notification
    public function rejeter($id)
    {
        $demande = Demande::with('animal')->findOrFail($id);
        $demande->etat = 'rejete';
        $demande->save();

        // Créer la notification
        NotificationApp::create([
            'id_destinataire' => $demande->user_id,
            'id_expediteur'   => Auth::id(),
            'contenu'         => "Votre demande pour l'animal '{$demande->animal->nom}' a été rejetée.",
            'date'            => now(),
        ]);

        return back()->with('success', 'Demande rejetée et notification envoyée.');
    }
}
