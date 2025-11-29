@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <style>
        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            border-top: 4px solid;
            text-align: center;
        }
        
        .stat-card.primary { border-color: #007bff; }
        .stat-card.success { border-color: #28a745; }
        .stat-card.warning { border-color: #ffc107; }
        .stat-card.info { border-color: #17a2b8; }
        .stat-card.purple { border-color: #6f42c1; }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 5px;
        }
        
        .stat-label {
            color: #6c757d;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.9rem;
        }
        
        .chart-container {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            height: 100%;
        }
        
        .progress-ring {
            width: 120px;
            height: 120px;
        }
        
        .revenue-item {
            display: flex;
            justify-content: between;
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid #e9ecef;
        }
        
        .revenue-item:last-child {
            border-bottom: none;
        }
    </style>

    <!-- En-tête de page -->
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="h3 mb-1">
                        <i class="fas fa-chart-bar text-primary me-2"></i>
                        Statistiques des Paiements
                    </h2>
                    <p class="text-muted mb-0">Analyse détaillée des transactions et revenus</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.historiques.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Retour à l'historique
                    </a>
                    <a href="{{ route('admin.historiques.export') }}" class="btn btn-success">
                        <i class="fas fa-download me-2"></i>Exporter Données
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques principales -->
    <div class="row mb-4">
        <div class="col-md-2">
            <div class="stat-card primary">
                <div class="stat-number">{{ $stats['paiements_mois'] }}</div>
                <div class="stat-label">Paiements Ce Mois</div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="stat-card success">
                <div class="stat-number">{{ number_format($stats['revenus_mois'], 0) }} DT</div>
                <div class="stat-label">Revenus Ce Mois</div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="stat-card info">
                <div class="stat-number">{{ number_format($stats['taux_success'], 1) }}%</div>
                <div class="stat-label">Taux de Réussite</div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="stat-card warning">
                <div class="stat-number">{{ number_format($stats['moyenne_paiement'], 0) }} DT</div>
                <div class="stat-label">Moyenne/Paiement</div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="stat-card purple">
                <div class="stat-number">{{ $paiementsParStatut->sum('count') }}</div>
                <div class="stat-label">Total Transactions</div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="stat-card" style="border-color: #fd7e14;">
                <div class="stat-number">{{ $revenusMensuels->sum('total') }} DT</div>
                <div class="stat-label">Revenus 6 Mois</div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Graphique des statuts -->
        <div class="col-md-6">
            <div class="chart-container">
                <h5 class="card-title mb-4">
                    <i class="fas fa-chart-pie me-2"></i>
                    Répartition par Statut
                </h5>
                <div class="text-center">
                    <canvas id="statutChart" width="400" height="300"></canvas>
                </div>
                <div class="mt-4">
                    @foreach($paiementsParStatut as $statut)
                    <div class="revenue-item">
                        <div class="d-flex align-items-center">
                            <div class="badge bg-{{ $statut->statut == 'completed' ? 'success' : ($statut->statut == 'pending' ? 'warning' : 'danger') }} me-3" 
                                 style="width: 20px; height: 20px;"></div>
                            <span class="text-capitalize">{{ $statut->statut }}</span>
                        </div>
                        <div class="ms-auto">
                            <strong>{{ $statut->count }}</strong>
                            <small class="text-muted"> transactions</small>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Revenus mensuels -->
        <div class="col-md-6">
            <div class="chart-container">
                <h5 class="card-title mb-4">
                    <i class="fas fa-chart-line me-2"></i>
                    Revenus des 6 Derniers Mois
                </h5>
                <div class="text-center">
                    <canvas id="revenueChart" width="400" height="300"></canvas>
                </div>
                <div class="mt-4">
                    @foreach($revenusMensuels->take(6) as $revenu)
                    <div class="revenue-item">
                        <div>
                            <strong>{{ DateTime::createFromFormat('!m', $revenu->month)->format('F') }} {{ $revenu->year }}</strong>
                        </div>
                        <div class="ms-auto">
                            <strong class="text-success">{{ number_format($revenu->total, 0) }} DT</strong>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques détaillées -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="chart-container">
                <h5 class="card-title mb-4">
                    <i class="fas fa-table me-2"></i>
                    Statistiques Détaillées
                </h5>
                <div class="row">
                    <div class="col-md-4 text-center">
                        <div class="mb-3">
                            <i class="fas fa-calendar-check fa-2x text-primary mb-2"></i>
                            <h5>Période d'Analyse</h5>
                            <p class="text-muted">6 derniers mois</p>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="mb-3">
                            <i class="fas fa-money-bill-wave fa-2x text-success mb-2"></i>
                            <h5>Revenu Total</h5>
                            <p class="text-success fs-4 fw-bold">{{ number_format($revenusMensuels->sum('total'), 0) }} DT</p>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="mb-3">
                            <i class="fas fa-chart-line fa-2x text-info mb-2"></i>
                            <h5>Performance</h5>
                            <p class="text-info fs-4 fw-bold">{{ number_format($stats['taux_success'], 1) }}%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Chart.js pour les statuts
    const statutCtx = document.getElementById('statutChart').getContext('2d');
    const statutChart = new Chart(statutCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($paiementsParStatut->pluck('statut')->map(function($statut) {
                return ucfirst($statut);
            })) !!},
            datasets: [{
                data: {!! json_encode($paiementsParStatut->pluck('count')) !!},
                backgroundColor: [
                    '#28a745', // completed
                    '#ffc107', // pending
                    '#dc3545'  // failed
                ],
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // Chart.js pour les revenus mensuels
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    const revenueChart = new Chart(revenueCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($revenusMensuels->map(function($revenu) {
                return new Date($revenu->year, $revenu->month - 1).toLocaleDateString('fr-FR', { month: 'short', year: 'numeric' });
            })) !!},
            datasets: [{
                label: 'Revenus (DT)',
                data: {!! json_encode($revenusMensuels->pluck('total')) !!},
                borderColor: '#007bff',
                backgroundColor: 'rgba(0, 123, 255, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value + ' DT';
                        }
                    }
                }
            }
        }
    });
});
</script>
@endsection