-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 24 nov. 2023 à 16:18
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `loufok2.0`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE `administrateur` (
  `id_administrateur` int(11) NOT NULL,
  `ad_mail_administrateur` varchar(100) DEFAULT NULL,
  `mot_de_passe_administrateur` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `cadavre`
--

INSERT INTO `cadavre` (`id_cadavre`, `titre_cadavre`, `date_debut_cadavre`, `date_fin_cadavre`, `nb_contributions`, `nb_jaime`, `id_administrateur`) VALUES
(92, 'Premier', '2023-10-17', '2023-10-30', 4, 0, 1),
(93, 'Le Deuxième', '2023-11-21', '2023-11-24', 12, 0, 1),
(94, 'Troisième', '2023-09-01', '2023-09-16', 5, 0, 1),
(95, 'Quatrième', '2023-12-28', '2023-12-31', 5, 0, 1);

--
-- Déclencheurs `cadavre`
--
DELIMITER $$
CREATE TRIGGER `OverlapDate` BEFORE INSERT ON `cadavre` FOR EACH ROW BEGIN
    DECLARE overlap INT;

    -- Vérifier s'il y a des cadavres exquis avec des périodes qui se chevauchent
    SELECT COUNT(*) INTO overlap
    FROM cadavre
    WHERE NEW.date_debut_cadavre <= date_fin_cadavre AND NEW.date_fin_cadavre >= date_debut_cadavre;

    -- Si le nombre de cadavres exquis avec des périodes qui se chevauchent est supérieur à 0, signaler une erreur
    IF overlap > 0 OR NEW.date_debut_cadavre >= NEW.date_fin_cadavre THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'La période du nouveau cadavre exquis se chevauche avec une période existante.';
    END IF;
END
$$
DELIMITER ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `contribution`
--

INSERT INTO `contribution` (`id_contribution`, `texte_contribution`, `date_soumission`, `ordre_soumission`, `id_joueur`, `id_administrateur`, `id_cadavre`) VALUES
(74, 'Première soumission de contribution pour le premier cadavre exquis voila voila', '2023-11-18', 1, NULL, 1, 92),
(76, 'troisième soumission de contribution pour le premier cadavre exquis voila voila voila voila', '2023-11-23', 3, 5, NULL, 92),
(92, 'azertyuiopmlhgfdcbgfhgfcvbgfvbgfcftgvthgb', '2023-11-21', 2, 6, NULL, 92),
(93, 'azereeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeerrdddddddddddddddddddd', '2023-11-14', 1, 5, NULL, 93),
(94, 'pascalllllllllllllllllaaaa', '2023-09-05', 1, 5, NULL, 94),
(104, 'La contribution de test en fait là c\'est le turfu mageule', '2023-10-26', 4, 2, NULL, 92),
(105, 'contribution t\'a vu', '2023-11-20', 2, 2, NULL, 93);

--
-- Déclencheurs `contribution`
--
DELIMITER $$
CREATE TRIGGER `newContrib` BEFORE INSERT ON `contribution` FOR EACH ROW BEGIN
    DECLARE contribCount INT;
    DECLARE maxContrib INT;

    -- Compter le nombre de contributions pour l'id_cadavre_exquis de la nouvelle contribution
    SELECT COUNT(*) INTO contribCount
    FROM contribution
    WHERE id_cadavre = NEW.id_cadavre;

    -- Vérifier si le nombre de contributions est inférieur à maxContrib du cadavre
    IF contribCount >= (SELECT nb_contributions FROM cadavre WHERE id_cadavre = NEW.id_cadavre) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Le nombre maximum de contributions pour ce cadavre exquis est atteint.';
    END IF;

    -- Trouver le plus grand submission_order pour le même id_cadavre_exquis
    SELECT MAX(ordre_soumission) INTO maxContrib
    FROM contribution
    WHERE id_cadavre = NEW.id_cadavre;

    -- Mettre à jour ordre_soumission dans la nouvelle contribution
    SET NEW.ordre_soumission = COALESCE(maxContrib, 0) + 1;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `contribution_aléatoire`
--

CREATE TABLE `contribution_aléatoire` (
  `id_joueur` smallint(6) NOT NULL,
  `id_cadavre` int(11) NOT NULL,
  `num_contribution` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `contribution_aléatoire`
--

INSERT INTO `contribution_aléatoire` (`id_joueur`, `id_cadavre`, `num_contribution`) VALUES
(4, 92, 76),
(5, 92, 76),
(6, 92, 74),
(1, 92, 74),
(2, 92, 92),
(2, 92, 92),
(2, 92, 92);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `joueur`
--

INSERT INTO `joueur` (`id_joueur`, `ad_mail_joueur`, `sexe`, `ddn`, `nom_plume`, `mot_de_passe_joueur`) VALUES
(1, 'etu@univ-poitiers.fr', 'femme', '2003-12-06', 'ecrivain', 'mdp'),
(2, 'tom@dijon.fr', 'homme', '2003-05-21', 'tom', 'tom'),
(4, 'template@mail.com', 'inconnu', '2001-07-18', 'chaosbeing', 'chaosbeing'),
(5, 'pascal@mail.com', 'homme', '2004-01-21', 'pascalito', 'pascalito'),
(6, 'mylaine@mail.com', 'femme', '2003-02-28', 'mylan', 'mylan'),
(7, 'manon.allaguy-salachy@etu.univ-poitiers.fr', '', '0000-00-00', 'Manon A', 'mmi2023'),
(8, 'anoki.aufrere@etu.univ-poitiers.fr', '', '0000-00-00', 'Anoki A', 'mmi2023'),
(9, 'janice.aza.gnadji@etu.univ-poitiers.fr', '', '0000-00-00', 'Janice A', 'mmi2023'),
(10, 'mael.dubau@etu.univ-poitiers.fr', '', '0000-00-00', 'Mael D', 'mmi2023'),
(11, 'antoine.laroche@etu.univ-poitiers.fr', '', '0000-00-00', 'Antoine L', 'mmi2023'),
(12, 'leonie.lavault@etu.univ-poitiers.fr', '', '0000-00-00', 'Leonie L', 'mmi2023'),
(13, 'titouan.le borgne@etu.univ-poitiers.fr', '', '0000-00-00', 'Titouan L', 'mmi2023'),
(14, 'quentin.le page@etu.univ-poitiers.fr', '', '0000-00-00', 'Quentin L', 'mmi2023'),
(15, 'evan.loustalet@etu.univ-poitiers.fr', '', '0000-00-00', 'Evan L', 'mmi2023'),
(16, 'fabian.marceau@etu.univ-poitiers.fr', '', '0000-00-00', 'Fabian M', 'mmi2023'),
(17, 'leni.marraud@etu.univ-poitiers.fr', '', '0000-00-00', 'Leni M', 'mmi2023'),
(18, 'baptiste.martineau@etu.univ-poitiers.fr', '', '0000-00-00', 'Baptiste M', 'mmi2023'),
(19, 'laura.noel@etu.univ-poitiers.fr', '', '0000-00-00', 'Laura N', 'mmi2023'),
(20, 'nathan.pruchniak@etu.univ-poitiers.fr', '', '0000-00-00', 'Nathan P', 'mmi2023'),
(21, 'antoine.quantin@etu.univ-poitiers.fr', '', '0000-00-00', 'Antoine Q', 'mmi2023'),
(22, 'hery.rajaona@etu.univ-poitiers.fr', '', '0000-00-00', 'Hery R', 'mmi2023');

--
-- Index pour les tables déchargées
--

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
  MODIFY `id_cadavre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT pour la table `contribution`
--
ALTER TABLE `contribution`
  MODIFY `id_contribution` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT pour la table `joueur`
--
ALTER TABLE `joueur`
  MODIFY `id_joueur` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
