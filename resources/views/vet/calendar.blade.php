@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="fas fa-calendar-alt me-2"></i>Mon Calendrier Vétérinaire
                    </h4>
                </div>
                <div class="card-body text-center py-5">
                    
                    <!-- BOUTON CONNEXION GOOGLE CALENDAR -->
                    @if(!Auth::user()->google_calendar_connected)
                    <div class="mb-4">
                        <i class="fab fa-google fa-3x text-primary mb-3"></i>
                        <h3>Connectez Google Calendar</h3>
                        <p class="text-muted">Synchronisez vos rendez-vous automatiquement</p>
                        
                        <a href="{{ route('google.calendar.connect') }}" class="btn btn-primary btn-lg">
                            <i class="fab fa-google me-2"></i>Connecter Google Calendar
                        </a>
                    </div>
                    @else
                    <div class="mb-4">
                        <i class="fas fa-calendar-check fa-3x text-success mb-3"></i>
                        <h3>Google Calendar Connecté !</h3>
                        <p class="text-muted">Vos rendez-vous sont synchronisés</p>
                    </div>
                    @endif

                    <!-- Calendrier simple en attendant -->
                    <div class="mt-4">
                        <h5>Vos rendez-vous à venir</h5>
                        <div class="list-group">
                            @php
                                $rendezvous = \App\Models\Rendezvous::where('user_id', Auth::id())
                                    ->where('etat', 'accepté')
                                    ->where('date', '>=', now())
                                    ->with('animal')
                                    ->orderBy('date')
                                    ->limit(5)
                                    ->get();
                            @endphp
                            
                            @forelse($rendezvous as $rdv)
                            <div class="list-group-item">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <strong>🐾 {{ $rdv->animal->nom }}</strong>
                                        <br>
                                        <small>{{ $rdv->date->format('d/m/Y H:i') }}</small>
                                    </div>
                                    <span class="badge bg-primary">
                                        {{ $rdv->soins->isNotEmpty() ? 'Soin' : 'Vaccin' }}
                                    </span>
                                </div>
                            </div>
                            @empty
                            <div class="list-group-item text-muted">
                                Aucun rendez-vous à venir
                            </div>
                            @endforelse
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection