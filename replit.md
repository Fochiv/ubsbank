# UBS Bank - Système de Gestion de Transactions Bancaires

## Vue d'ensemble
Application web de gestion de transactions bancaires internationales développée avec PHP et SQLite. Le système permet de créer, consulter, modifier et suivre des transactions bancaires avec un système de suivi en temps réel.

## État du Projet
- **Date de dernière mise à jour**: 31 octobre 2025
- **Version**: 1.0
- **Status**: ✅ Opérationnel

## Architecture

### Frontend
- **HTML5/CSS3** avec design moderne responsive
- **JavaScript** pour les interactions dynamiques
- **Bootstrap Icons** pour les icônes
- **Google Translate API** pour la traduction multilingue
- **Design**: Dark mode / Light mode avec transitions fluides

### Backend
- **PHP 8.2** (serveur de développement intégré)
- **SQLite** pour la base de données
- **PHPMailer** pour l'envoi d'emails
- **PDO** pour les interactions avec la base de données

### Base de données
- **Type**: SQLite
- **Emplacement**: `php/database/ubsbank.db`
- **Table principale**: `all_for_one` (transactions)

## Fonctionnalités Principales

### 1. Page d'accueil (index.html)
- Présentation des services bancaires
- Section À propos
- Statistiques de l'entreprise
- **NOUVEAU**: Section témoignages avec 4 avis clients
- Formulaire de contact
- Dark/Light mode toggle
- Traduction multilingue

### 2. Administration (admin.php)
- Création de nouvelles transactions
- Génération automatique d'identifiants uniques (format: XXX-XXX-XXX-XXX)
- Validation des données
- Gestion des expéditeurs et destinataires

### 3. Liste des Transactions (list.php)
- Tableau complet de toutes les transactions
- Recherche en temps réel
- Statistiques globales (montant total, transactions complétées, etc.)
- **NOUVEAU**: Bouton pour copier l'identifiant rapidement
- **NOUVEAU**: Modal popup pour voir les détails d'une transaction sans quitter la page
- Actions: Voir détails, Modifier, Supprimer
- Affichage de l'identifiant formaté avec possibilité de copie

### 4. Consultation de Transaction (code.php)
- Recherche par identifiant de transaction
- Support des identifiants avec ou sans tirets
- Redirection vers la page de détails

### 5. Détails de Transaction (details_transaction.php)
- Vue complète d'une transaction
- Informations expéditeur/destinataire
- Barre de progression du virement
- Conditions et messages importants
- **Identifiant affiché en grand**

### 6. Envoi d'Email (mail.php)
- **NOUVEAU**: Code réorganisé avec PHP au début du fichier
- Utilisation de PHPMailer pour l'envoi sécurisé
- Configuration SMTP pour Gmail
- Validation des données
- Messages de succès/erreur clairs
- **Prêt pour les tests en production**

## Structure des Fichiers

```
/
├── index.html                  # Page d'accueil
├── router.php                  # Routeur pour le serveur PHP
├── assets/
│   ├── css/
│   │   ├── user-theme.css      # Thème utilisateur (+ témoignages)
│   │   └── admin-theme.css     # Thème admin
│   ├── vendor/
│   │   └── bootstrap-icons/    # Icônes
│   └── js/
│       └── theme.js            # Gestion du thème
├── php/
│   ├── admin.php               # Création de transactions
│   ├── list.php                # Liste des transactions (+ modal détails)
│   ├── code.php                # Recherche de transaction
│   ├── details_transaction.php # Détails complets
│   ├── edit_transaction.php    # Modification
│   ├── delete_transaction.php  # Suppression
│   ├── mail.php                # Envoi d'emails (CORRIGÉ)
│   ├── connect.php             # Connexion SQLite
│   ├── functions.php           # Fonctions utilitaires
│   ├── database/
│   │   └── ubsbank.db          # Base de données SQLite
│   └── phpMailler/
│       └── vendor/             # PHPMailer
```

## Modifications Récentes (31 octobre 2025)

