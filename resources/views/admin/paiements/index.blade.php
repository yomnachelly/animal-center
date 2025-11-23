@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    <style>
        .paiements-container {
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
        
        .frais-amount {
            font-size: 1.5rem;
            font-weight: 800;
            color: #28a745;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .currency-symbol {
            font-size: 1.2rem;
            color: #6c757d;
            font-weight: 600;
        }
        
        .btn-warning-custom {
            background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-warning-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 154, 158, 0.4);
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
        
        .info-card {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            border-left: 4px solid #2196f3;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
        }
        
        .info-card-title {
            color: #1976d2;
            font-weight: 700;
            margin-bottom: 10px;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .info-card-content {
            color: #1565c0;
            margin: 0;
            font-size: 0.95rem;
            line-height: 1.5;
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
            
            .frais-amount {
                font-size: 1.2rem;
            }
        }
        
        .floating-animation {
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .last-update {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
            margin-top: 10px;
            border-left: 4px solid #6c757d;
        }
        
        .update-text {
            color: #6c757d;
            font-size: 0.85rem;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 5px;
        }
    </style>

    <div class="paiements-container">
        <!-- En-tête de page -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="page-title">
                        <i class="fas fa-money-bill-wave floating-animation"></i>
                        Frais Journaliers
                    </h1>
                    <p class="page-subtitle">
                        Gérez le tarif journalier appliqué à tous les animaux
                    </p>
                </div>
                <div class="col-md-4 text-md-end">
                    <div class="stats-card">
                        <h3 class="stats-number">{{ number_format($paiements->first()->frais_jour ?? 0, 2) }}<small class="currency-symbol"> DT</small></h3>
                        <p class="stats-label">Tarif journalier actuel</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informations -->
        <div class="info-card">
            <div class="info-card-title">
                <i class="fas fa-info-circle"></i>
                Informations importantes
            </div>
            <p class="info-card-content">
                Le frais journalier est appliqué à tous les animaux du refuge. 
                Une seule valeur est active à la fois. La modification impacte immédiatement tous les nouveaux séjours.
            </p>
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

        <!-- Tableau des frais -->
        @if($paiements->isEmpty())
        <div class="empty-state">
            <i class="fas fa-money-bill-wave"></i>
            <h3>Aucun frais configuré</h3>
            <p class="mb-4">Configurez le premier frais journalier pour votre refuge</p>
            <!--
            <a href="{{ route('admin.paiements.create') }}" class="btn btn-success-custom">
                <i class="fas fa-plus-circle"></i>
                Ajouter un frais
            </a>
            -->
        </div>
        @else
        <div class="table-responsive">
            <table class="table table-custom">
                <thead>
                    <tr>
                        <th style="width: 60%;">Frais Journalier</th>
                        <th style="width: 40%;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($paiements as $paiement)
                    <tr>
                        <td>
                            <div class="frais-amount">
                               <span>DT</span>
                                {{ number_format($paiement->frais_jour, 2) }} DT
                            </div>
                            <div class="last-update">
                                <p class="update-text">
                                    <i class="fas fa-clock"></i>
                                    @if($paiement->updated_at)
                                        Dernière modification : {{ $paiement->updated_at->format('d/m/Y à H:i') }}
                                    @else
                                        Date de modification non disponible
                                    @endif
                                </p>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.paiements.edit', $paiement) }}" 
                                   class="btn btn-warning-custom">
                                    <i class="fas fa-edit"></i>
                                    Modifier
                                </a>
                                <!--
                                <form action="{{ route('admin.paiements.destroy', $paiement) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger-custom" 
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce frais ?')">
                                        <i class="fas fa-trash"></i>
                                        Supprimer
                                    </button>
                                </form>
                                -->
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

        <!-- Note importante -->
        <div class="info-card mt-4">
            <div class="info-card-title">
                <i class="fas fa-lightbulb"></i>
                Note importante
            </div>
            <p class="info-card-content">
                Le frais journalier est unique et s'applique à l'ensemble du refuge. 
                Pour modifier le tarif, utilisez le bouton "Modifier" ci-dessus.
            </p>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
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
</script>

@endsection