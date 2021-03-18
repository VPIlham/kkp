-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2021 at 05:11 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kkp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nip` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` tinyint(1) NOT NULL,
  `nomor_telp` varchar(14) NOT NULL,
  `jk` varchar(5) NOT NULL,
  `file_img` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nip`, `nama`, `email`, `password`, `role`, `nomor_telp`, `jk`, `file_img`, `created_at`) VALUES
(2, '112', 'ilham', 'ilham@gmail.com', '$2y$10$shxrnBO4Yb8SQkn7vnexS.GrBQfrqoH4W06LxQppfuQFxCjMMydli', 1, '08977166220', '0', '', '2021-02-28 12:55:39'),
(11, '122', 'winwin', 'loselose@gmail.com', '$2y$10$zxdUTWePhh6Tm/KVxO8B6ebBUoHjli6dLFfurUYfobDfQAPvnC5Ea', 0, '08586335498', '0', 'IMG_20210130_110807.jpg', '2021-03-05 17:12:16'),
(13, '123', 'renjun', 'renjun@gmail.com', '$2y$10$iAZJFxb9H1ZhuwnSO5eFselNHtJOTLT4fHHOihBAutyWJBt8TEygG', 0, '0986345637', '0', 'IMG_20210128_163641.jpg', '2021-03-05 17:13:01');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nomor_telp` varchar(14) NOT NULL,
  `email` varchar(100) NOT NULL,
  `deskripsi` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `nama`, `nomor_telp`, `email`, `deskripsi`, `created_at`) VALUES
(1, 'ilham', '08977166220', 'ilhamnurhakim378@gmail.com', 'ini deksripsi', '2021-03-06 06:20:38'),
(2, 'aaa', '089723121', 'gilang@gmail.com', 'dada', '2021-03-06 06:24:14'),
(4, 'haha@gmail.com', '081237812631', 'iasdasdasd@gmail.com', 'asdasda', '2021-03-06 06:26:11');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `deskripsi` varchar(250) DEFAULT NULL,
  `stok` int(7) NOT NULL,
  `harga` int(10) NOT NULL,
  `view` int(11) NOT NULL DEFAULT 0,
  `file_img` text DEFAULT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `kode_barang`, `nama`, `deskripsi`, `stok`, `harga`, `view`, `file_img`, `created_by`, `created_at`) VALUES
(4, 'A001', 'GRC Kerawangan Type A', 'Harga diatas termasuk harga permeter', 20, 550000, 5, 'grca.jpg', 'ilham', '2021-03-06 15:54:59'),
(5, 'B001', 'GRC Kerawangan Type B', 'Harga diatas termasuk harga permeter', 20, 550000, 0, 'grcb.jpg', 'ilham', '2021-03-06 15:33:25'),
(6, 'C001', 'GRC Kerawangan Type C', 'Harga diatas termasuk harga permeter', 18, 550000, 0, 'grcc.jpg', 'ilham', '2021-03-06 15:33:27'),
(7, 'D001', 'GRC Masif Type D', 'Harga diatas termasuk harga permeter', 20, 550000, 5, 'grcd.jpg', 'ilham', '2021-03-06 15:57:12'),
(8, 'E001', 'GRC Masif Type E', 'Harga diatas termasuk harga permeter', 20, 550000, 6, 'grce.jpg', 'ilham', '2021-03-06 16:10:52'),
(9, 'F001', 'GRC Cladding Type F', 'Harga diatas termasuk harga permeter', 20, 550000, 0, 'grcf.jpg', 'ilham', '2021-03-06 15:33:44'),
(10, 'G001', 'GRC Cladding Type G', 'Harga diatas termasuk harga permeter', 20, 475000, 0, 'grcg.jpg', 'ilham', '2021-03-06 15:33:49');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(10) NOT NULL,
  `tiket_trx` varchar(50) NOT NULL,
  `produk_id` int(10) NOT NULL,
  `kode_barang` varchar(5) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jumlah_jual` int(6) NOT NULL,
  `status` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `id_admin` int(5) NOT NULL,
  `id_pelanggan` int(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `tiket_trx`, `produk_id`, `kode_barang`, `nama`, `jumlah_jual`, `status`, `harga`, `total_bayar`, `id_admin`, `id_pelanggan`, `created_at`) VALUES
(1, '123', 2, 'k003', 'grc karawangan transaksi', 5, 'DIPROSES', 150000, 750000, 0, 0, '2021-03-06 10:37:54'),
(3, 'a003', 0, 'koo7', 'bata', 2, 'SELESAI', 12000, 24000, 112, 3, '2021-03-06 10:37:37');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(5) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `nomor_telp` varchar(14) NOT NULL,
  `jk` varchar(10) NOT NULL,
  `kota` varchar(150) DEFAULT NULL,
  `provinsi` varchar(100) NOT NULL,
  `email` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `alamat`, `nomor_telp`, `jk`, `kota`, `provinsi`, `email`, `created_at`) VALUES
(1, 'Nadiem', 'jl pekapuran', '0891231231', '1', 'Depok', 'Jakarta', 'nadiem@gmail.com', '2021-03-06 08:38:37'),
(2, 'makarim', 'jl depok', '0182381231', '0', 'Depok', 'Jawa Tengah', 'makarim@gmail.com', '2021-03-06 08:41:31'),
(3, 'jokowi', 'Jl pekapuran rt 02/04 Curug, Cimanggis, depok', '023812738121', 'Jenis Kela', 'Depok', 'Jawa Barat', 'joki@mailc.om', '2021-03-01 17:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nip` (`nip`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_barang` (`kode_barang`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tiket_trx` (`tiket_trx`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
