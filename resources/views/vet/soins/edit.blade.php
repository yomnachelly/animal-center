@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2>Modifier le soin</h2>

    <form action="{{ route('vet.soins.update', $soin->id) }}" method="POST" class="mt-3">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nom du soin</label>
            <input type="text" name="nom" class="form-control" value="{{ $soin->nom }}" required>
        </div>

        <div class="mb-3">
            <label>Frais</label>
            <input type="number" step="0.01" name="frais" class="form-control" value="{{ $soin->frais }}" required>
        </div>

        <button class="btn btn-success">Modifier</button>
        <a href="{{ route('vet.soins.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
