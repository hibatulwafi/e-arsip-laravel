-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2021 at 10:51 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_arsip`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1),
(2, 'App\\User', 2),
(2, 'App\\User', 3);

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'manajemen users', 'web', '2021-04-18 15:59:32', '2021-04-18 15:59:32'),
(2, 'manajemen roles', 'web', '2021-04-18 15:59:32', '2021-04-18 15:59:32'),
(3, 'manajemen arsip', 'web', '2021-04-18 15:59:32', '2021-04-18 15:59:32'),
(4, 'manajemen rak', 'web', '2021-04-18 15:59:32', '2021-04-18 15:59:32'),
(5, 'manajemen transaksi', 'web', '2021-04-18 15:59:32', '2021-04-18 15:59:32'),
(6, 'manajemen peminjaman', 'web', '2021-04-26 22:17:21', '2021-04-27 03:29:37');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2021-04-18 15:59:32', '2021-04-18 15:59:32'),
(2, 'pegawai', 'web', '2021-04-18 15:59:32', '2021-04-18 15:59:32');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `favicon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_right` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_left` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `favicon`, `logo`, `app_name`, `footer_right`, `footer_left`, `created_at`, `updated_at`) VALUES
(1, 'favicon_default.ico', 'logo_default.png', 'E - Arsip', 'Ver 1.0', 'E - Arsip 2021', '2021-04-18 15:59:33', '2021-04-18 16:09:46');

-- --------------------------------------------------------

--
-- Table structure for table `tb_arsip`
--

