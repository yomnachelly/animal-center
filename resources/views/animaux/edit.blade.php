@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <style>
        .form-container {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 900px;
            margin: 0 auto;
        }
        
        .form-header {
            background: linear-gradient(135deg, #f39c12, #e67e22);
            color: white;
            padding: 30px;
            border-radius: 15px 15px 0 0;
            margin-bottom: 0;
            text-align: center;
        }
        
        .form-title {
            font-weight: 700;
            margin: 0;
            font-size: 2rem;
        }
        
        .form-subtitle {
            opacity: 0.9;
            margin: 10px 0 0 0;
            font-size: 1.1rem;
        }
        
        .form-card {
            background: white;
            border-radius: 0 0 15px 15px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        
        .form-group {
            margin-bottom: 30px;
        }
        
        .form-label {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 10px;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
        }
        
        .form-label i {
            margin-right: 10px;
            color: #f39c12;
            font-size: 1.2rem;
        }
        
        .form-control-custom {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 15px 20px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }
        
        .form-control-custom:focus {
            border-color: #f39c12;
            background: white;
            box-shadow: 0 0 0 0.2rem rgba(243, 156, 18, 0.1);
            transform: translateY(-2px);
        }
        
        .form-control-custom:hover {
            border-color: #ced4da;
            background: white;
        }
        
        .btn-warning-custom {
            background: linear-gradient(135deg, #f39c12, #e67e22);
            border: none;
            color: white;
            padding: 15px 40px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(243, 156, 18, 0.3);
        }
        
        .btn-warning-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(243, 156, 18, 0.4);
            background: linear-gradient(135deg, #e67e22, #d35400);
            color: white;
        }
        
        .btn-secondary-custom {
            background: linear-gradient(135deg, #6c757d, #868e96);
            border: none;
            color: white;
            padding: 15px 40px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(108, 117, 125, 0.3);
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        
        .btn-secondary-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(108, 117, 125, 0.4);
            background: linear-gradient(135deg, #5a6268, #727b84);
            color: white;
        }
        
        .btn-outline-primary-custom {
            background: transparent;
            border: 2px solid #3498db;
            color: #3498db;
            padding: 10px 20px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        
        .btn-outline-primary-custom:hover {
            background: #3498db;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
        }
        
        .form-actions {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 40px;
            flex-wrap: wrap;
        }
        
        .form-help {
            background: linear-gradient(135deg, #fff3cd, #ffeaa7);
            border-left: 4px solid #f39c12;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
        }
        
        .form-help-title {
            color: #856404;
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 1.1rem;
        }
        
        .form-help-text {
            color: #856404;
            margin: 0;
            font-size: 0.95rem;
        }
        
        .input-icon {
            position: relative;
        }
        
        .input-icon i {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            z-index: 2;
        }
        
        .input-icon .form-control-custom {
            padding-left: 50px;
        }
        
        .management-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }
        
        .photo-preview {
            width: 150px;
            height: 150px;
            border-radius: 10px;
            object-fit: cover;
            border: 2px solid #f39c12;
            margin-top: 10px;
        }
        
        .photo-upload-area {
            border: 2px dashed #f39c12;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            background: #fef9e7;
            transition: all 0.3s ease;
            cursor: pointer;
            margin-bottom: 15px;
        }
        
        .photo-upload-area:hover {
            background: #fcf3cf;
            border-color: #e67e22;
        }
        
        .photo-upload-area i {
            font-size: 2rem;
            color: #f39c12;
            margin-bottom: 10px;
        }
        
        .current-photo {
            text-align: center;
            margin-top: 20px;
        }
        
        .current-photo-label {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 10px;
            display: block;
        }
        
        @media (max-width: 768px) {
            .form-header {
                padding: 20px;
            }
            
            .form-card {
                padding: 25px;
            }
            
            .form-actions, .management-buttons {
                flex-direction: column;
            }
            
            .btn-warning-custom,
            .btn-secondary-custom,
            .btn-outline-primary-custom {
                width: 100%;
                padding: 12px 30px;
            }
        }
        
        .floating-animation {
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .form-col {
            flex: 1;
        }
        
        .animal-info-badge {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin: 5px;
        }
        
        @media (max-width: 768px) {
            .form-row {
                flex-direction: column;
                gap: 0;
            }
        }
        
        .status-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        
        .status-adopter { background: #ffeaa7; color: #856404; }
        .status-adopté { background: #d4edda; color: #155724; }
        .status-hébergé { background: #d1ecf1; color: #0c5460; }
        .status-assigner { background: #e2e3e5; color: #383d41; }
        .status-vacciner { background: #f8d7da; color: #721c24; }
    </style>

    <div class="form-container">
        <!-- En-tête du formulaire -->
        <div class="form-header">
            <h1 class="form-title floating-animation">
                <i class="fas fa-edit me-2"></i>Modifier l'Animal
            </h1>
            <p class="form-subtitle">Mettez à jour les informations de {{ $animal->nom }}</p>
        </div>

        <!-- Carte du formulaire -->
        <div class="form-card">
            <!-- Informations actuelles -->
            <div class="form-help">
                <div class="form-help-title">
                    <i class="fas fa-info-circle me-2"></i>Informations actuelles
                </div>
                <div class="d-flex flex-wrap gap-2 mt-3">
                    <span class="animal-info-badge">
                        <i class="fas fa-dog"></i>{{ $animal->espece->nom }}
                    </span>
                    @if($animal->race)
                    <span class="animal-info-badge">
                        <i class="fas fa-list"></i>{{ $animal->race->nom }}
                    </span>
                    @endif
                    <span class="animal-info-badge">
                        <i class="fas fa-venus-mars"></i>{{ $animal->sexe == 'feminin' ? 'Femelle' : 'Mâle' }}
                    </span>
                    <span class="animal-info-badge">
                        <i class="fas fa-birthday-cake"></i>{{ $animal->age ?? 'N/A' }} ans
                    </span>
                    <span class="status-badge status-{{ str_replace(' ', '-', $animal->statut) }}">
                        <i class="fas fa-home"></i>{{ ucfirst($animal->statut) }}
                    </span>
                </div>
            </div>

            <form action="{{ route('animaux.update', $animal->id) }}" method="POST" enctype="multipart/form-data" id="animal-form">
                @csrf
                @method('PUT')

                <div class="form-row">
                    <!-- Nom de l'animal -->
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-signature"></i>Nom de l'animal
                            </label>
                            <div class="input-icon">
                                <i class="fas fa-paw"></i>
                                <input type="text" name="nom" class="form-control form-control-custom" 
                                       value="{{ $animal->nom }}" 
                                       placeholder="Ex: Max, Bella, Luna..." 
                                       required>
                            </div>
                        </div>
                    </div>

                    <!-- Âge -->
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-birthday-cake"></i>Âge (années)
                            </label>
                            <div class="input-icon">
                                <i class="fas fa-calendar-alt"></i>
                                <input type="number" name="age" class="form-control form-control-custom" 
                                       value="{{ $animal->age }}" 
                                       placeholder="Ex: 2" min="0" max="30">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <!-- Espèce -->
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-dog"></i>Espèce
                            </label>
                            <select name="espece_id" id="espece" class="form-control form-control-custom" required>
                                @foreach($especes as $espece)
                                    <option value="{{ $espece->id }}" {{ $animal->espece_id == $espece->id ? 'selected' : '' }}>
                                        {{ $espece->nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Race -->
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-list"></i>Race
                            </label>
                            <select name="race_id" id="race" class="form-control form-control-custom">
                                @foreach($races as $race)
                                    <option value="{{ $race->id }}" {{ $animal->race_id == $race->id ? 'selected' : '' }}>
                                        {{ $race->nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <!-- Sexe -->
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-venus-mars"></i>Sexe
                            </label>
                            <select name="sexe" class="form-control form-control-custom">
                                <option value="feminin" {{ $animal->sexe == 'feminin' ? 'selected' : '' }}>Femelle</option>
                                <option value="masculin" {{ $animal->sexe == 'masculin' ? 'selected' : '' }}>Mâle</option>
                            </select>
                        </div>
                    </div>

                    <!-- État de santé -->
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-heartbeat"></i>État de santé
                            </label>
                            <select name="etat_sante" class="form-control form-control-custom">
                                <option value="sain" {{ $animal->etat_sante == 'sain' ? 'selected' : '' }}>Sain</option>
                                <option value="malade léger" {{ $animal->etat_sante == 'malade léger' ? 'selected' : '' }}>Malade léger</option>
                                <option value="malade grave" {{ $animal->etat_sante == 'malade grave' ? 'selected' : '' }}>Malade grave</option>
                                <option value="blessé" {{ $animal->etat_sante == 'blessé' ? 'selected' : '' }}>Blessé</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Statut -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-home"></i>Statut
                    </label>
                    <select name="statut" class="form-control form-control-custom">
                        <option value="adopter" {{ $animal->statut == 'adopter' ? 'selected' : '' }}>À adopter</option>
                        <option value="adopté" {{ $animal->statut == 'adopté' ? 'selected' : '' }}>Adopté</option>
                        <option value="hébergé" {{ $animal->statut == 'hébergé' ? 'selected' : '' }}>Hébergé</option>
                        <option value="assigner" {{ $animal->statut == 'assigner' ? 'selected' : '' }}>Assigné</option>
                        <option value="à vacciner" {{ $animal->statut == 'à vacciner' ? 'selected' : '' }}>À vacciner</option>
                    </select>
                </div>

                <!-- Photo -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-camera"></i>Photo de l'animal
                    </label>
                    
                    <!-- Photo actuelle -->
                    @if($animal->photo)
                    <div class="current-photo">
                        <span class="current-photo-label">
                            <i class="fas fa-image me-2"></i>Photo actuelle :
                        </span>
                        <img src="{{ asset('storage/'.$animal->photo) }}" class="photo-preview" alt="Photo de {{ $animal->nom }}">
                    </div>
                    @endif

                    <!-- Zone de téléchargement -->
                    <div class="photo-upload-area" id="photo-upload-area">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <p>Cliquez pour changer la photo</p>
                        <small class="text-muted">Laisser vide pour conserver la photo actuelle</small>
                        <input type="file" name="photo" id="photo-input" class="d-none" accept="image/*">
                    </div>
                    <img id="photo-preview" class="photo-preview d-none" src="#" alt="Nouvelle photo">
                </div>

                <!-- Actions du formulaire -->
                <div class="form-actions">
                    <button type="submit" class="btn btn-warning-custom">
                        <i class="fas fa-save me-2"></i>Mettre à jour
                    </button>
                    <a href="{{ route('animaux.index') }}" class="btn btn-secondary-custom">
                        <i class="fas fa-arrow-left me-2"></i>Retour à la liste
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation des champs au focus
    const inputs = document.querySelectorAll('.form-control-custom');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.style.transform = 'translateY(-2px)';
            this.style.boxShadow = '0 5px 15px rgba(243, 156, 18, 0.2)';
        });
        
        input.addEventListener('blur', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = 'none';
        });
    });
    
    // Gestion de l'upload de photo
    const photoUploadArea = document.getElementById('photo-upload-area');
    const photoInput = document.getElementById('photo-input');
    const photoPreview = document.getElementById('photo-preview');
    
    photoUploadArea.addEventListener('click', function() {
        photoInput.click();
    });
    
    photoInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                photoPreview.src = e.target.result;
                photoPreview.classList.remove('d-none');
                photoPreview.classList.add('d-block');
            }
            
            reader.readAsDataURL(this.files[0]);
        }
    });
    
    // Chargement dynamique des races
    document.getElementById('espece').addEventListener('change', function () {
        let especeId = this.value;
        let raceSelect = document.getElementById('race');
        let currentRaceId = {{ $animal->race_id ?? 'null' }};
        
        // Afficher un indicateur de chargement
        raceSelect.innerHTML = '<option value="">Chargement...</option>';
        
        fetch('/races/by-espece/' + especeId)
            .then(res => {
                if (!res.ok) throw new Error('Erreur de chargement');
                return res.json();
            })
            .then(data => {
                raceSelect.innerHTML = '<option value="">-- Sélectionner --</option>';
                
                if (data.length === 0) {
                    raceSelect.innerHTML += '<option value="">Aucune race disponible</option>';
                } else {
                    data.forEach(race => {
                        const selected = race.id == currentRaceId ? 'selected' : '';
                        raceSelect.innerHTML += `<option value="${race.id}" ${selected}>${race.nom}</option>`;
                    });
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                raceSelect.innerHTML = '<option value="">Erreur de chargement</option>';
            });
    });
    
    // Validation en temps réel
    const form = document.getElementById('animal-form');
    const nomInput = document.querySelector('input[name="nom"]');
    const ageInput = document.querySelector('input[name="age"]');
    
    nomInput.addEventListener('input', function() {
        if (this.value.length < 2) {
            this.style.borderColor = '#dc3545';
            this.style.background = '#f8d7da';
        } else {
            this.style.borderColor = '#28a745';
            this.style.background = '#f8f9fa';
        }
    });
    
    ageInput.addEventListener('input', function() {
        if (this.value < 0 || this.value > 30) {
            this.style.borderColor = '#dc3545';
            this.style.background = '#f8d7da';
        } else {
            this.style.borderColor = '#28a745';
            this.style.background = '#f8f9fa';
        }
    });
    
    // Confirmation avant soumission
    form.addEventListener('submit', function(e) {
        const nom = document.querySelector('input[name="nom"]').value;
        const espece = document.querySelector('select[name="espece_id"]');
        const especeText = espece.options[espece.selectedIndex].text;
        
        if (!confirm(`Confirmez-vous la modification de l'animal "${nom}" (${especeText}) ?`)) {
            e.preventDefault();
        }
    });
});
</script>
@endsection