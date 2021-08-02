-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 02 août 2021 à 11:52
-- Version du serveur : 10.4.20-MariaDB
-- Version de PHP : 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `compta_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `detail_produit`
--

CREATE TABLE `detail_produit` (
  `id_produit` int(20) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `debit` int(100) NOT NULL DEFAULT 0,
  `credit` int(100) NOT NULL DEFAULT 0,
  `date_production` date NOT NULL DEFAULT current_timestamp(),
  `date_creation` date NOT NULL DEFAULT current_timestamp(),
  `confirmation` tinyint(1) NOT NULL,
  `id_fk_lot_produit` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `lot_produit`
--

CREATE TABLE `lot_produit` (
  `id_lot_produit` int(11) NOT NULL,
  `nom_lot` varchar(250) NOT NULL,
  `id_fk_produit` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id_produit` int(20) NOT NULL,
  `nom_produit` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `phone` int(20) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `name`, `email`, `phone`, `password`) VALUES
(1, 'anny', 'ranny@gmail.com', 348513535, '1234'),
(2, 'Rasoa', 'rasoa@gmail.com', 3425252, '1234'),
(4, 'Zouziel', 'zousiel@gmail.com', 245678, '1234');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `detail_produit`
--
ALTER TABLE `detail_produit`
  ADD PRIMARY KEY (`id_produit`),
  ADD KEY `id_fk_lot_produit` (`id_fk_lot_produit`);

--
-- Index pour la table `lot_produit`
--
ALTER TABLE `lot_produit`
  ADD PRIMARY KEY (`id_lot_produit`),
  ADD KEY `id_fk_produit` (`id_fk_produit`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id_produit`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `detail_produit`
--
ALTER TABLE `detail_produit`
  MODIFY `id_produit` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `lot_produit`
--
ALTER TABLE `lot_produit`
  MODIFY `id_lot_produit` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id_produit` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `detail_produit`
--
ALTER TABLE `detail_produit`
  ADD CONSTRAINT `detail_produit_ibfk_1` FOREIGN KEY (`id_fk_lot_produit`) REFERENCES `lot_produit` (`id_lot_produit`) ON UPDATE NO ACTION;

--
-- Contraintes pour la table `lot_produit`
--
ALTER TABLE `lot_produit`
  ADD CONSTRAINT `lot_produit_ibfk_1` FOREIGN KEY (`id_fk_produit`) REFERENCES `produit` (`id_produit`) ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
