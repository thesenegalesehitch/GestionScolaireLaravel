# 🏦 Système Bancaire - Documentation Complète

## 📋 Vue d'ensemble

Ce projet est une application web bancaire développée avec Laravel, permettant la gestion de comptes bancaires, de contacts et de transferts d'argent. L'application est entièrement localisée pour le Sénégal avec utilisation de la monnaie FCFA.

## 🛠️ Technologies Utilisées

- **Framework**: Laravel 11.x
- **Base de données**: SQLite
- **Frontend**: Bootstrap 5 + Tailwind CSS
- **Authentification**: Laravel Breeze
- **Langage**: PHP 8.x
- **Monnaie**: FCFA (Francs CFA)

## 📁 Structure du Projet

### Modèles (app/Models/)

#### User
- Représente un utilisateur du système bancaire
- Relations: comptes, contacts, transferts

#### Compte
- Représente un compte bancaire
- Attributs: rib, user_id, solde
- Méthodes: deposer(), retirer(), generateUniqueRib()

#### Contact
- Représente un contact bancaire de l'utilisateur
- Attributs: user_id, first_name, last_name, phone, address, rib
- Accesseur: getFullNameAttribute()

#### Transfert
- Représente une transaction de transfert
- Attributs: montant, rib_source, rib_destination, user_id, contact_name, contact_email
- Méthode: execute() - Effectue le transfert avec vérification des soldes

### Contrôleurs (app/Http/Controllers/)

#### AuthController
- Gestion de l'authentification utilisateur

#### CompteController
- `index()`: Liste des comptes de l'utilisateur
- `create()`: Formulaire de création de compte
- `store()`: Création d'un nouveau compte
- `show($id)`: Détails d'un compte
- `deposer(Request $request, Compte $compte)`: Dépôt d'argent

#### ContactController
- `index()`: Liste des contacts
- `create()`: Formulaire de création de contact
- `store()`: Sauvegarde d'un nouveau contact
- `show($id)`: Détails d'un contact
- `edit($id)`: Formulaire d'édition
- `update()`: Mise à jour d'un contact
- `destroy($id)`: Suppression d'un contact

#### TransfertController
- `index()`: Liste des transferts de l'utilisateur
- `create(Request $request)`: Formulaire de transfert
- `store(Request $request)`: Exécution du transfert

### Vues (resources/views/)

#### Layouts
- `app.blade.php`: Layout principal avec navigation
- `guest.blade.php`: Layout pour les pages publiques

#### Authentification
- `login.blade.php`: Connexion
- `register.blade.php`: Inscription
- `dashboard.blade.php`: Tableau de bord

#### Comptes
- `index.blade.php`: Liste des comptes
- `create.blade.php`: Création de compte
- `show.blade.php`: Détails du compte

#### Contacts
- `index.blade.php`: Liste des contacts
- `create.blade.php`: Création de contact
- `edit.blade.php`: Édition de contact
- `show.blade.php`: Détails du contact

#### Transferts
- `index.blade.php`: Historique des transferts
- `create.blade.php`: Formulaire de transfert

## 🗄️ Base de Données

### Tables

#### users
- id, name, email, email_verified_at, password, remember_token, created_at, updated_at

#### comptes
- id, rib, user_id, solde, created_at, updated_at

#### contacts
- id, user_id, first_name, last_name, phone, address, rib, created_at, updated_at

#### transferts
- id, montant, rib_source, rib_destination, user_id, contact_name, contact_email, created_at, updated_at

### Migrations
- `0001_01_01_000000_create_users_table.php`: Création table users
- `2025_10_15_085125_create_comptes_table.php`: Création table comptes
- `2025_10_15_085229_create_transferts_table.php`: Création table transferts
- `2025_10_21_201720_add_solde_to_comptes_table.php`: Ajout colonne solde
- `2025_10_21_201903_add_user_and_contact_fields_to_transferts_table.php`: Ajout colonnes user et contact
- `2025_10_21_203927_create_contacts_table.php`: Création table contacts

## 🚀 Fonctionnalités

### Authentification
- Inscription d'utilisateurs
- Connexion/Déconnexion
- Protection des routes

### Gestion des Comptes
- Création de comptes avec RIB unique (format: SN-XXXXXX)
- Consultation du solde
- Dépôt d'argent
- Affichage du propriétaire du compte

### Gestion des Contacts
- Ajout de contacts bancaires
- Modification des contacts
- Suppression des contacts
- Association avec des comptes existants

### Transferts d'Argent
- Transfert vers des contacts
- Vérification automatique du solde
- Historique des transferts
- Compte source automatiquement sélectionné

## 🔧 Configuration

