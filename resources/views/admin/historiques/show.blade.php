@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <style>
        .detail-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            border-left: 4px solid;
        }
        
        .detail-card.success { border-color: #28a745; }
        .detail-card.pending { border-color: #ffc107; }
        .detail-card.failed { border-color: #dc3545; }
        
        .info-badge {
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .badge-completed { background: #d4edda; color: #155724; }
        .badge-pending { background: #fff3cd; color: #856404; }
        .badge-failed { background: #f8d7da; color: #721c24; }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }
        
        .info-item {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 10px;
            border-left: 4px solid #007bff;
        }
        
        .info-label {
            font-weight: 600;
            color: #495057;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .info-value {
            font-size: 1.1rem;
            font-weight: 600;
            color: #212529;
            margin-top: 5px;
        }
    </style>

    <!-- En-tête de page -->
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="h3 mb-1">
                        <i class="fas fa-receipt text-primary me-2"></i>
                        Détails du Paiement #{{ $paiement->id }}
                    </h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.historiques.index') }}">Historique</a></li>
                            <li class="breadcrumb-item active">Détails</li>
                        </ol>
                    </nav>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.historiques.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Retour
                    </a>
                    @if($paiement->stripe_payment_intent_id)
                    <a href="https://dashboard.stripe.com/payments/{{ $paiement->stripe_payment_intent_id }}" 
                       target="_blank" class="btn btn-info">
                        <i class="fas fa-external-link-alt me-2"></i>Voir sur Stripe
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Informations principales -->
        <div class="col-md-8">
            <div class="detail-card {{ $paiement->statut }}">
                <div class="card-header bg-transparent">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Informations de la Transaction
                    </h5>
                </div>
                <div class="card-body">
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">Statut du Paiement</div>
                            <div class="info-value">
                                <span class="info-badge badge-{{ $paiement->statut }}">
                                    {{ $paiement->statut }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-label">Montant en DT</div>
                            <div class="info-value text-success">
                                {{ number_format($paiement->montant_dt, 2) }} DT
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-label">Montant en USD</div>
                            <div class="info-value">
                                ${{ number_format($paiement->montant_usd, 2) }}
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-label">Taux de Change</div>
                            <div class="info-value">
                                1 DT = {{ number_format($paiement->taux_change, 4) }} USD
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-label">Nombre de Jours</div>
                            <div class="info-value">
                                {{ $paiement->nombre_jours }} jours
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-label">Frais Journalier</div>
                            <div class="info-value">
                                {{ number_format($paiement->frais_jour, 2) }} DT/jour
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-label">Date de Création</div>
                            <div class="info-value">
                                {{ $paiement->created_at->format('d/m/Y H:i') }}
                            </div>
                        </div>
                        
                        @if($paiement->paid_at)
                        <div class="info-item">
                            <div class="info-label">Date de Paiement</div>
                            <div class="info-value">
                                {{ $paiement->paid_at->format('d/m/Y H:i') }}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Informations Stripe -->
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fab fa-stripe me-2"></i>
                        Informations Stripe
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Session ID:</strong><br>
                            <code class="text-muted">{{ $paiement->stripe_session_id }}</code>
                        </div>
                        <div class="col-md-6">
                            <strong>Payment Intent ID:</strong><br>
                            <code class="text-muted">{{ $paiement->stripe_payment_intent_id ?? 'N/A' }}</code>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <strong>Customer ID:</strong><br>
                            <code class="text-muted">{{ $paiement->stripe_customer_id ?? 'N/A' }}</code>
                        </div>
                        <div class="col-md-6">
                            <strong>Email Client:</strong><br>
                            <span class="text-muted">{{ $paiement->customer_email ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informations hébergement et animal -->
        <div class="col-md-4">
            <!-- Informations Animal -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-paw me-2"></i>
                        Informations Animal
                    </h5>
                </div>
                <div class="card-body">
                    @if($paiement->hebergement && $paiement->hebergement->animal)
                        <div class="text-center mb-3">
                            <i class="fas fa-paw fa-3x text-primary"></i>
                        </div>
                        <div class="mb-2">
                            <strong>Nom:</strong> {{ $paiement->hebergement->animal->nom }}
                        </div>
                        <div class="mb-2">
                            <strong>Espèce:</strong> {{ $paiement->hebergement->animal->espece->nom ?? 'N/A' }}
                        </div>
                        <div class="mb-2">
                            <strong>Race:</strong> {{ $paiement->hebergement->animal->race->nom ?? 'N/A' }}
                        </div>
                        <div class="mb-2">
                            <strong>Date de début:</strong> {{ $paiement->hebergement->date_debut }}
                        </div>
                        <div class="mb-2">
                            <strong>Date de fin:</strong> {{ $paiement->hebergement->date_fin }}
                        </div>
                    @else
                        <div class="text-center text-muted">
                            <i class="fas fa-exclamation-triangle fa-2x mb-2"></i>
                            <p>Aucune information d'animal disponible</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Informations Client -->
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-user me-2"></i>
                        Informations Client
                    </h5>
                </div>
                <div class="card-body">
                    @if($paiement->hebergement && $paiement->hebergement->demande && $paiement->hebergement->demande->user)
                        <div class="text-center mb-3">
                            <i class="fas fa-user-circle fa-3x text-info"></i>
                        </div>
                        <div class="mb-2">
                            <strong>Nom:</strong> {{ $paiement->hebergement->demande->user->name }}
                        </div>
                        <div class="mb-2">
                            <strong>Email:</strong> {{ $paiement->hebergement->demande->user->email }}
                        </div>
                    @else
                        <div class="text-center text-muted">
                            <i class="fas fa-user-slash fa-2x mb-2"></i>
                            <p>Informations client non disponibles</p>
                            @if($paiement->customer_email)
                                <div class="mt-2">
                                    <strong>Email Stripe:</strong><br>
                                    {{ $paiement->customer_email }}
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            <!-- Actions Rapides -->
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-bolt me-2"></i>
                        Actions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.historiques.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-list me-2"></i>Retour à la liste
                        </a>
                        @if($paiement->stripe_payment_intent_id)
                        <a href="https://dashboard.stripe.com/payments/{{ $paiement->stripe_payment_intent_id }}" 
                           target="_blank" class="btn btn-outline-info">
                            <i class="fab fa-stripe me-2"></i>Voir sur Stripe
                        </a>
                        @endif
{{-- Ligne 290 - Remplacez cette partie --}}
@if($paiement->hebergement)
<a href="{{ route('admin.historiques.show', $paiement->hebergement->id) }}" 
   class="btn btn-outline-success">
    <i class="fas fa-home me-2"></i>Voir Hébergement
</a>
@endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection