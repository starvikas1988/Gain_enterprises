-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2025 at 09:53 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `logistics_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `mobile` bigint(20) NOT NULL,
  `address` varchar(191) DEFAULT NULL,
  `row_status` enum('A','D') NOT NULL DEFAULT 'A',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `mobile`, `address`, `row_status`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$K0G4VlPUXCIYc849S1BYA.AMqymQW2iHbbuE9Wrw9e6zRtkb23YRG', 'Evgrlg2cPkkUgmmUMGtesKUZn1iTO9HXt6Rtq4a83IysWRK6PV31nYRptcLB', 9999999999, 'Kalyani', 'A', '2024-04-01 13:32:34', '2024-04-02 09:44:33');

-- --------------------------------------------------------

--
-- Table structure for table `adminsettlements`
--

CREATE TABLE `adminsettlements` (
  `id` bigint(20) NOT NULL,
  `user_id` int(11) DEFAULT 0,
  `vendor_id` int(11) DEFAULT 0,
  `wallet_type` enum('Main','Daily','Monthly') DEFAULT 'Main',
  `amount` float(11,2) DEFAULT 0.00,
  `txn_type` varchar(22) DEFAULT 'Credit',
  `txn_date` date DEFAULT NULL,
  `payment_type` varchar(55) NOT NULL DEFAULT 'Cash' COMMENT 'Cash,. Online, UPI, Others',
  `message` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admins_permission`
--

CREATE TABLE `admins_permission` (
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admins_role`
--

CREATE TABLE `admins_role` (
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins_role`
--

INSERT INTO `admins_role` (`admin_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2024-04-01 08:23:49', '2024-04-01 08:23:49');

-- --------------------------------------------------------

--
-- Table structure for table `admin_charges`
--

CREATE TABLE `admin_charges` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_code` varchar(13) NOT NULL,
  `transaction_id` int(11) DEFAULT NULL,
  `transaction_amount` double(13,2) NOT NULL DEFAULT 0.00,
  `admin_charge` double(4,2) NOT NULL DEFAULT 0.00 COMMENT '(%)',
  `charge_amount` double(8,2) NOT NULL DEFAULT 0.00,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) NOT NULL,
  `btype` enum('U','V','W','C') DEFAULT 'U',
  `name` varchar(155) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` varchar(22) NOT NULL DEFAULT 'Active',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `product_price` double(13,2) NOT NULL DEFAULT 0.00,
  `total_amount` double(13,2) NOT NULL DEFAULT 0.00,
  `table_id` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `restaurant_id`, `product_id`, `qty`, `product_price`, `total_amount`, `table_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 1, 1, 4, 5, 999.00, 4995.00, NULL, '2024-11-04 13:53:45', '2025-02-13 18:57:52', NULL),
(4, 1, 1, 3, 1, 599.00, 599.00, NULL, '2024-11-10 18:00:42', '2024-11-11 18:23:29', NULL),
(5, 1, 1, 2, 1, 499.00, 499.00, NULL, '2024-11-12 15:51:32', '2024-11-12 16:56:58', NULL),
(11, 8, 1, 1, 5, 899.00, 4495.00, NULL, '2024-11-13 16:14:09', '2024-11-13 16:21:57', NULL),
(12, 9, 1, 3, 10, 599.00, 5990.00, NULL, '2024-11-14 20:39:54', '2024-11-14 20:40:44', NULL),
(13, 9, 1, 4, 7, 999.00, 6993.00, NULL, '2024-11-14 20:39:55', '2024-11-14 20:40:45', NULL),
(14, 9, 1, 2, 5, 499.00, 2495.00, NULL, '2024-11-14 20:40:39', '2024-11-14 20:40:42', NULL),
(15, 10, 1, 1, 1, 899.00, 899.00, NULL, '2024-11-15 11:57:19', '2024-11-15 11:57:19', NULL),
(76, 14, 1, 1, 2, 899.00, 1798.00, NULL, '2025-02-09 12:37:18', '2025-02-12 13:06:16', NULL),
(85, 14, 1, 2, 0, 499.00, 0.00, NULL, '2025-02-12 13:06:52', '2025-02-12 13:06:52', NULL),
(86, 14, 1, 3, 1, 599.00, 599.00, NULL, '2025-02-12 13:07:38', '2025-02-12 13:07:39', NULL),
(181, 15, 1, 1, 3, 899.00, 2697.00, NULL, '2025-03-11 16:22:23', '2025-03-11 16:22:27', NULL),
(182, 15, 1, 2, 4, 499.00, 1996.00, NULL, '2025-03-11 16:22:29', '2025-03-11 16:22:31', NULL),
(214, 6, 5, 4, 3, 999.00, 2997.00, NULL, '2025-05-22 13:41:56', '2025-06-12 16:48:51', '2025-06-12 16:48:51'),
(215, 6, 5, 13, 2, 100.00, 200.00, NULL, '2025-05-22 13:41:58', '2025-06-12 16:48:51', '2025-06-12 16:48:51'),
(216, 6, 5, 1, 2, 899.00, 1798.00, NULL, '2025-05-22 13:42:07', '2025-06-12 16:48:51', '2025-06-12 16:48:51'),
(217, 6, 1, 14, 1, 150.00, 150.00, NULL, '2025-05-29 18:15:43', '2025-06-12 16:48:51', '2025-06-12 16:48:51'),
(218, 6, 1, 60, 1, 90.00, 90.00, NULL, '2025-05-29 18:15:45', '2025-06-12 16:48:51', '2025-06-12 16:48:51'),
(219, 6, 1, 62, 2, 150.00, 300.00, NULL, '2025-05-29 18:15:47', '2025-06-12 16:48:51', '2025-06-12 16:48:51'),
(223, 6, 1, 163, 6, 15.00, 90.00, NULL, '2025-06-04 11:58:29', '2025-06-12 16:48:51', '2025-06-12 16:48:51'),
(224, 6, 1, 162, 10, 30.00, 300.00, NULL, '2025-06-04 12:09:12', '2025-06-12 16:48:51', '2025-06-12 16:48:51'),
(226, 6, 1, 139, 1, 35.00, 35.00, NULL, '2025-06-10 19:18:14', '2025-06-12 16:48:51', '2025-06-12 16:48:51'),
(227, 6, 1, 137, 1, 40.00, 40.00, NULL, '2025-06-10 19:18:14', '2025-06-12 16:48:51', '2025-06-12 16:48:51'),
(228, 6, 1, 138, 1, 25.00, 25.00, NULL, '2025-06-10 19:18:32', '2025-06-12 16:48:51', '2025-06-12 16:48:51'),
(229, 6, 1, 140, 1, 30.00, 30.00, NULL, '2025-06-10 19:18:44', '2025-06-12 16:48:51', '2025-06-12 16:48:51'),
(230, 6, 1, 136, 1, 210.00, 210.00, NULL, '2025-06-10 19:20:39', '2025-06-12 16:48:51', '2025-06-12 16:48:51'),
(231, 6, 1, 148, 1, 40.00, 40.00, NULL, '2025-06-10 19:24:45', '2025-06-12 16:48:51', '2025-06-12 16:48:51'),
(232, 6, 1, 142, 1, 250.00, 250.00, NULL, '2025-06-10 19:28:13', '2025-06-12 16:48:51', '2025-06-12 16:48:51'),
(233, 6, 1, 143, 1, 300.00, 300.00, NULL, '2025-06-10 19:28:16', '2025-06-12 16:48:51', '2025-06-12 16:48:51'),
(234, 6, 1, 146, 1, 240.00, 240.00, NULL, '2025-06-10 19:31:38', '2025-06-12 16:48:51', '2025-06-12 16:48:51'),
(246, 37, 1, 165, 1, 20.00, 20.00, NULL, '2025-06-11 18:34:16', '2025-06-19 15:36:28', '2025-06-19 15:36:28'),
(247, 6, 1, 153, 1, 270.00, 270.00, NULL, '2025-06-11 19:01:06', '2025-06-12 16:48:51', '2025-06-12 16:48:51'),
(248, 42, 1, 163, 1, 15.00, 15.00, NULL, '2025-06-11 19:20:17', '2025-06-12 15:57:07', '2025-06-12 15:57:07'),
(249, 42, 1, 162, 1, 30.00, 30.00, NULL, '2025-06-11 19:20:21', '2025-06-12 15:57:07', '2025-06-12 15:57:07'),
(250, 42, 1, 164, 1, 20.00, 20.00, NULL, '2025-06-11 19:21:23', '2025-06-12 15:57:07', '2025-06-12 15:57:07'),
(251, 42, 1, 165, 1, 20.00, 20.00, NULL, '2025-06-11 19:32:49', '2025-06-12 15:57:07', '2025-06-12 15:57:07'),
(252, 43, 1, 113, 1, 50.00, 50.00, NULL, '2025-06-11 20:28:51', '2025-06-11 20:28:51', NULL),
(257, 4, 1, 3, 1, 1.00, 1.00, NULL, '2025-06-12 15:39:35', '2025-06-12 15:40:25', '2025-06-12 15:40:25'),
(258, 4, 1, 14, 1, 150.00, 150.00, NULL, '2025-06-12 16:48:16', '2025-06-16 11:29:22', '2025-06-16 11:29:22'),
(259, 4, 1, 33, 1, 170.00, 170.00, NULL, '2025-06-16 11:08:49', '2025-06-16 11:29:22', '2025-06-16 11:29:22'),
(262, 4, 1, 134, 1, 90.00, 90.00, NULL, '2025-06-16 12:50:22', '2025-06-16 16:36:17', '2025-06-16 16:36:17'),
(263, 4, 1, 137, 2, 40.00, 80.00, NULL, '2025-06-16 15:19:03', '2025-06-16 16:36:17', '2025-06-16 16:36:17'),
(264, 4, 1, 126, 1, 120.00, 120.00, NULL, '2025-06-16 16:36:40', '2025-06-16 17:02:14', '2025-06-16 17:02:14'),
(266, 4, 1, 47, 1, 80.00, 80.00, NULL, '2025-06-16 17:53:08', '2025-06-16 18:01:48', '2025-06-16 18:01:48'),
(325, 46, 1, 2, 1, 200.00, 200.00, NULL, '2025-06-17 18:32:27', '2025-06-17 18:32:28', NULL),
(326, 46, 1, 3, 1, 180.00, 180.00, NULL, '2025-06-17 18:32:29', '2025-06-17 18:32:31', NULL),
(327, 46, 1, 4, 1, 200.00, 200.00, NULL, '2025-06-17 18:32:32', '2025-06-17 18:32:32', NULL),
(341, 4, 1, 2, 1, 200.00, 200.00, NULL, '2025-06-18 16:48:38', '2025-06-18 16:49:44', '2025-06-18 16:49:44'),
(343, 63, 1, 1, 1, 20.00, 20.00, NULL, '2025-06-26 18:46:44', '2025-06-26 18:46:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `restaurant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon` varchar(155) DEFAULT NULL,
  `status` enum('A','D') DEFAULT 'A',
  `created_by` bigint(20) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `restaurant_id`, `name`, `icon`, `status`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'INDIAN', 'public/uploads/category/1748955238.png', 'A', NULL, '2024-10-25 12:50:07', '2025-06-03 12:56:17', NULL),
(2, 1, 'CHINESE MAIN COURSE', 'public/uploads/category/fish.png', 'A', NULL, '2024-10-25 12:50:18', '2025-05-27 16:18:55', NULL),
(3, 1, 'BURGERS', 'public/uploads/category/food.png', 'A', NULL, '2024-10-25 12:50:37', '2025-05-27 16:19:22', NULL),
(4, 1, 'CHINESE SOUP', 'public/uploads/category/pizza-slice.png', 'A', NULL, '2024-10-25 12:50:49', '2025-05-27 16:19:45', NULL),
(5, 1, 'Cakes', 'public/uploads/category/1742545058.png', 'A', NULL, '2025-03-21 15:12:14', '2025-06-03 12:50:36', '2025-05-19 16:34:43'),
(6, 1, 'CHINESE STARTERS', 'public/uploads/category/1742550570.png', 'A', NULL, '2025-03-21 15:12:29', '2025-05-27 16:20:06', NULL),
(7, 1, 'Nuts', 'public/uploads/category/1742545058.png', 'A', NULL, '2025-03-21 15:12:42', '2025-06-03 12:50:42', '2025-05-19 16:35:04'),
(8, 1, 'COFFEE', 'public/uploads/category/1742551056.png', 'A', NULL, '2025-03-21 15:27:36', '2025-05-27 16:20:27', NULL),
(9, 1, 'Rasogolla sweets mania', 'public//uploads/category/1743661509.png', 'A', NULL, '2025-04-03 11:55:09', '2025-06-03 12:50:48', '2025-05-13 16:34:37'),
(10, 1, 'BEVERAGE', 'public/uploads/category/1748953287.png', 'A', NULL, '2025-05-27 16:15:23', '2025-06-03 12:51:00', NULL),
(11, 1, 'CONTINENTAL', 'public/uploads/category/1748953301.png', 'A', NULL, '2025-05-27 16:21:13', '2025-06-03 12:51:07', NULL),
(12, 1, 'FRIES', 'public/uploads/category/1748953263.png', 'A', NULL, '2025-05-27 16:21:34', '2025-06-03 12:51:15', NULL),
(13, 1, 'ICE CREAMS', 'public/uploads/category/1748953311.png', 'A', NULL, '2025-05-27 16:22:48', '2025-06-03 12:51:23', NULL),
(14, 1, 'MILKSHAKES', 'public/uploads/category/1748953466.png', 'A', NULL, '2025-05-27 16:23:11', '2025-06-03 12:51:32', NULL),
(15, 1, 'MOCKTAIL', 'public/uploads/category/1748953495.png', 'A', NULL, '2025-05-27 16:23:28', '2025-06-03 12:51:39', NULL),
(16, 1, 'MOMO', 'public/uploads/category/1748953569.png', 'A', NULL, '2025-05-27 16:23:40', '2025-06-03 12:51:48', NULL),
(17, 1, 'PAV BHAJI', 'public/uploads/category/1748953596.png', 'A', NULL, '2025-05-27 16:23:55', '2025-06-03 12:51:54', NULL),
(18, 1, 'PIZZA', 'public/uploads/category/1748953624.png', 'A', NULL, '2025-05-27 16:24:04', '2025-06-03 12:52:01', NULL),
(19, 1, 'ROLLS', 'public/uploads/category/1748953666.png', 'A', NULL, '2025-05-27 16:24:16', '2025-06-03 12:52:06', NULL),
(20, 1, 'SANDWICH', 'public/uploads/category/1748953718.png', 'A', NULL, '2025-05-27 16:24:33', '2025-06-03 12:52:11', NULL),
(21, 1, 'TANDOOR', 'public/uploads/category/1748955269.png', 'A', NULL, '2025-05-27 16:24:44', '2025-06-03 12:55:19', NULL),
(22, 1, 'TEA', 'public/uploads/category/1748953694.png', 'A', NULL, '2025-05-27 16:24:44', '2025-06-03 12:52:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `code` varchar(25) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `discount_percentage` int(11) NOT NULL,
  `required_amount` int(11) DEFAULT NULL,
  `description` varchar(155) DEFAULT NULL,
  `status` enum('A','D') NOT NULL DEFAULT 'A',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `start_date`, `end_date`, `discount_percentage`, `required_amount`, `description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'FIRST5', '2024-11-12', '2025-11-26', 5, 2000, 'GET 5% off on purchase above Rs.1999', 'A', '2024-11-12 13:08:07', '2024-11-12 13:08:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_charges`
--

CREATE TABLE `delivery_charges` (
  `id` int(11) NOT NULL,
  `min_order_amount` decimal(10,2) DEFAULT 0.00,
  `max_order_amount` decimal(10,2) DEFAULT NULL,
  `delivery_fee` decimal(10,2) NOT NULL,
  `distance_km` decimal(5,2) DEFAULT NULL,
  `restaurant_id` int(11) DEFAULT NULL,
  `status` enum('A','I') DEFAULT 'A',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery_charges`
--

INSERT INTO `delivery_charges` (`id`, `min_order_amount`, `max_order_amount`, `delivery_fee`, `distance_km`, `restaurant_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 0.00, 200.00, 0.00, NULL, NULL, 'A', '2025-06-12 12:25:21', '2025-06-13 10:34:02'),
(2, 200.01, 500.00, 0.00, NULL, NULL, 'A', '2025-06-12 12:25:21', '2025-06-13 10:33:56'),
(3, 500.01, NULL, 0.00, NULL, NULL, 'A', '2025-06-12 12:25:21', '2025-06-12 12:25:21');

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `license_number` varchar(191) NOT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `address` varchar(191) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `vehicle_type` varchar(191) DEFAULT NULL,
  `status` varchar(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`id`, `name`, `license_number`, `phone`, `email`, `address`, `date_of_birth`, `vehicle_type`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Vikram Bau', '7854125478', '8745214587', 'vikram12@gmail.com', 'Serampore', '2017-01-03', '4 wheeler', 'A', '2025-07-21 06:16:44', '2025-07-21 06:21:29', '2025-07-21 06:21:29');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `restaurant_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` bigint(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `role_id` bigint(20) DEFAULT NULL,
  `permission_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `restaurant_id`, `name`, `email`, `mobile`, `address`, `password`, `status`, `role_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(1, 5, 'Vikas Pandey', 'starvikass12@gmail.com', 8910599782, 'mahesh', '$2y$10$02E3uvaNcsX4mzDjeDJ0jeMuSQahxtWN.uvoIh/KQuPbQsCvDvAOu', 'Active', NULL, NULL, '2025-04-01 06:17:07', '2025-04-03 16:41:12');

-- --------------------------------------------------------

--
-- Table structure for table `employee_attendances`
--

CREATE TABLE `employee_attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `login_time` timestamp NULL DEFAULT NULL,
  `logout_time` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_attendances`
--

INSERT INTO `employee_attendances` (`id`, `employee_id`, `login_time`, `logout_time`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-04-15 11:24:00', '2025-04-17 11:24:00', NULL, '2025-04-16 11:25:41'),
(2, 1, '2025-04-16 11:27:17', '2025-04-16 11:27:32', '2025-04-16 11:27:17', '2025-04-16 11:27:32'),
(3, 1, '2025-04-23 13:35:00', NULL, '2025-04-23 13:35:00', '2025-04-23 13:35:00'),
(4, 1, '2025-05-13 13:16:48', NULL, '2025-05-13 13:16:48', '2025-05-13 13:16:48');

-- --------------------------------------------------------

--
-- Table structure for table `employee_roles`
--

CREATE TABLE `employee_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_roles`
--

INSERT INTO `employee_roles` (`id`, `employee_id`, `role_id`, `created_at`, `updated_at`) VALUES
(7, 1, 14, '2025-04-03 16:41:12', '2025-04-03 16:41:12'),
(8, 2, 14, '2025-05-27 18:02:25', '2025-05-27 18:02:25');

-- --------------------------------------------------------

--
-- Table structure for table `mainpermission`
--

CREATE TABLE `mainpermission` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `icon` varchar(22) NOT NULL,
  `position` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `mainpermission`
--

INSERT INTO `mainpermission` (`id`, `name`, `icon`, `position`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Drivers', 'uil-user-circle', 1, '2024-04-02 06:51:06', '2024-04-02 06:51:06', NULL),
(2, 'Stores', 'uil-user-circle', 2, '2024-04-02 06:51:06', '2024-04-02 06:51:06', NULL),
(3, 'Sub Admin', 'uil-user', 12, '2024-04-02 06:51:06', '2024-04-02 06:51:06', '2024-04-02 06:51:06'),
(5, 'Setting', 'uil-slack', 6, '2024-04-02 06:51:06', '2024-04-02 06:51:06', NULL),
(16, 'Pages', 'uil-cloud-download', 9, '2024-04-02 06:51:06', '2024-04-02 06:51:06', '2024-04-02 06:59:20'),
(17, 'Reports', 'uil-cloud-download', 8, '2024-04-02 06:51:06', '2024-04-02 06:51:06', '2024-04-02 07:00:54'),
(20, 'Admin Settlement', 'uil-cloud-download', 7, '2024-04-02 06:51:06', '2024-04-02 06:51:06', '2024-04-02 07:00:47'),
(21, 'Notifications', 'uil-cloud-download', 4, '2024-04-02 06:51:06', '2024-04-02 06:51:06', '2024-04-02 07:00:41'),
(23, 'Wallet Reports', 'uil-cloud-download', 3, '2024-04-02 06:51:06', '2024-04-02 06:51:06', NULL),
(27, 'Manage Attendance', 'uil-user-circle', 5, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2025_07_15_140224_create_stores_table', 1),
(2, '2025_07_15_121158_create_drivers_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `vendor_id` varchar(255) DEFAULT '0',
  `user_id` varchar(255) DEFAULT '0',
  `title` varchar(155) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `status` varchar(22) DEFAULT 'Sent',
  `notification_type` varchar(33) DEFAULT 'Customer',
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `restaurant_id` int(11) DEFAULT NULL,
  `payment_type` varchar(100) DEFAULT NULL,
  `token_no` varchar(200) DEFAULT NULL,
  `table_id` int(11) DEFAULT NULL,
  `order_type` varchar(55) DEFAULT NULL,
  `booking_platform` varchar(100) DEFAULT NULL,
  `address_id` varchar(255) DEFAULT NULL,
  `created_by` enum('APP','WEB') DEFAULT 'APP',
  `total_amount` double(13,2) NOT NULL,
  `total_tax` double(8,2) NOT NULL,
  `gst_percentage` int(11) DEFAULT NULL,
  `gst_type` varchar(55) DEFAULT NULL,
  `cgst` double(8,2) DEFAULT NULL,
  `sgst` double(8,2) DEFAULT NULL,
  `total_discount` double(11,2) DEFAULT 0.00,
  `coupon_amount` double(11,2) DEFAULT 0.00,
  `coupon_code` varchar(15) DEFAULT NULL,
  `order_status` varchar(55) DEFAULT NULL,
  `payment_status` varchar(55) DEFAULT NULL,
  `delivery_charge` float DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `restaurant_id`, `payment_type`, `token_no`, `table_id`, `order_type`, `booking_platform`, `address_id`, `created_by`, `total_amount`, `total_tax`, `gst_percentage`, `gst_type`, `cgst`, `sgst`, `total_discount`, `coupon_amount`, `coupon_code`, `order_status`, `payment_status`, `delivery_charge`, `created_at`, `updated_at`, `deleted_at`) VALUES
(102, 6, NULL, NULL, NULL, 1747056988, 'Dine In', NULL, NULL, 'APP', 12285.00, 122.85, 1, 'Excluding', 61.42, 61.42, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-05-12 19:06:28', '2025-05-12 19:06:28', NULL),
(103, 6, NULL, NULL, NULL, 1747057101, 'Dine In', NULL, NULL, 'APP', 12285.00, 122.85, 1, 'Excluding', 61.42, 61.42, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-05-12 19:08:21', '2025-05-12 19:08:21', NULL),
(104, 6, NULL, NULL, NULL, 1747057146, 'Dine In', NULL, NULL, 'APP', 5093.00, 50.93, 1, 'Excluding', 25.46, 25.46, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-05-12 19:09:06', '2025-05-12 19:09:06', NULL),
(105, 6, NULL, NULL, NULL, 1747057170, 'Dine In', NULL, NULL, 'APP', 5093.00, 50.93, 1, 'Excluding', 25.46, 25.46, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-05-12 19:09:30', '2025-05-12 19:09:30', NULL),
(106, 6, NULL, NULL, NULL, NULL, 'Pickup', NULL, NULL, 'APP', 5093.00, 50.93, 1, 'Excluding', 25.46, 25.46, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-05-12 19:09:39', '2025-05-12 19:09:39', NULL),
(107, 6, NULL, NULL, NULL, NULL, 'Delivery', NULL, '20', 'APP', 5093.00, 50.93, 1, 'Excluding', 25.46, 25.46, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-05-12 19:14:27', '2025-05-12 19:14:27', NULL),
(111, 6, NULL, NULL, NULL, NULL, 'Pickup', NULL, NULL, 'APP', 4995.00, 49.95, 1, 'Excluding', 24.98, 24.98, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-05-22 13:42:27', '2025-05-22 13:42:27', NULL),
(116, 4, NULL, NULL, NULL, NULL, 'Delivery', NULL, '17', 'APP', 2740.00, 293.57, 12, 'Including', 146.79, 146.79, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-11 18:21:41', '2025-06-11 18:21:41', NULL),
(117, 4, NULL, NULL, NULL, NULL, 'Delivery', NULL, '17', 'APP', 2795.00, 299.46, 12, 'Including', 149.73, 149.73, 0.00, 0.00, NULL, 'Processing', 'SUCCESS', NULL, '2025-06-12 13:36:00', '2025-06-12 13:37:13', NULL),
(118, 4, NULL, NULL, NULL, NULL, 'Delivery', NULL, '17', 'APP', 2796.00, 299.57, 12, 'Including', 149.79, 149.79, 0.00, 0.00, NULL, 'Processing', 'SUCCESS', NULL, '2025-06-12 13:39:09', '2025-06-12 13:39:51', NULL),
(119, 4, NULL, NULL, NULL, NULL, 'Delivery', NULL, '17', NULL, 2.00, 0.21, 12, 'Including', 0.11, 0.11, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-12 14:19:40', '2025-06-12 14:19:40', NULL),
(120, 4, NULL, NULL, NULL, NULL, 'Delivery', NULL, '17', NULL, 2.00, 0.21, 12, 'Including', 0.11, 0.11, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-12 14:21:38', '2025-06-12 14:21:38', NULL),
(121, 42, NULL, NULL, NULL, NULL, 'Delivery', NULL, '24', NULL, 20.00, 2.14, 12, 'Including', 1.07, 1.07, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-12 14:41:22', '2025-06-12 14:41:22', NULL),
(122, 42, NULL, NULL, NULL, NULL, 'Delivery', NULL, '24', NULL, 20.00, 2.14, 12, 'Including', 1.07, 1.07, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-12 14:42:25', '2025-06-12 14:42:25', NULL),
(123, 42, NULL, NULL, NULL, NULL, 'Delivery', NULL, '24', NULL, 45.00, 4.82, 12, 'Including', 2.41, 2.41, 0.00, 0.00, NULL, 'Processing', 'SUCCESS', NULL, '2025-06-12 14:45:17', '2025-06-12 14:46:40', NULL),
(124, 42, NULL, NULL, NULL, NULL, 'Delivery', NULL, '24', NULL, 45.00, 4.82, 12, 'Including', 2.41, 2.41, 0.00, 0.00, NULL, 'Processing', 'SUCCESS', NULL, '2025-06-12 14:49:11', '2025-06-12 14:50:29', NULL),
(125, 42, NULL, NULL, NULL, NULL, 'Delivery', NULL, '24', NULL, 45.00, 4.82, 12, 'Including', 2.41, 2.41, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-12 15:21:43', '2025-06-12 15:21:43', NULL),
(126, 42, NULL, NULL, NULL, NULL, 'Delivery', NULL, '24', NULL, 45.00, 4.82, 12, 'Including', 2.41, 2.41, 0.00, 0.00, NULL, 'Processing', 'SUCCESS', NULL, '2025-06-12 15:24:10', '2025-06-12 15:25:38', NULL),
(127, 4, NULL, NULL, NULL, NULL, 'Delivery', NULL, '17', 'APP', 1.00, 0.11, 12, 'Including', 0.05, 0.05, 0.00, 0.00, NULL, 'Processing', 'SUCCESS', NULL, '2025-06-12 15:39:54', '2025-06-12 15:40:25', NULL),
(128, 42, NULL, NULL, NULL, NULL, 'Delivery', NULL, '24', NULL, 1990.00, 213.21, 12, 'Including', 106.61, 106.61, 0.00, 0.00, NULL, 'Processing', 'SUCCESS', NULL, '2025-06-12 15:54:50', '2025-06-12 15:57:07', NULL),
(129, 42, NULL, NULL, NULL, NULL, 'Delivery', NULL, '24', NULL, 170.00, 18.21, 12, 'Including', 9.11, 9.11, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-12 16:06:55', '2025-06-12 16:06:55', NULL),
(130, 6, NULL, NULL, NULL, NULL, 'Delivery', NULL, '22', NULL, 60.00, 6.43, 12, 'Including', 3.21, 3.21, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-12 16:46:15', '2025-06-12 16:46:15', NULL),
(131, 6, NULL, NULL, NULL, NULL, 'Delivery', NULL, '22', NULL, 60.00, 6.43, 12, 'Including', 3.21, 3.21, 0.00, 0.00, NULL, 'Processing', 'SUCCESS', NULL, '2025-06-12 16:46:46', '2025-06-12 16:48:51', NULL),
(132, 42, NULL, NULL, NULL, NULL, 'Delivery', NULL, '24', NULL, 155.00, 16.61, 12, 'Including', 8.30, 8.30, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-12 17:00:44', '2025-06-12 17:00:44', NULL),
(133, 42, NULL, NULL, NULL, NULL, 'Delivery', NULL, '24', NULL, 155.00, 16.61, 12, 'Including', 8.30, 8.30, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-12 17:02:49', '2025-06-12 17:02:49', NULL),
(134, 42, NULL, NULL, NULL, NULL, 'Delivery', NULL, '24', NULL, 155.00, 16.61, 12, 'Including', 8.30, 8.30, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-12 17:02:57', '2025-06-12 17:02:57', NULL),
(135, 42, NULL, NULL, NULL, NULL, 'Delivery', NULL, '24', NULL, 155.00, 16.61, 12, 'Including', 8.30, 8.30, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-12 17:04:25', '2025-06-12 17:04:25', NULL),
(136, 42, NULL, NULL, NULL, NULL, 'Delivery', NULL, '24', NULL, 155.00, 16.61, 12, 'Including', 8.30, 8.30, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-12 17:04:34', '2025-06-12 17:04:34', NULL),
(137, 42, NULL, NULL, NULL, NULL, 'Delivery', NULL, '24', NULL, 155.00, 16.61, 12, 'Including', 8.30, 8.30, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-12 17:04:53', '2025-06-12 17:04:53', NULL),
(138, 42, NULL, NULL, NULL, NULL, 'Delivery', NULL, '24', NULL, 155.00, 16.61, 12, 'Including', 8.30, 8.30, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-12 17:04:57', '2025-06-12 17:04:57', NULL),
(139, 42, NULL, NULL, NULL, NULL, 'Delivery', NULL, '24', NULL, 155.00, 16.61, 12, 'Including', 8.30, 8.30, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-12 17:05:13', '2025-06-12 17:05:13', NULL),
(140, 42, NULL, NULL, NULL, NULL, 'Delivery', NULL, '24', NULL, 155.00, 16.61, 12, 'Including', 8.30, 8.30, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-12 17:06:46', '2025-06-12 17:06:46', NULL),
(141, 42, NULL, NULL, NULL, NULL, 'Delivery', NULL, '24', NULL, 155.00, 16.61, 12, 'Including', 8.30, 8.30, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-12 17:07:28', '2025-06-12 17:07:28', NULL),
(142, 42, NULL, NULL, NULL, NULL, 'Delivery', NULL, '24', NULL, 155.00, 16.61, 12, 'Including', 8.30, 8.30, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-12 17:29:16', '2025-06-12 17:29:16', NULL),
(143, 42, NULL, NULL, NULL, NULL, 'Delivery', NULL, '24', NULL, 155.00, 16.61, 12, 'Including', 8.30, 8.30, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-12 17:29:23', '2025-06-12 17:29:23', NULL),
(144, 42, NULL, NULL, NULL, NULL, 'Delivery', NULL, '24', NULL, 155.00, 16.61, 12, 'Including', 8.30, 8.30, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-12 17:33:22', '2025-06-12 17:33:22', NULL),
(145, 42, NULL, NULL, NULL, NULL, 'Delivery', NULL, '24', NULL, 155.00, 16.61, 12, 'Including', 8.30, 8.30, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-12 17:33:32', '2025-06-12 17:33:32', NULL),
(146, 42, NULL, NULL, NULL, NULL, 'Delivery', NULL, '24', NULL, 155.00, 16.61, 12, 'Including', 8.30, 8.30, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-12 17:34:52', '2025-06-12 17:34:52', NULL),
(147, 42, NULL, NULL, NULL, NULL, 'Delivery', NULL, '24', NULL, 60.00, 6.43, 12, 'Including', 3.21, 3.21, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-12 17:39:47', '2025-06-12 17:39:47', NULL),
(148, 42, NULL, NULL, NULL, NULL, 'Delivery', NULL, '24', NULL, 60.00, 6.43, 12, 'Including', 3.21, 3.21, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-12 17:40:18', '2025-06-12 17:40:18', NULL),
(149, 42, NULL, NULL, NULL, NULL, 'Delivery', NULL, '24', NULL, 240.00, 25.71, 12, 'Including', 12.86, 12.86, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-13 13:53:39', '2025-06-13 13:53:39', NULL),
(150, 42, NULL, NULL, NULL, NULL, 'Delivery', NULL, '24', NULL, 180.00, 19.29, 12, 'Including', 9.64, 9.64, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-13 13:55:05', '2025-06-13 13:55:05', NULL),
(151, 42, NULL, NULL, NULL, NULL, 'Delivery', NULL, '24', NULL, 180.00, 19.29, 12, 'Including', 9.64, 9.64, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-13 14:03:55', '2025-06-13 14:03:55', NULL),
(152, 42, NULL, NULL, NULL, NULL, 'Delivery', NULL, '24', NULL, 180.00, 19.29, 12, 'Including', 9.64, 9.64, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-13 14:11:12', '2025-06-13 14:11:12', NULL),
(153, 42, NULL, NULL, NULL, NULL, 'Delivery', NULL, '24', NULL, 180.00, 19.29, 12, 'Including', 9.64, 9.64, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-13 14:11:28', '2025-06-13 14:11:28', NULL),
(154, 42, NULL, NULL, NULL, NULL, 'Delivery', NULL, '24', NULL, 180.00, 19.29, 12, 'Including', 9.64, 9.64, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-13 14:11:51', '2025-06-13 14:11:51', NULL),
(155, 42, NULL, NULL, NULL, NULL, 'Delivery', NULL, '24', NULL, 180.00, 19.29, 12, 'Including', 9.64, 9.64, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-13 14:13:05', '2025-06-13 14:13:05', NULL),
(156, 42, NULL, NULL, NULL, NULL, 'Delivery', NULL, '24', NULL, 180.00, 19.29, 12, 'Including', 9.64, 9.64, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-13 15:41:35', '2025-06-13 15:41:35', NULL),
(157, 42, NULL, NULL, NULL, NULL, 'Delivery', NULL, '24', NULL, 180.00, 19.29, 12, 'Including', 9.64, 9.64, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-13 15:47:08', '2025-06-13 15:47:08', NULL),
(158, 42, NULL, NULL, NULL, NULL, 'Delivery', NULL, '24', NULL, 180.00, 19.29, 12, 'Including', 9.64, 9.64, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-13 15:47:33', '2025-06-13 15:47:33', NULL),
(159, 42, NULL, NULL, NULL, NULL, 'Delivery', NULL, '24', NULL, 180.00, 19.29, 12, 'Including', 9.64, 9.64, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-13 15:47:53', '2025-06-13 15:47:53', NULL),
(160, 42, NULL, NULL, NULL, NULL, 'Delivery', NULL, '24', NULL, 180.00, 19.29, 12, 'Including', 9.64, 9.64, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-13 15:48:11', '2025-06-13 15:48:11', NULL),
(161, 42, NULL, NULL, NULL, NULL, 'Delivery', NULL, '24', NULL, 180.00, 19.29, 12, 'Including', 9.64, 9.64, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-13 15:59:14', '2025-06-13 15:59:14', NULL),
(162, 42, NULL, NULL, NULL, NULL, 'Delivery', NULL, '24', NULL, 180.00, 19.29, 12, 'Including', 9.64, 9.64, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-13 16:07:34', '2025-06-13 16:07:34', NULL),
(163, 4, NULL, NULL, NULL, NULL, 'Delivery', NULL, '17', NULL, 400.00, 42.86, 12, 'Including', 21.43, 21.43, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-13 16:22:09', '2025-06-13 16:22:09', NULL),
(164, 4, NULL, NULL, NULL, NULL, 'Delivery', NULL, '17', NULL, 400.00, 42.86, 12, 'Including', 21.43, 21.43, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-13 16:24:48', '2025-06-13 16:24:48', NULL),
(165, 42, NULL, NULL, NULL, NULL, 'Delivery', NULL, '24', NULL, 180.00, 19.29, 12, 'Including', 9.64, 9.64, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-13 16:29:07', '2025-06-13 16:29:07', NULL),
(166, 42, NULL, NULL, NULL, NULL, 'Delivery', NULL, '24', NULL, 180.00, 19.29, 12, 'Including', 9.64, 9.64, 0.00, 0.00, NULL, 'Processing', 'SUCCESS', NULL, '2025-06-13 16:31:08', '2025-06-13 16:33:09', NULL),
(167, NULL, 1, 'cash', 'TKN684D8C73B5CCE', NULL, 'Dine-in', 'KOT', 'Kalyani', 'WEB', 220.00, 23.57, 12, 'Including', 11.79, 11.79, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-14 20:21:31', '2025-06-14 20:21:31', NULL),
(168, NULL, 1, 'upi', 'TKN684D8D6E3A01A', NULL, 'Dine-in', 'KOT', 'Kalyani', 'WEB', 170.00, 18.21, 12, 'Including', 9.11, 9.11, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-14 20:25:42', '2025-06-14 20:25:42', NULL),
(169, 4, NULL, NULL, NULL, 1750053417, 'Dine In', NULL, NULL, 'APP', 320.00, 34.29, 12, 'Including', 17.14, 17.14, 0.00, 0.00, NULL, 'Processing', 'SUCCESS', NULL, '2025-06-16 11:26:57', '2025-06-16 11:29:22', NULL),
(170, NULL, 1, 'cash', 'TKN684FB35A320ED', 2, 'Dine-in', 'KOT', 'Kalyani', 'WEB', 200.00, 21.43, 12, 'Including', 10.71, 10.71, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-16 11:32:02', '2025-06-16 11:32:02', NULL),
(171, 4, NULL, NULL, NULL, NULL, 'Delivery', NULL, '17', NULL, 440.00, 42.86, 12, 'Including', 21.43, 21.43, 0.00, 0.00, NULL, 'Pending', 'Pending', 40, '2025-06-16 16:28:10', '2025-06-16 16:28:10', NULL),
(172, 4, NULL, NULL, NULL, NULL, 'Delivery', NULL, '17', NULL, 400.00, 42.86, 12, 'Including', 21.43, 21.43, 0.00, 0.00, NULL, 'Pending', 'Pending', 0, '2025-06-16 16:29:39', '2025-06-16 16:29:39', NULL),
(173, 4, NULL, NULL, NULL, NULL, 'Delivery', NULL, '17', NULL, 405.00, 42.86, 12, 'Including', 21.43, 21.43, 0.00, 0.00, NULL, 'Pending', 'Pending', 5, '2025-06-16 16:32:36', '2025-06-16 16:32:36', NULL),
(174, 4, NULL, NULL, NULL, NULL, 'Delivery', NULL, '17', 'APP', 170.00, 18.21, 12, 'Including', 9.11, 9.11, 0.00, 0.00, NULL, 'Processing', 'SUCCESS', 0, '2025-06-16 16:35:44', '2025-06-16 16:36:17', NULL),
(175, 4, NULL, NULL, NULL, NULL, 'Delivery', NULL, '17', 'APP', 120.00, 12.86, 12, 'Including', 6.43, 6.43, 0.00, 0.00, NULL, 'Processing', 'SUCCESS', 0, '2025-06-16 17:01:36', '2025-06-16 17:02:14', NULL),
(176, 1, 1, 'cash', 'TKN68500C4998758', NULL, 'Dine-in', 'KOT', 'Kalyani', 'WEB', 30.00, 3.21, 12, 'Including', 1.61, 1.61, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-16 17:51:29', '2025-06-16 17:51:29', NULL),
(177, 4, NULL, NULL, NULL, NULL, 'Delivery', NULL, '17', 'APP', 80.00, 8.57, 12, 'Including', 4.29, 4.29, 0.00, 0.00, NULL, 'Processing', 'SUCCESS', 0, '2025-06-16 18:01:18', '2025-06-16 18:01:48', NULL),
(178, 42, NULL, NULL, NULL, NULL, 'Delivery', NULL, '24', NULL, 180.00, 19.29, 12, 'Including', 9.64, 9.64, 0.00, 0.00, NULL, 'Pending', 'Pending', 0, '2025-06-16 20:02:41', '2025-06-16 20:02:41', NULL),
(179, NULL, 1, 'upi', 'TKN68503A7F5C7D7', NULL, 'Dine-in', 'KOT', 'Kalyani', 'WEB', 210.00, 22.50, 12, 'Including', 11.25, 11.25, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-16 21:08:39', '2025-06-16 21:08:39', NULL),
(180, 42, NULL, NULL, NULL, NULL, 'Delivery', NULL, '24', NULL, 90.00, 9.64, 12, 'Including', 4.82, 4.82, 0.00, 0.00, NULL, 'Pending', 'Pending', 0, '2025-06-16 21:19:09', '2025-06-16 21:19:09', NULL),
(181, 42, NULL, NULL, NULL, NULL, 'Delivery', NULL, '24', NULL, 60.00, 6.43, 12, 'Including', 3.21, 3.21, 0.00, 0.00, NULL, 'Pending', 'Pending', 0, '2025-06-17 11:12:47', '2025-06-17 11:12:47', NULL),
(182, NULL, 1, 'cash', 'TKN685127E8D060B', NULL, 'Dine-in', 'KOT', 'Kalyani', 'WEB', 60.00, 6.43, 12, 'Including', 3.21, 3.21, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-17 14:01:36', '2025-06-17 14:01:36', NULL),
(183, NULL, 1, 'cash', 'TKN68512816F3C3D', NULL, 'Dine-in', 'KOT', 'Kalyani', 'WEB', 230.00, 24.64, 12, 'Including', 12.32, 12.32, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-17 14:02:22', '2025-06-17 14:02:22', NULL),
(184, NULL, 1, 'cash', 'TKN685147CAE5CA7', NULL, 'Dine-in', 'KOT', 'Kalyani', 'WEB', 240.00, 25.71, 12, 'Including', 12.86, 12.86, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-17 16:17:38', '2025-06-17 16:17:38', NULL),
(185, NULL, 1, 'cash', 'TKN685156B38BC96', NULL, 'Dine-in', 'KOT', 'Kalyani', 'WEB', 1320.00, 141.43, 12, 'Including', 70.71, 70.71, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-17 17:21:15', '2025-06-17 17:21:15', NULL),
(186, NULL, 1, 'cash', 'TKN68516C97AD45C', NULL, 'Dine-in', 'KOT', 'Kalyani', 'WEB', 660.00, 70.71, 12, 'Including', 35.36, 35.36, 0.00, 0.00, NULL, 'Processing', 'Failed', NULL, '2025-06-17 18:54:39', '2025-06-18 15:30:43', NULL),
(187, 37, NULL, NULL, NULL, NULL, 'Delivery', NULL, '25', NULL, 15.00, 1.61, 12, 'Including', 0.80, 0.80, 0.00, 0.00, NULL, 'Pending', 'Pending', 0, '2025-06-17 20:34:31', '2025-06-17 20:34:31', NULL),
(188, NULL, 1, 'upi', 'TKN68518F49D918A', NULL, 'Dine-in', 'KOT', 'Kalyani', 'WEB', 20.00, 2.14, 12, 'Including', 1.07, 1.07, 0.00, 0.00, NULL, 'Completed', 'SUCCESS', NULL, '2025-06-17 21:22:41', '2025-06-18 15:36:36', NULL),
(189, 4, NULL, NULL, NULL, 1750245552, 'Dine In', NULL, NULL, 'APP', 200.00, 21.43, 12, 'Including', 10.71, 10.71, 0.00, 0.00, NULL, 'Processing', 'SUCCESS', 0, '2025-06-18 16:49:12', '2025-06-18 16:49:44', NULL),
(190, 42, NULL, NULL, NULL, NULL, 'Delivery', NULL, '24', NULL, 150.00, 16.07, 12, 'Including', 8.04, 8.04, 0.00, 0.00, NULL, 'Processing', 'SUCCESS', 0, '2025-06-18 18:38:59', '2025-06-18 18:40:09', NULL),
(191, 37, NULL, NULL, NULL, NULL, 'Delivery', NULL, '25', NULL, 15.00, 1.61, 12, 'Including', 0.80, 0.80, 0.00, 0.00, NULL, 'Pending', 'Pending', 0, '2025-06-19 15:33:51', '2025-06-19 15:33:51', NULL),
(192, 37, NULL, NULL, NULL, NULL, 'Delivery', NULL, '25', NULL, 10.00, 1.07, 12, 'Including', 0.54, 0.54, 0.00, 0.00, NULL, 'Processing', 'SUCCESS', 0, '2025-06-19 15:35:47', '2025-06-19 15:36:28', NULL),
(193, NULL, 1, 'upi', 'TKN6853E81C90D41', NULL, 'Dine-in', 'KOT', 'Kalyani', 'WEB', 20.00, 2.14, 12, 'Including', 1.07, 1.07, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-19 16:06:12', '2025-06-19 16:06:12', NULL),
(194, NULL, 1, 'cash', 'TKN6853EC16EDF09', NULL, 'Dine-in', 'KOT', 'Kalyani', 'WEB', 220.00, 23.57, 12, 'Including', 11.79, 11.79, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-19 16:23:10', '2025-06-19 16:23:10', NULL),
(195, 18, NULL, NULL, NULL, NULL, 'Delivery', NULL, '26', NULL, 185.00, 19.82, 12, 'Including', 9.91, 9.91, 0.00, 0.00, NULL, 'Pending', 'Pending', 0, '2025-06-20 19:58:57', '2025-06-20 19:58:57', NULL),
(196, NULL, 1, 'cash', 'TKN001', NULL, 'Dine-in', 'KOT', 'Kalyani', 'WEB', 470.00, 50.36, 12, 'Including', 25.18, 25.18, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-22 12:59:11', '2025-06-22 12:59:11', NULL),
(197, NULL, 1, 'cash', 'TKN002', NULL, 'Dine-in', 'KOT', 'Kalyani', 'WEB', 220.00, 23.57, 12, 'Including', 11.79, 11.79, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-22 13:00:02', '2025-06-22 13:00:02', NULL),
(198, NULL, 1, 'cash', 'TKN003', NULL, 'Dine-in', 'KOT', 'Kalyani', 'WEB', 980.00, 105.00, 12, 'Including', 52.50, 52.50, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-22 13:04:25', '2025-06-22 13:04:25', NULL),
(199, NULL, 1, 'cash', 'TKN004', NULL, 'Dine-in', 'KOT', 'Kalyani', 'WEB', 1440.00, 154.29, 12, 'Including', 77.14, 77.14, 0.00, 0.00, NULL, 'Pending', 'Pending', NULL, '2025-06-22 13:22:49', '2025-06-22 13:22:49', NULL),
(200, 6, NULL, NULL, NULL, NULL, 'Delivery', NULL, '22', NULL, 15.00, 1.61, 12, 'Including', 0.80, 0.80, 0.00, 0.00, NULL, 'Pending', 'Pending', 0, '2025-06-23 16:46:49', '2025-06-23 16:46:49', NULL),
(201, 6, NULL, NULL, NULL, NULL, 'Delivery', NULL, '22', NULL, 30.00, 3.21, 12, 'Including', 1.61, 1.61, 0.00, 0.00, NULL, 'Pending', 'Pending', 0, '2025-06-23 17:01:51', '2025-06-23 17:01:51', NULL),
(202, 6, NULL, NULL, NULL, NULL, 'Delivery', NULL, '22', NULL, 105.00, 11.25, 12, 'Including', 5.62, 5.62, 0.00, 0.00, NULL, 'Pending', 'Pending', 0, '2025-06-25 19:45:51', '2025-06-25 19:45:51', NULL),
(203, 60, NULL, NULL, NULL, 1750931066, 'Dine In', NULL, NULL, 'APP', 70.00, 7.50, 12, 'Including', 3.75, 3.75, 0.00, 0.00, NULL, 'Pending', 'Pending', 0, '2025-06-26 15:14:26', '2025-06-26 15:14:26', NULL),
(204, 60, NULL, NULL, NULL, 1750931069, 'Dine In', NULL, NULL, 'APP', 70.00, 7.50, 12, 'Including', 3.75, 3.75, 0.00, 0.00, NULL, 'Pending', 'Pending', 0, '2025-06-26 15:14:29', '2025-06-26 15:14:29', NULL),
(205, 60, NULL, NULL, NULL, 1750931070, 'Dine In', NULL, NULL, 'APP', 70.00, 7.50, 12, 'Including', 3.75, 3.75, 0.00, 0.00, NULL, 'Pending', 'Pending', 0, '2025-06-26 15:14:30', '2025-06-26 15:14:30', NULL),
(206, 60, NULL, NULL, NULL, 1750931071, 'Dine In', NULL, NULL, 'APP', 70.00, 7.50, 12, 'Including', 3.75, 3.75, 0.00, 0.00, NULL, 'Pending', 'Pending', 0, '2025-06-26 15:14:31', '2025-06-26 15:14:31', NULL),
(207, 60, NULL, NULL, NULL, 1750931078, 'Dine In', NULL, NULL, 'APP', 70.00, 7.50, 12, 'Including', 3.75, 3.75, 0.00, 0.00, NULL, 'Pending', 'Pending', 0, '2025-06-26 15:14:38', '2025-06-26 15:14:38', NULL),
(208, 60, NULL, NULL, NULL, 1750931348, 'Dine In', NULL, NULL, 'APP', 70.00, 7.50, 12, 'Including', 3.75, 3.75, 0.00, 0.00, NULL, 'Pending', 'Pending', 0, '2025-06-26 15:19:08', '2025-06-26 15:19:08', NULL),
(209, 6, NULL, NULL, NULL, NULL, 'Delivery', NULL, '22', NULL, 90.00, 9.64, 12, 'Including', 4.82, 4.82, 0.00, 0.00, NULL, 'Pending', 'Pending', 0, '2025-06-27 14:18:37', '2025-06-27 14:18:37', NULL),
(210, 6, NULL, NULL, NULL, NULL, 'Delivery', NULL, '22', NULL, 90.00, 9.64, 12, 'Including', 4.82, 4.82, 0.00, 0.00, NULL, 'Pending', 'Pending', 0, '2025-06-27 14:26:19', '2025-06-27 14:26:19', NULL),
(211, 6, NULL, NULL, NULL, NULL, 'Delivery', NULL, '22', NULL, 90.00, 9.64, 12, 'Including', 4.82, 4.82, 0.00, 0.00, NULL, 'Pending', 'Pending', 0, '2025-06-27 14:27:21', '2025-06-27 14:27:21', NULL),
(212, 6, NULL, NULL, NULL, NULL, 'Delivery', NULL, '22', NULL, 90.00, 9.64, 12, 'Including', 4.82, 4.82, 0.00, 0.00, NULL, 'Pending', 'Pending', 0, '2025-06-27 14:27:25', '2025-06-27 14:27:25', NULL),
(213, 6, NULL, NULL, NULL, NULL, 'Delivery', NULL, '22', NULL, 90.00, 9.64, 12, 'Including', 4.82, 4.82, 0.00, 0.00, NULL, 'Pending', 'Pending', 0, '2025-06-27 14:29:55', '2025-06-27 14:29:55', NULL),
(214, 6, NULL, NULL, NULL, NULL, 'Delivery', NULL, '22', NULL, 90.00, 9.64, 12, 'Including', 4.82, 4.82, 0.00, 0.00, NULL, 'Pending', 'Pending', 0, '2025-06-27 14:30:00', '2025-06-27 14:30:00', NULL),
(215, 60, NULL, NULL, NULL, 1751185238, 'Dine In', NULL, NULL, 'APP', 90.00, 9.64, 12, 'Including', 4.82, 4.82, 0.00, 0.00, NULL, 'Pending', 'Pending', 0, '2025-06-29 13:50:38', '2025-06-29 13:50:38', NULL),
(216, 60, NULL, NULL, NULL, 1751185910, 'Dine In', NULL, NULL, 'APP', 220.00, 23.57, 12, 'Including', 11.79, 11.79, 0.00, 0.00, NULL, 'Pending', 'Pending', 0, '2025-06-29 14:01:50', '2025-06-29 14:01:50', NULL),
(217, 18, NULL, NULL, NULL, NULL, 'Delivery', NULL, '26', NULL, 60.00, 6.43, 12, 'Including', 3.21, 3.21, 0.00, 0.00, NULL, 'Pending', 'Pending', 0, '2025-07-01 12:52:47', '2025-07-01 12:52:47', NULL),
(218, 37, NULL, NULL, NULL, NULL, 'Delivery', NULL, '25', NULL, 10.00, 1.07, 12, 'Including', 0.54, 0.54, 0.00, 0.00, NULL, 'Pending', 'Pending', 0, '2025-07-03 07:46:48', '2025-07-03 07:46:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `restaurant_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` double(13,2) NOT NULL,
  `total_amount` double(13,2) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `user_id`, `restaurant_id`, `product_id`, `quantity`, `amount`, `total_amount`, `created_at`, `updated_at`, `deleted_at`) VALUES
(172, 102, 6, 5, 2, 3, 499.00, 1497.00, '2025-05-12 19:06:28', '2025-05-12 19:06:28', NULL),
(173, 102, 6, 5, 1, 12, 899.00, 10788.00, '2025-05-12 19:06:28', '2025-05-12 19:06:28', NULL),
(174, 103, 6, 5, 2, 3, 499.00, 1497.00, '2025-05-12 19:08:21', '2025-05-12 19:08:21', NULL),
(175, 103, 6, 5, 1, 12, 899.00, 10788.00, '2025-05-12 19:08:21', '2025-05-12 19:08:21', NULL),
(176, 104, 6, 5, 2, 3, 499.00, 1497.00, '2025-05-12 19:09:06', '2025-05-12 19:09:06', NULL),
(177, 104, 6, 5, 1, 4, 899.00, 3596.00, '2025-05-12 19:09:06', '2025-05-12 19:09:06', NULL),
(178, 105, 6, 5, 2, 3, 499.00, 1497.00, '2025-05-12 19:09:30', '2025-05-12 19:09:30', NULL),
(179, 105, 6, 5, 1, 4, 899.00, 3596.00, '2025-05-12 19:09:30', '2025-05-12 19:09:30', NULL),
(180, 106, 6, 5, 2, 3, 499.00, 1497.00, '2025-05-12 19:09:39', '2025-05-12 19:09:39', NULL),
(181, 106, 6, 5, 1, 4, 899.00, 3596.00, '2025-05-12 19:09:39', '2025-05-12 19:09:39', NULL),
(182, 107, 6, 5, 2, 3, 499.00, 1497.00, '2025-05-12 19:14:27', '2025-05-12 19:14:27', NULL),
(183, 107, 6, 5, 1, 4, 899.00, 3596.00, '2025-05-12 19:14:27', '2025-05-12 19:14:27', NULL),
(187, 111, 6, 5, 1, 2, 899.00, 1798.00, '2025-05-22 13:42:27', '2025-05-22 13:42:27', NULL),
(188, 111, 6, 5, 13, 2, 100.00, 200.00, '2025-05-22 13:42:27', '2025-05-22 13:42:27', NULL),
(189, 111, 6, 5, 4, 3, 999.00, 2997.00, '2025-05-22 13:42:27', '2025-05-22 13:42:27', NULL),
(196, 116, 4, 1, 13, 1, 10.00, 10.00, '2025-06-11 18:21:41', '2025-06-11 18:21:41', NULL),
(197, 116, 4, 1, 136, 3, 210.00, 630.00, '2025-06-11 18:21:41', '2025-06-11 18:21:41', NULL),
(198, 116, 4, 1, 143, 7, 300.00, 2100.00, '2025-06-11 18:21:41', '2025-06-11 18:21:41', NULL),
(199, 117, 4, 1, 163, 1, 15.00, 15.00, '2025-06-12 13:36:00', '2025-06-12 13:36:00', NULL),
(200, 117, 4, 1, 143, 7, 300.00, 2100.00, '2025-06-12 13:36:00', '2025-06-12 13:36:00', NULL),
(201, 117, 4, 1, 136, 3, 210.00, 630.00, '2025-06-12 13:36:00', '2025-06-12 13:36:00', NULL),
(202, 117, 4, 1, 13, 1, 10.00, 10.00, '2025-06-12 13:36:00', '2025-06-12 13:36:00', NULL),
(203, 117, 4, 1, 164, 2, 20.00, 40.00, '2025-06-12 13:36:00', '2025-06-12 13:36:00', NULL),
(204, 118, 4, 1, 3, 1, 1.00, 1.00, '2025-06-12 13:39:09', '2025-06-12 13:39:09', NULL),
(205, 118, 4, 1, 164, 2, 20.00, 40.00, '2025-06-12 13:39:09', '2025-06-12 13:39:09', NULL),
(206, 118, 4, 1, 163, 1, 15.00, 15.00, '2025-06-12 13:39:09', '2025-06-12 13:39:09', NULL),
(207, 118, 4, 1, 143, 7, 300.00, 2100.00, '2025-06-12 13:39:09', '2025-06-12 13:39:09', NULL),
(208, 118, 4, 1, 136, 3, 210.00, 630.00, '2025-06-12 13:39:09', '2025-06-12 13:39:09', NULL),
(209, 118, 4, 1, 13, 1, 10.00, 10.00, '2025-06-12 13:39:09', '2025-06-12 13:39:09', NULL),
(210, 119, 4, 1, 4, 2, 1.00, 2.00, '2025-06-12 14:19:40', '2025-06-12 14:19:40', NULL),
(211, 120, 4, 1, 4, 2, 1.00, 2.00, '2025-06-12 14:21:38', '2025-06-12 14:21:38', NULL),
(212, 121, 42, 1, 164, 1, 20.00, 20.00, '2025-06-12 14:41:22', '2025-06-12 14:41:22', NULL),
(213, 122, 42, 1, 164, 1, 20.00, 20.00, '2025-06-12 14:42:25', '2025-06-12 14:42:25', NULL),
(214, 123, 42, 1, 162, 1, 30.00, 30.00, '2025-06-12 14:45:17', '2025-06-12 14:45:17', NULL),
(215, 123, 42, 1, 163, 1, 15.00, 15.00, '2025-06-12 14:45:17', '2025-06-12 14:45:17', NULL),
(216, 124, 42, 1, 162, 1, 30.00, 30.00, '2025-06-12 14:49:11', '2025-06-12 14:49:11', NULL),
(217, 124, 42, 1, 163, 1, 15.00, 15.00, '2025-06-12 14:49:11', '2025-06-12 14:49:11', NULL),
(218, 125, 42, 1, 162, 1, 30.00, 30.00, '2025-06-12 15:21:43', '2025-06-12 15:21:43', NULL),
(219, 125, 42, 1, 163, 1, 15.00, 15.00, '2025-06-12 15:21:43', '2025-06-12 15:21:43', NULL),
(220, 126, 42, 1, 162, 1, 30.00, 30.00, '2025-06-12 15:24:10', '2025-06-12 15:24:10', NULL),
(221, 126, 42, 1, 163, 1, 15.00, 15.00, '2025-06-12 15:24:10', '2025-06-12 15:24:10', NULL),
(222, 127, 4, 1, 3, 1, 1.00, 1.00, '2025-06-12 15:39:54', '2025-06-12 15:39:54', NULL),
(223, 128, 42, 1, 136, 9, 210.00, 1890.00, '2025-06-12 15:54:50', '2025-06-12 15:54:50', NULL),
(224, 128, 42, 1, 164, 5, 20.00, 100.00, '2025-06-12 15:54:50', '2025-06-12 15:54:50', NULL),
(225, 129, 42, 1, 162, 4, 30.00, 120.00, '2025-06-12 16:06:55', '2025-06-12 16:06:55', NULL),
(226, 129, 42, 1, 163, 2, 15.00, 30.00, '2025-06-12 16:06:55', '2025-06-12 16:06:55', NULL),
(227, 129, 42, 1, 164, 1, 20.00, 20.00, '2025-06-12 16:06:55', '2025-06-12 16:06:55', NULL),
(228, 130, 6, 1, 162, 2, 30.00, 60.00, '2025-06-12 16:46:15', '2025-06-12 16:46:15', NULL),
(229, 131, 6, 1, 162, 2, 30.00, 60.00, '2025-06-12 16:46:46', '2025-06-12 16:46:46', NULL),
(230, 132, 42, 1, 162, 3, 30.00, 90.00, '2025-06-12 17:00:44', '2025-06-12 17:00:44', NULL),
(231, 132, 42, 1, 163, 3, 15.00, 45.00, '2025-06-12 17:00:44', '2025-06-12 17:00:44', NULL),
(232, 132, 42, 1, 164, 1, 20.00, 20.00, '2025-06-12 17:00:44', '2025-06-12 17:00:44', NULL),
(233, 133, 42, 1, 162, 3, 30.00, 90.00, '2025-06-12 17:02:49', '2025-06-12 17:02:49', NULL),
(234, 133, 42, 1, 163, 3, 15.00, 45.00, '2025-06-12 17:02:49', '2025-06-12 17:02:49', NULL),
(235, 133, 42, 1, 164, 1, 20.00, 20.00, '2025-06-12 17:02:49', '2025-06-12 17:02:49', NULL),
(236, 134, 42, 1, 162, 3, 30.00, 90.00, '2025-06-12 17:02:57', '2025-06-12 17:02:57', NULL),
(237, 134, 42, 1, 163, 3, 15.00, 45.00, '2025-06-12 17:02:57', '2025-06-12 17:02:57', NULL),
(238, 134, 42, 1, 164, 1, 20.00, 20.00, '2025-06-12 17:02:57', '2025-06-12 17:02:57', NULL),
(239, 135, 42, 1, 162, 3, 30.00, 90.00, '2025-06-12 17:04:25', '2025-06-12 17:04:25', NULL),
(240, 135, 42, 1, 163, 3, 15.00, 45.00, '2025-06-12 17:04:25', '2025-06-12 17:04:25', NULL),
(241, 135, 42, 1, 164, 1, 20.00, 20.00, '2025-06-12 17:04:25', '2025-06-12 17:04:25', NULL),
(242, 136, 42, 1, 162, 3, 30.00, 90.00, '2025-06-12 17:04:34', '2025-06-12 17:04:34', NULL),
(243, 136, 42, 1, 163, 3, 15.00, 45.00, '2025-06-12 17:04:34', '2025-06-12 17:04:34', NULL),
(244, 136, 42, 1, 164, 1, 20.00, 20.00, '2025-06-12 17:04:34', '2025-06-12 17:04:34', NULL),
(245, 137, 42, 1, 162, 3, 30.00, 90.00, '2025-06-12 17:04:53', '2025-06-12 17:04:53', NULL),
(246, 137, 42, 1, 163, 3, 15.00, 45.00, '2025-06-12 17:04:53', '2025-06-12 17:04:53', NULL),
(247, 137, 42, 1, 164, 1, 20.00, 20.00, '2025-06-12 17:04:53', '2025-06-12 17:04:53', NULL),
(248, 138, 42, 1, 162, 3, 30.00, 90.00, '2025-06-12 17:04:57', '2025-06-12 17:04:57', NULL),
(249, 138, 42, 1, 163, 3, 15.00, 45.00, '2025-06-12 17:04:57', '2025-06-12 17:04:57', NULL),
(250, 138, 42, 1, 164, 1, 20.00, 20.00, '2025-06-12 17:04:57', '2025-06-12 17:04:57', NULL),
(251, 139, 42, 1, 162, 3, 30.00, 90.00, '2025-06-12 17:05:13', '2025-06-12 17:05:13', NULL),
(252, 139, 42, 1, 163, 3, 15.00, 45.00, '2025-06-12 17:05:13', '2025-06-12 17:05:13', NULL),
(253, 139, 42, 1, 164, 1, 20.00, 20.00, '2025-06-12 17:05:13', '2025-06-12 17:05:13', NULL),
(254, 140, 42, 1, 162, 3, 30.00, 90.00, '2025-06-12 17:06:46', '2025-06-12 17:06:46', NULL),
(255, 140, 42, 1, 163, 3, 15.00, 45.00, '2025-06-12 17:06:46', '2025-06-12 17:06:46', NULL),
(256, 140, 42, 1, 164, 1, 20.00, 20.00, '2025-06-12 17:06:46', '2025-06-12 17:06:46', NULL),
(257, 141, 42, 1, 162, 3, 30.00, 90.00, '2025-06-12 17:07:28', '2025-06-12 17:07:28', NULL),
(258, 141, 42, 1, 163, 3, 15.00, 45.00, '2025-06-12 17:07:28', '2025-06-12 17:07:28', NULL),
(259, 141, 42, 1, 164, 1, 20.00, 20.00, '2025-06-12 17:07:28', '2025-06-12 17:07:28', NULL),
(260, 142, 42, 1, 162, 3, 30.00, 90.00, '2025-06-12 17:29:16', '2025-06-12 17:29:16', NULL),
(261, 142, 42, 1, 163, 3, 15.00, 45.00, '2025-06-12 17:29:16', '2025-06-12 17:29:16', NULL),
(262, 142, 42, 1, 164, 1, 20.00, 20.00, '2025-06-12 17:29:16', '2025-06-12 17:29:16', NULL),
(263, 143, 42, 1, 162, 3, 30.00, 90.00, '2025-06-12 17:29:23', '2025-06-12 17:29:23', NULL),
(264, 143, 42, 1, 163, 3, 15.00, 45.00, '2025-06-12 17:29:23', '2025-06-12 17:29:23', NULL),
(265, 143, 42, 1, 164, 1, 20.00, 20.00, '2025-06-12 17:29:23', '2025-06-12 17:29:23', NULL),
(266, 144, 42, 1, 162, 3, 30.00, 90.00, '2025-06-12 17:33:22', '2025-06-12 17:33:22', NULL),
(267, 144, 42, 1, 163, 3, 15.00, 45.00, '2025-06-12 17:33:22', '2025-06-12 17:33:22', NULL),
(268, 144, 42, 1, 164, 1, 20.00, 20.00, '2025-06-12 17:33:22', '2025-06-12 17:33:22', NULL),
(269, 145, 42, 1, 162, 3, 30.00, 90.00, '2025-06-12 17:33:32', '2025-06-12 17:33:32', NULL),
(270, 145, 42, 1, 163, 3, 15.00, 45.00, '2025-06-12 17:33:32', '2025-06-12 17:33:32', NULL),
(271, 145, 42, 1, 164, 1, 20.00, 20.00, '2025-06-12 17:33:32', '2025-06-12 17:33:32', NULL),
(272, 146, 42, 1, 162, 3, 30.00, 90.00, '2025-06-12 17:34:52', '2025-06-12 17:34:52', NULL),
(273, 146, 42, 1, 163, 3, 15.00, 45.00, '2025-06-12 17:34:52', '2025-06-12 17:34:52', NULL),
(274, 146, 42, 1, 164, 1, 20.00, 20.00, '2025-06-12 17:34:52', '2025-06-12 17:34:52', NULL),
(275, 147, 42, 1, 162, 2, 30.00, 60.00, '2025-06-12 17:39:47', '2025-06-12 17:39:47', NULL),
(276, 148, 42, 1, 162, 2, 30.00, 60.00, '2025-06-12 17:40:18', '2025-06-12 17:40:18', NULL),
(277, 149, 42, 1, 162, 5, 30.00, 150.00, '2025-06-13 13:53:39', '2025-06-13 13:53:39', NULL),
(278, 149, 42, 1, 163, 6, 15.00, 90.00, '2025-06-13 13:53:39', '2025-06-13 13:53:39', NULL),
(279, 150, 42, 1, 162, 3, 30.00, 90.00, '2025-06-13 13:55:05', '2025-06-13 13:55:05', NULL),
(280, 150, 42, 1, 163, 6, 15.00, 90.00, '2025-06-13 13:55:05', '2025-06-13 13:55:05', NULL),
(281, 151, 42, 1, 162, 3, 30.00, 90.00, '2025-06-13 14:03:55', '2025-06-13 14:03:55', NULL),
(282, 151, 42, 1, 163, 6, 15.00, 90.00, '2025-06-13 14:03:55', '2025-06-13 14:03:55', NULL),
(283, 152, 42, 1, 162, 3, 30.00, 90.00, '2025-06-13 14:11:12', '2025-06-13 14:11:12', NULL),
(284, 152, 42, 1, 163, 6, 15.00, 90.00, '2025-06-13 14:11:12', '2025-06-13 14:11:12', NULL),
(285, 153, 42, 1, 162, 3, 30.00, 90.00, '2025-06-13 14:11:28', '2025-06-13 14:11:28', NULL),
(286, 153, 42, 1, 163, 6, 15.00, 90.00, '2025-06-13 14:11:28', '2025-06-13 14:11:28', NULL),
(287, 154, 42, 1, 162, 3, 30.00, 90.00, '2025-06-13 14:11:51', '2025-06-13 14:11:51', NULL),
(288, 154, 42, 1, 163, 6, 15.00, 90.00, '2025-06-13 14:11:51', '2025-06-13 14:11:51', NULL),
(289, 155, 42, 1, 162, 3, 30.00, 90.00, '2025-06-13 14:13:05', '2025-06-13 14:13:05', NULL),
(290, 155, 42, 1, 163, 6, 15.00, 90.00, '2025-06-13 14:13:05', '2025-06-13 14:13:05', NULL),
(291, 156, 42, 1, 162, 3, 30.00, 90.00, '2025-06-13 15:41:35', '2025-06-13 15:41:35', NULL),
(292, 156, 42, 1, 163, 6, 15.00, 90.00, '2025-06-13 15:41:35', '2025-06-13 15:41:35', NULL),
(293, 157, 42, 1, 162, 3, 30.00, 90.00, '2025-06-13 15:47:08', '2025-06-13 15:47:08', NULL),
(294, 157, 42, 1, 163, 6, 15.00, 90.00, '2025-06-13 15:47:08', '2025-06-13 15:47:08', NULL),
(295, 158, 42, 1, 162, 3, 30.00, 90.00, '2025-06-13 15:47:33', '2025-06-13 15:47:33', NULL),
(296, 158, 42, 1, 163, 6, 15.00, 90.00, '2025-06-13 15:47:33', '2025-06-13 15:47:33', NULL),
(297, 159, 42, 1, 162, 3, 30.00, 90.00, '2025-06-13 15:47:53', '2025-06-13 15:47:53', NULL),
(298, 159, 42, 1, 163, 6, 15.00, 90.00, '2025-06-13 15:47:53', '2025-06-13 15:47:53', NULL),
(299, 160, 42, 1, 162, 3, 30.00, 90.00, '2025-06-13 15:48:11', '2025-06-13 15:48:11', NULL),
(300, 160, 42, 1, 163, 6, 15.00, 90.00, '2025-06-13 15:48:11', '2025-06-13 15:48:11', NULL),
(301, 161, 42, 1, 162, 3, 30.00, 90.00, '2025-06-13 15:59:14', '2025-06-13 15:59:14', NULL),
(302, 161, 42, 1, 163, 6, 15.00, 90.00, '2025-06-13 15:59:14', '2025-06-13 15:59:14', NULL),
(303, 162, 42, 1, 162, 3, 30.00, 90.00, '2025-06-13 16:07:34', '2025-06-13 16:07:34', NULL),
(304, 162, 42, 1, 163, 6, 15.00, 90.00, '2025-06-13 16:07:34', '2025-06-13 16:07:34', NULL),
(305, 163, 4, 1, 4, 2, 200.00, 400.00, '2025-06-13 16:22:09', '2025-06-13 16:22:09', NULL),
(306, 164, 4, 1, 4, 2, 200.00, 400.00, '2025-06-13 16:24:48', '2025-06-13 16:24:48', NULL),
(307, 165, 42, 1, 162, 3, 30.00, 90.00, '2025-06-13 16:29:07', '2025-06-13 16:29:07', NULL),
(308, 165, 42, 1, 163, 6, 15.00, 90.00, '2025-06-13 16:29:07', '2025-06-13 16:29:07', NULL),
(309, 166, 42, 1, 162, 3, 30.00, 90.00, '2025-06-13 16:31:08', '2025-06-13 16:31:08', NULL),
(310, 166, 42, 1, 163, 6, 15.00, 90.00, '2025-06-13 16:31:08', '2025-06-13 16:31:08', NULL),
(311, 167, NULL, 1, 1, 1, 20.00, 20.00, '2025-06-14 20:21:31', '2025-06-14 20:21:31', NULL),
(312, 167, NULL, 1, 2, 1, 200.00, 200.00, '2025-06-14 20:21:31', '2025-06-14 20:21:31', NULL),
(313, 168, NULL, 1, 33, 1, 170.00, 170.00, '2025-06-14 20:25:42', '2025-06-14 20:25:42', NULL),
(314, 169, 4, 1, 33, 1, 170.00, 170.00, '2025-06-16 11:26:57', '2025-06-16 11:26:57', NULL),
(315, 169, 4, 1, 14, 1, 150.00, 150.00, '2025-06-16 11:26:57', '2025-06-16 11:26:57', NULL),
(316, 170, NULL, 1, 2, 1, 200.00, 200.00, '2025-06-16 11:32:02', '2025-06-16 11:32:02', NULL),
(317, 171, 4, 1, 4, 2, 200.00, 400.00, '2025-06-16 16:28:10', '2025-06-16 16:28:10', NULL),
(318, 172, 4, 1, 4, 2, 200.00, 400.00, '2025-06-16 16:29:39', '2025-06-16 16:29:39', NULL),
(319, 173, 4, 1, 4, 2, 200.00, 400.00, '2025-06-16 16:32:36', '2025-06-16 16:32:36', NULL),
(320, 174, 4, 1, 137, 2, 40.00, 80.00, '2025-06-16 16:35:44', '2025-06-16 16:35:44', NULL),
(321, 174, 4, 1, 134, 1, 90.00, 90.00, '2025-06-16 16:35:44', '2025-06-16 16:35:44', NULL),
(322, 175, 4, 1, 126, 1, 120.00, 120.00, '2025-06-16 17:01:36', '2025-06-16 17:01:36', NULL),
(323, 176, NULL, 1, 1, 1, 20.00, 20.00, '2025-06-16 17:51:29', '2025-06-16 17:51:29', NULL),
(324, 176, NULL, 1, 13, 1, 10.00, 10.00, '2025-06-16 17:51:29', '2025-06-16 17:51:29', NULL),
(325, 177, 4, 1, 47, 1, 80.00, 80.00, '2025-06-16 18:01:18', '2025-06-16 18:01:18', NULL),
(326, 178, 42, 1, 133, 2, 90.00, 180.00, '2025-06-16 20:02:41', '2025-06-16 20:02:41', NULL),
(327, 179, NULL, 1, 13, 1, 10.00, 10.00, '2025-06-16 21:08:39', '2025-06-16 21:08:39', NULL),
(328, 179, NULL, 1, 4, 1, 200.00, 200.00, '2025-06-16 21:08:39', '2025-06-16 21:08:39', NULL),
(329, 180, 42, 1, 162, 3, 30.00, 90.00, '2025-06-16 21:19:09', '2025-06-16 21:19:09', NULL),
(330, 181, 42, 1, 162, 2, 30.00, 60.00, '2025-06-17 11:12:47', '2025-06-17 11:12:47', NULL),
(331, 182, NULL, 1, 1, 2, 20.00, 40.00, '2025-06-17 14:01:36', '2025-06-17 14:01:36', NULL),
(332, 182, NULL, 1, 13, 2, 10.00, 20.00, '2025-06-17 14:01:36', '2025-06-17 14:01:36', NULL),
(333, 183, NULL, 1, 13, 3, 10.00, 30.00, '2025-06-17 14:02:23', '2025-06-17 14:02:23', NULL),
(334, 183, NULL, 1, 2, 1, 200.00, 200.00, '2025-06-17 14:02:23', '2025-06-17 14:02:23', NULL),
(335, 184, NULL, 1, 1, 2, 20.00, 40.00, '2025-06-17 16:17:38', '2025-06-17 16:17:38', NULL),
(336, 184, NULL, 1, 2, 1, 200.00, 200.00, '2025-06-17 16:17:38', '2025-06-17 16:17:38', NULL),
(337, 185, NULL, 1, 1, 6, 20.00, 120.00, '2025-06-17 17:21:15', '2025-06-17 17:21:15', NULL),
(338, 185, NULL, 1, 2, 6, 200.00, 1200.00, '2025-06-17 17:21:15', '2025-06-17 17:21:15', NULL),
(339, 186, NULL, 1, 1, 3, 20.00, 60.00, '2025-06-17 18:54:39', '2025-06-17 18:54:39', NULL),
(340, 186, NULL, 1, 2, 3, 200.00, 600.00, '2025-06-17 18:54:39', '2025-06-17 18:54:39', NULL),
(341, 187, 37, 1, 163, 1, 15.00, 15.00, '2025-06-17 20:34:31', '2025-06-17 20:34:31', NULL),
(342, 188, NULL, 1, 1, 1, 20.00, 20.00, '2025-06-17 21:22:41', '2025-06-17 21:22:41', NULL),
(343, 189, 4, 1, 2, 1, 200.00, 200.00, '2025-06-18 16:49:12', '2025-06-18 16:49:12', NULL),
(344, 190, 42, 1, 162, 4, 30.00, 120.00, '2025-06-18 18:38:59', '2025-06-18 18:38:59', NULL),
(345, 190, 42, 1, 163, 2, 15.00, 30.00, '2025-06-18 18:38:59', '2025-06-18 18:38:59', NULL),
(346, 191, 37, 1, 163, 1, 15.00, 15.00, '2025-06-19 15:33:51', '2025-06-19 15:33:51', NULL),
(347, 192, 37, 1, 13, 1, 10.00, 10.00, '2025-06-19 15:35:47', '2025-06-19 15:35:47', NULL),
(348, 193, NULL, 1, 1, 1, 20.00, 20.00, '2025-06-19 16:06:12', '2025-06-19 16:06:12', NULL),
(349, 194, NULL, 1, 1, 1, 20.00, 20.00, '2025-06-19 16:23:10', '2025-06-19 16:23:10', NULL),
(350, 194, NULL, 1, 2, 1, 200.00, 200.00, '2025-06-19 16:23:10', '2025-06-19 16:23:10', NULL),
(351, 195, 18, 1, 162, 5, 30.00, 150.00, '2025-06-20 19:58:57', '2025-06-20 19:58:57', NULL),
(352, 195, 18, 1, 163, 1, 15.00, 15.00, '2025-06-20 19:58:57', '2025-06-20 19:58:57', NULL),
(353, 195, 18, 1, 164, 1, 20.00, 20.00, '2025-06-20 19:58:57', '2025-06-20 19:58:57', NULL),
(354, 196, NULL, 1, 1, 3, 20.00, 60.00, '2025-06-22 12:59:11', '2025-06-22 12:59:11', NULL),
(355, 196, NULL, 1, 3, 2, 180.00, 360.00, '2025-06-22 12:59:11', '2025-06-22 12:59:11', NULL),
(356, 196, NULL, 1, 13, 5, 10.00, 50.00, '2025-06-22 12:59:11', '2025-06-22 12:59:11', NULL),
(357, 197, NULL, 1, 1, 1, 20.00, 20.00, '2025-06-22 13:00:02', '2025-06-22 13:00:02', NULL),
(358, 197, NULL, 1, 3, 1, 180.00, 180.00, '2025-06-22 13:00:02', '2025-06-22 13:00:02', NULL),
(359, 197, NULL, 1, 13, 2, 10.00, 20.00, '2025-06-22 13:00:02', '2025-06-22 13:00:02', NULL),
(360, 198, NULL, 1, 1, 1, 20.00, 20.00, '2025-06-22 13:04:25', '2025-06-22 13:04:25', NULL),
(361, 198, NULL, 1, 3, 2, 180.00, 360.00, '2025-06-22 13:04:25', '2025-06-22 13:04:25', NULL),
(362, 198, NULL, 1, 4, 3, 200.00, 600.00, '2025-06-22 13:04:25', '2025-06-22 13:04:25', NULL),
(363, 199, NULL, 1, 1, 2, 20.00, 40.00, '2025-06-22 13:22:49', '2025-06-22 13:22:49', NULL),
(364, 199, NULL, 1, 2, 4, 200.00, 800.00, '2025-06-22 13:22:49', '2025-06-22 13:22:49', NULL),
(365, 199, NULL, 1, 4, 3, 200.00, 600.00, '2025-06-22 13:22:49', '2025-06-22 13:22:49', NULL),
(366, 200, 6, 1, 163, 1, 15.00, 15.00, '2025-06-23 16:46:49', '2025-06-23 16:46:49', NULL),
(367, 201, 6, 1, 163, 2, 15.00, 30.00, '2025-06-23 17:01:51', '2025-06-23 17:01:51', NULL),
(368, 202, 6, 1, 162, 3, 30.00, 90.00, '2025-06-25 19:45:51', '2025-06-25 19:45:51', NULL),
(369, 202, 6, 1, 163, 1, 15.00, 15.00, '2025-06-25 19:45:51', '2025-06-25 19:45:51', NULL),
(370, 203, 60, 1, 168, 1, 70.00, 70.00, '2025-06-26 15:14:26', '2025-06-26 15:14:26', NULL),
(371, 204, 60, 1, 168, 1, 70.00, 70.00, '2025-06-26 15:14:29', '2025-06-26 15:14:29', NULL),
(372, 205, 60, 1, 168, 1, 70.00, 70.00, '2025-06-26 15:14:30', '2025-06-26 15:14:30', NULL),
(373, 206, 60, 1, 168, 1, 70.00, 70.00, '2025-06-26 15:14:31', '2025-06-26 15:14:31', NULL),
(374, 207, 60, 1, 168, 1, 70.00, 70.00, '2025-06-26 15:14:38', '2025-06-26 15:14:38', NULL),
(375, 208, 60, 1, 168, 1, 70.00, 70.00, '2025-06-26 15:19:08', '2025-06-26 15:19:08', NULL),
(376, 209, 6, 1, 162, 3, 30.00, 90.00, '2025-06-27 14:18:37', '2025-06-27 14:18:37', NULL),
(377, 210, 6, 1, 162, 3, 30.00, 90.00, '2025-06-27 14:26:19', '2025-06-27 14:26:19', NULL),
(378, 211, 6, 1, 162, 3, 30.00, 90.00, '2025-06-27 14:27:21', '2025-06-27 14:27:21', NULL),
(379, 212, 6, 1, 162, 3, 30.00, 90.00, '2025-06-27 14:27:25', '2025-06-27 14:27:25', NULL),
(380, 213, 6, 1, 162, 3, 30.00, 90.00, '2025-06-27 14:29:55', '2025-06-27 14:29:55', NULL),
(381, 214, 6, 1, 162, 3, 30.00, 90.00, '2025-06-27 14:30:00', '2025-06-27 14:30:00', NULL),
(382, 215, 60, 1, 1, 1, 20.00, 20.00, '2025-06-29 13:50:38', '2025-06-29 13:50:38', NULL),
(383, 215, 60, 1, 168, 1, 70.00, 70.00, '2025-06-29 13:50:38', '2025-06-29 13:50:38', NULL),
(384, 216, 60, 1, 2, 1, 200.00, 200.00, '2025-06-29 14:01:50', '2025-06-29 14:01:50', NULL),
(385, 216, 60, 1, 1, 1, 20.00, 20.00, '2025-06-29 14:01:50', '2025-06-29 14:01:50', NULL),
(386, 217, 18, 1, 162, 2, 30.00, 60.00, '2025-07-01 12:52:47', '2025-07-01 12:52:47', NULL),
(387, 218, 37, 1, 94, 1, 10.00, 10.00, '2025-07-03 07:46:48', '2025-07-03 07:46:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_types`
--

CREATE TABLE `order_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_types`
--

INSERT INTO `order_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Dine-in', '2025-03-20 08:15:26', '2025-03-20 08:15:26'),
(2, 'Takeaway', '2025-03-20 08:15:26', '2025-03-20 08:15:26'),
(3, 'Delivery', '2025-03-20 08:15:26', '2025-03-20 08:15:26');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) NOT NULL,
  `page_name` varchar(155) NOT NULL,
  `page_url` varchar(155) NOT NULL,
  `page_desc` longtext NOT NULL,
  `row_status` enum('A','D') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `transaction_id` varchar(75) DEFAULT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `payment_id` varchar(155) DEFAULT NULL,
  `gateway` varchar(55) DEFAULT 'RAZORPAY',
  `amount` float(10,2) NOT NULL,
  `response` text DEFAULT NULL,
  `status` varchar(55) NOT NULL DEFAULT 'FAILED',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `transaction_id`, `order_id`, `payment_id`, `gateway`, `amount`, `response`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '6', 'order_PJy5j97HgXeSNp', 'pay_OvnIOkWrjR68jn', 'RAZORPAY', 2297.00, '{\"error\":{\"code\":\"BAD_REQUEST_ERROR\",\"description\":\"The id provided does not exist\",\"source\":\"business\",\"step\":\"payment_initiation\",\"reason\":\"input_validation_failed\",\"metadata\":{}}}', 'FAILED', '2024-11-11 16:10:47', '2024-11-15 17:45:02', NULL),
(8203, 1, '6', 'order_PJzfJveZe2tMUU', NULL, 'RAZORPAY', 2297.00, NULL, 'FAILED', '2024-11-11 17:43:09', '2024-11-11 17:43:11', NULL),
(8204, 1, '10', 'order_PJzqldFIPX1eJq', NULL, 'RAZORPAY', 1398.00, NULL, 'FAILED', '2024-11-11 17:54:01', '2024-11-11 17:54:01', NULL),
(8205, 1, '10', 'order_PJzwriCDBmAPy8', NULL, 'RAZORPAY', 1398.00, NULL, 'FAILED', '2024-11-11 17:59:47', '2024-11-11 17:59:47', NULL),
(8206, 1, '10', 'order_PJzxobh8uBvVbz', NULL, 'RAZORPAY', 1398.00, NULL, 'FAILED', '2024-11-11 18:00:40', '2024-11-11 18:00:41', NULL),
(8207, 1, '10', 'order_PK00Q8y2QQrRRO', NULL, 'RAZORPAY', 1398.00, NULL, 'FAILED', '2024-11-11 18:03:09', '2024-11-11 18:03:09', NULL),
(8208, 1, '10', 'order_PK04SWZQ8B6T6B', NULL, 'RAZORPAY', 1398.00, NULL, 'FAILED', '2024-11-11 18:06:58', '2024-11-11 18:06:59', NULL),
(8209, 1, '10', 'order_PK06129TGQYF0A', NULL, 'RAZORPAY', 1398.00, NULL, 'FAILED', '2024-11-11 18:08:27', '2024-11-11 18:08:27', NULL),
(8210, 1, '11', 'order_PK0ASmMBdwiipf', NULL, 'RAZORPAY', 1398.00, NULL, 'FAILED', '2024-11-11 18:12:39', '2024-11-11 18:12:40', NULL),
(8211, 1, '11', 'order_PK0CAkOXPgtLsE', NULL, 'RAZORPAY', 1398.00, NULL, 'FAILED', '2024-11-11 18:14:17', '2024-11-11 18:14:17', NULL),
(8212, 1, '11', 'order_PK0CwuD58g84cM', NULL, 'RAZORPAY', 1398.00, NULL, 'FAILED', '2024-11-11 18:15:01', '2024-11-11 18:15:01', NULL),
(8213, 1, '11', 'order_PK0DYHiGB7628z', NULL, 'RAZORPAY', 1398.00, NULL, 'FAILED', '2024-11-11 18:15:35', '2024-11-11 18:15:35', NULL),
(8214, 1, '12', 'order_PK0It49urs86Mo', NULL, 'RAZORPAY', 499.00, NULL, 'FAILED', '2024-11-11 18:20:37', '2024-11-11 18:20:38', NULL),
(8215, 1, '13', 'order_PK0M7rid6FhJt0', NULL, 'RAZORPAY', 1198.00, NULL, 'FAILED', '2024-11-11 18:23:42', '2024-11-11 18:23:42', NULL),
(8216, 1, '6', 'order_PK0bhlEd83YW0M', NULL, 'RAZORPAY', 2297.00, NULL, 'FAILED', '2024-11-11 18:38:26', '2024-11-11 18:38:27', NULL),
(8217, 1, '13', 'order_PK0j2ZTLZ9JtZ5', NULL, 'RAZORPAY', 1198.00, NULL, 'FAILED', '2024-11-11 18:45:23', '2024-11-11 18:45:24', NULL),
(8218, 1, '13', 'order_PK0jmAcsVKn8eW', NULL, 'RAZORPAY', 1198.00, NULL, 'FAILED', '2024-11-11 18:46:05', '2024-11-11 18:46:05', NULL),
(8219, 1, '13', 'order_PK0lcJDnEx1568', NULL, 'RAZORPAY', 1198.00, NULL, 'FAILED', '2024-11-11 18:47:50', '2024-11-11 18:47:50', NULL),
(8220, 1, '14', 'order_PK0u9d0a3J6mFe', NULL, 'RAZORPAY', 1198.00, NULL, 'FAILED', '2024-11-11 18:55:54', '2024-11-11 18:55:55', NULL),
(8221, 1, '14', 'order_PK0yLfA4wUXQPn', NULL, 'RAZORPAY', 1198.00, NULL, 'FAILED', '2024-11-11 18:59:53', '2024-11-11 18:59:53', NULL),
(8222, 1, '14', 'order_PK0zdLcrK7KRP0', NULL, 'RAZORPAY', 1198.00, NULL, 'FAILED', '2024-11-11 19:01:06', '2024-11-11 19:01:06', NULL),
(8223, 1, '17', 'order_PKMmsUtGGWQicm', NULL, 'RAZORPAY', 2496.00, NULL, 'FAILED', '2024-11-12 16:20:16', '2024-11-12 16:20:17', NULL),
(8224, 1, '17', 'order_PKMmssIsaSxnpi', NULL, 'RAZORPAY', 2496.00, NULL, 'FAILED', '2024-11-12 16:20:17', '2024-11-12 16:20:17', NULL),
(8225, 1, '18', 'order_PKMqBoKtQViqJL', NULL, 'RAZORPAY', 2496.00, NULL, 'FAILED', '2024-11-12 16:23:25', '2024-11-12 16:23:25', NULL),
(8226, 1, '20', 'order_PKPyJ6Q3plXa4z', NULL, 'RAZORPAY', 899.00, NULL, 'FAILED', '2024-11-12 19:27:10', '2024-11-12 19:27:11', NULL),
(8227, 1, '21', 'order_PKQ0YZm3HyRUBV', NULL, 'RAZORPAY', 1398.00, NULL, 'FAILED', '2024-11-12 19:29:19', '2024-11-12 19:29:19', NULL),
(8228, 1, '22', 'order_PKgY7DuTMhzK1d', 'pay_PKgacifH2RRS4D', 'RAZORPAY', 899.00, '{\"id\":\"pay_PKgacifH2RRS4D\",\"entity\":\"payment\",\"amount\":89900,\"currency\":\"INR\",\"status\":\"captured\",\"order_id\":\"order_PKgaLnHoWjmmpE\",\"invoice_id\":null,\"international\":false,\"method\":\"wallet\",\"amount_refunded\":0,\"refund_status\":null,\"captured\":true,\"description\":null,\"card_id\":null,\"bank\":null,\"wallet\":\"freecharge\",\"vpa\":null,\"email\":\"ishani3@gmail.com\",\"contact\":\"+919636963696\",\"notes\":{\"notes_key_1\":8229,\"notes_key_2\":\"\"},\"fee\":2122,\"tax\":324,\"error_code\":null,\"error_description\":null,\"error_source\":null,\"error_step\":null,\"error_reason\":null,\"acquirer_data\":{\"transaction_id\":null},\"created_at\":1731478354}', 'SUCCESS', '2024-11-13 11:40:10', '2024-11-13 11:42:54', NULL),
(8229, 1, '22', 'order_PKgaLnHoWjmmpE', NULL, 'RAZORPAY', 899.00, NULL, 'FAILED', '2024-11-13 11:42:18', '2024-11-13 11:42:18', NULL),
(8230, 1, '23', 'order_PKghSjZqHZPkK5', 'pay_PKghgcxJ34fVu2', 'RAZORPAY', 899.00, '{\"id\":\"pay_PKghgcxJ34fVu2\",\"entity\":\"payment\",\"amount\":89900,\"currency\":\"INR\",\"status\":\"captured\",\"order_id\":\"order_PKghSjZqHZPkK5\",\"invoice_id\":null,\"international\":false,\"method\":\"wallet\",\"amount_refunded\":0,\"refund_status\":null,\"captured\":true,\"description\":null,\"card_id\":null,\"bank\":null,\"wallet\":\"freecharge\",\"vpa\":null,\"email\":\"ishani3@gmail.com\",\"contact\":\"+919636963696\",\"notes\":{\"notes_key_1\":8230,\"notes_key_2\":\"\"},\"fee\":2122,\"tax\":324,\"error_code\":null,\"error_description\":null,\"error_source\":null,\"error_step\":null,\"error_reason\":null,\"acquirer_data\":{\"transaction_id\":null},\"created_at\":1731478755}', 'SUCCESS', '2024-11-13 11:49:02', '2024-11-13 11:49:35', NULL),
(8231, 1, '27', 'order_PL949xPzgAVXTl', NULL, 'RAZORPAY', 1398.00, NULL, 'FAILED', '2024-11-14 15:33:55', '2024-11-14 15:33:56', NULL),
(8232, 1, '27', 'order_PL95JLK6BuRLCa', NULL, 'RAZORPAY', 1398.00, NULL, 'FAILED', '2024-11-14 15:35:01', '2024-11-14 15:35:02', NULL),
(8233, 1, '28', 'order_PL962K2fDdUmm0', 'pay_PL96lU2IQLZgvt', 'RAZORPAY', 1398.00, '{\"id\":\"pay_PL96lU2IQLZgvt\",\"entity\":\"payment\",\"amount\":139800,\"currency\":\"INR\",\"status\":\"captured\",\"order_id\":\"order_PL962K2fDdUmm0\",\"invoice_id\":null,\"international\":false,\"method\":\"wallet\",\"amount_refunded\":0,\"refund_status\":null,\"captured\":true,\"description\":null,\"card_id\":null,\"bank\":null,\"wallet\":\"freecharge\",\"vpa\":null,\"email\":\"ishani3@gmail.com\",\"contact\":\"+919836985236\",\"notes\":{\"notes_key_1\":8233,\"notes_key_2\":\"\"},\"fee\":3300,\"tax\":504,\"error_code\":null,\"error_description\":null,\"error_source\":null,\"error_step\":null,\"error_reason\":null,\"acquirer_data\":{\"transaction_id\":null},\"created_at\":1731578785}', 'SUCCESS', '2024-11-14 15:35:43', '2024-11-14 15:36:44', NULL),
(8234, 1, '29', 'order_PLEfutFhWT3EGM', 'pay_PLEgaXGHr7nmhc', 'RAZORPAY', 899.00, '{\"id\":\"pay_PLEgaXGHr7nmhc\",\"entity\":\"payment\",\"amount\":89900,\"currency\":\"INR\",\"status\":\"captured\",\"order_id\":\"order_PLEfutFhWT3EGM\",\"invoice_id\":null,\"international\":false,\"method\":\"wallet\",\"amount_refunded\":0,\"refund_status\":null,\"captured\":true,\"description\":null,\"card_id\":null,\"bank\":null,\"wallet\":\"freecharge\",\"vpa\":null,\"email\":\"ishani67@gmail.com\",\"contact\":\"+919876523533\",\"notes\":{\"notes_key_1\":8234,\"notes_key_2\":\"\"},\"fee\":2122,\"tax\":324,\"error_code\":null,\"error_description\":null,\"error_source\":null,\"error_step\":null,\"error_reason\":null,\"acquirer_data\":{\"transaction_id\":null},\"created_at\":1731598427}', 'SUCCESS', '2024-11-14 21:03:08', '2024-11-14 21:04:05', NULL),
(8235, 1, '30', 'order_PLEi1pQZmudfBj', 'pay_PLEiJhrl77OdNS', 'RAZORPAY', 899.00, '{\"id\":\"pay_PLEiJhrl77OdNS\",\"entity\":\"payment\",\"amount\":89900,\"currency\":\"INR\",\"status\":\"captured\",\"order_id\":\"order_PLEi1pQZmudfBj\",\"invoice_id\":null,\"international\":false,\"method\":\"wallet\",\"amount_refunded\":0,\"refund_status\":null,\"captured\":true,\"description\":null,\"card_id\":null,\"bank\":null,\"wallet\":\"freecharge\",\"vpa\":null,\"email\":\"ishani67@gmail.com\",\"contact\":\"+919876523533\",\"notes\":{\"notes_key_1\":8235,\"notes_key_2\":\"\"},\"fee\":2122,\"tax\":324,\"error_code\":null,\"error_description\":null,\"error_source\":null,\"error_step\":null,\"error_reason\":null,\"acquirer_data\":{\"transaction_id\":null},\"created_at\":1731598526}', 'SUCCESS', '2024-11-14 21:05:09', '2024-11-14 21:05:44', NULL),
(8236, 4, '40', 'order_PLYepgHYdEppPX', NULL, 'RAZORPAY', 1798.00, NULL, 'FAILED', '2024-11-15 16:35:58', '2024-11-15 16:36:00', NULL),
(8237, 4, '40', 'order_PLYept52ID7Hws', NULL, 'RAZORPAY', 1798.00, NULL, 'FAILED', '2024-11-15 16:36:00', '2024-11-15 16:36:00', NULL),
(8238, 1, '6', 'order_PLYh1Zu1FjOhp2', NULL, 'RAZORPAY', 2297.00, NULL, 'FAILED', '2024-11-15 16:38:04', '2024-11-15 16:38:04', NULL),
(8239, 4, '41', 'order_PLZ6wb1ImdMjce', NULL, 'RAZORPAY', 5592.00, NULL, 'FAILED', '2024-11-15 17:02:36', '2024-11-15 17:02:36', NULL),
(8240, 11, '42', 'order_PLZJIYIEefgv5D', 'pay_PLZLhs57hW1XnN', 'RAZORPAY', 1398.00, '{\"id\":\"pay_PLZLhs57hW1XnN\",\"entity\":\"payment\",\"amount\":139800,\"currency\":\"INR\",\"status\":\"captured\",\"order_id\":\"order_PLZJIYIEefgv5D\",\"invoice_id\":null,\"international\":false,\"method\":\"wallet\",\"amount_refunded\":0,\"refund_status\":null,\"captured\":true,\"description\":null,\"card_id\":null,\"bank\":null,\"wallet\":\"jiomoney\",\"vpa\":null,\"email\":\"void@razorpay.com\",\"contact\":\"+918777347811\",\"notes\":{\"notes_key_1\":8240,\"notes_key_2\":\"\"},\"fee\":3300,\"tax\":504,\"error_code\":null,\"error_description\":null,\"error_source\":null,\"error_step\":null,\"error_reason\":null,\"acquirer_data\":{\"transaction_id\":null},\"created_at\":1731671195}', 'SUCCESS', '2024-11-15 17:14:18', '2024-11-15 17:16:41', NULL),
(8241, 4, '43', 'order_PLZMUpb4qnkQ85', NULL, 'RAZORPAY', 5592.00, NULL, 'FAILED', '2024-11-15 17:17:20', '2024-11-15 17:17:20', NULL),
(8242, 4, '46', 'order_PLZPiC72Tzoma9', NULL, 'RAZORPAY', 5592.00, NULL, 'FAILED', '2024-11-15 17:20:22', '2024-11-15 17:20:22', NULL),
(8243, 4, '47', 'order_PLZRYUSCswLDmp', NULL, 'RAZORPAY', 5592.00, NULL, 'FAILED', '2024-11-15 17:22:07', '2024-11-15 17:22:07', NULL),
(8244, 4, '48', 'order_PLZSfHnzTrak42', NULL, 'RAZORPAY', 5592.00, NULL, 'FAILED', '2024-11-15 17:23:10', '2024-11-15 17:23:10', NULL),
(8245, 4, '49', 'order_PLZTUaZ4kTGz1p', NULL, 'RAZORPAY', 5592.00, NULL, 'FAILED', '2024-11-15 17:23:57', '2024-11-15 17:23:57', NULL),
(8246, 4, '50', 'order_PLZUYFcRiyyMqR', NULL, 'RAZORPAY', 5592.00, NULL, 'FAILED', '2024-11-15 17:24:57', '2024-11-15 17:24:57', NULL),
(8247, 4, '51', 'order_PLZXyqVhups5On', NULL, 'RAZORPAY', 5592.00, NULL, 'FAILED', '2024-11-15 17:28:12', '2024-11-15 17:28:12', NULL),
(8248, 4, '52', 'order_PLZZiEWF9yIn0q', NULL, 'RAZORPAY', 5592.00, NULL, 'FAILED', '2024-11-15 17:29:50', '2024-11-15 17:29:50', NULL),
(8249, 4, '53', 'order_PLZc3huNp7x8j2', NULL, 'RAZORPAY', 5592.00, NULL, 'FAILED', '2024-11-15 17:32:03', '2024-11-15 17:32:04', NULL),
(8250, 4, '54', 'order_PLZct6XsfnfWBV', NULL, 'RAZORPAY', 5592.00, NULL, 'FAILED', '2024-11-15 17:32:51', '2024-11-15 17:32:51', NULL),
(8251, 4, '55', 'order_PLZdUSIrBE4042', NULL, 'RAZORPAY', 5592.00, NULL, 'FAILED', '2024-11-15 17:33:25', '2024-11-15 17:33:25', NULL),
(8252, 4, '56', 'order_PLZh0zqAczmuMm', NULL, 'RAZORPAY', 5592.00, NULL, 'FAILED', '2024-11-15 17:36:45', '2024-11-15 17:36:45', NULL),
(8253, 4, '57', 'order_PLZlzc9vG5rzoV', NULL, 'RAZORPAY', 5592.00, NULL, 'FAILED', '2024-11-15 17:41:27', '2024-11-15 17:41:28', NULL),
(8254, 1, '6', 'order_PLZpvXgMaIxujU', NULL, 'RAZORPAY', 2297.00, NULL, 'FAILED', '2024-11-15 17:45:11', '2024-11-15 17:45:11', NULL),
(8255, 4, '58', 'order_PLZqeb7D29oos0', NULL, 'RAZORPAY', 5592.00, NULL, 'FAILED', '2024-11-15 17:45:53', '2024-11-15 17:45:53', NULL),
(8256, 4, '59', 'order_PLZwThzoIWh1Q9', NULL, 'RAZORPAY', 5592.00, NULL, 'FAILED', '2024-11-15 17:51:23', '2024-11-15 17:51:23', NULL),
(8257, 4, '60', 'order_PLZy52bgG2qdC7', NULL, 'RAZORPAY', 5592.00, NULL, 'FAILED', '2024-11-15 17:52:54', '2024-11-15 17:52:54', NULL),
(8258, 4, '61', 'order_PLa0MedaFWyWDy', NULL, 'RAZORPAY', 5592.00, NULL, 'FAILED', '2024-11-15 17:55:04', '2024-11-15 17:55:04', NULL),
(8259, 4, '62', 'order_PLa58ohisctdXY', NULL, 'RAZORPAY', 4693.00, NULL, 'FAILED', '2024-11-15 17:59:35', '2024-11-15 17:59:35', NULL),
(8260, 4, '63', 'order_PLa7yLr0cNxfnq', 'pay_PLa95KOJdq8FnV', 'RAZORPAY', 4693.00, '{\"id\":\"pay_PLa95KOJdq8FnV\",\"entity\":\"payment\",\"amount\":469300,\"currency\":\"INR\",\"status\":\"authorized\",\"order_id\":null,\"invoice_id\":null,\"international\":false,\"method\":\"wallet\",\"amount_refunded\":0,\"refund_status\":null,\"captured\":false,\"description\":\"Test Transaction\",\"card_id\":null,\"bank\":null,\"wallet\":\"freecharge\",\"vpa\":null,\"email\":\"saifuddin@example.com\",\"contact\":\"+919564779055\",\"notes\":{\"address\":\"Razorpay Corporate Office\"},\"fee\":null,\"tax\":null,\"error_code\":null,\"error_description\":null,\"error_source\":null,\"error_step\":null,\"error_reason\":null,\"acquirer_data\":{\"transaction_id\":null},\"created_at\":1731674000}', 'SUCCESS', '2024-11-15 18:02:16', '2024-11-15 18:03:39', NULL),
(8261, 4, '73', 'order_PMkKrNNG86ZIYS', NULL, 'RAZORPAY', 8487.00, NULL, 'FAILED', '2024-11-18 16:40:24', '2024-11-18 16:40:25', NULL),
(8262, 4, '76', 'order_PMkWthDnUdQnFd', NULL, 'RAZORPAY', 8487.00, NULL, 'FAILED', '2024-11-18 16:51:48', '2024-11-18 16:51:48', NULL),
(8263, 4, '77', 'order_PMmlnSI5Y1piNX', NULL, 'RAZORPAY', 8487.00, NULL, 'FAILED', '2024-11-18 19:03:17', '2024-11-18 19:03:18', NULL),
(8264, 4, '78', 'order_PPUdA0pdsj9a3M', 'pay_PPUfkitn2Naim3', 'RAZORPAY', 2697.00, '{\"id\":\"pay_PPUfkitn2Naim3\",\"entity\":\"payment\",\"amount\":269700,\"currency\":\"INR\",\"status\":\"authorized\",\"order_id\":null,\"invoice_id\":null,\"international\":false,\"method\":\"netbanking\",\"amount_refunded\":0,\"refund_status\":null,\"captured\":false,\"description\":\"Test Transaction\",\"card_id\":null,\"bank\":\"BARB_R\",\"wallet\":null,\"vpa\":null,\"email\":\"saifuddin@example.com\",\"contact\":\"+919564779055\",\"notes\":{\"address\":\"Razorpay Corporate Office\"},\"fee\":null,\"tax\":null,\"error_code\":null,\"error_description\":null,\"error_source\":null,\"error_step\":null,\"error_reason\":null,\"acquirer_data\":{\"bank_transaction_id\":\"4518777\"},\"created_at\":1732528086}', 'SUCCESS', '2024-11-25 15:15:38', '2024-11-25 15:18:22', NULL),
(8265, 4, '81', 'order_PPWXmIy5CWUKv0', 'pay_PPWZEsVidI8NPT', 'RAZORPAY', 899.00, '{\"id\":\"pay_PPWZEsVidI8NPT\",\"entity\":\"payment\",\"amount\":89900,\"currency\":\"INR\",\"status\":\"authorized\",\"order_id\":null,\"invoice_id\":null,\"international\":false,\"method\":\"paylater\",\"amount_refunded\":0,\"refund_status\":null,\"captured\":false,\"description\":\"Test Transaction\",\"card_id\":null,\"bank\":null,\"wallet\":\"amazonpay\",\"vpa\":null,\"email\":\"saifuddin@example.com\",\"contact\":\"+919564779055\",\"notes\":{\"address\":\"Razorpay Corporate Office\"},\"fee\":null,\"tax\":null,\"error_code\":null,\"error_description\":null,\"error_source\":null,\"error_step\":null,\"error_reason\":null,\"acquirer_data\":{\"transaction_id\":null},\"created_at\":1732534760}', 'SUCCESS', '2024-11-25 17:07:55', '2024-11-25 17:09:31', NULL),
(8266, 4, '83', 'order_PPXLn0Fr77R51Z', NULL, 'RAZORPAY', 2697.00, NULL, 'FAILED', '2024-11-25 17:55:16', '2024-11-25 17:55:17', NULL),
(8267, 4, '84', 'order_PPXM499qPSbNm6', 'pay_PPXMSjjaFFlbsj', 'RAZORPAY', 2697.00, '{\"id\":\"pay_PPXMSjjaFFlbsj\",\"entity\":\"payment\",\"amount\":269700,\"currency\":\"INR\",\"status\":\"captured\",\"order_id\":\"order_PPXM499qPSbNm6\",\"invoice_id\":null,\"international\":false,\"method\":\"netbanking\",\"amount_refunded\":0,\"refund_status\":null,\"captured\":true,\"description\":\"Test Transaction\",\"card_id\":null,\"bank\":\"BARB_R\",\"wallet\":null,\"vpa\":null,\"email\":\"sohanikhatun4580@gmail.com\",\"contact\":\"+919564779055\",\"notes\":{\"notes_key_1\":8267,\"notes_key_2\":\"\",\"address\":\"Razorpay Corporate Office\"},\"fee\":6364,\"tax\":970,\"error_code\":null,\"error_description\":null,\"error_source\":null,\"error_step\":null,\"error_reason\":null,\"acquirer_data\":{\"bank_transaction_id\":\"3611934\"},\"created_at\":1732537555}', 'SUCCESS', '2024-11-25 17:55:32', '2024-11-25 17:56:17', NULL),
(8268, 4, '85', 'order_PPXRqGpWdeKKTo', 'pay_PPXSFupyR6NHYI', 'RAZORPAY', 8990.00, '{\"id\":\"pay_PPXSFupyR6NHYI\",\"entity\":\"payment\",\"amount\":899000,\"currency\":\"INR\",\"status\":\"captured\",\"order_id\":\"order_PPXRqGpWdeKKTo\",\"invoice_id\":null,\"international\":false,\"method\":\"netbanking\",\"amount_refunded\":0,\"refund_status\":null,\"captured\":true,\"description\":\"Test Transaction\",\"card_id\":null,\"bank\":\"BARB_R\",\"wallet\":null,\"vpa\":null,\"email\":\"sohanikhatun4580@gmail.com\",\"contact\":\"+919564779055\",\"notes\":{\"notes_key_1\":8268,\"notes_key_2\":\"\",\"address\":\"Razorpay Corporate Office\"},\"fee\":21216,\"tax\":3236,\"error_code\":null,\"error_description\":null,\"error_source\":null,\"error_step\":null,\"error_reason\":null,\"acquirer_data\":{\"bank_transaction_id\":\"4738425\"},\"created_at\":1732537884}', 'SUCCESS', '2024-11-25 18:01:00', '2024-11-25 18:02:14', NULL),
(8269, 4, '86', 'order_PPXXugTgo3EcUb', 'pay_PPXY18gHNuKXKT', 'RAZORPAY', 8990.00, '{\"id\":\"pay_PPXY18gHNuKXKT\",\"entity\":\"payment\",\"amount\":899000,\"currency\":\"INR\",\"status\":\"captured\",\"order_id\":\"order_PPXXugTgo3EcUb\",\"invoice_id\":null,\"international\":false,\"method\":\"netbanking\",\"amount_refunded\":0,\"refund_status\":null,\"captured\":true,\"description\":\"Test Transaction\",\"card_id\":null,\"bank\":\"BARB_R\",\"wallet\":null,\"vpa\":null,\"email\":\"sohanikhatun4580@gmail.com\",\"contact\":\"+919564779055\",\"notes\":{\"notes_key_1\":8269,\"notes_key_2\":\"\",\"address\":\"Razorpay Corporate Office\"},\"fee\":21216,\"tax\":3236,\"error_code\":null,\"error_description\":null,\"error_source\":null,\"error_step\":null,\"error_reason\":null,\"acquirer_data\":{\"bank_transaction_id\":\"9880845\"},\"created_at\":1732538212}', 'SUCCESS', '2024-11-25 18:06:45', '2024-11-25 18:07:08', NULL),
(8270, 4, '87', 'order_PPXZak5aj4zjCa', 'pay_PPXZq8owmVZus3', 'RAZORPAY', 8990.00, '{\"id\":\"pay_PPXZq8owmVZus3\",\"entity\":\"payment\",\"amount\":899000,\"currency\":\"INR\",\"status\":\"captured\",\"order_id\":\"order_PPXZak5aj4zjCa\",\"invoice_id\":null,\"international\":false,\"method\":\"netbanking\",\"amount_refunded\":0,\"refund_status\":null,\"captured\":true,\"description\":\"Test Transaction\",\"card_id\":null,\"bank\":\"BARB_R\",\"wallet\":null,\"vpa\":null,\"email\":\"sohanikhatun4580@gmail.com\",\"contact\":\"+919564779055\",\"notes\":{\"notes_key_1\":8270,\"notes_key_2\":\"\",\"address\":\"Razorpay Corporate Office\"},\"fee\":21216,\"tax\":3236,\"error_code\":null,\"error_description\":null,\"error_source\":null,\"error_step\":null,\"error_reason\":null,\"acquirer_data\":{\"bank_transaction_id\":\"6376439\"},\"created_at\":1732538315}', 'SUCCESS', '2024-11-25 18:08:21', '2024-11-25 18:08:58', NULL),
(8271, 4, '88', 'order_PPXeHRDUDjX6V4', 'pay_PPXeQxXBBHUoad', 'RAZORPAY', 8990.00, '{\"id\":\"pay_PPXeQxXBBHUoad\",\"entity\":\"payment\",\"amount\":899000,\"currency\":\"INR\",\"status\":\"captured\",\"order_id\":\"order_PPXeHRDUDjX6V4\",\"invoice_id\":null,\"international\":false,\"method\":\"netbanking\",\"amount_refunded\":0,\"refund_status\":null,\"captured\":true,\"description\":\"Test Transaction\",\"card_id\":null,\"bank\":\"BARB_R\",\"wallet\":null,\"vpa\":null,\"email\":\"sohanikhatun4580@gmail.com\",\"contact\":\"+919564779055\",\"notes\":{\"notes_key_1\":8271,\"notes_key_2\":\"\",\"address\":\"Razorpay Corporate Office\"},\"fee\":21216,\"tax\":3236,\"error_code\":null,\"error_description\":null,\"error_source\":null,\"error_step\":null,\"error_reason\":null,\"acquirer_data\":{\"bank_transaction_id\":\"9259625\"},\"created_at\":1732538576}', 'SUCCESS', '2024-11-25 18:12:46', '2024-11-25 18:13:20', NULL),
(8272, 4, '89', 'order_PoqySjAXYUfI8x', NULL, 'RAZORPAY', 1398.00, NULL, 'FAILED', '2025-01-28 17:22:06', '2025-01-28 17:22:07', NULL),
(8273, 4, '90', 'order_Poqyo1GrbFkJ1D', NULL, 'RAZORPAY', 1498.00, NULL, 'FAILED', '2025-01-28 17:22:26', '2025-01-28 17:22:26', NULL),
(8274, 4, '91', 'order_Ps2tSsR23I2tkj', NULL, 'RAZORPAY', 2397.00, NULL, 'FAILED', '2025-02-05 18:58:42', '2025-02-05 18:58:43', NULL),
(8275, 14, '92', 'order_Puiens73GoI2Rs', 'pay_PuihrgV3a49kDx', 'RAZORPAY', 2397.00, '{\"id\":\"pay_PuihrgV3a49kDx\",\"entity\":\"payment\",\"amount\":239700,\"currency\":\"INR\",\"status\":\"captured\",\"order_id\":\"order_Puiens73GoI2Rs\",\"invoice_id\":null,\"international\":false,\"method\":\"wallet\",\"amount_refunded\":0,\"refund_status\":null,\"captured\":true,\"description\":null,\"card_id\":null,\"bank\":null,\"wallet\":\"freecharge\",\"vpa\":null,\"email\":\"josef@gmail.com\",\"contact\":\"+919834123659\",\"notes\":{\"notes_key_1\":8275,\"notes_key_2\":\"\"},\"fee\":5656,\"tax\":862,\"error_code\":null,\"error_description\":null,\"error_source\":null,\"error_step\":null,\"error_reason\":null,\"acquirer_data\":{\"transaction_id\":null},\"created_at\":1739346052}', 'SUCCESS', '2025-02-12 13:07:57', '2025-02-12 13:11:12', NULL),
(8276, 4, '93', 'order_PvUOtToQRpAgag', NULL, 'RAZORPAY', 499.00, NULL, 'FAILED', '2025-02-14 11:50:11', '2025-02-14 11:50:12', NULL),
(8277, 4, '94', 'order_PvalfmrUm7w0Ya', NULL, 'RAZORPAY', 1997.00, NULL, 'FAILED', '2025-02-14 18:03:54', '2025-02-14 18:03:55', NULL),
(8278, 4, '94', 'order_Pvanm3tW0F7jhD', NULL, 'RAZORPAY', 1997.00, NULL, 'FAILED', '2025-02-14 18:05:55', '2025-02-14 18:05:55', NULL),
(8279, 4, '95', 'order_Q1qcPevb1BNPw1', NULL, 'RAZORPAY', 1398.00, NULL, 'FAILED', '2025-03-02 13:28:15', '2025-03-02 13:28:16', NULL),
(8280, 4, '96', 'order_Q1qowB6ebcSK4N', 'pay_Q1qpNTms2RBBhX', 'RAZORPAY', 1398.00, '{\"id\":\"pay_Q1qpNTms2RBBhX\",\"entity\":\"payment\",\"amount\":139800,\"currency\":\"INR\",\"status\":\"captured\",\"order_id\":\"order_Q1qowB6ebcSK4N\",\"invoice_id\":null,\"international\":false,\"method\":\"wallet\",\"amount_refunded\":0,\"refund_status\":null,\"captured\":true,\"description\":null,\"card_id\":null,\"bank\":null,\"wallet\":\"freecharge\",\"vpa\":null,\"email\":\"josef@gmail.com\",\"contact\":\"+919836563656\",\"notes\":{\"notes_key_1\":8280,\"notes_key_2\":\"\"},\"fee\":3300,\"tax\":504,\"error_code\":null,\"error_description\":null,\"error_source\":null,\"error_step\":null,\"error_reason\":null,\"acquirer_data\":{\"transaction_id\":null},\"created_at\":1740903033}', 'SUCCESS', '2025-03-02 13:40:07', '2025-03-02 13:40:51', NULL),
(8281, 4, '97', 'order_Q5SPukg7OO9vxZ', NULL, 'RAZORPAY', 3196.00, NULL, 'FAILED', '2025-03-11 16:23:47', '2025-03-11 16:23:48', NULL),
(8282, 4, '98', 'order_Q5SQq5Bw15gx1D', 'pay_Q5SSi1CS8E4FZ5', 'RAZORPAY', 3196.00, '{\"id\":\"pay_Q5SSi1CS8E4FZ5\",\"entity\":\"payment\",\"amount\":319600,\"currency\":\"INR\",\"status\":\"captured\",\"order_id\":\"order_Q5SQq5Bw15gx1D\",\"invoice_id\":null,\"international\":false,\"method\":\"card\",\"amount_refunded\":0,\"refund_status\":null,\"captured\":true,\"description\":\"Test Transaction\",\"card_id\":\"card_Q5SSiDvVZBkBiy\",\"card\":{\"id\":\"card_Q5SSiDvVZBkBiy\",\"entity\":\"card\",\"name\":\"\",\"last4\":\"5449\",\"network\":\"MasterCard\",\"type\":\"credit\",\"issuer\":\"UTIB\",\"international\":false,\"emi\":false,\"sub_type\":\"consumer\",\"token_iin\":null},\"bank\":null,\"wallet\":null,\"vpa\":null,\"email\":\"saifuddin@example.com\",\"contact\":\"+919564779055\",\"token_id\":\"token_Q5SSiV2hQX51Q3\",\"notes\":{\"notes_key_1\":8282,\"notes_key_2\":\"\",\"address\":\"Razorpay Corporate Office\"},\"fee\":7542,\"tax\":1150,\"error_code\":null,\"error_description\":null,\"error_source\":null,\"error_step\":null,\"error_reason\":null,\"acquirer_data\":{\"auth_code\":\"311057\"},\"created_at\":1741690587}', 'SUCCESS', '2025-03-11 16:24:41', '2025-03-11 16:26:47', NULL),
(8283, 4, '100', 'order_QGrCaZuSCehXGW', NULL, 'RAZORPAY', 101.00, NULL, 'FAILED', '2025-04-09 11:47:27', '2025-04-09 11:47:28', NULL),
(8284, 4, '101', 'order_QSojQpTaJEnV8K', NULL, 'RAZORPAY', 899.00, NULL, 'FAILED', '2025-05-09 17:10:36', '2025-05-09 17:10:37', NULL),
(8285, 6, '102', 'order_QU2JCpu9ZmnZUS', NULL, 'RAZORPAY', 12285.00, NULL, 'FAILED', '2025-05-12 19:06:30', '2025-05-12 19:06:31', NULL),
(8286, 4, '108', 'order_QWnGXdyoEC8BeP', NULL, 'RAZORPAY', 202.00, NULL, 'FAILED', '2025-05-19 18:20:36', '2025-05-19 18:20:37', NULL),
(8287, 4, '109', 'order_QWnGbkn8yvXCZ1', 'pay_QWnH0UKJGPj0TN', 'RAZORPAY', 202.00, '{\"id\":\"pay_QWnH0UKJGPj0TN\",\"entity\":\"payment\",\"amount\":20200,\"currency\":\"INR\",\"status\":\"captured\",\"order_id\":\"order_QWnGbkn8yvXCZ1\",\"invoice_id\":null,\"international\":false,\"method\":\"netbanking\",\"amount_refunded\":0,\"refund_status\":null,\"captured\":true,\"description\":\"Test Transaction\",\"card_id\":null,\"bank\":\"BARB_R\",\"wallet\":null,\"vpa\":null,\"email\":\"saifuddin@example.com\",\"contact\":\"+919564779055\",\"notes\":{\"notes_key_1\":8287,\"notes_key_2\":\"\",\"address\":\"Razorpay Corporate Office\"},\"fee\":476,\"tax\":72,\"error_code\":null,\"error_description\":null,\"error_source\":null,\"error_step\":null,\"error_reason\":null,\"acquirer_data\":{\"bank_transaction_id\":\"7005956\"},\"created_at\":1747659059}', 'SUCCESS', '2025-05-19 18:20:41', '2025-05-19 18:21:21', NULL),
(8288, 4, '110', 'order_QWo7hvIqumuVNB', NULL, 'RAZORPAY', 101.00, NULL, 'FAILED', '2025-05-19 19:10:56', '2025-05-19 19:10:57', NULL),
(8289, 6, '111', 'order_QXu86Bz7noiPmc', NULL, 'RAZORPAY', 4995.00, NULL, 'FAILED', '2025-05-22 13:42:29', '2025-05-22 13:42:30', NULL),
(8290, 29, '112', 'order_Qb35bLAiiCDDcH', 'pay_Qb39vMWwKnCDbB', 'RAZORPAY', 200.00, '{\"id\":\"pay_Qb39vMWwKnCDbB\",\"entity\":\"payment\",\"amount\":20000,\"currency\":\"INR\",\"status\":\"captured\",\"order_id\":\"order_Qb35bLAiiCDDcH\",\"invoice_id\":null,\"international\":false,\"method\":\"card\",\"amount_refunded\":0,\"refund_status\":null,\"captured\":true,\"description\":\"Test Transaction\",\"card_id\":\"card_Qb39vbzWDb9C5k\",\"card\":{\"id\":\"card_Qb39vbzWDb9C5k\",\"entity\":\"card\",\"name\":\"\",\"last4\":\"5449\",\"network\":\"MasterCard\",\"type\":\"credit\",\"issuer\":\"UTIB\",\"international\":false,\"emi\":false,\"sub_type\":\"consumer\",\"token_iin\":null},\"bank\":null,\"wallet\":null,\"vpa\":null,\"email\":\"saifuddin@example.com\",\"contact\":\"+919564779055\",\"notes\":{\"notes_key_1\":8290,\"notes_key_2\":\"\",\"address\":\"Razorpay Corporate Office\"},\"fee\":400,\"tax\":0,\"error_code\":null,\"error_description\":null,\"error_source\":null,\"error_step\":null,\"error_reason\":null,\"acquirer_data\":{\"auth_code\":\"141213\"},\"created_at\":1748588363}', 'SUCCESS', '2025-05-30 12:25:15', '2025-05-30 12:29:42', NULL),
(8291, 4, '113', 'order_Qfn25NXttmq5Ky', NULL, 'RAZORPAY', 10.00, NULL, 'FAILED', '2025-06-11 11:57:51', '2025-06-11 11:57:52', NULL),
(8292, 4, '114', 'order_Qfn34mGuEgBQkR', 'pay_Qfn5hXg0FzSFED', 'RAZORPAY', 1.00, '{\"id\":\"pay_Qfn5hXg0FzSFED\",\"entity\":\"payment\",\"amount\":100,\"currency\":\"INR\",\"status\":\"captured\",\"order_id\":\"order_Qfn34mGuEgBQkR\",\"invoice_id\":null,\"international\":false,\"method\":\"upi\",\"amount_refunded\":0,\"refund_status\":null,\"captured\":true,\"description\":\"Test Transaction\",\"card_id\":null,\"bank\":null,\"wallet\":null,\"vpa\":\"surajithal@axl\",\"email\":\"saifuddin@example.com\",\"contact\":\"+919564779055\",\"notes\":{\"notes_key_1\":8292,\"notes_key_2\":\"\",\"address\":\"Razorpay Corporate Office\"},\"fee\":2,\"tax\":0,\"error_code\":null,\"error_description\":null,\"error_source\":null,\"error_step\":null,\"error_reason\":null,\"acquirer_data\":{\"rrn\":\"983446176357\",\"upi_transaction_id\":\"A46353EBC694946B50C3471C7DCBB3D7\"},\"created_at\":1749623478,\"upi\":{\"vpa\":\"surajithal@axl\"}}', 'SUCCESS', '2025-06-11 11:58:48', '2025-06-11 12:01:33', NULL),
(8293, 4, '115', 'order_QfnatrJ2iUyi0U', NULL, 'RAZORPAY', 2740.00, NULL, 'FAILED', '2025-06-11 12:30:48', '2025-06-11 12:30:49', NULL),
(8294, 4, '116', 'order_QftZYjmV7KNU8R', NULL, 'RAZORPAY', 2740.00, NULL, 'FAILED', '2025-06-11 18:21:42', '2025-06-11 18:21:43', NULL),
(8295, 4, '117', 'order_QgDEtnnAh6f3wk', 'pay_QgDFnnBl94CIH9', 'RAZORPAY', 2795.00, '{\"id\":\"pay_QgDFnnBl94CIH9\",\"entity\":\"payment\",\"amount\":279500,\"currency\":\"INR\",\"status\":\"captured\",\"order_id\":\"order_QgDEtnnAh6f3wk\",\"invoice_id\":null,\"international\":false,\"method\":\"card\",\"amount_refunded\":0,\"refund_status\":null,\"captured\":true,\"description\":\"Test Transaction\",\"card_id\":\"card_QgDFo4ISObBpdH\",\"card\":{\"id\":\"card_QgDFo4ISObBpdH\",\"entity\":\"card\",\"name\":\"\",\"last4\":\"5449\",\"network\":\"MasterCard\",\"type\":\"credit\",\"issuer\":\"UTIB\",\"international\":false,\"emi\":false,\"sub_type\":\"consumer\",\"token_iin\":null},\"bank\":null,\"wallet\":null,\"vpa\":null,\"email\":\"saifuddin@example.com\",\"contact\":\"+919564779055\",\"notes\":{\"notes_key_1\":8295,\"notes_key_2\":\"\",\"address\":\"Razorpay Corporate Office\"},\"fee\":6596,\"tax\":1006,\"error_code\":null,\"error_description\":null,\"error_source\":null,\"error_step\":null,\"error_reason\":null,\"acquirer_data\":{\"auth_code\":\"267123\"},\"created_at\":1749715614}', 'SUCCESS', '2025-06-12 13:36:00', '2025-06-12 13:37:13', NULL),
(8296, 4, '118', 'order_QgDICdquTrByjq', 'pay_QgDIaX90vTzEgY', 'RAZORPAY', 2796.00, '{\"id\":\"pay_QgDIaX90vTzEgY\",\"entity\":\"payment\",\"amount\":279600,\"currency\":\"INR\",\"status\":\"captured\",\"order_id\":\"order_QgDICdquTrByjq\",\"invoice_id\":null,\"international\":false,\"method\":\"card\",\"amount_refunded\":0,\"refund_status\":null,\"captured\":true,\"description\":\"Test Transaction\",\"card_id\":\"card_QgDIam8mrd5e0f\",\"card\":{\"id\":\"card_QgDIam8mrd5e0f\",\"entity\":\"card\",\"name\":\"\",\"last4\":\"5449\",\"network\":\"MasterCard\",\"type\":\"credit\",\"issuer\":\"UTIB\",\"international\":false,\"emi\":false,\"sub_type\":\"consumer\",\"token_iin\":null},\"bank\":null,\"wallet\":null,\"vpa\":null,\"email\":\"saifuddin@example.com\",\"contact\":\"+919564779055\",\"notes\":{\"notes_key_1\":8296,\"notes_key_2\":\"\",\"address\":\"Razorpay Corporate Office\"},\"fee\":6598,\"tax\":1006,\"error_code\":null,\"error_description\":null,\"error_source\":null,\"error_step\":null,\"error_reason\":null,\"acquirer_data\":{\"auth_code\":\"700246\"},\"created_at\":1749715772}', 'SUCCESS', '2025-06-12 13:39:09', '2025-06-12 13:39:51', NULL),
(8297, 42, '123', 'order_QgEQHrruKHJnXw', 'pay_QgEQyJ41n33DVE', 'RAZORPAY', 45.00, '{\"id\":\"pay_QgEQyJ41n33DVE\",\"entity\":\"payment\",\"amount\":4500,\"currency\":\"INR\",\"status\":\"captured\",\"order_id\":\"order_QgEQHrruKHJnXw\",\"invoice_id\":null,\"international\":false,\"method\":\"card\",\"amount_refunded\":0,\"refund_status\":null,\"captured\":true,\"description\":\"Payment for your order\",\"card_id\":\"card_QgEQyYR57gQLvX\",\"card\":{\"id\":\"card_QgEQyYR57gQLvX\",\"entity\":\"card\",\"name\":\"\",\"last4\":\"1111\",\"network\":\"Visa\",\"type\":\"prepaid\",\"issuer\":null,\"international\":false,\"emi\":false,\"sub_type\":\"consumer\",\"token_iin\":null},\"bank\":null,\"wallet\":null,\"vpa\":null,\"email\":\"mukeshcivil0565@gmail.com\",\"contact\":\"+918909092987\",\"notes\":{\"notes_key_1\":8297,\"notes_key_2\":\"\"},\"fee\":90,\"tax\":0,\"error_code\":null,\"error_description\":null,\"error_source\":null,\"error_step\":null,\"error_reason\":null,\"acquirer_data\":{\"auth_code\":\"358008\"},\"created_at\":1749719770}', 'SUCCESS', '2025-06-12 14:45:29', '2025-06-12 14:46:40', NULL),
(8298, 42, '124', 'order_QgEUPajvuIhxkl', 'pay_QgEV0F3uoNJKMl', 'RAZORPAY', 45.00, '{\"id\":\"pay_QgEV0F3uoNJKMl\",\"entity\":\"payment\",\"amount\":4500,\"currency\":\"INR\",\"status\":\"captured\",\"order_id\":\"order_QgEUPajvuIhxkl\",\"invoice_id\":null,\"international\":false,\"method\":\"card\",\"amount_refunded\":0,\"refund_status\":null,\"captured\":true,\"description\":\"Payment for your order\",\"card_id\":\"card_QgEV0UOm91SXi7\",\"card\":{\"id\":\"card_QgEV0UOm91SXi7\",\"entity\":\"card\",\"name\":\"\",\"last4\":\"1111\",\"network\":\"Visa\",\"type\":\"prepaid\",\"issuer\":null,\"international\":false,\"emi\":false,\"sub_type\":\"consumer\",\"token_iin\":null},\"bank\":null,\"wallet\":null,\"vpa\":null,\"email\":\"mukeshcivil0565@gmail.com\",\"contact\":\"+918909092987\",\"notes\":{\"notes_key_1\":8298,\"notes_key_2\":\"\"},\"fee\":90,\"tax\":0,\"error_code\":null,\"error_description\":null,\"error_source\":null,\"error_step\":null,\"error_reason\":null,\"acquirer_data\":{\"auth_code\":\"744279\"},\"created_at\":1749719999}', 'SUCCESS', '2025-06-12 14:49:24', '2025-06-12 14:50:28', NULL),
(8299, 42, '126', 'order_QgF5ODQwMRIU0d', 'pay_QgF6EYZHyYWSWz', 'RAZORPAY', 45.00, '{\"id\":\"pay_QgF6EYZHyYWSWz\",\"entity\":\"payment\",\"amount\":4500,\"currency\":\"INR\",\"status\":\"captured\",\"order_id\":\"order_QgF5ODQwMRIU0d\",\"invoice_id\":null,\"international\":false,\"method\":\"card\",\"amount_refunded\":0,\"refund_status\":null,\"captured\":true,\"description\":\"Payment for your order\",\"card_id\":\"card_QgF6FmchbDgFl7\",\"card\":{\"id\":\"card_QgF6FmchbDgFl7\",\"entity\":\"card\",\"name\":\"\",\"last4\":\"1111\",\"network\":\"Visa\",\"type\":\"prepaid\",\"issuer\":null,\"international\":false,\"emi\":false,\"sub_type\":\"consumer\",\"token_iin\":null},\"bank\":null,\"wallet\":null,\"vpa\":null,\"email\":\"mukeshcivil0565@gmail.com\",\"contact\":\"+918100098024\",\"notes\":{\"notes_key_1\":8299,\"notes_key_2\":\"\"},\"fee\":90,\"tax\":0,\"error_code\":null,\"error_description\":null,\"error_source\":null,\"error_step\":null,\"error_reason\":null,\"acquirer_data\":{\"auth_code\":\"896949\"},\"created_at\":1749722115}', 'SUCCESS', '2025-06-12 15:24:23', '2025-06-12 15:25:38', NULL),
(8300, 4, '127', 'order_QgFLlCHZBGY64M', 'pay_QgFM0KLNQUULtG', 'RAZORPAY', 1.00, '{\"id\":\"pay_QgFM0KLNQUULtG\",\"entity\":\"payment\",\"amount\":100,\"currency\":\"INR\",\"status\":\"captured\",\"order_id\":\"order_QgFLlCHZBGY64M\",\"invoice_id\":null,\"international\":false,\"method\":\"upi\",\"amount_refunded\":0,\"refund_status\":null,\"captured\":true,\"description\":\"Test Transaction\",\"card_id\":null,\"bank\":null,\"wallet\":null,\"vpa\":\"surajithal@axl\",\"email\":\"saifuddin@example.com\",\"contact\":\"+919564779055\",\"notes\":{\"notes_key_1\":8300,\"notes_key_2\":\"\",\"address\":\"Razorpay Corporate Office\"},\"fee\":2,\"tax\":0,\"error_code\":null,\"error_description\":null,\"error_source\":null,\"error_step\":null,\"error_reason\":null,\"acquirer_data\":{\"rrn\":\"522702136433\",\"upi_transaction_id\":\"0B992DA44B3753247707F716DF1E0287\"},\"created_at\":1749723009,\"upi\":{\"vpa\":\"surajithal@axl\"}}', 'SUCCESS', '2025-06-12 15:39:54', '2025-06-12 15:40:25', NULL),
(8301, 42, '128', 'order_QgFbj2fBwpJXq9', 'pay_QgFcHfCXHv2yTU', 'RAZORPAY', 1990.00, '{\"id\":\"pay_QgFcHfCXHv2yTU\",\"entity\":\"payment\",\"amount\":199000,\"currency\":\"INR\",\"status\":\"captured\",\"order_id\":\"order_QgFbj2fBwpJXq9\",\"invoice_id\":null,\"international\":false,\"method\":\"card\",\"amount_refunded\":0,\"refund_status\":null,\"captured\":true,\"description\":\"Payment for your order\",\"card_id\":\"card_QgFcHsry0IH8Ca\",\"card\":{\"id\":\"card_QgFcHsry0IH8Ca\",\"entity\":\"card\",\"name\":\"\",\"last4\":\"1111\",\"network\":\"Visa\",\"type\":\"prepaid\",\"issuer\":null,\"international\":false,\"emi\":false,\"sub_type\":\"consumer\",\"token_iin\":null},\"bank\":null,\"wallet\":null,\"vpa\":null,\"email\":\"mukeshcivil0565@gmail.com\",\"contact\":\"+918100098024\",\"notes\":{\"notes_key_1\":8301,\"notes_key_2\":\"\"},\"fee\":3980,\"tax\":0,\"error_code\":null,\"error_description\":null,\"error_source\":null,\"error_step\":null,\"error_reason\":null,\"acquirer_data\":{\"auth_code\":\"913380\"},\"created_at\":1749723934}', 'SUCCESS', '2025-06-12 15:55:00', '2025-06-12 15:57:07', NULL),
(8302, 6, '130', 'order_QgGTxVIsvnnahV', NULL, 'RAZORPAY', 60.00, NULL, 'FAILED', '2025-06-12 16:46:21', '2025-06-12 16:46:22', NULL),
(8303, 6, '131', 'order_QgGUXSMNDvyNcW', 'pay_QgGVR4AndHBtZU', 'RAZORPAY', 60.00, '{\"id\":\"pay_QgGVR4AndHBtZU\",\"entity\":\"payment\",\"amount\":6000,\"currency\":\"INR\",\"status\":\"captured\",\"order_id\":\"order_QgGVEyrxYidlFp\",\"invoice_id\":null,\"international\":false,\"method\":\"upi\",\"amount_refunded\":0,\"refund_status\":null,\"captured\":true,\"description\":\"Payment for your order\",\"card_id\":null,\"bank\":null,\"wallet\":null,\"vpa\":\"success@razorpay\",\"email\":\"void@razorpay.com\",\"contact\":\"+918100098024\",\"notes\":{\"notes_key_1\":8304,\"notes_key_2\":\"\"},\"fee\":142,\"tax\":22,\"error_code\":null,\"error_description\":null,\"error_source\":null,\"error_step\":null,\"error_reason\":null,\"acquirer_data\":{\"rrn\":\"824348907598\",\"upi_transaction_id\":\"4EC0165A4AC26321612BE45E7A280C8A\"},\"created_at\":1749727066,\"upi\":{\"vpa\":\"success@razorpay\"}}', 'SUCCESS', '2025-06-12 16:46:55', '2025-06-12 16:48:51', NULL),
(8304, 6, '131', 'order_QgGVEyrxYidlFp', NULL, 'RAZORPAY', 60.00, NULL, 'FAILED', '2025-06-12 16:47:34', '2025-06-12 16:47:35', NULL),
(8305, 42, '132', 'order_QgGjN0GgXLHwsH', NULL, 'RAZORPAY', 155.00, NULL, 'FAILED', '2025-06-12 17:00:57', '2025-06-12 17:00:57', NULL),
(8306, 42, '134', 'order_QgGlcs01Dey49U', NULL, 'RAZORPAY', 155.00, NULL, 'FAILED', '2025-06-12 17:03:04', '2025-06-12 17:03:05', NULL),
(8307, 42, '136', 'order_QgGnH3er1Km8dC', NULL, 'RAZORPAY', 155.00, NULL, 'FAILED', '2025-06-12 17:04:39', '2025-06-12 17:04:39', NULL),
(8308, 42, '139', 'order_QgGoG86vzuEPq1', NULL, 'RAZORPAY', 155.00, NULL, 'FAILED', '2025-06-12 17:05:35', '2025-06-12 17:05:35', NULL),
(8309, 42, '139', 'order_QgGp9JHEQEOJ7h', NULL, 'RAZORPAY', 155.00, NULL, 'FAILED', '2025-06-12 17:06:25', '2025-06-12 17:06:25', NULL),
(8310, 42, '140', 'order_QgGpd6YjdwrZC2', NULL, 'RAZORPAY', 155.00, NULL, 'FAILED', '2025-06-12 17:06:53', '2025-06-12 17:06:53', NULL),
(8311, 42, '141', 'order_QgGqOXdJWULeyJ', NULL, 'RAZORPAY', 155.00, NULL, 'FAILED', '2025-06-12 17:07:36', '2025-06-12 17:07:36', NULL),
(8312, 42, '143', 'order_QgHDm80sLMgJFl', NULL, 'RAZORPAY', 155.00, NULL, 'FAILED', '2025-06-12 17:29:43', '2025-06-12 17:29:44', NULL),
(8313, 42, '145', 'order_QgHI2KetoSVJlX', NULL, 'RAZORPAY', 155.00, NULL, 'FAILED', '2025-06-12 17:33:46', '2025-06-12 17:33:46', NULL),
(8314, 42, '148', 'order_QgHP1jmTcrHKVW', NULL, 'RAZORPAY', 60.00, NULL, 'FAILED', '2025-06-12 17:40:23', '2025-06-12 17:40:23', NULL),
(8315, 42, '150', 'order_Qgc6NpfA3Lb1QZ', NULL, 'RAZORPAY', 180.00, NULL, 'FAILED', '2025-06-13 13:55:17', '2025-06-13 13:55:18', NULL),
(8316, 42, '151', 'order_QgcFtSEA7q3zSb', NULL, 'RAZORPAY', 180.00, NULL, 'FAILED', '2025-06-13 14:04:18', '2025-06-13 14:04:18', NULL),
(8317, 42, '154', 'order_QgcOPcwieVR3ls', NULL, 'RAZORPAY', 180.00, NULL, 'FAILED', '2025-06-13 14:12:21', '2025-06-13 14:12:22', NULL),
(8318, 42, '156', 'order_QgdutgJEvsK5fS', NULL, 'RAZORPAY', 180.00, NULL, 'FAILED', '2025-06-13 15:41:48', '2025-06-13 15:41:49', NULL),
(8319, 42, '156', 'order_Qge3B4H94T5xwL', NULL, 'RAZORPAY', 180.00, NULL, 'FAILED', '2025-06-13 15:49:39', '2025-06-13 15:49:39', NULL),
(8320, 42, '160', 'order_QgeB5dwsJU8EXp', NULL, 'RAZORPAY', 180.00, NULL, 'FAILED', '2025-06-13 15:57:09', '2025-06-13 15:57:09', NULL),
(8321, 42, '162', 'order_QgeMFpK9ZpAT7n', NULL, 'RAZORPAY', 180.00, NULL, 'FAILED', '2025-06-13 16:07:42', '2025-06-13 16:07:43', NULL),
(8322, 42, '165', 'order_QgeixsX3plhSaY', NULL, 'RAZORPAY', 180.00, NULL, 'FAILED', '2025-06-13 16:29:12', '2025-06-13 16:29:13', NULL),
(8323, 42, '166', 'order_QgelocOqQEsaCq', 'pay_QgemhFfXTupZhP', 'RAZORPAY', 180.00, '{\"id\":\"pay_QgemhFfXTupZhP\",\"entity\":\"payment\",\"amount\":18000,\"currency\":\"INR\",\"status\":\"captured\",\"order_id\":\"order_QgelocOqQEsaCq\",\"invoice_id\":null,\"international\":false,\"method\":\"card\",\"amount_refunded\":0,\"refund_status\":null,\"captured\":true,\"description\":\"Payment for order #166\",\"card_id\":\"card_QgemhUAVAmECib\",\"card\":{\"id\":\"card_QgemhUAVAmECib\",\"entity\":\"card\",\"name\":\"\",\"last4\":\"1111\",\"network\":\"Visa\",\"type\":\"prepaid\",\"issuer\":null,\"international\":false,\"emi\":false,\"sub_type\":\"consumer\",\"token_iin\":null},\"bank\":null,\"wallet\":null,\"vpa\":null,\"email\":\"mukeshcivil0565@gmail.com\",\"contact\":\"+918909092987\",\"notes\":{\"notes_key_1\":8323,\"notes_key_2\":\"\"},\"fee\":360,\"tax\":0,\"error_code\":null,\"error_description\":null,\"error_source\":null,\"error_step\":null,\"error_reason\":null,\"acquirer_data\":{\"auth_code\":\"289346\"},\"created_at\":1749812566}', 'SUCCESS', '2025-06-13 16:31:55', '2025-06-13 16:33:09', NULL),
(8324, 4, '169', 'order_QhlB3qdSFQwjuo', 'pay_QhlD8g1mTUlxel', 'RAZORPAY', 320.00, '{\"id\":\"pay_QhlD8g1mTUlxel\",\"entity\":\"payment\",\"amount\":32000,\"currency\":\"INR\",\"status\":\"captured\",\"order_id\":\"order_QhlB3qdSFQwjuo\",\"invoice_id\":null,\"international\":false,\"method\":\"card\",\"amount_refunded\":0,\"refund_status\":null,\"captured\":true,\"description\":\"Test Transaction\",\"card_id\":\"card_QhlD8teDnSrujm\",\"card\":{\"id\":\"card_QhlD8teDnSrujm\",\"entity\":\"card\",\"name\":\"\",\"last4\":\"5449\",\"network\":\"MasterCard\",\"type\":\"credit\",\"issuer\":\"UTIB\",\"international\":false,\"emi\":false,\"sub_type\":\"consumer\",\"token_iin\":null},\"bank\":null,\"wallet\":null,\"vpa\":null,\"email\":\"saifuddin@example.com\",\"contact\":\"+919564779055\",\"notes\":{\"notes_key_1\":8324,\"notes_key_2\":\"\",\"address\":\"Razorpay Corporate Office\"},\"fee\":640,\"tax\":0,\"error_code\":null,\"error_description\":null,\"error_source\":null,\"error_step\":null,\"error_reason\":null,\"acquirer_data\":{\"auth_code\":\"926659\"},\"created_at\":1750053538}', 'SUCCESS', '2025-06-16 11:26:57', '2025-06-16 11:29:22', NULL),
(8325, 4, '174', 'order_QhqREWPS6JvOsD', 'pay_QhqRUsPFI3Z9LF', 'RAZORPAY', 170.00, '{\"id\":\"pay_QhqRUsPFI3Z9LF\",\"entity\":\"payment\",\"amount\":17000,\"currency\":\"INR\",\"status\":\"captured\",\"order_id\":\"order_QhqREWPS6JvOsD\",\"invoice_id\":null,\"international\":false,\"method\":\"upi\",\"amount_refunded\":0,\"refund_status\":null,\"captured\":true,\"description\":\"Test Transaction\",\"card_id\":null,\"bank\":null,\"wallet\":null,\"vpa\":\"abc@axl\",\"email\":\"saifuddin@example.com\",\"contact\":\"+919564779055\",\"notes\":{\"notes_key_1\":8325,\"notes_key_2\":\"\",\"address\":\"Razorpay Corporate Office\"},\"fee\":402,\"tax\":62,\"error_code\":null,\"error_description\":null,\"error_source\":null,\"error_step\":null,\"error_reason\":null,\"acquirer_data\":{\"rrn\":\"610041469081\",\"upi_transaction_id\":\"F8299933633739FF73B0724B377C8766\"},\"created_at\":1750071961,\"upi\":{\"vpa\":\"abc@axl\"}}', 'SUCCESS', '2025-06-16 16:35:44', '2025-06-16 16:36:17', NULL),
(8326, 4, '175', 'order_QhqsYyrrYNZjQx', 'pay_QhqsuQ37pswD7u', 'RAZORPAY', 120.00, '{\"id\":\"pay_QhqsuQ37pswD7u\",\"entity\":\"payment\",\"amount\":12000,\"currency\":\"INR\",\"status\":\"captured\",\"order_id\":\"order_QhqsYyrrYNZjQx\",\"invoice_id\":null,\"international\":false,\"method\":\"upi\",\"amount_refunded\":0,\"refund_status\":null,\"captured\":true,\"description\":\"Test Transaction\",\"card_id\":null,\"bank\":null,\"wallet\":null,\"vpa\":\"asd@axl\",\"email\":\"saifuddin@example.com\",\"contact\":\"+919564779055\",\"notes\":{\"notes_key_1\":8326,\"notes_key_2\":\"\",\"address\":\"Razorpay Corporate Office\"},\"fee\":284,\"tax\":44,\"error_code\":null,\"error_description\":null,\"error_source\":null,\"error_step\":null,\"error_reason\":null,\"acquirer_data\":{\"rrn\":\"465599907700\",\"upi_transaction_id\":\"2D6C579406E6D7E4370295906C3521A9\"},\"created_at\":1750073518,\"upi\":{\"vpa\":\"asd@axl\"}}', 'SUCCESS', '2025-06-16 17:01:36', '2025-06-16 17:02:14', NULL),
(8327, 4, '177', 'order_QhrtcFgrPGgGRG', 'pay_Qhrtq6VLKUifRA', 'RAZORPAY', 80.00, '{\"id\":\"pay_Qhrtq6VLKUifRA\",\"entity\":\"payment\",\"amount\":8000,\"currency\":\"INR\",\"status\":\"captured\",\"order_id\":\"order_QhrtcFgrPGgGRG\",\"invoice_id\":null,\"international\":false,\"method\":\"upi\",\"amount_refunded\":0,\"refund_status\":null,\"captured\":true,\"description\":\"Test Transaction\",\"card_id\":null,\"bank\":null,\"wallet\":null,\"vpa\":\"adc@axl\",\"email\":\"saifuddin@example.com\",\"contact\":\"+919564779055\",\"notes\":{\"notes_key_1\":8327,\"notes_key_2\":\"\",\"address\":\"Razorpay Corporate Office\"},\"fee\":188,\"tax\":28,\"error_code\":null,\"error_description\":null,\"error_source\":null,\"error_step\":null,\"error_reason\":null,\"acquirer_data\":{\"rrn\":\"721321619585\",\"upi_transaction_id\":\"4B7670E51BCD852FF4E05481CCB82BAC\"},\"created_at\":1750077092,\"upi\":{\"vpa\":\"adc@axl\"}}', 'SUCCESS', '2025-06-16 18:01:18', '2025-06-16 18:01:48', NULL),
(8328, 42, '180', 'order_QhvGif0xOrR0LK', NULL, 'RAZORPAY', 90.00, NULL, 'FAILED', '2025-06-16 21:19:15', '2025-06-16 21:19:16', NULL),
(8329, 42, '181', 'order_Qi9UkolvYrHXsF', NULL, 'RAZORPAY', 60.00, NULL, 'FAILED', '2025-06-17 11:14:15', '2025-06-17 11:14:16', NULL),
(8330, 4, '189', 'order_QidjiObKhGeIv1', 'pay_QidjxBSo3Grkbx', 'RAZORPAY', 200.00, '{\"id\":\"pay_QidjxBSo3Grkbx\",\"entity\":\"payment\",\"amount\":20000,\"currency\":\"INR\",\"status\":\"captured\",\"order_id\":\"order_QidjiObKhGeIv1\",\"invoice_id\":null,\"international\":false,\"method\":\"upi\",\"amount_refunded\":0,\"refund_status\":null,\"captured\":true,\"description\":\"Test Transaction\",\"card_id\":null,\"bank\":null,\"wallet\":null,\"vpa\":\"drt@axl\",\"email\":\"saifuddin@example.com\",\"contact\":\"+919564779055\",\"notes\":{\"notes_key_1\":8330,\"notes_key_2\":\"\",\"address\":\"Razorpay Corporate Office\"},\"fee\":472,\"tax\":72,\"error_code\":null,\"error_description\":null,\"error_source\":null,\"error_step\":null,\"error_reason\":null,\"acquirer_data\":{\"rrn\":\"111099053248\",\"upi_transaction_id\":\"0B48690107A76F403D37404B2423FC68\"},\"created_at\":1750245568,\"upi\":{\"vpa\":\"drt@axl\"}}', 'SUCCESS', '2025-06-18 16:49:12', '2025-06-18 16:49:44', NULL),
(8331, 42, '190', 'order_QifbjrKpHu2Iq8', 'pay_QifcTVYSh72Cry', 'RAZORPAY', 150.00, '{\"id\":\"pay_QifcTVYSh72Cry\",\"entity\":\"payment\",\"amount\":15000,\"currency\":\"INR\",\"status\":\"captured\",\"order_id\":\"order_QifbjrKpHu2Iq8\",\"invoice_id\":null,\"international\":false,\"method\":\"card\",\"amount_refunded\":0,\"refund_status\":null,\"captured\":true,\"description\":\"Payment for order #190\",\"card_id\":\"card_QifcUWIIZRPL9O\",\"card\":{\"id\":\"card_QifcUWIIZRPL9O\",\"entity\":\"card\",\"name\":\"\",\"last4\":\"1111\",\"network\":\"Visa\",\"type\":\"prepaid\",\"issuer\":null,\"international\":false,\"emi\":false,\"sub_type\":\"consumer\",\"token_iin\":null},\"bank\":null,\"wallet\":null,\"vpa\":null,\"email\":\"ankit@gmail.com\",\"contact\":\"+918909095987\",\"notes\":{\"notes_key_1\":8331,\"notes_key_2\":\"\"},\"fee\":300,\"tax\":0,\"error_code\":null,\"error_description\":null,\"error_source\":null,\"error_step\":null,\"error_reason\":null,\"acquirer_data\":{\"auth_code\":\"187593\"},\"created_at\":1750252188}', 'SUCCESS', '2025-06-18 18:39:03', '2025-06-18 18:40:09', NULL),
(8332, 37, '191', 'order_Qj0zIV8C9bxj9M', NULL, 'RAZORPAY', 15.00, NULL, 'FAILED', '2025-06-19 15:33:55', '2025-06-19 15:33:56', NULL),
(8333, 37, '191', 'order_Qj0zp7YK2sBzXT', NULL, 'RAZORPAY', 15.00, NULL, 'FAILED', '2025-06-19 15:34:26', '2025-06-19 15:34:26', NULL),
(8334, 37, '192', 'order_Qj11OuiKk0EF5i', 'pay_Qj11azBJ9XcJhp', 'RAZORPAY', 10.00, '{\"id\":\"pay_Qj11azBJ9XcJhp\",\"entity\":\"payment\",\"amount\":1000,\"currency\":\"INR\",\"status\":\"captured\",\"order_id\":\"order_Qj11OuiKk0EF5i\",\"invoice_id\":null,\"international\":false,\"method\":\"upi\",\"amount_refunded\":0,\"refund_status\":null,\"captured\":true,\"description\":\"Payment for order #192\",\"card_id\":null,\"bank\":null,\"wallet\":null,\"vpa\":\"success@razorpay\",\"email\":\"void@razorpay.com\",\"contact\":\"+918777347811\",\"notes\":{\"notes_key_1\":8334,\"notes_key_2\":\"\"},\"fee\":24,\"tax\":4,\"error_code\":null,\"error_description\":null,\"error_source\":null,\"error_step\":null,\"error_reason\":null,\"acquirer_data\":{\"rrn\":\"777111699462\",\"upi_transaction_id\":\"2B171A0C0B27183035DA0AA7A6F5763A\"},\"created_at\":1750327567,\"upi\":{\"vpa\":\"success@razorpay\"}}', 'SUCCESS', '2025-06-19 15:35:56', '2025-06-19 15:36:28', NULL),
(8335, 6, '200', 'order_QkcMqxrOl6r0JU', NULL, 'RAZORPAY', 15.00, NULL, 'FAILED', '2025-06-23 16:46:53', '2025-06-23 16:46:54', NULL),
(8336, 6, '200', 'order_QkcNYPnokwdLFM', NULL, 'RAZORPAY', 15.00, NULL, 'FAILED', '2025-06-23 16:47:33', '2025-06-23 16:47:34', NULL),
(8337, 6, '200', 'order_QkcNh3lOhjjFvc', NULL, 'RAZORPAY', 15.00, NULL, 'FAILED', '2025-06-23 16:47:42', '2025-06-23 16:47:42', NULL),
(8338, 6, '201', 'order_Qkccj1KPIj0gqG', NULL, 'RAZORPAY', 30.00, NULL, 'FAILED', '2025-06-23 17:01:56', '2025-06-23 17:01:56', NULL),
(8339, 6, '202', 'order_QlSUKhmAyCWGmR', NULL, 'RAZORPAY', 105.00, NULL, 'FAILED', '2025-06-25 19:46:02', '2025-06-25 19:46:03', NULL),
(8340, 60, '203', NULL, NULL, 'RAZORPAY', 70.00, NULL, 'FAILED', '2025-06-26 15:14:26', '2025-06-26 15:14:26', NULL),
(8341, 60, '204', NULL, NULL, 'RAZORPAY', 70.00, NULL, 'FAILED', '2025-06-26 15:14:29', '2025-06-26 15:14:29', NULL),
(8342, 60, '205', NULL, NULL, 'RAZORPAY', 70.00, NULL, 'FAILED', '2025-06-26 15:14:30', '2025-06-26 15:14:30', NULL),
(8343, 60, '206', NULL, NULL, 'RAZORPAY', 70.00, NULL, 'FAILED', '2025-06-26 15:14:31', '2025-06-26 15:14:31', NULL),
(8344, 60, '207', NULL, NULL, 'RAZORPAY', 70.00, NULL, 'FAILED', '2025-06-26 15:14:38', '2025-06-26 15:14:38', NULL);
INSERT INTO `payments` (`id`, `user_id`, `transaction_id`, `order_id`, `payment_id`, `gateway`, `amount`, `response`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(8345, 60, '208', 'order_QlmTWITxSMPY37', NULL, 'RAZORPAY', 70.00, NULL, 'FAILED', '2025-06-26 15:19:08', '2025-06-26 15:19:09', NULL),
(8346, 6, '209', 'order_Qm9ypTcQEaDJDe', NULL, 'RAZORPAY', 90.00, NULL, 'FAILED', '2025-06-27 14:18:44', '2025-06-27 14:18:45', NULL),
(8347, 6, '212', 'order_QmA82iV8tV8aA0', NULL, 'RAZORPAY', 90.00, NULL, 'FAILED', '2025-06-27 14:27:28', '2025-06-27 14:27:28', NULL),
(8348, 6, '214', 'order_QmAAp9DZezm4cU', NULL, 'RAZORPAY', 90.00, NULL, 'FAILED', '2025-06-27 14:30:06', '2025-06-27 14:30:06', NULL),
(8349, 60, '215', 'order_QmwZP1gjk8Y5Y7', NULL, 'RAZORPAY', 90.00, NULL, 'FAILED', '2025-06-29 13:50:38', '2025-06-29 13:50:39', NULL),
(8350, 60, '216', 'order_QmwlDXv4y9Cifr', NULL, 'RAZORPAY', 220.00, NULL, 'FAILED', '2025-06-29 14:01:50', '2025-06-29 14:01:50', NULL),
(8351, 18, '217', 'order_QniedrfQIIoMje', NULL, 'RAZORPAY', 60.00, NULL, 'FAILED', '2025-07-01 12:52:54', '2025-07-01 12:52:55', NULL),
(8352, 18, '217', 'order_Qnif9FpkJMZf3Y', NULL, 'RAZORPAY', 60.00, NULL, 'FAILED', '2025-07-01 12:53:23', '2025-07-01 12:53:23', NULL),
(8353, 37, '218', 'order_QoQVdbyiaD5xHV', NULL, 'RAZORPAY', 10.00, NULL, 'FAILED', '2025-07-03 07:46:53', '2025-07-03 07:46:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `main_id` int(11) DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `menutype` enum('M','B') NOT NULL DEFAULT 'M',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` enum('Admin','Restaurant') NOT NULL DEFAULT 'Admin'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `main_id`, `name`, `slug`, `menutype`, `created_at`, `updated_at`, `type`) VALUES
(1, 1, 'Driver list', 'drivers', 'M', NULL, NULL, 'Admin'),
(2, 1, 'Add Driver', 'add-driver', 'B', NULL, NULL, 'Admin'),
(3, 1, 'Edit Driver', 'edit-driver', 'B', NULL, NULL, 'Admin'),
(4, 1, 'Delete Driver', 'delete-driver', 'B', NULL, NULL, 'Admin'),
(5, 3, 'Roles', 'roles', 'M', NULL, NULL, 'Admin'),
(6, 3, 'Add Role', 'add-role', 'B', NULL, NULL, 'Admin'),
(7, 3, 'Edit Role', 'edit-role', 'B', NULL, NULL, 'Admin'),
(8, 3, 'Delete Role', 'delete-role', 'B', NULL, NULL, 'Admin'),
(9, 3, 'Permissionlist', 'permissionlist', 'B', NULL, NULL, 'Admin'),
(10, 3, 'Sub Admin', 'admins', 'M', NULL, NULL, 'Admin'),
(11, 3, 'Add Sub Admin', 'add-admin', 'B', NULL, NULL, 'Admin'),
(12, 3, 'Edit Sub Admin', 'edit-admin', 'B', NULL, NULL, 'Admin'),
(13, 3, 'Delete Sub Admin', 'delete-admin', 'B', NULL, NULL, 'Admin'),
(102, 3, 'Update Permission', 'update-permission', 'B', NULL, NULL, 'Admin'),
(131, 16, 'Page list', 'pages', 'M', NULL, NULL, 'Admin'),
(132, 16, 'Edit Page', 'edit-page', 'B', NULL, NULL, 'Admin'),
(135, 23, 'User Wallet', 'transactions', 'M', NULL, NULL, 'Admin'),
(139, 26, 'Kyc', 'driver-kyc', 'B', NULL, NULL, 'Admin'),
(148, 20, 'Customer Settlement', 'customersettlements', 'M', NULL, NULL, 'Admin'),
(149, 20, 'Add Customer Settlement', 'add-customersettlement', 'B', NULL, NULL, 'Admin'),
(156, 5, 'Website Config', 'websiteconfigs', 'M', NULL, NULL, 'Admin'),
(157, 5, 'Update Website Config', 'edit-websiteconfig', 'B', NULL, NULL, 'Admin'),
(162, 21, 'Notification list', 'notifications', 'M', NULL, NULL, 'Admin'),
(163, 21, 'Add Notification', 'add-notification', 'B', NULL, NULL, 'Admin'),
(164, 21, 'Delete Notification', 'delete-notification', 'B', NULL, NULL, 'Admin'),
(195, 2, 'Delete Store', 'delete-store', 'B', NULL, NULL, 'Admin'),
(194, 2, 'Edit Store', 'edit-store', 'B', NULL, NULL, 'Admin'),
(167, 17, 'Admin Charges', 'admincharges', 'M', NULL, NULL, 'Admin'),
(168, 17, 'Tds Charges', 'tdscharges', 'M', NULL, NULL, 'Admin'),
(193, 2, 'Add Store', 'add-store', 'B', NULL, NULL, 'Admin'),
(192, 2, 'Store list', 'stores', 'M', NULL, NULL, 'Admin'),
(196, NULL, 'View Dashboard', 'view_dashboard', 'M', '2025-03-30 10:10:06', '2025-03-30 10:10:06', 'Restaurant'),
(197, NULL, 'Manage Orders', 'manage_orders', 'M', '2025-03-30 10:10:06', '2025-03-30 10:10:06', 'Restaurant'),
(198, NULL, 'Manage Tables', 'manage_tables', 'M', '2025-03-30 10:10:06', '2025-03-30 10:10:06', 'Restaurant'),
(199, NULL, 'Manage Categories', 'manage_categories', 'M', '2025-03-30 10:10:06', '2025-03-30 10:10:06', 'Restaurant'),
(200, NULL, 'Manage Products', 'manage_products', 'M', '2025-03-30 10:10:06', '2025-03-30 10:10:06', 'Restaurant'),
(201, NULL, 'Manage Stocks', 'manage_stocks', 'M', '2025-03-30 10:10:06', '2025-03-30 10:10:06', 'Restaurant'),
(202, NULL, 'View Todays Stocks', 'view_todays_stocks', 'M', '2025-03-30 10:10:06', '2025-03-30 10:10:06', 'Restaurant'),
(203, NULL, 'View Profile', 'view_profile', 'M', '2025-03-30 10:10:06', '2025-03-30 10:10:06', 'Restaurant'),
(204, NULL, 'Manage Employees', 'manage_employees', 'M', '2025-03-30 10:10:06', '2025-03-30 10:10:06', 'Restaurant'),
(205, NULL, 'Manage Roles', 'manage_roles', 'M', '2025-03-30 10:10:06', '2025-03-30 10:10:06', 'Restaurant'),
(206, NULL, 'Print Orders', 'print_orders', 'M', '2025-03-30 10:10:06', '2025-03-30 10:10:06', 'Restaurant'),
(207, NULL, 'Manage Menu', 'manage_menu', 'M', NULL, NULL, 'Restaurant'),
(208, 27, 'Employee Attendance', 'attendance', 'M', NULL, NULL, 'Admin'),
(209, NULL, 'View Driver', 'show-driver', 'M', NULL, NULL, 'Admin'),
(210, NULL, 'Show Store', 'show-store', 'M', NULL, NULL, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 3, 'mobile', '6b9368026b00831cf61d9941d54468d358e63a59d2d84715a388991013b61f70', '[\"role:customer\"]', NULL, '2024-04-02 18:03:15', '2024-04-02 18:03:15'),
(2, 'App\\Models\\User', 4, 'mobile', '0fa4ccda0f3457e9f5268e8d29848790a8200e06a0637d1d9f7fa005e57ef9c2', '[\"role:customer\"]', NULL, '2024-04-02 18:05:34', '2024-04-02 18:05:34'),
(3, 'App\\Models\\User', 5, 'mobile', '700e5f22fc7793ec19ece865905e77e3ad63b21dd209c1f9b46050ab3ea8fc2e', '[\"role:customer\"]', NULL, '2024-04-02 18:42:51', '2024-04-02 18:42:51'),
(4, 'App\\Models\\User', 1, 'mobile', '97dd541e41fb90bd499e620b912d1a13d7b4fd1c97710fd73126da3702a9f676', '[\"role:customer\"]', NULL, '2024-04-02 18:47:03', '2024-04-02 18:47:03'),
(5, 'App\\Models\\User', 1, 'mobile', '28f9788a3ca77855c3dba3f1586b8da4121aca2ffae622162b5110701bb1a9cc', '[\"role:customer\"]', NULL, '2024-04-02 18:47:12', '2024-04-02 18:47:12'),
(6, 'App\\Models\\Driver', 1, 'mobile', 'd63a3c2275745ba64521079c4a5e5719a7dfa5546f47290f02f01223e55d1838', '[\"role:driver\"]', NULL, '2024-04-03 11:59:50', '2024-04-03 11:59:50'),
(7, 'App\\Models\\Driver', 1, 'mobile', 'e1bfd6c549f3c4e933880f58e2af10d2054dc06dfc9d705bc7ad6622adfff28b', '[\"role:driver\"]', NULL, '2024-04-03 12:00:27', '2024-04-03 12:00:27'),
(8, 'App\\Models\\Driver', 1, 'mobile', '748f8a87e62a39e7e0516a9e644e045c21d9b73a0d4b98f40673656e913e1566', '[\"role:driver\"]', NULL, '2024-04-03 14:21:47', '2024-04-03 14:21:47'),
(11, 'App\\Models\\User', 1, 'mobile', 'd684fb0d94a9987d1051ef79f87cdbf6100c6d2c165f008fca4dafa8babfdbe8', '[\"role:customer\"]', '2024-04-03 18:23:37', '2024-04-03 18:22:39', '2024-04-03 18:23:37'),
(12, 'App\\Models\\Driver', 1, 'mobile', 'fccf6bc3209519e876c3714f276a3fef7414835d66a1de181ee2813345958d54', '[\"role:driver\"]', '2024-04-03 18:24:25', '2024-04-03 18:24:00', '2024-04-03 18:24:25'),
(13, 'App\\Models\\User', 1, 'mobile', '52680ac00a8287eedd3abe0b40160957b5487bb5bf4bccb106ec2a212c4a1860', '[\"role:customer\"]', NULL, '2024-04-04 11:20:57', '2024-04-04 11:20:57'),
(15, 'App\\Models\\User', 6, 'mobile', 'e455d54b94160a815fbfa4fd29e765d69f755bf853b36944548a0f91c761b1d7', '[\"role:customer\"]', NULL, '2024-04-30 12:14:19', '2024-04-30 12:14:19'),
(16, 'App\\Models\\User', 7, 'mobile', 'f6e7e120f19a785ebbdb966470567a5bf9464a98a165965a66d5901399167b5f', '[\"role:customer\"]', NULL, '2024-04-30 12:24:12', '2024-04-30 12:24:12'),
(17, 'App\\Models\\User', 6, 'mobile', '8085b9c12f81e909ed6713f55705406d9c15911cbd6ff06c9d41809febfae86a', '[\"role:customer\"]', NULL, '2024-04-30 14:01:48', '2024-04-30 14:01:48'),
(18, 'App\\Models\\User', 6, 'mobile', '1676b07cf97539fe4e3689e00e7d7e19beca90884a79889976bf32bcda241c50', '[\"role:customer\"]', NULL, '2024-04-30 14:17:31', '2024-04-30 14:17:31'),
(19, 'App\\Models\\User', 6, 'mobile', 'beb5c95102c13143d754bf14791f5d0a11eca5995fd8b4b665e12133145e1449', '[\"role:customer\"]', NULL, '2024-04-30 14:20:02', '2024-04-30 14:20:02'),
(20, 'App\\Models\\User', 6, 'mobile', 'aa8e5ad92f37119885cfe6908d0eb59e340da2769adb237dd48409160cbf48af', '[\"role:customer\"]', NULL, '2024-04-30 14:20:26', '2024-04-30 14:20:26'),
(21, 'App\\Models\\User', 6, 'mobile', '570072d37fa4be5afe586c5162ba5806785ea811b2c3acb6902e62c71c4e8b94', '[\"role:customer\"]', NULL, '2024-04-30 14:20:55', '2024-04-30 14:20:55'),
(22, 'App\\Models\\User', 6, 'mobile', '30f767719dd1e0be0f97d9c767e932b35eda3455f642719820ccda6317391b80', '[\"role:customer\"]', NULL, '2024-04-30 14:21:12', '2024-04-30 14:21:12'),
(23, 'App\\Models\\User', 6, 'mobile', '773056b771719d1f3b5bf9f8f86f38ab0e8b325dde3a44f0267aa1e732c51c87', '[\"role:customer\"]', NULL, '2024-04-30 14:22:11', '2024-04-30 14:22:11'),
(24, 'App\\Models\\User', 8, 'mobile', '84779f6f1ff372df3e6af680b7fa838101d83a3cc3fb647b9378d9d36985d29a', '[\"role:customer\"]', NULL, '2024-04-30 14:28:01', '2024-04-30 14:28:01'),
(25, 'App\\Models\\User', 8, 'mobile', 'f9fa3dc3c11eafe9fc53ca45c6ef11fb3b44fb0523285746c8b838972035bf38', '[\"role:customer\"]', NULL, '2024-04-30 14:28:06', '2024-04-30 14:28:06'),
(26, 'App\\Models\\User', 9, 'mobile', 'd42244b32fa1da23037b3a141fc4f4a4231b21ba39e51bbafeffce561515b7d5', '[\"role:customer\"]', NULL, '2024-06-08 17:19:28', '2024-06-08 17:19:28'),
(27, 'App\\Models\\User', 9, 'mobile', '5ba93f273ac562bf9fac90945c8087290c1907a890a474948a4da9c254f55ed2', '[\"role:customer\"]', NULL, '2024-06-08 17:19:51', '2024-06-08 17:19:51'),
(28, 'App\\Models\\User', 9, 'mobile', 'da5618e9a20f92c2c2e38e6804c30131a495a231da3d4aba3e8ebf3724757f53', '[\"role:customer\"]', NULL, '2024-06-08 17:24:28', '2024-06-08 17:24:28'),
(29, 'App\\Models\\User', 10, 'mobile', 'ef4cb8b38dd1778e7765006479129e53c0ef285e386505f8166841c989cf5bed', '[\"role:customer\"]', NULL, '2024-07-04 15:10:42', '2024-07-04 15:10:42'),
(30, 'App\\Models\\User', 10, 'mobile', 'c6c977febb2f801f694d9ea478a76db0431f102db79f0b6929bfd91480b0fdf5', '[\"role:customer\"]', NULL, '2024-07-04 15:10:45', '2024-07-04 15:10:45'),
(31, 'App\\Models\\User', 11, 'mobile', '9e5e4704d5bde0eb630e102c713ba2552149fdede5b196bb1512b468ebd734c3', '[\"role:customer\"]', NULL, '2024-07-04 18:21:51', '2024-07-04 18:21:51'),
(32, 'App\\Models\\User', 11, 'mobile', 'b2742044fb79c386533ffb21661ca22bc1cfe2e1b7542bb6cdc95c81fe6f2454', '[\"role:customer\"]', NULL, '2024-07-04 18:22:00', '2024-07-04 18:22:00'),
(33, 'App\\Models\\User', 9, 'mobile', '6af9df0952be3a8214548788037a0becc295c185820d6e461b6b6b19ef77e80e', '[\"role:customer\"]', NULL, '2024-07-22 18:54:33', '2024-07-22 18:54:33'),
(34, 'App\\Models\\User', 1, 'mobile', '516a8ac3d18d1b8ab68b9e4fc4e48cc78d785dc78c4618ffeefa6aa1e8f899f1', '[\"role:customer\"]', NULL, '2024-08-23 18:39:51', '2024-08-23 18:39:51'),
(36, 'App\\Models\\User', 1, 'mobile', 'abb3cb3c38e68550b9e40ca8dd20dcef8bafa1308252a53b758b924486dbb725', '[\"role:customer\"]', NULL, '2024-10-14 13:30:39', '2024-10-14 13:30:39'),
(37, 'App\\Models\\User', 1, 'mobile', '900163f9bc7827c3933e2a3747f02d58f8d5011f9e8195e94dcab4ec776172c7', '[\"role:customer\"]', NULL, '2024-10-14 13:30:58', '2024-10-14 13:30:58'),
(38, 'App\\Models\\User', 2, 'mobile', '98478ae21f2b43937b3e16d5835b27d6b7cd5eabcef11043d055df7e6c930e71', '[\"role:customer\"]', NULL, '2024-10-14 15:58:54', '2024-10-14 15:58:54'),
(39, 'App\\Models\\User', 1, 'mobile', '31e3dad5b8029632bf6e702e0e4dd752145f3aa0d6b3eda7b9319edfa141fcb8', '[\"role:customer\"]', NULL, '2024-10-14 16:31:16', '2024-10-14 16:31:16'),
(40, 'App\\Models\\User', 1, 'mobile', 'c3f4b57235d1cf5287e40495e410bd4551a5fc478203ada1f66344e00e388082', '[\"role:customer\"]', NULL, '2024-10-14 16:31:42', '2024-10-14 16:31:42'),
(41, 'App\\Models\\User', 1, 'mobile', '37a242854fa36b0a6dcc30993f2e0452d74de1ca029925bcd50315a65e75b628', '[\"role:customer\"]', '2025-03-03 13:38:36', '2024-10-20 12:56:47', '2025-03-03 13:38:36'),
(42, 'App\\Models\\User', 1, 'mobile', '331f00cf0ec083c96f6bcdd3cc48879a24d1b61d8010f92141539a527bee9278', '[\"role:customer\"]', '2024-10-20 16:07:11', '2024-10-20 13:44:13', '2024-10-20 16:07:11'),
(43, 'App\\Models\\User', 1, 'mobile', '6b494af1e3bbaed2e55232b1c5c5b2f196d37b3d940134e1c89b4d022103f625', '[\"role:customer\"]', NULL, '2024-10-20 16:00:44', '2024-10-20 16:00:44'),
(44, 'App\\Models\\User', 1, 'mobile', '9eef58400e9de3c3c536a8737142239ad43950af00780a9f307ea0518a7a9d0e', '[\"role:customer\"]', NULL, '2024-10-20 16:01:19', '2024-10-20 16:01:19'),
(45, 'App\\Models\\User', 1, 'mobile', 'c072bea623ae9b67981b686d2ea802018e0ad292dc1feb0af7ee00f6b662b7b9', '[\"role:customer\"]', NULL, '2024-10-20 16:01:28', '2024-10-20 16:01:28'),
(46, 'App\\Models\\User', 1, 'mobile', 'f21e2ee0c387de05ebe923be982d498f80c89d19f70563cd61642d699033afbc', '[\"role:customer\"]', NULL, '2024-10-20 16:01:28', '2024-10-20 16:01:28'),
(47, 'App\\Models\\User', 1, 'mobile', '9202a0d40e8faf120ccaaf803b4add651233cb8139e484c5b2fde6faeff59f8e', '[\"role:customer\"]', NULL, '2024-10-20 16:03:19', '2024-10-20 16:03:19'),
(48, 'App\\Models\\User', 1, 'mobile', 'f3aca617b77931e37f8eaba7e583f9f4360acda7c9c119b8583ad35a272e2678', '[\"role:customer\"]', NULL, '2024-10-20 16:34:04', '2024-10-20 16:34:04'),
(49, 'App\\Models\\User', 1, 'mobile', 'fde880fc7518a02f91440f385b2cd80651e0d6ccf3e4cad76a9cbe80e0133448', '[\"role:customer\"]', '2024-10-20 16:38:18', '2024-10-20 16:35:43', '2024-10-20 16:38:18'),
(50, 'App\\Models\\User', 1, 'mobile', '8919e040b1df36d03c95f7d12858bc79e2bcf2bfee90e8182623a5354b8a2775', '[\"role:customer\"]', NULL, '2024-10-20 16:44:12', '2024-10-20 16:44:12'),
(51, 'App\\Models\\User', 1, 'mobile', '850fe8fccb1780e3b223958a3794ab012d7a05911094c6ae1628915944495aa4', '[\"role:customer\"]', '2024-10-20 17:12:57', '2024-10-20 16:46:26', '2024-10-20 17:12:57'),
(52, 'App\\Models\\User', 1, 'mobile', '50628cb69a18b5958fb0d1120b0916b28d628f0664536c26646d0bf3c828df1d', '[\"role:customer\"]', '2024-10-20 17:18:26', '2024-10-20 17:18:15', '2024-10-20 17:18:26'),
(53, 'App\\Models\\User', 1, 'mobile', '128f32418e74a1773164a8ff27458bddc03cb4381859adee6fbfb9ca04cd6870', '[\"role:customer\"]', '2024-10-20 17:30:06', '2024-10-20 17:18:58', '2024-10-20 17:30:06'),
(54, 'App\\Models\\User', 1, 'mobile', 'da7766f88e5eaa38a9cabcfe115fac8f51c3e3a06ed9c2ad02d452857a66b710', '[\"role:customer\"]', '2024-10-20 17:33:41', '2024-10-20 17:33:28', '2024-10-20 17:33:41'),
(55, 'App\\Models\\User', 1, 'mobile', 'ff6558f551108531eb33b0a0c1e60f011c27476388a11f968566def03021d67e', '[\"role:customer\"]', '2024-10-20 17:34:21', '2024-10-20 17:34:12', '2024-10-20 17:34:21'),
(56, 'App\\Models\\User', 1, 'mobile', 'ce77bf5a2c46ffcd1aa3591614d3461618f1b2286e6221edc71409e803987a91', '[\"role:customer\"]', '2024-10-23 17:53:15', '2024-10-23 17:52:59', '2024-10-23 17:53:15'),
(57, 'App\\Models\\User', 1, 'mobile', '3c3ccae9f4cc06effe5ca0bef9b2221a9df0fc5a33ef9d416d3cbb5a2d8bf313', '[\"role:customer\"]', NULL, '2024-10-25 15:10:13', '2024-10-25 15:10:13'),
(58, 'App\\Models\\User', 1, 'mobile', '77d97dec0d8b61db29af771e4509c04cb27d85effd685305e56da9ab6742b26b', '[\"role:customer\"]', NULL, '2024-10-25 15:10:18', '2024-10-25 15:10:18'),
(59, 'App\\Models\\User', 1, 'mobile', '1709ba477a67498bf62591a163c21e0451428032f921cf52e2c9019e10674409', '[\"role:customer\"]', '2024-10-25 20:46:27', '2024-10-25 15:10:18', '2024-10-25 20:46:27'),
(60, 'App\\Models\\User', 1, 'mobile', '7b1840cd5b4f5081f01212385148926a6f9edabbb884756c287a3507005174e6', '[\"role:customer\"]', '2024-10-26 12:05:46', '2024-10-26 12:05:14', '2024-10-26 12:05:46'),
(61, 'App\\Models\\User', 1, 'mobile', 'ff8e9e1f5d6dc9e51178a835cc2acaa7e7309992dc9bc240e2283231c9e002e1', '[\"role:customer\"]', '2024-10-26 13:01:13', '2024-10-26 12:42:01', '2024-10-26 13:01:13'),
(62, 'App\\Models\\User', 1, 'mobile', '0577e15902ba8bc337db9b06db5a9800916721768a704995b1022e41770a6012', '[\"role:customer\"]', '2024-10-28 12:24:45', '2024-10-28 12:22:46', '2024-10-28 12:24:45'),
(63, 'App\\Models\\User', 1, 'mobile', '1a0dc9e2abe4e4959289da141e4ff01e4cc633a05e166fe63c240fc4944479fe', '[\"role:customer\"]', '2024-10-28 17:46:40', '2024-10-28 16:24:00', '2024-10-28 17:46:40'),
(64, 'App\\Models\\User', 1, 'mobile', '43eabd8f5a2c5bc5b9b60b3703ee85de4e0ea41887a188e13a538b18a4389fe6', '[\"role:customer\"]', NULL, '2024-10-29 12:41:35', '2024-10-29 12:41:35'),
(65, 'App\\Models\\User', 1, 'mobile', 'b140929a151cd29a205446760f1a248262692dc6d9905b608d6a30d093f8fa2c', '[\"role:customer\"]', '2024-10-29 13:42:08', '2024-10-29 13:41:53', '2024-10-29 13:42:08'),
(66, 'App\\Models\\User', 1, 'mobile', '9111725549c336d638db73e046005bed46d522bd5098f103b20ae7ae959da0ef', '[\"role:customer\"]', '2024-10-29 15:59:37', '2024-10-29 15:59:25', '2024-10-29 15:59:37'),
(67, 'App\\Models\\User', 1, 'mobile', '087f113791afa33978982312b00747eaf5672f304dac0e89f2d4a8322269262c', '[\"role:customer\"]', '2024-10-29 16:13:39', '2024-10-29 16:07:04', '2024-10-29 16:13:39'),
(68, 'App\\Models\\User', 1, 'mobile', 'fa008a3522fca8b420b4cacc87b05b211ca9bd9f12077cf64db574a185d1ad00', '[\"role:customer\"]', '2024-10-29 16:36:54', '2024-10-29 16:15:25', '2024-10-29 16:36:54'),
(69, 'App\\Models\\User', 1, 'mobile', '4c35d30a29a9367500fda33615e8fedaefcf7b7bac8e656ef5d70e68b525be46', '[\"role:customer\"]', '2024-10-29 16:43:20', '2024-10-29 16:42:54', '2024-10-29 16:43:20'),
(70, 'App\\Models\\User', 1, 'mobile', '3327d7168d662486322026b0d1cf0ea973e474f980d556efd73f3b5430edb59e', '[\"role:customer\"]', '2024-10-29 16:48:55', '2024-10-29 16:44:30', '2024-10-29 16:48:55'),
(71, 'App\\Models\\User', 1, 'mobile', 'd2c9ea469952be10082aa9929437ba1af67f05bed1f84d5644b5ba1883294995', '[\"role:customer\"]', '2024-10-29 16:52:27', '2024-10-29 16:50:29', '2024-10-29 16:52:27'),
(72, 'App\\Models\\User', 1, 'mobile', '853425389a8da376542edb79cabd1288a373307b2efd77dcaf93e32b50415f2a', '[\"role:customer\"]', '2024-10-29 16:58:47', '2024-10-29 16:53:47', '2024-10-29 16:58:47'),
(73, 'App\\Models\\User', 1, 'mobile', '08c414bf19982a260d3dd6bb143ed3aad5109fb0278baf889d563aee58bb9268', '[\"role:customer\"]', '2024-10-29 18:04:14', '2024-10-29 17:10:59', '2024-10-29 18:04:14'),
(74, 'App\\Models\\User', 1, 'mobile', 'ce566f2f076037e0f8936610be672209f3c6d573f527dcb01f03dc131ae21380', '[\"role:customer\"]', '2024-10-29 18:16:10', '2024-10-29 18:09:33', '2024-10-29 18:16:10'),
(75, 'App\\Models\\User', 1, 'mobile', '2b1053abddd08f91881bb934bcbb49afa243fc528c17c00f89e190d0ccd99fa4', '[\"role:customer\"]', '2024-10-29 18:19:40', '2024-10-29 18:19:30', '2024-10-29 18:19:40'),
(76, 'App\\Models\\User', 1, 'mobile', '96d15740083f1dab39f72f5449be9fdad93ffba76102669d7d789100c7bbf510', '[\"role:customer\"]', '2024-10-29 18:20:48', '2024-10-29 18:20:38', '2024-10-29 18:20:48'),
(77, 'App\\Models\\User', 1, 'mobile', '52228118cd1c51cd2eab460a1f4877b2789c80b09971c9431f7008b6d0cc53cd', '[\"role:customer\"]', '2024-10-29 18:22:19', '2024-10-29 18:22:09', '2024-10-29 18:22:19'),
(78, 'App\\Models\\User', 1, 'mobile', '15a5d07d4e1aa9dec1d177929d475472c854ab312e135843cbec6db6a2a94d70', '[\"role:customer\"]', '2024-10-29 18:24:13', '2024-10-29 18:23:08', '2024-10-29 18:24:13'),
(79, 'App\\Models\\User', 1, 'mobile', '9fd97eb0700f6b9a42d5ffa7fb5b4c773d33c0055ee9ef44a0d56e06b9a3c2ba', '[\"role:customer\"]', NULL, '2024-10-29 18:48:15', '2024-10-29 18:48:15'),
(80, 'App\\Models\\User', 1, 'mobile', 'cfc72032c96b13f607eb1dfbab72b39197f026ed8ea74385f4699e1daa745611', '[\"role:customer\"]', NULL, '2024-10-29 18:49:48', '2024-10-29 18:49:48'),
(81, 'App\\Models\\User', 1, 'mobile', '38afbe98bf14902a39621732f2daeb6953fa8a14c325478a20ec1fc6c74c09f1', '[\"role:customer\"]', NULL, '2024-10-29 18:49:58', '2024-10-29 18:49:58'),
(82, 'App\\Models\\User', 1, 'mobile', '9b99b583e759ca505b18085db30e1a512ae6fc9450adbcb65733ca357eb73602', '[\"role:customer\"]', NULL, '2024-10-29 18:53:28', '2024-10-29 18:53:28'),
(83, 'App\\Models\\User', 1, 'mobile', '1ddf7e554972449fcbc0222f9a46dcb81de73014ab25b6c5dbed9db5304549c8', '[\"role:customer\"]', '2024-10-29 19:12:02', '2024-10-29 18:58:33', '2024-10-29 19:12:02'),
(84, 'App\\Models\\User', 1, 'mobile', 'f5cb60f7944aabbe9ea964c95f9598be4ad1996e14d2eda84c02d750a22da2a1', '[\"role:customer\"]', NULL, '2024-10-30 11:13:11', '2024-10-30 11:13:11'),
(88, 'App\\Models\\User', 1, 'mobile', 'f581d15f06e939e6b148dad0afbaab30e9a63d5836a1b43d99374b5d41edcd01', '[\"role:customer\"]', '2024-10-30 19:12:14', '2024-10-30 19:08:00', '2024-10-30 19:12:14'),
(89, 'App\\Models\\User', 1, 'mobile', '90118a966e037e417d69a00246104be9eabae7bb686cef22b091fe1c94ae3c09', '[\"role:customer\"]', NULL, '2024-10-30 19:21:23', '2024-10-30 19:21:23'),
(90, 'App\\Models\\User', 1, 'mobile', 'b327fba1032565f8d3ef52846d90453ab54c230641fce0785bbb79b10301fd2b', '[\"role:customer\"]', '2024-11-04 16:13:51', '2024-11-04 11:54:24', '2024-11-04 16:13:51'),
(91, 'App\\Models\\User', 1, 'mobile', 'c2fff19a2242174130769364755af5f0a47acc6b71733ed8a328ed7edd8ef918', '[\"role:customer\"]', NULL, '2024-11-06 11:37:34', '2024-11-06 11:37:34'),
(92, 'App\\Models\\User', 1, 'mobile', '7b37bbed190e57cecb3375338cd75caa08767bd9ddaa5af44248ae7385d2d0b3', '[\"role:customer\"]', NULL, '2024-11-06 11:44:43', '2024-11-06 11:44:43'),
(93, 'App\\Models\\User', 3, 'mobile', '86796547dadba09ded18f19972c94b3f05af1522513ba3ca785980ce86213f28', '[\"role:customer\"]', NULL, '2024-11-06 13:04:41', '2024-11-06 13:04:41'),
(94, 'App\\Models\\User', 4, 'mobile', '8f4c2b75c662bc96114e9c765310c6753178ca09a651d90e3ae632a2cb7a7643', '[\"role:customer\"]', NULL, '2024-11-06 13:08:40', '2024-11-06 13:08:40'),
(95, 'App\\Models\\User', 4, 'mobile', '2f16504bafdcab2c923f651ae59e6c3ed2f14d64acb963c042e2c15856fe9874', '[\"role:customer\"]', NULL, '2024-11-06 13:11:24', '2024-11-06 13:11:24'),
(96, 'App\\Models\\User', 4, 'mobile', '61db0cd3453c73d56fb5fc7707667f00a9bde0c0a5b3272b4e7d156a85204cc7', '[\"role:customer\"]', NULL, '2024-11-06 13:55:47', '2024-11-06 13:55:47'),
(97, 'App\\Models\\User', 4, 'mobile', 'a89ea81715c787fc93a773a82c11c2bd0a6922ab247adc4197a59b6ed515d05a', '[\"role:customer\"]', NULL, '2024-11-06 13:57:42', '2024-11-06 13:57:42'),
(98, 'App\\Models\\User', 4, 'mobile', '4b71c152b9ce64d1c77a52fa892f661699bdd89c2b0b3e82588a53cc85a94058', '[\"role:customer\"]', NULL, '2024-11-06 13:58:49', '2024-11-06 13:58:49'),
(99, 'App\\Models\\User', 5, 'mobile', '9e395718a6189c7b43b8838156663513bdaff9e083aaed67e2f00c109e8d0a55', '[\"role:customer\"]', NULL, '2024-11-06 14:03:17', '2024-11-06 14:03:17'),
(100, 'App\\Models\\User', 1, 'mobile', '83742eaf07d8bf523ea3c1e1d673b29d83a46c3abcda18f20c8c2a61349950e4', '[\"role:customer\"]', NULL, '2024-11-06 16:38:38', '2024-11-06 16:38:38'),
(101, 'App\\Models\\User', 1, 'mobile', 'ac73dfe20a843afb9998c352c3147b6af5fee6f144bf258d128678526706d0ff', '[\"role:customer\"]', NULL, '2024-11-06 16:38:43', '2024-11-06 16:38:43'),
(102, 'App\\Models\\User', 1, 'mobile', '6224f7867a8aaa9844b9fff8215974a99d6e77eaa08528e04ad2d5cc4fd08287', '[\"role:customer\"]', NULL, '2024-11-06 16:38:49', '2024-11-06 16:38:49'),
(103, 'App\\Models\\User', 1, 'mobile', '7021dfeabc74d6ebb7cf22a9a4f15bcbd009b7fb57dfe823314765dc360b319b', '[\"role:customer\"]', NULL, '2024-11-06 16:38:55', '2024-11-06 16:38:55'),
(104, 'App\\Models\\User', 1, 'mobile', '5692630fd0ac70277c7f8dade804f1db55596bd13fd4b932b307020db3e8f35d', '[\"role:customer\"]', NULL, '2024-11-06 16:39:11', '2024-11-06 16:39:11'),
(105, 'App\\Models\\User', 4, 'mobile', '6e71f968e6a768fcfd7732808cfc2693fa31e4cab3873f09d139725984027d48', '[\"role:customer\"]', '2024-11-06 17:33:10', '2024-11-06 17:06:53', '2024-11-06 17:33:10'),
(106, 'App\\Models\\User', 4, 'mobile', '822316a7049f0c5a44af12938d7e11599a0a71f8e1d8ae069570b712baf0d351', '[\"role:customer\"]', '2024-11-06 18:32:02', '2024-11-06 18:21:01', '2024-11-06 18:32:02'),
(107, 'App\\Models\\User', 4, 'mobile', '3620fd8b3b4c1421ed07c9eff3f716c28b6aa5ac597a691a53268e54c240d6bc', '[\"role:customer\"]', '2024-11-08 11:19:22', '2024-11-08 11:01:07', '2024-11-08 11:19:22'),
(108, 'App\\Models\\User', 1, 'mobile', 'c4e5a93c8f2208b7375220cf375bd76b0672b1db3b744ab2c0e8a04b63b2dc8d', '[\"role:customer\"]', '2024-11-10 18:47:14', '2024-11-08 11:43:16', '2024-11-10 18:47:14'),
(109, 'App\\Models\\User', 4, 'mobile', '44632298c28e55b124f1b4edc07efe793ad5a200a63161106ec7909e632a47cc', '[\"role:customer\"]', '2024-11-08 13:24:34', '2024-11-08 12:26:19', '2024-11-08 13:24:34'),
(110, 'App\\Models\\User', 4, 'mobile', 'c563dc088fb6234719bab30de9dcaedfba197345e2a14fb04279b3170c98e7e2', '[\"role:customer\"]', '2024-11-08 13:27:14', '2024-11-08 13:26:41', '2024-11-08 13:27:14'),
(111, 'App\\Models\\User', 4, 'mobile', '60c5f3be6f31982c10dd196ab405c38183e9e935852df2dc6bb0dddf99430658', '[\"role:customer\"]', '2024-11-08 13:32:55', '2024-11-08 13:31:07', '2024-11-08 13:32:55'),
(112, 'App\\Models\\User', 4, 'mobile', '618f0a6cd4a597163a2fc1f3061cb71b37c5d7306eb6d75f100beb16c1180494', '[\"role:customer\"]', '2024-11-08 14:21:14', '2024-11-08 14:18:31', '2024-11-08 14:21:14'),
(113, 'App\\Models\\User', 4, 'mobile', '5729e5d83a7e58533448de2d44f69c6211b02400a573881986805490521caeee', '[\"role:customer\"]', '2024-11-08 14:33:56', '2024-11-08 14:33:55', '2024-11-08 14:33:56'),
(114, 'App\\Models\\User', 4, 'mobile', 'a6c175804d9fb9b7123dec2e8ed90ba50e0e3386ed9f2aabe2dcf4517b030660', '[\"role:customer\"]', '2024-11-08 15:37:32', '2024-11-08 14:36:22', '2024-11-08 15:37:32'),
(115, 'App\\Models\\User', 1, 'mobile', '91f8d8a1737d230f2d54e9f7a6b97ec1d78e6bacda5bcacd285c3f6eb9ca2ef4', '[\"role:customer\"]', '2025-03-11 16:10:50', '2024-11-08 15:35:40', '2025-03-11 16:10:50'),
(116, 'App\\Models\\User', 1, 'mobile', 'f6156db754ac1d85ccb99cf2fcd8aa97ce79231d5d50352fbabaae106867eff4', '[\"role:customer\"]', NULL, '2024-11-08 15:40:13', '2024-11-08 15:40:13'),
(119, 'App\\Models\\User', 4, 'mobile', '4290faf8d34a10c79783972718c3b897c42c500a29e3244d275037f7bd166d34', '[\"role:customer\"]', '2024-11-08 18:14:53', '2024-11-08 16:15:45', '2024-11-08 18:14:53'),
(120, 'App\\Models\\User', 1, 'mobile', 'af56750b273a227954da59daf922b2e74704dbdec1a39d75d5cb1972d50d434c', '[\"role:customer\"]', '2024-11-12 18:43:49', '2024-11-11 16:29:58', '2024-11-12 18:43:49'),
(121, 'App\\Models\\User', 4, 'mobile', '4433b76e7c3b3d46c069138036cd1549e656511170cac7054eb15c73aad94810', '[\"role:customer\"]', '2024-11-12 13:06:53', '2024-11-12 10:42:59', '2024-11-12 13:06:53'),
(122, 'App\\Models\\User', 4, 'mobile', 'c54460f472f3bc62da5a739efd19056eeb75ef7b5d971c1bd0fbf2c28653e65f', '[\"role:customer\"]', '2024-11-12 17:06:28', '2024-11-12 15:44:59', '2024-11-12 17:06:28'),
(123, 'App\\Models\\User', 4, 'mobile', '510103af9ecdae724301518f4668ccd2f27a8519a873b7cb9d154d4532c5caa8', '[\"role:customer\"]', '2024-11-12 17:45:03', '2024-11-12 17:19:43', '2024-11-12 17:45:03'),
(130, 'App\\Models\\User', 1, 'mobile', 'b12c774412ff8885a26de3ad06299cc5a7242adaa7d1ca2bdf40ac8b340d0164', '[\"role:customer\"]', NULL, '2024-11-13 13:01:14', '2024-11-13 13:01:14'),
(125, 'App\\Models\\User', 6, 'mobile', 'ac2eaca0e1ca653f7cf29c7828cfc41ed31ff26c12ea1f67fb4dd99c12da6bff', '[\"role:customer\"]', NULL, '2024-11-13 10:26:08', '2024-11-13 10:26:08'),
(126, 'App\\Models\\User', 6, 'mobile', 'f022da032e4174eb69dc80431c286a0fdcf6160002d0a4b00e2336e7689b5f64', '[\"role:customer\"]', '2024-11-13 10:33:29', '2024-11-13 10:26:57', '2024-11-13 10:33:29'),
(127, 'App\\Models\\User', 4, 'mobile', '773e400192160d894321692710cea171834b1794286854d9c7f48b7916db94a5', '[\"role:customer\"]', '2024-11-13 11:46:19', '2024-11-13 11:16:29', '2024-11-13 11:46:19'),
(128, 'App\\Models\\User', 4, 'mobile', 'a823c4cb3072ec1c3e7f4018e3c51707aa783187d036eaaf8c13123d0b590060', '[\"role:customer\"]', '2024-11-13 12:01:32', '2024-11-13 11:46:34', '2024-11-13 12:01:32'),
(132, 'App\\Models\\User', 7, 'mobile', '7b96553e92445156101c22118a4421623b8e66387e92075ce8191d0434367f33', '[\"role:customer\"]', NULL, '2024-11-13 13:21:19', '2024-11-13 13:21:19'),
(153, 'App\\Models\\User', 1, 'mobile', '577c8ef2433e4fd7049c5579c2e56d5705c6c87ef6d227160fb5f4b529398e4b', '[\"role:customer\"]', '2024-11-18 17:05:27', '2024-11-18 16:56:30', '2024-11-18 17:05:27'),
(134, 'App\\Models\\User', 4, 'mobile', '43e7615e329a065e600a680ca624491f76c66e8ac7902130a5e59c0e53dd4bb0', '[\"role:customer\"]', '2024-11-13 17:44:32', '2024-11-13 15:12:14', '2024-11-13 17:44:32'),
(136, 'App\\Models\\User', 9, 'mobile', '17fe1b11e429df2a962f6b259bd239994a8fbe65a5a259b7c9d3b12b21eba0b0', '[\"role:customer\"]', '2024-11-14 20:40:53', '2024-11-14 20:30:13', '2024-11-14 20:40:53'),
(159, 'App\\Models\\User', 4, 'mobile', '51611bc97a5c2eb400f0aa12cf7a2a7145c2142a24e51721ca07dae9d04d9ad0', '[\"role:customer\"]', '2024-11-24 19:34:11', '2024-11-24 19:31:10', '2024-11-24 19:34:11'),
(138, 'App\\Models\\User', 4, 'mobile', 'f100f7f12c6db029017f40340f6ac36e4031afa4cb6e0441d62a50324abed517', '[\"role:customer\"]', '2024-11-15 17:55:04', '2024-11-15 11:29:12', '2024-11-15 17:55:04'),
(143, 'App\\Models\\User', 4, 'mobile', 'b546eb45523bcc426fa340d747ea67ae074ebb74813f4a046c9960e37437882e', '[\"role:customer\"]', '2024-11-17 17:03:31', '2024-11-15 18:34:17', '2024-11-17 17:03:31'),
(141, 'App\\Models\\User', 11, 'mobile', '9f22048d23d0a6b211537b832e9622511437667c6efe3488a2921065c9d31d1b', '[\"role:customer\"]', '2024-11-15 17:16:46', '2024-11-15 17:08:08', '2024-11-15 17:16:46'),
(142, 'App\\Models\\User', 4, 'mobile', '13f361277df23a63f2d588c60dee0c95d8774a33470817ece2d3b1623c39964a', '[\"role:customer\"]', '2024-11-15 19:03:52', '2024-11-15 17:59:18', '2024-11-15 19:03:52'),
(144, 'App\\Models\\User', 4, 'mobile', 'ec3f452be4e39dee481e90cf627fbd183177aa3879b6d1c0f6adecbc06df43eb', '[\"role:customer\"]', '2024-11-17 19:03:23', '2024-11-17 12:50:04', '2024-11-17 19:03:23'),
(145, 'App\\Models\\User', 4, 'mobile', '83a4a981335470a613d47e1e66a679fe550f9cd6202e826be797ff72779bb03c', '[\"role:customer\"]', NULL, '2024-11-18 09:10:30', '2024-11-18 09:10:30'),
(146, 'App\\Models\\User', 4, 'mobile', '7566e2f2d0338f2c16001ce6dbd9219614e667fc0149638f2aaf81b186b4b387', '[\"role:customer\"]', NULL, '2024-11-18 09:13:58', '2024-11-18 09:13:58'),
(147, 'App\\Models\\User', 4, 'mobile', 'f77cf33aa678b30c995c3781f7c439a3d71cb368ba9356d7d96558ff2b3261c6', '[\"role:customer\"]', NULL, '2024-11-18 09:15:11', '2024-11-18 09:15:11'),
(148, 'App\\Models\\User', 4, 'mobile', '907706ea40cc97ee697bb711ffcb9b3693444181816d29b4dd279463719cb04c', '[\"role:customer\"]', NULL, '2024-11-18 09:17:23', '2024-11-18 09:17:23'),
(149, 'App\\Models\\User', 4, 'mobile', '6694cfbfb929768a45ef4a1489b9d3680220b88cdc4245e86dd8aa9561abaaea', '[\"role:customer\"]', NULL, '2024-11-18 14:07:54', '2024-11-18 14:07:54'),
(150, 'App\\Models\\User', 4, 'mobile', '17be182054a7131129980d0cf1a09543bafae36c3e075914eed18c72a309f780', '[\"role:customer\"]', NULL, '2024-11-18 14:09:41', '2024-11-18 14:09:41'),
(152, 'App\\Models\\User', 4, 'mobile', 'f4fa62f37fdca6463fcccdc25474eb18605535dca24db7535f942717e18393bf', '[\"role:customer\"]', '2024-11-18 19:51:59', '2024-11-18 14:15:17', '2024-11-18 19:51:59'),
(157, 'App\\Models\\User', 4, 'mobile', '155a26c8efcf06aa4f9ab11d9dc2b820e7a3c5e8d2e904bd36b24c7b90982a95', '[\"role:customer\"]', '2024-11-22 19:03:59', '2024-11-22 18:08:56', '2024-11-22 19:03:59'),
(155, 'App\\Models\\User', 4, 'mobile', 'c29767223424c3bfc8c6b8d2ab9355d7b514c81049584306c6a0b9e5fe8987c7', '[\"role:customer\"]', '2024-11-22 16:20:19', '2024-11-22 16:17:20', '2024-11-22 16:20:19'),
(156, 'App\\Models\\User', 4, 'mobile', 'a7f8f660e7204a313d4b7527d2f941287f44af89f9971bac5fad5a7bb4378375', '[\"role:customer\"]', '2024-11-22 16:49:05', '2024-11-22 16:41:59', '2024-11-22 16:49:05'),
(158, 'App\\Models\\User', 4, 'mobile', 'b00883676f5d77effe5fe132102ae9df5164285f7fc8793aed3eae1bcc719ba6', '[\"role:customer\"]', '2024-11-24 19:28:04', '2024-11-24 11:56:18', '2024-11-24 19:28:04'),
(160, 'App\\Models\\User', 4, 'mobile', '2fd666d477c2f8883ebab1f94ad67230281c2968694f026fb79ff1713a3c6278', '[\"role:customer\"]', '2024-11-26 18:37:47', '2024-11-25 11:57:20', '2024-11-26 18:37:47'),
(161, 'App\\Models\\User', 4, 'mobile', 'ba9127cef6fba86dd4f0b80c4e53aebd5f75a16f4bd5bdebbbb978f5345adafd', '[\"role:customer\"]', '2024-11-25 18:02:15', '2024-11-25 16:54:05', '2024-11-25 18:02:15'),
(163, 'App\\Models\\User', 12, 'mobile', 'ad03a363c8efd1c6f4c05b6bcfbc1a73fd1ede1ede23065b431db48306740e23', '[\"role:customer\"]', NULL, '2024-12-06 13:10:23', '2024-12-06 13:10:23'),
(164, 'App\\Models\\User', 6, 'mobile', 'abb8c73b9015bdee1379151af5694dfae76c6d966f7153df2728516e91134aa0', '[\"role:customer\"]', NULL, '2024-12-15 21:13:19', '2024-12-15 21:13:19'),
(165, 'App\\Models\\User', 4, 'mobile', '1cb05bc3d244231dddab234ec09f54f3a01f69477bc3a7e4deb5797b5a7d6ec8', '[\"role:customer\"]', NULL, '2024-12-15 22:30:39', '2024-12-15 22:30:39'),
(166, 'App\\Models\\User', 4, 'mobile', '19453e06484efb4ab51c75f2c8aba9f6afd0dd65dd0701bcb05efa6abbb7f3f3', '[\"role:customer\"]', NULL, '2024-12-15 22:30:58', '2024-12-15 22:30:58'),
(167, 'App\\Models\\User', 13, 'mobile', 'f5a4b07abd605df81e4582c0859edd5543e8ba568d20135c0fa98e6b353fa59a', '[\"role:customer\"]', NULL, '2024-12-15 22:34:32', '2024-12-15 22:34:32'),
(168, 'App\\Models\\User', 6, 'mobile', 'd39092c06541b30f5f7aa231463a7f39bfe782cb26e5816cf372397ee2d27a86', '[\"role:customer\"]', '2024-12-18 14:21:24', '2024-12-18 14:19:36', '2024-12-18 14:21:24'),
(169, 'App\\Models\\User', 4, 'mobile', '45557001cb58f49a5910f52b942688b4bf6cc3770aa926a9e135241c7bee1bb4', '[\"role:customer\"]', '2024-12-24 19:18:20', '2024-12-24 19:18:14', '2024-12-24 19:18:20'),
(170, 'App\\Models\\User', 4, 'mobile', '46160ddb5ecba88b457b2b3effe925903331eaadea2b92a8c32becc2c3d4ca57', '[\"role:customer\"]', '2024-12-27 11:56:06', '2024-12-27 11:52:58', '2024-12-27 11:56:06'),
(181, 'App\\Models\\User', 14, 'mobile', '8b813e429f188860eadab2aa491fd7982da2ae7c623828a6f87cf86013bad388', '[\"role:customer\"]', NULL, '2025-02-06 16:23:05', '2025-02-06 16:23:05'),
(172, 'App\\Models\\User', 4, 'mobile', 'df4bc6c2d69d65823ae79f9b713f3ac8506bbe7ac30a28dfdc1a1280d35470ef', '[\"role:customer\"]', '2025-01-28 17:22:26', '2025-01-28 17:10:34', '2025-01-28 17:22:26'),
(174, 'App\\Models\\User', 4, 'mobile', '17474e6114ee88b931139edc40d5fe418b54e955d0ab8d3ec2162cba26eb2efa', '[\"role:customer\"]', '2025-02-04 16:10:23', '2025-02-04 16:09:10', '2025-02-04 16:10:23'),
(180, 'App\\Models\\User', 14, 'mobile', 'f0badb8c06e94b7660521deb30649418dd3fd6124a3f1afd7f665e1eda325e94', '[\"role:customer\"]', '2025-02-06 16:16:28', '2025-02-06 16:16:14', '2025-02-06 16:16:28'),
(176, 'App\\Models\\User', 4, 'mobile', '7b9b5b1aefdef0e6b585fd090fef60d51519fffa375dfa40bf611be8abc48a74', '[\"role:customer\"]', '2025-02-05 18:58:42', '2025-02-05 18:57:10', '2025-02-05 18:58:42'),
(187, 'App\\Models\\User', 4, 'mobile', 'daa09a3635145bb76897b61f74b6bf4a6ce5c70d479148a6d1c41da0d82ced3e', '[\"role:customer\"]', '2025-03-02 18:19:49', '2025-02-12 16:57:39', '2025-03-02 18:19:49'),
(183, 'App\\Models\\User', 4, 'mobile', '475bfb466683fd8ca0c9130f6c2b740d6ef66781eb4e3101d744e8930b188a7e', '[\"role:customer\"]', NULL, '2025-02-06 20:29:21', '2025-02-06 20:29:21'),
(186, 'App\\Models\\User', 6, 'mobile', '5ac6939a64a9b92a730aae52fbc51906633bbbf80c9dd451e8bbedf9f4a4025b', '[\"role:customer\"]', '2025-02-12 13:54:49', '2025-02-12 13:47:35', '2025-02-12 13:54:49'),
(188, 'App\\Models\\User', 4, 'mobile', 'fe0d3d49ef17a64fa8d95b3835430d22e5511abb225ab90f76745464a8bb2bb9', '[\"role:customer\"]', '2025-03-04 12:09:44', '2025-03-02 12:02:34', '2025-03-04 12:09:44'),
(189, 'App\\Models\\User', 6, 'mobile', '47e22f01ad6f5e9e7e61103a52911cd08e6d8148feb167d0533b10041155bbec', '[\"role:customer\"]', '2025-03-03 16:23:39', '2025-03-02 18:08:09', '2025-03-03 16:23:39'),
(190, 'App\\Models\\User', 4, 'mobile', '377bd06bcb07e3de42faaf86a3659a2b64c6df762b4d68c085329784f4c9fd59', '[\"role:customer\"]', '2025-03-03 17:59:25', '2025-03-03 17:45:07', '2025-03-03 17:59:25'),
(191, 'App\\Models\\User', 6, 'mobile', '87c6cdc02c6b1ff8f106de3b97028fd8d2d957f5c101d4f7e129e46a184b6005', '[\"role:customer\"]', '2025-03-04 13:16:39', '2025-03-04 13:13:43', '2025-03-04 13:16:39'),
(192, 'App\\Models\\User', 6, 'mobile', 'b974864e77390603cdc6cda9e19ba3671bd46b567c78558d3d5e13440c2906be', '[\"role:customer\"]', '2025-03-04 13:17:15', '2025-03-04 13:13:45', '2025-03-04 13:17:15'),
(193, 'App\\Models\\User', 6, 'mobile', 'edff14a76b5dce8ab11af7ba54191e5095fce0269539359efde0ac8de26c66dd', '[\"role:customer\"]', '2025-03-04 13:18:32', '2025-03-04 13:15:03', '2025-03-04 13:18:32'),
(194, 'App\\Models\\User', 6, 'mobile', 'db7e9e2781388dd59afe2c0be7df806915446df408b73a1e62c53125ba81f1b1', '[\"role:customer\"]', '2025-03-04 13:38:38', '2025-03-04 13:36:57', '2025-03-04 13:38:38'),
(195, 'App\\Models\\User', 6, 'mobile', '0a2dafafe92cc7df85f19a1b8f578a661385ea797cac953d3396cb70a501fd3c', '[\"role:customer\"]', '2025-03-04 16:25:13', '2025-03-04 16:21:43', '2025-03-04 16:25:13'),
(196, 'App\\Models\\User', 4, 'mobile', 'bc4869d8ae2934384e27a907690a065270a1c22d30b03784f70faaf529ede43e', '[\"role:customer\"]', '2025-03-05 13:22:10', '2025-03-05 11:34:21', '2025-03-05 13:22:10'),
(197, 'App\\Models\\User', 6, 'mobile', '8c4111375aecb82224fd26f63a069e464ece2615e81bb1152aa15c7e5f1d0d1c', '[\"role:customer\"]', '2025-03-05 14:03:28', '2025-03-05 14:00:45', '2025-03-05 14:03:28'),
(198, 'App\\Models\\User', 6, 'mobile', 'ce7324640f99f283e11117f4fc6eebd84b6cf17a45ca8f6b22bd2b6d9a3b5105', '[\"role:customer\"]', '2025-03-05 14:04:24', '2025-03-05 14:02:37', '2025-03-05 14:04:24'),
(199, 'App\\Models\\User', 6, 'mobile', 'ae7430deb0d9bce0d48f74040913c629e32016a972ed21192d83be581d54ee89', '[\"role:customer\"]', '2025-03-05 14:07:44', '2025-03-05 14:06:08', '2025-03-05 14:07:44'),
(200, 'App\\Models\\User', 6, 'mobile', 'a59a0040ab627f0186a8cbe952077a7ccc7790b938b67a35d5fed92b12d93e17', '[\"role:customer\"]', '2025-03-05 14:51:02', '2025-03-05 14:41:48', '2025-03-05 14:51:02'),
(201, 'App\\Models\\User', 6, 'mobile', '1b0d2561717b6f29e9de1c66c7c84add0c342498b3145de6dada7f8d33b69e24', '[\"role:customer\"]', '2025-03-05 14:52:54', '2025-03-05 14:44:03', '2025-03-05 14:52:54'),
(202, 'App\\Models\\User', 6, 'mobile', '148c744f2dfea97ae1a5d1947aff7232729a849b3283ca21ffefae59fb87819e', '[\"role:customer\"]', '2025-03-05 14:52:48', '2025-03-05 14:51:13', '2025-03-05 14:52:48'),
(203, 'App\\Models\\User', 15, 'mobile', 'e1b69e480a9a6356f4d87fc6fd058b37bfad6313146d9dc1f05b740b66c7dd42', '[\"role:customer\"]', '2025-03-11 16:22:57', '2025-03-11 16:18:18', '2025-03-11 16:22:57'),
(204, 'App\\Models\\User', 4, 'mobile', '493ce4c307c969e4473d8f00f1491f172c2a95a73993cd7022a70bad041c4e88', '[\"role:customer\"]', '2025-03-11 16:26:51', '2025-03-11 16:20:00', '2025-03-11 16:26:51'),
(205, 'App\\Models\\User', 4, 'mobile', '14a4ac19109272e094849f0df31d593b75c644aa2de1bc53e21b04cd2d4d6b4e', '[\"role:customer\"]', '2025-03-12 18:30:36', '2025-03-12 18:28:42', '2025-03-12 18:30:36'),
(206, 'App\\Models\\User', 4, 'mobile', '47cc01b78a84314e998cd432e28b05f0ac71d0be5f4950e692135b9ddc69d511', '[\"role:customer\"]', NULL, '2025-03-17 11:10:06', '2025-03-17 11:10:06'),
(207, 'App\\Models\\User', 4, 'mobile', '09685f25429c5870a55a834b67b9ab896f3c87b7876435bf8640d7180ba9e6a1', '[\"role:customer\"]', NULL, '2025-04-03 11:15:41', '2025-04-03 11:15:41'),
(208, 'App\\Models\\User', 6, 'mobile', 'b5effbde3a8c8d691d88286c21390e9380b7b42ac8921cb35cf3503f4a8ca385', '[\"role:customer\"]', '2025-04-03 15:33:37', '2025-04-03 15:31:30', '2025-04-03 15:33:37'),
(209, 'App\\Models\\User', 6, 'mobile', '46050e0e785c6ca42f7f29ce4adc448a39531d3c21b48181e2ce5efde75bca74', '[\"role:customer\"]', '2025-04-03 16:12:35', '2025-04-03 16:10:58', '2025-04-03 16:12:35'),
(210, 'App\\Models\\User', 4, 'mobile', '71b65e9518d29feda783c67c6b828d7e88fa7c3029186b740db18297ad33067e', '[\"role:customer\"]', '2025-04-03 19:00:05', '2025-04-03 18:50:53', '2025-04-03 19:00:05'),
(211, 'App\\Models\\User', 4, 'mobile', 'cbe1922e988f892ad7705971664b0629ff6f36cafa1614a8ee9e7ef6843a7202', '[\"role:customer\"]', '2025-04-04 11:22:26', '2025-04-04 11:16:44', '2025-04-04 11:22:26'),
(212, 'App\\Models\\User', 4, 'mobile', 'a4d09ffe99e8c035b315349aae9d24698c2b95e058d638259f7dab2908fdf1bf', '[\"role:customer\"]', '2025-04-24 23:20:00', '2025-04-04 11:48:57', '2025-04-24 23:20:00'),
(213, 'App\\Models\\User', 4, 'mobile', '8b622a618c9a8c4df576c2493c457c2f046c0eb5c915d57c81e832a5c0694058', '[\"role:customer\"]', '2025-04-07 18:27:16', '2025-04-07 12:07:29', '2025-04-07 18:27:16'),
(218, 'App\\Models\\User', 4, 'mobile', 'e2c69e1a38866bd841472bb63ba454bde4bd84b13e247ef793a0f2447dbbbb10', '[\"role:customer\"]', NULL, '2025-04-07 18:20:33', '2025-04-07 18:20:33'),
(219, 'App\\Models\\User', 4, 'mobile', '02f47815078ca4231ee7d9cd707f9bcd9834ea25c7cbcc1a7448a261ecfdac46', '[\"role:customer\"]', '2025-04-08 19:03:40', '2025-04-08 18:22:20', '2025-04-08 19:03:40'),
(223, 'App\\Models\\User', 4, 'mobile', '7c89464d4baa164c3a864c2d7b92f2558066d4f5edeaeb9420eec3cb539be392', '[\"role:customer\"]', '2025-04-09 13:01:56', '2025-04-09 12:49:54', '2025-04-09 13:01:56'),
(224, 'App\\Models\\User', 4, 'mobile', '405d2a8579b317b7313c0a6cde1da6e6c0e8b64664770de1daeac670cc2fd5d2', '[\"role:customer\"]', '2025-04-22 15:52:38', '2025-04-22 15:15:38', '2025-04-22 15:52:38'),
(226, 'App\\Models\\User', 4, 'mobile', 'e5cae8ce56d34530c670c06fdc720415fb55d5b707432b52eff139d09bfcb293', '[\"role:customer\"]', NULL, '2025-04-30 16:45:53', '2025-04-30 16:45:53'),
(228, 'App\\Models\\User', 4, 'mobile', '9862d176417f600db178961174ba7f0ed158bf320d5dbfc05c4424231c4b974d', '[\"role:customer\"]', '2025-04-30 18:25:09', '2025-04-30 16:56:10', '2025-04-30 18:25:09'),
(229, 'App\\Models\\User', 4, 'mobile', 'fc0421692f6e13747e31f8234e11e25edd2a14e6dc5528700d47da7324f86292', '[\"role:customer\"]', '2025-04-30 17:33:45', '2025-04-30 17:32:28', '2025-04-30 17:33:45'),
(234, 'App\\Models\\User', 4, 'mobile', '41a1a15ded96035b057c2792d178e0f1f0e56cd6fd5c5de43547895e74e57553', '[\"role:customer\"]', NULL, '2025-05-09 17:03:18', '2025-05-09 17:03:18'),
(235, 'App\\Models\\User', 4, 'mobile', '9d92bcae9f29db337c8f5062bd3afa25c65137cbcb129dcac4af3b80295f969c', '[\"role:customer\"]', '2025-05-09 17:11:03', '2025-05-09 17:04:06', '2025-05-09 17:11:03'),
(236, 'App\\Models\\User', 6, 'mobile', 'a881c32396e09975993273a1dc7fd6a3b4dee476f9b24412ee4e63e9884c8a91', '[\"role:customer\"]', '2025-05-09 20:05:27', '2025-05-09 20:04:37', '2025-05-09 20:05:27'),
(237, 'App\\Models\\User', 6, 'mobile', '06c77aae410c163767abf809bc6f4d5cc49e9c0d69ff902a4d8e890b9d1301b0', '[\"role:customer\"]', '2025-05-09 20:05:53', '2025-05-09 20:05:10', '2025-05-09 20:05:53'),
(238, 'App\\Models\\User', 6, 'mobile', '28d6c19dc0651910257a8cd3bf9214be2c69c8e079cd7f42666930e4aad57417', '[\"role:customer\"]', '2025-05-09 20:08:02', '2025-05-09 20:07:21', '2025-05-09 20:08:02'),
(239, 'App\\Models\\User', 6, 'mobile', '9eb06b0770afae5043ca030aee89bd29e1b0301b8db11edb90dd390e59673fee', '[\"role:customer\"]', '2025-05-09 20:35:44', '2025-05-09 20:32:34', '2025-05-09 20:35:44'),
(240, 'App\\Models\\User', 6, 'mobile', 'b71cc2edc80047c7958c024bf58a6605a2cc85f3e30eca9fdc01d2067d471d7b', '[\"role:customer\"]', '2025-05-09 21:30:29', '2025-05-09 21:08:26', '2025-05-09 21:30:29'),
(241, 'App\\Models\\User', 6, 'mobile', 'c4f758f820422596c177b47e2b8775f9fa29833550f2591ee7ba0d89c51ac607', '[\"role:customer\"]', '2025-05-11 15:26:43', '2025-05-11 15:25:58', '2025-05-11 15:26:43'),
(242, 'App\\Models\\User', 17, 'mobile', '2ac769efd25f959e0a5fb57560d71df91c951a0e5a35f9ef926cc80f70978730', '[\"role:customer\"]', '2025-06-03 09:53:20', '2025-05-11 23:03:20', '2025-06-03 09:53:20'),
(243, 'App\\Models\\User', 18, 'mobile', '5e6b6bb62cd30ae8aa0785989c8bf29394b28bd775fa7fb0bfca9f9fc4fbb75b', '[\"role:customer\"]', NULL, '2025-05-12 10:15:50', '2025-05-12 10:15:50'),
(244, 'App\\Models\\User', 18, 'mobile', 'ee093b7291aa6bd0d64a05a59ada5d3ca1d93b8d751e02113944ebb4e20c12c8', '[\"role:customer\"]', '2025-05-12 10:17:11', '2025-05-12 10:16:21', '2025-05-12 10:17:11'),
(248, 'App\\Models\\User', 6, 'mobile', 'bbfd182d1161f7734ebe2fce5dc7831e9f9b67b0d48c14f26863c47683fffdc4', '[\"role:customer\"]', '2025-05-13 08:42:12', '2025-05-13 08:39:40', '2025-05-13 08:42:12'),
(249, 'App\\Models\\User', 6, 'mobile', 'a47cbf0f732aa99ca2ead45535408525b0ef07e1de24a4d284d5d0392256c1fe', '[\"role:customer\"]', '2025-05-13 08:44:19', '2025-05-13 08:39:41', '2025-05-13 08:44:19'),
(250, 'App\\Models\\User', 6, 'mobile', '00b35ea13762d675f69ba491f9bc99181dc7043693e521d9b80af44fd370618f', '[\"role:customer\"]', '2025-05-14 07:03:23', '2025-05-14 07:02:27', '2025-05-14 07:03:23'),
(251, 'App\\Models\\User', 19, 'mobile', '273519a207057b37f4348e0f6e680b308e81333c8da013b26f7144a9cdc42c08', '[\"role:customer\"]', NULL, '2025-05-15 17:18:19', '2025-05-15 17:18:19'),
(253, 'App\\Models\\User', 4, 'mobile', '9088122f50f2529a1a8851a136cdc65e8213374f9003862c003a16588ae5601d', '[\"role:customer\"]', '2025-05-19 18:21:53', '2025-05-19 18:19:21', '2025-05-19 18:21:53'),
(254, 'App\\Models\\User', 4, 'mobile', '4116708f1aef38451b62f53688b4f32db546e25c8826ab00baa5c1de06c16145', '[\"role:customer\"]', '2025-05-19 19:10:56', '2025-05-19 18:57:20', '2025-05-19 19:10:56'),
(257, 'App\\Models\\User', 20, 'mobile', '4f7ee69d3636e3a352e436a40342dc7b7cf74e5ee984b7f6137c07a27667eeaf', '[\"role:customer\"]', '2025-05-21 13:13:41', '2025-05-21 12:42:07', '2025-05-21 13:13:41'),
(256, 'App\\Models\\User', 4, 'mobile', '6cb543b2bd70a3fdc97664b8b54cb1bf19a4394c384d50482d24a2df4245f35c', '[\"role:customer\"]', '2025-06-18 16:36:17', '2025-05-21 12:23:57', '2025-06-18 16:36:17'),
(258, 'App\\Models\\User', 21, 'mobile', 'dc9c12528879512174d73a19fb7493aaf168765a35f1fc3b04790b46e6b250b1', '[\"role:customer\"]', '2025-05-21 13:54:09', '2025-05-21 13:52:55', '2025-05-21 13:54:09'),
(260, 'App\\Models\\User', 22, 'mobile', '1e38f6e4a8116ff6aafe75b18c89f9f2e37d241f5acc1de2ab6da849303eb605', '[\"role:customer\"]', '2025-05-21 13:59:37', '2025-05-21 13:59:14', '2025-05-21 13:59:37'),
(261, 'App\\Models\\User', 23, 'mobile', '4c682b4e2e957385a1f5f5827198b93a596c94c4827f3ce3f8af36457f7770f5', '[\"role:customer\"]', '2025-05-21 14:02:32', '2025-05-21 14:01:48', '2025-05-21 14:02:32'),
(262, 'App\\Models\\User', 24, 'mobile', 'd0cca58a3b909d5068b5e218f48eaada9a074884b1c65d1cd918f057c5cbdf1f', '[\"role:customer\"]', '2025-05-21 14:06:09', '2025-05-21 14:05:28', '2025-05-21 14:06:09'),
(263, 'App\\Models\\User', 25, 'mobile', 'd78d905422148c182bba2452943b006d6e4250a2bc72e62ceeea904596a53ca4', '[\"role:customer\"]', '2025-05-21 14:09:33', '2025-05-21 14:09:07', '2025-05-21 14:09:33'),
(265, 'App\\Models\\User', 26, 'mobile', '03be2bc2a971b4e343f6dae29a2ddd31a351e5ff32c718dacd87975e57c522d2', '[\"role:customer\"]', '2025-05-21 14:14:05', '2025-05-21 14:14:00', '2025-05-21 14:14:05'),
(266, 'App\\Models\\User', 27, 'mobile', '762c7963923b423669635556b8756c302a62cb76e4404186c7f669347ea4a99a', '[\"role:customer\"]', NULL, '2025-05-21 14:23:00', '2025-05-21 14:23:00'),
(267, 'App\\Models\\User', 27, 'mobile', '22f170991fe708912afdbd2618d2811c9e843a661f852268acfc650fdc512bb5', '[\"role:customer\"]', '2025-05-21 14:23:30', '2025-05-21 14:23:23', '2025-05-21 14:23:30'),
(269, 'App\\Models\\User', 6, 'mobile', '51f5865376befbc09cdd6cf13f345948ef8b789457bec9dc2933c3467cd9cef3', '[\"role:customer\"]', '2025-05-23 20:29:03', '2025-05-23 20:28:58', '2025-05-23 20:29:03'),
(270, 'App\\Models\\User', 6, 'mobile', '0d3c5cae7253652165810ce988b36138393657d1d523d9fbc175f58ef0389c31', '[\"role:customer\"]', NULL, '2025-05-23 20:29:07', '2025-05-23 20:29:07'),
(272, 'App\\Models\\User', 6, 'mobile', '8ae016a68283827c17cd32b598f07888dc4d0c3755a97746b0ad3792a78ee34a', '[\"role:customer\"]', '2025-05-26 10:40:01', '2025-05-26 10:39:31', '2025-05-26 10:40:01'),
(273, 'App\\Models\\User', 28, 'mobile', '0afba8dc1551f9b3275a42d3dee3c9497ddd4099a43971d8f7187878ed79add1', '[\"role:customer\"]', NULL, '2025-05-27 18:13:06', '2025-05-27 18:13:06'),
(274, 'App\\Models\\User', 4, 'mobile', 'a653798ee8de698d978eb179eaf1876ee74f486d993e21a177791fb6124bf474', '[\"role:customer\"]', '2025-05-28 18:04:14', '2025-05-28 13:37:44', '2025-05-28 18:04:14'),
(275, 'App\\Models\\User', 6, 'mobile', '8a595affa7af0c85bc9c0a24c520997d9cf5bb17a682d6e184467bd50cbc55b2', '[\"role:customer\"]', '2025-05-29 18:20:21', '2025-05-29 18:08:13', '2025-05-29 18:20:21'),
(276, 'App\\Models\\User', 29, 'mobile', 'cefacbc88ace106761318fa2787d218df0262b6018dca2bded77c3fb5f734645', '[\"role:customer\"]', '2025-05-30 12:29:42', '2025-05-30 12:24:00', '2025-05-30 12:29:42'),
(277, 'App\\Models\\User', 29, 'mobile', '6ae55a48a58117f710d644e7c734761184493d46bfb0c3a34671988c8ec7a0e4', '[\"role:customer\"]', '2025-05-30 16:06:23', '2025-05-30 16:03:48', '2025-05-30 16:06:23'),
(278, 'App\\Models\\User', 6, 'mobile', 'd5fc41e915b8ce89523125da048f0a413bf14f9fbb128b2765ed4af646379234', '[\"role:customer\"]', '2025-06-01 17:50:46', '2025-06-01 17:46:20', '2025-06-01 17:50:46'),
(282, 'App\\Models\\User', 6, 'mobile', 'e124ef5076b27af787654673450028ede47af4ae35d012090041f65245f98a8f', '[\"role:customer\"]', '2025-06-03 15:55:19', '2025-06-03 15:54:24', '2025-06-03 15:55:19'),
(283, 'App\\Models\\User', 6, 'mobile', 'bda8ea9feb17341c36a0a65a548f69536d3449ab426a31de65d2e32b3133ed6b', '[\"role:customer\"]', '2025-06-03 17:56:34', '2025-06-03 15:55:41', '2025-06-03 17:56:34'),
(284, 'App\\Models\\User', 4, 'mobile', '11c0346a293057d8e818cfe3a01d990c71ebb27a71af2cdc9bc31808f298bea2', '[\"role:customer\"]', '2025-06-03 16:39:48', '2025-06-03 16:07:32', '2025-06-03 16:39:48'),
(288, 'App\\Models\\User', 6, 'mobile', '8f97774fcad447e61ec8d266051bb2f1abffdbeab14a2c94e52664d938df231c', '[\"role:customer\"]', '2025-06-04 13:28:41', '2025-06-04 11:57:15', '2025-06-04 13:28:41'),
(289, 'App\\Models\\User', 4, 'mobile', '20fd8e864f862ee468d34f058857d99021d669c08c9bcf72a0dc36b313cdab41', '[\"role:customer\"]', '2025-06-06 15:15:39', '2025-06-04 12:06:34', '2025-06-06 15:15:39'),
(292, 'App\\Models\\User', 6, 'mobile', '0ea69773b83ca83f7d0b43ef0c2f09dfbe9bb63a10c6025aabe115226b9f5147', '[\"role:customer\"]', '2025-06-05 10:22:03', '2025-06-04 20:04:52', '2025-06-05 10:22:03'),
(311, 'App\\Models\\User', 6, 'mobile', '6075e580d6914551bb6bc88650ecbf8c34394ee6d10c164bd4c6c60ca42aae5f', '[\"role:customer\"]', '2025-06-09 22:25:14', '2025-06-09 22:24:40', '2025-06-09 22:25:14'),
(294, 'App\\Models\\User', 6, 'mobile', '589964b450d7cc180077194f6cbf19ec436dc864d46409be17e3643141d473f5', '[\"role:customer\"]', '2025-06-05 10:49:32', '2025-06-05 10:49:15', '2025-06-05 10:49:32'),
(295, 'App\\Models\\User', 30, 'mobile', '960382008a6424444cdda033871685f7c149b687bd85e3f57c6cf95c80f2e58a', '[\"role:customer\"]', NULL, '2025-06-05 20:04:25', '2025-06-05 20:04:25'),
(297, 'App\\Models\\User', 6, 'mobile', 'dc10b6bdd041ddef371cd6ec5037e17b8e2c6b8c5c895d5bdf61ccb5acb37622', '[\"role:customer\"]', '2025-06-05 21:47:20', '2025-06-05 21:06:08', '2025-06-05 21:47:20'),
(298, 'App\\Models\\User', 6, 'mobile', '7173d0eb84aa99225814c5952a5fdb513eab89b381390696ccd2f332a68bd373', '[\"role:customer\"]', '2025-06-06 10:38:21', '2025-06-06 10:23:13', '2025-06-06 10:38:21'),
(299, 'App\\Models\\User', 6, 'mobile', '3594e30c4aca3838f9ca0062ed31c6760a7a0a2f3f4f8d685d3d5e5e7e7ea074', '[\"role:customer\"]', '2025-06-06 11:52:03', '2025-06-06 11:11:03', '2025-06-06 11:52:03'),
(300, 'App\\Models\\User', 31, 'mobile', 'b4a075cae1b588965a63a30140bac150fd1147dbfb386d022ec1920e302e3666', '[\"role:customer\"]', NULL, '2025-06-06 13:47:57', '2025-06-06 13:47:57'),
(301, 'App\\Models\\User', 32, 'mobile', '0aec2746a476bbfb99e23bb1aca4b838ff21b3f4966449453a7191c6993ff145', '[\"role:customer\"]', NULL, '2025-06-06 13:50:11', '2025-06-06 13:50:11'),
(302, 'App\\Models\\User', 6, 'mobile', '2819bdbfb72b19db037ed6cc20d44c08b8b4bd3fd20a0b7e501f1cae9428450f', '[\"role:customer\"]', '2025-06-06 15:18:27', '2025-06-06 15:13:57', '2025-06-06 15:18:27'),
(304, 'App\\Models\\User', 6, 'mobile', '384c9b8959fa0671dd2bfbf743b6015b4031d0942525770c108d700563e19658', '[\"role:customer\"]', '2025-06-06 17:11:29', '2025-06-06 16:34:57', '2025-06-06 17:11:29'),
(305, 'App\\Models\\User', 6, 'mobile', 'cd2659c049036fb2b1430d93cc97fd9b83eaba0dc644c90a3b9a38139a20f83a', '[\"role:customer\"]', '2025-06-06 21:20:36', '2025-06-06 21:16:50', '2025-06-06 21:20:36'),
(306, 'App\\Models\\User', 33, 'mobile', 'd1229e3a02be0b0b7dfbb2f44191264e3580328d1192ba627128fd28272a18d0', '[\"role:customer\"]', NULL, '2025-06-07 14:17:17', '2025-06-07 14:17:17'),
(314, 'App\\Models\\User', 6, 'mobile', '99b09d02ec9d55ec3fd89a8a45b25e32d2577bc8b59bd0aae6b03e8fa0e77c23', '[\"role:customer\"]', '2025-06-10 12:35:39', '2025-06-10 11:45:14', '2025-06-10 12:35:39'),
(309, 'App\\Models\\User', 4, 'mobile', 'fe5cf40f6cf262caf00433732eb4e70c86791011422f6bbfc6f95bae15dba1ff', '[\"role:customer\"]', '2025-06-09 19:00:50', '2025-06-09 18:58:37', '2025-06-09 19:00:50'),
(310, 'App\\Models\\User', 34, 'mobile', '05161e1f7c78415784a4ae4db7046777d2f6a60be8c891061d1fc705688d9ae6', '[\"role:customer\"]', NULL, '2025-06-09 22:10:44', '2025-06-09 22:10:44'),
(312, 'App\\Models\\User', 35, 'mobile', '3c95ec97749d0c1801a5b4f7ada1757ee2373a6174fda4a94226aaecb9ba7582', '[\"role:customer\"]', NULL, '2025-06-09 23:33:13', '2025-06-09 23:33:13'),
(313, 'App\\Models\\User', 35, 'mobile', '494fcdfee3e7e1866f7bcd1cd74edec85365dfd3646ede244259c4e070dab2ba', '[\"role:customer\"]', '2025-06-09 23:35:03', '2025-06-09 23:34:00', '2025-06-09 23:35:03'),
(316, 'App\\Models\\User', 6, 'mobile', 'f3e9c4db37505678aa062eac64eac94e603bd505b5cdab987229a819c681f8cd', '[\"role:customer\"]', '2025-06-10 22:11:54', '2025-06-10 21:18:52', '2025-06-10 22:11:54'),
(317, 'App\\Models\\User', 6, 'mobile', '3512009995e9d5934f0899d495e66131ed3b3ccf8331d3a7dcc37a9a2c1181a0', '[\"role:customer\"]', NULL, '2025-06-11 11:18:16', '2025-06-11 11:18:16'),
(318, 'App\\Models\\User', 4, 'mobile', '19e1fdd52fd7cd6d1ea95fbae51d870b6535c0ed9d9b9865c88fea2c4b7492a5', '[\"role:customer\"]', '2025-06-11 12:24:09', '2025-06-11 11:37:38', '2025-06-11 12:24:09'),
(319, 'App\\Models\\User', 4, 'mobile', 'b77cf8fcc6260edb1e94233a155bd00619a8ac6e43565082114e706594534f2d', '[\"role:customer\"]', '2025-06-11 18:21:42', '2025-06-11 12:26:23', '2025-06-11 18:21:42'),
(320, 'App\\Models\\User', 6, 'mobile', 'f8477fa3ab70f279ba050f4508730a472458e3beb90293fddeff99a1805ce8ff', '[\"role:customer\"]', '2025-06-11 15:02:58', '2025-06-11 15:01:01', '2025-06-11 15:02:58'),
(321, 'App\\Models\\User', 6, 'mobile', '8c6e11b85a3fa7774e1578d05a66398a454a248c71d53793a34baabe78abd810', '[\"role:customer\"]', '2025-06-11 15:03:10', '2025-06-11 15:01:06', '2025-06-11 15:03:10'),
(322, 'App\\Models\\User', 6, 'mobile', '97b580286668d86c657d6858d991899da406ff6e46b243dd8101af55f9c34132', '[\"role:customer\"]', '2025-06-11 15:02:59', '2025-06-11 15:01:36', '2025-06-11 15:02:59'),
(337, 'App\\Models\\User', 42, 'mobile', 'f156244e99f66232467f91beb8e458a7601ede8065fb150676da72485761e17b', '[\"role:customer\"]', NULL, '2025-06-11 19:12:18', '2025-06-11 19:12:18'),
(324, 'App\\Models\\User', 36, 'mobile', '749ff44d3964dfa94a3f26f34b7988cf01829342bbf24174309f3b838691ee82', '[\"role:customer\"]', NULL, '2025-06-11 18:25:14', '2025-06-11 18:25:14');
INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(325, 'App\\Models\\User', 37, 'mobile', '3d57fb08399c97f2ca6ef7ad1f1661c0c57ee751aaf6f8bf15e65ad2304c00ae', '[\"role:customer\"]', NULL, '2025-06-11 18:28:26', '2025-06-11 18:28:26'),
(326, 'App\\Models\\User', 37, 'mobile', '42f5c04489d421af227183cf22698a412dcf1e5f519bf9ae1e4c9f5cd932240f', '[\"role:customer\"]', '2025-06-11 18:56:03', '2025-06-11 18:28:30', '2025-06-11 18:56:03'),
(327, 'App\\Models\\User', 38, 'mobile', 'dd9ce8f41a07421304ce5e6ad58b4717c6e63fe044b0dcae17e19788ece36c84', '[\"role:customer\"]', NULL, '2025-06-11 18:30:09', '2025-06-11 18:30:09'),
(328, 'App\\Models\\User', 38, 'mobile', '89b549a69e038d4c1e7fe992d6b94e8448efcb7be9c3400ebde5cff41d641656', '[\"role:customer\"]', '2025-06-11 18:40:56', '2025-06-11 18:30:50', '2025-06-11 18:40:56'),
(329, 'App\\Models\\User', 39, 'mobile', '278cf4374a4f59723d973d13223207fca6e7cc22f1229c4071e4c289c0c85b85', '[\"role:customer\"]', NULL, '2025-06-11 18:35:06', '2025-06-11 18:35:06'),
(330, 'App\\Models\\User', 39, 'mobile', '48e47aef2584821ffa81f6e9746547341704499a22364bb574e779d3c8406ecb', '[\"role:customer\"]', '2025-06-26 21:23:15', '2025-06-11 18:35:30', '2025-06-26 21:23:15'),
(331, 'App\\Models\\User', 40, 'mobile', '0c43b4316e60e94bc481a069d75407ed3c0fbcdaaddf8f8a622111f68b264b78', '[\"role:customer\"]', NULL, '2025-06-11 18:47:04', '2025-06-11 18:47:04'),
(332, 'App\\Models\\User', 40, 'mobile', 'a472188e14d3f401116c0c8cff17c0a2e3468df3801a6576e2fdc5102908899b', '[\"role:customer\"]', '2025-06-11 18:50:09', '2025-06-11 18:47:45', '2025-06-11 18:50:09'),
(334, 'App\\Models\\User', 37, 'mobile', 'b98a6e4ea910ed9873fdcd2b9ad6bc64750836ee317edb69cb130f76326e653f', '[\"role:customer\"]', '2025-07-14 19:31:48', '2025-06-11 18:58:22', '2025-07-14 19:31:48'),
(335, 'App\\Models\\User', 41, 'mobile', '2ac70459a4bba9de069d5416e3ca090e4d37557cb83b9cc91e0c163782b94055', '[\"role:customer\"]', NULL, '2025-06-11 18:58:32', '2025-06-11 18:58:32'),
(336, 'App\\Models\\User', 41, 'mobile', 'fd4ce0108fcc5ecb746f9b51cdd3ca27f9a8d3cd4374f8cfeed4dc872253d4fa', '[\"role:customer\"]', NULL, '2025-06-11 18:58:55', '2025-06-11 18:58:55'),
(338, 'App\\Models\\User', 42, 'mobile', '6915b848d0824c38d1203a823cd8f4750392035962b7cae77b651aa1411f7b1a', '[\"role:customer\"]', '2025-06-11 19:29:10', '2025-06-11 19:12:40', '2025-06-11 19:29:10'),
(340, 'App\\Models\\User', 42, 'mobile', '9aa005c85f714e9c35bf387c3d79845b2cb186ee87609fce75ccc91aef93b461', '[\"role:customer\"]', '2025-06-12 00:23:53', '2025-06-11 19:47:54', '2025-06-12 00:23:53'),
(341, 'App\\Models\\User', 43, 'mobile', '9acb6fea29ee0cc8d341f4084bbf22011b84ea5662a9fcce08fc072f3e6e58b2', '[\"role:customer\"]', NULL, '2025-06-11 20:12:56', '2025-06-11 20:12:56'),
(342, 'App\\Models\\User', 43, 'mobile', '983cdbe909e7d0125935bbffbc3e929613e7ff14b1bea5d29cce0c51af8b60e8', '[\"role:customer\"]', '2025-06-13 20:34:30', '2025-06-11 20:13:46', '2025-06-13 20:34:30'),
(343, 'App\\Models\\User', 44, 'mobile', '87fa86c08653f12908b85b9d85ff027d92b649956224fcd50316a11922967167', '[\"role:customer\"]', NULL, '2025-06-11 20:19:11', '2025-06-11 20:19:11'),
(344, 'App\\Models\\User', 44, 'mobile', '689d964ecb55811756b1b6bdb776c322bd7e8c4fed8bdf4ed08f3517d125f6f3', '[\"role:customer\"]', '2025-06-14 22:00:55', '2025-06-11 20:19:31', '2025-06-14 22:00:55'),
(348, 'App\\Models\\User', 4, 'mobile', '7420eb1893e2c3d261f12e7b54eeba10c1d42257571e66a8a8e71dca1dc8e614', '[\"role:customer\"]', '2025-06-16 16:32:36', '2025-06-12 14:18:33', '2025-06-16 16:32:36'),
(346, 'App\\Models\\User', 4, 'mobile', '385eeb4b8fc547dd34399b480f524ad7b2f31efdd667fe982229f725872674d2', '[\"role:customer\"]', '2025-06-12 13:47:03', '2025-06-12 13:33:26', '2025-06-12 13:47:03'),
(347, 'App\\Models\\User', 4, 'mobile', '523f2d47811bb170ff870b02d1d6c9ed2327e6360164b85f6f72def723ff3594', '[\"role:customer\"]', '2025-06-12 14:18:17', '2025-06-12 14:07:14', '2025-06-12 14:18:17'),
(370, 'App\\Models\\User', 4, 'mobile', '8051c4ea8c0c110eec2f58ae74ada0e574e895b5383b0c62b91efcbf2ccad7ff', '[\"role:customer\"]', '2025-06-16 11:29:23', '2025-06-16 11:00:11', '2025-06-16 11:29:23'),
(351, 'App\\Models\\User', 4, 'mobile', '102d1ea51abd55cd696bbb5545e2761b89ef7853a50d2b6e865e6751c2049138', '[\"role:customer\"]', '2025-06-12 16:47:04', '2025-06-12 15:17:31', '2025-06-12 16:47:04'),
(354, 'App\\Models\\User', 4, 'mobile', 'df8001a8ff8eaef3a9f9674880f0ed236c2b553b3b74d18520791544f074420b', '[\"role:customer\"]', '2025-06-12 16:58:41', '2025-06-12 16:47:49', '2025-06-12 16:58:41'),
(355, 'App\\Models\\User', 42, 'mobile', '206b6b1b56f13ae220b3bb5590354938a450619a6d89c58fa37431996dfe4926', '[\"role:customer\"]', '2025-06-12 17:34:52', '2025-06-12 16:51:07', '2025-06-12 17:34:52'),
(356, 'App\\Models\\User', 42, 'mobile', '4a2dde64a7304b4f0a9a6efa733ecd7dae746c6f9d1d3ecbce2f35c2bd511bf0', '[\"role:customer\"]', '2025-06-13 17:44:21', '2025-06-12 17:37:25', '2025-06-13 17:44:21'),
(357, 'App\\Models\\User', 45, 'mobile', 'a03751b415c134dd41e967e8a165e3f93b885e96ebd6651eefd6f0eecd097391', '[\"role:customer\"]', NULL, '2025-06-13 09:18:07', '2025-06-13 09:18:07'),
(358, 'App\\Models\\User', 45, 'mobile', '5a0a5e05964ce3bf25e766be5ef27c4ead49fc3ff81363b391f22becff36f8e6', '[\"role:customer\"]', '2025-06-13 19:56:25', '2025-06-13 09:18:28', '2025-06-13 19:56:25'),
(359, 'App\\Models\\User', 4, 'mobile', 'c0ffe2ffb3375615c3d17d4a8f9420b91daf47930bdb131293c721012c1c17b8', '[\"role:customer\"]', '2025-06-13 15:44:11', '2025-06-13 15:42:06', '2025-06-13 15:44:11'),
(360, 'App\\Models\\User', 42, 'mobile', 'f063f2c3f25a8bb904b3ab0d10b04a3a8c397d624238206bb9928013f430e301', '[\"role:customer\"]', '2025-06-13 17:02:58', '2025-06-13 16:52:00', '2025-06-13 17:02:58'),
(363, 'App\\Models\\User', 42, 'mobile', '54b979bf56ebebe2230741215e7b16a0344a966bc9937317e7b7cd538d805972', '[\"role:customer\"]', '2025-06-13 20:45:11', '2025-06-13 20:38:40', '2025-06-13 20:45:11'),
(362, 'App\\Models\\User', 4, 'mobile', '93d7592617e7cf2ceaacb68f031f15eb2845968addc1ea4ca8cb4e84b0693f30', '[\"role:customer\"]', NULL, '2025-06-13 20:33:37', '2025-06-13 20:33:37'),
(364, 'App\\Models\\User', 4, 'mobile', 'c075d6932f28f71d60b31fdddc02378f914a96a8c24418084739335d7804ff32', '[\"role:customer\"]', NULL, '2025-06-13 20:42:22', '2025-06-13 20:42:22'),
(367, 'App\\Models\\User', 42, 'mobile', 'c1975c9f96ee17e5f19b4546215214d08c08b92bebee6a314b6d1c40cf491fb5', '[\"role:customer\"]', NULL, '2025-06-13 21:53:05', '2025-06-13 21:53:05'),
(368, 'App\\Models\\User', 42, 'mobile', '38339b214bed2e9358d834bf3db38750af2a18042bba6f4c95ca2c8e4fad4ed7', '[\"role:customer\"]', NULL, '2025-06-13 21:53:41', '2025-06-13 21:53:41'),
(369, 'App\\Models\\User', 42, 'mobile', 'a2bda92accebdfec6ae4c6b0e9e0fb2470927e5ce60c87c58b9f44be0b1f5f1a', '[\"role:customer\"]', '2025-06-14 07:50:17', '2025-06-14 07:47:04', '2025-06-14 07:50:17'),
(371, 'App\\Models\\User', 4, 'mobile', '42471b754f711a3b686bd6400142cddf39ed8da504ed9cbbf98c7da7d096a2ea', '[\"role:customer\"]', '2025-06-16 14:51:06', '2025-06-16 12:18:24', '2025-06-16 14:51:06'),
(372, 'App\\Models\\User', 4, 'mobile', '21437f8384e9bc58fcd7941fd5b8b900eacd3e625715a652e4fbd41d8c9d6af8', '[\"role:customer\"]', '2025-06-16 19:30:57', '2025-06-16 15:17:31', '2025-06-16 19:30:57'),
(373, 'App\\Models\\User', 42, 'mobile', 'c2d2c9f09d5bbf1093b1765eb1afd032ef6977f9b72aaf3a86829bcda318e012', '[\"role:customer\"]', NULL, '2025-06-16 17:19:06', '2025-06-16 17:19:06'),
(374, 'App\\Models\\User', 42, 'mobile', '807c6715882e3ea4bd9618a5ed1274a96d75a4f6b69b1f303bbf8438666ccdbc', '[\"role:customer\"]', NULL, '2025-06-16 17:20:15', '2025-06-16 17:20:15'),
(375, 'App\\Models\\User', 42, 'mobile', '7a94113821da395d3a93528cddbe99f8c2c4b5d2240e1a1107874c9ede184a9a', '[\"role:customer\"]', NULL, '2025-06-16 17:21:22', '2025-06-16 17:21:22'),
(376, 'App\\Models\\User', 42, 'mobile', 'ccdb5fd51e0d61e7fdb4eeb5a5adfa98c139835b5b756f5ca2022ee809617fcf', '[\"role:customer\"]', '2025-06-16 18:08:35', '2025-06-16 18:05:50', '2025-06-16 18:08:35'),
(377, 'App\\Models\\User', 42, 'mobile', '6aac5eaec91076a9491cefa2c1641755bedb238b4ec6c0584c6ace9bbfa5d02a', '[\"role:customer\"]', NULL, '2025-06-16 19:52:12', '2025-06-16 19:52:12'),
(378, 'App\\Models\\User', 42, 'mobile', '5360ee113134ec0bbdad389fd56936c749d76750e5792f99a2203ea1beb6794a', '[\"role:customer\"]', '2025-06-16 20:03:17', '2025-06-16 20:01:15', '2025-06-16 20:03:17'),
(380, 'App\\Models\\User', 42, 'mobile', '379ff9d6659e975fa7ce0466a01b4d139df217d0c677b5127bd67179f76ca942', '[\"role:customer\"]', '2025-06-16 21:19:53', '2025-06-16 21:07:18', '2025-06-16 21:19:53'),
(381, 'App\\Models\\User', 42, 'mobile', '00997ad4f2874e1d607da096fc39489551c0521912eb39d8648180180a2fabec', '[\"role:customer\"]', '2025-06-16 21:56:57', '2025-06-16 21:52:11', '2025-06-16 21:56:57'),
(382, 'App\\Models\\User', 42, 'mobile', 'ed2933d7c434413cf03baa0c15e4b092009e230fc1069188ba5f30b896d2e853', '[\"role:customer\"]', '2025-06-17 11:14:15', '2025-06-17 11:12:31', '2025-06-17 11:14:15'),
(383, 'App\\Models\\User', 4, 'mobile', 'a6ea8eddb10e41161045fc6d4ba6c635a8b4c9eafce8b7266779e8b8aa9a1cb4', '[\"role:customer\"]', '2025-06-17 18:59:49', '2025-06-17 11:20:37', '2025-06-17 18:59:49'),
(384, 'App\\Models\\User', 4, 'mobile', '2e240faee8a2e7878fbae270257a22e6e9c312645df062e9e1974e81b7f78fb4', '[\"role:customer\"]', '2025-06-17 18:53:47', '2025-06-17 12:28:46', '2025-06-17 18:53:47'),
(385, 'App\\Models\\User', 46, 'mobile', 'a5841a2e97c43dac17a49f6fe5c9ac7a40fa55bcf38609d2442b3a4d0f24f76f', '[\"role:customer\"]', '2025-06-17 18:32:32', '2025-06-17 18:32:04', '2025-06-17 18:32:32'),
(386, 'App\\Models\\User', 46, 'mobile', 'b1b0212bd08a51885dfb4cbd0bca4c6cc8a89e10029227c1bde1b6b2e12e7a1e', '[\"role:customer\"]', '2025-06-28 02:18:45', '2025-06-17 20:26:08', '2025-06-28 02:18:45'),
(388, 'App\\Models\\User', 42, 'mobile', 'a33244ae94910336b8f69b6b895fb425960f9eaa344bd3194e2df981203944fb', '[\"role:customer\"]', '2025-06-18 08:13:36', '2025-06-18 08:11:38', '2025-06-18 08:13:36'),
(389, 'App\\Models\\User', 4, 'mobile', '091419779dec3da25da9a23e87c8b1949836758a51da73e71203cd6278bc1e07', '[\"role:customer\"]', '2025-06-18 16:03:08', '2025-06-18 15:55:15', '2025-06-18 16:03:08'),
(390, 'App\\Models\\User', 4, 'mobile', '025bfe9e6b76a9ee7c9ca4abb6bd5cded07b3a83d5c4af4b90229eba96149ea1', '[\"role:customer\"]', NULL, '2025-06-18 16:36:34', '2025-06-18 16:36:34'),
(391, 'App\\Models\\User', 7, 'mobile', '76667bce49b635a59d3c4d2e2ece47dc4700357d88bb3569d061a0e0f3f99d7c', '[\"role:customer\"]', '2025-06-18 16:40:37', '2025-06-18 16:40:21', '2025-06-18 16:40:37'),
(392, 'App\\Models\\User', 4, 'mobile', '40ce1dc861416ebad530f4bd9f5ce504542995674d94707cb420fdfd0eaf8923', '[\"role:customer\"]', '2025-06-18 16:49:44', '2025-06-18 16:48:24', '2025-06-18 16:49:44'),
(394, 'App\\Models\\User', 42, 'mobile', 'e53e9a12471e3ae642957c5332d3564eed6758c0d0ea02f1e24277758ae8c75e', '[\"role:customer\"]', '2025-06-18 18:42:57', '2025-06-18 18:30:58', '2025-06-18 18:42:57'),
(395, 'App\\Models\\User', 42, 'mobile', '95f13e82234d6722c3204ee3b96173a0f3ed74af9508863bff9e1e507922dfe9', '[\"role:customer\"]', '2025-06-19 04:13:43', '2025-06-19 04:13:34', '2025-06-19 04:13:43'),
(396, 'App\\Models\\User', 48, 'mobile', '30948287156fe321eb5e6742bafe456464520facaf94365dda0734adcfb58ea1', '[\"role:customer\"]', NULL, '2025-06-20 13:34:01', '2025-06-20 13:34:01'),
(397, 'App\\Models\\User', 49, 'mobile', 'e6077f5926ae5dad10ce3079a7818fea5d3e918f1abc8b5b8b02d0f366d51fbe', '[\"role:customer\"]', NULL, '2025-06-20 15:00:14', '2025-06-20 15:00:14'),
(398, 'App\\Models\\User', 50, 'mobile', '6a2e2239d583052f03a71e85829ea2c1927b50224aad6f76def037fa6041e97a', '[\"role:customer\"]', NULL, '2025-06-20 15:02:42', '2025-06-20 15:02:42'),
(399, 'App\\Models\\User', 51, 'mobile', '4c93dfffe8a4225cb3e2359c895ff2e818322896d1cbe2a473e2351c239ee853', '[\"role:customer\"]', NULL, '2025-06-20 15:16:49', '2025-06-20 15:16:49'),
(400, 'App\\Models\\User', 51, 'mobile', '9060e89d0518fa661ddf28a76e9aa34d21dbe556aa8e79015871b3b120467c91', '[\"role:customer\"]', NULL, '2025-06-20 15:21:18', '2025-06-20 15:21:18'),
(401, 'App\\Models\\User', 49, 'mobile', 'ea3996746a035e66b46d52aba71ec24e582ea2dd0b1c0fafed92cedbc7469faf', '[\"role:customer\"]', NULL, '2025-06-20 15:57:46', '2025-06-20 15:57:46'),
(402, 'App\\Models\\User', 18, 'mobile', 'c778a0ef24b65d13b486ffc7faec4def77d096f3bf2225c76a7848bf8084e35b', '[\"role:customer\"]', NULL, '2025-06-20 16:14:18', '2025-06-20 16:14:18'),
(407, 'App\\Models\\User', 6, 'mobile', 'a5a41d1c6820a41223f01e2f8c413d3803834041ef9e21d9da2972f6a843ee78', '[\"role:customer\"]', '2025-06-23 17:01:56', '2025-06-23 17:00:06', '2025-06-23 17:01:56'),
(405, 'App\\Models\\User', 18, 'mobile', '1800c83588e4b9b446ccf3abbff2f6c9dd666b7b988aaf777356aa0e17528925', '[\"role:customer\"]', '2025-06-20 19:58:57', '2025-06-20 19:56:45', '2025-06-20 19:58:57'),
(408, 'App\\Models\\User', 6, 'mobile', 'b2a66fc34d5d915cc5d3ad19aeb0a1bea87524697dafbef51c3123981456a729', '[\"role:customer\"]', '2025-06-25 19:52:25', '2025-06-24 15:54:23', '2025-06-25 19:52:25'),
(409, 'App\\Models\\User', 4, 'mobile', 'a5af4db74b49373a4bd7773ed199212423ee1eeadaa5e147ea7326708b7b3246', '[\"role:customer\"]', '2025-06-26 18:11:39', '2025-06-26 14:55:47', '2025-06-26 18:11:39'),
(410, 'App\\Models\\User', 60, 'mobile', '9268a69298186cd577e408c95b417fa8b83e3ed9c5fca8eebc5e66eab5912fab', '[\"role:customer\"]', '2025-06-26 15:19:08', '2025-06-26 15:13:51', '2025-06-26 15:19:08'),
(411, 'App\\Models\\User', 6, 'mobile', 'ef6ca5831bf663becc7a944104169459145996a4b76e18795d295d9481f8843d', '[\"role:customer\"]', NULL, '2025-06-26 15:48:42', '2025-06-26 15:48:42'),
(413, 'App\\Models\\User', 64, 'mobile', 'b70866f2da7b789fe47b74a770ed13ee00d417583e6c285d050a8bf7807f305f', '[\"role:customer\"]', '2025-06-26 21:32:17', '2025-06-26 21:30:21', '2025-06-26 21:32:17'),
(414, 'App\\Models\\User', 6, 'mobile', '40568f8906c264b3657ddcd97226ae462551a8f4a1cc95f4406cfcaefe91bf4d', '[\"role:customer\"]', NULL, '2025-06-27 14:16:28', '2025-06-27 14:16:28'),
(415, 'App\\Models\\User', 6, 'mobile', '3be13647480d018c28d0583834db1a650bb7ca3b0e23fb207e66a4413ce2a8aa', '[\"role:customer\"]', '2025-06-27 14:30:06', '2025-06-27 14:17:14', '2025-06-27 14:30:06'),
(416, 'App\\Models\\User', 4, 'mobile', '3ea49e74189897f772f6bdac32973f83fd4f080add01cec8ffa91946fd867c77', '[\"role:customer\"]', '2025-06-29 13:07:15', '2025-06-29 12:59:53', '2025-06-29 13:07:15'),
(423, 'App\\Models\\User', 18, 'mobile', '897d1bd8d219e8abcbf0922b9682ace7b875af0d79787d9dd81dd274989d7f84', '[\"role:customer\"]', '2025-07-01 12:53:23', '2025-07-01 12:51:45', '2025-07-01 12:53:23'),
(424, 'App\\Models\\User', 65, 'mobile', '579c1853f346ae0c6deb96b5e33f039a1e046401b2b1e55cb265977d470b2c5e', '[\"role:customer\"]', NULL, '2025-07-10 23:06:52', '2025-07-10 23:06:52'),
(425, 'App\\Models\\User', 65, 'mobile', '59dd04ff5c6039f04206229ff929b7dcd68fbed4d5f3a5ddc6c4537312278574', '[\"role:customer\"]', NULL, '2025-07-10 23:07:30', '2025-07-10 23:07:30'),
(426, 'App\\Models\\User', 68, 'mobile', 'b9bf78c50cf95e35a904205fd817c4079ef988358d62e89e49e153aca4e1618d', '[\"role:customer\"]', '2025-07-15 20:51:56', '2025-07-15 20:47:24', '2025-07-15 20:51:56'),
(428, 'App\\Models\\User', 18, 'mobile', 'c52fb16a32fd430ff2cbcdef26ab1016bb88575d7bd4d9d2f8c5490eefb99ae6', '[\"role:customer\"]', '2025-07-17 13:00:45', '2025-07-17 12:28:02', '2025-07-17 13:00:45'),
(429, 'App\\Models\\User', 18, 'mobile', '76293ee231c6b507617619ebb7466ae1d755720ac0a3a1fa720a7db6c7b71274', '[\"role:customer\"]', '2025-07-18 11:10:44', '2025-07-18 11:10:07', '2025-07-18 11:10:44');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` bigint(11) UNSIGNED NOT NULL,
  `restaurant_id` bigint(20) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(155) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_recommend` varchar(15) DEFAULT 'NO',
  `status` enum('A','D') DEFAULT 'A',
  `created_by` bigint(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category_id`, `restaurant_id`, `price`, `image`, `description`, `is_recommend`, `status`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Mineral Water 1L', 10, 1, 20, 'public/uploads/product/1749749147.png', NULL, 'YES', 'A', NULL, '2024-10-25 15:47:04', '2025-06-12 22:59:54', NULL),
(2, 'Chicken Burnt Garlic Rice', 2, 1, 200, 'public/uploads/product/1749749574.jpg', NULL, 'YES', 'A', NULL, '2024-10-25 15:47:04', '2025-06-12 23:02:54', NULL),
(3, 'Chicken Fried Rice', 2, 1, 180, 'public/uploads/product/1749749476.jpg', 'Delicious Tiramisu Pizza with fresh ingredients.', 'YES', 'A', NULL, '2024-10-25 15:47:04', '2025-06-12 23:01:16', NULL),
(4, 'Chicken Hongkong Noodles', 2, 1, 200, 'public/uploads/product/1749749387.jpg', NULL, 'YES', 'A', NULL, '2024-10-25 15:47:04', '2025-06-12 23:00:09', NULL),
(13, 'Mineral Water 500ml', 10, 1, 10, 'public/uploads/product/1749749296.png', NULL, 'YES', 'A', NULL, '2025-03-23 12:53:17', '2025-06-12 22:58:16', NULL),
(14, 'Chicken Biriyani Half', 1, 1, 150, 'public/uploads/product/1748341322.jpg', 'Chicken Biriyani Half', 'YES', 'A', NULL, '2025-03-23 13:12:25', '2025-05-27 18:08:08', NULL),
(15, 'Bengals Rasogolla Sweets', 1, 1, 100, 'public/uploads/product/1743662071.jpg', 'Indian Rasgulla or Rosogulla dessert/sweet served in a bowl.', 'YES', 'A', NULL, '2025-04-03 12:04:31', '2025-04-03 12:06:12', '2025-04-03 12:06:12'),
(16, 'nooples', 8, NULL, 10, 'public/uploads/product/1743684104.png', 'xczczc', 'NO', 'A', NULL, '2025-04-03 18:11:32', '2025-04-03 18:11:48', '2025-04-03 18:11:48'),
(17, 'Chicken Schezwan Hakka Noodles', 2, NULL, 180, 'public/uploads/product/1750337402.jpg', NULL, 'YES', 'A', NULL, '2025-05-27 17:19:09', '2025-06-19 18:20:02', NULL),
(18, 'Chicken Schezwan Fried Rice', 2, NULL, 180, 'public/uploads/product/1750337350.jpg', NULL, 'YES', 'A', NULL, '2025-05-27 17:20:25', '2025-06-19 18:19:10', NULL),
(19, 'Chicken Singapore Noodles', 2, NULL, 200, 'public/uploads/product/1750337225.jpg', NULL, 'YES', 'A', NULL, '2025-05-27 17:21:27', '2025-06-19 18:17:05', NULL),
(20, 'Chicken Singapore Rice', 2, NULL, 200, 'public/uploads/product/1750337173.jpg', NULL, 'YES', 'A', NULL, '2025-05-27 17:22:00', '2025-06-19 18:16:13', NULL),
(21, 'Chilli Chicken Gravy', 2, NULL, 150, 'public/uploads/product/1750336763.jpg', NULL, 'YES', 'A', NULL, '2025-05-27 17:23:10', '2025-06-19 18:09:23', NULL),
(22, 'Mix Fried Rice', 2, NULL, 190, 'public/uploads/product/1750336726.jpg', NULL, 'YES', 'A', NULL, '2025-05-27 17:23:51', '2025-06-19 18:55:59', NULL),
(23, 'Paneer Chilli Gravy', 2, NULL, 150, 'public/uploads/product/1750336682.jpg', NULL, 'YES', 'A', NULL, '2025-05-27 17:24:42', '2025-06-19 18:08:02', NULL),
(24, 'Triple Schezwan Fried Rice', 2, NULL, 180, 'public/uploads/product/1750336627.jpg', NULL, 'YES', 'A', NULL, '2025-05-27 17:25:15', '2025-06-19 18:07:07', NULL),
(25, 'Veg Fried Rice', 2, NULL, 120, 'public/uploads/product/1749749607.jpg', NULL, 'YES', 'A', NULL, '2025-05-27 17:25:44', '2025-06-19 18:56:21', NULL),
(26, 'Veg Hakka Noodles', 2, NULL, 130, NULL, NULL, 'YES', 'A', NULL, '2025-05-27 17:26:13', '2025-06-12 22:34:09', NULL),
(27, 'Veg Schezwan Fried Rice', 2, NULL, 160, NULL, NULL, 'YES', 'A', NULL, '2025-05-27 17:27:34', '2025-06-12 22:33:47', NULL),
(28, 'Chicken Hot & Sour Soup', 4, NULL, 80, NULL, NULL, 'YES', 'A', NULL, '2025-05-27 17:29:13', '2025-06-12 22:33:20', NULL),
(29, 'Tomato Soup', 4, NULL, 70, NULL, NULL, 'YES', 'A', NULL, '2025-05-27 17:35:57', '2025-06-12 22:32:22', NULL),
(30, 'Veg Hot & Sour Soup', 4, NULL, 50, NULL, NULL, 'YES', 'A', NULL, '2025-05-27 17:36:48', '2025-06-12 22:31:51', NULL),
(31, 'Veg Manchow Soup', 4, NULL, 70, NULL, NULL, 'YES', 'A', NULL, '2025-05-27 17:37:59', '2025-06-12 22:31:27', NULL),
(32, 'Veg Manchuriyan Soup', 4, NULL, 50, NULL, NULL, 'YES', 'A', NULL, '2025-05-27 17:38:58', '2025-06-12 22:30:44', NULL),
(33, 'Apple Chicken Dry (6 Pcs)', 6, NULL, 170, NULL, NULL, 'YES', 'A', NULL, '2025-05-27 17:39:36', '2025-06-12 22:29:57', NULL),
(34, 'Chicken Chilli Dry (8 Pcs)', 6, NULL, 200, NULL, NULL, 'YES', 'A', NULL, '2025-05-27 17:41:31', '2025-06-12 22:28:50', NULL),
(35, 'Chicken Crispy', 6, NULL, 210, NULL, NULL, 'YES', 'A', NULL, '2025-05-27 17:42:20', '2025-06-12 22:28:12', NULL),
(36, 'Chicken Honey Chilli', 6, NULL, 210, NULL, NULL, 'YES', 'A', NULL, '2025-05-27 17:42:46', '2025-06-12 22:27:40', NULL),
(37, 'Chicken Lollipop (6 Pcs)', 6, NULL, 140, NULL, NULL, 'YES', 'A', NULL, '2025-05-27 17:43:18', '2025-06-12 22:26:47', NULL),
(38, 'Chicken Manchuriyan Dry (8 Pcs)', 6, NULL, 180, NULL, NULL, 'YES', 'A', NULL, '2025-05-27 17:43:56', '2025-06-12 22:26:10', NULL),
(39, 'Fish Finger (8 Pcs)', 6, NULL, 200, NULL, NULL, 'YES', 'A', NULL, '2025-05-27 17:44:47', '2025-06-12 22:25:31', NULL),
(40, 'Mashroom Chilli', 6, NULL, 145, NULL, NULL, 'YES', 'A', NULL, '2025-05-27 17:45:18', '2025-06-12 22:24:18', NULL),
(41, 'Paneer Chilli Dry (8 Pcs)', 6, NULL, 150, NULL, NULL, 'YES', 'A', NULL, '2025-05-27 17:45:54', '2025-06-12 22:23:45', NULL),
(42, 'Black Coffee', 8, NULL, 30, 'public/uploads/product/1749554927.jpg', NULL, 'YES', 'A', NULL, '2025-05-27 17:46:46', '2025-06-10 16:58:47', NULL),
(43, 'Cappuccino', 8, NULL, 50, 'public/uploads/product/1749554827.jpg', NULL, 'YES', 'A', NULL, '2025-05-27 17:47:18', '2025-06-10 16:57:19', NULL),
(44, 'Espresso', 8, NULL, 40, 'public/uploads/product/1749554783.jpg', NULL, 'YES', 'A', NULL, '2025-05-27 17:47:36', '2025-06-10 16:56:23', NULL),
(45, 'Latte', 8, NULL, 50, 'public/uploads/product/1749554716.jfif', NULL, 'YES', 'A', NULL, '2025-05-27 17:48:42', '2025-06-10 16:55:16', NULL),
(46, 'Alfredo Pasta', 11, NULL, 150, NULL, NULL, 'YES', 'A', NULL, '2025-05-27 17:49:41', '2025-05-28 20:31:45', NULL),
(47, 'Cheese Chilli Toast (4 Pcs)', 11, NULL, 80, NULL, NULL, 'YES', 'A', NULL, '2025-05-27 17:50:30', '2025-06-10 16:54:13', NULL),
(48, 'Cheese Garlic Bread (4 Pcs)', 11, NULL, 80, NULL, NULL, 'YES', 'A', NULL, '2025-05-27 17:51:14', '2025-06-10 16:54:00', NULL),
(49, 'Chicken Alfredo Pasta', 11, NULL, 150, NULL, NULL, 'YES', 'A', NULL, '2025-05-27 17:51:48', '2025-05-28 20:29:59', NULL),
(50, 'Pasta', 11, NULL, 100, NULL, NULL, 'YES', 'A', NULL, '2025-05-27 17:52:05', '2025-05-28 20:29:43', NULL),
(51, 'Pink Pasta', 11, NULL, 170, NULL, NULL, 'YES', 'A', NULL, '2025-05-27 17:52:35', '2025-05-28 20:29:30', NULL),
(52, 'Cheese Fries', 12, NULL, 120, NULL, NULL, 'YES', 'A', NULL, '2025-05-27 17:53:43', '2025-05-28 20:28:57', NULL),
(53, 'French Fries Peri Peri', 11, NULL, 100, NULL, NULL, 'YES', 'A', NULL, '2025-05-27 17:54:19', '2025-05-28 20:28:31', NULL),
(54, 'Plain Fries', 12, NULL, 60, NULL, NULL, 'YES', 'A', NULL, '2025-05-27 17:54:48', '2025-05-28 20:28:18', NULL),
(55, 'Schezwan Cheese Fries', 12, NULL, 150, NULL, NULL, 'YES', 'A', NULL, '2025-05-27 17:55:32', '2025-05-28 20:28:02', NULL),
(56, 'Butterscotch', 13, NULL, 80, NULL, NULL, 'YES', 'A', NULL, '2025-05-27 17:56:23', '2025-05-27 17:57:25', NULL),
(57, 'Chocolate Ice Cream', 13, NULL, 80, NULL, NULL, 'YES', 'A', NULL, '2025-05-27 17:57:12', '2025-05-27 17:57:12', NULL),
(58, 'Mango Ice Cream', 13, NULL, 80, NULL, NULL, 'YES', 'A', NULL, '2025-05-27 17:58:11', '2025-05-27 17:58:11', NULL),
(59, 'Vanilla Ice Cream', 13, NULL, 80, NULL, NULL, 'YES', 'A', NULL, '2025-05-27 18:00:25', '2025-05-28 20:27:24', NULL),
(60, 'Alu Biriyani Full', 1, NULL, 90, NULL, 'Biriyani Rice,2 Pcs Alu', 'YES', 'A', NULL, '2025-05-27 18:04:46', '2025-05-28 20:26:50', NULL),
(61, 'Alu Biriyani Half', 1, NULL, 70, NULL, 'Biriyani Rice, Alu 1 Pcs', 'YES', 'A', NULL, '2025-05-27 18:06:03', '2025-05-28 20:26:34', NULL),
(62, 'Butter Chicken', 1, NULL, 150, NULL, NULL, 'YES', 'A', NULL, '2025-05-27 18:06:23', '2025-05-28 20:26:17', NULL),
(63, 'Chana Masala', 1, NULL, 90, NULL, NULL, 'YES', 'A', NULL, '2025-05-27 18:06:43', '2025-05-28 20:25:55', NULL),
(64, 'Chicken Bhuna', 1, NULL, 160, NULL, NULL, 'YES', 'A', NULL, '2025-05-27 18:07:02', '2025-05-28 20:25:31', NULL),
(65, 'Chicken Biriyani Full', 1, NULL, 180, NULL, NULL, 'YES', 'A', NULL, '2025-05-27 18:07:29', '2025-05-28 20:25:21', NULL),
(66, 'Chicken Handi (5 Pcs)', 1, NULL, 230, 'public/uploads/product/1750336527.jpg', NULL, 'YES', 'A', NULL, '2025-05-27 18:08:59', '2025-06-19 18:05:27', NULL),
(67, 'Chicken Kolhapuri (5 Pcs)', 1, NULL, 190, 'public/uploads/product/1750336347.jpg', NULL, 'YES', 'A', NULL, '2025-05-27 18:10:00', '2025-06-19 18:02:27', NULL),
(68, 'Chicken Biriyani Half', 1, NULL, 130, 'public/uploads/product/1750336315.jpg', NULL, 'YES', 'A', NULL, '2025-05-28 20:35:50', '2025-06-19 18:01:55', NULL),
(69, 'Chicken Chap', 1, NULL, 80, 'public/uploads/product/1750336231.jpg', NULL, 'YES', 'A', NULL, '2025-05-28 20:37:37', '2025-06-19 18:00:31', NULL),
(70, 'Chicken Masala', 1, NULL, 150, 'public/uploads/product/1750336148.jpg', NULL, 'YES', 'A', NULL, '2025-05-28 20:38:03', '2025-06-19 17:59:08', NULL),
(71, 'Chicken Thali', 1, NULL, 120, 'public/uploads/product/1750336168.jpg', NULL, 'YES', 'A', NULL, '2025-05-28 20:38:55', '2025-06-19 17:59:28', NULL),
(72, 'Chicken Tikka Masala', 1, NULL, 200, 'public/uploads/product/1750335193.jpg', NULL, 'YES', 'A', NULL, '2025-05-28 20:39:17', '2025-06-19 17:43:13', NULL),
(73, 'Dal Khichudi', 1, NULL, 100, 'public/uploads/product/1750335148.jpg', NULL, 'YES', 'A', NULL, '2025-05-28 20:40:16', '2025-06-19 17:42:28', NULL),
(74, 'Dal Palak', 1, NULL, 100, 'public/uploads/product/1750335105.jpg', NULL, 'YES', 'A', NULL, '2025-05-28 20:40:41', '2025-06-19 17:41:45', NULL),
(75, 'Dal Tadka', 1, NULL, 80, 'public/uploads/product/1750335071.jpg', NULL, 'YES', 'A', NULL, '2025-05-28 20:41:10', '2025-06-19 17:41:11', NULL),
(76, 'Fry Papad', 1, NULL, 15, 'public/uploads/product/1750334920.jpg', NULL, 'YES', 'A', NULL, '2025-05-28 20:41:44', '2025-06-19 17:38:40', NULL),
(77, 'Green Salad', 1, NULL, 50, 'public/uploads/product/1750334787.jpg', NULL, 'YES', 'A', NULL, '2025-05-28 20:42:22', '2025-06-19 17:36:27', NULL),
(78, 'Jeera Rice', 1, NULL, 90, 'public/uploads/product/1750334710.jpeg', NULL, 'YES', 'A', NULL, '2025-05-28 20:42:47', '2025-06-19 17:35:10', NULL),
(79, 'Masala Papad', 1, NULL, 25, 'public/uploads/product/1750334513.jpg', NULL, 'YES', 'A', NULL, '2025-05-28 20:43:09', '2025-06-19 17:31:53', NULL),
(80, 'Mix Vegetable', 1, NULL, 130, 'public/uploads/product/1750334405.jpg', NULL, 'YES', 'A', NULL, '2025-05-28 20:44:19', '2025-06-19 17:30:05', NULL),
(81, 'Mutton Bhuna Masala', 1, NULL, 300, 'public/uploads/product/1750333993.jpg', NULL, 'YES', 'A', NULL, '2025-05-28 20:44:52', '2025-06-19 17:23:13', NULL),
(82, 'Mutton Biriyani Full', 1, NULL, 320, 'public/uploads/product/1750333604.jpg', NULL, 'YES', 'A', NULL, '2025-05-28 20:46:21', '2025-06-19 17:16:44', NULL),
(83, 'Mutton Biriyani Half', 1, NULL, 230, 'public/uploads/product/1750333521.jpg', NULL, 'YES', 'A', NULL, '2025-05-28 20:47:07', '2025-06-19 17:15:21', NULL),
(84, 'Mutton Handi', 1, NULL, 250, 'public/uploads/product/1750333443.jpg', NULL, 'YES', 'A', NULL, '2025-05-28 20:48:04', '2025-06-19 17:14:03', NULL),
(85, 'Mutton Rogan Josh', 1, NULL, 350, 'public/uploads/product/1750333328.jpg', NULL, 'YES', 'A', NULL, '2025-05-28 20:49:46', '2025-06-19 17:12:08', NULL),
(86, 'Pahadi Tikka Masala', 1, NULL, 200, 'public/uploads/product/1749747138.jpg', NULL, 'YES', 'A', NULL, '2025-05-28 20:51:14', '2025-06-12 22:22:18', NULL),
(87, 'Paneer Palak', 1, NULL, 150, 'public/uploads/product/1749746594.jpg', NULL, 'YES', 'A', NULL, '2025-05-28 20:51:44', '2025-06-12 22:13:14', NULL),
(88, 'Paneer Butter Masala', 1, NULL, 160, 'public/uploads/product/1749746482.jpg', NULL, 'YES', 'A', NULL, '2025-05-28 20:52:25', '2025-06-12 22:11:22', NULL),
(89, 'Paneer Chatpata Masala', 1, NULL, 180, 'public/uploads/product/1749746421.jpg', NULL, 'YES', 'A', NULL, '2025-05-28 20:53:02', '2025-06-12 22:10:21', NULL),
(90, 'Paneer Matar', 1, NULL, 140, 'public/uploads/product/1749746337.jpg', NULL, 'YES', 'A', NULL, '2025-05-28 20:54:34', '2025-06-12 22:08:57', NULL),
(91, 'Paneer Tikka Masala', 1, NULL, 180, 'public/uploads/product/1749746287.jpg', NULL, 'YES', 'A', NULL, '2025-05-28 20:55:04', '2025-06-12 22:08:07', NULL),
(92, 'Paneer Lajawab', 1, NULL, 180, 'public/uploads/product/1749746213.jpg', NULL, 'YES', 'A', NULL, '2025-05-28 20:55:41', '2025-06-12 22:06:53', NULL),
(93, 'Pomfret Koliwada', 1, NULL, 250, 'public/uploads/product/1749746158.jpg', NULL, 'YES', 'A', NULL, '2025-05-28 20:56:20', '2025-06-12 22:05:58', NULL),
(94, 'Roasted Papad', 1, NULL, 10, 'public/uploads/product/1749745997.jpg', NULL, 'YES', 'A', NULL, '2025-05-28 20:56:50', '2025-06-12 22:03:17', NULL),
(95, 'Veg Kolhapuri', 1, NULL, 145, 'public/uploads/product/1749745914.jpg', NULL, 'YES', 'A', NULL, '2025-05-28 20:58:20', '2025-06-12 22:01:54', NULL),
(96, 'Veg Thali', 1, NULL, 80, 'public/uploads/product/1749745752.jpg', NULL, 'YES', 'A', NULL, '2025-05-28 20:59:30', '2025-06-12 21:59:12', NULL),
(97, 'Chocolate Milkshake', 15, NULL, 100, 'public/uploads/product/1749745703.jpg', NULL, 'YES', 'A', NULL, '2025-05-28 21:03:53', '2025-06-12 21:58:23', NULL),
(98, 'Oreo Milkshake', 15, NULL, 100, 'public/uploads/product/1749745647.jpg', NULL, 'YES', 'A', NULL, '2025-05-28 21:04:48', '2025-06-12 21:57:27', NULL),
(99, 'Blueberry', 15, NULL, 70, 'public/uploads/product/1749745593.jpg', NULL, 'YES', 'A', NULL, '2025-05-28 21:05:47', '2025-06-12 21:56:33', NULL),
(100, 'Cold Coffee', 15, NULL, 80, 'public/uploads/product/1749745314.jpg', NULL, 'YES', 'A', NULL, '2025-05-28 21:08:02', '2025-06-12 21:51:54', NULL),
(101, 'Fresh Lime Soda', 15, NULL, 100, 'public/uploads/product/1749745192.jpg', NULL, 'YES', 'A', NULL, '2025-05-28 21:08:37', '2025-06-12 21:49:52', NULL),
(102, 'Fruit Punch', 15, NULL, 100, 'public/uploads/product/1749744881.jpg', NULL, 'YES', 'A', NULL, '2025-05-28 21:09:26', '2025-06-12 21:44:41', NULL),
(103, 'Jeera Sikanji', 15, NULL, 60, 'public/uploads/product/1749744663.jpg', NULL, 'YES', 'A', NULL, '2025-05-28 21:10:06', '2025-06-12 21:41:03', NULL),
(104, 'Kaccha Mango', 15, NULL, 60, 'public/uploads/product/1749742295.jpg', NULL, 'YES', 'A', NULL, '2025-05-28 21:10:31', '2025-06-12 21:01:35', NULL),
(105, 'Lichi Michi', 15, NULL, 60, 'public/uploads/product/1749742189.jpg', NULL, 'YES', 'A', NULL, '2025-05-28 21:10:58', '2025-06-12 20:59:49', NULL),
(106, 'Mango Crush', 15, NULL, 60, 'public/uploads/product/1749741944.jpg', NULL, 'YES', 'A', NULL, '2025-05-28 21:11:48', '2025-06-12 20:55:44', NULL),
(107, 'Masala Butter Milk', 15, NULL, 50, 'public/uploads/product/1749741696.jpg', NULL, 'YES', 'A', NULL, '2025-05-28 21:12:45', '2025-06-12 20:51:36', NULL),
(108, 'Mojito', 15, NULL, 50, 'public/uploads/product/1749741629.jpg', NULL, 'YES', 'A', NULL, '2025-05-28 21:13:23', '2025-06-12 20:50:29', NULL),
(109, 'Restaurant Special Mocktail', 15, NULL, 70, 'public/uploads/product/1749741545.jpg', NULL, 'YES', 'A', NULL, '2025-05-28 21:13:24', '2025-06-12 20:49:05', NULL),
(110, 'Strawberry Milkshake', 15, NULL, 80, 'public/uploads/product/1749741140.jpg', NULL, 'YES', 'A', NULL, '2025-05-28 21:15:58', '2025-06-12 20:42:20', NULL),
(111, 'Sweet Lassi', 15, NULL, 40, 'public/uploads/product/1749739872.jpg', NULL, 'YES', 'A', NULL, '2025-05-28 21:16:23', '2025-06-12 20:21:12', NULL),
(112, 'Vanilla Milkshake', 15, NULL, 80, 'public/uploads/product/1749739603.jpg', NULL, 'YES', 'A', NULL, '2025-05-28 21:17:07', '2025-06-12 20:16:43', NULL),
(113, 'Chicken Momo (6 Pcs)', 16, NULL, 50, 'public/uploads/product/1748610397.png', NULL, 'YES', 'A', NULL, '2025-05-28 21:18:50', '2025-05-30 18:36:37', NULL),
(114, 'Gandharaj Momo (6 Pcs)', 16, NULL, 60, 'public/uploads/product/1748610021.jpg', NULL, 'YES', 'A', NULL, '2025-05-28 21:19:39', '2025-06-19 19:08:38', NULL),
(115, 'Pan Fry Momo (6 Pcs)', 16, NULL, 100, 'public/uploads/product/1748593439.jpg', NULL, 'YES', 'A', NULL, '2025-05-28 21:20:10', '2025-05-30 13:53:59', NULL),
(116, 'Veg Momo (6 Pcs)', 16, NULL, 40, 'public/uploads/product/1748593123.jpg', NULL, 'YES', 'A', NULL, '2025-05-28 21:20:32', '2025-05-30 13:48:43', NULL),
(117, 'Cheese Pav Bhaji', 17, NULL, 80, 'public/uploads/product/1748589687.jpg', NULL, 'YES', 'A', NULL, '2025-05-30 12:51:27', '2025-05-30 12:55:26', NULL),
(118, 'Pav Bhaji', 17, NULL, 50, 'public/uploads/product/1748589937.jpg', NULL, 'YES', 'A', NULL, '2025-05-30 12:52:14', '2025-05-30 12:55:37', NULL),
(119, 'Bone Chilli Pizza', 18, NULL, 200, 'public/uploads/product/1748593600.jpg', NULL, 'YES', 'A', NULL, '2025-05-30 13:56:40', '2025-05-30 13:56:40', NULL),
(120, 'Cheese Pizza', 18, NULL, 130, 'public/uploads/product/1748593812.jpg', NULL, 'YES', 'A', NULL, '2025-05-30 14:00:12', '2025-05-30 14:00:12', NULL),
(121, 'Chicken Cheese Pizza', 18, NULL, 180, 'public/uploads/product/1748594104.jpg', NULL, 'YES', 'A', NULL, '2025-05-30 14:05:04', '2025-05-30 14:05:04', NULL),
(122, 'Chicken Tikka Pizza', 18, NULL, 200, 'public/uploads/product/1748594835.jpg', NULL, 'YES', 'A', NULL, '2025-05-30 14:15:45', '2025-05-30 14:17:15', NULL),
(123, 'Exotic Veg Pizza', 18, NULL, 130, 'public/uploads/product/1748595824.jpg', NULL, 'YES', 'A', NULL, '2025-05-30 14:22:07', '2025-05-30 14:33:44', NULL),
(124, 'Margherita Pizza', 18, NULL, 120, 'public/uploads/product/1748595291.jpg', NULL, 'YES', 'A', NULL, '2025-05-30 14:24:51', '2025-05-30 14:24:51', NULL),
(125, 'Paneer Tikka Pizza', 18, NULL, 150, 'public/uploads/product/1749554421.jpg', NULL, 'YES', 'A', NULL, '2025-05-30 14:31:07', '2025-06-10 16:50:21', NULL),
(126, 'Veg Cheese Pizza', 18, NULL, 120, 'public/uploads/product/1748595796.jpg', NULL, 'YES', 'A', NULL, '2025-05-30 14:31:48', '2025-05-30 14:33:16', NULL),
(127, 'Chicken Roll', 19, NULL, 50, 'public/uploads/product/1749554297.jpg', NULL, 'YES', 'A', NULL, '2025-05-30 14:35:50', '2025-06-10 16:48:18', NULL),
(128, 'Chicken Spring Roll', 6, NULL, 100, 'public/uploads/product/1749554263.jpg', NULL, 'YES', 'A', NULL, '2025-05-30 14:36:24', '2025-06-10 16:47:43', NULL),
(129, 'Egg Chicken Rolls', 19, NULL, 60, 'public/uploads/product/1749554206.jpg', NULL, 'YES', 'A', NULL, '2025-05-30 14:38:01', '2025-06-10 16:46:46', NULL),
(130, 'Egg Roll', 19, NULL, 40, 'public/uploads/product/1749554162.jpg', NULL, 'YES', 'A', NULL, '2025-05-30 14:38:22', '2025-06-10 16:46:02', NULL),
(131, 'Panner Tikka Roll', 19, NULL, 60, 'public/uploads/product/1749553765.jpg', NULL, 'YES', 'A', NULL, '2025-05-30 14:39:15', '2025-06-10 16:39:25', NULL),
(132, 'Chicken Tikka Roll', 19, NULL, 80, 'public/uploads/product/1749552661.jpg', NULL, 'YES', 'A', NULL, '2025-05-30 14:39:42', '2025-06-10 16:21:01', NULL),
(133, 'Cheese Sandwich', 20, NULL, 90, 'public/uploads/product/1749552418.jpg', NULL, 'YES', 'A', NULL, '2025-05-30 14:41:10', '2025-06-10 16:16:58', NULL),
(134, 'Omlet Sandwich', 20, NULL, 90, 'public/uploads/product/1749552367.jpg', NULL, 'YES', 'A', NULL, '2025-05-30 14:41:49', '2025-06-10 16:16:07', NULL),
(135, 'Veg Tost Sandwich', 20, NULL, 60, 'public/uploads/product/1749552251.jpg', NULL, 'YES', 'A', NULL, '2025-05-30 14:42:32', '2025-06-10 16:14:11', NULL),
(136, 'Afgani Tangdi Kabab (3 PCS)', 21, NULL, 210, 'public/uploads/product/1748924471.jpg', NULL, 'YES', 'A', NULL, '2025-05-30 14:45:06', '2025-06-03 09:51:11', NULL),
(137, 'Alu Paratha', 21, NULL, 40, 'public/uploads/product/1748949111.jpg', NULL, 'YES', 'A', NULL, '2025-05-30 14:46:30', '2025-06-03 16:41:51', NULL),
(138, 'Butter Kulcha', 21, NULL, 25, 'public/uploads/product/1748949202.jpg', NULL, 'YES', 'A', NULL, '2025-05-30 14:46:52', '2025-06-03 16:43:22', NULL),
(139, 'Butter Laccha Paratha', 21, NULL, 35, 'public/uploads/product/1748949286.jpg', NULL, 'YES', 'A', NULL, '2025-05-30 14:47:31', '2025-06-03 16:44:46', NULL),
(140, 'Butter Nun', 21, NULL, 30, 'public/uploads/product/1748949331.jpg', NULL, 'YES', 'A', NULL, '2025-05-30 14:47:54', '2025-06-03 16:45:31', NULL),
(141, 'Butter Rooti', 21, NULL, 25, 'public/uploads/product/1748685367.jpg', NULL, 'YES', 'A', NULL, '2025-05-30 14:48:13', '2025-05-31 15:26:07', NULL),
(142, 'Chicken Anchari Tikka (6 Pcs)', 21, NULL, 250, 'public/uploads/product/1748949373.jpg', NULL, 'YES', 'A', NULL, '2025-05-30 14:48:51', '2025-06-03 16:46:13', NULL),
(143, 'Chicken Angara Kabab (6 Pcs)', 21, NULL, 300, 'public/uploads/product/1748949456.jpg', NULL, 'YES', 'A', NULL, '2025-05-30 14:49:20', '2025-06-03 16:47:36', NULL),
(144, 'Chicken Sheek Kabab (6 Pcs)', 21, NULL, 240, 'public/uploads/product/1748615140.jpg', NULL, 'YES', 'A', NULL, '2025-05-30 14:50:08', '2025-05-30 19:55:40', NULL),
(145, 'Chicken Reshmi Kabab', 21, NULL, 190, 'public/uploads/product/1748614835.jpeg', NULL, 'YES', 'A', NULL, '2025-05-30 14:50:37', '2025-06-02 17:06:02', NULL),
(146, 'Fish Pahadi Tikka', 21, NULL, 240, 'public/uploads/product/1748614520.jpg', NULL, 'YES', 'A', NULL, '2025-05-30 14:52:08', '2025-05-30 19:45:20', NULL),
(147, 'Laccha Paratha', 21, NULL, 25, 'public/uploads/product/1748614376.jpg', NULL, 'YES', 'A', NULL, '2025-05-30 14:52:31', '2025-05-30 19:42:56', NULL),
(148, 'Masala Kulcha', 21, NULL, 40, 'public/uploads/product/1748614298.jpg', NULL, 'YES', 'A', NULL, '2025-05-30 14:57:05', '2025-05-30 19:41:38', NULL),
(149, 'Mashroom Tikka (8 Pcs)', 21, NULL, 150, 'public/uploads/product/1748614188.jpg', NULL, 'YES', 'A', NULL, '2025-05-30 14:57:43', '2025-05-30 19:39:48', NULL),
(150, 'Banjara Kabab (6 Pcs)', 21, NULL, 260, 'public/uploads/product/1748613753.jpeg', NULL, 'YES', 'A', NULL, '2025-05-30 15:00:23', '2025-05-30 19:32:33', NULL),
(151, 'Kalimiri Kabab (6 Pcs)', 21, NULL, 250, 'public/uploads/product/1748613591.jpg', NULL, 'YES', 'A', NULL, '2025-05-30 15:02:12', '2025-05-30 19:29:51', NULL),
(152, 'Pahadi Kabab (6 Pcs)', 21, NULL, 250, 'public/uploads/product/1748613421.jpeg', NULL, 'YES', 'A', NULL, '2025-05-30 15:03:44', '2025-05-30 19:30:05', NULL),
(153, 'Pomfret Angara Tikka', 21, NULL, 270, 'public/uploads/product/1748613328.jpg', NULL, 'YES', 'A', NULL, '2025-05-30 15:04:59', '2025-05-30 19:25:28', NULL),
(154, 'Paneer Paratha', 21, NULL, 50, 'public/uploads/product/1748612832.jpg', NULL, 'YES', 'A', NULL, '2025-05-30 15:05:58', '2025-05-30 19:17:12', NULL),
(155, 'Paneer Tikka', 21, NULL, 150, 'public/uploads/product/1748612289.jfif', NULL, 'YES', 'A', NULL, '2025-05-30 15:06:34', '2025-05-30 19:08:09', NULL),
(156, 'Pomfret Tandoori', 21, NULL, 270, 'public/uploads/product/1748611975.jpg', NULL, 'YES', 'A', NULL, '2025-05-30 15:07:52', '2025-05-30 19:02:55', NULL),
(157, 'Seasoning Paneer Multani', 21, NULL, 200, 'public/uploads/product/1748611707.jpeg', NULL, 'YES', 'A', NULL, '2025-05-30 15:08:58', '2025-05-30 18:58:27', NULL),
(158, 'Special Non Vegetable Platter', 21, NULL, 600, 'public/uploads/product/1748611639.jpg', NULL, 'YES', 'A', NULL, '2025-05-30 15:09:50', '2025-05-30 18:57:19', NULL),
(159, 'Tandoori Chicken Full', 21, NULL, 390, 'public/uploads/product/1748610446.jpeg', NULL, 'YES', 'A', NULL, '2025-05-30 15:10:29', '2025-05-30 18:37:28', NULL),
(160, 'Tandoori Chicken Half', 21, NULL, 200, 'public/uploads/product/1748610423.jpeg', NULL, 'YES', 'A', NULL, '2025-05-30 15:10:58', '2025-05-30 18:37:03', NULL),
(161, 'Tandoori Rooti', 21, NULL, 15, 'public/uploads/product/1748609271.jpg', NULL, 'YES', 'A', NULL, '2025-05-30 15:11:29', '2025-05-30 18:17:51', NULL),
(162, 'Green Tea', 22, NULL, 30, 'public/uploads/product/1748608848.jfif', NULL, 'YES', 'A', NULL, '2025-05-30 15:12:04', '2025-05-30 18:10:48', NULL),
(163, 'Lemon Tea', 22, NULL, 15, 'public/uploads/product/1748608369.jpg', NULL, 'YES', 'A', NULL, '2025-05-30 15:12:32', '2025-05-30 18:02:49', NULL),
(164, 'Milk Tea', 22, NULL, 20, 'public/uploads/product/1748608262.jpg', NULL, 'YES', 'A', NULL, '2025-05-30 15:12:52', '2025-05-30 18:01:02', NULL),
(165, 'Zinger Tea', 22, NULL, 20, 'public/uploads/product/1748608086.jpg', NULL, 'YES', 'A', NULL, '2025-05-30 15:13:29', '2025-06-02 18:55:30', NULL),
(166, 'Cheese Burger', 3, NULL, 80, 'public/uploads/product/1750340775.jpg', NULL, 'YES', 'A', NULL, '2025-06-19 18:59:13', '2025-06-19 19:16:15', NULL),
(167, 'Chicken Burger', 3, NULL, 100, NULL, NULL, 'YES', 'A', NULL, '2025-06-19 19:00:21', '2025-06-19 19:00:31', NULL),
(168, 'Veg Burger', 3, NULL, 70, 'public/uploads/product/1750340751.jpg', NULL, 'YES', 'A', NULL, '2025-06-19 19:01:29', '2025-06-19 19:15:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `image` varchar(155) DEFAULT NULL,
  `rating` float(4,1) NOT NULL DEFAULT 4.1,
  `email` varchar(100) DEFAULT NULL,
  `mobile` bigint(100) DEFAULT NULL,
  `availability` enum('OPEN','CLOSE') DEFAULT 'OPEN',
  `gst_percentage` int(11) NOT NULL,
  `gst_type` enum('Including','Excluding') NOT NULL,
  `address` text DEFAULT NULL,
  `status` enum('A','D') DEFAULT 'A',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`id`, `name`, `password`, `image`, `rating`, `email`, `mobile`, `availability`, `gst_percentage`, `gst_type`, `address`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Restaureat Cafe', '$2y$10$Xyg7ChzaXplZ3IVnmwO8JuH8vk73cMVrnfRZY1sqXu1X9DBHUeIje', 'public/uploads/restaurant/20268500491749917782.jpg', 5.0, 'restaureatcafe@gmail.com', 8777347811, 'OPEN', 12, 'Including', 'Kalyani', 'A', '2024-10-25 12:50:07', '2025-06-14 21:46:22', NULL),
(2, 'Pizza Hut', '$2y$10$BPtStQSNh.C9AQVrvglT/uw2DCCA258LIE5ssEIQj5b5GB/0Io4ze', 'public/uploads/restaurant/pizza-hut.jpg', 4.3, 'pizzahutdummy@gmail.com', NULL, 'OPEN', 12, 'Including', NULL, 'A', '2024-10-25 12:50:18', '2025-05-24 16:35:32', '2025-05-24 16:35:32'),
(3, 'MOJO Pizza', '$2y$10$BPtStQSNh.C9AQVrvglT/uw2DCCA258LIE5ssEIQj5b5GB/0Io4ze', 'public/uploads/restaurant/mojo.png', 4.0, 'mojopizza657@gmail.com', NULL, 'OPEN', 18, 'Including', NULL, 'A', '2024-10-25 12:50:37', '2025-05-24 16:35:30', '2025-05-24 16:35:30'),
(4, 'La Pino\'z Pizza', '$2y$10$BPtStQSNh.C9AQVrvglT/uw2DCCA258LIE5ssEIQj5b5GB/0Io4ze', 'public/uploads/restaurant/lapino-pizza.png', 4.5, 'lapinozpizza@gmail.com', NULL, 'OPEN', 18, 'Excluding', NULL, 'A', '2024-10-25 12:50:49', '2025-05-24 16:35:26', '2025-05-24 16:35:26'),
(5, 'Dominoz Pizza mania', '$2y$10$BPtStQSNh.C9AQVrvglT/uw2DCCA258LIE5ssEIQj5b5GB/0Io4ze', 'public/uploads/restaurant/812417631741854429.jpg', 3.1, 'dominoz123@gmail.com', 7845212153, 'OPEN', 1, 'Excluding', 'beldanga rishra west bengal', 'A', '2025-03-13 12:37:09', '2025-05-24 16:35:23', '2025-05-24 16:35:23');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_categories`
--

CREATE TABLE `restaurant_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `restaurant_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `status` enum('A','D') DEFAULT 'A',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restaurant_categories`
--

INSERT INTO `restaurant_categories` (`id`, `restaurant_id`, `category_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'A', '2025-06-03 18:23:58', '2025-06-03 18:23:58', NULL),
(2, 1, 2, 'A', '2025-05-27 16:18:55', '2025-05-27 16:18:55', NULL),
(3, 1, 3, 'A', '2025-05-27 16:19:22', '2025-05-27 16:19:22', NULL),
(4, 1, 4, 'A', '2025-05-27 16:19:45', '2025-05-27 16:19:45', NULL),
(5, 1, 10, 'A', '2025-06-03 17:51:27', '2025-06-03 17:51:27', NULL),
(6, 1, 6, 'A', '2025-05-27 16:20:06', '2025-05-27 16:20:06', NULL),
(7, 1, 8, 'A', '2025-05-27 16:20:27', '2025-05-27 16:20:27', NULL),
(8, 1, 11, 'A', '2025-06-03 17:51:41', '2025-06-03 17:51:41', NULL),
(9, 1, 12, 'A', '2025-06-03 17:51:03', '2025-06-03 17:51:03', NULL),
(10, 1, 13, 'A', '2025-06-03 17:51:51', '2025-06-03 17:51:51', NULL),
(11, 1, 14, 'A', '2025-06-03 17:54:26', '2025-06-03 17:54:26', NULL),
(12, 1, 15, 'A', '2025-06-03 17:54:55', '2025-06-03 17:54:55', NULL),
(13, 1, 16, 'A', '2025-06-03 17:56:09', '2025-06-03 17:56:09', NULL),
(14, 1, 17, 'A', '2025-06-03 17:56:36', '2025-06-03 17:56:36', NULL),
(15, 1, 18, 'A', '2025-06-03 17:57:04', '2025-06-03 17:57:04', NULL),
(16, 1, 19, 'A', '2025-06-03 17:57:46', '2025-06-03 17:57:46', NULL),
(17, 1, 20, 'A', '2025-06-03 17:58:38', '2025-06-03 17:58:38', NULL),
(18, 1, 21, 'A', '2025-06-03 18:24:29', '2025-06-03 18:24:29', NULL),
(19, 1, 22, 'A', '2025-06-03 17:58:14', '2025-06-03 17:58:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_tablenumbers`
--

CREATE TABLE `restaurant_tablenumbers` (
  `id` int(11) NOT NULL,
  `table_number` varchar(50) NOT NULL,
  `capacity` int(11) DEFAULT NULL,
  `restaurant_id` int(11) DEFAULT NULL,
  `status` enum('Available','Occupied','Reserved') DEFAULT 'Available',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restaurant_tablenumbers`
--

INSERT INTO `restaurant_tablenumbers` (`id`, `table_number`, `capacity`, `restaurant_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Rest 1', 4, 1, 'Available', '2025-03-20 11:02:15', '2025-06-17 20:06:40'),
(2, 'Rest 2', 4, 1, 'Available', '2025-03-20 11:02:15', '2025-06-17 20:06:02'),
(3, 'Rest 3', 4, 1, 'Available', '2025-03-20 11:02:29', '2025-06-17 20:06:12'),
(4, 'S 1', 4, 1, 'Available', '2025-03-20 11:02:29', '2025-06-17 20:10:24'),
(5, 'Rest 5', 4, 1, 'Available', '2025-03-20 11:02:43', '2025-06-17 20:08:36'),
(6, 'Table6', 4, 1, 'Available', '2025-03-20 11:02:43', '2025-05-26 11:32:38'),
(7, 'Table7', 4, 1, 'Available', '2025-05-13 13:18:52', '2025-05-26 11:32:38'),
(8, 'Table8', 4, 1, 'Available', '2025-05-13 13:18:52', '2025-05-26 11:32:38'),
(9, 'Table9', 4, 1, 'Available', '2025-05-13 13:18:52', '2025-05-26 11:32:38'),
(10, 'Table10', 4, 1, 'Available', '2025-05-13 13:18:52', '2025-05-26 11:32:38'),
(11, 'Table11', 4, 1, 'Available', '2025-05-16 16:55:43', '2025-05-26 11:32:38'),
(12, 'Table12', 4, 1, 'Available', '2025-05-16 16:56:00', '2025-05-26 11:32:38'),
(13, 'Table13', 4, 1, 'Available', '2025-05-16 16:56:10', '2025-05-26 11:32:38'),
(14, 'Table14', 4, 1, 'Available', '2025-05-16 16:56:20', '2025-05-26 11:32:38'),
(15, 'Table15', 4, 1, 'Available', '2025-05-16 16:56:29', '2025-05-26 11:32:38'),
(16, 'Table16', 4, 1, 'Available', '2025-05-16 16:56:38', '2025-05-26 11:32:38'),
(17, 'Table17', 4, 1, 'Available', '2025-05-16 16:56:47', '2025-05-26 11:32:38'),
(18, 'Table18', 4, 1, 'Available', '2025-05-16 16:56:56', '2025-05-26 11:32:38'),
(19, 'Table19', 4, 1, 'Available', '2025-05-16 16:57:04', '2025-05-26 11:32:38'),
(20, 'Table20', 4, 1, 'Available', '2025-05-16 16:57:14', '2025-05-26 11:32:38');

-- --------------------------------------------------------

--
-- Table structure for table `resturants_tables`
--

CREATE TABLE `resturants_tables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `restaurant_id` bigint(20) UNSIGNED NOT NULL,
  `table_name` varchar(255) NOT NULL,
  `table_number` int(11) NOT NULL,
  `status` enum('available','occupied') DEFAULT 'available',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` enum('Admin','Restaurant') NOT NULL DEFAULT 'Admin'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`, `type`) VALUES
(1, 'Admin', 'admin', 'Active', '2024-04-01 10:57:43', '2024-04-01 10:57:43', 'Admin'),
(2, 'Sub admin', 'subadmin', 'Active', '2024-04-01 10:57:43', '2024-04-01 10:57:43', 'Admin'),
(13, 'Admin', '', 'Active', '2025-03-30 09:54:56', '2025-03-30 09:54:56', 'Restaurant'),
(14, 'Manager', '', 'Active', '2025-03-30 09:54:56', '2025-03-30 09:54:56', 'Restaurant'),
(15, 'Waiter', '', 'Active', '2025-03-30 09:54:56', '2025-03-30 09:54:56', 'Restaurant'),
(16, 'Chef', '', 'Active', '2025-03-30 09:54:56', '2025-03-30 09:54:56', 'Restaurant'),
(17, 'Cashier', '', 'Active', '2025-03-30 09:54:56', '2025-03-30 09:54:56', 'Restaurant');

-- --------------------------------------------------------

--
-- Table structure for table `roles_permissions`
--

CREATE TABLE `roles_permissions` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles_permissions`
--

INSERT INTO `roles_permissions` (`role_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-03-05 08:24:35', '2022-03-05 08:24:35'),
(1, 2, '2022-03-05 08:24:35', '2022-03-05 08:24:35'),
(1, 3, '2022-03-05 08:24:35', '2022-03-05 08:24:35'),
(1, 4, '2022-03-05 08:24:35', '2022-03-05 08:24:35'),
(1, 5, '2022-03-05 08:24:35', '2022-03-05 08:24:35'),
(1, 6, '2022-03-05 08:24:35', '2022-03-05 08:24:35'),
(1, 7, '2022-03-05 08:24:35', '2022-03-05 08:24:35'),
(1, 8, '2022-03-05 08:24:35', '2022-03-05 08:24:35'),
(1, 9, '2022-03-05 08:24:35', '2022-03-05 08:24:35'),
(1, 10, '2022-03-05 08:24:35', '2022-03-05 08:24:35'),
(1, 11, '2022-03-05 08:24:35', '2022-03-05 08:24:35'),
(1, 12, '2022-03-05 08:24:35', '2022-03-05 08:24:35'),
(1, 13, '2022-03-05 08:24:35', '2022-03-05 08:24:35'),
(1, 102, '2022-09-07 06:01:46', '2022-09-07 06:01:46'),
(1, 97, '2022-08-26 13:06:57', '2022-08-26 13:06:57'),
(1, 96, '2022-08-26 11:28:29', '2022-08-26 11:28:29'),
(1, 95, '2022-08-26 06:57:16', '2022-08-26 06:57:16'),
(1, 94, '2022-08-26 06:57:16', '2022-08-26 06:57:16'),
(1, 93, '2022-08-26 06:57:16', '2022-08-26 06:57:16'),
(1, 92, '2022-08-26 06:57:16', '2022-08-26 06:57:16'),
(1, 77, '2022-07-05 13:02:10', '2022-07-05 13:02:10'),
(1, 78, '2022-07-05 13:02:10', '2022-07-05 13:02:10'),
(1, 79, '2022-07-05 13:02:10', '2022-07-05 13:02:10'),
(1, 80, '2022-07-05 13:02:10', '2022-07-05 13:02:10'),
(1, 81, '2022-07-20 13:03:53', '2022-07-20 13:03:53'),
(1, 82, '2022-07-20 13:03:53', '2022-07-20 13:03:53'),
(1, 83, '2022-07-20 13:03:53', '2022-07-20 13:03:53'),
(1, 98, '2022-08-27 03:15:01', '2022-08-27 03:15:01'),
(1, 99, '2022-08-27 05:28:19', '2022-08-27 05:28:19'),
(1, 100, '2022-08-27 05:28:19', '2022-08-27 05:28:19'),
(1, 101, '2022-08-27 05:28:19', '2022-08-27 05:28:19'),
(1, 103, '2022-09-09 12:57:28', '2022-09-09 12:57:28'),
(10, 92, '2022-09-07 04:51:15', '2022-09-07 04:51:15'),
(10, 94, '2022-09-07 04:51:16', '2022-09-07 04:51:16'),
(10, 93, '2022-09-07 04:51:21', '2022-09-07 04:51:21'),
(10, 98, '2022-09-07 04:51:23', '2022-09-07 04:51:23'),
(10, 81, '2022-09-07 04:51:40', '2022-09-07 04:51:40'),
(10, 82, '2022-09-07 04:51:41', '2022-09-07 04:51:41'),
(10, 99, '2022-09-07 04:51:42', '2022-09-07 04:51:42'),
(10, 100, '2022-09-07 04:51:43', '2022-09-07 04:51:43'),
(1, 104, '2022-09-09 12:57:28', '2022-09-09 12:57:28'),
(1, 105, '2022-09-09 12:57:28', '2022-09-09 12:57:28'),
(1, 106, '2022-09-09 12:57:28', '2022-09-09 12:57:28'),
(1, 131, '2022-10-21 05:59:46', '2022-10-21 05:59:46'),
(1, 132, '2022-10-21 05:59:46', '2022-10-21 05:59:46'),
(1, 135, '2022-12-19 03:52:04', '2022-12-19 03:52:04'),
(1, 137, '2022-10-25 10:38:11', '2022-10-25 10:38:11'),
(1, 138, '2022-10-27 07:01:21', '2022-10-27 07:01:21'),
(1, 139, '2022-10-27 07:01:21', '2022-10-27 07:01:21'),
(11, 2, '2022-10-28 02:00:20', '2022-10-28 02:00:20'),
(1, 141, '2022-11-08 10:27:05', '2022-11-08 10:27:05'),
(1, 142, '2022-11-08 10:27:05', '2022-11-08 10:27:05'),
(1, 143, '2022-11-08 10:27:05', '2022-11-08 10:27:05'),
(1, 144, '2022-11-08 10:27:05', '2022-11-08 10:27:05'),
(1, 145, '2022-11-08 10:27:05', '2022-11-08 10:27:05'),
(1, 146, '2022-11-08 10:27:05', '2022-11-08 10:27:05'),
(1, 147, '2022-11-09 08:26:06', '2022-11-09 08:26:06'),
(1, 148, '2022-11-11 13:20:04', '2022-11-11 13:20:04'),
(1, 149, '2022-11-11 09:55:26', '2022-11-11 09:55:26'),
(1, 150, '2022-11-14 05:04:50', '2022-11-14 05:04:50'),
(1, 151, '2022-11-14 05:04:50', '2022-11-14 05:04:50'),
(1, 152, '2022-11-14 05:04:50', '2022-11-14 05:04:50'),
(1, 153, '2022-11-14 05:04:50', '2022-11-14 05:04:50'),
(1, 156, '2022-11-15 08:24:01', '2022-11-15 08:24:01'),
(1, 157, '2022-11-15 08:24:01', '2022-11-15 08:24:01'),
(1, 158, '2022-11-15 09:50:58', '2022-11-15 09:50:58'),
(1, 159, '2022-11-15 10:17:08', '2022-11-15 10:17:08'),
(1, 160, '2022-11-15 10:48:57', '2022-11-15 10:48:57'),
(1, 161, '2022-11-16 06:20:57', '2022-11-16 06:20:57'),
(1, 165, '2022-07-05 13:02:10', '2022-07-05 13:02:10'),
(1, 164, '2022-11-29 07:52:07', '2022-11-29 07:52:07'),
(1, 163, '2022-11-29 07:52:07', '2022-11-29 07:52:07'),
(1, 162, '2022-11-29 07:52:07', '2022-11-29 07:52:07'),
(1, 166, '2022-07-05 13:02:10', '2022-07-05 13:02:10'),
(1, 167, '2022-12-19 10:04:47', '2022-12-19 10:04:47'),
(1, 168, '2022-12-19 10:04:47', '2022-12-19 10:04:47'),
(12, 162, '2023-03-11 09:20:02', '2023-03-11 09:20:02'),
(12, 163, '2023-03-11 09:20:02', '2023-03-11 09:20:02'),
(1, 170, '2022-03-05 08:24:35', '2022-03-05 08:24:35'),
(1, 171, '2022-03-05 08:24:35', '2022-03-05 08:24:35'),
(1, 172, '2022-03-05 08:24:35', '2022-03-05 08:24:35'),
(1, 173, '2022-03-05 08:24:35', '2022-03-05 08:24:35'),
(1, 174, '2022-03-05 08:24:35', '2022-03-05 08:24:35'),
(1, 175, '2022-03-05 08:24:35', '2022-03-05 08:24:35'),
(1, 176, '2022-03-05 08:24:35', '2022-03-05 08:24:35'),
(1, 177, '2022-03-05 08:24:35', '2022-03-05 08:24:35'),
(1, 178, '2022-03-05 08:24:35', '2022-03-05 08:24:35'),
(1, 179, '2022-03-05 08:24:35', '2022-03-05 08:24:35'),
(1, 180, '2022-03-05 08:24:35', '2022-03-05 08:24:35'),
(1, 181, '2022-03-05 08:24:35', '2022-03-05 08:24:35'),
(1, 182, '2022-03-05 08:24:35', '2022-03-05 08:24:35'),
(1, 183, '2022-03-05 08:24:35', '2022-03-05 08:24:35'),
(1, 186, '2024-03-19 12:27:42', '2024-03-19 12:27:42'),
(1, 188, '2024-03-29 12:33:18', '2024-03-29 12:33:18'),
(1, 189, '2024-03-29 12:33:18', '2024-03-29 12:33:18'),
(1, 190, '2024-03-29 12:33:18', '2024-03-29 12:33:18'),
(1, 191, '2024-03-29 12:33:18', '2024-03-29 12:33:18'),
(1, 192, '2022-03-05 08:24:35', '2022-03-05 08:24:35'),
(1, 193, '2022-03-05 08:24:35', '2022-03-05 08:24:35'),
(1, 194, '2022-03-05 08:24:35', '2022-03-05 08:24:35'),
(1, 195, '2022-03-05 08:24:35', '2022-03-05 08:24:35'),
(14, 198, '2025-04-03 16:41:12', '2025-04-03 16:41:12'),
(14, 197, '2025-04-03 16:41:12', '2025-04-03 16:41:12'),
(14, 196, '2025-04-03 16:41:12', '2025-04-03 16:41:12'),
(14, 199, '2025-04-03 16:41:12', '2025-04-03 16:41:12'),
(14, 200, '2025-04-03 16:41:12', '2025-04-03 16:41:12'),
(14, 201, '2025-04-03 16:41:12', '2025-04-03 16:41:12'),
(14, 202, '2025-04-03 16:41:12', '2025-04-03 16:41:12'),
(14, 203, '2025-04-03 16:41:12', '2025-04-03 16:41:12'),
(14, 204, '2025-04-03 16:41:12', '2025-04-03 16:41:12'),
(14, 205, '2025-04-03 16:41:12', '2025-04-03 16:41:12'),
(14, 206, '2025-04-03 16:41:12', '2025-04-03 16:41:12'),
(14, 207, '2025-04-03 16:41:12', '2025-04-03 16:41:12'),
(1, 209, '2025-04-15 08:35:49', '2025-07-21 06:20:20'),
(1, 210, '2025-07-21 07:32:35', '2025-07-21 07:32:35');

-- --------------------------------------------------------

--
-- Table structure for table `sms_transaction`
--

CREATE TABLE `sms_transaction` (
  `id` int(11) NOT NULL,
  `mobile` varchar(12) DEFAULT NULL,
  `otp` varchar(6) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `type` enum('CUSTOMER','DRIVER') NOT NULL DEFAULT 'CUSTOMER',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `sms_transaction`
--

INSERT INTO `sms_transaction` (`id`, `mobile`, `otp`, `message`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '9876543212', '123456', NULL, 'CUSTOMER', '2024-04-02 17:47:11', '2024-04-02 17:47:11', NULL),
(2, '9876543212', '123456', NULL, 'CUSTOMER', '2024-04-02 17:47:47', '2024-04-02 17:47:47', NULL),
(3, '9876543212', '123456', NULL, 'CUSTOMER', '2024-04-02 18:09:04', '2024-04-02 18:09:04', NULL),
(4, '9876543212', '123456', NULL, 'CUSTOMER', '2024-04-02 18:09:17', '2024-04-02 18:09:17', NULL),
(5, '9876543212', '123456', NULL, 'CUSTOMER', '2024-04-02 18:10:11', '2024-04-02 18:10:11', NULL),
(6, '9876543210', '123456', NULL, 'CUSTOMER', '2024-04-02 18:46:44', '2024-04-02 18:46:44', NULL),
(7, '9876543210', '123456', NULL, 'DRIVER', '2024-04-03 11:58:02', '2024-04-03 11:58:02', NULL),
(8, '9876543210', '123456', NULL, 'CUSTOMER', '2024-04-03 18:00:11', '2024-04-03 18:00:11', NULL),
(9, '9876543210', '123456', NULL, 'CUSTOMER', '2024-04-04 11:20:44', '2024-04-04 11:20:44', NULL),
(10, '9876543210', '123456', NULL, 'DRIVER', '2024-04-05 15:50:32', '2024-04-05 15:50:32', NULL),
(11, '9876543210', '123456', NULL, 'CUSTOMER', '2024-04-30 12:13:48', '2024-04-30 12:13:48', NULL),
(12, '9910702997', '123456', NULL, 'CUSTOMER', '2024-04-30 12:14:10', '2024-04-30 12:14:10', NULL),
(13, '9910702998', '123456', NULL, 'CUSTOMER', '2024-04-30 12:24:00', '2024-04-30 12:24:00', NULL),
(14, '8882933599', '123456', NULL, 'CUSTOMER', '2024-04-30 14:28:00', '2024-04-30 14:28:00', NULL),
(15, '6367006928', '123456', NULL, 'CUSTOMER', '2024-06-08 17:19:27', '2024-06-08 17:19:27', NULL),
(16, '8100098024', '123456', NULL, 'CUSTOMER', '2024-07-04 15:10:41', '2024-07-04 15:10:41', NULL),
(17, '8170886115', '123456', NULL, 'CUSTOMER', '2024-07-04 18:21:50', '2024-07-04 18:21:50', NULL),
(18, '6367006928', '123456', NULL, 'CUSTOMER', '2024-07-22 18:54:25', '2024-07-22 18:54:25', NULL),
(19, '9876543210', '123456', NULL, 'CUSTOMER', '2024-08-23 18:39:43', '2024-08-23 18:39:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `restaurant_id` bigint(20) DEFAULT NULL,
  `default_stock` int(11) NOT NULL DEFAULT 100,
  `todays_stock` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `category_id`, `product_id`, `restaurant_id`, `default_stock`, `todays_stock`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 5, 100, 50, '2025-04-03 18:12:27', '2025-04-03 18:12:39'),
(2, 4, 2, 5, 100, 52, '2025-04-03 18:12:27', '2025-04-03 18:12:27'),
(3, 4, 3, 5, 100, 53, '2025-04-03 18:12:27', '2025-04-03 18:12:27'),
(4, 4, 4, 5, 100, 54, '2025-04-03 18:12:27', '2025-04-03 18:12:27'),
(5, 3, 13, 5, 100, 55, '2025-04-03 18:12:27', '2025-04-03 18:12:27'),
(6, 1, 14, 5, 100, 56, '2025-04-03 18:12:27', '2025-04-03 18:12:27');

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `location` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'A',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `name`, `location`, `email`, `phone`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Store A', 'Salt lake Kolkata', 'storeA12@gmail.com', '8924512457', 'A', '2025-07-21 07:29:04', '2025-07-21 07:30:33', NULL),
(3, 'Store C', 'Asansol', 'storeC12@gmail.com', '8745254587', 'A', '2025-07-21 07:30:13', '2025-07-21 07:30:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `transaction_id` int(11) DEFAULT NULL,
  `opening` double(11,3) DEFAULT 0.000,
  `credit` double(11,3) DEFAULT 0.000,
  `debit` double(11,3) DEFAULT 0.000,
  `closing` double(11,3) DEFAULT 0.000,
  `message` varchar(255) DEFAULT NULL,
  `from_to` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Triggers `transactions`
--
DELIMITER $$
CREATE TRIGGER `CustomerWalletUpdate` AFTER INSERT ON `transactions` FOR EACH ROW UPDATE users SET balance=new.closing WHERE id=NEW.user_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `balance` double(11,2) DEFAULT 0.00,
  `profileimg` varchar(255) DEFAULT NULL,
  `device_id` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `gender` varchar(15) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `address` varchar(155) DEFAULT NULL,
  `password` varchar(500) DEFAULT NULL,
  `otp` varchar(11) DEFAULT NULL,
  `remember_token` varchar(500) DEFAULT NULL,
  `status` enum('A','D') DEFAULT 'A',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `mobile`, `balance`, `profileimg`, `device_id`, `email`, `gender`, `dob`, `address`, `password`, `otp`, `remember_token`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Kishor Mondal', '9876543212', 0.00, 'public/profileimg/1731843737.png', 'bbagibiaasgingasbgbsgbigbnsagbabgs8agawg78wgtqtb tqtg q3gtgq gqt', 'kishoremondal205@gmail.com', 'Male', '2000-10-30', NULL, '$2y$10$Qm4NYOWdHmfn3KxD9kd1bOn2ZwQffOJFb764yHs9sqxDW50CYi.8O', '4459', NULL, 'A', '2024-10-14 13:18:31', '2025-07-16 11:54:37', NULL),
(2, 'Ishani', '9856709867', 0.00, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$NrxRS1uta20OfEdvwhIVuOneT/bzQ9wZnHz0wL1B23XuW3g8/PWEu', NULL, NULL, 'A', '2024-10-14 15:58:54', '2024-10-14 15:58:54', NULL),
(3, 'Kishor Mondal', '987654321', 0.00, NULL, NULL, 'kishor@gmail.com', NULL, NULL, NULL, '$2y$10$UAi6I.RzJAj28H/P9p11/eD0lW37LkcRTyMkhbGZUcodO0HqFQIsi', NULL, NULL, 'A', '2024-11-06 13:04:41', '2024-11-06 13:04:41', NULL),
(4, 'Saifuddin Mondal', '9564779055', 0.00, 'public/profileimg/1732528159.png', NULL, 'saifuddinmondal@gmail.com', 'null', '2024-10-02', NULL, '$2a$12$M6Xwr.xlOG4ZaU1BAnb3lu7S32QomjsCkOUtaJopHJc3RXsCSBHWW', '8965', NULL, 'A', '2024-11-06 13:08:40', '2025-06-29 13:36:40', NULL),
(5, 'Saifuddin Mondal', '9564779054', 0.00, NULL, NULL, 'saifuddinmondal@gmail.com', NULL, NULL, NULL, '$2y$10$vSz8wszV09FBPhf4FTxDUeA0StdP4bQ55JNxRcmU0TgSvBny6cW5O', NULL, NULL, 'A', '2024-11-06 14:03:17', '2024-11-06 14:03:17', NULL),
(6, 'Siance', '8100098024', 0.00, NULL, NULL, 'siancesoftware@gmail.com', 'male', '1992-10-08', NULL, '$2y$10$UWrQfFN/c9tSyv36xMTGve.hrJZ/mrNSxUQacuUkKEdzR3m3hqOgO', '1234', NULL, 'A', '2024-11-13 10:26:08', '2025-06-23 15:27:05', NULL),
(7, 'Ishani', '9876546789', 0.00, NULL, NULL, 'ishani4@gmail.com', NULL, NULL, NULL, '$2y$10$CcyMbCIcZOkizYBUzHF7xOMfil6uEfaNdhnIQQag6RJoORA2rWxmi', NULL, NULL, 'A', '2024-11-13 13:21:19', '2025-06-18 16:40:37', '2025-06-18 16:40:37'),
(8, 'Ishani', '9876546788', 0.00, NULL, NULL, 'ishani4@gmail.com', 'female', '2024-11-13', NULL, '$2y$10$adO.C4R.sFENpcZj0asD/ee.CO7/F1PANvFm2bcE1KBy550R0/1L6', NULL, NULL, 'A', '2024-11-13 13:22:38', '2025-05-21 12:24:23', '2025-05-21 12:24:23'),
(9, 'Litan Gain', '9007810829', 0.00, NULL, NULL, 'litangain@gmail.com', NULL, NULL, NULL, '$2y$10$JjUoDAAorLpq/yePxQQCve28HL1UqJatvMroMw5crkOUj7VZnAIsq', NULL, NULL, 'A', '2024-11-14 20:30:13', '2024-11-14 20:30:13', NULL),
(10, 'Saifuddin Mondal', '6294269047', 0.00, NULL, NULL, 'rana.smart7894@gmail.com', NULL, NULL, NULL, '$2y$10$zF/E.YNDnFJVGCplHVHv/uCpXLI77RFbxYNUi6WXQfMz30avVoaBi', NULL, NULL, 'A', '2024-11-15 11:56:16', '2024-11-15 11:56:16', NULL),
(11, 'Sanjib Barai', '+918777347811', 0.00, NULL, NULL, 'ranjitbarai742@gmail.com', NULL, NULL, NULL, '$2y$10$agrHqKx5359/hKOAQvlY8uKiRXAgr0fplahEtkyupYM/NdwiTbROe', NULL, NULL, 'A', '2024-11-15 17:08:08', '2025-05-10 20:01:53', NULL),
(12, 'Soumya Biswas', '7797088768', 0.00, NULL, NULL, 'biswassoumya0023@gmail.com', NULL, NULL, NULL, '$2y$10$yUjZsIhPf9x1F9ylGLYvzOw64AoLOUEp.kcH9uiNdZqgd.HOo1WEG', NULL, NULL, 'A', '2024-12-06 13:10:23', '2024-12-06 13:10:23', NULL),
(13, 'Saifuddin mondal', '9564779051', 0.00, NULL, NULL, 'saifuddinmondal2580@gmail.com', NULL, NULL, NULL, '$2y$10$7rhb4eFZLhRH9c.3VBulzelTdSJkElxH.Qmw6aXcn/RgGhv0Bhsvi', NULL, NULL, 'A', '2024-12-15 22:34:32', '2024-12-15 22:34:32', NULL),
(14, 'Ishani', '7003411905', 0.00, NULL, NULL, 'talukdarishani14@gmail.com', 'null', '1970-01-01', NULL, '$2y$10$Ns8orFTSQKlt9KgElZF4duCABeOyBzguzQTzkbBGasT0ByH8NajK2', NULL, NULL, 'A', '2025-02-06 13:05:37', '2025-02-06 16:22:40', NULL),
(60, 'Vikas Pandey', '8910599783', 0.00, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$fshmSYSW/aMALuMOksXY3O/dgzSLHxwDV/Ncxqz54/l9tYu9NmjOW', '1778', NULL, 'A', '2025-06-26 13:51:00', '2025-07-17 18:01:17', NULL),
(16, 'vikas', '8745125478', 0.00, NULL, NULL, 'starvikass@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'A', '2025-03-12 15:31:28', '2025-03-12 15:31:28', NULL),
(17, 'Sanjib Barai', '+918100468694', 0.00, NULL, NULL, 'sanjibmusic2025@gmail.com', 'male', '1998-12-13', NULL, '$2y$10$1qUf2OSaQNHYgirRy8KZMOTmb.lRhOB7w.ogQH6LYRa8ijr7Rxoye', NULL, NULL, 'A', '2025-05-11 23:03:20', '2025-05-27 17:30:58', NULL),
(18, 'Mukul sharma', '8909092987', 0.00, NULL, NULL, 'mk@gmail.com', NULL, NULL, NULL, '$2y$10$zU7a3Qon/UeXnqBfXAFhYe/Ad/yJalZamV6KZs/cnglA2hjYqMg6m', '5728', NULL, 'A', '2025-05-12 10:15:50', '2025-07-18 11:10:01', NULL),
(19, 'RAMPADA MONDAL', '916289387871', 0.00, NULL, NULL, 'mondalram1996@gmail.com', NULL, NULL, NULL, '$2y$10$KFXBvTmc7MxWY2N0bi9Qte5eFdO1J4a/pCyX/vXejI2Dj8TZwBTVS', NULL, NULL, 'A', '2025-05-15 17:18:19', '2025-05-30 13:25:08', NULL),
(20, 'Mukul', '9389771057', 0.00, NULL, 'srdf', 'mkt@gmail.com', NULL, NULL, NULL, '$2y$10$7ndnd9xwAi0MeQ59OHiVSupCFUigo2V8f83vZJM3O/jjzJbUir8Gq', NULL, NULL, 'A', '2025-05-21 12:42:07', '2025-05-21 13:13:41', '2025-05-21 13:13:41'),
(21, 'Mukul', '8856505703', 0.00, NULL, 'srdf', 'r@gmail.com', NULL, NULL, NULL, '$2y$10$swSF5jyb6DsbCh32Rvq99O1kgqqrTwJhwVC8efMQLho6.k91BbdUq', NULL, NULL, 'A', '2025-05-21 13:52:55', '2025-05-21 13:54:09', '2025-05-21 13:54:09'),
(22, 'Mukul', '1234567890', 0.00, NULL, 'srdf', 'ddfmk@gmail.com', NULL, NULL, NULL, '$2y$10$H5qMmyLr3I1Y5m.oPl32D.YBqheQUcd71MGQSALDbgjl64Jg/wiXa', NULL, NULL, 'A', '2025-05-21 13:59:14', '2025-05-21 13:59:37', '2025-05-21 13:59:37'),
(23, 'Jcfjjgjgjgjg', '1234567899', 0.00, NULL, 'srdf', 'chvjjvvj@gmail.com', NULL, NULL, NULL, '$2y$10$jPp74sf9xCgEPx4JWVKIye3I84AEopJ.f.7YNfQ6kcPl/HSjoZzDe', NULL, NULL, 'A', '2025-05-21 14:01:48', '2025-05-21 14:02:32', '2025-05-21 14:02:32'),
(24, 'Ghihhhh', '5678901234', 0.00, NULL, 'srdf', 'tr@gmail.com', NULL, NULL, NULL, '$2y$10$6XMa3Raa7.QeLu2Xx784WO8OtntUUgnIt/Sxd9peLqNG/S5F7Cax6', NULL, NULL, 'A', '2025-05-21 14:05:28', '2025-05-21 14:06:09', '2025-05-21 14:06:09'),
(25, 'Uglyfycycyyc', '8963255555', 0.00, NULL, 'srdf', 'mkh@gmail.com', NULL, NULL, NULL, '$2y$10$fwzs3sIkYcte/mpvSFZxlOGYVCYnESBTBOHUXva2ZBHpg5miXPOm2', NULL, NULL, 'A', '2025-05-21 14:09:07', '2025-05-21 14:09:33', '2025-05-21 14:09:33'),
(26, 'Chjjjhyy', '7890123455', 0.00, NULL, 'srdf', 'ty@gmail.com', NULL, NULL, NULL, '$2y$10$bYDPu1C6jc0Ccs1gU7bJnutFSg1o2mXntM/MJ3FLXkIcXGGeV8Xji', NULL, NULL, 'A', '2025-05-21 14:11:40', '2025-05-21 14:14:05', '2025-05-21 14:14:05'),
(27, 'Mukul', '8901234567', 0.00, NULL, 'srdf', 'mjh@gmail.com', NULL, NULL, NULL, '$2y$10$OepHcX9.AmcmerfT7SvyOOCSoJaha/4sQRklABAY/8iTjwQddcbTC', NULL, NULL, 'A', '2025-05-21 14:23:00', '2025-05-21 14:23:30', '2025-05-21 14:23:30'),
(28, 'Sagar', '7980602961', 0.00, NULL, NULL, 'sd2997312@gmail.com', NULL, NULL, NULL, '$2y$10$N9phNQ6qqaXO2sb/NI54p.jpwn/i1aNcO46PFzubTAxqCOAP5FcMi', NULL, NULL, 'A', '2025-05-27 18:13:06', '2025-05-30 14:19:19', NULL),
(29, 'Sk Soriful', '9330790727', 0.00, NULL, NULL, 'soriful.siance@gmail.com', NULL, NULL, NULL, '$2y$10$agw6yAI39XNR9grh.TjtEOASZpESN5cexmCoecrf8x02d72JyY21O', NULL, NULL, 'A', '2025-05-30 12:24:00', '2025-05-30 12:24:00', NULL),
(30, 'Mukul', '9457505057', 0.00, NULL, NULL, 'mkl@gmail.com', NULL, NULL, NULL, '$2y$10$r/Zsl7zNNOm.sn5Q9SD2a.wb76Q19OFdz1eazYk9UjbNjxGugSlsS', NULL, NULL, 'A', '2025-06-05 20:04:25', '2025-06-05 20:04:25', NULL),
(31, 'Bolbo na', '+919800846443', 0.00, NULL, NULL, 'chippp@gmail.com', NULL, NULL, NULL, '$2y$10$4hxo4bQ2m8IvwnHv3GY1OunbR4dt4P8xyqnq0ZjusaXg3fn6d6HHO', NULL, NULL, 'A', '2025-06-06 13:47:57', '2025-06-06 13:47:57', NULL),
(32, 'Bolbona', '8145073824', 0.00, NULL, NULL, 'chupp@gmail.com', NULL, NULL, NULL, '$2y$10$es2mSK59Sjp0DrvrW6xWSuZd06Aavor0QYao8rrgUt98oixufF0rC', NULL, NULL, 'A', '2025-06-06 13:50:11', '2025-06-06 13:50:11', NULL),
(33, 'RaJU SHAW', '9331840219', 0.00, NULL, NULL, 'rajushaw575@gmail.com', NULL, NULL, NULL, '$2y$10$9/IqEwGiPTbp6tKYWA704.dPc2lBz60z5R1VfGGVNmQTeGBYph0.y', NULL, NULL, 'A', '2025-06-07 14:17:17', '2025-06-07 14:17:17', NULL),
(34, 'Jahir', '+917337706220', 0.00, NULL, NULL, 'uddinsekhjahir59@gmail.com', NULL, NULL, NULL, '$2y$10$M7Vj848U4X5V205GADT5.emOEXTU7LE8NDtTlSTvTp7k90YdguZZO', NULL, NULL, 'A', '2025-06-09 22:10:44', '2025-06-09 22:10:44', NULL),
(35, 'Samir', '9831333244', 0.00, NULL, NULL, 'mastersarkar2020@gmail.com', NULL, NULL, NULL, '$2y$10$laLbj1Mg0d29ar8SJ2S8TeX89Z0PXb9x.gDrmT740m1TTEDoPh42y', NULL, NULL, 'A', '2025-06-09 23:33:13', '2025-06-09 23:33:13', NULL),
(36, 'Sanjib Barai', '+918777347', 0.00, NULL, NULL, 'sanjibbarai74@gmail.com', NULL, NULL, NULL, '$2y$10$XidcjUkEplwyDj205YPA2eeU0Y0zmkE58.jDX5o05l9YbV53GhVQe', NULL, NULL, 'A', '2025-06-11 18:25:14', '2025-06-11 18:25:14', NULL),
(37, 'Sanjib Barai', '8777347811', 0.00, NULL, NULL, 'sbbarai2021@gmail.com', NULL, NULL, NULL, '$2y$10$.GbVgumj/XJzB6c9pAZEIu0e/zIJTQocSiCxbZCdrC9xEOuLQSDta', NULL, NULL, 'A', '2025-06-11 18:28:26', '2025-06-11 18:28:26', NULL),
(38, 'Chiku', '7506025641', 0.00, NULL, NULL, 'mandalravi298@gmail.com', NULL, NULL, NULL, '$2y$10$TZX2Ldpz1wAu2.zYNueTJO2xivS1DQizdrNc.XZVMkF2NeYB6iIwy', NULL, NULL, 'A', '2025-06-11 18:30:09', '2025-06-11 18:30:09', NULL),
(39, 'Sagar roy', '9007203059', 0.00, NULL, NULL, 'sy965310611@gmail.com', NULL, NULL, NULL, '$2y$10$./l17ggo3a0/UTpjajlNWOQv/shol3BYF0ch5di2og7YV/O/UiFJe', NULL, NULL, 'A', '2025-06-11 18:35:06', '2025-06-11 18:35:06', NULL),
(40, 'Jahir Uddin sekh', '7337706220', 0.00, NULL, NULL, 'uddinsekhjahir58@gmail.com', NULL, NULL, NULL, '$2y$10$n5.lCuerJjq6MklLhrwVWOdUvIC.ajB6DiQfuhrvDwpObDXo5RAWm', NULL, NULL, 'A', '2025-06-11 18:47:04', '2025-06-11 18:47:04', NULL),
(41, 'Supriya Upadhyay', '9903749451', 0.00, NULL, NULL, 'siances@gmail.com', NULL, NULL, NULL, '$2y$10$u8jKeteMUb0ZxyVrl17VBOmx1vf4FUHVSaNxfow/QnWf8b20pS.eG', NULL, NULL, 'A', '2025-06-11 18:58:32', '2025-06-11 18:58:32', NULL),
(42, 'Mukesh sharma', '8859505703', 0.00, NULL, NULL, 'mkg@gmail.com', 'male', '2025-06-12', NULL, '$2y$10$S3VjgbeBrgz4xFFgxrvwGOv01WuFwd9Hk/NwDFhoWDS.toQJk.HB2', '5010', NULL, 'A', '2025-06-11 19:12:18', '2025-07-17 13:22:17', NULL),
(43, 'Susanta mondal', '7003576647', 0.00, NULL, NULL, 'susantakpa1996@gmail.com', NULL, NULL, NULL, '$2y$10$l1xlQZ0tQjxbCGq.xY/wDummHXsucSpExzoF.wcDFdPvdqm3m9zqm', NULL, NULL, 'A', '2025-06-11 20:12:56', '2025-06-11 20:12:56', NULL),
(44, 'Shyamal Das', '9831472429', 0.00, NULL, NULL, 'das93shyamal@gmail.com', NULL, NULL, NULL, '$2y$10$JYJzAQFnFnNg.P16.SUviuZXQp1a5ov4I8YXJcEXYWaMXAD5Ub3.y', NULL, NULL, 'A', '2025-06-11 20:19:11', '2025-06-11 20:19:11', NULL),
(45, 'Sanju Sil', '9804828663', 0.00, NULL, NULL, 'sanjusil216@gmail.com', NULL, NULL, NULL, '$2y$10$3qL7OkPZWMs8Ln7/DCPQK.cmrMWHGuZEQ6MbqVtM6wtEmS..1igd2', NULL, NULL, 'A', '2025-06-13 09:18:07', '2025-06-13 09:18:07', NULL),
(46, 'Hrishikesh Giri', '9123605889', 0.00, NULL, NULL, 'hrishikeshgiri720@gmail.com', NULL, NULL, NULL, '$2y$10$rfFmzWO9wfrjd1MWKwlu8O7I.kOzkcZ3VNYW6Lcm6kzuKdLyq82M.', NULL, NULL, 'A', '2025-06-17 18:32:04', '2025-06-17 20:25:21', NULL),
(47, 'Priyanka Singh', '8745214578', 0.00, NULL, NULL, 'priyanka12@gmail.com', 'Female', '2010-06-07', 'Serampore hooghly', NULL, NULL, NULL, 'A', '2025-06-17 18:55:39', '2025-06-17 19:15:46', NULL),
(48, 'Vikram kumar', '9999999985', 0.00, NULL, NULL, 'vikram1287@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'A', '2025-06-20 13:34:01', '2025-06-20 13:34:01', NULL),
(49, 'Vikram kumar', '9999999975', 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5463', NULL, 'A', '2025-06-20 15:00:14', '2025-06-20 15:56:20', NULL),
(50, 'Vikram kumar', '9999999978', 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', '2025-06-20 15:02:42', '2025-06-20 15:02:42', NULL),
(51, 'Rita Kumari', '9999977975', 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '468066', NULL, 'A', '2025-06-20 15:13:53', '2025-06-20 09:51:10', NULL),
(52, 'bikash kumar', '9999977989', 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '398201', NULL, 'A', '2025-06-20 15:18:37', '2025-06-20 15:18:37', NULL),
(53, 'bikash kumar', '9999977345', 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5372', NULL, 'A', '2025-06-20 16:17:21', '2025-06-20 16:17:21', NULL),
(54, 'Ankit', '8859634552', 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4940', NULL, 'A', '2025-06-20 16:19:41', '2025-06-20 16:19:41', NULL),
(55, 'Ankit', '8859634556', 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7233', NULL, 'A', '2025-06-20 16:20:06', '2025-06-20 16:20:06', NULL),
(56, 'Narottam Mondal', '9875646235', 0.00, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$Xl3vpjNAQ3kyyIdzVwFaUefjdvlSx1EKkRZpFk9MVxhoVlLQufD.K', '7646', NULL, 'A', '2025-06-20 17:22:48', '2025-06-20 17:22:48', NULL),
(57, 'Narottam Mondal', '9903698970', 0.00, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$SaRVrBw9H0nU7artcY7.judmaTkmWL3ZBxZKi2K8GZZNHYO1ePedS', '1288', NULL, 'A', '2025-06-20 17:25:08', '2025-06-20 17:25:08', NULL),
(58, 'Savan', '729313081', 0.00, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$Dkb72Mdzkudrry0ZIZgcae0XD6.Usdu6qNLDYMtadNXQj41CrbAES', '5750', NULL, 'A', '2025-06-21 03:26:50', '2025-06-21 03:26:50', NULL),
(59, 'Alondra', '933486531', 0.00, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$ziN/y/d2flIqMVxQm.Um4O7Sb3IeGpjyDgUyDXgWsJx.g6zbc2EWO', '6475', NULL, 'A', '2025-06-21 06:26:04', '2025-06-21 06:26:04', NULL),
(61, 'bikash kumar', '8910599782', 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2387', NULL, 'A', '2025-06-26 15:27:20', '2025-06-26 15:27:20', NULL),
(62, 'Rupa kumar', '9985977975', 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3405', NULL, 'A', '2025-06-26 15:49:46', '2025-06-26 15:49:46', NULL),
(63, 'vikram chauhan', '7777778888', 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8701', NULL, 'A', '2025-06-26 18:45:35', '2025-06-29 12:55:23', NULL),
(64, 'Gobinda Ghosh', '6290353232', 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6285', NULL, 'A', '2025-06-26 21:28:08', '2025-06-26 21:30:15', NULL),
(65, 'Ankan', '7908164353', 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7104', NULL, 'A', '2025-07-09 22:17:29', '2025-07-10 23:07:24', NULL),
(66, 'Ankan', '9547128628', 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6672', NULL, 'A', '2025-07-10 23:05:49', '2025-07-10 23:05:49', NULL),
(67, 'Milan Mondal', '76880189', 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9006', NULL, 'A', '2025-07-15 20:47:00', '2025-07-15 20:47:00', NULL),
(68, 'Milan Mondal', '7688018910', 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1707', NULL, 'A', '2025-07-15 20:47:14', '2025-07-15 20:47:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_addresses`
--

CREATE TABLE `user_addresses` (
  `id` bigint(20) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(155) DEFAULT NULL,
  `mobile_no` bigint(20) DEFAULT 0,
  `pincode` varchar(6) DEFAULT '0',
  `country` varchar(155) DEFAULT NULL,
  `state` varchar(155) DEFAULT NULL,
  `city` varchar(155) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `status` varchar(22) DEFAULT 'Active' COMMENT 'Pending,Approved,Reject',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_addresses`
--

INSERT INTO `user_addresses` (`id`, `user_id`, `name`, `mobile_no`, `pincode`, `country`, `state`, `city`, `address`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 1, 'Kishor Mondal', 9898989898, '712103', 'India', 'West Bengal', 'Chinsurah', 'Krishnapur', 'Active', '2024-11-13 18:06:41', '2024-11-13 18:09:37', '2024-11-13 18:09:37'),
(2, 1, 'Kishor Mondal', 9898989891, '712103', 'India', 'West Bengal', 'Chinsurah', 'Krishnapur', 'Active', '2024-11-13 17:51:25', '2024-11-14 15:11:09', '2024-11-14 15:11:09'),
(4, 1, 'Ishani', 9632569636, '765434', 'India', 'West bengal', 'Kolkata', 'Kolkata', 'Active', '2024-11-13 18:51:04', '2024-11-14 15:11:52', '2024-11-14 15:11:52'),
(5, 1, 'Kishor Mondal', 9898989898, '712103', 'India', 'West Bengal', 'Chinsurah', 'Krishnapur', 'Active', '2024-11-14 12:43:17', '2024-11-14 12:43:17', NULL),
(6, 1, 'Ishani', 9685369632, '786578', 'India', 'West bengal', 'Kolkata', 'Dumdum', 'Active', '2024-11-14 15:26:47', '2024-11-14 15:26:47', NULL),
(7, 10, 'Chfu', 3265478956, '231456', 'Vvb', 'Cvb', 'Fvv', 'Ryg', 'Active', '2024-11-15 11:59:32', '2024-11-15 11:59:32', NULL),
(8, 1, 'Ishani', 9636998685, '876908', 'India', 'West bengal', 'Kolkata', 'Dumdum', 'Active', '2024-11-15 14:11:53', '2024-11-15 14:11:53', NULL),
(9, 4, 'Saifuddin Mondal', 9564779055, '123467', 'India', 'Kerala', 'dhsh', 'bhds', 'Active', '2024-11-15 14:17:15', '2024-11-17 14:34:19', '2024-11-17 14:34:19'),
(10, 4, 'Saifuddin Mondal', 9564779055, '987654', 'India', 'Kerala', 'dhsh', 'bhds', 'Active', '2024-11-15 14:20:25', '2024-11-17 14:35:28', '2024-11-17 14:35:28'),
(11, 1, 'Ghh', 96868856, '877856', 'Vvv', 'Cgggg', 'Gghg', 'Ghh', 'Active', '2024-11-15 15:20:15', '2024-11-15 15:20:15', NULL),
(12, 1, 'Ishani', 9636963696, '879098', 'India', 'West bengal', 'Kolkata', 'Dumdum', 'Active', '2024-11-15 16:08:43', '2024-11-15 16:08:43', NULL),
(13, 1, 'Ishani', 9636963696, '879098', 'India', 'West bengal', 'Kolkata', 'Dumdum', 'Active', '2024-11-15 16:08:51', '2024-11-15 16:08:51', NULL),
(14, 1, 'Ishani', 9636963696, '879098', 'India', 'West bengal', 'Kolkata', 'Dumdum', 'Active', '2024-11-15 16:09:37', '2024-11-15 16:09:37', NULL),
(15, 1, 'Ishani', 9636963696, '879098', 'India', 'West bengal', 'Kolkata', 'Dumdum', 'Active', '2024-11-15 16:10:01', '2024-11-15 16:10:01', NULL),
(16, 11, 'Sanjib Barai', 8777347811, '741245', 'India', 'West Bengal', 'Kalyani', 'Kalyani', 'Active', '2024-11-15 17:13:03', '2024-11-15 17:13:03', NULL),
(17, 4, 'Saifuddin Mondal', 9564779055, '713424', 'India', 'west bengal', 'Bardhaman', 'Badulia', 'Active', '2024-11-17 13:18:13', '2024-11-17 13:18:13', NULL),
(18, 4, 'Saifuddin Mondal', 9564779055, '741235', 'India', 'west bengal', 'Bardhaman', 'Badulia', 'Active', '2024-11-17 13:18:56', '2024-11-17 14:41:02', '2024-11-17 14:41:02'),
(19, 1, 'Kishor Mondal', 9898989898, '712103', 'India', 'West Bengal', 'Chinsurah', 'Krishnapur', 'Active', '2024-11-22 16:04:45', '2024-11-22 16:04:45', NULL),
(20, 6, 'Sabhfdjfbhjewhbje', 8909092987, '201306', 'India', 'Uttar pradesh', 'Noida', 'Bhebhfhbewhfb', 'Active', '2025-05-12 19:14:23', '2025-06-01 17:47:54', '2025-06-01 17:47:54'),
(21, 6, 'Mmmmmm', 8909092987, '210301', 'India', 'Uttar Pradesh', 'Noice', 'Noida', 'Active', '2025-06-04 10:22:14', '2025-06-06 15:15:33', '2025-06-06 15:15:33'),
(22, 6, 'Mukul', 8909092987, '201306', 'India', 'Uttar Pradesh', 'Noida', 'N-501', 'Active', '2025-06-06 15:45:31', '2025-06-08 13:17:51', NULL),
(23, 6, 'Nakul', 8909092987, '201302', 'India', 'State', 'Agra', 'Agra', 'Active', '2025-06-08 13:24:50', '2025-06-10 11:48:00', '2025-06-10 11:48:00'),
(24, 42, 'Mukul Sharma', 8909092987, '201306', 'India', 'Uttar Pradesh', 'Noida', 'Stellar jeevan', 'Active', '2025-06-11 19:23:27', '2025-06-11 19:23:27', NULL),
(25, 37, 'Sanjib', 8777347811, '741235', 'India', 'Wb', 'Kalyani', 'Avinya', 'Active', '2025-06-17 20:34:02', '2025-06-17 20:34:02', NULL),
(26, 18, 'Mukul Sharma', 8909092987, '123456', 'India', 'Uttar Pradesh', 'Noida', 'Noida', 'Active', '2025-06-20 19:58:49', '2025-06-20 19:58:49', NULL),
(27, 64, 'Akash ghoah', 6290353232, '743145', 'India', 'West bengal', 'Kanchrapara', '524, siraj mondal road', 'Active', '2025-06-26 21:32:02', '2025-06-26 21:32:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_restaurant_tables`
--

CREATE TABLE `user_restaurant_tables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `restaurant_id` bigint(20) UNSIGNED NOT NULL,
  `table_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_restaurant_tables`
--

INSERT INTO `user_restaurant_tables` (`id`, `user_id`, `restaurant_id`, `table_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, '2025-03-12 10:59:35', '2025-06-18 16:24:19'),
(2, 1, 5, 1, '2025-04-09 06:24:41', '2025-04-09 11:54:41'),
(3, 4, 5, NULL, '2025-04-09 07:31:48', '2025-05-19 18:17:56'),
(4, 4, 1, 1, '2025-05-09 11:06:13', '2025-06-26 13:51:07'),
(5, 4, 2, NULL, '2025-05-09 11:41:15', '2025-05-09 17:11:15'),
(6, 6, 5, NULL, '2025-05-09 15:03:10', '2025-05-22 13:42:19'),
(7, 6, 2, NULL, '2025-05-09 15:39:09', '2025-05-21 12:11:59'),
(8, 6, 4, NULL, '2025-05-09 15:40:02', '2025-05-21 11:52:33'),
(9, 6, 3, NULL, '2025-05-09 15:40:07', '2025-05-21 11:52:38'),
(10, 18, 1, NULL, '2025-05-12 04:46:32', '2025-05-12 10:16:46'),
(11, 18, 1, NULL, '2025-05-12 04:46:32', '2025-05-12 10:16:32'),
(12, 18, 2, NULL, '2025-05-12 04:46:39', '2025-05-12 10:16:44'),
(13, 18, 2, NULL, '2025-05-12 04:46:39', '2025-05-12 10:16:39'),
(14, 18, 5, NULL, '2025-05-12 04:47:11', '2025-05-12 10:17:11'),
(15, 18, 5, NULL, '2025-05-12 04:47:11', '2025-05-12 10:17:11'),
(16, 6, 1, NULL, '2025-05-21 05:48:48', '2025-06-12 16:49:03'),
(17, 6, 1, NULL, '2025-05-21 05:48:48', '2025-05-21 11:18:48'),
(18, 29, 1, NULL, '2025-05-30 10:35:04', '2025-05-30 18:40:03'),
(19, 38, 1, NULL, '2025-06-11 13:01:41', '2025-06-11 18:39:59'),
(20, 37, 1, NULL, '2025-06-11 13:03:16', '2025-06-17 21:26:20'),
(21, 39, 1, NULL, '2025-06-11 13:05:38', '2025-06-11 18:39:25'),
(22, 40, 1, NULL, '2025-06-11 13:18:27', '2025-06-11 18:48:27'),
(23, 42, 1, NULL, '2025-06-11 13:48:06', '2025-06-18 08:11:42'),
(24, 43, 1, NULL, '2025-06-11 14:44:33', '2025-06-13 20:23:42'),
(25, 44, 1, NULL, '2025-06-11 14:50:38', '2025-06-15 11:12:26'),
(26, 45, 1, NULL, '2025-06-13 03:48:49', '2025-06-13 19:55:30'),
(27, 46, 1, NULL, '2025-06-17 14:56:13', '2025-06-17 20:33:05'),
(28, 60, 1, 1, '2025-06-29 08:32:21', '2025-06-29 14:02:21');

-- --------------------------------------------------------

--
-- Table structure for table `websiteconfigs`
--

CREATE TABLE `websiteconfigs` (
  `id` bigint(20) NOT NULL,
  `bank_name` varchar(55) DEFAULT NULL,
  `account_holder` varchar(55) DEFAULT NULL,
  `account_no` varchar(22) DEFAULT NULL,
  `ifsc` varchar(22) DEFAULT NULL,
  `admin_charge` int(11) NOT NULL DEFAULT 5,
  `tds_charge` int(11) NOT NULL DEFAULT 5,
  `app_version` varchar(10) DEFAULT NULL,
  `maintainance_mode` enum('YES','NO') DEFAULT 'NO',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `websiteconfigs`
--

INSERT INTO `websiteconfigs` (`id`, `bank_name`, `account_holder`, `account_no`, `ifsc`, `admin_charge`, `tds_charge`, `app_version`, `maintainance_mode`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, NULL, NULL, NULL, 0, 0, '1', 'NO', '2024-04-02 11:21:48', '2024-10-29 16:10:57', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `adminsettlements`
--
ALTER TABLE `adminsettlements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins_permission`
--
ALTER TABLE `admins_permission`
  ADD PRIMARY KEY (`admin_id`,`permission_id`),
  ADD KEY `admins_permission_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `admins_role`
--
ALTER TABLE `admins_role`
  ADD PRIMARY KEY (`admin_id`,`role_id`),
  ADD KEY `admins_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `admin_charges`
--
ALTER TABLE `admin_charges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_categories_restaurant` (`restaurant_id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_charges`
--
ALTER TABLE `delivery_charges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `drivers_license_number_unique` (`license_number`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `employee_attendances`
--
ALTER TABLE `employee_attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_attendances_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `employee_roles`
--
ALTER TABLE `employee_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_roles_employee_id_role_id_unique` (`employee_id`,`role_id`);

--
-- Indexes for table `mainpermission`
--
ALTER TABLE `mainpermission`
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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_types`
--
ALTER TABLE `order_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurant_categories`
--
ALTER TABLE `restaurant_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurant_tablenumbers`
--
ALTER TABLE `restaurant_tablenumbers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resturants_tables`
--
ALTER TABLE `resturants_tables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `roles_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sms_transaction`
--
ALTER TABLE `sms_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mobile` (`mobile`);

--
-- Indexes for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_restaurant_tables`
--
ALTER TABLE `user_restaurant_tables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `websiteconfigs`
--
ALTER TABLE `websiteconfigs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `adminsettlements`
--
ALTER TABLE `adminsettlements`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_charges`
--
ALTER TABLE `admin_charges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=349;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `delivery_charges`
--
ALTER TABLE `delivery_charges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employee_attendances`
--
ALTER TABLE `employee_attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employee_roles`
--
ALTER TABLE `employee_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `mainpermission`
--
ALTER TABLE `mainpermission`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=219;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=388;

--
-- AUTO_INCREMENT for table `order_types`
--
ALTER TABLE `order_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8354;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=430;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `restaurant_categories`
--
ALTER TABLE `restaurant_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `restaurant_tablenumbers`
--
ALTER TABLE `restaurant_tablenumbers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `resturants_tables`
--
ALTER TABLE `resturants_tables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `sms_transaction`
--
ALTER TABLE `sms_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `user_addresses`
--
ALTER TABLE `user_addresses`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user_restaurant_tables`
--
ALTER TABLE `user_restaurant_tables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `websiteconfigs`
--
ALTER TABLE `websiteconfigs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee_attendances`
--
ALTER TABLE `employee_attendances`
  ADD CONSTRAINT `employee_attendances_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
