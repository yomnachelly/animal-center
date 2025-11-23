<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NotificationApp;
use App\Models\Rendezvous;
use App\Models\Animal;
use App\Models\Soin;
use App\Models\Vaccin;
use App\Models\Espece;
use App\Models\Race;
use App\Models\Hebergement;
use App\Models\Demande;
use Illuminate\Support\Facades\Auth;
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
    // Dans App\Http\Controllers\ClientController.php








/*public function createHebergement()
{
    // Pas besoin d'animaux existants, l'utilisateur va en créer un nouveau
    $especes = Espece::all();
    $races = Race::all();
    
    return view('client.demandes.hebergement-create', compact('especes', 'races'));
}*/

public function storeHebergement(Request $request)
{
    $request->validate([
        // Validation pour l'animal
        'nom_animal' => 'required|string|max:255',
        'espece_id' => 'required|exists:especes,id',
        'race_id' => 'required|exists:races,id',
        'age' => 'required|integer|min:0',
        'sexe' => 'required|in:masculin,feminin',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        // Validation pour l'hébergement
        'date_debut' => 'required|date|after:today',
        'date_fin' => 'required|date|after:date_debut',
        'motif' => 'nullable|string|max:500'
    ]);

    // Traitement de la photo
    $photoPath = null;
    if ($request->hasFile('photo')) {
        try {
            $photoPath = $request->file('photo')->store('animals', 'public');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erreur lors du téléchargement de la photo: ' . $e->getMessage());
        }
    }

    // Créer un nouvel animal avec le statut "heberger" (sans accent)
    $animal = Animal::create([
        'nom' => $request->nom_animal,
        'espece_id' => $request->espece_id,
        'race_id' => $request->race_id,
        'age' => $request->age,
        'sexe' => $request->sexe,
        'etat_sante' => 'sain',
        'photo' => $photoPath,
        'statut' => 'heberger' // Sans accent
    ]);

    // Créer la demande
    $demande = Demande::create([
        'user_id' => auth()->id(),
        'animal_id' => $animal->id,
        'etat' => 'en attente'
    ]);

    // Créer l'hébergement
    $hebergement = Hebergement::create([
        'user_id' => auth()->id(),
        'animal_id' => $animal->id,
        'demande_id' => $demande->id,
        'date_debut' => $request->date_debut,
        'date_fin' => $request->date_fin
    ]);

    return redirect()->route('client.demandes.hebergement')
                     ->with('success', 'Demande d\'hébergement créée avec succès!');
}


public function rendezVous()
{
    $rendezvous = Rendezvous::where('user_id', auth()->id())
                            ->with(['animal', 'soins', 'vaccins'])
                            ->orderBy('date', 'desc')
                            ->get();
    
    return view('client.rendez-vous', compact('rendezvous'));
}

public function createRendezVous()
{
    // Animaux existants de l'utilisateur (s'il en a)
    $animaux = collect(); // Liste vide pour commencer
    
    $soins = Soin::all();
    $vaccins = Vaccin::all();
    $especes = Espece::all();
    $races = Race::all();
    
    return view('client.rendez-vous-create', compact('animaux', 'soins', 'vaccins', 'especes', 'races'));
}

