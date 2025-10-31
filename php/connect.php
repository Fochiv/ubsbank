<?php
    try {
        // Configuration MySQL pour WAMPSERVER
        $host = 'localhost';
        $dbname = 'ubsbank';
        $username = 'root';
        $password = '';
        
        $bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
    } catch(Exception $e) {
        die('Erreur de connexion à la base de données MySQL: '.$e->getMessage());
    }
?>
