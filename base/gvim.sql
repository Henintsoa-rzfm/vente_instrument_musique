-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 09 fév. 2022 à 15:37
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gvim`
--

-- --------------------------------------------------------

--
-- Structure de la table `achat`
--

DROP TABLE IF EXISTS `achat`;
CREATE TABLE IF NOT EXISTS `achat` (
  `NumAchat` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `DateAchat` date NOT NULL,
  `HeureAchat` time NOT NULL,
  `CodeMP` int(2) UNSIGNED DEFAULT NULL,
  `idCom` int(2) UNSIGNED DEFAULT NULL,
  `NumShop` int(2) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`NumAchat`),
  KEY `fk_MP` (`CodeMP`),
  KEY `fk_Commercial` (`idCom`),
  KEY `fk_Shop` (`NumShop`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `acheter`
--

DROP TABLE IF EXISTS `acheter`;
CREATE TABLE IF NOT EXISTS `acheter` (
  `Quantite` int(3) NOT NULL,
  `NumAchat` int(6) UNSIGNED NOT NULL,
  `RefClt` int(6) UNSIGNED NOT NULL,
  `idModele` int(3) UNSIGNED NOT NULL,
  PRIMARY KEY (`NumAchat`,`RefClt`,`idModele`),
  KEY `fk_composer_Client` (`RefClt`),
  KEY `fk_composer_Modele` (`idModele`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `RefClt` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `Client` varchar(50) NOT NULL,
  `Adresse` varchar(30) NOT NULL,
  `idProvince` int(2) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`RefClt`),
  KEY `fk_Province` (`idProvince`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `commercial`
--

DROP TABLE IF EXISTS `commercial`;
CREATE TABLE IF NOT EXISTS `commercial` (
  `idCom` int(2) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `Commercial` char(30) NOT NULL,
  PRIMARY KEY (`idCom`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `instrument`
--

DROP TABLE IF EXISTS `instrument`;
CREATE TABLE IF NOT EXISTS `instrument` (
  `idInstrument` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `Instrument` char(30) NOT NULL,
  PRIMARY KEY (`idInstrument`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `modele`
--

DROP TABLE IF EXISTS `modele`;
CREATE TABLE IF NOT EXISTS `modele` (
  `idModele` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `Modele` varchar(20) NOT NULL,
  `Taille` enum('Adulte','Enfant') NOT NULL,
  `PrixUnitaire` float(12,2) NOT NULL,
  `idInstrument` int(3) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`idModele`),
  KEY `fk_instrument` (`idInstrument`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `modepaiement`
--

DROP TABLE IF EXISTS `modepaiement`;
CREATE TABLE IF NOT EXISTS `modepaiement` (
  `CodeMP` int(2) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `MP` char(30) NOT NULL,
  PRIMARY KEY (`CodeMP`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `province`
--

DROP TABLE IF EXISTS `province`;
CREATE TABLE IF NOT EXISTS `province` (
  `idProvince` int(2) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `Province` char(30) NOT NULL,
  PRIMARY KEY (`idProvince`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `shop`
--

DROP TABLE IF EXISTS `shop`;
CREATE TABLE IF NOT EXISTS `shop` (
  `NumShop` int(2) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `Shop` char(30) NOT NULL,
  PRIMARY KEY (`NumShop`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `telephone`
--

DROP TABLE IF EXISTS `telephone`;
CREATE TABLE IF NOT EXISTS `telephone` (
  `TelClt` varchar(30) NOT NULL,
  `RefClt` int(6) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`TelClt`),
  KEY `fk_Client` (`RefClt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `achat`
--
ALTER TABLE `achat`
  ADD CONSTRAINT `fk_Commercial` FOREIGN KEY (`idCom`) REFERENCES `commercial` (`idCom`),
  ADD CONSTRAINT `fk_MP` FOREIGN KEY (`CodeMP`) REFERENCES `modepaiement` (`CodeMP`),
  ADD CONSTRAINT `fk_Shop` FOREIGN KEY (`NumShop`) REFERENCES `shop` (`NumShop`);

--
-- Contraintes pour la table `acheter`
--
ALTER TABLE `acheter`
  ADD CONSTRAINT `fk_composer_Achat` FOREIGN KEY (`NumAchat`) REFERENCES `achat` (`NumAchat`),
  ADD CONSTRAINT `fk_composer_Client` FOREIGN KEY (`RefClt`) REFERENCES `client` (`RefClt`),
  ADD CONSTRAINT `fk_composer_Modele` FOREIGN KEY (`idModele`) REFERENCES `modele` (`idModele`);

--
-- Contraintes pour la table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `fk_Province` FOREIGN KEY (`idProvince`) REFERENCES `province` (`idProvince`);

--
-- Contraintes pour la table `modele`
--
ALTER TABLE `modele`
  ADD CONSTRAINT `fk_instrument` FOREIGN KEY (`idInstrument`) REFERENCES `instrument` (`idInstrument`);

--
-- Contraintes pour la table `telephone`
--
ALTER TABLE `telephone`
  ADD CONSTRAINT `fk_Client` FOREIGN KEY (`RefClt`) REFERENCES `client` (`RefClt`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
