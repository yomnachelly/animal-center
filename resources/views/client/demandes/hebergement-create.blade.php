@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Nouvelle demande d'hébergement</h2>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <!-- AJOUT DE enctype="multipart/form-data" POUR L'UPLOAD DE FICHIERS -->
            <form action="{{ route('client.demandes.hebergement.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Infos Animal -->
                <div class="card mb-4">
                    <div class="card-header"><h5>Informations sur l'animal</h5></div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="nom_animal" class="form-label">Nom *</label>
                            <input type="text" name="nom_animal" id="nom_animal" class="form-control" value="{{ old('nom_animal') }}" required>
                            @error('nom_animal')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Espèce -->
                        <div class="mb-3">
                            <label for="espece" class="form-label">Espèce *</label>
                            <select name="espece_id" id="espece" class="form-control" required>
                                <option value="">-- Choisir --</option>
                                @foreach($especes as $espece)
                                    <option value="{{ $espece->id }}" {{ old('espece_id') == $espece->id ? 'selected' : '' }}>
                                        {{ $espece->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('espece_id')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Race dépendante -->
                        <div class="mb-3">
                            <label for="race" class="form-label">Race *</label>
                            <select name="race_id" id="race" class="form-control" required disabled>
                                <option value="">-- Choisir une espèce d'abord --</option>
                                @if(old('race_id'))
                                    @php
                                        $oldRace = \App\Models\Race::find(old('race_id'));
                                    @endphp
                                    @if($oldRace)
                                        <option value="{{ $oldRace->id }}" selected>{{ $oldRace->nom }}</option>
                                    @endif
                                @endif
                            </select>
                            @error('race_id')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="age" class="form-label">Âge *</label>
                            <input type="number" name="age" id="age" class="form-control" min="0" value="{{ old('age') }}" required>
                            @error('age')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="sexe" class="form-label">Sexe *</label>
                            <select name="sexe" id="sexe" class="form-select" required>
                                <option value="">Choisir</option>
                                <option value="masculin" {{ old('sexe') == 'masculin' ? 'selected' : '' }}>Mâle</option>
                                <option value="feminin" {{ old('sexe') == 'feminin' ? 'selected' : '' }}>Femelle</option>
                            </select>
                            @error('sexe')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="photo" class="form-label">Photo</label>
                            <input type="file" name="photo" id="photo" class="form-control" accept="image/jpeg,image/png,image/jpg,image/gif">
                            @error('photo')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Formats acceptés: JPEG, PNG, JPG, GIF. Taille max: 2MB</div>
                        </div>
                    </div>
                </div>

                <h5 class="mb-3 mt-4">Période d'hébergement</h5>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="date_debut" class="form-label">Date de début *</label>
                            <input type="date" class="form-control @error('date_debut') is-invalid @enderror" 
                                   id="date_debut" name="date_debut" value="{{ old('date_debut') }}" 
                                   min="{{ date('Y-m-d') }}" required>
                            @error('date_debut')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="date_fin" class="form-label">Date de fin *</label>
                            <input type="date" class="form-control @error('date_fin') is-invalid @enderror" 
                                   id="date_fin" name="date_fin" value="{{ old('date_fin') }}" required>
                            @error('date_fin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="motif" class="form-label">Motif (optionnel)</label>
                    <textarea class="form-control @error('motif') is-invalid @enderror" 
                              id="motif" name="motif" rows="3">{{ old('motif') }}</textarea>
                    @error('motif')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('client.demandes.hebergement') }}" class="btn btn-secondary me-md-2">Annuler</a>
                    <button type="submit" class="btn btn-primary">Soumettre la demande</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Script pour valider que la date de fin est après la date de début
document.getElementById('date_debut').addEventListener('change', function() {
    const dateDebut = this.value;
    const dateFin = document.getElementById('date_fin');
    
    if (dateDebut) {
        dateFin.min = dateDebut;
        
        // Si la date de fin actuelle est avant la nouvelle date de début, la réinitialiser
        if (dateFin.value && dateFin.value < dateDebut) {
            dateFin.value = '';
        }
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const especeSelect = document.getElementById('espece');
    const raceSelect = document.getElementById('race');
    
    // Dépendance Espèce -> Race
    especeSelect.addEventListener('change', function() {
        const especeId = this.value;
        raceSelect.innerHTML = '<option value="">-- Choisir --</option>';
        raceSelect.disabled = !especeId;

        if(especeId) {
            fetch(`/races/by-espece/${especeId}`)
                .then(res => res.json())
                .then(data => {
                    data.forEach(race => {
                        const option = document.createElement('option');
                        option.value = race.id;
                        option.textContent = race.nom;
                        raceSelect.appendChild(option);
                    });
                    
                    // Sélectionner l'ancienne valeur si elle existe
                    const oldRaceId = "{{ old('race_id') }}";
                    if (oldRaceId) {
                        raceSelect.value = oldRaceId;
                    }
                })
                .catch(err => console.error(err));
        }
    });

    // Déclencher le changement au chargement si une espèce est déjà sélectionnée
    if (especeSelect.value) {
        especeSelect.dispatchEvent(new Event('change'));
    }
});
</script>
@endsection