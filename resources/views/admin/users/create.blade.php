@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Ajouter un utilisateur</h2>
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nom</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Mot de passe</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Confirmer mot de passe</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Rôle</label>
            <select name="role" class="form-select" required>
                <option value="client">Client</option>
                <option value="vet">Vétérinaire</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Téléphone</label>
            <input type="text" name="telephone" class="form-control">
        </div>
        <div class="mb-3">
            <label>Adresse</label>
            <textarea name="adresse" class="form-control"></textarea>
        </div>
        <button class="btn btn-primary">Enregistrer</button>
    </form>
</div>
@endsection
