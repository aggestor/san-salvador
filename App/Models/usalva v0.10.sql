-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 08 déc. 2021 à 11:14
-- Version du serveur :  10.4.18-MariaDB
-- Version de PHP : 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `usalva`
--
CREATE DATABASE IF NOT EXISTS `usalva` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `usalva`;

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

CREATE TABLE `admins` (
  `id` varchar(256) NOT NULL,
  `admin_second_name` varchar(30) DEFAULT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_password` varchar(256) NOT NULL,
  `record_date` date DEFAULT NULL,
  `record_time` time DEFAULT NULL,
  `last_modif_date` date DEFAULT NULL,
  `last_modif_time` time DEFAULT NULL,
  `validation_Status` tinyint(1) DEFAULT 0,
  `admin_status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `binarys`
--

CREATE TABLE `binarys` (
  `id` varchar(256) NOT NULL,
  `id_inscription` varchar(256) NOT NULL,
  `id_sponsored_inscription` varchar(256) DEFAULT NULL,
  `amount` double NOT NULL,
  `record_date` date NOT NULL,
  `record_time` time NOT NULL,
  `last_modif_date` date DEFAULT NULL,
  `last_modif_time` time DEFAULT NULL,
  `surplus` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `cashout`
--

CREATE TABLE `cashout` (
  `id` varchar(256) NOT NULL,
  `id_inscription` varchar(256) NOT NULL,
  `amount` double NOT NULL,
  `record_date` date NOT NULL,
  `record_time` time NOT NULL,
  `last_modif_date` date DEFAULT NULL,
  `last_modif_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `inscriptions`
--

CREATE TABLE `inscriptions` (
  `id` varchar(256) NOT NULL,
  `user_id` varchar(256) NOT NULL,
  `pack_id` varchar(256) NOT NULL,
  `amount` double NOT NULL,
  `state` tinyint(4) NOT NULL DEFAULT 0,
  `record_date` date NOT NULL,
  `record_time` time NOT NULL,
  `transaction_origin` varchar(100) DEFAULT NULL,
  `transaction_code` varchar(256) DEFAULT NULL,
  `validate_inscription` tinyint(4) DEFAULT 0,
  `admin_id` varchar(256) DEFAULT NULL,
  `confirmat_date` date DEFAULT NULL,
  `confirmate_time` time DEFAULT NULL,
  `last_modif_date` date DEFAULT NULL,
  `last_modif_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `packs`
--

CREATE TABLE `packs` (
  `id` varchar(256) NOT NULL,
  `pack_name` varchar(100) NOT NULL,
  `pack_currency` double DEFAULT NULL,
  `mount_min` double NOT NULL,
  `mount_max` double NOT NULL,
  `pack_image` varchar(200) DEFAULT NULL,
  `admin_id` varchar(256) NOT NULL,
  `record_date` date DEFAULT NULL,
  `record_time` time DEFAULT NULL,
  `laval` int(11) DEFAULT NULL,
  `last_modif_date` date DEFAULT NULL,
  `last_modif_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `parenages`
--

CREATE TABLE `parenages` (
  `id` varchar(256) NOT NULL,
  `id_inscription` varchar(256) NOT NULL,
  `id_sponsored_inscription` varchar(256) DEFAULT NULL,
  `amount` double NOT NULL,
  `record_date` date NOT NULL,
  `record_time` time NOT NULL,
  `last_modif_date` date DEFAULT NULL,
  `last_modif_time` time DEFAULT NULL,
  `surplus` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `return_invest`
--

CREATE TABLE `return_invest` (
  `id` varchar(256) NOT NULL,
  `id_inscription` varchar(256) NOT NULL,
  `amount` double NOT NULL,
  `record_date` date NOT NULL,
  `record_time` time NOT NULL,
  `last_modif_date` date DEFAULT NULL,
  `last_modif_time` time DEFAULT NULL,
  `surplus` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` varchar(256) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `sponsor` varchar(256) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(14) DEFAULT NULL,
  `user_password` varchar(256) NOT NULL,
  `side` varchar(20) NOT NULL,
  `user_status` tinyint(1) NOT NULL DEFAULT 0,
  `validation_Status` tinyint(1) NOT NULL DEFAULT 0,
  `record_date` date DEFAULT NULL,
  `record_time` time DEFAULT NULL,
  `last_modif_date` date DEFAULT NULL,
  `last_modif_time` time DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  `images_name` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `user_name`, `sponsor`, `email`, `phone`, `user_password`, `side`, `user_status`, `validation_Status`, `record_date`, `record_time`, `last_modif_date`, `last_modif_time`, `parent`, `images_name`) VALUES
('2aa54bcb-f7ba-4735-9a83-a641e49c3b39', 'serge1', 'usalavatrade', 'serge1@gmail.com', '0994603188', '$argon2i$v=19$m=65536,t=4,p=1$SjV0dWpSaml5VGR0ZXZ6NQ$y9Sv8RcCx91fN4xmMInK3ED7DWuexmYXZOR6rPV6iTc', 'left', 0, 0, '2012-01-01', '00:00:00', NULL, NULL, NULL, NULL),
('46d828c8-faf3-4750-a9ec-ee30ed2ebc30', 'makasi', 'usalavatrade', 'makasi@gmail.com', '0997285710', '$argon2i$v=19$m=65536,t=4,p=1$aFBKc1hUV1ZWQTB1U2d6cQ$Z/1kM9I84eEpGbuAv/oiIzAjb4L3GgUaqfdKcqTiQnc', 'left', 0, 0, '0000-00-00', '00:00:00', NULL, NULL, NULL, NULL),
('dskdhjkhjkhsjfhj', 'serge1', 'usalavatrade', 'serge1@gmail.com', '0994603188', '8cb2237d0679ca88db6464eac60da96345513964', 'left', 0, 0, '0000-00-00', '00:00:00', NULL, NULL, NULL, NULL),
('dskdhsjfhj', 'serge', 'usalavatrade', 'serge@gmail.com', '0994603189', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'left', 0, 0, '0000-00-00', '00:00:00', NULL, NULL, NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `binarys`
--
ALTER TABLE `binarys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_inscription` (`id_inscription`);

--
-- Index pour la table `cashout`
--
ALTER TABLE `cashout`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_inscription` (`id_inscription`);

--
-- Index pour la table `inscriptions`
--
ALTER TABLE `inscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `pack_id` (`pack_id`);

--
-- Index pour la table `packs`
--
ALTER TABLE `packs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Index pour la table `parenages`
--
ALTER TABLE `parenages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_inscription` (`id_inscription`);

--
-- Index pour la table `return_invest`
--
ALTER TABLE `return_invest`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_inscription` (`id_inscription`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `binarys`
--
ALTER TABLE `binarys`
  ADD CONSTRAINT `binarys_ibfk_1` FOREIGN KEY (`id_inscription`) REFERENCES `inscriptions` (`id`);

--
-- Contraintes pour la table `cashout`
--
ALTER TABLE `cashout`
  ADD CONSTRAINT `cashout_ibfk_1` FOREIGN KEY (`id_inscription`) REFERENCES `inscriptions` (`id`);

--
-- Contraintes pour la table `inscriptions`
--
ALTER TABLE `inscriptions`
  ADD CONSTRAINT `inscriptions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `inscriptions_ibfk_2` FOREIGN KEY (`pack_id`) REFERENCES `packs` (`id`);

--
-- Contraintes pour la table `packs`
--
ALTER TABLE `packs`
  ADD CONSTRAINT `packs_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`);

--
-- Contraintes pour la table `parenages`
--
ALTER TABLE `parenages`
  ADD CONSTRAINT `parenages_ibfk_1` FOREIGN KEY (`id_inscription`) REFERENCES `inscriptions` (`id`);

--
-- Contraintes pour la table `return_invest`
--
ALTER TABLE `return_invest`
  ADD CONSTRAINT `return_invest_ibfk_1` FOREIGN KEY (`id_inscription`) REFERENCES `inscriptions` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
