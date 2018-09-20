-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Sep 2018 pada 08.44
-- Versi server: 10.1.34-MariaDB
-- Versi PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finance`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `asset`
--

CREATE TABLE `asset` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `total` varchar(535) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `asset`
--

INSERT INTO `asset` (`id`, `name`, `total`) VALUES
(1, 'Kas ditangan', '0'),
(2, 'Kas dibank', '0'),
(3, 'Peralatan', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `biaya`
--

CREATE TABLE `biaya` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `total` varchar(535) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `biaya`
--

INSERT INTO `biaya` (`id`, `name`, `total`) VALUES
(1, 'Biaya Listrik', '0'),
(2, 'Biaya Telephone', '0'),
(3, 'Biaya Internet', '0'),
(4, 'Biaya Gaji', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `debit`
--

CREATE TABLE `debit` (
  `id` int(11) NOT NULL,
  `debit` varchar(225) NOT NULL,
  `total` varchar(535) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `debit`
--

INSERT INTO `debit` (`id`, `debit`, `total`) VALUES
(1, 'Penjualan', '100000'),
(2, 'Modal', '2000000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurnal_umum`
--

CREATE TABLE `jurnal_umum` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `id_debit` int(11) NOT NULL,
  `id_kredit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jurnal_umum`
--

INSERT INTO `jurnal_umum` (`id`, `name`, `id_debit`, `id_kredit`) VALUES
(27, 'penjualan', 1, 0),
(28, 'modal', 2, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kewajiban_modal`
--

CREATE TABLE `kewajiban_modal` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `total` varchar(535) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kewajiban_modal`
--

INSERT INTO `kewajiban_modal` (`id`, `name`, `total`) VALUES
(1, 'Modal', '2100000'),
(2, 'Pinjaman', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kredit`
--

CREATE TABLE `kredit` (
  `id` int(11) NOT NULL,
  `kredit` varchar(225) NOT NULL,
  `total` varchar(535) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `modal`
--

CREATE TABLE `modal` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `total` varchar(535) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `modal`
--

INSERT INTO `modal` (`id`, `name`, `total`) VALUES
(2, 'Investasi', '0'),
(3, 'Penarikan Modal', '2000000'),
(4, 'Laporan Pendapatan', '100000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan_bersih`
--

CREATE TABLE `penjualan_bersih` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `total` varchar(535) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penjualan_bersih`
--

INSERT INTO `penjualan_bersih` (`id`, `name`, `total`) VALUES
(1, 'Penjualan', '100000'),
(2, 'Diskon Penjualan', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `post_akun`
--

CREATE TABLE `post_akun` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `debit` varchar(535) NOT NULL,
  `kredit` varchar(535) NOT NULL,
  `saldo` varchar(535) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `post_akun`
--

INSERT INTO `post_akun` (`id`, `name`, `debit`, `kredit`, `saldo`) VALUES
(1, 'Kas ditangan', '0', '0', '0'),
(2, 'Kas dibank', '0', '0', '0'),
(3, 'Peralatan', '0', '0', '0'),
(4, 'Penjualan', '100000', '0', '100000'),
(5, 'Diskon Penjualan', '0', '0', '0'),
(6, 'Biaya Listrik', '0', '0', '0'),
(7, 'Biaya Telephone', '0', '0', '0'),
(8, 'Biaya Internet', '0', '0', '0'),
(9, 'Biaya Gaji', '0', '0', '0'),
(10, 'Modal', '2000000', '0', '2000000'),
(11, 'Pinjaman', '0', '0', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `traffic`
--

CREATE TABLE `traffic` (
  `id` int(11) NOT NULL,
  `date` text NOT NULL,
  `name` text NOT NULL,
  `val` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `traffic`
--

INSERT INTO `traffic` (`id`, `date`, `name`, `val`) VALUES
(1, '2018-08-28', 'Penjualan', '0'),
(2, '2018-08-31', 'Penjualan', '0'),
(3, '2018-09-12', 'Penjualan', '0'),
(4, '2018-09-13', 'Penjualan', '0'),
(6, '2018-09-14', 'Penjualan', '0'),
(7, '2018-09-17', 'Penjualan', '2000000'),
(8, '2018-09-18', 'Penjualan', '100000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(225) NOT NULL,
  `password` varchar(535) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(6, 'usertest', '$2y$10$RZKrUWSTFcVmdQasJpp8v.SrVIk4PRwe5SIlMXtbzdmjgYirdr6pa');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `asset`
--
ALTER TABLE `asset`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `biaya`
--
ALTER TABLE `biaya`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `debit`
--
ALTER TABLE `debit`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jurnal_umum`
--
ALTER TABLE `jurnal_umum`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kewajiban_modal`
--
ALTER TABLE `kewajiban_modal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kredit`
--
ALTER TABLE `kredit`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `modal`
--
ALTER TABLE `modal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penjualan_bersih`
--
ALTER TABLE `penjualan_bersih`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `post_akun`
--
ALTER TABLE `post_akun`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `traffic`
--
ALTER TABLE `traffic`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `asset`
--
ALTER TABLE `asset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `biaya`
--
ALTER TABLE `biaya`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `debit`
--
ALTER TABLE `debit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `jurnal_umum`
--
ALTER TABLE `jurnal_umum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `kewajiban_modal`
--
ALTER TABLE `kewajiban_modal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kredit`
--
ALTER TABLE `kredit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `modal`
--
ALTER TABLE `modal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `penjualan_bersih`
--
ALTER TABLE `penjualan_bersih`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `post_akun`
--
ALTER TABLE `post_akun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `traffic`
--
ALTER TABLE `traffic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
