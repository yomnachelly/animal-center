@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    <style>
        .avis-container {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .page-header {
            background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
            color: white;
            padding: 50px 40px;
            border-radius: 25px;
            margin-bottom: 40px;
            box-shadow: 0 20px 40px rgba(255, 154, 158, 0.3);
            position: relative;
            overflow: hidden;
        }
        
        .page-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
            transform: rotate(45deg);
        }
        
        .page-title {
            font-weight: 800;
            margin: 0;
            font-size: 3rem;
            position: relative;
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .page-subtitle {
            opacity: 0.9;
            margin: 15px 0 0 0;
            font-size: 1.3rem;
            font-weight: 300;
            position: relative;
        }
        
        .alert-success-custom {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            border: none;
            border-left: 5px solid #28a745;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 40px;
            box-shadow: 0 10px 25px rgba(40, 167, 69, 0.2);
            position: relative;
            overflow: hidden;
        }
        
        .alert-success-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.3), transparent);
            transform: translateX(-100%);
            animation: shimmer 3s infinite;
        }
        
        @keyframes shimmer {
            100% { transform: translateX(100%); }
        }
        
        .stats-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }
        
        .stat-card {
            background: white;
            padding: 30px 25px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            text-align: center;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            border: 1px solid #f0f0f0;
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(135deg, #ff9a9e, #fecfef);
        }
        
        .stat-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px rgba(255, 154, 158, 0.15);
        }
        
        .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
            opacity: 0.8;
        }
        
        .stat-number {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 10px;
            background: linear-gradient(135deg, #ff9a9e, #fecfef);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .stat-label {
            color: #6c757d;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.9rem;
        }
        
        .btn-primary-custom {
            background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
            border: none;
            color: white;
            padding: 15px 30px;
            border-radius: 25px;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 5px 15px rgba(255, 154, 158, 0.3);
        }
        
        .btn-primary-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(255, 154, 158, 0.4);
            background: linear-gradient(135deg, #ff7b81 0%, #febbe8 100%);
            color: white;
        }
        
        .avis-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }
        
        .avis-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: all 0.4s ease;
            border: 1px solid #f0f0f0;
            position: relative;
        }
        
        .avis-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(255, 154, 158, 0.15);
        }
        
        .avis-card.own-review::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(135deg, #ff9a9e, #fecfef);
            z-index: 1;
        }
        
        .avis-card-header {
            padding: 25px;
            border-bottom: 1px solid #f0f0f0;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            position: relative;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #ff9a9e, #fecfef);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1.2rem;
            box-shadow: 0 5px 15px rgba(255, 154, 158, 0.3);
        }
        
        .user-details {
            flex: 1;
        }
        
        .user-name {
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .own-badge {
            background: linear-gradient(135deg, #ff9a9e, #fecfef);
            color: white;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .avis-card-body {
            padding: 25px;
            position: relative;
        }
        
        .avis-text {
            color: #495057;
            font-size: 1rem;
            line-height: 1.6;
            margin: 0;
            position: relative;
        }
        
        .avis-text::before {
            content: '"';
            font-size: 3rem;
            color: #ff9a9e;
            position: absolute;
            top: -15px;
            left: -10px;
            opacity: 0.3;
            font-family: serif;
        }
        
        .avis-card-footer {
            padding: 20px 25px;
            background: #f8f9fa;
            border-top: 1px solid #f0f0f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .avis-date {
            color: #6c757d;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .action-buttons {
            display: flex;
            gap: 8px;
        }
        
        .btn-edit {
            background: linear-gradient(135deg, #ffd93d, #ff6b6b);
            border: none;
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 3px 10px rgba(255, 217, 61, 0.3);
        }
        
        .btn-edit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 217, 61, 0.4);
            color: white;
        }
        
        .btn-delete {
            background: linear-gradient(135deg, #ff6b6b, #ff8e8e);
            border: none;
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 3px 10px rgba(255, 107, 107, 0.3);
        }
        
        .btn-delete:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 107, 107, 0.4);
        }
        
        .empty-state {
            text-align: center;
            padding: 80px 40px;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 25px;
            margin: 40px 0;
            position: relative;
            overflow: hidden;
        }
        
        .empty-state::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.5), transparent);
            transform: translateX(-100%);
            animation: shimmer 3s infinite;
        }
        
        .empty-state-icon {
            font-size: 6rem;
            background: linear-gradient(135deg, #ff9a9e, #fecfef);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 30px;
        }
        
        .empty-state-title {
            color: #2c3e50;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 15px;
        }
        
        .empty-state-text {
            color: #6c757d;
            font-size: 1.2rem;
            margin-bottom: 30px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        
        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        @media (max-width: 768px) {
            .page-header {
                padding: 30px 20px;
                text-align: center;
            }
            
            .page-title {
                font-size: 2.2rem;
                flex-direction: column;
                gap: 10px;
            }
            
            .avis-grid {
                grid-template-columns: 1fr;
            }
            
            .avis-card-footer {
                flex-direction: column;
                align-items: stretch;
                text-align: center;
            }
            
            .action-buttons {
                justify-content: center;
            }
            
            .stats-cards {
                grid-template-columns: 1fr;
            }
            
            .user-info {
                flex-direction: column;
                text-align: center;
                gap: 10px;
            }
        }
        
        .page-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            flex-wrap: wrap;
            gap: 20px;
        }
        
        .section-title {
            font-weight: 700;
            color: #2c3e50;
            font-size: 1.8rem;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }
    </style>

    <div class="avis-container">
        <!-- En-tête de page -->
        <div class="page-header">
            <h1 class="page-title floating">
                <i class="fas fa-star"></i>
                Espace Avis Clients
            </h1>
            <p class="page-subtitle">Partagez votre expérience et découvrez celle des autres</p>
        </div>

        <!-- Message de succès -->
        @if(session('success'))
            <div class="alert alert-success-custom">
                <div class="d-flex align-items-center">
                    <i class="fas fa-check-circle me-3" style="font-size: 2rem; color: #28a745;"></i>
                    <div>
                        <h4 class="mb-2" style="color: #155724;">Succès !</h4>
                        <p class="mb-0" style="color: #155724; font-size: 1.1rem;">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Cartes de statistiques -->
        <div class="stats-cards">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-comments"></i>
                </div>
                <div class="stat-number">{{ $avis->count() }}</div>
                <div class="stat-label">Total des Avis</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-user-check"></i>
                </div>
                <div class="stat-number">{{ $avis->where('user_id', Auth::id())->count() }}</div>
                <div class="stat-label">Mes Avis</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-number">{{ $avis->where('user_id', '!=', Auth::id())->count() }}</div>
                <div class="stat-label">Avis Autres Clients</div>
            </div>
        </div>

        <!-- Actions de page -->
        <div class="page-actions">
            <h2 class="section-title">
                <i class="fas fa-list"></i>
                Tous les Avis
            </h2>
            <a href="{{ route('client.avis.create') }}" class="btn-primary-custom">
                <i class="fas fa-edit"></i>
                Donner mon Avis
            </a>
        </div>

        <!-- Grille des avis -->
        @if($avis->count() > 0)
            <div class="avis-grid">
                @foreach($avis as $avi)
                    <div class="avis-card {{ $avi->user_id === Auth::id() ? 'own-review' : '' }}">
                        <div class="avis-card-header">
                            <div class="user-info">
                                <div class="user-avatar">
                                    {{ substr($avi->user->name, 0, 1) }}
                                </div>
                                <div class="user-details">
                                    <div class="user-name">
                                        {{ $avi->user->name }}
                                        @if($avi->user_id === Auth::id())
                                            <span class="own-badge">
                                                <i class="fas fa-user me-1"></i>Mon Avis
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="avis-card-body">
                            <p class="avis-text">{{ $avi->texte }}</p>
                        </div>
                        
                        <div class="avis-card-footer">
                            <div class="avis-date">
                                <i class="fas fa-clock"></i>
                                {{ $avi->created_at ? $avi->created_at->format('d/m/Y à H:i') : 'Date inconnue' }}
                            </div>
                            
                            @if($avi->user_id === Auth::id())
                                <div class="action-buttons">
                                    <a href="{{ route('client.avis.edit', $avi) }}" class="btn-edit">
                                        <i class="fas fa-edit"></i>
                                        Modifier
                                    </a>
                                    <form action="{{ route('client.avis.destroy', $avi) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete" 
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet avis ? Cette action est irréversible.')">
                                            <i class="fas fa-trash"></i>
                                            Supprimer
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- État vide -->
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="fas fa-comment-slash floating"></i>
                </div>
                <h3 class="empty-state-title">Aucun avis pour le moment</h3>
                <p class="empty-state-text">Soyez le premier à partager votre expérience avec notre clinique vétérinaire</p>
                <a href="{{ route('client.avis.create') }}" class="btn-primary-custom mt-3">
                    <i class="fas fa-edit"></i>
                    Écrire mon premier avis
                </a>
            </div>
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation des cartes de statistiques
    const statCards = document.querySelectorAll('.stat-card');
    statCards.forEach((card, index) => {
        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 200);
    });
    
    // Animation des cartes d'avis
    const avisCards = document.querySelectorAll('.avis-card');
    avisCards.forEach((card, index) => {
        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
    
    // Confirmation pour la suppression
    const deleteForms = document.querySelectorAll('form[action*="destroy"]');
    deleteForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!confirm('Êtes-vous sûr de vouloir supprimer définitivement cet avis ?')) {
                e.preventDefault();
            }
        });
    });
    
    // Effet de survol amélioré
    avisCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(-8px) scale(1)';
        });
    });
    
    // Auto-dismiss des alertes après 5 secondes
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });
});
</script>
@endsection