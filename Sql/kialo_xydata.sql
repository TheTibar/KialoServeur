-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 29 Mai 2019 à 18:11
-- Version du serveur :  5.7.11
-- Version de PHP :  7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `kialo`
--

-- --------------------------------------------------------

--
-- Structure de la table `kialo_xydata`
--

CREATE TABLE `kialo_xydata` (
  `id` bigint(20) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `position` point DEFAULT NULL,
  `latitude` decimal(9,6) NOT NULL,
  `longitude` decimal(9,6) NOT NULL,
  `water` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `kialo_xydata`
--

INSERT INTO `kialo_xydata` (`id`, `created_on`, `position`, `latitude`, `longitude`, `water`) VALUES
(17, '2019-05-29 13:32:52', NULL, '16.213732', '-61.461070', 1),
(18, '2019-05-29 15:07:32', NULL, '16.213732', '-61.461070', 1),
(19, '2019-05-29 09:10:08', NULL, '16.213732', '-61.461070', 1),
(20, '2019-05-29 05:48:58', NULL, '16.213732', '-61.461070', 0),
(21, '2019-05-29 18:08:38', NULL, '16.240236', '-61.591083', 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `kialo_xydata`
--
ALTER TABLE `kialo_xydata`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `kialo_xydata`
--
ALTER TABLE `kialo_xydata`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
