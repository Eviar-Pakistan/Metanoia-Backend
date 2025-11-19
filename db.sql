-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2024 at 05:41 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vr_backend`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `created_at`, `updated_at`) VALUES
(9, 'Physio', 'images/categories/1719177214.png', '2024-06-23 21:13:34', '2024-06-23 21:13:34'),
(10, 'cardio', 'images/categories/1719177253.jpg', '2024-06-23 21:14:13', '2024-06-23 21:14:13'),
(11, 'eyes', 'images/categories/1719177268.jpg', '2024-06-23 21:14:28', '2024-06-23 21:14:28'),
(12, 'neuro', 'images/categories/1719177282.jpg', '2024-06-23 21:14:42', '2024-06-23 21:14:42'),
(13, 'ortho', 'images/categories/1719177296.jpg', '2024-06-23 21:14:56', '2024-06-23 21:14:56'),
(14, 'Eye', 'images/categories/1720356897.jpg', '2024-07-07 07:54:57', '2024-07-07 07:54:57');

-- --------------------------------------------------------

--
-- Table structure for table `category_subscription`
--

CREATE TABLE `category_subscription` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `subscription_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category_subscription`
--

INSERT INTO `category_subscription` (`id`, `category_id`, `subscription_id`, `created_at`, `updated_at`) VALUES
(1, 14, 2, NULL, NULL),
(2, 14, 3, NULL, NULL),
(3, 9, 2, NULL, NULL),
(4, 9, 3, NULL, NULL),
(5, 9, 4, NULL, NULL),
(6, 14, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `mac_address` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_05_17_181257_create_devices_table', 1),
(5, '2024_05_19_212619_create_files_table', 1),
(6, '2024_05_29_160703_create_personal_access_tokens_table', 1),
(7, '2024_06_17_230710_create_categories_table', 2),
(8, '2024_06_17_233950_create_subscriptions_table', 3),
(9, '2024_06_18_002901_create_videos_table', 4),
(10, '2024_07_08_193850_create_video_sessions_table', 5),
(11, '2024_07_08_194623_create_questions_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'MyApp', '82c2decac65e5ad8a3bbf8aa0e147c97af5a2475e771ff9d747e34f1a2026750', '[\"*\"]', '2024-06-23 21:21:04', NULL, '2024-06-18 15:43:19', '2024-06-23 21:21:04'),
(2, 'App\\Models\\User', 3, 'MyApp', 'dd8c3791c8e8c35b438bbaa73f689bd226ac1cf5e69f4b47b27af88803330980', '[\"*\"]', NULL, NULL, '2024-06-23 10:27:38', '2024-06-23 10:27:38'),
(3, 'App\\Models\\User', 4, 'MyApp', '47dff7a40b77b5c90dfb1bef44cb64d0451ff79e108bfccbbc583a45d4ca1a49', '[\"*\"]', NULL, NULL, '2024-06-23 10:44:12', '2024-06-23 10:44:12'),
(4, 'App\\Models\\User', 4, 'MyApp', 'f35fdbeacdbf05eb4ac7e557ea38fd28cd4fe306e652adc32eefa006c2a3c806', '[\"*\"]', NULL, NULL, '2024-06-23 10:44:23', '2024-06-23 10:44:23'),
(5, 'App\\Models\\User', 4, 'MyApp', '94b4c4670f7613385f2a90cba8c9eed62fa7c43b63bcf59e946a460251826af8', '[\"*\"]', '2024-06-23 16:00:24', NULL, '2024-06-23 10:50:12', '2024-06-23 16:00:24'),
(6, 'App\\Models\\User', 4, 'MyApp', '4420a3be8e1a5177f2e2539ee3be9b83b875a45dd7967d864ecb4c4dfff39e08', '[\"*\"]', NULL, NULL, '2024-06-23 10:53:23', '2024-06-23 10:53:23'),
(7, 'App\\Models\\User', 4, 'MyApp', '50b76bf4d1315db691d2a63ffb411d1e0eda090f9e551de90f433b0dc8d967c4', '[\"*\"]', NULL, NULL, '2024-06-23 15:54:15', '2024-06-23 15:54:15'),
(8, 'App\\Models\\User', 4, 'MyApp', '732f9ab2436f0686868dff9e0531d139bdb8ffef0937d9765d82bbc38c8827e3', '[\"*\"]', NULL, NULL, '2024-06-23 15:59:40', '2024-06-23 15:59:40'),
(9, 'App\\Models\\User', 4, 'MyApp', 'f2dae309161f59c2f18700aeafe55ffa733259dfeabcfe50a076b94a4d686ae6', '[\"*\"]', NULL, NULL, '2024-06-23 16:05:12', '2024-06-23 16:05:12'),
(10, 'App\\Models\\User', 4, 'MyApp', '854f504341de884ee36a2f5cc9445b4948dd891fda6e67a472c72ce8b742e253', '[\"*\"]', '2024-06-23 16:05:50', NULL, '2024-06-23 16:05:49', '2024-06-23 16:05:50'),
(11, 'App\\Models\\User', 4, 'MyApp', '0ef961f8a56f3e5c9a9d78884db3f362307e8d0984b80b722823e4e14d7b5f24', '[\"*\"]', '2024-06-23 16:07:51', NULL, '2024-06-23 16:07:50', '2024-06-23 16:07:51'),
(12, 'App\\Models\\User', 4, 'MyApp', '5440bf9f2f57710f63055813f4dc2820e4f937719a2ca2658b39bf0f8f73986e', '[\"*\"]', '2024-06-23 16:09:01', NULL, '2024-06-23 16:09:00', '2024-06-23 16:09:01'),
(13, 'App\\Models\\User', 4, 'MyApp', '1e122359b13d062921d86b9e07ebd5d19c57cfe4395bc1c5c15b0b672e68985c', '[\"*\"]', '2024-06-23 16:46:42', NULL, '2024-06-23 16:46:34', '2024-06-23 16:46:42'),
(14, 'App\\Models\\User', 4, 'MyApp', '2ae4376f43b7249c93e9b1cd63db5d0426a012dee97780d7643c1d3cdc385d02', '[\"*\"]', '2024-06-23 17:02:52', NULL, '2024-06-23 16:47:24', '2024-06-23 17:02:52'),
(15, 'App\\Models\\User', 3, 'MyApp', '3cf8915097e91c1caa4be661aeeeaee442fd11da9985f93f12ba962488070264', '[\"*\"]', '2024-06-23 18:42:43', NULL, '2024-06-23 16:59:31', '2024-06-23 18:42:43'),
(16, 'App\\Models\\User', 3, 'MyApp', 'd60e2d73ecf44d4ba7fb737c620722dad459a976368200bc67417c013d5aac03', '[\"*\"]', NULL, NULL, '2024-06-23 17:00:00', '2024-06-23 17:00:00'),
(17, 'App\\Models\\User', 4, 'MyApp', 'f89392dc8dc5838f15d1455b2c9e99f949463e65025b69a49f54313edf7937d6', '[\"*\"]', '2024-06-23 17:03:42', NULL, '2024-06-23 17:03:41', '2024-06-23 17:03:42'),
(18, 'App\\Models\\User', 3, 'MyApp', '319260deac5acdb9da198949f0221d548db37cc5ea5e8aa9fb92a26e4cc8824c', '[\"*\"]', '2024-06-23 18:49:25', NULL, '2024-06-23 18:43:04', '2024-06-23 18:49:25'),
(19, 'App\\Models\\User', 4, 'MyApp', 'a88664fb0b679bab35b4fb6095e112062e61e7d31283c95df5f2257725198233', '[\"*\"]', '2024-06-23 18:51:59', NULL, '2024-06-23 18:51:51', '2024-06-23 18:51:59'),
(20, 'App\\Models\\User', 4, 'MyApp', '5b90907e84525ae18554b82d2eff9a55984c753532f215da25231bfd381a4c95', '[\"*\"]', '2024-06-23 18:56:06', NULL, '2024-06-23 18:56:01', '2024-06-23 18:56:06'),
(21, 'App\\Models\\User', 4, 'MyApp', '248bd9aaba2af357cb1782a95a66a3d03ae9cb95994aa6e64342dc78572406ea', '[\"*\"]', '2024-06-23 19:33:29', NULL, '2024-06-23 18:56:32', '2024-06-23 19:33:29'),
(22, 'App\\Models\\User', 4, 'MyApp', '99281dffd42b37ca80662ce72d5ce3975ebe8958589bed6526f2c5fb3967322d', '[\"*\"]', '2024-06-23 19:11:45', NULL, '2024-06-23 18:57:14', '2024-06-23 19:11:45'),
(23, 'App\\Models\\User', 4, 'MyApp', '3e157e4580b409a7ff5143042c84254b697266d033cd82331034381e3360a8bd', '[\"*\"]', '2024-06-23 19:14:34', NULL, '2024-06-23 19:14:32', '2024-06-23 19:14:34'),
(24, 'App\\Models\\User', 4, 'MyApp', 'aac8270e137d0d61cec646789890aa1f4007ccbe423104217a398b28f629a222', '[\"*\"]', '2024-06-23 19:29:24', NULL, '2024-06-23 19:16:22', '2024-06-23 19:29:24'),
(25, 'App\\Models\\User', 4, 'MyApp', '1f3a3ec9b72ea0368cb7ca250b916116fd4e8fddc6d580b2fc62b47109859c9a', '[\"*\"]', '2024-06-23 19:30:01', NULL, '2024-06-23 19:29:59', '2024-06-23 19:30:01'),
(26, 'App\\Models\\User', 4, 'MyApp', 'e394c8ecd93565e206717794423d1810f08b382feb7d7019a944626f1a28510c', '[\"*\"]', '2024-06-23 19:31:53', NULL, '2024-06-23 19:30:44', '2024-06-23 19:31:53'),
(27, 'App\\Models\\User', 4, 'MyApp', '3cbd5ce17d453c84f301b219ae0d33f6bce366112a26ca31be8c1b12df7a8413', '[\"*\"]', '2024-06-23 19:40:58', NULL, '2024-06-23 19:40:52', '2024-06-23 19:40:58'),
(28, 'App\\Models\\User', 4, 'MyApp', '72c193d71336d8cc755eebb6b7bb9f7a37664faa9042175a2470bb3b4d592386', '[\"*\"]', '2024-06-23 19:41:42', NULL, '2024-06-23 19:41:23', '2024-06-23 19:41:42'),
(29, 'App\\Models\\User', 4, 'MyApp', '9ce8ad3c74d7ee3703e1ee838f97053b570ec7422d1a72ed58a9396bc24c8c84', '[\"*\"]', '2024-06-23 19:49:19', NULL, '2024-06-23 19:49:10', '2024-06-23 19:49:19'),
(30, 'App\\Models\\User', 4, 'MyApp', 'cd03a14f9cae63c86fb20f2f2ebbea8587ef52ae7b9b7a59f8497a20b78b790a', '[\"*\"]', '2024-06-23 20:00:07', NULL, '2024-06-23 19:49:36', '2024-06-23 20:00:07'),
(31, 'App\\Models\\User', 4, 'MyApp', 'b2f9624246203813a346a6acbcc309f72495683737ab98bf8cb368b07ba70a8e', '[\"*\"]', '2024-06-23 20:19:45', NULL, '2024-06-23 20:19:01', '2024-06-23 20:19:45'),
(32, 'App\\Models\\User', 4, 'MyApp', 'f1ca22e579e25787f32061c172f7898fbfdee794a0b56522a049a5c6887c0587', '[\"*\"]', '2024-06-23 20:21:08', NULL, '2024-06-23 20:20:28', '2024-06-23 20:21:08'),
(33, 'App\\Models\\User', 4, 'MyApp', 'a714fb36710b014584f9c3349931d1f26e4f3a72887e101afe17bb95f7554bff', '[\"*\"]', '2024-06-23 20:21:46', NULL, '2024-06-23 20:21:16', '2024-06-23 20:21:46'),
(34, 'App\\Models\\User', 5, 'MyApp', '48bc6e3ad849c3f340453233588813db5db74a368a4dbaa0ce28da7700b0e539', '[\"*\"]', NULL, NULL, '2024-06-23 20:23:25', '2024-06-23 20:23:25'),
(35, 'App\\Models\\User', 5, 'MyApp', '7a9646d59f4b3aa5b8b7f0f841963defdbdb111cdaf232912a39dc140173697b', '[\"*\"]', '2024-06-23 20:23:57', NULL, '2024-06-23 20:23:38', '2024-06-23 20:23:57'),
(36, 'App\\Models\\User', 5, 'MyApp', '05f04b3fca0795dead1f1bfd99888537ed969c2801cf7e4a8190392d36dfb942', '[\"*\"]', '2024-06-23 20:58:38', NULL, '2024-06-23 20:24:20', '2024-06-23 20:58:38'),
(37, 'App\\Models\\User', 4, 'MyApp', 'fbae8ec44da5cc5350d50d0f4b71564663909041dceccb73077503a9931dc39d', '[\"*\"]', '2024-06-24 08:13:13', NULL, '2024-06-23 21:04:06', '2024-06-24 08:13:13'),
(38, 'App\\Models\\User', 4, 'MyApp', 'c9a191fa55f18c5315fe0ffe1eb1d6a3622442bf2e9bdd5ea28b4e0de6321dc8', '[\"*\"]', '2024-06-24 10:35:04', NULL, '2024-06-24 08:16:41', '2024-06-24 10:35:04'),
(39, 'App\\Models\\User', 4, 'MyApp', 'e343ee5dd1eb5e39f496bbf5c930919aff39958d651caf418fcd597da568b89c', '[\"*\"]', '2024-06-24 10:40:55', NULL, '2024-06-24 10:36:29', '2024-06-24 10:40:55'),
(40, 'App\\Models\\User', 4, 'MyApp', 'fafdfb1ac5cb40b2873004ff102900bd136297e92fa55c86b996479ef958e0aa', '[\"*\"]', '2024-06-24 10:48:00', NULL, '2024-06-24 10:41:53', '2024-06-24 10:48:00'),
(41, 'App\\Models\\User', 1, 'MyApp', 'b65f830cac2a533b368453685259650196d0f1f3dab4633dda5ee5dd06b42c3a', '[\"*\"]', '2024-06-24 21:52:50', NULL, '2024-06-24 21:45:01', '2024-06-24 21:52:50'),
(42, 'App\\Models\\User', 4, 'MyApp', '1babaab01a1f43ce12f5fccbcfa8c9586d0231e9c2e96f5a8611c46c4fee05f2', '[\"*\"]', '2024-06-29 11:55:22', NULL, '2024-06-29 11:49:13', '2024-06-29 11:55:22'),
(43, 'App\\Models\\User', 4, 'MyApp', '7a52f4ff589671fdb2f1e140dbbc9790da8d8ed886c1af33feb98e4d251c9399', '[\"*\"]', NULL, NULL, '2024-07-02 09:31:10', '2024-07-02 09:31:10'),
(44, 'App\\Models\\User', 4, 'MyApp', 'bac7afdf27001b75022ee8cb8ebb5e32a641441de7e052982d2a8f6e4c2eff74', '[\"*\"]', NULL, NULL, '2024-07-02 09:31:38', '2024-07-02 09:31:38'),
(45, 'App\\Models\\User', 4, 'MyApp', '00b75b8bdc580d0740f32d5fd3ceb7b36dc1faace48f610bb1f9300b88f330eb', '[\"*\"]', NULL, NULL, '2024-07-02 09:31:47', '2024-07-02 09:31:47'),
(46, 'App\\Models\\User', 4, 'MyApp', '418d261d76e3ecde9629bd139ea5d098777256a308b157bed06f0b63f34c7d41', '[\"*\"]', NULL, NULL, '2024-07-02 09:31:53', '2024-07-02 09:31:53'),
(47, 'App\\Models\\User', 4, 'MyApp', 'b70a7d19cb53721c79c3a3e2866bedbf9eaefb7594aa8f8547090e54d74d92b2', '[\"*\"]', '2024-07-02 10:55:05', NULL, '2024-07-02 09:39:52', '2024-07-02 10:55:05'),
(48, 'App\\Models\\User', 4, 'MyApp', '4e11865bfe80e4e4882cae2e0bd0aeed4fb2919835f717d223a36f8da278da84', '[\"*\"]', '2024-07-04 07:46:06', NULL, '2024-07-02 11:47:59', '2024-07-04 07:46:06'),
(49, 'App\\Models\\User', 7, 'MyApp', '232718ae3d74bc92e1d35f2497ffa4ac6a7728889f06f91f44cc72356a640571', '[\"*\"]', NULL, NULL, '2024-07-03 05:36:46', '2024-07-03 05:36:46'),
(50, 'App\\Models\\User', 7, 'MyApp', 'b463e8b2be5349056e27cd5db706615b466a5b117f7cde84b6ae6bed19d40c03', '[\"*\"]', NULL, NULL, '2024-07-03 05:40:29', '2024-07-03 05:40:29'),
(51, 'App\\Models\\User', 7, 'MyApp', '91ebbaa4a548458956722526ec93495377311b6fbdca6ba42a8de64b19f98f93', '[\"*\"]', NULL, NULL, '2024-07-03 05:40:42', '2024-07-03 05:40:42'),
(52, 'App\\Models\\User', 7, 'MyApp', '856c605d6e7a29b7b16652db606e486f239cc1e1ec9fa9f791d40e91452b713a', '[\"*\"]', NULL, NULL, '2024-07-03 05:49:27', '2024-07-03 05:49:27'),
(53, 'App\\Models\\User', 7, 'MyApp', 'cd47e46847b672eacf5772aed26bc32548b2227e3d6ce88faa1c001c86ce672c', '[\"*\"]', NULL, NULL, '2024-07-03 05:49:58', '2024-07-03 05:49:58'),
(54, 'App\\Models\\User', 7, 'MyApp', '365ca259fb296a849f849bdf20427f6d5bbb0e866fc93a925a3fddfb89b36e68', '[\"*\"]', NULL, NULL, '2024-07-03 05:51:25', '2024-07-03 05:51:25'),
(55, 'App\\Models\\User', 7, 'MyApp', '2057d19c81accbd321ce102900d850af86052d04f7aeb7da1e59ab0c4b137c01', '[\"*\"]', NULL, NULL, '2024-07-03 05:55:01', '2024-07-03 05:55:01'),
(56, 'App\\Models\\User', 7, 'MyApp', 'e002326cccd2538698481c2411e034d70c607c810936d0fbac34c0280d02a487', '[\"*\"]', NULL, NULL, '2024-07-03 05:55:11', '2024-07-03 05:55:11'),
(57, 'App\\Models\\User', 7, 'MyApp', 'f2f89c230c06cb4085415319331569bfa012aa7b8d1c2ba8ff962667683bfb0d', '[\"*\"]', NULL, NULL, '2024-07-03 05:56:59', '2024-07-03 05:56:59'),
(58, 'App\\Models\\User', 7, 'MyApp', '3befd5f0a8f053e2d7311d0f7b903e89978e2a0d4d1268159fae8d9fd436d987', '[\"*\"]', NULL, NULL, '2024-07-03 05:57:57', '2024-07-03 05:57:57'),
(59, 'App\\Models\\User', 7, 'MyApp', '7e6e7100d26fe9525ade5404961319ce63013709f748ea0738b3b92a8b17feab', '[\"*\"]', NULL, NULL, '2024-07-03 06:01:25', '2024-07-03 06:01:25'),
(60, 'App\\Models\\User', 7, 'MyApp', 'c62c8d336a8395affc56956499942d4e93c16268314a47f83b7bfe0b7c222e68', '[\"*\"]', NULL, NULL, '2024-07-03 06:02:01', '2024-07-03 06:02:01'),
(61, 'App\\Models\\User', 7, 'MyApp', '668f2633ade32c08a2a6c63aba0b9792d9634e3bef58b3b88674c807983fae65', '[\"*\"]', NULL, NULL, '2024-07-03 06:05:02', '2024-07-03 06:05:02'),
(62, 'App\\Models\\User', 7, 'MyApp', '8d99f25d85247e3b8ef29978a11318dcf43f831d89f80afd38bb5a15701039b5', '[\"*\"]', NULL, NULL, '2024-07-03 06:05:34', '2024-07-03 06:05:34'),
(63, 'App\\Models\\User', 7, 'MyApp', '80870262e72043d33fb06936eec393d6abcd44c8f6c253fe66771a37820cf299', '[\"*\"]', NULL, NULL, '2024-07-03 06:06:06', '2024-07-03 06:06:06'),
(64, 'App\\Models\\User', 7, 'MyApp', 'b64d919b7fb698c04856deb7064149e29db7ba19aecc2bcd95b77242e84f9aad', '[\"*\"]', NULL, NULL, '2024-07-03 06:09:54', '2024-07-03 06:09:54'),
(65, 'App\\Models\\User', 7, 'MyApp', '7cb2e451290b295ebf3c6562840ebd2e1fe17df3086ac70b20bf4d7ee1fd2807', '[\"*\"]', NULL, NULL, '2024-07-03 06:10:15', '2024-07-03 06:10:15'),
(66, 'App\\Models\\User', 7, 'MyApp', '4fb109a7e1cd0dbded87be7456411a551ce8ec5afc0c9bc18d67a4683571008c', '[\"*\"]', NULL, NULL, '2024-07-03 06:28:50', '2024-07-03 06:28:50'),
(67, 'App\\Models\\User', 7, 'MyApp', '40df47758bcb1eb867b9712f963ad5cd295ec76b23fa6f202123f23c2762db77', '[\"*\"]', NULL, NULL, '2024-07-03 06:29:07', '2024-07-03 06:29:07'),
(68, 'App\\Models\\User', 7, 'MyApp', '2b3e73316272f70a869df7784fc53af24e8aedf3dbb77376878617db80052d1c', '[\"*\"]', NULL, NULL, '2024-07-03 06:33:37', '2024-07-03 06:33:37'),
(69, 'App\\Models\\User', 7, 'MyApp', '0f14c48839e5fffc0d0df307e82bf07a4c8ea52e0ab5f6bfc72dde837c8d437a', '[\"*\"]', NULL, NULL, '2024-07-03 06:42:13', '2024-07-03 06:42:13'),
(70, 'App\\Models\\User', 7, 'MyApp', '88c836f5edd8be7647499e68a16728ce8fe4331312f59e95f5182283df679e9f', '[\"*\"]', NULL, NULL, '2024-07-03 06:42:33', '2024-07-03 06:42:33'),
(71, 'App\\Models\\User', 7, 'MyApp', '42171832c18c3f1c38a56098ab63429b395aa83adda3f8983217abdcfb997221', '[\"*\"]', NULL, NULL, '2024-07-03 06:43:27', '2024-07-03 06:43:27'),
(72, 'App\\Models\\User', 7, 'MyApp', '6d9158b465529ded719b4ef9bd1fa0d11034f41742743ef1331cac055d864e39', '[\"*\"]', NULL, NULL, '2024-07-03 06:43:51', '2024-07-03 06:43:51'),
(73, 'App\\Models\\User', 7, 'MyApp', 'd76bc510bdad7689ebece981a7fb79bf9d06ef42fb36091263c48febb7f00891', '[\"*\"]', NULL, NULL, '2024-07-03 06:45:38', '2024-07-03 06:45:38'),
(74, 'App\\Models\\User', 7, 'MyApp', 'ef45f07d06c0f1811866c4ef4c179ee5d7e7d38bd36c628c18cacc9bc16fb812', '[\"*\"]', NULL, NULL, '2024-07-03 07:01:40', '2024-07-03 07:01:40'),
(75, 'App\\Models\\User', 7, 'MyApp', '5f7c053df501c744a56eecf7e55443476a462184cb5488b8ae62ed66daf0d189', '[\"*\"]', NULL, NULL, '2024-07-03 07:02:13', '2024-07-03 07:02:13'),
(76, 'App\\Models\\User', 7, 'MyApp', '9d9128748e6016822bfa7e51418e6e94b28dd45d1a37bc3f5231360512851ec2', '[\"*\"]', NULL, NULL, '2024-07-03 07:03:05', '2024-07-03 07:03:05'),
(77, 'App\\Models\\User', 7, 'MyApp', '17a79ee27e1eaf0392e1e576d6967888325bf6b19cdf019f9862e5d9b1bae05b', '[\"*\"]', NULL, NULL, '2024-07-03 07:03:33', '2024-07-03 07:03:33'),
(78, 'App\\Models\\User', 7, 'MyApp', 'a7f5b5a88fbf0ad7605ed55e2a4290988da61c220d6715adde92543228f807bc', '[\"*\"]', NULL, NULL, '2024-07-03 07:31:59', '2024-07-03 07:31:59'),
(79, 'App\\Models\\User', 7, 'MyApp', '7dcdf028ba05833a9576f6dc78b05582ca4d0744d1afdd8e06f3fc2ebf0a1248', '[\"*\"]', NULL, NULL, '2024-07-04 06:17:56', '2024-07-04 06:17:56'),
(80, 'App\\Models\\User', 7, 'MyApp', '7fa01cfb596323b25f61885e684779914574f7649cf1b6c40f04effac90a2e6b', '[\"*\"]', NULL, NULL, '2024-07-04 06:23:17', '2024-07-04 06:23:17'),
(81, 'App\\Models\\User', 7, 'MyApp', '21659d03591322feab489168d610d00652c92c7dd14267ed8c6bb9496646d58c', '[\"*\"]', NULL, NULL, '2024-07-04 06:31:19', '2024-07-04 06:31:19'),
(82, 'App\\Models\\User', 7, 'MyApp', '13ad01f916bda3853f4cf0052f2d1b0d88dced48b0744289ee612a0fd437cb89', '[\"*\"]', NULL, NULL, '2024-07-04 06:35:45', '2024-07-04 06:35:45'),
(83, 'App\\Models\\User', 7, 'MyApp', '5e7942680690eae118d309a579dc199d540d99b4bdd90584327ffe462409d75c', '[\"*\"]', NULL, NULL, '2024-07-04 06:37:07', '2024-07-04 06:37:07'),
(84, 'App\\Models\\User', 7, 'MyApp', '28f4e7dbb37cf96e0cbf87b263c18ccc8063adf3d6e304acf0e599a16f8bc7a6', '[\"*\"]', NULL, NULL, '2024-07-04 06:40:52', '2024-07-04 06:40:52'),
(85, 'App\\Models\\User', 7, 'MyApp', '8975dbc75f5c4086fbe99f0f509a635b6486c0b992c88620b2710398b417c4d9', '[\"*\"]', NULL, NULL, '2024-07-04 06:41:59', '2024-07-04 06:41:59'),
(86, 'App\\Models\\User', 7, 'MyApp', '6e0c63f10b47bb74d73b44cff48be8c0e7292678a8c9898afb0c82080ec5d390', '[\"*\"]', NULL, NULL, '2024-07-04 06:43:08', '2024-07-04 06:43:08'),
(87, 'App\\Models\\User', 7, 'MyApp', 'dfef6b13979f4ce0f33d5254b2cf9aa4875c44600afc66f8b685d5b85810464c', '[\"*\"]', NULL, NULL, '2024-07-04 06:44:11', '2024-07-04 06:44:11'),
(88, 'App\\Models\\User', 7, 'MyApp', 'bef59aeff34cbd4cac1b52e973f2b7fe10e234c4969dae17ed3c19d61261b632', '[\"*\"]', NULL, NULL, '2024-07-04 06:51:21', '2024-07-04 06:51:21'),
(89, 'App\\Models\\User', 7, 'MyApp', '68af9f8160ad1076022afffebaaf43888a6fa5063ef0ef46636010a14e56f80e', '[\"*\"]', NULL, NULL, '2024-07-04 06:52:05', '2024-07-04 06:52:05'),
(90, 'App\\Models\\User', 7, 'MyApp', '69ecb0c001c2fdb64b993f55c2d7b1000d79fc4b910f3da7ad793faed3d81438', '[\"*\"]', NULL, NULL, '2024-07-04 06:52:25', '2024-07-04 06:52:25'),
(91, 'App\\Models\\User', 7, 'MyApp', '481881f6e0c02f9113f4e0e9d6182b213193d2911fd1bdb8635ccedeade2f509', '[\"*\"]', NULL, NULL, '2024-07-04 07:02:26', '2024-07-04 07:02:26'),
(92, 'App\\Models\\User', 7, 'MyApp', '3b55c1c8ae4b168d29f79373dfbb8bb915d60ca96ba127b516b721272882b3ec', '[\"*\"]', NULL, NULL, '2024-07-04 07:03:08', '2024-07-04 07:03:08'),
(93, 'App\\Models\\User', 7, 'MyApp', 'afbab00f2ddfe173502e8548cbf48e6c1ea77702e8771aa3e9afede0fb5c20f1', '[\"*\"]', NULL, NULL, '2024-07-04 07:03:24', '2024-07-04 07:03:24'),
(94, 'App\\Models\\User', 7, 'MyApp', '50d1d6038664a0fb9eb26d0a6a350ac6979410f81a6cee68322f6acb6320c676', '[\"*\"]', NULL, NULL, '2024-07-04 07:03:51', '2024-07-04 07:03:51'),
(95, 'App\\Models\\User', 7, 'MyApp', 'e2ca20815e1b4f31c561a3ddcb1b3e8d78eb9100cc8861cc40dbde519eda951a', '[\"*\"]', NULL, NULL, '2024-07-04 07:09:27', '2024-07-04 07:09:27'),
(96, 'App\\Models\\User', 7, 'MyApp', '0fdd9f1b940cc86565a31def2420de9883bff6d6e935844875d2c57704cc3915', '[\"*\"]', NULL, NULL, '2024-07-04 07:09:42', '2024-07-04 07:09:42'),
(97, 'App\\Models\\User', 7, 'MyApp', '93cf611de9956a0535329794633e69042a7c93616c9adb0717fbabc03c7f38cd', '[\"*\"]', NULL, NULL, '2024-07-04 07:10:36', '2024-07-04 07:10:36'),
(98, 'App\\Models\\User', 7, 'MyApp', '4f06daa6935da5de2eb46fd89e0be244307680d85804cfa0f6156327c6b90a69', '[\"*\"]', NULL, NULL, '2024-07-04 07:11:06', '2024-07-04 07:11:06'),
(99, 'App\\Models\\User', 7, 'MyApp', '3fcbf27abfa5bbca48e568abf6c0ed6e515eeb38fd65eb86fd75b5cbc386f9b4', '[\"*\"]', NULL, NULL, '2024-07-04 07:24:48', '2024-07-04 07:24:48'),
(100, 'App\\Models\\User', 7, 'MyApp', 'a0249b2e1868ffdf4fccf0050c131760ba1117f47321c16371aa60b73a73f08f', '[\"*\"]', NULL, NULL, '2024-07-04 07:25:07', '2024-07-04 07:25:07'),
(101, 'App\\Models\\User', 7, 'MyApp', '0bd77e6e49fc0aac232710b848157443ef0d6e409d11201e009674fcc0eb9000', '[\"*\"]', NULL, NULL, '2024-07-04 07:26:09', '2024-07-04 07:26:09'),
(102, 'App\\Models\\User', 7, 'MyApp', '9aef6e08e8ee3a7a2229ca6a09ebdd9bc62a05878cf4a3886fd6254fb7b2e6df', '[\"*\"]', NULL, NULL, '2024-07-04 07:43:25', '2024-07-04 07:43:25'),
(103, 'App\\Models\\User', 7, 'MyApp', '80f641c51625727e2e64c67ed4cc5f61e4fa7cb5f15f80ac60b331cd66656765', '[\"*\"]', NULL, NULL, '2024-07-04 07:43:56', '2024-07-04 07:43:56'),
(104, 'App\\Models\\User', 7, 'MyApp', '8476e5e6fc91f92e0072a821358a35adb5a7381e9c0d5f6bce9cc7375f62b1c8', '[\"*\"]', NULL, NULL, '2024-07-04 07:45:35', '2024-07-04 07:45:35'),
(105, 'App\\Models\\User', 7, 'MyApp', '85a14496cebd8cfd4b23789acf6f254c97190fad868307760d85318e30be67e0', '[\"*\"]', NULL, NULL, '2024-07-04 07:46:06', '2024-07-04 07:46:06'),
(106, 'App\\Models\\User', 1, 'MyApp', '52160dcd2f3737fb642e2e9b88dce3394122fd8db534687838ed8e34a9b1d19b', '[\"*\"]', '2024-08-05 07:13:07', NULL, '2024-08-05 07:06:42', '2024-08-05 07:13:07');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` text NOT NULL,
  `option` text NOT NULL,
  `option_1` bigint(20) DEFAULT NULL,
  `option_2` bigint(20) DEFAULT NULL,
  `option_3` bigint(20) DEFAULT NULL,
  `option_4` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `option`, `option_1`, `option_2`, `option_3`, `option_4`, `created_at`, `updated_at`) VALUES
