@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mes rendez-vous</h1>
    
    <div class="mb-4">
        <a href="{{ route('client.rendez-vous.create') }}" class="btn btn-primary">
            + Nouveau rendez-vous
        </a>
    </div>

    @if($rendezvous->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Animal</th>
                        <th>Date</th>
                        <th>Statut</th>
                        <th>Soins</th>
                        <th>Vaccins</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rendezvous as $rdv)
                    <tr>
                        <td>{{ $rdv->animal->nom }}</td>
                        <td>{{ \Carbon\Carbon::parse($rdv->date)->format('d/m/Y') }}</td>
                        <td>
                            <span class="badge 
                                @if($rdv->etat == 'accepté') bg-success
                                @elseif($rdv->etat == 'en attente') bg-warning
                                @elseif($rdv->etat == 'rejeté') bg-danger
                                @else bg-secondary @endif">
                                {{ $rdv->etat }}
                            </span>
                        </td>
                        <td>
                            @if($rdv->soins->count() > 0)
                                <ul class="list-unstyled mb-0">
                                    @foreach($rdv->soins as $soin)
                                        <li><small>{{ $soin->nom }}</small></li>
                                    @endforeach
                                </ul>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td>
                            @if($rdv->vaccins->count() > 0)
                                <ul class="list-unstyled mb-0">
                                    @foreach($rdv->vaccins as $vaccin)
                                        <li><small>{{ $vaccin->nom }}</small></li>
                                    @endforeach
                                </ul>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td>
                            @if($rdv->etat == 'en attente')
                                <form action="{{ route('client.rendez-vous.annuler', $rdv->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('Voulez-vous vraiment annuler ce rendez-vous ?')">
                                        Annuler
                                    </button>
                                </form>
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
            Vous n'avez aucun rendez-vous pour le moment.
        </div>
    @endif
</div>
@endsection