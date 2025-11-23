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
        
        .input-group-custom {
            position: relative;
        }
        
        .input-group-custom .form-control-custom {
            padding-left: 50px;
        }
        
        .currency-symbol {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #28a745;
            font-weight: 700;
            font-size: 1.2rem;
            z-index: 2;
        }
        
        .current-value {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
            margin-top: 10px;
            border: 2px solid #e9ecef;
        }
        
        .current-value-label {
            color: #6c757d;
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .current-value-amount {
            font-size: 1.5rem;
            font-weight: 800;
            color: #28a745;
            display: flex;
            align-items: center;
            gap: 8px;
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
                Modifier le Frais Journalier
            </h1>
            <p class="form-subtitle">Ajustez le tarif journalier appliqué aux animaux</p>
        </div>

        <!-- Carte du formulaire -->
        <div class="form-card">
            <!-- Informations actuelles -->
            <div class="info-card">
                <div class="info-card-title">
                    <i class="fas fa-info-circle"></i>
                    Valeur actuelle
                </div>
                <div class="current-value">
                    <div class="current-value-label">Tarif journalier en cours :</div>
                    <div class="current-value-amount">
                        <span>DT</span>

                        {{ number_format($paiement->frais_jour, 2) }} DT
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
                    La modification du frais journalier impacte immédiatement tous les nouveaux séjours. 
                    Les séjours en cours conservent l'ancien tarif.
                </p>
            </div>

            <form action="{{ route('admin.paiements.update', $paiement) }}" method="POST" id="paiementForm">
                @csrf
                @method('PUT')
                
                <!-- Frais journalier -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-money-bill-wave"></i>Nouveau frais journalier
                        <span class="change-indicator" id="changeIndicator">
                            <i class="fas fa-pencil-alt"></i> Modifié
                        </span>
                    </label>
                    <div class="input-group-custom">
                        <span class="currency-symbol">DT</span>
                        <input type="number" step="0.01" class="form-control form-control-custom" 
                               id="frais_jour" name="frais_jour" 
                               value="{{ $paiement->frais_jour }}" 
                               min="0.01" max="1000"
                               required
                               placeholder="0.00">
                    </div>
                    <small class="text-muted mt-2 d-block">
                        <i class="fas fa-info-circle me-1"></i>
                        Saisissez le montant en dinar tunisien (ex: 15.50 pour 15.50DT)
                    </small>
                </div>

                <!-- Actions du formulaire -->
                <div class="form-actions">
                    <button type="submit" class="btn btn-warning-custom" id="submitBtn">
                        <i class="fas fa-save"></i>
                        Mettre à jour le tarif
                    </button>
                    <a href="{{ route('admin.paiements.index') }}" class="btn btn-secondary-custom">
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
    const fraisInput = document.getElementById('frais_jour');
    const changeIndicator = document.getElementById('changeIndicator');
    const submitBtn = document.getElementById('submitBtn');
    const form = document.getElementById('paiementForm');
    const originalValue = parseFloat("{{ $paiement->frais_jour }}");
    let hasChanged = false;

    // Initialisation
    updateSubmitButton();

    // Détection des changements
    fraisInput.addEventListener('input', function() {
        const newValue = parseFloat(this.value) || 0;
        hasChanged = Math.abs(newValue - originalValue) > 0.001;
        
        // Mettre à jour l'indicateur visuel
        changeIndicator.classList.toggle('show', hasChanged);
        
        // Validation
        validateFrais(newValue);
        updateSubmitButton();
    });

    // Validation en temps réel
    fraisInput.addEventListener('blur', function() {
        const value = parseFloat(this.value) || 0;
        validateFrais(value);
    });

    function validateFrais(value) {
        if (value === originalValue && !hasChanged) {
            return false;
        }
        
        if (value < 0.01) {
            showValidationState('Le frais doit être au moins de 0.01€', 'invalid');
            return false;
        }
        
        if (value > 1000) {
            showValidationState('Le frais ne peut pas dépasser 1000€', 'invalid');
            return false;
        }
        
        if (hasChanged) {
            showValidationState('Valeur valide - Prêt à mettre à jour', 'valid');
        }
        return true;
    }

    function showValidationState(message, type) {
        // Vous pouvez ajouter un élément de feedback si nécessaire
        console.log(message, type);
    }

    function updateSubmitButton() {
        const value = parseFloat(fraisInput.value) || 0;
        const isValid = validateFrais(value);
        
        if (hasChanged && isValid) {
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="fas fa-save"></i> Mettre à jour le tarif';
        } else {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-check"></i> Aucune modification';
        }
    }

    // Animation du champ
    fraisInput.addEventListener('focus', function() {
        this.style.transform = 'translateY(-2px)';
        this.style.boxShadow = '0 5px 15px rgba(255, 154, 158, 0.2)';
    });
    
    fraisInput.addEventListener('blur', function() {
        this.style.transform = 'translateY(0)';
        this.style.boxShadow = 'none';
    });

    // Confirmation avant soumission
    form.addEventListener('submit', function(e) {
        const newValue = parseFloat(fraisInput.value) || 0;
        
        if (!hasChanged) {
            e.preventDefault();
            alert('Aucune modification détectée.');
            return;
        }
        
        if (!validateFrais(newValue)) {
            e.preventDefault();
            return;
        }
        
        const difference = newValue - originalValue;
        const differenceText = difference >= 0 ? 
            `+${difference.toFixed(2)}€` : 
            `${difference.toFixed(2)}€`;
        
        const confirmationMessage = 
            `Confirmez-vous la modification du frais journalier ?\n\n` +
            `Ancien tarif: ${originalValue.toFixed(2)}€\n` +
            `Nouveau tarif: ${newValue.toFixed(2)}€\n` +
            `Variation: ${differenceText}\n\n` +
            `Cette modification impacte tous les nouveaux séjours.`;
        
        if (!confirm(confirmationMessage)) {
            e.preventDefault();
        }
    });
});
</script>

@endsection