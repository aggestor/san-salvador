-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 16 jan. 2022 à 12:30
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 8.0.11

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
CREATE DATABASE IF NOT EXISTS usalva;
USE usalva;

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

CREATE TABLE `admins` (
  `id` varchar(256) NOT NULL,
  `admin_second_name` varchar(30) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `admin_password` varchar(256) NOT NULL,
  `record_date` date DEFAULT NULL,
  `record_time` time DEFAULT NULL,
  `last_modif_date` date DEFAULT NULL,
  `last_modif_time` time DEFAULT NULL,
  `validation_Status` tinyint(1) DEFAULT 0,
  `admin_status` tinyint(1) DEFAULT NULL,
  `admin_token` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`id`, `admin_second_name`, `email`, `admin_password`, `record_date`, `record_time`, `last_modif_date`, `last_modif_time`, `validation_Status`, `admin_status`, `admin_token`) VALUES
('9246aadc0b7', 'Amani', 'amaninyumu1@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$TWhyWVpSU0ZaUkR1dVd0Yw$FGbbfr54fcFpEYUUGGt+IVlmHVd1mt63OqFAzMJIytY', '2021-12-19', '05:39:50', NULL, NULL, 1, NULL, '');

-- --------------------------------------------------------

--
-- Structure de la table `binarys`
--

