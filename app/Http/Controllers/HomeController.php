<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use App\Models\Animal;

class HomeController extends Controller
{
    public function index()
    {
        // Récupérer les animaux disponibles (statut = 'adopter')
        $featuredAnimals = Animal::where('statut', 'adopter')
                                ->latest()
                                ->take(4)
                                ->get();
        
        // Récupérer les derniers avis
        $derniersAvis = Avis::with('user')
                           ->latest()
                           ->take(3)
                           ->get();
        
        return view('welcome', compact('featuredAnimals', 'derniersAvis'));
    }
}