(1, 'How Do You Feel ?', '[\"Energized\", \"Tired\", \"Sore\", \"Refreshed\"]', 1, 1, 1, 1, NULL, NULL),
(2, 'What did You Appreciate Most about The Session ?', '[\"Nothing\", \"Everything\", \"Enviroment\", \"VR\"]', 1, 1, 1, 1, NULL, NULL),
(3, 'What Did You Like The Least ?', '[\"Nothing\", \"Everything\", \"Enviroment\", \"VR\"]', 1, 1, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, NULL),
(2, 'User', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('4v0wJyuzO3L3qCh5OTQtlxnTlpuZJyYTuO16MZ5M', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiYzBiNW92N2hrWDZ0RDFzYkZIeXNGcUU5RklPbE1wSlZGWUVFYll0OCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly9sb2NhbGhvc3QvdnJfYmFja2VuZDIiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6NzoidXNlcl9pZCI7aToxO30=', 1722867778),
('BzSAXUNICZKmiyTH3qbojmucgk5y48zcEGTjg68E', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoieUVyV2RwOG1tU291YllkRTR3ZXZSNmxrUnR0Ukg4TzEyR0lZYXBGcCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0NjoiaHR0cDovL2xvY2FsaG9zdC92cl9iYWNrZW5kMi9zdWJzY3JpcHRpb24vTVE9PSI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI4OiJodHRwOi8vbG9jYWxob3N0L3ZyX2JhY2tlbmQyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo3OiJ1c2VyX2lkIjtpOjE7fQ==', 1722868195),
('ewrrrJwyaCfrnjFMCg798mzMjAcxJ2GYAJgRRO04', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoielBNM2JCS1NtOWh3WW9jcTZROVhucXlQbHBJZUJYMlN0ZnlWVnEwZyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MToiaHR0cDovL2xvY2FsaG9zdC92cl9iYWNrZW5kMi9wYXlwYWwvZXJyb3IiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozNDoiaHR0cDovL2xvY2FsaG9zdC92cl9iYWNrZW5kMi9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1722860725),
('XrbAbc9eR8kBewv0cdeBKa3rm7vqKhErqLwsjQry', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUVRUalRtSWJhTmpra2dQdTNaRXQ5Y082djBuNVI5d05mUTJKZThoUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly9sb2NhbGhvc3QvdnJfYmFja2VuZDIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1722858114);

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `duration` int(225) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `name`, `price`, `duration`, `details`, `created_at`, `updated_at`) VALUES
(2, 'Gold', 200.00, 60, '[\"2 devices\",\"2 session\"]', '2024-06-18 17:44:14', '2024-06-23 18:16:06'),
(3, 'Silver', 400.00, NULL, '[\"4 devices\",\"4 session\"]', '2024-06-23 18:14:27', '2024-06-23 18:15:59'),
(4, 'Platinium', 800.00, NULL, '[\"8 devices\",\"8 session\"]', '2024-06-23 18:15:47', '2024-06-23 18:15:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `profile_image` text DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL DEFAULT 2,
  `subscription_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subscription_date` varchar(20) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `email_verified_at`, `password`, `profile_image`, `role_id`, `subscription_id`, `subscription_date`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Huzaifa', 'Ahmed', 'huzaifaahmed1110@gmail.com', NULL, '$2y$12$KxpZ8b5M7KizKRLojCyuFuJhQi4I2bKE5vSqo8kMWgS2zCpT8kwYa', NULL, 2, 3, '04-10-2024', NULL, '2024-06-17 18:06:40', '2024-08-05 09:18:09'),
(2, 'Super', 'Admin', 'superadmin@gmail.com', NULL, '$2y$12$.G3cQ61B31MUi9WydAiFj.XoTJMe9PqQStn85sPpW.6iiJbpTcvF.', 'assets/user_images/1718672338.jpg', 1, NULL, NULL, 'YgHo15ab2R3BFvJaXD8Dg2QepNDCkIlytH91XmiO6BL5TLXjxQC8nGHpR76l', '2024-06-17 19:58:58', '2024-06-17 19:58:58'),
(3, 'Ali', 'Ahmed', 'm.shabii100@gmail.com', NULL, '$2y$12$Grq9kCLgTWPA7uMzC4z8C.LIgRH/ispcGV3Ya15sZlL0f9uZMfbpO', NULL, 2, 4, NULL, NULL, '2024-06-23 10:27:38', '2024-06-23 18:49:22'),
(4, 'ahmed', 'Khan', 'mincomedy122@gmail.com', NULL, '$2y$12$csj6eN0D9I9OPCjJOUSApujGPFMOrkvWZB9uyQCnB8xX2Bb68oMo6', NULL, 2, 4, NULL, NULL, '2024-06-23 10:44:12', '2024-06-24 10:42:31'),
(5, 'Muhammad', 'Ibrahim', 'mincomedy123@gmail.com', NULL, '$2y$12$8cBGenoAIsdzFfjpWZo0besblGWgNGXqzT/xiuY1vspV1Gw/TgvOm', NULL, 2, 4, NULL, NULL, '2024-06-23 20:23:25', '2024-06-23 20:55:40'),
(6, 'Nouman', 'Khalid', 'abc@g.com', NULL, '$2y$12$HHhPwob2bb66mWpmhSnxPuPDUTr.NfoPd3u9gbpG.s7kHnhunadte', 'assets/user_images/1719917922.jpg', 1, NULL, NULL, NULL, '2024-07-02 10:58:42', '2024-07-02 10:58:42'),
(7, 'Nouman', 'Khalid', 'user@g.com', NULL, '$2y$12$VBDb6v.zscF124BtLyqqcedeMl71.JWwfynGYCM6fOBCpJ72aYqi.', 'assets/user_images/1719918048.jpg', 2, NULL, NULL, NULL, '2024-07-02 11:00:48', '2024-07-02 11:00:48');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `video` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `title`, `category_id`, `video`, `image`, `created_at`, `updated_at`) VALUES
(3, 'Physo Session 1', 9, 'videos/Fg8hJBYcMVJcZnBg8MfIr8m4MKfgKLqBTeRYgdLo.mp4', 'images/video_thumbnail/1719264888.jpg', '2024-06-24 21:27:47', '2024-06-24 21:34:48'),
(4, 'Mednat', 9, 'videos/lQbZChAfsJ6R05ZpegMWehhfZx1KONoSeqB26dHS.mp4', 'images/video_thumbnail/1719917172.jpg', '2024-07-02 10:46:12', '2024-07-02 10:46:12'),
(5, 'Vecteezy', 9, 'videos/7BpeRD8946uNTzIHqIJ0BiJO6pZjGuCJqKSJ4fbV.mp4', 'images/video_thumbnail/1719920609.jpg', '2024-07-02 11:43:29', '2024-07-02 11:43:29'),
(6, 'Tsunami', 9, 'videos/cuwPeBoxgoe4tKcAXaqzXnRKYvzEzQIoSLqnUP0q.mp4', 'images/video_thumbnail/1719920699.jpg', '2024-07-02 11:44:59', '2024-07-02 11:44:59'),
(7, 'Water', 9, 'videos/uegMsiNI7JACUZELWPD9SM9XP7ti0bn6elyibdLW.mp4', 'images/video_thumbnail/1719922408.jpg', '2024-07-02 12:13:28', '2024-07-02 12:13:28');

-- --------------------------------------------------------

--
-- Table structure for table `video_runnings`
--

CREATE TABLE `video_runnings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `video_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `is_complete` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `video_sessions`
--

CREATE TABLE `video_sessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `video_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_subscription`
--
ALTER TABLE `category_subscription`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `subscription_id` (`subscription_id`);

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`),
  ADD KEY `subscription_id` (`subscription_id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `videos_category_id_foreign` (`category_id`);

--
-- Indexes for table `video_runnings`
--
ALTER TABLE `video_runnings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `video_id` (`video_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `video_sessions`
--
ALTER TABLE `video_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `video_sessions_video_id_foreign` (`video_id`),
  ADD KEY `video_sessions_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `category_subscription`
--
ALTER TABLE `category_subscription`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `video_runnings`
--
ALTER TABLE `video_runnings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `video_sessions`
--
ALTER TABLE `video_sessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category_subscription`
--
ALTER TABLE `category_subscription`
  ADD CONSTRAINT `category_subscription_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `category_subscription_ibfk_2` FOREIGN KEY (`subscription_id`) REFERENCES `subscriptions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`subscription_id`) REFERENCES `subscriptions` (`id`),
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `videos_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `video_runnings`
--
ALTER TABLE `video_runnings`
  ADD CONSTRAINT `video_runnings_ibfk_1` FOREIGN KEY (`video_id`) REFERENCES `videos` (`id`),
  ADD CONSTRAINT `video_runnings_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `video_sessions`
--
ALTER TABLE `video_sessions`
  ADD CONSTRAINT `video_sessions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `video_sessions_video_id_foreign` FOREIGN KEY (`video_id`) REFERENCES `videos` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
