# UBS Bank - Système de Gestion de Transactions

## 📋 Vue d'ensemble

Application web PHP pour la gestion des transactions bancaires UBS. Système complet permettant de créer, consulter et gérer des transactions bancaires internationales avec une interface moderne et intuitive.

## 🏗️ Architecture du Projet

### Structure des Fichiers
```
├── index.html              # Page d'accueil publique
├── router.php              # Routeur PHP pour le serveur
├── assets/                 # Ressources statiques (CSS, JS, images)
├── php/
│   ├── connect.php         # Connexion SQLite (pour Replit)
│   ├── connect_mysql.php   # Connexion MySQL (pour Wampserver)
│   ├── functions.php       # Fonctions utilitaires
│   ├── admin.php           # Ajout de transactions
│   ├── list.php            # Liste des transactions
│   ├── code.php            # Consultation de transaction
│   ├── info.php            # Détails d'une transaction
│   ├── avancement.php      # Modification de l'état
│   ├── condition.php       # Modification des conditions
│   ├── all_for_one.sql     # Dump MySQL original
│   └── database/           # Base de données SQLite
```

## 🚀 Déploiement

### Sur Replit (Configuration actuelle)
- **Base de données**: SQLite (php/database/ubsbank.db)
- **Serveur**: PHP 8.2 sur port 5000
- **Fichier de connexion**: php/connect.php
- **Données pré-chargées**: 17 transactions déjà dans la base (committée avec le projet)
- La base de données SQLite est committée dans le repository pour faciliter le déploiement

### Sur Wampserver (Production)
**📘 Consultez le fichier WAMPSERVER.md pour le guide complet**

Configuration rapide:
1. Créer une base de données MySQL nommée `ubsbank`
2. Importer le fichier `php/all_for_one.sql`
3. Renommer `php/connect_mysql.php` en `php/connect.php` (ou modifier connect.php)
4. Les identifiants MySQL sont déjà configurés:
   - Host: localhost
   - Database: ubsbank
   - User: root
   - Password: (vide)

## 🔧 Fonctionnalités

### Interface Publique
- **Page d'accueil**: Présentation de la banque et services
- **Consultation de transaction**: Recherche par identifiant unique (code SWIFT)
- **Thème sombre/clair**: Basculement entre les thèmes
- **Multilingue**: Support de traduction via Google Translate

### Interface Administration
- **Ajout de transactions**: Formulaire complet avec génération automatique d'identifiant
- **Liste des transactions**: Tableau de bord avec statistiques
- **Consultation détaillée**: Affichage complet des informations
- **Modification d'état**: Mise à jour de la progression (0-100%)
- **Modification des conditions**: Gestion des messages importants

## 📊 Base de Données

### Table: `all_for_one`
- **Informations expéditeur**: nom, prénom, pays, numéros bancaires
- **Informations destinataire**: nom, prénom, pays, email, codes bancaires
- **Transaction**: montant, devise, date, heure
- **Suivi**: état (progression), code SWIFT (identifiant unique)
- **Notes**: messages et conditions importantes

### Identifiants de Transaction
Format: 12 chiffres (affichés avec tirets XXX-XXX-XXX-X)
Exemple: 257-016-34 → utilisé comme code SWIFT

## 🔐 Sécurité

- Validation des entrées utilisateur
- Protection contre les injections SQL (PDO avec requêtes préparées)
- Échappement HTML pour l'affichage
- Gestion sécurisée des sessions

## 🎨 Style et Design

- **Framework CSS**: Bootstrap Icons
- **Police**: Inter (Google Fonts)
- **Thème**: Mode sombre par défaut avec basculement clair/sombre
- **Responsive**: Interface adaptative pour mobile et desktop

## 📝 Notes de Développement

### Changements Récents (31 Oct 2025)
- Configuration initiale pour Replit
- Migration de SQLite pour l'environnement de développement
- Création de connect_mysql.php pour compatibilité Wampserver
- Import des 17 transactions existantes
- Configuration du serveur PHP sur port 5000
- Documentation du projet

### Compatibilité
- PHP 8.2+ (compatible avec PHP 7.3+)
- SQLite 3 (Replit) ou MySQL 5.7+/MariaDB 10+ (Wampserver)
- Support des navigateurs modernes

## 🛠️ Commandes Utiles

### Démarrer le serveur (Replit)
```bash
php -S 0.0.0.0:5000 router.php
```

### Importer des données supplémentaires
```bash
cd php && php import_data.php
```

## 📧 Contact

**Email de support**: aldofoch@gmail.com  
**Siège social**: Londres, Royaume-Uni

---

*Dernière mise à jour: 31 Octobre 2025*
