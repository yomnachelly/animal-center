@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h1 class="mb-4">Liste des avis</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($avis->isEmpty())
        <div class="alert alert-info">Aucun avis pour le moment.</div>
    @else

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Utilisateur</th>
                <th>Avis</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($avis as $a)
                <tr>
                    <td>{{ $a->id }}</td>
                    <td>{{ $a->user ? $a->user->name : 'Utilisateur supprimé' }}</td>
                    <td>{{ $a->texte }}</td>
                   <td>{{ optional($a->created_at)->format('d/m/Y H:i') ?? '-' }}</td>
                    <td>
                        <!-- Bouton suppression -->
                        <form action="{{ route('avis.destroy', $a->id) }}" method="POST" onsubmit="return confirm('Supprimer cet avis ?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>

    @endif

</div>
@endsection