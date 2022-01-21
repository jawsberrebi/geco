-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 03 jan. 2022 à 12:47
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
) ENGINE=InnoDB AUTO_INCREMENT=124 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `capteur`
--

INSERT INTO `capteur` (`id_capteur`, `type`, `id_patient`) VALUES
(46, 'frequenceCardiaque', 5),
(47, 'niveauSonore', 5),
(48, 'concentrationGaz', 5),
(52, 'frequenceCardiaque', 7),
(53, 'niveauSonore', 7),
(54, 'concentrationGaz', 7),
(55, 'frequenceCardiaque', 8),
(56, 'niveauSonore', 8),
(57, 'concentrationGaz', 8),
(58, 'frequenceCardiaque', 9),
(59, 'niveauSonore', 9),
(60, 'concentrationGaz', 9),
(67, 'frequenceCardiaque', 12),
(68, 'niveauSonore', 12),
(69, 'concentrationGaz', 12),
(70, 'frequenceCardiaque', 13),
(71, 'niveauSonore', 13),
(72, 'concentrationGaz', 13),
(73, 'frequenceCardiaque', 14),
(74, 'niveauSonore', 14),
(75, 'concentrationGaz', 14),
(76, 'frequenceCardiaque', 15),
(77, 'niveauSonore', 15),
(78, 'concentrationGaz', 15),
(79, 'frequenceCardiaque', 16),
(80, 'niveauSonore', 16),
(81, 'concentrationGaz', 16),
(88, 'frequenceCardiaque', 19),
(89, 'niveauSonore', 19),
(90, 'concentrationGaz', 19),
(94, 'frequenceCardiaque', 21),
(95, 'niveauSonore', 21),
(96, 'concentrationGaz', 21),
(97, 'frequenceCardiaque', 22),
(98, 'niveauSonore', 22),
(99, 'concentrationGaz', 22),
(118, 'frequenceCardiaque', 29),
(119, 'niveauSonore', 29),
(120, 'concentrationGaz', 29),
(121, 'frequenceCardiaque', 30),
(122, 'niveauSonore', 30),
(123, 'concentrationGaz', 30);

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
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `mesure`
--

INSERT INTO `mesure` (`id_mesure`, `valeur`, `date_heure`, `id_capteur`) VALUES
(9, 3, '0000-00-00 00:00:00', 46),
(10, 3, '0000-00-00 00:00:00', 46),
(11, 3, '2021-11-15 15:01:34', 46),
(12, 89, '2021-11-19 15:06:25', 46),
(13, 6, '2021-11-19 15:08:33', 46),
(14, 3, '2021-11-15 15:01:34', 46),
(15, 3, '2021-11-15 15:01:34', 46),
(16, 3, '2021-11-15 15:01:34', 46),
(17, 3, '2021-11-15 15:01:34', 46),
(18, 3, '2021-11-15 15:01:34', 46),
(19, 3, '2021-11-15 15:01:34', 46),
(20, 1, '2021-11-19 15:58:13', 46),
(21, 12, '2021-11-19 15:58:59', 46),
(40, 130, '2021-12-03 16:37:54', 52),
(41, 13, '2021-12-07 17:22:00', 52),
(42, 8, '2021-12-07 17:22:21', 53),
(43, 6, '2021-12-07 17:23:08', 54),
(44, 6, '2021-12-07 17:23:08', 57),
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
(58, 85, '2021-12-17 13:01:00', 94),
(59, 100, '2021-12-17 13:44:11', 58);

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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `patient`
--

