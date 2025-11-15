<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AnimalController;
use App\Http\Controllers\AdoptionController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\RendezvousController;
use App\Http\Controllers\HebergementController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AvisController;
use App\Http\Controllers\SoinController;
use App\Http\Controllers\VaccinController;

// Page d’accueil simple
Route::get('/', function () {
    return view('welcome');
});


// ------------------------------
// CRUD Animal
// ------------------------------
Route::resource('animals', AnimalController::class);


// ------------------------------
// CRUD Adoption
// ------------------------------
Route::resource('adoptions', AdoptionController::class);


// ------------------------------
// CRUD Demande
// ------------------------------
Route::resource('demandes', DemandeController::class);


// ------------------------------
// CRUD Rendezvous
// ------------------------------
Route::resource('rendezvous', RendezvousController::class);


// ------------------------------
// CRUD Hebergement
// ------------------------------
Route::resource('hebergements', HebergementController::class);


// ------------------------------
// CRUD Notification
// ------------------------------
Route::resource('notifications', NotificationController::class);


// ------------------------------
// CRUD Avis
// ------------------------------
Route::resource('avis', AvisController::class);


// ------------------------------
// CRUD Soin
// ------------------------------
Route::resource('soins', SoinController::class);


// ------------------------------
// CRUD Vaccin
// ------------------------------
Route::resource('vaccins', VaccinController::class);

