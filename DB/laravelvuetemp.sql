-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2022 at 12:13 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravelvuetemp`
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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_08_23_014253_create_website_settings_table', 1),
(6, '2022_08_23_021743_create_page_contents_table', 1),
(7, '2022_08_23_081801_add_column_permission_to_users', 1);

-- --------------------------------------------------------

--
-- Table structure for table `page_contents`
--

CREATE TABLE `page_contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `page_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `page_contents`
--

INSERT INTO `page_contents` (`id`, `title`, `body`, `image`, `deleted_at`, `created_at`, `updated_at`, `page_id`) VALUES
(1, 'Your Favorite Place for Free Bootstrap Themess', '<p>Start Bootstrap can help you build better websites using the Bootstrap framework! Just download a theme and start customizing, no strings attached!</p>', 'img/bg-masthead.jpg', NULL, '2022-08-24 02:42:06', '2022-10-28 02:43:31', 6),
(2, 'We have got what you need!', 'Start Bootstrap has everything you need to get your new website up and running in no time! Choose one of our open source, free to download, and easy to use themes! No strings attached!', NULL, NULL, '2022-08-24 02:42:06', '2022-08-24 02:42:06', 7),
(3, 'Sturdy Themes', 'Our themes are updated regularly to keep them bug free!', 'img/flaticon_book.png', NULL, '2022-08-24 02:42:06', '2022-08-24 02:42:06', 8),
(4, 'Up to Date', 'All dependencies are kept current to keep things fresh.', 'img/flaticon_computer.png', NULL, '2022-08-24 02:42:06', '2022-08-24 02:42:06', 8),
(5, 'Ready to Publish', 'You can use this design as is, or you can make changes!', 'img/flaticon_world.png', NULL, '2022-08-24 02:42:06', '2022-08-24 02:42:06', 8),
(6, 'Made with Love', 'Is it really open source if it is not made with love?', 'img/flaticon_heart.png', NULL, '2022-08-24 02:42:06', '2022-08-24 02:42:06', 8),
(7, 'Item1', NULL, 'img/portfolio/fullsize/1.jpg', NULL, '2022-08-24 02:42:06', '2022-08-24 02:42:06', 9),
(8, 'Item2', NULL, 'img/portfolio/fullsize/2.jpg', NULL, '2022-08-24 02:42:06', '2022-08-24 02:42:06', 9),
(9, 'Item3', NULL, 'img/portfolio/fullsize/3.jpg', NULL, '2022-08-24 02:42:06', '2022-08-24 02:42:06', 9),
(10, 'Item4', NULL, 'img/portfolio/fullsize/4.jpg', NULL, '2022-08-24 02:42:06', '2022-08-24 02:42:06', 9),
(11, 'Item5', NULL, 'img/portfolio/fullsize/5.jpg', NULL, '2022-08-24 02:42:06', '2022-08-24 02:42:06', 9),
(12, 'Item6', NULL, 'img/portfolio/fullsize/6.jpg', NULL, '2022-08-24 02:42:06', '2022-08-24 02:42:06', 9),
(13, 'Get In Touch!', 'Ready to start your next project with us? Send us a messages and we will get back to you as soon as possible!', NULL, NULL, '2022-08-24 02:42:06', '2022-08-24 02:42:06', 10);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('user@user.com', '$2y$10$.jcuE3S7qF0YatDbE5Ss1uj7fIdV7VHrhx7GRtNa3BZa76ytzuFVe', '2022-10-12 03:17:30');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 3, 'api_token', '0237a5f4706aef006fd9a1bf191f1926dc10b55ef27ac771dc60cdff8227a0e7', '[\"*\"]', NULL, NULL, '2022-10-13 20:38:55', '2022-10-13 20:38:55'),
(2, 'App\\Models\\User', 3, 'api_token', '37006642779c09ea5f4437d7a8995eaf03c03e3603fc92c9e73b9db3630fd1b8', '[\"*\"]', NULL, NULL, '2022-10-13 20:56:44', '2022-10-13 20:56:44'),
(3, 'App\\Models\\User', 3, 'api_token', '6bc6df7ca1e639d29d81baedbb7cbce6fae5183bf0e5921fc7ac8685e7839621', '[\"*\"]', NULL, NULL, '2022-10-13 21:30:38', '2022-10-13 21:30:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `permission` enum('god','admin','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `permission`, `deleted_at`) VALUES
(1, 'god', 'god@god.com', '2022-08-24 02:42:06', '$2y$10$C/HzG0gx/fUihdxzJnPoLOHIEolccpO4ibITSSTYVOu5YVwJ0yUZm', 'hMCHcMfk7KJSF0CDsLb8l5HFx1jEICBt3whWcelI6ECBBkIdC1hNOqrJAgVP', '2022-08-24 02:42:06', '2022-08-24 02:42:06', 'god', NULL),
(2, 'user', 'user@user.com', '2022-08-24 02:42:06', '$2y$10$C/HzG0gx/fUihdxzJnPoLOHIEolccpO4ibITSSTYVOu5YVwJ0yUZm', 'avQ6wgLZ8nAB7jczW9dvAiHm1kNupdPiK9wRKTzNCbL95uKSeuD1FZ0JeUma', '2022-08-24 02:42:06', '2022-08-24 02:42:06', 'user', NULL),
(3, 'admin', 'admin@admin.com', '2022-08-24 02:42:06', '$2y$10$C/HzG0gx/fUihdxzJnPoLOHIEolccpO4ibITSSTYVOu5YVwJ0yUZm', 'Bepw2XRgV4hWEVvVuh89IOkz1bnWGJBgtPz2cN6JS9WVSs3ataYZL0yWEaDe', '2022-08-24 02:42:06', '2022-08-24 02:42:06', 'admin', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `website_settings`
--

CREATE TABLE `website_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('page','favicon','site_name','company_name','tel','email') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'page',
  `content_size` enum('no','one','many') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `editable_data` set('title','body','image') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `website_settings`
