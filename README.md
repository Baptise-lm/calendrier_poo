# Planning Hebdomadaire

Ce projet est une application web de gestion d'événements hebdomadaires. Il permet d'ajouter, de modifier et de supprimer des événements, ainsi que de les afficher dans un calendrier hebdomadaire.

## Structure du projet

## Fichiers principaux

### `index.php`

La page d'accueil qui affiche le calendrier hebdomadaire avec tous les événements.

### `add_event.php`

Permet d'ajouter un nouvel événement.

### `edit_event.php`

Permet de modifier un événement existant.

### `delete_event.php`

Permet de supprimer un événement existant.

## Classes

### `classes/Database.php`

Gère la connexion à la base de données.

### `classes/Event.php`

Gère les opérations CRUD (Create, Read, Update, Delete) pour les événements.

### `classes/Calendar.php`

Affiche les événements dans un calendrier hebdomadaire.

## Styles

### `css/style.css`

Contient les styles CSS pour l'application.

## Includes

### `includes/header.php`

Contient le header de l'application avec la navigation.

### `includes/footer.php`

Contient le footer de l'application.

## Installation

1. Clonez le dépôt.
2. Configurez votre serveur web pour pointer vers le répertoire du projet.
3. Importez la base de données `planning` avec les tables nécessaires.
4. Modifiez les informations de connexion à la base de données dans `classes/Database.php` si nécessaire.

## Utilisation

- Accédez à `index.php` pour voir le calendrier hebdomadaire.
- Utilisez les liens pour ajouter, modifier ou supprimer des événements.
