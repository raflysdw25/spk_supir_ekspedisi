-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2020 at 10:40 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_supir_ekspedisi`
--

-- --------------------------------------------------------

--
-- Table structure for table `bobot_kriteria`
--

CREATE TABLE `bobot_kriteria` (
  `id_bobot` int(11) NOT NULL,
  `nama_bobot` varchar(255) NOT NULL,
  `jumlah_bobot` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bobot_kriteria`
--

INSERT INTO `bobot_kriteria` (`id_bobot`, `nama_bobot`, `jumlah_bobot`) VALUES
(1, 'Jarak Pengambilan', 0.252),
(2, 'Pengalaman Supir', 0.097),
(3, 'Status Supir', 0.555),
(4, 'Umur Supir', 0.097);

-- --------------------------------------------------------

--
-- Table structure for table `hasil_spk`
--

CREATE TABLE `hasil_spk` (
  `id_hasil` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_krwn` int(11) NOT NULL,
  `jumlah_poin` int(11) NOT NULL,
  `nilai_preferensi` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hasil_spk`
--

INSERT INTO `hasil_spk` (`id_hasil`, `id_transaksi`, `id_krwn`, `jumlah_poin`, `nilai_preferensi`) VALUES
(101, 12, 3, 6, 0.459),
(102, 12, 4, 5, 0.904),
(103, 12, 5, 6, 0.778),
(104, 12, 6, 8, 0.875),
(109, 13, 3, 6, 0.459),
(110, 13, 4, 5, 0.904),
(111, 13, 5, 6, 0.778),
(112, 13, 6, 8, 0.875);

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_krwn` int(11) NOT NULL,
  `nik_krwn` varchar(16) NOT NULL,
  `nama_krwn` varchar(255) NOT NULL,
  `pengalaman_krwn` int(11) NOT NULL,
  `tanggal_lahir_krwn` date NOT NULL,
  `alamat_krwn` varchar(255) NOT NULL,
  `sim_b` char(1) NOT NULL,
  `pendidikan_krwn` varchar(10) NOT NULL,
  `jenkel_krwn` varchar(30) NOT NULL,
  `telephone_krwn` varchar(13) NOT NULL,
  `status_krwn` varchar(20) NOT NULL,
  `jabatan_krwn` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_krwn`, `nik_krwn`, `nama_krwn`, `pengalaman_krwn`, `tanggal_lahir_krwn`, `alamat_krwn`, `sim_b`, `pendidikan_krwn`, `jenkel_krwn`, `telephone_krwn`, `status_krwn`, `jabatan_krwn`) VALUES
(2, '123456789', 'Rafly Sadewa', 2, '2019-12-31', 'Bandung', 'Y', 'SMK', 'Laki-Laki', '081214213319', 'Not Available', 'Admin'),
(3, '987654321', 'Sadewa Rafly', 5, '1991-12-25', 'Surabaya', 'Y', 'SD', 'Laki-Laki', '081218860714', 'Not Available', 'Supir'),
(4, '131212431', 'Sholahudin Noorsy', 5, '1997-07-16', 'Jakarta', 'Y', 'SMA', 'Laki-Laki', '081231921112', 'Not Available', 'Supir'),
(5, '87654321', 'Daffa Al Ghifari', 5, '1996-06-12', 'Yogyakarta', 'Y', 'SMK', 'Laki-Laki', '081131429312', 'Available', 'Supir'),
(6, '4312141987', 'Fajar Adam', 10, '1988-06-14', 'Semarang', 'Y', 'S1', 'Laki-Laki', '081271231881', 'Available', 'Supir');

-- --------------------------------------------------------

--
-- Table structure for table `konversi_supir`
--

