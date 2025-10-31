# Installation UBS Bank sur WAMPSERVER

Ce guide vous aide à installer et configurer l'application UBS Bank sur votre serveur local WAMPSERVER.

## Prérequis

- WAMPSERVER installé et fonctionnel (version 3.0 ou supérieure)
- PHP 7.4 ou supérieur
- MySQL 5.7 ou MariaDB 10.3 ou supérieur

## Installation

### 1. Copier les fichiers du projet

Copiez tous les fichiers du projet dans le dossier `www` de WAMPSERVER:
```
C:\wamp64\www\ubsbank\
```

### 2. Créer la base de données MySQL

1. Ouvrez phpMyAdmin (http://localhost/phpmyadmin)
2. Créez une nouvelle base de données nommée `ubsbank`
3. Sélectionnez la base de données `ubsbank`
4. Cliquez sur l'onglet "Importer"
5. Importez le fichier `php/ubsbank_mysql.sql`

### 3. Configurer la connexion à la base de données

Ouvrez le fichier `php/connect.php` et modifiez les lignes suivantes:

```php
// Configuration pour WAMPSERVER/MySQL local
$host = 'localhost';
$dbname = 'ubsbank';
$username = 'root';
$password = ''; // Laissez vide par défaut ou mettez votre mot de passe MySQL
$bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
```

**Commentez** les lignes SQLite (entre les lignes 10 et 54).

### 4. Tester l'application

1. Démarrez WAMPSERVER (l'icône doit être verte)
2. Ouvrez votre navigateur et allez sur:
   - http://localhost/ubsbank/index.html (Page d'accueil)
   - http://localhost/ubsbank/php/admin.php (Interface admin)
   - http://localhost/ubsbank/php/diagnostic.php (Page de diagnostic)

## Changements importants

### Nom de colonne modifié

⚠️ **Important**: La colonne `code_swift` a été renommée en `identification_transaction`

Si vous avez une ancienne base de données avec `code_swift`, vous devez la migrer:

```sql
ALTER TABLE all_for_one 
RENAME COLUMN code_swift TO identification_transaction;
```

Ou bien, importez simplement le nouveau fichier `php/ubsbank_mysql.sql` qui contient déjà le bon nom de colonne.

## Fonctionnalités

### Interface Admin
- **Nouvelle Transaction** (`php/admin.php`): Créer une nouvelle transaction
- **Liste des Transactions** (`php/list.php`): Voir toutes les transactions
- **Consulter Transaction** (`php/code.php`): Rechercher une transaction par ID
- **Modifier État** (`php/avancement1.php`): Changer l'état d'avancement
- **Modifier Condition** (`php/condition.php`): Modifier les conditions

### Identifiants de transaction
- Format: 12 chiffres (exemple: `123456789012`)
- Affichage formaté: `XXX-XXX-XXX-XXX` (exemple: `123-456-789-012`)
- Les tirets, espaces et caractères spéciaux sont automatiquement supprimés lors de la recherche

## Dépannage

### Erreur "Transaction introuvable"

1. Vérifiez que la transaction existe dans la base de données
2. Utilisez la page de diagnostic: http://localhost/ubsbank/php/diagnostic.php
3. Assurez-vous de copier uniquement les chiffres (pas les tirets)

### Erreur de connexion à la base de données

1. Vérifiez que WAMPSERVER est démarré (icône verte)
2. Vérifiez les paramètres dans `php/connect.php`
3. Vérifiez que la base de données `ubsbank` existe dans phpMyAdmin

### Message de confirmation non affiché

Le message de confirmation s'affiche maintenant directement sur la page `admin.php` après l'insertion d'une transaction.

## Structure de la base de données

La table `all_for_one` contient:
- Informations de l'expéditeur (nom, prénom, pays, compte, etc.)
- Informations du destinataire (nom, prénom, email, codes bancaires, etc.)
- `identification_transaction`: Identifiant unique (12 chiffres)
- `etat`: État d'avancement (0-100)
- `important`: Conditions et messages importants
- `date` et `heure`: Date et heure de la transaction

## Support

Pour plus d'aide, consultez:
- La page de diagnostic: `php/diagnostic.php`
- Les logs de WAMPSERVER: `C:\wamp64\logs\php_error.log`
