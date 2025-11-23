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
            background: linear-gradient(135deg, #dc3545, #e35d6a);
            color: white;
            padding: 30px;
            border-radius: 15px 15px 0 0;
            margin-bottom: 0;
            text-align: center;
        }
        
        .form-title {
            font-weight: 700;
            margin: 0;
            font-size: 2rem;
        }
        
        .form-subtitle {
            opacity: 0.9;
            margin: 10px 0 0 0;
            font-size: 1.1rem;
        }
        
        .form-card {
            background: white;
            border-radius: 0 0 15px 15px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
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
            color: #dc3545;
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
            border-color: #dc3545;
            background: white;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.1);
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
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            border-left: 4px solid #2196f3;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
        }
        
        .form-help-title {
            color: #1976d2;
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 1.1rem;
        }
        
        .form-help-text {
            color: #1565c0;
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
            <h1 class="form-title floating-animation">
                <i class="fas fa-hand-holding-medical me-2"></i>Nouveau Soin
            </h1>
            <p class="form-subtitle">Ajoutez un nouveau soin vétérinaire à votre catalogue</p>
        </div>

        <!-- Carte du formulaire -->
        <div class="form-card">
            <!-- Aide contextuelle -->
            <div class="form-help">
                <div class="form-help-title">
                    <i class="fas fa-info-circle me-2"></i>Informations importantes
                </div>
                <p class="form-help-text">
                    Remplissez les informations du soin vétérinaire. Le nom doit être clair et descriptif, 
                    et les frais doivent refléter le coût réel du service.
                </p>
            </div>

            <form action="{{ route('vet.soins.store') }}" method="POST">
                @csrf

                <!-- Nom du soin -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-tag"></i>Nom du soin
                    </label>
                    <div class="input-icon">
                        <i class="fas fa-stethoscope"></i>
                        <input type="text" name="nom" class="form-control form-control-custom" 
                               placeholder="Ex: Consultation générale, Vaccination annuelle..." 
                               required>
                    </div>
                    <small class="text-muted mt-2 d-block">
                        <i class="fas fa-lightbulb me-1"></i>Choisissez un nom clair et descriptif pour ce soin
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
                               placeholder="0.00" 
                               required>
                        <span class="currency-symbol">DT</span>
                    </div>
                    <small class="text-muted mt-2 d-block">
                        <i class="fas fa-info-circle me-1"></i>Indiquez le coût en dinars tunisiens (DT)
                    </small>
                </div>

                <!-- Actions du formulaire -->
                <div class="form-actions">
                    <button type="submit" class="btn btn-success-custom">
                        <i class="fas fa-save me-2"></i>Enregistrer le soin
                    </button>
                    <a href="{{ route('vet.soins.index') }}" class="btn btn-secondary-custom">
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
        
        // Validation en temps réel
        const form = document.querySelector('form');
        const fraisInput = document.querySelector('input[name="frais"]');
        
        fraisInput.addEventListener('input', function() {
            if (this.value < 0) {
                this.style.borderColor = '#dc3545';
                this.style.background = '#f8d7da';
            } else {
                this.style.borderColor = '#28a745';
                this.style.background = '#f8f9fa';
            }
        });
        
        // Confirmation avant soumission
        form.addEventListener('submit', function(e) {
            const nom = document.querySelector('input[name="nom"]').value;
            const frais = document.querySelector('input[name="frais"]').value;
            
            if (!confirm(`Confirmez-vous l'ajout du soin "${nom}" pour ${frais} DT ?`)) {
                e.preventDefault();
            }
        });
    });
</script>
@endsection