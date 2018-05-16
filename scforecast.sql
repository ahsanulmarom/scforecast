-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 16 Mei 2018 pada 04.01
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
(6, 4, 2017, 30, 3, 2, 45);

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
(44, 4, 2017, NULL, 0.1, 30, 1);

--
-- Indexes for dumped tables
--

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
-- Indexes for table `forecast`
--
ALTER TABLE `forecast`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `agregat`
--
ALTER TABLE `agregat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `forecast`
--
ALTER TABLE `forecast`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
