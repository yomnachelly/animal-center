@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <style>
        .animals-container {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .page-header {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(40, 167, 69, 0.3);
        }
        
        .page-title {
            font-weight: 700;
            margin: 0;
            font-size: 2.2rem;
        }
        
        .btn-primary-custom {
            background: white;
            color: #28a745;
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 255, 255, 0.2);
        }
        
        .btn-primary-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(255, 255, 255, 0.3);
            background: #f8f9fa;
            color: #28a745;
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
        
        .animals-table {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        
        .animals-table thead {
            background: linear-gradient(135deg, #28a745, #20c997);
        }
        
        .animals-table thead th {
            border: none;
            padding: 20px 15px;
            font-weight: 600;
            color: white;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .animals-table tbody tr {
            transition: all 0.3s ease;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .animals-table tbody tr:hover {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            transform: translateX(5px);
        }
        
        .animals-table tbody td {
            border: none;
            padding: 20px 15px;
            vertical-align: middle;
            font-size: 0.95rem;
        }
        
        .animal-name {
            font-weight: 600;
            color: #28a745;
            display: flex;
            align-items: center;
        }
        
        .animal-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            margin-right: 12px;
            font-size: 1.1rem;
            overflow: hidden;
        }
        
        .animal-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .species-badge {
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            background: linear-gradient(135deg, #17a2b8, #138496);
            color: white;
            display: inline-block;
            min-width: 80px;
            text-align: center;
        }
        
        .race-text {
            color: #495057;
            font-weight: 500;
            font-size: 0.95rem;
            padding: 8px 0;
            min-height: 40px;
            display: flex;
            align-items: center;
        }
        
        .sexe-badge {
            padding: 8px 15px;
            border-radius: 15px;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            display: inline-block;
            min-width: 80px;
            text-align: center;
        }
        
        .sexe-male {
            background: linear-gradient(135deg, #17a2b8, #138496);
            color: white;
        }
        
        .sexe-femelle {
            background: linear-gradient(135deg, #e83e8c, #d91a72);
            color: white;
        }
        
        .age-badge {
            background: linear-gradient(135deg, #ffc107, #ffb300);
            color: #212529;
            padding: 8px 15px;
            border-radius: 15px;
            font-weight: 600;
            font-size: 0.85rem;
            display: inline-block;
            min-width: 70px;
            text-align: center;
        }
        
        .health-status {
            padding: 8px 15px;
            border-radius: 15px;
            font-weight: 600;
            font-size: 0.85rem;
            display: inline-block;
            min-width: 100px;
            text-align: center;
        }
        
        .health-good {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
        }
        
        .health-fair {
            background: linear-gradient(135deg, #ffc107, #ffb300);
            color: #212529;
        }
        
        .health-poor {
            background: linear-gradient(135deg, #dc3545, #e35d6a);
            color: white;
        }
        
        .status-badge {
            padding: 8px 15px;
            border-radius: 15px;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            display: inline-block;
            min-width: 100px;
            text-align: center;
        }
        
        .status-adopted {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
        }
        
        .status-available {
            background: linear-gradient(135deg, #17a2b8, #138496);
            color: white;
        }
        
        .status-pending {
            background: linear-gradient(135deg, #ffc107, #ffb300);
            color: #212529;
        }
        
        .status-hosted {
            background: linear-gradient(135deg, #6f42c1, #8e44ad);
            color: white;
        }
        
        .action-buttons {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }
        
        .btn-edit {
            background: linear-gradient(135deg, #ffc107, #ffb300);
            border: none;
            color: #212529;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            min-width: 90px;
            justify-content: center;
        }
        
        .btn-edit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 193, 7, 0.4);
            color: #212529;
        }
        
        .btn-delete {
            background: linear-gradient(135deg, #dc3545, #e35d6a);
            border: none;
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            min-width: 90px;
            justify-content: center;
        }
        
        .btn-delete:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.4);
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
            color: #28a745;
            margin-bottom: 5px;
        }
        
        .stat-label {
            color: #6c757d;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.8rem;
        }
        
        .filter-section {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 25px;
        }
        
        .filter-title {
            color: #495057;
            font-weight: 600;
            margin-bottom: 15px;
            font-size: 1.1rem;
        }
        
        .photo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80px;
        }
        
        .photo-container img {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }
        
        @media (max-width: 1200px) {
            .animals-table {
                overflow-x: auto;
            }
            
            .animals-table table {
                min-width: 1100px;
            }
        }
        
        @media (max-width: 768px) {
            .page-header {
                padding: 20px;
                text-align: center;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .animals-table thead th,
            .animals-table tbody td {
                padding: 15px 10px;
                font-size: 0.85rem;
            }
            
            .animals-table {
                font-size: 0.9rem;
            }
            
            .animal-avatar {
                width: 40px;
                height: 40px;
                font-size: 0.9rem;
                margin-right: 8px;
            }
            
            .species-badge,
            .sexe-badge,
            .age-badge,
            .health-status,
            .status-badge {
                min-width: 70px;
                padding: 6px 10px;
                font-size: 0.8rem;
            }
            
            .btn-edit,
            .btn-delete {
                min-width: 80px;
                padding: 6px 12px;
            }
        }
    </style>

    <div class="animals-container">
        <!-- En-tête de page -->
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h1 class="page-title">
                        <i class="fas fa-paw me-2"></i>🐾 Gestion des Animaux
                    </h1>
                    <p class="mb-0 mt-2 opacity-75">Gérez tous les animaux de votre refuge</p>
                </div>
                <a href="{{ route('animaux.create') }}" class="btn btn-primary-custom">
                    <i class="fas fa-plus me-2"></i>Ajouter un Animal
                </a>
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
                $totalAnimaux = $animaux->count();
                $adoptedCount = $animaux->where('statut', 'adopté')->count();
                $availableCount = $animaux->where('statut', 'adopter')->count();
                $hostedCount = $animaux->where('statut', 'hébergé')->count();
            @endphp
            <div class="stat-card">
                <div class="stat-number">{{ $totalAnimaux }}</div>
                <div class="stat-label">Total Animaux</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $adoptedCount }}</div>
                <div class="stat-label">Adoptés</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $availableCount }}</div>
                <div class="stat-label">Adoptables</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $hostedCount }}</div>
                <div class="stat-label">Hébergés</div>
            </div>
        </div>

        <!-- Tableau des animaux -->
        @if($animaux->count() > 0)
            <div class="animals-table">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th style="width: 18%;">Animal</th>
                            <th style="width: 12%;">Espèce</th>
                            <th style="width: 14%;">Race</th>
                            <th style="width: 10%;">Sexe</th>
                            <th style="width: 10%;">Âge</th>
                            <th style="width: 12%;">État santé</th>
                            <th style="width: 12%;">Statut</th>
                            <th style="width: 12%;">Photo</th>
                            <th style="width: 12%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($animaux as $animal)
                            <tr>
                                <td>
                                    <div class="animal-name">
                                        <div class="animal-avatar">
                                            @if($animal->photo)
                                                <img src="{{ asset('storage/'.$animal->photo) }}" alt="{{ $animal->nom }}">
                                            @else
                                                {{ strtoupper(substr($animal->nom, 0, 1)) }}
                                            @endif
                                        </div>
                                        {{ $animal->nom }}
                                    </div>
                                </td>
                                <td>
                                    <span class="species-badge">
                                        <i class="fas 
                                            @if($animal->espece->nom == 'Chien') fa-dog 
                                            @elseif($animal->espece->nom == 'Chat') fa-cat 
                                            @else fa-paw 
                                            @endif me-1">
                                        </i>
                                        {{ $animal->espece->nom }}
                                    </span>
                                </td>
                                <td>
                                    <div class="race-text">
                                        {{ $animal->race ? $animal->race->nom : 'Aucune' }}
                                    </div>
                                </td>
                                <td>
                                    <span class="sexe-badge {{ $animal->sexe === 'Mâle' ? 'sexe-male' : 'sexe-femelle' }}">
                                        <i class="fas {{ $animal->sexe === 'Mâle' ? 'fa-mars' : 'fa-venus' }} me-1"></i>
                                        {{ $animal->sexe }}
                                    </span>
                                </td>
                                <td>
                                    <span class="age-badge">
                                        <i class="fas fa-birthday-cake me-1"></i>
                                        {{ $animal->age }}
                                    </span>
                                </td>
                                <td>
                                    @php
                                        $healthClass = match($animal->etat_sante) {
                                            'Bon', 'Excellent' => 'health-good',
                                            'Moyen', 'Satisfaisant' => 'health-fair',
                                            'Mauvais', 'Critique' => 'health-poor',
                                            default => 'health-fair'
                                        };
                                    @endphp
                                    <span class="health-status {{ $healthClass }}">
                                        <i class="fas fa-heartbeat me-1"></i>
                                        {{ $animal->etat_sante }}
                                    </span>
                                </td>
                                <td>
                                    @php
                                        $statusClass = match($animal->statut) {
                                            'adopté' => 'status-adopted',
                                            'disponible' => 'status-available',
                                            'en attente' => 'status-pending',
                                            'hébergé' => 'status-hosted',
                                            default => 'status-available'
                                        };
                                        
                                        $statusIcon = match($animal->statut) {
                                            'adopté' => 'fa-check-circle',
                                            'disponible' => 'fa-home',
                                            'en attente' => 'fa-clock',
                                            'hébergé' => 'fa-hotel',
                                            default => 'fa-home'
                                        };
                                    @endphp
                                    <span class="status-badge {{ $statusClass }}">
                                        <i class="fas {{ $statusIcon }} me-1"></i>
                                        {{ $animal->statut }}
                                    </span>
                                </td>
                                <td>
                                    <div class="photo-container">
                                        @if($animal->photo)
                                            <img src="{{ asset('storage/'.$animal->photo) }}" 
                                                 alt="Photo de {{ $animal->nom }}">
                                        @else
                                            <div class="text-center text-muted">
                                                <i class="fas fa-camera fa-lg mb-1"></i>
                                                <div class="small">Aucune photo</div>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('animaux.edit', $animal) }}" class="btn-edit">
                                            <i class="fas fa-edit me-1"></i>Modifier
                                        </a>

                                        <form action="{{ route('animaux.destroy', $animal) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn-delete"
                                                    onclick="return confirm('Voulez-vous vraiment supprimer {{ $animal->nom }} ? Cette action est irréversible.')">
                                                <i class="fas fa-trash me-1"></i>Supprimer
                                            </button>
                                        </form>
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
                    <i class="fas fa-paw"></i>
                </div>
                <h3 class="empty-state-title">Aucun animal trouvé</h3>
                <p class="empty-state-text">
                    Commencez par ajouter le premier animal à votre refuge.
                </p>
                <a href="{{ route('animaux.create') }}" class="btn btn-primary-custom">
                    <i class="fas fa-plus me-2"></i>Ajouter le premier animal
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
            card.style.animationDelay = `${index * 0.2}s`;
        });
        
        // Confirmation améliorée pour la suppression
        const deleteForms = document.querySelectorAll('form[action*="destroy"]');
        
        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                const animalName = this.closest('tr').querySelector('.animal-name').textContent.trim();
                if (!confirm(`Êtes-vous sûr de vouloir supprimer "${animalName}" ?\n\nCette action est irréversible et toutes les données associées seront perdues.`)) {
                    e.preventDefault();
                }
            });
        });
        
        // Effet de pulse sur les avatars
        const animalAvatars = document.querySelectorAll('.animal-avatar');
        animalAvatars.forEach((avatar, index) => {
            avatar.style.animationDelay = `${index * 0.1}s`;
        });
    });
</script>
@endsection