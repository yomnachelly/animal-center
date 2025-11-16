<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
public function store(Request $request)
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'telephone' => ['required','string','max:255'],
        'adresse' => ['required','string','max:255'],
    ]);

    // Création de l'utilisateur
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'client',
        'telephone' => $request->telephone,
        'adresse' => $request->adresse,
    ]);

    // On NE connecte plus automatiquement l'utilisateur
    // Auth::login($user);  ← supprimer ou commenter cette ligne

    // Redirection vers la page de login avec message
    return redirect()->route('login')->with('success', 'Inscription réussie, connectez-vous !');
}


}
