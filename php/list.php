<?php
require_once("connect.php");
require_once("functions.php");
session_start();

// Récupérer toutes les transactions
$req = $bdd->query('SELECT * FROM all_for_one ORDER BY id DESC');
$transactions = $req->fetchAll();

// Calculer les statistiques
$total_transactions = count($transactions);
$total_montant = 0;
$completed = 0;
$en_cours = 0;

foreach($transactions as $trans) {
    $total_montant += (float)$trans['montant'];
    if((int)$trans['etat'] >= 100) {
        $completed++;
    } else {
        $en_cours++;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>UBS Bank | Liste des Transactions</title>
    
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
                <a href="list.php" class="sidebar-menu-link active">
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
                <h1 class="page-title">Tableau de Bord</h1>
                <p style="color: var(--text-secondary); margin-top: 0.5rem;">
                    Gérez vos transactions depuis cette interface
                </p>
            </div>
            <div class="top-bar-actions">
                <button class="theme-toggle" id="theme-toggle">
                    <i class="bi bi-sun-fill" id="theme-icon"></i>
                </button>
            </div>
        </div>

        <?php if(isset($_SESSION['success'])): ?>
            <?php afficherSucces($_SESSION['success']); unset($_SESSION['success']); ?>
        <?php endif; ?>

        <!-- Statistiques -->
        <div class="stats-grid">
            <div class="stat-card fade-in">
                <div class="stat-card-header">
                    <div>
                        <p class="stat-card-title">Total Transactions</p>
                        <p class="stat-card-value"><?php echo $total_transactions; ?></p>
                    </div>
                    <div class="stat-card-icon primary">
                        <i class="bi bi-receipt"></i>
                    </div>
                </div>
            </div>

            <div class="stat-card fade-in">
                <div class="stat-card-header">
                    <div>
                        <p class="stat-card-title">Montant Total</p>
                        <p class="stat-card-value"><?php echo formaterMontant($total_montant); ?></p>
                    </div>
                    <div class="stat-card-icon success">
                        <i class="bi bi-cash-coin"></i>
                    </div>
                </div>
            </div>

            <div class="stat-card fade-in">
                <div class="stat-card-header">
                    <div>
                        <p class="stat-card-title">Complétées</p>
                        <p class="stat-card-value"><?php echo $completed; ?></p>
                    </div>
                    <div class="stat-card-icon info">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                </div>
            </div>

            <div class="stat-card fade-in">
                <div class="stat-card-header">
                    <div>
                        <p class="stat-card-title">En Cours</p>
                        <p class="stat-card-value"><?php echo $en_cours; ?></p>
                    </div>
                    <div class="stat-card-icon warning">
                        <i class="bi bi-arrow-repeat"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tableau des Transactions -->
        <div class="card fade-in">
            <div class="card-header">
                <h2 class="card-title">
                    <i class="bi bi-table"></i> Liste des Transactions
                </h2>
                <div class="search-box">
                    <i class="bi bi-search"></i>
                    <input type="text" placeholder="Rechercher par identifiant, nom..." class="search-input">
                </div>
            </div>

            <div class="table-container">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Identifiant</th>
                            <th>Expéditeur</th>
                            <th>Destinataire</th>
                            <th>Montant</th>
                            <th>Date</th>
                            <th>État</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($transactions as $trans): ?>
                        <tr>
                            <td>#<?php echo securiser($trans['id']); ?></td>
                            <td>
                                <strong style="color: var(--accent-primary); font-family: monospace;">
                                    <?php echo formaterIdentifiant($trans['code_swift']); ?>
                                </strong>
                            </td>
                            <td>
                                <?php echo securiser($trans['nom_ex']) . ' ' . securiser($trans['prenom_ex']); ?><br>
                                <small style="color: var(--text-secondary);"><?php echo securiser($trans['pays_ex']); ?></small>
                            </td>
                            <td>
                                <?php echo securiser($trans['nom_de']) . ' ' . securiser($trans['prenom_de']); ?><br>
                                <small style="color: var(--text-secondary);"><?php echo securiser($trans['pays_de']); ?></small>
                            </td>
                            <td>
                                <strong><?php echo formaterMontant($trans['montant']); ?></strong>
                                <small style="color: var(--text-secondary);"> <?php echo securiser($trans['devise_compte_ex']); ?></small>
                            </td>
                            <td>
                                <?php echo date('d/m/Y', strtotime($trans['date'])); ?><br>
                                <small style="color: var(--text-secondary);"><?php echo securiser($trans['heure']); ?></small>
                            </td>
                            <td><?php echo getBadgeEtat($trans['etat']); ?></td>
                            <td>
                                <div style="display: flex; gap: 0.5rem;">
                                    <a href="details_transaction.php?id=<?php echo $trans['code_swift']; ?>" 
                                       class="btn btn-info btn-sm btn-icon" 
                                       title="Détails">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                    <a href="edit_transaction.php?id=<?php echo $trans['id']; ?>" 
                                       class="btn btn-warning btn-sm btn-icon" 
                                       title="Modifier">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <button onclick="confirmDelete('<?php echo $trans['code_swift']; ?>', '<?php echo securiser($trans['nom_de']); ?>', '<?php echo securiser($trans['prenom_de']); ?>')" 
                                            class="btn btn-danger btn-sm btn-icon" 
                                            title="Supprimer">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        
                        <?php if(empty($transactions)): ?>
                        <tr>
                            <td colspan="8" style="text-align: center; padding: 3rem; color: var(--text-secondary);">
                                <i class="bi bi-inbox" style="font-size: 3rem; display: block; margin-bottom: 1rem;"></i>
                                Aucune transaction enregistrée
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal de Confirmation de Suppression -->
    <div class="modal-overlay" id="delete-modal">
        <div class="modal">
            <div class="modal-header">
                <h3 class="modal-title">
                    <i class="bi bi-exclamation-triangle-fill" style="color: var(--accent-danger);"></i>
                    Confirmation de Suppression
                </h3>
            </div>
            <div class="modal-body">
                <p id="delete-modal-text"></p>
                <p style="color: var(--text-secondary); margin-top: 1rem;">
                    Cette action est irréversible et supprimera toutes les données associées à cette transaction.
                </p>
            </div>
            <div class="modal-footer">
                <button onclick="closeModal()" class="btn btn-sm" style="background: var(--bg-secondary); color: var(--text-primary);">
                    Annuler
                </button>
                <button onclick="confirmDeleteAction()" id="confirm-delete-btn" class="btn btn-danger btn-sm">
                    <i class="bi bi-trash-fill"></i> Supprimer
                </button>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="../assets/js/theme.js"></script>
</body>
</html>
