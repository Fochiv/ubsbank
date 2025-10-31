<?php
require_once("connect.php");
require_once("functions.php");

if(isset($_POST['send'])){
    if(!empty($_POST['code'])){
        $code = $_POST['code'];
        
        // Nettoyage complet: enlever tous les espaces, tirets, et caractères invisibles
        $code_clean = preg_replace('/[^0-9]/', '', trim($code));
        
        // Debugging: afficher l'identifiant nettoyé (à supprimer après test)
        // echo "DEBUG: Code saisi = '" . $code . "' | Code nettoyé = '" . $code_clean . "' | Longueur = " . strlen($code_clean) . "<br>";
        
        if(empty($code_clean)){
            $erreur = 'L\'identifiant saisi n\'est pas valide. Veuillez entrer uniquement des chiffres.';
        } else {
            $req = $bdd->prepare('SELECT * FROM all_for_one WHERE code_swift = :cs');
            $req->execute(['cs' => $code_clean]);
            $user = $req->rowCount();
            
            if($user == 1){
                header("location:info.php?code=".$code_clean);
                exit;
            } else {
                $erreur = 'Cet identifiant de transaction ne correspond à aucune transaction! Veuillez contacter votre agence ou votre banquier.';
            }
        }
    } else {
        $erreur = 'Veuillez entrer l\'identifiant de la transaction à consulter';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UBS Bank | Consulter une Transaction</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/css/admin-theme.css" rel="stylesheet">
    
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 2rem;
        }
        
        .consultation-card {
            background: var(--bg-card);
            padding: 3rem;
            border-radius: 20px;
            box-shadow: var(--shadow-lg);
            max-width: 500px;
            width: 100%;
            text-align: center;
        }
        
        .consultation-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            color: white;
            margin-bottom: 2rem;
        }
        
        .consultation-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--text-primary);
        }
        
        .consultation-description {
            color: var(--text-secondary);
            margin-bottom: 2rem;
            line-height: 1.6;
        }
        
        .back-link {
            margin-top: 2rem;
            display: inline-block;
            color: var(--accent-primary);
            text-decoration: none;
            font-weight: 600;
        }
        
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="top-bar-actions" style="position: fixed; top: 2rem; right: 2rem;">
        <button class="theme-toggle" id="theme-toggle">
            <i class="bi bi-sun-fill" id="theme-icon"></i>
        </button>
    </div>

    <div class="consultation-card fade-in">
        <div class="consultation-icon">
            <i class="bi bi-search"></i>
        </div>
        
        <h1 class="consultation-title">Consulter une Transaction</h1>
        
        <p class="consultation-description">
            Entrez l'identifiant de votre transaction pour consulter son statut et les détails complets.
        </p>

        <?php if(isset($erreur)): ?>
            <?php afficherErreur($erreur); ?>
        <?php endif; ?>

        <form action="" method="post">
            <div class="form-group">
                <label class="form-label" style="text-align: left;">Identifiant de la Transaction</label>
                <input type="text" 
                       name="code" 
                       class="form-control" 
                       placeholder="Ex: 123-456-789-012" 
                       style="text-align: center; font-family: monospace; font-size: 1.2rem; letter-spacing: 2px;"
                       value="<?php echo isset($_POST['code']) ? securiser($_POST['code']) : ''; ?>"
                       required>
                <small style="color: var(--text-secondary); display: block; margin-top: 0.5rem;">
                    <i class="bi bi-info-circle"></i> Format: XXX-XXX-XXX-XXX (12 chiffres)
                </small>
            </div>
            
            <button type="submit" name="send" class="btn btn-primary" style="width: 100%; margin-top: 1.5rem;">
                <i class="bi bi-search"></i>
                Consulter
            </button>
        </form>

        <a href="../index.html" class="back-link">
            <i class="bi bi-arrow-left"></i> Retour à l'accueil
        </a>
    </div>

    <script src="../assets/js/theme.js"></script>
</body>
</html>
