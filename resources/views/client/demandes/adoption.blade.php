@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    <style>
        .adoption-container {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .page-header {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            color: white;
            padding: 50px 40px;
            border-radius: 25px;
            margin-bottom: 40px;
            box-shadow: 0 20px 40px rgba(67, 233, 123, 0.3);
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
        
        .alert-danger-custom {
            background: linear-gradient(135deg, #f8d7da, #f5c6cb);
            border: none;
            border-left: 5px solid #dc3545;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 40px;
            box-shadow: 0 10px 25px rgba(220, 53, 69, 0.2);
            position: relative;
            overflow: hidden;
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
            background: linear-gradient(135deg, #43e97b, #38f9d7);
        }
        
        .stat-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px rgba(67, 233, 123, 0.15);
        }
        
        .stat-card.pending {
            background: linear-gradient(135deg, #fff3cd, #ffeaa7);
        }
        
        .stat-card.approved {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
        }
        
        .stat-card.rejected {
            background: linear-gradient(135deg, #f8d7da, #f5c6cb);
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
            background: linear-gradient(135deg, #43e97b, #38f9d7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .stat-card.pending .stat-number {
            background: linear-gradient(135deg, #ffc107, #ffb300);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .stat-card.approved .stat-number {
            background: linear-gradient(135deg, #28a745, #20c997);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .stat-card.rejected .stat-number {
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
        
        .demandes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(500px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }
        
        .demande-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: all 0.4s ease;
            border: 1px solid #f0f0f0;
            position: relative;
        }
        
        .demande-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(67, 233, 123, 0.15);
        }
        
        .demande-card-header {
            padding: 25px;
            border-bottom: 1px solid #f0f0f0;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .animal-name {
            font-weight: 700;
            color: #2c3e50;
            font-size: 1.4rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .etat-badge {
            padding: 10px 20px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .etat-attente {
            background: linear-gradient(135deg, #ffeaa7, #fab1a0);
            color: #e17055;
        }
        
        .etat-approuve {
            background: linear-gradient(135deg, #a8e6cf, #dcedc1);
            color: #2d7d5a;
        }
        
        .etat-refuse {
            background: linear-gradient(135deg, #ffafbd, #ffc3a0);
            color: #c44569;
        }
        
        .demande-card-body {
            padding: 25px;
        }
        
        .animal-info {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .animal-photo {
            width: 120px;
            height: 120px;
            border-radius: 15px;
            object-fit: cover;
            border: 3px solid #43e97b;
            box-shadow: 0 5px 15px rgba(67, 233, 123, 0.3);
        }
        
        .animal-details {
            flex: 1;
        }
        
        .detail-item {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 8px;
            color: #495057;
            font-weight: 500;
        }
        
        .detail-item i {
            color: #43e97b;
            width: 20px;
        }
        
        .demande-meta {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 12px;
            padding: 15px;
            margin-top: 15px;
        }
        
        .meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 5px;
        }
        
        .demande-card-footer {
            padding: 20px 25px;
            background: #f8f9fa;
            border-top: 1px solid #f0f0f0;
        }
        
        .status-alert {
            border-radius: 12px;
            padding: 15px 20px;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 600;
        }
        
        .alert-pending {
            background: linear-gradient(135deg, #fff3cd, #ffeaa7);
            color: #856404;
            border-left: 4px solid #ffc107;
        }
        
        .alert-approved {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            color: #155724;
            border-left: 4px solid #28a745;
        }
        
        .alert-rejected {
            background: linear-gradient(135deg, #f8d7da, #f5c6cb);
            color: #721c24;
            border-left: 4px solid #dc3545;
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
        
        .empty-state-icon {
            font-size: 6rem;
            background: linear-gradient(135deg, #43e97b, #38f9d7);
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
        
        .btn-primary-custom {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
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
            box-shadow: 0 5px 15px rgba(67, 233, 123, 0.3);
        }
        
        .btn-primary-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(67, 233, 123, 0.4);
            background: linear-gradient(135deg, #38d96c 0%, #2de0c7 100%);
            color: white;
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
            
            .demandes-grid {
                grid-template-columns: 1fr;
            }
            
            .animal-info {
                flex-direction: column;
                text-align: center;
            }
            
            .animal-photo {
                align-self: center;
            }
            
            .demande-card-header {
                flex-direction: column;
                align-items: stretch;
                text-align: center;
            }
            
            .stats-cards {
                grid-template-columns: 1fr;
            }
        }
        
        .pagination-custom {
            display: flex;
            justify-content: center;
            margin-top: 40px;
        }
        
        .pagination-custom .page-link {
            border: none;
            border-radius: 10px;
            margin: 0 5px;
            color: #43e97b;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .pagination-custom .page-item.active .page-link {
            background: linear-gradient(135deg, #43e97b, #38f9d7);
            border-color: #43e97b;
        }
        
        .pagination-custom .page-link:hover {
            background: #f8f9fa;
            transform: translateY(-2px);
        }
    </style>

    <div class="adoption-container">
        <!-- En-tête de page -->
        <div class="page-header">
            <h1 class="page-title floating">
                <i class="fas fa-heart"></i>
                Mes Demandes d'Adoption
            </h1>
            <p class="page-subtitle">Suivez l'état de vos demandes d'adoption</p>
        </div>

        <!-- Messages d'alerte -->
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

        @if(session('error'))
            <div class="alert alert-danger-custom">
                <div class="d-flex align-items-center">
                    <i class="fas fa-exclamation-triangle me-3" style="font-size: 2rem; color: #dc3545;"></i>
                    <div>
                        <h4 class="mb-2" style="color: #721c24;">Attention</h4>
                        <p class="mb-0" style="color: #721c24; font-size: 1.1rem;">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

             <!-- Cartes de statistiques - Filtrées pour les adoptions uniquement -->
        <div class="stats-cards">
            @php
                // Filtrer uniquement les demandes qui ont une adoption
                $demandesAdoption = $demandes->filter(function($demande) {
                    return $demande->adoption != null;
                });
                
                // Compter par statut pour les adoptions
                $totalAdoptions = $demandesAdoption->count();
                $enAttenteAdoptions = $demandesAdoption->where('etat', 'en attente')->count();
                $approuveAdoptions = $demandesAdoption->where('etat', 'approuvé')->count();
                $refuseAdoptions = $demandesAdoption->where('etat', 'refusé')->count();
            @endphp
            
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-heart"></i>
                </div>
                <div class="stat-number">{{ $totalAdoptions }}</div>
                <div class="stat-label">Demandes d'Adoption</div>
            </div>
            
            <div class="stat-card pending">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-number">{{ $enAttenteAdoptions }}</div>
                <div class="stat-label">Adoptions en Attente</div>
            </div>
            
            <div class="stat-card approved">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-number">{{ $approuveAdoptions }}</div>
                <div class="stat-label">Adoptions Approuvées</div>
            </div>
            
            <div class="stat-card rejected">
                <div class="stat-icon">
                    <i class="fas fa-times-circle"></i>
                </div>
                <div class="stat-number">{{ $refuseAdoptions }}</div>
                <div class="stat-label">Adoptions Refusées</div>
            </div>
        </div>

        <!-- Liste des demandes -->
 
        <!-- Liste des demandes d'adoption -->
        @if($demandes && $demandes->count() > 0)
            <div class="demandes-grid">
                @foreach($demandes as $demande)
                    @if($demande->adoption) <!-- Afficher seulement si c'est une adoption -->
                        <div class="demande-card adoption-card">
                            <div class="demande-card-header">
                                <h3 class="animal-name">
                                    <i class="fas fa-paw"></i>
                                    {{ $demande->animal->nom }}
                                </h3>
                                <span class="etat-badge 
                                    @if($demande->etat == 'en attente') etat-attente
                                    @elseif($demande->etat == 'approuvé') etat-approuve
                                    @elseif($demande->etat == 'refusé') etat-refuse
                                    @endif">
                                    <i class="fas 
                                        @if($demande->etat == 'en attente') fa-clock
                                        @elseif($demande->etat == 'approuvé') fa-check-circle
                                        @elseif($demande->etat == 'refusé') fa-times-circle
                                        @endif me-1">
                                    </i>
                                    {{ ucfirst($demande->etat) }}
                                </span>
                            </div>
                            
                            <div class="demande-card-body">
                                <div class="animal-info">
                                    <div class="animal-photo-container">
                                        @if($demande->animal->photo)
                                            <img src="{{ asset('storage/' . $demande->animal->photo) }}" 
                                                 class="animal-photo" 
                                                 alt="{{ $demande->animal->nom }}">
                                        @else
                                            <img src="{{ asset('images/default-animal.png') }}" 
                                                 class="animal-photo" 
                                                 alt="{{ $demande->animal->nom }}">
                                        @endif
                                    </div>
                                    <div class="animal-details">
                                        <div class="detail-item">
                                            <i class="fas fa-dog"></i>
                                            <strong>Espèce :</strong> {{ $demande->animal->espece->nom ?? '-' }}
                                        </div>
                                        <div class="detail-item">
                                            <i class="fas fa-list"></i>
                                            <strong>Race :</strong> {{ $demande->animal->race->nom ?? '-' }}
                                        </div>
                                        <div class="detail-item">
                                            <i class="fas fa-birthday-cake"></i>
                                            <strong>Âge :</strong> {{ $demande->animal->age ?? 'Inconnu' }} ans
                                        </div>
                                        <div class="detail-item">
                                            <i class="fas fa-venus-mars"></i>
                                            <strong>Sexe :</strong> {{ ucfirst($demande->animal->sexe) }}
                                        </div>
                                        @if($demande->adoption && $demande->adoption->date)
                                            <div class="detail-item">
                                                <i class="fas fa-calendar-check"></i>
                                                <strong>Date d'adoption :</strong> 
                                                {{ $demande->adoption->date->format('d/m/Y') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="demande-meta">
                                    <div class="meta-item">
                                        <i class="fas fa-calendar-plus"></i>
                                        <strong>Date de la demande :</strong> 
                                        {{ $demande->created_at ? $demande->created_at->format('d/m/Y à H:i') : 'Date non disponible' }}
                                    </div>
                                    @if($demande->adoption && $demande->adoption->date)
                                        <div class="meta-item">
                                            <i class="fas fa-calendar-plus"></i>
                                            <strong>Date d'adoption prévue :</strong> 
                                            {{ $demande->adoption->date->format('d/m/Y') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="demande-card-footer">
                                @if($demande->etat == 'en attente')
                                    <div class="status-alert alert-pending">
                                        <i class="fas fa-clock"></i>
                                        Votre demande d'adoption est en cours d'examen par notre équipe.
                                    </div>
                                @elseif($demande->etat == 'approuvé')
                                    <div class="status-alert alert-approved">
                                        <i class="fas fa-check-circle"></i>
                                        Félicitations ! Votre demande d'adoption a été approuvée.
                                    </div>
                                @elseif($demande->etat == 'refusé')
                                    <div class="status-alert alert-rejected">
                                        <i class="fas fa-times-circle"></i>
                                        Votre demande d'adoption a été refusée. N'hésitez pas à consulter nos autres animaux disponibles.
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <!-- Pagination -->
            @if($demandes->hasPages())
                <div class="pagination-custom">
                    {{ $demandes->links() }}
                </div>
            @endif
        @else
            <!-- État vide -->
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="fas fa-heart floating"></i>
                </div>
                <h3 class="empty-state-title">Aucune demande d'adoption</h3>
                <p class="empty-state-text">Vous n'avez encore fait aucune demande d'adoption. Découvrez nos animaux qui cherchent une famille aimante !</p>
               <a href="{{ route('home') }}#animaux" class="btn-primary-custom mt-3">
                    <i class="fas fa-paw"></i>
                    Voir les animaux disponibles
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
    
    // Animation des cartes de demandes
    const demandeCards = document.querySelectorAll('.demande-card');
    demandeCards.forEach((card, index) => {
        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
    
    // Effet de survol amélioré
    demandeCards.forEach(card => {
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