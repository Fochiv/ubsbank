# 🏦 UBS BANK - Système de Gestion des Transactions

## 📋 PRÉREQUIS

- **WampServer** (Version 3.0 ou supérieure)
- **PHP** 7.3 ou supérieur
- **MySQL** 5.7 ou supérieur

---

## 🚀 INSTALLATION RAPIDE

### ÉTAPE 1: Démarrer WampServer
1. Lancez WampServer
2. Attendez que l'icône devienne **verte** (serveur actif)

### ÉTAPE 2: Créer la base de données
1. Ouvrez phpMyAdmin: `http://localhost/phpmyadmin`
2. Cliquez sur **"Nouvelle base de données"**
3. Nom: `ubsbank`
4. Interclassement: `utf8mb4_unicode_ci`
5. Cliquez sur **"Créer"**

### ÉTAPE 3: Importer la structure
1. Sélectionnez la base de données `ubsbank`
2. Cliquez sur l'onglet **"Importer"**
3. Choisissez le fichier: `php/all_for_one.sql` (avec données de test)
   - OU `php/ubsbank_mysql.sql` (base vide)
4. Cliquez sur **"Exécuter"**

### ÉTAPE 4: Copier les fichiers
Copiez tout le projet dans:
```
C:\wamp64\www\ubsbank\
```

### ÉTAPE 5: Vérifier la configuration
Le fichier `php/connect.php` est configuré pour WampServer:
```php
$host = 'localhost';
$dbname = 'ubsbank';
$username = 'root';
$password = '';  // Vide par défaut
```

⚠️ **Si votre configuration est différente**, modifiez ces paramètres.

---

## 🌐 ACCÈS À L'APPLICATION

### Pages principales:

| Page | URL | Description |
|------|-----|-------------|
| **Ajouter Transaction** | `http://localhost/ubsbank/php/admin.php` | Créer une nouvelle transaction |
| **Liste Transactions** | `http://localhost/ubsbank/php/list.php` | Voir toutes les transactions |
| **Consulter Transaction** | `http://localhost/ubsbank/php/code.php` | Rechercher par identifiant |

---

## 📊 STRUCTURE DE LA BASE DE DONNÉES

### Table: `all_for_one`

**Colonne d'identifiant:** `code_swift`
- Type: VARCHAR(12)
- Format stocké: `123456789012` (12 chiffres sans tirets)
- Format affiché: `123-456-789-012` (avec tirets)
- Contrainte: UNIQUE

**États de transaction:**
- `10` = En attente
- `20-90` = En traitement
- `100` = Terminée

---

## 🔧 FONCTIONNALITÉS

✅ Création de transactions bancaires  
✅ Consultation par identifiant SWIFT  
✅ Modification des transactions  
✅ Suivi de l'état d'avancement  
✅ Modification des conditions importantes  
✅ Suppression de transactions  
✅ Interface moderne et responsive  
✅ Thème clair/sombre  

---

## ⚠️ DÉPANNAGE

### Erreur: "SQLSTATE[HY000] [1045] Access denied"
→ Vérifiez les identifiants dans `php/connect.php`

### Erreur: "SQLSTATE[HY000] [1049] Unknown database 'ubsbank'"
→ Créez la base de données `ubsbank` dans phpMyAdmin

### Erreur: "no such column: code_swift"
→ Importez le fichier SQL correct (`php/all_for_one.sql`)

### Page blanche
→ Activez l'affichage des erreurs PHP:
```php
error_reporting(E_ALL);
ini_set('display_errors', 1);
```

### WampServer icône orange/rouge
→ Vérifiez qu'aucun autre serveur n'utilise les ports 80/3306

---

## 📁 FICHIERS SQL DISPONIBLES

1. **php/all_for_one.sql** ✅ RECOMMANDÉ
   - Contient la structure + 17 transactions de test
   - Utilise `code_swift`
   - Prêt pour WampServer

2. **php/ubsbank_mysql.sql**
   - Base de données vide
   - Utilise `code_swift`
   - Pour commencer avec une base propre

---

## 🎯 NOTES IMPORTANTES

- ✅ Projet configuré **UNIQUEMENT pour MySQL** (pas de SQLite)
- ✅ Compatible WampServer par défaut
- ✅ Les identifiants sont générés automatiquement
- ✅ Format: 12 chiffres (stockage sans tirets)
- ✅ Affichage automatique avec tirets: XXX-XXX-XXX-XXX

---

## 📞 SUPPORT

En cas de problème, vérifiez:
1. ✅ WampServer actif (icône verte)
2. ✅ Base de données `ubsbank` créée
3. ✅ Fichier SQL importé correctement
4. ✅ Paramètres dans `connect.php` corrects
5. ✅ Apache et MySQL démarrés

---

**Version:** 2.0  
**Date:** Octobre 2024  
**Configuration:** MySQL/WampServer uniquement
