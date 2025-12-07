<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>🐾 Animal Center — Plateforme de Services Animaliers</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800 font-sans">

  <header class="bg-white shadow mb-6">
    <div class="max-w-5xl mx-auto p-6 flex justify-between items-center">
      <h1 class="text-2xl font-bold">🐾 Animal Center</h1>
      <a href="https://github.com/yomnachelly/animal-center" 
         target="_blank"
         class="bg-black text-white px-4 py-2 rounded">
        Voir sur GitHub
      </a>
    </div>
  </header>

  <main class="max-w-5xl mx-auto p-6">

    <section class="bg-white p-6 rounded shadow mb-6">
      <h2 class="text-2xl font-bold mb-2">Plateforme de Services Animaliers</h2>
      <p class="text-gray-700">
        Animal Center est une application web développée avec Laravel et Blade.
        Elle permet de gérer l’adoption d’animaux, l’hébergement, le suivi vétérinaire
        et la communication entre les utilisateurs et les administrateurs.
      </p>
    </section>

    <section class="bg-white p-6 rounded shadow mb-6">
      <h3 class="text-xl font-bold mb-4">✨ Fonctionnalités</h3>
      <ul class="list-disc pl-5 space-y-2">
        <li>🐶 Gestion des demandes d’adoption</li>
        <li>🏠 Réservation des services d’hébergement</li>
        <li>🩺 Suivi vétérinaire</li>
        <li>💳 Paiement en ligne sécurisé</li>
        <li>📧 Envoi automatique d’emails</li>
        <li>🔐 Authentification (Admin / Client)</li>
      </ul>
    </section>

    <section class="bg-white p-6 rounded shadow mb-6">
      <h3 class="text-xl font-bold mb-2">💳 Paiement en ligne – Stripe</h3>
      <p class="text-gray-700">
        L’application utilise Stripe pour permettre des paiements rapides, sécurisés
        et fiables lors des réservations d’hébergement.
      </p>
    </section>

    <section class="bg-white p-6 rounded shadow mb-6">
      <h3 class="text-xl font-bold mb-4">🛠️ Technologies utilisées</h3>
      <ul class="list-disc pl-5 space-y-2">
        <li>Laravel</li>
        <li>Blade, HTML, CSS, JavaScript</li>
        <li>MySQL</li>
        <li>Mailtrap</li>
        <li>Stripe</li>
      </ul>
    </section>

    <section class="bg-white p-6 rounded shadow">
      <h3 class="text-xl font-bold mb-4">📦 Installation</h3>
      <pre class="bg-gray-900 text-white p-4 rounded text-sm">
git clone https://github.com/yomnachelly/animal-center.git
cd animal-center
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
      </pre>
    </section>

  </main>

</body>
</html>
