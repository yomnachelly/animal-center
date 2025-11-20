<?php

namespace App\Http\Controllers;

use App\Models\Race;
use App\Models\Espece;
use Illuminate\Http\Request;

class RaceController extends Controller
{
    public function index()
    {
        $races = Race::with('espece')->get();
        $especes = Espece::all();
        return view('races.index', compact('races', 'especes'));
    }

    public function create()
    {
        $especes = Espece::all();
        return view('races.create', compact('especes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'espece_id' => 'required|exists:especes,id',
        ]);

        Race::create($request->all());
        return redirect()->route('races.index')->with('success', 'Race ajoutée avec succès');
    }

    public function edit(Race $race)
    {
        $especes = Espece::all();
        return view('races.edit', compact('race', 'especes'));
    }

    public function update(Request $request, Race $race)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'espece_id' => 'required|exists:especes,id',
        ]);

        $race->update($request->all());
        return redirect()->route('races.index')->with('success', 'Race modifiée avec succès');
    }

    public function destroy(Race $race)
    {
        // Supprimer les animaux liés à cette race
        $race->animals()->delete();

        // Supprimer la race
        $race->delete();

        return redirect()->route('races.index')->with('success', 'Race et animaux associés supprimés avec succès');
    }

    public function getByEspece($id)
    {
        return Race::where('espece_id', $id)->get();
    }
}
