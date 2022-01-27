-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 27 jan. 2022 à 18:07
-- Version du serveur :  8.0.21
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gecosensor_bdd`
--

-- --------------------------------------------------------

--
-- Structure de la table `capteur`
--

DROP TABLE IF EXISTS `capteur`;
CREATE TABLE IF NOT EXISTS `capteur` (
  `id_capteur` int NOT NULL AUTO_INCREMENT,
  `type` text NOT NULL,
  `id_patient` int NOT NULL,
  PRIMARY KEY (`id_capteur`),
  KEY `patient_capteur` (`id_patient`)
) ENGINE=InnoDB AUTO_INCREMENT=154 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `capteur`
--

INSERT INTO `capteur` (`id_capteur`, `type`, `id_patient`) VALUES
(52, 'frequenceCardiaque', 7),
(53, 'niveauSonore', 7),
(54, 'concentrationGaz', 7),
(58, 'frequenceCardiaque', 9),
(59, 'niveauSonore', 9),
(60, 'concentrationGaz', 9),
(73, 'frequenceCardiaque', 14),
(74, 'niveauSonore', 14),
(75, 'concentrationGaz', 14),
(76, 'frequenceCardiaque', 15),
(77, 'niveauSonore', 15),
(78, 'concentrationGaz', 15),
(88, 'frequenceCardiaque', 19),
(89, 'niveauSonore', 19),
(90, 'concentrationGaz', 19),
(97, 'frequenceCardiaque', 22),
(98, 'niveauSonore', 22),
(99, 'concentrationGaz', 22),
(136, 'frequenceCardiaque', 35),
(137, 'niveauSonore', 35),
(138, 'concentrationGaz', 35),
(145, 'frequenceCardiaque', 38),
(146, 'niveauSonore', 38),
(147, 'concentrationGaz', 38);

-- --------------------------------------------------------

--
-- Structure de la table `gere`
--

DROP TABLE IF EXISTS `gere`;
CREATE TABLE IF NOT EXISTS `gere` (
  `id_gere` int NOT NULL AUTO_INCREMENT,
  `id_personnel` int NOT NULL,
  `id_capteur` int NOT NULL,
  PRIMARY KEY (`id_gere`),
  KEY `personnel_capteur` (`id_personnel`),
  KEY `capteur_personnel` (`id_capteur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `hopital`
--

