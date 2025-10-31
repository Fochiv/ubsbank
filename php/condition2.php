<?php
require_once("connect.php");
require_once("functions.php");

if(!isset($_GET['code']) || empty($_GET['code'])){
    header("location:condition.php");
    exit;
}

$code = $_GET['code'];

$req2 = $bdd->prepare('SELECT * FROM all_for_one WHERE code_swift = :cs');
$req2->execute(['cs' => $code]);
$rep2 = $req2->fetch();

if(!$rep2){
    header("location:condition.php");
    exit;
}

if(isset($_POST['send'])){
    if(!empty($_POST['condition'])){
        $condition = $_POST['condition'];
        $req = $bdd->prepare('UPDATE all_for_one SET important = :im WHERE code_swift = :cs');
        $req->execute(['im' => $condition, 'cs' => $code]);
        $succes = 'Conditions de la transaction mises à jour avec succès!';
        
        $req2 = $bdd->prepare('SELECT * FROM all_for_one WHERE code_swift = :cs');
        $req2->execute(['cs' => $code]);
        $rep2 = $req2->fetch();
    } else {
        $erreur = 'Veuillez entrer la nouvelle condition';
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
                    Modifiez les conditions de la transaction #<?php echo formaterIdentifiant($rep2['code_swift']); ?>
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

        <?php if(isset($succes)): ?>
            <?php afficherSucces($succes); ?>
        <?php endif; ?>

        <!-- Informations de la Transaction -->
        <div class="card fade-in" style="margin-bottom: 2rem;">
            <div class="card-header">
                <h2 class="card-title">
                    <i class="bi bi-info-circle-fill"></i> Informations de la Transaction
                </h2>
            </div>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; padding: 1rem;">
                <div style="padding: 1rem; background: var(--bg-secondary); border-radius: 10px;">
                    <p style="color: var(--text-secondary); margin-bottom: 0.5rem; font-size: 0.9rem;">
                        <i class="bi bi-hash"></i> Identifiant de la Transaction
                    </p>
                    <p style="font-weight: 700; font-size: 1.1rem; font-family: monospace; color: var(--accent-primary);">
                        <?php echo formaterIdentifiant($rep2['code_swift']); ?>
                    </p>
                </div>
                
                <div style="padding: 1rem; background: var(--bg-secondary); border-radius: 10px;">
                    <p style="color: var(--text-secondary); margin-bottom: 0.5rem; font-size: 0.9rem;">
                        <i class="bi bi-cash-coin"></i> Montant Transféré
                    </p>
                    <p style="font-weight: 700; font-size: 1.1rem; color: var(--accent-success);">
                        <?php echo formaterMontant($rep2['montant']); ?> <?php echo securiser($rep2['devise_compte_ex']); ?>
                    </p>
                </div>
                
                <div style="padding: 1rem; background: var(--bg-secondary); border-radius: 10px;">
                    <p style="color: var(--text-secondary); margin-bottom: 0.5rem; font-size: 0.9rem;">
                        <i class="bi bi-calendar-event"></i> Date de Transfert
                    </p>
                    <p style="font-weight: 700; font-size: 1.1rem;">
                        <?php echo date('d/m/Y', strtotime($rep2['date'])); ?>
                    </p>
                </div>
                
                <div style="padding: 1rem; background: var(--bg-secondary); border-radius: 10px;">
                    <p style="color: var(--text-secondary); margin-bottom: 0.5rem; font-size: 0.9rem;">
                        <i class="bi bi-percent"></i> État d'Avancement
                    </p>
                    <p style="font-weight: 700; font-size: 1.1rem;">
                        <?php echo getBadgeEtat($rep2['etat']); ?>
                    </p>
                </div>
            </div>
        </div>

        <!-- Formulaire de Modification -->
        <div class="card fade-in" style="max-width: 800px; margin: 0 auto;">
            <div class="card-header">
                <h2 class="card-title">
                    <i class="bi bi-exclamation-triangle-fill"></i> Modifier les Conditions Importantes
                </h2>
            </div>
            
            <div style="padding: 0.5rem;">
                <?php if(!empty($rep2['important'])): ?>
                <div style="padding: 1.5rem; background: rgba(239, 68, 68, 0.05); border-radius: 10px; border: 2px solid var(--accent-danger); margin-bottom: 1.5rem;">
                    <h3 style="font-size: 1rem; color: var(--accent-danger); margin-bottom: 1rem;">
                        <i class="bi bi-info-circle-fill"></i> Conditions Actuelles:
                    </h3>
                    <div style="color: var(--text-primary); line-height: 1.8; white-space: pre-wrap;">
                        <?php echo nl2br(securiser($rep2['important'])); ?>
                    </div>
                </div>
                <?php endif; ?>
                
                <form action="" method="post">
                    <div class="form-group">
                        <label class="form-label">
                            <i class="bi bi-file-text"></i> Nouvelles Conditions *
                        </label>
                        <textarea 
                            name="condition" 
                            class="form-control" 
                            placeholder="Entrez les nouvelles conditions importantes pour cette transaction..."
                            rows="8"
                            required
                            style="font-family: inherit; resize: vertical;"><?php echo isset($_POST['condition']) ? securiser($_POST['condition']) : securiser($rep2['important']); ?></textarea>
                        <small style="color: var(--text-secondary); display: block; margin-top: 0.5rem;">
                            <i class="bi bi-info-circle"></i> Ces conditions seront affichées au client lors de la consultation de la transaction
                        </small>
                    </div>
                    
                    <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                        <button type="submit" name="send" class="btn btn-primary" style="flex: 1;">
                            <i class="bi bi-check-circle-fill"></i>
                            Mettre à Jour
                        </button>
                        <a href="condition.php" class="btn btn-sm" style="background: var(--bg-secondary); color: var(--text-primary); flex: 1; text-align: center; text-decoration: none; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-arrow-left"></i> Retour
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div style="text-align: center; margin-top: 2rem; padding-bottom: 2rem;">
            <a href="list.php" class="btn btn-sm" style="background: var(--bg-secondary); color: var(--text-primary);">
                <i class="bi bi-list-ul"></i> Voir toutes les transactions
            </a>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="../assets/js/theme.js"></script>
</body>
</html>
