# PRADO Framework + Docker + MySQL Example

Ce projet est un exemple complet d'application PRADO connectée à une base de données MySQL via Docker.

## Structure

- `docker-compose.yml` : Configuration des services Docker (web, db).
- `Dockerfile` : Image PHP 8.2 avec extensions nécessaires.
- `src/` : Code source de l'application.
  - `index.php` : Point d'entrée.
  - `protected/` : Logique applicative (pages, modèles, config).
  - `assets/` : Dossier de publication des ressources.

## Installation

1. Assurez-vous d'avoir Docker et Docker Compose installés.
2. À la racine du projet, lancez les conteneurs :
   ```bash
   docker-compose up -d
   ```
3. Installez les dépendances PHP (si vous avez Composer localement, sinon via le conteneur) :
   ```bash
   docker-compose exec web composer install
   ```
   *Note : Si Composer n'est pas dans le Dockerfile, vous devrez peut-être lancer `composer install` localement ou modifier le Dockerfile pour inclure Composer.*

4. Accédez à l'application via `http://localhost:8080`.

## Configuration Base de Données

La configuration se trouve dans `src/protected/application.xml`.
Le script `init.sql` initialise la base de données `prado_app` et la table `users`.

## Gestion des Assets dans PRADO

PRADO utilise le dossier `assets/` pour publier les ressources statiques (CSS, JS, images) nécessaires aux composants.
Lorsqu'un composant comme `TDataGrid` est utilisé, PRADO peut avoir besoin de publier ses propres fichiers de style ou de script pour qu'ils soient accessibles via le navigateur.

Le mécanisme de publication d'assets (`TAssetManager`) copie les fichiers depuis les dossiers protégés ou les bibliothèques vers le dossier `assets/` public, en leur attribuant souvent des noms hachés pour éviter les conflits et gérer le cache.

Dans cet exemple, le dossier `src/assets/` doit être inscriptible par le serveur web pour que PRADO puisse y déposer les fichiers nécessaires au rendu du `TDataGrid` et d'autres composants.
