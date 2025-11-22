<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use Illuminate\Http\Request;

class AvisController extends Controller
{
    // Affiche tous les avis
    public function index()
    {
        $avis = Avis::with('user')->latest()->get();
        return view('avis.index', compact('avis'));
    }

    // Supprime un avis
    public function destroy($id)
    {
        $avis = Avis::findOrFail($id);
        $avis->delete();

        return redirect()->route('avis.index')->with('success', 'Avis supprimé avec succès.');
    }
}