@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h1>Liste des demandes</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Utilisateur</th>
                <th>Animal</th>
                <th>Type</th>
                <th>État</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach($demandes as $demande)
            <tr>
                <td>{{ $demande->user->name }}</td>
                <td>{{ $demande->animal->nom }}</td>
                <td>{{ ucfirst($demande->type) }}</td>
                <td>{{ ucfirst($demande->etat) }}</td>

                <td>
                    <a href="{{ route('admin.demandes.details', $demande->id) }}" 
                       class="btn btn-info btn-sm">Voir détails</a>

                    <form action="{{ route('admin.demandes.accepter', $demande->id) }}" 
                          method="POST" style="display:inline-block;">
                        @csrf
                        <button class="btn btn-success btn-sm">Accepter</button>
                    </form>

                    <form action="{{ route('admin.demandes.rejeter', $demande->id) }}" 
                          method="POST" style="display:inline-block;">
                        @csrf
                        <button class="btn btn-danger btn-sm">Rejeter</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
