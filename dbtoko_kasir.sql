-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Agu 2024 pada 10.00
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbtoko_kasir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbarang`
--

CREATE TABLE `tbarang` (
  `kd_barang` varchar(20) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `hr_awal` int(11) NOT NULL,
  `hr_jual` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `gambar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `thdetail`
--

CREATE TABLE `thdetail` (
  `id_detail` int(11) NOT NULL,
  `no_trans` varchar(50) NOT NULL,
  `kd_barang` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `hr_awal` int(11) NOT NULL,
  `hr_jual` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `thtransaksi`
--

CREATE TABLE `thtransaksi` (
  `no_trans` varchar(50) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `total` int(11) NOT NULL,
  `bayar` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tuser`
--

CREATE TABLE `tuser` (
  `id_user` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `nama_toko` varchar(50) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tuser`
--

INSERT INTO `tuser` (`id_user`, `username`, `nama_toko`, `email`, `password`) VALUES
(1, 'fadhilrafi10', 'Sumber Makmur Rezeki', 'fadhilrafi10@gmail.com', '$2y$10$YPg7pKBXwRdAZcBiErRalu3KiohKomRUmsfPELdjUlKgDFYaFly2u');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbarang`
--
ALTER TABLE `tbarang`
  ADD PRIMARY KEY (`kd_barang`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `thdetail`
--
ALTER TABLE `thdetail`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `no_trans` (`no_trans`);

--
-- Indeks untuk tabel `thtransaksi`
--
ALTER TABLE `thtransaksi`
  ADD PRIMARY KEY (`no_trans`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `tuser`
--
ALTER TABLE `tuser`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `thdetail`
--
ALTER TABLE `thdetail`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT untuk tabel `tuser`
--
ALTER TABLE `tuser`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbarang`
--
ALTER TABLE `tbarang`
  ADD CONSTRAINT `tbarang_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tuser` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `thdetail`
--
ALTER TABLE `thdetail`
  ADD CONSTRAINT `thdetail_ibfk_2` FOREIGN KEY (`no_trans`) REFERENCES `thtransaksi` (`no_trans`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `thtransaksi`
--
ALTER TABLE `thtransaksi`
  ADD CONSTRAINT `thtransaksi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tuser` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
