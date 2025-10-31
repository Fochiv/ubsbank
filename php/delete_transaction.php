<?php
require_once("connect.php");
session_start();

// Vérifier si l'identifiant est fourni
if(!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['error'] = 'Identifiant de transaction manquant';
    header("Location: list.php");
    exit;
}

$identifiant = $_GET['id'];

try {
    // Supprimer la transaction
    $req = $bdd->prepare('DELETE FROM all_for_one WHERE code_swift = :id');
    $req->execute(['id' => $identifiant]);
    
    if($req->rowCount() > 0) {
        $_SESSION['success'] = 'Transaction supprimée avec succès!';
    } else {
        $_SESSION['error'] = 'Transaction introuvable';
    }
} catch(Exception $e) {
    $_SESSION['error'] = 'Une erreur s\'est produite lors de la suppression: ' . $e->getMessage();
}

header("Location: list.php");
exit;
?>
