<?php

namespace App\Http\Controllers;

use App\Models\Hebergement;
use Illuminate\Http\Request;

class HebergementController extends Controller
{
    public function index()
    {
        return Hebergement::with('user','animal')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'animal_id' => 'required',
            'date_debut' => 'required|date',
            'date_fin' => 'nullable|date',
            'frais' => 'required|numeric',
        ]);

        $hebergement = Hebergement::create($validated);

        return response()->json([
            'message' => 'Hebergement ajouté',
            'data' => $hebergement
        ]);
    }

    public function show($id)
    {
        return Hebergement::with('user','animal')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $hebergement = Hebergement::findOrFail($id);

        $hebergement->update($request->all());

        return response()->json([
            'message' => 'Hebergement mis à jour',
            'data' => $hebergement
        ]);
    }

    public function destroy($id)
    {
        $hebergement = Hebergement::findOrFail($id);
        $hebergement->delete();

        return response()->json(['message' => 'Hebergement supprimé']);
    }
}
