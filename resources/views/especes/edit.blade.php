@extends('layouts.app')

@section('content')
<h1>Modifier une Espèce</h1>

<form method="POST" action="{{ route('especes.update', $espece) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nom</label>
        <input type="text" name="nom" class="form-control" value="{{ $espece->nom }}" required>
    </div>

    <button class="btn btn-primary">Modifier</button>
</form>
@endsection
