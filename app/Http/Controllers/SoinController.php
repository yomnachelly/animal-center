<?php

namespace App\Http\Controllers;

use App\Models\Soin;
use Illuminate\Http\Request;

class SoinController extends Controller
{
    public function index()
    {
        return Soin::all();
    }

    public function store(Request $request)
    {
        return Soin::create($request->validate([
            'nom' => 'required',
            'frais' => 'required|numeric'
        ]));
    }

    public function show($id)
    {
        return Soin::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $soin = Soin::findOrFail($id);
        $soin->update($request->all());
        return $soin;
    }

    public function destroy($id)
    {
        Soin::findOrFail($id)->delete();
        return ['message' => 'Soin supprimé'];
    }
}
