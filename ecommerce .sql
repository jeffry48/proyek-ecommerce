-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2021 at 03:54 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--
CREATE DATABASE IF NOT EXISTS `ecommerce` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ecommerce`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id_admin` varchar(10) NOT NULL,
  `username_admin` text NOT NULL,
  `password_admin` text NOT NULL,
  `nama_admin` text NOT NULL,
  `no_telp_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE `cart` (
  `id_cart` varchar(10) NOT NULL,
  `id_customer` varchar(10) NOT NULL,
  `id_kamar` varchar(10) NOT NULL,
  `jumlah_kamar_pesan` int(11) NOT NULL,
  `tgl_checkin` date NOT NULL,
  `tgl_checkout` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id_cart`, `id_customer`, `id_kamar`, `jumlah_kamar_pesan`, `tgl_checkin`, `tgl_checkout`) VALUES
('CA00000002', 'guest001', 'KA00000001', 5, '2021-12-16', '2021-12-18'),
('CA00000003', 'guest001', 'KA00000002', 2, '2021-12-08', '2021-12-10');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `id_customer` varchar(10) NOT NULL,
  `username_customer` text NOT NULL,
  `password_customer` text NOT NULL,
  `nama_customer` text NOT NULL,
  `no_telp_customer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `daerah`
--

DROP TABLE IF EXISTS `daerah`;
CREATE TABLE `daerah` (
  `id_daerah` varchar(10) NOT NULL,
  `nama_daerah` varchar(100) NOT NULL,
  `nama_kota` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dtrans`
--

