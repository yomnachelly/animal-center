<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rendezvous;
use App\Models\NotificationApp;
use Illuminate\Support\Facades\Auth;

class RendezvousController extends Controller
{
    // Afficher tous les rendez-vous pour le vétérinaire
    public function index()
    {
        $rendezvous = Rendezvous::with(['user', 'animal', 'soins', 'vaccins'])
            ->orderBy('date', 'desc')
            ->get();

        return view('vet.rendezvous.index', compact('rendezvous'));
    }

    // Afficher les détails d'un rendez-vous
    public function show($id)
    {
        $rendezvous = Rendezvous::with(['user', 'animal', 'soins', 'vaccins'])
            ->findOrFail($id);

        return view('vet.rendezvous.show', compact('rendezvous'));
    }

    // Accepter un rendez-vous
    public function accept($id)
    {
        $this->authorizeVet();

        $rendezvous = Rendezvous::findOrFail($id);
        $rendezvous->etat = 'accepté';
        $rendezvous->save();

        // Notification via NotificationApp
        NotificationApp::create([
            'id_expediteur' => Auth::id(),
            'id_destinataire' => $rendezvous->user_id,
            'contenu' => "Votre rendez-vous du " . $rendezvous->date->format('d/m/Y') . " a été accepté.",
            'date' => now(),
        ]);

        return redirect()->back()->with('success', 'Rendez-vous accepté.');
    }

    // Refuser un rendez-vous et proposer une nouvelle date
    public function refuse(Request $request, $id)
    {
        $this->authorizeVet();

        $request->validate([
            'date' => 'required|date|after_or_equal:today',
        ]);

        $rendezvous = Rendezvous::findOrFail($id);
        $rendezvous->etat = 'refusé';
        $rendezvous->date = $request->date;
        $rendezvous->save();

        // Notification via NotificationApp
        NotificationApp::create([
            'id_expediteur' => Auth::id(),
            'id_destinataire' => $rendezvous->user_id,
            'contenu' => "Votre rendez-vous a été annulé. Nouvelle date proposée : " . $rendezvous->date->format('d/m/Y'),
            'date' => now(),
        ]);

        return redirect()->back()->with('success', 'Rendez-vous refusé et nouvelle date envoyée.');
    }

    // Vérifie que l'utilisateur connecté est un vétérinaire
    private function authorizeVet()
    {
        if (auth()->user()->role !== 'vet') {
            abort(403, 'Accès interdit');
        }
    }
}