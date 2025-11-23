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
    </style>

    <div class="form-container">
        <!-- En-tête du formulaire -->
        <div class="form-header">
            <h1 class="form-title">
                <i class="fas fa-plus-circle floating-animation"></i>
                Nouvelle Espèce
            </h1>
            <p class="form-subtitle">Ajoutez une nouvelle espèce animale à votre catalogue</p>
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
                    Le nom de l'espèce doit être clair et descriptif. Utilisez des noms communs reconnus 
                    (ex: "Chien", "Chat", "Oiseau") pour faciliter la recherche et l'organisation.
                </p>
            </div>

            <form method="POST" action="{{ route('especes.store') }}" id="speciesForm">
                @csrf

                <!-- Nom de l'espèce -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-tag"></i>Nom de l'espèce
                    </label>
                    <div class="input-icon">
                        <i class="fas fa-paw"></i>
                        <input type="text" name="nom" class="form-control form-control-custom" 
                               placeholder="Ex: Chien, Chat, Oiseau, Lapin..." 
                               maxlength="50"
                               required
                               id="speciesName">
                    </div>
                    <div class="character-count">
                        <span id="charCount">0</span>/50 caractères
                    </div>
                    <div class="form-feedback" id="nameFeedback"></div>
                </div>

                <!-- Actions du formulaire -->
                <div class="form-actions">
                    <button type="submit" class="btn btn-success-custom" id="submitBtn">
                        <i class="fas fa-save"></i>
                        Créer l'espèce
                    </button>
                    <a href="{{ route('especes.index') }}" class="btn btn-secondary-custom">
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
    const speciesNameInput = document.getElementById('speciesName');
    const charCount = document.getElementById('charCount');
    const nameFeedback = document.getElementById('nameFeedback');
    const submitBtn = document.getElementById('submitBtn');
    const form = document.getElementById('speciesForm');

    // Compteur de caractères
    speciesNameInput.addEventListener('input', function() {
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
    });

    // Validation en temps réel
    speciesNameInput.addEventListener('blur', function() {
        validateName(this.value);
    });

    speciesNameInput.addEventListener('input', function() {
        // Cacher le feedback pendant la saisie
        nameFeedback.style.display = 'none';
    });

    function validateName(name) {
        nameFeedback.style.display = 'none';
        
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
        
        showFeedback('Nom valide !', 'valid');
        return true;
    }

    function showFeedback(message, type) {
        nameFeedback.textContent = message;
        nameFeedback.className = `form-feedback ${type}`;
        nameFeedback.style.display = 'block';
    }

    // Animation des champs
    speciesNameInput.addEventListener('focus', function() {
        this.parentElement.style.transform = 'scale(1.02)';
    });
    
    speciesNameInput.addEventListener('blur', function() {
        this.parentElement.style.transform = 'scale(1)';
    });

    // Confirmation avant soumission
    form.addEventListener('submit', function(e) {
        const name = speciesNameInput.value.trim();
        
        if (!validateName(name)) {
            e.preventDefault();
            return;
        }
        
        if (!confirm(`Confirmez-vous la création de l'espèce "${name}" ?`)) {
            e.preventDefault();
        }
    });

    // Initialiser le compteur de caractères
    charCount.textContent = speciesNameInput.value.length;
});
</script>

@endsection