public function storeRendezVous(Request $request)
{
    $request->validate([
        'type_rdv' => 'required|in:soin,vaccin',
        'date' => 'required|date|after:now',
        'soins' => 'required_if:type_rdv,soin|array',
        'soins.*' => 'exists:soins,id',
        'vaccins' => 'required_if:type_rdv,vaccin|array',
        'vaccins.*' => 'exists:vaccins,id',
        'nom_animal' => 'required|string|max:255',
        'espece_id' => 'required|exists:especes,id',
        'race_id' => 'required|exists:races,id',
        'age' => 'required|integer|min:0',
        'sexe' => 'required|in:masculin,feminin',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // validation image
    ]);

    // Déterminer le statut selon le type de RDV
    $statut = $request->type_rdv === 'soin' ? 'asoigner' : 'à vacciner';

    $photoPath = null;
    if ($request->hasFile('photo')) {
        $photoPath = $request->file('photo')->store('animals', 'public'); // stocke dans storage/app/public/animals
    }

    // Créer l'animal
    $animal = Animal::create([
        'nom' => $request->nom_animal,
        'espece_id' => $request->espece_id,
        'race_id' => $request->race_id,
        'age' => $request->age,
        'sexe' => $request->sexe,
        'etat_sante' => 'sain',
        'photo' => $photoPath,
        'statut' => $statut,
    ]);

    // Créer le rendez-vous
    $rendezvous = Rendezvous::create([
        'user_id' => auth()->id(),
        'animal_id' => $animal->id,
        'date' => $request->date,
        'etat' => 'en attente',
    ]);

    if ($request->type_rdv === 'soin' && $request->has('soins')) {
        $rendezvous->soins()->attach($request->soins);
    } elseif ($request->type_rdv === 'vaccin' && $request->has('vaccins')) {
        $rendezvous->vaccins()->attach($request->vaccins);
    }

    return redirect()->route('client.rendez-vous')
                     ->with('success', 'Rendez-vous créé avec succès !');
}

public function demandesHebergement()
{
    $hebergements = Hebergement::where('user_id', auth()->id())
        ->with(['demande', 'animal'])
        ->orderBy('created_at', 'desc')
        ->get();

    return view('client.demandes.hebergement', compact('hebergements'));
}

public function createHebergement()
{
    $especes = Espece::all();
    $races = Race::all();
    
    return view('client.demandes.hebergement-create', compact('especes', 'races'));
}
// ClientController.php
// ClientController.php
public function destroyHebergement($id)
{
    $demande = Demande::with('hebergement')->findOrFail($id);

    if ($demande->user_id !== auth()->id()) {
        abort(403, 'Accès non autorisé');
    }

    if ($demande->etat !== 'en attente') {
        return back()->with('error', 'Seules les demandes en attente peuvent être annulées.');
    }

    // Utilisez "rejete" comme valeur valide
    $demande->etat = 'rejete';
    $demande->save();

    return redirect()->route('client.demandes.hebergement')
                     ->with('success', 'Demande d\'hébergement annulée avec succès.');
}
    public function demandesAdoption()
    {
        // Récupérer les demandes d'adoption de l'utilisateur connecté
        $demandes = Demande::with(['animal.espece', 'animal.race', 'adoption'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        return view('client.demandes.adoption', compact('demandes'));
    }


public function annulerRendezVous($id)
{
    try {
        $rendezvous = Rendezvous::where('id', $id)
                                ->where('user_id', auth()->id())
                                ->firstOrFail();

        // Vérifier que le rendez-vous peut être annulé
        if ($rendezvous->etat !== 'en attente') {
            return redirect()->route('client.rendez-vous')
                             ->with('error', 'Impossible d\'annuler ce rendez-vous. Seuls les rendez-vous en attente peuvent être annulés.');
        }

        // Vérifier que la date n'est pas passée
        if (now()->greaterThan($rendezvous->date)) {
            return redirect()->route('client.rendez-vous')
                             ->with('error', 'Impossible d\'annuler un rendez-vous déjà passé.');
        }

        // Utiliser une transaction pour garantir l'intégrité des données
        \DB::transaction(function () use ($rendezvous) {
            // Supprimer les relations
            $rendezvous->soins()->detach();
            $rendezvous->vaccins()->detach();
            
            // Supprimer le rendez-vous
            $rendezvous->delete();
        });

        return redirect()->route('client.rendez-vous')
                         ->with('success', 'Rendez-vous annulé avec succès.');

    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return redirect()->route('client.rendez-vous')
                         ->with('error', 'Rendez-vous non trouvé.');
    } catch (\Exception $e) {
        return redirect()->route('client.rendez-vous')
                         ->with('error', 'Une erreur est survenue lors de l\'annulation.');
    }
}
public function marquerCommeLu($id)
{
    $notification = Notification::findOrFail($id);
    $notification->update(['is_read' => true]);
    
    return back()->with('success', 'Notification marquée comme lue.');
}
}
