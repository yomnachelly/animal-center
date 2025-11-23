@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <style>
        .vaccins-container {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .page-header {
            background: linear-gradient(135deg, #17a2b8, #20c997);
            color: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(23, 162, 184, 0.3);
        }
        
        .page-title {
            font-weight: 700;
            margin: 0;
            font-size: 2.2rem;
        }
        
        .btn-primary-custom {
            background: white;
            color: #17a2b8;
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
            color: #17a2b8;
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
        
        .vaccins-table {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        
        .vaccins-table thead {
            background: linear-gradient(135deg, #17a2b8, #138496);
        }
        
        .vaccins-table thead th {
            border: none;
            padding: 20px 15px;
            font-weight: 600;
            color: white;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .vaccins-table tbody tr {
            transition: all 0.3s ease;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .vaccins-table tbody tr:hover {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            transform: translateX(5px);
        }
        
        .vaccins-table tbody td {
            border: none;
            padding: 20px 15px;
            vertical-align: middle;
            font-size: 1rem;
        }
        
        .vaccin-nom {
            font-weight: 600;
            color: #17a2b8;
            font-size: 1.1rem;
        }
        
        .vaccin-frais {
            font-weight: 700;
            color: #28a745;
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
            color: #17a2b8;
            margin-bottom: 5px;
        }
        
        .stat-label {
            color: #6c757d;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.9rem;
        }
        
        .vaccin-icon {
            color: #17a2b8;
            margin-right: 10px;
            font-size: 1.2rem;
        }
        
        .health-badge {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 500;
            margin-left: 10px;
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
            
            .vaccins-table thead th,
            .vaccins-table tbody td {
                padding: 15px 10px;
            }
        }
    </style>

    <div class="vaccins-container">
        <!-- En-tête de page -->
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <h1 class="page-title">
                    <i class="fas fa-syringe me-2"></i>💉 Mes Vaccins Vétérinaires
                    <span class="health-badge">Santé Animale</span>
                </h1>
                <a href="{{ route('vet.vaccins.create') }}" class="btn btn-primary-custom">
                    <i class="fas fa-plus-circle me-2"></i>Nouveau Vaccin
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
                <div class="stat-number">{{ $vaccins->count() }}</div>
                <div class="stat-label">Vaccins Totaux</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ number_format($vaccins->avg('frais') ?? 0, 2) }} DT</div>
                <div class="stat-label">Frais Moyen</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $vaccins->sum('frais') }} DT</div>
                <div class="stat-label">Total des Frais</div>
            </div>
        </div>

        <!-- Tableau des vaccins -->
        @if($vaccins->count() > 0)
            <div class="vaccins-table">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th style="width: 40%;">
                                <i class="fas fa-syringe me-2"></i>Nom du Vaccin
                            </th>
                            <th style="width: 25%;">
                                <i class="fas fa-money-bill-wave me-2"></i>Frais
                            </th>
                            <th style="width: 35%;">
                                <i class="fas fa-cogs me-2"></i>Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vaccins as $vaccin)
                        <tr>
                            <td>
                                <div class="vaccin-nom">
                                    <i class="fas fa-syringe vaccin-icon"></i>
                                    {{ $vaccin->nom }}
                                </div>
                            </td>
                            <td>
                                <span class="vaccin-frais">{{ $vaccin->frais }} DT</span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('vet.vaccins.edit', $vaccin->id) }}" class="btn-edit">
                                        <i class="fas fa-edit me-1"></i>Modifier
                                    </a>
                                    <form action="{{ route('vet.vaccins.destroy', $vaccin->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete" 
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce vaccin ?')">
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
                    <i class="fas fa-syringe"></i>
                </div>
                <h3 class="empty-state-title">Aucun vaccin pour le moment</h3>
                <p class="empty-state-text">Commencez par ajouter votre premier vaccin vétérinaire</p>
                <a href="{{ route('vet.vaccins.create') }}" class="btn btn-primary-custom">
                    <i class="fas fa-plus-circle me-2"></i>Ajouter mon premier vaccin
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
        
        // Confirmation de suppression améliorée
        const deleteForms = document.querySelectorAll('form[action*="destroy"]');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                const vaccinName = this.closest('tr').querySelector('.vaccin-nom').textContent.trim();
                if (!confirm(`Êtes-vous sûr de vouloir supprimer le vaccin "${vaccinName}" ?\n\nCette action est irréversible et supprimera définitivement le vaccin.`)) {
                    e.preventDefault();
                }
            });
        });
        
        // Effet de pulse sur les icônes de vaccin
        const vaccinIcons = document.querySelectorAll('.vaccin-icon');
        vaccinIcons.forEach((icon, index) => {
            icon.style.animationDelay = `${index * 0.1}s`;
            icon.classList.add('animate__animated', 'animate__pulse');
        });
    });
</script>
@endsection