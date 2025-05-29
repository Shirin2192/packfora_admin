-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2025 at 02:53 PM
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
-- Database: `db_packfora`
--

-- --------------------------------------------------------

--
-- Table structure for table `career_applications`
--

CREATE TABLE `career_applications` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `position` varchar(100) NOT NULL,
  `resume` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `career_applications`
--

INSERT INTO `career_applications` (`id`, `name`, `email`, `phone`, `position`, `resume`, `message`, `submitted_at`) VALUES
(1, 'Shirin Ragbansingh', 'ragbansinghshirin@gmail.com', '8010597075', 'Packaging Consultant', 'resume_68086e9916d5d9.12290284.docx', 'Test Mail', '2025-04-23 04:37:45'),
(2, 'Shirin Ragbansingh', 'shirin@sda-zone.com', '8010597075', 'Packaging Consultant', 'resume_6808734f00f9a5.17713542.docx', 'Test Mail', '2025-04-23 04:57:51');

-- --------------------------------------------------------

--
-- Table structure for table `contact_inquiries`
--

CREATE TABLE `contact_inquiries` (
  `id` int(11) NOT NULL,
  `inquiry_type` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `hear_about_us` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_inquiries`
--

INSERT INTO `contact_inquiries` (`id`, `inquiry_type`, `full_name`, `company_name`, `email`, `phone_number`, `message`, `hear_about_us`, `created_at`) VALUES
(1, 'Career Opportunity', 'test', 'test', 'test@gmail.com', '8010597075', 'test', NULL, '2025-04-21 12:34:25'),
(2, 'Career Opportunity', 'Shirin Ragbansingh', 'SDA', 'ragbansinghshirin@gmail.com', '+918010597075', 'Test Mail', NULL, '2025-04-22 11:39:04'),
(3, 'Career Opportunity', 'Shirin Ragbansingh', 'SDA', 'ragbansinghshirin@gmail.com', '+918010597075', 'Test Mail', NULL, '2025-04-22 11:53:58'),
(4, 'Career Opportunity', 'Shirin Ragbansingh', 'SDA', 'ragbansinghshirin@gmail.com', '+918010597075', 'Testing Mail', NULL, '2025-04-22 11:55:49'),
(5, 'Career Opportunity', 'Shirin Ragbansingh', 'SDA Company', 'ragbansinghshirin@gmail.com', '+918010597075', 'Test Mail', NULL, '2025-04-22 12:03:00'),
(6, 'Career Opportunity', 'Shirin Ragbansingh', 'SDA', 'ragbansinghshirin@gmail.com', '+918010597075', 'Test Mail', NULL, '2025-04-22 12:05:04'),
(7, 'Career Opportunity', 'Shirin Ragbansingh', 'SDA', 'ragbansinghshirin@gmail.com', '+918010597075', 'Test Mail', NULL, '2025-04-22 12:08:23'),
(8, 'Career Opportunity', 'Shirin Ragbansingh', 'SDA Company', 'ragbansinghshirin@gmail.com', '+918010597075', 'Test Mail', NULL, '2025-04-22 12:11:01'),
(9, 'Career Opportunity', 'Shirin Ragbansingh', 'SDA Company', 'ragbansinghshirin@gmail.com', '+918010597075', 'TEst Mail', NULL, '2025-04-22 12:23:01'),
(10, 'Career Opportunity', 'Shirin Ragbansingh', 'SDA', 'ragbansinghshirin@gmail.com', '+918010597075', 'TEst', NULL, '2025-04-22 12:26:21'),
(11, 'Career Opportunity', 'Shirin Ragbansingh', 'SDA Company', 'ragbansinghshirin@gmail.com', '+918010597075', 'Test', NULL, '2025-04-22 12:28:17'),
(12, 'Career Opportunity', 'Shirin Ragbansingh', 'SDA Company', 'ragbansinghshirin@gmail.com', '+918010597075', 'Test Mail', NULL, '2025-04-23 04:31:51'),
(13, 'Career Opportunity', 'Shirin Ragbansingh', 'SDA Company', 'shirin@sda-zone.com', '+918010597075', 'Test Mail', NULL, '2025-04-23 04:54:43'),
(14, 'Career Opportunity', 'Shirin Ragbansingh', 'SDA Company', 'ragbansinghshirin@gmail.com', '+918010589075444444', '44444444', NULL, '2025-04-23 05:09:15'),
(15, 'Sustainability', 'Shirin Ragbansingh', 'SDA', 'ragbansinghshirin@gmail.com', '+918010597075', 'sssss', '', '2025-05-01 06:01:59'),
(16, 'Supply Chain Automation', 'Shirin Ragbansingh', 'SDA', 'ragbansinghshirin@gmail.com', '+918010597075', 'test', 'Referral from a Packforian', '2025-05-01 06:06:44'),
(17, 'Talent Flex', 'fggfd', 'SDA', 'ragbansinghshirin@gmail.com', '+918010597075', 'i', '', '2025-05-01 06:12:21');

-- --------------------------------------------------------

--
-- Table structure for table `contact_requests`
--

CREATE TABLE `contact_requests` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `service` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_requests`
--

INSERT INTO `contact_requests` (`id`, `full_name`, `email`, `phone_number`, `service`, `message`, `created_at`) VALUES
(1, 'test', 'test@gmail.com', '8010597075', 'Mold Management', 'test', '2025-04-21 12:35:32'),
(2, 'Shirin Ragbansingh', 'shirin@sda-zone.com', '8010597075', 'Packaging Innovation Engineering', 'Test Mail', '2025-04-23 04:53:25'),
(3, 'Shirin Ragbansingh', 'shirin@sda-zone.com', '8010597075', 'Packaging Innovation Engineering', 'Test Mail', '2025-04-23 04:53:25'),
(4, 'Gaurav ', 'test@gmail.vcom', '+9198765432', 'Sustainability', 'Test', '2025-04-24 17:44:00'),
(5, 'Gaurav ', 'test@gmail.vcom', '+9198765432', 'Sustainability', 'Test', '2025-04-24 17:44:00');

-- --------------------------------------------------------

--
-- Table structure for table `current_opening`
--

CREATE TABLE `current_opening` (
  `id` bigint(20) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `is_delete` enum('1','0') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `current_opening`
--

INSERT INTO `current_opening` (`id`, `title`, `description`, `location`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Packaging Consultant', 'Lead Clients projects to deisgn suatainable packaging solutions.', 'Location: Remote | Full-Time', '0', '2025-05-28 05:38:08', '2025-05-28 11:34:51'),
(2, 'Sustainable Specialist', 'Advise clients on eco-friendly materials and circular economy strategies.', 'Location: New York, NY | Full-Time', '1', '2025-05-28 05:41:54', '2025-05-28 05:41:54');

-- --------------------------------------------------------

--
-- Table structure for table `our_clients`
--

CREATE TABLE `our_clients` (
  `id` bigint(20) NOT NULL,
  `image` longtext DEFAULT NULL,
  `is_delete` enum('1','0') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `our_clients`
--

INSERT INTO `our_clients` (`id`, `image`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'http://localhost/packfora/packfora_admin/uploads/clients/0cce0c0cf2a7bbb737b59776f3b3444a.webp', '1', '2025-05-29 11:16:29', '2025-05-29 11:16:29'),
(2, 'http://localhost/packfora/packfora_admin/uploads/clients/e7d52865e93659fae1ee14376e131022.webp', '1', '2025-05-29 11:17:09', '2025-05-29 11:17:09'),
(3, 'http://localhost/packfora/packfora_admin/uploads/clients/78099f674292bf71aa53a75a570a2062.webp', '1', '2025-05-29 11:17:44', '2025-05-29 11:17:44'),
(4, 'http://localhost/packfora/packfora_admin/uploads/clients/51fb800716bffbde6b409a5679c00315.webp', '1', '2025-05-29 11:17:52', '2025-05-29 11:17:52'),
(5, 'http://localhost/packfora/packfora_admin/uploads/clients/d714ea63a9980844b7f188967ef30161.webp', '1', '2025-05-29 11:18:03', '2025-05-29 11:18:03');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact_us`
--

CREATE TABLE `tbl_contact_us` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contact_no` varchar(20) DEFAULT NULL,
  `designation` varchar(100) DEFAULT NULL,
  `attachment` longtext DEFAULT NULL,
  `is_delete` enum('1','0') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_contact_us`
--

INSERT INTO `tbl_contact_us` (`id`, `name`, `email`, `contact_no`, `designation`, `attachment`, `is_delete`, `created_at`) VALUES
(1, 'Ankheeta Lath', 'ankheeta.lath@packfora.com', '+91 96649 73055', 'Marketing & Communications', 'http://localhost/packfora/packfora_admin/uploads/contact_files/4b9fffef24ed7ff9048fb921b8db1cf6.png', '1', '0000-00-00 00:00:00'),
(2, 'Brijesh Sounderrajan', 'brijesh.sounderrajan@packfora.com', '+91 98200 30019', 'Inquiries & Partnership Opportunities', 'http://localhost/packfora/packfora_admin/uploads/contact_files/3fe780451b98a2da6395602ee13d0df2.png', '1', '2025-05-28 13:37:00'),
(3, 'Prachi Balchandani', 'prachi.balchandani@packfora.com', '+91 77100 39221', 'Human Resources', 'http://localhost/packfora/packfora_admin/uploads/contact_files/51be35deee3b0381f019318020b317f5.png', '1', '2025-05-28 13:38:17'),
(4, 'Shweta Rao', 'contact@packfora.com', '+91 98338 51623', 'General Inquires', 'http://localhost/packfora/packfora_admin/uploads/contact_files/6c454591c8b2bc11cfbb7422d6e29e05.png', '1', '2025-05-28 13:39:37');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` bigint(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` longtext DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', 'NkYzS0ZCRkhhck9lazVyNUkxd0ljUT09', '2025-05-28 10:29:13', '2025-05-28 10:29:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `career_applications`
--
ALTER TABLE `career_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_inquiries`
--
ALTER TABLE `contact_inquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_requests`
--
ALTER TABLE `contact_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `current_opening`
--
ALTER TABLE `current_opening`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `our_clients`
--
ALTER TABLE `our_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_contact_us`
--
ALTER TABLE `tbl_contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `career_applications`
--
ALTER TABLE `career_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_inquiries`
--
ALTER TABLE `contact_inquiries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `contact_requests`
--
ALTER TABLE `contact_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `current_opening`
--
ALTER TABLE `current_opening`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `our_clients`
--
ALTER TABLE `our_clients`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_contact_us`
--
ALTER TABLE `tbl_contact_us`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
