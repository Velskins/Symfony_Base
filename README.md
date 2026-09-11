Bienvenue dans le projet "Bibliothèque de citations"

Application web développée avec Symfony 8.1 dans le cadre du projet de fin de cours. Elle permet de gérer une bibliothèque personnelle de citations : les consulter, en ajouter, les modifier, les supprimer et exporter l'ensemble au format CSV.

L'interface repose sur Bootstrap 5 (chargé via CDN) et les données sont stockées dans une base PostgreSQL lancée avec Docker.

Installation :

- Version Symfony : 8.1 (framework-bundle 8.1.6, Symfony CLI 5.20.0)
- Version PHP : 8.5.10
- Version Composer : 2.10.3
- Version Docker : 29.4.3 (Docker Compose v5.1.3)
- Version SQL : PostgreSQL 16.15 (image `postgres:16-alpine`, port 5433)

Lancer le projet :

```bash
docker compose up -d
symfony composer install
symfony console doctrine:migrations:migrate
symfony server:start
```

-- Type de données :
Cette bibliothèque permet de stocker des citations avec comme données : 
 - "Citations" - `texte` : `string`
 - "Auteur" - `auteur` : `string`
 - "Date d'ajout" - `dateAjout` : `DateTimeImmutable`
 - "Catégorie" - `string` : `VARCHAR(100)`
 - "Source" - `source` : `?string`
 - "Langue" - `langue` : `string` = liste de choix fermée (`fr`, `en`, `autre`)
 - "Notes" - `note` : `INT` nullable
 - "Favori" - `favori` : `bool`

Elle permet aussi d'exporter toutes ces données via CSV. ( Utilisation de League/CSV )

-- Fonctionnalités

Afficher la bibliothèque 

Bibliothèque vide

Consulter une citation

Ajouter une citation

Contrôler les saisies

Modifier une citation

Supprimer une citation protégée par un jeton CSRF

Confirmer une suppression

Navigation

-- Fonctionnalité créative : export CSV

Export CSV de la bibliothèque

L'export utilise la bibliothèque league/csv :

- séparateur `;`
- BOM UTF-8 pour que les accents s'affichent correctement ;
- une ligne d'en-têtes puis une ligne par citation

Docs : <https://csv.thephpleague.com/9.0/>

-- Étapes d'installation

Prérequis : PHP 8.4 ou plus, Symfony CLI, Docker Desktop et Git.

cloner dépôt

   git clone https://github.com/Velskins/Symfony_Base.git projet
   cd projet


Installer dépendances PHP

   symfony composer install


Lancer la base de données PostgreSQL

   docker compose up -d

   Le conteneur expose PostgreSQL sur le port `5433` de la machine. La chaîne de connexion utilisée par défaut est dans `.env` :

   DATABASE_URL="postgresql://app:!ChangeMe!@127.0.0.1:5433/app?serverVersion=16&charset=utf8"

   Pour la modifier sans toucher au fichier versionné, créer un .env.local avec sa propre valeur.

Créer le schéma de la base

   symfony console doctrine:migrations:migrate

Démarrer le serveur

   symfony serve -d

   L'application est disponible sur <https://127.0.0.1:8000>.

-- Structure du projet

src/
├── Controller/CitationController.php
├── Entity/Citation.php
├── Form/CitationType.php
└── Repository/CitationRepository.php
templates/
├── base.html.twig
└── citation/
    ├── index.html.twig
    ├── show.html.twig
    ├── new.html.twig / edit.html.twig
    ├── _form.html.twig
    └── _delete_form.html.twig   
migrations/                
compose.yaml           
