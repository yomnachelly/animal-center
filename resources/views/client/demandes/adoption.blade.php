@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Mes demandes d'adoption</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($demandes && $demandes->count() > 0)
        <div class="row">
            @foreach($demandes as $demande)
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">{{ $demande->animal->nom }}</h5>
                            <span class="badge 
                                @if($demande->etat == 'en attente') bg-warning
                                @elseif($demande->etat == 'approuvé') bg-success
                                @elseif($demande->etat == 'refusé') bg-danger
                                @else bg-secondary
                                @endif">
                                {{ ucfirst($demande->etat) }}
                            </span>
                        </div>
                        
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    @if($demande->animal->photo)
                                        <img src="{{ asset('storage/' . $demande->animal->photo) }}" 
                                             class="img-fluid rounded" 
                                             alt="{{ $demande->animal->nom }}">
                                    @else
                                        <img src="{{ asset('images/default-animal.png') }}" 
                                             class="img-fluid rounded" 
                                             alt="{{ $demande->animal->nom }}">
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <p class="card-text">
                                        <strong>Espèce :</strong> {{ $demande->animal->espece->nom ?? '-' }}<br>
                                        <strong>Race :</strong> {{ $demande->animal->race->nom ?? '-' }}<br>
                                        <strong>Âge :</strong> {{ $demande->animal->age ?? 'Inconnu' }} ans<br>
                                        <strong>Sexe :</strong> {{ ucfirst($demande->animal->sexe) }}
                                    </p>
                                    
<p class="card-text">
    <small class="text-muted">
        <strong>Date de la demande :</strong><br>
        {{ $demande->created_at ? $demande->created_at->format('d/m/Y à H:i') : 'Date non disponible' }}
    </small>
</p>

                                    @if($demande->adoption && $demande->adoption->date)
                                        <p class="card-text">
                                            <small class="text-muted">
                                                <strong>Date d'adoption :</strong><br>
                                                {{ $demande->adoption->date->format('d/m/Y') }}
                                            </small>
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            @if($demande->etat == 'en attente')
                                <div class="alert alert-info mb-0">
                                    <i class="fas fa-clock me-2"></i>
                                    Votre demande est en cours de traitement.
                                </div>
                            @elseif($demande->etat == 'approuvé')
                                <div class="alert alert-success mb-0">
                                    <i class="fas fa-check-circle me-2"></i>
                                    Félicitations ! Votre demande a été approuvée.
                                </div>
                            @elseif($demande->etat == 'refusé')
                                <div class="alert alert-danger mb-0">
                                    <i class="fas fa-times-circle me-2"></i>
                                    Votre demande a été refusée.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $demandes->links() }}
        </div>
    @else
        <div class="alert alert-info text-center">
            <i class="fas fa-info-circle fa-2x mb-3"></i>
            <h4>Vous n'avez aucune demande d'adoption</h4>
            <p class="mb-3">Commencez par parcourir nos animaux disponibles à l'adoption !</p>
            <a href="{{ route('animaux.index') }}" class="btn btn-primary">
                <i class="fas fa-paw me-2"></i>Voir les animaux disponibles
            </a>
        </div>
    @endif
</div>
@endsection