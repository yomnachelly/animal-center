@extends('layouts.app')

@section('content')
<h1>Modifier Animal</h1>

@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('animaux.update', $animal) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nom</label>
        <input type="text" name="nom" class="form-control" value="{{ old('nom', $animal->nom) }}" required>
    </div>

    <div class="mb-3">
        <label>Espèce</label>
        <select name="espece" class="form-control" required>
            <option value="chat" {{ $animal->espece == 'chat' ? 'selected' : '' }}>Chat</option>
            <option value="chien" {{ $animal->espece == 'chien' ? 'selected' : '' }}>Chien</option>
            <option value="oiseau" {{ $animal->espece == 'oiseau' ? 'selected' : '' }}>Oiseau</option>
            <option value="lapin" {{ $animal->espece == 'lapin' ? 'selected' : '' }}>Lapin</option>
            <option value="tortue" {{ $animal->espece == 'tortue' ? 'selected' : '' }}>Tortue</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Race</label>
        <select name="race" class="form-control">
            <option value="">-- Sélectionner une race --</option>
            @foreach($races as $race)
                <option value="{{ $race }}" {{ $animal->race == $race ? 'selected' : '' }}>
                    {{ $race }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Sexe</label>
        <select name="sexe" class="form-control" required>
            <option value="feminin" {{ $animal->sexe == 'feminin' ? 'selected' : '' }}>Femelle</option>
            <option value="masculin" {{ $animal->sexe == 'masculin' ? 'selected' : '' }}>Mâle</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Age</label>
        <input type="number" name="age" class="form-control" value="{{ old('age', $animal->age) }}">
    </div>

    <div class="mb-3">
        <label>État santé</label>
        <select name="etat_sante" class="form-control" required>
            <option value="sain" {{ $animal->etat_sante == 'sain' ? 'selected' : '' }}>Sain</option>
            <option value="malade léger" {{ $animal->etat_sante == 'malade léger' ? 'selected' : '' }}>Malade léger</option>
            <option value="malade grave" {{ $animal->etat_sante == 'malade grave' ? 'selected' : '' }}>Malade grave</option>
            <option value="blessé" {{ $animal->etat_sante == 'blessé' ? 'selected' : '' }}>Blessé</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Statut</label>
        <select name="statut" class="form-control" required>
            <option value="adopter" {{ $animal->statut == 'adopter' ? 'selected' : '' }}>À adopter</option>
            <option value="adopté" {{ $animal->statut == 'adopté' ? 'selected' : '' }}>Adopté</option>
            <option value="hébergé" {{ $animal->statut == 'hébergé' ? 'selected' : '' }}>Hébergé</option>
            <option value="assigner" {{ $animal->statut == 'assigner' ? 'selected' : '' }}>Assigné</option>
            <option value="à vacciner" {{ $animal->statut == 'à vacciner' ? 'selected' : '' }}>À vacciner</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Photo</label>
        <input type="file" name="photo" class="form-control">

        @if($animal->photo)
            <img src="{{ asset('storage/' . $animal->photo) }}" width="100" class="mt-2">
        @endif
    </div>

    <button type="submit" class="btn btn-success">Modifier</button>
</form>
@endsection
