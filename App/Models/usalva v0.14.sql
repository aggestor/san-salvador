-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 10 mars 2022 à 12:38
-- Version du serveur :  8.0.21
-- Version de PHP : 7.4.9

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

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` varchar(256) NOT NULL,
  `admin_second_name` varchar(30) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `admin_password` varchar(256) NOT NULL,
  `record_date` date DEFAULT NULL,
  `record_time` time DEFAULT NULL,
  `last_modif_date` date DEFAULT NULL,
  `last_modif_time` time DEFAULT NULL,
  `validation_Status` tinyint(1) DEFAULT '0',
  `admin_status` tinyint(1) DEFAULT NULL,
  `admin_token` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`id`, `admin_second_name`, `email`, `admin_password`, `record_date`, `record_time`, `last_modif_date`, `last_modif_time`, `validation_Status`, `admin_status`, `admin_token`) VALUES
('4aFac60DcDe', 'Mbusa', 'usalvaget@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$TXl0UDA0OEd3bnk4OWlmaA$+2PdqEBGMI4PxhOCqU/VV2QaaH8kSWzXrGSmj6hR4e8', '2022-02-15', '19:03:49', NULL, '00:00:01', 0, NULL, NULL),
('9246aadc0b7', 'Amani', 'amaninyumu1@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$WWR2M1VnWkpKSjJxRGp5Vg$vp5y5wGTkrQQNFZvoNY6O+QxekdAcVJiyhRUuNrzEVk', '2021-12-19', '05:39:50', NULL, NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `binarys`
--

DROP TABLE IF EXISTS `binarys`;
CREATE TABLE IF NOT EXISTS `binarys` (
  `id` varchar(256) NOT NULL,
  `user_id` varchar(256) NOT NULL,
  `id_sponsored_inscription` varchar(256) DEFAULT NULL,
  `amount` double NOT NULL,
  `record_date` date NOT NULL,
  `record_time` time NOT NULL,
  `last_modif_date` date DEFAULT NULL,
  `last_modif_time` time DEFAULT NULL,
  `surplus` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_inscription` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `binarys`
--

