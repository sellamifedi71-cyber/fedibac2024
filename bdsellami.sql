-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2026 at 06:37 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bdsellami`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE `categorie` (
  `codeCat` int(11) NOT NULL,
  `libelle` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`codeCat`, `libelle`) VALUES
(1, 'Robe de soirée'),
(2, 'Robe de mariée'),
(3, 'Caftan'),
(4, 'Costume'),
(5, 'Jebba');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `cin` varchar(8) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `tel` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`cin`, `nom`, `tel`) VALUES
('02222222', 'Olfa Fourati', '13131313'),
('11111111', 'Maysa Abidi', '12121212'),
('13333333', 'Sami Dridi', '14141414');

-- --------------------------------------------------------

--
-- Table structure for table `habit`
--

CREATE TABLE `habit` (
  `codeHab` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `taille` char(1) NOT NULL,
  `prix` int(11) NOT NULL,
  `disponible` char(1) NOT NULL DEFAULT 'D',
  `codeCat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `habit`
--

INSERT INTO `habit` (`codeHab`, `description`, `taille`, `prix`, `disponible`, `codeCat`) VALUES
(1, 'Blouza et fouta caramel', 'X', 123, 'D', 2),
(2, 'Blouza et fouta argentees', 'M', 150, 'N', 2),
(3, 'Caftan velour', 'L', 145, 'D', 3),
(4, 'Costume kamraya beige', 'X', 222, 'N', 4),
(5, 'Costume kamraya blanc', 'S', 111, 'D', 4),
(6, 'Catfan avec broderie', 'M', 222, 'D', 3),
(7, 'Robe longue en crepe', 'M', 222, 'D', 1),
(8, 'Robe sirene en soie bleu', 'L', 300, 'D', 1);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `dateLoc` date NOT NULL,
  `codeHab` int(11) NOT NULL,
  `cin` varchar(8) NOT NULL,
  `duree` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`dateLoc`, `codeHab`, `cin`, `duree`) VALUES
('2023-05-21', 2, '02222222', 3),
('2023-05-22', 4, '13333333', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`codeCat`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`cin`);

--
-- Indexes for table `habit`
--
ALTER TABLE `habit`
  ADD PRIMARY KEY (`codeHab`),
  ADD KEY `codeCat` (`codeCat`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`dateLoc`,`codeHab`),
  ADD KEY `cin` (`cin`),
  ADD KEY `fk2` (`codeHab`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `habit`
--
ALTER TABLE `habit`
  MODIFY `codeHab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `habit`
--
ALTER TABLE `habit`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`codeCat`) REFERENCES `categorie` (`codeCat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `fk2` FOREIGN KEY (`codeHab`) REFERENCES `habit` (`codeHab`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
