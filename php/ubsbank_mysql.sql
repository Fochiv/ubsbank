-- =====================================================
-- UBS BANK - Base de données MySQL/MariaDB
-- Compatible avec WAMPSERVER
-- =====================================================
-- Version nouvelle: Base de données propre sans données
-- Identifiants UNIQUEMENT 12 chiffres (format: XXX-XXX-XXX-XXX)
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
-- IMPORTANT: Créez cette base de données avant d'importer ce fichier
-- Exemple: CREATE DATABASE ubsbank CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
--

-- --------------------------------------------------------

--
-- Suppression de la table existante (ATTENTION: Supprime toutes les données!)
--

DROP TABLE IF EXISTS `all_for_one`;

-- --------------------------------------------------------

--
-- Structure de la table `all_for_one` (VERSION PROPRE)
-- Identifiants UNIQUEMENT 12 chiffres
--

CREATE TABLE `all_for_one` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_ex` varchar(255) NOT NULL,
  `prenom_ex` varchar(255) NOT NULL,
  `pays_ex` varchar(255) NOT NULL,
  `numero_aba_ex` varchar(100) NOT NULL,
  `numero_compte_ex` varchar(100) NOT NULL,
  `nom_banque_ex` varchar(255) NOT NULL,
  `devise_compte_ex` varchar(50) NOT NULL,
  `montant` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL,
  `heure` varchar(50) NOT NULL,
  `nom_de` varchar(255) NOT NULL,
  `prenom_de` varchar(255) NOT NULL,
  `pays_de` varchar(255) NOT NULL,
  `email_de` varchar(255) NOT NULL,
  `code_banque_de` varchar(100) NOT NULL,
  `code_guichet_de` varchar(100) NOT NULL,
  `numero_compte_de` varchar(100) NOT NULL,
  `code_bic_de` varchar(100) NOT NULL,
  `identification_transaction` varchar(12) NOT NULL COMMENT 'Identifiant unique (12 chiffres uniquement)',
  `etat` varchar(50) NOT NULL DEFAULT '10' COMMENT 'État d avancement (0-100)',
  `important` text NOT NULL COMMENT 'Conditions et informations importantes',
  PRIMARY KEY (`id`),
  UNIQUE KEY `identification_transaction` (`identification_transaction`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- BASE DE DONNÉES PROPRE - AUCUNE DONNÉE
-- Utilisez l'interface admin pour ajouter vos transactions
--

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
