-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 13, 2026 at 12:43 PM
-- Server version: 10.11.13-MariaDB-0ubuntu0.24.04.1
-- PHP Version: 8.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nebula_db`
--
DROP DATABASE IF EXISTS `nebula_db`;
CREATE DATABASE IF NOT EXISTS `nebula_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `nebula_db`;

-- --------------------------------------------------------

--
-- Table structure for table `Personnes`
--

CREATE TABLE `Personnes` (
  `Id` int(10) UNSIGNED NOT NULL,
  `Prenom` varchar(100) NOT NULL,
  `Nom` varchar(100) NOT NULL,
  `DateNaissance` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Personnes`
--

INSERT INTO `Personnes` (`Id`, `Prenom`, `Nom`, `DateNaissance`) VALUES
(1, 'Bhagya', 'M', '2007-08-25');

-- --------------------------------------------------------

--
-- Table structure for table `Taches`
--

CREATE TABLE `Taches` (
  `Id` int(10) UNSIGNED NOT NULL,
  `Titre` varchar(100) NOT NULL,
  `Description` varchar(150) NOT NULL,
  `idPersonne` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Taches`
--

INSERT INTO `Taches` (`Id`, `Titre`, `Description`, `idPersonne`) VALUES
(1, 'Ranger les assiettes', '', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Personnes`
--
ALTER TABLE `Personnes`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `Taches`
--
ALTER TABLE `Taches`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `fk_taches_personne` (`idPersonne`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Personnes`
--
ALTER TABLE `Personnes`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Taches`
--
ALTER TABLE `Taches`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Taches`
--
ALTER TABLE `Taches`
  ADD CONSTRAINT `fk_taches_personne` FOREIGN KEY (`idPersonne`) REFERENCES `Personnes` (`Id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
