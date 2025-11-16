<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demande;
use App\Models\Adoption;
use App\Models\Hebergement;

class DemandeController extends Controller
{
    // Affichage
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

    // Voir détails
    public function details($id)
    {
        $demande = Demande::with(['user', 'animal'])->findOrFail($id);

        $type = "demande";
        $details = null;

        if ($details = Adoption::where('demande_id', $id)->first()) {
            $type = "adoption";
        } 
        elseif ($details = Hebergement::where('demande_id', $id)->first()) {
            $type = "hebergement";
        }

        return view('admin.demandes.details', compact('demande', 'details', 'type'));
    }

    // Accepter
    public function accepter($id)
    {
        $demande = Demande::findOrFail($id);
        $demande->etat = 'accepte';
        $demande->save();

        return back()->with('success', 'Demande acceptée.');
    }

    // Rejeter
    public function rejeter($id)
    {
        $demande = Demande::findOrFail($id);
        $demande->etat = 'rejete';
        $demande->save();

        return back()->with('success', 'Demande rejetée.');
    }
}
