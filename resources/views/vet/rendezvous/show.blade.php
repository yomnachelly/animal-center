@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <style>
        .rdv-details-container {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 900px;
            margin: 0 auto;
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
        
        .page-subtitle {
            opacity: 0.9;
            margin: 10px 0 0 0;
            font-size: 1.1rem;
        }
        
        .details-card {
            background: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 30px;
        }
        
        .info-section {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            padding: 25px;
            border-radius: 12px;
            border-left: 4px solid #6f42c1;
        }
        
        .info-section h3 {
            color: #6f42c1;
            font-weight: 600;
            margin-bottom: 20px;
            font-size: 1.3rem;
            display: flex;
            align-items: center;
        }
        
        .info-section h3 i {
            margin-right: 10px;
            font-size: 1.2rem;
        }
        
        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #dee2e6;
        }
        
        .info-item:last-child {
            border-bottom: none;
        }
        
        .info-label {
            font-weight: 600;
            color: #495057;
            display: flex;
            align-items: center;
        }
        
        .info-label i {
            margin-right: 8px;
            color: #6f42c1;
            width: 20px;
        }
        
        .info-value {
            font-weight: 500;
            color: #6c757d;
            text-align: right;
        }
        
        .etat-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .etat-attente {
            background: linear-gradient(135deg, #ffc107, #ffb300);
            color: #212529;
        }
        
        .etat-accepte {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
        }
        
        .etat-refuse {
            background: linear-gradient(135deg, #dc3545, #e35d6a);
            color: white;
        }
        
        .services-list {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-top: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }
        
        .service-item {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            margin-bottom: 8px;
            background: #f8f9fa;
            border-radius: 8px;
            border-left: 4px solid #17a2b8;
            transition: all 0.3s ease;
        }
        
        .service-item:hover {
            transform: translateX(5px);
            background: #e9ecef;
        }
        
        .service-item:last-child {
            margin-bottom: 0;
        }
        
        .service-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #17a2b8, #138496);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 1.1rem;
        }
        
        .service-name {
            font-weight: 600;
            color: #495057;
            flex: 1;
        }
        
        .service-type {
            background: linear-gradient(135deg, #6f42c1, #8e44ad);
            color: white;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .date-time-card {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            border-radius: 12px;
            padding: 25px;
            text-align: center;
            border-left: 4px solid #2196f3;
        }
        
        .date-display {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1976d2;
            margin-bottom: 10px;
        }
        
        .time-display {
            font-size: 1.2rem;
            color: #1565c0;
            font-weight: 600;
        }
        
        .urgent-indicator {
            background: linear-gradient(135deg, #dc3545, #e35d6a);
            color: white;
            padding: 6px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-top: 10px;
            display: inline-block;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        
        .action-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 30px;
            flex-wrap: wrap;
        }
        
        .btn-back {
            background: linear-gradient(135deg, #6c757d, #868e96);
            border: none;
            color: white;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(108, 117, 125, 0.3);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }
        
        .btn-back:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(108, 117, 125, 0.4);
            background: linear-gradient(135deg, #5a6268, #727b84);
            color: white;
        }
        
        .btn-actions {
            background: linear-gradient(135deg, #6f42c1, #8e44ad);
            border: none;
            color: white;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(111, 66, 193, 0.3);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }
        
        .btn-actions:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(111, 66, 193, 0.4);
            background: linear-gradient(135deg, #5a2d91, #732d91);
            color: white;
        }
        
        .animal-details {
            background: linear-gradient(135deg, #e8f5e8, #d4edda);
            border-radius: 10px;
            padding: 20px;
            margin-top: 10px;
            border-left: 4px solid #28a745;
        }
        
        .animal-details h4 {
            color: #155724;
            margin-bottom: 10px;
            font-weight: 600;
        }
        
        @media (max-width: 768px) {
            .page-header {
                padding: 20px;
                text-align: center;
            }
            
            .details-card {
                padding: 25px;
            }
            
            .info-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .btn-back, .btn-actions {
                width: 100%;
                justify-content: center;
            }
        }
    </style>

    <div class="rdv-details-container">
        <!-- En-tête de page -->
        <div class="page-header">
            <h1 class="page-title">
                <i class="fas fa-calendar-check me-2"></i>📋 Détails du Rendez-vous
            </h1>
            <p class="page-subtitle">Rendez-vous #{{ $rendezvous->id }} - Consultation détaillée</p>
        </div>

        <!-- Carte principale des détails -->
        <div class="details-card">
            <!-- Grille d'informations -->
            <div class="info-grid">
                <!-- Informations client et animal -->
                <div class="info-section">
                    <h3><i class="fas fa-users"></i> Informations Générales</h3>
                    
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fas fa-user"></i>Client
                        </span>
                        <span class="info-value">{{ $rendezvous->user->name }}</span>
                    </div>
                    
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fas fa-paw"></i>Animal
                        </span>
                        <span class="info-value">{{ $rendezvous->animal->nom }}</span>
                    </div>
                    
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fas fa-info-circle"></i>État
                        </span>
                        <span class="info-value">
                            @php
                                $etatClass = match($rendezvous->etat) {
                                    'en attente' => 'etat-attente',
                                    'accepté' => 'etat-accepte',
                                    'refusé' => 'etat-refuse',
                                    default => 'etat-attente'
                                };
                            @endphp
                            <span class="etat-badge {{ $etatClass }}">
                                <i class="fas 
                                    @if($rendezvous->etat == 'en attente') fa-clock 
                                    @elseif($rendezvous->etat == 'accepté') fa-check-circle 
                                    @elseif($rendezvous->etat == 'refusé') fa-times-circle 
                                    @endif me-1">
                                </i>
                                {{ ucfirst($rendezvous->etat) }}
                            </span>
                        </span>
                    </div>
                </div>

                <!-- Date et heure -->
                <div class="info-section">
                    <h3><i class="fas fa-clock"></i> Date & Heure</h3>
                    
                    <div class="date-time-card">
                        <div class="date-display">
                            <i class="fas fa-calendar me-2"></i>
                            {{ \Carbon\Carbon::parse($rendezvous->date)->format('d/m/Y') }}
                        </div>
                        
                        @if($rendezvous->heure)
                            <div class="time-display">
                                <i class="fas fa-clock me-2"></i>
                                {{ $rendezvous->heure }}
                            </div>
                        @endif
                        
                        @php
                            $rdvDate = \Carbon\Carbon::parse($rendezvous->date);
                            $today = \Carbon\Carbon::today();
                            $diffDays = $today->diffInDays($rdvDate, false);
                        @endphp
                        
                        @if($diffDays == 0)
                            <div class="urgent-indicator">
                                <i class="fas fa-exclamation-triangle me-1"></i>Aujourd'hui
                            </div>
                        @elseif($diffDays == 1)
                            <div class="urgent-indicator" style="background:linear-gradient(135deg, #ffc107, #ffb300);">
                                <i class="fas fa-clock me-1"></i>Demain
                            </div>
                        @elseif($diffDays < 0)
                            <div class="urgent-indicator" style="background:linear-gradient(135deg, #6c757d, #868e96);">
                                <i class="fas fa-history me-1"></i>Passé
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Services demandés -->
            <div class="info-section">
                <h3>
                    <i class="fas fa-concierge-bell"></i> 
                    Services Demandés
                </h3>
                
                <div class="services-list">
                    @if($rendezvous->soins->count())
                        <div class="service-type mb-3">
                            <i class="fas fa-hand-holding-medical me-1"></i>Soins Médicaux
                        </div>
                        @foreach($rendezvous->soins as $s)
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-stethoscope"></i>
                                </div>
                                <div class="service-name">{{ $s->nom }}</div>
                                <div class="service-price">{{ $s->frais }} DT</div>
                            </div>
                        @endforeach
                    @elseif($rendezvous->vaccins->count())
                        <div class="service-type mb-3">
                            <i class="fas fa-syringe me-1"></i>Vaccinations
                        </div>
                        @foreach($rendezvous->vaccins as $v)
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <div class="service-name">{{ $v->nom }}</div>
                                <div class="service-price">{{ $v->frais }} DT</div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- Détails supplémentaires de l'animal -->
            @if($rendezvous->animal)
                <div class="animal-details">
                    <h4><i class="fas fa-info-circle me-2"></i>Informations sur l'animal</h4>
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fas fa-hashtag"></i>Espèce
                        </span>
                        <span class="info-value">{{ $rendezvous->animal->espece->nom ?? 'Non spécifiée' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fas fa-dna"></i>Race
                        </span>
                        <span class="info-value">{{ $rendezvous->animal->race->nom ?? 'Non spécifiée' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fas fa-birthday-cake"></i>Âge
                        </span>
                        <span class="info-value">{{ $rendezvous->animal->age ?? 'Inconnu' }} ans</span>
                    </div>
                </div>
            @endif
        </div>

        <!-- Actions -->
        <div class="action-buttons">
            <a href="{{ route('vet.rendezvous.index') }}" class="btn-back">
                <i class="fas fa-arrow-left me-2"></i>Retour à la liste
            </a>
            
            @if($rendezvous->etat == 'en attente')
                <a href="{{ route('vet.rendezvous.index') }}#rdv-{{ $rendezvous->id }}" class="btn-actions">
                    <i class="fas fa-cogs me-2"></i>Gérer ce rendez-vous
                </a>
            @endif
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animation des éléments de service
        const serviceItems = document.querySelectorAll('.service-item');
        serviceItems.forEach((item, index) => {
            item.style.animationDelay = `${index * 0.1}s`;
        });
        
        // Effet de surbrillance sur les cartes
        const infoSections = document.querySelectorAll('.info-section');
        infoSections.forEach(section => {
            section.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
                this.style.boxShadow = '0 10px 25px rgba(0, 0, 0, 0.15)';
            });
            
            section.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = 'none';
            });
        });
    });
</script>
@endsection