### 1. ✅ Résolution du problème d'identifiant 181-970-783-435
- Une transaction de test a été ajoutée avec l'identifiant `181970783435`
- La recherche fonctionne avec ou sans tirets (format: 181-970-783-435 ou 181970783435)
- Le code dans `code.php` enlève automatiquement les tirets avant la recherche

### 2. ✅ Affichage de l'identifiant sur la page admin
- **Bouton de copie** ajouté dans la colonne Identifiant du tableau
- **Modal popup** pour voir les détails rapidement sans quitter la page
- **Identifiant affiché en grand** dans la modal avec possibilité de copie
- Deux options de visualisation: popup rapide ou page complète

### 3. ✅ Correction du code d'envoi d'email + Sécurité
- Réorganisation du fichier `mail.php` (code PHP au début)
- **SÉCURITÉ**: Utilisation de variables d'environnement pour les credentials SMTP
- Meilleure validation des données
- Affichage des messages d'erreur et de succès
- Conservation des valeurs du formulaire après soumission
- Code conforme aux bonnes pratiques PHPMailer

### 4. ✅ Section témoignages ajoutée
- 4 témoignages clients avec notes 5 étoiles
- Design moderne avec animations
- Avatars et informations personnalisées
- Responsive pour mobile
- Placée juste avant le footer

## Configuration du Serveur

### Développement
```bash
php -S 0.0.0.0:5000 -t . router.php
```

### Port
- **Frontend**: 5000 (accessible via Replit webview)

## Configuration de l'envoi d'emails

### ⚠️ IMPORTANT: Configuration des Secrets (SÉCURITÉ)

Pour des raisons de sécurité, les identifiants SMTP ne sont **PAS** stockés dans le code. Vous devez les configurer dans les Secrets Replit:

1. **Dans Replit**: Cliquez sur "Tools" > "Secrets"
2. **Ajoutez deux secrets**:
   - **Nom**: `SMTP_USERNAME` → **Valeur**: Votre adresse Gmail complète
   - **Nom**: `SMTP_PASSWORD` → **Valeur**: Votre mot de passe d'application Gmail

### Comment obtenir un mot de passe d'application Gmail:
1. Allez sur votre compte Google
2. Sécurité > Validation en 2 étapes (activez-la si ce n'est pas fait)
3. Mots de passe d'application
4. Créez un mot de passe pour "Mail" ou "Application personnalisée"
5. Copiez le mot de passe généré (16 caractères)
6. Utilisez ce mot de passe comme valeur pour `SMTP_PASSWORD`

### Test de l'envoi d'emails
1. Configurez les secrets comme indiqué ci-dessus
2. Redémarrez le serveur (le workflow se redémarre automatiquement)
3. Allez sur `php/mail.php`
4. Remplissez le formulaire de test
5. Si les secrets ne sont pas configurés, vous verrez un message d'erreur explicite

### Pour un hébergement en production:
- Configurez les mêmes variables d'environnement sur votre serveur de production
- Aucune modification de code n'est nécessaire

## Identifiants de Transaction

### Format
- **Stockage**: 12 chiffres sans tirets (ex: 181970783435)
- **Affichage**: Format avec tirets XXX-XXX-XXX-XXX (ex: 181-970-783-435)

### Fonctions utilitaires
- `genererIdentifiantTransaction($bdd)`: Génère un ID unique
- `formaterIdentifiant($identifiant)`: Ajoute les tirets pour l'affichage

## Préférences Utilisateur

### Design
- Dark mode par défaut
- Light mode disponible via toggle
- Animations fluides et modernes
- Totalement responsive (mobile, tablette, desktop)

### Langues
- Français (par défaut)
- Traduction automatique via Google Translate

## Prochaines étapes possibles
- Ajouter l'authentification pour l'admin
- Exporter les transactions en PDF
- Statistiques avancées avec graphiques
- Notifications par email automatiques lors des changements d'état
- API REST pour les intégrations externes

## Support
Email: aldofoch@gmail.com
Siège social: Londres, Royaume-Uni
