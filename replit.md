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
**📘 Consultez le fichier INSTALLATION_WAMPSERVER.md pour le guide complet**

Configuration rapide:
1. Créer une base de données MySQL nommée `ubsbank`
2. Importer le fichier `php/ubsbank_mysql.sql` (nouveau fichier avec identification_transaction)
3. Modifier `php/connect.php` pour activer MySQL (décommenter les lignes 4-9, commenter lignes 11-63)
4. Les identifiants MySQL sont déjà configurés:
   - Host: localhost
   - Database: ubsbank
   - User: root
   - Password: (vide)

⚠️ **Note**: N'utilisez plus `php/all_for_one.sql` (ancien fichier avec code_swift)

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
- **Suivi**: état (progression), identification_transaction (identifiant unique)
- **Notes**: messages et conditions importantes

⚠️ **Note importante**: La colonne s'appelle maintenant `identification_transaction` au lieu de `code_swift`

### Identifiants de Transaction
**Nouveaux identifiants**: 12 chiffres (format: XXX-XXX-XXX-XXX)
- Exemple: 123-456-789-012

**Anciens identifiants**: 8 chiffres (format: XXX-XXX-XX) 
- Exemple: 257-016-34

Les deux formats sont supportés. Les identifiants sont stockés sans tirets dans la base de données et formatés automatiquement pour l'affichage. Le système nettoie automatiquement tous les espaces, tirets et caractères spéciaux lors de la recherche.

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

#### Configuration initiale
- Migration vers Replit avec SQLite pour l'environnement de développement
- Compatibilité Wampserver via MySQL (nom BD: ubsbank)
- Import des 17 transactions existantes (format 8 chiffres)
- Configuration du serveur PHP sur port 5000

#### Corrections de bugs (31 Oct 2025 - après-midi)
- **BUG RÉSOLU**: Erreur "Cet identifiant ne correspond à aucune transaction"
  - Cause: Espaces invisibles lors du copier-coller
  - Solution: Nettoyage avancé avec `preg_replace('/[^0-9]/', '', trim($code))`
  - Tous les espaces, tirets et caractères spéciaux sont maintenant supprimés automatiquement

- **MIGRATION**: Renommage de la colonne `code_swift` → `identification_transaction`
  - Migration automatique dans connect.php pour bases existantes
  - Nouveau fichier SQL: `php/ubsbank_mysql.sql` pour Wampserver
  - Tous les fichiers PHP mis à jour (15+ fichiers)

- **AMÉLIORATION**: Message de confirmation après insertion
  - Affichage immédiat de l'identifiant généré dans admin.php
  - Message persistant dans list.php via sessions

#### Documentation
- Création de INSTALLATION_WAMPSERVER.md avec guide complet
- Page de diagnostic ajoutée: php/diagnostic.php
- Support des deux formats d'identifiants (8 et 12 chiffres)
- Notification élégante lors de la copie d'identifiant

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
