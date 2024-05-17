-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2023 at 09:35 AM
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
-- Table structure for table `check_list`
--

CREATE TABLE `check_list` (
  `id_check_list` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `armada_id` varchar(11) NOT NULL,
  `supir_id` int(11) NOT NULL,
  `kernet_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `kebersihan_armada` varchar(11) NOT NULL,
  `kelayakan_box` varchar(11) NOT NULL,
  `tekanan_ban_depan` varchar(11) NOT NULL,
  `tekanan_ban_belakang_1` varchar(11) NOT NULL,
  `tekanan_ban_belakang_2` varchar(11) NOT NULL,
  `lampu_utama` varchar(11) NOT NULL,
  `lampu_kota` varchar(11) NOT NULL,
  `lampu_sein` varchar(11) NOT NULL,
  `level_oli` varchar(11) NOT NULL,
  `level_aki` varchar(11) NOT NULL,
  `kelayakan_ban` varchar(11) NOT NULL,
  `point` int(11) NOT NULL,
  `kelayakan` varchar(100) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `check_list`
--
ALTER TABLE `check_list`
  ADD PRIMARY KEY (`id_check_list`),
  ADD KEY `id_armada` (`armada_id`,`supir_id`,`kernet_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `armada_id` (`armada_id`,`supir_id`,`kernet_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `check_list`
--
ALTER TABLE `check_list`
  MODIFY `id_check_list` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
