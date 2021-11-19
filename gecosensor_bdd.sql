-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 13 nov. 2021 à 11:37
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
  `type` varchar(256) NOT NULL,
  `id_patient` int NOT NULL,
  PRIMARY KEY (`id_capteur`),
  KEY `patient_capteur` (`id_patient`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `date` timestamp NOT NULL,
  `id_capteur` int NOT NULL,
  PRIMARY KEY (`id_mesure`),
  KEY `capteur_mesure` (`id_capteur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `nom_utilisateur` varchar(256) NOT NULL,
  `id_hopital` int NOT NULL,
  PRIMARY KEY (`id_patient`),
  KEY `id_hopital` (`id_hopital`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `patient`
--

INSERT INTO `patient` (`id_patient`, `prenom`, `nom`, `mail`, `tel`, `adresse`, `description`, `mdp`, `nom_utilisateur`, `id_hopital`) VALUES
(1, 'Crève', 'Je', 'ok@ok.fr', 0, '', '', '$2y$10$TzQNUrq3DgQ7keWlcaS3QeqIsEJ8ZdMFqXYpST0aXyh6FjnB4wF7O', 'cje', 2),
(2, '', '', '', 0, '', '', '', 'nimp', 3),
(3, 'Pire', 'New', 'd@d.d', 0, '', '', '$2y$10$Ax1IoJgkDTz/yAQbN8MHMOvrMditY3xfbxsEG01TltopRpiirW4Ie', 'pnew', 3);

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
  `nom_utilisateur` varchar(256) NOT NULL,
  `id_hopital` int NOT NULL,
  PRIMARY KEY (`id_personnel`),
  KEY `hopital_personnel` (`id_hopital`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `personnel`
--

INSERT INTO `personnel` (`id_personnel`, `prenom`, `nom`, `mail`, `tel`, `type`, `mdp`, `nom_utilisateur`, `id_hopital`) VALUES
(3, 'Johnny', 'Docteur', '', 0, 'medecin', 'root', 'jdoc', 2),
(4, 'Statut', 'd\'Hivern', '', 0, 'admin', 'root', 'admin', 2),
(6, '', '', '', 0, 'infirmier', 'root', 'jinfirmier', 2),
(7, 'Suicide', 'Go', 'go@suicide.fr', 0, 'infirmier', '$2y$10$FktdlG5BZ/hyKmEXjy8YOOnnCrRjgzeAZ3ZYdUyhEBHIyqaZ29ygG', 'sgo', 2),
(8, 'admi', '', '', 0, 'infirmier', 'papa', 'athenes', 3),
(10, '', '', '', 0, 'admin', 'root', 'admindeux', 3),
(11, '', '', '', 0, 'medecin', 'meux', 'docdeux', 3),
(12, 'Inf', 'Un', 'j@j.fr', 0, 'infirmier', '$2y$10$j/i0TIK25nSnKNONzYnsNu8HHwTv1WbyGUah5wX2HW.bXsojx1AOW', 'iun', 3),
(13, 'at', 'Sold', 'sol@dd.fr', 0, 'medecin', '$2y$10$S2wowCH.eaGMOBAmomEH.e21mSDHcC30rhW0ym4eU30FWfOKR35v6', 'asold', 3);

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
