-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 01 nov. 2021 à 14:43
-- Version du serveur :  8.0.21
-- Version de PHP : 7.3.21

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
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int NOT NULL AUTO_INCREMENT,
  `prenom` varchar(256) NOT NULL,
  `nom` varchar(256) NOT NULL,
  `mdp` text NOT NULL,
  `nom_utilisateur` varchar(256) NOT NULL,
  `adresse` text NOT NULL,
  `ville` varchar(256) NOT NULL,
  `nom_hopital` varchar(256) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id_admin`, `prenom`, `nom`, `mdp`, `nom_utilisateur`, `adresse`, `ville`, `nom_hopital`) VALUES
(0, 'Johnny', 'Appleseed', 'root', 'admin', '185 Rue Raymond Losserand', 'Paris 14 ', 'Hôpital Saint-Joseph');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `id_admin` int NOT NULL,
  PRIMARY KEY (`id_patient`),
  KEY `admin_patient` (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `patient`
--

INSERT INTO `patient` (`id_patient`, `prenom`, `nom`, `mail`, `tel`, `adresse`, `description`, `mdp`, `nom_utilisateur`, `id_admin`) VALUES
(6, 'Test', 'x', 'test@test.fr', 48484, '1 rue de la victoire', '', '736ecef54c44c0f3', 'tx', 0),
(7, 't', 'test', 't@t.t', 0, '', '', '957b23c650170d3c', 'ttest', 0),
(8, 'co', 'co', 'co@co.fr', 0, '', '', 'a9a9f44bfb74d660', 'cco', 0),
(9, 'Bernard', 'Géralt', 'b@g.fr', 654, '24 rue des rosiers', 'Souffre d\'asthme', 'ef7456da8d42fd53', 'bg??ralt', 0),
(12, 'éd', 'éd', 'd@d.fr', 0, '', '', 'f7228750d602b1cf', '?éd', 0),
(14, 'Bertrand', 'Géralt', 'ber@ge.fr', 648, '12 rue des hérous des magiques', 'Souffre de folie', '', 'bgéralt', 0),
(15, 'Johnny', 'Patient', 'j@p.fr', 0, '', '', 'sIjGjdh5', 'jpatient', 0);

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
  `id_admin` int NOT NULL,
  PRIMARY KEY (`id_personnel`),
  KEY `admin_personnel` (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `personnel`
--

INSERT INTO `personnel` (`id_personnel`, `prenom`, `nom`, `mail`, `tel`, `type`, `mdp`, `nom_utilisateur`, `id_admin`) VALUES
(1, 'Johnny', 'Doc', 'berjaws@gmail.com', 600000000, 'medecin', 'root', 'jdoc', 0),
(2, 'Johnny', 'Infirmier', 'no@yes.fr', 600000000, 'infirmier', 'root', 'jinfirmier', 0),
(3, 'De Vivre', 'Joie', 'joie@devivre.fr', 0, 'infirmier', '0517b37b9972ab8b', 'djoie', 0),
(4, 'Brieuc', 'Henriot', 'brieuc@henriot.com', 6666, 'medecin', '4c2df1c6fa6c1c6b', 'bhenriot', 0),
(7, 'Maxime', 'Héroult', 'max@her.fr', 0, 'infirmier', 'EyX3wqiR', 'mhéroult', 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  ADD CONSTRAINT `admin_patient` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `personnel`
--
ALTER TABLE `personnel`
  ADD CONSTRAINT `admin_personnel` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE;

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
