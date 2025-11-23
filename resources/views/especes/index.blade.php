@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    <style>
        .species-container {
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
        
        .stats-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            border-left: 5px solid #667eea;
            margin-bottom: 25px;
            transition: all 0.3s ease;
        }
        
        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
        }
        
        .stats-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: #667eea;
            margin: 0;
        }
        
        .stats-label {
            color: #6c757d;
            font-weight: 600;
            margin: 5px 0 0 0;
        }
        
        .species-card {
            background: white;
            border-radius: 15px;
            padding: 0;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 25px;
            border: none;
            transition: all 0.3s ease;
        }
        
        .species-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }
        
        .species-header {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            padding: 20px 25px;
            border-radius: 15px 15px 0 0;
        }
        
        .species-name {
            font-weight: 700;
            font-size: 1.4rem;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .species-id {
            background: rgba(255, 255, 255, 0.2);
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
        }
        
        .species-body {
            padding: 25px;
        }
        
        .species-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e9ecef;
        }
        
        .meta-item {
            text-align: center;
            flex: 1;
        }
        
        .meta-number {
            font-size: 1.5rem;
            font-weight: 700;
            color: #667eea;
            margin: 0;
        }
        
        .meta-label {
            font-size: 0.8rem;
            color: #6c757d;
            margin: 5px 0 0 0;
        }
        
        .species-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        
        .btn-primary-custom {
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
        
        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
            color: white;
        }
        
        .btn-danger-custom {
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
        
        .btn-danger-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(245, 87, 108, 0.4);
            color: white;
        }
        
        .btn-success-custom {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            border: none;
            color: white;
            padding: 15px 30px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 5px 15px rgba(79, 172, 254, 0.3);
        }
        
        .btn-success-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(79, 172, 254, 0.4);
            color: white;
        }
        
        .alert-custom {
            border: none;
            border-radius: 15px;
            padding: 20px 25px;
            font-weight: 600;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            border-left: 5px solid #28a745;
        }
        
        .empty-state {
            text-align: center;
            padding: 60px 30px;
            color: #6c757d;
        }
        
        .empty-state i {
            font-size: 4rem;
            margin-bottom: 20px;
            color: #dee2e6;
        }
        
        .empty-state h3 {
            color: #6c757d;
            margin-bottom: 15px;
        }
        
        .search-box {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 25px;
        }
        
        .search-input {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 12px 20px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }
        
        .search-input:focus {
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.1);
        }
        
        .view-toggle {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }
        
        .view-btn {
            background: white;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 10px 20px;
            font-weight: 600;
            color: #6c757d;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .view-btn.active {
            background: #667eea;
            border-color: #667eea;
            color: white;
        }
        
        .table-custom {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }
        
        .table-custom thead th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 20px;
            font-weight: 600;
        }
        
        .table-custom tbody td {
            padding: 20px;
            border-color: #f8f9fa;
            vertical-align: middle;
        }
        
        .table-custom tbody tr {
            transition: all 0.3s ease;
        }
        
        .table-custom tbody tr:hover {
            background: #f8f9fa;
            transform: scale(1.01);
        }
        
        .species-badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.8rem;
        }
        
        .animal-count {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            padding: 3px 10px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .race-count {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            padding: 3px 10px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        @media (max-width: 768px) {
            .page-title {
                font-size: 2rem;
            }
            
            .species-actions {
                flex-direction: column;
            }
            
            .btn-primary-custom,
            .btn-danger-custom {
                width: 100%;
                justify-content: center;
            }
            
            .view-toggle {
                flex-direction: column;
            }
            
            .species-meta {
                flex-direction: column;
                gap: 15px;
            }
        }
        
        .floating-animation {
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .grid-view {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
        }
        
        .list-view {
            display: none;
        }
        
        .icon-animal {
            font-size: 1.2rem;
            margin-right: 8px;
        }
    </style>

    <div class="species-container">
        <!-- En-tête de page -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="page-title">
                        <i class="fas fa-paw floating-animation"></i>
                        Gestion des Espèces
                    </h1>
                    <p class="page-subtitle">
                        Gérez et organisez les différentes espèces animales du refuge
                    </p>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="{{ route('especes.create') }}" class="btn btn-success-custom">
                        <i class="fas fa-plus-circle"></i>
                        Nouvelle Espèce
                    </a>
                </div>
            </div>
        </div>

        <!-- Statistiques globales -->
        <div class="row">
            <div class="col-md-4">
                <div class="stats-card">
                    <h3 class="stats-number">{{ $especes->count() }}</h3>
                    <p class="stats-label">Espèces enregistrées</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card">
                    <h3 class="stats-number">{{ $totalAnimaux }}</h3>
                    <p class="stats-label">Animaux associés</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card">
                    <h3 class="stats-number">{{ $especesAvecRaces }}</h3>
                    <p class="stats-label">Espèces avec races</p>
                </div>
            </div>
        </div>

        <!-- Barre de recherche et filtres -->
        <div class="search-box">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <input type="text" id="searchInput" class="form-control search-input" 
                           placeholder="Rechercher une espèce...">
                </div>
                <div class="col-md-6 text-end">
                    <div class="view-toggle">
                        <button class="view-btn active" data-view="grid">
                            <i class="fas fa-th-large"></i> Grille
                        </button>
                        <button class="view-btn" data-view="list">
                            <i class="fas fa-list"></i> Liste
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Message de succès -->
        @if(session('success'))
        <div class="alert alert-custom alert-success">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-3" style="font-size: 1.5rem;"></i>
                <div>
                    <h5 class="mb-1">Succès !</h5>
                    <p class="mb-0">{{ session('success') }}</p>
                </div>
            </div>
        </div>
        @endif

        <!-- Vue en grille -->
        <div class="grid-view" id="gridView">
            @forelse($especes as $espece)
            <div class="species-card" data-species-name="{{ strtolower($espece->nom) }}">
                <div class="species-header">
                    <h3 class="species-name">
                        <i class="fas 
                            @if(str_contains(strtolower($espece->nom), 'chien')) fa-dog 
                            @elseif(str_contains(strtolower($espece->nom), 'chat')) fa-cat 
                            @elseif(str_contains(strtolower($espece->nom), 'oiseau')) fa-dove 
                            @elseif(str_contains(strtolower($espece->nom), 'lapin')) fa-paw 
                            @else fa-paw @endif
                        "></i>
                        {{ $espece->nom }}
                        <span class="species-id">#{{ $espece->id }}</span>
                    </h3>
                </div>
                <div class="species-body">
                    <div class="species-meta">
                        <div class="meta-item">
                            <p class="meta-number">{{ $espece->animaux_count }}</p>
                            <p class="meta-label">Animaux</p>
                        </div>
                        <div class="meta-item">
                            <p class="meta-number">{{ $espece->races_count }}</p>
                            <p class="meta-label">Races</p>
                        </div>
                        <div class="meta-item">
                            <p class="meta-number">
                                @if($espece->created_at)
                                    {{ $espece->created_at->format('d/m/Y') }}
                                @else
                                    -
                                @endif
                            </p>
                            <p class="meta-label">Créé le</p>
                        </div>
                    </div>
                    <div class="species-actions">
                        <a href="{{ route('especes.edit', $espece) }}" class="btn btn-primary-custom">
                            <i class="fas fa-edit"></i>
                            Modifier
                        </a>
                        <a href="{{ route('races.index', ['espece_id' => $espece->id]) }}" class="btn btn-primary-custom" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                            <i class="fas fa-list"></i>
                            Races
                        </a>
                        <form action="{{ route('especes.destroy', $espece) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger-custom" 
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer l\\'espèce {{ $espece->nom }} ?')">
                                <i class="fas fa-trash"></i>
                                Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="empty-state">
                    <i class="fas fa-paw"></i>
                    <h3>Aucune espèce enregistrée</h3>
                    <p class="mb-4">Commencez par ajouter votre première espèce animale</p>
                    <a href="{{ route('especes.create') }}" class="btn btn-success-custom">
                        <i class="fas fa-plus-circle"></i>
                        Ajouter une espèce
                    </a>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Vue en liste (tableau) -->
        <div class="list-view" id="listView">
            <div class="table-responsive">
                <table class="table table-custom">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Animaux</th>
                            <th>Races</th>
                            <th>Date de création</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($especes as $espece)
                        <tr data-species-name="{{ strtolower($espece->nom) }}">
                            <td>
                                <span class="species-badge">#{{ $espece->id }}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="fas 
                                        @if(str_contains(strtolower($espece->nom), 'chien')) fa-dog 
                                        @elseif(str_contains(strtolower($espece->nom), 'chat')) fa-cat 
                                        @elseif(str_contains(strtolower($espece->nom), 'oiseau')) fa-dove 
                                        @elseif(str_contains(strtolower($espece->nom), 'lapin')) fa-paw 
                                        @else fa-paw @endif
                                        icon-animal">
                                    </i>
                                    <strong>{{ $espece->nom }}</strong>
                                </div>
                            </td>
                            <td>
                                <span class="animal-count">{{ $espece->animaux_count }}</span>
                            </td>
                            <td>
                                <span class="race-count">{{ $espece->races_count }}</span>
                            </td>
                            <td>
                                <span class="text-muted">
                                    @if($espece->created_at)
                                        {{ $espece->created_at->format('d/m/Y') }}
                                    @else
                                        Non disponible
                                    @endif
                                </span>
                            </td>
                            <td>
                                <div class="species-actions">
                                    <a href="{{ route('especes.edit', $espece) }}" class="btn btn-primary-custom btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('races.index', ['espece_id' => $espece->id]) }}" class="btn btn-primary-custom btn-sm" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                                        <i class="fas fa-list"></i>
                                    </a>
                                    <form action="{{ route('especes.destroy', $espece) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger-custom btn-sm" 
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer l\\'espèce {{ $espece->nom }} ?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="empty-state">
                                    <i class="fas fa-paw"></i>
                                    <h3>Aucune espèce enregistrée</h3>
                                    <a href="{{ route('especes.create') }}" class="btn btn-success-custom mt-3">
                                        <i class="fas fa-plus-circle"></i>
                                        Ajouter une espèce
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gestion du changement de vue
    const viewButtons = document.querySelectorAll('.view-btn');
    const gridView = document.getElementById('gridView');
    const listView = document.getElementById('listView');
    
    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            const viewType = this.getAttribute('data-view');
            
            // Mettre à jour les boutons actifs
            viewButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            // Afficher la vue sélectionnée
            if (viewType === 'grid') {
                gridView.style.display = 'grid';
                listView.style.display = 'none';
            } else {
                gridView.style.display = 'none';
                listView.style.display = 'block';
            }
        });
    });
    
    // Recherche en temps réel
    const searchInput = document.getElementById('searchInput');
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const speciesCards = document.querySelectorAll('[data-species-name]');
        
        speciesCards.forEach(card => {
            const speciesName = card.getAttribute('data-species-name');
            if (speciesName.includes(searchTerm)) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    });
    
    // Animation au survol des cartes
    const cards = document.querySelectorAll('.species-card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
    
    // Confirmation de suppression améliorée
    const deleteForms = document.querySelectorAll('form[action*="destroy"]');
    deleteForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const speciesName = this.closest('[data-species-name]').querySelector('.species-name')?.textContent ||
                              this.closest('tr').querySelector('td:nth-child(2) strong')?.textContent;
            
            if (!confirm(`Êtes-vous sûr de vouloir supprimer l'espèce "${speciesName}" ? Cette action est irréversible.`)) {
                e.preventDefault();
            }
        });
    });
});
</script>

@endsection