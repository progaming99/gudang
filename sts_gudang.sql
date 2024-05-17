-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2023 at 05:53 AM
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
('T-SM-23101800008', 14, 'S000012', 2, '2023-10-18', '0', '1000000'),
('T-SM-23102700001', 28, 'S000001', 3, '2023-10-27', '0', '300000'),
('T-SM-23102700002', 14, 'S000001', 1, '2023-10-27', '0', '100000'),
('T-SM-23102700003', 14, 'S000001', 1, '2023-10-27', '0', '100000'),
('T-SM-23102700004', 14, 'S000001', 8, '2023-10-27', '0', '800000');

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

-- --------------------------------------------------------

--
-- Table structure for table `montir`
--

CREATE TABLE `montir` (
  `id_montir` int(11) NOT NULL,
  `nama_montir` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `oli_keluar`
--

CREATE TABLE `oli_keluar` (
  `id_oli_keluar` char(16) NOT NULL,
  `user_id` int(11) NOT NULL,
  `oli_id` char(16) NOT NULL,
  `jumlah_keluar` int(11) NOT NULL,
  `tanggal_keluar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `supir`
--

CREATE TABLE `supir` (
  `id_supir` int(11) NOT NULL,
  `nama_supir` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(14, 'Andika IT', 'andika99', 'progaming99.as48@gmail.com', '081287735520', 'admin', '$2y$10$XBkwvbZOP8chZwOmDbhvmOqYRtoT8snMo1PFkOuZN1bJ64fIKJKD.', 1692440826, 'ddadf8cfa8c167a14a3d48f8c615e92f.jpg', 1);

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
  ADD KEY `user_id` (`user_id`,`oli_id`);

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
  MODIFY `id_armada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `montir`
--
ALTER TABLE `montir`
  MODIFY `id_montir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `supir`
--
ALTER TABLE `supir`
  MODIFY `id_supir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

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
