@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Détails du Rendez-vous #{{ $rendezvous->id }}</h1>

    <p><strong>Client :</strong> {{ $rendezvous->user->name }}</p>
    <p><strong>Animal :</strong> {{ $rendezvous->animal->nom }}</p>
    <p><strong>Type :</strong>
        @if($rendezvous->soins->count())
            Soins
            <ul>
                @foreach($rendezvous->soins as $s)
                    <li>{{ $s->nom }}</li>
                @endforeach
            </ul>
        @elseif($rendezvous->vaccins->count())
            Vaccins
            <ul>
                @foreach($rendezvous->vaccins as $v)
                    <li>{{ $v->nom }}</li>
                @endforeach
            </ul>
        @endif
    </p>
    <p><strong>Date :</strong> {{ $rendezvous->date }} {{ $rendezvous->heure ?? '' }}</p>
    <p><strong>État :</strong> {{ $rendezvous->etat }}</p>

    <a href="{{ route('vet.rendezvous.index') }}" class="btn btn-secondary">Retour</a>
</div>
@endsection