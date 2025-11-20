<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Animal Center</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>

<nav class="navbar navbar-dark bg-dark p-3">
    <a href="{{ route('home') }}" class="navbar-brand">Animal Center</a>

    <div>
        @auth
            <!-- Affiche le nom de l'utilisateur connecté -->
            <span class="text-light me-3">Bonjour, {{ Auth::user()->name }}</span>

            <!-- Bouton Logout -->
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">Logout</button>
            </form>
        @else
            <!-- Login/Register si personne n'est connecté -->
            <a href="{{ route('login') }}" class="btn btn-light btn-sm me-2">Login</a>
            <a href="{{ route('register') }}" class="btn btn-warning btn-sm">Register</a>
        @endauth
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

</body>
</html>