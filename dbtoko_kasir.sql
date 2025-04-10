-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Apr 2025 pada 06.38
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

--
-- Dumping data untuk tabel `tbarang`
--

INSERT INTO `tbarang` (`kd_barang`, `id_user`, `nama`, `hr_awal`, `hr_jual`, `stok`, `gambar`) VALUES
('KDB0007', 9, 'Gas Elpiji', 25000, 26000, 19, '66c8b5fb62856.png'),
('KDB0008', 9, 'Kecap Bango', 10000, 12000, 89, '66c8b60c6bc60.png'),
('KDB0009', 9, 'Indomie Goreng', 3000, 3500, 18, '66c8b61ea7c26.png'),
('KDB0010', 13, 'Sampo', 4000, 5000, 198, '67f73c0ae5230.png');

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

--
-- Dumping data untuk tabel `thdetail`
--

INSERT INTO `thdetail` (`id_detail`, `no_trans`, `kd_barang`, `nama`, `hr_awal`, `hr_jual`, `qty`, `subtotal`) VALUES
(56, 'TRS0004', 'KDB0007', 'Gas Elpiji', 25000, 26000, 1, 26000),
(57, 'TRS0004', 'KDB0008', 'Kecap Bango', 10000, 12000, 1, 12000),
(58, 'TRS0004', 'KDB0009', 'Indomie Goreng', 3000, 3500, 2, 7000),
(59, 'TRS0005', 'KDB0007', 'Gas Elpiji', 25000, 26000, 1, 26000),
(60, 'TRS0005', 'KDB0008', 'Kecap Bango', 10000, 12000, 10, 120000),
(61, 'TRS0006', 'KDB0010', 'Sampo', 4000, 5000, 2, 10000);

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

--
-- Dumping data untuk tabel `thtransaksi`
--

INSERT INTO `thtransaksi` (`no_trans`, `id_user`, `tanggal`, `total`, `bayar`, `kembalian`) VALUES
('TRS0004', 9, '2024-08-23 16:19:08', 45000, 50000, 5000),
('TRS0005', 9, '2024-08-26 13:59:38', 146000, 150000, 4000),
('TRS0006', 13, '2025-04-10 03:44:51', 10000, 12000, 2000);

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
(9, 'fadhilrafi10', 'Sumber Makmur Rezeki', 'fadhilrafi10@gmail.com', '$2y$10$AeLo/czx0Un41dat5mVpreyywwZy17vHZw9v/4beljhsKWM/BCGhO'),
(12, 'rafifauzan', 'Jaya Elektronik', 'rafi@gmail.com', '$2y$10$..kV4v0Asu2f9s4kPXHUmeJC5lLgKMLm30n/y8ihDRDV/myx6xchK'),
(13, 'kasir', 'Warung Abadi', 'kasir@mail.com', '$2y$10$qceMJF3Phz.2UjJd5.xvguiB5lJFqValbEisd1WFAuncctPNXaEQ2');

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
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT untuk tabel `tuser`
--
ALTER TABLE `tuser`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
