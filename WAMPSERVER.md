# 🚀 Guide d'Installation sur Wampserver

## 📋 Prérequis
- Wampserver installé et fonctionnel
- Apache et MySQL démarrés (icône Wamp verte)

---

## 🗄️ Étape 1: Créer la Base de Données MySQL

### Option A: Via phpMyAdmin (Recommandé)
1. Ouvrez phpMyAdmin: `http://localhost/phpmyadmin`
2. Cliquez sur "Nouvelle base de données" dans le panneau de gauche
3. Nom de la base: **`ubsbank`**
4. Interclassement: **`utf8_unicode_ci`**
5. Cliquez sur "Créer"

### Option B: Via l'importation SQL directe
1. Ouvrez phpMyAdmin
2. Cliquez sur "Importer" dans le menu du haut
3. Cliquez sur "Choisir un fichier"
4. Sélectionnez le fichier **`php/all_for_one.sql`**
5. **IMPORTANT**: Avant d'importer, modifiez la ligne 21 du fichier SQL:
   - Remplacez: `CREATE DATABASE id21521172_ubsbank`
   - Par: `CREATE DATABASE ubsbank`
6. Cliquez sur "Exécuter"

---

## 📂 Étape 2: Copier les Fichiers du Projet

1. Copiez **tout le dossier du projet** dans le répertoire `www` de Wampserver
   - Chemin typique: `C:\wamp64\www\ubs-bank\` (ou le nom que vous voulez)
   
2. Structure finale:
   ```
   C:\wamp64\www\ubs-bank\
   ├── index.html
   ├── router.php
   ├── assets/
   ├── php/
   │   ├── connect.php
   │   ├── connect_mysql.php
   │   ├── admin.php
   │   ├── list.php
   │   └── ...
   ```

---

## 🔧 Étape 3: Configurer la Connexion MySQL

### Option Simple (Renommer le fichier)
```bash
# Dans le dossier php/
# 1. Renommez connect.php en connect_sqlite.php (pour garder une sauvegarde)
# 2. Renommez connect_mysql.php en connect.php
```

**OU**

### Option Manuelle (Modifier connect.php)
Ouvrez `php/connect.php` et remplacez **tout le contenu** par:

```php
<?php
// Configuration MySQL pour Wampserver
$host = 'localhost';
$dbname = 'projet_facebook';
$username = 'root';
$password = '';

try {
    $bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(Exception $e) {
    die('Une erreur s\'est produite: '.$e->getMessage());
}
?>
```

---

## 📊 Étape 4: Importer les Données de Test

### Via phpMyAdmin
1. Ouvrez phpMyAdmin
2. Sélectionnez la base **`ubsbank`** dans le panneau de gauche
3. Cliquez sur l'onglet "SQL"
4. Copiez-collez le contenu du fichier **`php/all_for_one.sql`** 
   - **SAUF** les 22 premières lignes (jusqu'à `CREATE TABLE`)
5. Cliquez sur "Exécuter"

Cela importera **17 transactions de démonstration**.

---

## 🌐 Étape 5: Accéder à l'Application

### URLs d'accès:
- **Page d'accueil**: `http://localhost/ubs-bank/`
- **Administration**: `http://localhost/ubs-bank/php/admin.php`
- **Liste des transactions**: `http://localhost/ubs-bank/php/list.php`
- **Consulter une transaction**: `http://localhost/ubs-bank/php/code.php`

---

## ✅ Étape 6: Tester l'Application

### Test 1: Ajouter une Transaction
1. Allez sur: `http://localhost/ubs-bank/php/admin.php`
2. Remplissez le formulaire avec des données de test
3. Cliquez sur "Enregistrer la Transaction"
4. **Vérifiez le message de confirmation** qui s'affiche brièvement en haut
5. Vous serez redirigé vers la liste des transactions

### Test 2: Vérifier dans la Base de Données
1. Ouvrez phpMyAdmin
2. Base: `ubsbank` → Table: `all_for_one`
3. Cliquez sur "Afficher" pour voir vos transactions

### Test 3: Consulter une Transaction
1. Notez un identifiant de transaction (format: XXX-XXX-XXX-XXX)
2. Allez sur: `http://localhost/ubs-bank/php/code.php`
3. Entrez l'identifiant et cliquez sur "Consulter"

---

## 🔐 Informations de Connexion MySQL

Vos paramètres actuels:
```
Hôte: localhost
Base de données: ubsbank
Utilisateur: root
Mot de passe: (vide)
```

Si vous devez les modifier plus tard, éditez le fichier **`php/connect.php`**

---

## ❓ Dépannage

### Erreur: "Base de données introuvable"
➡️ Vérifiez que la base `ubsbank` existe dans phpMyAdmin

### Erreur: "Table all_for_one n'existe pas"
➡️ Importez le fichier SQL (voir Étape 1 ou 4)

### Page blanche
➡️ Vérifiez les logs d'erreur PHP dans Wampserver (icône Wamp → PHP → Logs PHP)

### Erreur de connexion
➡️ Vérifiez que MySQL est démarré (icône Wamp doit être verte)

---

## 📝 Fonctionnalités Disponibles

### Interface Publique
- ✅ Page d'accueil avec présentation
- ✅ Consultation de transaction par code SWIFT
- ✅ Thème sombre/clair
- ✅ Traduction multilingue

### Interface Administration
- ✅ Ajout de transactions avec identifiant auto-généré
- ✅ Liste complète avec statistiques
- ✅ Modification de l'état (progression 0-100%)
- ✅ Modification des conditions/messages
- ✅ Message de confirmation après chaque action

---

## 🎯 Message de Confirmation

**OUI**, le message de confirmation est bien présent! 

Après avoir ajouté une transaction dans `admin.php`:
- Un message vert s'affiche: **"Transaction ajoutée avec succès! Identifiant: XXX-XXX-XXX-XXX"**
- Il apparaît en haut de la page `list.php` après la redirection
- Le message reste visible pendant quelques secondes

Code source (ligne 97 de admin.php):
```php
$_SESSION['success'] = 'Transaction ajoutée avec succès! Identifiant: ' . formaterIdentifiant($identifiant);
```

---

## 📧 Support

Email: aldofoch@gmail.com

---

**Dernière mise à jour**: 31 Octobre 2025
