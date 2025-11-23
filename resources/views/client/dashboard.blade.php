@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    <style>
        .dashboard-container {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 30px;
            border-radius: 20px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .page-title {
            font-weight: 800;
            margin: 0;
            font-size: 2.5rem;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .page-subtitle {
            opacity: 0.9;
            margin: 10px 0 0 0;
            font-size: 1.2rem;
            font-weight: 300;
        }
        
        .user-badge {
            background: rgba(255, 255, 255, 0.2);
            padding: 8px 20px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 1rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }
        
        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            border-left: 5px solid #667eea;
            transition: all 0.3s ease;
            text-decoration: none;
            color: inherit;
            display: block;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
            color: inherit;
        }
        
        .stat-card.primary { border-left-color: #667eea; }
        .stat-card.success { border-left-color: #28a745; }
        .stat-card.warning { border-left-color: #ffc107; }
        .stat-card.info { border-left-color: #17a2b8; }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 15px;
        }
        
        .stat-icon.primary { background: rgba(102, 126, 234, 0.1); color: #667eea; }
        .stat-icon.success { background: rgba(40, 167, 69, 0.1); color: #28a745; }
        .stat-icon.warning { background: rgba(255, 193, 7, 0.1); color: #ffc107; }
        .stat-icon.info { background: rgba(23, 162, 184, 0.1); color: #17a2b8; }
        
        .stat-number {
            font-size: 2rem;
            font-weight: 800;
            margin: 0;
            color: #2c3e50;
        }
        
        .stat-label {
            color: #6c757d;
            font-weight: 600;
            margin: 5px 0 0 0;
        }
        
        .info-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
        }
        
        .info-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 25px;
            border-bottom: 2px solid #f8f9fa;
            padding-bottom: 15px;
        }
        
        .info-title {
            font-weight: 700;
            color: #2c3e50;
            margin: 0;
            font-size: 1.4rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .info-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }
        
        .info-item {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        
        .info-label {
            color: #6c757d;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .info-value {
            color: #2c3e50;
            font-weight: 600;
            font-size: 1.1rem;
        }
        
        .btn-edit-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
        
        .btn-edit-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
            color: white;
        }
        
        .btn-notification-custom {
            background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
            border: none;
            color: white;
            padding: 12px 25px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 5px 15px rgba(255, 154, 158, 0.3);
        }
        
        .btn-notification-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(255, 154, 158, 0.4);
            color: white;
        }
        
        .notification-badge {
            background: rgba(255, 255, 255, 0.9);
            color: #ff9a9e;
            padding: 4px 10px;
            border-radius: 15px;
            font-weight: 700;
            font-size: 0.8rem;
            margin-left: 8px;
        }
        
        .empty-value {
            color: #dc3545;
            font-style: italic;
            font-weight: 500;
        }
        
        @media (max-width: 768px) {
            .page-title {
                font-size: 2rem;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .info-content {
                grid-template-columns: 1fr;
            }
        }
        
        .floating-animation {
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }
        
        .action-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            text-decoration: none;
            color: inherit;
            text-align: center;
            border: 2px solid transparent;
        }
        
        .action-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
            border-color: #667eea;
            color: inherit;
        }
        
        .action-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
            color: #667eea;
        }
        
        .action-title {
            font-weight: 700;
            color: #2c3e50;
            margin: 0 0 10px 0;
        }
        
        .action-description {
            color: #6c757d;
            font-size: 0.9rem;
            margin: 0;
        }
    </style>

    <div class="dashboard-container">
        <!-- Message de succès -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="
                background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
                color: white;
                border: none;
                border-radius: 15px;
                padding: 20px;
                margin-bottom: 30px;
                box-shadow: 0 5px 20px rgba(40, 167, 69, 0.3);
                border-left: 5px solid #fff;
            ">
                <div class="d-flex align-items-center">
                    <i class="fas fa-check-circle me-3" style="font-size: 1.5rem;"></i>
                    <div>
                        <h5 class="alert-heading mb-1" style="color: white;">Succès !</h5>
                        <p class="mb-0">{{ session('success') }}</p>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close" style="position: absolute; top: 15px; right: 15px;"></button>
            </div>
        @endif

        <!-- En-tête de page -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="page-title">
                        <i class="fas fa-tachometer-alt floating-animation"></i>
                        Tableau de Bord Client
                    </h1>
                    <p class="page-subtitle">
                        Bienvenue sur votre espace personnel, {{ auth()->user()->name }}
                    </p>
                </div>
                <div class="col-md-4 text-md-end">
                    <span class="user-badge">
                        <i class="fas fa-user"></i>
                        {{ auth()->user()->role }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Statistiques rapides -->
        <div class="stats-grid">
            <a href="{{ route('client.notifications') }}" class="stat-card info">
                <div class="stat-icon info">
                    <i class="fas fa-bell"></i>
                </div>
                <h3 class="stat-number">{{ auth()->user()->notificationsReceived->count() }}</h3>
                <p class="stat-label">Notifications</p>
            </a>
            
            <a href="{{ route('client.rendez-vous') }}" class="stat-card primary">
                <div class="stat-icon primary">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <h3 class="stat-number">{{ \App\Models\Rendezvous::where('user_id', auth()->id())->count() }}</h3>
                <p class="stat-label">Rendez-vous</p>
            </a>
            
            <a href="{{ route('client.demandes.hebergement') }}" class="stat-card success">
                <div class="stat-icon success">
                    <i class="fas fa-home"></i>
                </div>
                <h3 class="stat-number">{{ \App\Models\Hebergement::where('user_id', auth()->id())->count() }}</h3>
                <p class="stat-label">Hébergements</p>
            </a>
            
            <a href="{{ route('client.demandes.adoption') }}" class="stat-card warning">
                <div class="stat-icon warning">
                    <i class="fas fa-paw"></i>
                </div>
                <h3 class="stat-number">{{ \App\Models\Demande::where('user_id', auth()->id())->where('etat', 'en attente')->count() }}</h3>
                <p class="stat-label">Demandes en attente</p>
            </a>
        </div>

        <!-- Informations personnelles -->
        <div class="info-card">
            <div class="info-header">
                <h2 class="info-title">
                    <i class="fas fa-user-circle"></i>
                    Mes Informations Personnelles
                </h2>
                <a href="{{ route('profile.edit') }}" class="btn-edit-custom">
                    <i class="fas fa-edit"></i>
                    Modifier
                </a>
            </div>
            
            <div class="info-content">
                <div class="info-item">
                    <span class="info-label">Nom complet</span>
                    <span class="info-value">{{ auth()->user()->name }}</span>
                </div>
                
                <div class="info-item">
                    <span class="info-label">Adresse email</span>
                    <span class="info-value">{{ auth()->user()->email }}</span>
                </div>
                
                <div class="info-item">
                    <span class="info-label">Numéro de téléphone</span>
                    <span class="info-value {{ !auth()->user()->telephone ? 'empty-value' : '' }}">
                        {{ auth()->user()->telephone ?? 'Non renseigné' }}
                    </span>
                </div>
                
                <div class="info-item">
                    <span class="info-label">Adresse postale</span>
                    <span class="info-value {{ !auth()->user()->adresse ? 'empty-value' : '' }}">
                        {{ auth()->user()->adresse ?? 'Non renseignée' }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Actions rapides -->
        <div class="info-card">
            <div class="info-header">
                <h2 class="info-title">
                    <i class="fas fa-bolt"></i>
                    Actions Rapides
                </h2>
            </div>
            
            <div class="quick-actions">
                <a href="{{ route('client.notifications') }}" class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-bell"></i>
                    </div>
                    <h3 class="action-title">Mes Notifications</h3>
                    <p class="action-description">Consultez vos messages et alertes</p>
                </a>
                
                <a href="{{ route('client.rendez-vous.create') }}" class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-calendar-plus"></i>
                    </div>
                    <h3 class="action-title">Nouveau RDV</h3>
                    <p class="action-description">Prendre un rendez-vous</p>
                </a>
                
                <a href="{{ route('client.demandes.hebergement.create') }}" class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <h3 class="action-title">Hébergement</h3>
                    <p class="action-description">Demander un hébergement</p>
                </a>
                
                <a href="{{ route('client.demandes.adoption') }}" class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-paw"></i>
                    </div>
                    <h3 class="action-title">Adoption</h3>
                    <p class="action-description">Voir mes demandes</p>
                </a>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation des cartes au survol
    const cards = document.querySelectorAll('.stat-card, .action-card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });

    // Auto-dismiss de l'alerte après 5 secondes
    const alert = document.querySelector('.alert');
    if (alert) {
        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    }
});
</script>
@endsection