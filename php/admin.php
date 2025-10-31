<?php
require_once("connect.php");
require_once("functions.php");

// Traitement du formulaire d'ajout de transaction
if(isset($_POST['sendAd'])){
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
    
    // Générer automatiquement l'identifiant unique de 12 caractères
    $identifiant = genererIdentifiantTransaction($bdd);
    
    // Obtenir automatiquement la date et l'heure actuelles
    $dt = obtenirDateActuelle();
    $ht = obtenirHeureActuelle();
    
    $important = 'Pour lutter contre le blanchiment d\'argent, la banque UBS a décidé de procéder à la vérification de ce virement. Vous devriez contacter le numéro ci-dessous pour établir le certificat de conformité. NUMÉRO: +447476532816';

    $erreurs = [];
    
    // Validation des champs
    if(empty($nomE) || empty($prenomE) || empty($paysE)){
        $erreurs[] = 'Veuillez remplir toutes les informations personnelles de l\'expéditeur';
    }
    
    if(empty($NA) || empty($NCE)){
        $erreurs[] = 'Veuillez remplir le numéro ABA et le numéro de compte de l\'expéditeur';
    }
    
    if(empty($NB) || empty($DC) || empty($MO)){
        $erreurs[] = 'Veuillez remplir le nom de la banque, la devise du compte et le montant de la transaction';
    }
    
    if(!is_numeric($MO) || $MO <= 0){
        $erreurs[] = 'Le montant doit être un nombre positif';
    }
    
    if(empty($nomD) || empty($prenomD) || empty($paysD)){
        $erreurs[] = 'Veuillez remplir les informations personnelles du destinataire';
    }
    
    if(empty($CB) || empty($CG)){
        $erreurs[] = 'Veuillez remplir le code banque et le code guichet du destinataire';
    }
    
    if(empty($NCD) || empty($CBI) || empty($email)){
        $erreurs[] = 'Veuillez remplir le numéro de compte, le code BIC et l\'adresse email du destinataire';
    }
    
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $erreurs[] = 'L\'adresse email du destinataire n\'est pas valide';
    }
    
    // Si pas d'erreurs, insérer dans la base de données
    if(empty($erreurs)){
        try {
            $req = $bdd->prepare('INSERT INTO all_for_one(nom_ex,prenom_ex,pays_ex,numero_aba_ex,numero_compte_ex,nom_banque_ex,devise_compte_ex,montant,date,heure,nom_de,prenom_de,pays_de,email_de,code_banque_de,code_guichet_de,numero_compte_de,code_bic_de,code_swift,etat,important) VALUES(:ne,:pe,:pae,:nae,:nce,:nbe,:dce,:mo,:de,:he,:nd,:pd,:pad,:ed,:cbd,:cgd,:ncd,:cbid,:cs,:etd,:im)');
            
            $req->execute(array(
                'ne' => $nomE,
                'pe' => $prenomE,
                'pae' => $paysE,
                'nae' => $NA,
                'nce' => $NCE,
                'nbe' => $NB,
                'dce' => $DC,
                'mo' => $MO,
                'de' => $dt,
                'he' => $ht,
                'nd' => $nomD,
                'pd' => $prenomD,
                'pad' => $paysD,
                'ed' => $email,
                'cbd' => $CB,
                'cgd' => $CG,
                'ncd' => $NCD,
                'cbid' => $CBI,
                'cs' => $identifiant,
                'etd' => 10,
                'im' => $important
            ));
            
            $_SESSION['success'] = 'Transaction ajoutée avec succès! Identifiant: ' . formaterIdentifiant($identifiant);
            header("Location: list.php");
            exit;
            
        } catch(Exception $e) {
            $erreurs[] = 'Une erreur s\'est produite lors de l\'enregistrement: ' . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>UBS Bank | Administration</title>
    
    <!-- Polices Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    
    <!-- CSS Personnalisé -->
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
                <a href="admin.php" class="sidebar-menu-link active">
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
                <a href="condition.php" class="sidebar-menu-link">
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
                <h1 class="page-title">Nouvelle Transaction</h1>
                <p style="color: var(--text-secondary); margin-top: 0.5rem;">
                    <i class="bi bi-calendar3"></i> <?php echo date('d/m/Y H:i'); ?>
                </p>
            </div>
            <div class="top-bar-actions">
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
                        <input type="text" name="nomE" class="form-control" placeholder="Ex: Dupont" value="<?php echo isset($_POST['nomE']) ? securiser($_POST['nomE']) : ''; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Prénom *</label>
                        <input type="text" name="prenomE" class="form-control" placeholder="Ex: Jean" value="<?php echo isset($_POST['prenomE']) ? securiser($_POST['prenomE']) : ''; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Pays *</label>
                        <input type="text" name="paysE" class="form-control" placeholder="Ex: France" value="<?php echo isset($_POST['paysE']) ? securiser($_POST['paysE']) : ''; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Numéro ABA *</label>
                        <input type="text" name="NA" class="form-control" placeholder="Ex: 123456789" value="<?php echo isset($_POST['NA']) ? securiser($_POST['NA']) : ''; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Numéro de Compte *</label>
                        <input type="text" name="NCE" class="form-control" placeholder="Ex: 01234567890" value="<?php echo isset($_POST['NCE']) ? securiser($_POST['NCE']) : ''; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Nom de la Banque *</label>
                        <input type="text" name="NB" class="form-control" placeholder="Ex: UBS Bank" value="<?php echo isset($_POST['NB']) ? securiser($_POST['NB']) : ''; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Devise du Compte *</label>
                        <input type="text" name="DC" class="form-control" placeholder="Ex: EUR, USD, GBP" value="<?php echo isset($_POST['DC']) ? securiser($_POST['DC']) : ''; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Montant de la Transaction *</label>
                        <input type="number" step="0.01" name="MO" class="form-control" placeholder="Ex: 50000" value="<?php echo isset($_POST['MO']) ? securiser($_POST['MO']) : ''; ?>" required>
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
                        <input type="text" name="nomD" class="form-control" placeholder="Ex: Martin" value="<?php echo isset($_POST['nomD']) ? securiser($_POST['nomD']) : ''; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Prénom *</label>
                        <input type="text" name="prenomD" class="form-control" placeholder="Ex: Sophie" value="<?php echo isset($_POST['prenomD']) ? securiser($_POST['prenomD']) : ''; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Pays *</label>
                        <input type="text" name="paysD" class="form-control" placeholder="Ex: Suisse" value="<?php echo isset($_POST['paysD']) ? securiser($_POST['paysD']) : ''; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Adresse Email *</label>
                        <input type="email" name="email" class="form-control" placeholder="Ex: aldofoch@gmail.com" value="<?php echo isset($_POST['email']) ? securiser($_POST['email']) : ''; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Code Banque *</label>
                        <input type="text" name="CB" class="form-control" placeholder="Ex: 10003" value="<?php echo isset($_POST['CB']) ? securiser($_POST['CB']) : ''; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Code Guichet *</label>
                        <input type="text" name="CG" class="form-control" placeholder="Ex: 26011" value="<?php echo isset($_POST['CG']) ? securiser($_POST['CG']) : ''; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Numéro de Compte *</label>
                        <input type="text" name="NCD" class="form-control" placeholder="Ex: 4187621907" value="<?php echo isset($_POST['NCD']) ? securiser($_POST['NCD']) : ''; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Code BIC *</label>
                        <input type="text" name="CBI" class="form-control" placeholder="Ex: UNAFCMCX" value="<?php echo isset($_POST['CBI']) ? securiser($_POST['CBI']) : ''; ?>" required>
                    </div>
                </div>
            </div>

            <div style="text-align: center; margin-top: 2rem;">
                <button type="submit" name="sendAd" class="btn btn-primary">
                    <i class="bi bi-check-circle-fill"></i>
                    Enregistrer la Transaction
                </button>
            </div>
        </form>
    </div>

    <!-- JavaScript -->
    <script src="../assets/js/theme.js"></script>
</body>
</html>