### Variables d'environnement (.env)
```env
APP_NAME="Système Bancaire"
APP_ENV=local
APP_KEY=base64:key
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database/database.sqlite

MAIL_MAILER=log
```

### Installation
```bash
# Cloner le projet
git clone <repository-url>
cd projetdbe

# Installer les dépendances
composer install
npm install

# Configurer l'environnement
cp .env.example .env
php artisan key:generate

# Créer la base de données
touch database/database.sqlite

# Exécuter les migrations
php artisan migrate

# Compiler les assets
npm run build

# Démarrer le serveur
php artisan serve
```

## 🎨 Interface Utilisateur

### Design
- **Framework CSS**: Bootstrap 5
- **Icônes**: Font Awesome
- **Style personnalisé**: Tailwind CSS
- **Responsive**: Design adaptatif mobile

### Navigation
- Dashboard avec aperçu des comptes
- Menu latéral avec accès aux fonctionnalités
- Breadcrumbs pour la navigation

### Formulaires
- Validation côté client et serveur
- Messages d'erreur en français
- Auto-remplissage des champs (transferts)

## 🔒 Sécurité

### Authentification
- Hashage des mots de passe (bcrypt)
- Protection CSRF sur tous les formulaires
- Sessions sécurisées

### Autorisation
- Vérification de propriété des comptes
- Accès limité aux propres données
- Validation des montants

### Validation
- Vérification des soldes avant transferts
- Validation des formats RIB
- Sanitisation des entrées

## 🌍 Localisation

### Langue
- Interface en français
- Messages d'erreur en français

### Monnaie
- FCFA (Francs CFA)
- Formatage sénégalais (espaces comme séparateurs de milliers)
- Montants entiers (pas de centimes)

### Données
- Noms sénégalais authentiques
- Adresses de Dakar
- Numéros de téléphone sénégalais (format 77xxxxxxxx)

## 📊 Données de Test

### Comptes
- Tous les comptes démarrent avec 1.000.000 FCFA
- RIBs uniques générés automatiquement

### Contacts
1. Abdou Aziz Kane - Ouest Foire
2. Mactar Ndiaye - Mariste
3. Djibril Sow - Thies
4. Fatoumata Soumaré - Apix
5. Fatima Camara - Rufisque

### Transferts
- Vérification automatique des soldes
- Historique complet des transactions
- Logging détaillé pour le débogage

## 🐛 Débogage

### Logs
- Fichier: `storage/logs/laravel.log`
- Niveau: INFO pour les transferts
- Détails: soldes avant/après, vérifications

### Commandes utiles
```bash
# Vider les logs
truncate -s 0 storage/logs/laravel.log

# Voir les logs en temps réel
tail -f storage/logs/laravel.log

# Artisan tinker pour tests
php artisan tinker
```

## 🔄 API Routes

### Routes Web (routes/web.php)
```php
// Authentification
GET  /login          -> Auth\LoginController@showLoginForm
POST /login          -> Auth\LoginController@login
POST /logout         -> Auth\LogoutController@logout
GET  /register       -> Auth\RegisterController@showRegistrationForm
POST /register       -> Auth\RegisterController@register

// Dashboard
GET  /dashboard      -> DashboardController@index

// Comptes
GET  /comptes        -> CompteController@index
GET  /comptes/create -> CompteController@create
POST /comptes        -> CompteController@store
GET  /comptes/{id}   -> CompteController@show
POST /comptes/{id}/deposer -> CompteController@deposer

// Contacts
GET  /contacts       -> ContactController@index
GET  /contacts/create -> ContactController@create
POST /contacts       -> ContactController@store
GET  /contacts/{id}  -> ContactController@show
GET  /contacts/{id}/edit -> ContactController@edit
PUT  /contacts/{id}  -> ContactController@update
DELETE /contacts/{id} -> ContactController@destroy

// Transferts
GET  /transferts     -> TransfertController@index
GET  /transferts/create -> TransfertController@create
POST /transferts     -> TransfertController@store
DELETE /transferts/{id} -> TransfertController@destroy
```

## 📈 Évolutions Possibles

### Fonctionnalités
- Virements externes (hors contacts)
- Transferts programmés
- Notifications par email/SMS
- Export des relevés
- Graphiques des transactions

### Améliorations Techniques
- API REST pour applications mobiles
- Cache Redis pour les soldes
- File d'attente pour les transferts
- Tests automatisés complets
- Monitoring et métriques

### Sécurité
- Authentification à deux facteurs
- Logs d'audit complets
- Chiffrement des données sensibles
- Rate limiting sur les transferts

---

## 📞 Support

Pour toute question ou problème, consulter les logs Laravel ou contacter l'équipe de développement.

**Version**: 1.0.0
**Date**: Octobre 2025
**Auteur**: Équipe de développement