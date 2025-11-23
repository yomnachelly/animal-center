@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    <style>
        .page-header {
            background: linear-gradient(135deg, #dc3545 0%, #e35d6a 100%);
            color: white;
            padding: 40px 30px;
            border-radius: 20px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(220, 53, 69, 0.2);
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
        
        .floating-animation {
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        @media (max-width: 768px) {
            .page-title {
                font-size: 2rem;
            }
        }

        /* Garder tous vos styles existants */
        :root {
            --primary-color: #2c5530;
            --secondary-color: #4a7c59;
            --accent-color: #8fb996;
            --vet-primary: #dc3545;
            --vet-secondary: #e35d6a;
            --vet-light: #f8d7da;
        }
        
        .vet-dashboard {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .stats-card {
            border: none;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            height: 100%;
        }
        
        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        
        .stats-card.primary {
            background: linear-gradient(135deg, var(--vet-primary), var(--vet-secondary));
            color: white;
        }
        
        .stats-card.success {
            background: linear-gradient(135deg, var(--secondary-color), var(--accent-color));
            color: white;
        }
        
        .stats-card.warning {
            background: linear-gradient(135deg, #ffc107, #ffdb4d);
            color: #212529;
        }
        
        .stats-card.info {
            background: linear-gradient(135deg, #0dcaf0, #6edff6);
            color: #212529;
        }
        
        .stats-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
            opacity: 0.9;
        }
        
        .stats-number {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 5px;
        }
        
        .stats-label {
            font-size: 0.9rem;
            opacity: 0.9;
            font-weight: 500;
        }
        
        .quick-actions {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            margin-bottom: 20px;
        }
        
        .quick-actions h3 {
            color: var(--vet-primary);
            margin-bottom: 20px;
            font-weight: 600;
        }
        
        .action-btn {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            margin-bottom: 10px;
            border: none;
            border-radius: 10px;
            background: var(--vet-light);
            color: var(--vet-primary);
            text-decoration: none;
            transition: all 0.3s ease;
            width: 100%;
            text-align: left;
        }
        
        .action-btn:hover {
            background: var(--vet-primary);
            color: white;
            transform: translateX(5px);
        }
        
        .action-btn i {
            font-size: 1.2rem;
            margin-right: 10px;
            width: 25px;
        }
        
        .recent-activity {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
        
        .recent-activity h3 {
            color: var(--vet-primary);
            margin-bottom: 20px;
            font-weight: 600;
        }
        
        .activity-item {
            display: flex;
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid #eee;
            transition: all 0.3s ease;
        }
        
        .activity-item:hover {
            background: #f8f9fa;
            border-radius: 8px;
        }
        
        .activity-item:last-child {
            border-bottom: none;
        }
        
        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--vet-light);
            color: var(--vet-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 1rem;
        }
        
        .activity-content {
            flex: 1;
        }
        
        .activity-title {
            font-weight: 600;
            margin-bottom: 2px;
            color: #333;
        }
        
        .activity-time {
            font-size: 0.85rem;
            color: #6c757d;
        }
        
        .calendar-widget {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            margin-bottom: 20px;
        }
        
        .calendar-widget h3 {
            color: var(--vet-primary);
            margin-bottom: 20px;
            font-weight: 600;
        }
        
        .calendar-day {
            text-align: center;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 5px;
            transition: all 0.3s ease;
        }
        
        .calendar-day:hover {
            background: var(--vet-light);
            cursor: pointer;
        }
        
        .calendar-day.today {
            background: var(--vet-primary);
            color: white;
        }
        
        .calendar-day.has-event {
            background: var(--accent-color);
            color: white;
        }
        
        .day-number {
            font-size: 1.1rem;
            font-weight: 600;
        }
        
        .day-name {
            font-size: 0.8rem;
            opacity: 0.7;
        }
        
        .section-title {
            position: relative;
            margin-bottom: 25px;
            padding-bottom: 10px;
            font-weight: 700;
            color: var(--vet-primary);
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background-color: var(--vet-primary);
            border-radius: 2px;
        }
        
        @media (max-width: 768px) {
            .stats-number {
                font-size: 1.8rem;
            }
            
            .stats-card {
                padding: 20px;
            }
        }
    </style>

    <div class="vet-dashboard">
        <!-- Nouvel en-tête avec le style demandé -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="page-title">
                        <i class="fas fa-tachometer-alt floating-animation"></i>
                        Dashboard Vétérinaire
                    </h1>
                    <p class="page-subtitle">
                        Bienvenue sur votre espace professionnel, {{ auth()->user()->name }}
                    </p>
                </div>
                <div class="col-md-4 text-md-end">
                    <span class="user-badge">
                        <i class="fas fa-user-md"></i>
                        Vétérinaire
                    </span>
                </div>
            </div>
        </div>

        <!-- Statistiques en haut -->
        <div class="row mb-4">
            <div class="col-md-3 col-6">
                <div class="stats-card primary">
                    <div class="stats-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="stats-number">{{ $rdvCount }}</div>
                    <div class="stats-label">Rendez-vous aujourd'hui</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stats-card success">
                    <div class="stats-icon">
                        <i class="fas fa-syringe"></i>
                    </div>
                    <div class="stats-number">{{ $vaccinsCount }}</div>
                    <div class="stats-label">Vaccins à effectuer</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stats-card warning">
                    <div class="stats-icon">
                        <i class="fas fa-hand-holding-medical"></i>
                    </div>
                    <div class="stats-number">{{ $soinsCount }}</div>
                    <div class="stats-label">Soins en attente</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stats-card info">
                    <div class="stats-icon">
                        <i class="fas fa-notes-medical"></i>
                    </div>
                    <div class="stats-number">{{ $dossiersCount }}</div>
                    <div class="stats-label">Dossiers médicaux</div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Colonne de gauche : Actions rapides et Calendrier -->
            <div class="col-md-4">
                <!-- Actions rapides -->
                <div class="quick-actions">
                    <h3 class="section-title">Actions rapides</h3>
                    <a href="{{ route('vet.soins.index') }}" class="action-btn">
                        <i class="fas fa-hand-holding-medical"></i>
                        <span>Gérer les soins ({{ $soinsCount }})</span>
                    </a>
                    <a href="{{ route('vet.vaccins.index') }}" class="action-btn">
                        <i class="fas fa-syringe"></i>
                        <span>Vaccinations ({{ $vaccinsCount }})</span>
                    </a>
                    <a href="{{ route('vet.rendezvous.index') }}" class="action-btn">
                        <i class="fas fa-calendar-check"></i>
                        <span>Rendez-vous ({{ $rdvCount }})</span>
                    </a>
                    <a href="{{ route('vet.calendar') }}" class="action-btn">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Calendrier</span>
                    </a>
                </div>
            </div>

            <!-- Colonne de droite : Activité récente -->
            <div class="col-md-8">
                <div class="recent-activity">
                    <h3 class="section-title">Activité récente</h3>
                    
                    <!-- Soins récents -->
                    @if($soinsRecents->count() > 0)
                        @foreach($soinsRecents as $soin)
                            <div class="activity-item">
                                <div class="activity-icon">
                                    <i class="fas fa-hand-holding-medical"></i>
                                </div>
                                <div class="activity-content">
                                    <div class="activity-title">Soin: {{ $soin->nom }}</div>
                                    <div class="activity-time">
                                        Frais: {{ $soin->frais }} € 
                                        @if($soin->created_at)
                                            • Créé le {{ $soin->created_at->format('d/m/Y') }}
                                        @else
                                            • Date non disponible
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="activity-item">
                            <div class="activity-content">
                                <div class="activity-title">Aucun soin récent</div>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Vaccins récents -->
                    @if($vaccinsRecents->count() > 0)
                        @foreach($vaccinsRecents as $vaccin)
                            <div class="activity-item">
                                <div class="activity-icon">
                                    <i class="fas fa-syringe"></i>
                                </div>
                                <div class="activity-content">
                                    <div class="activity-title">Vaccin: {{ $vaccin->nom }}</div>
                                    <div class="activity-time">
                                        Frais: {{ $vaccin->frais }} € 
                                        @if($vaccin->created_at)
                                            • Créé le {{ $vaccin->created_at->format('d/m/Y') }}
                                        @else
                                            • Date non disponible
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="activity-item">
                            <div class="activity-content">
                                <div class="activity-title">Aucun vaccin récent</div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animation des cartes de statistiques
        const statsCards = document.querySelectorAll('.stats-card');
        statsCards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
        });
        
        // Gestion du calendrier
        const calendarDays = document.querySelectorAll('.calendar-day');
        calendarDays.forEach(day => {
            day.addEventListener('click', function() {
                // Redirection vers le calendrier complet
                window.location.href = "{{ route('vet.calendar') }}";
            });
        });
    });
</script>

@endsection