@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mes Avis</h1>
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4">Tous les avis</h2>
        <a href="{{ route('client.avis.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Donner mon avis
        </a>
    </div>

    <div class="row">
        @forelse($avis as $avi)
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-user me-2"></i>{{ $avi->user->name }}
                        </h5>
                        @if($avi->user_id === Auth::id())
                            <span class="badge bg-info">Mon avis</span>
                        @endif
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ $avi->texte }}</p>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                <i class="fas fa-clock me-1"></i>
                                {{ $avi->created_at ? $avi->created_at->format('d/m/Y à H:i') : 'Date inconnue' }}
                            </small>
                            
                            @if($avi->user_id === Auth::id())
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('client.avis.edit', $avi) }}" class="btn btn-outline-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('client.avis.destroy', $avi) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" 
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet avis?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle me-2"></i>
                    Aucun avis pour le moment. Soyez le premier à donner votre avis !
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection