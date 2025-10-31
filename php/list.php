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
                                <div style="display: flex; align-items: center; gap: 0.5rem;">
                                    <strong style="color: var(--accent-primary); font-family: monospace;">
                                        <?php echo formaterIdentifiant($trans['code_swift']); ?>
                                    </strong>
                                    <button onclick="copyToClipboard('<?php echo formaterIdentifiant($trans['code_swift']); ?>')" 
                                            class="btn btn-sm btn-icon" 
                                            style="padding: 0.25rem 0.5rem; background: transparent; border: 1px solid var(--accent-primary);"
                                            title="Copier l'identifiant">
                                        <i class="bi bi-clipboard" style="font-size: 0.9rem;"></i>
                                    </button>
                                </div>
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
                                    <button onclick="showDetailsModal('<?php echo $trans['code_swift']; ?>')" 
                                            class="btn btn-info btn-sm btn-icon" 
                                            title="Voir Détails (Popup)">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                    <a href="details_transaction.php?id=<?php echo $trans['code_swift']; ?>" 
                                       class="btn btn-info btn-sm btn-icon" 
                                       title="Détails (Page complète)">
                                        <i class="bi bi-box-arrow-up-right"></i>
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

    <!-- Modal des Détails de Transaction -->
    <div class="modal-overlay" id="details-modal">
        <div class="modal" style="max-width: 800px; max-height: 90vh; overflow-y: auto;">
            <div class="modal-header">
                <h3 class="modal-title">
                    <i class="bi bi-receipt-cutoff"></i>
                    Détails de la Transaction
                </h3>
                <button onclick="closeDetailsModal()" style="background: none; border: none; font-size: 1.5rem; cursor: pointer; color: var(--text-primary);">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div class="modal-body" id="details-modal-content">
                <!-- Le contenu sera chargé dynamiquement -->
            </div>
            <div class="modal-footer">
                <button onclick="closeDetailsModal()" class="btn btn-sm" style="background: var(--bg-secondary); color: var(--text-primary);">
                    Fermer
                </button>
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
    <script>
        // Fonction de recherche dans le tableau
        const searchInput = document.querySelector('.search-input');
        const tableRows = document.querySelectorAll('.modern-table tbody tr');
        
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            
            tableRows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
        
        // Fonction pour copier dans le presse-papiers avec notification
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                showCopyNotification(text);
            }).catch(function(err) {
                console.error('Erreur lors de la copie : ', err);
                alert('Erreur lors de la copie. Veuillez réessayer.');
            });
        }
        
        // Fonction pour afficher la notification de copie
        function showCopyNotification(text) {
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 2rem;
                left: 50%;
                transform: translateX(-50%);
                background: linear-gradient(135deg, #10b981, #059669);
                color: white;
                padding: 1rem 2rem;
                border-radius: 10px;
                font-weight: 600;
                box-shadow: 0 10px 40px rgba(16, 185, 129, 0.3);
                z-index: 10000;
                animation: slideDown 0.3s ease-out;
                display: flex;
                align-items: center;
                gap: 0.75rem;
            `;
            
            notification.innerHTML = `
                <i class="bi bi-check-circle-fill" style="font-size: 1.5rem;"></i>
                <div>
                    <strong>Identifiant copié!</strong>
                    <div style="font-size: 0.9rem; font-family: monospace; margin-top: 0.25rem;">${text}</div>
                </div>
            `;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.style.animation = 'slideUp 0.3s ease-in';
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 2500);
        }
        
        // Ajouter les animations CSS
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideDown {
                from {
                    opacity: 0;
                    transform: translateX(-50%) translateY(-20px);
                }
                to {
                    opacity: 1;
                    transform: translateX(-50%) translateY(0);
                }
            }
            @keyframes slideUp {
                from {
                    opacity: 1;
                    transform: translateX(-50%) translateY(0);
                }
                to {
                    opacity: 0;
                    transform: translateX(-50%) translateY(-20px);
                }
            }
        `;
        document.head.appendChild(style);
        
        // Données des transactions (générées depuis PHP)
        const transactionsData = <?php echo json_encode($transactions); ?>;
        
        // Fonction pour afficher les détails dans une modal
        function showDetailsModal(identifiant) {
            const transaction = transactionsData.find(t => t.code_swift === identifiant);
            if (!transaction) return;
            
            const modal = document.getElementById('details-modal');
            const content = document.getElementById('details-modal-content');
            
            const identifiantFormate = formatIdentifiant(transaction.code_swift);
            
            content.innerHTML = `
                <div style="background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary)); color: white; padding: 2rem; border-radius: 10px; margin-bottom: 1.5rem; text-align: center;">
                    <h2 style="margin: 0 0 1rem 0; font-size: 1.3rem;">Identifiant de Transaction</h2>
                    <div style="font-family: monospace; font-size: 2rem; font-weight: bold; letter-spacing: 3px; margin-bottom: 1rem;">
                        ${identifiantFormate}
                    </div>
                    <button onclick="copyToClipboard('${identifiantFormate}')" class="btn btn-sm" style="background: rgba(255,255,255,0.2); color: white; border: 1px solid white;">
                        <i class="bi bi-clipboard"></i> Copier l'identifiant
                    </button>
                </div>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                    <div style="background: var(--bg-secondary); padding: 1rem; border-radius: 10px;">
                        <h4 style="margin: 0 0 0.5rem 0; color: var(--accent-primary);"><i class="bi bi-cash-stack"></i> Montant</h4>
                        <p style="font-size: 1.5rem; font-weight: bold; margin: 0;">${Number(transaction.montant).toLocaleString()} ${transaction.devise_compte_ex}</p>
                    </div>
                    <div style="background: var(--bg-secondary); padding: 1rem; border-radius: 10px;">
                        <h4 style="margin: 0 0 0.5rem 0; color: var(--accent-info);"><i class="bi bi-calendar-check"></i> Date</h4>
                        <p style="font-size: 1.2rem; margin: 0;">${new Date(transaction.date).toLocaleDateString('fr-FR')}</p>
                        <small style="color: var(--text-secondary);">${transaction.heure}</small>
                    </div>
                </div>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    <div style="background: var(--bg-secondary); padding: 1rem; border-radius: 10px;">
                        <h4 style="margin: 0 0 1rem 0; color: var(--text-primary);"><i class="bi bi-person-circle"></i> Expéditeur</h4>
                        <p style="margin: 0.5rem 0;"><strong>Nom:</strong> ${transaction.nom_ex} ${transaction.prenom_ex}</p>
                        <p style="margin: 0.5rem 0;"><strong>Pays:</strong> ${transaction.pays_ex}</p>
                        <p style="margin: 0.5rem 0;"><strong>Banque:</strong> ${transaction.nom_banque_ex}</p>
                    </div>
                    <div style="background: var(--bg-secondary); padding: 1rem; border-radius: 10px;">
                        <h4 style="margin: 0 0 1rem 0; color: var(--text-primary);"><i class="bi bi-person-check-fill"></i> Destinataire</h4>
                        <p style="margin: 0.5rem 0;"><strong>Nom:</strong> ${transaction.nom_de} ${transaction.prenom_de}</p>
                        <p style="margin: 0.5rem 0;"><strong>Pays:</strong> ${transaction.pays_de}</p>
                        <p style="margin: 0.5rem 0;"><strong>Email:</strong> ${transaction.email_de}</p>
                    </div>
                </div>
                
                <div style="background: rgba(245, 158, 11, 0.1); border: 2px solid var(--accent-warning); padding: 1rem; border-radius: 10px; margin-top: 1.5rem;">
                    <h4 style="margin: 0 0 1rem 0; color: var(--accent-warning);"><i class="bi bi-exclamation-triangle-fill"></i> État: ${transaction.etat}%</h4>
                    <div style="background: var(--bg-secondary); border-radius: 20px; height: 30px; overflow: hidden;">
                        <div style="background: linear-gradient(90deg, var(--accent-success), var(--accent-info)); height: 100%; width: ${transaction.etat}%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; transition: width 0.3s;">
                            ${transaction.etat}%
                        </div>
                    </div>
                </div>
            `;
            
            modal.style.display = 'flex';
        }
        
        // Fonction pour fermer le modal de détails
        function closeDetailsModal() {
            const modal = document.getElementById('details-modal');
            modal.style.display = 'none';
        }
        
        // Variables pour le modal de suppression
        let deleteIdentifiant = '';
        
        // Fonction pour afficher le modal de confirmation
        function confirmDelete(identifiant, nom, prenom) {
            deleteIdentifiant = identifiant;
            const modal = document.getElementById('delete-modal');
            const modalText = document.getElementById('delete-modal-text');
            
            modalText.innerHTML = `Êtes-vous sûr de vouloir supprimer la transaction de <strong>${nom} ${prenom}</strong> ?<br><br>Identifiant: <strong style="font-family: monospace;">${formatIdentifiant(identifiant)}</strong>`;
            
            modal.style.display = 'flex';
        }
        
        // Fonction pour fermer le modal
        function closeModal() {
            const modal = document.getElementById('delete-modal');
            modal.style.display = 'none';
            deleteIdentifiant = '';
        }
        
        // Fonction pour confirmer la suppression
        function confirmDeleteAction() {
            if (deleteIdentifiant) {
                window.location.href = 'delete_transaction.php?id=' + deleteIdentifiant;
            }
        }
        
        // Fonction pour formater l'identifiant
        function formatIdentifiant(id) {
            id = id.replace(/-/g, '');
            if (id.length === 12) {
                return id.substr(0, 3) + '-' + id.substr(3, 3) + '-' + id.substr(6, 3) + '-' + id.substr(9, 3);
            } else if (id.length === 8) {
                return id.substr(0, 3) + '-' + id.substr(3, 3) + '-' + id.substr(6, 2);
            }
            return id;
        }
        
        // Fermer les modals en cliquant à l'extérieur
        window.addEventListener('click', function(e) {
            const deleteModal = document.getElementById('delete-modal');
            const detailsModal = document.getElementById('details-modal');
            
            if (e.target === deleteModal) {
                closeModal();
            }
            if (e.target === detailsModal) {
                closeDetailsModal();
            }
        });
        
        // Fermer les modals avec la touche Échap
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
                closeDetailsModal();
            }
        });
    </script>
</body>
</html>