CREATE TABLE `binarys` (
  `id` varchar(256) NOT NULL,
  `user_id` varchar(256) NOT NULL,
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
  `user_id` varchar(256) NOT NULL,
  `amount` double NOT NULL,
  `record_date` date NOT NULL,
  `record_time` time NOT NULL,
  `last_modif_date` date DEFAULT NULL,
  `last_modif_time` time DEFAULT NULL,
  `validated` varchar(5) DEFAULT NULL,
  `admin` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `cashout`
--

INSERT INTO `cashout` (`id`, `user_id`, `amount`, `record_date`, `record_time`, `last_modif_date`, `last_modif_time`, `validated`, `admin`) VALUES
('7aA4BC6fc20', 'bDbEdcBDd49', 20, '2022-01-14', '21:46:02', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `inscriptions`
--

CREATE TABLE `inscriptions` (
  `id` varchar(256) NOT NULL,
  `user_id` varchar(256) NOT NULL,
  `amount` double NOT NULL,
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

--
-- Déchargement des données de la table `inscriptions`
--

INSERT INTO `inscriptions` (`id`, `user_id`, `amount`, `record_date`, `record_time`, `transaction_origin`, `transaction_code`, `validate_inscription`, `admin_id`, `confirmat_date`, `confirmate_time`, `last_modif_date`, `last_modif_time`) VALUES
('8A1BeeBd5cE', 'CabA831C4Bd', 100, '2022-01-06', '16:12:22', 'Bitcoin', 'Btc', 1, '9246aadc0b7', '2022-01-06', '16:44:42', NULL, NULL),
('aF3fe37Bc94', '842f4A38BF1', 120, '2022-01-06', '16:22:40', 'Bitcoin', 'Btc', 1, '9246aadc0b7', '2022-01-16', '11:38:10', NULL, NULL),
('Bd4bCcA0fCa', '12c544e4b8d', 150, '2022-01-06', '16:16:49', 'Bitcoin', 'Btc', 1, '9246aadc0b7', '2022-01-13', '23:12:42', NULL, NULL),
('E362Af20BEa', '8b1EFE2dFf0', 70, '2022-01-06', '16:08:16', 'Bitcoin', 'Btc', 1, '9246aadc0b7', '2022-01-06', '16:44:30', NULL, NULL),
('efD0BeF43d2', 'bDbEdcBDd49', 250000, '2022-01-06', '15:46:36', 'initialisation systeme', 'Usalvagetrade Capital', 1, NULL, NULL, NULL, NULL, NULL);

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
  `record_date` date DEFAULT NULL,
  `record_time` time DEFAULT NULL,
  `laval` int(11) DEFAULT 0,
  `last_modif_date` date DEFAULT NULL,
  `last_modif_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `packs`
--

INSERT INTO `packs` (`id`, `pack_name`, `pack_currency`, `mount_min`, `mount_max`, `pack_image`, `record_date`, `record_time`, `laval`, `last_modif_date`, `last_modif_time`) VALUES
('0BaBEdfaf23', 'Super Diamond', 2, 50000, 250000, 'B2D0A1e4CE5cBbdE5125\\Super-Diamond.png AND B2D0A1e4CE5cBbdE5125\\x320.png', '2022-01-06', '15:38:49', NULL, NULL, NULL),
('6E6DfA820B2', 'Gold', 1.5, 500, 4999, 'cDbeA401c4AadaBC4b12\\Gold.png AND cDbeA401c4AadaBC4b12\\x320.png', '2022-01-06', '15:36:24', NULL, NULL, NULL),
('AcD5C21e88E', 'Diamond', 1.75, 5000, 49999, 'AEb0aCDea525DeBC3B5a\\Diamond.png AND AEb0aCDea525DeBC3B5a\\x320.png', '2022-01-06', '15:33:44', NULL, NULL, NULL),
('CB25976cF9A', 'Silver', 1, 50, 499, 'AdeBCe50DCB05ed2E323\\Silver.png AND AdeBCe50DCB05ed2E323\\x320.png', '2022-01-06', '15:30:34', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `parenages`
--

CREATE TABLE `parenages` (
  `id` varchar(256) NOT NULL,
  `user_id` varchar(256) NOT NULL,
  `id_sponsored_inscription` varchar(256) DEFAULT NULL,
  `amount` double NOT NULL,
  `record_date` date NOT NULL,
  `record_time` time NOT NULL,
  `last_modif_date` date DEFAULT NULL,
  `last_modif_time` time DEFAULT NULL,
  `surplus` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `parenages`
--

INSERT INTO `parenages` (`id`, `user_id`, `id_sponsored_inscription`, `amount`, `record_date`, `record_time`, `last_modif_date`, `last_modif_time`, `surplus`) VALUES
('4c1o3s59onq', 'bDbEdcBDd49', 'Bd4bCcA0fCa', 15, '2022-01-13', '23:12:42', NULL, NULL, 0),
('7kegrsbb2rh', 'bDbEdcBDd49', 'aF3fe37Bc94', 12, '2022-01-16', '11:38:10', NULL, NULL, 0),
('k6sjljjbgcg', 'bDbEdcBDd49', '8A1BeeBd5cE', 10, '2022-01-06', '16:44:42', NULL, NULL, 0),
('mk2e97k1l1s', 'bDbEdcBDd49', 'E362Af20BEa', 7, '2022-01-06', '16:44:30', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `return_invest`
--

CREATE TABLE `return_invest` (
  `id` varchar(256) NOT NULL,
  `user_id` varchar(256) NOT NULL,
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
  `sponsor` varchar(256) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(14) DEFAULT NULL,
  `user_password` varchar(256) NOT NULL,
  `side` varchar(20) DEFAULT NULL,
  `user_status` tinyint(1) NOT NULL DEFAULT 0,
  `validation_Status` tinyint(1) NOT NULL DEFAULT 0,
  `locked` tinyint(1) NOT NULL DEFAULT 0,
  `record_date` date DEFAULT NULL,
  `record_time` time DEFAULT NULL,
  `last_modif_date` date DEFAULT NULL,
  `last_modif_time` time DEFAULT NULL,
  `parent` varchar(256) DEFAULT NULL,
  `images_name` varchar(256) DEFAULT NULL,
  `user_token` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `user_name`, `sponsor`, `email`, `phone`, `user_password`, `side`, `user_status`, `validation_Status`, `locked`, `record_date`, `record_time`, `last_modif_date`, `last_modif_time`, `parent`, `images_name`, `user_token`) VALUES
('12c544e4b8d', 'Aggee Stor', '8b1EFE2dFf0', 'aggeer@gmail.com', '0993825243', '$argon2i$v=19$m=65536,t=4,p=1$TEpySkI0alJwbXl2YWhWcw$t/b+GsBRB/39mBWebYt2Fvvqad47IdN5JDwIe0i797c', '2', 0, 1, 0, '2022-01-06', '16:15:56', NULL, NULL, 'bDbEdcBDd49', 'Bbc2Dd155ab2AbcAa5ee\\user.png AND Bbc2Dd155ab2AbcAa5ee\\x320.png', ''),
('842f4A38BF1', 'Serge Makasi', '8b1EFE2dFf0', 'sergemakasi@gmail.com', '0994603189', '$argon2i$v=19$m=65536,t=4,p=1$SGw3MVovRDgxWThrWkFlQQ$Dk4dwWhZ40RU319HrpKTvAbOY2Ww5MEnozx6VJmPiYE', '1', 0, 1, 0, '2022-01-06', '16:20:41', NULL, NULL, 'bDbEdcBDd49', '13C2c34C2DCe35BEaCAe\\user.png AND 13C2c34C2DCe35BEaCAe\\x320.png', ''),
('8b1EFE2dFf0', 'Amani Nyumu', 'bDbEdcBDd49', 'amaninyumu1@gmail.com', '0997257938', '$argon2i$v=19$m=65536,t=4,p=1$RkYvclFDWnFNZ3IwM0xtRA$k6QrB2CBoxC5UTJYHhzi5vuJBlKyjRIhEarbSa9fh0s', '2', 0, 1, 0, '2022-01-06', '16:05:29', NULL, NULL, 'bDbEdcBDd49', '0dc152bB4DC2AaA3DAdA\\user.png AND 0dc152bB4DC2AaA3DAdA\\x320.png', ''),
('bDbEdcBDd49', 'Usalvagetrade', NULL, 'usalvagetrade@gmail.com', '+243819953172', '$argon2i$v=19$m=65536,t=4,p=1$TEpYa0VGN1NOY1hPbXpCTg$O7WHEyMeECzhSTNsnecLJLCMLunMlYZCNbHFebtCEq0', NULL, 0, 1, 0, '2022-01-01', '10:00:00', NULL, NULL, NULL, 'Bbc2Dd155ab2AbcAa5ee\\user.png AND Bbc2Dd155ab2AbcAa5ee\\x320.png', ''),
('CabA831C4Bd', 'Esaie Muhasa', 'bDbEdcBDd49', 'esaiemuhasa@gmail.com', '0972762881', '$argon2i$v=19$m=65536,t=4,p=1$aFFjNDdaUlJkQU4wTzlrUw$XtE5/PUWmvqeZzv0ASjX+k1Z0gjc4VN32U4WweF3WgA', '1', 0, 1, 0, '2022-01-06', '16:11:14', NULL, NULL, 'bDbEdcBDd49', '1bEe325EecC4a5114cED\\user.png AND 1bEe325EecC4a5114cED\\x320.png', '');

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
  ADD KEY `id_inscription` (`user_id`);

--
-- Index pour la table `cashout`
--
ALTER TABLE `cashout`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_inscription` (`user_id`);

--
-- Index pour la table `inscriptions`
--
ALTER TABLE `inscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `packs`
--
ALTER TABLE `packs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `parenages`
--
ALTER TABLE `parenages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_inscription` (`user_id`);

--
-- Index pour la table `return_invest`
--
ALTER TABLE `return_invest`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_inscription` (`user_id`);

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
  ADD CONSTRAINT `binarys_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `cashout`
--
ALTER TABLE `cashout`
  ADD CONSTRAINT `cashout_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `inscriptions`
--
ALTER TABLE `inscriptions`
  ADD CONSTRAINT `inscriptions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `parenages`
--
ALTER TABLE `parenages`
  ADD CONSTRAINT `parenages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `return_invest`
--
ALTER TABLE `return_invest`
  ADD CONSTRAINT `return_invest_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
