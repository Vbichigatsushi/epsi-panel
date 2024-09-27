-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3307
-- Généré le : ven. 27 sep. 2024 à 09:54
-- Version du serveur : 10.11.6-MariaDB-0+deb12u1
-- Version de PHP : 8.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `EpsiPanel`
--

-- --------------------------------------------------------

--
-- Structure de la table `cafeteria`
--

CREATE TABLE `cafeteria` (
  `sensor_id` int(11) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `localisation` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cafeteria`
--

INSERT INTO `cafeteria` (`sensor_id`, `date_created`, `localisation`) VALUES
(1, '2024-09-26 13:13:13', 'entry'),
(2, '2027-09-26 13:13:13', 'entry'),
(3, '2024-09-26 13:13:13', 'exit'),
(4, '2024-09-26 13:13:13', 'entry');

-- --------------------------------------------------------

--
-- Structure de la table `equipement`
--

CREATE TABLE `equipement` (
  `equipement_id` int(11) NOT NULL,
  `localisation_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `equipement`
--

INSERT INTO `equipement` (`equipement_id`, `localisation_id`, `type_id`) VALUES
(16, 1, 5),
(17, 1, 6),
(18, 1, 2),
(19, 2, 2),
(20, 2, 3),
(21, 2, 4),
(22, 2, 5),
(23, 2, 6),
(24, 3, 5),
(25, 3, 6),
(26, 4, 1),
(27, 4, 3),
(28, 4, 4),
(29, 4, 5),
(30, 4, 6);

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

CREATE TABLE `event` (
  `event_id` int(11) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `titre` varchar(256) DEFAULT NULL,
  `description` varchar(256) NOT NULL,
  `localisation_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `coordx` float DEFAULT NULL,
  `coordy` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `event`
--

INSERT INTO `event` (`event_id`, `date_created`, `titre`, `description`, `localisation_id`, `user_id`, `coordx`, `coordy`) VALUES
(5, '2024-09-26 16:42:19', 'sol mouillé', 'flaque devant le bureau du directeur', 3, 1, 3.58561, 47.822),
(6, '2024-09-26 17:00:36', 'robot cassé', 'le robot d\'usinage plante', 2, 1, 3.585, 47.8217),
(7, '2024-09-27 09:11:48', 'porte bloqué', 'porte des snacks bloquées', 4, 1, 3.58653, 47.8221),
(8, '2024-09-27 09:18:11', 'plus de PQ', 'plus de PQ dans les toilettes des garçons', 3, 1, 3.58535, 47.8223),
(9, '2024-09-27 09:23:29', 'flaque d\'eau', 'flaque d\'eau dans le couloir devant la salle 2', 1, 1, 3.58509, 47.8219),
(10, '2024-09-27 09:24:00', 'parking plein', 'trop de voitures', 2, 1, 3.58583, 47.8218);

-- --------------------------------------------------------

--
-- Structure de la table `localisation`
--

CREATE TABLE `localisation` (
  `localisation_id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `localisation`
--

INSERT INTO `localisation` (`localisation_id`, `name`) VALUES
(1, 'UIMM étage'),
(2, 'UIMM rez de chaussée'),
(3, 'EPSI étage'),
(4, 'EPSI rez de chaussée'),
(5, 'Cafétéria');

-- --------------------------------------------------------

--
-- Structure de la table `parking`
--

CREATE TABLE `parking` (
  `sensor_id` int(11) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `localisation` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `parking`
--

INSERT INTO `parking` (`sensor_id`, `date_created`, `localisation`) VALUES
(1, '2024-09-26 09:44:20', 'entree1'),
(2, '2024-09-24 14:11:08', 'entry1'),
(3, '2024-09-24 14:11:08', 'entry2');

-- --------------------------------------------------------

--
-- Structure de la table `Type_equipement`
--

CREATE TABLE `Type_equipement` (
  `type_id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Type_equipement`
--

INSERT INTO `Type_equipement` (`type_id`, `name`) VALUES
(1, 'Micro-onde'),
(2, 'Distributeur de Snacks'),
(3, 'Machine à café'),
(4, 'Fontaine à eau'),
(5, 'WC Homme'),
(6, 'WC Femme');

-- --------------------------------------------------------

--
-- Structure de la table `Users`
--

CREATE TABLE `Users` (
  `user_id` int(11) NOT NULL,
  `pseudo` varchar(256) NOT NULL,
  `firstname` varchar(256) NOT NULL,
  `lastname` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `inactive_profil` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Users`
--

INSERT INTO `Users` (`user_id`, `pseudo`, `firstname`, `lastname`, `email`, `password`, `date_created`, `inactive_profil`) VALUES
(1, 'vbichigatsushi', 'valentin', 'boiche', 'vb@gmail.com', 'Casino52', '2024-09-26 13:20:00', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cafeteria`
--
ALTER TABLE `cafeteria`
  ADD PRIMARY KEY (`sensor_id`);

--
-- Index pour la table `equipement`
--
ALTER TABLE `equipement`
  ADD PRIMARY KEY (`equipement_id`),
  ADD KEY `fk_localisation` (`localisation_id`),
  ADD KEY `fk_type` (`type_id`);

--
-- Index pour la table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `fk_users` (`user_id`),
  ADD KEY `fk_localisation_event` (`localisation_id`);

--
-- Index pour la table `localisation`
--
ALTER TABLE `localisation`
  ADD PRIMARY KEY (`localisation_id`);

--
-- Index pour la table `parking`
--
ALTER TABLE `parking`
  ADD PRIMARY KEY (`sensor_id`);

--
-- Index pour la table `Type_equipement`
--
ALTER TABLE `Type_equipement`
  ADD PRIMARY KEY (`type_id`);

--
-- Index pour la table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `cafeteria`
--
ALTER TABLE `cafeteria`
  MODIFY `sensor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `equipement`
--
ALTER TABLE `equipement`
  MODIFY `equipement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `event`
--
ALTER TABLE `event`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `localisation`
--
ALTER TABLE `localisation`
  MODIFY `localisation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `parking`
--
ALTER TABLE `parking`
  MODIFY `sensor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `Type_equipement`
--
ALTER TABLE `Type_equipement`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `Users`
--
ALTER TABLE `Users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `equipement`
--
ALTER TABLE `equipement`
  ADD CONSTRAINT `fk_localisation` FOREIGN KEY (`localisation_id`) REFERENCES `localisation` (`localisation_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_type` FOREIGN KEY (`type_id`) REFERENCES `Type_equipement` (`type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `fk_localisation_event` FOREIGN KEY (`localisation_id`) REFERENCES `localisation` (`localisation_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_users` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
