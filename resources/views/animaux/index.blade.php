@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Liste des Animaux</h1>
    <a href="{{ route('animaux.create') }}" class="btn btn-primary">Ajouter un Animal</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Espèce</th>
            <th>Race</th>
            <th>Sexe</th>
            <th>Age</th>
            <th>État santé</th>
            <th>Statut</th>
            <th>Photo</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($animaux as $animal)
            <tr>
                <td>{{ $animal->nom }}</td>
                <td>{{ $animal->espece }}</td>
                <td>{{ $animal->race }}</td>
                <td>{{ $animal->sexe }}</td>
                <td>{{ $animal->age }}</td>
                <td>{{ $animal->etat_sante }}</td>
                <td>{{ $animal->statut }}</td>
                <td>
                    @if($animal->photo)
                        <img src="{{ asset('storage/'.$animal->photo) }}" width="60" alt="Photo de {{ $animal->nom }}">
                    @else
                        <span class="text-muted">Aucune</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('animaux.edit', $animal) }}" class="btn btn-sm btn-warning">Modifier</a>
                    <form action="{{ route('animaux.destroy', $animal) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"
                            onclick="return confirm('Voulez-vous vraiment supprimer cet animal ?')">
                            Supprimer
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
