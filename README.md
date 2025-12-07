<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>🐾 Animal Center — Plateforme de Services Animaliers</title>

  <!-- Tailwind CDN (rapide pour prototype / README visuel) -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Meta for nicer sharing -->
  <meta name="description" content="Animal Center — gestion d'adoption, hébergement, suivi vétérinaire, paiements (Stripe) et envois d'emails (Mailtrap). Projet Laravel + Blade." />
  <style>
    /* Petite personnalisation */
    .emoji { font-size: 1.25rem; line-height: 1; }
    pre { white-space: pre-wrap; }
    .glass {
      background: rgba(255,255,255,0.7);
      backdrop-filter: blur(6px);
    }
  </style>
</head>
<body class="bg-gradient-to-br from-emerald-50 to-cyan-50 min-h-screen text-slate-800">
  <header class="max-w-5xl mx-auto p-6">
    <nav class="flex items-center justify-between">
      <div class="flex items-center gap-3">
        <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-white shadow">
          <span class="emoji">🐾</span>
        </div>
        <div>
          <h1 class="text-2xl font-extrabold">Animal Center</h1>
          <p class="text-sm text-slate-600">Plateforme de services animaliers — adoption, hébergement, suivi vétérinaire</p>
        </div>
      </div>

      <div class="flex items-center gap-3">
        <a href="https://github.com/yomnachelly/animal-center" target="_blank" class="px-4 py-2 bg-slate-800 text-white rounded-md text-sm shadow hover:opacity-95">Voir sur GitHub</a>
      </div>
    </nav>
  </header>

  <main class="max-w-5xl mx-auto p-6">
    <!-- Hero -->
    <section class="glass rounded-2xl p-8 shadow-lg">
      <div class="md:flex md:items-center md:gap-8">
        <div class="md:flex-1">
          <h2 class="text-3xl font-bold mb-2">🐾 Animal Center — Plateforme de Services Animaliers</h2>
          <p class="text-slate-700 mb-4">
            <strong>Animal Center</strong> est une application web développée avec <strong>Laravel</strong> et <strong>Blade</strong>.
            On gère l’adoption d’animaux, l’hébergement, le suivi vétérinaire, et la communication entre utilisateurs et administrateurs.
          </p>

          <div class="flex gap-3 flex-wrap">
            <a class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-emerald-600 text-white hover:opacity-95" href="#fonctionnalites">Fonctionnalités</a>
            <a class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-cyan-600 text-white hover:opacity-95" href="#stripe">Paiement (Stripe)</a>
            <a class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-slate-700 text-white hover:opacity-95" href="#installation">Installation</a>
          </div>
        </div>

        <div class="mt-6 md:mt-0 md:w-1/3">
          <div class="rounded-xl p-4 bg-white shadow text-sm">
            <h3 class="font-semibold mb-2">Statut</h3>
            <p class="text-slate-600">Prototype / MVP — UI en Blade, APIs pour paiements et emails intégrées.</p>
            <ul class="mt-3 text-sm space-y-1 text-slate-700">
              <li>🔧 Backend : Laravel</li>
              <li>💻 Frontend : Blade, HTML, CSS, JS</li>
              <li>🗄️ DB : MySQL</li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- Features -->
    <section id="fonctionnalites" class="mt-8 grid md:grid-cols-3 gap-6">
      <article class="bg-white p-6 rounded-xl shadow">
        <h4 class="text-lg font-bold mb-2">✨ Fonctionnalités principales</h4>
        <ul class="space-y-2 text-slate-700">
          <li>🐶 <strong>Gestion des demandes d’adoption</strong></li>
          <li>🏠 <strong>Réservation des services d’hébergement</strong></li>
          <li>🩺 <strong>Suivi vétérinaire</strong> et gestion des consultations</li>
          <li>💳 <strong>Paiement en ligne sécurisé</strong> pour l’hébergement</li>
          <li>📧 <strong>Envoi automatique d’emails</strong> après inscription / réservation</li>
          <li>🔐 <strong>Authentification</strong> : Admin / Client</li>
        </ul>
      </article>

      <article class="bg-white p-6 rounded-xl shadow">
        <h4 class="text-lg font-bold mb-2">📦 Architecture & Intégrations</h4>
        <p class="text-slate-700 mb-3">On a opté pour une architecture simple et maintenable :</p>
        <ul class="text-slate-700 space-y-2">
          <li>Controllers, Models, Migrations (Laravel)</li>
          <li>Mailtrap pour tests d'e-mails</li>
          <li>Stripe pour paiements (checkout / webhooks)</li>
        </ul>
      </article>

      <article class="bg-white p-6 rounded-xl shadow">
        <h4 class="text-lg font-bold mb-2">🎯 Objectifs</h4>
        <p class="text-slate-700">Offrir une expérience fluide pour les utilisateurs et faciliter la gestion côté admin (demandes, réservations, paiements, communications).</p>
      </article>
    </section>

    <!-- Stripe -->
    <section id="stripe" class="mt-8 bg-white p-6 rounded-xl shadow">
      <h3 class="text-2xl font-bold mb-3">💳 Paiement en ligne – Intégration Stripe</h3>
      <p class="text-slate-700 mb-4">Le projet intègre <strong>Stripe</strong> pour gérer les paiements en ligne de manière sécurisée et fiable — checkout, paiement par carte, et gestion des webhooks pour la confirmation automatique des transactions.</p>

      <div class="grid md:grid-cols-2 gap-4">
        <div>
          <h4 class="font-semibold mb-2">Ce que Stripe apporte</h4>
          <ul class="text-slate-700 space-y-2">
            <li>✅ Paiements rapides et sécurisés</li>
            <li>🔒 Protection des données bancaires (conforme PCI via Stripe)</li>
            <li>🔁 Confirmation automatique des transactions (webhooks)</li>
            <li>✨ Expérience de réservation simple et professionnelle</li>
          </ul>
        </div>

        <div>
          <h4 class="font-semibold mb-2">Exemple rapide d'usage (Laravel)</h4>
          <pre class="rounded-md p-3 bg-slate-100 text-xs text-slate-800 overflow-auto">
