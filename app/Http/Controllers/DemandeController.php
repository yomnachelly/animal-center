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
// Accepter une demande et mettre à jour le statut de l'animal
// Accepter une demande et mettre à jour le statut de l'animal selon le type
public function accepter($id)
{
    $demande = Demande::with('animal')->findOrFail($id);

    // Déterminer le type de demande
    $type = "demande";
    $details = null;

    if (Adoption::where('demande_id', $id)->exists()) {
        $type = "adoption";
    } elseif (Hebergement::where('demande_id', $id)->exists()) {
        $type = "hebergement";
    }

    // Mettre à jour la demande
    $demande->etat = 'accepte';
    $demande->save();

    // Mettre à jour le statut de l'animal selon le type de demande
    if ($type === "adoption") {
        $demande->animal->statut = 'adopté';
    } elseif ($type === "hebergement") {
        $demande->animal->statut = 'heberger';
    }
    
    $demande->animal->save();

    // Créer la notification
    NotificationApp::create([
        'id_destinataire' => $demande->user_id,
        'id_expediteur'   => Auth::id(),
        'contenu'         => "Votre demande pour l'animal '{$demande->animal->nom}' a été acceptée.",
        'date'            => now(),
    ]);

    return back()->with('success', 'Demande acceptée et notification envoyée.');
}

// Rejeter une demande et vérifier si le statut de l'animal doit changer
public function rejeter($id)
{
    $demande = Demande::with('animal')->findOrFail($id);

    $demande->etat = 'rejete';
    $demande->save();

    // Vérifier si l'animal n'a pas d'autre demande acceptée
    $autresDemandesAcceptees = Demande::where('animal_id', $demande->animal_id)
                                      ->where('etat', 'accepte')
                                      ->exists();

    if (!$autresDemandesAcceptees) {
        $demande->animal->statut = 'disponible'; // remettre l'animal disponible
        $demande->animal->save();
    }

    // Créer la notification
    NotificationApp::create([
        'id_destinataire' => $demande->user_id,
        'id_expediteur'   => Auth::id(),
        'contenu'         => "Votre demande pour l'animal '{$demande->animal->nom}' a été rejetée.",
        'date'            => now(),
    ]);

    return back()->with('success', 'Demande rejetée et notification envoyée.');
}

    // Dans app/Models/Demande.php

// Scope pour les demandes de l'utilisateur connecté
public function scopeMesDemandes($query)
{
    return $query->where('user_id', auth()->id());
}

// Accessor pour le statut formaté
public function getStatutFormateAttribute()
{
    $statuts = [
        'en attente' => ['class' => 'warning', 'icon' => 'clock'],
        'approuvé' => ['class' => 'success', 'icon' => 'check-circle'],
        'refusé' => ['class' => 'danger', 'icon' => 'times-circle']
    ];

    return $statuts[$this->etat] ?? ['class' => 'secondary', 'icon' => 'question-circle'];
}
}
