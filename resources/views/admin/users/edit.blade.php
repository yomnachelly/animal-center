@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Modifier utilisateur</h2>
    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nom</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
        </div>
        <div class="mb-3">
            <label>Mot de passe (laisser vide si inchangé)</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="mb-3">
            <label>Confirmer mot de passe</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>
        <div class="mb-3">
            <label>Rôle</label>
            <select name="role" class="form-select" required>
                <option value="client" {{ $user->role === 'client' ? 'selected' : '' }}>Client</option>
                <option value="vet" {{ $user->role === 'vet' ? 'selected' : '' }}>Vétérinaire</option>
                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Téléphone</label>
            <input type="text" name="telephone" class="form-control" value="{{ $user->telephone }}">
        </div>
        <div class="mb-3">
            <label>Adresse</label>
            <textarea name="adresse" class="form-control">{{ $user->adresse }}</textarea>
        </div>
        <button class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
