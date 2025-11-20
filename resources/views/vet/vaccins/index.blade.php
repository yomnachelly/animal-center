@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Mes vaccins</h2>
        <a href="{{ route('vet.vaccins.create') }}" class="btn btn-primary">Ajouter un vaccin</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Frais</th>
                <th style="width: 180px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($vaccins as $vaccin)
            <tr>
                <td>{{ $vaccin->nom }}</td>
                <td>{{ $vaccin->frais }} DT</td>
                <td>
                    <a href="{{ route('vet.vaccins.edit', $vaccin->id) }}" class="btn btn-warning btn-sm">Modifier</a>

                    <form action="{{ route('vet.vaccins.destroy', $vaccin->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="3" class="text-center">Aucun vaccin ajouté</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
