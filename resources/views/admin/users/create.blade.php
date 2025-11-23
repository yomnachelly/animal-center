@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <style>
        .user-form-container {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 800px;
            margin: 0 auto;
        }
        
        .form-header {
            background: linear-gradient(135deg, #6f42c1, #8e44ad);
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
            margin-bottom: 25px;
        }
        
        .form-label {
            font-weight: 600;
            color: #6f42c1;
            margin-bottom: 8px;
            font-size: 1rem;
            display: flex;
            align-items: center;
        }
        
        .form-label i {
            margin-right: 8px;
            color: #6f42c1;
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }
        
        .form-control-custom {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }
        
        .form-control-custom:focus {
            border-color: #6f42c1;
            background: white;
            box-shadow: 0 0 0 0.2rem rgba(111, 66, 193, 0.1);
            transform: translateY(-2px);
        }
        
        .form-control-custom:hover {
            border-color: #ced4da;
            background: white;
        }
        
        .form-select-custom {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
            cursor: pointer;
        }
        
        .form-select-custom:focus {
            border-color: #6f42c1;
            background: white;
            box-shadow: 0 0 0 0.2rem rgba(111, 66, 193, 0.1);
            transform: translateY(-2px);
        }
        
        .btn-primary-custom {
            background: linear-gradient(135deg, #6f42c1, #8e44ad);
            border: none;
            color: white;
            padding: 15px 40px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(111, 66, 193, 0.3);
            width: 100%;
            margin-top: 10px;
        }
        
        .btn-primary-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(111, 66, 193, 0.4);
            background: linear-gradient(135deg, #5a2d91, #732d91);
        }
        
        .form-help {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            border-left: 4px solid #2196f3;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 25px;
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
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            z-index: 2;
        }
        
        .input-icon .form-control-custom {
            padding-left: 45px;
        }
        
        .input-icon .form-select-custom {
            padding-left: 45px;
        }
        
        .password-strength {
            height: 4px;
            background: #e9ecef;
            border-radius: 2px;
            margin-top: 5px;
            overflow: hidden;
        }
        
        .password-strength-bar {
            height: 100%;
            width: 0%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }
        
        .password-strength.weak .password-strength-bar {
            background: #dc3545;
            width: 33%;
        }
        
        .password-strength.medium .password-strength-bar {
            background: #ffc107;
            width: 66%;
        }
        
        .password-strength.strong .password-strength-bar {
            background: #28a745;
            width: 100%;
        }
        
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        
        .role-option {
            display: flex;
            align-items: center;
            padding: 10px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            margin-bottom: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .role-option:hover {
            border-color: #6f42c1;
            background: #f8f9fa;
        }
        
        .role-option.selected {
            border-color: #6f42c1;
            background: linear-gradient(135deg, #f3f0ff, #e9e3ff);
        }
        
        .role-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            font-size: 1.2rem;
            color: white;
        }
        
        .role-client .role-icon {
            background: linear-gradient(135deg, #28a745, #20c997);
        }
        
        .role-vet .role-icon {
            background: linear-gradient(135deg, #17a2b8, #138496);
        }
        
        .role-admin .role-icon {
            background: linear-gradient(135deg, #dc3545, #e35d6a);
        }
        
        .role-info {
            flex: 1;
        }
        
        .role-name {
            font-weight: 600;
            color: #495057;
            margin-bottom: 2px;
        }
        
        .role-desc {
            font-size: 0.85rem;
            color: #6c757d;
        }
        
        .back-link {
            display: inline-flex;
            align-items: center;
            color: #6f42c1;
            text-decoration: none;
            font-weight: 500;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }
        
        .back-link:hover {
            color: #5a2d91;
            transform: translateX(-5px);
        }
        
        @media (max-width: 768px) {
            .form-header {
                padding: 20px;
            }
            
            .form-card {
                padding: 25px;
            }
            
            .form-grid {
                grid-template-columns: 1fr;
            }
            
            .btn-primary-custom {
                padding: 12px 30px;
            }
        }
    </style>

    <div class="user-form-container">
        <!-- Lien de retour -->
        <a href="{{ route('admin.users.index') }}" class="back-link">
            <i class="fas fa-arrow-left me-2"></i>Retour à la liste des utilisateurs
        </a>

        <!-- En-tête du formulaire -->
        <div class="form-header">
            <h1 class="form-title">
                <i class="fas fa-user-plus me-2"></i>Nouvel Utilisateur
            </h1>
            <p class="form-subtitle">Créez un nouveau compte utilisateur pour votre système</p>
        </div>

        <!-- Carte du formulaire -->
        <div class="form-card">
            <!-- Aide contextuelle -->
            <div class="form-help">
                <div class="form-help-title">
                    <i class="fas fa-info-circle me-2"></i>Informations importantes
                </div>
                <p class="form-help-text">
                    Remplissez soigneusement tous les champs obligatoires. Le mot de passe doit contenir au moins 6 caractères. 
                    Choisissez le rôle approprié selon les permissions nécessaires.
                </p>
            </div>

            <form action="{{ route('admin.users.store') }}" method="POST" id="userForm">
                @csrf

                <div class="form-grid">
                    <!-- Nom -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-user"></i>Nom complet
                        </label>
                        <div class="input-icon">
                            <i class="fas fa-signature"></i>
                            <input type="text" name="name" class="form-control-custom" 
                                   placeholder="Ex: Jean Dupont" 
                                   required>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-envelope"></i>Adresse email
                        </label>
                        <div class="input-icon">
                            <i class="fas fa-at"></i>
                            <input type="email" name="email" class="form-control-custom" 
                                   placeholder="exemple@email.com" 
                                   required>
                        </div>
                    </div>
                </div>

                <div class="form-grid">
                    <!-- Mot de passe -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-lock"></i>Mot de passe
                        </label>
                        <div class="input-icon">
                            <i class="fas fa-key"></i>
                            <input type="password" name="password" id="password" class="form-control-custom" 
                                   placeholder="Minimum 6 caractères" 
                                   required
                                   minlength="6">
                        </div>
                        <div class="password-strength" id="passwordStrength">
                            <div class="password-strength-bar"></div>
                        </div>
                        <small class="text-muted mt-1 d-block">
                            <i class="fas fa-info-circle me-1"></i>Force du mot de passe
                        </small>
                    </div>

                    <!-- Confirmation mot de passe -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-lock"></i>Confirmation
                        </label>
                        <div class="input-icon">
                            <i class="fas fa-redo"></i>
                            <input type="password" name="password_confirmation" id="passwordConfirmation" 
                                   class="form-control-custom" 
                                   placeholder="Retapez le mot de passe" 
                                   required>
                        </div>
                        <small class="text-muted mt-1 d-block">
                            <i class="fas fa-check-circle me-1"></i>Doit correspondre au mot de passe
                        </small>
                    </div>
                </div>

                <!-- Rôle -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-user-tag"></i>Rôle de l'utilisateur
                    </label>
                    <div class="role-options">
                        <div class="role-option role-client" onclick="selectRole('client')">
                            <div class="role-icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="role-info">
                                <div class="role-name">Client</div>
                                <div class="role-desc">Accès aux fonctionnalités basiques</div>
                            </div>
                            <input type="radio" name="role" value="client" class="d-none" checked>
                        </div>
                        
                        <div class="role-option role-vet" onclick="selectRole('vet')">
                            <div class="role-icon">
                                <i class="fas fa-user-md"></i>
                            </div>
                            <div class="role-info">
                                <div class="role-name">Vétérinaire</div>
                                <div class="role-desc">Gestion des soins et rendez-vous</div>
                            </div>
                            <input type="radio" name="role" value="vet" class="d-none">
                        </div>
                        
                        <div class="role-option role-admin" onclick="selectRole('admin')">
                            <div class="role-icon">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <div class="role-info">
                                <div class="role-name">Administrateur</div>
                                <div class="role-desc">Accès complet au système</div>
                            </div>
                            <input type="radio" name="role" value="admin" class="d-none">
                        </div>
                    </div>
                </div>

                <div class="form-grid">
                    <!-- Téléphone -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-phone"></i>Téléphone
                        </label>
                        <div class="input-icon">
                            <i class="fas fa-mobile-alt"></i>
                            <input type="text" name="telephone" class="form-control-custom" 
                                   placeholder="Ex: +33 1 23 45 67 89">
                        </div>
                    </div>

                    <!-- Adresse -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-map-marker-alt"></i>Adresse
                        </label>
                        <textarea name="adresse" class="form-control-custom" 
                                  placeholder="Adresse complète de l'utilisateur"
                                  rows="3"></textarea>
                    </div>
                </div>

                <!-- Bouton de soumission -->
                <button type="submit" class="btn btn-primary-custom">
                    <i class="fas fa-user-plus me-2"></i>Créer l'utilisateur
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Sélection du rôle par défaut
        selectRole('client');
        
        // Animation des champs au focus
        const inputs = document.querySelectorAll('.form-control-custom, .form-select-custom');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });
        
        // Vérification de la force du mot de passe
        const passwordInput = document.getElementById('password');
        const passwordStrength = document.getElementById('passwordStrength');
        
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            let strength = 0;
            
            if (password.length >= 6) strength++;
            if (password.length >= 8) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;
            
            passwordStrength.className = 'password-strength';
            if (strength <= 2) {
                passwordStrength.classList.add('weak');
            } else if (strength <= 4) {
                passwordStrength.classList.add('medium');
            } else {
                passwordStrength.classList.add('strong');
            }
        });
        
        // Vérification de la confirmation du mot de passe
        const passwordConfirmation = document.getElementById('passwordConfirmation');
        
        passwordConfirmation.addEventListener('input', function() {
            if (this.value !== passwordInput.value) {
                this.style.borderColor = '#dc3545';
                this.style.background = '#f8d7da';
            } else {
                this.style.borderColor = '#28a745';
                this.style.background = '#f8f9fa';
            }
        });
        
        // Confirmation avant soumission
        const form = document.getElementById('userForm');
        form.addEventListener('submit', function(e) {
            const name = document.querySelector('input[name="name"]').value;
            const role = document.querySelector('input[name="role"]:checked').value;
            
            if (!confirm(`Confirmez-vous la création de l'utilisateur "${name}" avec le rôle "${role}" ?`)) {
                e.preventDefault();
            }
        });
    });
    
    function selectRole(role) {
        // Désélectionner toutes les options
        document.querySelectorAll('.role-option').forEach(option => {
            option.classList.remove('selected');
        });
        
        // Sélectionner l'option choisie
        const selectedOption = document.querySelector(`.role-${role}`);
        selectedOption.classList.add('selected');
        
        // Cochez le radio button correspondant
        const radio = selectedOption.querySelector('input[type="radio"]');
        radio.checked = true;
        
        // Animation de sélection
        selectedOption.style.transform = 'scale(1.02)';
        setTimeout(() => {
            selectedOption.style.transform = 'scale(1)';
        }, 200);
    }
</script>
@endsection