-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Jul 2023 pada 12.00
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aptavis`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `klasemen`
--

CREATE TABLE `klasemen` (
  `id` int(25) NOT NULL,
  `nama_klub` varchar(25) NOT NULL,
  `ma` int(25) NOT NULL,
  `me` int(25) NOT NULL,
  `s` int(25) NOT NULL,
  `k` int(25) NOT NULL,
  `gm` int(25) NOT NULL,
  `gk` int(25) NOT NULL,
  `point` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `klasemen`
--

INSERT INTO `klasemen` (`id`, `nama_klub`, `ma`, `me`, `s`, `k`, `gm`, `gk`, `point`) VALUES
(1, 'PERSIB', 2, 2, 0, 0, 4, 0, 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `klub`
--

CREATE TABLE `klub` (
  `id` int(11) NOT NULL,
  `nama_klub` varchar(25) DEFAULT NULL,
  `kota_klub` varchar(25) NOT NULL,
  `skor` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `klub`
--

INSERT INTO `klub` (`id`, `nama_klub`, `kota_klub`, `skor`) VALUES
(9, 'PERSIB', 'Bandung', 1),
(10, 'PSIS', 'Semarang', 0),
(11, 'PERSIJA', 'Jakarta', 0),
(13, 'Arema', 'Malang', 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `klasemen`
--
ALTER TABLE `klasemen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_klub` (`nama_klub`);

--
-- Indeks untuk tabel `klub`
--
ALTER TABLE `klub`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nim` (`nama_klub`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `klasemen`
--
ALTER TABLE `klasemen`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `klub`
--
ALTER TABLE `klub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