DROP TABLE IF EXISTS `hopital`;
CREATE TABLE IF NOT EXISTS `hopital` (
  `id_hopital` int NOT NULL AUTO_INCREMENT,
  `nom` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_hopital`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `hopital`
--

INSERT INTO `hopital` (`id_hopital`, `nom`, `ville`, `adresse`) VALUES
(2, 'ok', 'ok', 'ok'),
(3, 'No', 'Name', 'ded');

-- --------------------------------------------------------

--
-- Structure de la table `mesure`
--

DROP TABLE IF EXISTS `mesure`;
CREATE TABLE IF NOT EXISTS `mesure` (
  `id_mesure` int NOT NULL AUTO_INCREMENT,
  `valeur` float NOT NULL,
  `date_heure` datetime NOT NULL,
  `id_capteur` int NOT NULL,
  PRIMARY KEY (`id_mesure`),
  KEY `capteur_mesure` (`id_capteur`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `mesure`
--

INSERT INTO `mesure` (`id_mesure`, `valeur`, `date_heure`, `id_capteur`) VALUES
(40, 130, '2021-12-03 16:37:54', 52),
(41, 13, '2021-12-07 17:22:00', 52),
(42, 8, '2021-12-07 17:22:21', 53),
(43, 6, '2021-12-07 17:23:08', 54),
(47, 110, '2021-12-13 15:01:20', 58),
(48, 20, '2021-12-13 15:21:39', 59),
(49, 1, '2021-12-13 15:28:29', 60),
(50, 120, '2021-12-14 17:28:24', 58),
(51, 60, '2021-12-14 17:28:49', 59),
(52, 0, '2021-12-14 17:29:19', 58),
(53, 0, '2021-12-14 17:29:44', 60),
(54, 90, '2021-12-14 17:30:16', 58),
(56, 80, '2021-12-17 12:58:53', 58),
(57, 85, '2021-12-17 12:59:07', 58),
(59, 100, '2021-12-17 13:44:11', 58),
(60, 120, '2022-01-18 17:51:59', 136),
(61, 80, '2022-01-18 17:52:34', 136),
(62, 100, '2022-01-18 17:53:02', 136),
(64, 30, '2022-01-18 18:36:52', 137),
(65, 1, '2022-01-18 18:37:36', 138),
(66, 50, '2022-01-21 14:27:15', 137),
(67, 0, '2022-01-21 16:04:48', 138);

-- --------------------------------------------------------

--
-- Structure de la table `patient`
--

DROP TABLE IF EXISTS `patient`;
CREATE TABLE IF NOT EXISTS `patient` (
  `id_patient` int NOT NULL AUTO_INCREMENT,
  `prenom` varchar(256) NOT NULL,
  `nom` varchar(256) NOT NULL,
  `mail` text NOT NULL,
  `tel` int NOT NULL,
  `adresse` text NOT NULL,
  `description` text NOT NULL,
  `mdp` varchar(256) NOT NULL,
  `mdp_final` text NOT NULL,
  `nom_utilisateur` varchar(256) NOT NULL,
  `id_hopital` int NOT NULL,
  PRIMARY KEY (`id_patient`),
  KEY `id_hopital` (`id_hopital`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `patient`
--

INSERT INTO `patient` (`id_patient`, `prenom`, `nom`, `mail`, `tel`, `adresse`, `description`, `mdp`, `mdp_final`, `nom_utilisateur`, `id_hopital`) VALUES
(7, 'Johnny', 'Patient', 'rd.berrebi@gmail.com', 0, '', '', '$2y$10$YsyEnX4iGbR36.sRTehn9eS8Pus5FFPW2jDoVyreLnYSTXyCcH0/S', '$2y$10$jaTtl3pHgKRcHaWw9a/F9eXgqOo9MjW.4K9ZTKfZKiLz3VoDlgyK6', 'jpatient', 2),
(9, 'Jérémy', 'Hérault', 'jer@her.co', 60606060, '10 rue de Vanves', 'Test de description.', '$2y$10$OtW4nupJNJ10RN91tv0RL.lq5OUKWE0vnaohd17q6MhqWWalSpYnC', '', 'jhérault', 2),
(14, 'Delta', 'Freeman', 'delta@freeman.com', 666, '10 rue des rosiers', 'Une description\r\n', '$2y$10$0z772OhTdgCEQBzOW8znJeibKgYRaiVWFOfYKz.a/zgE/aOLsCktq', '', 'dfreeman', 2),
(15, 'Tom', 'Jerry', 'tom@jerry.fr', 666625960, '', 'Une description.', '$2y$10$JCt0.w1cSyb8etzaS5r1MezPxdZB/yQxRCwOIZRck7gzF8J.ZKpZG', '', 'tjerry', 2),
(19, 'Antoine', 'Hérault', 'antoine@herault.com', 0, '11 rue de Vanves', 'Aucune description.', '$2y$10$LiuBQc6KF5Uegb/IHCJSGeiwsvcJbZorbyhn7xZgPiu6v9oib1Scq', '', 'ahérault', 2),
(22, 'Thomas', 'Dubois', 't@dubois.com', 666625960, '24 rue des Abondances', '', '$2y$10$CZzFMIJia/0IlN.kan40/.IzcKZKgQKxNQKIK4RIlfuLKVAlTBk6i', '', 'tdubois', 2),
(35, 'Connu', 'Patient', 'dodkkd@dkdld.fr', 0, '', 'Rien à signaler\r\n', '$2y$10$cEmnlSIf61s61PS/cxdrnOpFWmAn90XaDaeWWUGsrUSiNNbEO.ihi', '$2y$10$HS.1myQdHpjDgS1Np211KOJiX3fpthlrjC60SPTKSJiHEq7inMFaS', 'cpatient', 2),
(38, 'Patient', 'Nouveau', 'nouveau@patient.fr', 0, '11 rue des rosiers', 'Une description.', '$2y$10$a2CC8M3QQqnkiN2pCjlJwuJIZa7GGpIGqdqbxA/Doru0fQMfmK7fS', '$2y$10$1nv5tk4wlKccZ0KPK9qRMu1ItrXTnhyZeZhYMLFZ0he9X4bay6ODy', 'pnouveau', 2);

-- --------------------------------------------------------

--
-- Structure de la table `personnel`
--

DROP TABLE IF EXISTS `personnel`;
CREATE TABLE IF NOT EXISTS `personnel` (
  `id_personnel` int NOT NULL AUTO_INCREMENT,
  `prenom` varchar(256) NOT NULL,
  `nom` varchar(256) NOT NULL,
  `mail` text NOT NULL,
  `tel` int NOT NULL,
  `type` varchar(256) NOT NULL,
  `mdp` text NOT NULL,
  `mdp_final` text NOT NULL,
  `nom_utilisateur` varchar(256) NOT NULL,
  `id_hopital` int NOT NULL,
  PRIMARY KEY (`id_personnel`),
  KEY `hopital_personnel` (`id_hopital`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `personnel`
--

INSERT INTO `personnel` (`id_personnel`, `prenom`, `nom`, `mail`, `tel`, `type`, `mdp`, `mdp_final`, `nom_utilisateur`, `id_hopital`) VALUES
(3, 'John', 'Docteur', 'ffkfkgkg@ffk.com', 0, 'medecin', 'root', '', 'jdocteur', 2),
(4, 'Tom', 'Drake', 'doru@fjfj.fr', 0, 'admin', 'root', 'root', 'admin', 2),
(8, 'admi', '', '', 0, 'infirmier', '$2y$10$WDiSxt6UcTOkEZU.0qWf9uhx7/JlU7Tx6yR5rV6QL4hv9GoPDZnj6', '', 'athenes', 3),
(11, '', '', '', 0, 'medecin', '$2y$10$WDiSxt6UcTOkEZU.0qWf9uhx7/JlU7Tx6yR5rV6QL4hv9GoPDZnj6', '', 'docdeux', 3),
(12, 'Inf', 'Un', 'j@j.fr', 0, 'infirmier', '$2y$10$j/i0TIK25nSnKNONzYnsNu8HHwTv1WbyGUah5wX2HW.bXsojx1AOW', '', 'iun', 3),
(13, 'at', 'Sold', 'sol@dd.fr', 0, 'medecin', '$2y$10$S2wowCH.eaGMOBAmomEH.e21mSDHcC30rhW0ym4eU30FWfOKR35v6', '', 'asold', 3),
(14, 'Tristan', 'Brankovic', 'tristan@brankovic.com', 0, 'infirmier', 'mdp', '', 'tbrankovic', 2),
(24, 'Marc', 'Dubois', 'marc@dubois.com', 0, 'infirmier', '$2y$10$7SX3di48LuBl4MiEUsEnjeTymYAeo8qeBGiY2DCG/D7MOR4czZky2', 'root', 'mdubois', 2),
(37, 'Lantier', 'Gaëlle', 'gaelle@lant.com', 63899, 'infirmier', '$2y$10$6VmM38w.6kKgUNNj7sWEsuGLO1teIeiHF36lhy4WmLwDI75YlHUiW', '$2y$10$qLlRXxaH67aIiyH.7kaBX./JfEaTElGN7AAyBCBcp6vIG.EBtiqNK', 'lgaëlle', 2),
(39, 'Primordial', 'Admin', 'admin@primordial.fr', 0, 'admin', '$2y$10$O6/M93JIe5fMr8EsJ76io.GRFmr3a2TmxvVegLkZiQdw04qKQ/Mtm', '$2y$10$u4ji4Yr9E4ixvTXBn.WEYOx/vGTJ3Sbh8wiqh7f2KRozwbq20dwSq', 'padmin', 2),
(40, 'Fictif', 'Infirmier', 'prim@inf.fr', 0, 'infirmier', '$2y$10$ROzrYBf4Bb8ZKtkyBA25eO1e8Kr5LHYx/QIS2WGy.nmeeZKHCwOqO', '$2y$10$PcoNnt2LHWE5hHuvuy4jTOWInz2T76omu57TOfo0SVvFvA8bCYd/O', 'finfirmier', 2),
(45, 'Infirmier', 'Nouvel', 'nouvel@infirmier.fr', 0, 'infirmier', '$2y$10$5eLyak73G4gVP1ycGQWhvOsLkVUcNO9b2bIx5gEiB5fv81AbJV.Oi', '$2y$10$xzTbazH./1kQGqKuupldtOYgcbQFTeK4Uj4Hny/KhZDRZuC8RjZ7m', 'inouvel', 2),
(46, 'Médecin', 'Nouveau', 'nouveau@medecin.fr', 6606, 'medecin', '$2y$10$oUgz4MX5agHHaNoSYt6hneh/Rm7UtGV4J9uoFhPv5jfhO4mmlTJai', '$2y$10$BJ9YcDQULSk4osZQSCX8u.0b8XJ1sApJX98ex0ZIYd.kiivJVuMGa', 'mnouveau', 2),
(47, 'Administrateur', 'Nouvel', 'nouvel@administrateur.fr', 0, 'admin', '$2y$10$YkY74KM.Z9t8NKZL4jZ69uLLkY8IhbdJGl1zeWFV8lyPOOwtP51/W', '$2y$10$UjELGfKV1KRdgGay2LuRj.XJ7TR07Csk0dqIsfglAFs8WaD4hJi6i', 'anouvel', 2),
(49, 'mdp', 'test', 'test@mdp.fr', 0, 'infirmier', '$2y$10$K9ySBgnTKyGrr3wm8NCeaOZo5zjWhT9aIRGMoDLZaHEJzF4WeXdRy', '$2y$10$U4jyFGfXbKGSTjTCW1McM.dmKLjkj49L3tHzcO/nz4ZfrmXGDJFla', 'mtest', 2);

-- --------------------------------------------------------

--
-- Structure de la table `travaille_pour`
--

DROP TABLE IF EXISTS `travaille_pour`;
CREATE TABLE IF NOT EXISTS `travaille_pour` (
  `id_travaille_pour` int NOT NULL AUTO_INCREMENT,
  `id_personnel` int NOT NULL,
  `id_patient` int NOT NULL,
  PRIMARY KEY (`id_travaille_pour`),
  KEY `patient_personnel` (`id_patient`),
  KEY `personnel_patient` (`id_personnel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `capteur`
--
ALTER TABLE `capteur`
  ADD CONSTRAINT `patient_capteur` FOREIGN KEY (`id_patient`) REFERENCES `patient` (`id_patient`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `gere`
--
ALTER TABLE `gere`
  ADD CONSTRAINT `capteur_personnel` FOREIGN KEY (`id_capteur`) REFERENCES `capteur` (`id_capteur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `personnel_capteur` FOREIGN KEY (`id_personnel`) REFERENCES `personnel` (`id_personnel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `mesure`
--
ALTER TABLE `mesure`
  ADD CONSTRAINT `capteur_mesure` FOREIGN KEY (`id_capteur`) REFERENCES `capteur` (`id_capteur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `hopital_patient` FOREIGN KEY (`id_hopital`) REFERENCES `hopital` (`id_hopital`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `personnel`
--
ALTER TABLE `personnel`
  ADD CONSTRAINT `hopital_personnel` FOREIGN KEY (`id_hopital`) REFERENCES `hopital` (`id_hopital`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `travaille_pour`
--
ALTER TABLE `travaille_pour`
  ADD CONSTRAINT `patient_personnel` FOREIGN KEY (`id_patient`) REFERENCES `patient` (`id_patient`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `personnel_patient` FOREIGN KEY (`id_personnel`) REFERENCES `personnel` (`id_personnel`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
