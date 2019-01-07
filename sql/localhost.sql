-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  ven. 21 déc. 2018 à 18:17
-- Version du serveur :  5.7.23-0ubuntu0.16.04.1-log
-- Version de PHP :  7.2.9-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `pbp`
--
CREATE DATABASE IF NOT EXISTS `pbp` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `pbp`;

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `login` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `agence`
--

CREATE TABLE `agence` (
  `id_agence` int(11) NOT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `cd_banque` varchar(5) NOT NULL,
  `cd_guichet` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `agence`
--

INSERT INTO `agence` (`id_agence`, `adresse`, `description`, `cd_banque`, `cd_guichet`) VALUES
(5, 'Val d\'Oise', 'VAL D\'OISE', '12345', '12345'),
(6, 'Paris', 'PARIS', '56245', '95867');

-- --------------------------------------------------------

--
-- Structure de la table `a_conseiller_client`
--

CREATE TABLE `a_conseiller_client` (
  `id_conseiller` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `beneficiaire`
--

CREATE TABLE `beneficiaire` (
  `id_beneficiaire` int(11) NOT NULL,
  `id_client` int(11) DEFAULT NULL,
  `libelle` varchar(255) DEFAULT NULL,
  `iban` varchar(100) DEFAULT NULL,
  `valide` tinyint(1) NOT NULL DEFAULT '0',
  `date_ajout` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `beneficiaire`
--

INSERT INTO `beneficiaire` (`id_beneficiaire`, `id_client`, `libelle`, `iban`, `valide`, `date_ajout`) VALUES
(38, 26, 'Benjamin Coquard', '0201284184P91725873245', 1, '2018-12-15 18:39:27');

-- --------------------------------------------------------

--
-- Structure de la table `carte_bancaire`
--

CREATE TABLE `carte_bancaire` (
  `id_carte` int(11) NOT NULL,
  `id_compte` int(11) DEFAULT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `Cryptocrypto` varchar(255) DEFAULT NULL,
  `nom_usage` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `chequier`
--

CREATE TABLE `chequier` (
  `id_chequier` int(11) NOT NULL,
  `id_compte` int(11) DEFAULT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `login` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `type` enum('PARTICULIER','PROFESSIONNEL') DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `id_agence` int(11) NOT NULL,
  `rib` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id_client`, `login`, `password`, `type`, `nom`, `prenom`, `date_naissance`, `email`, `telephone`, `adresse`, `id_agence`, `rib`) VALUES
(26, 'marie@email.com', 'marie', 'PARTICULIER', 'GAZAL', 'Marie', '1995-04-30', 'marie@email.com', '0688062661', '75 avenue du Général Leclerc', 5, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

CREATE TABLE `compte` (
  `id_compte` int(11) NOT NULL,
  `type` enum('epargne','cheque') NOT NULL,
  `numero_compte` varchar(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `solde` decimal(10,0) NOT NULL,
  `taux` decimal(10,0) NOT NULL,
  `decouvert` tinyint(1) NOT NULL,
  `id_agence` int(11) NOT NULL,
  `cd_pays` varchar(2) NOT NULL,
  `cle_rib` varchar(2) NOT NULL,
  `cle_iban` varchar(2) NOT NULL,
  `iban` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `compte`
--

INSERT INTO `compte` (`id_compte`, `type`, `numero_compte`, `id_client`, `solde`, `taux`, `decouvert`, `id_agence`, `cd_pays`, `cle_rib`, `cle_iban`, `iban`) VALUES
(13, 'cheque', '00000000001', 26, '699', '0', 1, 5, 'FR', '93', '76', 'FR7612345123450000000000193'),
(16, 'epargne', '00000000016', 26, '452', '1', 0, 5, 'FR', '83', '76', 'FR7612345123450000000001683');

-- --------------------------------------------------------

--
-- Structure de la table `conseiller`
--

CREATE TABLE `conseiller` (
  `id_conseiller` int(11) NOT NULL,
  `login` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `conseiller`
--

INSERT INTO `conseiller` (`id_conseiller`, `login`, `password`) VALUES
(2, 'conseiller', 'conseiller');

-- --------------------------------------------------------

--
-- Structure de la table `demande`
--

CREATE TABLE `demande` (
  `id_demande` int(11) NOT NULL,
  `id_client` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `demande`
--

INSERT INTO `demande` (`id_demande`, `id_client`, `date`, `message`) VALUES
(3, 26, '2018-12-15', 'Coucou');

-- --------------------------------------------------------

--
-- Structure de la table `operation`
--

CREATE TABLE `operation` (
  `operation_id` int(11) NOT NULL,
  `compte_debit` int(11) NOT NULL,
  `compte_credit` int(11) NOT NULL,
  `type` enum('VERSEMENT') NOT NULL,
  `date_execution` date DEFAULT NULL,
  `montant` decimal(10,0) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `operation`
--

INSERT INTO `operation` (`operation_id`, `compte_debit`, `compte_credit`, `type`, `date_execution`, `montant`, `description`) VALUES
(14, 13, 16, 'VERSEMENT', '2018-12-15', '1', 'Test Ben'),
(15, 13, 16, 'VERSEMENT', '2018-12-15', '300', 'Remboursement Noël');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Index pour la table `agence`
--
ALTER TABLE `agence`
  ADD PRIMARY KEY (`id_agence`);

--
-- Index pour la table `a_conseiller_client`
--
ALTER TABLE `a_conseiller_client`
  ADD PRIMARY KEY (`id_conseiller`,`id_client`),
  ADD KEY `id_client` (`id_client`);

--
-- Index pour la table `beneficiaire`
--
ALTER TABLE `beneficiaire`
  ADD PRIMARY KEY (`id_beneficiaire`),
  ADD KEY `id_client` (`id_client`);

--
-- Index pour la table `carte_bancaire`
--
ALTER TABLE `carte_bancaire`
  ADD PRIMARY KEY (`id_carte`),
  ADD KEY `id_compte` (`id_compte`);

--
-- Index pour la table `chequier`
--
ALTER TABLE `chequier`
  ADD PRIMARY KEY (`id_chequier`),
  ADD KEY `id_compte` (`id_compte`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`),
  ADD UNIQUE KEY `unique_login` (`login`);

--
-- Index pour la table `compte`
--
ALTER TABLE `compte`
  ADD PRIMARY KEY (`id_compte`),
  ADD KEY `id_client` (`id_client`);

--
-- Index pour la table `conseiller`
--
ALTER TABLE `conseiller`
  ADD PRIMARY KEY (`id_conseiller`);

--
-- Index pour la table `demande`
--
ALTER TABLE `demande`
  ADD PRIMARY KEY (`id_demande`),
  ADD KEY `id_client` (`id_client`);

--
-- Index pour la table `operation`
--
ALTER TABLE `operation`
  ADD PRIMARY KEY (`operation_id`),
  ADD KEY `compte_debit` (`compte_debit`),
  ADD KEY `compte_credit` (`compte_credit`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `agence`
--
ALTER TABLE `agence`
  MODIFY `id_agence` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `beneficiaire`
--
ALTER TABLE `beneficiaire`
  MODIFY `id_beneficiaire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `compte`
--
ALTER TABLE `compte`
  MODIFY `id_compte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `conseiller`
--
ALTER TABLE `conseiller`
  MODIFY `id_conseiller` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `demande`
--
ALTER TABLE `demande`
  MODIFY `id_demande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `operation`
--
ALTER TABLE `operation`
  MODIFY `operation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
