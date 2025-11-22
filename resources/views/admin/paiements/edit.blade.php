@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Modifier le Frais Journalier</h2>

    <form action="{{ route('admin.paiements.update', $paiement) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="frais_jour">Frais par Jour (€)</label>
            <input type="number" step="0.01" class="form-control" id="frais_jour" 
                   name="frais_jour" value="{{ $paiement->frais_jour }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
        <a href="{{ route('admin.paiements.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection