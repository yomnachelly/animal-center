<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\HebergementController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\VetController;
use App\Http\Controllers\EspeceController;
use App\Http\Controllers\RaceController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\SoinController;
use App\Http\Controllers\VaccinController;
use App\Http\Controllers\AvisController;
use App\Http\Controllers\RendezvousController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdoptionController;
use App\Http\Controllers\ClientDemandeController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\CalendarController;

// Pages publiques
Route::get('/', function () { return view('welcome'); })->name('home');
Route::get('/login', function () { return view('auth.login'); })->name('login');
Route::get('/register', function () { return view('auth.register'); })->name('register');

// Dashboard général (auth)
Route::get('/dashboard', function () { return view('dashboard'); })
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Profil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {

    // Admin
    Route::get('/admin/dashboard', function() { return view('admin.dashboard'); })->name('admin.dashboard');

    // Vétérinaire
    Route::get('/vet/dashboard', [App\Http\Controllers\VetController::class, 'index'])->name('vet.dashboard');

    // Client
    Route::get('/client/dashboard', function() { return view('client.dashboard'); })->name('client.dashboard');

});


// Gestion des animaux (admin)
Route::middleware('auth')->group(function() {
    Route::get('/animaux', [AnimalController::class, 'index'])->name('animaux.index');
    Route::get('/races/by-espece/{espece}', [AnimalController::class, 'getRaces']);
    Route::get('/animaux/create', [AnimalController::class, 'create'])->name('animaux.create');
    Route::post('/animaux', [AnimalController::class, 'store'])->name('animaux.store');
    Route::get('/animaux/{animal}/edit', [AnimalController::class, 'edit'])->name('animaux.edit');
    Route::put('/animaux/{animal}', [AnimalController::class, 'update'])->name('animaux.update');
    Route::delete('/animaux/{animal}', [AnimalController::class, 'destroy'])->name('animaux.destroy');
});
// ESPECES
Route::resource('especes', \App\Http\Controllers\EspeceController::class);

// RACES
Route::resource('races', \App\Http\Controllers\RaceController::class);

// Auth: logout, login, register
Route::post('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.post');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.post');

// Gestion des utilisateurs (admin)
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    Route::put('users/{user}/verrouiller', [UserController::class, 'verrouiller'])->name('admin.users.verrouiller');
    Route::put('users/{user}/deverrouiller', [UserController::class, 'deverrouiller'])->name('admin.users.deverrouiller');
});
// Gestion des demandes (admin)
Route::prefix('admin')->middleware(['auth'])->group(function() {
    Route::get('/demandes', [App\Http\Controllers\DemandeController::class, 'index'])->name('admin.demandes.index');
    Route::post('/demandes/{demande}/accepter', [App\Http\Controllers\DemandeController::class, 'accepter'])->name('admin.demandes.accepter');
    Route::post('/demandes/{demande}/rejeter', [App\Http\Controllers\DemandeController::class, 'rejeter'])->name('admin.demandes.rejeter');
});
Route::get('/admin/demandes/{id}/details', 
    [App\Http\Controllers\DemandeController::class, 'details']
)->name('admin.demandes.details');
Route::prefix('veterinaire')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [VetController::class, 'index'])->name('veterinaire.dashboard');
});
// Dashboard client
Route::get('/client/dashboard', [ClientController::class, 'index'])->name('client.dashboard');

// Page des notifications
Route::get('/client/notifications', [ClientController::class, 'notifications'])->name('client.notifications');
Route::get('/client/notifications/repondre/{id}', [ClientController::class, 'repondreNotification'])->name('client.notifications.repondre');
    Route::delete('/client/notifications/{id}', [ClientController::class, 'supprimerNotification'])->name('client.notifications.supprimer');
    Route::get('/client/notifications/repondre/{id}', [ClientController::class, 'repondreNotification'])->name('client.notifications.repondre');
    Route::post('/client/notifications/repondre/{id}', [ClientController::class, 'envoyerReponse'])->name('client.notifications.envoyerReponse');
    Route::middleware(['auth', 'role:vet'])->prefix('vet')->name('vet.')->group(function () {
});
Route::middleware('auth')->prefix('vet')->name('vet.')->group(function () {
    Route::resource('soins', App\Http\Controllers\SoinController::class);
    Route::resource('vaccins', App\Http\Controllers\VaccinController::class);
});
// ==================== ROUTES CLIENT ====================
Route::prefix('client')->middleware('auth')->name('client.')->group(function () {
   // Mes demandes - Adoption et Hébergement
    Route::prefix('demandes')->name('demandes.')->group(function () {
        Route::get('/adoption', [ClientController::class, 'demandesAdoption'])->name('adoption');
        Route::get('/hebergement', [ClientController::class, 'demandesHebergement'])->name('hebergement');
        Route::get('/hebergement/create', [ClientController::class, 'createHebergement'])->name('hebergement.create');
        Route::post('/hebergement', [ClientController::class, 'storeHebergement'])->name('hebergement.store');
        Route::delete('/hebergement/{demande}', [ClientController::class, 'destroyHebergement'])
    ->name('hebergement.destroy');


    });
    // Dans le groupe des routes client (après les demandes)
Route::get('/rendez-vous', [ClientController::class, 'rendezVous'])->name('rendez-vous');
    Route::get('/rendez-vous/create', [ClientController::class, 'createRendezVous'])->name('rendez-vous.create');
    Route::post('/rendez-vous', [ClientController::class, 'storeRendezVous'])->name('rendez-vous.store');
    Route::delete('/rendez-vous/{id}', [ClientController::class, 'annulerRendezVous'])->name('rendez-vous.annuler');
    Route::resource('avis', \App\Http\Controllers\Client\AvisClientController::class);
});

