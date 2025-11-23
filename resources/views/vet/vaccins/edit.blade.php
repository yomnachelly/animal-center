@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <style>
        .form-container {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 800px;
            margin: 0 auto;
        }
        
        .form-header {
            background: linear-gradient(135deg, #ffc107, #ffb300);
            color: #212529;
            padding: 30px;
            border-radius: 15px 15px 0 0;
            margin-bottom: 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .form-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.2), transparent);
            transform: rotate(45deg);
            animation: shine 3s infinite;
        }
        
        @keyframes shine {
            0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
            100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
        }
        
        .form-title {
            font-weight: 700;
            margin: 0;
            font-size: 2rem;
            position: relative;
            z-index: 1;
        }
        
        .form-subtitle {
            opacity: 0.8;
            margin: 10px 0 0 0;
            font-size: 1.1rem;
            position: relative;
            z-index: 1;
        }
        
        .form-card {
            background: white;
            border-radius: 0 0 15px 15px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            border: 1px solid #e9ecef;
            border-top: none;
        }
        
        .form-group {
            margin-bottom: 30px;
        }
        
        .form-label {
            font-weight: 600;
            color: #17a2b8;
            margin-bottom: 10px;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
        }
        
        .form-label i {
            margin-right: 10px;
            color: #ffc107;
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
            border-color: #ffc107;
            background: white;
            box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.1);
            transform: translateY(-2px);
        }
        
        .form-control-custom:hover {
            border-color: #ced4da;
            background: white;
        }
        
        .btn-warning-custom {
            background: linear-gradient(135deg, #ffc107, #ffb300);
            border: none;
            color: #212529;
            padding: 15px 40px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(255, 193, 7, 0.3);
        }
        
        .btn-warning-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(255, 193, 7, 0.4);
            background: linear-gradient(135deg, #e0a800, #ff8f00);
            color: #212529;
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
        
        .form-actions {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 40px;
            flex-wrap: wrap;
        }
        
        .form-help {
            background: linear-gradient(135deg, #fff3cd, #ffeaa7);
            border-left: 4px solid #ffc107;
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
        
        .currency-symbol {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #28a745;
            font-weight: 600;
            z-index: 2;
        }
        
        .vaccin-info {
            background: linear-gradient(135deg, #d1ecf1, #bee5eb);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 25px;
            border-left: 4px solid #17a2b8;
        }
        
        .vaccin-info-title {
            color: #0c5460;
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 1.1rem;
        }
        
        .vaccin-info-content {
            color: #0c5460;
            margin: 0;
        }
        
        .edit-badge {
            background: linear-gradient(135deg, #ffc107, #ffb300);
            color: #212529;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
            display: inline-block;
            margin-bottom: 15px;
        }
        
        .change-indicator {
            display: inline-block;
            width: 8px;
            height: 8px;
            background: #28a745;
            border-radius: 50%;
            margin-left: 5px;
            animation: blink 2s infinite;
        }
        
        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.3; }
        }
        
        @media (max-width: 768px) {
            .form-header {
                padding: 20px;
            }
            
            .form-card {
                padding: 25px;
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
    </style>

    <div class="form-container">
        <!-- En-tête du formulaire -->
        <div class="form-header">
            <span class="edit-badge">
                <i class="fas fa-edit me-1"></i>Mode Édition Vaccin
            </span>
            <h1 class="form-title">
                <i class="fas fa-syringe me-2"></i>Modifier le Vaccin
            </h1>
            <p class="form-subtitle">Mettez à jour les informations de ce vaccin vétérinaire</p>
        </div>

        <!-- Carte du formulaire -->
        <div class="form-card">
            <!-- Informations actuelles -->
            <div class="vaccin-info">
                <div class="vaccin-info-title">
                    <i class="fas fa-info-circle me-2"></i>Vaccin en cours de modification
                </div>
                <p class="vaccin-info-content">
                    Vous modifiez le vaccin : <strong>"{{ $vaccin->nom }}"</strong> - 
                    Actuellement à <strong>{{ $vaccin->frais }} DT</strong>
                </p>
            </div>

            <!-- Aide contextuelle -->
            <div class="form-help">
                <div class="form-help-title">
                    <i class="fas fa-lightbulb me-2"></i>Conseils de modification
                </div>
                <p class="form-help-text">
                    Modifiez les informations nécessaires. Les changements seront appliqués immédiatement 
                    après validation. Assurez-vous de maintenir des noms standardisés pour les vaccins.
                </p>
            </div>

            <form action="{{ route('vet.vaccins.update', $vaccin->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Nom du vaccin -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-syringe"></i>Nom du vaccin
                        <span id="nom-change-indicator" class="change-indicator" style="display: none;"></span>
                    </label>
                    <div class="input-icon">
                        <i class="fas fa-prescription-bottle"></i>
                        <input type="text" name="nom" id="nom-input" class="form-control form-control-custom" 
                               value="{{ $vaccin->nom }}"
                               placeholder="Ex: Vaccin CHPPi-LR, Vaccin TRICAT..." 
                               required>
                    </div>
                    <small class="text-muted mt-2 d-block">
                        <i class="fas fa-pencil-alt me-1"></i>Modifiez le nom du vaccin si nécessaire
                    </small>
                </div>

                <!-- Frais -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-money-bill-wave"></i>Frais du vaccin
                        <span id="frais-change-indicator" class="change-indicator" style="display: none;"></span>
                    </label>
                    <div class="input-icon position-relative">
                        <i class="fas fa-calculator"></i>
                        <input type="number" step="0.01" name="frais" id="frais-input" class="form-control form-control-custom" 
                               value="{{ $vaccin->frais }}"
                               placeholder="0.00" 
                               min="0"
                               required>
                        <span class="currency-symbol">DT</span>
                    </div>
                    <small class="text-muted mt-2 d-block">
                        <i class="fas fa-sync-alt me-1"></i>Ajustez le coût en dinars tunisiens (DT)
                    </small>
                </div>

                <!-- Actions du formulaire -->
                <div class="form-actions">
                    <button type="submit" class="btn btn-warning-custom">
                        <i class="fas fa-check-circle me-2"></i>Confirmer la modification
                    </button>
                    <a href="{{ route('vet.vaccins.index') }}" class="btn btn-secondary-custom">
                        <i class="fas fa-times me-2"></i>Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const nomInput = document.getElementById('nom-input');
        const fraisInput = document.getElementById('frais-input');
        const nomChangeIndicator = document.getElementById('nom-change-indicator');
        const fraisChangeIndicator = document.getElementById('frais-change-indicator');
        
        const originalNom = "{{ $vaccin->nom }}";
        const originalFrais = "{{ $vaccin->frais }}";
        
        // Animation des champs au focus
        const inputs = document.querySelectorAll('.form-control-custom');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });
        
        // Détection des changements
        function checkForChanges() {
            const hasNomChanged = nomInput.value !== originalNom;
            const hasFraisChanged = fraisInput.value !== originalFrais;
            
            // Afficher/masquer les indicateurs de changement
            nomChangeIndicator.style.display = hasNomChanged ? 'inline-block' : 'none';
            fraisChangeIndicator.style.display = hasFraisChanged ? 'inline-block' : 'none';
            
            // Changer la couleur des champs modifiés
            nomInput.style.borderColor = hasNomChanged ? '#ffc107' : '#e9ecef';
            nomInput.style.background = hasNomChanged ? '#fff3cd' : '#f8f9fa';
            
            fraisInput.style.borderColor = hasFraisChanged ? '#ffc107' : '#e9ecef';
            fraisInput.style.background = hasFraisChanged ? '#fff3cd' : '#f8f9fa';
        }
        
        // Écouter les changements
        nomInput.addEventListener('input', checkForChanges);
        fraisInput.addEventListener('input', checkForChanges);
        
        // Validation des frais
        fraisInput.addEventListener('input', function() {
            if (this.value < 0) {
                this.style.borderColor = '#dc3545';
                this.style.background = '#f8d7da';
            }
        });
        
        // Confirmation avant soumission
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            const newNom = nomInput.value;
            const newFrais = fraisInput.value;
            
            const hasChanges = newNom !== originalNom || newFrais !== originalFrais;
            
            if (!hasChanges) {
                alert('⚠️ Aucune modification détectée. Le vaccin reste inchangé.');
                e.preventDefault();
                return;
            }
            
            let message = `Confirmez-vous la modification du vaccin ?\n\n`;
            message += `📋 Ancien nom: ${originalNom}\n`;
            message += `🆕 Nouveau nom: ${newNom}\n\n`;
            message += `💰 Ancien frais: ${originalFrais} DT\n`;
            message += `💵 Nouveaux frais: ${newFrais} DT`;
            
            if (!confirm(message)) {
                e.preventDefault();
            }
        });
        
        // Initialiser la vérification des changements
        checkForChanges();
        
        // Effet de focus amélioré
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.style.boxShadow = '0 0 0 3px rgba(255, 193, 7, 0.2)';
            });
            
            input.addEventListener('blur', function() {
                this.style.boxShadow = '';
            });
        });
    });
</script>
@endsection