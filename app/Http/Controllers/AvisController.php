<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use Illuminate\Http\Request;

class AvisController extends Controller
{
    public function index()
    {
        return Avis::with('user')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'texte' => 'required',
        ]);

        return Avis::create($validated);
    }

    public function show($id)
    {
        return Avis::with('user')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $avis = Avis::findOrFail($id);
        $avis->update($request->all());
        return $avis;
    }

    public function destroy($id)
    {
        Avis::findOrFail($id)->delete();
        return ['message' => 'Avis supprimé'];
    }
}
