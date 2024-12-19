-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2024 at 12:50 PM
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
-- Database: `db_bendalmar`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_bayar`
--

CREATE TABLE `tb_bayar` (
  `id_bayar` bigint(19) NOT NULL,
  `nominal_uang` bigint(19) DEFAULT NULL,
  `total_bayar` bigint(19) DEFAULT NULL,
  `waktu_bayar` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_bayar`
--

INSERT INTO `tb_bayar` (`id_bayar`, `nominal_uang`, `total_bayar`, `waktu_bayar`) VALUES
(2405251624275, 10000, 9000, '2024-05-25 17:20:58'),
(2405251629686, 100000, 45000, '2024-05-25 17:40:05'),
(2405260040352, 200000, 160000, '2024-05-25 17:41:26'),
(2405260251689, 3000000, 320000, '2024-05-25 19:59:51'),
(2405271239658, 400000, 360000, '2024-05-27 06:52:18'),
(2405271325143, 500000, 240000, '2024-05-27 06:28:41'),
(2405271355651, 250000, 220000, '2024-05-27 06:56:39');

-- --------------------------------------------------------

--
-- Table structure for table `tb_daftar_menu`
--

CREATE TABLE `tb_daftar_menu` (
  `id` int(10) NOT NULL,
  `gambar` varchar(200) DEFAULT NULL,
  `nama_menu` varchar(200) DEFAULT NULL,
  `keterangan` varchar(200) DEFAULT NULL,
  `kategori` int(50) DEFAULT NULL,
  `harga` varchar(50) DEFAULT NULL,
  `stok` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_daftar_menu`
--

INSERT INTO `tb_daftar_menu` (`id`, `gambar`, `nama_menu`, `keterangan`, `kategori`, `harga`, `stok`) VALUES
(9, '38977-2.png', 'Burger', 'Burger dengan daging dari afrika', 2, '20000', '100'),
(12, '41328-10.png', 'Teh Manis', 'Teh Asli dari kebun teh puncak', 7, '3000', '300'),
(13, '77410-7.png', 'Bakso', 'Bakso dengan daging sapi wagyu', 2, '12000', '200'),
(14, '14293-12.png', 'Jus Mangga', 'Mangga Lokal dari pulau Sumatra yang mendunia', 3, '10000', '300'),
(15, '23582-14.png', 'Kepiting', 'Kepiting Import Asli dari Alaska', 8, '180000', '100'),
(17, '44803-3.png', 'Kari Kambing Panas', 'Kari kambing dari jawa barat enak banget', 9, '50000', '200');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori_menu`
--

CREATE TABLE `tb_kategori_menu` (
  `id_kategori_menu` int(10) NOT NULL,
  `jenis_menu` int(10) DEFAULT NULL,
  `kategori_menu` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_kategori_menu`
--

INSERT INTO `tb_kategori_menu` (`id_kategori_menu`, `jenis_menu`, `kategori_menu`) VALUES
(2, 1, 'Snack'),
(3, 2, 'Jus'),
(7, 2, 'Teh'),
(8, 1, 'Seafood'),
(9, 1, 'Kari');

-- --------------------------------------------------------

--
-- Table structure for table `tb_list_order`
--

CREATE TABLE `tb_list_order` (
  `id_list_order` int(10) NOT NULL,
  `menu` int(10) DEFAULT NULL,
  `kode_order` bigint(19) DEFAULT NULL,
  `jumlah` int(10) DEFAULT NULL,
  `catatan` varchar(300) DEFAULT NULL,
  `status` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_list_order`
--

INSERT INTO `tb_list_order` (`id_list_order`, `menu`, `kode_order`, `jumlah`, `catatan`, `status`) VALUES
(5, 12, 2405251629686, 3, 'satu panas, satu dingin', 2),
(6, 12, 2405251624275, 3, '1 panas, 2 dingin', 1),
(9, 13, 2405251629686, 3, 'gapake sayur', 1),
(10, 9, 2405252123731, 1, 'gapake bawang', NULL),
(11, 9, 2405260040352, 8, 'manis', NULL),
(14, 9, 2405260251689, 10, '1 gapedes', 2),
(15, 14, 2405260251689, 12, '', 2),
(16, 15, 2405271239658, 2, 'gapake saos', NULL),
(17, 9, 2405271325143, 12, '1 gapedes sisanya pedes', 2),
(19, 17, 2405271355651, 2, '', 2),
(20, 14, 2405271355651, 12, '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `id_order` bigint(19) NOT NULL,
  `pelanggan` varchar(200) DEFAULT NULL,
  `meja` int(10) DEFAULT NULL,
  `pelayan` int(10) DEFAULT NULL,
  `waktu_order` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_order`
--

INSERT INTO `tb_order` (`id_order`, `pelanggan`, `meja`, `pelayan`, `waktu_order`) VALUES
(2405251624275, 'Ardho Rantisy', 13, 2, '2024-05-25 11:13:54'),
(2405251629686, 'Kang Pian Relasi', 6, 2, '2024-05-25 17:39:53'),
(2405252123731, 'radi alpin', 2, 2, '2024-05-25 19:33:23'),
(2405260040352, 'Dayat', 8, 2, '2024-05-25 17:41:03'),
(2405260251689, 'Rosyid Eko Nugroho', 12, 2, '2024-05-25 19:53:17'),
(2405271239658, 'leni', 200, 2, '2024-05-27 05:39:58'),
(2405271325143, 'Bhanu Azizi Tambun', 12, 2, '2024-05-27 06:26:54'),
(2405271355651, 'Udin', 8, 15, '2024-05-27 06:55:29');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(10) NOT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `username` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `level` int(10) DEFAULT NULL,
  `nohp` varchar(15) DEFAULT NULL,
  `alamat` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `nama`, `username`, `password`, `level`, `nohp`, `alamat`) VALUES
(2, 'Administrator', 'admin@admin.com', '202cb962ac59075b964b07152d234b70', 1, '083891284212', 'karawang'),
(15, 'bhanu', 'bhanu@bendalmar.com', '5f4dcc3b5aa765d61d8327deb882cf99', 2, '08187287312', 'karawang'),
(16, 'Nabilla', 'Nabilla123@gmail.com', '202cb962ac59075b964b07152d234b70', 3, '081297393212', 'rayon'),
(17, 'Pasha', 'Pasha123@gmail.com', '202cb962ac59075b964b07152d234b70', 4, '081389241639', 'rayon');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_bayar`
--
ALTER TABLE `tb_bayar`
  ADD PRIMARY KEY (`id_bayar`);

--
-- Indexes for table `tb_daftar_menu`
--
ALTER TABLE `tb_daftar_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_tb_daftar_menu_tb_kategori_menu` (`kategori`);

--
-- Indexes for table `tb_kategori_menu`
--
ALTER TABLE `tb_kategori_menu`
  ADD PRIMARY KEY (`id_kategori_menu`);

--
-- Indexes for table `tb_list_order`
--
ALTER TABLE `tb_list_order`
  ADD PRIMARY KEY (`id_list_order`),
  ADD KEY `FK_tb_list_order_tb_daftar_menu` (`menu`),
  ADD KEY `FK_tb_list_order_tb_order` (`kode_order`);

--
-- Indexes for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `FK_tb_order_tb_user` (`pelayan`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_daftar_menu`
--
ALTER TABLE `tb_daftar_menu`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tb_kategori_menu`
--
ALTER TABLE `tb_kategori_menu`
  MODIFY `id_kategori_menu` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_list_order`
--
ALTER TABLE `tb_list_order`
  MODIFY `id_list_order` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_daftar_menu`
--
ALTER TABLE `tb_daftar_menu`
  ADD CONSTRAINT `FK_tb_daftar_menu_tb_kategori_menu` FOREIGN KEY (`kategori`) REFERENCES `tb_kategori_menu` (`id_kategori_menu`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_list_order`
--
ALTER TABLE `tb_list_order`
  ADD CONSTRAINT `FK_tb_list_order_tb_daftar_menu` FOREIGN KEY (`menu`) REFERENCES `tb_daftar_menu` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_tb_list_order_tb_order` FOREIGN KEY (`kode_order`) REFERENCES `tb_order` (`id_order`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD CONSTRAINT `FK_tb_order_tb_user` FOREIGN KEY (`pelayan`) REFERENCES `tb_user` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
