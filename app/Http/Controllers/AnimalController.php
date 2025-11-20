<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Espece;
use App\Models\Race;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    // ➤ Charger races selon espèce (AJAX)
    public function getRaces(Espece $espece)
    {
        return response()->json($espece->races);
    }

    // ➤ Liste des animaux
    public function index()
    {
        $animaux = Animal::with(['espece', 'race'])->get();
        return view('animaux.index', compact('animaux'));
    }

    // ➤ Formulaire CREATE
    public function create()
    {
        $especes = Espece::all();  // toutes les espèces
        return view('animaux.create', compact('especes'));
    }

    // ➤ Enregistrer animal
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'espece_id' => 'required|exists:especes,id',
            'race_id' => 'nullable|exists:races,id',
            'sexe' => 'required|in:feminin,masculin',
            'age' => 'nullable|integer',
            'etat_sante' => 'required|in:sain,malade léger,malade grave,blessé',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'statut' => 'required|in:adopter,adopté,hébergé,assigner,à vacciner',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('photos', 'public');
        }

        Animal::create($validated);

        return redirect()->route('animaux.index')->with('success', 'Animal ajouté avec succès.');
    }

    // ➤ Formulaire EDIT
    public function edit(Animal $animal)
    {
        $especes = Espece::all();
        $races = Race::where('espece_id', $animal->espece_id)->get();

        return view('animaux.edit', compact('animal', 'especes', 'races'));
    }

    // ➤ Mise à jour animal
    public function update(Request $request, Animal $animal)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'espece_id' => 'required|exists:especes,id',
            'race_id' => 'nullable|exists:races,id',
            'sexe' => 'required|in:feminin,masculin',
            'age' => 'nullable|integer',
            'etat_sante' => 'required|in:sain,malade léger,malade grave,blessé',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'statut' => 'required|in:adopter,adopté,hébergé,assigner,à vacciner',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('photos', 'public');
        }

        $animal->update($validated);

        return redirect()->route('animaux.index')->with('success', 'Animal modifié avec succès.');
    }

    // ➤ Suppression animal
    public function destroy(Animal $animal)
    {
        $animal->delete();
        return redirect()->route('animaux.index')->with('success', 'Animal supprimé avec succès.');
    }
}