INSERT INTO `patient` (`id_patient`, `prenom`, `nom`, `mail`, `tel`, `adresse`, `description`, `mdp`, `mdp_final`, `nom_utilisateur`, `id_hopital`) VALUES
(5, 'Quentin', 'Dupieux', 'q@dupieux.fr', 0, '', 'R.A.S\r\n', '$2y$10$xaC2aNDL8Upeu4bgeCclj.VRW1UV3nmJV6Q2LCd2M1xINBDYRI10m', '', 'qdupieux', 2),
(7, 'Johnny', 'Patient', 'rd.berrebi@gmail.com', 0, '', '', '$2y$10$K9.fK1TMOL6pk7de38qCQe29X4pbW.zIiLqwKPqPtYNYgA6ewFhd6', '', 'jpatient', 2),
(8, 'Den', 'Berrebi', 'darjel@ing.fr', 0, '', '', '$2y$10$N.FGIAZ/8sC1mChJcpcBsO3XuGEWzTyMrYm5KiAahT7bb65w2/6mC', '', 'dberrebi', 2),
(9, 'Jérémy', 'Hérault', 'jer@her.co', 60606060, '10 rue de Vanves', 'Test de description.', '$2y$10$OtW4nupJNJ10RN91tv0RL.lq5OUKWE0vnaohd17q6MhqWWalSpYnC', '', 'jhérault', 2),
(12, 'Jerome', 'Jerm', 'jer@jeri.fr', 666625960, '11 rue de Vanves', 'Aucune description.', '$2y$10$Cbpycg3gNAqzfQo3l81gIOfDlnNvBHUmnDFuXJhTcCLzdLCJrOBXS', '', 'jjerm', 2),
(13, 'Johnny', 'Berreb', 'jo@ber.fr', 0, '11 rue de Vanves', 'Ok dac', '$2y$10$tZpjb6yQ3i0lQPiHcAiZNOXr/u1mUrfTnmZWuY.Gjp7JzoPAn0VcK', '', 'jberreb', 2),
(14, 'Delta', 'Freeman', 'delta@freeman.com', 666, '10 rue des rosiers', '', '$2y$10$0z772OhTdgCEQBzOW8znJeibKgYRaiVWFOfYKz.a/zgE/aOLsCktq', '', 'dfreeman', 2),
(15, 'Tom', 'Jerry', 'tom@jerry.fr', 666625960, '24 rue des Abondances', '', '$2y$10$JCt0.w1cSyb8etzaS5r1MezPxdZB/yQxRCwOIZRck7gzF8J.ZKpZG', '', 'tjerry', 2),
(16, 'Den', 'Jen', 'den@jacks.fr', 0, '11 rue de Vanves', 'Un exemple de description;', '$2y$10$684ucBQExdyEuN406D3Seu2sebblvJfr2QMu4GuP0P8c/ohxzykD2', '', 'djen', 2),
(19, 'Antoine', 'Hérault', 'antoine@herault.com', 0, '11 rue de Vanves', 'Aucune description.', '$2y$10$LiuBQc6KF5Uegb/IHCJSGeiwsvcJbZorbyhn7xZgPiu6v9oib1Scq', '', 'ahérault', 2),
(21, 'DeTest', 'Test', 'tes@test.fr', 0, '', '', '$2y$10$RXhu.ypmRmKOseUtPepWEeeCRszRnLxAIUTUGSpRyRNCiLAbJfb3m', '', 'dtest', 2),
(22, 'Thomas', 'Dubois', 't@dubois.com', 666625960, '24 rue des Abondances', '', '$2y$10$CZzFMIJia/0IlN.kan40/.IzcKZKgQKxNQKIK4RIlfuLKVAlTBk6i', '', 'tdubois', 2),
(29, 'Back', 'Lying', 'in@inf.fr', 0, '', '', '$2y$10$SBABckmEXibu9ZCYVlJcDeeYYoWxZu3T2fa0oO3JY6WqR4d4NNneq', 'a', 'blying', 2),
(30, 'On', 'Carry', 'oa@kd.fr', 0, '', '', '$2y$10$r4p9Av3M1QVw4rDnwCxAZuuJAgt5As4YirBX3lWAIoxFv0BWzutnS', 'au', 'ocarry', 2);

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
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `personnel`
--

