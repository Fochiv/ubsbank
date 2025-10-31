# UBS Bank - Système de Gestion des Transactions Bancaires

## Vue d'ensemble du projet

Site bancaire professionnel UBS Bank permettant la gestion des transactions bancaires internationales avec interface d'administration moderne et portail client.

## État Actuel

- **Dernière mise à jour**: 31 octobre 2025
- **Version**: 2.0 (Redesign complet)
- **Statut**: Projet transformé avec design moderne dark/light theme

## Modifications Récentes

### Design Complet (31/10/2025)
- ✅ Transformation complète du design avec thème sombre par défaut
- ✅ Toggle dark/light theme avec sauvegarde de préférence
- ✅ Interface admin moderne avec sidebar et dashboard
- ✅ Génération automatique d'identifiants uniques de 12 caractères
- ✅ Date et heure automatiques pour les transactions
- ✅ Liste des transactions en tableau moderne avec recherche
- ✅ Boutons Modifier, Supprimer, Détails avec confirmations
- ✅ Recherche par identifiant ou nom
- ✅ Barre de progression stylisée
- ✅ Design responsive et professionnel
- ✅ Migration vers SQLite pour la base de données

## Architecture du Projet

### Structure des Fichiers

#### Frontend (Pages Publiques)
- `index.html` - Page d'accueil du site bancaire
- `php/code.php` - Formulaire de consultation par identifiant de transaction
- `php/info.php` - Page de résultat avec progression de la transaction
- `php/details_transaction.php` - Page détaillée d'une transaction

#### Backend (Administration)
- `php/admin.php` - Interface pour créer une nouvelle transaction
- `php/list.php` - Tableau de bord avec liste complète des transactions
- `php/edit_transaction.php` - Page de modification d'une transaction
- `php/delete_transaction.php` - Suppression de transaction avec confirmation
- `php/avancement.php` & `avancement1.php` - Modification de l'état d'avancement
- `php/condition.php` & `condition2.php` - Modification des conditions

#### Utilitaires et Configuration
- `php/connect.php` - Connexion à la base de données SQLite
- `php/functions.php` - Fonctions utilitaires (génération ID, formatage, etc.)
- `assets/css/admin-theme.css` - Système de thème moderne
- `assets/js/theme.js` - Gestion du thème et interactions

### Base de Données

**Type**: SQLite
**Fichier**: `php/database/ubsbank.db`

**Table principale**: `all_for_one`
- Informations expéditeur (nom, prénom, pays, infos bancaires)
- Informations destinataire (nom, prénom, pays, infos bancaires, email)
- Détails transaction (montant, devise, date, heure)
- Identifiant unique de 12 caractères (code_swift)
- État d'avancement (0-100%)
- Conditions importantes

## Fonctionnalités Principales

### Pour les Clients
1. Consultation de transaction par identifiant
2. Visualisation de la progression en temps réel
3. Accès aux détails complets de la transaction
4. Informations sur les conditions à respecter

### Pour les Administrateurs
1. Création de nouvelles transactions (ID auto-généré)
2. Liste complète avec statistiques (total, montant, complétées, en cours)
3. Recherche par identifiant ou nom
4. Modification des informations (sauf identifiant)
5. Suppression avec confirmation
6. Gestion de l'état d'avancement (0-100%)
7. Modification des conditions spéciales

## Système de Thèmes

- **Thème par défaut**: Sombre (Dark Mode)
- **Toggle**: Icône soleil/lune en haut à droite
- **Sauvegarde**: LocalStorage du navigateur
- **Variables CSS**: Système complet de variables pour personnalisation

## Identifiants de Transaction

- **Format**: 12 chiffres (XXX-XXX-XXX-XXX)
- **Génération**: Automatique et garantie unique
- **Fonction**: `genererIdentifiantTransaction()` dans functions.php
- **Affichage**: Formaté avec tirets pour lisibilité

## Technologies Utilisées

- **Backend**: PHP 8.2
- **Base de données**: SQLite
- **Frontend**: HTML5, CSS3 (Variables CSS), JavaScript vanilla
- **Icônes**: Bootstrap Icons
- **Polices**: Inter (Google Fonts)

## Configuration du Serveur

Le serveur PHP démarre sur le port 5000:
```bash
php -S 0.0.0.0:5000 -t .
```

## Préférences Utilisateur

- Design moderne avec thème sombre par défaut
- Interface responsive pour tous les écrans
- Animations fluides et professionnelles
- Formulaires avec validation
- Confirmations avant actions destructives

## Notes Importantes

1. L'identifiant de transaction ne peut JAMAIS être modifié après création
2. La date et l'heure sont générées automatiquement lors de la création
3. Toutes les suppressions nécessitent une confirmation utilisateur
4. La recherche fonctionne sur l'identifiant ET le nom des personnes
5. La base SQLite est portable et ne nécessite pas de serveur séparé

## Corrections Orthographiques

- "code swift" → "Identifiant de la transaction"
- Corrections grammaticales dans tous les textes français
- Messages d'erreur clarifiés et professionnels
