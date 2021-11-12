-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 12 nov. 2021 à 15:42
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
  PRIMARY KEY (`id_patient`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `patient`
--

INSERT INTO `patient` (`id_patient`, `prenom`, `nom`, `mail`, `tel`, `adresse`, `description`, `mdp`, `nom_utilisateur`) VALUES
(6, 'Test', 'x', 'test@test.fr', 48484, '1 rue de la victoire', '', '736ecef54c44c0f3', 'tx'),
(7, 't', 'test', 't@t.t', 0, '', '', '957b23c650170d3c', 'ttest'),
(8, 'co', 'co', 'co@co.fr', 0, '', '', 'a9a9f44bfb74d660', 'cco'),
(9, 'Bernard', 'Géralt', 'b@g.fr', 654, '24 rue des rosiers', 'Souffre d\'asthme', 'ef7456da8d42fd53', 'bg??ralt'),
(12, 'éd', 'éd', 'd@d.fr', 0, '', '', 'f7228750d602b1cf', '?éd'),
(14, 'Bertrand', 'Géralt', 'ber@ge.fr', 648, '12 rue des hérous des magiques', 'Souffre de folie', '', 'bgéralt'),
(15, 'Johnny', 'Patient', 'j@p.fr', 0, '', '', 'sIjGjdh5', 'jpatient'),
(16, 'Jer', 'Her', 'jer@gmail.com', 0, 'any', 'Aucune', 'm1lneESd', 'jher'),
(17, 'Hashé', 'Le Patient', 'hash@hashed.fr', 0, 'Not', 'Not\r\n', '$2y$10$730vII9h7gTqiMPMmndtmeXmspU9Kh4CMYZLAZbCp1PUAiPUC29iq', 'hle patient'),
(18, 'Mail', 'Envoi', 'yes@yes.yes', 0, '', '', '$2y$10$v5CQeR2DNf89LovEtnFqo.Jf42uWtXMu5IMFi/QALGLOjU/XCwFcS', 'menvoi'),
(19, 'Vénèr', 'Test', 'ven@test.fr', 0, '', '', 'A5uoORGn', 'vtest'),
(20, 'IDP', 'Test', 'id@id.fr', 0, '', '', '9INMXTMu', 'itest'),
(21, 'stress', 'test', 's@t.fr', 0, '', '', 'FhguZ4ak', 'stest');

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
  `adresse` text NOT NULL,
  `nom_hopital` text NOT NULL,
  `ville` text NOT NULL,
  PRIMARY KEY (`id_personnel`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `personnel`
--

INSERT INTO `personnel` (`id_personnel`, `prenom`, `nom`, `mail`, `tel`, `type`, `mdp`, `nom_utilisateur`, `adresse`, `nom_hopital`, `ville`) VALUES
(1, 'Johnny', 'Doc', 'berjaws@gail.com', 60000000, 'medecin', 'root', 'jdoc', '', '', ''),
(2, 'Johnny', 'Infirmier', 'no@yes.f', 60000000, 'infirmier', 'root', 'jinfirmier', '', '', ''),
(3, 'De Vivre', 'Joie', 'joie@devivre.fr', 0, 'infirmier', '0517b37b9972ab8b', 'djoie', '', '', ''),
(4, 'Brieuc', 'Henriot', 'brieuc@henriot.com', 6666, 'medecin', '4c2df1c6fa6c1c6b', 'bhenriot', '', '', ''),
(7, 'Maxime', 'Héroult', 'max@her.fr', 0, 'infirmier', 'EyX3wqiR', 'mhéroult', '', '', ''),
(9, 'You', 'Hey', 'Hey@You.fr', 0, 'infirmier', '4EGXxX30', 'yhey', '', '', ''),
(10, 'Joseph', 'Admin', 'bs@gmail.com', 60606060, 'admin', 'root', 'admin', '1 Rue Paul Delaroche', 'Saint-Joseph', 'Paris'),
(11, 'dac', 'oui', 'dac@gmail.com', 0, 'infirmier', 'Ckr1VdsV', 'doui', '', '', ''),
(12, 'de', 'test', 'test@de.fr', 0, 'medecin', 'Oh6MSmv7', 'dtest', '', '', '');

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
-- Contraintes pour la table `travaille_pour`
--
ALTER TABLE `travaille_pour`
  ADD CONSTRAINT `patient_personnel` FOREIGN KEY (`id_patient`) REFERENCES `patient` (`id_patient`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `personnel_patient` FOREIGN KEY (`id_personnel`) REFERENCES `personnel` (`id_personnel`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
