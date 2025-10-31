<?php
require_once("connect.php");
require_once("functions.php");

if(!isset($_GET['id']) || empty($_GET['id'])){
    header("location:code.php");
    exit;
}

$code = $_GET['id'];

$req = $bdd->prepare('SELECT * FROM all_for_one WHERE identification_transaction = :cs');
$req->execute(['cs' => $code]);
$transaction = $req->fetch();

if(!$transaction){
    header("location:code.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>UBS Bank | Détails de la Transaction</title>
    
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
                <a href="list.php" class="sidebar-menu-link">
                    <i class="bi bi-list-ul"></i>
                    <span>Liste des Transactions</span>
                </a>
            </li>
            <li class="sidebar-menu-item">
                <a href="code.php" class="sidebar-menu-link active">
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
                <h1 class="page-title">Détails de la Transaction</h1>
                <p style="color: var(--text-secondary); margin-top: 0.5rem;">
                    Identifiant: <strong style="font-family: monospace;"><?php echo formaterIdentifiant($transaction['identification_transaction']); ?></strong>
                </p>
            </div>
            <div class="top-bar-actions">
                <button class="theme-toggle" id="theme-toggle">
                    <i class="bi bi-sun-fill" id="theme-icon"></i>
                </button>
            </div>
        </div>

        <!-- Informations Générales -->
        <div class="stats-grid">
            <div class="stat-card fade-in">
                <div class="stat-card-header">
                    <div>
                        <p class="stat-card-title">Montant</p>
                        <p class="stat-card-value"><?php echo formaterMontant($transaction['montant']); ?></p>
                        <small style="color: var(--text-secondary);"><?php echo securiser($transaction['devise_compte_ex']); ?></small>
                    </div>
                    <div class="stat-card-icon success">
                        <i class="bi bi-cash-stack"></i>
                    </div>
                </div>
            </div>

            <div class="stat-card fade-in">
                <div class="stat-card-header">
                    <div>
                        <p class="stat-card-title">Date</p>
                        <p class="stat-card-value" style="font-size: 1.5rem;"><?php echo date('d/m/Y', strtotime($transaction['date'])); ?></p>
                        <small style="color: var(--text-secondary);"><?php echo securiser($transaction['heure']); ?></small>
                    </div>
                    <div class="stat-card-icon info">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                </div>
            </div>

            <div class="stat-card fade-in">
                <div class="stat-card-header">
                    <div>
                        <p class="stat-card-title">État</p>
                        <p class="stat-card-value" style="font-size: 1.5rem;"><?php echo securiser($transaction['etat']); ?>%</p>
                        <?php echo getBadgeEtat($transaction['etat']); ?>
                    </div>
                    <div class="stat-card-icon warning">
                        <i class="bi bi-hourglass-split"></i>
                    </div>
                </div>
            </div>

            <div class="stat-card fade-in">
                <div class="stat-card-header">
                    <div>
                        <p class="stat-card-title">Transaction</p>
                        <p class="stat-card-value" style="font-size: 1.5rem;">#<?php echo securiser($transaction['id']); ?></p>
                        <small style="color: var(--text-secondary);">ID Transaction</small>
                    </div>
                    <div class="stat-card-icon primary">
                        <i class="bi bi-receipt"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Barre de Progression -->
        <div class="card fade-in">
            <div class="card-header">
                <h2 class="card-title">
                    <i class="bi bi-bar-chart-fill"></i> Progression du Virement
                </h2>
            </div>
            <div class="progress-bar-container">
                <div class="progress-bar" style="width: <?php echo securiser($transaction['etat']); ?>%;">
                    <?php echo securiser($transaction['etat']); ?>%
                </div>
            </div>
            <p style="text-align: center; margin-top: 1rem; color: var(--text-secondary);">
                <?php
                $etat = (int)$transaction['etat'];
                if($etat >= 100) {
                    echo '<i class="bi bi-check-circle-fill" style="color: var(--accent-success);"></i> Virement complété avec succès';
                } elseif($etat >= 50) {
                    echo '<i class="bi bi-hourglass-split" style="color: var(--accent-info);"></i> Virement en cours de traitement';
                } else {
                    echo '<i class="bi bi-clock" style="color: var(--accent-warning);"></i> Virement en cours d\'initialisation';
                }
                ?>
            </p>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
            <!-- Informations Expéditeur -->
            <div class="card fade-in">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="bi bi-person-circle"></i> Expéditeur
                    </h2>
                </div>
                
                <div style="margin-bottom: 1.5rem;">
                    <h3 style="font-size: 1.1rem; margin-bottom: 0.5rem; color: var(--text-secondary);">Informations Personnelles</h3>
                    <div style="padding: 1rem; background: var(--bg-secondary); border-radius: 10px;">
                        <p style="margin-bottom: 0.5rem;"><strong>Nom:</strong> <?php echo securiser($transaction['nom_ex']); ?></p>
                        <p style="margin-bottom: 0.5rem;"><strong>Prénom:</strong> <?php echo securiser($transaction['prenom_ex']); ?></p>
                        <p style="margin-bottom: 0;"><strong>Pays:</strong> <?php echo securiser($transaction['pays_ex']); ?></p>
                    </div>
                </div>
                
                <div>
                    <h3 style="font-size: 1.1rem; margin-bottom: 0.5rem; color: var(--text-secondary);">Informations Bancaires</h3>
                    <div style="padding: 1rem; background: var(--bg-secondary); border-radius: 10px;">
                        <p style="margin-bottom: 0.5rem;"><strong>Numéro ABA:</strong> <?php echo securiser($transaction['numero_aba_ex']); ?></p>
                        <p style="margin-bottom: 0.5rem;"><strong>Numéro de Compte:</strong> <?php echo securiser($transaction['numero_compte_ex']); ?></p>
                        <p style="margin-bottom: 0.5rem;"><strong>Nom de la Banque:</strong> <?php echo securiser($transaction['nom_banque_ex']); ?></p>
                        <p style="margin-bottom: 0;"><strong>Devise:</strong> <?php echo securiser($transaction['devise_compte_ex']); ?></p>
                    </div>
                </div>
            </div>

            <!-- Informations Destinataire -->
            <div class="card fade-in">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="bi bi-person-check-fill"></i> Destinataire
                    </h2>
                </div>
                
                <div style="margin-bottom: 1.5rem;">
                    <h3 style="font-size: 1.1rem; margin-bottom: 0.5rem; color: var(--text-secondary);">Informations Personnelles</h3>
                    <div style="padding: 1rem; background: var(--bg-secondary); border-radius: 10px;">
                        <p style="margin-bottom: 0.5rem;"><strong>Nom:</strong> <?php echo securiser($transaction['nom_de']); ?></p>
                        <p style="margin-bottom: 0.5rem;"><strong>Prénom:</strong> <?php echo securiser($transaction['prenom_de']); ?></p>
                        <p style="margin-bottom: 0.5rem;"><strong>Pays:</strong> <?php echo securiser($transaction['pays_de']); ?></p>
                        <p style="margin-bottom: 0;"><strong>Email:</strong> <?php echo securiser($transaction['email_de']); ?></p>
                    </div>
                </div>
                
                <div>
                    <h3 style="font-size: 1.1rem; margin-bottom: 0.5rem; color: var(--text-secondary);">Informations Bancaires</h3>
                    <div style="padding: 1rem; background: var(--bg-secondary); border-radius: 10px;">
                        <p style="margin-bottom: 0.5rem;"><strong>Code Banque:</strong> <?php echo securiser($transaction['code_banque_de']); ?></p>
                        <p style="margin-bottom: 0.5rem;"><strong>Code Guichet:</strong> <?php echo securiser($transaction['code_guichet_de']); ?></p>
                        <p style="margin-bottom: 0.5rem;"><strong>Numéro de Compte:</strong> <?php echo securiser($transaction['numero_compte_de']); ?></p>
                        <p style="margin-bottom: 0;"><strong>Code BIC:</strong> <?php echo securiser($transaction['code_bic_de']); ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Conditions à Respecter -->
        <?php if(!empty($transaction['important'])): ?>
        <div class="card fade-in" style="border-left: 4px solid var(--accent-warning);">
            <div class="card-header">
                <h2 class="card-title">
                    <i class="bi bi-exclamation-triangle-fill" style="color: var(--accent-warning);"></i> 
                    Conditions à Respecter
                </h2>
            </div>
            <div style="padding: 1rem; background: rgba(245, 158, 11, 0.1); border-radius: 10px; line-height: 1.6;">
                <?php echo nl2br(securiser($transaction['important'])); ?>
            </div>
            <div style="margin-top: 1rem; padding: 1rem; background: rgba(239, 68, 68, 0.1); border: 2px solid var(--accent-danger); border-radius: 10px; text-align: center;">
                <strong style="color: var(--accent-danger); font-size: 1.1rem;">
                    <i class="bi bi-clock-fill"></i> 
                    LE VIREMENT SERA ANNULÉ DANS LES 72H POUR MANQUE DE JUSTIFICATIFS
                </strong>
            </div>
        </div>
        <?php endif; ?>

        <div style="text-align: center; margin-top: 2rem;">
            <a href="code.php" class="btn btn-primary">
                <i class="bi bi-search"></i> Consulter une autre transaction
            </a>
        </div>
    </div>

    <script src="../assets/js/theme.js"></script>
</body>
</html>
