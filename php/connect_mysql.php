<?php
$host = 'localhost';
$dbname = 'id21521172_ubsbank';
$username = 'root';
$password = '';

try {
    $bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(Exception $e) {
    die('Une erreur s\'est produite: '.$e->getMessage());
}
?>
