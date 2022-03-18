-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 18 mars 2022 à 08:40
-- Version du serveur :  5.7.37
-- Version de PHP : 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `usalvage_usalva`
--

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

CREATE TABLE `admins` (
  `id` varchar(256) NOT NULL,
  `admin_second_name` varchar(30) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `admin_password` varchar(256) DEFAULT NULL,
  `record_date` date DEFAULT NULL,
  `record_time` time DEFAULT NULL,
  `last_modif_date` date DEFAULT NULL,
  `last_modif_time` time DEFAULT NULL,
  `validation_Status` tinyint(1) DEFAULT '0',
  `admin_status` tinyint(1) DEFAULT NULL,
  `admin_token` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`id`, `admin_second_name`, `email`, `admin_password`, `record_date`, `record_time`, `last_modif_date`, `last_modif_time`, `validation_Status`, `admin_status`, `admin_token`) VALUES
('4aFac60DcDe', 'Mbusa', 'usalvaget@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$ZGhnMEJLRGNydmRTaXlQRA$66yOYM+qd1n899aTeDauF81Qahvurfena3mqv+7nREc', '2022-02-15', '19:03:49', NULL, '00:00:01', 1, NULL, NULL),
('5dba4caB3B8', 'Amani Kambale', 'amanikambale1212@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$Rll2NTk1UTFWMjhXR3NXVA$uFcZjt2JpSF6544uvkC+h+ha91qIY5URoTWmaGEPozM', '2022-03-11', '14:06:38', NULL, NULL, 1, 0, NULL),
('9246aadc0b7', 'Amani', 'amaninyumu1@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$WWR2M1VnWkpKSjJxRGp5Vg$vp5y5wGTkrQQNFZvoNY6O+QxekdAcVJiyhRUuNrzEVk', '2021-12-19', '05:39:50', NULL, NULL, 1, NULL, NULL),
('klkSDikl90dfj', 'aggestor', 'aggestor@test.com', '$argon2i$v=19$m=65536,t=4,p=1$aE1HTGVCNlZ6R1lvR2tSVQ$U6EeU0eBGMSK2mJyiGi8jyukkmntsZ7C+CwQlce/cN8', NULL, NULL, NULL, NULL, 1, NULL, NULL);

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
  `destination` varchar(256) NOT NULL,
  `record_date` date NOT NULL,
  `record_time` time NOT NULL,
  `last_modif_date` date DEFAULT NULL,
  `last_modif_time` time DEFAULT NULL,
  `validated` tinyint(1) NOT NULL DEFAULT '0',
  `admin` varchar(11) DEFAULT NULL,
  `reference` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `validate_inscription` tinyint(4) DEFAULT '0',
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
('', 'bDbEdcBDd49', 250000, '2022-03-18', '17:24:35', 'Initialisation du systeme. BDD', '001', 1, '4aFac60DcDe', '2022-03-18', '14:24:35', NULL, NULL);

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
  `laval` int(11) DEFAULT '0',
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
  `user_status` tinyint(1) NOT NULL DEFAULT '0',
  `validation_Status` tinyint(1) NOT NULL DEFAULT '0',
  `locked` tinyint(1) NOT NULL DEFAULT '0',
  `record_date` date DEFAULT NULL,
  `record_time` time DEFAULT NULL,
  `last_modif_date` date DEFAULT NULL,
  `last_modif_time` time DEFAULT NULL,
  `parent` varchar(256) DEFAULT NULL,
  `images_name` varchar(256) DEFAULT NULL,
  `user_token` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `user_name`, `sponsor`, `email`, `phone`, `user_password`, `side`, `user_status`, `validation_Status`, `locked`, `record_date`, `record_time`, `last_modif_date`, `last_modif_time`, `parent`, `images_name`, `user_token`) VALUES
('bDbEdcBDd49', 'Usalvagetrade', NULL, 'usalvagetrade@gmail.com', '+243819953172', '$argon2i$v=19$m=65536,t=4,p=1$TEpYa0VGN1NOY1hPbXpCTg$O7WHEyMeECzhSTNsnecLJLCMLunMlYZCNbHFebtCEq0', NULL, 0, 1, 0, '2022-01-01', '10:00:00', NULL, NULL, NULL, 'Bbc2Dd155ab2AbcAa5ee\\user.png AND Bbc2Dd155ab2AbcAa5ee\\x320.png', '');

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
  ADD KEY `id_inscription` (`user_id`),
  ADD KEY `fk_cashout_admin_id` (`admin`);

--
-- Index pour la table `inscriptions`
--
ALTER TABLE `inscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `fk_inscriptions_admin_id` (`admin_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_sponsor` (`sponsor`),
  ADD KEY `fk_users_parent` (`parent`);

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
  ADD CONSTRAINT `fk_cashout_admin_id` FOREIGN KEY (`admin`) REFERENCES `admins` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cashout_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `inscriptions`
--
ALTER TABLE `inscriptions`
  ADD CONSTRAINT `fk_inscriptions_admin_id` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_inscriptions_users_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
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
  ADD CONSTRAINT `return_invest_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_parent` FOREIGN KEY (`parent`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_users_sponsor` FOREIGN KEY (`sponsor`) REFERENCES `users` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
