@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-4">
        <h1>Gestion des Utilisateurs</h1>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Ajouter un utilisateur</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Role</th>
                <th>Téléphone</th>
                <th>Adresse</th>
                <th>Verrouillé</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>{{ $user->telephone ?? '-' }}</td>
                <td>{{ $user->adresse ?? '-' }}</td>
                <td>{{ $user->verrouiller ? 'Oui' : 'Non' }}</td>
                <td>
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-warning">Modifier</a>

                    @if(!$user->verrouiller)
                        <form action="{{ route('admin.users.verrouiller', $user) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-sm btn-secondary">Verrouiller</button>
                        </form>
                    @else
                        <form action="{{ route('admin.users.deverrouiller', $user) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-sm btn-success">Déverrouiller</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
