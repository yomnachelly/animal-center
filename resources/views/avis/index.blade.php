@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    <style>
        .avis-container {
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
            transition: transform 0.3s ease;
        }
        
        .stats-card:hover {
            transform: translateY(-5px);
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
        
        .table-custom {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
        }
        
        .table-custom thead th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 1rem;
            margin-right: 12px;
        }
        
        .user-info {
            display: flex;
            align-items: center;
        }
        
        .user-name {
            font-weight: 600;
            color: #2c3e50;
        }
        
        .avis-text {
            max-width: 300px;
            color: #6c757d;
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .avis-text-expanded {
            max-width: none;
            -webkit-line-clamp: unset;
        }
        
        .date-badge {
            background: #f8f9fa;
            color: #6c757d;
            padding: 8px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 5px;
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
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.1);
        }
        
        .action-buttons {
            display: flex;
            gap: 8px;
        }
        
        .btn-expand {
            background: transparent;
            border: 1px solid #667eea;
            color: #667eea;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
            transition: all 0.3s ease;
        }
        
        .btn-expand:hover {
            background: #667eea;
            color: white;
        }
        
        .pagination-custom .page-link {
            border: none;
            color: #667eea;
            padding: 10px 15px;
            margin: 0 2px;
            border-radius: 10px;
            font-weight: 600;
        }
        
        .pagination-custom .page-item.active .page-link {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .pagination-custom .page-link:hover {
            background: #f8f9fa;
            color: #667eea;
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
            
            .user-info {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }
            
            .user-avatar {
                margin-right: 0;
            }
        }
        
        .floating-animation {
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .status-badge {
            padding: 6px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        
        .status-active {
            background: #d4edda;
            color: #155724;
        }
        
        .status-deleted {
            background: #f8d7da;
            color: #721c24;
        }
    </style>

    <div class="avis-container">
        <!-- En-tête de page -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="page-title">
                        <i class="fas fa-comments floating-animation"></i>
                        Gestion des Avis
                    </h1>
                    <p class="page-subtitle">
                        Consultez et gérez tous les avis des utilisateurs
                    </p>
                </div>
                <div class="col-md-4 text-md-end">
                    <div class="stats-card">
                        <h3 class="stats-number">{{ $avis->count() }}</h3>
                        <p class="stats-label">Avis au total</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Barre de recherche -->
        <div class="search-box">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <input type="text" id="searchInput" class="form-control search-input" 
                           placeholder="Rechercher un avis, un utilisateur...">
                </div>
                <div class="col-md-6 text-end">
                    <small class="text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        {{ $avis->count() }} avis trouvés
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

        <!-- Tableau des avis -->
        @if($avis->isEmpty())
        <div class="empty-state">
            <i class="fas fa-comments"></i>
            <h3>Aucun avis pour le moment</h3>
            <p class="mb-4">Les utilisateurs n'ont pas encore publié d'avis.</p>
        </div>
        @else
        <div class="table-responsive">
            <table class="table table-custom">
                <thead>
                    <tr>
                        <th style="width: 80px;">ID</th>
                        <th>Utilisateur</th>
                        <th>Avis</th>
                        <th style="width: 150px;">Date</th>
                        <th style="width: 120px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($avis as $a)
                    <tr data-search="{{ strtolower($a->user?->name . ' ' . $a->texte) }}">
                        <td>
                            <span class="badge bg-primary">#{{ $a->id }}</span>
                        </td>
                        <td>
                            <div class="user-info">
                                <div class="user-avatar">
                                    {{ substr($a->user?->name ?: 'U', 0, 1) }}
                                </div>
                                <div>
                                    <div class="user-name">
                                        {{ $a->user ? $a->user->name : 'Utilisateur supprimé' }}
                                    </div>
                                    @if(!$a->user)
                                    <span class="status-badge status-deleted">
                                        <i class="fas fa-user-slash"></i> Compte supprimé
                                    </span>
                                    @else
                                    <span class="status-badge status-active">
                                        <i class="fas fa-user-check"></i> Actif
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="avis-text" id="avis-text-{{ $a->id }}">
                                {{ $a->texte }}
                            </div>
                            @if(strlen($a->texte) > 100)
                            <button class="btn-expand mt-1" onclick="toggleAvisText({{ $a->id }})">
                                <i class="fas fa-expand-alt"></i> Voir plus
                            </button>
                            @endif
                        </td>
                        <td>
                            <span class="date-badge">
                                <i class="fas fa-clock"></i>
                                {{ optional($a->created_at)->format('d/m/Y H:i') ?? '-' }}
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <form action="{{ route('avis.destroy', $a->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger-custom" 
                                            onclick="return confirmDelete('{{ addslashes($a->user?->name ?: 'Utilisateur supprimé') }}')">
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

        <!-- Pas de pagination puisque c'est une Collection -->
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Recherche en temps réel
    const searchInput = document.getElementById('searchInput');
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr[data-search]');
        
        rows.forEach(row => {
            const searchableText = row.getAttribute('data-search');
            if (searchableText.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
    
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

function toggleAvisText(avisId) {
    const avisText = document.getElementById(`avis-text-${avisId}`);
    const button = avisText.nextElementSibling;
    
    if (avisText.classList.contains('avis-text-expanded')) {
        avisText.classList.remove('avis-text-expanded');
        button.innerHTML = '<i class="fas fa-expand-alt"></i> Voir plus';
    } else {
        avisText.classList.add('avis-text-expanded');
        button.innerHTML = '<i class="fas fa-compress-alt"></i> Voir moins';
    }
}

function confirmDelete(userName) {
    return confirm(`Êtes-vous sûr de vouloir supprimer l'avis de "${userName}" ?\n\nCette action est irréversible.`);
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