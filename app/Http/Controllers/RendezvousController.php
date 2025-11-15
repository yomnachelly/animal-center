<?php

namespace App\Http\Controllers;

use App\Models\Rendezvous;
use Illuminate\Http\Request;

class RendezvousController extends Controller
{
    public function index()
    {
        return Rendezvous::with('animal','user','soins','vaccins')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'animal_id' => 'required',
            'user_id' => 'required',
            'date' => 'required|date',
            'etat' => 'required'
        ]);

        $rdv = Rendezvous::create($validated);

        if ($request->soins) {
            $rdv->soins()->sync($request->soins);
        }

        if ($request->vaccins) {
            $rdv->vaccins()->sync($request->vaccins);
        }

        return $rdv;
    }

    public function show($id)
    {
        return Rendezvous::with('animal','user','soins','vaccins')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $rdv = Rendezvous::findOrFail($id);

        $rdv->update($request->all());

        if ($request->soins) $rdv->soins()->sync($request->soins);
        if ($request->vaccins) $rdv->vaccins()->sync($request->vaccins);

        return $rdv;
    }

    public function destroy($id)
    {
        Rendezvous::findOrFail($id)->delete();
        return ['message' => 'Rendez-vous supprimé'];
    }
}
