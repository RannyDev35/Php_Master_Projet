-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 13 août 2021 à 15:22
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
-- Structure de la table `detail_produit`
--

CREATE TABLE `detail_produit` (
  `id_produit` int(20) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `debit` int(100) NOT NULL DEFAULT 0,
  `credit` int(100) NOT NULL DEFAULT 0,
  `date_production` date NOT NULL DEFAULT current_timestamp(),
  `confirmation` int(5) NOT NULL,
  `id_fk_lot_produit` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `detail_produit`
--

INSERT INTO `detail_produit` (`id_produit`, `description`, `debit`, `credit`, `date_production`, `confirmation`, `id_fk_lot_produit`) VALUES
(1, 'Vaovao', 2000, 0, '2021-07-22', 1, 7),
(2, 'vao ty a', 0, 30000, '2021-07-22', 2, 8),
(3, 'tyyt', 345, 0, '2021-07-31', 2, 9),
(4, 'manomboka', 45, 0, '2021-07-22', 1, 7);

-- --------------------------------------------------------

--
-- Structure de la table `lot_produit`
--

CREATE TABLE `lot_produit` (
  `id_lot_produit` int(11) NOT NULL,
  `nom_lot` varchar(250) NOT NULL,
  `id_fk_produit` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `lot_produit`
--

INSERT INTO `lot_produit` (`id_lot_produit`, `nom_lot`, `id_fk_produit`) VALUES
(3, 'lot 2', 1),
(7, 'Lot 1', 5),
(8, 'Lot 2', 5),
(9, 'Lot 3', 5);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id_produit` int(20) NOT NULL,
  `nom_produit` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `nom_produit`) VALUES
(1, 'Poulet de Chaire'),
(3, 'Legume'),
(4, 'Poisson'),
(5, 'Porc');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `phone` int(20) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'utilisateur'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `name`, `email`, `phone`, `password`, `role`) VALUES
(7, 'Annyzo', 'rannyzo@gmail.com', 12346, '12341234', 'utilisateur');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `detail_produit`
--
ALTER TABLE `detail_produit`
  ADD PRIMARY KEY (`id_produit`),
  ADD KEY `detail_produit_ibfk_1` (`id_fk_lot_produit`);

--
-- Index pour la table `lot_produit`
--
ALTER TABLE `lot_produit`
  ADD PRIMARY KEY (`id_lot_produit`),
  ADD KEY `lot_produit_ibfk_1` (`id_fk_produit`);

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
-- AUTO_INCREMENT pour la table `detail_produit`
--
ALTER TABLE `detail_produit`
  MODIFY `id_produit` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `lot_produit`
--
ALTER TABLE `lot_produit`
  MODIFY `id_lot_produit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id_produit` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `detail_produit`
--
ALTER TABLE `detail_produit`
  ADD CONSTRAINT `detail_produit_ibfk_1` FOREIGN KEY (`id_fk_lot_produit`) REFERENCES `lot_produit` (`id_lot_produit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `lot_produit`
--
ALTER TABLE `lot_produit`
  ADD CONSTRAINT `lot_produit_ibfk_1` FOREIGN KEY (`id_fk_produit`) REFERENCES `produit` (`id_produit`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
