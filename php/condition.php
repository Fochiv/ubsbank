<?php
require_once("connect.php");
require_once("functions.php");

if(isset($_POST['send'])){
    if(!empty($_POST['code'])){
        $code = $_POST['code'];
        
        // Nettoyage complet: enlever tous les espaces, tirets, et caractères invisibles
        $code_clean = preg_replace('/[^0-9]/', '', trim($code));
        
        if(empty($code_clean)){
            $erreur = 'L\'identifiant saisi n\'est pas valide. Veuillez entrer uniquement des chiffres.';
        } else {
            $req = $bdd->prepare('SELECT * FROM all_for_one WHERE code_swift = :cs');
            $req->execute(['cs' => $code_clean]);
            $user = $req->rowCount();
            
            if($user == 1){
                header("location:condition2.php?code=".$code_clean);
                exit;
            } else {
                $erreur = 'Cet identifiant de transaction n\'existe pas dans la base de données. Veuillez vérifier et réessayer.';
            }
        }
    } else {
        $erreur = 'Veuillez entrer l\'identifiant de la transaction pour modifier les conditions';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UBS Bank | Modifier les Conditions</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/css/admin-theme.css" rel="stylesheet">
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">U</div>
            <div class="sidebar-title">UBS Bank</div>
        </div>
        
        <ul class="sidebar-menu">
            <li class="sidebar-menu-item">
                <a href="../index.html" class="sidebar-menu-link">
                    <i class="bi bi-house-door-fill"></i>
                    <span>Accueil</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a href="admin.php" class="sidebar-menu-link">
                    <i class="bi bi-plus-circle-fill"></i>
                    <span>Nouvelle Transaction</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a href="list.php" class="sidebar-menu-link">
                    <i class="bi bi-list-ul"></i>
                    <span>Liste des Transactions</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a href="code.php" class="sidebar-menu-link">
                    <i class="bi bi-search"></i>
                    <span>Consulter Transaction</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a href="avancement1.php" class="sidebar-menu-link">
                    <i class="bi bi-arrow-repeat"></i>
                    <span>Modifier État</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a href="condition.php" class="sidebar-menu-link active">
                    <i class="bi bi-gear-fill"></i>
                    <span>Modifier Condition</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Contenu Principal -->
    <div class="main-content">
        <div class="top-bar">
            <div>
                <h1 class="page-title">Modifier les Conditions</h1>
                <p style="color: var(--text-secondary); margin-top: 0.5rem;">
                    Entrez l'identifiant pour modifier les conditions de la transaction
                </p>
            </div>
            <div class="top-bar-actions">
                <button class="theme-toggle" id="theme-toggle">
                    <i class="bi bi-sun-fill" id="theme-icon"></i>
                </button>
            </div>
        </div>

        <?php if(isset($erreur)): ?>
            <?php afficherErreur($erreur); ?>
        <?php endif; ?>

        <div class="card fade-in" style="max-width: 600px; margin: 2rem auto;">
            <div class="card-header">
                <h2 class="card-title">
                    <i class="bi bi-gear-fill"></i> Rechercher une Transaction
                </h2>
            </div>
            
            <form action="" method="post">
                <div class="form-group">
                    <label class="form-label">Identifiant de la Transaction *</label>
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
                
                <div style="text-align: center; margin-top: 2rem;">
                    <button type="submit" name="send" class="btn btn-primary">
                        <i class="bi bi-search"></i>
                        Rechercher et Modifier
                    </button>
                </div>
            </form>
        </div>

        <div style="text-align: center; margin-top: 2rem;">
            <a href="list.php" class="btn btn-sm" style="background: var(--bg-secondary); color: var(--text-primary);">
                <i class="bi bi-arrow-left"></i> Retour à la liste
            </a>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="../assets/js/theme.js"></script>
</body>
</html>
