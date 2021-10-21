-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Okt 2021 pada 17.03
-- Versi server: 10.4.18-MariaDB
-- Versi PHP: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proto_ben`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kanal`
--

CREATE TABLE `kanal` (
  `id` int(11) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `keterangan` text NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kanal`
--

INSERT INTO `kanal` (`id`, `nama`, `keterangan`, `status`) VALUES
(10, 'Kanal', 'asdasd', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kanal_data`
--

CREATE TABLE `kanal_data` (
  `id` int(11) NOT NULL,
  `id_kanal` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `caption` text NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kanal_data`
--

INSERT INTO `kanal_data` (`id`, `id_kanal`, `judul`, `gambar`, `caption`, `status`) VALUES
(1, 0, 'coba', '1634685385_c9c001abc18c55be8ef6.jfif', '', 1),
(9, 10, 'judul - 3', '1634735434_59decaa3c5da154c9fa1.jfif', 'caption - 3', 1),
(10, 10, 'judul - 2', '1634778132_91890057352481af224f.jfif', 'caption - 2', 1),
(11, 10, 'judul - 1 ', '1634828252_0b36079ae8b63c63e7d3.jpg', 'caption - 1', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_hp` varchar(16) NOT NULL,
  `email` varchar(60) NOT NULL,
  `alamat` text NOT NULL,
  `foto` varchar(60) NOT NULL,
  `exp` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `member`
--

INSERT INTO `member` (`id`, `nama`, `no_hp`, `email`, `alamat`, `foto`, `exp`) VALUES
(10, 'coba', '00000000000', 'tes@coba.com', '', '', '2022-05-20'),
(11, 'coba', '00000000000', 'tes@coba.com', '', '', '0000-00-00'),
(12, 'coba', '00000000000', 'tes@coba.com', '', '', '0000-00-00'),
(13, 'coba', '00000000000', 'tes@coba.com', '', '', '0000-00-00'),
(14, 'coba', '00000000000', 'tes@coba.com', '', '', '0000-00-00'),
(15, 'coba', '00000000000', 'tes@coba.com', '', '', '2022-12-20'),
(16, 'coba', '00000000000', 'tes@coba.com', '', '', '0000-00-00'),
(17, 'coba1', '1111111111', 'coba1@gmail.com', '', '', '0000-00-00'),
(18, 'coba2', '08123123123', 'coba2@coba.com', '', '', '0000-00-00'),
(19, 'coba2', '08123123123', 'coba2@coba.com', '', '', '0000-00-00'),
(20, 'coba3', '08123123123', 'coba3@coba.com', '', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `register_wizard`
--

CREATE TABLE `register_wizard` (
  `id` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `bukti_pembayaran` varchar(255) NOT NULL,
  `status` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `register_wizard`
--

INSERT INTO `register_wizard` (`id`, `id_member`, `bukti_pembayaran`, `status`) VALUES
(1, 15, '', 'OK'),
(2, 16, '', 'Menunggu Pemabayaran'),
(3, 17, '', 'Menunggu Pemabayaran'),
(4, 18, '', 'Menunggu Pemabayaran'),
(5, 20, '1634598468_6a85bcd8b238a14f6172.jfif', 'OK');

-- --------------------------------------------------------

--
-- Struktur dari tabel `setup`
--

CREATE TABLE `setup` (
  `id` int(11) NOT NULL,
  `durasi` int(11) NOT NULL,
  `harga` float NOT NULL,
  `rekening` varchar(20) NOT NULL,
  `atas_nama` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `setup`
--

INSERT INTO `setup` (`id`, `durasi`, `harga`, `rekening`, `atas_nama`) VALUES
(1, 7, 3000000, '021254256', 'PT. Sukses Selalu Selamanya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `no_hp` varchar(16) NOT NULL,
  `email` varchar(60) NOT NULL,
  `alamat` text NOT NULL,
  `foto` varchar(60) NOT NULL,
  `status` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `staff`
--

INSERT INTO `staff` (`id`, `nama`, `no_hp`, `email`, `alamat`, `foto`, `status`) VALUES
(1, 'coba22', '083216546846', 'asd@asd.com', 'asd', '1634737474_47edf6f842d60ae0d6ea.jfif', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `username` varchar(60) NOT NULL,
  `password` text NOT NULL,
  `source_id` int(11) NOT NULL,
  `source_table` varchar(60) NOT NULL,
  `role` varchar(20) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`username`, `password`, `source_id`, `source_table`, `role`, `status`) VALUES
('coba', '123456', 16, 'member', 'user', 'created'),
('coba1', '123456', 17, 'member', 'user', 'created'),
('coba2', '123456', 18, 'member', 'user', 'created'),
('coba3', '123456', 20, 'member', 'user', 'created'),
('userpalingtinggi', '587922d4220862c627fb6fef47825db1', 0, '', 'super_user', 'publish');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kanal`
--
ALTER TABLE `kanal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kanal_data`
--
ALTER TABLE `kanal_data`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `register_wizard`
--
ALTER TABLE `register_wizard`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `setup`
--
ALTER TABLE `setup`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kanal`
--
ALTER TABLE `kanal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `kanal_data`
--
ALTER TABLE `kanal_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `register_wizard`
--
ALTER TABLE `register_wizard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `setup`
--
ALTER TABLE `setup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
