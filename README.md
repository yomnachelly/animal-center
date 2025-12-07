# 🐾 Animal Center — Plateforme de Services Animaliers

## 📌 À propos du projet

**Animal Center** est une application web dédiée aux services animaliers.  
Elle permet de gérer **l’adoption d’animaux**, **l’hébergement**, ainsi que le **suivi vétérinaire**, tout en facilitant la communication entre les utilisateurs et les administrateurs.

Le projet a été développé avec **Laravel** et son moteur de templates **Blade** afin d’offrir une expérience utilisateur fluide, rapide et intuitive.

---

## ✨ Fonctionnalités

✅ Gestion des demandes d’adoption  
✅ Réservation des services d’hébergement  
✅ Suivi vétérinaire et gestion des consultations  
✅ Paiement en ligne sécurisé  
✅ Envoi automatique d’emails  
✅ Authentification (Admin / Client)

---

## 💳 Paiement en ligne — Stripe

L’application utilise **Stripe** pour permettre des paiements en ligne rapides, sécurisés et fiables lors des réservations d’hébergement.

Stripe permet :
- Des paiements sécurisés  
- La protection des données bancaires  
- La confirmation automatique des transactions  
- Une expérience utilisateur simple et professionnelle  

---

## 🛠️ Technologies utilisées

- **Backend** : Laravel  
- **Frontend** : Blade, HTML, CSS, JavaScript  
- **Base de données** : MySQL  
- **Emails** : Mailtrap  
- **Paiement** : Stripe  

---

## 📦 Installation

```bash
git clone https://github.com/yomnachelly/animal-center.git
cd animal-center
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
