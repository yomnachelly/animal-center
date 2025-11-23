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
            background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
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
            color: #ff9a9e;
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
            border-color: #ff9a9e;
            background: white;
            box-shadow: 0 0 0 0.2rem rgba(255, 154, 158, 0.1);
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
            border-color: #ff9a9e;
            background: white;
            box-shadow: 0 0 0 0.2rem rgba(255, 154, 158, 0.1);
            transform: translateY(-2px);
        }
        
        .select-custom:hover {
            border-color: #ced4da;
            background: white;
        }
        
        .btn-warning-custom {
            background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
            border: none;
            color: white;
            padding: 15px 40px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(255, 154, 158, 0.3);
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }
        
        .btn-warning-custom:hover:not(:disabled) {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(255, 154, 158, 0.4);
            background: linear-gradient(135deg, #ff7b81 0%, #febbe8 100%);
            color: white;
        }
        
        .btn-warning-custom:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
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
        
        .info-card {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            border-left: 4px solid #2196f3;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
        }
        
        .info-card-title {
            color: #1976d2;
            font-weight: 700;
            margin-bottom: 10px;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .info-card-content {
            color: #1565c0;
            margin: 0;
            font-size: 0.95rem;
            line-height: 1.5;
        }
        
        .warning-card {
            background: linear-gradient(135deg, #fff3cd, #ffeaa7);
            border-left: 4px solid #ffc107;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
        }
        
        .warning-card-title {
            color: #856404;
            font-weight: 700;
            margin-bottom: 10px;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .warning-card-content {
            color: #856404;
            margin: 0;
            font-size: 0.95rem;
            line-height: 1.5;
        }
        
        .race-details {
            background: white;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
        }
        
        .detail-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid #f8f9fa;
        }
        
        .detail-item:last-child {
            border-bottom: none;
        }
        
        .detail-label {
            color: #6c757d;
            font-weight: 600;
        }
        
        .detail-value {
            color: #2c3e50;
            font-weight: 700;
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
        
        .form-feedback.info {
            background: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }
        
        .change-indicator {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            background: #28a745;
            color: white;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-left: 10px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .change-indicator.show {
            opacity: 1;
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
            
            .btn-warning-custom,
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
    </style>

    <div class="form-container">
        <!-- En-tête du formulaire -->
        <div class="form-header">
            <h1 class="form-title">
                <i class="fas fa-edit floating-animation"></i>
                Modifier la Race
            </h1>
            <p class="form-subtitle">Mettez à jour les informations de {{ $race->nom }}</p>
        </div>

        <!-- Carte du formulaire -->
        <div class="form-card">
            <!-- Informations actuelles -->
            <div class="info-card">
                <div class="info-card-title">
                    <i class="fas fa-info-circle"></i>
                    Informations actuelles
                </div>
                <div class="race-details">
                    <div class="detail-item">
                        <span class="detail-label">ID de la race</span>
                        <span class="detail-value">#{{ $race->id }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Nom actuel</span>
                        <span class="detail-value" id="currentName">{{ $race->nom }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Espèce actuelle</span>
                        <span class="detail-value" id="currentEspece">{{ $race->espece->nom }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Date de création</span>
                        <span class="detail-value">
                            @if($race->created_at)
                                {{ $race->created_at->format('d/m/Y à H:i') }}
                            @else
                                Non disponible
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            <!-- Avertissement -->
            <div class="warning-card">
                <div class="warning-card-title">
                    <i class="fas fa-exclamation-triangle"></i>
                    Attention
                </div>
                <p class="warning-card-content">
                    La modification de la race affectera tous les animaux associés. 
                    Les changements d'espèce peuvent impacter la cohérence des données.
                </p>
            </div>

            <form method="POST" action="{{ route('races.update', $race) }}" id="raceForm">
                @csrf
                @method('PUT')

                <!-- Nom de la race -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-tag"></i>Nom de la race
                        <span class="change-indicator" id="nameChangeIndicator">
                            <i class="fas fa-pencil-alt"></i> Modifié
                        </span>
                    </label>
                    <div class="input-icon">
                        <i class="fas fa-paw"></i>
                        <input type="text" name="nom" class="form-control form-control-custom" 
                               value="{{ $race->nom }}"
                               placeholder="Ex: Berger Allemand, Persan, Labrador..." 
                               maxlength="50"
                               required
                               id="raceName">
                    </div>
                    <div class="character-count">
                        <span id="charCount">{{ strlen($race->nom) }}</span>/50 caractères
                    </div>
                    <div class="form-feedback" id="nameFeedback"></div>
                </div>

                <!-- Espèce -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-dog"></i>Espèce associée
                        <span class="change-indicator" id="especeChangeIndicator">
                            <i class="fas fa-pencil-alt"></i> Modifié
                        </span>
                    </label>
                    <select name="espece_id" class="form-control select-custom" required id="especeSelect">
                        <option value="">-- Choisir une espèce --</option>
                        @foreach($especes as $espece)
                            <option value="{{ $espece->id }}" 
                                    @selected($race->espece_id == $espece->id)
                                    data-description="{{ $espece->description ?? 'Aucune description disponible' }}">
                                {{ $espece->nom }}
                            </option>
                        @endforeach
                    </select>
                    <div class="form-feedback" id="especeFeedback"></div>
                </div>

                <!-- Actions du formulaire -->
                <div class="form-actions">
                    <button type="submit" class="btn btn-warning-custom" id="submitBtn">
                        <i class="fas fa-save"></i>
                        Enregistrer les modifications
                    </button>
                    <a href="{{ route('races.index') }}" class="btn btn-secondary-custom">
                        <i class="fas fa-times"></i>
                        Annuler
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
    const nameChangeIndicator = document.getElementById('nameChangeIndicator');
    const especeChangeIndicator = document.getElementById('especeChangeIndicator');
    const submitBtn = document.getElementById('submitBtn');
    const form = document.getElementById('raceForm');
    
    const originalName = "{{ $race->nom }}";
    const originalEspeceId = "{{ $race->espece_id }}";
    let hasNameChanged = false;
    let hasEspeceChanged = false;

    // Initialisation
    updateSubmitButton();

    // Compteur de caractères
    raceNameInput.addEventListener('input', function() {
        const length = this.value.length;
        charCount.textContent = length;
        
        // Mettre à jour le style du compteur
        updateCharacterCountStyle(length);
        
        // Vérifier les changements
        checkForChanges();
        
        // Validation en temps réel
        validateName(this.value);
    });

    // Détection des changements d'espèce
    especeSelect.addEventListener('change', function() {
        checkForChanges();
        validateEspece(this.value);
    });

    // Validation en temps réel
    raceNameInput.addEventListener('blur', function() {
        validateName(this.value);
    });

    especeSelect.addEventListener('blur', function() {
        validateEspece(this.value);
    });

    function updateCharacterCountStyle(length) {
        if (length > 40) {
            charCount.classList.add('warning');
            charCount.classList.remove('danger');
        } else if (length > 45) {
            charCount.classList.remove('warning');
            charCount.classList.add('danger');
        } else {
            charCount.classList.remove('warning', 'danger');
        }
    }

    function checkForChanges() {
        const newName = raceNameInput.value.trim();
        const newEspeceId = especeSelect.value;
        
        hasNameChanged = newName !== originalName;
        hasEspeceChanged = newEspeceId !== originalEspeceId;
        
        // Mettre à jour les indicateurs visuels
        nameChangeIndicator.classList.toggle('show', hasNameChanged);
        especeChangeIndicator.classList.toggle('show', hasEspeceChanged);
        
        updateSubmitButton();
    }

    function validateName(name) {
        nameFeedback.style.display = 'none';
        
        if (name === originalName && !hasEspeceChanged) {
            showFeedback(nameFeedback, 'Aucune modification détectée', 'info');
            return false;
        }
        
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
        
        if (hasNameChanged || hasEspeceChanged) {
            showFeedback(nameFeedback, 'Modifications valides - Prêt à sauvegarder', 'valid');
        }
        return true;
    }

    function validateEspece(especeId) {
        especeFeedback.style.display = 'none';
        
        if (!especeId) {
            showFeedback(especeFeedback, 'Veuillez sélectionner une espèce', 'invalid');
            return false;
        }
        
        if (especeId === originalEspeceId && !hasNameChanged) {
            showFeedback(especeFeedback, 'Aucune modification détectée', 'info');
            return false;
        }
        
        showFeedback(especeFeedback, 'Espèce valide', 'valid');
        return true;
    }

    function showFeedback(element, message, type) {
        element.textContent = message;
        element.className = `form-feedback ${type}`;
        element.style.display = 'block';
    }

    function updateSubmitButton() {
        const hasChanges = hasNameChanged || hasEspeceChanged;
        const isValid = validateName(raceNameInput.value.trim()) && validateEspece(especeSelect.value);
        
        if (hasChanges && isValid) {
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="fas fa-save"></i> Enregistrer les modifications';
        } else {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-check"></i> Aucune modification';
        }
    }

    // Animation des champs
    const inputs = [raceNameInput, especeSelect];
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.style.transform = 'translateY(-2px)';
            this.style.boxShadow = '0 5px 15px rgba(255, 154, 158, 0.2)';
        });
        
        input.addEventListener('blur', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = 'none';
        });
    });

    // Confirmation avant soumission
    form.addEventListener('submit', function(e) {
        const newName = raceNameInput.value.trim();
        const newEspeceId = especeSelect.value;
        const newEspeceName = especeSelect.options[especeSelect.selectedIndex].text;
        
        if (!hasNameChanged && !hasEspeceChanged) {
            e.preventDefault();
            showFeedback(nameFeedback, 'Aucune modification à sauvegarder', 'info');
            return;
        }
        
        if (!validateName(newName) || !validateEspece(newEspeceId)) {
            e.preventDefault();
            return;
        }
        
        let confirmationMessage = `Confirmez-vous la modification de la race ?\n\n`;
        
        if (hasNameChanged) {
            confirmationMessage += `Nom: "${originalName}" → "${newName}"\n`;
        }
        
        if (hasEspeceChanged) {
            const originalEspeceName = "{{ $race->espece->nom }}";
            confirmationMessage += `Espèce: "${originalEspeceName}" → "${newEspeceName}"\n`;
        }
        
        if (!confirm(confirmationMessage)) {
            e.preventDefault();
        }
    });

    // Initialiser le compteur de style
    updateCharacterCountStyle(raceNameInput.value.length);
});
</script>

@endsection