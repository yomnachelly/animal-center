@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Mes notifications</h1>
    <a href="{{ route('client.dashboard') }}" class="btn btn-secondary btn-sm">Retour au Dashboard</a>
</div>

@if($notifications->isEmpty())
    <p>Aucune notification pour le moment.</p>
@else
    <ul class="list-group">
        @foreach($notifications as $notif)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <strong>{{ $notif->expediteur->name ?? 'Admin' }}:</strong>
                    {{ $notif->contenu }}
                    <br>
                    <small class="text-muted">{{ \Carbon\Carbon::parse($notif->date)->format('d/m/Y H:i') }}</small>
                </div>
                <div class="btn-group">
                    <!-- Bouton Répondre -->
                    <a href="{{ route('client.notifications.repondre', $notif->id) }}" class="btn btn-sm btn-primary">Répondre</a>
                    
                    <!-- Bouton Supprimer -->
                    <form action="{{ route('client.notifications.supprimer', $notif->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer cette notification ?')">Supprimer</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
@endif
@endsection
