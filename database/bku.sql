-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2023 at 03:54 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bku`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kas__keluars`
--

CREATE TABLE `kas__keluars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_kas_keluar` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `penanggung_jawab` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int(11) NOT NULL,
  `bukti` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kas__keluars`
--

INSERT INTO `kas__keluars` (`id`, `kode_kas_keluar`, `tanggal`, `penanggung_jawab`, `keterangan`, `jumlah`, `bukti`, `created_at`, `updated_at`) VALUES
(10, 'KE00001', '2023-06-01', 'Azis', 'Iuran', 5000, 'BA500', '2023-06-15 19:14:30', '2023-06-15 19:16:32'),
(11, 'KE00002', '2023-06-02', 'Azis', 'belanja2', 20000, 'BA501', '2023-06-15 19:22:35', '2023-06-19 21:12:59');

--
-- Triggers `kas__keluars`
--
DELIMITER $$
CREATE TRIGGER `deleteKeluar` AFTER DELETE ON `kas__keluars` FOR EACH ROW BEGIN
UPDATE totals set total_kas_keluar = total_kas_keluar - old.jumlah
WHERE id = 1;
UPDATE totals set total = total + old.jumlah
WHERE id = 1;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tambaKeluar` AFTER INSERT ON `kas__keluars` FOR EACH ROW BEGIN
UPDATE totals set total_kas_keluar = total_kas_keluar + NEW.jumlah
WHERE id = 1;
UPDATE totals set total = total - NEW.jumlah
WHERE id = 1;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `updateKeluar1` AFTER UPDATE ON `kas__keluars` FOR EACH ROW BEGIN
UPDATE totals set total_kas_keluar = total_kas_keluar - old.jumlah
WHERE id = 1;
UPDATE totals set total = total + old.jumlah
WHERE id = 1;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `updateKeluar2` BEFORE UPDATE ON `kas__keluars` FOR EACH ROW BEGIN
UPDATE totals set total_kas_keluar = total_kas_keluar + New.jumlah
WHERE id = 1;
UPDATE totals set total = total - New.jumlah
WHERE id = 1;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `kas__masuks`
--

CREATE TABLE `kas__masuks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_kas_masuk` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `penanggung_jawab` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` int(11) NOT NULL,
  `bukti` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kas__masuks`
--

INSERT INTO `kas__masuks` (`id`, `kode_kas_masuk`, `tanggal`, `penanggung_jawab`, `keterangan`, `jumlah`, `bukti`, `created_at`, `updated_at`) VALUES
(50, 'MA00001', '2023-06-01', 'Azis', 'Pendapatan', 16000, 'BA500', '2023-06-15 19:15:53', '2023-06-15 19:18:41'),
(51, 'MA00002', '2023-06-02', 'Azis', 'Uang Kas', 50000, 'BA501', '2023-06-15 19:22:06', '2023-06-19 21:12:32');

