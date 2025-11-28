@extends('layouts.app')

@section('content')
<div class="text-center p-5">
    <h2>Paiement Annulé ❌</h2>
    <p>Le paiement n'a pas été finalisé.</p>
    <a href="{{ route('client.demandes.hebergement') }}" class="btn btn-secondary">Retour</a>
</div>
@endsection
