# Fedi Élégance — Location de tenues traditionnelles

Application PHP/MySQL pour gérer un catalogue de vêtements traditionnels tunisiens et enregistrer les locations.

## Fonctionnalités
- Catalogue des habits par catégorie, taille, prix et disponibilité
- Ajout de nouvelles tenues
- Location d'une tenue disponible pour un client enregistré
- Mise à jour transactionnelle de la disponibilité pour éviter deux locations concurrentes
- Validation serveur, requêtes préparées, échappement HTML et protection CSRF

## Installation locale
1. Démarrer Apache et MySQL avec XAMPP/WAMP.
2. Créer la base `bdsellami` et importer `bdsellami.sql` via phpMyAdmin.
3. Vérifier les paramètres de connexion dans `config.php`.
4. Ouvrir `index.php` depuis le serveur local.

## Stack
PHP 8+, MySQL/MariaDB, HTML et CSS.

## Limites
Le projet est une démonstration locale. Il utilise les clients d'exemple présents dans le dump SQL et ne comporte pas encore de comptes administrateurs, de gestion des retours ou de notifications. Avant publication, ajouter une authentification avec rôles, une procédure de retour et un compte MySQL à privilèges limités.

Brand: Fedi.
