-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2023 at 11:45 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_barang`
--

-- --------------------------------------------------------

--
-- Table structure for table `aki`
--

CREATE TABLE `aki` (
  `id_aki` int(11) NOT NULL,
  `nomor_armada` varchar(100) NOT NULL,
  `nama_supir` varchar(100) NOT NULL,
  `tanggal_pasang_baru` date NOT NULL,
  `tanggal_pasang_lama` date NOT NULL,
  `lama_pemakaian_hari` varchar(100) NOT NULL,
  `lama_pemakaian_tahun` varchar(100) NOT NULL,
  `masalah` varchar(100) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aki`
--

INSERT INTO `aki` (`id_aki`, `nomor_armada`, `nama_supir`, `tanggal_pasang_baru`, `tanggal_pasang_lama`, `lama_pemakaian_hari`, `lama_pemakaian_tahun`, `masalah`, `keterangan`) VALUES
(1, '898989', 'Jaka', '2023-08-16', '2023-08-23', '434', '3', 'aman', 'tidak ada kendala'),
(3, '8421', 'Budi', '2023-08-09', '2023-08-30', '333', '3', 'aman', 'tidak ada kendala');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aki`
--
ALTER TABLE `aki`
  ADD PRIMARY KEY (`id_aki`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aki`
--
ALTER TABLE `aki`
  MODIFY `id_aki` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