--

INSERT INTO `website_settings` (`id`, `title`, `type`, `content_size`, `editable_data`, `image`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Template', 'site_name', 'no', NULL, NULL, NULL, '2022-08-24 02:42:04', '2022-10-26 21:57:07'),
(2, 'Favicon', 'favicon', 'no', NULL, 'img/template.png', NULL, '2022-08-24 02:42:04', '2022-08-24 02:42:04'),
(3, 'Template Company', 'company_name', 'no', NULL, NULL, NULL, '2022-08-24 02:42:04', '2022-08-24 02:42:04'),
(4, '0987654321', 'tel', 'no', NULL, NULL, NULL, '2022-08-24 02:42:04', '2022-08-24 02:42:04'),
(5, 'templatecompany@templatecompany.com', 'email', 'no', NULL, NULL, NULL, '2022-08-24 02:42:04', '2022-08-24 02:42:04'),
(6, 'home', 'page', 'one', 'title,body,image', NULL, NULL, '2022-08-24 02:42:04', '2022-10-27 03:11:54'),
(7, 'about', 'page', 'one', 'title,body', NULL, NULL, '2022-08-24 02:42:04', '2022-08-24 02:42:04'),
(8, 'services', 'page', 'many', 'title,body,image', NULL, NULL, '2022-08-24 02:42:04', '2022-08-24 02:42:04'),
(9, 'portfolio', 'page', 'many', 'title,image', NULL, NULL, '2022-08-24 02:42:04', '2022-08-24 02:42:04'),
(10, 'contact', 'page', 'one', 'title,body', NULL, NULL, '2022-08-24 02:42:04', '2022-08-24 02:42:04');

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_contents`
--
ALTER TABLE `page_contents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `page_contents_page_id_foreign` (`page_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `website_settings`
--
ALTER TABLE `website_settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `page_contents`
--
ALTER TABLE `page_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `website_settings`
--
ALTER TABLE `website_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `page_contents`
--
ALTER TABLE `page_contents`
  ADD CONSTRAINT `page_contents_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `website_settings` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
