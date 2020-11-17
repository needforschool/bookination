-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 17 nov. 2020 à 11:04
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bookination`
--

-- --------------------------------------------------------

--
-- Structure de la table `bn_contact`
--

CREATE TABLE `bn_contact` (
  `id` int(11) NOT NULL,
  `mail` varchar(160) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `bn_reminders`
--

CREATE TABLE `bn_reminders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vaccine_id` int(11) NOT NULL,
  `last_injection` date NOT NULL,
  `reminder` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `bn_users`
--

CREATE TABLE `bn_users` (
  `id` int(11) NOT NULL,
  `mail` varchar(160) NOT NULL,
  `password` varchar(250) NOT NULL,
  `token` varchar(255) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `birthdate` date NOT NULL,
  `gender` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `bn_vaccines`
--

CREATE TABLE `bn_vaccines` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mandatory` tinyint(1) NOT NULL,
  `frequency` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bn_vaccines`
--

INSERT INTO `bn_vaccines` (`id`, `name`, `mandatory`, `frequency`, `created_at`, `updated_at`) VALUES
(1, 'Le Tétanos', 1, 'Obligatoire dès la naissance. Les rappels de l\\\'adulte sont recommandés à âges fixes (25, 45, 65 ans…)', '2020-11-17 10:01:21', '2020-11-17 10:27:56'),
(2, 'Le Zona', 1, 'Recommandée chez les personnes âgées de 65 à 74 ans inclus', '2018-11-17 10:30:40', '2020-11-17 10:30:40'),
(3, 'La Grippe', 0, 'Recommandée chaque année pour les personnes à risques y compris les enfants à partir de 6 mois, les femmes enceintes et les personnes âgées de 65 ans et plus', '2018-11-17 10:30:40', '2020-11-17 10:30:40'),
(4, 'Le Choléra', 0, 'Le personnel humanitaire peut être exposé dans les zones sinistrées et les camps de réfugiés. Notamment en Afrique, Moyen-Orient , Amérique Centrale et en Asie\r\n', '2018-11-17 10:01:21', '2020-11-17 10:44:56'),
(5, 'La Fièvre jaune', 0, 'En France, la vaccination contre la fièvre jaune est obligatoire chez les enfants de plus de 12 mois et les adultes voyageant ou résidant en Guyane', '2018-11-17 10:44:56', '2020-11-17 10:44:56'),
(6, 'La Rage ', 0, 'La vaccination de pré-exposition doit être proposée aux sujets ayant un risque élevé de contamination par le virus de la rage', '2018-11-17 10:01:21', '2020-11-17 10:48:36'),
(7, 'La Rougeole', 1, 'Recommandée à l\\\'âge de 12 mois avec une 2e dose entre 16 et 18 mois', '2018-11-17 10:01:21', '2020-11-17 10:48:36'),
(8, 'La Poliomyélite', 1, 'La vaccination contre la poliomyélite s’adresse à tous, enfants et adultes tout au long de la vie. Elle permet d’éviter la maladie et ses complications', '2018-11-17 10:01:21', '2020-11-17 10:58:32'),
(9, 'Le Papillomavirus Humains ', 0, 'Recommandée chez les jeunes filles de 11 à 14 ans avec un rattrapage jusqu\\\'à 19 inclus', '2018-11-17 10:01:21', '2020-11-17 10:52:49'),
(10, 'La Coqueluche ', 1, 'Recommandée à l\\\'âge de 2 mois ainsi qu\\\'à l\\\'entourage du nourrisson si leur dernier rappel de la coqueluche date de plus de 10 ans', '2020-11-17 10:56:30', '2020-11-17 10:56:30');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bn_contact`
--
ALTER TABLE `bn_contact`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `bn_reminders`
--
ALTER TABLE `bn_reminders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reminder_user_id` (`user_id`),
  ADD KEY `reminder_vaccines_id` (`vaccine_id`);

--
-- Index pour la table `bn_users`
--
ALTER TABLE `bn_users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `bn_vaccines`
--
ALTER TABLE `bn_vaccines`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bn_contact`
--
ALTER TABLE `bn_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `bn_reminders`
--
ALTER TABLE `bn_reminders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `bn_users`
--
ALTER TABLE `bn_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `bn_vaccines`
--
ALTER TABLE `bn_vaccines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `bn_reminders`
--
ALTER TABLE `bn_reminders`
  ADD CONSTRAINT `reminder_user_id` FOREIGN KEY (`user_id`) REFERENCES `bn_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reminder_vaccines_id` FOREIGN KEY (`vaccine_id`) REFERENCES `bn_vaccines` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
