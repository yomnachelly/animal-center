@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Dashboard Client</h1>
    <span class="badge bg-info">Client</span>
</div>


<div>
<a href="{{ route('client.notifications') }}" class="btn btn-info">
    Mes Notifications ({{ auth()->user()->notificationsReceived->count() }})
</a>
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


<div class="mt-4">
    
</div>
@endsection
