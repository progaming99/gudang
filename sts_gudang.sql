-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2024 at 02:11 AM
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
-- Table structure for table `aki`
--

CREATE TABLE `aki` (
  `id_aki` char(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `harga` decimal(10,0) NOT NULL,
  `merk` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `kondisi` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `stok` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aki`
--

INSERT INTO `aki` (`id_aki`, `harga`, `merk`, `kondisi`, `stok`, `supplier_id`) VALUES
('AK000001', '750000', 'Yuasa', 'Bekas', 1, 18),
('AK000002', '550000', 'GS', 'Bekas', 1, 19);

-- --------------------------------------------------------

--
-- Table structure for table `aki_keluar`
--

CREATE TABLE `aki_keluar` (
  `id_aki_keluar` char(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `aki_id` char(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `armada_id` int(11) NOT NULL,
  `supir_id` int(11) NOT NULL,
  `montir_id` int(11) NOT NULL,
  `jumlah_keluar` int(11) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `tgl_pasang_baru` date NOT NULL,
  `tgl_pasang_lama` date NOT NULL,
  `lama_pemakaian_hari` int(11) NOT NULL,
  `lama_pemakaian_tahun` int(11) NOT NULL,
  `masalah` varchar(100) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aki_keluar`
--

INSERT INTO `aki_keluar` (`id_aki_keluar`, `user_id`, `aki_id`, `armada_id`, `supir_id`, `montir_id`, `jumlah_keluar`, `tanggal_keluar`, `tgl_pasang_baru`, `tgl_pasang_lama`, `lama_pemakaian_hari`, `lama_pemakaian_tahun`, `masalah`, `keterangan`) VALUES
('T-AK-24052200001', 30, 'AK000001', 10, 9, 7, 2, '2024-05-22', '2024-05-22', '2024-05-23', 1, 0, '', '');

--
-- Triggers `aki_keluar`
--
DELIMITER $$
CREATE TRIGGER `update_stok_aki_keluar` BEFORE INSERT ON `aki_keluar` FOR EACH ROW UPDATE `aki` SET `aki`.`stok` = `aki`.`stok` - NEW.jumlah_keluar WHERE `aki`.`id_aki` = NEW.aki_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `aki_masuk`
--

CREATE TABLE `aki_masuk` (
  `id_aki_masuk` char(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `aki_id` char(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `supplier_id` char(30) NOT NULL,
  `jumlah_masuk` int(11) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `kondisi` varchar(50) NOT NULL,
  `harga` decimal(10,0) NOT NULL,
  `total_harga` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aki_masuk`
--

INSERT INTO `aki_masuk` (`id_aki_masuk`, `user_id`, `aki_id`, `supplier_id`, `jumlah_masuk`, `tanggal_masuk`, `kondisi`, `harga`, `total_harga`) VALUES
('T-AM-24052200001', 30, 'AK000001', 'rizky', 3, '2024-05-20', 'Bekas', '750000', '2250000'),
('T-AM-24061000001', 14, 'AK000002', 'CV INDAH', 1, '2024-06-10', 'Bekas', '550000', '550000');

--
-- Triggers `aki_masuk`
--
DELIMITER $$
CREATE TRIGGER `update_stok_aki_masuk` BEFORE INSERT ON `aki_masuk` FOR EACH ROW UPDATE `aki` SET `aki`.`stok` = `aki`.`stok` + NEW.jumlah_masuk WHERE `aki`.`id_aki` = NEW.aki_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `armada`
--

CREATE TABLE `armada` (
  `id_armada` int(11) NOT NULL,
  `nama_armada` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `armada`
--

INSERT INTO `armada` (`id_armada`, `nama_armada`) VALUES
(7, '1234'),
(8, '56565'),
(10, '5555'),
(12, '333333'),
(14, 'sd'),
(15, '1111');

-- --------------------------------------------------------

--
-- Table structure for table `ban`
--

CREATE TABLE `ban` (
  `id_ban` char(7) NOT NULL,
  `merk` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `ukuran` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `harga` varchar(100) NOT NULL,
  `satuan_id` int(11) NOT NULL,
  `jenis_id` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ban`
--

INSERT INTO `ban` (`id_ban`, `merk`, `type`, `ukuran`, `keterangan`, `harga`, `satuan_id`, `jenis_id`, `stok`, `supplier_id`) VALUES
('B000001', 'Dunlop', 'Vulkanisir', 34, '', '400000', 0, 0, 1, 19),
('B000002', 'Pirelli', 'Vulkanisir', 55, '', '550000', 0, 0, 3, 18);

-- --------------------------------------------------------

--
-- Table structure for table `ban_keluar`
--

CREATE TABLE `ban_keluar` (
  `id_ban_keluar` char(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ban_id` char(30) NOT NULL,
  `armada_id` int(11) NOT NULL,
  `supir_id` int(11) NOT NULL,
  `montir_id` int(11) NOT NULL,
  `jumlah_keluar` int(11) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `tgl_pasang` date NOT NULL,
  `tgl_ganti` date NOT NULL,
  `rencana_ganti` date NOT NULL,
  `no_posisi` int(11) NOT NULL,
  `no_seri_baru` varchar(100) NOT NULL,
  `no_seri_lama` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ban_keluar`
--

INSERT INTO `ban_keluar` (`id_ban_keluar`, `user_id`, `ban_id`, `armada_id`, `supir_id`, `montir_id`, `jumlah_keluar`, `tanggal_keluar`, `tgl_pasang`, `tgl_ganti`, `rencana_ganti`, `no_posisi`, `no_seri_baru`, `no_seri_lama`) VALUES
('T-BK-24052200001', 30, 'B000001', 8, 5, 7, 1, '2024-05-21', '2024-05-23', '2024-05-28', '2024-05-17', 5, 'as22e', 'gg3331');

--
-- Triggers `ban_keluar`
--
DELIMITER $$
CREATE TRIGGER `update_stok_ban_keluar` BEFORE INSERT ON `ban_keluar` FOR EACH ROW UPDATE `ban` SET `ban`.`stok` = `ban`.`stok` - NEW.jumlah_keluar WHERE `ban`.`id_ban` = NEW.ban_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ban_masuk`
--

CREATE TABLE `ban_masuk` (
  `id_ban_masuk` char(16) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ban_id` char(7) NOT NULL,
  `jumlah_masuk` int(11) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `total_harga` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ban_masuk`
--

INSERT INTO `ban_masuk` (`id_ban_masuk`, `user_id`, `ban_id`, `jumlah_masuk`, `tanggal_masuk`, `total_harga`) VALUES
('T-BM-24052200001', 30, 'B000001', 2, '2024-05-22', '800000'),
('T-BM-24052200002', 30, 'B000002', 3, '2024-05-22', '1650000');

--
-- Triggers `ban_masuk`
--
DELIMITER $$
CREATE TRIGGER `update_stok_ban_masuk` BEFORE INSERT ON `ban_masuk` FOR EACH ROW UPDATE `ban` SET `ban`.`stok` = `ban`.`stok` + NEW.jumlah_masuk WHERE `ban`.`id_ban` = NEW.ban_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` char(7) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga` decimal(16,0) NOT NULL,
  `stok` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `harga`, `stok`, `supplier_id`) VALUES
('S000001', 'asd', '400000', 0, 19),
('S000002', 'Gardan', '550000', 12, 19),
('S000003', 'sembarang', '40000', 6, 20);

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id_barang_keluar` char(16) NOT NULL,
  `barang_masuk_id` char(40) NOT NULL,
  `user_id` int(11) NOT NULL,
  `barang_id` char(7) NOT NULL,
  `id_armada` int(11) NOT NULL,
  `id_supir` int(11) NOT NULL,
  `id_montir` int(11) NOT NULL,
  `jumlah_keluar` int(11) NOT NULL,
  `tanggal_keluar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Triggers `barang_keluar`
--
DELIMITER $$
CREATE TRIGGER `update_stok_keluar` BEFORE INSERT ON `barang_keluar` FOR EACH ROW UPDATE `barang` SET `barang`.`stok` = `barang`.`stok` - NEW.jumlah_keluar WHERE `barang`.`id_barang` = NEW.barang_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id_barang_masuk` char(16) NOT NULL,
  `user_id` int(11) NOT NULL,
  `barang_id` char(7) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `jumlah_masuk` int(11) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `harga` decimal(10,0) NOT NULL,
  `total_harga` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`id_barang_masuk`, `user_id`, `barang_id`, `supplier_id`, `jumlah_masuk`, `tanggal_masuk`, `harga`, `total_harga`) VALUES
('T-SM-23100700003', 27, 'S000003', 0, 1, '2023-10-06', '0', '2500000'),
('T-SM-23101800001', 14, 'S000006', 0, 1, '2023-10-18', '0', '100000'),
('T-SM-23101800002', 14, 'S000008', 0, 2, '2023-10-18', '0', '200000'),
('T-SM-23101800003', 14, 'S000006', 0, 1, '2023-10-18', '0', '100000'),
('T-SM-23101800004', 14, 'S000010', 0, 3, '2023-10-18', '0', '7500000'),
('T-SM-23101800005', 14, 'S000008', 0, 2, '2023-10-18', '0', '200000'),
('T-SM-23101800006', 14, 'S000009', 0, 3, '2023-10-18', '0', '7500000'),
('T-SM-23101800007', 14, 'S000011', 0, 1, '2023-10-18', '0', '60000'),
('T-SM-23101800008', 14, 'S000012', 0, 2, '2023-10-18', '0', '1000000'),
('T-SM-23102700001', 28, 'S000001', 0, 3, '2023-10-27', '0', '300000'),
('T-SM-24061000001', 14, 'S000002', 0, 1, '2024-06-10', '0', '550000'),
('T-SM-24061100001', 14, 'S000002', 0, 1, '2024-06-11', '0', '550000');

--
-- Triggers `barang_masuk`
--
DELIMITER $$
CREATE TRIGGER `update_stok_masuk` BEFORE INSERT ON `barang_masuk` FOR EACH ROW UPDATE `barang` SET `barang`.`stok` = `barang`.`stok` + NEW.jumlah_masuk WHERE `barang`.`id_barang` = NEW.barang_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `check_list`
--

CREATE TABLE `check_list` (
  `id_check_list` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `armada_id` int(11) NOT NULL,
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
  `catatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `check_list`
--

INSERT INTO `check_list` (`id_check_list`, `tanggal`, `armada_id`, `supir_id`, `kernet_id`, `user_id`, `kebersihan_armada`, `kelayakan_box`, `tekanan_ban_depan`, `tekanan_ban_belakang_1`, `tekanan_ban_belakang_2`, `lampu_utama`, `lampu_kota`, `lampu_sein`, `level_oli`, `level_aki`, `kelayakan_ban`, `point`, `kelayakan`, `catatan`) VALUES
(26, '2023-12-18', 8, 5, 4, 14, 'OK', 'OK', 'NO', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 0, 'TIDAK LAYAK JALAN', 'qwerty'),
(27, '2023-12-17', 12, 9, 6, 14, 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 'OK', 0, 'LAYAK JALAN', 'sembarang 123');

-- --------------------------------------------------------

--
-- Table structure for table `check_list_armada`
--

CREATE TABLE `check_list_armada` (
  `id_check_list_armada` int(11) NOT NULL,
  `tgl_laporan` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `armada_id` int(11) NOT NULL,
  `montir_1` varchar(100) NOT NULL,
  `montir_2` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `check_list_armada`
--

INSERT INTO `check_list_armada` (`id_check_list_armada`, `tgl_laporan`, `user_id`, `armada_id`, `montir_1`, `montir_2`, `image`, `keterangan`) VALUES
(25, '2024-02-17', 14, 7, 'eeeeeee', '', '1aa5c815-863d-4e79-b3ba-fbead262ec39.jpeg', 'ww'),
(26, '2024-02-17', 14, 12, 'rrrrrr', 'eeeeeee', '64f96f10-802d-4a88-8ed8-3c46a544f8f2.jpeg', 'rrr'),
(27, '2024-02-15', 14, 10, 'eeeeeee', '', '814c0a7c-1512-441f-b5a2-7995920aca61.jpeg', 'rrrrrrr');

-- --------------------------------------------------------

--
-- Table structure for table `crew`
--

CREATE TABLE `crew` (
  `id_crew` int(11) NOT NULL,
  `nama_crew` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crew`
--

INSERT INTO `crew` (`id_crew`, `nama_crew`) VALUES
(9, '321'),
(10, '100');

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE `jenis` (
  `id_jenis` int(11) NOT NULL,
  `nama_jenis` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `jenis`
--

INSERT INTO `jenis` (`id_jenis`, `nama_jenis`) VALUES
(19, 'gardan'),
(20, 'sembarang');

-- --------------------------------------------------------

--
-- Table structure for table `kernet`
--

CREATE TABLE `kernet` (
  `id_kernet` int(11) NOT NULL,
  `nama_kernet` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kernet`
--

INSERT INTO `kernet` (`id_kernet`, `nama_kernet`) VALUES
(4, '123q'),
(5, 'test nama kernet'),
(6, 'sembarang');

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
-- Dumping data for table `lap_perbaikan`
--

INSERT INTO `lap_perbaikan` (`id_perbaikan`, `user_id`, `tgl_laporan`, `armada_id`, `crew_id`, `jenis_kerusakan`, `tgl_masuk`, `tgl_pengerjaan`, `montir_1`, `montir_2`, `level_kebutuhan_id`, `progress`, `tahapan`, `masalah`, `rencana_selesai`, `tgl_selesai`, `lama_pengerjaan`, `status`) VALUES
(19, 14, '2024-01-03', 8, 9, 'test', '2024-01-25', '2024-01-09', 'eeeeeee', '4', 1, 'test', '2', 'sd', '2024-01-12', '0000-00-00', 2, 'Belum Selesai'),
(20, 14, '2024-01-05', 10, 10, 'test', '2024-01-11', '2024-01-23', 'eeeeeee', 'edi sugiarto', 3, 'we', '3', 'sd', '2024-01-05', '0000-00-00', 3, 'Belum Selesai');

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

-- --------------------------------------------------------

--
-- Table structure for table `montir`
--

CREATE TABLE `montir` (
  `id_montir` int(11) NOT NULL,
  `nama_montir` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `montir`
--

INSERT INTO `montir` (`id_montir`, `nama_montir`) VALUES
(4, 'edi sugiarto'),
(6, 'eeeeeee'),
(7, 'rrrrrr'),
(8, 'qwerty');

-- --------------------------------------------------------

--
-- Table structure for table `oli`
--

CREATE TABLE `oli` (
  `id_oli` char(10) NOT NULL,
  `nama_oli` varchar(100) NOT NULL,
  `harga` decimal(17,0) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `oli`
--

INSERT INTO `oli` (`id_oli`, `nama_oli`, `harga`, `supplier_id`, `stok`) VALUES
('O000001', 'Oli GIGA', '500000', 18, 5),
('O000002', 'Oli CDD', '600000', 19, 6),
('O000003', 'Oli L300', '450000', 19, 6),
('O000004', 'Oli CDE', '725000', 20, 490);

-- --------------------------------------------------------

--
-- Table structure for table `oli_keluar`
--

CREATE TABLE `oli_keluar` (
  `id_oli_keluar` char(16) NOT NULL,
  `oli_masuk_id` char(40) NOT NULL,
  `user_id` int(11) NOT NULL,
  `oli_id` char(16) NOT NULL,
  `id_armada` int(11) NOT NULL,
  `jumlah_keluar` int(11) NOT NULL,
  `tanggal_keluar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `oli_keluar`
--

INSERT INTO `oli_keluar` (`id_oli_keluar`, `oli_masuk_id`, `user_id`, `oli_id`, `id_armada`, `jumlah_keluar`, `tanggal_keluar`) VALUES
('T-OK-24061000001', 'T-OM-24060700003', 30, '', 12, 1, '2024-06-10'),
('T-OK-24061000002', 'T-OM-24060700003', 30, '', 12, 1, '2024-06-10'),
('T-OK-24061000003', 'T-OM-24060700003', 30, '', 10, 10, '2024-06-10'),
('T-OK-24061000004', 'T-OM-24060700003', 30, '', 10, 1, '2024-06-10'),
('T-OK-24061000005', 'T-OM-24060700002', 30, '', 12, 4, '2024-06-10'),
('T-OK-24061000006', 'T-OM-24060700003', 30, '', 14, 5, '2024-06-10'),
('T-OK-24061000007', 'T-OM-24060700003', 30, 'O000003', 12, 5, '2024-06-10'),
('T-OK-24061000008', 'T-OM-24060700003', 30, 'O000003', 10, 1, '2024-06-10'),
('T-OK-24061000009', 'T-OM-24060700003', 30, '', 14, 8, '2024-06-10'),
('T-OK-24061000010', 'T-OM-24060700003', 30, '', 12, 8, '2024-06-10'),
('T-OK-24061000011', 'T-OM-24060700003', 30, 'O000003', 10, 2, '2024-06-10'),
('T-OK-24061000012', 'T-OM-24060700002', 30, 'O000002', 10, 10, '2024-06-10'),
('T-OK-24061000013', 'T-OM-24060700001', 30, 'O000001', 10, 4, '2024-06-10'),
('T-OK-24061000014', 'T-OM-24060700002', 14, 'O000002', 12, 1, '2024-06-10'),
('T-OK-24061100001', 'T-OM-24060700003', 14, 'O000003', 14, 1, '2024-06-11'),
('T-OL-24060700001', 'T-OM-24060700001', 14, 'O000001', 7, 1, '2024-06-07'),
('T-OL-24060700002', 'T-OM-24060700002', 14, 'O000002', 12, 1, '2024-06-06'),
('T-OL-24060700003', 'T-OM-24060700003', 14, 'O000003', 12, 1, '2024-06-08'),
('T-OL-24061000001', 'T-OM-24060700001', 14, 'O000001', 10, 1, '2024-06-15'),
('T-OL-24061000002', 'T-OM-24061000002', 14, 'O000004', 7, 10, '2024-06-10');

--
-- Triggers `oli_keluar`
--
DELIMITER $$
CREATE TRIGGER `update_stok_oli_keluar` BEFORE INSERT ON `oli_keluar` FOR EACH ROW UPDATE `oli` SET `oli`.`stok` = `oli`.`stok` - NEW.jumlah_keluar WHERE `oli`.`id_oli` = NEW.oli_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `oli_masuk`
--

CREATE TABLE `oli_masuk` (
  `id_oli_masuk` char(16) NOT NULL,
  `user_id` int(11) NOT NULL,
  `oli_id` char(16) NOT NULL,
  `jumlah_masuk` int(11) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `harga` decimal(13,0) NOT NULL,
  `total_harga` decimal(13,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `oli_masuk`
--

INSERT INTO `oli_masuk` (`id_oli_masuk`, `user_id`, `oli_id`, `jumlah_masuk`, `tanggal_masuk`, `harga`, `total_harga`) VALUES
('T-OM-24060700001', 14, 'O000001', 1, '2024-06-07', '500000', '500000'),
('T-OM-24060700002', 14, 'O000002', 10, '2024-06-05', '600000', '6000000'),
('T-OM-24060700003', 14, 'O000003', 2, '2024-06-01', '450000', '900000'),
('T-OM-24061000001', 14, 'O000001', 1, '2024-06-14', '500000', '500000'),
('T-OM-24061000002', 14, 'O000004', 500, '2024-06-09', '725000', '362500000'),
('T-OM-24061000003', 30, 'O000003', 1, '2024-06-10', '450000', '450000'),
('T-OM-24061000004', 30, 'O000003', 4, '2024-06-10', '450000', '1800000'),
('T-OM-24061000005', 30, 'O000002', 3, '2024-06-10', '600000', '1800000');

--
-- Triggers `oli_masuk`
--
DELIMITER $$
CREATE TRIGGER `update_stok_oli_masuk` BEFORE INSERT ON `oli_masuk` FOR EACH ROW UPDATE `oli` SET `oli`.`stok` = `oli`.`stok` + NEW.jumlah_masuk WHERE `oli`.`id_oli` = NEW.oli_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `id_satuan` int(11) NOT NULL,
  `nama_satuan` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`id_satuan`, `nama_satuan`) VALUES
(12, 'unit');

-- --------------------------------------------------------

--
-- Table structure for table `supir`
--

CREATE TABLE `supir` (
  `id_supir` int(11) NOT NULL,
  `nama_supir` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supir`
--

INSERT INTO `supir` (`id_supir`, `nama_supir`) VALUES
(5, 'Jaka123'),
(8, 'test nama supir'),
(9, 'supir sembarang');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(50) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `no_telp`, `alamat`) VALUES
(18, 'rizky', '9892339', 'semarang'),
(19, 'CV INDAH', '021812389082', 'Semarang'),
(20, 'Sumber Rejo', '08128329847', 'Temanggung');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `role` enum('gudang','admin','finance') NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` int(11) NOT NULL,
  `foto` text NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `email`, `no_telp`, `role`, `password`, `created_at`, `foto`, `is_active`) VALUES
(14, 'Andika IT', 'andika99', 'progaming99.as48@gmail.com', '081287735520', 'admin', '$2y$10$XBkwvbZOP8chZwOmDbhvmOqYRtoT8snMo1PFkOuZN1bJ64fIKJKD.', 1692440826, 'ddadf8cfa8c167a14a3d48f8c615e92f.jpg', 1),
(29, 'wewe', 'tester', '', '33', 'finance', '$2y$10$IaA27hXWPl3GyJ/sB.s0YOqupSjLndLXAZK.M/9UzIPGrDdCdo9Ji', 1700643362, 'user.png', 1),
(30, 'test', 'test123', '', '00123231231', 'gudang', '$2y$10$0X71FUtdQ8scVpDMLZj1cOxVwK7XRJhGSzdpBLgwdAM5GWHtNSbuq', 1714638108, 'user.png', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aki`
--
ALTER TABLE `aki`
  ADD PRIMARY KEY (`id_aki`),
  ADD UNIQUE KEY `merk` (`merk`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `aki_keluar`
--
ALTER TABLE `aki_keluar`
  ADD PRIMARY KEY (`id_aki_keluar`),
  ADD KEY `user_id` (`user_id`,`aki_id`,`armada_id`,`supir_id`,`montir_id`),
  ADD KEY `montir_id` (`montir_id`);

--
-- Indexes for table `aki_masuk`
--
ALTER TABLE `aki_masuk`
  ADD PRIMARY KEY (`id_aki_masuk`),
  ADD KEY `supplier_id` (`user_id`,`aki_id`),
  ADD KEY `supplier_id_2` (`supplier_id`);

--
-- Indexes for table `armada`
--
ALTER TABLE `armada`
  ADD PRIMARY KEY (`id_armada`);

--
-- Indexes for table `ban`
--
ALTER TABLE `ban`
  ADD PRIMARY KEY (`id_ban`),
  ADD KEY `satuan_id` (`satuan_id`),
  ADD KEY `jenis_id` (`jenis_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `ban_keluar`
--
ALTER TABLE `ban_keluar`
  ADD PRIMARY KEY (`id_ban_keluar`),
  ADD KEY `user_id` (`user_id`,`ban_id`,`armada_id`,`supir_id`,`montir_id`),
  ADD KEY `montir_id` (`montir_id`);

--
-- Indexes for table `ban_masuk`
--
ALTER TABLE `ban_masuk`
  ADD PRIMARY KEY (`id_ban_masuk`),
  ADD KEY `supplier_id` (`user_id`,`ban_id`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD UNIQUE KEY `nama_barang` (`nama_barang`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id_barang_keluar`),
  ADD KEY `id_user` (`user_id`),
  ADD KEY `barang_id` (`barang_id`),
  ADD KEY `id_armada` (`id_armada`),
  ADD KEY `id_supir` (`id_supir`),
  ADD KEY `id_montir` (`id_montir`),
  ADD KEY `barang_masuk_id` (`barang_masuk_id`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD KEY `user_id` (`user_id`,`barang_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `check_list`
--
ALTER TABLE `check_list`
  ADD PRIMARY KEY (`id_check_list`),
  ADD KEY `id_armada` (`armada_id`,`supir_id`,`kernet_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `armada_id` (`armada_id`,`supir_id`,`kernet_id`);

--
-- Indexes for table `check_list_armada`
--
ALTER TABLE `check_list_armada`
  ADD PRIMARY KEY (`id_check_list_armada`),
  ADD KEY `user_id` (`user_id`,`armada_id`);

--
-- Indexes for table `crew`
--
ALTER TABLE `crew`
  ADD PRIMARY KEY (`id_crew`);

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `kernet`
--
ALTER TABLE `kernet`
  ADD PRIMARY KEY (`id_kernet`);

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
-- Indexes for table `level_kebutuhan`
--
ALTER TABLE `level_kebutuhan`
  ADD PRIMARY KEY (`id_level_kebutuhan`);

--
-- Indexes for table `montir`
--
ALTER TABLE `montir`
  ADD PRIMARY KEY (`id_montir`);

--
-- Indexes for table `oli`
--
ALTER TABLE `oli`
  ADD PRIMARY KEY (`id_oli`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `oli_keluar`
--
ALTER TABLE `oli_keluar`
  ADD PRIMARY KEY (`id_oli_keluar`),
  ADD UNIQUE KEY `id_oli_keluar` (`id_oli_keluar`,`oli_masuk_id`),
  ADD KEY `user_id` (`user_id`,`oli_id`),
  ADD KEY `id_armada` (`id_armada`),
  ADD KEY `oli_masuk_id` (`oli_masuk_id`);

--
-- Indexes for table `oli_masuk`
--
ALTER TABLE `oli_masuk`
  ADD PRIMARY KEY (`id_oli_masuk`),
  ADD KEY `user_id` (`user_id`,`oli_id`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `supir`
--
ALTER TABLE `supir`
  ADD PRIMARY KEY (`id_supir`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `armada`
--
ALTER TABLE `armada`
  MODIFY `id_armada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `check_list`
--
ALTER TABLE `check_list`
  MODIFY `id_check_list` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `check_list_armada`
--
ALTER TABLE `check_list_armada`
  MODIFY `id_check_list_armada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `crew`
--
ALTER TABLE `crew`
  MODIFY `id_crew` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `kernet`
--
ALTER TABLE `kernet`
  MODIFY `id_kernet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `lap_perbaikan`
--
ALTER TABLE `lap_perbaikan`
  MODIFY `id_perbaikan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `level_kebutuhan`
--
ALTER TABLE `level_kebutuhan`
  MODIFY `id_level_kebutuhan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `montir`
--
ALTER TABLE `montir`
  MODIFY `id_montir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `supir`
--
ALTER TABLE `supir`
  MODIFY `id_supir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD CONSTRAINT `barang_keluar_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_keluar_ibfk_2` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
