-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2020 at 09:21 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saw2`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternatif`
--

CREATE TABLE `alternatif` (
  `id_alternatif` int(11) NOT NULL,
  `nama` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `alamat` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `gender` enum('L','P') COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `alternatif`
--

INSERT INTO `alternatif` (`id_alternatif`, `nama`, `alamat`, `gender`) VALUES
(7, 'NOVI KHICMATUL LESTARI', '-', 'P'),
(6, 'ZIDNY ALBAAR', '-', 'L'),
(5, 'ABDUL ROZAQ', '-', 'L'),
(8, 'INDRA YULIARTA IFA EFENDI', '-', 'L'),
(9, 'ACHMAD ALWAN PUTRA PRATAMA', '-', 'L'),
(10, 'RUSDIAN HASBI RIDHO', '-', 'L');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `kode` varchar(10) COLLATE latin1_general_ci NOT NULL,
  `nama` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `atribut` enum('benefit','cost') COLLATE latin1_general_ci NOT NULL,
  `bobot` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `kode`, `nama`, `atribut`, `bobot`) VALUES
(11, 'K04', 'Semester', 'benefit', 1),
(10, 'K03', 'Status Orang Tua', 'benefit', 1),
(9, 'K02', 'Jumlah Tanggungan Orang Tua', 'benefit', 2),
(8, 'K01', 'Jumlah Pendapatan Orang Tua', 'benefit', 3),
(12, 'K05', 'IPK', 'benefit', 3);

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id_alternatif` int(11) NOT NULL,
  `id_subkriteria` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_alternatif`, `id_subkriteria`) VALUES
(1, 23),
(1, 17),
(1, 13),
(1, 5),
(1, 3),
(2, 2),
(2, 7),
(2, 11),
(2, 17),
(2, 24),
(3, 3),
(3, 8),
(3, 10),
(3, 19),
(3, 21),
(4, 22),
(4, 16),
(4, 14),
(4, 7),
(4, 3),
(5, 28),
(5, 31),
(5, 34),
(5, 42),
(5, 45),
(6, 27),
(6, 31),
(6, 35),
(6, 42),
(6, 45),
(7, 28),
(7, 30),
(7, 35),
(7, 42),
(7, 45),
(8, 28),
(8, 31),
(8, 36),
(8, 42),
(8, 45),
(9, 28),
(9, 31),
(9, 36),
(9, 42),
(9, 45),
(10, 28),
(10, 31),
(10, 35),
(10, 42),
(10, 45);

-- --------------------------------------------------------

--
-- Table structure for table `subkriteria`
--

CREATE TABLE `subkriteria` (
  `id_subkriteria` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nama` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `nilai` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `subkriteria`
--

INSERT INTO `subkriteria` (`id_subkriteria`, `id_kriteria`, `nama`, `nilai`) VALUES
(41, 11, 'semester 4', 0.75),
(40, 11, 'semester 3', 0.5),
(39, 11, 'semester 2', 0.25),
(37, 9, '> 4 anak', 1),
(36, 9, '3 anak', 0.75),
(35, 9, '2 anak', 0.5),
(34, 9, '1 anak', 0.25),
(33, 8, 'X >= 5.000.000', 0.25),
(32, 8, '3.000.000 < X < 5.000.000', 0.5),
(31, 8, '1.000.000 < X <= 3.000.000', 0.75),
(30, 8, 'X <= 1.000.000', 1),
(29, 12, 'IPK > 3.50', 1),
(28, 12, '3.00 < IPK <= 3.50', 0.75),
(27, 12, '2.50 <= IPK <= 3.00', 0.5),
(26, 12, 'IPK < 2.50', 0.25),
(42, 11, 'semester 5', 1),
(43, 10, 'Duda', 0.5),
(44, 10, 'Janda', 0.75),
(45, 10, 'Lengkap', 0.25),
(46, 10, 'Meninggal Dunia', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`) VALUES
(1, 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `subkriteria`
--
ALTER TABLE `subkriteria`
  ADD PRIMARY KEY (`id_subkriteria`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `subkriteria`
--
ALTER TABLE `subkriteria`
  MODIFY `id_subkriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