INSERT INTO `personnel` (`id_personnel`, `prenom`, `nom`, `mail`, `tel`, `type`, `mdp`, `mdp_final`, `nom_utilisateur`, `id_hopital`) VALUES
(3, 'Johnny', 'Docteur', 'ffkfkgkg@ffk.com', 0, 'medecin', 'root', '', 'jdocteur', 2),
(4, 'Dorryd', 'Tim', 'doru@fjfj.fr', 0, 'admin', 'root', 'root', 'admin', 2),
(8, 'admi', '', '', 0, 'infirmier', 'papa', '', 'athenes', 3),
(10, '', '', '', 0, 'admin', 'root', '', 'admindeux', 3),
(11, '', '', '', 0, 'medecin', 'meux', '', 'docdeux', 3),
(12, 'Inf', 'Un', 'j@j.fr', 0, 'infirmier', '$2y$10$j/i0TIK25nSnKNONzYnsNu8HHwTv1WbyGUah5wX2HW.bXsojx1AOW', '', 'iun', 3),
(13, 'at', 'Sold', 'sol@dd.fr', 0, 'medecin', '$2y$10$S2wowCH.eaGMOBAmomEH.e21mSDHcC30rhW0ym4eU30FWfOKR35v6', '', 'asold', 3),
(14, 'Tristan', 'Brankovic', 'tristan@brankovic.com', 0, 'infirmier', 'mdp', '', 'tbrankovic', 2),
(19, 'SoLong', 'Feel', 'dodo@kifi.fr', 0, 'infirmier', '$2y$10$bFkmUzXg/4xEdMSuEQu0u.Po4uUfkel/ueHTfrkLPcFyUcBm9MTwq', '', 'sfeel', 2),
(21, 'Johnny', 'Infirmier', 'johnny@infirmier.com', 0, 'infirmier', '$2y$10$MsDG7w8xwXrD1KluH5LRJOA6LKfUlZBl1BDh85l.BTj8RONwwLMii', '', 'jinfirmier', 2),
(22, 'Okay', 'Jerem', 'okay@jerem.fr', 0, 'medecin', '$2y$10$dVNzvABzHF6y9ipgzJgHB.SAyCC4EN0SG1xgXQPT.jbyoPAkU3jkC', 'root', 'ojerem', 2),
(23, 'Jer', 'Berrebi', 'jer@ber.com', 0, 'medecin', '$2y$10$OyabB2cqmBhq5LbdcTSiTeSGHwdfVIs1CDRIXxIlCyopuwQbZDeY2', '', 'jberrebi', 2),
(24, 'Marc', 'Dubois', 'marc@dubois.com', 0, 'infirmier', '$2y$10$7SX3di48LuBl4MiEUsEnjeTymYAeo8qeBGiY2DCG/D7MOR4czZky2', 'root', 'mdubois', 2),
(28, 'cachée', 'Vie', 'sa@su.fr', 0, 'medecin', '$2y$10$n8rs2SPH3xKVrhNOecuxMuy2HQKAGDUqFGcR0z8LB7GWFH7z2t9Ju', 'root', 'cvie', 2),
(32, 'jjd', 'ssj', 'j@dkd.fr', 0, 'admin', '$2y$10$tzE0Ot37AOfGpYQN794bNugqjxKUPhKL1LRSq5hv3mv/ip7cYd.e.', '', 'jssj', 2),
(33, 'mae', 'aluae', 'ma@alue.fr', 0, 'admin', '$2y$10$VSalzuFu61j9bZ1T6WGhP.dic4TdKTc.bla4FRpP1h1mlIJIpJ1Sy', '$2y$10$bFTzAy8xc95v1Dt/N0MP8OmLb8mdzo2cozwYKMU5JMBhmXgiX5gaO', 'maluae', 2),
(34, 'Nouveau', 'Un', 'hero@har.fr', 666625960, 'admin', '$2y$10$FBUsU/mKPI3qNbXBXTfegu8fG7zgG5pUHkY7QL.z68MgjIdhkFud.', '', 'nun', 2),
(35, 'ddhdjdj', 'Mrh', 'jd@ddkf.fr', 666625960, 'admin', '$2y$10$MO1wwQiqKe9aS1MmPicBN.t1WvEc4LPM.dQsuGQ4C4lHbZDqy1RFa', '$2y$10$r9QGId/WfnSAZ/vG2ItrQ.Oo7OcRhQfkpF9wprYZvSa1OPBNm5XZ.', 'dmrh', 2);

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
