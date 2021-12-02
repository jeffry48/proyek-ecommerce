-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Des 2021 pada 17.55
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
-- Struktur dari tabel `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` varchar(10) NOT NULL,
  `username_admin` text NOT NULL,
  `password_admin` text NOT NULL,
  `nama_admin` text NOT NULL,
  `no_telp_admin` int(11) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id_cart` varchar(10) NOT NULL,
  `id_customer` varchar(10) NOT NULL,
  `id_hotel` varchar(10) NOT NULL,
  PRIMARY KEY (`id_cart`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id_customer` varchar(10) NOT NULL,
  `username_customer` text NOT NULL,
  `password_customer` text NOT NULL,
  `nama_customer` text NOT NULL,
  `no_telp_customer` int(11) NOT NULL,
  PRIMARY KEY (`id_customer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `daerah`
--

DROP TABLE IF EXISTS `daerah`;
CREATE TABLE IF NOT EXISTS `daerah` (
  `id_daerah` varchar(10) NOT NULL,
  `nama_daerah` varchar(100) NOT NULL,
  `nama_kota` varchar(10) NOT NULL,
  PRIMARY KEY (`id_daerah`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dtrans`
--

DROP TABLE IF EXISTS `dtrans`;
CREATE TABLE IF NOT EXISTS `dtrans` (
  `id_dtrans` varchar(10) NOT NULL,
  `id_htrans` varchar(10) NOT NULL,
  `id_hotel` varchar(10) NOT NULL,
  `id_kategori` varchar(10) NOT NULL,
  `jumlah_kamar` int(11) NOT NULL,
  `lama_menginap` int(11) NOT NULL COMMENT 'per hari',
  `harga_kamar` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  PRIMARY KEY (`id_dtrans`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `fasilitas_hotel`
--

DROP TABLE IF EXISTS `fasilitas_hotel`;
CREATE TABLE IF NOT EXISTS `fasilitas_hotel` (
  `id` varchar(8) NOT NULL,
  `nama` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `fasilitas_kamar`
--

DROP TABLE IF EXISTS `fasilitas_kamar`;
CREATE TABLE IF NOT EXISTS `fasilitas_kamar` (
  `id` varchar(8) NOT NULL,
  `nama` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `fas_utk_hotel`
--

DROP TABLE IF EXISTS `fas_utk_hotel`;
CREATE TABLE IF NOT EXISTS `fas_utk_hotel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_hotel` varchar(10) NOT NULL,
  `id_fas_hotel` varchar(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `fas_utk_kamar`
--

DROP TABLE IF EXISTS `fas_utk_kamar`;
CREATE TABLE IF NOT EXISTS `fas_utk_kamar` (
  `id` int(11) NOT NULL,
  `id_kamar` varchar(10) NOT NULL,
  `id_fas_kamar` varchar(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `hotel`
--

DROP TABLE IF EXISTS `hotel`;
CREATE TABLE IF NOT EXISTS `hotel` (
  `id_hotel` varchar(10) NOT NULL,
  `id_pemilik` varchar(10) NOT NULL,
  `nama_hotel` text NOT NULL,
  `alamat_hotel` text NOT NULL,
  `Daerah` varchar(10) NOT NULL,
  `Kota` varchar(10) NOT NULL,
  `no_telp_hotel` varchar(11) NOT NULL,
  `gambar_hotel` varchar(50) NOT NULL,
  `detail_hotel` text NOT NULL,
  PRIMARY KEY (`id_hotel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `hotel`
--

INSERT INTO `hotel` (`id_hotel`, `id_pemilik`, `nama_hotel`, `alamat_hotel`, `Daerah`, `Kota`, `no_telp_hotel`, `gambar_hotel`, `detail_hotel`) VALUES
('HO00000001', 'PE00000001', 'POP HOTEL MANYAR', 'Manyar  Kertoarjo 8', 'DA00000001', 'KO00000001', '0812340098', 'pop.jpg', 'HOTEL DIBANGUN OLEH BAPAK POP'),
('HO00000002', 'PE00000001', 'POP HOTEL NGAGEL', 'NGAGEL JAYA 3', 'DA00000002', 'KO00000001', '0812340098', 'pop.jpg', 'HOTEL DIBANGUN OLEH BAPAK POP');

-- --------------------------------------------------------

--
-- Struktur dari tabel `htrans`
--

DROP TABLE IF EXISTS `htrans`;
CREATE TABLE IF NOT EXISTS `htrans` (
  `id_htrans` varchar(10) NOT NULL,
  `id_customer` varchar(10) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `total_harga` int(11) NOT NULL,
  PRIMARY KEY (`id_htrans`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_hotel`
--

DROP TABLE IF EXISTS `kategori_hotel`;
CREATE TABLE IF NOT EXISTS `kategori_hotel` (
  `id_kategori` varchar(10) NOT NULL,
  `id_hotel` varchar(10) NOT NULL,
  `jumlah_kamar` int(11) NOT NULL,
  `harga_kamar` int(11) NOT NULL,
  `available` int(11) NOT NULL,
  `gambar_kamar` varchar(50) NOT NULL,
  `detail_kamar` text NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kota`
--

DROP TABLE IF EXISTS `kota`;
CREATE TABLE IF NOT EXISTS `kota` (
  `id_kota` varchar(10) NOT NULL,
  `nama_kota` varchar(100) NOT NULL,
  PRIMARY KEY (`id_kota`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_12_02_071612_create_products_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemilik_hotel`
--

DROP TABLE IF EXISTS `pemilik_hotel`;
CREATE TABLE IF NOT EXISTS `pemilik_hotel` (
  `id_pemilik` varchar(10) NOT NULL,
  `username_pemilik` text NOT NULL,
  `password_pemilik` text NOT NULL,
  `nama_pemilik` text NOT NULL,
  `no_telp_pemilik` int(11) NOT NULL,
  PRIMARY KEY (`id_pemilik`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `promo`
--

DROP TABLE IF EXISTS `promo`;
CREATE TABLE IF NOT EXISTS `promo` (
  `id_promo` varchar(10) NOT NULL,
  `id_pemilik` varchar(10) NOT NULL,
  `judul_promo` text NOT NULL,
  `isi_promo` text NOT NULL,
  PRIMARY KEY (`id_promo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
