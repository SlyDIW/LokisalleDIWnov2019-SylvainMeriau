-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 15 fév. 2020 à 23:05
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `lokisalle_meriau`
--

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `id_avis` int(3) NOT NULL,
  `id_membre` int(3) NOT NULL,
  `id_salle` int(3) NOT NULL,
  `commentaire` text NOT NULL,
  `note` enum('1','2','3','4','5') NOT NULL DEFAULT '5',
  `date_enregistrement` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id_avis`, `id_membre`, `id_salle`, `commentaire`, `note`, `date_enregistrement`) VALUES
(1, 2, 1, 'nice', '4', '2020-02-06 16:01:25'),
(4, 1, 5, 'cool', '5', '2020-02-11 11:48:00'),
(5, 1, 3, 'sympa', '5', '2020-02-11 11:48:39');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id_commande` int(3) NOT NULL,
  `id_membre` int(3) NOT NULL,
  `id_produit` int(3) NOT NULL,
  `date_enregistrement` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id_commande`, `id_membre`, `id_produit`, `date_enregistrement`) VALUES
(1, 1, 1, '2020-02-21 10:00:00'),
(2, 1, 8, '2020-02-11 12:02:13');

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `id_membre` int(3) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `mdp` varchar(60) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `civilite` enum('Mr','Mme','','') NOT NULL,
  `statut` enum('admin','user','','') NOT NULL DEFAULT 'user',
  `date_enregistrement` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id_membre`, `pseudo`, `mdp`, `nom`, `prenom`, `email`, `civilite`, `statut`, `date_enregistrement`) VALUES
