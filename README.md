Bienvenue dans le projet "Bibliothèque de citations"

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

But du projet :
Cette bibliothèque permet de stocker des citations avec comme données : 
 - "Citations"
 - "Auteur"
 - "Date d'ajout"
 - "Catégorie"
 - "Source"
 - "Langue"
 - "Notes"
 - "Favori"

Elle permet aussi d'exporter toutes ces données via CSV. ( Utilisation de League/CSV )



