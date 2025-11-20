<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vaccin;
use Illuminate\Http\Request;

class VaccinController extends Controller
{
    public function index()
    {
        $vaccins = Vaccin::where('vet_id', auth()->id())->get();
        return view('vet.vaccins.index', compact('vaccins'));
    }

    public function create()
    {
        return view('vet.vaccins.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'frais' => 'required|numeric',
        ]);

        Vaccin::create([
            'nom' => $request->nom,
            'frais' => $request->frais,
            'vet_id' => auth()->id(),
        ]);

        return redirect()->route('vet.vaccins.index')->with('success', 'Vaccin ajouté');
    }

    public function edit(Vaccin $vaccin)
    {
        $this->authorizeVet($vaccin);
        return view('vet.vaccins.edit', compact('vaccin'));
    }

    public function update(Request $request, Vaccin $vaccin)
    {
        $this->authorizeVet($vaccin);

        $request->validate([
            'nom' => 'required',
            'frais' => 'required|numeric',
        ]);

        $vaccin->update($request->only('nom','frais'));

        return redirect()->route('vet.vaccins.index')->with('success', 'Vaccin modifié');
    }

    public function destroy(Vaccin $vaccin)
    {
        $this->authorizeVet($vaccin);
        $vaccin->delete();
        return back()->with('success', 'Vaccin supprimé');
    }

    private function authorizeVet(Vaccin $vaccin)
    {
        if ($vaccin->vet_id !== auth()->id()) {
            abort(403);
        }
    }
}
