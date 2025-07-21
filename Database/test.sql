-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2025 at 09:31 AM
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
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `dealers`
--

CREATE TABLE `dealers` (
  `id` int(40) NOT NULL,
  `name` varchar(50) NOT NULL,
  `gst_no` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `pin` int(50) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `dealers`
--

INSERT INTO `dealers` (`id`, `name`, `gst_no`, `address`, `pin`, `type`) VALUES
(1, 'Abhishek', 'GT134GFR65', 'TRILOK', 110091, 'distributor'),
(2, 'Singh', '0892BDEN535VDE', 'PURI', 110092, 'Wholesaler'),
(3, 'Vikash', 'VEFW8374HE24', 'Mayur', 110001, 'retailer'),
(4, 'Anoop', 'CW35CCV567', 'Vihar', 110051, 'distributor'),
(5, 'Verma', 'GFR65GT134', 'New Ashok Nagar', 110031, 'Wholesaler'),
(6, 'Ashok', 'BV3234VW35', 'seemapuri', 110072, 'retailer');

-- --------------------------------------------------------

--
-- Table structure for table `employee_attendance`
--

CREATE TABLE `employee_attendance` (
  `user_id` int(40) NOT NULL,
  `id` int(40) NOT NULL,
  `em_user_id` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `status` enum('Present','Absent') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `employee_attendance`
--

INSERT INTO `employee_attendance` (`user_id`, `id`, `em_user_id`, `date`, `status`) VALUES
(2, 1, 'singh02952', '2025-07-01', 'Present'),
(2, 2, 'singh02952', '2025-07-02', 'Present'),
(2, 3, 'singh02952', '2025-07-03', 'Absent'),
(2, 4, 'singh02952', '2025-07-04', 'Absent'),
(1, 5, 'abhisheksingh02952', '2025-07-01', 'Present'),
(1, 6, 'abhisheksingh02952', '2025-07-02', 'Absent'),
(1, 7, 'abhisheksingh02952', '2025-07-03', 'Absent'),
(1, 8, 'abhisheksingh02952', '2025-07-04', 'Absent');

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

-- --------------------------------------------------------

--
-- Table structure for table `user_db`
--

CREATE TABLE `user_db` (
  `user_id` int(5) NOT NULL,
  `em_user_id` varchar(50) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `em_name` varchar(50) NOT NULL,
  `em_phone` varchar(40) NOT NULL,
  `em_address` varchar(100) NOT NULL,
  `em_email` varchar(100) NOT NULL,
  `position` varchar(50) NOT NULL,
  `em_status` int(5) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `sale` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_db`
--

INSERT INTO `user_db` (`user_id`, `em_user_id`, `password`, `em_name`, `em_phone`, `em_address`, `em_email`, `position`, `em_status`, `parent_id`, `sale`) VALUES
(1, 'A1', 'ABCD', 'Employee 1', 'em-p', 'em-a', 'em-e', 'Chief Executive Officer', 1, 0, 0),
(2, 'A2', 'B2', 'Employee 2', 'em-p', 'em-a', 'em-e', 'Vice President 1', 1, 1, 0),
(3, 'A3', 'B3', 'Employee 3', 'em-p', 'em-a', 'em-e', 'Vice President 2', 1, 1, 0),
(4, 'A4', 'B4', 'Employee 4', 'em-p', 'em-a', 'em-e', 'Regional Manager 1', 1, 2, 0),
(5, 'A5', 'B5', 'Employee 5', 'em-p', 'em-a', 'em-e', 'Regional Manager 2', 1, 2, 0),
(6, 'A6', 'B6', 'Employee 6', 'em-p', 'em-a', 'em-e', 'Regional Manager 3', 1, 3, 0),
(7, 'A7', 'B7', 'Employee 7', 'em-p', 'em-a', 'em-e', 'Regional Manager 4', 1, 3, 0),
(8, 'A8', 'B8', 'Employee 8', 'em-p', 'em-a', 'em-e', 'State Manager 1', 1, 4, 0),
(9, 'A9', 'B9', 'Employee 9', 'em-p', 'em-a', 'em-e', 'State Manager 2', 1, 4, 0),
(10, 'A10', 'B10', 'Employee 10', 'em-p', 'em-a', 'em-e', 'State Manager 3', 1, 5, 0),
(11, 'A11', 'B11', 'Employee 11', 'em-p', 'em-a', 'em-e', 'State Manager 4', 1, 5, 0),
(12, 'A12', 'B12', 'Employee 12', 'em-p', 'em-a', 'em-e', 'State Manager 5', 1, 6, 0),
(13, 'A13', 'B13', 'Employee 13', 'em-p', 'em-a', 'em-e', 'State Manager 6', 1, 6, 0),
(14, 'A14', 'B14', 'Employee 14', 'em-p', 'em-a', 'em-e', 'State Manager 7', 1, 7, 0),
(15, 'A15', 'B15', 'Employee 15', 'em-p', 'em-a', 'em-e', 'State Manager 8', 1, 7, 0),
(16, 'A16', 'B16', 'Employee 16', 'em-p', 'em-a', 'em-e', 'Zonal Manager 1', 1, 8, 0),
(17, 'A17', 'B17', 'Employee 17', 'em-p', 'em-a', 'em-e', 'Zonal Manager 2', 1, 8, 0),
(18, 'A18', 'B18', 'Employee 18', 'em-p', 'em-a', 'em-e', 'Zonal Manager 3', 1, 9, 0),
(19, 'A19', 'B19', 'Employee 19', 'em-p', 'em-a', 'em-e', 'Zonal Manager 4', 1, 9, 0),
(20, 'A20', 'B20', 'Employee 20', 'em-p', 'em-a', 'em-e', 'Zonal Manager 5', 1, 10, 0),
(21, 'A21', 'B21', 'Employee 21', 'em-p', 'em-a', 'em-e', 'Zonal Manager 6', 1, 10, 0),
(22, 'A22', 'B22', 'Employee 22', 'em-p', 'em-a', 'em-e', 'Zonal Manager 7', 1, 11, 0),
(23, 'A23', 'B23', 'Employee 23', 'em-p', 'em-a', 'em-e', 'Zonal Manager 8', 1, 11, 0),
(24, 'A24', 'B24', 'Employee 24', 'em-p', 'em-a', 'em-e', 'Zonal Manager 9', 1, 12, 0),
(25, 'A25', 'B25', 'Employee 25', 'em-p', 'em-a', 'em-e', 'Zonal Manager 10', 1, 12, 0),
(26, 'A26', 'B26', 'Employee 26', 'em-p', 'em-a', 'em-e', 'Zonal Manager 11', 1, 13, 0),
(27, 'A27', 'B27', 'Employee 27', 'em-p', 'em-a', 'em-e', 'Zonal Manager 12', 1, 13, 0),
(28, 'A28', 'B28', 'Employee 28', 'em-p', 'em-a', 'em-e', 'Zonal Manager 13', 1, 14, 0),
(29, 'A29', 'B29', 'Employee 29', 'em-p', 'em-a', 'em-e', 'Zonal Manager 14', 1, 14, 0),
(30, 'A30', 'B30', 'Employee 30', 'em-p', 'em-a', 'em-e', 'Zonal Manager 15', 1, 15, 0),
(31, 'A31', 'B31', 'Employee 31', 'em-p', 'em-a', 'em-e', 'Zonal Manager 16', 1, 15, 0),
(32, 'A32', 'B32', 'Employee 32', 'em-p', 'em-a', 'em-e', 'Seles Manager 1', 1, 16, 0),
(33, 'A33', 'B33', 'Employee 33', 'em-p', 'em-a', 'em-e', 'Seles Manager 2', 1, 16, 0),
(34, 'A34', 'B34', 'Employee 34', 'em-p', 'em-a', 'em-e', 'Seles Manager 3', 1, 17, 0),
(35, 'A35', 'B35', 'Employee 35', 'em-p', 'em-a', 'em-e', 'Seles Manager 4', 1, 17, 0),
(36, 'A36', 'B36', 'Employee 36', 'em-p', 'em-a', 'em-e', 'Seles Manager 5', 1, 18, 0),
(37, 'A37', 'B37', 'Employee 37', 'em-p', 'em-a', 'em-e', 'Seles Manager 6', 1, 18, 0),
(38, 'A38', 'B38', 'Employee 38', 'em-p', 'em-a', 'em-e', 'Seles Manager 7', 1, 19, 0),
(39, 'A39', 'B39', 'Employee 39', 'em-p', 'em-a', 'em-e', 'Seles Manager 8', 1, 19, 0),
(40, 'A40', 'B40', 'Employee 40', 'em-p', 'em-a', 'em-e', 'Seles Manager 9', 1, 20, 0),
(41, 'A41', 'B41', 'Employee 41', 'em-p', 'em-a', 'em-e', 'Seles Manager 10', 1, 20, 0),
(42, 'A42', 'B42', 'Employee 42', 'em-p', 'em-a', 'em-e', 'Seles Manager 11', 1, 21, 0),
(43, 'A43', 'B43', 'Employee 43', 'em-p', 'em-a', 'em-e', 'Seles Manager 12', 1, 21, 0),
(44, 'A44', 'B44', 'Employee 44', 'em-p', 'em-a', 'em-e', 'Seles Manager 13', 1, 22, 0),
(45, 'A45', 'B45', 'Employee 45', 'em-p', 'em-a', 'em-e', 'Seles Manager 14', 1, 22, 0),
(46, 'A46', 'B46', 'Employee 46', 'em-p', 'em-a', 'em-e', 'Seles Manager 15', 1, 23, 0),
(47, 'A47', 'B47', 'Employee 47', 'em-p', 'em-a', 'em-e', 'Seles Manager 16', 1, 23, 0),
(48, 'A48', 'B48', 'Employee 48', 'em-p', 'em-a', 'em-e', 'Seles Manager 17', 1, 24, 0),
(49, 'A49', 'B49', 'Employee 49', 'em-p', 'em-a', 'em-e', 'Seles Manager 18', 1, 24, 0),
(50, 'A50', 'B50', 'Employee 50', 'em-p', 'em-a', 'em-e', 'Seles Manager 19', 1, 25, 0),
(51, 'A51', 'B51', 'Employee 51', 'em-p', 'em-a', 'em-e', 'Seles Manager 20', 1, 25, 0),
(52, 'A52', 'B52', 'Employee 52', 'em-p', 'em-a', 'em-e', 'Seles Manager 21', 1, 26, 0),
(53, 'A53', 'B53', 'Employee 53', 'em-p', 'em-a', 'em-e', 'Seles Manager 22', 1, 26, 0),
(54, 'A54', 'B54', 'Employee 54', 'em-p', 'em-a', 'em-e', 'Seles Manager 23', 1, 27, 0),
(55, 'A55', 'B55', 'Employee 55', 'em-p', 'em-a', 'em-e', 'Seles Manager 24', 1, 27, 0),
(56, 'A56', 'B56', 'Employee 56', 'em-p', 'em-a', 'em-e', 'Seles Manager 25', 1, 28, 0),
(57, 'A57', 'B57', 'Employee 57', 'em-p', 'em-a', 'em-e', 'Seles Manager 26', 1, 28, 0),
(58, 'A58', 'B58', 'Employee 58', 'em-p', 'em-a', 'em-e', 'Seles Manager 27', 1, 29, 0),
(59, 'A59', 'B59', 'Employee 59', 'em-p', 'em-a', 'em-e', 'Seles Manager 28', 1, 29, 0),
(60, 'A60', 'B60', 'Employee 60', 'em-p', 'em-a', 'em-e', 'Seles Manager 29', 1, 30, 0),
(61, 'A61', 'B61', 'Employee 61', 'em-p', 'em-a', 'em-e', 'Seles Manager 30', 1, 30, 0),
(62, 'A62', 'B62', 'Employee 62', 'em-p', 'em-a', 'em-e', 'Seles Manager 31', 1, 31, 0),
(63, 'A63', 'B63', 'Employee 63', 'em-p', 'em-a', 'em-e', 'Seles Manager 32', 1, 31, 0),
(64, 'A64', 'B64', 'Employee 64', 'em-p', 'em-a', 'em-e', 'Seles Executive 1', 1, 32, 5000),
(65, 'A65', 'B65', 'Employee 65', 'em-p', 'em-a', 'em-e', 'Seles Executive 2', 1, 32, 300),
(66, 'A66', 'B66', 'Employee 66', 'em-p', 'em-a', 'em-e', 'Seles Executive 3', 1, 33, 204),
(67, 'A67', 'B67', 'Employee 67', 'em-p', 'em-a', 'em-e', 'Seles Executive 4', 1, 33, 33442),
(68, 'A68', 'B68', 'Employee 68', 'em-p', 'em-a', 'em-e', 'Seles Executive 5', 1, 34, 4248),
(69, 'A69', 'B69', 'Employee 69', 'em-p', 'em-a', 'em-e', 'Seles Executive 6', 1, 34, 3421),
(70, 'A70', 'B70', 'Employee 70', 'em-p', 'em-a', 'em-e', 'Seles Executive 7', 1, 35, 24235),
(71, 'A71', 'B71', 'Employee 71', 'em-p', 'em-a', 'em-e', 'Seles Executive 8', 1, 35, 8233),
(72, 'A72', 'B72', 'Employee 72', 'em-p', 'em-a', 'em-e', 'Seles Executive 9', 1, 36, 3533),
(73, 'A73', 'B73', 'Employee 73', 'em-p', 'em-a', 'em-e', 'Seles Executive 10', 1, 36, 2345),
(74, 'A74', 'B74', 'Employee 74', 'em-p', 'em-a', 'em-e', 'Seles Executive 11', 1, 37, 5324),
(75, 'A75', 'B75', 'Employee 75', 'em-p', 'em-a', 'em-e', 'Seles Executive 12', 1, 37, 3543),
(76, 'A76', 'B76', 'Employee 76', 'em-p', 'em-a', 'em-e', 'Seles Executive 13', 1, 38, 2443),
(77, 'A77', 'B77', 'Employee 77', 'em-p', 'em-a', 'em-e', 'Seles Executive 14', 1, 38, 3332),
(78, 'A78', 'B78', 'Employee 78', 'em-p', 'em-a', 'em-e', 'Seles Executive 15', 1, 39, 2353),
(79, 'A79', 'B79', 'Employee 79', 'em-p', 'em-a', 'em-e', 'Seles Executive 16', 1, 39, 2434),
(80, 'A80', 'B80', 'Employee 80', 'em-p', 'em-a', 'em-e', 'Seles Executive 17', 1, 40, 34334),
(81, 'A81', 'B81', 'Employee 81', 'em-p', 'em-a', 'em-e', 'Seles Executive 18', 1, 40, 533),
(82, 'A82', 'B82', 'Employee 82', 'em-p', 'em-a', 'em-e', 'Seles Executive 19', 1, 41, 342),
(83, 'A83', 'B83', 'Employee 83', 'em-p', 'em-a', 'em-e', 'Seles Executive 20', 1, 41, 232),
(84, 'A84', 'B84', 'Employee 84', 'em-p', 'em-a', 'em-e', 'Seles Executive 21', 1, 42, 234),
(85, 'A85', 'B85', 'Employee 85', 'em-p', 'em-a', 'em-e', 'Seles Executive 22', 1, 42, 232),
(86, 'A86', 'B86', 'Employee 86', 'em-p', 'em-a', 'em-e', 'Seles Executive 23', 1, 43, 324),
(87, 'A87', 'B87', 'Employee 87', 'em-p', 'em-a', 'em-e', 'Seles Executive 24', 1, 43, 4223),
(88, 'A88', 'B88', 'Employee 88', 'em-p', 'em-a', 'em-e', 'Seles Executive 25', 1, 44, 4242),
(89, 'A89', 'B89', 'Employee 89', 'em-p', 'em-a', 'em-e', 'Seles Executive 26', 1, 44, 423),
(90, 'A90', 'B90', 'Employee 90', 'em-p', 'em-a', 'em-e', 'Seles Executive 27', 1, 45, 232),
(91, 'A91', 'B91', 'Employee 91', 'em-p', 'em-a', 'em-e', 'Seles Executive 28', 1, 45, 423),
(92, 'A92', 'B92', 'Employee 92', 'em-p', 'em-a', 'em-e', 'Sales Executive 29', 1, 46, 242),
(93, 'A93', 'B93', 'Employee 93', 'em-p', 'em-a', 'em-e', 'Sales Executive 30', 1, 46, 423),
(94, 'A94', 'B94', 'Employee 94', 'em-p', 'em-a', 'em-e', 'Sales Executive 31', 1, 47, 423),
(95, 'A95', 'B95', 'Employee 95', 'em-p', 'em-a', 'em-e', 'Sales Executive 32', 1, 47, 2334),
(96, 'A96', 'B96', 'Employee 96', 'em-p', 'em-a', 'em-e', 'Sales Executive 33', 1, 48, 234),
(97, 'A97', 'B97', 'Employee 97', 'em-p', 'em-a', 'em-e', 'Sales Executive 34', 1, 48, 232),
(98, 'A98', 'B98', 'Employee 98', 'em-p', 'em-a', 'em-e', 'Sales Executive 35', 1, 49, 424),
(99, 'A99', 'B99', 'Employee 99', 'em-p', 'em-a', 'em-e', 'Sales Executive 36', 1, 49, 385),
(100, 'A100', 'B100', 'Employee 100', 'em-p', 'em-a', 'em-e', 'Sales Executive 37', 1, 50, 6543),
(101, 'A101', 'B101', 'Employee 101', 'em-p', 'em-a', 'em-e', 'Sales Executive 38', 1, 50, 123),
(102, 'A102', 'B102', 'Employee 102', 'em-p', 'em-a', 'em-e', 'Sales Executive 39', 1, 51, 345),
(103, 'A103', 'B103', 'Employee 103', 'em-p', 'em-a', 'em-e', 'Sales Executive 40', 1, 51, 53),
(104, 'A104', 'B104', 'Employee 104', 'em-p', 'em-a', 'em-e', 'Sales Executive 41', 1, 52, 243),
(105, 'A105', 'B105', 'Employee 105', 'em-p', 'em-a', 'em-e', 'Sales Executive 42', 1, 52, 422),
(106, 'A106', 'B106', 'Employee 106', 'em-p', 'em-a', 'em-e', 'Sales Executive 43', 1, 53, 53),
(107, 'A107', 'B107', 'Employee 107', 'em-p', 'em-a', 'em-e', 'Sales Executive 44', 1, 53, 42),
(108, 'A108', 'B108', 'Employee 108', 'em-p', 'em-a', 'em-e', 'Sales Executive 45', 1, 54, 53),
(109, 'A109', 'B109', 'Employee 109', 'em-p', 'em-a', 'em-e', 'Sales Executive 46', 1, 54, 534),
(110, 'A110', 'B110', 'Employee 110', 'em-p', 'em-a', 'em-e', 'Sales Executive 47', 1, 55, 343),
(111, 'A111', 'B111', 'Employee 111', 'em-p', 'em-a', 'em-e', 'Sales Executive 48', 1, 55, 53),
(112, 'A112', 'B112', 'Employee 112', 'em-p', 'em-a', 'em-e', 'Sales Executive 49', 1, 56, 343),
(113, 'A113', 'B113', 'Employee 113', 'em-p', 'em-a', 'em-e', 'Sales Executive 50', 1, 56, 53),
(114, 'A114', 'B114', 'Employee 114', 'em-p', 'em-a', 'em-e', 'Sales Executive 51', 1, 57, 344),
(115, 'A115', 'B115', 'Employee 115', 'em-p', 'em-a', 'em-e', 'Sales Executive 52', 1, 57, 53),
(116, 'A116', 'B116', 'Employee 116', 'em-p', 'em-a', 'em-e', 'Sales Executive 53', 1, 58, 534),
(117, 'A117', 'B117', 'Employee 117', 'em-p', 'em-a', 'em-e', 'Sales Executive 54', 1, 58, 53),
(118, 'A118', 'B118', 'Employee 118', 'em-p', 'em-a', 'em-e', 'Sales Executive 55', 1, 59, 435),
(119, 'A119', 'B119', 'Employee 119', 'em-p', 'em-a', 'em-e', 'Sales Executive 56', 1, 59, 354),
(120, 'A120', 'B120', 'Employee 120', 'em-p', 'em-a', 'em-e', 'Sales Executive 57', 1, 60, 344),
(121, 'A121', 'B121', 'Employee 121', 'em-p', 'em-a', 'em-e', 'Sales Executive 58', 1, 60, 534),
(122, 'A122', 'B122', 'Employee 122', 'em-p', 'em-a', 'em-e', 'Sales Executive 59', 1, 61, 432),
(123, 'A123', 'B123', 'Employee 123', 'em-p', 'em-a', 'em-e', 'Sales Executive 60', 1, 61, 534),
(124, 'A124', 'B124', 'Employee 124', 'em-p', 'em-a', 'em-e', 'Sales Executive 61', 1, 62, 434),
(125, 'A125', 'B125', 'Employee 125', 'em-p', 'em-a', 'em-e', 'Sales Executive 62', 1, 62, 344),
(126, 'A126', 'B126', 'Employee 126', 'em-p', 'em-a', 'em-e', 'Sales Executive 63', 1, 63, 434),
(127, 'A127', 'B127', 'Employee 127', 'em-p', 'em-a', 'em-e', 'Sales Executive 64', 1, 63, 423),
(128, 'A128', 'B128', 'Employee 128', 'em-p', 'em-a', 'em-e', 'Sales Executive 65', 1, 63, 433),
(130, 'abhisheksingh02952', '02952', 'Abhishek Singh', '8826798985', '395-H P-2', '12345', 'IT-Support', 1, 64, 233),
(131, 'singh02952', 'an', 'S', '1', '1', '3', 'IT-Support', 1, 64, 234);

-- --------------------------------------------------------

--
-- Table structure for table `wholesaler`
--

CREATE TABLE `wholesaler` (
  `id` int(30) NOT NULL,
  `name` varchar(50) NOT NULL,
  `gst_no` varchar(35) NOT NULL,
  `address` varchar(50) NOT NULL,
  `pin` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dealers`
--
ALTER TABLE `dealers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_attendance`
--
ALTER TABLE `employee_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_db`
--
ALTER TABLE `user_db`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `wholesaler`
--
ALTER TABLE `wholesaler`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dealers`
--
ALTER TABLE `dealers`
  MODIFY `id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employee_attendance`
--
ALTER TABLE `employee_attendance`
  MODIFY `id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_db`
--
ALTER TABLE `user_db`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `wholesaler`
--
ALTER TABLE `wholesaler`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
