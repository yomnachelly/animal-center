<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use Illuminate\Http\Request;

class DemandeController extends Controller
{
    public function index()
    {
        return Demande::with('user', 'animal')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'animal_id' => 'required',
            'etat' => 'required'
        ]);

        $demande = Demande::create($validated);

        return response()->json([
            'message' => 'Demande créée',
            'demande' => $demande
        ]);
    }

    public function show($id)
    {
        return Demande::with('user', 'animal')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $demande = Demande::findOrFail($id);
        $demande->update($request->all());

        return response()->json([
            'message' => 'Demande modifiée',
            'demande' => $demande
        ]);
    }

    public function destroy($id)
    {
        $demande = Demande::findOrFail($id);
        $demande->delete();

        return response()->json(['message' => 'Demande supprimée']);
    }
}
