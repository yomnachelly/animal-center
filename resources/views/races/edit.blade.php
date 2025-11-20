@extends('layouts.app')

@section('content')
<h1>Modifier une Race</h1>

<form method="POST" action="{{ route('races.update', $race) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nom</label>
        <input type="text" name="nom" value="{{ $race->nom }}" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Espèce</label>
        <select name="espece_id" class="form-control" required>
            @foreach($especes as $espece)
                <option value="{{ $espece->id }}" @selected($race->espece_id == $espece->id)>
                    {{ $espece->nom }}
                </option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-primary">Modifier</button>
</form>
@endsection
