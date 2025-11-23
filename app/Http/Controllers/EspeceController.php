<?php

namespace App\Http\Controllers;

use App\Models\Espece;
use App\Models\Animal;
use App\Models\Race;
use Illuminate\Http\Request;

class EspeceController extends Controller
{
    public function index()
    {
        // Récupérer les espèces avec le nombre d'animaux et de races associés
        $especes = Espece::withCount(['animaux', 'races'])->get();
        
        // Statistiques globales
        $totalAnimaux = Animal::count();
        $especesAvecRaces = Espece::has('races')->count();

        return view('especes.index', compact('especes', 'totalAnimaux', 'especesAvecRaces'));
    }

    public function create()
    {
        return view('especes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255|unique:especes,nom',
        ]);

        Espece::create($request->all());

        return redirect()->route('especes.index')
            ->with('success', 'Espèce créée avec succès.');
    }

    public function edit(Espece $espece)
    {
        return view('especes.edit', compact('espece'));
    }

    public function update(Request $request, Espece $espece)
    {
        $request->validate([
            'nom' => 'required|string|max:255|unique:especes,nom,' . $espece->id,
        ]);

        $espece->update($request->all());

        return redirect()->route('especes.index')
            ->with('success', 'Espèce mise à jour avec succès.');
    }

    public function destroy(Espece $espece)
    {
        // Vérifier s'il y a des animaux ou races associés
        if ($espece->animaux()->count() > 0) {
            return redirect()->route('especes.index')
                ->with('error', 'Impossible de supprimer cette espèce car elle est associée à des animaux.');
        }

        if ($espece->races()->count() > 0) {
            return redirect()->route('especes.index')
                ->with('error', 'Impossible de supprimer cette espèce car elle est associée à des races.');
        }

        $espece->delete();

        return redirect()->route('especes.index')
            ->with('success', 'Espèce supprimée avec succès.');
    }
}