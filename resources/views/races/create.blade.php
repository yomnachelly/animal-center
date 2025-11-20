@extends('layouts.app')

@section('content')
<h1>Ajouter une Race</h1>

<form method="POST" action="{{ route('races.store') }}">
    @csrf

    <div class="mb-3">
        <label>Nom</label>
        <input type="text" name="nom" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Espèce</label>
        <select name="espece_id" class="form-control" required>
            @foreach($especes as $espece)
                <option value="{{ $espece->id }}">{{ $espece->nom }}</option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-success">Ajouter</button>
</form>
@endsection
