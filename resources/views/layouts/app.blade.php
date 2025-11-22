<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animal Center</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        .sidebar {
            min-height: 80vh;
            border-right: 1px solid rgba(0,0,0,.1);
            padding-top: 1rem;
            background-color: #f8f9fa;
        }
        .sidebar a {
            display: block;
            padding: 0.75rem 1rem;
            color: #333;
            text-decoration: none;
            margin-bottom: 0.25rem;
            border-radius: 0.25rem;
        }
        .sidebar a.active, .sidebar a:hover {
            background-color: #0d6efd;
            color: white;
        }
        .notif-badge {
            position: absolute;
            top: 5px;
            right: 3px;
            font-size: 0.7rem;
        }
        .nav-brand { font-weight: 600; letter-spacing: .4px; }
        .dropdown {
    position: relative;
    display: inline-block;
}
.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-menu {
    display: none;
    position: absolute;
    background-color: white;
    min-width: 200px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
    border-radius: 4px;
}

.dropdown-menu a {
    display: block;
    padding: 10px 15px;
    text-decoration: none;
    color: #333;
    border-bottom: 1px solid #eee;
}

.dropdown-menu a:hover {
    background-color: #3811e4ff;
}

/* Classe pour garder le menu ouvert */
.dropdown-menu.show {
    display: block !important;
}

/* Ancien hover - vous pouvez le supprimer ou garder */
.dropdown:hover .dropdown-menu {
    display: block;
}
    </style>
   <script>
    function toggleDropdown() {
    event.preventDefault();
    const menu = document.getElementById('demandesMenu');
    menu.classList.toggle('show');
}

// Fermer le menu si on clique ailleurs sur la page
document.addEventListener('click', function(event) {
    const dropdown = document.getElementById('demandesDropdown');
    const menu = document.getElementById('demandesMenu');
    
    if (!dropdown.contains(event.target)) {
        menu.classList.remove('show');
    }
});
   </script>
</head>
<body>
<nav class="navbar navbar-dark bg-dark p-3">
    <div class="container-fluid">
        <a href="{{ route('home') }}" class="navbar-brand nav-brand">Animal Center</a>
        <div class="d-flex align-items-center position-relative">
            
            @auth
                @php
                    $role = Auth::user()->role ?? 'client';
                    $notifRoute = match($role) {
                        'admin' => 'admin.demandes.index',
                        'vet'   => 'vet.dashboard',
                        default => 'client.notifications',
                    };
                    $notifCollection = Auth::user()->notificationsReceived ?? Auth::user()->notifications ?? collect();
                    $notifCount = $notifCollection->count();
                @endphp

                {{-- Notifications --}}
                <div class="dropdown me-3">
                    <a class="btn btn-secondary btn-sm position-relative dropdown-toggle" href="#" role="button"
                       id="dropdownNotif" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="bi bi-bell"></span> <i class="fa-solid fa-bell fa-shake"></i>

                        @if($notifCount > 0)
                            <span class="badge bg-danger notif-badge">{{ $notifCount }}</span>
                        @endif
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownNotif" style="min-width: 300px;">
                        <li class="dropdown-header">Notifications ({{ $notifCount }})</li>
                        @if($notifCollection->isEmpty())
                            <li class="px-3 py-2">Aucune notification</li>
                        @else
                            @foreach($notifCollection->take(6) as $n)
                                <li>
                                    <a class="dropdown-item" href="{{ route('client.notifications') }}">
                                        {{ $n->data['message'] ?? $n->message ?? Str::limit($n->data['title'] ?? 'Nouvelle notification', 60) }}
                                        <br>
                                        <small class="text-muted">{{ $n->created_at?->diffForHumans() ?? '' }}</small>
                                    </a>
                                </li>
                            @endforeach
                            <li><hr class="dropdown-divider"></li>
                            <li><a  href="{{ route('client.notifications') }}" class="btn btn-info">Voir toutes les notifications</a></li>
                        @endif
                    </ul>
                </div>

                <span class="text-light me-3">Bonjour, {{ Auth::user()->name }}</span>

                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-light btn-sm me-2">Login</a>
                <a href="{{ route('register') }}" class="btn btn-warning btn-sm">Register</a>
            @endauth
        </div>
    </div>
</nav>

