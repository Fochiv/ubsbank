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
        
        // Créer la table all_for_one avec contrainte d'unicité sur identification_transaction
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
            identification_transaction TEXT NOT NULL UNIQUE,
            etat TEXT NOT NULL,
            important TEXT NOT NULL
        )");
        
    } catch(Exception $e) {
        die('Une erreur s\'est produite: '.$e->getMessage());
    }
?>
