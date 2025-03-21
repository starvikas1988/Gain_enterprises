-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2025 at 07:27 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u220041557_catererktm`
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
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$K0G4VlPUXCIYc849S1BYA.AMqymQW2iHbbuE9Wrw9e6zRtkb23YRG', NULL, 9999999999, 'Kalyani', 'A', '2024-04-01 13:32:34', '2024-04-02 09:44:33');

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
(1, 1, '2024-04-01 08:23:49', '2024-04-01 08:23:49'),
(5, 1, '2025-03-13 11:59:21', '2025-03-13 11:59:21');

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
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `restaurant_id`, `product_id`, `qty`, `product_price`, `total_amount`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 1, 1, 4, 5, 999.00, 4995.00, '2024-11-04 13:53:45', '2025-02-13 18:57:52', NULL),
(4, 1, 1, 3, 1, 599.00, 599.00, '2024-11-10 18:00:42', '2024-11-11 18:23:29', NULL),
(5, 1, 1, 2, 1, 499.00, 499.00, '2024-11-12 15:51:32', '2024-11-12 16:56:58', NULL),
(11, 8, 1, 1, 5, 899.00, 4495.00, '2024-11-13 16:14:09', '2024-11-13 16:21:57', NULL),
(12, 9, 1, 3, 10, 599.00, 5990.00, '2024-11-14 20:39:54', '2024-11-14 20:40:44', NULL),
(13, 9, 1, 4, 7, 999.00, 6993.00, '2024-11-14 20:39:55', '2024-11-14 20:40:45', NULL),
(14, 9, 1, 2, 5, 499.00, 2495.00, '2024-11-14 20:40:39', '2024-11-14 20:40:42', NULL),
(15, 10, 1, 1, 1, 899.00, 899.00, '2024-11-15 11:57:19', '2024-11-15 11:57:19', NULL),
(76, 14, 1, 1, 2, 899.00, 1798.00, '2025-02-09 12:37:18', '2025-02-12 13:06:16', NULL),
(85, 14, 1, 2, 0, 499.00, 0.00, '2025-02-12 13:06:52', '2025-02-12 13:06:52', NULL),
(86, 14, 1, 3, 1, 599.00, 599.00, '2025-02-12 13:07:38', '2025-02-12 13:07:39', NULL),
(175, 4, 1, 2, 1, 499.00, 499.00, '2025-03-03 18:48:19', '2025-03-03 18:48:19', NULL),
(176, 6, 1, 3, 1, 599.00, 599.00, '2025-03-05 14:45:15', '2025-03-05 14:45:15', NULL),
(177, 6, 1, 2, 1, 499.00, 499.00, '2025-03-05 14:45:17', '2025-03-05 14:45:17', NULL),
(178, 6, 1, 1, 1, 899.00, 899.00, '2025-03-05 14:49:28', '2025-03-05 14:49:28', NULL),
(179, 6, 1, 4, 1, 999.00, 999.00, '2025-03-05 14:49:37', '2025-03-05 14:49:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon` varchar(155) DEFAULT NULL,
  `status` enum('A','D') DEFAULT 'A',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `icon`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Desserts', 'public/uploads/category/ice-cream.png', 'A', '2024-10-25 12:50:07', '2024-10-26 08:07:44', NULL),
