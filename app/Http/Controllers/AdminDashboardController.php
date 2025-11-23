<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Espece;
use App\Models\Animal;
use App\Models\Race;
use App\Models\User;
use App\Models\Demande;
use App\Models\RendezVous;
use App\Models\Avis;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Statistiques principales
        $stats = [
            // Espèces, animaux et races
            'especes_count' => Espece::count(),
            'animaux_count' => Animal::count(),
            'animaux_adoptables' => Animal::where('statut', 'adopter')->count(),
            'races_count' => Race::count(),
            
            // Utilisateurs
            'users_actifs' => User::where('verrouiller', 0)->count(),
            'users_total' => User::count(),
            'users_vet' => User::where('role', 'vet')->where('verrouiller', 0)->count(),
            'users_clients' => User::where('role', 'client')->where('verrouiller', 0)->count(),
            
            // Demandes
            'demandes_total' => Demande::count(),
            'demandes_attente' => Demande::where('etat', 'en attente')->count(),
            'demandes_acceptees' => Demande::where('etat', 'accepte')->count(),
            'demandes_refusees' => Demande::where('etat', 'rejete')->count(),
            
            // Rendez-vous
            'rdv_total' => RendezVous::count(),
            'rdv_attente' => RendezVous::where('etat', 'en attente')->count(),
            'rdv_acceptes' => RendezVous::where('etat', 'accepté')->count(),
            'rdv_refuses' => RendezVous::where('etat', 'refuse')->count(),
            
            // Avis
            'avis_count' => Avis::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}