-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2024 at 09:24 AM
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
-- Database: `project`
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

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('aerithlockhart@gmail.com|127.0.0.1', 'i:1;', 1712825062),
('aerithlockhart@gmail.com|127.0.0.1:timer', 'i:1712825062;', 1712825062),
('honeygrace@gmail.com|127.0.0.1', 'i:3;', 1712823879),
('honeygrace@gmail.com|127.0.0.1:timer', 'i:1712823879;', 1712823879);

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
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `department` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department`, `created_at`, `updated_at`) VALUES
(1, 'Finance', '2024-04-21 22:05:26', '2024-04-21 22:05:26'),
(6, 'Human Resource Division Office', '2024-04-21 22:28:15', '2024-04-21 22:28:15'),
(7, 'MIS', '2024-04-21 22:28:21', '2024-04-21 22:28:21'),
(8, 'BCLP', '2024-04-21 22:28:28', '2024-04-21 22:28:28'),
(9, 'PCIST', '2024-04-21 22:28:34', '2024-04-21 22:28:34');

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
(9, '0001_01_01_000000_create_users_table', 1),
(10, '0001_01_01_000001_create_cache_table', 1),
(11, '0001_01_01_000002_create_jobs_table', 1),
(12, '2024_03_25_023729_create_tickets_table', 1),
(13, '2024_04_05_080951_create_notifications_table', 2),
(14, '2024_04_11_010718_create_notifications_table', 3),
(15, '2019_12_14_000001_create_personal_access_tokens_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('018383d5-a4b2-4fcf-8068-6f6d9bf4ec09', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"id\":120,\"message\":\"Your Ticket (ID: 120) has been Open by Admin 1.\"}', NULL, '2024-05-12 18:28:55', '2024-05-12 18:28:55'),
('052ad540-49f0-4c2c-8e9b-0dfeca3d5c4a', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"id\":2,\"message\":\"Your Ticket (ID: 2) has been  by Admin 3.\"}', '2024-04-29 16:51:00', '2024-04-24 22:48:48', '2024-04-29 16:51:00'),
('066ca697-83e0-4489-87dd-568a011897a5', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"id\":100,\"message\":\"Your Ticket (ID: 100) has been Resolved by Admin 1.\"}', '2024-04-29 16:50:59', '2024-04-28 22:51:48', '2024-04-29 16:50:59'),
('0d5de1f2-1398-4ef1-86b6-c70561084689', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"id\":102,\"message\":\"Your Ticket (ID: 102) has been Resolved by None.\"}', '2024-04-24 21:23:58', '2024-04-23 22:24:11', '2024-04-24 21:23:58'),
('1109c641-464e-498a-bca6-01db28d41ce6', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"id\":119,\"message\":\"Your Ticket (ID: 119) has been Resolved by Admin 1.\"}', '2024-04-29 16:51:00', '2024-04-25 22:03:33', '2024-04-29 16:51:00'),
('15e7564f-f07d-47f8-a958-77ad32291d5a', 'App\\Notifications\\EmailNotification', 'App\\Models\\CustomerModel', 24, '{\"id\":24,\"message\":\"Your Ticket (ID: 24) has been Open by Admin 1.\"}', NULL, '2024-05-15 19:01:29', '2024-05-15 19:01:29'),
('1a6cd535-0308-4f4b-9722-758fbddb2f83', 'App\\Notifications\\EmailNotification', 'App\\Models\\CustomerModel', 24, '{\"id\":24,\"message\":\"Your Ticket (ID: 24) has been Open by Admin 1.\"}', NULL, '2024-05-15 19:01:24', '2024-05-15 19:01:24'),
('2bbc0341-92a5-49c3-af7e-b716a6bf82c9', 'App\\Notifications\\NewTicketNotification', 'App\\Models\\User', 1, '{\"id\":120,\"message\":\"New Ticket has been created under the email james.sangabriel@gmail.com.\"}', '2024-05-09 21:41:18', '2024-05-07 22:17:50', '2024-05-09 21:41:18'),
('2df693a8-a7fd-44a0-9a99-5ddc7773b21e', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"id\":2,\"message\":\"Your Ticket (ID: 2) has been  by Admin 3.\"}', '2024-04-29 16:51:00', '2024-04-24 22:09:07', '2024-04-29 16:51:00'),
('3c297bbc-628d-4625-97f4-6edbd01ae2a1', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"id\":118,\"message\":\"Your Ticket (ID: 118) has been Unresolved by Admin 1.\"}', '2024-04-29 16:51:00', '2024-04-24 22:49:51', '2024-04-29 16:51:00'),
('3dda285f-6bda-4271-9275-ddaf1ba67755', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"id\":102,\"message\":\"Your Ticket (ID: 102) has been Resolved by None.\"}', '2024-04-24 21:23:58', '2024-04-23 22:24:05', '2024-04-24 21:23:58'),
('3e2ab65a-fb8b-4882-9713-a079d17a3953', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"id\":118,\"message\":\"Your Ticket (ID: 118) has been Open by Admin 1.\"}', '2024-04-29 16:51:00', '2024-04-24 22:50:07', '2024-04-29 16:51:00'),
('3ee195fa-8acb-4570-bcb3-12de5c325e0a', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"id\":118,\"message\":\"Your Ticket (ID: 118) has been Resolved by Admin 1.\"}', '2024-04-24 21:23:58', '2024-04-23 23:06:58', '2024-04-24 21:23:58'),
('41d4bfb3-9e1e-4dae-8448-52e2a07ad5ab', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"id\":107,\"message\":\"Your Ticket (ID: 107) has been Open by Admin 1.\"}', '2024-04-29 16:51:00', '2024-04-25 19:35:03', '2024-04-29 16:51:00'),
('4274a4d5-99c2-4169-9dd2-9c1fed31652b', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"id\":118,\"message\":\"Your Ticket (ID: 118) has been Resolved by Admin 1.\"}', '2024-04-24 21:23:59', '2024-04-22 23:40:19', '2024-04-24 21:23:59'),
('5054fca4-2fb7-45e6-990a-48a7ce3f3cdb', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"id\":100,\"message\":\"Your Ticket (ID: 100) has been Open by Admin 1.\"}', '2024-04-29 16:50:59', '2024-04-25 22:15:16', '2024-04-29 16:50:59'),
('536db112-54c3-4b98-9556-7a6997596620', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"id\":118,\"message\":\"Your Ticket (ID: 118) has been Resolved by Admin 1.\"}', '2024-04-24 21:23:59', '2024-04-22 23:36:10', '2024-04-24 21:23:59'),
('56285eaa-f5f8-406c-b6d9-1c30357038e5', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"id\":120,\"message\":\"Your Ticket (ID: 120) has been Open by Admin 1.\"}', NULL, '2024-05-12 18:28:33', '2024-05-12 18:28:33'),
('5f4777e1-1c5e-4908-9003-ace63ea47c4b', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"id\":107,\"message\":\"Your Ticket (ID: 107) has been Resolved by Admin 3.\"}', '2024-04-29 16:50:59', '2024-04-28 22:15:37', '2024-04-29 16:50:59'),
('613795d3-051e-43f9-b8bf-e0412a1a736f', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"id\":118,\"message\":\"Your Ticket (ID: 118) has been  by Admin 2.\"}', '2024-04-24 21:23:58', '2024-04-24 18:37:15', '2024-04-24 21:23:58'),
('629a0a41-cc0a-450f-817f-eeb73d09ffd4', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"id\":118,\"message\":\"Your Ticket (ID: 118) has been Resolved by Admin 1.\"}', '2024-04-24 21:23:59', '2024-04-22 23:40:26', '2024-04-24 21:23:59'),
('6bb2cd1d-aad0-4621-8849-ffb1f1b4af00', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"id\":118,\"message\":\"Your Ticket (ID: 118) has been Resolved by Admin 1.\"}', '2024-04-24 21:23:59', '2024-04-22 23:35:58', '2024-04-24 21:23:59'),
('80f9a627-a968-489b-81e6-bafb048692a1', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"id\":118,\"message\":\"Your Ticket (ID: 118) has been Open by Admin 1.\"}', '2024-04-24 21:23:58', '2024-04-24 19:25:59', '2024-04-24 21:23:58'),
('93351055-93ed-4a05-aef1-dc9777229de2', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"id\":2,\"message\":\"Your Ticket (ID: 2) has been  by Admin 3.\"}', '2024-04-29 16:51:00', '2024-04-24 22:09:12', '2024-04-29 16:51:00'),
('9579d2b4-0886-4860-8ba4-f7399983fbc3', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"id\":120,\"message\":\"Your Ticket (ID: 120) has been Open by Admin 1.\"}', NULL, '2024-05-12 18:29:07', '2024-05-12 18:29:07'),
('9f31f1f8-99b0-4ecf-a37b-530784e6e5e8', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"id\":118,\"message\":\"Your Ticket (ID: 118) has been Open by Admin 3.\"}', '2024-04-24 21:23:58', '2024-04-23 23:46:51', '2024-04-24 21:23:58'),
('a03c5791-05b6-4ee7-bec4-0e616a640b8e', 'App\\Notifications\\NewTicketNotification', 'App\\Models\\User', 1, '{\"id\":119,\"message\":\"New Ticket has been created under the email james.sangabriel@gmail.com.\"}', '2024-05-06 18:25:58', '2024-04-25 19:26:45', '2024-05-06 18:25:58'),
('a2ff064e-fd78-466a-87d9-67c4b45e191d', 'App\\Notifications\\NewTicketNotification', 'App\\Models\\User', 1, '{\"id\":118,\"message\":\"New Ticket has been created under the email james.sangabriel@gmail.com.\"}', '2024-04-24 18:31:48', '2024-04-22 23:32:23', '2024-04-24 18:31:48'),
('a6554706-5dcc-4ac1-8518-211d97a075bc', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"id\":118,\"message\":\"Your Ticket (ID: 118) has been Resolved by Admin 1.\"}', '2024-04-24 21:23:59', '2024-04-22 23:40:15', '2024-04-24 21:23:59'),
('ab80fee2-e74d-4dcd-a606-257265491718', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"message\":\"Your Ticket (ID: 117) has been Resolved by Admin 2.\"}', '2024-04-24 21:23:59', '2024-04-22 19:14:14', '2024-04-24 21:23:59'),
('af12f733-1010-4381-936a-0da4103a69e2', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"id\":107,\"message\":\"Your Ticket (ID: 107) has been Resolved by Admin 3.\"}', '2024-04-29 16:50:59', '2024-04-28 22:15:43', '2024-04-29 16:50:59'),
('b06caad4-541d-4e83-b2b4-9b689ab72497', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"id\":119,\"message\":\"Your Ticket (ID: 119) has been Resolved by Admin 1.\"}', '2024-04-29 16:50:59', '2024-04-25 22:09:12', '2024-04-29 16:50:59'),
('b22f917b-3b6c-4cf0-aae3-b5f61f3ffba4', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"id\":119,\"message\":\"Your Ticket (ID: 119) has been Resolved by Admin 1.\"}', '2024-04-29 16:50:59', '2024-04-25 22:09:34', '2024-04-29 16:50:59'),
('b308669f-f250-416e-bf8d-b15214fb2a91', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"id\":119,\"message\":\"Your Ticket (ID: 119) has been Open by Admin 1.\"}', '2024-04-29 16:51:00', '2024-04-25 19:30:20', '2024-04-29 16:51:00'),
('b3596afc-80d5-4c93-9686-2d019f19ffbf', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"id\":118,\"message\":\"Your Ticket (ID: 118) has been Resolved by Admin 1.\"}', '2024-04-24 21:23:59', '2024-04-22 23:40:09', '2024-04-24 21:23:59'),
('b65e1a63-0de9-4873-8919-15f4739fa9d1', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"id\":100,\"message\":\"Your Ticket (ID: 100) has been Resolved by Admin 1.\"}', '2024-04-29 16:50:59', '2024-04-28 22:52:32', '2024-04-29 16:50:59'),
('ba421cef-eb13-42c6-b15e-3acd318b476e', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"id\":107,\"message\":\"Your Ticket (ID: 107) has been Open by Admin 1.\"}', '2024-04-24 21:23:58', '2024-04-23 23:12:43', '2024-04-24 21:23:58'),
('c1970d54-f8c1-4311-ac53-959c590c80e9', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"id\":118,\"message\":\"Your Ticket (ID: 118) has been Resolved by Admin 1.\"}', '2024-04-24 21:23:58', '2024-04-23 23:06:54', '2024-04-24 21:23:58'),
('c75b9f3f-0cab-4cad-be13-39031d0d9410', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"id\":120,\"message\":\"Your Ticket (ID: 120) has been Resolved by Admin 3.\"}', NULL, '2024-05-12 18:29:57', '2024-05-12 18:29:57'),
('c8cb09d0-8a27-4b6a-96ae-4ce9c3dbf032', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"id\":119,\"message\":\"Your Ticket (ID: 119) has been Open by Admin 1.\"}', '2024-04-29 16:51:00', '2024-04-25 19:30:15', '2024-04-29 16:51:00'),
('c9603b31-1f00-4686-9361-4c4b95ba731b', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"message\":\"Your Ticket (ID: 117) has been Resolved by Admin 2.\"}', '2024-04-24 21:23:59', '2024-04-22 19:14:28', '2024-04-24 21:23:59'),
('c9fada3d-15e1-4d0c-a1b8-447d0c816ca6', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"id\":101,\"message\":\"Your Ticket (ID: 101) has been Open by Admin 1.\"}', '2024-04-29 16:50:59', '2024-04-25 22:13:09', '2024-04-29 16:50:59'),
('ca0a669e-5ea0-4d38-af55-94bc530635cf', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"id\":106,\"message\":\"Your Ticket (ID: 106) has been Open by Admin 1.\"}', '2024-04-29 16:51:00', '2024-04-25 19:31:33', '2024-04-29 16:51:00'),
('ce78d691-75ee-45db-bf0d-0bd3a52cc915', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"id\":118,\"message\":\"Your Ticket (ID: 118) has been Resolved by Admin 1.\"}', '2024-04-29 16:51:00', '2024-04-24 22:51:49', '2024-04-29 16:51:00'),
('d6104750-69d5-4441-957a-94b2663cee69', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"id\":120,\"message\":\"Your Ticket (ID: 120) has been Resolved by Admin 3.\"}', NULL, '2024-05-12 18:30:10', '2024-05-12 18:30:10'),
('d8860f0d-9a5f-4531-bd6e-20ec5513b261', 'App\\Notifications\\NewTicketNotification', 'App\\Models\\User', 1, '{\"id\":121,\"message\":\"New Ticket has been created under the email james.sangabriel@gmail.com.\"}', '2024-05-09 21:41:18', '2024-05-07 22:18:34', '2024-05-09 21:41:18'),
('dbbb793b-aab6-4ce2-a360-a8f24c648a96', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"id\":118,\"message\":\"Your Ticket (ID: 118) has been Resolved by Admin 1.\"}', '2024-04-24 21:23:59', '2024-04-22 23:40:30', '2024-04-24 21:23:59'),
('dd1a04d4-b896-4be2-a28d-f70f9005c9db', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"id\":105,\"message\":\"Your Ticket (ID: 105) has been Open by Admin 3.\"}', '2024-04-24 21:23:58', '2024-04-23 23:19:28', '2024-04-24 21:23:58'),
('edbe4529-db06-469c-bb62-cee0549327d7', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"id\":119,\"message\":\"Your Ticket (ID: 119) has been Resolved by Admin 1.\"}', '2024-04-29 16:51:00', '2024-04-25 19:31:56', '2024-04-29 16:51:00'),
('fa37fcac-c011-45db-b6d5-15cb3674c9f6', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"id\":119,\"message\":\"Your Ticket (ID: 119) has been Resolved by Admin 1.\"}', '2024-04-29 16:50:59', '2024-04-25 22:12:16', '2024-04-29 16:50:59'),
('fbabc04d-ca3b-430a-9eee-0ec5603eacc3', 'App\\Notifications\\EmailNotification', 'App\\Models\\User', 2, '{\"id\":118,\"message\":\"Your Ticket (ID: 118) has been Open by Admin 1.\"}', '2024-04-24 21:23:58', '2024-04-24 18:39:07', '2024-04-24 21:23:58');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('james.sangabriel@gmail.com', '$2y$12$HcwKTAg5Bxto1MMloYdj5eCdsM3csYqUnlNAp86iwEmYE0jGDRNCS', '2024-05-16 22:29:35');

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
('15xcgdVkuVUmuGzjJleU6Q0cGR4zLBhTnV0Q3UaU', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoid3k4cnpRMmxtUTRCTms0cUdGczBCbDJGRDZmdFVPQkx3dTBidjQySSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXRhdGFibGVzIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjQ6ImF1dGgiO2E6MTp7czoyMToicGFzc3dvcmRfY29uZmlybWVkX2F0IjtpOjE3MTMxNjgyMDA7fX0=', 1713168219);

-- --------------------------------------------------------

--
-- Table structure for table `survey`
--

CREATE TABLE `survey` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `q1` varchar(255) NOT NULL,
  `q2` varchar(255) NOT NULL,
  `q3` varchar(255) NOT NULL,
  `q4` varchar(255) NOT NULL,
  `q5` varchar(255) NOT NULL,
  `q6` varchar(255) NOT NULL,
  `q7` varchar(255) NOT NULL,
  `q8` varchar(255) NOT NULL,
  `q9` text NOT NULL,
  `q0` text NOT NULL,
  `sentiment` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `survey`
--

INSERT INTO `survey` (`id`, `customer_id`, `q1`, `q2`, `q3`, `q4`, `q5`, `q6`, `q7`, `q8`, `q9`, `q0`, `sentiment`, `created_at`, `updated_at`) VALUES
(1, 2, 'Very satisfied', 'Very easy', 'Very satisfied', 'Very clear', 'Very helpful', 'Yes, completely', 'Yes', 'Very likely', 'Hello', 'World', 'negative', '2024-04-29 22:34:31', '2024-04-29 22:34:31'),
(2, 2, 'Very satisfied', 'Very easy', 'Very satisfied', 'Very clear', 'Very helpful', 'Yes, completely', 'Yes', 'Very likely', 'none', 'This is bad', 'positive', '2024-05-08 22:06:29', '2024-05-08 22:06:29'),
(3, 2, 'Very satisfied', 'Very easy', 'Very satisfied', 'Very clear', 'Very helpful', 'Yes, completely', 'Yes', 'Very likely', 'none', 'This is bad', 'positive', '2024-05-08 22:07:02', '2024-05-08 22:07:02'),
(4, 2, 'Very satisfied', 'Very easy', 'Very satisfied', 'Very clear', 'Very helpful', 'Yes, completely', 'Yes', 'Very likely', 'none', 'I hate this product', 'positive', '2024-05-08 22:09:22', '2024-05-08 22:09:22'),
(5, 2, 'Very satisfied', 'Very easy', 'Very satisfied', 'Very clear', 'Very helpful', 'Yes, completely', 'Yes', 'Very likely', 'none', 'I love this movie', 'positive', '2024-05-08 22:11:44', '2024-05-08 22:11:44'),
(6, 2, 'Very satisfied', 'Very easy', 'Very satisfied', 'Very clear', 'Very helpful', 'Yes, completely', 'Yes', 'Very likely', 'none', 'I hate this product', 'positive', '2024-05-08 22:12:00', '2024-05-08 22:12:00'),
(7, 2, 'Very satisfied', 'Very easy', 'Very satisfied', 'Very clear', 'Very helpful', 'Yes, completely', 'Yes', 'Very likely', 'None', 'I hate it', 'negative', '2024-05-08 22:28:53', '2024-05-08 22:28:53'),
(8, 2, 'Very satisfied', 'Very easy', 'Very satisfied', 'Very clear', 'Very helpful', 'Yes, completely', 'Yes', 'Very likely', 'None', 'I love it', 'negative', '2024-05-08 22:29:07', '2024-05-08 22:29:07'),
(9, 2, 'Very satisfied', 'Very easy', 'Very satisfied', 'Very clear', 'Very helpful', 'Yes, completely', 'Yes', 'Very likely', 'None', 'I love it', 'positive', '2024-05-08 22:30:53', '2024-05-08 22:30:53'),
(10, 2, 'Very satisfied', 'Very easy', 'Very satisfied', 'Very clear', 'Very helpful', 'Yes, completely', 'Yes', 'Very likely', 'None', 'This is the best', 'positive', '2024-05-08 22:31:05', '2024-05-08 22:31:05'),
(11, 2, 'Very satisfied', 'Very easy', 'Very satisfied', 'Very clear', 'Very helpful', 'Yes, completely', 'Yes', 'Very likely', 'None', 'Panget', 'positive', '2024-05-08 22:31:13', '2024-05-08 22:31:13'),
(12, 2, 'Very satisfied', 'Very easy', 'Very satisfied', 'Very clear', 'Very helpful', 'Yes, completely', 'Yes', 'Very likely', 'None', 'I like it', 'positive', '2024-05-08 22:31:24', '2024-05-08 22:31:24'),
(13, 2, 'Very satisfied', 'Very easy', 'Very satisfied', 'Very clear', 'Very helpful', 'Yes, completely', 'Yes', 'Very likely', 'None', 'It was terrible', 'positive', '2024-05-08 22:31:36', '2024-05-08 22:31:36'),
(14, 2, 'Very satisfied', 'Very easy', 'Very satisfied', 'Very clear', 'Very helpful', 'Yes, completely', 'Yes', 'Very likely', 'None', 'It was terrible', 'positive', '2024-05-08 22:31:40', '2024-05-08 22:31:40'),
(15, 2, 'Very satisfied', 'Very easy', 'Very satisfied', 'Very clear', 'Very helpful', 'Yes, completely', 'Yes', 'Very likely', 'None', 'I hate this product', 'positive', '2024-05-08 22:32:01', '2024-05-08 22:32:01'),
(16, 2, 'Very satisfied', 'Very easy', 'Very satisfied', 'Very clear', 'Very helpful', 'Yes, completely', 'Yes', 'Very likely', 'None', 'I hate this product', 'positive', '2024-05-08 22:32:05', '2024-05-08 22:32:05'),
(17, 2, 'Very satisfied', 'Very easy', 'Very satisfied', 'Very clear', 'Very helpful', 'Yes, completely', 'Yes', 'Very likely', 'Hello', 'I hate this product', 'positive', '2024-05-08 22:32:31', '2024-05-08 22:32:31'),
(18, 2, 'Very satisfied', 'Very easy', 'Very satisfied', 'Very clear', 'Very helpful', 'Yes, completely', 'Yes', 'Very likely', 'Hello', 'I love it', 'positive', '2024-05-08 23:11:56', '2024-05-08 23:11:56'),
(19, 2, 'Very satisfied', 'Very easy', 'Very satisfied', 'Very clear', 'Very helpful', 'Yes, completely', 'Yes', 'Very likely', 'Hello', 'I hate it', 'negative', '2024-05-08 23:12:04', '2024-05-08 23:12:04'),
(20, 2, 'Very satisfied', 'Very easy', 'Very satisfied', 'Very clear', 'Very helpful', 'Yes, completely', 'Yes', 'Very likely', 'Hello', 'okay lng', 'neutral', '2024-05-08 23:12:11', '2024-05-08 23:12:11'),
(21, 2, 'Very satisfied', 'Very easy', 'Very satisfied', 'Very clear', 'Very helpful', 'Yes, completely', 'Yes', 'Very likely', 'None', 'It was okay', 'neutral', '2024-05-08 23:37:27', '2024-05-08 23:37:27'),
(22, 2, 'Very satisfied', 'Very easy', 'Very satisfied', 'Very clear', 'Very helpful', 'Yes, completely', 'Yes', 'Very likely', 'None', 'Panget', 'neutral', '2024-05-08 23:37:36', '2024-05-08 23:37:36'),
(23, 2, 'Very satisfied', 'Very easy', 'Very satisfied', 'Very clear', 'Very helpful', 'Yes, completely', 'Yes', 'Very likely', 'None', 'Panget', 'neutral', '2024-05-08 23:46:10', '2024-05-08 23:46:10'),
(24, 2, 'Very satisfied', 'Very easy', 'Very satisfied', 'Very clear', 'Very helpful', 'Yes, completely', 'Yes', 'Very likely', 'None', 'It was slow', 'neutral', '2024-05-08 23:46:22', '2024-05-08 23:46:22');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `prio` varchar(255) DEFAULT NULL,
  `handler` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `solution` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `customer_id`, `name`, `department`, `email`, `subject`, `description`, `image`, `prio`, `handler`, `status`, `remarks`, `solution`, `created_at`, `updated_at`) VALUES
(1, '9', 'Prof. Ariel Kautzer Jr.', 'Sales', 'jade06@example.org', 'Bug Report', 'Quas rem dolor eaque dolorum et dolor exercitationem.', 'https://via.placeholder.com/200x200.png/0044ff?text=people+et', '1', 'None', 'New', NULL, NULL, '2024-05-12 21:30:22', '2024-05-12 21:30:22'),
(2, '13', 'Berry Dare IV', 'Marketing', 'charlene.stamm@example.com', 'Technical Support', 'Nobis nihil qui vero.', 'https://via.placeholder.com/200x200.png/0044bb?text=people+voluptates', '1', 'None', 'New', NULL, NULL, '2024-05-12 21:30:22', '2024-05-12 21:30:22'),
(3, '1', 'Jerod Braun Jr.', 'Marketing', 'ojones@example.org', 'Technical Support', 'Voluptatem occaecati tenetur quos rerum ipsum esse ipsum optio.', 'https://via.placeholder.com/200x200.png/00ccee?text=people+quas', '1', 'None', 'New', NULL, NULL, '2024-05-12 21:30:22', '2024-05-12 21:30:22'),
(4, '5', 'Ardith Mraz', 'Operations', 'violette78@example.org', 'Feature Request', 'Odio in est id ut aut.', 'https://via.placeholder.com/200x200.png/006677?text=people+quo', '1', 'None', 'New', NULL, NULL, '2024-05-12 21:30:22', '2024-05-12 21:30:22'),
(5, '14', 'Selmer Botsford', 'Sales', 'wshanahan@example.net', 'Technical Support', 'Reprehenderit ut quo dolorum rerum suscipit recusandae.', 'https://via.placeholder.com/200x200.png/00dd99?text=people+ad', '1', 'None', 'New', NULL, NULL, '2024-05-12 21:30:23', '2024-05-12 21:30:23'),
(6, '5', 'Ansel Stamm', 'Sales', 'ovonrueden@example.net', 'Technical Support', 'Similique accusantium et sed ullam sed.', 'https://via.placeholder.com/200x200.png/00ffaa?text=people+expedita', '1', 'None', 'New', NULL, NULL, '2024-05-12 21:30:23', '2024-05-12 21:30:23'),
(7, '1', 'Nellie Ferry', 'Finance', 'elsa.stanton@example.net', 'Technical Support', 'Molestiae nam hic neque ut.', 'https://via.placeholder.com/200x200.png/00ff55?text=people+totam', '1', 'None', 'New', NULL, NULL, '2024-05-12 21:30:23', '2024-05-12 21:30:23'),
(8, '10', 'Kaleb Towne', 'Engineering', 'earl64@example.com', 'Technical Support', 'Voluptas quo quis asperiores laudantium.', 'https://via.placeholder.com/200x200.png/0099cc?text=people+repellendus', '1', 'None', 'New', NULL, NULL, '2024-05-12 21:30:23', '2024-05-12 21:30:23'),
(9, '2', 'Orval Turner IV', 'Human Resources', 'jlubowitz@example.com', 'Data Access Request', 'Sed esse modi recusandae nesciunt et impedit.', 'https://via.placeholder.com/200x200.png/0044cc?text=people+quaerat', '1', 'None', 'New', NULL, NULL, '2024-05-12 21:30:23', '2024-05-12 21:30:23'),
(10, '12', 'Claudia McKenzie', 'Sales', 'nbeatty@example.org', 'Permission Request', 'Provident quae tempora placeat et numquam sint voluptatem.', 'https://via.placeholder.com/200x200.png/0033bb?text=people+expedita', '1', 'None', 'New', NULL, NULL, '2024-05-12 21:30:23', '2024-05-12 21:30:23'),
(11, '2', 'Lauriane Huels', 'Sales', 'caleigh.orn@example.net', 'Feature Request', 'Ea est repellendus tenetur et natus.', 'https://via.placeholder.com/200x200.png/008866?text=people+voluptatem', '1', 'None', 'New', NULL, NULL, '2024-05-12 21:30:23', '2024-05-12 21:30:23'),
(12, '16', 'Mae Schaden MD', 'Marketing', 'iortiz@example.org', 'Data Access Request', 'Officiis et vel voluptatum aliquam eius dolor.', 'https://via.placeholder.com/200x200.png/002233?text=people+ut', '1', 'None', 'New', NULL, NULL, '2024-05-12 21:30:23', '2024-05-12 21:30:23'),
(13, '17', 'Sadye Bartoletti Jr.', 'Sales', 'timmothy.rodriguez@example.net', 'Data Access Request', 'Laboriosam fugiat praesentium qui expedita accusantium autem quis.', 'https://via.placeholder.com/200x200.png/0033aa?text=people+ad', '1', 'None', 'New', NULL, NULL, '2024-05-12 21:30:23', '2024-05-12 21:30:23'),
(14, '1', 'Retha Hamill', 'Human Resources', 'fschamberger@example.org', 'Technical Support', 'Quam adipisci animi optio voluptate est aliquam quaerat.', 'https://via.placeholder.com/200x200.png/004422?text=people+sint', '1', 'None', 'New', NULL, NULL, '2024-05-12 21:30:23', '2024-05-12 21:30:23'),
(15, '17', 'Ethelyn Schroeder', 'Operations', 'qondricka@example.com', 'Data Access Request', 'Veritatis id id incidunt delectus.', 'https://via.placeholder.com/200x200.png/006633?text=people+dolor', '1', 'None', 'New', NULL, NULL, '2024-05-12 21:30:23', '2024-05-12 21:30:23'),
(16, '2', 'Bernie Johnson', 'Engineering', 'jean.crona@example.org', 'Feature Request', 'Laboriosam laboriosam accusantium molestiae id perferendis et.', 'https://via.placeholder.com/200x200.png/00bb33?text=people+non', '1', 'None', 'New', NULL, NULL, '2024-05-12 21:30:23', '2024-05-12 21:30:23'),
(17, '11', 'Braden Kerluke IV', 'Marketing', 'rau.nico@example.com', 'Data Access Request', 'Omnis nam enim ipsum non.', 'https://via.placeholder.com/200x200.png/00dd55?text=people+deserunt', '1', 'None', 'New', NULL, NULL, '2024-05-12 21:30:23', '2024-05-12 21:30:23'),
(18, '17', 'Furman O\'Kon Jr.', 'Operations', 'effertz.telly@example.net', 'Feature Request', 'Non quis dolores omnis velit voluptatem.', 'https://via.placeholder.com/200x200.png/0055aa?text=people+ut', '1', 'None', 'New', NULL, NULL, '2024-05-12 21:30:23', '2024-05-12 21:30:23'),
(19, '16', 'Rubye Hyatt', 'Sales', 'oscar34@example.net', 'Feature Request', 'Ea tenetur id accusamus a eaque sunt facere.', 'https://via.placeholder.com/200x200.png/003355?text=people+dolore', '1', 'None', 'New', NULL, NULL, '2024-05-12 21:30:23', '2024-05-12 21:30:23'),
(20, '8', 'Holly Waters', 'Finance', 'ohara.hope@example.net', 'Technical Support', 'Rerum facere omnis corrupti ut dignissimos voluptate voluptas.', 'https://via.placeholder.com/200x200.png/000033?text=people+distinctio', '1', 'None', 'New', NULL, NULL, '2024-05-12 21:30:23', '2024-05-12 21:30:23'),
(21, '14', 'Mattie Spinka', 'Sales', 'reggie.labadie@example.org', 'Feature Request', 'Animi voluptatem doloremque sed itaque.', 'https://via.placeholder.com/200x200.png/003300?text=people+voluptatem', '1', 'None', 'New', NULL, NULL, '2024-05-12 21:30:24', '2024-05-12 21:30:24'),
(22, '10', 'Llewellyn Collins', 'Human Resources', 'zboncak.darian@example.com', 'Feature Request', 'Aliquam placeat autem eligendi quia deserunt.', 'https://via.placeholder.com/200x200.png/0022dd?text=people+porro', '1', 'None', 'New', NULL, NULL, '2024-05-12 21:30:24', '2024-05-12 21:30:24'),
(23, '12', 'Mr. Noah Abshire III', 'Sales', 'jamaal.hilpert@example.net', 'Bug Report', 'Facilis facere ut labore ipsa quos et.', 'https://via.placeholder.com/200x200.png/008866?text=people+est', '1', 'None', 'New', NULL, NULL, '2024-05-12 21:30:24', '2024-05-12 21:30:24'),
(24, '2', 'Tillman Goodwin', 'Finance', 'rwaters@example.com', 'Feature Request', 'Facere sit distinctio molestias hic.', 'https://via.placeholder.com/200x200.png/0077ff?text=people+dolores', '1', 'Admin 1', 'Open', NULL, NULL, '2024-05-12 21:30:24', '2024-05-15 19:01:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` int(25) NOT NULL DEFAULT 0,
  `dept` varchar(255) NOT NULL DEFAULT 'None',
  `password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `dept`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin 6', 'admin@gmail.com', 1, 'Human Resource Division Office', '$2y$12$f7sGTbc5c5xYGgQEMD8sSOEPYUax2VRKh/f8z7KTawvzyVvk6Gdne', 'Active', NULL, '2024-03-24 18:52:46', '2024-05-16 17:34:11'),
(2, 'James Allen', 'james.sangabriel@gmail.com', 0, 'None', '$2y$12$yOSAxtWN/iF2R.de/rQ1Ru.SqUEO9I3xt/sd9/Gv9xc2/S8jkpOSu', 'Active', NULL, '2024-03-24 18:53:05', '2024-05-16 17:24:42'),
(5, 'Admin 2', 'admin2@gmail.com', 1, 'MIS', '$2y$12$lG23uNYMgNerOu0wz1LJiO8W4ZhuOqfBFLUj1RZdezeHPMTwZXXmu', 'Active', NULL, '2024-04-11 23:57:52', '2024-05-16 17:06:51'),
(6, 'Admin 3', 'admin3@gmail.com', 1, 'Finance', '$2y$12$hhrqtzEi5vsC0fFnNIGl1eydbp.nCZ02.LMoD8KpGZxSskWZP9UHe', 'Active', NULL, '2024-04-12 00:16:14', '2024-04-12 00:16:14'),
(14, 'Prof. Isai Erdman III', 'qbeahan@example.net', 0, 'None', '$2y$12$sBkU03pLCnXvC8z2zAdudu5aktY3OsWuoBM2QBd44QhNf95XQDe7a', 'Active', NULL, '2024-05-12 21:16:57', '2024-05-12 21:16:57'),
(15, 'Magdalen Vandervort', 'brooks88@example.com', 0, 'None', '$2y$12$B5qoCIdxf1bEwbfOCzEV0eox4juF5Jn2sMdCQjCI0jvOMn58vml82', 'Active', NULL, '2024-05-12 21:16:57', '2024-05-12 21:16:57'),
(16, 'Fannie Ferry II', 'schinner.maida@example.com', 0, 'None', '$2y$12$JCJqi6Jd.rvb/EnGGhE/Hug/BuM55MEvMTHPsFqdtbZVZ4P9rlLnK', 'Active', NULL, '2024-05-12 21:16:58', '2024-05-12 21:16:58'),
(17, 'Jordon Bruen', 'elyse.daugherty@example.net', 0, 'None', '$2y$12$WIl9K4pxPttnkMKTBGcPhumGSqQpCW2EpjgW9IFJOYyVjzbSz6EfC', 'Active', NULL, '2024-05-12 21:16:58', '2024-05-12 21:16:58'),
(22, 'Admin 7', 'admin8@gmail.com', 1, 'Finance', '$2y$12$1AdURMa4JaPltMUtD0Os1.aCS1URNhNTuB0pGa33QD9dZ/g7scfxm', 'Active', NULL, '2024-05-16 17:51:53', '2024-05-16 17:51:53'),
(23, 'Admin 1', 'admin9@gmail.com', 1, 'Finance', '$2y$12$d9u5jiNOTQblZ8eYqHvMIe1tLnJTymn/Q0pHK2/mW6A/luPGFHKNS', 'Active', NULL, '2024-05-16 17:52:59', '2024-05-16 17:52:59');

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
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

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
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `survey`
--
ALTER TABLE `survey`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
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
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `survey`
--
ALTER TABLE `survey`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
