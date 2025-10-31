<?php
// =====================================================
// UBS BANK - FONCTIONS UTILITAIRES
// =====================================================

/**
 * Génère un identifiant de transaction unique de 12 caractères
 * Format: XXX-XXX-XXX-XXX (12 chiffres avec tirets pour lisibilité)
 * @param PDO $bdd Connection à la base de données
 * @return string Identifiant unique
 */
function genererIdentifiantTransaction($bdd) {
    do {
        // Générer un identifiant de 12 chiffres
        $identifiant = '';
        for ($i = 0; $i < 12; $i++) {
            $identifiant .= mt_rand(0, 9);
        }
        
        // Vérifier l'unicité dans la base de données
        $req = $bdd->prepare('SELECT COUNT(*) as count FROM all_for_one WHERE identification_transaction = :id');
        $req->execute(['id' => $identifiant]);
        $result = $req->fetch();
        $existe = $result['count'] > 0;
        
    } while ($existe); // Continuer jusqu'à trouver un identifiant unique
    
    return $identifiant;
}

/**
 * Formate un identifiant pour l'affichage (avec tirets)
 * @param string $identifiant Identifiant brut
 * @return string Identifiant formaté
 * Format: XXX-XXX-XXX-XXX (12 chiffres) ou XXX-XXX-XX (8 chiffres - ancien format)
 */
function formaterIdentifiant($identifiant) {
    $identifiant = str_replace('-', '', $identifiant);
    
    if (strlen($identifiant) === 12) {
        return substr($identifiant, 0, 3) . '-' . 
               substr($identifiant, 3, 3) . '-' . 
               substr($identifiant, 6, 3) . '-' . 
               substr($identifiant, 9, 3);
    } elseif (strlen($identifiant) === 8) {
        return substr($identifiant, 0, 3) . '-' . 
               substr($identifiant, 3, 3) . '-' . 
               substr($identifiant, 6, 2);
    }
    return $identifiant;
}

/**
 * Obtient la date actuelle au format Y-m-d
 * @return string Date actuelle
 */
function obtenirDateActuelle() {
    return date('Y-m-d');
}

/**
 * Obtient l'heure actuelle au format H:i:s
 * @return string Heure actuelle
 */
function obtenirHeureActuelle() {
    return date('H:i:s');
}

/**
 * Affiche un message d'erreur stylisé
 * @param string $msg Message d'erreur
 */
function afficherErreur($msg) {
    echo '<div class="alert alert-danger fade-in" style="
        background: rgba(239, 68, 68, 0.1);
        border: 2px solid var(--accent-danger);
        padding: 1rem 1.5rem;
        border-radius: 10px;
        margin-bottom: 1rem;
        color: var(--accent-danger);
        font-weight: 600;
    ">';
    echo '<i class="bi bi-exclamation-triangle-fill"></i> ' . htmlspecialchars($msg);
    echo '</div>';
}

/**
 * Affiche un message de succès stylisé
 * @param string $msg Message de succès
 */
function afficherSucces($msg) {
    echo '<div class="alert alert-success fade-in" style="
        background: rgba(16, 185, 129, 0.1);
        border: 2px solid var(--accent-success);
        padding: 1rem 1.5rem;
        border-radius: 10px;
        margin-bottom: 1rem;
        color: var(--accent-success);
        font-weight: 600;
    ">';
    echo '<i class="bi bi-check-circle-fill"></i> ' . htmlspecialchars($msg);
    echo '</div>';
}

/**
 * Sécurise une chaîne pour l'affichage HTML
 * @param string $str Chaîne à sécuriser
 * @return string Chaîne sécurisée
 */
function securiser($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

/**
 * Obtient le badge de statut pour la progression
 * @param int $etat État de la transaction (0-100)
 * @return string HTML du badge
 */
function getBadgeEtat($etat) {
    $etat = (int)$etat;
    
    if ($etat >= 100) {
        return '<span class="badge badge-success">Complété</span>';
    } elseif ($etat >= 50) {
        return '<span class="badge badge-info">En cours</span>';
    } elseif ($etat >= 10) {
        return '<span class="badge badge-warning">Initié</span>';
    } else {
        return '<span class="badge badge-danger">En attente</span>';
    }
}

/**
 * Formate un montant avec séparateurs de milliers
 * @param string|float $montant Montant à formater
 * @return string Montant formaté
 */
function formaterMontant($montant) {
    return number_format((float)$montant, 0, ',', ' ');
}
?>
