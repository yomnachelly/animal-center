<?php

namespace App\Http\Controllers;

use App\Models\Vaccin;
use Illuminate\Http\Request;

class VaccinController extends Controller
{
    public function index()
    {
        return Vaccin::all();
    }

    public function store(Request $request)
    {
        return Vaccin::create($request->validate([
            'nom' => 'required',
            'frais' => 'required|numeric'
        ]));
    }

    public function show($id)
    {
        return Vaccin::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $vaccin = Vaccin::findOrFail($id);
        $vaccin->update($request->all());
        return $vaccin;
    }

    public function destroy($id)
    {
        Vaccin::findOrFail($id)->delete();
        return ['message' => 'Vaccin supprimé'];
    }
}
