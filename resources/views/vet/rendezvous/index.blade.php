@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Rendez-vous</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Animal</th>
                <th>Type</th>
                <th>Date</th>
                <th>État</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rendezvous as $r)
                <tr>
                    <td>{{ $r->id }}</td>
                    <td>{{ $r->user->name }}</td>
                    <td>{{ $r->animal->nom }}</td>
                    <td>
                        @if($r->soins->count())
                            Soins
                        @elseif($r->vaccins->count())
                            Vaccin
                        @endif
                    </td>
                    <td>{{ $r->date }} {{ $r->heure ?? '' }}</td>
                    <td>{{ $r->etat }}</td>
                    <td>
                        <a href="{{ route('vet.rendezvous.show', $r->id) }}" class="btn btn-info btn-sm">Détails</a>

                        @if($r->etat == 'en attente')
                            <form action="{{ route('vet.rendezvous.accept', $r->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button class="btn btn-success btn-sm">Accepter</button>
                            </form>

                            <!-- Formulaire Refuser -->
                            <form action="{{ route('vet.rendezvous.refuse', $r->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="date" name="date" required>
                                <input type="time" name="heure" required>
                                <button class="btn btn-danger btn-sm">Refuser</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection