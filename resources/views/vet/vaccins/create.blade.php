@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2>Ajouter un vaccin</h2>

    <form action="{{ route('vet.vaccins.store') }}" method="POST" class="mt-3">
        @csrf

        <div class="mb-3">
            <label>Nom du vaccin</label>
            <input type="text" name="nom" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Frais</label>
            <input type="number" step="0.01" name="frais" class="form-control" required>
        </div>

        <button class="btn btn-success">Enregistrer</button>
        <a href="{{ route('vet.vaccins.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
