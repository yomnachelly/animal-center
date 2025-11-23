@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    <style>
        .rdv-form-container {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 1000px;
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
        
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }
        
        .service-checkbox {
            position: relative;
        }
        
        .service-checkbox input {
            position: absolute;
            opacity: 0;
        }
        
        .service-checkbox label {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 600;
            color: #495057;
        }
        
        .service-checkbox input:checked + label {
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            border-color: #4facfe;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(79, 172, 254, 0.3);
        }
        
        .service-checkbox label:hover {
            border-color: #4facfe;
            transform: translateY(-2px);
        }
        
        .service-icon {
            font-size: 1.5rem;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
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
        
        .character-count {
            text-align: right;
            font-size: 0.85rem;
            color: #6c757d;
            margin-top: 5px;
        }
        
        .character-count.warning {
            color: #ff9800;
            font-weight: 600;
        }
        
        .character-count.danger {
            color: #f44336;
            font-weight: 700;
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
        
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        
        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
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
            
            .services-grid {
                grid-template-columns: 1fr;
            }
            
            .form-row {
                grid-template-columns: 1fr;
            }
        }
        
        .loading-spinner {
            display: none;
            text-align: center;
            padding: 20px;
        }
        
        .step-indicator {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
            gap: 10px;
        }
        
        .step {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #e9ecef;
            transition: all 0.3s ease;
        }
        
        .step.active {
            background: #4facfe;
            transform: scale(1.2);
        }
    </style>

    <div class="rdv-form-container">
        <!-- En-tête de page -->
        <div class="page-header">
            <h1 class="page-title floating">
                <i class="fas fa-calendar-plus"></i>
                Nouveau Rendez-vous
            </h1>
            <p class="page-subtitle">Prenez rendez-vous pour votre animal de compagnie</p>
        </div>

        <form action="{{ route('client.rendez-vous.store') }}" method="POST" enctype="multipart/form-data" id="rdvForm">
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
                        Renseignez les informations de base de votre animal. Ces données nous aideront à mieux préparer sa consultation.
                    </p>
                </div>

                <div class="form-row">
                    <!-- Nom de l'animal -->
                    <div class="form-group">
                        <label class="form-label required-field">
                            <i class="fas fa-signature"></i>Nom de l'animal
                        </label>
                        <div class="input-icon">
                            <i class="fas fa-paw"></i>
                            <input type="text" name="nom_animal" id="nom_animal" class="form-control form-control-custom" 
                                   placeholder="Ex: Max, Bella, Luna..." 
                                   maxlength="50"
                                   required>
                        </div>
                        <div class="character-count">
                            <span id="nameCharCount">0</span>/50 caractères
                        </div>
                        <div class="form-feedback" id="nameFeedback"></div>
                    </div>

                    <!-- Âge -->
                    <div class="form-group">
                        <label class="form-label required-field">
                            <i class="fas fa-birthday-cake"></i>Âge
                        </label>
                        <div class="input-icon">
                            <i class="fas fa-calendar-alt"></i>
                            <input type="number" name="age" id="age" class="form-control form-control-custom" 
                                   placeholder="Ex: 2" 
                                   min="0" 
                                   max="30"
                                   required>
                        </div>
                        <div class="form-feedback" id="ageFeedback"></div>
                    </div>
                </div>

                <div class="form-row">
                    <!-- Espèce -->
                    <div class="form-group">
                        <label class="form-label required-field">
                            <i class="fas fa-dog"></i>Espèce
                        </label>
                        <select name="espece_id" id="espece" class="form-control form-control-custom" required>
                            <option value="">-- Choisir une espèce --</option>
                            @foreach($especes as $espece)
                                <option value="{{ $espece->id }}">{{ $espece->nom }}</option>
                            @endforeach
                        </select>
                        <div class="form-feedback" id="especeFeedback"></div>
                    </div>

                    <!-- Race -->
                    <div class="form-group">
                        <label class="form-label required-field">
                            <i class="fas fa-list"></i>Race
                        </label>
                        <select name="race_id" id="race" class="form-control form-control-custom" required disabled>
                            <option value="">-- Choisir une espèce d'abord --</option>
                        </select>
                        <div class="form-feedback" id="raceFeedback"></div>
                    </div>
                </div>

                <div class="form-row">
                    <!-- Sexe -->
                    <div class="form-group">
                        <label class="form-label required-field">
                            <i class="fas fa-venus-mars"></i>Sexe
                        </label>
                        <select name="sexe" id="sexe" class="form-control form-control-custom" required>
                            <option value="">-- Choisir --</option>
                            <option value="masculin">Mâle</option>
                            <option value="feminin">Femelle</option>
                        </select>
                        <div class="form-feedback" id="sexeFeedback"></div>
                    </div>

                    <!-- Photo -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-camera"></i>Photo de l'animal
                        </label>
                        <div class="photo-upload-area" id="photo-upload-area">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <p>Cliquez pour télécharger une photo</p>
                            <small class="text-muted">Formats acceptés: JPG, PNG, GIF (Max: 2MB)</small>
                            <input type="file" name="photo" id="photo" class="d-none" accept="image/*">
                        </div>
                        <img id="photo-preview" class="photo-preview" src="#" alt="Aperçu de la photo">
                    </div>
                </div>
            </div>

            <!-- Détails du rendez-vous -->
            <div class="form-card">
                <div class="card-header-custom">
                    <h3 class="card-title-custom">
                        <i class="fas fa-calendar-alt"></i>
                        Détails du rendez-vous
                    </h3>
                </div>

                <!-- Type de rendez-vous -->
                <div class="form-group">
                    <label class="form-label required-field">
                        <i class="fas fa-tag"></i>Type de rendez-vous
                    </label>
                    <select name="type_rdv" id="type_rdv" class="form-control form-control-custom" required>
                        <option value="">-- Choisir le type --</option>
                        <option value="soin">Soin médical</option>
                        <option value="vaccin">Vaccination</option>
                    </select>
                    <div class="form-feedback" id="typeFeedback"></div>
                </div>

                <!-- Section Soins -->
                <div class="form-group" id="soins-section" style="display: none;">
                    <label class="form-label">
                        <i class="fas fa-hand-holding-medical"></i>Soins demandés
                    </label>
                    <div class="services-grid">
                        @foreach($soins as $soin)
                        <div class="service-checkbox">
                            <input type="checkbox" name="soins[]" value="{{ $soin->id }}" id="soin{{ $soin->id }}">
                            <label for="soin{{ $soin->id }}">
                                <span class="service-icon">
                                    <i class="fas fa-stethoscope"></i>
                                </span>
                                {{ $soin->nom }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Section Vaccins -->
                <div class="form-group" id="vaccins-section" style="display: none;">
                    <label class="form-label">
                        <i class="fas fa-syringe"></i>Vaccins demandés
                    </label>
                    <div class="services-grid">
                        @foreach($vaccins as $vaccin)
                        <div class="service-checkbox">
                            <input type="checkbox" name="vaccins[]" value="{{ $vaccin->id }}" id="vaccin{{ $vaccin->id }}">
                            <label for="vaccin{{ $vaccin->id }}">
                                <span class="service-icon">
                                    <i class="fas fa-shield-alt"></i>
                                </span>
                                {{ $vaccin->nom }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Date du rendez-vous -->
                <div class="form-group">
                    <label class="form-label required-field">
                        <i class="fas fa-calendar-day"></i>Date du rendez-vous
                    </label>
                    <div class="input-icon">
                        <i class="fas fa-calendar"></i>
                        <input type="date" name="date" id="date" class="form-control form-control-custom" 
                               min="{{ date('Y-m-d') }}" 
                               required>
                    </div>
                    <div class="form-feedback" id="dateFeedback"></div>
                </div>
            </div>

            <!-- Actions du formulaire -->
            <div class="form-actions">
                <button type="submit" class="btn-primary-custom" id="submitBtn">
                    <i class="fas fa-calendar-check"></i>
                    Confirmer le rendez-vous
                </button>
                <a href="{{ route('client.rendez-vous') }}" class="btn-secondary-custom">
                    <i class="fas fa-arrow-left"></i>
                    Retour aux rendez-vous
                </a>
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
document.addEventListener('DOMContentLoaded', function () {
    const especeSelect = document.getElementById('espece');
    const raceSelect = document.getElementById('race');
    const typeSelect = document.getElementById('type_rdv');
    const nomAnimalInput = document.getElementById('nom_animal');
    const ageInput = document.getElementById('age');
    const dateInput = document.getElementById('date');
    const photoInput = document.getElementById('photo');
    const photoPreview = document.getElementById('photo-preview');
    const photoUploadArea = document.getElementById('photo-upload-area');
    const form = document.getElementById('rdvForm');
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
                })
                .catch(err => {
                    console.error(err);
                    raceSelect.innerHTML = '<option value="">Erreur de chargement</option>';
                });
        }
    });

    // Type de rendez-vous -> afficher soins / vaccins
    typeSelect.addEventListener('change', function() {
        const type = this.value;
        document.getElementById('soins-section').style.display = type === 'soin' ? 'block' : 'none';
        document.getElementById('vaccins-section').style.display = type === 'vaccin' ? 'block' : 'none';
        
        // Réinitialiser les sélections
        if (type !== 'soin') {
            document.querySelectorAll('input[name="soins[]"]').forEach(cb => cb.checked = false);
        }
        if (type !== 'vaccin') {
            document.querySelectorAll('input[name="vaccins[]"]').forEach(cb => cb.checked = false);
        }
    });

    // Validation en temps réel
    function validateField(field, validator) {
        field.addEventListener('blur', function() {
            validator(this.value);
        });
    }

    // Validation du nom
    validateField(nomAnimalInput, function(value) {
        if (value.length < 2) {
            showFeedback('nameFeedback', 'Le nom doit contenir au moins 2 caractères', 'invalid');
            return false;
        }
        showFeedback('nameFeedback', 'Nom valide !', 'valid');
        return true;
    });

    // Validation de l'âge
    validateField(ageInput, function(value) {
        if (value < 0 || value > 30) {
            showFeedback('ageFeedback', 'L\'âge doit être compris entre 0 et 30 ans', 'invalid');
            return false;
        }
        showFeedback('ageFeedback', 'Âge valide !', 'valid');
        return true;
    });

    function showFeedback(elementId, message, type) {
        const element = document.getElementById(elementId);
        element.textContent = message;
        element.className = `form-feedback ${type}`;
        element.style.display = 'block';
    }

    // Empêcher les dates passées
    dateInput.min = new Date().toISOString().split('T')[0];

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

    // Confirmation avant soumission
    form.addEventListener('submit', function(e) {
        const nomAnimal = nomAnimalInput.value;
        const typeRdv = typeSelect.value;
        
        if (!confirm(`Confirmez-vous la prise de rendez-vous pour ${nomAnimal} (${typeRdv}) ?`)) {
            e.preventDefault();
            return;
        }
        
        // Afficher l'indicateur de chargement
        submitBtn.style.display = 'none';
        loadingSpinner.style.display = 'block';
    });

    // Initialiser le compteur de caractères
    document.getElementById('nameCharCount').textContent = nomAnimalInput.value.length;
});
</script>
@endsection