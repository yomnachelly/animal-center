@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    <style>
        .form-container {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .form-header {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            padding: 40px 30px;
            border-radius: 20px 20px 0 0;
            margin-bottom: 0;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .form-title {
            font-weight: 800;
            margin: 0;
            font-size: 2.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }
        
        .form-subtitle {
            opacity: 0.9;
            margin: 15px 0 0 0;
            font-size: 1.2rem;
            font-weight: 300;
        }
        
        .form-card {
            background: white;
            border-radius: 0 0 20px 20px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
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
            font-size: 1.1rem;
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
        
        .select-custom {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 15px 20px;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 1rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
        }
        
        .select-custom:focus {
            border-color: #4facfe;
            background: white;
            box-shadow: 0 0 0 0.2rem rgba(79, 172, 254, 0.1);
            transform: translateY(-2px);
        }
        
        .select-custom:hover {
            border-color: #ced4da;
            background: white;
        }
        
        .btn-success-custom {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            border: none;
            color: white;
            padding: 15px 40px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(79, 172, 254, 0.3);
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }
        
        .btn-success-custom:hover {
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
            border-radius: 50px;
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
            gap: 15px;
            justify-content: center;
            margin-top: 40px;
            flex-wrap: wrap;
        }
        
        .form-help {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            border-left: 4px solid #2196f3;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
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
        
        .species-preview {
            background: linear-gradient(135deg, #fff3cd, #ffeaa7);
            border-left: 4px solid #ffc107;
            border-radius: 12px;
            padding: 15px;
            margin-top: 10px;
            display: none;
        }
        
        .species-preview-title {
            color: #856404;
            font-weight: 600;
            margin-bottom: 5px;
            font-size: 0.9rem;
        }
        
        .species-preview-content {
            color: #856404;
            margin: 0;
            font-size: 0.85rem;
        }
        
        @media (max-width: 768px) {
            .form-header {
                padding: 30px 20px;
            }
            
            .form-title {
                font-size: 2rem;
            }
            
            .form-card {
                padding: 30px 20px;
            }
            
            .form-actions {
                flex-direction: column;
            }
            
            .btn-success-custom,
            .btn-secondary-custom {
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
        
        .espece-option {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 0;
        }
        
        .espece-icon {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: #4facfe;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
        }
    </style>

    <div class="form-container">
        <!-- En-tête du formulaire -->
        <div class="form-header">
            <h1 class="form-title">
                <i class="fas fa-plus-circle floating-animation"></i>
                Nouvelle Race
            </h1>
            <p class="form-subtitle">Ajoutez une nouvelle race animale à votre catalogue</p>
        </div>

        <!-- Carte du formulaire -->
        <div class="form-card">
            <!-- Aide contextuelle -->
            <div class="form-help">
                <div class="form-help-title">
                    <i class="fas fa-lightbulb"></i>
                    Informations importantes
                </div>
                <p class="form-help-text">
                    Choisissez un nom clair et descriptif pour la race. Assurez-vous de sélectionner 
                    l'espèce appropriée, car cette association ne pourra pas être modifiée ultérieurement.
                </p>
            </div>

            <form method="POST" action="{{ route('races.store') }}" id="raceForm">
                @csrf

                <!-- Nom de la race -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-tag"></i>Nom de la race
                    </label>
                    <div class="input-icon">
                        <i class="fas fa-paw"></i>
                        <input type="text" name="nom" class="form-control form-control-custom" 
                               placeholder="Ex: Berger Allemand, Persan, Labrador..." 
                               maxlength="50"
                               required
                               id="raceName">
                    </div>
                    <div class="character-count">
                        <span id="charCount">0</span>/50 caractères
                    </div>
                    <div class="form-feedback" id="nameFeedback"></div>
                </div>

                <!-- Espèce -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-dog"></i>Espèce associée
                    </label>
                    <select name="espece_id" class="form-control select-custom" required id="especeSelect">
                        <option value="">-- Choisir une espèce --</option>
                        @foreach($especes as $espece)
                            <option value="{{ $espece->id }}" data-description="{{ $espece->description ?? 'Aucune description disponible' }}">
                                {{ $espece->nom }}
                            </option>
                        @endforeach
                    </select>
                    <div class="species-preview" id="speciesPreview">
                        <div class="species-preview-title">
                            <i class="fas fa-info-circle"></i> Description de l'espèce :
                        </div>
                        <p class="species-preview-content" id="speciesDescription"></p>
                    </div>
                    <div class="form-feedback" id="especeFeedback"></div>
                </div>

                <!-- Actions du formulaire -->
                <div class="form-actions">
                    <button type="submit" class="btn btn-success-custom" id="submitBtn">
                        <i class="fas fa-save"></i>
                        Créer la race
                    </button>
                    <a href="{{ route('races.index') }}" class="btn btn-secondary-custom">
                        <i class="fas fa-arrow-left"></i>
                        Retour à la liste
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const raceNameInput = document.getElementById('raceName');
    const especeSelect = document.getElementById('especeSelect');
    const charCount = document.getElementById('charCount');
    const nameFeedback = document.getElementById('nameFeedback');
    const especeFeedback = document.getElementById('especeFeedback');
    const speciesPreview = document.getElementById('speciesPreview');
    const speciesDescription = document.getElementById('speciesDescription');
    const submitBtn = document.getElementById('submitBtn');
    const form = document.getElementById('raceForm');

    // Compteur de caractères
    raceNameInput.addEventListener('input', function() {
        const length = this.value.length;
        charCount.textContent = length;
        
        // Mettre à jour le style du compteur
        if (length > 40) {
            charCount.classList.add('warning');
            charCount.classList.remove('danger');
        } else if (length > 45) {
            charCount.classList.remove('warning');
            charCount.classList.add('danger');
        } else {
            charCount.classList.remove('warning', 'danger');
        }
        
        validateName(this.value);
    });

    // Aperçu de l'espèce sélectionnée
    especeSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const description = selectedOption.getAttribute('data-description');
        
        if (this.value && description) {
            speciesDescription.textContent = description;
            speciesPreview.style.display = 'block';
        } else {
            speciesPreview.style.display = 'none';
        }
        
        validateEspece(this.value);
    });

    // Validation en temps réel
    raceNameInput.addEventListener('blur', function() {
        validateName(this.value);
    });

    especeSelect.addEventListener('blur', function() {
        validateEspece(this.value);
    });

    function validateName(name) {
        nameFeedback.style.display = 'none';
        
        if (name.length < 2) {
            showFeedback(nameFeedback, 'Le nom doit contenir au moins 2 caractères', 'invalid');
            return false;
        }
        
        if (name.length > 50) {
            showFeedback(nameFeedback, 'Le nom ne peut pas dépasser 50 caractères', 'invalid');
            return false;
        }
        
        // Validation des caractères (lettres, espaces, tirets)
        const regex = /^[a-zA-ZÀ-ÿ\s\-]+$/;
        if (!regex.test(name)) {
            showFeedback(nameFeedback, 'Le nom ne peut contenir que des lettres, espaces et tirets', 'invalid');
            return false;
        }
        
        showFeedback(nameFeedback, 'Nom valide !', 'valid');
        return true;
    }

    function validateEspece(especeId) {
        especeFeedback.style.display = 'none';
        
        if (!especeId) {
            showFeedback(especeFeedback, 'Veuillez sélectionner une espèce', 'invalid');
            return false;
        }
        
        showFeedback(especeFeedback, 'Espèce sélectionnée !', 'valid');
        return true;
    }

    function showFeedback(element, message, type) {
        element.textContent = message;
        element.className = `form-feedback ${type}`;
        element.style.display = 'block';
    }

    // Animation des champs
    const inputs = [raceNameInput, especeSelect];
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.style.transform = 'translateY(-2px)';
            this.style.boxShadow = '0 5px 15px rgba(79, 172, 254, 0.2)';
        });
        
        input.addEventListener('blur', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = 'none';
        });
    });

    // Validation finale avant soumission
    form.addEventListener('submit', function(e) {
        const name = raceNameInput.value.trim();
        const especeId = especeSelect.value;
        
        const isNameValid = validateName(name);
        const isEspeceValid = validateEspece(especeId);
        
        if (!isNameValid || !isEspeceValid) {
            e.preventDefault();
            showFeedback(nameFeedback, 'Veuillez corriger les erreurs ci-dessus', 'invalid');
            return;
        }
        
        const especeName = especeSelect.options[especeSelect.selectedIndex].text;
        
        if (!confirm(`Confirmez-vous la création de la race "${name}" pour l'espèce "${especeName}" ?`)) {
            e.preventDefault();
        }
    });

    // Initialiser le compteur de caractères
    charCount.textContent = raceNameInput.value.length;
});
</script>

@endsection