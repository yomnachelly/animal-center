@extends('layouts.app')

@section('content')
<h1>Ajouter un Animal</h1>

@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('animaux.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label>Nom</label>
        <input type="text" name="nom" class="form-control" value="{{ old('nom') }}" required>
    </div>

    <div class="mb-3">
        <label>Espèce</label>
        <select name="espece" class="form-control" required>
            <option value="">-- Sélectionner --</option>
            <option value="chat">Chat</option>
            <option value="chien">Chien</option>
            <option value="oiseau">Oiseau</option>
            <option value="lapin">Lapin</option>
            <option value="tortue">Tortue</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Race</label>
        <select name="race" class="form-control">
            <option value="">-- Sélectionner une race --</option>
            @foreach($races as $race)
                <option value="{{ $race }}">{{ $race }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Sexe</label>
        <select name="sexe" class="form-control" required>
            <option value="feminin">Femelle</option>
            <option value="masculin">Mâle</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Age</label>
        <input type="number" name="age" class="form-control" value="{{ old('age') }}">
    </div>

    <div class="mb-3">
        <label>État santé</label>
        <select name="etat_sante" class="form-control" required>
            <option value="sain">Sain</option>
            <option value="malade léger">Malade léger</option>
            <option value="malade grave">Malade grave</option>
            <option value="blessé">Blessé</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Statut</label>
        <select name="statut" class="form-control" required>
            <option value="adopter">À adopter</option>
            <option value="adopté">Adopté</option>
            <option value="hébergé">Hébergé</option>
            <option value="assigner">Assigné</option>
            <option value="à vacciner">À vacciner</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Photo</label>
        <input type="file" name="photo" class="form-control">
    </div>

    <button type="submit" class="btn btn-success">Ajouter</button>
</form>
@endsection
