-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 13 mars 2022 à 08:40
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
CREATE DATABASE IF NOT EXISTS `usalva` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `usalva`;

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
('4aFac60DcDe', 'Mbusa', 'usalvaget@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$TXl0UDA0OEd3bnk4OWlmaA$+2PdqEBGMI4PxhOCqU/VV2QaaH8kSWzXrGSmj6hR4e8', '2022-02-15', '19:03:49', NULL, '00:00:01', 0, NULL, NULL),
('9246aadc0b7', 'Amani', 'amaninyumu1@gmail.com', '$argon2i$v=19$m=65536,t=4,p=1$WWR2M1VnWkpKSjJxRGp5Vg$vp5y5wGTkrQQNFZvoNY6O+QxekdAcVJiyhRUuNrzEVk', '2021-12-19', '05:39:50', NULL, NULL, 1, NULL, NULL);

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

--
-- Déchargement des données de la table `binarys`
--

INSERT INTO `binarys` (`id`, `user_id`, `id_sponsored_inscription`, `amount`, `record_date`, `record_time`, `last_modif_date`, `last_modif_time`, `surplus`) VALUES
('11ijs73qrko', '842f4A38BF1', 'cAd8AF277BC', 20, '2022-03-04', '15:30:00', NULL, NULL, 0),
('39qnkk0sp8f', 'DDfcF8DbE78', '6E34DE51046', 250, '2022-03-10', '14:27:09', NULL, NULL, 0),
('bqfhgq9ooss', 'E19Eb606a9c', '4328b6A6aDe', 0, '2022-03-05', '22:06:27', NULL, NULL, 10),
('c3jcb18t661', 'D53215AbdCd', '3Db51a25ff3', 0, '2022-03-09', '20:09:17', NULL, NULL, 200),
('e6tdcflhq9h', 'fb4AA75ddC5', '3Db51a25ff3', 0, '2022-03-09', '20:09:17', NULL, NULL, 200),
('h4rcmofi983', 'e8B456fFeB1', '3Db51a25ff3', 200, '2022-03-09', '20:09:17', NULL, NULL, 0),
('ioq9r3qt3gf', '12c544e4b8d', '948B5D7bEeC', 50, '2022-03-09', '12:28:27', NULL, NULL, 0),
('lqpdbkogeeq', '8b1EFE2dFf0', '3Db51a25ff3', 200, '2022-03-09', '20:09:17', NULL, NULL, 0),
('o8p7b51lgp7', '12c544e4b8d', '3Db51a25ff3', 200, '2022-03-09', '20:09:17', NULL, NULL, 0),
('rf8hlcjnt1r', '12c544e4b8d', '4328b6A6aDe', 10, '2022-03-05', '22:06:27', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `cashout`
--

CREATE TABLE `cashout` (
  `id` varchar(256) NOT NULL,
  `user_id` varchar(256) NOT NULL,
  `amount` double NOT NULL,
  `destination` varchar(256) NOT NULL,
  `reference` varchar(256) DEFAULT NULL,
  `record_date` date NOT NULL,
  `record_time` time NOT NULL,
  `last_modif_date` date DEFAULT NULL,
  `last_modif_time` time DEFAULT NULL,
  `validated` tinyint(1) NOT NULL DEFAULT 0,
  `admin` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `cashout`
--

INSERT INTO `cashout` (`id`, `user_id`, `amount`, `destination`, `reference`, `record_date`, `record_time`, `last_modif_date`, `last_modif_time`, `validated`, `admin`) VALUES
('4D0bdb2f37e', '8b1EFE2dFf0', 100, '+243998665544', NULL, '2022-03-12', '19:00:59', NULL, NULL, 0, '9246aadc0b7'),
('4fAe6dCd90e', '842f4A38BF1', 40, 'bc1qrrlu8djcwjzjpyqwwphww3d28n09n4yvenyr40', NULL, '2022-03-12', '10:42:19', NULL, NULL, 0, '9246aadc0b7'),
('8fFA6Ff3F1D', '842f4A38BF1', 20, '+243999666555', NULL, '2022-03-05', '19:17:24', NULL, NULL, 0, '9246aadc0b7'),
('a58BDAf1eCd', '8b1EFE2dFf0', 150, '+243993504644', NULL, '2022-03-12', '20:53:42', NULL, NULL, 0, '9246aadc0b7'),
('aebFF3DB36a', '842f4A38BF1', 20, '+243999333222', NULL, '2022-03-05', '19:20:00', NULL, NULL, 0, '9246aadc0b7'),
('affB3F5774d', '8b1EFE2dFf0', 20, '+243998665544', NULL, '2022-03-12', '21:10:22', NULL, NULL, 0, NULL),
('b7FFAc25B02', '842f4A38BF1', 20, '+243998665544', NULL, '2022-03-05', '13:09:58', NULL, NULL, 0, '9246aadc0b7'),
('bCf4FadDf52', '842f4A38BF1', 20, '+243998665544', NULL, '2022-03-12', '09:46:18', NULL, NULL, 0, '9246aadc0b7'),
('F441B06f97c', 'bDbEdcBDd49', 20, '+243819953172', NULL, '2022-03-05', '14:15:22', NULL, NULL, 0, '9246aadc0b7'),
('fe5C5dE9A8e', '8b1EFE2dFf0', 20, '+243993504644', NULL, '2022-03-12', '21:12:55', NULL, NULL, 0, NULL);

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
('2E38aDCd67e', '1a29d42B3b8', 6000, '2022-03-10', '17:12:25', 'AirtelMoney', 'Mpesa Transaction ID 55662255', 0, '9246aadc0b7', '2022-03-10', '17:12:41', NULL, NULL),
('305ad5b3b85', 'FFbf98Ab1dc', 10000, '2022-03-10', '14:39:54', 'AirtelMoney', 'Airtel Money Transaction ID 55662255', 0, '9246aadc0b7', '2022-03-10', '14:40:26', NULL, NULL),
('3457C2cB87f', '7A0c06Dd7d5', 4000, '2022-03-10', '14:33:06', 'M-Pesa', 'Mpesa Transaction ID 55662255', 0, '9246aadc0b7', '2022-03-10', '14:33:21', NULL, NULL),
('39d15A0da6b', 'e8B456fFeB1', 200, '2022-01-21', '14:49:57', 'Btc', 'Btc', 0, '9246aadc0b7', '2022-02-03', '05:26:17', NULL, NULL),
('3Db51a25ff3', '8DDBf1922df', 2000, '2022-03-09', '18:59:22', 'AirtelMoney', 'Airtel Money Transaction ID 55662255', 0, '9246aadc0b7', '2022-03-09', '20:09:17', NULL, NULL),
('4328b6A6aDe', 'bDCE14bD4F4', 100, '2022-03-05', '22:06:15', 'AirtelMoney', 'Airtel Money Transaction ID 55662255', 1, '9246aadc0b7', '2022-03-05', '22:06:27', NULL, NULL),
('4eca17fAEEf', 'f76b98b816E', 100, '2022-02-09', '20:30:22', 'AirtelMoney', 'Ldbsjqkbdn', 1, '4aFac60DcDe', '2022-02-15', '18:15:26', NULL, NULL),
('5fEc0e7dA25', 'a6d2e371Eb6', 3000, '2022-03-04', '15:38:33', 'AirtelMoney', 'Airtel Money Transaction ID 55662255', 1, '9246aadc0b7', '2022-03-04', '15:39:06', NULL, NULL),
('6E34DE51046', '20fA2d8Bc1a', 2500, '2022-03-10', '14:26:48', 'AirtelMoney', 'Airtel Money Transaction ID 55662255', 1, '9246aadc0b7', '2022-03-10', '14:27:09', NULL, NULL),
('8A1BeeBd5cE', 'CabA831C4Bd', 100, '2022-01-06', '16:12:22', 'Bitcoin', 'Btc', 1, '9246aadc0b7', '2022-01-06', '16:44:42', NULL, NULL),
('948B5D7bEeC', 'FCE3e062aFf', 500, '2022-03-06', '15:24:05', 'AirtelMoney', 'Airtel Money Transaction ID 55662255', 1, '9246aadc0b7', '2022-03-09', '12:28:27', NULL, NULL),
('ACafeA0679e', '3ABe9ebf29f', 100, '2022-03-05', '22:14:00', 'AirtelMoney', 'Airtel Money Transaction ID 55662255', 1, '9246aadc0b7', '2022-03-05', '22:15:44', NULL, NULL),
('aF3fe37Bc94', '842f4A38BF1', 120, '2022-01-06', '16:22:40', 'Bitcoin', 'Btc', 1, '9246aadc0b7', '2022-01-16', '11:38:10', NULL, NULL),
('aFcFEeE3B80', '0C1efd0B5A3', 50, '2022-02-15', '18:57:23', 'AirtelMoney', 'Iehdkslnddb', 1, '9246aadc0b7', '2022-02-16', '17:39:35', NULL, NULL),
('b81f300edA4', '0160BDE0713', 100, '2022-02-09', '20:08:21', 'BTC', '74435690c0a452b6ff4eb1240bf0d4735070a9a33f65271ee17b4a7f7bd793e5', 1, '9246aadc0b7', '2022-02-15', '19:10:06', NULL, NULL),
('b9a743A3ab9', '2876205cfcF', 1000, '2022-03-10', '12:34:51', 'AirtelMoney', 'ID Airtel Money 0990135518', 0, NULL, NULL, NULL, NULL, NULL),
('Bd4bCcA0fCa', '12c544e4b8d', 150, '2022-01-06', '16:16:49', 'Bitcoin', 'Btc', 1, '9246aadc0b7', '2022-01-13', '23:12:42', NULL, NULL),
('CaCe80cE722', '15fEdeb43CF', 100000, '2022-03-10', '17:25:29', 'AirtelMoney', 'Airtel Money Transaction ID 55662255', 1, '9246aadc0b7', '2022-03-10', '17:25:50', NULL, NULL),
('cAd8AF277BC', '8aa9e08Ad1e', 200, '2022-03-04', '15:29:44', 'M-Pesa', 'Mpesa Transaction ID 55662255', 1, '9246aadc0b7', '2022-03-04', '15:30:00', NULL, NULL),
('cea8dec70F1', 'ccd8D5Ea122', 2000, '2022-03-10', '13:55:12', 'AirtelMoney', 'Airtel Money Transaction ID 55662255', 1, '9246aadc0b7', '2022-03-10', '13:55:32', NULL, NULL),
('E362Af20BEa', '8b1EFE2dFf0', 70, '2022-01-06', '16:08:16', 'Bitcoin', 'Btc', 1, '9246aadc0b7', '2022-01-06', '16:44:30', NULL, NULL),
('efD0BeF43d2', 'bDbEdcBDd49', 250000, '2022-01-06', '15:46:36', 'initialisation systeme', 'Usalvagetrade Capital', 1, NULL, NULL, NULL, NULL, NULL),
('f167cf2cAda', 'DDfcF8DbE78', 300, '2022-03-04', '14:58:49', 'AirtelMoney', 'ID Airtel Money 0990135517', 1, '9246aadc0b7', '2022-03-04', '15:00:27', NULL, NULL);

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
('0d1rfi338sd', 'bDbEdcBDd49', '4eca17fAEEf', 10, '2022-02-15', '18:15:26', NULL, NULL, 0),
('2h9gqlm3b54', 'bDCE14bD4F4', 'ACafeA0679e', 10, '2022-03-05', '22:15:44', NULL, NULL, 0),
('4c1o3s59onq', 'bDbEdcBDd49', 'Bd4bCcA0fCa', 15, '2022-01-13', '23:12:42', NULL, NULL, 0),
('7kegrsbb2rh', 'bDbEdcBDd49', 'aF3fe37Bc94', 12, '2022-01-16', '11:38:10', NULL, NULL, 0),
('b7odm9fb40p', 'DDfcF8DbE78', '3457C2cB87f', 400, '2022-03-10', '14:33:21', NULL, NULL, 0),
('c59i2f4172c', '12c544e4b8d', '948B5D7bEeC', 50, '2022-03-09', '12:28:27', NULL, NULL, 0),
('ege47or2dqm', '8b1EFE2dFf0', '3Db51a25ff3', 200, '2022-03-09', '20:09:17', NULL, NULL, 0),
('epci5lhql33', '20fA2d8Bc1a', '305ad5b3b85', 1000, '2022-03-10', '14:40:26', NULL, NULL, 0),
('f99f83gj3te', '12c544e4b8d', 'cea8dec70F1', 128.5, '2022-03-10', '13:55:32', NULL, NULL, 71.5),
('k6sjljjbgcg', 'bDbEdcBDd49', '8A1BeeBd5cE', 10, '2022-01-06', '16:44:42', NULL, NULL, 0),
('kng7rqd13lo', 'bDbEdcBDd49', 'b81f300edA4', 10, '2022-02-15', '19:10:06', NULL, NULL, 0),
('lqqhrkptf8d', 'DDfcF8DbE78', '6E34DE51046', 250, '2022-03-10', '14:27:09', NULL, NULL, 0),
('lrps047j2qt', '20fA2d8Bc1a', '2E38aDCd67e', 600, '2022-03-10', '17:12:41', NULL, NULL, 0),
('mk2e97k1l1s', 'bDbEdcBDd49', 'E362Af20BEa', 7, '2022-01-06', '16:44:30', NULL, NULL, 0),
('n85fkqlhh0i', 'bDbEdcBDd49', '39d15A0da6b', 20, '2022-02-03', '05:26:17', NULL, NULL, 0),
('pe5c31e2f7k', 'f76b98b816E', 'aFcFEeE3B80', 5, '2022-02-16', '17:39:35', NULL, NULL, 0),
('prt2pd10664', '20fA2d8Bc1a', 'CaCe80cE722', 5900, '2022-03-10', '17:25:50', NULL, NULL, 4100),
('q9qj89c9hkb', '842f4A38BF1', 'f167cf2cAda', 30, '2022-03-04', '15:00:27', NULL, NULL, 0),
('qdojc320p1k', '12c544e4b8d', '4328b6A6aDe', 10, '2022-03-05', '22:06:27', NULL, NULL, 0),
('s7g1ogf6j95', '842f4A38BF1', '5fEc0e7dA25', 288.8, '2022-03-04', '15:39:06', NULL, NULL, 11.2),
('t5ppfkio6b1', '842f4A38BF1', 'cAd8AF277BC', 20, '2022-03-04', '15:30:00', NULL, NULL, 0);

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

--
-- Déchargement des données de la table `return_invest`
--

INSERT INTO `return_invest` (`id`, `user_id`, `amount`, `record_date`, `record_time`, `last_modif_date`, `last_modif_time`, `surplus`) VALUES
('0m24reqcl89', '12c544e4b8d', 1.5, '2022-03-01', '18:11:51', NULL, NULL, 0),
('bbkk5qi15fi', 'f76b98b816E', 1, '2022-03-01', '18:11:51', NULL, NULL, 0),
('homdms8r6hs', '0160BDE0713', 1, '2022-03-01', '18:11:51', NULL, NULL, 0),
('jpfqcsn7oqq', 'CabA831C4Bd', 1, '2022-03-01', '18:11:51', NULL, NULL, 0),
('loo66tll4fn', '842f4A38BF1', 1.2, '2022-03-01', '18:11:51', NULL, NULL, 0),
('m89o89h7on4', '0C1efd0B5A3', 0.5, '2022-03-01', '18:11:51', NULL, NULL, 0),
('rs4ketkhr22', 'e8B456fFeB1', 2, '2022-03-01', '18:11:51', NULL, NULL, 0),
('t4s8or77kqd', '8b1EFE2dFf0', 0.7, '2022-03-01', '18:11:51', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` varchar(256) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `sponsor` varchar(256) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
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
  `user_token` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `user_name`, `sponsor`, `email`, `phone`, `user_password`, `side`, `user_status`, `validation_Status`, `locked`, `record_date`, `record_time`, `last_modif_date`, `last_modif_time`, `parent`, `images_name`, `user_token`) VALUES
('0160BDE0713', 'TEST6', 'D53215AbdCd', 'kakulejean75@gmail.com', '0820917287', '$argon2i$v=19$m=65536,t=4,p=1$TDdFMHdQV3FwMEVvcVNGMg$muxC2c4IhZkdiuyDq5G796StTqVlN1sly1lgzRKz964', '1', 0, 1, 0, '2022-02-03', '05:26:54', NULL, NULL, 'bDbEdcBDd49', NULL, NULL),
('0C1efd0B5A3', 'TEST10', 'f76b98b816E', 'barmos826@gmail.com', '+243853423455', '$argon2i$v=19$m=65536,t=4,p=1$ZzBQVXJudHRBVTFwS3hJNQ$Di6EN5XoDSRZVay4YpvykbqNGc0fBDdiYU1NnMcUnoA', '1', 0, 1, 0, '2022-02-15', '18:29:39', NULL, NULL, 'f76b98b816E', NULL, NULL),
('12c544e4b8d', 'Aggee Stor', '8b1EFE2dFf0', 'aggeer@gmail.com', '0993825243', '$argon2i$v=19$m=65536,t=4,p=1$TEpySkI0alJwbXl2YWhWcw$t/b+GsBRB/39mBWebYt2Fvvqad47IdN5JDwIe0i797c', '2', 0, 1, 0, '2022-01-06', '16:15:56', NULL, NULL, 'bDbEdcBDd49', 'Bbc2Dd155ab2AbcAa5ee\\user.png AND Bbc2Dd155ab2AbcAa5ee\\x320.png', ''),
('15fEdeb43CF', 'surplus', 'FFbf98Ab1dc', 'surplus@gmail.com', '+243/999666555', '$argon2i$v=19$m=65536,t=4,p=1$QUdheTVxVjFvQkw0QzhEbg$rkTYnpO/b2uSep+PT3hBtPTjvDstsgr2NtoIAzud1jw', '2', 0, 1, 0, '2022-03-10', '17:23:57', NULL, NULL, '20fA2d8Bc1a', 'cecabC4DeE1ACD1bcaEE\\user.png AND cecabC4DeE1ACD1bcaEE\\x320.png', NULL),
('1a29d42B3b8', 'testbinaire', '7A0c06Dd7d5', 'binaire@gmail.com', '+243/971555222', '$argon2i$v=19$m=65536,t=4,p=1$ZmR1bzFEUXNwcjJCMFQzMw$1u1HGFLmainleCQyxtsQ+KVriP2zMT/pazzHmb1iBDI', '1', 0, 1, 0, '2022-03-10', '17:10:54', NULL, NULL, '20fA2d8Bc1a', 'c5BCCD43ce1B40A5edCc\\user.png AND c5BCCD43ce1B40A5edCc\\x320.png', NULL),
('20fA2d8Bc1a', 'Fiston', 'DDfcF8DbE78', 'fiston@gmail.com', '+243/999666222', '$argon2i$v=19$m=65536,t=4,p=1$cDBBYUYxV0tKbzEudm9rag$dY8TX3S6bKdZTHhRfqT517ntgTohdF4oL4BnOKtg0YI', '1', 0, 1, 1, '2022-03-10', '14:24:17', NULL, NULL, 'DDfcF8DbE78', 'DdAcd4a0bed343EE112d\\user.png AND DdAcd4a0bed343EE112d\\x320.png', NULL),
('2876205cfcF', 'essaieview', 'f76b98b816E', 'essaieview@gmail.com', '+243/999555222', '$argon2i$v=19$m=65536,t=4,p=1$Z25VcWxNdm1HajZWQW1ocg$wb4AGfIv7vQsO3qzZ5NVR8F908Cu+KDkJCtJHaF/j3k', '2', 0, 1, 0, '2022-03-10', '12:32:30', NULL, NULL, 'bDbEdcBDd49', 'default\\user.jpg AND default\\x320.jpg', NULL),
('3ABe9ebf29f', 'agge child partage', 'bDCE14bD4F4', 'aggechildp@gmail.com', '+243/999666444', '$argon2i$v=19$m=65536,t=4,p=1$aE80Y0dEYXhycFVpN1J6RQ$wOxDqf0Q2jjp63bmtZbE7iO6LgOhdeuyXxn0W8N20U8', '1', 0, 1, 0, '2022-03-05', '22:12:03', NULL, NULL, 'bDCE14bD4F4', 'default\\user.jpg AND default\\x320.jpg', NULL),
('5Ba892e4E50', 'TEST8', 'fb4AA75ddC5', 'bairorosette@gmail.com', '0875382863', '$argon2i$v=19$m=65536,t=4,p=1$SW9CZUYxZUgyLzYxQUZDMQ$LMr0ZQF1DpwxQcSxsycMuNPxk6r7W9v8hZ/OvzDpXxs', '1', 0, 0, 0, '2022-02-04', '10:40:27', NULL, NULL, 'bDbEdcBDd49', NULL, 'ZQOaeL6ZIOV6dZeTH3aogKGALH0jKrZtCD9s5yS4zGGpfdvOkHwc7HCAktZF'),
('7A0c06Dd7d5', 'magneto', '20fA2d8Bc1a', 'magneto@gmail.com', '+243/999555600', '$argon2i$v=19$m=65536,t=4,p=1$QlRtN2hnRGlicHREY1A5aQ$GQbh6vmCdeffzV+wwF1QpH60E8XUzawtqBQ5tFaHxNI', '1', 0, 1, 0, '2022-03-10', '14:31:37', NULL, NULL, 'DDfcF8DbE78', 'Db3A2d4b522D5a20CB04\\user.png AND Db3A2d4b522D5a20CB04\\x320.png', NULL),
('842f4A38BF1', 'Serge Makasi', '8b1EFE2dFf0', 'sergemakasi@gmail.com', '+243/993251534', '$argon2i$v=19$m=65536,t=4,p=1$SGw3MVovRDgxWThrWkFlQQ$Dk4dwWhZ40RU319HrpKTvAbOY2Ww5MEnozx6VJmPiYE', '1', 0, 1, 1, '2022-01-06', '16:20:41', '2022-03-05', '18:43:49', 'bDbEdcBDd49', '13C2c34C2DCe35BEaCAe\\user.png AND 13C2c34C2DCe35BEaCAe\\x320.png', ''),
('8aa9e08Ad1e', 'Serge partage 1', '842f4A38BF1', 'kampamba1@gmail.com', '+243/999666333', '$argon2i$v=19$m=65536,t=4,p=1$OVZuVlpyeHJPeE5ZT3phdA$8DIWP+Lf+PzaVDxzIRB2x6wX3tMnIRl+9gv5ucNFoOU', '1', 0, 1, 0, '2022-03-04', '15:26:14', NULL, NULL, '842f4A38BF1', '5423AD5b05a5d20Dd3C2\\user.png AND 5423AD5b05a5d20Dd3C2\\x320.png', NULL),
('8b1EFE2dFf0', 'Amani Nyumu', 'bDbEdcBDd49', 'amaninyumu@gmail.com', '0997257938', '$argon2i$v=19$m=65536,t=4,p=1$RkYvclFDWnFNZ3IwM0xtRA$k6QrB2CBoxC5UTJYHhzi5vuJBlKyjRIhEarbSa9fh0s', '2', 0, 1, 0, '2022-01-06', '16:05:29', NULL, NULL, 'bDbEdcBDd49', '0dc152bB4DC2AaA3DAdA\\user.png AND 0dc152bB4DC2AaA3DAdA\\x320.png', ''),
('8DDBf1922df', 'Lydia Kombi', 'CBA90c833b9', 'lidyakombi@gmail.com', '+243/993504644', '$argon2i$v=19$m=65536,t=4,p=1$Vm5xaEJkcVBBakxDSzNCcQ$YioswStZihG0E9cGXF9sIYBAsubKliSPxXvfOf79erY', '1', 0, 1, 0, '2022-03-09', '18:56:45', NULL, NULL, '8b1EFE2dFf0', 'C05a4205Acd5C0b2bb12\\user.png AND C05a4205Acd5C0b2bb12\\x320.png', NULL),
('a6d2e371Eb6', 'kapamba fils', 'DDfcF8DbE78', 'kapambafils@gmail.com', '+243/999555333', '$argon2i$v=19$m=65536,t=4,p=1$Qk43ZXdHOE1QUHdaYW9TLw$Jc/W7ZPUJUV7RXUUc0sSVWST1t9jLgGaDFPzLPRQKF4', '2', 0, 1, 0, '2022-03-04', '15:36:40', NULL, NULL, '842f4A38BF1', 'BC02e10cED10e203E2BE\\user.png AND BC02e10cED10e203E2BE\\x320.png', NULL),
('bDbEdcBDd49', 'Usalvagetrade', NULL, 'usalvagetrade@gmail.com', '+243819953172', '$argon2i$v=19$m=65536,t=4,p=1$TEpYa0VGN1NOY1hPbXpCTg$O7WHEyMeECzhSTNsnecLJLCMLunMlYZCNbHFebtCEq0', NULL, 0, 1, 0, '2022-01-01', '10:00:00', NULL, NULL, NULL, 'Bbc2Dd155ab2AbcAa5ee\\user.png AND Bbc2Dd155ab2AbcAa5ee\\x320.png', ''),
('bDCE14bD4F4', 'Agge child1', 'E19Eb606a9c', 'agechild1@gmail.com', '+243/888555999', '$argon2i$v=19$m=65536,t=4,p=1$YWNRRUNSNkQ2MnhOS0lvOQ$XzYSyCdao6TuSwKcgEqQtACni510e+gHXzESKfRmIjM', '1', 0, 1, 0, '2022-03-05', '22:02:52', NULL, NULL, '12c544e4b8d', 'DdC21ABddeCBb2d5abE3\\user.png AND DdC21ABddeCBb2d5abE3\\x320.png', NULL),
('CabA831C4Bd', 'Esaie Muhasa', 'bDbEdcBDd49', 'esaiemuhasa@gmail.com', '0972762881', '$argon2i$v=19$m=65536,t=4,p=1$aFFjNDdaUlJkQU4wTzlrUw$XtE5/PUWmvqeZzv0ASjX+k1Z0gjc4VN32U4WweF3WgA', '1', 0, 1, 0, '2022-01-06', '16:11:14', NULL, NULL, 'bDbEdcBDd49', '1bEe325EecC4a5114cED\\user.png AND 1bEe325EecC4a5114cED\\x320.png', ''),
('CBA90c833b9', 'TEST7', 'fb4AA75ddC5', 'kakulejn@gmail.com', '0826489483', '$argon2i$v=19$m=65536,t=4,p=1$cXdzblBySDIxNlFlY29SVQ$0CZTI9t55NmbHKH/rFciFy2DM2A/8X/9qZp0cPh2tmI', '2', 0, 0, 0, '2022-02-03', '05:36:12', NULL, NULL, 'bDbEdcBDd49', NULL, 'toACIgHGEdoZ1HKDS4FnBUwKzlaE4BWz3H2GoJarJVlbLzJ9LUodMpnB6gTQ'),
('ccd8D5Ea122', 'Ir Aggee', 'FCE3e062aFf', 'agger@gmail.com', '+243/998555444', '$argon2i$v=19$m=65536,t=4,p=1$dzd5Nm5UdmdHbHZOZk11Wg$5hSWCWdglVoDKdSV/pSplo/SOA2KHLL+Z3++1uAWQSs', '1', 0, 1, 0, '2022-03-10', '13:51:51', NULL, NULL, '12c544e4b8d', 'cEaAe0dEC4b4eBC10bAC\\user.png AND cEaAe0dEC4b4eBC10bAC\\x320.png', NULL),
('D53215AbdCd', 'TEST4', 'e8B456fFeB1', 'bileale73@gmail.com', '0974198084', '$argon2i$v=19$m=65536,t=4,p=1$WVdaaUlaenZOSDFsZEpGQg$h2o/RyK3gcSJYMkUSMVZg+IR+G4ouhfypkyrB0mhViY', '2', 0, 1, 1, '2022-02-01', '21:05:57', NULL, NULL, 'bDbEdcBDd49', '3eD5EBdCb0EB1ECEdDa1/user.png AND 3eD5EBdCb0EB1ECEdDa1/x320.png', NULL),
('DDfcF8DbE78', 'Kapamba ', '842f4A38BF1', 'kapamba@gmail.com', '+243992554477', '$argon2i$v=19$m=65536,t=4,p=1$aFlKTE1vLk1kUHp1bTRSSA$TYdU/MzzL9BUmg6e+DIK4Ww5clRHdi8UtLlRXK/qfN8', '2', 0, 1, 1, '2022-02-15', '19:13:44', NULL, NULL, '842f4A38BF1', '1DDAAebD5EEEeB5CC134/user.png AND 1DDAAebD5EEEeB5CC134/x320.png', NULL),
('E19Eb606a9c', 'Amani Nyumu', '12c544e4b8d', 'amaninyumu1@gmail.com', '0998556642', '$argon2i$v=19$m=65536,t=4,p=1$RFlrc2dVdjc0cFBlWENIbg$J3ADnj1NHWD3aUQ4JAk1useBptman0EuyixjTgdpPns', '1', 0, 1, 0, '2022-01-21', '16:49:49', NULL, NULL, 'bDbEdcBDd49', 'c1d2e0012BC24EB3CBe4/user.png AND c1d2e0012BC24EB3CBe4/x320.png', NULL),
('E46911fc126', 'TEST5', 'e8B456fFeB1', 'ernestmasirika5@gmail.com', '0978368263', '$argon2i$v=19$m=65536,t=4,p=1$YWoyV3p5U0Z1aVJmbS5Ceg$nsnPtbQ0WA2nU1tYQfpcvrn7Jlm9RLmRfwEOO6PRcqk', '1', 0, 1, 0, '2022-02-02', '05:38:14', NULL, NULL, 'bDbEdcBDd49', NULL, NULL),
('e8B456fFeB1', 'Amani Kambale', '12c544e4b8d', 'amaninyumu11@gmail.com', '0993504644', '$argon2i$v=19$m=65536,t=4,p=1$eVdZR3FzMXQyQTNQVFlFbA$swkkGXiRm24n8b/E7nbsm2ahiaMRcgpanIoSFforOtk', '2', 0, 1, 0, '2022-01-16', '12:15:48', NULL, NULL, 'bDbEdcBDd49', 'bDbCD1b5c2E4cDA0540E/user.png AND bDbCD1b5c2E4cDA0540E/x320.png', NULL),
('f76b98b816E', 'TEST8', 'CBA90c833b9', 'mulekyajeanpaul307@gmail.com', '+193747299379', '$argon2i$v=19$m=65536,t=4,p=1$TUFVdVUzS1BUZWVDdzhacw$1qM567u/9oy3ZFy2/C8x83/7PWEIoaK3BY3ppT7i1GE', '2', 0, 1, 0, '2022-02-09', '20:23:10', NULL, NULL, 'bDbEdcBDd49', NULL, NULL),
('fb4AA75ddC5', 'Amani Anykam', 'D53215AbdCd', 'amanikambale1212@gmail.com', '0997254455', '$argon2i$v=19$m=65536,t=4,p=1$ZzUySWZHbHl6U2hKQVBhag$Ec5YBHhGAvseKETQ6gTzZ3495zDNiNC+t4m+uUpmAcs', '2', 0, 1, 1, '2022-02-02', '17:33:08', NULL, NULL, 'bDbEdcBDd49', 'bb0BC1AaeA30EAC34453/user.png AND ', NULL),
('FCE3e062aFf', 'Agge child2', 'E19Eb606a9c', 'aggechild2@gmail.com', '+243/999555666', '$argon2i$v=19$m=65536,t=4,p=1$SnFsMXNZRWtFZEZWcFhlZg$6MiEfkvL40t/j2iLkRhKLxAYUKSjthN1D2vfLW3T3RU', '2', 0, 1, 0, '2022-03-06', '10:14:39', NULL, NULL, '12c544e4b8d', 'default\\user.jpg AND default\\x320.jpg', NULL),
('FFbf98Ab1dc', 'television', '20fA2d8Bc1a', 'television@gmail.com', '+243/985888222', '$argon2i$v=19$m=65536,t=4,p=1$NUhNb3BKWC8xVGplazVyOA$5VeM3Wzh+W8fbgroekGbSjjc/uMlQyQlrjmbrUi1gVw', '2', 0, 1, 0, '2022-03-10', '14:37:28', NULL, NULL, '20fA2d8Bc1a', '3Eb5DcC2ACDBde1EAe5e\\user.png AND 3Eb5DcC2ACDBde1EAe5e\\x320.png', NULL);

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
  ADD CONSTRAINT `return_invest_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
