<?php
    try {
        // Utiliser SQLite pour la base de données
        $db_path = __DIR__ . '/database/ubsbank.db';
        $db_dir = dirname($db_path);
        
        // Créer le répertoire de la base de données s'il n'existe pas
        if (!is_dir($db_dir)) {
            mkdir($db_dir, 0777, true);
        }
        
        $bdd = new PDO('sqlite:' . $db_path);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Créer la table si elle n'existe pas
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
            code_swift TEXT NOT NULL,
            etat TEXT NOT NULL,
            important TEXT NOT NULL
        )");
        
    } catch(Exception $e) {
        die('Une erreur s\'est produite: '.$e->getMessage());
    }
?>
