-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2019 at 09:09 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel-crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `telpon` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id`, `nama`, `telpon`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 'Sarjono', '907079', 'depok', '2019-07-20 02:30:44', '0000-00-00 00:00:00'),
(2, 'Dwi Aja', '311531', 'jakarta', '2019-07-20 02:30:44', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE `mapel` (
  `id` int(11) NOT NULL,
  `kode` varchar(191) NOT NULL,
  `nama` varchar(191) NOT NULL,
  `semester` varchar(45) NOT NULL,
  `guru_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`id`, `kode`, `nama`, `semester`, `guru_id`, `created_at`, `updated_at`) VALUES
(1, 'M-001', 'Matematika', 'ganjil', 1, '2019-07-17 07:59:14', '0000-00-00 00:00:00'),
(2, 'B-001', 'Bahasa Indonesia', 'ganjil', 1, '2019-07-17 07:59:14', '0000-00-00 00:00:00'),
(3, 'F-001', 'Fisika', 'genap', 2, '2019-07-18 14:45:03', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `mapel_siswa`
--

CREATE TABLE `mapel_siswa` (
  `id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `mapel_id` int(11) NOT NULL,
  `nilai` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mapel_siswa`
--

INSERT INTO `mapel_siswa` (`id`, `siswa_id`, `mapel_id`, `nilai`, `created_at`, `updated_at`) VALUES
(5, 23, 1, 90, '2019-07-18 00:03:50', '2019-07-19 09:18:04'),
(6, 23, 2, 80, '2019-07-18 03:31:25', '2019-07-19 09:33:35'),
(7, 27, 1, 30, '2019-07-18 03:41:10', '2019-07-19 09:17:42'),
(8, 27, 2, 98, '2019-07-18 03:41:16', '2019-07-18 10:41:16'),
(10, 24, 2, 78, '2019-07-18 06:17:24', '2019-07-18 13:17:24'),
(12, 24, 3, 88, '2019-07-18 15:16:08', '0000-00-00 00:00:00'),
(13, 27, 3, 77, '2019-07-18 08:22:45', '2019-07-18 15:22:45'),
(14, 29, 1, 76, '2019-07-19 21:32:16', '2019-07-20 04:32:16'),
(15, 29, 3, 88, '2019-07-19 21:32:31', '2019-07-20 04:32:31'),
(16, 29, 2, 67, '2019-07-19 21:32:40', '2019-07-20 04:32:40');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_07_13_074712_create_siswa_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama_depan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_belakang` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_kelamin` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `user_id`, `nama_depan`, `nama_belakang`, `jenis_kelamin`, `agama`, `alamat`, `avatar`, `created_at`, `updated_at`) VALUES
(24, 11, 'apriliana Indah', 'Lestari', 'P', 'islam', 'pekalongan', NULL, '2019-07-17 19:35:45', '2019-07-20 01:22:53'),
(28, 15, 'Muhamad', 'Farhan', 'L', 'islam', 'tambun', NULL, '2019-07-19 21:12:14', '2019-07-19 21:12:14'),
(29, 16, 'Suwasti', NULL, 'P', 'Islam', 'jogja', NULL, '2019-07-19 21:13:02', '2019-07-19 21:13:02'),
(30, 17, 'Satria', 'adhi', 'L', 'islam', 'bekasi', NULL, '2019-07-19 21:13:37', '2019-07-19 21:13:37'),
(31, 18, 'Fajar', 'Eka', 'L', 'islam', 'tambun', NULL, '2019-07-20 00:41:43', '2019-07-20 00:41:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `role` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Adhi', 'satriaadhi04@gmail.com', '$2y$10$RmW8VBA0BuGSvjk63UUn8eZ3tX7nAhjcToJ9g5b0yptO7A8FRBIKO', 'TAKS2WGT3hPpRkQWy8VOmq2RmDKmzDT4aELkXKp9yE2YSjA5vguOnbsVXsWK', '2019-07-16 05:04:55', '2019-07-16 05:04:55'),
(11, 'siswa', 'apriliana Indah', 'april@gmail.com', '$2y$10$cT9eb8s141spx2wmCpTsyeIts4joBxljC8.wrnvyuE4r1FPe1LLnW', 'DK2ivHK1DwUICkkBZ7JzQJEmDGq7MkSZUGxZeZLF6Jc0yTA1CYWp2zqaXIZz', '2019-07-17 19:35:45', '2019-07-20 01:22:53'),
(15, 'siswa', 'Muhamad', 'aan@gmail.com', '$2y$10$f2oc2kflRKFlKarvg4qUL.vYy6lwdC3VIda.3muUbsBCC9RFnDcBG', 'fUg1Fot1yaVpAsQsp0dC78prTYxSniyTBAFdyMmoOYBOuCmBIEw0fE1ysEYf', '2019-07-19 21:12:14', '2019-07-19 21:12:14'),
(16, 'siswa', 'Suwasti', 'wasti@gmail.com', '$2y$10$1iMrO/Qfo2LSqeaDRyswA.RsiIrU3nPcQo3.C6Xv2ttp0npsEfmOW', 'zKaxuRCnvvRXitEEWKYcI5cE49S0U9lqGvrbQeXdSmRIXLCxXgqtA7hFxkDY', '2019-07-19 21:13:02', '2019-07-19 21:13:02'),
(17, 'siswa', 'Satria', 'adhi@gmail.com', '$2y$10$7.aWK0nKXUteRLdrFnwfA.v2L9GmMHuI.upr2v5DxRM9VXoXx3MKa', 'Mxux89nt1wWHXrJ7WdXC0AKZ7q7Og4lbhNTVEWsudFVRvwFLbYcgBqhNDYkv', '2019-07-19 21:13:37', '2019-07-19 21:13:37'),
(18, 'siswa', 'Fajar', 'eka@gmail.com', '$2y$10$vSgAYUwYGpKLddUFGwfc8Op/4hIydo9OiP0qnSYHGWkBsIkrTART6', '1Ps0Wq4i18yRgGvkjPQYroNshrv14qMyFo63xpdA7L1vD963hALYu4DSKOmY', '2019-07-20 00:41:43', '2019-07-20 00:41:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mapel_siswa`
--
ALTER TABLE `mapel_siswa`
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
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `mapel_siswa`
--
ALTER TABLE `mapel_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
