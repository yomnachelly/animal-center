<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AnimalController extends Controller
{
    // Liste des races
    private $races = [
        'Berger Allemand',
        'Caniche',
        'Siamois',
        'Maine Coon',
        'Lapin nain hollandais',
        'Lapin angora',
        'Perroquet gris du Gabon',
        'Canari',
        'Tortue d\'Hermann',
        'Tortue de Floride',
    ];

    // Affiche tous les animaux
    public function index()
    {
        $animaux = Animal::all();
        return view('animaux.index', compact('animaux'));
    }

    // Formulaire pour ajouter un animal
    public function create()
    {
        $races = $this->races;
        return view('animaux.create', compact('races'));
    }

    // Enregistre un nouvel animal
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'espece' => 'required|string|max:255',
            'race' => ['nullable', Rule::in($this->races)],
            'sexe' => 'required|string',
            'age' => 'nullable|integer',
            'etat_sante' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'statut' => 'required|string',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('photos', 'public');
        }

        Animal::create($validated);

        return redirect()->route('animaux.index')->with('success', 'Animal ajouté avec succès.');
    }

    // Formulaire pour éditer un animal
    public function edit(Animal $animal)
    {
        $races = $this->races;
        return view('animaux.edit', compact('animal', 'races'));
    }

    // Met à jour un animal
    public function update(Request $request, Animal $animal)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'espece' => 'required|string|max:255',
            'race' => ['nullable', Rule::in($this->races)],
            'sexe' => 'required|string',
            'age' => 'nullable|integer',
            'etat_sante' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'statut' => 'required|string',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('photos', 'public');
        }

        $animal->update($validated);

        return redirect()->route('animaux.index')->with('success', 'Animal modifié avec succès.');
    }

    // Supprime un animal
    public function destroy(Animal $animal)
    {
        $animal->delete();
        return redirect()->route('animaux.index')->with('success', 'Animal supprimé avec succès.');
    }
}
