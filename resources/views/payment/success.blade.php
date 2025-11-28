@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body text-center p-5">
                    @if($status === 'success')
                        <div class="text-success mb-4">
                            <i class="fas fa-check-circle fa-5x"></i>
                        </div>
                        <h2 class="text-success">Paiement Réussi!</h2>
                        <p class="lead">{{ $message }}</p>
                    @else
                        <div class="text-warning mb-4">
                            <i class="fas fa-clock fa-5x"></i>
                        </div>
                        <h2 class="text-warning">Paiement en Cours</h2>
                        <p class="lead">{{ $message }}</p>
                    @endif
                    
                    <a href="{{ route('client.demandes.hebergement.index') }}" class="btn btn-primary mt-3">
                        Retour à mes hébergements
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection