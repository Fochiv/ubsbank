<?php
require_once("connect.php");
require_once("functions.php");

if(!isset($_GET['code']) || empty($_GET['code'])){
    header("location:code.php");
    exit;
}

$code = $_GET['code'];

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
    <title>UBS Bank | Information Transaction</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/css/admin-theme.css" rel="stylesheet">
</head>

<body style="background: var(--bg-primary); min-height: 100vh; padding: 2rem;">
    <div style="position: fixed; top: 2rem; right: 2rem; z-index: 1000;">
        <button class="theme-toggle" id="theme-toggle">
            <i class="bi bi-sun-fill" id="theme-icon"></i>
        </button>
    </div>

    <div style="max-width: 1200px; margin: 0 auto;">
        <!-- En-tête -->
        <div style="text-align: center; margin-bottom: 3rem;">
            <div style="width: 100px; height: 100px; background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary)); border-radius: 20px; display: inline-flex; align-items: center; justify-content: center; font-size: 3rem; color: white; margin-bottom: 1rem;">
                <i class="bi bi-bank2"></i>
            </div>
            <h1 style="font-size: 2.5rem; font-weight: 700; color: var(--text-primary); margin-bottom: 0.5rem;">
                UBS Bank
            </h1>
            <p style="color: var(--text-secondary); font-size: 1.1rem;">
                Suivi de Transaction
            </p>
        </div>

        <!-- Progression -->
        <div class="card fade-in" style="margin-bottom: 2rem; border-left: 4px solid var(--accent-primary);">
            <div style="text-align: center; padding: 1rem;">
                <h2 style="font-size: 1.5rem; font-weight: 700; color: var(--text-primary); margin-bottom: 0.5rem;">
                    Virement en Cours
                </h2>
                <p style="color: var(--text-secondary);">
                    Cher client, veuillez lire attentivement votre suivi
                </p>
            </div>
            
            <div style="padding: 2rem;">
                <div class="progress-bar-container" style="height: 50px;">
                    <div class="progress-bar" style="width: <?php echo securiser($transaction['etat']); ?>%;">
                        <span style="font-size: 1.2rem; font-weight: 700;">
                            <?php echo securiser($transaction['etat']); ?>%
                        </span>
                    </div>
                </div>
                
                <div style="text-align: center; margin-top: 1.5rem;">
                    <p style="font-size: 1.1rem; color: var(--text-primary);">
                        <?php
                        $etat = (int)$transaction['etat'];
                        if($etat >= 100) {
                            echo '<i class="bi bi-check-circle-fill" style="color: var(--accent-success); font-size: 1.5rem;"></i><br><strong>Virement Complété avec Succès</strong>';
                        } elseif($etat >= 75) {
                            echo '<i class="bi bi-hourglass-split" style="color: var(--accent-info); font-size: 1.5rem;"></i><br><strong>Finalisation en Cours</strong>';
                        } elseif($etat >= 50) {
                            echo '<i class="bi bi-arrow-repeat" style="color: var(--accent-info); font-size: 1.5rem;"></i><br><strong>Traitement en Cours</strong>';
                        } elseif($etat >= 25) {
                            echo '<i class="bi bi-hourglass" style="color: var(--accent-warning); font-size: 1.5rem;"></i><br><strong>Vérification en Cours</strong>';
                        } else {
                            echo '<i class="bi bi-clock" style="color: var(--accent-warning); font-size: 1.5rem;"></i><br><strong>Initialisation de la Transaction</strong>';
                        }
                        ?>
                    </p>
                </div>
            </div>
        </div>

        <!-- Informations de la Transaction -->
        <div class="card fade-in" style="margin-bottom: 2rem;">
            <div class="card-header">
                <h2 class="card-title">
                    <i class="bi bi-receipt-cutoff"></i> Transaction en Cours
                </h2>
            </div>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; padding: 1rem;">
                <div style="padding: 1rem; background: var(--bg-secondary); border-radius: 10px;">
                    <p style="color: var(--text-secondary); margin-bottom: 0.5rem; font-size: 0.9rem;">
                        <i class="bi bi-hash"></i> Identifiant de la Transaction
                    </p>
                    <p style="font-weight: 700; font-size: 1.1rem; font-family: monospace; color: var(--accent-primary);">
                        <?php echo formaterIdentifiant($transaction['identification_transaction']); ?>
                    </p>
                </div>
                
                <div style="padding: 1rem; background: var(--bg-secondary); border-radius: 10px;">
                    <p style="color: var(--text-secondary); margin-bottom: 0.5rem; font-size: 0.9rem;">
                        <i class="bi bi-cash-coin"></i> Montant Transféré
                    </p>
                    <p style="font-weight: 700; font-size: 1.1rem; color: var(--accent-success);">
                        <?php echo formaterMontant($transaction['montant']); ?> <?php echo securiser($transaction['devise_compte_ex']); ?>
                    </p>
                </div>
                
                <div style="padding: 1rem; background: var(--bg-secondary); border-radius: 10px;">
                    <p style="color: var(--text-secondary); margin-bottom: 0.5rem; font-size: 0.9rem;">
                        <i class="bi bi-calendar-event"></i> Date de Transfert
                    </p>
                    <p style="font-weight: 700; font-size: 1.1rem;">
                        <?php echo date('d/m/Y', strtotime($transaction['date'])); ?>
                    </p>
                </div>
                
                <div style="padding: 1rem; background: var(--bg-secondary); border-radius: 10px;">
                    <p style="color: var(--text-secondary); margin-bottom: 0.5rem; font-size: 0.9rem;">
                        <i class="bi bi-clock"></i> Heure de Transfert
                    </p>
                    <p style="font-weight: 700; font-size: 1.1rem;">
                        <?php echo securiser($transaction['heure']); ?>
                    </p>
                </div>
            </div>
        </div>

        <!-- Détails Expéditeur et Destinataire -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
            <!-- Expéditeur -->
            <div class="card fade-in">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="bi bi-person-circle"></i> Informations Expéditeur
                    </h2>
                </div>
                
                <div style="padding: 1rem;">
                    <h3 style="font-size: 1rem; color: var(--text-secondary); margin-bottom: 1rem;">
                        Informations Personnelles
                    </h3>
                    <div style="padding: 1rem; background: var(--bg-secondary); border-radius: 10px; margin-bottom: 1.5rem;">
                        <p style="margin-bottom: 0.5rem;"><strong>Nom:</strong> <?php echo securiser($transaction['nom_ex']); ?></p>
                        <p style="margin-bottom: 0.5rem;"><strong>Prénom:</strong> <?php echo securiser($transaction['prenom_ex']); ?></p>
                        <p style="margin-bottom: 0;"><strong>Pays:</strong> <?php echo securiser($transaction['pays_ex']); ?></p>
                    </div>
                    
                    <h3 style="font-size: 1rem; color: var(--text-secondary); margin-bottom: 1rem;">
                        Informations Bancaires
                    </h3>
                    <div style="padding: 1rem; background: var(--bg-secondary); border-radius: 10px;">
                        <p style="margin-bottom: 0.5rem;"><strong>Numéro ABA:</strong> <?php echo securiser($transaction['numero_aba_ex']); ?></p>
                        <p style="margin-bottom: 0.5rem;"><strong>Numéro Compte:</strong> <?php echo securiser($transaction['numero_compte_ex']); ?></p>
                        <p style="margin-bottom: 0.5rem;"><strong>Nom Banque:</strong> <?php echo securiser($transaction['nom_banque_ex']); ?></p>
                        <p style="margin-bottom: 0;"><strong>Devise:</strong> <?php echo securiser($transaction['devise_compte_ex']); ?></p>
                    </div>
                </div>
            </div>

            <!-- Destinataire -->
            <div class="card fade-in">
                <div class="card-header">
                    <h2 class="card-title">
                        <i class="bi bi-person-check-fill"></i> Informations Destinataire
                    </h2>
                </div>
                
                <div style="padding: 1rem;">
                    <h3 style="font-size: 1rem; color: var(--text-secondary); margin-bottom: 1rem;">
                        Informations Personnelles
                    </h3>
                    <div style="padding: 1rem; background: var(--bg-secondary); border-radius: 10px; margin-bottom: 1.5rem;">
                        <p style="margin-bottom: 0.5rem;"><strong>Nom:</strong> <?php echo securiser($transaction['nom_de']); ?></p>
                        <p style="margin-bottom: 0.5rem;"><strong>Prénom:</strong> <?php echo securiser($transaction['prenom_de']); ?></p>
                        <p style="margin-bottom: 0;"><strong>Pays:</strong> <?php echo securiser($transaction['pays_de']); ?></p>
                    </div>
                    
                    <h3 style="font-size: 1rem; color: var(--text-secondary); margin-bottom: 1rem;">
                        Informations Bancaires
                    </h3>
                    <div style="padding: 1rem; background: var(--bg-secondary); border-radius: 10px;">
                        <p style="margin-bottom: 0.5rem;"><strong>Code Banque:</strong> <?php echo securiser($transaction['code_banque_de']); ?></p>
                        <p style="margin-bottom: 0.5rem;"><strong>Code Guichet:</strong> <?php echo securiser($transaction['code_guichet_de']); ?></p>
                        <p style="margin-bottom: 0.5rem;"><strong>Numéro Compte:</strong> <?php echo securiser($transaction['numero_compte_de']); ?></p>
                        <p style="margin-bottom: 0;"><strong>Code BIC:</strong> <?php echo securiser($transaction['code_bic_de']); ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Conditions Importantes -->
        <div class="card fade-in" style="border-left: 4px solid var(--accent-danger);">
            <div class="card-header">
                <h2 class="card-title">
                    <i class="bi bi-exclamation-triangle-fill" style="color: var(--accent-danger);"></i> 
                    Conditions à Respecter
                </h2>
            </div>
            
            <div style="padding: 1.5rem; background: rgba(239, 68, 68, 0.05); line-height: 1.8;">
                <?php echo nl2br(securiser($transaction['important'])); ?>
            </div>
            
            <div style="padding: 1.5rem; background: rgba(239, 68, 68, 0.1); border-top: 2px solid var(--accent-danger); text-align: center;">
                <p style="font-weight: 700; font-size: 1.1rem; color: var(--accent-danger); margin: 0;">
                    <i class="bi bi-clock-fill"></i> 
                    LE VIREMENT SERA ANNULÉ DANS LES 72H POUR MANQUE DE JUSTIFICATIFS
                </p>
            </div>
        </div>

        <!-- Actions -->
        <div style="text-align: center; margin-top: 3rem; padding-bottom: 2rem;">
            <a href="code.php" class="btn btn-primary">
                <i class="bi bi-search"></i> Consulter une autre transaction
            </a>
            <a href="../index.html" class="btn btn-sm" style="background: var(--bg-secondary); color: var(--text-primary); margin-left: 1rem;">
                <i class="bi bi-house-door"></i> Retour à l'accueil
            </a>
        </div>
    </div>

    <script src="../assets/js/theme.js"></script>
</body>
</html>
