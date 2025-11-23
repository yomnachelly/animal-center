@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    <style>
        .rdv-client-container {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .page-header {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            padding: 50px 40px;
            border-radius: 25px;
            margin-bottom: 40px;
            box-shadow: 0 20px 40px rgba(79, 172, 254, 0.3);
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
        
        .btn-primary-custom {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
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
            box-shadow: 0 5px 15px rgba(79, 172, 254, 0.3);
        }
        
        .btn-primary-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(79, 172, 254, 0.4);
            background: linear-gradient(135deg, #3a9dfc 0%, #00d9e6 100%);
            color: white;
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
            background: linear-gradient(135deg, #4facfe, #00f2fe);
        }
        
        .stat-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px rgba(79, 172, 254, 0.15);
        }
        
        .stat-card.pending {
            background: linear-gradient(135deg, #fff3cd, #ffeaa7);
        }
        
        .stat-card.accepted {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
        }
        
        .stat-card.cancelled {
            background: linear-gradient(135deg, #f8d7da, #f5c6cb);
        }
        
        .stat-card.total {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
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
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .stat-card.pending .stat-number {
            background: linear-gradient(135deg, #ffc107, #ffb300);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .stat-card.accepted .stat-number {
            background: linear-gradient(135deg, #28a745, #20c997);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .stat-card.cancelled .stat-number {
            background: linear-gradient(135deg, #dc3545, #e35d6a);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .stat-label {
            color: #6c757d;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.9rem;
        }
        
        .rdv-cards-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }
        
        .rdv-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: all 0.4s ease;
            border: 1px solid #f0f0f0;
        }
        
        .rdv-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(79, 172, 254, 0.15);
        }
        
        .rdv-card-header {
            padding: 25px;
            border-bottom: 1px solid #f0f0f0;
            position: relative;
        }
        
        .rdv-card.accepted .rdv-card-header {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
        }
        
        .rdv-card.pending .rdv-card-header {
            background: linear-gradient(135deg, #fff3cd, #ffeaa7);
        }
        
        .rdv-card.cancelled .rdv-card-header {
            background: linear-gradient(135deg, #f8d7da, #f5c6cb);
        }
        
        .animal-info {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
        }
        
        .animal-avatar {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1.5rem;
            box-shadow: 0 5px 15px rgba(79, 172, 254, 0.3);
        }
        
        .animal-details h4 {
            margin: 0;
            color: #2c3e50;
            font-weight: 700;
        }
        
        .animal-details p {
            margin: 5px 0 0 0;
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        .rdv-date {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 600;
            color: #2c3e50;
            font-size: 1.1rem;
        }
        
        .rdv-card-body {
            padding: 25px;
        }
        
        .services-section {
            margin-bottom: 20px;
        }
        
        .section-title {
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 1.1rem;
        }
        
        .services-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        
        .service-badge {
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            color: white;
            padding: 6px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        
        .service-badge.soin {
            background: linear-gradient(135deg, #4facfe, #00f2fe);
        }
        
        .service-badge.vaccin {
            background: linear-gradient(135deg, #43e97b, #38f9d7);
        }
        
        .rdv-card-footer {
            padding: 20px 25px;
            background: #f8f9fa;
            border-top: 1px solid #f0f0f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .etat-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .etat-attente {
            background: linear-gradient(135deg, #ffeaa7, #fab1a0);
            color: #e17055;
        }
        
        .etat-accepte {
            background: linear-gradient(135deg, #a8e6cf, #dcedc1);
            color: #2d7d5a;
        }
        
        .etat-refuse {
            background: linear-gradient(135deg, #ffafbd, #ffc3a0);
            color: #c44569;
        }
        
        .btn-cancel {
            background: linear-gradient(135deg, #ff6b6b, #ff8e8e);
            border: none;
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 15px rgba(255, 107, 107, 0.3);
        }
        
        .btn-cancel:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 107, 107, 0.4);
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
        
        @keyframes shimmer {
            100% { transform: translateX(100%); }
        }
        
        .empty-state-icon {
            font-size: 6rem;
            background: linear-gradient(135deg, #4facfe, #00f2fe);
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
        
        .urgent-badge {
            background: linear-gradient(135deg, #ff6b6b, #ff8e8e);
            color: white;
            padding: 4px 8px;
            border-radius: 10px;
            font-size: 0.7rem;
            font-weight: 600;
            margin-left: 10px;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
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
            
            .rdv-cards-container {
                grid-template-columns: 1fr;
            }
            
            .rdv-card-footer {
                flex-direction: column;
                align-items: stretch;
                text-align: center;
            }
            
            .stats-cards {
                grid-template-columns: 1fr;
            }
            
            .animal-info {
                flex-direction: column;
                text-align: center;
                gap: 10px;
            }
        }
    </style>

    <div class="rdv-client-container">
        <!-- En-tête de page -->
        <div class="page-header">
            <h1 class="page-title floating">
                <i class="fas fa-calendar-alt"></i>
                Mes Rendez-vous
            </h1>
            <p class="page-subtitle">Gérez et suivez vos rendez-vous vétérinaires</p>
        </div>

        <!-- Bouton nouveau rendez-vous -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('client.rendez-vous.create') }}" class="btn-primary-custom">
                <i class="fas fa-plus-circle"></i>
                Nouveau Rendez-vous
            </a>
        </div>

        <!-- Cartes de statistiques -->
        <div class="stats-cards">
            <div class="stat-card total">
                <div class="stat-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="stat-number">{{ $rendezvous->count() }}</div>
                <div class="stat-label">Total des RDV</div>
            </div>
            <div class="stat-card pending">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-number">{{ $rendezvous->where('etat', 'en attente')->count() }}</div>
                <div class="stat-label">En Attente</div>
            </div>
            <div class="stat-card accepted">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-number">{{ $rendezvous->where('etat', 'accepté')->count() }}</div>
                <div class="stat-label">Acceptés</div>
            </div>
            <div class="stat-card cancelled">
                <div class="stat-icon">
                    <i class="fas fa-times-circle"></i>
                </div>
                <div class="stat-number">{{ $rendezvous->where('etat', 'refuse')->count() }}</div>
                <div class="stat-label">Rejetés</div>
            </div>
        </div>

        <!-- Liste des rendez-vous -->
        @if($rendezvous->count() > 0)
            <div class="rdv-cards-container">
                @foreach($rendezvous as $rdv)
                    <div class="rdv-card {{ $rdv->etat == 'accepté' ? 'accepted' : ($rdv->etat == 'en attente' ? 'pending' : 'cancelled') }}">
                        <div class="rdv-card-header">
                            <div class="animal-info">
                                <div class="animal-avatar">
                                    <i class="fas fa-paw"></i>
                                </div>
                                <div class="animal-details">
                                    <h4>{{ $rdv->animal->nom }}</h4>
                                    <p>{{ $rdv->animal->espece->nom }} • {{ $rdv->animal->race->nom ?? 'Race non spécifiée' }}</p>
                                </div>
                            </div>
                            <div class="rdv-date">
                                <i class="fas fa-calendar"></i>
                                {{ \Carbon\Carbon::parse($rdv->date)->format('d/m/Y') }}
                                @if($rdv->heure)
                                    <i class="fas fa-clock ms-3"></i>
                                    {{ $rdv->heure }}
                                @endif
                                @if(\Carbon\Carbon::parse($rdv->date)->isToday())
                                    <span class="urgent-badge">Aujourd'hui</span>
                                @elseif(\Carbon\Carbon::parse($rdv->date)->isTomorrow())
                                    <span class="urgent-badge" style="background:linear-gradient(135deg, #ffd93d, #ff6b6b);">Demain</span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="rdv-card-body">
                            @if($rdv->soins->count() > 0)
                                <div class="services-section">
                                    <h5 class="section-title">
                                        <i class="fas fa-hand-holding-medical"></i>
                                        Soins demandés
                                    </h5>
                                    <div class="services-list">
                                        @foreach($rdv->soins as $soin)
                                            <span class="service-badge soin">
                                                <i class="fas fa-stethoscope"></i>
                                                {{ $soin->nom }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            
                            @if($rdv->vaccins->count() > 0)
                                <div class="services-section">
                                    <h5 class="section-title">
                                        <i class="fas fa-syringe"></i>
                                        Vaccins demandés
                                    </h5>
                                    <div class="services-list">
                                        @foreach($rdv->vaccins as $vaccin)
                                            <span class="service-badge vaccin">
                                                <i class="fas fa-shield-alt"></i>
                                                {{ $vaccin->nom }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            
                            @if($rdv->soins->count() == 0 && $rdv->vaccins->count() == 0)
                                <div class="text-center text-muted py-3">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Aucun service spécifique demandé
                                </div>
                            @endif
                        </div>
                        
                        <div class="rdv-card-footer">
                            <span class="etat-badge 
                                @if($rdv->etat == 'accepté') etat-accepte
                                @elseif($rdv->etat == 'en attente') etat-attente
                                @elseif($rdv->etat == 'rejeté') etat-refuse
                                @endif">
                                <i class="fas 
                                    @if($rdv->etat == 'accepté') fa-check-circle
                                    @elseif($rdv->etat == 'en attente') fa-clock
                                    @elseif($rdv->etat == 'rejeté') fa-times-circle
                                    @endif me-1">
                                </i>
                                {{ ucfirst($rdv->etat) }}
                            </span>
                            
                            @if($rdv->etat == 'en attente')
                                <form action="{{ route('client.rendez-vous.annuler', $rdv->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-cancel" 
                                            onclick="return confirm('Êtes-vous sûr de vouloir annuler ce rendez-vous ?')">
                                        <i class="fas fa-times"></i>
                                        Annuler
                                    </button>
                                </form>
                            @else
                                <span class="text-muted">
                                    <i class="fas fa-lock me-1"></i>
                                    Action non disponible
                                </span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- État vide -->
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="fas fa-calendar-times floating"></i>
                </div>
                <h3 class="empty-state-title">Aucun rendez-vous pour le moment</h3>
                <p class="empty-state-text">Prenez votre premier rendez-vous pour votre animal de compagnie</p>
                <a href="{{ route('client.rendez-vous.create') }}" class="btn-primary-custom mt-3">
                    <i class="fas fa-plus-circle"></i>
                    Prendre un rendez-vous
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
    
    // Animation des cartes de rendez-vous
    const rdvCards = document.querySelectorAll('.rdv-card');
    rdvCards.forEach((card, index) => {
        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
    
    // Confirmation pour l'annulation
    const cancelForms = document.querySelectorAll('form[action*="annuler"]');
    cancelForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!confirm('Êtes-vous sûr de vouloir annuler ce rendez-vous ? Cette action est irréversible.')) {
                e.preventDefault();
            }
        });
    });
    
    // Effet de survol amélioré
    rdvCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(-8px) scale(1)';
        });
    });
});
</script>
@endsection