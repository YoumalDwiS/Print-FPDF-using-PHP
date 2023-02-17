-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2022 at 12:17 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan_2022`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `nama_buku` varchar(100) NOT NULL,
  `id_jenis_buku` varchar(100) NOT NULL,
  `id_vendor` varchar(100) NOT NULL,
  `jml_stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `nama_buku`, `id_jenis_buku`, `id_vendor`, `jml_stok`) VALUES
(15, 'Ketika Cinta Bertasbih', 'Romance', 'PT Berkah Jaya Mandiri', 20);

-- --------------------------------------------------------

--
-- Table structure for table `jenisbuku`
--

CREATE TABLE `jenisbuku` (
  `id_jenis_buku` int(11) NOT NULL,
  `nama_jenis_buku` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenisbuku`
--

INSERT INTO `jenisbuku` (`id_jenis_buku`, `nama_jenis_buku`) VALUES
(5, 'Comedy'),
(6, 'Romance');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `id_vendor` int(11) NOT NULL,
  `nama_vendor` varchar(100) NOT NULL,
  `alamat_vendor` varchar(100) NOT NULL,
  `telp_vendor` varchar(15) NOT NULL,
  `email_vendor` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`id_vendor`, `nama_vendor`, `alamat_vendor`, `telp_vendor`, `email_vendor`) VALUES
(5, 'Toko Abah', 'Jakarta Selatan', '083526678166', 'abah@gmail.com'),
(6, 'PT Berkah Jaya Mandiri', 'Cikarang Utara', '081384427623', 'youmaldwi@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD UNIQUE KEY `nama_buku` (`nama_buku`);

--
-- Indexes for table `jenisbuku`
--
ALTER TABLE `jenisbuku`
  ADD PRIMARY KEY (`id_jenis_buku`),
  ADD UNIQUE KEY `nama_jenis_buku` (`nama_jenis_buku`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id_vendor`),
  ADD UNIQUE KEY `nama_vendor` (`nama_vendor`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `jenisbuku`
--
ALTER TABLE `jenisbuku`
  MODIFY `id_jenis_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id_vendor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