<div class="container-fluid mt-4">
    <div class="row">
        {{-- Sidebar dynamique selon rôle --}}
        <div class="col-md-3 sidebar">
            @auth
                @php $role = Auth::user()->role ?? 'client'; @endphp

                @switch($role)
                    @case('admin')
                        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="fa-solid fa-gauge"></i> Dashboard</a>
                        <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}"><i class="fa-solid fa-users"></i> Utilisateurs</a>
                        <a href="{{ route('animaux.index') }}" class="{{ request()->routeIs('animaux.*') ? 'active' : '' }}"><i class="fa-solid fa-horse"></i> Animaux</a>
                        <a href="{{ route('admin.demandes.index') }}" class="{{ request()->routeIs('admin.demandes.*') ? 'active' : '' }}"><i class="fa-solid fa-file-lines"></i> Demandes</a>
                        <a href="{{ route('races.index') }}" class="{{ request()->routeIs('races.*') ? 'active' : '' }}"><i class="fa-solid fa-layer-group"></i> Races</a>
                        <a href="{{ route('especes.index') }}" class="{{ request()->routeIs('especes.*') ? 'active' : '' }}"><i class="fa-solid fa-shapes"></i> Espéces</a>
                        <a href="{{ route('avis.index') }}" class="{{ request()->routeIs('avis.*') ? 'active' : '' }}"><i class="fa-solid fa-star"></i> avis</a>
                        <a href="{{ route('admin.paiements.index') }}" class="{{ request()->routeIs('admin.paiements.*') ? 'active' : '' }}"><i class="fa-solid fa-money-bill-wave"></i> Frais de Paiements</a>
                        @break

                    @case('vet')
                        <a href="{{ route('vet.dashboard') }}" class="{{ request()->routeIs('vet.dashboard') ? 'active' : '' }}"><i class="fa-solid fa-gauge"></i> Dashboard</a>
                        <a href="{{ route('vet.soins.index') }}"class="{{ request()->routeIs('vet.soins.*') ? 'active' : '' }}"><i class="fa-solid fa-hand-holding-medical"></i> Soins</a>
                        <a href="{{ route('vet.vaccins.index') }}" class="{{ request()->routeIs('vet.vaccins.*') ? 'active' : '' }}"><i class="fa-solid fa-syringe"></i> Vaccins</a>
                        <a href="{{ route('vet.rendezvous.index') }}"  class="{{ request()->routeIs('vet.rendezvous.*') ? 'active' : '' }}"><i class="fa-solid fa-calendar-check"></i> rendezvous</a>
                        <a href="{{ route('vet.calendar') }}" class="{{ request()->routeIs('vet.calendar') ? 'active' : '' }}"><i class="fas fa-calendar-alt"></i> Calendrier</a>
                        @break
                        @break

                    @default {{-- client --}}
                        <a href="{{ route('client.dashboard') }}" class="{{ request()->routeIs('client.dashboard') ? 'active' : '' }}"><i class="fa-solid fa-gauge"></i> Dashboard</a>
                        <a href="{{ route('client.notifications') }}" class="{{ request()->routeIs('client.notifications') ? 'active' : '' }}"><i class="fa-solid fa-bell"></i>
 Notifications</a>
                       <a href="{{ route('client.rendez-vous') }}" class="{{ request()->routeIs('client.rendez-vous') ? 'active' : '' }}"><i class="fa-solid fa-calendar-check"></i> mes rendez vous</a>
                       <a href="{{ route('client.avis.index') }}" class="{{ request()->routeIs('client.avis.*') ? 'active' : '' }}"><i class="fa-solid fa-star"></i> Mes Avis</a>
                        <div class="dropdown" id="demandesDropdown">
    <a href="#" class="dropdown-toggle {{ request()->routeIs('client.demandes.*') ? 'active' : '' }}" onclick="toggleDropdown()">
        <i class="fa-solid fa-file-lines"></i> mes demandes
    </a>
    <div class="dropdown-menu" id="demandesMenu">
        <a href="{{ route('client.demandes.adoption') }}" class="{{ request()->routeIs('client.demandes.adoption') ? 'active' : '' }}">
            <i class="fa-solid fa-paw"></i> Adoption
        </a>
        <a href="{{ route('client.demandes.hebergement') }}" class="{{ request()->routeIs('client.demandes.hebergement') ? 'active' : '' }}">
            <i class="fa-solid fa-house-user"></i> Hébergement
        </a>
    </div>
</div>
                @endswitch
            @endauth
        </div>

        {{-- Contenu principal --}}
        <div class="col-md-9">
            @yield('content')
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
