@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2>Modifier le vaccin</h2>

    <form action="{{ route('vet.vaccins.update', $vaccin->id) }}" method="POST" class="mt-3">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nom du vaccin</label>
            <input type="text" name="nom" class="form-control" value="{{ $vaccin->nom }}" required>
        </div>

        <div class="mb-3">
            <label>Frais</label>
            <input type="number" step="0.01" name="frais" class="form-control" value="{{ $vaccin->frais }}" required>
        </div>

        <button class="btn btn-success">Modifier</button>
        <a href="{{ route('vet.vaccins.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
