-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2025 at 08:41 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alsintan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500');

-- --------------------------------------------------------

--
-- Table structure for table `alsintan`
--

CREATE TABLE `alsintan` (
  `id` int(11) NOT NULL,
  `id_desa` int(11) NOT NULL,
  `nama_kelompok` varchar(50) NOT NULL,
  `nama_alat` varchar(50) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tahun` int(4) NOT NULL,
  `kondisi` enum('Baik','Rusak Ringan','Rusak Berat') NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `alsintan`
--

INSERT INTO `alsintan` (`id`, `id_desa`, `nama_kelompok`, `nama_alat`, `jenis`, `jumlah`, `tahun`, `kondisi`, `foto`, `keterangan`) VALUES
(4, 1, 'Poktan', 'Crawler', 'Loader Crawler', 1, 2004, 'Rusak Ringan', 'traktor.jpg', 'ggg'),
(6, 16, 'Poktan', 'TR4', 'Traktor dengan Mesin Penanam (Seeder/Planter)', 3, 2011, 'Rusak Ringan', 'pembayaran.png', 'zzz'),
(7, 15, 'UPJA', 'Crawler', 'Bulldozer Crawler', 6, 2007, 'Baik', 'PRIMA GROUP.mp4', 'ttt'),
(8, 9, 'Gapoktan', 'Pompa', 'Pompa Air Diesel', 2, 2001, 'Rusak Berat', 'whatsapp.png', 'eee'),
(9, 10, 'Poktan', 'Combine', 'Combine Harvester Jagung', 3, 2003, 'Rusak Ringan', 'target.png', 'qqq'),
(10, 2, 'UPJA', 'Power Thresher', 'Power Thresher Semi Otomatis', 4, 2018, 'Baik', 'chair.png', 'uuu'),
(12, 11, 'Gapoktan', 'TR4', 'Traktor dengan Cultivator', 2, 2022, 'Baik', 'traktor.jpg', 'qqq'),
(13, 8, 'UPJA', 'TR4', 'Traktor dengan Bajak Singkal', 3, 2010, 'Rusak Ringan', 'tiktok.png', 'aaa'),
(14, 8, 'UPJA', 'Power Thresher', 'Power Thresher Semi Otomatis', 1, 2012, 'Rusak Ringan', 'pembayaran.png', 'llll'),
(15, 6, 'Poktan', 'TR4', 'Traktor Roda 4 (Four-Wheel Drive Tractor)', 5, 2016, 'Rusak Ringan', 'email.png', 'yyy'),
(16, 5, 'Gapoktan', 'Combine', 'Mini Combine Harvester', 4, 2015, 'Baik', 'mortarboard.png', 'vvv'),
(17, 3, 'Gapoktan', 'Power Thresher', 'Power Thresher Manual', 3, 2007, 'Rusak Berat', 'lifestyle.png', 'ddd'),
(18, 4, 'Poktan', 'Pompa', 'Pompa Air Elektrik', 6, 2014, 'Baik', 'user.png', 'bbb'),
(19, 6, 'Brigade Pangan', 'TR4', 'Traktor Roda 4 (Four-Wheel Drive Tractor)', 4, 2016, 'Baik', 'traktor.jpg', 'mmm'),
(20, 15, 'Brigade Pangan', 'Crawler', 'Loader Crawler', 10, 2009, 'Rusak Ringan', 'traktor.jpg', 'ban depan');

-- --------------------------------------------------------

--
-- Table structure for table `desa`
--

CREATE TABLE `desa` (
  `id` int(11) NOT NULL,
  `id_kecamatan` int(11) NOT NULL,
  `nama_desa` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `desa`
--

INSERT INTO `desa` (`id`, `id_kecamatan`, `nama_desa`) VALUES
(1, 1, 'Langgini'),
(2, 1, 'Muara Uwai'),
(3, 2, 'Koto Perambahan'),
(4, 2, 'Tarai Bangun'),
(5, 3, 'Pangkalan Baru'),
(6, 3, 'Pandau Jaya'),
(7, 4, 'Kampung Pulau'),
(8, 4, 'Kampung Besar Kota'),
(9, 5, 'Japura'),
(10, 5, 'Lirik Area'),
(11, 6, 'Sungai Lala'),
(12, 6, 'Air Molek'),
(13, 7, 'Sungai Perak'),
(14, 7, 'Tembilahan Kota'),
(15, 8, 'Sialang Panjang'),
(16, 8, 'Sialang Indah'),
(17, 9, 'Teluk Kiambang'),
(18, 9, 'Teluk Kabung');

-- --------------------------------------------------------

--
-- Table structure for table `kabupaten`
--

CREATE TABLE `kabupaten` (
  `id` int(11) NOT NULL,
  `nama_kabupaten` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kabupaten`
--

INSERT INTO `kabupaten` (`id`, `nama_kabupaten`) VALUES
(1401, 'Kampar'),
(1402, 'Indragiri Hulu'),
(1403, 'Indragiri Hilir');

-- --------------------------------------------------------

--
-- Table structure for table `kecamatan`
--

CREATE TABLE `kecamatan` (
  `id` int(11) NOT NULL,
  `id_kabupaten` int(11) NOT NULL,
  `nama_kecamatan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kecamatan`
--

INSERT INTO `kecamatan` (`id`, `id_kabupaten`, `nama_kecamatan`) VALUES
(1, 1401, 'Bangkinang Kota'),
(2, 1401, 'Tambang'),
(3, 1401, 'Siak Hulu'),
(4, 1402, 'Rengat'),
(5, 1402, 'Lirik'),
(6, 1402, 'Pasir Penyu'),
(7, 1403, 'Tembilahan'),
(8, 1403, 'Batang Tuaka'),
(9, 1403, 'Gaung');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `alsintan`
--
ALTER TABLE `alsintan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_desa` (`id_desa`);

--
-- Indexes for table `desa`
--
ALTER TABLE `desa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kecamatan` (`id_kecamatan`);

--
-- Indexes for table `kabupaten`
--
ALTER TABLE `kabupaten`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kabupaten` (`id_kabupaten`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `alsintan`
--
ALTER TABLE `alsintan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `desa`
--
ALTER TABLE `desa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1472071006;

--
-- AUTO_INCREMENT for table `kecamatan`
--
ALTER TABLE `kecamatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alsintan`
--
ALTER TABLE `alsintan`
  ADD CONSTRAINT `fk_desa` FOREIGN KEY (`id_desa`) REFERENCES `desa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `desa`
--
ALTER TABLE `desa`
  ADD CONSTRAINT `fk_kecamatan` FOREIGN KEY (`id_kecamatan`) REFERENCES `kecamatan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD CONSTRAINT `fk_kabupaten` FOREIGN KEY (`id_kabupaten`) REFERENCES `kabupaten` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
