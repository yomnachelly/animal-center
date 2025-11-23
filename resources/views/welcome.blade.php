<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Refuge Animalier - Animal Center</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2c5530;
            --secondary-color: #4a7c59;
            --accent-color: #8fb996;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
        }
        
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .hero-section {
            background: linear-gradient(rgba(44, 85, 48, 0.8), rgba(44, 85, 48, 0.9)), url('https://images.unsplash.com/photo-1450778869180-41d0601e046e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 80px 0;
            margin-bottom: 40px;
            border-radius: 0 0 20px 20px;
        }
        
        .hero-section h1 {
            font-weight: 700;
            font-size: 3rem;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        
        .hero-section p {
            font-size: 1.2rem;
            max-width: 600px;
            margin: 0 auto 30px;
        }
        
        .btn-hero {
            background-color: white;
            color: var(--primary-color);
            padding: 12px 30px;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-hero:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
        
        .section-title {
            position: relative;
            margin-bottom: 30px;
            padding-bottom: 15px;
            font-weight: 700;
            color: var(--primary-color);
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background-color: var(--accent-color);
            border-radius: 2px;
        }
        
        .animal-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            height: 100%;
        }
        
        .animal-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }
        
        .animal-img-container {
            height: 200px;
            overflow: hidden;
            position: relative;
        }
        
        .animal-img-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .animal-card:hover .animal-img-container img {
            transform: scale(1.1);
        }
        
        .animal-card .card-body {
            padding: 20px;
        }
        
        .animal-card .card-title {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 10px;
        }
        
        .animal-card .card-text {
            font-size: 0.9rem;
            color: #666;
        }
        
        .animal-card .card-footer {
            background-color: white;
            border-top: 1px solid rgba(0,0,0,0.05);
            padding: 15px 20px;
        }
        
        .btn-adopt {
            background-color: var(--primary-color);
            color: white;
            border-radius: 30px;
            padding: 8px 20px;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .btn-adopt:hover {
            background-color: var(--secondary-color);
            color: white;
        }
        
        .review-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            height: 100%;
        }
        
        .review-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.12);
        }
        
        .user-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.2rem;
        }
        
        .services-list .list-group-item {
            border: none;
            padding: 15px 20px;
            margin-bottom: 10px;
            border-radius: 10px;
            background-color: white;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
            transition: all 0.3s;
            display: flex;
            align-items: center;
        }
        
        .services-list .list-group-item:hover {
            transform: translateX(5px);
            background-color: var(--accent-color);
            color: white;
        }
        
        .services-list .list-group-item i {
            margin-right: 10px;
            color: var(--primary-color);
        }
        
        .services-list .list-group-item:hover i {
            color: white;
        }
        
        .stats-box {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 15px;
            color: white;
            padding: 25px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
        .stats-box h5 {
            margin-bottom: 20px;
            font-weight: 600;
        }
        
        .stats-box h4 {
            font-weight: 700;
            margin-bottom: 5px;
        }
        
        .stats-box small {
            opacity: 0.9;
        }
        
        .join-box {
            background-color: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.08);
            text-align: center;
        }
        
        .join-box h5 {
            color: var(--primary-color);
            margin-bottom: 15px;
            font-weight: 600;
        }
        
        .btn-register {
            background-color: var(--primary-color);
            color: white;
            border-radius: 30px;
            padding: 10px 25px;
            font-weight: 500;
            margin-right: 10px;
        }
        
        .btn-login {
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            border-radius: 30px;
            padding: 10px 25px;
            font-weight: 500;
        }
        
        .alert-success {
            border-radius: 10px;
            border-left: 5px solid var(--primary-color);
        }
        
        /* Styles pour les soins et vaccins */
        .care-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            height: 100%;
            background: white;
        }
        
        .care-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.12);
        }
        
        .care-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 15px;
        }
        
        .care-icon.soin {
            background: linear-gradient(135deg, #17a2b8, #138496);
            color: white;
        }
        
        .care-icon.vaccin {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
        }
        
        .vet-info {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 12px;
            margin-top: 15px;
        }
        
        .vet-name {
            font-weight: 600;
            color: var(--primary-color);
        }
        
        .price-tag {
            background: linear-gradient(135deg, #ffc107, #ffb300);
            color: #212529;
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
            display: inline-block;
        }
        
        .care-type-badge {
            padding: 4px 10px;
            border-radius: 15px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .badge-soin {
            background-color: #17a2b8;
            color: white;
        }
        
        .badge-vaccin {
            background-color: #28a745;
            color: white;
        }
        
        @media (max-width: 768px) {
            .hero-section {
                padding: 50px 0;
            }
            
            .hero-section h1 {
                font-size: 2.2rem;
            }
            
            .animal-img-container {
                height: 180px;
            }
        }
    </style>
</head>
<body>

@extends('layouts.app')

@section('content')

{{-- Section Hero --}}
<div class="hero-section text-center">
    <h1>Bienvenue au Refuge Animalier</h1>
    <p>Donnez une seconde chance à un animal dans le besoin. Adoptez, soignez, aimez.</p>
    <a href="#animaux" class="btn btn-hero">Voir les animaux à adopter</a>
</div>

{{-- Message de succès après connexion --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="container mt-4">
    <div class="row">
        {{-- Colonne principale : Soins/Vaccins, Animaux et Avis --}}
        <div class="col-md-8">



            {{-- Section des animaux à adopter --}}
            <div class="mt-5" id="animaux">
                <h2 class="section-title">Animaux à adopter</h2>

                @if($featuredAnimals->count() > 0)
                    <div class="row">
                        @foreach($featuredAnimals as $animal)
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card animal-card h-100" data-animal-id="{{ $animal->id }}">
                                    <div class="animal-img-container">
                                        @if($animal->photo)
                                            <img src="{{ asset('storage/' . $animal->photo) }}" class="card-img-top" alt="{{ $animal->nom }}">
                                        @else
                                            <img src="{{ asset('images/default-animal.png') }}" class="card-img-top" alt="{{ $animal->nom }}">
                                        @endif
                                    </div>

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
                                                    <button type="submit" class="btn btn-adopt" 
                                                        onclick="return confirm('Êtes-vous sûr de vouloir faire une demande d\\'adoption pour {{ $animal->nom }} ?')">
                                                        <i class="fas fa-heart me-1"></i> Demander
                                                    </button>
                                                </form>
                                            @endif
                                        @else
                                            <a href="{{ route('login') }}" class="btn btn-adopt">
                                                <i class="fas fa-heart me-1"></i> Demander
                                            </a>
                                            <small class="d-block text-muted mt-1">Connectez-vous pour adopter</small>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('animaux.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-paw me-1"></i> Voir tous les animaux
                        </a>
                    </div>
                @else
                    <div class="alert alert-info text-center">
                        <i class="fas fa-info-circle me-2"></i>
                        Aucun animal disponible pour le moment.
                    </div>
                @endif
            </div>
            {{-- Section des soins et vaccins --}}
            <div class="mt-5" id="soins-vaccins">
                <h2 class="section-title">Soins et Vaccinations</h2>
                
                <div class="row">
                    {{-- Soins --}}
                    <div class="col-md-6 mb-4">
                        <div class="card care-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div class="care-icon soin">
                                        <i class="fas fa-stethoscope"></i>
                                    </div>
                                    <span class="care-type-badge badge-soin">Soin</span>
                                </div>
                                <h5 class="card-title">Soins Vétérinaires</h5>
                                <p class="card-text">Nos services de soins complets pour vos animaux</p>
                                
                                <div class="mt-3">
                                    @php
                                        $soins = App\Models\Soin::with('vet')->get();
                                    @endphp
                                    
                                    @if($soins->count() > 0)
                                        @foreach($soins as $soin)
                                            <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                                <div>
                                                    <h6 class="mb-1">{{ $soin->nom }}</h6>
                                                    @if($soin->vet)
                                                        <small class="text-muted">
                                                            <i class="fas fa-user-md me-1"></i>
                                                            Dr. {{ $soin->vet->name }}
                                                        </small>
                                                    @else
                                                        <small class="text-muted">
                                                            <i class="fas fa-user-md me-1"></i>
                                                            Vétérinaire non assigné
                                                        </small>
                                                    @endif
                                                </div>
                                                <span class="price-tag">{{ number_format($soin->frais, 2, ',', ' ') }} DT</span>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="text-center text-muted py-3">
                                            <i class="fas fa-info-circle me-2"></i>
                                            Aucun soin disponible pour le moment.
                                        </div>
                                    @endif
                                </div>
                                
                                @auth
                                    <div class="text-center mt-3">
                                        <a href="{{ route('vet.soins.index') }}" class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-plus me-1"></i> Prendre rendez-vous
                                        </a>
                                    </div>
                                @endauth
                            </div>
                        </div>
                    </div>
                    
                    {{-- Vaccins --}}
                    <div class="col-md-6 mb-4">
                        <div class="card care-card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div class="care-icon vaccin">
                                        <i class="fas fa-syringe"></i>
                                    </div>
                                    <span class="care-type-badge badge-vaccin">Vaccin</span>
                                </div>
                                <h5 class="card-title">Vaccinations</h5>
                                <p class="card-text">Protégez votre animal avec nos vaccins essentiels</p>
                                
                                <div class="mt-3">
                                    @php
                                        $vaccins = App\Models\Vaccin::with('vet')->get();
                                    @endphp
                                    
                                    @if($vaccins->count() > 0)
                                        @foreach($vaccins as $vaccin)
                                            <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                                <div>
                                                    <h6 class="mb-1">{{ $vaccin->nom }}</h6>
                                                    @if($vaccin->vet)
                                                        <small class="text-muted">
                                                            <i class="fas fa-user-md me-1"></i>
                                                            Dr. {{ $vaccin->vet->name }}
                                                        </small>
                                                    @else
                                                        <small class="text-muted">
                                                            <i class="fas fa-user-md me-1"></i>
                                                            Vétérinaire non assigné
                                                        </small>
                                                    @endif
                                                </div>
                                                <span class="price-tag">{{ number_format($vaccin->frais, 2, ',', ' ') }} DT</span>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="text-center text-muted py-3">
                                            <i class="fas fa-info-circle me-2"></i>
                                            Aucun vaccin disponible pour le moment.
                                        </div>
                                    @endif
                                </div>
                                
                                @auth
                                    <div class="text-center mt-3">
                                        <a href="{{ route('vet.vaccins.index') }}" class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-syringe me-1"></i> Vacciner mon animal
                                        </a>
                                    </div>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Section des avis --}}
            <div class="mt-5">
                <h2 class="section-title">Avis de nos clients</h2>

                @if($derniersAvis->count() > 0)
                    <div class="row">
                        @foreach($derniersAvis as $avis)
                            <div class="col-md-6 mb-4">
                                <div class="card review-card h-100">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="user-avatar me-3">
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
                                <i class="fas fa-star me-1"></i> Voir tous les avis
                            </a>
                        </div>
                    @endauth
                @else
                    <div class="alert alert-info text-center">
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
            <h2 class="section-title">Services disponibles</h2>

            <div class="list-group services-list">
                <div class="list-group-item"><i class="fas fa-stethoscope"></i> Soin vétérinaire</div>
                <div class="list-group-item"><i class="fas fa-syringe"></i> Vaccination</div>
                <div class="list-group-item"><i class="fas fa-home"></i> Hébergement</div>
                <div class="list-group-item"><i class="fas fa-heart"></i> Adoption</div>
                <div class="list-group-item"><i class="fas fa-comments"></i> Conseils animaliers</div>
            </div>

            {{-- Statistiques --}}
            <div class="stats-box mt-4">
                <h5>Notre Refuge en Chiffres</h5>
                <div class="row text-center">
                    <div class="col-6">
                        <div class="p-2">
                            <h4 class="mb-1">{{ App\Models\Animal::count() }}</h4>
                            <small>Total des animaux</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-2">
                            <h4 class="mb-1">{{ App\Models\Avis::count() }}</h4>
                            <small>Avis clients</small>
                        </div>
                    </div>
                </div>
            </div>

            @guest
                <div class="join-box mt-4">
                    <h5>Rejoignez-nous !</h5>
                    <p>Créez un compte pour adopter un animal ou utiliser nos services.</p>
                    <a href="/register" class="btn btn-register">Créer un compte</a>
                    <a href="/login" class="btn btn-login">Se connecter</a>
                </div>
            @endguest
        </div>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>