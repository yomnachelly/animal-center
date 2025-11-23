@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    <style>
        .avis-form-container {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 800px;
            margin: 0 auto;
        }
        
        .page-header {
            background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
            color: white;
            padding: 50px 40px;
            border-radius: 25px;
            margin-bottom: 40px;
            box-shadow: 0 20px 40px rgba(255, 154, 158, 0.3);
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
            background: linear-gradient(135deg, #ff9a9e, #fecfef);
        }
        
        .card-header-custom {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border: none;
            border-radius: 15px;
            padding: 25px 30px;
            margin-bottom: 30px;
            border-left: 4px solid #ff9a9e;
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
            color: #ff9a9e;
            font-size: 1.2rem;
        }
        
        .form-control-custom {
            border: 2px solid #e9ecef;
            border-radius: 15px;
            padding: 20px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
            resize: vertical;
            min-height: 150px;
            line-height: 1.6;
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
        
        .character-count {
            text-align: right;
            font-size: 0.85rem;
            color: #6c757d;
            margin-top: 8px;
            font-weight: 600;
        }
        
        .character-count.warning {
            color: #ff9800;
        }
        
        .character-count.danger {
            color: #f44336;
        }
        
        .btn-primary-custom {
            background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
            border: none;
            color: white;
            padding: 15px 40px;
            border-radius: 25px;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(255, 154, 158, 0.3);
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }
        
        .btn-primary-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(255, 154, 158, 0.4);
            background: linear-gradient(135deg, #ff7b81 0%, #febbe8 100%);
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
            background: linear-gradient(135deg, #ffeaa7, #fab1a0);
            border-left: 4px solid #e17055;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
        }
        
        .form-help-title {
            color: #e17055;
            font-weight: 700;
            margin-bottom: 10px;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .form-help-text {
            color: #e17055;
            margin: 0;
            font-size: 0.95rem;
            line-height: 1.5;
        }
        
        .required-field::after {
            content: " *";
            color: #dc3545;
        }
        
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        
        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .rating-section {
            margin-bottom: 30px;
        }
        
        .rating-stars {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }
        
        .star {
            font-size: 2rem;
            color: #e0e0e0;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .star:hover,
        .star.active {
            color: #ffd700;
            transform: scale(1.2);
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
            
            .form-control-custom {
                padding: 15px;
                min-height: 120px;
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
    </style>

    <div class="avis-form-container">
        <!-- En-tête de page -->
        <div class="page-header">
            <h1 class="page-title floating">
                <i class="fas fa-edit"></i>
                Donner mon Avis
            </h1>
            <p class="page-subtitle">Partagez votre expérience avec notre clinique vétérinaire</p>
        </div>

        <form action="{{ route('client.avis.store') }}" method="POST" id="avisForm">
            @csrf

            <div class="form-card">
                <!-- En-tête de carte -->
                <div class="card-header-custom">
                    <h3 class="card-title-custom">
                        <i class="fas fa-comment-medical"></i>
                        Votre Avis
                    </h3>
                </div>

                <!-- Aide contextuelle -->
                <div class="form-help">
                    <div class="form-help-title">
                        <i class="fas fa-lightbulb"></i>
                        Conseils pour votre avis
                    </div>
                    <p class="form-help-text">
                        Partagez honnêtement votre expérience. Votre avis aide d'autres propriétaires d'animaux 
                        et nous permet de nous améliorer. Soyez précis et constructif.
                    </p>
                </div>

                <!-- Champ texte de l'avis -->
                <div class="form-group">
                    <label for="texte" class="form-label required-field">
                        <i class="fas fa-pencil-alt"></i>Votre avis
                    </label>
                    <textarea name="texte" id="texte" 
                              class="form-control form-control-custom @error('texte') is-invalid @enderror" 
                              rows="6" 
                              placeholder="Décrivez votre expérience avec notre clinique vétérinaire...
💬 Comment s'est déroulée la consultation ?
🐾 Comment votre animal a-t-il été traité ?
⭐ Qu'avez-vous particulièrement apprécié ?
📋 Avez-vous des suggestions d'amélioration ?"
                              maxlength="1000">{{ old('texte') }}</textarea>
                    
                    @error('texte')
                        <div class="invalid-feedback">
                            <i class="fas fa-exclamation-triangle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                    
                    <div class="form-text">
                        <i class="fas fa-info-circle"></i>
                        Minimum 10 caractères, maximum 1000 caractères.
                    </div>
                    
                    <div class="character-count">
                        <span id="charCount">0</span>/1000 caractères
                    </div>
                    
                    <div class="form-feedback" id="textFeedback"></div>
                </div>

                <!-- Actions du formulaire -->
                <div class="form-actions">
                    <a href="{{ route('client.avis.index') }}" class="btn-secondary-custom">
                        <i class="fas fa-arrow-left"></i>
                        Retour aux avis
                    </a>
                    <button type="submit" class="btn-primary-custom" id="submitBtn">
                        <i class="fas fa-paper-plane"></i>
                        Publier mon avis
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const texteInput = document.getElementById('texte');
    const charCount = document.getElementById('charCount');
    const textFeedback = document.getElementById('textFeedback');
    const form = document.getElementById('avisForm');
    const submitBtn = document.getElementById('submitBtn');

    // Compteur de caractères
    texteInput.addEventListener('input', function() {
        const length = this.value.length;
        charCount.textContent = length;
        
        // Mettre à jour le style du compteur
        if (length < 10) {
            charCount.classList.add('danger');
            charCount.classList.remove('warning');
            showFeedback('Votre avis doit contenir au moins 10 caractères', 'invalid');
            submitBtn.disabled = true;
            submitBtn.style.opacity = '0.6';
        } else if (length > 900) {
            charCount.classList.remove('danger');
            charCount.classList.add('warning');
            showFeedback(`Plus que ${1000 - length} caractères disponibles`, 'invalid');
            submitBtn.disabled = false;
            submitBtn.style.opacity = '1';
        } else if (length > 950) {
            charCount.classList.add('danger');
            charCount.classList.remove('warning');
            showFeedback(`Attention ! Plus que ${1000 - length} caractères`, 'invalid');
            submitBtn.disabled = false;
            submitBtn.style.opacity = '1';
        } else {
            charCount.classList.remove('warning', 'danger');
            showFeedback('Votre avis est parfait !', 'valid');
            submitBtn.disabled = false;
            submitBtn.style.opacity = '1';
        }
        
        if (length === 0) {
            textFeedback.style.display = 'none';
        }
    });

    // Validation en temps réel
    texteInput.addEventListener('blur', function() {
        validateText(this.value);
    });

    function validateText(text) {
        if (text.length < 10) {
            showFeedback('Votre avis doit contenir au moins 10 caractères', 'invalid');
            return false;
        }
        
        if (text.length > 1000) {
            showFeedback('Votre avis ne peut pas dépasser 1000 caractères', 'invalid');
            return false;
        }
        
        showFeedback('Votre avis est parfait !', 'valid');
        return true;
    }

    function showFeedback(message, type) {
        textFeedback.textContent = message;
        textFeedback.className = `form-feedback ${type}`;
        textFeedback.style.display = 'block';
        
        // Masquer après 5 secondes pour les messages valides
        if (type === 'valid') {
            setTimeout(() => {
                textFeedback.style.display = 'none';
            }, 5000);
        }
    }

    // Animation du champ texte
    texteInput.addEventListener('focus', function() {
        this.style.transform = 'translateY(-2px)';
        this.parentElement.style.transform = 'scale(1.02)';
    });
    
    texteInput.addEventListener('blur', function() {
        this.style.transform = 'translateY(0)';
        this.parentElement.style.transform = 'scale(1)';
    });

    // Confirmation avant soumission
    form.addEventListener('submit', function(e) {
        const texte = texteInput.value.trim();
        
        if (!validateText(texte)) {
            e.preventDefault();
            return;
        }
        
        if (!confirm('Êtes-vous sûr de vouloir publier cet avis ? Il sera visible par tous les visiteurs.')) {
            e.preventDefault();
        }
    });

    // Initialiser le compteur de caractères
    charCount.textContent = texteInput.value.length;
    if (texteInput.value.length < 10) {
        submitBtn.disabled = true;
        submitBtn.style.opacity = '0.6';
    }
});
</script>
@endsection