use Stripe\Stripe;
use Stripe\Checkout\Session;

Stripe::setApiKey(config('services.stripe.secret'));

$session = Session::create([
  'payment_method_types' => ['card'],
  'line_items' => [
    [
      'price_data' => [
        'currency' => 'eur',
        'product_data' => ['name' => 'Hébergement animal'],
        'unit_amount' => 5000, // en centimes = 50.00€
      ],
      'quantity' => 1,
    ],
  ],
  'mode' => 'payment',
  'success_url' => route('payment.success'),
  'cancel_url' => route('payment.cancel'),
]);

return redirect($session->url);
          </pre>
        </div>
      </div>
    </section>

    <!-- Tech & Install -->
    <section id="installation" class="mt-8 grid md:grid-cols-2 gap-6">
      <article class="bg-white p-6 rounded-xl shadow">
        <h4 class="text-lg font-bold mb-2">🛠️ Technologies utilisées</h4>
        <ul class="text-slate-700 space-y-2">
          <li>🔹 Backend : Laravel</li>
          <li>🔹 Frontend : Blade, HTML, CSS, JavaScript</li>
          <li>🔹 Base de données : MySQL</li>
          <li>🔹 Emails : Mailtrap</li>
          <li>🔹 Paiement : Stripe</li>
        </ul>
      </article>

      <article class="bg-white p-6 rounded-xl shadow">
        <h4 class="text-lg font-bold mb-2">📦 Installation (local)</h4>
        <p class="text-slate-700">Cloner le dépôt, installer les dépendances, configurer l’environnement et lancer le serveur :</p>

        <div class="mt-3 relative">
          <pre id="installCode" class="rounded-md p-4 bg-slate-900 text-slate-100 text-sm overflow-auto">
git clone https://github.com/yomnachelly/animal-center.git
cd animal-center
composer install
npm install
cp .env.example .env
php artisan key:generate
# configurer .env (DB, STRIPE keys, MAIL settings)
php artisan migrate
php artisan serve
          </pre>

          <button id="copyBtn" class="absolute top-3 right-3 bg-emerald-600 text-white px-3 py-1 rounded text-xs hover:opacity-95">Copier</button>
        </div>
      </article>
    </section>

    <!-- Contributors + Footer -->
    <section class="mt-8 bg-white p-6 rounded-xl shadow">
      <div class="md:flex md:justify-between md:items-center">
        <div>
          <h4 class="text-lg font-bold">👩‍💻 Contributeurs</h4>
          <p class="text-slate-700">Yomna Chelly — Riah</p>
        </div>

        <div class="mt-4 md:mt-0">
          <a class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-slate-800 text-white" href="https://github.com/yomnachelly/animal-center" target="_blank">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M12 .5C5.65.5.5 5.65.5 12c0 5.08 3.29 9.39 7.86 10.91.58.11.79-.25.79-.56 0-.28-.01-1.02-.02-2-3.2.7-3.88-1.54-3.88-1.54-.53-1.34-1.3-1.7-1.3-1.7-1.06-.72.08-.71.08-.71 1.17.08 1.78 1.2 1.78 1.2 1.04 1.78 2.72 1.26 3.38.96.11-.75.41-1.26.75-1.55-2.56-.29-5.26-1.28-5.26-5.72 0-1.26.45-2.28 1.19-3.08-.12-.29-.52-1.46.11-3.04 0 0 .97-.31 3.18 1.18.92-.26 1.9-.39 2.88-.39.98 0 1.96.13 2.88.39 2.21-1.49 3.18-1.18 3.18-1.18.63 1.58.23 2.75.11 3.04.74.8 1.19 1.82 1.19 3.08 0 4.45-2.71 5.43-5.29 5.72.42.36.8 1.08.8 2.18 0 1.57-.01 2.84-.01 3.23 0 .32.21.68.8.56C20.71 21.39 24 17.08 24 12c0-6.35-5.15-11.5-12-11.5z"/></svg>
            Voir le dépôt
          </a>
        </div>
      </div>

      <p class="text-xs text-slate-500 mt-4">✨ Développé avec passion pour le bien-être des animaux.</p>
    </section>
  </main>

  <footer class="max-w-5xl mx-auto p-6 text-center text-sm text-slate-500">
    <p>© <span id="year"></span> Animal Center — Projet Laravel & Blade</p>
  </footer>

  <script>
    // copy button
    document.getElementById('copyBtn').addEventListener('click', async () => {
      const text = document.getElementById('installCode').innerText.trim();
      try {
        await navigator.clipboard.writeText(text);
        const btn = document.getElementById('copyBtn');
        const old = btn.innerText;
        btn.innerText = 'Copié ✔';
        setTimeout(()=> btn.innerText = old, 2000);
      } catch(e) {
        alert('Impossible de copier : ' + e.message);
      }
    });

    // year
    document.getElementById('year').innerText = new Date().getFullYear();
  </script>
</body>
</html>





















<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
