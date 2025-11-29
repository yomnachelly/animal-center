@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <style>
        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-left: 4px solid;
            margin-bottom: 20px;
        }
        
        .stat-card.primary { border-color: #007bff; }
        .stat-card.success { border-color: #28a745; }
        .stat-card.warning { border-color: #ffc107; }
        .stat-card.danger { border-color: #dc3545; }
        .stat-card.info { border-color: #17a2b8; }
        
        .stat-number {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 5px;
        }
        
        .stat-label {
            color: #6c757d;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .badge-statut {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.8rem;
        }
        
        .badge-completed { background: #d4edda; color: #155724; }
        .badge-pending { background: #fff3cd; color: #856404; }
        .badge-failed { background: #f8d7da; color: #721c24; }
        
        .table-hover tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.05);
        }
    </style>

    <!-- En-tête de page -->
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="h3 mb-1">
                        <i class="fas fa-history text-primary me-2"></i>
                        Historique des Paiements
                    </h2>
                    <p class="text-muted mb-0">Gestion et consultation des transactions Stripe</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Cartes de statistiques -->
    <div class="row mb-4">
        <div class="col-md-2">
            <div class="stat-card primary">
                <div class="stat-number">{{ $stats['total'] }}</div>
                <div class="stat-label">Total Paiements</div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="stat-card success">
                <div class="stat-number">{{ $stats['completed'] }}</div>
                <div class="stat-label">Réussis</div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="stat-card warning">
                <div class="stat-number">{{ $stats['pending'] }}</div>
                <div class="stat-label">En Attente</div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="stat-card danger">
                <div class="stat-number">{{ $stats['failed'] }}</div>
                <div class="stat-label">Échoués</div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="stat-card info">
                <div class="stat-number">{{ number_format($stats['total_amount'], 0) }} DT</div>
                <div class="stat-label">Revenus Totaux</div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="stat-card" style="border-color: #6f42c1;">
                <div class="stat-number">{{ number_format($stats['revenus_mois'], 0) }} DT</div>
                <div class="stat-label">Ce Mois</div>
            </div>
        </div>
    </div>

    <!-- Tableau des historiques -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-list me-2"></i>
                        Liste des Transactions
                    </h5>
                </div>
                <div class="card-body p-0">
                    @if($paiements->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover table-striped mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Date</th>
                                        <th>Animal</th>
                                        <th>Client</th>
                                        <th>Montant DT</th>
                                        <th>Jours</th>
                                        <th>Statut</th>
                                        <th>Session Stripe</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($paiements as $paiement)
                                    <tr>
                                        <td><strong>#{{ $paiement->id }}</strong></td>
                                        <td>{{ $paiement->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            @if($paiement->hebergement && $paiement->hebergement->animal)
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-paw text-muted me-2"></i>
                                                    {{ $paiement->hebergement->animal->nom }}
                                                </div>
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($paiement->hebergement && $paiement->hebergement->demande && $paiement->hebergement->demande->user)
                                                {{ $paiement->hebergement->demande->user->name }}
                                            @else
                                                <span class="text-muted">{{ $paiement->customer_email ?? 'N/A' }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <strong class="text-success">{{ number_format($paiement->montant_dt, 2) }} DT</strong>
                                            <br>
                                            <small class="text-muted">${{ number_format($paiement->montant_usd, 2) }}</small>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark">
                                                {{ $paiement->nombre_jours }} jours
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge-statut badge-{{ $paiement->statut }}">
                                                {{ $paiement->statut }}
                                            </span>
                                        </td>
                                        <td>
                                            <small class="text-muted font-monospace">
                                                {{ Str::limit($paiement->stripe_session_id, 15) }}
                                            </small>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('admin.historiques.show', $paiement->id) }}" 
                                                   class="btn btn-outline-primary" title="Voir détails">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                @if($paiement->stripe_payment_intent_id)
                                                <a href="https://dashboard.stripe.com/payments/{{ $paiement->stripe_payment_intent_id }}" 
                                                   target="_blank" class="btn btn-outline-info" title="Voir sur Stripe">
                                                    <i class="fas fa-external-link-alt"></i>
                                                </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Pagination -->
                        <div class="card-footer">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-muted">
                                    Affichage de {{ $paiements->firstItem() }} à {{ $paiements->lastItem() }} 
                                    sur {{ $paiements->total() }} résultats
                                </div>
                                <div>
                                    {{ $paiements->links() }}
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-receipt fa-4x text-muted mb-3"></i>
                            <h5 class="text-muted">Aucun paiement trouvé</h5>
                            <p class="text-muted">Aucune transaction ne correspond à vos critères de recherche.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection