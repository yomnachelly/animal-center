@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <style>
        .details-container {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .page-header {
            background: linear-gradient(135deg, #ff6b35, #ff8e53);
            color: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(255, 107, 53, 0.3);
        }
        
        .page-title {
            font-weight: 700;
            margin: 0;
            font-size: 2.2rem;
        }
        
        .details-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        
        .info-section {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 25px;
            border-left: 5px solid #ff6b35;
        }
        
        .section-title {
            color: #ff6b35;
            font-weight: 600;
            margin-bottom: 20px;
            font-size: 1.3rem;
            display: flex;
            align-items: center;
        }
        
        .section-title i {
            margin-right: 10px;
            font-size: 1.4rem;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .info-item {
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }
        
        .info-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 5px;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .info-value {
            color: #28a745;
            font-weight: 600;
            font-size: 1.1rem;
        }
        
        .badge-custom {
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
        }
        
        .badge-adoption {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
        }
        
        .badge-hebergement {
            background: linear-gradient(135deg, #17a2b8, #138496);
            color: white;
        }
        
        .badge-demande {
            background: linear-gradient(135deg, #6c757d, #868e96);
            color: white;
        }
        
        .badge-en_attente {
            background: linear-gradient(135deg, #ffc107, #ffb300);
            color: #212529;
        }
        
        .badge-accepte {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
        }
        
        .badge-rejete {
            background: linear-gradient(135deg, #dc3545, #e35d6a);
            color: white;
        }
        
        .user-avatar-large {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #ff6b35, #ff8e53);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 2rem;
            margin: 0 auto 15px;
            box-shadow: 0 5px 15px rgba(255, 107, 53, 0.3);
        }
        
        .animal-avatar-large {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 2rem;
            margin: 0 auto 15px;
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
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
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }
        
        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108, 117, 125, 0.4);
            color: white;
        }
        
        .btn-accept {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }
        
        .btn-accept:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.4);
            color: white;
        }
        
        .btn-reject {
            background: linear-gradient(135deg, #dc3545, #e35d6a);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }
        
        .btn-reject:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.4);
            color: white;
        }
        
        .details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        
        .detail-item {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            border-left: 4px solid #17a2b8;
        }
        
        @media (max-width: 768px) {
            .page-header {
                padding: 20px;
                text-align: center;
            }
            
            .action-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .info-grid, .details-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="details-container">
        <!-- En-tête de page -->
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h1 class="page-title">
                        <i class="fas fa-file-alt me-2"></i>📄 Détails de la Demande
                    </h1>
                    <p class="mb-0 mt-2 opacity-75">Demande #{{ $demande->id }}</p>
                </div>
                <a href="{{ route('admin.demandes.index') }}" class="btn btn-back">
                    <i class="fas fa-arrow-left me-2"></i>Retour à la liste
                </a>
            </div>
        </div>

        <div class="details-card">
            <!-- Informations générales -->
            <div class="info-section">
                <h3 class="section-title">
                    <i class="fas fa-info-circle"></i>Informations Générales
                </h3>
                
                <div class="info-grid">
                    <div class="info-item text-center">
                        <div class="user-avatar-large">
                            {{ strtoupper(substr($demande->user->name, 0, 1)) }}
                        </div>
                        <div class="info-label">Utilisateur</div>
                        <div class="info-value">{{ $demande->user->name }}</div>
                        <div class="text-muted small mt-1">{{ $demande->user->email }}</div>
                    </div>
                    
                    <div class="info-item text-center">
                        <div class="animal-avatar-large">
                            <i class="fas fa-paw"></i>
                        </div>
                        <div class="info-label">Animal</div>
                        <div class="info-value">{{ $demande->animal->nom }}</div>
                    </div>
                    
                    <div class="info-item text-center">
                        <div class="info-label">Type de Demande</div>
                        @php
                            $typeBadge = match($type) {
                                'adoption' => 'badge-adoption',
                                'hebergement' => 'badge-hebergement',
                                default => 'badge-demande'
                            };
                            $typeIcon = match($type) {
                                'adoption' => 'fa-home',
                                'hebergement' => 'fa-hotel',
                                default => 'fa-file-alt'
                            };
                        @endphp
                        <span class="badge-custom {{ $typeBadge }}">
                            <i class="fas {{ $typeIcon }} me-1"></i>
                            {{ ucfirst($type) }}
                        </span>
                    </div>
                    
                    <div class="info-item text-center">
                        <div class="info-label">État</div>
                        @php
                            $etatBadge = match($demande->etat) {
                                'en attente' => 'badge-en_attente',
                                'accepte' => 'badge-accepte',
                                'rejete' => 'badge-rejete',
                                default => 'badge-en_attente'
                            };
                            $etatIcon = match($demande->etat) {
                                'en attente' => 'fa-clock',
                                'accepte' => 'fa-check',
                                'rejete' => 'fa-times',
                                default => 'fa-clock'
                            };
                        @endphp
                        <span class="badge-custom {{ $etatBadge }}">
                            <i class="fas {{ $etatIcon }} me-1"></i>
                            {{ ucfirst($demande->etat) }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Détails spécifiques -->
            <div class="info-section">
                <h3 class="section-title">
                    <i class="fas fa-clipboard-check"></i>Détails de la Demande
                </h3>
                
                @if($type == 'adoption' && $details)
                    <div class="details-grid">
                        <div class="detail-item">
                            <div class="info-label">Date de la demande</div>
                            <div class="info-value">{{ \Carbon\Carbon::parse($details->date)->format('d/m/Y') }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="info-label">Type</div>
                            <div class="info-value">Adoption définitive</div>
                        </div>
                        <div class="detail-item">
                            <div class="info-label">Statut de l'animal</div>
                            <div class="info-value">{{ $demande->animal->statut ?? 'Non spécifié' }}</div>
                        </div>
                    </div>
                    
                @elseif($type == 'hebergement' && $details)
                    <div class="details-grid">
                        <div class="detail-item">
                            <div class="info-label">Date de début</div>
                            <div class="info-value">{{ \Carbon\Carbon::parse($details->date_debut)->format('d/m/Y') }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="info-label">Date de fin</div>
                            <div class="info-value">{{ \Carbon\Carbon::parse($details->date_fin)->format('d/m/Y') }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="info-label">Frais d'hébergement</div>
                            <div class="info-value">{{ number_format($details->frais, 2) }} DT</div>
                        </div>
                        <div class="detail-item">
                            <div class="info-label">Durée</div>
                            <div class="info-value">
                                {{ \Carbon\Carbon::parse($details->date_debut)->diffInDays(\Carbon\Carbon::parse($details->date_fin)) }} jours
                            </div>
                        </div>
                    </div>
                    
                @else
                    <div class="text-center text-muted py-4">
                        <i class="fas fa-info-circle fa-2x mb-3"></i>
                        <p>Aucun détail supplémentaire disponible pour ce type de demande.</p>
                    </div>
                @endif
            </div>

            <!-- Actions -->
            @if($demande->etat === 'en attente')
                <div class="action-buttons">
                    <form action="{{ route('admin.demandes.accepter', $demande->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn-accept"
                                onclick="return confirm('Êtes-vous sûr de vouloir accepter cette demande ?')">
                            <i class="fas fa-check me-2"></i>Accepter la demande
                        </button>
                    </form>

                    <form action="{{ route('admin.demandes.rejeter', $demande->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn-reject"
                                onclick="return confirm('Êtes-vous sûr de vouloir rejeter cette demande ?')">
                            <i class="fas fa-times me-2"></i>Rejeter la demande
                        </button>
                    </form>
                </div>
            @else
                <div class="text-center py-4">
                    <div class="alert alert-info d-inline-block">
                        <i class="fas fa-info-circle me-2"></i>
                        Cette demande a déjà été traitée.
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection