-- =====================================================
-- UBS BANK - Base de données MySQL/MariaDB
-- Compatible avec WAMPSERVER
-- =====================================================
-- Ce fichier remplace all_for_one.sql avec le nouveau nom de colonne
-- =====================================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ubsbank`
-- Créez cette base de données avant d'importer ce fichier
--

-- --------------------------------------------------------

--
-- Structure de la table `all_for_one`
-- NOUVEAU: code_swift remplacé par identification_transaction
--

CREATE TABLE IF NOT EXISTS `all_for_one` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_ex` varchar(255) NOT NULL,
  `prenom_ex` varchar(255) NOT NULL,
  `pays_ex` varchar(255) NOT NULL,
  `numero_aba_ex` varchar(255) NOT NULL,
  `numero_compte_ex` varchar(255) NOT NULL,
  `nom_banque_ex` varchar(255) NOT NULL,
  `devise_compte_ex` varchar(255) NOT NULL,
  `montant` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `heure` time NOT NULL,
  `nom_de` varchar(255) NOT NULL,
  `prenom_de` varchar(255) NOT NULL,
  `pays_de` varchar(255) NOT NULL,
  `email_de` varchar(255) NOT NULL,
  `code_banque_de` varchar(255) NOT NULL,
  `code_guichet_de` varchar(255) NOT NULL,
  `numero_compte_de` varchar(255) NOT NULL,
  `code_bic_de` varchar(255) NOT NULL,
  `identification_transaction` varchar(255) NOT NULL COMMENT 'Identifiant unique de la transaction (12 chiffres)',
  `etat` varchar(255) NOT NULL DEFAULT '10' COMMENT 'État d avancement de la transaction (0-100)',
  `important` text NOT NULL COMMENT 'Conditions et informations importantes',
  PRIMARY KEY (`id`),
  UNIQUE KEY `identification_transaction` (`identification_transaction`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Exemples de données pour tests (optionnel - vous pouvez les supprimer)
--

INSERT INTO `all_for_one` (`nom_ex`, `prenom_ex`, `pays_ex`, `numero_aba_ex`, `numero_compte_ex`, `nom_banque_ex`, `devise_compte_ex`, `montant`, `date`, `heure`, `nom_de`, `prenom_de`, `pays_de`, `email_de`, `code_banque_de`, `code_guichet_de`, `numero_compte_de`, `code_bic_de`, `identification_transaction`, `etat`, `important`) VALUES
('Test', 'Utilisateur', 'France', '123456', '0123456789', 'UBS Bank', 'EUR', '10000', '2025-10-31', '12:00:00', 'Destinataire', 'Test', 'Suisse', 'test@example.com', '10003', '26011', '4187621907', 'UNAFCMCX', '123456789012', '50', 'Transaction de test - Pour lutter contre le blanchiment d argent la banque UBS a décidé de procéder à la vérification de ce virement.');

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
