@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Répondre à la notification</h1>
    <a href="{{ route('client.notifications') }}" class="btn btn-secondary btn-sm">Retour aux notifications</a>
</div>

<div class="card">
    <div class="card-body">
        <p><strong>Expéditeur :</strong> {{ $notification->expediteur->name ?? 'Admin' }}</p>
        <p><strong>Message original :</strong> {{ $notification->contenu }}</p>
        <p><strong>Date :</strong> {{ \Carbon\Carbon::parse($notification->date)->format('d/m/Y H:i') }}</p>

        <form action="{{ route('client.notifications.envoyerReponse', $notification->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="contenu" class="form-label">Votre réponse</label>
                <textarea name="contenu" id="contenu" rows="5" class="form-control @error('contenu') is-invalid @enderror" required>{{ old('contenu') }}</textarea>
                @error('contenu')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Envoyer la réponse</button>
        </form>
    </div>
</div>
@endsection
