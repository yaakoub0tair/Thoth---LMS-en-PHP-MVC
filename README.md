# Thoth – LMS PHP MVC

## Description
Thoth LMS est un système de gestion d'apprentissage en ligne développé en PHP natif avec une architecture MVC. Le projet permet aux étudiants de s'inscrire, de se connecter, de consulter les cours disponibles et de s'inscrire aux cours de leur choix.

## Technologies utilisées
- PHP 8+ (natif, sans framework)
- MySQL/MariaDB
- PDO pour la base de données
- Sessions PHP pour l'authentification
- Architecture MVC stricte

## Fonctionnalités
- **Authentification étudiant**
  - Inscription avec validation serveur
  - Connexion sécurisée (hashage des mots de passe)
  - Déconnexion
- **Gestion des cours**
  - Liste des cours disponibles
  - Détails d'un cours
  - Inscription à un cours
  - Visualisation des cours de l'étudiant connecté
- **Protection des routes**
  - Accès sécurisé aux pages protégées via sessions

## Structure des dossiers
```
/
├── public/
│   └── index.php          # Point d'entrée unique
├── app/
│   ├── Core/
│   │   ├── Application.php
│   │   ├── Database.php
│   │   ├── Request.php
│   │   ├── Router.php
│   │   └── Auth.php
│   ├── controllers/
│   │   ├── AuthController.php
│   │   └── StudentController.php
│   ├── models/
│   │   ├── Student.php
│   │   ├── Course.php
│   │   └── Enrollment.php
│   └── views/
│       ├── auth/
│       │   ├── login.php
│       │   └── register.php
│       ├── student/
│       │   ├── dashboard.php
│       │   └── course.php
│       └── home.php
├── config/
│   └── config.php         # Configuration base de données
└── database.sql           # Structure SQL
```

## Installation

### Prérequis
- PHP 8+ avec extensions PDO et MySQL
- MySQL/MariaDB
- Serveur web (Apache via XAMPP/MAMP/WAMP)

### Étapes
1. Cloner le projet dans le répertoire du serveur web
2. Importer la base de données :
   ```sql
   mysql -u root -p < database.sql
   ```
3. Configurer la base de données dans `config/config.php` si nécessaire
4. Démarrer le serveur web

## Lancement du projet

### Via XAMPP/MAMP
1. Placer le projet dans `htdocs/` (XAMPP) ou `htdocs/` (MAMP)
2. Démarrer Apache et MySQL
3. Accéder à `http://localhost/router/`

### Tests
- **Page d'accueil** : `http://localhost/router/`
- **Inscription** : `http://localhost/router/register`
- **Connexion** : `http://localhost/router/login`
- **Dashboard** : `http://localhost/router/student/dashboard` (après connexion)

## Routes disponibles
- `/` - Page d'accueil
- `/register` - Inscription (GET/POST)
- `/login` - Connexion (GET/POST)
- `/logout` - Déconnexion
- `/student/dashboard` - Tableau de bord (protégé)
- `/student/course/{id}` - Détails d'un cours (protégé)
- `/student/enroll/{id}` - Inscription à un cours (POST, protégé)

## Base de données
Le projet utilise 3 tables :
- `students` : informations des étudiants
- `courses` : catalogue de cours
- `enrollments` : inscriptions des étudiants aux cours

## Sécurité
- Mots de passe hashés avec `password_hash()`
- Requêtes SQL préparées (PDO)
- Protection des routes par sessions
- Validation serveur des formulaires
