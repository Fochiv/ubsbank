<?php
require_once("connect.php");

echo "<h2>Diagnostic de la Base de Données</h2>";
echo "<hr>";

// Vérifier le type de base de données
echo "<h3>Type de base de données:</h3>";
echo "<p>" . $bdd->getAttribute(PDO::ATTR_DRIVER_NAME) . "</p>";

// Compter les transactions
try {
    $count = $bdd->query('SELECT COUNT(*) FROM all_for_one')->fetchColumn();
    echo "<h3>Nombre de transactions:</h3>";
    echo "<p>" . $count . "</p>";
} catch(Exception $e) {
    echo "<p style='color: red;'>Erreur: " . $e->getMessage() . "</p>";
}

// Afficher quelques transactions
try {
    echo "<h3>Dernières transactions (avec identifiants):</h3>";
    $req = $bdd->query('SELECT id, nom_ex, prenom_ex, identification_transaction, LENGTH(identification_transaction) as longueur FROM all_for_one LIMIT 10');
    
    echo "<table border='1' cellpadding='10' style='border-collapse: collapse;'>";
    echo "<tr><th>ID</th><th>Nom</th><th>Prénom</th><th>Identifiant (identification_transaction)</th><th>Longueur</th></tr>";
    
    while($row = $req->fetch(PDO::FETCH_ASSOC)){
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['nom_ex'] . "</td>";
        echo "<td>" . $row['prenom_ex'] . "</td>";
        echo "<td><strong>" . $row['identification_transaction'] . "</strong></td>";
        echo "<td>" . $row['longueur'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
} catch(Exception $e) {
    echo "<p style='color: red;'>Erreur: " . $e->getMessage() . "</p>";
}

// Test de recherche
echo "<h3>Test de recherche:</h3>";
echo "<form method='post'>";
echo "<input type='text' name='test_code' placeholder='Entrez un identifiant' value='" . (isset($_POST['test_code']) ? htmlspecialchars($_POST['test_code']) : '') . "'>";
echo "<button type='submit'>Tester</button>";
echo "</form>";

if(isset($_POST['test_code'])){
    $test_code = $_POST['test_code'];
    $test_clean = preg_replace('/[^0-9]/', '', trim($test_code));
    
    echo "<p>Code saisi: '<strong>" . htmlspecialchars($test_code) . "</strong>'</p>";
    echo "<p>Code nettoyé: '<strong>" . $test_clean . "</strong>' (longueur: " . strlen($test_clean) . ")</p>";
    
    try {
        $req = $bdd->prepare('SELECT * FROM all_for_one WHERE identification_transaction = :cs');
        $req->execute(['cs' => $test_clean]);
        $result = $req->fetch(PDO::FETCH_ASSOC);
        
        if($result){
            echo "<p style='color: green;'>✅ TRANSACTION TROUVÉE!</p>";
            echo "<p>Nom: " . $result['nom_ex'] . " " . $result['prenom_ex'] . "</p>";
            echo "<p>Montant: " . $result['montant'] . "</p>";
        } else {
            echo "<p style='color: red;'>❌ AUCUNE TRANSACTION TROUVÉE</p>";
            
            // Chercher des identifiants similaires
            echo "<p>Recherche d'identifiants similaires...</p>";
            $similar = $bdd->query("SELECT identification_transaction FROM all_for_one WHERE identification_transaction LIKE '%" . substr($test_clean, 0, 4) . "%' LIMIT 5");
            echo "<ul>";
            while($row = $similar->fetch(PDO::FETCH_ASSOC)){
                echo "<li>" . $row['identification_transaction'] . "</li>";
            }
            echo "</ul>";
        }
    } catch(Exception $e) {
        echo "<p style='color: red;'>Erreur de recherche: " . $e->getMessage() . "</p>";
    }
}
?>
