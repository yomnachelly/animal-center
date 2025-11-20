@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Dashboard vétérinaire</h1>
        <span class="badge bg-danger">Vet</span>
    </div>

    <h3 class="mt-4">Actions rapides</h3>

    <div class="row mt-3 g-3">
        <!-- Bouton Gérer les Soins -->
        <div class="col-md-3">
            <a href="{{ route('vet.soins.index') }}" class="btn btn-primary btn-lg w-100">
                Gérer les soins
            </a>
        </div>

        <!-- Bouton Gérer les Vaccins -->
        <div class="col-md-3">
            <a href="{{ route('vet.vaccins.index') }}" class="btn btn-success btn-lg w-100">
                Gérer les vaccins
            </a>
        </div>
    </div>
    <div>
<a href="{{ route('client.notifications') }}" class="btn btn-info">
    Mes Notifications ({{ auth()->user()->notificationsReceived->count() }})
</a>

</div>

</div>
@endsection
