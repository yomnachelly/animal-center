@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <style>
        .demandes-container {
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
        
        .alert-success-custom {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            border: none;
            border-left: 5px solid #28a745;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.2);
        }
        
        .demandes-table {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        
        .demandes-table thead {
            background: linear-gradient(135deg, #ff6b35, #ff8e53);
        }
        
        .demandes-table thead th {
            border: none;
            padding: 20px 15px;
            font-weight: 600;
            color: white;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .demandes-table tbody tr {
            transition: all 0.3s ease;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .demandes-table tbody tr:hover {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            transform: translateX(5px);
        }
        
        .demandes-table tbody td {
            border: none;
            padding: 20px 15px;
            vertical-align: middle;
            font-size: 0.95rem;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            font-weight: 600;
            color: #495057;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #ff6b35, #ff8e53);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            margin-right: 12px;
            font-size: 1rem;
        }
        
        .animal-info {
            display: flex;
            align-items: center;
            font-weight: 500;
            color: #28a745;
        }
        
        .animal-icon {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            font-size: 0.9rem;
        }
        
        .type-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .type-adoption {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
        }
        
        .type-hebergement {
            background: linear-gradient(135deg, #17a2b8, #138496);
            color: white;
        }
        
        .type-demande {
            background: linear-gradient(135deg, #6c757d, #868e96);
            color: white;
        }
        
        .etat-badge {
            padding: 6px 12px;
            border-radius: 15px;
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
        }
        
        .etat-en_attente {
            background: linear-gradient(135deg, #ffc107, #ffb300);
            color: #212529;
        }
        
        .etat-accepte {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
        }
        
        .etat-rejete {
            background: linear-gradient(135deg, #dc3545, #e35d6a);
            color: white;
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
            padding: 6px 15px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
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
            padding: 6px 15px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
        }
        
        .btn-accept:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.4);
        }
        
        .btn-reject {
            background: linear-gradient(135deg, #dc3545, #e35d6a);
            border: none;
            color: white;
            padding: 6px 15px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
        }
        
        .btn-reject:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.4);
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
            cursor: pointer;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
        
        .stat-card.active {
            border: 3px solid #ff6b35;
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(255, 107, 53, 0.3);
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #ff6b35;
            margin-bottom: 5px;
        }
        
        .stat-label {
            color: #6c757d;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.8rem;
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
        
        .filters-container {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }
        
        .filter-title {
            font-weight: 600;
            color: #495057;
            margin-bottom: 15px;
            font-size: 1.1rem;
        }
        
        .filter-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        
        .filter-btn {
            padding: 8px 20px;
            border-radius: 25px;
            border: 2px solid #e9ecef;
            background: white;
            color: #6c757d;
            font-weight: 500;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .filter-btn:hover {
            border-color: #ff6b35;
            color: #ff6b35;
        }
        
        .filter-btn.active {
            background: linear-gradient(135deg, #ff6b35, #ff8e53);
            border-color: #ff6b35;
            color: white;
        }
        
        .reset-filters {
            background: linear-gradient(135deg, #6c757d, #868e96);
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .reset-filters:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108, 117, 125, 0.4);
        }
        
        @media (max-width: 768px) {
            .page-header {
                padding: 20px;
                text-align: center;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .demandes-table thead th,
            .demandes-table tbody td {
                padding: 15px 8px;
                font-size: 0.85rem;
            }
            
            .filter-buttons {
                flex-direction: column;
            }
            
            .filter-btn, .reset-filters {
                width: 100%;
                text-align: center;
            }
        }
    </style>

    <div class="demandes-container">
        <!-- En-tête de page -->
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h1 class="page-title">
                        <i class="fas fa-clipboard-list me-2"></i>📋 Gestion des Demandes
                    </h1>
                    <p class="mb-0 mt-2 opacity-75">Gérez toutes les demandes d'adoption et d'hébergement</p>
                </div>
            </div>
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

        <!-- Cartes de statistiques -->
        <div class="stats-cards">
            @php
                $totalDemandes = $demandes->count();
                $adoptionCount = $demandes->where('type', 'adoption')->count();
                $hebergementCount = $demandes->where('type', 'hebergement')->count();
                $enAttenteCount = $demandes->where('etat', 'en attente')->count();
                $accepteCount = $demandes->where('etat', 'accepte')->count();
                $rejeteCount = $demandes->where('etat', 'rejete')->count();
            @endphp
            <div class="stat-card" data-filter="all">
                <div class="stat-number">{{ $totalDemandes }}</div>
                <div class="stat-label">Total Demandes</div>
            </div>
            <div class="stat-card" data-filter="type-adoption">
                <div class="stat-number">{{ $adoptionCount }}</div>
                <div class="stat-label">Adoptions</div>
            </div>
            <div class="stat-card" data-filter="type-hebergement">
                <div class="stat-number">{{ $hebergementCount }}</div>
                <div class="stat-label">Hébergements</div>
            </div>
            <div class="stat-card" data-filter="etat-en_attente">
                <div class="stat-number">{{ $enAttenteCount }}</div>
                <div class="stat-label">En Attente</div>
            </div>
            <div class="stat-card" data-filter="etat-accepte">
                <div class="stat-number">{{ $accepteCount }}</div>
                <div class="stat-label">Acceptées</div>
            </div>
            <div class="stat-card" data-filter="etat-rejete">
                <div class="stat-number">{{ $rejeteCount }}</div>
                <div class="stat-label">Rejetées</div>
            </div>
        </div>

        <!-- Filtres -->
        <div class="filters-container">
            <h5 class="filter-title">Filtrer les demandes :</h5>
            <div class="filter-buttons">
                <button class="filter-btn active" data-filter="all">Toutes les demandes</button>
                <button class="filter-btn" data-filter="type-adoption">Adoptions</button>
                <button class="filter-btn" data-filter="type-hebergement">Hébergements</button>
                <button class="filter-btn" data-filter="etat-en_attente">En attente</button>
                <button class="filter-btn" data-filter="etat-accepte">Acceptées</button>
                <button class="filter-btn" data-filter="etat-rejete">Rejetées</button>
                <button class="reset-filters">Réinitialiser</button>
            </div>
        </div>

        <!-- Tableau des demandes -->
        @if($demandes->count() > 0)
            <div class="demandes-table">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th style="width: 20%;">Utilisateur</th>
                            <th style="width: 20%;">Animal</th>
                            <th style="width: 22%;">Type</th>
                            <th style="width: 15%;">État</th>
                            <th style="width: 30%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="demandes-list">
                        @foreach($demandes as $demande)
                            <tr class="demande-item" 
                                data-type="type-{{ $demande->type }}" 
                                data-etat="etat-{{ str_replace(' ', '_', $demande->etat) }}">
                                <td>
                                    <div class="user-info">
                                        <div class="user-avatar">
                                            {{ strtoupper(substr($demande->user->name, 0, 1)) }}
                                        </div>
                                        {{ $demande->user->name }}
                                    </div>
                                </td>
                                <td>
                                    <div class="animal-info">
                                        <div class="animal-icon">
                                            <i class="fas fa-paw"></i>
                                        </div>
                                        {{ $demande->animal->nom }}
                                    </div>
                                </td>
                                <td>
                                    @php
                                        $typeClass = match($demande->type) {
                                            'adoption' => 'type-adoption',
                                            'hebergement' => 'type-hebergement',
                                            default => 'type-demande'
                                        };
                                        $typeIcon = match($demande->type) {
                                            'adoption' => 'fa-home',
                                            'hebergement' => 'fa-hotel',
                                            default => 'fa-file-alt'
                                        };
                                    @endphp
                                    <span class="type-badge {{ $typeClass }}">
                                        <i class="fas {{ $typeIcon }} me-1"></i>
                                        {{ ucfirst($demande->type) }}
                                    </span>
                                </td>
                                <td>
                                    @php
                                        $etatClass = match($demande->etat) {
                                            'en attente' => 'etat-en_attente',
                                            'accepte' => 'etat-accepte',
                                            'rejete' => 'etat-rejete',
                                            default => 'etat-en_attente'
                                        };
                                        $etatIcon = match($demande->etat) {
                                            'en attente' => 'fa-clock',
                                            'accepte' => 'fa-check',
                                            'rejete' => 'fa-times',
                                            default => 'fa-clock'
                                        };
                                    @endphp
                                    <span class="etat-badge {{ $etatClass }}">
                                        <i class="fas {{ $etatIcon }} me-1"></i>
                                        {{ ucfirst($demande->etat) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.demandes.details', $demande->id) }}" class="btn-details">
                                            <i class="fas fa-eye me-1"></i>Détails
                                        </a>

                                        @if($demande->etat === 'en attente')
                                            <form action="{{ route('admin.demandes.accepter', $demande->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn-accept"
                                                        onclick="return confirm('Êtes-vous sûr de vouloir accepter cette demande ?')">
                                                    <i class="fas fa-check me-1"></i>Accepter
                                                </button>
                                            </form>

                                            <form action="{{ route('admin.demandes.rejeter', $demande->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn-reject"
                                                        onclick="return confirm('Êtes-vous sûr de vouloir rejeter cette demande ?')">
                                                    <i class="fas fa-times me-1"></i>Rejeter
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-muted small">Action traitée</span>
                                        @endif
                                    </div>
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
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <h3 class="empty-state-title">Aucune demande trouvée</h3>
                <p class="empty-state-text">
                    Aucune demande n'a été soumise pour le moment.
                </p>
            </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animation des cartes de statistiques
        const statCards = document.querySelectorAll('.stat-card');
        statCards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.2}s`;
        });
        
        // Effet de pulse sur les avatars
        const userAvatars = document.querySelectorAll('.user-avatar');
        userAvatars.forEach((avatar, index) => {
            avatar.style.animationDelay = `${index * 0.1}s`;
        });

        // Système de filtrage
        const filterButtons = document.querySelectorAll('.filter-btn');
        const statCardsFilter = document.querySelectorAll('.stat-card');
        const resetButton = document.querySelector('.reset-filters');
        const demandeItems = document.querySelectorAll('.demande-item');
        
        // Fonction pour appliquer le filtre
        function applyFilter(filter) {
            console.log('Applying filter:', filter);
            
            // Mettre à jour les boutons de filtre
            filterButtons.forEach(btn => {
                if (btn.dataset.filter === filter) {
                    btn.classList.add('active');
                } else {
                    btn.classList.remove('active');
                }
            });
            
            // Mettre à jour les cartes de statistiques
            statCardsFilter.forEach(card => {
                if (filter === 'all' || card.dataset.filter === filter) {
                    card.classList.add('active');
                } else {
                    card.classList.remove('active');
                }
            });
            
            // Filtrer les demandes
            let visibleCount = 0;
            demandeItems.forEach(item => {
                if (filter === 'all' || 
                    item.classList.contains(filter) || 
                    item.getAttribute('data-type') === filter || 
                    item.getAttribute('data-etat') === filter) {
                    item.style.display = '';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });
            
            console.log('Visible items:', visibleCount);
            
            // Afficher/cacher le message "Aucun résultat"
            const existingNoResults = document.querySelector('.no-results-message');
            if (existingNoResults) {
                existingNoResults.remove();
            }
            
            if (visibleCount === 0 && demandeItems.length > 0) {
                const noResults = document.createElement('tr');
                noResults.className = 'no-results-message';
                noResults.innerHTML = `
                    <td colspan="5" style="text-align: center; padding: 40px;">
                        <div style="color: #6c757d;">
                            <i class="fas fa-search" style="font-size: 3rem; margin-bottom: 15px;"></i>
                            <h4 style="margin-bottom: 10px;">Aucune demande trouvée</h4>
                            <p>Aucune demande ne correspond aux critères de filtrage sélectionnés.</p>
                        </div>
                    </td>
                `;
                document.querySelector('#demandes-list').appendChild(noResults);
            }
        }
        
        // Événements pour les boutons de filtre
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                const filter = this.dataset.filter;
                applyFilter(filter);
            });
        });
        
        // Événements pour les cartes de statistiques
        statCardsFilter.forEach(card => {
            card.addEventListener('click', function() {
                const filter = this.dataset.filter;
                applyFilter(filter);
            });
        });
        
        // Événement pour le bouton de réinitialisation
        resetButton.addEventListener('click', function() {
            applyFilter('all');
        });
        
        // Appliquer le filtre par défaut (toutes les demandes)
        applyFilter('all');
    });
</script>
@endsection