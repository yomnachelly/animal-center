@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <style>
        .edit-user-container {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .page-header {
            background: linear-gradient(135deg, #6f42c1, #8e44ad);
            color: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(111, 66, 193, 0.3);
        }
        
        .page-title {
            font-weight: 700;
            margin: 0;
            font-size: 2.2rem;
        }
        
        .form-container {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        
        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
            font-size: 0.95rem;
        }
        
        .form-control-custom {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }
        
        .form-control-custom:focus {
            border-color: #6f42c1;
            background: white;
            box-shadow: 0 0 0 0.2rem rgba(111, 66, 193, 0.25);
            transform: translateY(-2px);
        }
        
        .form-select-custom {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
            cursor: pointer;
        }
        
        .form-select-custom:focus {
            border-color: #6f42c1;
            background: white;
            box-shadow: 0 0 0 0.2rem rgba(111, 66, 193, 0.25);
            transform: translateY(-2px);
        }
        
        .btn-primary-custom {
            background: linear-gradient(135deg, #6f42c1, #8e44ad);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(111, 66, 193, 0.3);
        }
        
        .btn-primary-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(111, 66, 193, 0.4);
            background: linear-gradient(135deg, #5a2d91, #6f42c1);
            color: white;
        }
        
        .btn-secondary-custom {
            background: linear-gradient(135deg, #6c757d, #868e96);
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 50px;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            margin-right: 15px;
        }
        
        .btn-secondary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108, 117, 125, 0.4);
            color: white;
        }
        
        .user-avatar-large {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6f42c1, #8e44ad);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 2rem;
            margin: 0 auto 20px;
            box-shadow: 0 5px 15px rgba(111, 66, 193, 0.3);
        }
        
        .form-section {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
            border-left: 5px solid #6f42c1;
        }
        
        .section-title {
            color: #6f42c1;
            font-weight: 600;
            margin-bottom: 20px;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
        }
        
        .section-title i {
            margin-right: 10px;
            font-size: 1.3rem;
        }
        
        .password-note {
            background: linear-gradient(135deg, #fff3cd, #ffeaa7);
            border: 1px solid #ffecb5;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            color: #856404;
            font-size: 0.9rem;
        }
        
        .role-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-flex;
            align-items: center;
            margin-left: 10px;
        }
        
        .role-admin {
            background: linear-gradient(135deg, #dc3545, #e35d6a);
            color: white;
        }
        
        .role-vet {
            background: linear-gradient(135deg, #17a2b8, #138496);
            color: white;
        }
        
        .role-client {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
        }
        
        .alert-danger {
            background: linear-gradient(135deg, #f8d7da, #f5c6cb);
            border: none;
            border-left: 5px solid #dc3545;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 25px;
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.2);
        }
        
        .form-actions {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            margin-top: 30px;
            text-align: center;
        }
        
        .current-info {
            background: linear-gradient(135deg, #d1ecf1, #bee5eb);
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            border-left: 4px solid #17a2b8;
        }
        
        .info-text {
            color: #0c5460;
            font-size: 0.9rem;
            margin: 0;
            display: flex;
            align-items: center;
        }
        
        .info-text i {
            margin-right: 8px;
            font-size: 1.1rem;
        }
        
        @media (max-width: 768px) {
            .page-header {
                padding: 20px;
                text-align: center;
            }
            
            .form-container {
                padding: 20px;
            }
            
            .btn-secondary-custom {
                margin-right: 0;
                margin-bottom: 10px;
                width: 100%;
                justify-content: center;
            }
            
            .user-avatar-large {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
            }
        }
    </style>

    <div class="edit-user-container">
        <!-- En-tête de page -->
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h1 class="page-title">
                        <i class="fas fa-user-edit me-2"></i>✏️ Modifier l'Utilisateur
                    </h1>
                    <div class="mt-2">
                        <span class="active-filter-badge" style="background: rgba(255,255,255,0.2); color: white;">
                            <i class="fas fa-user me-1"></i>
                            {{ $user->name }}
                        </span>
                        <span class="role-badge {{ $user->role === 'admin' ? 'role-admin' : ($user->role === 'vet' ? 'role-vet' : 'role-client') }}">
                            <i class="fas 
                                @if($user->role == 'admin') fa-shield-alt 
                                @elseif($user->role == 'vet') fa-user-md 
                                @else fa-user 
                                @endif me-1">
                            </i>
                            {{ $user->role }}
                        </span>
                    </div>
                </div>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary-custom">
                    <i class="fas fa-arrow-left me-2"></i>Retour à la liste
                </a>
            </div>
        </div>

        <!-- Messages d'erreur -->
        @if($errors->any())
            <div class="alert alert-danger">
                <div class="d-flex align-items-center">
                    <i class="fas fa-exclamation-triangle me-3 text-danger" style="font-size: 1.5rem;"></i>
                    <div>
                        <h5 class="mb-2 text-danger">Erreurs de validation</h5>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <div class="form-container">
            <form action="{{ route('admin.users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Avatar et informations générales -->
                <div class="text-center mb-4">
                    <div class="user-avatar-large">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <h4 class="text-muted">{{ $user->name }}</h4>
                    <p class="text-muted">Dernière modification : {{ $user->updated_at->format('d/m/Y à H:i') }}</p>
                </div>

                <!-- Section Informations de base -->
                <div class="form-section">
                    <h4 class="section-title">
                        <i class="fas fa-id-card"></i>Informations Personnelles
                    </h4>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nom complet</label>
                            <input type="text" name="name" class="form-control form-control-custom" 
                                   value="{{ old('name', $user->name) }}" required
                                   placeholder="Entrez le nom complet">
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Adresse email</label>
                            <input type="email" name="email" class="form-control form-control-custom" 
                                   value="{{ old('email', $user->email) }}" required
                                   placeholder="Entrez l'adresse email">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Téléphone</label>
                            <input type="text" name="telephone" class="form-control form-control-custom" 
                                   value="{{ old('telephone', $user->telephone) }}"
                                   placeholder="Entrez le numéro de téléphone">
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Rôle</label>
                            <select name="role" class="form-select form-select-custom" required>
                                <option value="client" {{ old('role', $user->role) === 'client' ? 'selected' : '' }}>Client</option>
                                <option value="vet" {{ old('role', $user->role) === 'vet' ? 'selected' : '' }}>Vétérinaire</option>
                                <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Administrateur</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Adresse</label>
                        <textarea name="adresse" class="form-control form-control-custom" rows="3"
                                  placeholder="Entrez l'adresse complète">{{ old('adresse', $user->adresse) }}</textarea>
                    </div>
                </div>

                <!-- Section Sécurité -->
                <div class="form-section">
                    <h4 class="section-title">
                        <i class="fas fa-lock"></i>Sécurité du Compte
                    </h4>
                    
                    <div class="password-note">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Note :</strong> Laissez les champs mot de passe vides si vous ne souhaitez pas le modifier.
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nouveau mot de passe</label>
                            <input type="password" name="password" class="form-control form-control-custom"
                                   placeholder="Entrez le nouveau mot de passe"
                                   autocomplete="new-password">
                            <div class="form-text">Minimum 8 caractères</div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Confirmation du mot de passe</label>
                            <input type="password" name="password_confirmation" class="form-control form-control-custom"
                                   placeholder="Confirmez le nouveau mot de passe"
                                   autocomplete="new-password">
                        </div>
                    </div>
                </div>

                <!-- Actions du formulaire -->
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary-custom w-100">
                                <i class="fas fa-times me-2"></i>Annuler
                            </a>
                        </div>
                        <div class="col-md-6 mb-2">
                            <button type="submit" class="btn btn-primary-custom w-100">
                                <i class="fas fa-save me-2"></i>Mettre à jour
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animation des champs du formulaire
        const formControls = document.querySelectorAll('.form-control-custom, .form-select-custom');
        
        formControls.forEach(control => {
            control.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });
            
            control.addEventListener('blur', function() {
                if (this.value === '') {
                    this.parentElement.classList.remove('focused');
                }
            });
        });

        // Confirmation avant soumission
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            const password = document.querySelector('input[name="password"]').value;
            const passwordConfirm = document.querySelector('input[name="password_confirmation"]').value;
            
            if (password && password !== passwordConfirm) {
                e.preventDefault();
                alert('Les mots de passe ne correspondent pas. Veuillez vérifier votre saisie.');
                return;
            }
            
            if (!confirm('Êtes-vous sûr de vouloir mettre à jour cet utilisateur ?')) {
                e.preventDefault();
            }
        });
    });
</script>
@endsection