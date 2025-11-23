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
            background: linear-gradient(135deg, #ffc107, #ffdb4d);
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
            color: #2c5530;
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
        
        .soin-info {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 25px;
            border-left: 4px solid #2196f3;
        }
        
        .soin-info-title {
            color: #1976d2;
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 1.1rem;
        }
        
        .soin-info-content {
            color: #1565c0;
            margin: 0;
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
    </style>

    <div class="form-container">
        <!-- En-tête du formulaire -->
        <div class="form-header">
            <span class="edit-badge">
                <i class="fas fa-edit me-1"></i>Mode édition
            </span>
            <h1 class="form-title">
                <i class="fas fa-edit me-2"></i>Modifier le Soin
            </h1>
            <p class="form-subtitle">Mettez à jour les informations du soin vétérinaire</p>
        </div>

        <!-- Carte du formulaire -->
        <div class="form-card">
            <!-- Informations actuelles -->
            <div class="soin-info">
                <div class="soin-info-title">
                    <i class="fas fa-info-circle me-2"></i>Soin en cours de modification
                </div>
                <p class="soin-info-content">
                    Vous modifiez le soin : <strong>"{{ $soin->nom }}"</strong> - 
                    Actuellement à <strong>{{ $soin->frais }} DT</strong>
                </p>
            </div>

            <!-- Aide contextuelle -->
            <div class="form-help">
                <div class="form-help-title">
                    <i class="fas fa-lightbulb me-2"></i>Conseils de modification
                </div>
                <p class="form-help-text">
                    Modifiez les informations nécessaires. Les changements seront appliqués immédiatement 
                    après validation. Assurez-vous de la précision des informations.
                </p>
            </div>

            <form action="{{ route('vet.soins.update', $soin->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Nom du soin -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-tag"></i>Nom du soin
                    </label>
                    <div class="input-icon">
                        <i class="fas fa-stethoscope"></i>
                        <input type="text" name="nom" class="form-control form-control-custom" 
                               value="{{ $soin->nom }}"
                               placeholder="Ex: Consultation générale, Vaccination annuelle..." 
                               required>
                    </div>
                    <small class="text-muted mt-2 d-block">
                        <i class="fas fa-pencil-alt me-1"></i>Modifiez le nom du soin si nécessaire
                    </small>
                </div>

                <!-- Frais -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-money-bill-wave"></i>Frais du soin
                    </label>
                    <div class="input-icon position-relative">
                        <i class="fas fa-calculator"></i>
                        <input type="number" step="0.01" name="frais" class="form-control form-control-custom" 
                               value="{{ $soin->frais }}"
                               placeholder="0.00" 
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
                    <a href="{{ route('vet.soins.index') }}" class="btn btn-secondary-custom">
                        <i class="fas fa-times me-2"></i>Annuler
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
        
        // Validation en temps réel
        const form = document.querySelector('form');
        const fraisInput = document.querySelector('input[name="frais"]');
        const nomInput = document.querySelector('input[name="nom"]');
        
        fraisInput.addEventListener('input', function() {
            if (this.value < 0) {
                this.style.borderColor = '#dc3545';
                this.style.background = '#f8d7da';
            } else {
                this.style.borderColor = '#28a745';
                this.style.background = '#f8f9fa';
            }
        });
        
        // Vérification des modifications
        form.addEventListener('submit', function(e) {
            const originalNom = "{{ $soin->nom }}";
            const originalFrais = "{{ $soin->frais }}";
            const newNom = nomInput.value;
            const newFrais = fraisInput.value;
            
            const hasChanges = originalNom !== newNom || originalFrais !== newFrais;
            
            if (!hasChanges) {
                alert('Aucune modification détectée. Le soin reste inchangé.');
                e.preventDefault();
                return;
            }
            
            if (!confirm(`Confirmez-vous la modification du soin ?\n\nAncien nom: ${originalNom}\nNouveau nom: ${newNom}\n\nAncien frais: ${originalFrais} DT\nNouveaux frais: ${newFrais} DT`)) {
                e.preventDefault();
            }
        });
        
        // Indication visuelle des champs modifiés
        inputs.forEach(input => {
            const originalValue = input.value;
            
            input.addEventListener('input', function() {
                if (this.value !== originalValue) {
                    this.style.borderColor = '#ffc107';
                    this.style.background = '#fff3cd';
                } else {
                    this.style.borderColor = '#e9ecef';
                    this.style.background = '#f8f9fa';
                }
            });
        });
    });
</script>
@endsection