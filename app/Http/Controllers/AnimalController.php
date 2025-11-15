<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public function index()
    {
        $animals = Animal::all();
        return response()->json($animals);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required',
            'espece' => 'required',
            'race' => 'nullable',
            'sexe' => 'required',
            'age' => 'nullable|integer',
            'etat_sante' => 'required',
            'photo' => 'nullable',
            'statut' => 'required',
        ]);

        $animal = Animal::create($validated);

        return response()->json([
            'message' => 'Animal créé avec succès',
            'animal' => $animal
        ]);
    }

    public function show($id)
    {
        return Animal::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $animal = Animal::findOrFail($id);
        $animal->update($request->all());

        return response()->json([
            'message' => 'Animal modifié',
            'animal' => $animal
        ]);
    }

    public function destroy($id)
    {
        $animal = Animal::findOrFail($id);
        $animal->delete();

        return response()->json(['message' => 'Animal supprimé']);
    }
}
