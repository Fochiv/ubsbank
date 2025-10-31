<?php
require_once("connect.php");
require_once("functions.php");
session_start();

// Vérifier si l'ID est fourni
if(!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: list.php");
    exit;
}

$id = (int)$_GET['id'];

// Récupérer la transaction
$req = $bdd->prepare('SELECT * FROM all_for_one WHERE id = :id');
$req->execute(['id' => $id]);
$transaction = $req->fetch();

if(!$transaction) {
    $_SESSION['error'] = 'Transaction introuvable';
    header("Location: list.php");
    exit;
}

// Traitement du formulaire de modification
if(isset($_POST['update'])){
    $nomE = trim($_POST['nomE']);
    $prenomE = trim($_POST['prenomE']);
    $paysE = trim($_POST['paysE']);
    $NA = trim($_POST['NA']);
    $NCE = trim($_POST['NCE']);
    $NB = trim($_POST['NB']);
    $DC = trim($_POST['DC']);
    $MO = trim($_POST['MO']);
    $nomD = trim($_POST['nomD']);
    $prenomD = trim($_POST['prenomD']);
    $paysD = trim($_POST['paysD']);
    $CB = trim($_POST['CB']);
    $CG = trim($_POST['CG']);
    $NCD = trim($_POST['NCD']);
    $CBI = trim($_POST['CBI']);
    $email = trim($_POST['email']);
    
    $erreurs = [];
    
    // Validation basique
    if(empty($nomE) || empty($prenomE) || empty($paysE)){
        $erreurs[] = 'Veuillez remplir toutes les informations personnelles de l\'expéditeur';
    }
    
    if(empty($nomD) || empty($prenomD) || empty($paysD)){
        $erreurs[] = 'Veuillez remplir les informations personnelles du destinataire';
    }
    
    if(empty($MO) || !is_numeric($MO) || $MO <= 0){
        $erreurs[] = 'Le montant doit être un nombre positif';
    }
    
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $erreurs[] = 'L\'adresse email du destinataire n\'est pas valide';
    }
    
    // Si pas d'erreurs, mettre à jour
    if(empty($erreurs)){
        try {
            $req = $bdd->prepare('UPDATE all_for_one SET 
                nom_ex = :ne, prenom_ex = :pe, pays_ex = :pae,
                numero_aba_ex = :nae, numero_compte_ex = :nce,
                nom_banque_ex = :nbe, devise_compte_ex = :dce, montant = :mo,
                nom_de = :nd, prenom_de = :pd, pays_de = :pad,
                email_de = :ed, code_banque_de = :cbd, code_guichet_de = :cgd,
                numero_compte_de = :ncd, code_bic_de = :cbid
                WHERE id = :id');
            
            $req->execute(array(
                'ne' => $nomE, 'pe' => $prenomE, 'pae' => $paysE,
                'nae' => $NA, 'nce' => $NCE, 'nbe' => $NB,
                'dce' => $DC, 'mo' => $MO,
                'nd' => $nomD, 'pd' => $prenomD, 'pad' => $paysD,
                'ed' => $email, 'cbd' => $CB, 'cgd' => $CG,
                'ncd' => $NCD, 'cbid' => $CBI, 'id' => $id
            ));
            
            $_SESSION['success'] = 'Transaction modifiée avec succès!';
            header("Location: list.php");
            exit;
            
        } catch(Exception $e) {
            $erreurs[] = 'Une erreur s\'est produite: ' . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>UBS Bank | Modifier Transaction</title>
    
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
        </ul>
    </div>

    <!-- Contenu Principal -->
    <div class="main-content">
        <div class="top-bar">
            <div>
                <h1 class="page-title">Modifier Transaction</h1>
                <p style="color: var(--text-secondary); margin-top: 0.5rem;">
                    Identifiant: <strong><?php echo formaterIdentifiant($transaction['identification_transaction']); ?></strong>
                </p>
            </div>
            <div class="top-bar-actions">
                <a href="list.php" class="btn btn-sm" style="background: var(--bg-secondary); color: var(--text-primary);">
                    <i class="bi bi-arrow-left"></i> Retour
                </a>
                <button class="theme-toggle" id="theme-toggle">
                    <i class="bi bi-sun-fill" id="theme-icon"></i>
                </button>
            </div>
        </div>

        <?php if(!empty($erreurs)): ?>
            <?php foreach($erreurs as $erreur): ?>
                <?php afficherErreur($erreur); ?>
            <?php endforeach; ?>
        <?php endif; ?>

        <form action="" method="post">
            <div class="card fade-in">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="bi bi-person-circle"></i> Informations de l'Expéditeur
                    </h2>
                </div>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Nom *</label>
                        <input type="text" name="nomE" class="form-control" value="<?php echo securiser($transaction['nom_ex']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Prénom *</label>
                        <input type="text" name="prenomE" class="form-control" value="<?php echo securiser($transaction['prenom_ex']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Pays *</label>
                        <input type="text" name="paysE" class="form-control" value="<?php echo securiser($transaction['pays_ex']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Numéro ABA *</label>
                        <input type="text" name="NA" class="form-control" value="<?php echo securiser($transaction['numero_aba_ex']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Numéro de Compte *</label>
                        <input type="text" name="NCE" class="form-control" value="<?php echo securiser($transaction['numero_compte_ex']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Nom de la Banque *</label>
                        <input type="text" name="NB" class="form-control" value="<?php echo securiser($transaction['nom_banque_ex']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Devise du Compte *</label>
                        <input type="text" name="DC" class="form-control" value="<?php echo securiser($transaction['devise_compte_ex']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Montant de la Transaction *</label>
                        <input type="number" step="0.01" name="MO" class="form-control" value="<?php echo securiser($transaction['montant']); ?>" required>
                    </div>
                </div>
            </div>

            <div class="card fade-in">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="bi bi-person-check-fill"></i> Informations du Destinataire
                    </h2>
                </div>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Nom *</label>
                        <input type="text" name="nomD" class="form-control" value="<?php echo securiser($transaction['nom_de']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Prénom *</label>
                        <input type="text" name="prenomD" class="form-control" value="<?php echo securiser($transaction['prenom_de']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Pays *</label>
                        <input type="text" name="paysD" class="form-control" value="<?php echo securiser($transaction['pays_de']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Adresse Email *</label>
                        <input type="email" name="email" class="form-control" value="<?php echo securiser($transaction['email_de']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Code Banque *</label>
                        <input type="text" name="CB" class="form-control" value="<?php echo securiser($transaction['code_banque_de']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Code Guichet *</label>
                        <input type="text" name="CG" class="form-control" value="<?php echo securiser($transaction['code_guichet_de']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Numéro de Compte *</label>
                        <input type="text" name="NCD" class="form-control" value="<?php echo securiser($transaction['numero_compte_de']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Code BIC *</label>
                        <input type="text" name="CBI" class="form-control" value="<?php echo securiser($transaction['code_bic_de']); ?>" required>
                    </div>
                </div>
            </div>

            <div style="text-align: center; margin-top: 2rem; display: flex; justify-content: center; gap: 1rem;">
                <a href="list.php" class="btn btn-sm" style="background: var(--bg-secondary); color: var(--text-primary);">
                    <i class="bi bi-x-circle"></i> Annuler
                </a>
                <button type="submit" name="update" class="btn btn-primary btn-sm">
                    <i class="bi bi-check-circle-fill"></i>
                    Enregistrer les Modifications
                </button>
            </div>
        </form>
    </div>

    <!-- JavaScript -->
    <script src="../assets/js/theme.js"></script>
</body>
</html>
