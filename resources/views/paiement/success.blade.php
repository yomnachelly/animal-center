@extends('layouts.app')

@section('content')
<div class="text-center p-5">
    <h2>Paiement Réussi ✔️</h2>
    <p>Merci ! Le paiement a été effectué avec succès.</p>
    <a href="{{ route('client.demandes.hebergement') }}" class="btn btn-primary">Retour</a>
</div>
@endsection
