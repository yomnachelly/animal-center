@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    <style>
        .hebergement-form-container {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 900px;
            margin: 0 auto;
        }
        
        .page-header {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            padding: 50px 40px;
            border-radius: 25px;
            margin-bottom: 40px;
            box-shadow: 0 20px 40px rgba(79, 172, 254, 0.3);
            position: relative;
            overflow: hidden;
        }
        
        .page-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
            transform: rotate(45deg);
        }
        
        .page-title {
            font-weight: 800;
            margin: 0;
            font-size: 3rem;
            position: relative;
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .page-subtitle {
            opacity: 0.9;
            margin: 15px 0 0 0;
            font-size: 1.3rem;
            font-weight: 300;
            position: relative;
        }
        
        .alert-danger-custom {
            background: linear-gradient(135deg, #f8d7da, #f5c6cb);
            border: none;
            border-left: 5px solid #dc3545;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 40px;
            box-shadow: 0 10px 25px rgba(220, 53, 69, 0.2);
            position: relative;
            overflow: hidden;
        }
        
        .form-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            border: 1px solid #f0f0f0;
            position: relative;
            overflow: hidden;
        }
        
        .form-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(135deg, #4facfe, #00f2fe);
        }
        
        .card-header-custom {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border: none;
            border-radius: 15px;
            padding: 25px 30px;
            margin-bottom: 30px;
            border-left: 4px solid #4facfe;
        }
        
        .card-title-custom {
            font-weight: 700;
            color: #2c3e50;
            margin: 0;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .form-group {
            margin-bottom: 30px;
        }
        
        .form-label {
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 12px;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .form-label i {
            color: #4facfe;
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
            border-color: #4facfe;
            background: white;
            box-shadow: 0 0 0 0.2rem rgba(79, 172, 254, 0.1);
            transform: translateY(-2px);
        }
        
        .form-control-custom:hover {
            border-color: #ced4da;
            background: white;
        }
        
        .form-control-custom.is-invalid {
            border-color: #dc3545;
            background: #f8d7da;
        }
        
        .invalid-feedback {
            color: #dc3545;
            font-weight: 600;
            margin-top: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .form-text {
            color: #6c757d;
            font-size: 0.9rem;
            margin-top: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
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
        
        .photo-upload-area {
            border: 2px dashed #4facfe;
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            background: #f8f9fa;
            transition: all 0.3s ease;
            cursor: pointer;
            margin-bottom: 15px;
        }
        
        .photo-upload-area:hover {
            background: #e3f2fd;
            border-color: #3a9dfc;
        }
        
        .photo-upload-area i {
            font-size: 3rem;
            color: #4facfe;
            margin-bottom: 15px;
        }
        
        .photo-preview {
            width: 150px;
            height: 150px;
            border-radius: 15px;
            object-fit: cover;
            border: 2px solid #4facfe;
            margin-top: 15px;
            display: none;
        }
        
        .btn-primary-custom {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            border: none;
            color: white;
            padding: 15px 40px;
            border-radius: 25px;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(79, 172, 254, 0.3);
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }
        
        .btn-primary-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(79, 172, 254, 0.4);
            background: linear-gradient(135deg, #3a9dfc 0%, #00d9e6 100%);
            color: white;
        }
        
        .btn-secondary-custom {
            background: linear-gradient(135deg, #6c757d, #868e96);
            border: none;
            color: white;
            padding: 15px 40px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(108, 117, 125, 0.3);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }
        
        .btn-secondary-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(108, 117, 125, 0.4);
            background: linear-gradient(135deg, #5a6268, #727b84);
            color: white;
        }
        
        .form-actions {
            display: flex;
            gap: 20px;
            justify-content: center;
            margin-top: 40px;
            flex-wrap: wrap;
        }
        
        .form-help {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            border-left: 4px solid #2196f3;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
        }
        
        .form-help-title {
            color: #1976d2;
            font-weight: 700;
            margin-bottom: 10px;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .form-help-text {
            color: #1565c0;
            margin: 0;
            font-size: 0.95rem;
            line-height: 1.5;
        }
        
        .required-field::after {
            content: " *";
            color: #dc3545;
        }
        
        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }
        
        .date-period-card {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
            border-left: 4px solid #4facfe;
        }
        
        .period-title {
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .date-input-group {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
        }
        
        .date-connector {
            color: #6c757d;
            font-weight: 600;
            font-size: 1.2rem;
        }
        
        .duration-display {
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: 600;
            text-align: center;
            margin-top: 15px;
            display: none;
        }
        
        .character-count {
            text-align: right;
            font-size: 0.85rem;
            color: #6c757d;
            margin-top: 5px;
            font-weight: 600;
        }
        
        .character-count.warning {
            color: #ff9800;
        }
        
        .character-count.danger {
            color: #f44336;
        }
        
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        
        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        @media (max-width: 768px) {
            .page-header {
                padding: 30px 20px;
                text-align: center;
            }
            
            .page-title {
                font-size: 2.2rem;
                flex-direction: column;
                gap: 10px;
            }
            
            .form-card {
                padding: 25px 20px;
            }
            
            .form-actions {
                flex-direction: column;
            }
            
            .btn-primary-custom,
            .btn-secondary-custom {
                width: 100%;
                padding: 12px 30px;
            }
            
            .form-row {
                grid-template-columns: 1fr;
            }
            
            .date-input-group {
                flex-direction: column;
                gap: 10px;
            }
            
            .date-connector {
                transform: rotate(90deg);
            }
        }
        
        .form-feedback {
            display: none;
            padding: 12px 15px;
            border-radius: 8px;
            margin-top: 8px;
            font-size: 0.9rem;
            font-weight: 600;
        }
        
        .form-feedback.valid {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .form-feedback.invalid {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .loading-spinner {
            display: none;
            text-align: center;
            padding: 20px;
        }
    </style>

    <div class="hebergement-form-container">
        <!-- En-tête de page -->
        <div class="page-header">
            <h1 class="page-title floating">
                <i class="fas fa-home"></i>
                Nouvelle Demande d'Hébergement
            </h1>
            <p class="page-subtitle">Demandez l'hébergement temporaire de votre animal</p>
        </div>

        <!-- Message d'erreur -->
        @if(session('error'))
            <div class="alert alert-danger-custom">
                <div class="d-flex align-items-center">
                    <i class="fas fa-exclamation-triangle me-3" style="font-size: 2rem; color: #dc3545;"></i>
                    <div>
                        <h4 class="mb-2" style="color: #721c24;">Attention</h4>
                        <p class="mb-0" style="color: #721c24; font-size: 1.1rem;">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <form action="{{ route('client.demandes.hebergement.store') }}" method="POST" enctype="multipart/form-data" id="hebergementForm">
            @csrf

            <!-- Informations sur l'animal -->
            <div class="form-card">
                <div class="card-header-custom">
                    <h3 class="card-title-custom">
                        <i class="fas fa-paw"></i>
                        Informations sur l'animal
                    </h3>
                </div>

                <!-- Aide contextuelle -->
                <div class="form-help">
                    <div class="form-help-title">
                        <i class="fas fa-info-circle"></i>
                        Informations importantes
                    </div>
                    <p class="form-help-text">
                        Renseignez les informations complètes de votre animal. Ces données nous aideront à mieux préparer son hébergement.
                    </p>
                </div>

                <div class="form-row">
                    <!-- Nom de l'animal -->
                    <div class="form-group">
                        <label for="nom_animal" class="form-label required-field">
                            <i class="fas fa-signature"></i>Nom de l'animal
                        </label>
                        <div class="input-icon">
                            <i class="fas fa-paw"></i>
                            <input type="text" name="nom_animal" id="nom_animal" class="form-control form-control-custom @error('nom_animal') is-invalid @enderror" 
                                   value="{{ old('nom_animal') }}" 
                                   placeholder="Ex: Max, Bella, Luna..." 
                                   maxlength="50"
                                   required>
                        </div>
                        @error('nom_animal')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="character-count">
                            <span id="nameCharCount">{{ strlen(old('nom_animal', '')) }}</span>/50 caractères
                        </div>
                    </div>

                    <!-- Âge -->
                    <div class="form-group">
                        <label for="age" class="form-label required-field">
                            <i class="fas fa-birthday-cake"></i>Âge
                        </label>
                        <div class="input-icon">
                            <i class="fas fa-calendar-alt"></i>
                            <input type="number" name="age" id="age" class="form-control form-control-custom @error('age') is-invalid @enderror" 
                                   value="{{ old('age') }}" 
                                   placeholder="Ex: 2" 
                                   min="0" 
                                   max="30"
                                   required>
                        </div>
                        @error('age')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <!-- Espèce -->
                    <div class="form-group">
                        <label for="espece" class="form-label required-field">
                            <i class="fas fa-dog"></i>Espèce
                        </label>
                        <select name="espece_id" id="espece" class="form-control form-control-custom @error('espece_id') is-invalid @enderror" required>
                            <option value="">-- Choisir une espèce --</option>
                            @foreach($especes as $espece)
                                <option value="{{ $espece->id }}" {{ old('espece_id') == $espece->id ? 'selected' : '' }}>
                                    {{ $espece->nom }}
                                </option>
                            @endforeach
                        </select>
                        @error('espece_id')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Race -->
                    <div class="form-group">
                        <label for="race" class="form-label required-field">
                            <i class="fas fa-list"></i>Race
                        </label>
                        <select name="race_id" id="race" class="form-control form-control-custom @error('race_id') is-invalid @enderror" required disabled>
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
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <!-- Sexe -->
                    <div class="form-group">
                        <label for="sexe" class="form-label required-field">
                            <i class="fas fa-venus-mars"></i>Sexe
                        </label>
                        <select name="sexe" id="sexe" class="form-control form-control-custom @error('sexe') is-invalid @enderror" required>
                            <option value="">-- Choisir --</option>
                            <option value="masculin" {{ old('sexe') == 'masculin' ? 'selected' : '' }}>Mâle</option>
                            <option value="feminin" {{ old('sexe') == 'feminin' ? 'selected' : '' }}>Femelle</option>
                        </select>
                        @error('sexe')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Photo -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-camera"></i>Photo de l'animal
                        </label>
                        <div class="photo-upload-area" id="photo-upload-area">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <p>Cliquez pour télécharger une photo</p>
                            <small class="text-muted">Formats acceptés: JPEG, PNG, JPG, GIF (Max: 2MB)</small>
                            <input type="file" name="photo" id="photo" class="d-none" accept="image/jpeg,image/png,image/jpg,image/gif">
                        </div>
                        <img id="photo-preview" class="photo-preview" src="#" alt="Aperçu de la photo">
                        @error('photo')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Période d'hébergement -->
            <div class="form-card">
                <div class="card-header-custom">
                    <h3 class="card-title-custom">
                        <i class="fas fa-calendar-alt"></i>
                        Période d'Hébergement
                    </h3>
                </div>

                <!-- Aide contextuelle -->
                <div class="form-help">
                    <div class="form-help-title">
                        <i class="fas fa-clock"></i>
                        Durée d'hébergement
                    </div>
                    <p class="form-help-text">
                        Sélectionnez la période pendant laquelle vous souhaitez que votre animal soit hébergé. 
                        La durée minimale est de 1 jour.
                    </p>
                </div>

                <div class="date-period-card">
                    <h4 class="period-title">
                        <i class="fas fa-calendar-week"></i>
                        Dates d'hébergement
                    </h4>
                    
                    <div class="date-input-group">
                        <div class="form-group" style="flex: 1;">
                            <label for="date_debut" class="form-label required-field">
                                <i class="fas fa-play"></i>Date de début
                            </label>
                            <div class="input-icon">
                                <i class="fas fa-calendar"></i>
                                <input type="date" name="date_debut" id="date_debut" 
                                       class="form-control form-control-custom @error('date_debut') is-invalid @enderror" 
                                       value="{{ old('date_debut') }}" 
                                       min="{{ date('Y-m-d') }}" 
                                       required>
                            </div>
                            @error('date_debut')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="date-connector">
                            <i class="fas fa-arrow-right"></i>
                        </div>

                        <div class="form-group" style="flex: 1;">
                            <label for="date_fin" class="form-label required-field">
                                <i class="fas fa-stop"></i>Date de fin
                            </label>
                            <div class="input-icon">
                                <i class="fas fa-calendar"></i>
                                <input type="date" name="date_fin" id="date_fin" 
                                       class="form-control form-control-custom @error('date_fin') is-invalid @enderror" 
                                       value="{{ old('date_fin') }}" 
                                       required>
                            </div>
                            @error('date_fin')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div id="durationDisplay" class="duration-display">
                        <i class="fas fa-clock me-2"></i>
                        <span id="durationText">0 jour</span>
                    </div>
                </div>
            </div>

            <!-- Actions du formulaire -->
            <div class="form-actions">
                <a href="{{ route('client.demandes.hebergement') }}" class="btn-secondary-custom">
                    <i class="fas fa-arrow-left"></i>
                    Retour aux demandes
                </a>
                <button type="submit" class="btn-primary-custom" id="submitBtn">
                    <i class="fas fa-paper-plane"></i>
                    Soumettre la demande
                </button>
            </div>

            <!-- Indicateur de chargement -->
            <div class="loading-spinner" id="loadingSpinner">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Traitement en cours...</span>
                </div>
                <p class="mt-2 text-muted">Validation des données en cours...</p>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const especeSelect = document.getElementById('espece');
    const raceSelect = document.getElementById('race');
    const dateDebutInput = document.getElementById('date_debut');
    const dateFinInput = document.getElementById('date_fin');
    const durationDisplay = document.getElementById('durationDisplay');
    const durationText = document.getElementById('durationText');
    const nomAnimalInput = document.getElementById('nom_animal');
    const photoInput = document.getElementById('photo');
    const photoPreview = document.getElementById('photo-preview');
    const photoUploadArea = document.getElementById('photo-upload-area');
    const form = document.getElementById('hebergementForm');
    const submitBtn = document.getElementById('submitBtn');
    const loadingSpinner = document.getElementById('loadingSpinner');

    // Compteur de caractères pour le nom
    nomAnimalInput.addEventListener('input', function() {
        const length = this.value.length;
        document.getElementById('nameCharCount').textContent = length;
        
        if (length > 40) {
            document.getElementById('nameCharCount').classList.add('warning');
        } else if (length > 45) {
            document.getElementById('nameCharCount').classList.add('danger');
        } else {
            document.getElementById('nameCharCount').classList.remove('warning', 'danger');
        }
    });

    // Gestion de l'upload de photo
    photoUploadArea.addEventListener('click', function() {
        photoInput.click();
    });
    
    photoInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const file = this.files[0];
            
            // Validation de la taille
            if (file.size > 2 * 1024 * 1024) {
                alert('Le fichier est trop volumineux. Taille maximale: 2MB');
                this.value = '';
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(e) {
                photoPreview.src = e.target.result;
                photoPreview.style.display = 'block';
                photoUploadArea.style.display = 'none';
            }
            reader.readAsDataURL(file);
        }
    });

    // Dépendance Espèce -> Race
    especeSelect.addEventListener('change', function() {
        const especeId = this.value;
        raceSelect.innerHTML = '<option value="">Chargement...</option>';
        raceSelect.disabled = !especeId;

        if(especeId) {
            fetch(`/races/by-espece/${especeId}`)
                .then(res => {
                    if (!res.ok) throw new Error('Erreur de chargement');
                    return res.json();
                })
                .then(data => {
                    raceSelect.innerHTML = '<option value="">-- Choisir --</option>';
                    
                    if (data.length === 0) {
                        raceSelect.innerHTML += '<option value="">Aucune race disponible</option>';
                    } else {
                        data.forEach(race => {
                            const option = document.createElement('option');
                            option.value = race.id;
                            option.textContent = race.nom;
                            raceSelect.appendChild(option);
                        });
                    }
                    
                    // Sélectionner l'ancienne valeur si elle existe
                    const oldRaceId = "{{ old('race_id') }}";
                    if (oldRaceId) {
                        raceSelect.value = oldRaceId;
                    }
                })
                .catch(err => {
                    console.error(err);
                    raceSelect.innerHTML = '<option value="">Erreur de chargement</option>';
                });
        }
    });

    // Calcul de la durée d'hébergement
    function calculateDuration() {
        const dateDebut = new Date(dateDebutInput.value);
        const dateFin = new Date(dateFinInput.value);
        
        if (dateDebutInput.value && dateFinInput.value && dateFin > dateDebut) {
            const diffTime = Math.abs(dateFin - dateDebut);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            
            durationText.textContent = `${diffDays} jour${diffDays > 1 ? 's' : ''}`;
            durationDisplay.style.display = 'block';
        } else {
            durationDisplay.style.display = 'none';
        }
    }

    // Validation des dates
    dateDebutInput.addEventListener('change', function() {
        const dateDebut = this.value;
        
        if (dateDebut) {
            dateFinInput.min = dateDebut;
            
            // Si la date de fin actuelle est avant la nouvelle date de début, la réinitialiser
            if (dateFinInput.value && dateFinInput.value < dateDebut) {
                dateFinInput.value = '';
            }
            
            calculateDuration();
        }
    });

    dateFinInput.addEventListener('change', calculateDuration);

    // Animation des champs au focus
    const inputs = document.querySelectorAll('.form-control-custom');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.style.transform = 'translateY(-2px)';
        });
        
        input.addEventListener('blur', function() {
            this.style.transform = 'translateY(0)';
        });
    });

    // Validation avant soumission
    function validateForm() {
        let isValid = true;
        
        // Validation des dates
        if (dateDebutInput.value && dateFinInput.value) {
            const dateDebut = new Date(dateDebutInput.value);
            const dateFin = new Date(dateFinInput.value);
            
            if (dateFin <= dateDebut) {
                alert('La date de fin doit être après la date de début');
                isValid = false;
            }
        }
        
        return isValid;
    }

    // Confirmation avant soumission
    form.addEventListener('submit', function(e) {
        if (!validateForm()) {
            e.preventDefault();
            return;
        }
        
        const nomAnimal = nomAnimalInput.value;
        const dateDebut = dateDebutInput.value;
        const dateFin = dateFinInput.value;
        
        if (!confirm(`Confirmez-vous la demande d'hébergement pour ${nomAnimal} du ${dateDebut} au ${dateFin} ?`)) {
            e.preventDefault();
            return;
        }
        
        // Afficher l'indicateur de chargement
        submitBtn.style.display = 'none';
        loadingSpinner.style.display = 'block';
    });

    // Déclencher le changement au chargement si une espèce est déjà sélectionnée
    if (especeSelect.value) {
        especeSelect.dispatchEvent(new Event('change'));
    }

    // Calculer la durée initiale si les dates sont déjà remplies
    if (dateDebutInput.value && dateFinInput.value) {
        calculateDuration();
    }
});
</script>
@endsection