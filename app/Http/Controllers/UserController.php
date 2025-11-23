<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Liste des utilisateurs avec filtrage
    public function index(Request $request)
    {
        // Récupérer le filtre de rôle depuis la requête
        $role = $request->get('role');
        
        // Construire la requête avec filtre optionnel
        $usersQuery = User::query();
        
        if ($role) {
            $usersQuery->where('role', $role);
        }
        
        // Trier par date de création (plus récents en premier)
        $users = $usersQuery->orderBy('created_at', 'desc')->get();

        return view('admin.users.index', compact('users', 'role'));
    }

    // Formulaire création utilisateur
    public function create()
    {
        return view('admin.users.create');
    }

    // Enregistrer nouvel utilisateur
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => ['required', Rule::in(['admin', 'vet', 'client'])],
            'telephone' => 'nullable|string|max:255',
            'adresse' => 'nullable|string',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur ajouté avec succès.');
    }

    // Formulaire édition utilisateur
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Mettre à jour un utilisateur
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:6|confirmed',
            'role' => ['required', Rule::in(['admin', 'vet', 'client'])],
            'telephone' => 'nullable|string|max:255',
            'adresse' => 'nullable|string',
        ]);

        if ($validated['password']) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur modifié avec succès.');
    }

    // Verrouiller un utilisateur
    public function verrouiller(User $user)
    {
        $user->update(['verrouiller' => 1]);
        return redirect()->route('admin.users.index')->with('success', 'Utilisateur verrouillé.');
    }

    // Déverrouiller un utilisateur
    public function deverrouiller(User $user)
    {
        $user->update(['verrouiller' => 0]);
        return redirect()->route('admin.users.index')->with('success', 'Utilisateur déverrouillé.');
    }
}