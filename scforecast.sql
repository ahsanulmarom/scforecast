-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 19 Mei 2018 pada 04.27
-- Versi Server: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scforecast`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `abcrop`
--

CREATE TABLE `abcrop` (
  `id` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `kodebarang` varchar(50) NOT NULL,
  `namabarang` varchar(50) NOT NULL,
  `demandbulan` double DEFAULT NULL,
  `costbulan` double DEFAULT NULL,
  `spend` int(11) AS (demandbulan*costbulan) VIRTUAL,
  `lead` double DEFAULT NULL,
  `sd` double DEFAULT NULL,
  `sl` double DEFAULT NULL,
  `tetha` double AS (sqrt((power((demandbulan),2)*power(sl,2))+power(lead,2)*power(sd,2))) VIRTUAL,
  `z` double NOT NULL DEFAULT '1.645',
  `ss` int(11) AS (z*(sqrt((power((demandbulan),2)*power(sl,2))+power(lead,2)*power(sd,2)))) VIRTUAL,
  `ROP` int(11) AS ((demandbulan)*lead+(z*(sqrt((power((demandbulan),2)*power(sl,2))+power(lead,2)*power(sd,2))))) VIRTUAL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `abcrop`
--

INSERT INTO `abcrop` (`id`, `bulan`, `tahun`, `kodebarang`, `namabarang`, `demandbulan`, `costbulan`, `spend`, `lead`, `sd`, `sl`, `tetha`, `z`, `ss`, `ROP`) VALUES
(9, 5, 2018, 'A001', 'Kursi', 2.8, 102640, 287392, 7.6, 1.1662, 1.2, 9.478633663899032, 1.645, 16, 37),
(10, 5, 2018, 'A002', 'Meja', 2, 21500, 43000, 9, 1, 1, 9.219544457292887, 1.645, 15, 33),
(14, 6, 2018, 'A001', 'Kursi', 3, 16000, 48000, 14.5, 2, 5.5, 33.36540124140574, 1.645, 55, 98),
(15, 6, 2018, 'A002', 'Meja', 3, 20000, 60000, 2, 0, 0, 0, 1.645, 0, 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `abcsys`
--

CREATE TABLE `abcsys` (
  `id` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `kodebarang` varchar(50) NOT NULL,
  `namabarang` varchar(50) NOT NULL,
  `demandbulan` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `demandcost` int(11) AS (demandbulan*cost) VIRTUAL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `abcsys`
--

INSERT INTO `abcsys` (`id`, `bulan`, `tahun`, `kodebarang`, `namabarang`, `demandbulan`, `cost`, `demandcost`) VALUES
(2, 5, 2018, 'A001', 'Kursi', 14, 102640, 1436960),
(3, 5, 2018, 'A002', 'Meja', 4, 21500, 86000),
(7, 6, 2018, 'A001', 'Kursi', 6, 16000, 96000),
(8, 6, 2018, 'A002', 'Meja', 3, 20000, 60000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `namaAdmin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `namaAdmin`) VALUES
(1, 'ihtiarjaya01', 'admin123', 'Farhan Vidi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `agregat`
--

CREATE TABLE `agregat` (
  `id` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `forecasting` int(11) NOT NULL,
  `hprod` int(11) NOT NULL DEFAULT '3',
  `hpekerja` int(11) NOT NULL DEFAULT '2',
  `npekerja` int(11) AS (forecasting*hprod/hpekerja) VIRTUAL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `agregat`
--

INSERT INTO `agregat` (`id`, `bulan`, `tahun`, `forecasting`, `hprod`, `hpekerja`, `npekerja`) VALUES
(2, 2, 2017, 19, 3, 2, 29),
(5, 3, 2017, 33, 3, 2, 50),
(6, 4, 2017, 30, 3, 2, 45),
(7, 5, 2017, 28, 3, 2, 42),
(8, 6, 2017, 200, 3, 2, 300),
(9, 7, 2017, 200, 3, 2, 300),
(10, 8, 2017, 200, 3, 2, 300);

-- --------------------------------------------------------

--
-- Struktur dari tabel `demandharian`
--

CREATE TABLE `demandharian` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `kodebarang` varchar(50) NOT NULL,
  `namabarang` varchar(50) NOT NULL,
  `demand` int(11) NOT NULL,
  `leadtime` int(11) NOT NULL,
  `cost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `demandharian`
--

INSERT INTO `demandharian` (`id`, `tanggal`, `kodebarang`, `namabarang`, `demand`, `leadtime`, `cost`) VALUES
(34, '2018-05-18', 'A001', 'Kursi', 2, 7, 120000),
(35, '2018-05-19', 'A002', 'Meja', 1, 8, 30000),
(36, '2018-05-19', 'A001', 'Kursi', 5, 7, 125000),
(37, '2018-05-20', 'A001', 'Kursi', 2, 7, 120000),
(38, '2018-05-21', 'A001', 'Kursi', 3, 7, 130000),
(39, '2018-05-22', 'A002', 'Meja', 3, 10, 13000),
(51, '2018-06-04', 'A001', 'Kursi', 1, 20, 2000),
(52, '2018-06-06', 'A001', 'Kursi', 5, 9, 30000),
(53, '2018-06-03', 'A002', 'Meja', 3, 2, 20000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `forecast`
--

CREATE TABLE `forecast` (
  `id` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `demand` int(11) DEFAULT NULL,
  `alfa` float DEFAULT NULL,
  `forecast` int(11) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `forecast`
--

INSERT INTO `forecast` (`id`, `bulan`, `tahun`, `demand`, `alfa`, `forecast`, `type`) VALUES
(5, 1, 2017, 21, 0.1, 20, 1),
(6, 2, 2017, 50, 0.1, 19, 1),
(7, 1, 2017, 10, 0.1, 9, 2),
(8, 2, 2017, 25, 0.1, 9, 2),
(41, 3, 2017, 100, 0.1, 22, 1),
(43, 3, 2017, NULL, 0.1, 11, 2),
(44, 4, 2017, 20, 0.1, 30, 1),
(45, 5, 2017, 200, 0.2, 28, 1),
(46, 6, 2017, 150, 1, 200, 1),
(47, 7, 2017, 200, 0, 200, 1),
(48, 8, 2017, NULL, 0.1, 200, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abcrop`
--
ALTER TABLE `abcrop`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `abcsys`
--
ALTER TABLE `abcsys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agregat`
--
ALTER TABLE `agregat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `demandharian`
--
ALTER TABLE `demandharian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forecast`
--
ALTER TABLE `forecast`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abcrop`
--
ALTER TABLE `abcrop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `abcsys`
--
ALTER TABLE `abcsys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `agregat`
--
ALTER TABLE `agregat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `demandharian`
--
ALTER TABLE `demandharian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `forecast`
--
ALTER TABLE `forecast`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
