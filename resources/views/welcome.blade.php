@extends('layouts.app')

@section('content')

<h1 class="mb-4">Bienvenue au Refuge Animalier</h1>

{{-- Message de succès après connexion --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row">
    {{-- Colonne principale : Animaux et Avis --}}
    <div class="col-md-8">

        {{-- Section des animaux à adopter --}}
        <div class="mt-5">
            <h2 class="mb-4">Animaux à adopter</h2>

            @if($featuredAnimals->count() > 0)
                <div class="row">
                    @foreach($featuredAnimals as $animal)
                        <div class="col-md-3 mb-4">
                            <div class="card h-100" data-animal-id="{{ $animal->id }}">
                                @if($animal->photo)
                                    <img src="{{ asset('storage/' . $animal->photo) }}" class="card-img-top" alt="{{ $animal->nom }}">
                                @else
                                    <img src="{{ asset('images/default-animal.png') }}" class="card-img-top" alt="{{ $animal->nom }}">
                                @endif

                                <div class="card-body">
                                    <h5 class="card-title">{{ $animal->nom }}</h5>
                                    <p class="card-text">
                                        <strong>Espèce :</strong> {{ $animal->espece->nom ?? '-' }}<br>
                                        <strong>Race :</strong> {{ $animal->race->nom ?? '-' }}<br>
                                        <strong>Âge :</strong> {{ $animal->age ?? 'Inconnu' }} ans<br>
                                        <strong>Sexe :</strong> {{ ucfirst($animal->sexe) }}
                                    </p>
                                </div>

                                {{-- Bouton Demander --}}
                                <div class="card-footer text-center">
                                    @auth
                                        @php
                                            $hasDemande = auth()->user()->demandes()->where('animal_id', $animal->id)->exists();
                                        @endphp

                                        @if($hasDemande)
                                            <button class="btn btn-secondary btn-sm" disabled>Demande envoyée</button>
                                            <small class="d-block text-muted mt-1">En attente de validation</small>
                                        @else
                                            <form action="{{ route('demande.adopter', $animal) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm" 
                                                    onclick="return confirm('Êtes-vous sûr de vouloir faire une demande d\\'adoption pour {{ $animal->nom }} ?')">
                                                    Demander
                                                </button>
                                            </form>
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn-success btn-sm">Demander</a>
                                        <small class="d-block text-muted mt-1">Connectez-vous pour adopter</small>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-3">
                    <a href="{{ route('animaux.index') }}" class="btn btn-outline-primary">Voir tous les animaux</a>
                </div>
            @else
                <div class="alert alert-info">
                    Aucun animal disponible pour le moment.
                </div>
            @endif
        </div>

        {{-- Section des avis --}}
        <div class="mt-5">
            <h2 class="mb-4">Avis de nos clients</h2>

            @if($derniersAvis->count() > 0)
                <div class="row">
                    @foreach($derniersAvis as $avis)
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" 
                                             style="width: 40px; height: 40px; font-weight: bold;">
                                            {{ strtoupper(substr($avis->user->name, 0, 1)) }}
                                        </div>
                                        <h5 class="card-title mb-0">{{ $avis->user->name }}</h5>
                                    </div>
                                    <p class="card-text">{{ $avis->texte }}</p>
                                </div>
                                <div class="card-footer bg-transparent">
                                    <small class="text-muted">
                                        <i class="fas fa-clock me-1"></i>
                                        {{ $avis->created_at ? $avis->created_at->diffForHumans() : 'Date non disponible' }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @auth
                    <div class="text-center mt-3">
                        <a href="{{ route('client.avis.index') }}" class="btn btn-outline-primary">
                            Voir tous les avis
                        </a>
                    </div>
                @endauth
            @else
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    Aucun avis pour le moment.
                    @auth
                        Soyez le premier à donner votre avis !
                    @else
                        Connectez-vous pour donner votre avis !
                    @endauth
                </div>
            @endif
        </div>
    </div>

    {{-- Colonne secondaire : Services et Statistiques --}}
    <div class="col-md-4">
        <h2 class="mb-4">Services disponibles</h2>

        <div class="list-group">
            <div class="list-group-item">Soin vétérinaire</div>
            <div class="list-group-item">Vaccination</div>
            <div class="list-group-item">Hébergement</div>
            <div class="list-group-item">Adoption</div>
            <div class="list-group-item">Conseils animaliers</div>
        </div>

        {{-- Statistiques --}}
        <div class="mt-4 p-3 bg-light rounded">
            <h5>Notre Refuge en Chiffres</h5>
            <div class="row text-center">
                <div class="col-6">
                    <div class="p-2">
                        <h4 class="text-primary mb-1">{{ App\Models\Animal::count() }}</h4>
                        <small>Animaux sauvés</small>
                    </div>
                </div>
                <div class="col-6">
                    <div class="p-2">
                        <h4 class="text-success mb-1">{{ App\Models\Avis::count() }}</h4>
                        <small>Avis clients</small>
                    </div>
                </div>
            </div>
        </div>

        @guest
            <div class="mt-4 p-3 bg-light rounded">
                <h5>Rejoignez-nous !</h5>
                <p>Créez un compte pour adopter un animal ou utiliser nos services.</p>
                <a href="/register" class="btn btn-warning">Créer un compte</a>
                <a href="/login" class="btn btn-outline-secondary">Se connecter</a>
            </div>
        @endguest
    </div>
</div>

{{-- Script pour scroller vers l'animal après connexion --}}
@if(session('scroll_to_animal'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            const animalId = {{ session('scroll_to_animal') }};
            const animalCard = document.querySelector(`[data-animal-id="${animalId}"]`);
            if (animalCard) {
                animalCard.scrollIntoView({ 
                    behavior: 'smooth',
                    block: 'center'
                });
                
                // Effet visuel
                animalCard.style.transition = 'all 0.5s ease';
                animalCard.style.boxShadow = '0 0 20px rgba(0,255,0,0.5)';
                
                setTimeout(() => { animalCard.style.boxShadow = ''; }, 2000);
            }
        }, 500);
    });
</script>
@endif

@endsection