(2, 'Sushi', 'public/uploads/category/fish.png', 'A', '2024-10-25 12:50:18', '2024-10-26 08:07:50', NULL),
(3, 'Burgers', 'public/uploads/category/food.png', 'A', '2024-10-25 12:50:37', '2024-10-26 08:07:57', NULL),
(4, 'Pizza', 'public/uploads/category/pizza-slice.png', 'A', '2024-10-25 12:50:49', '2024-10-26 08:08:02', NULL);

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
(1, 'FIRST5', '2024-11-12', '2025-11-27', 5, 200, 'GET 5% off on purchase above Rs.199', 'A', '2024-11-12 13:08:07', '2024-11-12 13:08:07', NULL);

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
(1, 'Customers', 'uil-user-circle', 1, '2024-04-02 06:51:06', '2024-04-02 06:51:06', NULL),
(2, 'Restaurants', 'uil-user-circle', 2, '2024-04-02 06:51:06', '2024-04-02 06:51:06', NULL),
(3, 'Sub Admin', 'uil-user', 12, '2024-04-02 06:51:06', '2024-04-02 06:51:06', '2024-04-02 06:51:06'),
(5, 'Setting', 'uil-slack', 6, '2024-04-02 06:51:06', '2024-04-02 06:51:06', NULL),
(16, 'Pages', 'uil-cloud-download', 9, '2024-04-02 06:51:06', '2024-04-02 06:51:06', '2024-04-02 06:59:20'),
(17, 'Reports', 'uil-cloud-download', 8, '2024-04-02 06:51:06', '2024-04-02 06:51:06', '2024-04-02 07:00:54'),
(20, 'Admin Settlement', 'uil-cloud-download', 7, '2024-04-02 06:51:06', '2024-04-02 06:51:06', '2024-04-02 07:00:47'),
(21, 'Notifications', 'uil-cloud-download', 4, '2024-04-02 06:51:06', '2024-04-02 06:51:06', '2024-04-02 07:00:41'),
(23, 'Wallet Reports', 'uil-cloud-download', 3, '2024-04-02 06:51:06', '2024-04-02 06:51:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `restaurant_id`, `payment_type`, `table_id`, `order_type`, `booking_platform`, `address_id`, `created_by`, `total_amount`, `total_tax`, `gst_percentage`, `gst_type`, `cgst`, `sgst`, `total_discount`, `coupon_amount`, `coupon_code`, `order_status`, `payment_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, NULL, NULL, NULL, 'Delivery', NULL, NULL, 'APP', 2297.00, 246.11, 12, 'Including', 123.05, 123.05, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-08 17:52:21', '2024-11-08 17:52:21', NULL),
(2, 1, NULL, NULL, NULL, 'Dine In', NULL, NULL, 'APP', 2297.00, 246.11, 12, 'Including', 123.05, 123.05, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-08 18:27:44', '2024-11-08 18:27:44', NULL),
(3, 1, NULL, NULL, NULL, 'Dine In', NULL, NULL, 'APP', 899.00, 96.32, 12, 'Including', 48.16, 48.16, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-10 12:10:06', '2024-11-10 12:10:06', NULL),
(4, 1, NULL, NULL, NULL, 'Dine In', NULL, NULL, 'APP', 1198.00, 128.36, 12, 'Including', 64.18, 64.18, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-10 18:00:57', '2024-11-10 18:00:57', NULL),
(5, 1, NULL, NULL, NULL, 'Dine In', NULL, NULL, 'APP', 1198.00, 128.36, 12, 'Including', 64.18, 64.18, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-10 18:02:04', '2024-11-10 18:02:04', NULL),
(6, 1, NULL, NULL, NULL, 'Delivery', NULL, NULL, 'APP', 2297.00, 246.11, 12, 'Including', 123.05, 123.05, 0.00, 0.00, NULL, 'Pending', 'FAILED', '2024-11-11 15:52:35', '2024-11-15 17:45:02', NULL),
(7, 1, NULL, NULL, NULL, 'Dine In', NULL, NULL, 'APP', 1398.00, 149.79, 12, 'Including', 74.89, 74.89, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-11 16:31:13', '2024-11-11 16:31:13', NULL),
(8, 1, NULL, NULL, NULL, 'Dine In', NULL, NULL, 'APP', 1398.00, 149.79, 12, 'Including', 74.89, 74.89, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-11 16:40:12', '2024-11-11 16:40:12', NULL),
(9, 1, NULL, NULL, NULL, 'Dine In', NULL, NULL, 'APP', 1398.00, 149.79, 12, 'Including', 74.89, 74.89, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-11 17:34:08', '2024-11-11 17:34:08', NULL),
(10, 1, NULL, NULL, NULL, 'Dine In', NULL, NULL, 'APP', 1398.00, 149.79, 12, 'Including', 74.89, 74.89, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-11 17:44:07', '2024-11-11 17:44:07', NULL),
(11, 1, NULL, NULL, NULL, 'Dine In', NULL, NULL, 'APP', 1398.00, 149.79, 12, 'Including', 74.89, 74.89, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-11 18:12:36', '2024-11-11 18:12:36', NULL),
(12, 1, NULL, NULL, NULL, 'Dine In', NULL, NULL, 'APP', 499.00, 53.46, 12, 'Including', 26.73, 26.73, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-11 18:20:35', '2024-11-11 18:20:35', NULL),
(13, 1, NULL, NULL, NULL, 'Dine In', NULL, NULL, 'APP', 1198.00, 128.36, 12, 'Including', 64.18, 64.18, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-11 18:23:39', '2024-11-11 18:23:39', NULL),
(14, 1, NULL, NULL, NULL, 'Dine In', NULL, NULL, 'APP', 1198.00, 128.36, 12, 'Including', 64.18, 64.18, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-11 18:55:52', '2024-11-11 18:55:52', NULL),
(15, 1, NULL, NULL, NULL, 'Delivery', NULL, NULL, 'APP', 2297.00, 246.11, 12, 'Including', 123.05, 123.05, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-12 16:17:21', '2024-11-12 16:17:21', NULL),
(16, 1, NULL, NULL, NULL, 'Delivery', NULL, NULL, 'APP', 2182.15, 246.11, 12, 'Including', 123.05, 123.05, 114.85, 114.85, 'FIRST5', 'Pending', 'Pending', '2024-11-12 16:18:54', '2024-11-12 16:18:54', NULL),
(17, 1, NULL, NULL, NULL, 'Dine In', NULL, NULL, 'APP', 2496.00, 267.43, 12, 'Including', 133.71, 133.71, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-12 16:20:09', '2024-11-12 16:20:09', NULL),
(18, 1, NULL, NULL, NULL, 'Dine In', NULL, NULL, 'APP', 2496.00, 267.43, 12, 'Including', 133.71, 133.71, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-12 16:22:18', '2024-11-12 16:22:18', NULL),
(19, 1, NULL, NULL, NULL, 'Delivery', NULL, NULL, 'APP', 2182.15, 246.11, 12, 'Including', 123.05, 123.05, 114.85, 114.85, 'FIRST5', 'Pending', 'Pending', '2024-11-12 16:25:53', '2024-11-12 16:25:53', NULL),
(20, 1, NULL, NULL, NULL, 'Dine In', NULL, NULL, 'APP', 899.00, 96.32, 12, 'Including', 48.16, 48.16, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-12 19:27:06', '2024-11-12 19:27:06', NULL),
(21, 1, NULL, NULL, NULL, 'Dine In', NULL, NULL, 'APP', 1398.00, 149.79, 12, 'Including', 74.89, 74.89, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-12 19:29:13', '2024-11-12 19:29:13', NULL),
(22, 1, NULL, NULL, NULL, 'Dine In', NULL, NULL, 'APP', 899.00, 96.32, 12, 'Including', 48.16, 48.16, 0.00, 0.00, NULL, 'Processing', 'SUCCESS', '2024-11-13 11:40:08', '2024-11-13 11:42:54', NULL),
(23, 1, NULL, NULL, NULL, 'Dine In', NULL, NULL, 'APP', 899.00, 96.32, 12, 'Including', 48.16, 48.16, 0.00, 0.00, NULL, 'Processing', 'SUCCESS', '2024-11-13 11:49:00', '2024-11-13 11:49:35', NULL),
(24, 1, NULL, NULL, NULL, 'Delivery', NULL, NULL, 'APP', 2182.15, 246.11, 12, 'Including', 123.05, 123.05, 114.85, 114.85, 'FIRST5', 'Pending', 'Pending', '2024-11-13 16:17:31', '2024-11-13 16:17:31', NULL),
(25, 1, NULL, NULL, NULL, 'Delivery', NULL, '2', 'APP', 2182.15, 246.11, 12, 'Including', 123.05, 123.05, 114.85, 114.85, 'FIRST5', 'Pending', 'Pending', '2024-11-13 18:27:44', '2024-11-13 18:27:44', NULL),
(26, 1, NULL, NULL, NULL, 'Delivery', NULL, '5', 'APP', 1398.00, 149.79, 12, 'Including', 74.89, 74.89, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-14 15:33:07', '2024-11-14 15:33:07', NULL),
(27, 1, NULL, NULL, NULL, 'Delivery', NULL, '5', 'APP', 1398.00, 149.79, 12, 'Including', 74.89, 74.89, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-14 15:33:31', '2024-11-14 15:33:31', NULL),
(28, 1, NULL, NULL, NULL, 'Delivery', NULL, '6', 'APP', 1398.00, 149.79, 12, 'Including', 74.89, 74.89, 0.00, 0.00, NULL, 'Processing', 'SUCCESS', '2024-11-14 15:35:40', '2024-11-14 15:36:44', NULL),
(29, 1, NULL, NULL, NULL, 'Delivery', NULL, '5', 'APP', 899.00, 96.32, 12, 'Including', 48.16, 48.16, 0.00, 0.00, NULL, 'Processing', 'SUCCESS', '2024-11-14 21:02:59', '2024-11-14 21:04:05', NULL),
(30, 1, NULL, NULL, NULL, 'Delivery', NULL, '6', 'APP', 899.00, 96.32, 12, 'Including', 48.16, 48.16, 0.00, 0.00, NULL, 'Processing', 'SUCCESS', '2024-11-14 21:05:06', '2024-11-14 21:05:44', NULL),
(31, 1, NULL, NULL, NULL, 'Dine In', NULL, '15', 'APP', 899.00, 96.32, 12, 'Including', 48.16, 48.16, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-15 16:13:36', '2024-11-15 16:13:36', NULL),
(32, 1, NULL, NULL, NULL, 'Dine In', NULL, '15', 'APP', 899.00, 96.32, 12, 'Including', 48.16, 48.16, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-15 16:13:37', '2024-11-15 16:13:37', NULL),
(33, 1, NULL, NULL, NULL, 'Dine In', NULL, '15', 'APP', 899.00, 96.32, 12, 'Including', 48.16, 48.16, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-15 16:13:46', '2024-11-15 16:13:46', NULL),
(34, 4, NULL, NULL, NULL, 'Delivery', NULL, '9', 'APP', 2697.00, 288.96, 12, 'Including', 144.48, 144.48, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-15 16:14:27', '2024-11-15 16:14:27', NULL),
(35, 4, NULL, NULL, NULL, 'Delivery', NULL, '9', 'APP', 2697.00, 288.96, 12, 'Including', 144.48, 144.48, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-15 16:26:32', '2024-11-15 16:26:32', NULL),
(36, 4, NULL, NULL, NULL, 'Delivery', NULL, '9', 'APP', 4194.00, 449.36, 12, 'Including', 224.68, 224.68, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-15 16:27:35', '2024-11-15 16:27:35', NULL),
(37, 4, NULL, NULL, NULL, 'Delivery', NULL, '9', 'APP', 4194.00, 449.36, 12, 'Including', 224.68, 224.68, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-15 16:27:44', '2024-11-15 16:27:44', NULL),
(38, 4, NULL, NULL, NULL, 'Delivery', NULL, '9', 'APP', 4194.00, 449.36, 12, 'Including', 224.68, 224.68, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-15 16:33:00', '2024-11-15 16:33:00', NULL),
(39, 4, NULL, NULL, NULL, 'Delivery', NULL, '9', 'APP', 1798.00, 192.64, 12, 'Including', 96.32, 96.32, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-15 16:35:46', '2024-11-15 16:35:46', NULL),
(40, 4, NULL, NULL, NULL, 'Delivery', NULL, '9', 'APP', 1798.00, 192.64, 12, 'Including', 96.32, 96.32, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-15 16:35:55', '2024-11-15 16:35:55', NULL),
(41, 4, NULL, NULL, NULL, 'Delivery', NULL, '9', 'APP', 5592.00, 599.14, 12, 'Including', 299.57, 299.57, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-15 17:00:35', '2024-11-15 17:00:35', NULL),
(42, 11, NULL, NULL, NULL, 'Delivery', NULL, '16', 'APP', 1398.00, 149.79, 12, 'Including', 74.89, 74.89, 0.00, 0.00, NULL, 'Processing', 'SUCCESS', '2024-11-15 17:13:12', '2024-11-15 17:16:41', NULL),
(43, 4, NULL, NULL, NULL, 'Delivery', NULL, '9', 'APP', 5592.00, 599.14, 12, 'Including', 299.57, 299.57, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-15 17:16:24', '2024-11-15 17:16:24', NULL),
(44, 4, NULL, NULL, NULL, 'Delivery', NULL, '9', 'APP', 5592.00, 599.14, 12, 'Including', 299.57, 299.57, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-15 17:18:45', '2024-11-15 17:18:45', NULL),
(45, 4, NULL, NULL, NULL, 'Delivery', NULL, '9', 'APP', 5592.00, 599.14, 12, 'Including', 299.57, 299.57, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-15 17:20:06', '2024-11-15 17:20:06', NULL),
(46, 4, NULL, NULL, NULL, 'Delivery', NULL, '9', 'APP', 5592.00, 599.14, 12, 'Including', 299.57, 299.57, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-15 17:20:20', '2024-11-15 17:20:20', NULL),
(47, 4, NULL, NULL, NULL, 'Delivery', NULL, '9', 'APP', 5592.00, 599.14, 12, 'Including', 299.57, 299.57, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-15 17:22:05', '2024-11-15 17:22:05', NULL),
(48, 4, NULL, NULL, NULL, 'Delivery', NULL, '9', 'APP', 5592.00, 599.14, 12, 'Including', 299.57, 299.57, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-15 17:23:08', '2024-11-15 17:23:08', NULL),
(49, 4, NULL, NULL, NULL, 'Delivery', NULL, '9', 'APP', 5592.00, 599.14, 12, 'Including', 299.57, 299.57, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-15 17:23:55', '2024-11-15 17:23:55', NULL),
(50, 4, NULL, NULL, NULL, 'Delivery', NULL, '9', 'APP', 5592.00, 599.14, 12, 'Including', 299.57, 299.57, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-15 17:24:56', '2024-11-15 17:24:56', NULL),
(51, 4, NULL, NULL, NULL, 'Delivery', NULL, '9', 'APP', 5592.00, 599.14, 12, 'Including', 299.57, 299.57, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-15 17:28:10', '2024-11-15 17:28:10', NULL),
(52, 4, NULL, NULL, NULL, 'Delivery', NULL, '9', 'APP', 5592.00, 599.14, 12, 'Including', 299.57, 299.57, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-15 17:29:49', '2024-11-15 17:29:49', NULL),
(53, 4, NULL, NULL, NULL, 'Delivery', NULL, '9', 'APP', 5592.00, 599.14, 12, 'Including', 299.57, 299.57, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-15 17:32:02', '2024-11-15 17:32:02', NULL),
(54, 4, NULL, NULL, NULL, 'Delivery', NULL, '9', 'APP', 5592.00, 599.14, 12, 'Including', 299.57, 299.57, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-15 17:32:49', '2024-11-15 17:32:49', NULL),
(55, 4, NULL, NULL, NULL, 'Delivery', NULL, '9', 'APP', 5592.00, 599.14, 12, 'Including', 299.57, 299.57, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-15 17:33:24', '2024-11-15 17:33:24', NULL),
(56, 4, NULL, NULL, NULL, 'Delivery', NULL, '9', 'APP', 5592.00, 599.14, 12, 'Including', 299.57, 299.57, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-15 17:36:43', '2024-11-15 17:36:43', NULL),
(57, 4, NULL, NULL, NULL, 'Delivery', NULL, '9', 'APP', 5592.00, 599.14, 12, 'Including', 299.57, 299.57, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-15 17:41:26', '2024-11-15 17:41:26', NULL),
(58, 4, NULL, NULL, NULL, 'Delivery', NULL, '9', 'APP', 5592.00, 599.14, 12, 'Including', 299.57, 299.57, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-15 17:45:51', '2024-11-15 17:45:51', NULL),
(59, 4, NULL, NULL, NULL, 'Delivery', NULL, '9', 'APP', 5592.00, 599.14, 12, 'Including', 299.57, 299.57, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-15 17:51:22', '2024-11-15 17:51:22', NULL),
(60, 4, NULL, NULL, NULL, 'Delivery', NULL, '9', 'APP', 5592.00, 599.14, 12, 'Including', 299.57, 299.57, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-15 17:52:53', '2024-11-15 17:52:53', NULL),
(61, 4, NULL, NULL, NULL, 'Delivery', NULL, '9', 'APP', 5592.00, 599.14, 12, 'Including', 299.57, 299.57, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-15 17:55:03', '2024-11-15 17:55:03', NULL),
(62, 4, NULL, NULL, NULL, 'Delivery', NULL, '9', 'APP', 4693.00, 502.82, 12, 'Including', 251.41, 251.41, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-15 17:59:34', '2024-11-15 17:59:34', NULL),
(63, 4, NULL, NULL, NULL, 'Delivery', NULL, '9', 'APP', 4693.00, 502.82, 12, 'Including', 251.41, 251.41, 0.00, 0.00, NULL, 'Processing', 'SUCCESS', '2024-11-15 18:02:15', '2024-11-15 18:03:39', NULL),
(64, 4, NULL, NULL, NULL, 'Delivery', NULL, '9', 'APP', 4693.00, 502.82, 12, 'Including', 251.41, 251.41, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-15 19:03:52', '2024-11-15 19:03:52', NULL),
(65, 1, NULL, NULL, NULL, 'Delivery', NULL, '5', 'APP', 899.00, 96.32, 12, 'Including', 48.16, 48.16, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-18 11:50:43', '2024-11-18 11:50:43', NULL),
(66, 1, NULL, NULL, NULL, 'Delivery', NULL, '5', 'APP', 899.00, 96.32, 12, 'Including', 48.16, 48.16, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-18 11:51:39', '2024-11-18 11:51:39', NULL),
(67, 1, NULL, NULL, NULL, 'Delivery', NULL, '5', 'APP', 899.00, 96.32, 12, 'Including', 48.16, 48.16, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-18 11:53:17', '2024-11-18 11:53:17', NULL),
(68, 1, NULL, NULL, NULL, 'Delivery', NULL, '5', 'APP', 899.00, 96.32, 12, 'Including', 48.16, 48.16, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-18 12:59:29', '2024-11-18 12:59:29', NULL),
(69, 1, NULL, NULL, NULL, 'Dine In', NULL, NULL, 'APP', 899.00, 96.32, 12, 'Including', 48.16, 48.16, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-18 13:05:57', '2024-11-18 13:05:57', NULL),
(70, 1, NULL, NULL, NULL, 'Dine In', NULL, NULL, 'APP', 899.00, 96.32, 12, 'Including', 48.16, 48.16, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-18 13:08:06', '2024-11-18 13:08:06', NULL),
(71, 1, NULL, NULL, NULL, 'Pickup', NULL, NULL, 'APP', 899.00, 96.32, 12, 'Including', 48.16, 48.16, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-18 13:08:25', '2024-11-18 13:08:25', NULL),
(72, 1, NULL, NULL, NULL, 'Delivery', NULL, '11', 'APP', 899.00, 96.32, 12, 'Including', 48.16, 48.16, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-18 13:08:33', '2024-11-18 13:08:33', NULL),
(73, 4, NULL, NULL, NULL, 'Delivery', NULL, '17', 'APP', 8487.00, 909.32, 12, 'Including', 454.66, 454.66, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-18 16:40:21', '2024-11-18 16:40:21', NULL),
(74, 4, NULL, NULL, NULL, 'Delivery', NULL, '17', 'APP', 8487.00, 909.32, 12, 'Including', 454.66, 454.66, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-18 16:41:42', '2024-11-18 16:41:42', NULL),
(75, 4, NULL, NULL, NULL, 'Delivery', NULL, '17', 'APP', 8487.00, 909.32, 12, 'Including', 454.66, 454.66, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-18 16:51:43', '2024-11-18 16:51:43', NULL),
(76, 4, NULL, NULL, NULL, 'Delivery', NULL, '17', 'APP', 8487.00, 909.32, 12, 'Including', 454.66, 454.66, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-18 16:51:47', '2024-11-18 16:51:47', NULL),
(77, 4, NULL, NULL, NULL, 'Pickup', NULL, NULL, 'APP', 8487.00, 909.32, 12, 'Including', 454.66, 454.66, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-18 19:03:15', '2024-11-18 19:03:15', NULL),
(78, 4, NULL, NULL, NULL, 'Delivery', NULL, '17', 'APP', 2697.00, 288.96, 12, 'Including', 144.48, 144.48, 0.00, 0.00, NULL, 'Processing', 'SUCCESS', '2024-11-25 15:15:31', '2024-11-25 15:18:22', NULL),
(79, 4, NULL, NULL, NULL, 'Delivery', NULL, '17', 'APP', 899.00, 96.32, 12, 'Including', 48.16, 48.16, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-25 17:07:20', '2024-11-25 17:07:20', NULL),
(80, 4, NULL, NULL, NULL, 'Delivery', NULL, '17', 'APP', 899.00, 96.32, 12, 'Including', 48.16, 48.16, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-25 17:07:33', '2024-11-25 17:07:33', NULL),
(81, 4, NULL, NULL, NULL, 'Delivery', NULL, '17', 'APP', 899.00, 96.32, 12, 'Including', 48.16, 48.16, 0.00, 0.00, NULL, 'Processing', 'SUCCESS', '2024-11-25 17:07:49', '2024-11-25 17:09:31', NULL),
(82, 4, NULL, NULL, NULL, 'Delivery', NULL, '17', 'APP', 2697.00, 288.96, 12, 'Including', 144.48, 144.48, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-25 17:49:39', '2024-11-25 17:49:39', NULL),
(83, 4, NULL, NULL, NULL, 'Delivery', NULL, '17', 'APP', 2697.00, 288.96, 12, 'Including', 144.48, 144.48, 0.00, 0.00, NULL, 'Pending', 'Pending', '2024-11-25 17:55:16', '2024-11-25 17:55:16', NULL),
(84, 4, NULL, NULL, NULL, 'Delivery', NULL, '17', 'APP', 2697.00, 288.96, 12, 'Including', 144.48, 144.48, 0.00, 0.00, NULL, 'Processing', 'SUCCESS', '2024-11-25 17:55:32', '2024-11-25 17:56:17', NULL),
(85, 4, NULL, NULL, NULL, 'Delivery', NULL, '17', 'APP', 8990.00, 963.21, 12, 'Including', 481.61, 481.61, 0.00, 0.00, NULL, 'Processing', 'SUCCESS', '2024-11-25 18:01:00', '2024-11-25 18:02:14', NULL),
(86, 4, NULL, NULL, NULL, 'Delivery', NULL, '17', 'APP', 8990.00, 963.21, 12, 'Including', 481.61, 481.61, 0.00, 0.00, NULL, 'Processing', 'SUCCESS', '2024-11-25 18:06:45', '2024-11-25 18:07:08', NULL),
(87, 4, NULL, NULL, NULL, 'Delivery', NULL, '17', 'APP', 8990.00, 963.21, 12, 'Including', 481.61, 481.61, 0.00, 0.00, NULL, 'Processing', 'SUCCESS', '2024-11-25 18:08:20', '2024-11-25 18:08:58', NULL),
(88, 4, NULL, NULL, NULL, 'Delivery', NULL, '17', 'APP', 8990.00, 963.21, 12, 'Including', 481.61, 481.61, 0.00, 0.00, NULL, 'Processing', 'SUCCESS', '2024-11-25 18:12:46', '2024-11-25 18:13:20', NULL),
(89, 4, NULL, NULL, NULL, 'Dine In', NULL, NULL, 'APP', 1398.00, 149.79, 12, 'Including', 74.89, 74.89, 0.00, 0.00, NULL, 'Pending', 'Pending', '2025-01-28 17:21:59', '2025-01-28 17:21:59', NULL),
(90, 4, NULL, NULL, NULL, 'Delivery', NULL, '17', 'APP', 1498.00, 160.50, 12, 'Including', 80.25, 80.25, 0.00, 0.00, NULL, 'Pending', 'Pending', '2025-01-28 17:22:26', '2025-01-28 17:22:26', NULL),
(91, 4, NULL, NULL, NULL, 'Delivery', NULL, '17', 'APP', 2397.00, 256.82, 12, 'Including', 128.41, 128.41, 0.00, 0.00, NULL, 'Pending', 'Pending', '2025-02-05 18:58:42', '2025-02-05 18:58:42', NULL),
(92, 14, NULL, NULL, NULL, 'Dine In', NULL, NULL, 'APP', 2397.00, 256.82, 12, 'Including', 128.41, 128.41, 0.00, 0.00, NULL, 'Processing', 'SUCCESS', '2025-02-12 13:07:55', '2025-02-12 13:11:12', NULL),
(93, 4, NULL, NULL, NULL, 'Dine In', NULL, NULL, 'APP', 499.00, 53.46, 12, 'Including', 26.73, 26.73, 0.00, 0.00, NULL, 'Pending', 'Pending', '2025-02-14 11:50:09', '2025-02-14 11:50:09', NULL),
(94, 4, NULL, NULL, NULL, 'Dine In', NULL, NULL, 'APP', 1997.00, 213.96, 12, 'Including', 106.98, 106.98, 0.00, 0.00, NULL, 'Pending', 'Pending', '2025-02-14 18:03:52', '2025-02-14 18:03:52', NULL),
(95, 4, NULL, NULL, NULL, 'Dine In', NULL, NULL, 'APP', 1398.00, 149.79, 12, 'Including', 74.89, 74.89, 0.00, 0.00, NULL, 'Pending', 'Pending', '2025-03-02 13:28:12', '2025-03-02 13:28:12', NULL),
(96, 4, NULL, NULL, NULL, 'Dine In', NULL, NULL, 'APP', 1398.00, 149.79, 12, 'Including', 74.89, 74.89, 0.00, 0.00, NULL, 'Processing', 'SUCCESS', '2025-03-02 13:40:05', '2025-03-02 13:40:51', NULL),
(98, NULL, 5, NULL, NULL, 'KOT', 'cash', 'beldanga rishra west bengal', 'WEB', 2182.15, 22.97, 1, 'Excluding', 11.48, 11.48, 114.85, 114.85, 'FIRST5', 'Pending', 'Pending', '2025-03-18 12:45:18', '2025-03-18 12:45:18', NULL),
(99, NULL, 5, NULL, NULL, 'KOT', 'cash', 'beldanga rishra west bengal', 'WEB', 1328.10, 13.98, 1, 'Excluding', 6.99, 6.99, 69.90, 69.90, 'FIRST5', 'Pending', 'Pending', '2025-03-18 12:50:26', '2025-03-18 12:50:26', NULL),
(100, NULL, 5, NULL, NULL, 'KOT', 'upi', 'beldanga rishra west bengal', 'WEB', 1328.10, 13.98, 1, 'Excluding', 6.99, 6.99, 69.90, 69.90, 'FIRST5', 'Pending', 'Pending', '2025-03-18 12:54:11', '2025-03-18 12:54:11', NULL),
(101, NULL, 5, NULL, NULL, 'KOT', 'cash', 'beldanga rishra west bengal', 'WEB', 1328.10, 13.98, 1, 'Excluding', 6.99, 6.99, 69.90, 69.90, 'FIRST5', 'Pending', 'Pending', '2025-03-18 13:07:06', '2025-03-18 13:07:06', NULL),
(102, NULL, 5, NULL, NULL, 'KOT', 'cash', 'beldanga rishra west bengal', 'WEB', 1328.10, 13.98, 1, 'Excluding', 6.99, 6.99, 69.90, 69.90, 'FIRST5', 'Pending', 'Pending', '2025-03-18 13:08:05', '2025-03-18 13:08:05', NULL),
(103, NULL, 5, NULL, NULL, 'KOT', 'cash', 'beldanga rishra west bengal', 'WEB', 854.05, 8.99, 1, 'Excluding', 4.50, 4.50, 44.95, 44.95, 'FIRST5', 'Pending', 'Pending', '2025-03-18 13:08:39', '2025-03-18 13:08:39', NULL),
(104, NULL, 5, NULL, NULL, 'KOT', 'upi', 'beldanga rishra west bengal', 'WEB', 1328.10, 13.98, 1, 'Excluding', 6.99, 6.99, 69.90, 69.90, 'FIRST5', 'Pending', 'Pending', '2025-03-18 13:49:07', '2025-03-18 13:49:07', NULL),
(105, NULL, 5, NULL, NULL, 'KOT', 'cash', 'beldanga rishra west bengal', 'WEB', 1992.15, 20.97, 1, 'Excluding', 10.48, 10.48, 104.85, 104.85, 'FIRST5', 'Pending', 'SUCCESS', '2025-03-18 15:38:44', '2025-03-20 12:57:07', '2025-03-20 12:57:07'),
(107, NULL, 5, 'cash', 1, 'Dine-in', 'KOT', 'beldanga rishra west bengal', 'WEB', 1328.10, 13.98, 1, 'Excluding', 6.99, 6.99, 69.90, 69.90, 'FIRST5', 'Pending', 'Pending', '2025-03-20 15:04:49', '2025-03-20 15:04:49', NULL);

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
(1, 1, 1, 1, 1, 2, 899.00, 1798.00, '2024-11-08 17:52:21', '2024-11-08 17:52:21', NULL),
(2, 1, 1, 1, 2, 1, 499.00, 499.00, '2024-11-08 17:52:21', '2024-11-08 17:52:21', NULL),
(3, 2, 1, 1, 1, 2, 899.00, 1798.00, '2024-11-08 18:27:44', '2024-11-08 18:27:44', NULL),
(4, 2, 1, 1, 2, 1, 499.00, 499.00, '2024-11-08 18:27:44', '2024-11-08 18:27:44', NULL),
(5, 3, 1, 1, 1, 1, 899.00, 899.00, '2024-11-10 12:10:06', '2024-11-10 12:10:06', NULL),
(6, 4, 1, 1, 3, 2, 599.00, 1198.00, '2024-11-10 18:00:57', '2024-11-10 18:00:57', NULL),
(7, 5, 1, 1, 3, 2, 599.00, 1198.00, '2024-11-10 18:02:04', '2024-11-10 18:02:04', NULL),
(8, 6, 1, 1, 1, 2, 899.00, 1798.00, '2024-11-11 15:52:35', '2024-11-11 15:52:35', NULL),
(9, 6, 1, 1, 2, 1, 499.00, 499.00, '2024-11-11 15:52:35', '2024-11-11 15:52:35', NULL),
(10, 7, 1, 1, 1, 1, 899.00, 899.00, '2024-11-11 16:31:13', '2024-11-11 16:31:13', NULL),
(11, 7, 1, 1, 2, 1, 499.00, 499.00, '2024-11-11 16:31:13', '2024-11-11 16:31:13', NULL),
(12, 8, 1, 1, 1, 1, 899.00, 899.00, '2024-11-11 16:40:12', '2024-11-11 16:40:12', NULL),
(13, 8, 1, 1, 2, 1, 499.00, 499.00, '2024-11-11 16:40:12', '2024-11-11 16:40:12', NULL),
(14, 9, 1, 1, 1, 1, 899.00, 899.00, '2024-11-11 17:34:08', '2024-11-11 17:34:08', NULL),
(15, 9, 1, 1, 2, 1, 499.00, 499.00, '2024-11-11 17:34:08', '2024-11-11 17:34:08', NULL),
(16, 10, 1, 1, 1, 1, 899.00, 899.00, '2024-11-11 17:44:07', '2024-11-11 17:44:07', NULL),
(17, 10, 1, 1, 2, 1, 499.00, 499.00, '2024-11-11 17:44:07', '2024-11-11 17:44:07', NULL),
(18, 11, 1, 1, 1, 1, 899.00, 899.00, '2024-11-11 18:12:36', '2024-11-11 18:12:36', NULL),
(19, 11, 1, 1, 2, 1, 499.00, 499.00, '2024-11-11 18:12:36', '2024-11-11 18:12:36', NULL),
(20, 12, 1, 1, 2, 1, 499.00, 499.00, '2024-11-11 18:20:35', '2024-11-11 18:20:35', NULL),
(21, 13, 1, 1, 3, 2, 599.00, 1198.00, '2024-11-11 18:23:39', '2024-11-11 18:23:39', NULL),
(22, 14, 1, 1, 3, 2, 599.00, 1198.00, '2024-11-11 18:55:52', '2024-11-11 18:55:52', NULL),
(23, 15, 1, 1, 1, 2, 899.00, 1798.00, '2024-11-12 16:17:21', '2024-11-12 16:17:21', NULL),
(24, 15, 1, 1, 2, 1, 499.00, 499.00, '2024-11-12 16:17:21', '2024-11-12 16:17:21', NULL),
(25, 16, 1, 1, 1, 2, 899.00, 1798.00, '2024-11-12 16:18:54', '2024-11-12 16:18:54', NULL),
(26, 16, 1, 1, 2, 1, 499.00, 499.00, '2024-11-12 16:18:54', '2024-11-12 16:18:54', NULL),
(27, 17, 1, 1, 1, 1, 899.00, 899.00, '2024-11-12 16:20:09', '2024-11-12 16:20:09', NULL),
(28, 17, 1, 1, 2, 2, 499.00, 998.00, '2024-11-12 16:20:09', '2024-11-12 16:20:09', NULL),
(29, 17, 1, 1, 3, 1, 599.00, 599.00, '2024-11-12 16:20:09', '2024-11-12 16:20:09', NULL),
(30, 18, 1, 1, 1, 1, 899.00, 899.00, '2024-11-12 16:22:18', '2024-11-12 16:22:18', NULL),
(31, 18, 1, 1, 2, 2, 499.00, 998.00, '2024-11-12 16:22:18', '2024-11-12 16:22:18', NULL),
(32, 18, 1, 1, 3, 1, 599.00, 599.00, '2024-11-12 16:22:18', '2024-11-12 16:22:18', NULL),
(33, 19, 1, 1, 1, 2, 899.00, 1798.00, '2024-11-12 16:25:53', '2024-11-12 16:25:53', NULL),
(34, 19, 1, 1, 2, 1, 499.00, 499.00, '2024-11-12 16:25:53', '2024-11-12 16:25:53', NULL),
(35, 20, 1, 1, 1, 1, 899.00, 899.00, '2024-11-12 19:27:06', '2024-11-12 19:27:06', NULL),
(36, 21, 1, 1, 1, 1, 899.00, 899.00, '2024-11-12 19:29:13', '2024-11-12 19:29:13', NULL),
(37, 21, 1, 1, 2, 1, 499.00, 499.00, '2024-11-12 19:29:13', '2024-11-12 19:29:13', NULL),
(38, 22, 1, 1, 1, 1, 899.00, 899.00, '2024-11-13 11:40:08', '2024-11-13 11:40:08', NULL),
(39, 23, 1, 1, 1, 1, 899.00, 899.00, '2024-11-13 11:49:00', '2024-11-13 11:49:00', NULL),
(40, 24, 1, 1, 1, 2, 899.00, 1798.00, '2024-11-13 16:17:31', '2024-11-13 16:17:31', NULL),
(41, 24, 1, 1, 2, 1, 499.00, 499.00, '2024-11-13 16:17:31', '2024-11-13 16:17:31', NULL),
(42, 25, 1, 1, 1, 2, 899.00, 1798.00, '2024-11-13 18:27:44', '2024-11-13 18:27:44', NULL),
(43, 25, 1, 1, 2, 1, 499.00, 499.00, '2024-11-13 18:27:44', '2024-11-13 18:27:44', NULL),
(44, 26, 1, 1, 1, 1, 899.00, 899.00, '2024-11-14 15:33:07', '2024-11-14 15:33:07', NULL),
(45, 26, 1, 1, 2, 1, 499.00, 499.00, '2024-11-14 15:33:07', '2024-11-14 15:33:07', NULL),
(46, 27, 1, 1, 1, 1, 899.00, 899.00, '2024-11-14 15:33:31', '2024-11-14 15:33:31', NULL),
(47, 27, 1, 1, 2, 1, 499.00, 499.00, '2024-11-14 15:33:31', '2024-11-14 15:33:31', NULL),
(48, 28, 1, 1, 1, 1, 899.00, 899.00, '2024-11-14 15:35:40', '2024-11-14 15:35:40', NULL),
(49, 28, 1, 1, 2, 1, 499.00, 499.00, '2024-11-14 15:35:40', '2024-11-14 15:35:40', NULL),
(50, 29, 1, 1, 1, 1, 899.00, 899.00, '2024-11-14 21:02:59', '2024-11-14 21:02:59', NULL),
(51, 30, 1, 1, 1, 1, 899.00, 899.00, '2024-11-14 21:05:06', '2024-11-14 21:05:06', NULL),
(52, 31, 1, 1, 1, 1, 899.00, 899.00, '2024-11-15 16:13:36', '2024-11-15 16:13:36', NULL),
(53, 32, 1, 1, 1, 1, 899.00, 899.00, '2024-11-15 16:13:37', '2024-11-15 16:13:37', NULL),
(54, 33, 1, 1, 1, 1, 899.00, 899.00, '2024-11-15 16:13:46', '2024-11-15 16:13:46', NULL),
(55, 34, 4, 1, 1, 3, 899.00, 2697.00, '2024-11-15 16:14:27', '2024-11-15 16:14:27', NULL),
(56, 35, 4, 1, 1, 3, 899.00, 2697.00, '2024-11-15 16:26:32', '2024-11-15 16:26:32', NULL),
(57, 36, 4, 1, 2, 3, 499.00, 1497.00, '2024-11-15 16:27:35', '2024-11-15 16:27:35', NULL),
(58, 36, 4, 1, 1, 3, 899.00, 2697.00, '2024-11-15 16:27:35', '2024-11-15 16:27:35', NULL),
(59, 37, 4, 1, 2, 3, 499.00, 1497.00, '2024-11-15 16:27:44', '2024-11-15 16:27:44', NULL),
(60, 37, 4, 1, 1, 3, 899.00, 2697.00, '2024-11-15 16:27:44', '2024-11-15 16:27:44', NULL),
(61, 38, 4, 1, 2, 3, 499.00, 1497.00, '2024-11-15 16:33:00', '2024-11-15 16:33:00', NULL),
(62, 38, 4, 1, 1, 3, 899.00, 2697.00, '2024-11-15 16:33:00', '2024-11-15 16:33:00', NULL),
(63, 39, 4, 1, 1, 2, 899.00, 1798.00, '2024-11-15 16:35:46', '2024-11-15 16:35:46', NULL),
(64, 40, 4, 1, 1, 2, 899.00, 1798.00, '2024-11-15 16:35:55', '2024-11-15 16:35:55', NULL),
(65, 41, 4, 1, 2, 4, 499.00, 1996.00, '2024-11-15 17:00:35', '2024-11-15 17:00:35', NULL),
(66, 41, 4, 1, 1, 4, 899.00, 3596.00, '2024-11-15 17:00:35', '2024-11-15 17:00:35', NULL),
(67, 42, 11, 1, 1, 1, 899.00, 899.00, '2024-11-15 17:13:12', '2024-11-15 17:13:12', NULL),
(68, 42, 11, 1, 2, 1, 499.00, 499.00, '2024-11-15 17:13:12', '2024-11-15 17:13:12', NULL),
(69, 43, 4, 1, 2, 4, 499.00, 1996.00, '2024-11-15 17:16:24', '2024-11-15 17:16:24', NULL),
(70, 43, 4, 1, 1, 4, 899.00, 3596.00, '2024-11-15 17:16:24', '2024-11-15 17:16:24', NULL),
(71, 44, 4, 1, 2, 4, 499.00, 1996.00, '2024-11-15 17:18:45', '2024-11-15 17:18:45', NULL),
(72, 44, 4, 1, 1, 4, 899.00, 3596.00, '2024-11-15 17:18:45', '2024-11-15 17:18:45', NULL),
(73, 45, 4, 1, 2, 4, 499.00, 1996.00, '2024-11-15 17:20:06', '2024-11-15 17:20:06', NULL),
(74, 45, 4, 1, 1, 4, 899.00, 3596.00, '2024-11-15 17:20:06', '2024-11-15 17:20:06', NULL),
(75, 46, 4, 1, 2, 4, 499.00, 1996.00, '2024-11-15 17:20:20', '2024-11-15 17:20:20', NULL),
(76, 46, 4, 1, 1, 4, 899.00, 3596.00, '2024-11-15 17:20:20', '2024-11-15 17:20:20', NULL),
(77, 47, 4, 1, 2, 4, 499.00, 1996.00, '2024-11-15 17:22:05', '2024-11-15 17:22:05', NULL),
(78, 47, 4, 1, 1, 4, 899.00, 3596.00, '2024-11-15 17:22:05', '2024-11-15 17:22:05', NULL),
(79, 48, 4, 1, 2, 4, 499.00, 1996.00, '2024-11-15 17:23:08', '2024-11-15 17:23:08', NULL),
(80, 48, 4, 1, 1, 4, 899.00, 3596.00, '2024-11-15 17:23:08', '2024-11-15 17:23:08', NULL),
(81, 49, 4, 1, 2, 4, 499.00, 1996.00, '2024-11-15 17:23:55', '2024-11-15 17:23:55', NULL),
(82, 49, 4, 1, 1, 4, 899.00, 3596.00, '2024-11-15 17:23:55', '2024-11-15 17:23:55', NULL),
(83, 50, 4, 1, 2, 4, 499.00, 1996.00, '2024-11-15 17:24:56', '2024-11-15 17:24:56', NULL),
(84, 50, 4, 1, 1, 4, 899.00, 3596.00, '2024-11-15 17:24:56', '2024-11-15 17:24:56', NULL),
(85, 51, 4, 1, 2, 4, 499.00, 1996.00, '2024-11-15 17:28:10', '2024-11-15 17:28:10', NULL),
(86, 51, 4, 1, 1, 4, 899.00, 3596.00, '2024-11-15 17:28:10', '2024-11-15 17:28:10', NULL),
(87, 52, 4, 1, 2, 4, 499.00, 1996.00, '2024-11-15 17:29:49', '2024-11-15 17:29:49', NULL),
(88, 52, 4, 1, 1, 4, 899.00, 3596.00, '2024-11-15 17:29:49', '2024-11-15 17:29:49', NULL),
(89, 53, 4, 1, 2, 4, 499.00, 1996.00, '2024-11-15 17:32:02', '2024-11-15 17:32:02', NULL),
(90, 53, 4, 1, 1, 4, 899.00, 3596.00, '2024-11-15 17:32:02', '2024-11-15 17:32:02', NULL),
(91, 54, 4, 1, 2, 4, 499.00, 1996.00, '2024-11-15 17:32:49', '2024-11-15 17:32:49', NULL),
(92, 54, 4, 1, 1, 4, 899.00, 3596.00, '2024-11-15 17:32:49', '2024-11-15 17:32:49', NULL),
(93, 55, 4, 1, 2, 4, 499.00, 1996.00, '2024-11-15 17:33:24', '2024-11-15 17:33:24', NULL),
(94, 55, 4, 1, 1, 4, 899.00, 3596.00, '2024-11-15 17:33:24', '2024-11-15 17:33:24', NULL),
(95, 56, 4, 1, 2, 4, 499.00, 1996.00, '2024-11-15 17:36:43', '2024-11-15 17:36:43', NULL),
(96, 56, 4, 1, 1, 4, 899.00, 3596.00, '2024-11-15 17:36:43', '2024-11-15 17:36:43', NULL),
(97, 57, 4, 1, 2, 4, 499.00, 1996.00, '2024-11-15 17:41:26', '2024-11-15 17:41:26', NULL),
(98, 57, 4, 1, 1, 4, 899.00, 3596.00, '2024-11-15 17:41:26', '2024-11-15 17:41:26', NULL),
(99, 58, 4, 1, 2, 4, 499.00, 1996.00, '2024-11-15 17:45:51', '2024-11-15 17:45:51', NULL),
(100, 58, 4, 1, 1, 4, 899.00, 3596.00, '2024-11-15 17:45:51', '2024-11-15 17:45:51', NULL),
(101, 59, 4, 1, 2, 4, 499.00, 1996.00, '2024-11-15 17:51:22', '2024-11-15 17:51:22', NULL),
(102, 59, 4, 1, 1, 4, 899.00, 3596.00, '2024-11-15 17:51:22', '2024-11-15 17:51:22', NULL),
(103, 60, 4, 1, 2, 4, 499.00, 1996.00, '2024-11-15 17:52:53', '2024-11-15 17:52:53', NULL),
(104, 60, 4, 1, 1, 4, 899.00, 3596.00, '2024-11-15 17:52:53', '2024-11-15 17:52:53', NULL),
(105, 61, 4, 1, 2, 4, 499.00, 1996.00, '2024-11-15 17:55:03', '2024-11-15 17:55:03', NULL),
(106, 61, 4, 1, 1, 4, 899.00, 3596.00, '2024-11-15 17:55:03', '2024-11-15 17:55:03', NULL),
(107, 62, 4, 1, 2, 4, 499.00, 1996.00, '2024-11-15 17:59:34', '2024-11-15 17:59:34', NULL),
(108, 62, 4, 1, 1, 3, 899.00, 2697.00, '2024-11-15 17:59:34', '2024-11-15 17:59:34', NULL),
(109, 63, 4, 1, 2, 4, 499.00, 1996.00, '2024-11-15 18:02:15', '2024-11-15 18:02:15', NULL),
(110, 63, 4, 1, 1, 3, 899.00, 2697.00, '2024-11-15 18:02:15', '2024-11-15 18:02:15', NULL),
(111, 64, 4, 1, 2, 4, 499.00, 1996.00, '2024-11-15 19:03:52', '2024-11-15 19:03:52', NULL),
(112, 64, 4, 1, 1, 3, 899.00, 2697.00, '2024-11-15 19:03:52', '2024-11-15 19:03:52', NULL),
(113, 65, 1, 1, 1, 1, 899.00, 899.00, '2024-11-18 11:50:43', '2024-11-18 11:50:43', NULL),
(114, 66, 1, 1, 1, 1, 899.00, 899.00, '2024-11-18 11:51:39', '2024-11-18 11:51:39', NULL),
(115, 67, 1, 1, 1, 1, 899.00, 899.00, '2024-11-18 11:53:17', '2024-11-18 11:53:17', NULL),
(116, 68, 1, 1, 1, 1, 899.00, 899.00, '2024-11-18 12:59:29', '2024-11-18 12:59:29', NULL),
(117, 69, 1, 1, 1, 1, 899.00, 899.00, '2024-11-18 13:05:57', '2024-11-18 13:05:57', NULL),
(118, 70, 1, 1, 1, 1, 899.00, 899.00, '2024-11-18 13:08:06', '2024-11-18 13:08:06', NULL),
(119, 71, 1, 1, 1, 1, 899.00, 899.00, '2024-11-18 13:08:25', '2024-11-18 13:08:25', NULL),
(120, 72, 1, 1, 1, 1, 899.00, 899.00, '2024-11-18 13:08:33', '2024-11-18 13:08:33', NULL),
(121, 73, 4, 1, 2, 5, 499.00, 2495.00, '2024-11-18 16:40:21', '2024-11-18 16:40:21', NULL),
(122, 73, 4, 1, 1, 4, 899.00, 3596.00, '2024-11-18 16:40:21', '2024-11-18 16:40:21', NULL),
(123, 73, 4, 1, 3, 4, 599.00, 2396.00, '2024-11-18 16:40:21', '2024-11-18 16:40:21', NULL),
(124, 74, 4, 1, 2, 5, 499.00, 2495.00, '2024-11-18 16:41:42', '2024-11-18 16:41:42', NULL),
(125, 74, 4, 1, 1, 4, 899.00, 3596.00, '2024-11-18 16:41:42', '2024-11-18 16:41:42', NULL),
(126, 74, 4, 1, 3, 4, 599.00, 2396.00, '2024-11-18 16:41:42', '2024-11-18 16:41:42', NULL),
(127, 75, 4, 1, 2, 5, 499.00, 2495.00, '2024-11-18 16:51:43', '2024-11-18 16:51:43', NULL),
(128, 75, 4, 1, 1, 4, 899.00, 3596.00, '2024-11-18 16:51:43', '2024-11-18 16:51:43', NULL),
(129, 75, 4, 1, 3, 4, 599.00, 2396.00, '2024-11-18 16:51:43', '2024-11-18 16:51:43', NULL),
(130, 76, 4, 1, 2, 5, 499.00, 2495.00, '2024-11-18 16:51:47', '2024-11-18 16:51:47', NULL),
(131, 76, 4, 1, 1, 4, 899.00, 3596.00, '2024-11-18 16:51:47', '2024-11-18 16:51:47', NULL),
(132, 76, 4, 1, 3, 4, 599.00, 2396.00, '2024-11-18 16:51:47', '2024-11-18 16:51:47', NULL),
(133, 77, 4, 1, 2, 5, 499.00, 2495.00, '2024-11-18 19:03:15', '2024-11-18 19:03:15', NULL),
(134, 77, 4, 1, 1, 4, 899.00, 3596.00, '2024-11-18 19:03:15', '2024-11-18 19:03:15', NULL),
(135, 77, 4, 1, 3, 4, 599.00, 2396.00, '2024-11-18 19:03:15', '2024-11-18 19:03:15', NULL),
(136, 78, 4, 1, 1, 3, 899.00, 2697.00, '2024-11-25 15:15:31', '2024-11-25 15:15:31', NULL),
(137, 79, 4, 1, 1, 1, 899.00, 899.00, '2024-11-25 17:07:20', '2024-11-25 17:07:20', NULL),
(138, 80, 4, 1, 1, 1, 899.00, 899.00, '2024-11-25 17:07:33', '2024-11-25 17:07:33', NULL),
(139, 81, 4, 1, 1, 1, 899.00, 899.00, '2024-11-25 17:07:49', '2024-11-25 17:07:49', NULL),
(140, 82, 4, 1, 1, 3, 899.00, 2697.00, '2024-11-25 17:49:39', '2024-11-25 17:49:39', NULL),
(141, 83, 4, 1, 1, 3, 899.00, 2697.00, '2024-11-25 17:55:16', '2024-11-25 17:55:16', NULL),
(142, 84, 4, 1, 1, 3, 899.00, 2697.00, '2024-11-25 17:55:32', '2024-11-25 17:55:32', NULL),
(143, 85, 4, 1, 1, 10, 899.00, 8990.00, '2024-11-25 18:01:00', '2024-11-25 18:01:00', NULL),
(144, 86, 4, 1, 1, 10, 899.00, 8990.00, '2024-11-25 18:06:45', '2024-11-25 18:06:45', NULL),
(145, 87, 4, 1, 1, 10, 899.00, 8990.00, '2024-11-25 18:08:20', '2024-11-25 18:08:20', NULL),
(146, 88, 4, 1, 1, 10, 899.00, 8990.00, '2024-11-25 18:12:46', '2024-11-25 18:12:46', NULL),
(147, 89, 4, 1, 1, 1, 899.00, 899.00, '2025-01-28 17:21:59', '2025-01-28 17:21:59', NULL),
(148, 89, 4, 1, 2, 1, 499.00, 499.00, '2025-01-28 17:21:59', '2025-01-28 17:21:59', NULL),
(149, 90, 4, 1, 1, 1, 899.00, 899.00, '2025-01-28 17:22:26', '2025-01-28 17:22:26', NULL),
(150, 90, 4, 1, 3, 1, 599.00, 599.00, '2025-01-28 17:22:26', '2025-01-28 17:22:26', NULL),
(151, 91, 4, 1, 1, 2, 899.00, 1798.00, '2025-02-05 18:58:42', '2025-02-05 18:58:42', NULL),
(152, 91, 4, 1, 3, 1, 599.00, 599.00, '2025-02-05 18:58:42', '2025-02-05 18:58:42', NULL),
(153, 92, 14, 1, 3, 1, 599.00, 599.00, '2025-02-12 13:07:55', '2025-02-12 13:07:55', NULL),
(154, 92, 14, 1, 2, 0, 499.00, 0.00, '2025-02-12 13:07:55', '2025-02-12 13:07:55', NULL),
(155, 92, 14, 1, 1, 2, 899.00, 1798.00, '2025-02-12 13:07:55', '2025-02-12 13:07:55', NULL),
(156, 93, 4, 1, 2, 1, 499.00, 499.00, '2025-02-14 11:50:09', '2025-02-14 11:50:09', NULL),
(157, 94, 4, 1, 3, 1, 599.00, 599.00, '2025-02-14 18:03:52', '2025-02-14 18:03:52', NULL),
(158, 94, 4, 1, 2, 1, 499.00, 499.00, '2025-02-14 18:03:52', '2025-02-14 18:03:52', NULL),
(159, 94, 4, 1, 1, 1, 899.00, 899.00, '2025-02-14 18:03:52', '2025-02-14 18:03:52', NULL),
(160, 95, 4, 1, 2, 1, 499.00, 499.00, '2025-03-02 13:28:12', '2025-03-02 13:28:12', NULL),
(161, 95, 4, 1, 1, 1, 899.00, 899.00, '2025-03-02 13:28:12', '2025-03-02 13:28:12', NULL),
(162, 96, 4, 1, 2, 1, 499.00, 499.00, '2025-03-02 13:40:05', '2025-03-02 13:40:05', NULL),
(163, 96, 4, 1, 1, 1, 899.00, 899.00, '2025-03-02 13:40:05', '2025-03-02 13:40:05', NULL),
(164, 98, NULL, 5, 1, 2, 899.00, 1798.00, '2025-03-18 12:45:18', '2025-03-18 12:45:18', NULL),
(165, 98, NULL, 5, 2, 1, 499.00, 499.00, '2025-03-18 12:45:18', '2025-03-18 12:45:18', NULL),
(166, 99, NULL, 5, 1, 1, 899.00, 899.00, '2025-03-18 12:50:26', '2025-03-18 12:50:26', NULL),
(167, 99, NULL, 5, 2, 1, 499.00, 499.00, '2025-03-18 12:50:26', '2025-03-18 12:50:26', NULL),
(168, 100, NULL, 5, 1, 1, 899.00, 899.00, '2025-03-18 12:54:11', '2025-03-18 12:54:11', NULL),
(169, 100, NULL, 5, 2, 1, 499.00, 499.00, '2025-03-18 12:54:11', '2025-03-18 12:54:11', NULL),
(170, 101, NULL, 5, 1, 1, 899.00, 899.00, '2025-03-18 13:07:06', '2025-03-18 13:07:06', NULL),
(171, 101, NULL, 5, 2, 1, 499.00, 499.00, '2025-03-18 13:07:06', '2025-03-18 13:07:06', NULL),
(172, 102, NULL, 5, 1, 1, 899.00, 899.00, '2025-03-18 13:08:05', '2025-03-18 13:08:05', NULL),
(173, 102, NULL, 5, 2, 1, 499.00, 499.00, '2025-03-18 13:08:05', '2025-03-18 13:08:05', NULL),
(174, 103, NULL, 5, 1, 1, 899.00, 899.00, '2025-03-18 13:08:39', '2025-03-18 13:08:39', NULL),
(175, 104, NULL, 5, 1, 1, 899.00, 899.00, '2025-03-18 13:49:07', '2025-03-18 13:49:07', NULL),
(176, 104, NULL, 5, 2, 1, 499.00, 499.00, '2025-03-18 13:49:07', '2025-03-18 13:49:07', NULL),
(177, 105, NULL, 5, 1, 1, 899.00, 899.00, '2025-03-18 15:38:44', '2025-03-18 15:38:44', NULL),
(178, 105, NULL, 5, 3, 2, 599.00, 1198.00, '2025-03-18 15:38:44', '2025-03-18 15:38:44', NULL),
(179, 106, NULL, 5, 1, 1, 899.00, 899.00, '2025-03-20 15:02:59', '2025-03-20 15:02:59', NULL),
(180, 106, NULL, 5, 2, 1, 499.00, 499.00, '2025-03-20 15:02:59', '2025-03-20 15:02:59', NULL),
(181, 107, NULL, 5, 1, 1, 899.00, 899.00, '2025-03-20 15:04:49', '2025-03-20 15:04:49', NULL),
(182, 107, NULL, 5, 2, 1, 499.00, 499.00, '2025-03-20 15:04:49', '2025-03-20 15:04:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_types`
--

CREATE TABLE `order_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_types`
--

INSERT INTO `order_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Dine-in', '2025-03-20 08:14:23', '2025-03-20 08:14:23'),
(2, 'Takeaway', '2025-03-20 08:14:23', '2025-03-20 08:14:23'),
(3, 'Delivery', '2025-03-20 08:14:23', '2025-03-20 08:14:23');

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
(8280, 4, '96', 'order_Q1qowB6ebcSK4N', 'pay_Q1qpNTms2RBBhX', 'RAZORPAY', 1398.00, '{\"id\":\"pay_Q1qpNTms2RBBhX\",\"entity\":\"payment\",\"amount\":139800,\"currency\":\"INR\",\"status\":\"captured\",\"order_id\":\"order_Q1qowB6ebcSK4N\",\"invoice_id\":null,\"international\":false,\"method\":\"wallet\",\"amount_refunded\":0,\"refund_status\":null,\"captured\":true,\"description\":null,\"card_id\":null,\"bank\":null,\"wallet\":\"freecharge\",\"vpa\":null,\"email\":\"josef@gmail.com\",\"contact\":\"+919836563656\",\"notes\":{\"notes_key_1\":8280,\"notes_key_2\":\"\"},\"fee\":3300,\"tax\":504,\"error_code\":null,\"error_description\":null,\"error_source\":null,\"error_step\":null,\"error_reason\":null,\"acquirer_data\":{\"transaction_id\":null},\"created_at\":1740903033}', 'SUCCESS', '2025-03-02 13:40:07', '2025-03-02 13:40:51', NULL);

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `main_id`, `name`, `slug`, `menutype`, `created_at`, `updated_at`) VALUES
(1, 1, 'Customer list', 'users', 'M', NULL, NULL),
(2, 1, 'Add Customer', 'add-user', 'B', NULL, NULL),
(3, 1, 'Edit Customer', 'edit-user', 'B', NULL, NULL),
(4, 1, 'Delete Customer', 'delete-user', 'B', NULL, NULL),
(5, 3, 'Roles', 'roles', 'M', NULL, NULL),
(6, 3, 'Add Role', 'add-role', 'B', NULL, NULL),
(7, 3, 'Edit Role', 'edit-role', 'B', NULL, NULL),
(8, 3, 'Delete Role', 'delete-role', 'B', NULL, NULL),
(9, 3, 'Permissionlist', 'permissionlist', 'B', NULL, NULL),
(10, 3, 'Sub Admin', 'admins', 'M', NULL, NULL),
(11, 3, 'Add Sub Admin', 'add-admin', 'B', NULL, NULL),
(12, 3, 'Edit Sub Admin', 'edit-admin', 'B', NULL, NULL),
(13, 3, 'Delete Sub Admin', 'delete-admin', 'B', NULL, NULL),
(102, 3, 'Update Permission', 'update-permission', 'B', NULL, NULL),
(131, 16, 'Page list', 'pages', 'M', NULL, NULL),
(132, 16, 'Edit Page', 'edit-page', 'B', NULL, NULL),
(135, 23, 'User Wallet', 'transactions', 'M', NULL, NULL),
(139, 26, 'Kyc', 'driver-kyc', 'B', NULL, NULL),
(148, 20, 'Customer Settlement', 'customersettlements', 'M', NULL, NULL),
(149, 20, 'Add Customer Settlement', 'add-customersettlement', 'B', NULL, NULL),
(156, 5, 'Website Config', 'websiteconfigs', 'M', NULL, NULL),
(157, 5, 'Update Website Config', 'edit-websiteconfig', 'B', NULL, NULL),
(162, 21, 'Notification list', 'notifications', 'M', NULL, NULL),
(163, 21, 'Add Notification', 'add-notification', 'B', NULL, NULL),
(164, 21, 'Delete Notification', 'delete-notification', 'B', NULL, NULL),
(195, 2, 'Delete Restaurant', 'delete-restaurant', 'B', NULL, NULL),
(194, 2, 'Edit Restaurant', 'edit-restaurant', 'B', NULL, NULL),
(167, 17, 'Admin Charges', 'admincharges', 'M', NULL, NULL),
(168, 17, 'Tds Charges', 'tdscharges', 'M', NULL, NULL),
(193, 2, 'Add Restaurant', 'add-restaurant', 'B', NULL, NULL),
(192, 2, 'Restaurant list', 'restaurants', 'M', NULL, NULL);

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
(115, 'App\\Models\\User', 1, 'mobile', '91f8d8a1737d230f2d54e9f7a6b97ec1d78e6bacda5bcacd285c3f6eb9ca2ef4', '[\"role:customer\"]', '2025-02-10 17:45:29', '2024-11-08 15:35:40', '2025-02-10 17:45:29'),
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
(187, 'App\\Models\\User', 4, 'mobile', 'daa09a3635145bb76897b61f74b6bf4a6ce5c70d479148a6d1c41da0d82ced3e', '[\"role:customer\"]', '2025-03-12 11:30:22', '2025-02-12 16:57:39', '2025-03-12 11:30:22'),
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
(202, 'App\\Models\\User', 6, 'mobile', '148c744f2dfea97ae1a5d1947aff7232729a849b3283ca21ffefae59fb87819e', '[\"role:customer\"]', '2025-03-05 14:52:48', '2025-03-05 14:51:13', '2025-03-05 14:52:48');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(155) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_recommend` varchar(15) DEFAULT 'NO',
  `status` enum('A','D') DEFAULT 'A',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category_id`, `price`, `image`, `description`, `is_recommend`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Margherita Pizza', 4, 899, 'public/uploads/product/pizza-palace.jpg', 'Delicious Margherita Pizza with fresh ingredients.', 'NO', 'A', '2024-10-25 15:47:04', '2024-10-25 15:47:04', NULL),
(2, 'Bruschetta Pizza', 4, 499, 'public/uploads/product/pizza-hut.jpg', 'Delicious Bruschetta Pizza with fresh ingredients.', 'YES', 'A', '2024-10-25 15:47:04', '2024-10-25 15:47:04', NULL),
(3, 'Tiramisu Pizza', 4, 599, 'public/uploads/product/mojo.png', 'Delicious Tiramisu Pizza with fresh ingredients.', 'YES', 'A', '2024-10-25 15:47:04', '2024-10-25 15:47:04', NULL),
(4, 'Pasta Carbonara Pizza', 4, 999, 'public/uploads/product/lapino-pizza.png', 'Delicious Tiramisu Pizza with fresh ingredients.', 'NO', 'A', '2024-10-25 15:47:04', '2024-10-25 15:47:04', NULL);

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
(1, 'Pizza Place', '$2y$10$BPtStQSNh.C9AQVrvglT/uw2DCCA258LIE5ssEIQj5b5GB/0Io4ze', 'public/uploads/restaurant/pizza-palace.jpg', 4.1, 'pizzaplace123@gmail.com', NULL, 'OPEN', 12, 'Including', NULL, 'A', '2024-10-25 12:50:07', '2025-03-20 16:46:39', '2025-03-13 09:18:43'),
(2, 'Pizza Hut', NULL, 'public/uploads/restaurant/pizza-hut.jpg', 4.3, NULL, NULL, 'OPEN', 12, 'Including', NULL, 'A', '2024-10-25 12:50:18', '2024-11-08 06:48:33', NULL),
(3, 'MOJO Pizza', NULL, 'public/uploads/restaurant/mojo.png', 4.0, NULL, NULL, 'OPEN', 18, 'Including', NULL, 'A', '2024-10-25 12:50:37', '2024-11-08 06:48:35', NULL),
(4, 'La Pino\'z Pizza', NULL, 'public/uploads/restaurant/lapino-pizza.png', 4.5, NULL, NULL, 'OPEN', 18, 'Excluding', NULL, 'A', '2024-10-25 12:50:49', '2024-11-08 06:50:57', NULL),
(5, 'Dominoz Pizza mania', '$2y$10$BPtStQSNh.C9AQVrvglT/uw2DCCA258LIE5ssEIQj5b5GB/0Io4ze', 'public/uploads/restaurant/812417631741854429.jpg', 3.1, 'dominoz123@gmail.com', 7845212153, 'CLOSE', 1, 'Excluding', 'beldanga rishra west bengal', 'A', '2025-03-13 12:37:09', '2025-03-13 13:57:09', NULL);

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
(1, 1, 1, 'A', '2024-10-25 12:50:07', '2024-10-26 10:08:01', NULL),
(2, 1, 2, 'A', '2024-10-25 12:50:18', '2024-10-26 10:08:03', NULL),
(3, 1, 3, 'A', '2024-10-25 12:50:37', '2024-10-26 10:08:06', NULL),
(4, 1, 4, 'A', '2024-10-25 12:50:49', '2024-10-26 10:08:08', NULL);

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `restaurant_tablenumbers`
--

INSERT INTO `restaurant_tablenumbers` (`id`, `table_number`, `capacity`, `restaurant_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Table1', 4, 5, 'Available', '2025-03-20 08:28:43', '2025-03-20 13:19:40'),
(2, 'Table2', 5, 5, 'Available', '2025-03-20 08:28:43', '2025-03-20 13:19:43'),
(3, 'Table3', 4, 5, 'Available', '2025-03-20 08:28:55', '2025-03-20 13:19:45'),
(4, 'Table4', 3, 5, 'Available', '2025-03-20 08:28:55', '2025-03-20 13:19:48'),
(5, 'Table5', 2, 5, 'Available', '2025-03-20 08:29:12', '2025-03-20 13:19:51'),
(6, 'Table6', 2, NULL, 'Available', '2025-03-20 08:29:12', '2025-03-20 13:19:53');

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', 'Active', '2024-04-01 10:57:43', '2024-04-01 10:57:43'),
(2, 'Sub admin', 'subadmin', 'Active', '2024-04-01 10:57:43', '2024-04-01 10:57:43');

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
(1, 195, '2022-03-05 08:24:35', '2022-03-05 08:24:35');

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
  `remember_token` varchar(500) DEFAULT NULL,
  `status` enum('A','D') DEFAULT 'A',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `mobile`, `balance`, `profileimg`, `device_id`, `email`, `gender`, `dob`, `address`, `password`, `remember_token`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Kishor Mondal', '9876543212', 0.00, 'public/profileimg/1731843737.png', 'bbagibiaasgingasbgbsgbigbnsagbabgs8agawg78wgtqtb tqtg q3gtgq gqt', 'kishoremondal205@gmail.com', 'Male', '2000-10-30', NULL, '$2y$10$Qm4NYOWdHmfn3KxD9kd1bOn2ZwQffOJFb764yHs9sqxDW50CYi.8O', NULL, 'A', '2024-10-14 13:18:31', '2025-02-04 16:02:43', NULL),
(2, 'Ishani', '9856709867', 0.00, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$NrxRS1uta20OfEdvwhIVuOneT/bzQ9wZnHz0wL1B23XuW3g8/PWEu', NULL, 'A', '2024-10-14 15:58:54', '2024-10-14 15:58:54', NULL),
(3, 'Kishor Mondal', '987654321', 0.00, NULL, NULL, 'kishor@gmail.com', NULL, NULL, NULL, '$2y$10$UAi6I.RzJAj28H/P9p11/eD0lW37LkcRTyMkhbGZUcodO0HqFQIsi', NULL, 'A', '2024-11-06 13:04:41', '2024-11-06 13:04:41', NULL),
(4, 'Saifuddin Mondal', '9564779055', 0.00, 'public/profileimg/1732528159.png', NULL, 'saifuddinmondal@gmail.com', 'male', '2024-10-02', NULL, '$2a$12$M6Xwr.xlOG4ZaU1BAnb3lu7S32QomjsCkOUtaJopHJc3RXsCSBHWW', NULL, 'A', '2024-11-06 13:08:40', '2025-02-06 10:20:56', NULL),
(5, 'Saifuddin Mondal', '9564779054', 0.00, NULL, NULL, 'saifuddinmondal@gmail.com', NULL, NULL, NULL, '$2y$10$vSz8wszV09FBPhf4FTxDUeA0StdP4bQ55JNxRcmU0TgSvBny6cW5O', NULL, 'A', '2024-11-06 14:03:17', '2024-11-06 14:03:17', NULL),
(6, 'Siance', '8100098024', 0.00, NULL, NULL, 'siancesoftware@gmail.com', 'null', '1970-01-01', NULL, '$2y$10$2xcoAHseBiKIe2ojCdzx2.LWOnarOQQa2VOI6460q06dX1tccLEYG', NULL, 'A', '2024-11-13 10:26:08', '2025-03-02 22:14:24', NULL),
(7, 'Ishani', '9876546789', 0.00, NULL, NULL, 'ishani4@gmail.com', NULL, NULL, NULL, '$2y$10$CcyMbCIcZOkizYBUzHF7xOMfil6uEfaNdhnIQQag6RJoORA2rWxmi', NULL, 'A', '2024-11-13 13:21:19', '2024-11-13 13:21:19', NULL),
(8, 'Ishani', '9876546788', 0.00, NULL, NULL, 'ishani4@gmail.com', 'female', '2024-11-13', NULL, '$2y$10$adO.C4R.sFENpcZj0asD/ee.CO7/F1PANvFm2bcE1KBy550R0/1L6', NULL, 'A', '2024-11-13 13:22:38', '2024-11-13 17:45:22', NULL),
(9, 'Litan Gain', '9007810829', 0.00, NULL, NULL, 'litangain@gmail.com', NULL, NULL, NULL, '$2y$10$JjUoDAAorLpq/yePxQQCve28HL1UqJatvMroMw5crkOUj7VZnAIsq', NULL, 'A', '2024-11-14 20:30:13', '2024-11-14 20:30:13', NULL),
(10, 'Saifuddin Mondal', '6294269047', 0.00, NULL, NULL, 'rana.smart7894@gmail.com', NULL, NULL, NULL, '$2y$10$zF/E.YNDnFJVGCplHVHv/uCpXLI77RFbxYNUi6WXQfMz30avVoaBi', NULL, 'A', '2024-11-15 11:56:16', '2024-11-15 11:56:16', NULL),
(11, 'Sanjib Barai', '+918777347811', 0.00, NULL, NULL, 'ranjitbarai742@gmail.com', NULL, NULL, NULL, '$2y$10$XlwIBzRFa.T1Wbmzzv2pIewVNuBz.7VlSu4o4qhgGzP6CO2PHgCCC', NULL, 'A', '2024-11-15 17:08:08', '2024-11-15 17:08:08', NULL),
(12, 'Soumya Biswas', '7797088768', 0.00, NULL, NULL, 'biswassoumya0023@gmail.com', NULL, NULL, NULL, '$2y$10$yUjZsIhPf9x1F9ylGLYvzOw64AoLOUEp.kcH9uiNdZqgd.HOo1WEG', NULL, 'A', '2024-12-06 13:10:23', '2024-12-06 13:10:23', NULL),
(13, 'Saifuddin mondal', '9564779051', 0.00, NULL, NULL, 'saifuddinmondal2580@gmail.com', NULL, NULL, NULL, '$2y$10$7rhb4eFZLhRH9c.3VBulzelTdSJkElxH.Qmw6aXcn/RgGhv0Bhsvi', NULL, 'A', '2024-12-15 22:34:32', '2024-12-15 22:34:32', NULL),
(14, 'Ishani', '7003411905', 0.00, NULL, NULL, 'talukdarishani14@gmail.com', 'null', '1970-01-01', NULL, '$2y$10$Ns8orFTSQKlt9KgElZF4duCABeOyBzguzQTzkbBGasT0ByH8NajK2', NULL, 'A', '2025-02-06 13:05:37', '2025-02-06 16:22:40', NULL);

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
(19, 1, 'Kishor Mondal', 9898989898, '712103', 'India', 'West Bengal', 'Chinsurah', 'Krishnapur', 'Active', '2024-11-22 16:04:45', '2024-11-22 16:04:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_restaurant_tables`
--

CREATE TABLE `user_restaurant_tables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `restaurant_id` bigint(20) UNSIGNED NOT NULL,
  `table_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_restaurant_tables`
--

INSERT INTO `user_restaurant_tables` (`id`, `user_id`, `restaurant_id`, `table_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2025-03-12 08:37:02', '2025-03-12 11:30:22');

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mainpermission`
--
ALTER TABLE `mainpermission`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8281;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `restaurant_categories`
--
ALTER TABLE `restaurant_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `restaurant_tablenumbers`
--
ALTER TABLE `restaurant_tablenumbers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `resturants_tables`
--
ALTER TABLE `resturants_tables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sms_transaction`
--
ALTER TABLE `sms_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_addresses`
--
ALTER TABLE `user_addresses`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_restaurant_tables`
--
ALTER TABLE `user_restaurant_tables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `websiteconfigs`
--
ALTER TABLE `websiteconfigs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
