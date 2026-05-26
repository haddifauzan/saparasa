-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2026 at 08:36 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saparasa`
--

-- --------------------------------------------------------

--
-- Table structure for table `bahan_baku`
--

CREATE TABLE `bahan_baku` (
  `id_bahan` bigint(20) NOT NULL,
  `nama_bahan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galeri_umkm`
--

CREATE TABLE `galeri_umkm` (
  `id_galeri` bigint(20) NOT NULL,
  `id_umkm` bigint(20) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `jenis_foto` enum('stand','menu') NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori_rasa`
--

CREATE TABLE `kategori_rasa` (
  `id_rasa` bigint(20) NOT NULL,
  `nama_rasa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori_umkm`
--

CREATE TABLE `kategori_umkm` (
  `id_kategori` bigint(20) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_aktivitas`
--

CREATE TABLE `log_aktivitas` (
  `id_log` bigint(20) NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `aktivitas` text NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu_bahan_baku`
--

CREATE TABLE `menu_bahan_baku` (
  `id_menu` bigint(20) NOT NULL,
  `id_bahan` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu_rasa`
--

CREATE TABLE `menu_rasa` (
  `id_menu` bigint(20) NOT NULL,
  `id_rasa` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu_umkm`
--

CREATE TABLE `menu_umkm` (
  `id_menu` bigint(20) NOT NULL,
  `id_umkm` bigint(20) NOT NULL,
  `nama_menu` varchar(255) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `menu_utama` tinyint(1) NOT NULL,
  `menu_terlaris` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `metode_pembayaran`
--

CREATE TABLE `metode_pembayaran` (
  `id_pembayaran` bigint(20) NOT NULL,
  `nama_pembayaran` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `operasional_umkm`
--

CREATE TABLE `operasional_umkm` (
  `id_operasional` bigint(20) NOT NULL,
  `id_umkm` bigint(20) NOT NULL,
  `hari` enum('senin','selasa','rabu','kamis','jumat','sabtu','minggu') NOT NULL,
  `jam_buka` time DEFAULT NULL,
  `jam_tutup` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `platform_online`
--

CREATE TABLE `platform_online` (
  `id_platform` bigint(20) NOT NULL,
  `nama_platform` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `review_pengunjung`
--

CREATE TABLE `review_pengunjung` (
  `id_review` bigint(20) NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `id_umkm` bigint(20) NOT NULL,
  `rating` int(11) NOT NULL,
  `komentar` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sosmed_umkm`
--

CREATE TABLE `sosmed_umkm` (
  `id_sosmed` bigint(20) NOT NULL,
  `id_umkm` bigint(20) NOT NULL,
  `platform` enum('instagram','tiktok','facebook','x') NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `umkm`
--

CREATE TABLE `umkm` (
  `id_umkm` bigint(20) NOT NULL,
  `id_kategori` bigint(20) NOT NULL,
  `nama_umkm` varchar(255) NOT NULL,
  `pemilik` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `tahun_berdiri` year(4) DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `operasional_tetap` tinyint(1) NOT NULL,
  `catatan_operasional` text DEFAULT NULL,
  `asal_daerah` varchar(255) DEFAULT NULL,
  `status_halal` enum('tidak','belum','proses','sudah') NOT NULL,
  `izin_usaha` enum('belum','proses','sudah') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `umkm_pembayaran`
--

CREATE TABLE `umkm_pembayaran` (
  `id_umkm` bigint(20) NOT NULL,
  `id_pembayaran` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `umkm_platform_online`
--

CREATE TABLE `umkm_platform_online` (
  `id_umkm` bigint(20) NOT NULL,
  `id_platform` bigint(20) NOT NULL,
  `link_platform` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` bigint(20) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user','penjual') NOT NULL,
  `foto_profile` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bahan_baku`
--
ALTER TABLE `bahan_baku`
  ADD PRIMARY KEY (`id_bahan`);

--
-- Indexes for table `galeri_umkm`
--
ALTER TABLE `galeri_umkm`
  ADD PRIMARY KEY (`id_galeri`),
  ADD KEY `fk_galeri_umkm` (`id_umkm`);

--
-- Indexes for table `kategori_rasa`
--
ALTER TABLE `kategori_rasa`
  ADD PRIMARY KEY (`id_rasa`);

--
-- Indexes for table `kategori_umkm`
--
ALTER TABLE `kategori_umkm`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `fk_log_user` (`id_user`);

--
-- Indexes for table `menu_bahan_baku`
--
ALTER TABLE `menu_bahan_baku`
  ADD PRIMARY KEY (`id_menu`,`id_bahan`),
  ADD KEY `fk_menu_bahan_bahan` (`id_bahan`);

--
-- Indexes for table `menu_rasa`
--
ALTER TABLE `menu_rasa`
  ADD PRIMARY KEY (`id_menu`,`id_rasa`),
  ADD KEY `fk_menu_rasa_rasa` (`id_rasa`);

--
-- Indexes for table `menu_umkm`
--
ALTER TABLE `menu_umkm`
  ADD PRIMARY KEY (`id_menu`),
  ADD KEY `fk_menu_umkm` (`id_umkm`);

--
-- Indexes for table `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `operasional_umkm`
--
ALTER TABLE `operasional_umkm`
  ADD PRIMARY KEY (`id_operasional`),
  ADD KEY `fk_operasional_umkm` (`id_umkm`);

--
-- Indexes for table `platform_online`
--
ALTER TABLE `platform_online`
  ADD PRIMARY KEY (`id_platform`);

--
-- Indexes for table `review_pengunjung`
--
ALTER TABLE `review_pengunjung`
  ADD PRIMARY KEY (`id_review`),
  ADD KEY `fk_review_user` (`id_user`),
  ADD KEY `fk_review_umkm` (`id_umkm`);

--
-- Indexes for table `sosmed_umkm`
--
ALTER TABLE `sosmed_umkm`
  ADD PRIMARY KEY (`id_sosmed`),
  ADD KEY `fk_sosmed_umkm` (`id_umkm`);

--
-- Indexes for table `umkm`
--
ALTER TABLE `umkm`
  ADD PRIMARY KEY (`id_umkm`),
  ADD KEY `fk_umkm_kategori` (`id_kategori`);

--
-- Indexes for table `umkm_pembayaran`
--
ALTER TABLE `umkm_pembayaran`
  ADD PRIMARY KEY (`id_umkm`,`id_pembayaran`),
  ADD KEY `fk_umkm_pembayaran_pembayaran` (`id_pembayaran`);

--
-- Indexes for table `umkm_platform_online`
--
ALTER TABLE `umkm_platform_online`
  ADD PRIMARY KEY (`id_umkm`,`id_platform`),
  ADD KEY `fk_umkm_platform_platform` (`id_platform`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bahan_baku`
--
ALTER TABLE `bahan_baku`
  MODIFY `id_bahan` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galeri_umkm`
--
ALTER TABLE `galeri_umkm`
  MODIFY `id_galeri` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori_rasa`
--
ALTER TABLE `kategori_rasa`
  MODIFY `id_rasa` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori_umkm`
--
ALTER TABLE `kategori_umkm`
  MODIFY `id_kategori` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  MODIFY `id_log` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu_umkm`
--
ALTER TABLE `menu_umkm`
  MODIFY `id_menu` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  MODIFY `id_pembayaran` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `operasional_umkm`
--
ALTER TABLE `operasional_umkm`
  MODIFY `id_operasional` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `platform_online`
--
ALTER TABLE `platform_online`
  MODIFY `id_platform` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `review_pengunjung`
--
ALTER TABLE `review_pengunjung`
  MODIFY `id_review` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sosmed_umkm`
--
ALTER TABLE `sosmed_umkm`
  MODIFY `id_sosmed` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `umkm`
--
ALTER TABLE `umkm`
  MODIFY `id_umkm` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `galeri_umkm`
--
ALTER TABLE `galeri_umkm`
  ADD CONSTRAINT `fk_galeri_umkm` FOREIGN KEY (`id_umkm`) REFERENCES `umkm` (`id_umkm`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD CONSTRAINT `fk_log_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu_bahan_baku`
--
ALTER TABLE `menu_bahan_baku`
  ADD CONSTRAINT `fk_menu_bahan_bahan` FOREIGN KEY (`id_bahan`) REFERENCES `bahan_baku` (`id_bahan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_menu_bahan_menu` FOREIGN KEY (`id_menu`) REFERENCES `menu_umkm` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu_rasa`
--
ALTER TABLE `menu_rasa`
  ADD CONSTRAINT `fk_menu_rasa_menu` FOREIGN KEY (`id_menu`) REFERENCES `menu_umkm` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_menu_rasa_rasa` FOREIGN KEY (`id_rasa`) REFERENCES `kategori_rasa` (`id_rasa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu_umkm`
--
ALTER TABLE `menu_umkm`
  ADD CONSTRAINT `fk_menu_umkm` FOREIGN KEY (`id_umkm`) REFERENCES `umkm` (`id_umkm`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `operasional_umkm`
--
ALTER TABLE `operasional_umkm`
  ADD CONSTRAINT `fk_operasional_umkm` FOREIGN KEY (`id_umkm`) REFERENCES `umkm` (`id_umkm`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `review_pengunjung`
--
ALTER TABLE `review_pengunjung`
  ADD CONSTRAINT `fk_review_umkm` FOREIGN KEY (`id_umkm`) REFERENCES `umkm` (`id_umkm`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_review_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sosmed_umkm`
--
ALTER TABLE `sosmed_umkm`
  ADD CONSTRAINT `fk_sosmed_umkm` FOREIGN KEY (`id_umkm`) REFERENCES `umkm` (`id_umkm`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `umkm`
--
ALTER TABLE `umkm`
  ADD CONSTRAINT `fk_umkm_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_umkm` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `umkm_pembayaran`
--
ALTER TABLE `umkm_pembayaran`
  ADD CONSTRAINT `fk_umkm_pembayaran_pembayaran` FOREIGN KEY (`id_pembayaran`) REFERENCES `metode_pembayaran` (`id_pembayaran`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_umkm_pembayaran_umkm` FOREIGN KEY (`id_umkm`) REFERENCES `umkm` (`id_umkm`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `umkm_platform_online`
--
ALTER TABLE `umkm_platform_online`
  ADD CONSTRAINT `fk_umkm_platform_platform` FOREIGN KEY (`id_platform`) REFERENCES `platform_online` (`id_platform`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_umkm_platform_umkm` FOREIGN KEY (`id_umkm`) REFERENCES `umkm` (`id_umkm`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
