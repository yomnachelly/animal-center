@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    <style>
        .hebergement-container {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .page-header {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            padding: 50px 40px;
            border-radius: 25px;
            margin-bottom: 40px;
            box-shadow: 0 20px 40px rgba(79, 172, 254, 0.3);
            position: relative;
            overflow: hidden;
        }
        
        .page-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
            transform: rotate(45deg);
        }
        
        .page-title {
            font-weight: 800;
            margin: 0;
            font-size: 3rem;
            position: relative;
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .page-subtitle {
            opacity: 0.9;
            margin: 15px 0 0 0;
            font-size: 1.3rem;
            font-weight: 300;
            position: relative;
        }
        
        .btn-primary-custom {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            border: none;
            color: white;
            padding: 15px 30px;
            border-radius: 25px;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 5px 15px rgba(79, 172, 254, 0.3);
        }
        
        .btn-primary-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(79, 172, 254, 0.4);
            background: linear-gradient(135deg, #3a9dfc 0%, #00d9e6 100%);
            color: white;
        }
        
        .stats-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }
        
        .stat-card {
            background: white;
            padding: 30px 25px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            text-align: center;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            border: 1px solid #f0f0f0;
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(135deg, #4facfe, #00f2fe);
        }
        
        .stat-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px rgba(79, 172, 254, 0.15);
        }
        
        .stat-card.pending {
            background: linear-gradient(135deg, #fff3cd, #ffeaa7);
        }
        
        .stat-card.accepted {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
        }
        
        .stat-card.rejected {
            background: linear-gradient(135deg, #f8d7da, #f5c6cb);
        }
        
        .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
            opacity: 0.8;
        }
        
        .stat-number {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 10px;
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .stat-card.pending .stat-number {
            background: linear-gradient(135deg, #ffc107, #ffb300);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .stat-card.accepted .stat-number {
            background: linear-gradient(135deg, #28a745, #20c997);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .stat-card.rejected .stat-number {
            background: linear-gradient(135deg, #dc3545, #e35d6a);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .stat-label {
            color: #6c757d;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.9rem;
        }
        
        .hebergement-table-container {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px;
            border: 1px solid #f0f0f0;
        }
        
        .table-header {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            padding: 25px 30px;
            color: white;
        }
        
        .table-title {
            font-weight: 700;
            margin: 0;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .hebergement-table {
            margin: 0;
        }
        
        .hebergement-table thead {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        }
        
        .hebergement-table thead th {
            border: none;
            padding: 20px 25px;
            font-weight: 700;
            color: #495057;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            border-bottom: 2px solid #4facfe;
        }
        
        .hebergement-table tbody tr {
            transition: all 0.3s ease;
            border-bottom: 1px solid #f8f9fa;
        }
        
        .hebergement-table tbody tr:hover {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            transform: translateX(8px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }
        
        .hebergement-table tbody td {
            border: none;
            padding: 25px;
            vertical-align: middle;
            font-size: 1rem;
            position: relative;
        }
        
        .animal-cell {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .animal-avatar {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 1.2rem;
            box-shadow: 0 5px 15px rgba(79, 172, 254, 0.3);
        }
        
        .animal-info {
            flex: 1;
        }
        
        .animal-name {
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 5px;
        }
        
        .animal-details {
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        .date-cell {
            font-weight: 600;
            color: #495057;
        }
        
        .etat-badge {
            padding: 10px 18px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .etat-attente {
            background: linear-gradient(135deg, #ffeaa7, #fab1a0);
            color: #e17055;
        }
        
        .etat-accepte {
            background: linear-gradient(135deg, #a8e6cf, #dcedc1);
            color: #2d7d5a;
        }
        
        .etat-rejete {
            background: linear-gradient(135deg, #ffafbd, #ffc3a0);
            color: #c44569;
        }
        
        .action-buttons {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }
        
        .btn-cancel {
            background: linear-gradient(135deg, #ff6b6b, #ff8e8e);
            border: none;
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 3px 10px rgba(255, 107, 107, 0.3);
        }
        
        .btn-cancel:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 107, 107, 0.4);
        }
        
        .btn-pay {
            background: linear-gradient(135deg, #43e97b, #38f9d7);
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
            gap: 6px;
            box-shadow: 0 3px 10px rgba(67, 233, 123, 0.3);
        }
        
        .btn-pay:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(67, 233, 123, 0.4);
            color: white;
        }
        
        .empty-state {
            text-align: center;
            padding: 80px 40px;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 25px;
            margin: 40px 0;
            position: relative;
            overflow: hidden;
        }
        
        .empty-state-icon {
            font-size: 6rem;
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 30px;
        }
        
        .empty-state-title {
            color: #2c3e50;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 15px;
        }
        
        .empty-state-text {
            color: #6c757d;
            font-size: 1.2rem;
            margin-bottom: 30px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        
        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        @media (max-width: 768px) {
            .page-header {
                padding: 30px 20px;
                text-align: center;
            }
            
            .page-title {
                font-size: 2.2rem;
                flex-direction: column;
                gap: 10px;
            }
            
            .hebergement-table thead th,
            .hebergement-table tbody td {
                padding: 15px 10px;
                font-size: 0.9rem;
            }
            
            .animal-cell {
                flex-direction: column;
                text-align: center;
                gap: 8px;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .stats-cards {
                grid-template-columns: 1fr;
            }
        }
        
        .page-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            flex-wrap: wrap;
            gap: 20px;
        }
    </style>

    <div class="hebergement-container">
        <!-- En-tête de page -->
        <div class="page-header">
            <h1 class="page-title floating">
                <i class="fas fa-home"></i>
                Mes Demandes d'Hébergement
            </h1>
            <p class="page-subtitle">Gérez vos demandes d'hébergement pour vos animaux</p>
        </div>

        <!-- Actions de page -->
        <div class="page-actions">
            <a href="{{ route('client.demandes.hebergement.create') }}" class="btn-primary-custom">
                <i class="fas fa-plus-circle"></i>
                Nouvelle Demande d'Hébergement
            </a>
        </div>

        <!-- Cartes de statistiques -->
        <div class="stats-cards">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-list"></i>
                </div>
                <div class="stat-number">{{ $hebergements->count() }}</div>
                <div class="stat-label">Total des Demandes</div>
            </div>
            <div class="stat-card pending">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-number">{{ $hebergements->filter(fn($h) => optional($h->demande)->etat == 'en attente')->count() }}</div>
                <div class="stat-label">En Attente</div>
            </div>
            <div class="stat-card accepted">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-number">{{ $hebergements->filter(fn($h) => optional($h->demande)->etat == 'accepte')->count() }}</div>
                <div class="stat-label">Acceptées</div>
            </div>
            <div class="stat-card rejected">
                <div class="stat-icon">
                    <i class="fas fa-times-circle"></i>
                </div>
                <div class="stat-number">{{ $hebergements->filter(fn($h) => optional($h->demande)->etat == 'rejete')->count() }}</div>
                <div class="stat-label">Rejetées</div>
            </div>
        </div>

        <!-- Tableau des hébergements -->
        @if($hebergements->count() > 0)
            <div class="hebergement-table-container">
                <div class="table-header">
                    <h3 class="table-title">
                        <i class="fas fa-table"></i>
                        Liste des Demandes d'Hébergement
                    </h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0 hebergement-table">
                        <thead>
                            <tr>
                                <th><i class="fas fa-paw me-2"></i>Animal</th>
                                <th><i class="fas fa-calendar-start me-2"></i>Date Début</th>
                                <th><i class="fas fa-calendar-end me-2"></i>Date Fin</th>
                                <th><i class="fas fa-info-circle me-2"></i>Statut</th>
                                <th><i class="fas fa-cogs me-2"></i>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($hebergements as $hebergement)
                            <tr>
                                <td>
                                    <div class="animal-cell">
                                        <div class="animal-avatar">
                                            <i class="fas fa-paw"></i>
                                        </div>
                                        <div class="animal-info">
                                            <div class="animal-name">{{ $hebergement->animal->nom }}</div>
                                            <div class="animal-details">
                                                {{ $hebergement->animal->espece->nom ?? 'Espèce non spécifiée' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="date-cell">
                                    <i class="fas fa-calendar me-2"></i>
                                    {{ \Carbon\Carbon::parse($hebergement->date_debut)->format('d/m/Y') }}
                                </td>
                                <td class="date-cell">
                                    <i class="fas fa-calendar me-2"></i>
                                    {{ \Carbon\Carbon::parse($hebergement->date_fin)->format('d/m/Y') }}
                                </td>
                                <td>
                                    @php
                                        $etat = optional($hebergement->demande)->etat;
                                        $demandeId = optional($hebergement->demande)->id;
                                    @endphp
                                    <span class="etat-badge 
                                        @if($etat == 'accepte') etat-accepte
                                        @elseif($etat == 'en attente') etat-attente
                                        @elseif($etat == 'rejete') etat-rejete
                                        @endif">
                                        <i class="fas 
                                            @if($etat == 'accepte') fa-check-circle
                                            @elseif($etat == 'en attente') fa-clock
                                            @elseif($etat == 'rejete') fa-times-circle
                                            @endif me-1">
                                        </i>
                                        {{ $etat ?? 'Non défini' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        @if($etat == 'en attente' && $demandeId)
                                            <form action="{{ route('client.demandes.hebergement.destroy', $demandeId) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-cancel"
                                                        onclick="return confirm('Êtes-vous sûr de vouloir annuler cette demande d\\'hébergement ?')">
                                                    <i class="fas fa-times"></i>
                                                    Annuler
                                                </button>
                                            </form>
                                                                         @elseif($etat == 'accepte' && $demandeId)
   <form action="{{ route('payer.hebergement', $hebergement->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn-pay">
            <i class="fas fa-credit-card"></i> Payer
        </button>
    </form>
                                                <a href="{{ route('facture.generer', $hebergement->id) }}"class="btn-pay">
                                                <i class="fas fa-download"></i>
                                                exporter facture en pdf
                                            </a>
                                        @else
                                            <span class="text-muted">
                                                <i class="fas fa-lock me-1"></i>
                                                Aucune action
                                            </span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <!-- État vide -->
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="fas fa-home floating"></i>
                </div>
                <h3 class="empty-state-title">Aucune demande d'hébergement</h3>
                <p class="empty-state-text">Vous n'avez encore fait aucune demande d'hébergement pour vos animaux.</p>
                <a href="{{ route('client.demandes.hebergement.create') }}" class="btn-primary-custom mt-3">
                    <i class="fas fa-plus-circle"></i>
                    Créer une demande d'hébergement
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
        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 200);
    });
    
    // Animation des lignes du tableau
    const tableRows = document.querySelectorAll('.hebergement-table tbody tr');
    tableRows.forEach((row, index) => {
        setTimeout(() => {
            row.style.opacity = '1';
            row.style.transform = 'translateX(0)';
        }, index * 100);
    });
    
    // Confirmation pour l'annulation
    const cancelForms = document.querySelectorAll('form[action*="destroy"]');
    cancelForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!confirm('Êtes-vous sûr de vouloir annuler cette demande d\'hébergement ? Cette action est irréversible.')) {
                e.preventDefault();
            }
        });
    });
});
</script>
@endsection