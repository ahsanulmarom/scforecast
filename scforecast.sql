-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 22 Mei 2018 pada 16.37
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
  `tetha` double AS (sqrt((power((demandbulan),2)*power(sl,2))+lead*power(sd,2))) VIRTUAL,
  `z` double NOT NULL DEFAULT '1.645',
  `ss` int(11) AS (z*(sqrt((power((demandbulan),2)*power(sl,2))+lead*power(sd,2)))) VIRTUAL,
  `ROP` int(11) AS (((demandbulan)*lead)+(z*(sqrt((power((demandbulan),2)*power(sl,2))+lead*power(sd,2))))) VIRTUAL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `abcrop`
--

INSERT INTO `abcrop` (`id`, `bulan`, `tahun`, `kodebarang`, `namabarang`, `demandbulan`, `costbulan`, `spend`, `lead`, `sd`, `sl`, `tetha`, `z`, `ss`, `ROP`) VALUES
(9, 5, 2018, 'A001', 'Kursi', 2.8, 102640, 287392, 7.6, 1.1662, 1.2, 4.650351658100707, 1.645, 8, 29),
(10, 5, 2018, 'A002', 'Meja', 2, 21500, 43000, 9, 1, 1, 3.605551275463989, 1.645, 6, 24),
(14, 6, 2018, 'A001', 'Kursi', 3, 16000, 48000, 14.5, 2, 5.5, 18.172781845386247, 1.645, 30, 73),
(15, 6, 2018, 'A002', 'Meja', 3, 20000, 60000, 2, 0, 0, 0, 1.645, 0, 6),
(16, 1, 2017, 'A002', 'Dipan', 2, 3250000, 6500000, 7, 1, 0, 2.6457513110645907, 1.645, 4, 18),
(17, 1, 2017, 'B004', 'Meja Makan', 1, 3000000, 3000000, 9, 0, 0, 0, 1.645, 0, 9),
(18, 1, 2017, 'A001', 'Kursi Tamu', 1.3333, 1200000, 1599960, 5, 0.4714, 0, 1.054082444593401, 1.645, 2, 8),
(19, 1, 2017, 'A004', 'Kursi Kerja', 1.4, 1100000, 1540000, 4, 0.4899, 0, 0.9798, 1.645, 2, 7),
(20, 1, 2017, 'A003', 'Lemari Sliding 3 Pintu', 2.3333, 7500000, 17499750, 11, 0.9428, 0, 3.126913852347071, 1.645, 5, 31),
(21, 1, 2017, 'B002', 'Lemari Pakaian', 2, 4650000, 9300000, 9, 1, 0, 3, 1.645, 5, 23),
(22, 1, 2017, 'B001', 'Buffet', 2, 5150000, 10300000, 8, 0.8165, 0, 2.309410747355264, 1.645, 4, 20),
(23, 1, 2017, 'A005', 'Rak Buku', 1.3333, 3400000, 4533220, 6, 0.4714, 0, 1.1546894647479902, 1.645, 2, 10),
(24, 1, 2017, 'A006', 'Kursi Cafe', 1, 750000, 750000, 4, 0, 0, 0, 1.645, 0, 4),
(25, 1, 2017, 'C002', 'Meja Rias', 3, 4750000, 14250000, 10, 0, 0, 0, 1.645, 0, 30),
(26, 1, 2017, 'B003', 'Meja Kerja', 3, 2000000, 6000000, 10, 0, 0, 0, 1.645, 0, 30),
(27, 2, 2017, 'C003', 'Sofa', 2, 6800000, 13600000, 11, 0, 0, 0, 1.645, 0, 22),
(28, 2, 2017, 'A001', 'Kursi Tamu', 1.3333, 1200000, 1599960, 5, 0.4714, 0, 1.054082444593401, 1.645, 2, 8),
(29, 2, 2017, 'B001', 'Buffet', 2, 5150000, 10300000, 8, 1, 0, 2.8284271247461903, 1.645, 5, 21),
(30, 2, 2017, 'A003', 'Lemari Sliding 3 Pintu', 1.6667, 7500000, 12500250, 11, 0.9428, 0, 3.126913852347071, 1.645, 5, 23),
(31, 2, 2017, 'C004', 'Kursi Goyang', 1, 2200000, 2200000, 6, 0, 0, 0, 1.645, 0, 6),
(32, 2, 2017, 'B003', 'Meja Kerja', 2.3333, 2000000, 4666600, 10, 0.9428, 0, 2.981395378006748, 1.645, 5, 28),
(33, 2, 2017, 'A006', 'Kursi Cafe', 2, 750000, 1500000, 4, 0, 0, 0, 1.645, 0, 8),
(34, 2, 2017, 'C001', 'Nakas', 2, 2250000, 4500000, 5, 0, 0, 0, 1.645, 0, 10),
(35, 2, 2017, 'B002', 'Lemari Pakaian', 2.5, 4650000, 11625000, 9, 0.5, 0, 1.5, 1.645, 2, 25),
(36, 2, 2017, 'A005', 'Rak Buku', 2.5, 3400000, 8500000, 6, 0.5, 0, 1.224744871391589, 1.645, 2, 17),
(37, 2, 2017, 'A004', 'Kursi Kerja', 2.5, 1100000, 2750000, 4, 0.5, 0, 1, 1.645, 2, 12),
(38, 2, 2017, 'A002', 'Dipan', 2, 3250000, 6500000, 7, 1, 0, 2.6457513110645907, 1.645, 4, 18),
(39, 2, 2017, 'C002', 'Meja Rias', 2, 4750000, 9500000, 10, 0, 0, 0, 1.645, 0, 20),
(40, 2, 2017, 'B004', 'Meja Makan', 2, 3000000, 6000000, 9, 1, 0, 3, 1.645, 5, 23),
(41, 3, 2017, 'A001', 'Kursi Tamu', 1.75, 1200000, 2100000, 5, 0.8292, 0, 1.8541475669428258, 1.645, 3, 12),
(42, 3, 2017, 'B002', 'Lemari Pakaian', 3, 4650000, 13950000, 9, 0, 0, 0, 1.645, 0, 27),
(43, 3, 2017, 'A002', 'Dipan', 2, 3250000, 6500000, 7, 1, 0, 2.6457513110645907, 1.645, 4, 18),
(44, 3, 2017, 'A004', 'Kursi Kerja', 2, 1100000, 2200000, 4, 0.8165, 0, 1.633, 1.645, 3, 11),
(45, 3, 2017, 'B001', 'Buffet', 3, 5150000, 15450000, 8, 0, 0, 0, 1.645, 0, 24),
(46, 3, 2017, 'A003', 'Lemari Sliding 3 Pintu', 2.5, 7500000, 18750000, 11, 0.5, 0, 1.6583123951777, 1.645, 3, 30),
(47, 3, 2017, 'B003', 'Meja Kerja', 2, 2000000, 4000000, 10, 0, 0, 0, 1.645, 0, 20),
(48, 3, 2017, 'C005', 'Kitchen Set Minimalis', 1, 4750000, 4750000, 8, 0, 0, 0, 1.645, 0, 8),
(49, 3, 2017, 'A005', 'Rak Buku', 2, 3400000, 6800000, 6, 0, 0, 0, 1.645, 0, 12),
(50, 3, 2017, 'A006', 'Kursi Cafe', 2, 750000, 1500000, 4, 1, 0, 2, 1.645, 3, 11),
(51, 3, 2017, 'B004', 'Meja Makan', 3, 3000000, 9000000, 5, 0, 0, 0, 1.645, 0, 15),
(52, 3, 2017, 'C006', 'Keranjang Air Mineral Gelas', 1, 225000, 225000, 3, 0, 0, 0, 1.645, 0, 3);

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
(8, 6, 2018, 'A002', 'Meja', 3, 20000, 60000),
(9, 1, 2017, 'A002', 'Dipan', 8, 3250000, 26000000),
(10, 1, 2017, 'B004', 'Meja Makan', 4, 3000000, 12000000),
(11, 1, 2017, 'A001', 'Kursi Tamu', 4, 1200000, 4800000),
(12, 1, 2017, 'A004', 'Kursi Kerja', 7, 1100000, 7700000),
(13, 1, 2017, 'A003', 'Lemari Sliding 3 Pintu', 7, 7500000, 52500000),
(14, 1, 2017, 'B002', 'Lemari Pakaian', 4, 4650000, 18600000),
(15, 1, 2017, 'B001', 'Buffet', 6, 5150000, 30900000),
(16, 1, 2017, 'A005', 'Rak Buku', 4, 3400000, 13600000),
(17, 1, 2017, 'A006', 'Kursi Cafe', 1, 750000, 750000),
(18, 1, 2017, 'C002', 'Meja Rias', 3, 4750000, 14250000),
(19, 1, 2017, 'B003', 'Meja Kerja', 3, 2000000, 6000000),
(20, 2, 2017, 'C003', 'Sofa', 2, 6800000, 13600000),
(21, 2, 2017, 'A001', 'Kursi Tamu', 4, 1200000, 4800000),
(22, 2, 2017, 'B001', 'Buffet', 4, 5150000, 20600000),
(23, 2, 2017, 'A003', 'Lemari Sliding 3 Pintu', 5, 7500000, 37500000),
(24, 2, 2017, 'C004', 'Kursi Goyang', 2, 2200000, 4400000),
(25, 2, 2017, 'B003', 'Meja Kerja', 7, 2000000, 14000000),
(26, 2, 2017, 'A006', 'Kursi Cafe', 6, 750000, 4500000),
(27, 2, 2017, 'C001', 'Nakas', 2, 2250000, 4500000),
(28, 2, 2017, 'B002', 'Lemari Pakaian', 5, 4650000, 23250000),
(29, 2, 2017, 'A005', 'Rak Buku', 5, 3400000, 17000000),
(30, 2, 2017, 'A004', 'Kursi Kerja', 5, 1100000, 5500000),
(31, 2, 2017, 'A002', 'Dipan', 4, 3250000, 13000000),
(32, 2, 2017, 'C002', 'Meja Rias', 2, 4750000, 9500000),
(33, 2, 2017, 'B004', 'Meja Makan', 4, 3000000, 12000000),
(34, 3, 2017, 'A001', 'Kursi Tamu', 7, 1200000, 8400000),
(35, 3, 2017, 'B002', 'Lemari Pakaian', 6, 4650000, 27900000),
(36, 3, 2017, 'A002', 'Dipan', 4, 3250000, 13000000),
(37, 3, 2017, 'A004', 'Kursi Kerja', 6, 1100000, 6600000),
(38, 3, 2017, 'B001', 'Buffet', 3, 5150000, 15450000),
(39, 3, 2017, 'A003', 'Lemari Sliding 3 Pintu', 5, 7500000, 37500000),
(40, 3, 2017, 'B003', 'Meja Kerja', 2, 2000000, 4000000),
(41, 3, 2017, 'C005', 'Kitchen Set Minimalis', 1, 4750000, 4750000),
(42, 3, 2017, 'A005', 'Rak Buku', 2, 3400000, 6800000),
(43, 3, 2017, 'A006', 'Kursi Cafe', 4, 750000, 3000000),
(44, 3, 2017, 'B004', 'Meja Makan', 3, 3000000, 9000000),
(45, 3, 2017, 'C006', 'Keranjang Air Mineral Gelas', 1, 225000, 225000);

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
(1, '2017-01-01', 'A002', 'Dipan', 1, 7, 3250000),
(2, '2017-01-05', 'B004', 'Meja Makan', 1, 9, 3000000),
(3, '2017-01-05', 'A001', 'Kursi Tamu', 1, 5, 1200000),
(4, '2017-01-06', 'B004', 'Meja Makan', 1, 9, 3000000),
(5, '2017-01-06', 'A004', 'Kursi Kerja', 1, 4, 1100000),
(6, '2017-01-08', 'A003', 'Lemari Sliding 3 Pintu', 3, 11, 7500000),
(7, '2017-01-08', 'B002', 'Lemari Pakaian', 3, 9, 4650000),
(8, '2017-01-11', 'B001', 'Buffet', 3, 8, 5150000),
(9, '2017-01-12', 'A005', 'Rak Buku', 2, 6, 3400000),
(10, '2017-01-12', 'A004', 'Kursi Kerja', 1, 4, 1100000),
(11, '2017-01-14', 'A003', 'Lemari Sliding 3 Pintu', 1, 11, 7500000),
(12, '2017-01-14', 'B001', 'Buffet', 1, 8, 5150000),
(13, '2017-01-15', 'A006', 'Kursi Cafe', 1, 4, 750000),
(14, '2017-01-15', 'B004', 'Meja Makan', 1, 9, 3000000),
(15, '2017-01-17', 'A003', 'Lemari Sliding 3 Pintu', 3, 11, 7500000),
(16, '2017-01-17', 'A004', 'Kursi Kerja', 1, 4, 1100000),
(17, '2017-01-18', 'A005', 'Rak Buku', 1, 6, 3400000),
(18, '2017-01-20', 'C002', 'Meja Rias', 3, 10, 4750000),
(19, '2017-01-21', 'B001', 'Buffet', 2, 8, 5150000),
(20, '2017-01-21', 'A002', 'Dipan', 1, 7, 3250000),
(21, '2017-01-24', 'A001', 'Kursi Tamu', 1, 5, 1200000),
(22, '2017-01-27', 'A002', 'Dipan', 3, 7, 3250000),
(23, '2017-01-27', 'A004', 'Kursi Kerja', 2, 4, 1100000),
(24, '2017-01-28', 'B002', 'Lemari Pakaian', 1, 9, 4650000),
(25, '2017-01-28', 'B004', 'Meja Makan', 1, 9, 3000000),
(26, '2017-01-29', 'A001', 'Kursi Tamu', 2, 5, 1200000),
(27, '2017-01-30', 'B003', 'Meja Kerja', 3, 10, 2000000),
(28, '2017-01-30', 'A002', 'Dipan', 3, 7, 3250000),
(29, '2017-01-30', 'A004', 'Kursi Kerja', 2, 4, 1100000),
(30, '2017-01-31', 'A005', 'Rak Buku', 1, 6, 3400000),
(31, '2017-02-02', 'C003', 'Sofa', 2, 11, 6800000),
(32, '2017-02-03', 'A001', 'Kursi Tamu', 1, 5, 1200000),
(33, '2017-02-03', 'B001', 'Buffet', 1, 8, 5150000),
(34, '2017-02-04', 'A003', 'Lemari Sliding 3 Pintu', 1, 11, 7500000),
(35, '2017-02-05', 'C004', 'Kursi Goyang', 1, 6, 2200000),
(36, '2017-02-05', 'A003', 'Lemari Sliding 3 Pintu', 3, 11, 7500000),
(37, '2017-02-06', 'B003', 'Meja Kerja', 1, 10, 2000000),
(38, '2017-02-08', 'A006', 'Kursi Cafe', 2, 4, 750000),
(39, '2017-02-09', 'C001', 'Nakas', 2, 5, 2250000),
(40, '2017-02-09', 'B002', 'Lemari Pakaian', 2, 9, 4650000),
(41, '2017-02-09', 'A005', 'Rak Buku', 3, 6, 3400000),
(42, '2017-02-10', 'A004', 'Kursi Kerja', 2, 4, 1100000),
(43, '2017-02-10', 'C004', 'Kursi Goyang', 1, 6, 2200000),
(44, '2017-02-10', 'A001', 'Kursi Tamu', 2, 5, 1200000),
(45, '2017-02-11', 'A002', 'Dipan', 1, 7, 3250000),
(46, '2017-02-11', 'C002', 'Meja Rias', 2, 10, 4750000),
(47, '2017-02-12', 'A002', 'Dipan', 3, 7, 3250000),
(48, '2017-02-12', 'B004', 'Meja Makan', 3, 9, 3000000),
(49, '2017-02-14', 'A005', 'Rak Buku', 2, 6, 3400000),
(50, '2017-02-15', 'B003', 'Meja Kerja', 3, 10, 2000000),
(51, '2017-02-17', 'A001', 'Kursi Tamu', 1, 5, 1200000),
(52, '2017-02-18', 'B002', 'Lemari Pakaian', 3, 9, 4650000),
(53, '2017-02-18', 'A006', 'Kursi Cafe', 2, 4, 750000),
(54, '2017-02-21', 'A006', 'Kursi Cafe', 2, 4, 750000),
(55, '2017-02-22', 'B003', 'Meja Kerja', 3, 10, 2000000),
(56, '2017-02-25', 'A004', 'Kursi Kerja', 3, 4, 1100000),
(57, '2017-02-27', 'B001', 'Buffet', 3, 8, 5150000),
(58, '2017-02-28', 'A003', 'Lemari Sliding 3 Pintu', 1, 11, 7500000),
(59, '2017-02-28', 'B004', 'Meja Makan', 1, 9, 3000000),
(60, '2017-03-03', 'A001', 'Kursi Tamu', 1, 5, 1200000),
(61, '2017-03-04', 'B002', 'Lemari Pakaian', 3, 9, 4650000),
(62, '2017-03-05', 'A002', 'Dipan', 1, 7, 3250000),
(63, '2017-03-05', 'A004', 'Kursi Kerja', 3, 4, 1100000),
(64, '2017-03-07', 'B001', 'Buffet', 3, 8, 5150000),
(65, '2017-03-08', 'A003', 'Lemari Sliding 3 Pintu', 2, 11, 7500000),
(66, '2017-03-09', 'A001', 'Kursi Tamu', 1, 5, 1200000),
(67, '2017-03-11', 'B003', 'Meja Kerja', 2, 10, 2000000),
(68, '2017-03-11', 'A004', 'Kursi Kerja', 1, 4, 1100000),
(69, '2017-03-12', 'A003', 'Lemari Sliding 3 Pintu', 3, 11, 7500000),
(70, '2017-03-15', 'C005', 'Kitchen Set Minimalis', 1, 8, 4750000),
(71, '2017-03-15', 'A005', 'Rak Buku', 2, 6, 3400000),
(72, '2017-03-16', 'A001', 'Kursi Tamu', 3, 5, 1200000),
(73, '2017-03-16', 'A004', 'Kursi Kerja', 2, 4, 1100000),
(74, '2017-03-19', 'B002', 'Lemari Pakaian', 3, 9, 4650000),
(75, '2017-03-19', 'A006', 'Kursi Cafe', 1, 4, 750000),
(76, '2017-03-19', 'A002', 'Dipan', 3, 7, 3250000),
(77, '2017-03-21', 'B004', 'Meja Makan', 3, 5, 3000000),
(78, '2017-03-23', 'C006', 'Keranjang Air Mineral Gelas', 1, 3, 225000),
(79, '2017-03-23', 'A001', 'Kursi Tamu', 2, 5, 1200000),
(80, '2017-03-25', 'A006', 'Kursi Cafe', 3, 4, 750000);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `abcsys`
--
ALTER TABLE `abcsys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT for table `forecast`
--
ALTER TABLE `forecast`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
