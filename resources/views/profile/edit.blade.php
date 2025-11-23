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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
            margin-bottom: 25px;
        }
        
        .form-label {
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 8px;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .form-control-custom {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 12px 15px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }
        
        .form-control-custom:focus {
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.1);
        }
        
        .btn-primary-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }
        
        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }
        
        .btn-secondary-custom {
            background: #6c757d;
            border: none;
            color: white;
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-secondary-custom:hover {
            background: #5a6268;
            color: white;
            transform: translateY(-2px);
        }
        
        .form-actions {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 30px;
        }
        
        .password-help {
            font-size: 0.875rem;
            color: #6c757d;
            margin-top: 5px;
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
        }
    </style>

    <div class="form-container">
        <!-- En-tête du formulaire -->
        <div class="form-header">
            <h1 class="form-title">
                <i class="fas fa-user-edit"></i>
                Modifier mon Profil
            </h1>
            <p class="form-subtitle">Mettez à jour vos informations personnelles</p>
        </div>

        <!-- Carte du formulaire -->
        <div class="form-card">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Veuillez corriger les erreurs ci-dessous.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PATCH')

                <div class="form-group">
                    <label for="name" class="form-label">
                        <i class="fas fa-user"></i>Nom complet
                    </label>
                    <input type="text" name="name" id="name" class="form-control form-control-custom" 
                           value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">
                        <i class="fas fa-envelope"></i>Adresse email
                    </label>
                    <input type="email" name="email" id="email" class="form-control form-control-custom" 
                           value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="telephone" class="form-label">
                        <i class="fas fa-phone"></i>Numéro de téléphone
                    </label>
                    <input type="text" name="telephone" id="telephone" class="form-control form-control-custom" 
                           value="{{ old('telephone', $user->telephone) }}" 
                           placeholder="Ex: +33 1 23 45 67 89">
                    @error('telephone')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="adresse" class="form-label">
                        <i class="fas fa-home"></i>Adresse postale
                    </label>
                    <textarea name="adresse" id="adresse" class="form-control form-control-custom" 
                              rows="3" placeholder="Votre adresse complète">{{ old('adresse', $user->adresse) }}</textarea>
                    @error('adresse')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Section pour le mot de passe (optionnel) -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-lock"></i>Changer le mot de passe (optionnel)
                    </label>
                    <input type="password" name="password" class="form-control form-control-custom" 
                           placeholder="Nouveau mot de passe" autocomplete="new-password">
                    @error('password')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                    
                    <input type="password" name="password_confirmation" class="form-control form-control-custom mt-2" 
                           placeholder="Confirmer le nouveau mot de passe" autocomplete="new-password">
                    
                    <div class="password-help">
                        Laissez vide si vous ne souhaitez pas changer le mot de passe. Minimum 8 caractères.
                    </div>
                </div>

                <!-- Informations de rôle (lecture seule) -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-user-tag"></i>Rôle
                    </label>
                    <input type="text" class="form-control form-control-custom" 
                           value="{{ $user->role }}" disabled style="background-color: #e9ecef;">
                    <small class="text-muted">Le rôle ne peut pas être modifié</small>
                </div>

                <!-- Informations de compte (lecture seule) -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-calendar-alt"></i>Membre depuis
                    </label>
                    <input type="text" class="form-control form-control-custom" 
                           value="{{ $user->created_at->format('d/m/Y') }}" disabled style="background-color: #e9ecef;">
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary-custom">
                        <i class="fas fa-save me-2"></i>
                        Enregistrer les modifications
                    </button>
                    <a href="{{ route('client.dashboard') }}" class="btn btn-secondary-custom">
                        <i class="fas fa-arrow-left me-2"></i>
                        Retour au dashboard
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation pour les champs du formulaire
    const formInputs = document.querySelectorAll('.form-control-custom');
    
    formInputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            if (this.value === '') {
                this.parentElement.classList.remove('focused');
            }
        });
    });

    // Debug: Afficher les données du formulaire avant envoi
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        console.log('Données du formulaire:');
        console.log('Nom:', document.getElementById('name').value);
        console.log('Email:', document.getElementById('email').value);
        console.log('Téléphone:', document.getElementById('telephone').value);
        console.log('Adresse:', document.getElementById('adresse').value);
        
        const password = document.querySelector('input[name="password"]').value;
        const passwordConfirm = document.querySelector('input[name="password_confirmation"]').value;
        
        if (password && password !== passwordConfirm) {
            e.preventDefault();
            alert('Les mots de passe ne correspondent pas.');
            return false;
        }
        
        if (password && password.length < 8) {
            e.preventDefault();
            alert('Le mot de passe doit contenir au moins 8 caractères.');
            return false;
        }
    });
});
</script>

<style>
    .focused .form-label {
        color: #667eea;
    }
    
    .text-muted {
        font-size: 0.875rem;
        margin-top: 5px;
        display: block;
    }
</style>
@endsection