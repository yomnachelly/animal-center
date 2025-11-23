@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <style>
        .soins-container {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .page-header {
            background: linear-gradient(135deg, #dc3545, #e35d6a);
            color: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(220, 53, 69, 0.3);
        }
        
        .page-title {
            font-weight: 700;
            margin: 0;
            font-size: 2.2rem;
        }
        
        .btn-primary-custom {
            background: white;
            color: #dc3545;
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
        
        .soins-table {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        
        .soins-table thead {
            background: linear-gradient(135deg, #2c5530, #4a7c59);
        }
        
        .soins-table thead th {
            border: none;
            padding: 20px 15px;
            font-weight: 600;
            color: white;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .soins-table tbody tr {
            transition: all 0.3s ease;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .soins-table tbody tr:hover {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            transform: translateX(5px);
        }
        
        .soins-table tbody td {
            border: none;
            padding: 20px 15px;
            vertical-align: middle;
            font-size: 1rem;
        }
        
        .soin-nom {
            font-weight: 600;
            color: #2c5530;
            font-size: 1.1rem;
        }
        
        .soin-frais {
            font-weight: 700;
            color: #dc3545;
            font-size: 1.2rem;
        }
        
        .action-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        
        .btn-edit {
            background: linear-gradient(135deg, #ffc107, #ffdb4d);
            border: none;
            color: #212529;
            padding: 8px 20px;
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            min-width: 100px;
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
            padding: 8px 20px;
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s ease;
            cursor: pointer;
            min-width: 100px;
        }
        
        .btn-delete:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.4);
            color: white;
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
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            padding: 25px;
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
            font-size: 2.5rem;
            font-weight: 700;
            color: #dc3545;
            margin-bottom: 5px;
        }
        
        .stat-label {
            color: #6c757d;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.9rem;
        }
        
        @media (max-width: 768px) {
            .page-header {
                padding: 20px;
                text-align: center;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .btn-edit, .btn-delete {
                min-width: 80px;
                padding: 10px 15px;
            }
            
            .soins-table thead th,
            .soins-table tbody td {
                padding: 15px 10px;
            }
        }
    </style>

    <div class="soins-container">
        <!-- En-tête de page -->
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <h1 class="page-title">📋 Mes Soins Vétérinaires</h1>
                <a href="{{ route('vet.soins.create') }}" class="btn btn-primary-custom">
                    <i class="fas fa-plus-circle me-2"></i>Nouveau Soin
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
            <div class="stat-card">
                <div class="stat-number">{{ $soins->count() }}</div>
                <div class="stat-label">Soins Totaux</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ number_format($soins->avg('frais') ?? 0, 2) }} DT</div>
                <div class="stat-label">Frais Moyen</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $soins->sum('frais') }} DT</div>
                <div class="stat-label">Total des Frais</div>
            </div>
        </div>

        <!-- Tableau des soins -->
        @if($soins->count() > 0)
            <div class="soins-table">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th style="width: 40%;">Nom du Soin</th>
                            <th style="width: 25%;">Frais</th>
                            <th style="width: 35%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($soins as $soin)
                        <tr>
                            <td>
                                <div class="soin-nom">
                                    <i class="fas fa-hand-holding-medical me-2 text-primary"></i>
                                    {{ $soin->nom }}
                                </div>
                            </td>
                            <td>
                                <span class="soin-frais">{{ $soin->frais }} DT</span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('vet.soins.edit', $soin->id) }}" class="btn-edit">
                                        <i class="fas fa-edit me-1"></i>Modifier
                                    </a>
                                    <form action="{{ route('vet.soins.destroy', $soin->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete" 
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce soin ?')">
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
                    <i class="fas fa-hand-holding-medical"></i>
                </div>
                <h3 class="empty-state-title">Aucun soin pour le moment</h3>
                <p class="empty-state-text">Commencez par ajouter votre premier soin vétérinaire</p>
                <a href="{{ route('vet.soins.create') }}" class="btn btn-primary-custom">
                    <i class="fas fa-plus-circle me-2"></i>Ajouter mon premier soin
                </a>
            </div>
        @endif

        <!-- Si vous voulez ajouter la pagination plus tard, modifiez votre contrôleur -->
        {{-- 
        @if($soins instanceof \Illuminate\Pagination\LengthAwarePaginator && $soins->hasPages())
        <div class="d-flex justify-content-center mt-4">
            <nav>
                <ul class="pagination">
                    {{ $soins->links() }}
                </ul>
            </nav>
        </div>
        @endif 
        --}}
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animation des cartes de statistiques
        const statCards = document.querySelectorAll('.stat-card');
        statCards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.2}s`;
        });
        
        // Confirmation de suppression
        const deleteForms = document.querySelectorAll('form[action*="destroy"]');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Êtes-vous sûr de vouloir supprimer ce soin ? Cette action est irréversible.')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@endsection