(1, 'Sly', 'Jormungand', 'Meriau', 'Sylvain', 'meriau.diw@gmail.com', 'Mr', 'admin', '2020-02-05 09:00:00'),
(2, 'Patoche', 'lamartine', 'Pat', 'Lapin', 'lapinou@clapier.fr', 'Mr', 'user', '2020-02-05 09:00:00'),
(3, 'Boubou', 'Isinthehouse', 'Streisand', 'Barbara', 'streisand@aol.com', 'Mme', 'user', '2020-02-15 22:58:14'),
(7, 'Poum', 'pimpim', 'Duck', 'Daisy', 'coincoin@yahoo.fr', 'Mme', 'user', '2020-02-15 23:00:36');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id_produit` int(3) NOT NULL,
  `id_salle` int(3) NOT NULL,
  `date_arrivee` datetime NOT NULL DEFAULT current_timestamp(),
  `date_depart` datetime NOT NULL DEFAULT current_timestamp(),
  `prix` int(3) NOT NULL,
  `etat` enum('libre','reservé','','') NOT NULL DEFAULT 'libre'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `id_salle`, `date_arrivee`, `date_depart`, `prix`, `etat`) VALUES
(1, 1, '2020-02-15 09:00:00', '2020-02-15 21:00:00', 1100, 'libre'),
(8, 5, '2020-02-29 09:00:00', '2020-02-29 21:00:00', 1100, 'libre'),
(20, 9, '2020-02-22 09:00:00', '2020-02-22 21:00:00', 750, 'libre'),
(22, 44, '2020-02-29 09:00:00', '2020-02-29 19:00:00', 1400, 'libre'),
(23, 13, '2020-02-21 09:00:00', '2020-02-21 17:00:00', 900, 'libre'),
(24, 47, '2020-02-27 08:00:00', '2020-02-27 18:00:00', 600, 'libre');

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE `salle` (
  `id` int(3) NOT NULL,
  `titre` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `photo` varchar(200) NOT NULL,
  `pays` varchar(20) NOT NULL,
  `ville` varchar(20) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `cp` int(5) NOT NULL,
  `capacite` int(3) NOT NULL,
  `categorie` enum('reunion','bureau','formation','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `salle`
--

INSERT INTO `salle` (`id`, `titre`, `description`, `photo`, `pays`, `ville`, `adresse`, `cp`, `capacite`, `categorie`) VALUES
(1, 'Bureau Angkor', 'un double bureau parfait pour travailler sereinement avec une vue sur tout Paris.', 'bureau1.png', 'France', 'Paris', 'Tour Montparnasse', 75015, 1, 'bureau'),
(2, 'Bureau Corail', 'Bureau calme au coeur de Lyon pour recevoir vos clients.', 'bureau2.png', 'France', 'Lyon', '10 avenue de la République', 69001, 3, 'bureau'),
(3, 'Bureau Machu Picchu', 'A deux pas de l\'aéroport, pour travailler entre deux déplacements internationaux.', 'bureau3.png', 'France', 'Marseille', 'Aéroport Marseille Provence, Marignane', 13700, 2, 'bureau'),
(4, 'Bureau Impérial', 'Placé idéalement au centre de Paris.', 'bureau4.png', 'France', 'Paris', '28 Cours Albert 1er', 75008, 1, 'bureau'),
(5, 'Bureau Taj Mahal', 'Au centre de Lyon, donnant sur un jardin en cour intérieure pour le calme.', 'bureau5.png', 'France', 'Lyon', '20 Boulevard Eugène Deruelle', 69003, 1, 'bureau'),
(6, 'Bureau Grand Canyon', 'En plein centre de Marseille, pour tout avoir à portée de main.', 'bureau6.png', 'France', 'Marseille', '165 Avenue du Prado', 13008, 2, 'bureau'),
(7, 'Bureau Colosseo modifié', 'Parfaitement équipé pour les techs, en plein centre du quartier latin parisien.', 'bureau7.png', 'France', 'Paris', '2 place de la contrescarpe', 75005, 1, 'bureau'),
(8, 'Bureau Iguazu', 'Parfait pour les globe-trotters venant à Lyon, directement dans l\'aéroport.', 'bureau8.png', 'France', 'Lyon', '125 RUE DES PAYS-BAS, Lyon-Saint-Exupery Aeroport', 69125, 2, 'bureau'),
(9, 'Bureau Aya Sofia', 'Travailler avec une vue magnifique sur le Vieux Port de Marseille, un privilège.', 'bureau9.png', 'France', 'Marseille', 'La Major, Boulevard Jacques Saade', 13002, 1, 'bureau'),
(10, 'Bureau Alhambra', 'Avec une vue sur tout Montmartre, pour inspirer vos idées.', 'bureau10.png', 'France', 'Paris', '2 rue Paul Albert', 75018, 2, 'bureau'),
(11, 'Formation Angkor', 'entièrement équipé en réseau, option vidéo-conférence, en haut de la Tour Montparnasse', 'formation1.png', 'France', 'Paris', 'Tour Montparnasse', 75015, 10, 'formation'),
(12, 'Formation Corail', 'Parfait pour former des petits groupes, entièrement équipé.', 'formation2.png', 'France', 'Lyon', '10 avenue de la République', 69001, 5, 'formation'),
(13, 'Formation Machu Picchu', 'salle de formation équipée jusque 20 personnes ', 'formation3.png', 'France', 'Marseille', 'Aéroport Marseille Provence', 13700, 20, 'formation'),
(40, 'Formation Impérial', 'Laboratoire d\'apprentissage entièrement équipé', 'formation4.png', 'France', 'Paris', 'Tour Montparnasse', 75015, 20, 'formation'),
(41, 'Formation Taj Mahal', 'Salle de formation avec vidéo-projection', 'formation5.png', 'France', 'Lyon', '10 avenue de la République', 69001, 20, 'formation'),
(42, 'Formation Grand Canyon', 'Salle de classe avec vidéo-projection', 'formation6.png', 'France', 'Marseille', 'Aéroport Marseille Provence', 13700, 20, 'formation'),
(43, 'Formation Colosseo', 'Salle de formation avec vidéo-projection', 'formation7.png', 'France', 'Paris', 'Tour Montparnasse', 75015, 20, 'formation'),
(44, 'Formation Iguazu', 'Amphithéatre de formation avec vidéo-projection', 'formation8.png', 'France', 'Lyon', '10 avenue de la République', 69001, 50, 'formation'),
(45, 'Formation Aya Sofia', 'Pour des formations dynamiques en petits groupes', 'formation9.png', 'France', 'Marseille', 'Aéroport Marseille Provence', 13700, 1, 'formation'),
(46, 'Formation Alhambra', 'salle de classe moderne, entièrement connectée', 'formation10.png', 'France', 'Paris', 'Tour Montparnasse', 75015, 20, 'formation'),
(47, 'Réunion Angkor', 'avec écrans, idéale pour les présentations', 'reunion1.png', 'France', 'Lyon', '10 avenue de la République', 69001, 10, 'reunion'),
(48, 'Réunion Corail', 'idéalement située dans l aéroport de Marseille', 'reunion2.png', 'France', 'Marseille', 'Aéroport Marseille Provence', 13700, 20, 'reunion');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id_avis`),
  ADD KEY `id_salle` (`id_salle`),
  ADD KEY `id_membre` (`id_membre`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_commande`),
  ADD KEY `id_membre` (`id_membre`),
  ADD KEY `id_produit` (`id_produit`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id_membre`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id_produit`),
  ADD KEY `id_salle` (`id_salle`);

--
-- Index pour la table `salle`
--
ALTER TABLE `salle`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `avis`
--
ALTER TABLE `avis`
  MODIFY `id_avis` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_commande` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id_membre` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id_produit` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `salle`
--
ALTER TABLE `salle`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `avis_ibfk_1` FOREIGN KEY (`id_salle`) REFERENCES `salle` (`id`),
  ADD CONSTRAINT `avis_ibfk_2` FOREIGN KEY (`id_membre`) REFERENCES `membre` (`id_membre`);

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`id_membre`) REFERENCES `membre` (`id_membre`),
  ADD CONSTRAINT `commande_ibfk_2` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id_produit`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`id_salle`) REFERENCES `salle` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
