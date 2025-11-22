<?php

namespace App\Http\Controllers;

use App\Models\Adoption;
use App\Models\Demande;
use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdoptionController extends Controller 
{
    public function demandeAdopter(Animal $animal)
    {
        // Vérifier si l'utilisateur est connecté
        if (!Auth::check()) {
            session(['animal_a_adopter' => $animal->id]);
            return redirect()->route('login')
                ->with('info', 'Veuillez vous connecter pour faire une demande d\'adoption.');
        }

        // Vérifier si une demande existe déjà
        $demandeExistante = Demande::where('user_id', Auth::id())
            ->where('animal_id', $animal->id)
            ->first();

        if ($demandeExistante) {
            return redirect()->back()
                ->with('error', 'Vous avez déjà fait une demande d\'adoption pour cet animal.');
        }

        try {
            // Utiliser une transaction
            DB::beginTransaction();

            // Créer la demande
            $demande = Demande::create([
                'user_id' => Auth::id(),
                'animal_id' => $animal->id,
                'etat' => 'en attente',
            ]);

            // DEBUG: Vérifier que la demande est créée
            \Log::info('Demande créée:', ['id' => $demande->id, 'user_id' => $demande->user_id, 'animal_id' => $demande->animal_id]);

            // Créer l'adoption liée à la demande
            $adoption = Adoption::create([
                'user_id' => Auth::id(),
                'animal_id' => $animal->id,
                'demande_id' => $demande->id,
                'date' => now(),
            ]);

            // DEBUG: Vérifier que l'adoption est créée
            \Log::info('Adoption créée:', ['id' => $adoption->id, 'demande_id' => $adoption->demande_id]);

            DB::commit();

            return redirect()->back()
                ->with('success', 'Votre demande d\'adoption a été envoyée avec succès!');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Erreur création adoption:', ['error' => $e->getMessage()]);
            
            return redirect()->back()
                ->with('error', 'Une erreur est survenue lors de l\'envoi de votre demande.');
        }
    }
}