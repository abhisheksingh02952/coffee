-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2025 at 02:25 PM
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
(2, 23, 'Test2', '2025-07-18', 'Absent', '28.6621696', '77.3292032', '28.6621696', '77.3292032', '11:55:11', '11:55:23', 0),
(1, 24, 'Employee Test 19', '2025-07-23', 'Absent', '28.4295168', '77.4832128', '28.4295168', '77.4832128', '16:39:10', '16:40:30', 0),
(20, 25, 'Employee Test 18', '2025-07-23', 'Absent', '28.4295168', '77.4832128', '28.4295168', '77.4832128', '17:24:22', '17:26:14', 0);

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
  `image` varchar(255) DEFAULT NULL,
  `is_deleted` int(10) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`user_id`, `reporting_id`, `name`, `fathername`, `mothername`, `phone`, `email`, `address`, `pin`, `dob`, `gender`, `position`, `username`, `password`, `role`, `image`, `is_deleted`) VALUES
(1, 0, 'Employee Test 1', 'Employee Test 1', 'Employee Test 1', '08766', 'Employee Test 1', 'Employee Test 1', '123', '2025-07-16', 'Male', 'Territory Sales Executive', 'Employee Test 1', 'Employee Test 1', 'employee', 'employee_68775a73195008.72976769.jpg', 1),
(2, 1, 'Employee Test 2', 'Employee Test 2', 'Employee Test 2', '8755', 'Employee Test 2', 'Employee Test 2', '2456', '2025-07-16', 'Female', 'Distributor', 'Test2', 'Employee Test 2', 'employee', 'employee_68775e220c7e20.30761491.jpg', 1),
(3, 1, 'Employee Test 3', 'Employee Test 3', 'Employee Test 3', '7546', 'Employee Test 3', 'Employee Test 3', '110091', '2025-07-15', 'Male', 'Distributor', 'Employee Test 3', 'Employee Test 3', 'employee', 'remarks.jpeg', 1),
(4, 2, 'Employee Test 4', 'Employee Test 4', 'Employee Test 4', '75456', 'Employee Test 4', 'Employee Test 4', '110011', '2025-07-15', 'Male', 'Distributor Sales', 'Employee Test 4', 'Employee Test 4', 'employee', 'remarks.jpeg', 1),
(5, 2, 'Employee Test 5', 'Employee Test 5', 'Employee Test 5', '86446', 'Employee Test 5', 'Employee Test 5', '110012', '2025-07-15', 'Male', 'Distributor Sales', 'Employee Test 5', 'Employee Test 5', 'employee', 'remarks.jpeg', 1),
(6, 3, 'Employee Test 6', 'Employee Test 6', 'Employee Test 6', '64566', 'Employee Test 6', 'Employee Test 6', '110012', '2025-07-17', 'Female', 'Distributor Sales', 'Employee Test 6', 'Employee Test 6', 'employee', 'remarks.svg', 1),
(7, 3, 'Employee Test 7', 'Employee Test 7', 'Employee Test 7', '86456', 'Employee Test 7', 'Employee Test 7', '110011', '2025-07-17', 'Female', 'Distributor Sales', 'Employee Test 7', 'Employee Test 7', 'employee', 'remarks.svg', 1),
(8, 4, 'Employee Test 8', 'Employee Test 8', 'Employee Test 8', '96545', 'Employee Test 8', 'Employee Test 8', '110099', '2025-07-15', 'Male', 'Retailer', 'Employee Test 8', 'Employee Test 8', 'employee', 'remarks.svg', 1),
(9, 4, 'Employee Test 9', 'Employee Test 9', 'Employee Test 9', '0865', 'Employee Test 9', 'Employee Test 9', 'Employee T', '2025-07-15', 'Transgender', 'Retailer', 'Employee Test 9', 'Employee Test 9', 'employee', 'remarks.svg', 1),
(10, 1, 'Employee Test 10', 'Employee Test 10', 'Employee Test 10', 'Employee Test 10', 'Employee Test 10', 'Employee Test 10', 'Employee T', '2025-07-15', 'Transgender', 'Admin', 'Employee Test 10', 'Employee Test 10', 'admin', 'remarks.svg', 1),
(11, 4, 'Employee Test 11', 'Employee Test 11', 'Employee Test 11', 'Employee Test 11', 'Employee Test 11', 'Employee Test 11', 'Employee T', '2025-07-15', 'Transgender', 'Retailer', 'Employee Test 11', 'Employee Test 11', 'employee', 'remarks.svg', 1),
(13, 4, 'Employee Test 12', 'Employee Test 12', 'Employee Test 12', 'Employee Test 12', 'Employee Test 12', 'Employee Test 12', 'Employee T', '2025-07-16', 'Transgender', 'Retailer', 'Employee Test 12', 'Employee Test 12', 'employee', 'Honeycombs-Header-Image-1-q8wk39fjeqpu9ibnr8hf0yg3yvjjltljxjgsgu38co.jpg', 1),
(14, 5, 'Employee Test 13', 'Employee Test 13', 'Employee Test 13', 'Employee Test 13', 'Employee Test 13', 'Employee Test 13', 'Employee T', '2025-07-16', 'Transgender', 'Retailer', 'Employee Test 13', 'Employee Test 13', 'employee', 'Heading-Image-Template-3-ql3c7ub4dm6jf53qdee9uxumudxcenol634q8hdnuw.jpg', 1),
(15, 5, 'Employee Test 14', 'Employee Test 14', 'Employee Test 14', 'Employee Test 14', 'Employee Test 14', 'Employee Test 14', 'Employee T', '2025-07-16', 'Transgender', 'Retailer', 'Employee Test 14', 'Employee Test 14', 'employee', 'remarks.jpeg', 1),
(16, 6, 'Employee Test 15', 'Employee Test 15', 'Employee Test 15', 'Employee Test 15', 'Employee Test 15', 'Employee Test 15', 'Employee T', '2025-07-16', 'Male', 'Retailer', 'Employee Test 15', 'Employee Test 15', 'employee', 'remarks.jpeg', 1),
(17, 7, 'Employee Test 16', 'Employee Test 16', 'Employee Test 16', 'Employee Test 16', 'Employee Test 16', 'Employee Test 16', 'Employee T', '2025-07-16', 'Transgender', 'Retailer', 'Employee Test 16', 'Employee Test 16', 'employee', 'remarks.jpeg', 1),
(18, 1, 'Employee Test 16', 'Employee Test 16', 'Employee Test 16', 'Employee Test 16', 'Employee Test 16', 'Employee Test 16', 'Employee T', '2025-07-16', 'Transgender', 'Admin', 'Employee Test 16', 'Employee Test 16', 'admin', 'remarks.jpeg', 1),
(19, 1, 'Employee Test 17', 'Employee Test 17', 'Employee Test 17', 'Employee Test 17', 'Employee Test 17', 'Employee Test 17', 'Employee T', '2025-07-21', 'Male', 'Admin', 'Employee Test 17', 'Employee Test 17', 'admin', 'uploads/dealer_6878d67ef41a81.80310863.jpg', 1),
(20, 7, 'Employee Test 18', 'Employee Test 18', 'Employee Test 18', 'Employee Test 18', 'Employee Test 18', 'Employee Test 18', 'Employee T', '2025-07-21', 'Female', 'Retailer', 'Employee Test 18', 'Employee Test 18', 'employee', 'uploads/dealer_6878d6dd842bf5.58900929.jpg', 1),
(21, 1, 'Employee Test 19', 'Employee Test 19', 'Employee Test 19', 'Employee Test 19', 'Employee Test 19', 'Employee Test 19', 'Employee T', '2025-07-21', 'Male', 'Admin', 'Employee Test 19', 'Employee Test 19', 'admin', 'uploads/dealer_6878d7e789def6.39097023.jpg', 1),
(22, 1, 'Employee Test 20', 'Employee Test 20', 'Employee Test 20', 'Employee Test 20', 'Employee Test 20', 'Employee Test 20', 'Employee T', '2025-07-21', 'Female', 'Admin', 'Employee Test 20', 'Employee Test 20', 'admin', 'uploads/dealer_6878e632e350f4.25646760.jpg', 1),
(23, 1, 'Employee Test 21', 'Employee Test 21', 'Employee Test 21', '882679', 'Employee Test 21', 'Employee Test 11', '110091', '2025-07-16', 'Male', 'Admin', 'Employee Test 21', 'Employee Test 21', 'admin', '61Edzdb4SOL._SL1500_.jpg', 1);

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
  `date` datetime DEFAULT current_timestamp(),
  `is_deleted` int(10) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `shop_id`, `employee_id`, `scheme`, `payment_type`, `payment_status`, `total_amount`, `date`, `is_deleted`) VALUES
