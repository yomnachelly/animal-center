@extends('layouts.app')

@section('content')
<h1>Gestion des Races</h1>

<!-- Message de succès -->
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<a href="{{ route('races.create') }}" class="btn btn-success mb-3">+ Ajouter une race</a>

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Espèce</th>
        <th>Actions</th>
    </tr>

    @foreach($races as $race)
    <tr>
        <td>{{ $race->id }}</td>
        <td>{{ $race->nom }}</td>
        <td>{{ $race->espece->nom }}</td>
        <td>
            <a href="{{ route('races.edit', $race) }}" class="btn btn-primary btn-sm">Modifier</a>

            <form action="{{ route('races.destroy', $race) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm"
                    onclick="return confirm('Voulez-vous vraiment supprimer cette race ?')">
                    Supprimer
                </button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
