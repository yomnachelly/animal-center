<!DOCTYPE html>
<html>
<head>
    <title>Test Adoption</title>
</head>
<body>
    <h1>Test Adoption pour {{ $animal->nom }}</h1>
    <form action="/test-adoption/{{ $animal->id }}" method="POST">
        @csrf
        <button type="submit">Tester l'adoption</button>
    </form>
</body>
</html>