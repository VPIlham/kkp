-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2021 at 09:33 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nip`, `nama`, `email`, `password`, `role`, `nomor_telp`, `jk`, `created_at`) VALUES
(2, '112', 'ilham', 'ilham@gmail.com', '$2y$10$shxrnBO4Yb8SQkn7vnexS.GrBQfrqoH4W06LxQppfuQFxCjMMydli', 1, '08977166220', '0', '2021-06-07 09:21:40');

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

-- --------------------------------------------------------

--
-- Table structure for table `konfirmasi_bayar`
--

CREATE TABLE `konfirmasi_bayar` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_admin` int(5) DEFAULT NULL,
  `tiket_trx` int(11) NOT NULL,
  `image` varchar(250) DEFAULT NULL,
  `total_bayar` int(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `konfirmasi_bayar`
--

INSERT INTO `konfirmasi_bayar` (`id`, `kode_barang`, `id_pelanggan`, `id_admin`, `tiket_trx`, `image`, `total_bayar`, `created_at`) VALUES
(1, 'K001', 2, 2, 1062, '1062_image.png', 150000, '2021-06-13 07:15:15');

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
  `file_img` varchar(25) DEFAULT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `kode_barang`, `nama`, `deskripsi`, `stok`, `harga`, `view`, `file_img`, `created_by`, `created_at`) VALUES
(1, 'K001', 'Keramik Model Kembang', 'ini adalah keramik model kembang 1 box isi 3', 44, 50000, 5, 'grca.jpg', 'ilham', '2021-06-13 07:29:40');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(10) NOT NULL,
  `tiket_trx` int(50) NOT NULL,
  `produk_id` int(10) NOT NULL,
  `kode_barang` varchar(5) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jumlah_jual` int(6) NOT NULL,
  `status` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `id_admin` int(5) DEFAULT NULL,
  `id_pelanggan` int(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `tiket_trx`, `produk_id`, `kode_barang`, `nama`, `jumlah_jual`, `status`, `harga`, `total_bayar`, `id_admin`, `id_pelanggan`, `created_at`) VALUES
(1, 1062, 1, 'K001', 'Keramik Model Kembang', 3, 'SELESAI', 50000, 150000, 2, 2, '2021-06-13 07:15:15');

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
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `alamat`, `nomor_telp`, `jk`, `kota`, `provinsi`, `email`, `password`, `created_at`) VALUES
(1, 'ilham', 'jl jldah ', '08977166222', '0', 'Depok', 'Jawa Barat', 'ilhamnurhakim@gmail.com', '', '2021-06-03 17:00:00'),
(2, 'gugun', 'asda', '08977166222', '0', 'depok', 'jakarta', 'ilham@gmail.com', '$2y$10$lbWmXL7RJue4117q6/VkHehtxiabNSNujBJCL9z2ewB5Mvu2a9ssm', '2021-06-07 09:28:28');

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
-- Indexes for table `konfirmasi_bayar`
--
ALTER TABLE `konfirmasi_bayar`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `konfirmasi_bayar`
--
ALTER TABLE `konfirmasi_bayar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
