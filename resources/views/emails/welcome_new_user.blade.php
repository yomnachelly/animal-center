@component('mail::message')
# Bienvenue sur TonSite, {{ $user->name }} !

Félicitations et bienvenue sur notre site ! Vous faites désormais partie de notre communauté. Sur notre plateforme, vous pouvez adopter des animaux, réserver un hébergement pour vos compagnons, et suivre le suivi vétérinaire pour leur santé. Nous sommes ravis de vous compter parmi nos clients et espérons que vous apprécierez nos services !

**Vos informations :**
- Nom : {{ $user->name }}
- Email : {{ $user->email }}
- Téléphone : {{ $user->telephone }}
- Adresse : {{ $user->adresse }}

@component('mail::button', ['url' => url('/login')])
Se connecter
@endcomponent

Merci,<br>
L'équipe {{ config('app.name') }}
@endcomponent