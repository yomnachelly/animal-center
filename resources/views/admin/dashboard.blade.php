@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Dashboard Administrateur</h1>
    <span class="badge bg-danger">Admin</span>
</div>

<div class="row">
    <div class="col-md-3 mb-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h5 class="card-title">Utilisateurs</h5>
                <p class="card-text">Gérer les comptes</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5 class="card-title">Animaux</h5>
                <p class="card-text">Gérer les animaux</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card bg-warning text-dark">
            <div class="card-body">
                <h5 class="card-title">Demandes</h5>
                <p class="card-text">Voir les demandes</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card bg-info text-white">
            <div class="card-body">
                <h5 class="card-title">Rapports</h5>
                <p class="card-text">Statistiques</p>
            </div>
        </div>
    </div>
</div>

<div class="mt-4">
    <h3>Actions rapides</h3>
    <div class="d-grid gap-2 d-md-block">
        <button class="btn btn-primary">Ajouter un animal</button>
        <button class="btn btn-success">Voir les utilisateurs</button>
        <button class="btn btn-warning">Gérer les demandes</button>
    </div>
</div>
@endsection