// ==================== FIN ROUTES CLIENT ====================

Route::middleware(['auth'])->group(function () {
    Route::get('/avis', [AvisController::class, 'index'])->name('avis.index');
    Route::delete('/avis/{id}', [AvisController::class, 'destroy'])->name('avis.destroy');
});
//vet
Route::middleware(['auth'])->group(function () {
    Route::get('/vet/rendezvous', [RendezvousController::class, 'index'])->name('vet.rendezvous.index');
    Route::get('/vet/rendezvous/{id}', [RendezvousController::class, 'show'])->name('vet.rendezvous.show');
    Route::post('/vet/rendezvous/{id}/accept', [RendezvousController::class, 'accept'])->name('vet.rendezvous.accept');
    Route::post('/vet/rendezvous/{id}/refuse', [RendezvousController::class, 'refuse'])->name('vet.rendezvous.refuse');
});
// routes/web.php
Route::get('/client/demandes/hebergement', [ClientController::class, 'demandesHebergement'])->name('client.demandes.hebergement');
Route::get('/client/demandes/adoption', [ClientController::class, 'demandesAdoption'])->name('client.demandes.adoption');


Route::get('/', [HomeController::class, 'index'])->name('home');


Route::post('/demande-adopter/{animal}', [AdoptionController::class, 'demandeAdopter'])
    ->name('demande.adopter');
    Route::get('/test-adoption/{animal}', function (Animal $animal) {
    return view('test-adoption', compact('animal'));
});

Route::post('/test-adoption/{animal}', [AdoptionController::class, 'demandeAdopter']);
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
});




Route::prefix('admin')->middleware(['auth'])->group(function () {
    // GET - Afficher la liste
    Route::get('/paiements', [PaiementController::class, 'index'])->name('admin.paiements.index');
    
    // GET - Afficher le formulaire de création
    Route::get('/paiements/create', [PaiementController::class, 'create'])->name('admin.paiements.create');
    
    // POST - Enregistrer le nouveau paiement
    Route::post('/paiements', [PaiementController::class, 'store'])->name('admin.paiements.store');
    
    // GET - Afficher le formulaire d'édition
    Route::get('/paiements/{id}/edit', [PaiementController::class, 'edit'])->name('admin.paiements.edit');
    
    // PUT - Mettre à jour le paiement
    Route::put('/paiements/{id}', [PaiementController::class, 'update'])->name('admin.paiements.update');
    
    // DELETE - Supprimer le paiement
    Route::delete('/paiements/{id}', [PaiementController::class, 'destroy'])->name('admin.paiements.destroy');
});
Route::get('/auth/google', [CalendarController::class, 'redirectToGoogle'])
    ->name('google.calendar.connect');
    
Route::get('/auth/google/callback', [CalendarController::class, 'handleGoogleCallback'])
    ->name('google.calendar.callback');
Route::get('/vet/calendar', function () {
    return view('vet.calendar');
})->name('vet.calendar');

Route::get(uri: '/google/events', action: [App\Http\Controllers\CalendarController::class, 'getEvents'])->name(name: 'google.getEvents');
Route::get(uri: '/google/events/create', action: [App\Http\Controllers\CalendarController::class, 'createEvent'])->name(name: 'google.createEvent');
Route::get(uri: 'auth/google/calendar/callback', action: [App\Http\Controllers\CalendarController::class, 'callback'])->name(name: 'google.callback');
Route::get(uri: 'auth/google/calendar/redirect', action: [App\Http\Controllers\CalendarController::class, 'redirect'])->name(name: 'google.redirect');
