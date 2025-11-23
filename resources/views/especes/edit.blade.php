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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
            color: #667eea;
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
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
        }
        
        .form-control-custom:hover {
            border-color: #ced4da;
            background: white;
        }
        
        .btn-primary-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 15px 40px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }
        
        .btn-primary-custom:hover:not(:disabled) {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
            background: linear-gradient(135deg, #5a6fd8 0%, #6a42a0 100%);
            color: white;
        }
        
        .btn-primary-custom:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }
        
        .btn-outline-secondary-custom {
            background: transparent;
            border: 2px solid #6c757d;
            color: #6c757d;
            padding: 15px 40px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }
        
        .btn-outline-secondary-custom:hover {
            background: #6c757d;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108, 117, 125, 0.3);
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
        
        .species-details {
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
            
            .btn-primary-custom,
            .btn-outline-secondary-custom {
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
    </style>

    <div class="form-container">
        <!-- En-tête du formulaire -->
        <div class="form-header">
            <h1 class="form-title">
                <i class="fas fa-edit floating-animation"></i>
                Modifier l'Espèce
            </h1>
            <p class="form-subtitle">Mettez à jour les informations de l'espèce</p>
        </div>

        <!-- Carte du formulaire -->
        <div class="form-card">
            <!-- Informations actuelles -->
            <div class="info-card">
                <div class="info-card-title">
                    <i class="fas fa-info-circle"></i>
                    Informations actuelles
                </div>
                <div class="species-details">
                    <div class="detail-item">
                        <span class="detail-label">ID de l'espèce</span>
                        <span class="detail-value">#{{ $espece->id }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Nom actuel</span>
                        <span class="detail-value" id="currentName">{{ $espece->nom }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Date de création</span>
                        <span class="detail-value">
                            @if($espece->created_at)
                                {{ $espece->created_at->format('d/m/Y à H:i') }}
                            @else
                                Non disponible
                            @endif
                        </span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Dernière modification</span>
                        <span class="detail-value">
                            @if($espece->updated_at)
                                {{ $espece->updated_at->format('d/m/Y à H:i') }}
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
                    La modification du nom de l'espèce affectera tous les animaux associés. 
                    Assurez-vous que le nouveau nom est correct avant de sauvegarder.
                </p>
            </div>

            <form method="POST" action="{{ route('especes.update', $espece) }}" id="speciesForm">
                @csrf
                @method('PUT')

                <!-- Nom de l'espèce -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-tag"></i>Nom de l'espèce
                        <span class="change-indicator" id="changeIndicator">
                            <i class="fas fa-pencil-alt"></i> Modifié
                        </span>
                    </label>
                    <div class="input-icon">
                        <i class="fas fa-paw"></i>
                        <input type="text" name="nom" class="form-control form-control-custom" 
                               value="{{ $espece->nom }}"
                               placeholder="Ex: Chien, Chat, Oiseau..." 
                               maxlength="50"
                               required
                               id="speciesName">
                    </div>
                    <div class="character-count">
                        <span id="charCount">{{ strlen($espece->nom) }}</span>/50 caractères
                    </div>
                    <div class="form-feedback" id="nameFeedback"></div>
                </div>

                <!-- Actions du formulaire -->
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary-custom" id="submitBtn">
                        <i class="fas fa-save"></i>
                        Enregistrer les modifications
                    </button>
                    <a href="{{ route('especes.index') }}" class="btn btn-outline-secondary-custom">
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
    const speciesNameInput = document.getElementById('speciesName');
    const charCount = document.getElementById('charCount');
    const nameFeedback = document.getElementById('nameFeedback');
    const submitBtn = document.getElementById('submitBtn');
    const changeIndicator = document.getElementById('changeIndicator');
    const form = document.getElementById('speciesForm');
    const currentName = "{{ $espece->nom }}";
    let hasChanges = false;

    // Initialisation
    updateSubmitButton();

    // Compteur de caractères
    speciesNameInput.addEventListener('input', function() {
        const length = this.value.length;
        charCount.textContent = length;
        
        // Mettre à jour le style du compteur
        updateCharacterCountStyle(length);
        
        // Vérifier les changements
        checkForChanges();
        
        // Validation en temps réel
        validateName(this.value);
    });

    // Validation en temps réel
    speciesNameInput.addEventListener('blur', function() {
        validateName(this.value);
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
        const newName = speciesNameInput.value.trim();
        hasChanges = newName !== currentName;
        
        if (hasChanges) {
            changeIndicator.classList.add('show');
            submitBtn.disabled = false;
        } else {
            changeIndicator.classList.remove('show');
            submitBtn.disabled = true;
            showFeedback('Aucune modification détectée', 'info');
        }
        
        updateSubmitButton();
    }

    function validateName(name) {
        nameFeedback.style.display = 'none';
        
        if (name === currentName) {
            showFeedback('Le nom est identique à la version actuelle', 'info');
            return false;
        }
        
        if (name.length < 2) {
            showFeedback('Le nom doit contenir au moins 2 caractères', 'invalid');
            return false;
        }
        
        if (name.length > 50) {
            showFeedback('Le nom ne peut pas dépasser 50 caractères', 'invalid');
            return false;
        }
        
        // Validation des caractères (lettres, espaces, tirets)
        const regex = /^[a-zA-ZÀ-ÿ\s\-]+$/;
        if (!regex.test(name)) {
            showFeedback('Le nom ne peut contenir que des lettres, espaces et tirets', 'invalid');
            return false;
        }
        
        if (hasChanges) {
            showFeedback('Nom valide - Prêt à être sauvegardé', 'valid');
        }
        return true;
    }

    function showFeedback(message, type) {
        nameFeedback.textContent = message;
        nameFeedback.className = `form-feedback ${type}`;
        nameFeedback.style.display = 'block';
    }

    function updateSubmitButton() {
        if (hasChanges && validateName(speciesNameInput.value.trim())) {
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="fas fa-save"></i> Enregistrer les modifications';
        } else {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-check"></i> Aucune modification';
        }
    }

    // Animation des champs
    speciesNameInput.addEventListener('focus', function() {
        this.parentElement.style.transform = 'scale(1.02)';
        this.parentElement.style.zIndex = '1';
    });
    
    speciesNameInput.addEventListener('blur', function() {
        this.parentElement.style.transform = 'scale(1)';
        this.parentElement.style.zIndex = '0';
    });

    // Confirmation avant soumission
    form.addEventListener('submit', function(e) {
        const newName = speciesNameInput.value.trim();
        
        if (!hasChanges) {
            e.preventDefault();
            showFeedback('Aucune modification à sauvegarder', 'info');
            return;
        }
        
        if (!validateName(newName)) {
            e.preventDefault();
            return;
        }
        
        if (!confirm(`Confirmez-vous la modification de l'espèce ?\n\nAncien nom: "${currentName}"\nNouveau nom: "${newName}"`)) {
            e.preventDefault();
        }
    });

    // Raccourci clavier Ctrl + S
    document.addEventListener('keydown', function(e) {
        if ((e.ctrlKey || e.metaKey) && e.key === 's') {
            e.preventDefault();
            if (!submitBtn.disabled) {
                form.dispatchEvent(new Event('submit'));
            }
        }
    });

    // Initialiser le compteur de style
    updateCharacterCountStyle(speciesNameInput.value.length);
});
</script>

@endsection