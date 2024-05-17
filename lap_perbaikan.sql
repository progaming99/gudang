-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2023 at 09:33 AM
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
-- Table structure for table `lap_perbaikan`
--

CREATE TABLE `lap_perbaikan` (
  `id_perbaikan` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tgl_laporan` date NOT NULL,
  `armada_id` int(11) NOT NULL,
  `crew_id` int(11) NOT NULL,
  `jenis_kerusakan` varchar(100) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `tgl_pengerjaan` date NOT NULL,
  `montir_1` varchar(100) NOT NULL,
  `montir_2` varchar(100) NOT NULL,
  `level_kebutuhan_id` int(100) NOT NULL,
  `progress` varchar(100) NOT NULL,
  `tahapan` varchar(100) NOT NULL,
  `masalah` text NOT NULL,
  `rencana_selesai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `lama_pengerjaan` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lap_perbaikan`
--
ALTER TABLE `lap_perbaikan`
  ADD PRIMARY KEY (`id_perbaikan`),
  ADD KEY `id_armada` (`armada_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `id_level_kebutuhan` (`level_kebutuhan_id`),
  ADD KEY `id_crew` (`crew_id`),
  ADD KEY `crew_id` (`crew_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lap_perbaikan`
--
ALTER TABLE `lap_perbaikan`
  MODIFY `id_perbaikan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
