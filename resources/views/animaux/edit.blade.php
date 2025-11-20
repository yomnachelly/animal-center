@extends('layouts.app')

@section('content')
<h1>Modifier Animal</h1>

<form action="{{ route('animaux.update', $animal->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nom</label>
        <input type="text" name="nom" class="form-control" value="{{ $animal->nom }}">
    </div>

    <div class="mb-3">
        <label>Espèce</label>
        <select name="espece_id" id="espece" class="form-control">
            @foreach($especes as $espece)
                <option value="{{ $espece->id }}" {{ $animal->espece_id == $espece->id ? 'selected' : '' }}>
                    {{ $espece->nom }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Race</label>
        <select name="race_id" id="race" class="form-control">
            @foreach($races as $race)
                <option value="{{ $race->id }}" {{ $animal->race_id == $race->id ? 'selected' : '' }}>
                    {{ $race->nom }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Sexe</label>
        <select name="sexe" class="form-control">
            <option value="feminin" {{ $animal->sexe == 'feminin' ? 'selected' : '' }}>Femelle</option>
            <option value="masculin" {{ $animal->sexe == 'masculin' ? 'selected' : '' }}>Mâle</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Âge</label>
        <input type="number" name="age" class="form-control" value="{{ $animal->age }}">
    </div>

    <div class="mb-3">
        <label>Photo</label>
        <input type="file" name="photo" class="form-control">

        @if($animal->photo)
            <img src="{{ asset('storage/'.$animal->photo) }}" width="80" class="mt-2">
        @endif
    </div>

    <button class="btn btn-success">Modifier</button>
</form>

<script>
document.getElementById('espece').addEventListener('change', function () {
    let especeId = this.value;

    fetch('/races/by-espece/' + especeId)
        .then(res => res.json())
        .then(data => {
            let raceSelect = document.getElementById('race');
            raceSelect.innerHTML = '';

            data.forEach(race => {
                raceSelect.innerHTML += `<option value="${race.id}">${race.nom}</option>`;
            });
        });
});
</script>

@endsection
