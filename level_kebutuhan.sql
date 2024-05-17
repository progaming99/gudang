-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2023 at 09:34 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sts_gudang`
--

-- --------------------------------------------------------

--
-- Table structure for table `level_kebutuhan`
--

CREATE TABLE `level_kebutuhan` (
  `id_level_kebutuhan` int(11) NOT NULL,
  `nama_level` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `level_kebutuhan`
--

INSERT INTO `level_kebutuhan` (`id_level_kebutuhan`, `nama_level`) VALUES
(1, 'URGENT'),
(2, 'MEDIUM'),
(3, 'NOT URGENT');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `level_kebutuhan`
--
ALTER TABLE `level_kebutuhan`
  ADD PRIMARY KEY (`id_level_kebutuhan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `level_kebutuhan`
--
ALTER TABLE `level_kebutuhan`
  MODIFY `id_level_kebutuhan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
