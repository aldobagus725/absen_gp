-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Jun 2022 pada 15.48
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_gp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absen_gp`
--

CREATE TABLE `absen_gp` (
  `id` int(11) NOT NULL,
  `id_sektor` int(11) NOT NULL,
  `nama_lengkap` varchar(500) NOT NULL,
  `nomor_telepon` varchar(17) NOT NULL,
  `is_katekisan` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `absen_gp`
--

INSERT INTO `absen_gp` (`id`, `id_sektor`, `nama_lengkap`, `nomor_telepon`, `is_katekisan`, `created_at`, `updated_at`) VALUES
(9, 1, '123321', '123321', 'true', '2022-06-26 23:45:17', '2022-06-26 23:45:17'),
(10, 7, 'halo', '12321', 'false', '2022-06-26 23:45:35', '2022-06-26 23:45:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sektor`
--

CREATE TABLE `sektor` (
  `id` int(11) NOT NULL,
  `sektor` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `sektor`
--

INSERT INTO `sektor` (`id`, `sektor`, `created_at`, `updated_at`) VALUES
(1, 'Anthiokia', '2022-06-26 23:35:15', '2022-06-26 23:35:15'),
(2, 'Betlehem', '2022-06-26 23:39:16', '2022-06-26 23:39:16'),
(3, 'Corinthians', '2022-06-26 23:42:54', '2022-06-26 23:42:54'),
(4, 'Damsyik', '2022-06-26 23:43:54', '2022-06-26 23:43:54'),
(5, 'Efrata', '2022-06-26 23:44:27', '2022-06-26 23:44:27'),
(6, 'Filipi', '2022-06-26 23:44:50', '2022-06-26 23:44:50'),
(7, 'Galilea', '2022-06-26 23:44:58', '2022-06-26 23:44:58'),
(8, 'Hermon', '2022-06-26 23:45:05', '2022-06-26 23:45:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(500) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `id_role`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 1, 'superadmin', '$2y$10$TbFE4oJxfM4oKSHEhTHbluS5t6JH3xxh.6u7wsjgFBS2nz/2skclG', '2022-06-26 16:30:52', '2022-06-26 16:30:52'),
(2, 2, 'admin_gp', '$2y$10$bIawfq4YrTunQoRtuc6.SeFnPykG/UFNxPZZBnbxEJ24ijZXaR44K', '0000-00-00 00:00:00', '2022-06-27 20:38:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_role`
--

CREATE TABLE `users_role` (
  `id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users_role`
--

INSERT INTO `users_role` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', '2022-06-26 16:29:06', '2022-06-26 16:29:06'),
(2, 'admin', '2022-06-26 16:29:06', '2022-06-26 16:29:06'),
(3, 'aha', '0000-00-00 00:00:00', '2022-06-27 20:56:29');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absen_gp`
--
ALTER TABLE `absen_gp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users` (`id_sektor`);

--
-- Indeks untuk tabel `sektor`
--
ALTER TABLE `sektor`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_role` (`id_role`);

--
-- Indeks untuk tabel `users_role`
--
ALTER TABLE `users_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absen_gp`
--
ALTER TABLE `absen_gp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `sektor`
--
ALTER TABLE `sektor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users_role`
--
ALTER TABLE `users_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `absen_gp`
--
ALTER TABLE `absen_gp`
  ADD CONSTRAINT `fk_users` FOREIGN KEY (`id_sektor`) REFERENCES `sektor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_role` FOREIGN KEY (`id_role`) REFERENCES `users_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
