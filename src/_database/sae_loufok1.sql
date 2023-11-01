-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 29 oct. 2023 à 22:35
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sae.loufok`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE `administrateur` (
  `id_administrateur` int(11) NOT NULL,
  `ad_mail_administrateur` varchar(100) DEFAULT NULL,
  `mot_de_passe_administrateur` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`id_administrateur`, `ad_mail_administrateur`, `mot_de_passe_administrateur`) VALUES
(1, 'bchaulet@mail.com', 'mdp_admin');

-- --------------------------------------------------------

--
-- Structure de la table `cadavre`
--

CREATE TABLE `cadavre` (
  `id_cadavre` int(11) NOT NULL,
  `titre_cadavre` varchar(100) DEFAULT NULL,
  `date_debut_cadavre` date DEFAULT NULL,
  `date_fin_cadavre` date DEFAULT NULL,
  `nb_contributions` int(11) DEFAULT NULL,
  `nb_jaime` int(11) DEFAULT NULL,
  `id_administrateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Structure de la table `contribution`
--

CREATE TABLE `contribution` (
  `id_contribution` int(11) NOT NULL,
  `texte_contribution` varchar(280) NOT NULL,
  `date_soumission` date DEFAULT NULL,
  `ordre_soumission` int(11) NOT NULL,
  `id_joueur` smallint(6) DEFAULT NULL,
  `id_administrateur` int(11) DEFAULT NULL,
  `id_cadavre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `contribution_aléatoire`
--

CREATE TABLE `contribution_aléatoire` (
  `id_joueur` smallint(6) NOT NULL,
  `id_cadavre` int(11) NOT NULL,
  `num_contribution` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `joueur`
--

CREATE TABLE `joueur` (
  `id_joueur` smallint(6) NOT NULL,
  `ad_mail_joueur` varchar(50) NOT NULL,
  `sexe` varchar(15) NOT NULL,
  `ddn` date NOT NULL,
  `nom_plume` varchar(25) NOT NULL,
  `mot_de_passe_joueur` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `joueur`
--

INSERT INTO `joueur` (`id_joueur`, `ad_mail_joueur`, `sexe`, `ddn`, `nom_plume`, `mot_de_passe_joueur`) VALUES
(1, 'etu@univ-poitiers.fr', 'femme', '2003-12-06', 'ecrivain', 'mdp'),
(2, 'tom@dijon.fr', 'homme', '2003-05-21', 'tom', 'tom'),
(4, 'template@mail.com', 'inconnu', '2001-07-18', 'chaosbeing', 'chaosbeing'),
(5, 'pascal@mail.com', 'homme', '2004-01-21', 'pascalito', 'pascalito'),
(6, 'mylaine@mail.com', 'femme', '2003-02-28', 'mylan', 'mylan');


--
-- Index pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`id_administrateur`);

--
-- Index pour la table `cadavre`
--
ALTER TABLE `cadavre`
  ADD PRIMARY KEY (`id_cadavre`),
  ADD KEY `id_administrateur` (`id_administrateur`);

--
-- Index pour la table `contribution`
--
ALTER TABLE `contribution`
  ADD PRIMARY KEY (`id_contribution`),
  ADD KEY `id_joueur` (`id_joueur`),
  ADD KEY `id_administrateur` (`id_administrateur`),
  ADD KEY `id_cadavre` (`id_cadavre`);

--
-- Index pour la table `contribution_aléatoire`
--
ALTER TABLE `contribution_aléatoire`
  ADD KEY `id_cadavre` (`id_cadavre`),
  ADD KEY `id_joueur` (`id_joueur`);

--
-- Index pour la table `joueur`
--
ALTER TABLE `joueur`
  ADD PRIMARY KEY (`id_joueur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `administrateur`
--
ALTER TABLE `administrateur`
  MODIFY `id_administrateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `cadavre`
--
ALTER TABLE `cadavre`
  MODIFY `id_cadavre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT pour la table `contribution`
--
ALTER TABLE `contribution`
  MODIFY `id_contribution` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT pour la table `contribution_aléatoire`
--
ALTER TABLE `contribution_aléatoire`
  MODIFY `id_joueur` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `joueur`
--
ALTER TABLE `joueur`
  MODIFY `id_joueur` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cadavre`
--
ALTER TABLE `cadavre`
  ADD CONSTRAINT `cadavre_ibfk_1` FOREIGN KEY (`id_administrateur`) REFERENCES `administrateur` (`id_administrateur`);

--
-- Contraintes pour la table `contribution`
--
ALTER TABLE `contribution`
  ADD CONSTRAINT `contribution_ibfk_1` FOREIGN KEY (`id_joueur`) REFERENCES `joueur` (`id_joueur`),
  ADD CONSTRAINT `contribution_ibfk_2` FOREIGN KEY (`id_administrateur`) REFERENCES `administrateur` (`id_administrateur`),
  ADD CONSTRAINT `contribution_ibfk_3` FOREIGN KEY (`id_cadavre`) REFERENCES `cadavre` (`id_cadavre`);

--
-- Contraintes pour la table `contribution_aléatoire`
--
ALTER TABLE `contribution_aléatoire`
  ADD CONSTRAINT `contribution_aléatoire_ibfk_1` FOREIGN KEY (`id_joueur`) REFERENCES `joueur` (`id_joueur`) ON DELETE CASCADE,
  ADD CONSTRAINT `contribution_aléatoire_ibfk_2` FOREIGN KEY (`id_cadavre`) REFERENCES `cadavre` (`id_cadavre`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