(1, 'ORD-20250722-1753171657-100004', 100004, 11, 'Test4', 'Cash', 'Pending', 700.00, '2025-07-22 13:37:37', 1),
(2, 'ORD-20250722-1753172839-100003', 100003, 11, 'Test3', 'Cash', 'Pending', 4180.00, '2025-07-22 13:57:19', 1),
(3, 'ORD-20250722-1753185934-100002', 100002, 3, 'Test2', 'Cash', 'Pending', 20420.00, '2025-07-22 17:35:34', 1),
(4, 'ORD-20250722-1753196719-100005', 100005, 16, 'XYZ', 'Online', 'Pending', 26800.00, '2025-07-22 20:35:19', 1),
(5, 'ORD-20250723-1753238254-100001', 100001, 7, 'Test1', 'Cash', 'Pending', 2550.00, '2025-07-23 08:07:34', 1),
(6, 'ORD-20250723-1753238285-100001', 100001, 7, 'Test1', 'Cash', 'Pending', 1100.00, '2025-07-23 08:08:05', 1),
(7, 'ORD-20250723-1753238311-100001', 100001, 7, 'Test1', 'Cash', 'Pending', 520.00, '2025-07-23 08:08:31', 1),
(8, 'ORD-20250723-1753238336-100002', 100002, 7, 'Test2', 'Cash', 'Pending', 1870.00, '2025-07-23 08:08:56', 1),
(9, 'ORD-20250723-1753238358-100002', 100002, 7, 'Test2', 'Cash', 'Pending', 4170.00, '2025-07-23 08:09:18', 1),
(10, 'ORD-20250723-1753238377-100002', 100002, 7, 'Test2', 'Cash', 'Pending', 7320.00, '2025-07-23 08:09:37', 1),
(11, 'ORD-20250723-1753238401-100002', 100002, 7, 'Test2', 'Cash', 'Pending', 1800.00, '2025-07-23 08:10:01', 1),
(12, 'ORD-20250723-1753238428-100003', 100003, 7, 'Test3', 'Cash', 'Pending', 3780.00, '2025-07-23 08:10:28', 1),
(13, 'ORD-20250723-1753238445-100003', 100003, 7, 'Test3', 'Cash', 'Pending', 8220.00, '2025-07-23 08:10:45', 1),
(14, 'ORD-20250723-1753238468-100003', 100003, 7, 'Test3', 'Cash', 'Pending', 6750.00, '2025-07-23 08:11:08', 1),
(15, 'ORD-20250723-1753238485-100004', 100004, 7, 'Test4', 'Cash', 'Pending', 1750.00, '2025-07-23 08:11:25', 1),
(16, 'ORD-20250723-1753238508-100004', 100004, 7, 'Test4', 'Cash', 'Pending', 4830.00, '2025-07-23 08:11:48', 1),
(17, 'ORD-20250723-1753238523-100004', 100004, 7, 'Test4', 'Cash', 'Pending', 7600.00, '2025-07-23 08:12:03', 1),
(18, 'ORD-20250723-1753238552-100005', 100005, 7, 'XYZ', 'Cash', 'Pending', 4270.00, '2025-07-23 08:12:32', 1),
(19, 'ORD-20250723-1753238563-100005', 100005, 7, 'XYZ', 'Cash', 'Pending', 2250.00, '2025-07-23 08:12:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` varchar(100) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `is_deleted` int(10) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `is_deleted`) VALUES
(1, 'ORD-20250722-1753171657-100004', 2, 1, 550.00, 1),
(2, 'ORD-20250722-1753171657-100004', 5, 1, 150.00, 1),
(3, 'ORD-20250722-1753172839-100003', 6, 1, 180.00, 1),
(4, 'ORD-20250722-1753172839-100003', 11, 10, 200.00, 1),
(5, 'ORD-20250722-1753172839-100003', 8, 10, 200.00, 1),
(6, 'ORD-20250722-1753185934-100002', 4, 1, 120.00, 1),
(7, 'ORD-20250722-1753185934-100002', 7, 15, 900.00, 1),
(8, 'ORD-20250722-1753185934-100002', 11, 30, 200.00, 1),
(9, 'ORD-20250722-1753185934-100002', 10, 1, 800.00, 1),
(10, 'ORD-20250722-1753196719-100005', 6, 1, 180.00, 1),
(11, 'ORD-20250722-1753196719-100005', 4, 1, 120.00, 1),
(12, 'ORD-20250722-1753196719-100005', 3, 50, 450.00, 1),
(13, 'ORD-20250722-1753196719-100005', 9, 80, 50.00, 1),
(14, 'ORD-20250723-1753238254-100001', 3, 4, 450.00, 1),
(15, 'ORD-20250723-1753238254-100001', 5, 1, 150.00, 1),
(16, 'ORD-20250723-1753238254-100001', 8, 3, 200.00, 1),
(17, 'ORD-20250723-1753238285-100001', 4, 1, 120.00, 1),
(18, 'ORD-20250723-1753238285-100001', 6, 1, 180.00, 1),
(19, 'ORD-20250723-1753238285-100001', 10, 1, 800.00, 1),
(20, 'ORD-20250723-1753238311-100001', 4, 1, 120.00, 1),
(21, 'ORD-20250723-1753238311-100001', 8, 2, 200.00, 1),
(22, 'ORD-20250723-1753238336-100002', 2, 1, 550.00, 1),
(23, 'ORD-20250723-1753238336-100002', 4, 1, 120.00, 1),
(24, 'ORD-20250723-1753238336-100002', 8, 6, 200.00, 1),
(25, 'ORD-20250723-1753238358-100002', 4, 1, 120.00, 1),
(26, 'ORD-20250723-1753238358-100002', 3, 9, 450.00, 1),
(27, 'ORD-20250723-1753238377-100002', 4, 1, 120.00, 1),
(28, 'ORD-20250723-1753238377-100002', 7, 8, 900.00, 1),
(29, 'ORD-20250723-1753238401-100002', 1, 2, 500.00, 1),
(30, 'ORD-20250723-1753238401-100002', 13, 1, 250.00, 1),
(31, 'ORD-20250723-1753238401-100002', 2, 1, 550.00, 1),
(32, 'ORD-20250723-1753238428-100003', 3, 3, 450.00, 1),
(33, 'ORD-20250723-1753238428-100003', 6, 1, 180.00, 1),
(34, 'ORD-20250723-1753238428-100003', 13, 9, 250.00, 1),
(35, 'ORD-20250723-1753238445-100003', 4, 1, 120.00, 1),
(36, 'ORD-20250723-1753238445-100003', 7, 9, 900.00, 1),
(37, 'ORD-20250723-1753238468-100003', 3, 7, 450.00, 1),
(38, 'ORD-20250723-1753238468-100003', 7, 4, 900.00, 1),
(39, 'ORD-20250723-1753238485-100004', 5, 1, 150.00, 1),
(40, 'ORD-20250723-1753238485-100004', 11, 8, 200.00, 1),
(41, 'ORD-20250723-1753238508-100004', 7, 5, 900.00, 1),
(42, 'ORD-20250723-1753238508-100004', 6, 1, 180.00, 1),
(43, 'ORD-20250723-1753238508-100004', 5, 1, 150.00, 1),
(44, 'ORD-20250723-1753238523-100004', 7, 4, 900.00, 1),
(45, 'ORD-20250723-1753238523-100004', 1, 8, 500.00, 1),
(46, 'ORD-20250723-1753238552-100005', 1, 8, 500.00, 1),
(47, 'ORD-20250723-1753238552-100005', 5, 1, 150.00, 1),
(48, 'ORD-20250723-1753238552-100005', 5, 1, 150.00, 1),
(49, 'ORD-20250723-1753238552-100005', 4, 1, 120.00, 1),
(50, 'ORD-20250723-1753238563-100005', 3, 5, 450.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `order_id` varchar(100) DEFAULT NULL,
  `shop_id` int(40) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `payment_type` enum('cash','online') DEFAULT NULL,
  `payment_status` enum('Pending','Paid') NOT NULL DEFAULT 'Pending',
  `order_date` datetime DEFAULT current_timestamp(),
  `employee_id` int(255) DEFAULT NULL,
  `collection_date` datetime DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `is_deleted` int(10) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `order_id`, `shop_id`, `amount`, `payment_type`, `payment_status`, `order_date`, `employee_id`, `collection_date`, `remarks`, `is_deleted`) VALUES
(1, 'ORD-20250722-1753171657-100004', NULL, 4250.00, NULL, 'Pending', '2025-07-22 13:37:37', NULL, NULL, '', 1),
(2, 'ORD-20250722-1753172839-100003', NULL, 5800.00, NULL, 'Pending', '2025-07-22 13:57:19', NULL, NULL, '', 1),
(3, 'ORD-20250722-1753185934-100002', 100002, 61900.00, 'online', 'Paid', '2025-07-22 17:35:34', 16, '2025-07-22 20:31:48', 'Payment is collected', 1),
(4, 'ORD-20250722-1753196719-100005', 100005, 48700.00, 'cash', 'Paid', '2025-07-22 20:35:19', 16, '2025-07-22 20:35:54', 'DONE', 1),
(5, 'ORD-20250723-1753238254-100001', 100001, 5400.00, NULL, 'Pending', '2025-07-23 08:07:34', NULL, NULL, NULL, 1),
(6, 'ORD-20250723-1753238285-100001', 100001, 13000.00, NULL, 'Pending', '2025-07-23 08:08:05', NULL, NULL, NULL, 1),
(7, 'ORD-20250723-1753238311-100001', 100001, 1000.00, NULL, 'Pending', '2025-07-23 08:08:31', NULL, NULL, NULL, 1),
(8, 'ORD-20250723-1753238336-100002', 100002, 5460.00, NULL, 'Pending', '2025-07-23 08:08:56', NULL, NULL, NULL, 1),
(9, 'ORD-20250723-1753238358-100002', 100002, 4770.00, NULL, 'Pending', '2025-07-23 08:09:18', NULL, NULL, NULL, 1),
(10, 'ORD-20250723-1753238377-100002', 100002, 7800.00, 'cash', 'Paid', '2025-07-23 08:09:37', 20, '2025-07-23 17:17:39', 'Collected', 1),
(11, 'ORD-20250723-1753238401-100002', 100002, 13350.00, NULL, 'Pending', '2025-07-23 08:10:01', NULL, NULL, NULL, 1),
(12, 'ORD-20250723-1753238428-100003', 100003, 4860.00, NULL, 'Pending', '2025-07-23 08:10:28', NULL, NULL, NULL, 1),
(13, 'ORD-20250723-1753238445-100003', 100003, 8700.00, NULL, 'Pending', '2025-07-23 08:10:46', NULL, NULL, NULL, 1),
(14, 'ORD-20250723-1753238468-100003', 100003, 6750.00, NULL, 'Pending', '2025-07-23 08:11:08', NULL, NULL, NULL, 1),
(15, 'ORD-20250723-1753238485-100004', 100004, 2200.00, NULL, 'Pending', '2025-07-23 08:11:25', NULL, NULL, NULL, 1),
(16, 'ORD-20250723-1753238508-100004', 100004, 6420.00, NULL, 'Pending', '2025-07-23 08:11:48', NULL, NULL, NULL, 1),
(17, 'ORD-20250723-1753238523-100004', 100004, 7600.00, NULL, 'Pending', '2025-07-23 08:12:03', NULL, NULL, NULL, 1),
(18, 'ORD-20250723-1753238552-100005', 100005, 6700.00, NULL, 'Pending', '2025-07-23 08:12:32', NULL, NULL, NULL, 1),
(19, 'ORD-20250723-1753238563-100005', 100005, 2250.00, NULL, 'Pending', '2025-07-23 08:12:43', NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `sku` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `is_deleted` int(10) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `sku`, `price`, `is_deleted`) VALUES
(1, 'Espresso Beans', 'SKU001', 500.00, 1),
(2, 'Arabica Beans', 'SKU002', 550.00, 1),
(3, 'Robusta Beans', 'SKU003', 450.00, 1),
(4, 'Cold Brew Bottle', 'SKU004', 120.00, 1),
(5, 'Iced Latte Mix', 'SKU005', 150.00, 1),
(6, 'Cappuccino Powder', 'SKU006', 180.00, 1),
(7, 'Milk Frother', 'SKU007', 900.00, 1),
(8, 'Coffee Mug', 'SKU008', 200.00, 1),
(9, 'Filter Paper Pack', 'SKU009', 50.00, 1),
(10, 'French Press', 'SKU010', 800.00, 1),
(11, 'Test 2', 'Test 2', 200.00, 1),
(13, 'Test 3', 'Test 3', 250.00, 1),
(14, 'Test 4', 'Test 4', 450.00, 1),
(15, 'Abhishek Singh', 'SKU00111', 100.00, 1);

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
  `reporting_id` int(40) NOT NULL,
  `is_deleted` int(10) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`shop_id`, `name`, `fathername`, `gst`, `phone`, `address`, `pin`, `area`, `latitude`, `longitude`, `scheme`, `reporting_id`, `is_deleted`) VALUES
