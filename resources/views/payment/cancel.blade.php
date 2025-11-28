@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body text-center p-5">
                    <div class="text-danger mb-4">
                        <i class="fas fa-times-circle fa-5x"></i>
                    </div>
                    <h2 class="text-danger">Paiement Annulé</h2>
                    <p class="lead">{{ $message }}</p>
                    
                    <a href="{{ route('client.demandes.hebergement.index') }}" class="btn btn-primary mt-3">
                        Retour à mes hébergements
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body text-center p-5">
                    <div class="text-danger mb-4">
                        <i class="fas fa-times-circle fa-5x"></i>
                    </div>
                    <h2 class="text-danger">Paiement Annulé</h2>
                    <p class="lead">{{ $message }}</p>
                    
                    <a href="{{ route('client.demandes.hebergement.index') }}" class="btn btn-primary mt-3">
                        Retour à mes hébergements
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection