<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hebergement;
use App\Models\Paiement;
use App\Models\User;
use PDF;

class FactureController extends Controller
{
    public function generer(Hebergement $hebergement)
    {
        // Récupérer les données de l'hébergement
        $dateDebut = $hebergement->date_debut;
        $dateFin = $hebergement->date_fin;

        // Calculer le nombre de jours
        $diff = (strtotime($dateFin) - strtotime($dateDebut)) / (60*60*24) + 1;

        // Récupérer le tarif par jour depuis la table paiement
        $paiement = Paiement::first(); // ou une autre logique pour récupérer le bon enregistrement
        $fraisParJour = $paiement->frais_jour;

        // Calculer le total
        $total = $diff * $fraisParJour;

        // Récupérer le nom du client depuis la table users
        // Supposons que l'hébergement a un champ user_id ou client_id
        $client = User::find($hebergement->user_id); // Adaptez selon votre structure

        // Si vous n'avez pas de relation directe, vous devrez peut-être passer par d'autres tables
        // Par exemple, si l'hébergement est lié à un animal qui est lié à un user
        if (!$client && $hebergement->animal) {
            $client = User::find($hebergement->animal->user_id);
        }

        // Passer les données à la vue PDF
        $data = [
            'hebergement' => $hebergement,
            'jours' => $diff,
            'frais_par_jour' => $fraisParJour,
            'total' => $total,
            'client' => $client // On passe l'objet client complet
        ];

        $pdf = PDF::loadView('facture.pdf', $data);
        return $pdf->download('facture_hebergement_' . $hebergement->id . '.pdf');
    }
}