(100001, 'Test1', 'Test1', 'Test1', 982645242, 'Test1', 110031, 'Test1', '28.6621696', '77.1915776', 'Test1', 15, 1),
(100002, 'Test2', 'Test2', 'Test2', 243229486, 'Test2', 110092, 'Test2', '28.6621696', '77.1915776', 'Test2', 4, 1),
(100003, 'Test3', 'Test3', 'Test3', 94673842, 'Test3', 110091, 'Test3', '28.6621696', '77.3292032', 'Test3', 20, 1),
(100004, 'Test4', 'Test4', 'Test4', 2147483647, 'Test4', 110051, 'Test4', '28.6621696', '77.3292032', 'Test4', 5, 1),
(100005, 'Abhishek Singh', 'Ram', 'Test 1', 2147483647, 'Trilok Puri', 110091, 'Delhi', '28.6083775', '77.3043599', 'XYZ', 16, 1);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 0,
  `last_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_deleted` int(10) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `product_id`, `shop_id`, `quantity`, `last_updated`, `is_deleted`) VALUES
(1, 1, 100002, 5, '2025-07-22 19:59:48', 1),
(2, 2, 100002, 10, '2025-07-22 19:59:48', 1),
(3, 3, 100002, 15, '2025-07-22 19:59:48', 1),
(4, 4, 100002, 9, '2025-07-22 19:59:48', 1),
(5, 5, 100002, 7, '2025-07-22 19:59:48', 1),
(6, 6, 100002, 20, '2025-07-22 19:59:48', 1),
(7, 7, 100002, 15, '2025-07-22 19:59:48', 1),
(8, 8, 100002, 11, '2025-07-22 19:59:48', 1),
(9, 9, 100002, 2, '2025-07-22 19:59:48', 1),
(10, 10, 100002, 5, '2025-07-22 19:59:48', 1),
(11, 11, 100002, 9, '2025-07-22 19:59:48', 1),
(12, 1, 100001, 7, '2025-07-22 20:16:15', 1),
(13, 2, 100001, 9, '2025-07-22 20:16:15', 1),
(14, 3, 100001, 8, '2025-07-22 20:16:15', 1),
(15, 4, 100001, 0, '2025-07-22 20:16:15', 1),
(16, 5, 100001, 5, '2025-07-22 20:16:15', 1),
(17, 6, 100001, 7, '2025-07-22 20:16:15', 1),
(18, 7, 100001, 17, '2025-07-22 20:16:15', 1),
(19, 8, 100001, 0, '2025-07-22 20:16:15', 1),
(20, 9, 100001, 20, '2025-07-22 20:16:15', 1),
(21, 10, 100001, 10, '2025-07-22 20:16:15', 1),
(22, 11, 100001, 50, '2025-07-22 20:16:15', 1),
(23, 13, 100001, 50, '2025-07-22 20:16:15', 1),
(24, 14, 100001, 50, '2025-07-22 20:16:15', 1),
(25, 1, 100003, 6, '2025-07-22 20:18:24', 1),
(26, 2, 100003, 1, '2025-07-22 20:18:24', 1),
(27, 3, 100003, 6, '2025-07-22 20:18:24', 1),
(28, 4, 100003, 7, '2025-07-22 20:18:24', 1),
(29, 5, 100003, 9, '2025-07-22 20:18:24', 1),
(30, 6, 100003, 3, '2025-07-22 20:18:24', 1),
(31, 7, 100003, 5, '2025-07-22 20:18:24', 1),
(32, 8, 100003, 10, '2025-07-22 20:18:24', 1),
(33, 9, 100003, 17, '2025-07-22 20:18:24', 1),
(34, 10, 100003, 5, '2025-07-22 20:18:24', 1),
(35, 11, 100003, 8, '2025-07-22 20:18:24', 1),
(36, 13, 100003, 9, '2025-07-22 20:18:24', 1),
(37, 14, 100003, 1, '2025-07-22 20:18:24', 1),
(38, 1, 100004, 7, '2025-07-22 20:21:00', 1),
(39, 2, 100004, 10, '2025-07-22 20:21:00', 1),
(40, 3, 100004, 4, '2025-07-22 20:21:00', 1),
(41, 4, 100004, 8, '2025-07-22 20:21:00', 1),
(42, 5, 100004, 9, '2025-07-22 20:21:00', 1),
(43, 6, 100004, 2, '2025-07-22 20:21:00', 1),
(44, 7, 100004, 5, '2025-07-22 20:21:00', 1),
(45, 8, 100004, 5, '2025-07-22 20:21:00', 1),
(46, 9, 100004, 2, '2025-07-22 20:21:00', 1),
(47, 10, 100004, 7, '2025-07-22 20:21:00', 1),
(48, 11, 100004, 2, '2025-07-22 20:21:00', 1),
(49, 13, 100004, 9, '2025-07-22 20:21:00', 1),
(50, 14, 100004, 5, '2025-07-22 20:21:00', 1),
(51, 1, 100005, 39, '2025-07-22 20:22:23', 1),
(52, 2, 100005, 29, '2025-07-22 20:22:23', 1),
(53, 3, 100005, 4, '2025-07-22 20:22:23', 1),
(54, 4, 100005, 53, '2025-07-22 20:22:23', 1),
(55, 5, 100005, 5, '2025-07-22 20:22:23', 1),
(56, 6, 100005, 8, '2025-07-22 20:22:23', 1),
(57, 7, 100005, 1, '2025-07-22 20:22:23', 1),
(58, 8, 100005, 4, '2025-07-22 20:22:23', 1),
(59, 9, 100005, 5, '2025-07-22 20:22:23', 1),
(60, 10, 100005, 3, '2025-07-22 20:22:23', 1),
(61, 11, 100005, 8, '2025-07-22 20:22:23', 1),
(62, 13, 100005, 2, '2025-07-22 20:22:23', 1),
(63, 14, 100005, 6, '2025-07-22 20:22:23', 1);

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
(9, 1, 'ADV', 'SFH', '2025-07-09', '2025-07-19', 'Working', 0),
(10, 20, 'Test 1', 'Test 1', '2025-07-23', '2025-07-30', 'Done', 0);

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
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `idx_order_id` (`order_id`);

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
  ADD KEY `payments_ibfk_1` (`order_id`);

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
  MODIFY `id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
  MODIFY `id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

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
