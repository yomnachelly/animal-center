<?php

namespace App\Http\Controllers;

use App\Models\Adoption;
use Illuminate\Http\Request;

class AdoptionController extends Controller
{
    public function index()
    {
        return Adoption::with('user', 'animal')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'animal_id' => 'required',
            'date' => 'required',
            'statut' => 'required'
        ]);

        $adoption = Adoption::create($validated);

        return response()->json([
            'message' => 'Adoption enregistrée',
            'adoption' => $adoption
        ]);
    }

    public function show($id)
    {
        return Adoption::with('user', 'animal')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $adoption = Adoption::findOrFail($id);
        $adoption->update($request->all());

        return response()->json([
            'message' => 'Adoption modifiée',
            'adoption' => $adoption
        ]);
    }

    public function destroy($id)
    {
        $adoption = Adoption::findOrFail($id);
        $adoption->delete();

        return response()->json(['message' => 'Adoption supprimée']);
    }
}
