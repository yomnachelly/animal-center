@extends('layouts.app')

@section('content')

<h1 class="mb-4">Bienvenue au Refuge Animalier</h1>

<div class="row">
    <div class="col-md-8">
        <h2 class="mb-4">Animaux à adopter</h2>
        
        <div class="row">
            @if(isset($featuredAnimals) && $featuredAnimals->count() > 0)
                @foreach($featuredAnimals as $animal)
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $animal->name }}</h5>
                                <p class="card-text">
                                    <strong>Espèce:</strong> {{ $animal->espece }}<br>
                                    <strong>Race:</strong> {{ $animal->race ?? 'Non spécifiée' }}<br>
                                    <strong>Âge:</strong> {{ $animal->age ?? 'Non spécifié' }}
                                </p>
                                <p class="card-text">{{ $animal->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12">
                    <div class="alert alert-info">
                        Aucun animal disponible pour le moment. Revenez bientôt !
                    </div>
                </div>
            @endif
        </div>
    </div>
    
    <div class="col-md-4">
        <h2 class="mb-4">Services disponibles</h2>
        
        <div class="list-group">
            <div class="list-group-item">Soin vétérinaire</div>
            <div class="list-group-item">Vaccination</div>
            <div class="list-group-item">Hébergement</div>
            <div class="list-group-item">Adoption</div>
            <div class="list-group-item">Conseils animaliers</div>
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

@endsection