--
-- Triggers `kas__masuks`
--
DELIMITER $$
CREATE TRIGGER `deleteMasuk` AFTER DELETE ON `kas__masuks` FOR EACH ROW BEGIN
UPDATE totals set total_kas_masuk = total_kas_masuk - old.jumlah
WHERE id = 1;
UPDATE totals set total = total - old.jumlah
WHERE id = 1;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tambahMasuk` AFTER INSERT ON `kas__masuks` FOR EACH ROW BEGIN
UPDATE totals set total_kas_masuk = total_kas_masuk + NEW.jumlah
WHERE id = 1;
UPDATE totals set total = total + NEW.jumlah
WHERE id = 1;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `updateMasuk1` AFTER UPDATE ON `kas__masuks` FOR EACH ROW BEGIN
UPDATE totals set total_kas_masuk = total_kas_masuk - old.jumlah
WHERE id = 1;
UPDATE totals set total = total - old.jumlah
WHERE id = 1;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `updateMasuk2` BEFORE UPDATE ON `kas__masuks` FOR EACH ROW BEGIN
UPDATE totals set total_kas_masuk = total_kas_masuk + NEW.jumlah
WHERE id = 1;
UPDATE totals set total = total + NEW.jumlah
WHERE id = 1;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `laporans`
--

CREATE TABLE `laporans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_laporan` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dari_tanggal` date NOT NULL,
  `sampai_tanggal` date NOT NULL,
  `status` int(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laporans`
--

INSERT INTO `laporans` (`id`, `kode_laporan`, `dari_tanggal`, `sampai_tanggal`, `status`, `created_at`, `updated_at`) VALUES
(1, 'LP00001', '2023-06-01', '2023-06-01', 1, '2023-06-06 18:52:46', '2023-06-19 20:02:09'),
(2, 'LP00002', '2023-05-01', '2023-05-30', 2, '2023-06-06 18:59:38', '2023-06-06 18:59:38');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2013_06_04_131949_create_roles_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2023_06_04_132014_create_profiles_table', 1),
(6, '2023_06_04_132030_create_kas__masuks_table', 1),
(7, '2023_06_04_132041_create_kas__keluars_table', 1),
(8, '2023_06_04_132104_create_totals_table', 1),
(9, '2023_06_04_132119_create_laporans_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telepon` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tandatangan` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `nama`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `no_telepon`, `jenis_kelamin`, `foto`, `tandatangan`, `users_id`, `created_at`, `updated_at`) VALUES
(6, 'Asep', 'Cianjur', '2023-06-26', 'Kp.Kadupugur RT.01 RW.05 Desa.Cisarandi Kec.Warungkondang Kab.Cianjur Jawa Barat', '085846638166', 'Pria', 'foto1687755807.png', NULL, 2, '2023-06-25 21:26:48', '2023-06-25 22:03:27'),
(7, 'Rispi', 'Cianjur', '2023-06-26', 'Kp.Kadupugur RT.01 RW.05 Desa.Cisarandi Kec.Warungkondang Kab.Cianjur Jawa Barat', '085846638166', 'Wanita', 'foto1687757218.png', 'tandatangan.jpg', 1, '2023-06-25 21:27:36', '2023-06-25 22:26:58');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2023-06-04 06:41:56', '2023-06-04 06:41:56'),
(2, 'Bensek', '2023-06-04 06:41:56', '2023-06-04 06:41:56'),
(3, 'Kepsek', '2023-06-04 06:41:56', '2023-06-04 06:41:56');

-- --------------------------------------------------------

--
-- Table structure for table `totals`
--

CREATE TABLE `totals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `total` int(11) NOT NULL,
  `total_kas_masuk` int(11) NOT NULL,
  `total_kas_keluar` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `totals`
--

INSERT INTO `totals` (`id`, `total`, `total_kas_masuk`, `total_kas_keluar`, `created_at`, `updated_at`) VALUES
(1, 41000, 66000, 25000, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles_id` bigint(20) UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `email_verified_at`, `password`, `roles_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Bensek', 'bensek@gmail.com', NULL, '$2y$10$8Ol.yc16leeGZ85telVQu.t9R4cRBV7uEnO8/kwnIG.LBL9iTsh8q', 2, NULL, '2023-06-04 06:42:06', '2023-06-25 21:44:02'),
(2, 'Kepsek', 'kepsek@gmail.com', NULL, '$2y$10$G362Fy28UbyFPMb3H/MKd.TFtlYdbXr/srvbieOWj2L0DDtTUJLSa', 3, NULL, '2023-06-04 06:42:06', '2023-06-25 21:56:41'),
(3, 'Admin', 'admin@gmail.com', NULL, '$2y$10$ycc.jCNV32KKzz.1Ma9UJu.gxPb9UZFlR6sU05FNDub1/VsKKvVpu', 1, NULL, '2023-06-04 06:42:06', '2023-06-25 20:33:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `kas__keluars`
--
ALTER TABLE `kas__keluars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kas__masuks`
--
ALTER TABLE `kas__masuks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporans`
--
ALTER TABLE `laporans`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profiles_users_id_foreign` (`users_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `totals`
--
ALTER TABLE `totals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_roles_id_foreign` (`roles_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kas__keluars`
--
ALTER TABLE `kas__keluars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `kas__masuks`
--
ALTER TABLE `kas__masuks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `laporans`
--
ALTER TABLE `laporans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `totals`
--
ALTER TABLE `totals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_roles_id_foreign` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
