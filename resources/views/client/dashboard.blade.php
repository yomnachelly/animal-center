@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Dashboard Client</h1>
    <span class="badge bg-info">Client</span>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h5 class="card-title">Adoption</h5>
                <p class="card-text">Voir les animaux disponibles</p>
                <a href="#" class="btn btn-light">Explorer</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5 class="card-title">Mes Demandes</h5>
                <p class="card-text">Suivre mes demandes</p>
                <a href="#" class="btn btn-light">Voir</a>
            </div>
        </div>
    </div>
</div>

<div class="mt-4">
    <h3>Mes informations</h3>
    <div class="card">
        <div class="card-body">
            <p><strong>Nom:</strong> {{ auth()->user()->name }}</p>
            <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
            <p><strong>Téléphone:</strong> {{ auth()->user()->telephone ?? 'Non renseigné' }}</p>
            <p><strong>Adresse:</strong> {{ auth()->user()->adresse ?? 'Non renseignée' }}</p>
        </div>
    </div>
</div>
@endsection