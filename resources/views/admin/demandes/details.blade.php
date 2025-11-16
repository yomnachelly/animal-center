@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2>Détails de la demande #{{ $demande->id }}</h2>

    <p><strong>Utilisateur :</strong> {{ $demande->user->name }}</p>
    <p><strong>Animal :</strong> {{ $demande->animal->nom }}</p>
    <p><strong>Type :</strong> {{ ucfirst($type) }}</p>
    <p><strong>État :</strong> {{ ucfirst($demande->etat) }}</p>

    <hr>

    @if($type == 'adoption')
        <h4>Informations d'adoption</h4>
        <p><strong>Date :</strong> {{ $details->date }}</p>

    @elseif($type == 'hebergement')
        <h4>Informations d'hébergement</h4>
        <p><strong>Date début :</strong> {{ $details->date_debut }}</p>
        <p><strong>Date fin :</strong> {{ $details->date_fin }}</p>
        <p><strong>Frais :</strong> {{ $details->frais }} DT</p>

    @else
        <p>Aucun détail supplémentaire.</p>
    @endif

</div>
@endsection