INSERT INTO `binarys` (`id`, `user_id`, `id_sponsored_inscription`, `amount`, `record_date`, `record_time`, `last_modif_date`, `last_modif_time`, `surplus`) VALUES
('0codqlt8t8e', '6Ba2bF9fc2f', 'F3ceFefF017', 10, '2022-03-04', '10:44:27', NULL, NULL, 0),
('1c1il2d9scj', '473B813ea30', 'F3ceFefF017', 10, '2022-03-04', '10:44:27', NULL, NULL, 0),
('bfmcpedn72l', '6Ba2bF9fc2f', 'A8c3eAEb562', 10, '2022-03-04', '12:26:18', NULL, NULL, 0),
('dqjik3d1pc7', 'e406ade08aD', 'A8c3eAEb562', 10, '2022-03-04', '12:26:18', NULL, NULL, 0),
('jnqj0km39no', '8b1EFE2dFf0', 'aEb0d8e768c', 7.2, '2022-03-10', '12:12:47', NULL, NULL, 192.8),
('l91q1m0e81t', '842f4A38BF1', 'aEb0d8e768c', 200, '2022-03-10', '12:12:47', NULL, NULL, 0),
('l9s5omqg404', '473B813ea30', 'A8c3eAEb562', 10, '2022-03-04', '12:26:18', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `cashout`
--

DROP TABLE IF EXISTS `cashout`;
CREATE TABLE IF NOT EXISTS `cashout` (
  `id` varchar(256) NOT NULL,
  `user_id` varchar(256) NOT NULL,
  `amount` double NOT NULL,
  `destination` varchar(256) NOT NULL,
  `record_date` date NOT NULL,
  `record_time` time NOT NULL,
  `last_modif_date` date DEFAULT NULL,
  `last_modif_time` time DEFAULT NULL,
  `validated` varchar(5) DEFAULT NULL,
  `admin` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_inscription` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `cashout`
--

INSERT INTO `cashout` (`id`, `user_id`, `amount`, `destination`, `record_date`, `record_time`, `last_modif_date`, `last_modif_time`, `validated`, `admin`) VALUES
('7aA4BC6fc20', 'bDbEdcBDd49', 20, '', '2022-01-14', '21:46:02', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `inscriptions`
--

DROP TABLE IF EXISTS `inscriptions`;
CREATE TABLE IF NOT EXISTS `inscriptions` (
  `id` varchar(256) NOT NULL,
  `user_id` varchar(256) NOT NULL,
  `amount` double NOT NULL,
  `record_date` date NOT NULL,
  `record_time` time NOT NULL,
  `transaction_origin` varchar(100) DEFAULT NULL,
  `transaction_code` varchar(256) DEFAULT NULL,
  `validate_inscription` tinyint DEFAULT '0',
  `admin_id` varchar(256) DEFAULT NULL,
  `confirmat_date` date DEFAULT NULL,
  `confirmate_time` time DEFAULT NULL,
  `last_modif_date` date DEFAULT NULL,
  `last_modif_time` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `inscriptions`
--

INSERT INTO `inscriptions` (`id`, `user_id`, `amount`, `record_date`, `record_time`, `transaction_origin`, `transaction_code`, `validate_inscription`, `admin_id`, `confirmat_date`, `confirmate_time`, `last_modif_date`, `last_modif_time`) VALUES
('123BEdCeA27', '8e1bF982CeA', 10000, '2022-02-15', '20:26:37', 'BTC', 'Trasaction BTC 56GTK BT ', 1, '9246aadc0b7', '2022-02-15', '20:27:06', NULL, NULL),
('15Afdc7e23b', 'B2AEB6c6FfE', 2000, '2022-03-10', '11:28:31', 'AirtelMoney', 'Transaction ID 43588 Aitel-Money4', 0, NULL, NULL, NULL, NULL, NULL),
('277B169a5fA', '473B813ea30', 15000, '2022-02-15', '21:00:19', 'AirtelMoney', 'Transaction ID 53888 Aitel-Money', 1, '9246aadc0b7', '2022-02-15', '21:00:48', NULL, NULL),
('2F3012ffAc1', 'EC2F56aAB44', 100, '2022-03-03', '17:10:29', 'BTC', 'Dhxxkkkbb', 1, '4aFac60DcDe', '2022-03-03', '17:11:00', NULL, NULL),
('3612D3ABA3B', '41FabD6FCeA', 4000, '2022-03-04', '08:30:36', 'AirtelMoney', 'Transfert ID machin machin...', 1, '9246aadc0b7', '2022-03-04', '08:33:52', NULL, NULL),
('39d15A0da6b', 'e8B456fFeB1', 200, '2022-01-21', '14:49:57', 'Btc', 'Btc', 1, '9246aadc0b7', '2022-02-03', '05:26:17', NULL, NULL),
('3aB5376dfbD', 'ccf2F64c9E9', 450, '2022-02-21', '19:17:24', 'AirtelMoney', 'Lddizojrbr', 1, '4aFac60DcDe', '2022-02-21', '19:18:48', NULL, NULL),
('4c1EfBad6aA', '6Ba2bF9fc2f', 500, '2022-03-04', '09:59:52', 'AirtelMoney', 'Transfert ID 234567H machin machin...', 1, '9246aadc0b7', '2022-03-04', '10:01:03', NULL, NULL),
('4eca17fAEEf', 'f76b98b816E', 100, '2022-02-09', '20:30:22', 'AirtelMoney', 'Ldbsjqkbdn', 1, '4aFac60DcDe', '2022-02-15', '18:15:26', NULL, NULL),
('8A1BeeBd5cE', 'CabA831C4Bd', 100, '2022-01-06', '16:12:22', 'Bitcoin', 'Btc', 1, '9246aadc0b7', '2022-01-06', '16:44:42', NULL, NULL),
('907D1E7d245', '1Fd4AfaC951', 2000, '2022-02-22', '17:10:43', 'BTC', 'Jdjduoakdodjdv', 1, '4aFac60DcDe', '2022-02-22', '17:11:21', NULL, NULL),
('94c77103Bfa', '7fa61Add2Ce', 500, '2022-03-04', '09:29:22', 'AirtelMoney', 'Transfert ID 234967H machin machin...', 1, '9246aadc0b7', '2022-03-04', '09:30:00', NULL, NULL),
('9a46DB69bcd', 'e406ade08aD', 2000, '2022-02-15', '20:05:33', 'AirtelMoney', 'Transaction ID 43588 Aitel-Money', 1, '9246aadc0b7', '2022-02-15', '20:06:23', NULL, NULL),
('A8c3eAEb562', '7b3d1dc4580', 100, '2022-03-04', '11:19:33', 'AirtelMoney', 'Transfert ID 238643567H machin machin...', 1, '9246aadc0b7', '2022-03-04', '12:26:18', NULL, NULL),
('a99CCfc94a1', '92c2ba8DCEF', 500, '2022-03-03', '17:18:10', 'BTC', 'JwjkLHwlL', 1, '4aFac60DcDe', '2022-03-03', '17:18:36', NULL, NULL),
('aEb0d8e768c', 'EDFd3E2CEb5', 2000, '2022-03-10', '10:13:59', 'AirtelMoney', 'Transfert ID 234567H machin machin...', 1, '9246aadc0b7', '2022-03-10', '12:12:47', NULL, NULL),
('aF3fe37Bc94', '842f4A38BF1', 120, '2022-01-06', '16:22:40', 'Bitcoin', 'Btc', 1, '9246aadc0b7', '2022-01-16', '11:38:10', NULL, NULL),
('aFcFEeE3B80', '0C1efd0B5A3', 50, '2022-02-15', '18:57:23', 'AirtelMoney', 'Iehdkslnddb', 1, '4aFac60DcDe', '2022-02-21', '18:26:26', NULL, NULL),
('b81f300edA4', '0160BDE0713', 100, '2022-02-09', '20:08:21', 'BTC', '74435690c0a452b6ff4eb1240bf0d4735070a9a33f65271ee17b4a7f7bd793e5', 1, '9246aadc0b7', '2022-02-15', '19:10:06', NULL, NULL),
('Bd4bCcA0fCa', '12c544e4b8d', 150, '2022-01-06', '16:16:49', 'Bitcoin', 'Btc', 1, '9246aadc0b7', '2022-01-13', '23:12:42', NULL, NULL),
('dA4D9d3b64E', 'CF766fd1C3C', 3000, '2022-03-03', '17:24:29', 'AirtelMoney', 'Shi3gj67jk', 1, '4aFac60DcDe', '2022-03-03', '17:24:52', NULL, NULL),
('Df8052a64De', 'effbE0Baec9', 300, '2022-03-03', '10:05:35', 'AirtelMoney', 'ID Airtel Money 0990135518', 1, '9246aadc0b7', '2022-03-03', '10:09:54', NULL, NULL),
('E362Af20BEa', '8b1EFE2dFf0', 70, '2022-01-06', '16:08:16', 'Bitcoin', 'Btc', 1, '9246aadc0b7', '2022-01-06', '16:44:30', NULL, NULL),
('EC5F5fF59A2', 'dCBaFcFEC5f', 500, '2022-02-21', '18:39:56', 'BTC', 'Shutkydjiitf', 1, '4aFac60DcDe', '2022-02-21', '18:54:19', NULL, NULL),
('efD0BeF43d2', 'bDbEdcBDd49', 250000, '2022-01-06', '15:46:36', 'initialisation systeme', 'Usalvagetrade Capital', 1, NULL, NULL, NULL, NULL, NULL),
('F3ceFefF017', '0F5c5ed2DfA', 100, '2022-03-04', '10:09:53', 'AirtelMoney', 'Transfert ID 234562H machin machin...', 1, '9246aadc0b7', '2022-03-04', '10:44:27', NULL, NULL),
('Fcaa0D8cA4F', '3Df0615d0ca', 4000, '2022-03-04', '08:45:01', 'AirtelMoney', 'Transfert ID 234567H machin machin...', 1, '9246aadc0b7', '2022-03-04', '08:45:12', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `packs`
--

DROP TABLE IF EXISTS `packs`;
CREATE TABLE IF NOT EXISTS `packs` (
  `id` varchar(256) NOT NULL,
  `pack_name` varchar(100) NOT NULL,
  `pack_currency` double DEFAULT NULL,
  `mount_min` double NOT NULL,
  `mount_max` double NOT NULL,
  `pack_image` varchar(200) DEFAULT NULL,
  `record_date` date DEFAULT NULL,
  `record_time` time DEFAULT NULL,
  `laval` int DEFAULT '0',
  `last_modif_date` date DEFAULT NULL,
  `last_modif_time` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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

DROP TABLE IF EXISTS `parenages`;
CREATE TABLE IF NOT EXISTS `parenages` (
  `id` varchar(256) NOT NULL,
  `user_id` varchar(256) NOT NULL,
  `id_sponsored_inscription` varchar(256) DEFAULT NULL,
  `amount` double NOT NULL,
  `record_date` date NOT NULL,
  `record_time` time NOT NULL,
  `last_modif_date` date DEFAULT NULL,
  `last_modif_time` time DEFAULT NULL,
  `surplus` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_inscription` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `parenages`
--

INSERT INTO `parenages` (`id`, `user_id`, `id_sponsored_inscription`, `amount`, `record_date`, `record_time`, `last_modif_date`, `last_modif_time`, `surplus`) VALUES
('0d1rfi338sd', 'bDbEdcBDd49', '4eca17fAEEf', 10, '2022-02-15', '18:15:26', NULL, NULL, 0),
('0q3cmn67o5s', 'f76b98b816E', '907D1E7d245', 200, '2022-02-22', '17:11:21', NULL, NULL, 0),
('0qlkcchpf04', 'f76b98b816E', 'EC5F5fF59A2', 50, '2022-02-21', '18:54:19', NULL, NULL, 0),
('22b8t4edd03', 'bDbEdcBDd49', 'Df8052a64De', 30, '2022-03-03', '10:09:54', NULL, NULL, 0),
('4c1o3s59onq', 'bDbEdcBDd49', 'Bd4bCcA0fCa', 15, '2022-01-13', '23:12:42', NULL, NULL, 0),
('5cr4eirgqes', 'EC2F56aAB44', 'dA4D9d3b64E', 250, '2022-03-03', '17:24:52', NULL, NULL, 50),
('5r2tqj515pn', 'e406ade08aD', '94c77103Bfa', 50, '2022-03-04', '09:30:00', NULL, NULL, 0),
('7kegrsbb2rh', 'bDbEdcBDd49', 'aF3fe37Bc94', 12, '2022-01-16', '11:38:10', NULL, NULL, 0),
('7kknjgohqko', 'f76b98b816E', '3aB5376dfbD', 45, '2022-02-21', '19:18:48', NULL, NULL, 0),
('8miee78cnm5', 'EC2F56aAB44', 'a99CCfc94a1', 50, '2022-03-03', '17:18:36', NULL, NULL, 0),
('egt4oblq1s4', 'f76b98b816E', 'aFcFEeE3B80', 5, '2022-02-21', '18:26:26', NULL, NULL, 0),
('gm14i9s7odr', 'e406ade08aD', 'Fcaa0D8cA4F', 400, '2022-03-04', '08:45:12', NULL, NULL, 0),
('h936tloop95', 'bDbEdcBDd49', '9a46DB69bcd', 200, '2022-02-15', '20:06:23', NULL, NULL, 0),
('hikpgt06qmg', 'e406ade08aD', '3612D3ABA3B', 400, '2022-03-04', '08:33:52', NULL, NULL, 0),
('i5jqj6s1t1f', 'e406ade08aD', 'A8c3eAEb562', 10, '2022-03-04', '11:28:08', NULL, NULL, 0),
('k4bigm1rb06', 'e406ade08aD', '277B169a5fA', 1500, '2022-02-15', '21:00:48', NULL, NULL, 0),
('k6sjljjbgcg', 'bDbEdcBDd49', '8A1BeeBd5cE', 10, '2022-01-06', '16:44:42', NULL, NULL, 0),
('kng7rqd13lo', 'bDbEdcBDd49', 'b81f300edA4', 10, '2022-02-15', '19:10:06', NULL, NULL, 0),
('l6d9ocmnqk2', 'e406ade08aD', '123BEdCeA27', 1000, '2022-02-15', '20:27:06', NULL, NULL, 0),
('mk2e97k1l1s', 'bDbEdcBDd49', 'E362Af20BEa', 7, '2022-01-06', '16:44:30', NULL, NULL, 0),
('n85fkqlhh0i', 'bDbEdcBDd49', '39d15A0da6b', 20, '2022-02-03', '05:26:17', NULL, NULL, 0),
('p3gbqelk0q1', 'e406ade08aD', 'A8c3eAEb562', 10, '2022-03-04', '12:26:18', NULL, NULL, 0),
('p73ojht2t6g', 'e406ade08aD', '4c1EfBad6aA', 50, '2022-03-04', '10:01:03', NULL, NULL, 0),
('q6qr66r8qrq', 'f76b98b816E', '2F3012ffAc1', 0, '2022-03-03', '17:11:00', NULL, NULL, 10),
('qet4npc614q', '8b1EFE2dFf0', 'aEb0d8e768c', 200, '2022-03-10', '12:12:47', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `return_invest`
--

DROP TABLE IF EXISTS `return_invest`;
CREATE TABLE IF NOT EXISTS `return_invest` (
  `id` varchar(256) NOT NULL,
  `user_id` varchar(256) NOT NULL,
  `amount` double NOT NULL,
  `record_date` date NOT NULL,
  `record_time` time NOT NULL,
  `last_modif_date` date DEFAULT NULL,
  `last_modif_time` time DEFAULT NULL,
  `surplus` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_inscription` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `return_invest`
--

INSERT INTO `return_invest` (`id`, `user_id`, `amount`, `record_date`, `record_time`, `last_modif_date`, `last_modif_time`, `surplus`) VALUES
('02kqsgbp1er', '1Fd4AfaC951', 30, '2022-03-02', '23:30:01', NULL, NULL, 0),
('0i1ld4qdmr5', 'CabA831C4Bd', 1, '2022-03-03', '23:30:01', NULL, NULL, 0),
('0j0ihkd7js0', '8b1EFE2dFf0', 0.7, '2022-03-02', '23:30:01', NULL, NULL, 0),
('0n1erhmrfdr', '8e1bF982CeA', 175, '2022-03-03', '23:30:01', NULL, NULL, 0),
('1pc6f5ngjdq', 'dCBaFcFEC5f', 7.5, '2022-03-01', '23:30:01', NULL, NULL, 0),
('2efgd1rsm00', '1Fd4AfaC951', 30, '2022-03-01', '23:30:01', NULL, NULL, 0),
('318q9si2nb5', 'e406ade08aD', 30, '2022-03-01', '23:30:01', NULL, NULL, 0),
('3747rrl58rt', '842f4A38BF1', 1.2, '2022-03-01', '23:30:01', NULL, NULL, 0),
('379q0jktqtd', '842f4A38BF1', 1.2, '2022-03-03', '23:30:01', NULL, NULL, 0),
('3mfd3ebpf7t', '12c544e4b8d', 1.5, '2022-03-02', '23:30:01', NULL, NULL, 0),
('66f9sobm6qh', '8b1EFE2dFf0', 0.7, '2022-03-03', '23:30:01', NULL, NULL, 0),
('6bq53k1tgk2', 'e8B456fFeB1', 2, '2022-03-01', '23:30:01', NULL, NULL, 0),
('7h3tlj568tq', '8e1bF982CeA', 175, '2022-03-01', '23:30:01', NULL, NULL, 0),
('7p3l78hkeet', '0C1efd0B5A3', 0.5, '2022-03-01', '20:27:01', NULL, NULL, 0),
('7q8kd198bpt', '0C1efd0B5A3', 0.5, '2022-03-03', '23:30:01', NULL, NULL, 0),
('81toghfs047', '842f4A38BF1', 1.2, '2022-03-01', '20:27:01', NULL, NULL, 0),
('82fkofjpd2r', '0160BDE0713', 1, '2022-03-01', '23:30:01', NULL, NULL, 0),
('9ee9pc1s4df', 'ccf2F64c9E9', 4.5, '2022-03-01', '23:30:01', NULL, NULL, 0),
('9itlppkm3jd', '12c544e4b8d', 1.5, '2022-03-01', '23:30:01', NULL, NULL, 0),
('9q283rrk38g', 'dCBaFcFEC5f', 7.5, '2022-03-03', '23:30:01', NULL, NULL, 0),
('b4hdoghc11t', '8b1EFE2dFf0', 0.7, '2022-03-01', '23:30:01', NULL, NULL, 0),
('b7c3ls8e0st', '0C1efd0B5A3', 0.5, '2022-03-02', '23:30:01', NULL, NULL, 0),
('bnse3clsnke', 'dCBaFcFEC5f', 7.5, '2022-03-01', '20:27:01', NULL, NULL, 0),
('c4p9gnct7so', '8b1EFE2dFf0', 0.7, '2022-03-01', '20:27:01', NULL, NULL, 0),
('cgrc6m3ktqq', '473B813ea30', 262.5, '2022-03-01', '23:30:01', NULL, NULL, 0),
('d6j840sftft', '8e1bF982CeA', 175, '2022-03-02', '23:30:01', NULL, NULL, 0),
('dosd2qiq7rd', 'e406ade08aD', 30, '2022-03-02', '23:30:01', NULL, NULL, 0),
('dqi2ggfdq0m', '0C1efd0B5A3', 0.5, '2022-03-01', '23:30:01', NULL, NULL, 0),
('e1sscgpg347', 'e8B456fFeB1', 2, '2022-03-02', '23:30:01', NULL, NULL, 0),
('e7qpmdid6mr', 'ccf2F64c9E9', 4.5, '2022-03-01', '20:27:01', NULL, NULL, 0),
('e8stt1r70jf', '473B813ea30', 262.5, '2022-03-02', '23:30:01', NULL, NULL, 0),
('eqq3oq8o6e4', '0160BDE0713', 1, '2022-03-03', '23:30:01', NULL, NULL, 0),
('fhh3n8konnf', '12c544e4b8d', 1.5, '2022-03-03', '23:30:01', NULL, NULL, 0),
('fqrprsscthq', 'e406ade08aD', 30, '2022-03-01', '20:27:01', NULL, NULL, 0),
('gds3t6fgd72', '473B813ea30', 262.5, '2022-03-01', '20:27:01', NULL, NULL, 0),
('gtrcgkl4li3', 'effbE0Baec9', 3, '2022-03-03', '23:30:01', NULL, NULL, 0),
('h97c4sthmj8', 'CF766fd1C3C', 45, '2022-03-03', '23:30:01', NULL, NULL, 0),
('hbprgqpg9sc', '842f4A38BF1', 1.2, '2022-03-02', '23:30:01', NULL, NULL, 0),
('hq8ipje83eq', 'CabA831C4Bd', 1, '2022-03-01', '20:27:01', NULL, NULL, 0),
('igngek6jso5', '0160BDE0713', 1, '2022-03-02', '23:30:01', NULL, NULL, 0),
('j6tc5hrk1c7', '0160BDE0713', 1, '2022-03-01', '20:27:01', NULL, NULL, 0),
('jf30noce6l6', 'e8B456fFeB1', 2, '2022-03-01', '20:27:01', NULL, NULL, 0),
('jqq3hqh3ste', 'CabA831C4Bd', 1, '2022-03-01', '23:30:01', NULL, NULL, 0),
('k99mg839cme', '12c544e4b8d', 1.5, '2022-03-01', '20:27:01', NULL, NULL, 0),
('khh2ojq1ljj', '92c2ba8DCEF', 7.5, '2022-03-03', '23:30:01', NULL, NULL, 0),
('kttcg9f36r7', 'CabA831C4Bd', 1, '2022-03-02', '23:30:01', NULL, NULL, 0),
('l6hpq1mb82e', 'e8B456fFeB1', 2, '2022-03-03', '23:30:01', NULL, NULL, 0),
('o2d213j5f3b', 'ccf2F64c9E9', 4.5, '2022-03-03', '23:30:01', NULL, NULL, 0),
('o8pgtm09qk5', '473B813ea30', 262.5, '2022-03-03', '23:30:01', NULL, NULL, 0),
('os2j14s3ile', 'dCBaFcFEC5f', 7.5, '2022-03-02', '23:30:01', NULL, NULL, 0),
('osl85i80f27', '1Fd4AfaC951', 30, '2022-03-01', '20:27:01', NULL, NULL, 0),
('q66eb8dts78', 'ccf2F64c9E9', 4.5, '2022-03-02', '23:30:01', NULL, NULL, 0),
('q6j7qc9lntq', '8e1bF982CeA', 175, '2022-03-01', '20:27:01', NULL, NULL, 0),
('q937pokc158', 'e406ade08aD', 30, '2022-03-03', '23:30:01', NULL, NULL, 0),
('te64mn9jofl', '1Fd4AfaC951', 30, '2022-03-03', '23:30:01', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
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
  `user_token` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `user_name`, `sponsor`, `email`, `phone`, `user_password`, `side`, `user_status`, `validation_Status`, `locked`, `record_date`, `record_time`, `last_modif_date`, `last_modif_time`, `parent`, `images_name`, `user_token`) VALUES
('0160BDE0713', 'TEST6', 'D53215AbdCd', 'kakulejean75@gmail.com', '0820917287', '$argon2i$v=19$m=65536,t=4,p=1$TDdFMHdQV3FwMEVvcVNGMg$muxC2c4IhZkdiuyDq5G796StTqVlN1sly1lgzRKz964', '1', 0, 1, 0, '2022-02-03', '05:26:54', NULL, NULL, 'bDbEdcBDd49', NULL, NULL),
('0C1efd0B5A3', 'TEST10', 'f76b98b816E', 'barmos826@gmail.com', '+243853423455', '$argon2i$v=19$m=65536,t=4,p=1$ZzBQVXJudHRBVTFwS3hJNQ$Di6EN5XoDSRZVay4YpvykbqNGc0fBDdiYU1NnMcUnoA', '1', 0, 1, 0, '2022-02-15', '18:29:39', NULL, NULL, 'f76b98b816E', NULL, NULL),
('0F5c5ed2DfA', 'Nouveau Membre', '6Ba2bF9fc2f', 'nouveau@mail.com', '+243/972762889', '$argon2i$v=19$m=65536,t=4,p=1$WXgybDhEWDk1Z1lGNnkwbA$2uc/kq7OsJN61IhiRiI3vpTmQ1955UE+/mSCrC0L2a8', '1', 0, 1, 0, '2022-03-04', '10:05:54', NULL, NULL, 'e406ade08aD', 'cc0d5d4eeDeeE5Bbea0D\\user.png AND cc0d5d4eeDeeE5Bbea0D\\x320.png', NULL),
('12c544e4b8d', 'Aggee Stor', '8b1EFE2dFf0', 'aggeer@gmail.com', '0993825243', '$argon2i$v=19$m=65536,t=4,p=1$TEpySkI0alJwbXl2YWhWcw$t/b+GsBRB/39mBWebYt2Fvvqad47IdN5JDwIe0i797c', '2', 0, 1, 0, '2022-01-06', '16:15:56', NULL, NULL, 'bDbEdcBDd49', 'Bbc2Dd155ab2AbcAa5ee\\user.png AND Bbc2Dd155ab2AbcAa5ee\\x320.png', ''),
('1Fd4AfaC951', 'TEST13', 'dCBaFcFEC5f', 'mbalume0@gmail.com', '+243564566544', '$argon2i$v=19$m=65536,t=4,p=1$cHRXSTVodEFxbmFnZ3dkLw$erqD/4DHloxDcu9NJpWFwl5lB4Mvf1mme24b6l9OlBQ', '2', 0, 1, 0, '2022-02-21', '19:36:08', NULL, NULL, 'f76b98b816E', NULL, NULL),
('3Df0615d0ca', 'Un autre compte', '8e1bF982CeA', 'mailtruc@domain.ext', '+243/999999998', '$argon2i$v=19$m=65536,t=4,p=1$SjVtZDRRMkZ6bFVYeG9tOQ$LpE1DGeyVQ6fMZsnhsPWxQ9h72LsWTPK0B4oSkPCpQQ', '1', 0, 1, 0, '2022-03-04', '08:37:36', NULL, NULL, 'e406ade08aD', '0B4aeBAeA31424E1D0e5\\user.png AND 0B4aeBAeA31424E1D0e5\\x320.png', NULL),
('41FabD6FCeA', 'Mon compte', '8e1bF982CeA', 'momail@domain.ext', '+243/999999999', '$argon2i$v=19$m=65536,t=4,p=1$TzZMLlJPZWtlSUZBampobg$5oaX/TXCE2N/YaE8dsXF2dYWh3MjVbhFoVTUTD0kZ34', '2', 0, 1, 0, '2022-03-04', '08:26:14', NULL, NULL, 'e406ade08aD', '5be3D33aeA2A3b51ac53\\user.png AND 5be3D33aeA2A3b51ac53\\x320.png', NULL),
('473B813ea30', 'Partage1 Esaie', 'e406ade08aD', 'esaiemuhasa98@gmail.com', '+243972762883', '$argon2i$v=19$m=65536,t=4,p=1$SDl4QnRrbi8zMHBPTHY0eg$VGF0f9Fp10Yckx4HlhPAJfI6kR9k3GTssMytPr/5vIM', '1', 0, 1, 0, '2022-02-15', '20:58:03', NULL, NULL, 'e406ade08aD', '5B4ebDCDe2cdcaDdb1eb/user.png AND 5B4ebDCDe2cdcaDdb1eb/x320.png', NULL),
('5Ba892e4E50', 'TEST8', 'fb4AA75ddC5', 'bairorosette@gmail.com', '0875382863', '$argon2i$v=19$m=65536,t=4,p=1$SW9CZUYxZUgyLzYxQUZDMQ$LMr0ZQF1DpwxQcSxsycMuNPxk6r7W9v8hZ/OvzDpXxs', '1', 0, 0, 0, '2022-02-04', '10:40:27', NULL, NULL, 'bDbEdcBDd49', NULL, 'ZQOaeL6ZIOV6dZeTH3aogKGALH0jKrZtCD9s5yS4zGGpfdvOkHwc7HCAktZF'),
('6Ba2bF9fc2f', 'Mon truc', '473B813ea30', 'didon@machin.ext', '+243/989888999', '$argon2i$v=19$m=65536,t=4,p=1$WGRTcWNnSjVpVGNzRVl0eg$VPhpYjJeXBqiJhTwgvEVUCnHkbn3mUxxv4CQqP2iMlk', '2', 0, 1, 0, '2022-03-04', '09:57:27', NULL, NULL, 'e406ade08aD', 'cbbE0eb52d1Bc2Da1cC0\\user.png AND cbbE0eb52d1Bc2Da1cC0\\x320.png', NULL),
('7b3d1dc4580', 'Modeste', '6Ba2bF9fc2f', 'modeste@mail.com', '+243/998888666', '$argon2i$v=19$m=65536,t=4,p=1$di9HcVliV0M1dGpReTdpNA$svaVOFqlmggCGYXfXM0v2kChb7O1ro2oV6MZOHqq5Tc', '2', 0, 1, 0, '2022-03-04', '11:16:53', NULL, NULL, 'e406ade08aD', '1C01CAa20c10e32235C4\\user.png AND 1C01CAa20c10e32235C4\\x320.png', NULL),
('7fa61Add2Ce', 'Fiston Fils', '473B813ea30', 'fils@mail.com', '+243/999888888', '$argon2i$v=19$m=65536,t=4,p=1$OEg1QUFtLkdKV1duOW82Uw$gw5Y3Uo+2AUzFtOtmGE9DmxEl57/mXCHKzEnpg2KTeM', '1', 0, 1, 0, '2022-03-04', '09:14:12', NULL, NULL, 'e406ade08aD', '4B5AB4aB3C2c3cbc2ac1\\user.png AND 4B5AB4aB3C2c3cbc2ac1\\x320.png', NULL),
('842f4A38BF1', 'Serge Makasi', '8b1EFE2dFf0', 'sergemakasi@gmail.com', '0994603189', '$argon2i$v=19$m=65536,t=4,p=1$SGw3MVovRDgxWThrWkFlQQ$Dk4dwWhZ40RU319HrpKTvAbOY2Ww5MEnozx6VJmPiYE', '1', 0, 1, 0, '2022-01-06', '16:20:41', NULL, NULL, 'bDbEdcBDd49', '13C2c34C2DCe35BEaCAe\\user.png AND 13C2c34C2DCe35BEaCAe\\x320.png', ''),
('8b1EFE2dFf0', 'Amani Nyumu', 'bDbEdcBDd49', 'amaninyumu@gmail.com', '0997257938', '$argon2i$v=19$m=65536,t=4,p=1$RkYvclFDWnFNZ3IwM0xtRA$k6QrB2CBoxC5UTJYHhzi5vuJBlKyjRIhEarbSa9fh0s', '2', 0, 1, 1, '2022-01-06', '16:05:29', NULL, NULL, 'bDbEdcBDd49', '0dc152bB4DC2AaA3DAdA\\user.png AND 0dc152bB4DC2AaA3DAdA\\x320.png', ''),
('8e1bF982CeA', 'Partage Esaie', 'e406ade08aD', 'esaiemuhasa0@gmail.com', '+243972762882', '$argon2i$v=19$m=65536,t=4,p=1$Skp4N0VhTTEzanVzamd0bw$/6t4Lh42JRcGeuQ83NuiCsLb1TYTgz6kEhZF/LiwWSw', '2', 0, 1, 0, '2022-02-15', '20:24:53', NULL, NULL, 'e406ade08aD', 'da2DbaADb0a4cCBEE52d/user.png AND da2DbaADb0a4cCBEE52d/x320.png', NULL),
('92c2ba8DCEF', 'TEST15', 'EC2F56aAB44', 'ikangamino5@gmail.com', '+243/997867358', '$argon2i$v=19$m=65536,t=4,p=1$LlFJSlU0LnRCdVFtdWNkVw$zADFXCHihc/euewxmuYHysOOyuYaDq+sGTeWuEWEnHI', '1', 0, 1, 0, '2022-03-03', '17:16:26', NULL, NULL, 'EC2F56aAB44', 'default\\user.jpg AND default\\x320.jpg', NULL),
('B2AEB6c6FfE', 'Esaie MUHASA', 'DDfcF8DbE78', 'esaie@gmail.com', '+243/911111111', '$argon2i$v=19$m=65536,t=4,p=1$NU8veTRhSUplUHZNcUxNNQ$T+vvwDdO11270MzqXlmnI9+cQAaQJTlFOtdYnRn8uXI', '1', 0, 1, 0, '2022-03-10', '11:26:46', NULL, NULL, '8b1EFE2dFf0', '2aDD4eCe2b0dC0eD4dEd\\user.png AND 2aDD4eCe2b0dC0eD4dEd\\x320.png', NULL),
('bDbEdcBDd49', 'Usalvagetrade', NULL, 'usalvagetrade@gmail.com', '+243819953172', '$argon2i$v=19$m=65536,t=4,p=1$TEpYa0VGN1NOY1hPbXpCTg$O7WHEyMeECzhSTNsnecLJLCMLunMlYZCNbHFebtCEq0', NULL, 0, 1, 0, '2022-01-01', '10:00:00', NULL, NULL, NULL, 'Bbc2Dd155ab2AbcAa5ee\\user.png AND Bbc2Dd155ab2AbcAa5ee\\x320.png', ''),
('CabA831C4Bd', 'Esaie Muhasa', 'bDbEdcBDd49', 'esaiemuhasa@gmail.com', '0972762881', '$argon2i$v=19$m=65536,t=4,p=1$aFFjNDdaUlJkQU4wTzlrUw$XtE5/PUWmvqeZzv0ASjX+k1Z0gjc4VN32U4WweF3WgA', '1', 0, 1, 0, '2022-01-06', '16:11:14', NULL, NULL, 'bDbEdcBDd49', '1bEe325EecC4a5114cED\\user.png AND 1bEe325EecC4a5114cED\\x320.png', ''),
('CBA90c833b9', 'TEST7', 'fb4AA75ddC5', 'kakulejn@gmail.com', '0826489483', '$argon2i$v=19$m=65536,t=4,p=1$cXdzblBySDIxNlFlY29SVQ$0CZTI9t55NmbHKH/rFciFy2DM2A/8X/9qZp0cPh2tmI', '2', 0, 0, 0, '2022-02-03', '05:36:12', NULL, NULL, 'bDbEdcBDd49', NULL, 'toACIgHGEdoZ1HKDS4FnBUwKzlaE4BWz3H2GoJarJVlbLzJ9LUodMpnB6gTQ'),
('ccf2F64c9E9', 'TEST12', 'dCBaFcFEC5f', 'bakenet75@gmail.com', '+243659674534', '$argon2i$v=19$m=65536,t=4,p=1$NFE0bm1oLkIvWlRmeXNmSA$i5p8wNTBqptNsaxmHiA2yuNNI1o0KmtIrsPTyM+Z/ps', '1', 0, 1, 0, '2022-02-21', '19:13:57', NULL, NULL, 'f76b98b816E', NULL, NULL),
('CF766fd1C3C', 'TEST16', 'EC2F56aAB44', 'rodriguekibula0044@gmail.com', '+243/774525543', '$argon2i$v=19$m=65536,t=4,p=1$cmtYNlp4bFllTWFjUUFZNQ$XN/nelIpgtf3Wqk1H2Wj8GEru+xrkosN1ZvGT3+dUP8', '2', 0, 1, 0, '2022-03-03', '17:22:47', NULL, NULL, 'EC2F56aAB44', 'default\\user.jpg AND default\\x320.jpg', NULL),
('D53215AbdCd', 'TEST4', 'e8B456fFeB1', 'bileale73@gmail.com', '0974198084', '$argon2i$v=19$m=65536,t=4,p=1$WVdaaUlaenZOSDFsZEpGQg$h2o/RyK3gcSJYMkUSMVZg+IR+G4ouhfypkyrB0mhViY', '2', 0, 1, 0, '2022-02-01', '21:05:57', NULL, NULL, 'bDbEdcBDd49', '3eD5EBdCb0EB1ECEdDa1/user.png AND 3eD5EBdCb0EB1ECEdDa1/x320.png', NULL),
('dCBaFcFEC5f', 'TEST11', 'f76b98b816E', 'lubungajules3@gmail.com', '+243894564434', '$argon2i$v=19$m=65536,t=4,p=1$b1A0ZUc4TlBsRGJhR29mcg$lalb67K6MTMrUN/19fffPgKeUGuoH0lLF5Wy+raJspU', '2', 0, 1, 0, '2022-02-21', '18:37:58', NULL, NULL, 'f76b98b816E', NULL, NULL),
('DDfcF8DbE78', 'Kapamba ', '842f4A38BF1', 'kapamba@gmail.com', '+243992554477', '$argon2i$v=19$m=65536,t=4,p=1$aFlKTE1vLk1kUHp1bTRSSA$TYdU/MzzL9BUmg6e+DIK4Ww5clRHdi8UtLlRXK/qfN8', '2', 0, 0, 0, '2022-02-15', '19:13:44', NULL, NULL, '842f4A38BF1', '1DDAAebD5EEEeB5CC134/user.png AND 1DDAAebD5EEEeB5CC134/x320.png', 'xI3gMHW8v11xpVZxGRbFoNLaRyOYOsiI0DHv5FCbgQ65ASXAuR0RjtPaVccN'),
('E19Eb606a9c', 'Amani Nyumu', '12c544e4b8d', 'amaninyumu1@gmail.com', '0998556642', '$argon2i$v=19$m=65536,t=4,p=1$RFlrc2dVdjc0cFBlWENIbg$J3ADnj1NHWD3aUQ4JAk1useBptman0EuyixjTgdpPns', '1', 0, 1, 0, '2022-01-21', '16:49:49', NULL, NULL, 'bDbEdcBDd49', 'c1d2e0012BC24EB3CBe4/user.png AND c1d2e0012BC24EB3CBe4/x320.png', NULL),
('e406ade08aD', 'Esaie MUHASA', 'CBA90c833b9', 'esaiemuhasa.dev@gmail.com', '+243972762881', '$argon2i$v=19$m=65536,t=4,p=1$M2JSZTFwNzhRSG9FdVV1OQ$awEZd0lPz7lPZ6icWyJKif7uNDIi+9QthH/WPk0iZMc', '1', 0, 1, 0, '2022-02-15', '20:03:15', NULL, NULL, 'bDbEdcBDd49', '3a3c0E4BE5d20EAdeDC4/user.png AND 3a3c0E4BE5d20EAdeDC4/x320.png', NULL),
('E46911fc126', 'TEST5', 'e8B456fFeB1', 'ernestmasirika5@gmail.com', '0978368263', '$argon2i$v=19$m=65536,t=4,p=1$YWoyV3p5U0Z1aVJmbS5Ceg$nsnPtbQ0WA2nU1tYQfpcvrn7Jlm9RLmRfwEOO6PRcqk', '1', 0, 1, 0, '2022-02-02', '05:38:14', NULL, NULL, 'bDbEdcBDd49', NULL, NULL),
('e8B456fFeB1', 'Amani Kambale', '12c544e4b8d', 'amaninyumu11@gmail.com', '0993504644', '$argon2i$v=19$m=65536,t=4,p=1$eVdZR3FzMXQyQTNQVFlFbA$swkkGXiRm24n8b/E7nbsm2ahiaMRcgpanIoSFforOtk', '2', 0, 1, 0, '2022-01-16', '12:15:48', NULL, NULL, 'bDbEdcBDd49', 'bDbCD1b5c2E4cDA0540E/user.png AND bDbCD1b5c2E4cDA0540E/x320.png', NULL),
('EC2F56aAB44', 'TEST14', '1Fd4AfaC951', 'abedisylvain642@gmail.com', '+243/851787655', '$argon2i$v=19$m=65536,t=4,p=1$WWRIWVhWVFhBUnJrQ1Ribw$l+K6Bjg73gy0B3H5E/EuY4+29Iuh4cbFS0WTodmMyes', '1', 0, 1, 1, '2022-03-03', '17:08:37', NULL, NULL, 'f76b98b816E', 'default\\user.jpg AND default\\x320.jpg', NULL),
('EDFd3E2CEb5', 'Partage  de Test', '842f4A38BF1', 'mailpartage@mail.cd', '+243/972762822', '$argon2i$v=19$m=65536,t=4,p=1$NTl0SEZjQlhGLlRKY2MuWA$xJbxs+WZzG/3TQxjvjjjLFkg6Hjr+sKOPkzy5lswBEs', '1', 0, 1, 0, '2022-03-10', '10:07:55', NULL, NULL, '8b1EFE2dFf0', 'd43bC5DCacbCcE0D0CaD\\user.png AND d43bC5DCacbCcE0D0CaD\\x320.png', NULL),
('effbE0Baec9', 'Joel Kanyama', '1Fd4AfaC951', 'amanikambale1212@gmail.com', '+243/997318193', '$argon2i$v=19$m=65536,t=4,p=1$dnYwaGJaS3YxSzV6MUpLcQ$CcuSDbERyap9y3BJ4tUSMyEN7xrdUuTIQ6W8g+m2m4k', '2', 0, 1, 0, '2022-03-03', '10:00:41', NULL, NULL, 'bDbEdcBDd49', 'bDbCD1b5c2E4cDA0540E/user.png AND bDbCD1b5c2E4cDA0540E/x320.png', NULL),
('f76b98b816E', 'TEST8', 'CBA90c833b9', 'mulekyajeanpaul307@gmail.com', '+193747299379', '$argon2i$v=19$m=65536,t=4,p=1$dlVWYVFKd1FqV0VOS0U0ag$tpO7N1Y1rccBf/EXq0LH6IXXNdtC3h914PU4zhn8ZAU', '2', 0, 1, 1, '2022-02-09', '20:23:10', NULL, NULL, 'bDbEdcBDd49', NULL, NULL),
('fb4AA75ddC5', 'Amani Anykam', 'D53215AbdCd', 'amanikambale1213@gmail.com', '0997254455', '$argon2i$v=19$m=65536,t=4,p=1$ZzUySWZHbHl6U2hKQVBhag$Ec5YBHhGAvseKETQ6gTzZ3495zDNiNC+t4m+uUpmAcs', '2', 0, 1, 0, '2022-02-02', '17:33:08', NULL, NULL, 'bDbEdcBDd49', 'bb0BC1AaeA30EAC34453/user.png AND ', NULL);

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
  ADD CONSTRAINT `return_invest_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
