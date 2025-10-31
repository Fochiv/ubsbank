<?php
    try {
        // Configuration de la base de données
        // Pour WAMPSERVER/MySQL local, décommentez les lignes ci-dessous et modifiez les paramètres
        // $host = 'localhost';
        // $dbname = 'ubsbank';
        // $username = 'root';
        // $password = '';
        // $bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        
        // Pour Replit (SQLite) - Configuration par défaut
        $db_path = __DIR__ . '/database/ubsbank.db';
        $db_dir = dirname($db_path);
        
        // Créer le répertoire de la base de données s'il n'existe pas
        if (!is_dir($db_dir)) {
            mkdir($db_dir, 0777, true);
        }
        
        $bdd = new PDO('sqlite:' . $db_path);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Créer la table si elle n'existe pas (avec le nouveau nom de colonne)
        $bdd->exec("CREATE TABLE IF NOT EXISTS all_for_one (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nom_ex TEXT NOT NULL,
            prenom_ex TEXT NOT NULL,
            pays_ex TEXT NOT NULL,
            numero_aba_ex TEXT NOT NULL,
            numero_compte_ex TEXT NOT NULL,
            nom_banque_ex TEXT NOT NULL,
            devise_compte_ex TEXT NOT NULL,
            montant TEXT NOT NULL,
            date TEXT NOT NULL,
            heure TEXT NOT NULL,
            nom_de TEXT NOT NULL,
            prenom_de TEXT NOT NULL,
            pays_de TEXT NOT NULL,
            email_de TEXT NOT NULL,
            code_banque_de TEXT NOT NULL,
            code_guichet_de TEXT NOT NULL,
            numero_compte_de TEXT NOT NULL,
            code_bic_de TEXT NOT NULL,
            identification_transaction TEXT NOT NULL,
            etat TEXT NOT NULL,
            important TEXT NOT NULL
        )");
        
        // Migration: Renommer code_swift en identification_transaction si nécessaire
        // Cette migration s'exécute pour les bases de données existantes
        try {
            // Vérifier si la colonne code_swift existe encore
            $check = $bdd->query("SELECT sql FROM sqlite_master WHERE type='table' AND name='all_for_one'")->fetch();
            if ($check && strpos($check['sql'], 'code_swift') !== false) {
                // Renommer code_swift en identification_transaction
                $bdd->exec("ALTER TABLE all_for_one RENAME COLUMN code_swift TO identification_transaction");
            }
        } catch(Exception $e) {
            // La colonne a déjà été renommée ou erreur (peut être ignorée)
        }
        
    } catch(Exception $e) {
        die('Une erreur s\'est produite: '.$e->getMessage());
    }
?>
