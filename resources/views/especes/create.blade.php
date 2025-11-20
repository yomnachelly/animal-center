@extends('layouts.app')

@section('content')
<h1>Ajouter une Espèce</h1>

<form method="POST" action="{{ route('especes.store') }}">
    @csrf

    <div class="mb-3">
        <label>Nom</label>
        <input type="text" name="nom" class="form-control" required>
    </div>

    <button class="btn btn-success">Ajouter</button>
</form>
@endsection
