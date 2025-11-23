@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <style>
        .form-container {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 900px;
            margin: 0 auto;
        }
        
        .form-header {
            background: linear-gradient(135deg, #3498db, #2c3e50);
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
            color: #2c3e50;
            margin-bottom: 10px;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
        }
        
        .form-label i {
            margin-right: 10px;
            color: #3498db;
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
            border-color: #3498db;
            background: white;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.1);
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
        
        .btn-outline-primary-custom {
            background: transparent;
            border: 2px solid #3498db;
            color: #3498db;
            padding: 10px 20px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        
        .btn-outline-primary-custom:hover {
            background: #3498db;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
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
        
        .management-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }
        
        .photo-preview {
            width: 150px;
            height: 150px;
            border-radius: 10px;
            object-fit: cover;
            border: 2px dashed #3498db;
            display: none;
            margin-top: 10px;
        }
        
        .photo-upload-area {
            border: 2px dashed #3498db;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            background: #f8f9fa;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .photo-upload-area:hover {
            background: #e3f2fd;
            border-color: #2980b9;
        }
        
        .photo-upload-area i {
            font-size: 2rem;
            color: #3498db;
            margin-bottom: 10px;
        }
        
        @media (max-width: 768px) {
            .form-header {
                padding: 20px;
            }
            
            .form-card {
                padding: 25px;
            }
            
            .form-actions, .management-buttons {
                flex-direction: column;
            }
            
            .btn-success-custom,
            .btn-secondary-custom,
            .btn-outline-primary-custom {
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
        
        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .form-col {
            flex: 1;
        }
        
        @media (max-width: 768px) {
            .form-row {
                flex-direction: column;
                gap: 0;
            }
        }
    </style>

    <div class="form-container">
        <!-- En-tête du formulaire -->
        <div class="form-header">
            <h1 class="form-title floating-animation">
                <i class="fas fa-paw me-2"></i>Ajouter un Animal
            </h1>
            <p class="form-subtitle">Enregistrez un nouvel animal dans le refuge</p>
        </div>

        <!-- Carte du formulaire -->
        <div class="form-card">
            <!-- Boutons de gestion -->
            <div class="management-buttons">
                <a href="{{ route('especes.index') }}" class="btn btn-outline-primary-custom">
                    <i class="fas fa-dog me-2"></i>Gérer les espèces
                </a>
                <a href="{{ route('races.index') }}" class="btn btn-outline-primary-custom">
                    <i class="fas fa-list me-2"></i>Gérer les races
                </a>
            </div>

            <!-- Aide contextuelle -->
            <div class="form-help">
                <div class="form-help-title">
                    <i class="fas fa-info-circle me-2"></i>Informations importantes
                </div>
                <p class="form-help-text">
                    Remplissez toutes les informations concernant l'animal. Les champs marqués d'un astérisque (*) sont obligatoires.
                    Assurez-vous de sélectionner d'abord l'espèce pour charger les races correspondantes.
                </p>
            </div>

            <form action="{{ route('animaux.store') }}" method="POST" enctype="multipart/form-data" id="animal-form">
                @csrf

                <div class="form-row">
                    <!-- Nom de l'animal -->
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-signature"></i>Nom de l'animal *
                            </label>
                            <div class="input-icon">
                                <i class="fas fa-paw"></i>
                                <input type="text" name="nom" class="form-control form-control-custom" 
                                       placeholder="Ex: Max, Bella, Luna..." 
                                       required>
                            </div>
                        </div>
                    </div>

                    <!-- Âge -->
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-birthday-cake"></i>Âge (années)
                            </label>
                            <div class="input-icon">
                                <i class="fas fa-calendar-alt"></i>
                                <input type="number" name="age" class="form-control form-control-custom" 
                                       placeholder="Ex: 2" min="0" max="30">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <!-- Espèce -->
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-dog"></i>Espèce *
                            </label>
                            <select name="espece_id" id="espece" class="form-control form-control-custom" required>
                                <option value="">-- Choisir une espèce --</option>
                                @foreach($especes as $espece)
                                    <option value="{{ $espece->id }}">{{ $espece->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Race -->
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-list"></i>Race
                            </label>
                            <select name="race_id" id="race" class="form-control form-control-custom">
                                <option value="">-- Choisir une espèce d'abord --</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <!-- Sexe -->
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-venus-mars"></i>Sexe
                            </label>
                            <select name="sexe" class="form-control form-control-custom">
                                <option value="feminin">Femelle</option>
                                <option value="masculin">Mâle</option>
                            </select>
                        </div>
                    </div>

                    <!-- État de santé -->
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-heartbeat"></i>État de santé
                            </label>
                            <select name="etat_sante" class="form-control form-control-custom">
                                <option value="sain">Sain</option>
                                <option value="malade léger">Malade léger</option>
                                <option value="malade grave">Malade grave</option>
                                <option value="blessé">Blessé</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Statut -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-home"></i>Statut
                    </label>
                    <select name="statut" class="form-control form-control-custom">
                        <option value="adopter">À adopter</option>
                        <option value="adopté">Adopté</option>
                        <option value="hébergé">Hébergé</option>
                        <option value="assigner">Assigné</option>
                        <option value="à vacciner">À vacciner</option>
                    </select>
                </div>

                <!-- Photo -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-camera"></i>Photo de l'animal
                    </label>
                    <div class="photo-upload-area" id="photo-upload-area">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <p>Cliquez pour télécharger une photo</p>
                        <input type="file" name="photo" id="photo-input" class="d-none" accept="image/*">
                    </div>
                    <img id="photo-preview" class="photo-preview" src="#" alt="Aperçu de la photo">
                </div>

                <!-- Actions du formulaire -->
                <div class="form-actions">
                    <button type="submit" class="btn btn-success-custom">
                        <i class="fas fa-plus-circle me-2"></i>Ajouter l'animal
                    </button>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary-custom">
                        <i class="fas fa-arrow-left me-2"></i>Retour
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
            this.style.transform = 'translateY(-2px)';
            this.style.boxShadow = '0 5px 15px rgba(52, 152, 219, 0.2)';
        });
        
        input.addEventListener('blur', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = 'none';
        });
    });
    
    // Gestion de l'upload de photo
    const photoUploadArea = document.getElementById('photo-upload-area');
    const photoInput = document.getElementById('photo-input');
    const photoPreview = document.getElementById('photo-preview');
    
    photoUploadArea.addEventListener('click', function() {
        photoInput.click();
    });
    
    photoInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                photoPreview.src = e.target.result;
                photoPreview.style.display = 'block';
                photoUploadArea.style.display = 'none';
            }
            
            reader.readAsDataURL(this.files[0]);
        }
    });
    
    // Chargement dynamique des races
    document.getElementById('espece').addEventListener('change', function () {
        let especeId = this.value;
        let raceSelect = document.getElementById('race');
        
        // Afficher un indicateur de chargement
        raceSelect.innerHTML = '<option value="">Chargement...</option>';
        
        if (!especeId) {
            raceSelect.innerHTML = '<option value="">-- Choisir une espèce d\'abord --</option>';
            return;
        }
        
        fetch('/races/by-espece/' + especeId)
            .then(res => {
                if (!res.ok) throw new Error('Erreur de chargement');
                return res.json();
            })
            .then(data => {
                raceSelect.innerHTML = '<option value="">-- Sélectionner --</option>';
                
                if (data.length === 0) {
                    raceSelect.innerHTML += '<option value="">Aucune race disponible</option>';
                } else {
                    data.forEach(race => {
                        raceSelect.innerHTML += `<option value="${race.id}">${race.nom}</option>`;
                    });
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                raceSelect.innerHTML = '<option value="">Erreur de chargement</option>';
            });
    });
    
    // Validation en temps réel
    const form = document.getElementById('animal-form');
    const nomInput = document.querySelector('input[name="nom"]');
    const ageInput = document.querySelector('input[name="age"]');
    
    nomInput.addEventListener('input', function() {
        if (this.value.length < 2) {
            this.style.borderColor = '#dc3545';
            this.style.background = '#f8d7da';
        } else {
            this.style.borderColor = '#28a745';
            this.style.background = '#f8f9fa';
        }
    });
    
    ageInput.addEventListener('input', function() {
        if (this.value < 0 || this.value > 30) {
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
        const espece = document.querySelector('select[name="espece_id"]');
        const especeText = espece.options[espece.selectedIndex].text;
        
        if (!confirm(`Confirmez-vous l'ajout de l'animal "${nom}" (${especeText}) ?`)) {
            e.preventDefault();
        }
    });
});
</script>
@endsection