CREATE TABLE `tb_arsip` (
  `id_arsip` int(11) NOT NULL,
  `id_rak` int(11) NOT NULL,
  `nama_arsip` varchar(100) NOT NULL,
  `keterangan_arsip` varchar(255) NOT NULL,
  `no_polis` varchar(50) NOT NULL,
  `no_kontrak` varchar(50) NOT NULL,
  `tanggal_valid` date NOT NULL,
  `nama_customer` varchar(100) NOT NULL,
  `status_arsip` int(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_arsip`
--

INSERT INTO `tb_arsip` (`id_arsip`, `id_rak`, `nama_arsip`, `keterangan_arsip`, `no_polis`, `no_kontrak`, `tanggal_valid`, `nama_customer`, `status_arsip`, `created_at`, `updated_at`) VALUES
(2, 1, 'Arsip jkt0021', 'Lorem Ipsum Dolor sit amet', 'SMI-112002', 'K-ADS-110012', '2021-04-27', 'Valdy Rizky', 1, '2021-04-19 14:00:24', '2021-04-19 14:14:18'),
(3, 1, 'Arsip SMI 02', 'Lorem Ipsum', 'SMI-112001', 'K-ADS-110011', '2022-10-27', 'Hibatul Wafi', 1, '2021-04-26 06:48:41', '2021-04-27 02:39:21'),
(4, 5, 'Arsip SMI 03', 'Lorem Ipsum Dolor Sit Amet', 'SMI-112002', 'K-ADS-110012', '2021-04-28', 'Scarlet Witch', 2, '2021-04-27 02:57:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_peminjaman`
--

CREATE TABLE `tb_peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `tanggal_peminjaman` date NOT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `id_arsip` int(11) NOT NULL,
  `nama_peminjam` varchar(100) NOT NULL,
  `id_peminjam` int(11) DEFAULT NULL,
  `id_petugas` int(11) NOT NULL,
  `status_peminjaman` int(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_peminjaman`
--

INSERT INTO `tb_peminjaman` (`id_peminjaman`, `tanggal_peminjaman`, `tanggal_kembali`, `id_arsip`, `nama_peminjam`, `id_peminjam`, `id_petugas`, `status_peminjaman`, `created_at`, `updated_at`) VALUES
(1, '2021-01-04', NULL, 2, 'Mikasa Ackerman', 2, 1, 0, '2021-04-19 22:40:26', '2021-04-19 23:07:45'),
(2, '2021-01-04', '2021-04-27', 2, 'Mikasa Ackerman', 2, 1, 3, '2021-04-19 22:42:17', '2021-04-27 14:04:48'),
(3, '2021-01-06', '2021-04-27', 2, 'Armin Arlert', 3, 1, 3, '2021-04-19 23:08:11', '2021-04-27 14:04:43'),
(4, '2021-01-21', '2021-01-23', 2, 'Mikasa Ackerman', 2, 1, 3, '2021-04-19 23:08:32', NULL),
(5, '2021-04-27', NULL, 4, 'Armin Arlert', 3, 1, 2, '2021-04-27 03:38:40', NULL),
(6, '2021-04-27', '2021-04-27', 2, 'Mikasa Ackerman', 2, 1, 3, '2021-04-27 06:03:35', '2021-04-27 14:04:22'),
(8, '2021-04-27', '2021-04-27', 2, 'Mikasa Ackerman', 2, 1, 3, '2021-04-27 13:07:15', '2021-04-27 14:04:10'),
(9, '2021-04-27', '2021-04-27', 3, 'Mikasa Ackerman', 2, 1, 3, '2021-04-27 13:40:30', '2021-04-27 14:04:32'),
(10, '2021-04-27', '2021-04-27', 3, 'Mikasa Ackerman', 2, 1, 3, '2021-04-27 13:43:08', '2021-04-27 14:04:27'),
(11, '2021-04-27', '2021-04-27', 3, 'Mikasa Ackerman', 2, 1, 3, '2021-04-27 13:43:36', '2021-04-27 14:03:13'),
(12, '2021-04-27', NULL, 3, 'Mikasa Ackerman', 2, 1, 0, '2021-04-27 14:05:00', '2021-04-27 14:07:41'),
(13, '2021-04-27', NULL, 3, 'Mikasa Ackerman', 2, 0, 1, '2021-04-27 14:07:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengembalian`
--

CREATE TABLE `tb_pengembalian` (
  `id_pengembalian` int(11) NOT NULL,
  `id_peminjaman` int(11) NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `id_arsip` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pengembalian`
--

INSERT INTO `tb_pengembalian` (`id_pengembalian`, `id_peminjaman`, `tanggal_pengembalian`, `id_arsip`, `created_at`, `updated_at`) VALUES
(1, 11, '2021-04-27', 3, '2021-04-27 14:03:13', NULL),
(2, 8, '2021-04-27', 2, '2021-04-27 14:04:10', NULL),
(3, 6, '2021-04-27', 2, '2021-04-27 14:04:22', NULL),
(4, 10, '2021-04-27', 3, '2021-04-27 14:04:27', NULL),
(5, 9, '2021-04-27', 3, '2021-04-27 14:04:32', NULL),
(6, 3, '2021-04-27', 2, '2021-04-27 14:04:43', NULL),
(7, 2, '2021-04-27', 2, '2021-04-27 14:04:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_rak`
--

CREATE TABLE `tb_rak` (
  `id_rak` int(11) NOT NULL,
  `kode_rak` varchar(20) NOT NULL,
  `nama_rak` varchar(50) NOT NULL,
  `keterangan_rak` varchar(255) NOT NULL,
  `status_rak` int(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_rak`
--

INSERT INTO `tb_rak` (`id_rak`, `kode_rak`, `nama_rak`, `keterangan_rak`, `status_rak`, `created_at`, `updated_at`) VALUES
(1, 'RK-001', 'Rak 1', 'Rak Menyimpan Arsip Dinamis', 1, '2021-04-19 15:01:10', '2021-04-27 02:32:38'),
(4, 'RK-002', 'Rak 2', 'Rak Menyimpan Arsip Statis', 1, '2021-04-19 14:06:31', '2021-04-27 02:33:30'),
(5, 'RK-003', 'Rak 3', 'Rak Menyimpan Arsip Terjaga', 1, '2021-04-27 02:33:49', NULL),
(6, 'RK-004', 'Rak 4', 'Rak Menyimpan Arsip Umum', 1, '2021-04-27 02:34:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Eren Jaeger', 'admin@admin.com', 1, NULL, '$2y$10$1dM3IB1vCYEnU540zJmAjewmMvxcqRi2jPD10ptMFM3YCiNKebGri', NULL, '2021-04-18 15:59:32', '2021-04-18 15:59:32'),
(2, 'Mikasa Ackerman', 'user1@example.com', 1, NULL, '$2y$10$9K8yNbYlj9FNIHA.G4I.pOLoQKxrB0s15LzAaMa7KK9o2M8m19jSG', NULL, '2021-04-18 15:59:32', '2021-04-18 15:59:32'),
(3, 'Armin Arlert', 'user2@example.com', 1, NULL, '$2y$10$1oEEgG7pEnrnEPLxf7WhY.4PFleWpCetv9WoTNGs6CRYMLhmGWbgi', NULL, '2021-04-18 15:59:33', '2021-04-18 15:59:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_arsip`
--
ALTER TABLE `tb_arsip`
  ADD PRIMARY KEY (`id_arsip`);

--
-- Indexes for table `tb_peminjaman`
--
ALTER TABLE `tb_peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`);

--
-- Indexes for table `tb_pengembalian`
--
ALTER TABLE `tb_pengembalian`
  ADD PRIMARY KEY (`id_pengembalian`);

--
-- Indexes for table `tb_rak`
--
ALTER TABLE `tb_rak`
  ADD PRIMARY KEY (`id_rak`);

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
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_arsip`
--
ALTER TABLE `tb_arsip`
  MODIFY `id_arsip` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_peminjaman`
--
ALTER TABLE `tb_peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_pengembalian`
--
ALTER TABLE `tb_pengembalian`
  MODIFY `id_pengembalian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_rak`
--
ALTER TABLE `tb_rak`
  MODIFY `id_rak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
