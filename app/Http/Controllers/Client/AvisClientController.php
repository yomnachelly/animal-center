<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Avis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvisClientController extends Controller
{
    /**
     * Afficher tous les avis (pour les clients)
     */
    public function index()
    {
        $avis = Avis::with('user')->latest()->get();
        return view('client.avis.index', compact('avis'));
    }

    /**
     * Afficher le formulaire de création d'avis
     */
    public function create()
    {
        return view('client.avis.create');
    }

    /**
     * Enregistrer un nouvel avis
     */
    public function store(Request $request)
    {
        $request->validate([
            'texte' => 'required|min:10|max:1000'
        ]);

        Avis::create([
            'user_id' => Auth::id(),
            'texte' => $request->texte
        ]);

        return redirect()->route('client.avis.index')
            ->with('success', 'Votre avis a été publié avec succès!');
    }

    /**
     * Afficher un avis spécifique
     */
    public function show(Avis $avi)
    {
        return view('client.avis.show', compact('avi'));
    }

    /**
     * Afficher le formulaire d'édition
     */
    public function edit(Avis $avi)
    {
        // Vérifier que l'utilisateur peut modifier cet avis
        if ($avi->user_id !== Auth::id()) {
            abort(403, 'Vous n\'êtes pas autorisé à modifier cet avis.');
        }

        return view('client.avis.edit', compact('avi'));
    }

    /**
     * Mettre à jour un avis
     */
    public function update(Request $request, Avis $avi)
    {
        // Vérifier que l'utilisateur peut modifier cet avis
        if ($avi->user_id !== Auth::id()) {
            abort(403, 'Vous n\'êtes pas autorisé à modifier cet avis.');
        }

        $request->validate([
            'texte' => 'required|min:10|max:1000'
        ]);

        $avi->update([
            'texte' => $request->texte
        ]);

        return redirect()->route('client.avis.index')
            ->with('success', 'Avis modifié avec succès!');
    }

    /**
     * Supprimer un avis
     */
    public function destroy(Avis $avi)
    {
        // Vérifier que l'utilisateur peut supprimer cet avis
        if ($avi->user_id !== Auth::id()) {
            abort(403, 'Vous n\'êtes pas autorisé à supprimer cet avis.');
        }

        $avi->delete();

        return redirect()->route('client.avis.index')
            ->with('success', 'Avis supprimé avec succès!');
    }
}