<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;

use App\Http\Controllers\HomeController; // AJOUTER
use App\Http\Controllers\AdminController; // AJOUTER
use App\Http\Controllers\VetController; // AJOUTER
use App\Http\Controllers\ClientController; // AJOUTER

// Page d'accueil
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Routes de connexion et inscription (si Breeze ne les a pas créées)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Dashboard (protégé)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes profil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// =============================================
// ✅ AJOUTE CES NOUVELLES ROUTES POUR LES RÔLES
// =============================================

Route::middleware(['auth'])->group(function () {
    // Dashboard Admin
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    
    // Dashboard Vétérinaire
    Route::get('/vet/dashboard', [VetController::class, 'index'])->name('vet.dashboard');
    
    // Dashboard Client
    Route::get('/client/dashboard', [ClientController::class, 'index'])->name('client.dashboard');
});

// Route de déconnexion personnalisée
Route::post('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');
// POST Login
Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->name('login.post');

// POST Register
Route::post('/register', [RegisteredUserController::class, 'store'])
    ->name('register.post');
