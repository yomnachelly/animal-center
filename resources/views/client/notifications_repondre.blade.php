@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    <style>
        .reply-container {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            border-radius: 20px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .page-title {
            font-weight: 700;
            margin: 0;
            font-size: 2.2rem;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .btn-back {
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 12px 25px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-back:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
            color: white;
            transform: translateY(-2px);
        }
        
        .notification-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            border-left: 5px solid #667eea;
            transition: all 0.3s ease;
        }
        
        .notification-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }
        
        .notification-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f8f9fa;
        }
        
        .sender-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.2rem;
        }
        
        .sender-info h4 {
            margin: 0;
            color: #2d3748;
            font-weight: 700;
        }
        
        .sender-info .badge {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .notification-meta {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #6c757d;
            font-weight: 500;
        }
        
        .meta-item i {
            color: #667eea;
        }
        
        .original-message {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 12px;
            border-left: 4px solid #667eea;
            margin-bottom: 25px;
            position: relative;
        }
        
        .original-message::before {
            content: '"';
            font-size: 3rem;
            color: #e9ecef;
            position: absolute;
            top: 10px;
            left: 15px;
            font-family: serif;
        }
        
        .message-content {
            color: #4a5568;
            line-height: 1.6;
            font-size: 1.05rem;
            margin-left: 10px;
        }
        
        .reply-form-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            border-left: 5px solid #4facfe;
        }
        
        .form-label {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 10px;
            font-size: 1.1rem;
        }
        
        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 15px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }
        
        .form-control:focus {
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.1);
        }
        
        .form-control.is-invalid {
            border-color: #e53e3e;
        }
        
        .btn-send {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            border: none;
            color: white;
            padding: 15px 35px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 5px 15px rgba(79, 172, 254, 0.3);
        }
        
        .btn-send:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(79, 172, 254, 0.4);
            color: white;
        }
        
        .btn-cancel {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            border: none;
            color: white;
            padding: 15px 30px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-right: 15px;
        }
        
        .btn-cancel:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(245, 87, 108, 0.4);
            color: white;
        }
        
        .form-actions {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }
        
        .character-count {
            text-align: right;
            color: #6c757d;
            font-size: 0.9rem;
            margin-top: 5px;
        }
        
        @media (max-width: 768px) {
            .page-title {
                font-size: 1.8rem;
            }
            
            .notification-header {
                flex-direction: column;
                text-align: center;
            }
            
            .notification-meta {
                flex-direction: column;
                gap: 10px;
            }
            
            .form-actions {
                flex-direction: column;
            }
            
            .btn-cancel, .btn-send {
                width: 100%;
                justify-content: center;
            }
        }
        
        .floating-animation {
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
        }
    </style>

    <div class="reply-container">
        <!-- En-tête de page -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="page-title">
                        <i class="fas fa-reply floating-animation"></i>
                        Répondre à la Notification
                    </h1>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="{{ route('client.notifications') }}" class="btn-back">
                        <i class="fas fa-arrow-left"></i>
                        Retour aux notifications
                    </a>
                </div>
            </div>
        </div>

        <!-- Carte de la notification originale -->
        <div class="notification-card">
            <div class="notification-header">
                <div class="sender-avatar">
                    {{ substr($notification->expediteur->name ?? 'A', 0, 1) }}
                </div>
                <div class="sender-info">
                    <h4>{{ $notification->expediteur->name ?? 'Administration' }}</h4>
                    <span class="badge">Expéditeur</span>
                </div>
            </div>
            
            <div class="notification-meta">
                <div class="meta-item">
                    <i class="fas fa-calendar"></i>
                    <span>{{ \Carbon\Carbon::parse($notification->date)->format('d/m/Y') }}</span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-clock"></i>
                    <span>{{ \Carbon\Carbon::parse($notification->date)->format('H:i') }}</span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-envelope"></i>
                    <span>Notification</span>
                </div>
            </div>
            
            <div class="original-message">
                <div class="message-content">
                    {{ $notification->contenu }}
                </div>
            </div>
        </div>

        <!-- Formulaire de réponse -->
        <div class="reply-form-card">
            <h3 class="mb-4" style="color: #2d3748; font-weight: 700;">
                <i class="fas fa-edit me-2"></i>
                Votre réponse
            </h3>
            
            <form action="{{ route('client.notifications.envoyerReponse', $notification->id) }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label for="contenu" class="form-label">
                        <i class="fas fa-comment-dots me-2"></i>
                        Message de réponse
                    </label>
                    <textarea name="contenu" id="contenu" rows="6" 
                              class="form-control @error('contenu') is-invalid @enderror" 
                              placeholder="Tapez votre réponse ici..." 
                              required>{{ old('contenu') }}</textarea>
                    
                    <div class="character-count">
                        <span id="charCount">0</span> caractères
                    </div>
                    
                    @error('contenu')
                        <div class="invalid-feedback d-block">
                            <i class="fas fa-exclamation-circle me-1"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="form-actions">
                    <a href="{{ route('client.notifications') }}" class="btn-cancel">
                        <i class="fas fa-times"></i>
                        Annuler
                    </a>
                    <button type="submit" class="btn-send">
                        <i class="fas fa-paper-plane"></i>
                        Envoyer la réponse
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const textarea = document.getElementById('contenu');
    const charCount = document.getElementById('charCount');
    
    // Compteur de caractères
    function updateCharCount() {
        charCount.textContent = textarea.value.length;
        
        // Changer la couleur si approche de la limite
        if (textarea.value.length > 500) {
            charCount.style.color = '#e53e3e';
            charCount.innerHTML = textarea.value.length + ' <i class="fas fa-exclamation-triangle"></i>';
        } else if (textarea.value.length > 300) {
            charCount.style.color = '#d69e2e';
        } else {
            charCount.style.color = '#6c757d';
        }
    }
    
    textarea.addEventListener('input', updateCharCount);
    updateCharCount(); // Initial count
    
    // Animation au focus
    textarea.addEventListener('focus', function() {
        this.parentElement.classList.add('focused');
    });
    
    textarea.addEventListener('blur', function() {
        this.parentElement.classList.remove('focused');
    });
    
    // Confirmation avant de quitter si du texte est saisi
    window.addEventListener('beforeunload', function(e) {
        if (textarea.value.trim().length > 0) {
            e.preventDefault();
            e.returnValue = '';
        }
    });
});
</script>

@endsection