-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2025 at 05:30 PM
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
-- Database: `db_sibkm`
--

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `jenis_kelamin` varchar(20) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `whatsapp` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `jurusan` varchar(100) DEFAULT NULL,
  `fakultas` varchar(100) DEFAULT NULL,
  `angkatan` varchar(10) DEFAULT NULL,
  `rekening` varchar(50) DEFAULT NULL,
  `semester` int(11) DEFAULT NULL,
  `ips` decimal(4,2) DEFAULT NULL,
  `ipk` decimal(4,2) DEFAULT NULL,
  `dosen_pembimbing` varchar(100) DEFAULT NULL,
  `nama_ayah` varchar(100) DEFAULT NULL,
  `pekerjaan_ayah` varchar(100) DEFAULT NULL,
  `nama_ibu` varchar(100) DEFAULT NULL,
  `pekerjaan_ibu` varchar(100) DEFAULT NULL,
  `pendapatan_orangtua` varchar(50) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nim`, `jenis_kelamin`, `tanggal_lahir`, `whatsapp`, `email`, `jurusan`, `fakultas`, `angkatan`, `rekening`, `semester`, `ips`, `ipk`, `dosen_pembimbing`, `nama_ayah`, `pekerjaan_ayah`, `nama_ibu`, `pekerjaan_ibu`, `pendapatan_orangtua`, `foto`) VALUES
(1, '123', 'laki-laki', '2018-01-01', '08', 'aas@gmail.com', 'pai', 'tarbiyah', '20', '000', 5, 4.00, 4.00, 'dospem', 'yah', 'ayah', 'bu', 'ibu', '230.000.000.000', '123_1750167370.png');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_berkas`
--

CREATE TABLE `pengajuan_berkas` (
  `id` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `ktm` varchar(255) NOT NULL,
  `sktm` varchar(255) NOT NULL,
  `krs` varchar(255) NOT NULL,
  `ukt` varchar(255) NOT NULL,
  `slip_gaji` varchar(255) NOT NULL,
  `foto_rumah` varchar(255) NOT NULL,
  `tanggal_upload` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengajuan_berkas`
--

INSERT INTO `pengajuan_berkas` (`id`, `id_mahasiswa`, `ktm`, `sktm`, `krs`, `ukt`, `slip_gaji`, `foto_rumah`, `tanggal_upload`) VALUES
(1, 1, 'ktm11750171672.png', 'sktm11750171672.png', 'krs11750171672.png', 'ukt11750171672.png', 'gaji11750171672.png', 'rumah11750171672.png', '2025-06-17 14:47:52');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_dana`
--

CREATE TABLE `pengajuan_dana` (
  `id` int(11) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `jenis_pengajuan` varchar(100) NOT NULL,
  `nominal` int(11) NOT NULL,
  `tanggal_pengajuan` timestamp NOT NULL DEFAULT current_timestamp(),
  `no_rekening` varchar(30) DEFAULT NULL,
  `status` enum('Diproses','Disetujui','Ditolak') DEFAULT 'Diproses'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengajuan_dana`
--

INSERT INTO `pengajuan_dana` (`id`, `id_mahasiswa`, `jenis_pengajuan`, `nominal`, `tanggal_pengajuan`, `no_rekening`, `status`) VALUES
(1, 1, 'Bekal Jajan', 111, '2025-06-17 14:53:08', '', 'Diproses');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_pengajuan`
--

CREATE TABLE `riwayat_pengajuan` (
  `id_pengajuan` int(11) NOT NULL,
  `id_mahasiswa` int(11) DEFAULT NULL,
  `jenis_pengajuan` varchar(100) DEFAULT NULL,
  `nominal` int(11) DEFAULT NULL,
  `no_rekening` varchar(50) DEFAULT NULL,
  `tanggal_pengajuan` date DEFAULT NULL,
  `status` enum('Diproses','Disetujui','Ditolak') DEFAULT 'Diproses'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('mahasiswa','admin') DEFAULT 'mahasiswa',
  `status_akun` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nim`, `nama_lengkap`, `password`, `role`, `status_akun`, `created_at`) VALUES
(1, '123', 'aas', '$2y$10$BcrugyqjMKs7ltXiCODyp.vPRI7TFqHBZZHM.iG93kBGBgRR9d17q', 'mahasiswa', 'aktif', '2025-06-14 16:22:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_mahasiswa_nim` (`nim`);

--
-- Indexes for table `pengajuan_berkas`
--
ALTER TABLE `pengajuan_berkas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`);

--
-- Indexes for table `pengajuan_dana`
--
ALTER TABLE `pengajuan_dana`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mahasiswa` (`id_mahasiswa`);

--
-- Indexes for table `riwayat_pengajuan`
--
ALTER TABLE `riwayat_pengajuan`
  ADD PRIMARY KEY (`id_pengajuan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `nim` (`nim`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengajuan_berkas`
--
ALTER TABLE `pengajuan_berkas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengajuan_dana`
--
ALTER TABLE `pengajuan_dana`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `riwayat_pengajuan`
--
ALTER TABLE `riwayat_pengajuan`
  MODIFY `id_pengajuan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `fk_mahasiswa_nim` FOREIGN KEY (`nim`) REFERENCES `users` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengajuan_berkas`
--
ALTER TABLE `pengajuan_berkas`
  ADD CONSTRAINT `pengajuan_berkas_ibfk_1` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id`);

--
-- Constraints for table `pengajuan_dana`
--
ALTER TABLE `pengajuan_dana`
  ADD CONSTRAINT `pengajuan_dana_ibfk_1` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
