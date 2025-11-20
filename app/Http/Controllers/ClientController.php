<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NotificationApp;

class ClientController extends Controller
{
    // Dashboard client
    public function index()
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        $user = auth()->user();

        if ($user->role !== 'client') {
            abort(403, 'Accès réservé aux clients');
        }

        if ($user->verrouiller) {
            auth()->logout();
            return redirect('/login')->withErrors([
                'email' => 'Votre compte est verrouillé. Veuillez contacter un administrateur.',
            ]);
        }

        return view('client.dashboard');
    }

    // Liste des notifications
    public function notifications()
    {
        $user = auth()->user();

        $notifications = NotificationApp::with('expediteur')
            ->where('id_destinataire', $user->id)
            ->orderByDesc('date')
            ->get();

        return view('client.notifications', compact('notifications'));
    }

    // Supprimer une notification
    public function supprimerNotification($id)
    {
        $user = auth()->user();

        $notification = NotificationApp::where('id', $id)
            ->where('id_destinataire', $user->id)
            ->firstOrFail();

        $notification->delete();

        return redirect()->route('client.notifications')->with('success', 'Notification supprimée.');
    }

    // Afficher le formulaire de réponse
    public function repondreNotification($id)
    {
        $user = auth()->user();

        $notification = NotificationApp::where('id', $id)
            ->where('id_destinataire', $user->id)
            ->firstOrFail();

        return view('client.notifications_repondre', compact('notification'));
    }

    // Envoyer la réponse
    public function envoyerReponse(Request $request, $id)
    {
        $user = auth()->user();

        $original = NotificationApp::where('id', $id)
            ->where('id_destinataire', $user->id)
            ->firstOrFail();

        $request->validate([
            'contenu' => 'required|string|max:1000',
        ]);

        NotificationApp::create([
            'id_expediteur' => $user->id,
            'id_destinataire' => $original->id_expediteur ?? 1, // retourne à l'expéditeur ou à l'admin par défaut
            'contenu' => $request->contenu,
            'date' => now(),
        ]);

        return redirect()->route('client.notifications')->with('success', 'Réponse envoyée.');
    }
}
