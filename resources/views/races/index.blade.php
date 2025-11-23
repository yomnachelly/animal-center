@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    <style>
        .races-container {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .page-header {
            background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
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
            border-left: 5px solid #ff9a9e;
            margin-bottom: 25px;
            transition: transform 0.3s ease;
        }
        
        .stats-card:hover {
            transform: translateY(-5px);
        }
        
        .stats-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: #ff9a9e;
            margin: 0;
        }
        
        .stats-label {
            color: #6c757d;
            font-weight: 600;
            margin: 5px 0 0 0;
        }
        
        .table-custom {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
        }
        
        .table-custom thead th {
            background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
            color: white;
            border: none;
            padding: 20px;
            font-weight: 600;
            font-size: 1rem;
        }
        
        .table-custom tbody td {
            padding: 20px;
            border-color: #f8f9fa;
            vertical-align: middle;
            transition: all 0.3s ease;
        }
        
        .table-custom tbody tr {
            transition: all 0.3s ease;
        }
        
        .table-custom tbody tr:hover {
            background: #f8f9fa;
            transform: scale(1.01);
        }
        
        .table-custom tbody tr:hover td {
            background: transparent;
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
        
        .btn-primary-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
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
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        
        .btn-danger-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(245, 87, 108, 0.4);
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
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            margin: 20px 0;
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
            border-color: #ff9a9e;
            background: white;
            box-shadow: 0 0 0 0.2rem rgba(255, 154, 158, 0.1);
        }
        
        .filter-select {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 12px 20px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
            cursor: pointer;
        }
        
        .filter-select:focus {
            border-color: #ff9a9e;
            background: white;
            box-shadow: 0 0 0 0.2rem rgba(255, 154, 158, 0.1);
        }
        
        .action-buttons {
            display: flex;
            gap: 8px;
        }
        
        .species-badge {
            background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
            color: white;
            padding: 6px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        
        .race-id-badge {
            background: #6c757d;
            color: white;
            padding: 6px 10px;
            border-radius: 10px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        @media (max-width: 768px) {
            .page-title {
                font-size: 2rem;
            }
            
            .table-custom {
                font-size: 0.9rem;
            }
            
            .table-custom thead th,
            .table-custom tbody td {
                padding: 12px 8px;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .btn-primary-custom,
            .btn-danger-custom {
                width: 100%;
                justify-content: center;
            }
        }
        
        .floating-animation {
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
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
            background: #ff9a9e;
            border-color: #ff9a9e;
            color: white;
        }
    </style>

    <div class="races-container">
        <!-- En-tête de page -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="page-title">
                        <i class="fas fa-paw floating-animation"></i>
                        Gestion des Races
                    </h1>
                    <p class="page-subtitle">
                        Gérez et organisez les races animales par espèce
                    </p>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="{{ route('races.create') }}" class="btn btn-success-custom">
                        <i class="fas fa-plus-circle"></i>
                        Nouvelle Race
                    </a>
                </div>
            </div>
        </div>

        <!-- Statistiques -->
        <div class="row">
            <div class="col-md-4">
                <div class="stats-card">
                    <h3 class="stats-number">{{ $races->count() }}</h3>
                    <p class="stats-label">Races enregistrées</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card">
                    <h3 class="stats-number">{{ $especesCount ?? $races->groupBy('espece_id')->count() }}</h3>
                    <p class="stats-label">Espèces représentées</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card">
                    <h3 class="stats-number">{{ $races->pluck('espece.nom')->unique()->count() }}</h3>
                    <p class="stats-label">Diversité d'espèces</p>
                </div>
            </div>
        </div>

        <!-- Barre de recherche et filtres -->
        <div class="search-box">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <input type="text" id="searchInput" class="form-control search-input" 
                           placeholder="Rechercher une race...">
                </div>
                <div class="col-md-4">
                    <select id="especeFilter" class="form-control filter-select">
                        <option value="">Toutes les espèces</option>
                        @foreach($especes ?? [] as $espece)
                            <option value="{{ $espece->nom }}">{{ $espece->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 text-end">
                    <small class="text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        {{ $races->count() }} races trouvées
                    </small>
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

        <!-- Tableau des races -->
        @if($races->isEmpty())
        <div class="empty-state">
            <i class="fas fa-paw"></i>
            <h3>Aucune race enregistrée</h3>
            <p class="mb-4">Commencez par ajouter votre première race animale</p>
            <a href="{{ route('races.create') }}" class="btn btn-success-custom">
                <i class="fas fa-plus-circle"></i>
                Ajouter une race
            </a>
        </div>
        @else
        <div class="table-responsive">
            <table class="table table-custom">
                <thead>
                    <tr>
                        <th style="width: 80px;">ID</th>
                        <th>Nom de la race</th>
                        <th>Espèce</th>
                        <th style="width: 150px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($races as $race)
                    <tr data-search="{{ strtolower($race->nom . ' ' . $race->espece->nom) }}" 
                        data-espece="{{ $race->espece->nom }}">
                        <td>
                            <span class="race-id-badge">#{{ $race->id }}</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-dog me-3 text-primary"></i>
                                <strong>{{ $race->nom }}</strong>
                            </div>
                        </td>
                        <td>
                            <span class="species-badge">
                                <i class="fas fa-tag"></i>
                                {{ $race->espece->nom }}
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('races.edit', $race) }}" class="btn btn-primary-custom">
                                    <i class="fas fa-edit"></i>
                                    Modifier
                                </a>
                                <form action="{{ route('races.destroy', $race) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger-custom" 
                                            onclick="return confirmDelete('{{ addslashes($race->nom) }}', '{{ addslashes($race->espece->nom) }}')">
                                        <i class="fas fa-trash"></i>
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Recherche en temps réel
    const searchInput = document.getElementById('searchInput');
    const especeFilter = document.getElementById('especeFilter');
    
    function filterRaces() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedEspece = especeFilter.value;
        const rows = document.querySelectorAll('tbody tr[data-search]');
        
        rows.forEach(row => {
            const searchableText = row.getAttribute('data-search');
            const raceEspece = row.getAttribute('data-espece');
            
            const matchesSearch = searchableText.includes(searchTerm);
            const matchesEspece = !selectedEspece || raceEspece === selectedEspece;
            
            if (matchesSearch && matchesEspece) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
        
        // Mettre à jour le compteur
        updateResultsCount();
    }
    
    function updateResultsCount() {
        const visibleRows = document.querySelectorAll('tbody tr[data-search]:not([style*="display: none"])');
        const countElement = document.querySelector('.text-muted');
        if (countElement) {
            countElement.innerHTML = `<i class="fas fa-info-circle me-1"></i>${visibleRows.length} races trouvées`;
        }
    }
    
    searchInput.addEventListener('input', filterRaces);
    especeFilter.addEventListener('change', filterRaces);
    
    // Animation au survol des lignes
    const rows = document.querySelectorAll('tbody tr');
    rows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.01)';
        });
        
        row.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });
});

function confirmDelete(raceName, especeName) {
    return confirm(`Êtes-vous sûr de vouloir supprimer la race "${raceName}" (${especeName}) ?\n\nCette action est irréversible.`);
}

// Raccourci clavier pour la recherche
document.addEventListener('keydown', function(e) {
    if ((e.ctrlKey || e.metaKey) && e.key === 'f') {
        e.preventDefault();
        document.getElementById('searchInput').focus();
    }
});
</script>

@endsection