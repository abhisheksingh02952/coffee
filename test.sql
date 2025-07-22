-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2025 at 08:32 PM
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
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `user_id` int(40) NOT NULL,
  `id` int(40) NOT NULL,
  `username` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `status` enum('Present','Absent','Half Day') NOT NULL,
  `latitude_checkin` varchar(50) DEFAULT NULL,
  `longitude_checkin` varchar(50) DEFAULT NULL,
  `latitude_checkout` varchar(50) DEFAULT NULL,
  `longitude_checkout` varchar(50) DEFAULT NULL,
  `checkin_time` time DEFAULT NULL,
  `checkout_time` time DEFAULT NULL,
  `total_hours` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`user_id`, `id`, `username`, `date`, `status`, `latitude_checkin`, `longitude_checkin`, `latitude_checkout`, `longitude_checkout`, `checkin_time`, `checkout_time`, `total_hours`) VALUES
(2, 1, 'singh02952', '2025-07-01', 'Present', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(2, 2, 'singh02952', '2025-07-02', 'Present', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(2, 3, 'singh02952', '2025-07-03', 'Absent', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(2, 4, 'singh02952', '2025-07-04', 'Absent', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(1, 5, 'abhisheksingh02952', '2025-07-01', 'Present', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(1, 6, 'abhisheksingh02952', '2025-07-02', 'Absent', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(1, 7, 'abhisheksingh02952', '2025-07-03', 'Absent', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(1, 8, 'abhisheksingh02952', '2025-07-04', 'Absent', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(0, 9, '', '0000-00-00', 'Present', '28.721152', '77.2636672', NULL, NULL, '16:50:21', NULL, 0),
(1, 10, 'abhisheksingh02952', '2025-07-10', 'Present', '28.6084498', '77.3043273', NULL, NULL, '00:00:00', NULL, 0),
(1, 11, 'abhisheksingh02952', '2025-07-10', 'Present', '28.6084498', '77.3043273', NULL, NULL, '00:00:00', NULL, 0),
(1, 12, 'abhisheksingh02952', '2025-07-10', 'Present', '28.6084593', '77.3043955', NULL, NULL, '00:00:00', NULL, 0),
(1, 13, 'abhisheksingh02952', '2025-07-10', 'Present', '28.6084487', '77.304336', NULL, NULL, '00:00:00', NULL, 0),
(1, 14, 'abhisheksingh02952', '2025-07-10', 'Present', '28.721152', '77.2636672', NULL, NULL, '00:00:00', NULL, 0),
(1, 15, 'abhisheksingh02952', '2025-07-10', 'Present', '28.6084482', '77.3043375', NULL, NULL, '00:00:00', NULL, 0),
(1, 16, 'abhisheksingh02952', '2025-07-10', 'Present', '28.721152', '77.2636672', NULL, NULL, '23:28:59', NULL, 0),
(1, 17, 'abhisheksingh02952', '2025-07-10', 'Present', '28.721152', '77.2636672', NULL, NULL, '23:29:13', NULL, 0),
(1, 18, 'abhisheksingh02952', '2025-07-11', 'Absent', '28.721152', '77.2636672', '28.6084482', '77.3043375', '08:31:34', '11:43:26', 3),
(3, 19, '', '2025-07-11', 'Absent', '28.721152', '77.2636672', '28.721152', '77.2636672', '09:36:38', '10:40:14', 1),
(2, 20, 'singh02952', '2025-07-11', 'Absent', '28.6084532', '77.3043422', '28.6084594', '77.3043249', '11:44:33', '12:57:04', 1),
(10, 21, 'A10', '2025-07-11', 'Absent', '28.655616', '77.283328', '28.655616', '77.283328', '13:13:57', '13:14:08', 0),
(13, 22, 'A13', '2025-07-11', 'Present', '28.655616', '77.283328', NULL, NULL, '13:35:40', NULL, 0),
(2, 23, 'Test2', '2025-07-18', 'Absent', '28.6621696', '77.3292032', '28.6621696', '77.3292032', '11:55:11', '11:55:23', 0);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `user_id` int(11) NOT NULL,
  `reporting_id` int(40) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `fathername` varchar(100) DEFAULT NULL,
  `mothername` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `pin` varchar(10) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `position` enum('Distributor','Territory Sales Executive','Distributor Sales','Retailer','Admin') DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `role` enum('admin','employee') NOT NULL DEFAULT 'employee',
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`user_id`, `reporting_id`, `name`, `fathername`, `mothername`, `phone`, `email`, `address`, `pin`, `dob`, `gender`, `position`, `username`, `password`, `role`, `image`) VALUES
(1, 0, 'Employee Test 1', 'Employee Test 1', 'Employee Test 1', '08766', 'Employee Test 1', 'Employee Test 1', '123', '2025-07-16', 'Male', 'Territory Sales Executive', 'Test1', 'Employee Test 1', 'employee', 'employee_68775a73195008.72976769.jpg'),
(2, 1, 'Employee Test 2', 'Employee Test 2', 'Employee Test 2', '8755', 'Employee Test 2', 'Employee Test 2', '2456', '2025-07-16', 'Female', 'Distributor', 'Test2', 'Employee Test 2', 'employee', 'employee_68775e220c7e20.30761491.jpg'),
(3, 1, 'Employee Test 3', 'Employee Test 3', 'Employee Test 3', '7546', 'Employee Test 3', 'Employee Test 3', '110091', '2025-07-15', 'Male', 'Distributor', 'Employee Test 3', 'Employee Test 3', 'employee', 'remarks.jpeg'),
(4, 2, 'Employee Test 4', 'Employee Test 4', 'Employee Test 4', '75456', 'Employee Test 4', 'Employee Test 4', '110011', '2025-07-15', 'Male', 'Distributor Sales', 'Employee Test 4', 'Employee Test 4', 'employee', 'remarks.jpeg'),
(5, 2, 'Employee Test 5', 'Employee Test 5', 'Employee Test 5', '86446', 'Employee Test 5', 'Employee Test 5', '110012', '2025-07-15', 'Male', 'Distributor Sales', 'Employee Test 5', 'Employee Test 5', 'employee', 'remarks.jpeg'),
(6, 3, 'Employee Test 6', 'Employee Test 6', 'Employee Test 6', '64566', 'Employee Test 6', 'Employee Test 6', '110012', '2025-07-17', 'Female', 'Distributor Sales', 'Employee Test 6', 'Employee Test 6', 'employee', 'remarks.svg'),
(7, 3, 'Employee Test 7', 'Employee Test 7', 'Employee Test 7', '86456', 'Employee Test 7', 'Employee Test 7', '110011', '2025-07-17', 'Female', 'Distributor Sales', 'Employee Test 7', 'Employee Test 7', 'employee', 'remarks.svg'),
(8, 4, 'Employee Test 8', 'Employee Test 8', 'Employee Test 8', '96545', 'Employee Test 8', 'Employee Test 8', '110099', '2025-07-15', 'Male', 'Retailer', 'Employee Test 8', 'Employee Test 8', 'employee', 'remarks.svg'),
(9, 4, 'Employee Test 9', 'Employee Test 9', 'Employee Test 9', '0865', 'Employee Test 9', 'Employee Test 9', 'Employee T', '2025-07-15', 'Transgender', 'Retailer', 'Employee Test 9', 'Employee Test 9', 'employee', 'remarks.svg'),
(10, 1, 'Employee Test 10', 'Employee Test 10', 'Employee Test 10', 'Employee Test 10', 'Employee Test 10', 'Employee Test 10', 'Employee T', '2025-07-15', 'Transgender', 'Admin', 'Employee Test 10', 'Employee Test 10', 'admin', 'remarks.svg'),
(11, 4, 'Employee Test 11', 'Employee Test 11', 'Employee Test 11', 'Employee Test 11', 'Employee Test 11', 'Employee Test 11', 'Employee T', '2025-07-15', 'Transgender', 'Retailer', 'Employee Test 11', 'Employee Test 11', 'employee', 'remarks.svg'),
(13, 4, 'Employee Test 12', 'Employee Test 12', 'Employee Test 12', 'Employee Test 12', 'Employee Test 12', 'Employee Test 12', 'Employee T', '2025-07-16', 'Transgender', 'Retailer', 'Employee Test 12', 'Employee Test 12', 'employee', 'Honeycombs-Header-Image-1-q8wk39fjeqpu9ibnr8hf0yg3yvjjltljxjgsgu38co.jpg'),
(14, 5, 'Employee Test 13', 'Employee Test 13', 'Employee Test 13', 'Employee Test 13', 'Employee Test 13', 'Employee Test 13', 'Employee T', '2025-07-16', 'Transgender', 'Retailer', 'Employee Test 13', 'Employee Test 13', 'employee', 'Heading-Image-Template-3-ql3c7ub4dm6jf53qdee9uxumudxcenol634q8hdnuw.jpg'),
(15, 5, 'Employee Test 14', 'Employee Test 14', 'Employee Test 14', 'Employee Test 14', 'Employee Test 14', 'Employee Test 14', 'Employee T', '2025-07-16', 'Transgender', 'Retailer', 'Employee Test 14', 'Employee Test 14', 'employee', 'remarks.jpeg'),
(16, 6, 'Employee Test 15', 'Employee Test 15', 'Employee Test 15', 'Employee Test 15', 'Employee Test 15', 'Employee Test 15', 'Employee T', '2025-07-16', 'Male', 'Retailer', 'Employee Test 15', 'Employee Test 15', 'employee', 'remarks.jpeg'),
(17, 7, 'Employee Test 16', 'Employee Test 16', 'Employee Test 16', 'Employee Test 16', 'Employee Test 16', 'Employee Test 16', 'Employee T', '2025-07-16', 'Transgender', 'Retailer', 'Employee Test 16', 'Employee Test 16', 'employee', 'remarks.jpeg'),
(18, 1, 'Employee Test 16', 'Employee Test 16', 'Employee Test 16', 'Employee Test 16', 'Employee Test 16', 'Employee Test 16', 'Employee T', '2025-07-16', 'Transgender', 'Admin', 'Employee Test 16', 'Employee Test 16', 'admin', 'remarks.jpeg'),
(19, 1, 'Employee Test 17', 'Employee Test 17', 'Employee Test 17', 'Employee Test 17', 'Employee Test 17', 'Employee Test 17', 'Employee T', '2025-07-21', 'Male', 'Admin', 'Employee Test 17', 'Employee Test 17', 'admin', 'uploads/dealer_6878d67ef41a81.80310863.jpg'),
(20, 7, 'Employee Test 18', 'Employee Test 18', 'Employee Test 18', 'Employee Test 18', 'Employee Test 18', 'Employee Test 18', 'Employee T', '2025-07-21', 'Female', 'Retailer', 'Employee Test 18', 'Employee Test 18', 'employee', 'uploads/dealer_6878d6dd842bf5.58900929.jpg'),
(21, 1, 'Employee Test 19', 'Employee Test 19', 'Employee Test 19', 'Employee Test 19', 'Employee Test 19', 'Employee Test 19', 'Employee T', '2025-07-21', 'Male', 'Admin', 'Employee Test 19', 'Employee Test 19', 'admin', 'uploads/dealer_6878d7e789def6.39097023.jpg'),
(22, 1, 'Employee Test 20', 'Employee Test 20', 'Employee Test 20', 'Employee Test 20', 'Employee Test 20', 'Employee Test 20', 'Employee T', '2025-07-21', 'Female', 'Admin', 'Employee Test 20', 'Employee Test 20', 'admin', 'uploads/dealer_6878e632e350f4.25646760.jpg'),
(23, 1, 'Employee Test 21', 'Employee Test 21', 'Employee Test 21', '882679', 'Employee Test 21', 'Employee Test 11', '110091', '2025-07-16', 'Male', 'Admin', 'Employee Test 21', 'Employee Test 21', 'admin', '61Edzdb4SOL._SL1500_.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_id` varchar(100) DEFAULT NULL,
  `shop_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `scheme` varchar(100) DEFAULT NULL,
  `payment_type` enum('Cash','Online') DEFAULT NULL,
  `payment_status` enum('Pending','Paid') DEFAULT 'Pending',
  `total_amount` decimal(10,2) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `shop_id`, `employee_id`, `scheme`, `payment_type`, `payment_status`, `total_amount`, `date`) VALUES
(1, 'ORD-20250722-1753171657-100004', 100004, 11, 'Test4', 'Cash', 'Pending', 4250.00, '2025-07-22 13:37:37'),
(2, 'ORD-20250722-1753172839-100003', 100003, 11, 'Test3', 'Cash', 'Pending', 5800.00, '2025-07-22 13:57:19'),
(3, 'ORD-20250722-1753185934-100002', 100002, 3, 'Test2', 'Cash', 'Pending', 61900.00, '2025-07-22 17:35:34'),
(4, 'ORD-20250722-1753196719-100005', 100005, 16, 'XYZ', 'Online', 'Pending', 48700.00, '2025-07-22 20:35:19');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` varchar(100) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 'ORD-20250722-1753171657-100004', 2, 5, 550.00),
(2, 'ORD-20250722-1753171657-100004', 5, 10, 150.00),
(3, 'ORD-20250722-1753172839-100003', 6, 10, 180.00),
(4, 'ORD-20250722-1753172839-100003', 11, 10, 200.00),
(5, 'ORD-20250722-1753172839-100003', 8, 10, 200.00),
(6, 'ORD-20250722-1753185934-100002', 4, 20, 120.00),
(7, 'ORD-20250722-1753185934-100002', 7, 15, 900.00),
(8, 'ORD-20250722-1753185934-100002', 11, 30, 200.00),
(9, 'ORD-20250722-1753185934-100002', 10, 50, 800.00),
(10, 'ORD-20250722-1753196719-100005', 6, 70, 180.00),
(11, 'ORD-20250722-1753196719-100005', 4, 80, 120.00),
(12, 'ORD-20250722-1753196719-100005', 3, 50, 450.00),
(13, 'ORD-20250722-1753196719-100005', 9, 80, 50.00);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `order_ids` varchar(100) DEFAULT NULL,
  `shop_id` int(40) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `payment_type` enum('cash','online') DEFAULT NULL,
  `payment_status` enum('Pending','Paid') NOT NULL DEFAULT 'Pending',
  `order_date` datetime DEFAULT current_timestamp(),
  `employee_id` int(255) DEFAULT NULL,
  `collection_date` datetime DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `order_id`, `order_ids`, `shop_id`, `amount`, `payment_type`, `payment_status`, `order_date`, `employee_id`, `collection_date`, `remarks`) VALUES
(1, NULL, 'ORD-20250722-1753171657-100004', NULL, 4250.00, NULL, 'Pending', '2025-07-22 13:37:37', NULL, NULL, ''),
(2, NULL, 'ORD-20250722-1753172839-100003', NULL, 5800.00, NULL, 'Pending', '2025-07-22 13:57:19', NULL, NULL, ''),
(3, NULL, 'ORD-20250722-1753185934-100002', 100002, 61900.00, 'online', 'Paid', '2025-07-22 17:35:34', 16, '2025-07-22 20:31:48', 'Payment is collected'),
(4, NULL, 'ORD-20250722-1753196719-100005', 100005, 48700.00, 'cash', 'Paid', '2025-07-22 20:35:19', 16, '2025-07-22 20:35:54', 'DONE');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `sku` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `sku`, `price`) VALUES
(1, 'Espresso Beans', 'SKU001', 500.00),
(2, 'Arabica Beans', 'SKU002', 550.00),
(3, 'Robusta Beans', 'SKU003', 450.00),
(4, 'Cold Brew Bottle', 'SKU004', 120.00),
(5, 'Iced Latte Mix', 'SKU005', 150.00),
(6, 'Cappuccino Powder', 'SKU006', 180.00),
(7, 'Milk Frother', 'SKU007', 900.00),
(8, 'Coffee Mug', 'SKU008', 200.00),
(9, 'Filter Paper Pack', 'SKU009', 50.00),
(10, 'French Press', 'SKU010', 800.00),
(11, 'Test 2', 'Test 2', 200.00),
(13, 'Test 3', 'Test 3', 250.00),
(14, 'Test 4', 'Test 4', 450.00);

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `shop_id` int(40) NOT NULL,
  `name` varchar(50) NOT NULL,
  `fathername` varchar(50) NOT NULL,
  `gst` varchar(50) NOT NULL,
  `phone` int(40) NOT NULL,
  `address` varchar(100) NOT NULL,
  `pin` int(40) NOT NULL,
  `area` varchar(50) NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `scheme` varchar(50) NOT NULL,
  `reporting_id` int(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`shop_id`, `name`, `fathername`, `gst`, `phone`, `address`, `pin`, `area`, `latitude`, `longitude`, `scheme`, `reporting_id`) VALUES
(100001, 'Test1', 'Test1', 'Test1', 982645242, 'Test1', 110031, 'Test1', '28.6621696', '77.1915776', 'Test1', 15),
(100002, 'Test2', 'Test2', 'Test2', 243229486, 'Test2', 110092, 'Test2', '28.6621696', '77.1915776', 'Test2', 4),
(100003, 'Test3', 'Test3', 'Test3', 94673842, 'Test3', 110091, 'Test3', '28.6621696', '77.3292032', 'Test3', 20),
(100004, 'Test4', 'Test4', 'Test4', 2147483647, 'Test4', 110051, 'Test4', '28.6621696', '77.3292032', 'Test4', 5),
(100005, 'Abhishek Singh', 'Ram', 'Test 1', 2147483647, 'Trilok Puri', 110091, 'Delhi', '28.6083775', '77.3043599', 'XYZ', 16);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 0,
  `last_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `product_id`, `shop_id`, `quantity`, `last_updated`) VALUES
(1, 1, 100002, 5, '2025-07-22 19:59:48'),
(2, 2, 100002, 10, '2025-07-22 19:59:48'),
(3, 3, 100002, 15, '2025-07-22 19:59:48'),
(4, 4, 100002, 9, '2025-07-22 19:59:48'),
(5, 5, 100002, 7, '2025-07-22 19:59:48'),
(6, 6, 100002, 20, '2025-07-22 19:59:48'),
(7, 7, 100002, 15, '2025-07-22 19:59:48'),
(8, 8, 100002, 11, '2025-07-22 19:59:48'),
(9, 9, 100002, 2, '2025-07-22 19:59:48'),
(10, 10, 100002, 5, '2025-07-22 19:59:48'),
(11, 11, 100002, 9, '2025-07-22 19:59:48'),
(12, 1, 100001, 7, '2025-07-22 20:16:15'),
(13, 2, 100001, 9, '2025-07-22 20:16:15'),
(14, 3, 100001, 8, '2025-07-22 20:16:15'),
(15, 4, 100001, 0, '2025-07-22 20:16:15'),
(16, 5, 100001, 5, '2025-07-22 20:16:15'),
(17, 6, 100001, 7, '2025-07-22 20:16:15'),
(18, 7, 100001, 17, '2025-07-22 20:16:15'),
(19, 8, 100001, 0, '2025-07-22 20:16:15'),
(20, 9, 100001, 20, '2025-07-22 20:16:15'),
(21, 10, 100001, 10, '2025-07-22 20:16:15'),
(22, 11, 100001, 50, '2025-07-22 20:16:15'),
(23, 13, 100001, 50, '2025-07-22 20:16:15'),
(24, 14, 100001, 50, '2025-07-22 20:16:15'),
(25, 1, 100003, 6, '2025-07-22 20:18:24'),
(26, 2, 100003, 1, '2025-07-22 20:18:24'),
(27, 3, 100003, 6, '2025-07-22 20:18:24'),
(28, 4, 100003, 7, '2025-07-22 20:18:24'),
(29, 5, 100003, 9, '2025-07-22 20:18:24'),
(30, 6, 100003, 3, '2025-07-22 20:18:24'),
(31, 7, 100003, 5, '2025-07-22 20:18:24'),
(32, 8, 100003, 10, '2025-07-22 20:18:24'),
(33, 9, 100003, 17, '2025-07-22 20:18:24'),
(34, 10, 100003, 5, '2025-07-22 20:18:24'),
(35, 11, 100003, 8, '2025-07-22 20:18:24'),
(36, 13, 100003, 9, '2025-07-22 20:18:24'),
(37, 14, 100003, 1, '2025-07-22 20:18:24'),
(38, 1, 100004, 7, '2025-07-22 20:21:00'),
(39, 2, 100004, 10, '2025-07-22 20:21:00'),
(40, 3, 100004, 4, '2025-07-22 20:21:00'),
(41, 4, 100004, 8, '2025-07-22 20:21:00'),
(42, 5, 100004, 9, '2025-07-22 20:21:00'),
(43, 6, 100004, 2, '2025-07-22 20:21:00'),
(44, 7, 100004, 5, '2025-07-22 20:21:00'),
(45, 8, 100004, 5, '2025-07-22 20:21:00'),
(46, 9, 100004, 2, '2025-07-22 20:21:00'),
(47, 10, 100004, 7, '2025-07-22 20:21:00'),
(48, 11, 100004, 2, '2025-07-22 20:21:00'),
(49, 13, 100004, 9, '2025-07-22 20:21:00'),
(50, 14, 100004, 5, '2025-07-22 20:21:00'),
(51, 1, 100005, 39, '2025-07-22 20:22:23'),
(52, 2, 100005, 29, '2025-07-22 20:22:23'),
(53, 3, 100005, 4, '2025-07-22 20:22:23'),
(54, 4, 100005, 53, '2025-07-22 20:22:23'),
(55, 5, 100005, 5, '2025-07-22 20:22:23'),
(56, 6, 100005, 8, '2025-07-22 20:22:23'),
(57, 7, 100005, 1, '2025-07-22 20:22:23'),
(58, 8, 100005, 4, '2025-07-22 20:22:23'),
(59, 9, 100005, 5, '2025-07-22 20:22:23'),
(60, 10, 100005, 3, '2025-07-22 20:22:23'),
(61, 11, 100005, 8, '2025-07-22 20:22:23'),
(62, 13, 100005, 2, '2025-07-22 20:22:23'),
(63, 14, 100005, 6, '2025-07-22 20:22:23');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` int(40) NOT NULL,
  `user_id` int(40) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `Description` varchar(200) NOT NULL,
  `Assign_Date` date NOT NULL,
  `Timeline_Date` date NOT NULL,
  `Status` varchar(50) NOT NULL,
  `Rating` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `user_id`, `Title`, `Description`, `Assign_Date`, `Timeline_Date`, `Status`, `Rating`) VALUES
(1, 130, 'Test1', 'Test1', '2025-06-02', '2025-06-10', 'Done', 0),
(2, 131, 'task2', 'task2', '2025-07-05', '2025-07-06', 'task2', 0),
(3, 2, 'task2', 'task2', '2025-07-05', '2025-07-06', 'task2', 0),
(4, 2, 'Task3', 'Task3', '2025-07-05', '2025-07-13', 'Task3', 0),
(5, 2, 'Task3', 'Task3', '2025-07-05', '2025-07-13', 'Task3', 0),
(6, 2, 'Task6', 'Task6', '2025-07-04', '2025-07-13', 'Task6', 0),
(7, 1, 't', 't', '2025-07-06', '2025-07-06', 'test01', 0),
(8, 1, 'Text 2', 'Text 2', '2025-07-07', '2025-07-07', 'Working', 0),
(9, 1, 'ADV', 'SFH', '2025-07-09', '2025-07-19', 'Working', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shop_id` (`shop_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sku` (`sku`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`shop_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_id` (`product_id`,`shop_id`),
  ADD KEY `shop_id` (`shop_id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `shop_id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100006;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`shop_id`) REFERENCES `shop` (`shop_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`user_id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `stock_ibfk_2` FOREIGN KEY (`shop_id`) REFERENCES `shop` (`shop_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
