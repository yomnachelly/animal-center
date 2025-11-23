@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <style>
        /* Votre CSS existant reste inchangé */
        .rdv-container {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
        
        .alert-success-custom {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            border: none;
            border-left: 5px solid #28a745;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.2);
        }
        
        .rdv-table {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        
        .rdv-table thead {
            background: linear-gradient(135deg, #6f42c1, #5a2d91);
        }
        
        .rdv-table thead th {
            border: none;
            padding: 20px 15px;
            font-weight: 600;
            color: white;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .rdv-table tbody tr {
            transition: all 0.3s ease;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .rdv-table tbody tr:hover {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            transform: translateX(5px);
        }
        
        .rdv-table tbody td {
            border: none;
            padding: 20px 15px;
            vertical-align: middle;
            font-size: 1rem;
        }
        
        .client-info {
            font-weight: 600;
            color: #6f42c1;
        }
        
        .animal-info {
            color: #495057;
            font-weight: 500;
        }
        
        .type-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .type-soins {
            background: linear-gradient(135deg, #17a2b8, #138496);
            color: white;
        }
        
        .type-vaccin {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
        }
        
        .date-time {
            font-weight: 600;
            color: #495057;
        }
        
        /* AUGMENTATION DE LA TAILLE DES BADGES D'ÉTAT */
        .etat-badge {
            padding: 10px 16px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.9rem;
            min-width: 120px;
            text-align: center;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        
        .etat-badge:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }
        
        .etat-attente {
            background: linear-gradient(135deg, #ffc107, #ffb300);
            color: #212529;
            border: 2px solid #ffc107;
        }
        
        .etat-accepte {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            border: 2px solid #28a745;
        }
        
        .etat-refuse {
            background: linear-gradient(135deg, #dc3545, #e35d6a);
            color: white;
            border: 2px solid #dc3545;
        }
        
        .action-buttons {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }
        
        .btn-details {
            background: linear-gradient(135deg, #17a2b8, #138496);
            border: none;
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-details:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(23, 162, 184, 0.4);
            color: white;
        }
        
        .btn-accept {
            background: linear-gradient(135deg, #28a745, #20c997);
            border: none;
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .btn-accept:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.4);
        }
        
        .btn-refuse {
            background: linear-gradient(135deg, #dc3545, #e35d6a);
            border: none;
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .btn-refuse:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.4);
        }
        
        .refuse-form {
            background: linear-gradient(135deg, #f8d7da, #f5c6cb);
            padding: 15px;
            border-radius: 10px;
            margin-top: 10px;
            border-left: 4px solid #dc3545;
        }
        
        .refuse-form input {
            border: 1px solid #dc3545;
            border-radius: 5px;
            padding: 5px 10px;
            margin: 0 5px;
            font-size: 0.85rem;
        }
        
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 15px;
            margin: 20px 0;
        }
        
        .empty-state-icon {
            font-size: 4rem;
            color: #6c757d;
            margin-bottom: 20px;
        }
        
        .empty-state-title {
            color: #495057;
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 10px;
        }
        
        .empty-state-text {
            color: #6c757d;
            font-size: 1.1rem;
            margin-bottom: 30px;
        }
        
        .stats-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            text-align: center;
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #6f42c1;
            margin-bottom: 5px;
        }
        
        .stat-label {
            color: #6c757d;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.8rem;
        }
        
        .urgent-badge {
            background: linear-gradient(135deg, #dc3545, #e35d6a);
            color: white;
            padding: 4px 8px;
            border-radius: 10px;
            font-size: 0.7rem;
            font-weight: 600;
            margin-left: 5px;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        
        /* Style pour la colonne État élargie */
        .etat-column {
            width: 180px; /* Largeur augmentée pour la colonne État */
        }
        
        .etat-content {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
        
        @media (max-width: 768px) {
            .page-header {
                padding: 20px;
                text-align: center;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .refuse-form {
                display: flex;
                flex-direction: column;
                gap: 8px;
            }
            
            .refuse-form input {
                margin: 2px 0;
            }
            
            .rdv-table thead th,
            .rdv-table tbody td {
                padding: 15px 8px;
                font-size: 0.9rem;
            }
            
            .etat-badge {
                min-width: 100px;
                padding: 8px 12px;
                font-size: 0.8rem;
            }
            
            .etat-column {
                width: 140px;
            }
        }
        
        @media (max-width: 576px) {
            .etat-badge {
                min-width: 90px;
                padding: 6px 10px;
                font-size: 0.75rem;
            }
            
            .etat-column {
                width: 120px;
            }
        }
    </style>

    <div class="rdv-container">
        <!-- En-tête de page -->
        <div class="page-header">
            <h1 class="page-title">
                <i class="fas fa-calendar-check me-2"></i>📅 Mes Rendez-vous Vétérinaires
            </h1>
        </div>

        <!-- Message de succès -->
        @if(session('success'))
            <div class="alert alert-success-custom">
                <div class="d-flex align-items-center">
                    <i class="fas fa-check-circle me-3 text-success" style="font-size: 1.5rem;"></i>
                    <div>
                        <h5 class="mb-1 text-success">Succès !</h5>
                        <p class="mb-0">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @php
            // Récupérer l'ID du vétérinaire connecté
            $vetId = auth()->id();
            
            // Filtrer les rendez-vous pour ce vétérinaire seulement
            $mesRendezVous = $rendezvous->filter(function($rdv) use ($vetId) {
                // Vérifier si le rendez-vous a des soins associés à ce vétérinaire
                if ($rdv->soins->count() > 0) {
                    return $rdv->soins->first()->vet_id == $vetId;
                }
                // Vérifier si le rendez-vous a des vaccins associés à ce vétérinaire
                if ($rdv->vaccins->count() > 0) {
                    return $rdv->vaccins->first()->vet_id == $vetId;
                }
                return false;
            });
        @endphp

        <!-- Cartes de statistiques -->
        <div class="stats-cards">
            <div class="stat-card">
                <div class="stat-number">{{ $mesRendezVous->count() }}</div>
                <div class="stat-label">Mes RDV</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $mesRendezVous->where('etat', 'en attente')->count() }}</div>
                <div class="stat-label">En Attente</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $mesRendezVous->where('etat', 'accepté')->count() }}</div>
                <div class="stat-label">Acceptés</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $mesRendezVous->where('etat', 'refuse')->count() }}</div>
                <div class="stat-label">Refusés</div>
            </div>
        </div>

        <!-- Tableau des rendez-vous -->
        @if($mesRendezVous->count() > 0)
            <div class="rdv-table">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th style="width: 15%;"><i class="fas fa-user me-1"></i>Client</th>
                            <th style="width: 15%;"><i class="fas fa-paw me-1"></i>Animal</th>
                            <th style="width: 20%;"><i class="fas fa-tag me-1"></i>Type</th>
                            <th style="width: 18%;"><i class="fas fa-clock me-1"></i>Date & Heure</th>
                            <th class="etat-column"><i class="fas fa-info-circle me-1"></i>État</th>
                            <th style="width: 22%;"><i class="fas fa-cogs me-1"></i>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mesRendezVous as $r)
                            <tr>
                                <td>
                                    <div class="client-info">
                                        <i class="fas fa-user-circle me-1"></i>{{ $r->user->name }}
                                    </div>
                                </td>
                                <td>
                                    <div class="animal-info">
                                        <i class="fas fa-paw me-1"></i>{{ $r->animal->nom }}
                                    </div>
                                </td>
                                <td>
                                    @if($r->soins->count())
                                        <span class="type-badge type-soins">
                                            <i class="fas fa-hand-holding-medical me-1"></i>Soins
                                        </span>
                                        <br>
                                        <small class="text-muted">
                                            {{ $r->soins->first()->nom }}
                                        </small>
                                    @elseif($r->vaccins->count())
                                        <span class="type-badge type-vaccin">
                                            <i class="fas fa-syringe me-1"></i>Vaccin
                                        </span>
                                        <br>
                                        <small class="text-muted">
                                            {{ $r->vaccins->first()->nom }}
                                        </small>
                                    @endif
                                </td>
                                <td>
                                    <div class="date-time">
                                        <i class="fas fa-calendar me-1"></i>{{ \Carbon\Carbon::parse($r->date)->format('d/m/Y') }}
                                        @if($r->heure)
                                            <br><i class="fas fa-clock me-1"></i>{{ $r->heure }}
                                        @endif
                                        @if(\Carbon\Carbon::parse($r->date)->isToday())
                                            <span class="urgent-badge">Aujourd'hui</span>
                                        @elseif(\Carbon\Carbon::parse($r->date)->isTomorrow())
                                            <span class="urgent-badge" style="background:linear-gradient(135deg, #ffc107, #ffb300);">Demain</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="etat-content">
                                        @php
                                            $etatClass = match($r->etat) {
                                                'en attente' => 'etat-attente',
                                                'accepté' => 'etat-accepte',
                                                'refusé' => 'etat-refuse',
                                                'refuse' => 'etat-refuse',
                                                default => 'etat-attente'
                                            };
                                        @endphp
                                        <span class="etat-badge {{ $etatClass }}">
                                            <i class="fas 
                                                @if($r->etat == 'en attente') fa-clock 
                                                @elseif($r->etat == 'accepté') fa-check-circle 
                                                @elseif($r->etat == 'refuse' || $r->etat == 'refusé') fa-times-circle 
                                                @endif me-1">
                                            </i>
                                            {{ ucfirst($r->etat) }}
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('vet.rendezvous.show', $r->id) }}" class="btn-details">
                                            <i class="fas fa-eye me-1"></i>Détails
                                        </a>

                                        @if($r->etat == 'en attente')
                                            <form action="{{ route('vet.rendezvous.accept', $r->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn-accept" 
                                                        onclick="return confirm('Confirmez-vous l\\'acceptation de ce rendez-vous ?')">
                                                    <i class="fas fa-check me-1"></i>Accepter
                                                </button>
                                            </form>

                                            <!-- Bouton pour ouvrir le formulaire de refus -->
                                            <button type="button" class="btn-refuse" 
                                                    onclick="toggleRefuseForm({{ $r->id }})">
                                                <i class="fas fa-times me-1"></i>Refuser
                                            </button>
                                        @endif
                                    </div>

                                    <!-- Formulaire Refuser (caché par défaut) -->
                                    @if($r->etat == 'en attente')
                                        <div id="refuse-form-{{ $r->id }}" class="refuse-form" style="display: none;">
                                            <form action="{{ route('vet.rendezvous.refuse', $r->id) }}" method="POST">
                                                @csrf
                                                <small class="d-block mb-2 text-danger">
                                                    <i class="fas fa-info-circle me-1"></i>
                                                    Proposez une nouvelle date au client :
                                                </small>
                                                <div class="d-flex flex-wrap gap-2 align-items-center">
                                                    <input type="date" name="date" required 
                                                           min="{{ date('Y-m-d') }}"
                                                           class="form-control-sm">
                                                    <input type="time" name="heure" required 
                                                           class="form-control-sm">
                                                    <button type="submit" class="btn-refuse btn-sm">
                                                        <i class="fas fa-paper-plane me-1"></i>Envoyer
                                                    </button>
                                                    <button type="button" class="btn btn-secondary btn-sm" 
                                                            onclick="toggleRefuseForm({{ $r->id }})">
                                                        <i class="fas fa-times me-1"></i>Annuler
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <!-- État vide -->
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="fas fa-calendar-times"></i>
                </div>
                <h3 class="empty-state-title">Aucun rendez-vous pour le moment</h3>
                <p class="empty-state-text">Les rendez-vous qui vous sont assignés apparaîtront ici</p>
            </div>
        @endif
    </div>
</div>

<script>
    function toggleRefuseForm(rdvId) {
        const form = document.getElementById(`refuse-form-${rdvId}`);
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Animation des cartes de statistiques
        const statCards = document.querySelectorAll('.stat-card');
        statCards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.2}s`;
        });
        
        // Définir la date minimale pour les champs date
        const dateInputs = document.querySelectorAll('input[type="date"]');
        const today = new Date().toISOString().split('T')[0];
        dateInputs.forEach(input => {
            input.min = today;
        });
        
        // Confirmation pour l'acceptation
        const acceptForms = document.querySelectorAll('form[action*="accept"]');
        acceptForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Êtes-vous sûr de vouloir accepter ce rendez-vous ?')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@endsection