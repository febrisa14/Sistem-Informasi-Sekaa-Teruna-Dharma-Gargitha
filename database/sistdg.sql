-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Jun 2021 pada 07.37
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistdg`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `anggota_id` int(10) UNSIGNED NOT NULL,
  `anggota_user_id` int(10) UNSIGNED NOT NULL,
  `tgl_lahir` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempekan` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `umur` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`anggota_id`, `anggota_user_id`, `tgl_lahir`, `jenis_kelamin`, `tempekan`, `umur`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 3, '14-02-1999', 'Laki - Laki', 'Kauh', '22', 'Jalan Raya Sesetan Gang Tripang No. 5', '2021-03-31 04:55:08', '2021-04-10 13:24:46'),
(2, 5, '20-01-2000', 'Laki - Laki', 'Kauh', '21', 'Jalan Raya Sesetan Gang Tripang No. 5', '2021-04-01 03:48:45', '2021-04-01 03:48:45'),
(5, 8, '02-11-2003', 'Perempuan', 'Kauh', '18', 'Jalan Raya Sesetan Gang Tripang No.5', '2021-05-22 04:11:44', '2021-05-22 04:11:44'),
(6, 9, '14-05-2003', 'Laki - Laki', 'Kangin', '18', 'Jalan Kresek', '2021-05-24 02:13:13', '2021-05-24 02:13:13'),
(7, 11, '20-11-1998', 'Laki - Laki', 'Kubu', '23', 'Jalan Raya Sesetan Gang Lumba - Lumba II No. 10', '2021-05-25 02:12:41', '2021-05-25 02:12:41'),
(8, 13, '19-03-1992', 'Laki - Laki', 'Kauh', '29', 'Jalan Raya Sesetan No. 625', '2021-05-26 13:08:50', '2021-05-26 13:08:50'),
(9, 14, '23-08-2001', 'Perempuan', 'Kangin', '20', 'Jalan Suwung Batan Kendal No. 17', '2021-05-26 13:09:59', '2021-05-26 13:09:59'),
(10, 15, '13-05-2002', 'Perempuan', 'Kubu', '19', 'Jalan Raya Sesetan Gang Lumba - Lumba No. 8c', '2021-05-26 13:11:24', '2021-05-26 13:11:24'),
(11, 18, '18-07-2002', 'Laki - Laki', 'Kubu', '19', 'Jalan Suwung Batan Kendal', '2021-05-27 03:27:38', '2021-05-27 03:27:38'),
(12, 20, '25-07-2001', 'Laki - Laki', 'Kubu', '20', 'Jalan Raya Suwung Batan Kendal', '2021-05-27 06:05:45', '2021-05-27 06:12:14'),
(28, 22, '03-06-2003', 'Laki - Laki', 'Kangin', '18', 'Jalan Raya Suwung Batan Kendal', '2021-06-08 02:41:48', '2021-06-08 02:45:34'),
(29, 23, '13-03-2002', 'Perempuan', 'Kangin', '19', 'Jalan Raya Suwung Batan Kendal', '2021-06-08 02:46:41', '2021-06-08 02:46:41'),
(31, 24, '25-01-2001', 'Laki - Laki', 'Kubu', '20', 'Jalan Raya Suwung Batan Kendal', '2021-06-12 00:52:28', '2021-06-12 00:52:28'),
(32, 25, '10-09-2002', 'Laki - Laki', 'Kangin', '19', 'Jalan Raya Suwung Batan Kendal', '2021-06-12 00:53:41', '2021-06-12 00:53:41'),
(33, 26, '19-10-2001', 'Laki - Laki', 'Kangin', '20', 'Jalan Raya Suwung Batan Kendal', '2021-06-12 00:54:51', '2021-06-12 00:54:51'),
(34, 27, '01-05-2000', 'Laki - Laki', 'Kubu', '21', 'Jalan Raya Suwung Batan Kendal', '2021-06-12 00:55:46', '2021-06-12 00:55:46'),
(35, 28, '15-07-2002', 'Perempuan', 'Kangin', '19', 'Jalan Raya Suwung Batan Kendal', '2021-06-12 00:56:43', '2021-06-12 00:56:43'),
(36, 29, '17-11-1999', 'Laki - Laki', 'Kauh', '22', 'Jalan Raya Sesetan Gang Lumba - Lumba', '2021-06-12 00:59:49', '2021-06-12 00:59:49'),
(37, 30, '08-08-1998', 'Laki - Laki', 'Kauh', '23', 'Jalan Raya Sesetan Gang Tripang No.3', '2021-06-12 01:00:53', '2021-06-12 01:00:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `baju`
--

CREATE TABLE `baju` (
  `baju_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_baju` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_baju` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_batas_order` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `baju`
--

INSERT INTO `baju` (`baju_id`, `nama_baju`, `deskripsi`, `foto_baju`, `harga`, `tgl_batas_order`, `created_at`, `updated_at`) VALUES
('BJU1620017475', 'Baju Ogoh - Ogoh Tahun 2020', 'Size Cewek :\r\n- M => p x l (64cm x 46cm)\r\n- L  => p x l (66cm x 47cm)\r\n- XL => p x l (68cm x 49cm)\r\n- XXL => p x l (70cm x 51cm)\r\n\r\nSize Cowok :\r\n- M => p x l (69cm x 48cm)\r\n- L  => p x l (72cm x 50cm)\r\n- XL => p x l (75cm x 53cm)\r\n- XXL => p x l (77cm x 55cm)', '1621927933.jpg', '75000', '2020-02-27', '2021-05-03 04:51:15', '2021-06-16 01:23:25'),
('BJU1622093074', 'Baju Ogoh - Ogoh Tahun 2021', 'Size Cewek :\r\n- M => p x l (64cm x 46cm)\r\n- L  => p x l (66cm x 47cm)\r\n- XL => p x l (68cm x 49cm)\r\n- XXL => p x l (70cm x 51cm)\r\n\r\nSize Cowok :\r\n- M => p x l (69cm x 48cm)\r\n- L  => p x l (72cm x 50cm)\r\n- XL => p x l (75cm x 53cm)\r\n- XXL => p x l (77cm x 55cm)', '1622093072.jpg', '85000', '2021-06-30', '2021-05-27 05:24:34', '2021-05-27 05:24:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `jabatan_id` int(10) UNSIGNED NOT NULL,
  `nama_jabatan` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`jabatan_id`, `nama_jabatan`, `created_at`, `updated_at`) VALUES
(1, 'Ketua STT', '2021-03-31 04:56:01', '2021-03-31 04:56:01'),
(2, 'Wakil Ketua STT', '2021-03-31 04:56:01', '2021-03-31 04:56:01'),
(3, 'Sekretaris 1', '2021-03-31 04:56:33', '2021-03-31 04:56:33'),
(4, 'Sekretaris 2', '2021-03-31 04:56:33', '2021-03-31 04:56:33'),
(5, 'Bendahara 1', '2021-03-31 04:57:11', '2021-03-31 04:57:11'),
(6, 'Bendahara 2', '2021-03-31 04:57:11', '2021-03-31 04:57:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_kegiatan`
--

CREATE TABLE `jenis_kegiatan` (
  `jenis_kegiatan_id` int(10) UNSIGNED NOT NULL,
  `nama_jenis_kegiatan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jenis_kegiatan`
--

INSERT INTO `jenis_kegiatan` (`jenis_kegiatan_id`, `nama_jenis_kegiatan`, `created_at`, `updated_at`) VALUES
(7, 'Rapat', '2021-03-31 08:20:50', '2021-03-31 08:20:50'),
(9, 'Ngayah', '2021-04-06 06:39:28', '2021-04-06 06:39:28'),
(10, 'Tirta Yatra', '2021-04-06 06:39:37', '2021-04-06 06:39:37'),
(11, 'HUT Sekaa Teruna', '2021-04-06 06:40:15', '2021-04-06 06:40:15'),
(12, 'Medelokan', '2021-04-10 13:01:04', '2021-04-10 13:01:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kas`
--

CREATE TABLE `kas` (
  `no_transaksi_kas` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pengurus_id` int(10) UNSIGNED NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `nominal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kas`
--

INSERT INTO `kas` (`no_transaksi_kas`, `pengurus_id`, `type`, `tgl_transaksi`, `nominal`, `deskripsi`, `created_at`, `updated_at`) VALUES
('IN1621662567', 1, 'Pemasukan', '2021-04-20', '6000000', 'Parkir Indomaret', '2021-05-22 05:49:27', '2021-05-25 06:21:05'),
('IN1621666782', 1, 'Pemasukan', '2021-05-10', '5000000', 'Parkir BCA', '2021-05-22 06:59:42', '2021-05-22 06:59:42'),
('IN1621666900', 1, 'Pemasukan', '2021-05-20', '4500000', 'Parkir Indomaret', '2021-05-22 07:01:40', '2021-05-22 07:01:40'),
('IN1622078450', 1, 'Pemasukan', '2021-05-22', '1900000', 'Hadiah Juara 1 Lomba Foto Alat Peraga KPU', '2021-05-27 01:20:50', '2021-05-27 01:21:30'),
('IN1622078749', 1, 'Pemasukan', '2021-05-22', '7650000', 'Hadiah Juara 2 Lomba Film Mebarung', '2021-05-27 01:25:49', '2021-05-27 01:25:49'),
('IN1623459466', 1, 'Pemasukan', '2021-06-12', '1000000', 'Upah Satgas Covid-19', '2021-06-12 00:57:46', '2021-06-12 00:57:46'),
('OUT1621656078', 1, 'Pengeluaran', '2021-04-30', '3500000', 'Beli Alat - Alat Penjor', '2021-05-22 04:01:18', '2021-05-25 06:45:43'),
('OUT1621662930', 1, 'Pengeluaran', '2021-05-02', '200000', 'Hadiah Pernikahan I Komang Adi Suryawan', '2021-05-22 05:55:30', '2021-05-22 05:55:30'),
('OUT1621822862', 1, 'Pengeluaran', '2021-05-24', '3000000', 'Persiapan Lomba HUT', '2021-05-24 02:21:02', '2021-05-24 02:21:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatan`
--

CREATE TABLE `kegiatan` (
  `kegiatan_id` int(10) UNSIGNED NOT NULL,
  `nama_kegiatan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kegiatan_id` int(10) UNSIGNED NOT NULL,
  `tgl_kegiatan` date NOT NULL,
  `jam_kegiatan` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pengurus_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pakaian` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lampiran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kegiatan`
--

INSERT INTO `kegiatan` (`kegiatan_id`, `nama_kegiatan`, `jenis_kegiatan_id`, `tgl_kegiatan`, `jam_kegiatan`, `lokasi`, `pengurus_id`, `created_at`, `updated_at`, `pakaian`, `lampiran`) VALUES
(13, 'Pembuatan Penjor Persiapan Piodalan', 9, '2021-05-25', '15:00', 'Pura Dalem Suwung Batan Kendal', 1, '2021-05-02 04:15:25', '2021-05-26 13:16:27', 'Adat Madya', NULL),
(14, 'Rapat Akhir Bulan Mei 2021', 7, '2021-05-31', '19:00', 'Banjar Suwung Batan Kendal', 1, '2021-05-27 01:19:00', '2021-05-27 01:19:00', 'Adat Madya', NULL),
(15, 'Lomba Futsal Antar Tempekan', 11, '2021-06-14', '10:00', 'Sorao Futsal', 1, '2021-05-31 06:45:41', '2021-05-31 06:45:41', 'Jersey Futsal', NULL),
(16, 'Medelokan Pernikahan I Wayan Surya', 12, '2021-06-21', '20:00', 'Rumah I Wayan Surya', 1, '2021-06-12 04:36:51', '2021-06-12 04:36:51', 'Adat Madya', NULL),
(18, 'Penanaman Pohon di Setra Suwung', 9, '2021-06-19', '08:00', 'Setra Suwung Batan Kendal', 1, '2021-06-16 01:59:59', '2021-06-16 03:03:11', 'Bebas Rapi', '1623812591_Penanaman_Pohon_Lampiran.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_03_07_000000_create_users_table', 1),
(2, '2021_03_06_015610_create_anggota_table', 1),
(3, '2021_03_06_015806_create_jabatan_table', 1),
(4, '2021_03_06_015906_create_pengurus_table', 1),
(5, '2021_03_16_202147_create_jenis_kegiatan_table', 1),
(6, '2021_03_16_202236_create_kegiatan_table', 1),
(7, '2021_03_31_145616_add_kegiatan_user_id_to_kegiatan_table', 2),
(8, '2021_04_02_203353_create_password_resets_table', 3),
(9, '2021_04_02_203740_add_remember_token_to_users_table', 4),
(10, '2021_04_07_212731_add_pakaian_to_kegiatan_table', 5),
(11, '2021_04_12_110842_create_products_table', 6),
(12, '2021_05_03_195042_create_orders_table', 7),
(13, '2021_05_21_023000_create_kas_table', 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE `pemesanan` (
  `no_pesanan` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `anggota_id` int(10) UNSIGNED NOT NULL,
  `baju_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_pesanan` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_bayar` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pemesanan`
--

INSERT INTO `pemesanan` (`no_pesanan`, `anggota_id`, `baju_id`, `size`, `tgl_pesanan`, `tgl_bayar`, `total`, `status`, `created_at`, `updated_at`) VALUES
('ORDER1618293892', 1, 'BJU1620017475', 'XL', '2021-05-23 15:52:43', '2021-05-31', '75000', 'Selesai', '2021-05-24 07:52:43', '2021-05-24 07:52:43'),
('ORDER1621657374', 5, 'BJU1620017475', 'L', '2021-05-22 12:22:54', '2021-05-31', '75000', 'Selesai', '2021-05-22 04:22:54', '2021-05-26 14:59:48'),
('ORDER1621842763', 6, 'BJU1620017475', 'XL', '2021-05-24 15:52:43', '2021-05-31', '75000', 'Selesai', '2021-05-24 07:52:43', '2021-05-24 07:52:43'),
('ORDER1622095666', 12, 'BJU1622093074', 'XL', '2021-05-27 14:07:46', NULL, '85000', 'Menunggu', '2021-05-27 06:07:46', '2021-05-27 06:07:46'),
('ORDER1622442300', 1, 'BJU1622093074', 'XL', '2021-05-31 14:25:00', NULL, '85000', 'Menunggu', '2021-05-31 06:25:00', '2021-05-31 06:30:58'),
('ORDER1623121569', 28, 'BJU1622093074', 'L', '2021-06-08 11:06:09', NULL, '85000', 'Menunggu', '2021-06-08 03:06:09', '2021-06-08 03:06:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengurus`
--

CREATE TABLE `pengurus` (
  `pengurus_id` int(10) UNSIGNED NOT NULL,
  `pengurus_user_id` int(10) UNSIGNED NOT NULL,
  `tgl_lahir` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pengurus_jabatan_id` int(10) UNSIGNED DEFAULT NULL,
  `umur` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pengurus`
--

INSERT INTO `pengurus` (`pengurus_id`, `pengurus_user_id`, `tgl_lahir`, `jenis_kelamin`, `pengurus_jabatan_id`, `umur`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 1, '23-04-1999', 'Laki - Laki', 1, '22', 'Jalan Raya Sesetan Gang Tripang No. 5', '2021-03-31 04:54:20', '2021-05-29 11:15:44'),
(2, 4, '23-07-1998', 'Laki - Laki', 2, '23', 'Jalan Raya Sesetan Gang Mali - Mali No. 8', '2021-03-31 06:02:00', '2021-05-26 07:52:32'),
(10, 16, '19-06-1997', 'Laki - Laki', 4, '24', 'Jalan Suwung Batan Kendal', '2021-05-31 02:01:53', '2021-05-31 02:02:29'),
(11, 12, '17-07-1997', 'Laki - Laki', 5, '24', 'Jalan Raya Suwung Batan Kendal No. 4', '2021-05-31 02:02:47', '2021-05-31 02:03:01'),
(12, 10, '21-08-1997', 'Perempuan', 3, '24', 'Jalan Kubu', '2021-05-31 02:05:08', '2021-05-31 02:05:22'),
(20, 19, '25-09-2003', 'Perempuan', 6, '18', 'Jalan Raya Suwung', '2021-06-12 03:38:40', '2021-06-12 03:38:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `role`, `no_telp`, `avatar`, `created_at`, `updated_at`) VALUES
(1, 'I Komang Adi Dharmayasa', 'komangadi@gmail.com', '$2y$10$9ckeP0CM2Hf6x7hbuALaVe6gAgvhKo5dik6XkHtmZVwQ.XO008gZy', 'Pengurus', '088299912321', 'default.png', '2021-03-31 04:42:37', '2021-05-29 11:15:44'),
(3, 'I Gede Febrisa Permana', 'febrisapermana80@gmail.com', '$2y$10$5XeLbAqSMYfDdOAMJI.9MuMOKlzWzfYWwSJg52FgsfvWeTxoQoDci', 'Anggota', '088219009419', '1617969620.jpg', '2021-03-31 04:55:07', '2021-05-11 07:48:52'),
(4, 'I Gede Dony Mahendra', 'gededony@gmail.com', '$2y$10$6wcBaQTg.0I6SN6uolQJhOsjf930gm0HqBuUeETGvNrRMQ2ctt6Jm', 'Pengurus', '087182391232', 'default.png', '2021-03-31 06:02:00', '2021-05-26 07:52:32'),
(5, 'I Made Krisna Sanjaya', 'krisnasanjaya@gmail.com', '$2y$10$rjzsy/74D6nRZYZCMzKdAuWrvV3vh6RufCCu2SD9vxIHdCFjX3b4K', 'Anggota', '088219992123', 'default.png', '2021-04-01 03:48:45', '2021-04-01 03:48:45'),
(8, 'Ni Made Vina Novarina', 'vinanova@gmail.com', '$2y$10$LODFpNpOISPR4DtS2IqzkeJamuiuUHuOAFqhRmD0s../5dcrK3KI.', 'Anggota', '089123789231', 'default.png', '2021-05-22 04:11:44', '2021-05-22 04:11:44'),
(9, 'I Komang Wiryanata', 'wiryanata@gmail.com', '$2y$10$VMyOrT5EYtrw0nukdwkUteb3Ir1eueAMoF/xYzgx.oFLPoAflglpy', 'Anggota', '087213981293', 'default.png', '2021-05-24 02:13:13', '2021-05-24 02:13:13'),
(10, 'Ni Kadek Ranis Santya Dewi', 'sekretaris1@gmail.com', '$2y$10$FtByp9WAV1pmEZ1LJjFU1.T5nXuFJPGWf89aJ0CO4E.A71KJW4qxS', 'Pengurus', '087892083282', 'default.png', '2021-05-24 06:06:25', '2021-05-31 02:05:22'),
(11, 'I Gede Yoga Arimbawa', 'yogaarimbawa@gmail.com', '$2y$10$j/XCRQTjzjaad13QzU6N/.Oga1RiswbDoeQheL65yyqmJcIHdLQ5e', 'Anggota', '085238912892', 'default.png', '2021-05-25 02:12:41', '2021-05-25 02:12:41'),
(12, 'I Made Pradipta Januartha', 'bendahara1@gmail.com', '$2y$10$5hopXZdFWLnn2n8Psz5D.ua/I.eraBN0viz0daxNJXsN.Uwdv41BG', 'Pengurus', '088299128312', 'default.png', '2021-05-25 02:14:36', '2021-05-31 02:03:01'),
(13, 'I Nyoman Sudarsana', 'anggota6@gmail.com', '$2y$10$sS8KJ3ppuj7pN9rgz8r01eoL4/HAZoR0R5sPBpK5.iWbqRjybrh5i', 'Anggota', '085289129122', 'default.png', '2021-05-26 13:08:50', '2021-05-26 13:08:50'),
(14, 'Ni Komang Tri Wulandari', 'anggota7@gmail.com', '$2y$10$b3FAfBfa0L3Fw78Cz0eHEeL2BLYd1A.oaGIKJk5Lt3HCDH1uFBpMq', 'Anggota', '088923812398', 'default.png', '2021-05-26 13:09:59', '2021-05-26 13:09:59'),
(15, 'Ni Kadek Lenia', 'anggota8@gmail.com', '$2y$10$8a1KyQ8324GZhQ9.TL9IJubooCzIjF5NvgWOiHqrnb7LhacKWaUUO', 'Anggota', '08621831232', 'default.png', '2021-05-26 13:11:24', '2021-05-26 13:11:24'),
(16, 'I Ketut Alit Astika', 'sekretaris2@gmail.com', '$2y$10$Y4Qp.fm8RakdLbX1dddq6.YfB3XTBK3/exaBcP5c6cIABX97y2vC2', 'Pengurus', '08238748727', 'default.png', '2021-05-27 01:11:31', '2021-05-31 02:02:29'),
(18, 'I Kadek Wardana', 'anggota10@gmail.com', '$2y$10$ATD7SAf5Cl7z4Cn3E7Y2RuP44PXx8bI5yjfycjQKUfgAux.hXFx6u', 'Anggota', '08723892982', 'default.png', '2021-05-27 03:27:38', '2021-05-27 03:27:38'),
(19, 'Ni Kadek Ria', 'bendahara2@gmail.com', '$2y$10$Ue4DiGGynnQzb3SWKZomsudEoLNbkHnDOku9SeQ0/F7qvWe1lr3u2', 'Pengurus', '08729812323', 'default.png', '2021-05-27 03:29:55', '2021-06-12 03:38:53'),
(20, 'I Gede Jordi Lesmana', 'anggota11@gmail.com', '$2y$10$0e1FJAmDmXLmLpvbi/m4xO6QlVv9YNDFh4E1tmj2voDQQM5BvzdLq', 'Anggota', '08823992382', 'default.png', '2021-05-27 06:05:45', '2021-05-27 06:12:14'),
(22, 'I Kadek Budi', 'anggota21@gmail.com', '$2y$10$PjAlLw8flXXFXu82epL6SuVnX3X4zRzo2mpHOWl0pgrVHAgE9z8aG', 'Anggota', '08829291123', 'default.png', '2021-06-08 02:41:48', '2021-06-08 02:45:34'),
(23, 'Ni Kadek Rasmini', 'anggota22@gmail.com', '$2y$10$.KpouycSbLX60u8kM32wouC7Sk24Pss6r0nbZZ4uioCOMtlOq58IK', 'Anggota', '085213812981', 'default.png', '2021-06-08 02:46:41', '2021-06-08 02:46:41'),
(24, 'I Wayan Pastika Yasa', 'wayanpastika@gmail.com', '$2y$10$QAGrXFpOX8hK3L4iffiD3O8D3A2wsnORersvKz1QLGiWHjGJZWuaK', 'Anggota', '08823198123', 'default.png', '2021-06-12 00:52:28', '2021-06-12 00:52:28'),
(25, 'A.A Putu Yoga Susila', 'idabagusyoga@gmail.com', '$2y$10$UBCYu6BU8iR9hlUKt/Mz6uaV0wcz9c3KeZQm9eupAeIZpZVTa3cWW', 'Anggota', '087882391298', 'default.png', '2021-06-12 00:53:41', '2021-06-12 00:53:41'),
(26, 'I Kadek Yogi Mahendra', 'yogimahendra@gmail.com', '$2y$10$LnS0.fsvpu04LKc6b47udOXcXoiDkllM1pmaTRdCnTq6Tf5be.s7e', 'Anggota', '0812312982', 'default.png', '2021-06-12 00:54:51', '2021-06-12 00:54:51'),
(27, 'I Putu Ardana Yasa', 'putuardanayasa@gmail.com', '$2y$10$tXOGr/hCBF3NZKE9YBhdyOeG2yy/EXd6rYhjIOltpHZZh9FAOMuaK', 'Anggota', '0851928391298', 'default.png', '2021-06-12 00:55:46', '2021-06-12 00:55:46'),
(28, 'Ni Komang Sri Wedari', 'nikomangsriwedari@gmail.com', '$2y$10$O18zmxoI9YrqLFKonn7ySeNLvIyxn5rJzgsN8a998W5NywxWrqR/C', 'Anggota', '085238756483', 'default.png', '2021-06-12 00:56:43', '2021-06-12 00:56:43'),
(29, 'Kadek Andy Sadewa', 'kadekandysadewa@gmail.com', '$2y$10$7XZhKj8epVjQxgFx0/0Vj.iA3ijN4RZpyvKpMaUIiVnyDl9.FULk2', 'Anggota', '087878546273', 'default.png', '2021-06-12 00:59:48', '2021-06-12 00:59:48'),
(30, 'I Made Yudi Putra', 'madeyudiputra@gmail.com', '$2y$10$mRZrmPJFGPHOOs/ocxW8R..tp8LKVUNyYyZaYGHEDAxAGh0oZjlrC', 'Anggota', '089672937492', 'default.png', '2021-06-12 01:00:53', '2021-06-12 01:00:53');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`anggota_id`),
  ADD KEY `anggota_anggota_user_id_foreign` (`anggota_user_id`);

--
-- Indeks untuk tabel `baju`
--
ALTER TABLE `baju`
  ADD PRIMARY KEY (`baju_id`);

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`jabatan_id`);

--
-- Indeks untuk tabel `jenis_kegiatan`
--
ALTER TABLE `jenis_kegiatan`
  ADD PRIMARY KEY (`jenis_kegiatan_id`);

--
-- Indeks untuk tabel `kas`
--
ALTER TABLE `kas`
  ADD PRIMARY KEY (`no_transaksi_kas`),
  ADD KEY `kas_pengurus_id_foreign` (`pengurus_id`);

--
-- Indeks untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`kegiatan_id`),
  ADD KEY `kegiatan_jenis_kegiatan_id_foreign` (`jenis_kegiatan_id`),
  ADD KEY `kegiatan_user_id_foreign` (`pengurus_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`no_pesanan`),
  ADD KEY `pemesanan_anggota_id_foreign` (`anggota_id`),
  ADD KEY `pemesanan_baju_id_foreign` (`baju_id`);

--
-- Indeks untuk tabel `pengurus`
--
ALTER TABLE `pengurus`
  ADD PRIMARY KEY (`pengurus_id`),
  ADD KEY `pengurus_pengurus_user_id_foreign` (`pengurus_user_id`),
  ADD KEY `pengurus_pengurus_jabatan_id_foreign` (`pengurus_jabatan_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `anggota`
--
ALTER TABLE `anggota`
  MODIFY `anggota_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `jabatan_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `jenis_kegiatan`
--
ALTER TABLE `jenis_kegiatan`
  MODIFY `jenis_kegiatan_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `kegiatan_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `pengurus`
--
ALTER TABLE `pengurus`
  MODIFY `pengurus_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD CONSTRAINT `anggota_anggota_user_id_foreign` FOREIGN KEY (`anggota_user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kas`
--
ALTER TABLE `kas`
  ADD CONSTRAINT `kas_pengurus_id_foreign` FOREIGN KEY (`pengurus_id`) REFERENCES `pengurus` (`pengurus_id`);

--
-- Ketidakleluasaan untuk tabel `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD CONSTRAINT `kegiatan_jenis_kegiatan_id_foreign` FOREIGN KEY (`jenis_kegiatan_id`) REFERENCES `jenis_kegiatan` (`jenis_kegiatan_id`),
  ADD CONSTRAINT `kegiatan_pengurus_id_foreign` FOREIGN KEY (`pengurus_id`) REFERENCES `pengurus` (`pengurus_id`);

--
-- Ketidakleluasaan untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_anggota_id_foreign` FOREIGN KEY (`anggota_id`) REFERENCES `anggota` (`anggota_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pemesanan_baju_id_foreign` FOREIGN KEY (`baju_id`) REFERENCES `baju` (`baju_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengurus`
--
ALTER TABLE `pengurus`
  ADD CONSTRAINT `pengurus_pengurus_jabatan_id_foreign` FOREIGN KEY (`pengurus_jabatan_id`) REFERENCES `jabatan` (`jabatan_id`),
  ADD CONSTRAINT `pengurus_pengurus_user_id_foreign` FOREIGN KEY (`pengurus_user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
