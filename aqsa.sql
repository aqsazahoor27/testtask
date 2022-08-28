-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2022 at 10:06 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aqsa`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Shoes', '2021-08-09 09:02:10', '2022-08-27 13:18:20'),
(4, 'Clothes', '2022-01-03 07:41:52', '2022-01-28 04:16:47'),
(7, 'Accessories', '2022-08-28 03:00:55', '2022-08-28 03:00:55');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` text DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `slug` text DEFAULT NULL,
  `description` longtext NOT NULL,
  `share` varchar(500) DEFAULT NULL,
  `file_upload` varchar(500) DEFAULT NULL,
  `status` varchar(500) DEFAULT NULL,
  `price` decimal(11,2) DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `category_id`, `slug`, `description`, `share`, `file_upload`, `status`, `price`, `created_at`, `updated_at`) VALUES
(53, 'm2', 4, 'k', 'hjhj', NULL, '/storage/trainings/1661625037-e081389ef26eb9eefe476dc9090338d1d5b3632f.jpg', 'Published', '99.00', '2022-08-27 13:30:40', '2022-08-28 02:52:52'),
(54, 'jkj', 1, 'adsf', 'adfs', NULL, 'http://127.0.0.1:8000/uploads/tutorials/notfound.png', 'Published', '33.00', '2022-08-28 01:23:11', '2022-08-28 02:43:38'),
(55, 'hj', 4, 'hjhj', 'hjh', NULL, 'http://127.0.0.1:8000/uploads/tutorials/notfound.png', 'Published', '7.00', '2022-08-28 02:50:23', '2022-08-28 02:50:23');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_title` varchar(500) NOT NULL,
  `role_access` text DEFAULT NULL,
  `access` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_title`, `role_access`, `access`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, NULL, '2021-08-02 03:57:25', '2021-08-02 03:58:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `membership_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_name` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_user_id` bigint(20) DEFAULT NULL,
  `address` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_type` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover_dp` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dp` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `push_notifications` tinyint(1) DEFAULT NULL,
  `sms_notifications` tinyint(1) DEFAULT NULL,
  `email_notifications` tinyint(1) DEFAULT NULL,
  `new_comment_notifications` tinyint(1) DEFAULT NULL,
  `new_like_notifications` tinyint(1) DEFAULT NULL,
  `activity_status` tinyint(1) DEFAULT NULL,
  `verified_status` int(11) DEFAULT 0,
  `facebook` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `account_flow` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT 'PROFILE_IMG_SELECTION',
  `kyc` enum('NOT_TAKEN','PENDING','APPROVED','DECLINED') COLLATE utf8mb4_unicode_ci DEFAULT 'NOT_TAKEN'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `membership_id`, `name`, `first_name`, `last_name`, `user_name`, `email`, `email_verified_at`, `password`, `referral_user_id`, `address`, `postal_code`, `city`, `phone`, `bio`, `status`, `content_type`, `cover_dp`, `dp`, `push_notifications`, `sms_notifications`, `email_notifications`, `new_comment_notifications`, `new_like_notifications`, `activity_status`, `verified_status`, `facebook`, `twitter`, `instagram`, `linkedin`, `remember_token`, `deleted_at`, `created_at`, `updated_at`, `account_flow`, `kyc`) VALUES
(1, 1, 4, 'Super Admin', 'Super', 'Admin', 'Super', 'admin@gmail.com', '2022-06-24 09:08:46', '$2y$10$Q4iOzVSyMCnXuftI2iPRmeaaM9jqPlQWmWIzu8YTTInUnkuywuvO2', NULL, 'test2', '123a', 'test', '1111', 'love football and music', 'Active', '4', '\\storage\\users\\cover\\1655978377-ac2d979a1278c3e1f112dbd01f52f0066b0b5947-1.jpg', '\\storage\\users\\dp\\1655978377-ac2d979a1278c3e1f112dbd01f52f0066b0b5947-1.jpg', 1, 1, 1, 1, 1, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-30 04:20:14', '2022-08-16 09:16:36', 'DONE', 'NOT_TAKEN');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `membership_id` (`membership_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