CREATE TABLE `konversi_supir` (
  `id_konversi` int(11) NOT NULL,
  `id_krwn` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `umur_supir` int(11) NOT NULL,
  `pengalaman` int(11) NOT NULL,
  `jarak_pengambilan` int(11) NOT NULL,
  `status_supir` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `konversi_supir`
--

INSERT INTO `konversi_supir` (`id_konversi`, `id_krwn`, `id_transaksi`, `umur_supir`, `pengalaman`, `jarak_pengambilan`, `status_supir`) VALUES
(45, 3, 12, 1, 1, 3, 1),
(46, 4, 12, 1, 1, 1, 2),
(47, 5, 12, 1, 1, 2, 2),
(48, 6, 12, 2, 2, 2, 2),
(49, 3, 13, 1, 1, 3, 1),
(50, 4, 13, 1, 1, 1, 2),
(51, 5, 13, 1, 1, 2, 2),
(52, 6, 13, 2, 2, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `pemesan`
--

CREATE TABLE `pemesan` (
  `id_pemesan` int(11) NOT NULL,
  `username_pmsn` varchar(255) NOT NULL,
  `password_pmsn` varchar(255) NOT NULL,
  `nama_pemesan` varchar(255) NOT NULL,
  `alamat_pemesan` varchar(255) NOT NULL,
  `telephone_pemesan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemesan`
--

INSERT INTO `pemesan` (`id_pemesan`, `username_pmsn`, `password_pmsn`, `nama_pemesan`, `alamat_pemesan`, `telephone_pemesan`) VALUES
(1, 'jakarta1', '$2y$10$/T0pSXySfjv9b7Dfa5pbluGUwTbc06UutLPfaztqQLlYzcpwa/uUq', 'Arista Jakarta', 'Jakarta', '0251 8371435'),
(2, 'bandung1', '$2y$10$fmGmbSAAL4/TNuDUY4763.SXET0HDHZSZLvkpBRRWxYBvi4AfKT0S', 'Arista Bandung', 'Bandung', '0251 8371435'),
(3, 'surabaya1', '$2y$10$zOHoCPZx8F5Wnq/IVZfTpu3GDDw/UBabEcZ4AC5wJj68EC84/vaZm', 'Arista Surabaya', 'Surabaya', '0251 8371435'),
(4, 'jakarta2', '$2y$10$TmI5MvBG.MBUry3Vu37.3.ai6dyZOovy9i.kg/AVAAnSwd0mR2AvW', 'Mandiri Jakarta', 'Jakarta', '0251 8371435');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_pemesanan`
--

CREATE TABLE `transaksi_pemesanan` (
  `id_transaksi` int(11) NOT NULL,
  `id_pemesan` int(11) NOT NULL,
  `jumlah_pesanan` int(11) NOT NULL,
  `alamat_pengambilan` varchar(255) NOT NULL,
  `alamat_tujuan` varchar(255) NOT NULL,
  `jenis_pengiriman` varchar(255) NOT NULL,
  `tanggal_sampai` date NOT NULL,
  `status_pengiriman` varchar(255) NOT NULL,
  `nama_krwn` varchar(255) DEFAULT 'Search Driver'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi_pemesanan`
--

INSERT INTO `transaksi_pemesanan` (`id_transaksi`, `id_pemesan`, `jumlah_pesanan`, `alamat_pengambilan`, `alamat_tujuan`, `jenis_pengiriman`, `tanggal_sampai`, `status_pengiriman`, `nama_krwn`) VALUES
(12, 1, 12, 'Arista Bandung', 'Arista Jakarta', 'Car Carrier', '2020-01-03', 'On Progress', 'Sadewa Rafly'),
(13, 3, 12, 'Arista Bandung', 'Arista Surabaya', 'Car Carrier', '2020-01-17', 'On Progress', 'Sholahudin Noorsy'),
(14, 2, 5, 'Arista Surabaya', 'Arista Bandung', 'Car Carrier', '2020-01-16', 'Search Driver', 'Search Driver');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `id_krwn` int(11) NOT NULL,
  `username_user` varchar(255) NOT NULL,
  `password_user` varchar(255) NOT NULL,
  `level_user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `id_krwn`, `username_user`, `password_user`, `level_user`) VALUES
(1, 2, 'raflysdw25', '$2y$10$qAi0o.4em1BVgc7y9ANqEe6HnQZkcG8jxr5RHHdhQckQt.S1NjKwW', 'Admin'),
(2, 3, 'sadewarafly25', '$2y$10$e/FO/F4ai7Fp0GskY7QQwO1qb/wck8jfYP0zLxntz8eHf5xGnnEU.', 'Supir'),
(3, 4, 'shona25', '$2y$10$J3EdV24lEnVYcQFfK/wQXePkVJuYbD4Uci4zdBp1xwcLPrqIoDUKi', 'Supir'),
(4, 5, 'daffa1', '$2y$10$H7E5M3k5GI2quasLl1MvTORzvylHAGNjWUUQS5grSKI1APIwmiqv2', 'Supir'),
(5, 6, 'fajar1', '$2y$10$4FPzRVpwFUhVd3m1jG45u.mVyuH0T2c3mkSJfurRSpqN3VsF.5o..', 'Supir');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bobot_kriteria`
--
ALTER TABLE `bobot_kriteria`
  ADD PRIMARY KEY (`id_bobot`);

--
-- Indexes for table `hasil_spk`
--
ALTER TABLE `hasil_spk`
  ADD PRIMARY KEY (`id_hasil`),
  ADD KEY `fk_id_krwn_hasil` (`id_krwn`),
  ADD KEY `fk_id_transaksi_hasil` (`id_transaksi`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_krwn`) USING BTREE;

--
-- Indexes for table `konversi_supir`
--
ALTER TABLE `konversi_supir`
  ADD PRIMARY KEY (`id_konversi`),
  ADD KEY `fk_id_transaksi` (`id_transaksi`),
  ADD KEY `fk_id_krwn_konversi` (`id_krwn`);

--
-- Indexes for table `pemesan`
--
ALTER TABLE `pemesan`
  ADD PRIMARY KEY (`id_pemesan`);

--
-- Indexes for table `transaksi_pemesanan`
--
ALTER TABLE `transaksi_pemesanan`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `fk_id_pemesan` (`id_pemesan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `fk_id_krwn_users` (`id_krwn`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bobot_kriteria`
--
ALTER TABLE `bobot_kriteria`
  MODIFY `id_bobot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hasil_spk`
--
ALTER TABLE `hasil_spk`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_krwn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `konversi_supir`
--
ALTER TABLE `konversi_supir`
  MODIFY `id_konversi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `pemesan`
--
ALTER TABLE `pemesan`
  MODIFY `id_pemesan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaksi_pemesanan`
--
ALTER TABLE `transaksi_pemesanan`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hasil_spk`
--
ALTER TABLE `hasil_spk`
  ADD CONSTRAINT `fk_id_krwn_hasil` FOREIGN KEY (`id_krwn`) REFERENCES `karyawan` (`id_krwn`),
  ADD CONSTRAINT `fk_id_transaksi_hasil` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi_pemesanan` (`id_transaksi`);

--
-- Constraints for table `konversi_supir`
--
ALTER TABLE `konversi_supir`
  ADD CONSTRAINT `fk_id_krwn_konversi` FOREIGN KEY (`id_krwn`) REFERENCES `karyawan` (`id_krwn`),
  ADD CONSTRAINT `fk_id_transaksi` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi_pemesanan` (`id_transaksi`);

--
-- Constraints for table `transaksi_pemesanan`
--
ALTER TABLE `transaksi_pemesanan`
  ADD CONSTRAINT `fk_id_pemesan` FOREIGN KEY (`id_pemesan`) REFERENCES `pemesan` (`id_pemesan`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_id_krwn_users` FOREIGN KEY (`id_krwn`) REFERENCES `karyawan` (`id_krwn`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
