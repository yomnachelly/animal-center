<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Paiement;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    public function index()
    {
        $paiements = Paiement::all();
        return view('admin.paiements.index', compact('paiements'));
    }

    public function create()
    {
        return view('admin.paiements.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'frais_jour' => 'required|numeric|min:0'
        ]);

        Paiement::create($request->all());

        return redirect()->route('admin.paiements.index')
            ->with('success', 'Frais journalier ajouté avec succès');
    }

    public function edit($id)
    {
        $paiement = Paiement::findOrFail($id);
        return view('admin.paiements.edit', compact('paiement'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'frais_jour' => 'required|numeric|min:0'
        ]);

        $paiement = Paiement::findOrFail($id);
        $paiement->update($request->all());

        return redirect()->route('admin.paiements.index')
            ->with('success', 'Frais journalier modifié avec succès');
    }

    public function destroy($id)
    {
        $paiement = Paiement::findOrFail($id);
        $paiement->delete();

        return redirect()->route('admin.paiements.index')
            ->with('success', 'Frais journalier supprimé avec succès');
    }
}