DROP TABLE IF EXISTS `dtrans`;
CREATE TABLE `dtrans` (
  `id_dtrans` varchar(10) NOT NULL,
  `id_htrans` varchar(10) NOT NULL,
  `id_hotel` varchar(10) NOT NULL,
  `id_kategori` varchar(10) NOT NULL,
  `jumlah_kamar` int(11) NOT NULL,
  `tgl_checkin` date NOT NULL COMMENT 'per hari',
  `tgl_checkout` date NOT NULL,
  `harga_kamar` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas_hotel`
--

DROP TABLE IF EXISTS `fasilitas_hotel`;
CREATE TABLE `fasilitas_hotel` (
  `id` varchar(8) NOT NULL,
  `nama` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas_kamar`
--

DROP TABLE IF EXISTS `fasilitas_kamar`;
CREATE TABLE `fasilitas_kamar` (
  `id` varchar(8) NOT NULL,
  `nama` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fas_utk_hotel`
--

DROP TABLE IF EXISTS `fas_utk_hotel`;
CREATE TABLE `fas_utk_hotel` (
  `id` int(11) NOT NULL,
  `id_hotel` varchar(10) NOT NULL,
  `id_fas_hotel` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fas_utk_kamar`
--

DROP TABLE IF EXISTS `fas_utk_kamar`;
CREATE TABLE `fas_utk_kamar` (
  `id` int(11) NOT NULL,
  `id_kamar` varchar(10) NOT NULL,
  `id_fas_kamar` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

DROP TABLE IF EXISTS `hotel`;
CREATE TABLE `hotel` (
  `id_hotel` varchar(10) NOT NULL,
  `id_pemilik` varchar(10) NOT NULL,
  `nama_hotel` text NOT NULL,
  `bintang` int(11) NOT NULL,
  `alamat_hotel` text NOT NULL,
  `Daerah` varchar(10) NOT NULL,
  `Kota` varchar(10) NOT NULL,
  `no_telp_hotel` varchar(11) NOT NULL,
  `gambar_hotel` varchar(50) NOT NULL,
  `detail_hotel` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`id_hotel`, `id_pemilik`, `nama_hotel`, `bintang`, `alamat_hotel`, `Daerah`, `Kota`, `no_telp_hotel`, `gambar_hotel`, `detail_hotel`) VALUES
('HO00000001', 'PE00000001', 'POP HOTEL MANYAR', 2, 'Manyar  Kertoarjo 8', 'DA00000001', 'KO00000001', '0812340098', 'pop.jpg', 'HOTEL DIBANGUN OLEH BAPAK POP'),
('HO00000002', 'PE00000001', 'POP HOTEL NGAGEL', 2, 'NGAGEL JAYA 3', 'DA00000002', 'KO00000001', '0812340098', 'pop.jpg', 'HOTEL DIBANGUN OLEH BAPAK POP');

-- --------------------------------------------------------

--
-- Table structure for table `htrans`
--

DROP TABLE IF EXISTS `htrans`;
CREATE TABLE `htrans` (
  `id_htrans` varchar(10) NOT NULL,
  `id_customer` varchar(10) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `total_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kategori_hotel`
--

DROP TABLE IF EXISTS `kategori_hotel`;
CREATE TABLE `kategori_hotel` (
  `id_kategori` varchar(10) NOT NULL,
  `id_hotel` varchar(10) NOT NULL,
  `nama_kamar` varchar(50) NOT NULL,
  `jumlah_kamar` int(11) NOT NULL,
  `harga_kamar` int(11) NOT NULL,
  `gambar_kamar` varchar(50) NOT NULL,
  `detail_kamar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_hotel`
--

INSERT INTO `kategori_hotel` (`id_kategori`, `id_hotel`, `nama_kamar`, `jumlah_kamar`, `harga_kamar`, `gambar_kamar`, `detail_kamar`) VALUES
('KA00000001', 'HO00000001', 'Double Bed Room', 15, 200000, 'kamarpop1.jpg', 'Ini kamar dengan double bed cukup untuk 2 orang'),
('KA00000002', 'HO00000001', 'Queen Single Room', 15, 240000, 'kamarpop1.jpg', 'Ini kamar dengan 1 queen size bed cukup untuk 2 orang');

-- --------------------------------------------------------

--
-- Table structure for table `kota`
--

DROP TABLE IF EXISTS `kota`;
CREATE TABLE `kota` (
  `id_kota` varchar(10) NOT NULL,
  `nama_kota` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_12_02_071612_create_products_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pemilik_hotel`
--

DROP TABLE IF EXISTS `pemilik_hotel`;
CREATE TABLE `pemilik_hotel` (
  `id_pemilik` varchar(10) NOT NULL,
  `username_pemilik` text NOT NULL,
  `password_pemilik` text NOT NULL,
  `nama_pemilik` text NOT NULL,
  `no_telp_pemilik` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `promo`
--

DROP TABLE IF EXISTS `promo`;
CREATE TABLE `promo` (
  `id_promo` varchar(10) NOT NULL,
  `id_pemilik` varchar(10) NOT NULL,
  `judul_promo` text NOT NULL,
  `isi_promo` text NOT NULL,
  `id_hotel` varchar(10) NOT NULL,
  `id_product` varchar(10) NOT NULL,
  `jmlh_potongan` int(11) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_berakhir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_cart`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `daerah`
--
ALTER TABLE `daerah`
  ADD PRIMARY KEY (`id_daerah`);

--
-- Indexes for table `dtrans`
--
ALTER TABLE `dtrans`
  ADD PRIMARY KEY (`id_dtrans`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fasilitas_hotel`
--
ALTER TABLE `fasilitas_hotel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fasilitas_kamar`
--
ALTER TABLE `fasilitas_kamar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fas_utk_hotel`
--
ALTER TABLE `fas_utk_hotel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fas_utk_kamar`
--
ALTER TABLE `fas_utk_kamar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`id_hotel`);

--
-- Indexes for table `htrans`
--
ALTER TABLE `htrans`
  ADD PRIMARY KEY (`id_htrans`);

--
-- Indexes for table `kategori_hotel`
--
ALTER TABLE `kategori_hotel`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`id_kota`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pemilik_hotel`
--
ALTER TABLE `pemilik_hotel`
  ADD PRIMARY KEY (`id_pemilik`);

--
-- Indexes for table `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`id_promo`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fas_utk_hotel`
--
ALTER TABLE `fas_utk_hotel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
