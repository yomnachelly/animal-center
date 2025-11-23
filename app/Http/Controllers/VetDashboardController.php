<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Soin;
use App\Models\Vaccin;
use App\Models\RendezVous;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VetDashboardController extends Controller
{
    public function index()
    {
        $vetId = Auth::id();
        
        // Compter les soins du vétérinaire connecté
        $soinsCount = Soin::where('vet_id', $vetId)->count();
        
        // Compter les vaccins du vétérinaire connecté
        $vaccinsCount = Vaccin::where('vet_id', $vetId)->count();
        
        // Rendez-vous d'aujourd'hui avec les soins de ce vétérinaire
        $rdvSoinsCount = RendezVous::whereHas('soins', function($query) use ($vetId) {
                $query->where('vet_id', $vetId);
            })
            ->whereDate('date', today())
            ->count();
            
        // Rendez-vous d'aujourd'hui avec les vaccins de ce vétérinaire
        $rdvVaccinsCount = RendezVous::whereHas('vaccins', function($query) use ($vetId) {
                $query->where('vet_id', $vetId);
            })
            ->whereDate('date', today())
            ->count();
            
        $rdvCount = $rdvSoinsCount + $rdvVaccinsCount;
            
        // Estimation des dossiers médicaux
        $dossiersCount = $soinsCount + $vaccinsCount;
        
        // Récupérer les soins récents
        $soinsRecents = Soin::where('vet_id', $vetId)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
            
        // Récupérer les vaccins récents
        $vaccinsRecents = Vaccin::where('vet_id', $vetId)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('vet.dashboard', compact(
            'soinsCount',
            'vaccinsCount',
            'rdvCount',
            'dossiersCount',
            'soinsRecents',
            'vaccinsRecents'
        ));
    }
}