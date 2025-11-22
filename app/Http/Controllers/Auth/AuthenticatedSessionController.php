<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Animal;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Authentifie l'utilisateur
        $request->authenticate();

        $request->session()->regenerate();

        $user = auth()->user();

        // ❌ Vérification si le compte est verrouillé
        if ($user->verrouiller) {
            Auth::logout();
            return back()->withErrors([
                'email' => 'Votre compte est verrouillé. Veuillez contacter un administrateur.',
            ]);
        }

        // ✅ Vérifier s'il y a un animal à adopter en session
        if ($animalId = session('animal_a_adopter')) {
            $animal = Animal::find($animalId);
            session()->forget('animal_a_adopter');
            
            if ($animal) {
                // Rediriger vers la page d'accueil avec un message
                return redirect('/')
                    ->with('success', 'Vous êtes maintenant connecté. Vous pouvez faire votre demande d\'adoption pour ' . $animal->nom . '.')
                    ->with('scroll_to_animal', $animalId);
            }
        }

        // ✅ Redirection selon le rôle
        if ($user->role === 'admin') {
            return redirect()->intended('/admin/dashboard');
        } elseif ($user->role === 'vet') {
            return redirect()->intended('/vet/dashboard');
        } else {
            return redirect()->intended('/client/dashboard');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}