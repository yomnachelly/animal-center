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
        <!-- UTILISEZ LES NOMS DE ROUTES AU LIEU DES URLS DIRECTES -->
        <a href="{{ route('login') }}" class="btn btn-light btn-sm">Login</a>
        <a href="{{ route('register') }}" class="btn btn-warning btn-sm">Register</a>
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

</body>
</html>