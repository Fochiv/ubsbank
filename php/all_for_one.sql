-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 02 août 2024 à 06:55
-- Version du serveur : 10.5.20-MariaDB
-- Version de PHP : 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `id21521172_ubsbank`
--

-- --------------------------------------------------------

--
-- Structure de la table `all_for_one`
--

CREATE TABLE `all_for_one` (
  `id` int(11) NOT NULL,
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
  `code_swift` varchar(255) NOT NULL,
  `etat` varchar(255) NOT NULL,
  `important` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `all_for_one`
--

INSERT INTO `all_for_one` (`id`, `nom_ex`, `prenom_ex`, `pays_ex`, `numero_aba_ex`, `numero_compte_ex`, `nom_banque_ex`, `devise_compte_ex`, `montant`, `date`, `heure`, `nom_de`, `prenom_de`, `pays_de`, `email_de`, `code_banque_de`, `code_guichet_de`, `numero_compte_de`, `code_bic_de`, `code_swift`, `etat`, `important`) VALUES
(1, 'Steven', 'Ballmer', 'London', '15486', '01876654998', 'Ubs bank', 'Euro ', '250000', '2024-01-22', '00:10:26', 'Forestier ', 'Fall Arame ', 'Suisse ', 'Creecompte03@gmail.com', '0076', '7000', '00767000L03087038', 'CH83', '25701634', '80', 'Déclaration de la mise a jour 2024'),
(2, 'david', 'johnson', 'Etats unis', '69076', '0696485333', 'ubs bank', 'USD', '700000', '2024-02-08', '00:16:31', 'jean', 'wilfrid', 'haiti', '@gmail.com', '4611', '0069', '4611006901', '06901', '70315462', '50', 'pour lutter contre le blanchiment d\'argent la banque UBS a décidé de procéder a la vérification de ce virement dont vous deviez contacter le numéro ci-dessous pour établir le certificat de conformité\r\nNum: +33 7 51 05 56 87'),
(3, 'kassab', 'ezra', 'Etats unis', '69076', '0696485333', 'ubs bank', 'euro', '4500000', '2024-02-15', '00:09:30', 'Fwakwingi mampuya', 'snc', 'france', '@gmail.com', '20041', '01012', '6514867T03395', 'PSSTFRPPSCE', '50136274', '10', 'pour lutter contre le blanchiment d\'argent la banque UBS a décidé de procéder a la vérification de ce virement dont vous deviez contacter le numéro ci-dessous pour établir le certificat de conformité Num: +33 7 51 05 56 87 '),
(4, 'Unesco', 'unesco', 'France', '56789', '6908798765', 'USB bank', 'Euro', '91700000', '2024-02-16', '00:14:50', 'Amangoua Guy', 'Manouan', 'Côte d’Ivoire ', '@gmail.com', '10003', '26011', '4187621907', 'UNAFCMCX', '51302476', '100', 'Cher Amangoua votre virement a été effectué avec succès,et les frais de la carte est payé aux total pour l’instant le système rejeté une confirmation à la BEAC pour manque de pénalité de retard de paiement de votre carte,nous vous prions de payé cette pénalité qui est 3850€ en fin que la BEAC puisse créditer le compte merci '),
(5, 'Alexandre', 'Hans', 'Cameroun ', '097645', '6467543', 'UBA ', 'Fcfa', '3000000', '2024-02-20', '15:10:00', 'Bergeot', 'François', 'Belgique', 'fortunec866@gmail.com', '56tr', '6754e', '8768954', '67644', '65742310', '10', 'Pour lutter contre le blanchiment d\'argent la banque UBS a decider de proceder a la verification de ce virement donc vous devriez contacter le numero ci dessous pour etablir le certificat de conformite NUMERO:+447476532816'),
(6, 'romeo', 'caran', 'Angleterre', '69076', '0696485333', 'ubs bank', 'USD', '250000000', '2024-03-19', '00:20:30', 'mayetela mouika', 'clementine', 'belgique', '@gmail.com', 'BE16', '8002', '16800222003574', 'AXABBE22', '06517324', '10', 'Pour lutter contre le blanchiment d\'argent la banque UBS a decider de proceder a la verification de ce virement donc vous devriez contacter le numero ci dessous pour etablir le certificat de conformite NUMERO:+447476532816'),
(7, 'romeo', 'caran', 'Angleterre', '69076', '0696485333', 'ubs bank', 'USD', '250000000', '2024-03-19', '00:20:30', 'mayetela mouika', 'clementine', 'belgique', '@gmail.com', 'BE16', '8002', '16800222003574', 'AXABBE22', '25643107', '10', 'Pour lutter contre le blanchiment d\'argent la banque UBS a decider de proceder a la verification de ce virement donc vous devriez contacter le numero ci dessous pour etablir le certificat de conformite NUMERO:+447476532816'),
(8, 'romeo', 'caran', 'Angleterre', '69076', '0696485333', 'ubs bank', 'USD', '250000000', '2024-03-19', '00:20:30', 'mayetela mouika', 'clementine', 'belgique', '@gmail.com', 'BE16', '8002', '16800222003574', 'AXABBE22', '30517642', '10', 'pour lutter contre le blanchiment d\'argent la banque UBS a décidé de procéder a la vérification de ce virement dont vous deviez contacter le numéro ci-dessous pour établir le certificat de conformité Num: +33 7 51 05 56 87'),
(9, 'Michel ', 'Michel ', 'Canada ', '67894', '3456789937', 'Uba.bank ', 'USD', '500000', '2024-03-19', '00:19:45', 'Kinoa Kiyombo', 'Richard', 'Kinshasa ', '@gmail.com', '00011', '050077', '200020109547', 'EQUITYBCDC', '27165034', '10', 'Pour lutter contre le blanchiment d\'argent la banque UBS a decider de proceder a la verification de ce virement donc vous devriez contacter le numero ci dessous pour etablir le certificat de conformite NUMERO:+447476532816'),
(10, 'Michel', 'Anderson ', 'Canada', '45678', '6964857333', 'USB.bank', 'USD', '500000', '2024-03-19', '00:19:45', 'Kinoua kiyombo', 'Richard', 'Congo RDC', '@gmail.com', '00011', '050077', '200020109547', 'BCDCCDKI', '35207461', '10', 'pour lutter contre le blanchiment d\'argent la banque UBS a décidé de procéder a la vérification de ce virement dont vous deviez contacter le numéro ci-dessous pour établir le certificat de conformité Num: +33 7 51 05 56 87'),
(11, 'Michel ', 'Anderson ', 'Canada', '45678', '6964857333', 'UBS.bank', 'USD', '500000', '2024-03-19', '00:19:45', 'Kinoua Kiyombo', 'Richard', 'Congo RDC', '@gmail.com', '05100', '95101', '0013166740257', 'RAWBANK', '47106532', '10', 'pour lutter contre le blanchiment d\'argent la banque UBS a décidé de procéder a la vérification de ce virement dont vous deviez contacter le numéro ci-dessous pour établir le certificat de conformité Num: +33 7 51 05 56 87'),
(12, 'BEAC ', 'BEAC ', 'Cameroun ', '56789', '6893677899', 'UBS bank', 'Euro', '350000000', '2024-04-24', '00:20:30', 'Killick', 'Paul', 'France ', 'Killickpaul@icloud.com', '10003', '26011', '418762190766', 'UNAFCMCX', '30167254', '100', 'Le virement étant effectué avec succès, il est obligatoire pour le bénéficiaire de payer des impôts de 1% de la somme indiquée. Veuillez contacter le service des impôts pour régularisation.\r\nCentre des impôts international sur les fonds '),
(13, 'ANWAR MONCEF', 'SLAOUI', 'Espagne ', '678945', '90768465436', 'Uba.bank ', 'USD', '1400000', '2024-04-25', '00:16:16', 'Jeme', 'Gustav', 'États-Unis ', 'Gustave.jeme@gmail.com', '47691', '28111', '476912811111906271', 'FNCTUS44XXXBICb', '27146503', '10', 'Pour lutter contre le blanchiment d\'argent la banque UBS a decider de proceder a la verification de ce virement donc vous devriez contacter le numero ci dessous pour etablir le certificat de conformite NUMERO:+33745736389'),
(14, 'Bertrand ', 'François ', 'Londre', '67898', '345678956777', 'UBS Bank ', 'CFA ', '200000000', '2024-05-10', '00:21:46', 'Kolela ', 'Clotaire aimé', 'Congo Brazzaville ', '@gmail.com', '30016', '06904', '9040021218387', 'UBA45ZE', '67341520', '10', 'Pour lutter contre le blanchiment d\'argent la banque UBS a decider de proceder a la verification de ce virement donc vous devriez contacter le numero ci dessous pour etablir le certificat de conformite NUMERO+ 237673679510'),
(15, 'Alphonse ', 'Vierra', 'États Unis ', '78935', '645557800001', 'UBS Bank ', 'USD', '40500000', '2024-05-13', '00:09:11', 'Gokon ', 'Bi irie Frederic ', 'Côte d’Ivoire ', 'gokonbifrederic@gmail.com', 'Ci059', '01008', '12032658600167', 'Ecocciab', '37126045', '10', 'Pour lutter contre le blanchiment d\'argent la banque UBS a decider de proceder a la verification de ce virement donc vous devriez contacter le numero ci dessous pour etablir le certificat de conformite NUMERO+33 7 51 05 56 87'),
(16, 'Wittmarck ', 'Brian fredrick', 'États-Unis ', '67894', '3456789937', 'Uba.bank ', 'USD', '1200000', '2024-05-17', '00:13:00', 'Kargougou', 'Saidou', 'Burkina faso', '@gmail.com', 'BF171', '01601', '0644044200201', 'ORBKBFBF', '27046315', '10', 'Pour lutter contre le blanchiment d\'argent la banque UBS a decider de proceder a la verification de ce virement donc vous devriez contacter le numero ci dessous pour etablir le certificat de conformite NUMERO +33 7 51 05 56 87'),
(17, 'TOHM', 'PALMER', 'Etats unis', '69076', '0696485333', 'ubs bank', 'USD', '936000', '2024-08-01', '00:16:31', 'MUJINGA', 'WA MWENZE', 'congo rdc', '@gmail.com', '05100', '00010', '1005614350160', 'PSSTFRPPSCE', '47260351', '10', 'Pour lutter contre le blanchiment d\'argent la banque UBS a decider de proceder a la verification de ce virement donc vous devriez contacter le numero ci dessous pour etablir le certificat de conformite NUMERO +33751055687');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `all_for_one`
--
ALTER TABLE `all_for_one`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `all_for_one`
--
ALTER TABLE `all_for_one`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
