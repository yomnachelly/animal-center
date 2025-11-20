@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Mes soins</h2>
        <a href="{{ route('vet.soins.create') }}" class="btn btn-primary">Ajouter un soin</a>
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
            @forelse ($soins as $soin)
            <tr>
                <td>{{ $soin->nom }}</td>
                <td>{{ $soin->frais }} DT</td>
                <td>
                    <a href="{{ route('vet.soins.edit', $soin->id) }}" class="btn btn-warning btn-sm">Modifier</a>

                    <form action="{{ route('vet.soins.destroy', $soin->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="3" class="text-center">Aucun soin ajouté</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
