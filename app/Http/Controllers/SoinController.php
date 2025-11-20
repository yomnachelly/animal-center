<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Soin;
use Illuminate\Http\Request;

class SoinController extends Controller
{
    public function index()
    {
        $soins = Soin::where('vet_id', auth()->id())->get();
        return view('vet.soins.index', compact('soins'));
    }

    public function create()
    {
        return view('vet.soins.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'frais' => 'required|numeric',
        ]);

        Soin::create([
            'nom' => $request->nom,
            'frais' => $request->frais,
            'vet_id' => auth()->id(),
        ]);

        return redirect()->route('vet.soins.index')->with('success', 'Soin ajouté');
    }

    public function edit(Soin $soin)
    {
        $this->authorizeVet($soin);
        return view('vet.soins.edit', compact('soin'));
    }

    public function update(Request $request, Soin $soin)
    {
        $this->authorizeVet($soin);

        $request->validate([
            'nom' => 'required',
            'frais' => 'required|numeric',
        ]);

        $soin->update($request->only('nom','frais'));

        return redirect()->route('vet.soins.index')->with('success', 'Soin modifié');
    }

    public function destroy(Soin $soin)
    {
        $this->authorizeVet($soin);
        $soin->delete();
        return back()->with('success', 'Soin supprimé');
    }

    private function authorizeVet(Soin $soin)
    {
        if ($soin->vet_id !== auth()->id()) {
            abort(403);
        }
    }
}
