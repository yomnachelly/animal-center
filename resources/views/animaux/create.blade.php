@extends('layouts.app')

@section('content')
<h1>Ajouter un Animal</h1>

<!-- Boutons de gestion -->
<div class="mb-3">
    <a href="{{ route('especes.index') }}" class="btn btn-outline-primary btn-sm">Gérer les espèces</a>
    <a href="{{ route('races.index') }}" class="btn btn-outline-primary btn-sm">Gérer les races</a>
</div>

<form action="{{ route('animaux.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label>Nom</label>
        <input type="text" name="nom" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Espèce</label>
        <select name="espece_id" id="espece" class="form-control" required>
            <option value="">-- Choisir --</option>
            @foreach($especes as $espece)
                <option value="{{ $espece->id }}">{{ $espece->nom }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Race</label>
        <select name="race_id" id="race" class="form-control">
            <option value="">-- Choisir une espèce d'abord --</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Sexe</label>
        <select name="sexe" class="form-control">
            <option value="feminin">Femelle</option>
            <option value="masculin">Mâle</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Âge</label>
        <input type="number" name="age" class="form-control">
    </div>

    <div class="mb-3">
        <label>État de santé</label>
        <select name="etat_sante" class="form-control">
            <option value="sain">Sain</option>
            <option value="malade léger">Malade léger</option>
            <option value="malade grave">Malade grave</option>
            <option value="blessé">Blessé</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Statut</label>
        <select name="statut" class="form-control">
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

    <button class="btn btn-success">Ajouter</button>
</form>

<script>
document.getElementById('espece').addEventListener('change', function () {
    let especeId = this.value;

    fetch('/races/by-espece/' + especeId)
        .then(res => res.json())
        .then(data => {
            let raceSelect = document.getElementById('race');
            raceSelect.innerHTML = '<option value="">-- Sélectionner --</option>';

            data.forEach(race => {
                raceSelect.innerHTML += `<option value="${race.id}">${race.nom}</option>`;
            });
        });
});
</script>

@endsection
