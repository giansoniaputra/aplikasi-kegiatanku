-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Feb 2023 pada 11.14
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jadwal_uum`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `combat_point`
--

CREATE TABLE `combat_point` (
  `id` int(11) NOT NULL,
  `quest_point` int(11) DEFAULT NULL,
  `user` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `combat_point`
--

INSERT INTO `combat_point` (`id`, `quest_point`, `user`) VALUES
(0, 50, 'admin@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `generate_jadwal`
--

CREATE TABLE `generate_jadwal` (
  `id` int(11) NOT NULL,
  `id_kegiatan` int(11) NOT NULL,
  `nama_kegiatan` varchar(225) NOT NULL,
  `tanggal` date NOT NULL,
  `tingkat` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  `user` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `generate_jadwal`
--

INSERT INTO `generate_jadwal` (`id`, `id_kegiatan`, `nama_kegiatan`, `tanggal`, `tingkat`, `status`, `user`) VALUES
(2, 2, 'Olahraga 30 Menit', '2023-02-14', 2, 1, 'admin@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `referensi_kegiatan`
--

CREATE TABLE `referensi_kegiatan` (
  `id` int(11) NOT NULL,
  `nama_kegiatan` varchar(225) NOT NULL,
  `tingkat` int(1) NOT NULL,
  `user` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `referensi_kegiatan`
--

INSERT INTO `referensi_kegiatan` (`id`, `nama_kegiatan`, `tingkat`, `user`) VALUES
(2, 'Olahraga 30 Menit', 2, 'admin@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `token`
--

CREATE TABLE `token` (
  `id` int(11) NOT NULL,
  `token` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(2, 'admin', 'admin@gmail.com', 'default.png', '$2y$10$IEbJ0XJwbget82yl.qAeZOMveFLHtQ3MPM8XTVgPOhivUSbHDE.pW', 2, 1, 1676369578);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_role`
--

CREATE TABLE `users_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users_role`
--

INSERT INTO `users_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Member');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `combat_point`
--
ALTER TABLE `combat_point`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `generate_jadwal`
--
ALTER TABLE `generate_jadwal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `referensi_kegiatan`
--
ALTER TABLE `referensi_kegiatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users_role`
--
ALTER TABLE `users_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `generate_jadwal`
--
ALTER TABLE `generate_jadwal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `referensi_kegiatan`
--
ALTER TABLE `referensi_kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `token`
--
ALTER TABLE `token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users_role`
--
ALTER TABLE `users_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
