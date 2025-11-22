@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mes demandes d'hébergement</h1>
    
    <div class="mb-4">
        <a href="{{ route('client.demandes.hebergement.create') }}" class="btn btn-primary">
            + Nouvelle demande d'hébergement
        </a>
    </div>

    @if($hebergements->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Animal</th>
                        <th>Date début</th>
                        <th>Date fin</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($hebergements as $hebergement)
                    <tr>
                        <td>{{ $hebergement->animal->nom }}</td>
                        <td>{{ \Carbon\Carbon::parse($hebergement->date_debut)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($hebergement->date_fin)->format('d/m/Y') }}</td>
                        <td>
                            @php
                                $etat = optional($hebergement->demande)->etat;
                                $demandeId = optional($hebergement->demande)->id;
                            @endphp
                            <span class="badge
                                @if($etat == 'accepte') bg-success
                                @elseif($etat == 'en attente') bg-warning
                                @elseif($etat == 'rejete') bg-danger
                                @else bg-secondary @endif">
                                {{ $etat ?? '—' }}
                            </span>
                        </td>
                        <td>
                            @if($etat == 'en attente' && $demandeId)
                                <form action="{{ route('client.demandes.hebergement.destroy', $demandeId) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Annuler cette demande ?')">
                                        Annuler
                                    </button>
                                </form>
                            @elseif($etat == 'accepte' && $demandeId)
                                <a href="#" class="btn btn-sm btn-success">
                                    Payer
                                </a>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info">
            Vous n'avez aucune demande d'hébergement pour le moment.
        </div>
    @endif
</div>
@endsection