@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Nouveau rendez-vous</h1>

    <form action="{{ route('client.rendez-vous.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Infos Animal -->
        <div class="card mb-4">
            <div class="card-header"><h5>Informations sur l'animal</h5></div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="nom_animal" class="form-label">Nom *</label>
                    <input type="text" name="nom_animal" id="nom_animal" class="form-control" required>
                </div>

                <!-- Espèce -->
                <div class="mb-3">
                    <label for="espece" class="form-label">Espèce *</label>
                    <select name="espece_id" id="espece" class="form-control" required>
                        <option value="">-- Choisir --</option>
                        @foreach($especes as $espece)
                            <option value="{{ $espece->id }}">{{ $espece->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Race dépendante -->
                <div class="mb-3">
                    <label for="race" class="form-label">Race *</label>
                    <select name="race_id" id="race" class="form-control" required disabled>
                        <option value="">-- Choisir une espèce d'abord --</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="age" class="form-label">Âge *</label>
                    <input type="number" name="age" id="age" class="form-control" min="0" required>
                </div>

                <div class="mb-3">
                    <label for="sexe" class="form-label">Sexe *</label>
                    <select name="sexe" id="sexe" class="form-select" required>
                        <option value="">Choisir</option>
                        <option value="masculin">Mâle</option>
                        <option value="feminin">Femelle</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="photo" class="form-label">Photo</label>
                    <input type="file" name="photo" id="photo" class="form-control">
                </div>
            </div>
        </div>

        <!-- Détails du rendez-vous -->
        <div class="card mb-4">
            <div class="card-header"><h5>Détails du rendez-vous</h5></div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="type_rdv" class="form-label">Type de rendez-vous *</label>
                    <select name="type_rdv" id="type_rdv" class="form-select" required>
                        <option value="">Choisir</option>
                        <option value="soin">Soin</option>
                        <option value="vaccin">Vaccin</option>
                    </select>
                </div>

                <div class="mb-3" id="soins-section" style="display: none;">
                    <label class="form-label">Soins demandés *</label>
                    <div class="row">
                        @foreach($soins as $soin)
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="soins[]" value="{{ $soin->id }}" id="soin{{ $soin->id }}">
                                <label class="form-check-label" for="soin{{ $soin->id }}">{{ $soin->nom }}</label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="mb-3" id="vaccins-section" style="display: none;">
                    <label class="form-label">Vaccins demandés *</label>
                    <div class="row">
                        @foreach($vaccins as $vaccin)
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="vaccins[]" value="{{ $vaccin->id }}" id="vaccin{{ $vaccin->id }}">
                                <label class="form-check-label" for="vaccin{{ $vaccin->id }}">{{ $vaccin->nom }}</label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="mb-3">
                    <label for="date" class="form-label">Date du rendez-vous *</label>
                    <input type="date" name="date" id="date" class="form-control" min="{{ date('Y-m-d') }}" required>
                </div>
            </div>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Prendre rendez-vous</button>
            <a href="{{ route('client.rendez-vous') }}" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const especeSelect = document.getElementById('espece');
    const raceSelect = document.getElementById('race');
    const typeSelect = document.getElementById('type_rdv');

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
                })
                .catch(err => console.error(err));
        }
    });

    // Type de rendez-vous -> afficher soins / vaccins
    typeSelect.addEventListener('change', function() {
        const type = this.value;
        document.getElementById('soins-section').style.display = type === 'soin' ? 'block' : 'none';
        document.getElementById('vaccins-section').style.display = type === 'vaccin' ? 'block' : 'none';
    });

    // Empêcher les dates passées
    document.getElementById('date').min = new Date().toISOString().split('T')[0];
});
</script>
@endsection
