-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2023 at 11:43 AM
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
  `satuan_id` int(11) NOT NULL,
  `jenis_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aki`
--

INSERT INTO `aki` (`id_aki`, `harga`, `merk`, `kondisi`, `stok`, `satuan_id`, `jenis_id`, `supplier_id`) VALUES
('AK000004', '250000', 'Motobatt', 'Baru', 2, 0, 0, 14),
('AK000005', '760000', 'Yuasa', 'Bekas', 1, 0, 0, 6);

-- --------------------------------------------------------

--
-- Table structure for table `aki_keluar`
--

CREATE TABLE `aki_keluar` (
  `id_aki_keluar` char(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `aki_id` char(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `id_armada` int(11) NOT NULL,
  `id_supir` int(11) NOT NULL,
  `id_montir` int(11) NOT NULL,
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

INSERT INTO `aki_keluar` (`id_aki_keluar`, `user_id`, `aki_id`, `id_armada`, `id_supir`, `id_montir`, `jumlah_keluar`, `tanggal_keluar`, `tgl_pasang_baru`, `tgl_pasang_lama`, `lama_pemakaian_hari`, `lama_pemakaian_tahun`, `masalah`, `keterangan`) VALUES
('T-AK-23100600005', 14, 'AK000002', 1, 1, 1, 1, '2023-10-05', '2023-10-01', '2023-10-06', 5, 0, '', ''),
('T-AK-23100900003', 14, 'AK000001', 1, 1, 1, 1, '2023-10-09', '2023-10-09', '2024-12-26', 444, 1, '', ''),
('T-AK-23101700001', 14, 'AK000002', 1, 1, 1, 1, '2023-10-18', '2023-10-18', '2023-06-07', -133, 0, '', ''),
('T-AK-23101800001', 14, 'AK000004', 1, 1, 1, 1, '2023-10-18', '2023-10-18', '2023-10-27', 9, 0, '', '');

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
  `jumlah_masuk` int(11) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `kondisi` varchar(50) NOT NULL,
  `harga` decimal(10,0) NOT NULL,
  `total_harga` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aki_masuk`
--

INSERT INTO `aki_masuk` (`id_aki_masuk`, `user_id`, `aki_id`, `jumlah_masuk`, `tanggal_masuk`, `kondisi`, `harga`, `total_harga`) VALUES
('T-AM-23092900001', 14, 'AK000026', 1, '2023-09-29', 'Bekas', '250000', '250000'),
('T-AM-23092900002', 14, 'AK000026', 5, '2023-09-30', 'Baru', '100000', '1250000'),
('T-AM-23100600001', 14, 'AK000001', 1, '2023-10-05', 'Baru', '1250000', '800000'),
('T-AM-23100600002', 14, 'AK000001', 3, '2023-10-18', 'Baru', '250000', '2400000'),
('T-AM-23100600005', 14, 'AK000003', 1, '2023-10-06', 'Baru', '60000', '100000'),
('T-AM-23100600006', 14, 'AK000003', 2, '2023-10-06', 'Baru', '250000', '200000'),
('T-AM-23100900001', 14, 'AK000001', 1, '2023-10-10', 'Baru', '850000', '800000'),
('T-AM-23100900002', 14, 'AK000001', 1, '2023-10-17', 'Bekas', '800000', '800000'),
('T-AM-23100900003', 14, 'AK000001', 1, '2023-10-17', 'Baru', '800000', '800000'),
('T-AM-23101000001', 14, 'AK000003', 2, '2023-10-10', '', '750000', '1500000'),
('T-AM-23101800001', 14, 'AK000004', 2, '2023-10-18', '', '250000', '500000'),
('T-AM-23101800002', 14, 'AK000004', 1, '2023-10-18', '', '250000', '250000'),
('T-AM-23101800003', 14, 'AK000004', 1, '2023-10-18', '', '250000', '250000'),
('T-AM-23101800004', 14, 'AK000005', 1, '2023-10-18', '', '760000', '760000');

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
(1, '9922'),
(2, '1232');

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
('B000005', 'IRC', 'ORI', 355, '', '727000', 0, 0, 2, 1),
('B000006', 'Aspira', 'Vulkanisir', 455, '', '100000', 0, 0, 5, 1),
('B000007', 'Corsa', 'ORI', 450, '', '850000', 0, 0, 2, 14);

-- --------------------------------------------------------

--
-- Table structure for table `ban_keluar`
--

CREATE TABLE `ban_keluar` (
  `id_ban_keluar` char(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ban_id` char(30) NOT NULL,
  `id_armada` int(11) NOT NULL,
  `id_supir` int(11) NOT NULL,
  `id_montir` int(11) NOT NULL,
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

INSERT INTO `ban_keluar` (`id_ban_keluar`, `user_id`, `ban_id`, `id_armada`, `id_supir`, `id_montir`, `jumlah_keluar`, `tanggal_keluar`, `tgl_pasang`, `tgl_ganti`, `rencana_ganti`, `no_posisi`, `no_seri_baru`, `no_seri_lama`) VALUES
('T-BK-23100600001', 14, 'B000001', 1, 1, 1, 1, '2023-10-19', '2023-10-18', '2023-11-01', '2023-10-26', 6, 'NS239293', 'BN55298s'),
('T-BK-23100700001', 27, 'B000001', 1, 1, 1, 1, '2023-10-06', '2023-10-13', '2023-10-13', '2023-10-19', 2, 'NS23338k', 'BN232asd'),
('T-BK-23100900001', 14, 'B000003', 1, 1, 1, 1, '2023-10-10', '2023-10-09', '2024-12-28', '0000-00-00', 8, 'NS23928k', 'BN23298s'),
('T-BK-23101800001', 14, 'B000005', 2, 1, 1, 1, '2023-10-18', '2023-10-18', '2023-10-25', '2023-10-20', 5, 'NS23338k', 'BN232asd');

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
('T-BM-23100600001', 14, 'B000001', 2, '2023-10-18', '1400000'),
('T-BM-23100600002', 14, 'B000003', 1, '2023-10-06', '625000'),
('T-BM-23100900001', 14, 'B000003', 1, '2023-10-10', '625000'),
('T-BM-23100900002', 14, 'B000004', 2, '2023-10-10', '2400000'),
('T-BM-23101700001', 14, 'B000001', 1, '2023-10-17', '700000'),
('T-BM-23101700002', 14, 'B000006', 3, '2023-10-17', '300000'),
('T-BM-23101800001', 14, 'B000005', 2, '2023-10-18', '1450000'),
('T-BM-23101800002', 14, 'B000006', 2, '2023-10-18', '200000'),
('T-BM-23101800003', 14, 'B000007', 2, '2023-10-18', '1700000');

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
  `satuan_id` int(11) NOT NULL,
  `jenis_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `harga`, `stok`, `satuan_id`, `jenis_id`, `supplier_id`) VALUES
('S000006', 'Minyak Rem', '100000', 1, 3, 12, 7),
('S000008', 'Lampu Sein', '100000', 2, 2, 12, 6),
('S000009', 'Perseneling', '2500000', 3, 1, 12, 6),
('S000010', 'Gardan', '2500000', 3, 1, 12, 7),
('S000011', 'Lampu Sein LED', '60000', 1, 2, 12, 1),
('S000012', 'Jok L300', '500000', 2, 1, 15, 10);

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id_barang_keluar` char(16) NOT NULL,
  `user_id` int(11) NOT NULL,
  `barang_id` char(7) NOT NULL,
  `id_armada` int(11) NOT NULL,
  `id_supir` int(11) NOT NULL,
  `id_montir` int(11) NOT NULL,
  `jumlah_keluar` int(11) NOT NULL,
  `tanggal_keluar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`id_barang_keluar`, `user_id`, `barang_id`, `id_armada`, `id_supir`, `id_montir`, `jumlah_keluar`, `tanggal_keluar`) VALUES
('T-BK-23101800001', 14, 'S000008', 1, 1, 1, 1, '2023-10-18'),
('T-BK-23101800002', 14, 'S000006', 1, 1, 1, 1, '2023-10-18'),
('T-BK-23101800003', 14, 'S000008', 1, 1, 1, 1, '2023-10-18');

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
  `jumlah_masuk` int(11) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `harga` decimal(10,0) NOT NULL,
  `total_harga` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`id_barang_masuk`, `user_id`, `barang_id`, `jumlah_masuk`, `tanggal_masuk`, `harga`, `total_harga`) VALUES
('T-SM-23100700003', 27, 'S000003', 1, '2023-10-06', '0', '2500000'),
('T-SM-23100900001', 14, 'S000003', 1, '2023-10-09', '0', '2500000'),
('T-SM-23101000001', 14, 'S000003', 1, '2023-10-10', '0', '2500000'),
('T-SM-23101800001', 14, 'S000006', 1, '2023-10-18', '0', '100000'),
('T-SM-23101800002', 14, 'S000008', 2, '2023-10-18', '0', '200000'),
('T-SM-23101800003', 14, 'S000006', 1, '2023-10-18', '0', '100000'),
('T-SM-23101800004', 14, 'S000010', 3, '2023-10-18', '0', '7500000'),
('T-SM-23101800005', 14, 'S000008', 2, '2023-10-18', '0', '200000'),
('T-SM-23101800006', 14, 'S000009', 3, '2023-10-18', '0', '7500000'),
('T-SM-23101800007', 14, 'S000011', 1, '2023-10-18', '0', '60000'),
('T-SM-23101800008', 14, 'S000012', 2, '2023-10-18', '0', '1000000');

--
-- Triggers `barang_masuk`
--
DELIMITER $$
CREATE TRIGGER `update_stok_masuk` BEFORE INSERT ON `barang_masuk` FOR EACH ROW UPDATE `barang` SET `barang`.`stok` = `barang`.`stok` + NEW.jumlah_masuk WHERE `barang`.`id_barang` = NEW.barang_id
$$
DELIMITER ;

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
(12, 'Sparepart'),
(13, 'CDD'),
(14, 'L300 Pick Up'),
(15, 'GrandMax Box'),
(16, 'e');

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
(1, 'Rivan');

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
(1, 'Unit'),
(2, 'Pack'),
(3, 'Botol'),
(8, 'q'),
(9, 'q');

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
(1, 'Samsu');

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
(1, 'Ahmad Hasanudin', '085688772971', 'Kec. Cigudeg, Bogor - Jawa Barat'),
(2, 'Asep Salahudin', '081341879246', 'Kec. Ciampea, Bogor - Jawa Barat'),
(3, 'Filo Lial', '087728164328', 'Kec. Ciomas, Bogor - Jawa Barat'),
(6, 'PT. Widodo Motor Sport', '0212342333', 'Kudus'),
(7, 'PT. Auto Jaya', '081287735520', 'Jl. Soekarno Hatta, Semarang, Jateng'),
(9, 'PT Atuo', '091829038', 'Semarang'),
(10, 'PT. Jogja Auto', '123', 'JL. menoreh raya'),
(11, 'Budi', '081287735520', 's'),
(12, 'test sup', '08912819891', 'd'),
(13, 'Budi', '081287735520', 'l'),
(14, 'PT. Auto Jaya', '08912819891', 'f');

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
(17, 'abid', 'Abid82', 'abid@gmail.com', '081287735520', 'gudang', '$2y$10$8l5uYvQdxuh9BkjDidxtTuH0jeKxJJwYqcCJDv/.D1XcE6FDLpcpG', 1692546401, 'user.png', 1),
(27, 'sekar', 'sekar99', 'sekar@gmail.com', '021 2342333', 'finance', '$2y$10$WgTtQdxeXPY7LJIeXIMbTeLOLq9ZsjUyqR8Yt3z4bAv4ckFpGCRRy', 1696631787, 'user.png', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aki`
--
ALTER TABLE `aki`
  ADD PRIMARY KEY (`id_aki`),
  ADD KEY `satuan_id` (`satuan_id`,`jenis_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `aki_keluar`
--
ALTER TABLE `aki_keluar`
  ADD PRIMARY KEY (`id_aki_keluar`),
  ADD KEY `user_id` (`user_id`,`aki_id`,`id_armada`,`id_supir`,`id_montir`);

--
-- Indexes for table `aki_masuk`
--
ALTER TABLE `aki_masuk`
  ADD PRIMARY KEY (`id_aki_masuk`),
  ADD KEY `supplier_id` (`user_id`,`aki_id`);

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
  ADD KEY `user_id` (`user_id`,`ban_id`,`id_armada`,`id_supir`,`id_montir`);

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
  ADD KEY `satuan_id` (`satuan_id`),
  ADD KEY `kategori_id` (`jenis_id`),
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
  ADD KEY `id_montir` (`id_montir`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD KEY `user_id` (`user_id`,`barang_id`);

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `montir`
--
ALTER TABLE `montir`
  ADD PRIMARY KEY (`id_montir`);

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
  MODIFY `id_armada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `montir`
--
ALTER TABLE `montir`
  MODIFY `id_montir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `supir`
--
ALTER TABLE `supir`
  MODIFY `id_supir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`satuan_id`) REFERENCES `satuan` (`id_satuan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_ibfk_2` FOREIGN KEY (`jenis_id`) REFERENCES `jenis` (`id_jenis`) ON DELETE CASCADE ON UPDATE CASCADE;

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
