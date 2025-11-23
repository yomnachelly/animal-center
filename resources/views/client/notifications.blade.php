@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    <style>
        .notifications-container {
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
            padding: 10px 25px;
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
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            border-left: 5px solid #667eea;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .notification-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }
        
        .notification-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .notification-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 15px;
        }
        
        .notification-sender {
            font-weight: 700;
            color: #2d3748;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .sender-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }
        
        .notification-time {
            background: #f8f9fa;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            color: #6c757d;
            font-weight: 500;
        }
        
        .notification-content {
            color: #4a5568;
            line-height: 1.6;
            margin-bottom: 20px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 10px;
            border-left: 3px solid #e9ecef;
        }
        
        .notification-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        
        .btn-reply {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-reply:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(79, 172, 254, 0.4);
            color: white;
        }
        
        .btn-delete {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-delete:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(245, 87, 108, 0.4);
            color: white;
        }
        
        .empty-state {
            text-align: center;
            padding: 60px 30px;
            color: #6c757d;
        }
        
        .empty-state-icon {
            font-size: 4rem;
            margin-bottom: 20px;
            color: #dee2e6;
            opacity: 0.7;
        }
        
        .empty-state h3 {
            color: #6c757d;
            margin-bottom: 15px;
            font-weight: 600;
        }
        
        .empty-state p {
            font-size: 1.1rem;
            margin-bottom: 25px;
        }
        
        .notification-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: #e53e3e;
            color: white;
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }
        
        .notification-badge.unread {
            background: #e53e3e;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(0.95); opacity: 1; }
            50% { transform: scale(1.1); opacity: 0.7; }
            100% { transform: scale(0.95); opacity: 1; }
        }
        
        .notification-count {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 3px 10px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-left: 10px;
        }
        
        .notification-status {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-left: 10px;
        }
        
        .status-unread {
            background: #fed7d7;
            color: #c53030;
        }
        
        .status-read {
            background: #c6f6d5;
            color: #276749;
        }
        
        @media (max-width: 768px) {
            .notification-header {
                flex-direction: column;
                gap: 10px;
            }
            
            .notification-actions {
                flex-direction: column;
            }
            
            .btn-reply, .btn-delete {
                width: 100%;
                justify-content: center;
            }
            
            .page-title {
                font-size: 1.8rem;
            }
        }
    </style>

    <div class="notifications-container">
        <!-- En-tête de page -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="page-title">
                        <i class="fas fa-bell"></i>
                        Mes Notifications
                        @if(!$notifications->isEmpty())
                            <span class="notification-count">{{ $notifications->count() }}</span>
                        @endif
                    </h1>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="{{ route('client.dashboard') }}" class="btn-back">
                        <i class="fas fa-arrow-left"></i>
                        Retour au Dashboard
                    </a>
                </div>
            </div>
        </div>

        <!-- Liste des notifications -->
        @if($notifications->isEmpty())
            <div class="empty-state">
                <i class="fas fa-bell-slash empty-state-icon"></i>
                <h3>Aucune notification</h3>
                <p>Vous n'avez aucune notification pour le moment.</p>
                <a href="{{ route('client.dashboard') }}" class="btn-back" style="background: #667eea; border-color: #667eea;">
                    <i class="fas fa-home"></i>
                    Retour à l'accueil
                </a>
            </div>
        @else
            <div class="notifications-list">
                @foreach($notifications as $notif)
                    <div class="notification-card">
                        <!-- Badge pour les notifications non lues -->
                        @if(isset($notif->is_read) && !$notif->is_read)
                            <div class="notification-badge unread"></div>
                        @endif
                        
                        <div class="notification-header">
                            <div class="d-flex align-items-center gap-3">
                                <div class="sender-avatar">
                                    {{ substr($notif->expediteur->name ?? 'A', 0, 1) }}
                                </div>
                                <div>
                                    <div class="notification-sender">
                                        {{ $notif->expediteur->name ?? 'Administration' }}
                                        @if(isset($notif->is_read))
                                            <span class="notification-status {{ $notif->is_read ? 'status-read' : 'status-unread' }}">
                                                <i class="fas {{ $notif->is_read ? 'fa-check' : 'fa-envelope' }}"></i>
                                                {{ $notif->is_read ? 'Lu' : 'Non lu' }}
                                            </span>
                                        @endif
                                    </div>
                                    <small class="text-muted">
                                        <i class="fas fa-envelope me-1"></i>
                                        Notification
                                    </small>
                                </div>
                            </div>
                            <div class="notification-time">
                                <i class="fas fa-clock me-1"></i>
                                {{ \Carbon\Carbon::parse($notif->date)->format('d/m/Y à H:i') }}
                            </div>
                        </div>
                        
                        <div class="notification-content">
                            <i class="fas fa-quote-left text-muted me-2"></i>
                            {{ $notif->contenu }}
                            <i class="fas fa-quote-right text-muted ms-2"></i>
                        </div>
                        
                        <div class="notification-actions">
                            @if(Route::has('client.notifications.repondre'))
                            <a href="{{ route('client.notifications.repondre', $notif->id) }}" class="btn-reply">
                                <i class="fas fa-reply"></i>
                                Répondre
                            </a>
                            @endif
                            
                            @if(Route::has('client.notifications.supprimer'))
                            <form action="{{ route('client.notifications.supprimer', $notif->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" 
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette notification ?')">
                                    <i class="fas fa-trash"></i>
                                    Supprimer
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination (si applicable) -->
            @if(method_exists($notifications, 'hasPages') && $notifications->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $notifications->links() }}
                </div>
            @endif
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation des cartes au survol
    const cards = document.querySelectorAll('.notification-card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-3px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
    
    // Confirmation de suppression améliorée
    const deleteForms = document.querySelectorAll('form[action*="supprimer"]');
    deleteForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!confirm('Êtes-vous sûr de vouloir supprimer définitivement cette notification ? Cette action est irréversible.')) {
                e.preventDefault();
            }
        });
    });
});
</script>

@endsection