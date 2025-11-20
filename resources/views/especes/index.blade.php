@extends('layouts.app')

@section('content')
<h1>Gestion des Espèces</h1>
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<a href="{{ route('especes.create') }}" class="btn btn-success mb-3">+ Ajouter une espèce</a>

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Actions</th>
    </tr>

    @foreach($especes as $espece)
    <tr>
        <td>{{ $espece->id }}</td>
        <td>{{ $espece->nom }}</td>
        <td>
            <a href="{{ route('especes.edit', $espece) }}" class="btn btn-primary btn-sm">Modifier</a>

            <form action="{{ route('especes.destroy', $espece) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer cette espèce ?')">Supprimer</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
