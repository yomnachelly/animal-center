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
            background: linear-gradient(135deg, #17a2b8, #20c997);
            color: white;
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
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
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
            opacity: 0.9;
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
            color: #17a2b8;
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
            border-color: #17a2b8;
            background: white;
            box-shadow: 0 0 0 0.2rem rgba(23, 162, 184, 0.1);
            transform: translateY(-2px);
        }
        
        .form-control-custom:hover {
            border-color: #ced4da;
            background: white;
        }
        
        .btn-success-custom {
            background: linear-gradient(135deg, #28a745, #20c997);
            border: none;
            color: white;
            padding: 15px 40px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
        }
        
        .btn-success-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(40, 167, 69, 0.4);
            background: linear-gradient(135deg, #218838, #1e9e8a);
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
            background: linear-gradient(135deg, #d1ecf1, #bee5eb);
            border-left: 4px solid #17a2b8;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
        }
        
        .form-help-title {
            color: #0c5460;
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 1.1rem;
        }
        
        .form-help-text {
            color: #0c5460;
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
        
        .vaccin-badge {
            background: linear-gradient(135deg, #17a2b8, #20c997);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
            display: inline-block;
            margin-bottom: 15px;
        }
        
        .protection-icon {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
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
            
            .btn-success-custom,
            .btn-secondary-custom {
                width: 100%;
                padding: 12px 30px;
            }
        }
        
        .example-vaccins {
            background: linear-gradient(135deg, #e8f5e8, #d4edda);
            border-radius: 10px;
            padding: 15px;
            margin-top: 10px;
            border-left: 4px solid #28a745;
        }
        
        .example-title {
            color: #155724;
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 8px;
        }
        
        .example-list {
            color: #155724;
            font-size: 0.85rem;
            margin: 0;
        }
    </style>

    <div class="form-container">
        <!-- En-tête du formulaire -->
        <div class="form-header">
            <span class="vaccin-badge">
                <i class="fas fa-shield-alt me-1"></i>Nouvelle Protection
            </span>
            <h1 class="form-title">
                <i class="fas fa-syringe protection-icon me-2"></i>Nouveau Vaccin
            </h1>
            <p class="form-subtitle">Ajoutez un nouveau vaccin à votre arsenal médical vétérinaire</p>
        </div>

        <!-- Carte du formulaire -->
        <div class="form-card">
            <!-- Aide contextuelle -->
            <div class="form-help">
                <div class="form-help-title">
                    <i class="fas fa-info-circle me-2"></i>Informations importantes sur les vaccins
                </div>
                <p class="form-help-text">
                    Les vaccins sont essentiels pour prévenir les maladies animales. Renseignez un nom clair 
                    et des frais appropriés pour chaque type de vaccination.
                </p>
            </div>

            <!-- Exemples de vaccins -->
            <div class="example-vaccins">
                <div class="example-title">
                    <i class="fas fa-lightbulb me-1"></i>Exemples de vaccins courants :
                </div>
                <p class="example-list">
                    • Vaccin CHPPi-LR (chien) • Vaccin TRICAT (chat) • Vaccin rage • Vaccin leucose • Vaccin typhus
                </p>
            </div>

            <form action="{{ route('vet.vaccins.store') }}" method="POST">
                @csrf

                <!-- Nom du vaccin -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-syringe"></i>Nom du vaccin
                    </label>
                    <div class="input-icon">
                        <i class="fas fa-prescription-bottle"></i>
                        <input type="text" name="nom" class="form-control form-control-custom" 
                               placeholder="Ex: Vaccin CHPPi-LR, Vaccin TRICAT, Vaccin rage..." 
                               required>
                    </div>
                    <small class="text-muted mt-2 d-block">
                        <i class="fas fa-tags me-1"></i>Utilisez un nom standardisé et reconnaissable
                    </small>
                </div>

                <!-- Frais -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-money-bill-wave"></i>Frais du vaccin
                    </label>
                    <div class="input-icon position-relative">
                        <i class="fas fa-calculator"></i>
                        <input type="number" step="0.01" name="frais" class="form-control form-control-custom" 
                               placeholder="0.00" 
                               min="0"
                               required>
                        <span class="currency-symbol">DT</span>
                    </div>
                    <small class="text-muted mt-2 d-block">
                        <i class="fas fa-hand-holding-usd me-1"></i>Indiquez le coût en dinars tunisiens (DT)
                    </small>
                </div>

                <!-- Actions du formulaire -->
                <div class="form-actions">
                    <button type="submit" class="btn btn-success-custom">
                        <i class="fas fa-syringe me-2"></i>Enregistrer le vaccin
                    </button>
                    <a href="{{ route('vet.vaccins.index') }}" class="btn btn-secondary-custom">
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
                this.parentElement.style.transform = 'scale(1.02)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });
        
        // Validation en temps réel pour les frais
        const fraisInput = document.querySelector('input[name="frais"]');
        
        fraisInput.addEventListener('input', function() {
            if (this.value < 0) {
                this.style.borderColor = '#dc3545';
                this.style.background = '#f8d7da';
                this.nextElementSibling.style.color = '#dc3545';
            } else {
                this.style.borderColor = '#28a745';
                this.style.background = '#f8f9fa';
                this.nextElementSibling.style.color = '#28a745';
            }
        });
        
        // Suggestion automatique pour les noms de vaccins
        const nomInput = document.querySelector('input[name="nom"]');
        const vaccinSuggestions = [
            'Vaccin CHPPi-LR',
            'Vaccin TRICAT',
            'Vaccin rage',
            'Vaccin leucose',
            'Vaccin typhus',
            'Vaccin parvovirose',
            'Vaccin toux du chenil',
            'Vaccin leptospirose',
            'Vaccin rhinotrachéite',
            'Vaccin calicivirus'
        ];
        
        nomInput.addEventListener('focus', function() {
            this.setAttribute('list', 'vaccin-suggestions');
        });
        
        // Création de la datalist pour les suggestions
        const datalist = document.createElement('datalist');
        datalist.id = 'vaccin-suggestions';
        
        vaccinSuggestions.forEach(suggestion => {
            const option = document.createElement('option');
            option.value = suggestion;
            datalist.appendChild(option);
        });
        
        document.body.appendChild(datalist);
        
        // Confirmation avant soumission
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            const nom = nomInput.value;
            const frais = fraisInput.value;
            
            if (!confirm(`Confirmez-vous l'ajout du vaccin "${nom}" pour ${frais} DT ?`)) {
                e.preventDefault();
            }
        });
        
        // Effet de validation visuelle
        nomInput.addEventListener('input', function() {
            if (this.value.length > 2) {
                this.style.borderColor = '#17a2b8';
                this.style.background = '#f0f9ff';
            } else {
                this.style.borderColor = '#e9ecef';
                this.style.background = '#f8f9fa';
            }
        });
    });
</script>
@endsection