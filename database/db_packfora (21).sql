-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2025 at 02:44 PM
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
(5, 'Gaurav ', 'test@gmail.vcom', '+9198765432', 'Sustainability', 'Test', '2025-04-24 17:44:00'),
(6, 'weeeeee', 'shirin@sda-zone.com', '+919000033444', 'Product Innovation', 'erre', '2025-06-24 09:35:48'),
(7, 'weeeeee', 'shirin@sda-zone.com', '+919000033444', 'Product Innovation', 'erre', '2025-06-24 09:35:58'),
(8, 'weeeeee', 'shirin@sda-zone.com', '+919000033444', 'Product Innovation', 'erre', '2025-06-24 09:36:14');

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
(1, 'Packaging Consultant', 'Lead Clients projects to deisgn suatainable packaging solutions.', 'Location: Remote | Full-Time', '1', '2025-05-28 05:38:08', '2025-06-23 11:27:06'),
(2, 'Sustainable Specialist', 'Advise clients on eco-friendly materials and circular economy strategies.', 'Location: New York, NY | Full-Time', '1', '2025-05-28 05:41:54', '2025-05-28 05:41:54'),
(3, 'Packaging', 'TEST', 'Onsite', '0', '2025-06-26 09:20:05', '2025-06-26 09:22:55');

-- --------------------------------------------------------

--
-- Table structure for table `our_clients`
--

CREATE TABLE `our_clients` (
  `id` bigint(20) NOT NULL,
  `image` longtext DEFAULT NULL,
  `is_delete` enum('1','0') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `show_on_homepage` enum('1','0') NOT NULL DEFAULT '0',
  `show_on_clients_page` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `our_clients`
--

INSERT INTO `our_clients` (`id`, `image`, `is_delete`, `created_at`, `updated_at`, `show_on_homepage`, `show_on_clients_page`) VALUES
(1, 'uploads/clients/abbott.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '', '1'),
(2, 'uploads/clients/aditya-birla-group.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '', '1'),
(3, 'uploads/clients/ag-poly-packs.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '0', '1'),
(4, 'uploads/clients/amazon.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '0', '1'),
(5, 'uploads/clients/amcor.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '0', '1'),
(6, 'uploads/clients/avery-dennison.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '0', '1'),
(7, 'uploads/clients/barry-callebaut.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '0', '1'),
(8, 'uploads/clients/bayer.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '1', '1'),
(9, 'uploads/clients/bcg.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '0', '1'),
(10, 'uploads/clients/brillon.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '0', '1'),
(11, 'uploads/clients/bw-unilever.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '0', '1'),
(12, 'uploads/clients/camlin.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '0', '1'),
(13, 'uploads/clients/colgate-palmolive.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '1', '1'),
(14, 'uploads/clients/danone.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '1', '1'),
(15, 'uploads/clients/diageo.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '1', '1'),
(16, 'uploads/clients/dole.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '1', '1'),
(17, 'uploads/clients/edgewell.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '0', '1'),
(18, 'uploads/clients/elida-beauty.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '0', '1'),
(19, 'uploads/clients/encube.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '0', '1'),
(20, 'uploads/clients/fairprice.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '1', '1'),
(21, 'uploads/clients/fertin.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '0', '1'),
(22, 'uploads/clients/gala.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '0', '1'),
(23, 'uploads/clients/glenmark.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '0', '1'),
(24, 'uploads/clients/godrej.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '1', '1'),
(25, 'uploads/clients/havi.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '1', '1'),
(26, 'uploads/clients/hector-beverages.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '0', '1'),
(27, 'uploads/clients/hershey.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '1', '1'),
(28, 'uploads/clients/indian-oil.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '0', '1'),
(29, 'uploads/clients/ITC.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '1', '1'),
(30, 'uploads/clients/itc-paspd.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '0', '1'),
(31, 'uploads/clients/itochu.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '0', '1'),
(32, 'uploads/clients/jt-mold.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '0', '1'),
(33, 'uploads/clients/jubilant-foodworks.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '0', '1'),
(34, 'uploads/clients/marico.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '1', '1'),
(35, 'uploads/clients/mc-nroe.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '0', '1'),
(36, 'uploads/clients/menasha.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '0', '1'),
(37, 'uploads/clients/mondelez.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '1', '1'),
(38, 'uploads/clients/nivea.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '0', '1'),
(39, 'uploads/clients/norton.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '0', '1'),
(40, 'uploads/clients/nykaa.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '0', '1'),
(41, 'uploads/clients/olam.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '0', '1'),
(42, 'uploads/clients/parekhplast.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '0', '1'),
(43, 'uploads/clients/pepsi.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '1', '1'),
(44, 'uploads/clients/pepsico.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '0', '1'),
(45, 'uploads/clients/pernod-ricard.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '0', '1'),
(46, 'uploads/clients/pidilite.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '0', '1'),
(47, 'uploads/clients/pitilip-morris-international.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '0', '1'),
(48, 'uploads/clients/polyplex.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '0', '1'),
(49, 'uploads/clients/pz-cussons.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '0', '1'),
(50, 'uploads/clients/raychem-RPG.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '1', '1'),
(51, 'uploads/clients/reckitt.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '0', '1'),
(52, 'uploads/clients/scjohnson.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '0', '1'),
(53, 'uploads/clients/sln-coffee.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '0', '1'),
(54, 'uploads/clients/solar.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '1', '1'),
(55, 'uploads/clients/switz.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '1', '1'),
(56, 'uploads/clients/takeda.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '0', '1'),
(57, 'uploads/clients/tata-motors.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '0', '1'),
(58, 'uploads/clients/tatat-consumer-products-limited.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '0', '1'),
(59, 'uploads/clients/ultratech-cement.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '0', '1'),
(60, 'uploads/clients/uma-global-foods.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '0', '1'),
(61, 'uploads/clients/unilever.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '1', '1'),
(62, 'uploads/clients/universal-robina.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '0', '1'),
(63, 'uploads/clients/wipro.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '0', '1'),
(64, 'uploads/clients/zespri.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '1', '1'),
(65, 'uploads/clients/zydus-wellness.svg', '1', '2025-07-16 14:32:11', '2025-07-16 14:32:11', '0', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_blogs`
--

CREATE TABLE `tbl_blogs` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `image` longtext DEFAULT NULL,
  `link` text DEFAULT NULL,
  `is_delete` enum('1','0') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_blogs`
--

INSERT INTO `tbl_blogs` (`id`, `title`, `description`, `image`, `link`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Late Varianting in Packaging: On-Demand Corrugate Printing for Agility and Sustainability', 'In recent conversations with both global FMCG firms and high-growth nutraceutical startups, one challenge keeps surfacing: packaging is lagging the rest of the supply chain.  Earlier this year, we worked with a client preparing to launch a personalized subscription product across multiple markets. Formulations were finalized; marketing was locked in—but a last-minute regulatory update required changes to their packaging artwork. Because the corrugate boxes were pre-printed weeks in advance, everything stalled. The delay cost them a high visibility launch window.  Scenarios like these highlight a deeper issue: traditional packaging workflows—planned early, printed in bulk, and forecasted far in advance—no longer align with today\'s market dynamics.', 'uploads/main-blog2.webp', NULL, '1', '2025-06-20 09:46:31', '2025-06-20 09:47:23'),
(2, 'Product Innovation', 'Leverage data-driven insights to accelerate go-to-market strategies and amplify packaging\'s role in brand growth.', 'uploads/product-innovation.webp', '#', '1', '2025-06-26 09:09:30', '2025-06-26 09:09:30'),
(3, 'Design to Value', 'Design cost-effective packaging solutions that align with evolving industry trends and consumer expectations.', 'uploads/design-to-value_(1).webp', 'design-to-value.php', '1', '2025-06-26 09:10:39', '2025-06-26 09:27:12'),
(4, 'Mold Management', 'Optimize production with advanced mold management, extending lifecycle value and minimizing costs.', 'uploads/mold-management.webp', '#', '1', '2025-06-26 09:11:03', '2025-06-26 09:11:03'),
(5, 'Packaging Innovation & Engineering', 'Pushing the boundaries of packaging with next-gen innovations—leveraging rapid prototyping.', 'uploads/packaging-innovation-engineering_(1).webp', 'packaging-innovation-and-engineering.php', '1', '2025-06-26 09:11:26', '2025-06-26 09:28:16');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_built_reliability`
--

CREATE TABLE `tbl_built_reliability` (
  `id` int(11) NOT NULL,
  `title` text DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `is_delete` enum('1','0') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_built_reliability`
--

INSERT INTO `tbl_built_reliability` (`id`, `title`, `description`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'MAX Availability', 'Fewer mold breakdowns = higher on-shelf availability and production continuity.', '1', '2025-06-20 10:29:50', '2025-06-20 10:34:37'),
(2, 'MAX Quality', 'Better mold performance delivers consistently high-quality output with fewer rejections.', '1', '2025-06-24 12:24:16', '2025-06-24 12:24:16'),
(3, 'MAX Life', 'Extend mold lifespan by 15%+ through proactive, data-led maintenance.', '1', '2025-06-24 12:24:31', '2025-06-24 12:24:31'),
(4, 'MAX Governance', 'Structured governance ensures transparency, traceability, and accountability.', '1', '2025-06-24 12:24:51', '2025-06-24 12:24:51'),
(5, 'MAX Value', '10%+ OPEX savings and 3-5X ROI through optimized maintenance and mold reuse.', '1', '2025-06-24 12:25:06', '2025-06-24 12:25:06'),
(6, 'MAX Circularity', 'Enable sustainable practices like part reuse, modular design, and smarter end-of-life decisions.', '1', '2025-06-24 12:25:22', '2025-06-24 12:25:22');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_case_study`
--

CREATE TABLE `tbl_case_study` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `badge` varchar(100) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `video` text DEFAULT NULL,
  `slug_url` varchar(255) DEFAULT NULL,
  `case_study_link` varchar(255) DEFAULT NULL,
  `publish_date` date DEFAULT NULL,
  `tag_id` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `is_delete` enum('1','0') NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `main_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_case_study`
--

INSERT INTO `tbl_case_study` (`id`, `title`, `description`, `badge`, `image`, `video`, `slug_url`, `case_study_link`, `publish_date`, `tag_id`, `is_active`, `is_delete`, `created_at`, `updated_at`, `main_image`) VALUES
(1, 'Packfora enabled a leading FMCG brand to cut costs by 30% while enhancing recyclability and sustainability.', 'We partnered with a $2.5B horticulture leader to design a packaging solution that did more than protect fruit-it built a habit. Inspired by the pillbox design, the 7-day fruit regimen pack helped consumers stay consistent, supported ESG goals, and moved from pilot to commercial rollout in just four months.', 'Foods', 'uploads/ebded142958539454267cff8f7c6dfcc.webp', 'uploads/2fa5bef0542f33d60dcb3db3bd27bd01.webm', 'case-study-inner', NULL, '2025-06-05', '8', 1, '1', '2025-07-04 16:57:13', '2025-07-14 23:26:46', 'uploads/case-study-01.webp'),
(2, 'How Packfora streamlined a major pharma company in their specification management.', 'When packaging specifications are scattered across geographies, platforms, and people - speed, accuracy, and compliance take a hit. A leading pharmaceutical company needed a better way to manage its packaging and finished goods specification, one that could support both day-to-day efficiency and long-term transformation. Packfora led an end-to-end specification management transformation to unlock clarity, compliance, and control across their packaging lifecycle.', 'Personal Care', 'uploads/c2a7476a5296f55c4223f8643ff34dcf.webp', 'uploads/3a7b8888d73669237167ca6b0277d686.webm', 'pharma-case-study', NULL, '2025-06-01', '3', 1, '1', '2025-07-04 17:06:52', '2025-07-14 23:27:31', 'uploads/case-study-02.webp'),
(3, 'Check out how Packfora reimagined packaging for a new 1.5L water bottle.', 'A global FMCG company wanted to launch a new bottled water SKU - but without relying on traditional shrink film-based collation. They needed a fresh approach to secondary packaging that could match performance, stay within cost limits, and meet sustainability targets. All without heavy capital investment.', 'Plastic Packaging', 'uploads/2415670eb7c53b1f68a61f8a7fc7cc7e.webp', 'uploads/4c0feca9fc75bf0ac3955d048b4353cc.webm', 'litre-bottle-case-study', NULL, '2025-05-28', '8', 1, '1', '2025-07-04 17:09:46', '2025-07-14 23:27:46', 'uploads/case-study-03.webp'),
(4, 'Smarter Packaging, Leaner Impact: Savings for a Global Foods Major', 'For a global foods major, we balanced cost, sustainability, and consumer convenience through smarter packaging choices. From material shifts to format rethinks, our work unlocked efficiency across the value chain.', '', 'uploads/07b000a1ea5c071af15b10dc81f05f95.webp', 'uploads/6d503940259624d9feb270a3d0d2cbe3.mp4', 'global-foods-major-savings', NULL, '2025-05-15', '2', 1, '1', '2025-07-04 17:52:31', '2025-07-14 04:52:37', 'uploads/53768837ab5e5e6ff27162528ad1dabe.webp'),
(5, 'Scaling Corrugate Wins: A US Productivity Roadmap in Action', 'In the US market, we partnered with a foods major to identify and execute corrugate packaging opportunities at scale. From design harmonization to inventory reduction, our roadmap delivered both savings and speed.', '', 'uploads/22f147407ca915a1f2f802d1965c91f8.webp', 'uploads/babb75a7834dc5e5faa86f3e0aa687e9.mp4', 'scaling-corrugate-wins-us-productivity-roadmap', NULL, '2025-05-05', '2', 1, '1', '2025-07-04 17:57:53', '2025-07-14 04:52:53', 'uploads/1161cf92a54abf621e38df856f123e9d.webp'),
(6, 'Reimagining Trust: 3D-Led Repositioning for a Nycil', 'We helped reposition a leading hygiene brand through a 3D visual concept that brought their germ-fighting edge to life. The goal? To shift perception and cement their authority in the category.', '', 'uploads/a06eabd88bbf57ad217ecd42e9aaabe6.webp', 'uploads/f178fb2bd78f295d9d96515d3d70bacb.mp4', '3d-led-repositioning-nycil', NULL, '2025-05-03', '2', 1, '1', '2025-07-04 17:58:26', '2025-07-14 04:53:05', 'uploads/dd59dbe82ac1561b41883cab42170946.webp'),
(7, 'Optimizing Sourcing: From Shared Service to Strategic', 'We helped transition packaging sourcing from a shared internal model in the UK and USA to a lean, cost-optimized third-party network. The result? Greater agility, transparency, and long-term savings', '', 'uploads/0358a7742b73fa8ca9b8dcff3b3ae4cc.webp', 'uploads/2e1416a1f02ff289d7cf0e96b7127670.mp4', 'optimizing-sourcing-from-shared-service-to-strategic', NULL, '2025-04-30', '8', 1, '1', '2025-07-04 18:00:36', '2025-07-14 04:54:16', 'uploads/679b8405798a827dafc1c6cb5af8549c.webp'),
(8, 'Demystifying Pharma Packaging: A Guide for Non-Packaging Teams', 'We created a comprehensive guide designed for non-packaging teams in a global pharma major helping drive cross-functional alignment and measurable packaging improvements.', '', 'uploads/4a6318883c5356ccd0b07652878764d0.webp', 'uploads/Comprehensive.mp4', 'demystifying-pharma-packaging-guide-non-packaging-teams', NULL, '2025-04-28', '8', 1, '1', '2025-07-04 18:01:21', '2025-07-15 05:16:00', 'uploads/173ec85b963174032481ab93acf7cb2a.webp'),
(9, 'Breaking Boundaries: Rigid Plastic Innovation in Action', 'We led a deep-dive design and engineering program to unlock innovation in complex rigid plastic formats. From structure to material science, we reimagined what was possible.', '', 'uploads/de0982f132e4e427b6ac87e946c4815f.webp', 'uploads/df577761184b46df8ba4644f39431556.mp4', 'breaking-boundaries-rigid-plastic-innovation', NULL, '2025-04-20', '8', 1, '1', '2025-07-04 18:01:49', '2025-07-14 04:54:26', 'uploads/f576305b0764d3fbc987ca0bb2092828.webp'),
(10, 'Rapid Prototyping, Real Results: In-House 3D for Pack Speed', 'By integrating in-house 3D printing and mold development, we helped streamline prototyping cycles and reduce lead times in packaging design. Faster decisions. Smarter execution.', '', 'uploads/f6948863a800803226c4fa2fb8c8254d.webp', 'uploads/62910e74c53ede6564af5b9e59bab765.mp4', 'rapid-prototyping-inhouse-3d-pack-speed', NULL, '2025-04-16', '8', 1, '1', '2025-07-04 18:03:02', '2025-07-14 04:54:34', 'uploads/3cf226ed24602a824765aebd085228cf.webp'),
(11, 'Engineering Simplicity: Reducing Cost & Complexity in Home Care', 'For a leading home cleaning brand, we engineered packaging that reduced cost and complexity without compromising performance. Structural redesigns and component optimization drove bottom-line gains.', '', 'uploads/3cb2d563fe4e61c1b729204cd36d9c58.webp', 'uploads/c5073d07b1bc5b5f04fe4f7ac4620d29.mp4', 'engineering-simplicity-cost-complexity-home-care', NULL, '2025-04-10', '8', 1, '1', '2025-07-04 18:03:59', '2025-07-14 04:54:43', 'uploads/deb6aceebcd546e1e581844c9d3347fc.webp'),
(12, 'Data-Driven Decisions: LCA for Smarter Beverage Packaging', 'We conducted a Life Cycle Assessment (LCA) comparing PET and glass bottles to help a global alcoholic beverage major make data-driven packaging decisions. The outcome? Clearer trade-offs, credible claims, and a roadmap for decarbonization.', '', 'uploads/5f6ba2b597ca0c4919ec8a72fa4dfc86.webp', 'uploads/46e25e2783679f7ddf2aa53023ea2362.mp4', 'data-driven-decisions-lca-beverage-packaging', NULL, '2025-04-05', '1', 1, '1', '2025-07-04 18:05:19', '2025-07-14 04:54:56', 'uploads/f22b48936af21066b3bfe058a6adf587.webp'),
(13, 'Showcasing What’s Next: Innovation Fair for a Global FMCG', 'We curated  an innovation fair for an FMCG major bringing cross-functional teams together to explore packaging-led opportunities. Prototypes, pilots, and possibilities, all in one place.', '', 'uploads/d71a17ff5907193c03e1bb98a04ab1c4.webp', NULL, 'pharma-case-study.php', NULL, '0000-00-00', '16', 1, '0', '2025-07-04 18:05:59', '2025-07-07 11:48:47', NULL),
(14, 'Showcasing Whats Next: Innovation Fair for a Global FMCG', 'We curated  an innovation fair for an FMCG major bringing cross-functional teams together to explore packaging-led opportunities. Prototypes, pilots, and possibilities, all in one place.', '', 'uploads/a7b47e711218a2e1de23f1980f527d21.webp', 'uploads/d2dd85d219df7e3f1745a3d48a412bcd.mp4', 'innovation-fair-global-fmcg', NULL, '2025-04-03', '1', 1, '1', '2025-07-04 18:11:05', '2025-07-14 04:57:46', 'uploads/d8f42d4ae4138e199611db20301c43cf.webp'),
(15, 'From Manual to Intelligent: Supply Chain Reinvention in FMCG', 'We partnered with a leading FMCG player to redesign and automate their packaging supply chain delivering faster turnaround, enhanced traceability, and cost resilience.', '', 'uploads/118dff581cd10ee4a004787d8953304a.webp', 'uploads/fbc0d24f26d6c7cf788822291b910e2c.mp4', 'supply-chain-reinvention-fmcg', NULL, '2025-04-01', '6', 1, '1', '2025-07-04 18:12:38', '2025-07-14 04:55:22', 'uploads/55f2d6ee8edca20b3c3f81bf69f492a6.webp'),
(16, 'Standardizing Speed: Packaging Ops for the QSR Ecosystem', 'For a global QSR supply partner, we streamlined mold management, global quality systems, and packaging specifications. The result? A harmonized ecosystem across geographies and functions.', '', 'uploads/7361fc702f64649128a26b3d00d5d087.webp', 'uploads/3743d6db53c0acf4053bd97763ebc3ea.mp4', 'standardizing-speed-packaging-qsr-ecosystem', NULL, '2025-03-31', '23', 1, '1', '2025-07-04 18:16:34', '2025-07-14 04:55:30', 'uploads/426cd5545a671ac623deb05a422387ef.webp'),
(17, 'End-to-End Enablement: Packaging Ops from Specs to Shelf', 'We helped accelerate packaging project management through integrated systems for specs, artworks, and lab testing. One framework, full visibility, faster execution.', '', 'uploads/34cdc1b901dfcaa537979b8bf6f99484.webp', 'uploads/865e8a4b27a9a70e16ac610465ca79d0.mp4', 'packaging-ops-specs-to-shelf', NULL, '2025-03-21', '23', 1, '1', '2025-07-04 18:22:07', '2025-07-14 04:55:38', 'uploads/4dcf79f7c086d04d73894b80e463bb6c.webp'),
(18, 'Predictive Packaging: Algorithm-Led Supply Chain Testing', 'We developed a protocol to test packaging solutions within an algorithm-driven framework giving our client data-led confidence before deployment.', '', 'uploads/18a5c0628705d78c927dfb74a936f73d.webp', 'uploads/45d183d32f5348dcc9b58ed1f72afbfe.mp4', 'predictive-packaging-algorithm-supply-chain', NULL, '2025-03-12', '19', 1, '1', '2025-07-04 18:23:37', '2025-07-17 11:18:29', 'uploads/892599029bf90ccf61c8eacdcf11b6a5.webp');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_case_study_business_impact`
--

CREATE TABLE `tbl_case_study_business_impact` (
  `id` int(11) NOT NULL,
  `case_study_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_delete` enum('1','0') NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_case_study_business_impact`
--

INSERT INTO `tbl_case_study_business_impact` (`id`, `case_study_id`, `title`, `description`, `image`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 1, 'Time to Market', 'From brief to shelf within 4 months', 'uploads/business_impact/1752209540_gradient-01.png', '1', '2025-07-10 16:38:22', '2025-07-11 10:24:38'),
(2, 1, 'Consumer Validation', '75% said the pack helped them remember to eat fruit daily', 'uploads/business_impact/gradient-02.png', '1', '2025-07-10 16:42:37', '2025-07-10 16:42:37'),
(3, 1, 'Scalability', 'Commercial rollout in Singapore, with more markets planned', 'uploads/business_impact/gradient-03.png', '1', '2025-07-10 16:43:06', '2025-07-10 16:43:06'),
(4, 2, 'Faster, More Confident Decision-Making', 'With structured, validated data, teams could move faster without second-guessing specs', 'uploads/business_impact/gradient-01_(1).png', '1', '2025-07-10 16:43:43', '2025-07-10 16:43:43'),
(5, 2, 'Simplified Global Collaboration', 'A unified process eliminated ambiguity and built consistency across sites and stakeholders', 'uploads/business_impact/gradient-02_(1).png', '1', '2025-07-10 16:44:23', '2025-07-10 16:44:23'),
(6, 2, 'A Stronger Foundation for the Future', 'The client is now better equipped to drive cost savings, meet sustainability targets, and handle regulatory shifts — with data that’s ready for it all', 'uploads/business_impact/gradient-03_(1).png', '1', '2025-07-10 16:45:51', '2025-07-10 16:45:51'),
(7, 3, 'Customer Satisfaction', 'Our approach validated the client\'s internal R&D work — boosting confidence that they were on the right path for scale-up', 'uploads/business_impact/gradient-01_(2).png', '1', '2025-07-10 16:46:28', '2025-07-10 16:46:28'),
(8, 3, 'Due Diligence', 'We evaluated over 15 viable formats and recommended the best-fit solution based on performance, feasibility, and sustainability', 'uploads/business_impact/gradient-02_(2).png', '1', '2025-07-10 16:47:08', '2025-07-10 16:48:01'),
(9, 3, 'Speed to Market', 'Delivered insights within tight timelines — keeping the program on track without operational delays', 'uploads/business_impact/gradient-03_(2).png', '1', '2025-07-10 16:48:35', '2025-07-11 10:34:34');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_case_study_objectives`
--

CREATE TABLE `tbl_case_study_objectives` (
  `id` int(11) NOT NULL,
  `fk_case_study_id` int(11) NOT NULL,
  `objective` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_delete` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_case_study_objectives`
--

INSERT INTO `tbl_case_study_objectives` (`id`, `fk_case_study_id`, `objective`, `image`, `is_active`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 1, 'To close the gap between public health recommendations and daily consumer behavior —through a packaging intervention that simplifies decision-making, builds structure, and drives consistent fruit intake.', 'uploads/7bd9b0042d7e1e8432bd2efc77bf2561.webp', 1, 1, '2025-07-07 14:27:26', '2025-07-07 16:11:09'),
(2, 2, 'To improve the quality and reliability of existing spec data across more than 20 global manufacturing sites while accelerating new product development, establishing unified governance, and enabling a smooth transition to the client’s new PLM platform.', 'uploads/8c0c1787668e3a1431e4a2049d34a93f.webp', 1, 1, '2025-07-07 14:38:15', NULL),
(3, 3, 'To eliminate reliance on shrink film in water collation through a packaging intervention that balances transit performance, cost efficiency, and carbon footprint without capital-intensive changes.', 'uploads/e2a4ee3f81680a8d7a3abf35883783aa.webp', 1, 1, '2025-07-07 14:39:30', '2025-07-07 16:06:37');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_case_study_solutions`
--

CREATE TABLE `tbl_case_study_solutions` (
  `id` int(11) NOT NULL,
  `fk_header_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_delete` enum('1','0') NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_case_study_solutions`
--

INSERT INTO `tbl_case_study_solutions` (`id`, `fk_header_id`, `title`, `description`, `image`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 1, 'Built for daily life', 'Fridge-fit, shelf-ready, and intuitive to use', 'uploads/solutions/1752139417_1951.png', '1', '2025-07-10 14:53:37', '2025-07-10 14:53:37'),
(2, 1, 'Sustainably made', '100% recyclable materials and vegetable-based ink', 'uploads/solutions/1752139417_6843.png', '1', '2025-07-10 14:53:37', '2025-07-10 14:53:37'),
(3, 1, 'Inclusive by design', 'Tactile cues for the visually impaired', 'uploads/solutions/1752139417_3544.png', '1', '2025-07-10 14:53:37', '2025-07-10 14:53:37'),
(4, 2, 'Data Quality & Validation Process', '<ul><li>Built a specialized 20+ member team of packaging and product SMEs — in under months.&nbsp;</li><li>Established global contact nodes across 20+ manufacturing sites.&nbsp;</li><li>Executed a maker-checker model to improve and validate data prior to PLM migration.</li></ul>', 'uploads/solutions/1752139731_7507.svg', '1', '2025-07-10 14:58:51', '2025-07-17 15:48:02'),
(5, 2, 'End-to-End Specification Management', '<ul><li>Took full accountability of specification creation in both legacy and new PLM systems.&nbsp;</li><li>Reduced turnaround time for new specs — especially for NPD programs.&nbsp;</li><li>Delivered structured reporting across regulatory, sustainability, and cost-saving metrics.</li></ul>', 'uploads/solutions/1752139731_3707.svg', '1', '2025-07-10 14:58:51', '2025-07-17 15:48:19'),
(6, 2, 'Global Data Governance for Change Management', '<ul><li>Designed one global process with harmonized specification protocols. </li><li>Defined minimum data requirements for spec accuracy across all regions. </li><li>Ensured alignment with compliance and regulatory standards.</li></ul>', 'uploads/solutions/1752139731_9295.svg', '1', '2025-07-10 14:58:51', '2025-07-17 18:13:38'),
(7, 3, 'Primary Packaging', '', 'uploads/solutions/1752139888_8590.svg', '1', '2025-07-10 15:01:28', '2025-07-10 15:01:28'),
(8, 3, 'Secondary Packaging', '', 'uploads/solutions/1752139888_6474.svg', '1', '2025-07-10 15:01:28', '2025-07-10 15:01:28'),
(9, 3, 'Integrated Primary + Secondary Systems', '', 'uploads/solutions/1752225199_integrated-primary.svg', '1', '2025-07-10 15:01:28', '2025-07-11 14:58:20');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_case_study_solution_header`
--

CREATE TABLE `tbl_case_study_solution_header` (
  `id` int(11) NOT NULL,
  `case_study_id` int(11) NOT NULL,
  `main_title` varchar(255) NOT NULL,
  `main_description` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_case_study_solution_header`
--

INSERT INTO `tbl_case_study_solution_header` (`id`, `case_study_id`, `main_title`, `main_description`, `created_at`, `updated_at`) VALUES
(1, 1, 'The Solution', 'We created a behavior-first packaging format that enables action, not just access. Rooted in real consumer behavior, the format made healthy choices easy, visible, and repeatable.', '2025-07-10 14:53:37', '2025-07-10 14:53:37'),
(2, 2, 'The Solution', 'We created a behavior-first packaging format that enables action, not just access. Rooted in real consumer behavior, the format made healthy choices easy, visible, and repeatable', '2025-07-10 14:58:51', '2025-07-10 14:58:51'),
(3, 3, 'The Solution', 'Packfora explored 15+ combinations of formats across three levels of intervention:', '2025-07-10 15:01:28', '2025-07-11 14:58:08');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_case_study_tags`
--

CREATE TABLE `tbl_case_study_tags` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `category` enum('featured','capability','industry') NOT NULL,
  `is_delete` enum('1','0') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_case_study_tags`
--

INSERT INTO `tbl_case_study_tags` (`id`, `name`, `category`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Sustainability', 'featured', '1', '2025-07-05 10:23:21', '2025-07-05 10:23:21'),
(2, 'Design-to-Value', 'featured', '1', '2025-07-05 10:23:21', '2025-07-05 10:23:21'),
(3, 'Specification Management', 'capability', '1', '2025-07-05 10:23:21', '2025-07-05 10:23:21'),
(4, 'MaxMold', 'capability', '1', '2025-07-05 10:23:21', '2025-07-05 10:23:21'),
(5, 'Simulation & Modeling', 'capability', '1', '2025-07-05 10:23:21', '2025-07-05 10:23:21'),
(6, 'Supply Chain Optimization', 'capability', '1', '2025-07-05 10:23:21', '2025-07-05 10:23:21'),
(7, 'Procurement & Cost Reduction', 'capability', '1', '2025-07-05 10:23:21', '2025-07-05 10:23:21'),
(8, 'Packaging Design & Engineering', 'capability', '1', '2025-07-05 10:23:21', '2025-07-05 10:23:21'),
(9, 'Sustainability & Carbon Reduction', 'capability', '0', '2025-07-05 10:23:21', '2025-07-11 10:26:13'),
(10, 'Global-to-Local Harmonization', 'capability', '1', '2025-07-05 10:23:21', '2025-07-05 10:23:21'),
(11, 'Digital Transformation in Packaging', 'capability', '1', '2025-07-05 10:23:21', '2025-07-05 10:23:21'),
(12, 'Pack Format Innovation', 'capability', '1', '2025-07-05 10:23:21', '2025-07-05 10:23:21'),
(13, 'Pharmaceuticals', 'industry', '1', '2025-07-05 10:23:21', '2025-07-05 10:23:21'),
(14, 'Food & Beverage', 'industry', '1', '2025-07-05 10:23:21', '2025-07-05 10:23:21'),
(15, 'Personal Care & Cosmetics', 'industry', '1', '2025-07-05 10:23:21', '2025-07-05 10:23:21'),
(16, 'FMCG & CPG', 'industry', '1', '2025-07-05 10:23:21', '2025-07-05 10:23:21'),
(17, 'Automotive', 'industry', '1', '2025-07-05 10:23:21', '2025-07-05 10:23:21'),
(18, 'Chemicals & Explosives', 'industry', '1', '2025-07-05 10:23:21', '2025-07-05 10:23:21'),
(19, 'Packaging Producers', 'industry', '1', '2025-07-05 10:23:21', '2025-07-05 10:23:21'),
(20, 'B2B Industrial', 'industry', '1', '2025-07-05 10:23:21', '2025-07-05 10:23:21'),
(21, 'Healthcare Devices', 'industry', '1', '2025-07-05 10:23:21', '2025-07-05 10:23:21'),
(22, 'Retail & E-commerce', 'industry', '1', '2025-07-05 10:23:21', '2025-07-05 10:32:39'),
(23, 'Talent Flex', 'featured', '1', '2025-07-14 15:29:54', '2025-07-14 15:29:54');

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
(1, 'Ankheeta Lath', 'ankheeta.lath@packfora.com', '+91 96649 73055', 'Marketing & Communications', 'uploads/contact_files/4b9fffef24ed7ff9048fb921b8db1cf6.png', '1', '0000-00-00 00:00:00'),
(2, 'Brijesh Sounderrajan', 'brijesh.sounderrajan@packfora.com', '+91 98200 30019', 'Inquiries & Partnership Opportunities', 'uploads/contact_files/3fe780451b98a2da6395602ee13d0df2.png', '1', '2025-05-28 13:37:00'),
(3, 'Prachi Balchandani', 'prachi.balchandani@packfora.com', '+91 77100 39221', 'Human Resources', 'uploads/contact_files/51be35deee3b0381f019318020b317f5.png', '1', '2025-05-28 13:38:17'),
(4, 'Shweta Rao', 'contact@packfora.com', '+91 98338 51623', 'General Inquires', 'uploads/contact_files/6c454591c8b2bc11cfbb7422d6e29e05.png', '1', '2025-05-28 13:39:37');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_discover_benefits`
--

CREATE TABLE `tbl_discover_benefits` (
  `id` bigint(20) NOT NULL,
  `fk_service_id` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` longtext DEFAULT NULL,
  `is_delete` enum('1','0') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_discover_benefits`
--

INSERT INTO `tbl_discover_benefits` (`id`, `fk_service_id`, `title`, `description`, `image`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 1, 'Tailored Expertise', 'For FMCG, QSR, Pharma & Retail packaging needs', 'uploads/tailored-expertise.png', '1', '2025-06-04 14:46:51', '2025-06-06 10:49:24'),
(2, 1, 'Global Coverage', 'Across time zones for continuous execution', 'uploads/global-coverage.png', '1', '2025-06-04 14:47:26', '2025-06-06 10:49:27'),
(3, 1, 'Scalability', 'To address spike and slumps in resource demand.', 'uploads/scalability.png', '1', '2025-06-04 14:47:58', '2025-06-06 10:49:29'),
(4, 1, 'Deploy Talent Faster', 'With our pre-vetted specialists', 'uploads/deploy-talent-faster.png', '1', '2025-06-04 14:49:39', '2025-06-06 10:49:31'),
(5, 3, 'Increased Efficiency', 'Automation minimizes manual tasks, improving speed and accuracy.', 'uploads/increased-efficiency.png', '1', '2025-06-06 10:47:50', '2025-06-06 10:49:35'),
(6, 3, 'Optimization', 'Optimized resource use lowers operational costs.', 'uploads/optimization.png', '1', '2025-06-06 10:50:19', '2025-06-06 10:50:19'),
(7, 3, 'Enhanced Quality', 'Automated systems reduce human error in tracking and inventory management.', 'uploads/enhanced-quality.png', '1', '2025-06-06 10:51:31', '2025-06-06 10:53:39'),
(8, 3, 'Real-Time Process Visualization', 'Gain instant access to insights for better decision-making.', 'uploads/real-time-process-visualization.png', '1', '2025-06-06 10:52:00', '2025-06-06 10:52:00'),
(9, 3, 'Scalability', 'Expand operations efficiently without increasing labour costs.', 'uploads/scalability_(1).png', '1', '2025-06-06 10:52:29', '2025-06-06 10:52:29'),
(10, 3, 'Supply Chain Resilience', 'Improved adaptability to market shifts and disruptions.', 'uploads/supply-chain-resilience.png', '1', '2025-06-06 10:52:58', '2025-06-06 10:54:35'),
(11, 5, 'Strategic Value Driver Model', 'Our proprietary DTV framework maximizes value by addressing material efficiency, technological advancements, and procurement strategies-all in one holistic solution.', 'uploads/strategic-value-driver-model.png', '1', '2025-06-10 09:13:04', '2025-06-13 09:06:31'),
(12, 5, 'People, Planet & Profit', 'Sustainability is at the core of our process. By balancing economic, environmental, and consumer needs, we help brands achieve triple-bottom-line impact.', 'uploads/people-planet-profit.png', '1', '2025-06-10 12:38:10', '2025-06-10 12:38:10'),
(13, 5, 'End-to-End Optimization', 'From concept to commercialization, we ensure every element of packaging is designed for efficiency, sustainability, and long-term success.', 'uploads/end-to-end-optimization.png', '1', '2025-06-10 12:38:40', '2025-06-26 17:12:19'),
(14, 7, 'Sustainability-Driven', 'Optimize materials, reduce waste, and lower carbon footprint.', 'uploads/sustainability-driven.png', '1', '2025-06-16 11:45:17', '2025-06-16 11:46:41'),
(15, 8, 'Build a Strong Foundationeeeeeeeeee', 'Rapid Sourcing & Tail Spend Management Supplier Lifecycle Management', 'uploads/build-a-strong-foundation.png', '1', '2025-06-16 14:29:55', '2025-06-16 14:35:44'),
(16, 7, 'End-to-End Solutions', 'From concept to commercialization, ensuring efficiency at every step.', 'uploads/end-to-end-solutions.png', '1', '2025-06-27 11:43:31', '2025-06-27 11:43:31'),
(17, 7, 'Cost-Effective Innovation', 'Smarter designs that drive cost savings without compromising quality.', 'uploads/cost-effective-innovation.png', '1', '2025-06-27 11:44:05', '2025-06-27 11:44:05'),
(18, 7, 'Industry-Specific Customization', 'Tailored solutions for FMCG, Pharma, Automotive, and more.', 'uploads/industry-specific-customization.png', '1', '2025-06-27 11:45:07', '2025-06-27 11:45:07'),
(19, 7, 'Speed & Agility', 'Rapid prototyping and AI-powered processes to reduce time-to-market.', 'uploads/speed-and-agility.png', '1', '2025-06-27 11:45:36', '2025-06-27 11:45:36'),
(20, 7, 'Digital Precision', 'AI, VR, and automation ensure accuracy in design and execution.', 'uploads/digital-precision.png', '1', '2025-06-27 11:46:39', '2025-06-27 11:46:39'),
(21, 9, 'Aligns specifications across regions and teams', NULL, 'uploads/aligns-specifications.svg', '1', '2025-07-01 14:00:10', '2025-07-01 14:00:10'),
(22, 9, 'Enables rapid packaging changes and new product launches', NULL, 'uploads/enables-rapid-packaging.svg', '1', '2025-07-01 14:00:35', '2025-07-01 14:00:35'),
(23, 9, 'Reduces errors & change redundancy', NULL, 'uploads/reduces-errors.svg', '1', '2025-07-01 14:01:25', '2025-07-01 14:01:25'),
(24, 9, 'Better inventory management & reduce material wastage', NULL, 'uploads/better-inventory.svg', '1', '2025-07-01 14:02:00', '2025-07-01 14:02:00'),
(25, 9, 'Conforms to regulatory and sustainability reporting frameworks', NULL, 'uploads/confirms-to-regulatory.svg', '1', '2025-07-01 14:02:22', '2025-07-01 14:02:22'),
(26, 9, 'Builds strong foundation for future digitization and AI tools', NULL, 'uploads/builds-strong-foundation.svg', '1', '2025-07-01 14:03:08', '2025-07-01 14:03:08');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_event_slider`
--

CREATE TABLE `tbl_event_slider` (
  `id` bigint(20) NOT NULL,
  `image` longtext DEFAULT NULL,
  `is_delete` enum('1','0') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_event_slider`
--

INSERT INTO `tbl_event_slider` (`id`, `image`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'uploads/packforum_01.webp', '1', '2025-06-03 11:15:46', '2025-06-03 11:15:46'),
(2, 'uploads/packforum-02.webp', '1', '2025-06-03 11:19:14', '2025-06-03 11:19:14'),
(3, 'uploads/packforum-03.webp', '1', '2025-06-03 11:19:20', '2025-06-03 11:19:20'),
(4, 'uploads/packforum-04.webp', '1', '2025-06-03 11:19:38', '2025-06-03 11:19:38'),
(5, 'uploads/packforum-05.webp', '1', '2025-06-03 11:19:43', '2025-06-03 11:19:43'),
(6, 'uploads/packforum-06.webp', '1', '2025-06-03 11:19:48', '2025-06-03 11:19:48'),
(7, 'uploads/packforum-07.webp', '1', '2025-06-03 11:19:56', '2025-06-03 11:19:56'),
(8, 'uploads/packforum-08.webp', '1', '2025-06-03 11:20:05', '2025-06-03 11:20:05'),
(9, 'uploads/packforum-09.webp', '1', '2025-06-03 11:25:23', '2025-06-03 11:25:23'),
(10, 'uploads/packforum-10.webp', '1', '2025-06-03 11:25:30', '2025-06-03 11:32:18'),
(11, 'uploads/packforum-11.webp', '1', '2025-06-03 12:09:30', '2025-06-03 12:09:30'),
(12, 'uploads/packforum-12.webp', '1', '2025-06-03 12:09:35', '2025-06-03 12:09:35');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_featured_speakers`
--

CREATE TABLE `tbl_featured_speakers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `designation` varchar(100) DEFAULT NULL,
  `quote_text` text NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `is_delete` enum('1','0') NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_featured_speakers`
--

INSERT INTO `tbl_featured_speakers` (`id`, `name`, `designation`, `quote_text`, `image_path`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Ramaiah Muthusubramanian', 'CEO Packfora', 'Smart packaging can be the first moment of truth.', 'uploads/ramaiah.webp', '1', '2025-06-03 14:55:56', '2025-06-03 14:55:56'),
(2, 'Kory Nook', 'Danone', 'Carbon is the new currency.', 'uploads/kory.webp', '1', '2025-06-03 14:57:31', '2025-06-03 14:57:31'),
(3, 'Brett Domoy', 'Unilever', 'Inclusive design starts at the brief.', 'uploads/brett.webp', '1', '2025-06-03 14:58:49', '2025-06-03 14:58:49'),
(4, 'Abhay Bhagwat', 'ZBD Expert', 'Design must unite science, brand, and insight.', 'uploads/abhay.webp', '1', '2025-06-03 15:00:09', '2025-06-03 15:45:44');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_global_culture`
--

CREATE TABLE `tbl_global_culture` (
  `id` bigint(20) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `image` longtext DEFAULT NULL,
  `is_delete` enum('1','0') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_global_culture`
--

INSERT INTO `tbl_global_culture` (`id`, `title`, `description`, `image`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Clientele', 'Trusted by brands across continents', 'uploads/clientele.png', '1', '2025-06-02 11:58:54', '2025-06-02 11:58:54'),
(2, 'Projects', 'International in spirit, even when local in scope', 'uploads/projects.png', '1', '2025-06-02 12:20:41', '2025-06-02 12:20:41'),
(3, 'Culture', 'Diverse, inclusive, and deeply collaborative', 'uploads/culture.png', '1', '2025-06-02 12:21:10', '2025-06-26 14:22:33');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_global_dialogue`
--

CREATE TABLE `tbl_global_dialogue` (
  `id` bigint(20) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_delete` enum('1','0') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_global_dialogue`
--

INSERT INTO `tbl_global_dialogue` (`id`, `title`, `description`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, '18 +', 'Participating Companies', '1', '2025-06-03 11:57:06', '2025-06-03 12:03:15'),
(2, '$500B', 'in combined company revenue', '1', '2025-06-03 12:03:28', '2025-06-03 12:03:28'),
(3, '$30B', 'in collective packaging spend', '1', '2025-06-03 12:03:43', '2025-06-03 12:03:43');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_holistic_model_levers`
--

CREATE TABLE `tbl_holistic_model_levers` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `is_delete` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_holistic_model_levers`
--

INSERT INTO `tbl_holistic_model_levers` (`id`, `title`, `is_active`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Reduce waste and system complexity', 1, 1, '2025-07-07 14:56:06', '2025-07-08 12:12:56'),
(2, 'Replace outdated specs and materials', 1, 1, '2025-07-07 14:56:06', '2025-07-08 12:12:56'),
(3, 'Redesign for right-sizing and resource efficiency', 1, 1, '2025-07-07 14:56:06', '2025-07-08 12:12:56'),
(4, 'Optimize procurement with cost, supply, and market intelligence', 1, 1, '2025-07-07 14:56:06', '2025-07-08 12:12:56');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_holistic_model_sections`
--

CREATE TABLE `tbl_holistic_model_sections` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `is_delete` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_holistic_model_sections`
--

INSERT INTO `tbl_holistic_model_sections` (`id`, `title`, `description`, `is_active`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Holistic Value Model', 'A proven framework for business impact today and tomorrow. We apply a proprietary model that shows where value lies and how to unlock it across cost, compliance, and competitiveness.', 1, 1, '2025-07-07 14:56:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_holistic_model_strategies`
--

CREATE TABLE `tbl_holistic_model_strategies` (
  `id` int(11) NOT NULL,
  `section_type` enum('Technology','Procurement') NOT NULL,
  `pillar` varchar(100) DEFAULT NULL,
  `items` text DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `is_delete` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_holistic_model_strategies`
--

INSERT INTO `tbl_holistic_model_strategies` (`id`, `section_type`, `pillar`, `items`, `is_active`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Technology', 'Reduce', 'Waste, Complexity Reduction', 1, 1, '2025-07-07 14:56:05', '2025-07-08 12:12:56'),
(2, 'Technology', 'Replace', 'Technology, Materials', 1, 1, '2025-07-07 14:56:05', '2025-07-08 12:12:56'),
(3, 'Technology', 'Redesign', 'Specification, Right Sizing', 1, 1, '2025-07-07 14:56:05', '2025-07-08 12:12:56'),
(4, 'Procurement', 'Supplier Strategy', 'Periodical Review, Market Intelligence', 1, 1, '2025-07-07 14:56:05', '2025-07-08 12:12:56'),
(5, 'Procurement', 'Should Cost', 'Periodical Review, Market Intelligence', 1, 1, '2025-07-07 14:56:05', '2025-07-08 12:12:56'),
(6, 'Procurement', 'Future Proofing', 'Periodical Review, Market Intelligence', 1, 1, '2025-07-07 14:56:06', '2025-07-08 12:12:56');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_how_we_do_it`
--

CREATE TABLE `tbl_how_we_do_it` (
  `id` bigint(20) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `image` longtext DEFAULT NULL,
  `is_delete` enum('1','0') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_how_we_do_it`
--

INSERT INTO `tbl_how_we_do_it` (`id`, `title`, `description`, `image`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Triple Bottom Line Approach', 'We integrate People, Planet and Profit into every packaging solution. Balancing impact and profitability.', 'uploads/we-do-01.png', '1', '2025-06-17 09:29:11', '2025-07-02 10:59:56'),
(2, 'End-to-End Value Chain', 'From packaging ideation to execution, our strategies seamlessly integrate into your operations, ensuring efficiency & compliance.', 'uploads/we-do-02.png', '1', '2025-06-17 09:50:54', '2025-07-02 10:24:00'),
(3, 'Digitization & Innovation', 'We leverage AI, automation, and real-time data to ensure efficient, innovative, and sustainable packaging solutions that benefit your business, our team, and the planet.', 'uploads/we-do-03.png', '1', '2025-06-17 09:51:21', '2025-07-02 10:25:18');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_impact_boxes`
--

CREATE TABLE `tbl_impact_boxes` (
  `id` int(11) NOT NULL,
  `front_heading` varchar(150) NOT NULL,
  `front_value` varchar(100) NOT NULL,
  `back_description` text NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `image` longtext DEFAULT NULL,
  `is_delete` enum('1','0') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_impact_boxes`
--

INSERT INTO `tbl_impact_boxes` (`id`, `front_heading`, `front_value`, `back_description`, `link`, `image`, `is_delete`, `created_at`) VALUES
(1, 'Collective Expertise', '1000+ Years', 'Delivering industry expertise and strategic innovation to solve every packaging challenge.', 'https://sda.in.net/web/packfora/final/about-us.php', 'uploads/collective-expertise3.webp', '1', '2025-06-20 09:15:20'),
(2, 'Unmatched Packaging with', '140+ Experts', 'Innovating packaging solutions that drive efficiency, sustainability, and market leadership.', 'https://sda.in.net/web/packfora/final/why-packfora.php', 'uploads/unmatched-packaging.webp', '1', '2025-06-23 04:00:48'),
(3, 'Successfully delivered client projects across', '21+  Countries', 'Empowering global brands to achieve scalable,future-proof packaging success.', 'https://sda.in.net/web/packfora/final/why-packfora.php', 'uploads/successfully-delivered.webp', '1', '2025-06-23 04:03:54'),
(4, 'Client Satisfaction', '70+ Clients', 'Committed to a customer-first approach, delivering trust, innovation, and brand excellence.', 'https://sda.in.net/web/packfora/final/why-packfora.php', 'uploads/client-satisfaction.jpg', '1', '2025-06-23 04:05:13');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_impact_enabled`
--

CREATE TABLE `tbl_impact_enabled` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `is_delete` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_impact_enabled`
--

INSERT INTO `tbl_impact_enabled` (`id`, `image`, `description`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'uploads/impact-enabled-012.svg', 'Backed by advanced capabilities — simulation, value engineering, end-to-end value chain intelligence', 1, '2025-07-02 13:55:51', '2025-07-02 13:55:51'),
(2, 'uploads/impact-enabled-02.svg', 'Powered by a multi-disciplinary pool of experts — across packaging design, development, supply chain, procurement, and sustainability', 1, '2025-07-02 13:56:20', '2025-07-02 13:56:20'),
(3, 'uploads/impact-enabled-03.svg', 'Guided by a system-wide lens — where packaging is treated not as a cost or constraint, but as a strategic lever', 1, '2025-07-02 13:56:39', '2025-07-02 13:56:39');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_impact_sections`
--

CREATE TABLE `tbl_impact_sections` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `heading` varchar(100) NOT NULL,
  `sub_text` varchar(255) DEFAULT NULL,
  `value1_title` varchar(100) DEFAULT NULL,
  `value1_description` varchar(150) DEFAULT NULL,
  `value2_title` varchar(100) DEFAULT NULL,
  `value2_description` varchar(150) DEFAULT NULL,
  `is_delete` enum('1','0') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_impact_sections`
--

INSERT INTO `tbl_impact_sections` (`id`, `image`, `heading`, `sub_text`, `value1_title`, `value1_description`, `value2_title`, `value2_description`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'uploads/people_(1).webp', 'People', 'Powering Brands, Driving Innovation', '5Bn.US$', 'Brand Value Covered', '12', 'Innovations Delivered', '1', '2025-06-18 06:54:46', '2025-06-23 11:34:36'),
(2, 'uploads/planet_(1).webp', 'Planet', 'Built for Sustainability, Engineered for Impact', '100KT.', 'Carbon Reduction', '52KT.', 'Material Reduction', '1', '2025-06-18 08:20:22', '2025-06-23 11:34:45'),
(3, 'uploads/profits_(1).webp', 'Profit', 'Smarter Spend, Bigger Gains', '2.5Bn.US$', 'Spend Covered', '500-1000BPS', 'Savings Delivered', '1', '2025-06-23 06:06:16', '2025-06-23 11:36:16');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_knowledge_centre`
--

CREATE TABLE `tbl_knowledge_centre` (
  `id` bigint(20) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `image` longtext DEFAULT NULL,
  `is_delete` enum('1','0') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_knowledge_centre`
--

INSERT INTO `tbl_knowledge_centre` (`id`, `title`, `date`, `image`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Late Varianting in Packaging: On-Demand Corrugate Printing for Agility and Sustainability', '2025-06-13', 'uploads/blog1.webp', '1', '2025-06-17 15:14:41', '2025-07-02 16:29:29'),
(2, 'Navigating PPWR 2025/40: Lessons from the Frontlines of Packaging Compliance', '2025-05-08', 'uploads/blog25.webp', '1', '2025-07-02 16:29:10', '2025-07-02 16:31:18'),
(3, '8 Packaging Trends That Will Shape the Future:                               Sustainability, Innovat', '2025-06-03', 'uploads/blog3.webp', '1', '2025-07-02 16:30:27', '2025-07-02 16:30:27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_leadership_team`
--

CREATE TABLE `tbl_leadership_team` (
  `id` bigint(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `designation` varchar(100) DEFAULT NULL,
  `link` text DEFAULT NULL,
  `image` longtext DEFAULT NULL,
  `is_delete` enum('1','0') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_leadership_team`
--

INSERT INTO `tbl_leadership_team` (`id`, `name`, `description`, `designation`, `link`, `image`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Ramaiah Muthusubramanian', 'Ramaiah Muthusubramanian, widely known as Muthu, is a global packaging leader with over 30 years of experience in Packaging R&D, Supply Chain Technology, and Procurement. Before co-founding Packfora, he held senior leadership roles at Unilever, where he served as Global Packaging Director for Laundry and Program Director for Sustainable Flexible Packaging.At Unilever, Muthu played a key role in embedding sustainability into the packaging agenda, fostering partnerships across geographies, and spearheading initiatives that influenced policy and industry benchmarks. He championed cross-cultural collaboration, leading global teams across Europe, Asia, and Latin America to drive design thinking, lifecycle innovation, and consumer-centric packaging solutions. His work was pivotal in creating scalable systems that supported Unilever’s commitment to reduce plastic waste and promote circularity.Muthu holds a Master’s Diploma in Packaging Technology from IIP Mumbai and a B.Sc. in Mathematics from Madura College. Known for his value @ velocity mindset, he has led high-impact, cross-functional teams to deliver award-winning, sustainable innovations.As CEO at Packfora, he advocates for an ecosystem-driven approach, combining expertise and collaboration to deliver end-to-end solutions. He is passionate about future-proofing capabilities and driving circular, consumer-centric packaging strategies.', 'CEO', 'https://www.linkedin.com/in/ramaiah-muthusubramanian-9406902/?originalSubdomain=in', 'uploads/ramaiah-muthusubramanian.png', '1', '2025-07-01 16:12:02', '2025-07-02 10:07:46'),
(2, 'Hitesh Shenoy', 'Hitesh Shenoy is a seasoned global packaging leader with over 25 years of cross-functional experience spanning packaging innovation, sustainability, value engineering, and supply chain enablement. He has held senior leadership roles at Unilever and GSK Consumer Healthcare, where he led complex, multi-market programs focused on compliance, digital transformation, and consumer-centric design. As former Senior Director – Global Technical Packaging at GSK, he drove strategic initiatives such as child-resistant/senior-friendly packaging and global digital specification systems.Currently Vice President at Packfora, Hitesh leads the Food and Pharmaceutical Packaging vertical, partnering with multinational clients to deliver sustainable and regulatory-compliant packaging solutions. He is a passionate advocate for packaging as a driver of both business value and environmental stewardship, with a keen focus on flexible packaging and circularity.', 'VP & BU Lead - Growth - Foods & Pharma', 'https://www.linkedin.com/in/hitesh-shenoy-2a84492/?originalSubdomain=sg&original_referer=http%3A%2F%2F148.72.26.123%2F', 'uploads/hitesh-shinoy.webp', '1', '2025-07-01 16:12:02', '2025-07-02 10:08:16'),
(3, 'Jikul Purohit', 'Jikul Purohit is a passionate packaging innovation and sustainability leader with over 17 years of cross-functional experience in R&D, product development, and value engineering. Based in London, UK, Jikul manages multi-country teams and brings a truly global perspective to his work. Before co-founding Packfora, he held several key roles at Unilever, where he led global and regional packaging projects across categories like Laundry, Skin Cleansing, and Beverages.He holds a Post Graduate Diploma in Packaging from the Indian Institute of Packaging, Mumbai, and an engineering degree in Electronics from the University of Mumbai.At Packfora, Jikul leads technology and innovation efforts, driving sustainable, future-ready solutions for clients in food, FMCG, and pharma sectors. His expertise lies in flexible packaging, circularity, and regulatory-compliant design systems that deliver impact at scale.', 'VP & BU Lead - Delivery - Foods & Pharma', 'https://www.linkedin.com/authwall?trk=gf&trkInfo=AQE2hM3m7ADyHwAAAZfJbbZgnFGZmzOHy6levxjJnF02Ntcp3eHrfbvbDdz4M0alrW8PVzdluzztygGdTc1DU_lJy0ovZ2C439at4uaI6Un5bfwE735N5EkPHxitPBvZYAAJ-sc=&original_referer=http://148.72.26.123/&sessionRedirect=https%3A%2F%2Fwww.linkedin.com%2Fin%2Fjikul-purohit-6532526%2F%3ForiginalSubdomain%3Duk', 'uploads/jikul-purohit.webp', '1', '2025-07-01 16:12:02', '2025-07-02 10:08:36'),
(4, 'Chirag Master', 'Chirag Master is a seasoned packaging leader with over 18 years of global experience in packaging design, development, procurement, and supply chain across personal care categories. Prior to co-founding Packfora, Chirag had a successful career at Unilever, with assignments in India, Thailand, and the UK.His expertise spans innovation project management, sourcing digitization, and end-to-end packaging development, from concept to shelf. He holds a degree in Chemical Engineering and a Post Graduate Diploma in Packaging Science and Technology from SIES School of Packaging.At Packfora, Chirag leads the Home, Personal Care, and Oral Care vertical, driving sustainable, consumer-centric solutions with a deep understanding of packaging materials, device development, and global innovation delivery.', 'VP & BU Lead - Growth, Delivery - SHPCO, Talent Flex, & Mold Management Services', 'https://www.linkedin.com/authwall?trk=gf&trkInfo=AQEVl5d0ALx5vQAAAZfJbgCYAS7dhU70V4YaigGNubWK7G1hEwYvzvi2QtwPGRtfAZTf8kC1cDb0Ydt89fWzOQpEy-qBVtdmJ2pAmygEx5_Z8Myn9-Yce2IglkKVOAsWwron3oQ=&original_referer=http://148.72.26.123/&sessionRedirect=https%3A%2F%2Fwww.linkedin.com%2Fin%2Fchirag-master-54364bb%2F%3ForiginalSubdomain%3Din', 'uploads/chirag-master.webp', '1', '2025-07-01 16:12:02', '2025-07-02 10:08:59'),
(5, 'Tom Oravez', 'Tom Oravez is a seasoned packaging innovation leader with over 20 years of experience driving packaging strategy, product innovation, and sustainable growth across major food companies. At Packfora, he leads the U.S. team and supports client initiatives across the America. He has held leadership roles in R&D and Supply Chain at General Mills, Conagra Brands, Pinnacle Foods, Mars, and Kraft Foods. His core strengths include Packaging Strategy & Development, Supply Chain Optimization, Productivity Programs, Technical Risk Management, and End-to-End Innovation Execution.He brings deep expertise in a wide range of packaging technologies from flexibles and cartons to cans, cups, bottles, glass, and corrugates and has a proven track record of building and guiding high-performing teams that deliver impactful innovation and renovation. Tom holds a B.S. in Packaging from Rutgers College of Engineering.He is passionate about talent development and driving cross-functional collaboration to create consumer-centric, sustainable packaging solutions. Based in New Jersey, Tom enjoys playing sports, camping, and traveling in his free time.', 'Food, Pharma & CHC', 'https://www.linkedin.com/in/tom-oravez/', 'uploads/tom-oravez.webp', '1', '2025-07-01 16:12:02', '2025-07-02 10:09:13'),
(6, 'Prashant Sukhtankar', 'Prashant Sukhtankar is a Foods, Pharma & CHC', 'Foods, Pharma & CHC', 'https://www.linkedin.com/authwall?trk=gf&trkInfo=AQEXciLbvEuN-QAAAZfJbqiQC-dkX6u07Psy-pHoHsZeQPNsAzw2IFHsTPZzj94m2w1l-FkJcpXnzD1eKOqEd4_JMjQzy5k6yJeatFeAG0WZdGZgBOcZJ2uvoGnBEXzAFJuojw8=&original_referer=https://www.linkedin.com/in/prashant-sukhtankar-70a90a18/?originalSubdomain=in&sessionRedirect=https%3A%2F%2Fwww.linkedin.com%2Fin%2Fprashant-sukhtankar-70a90a18%2F%3ForiginalSubdomain%3Din%26original_referer%3Dhttp%253A%252F%252F148.72.26.123%252F', 'uploads/prashant-sukhtankar.webp', '1', '2025-07-01 16:14:00', '2025-07-02 10:09:36'),
(7, 'Ankita Lokhande', 'Ankita Lokhande is a seasoned packaging leader with 14+ years of experience across the personal care, food & beverage, and FMCG industries. At Packfora, she drives global sustainability programs, design-to-value initiatives, capability building, and innovation for leading multinationals. She brings deep expertise in consumer-centric design, technical packaging development, and circular solutions with a proven ability to align functional performance with sustainability goals.Ankita partners with brand teams, industry alliances, and supply chain players to deliver high-impact packaging transformation. She holds a degree in Packaging Technology and is widely recognized for her thought leadership in sustainable packaging and innovation. Beyond work, she enjoys exploring interior design and creating functional, aesthetic living spaces.', 'Foods, Pharma & CHC', 'https://www.linkedin.com/authwall?trk=gf&trkInfo=AQGXobmlQ2QS6wAAAZfJbt9Am357RnAYQM8A9Q4DG26GOSRq_12HCdFLg31pylWUsIWc_tKcg3rNHefrIQuvH3cAa0JlebFIpDGeVlJlB6oN0KVHzAcVcawkKmbr8Qd-GOp2d08=&original_referer=http://148.72.26.123/&sessionRedirect=https%3A%2F%2Fwww.linkedin.com%2Fin%2Fankita-lokhande-8baa43168%2F%3ForiginalSubdomain%3Din', 'uploads/ankita-lokhande.webp', '1', '2025-07-01 16:14:00', '2025-07-02 10:09:52'),
(8, 'Brijesh Sounderajjan', 'Brijesh Sounderrajan is a seasoned packaging engineering leader with over 30 years of experience across the FMCG industry. At Packfora, he leads the Talent Flex Growth with a strong focus on enabling Capacity, Capability and Flexibility build for the customers through right-fit packaging talent.His career includes key roles at Godfrey Phillips India Ltd, Pidilite Industries, Godrej & Boyce, where he worked in several capacities heading production for the world-famous Marlboro brand in India. He has rich experience in the deployment of ERP solutions for procurement and inventory function and has been instrumental in Packaging development and new product launches across organizations.He holds a Post Graduate Qualification in Packaging as well as Materials Management. He enjoys reading inspiring entrepreneurship initiatives, travel, and connecting with people.', 'SHPCO & Talent Flex', 'https://www.linkedin.com/authwall?trk=gf&trkInfo=AQEQRf6BUpRblAAAAZfJbzFIIGliiFTdI5UfbP0C2KkM3Px9QOuAj9vXC7_TGqOPqGDigLVTMlvghyZiGjHu2uNt4kLugcD4Tuu8J_R6MQNcYkHsQwzw4HjccMdfpTK_yE_rTX4=&original_referer=http://148.72.26.123/&sessionRedirect=https%3A%2F%2Fwww.linkedin.com%2Fin%2Fbrijesh-sounderrajan-5378277%2F', 'uploads/brijesh-sounderajjan.webp', '1', '2025-07-01 16:14:00', '2025-07-02 10:10:12'),
(9, 'Ankheeta Lath', 'Ankheeta leads global marketing at Packfora, driving brand growth through innovative digital strategies, integrated campaigns, and impactful content. With an MBA in Marketing, she specializes in transforming marketing frameworks to deliver measurable impact across international markets.Prior to Packfora, she spent over seven years at Informa Markets India, where she led conference content strategy and curation across key sectors including food, pharma, cosmetics, and nutrition. Known for her collaborative mindset and passion for team building, Ankheeta believes in the power of shared success: “I shine, we shine, client shine.”', 'Director - Marketing', 'https://www.linkedin.com/authwall?trk=gf&trkInfo=AQFYgJ9i_0LeHwAAAZfJb39o3N-cQqLmECvy5cGVxLfvEqsGBX39COLkyO89ULiFIHxf2rOzvT16DfdXTqKss_bOMP_DUwLYtPiuK5YgwtYNJ14F_Bk4lboxCKFIC3g5uWSbZzc=&original_referer=http://148.72.26.123/&sessionRedirect=https%3A%2F%2Fwww.linkedin.com%2Fin%2Fankheeta-lath-122a6598%2F%3ForiginalSubdomain%3Din', 'uploads/ankheeta-lath.webp', '1', '2025-07-01 16:14:00', '2025-07-02 10:10:42'),
(10, 'Baskaran Thiagarajan', 'Baskaran is a seasoned manufacturing and operations leader with 29 years of experience across Plant Operations, Supply Chain Management, Lean Manufacturing, Operational Excellence, and Manufacturing Transformation. His expertise spans a wide range of sectors, including Chemicals, Paints, FMCG, and Alcobev. He most recently led India Contract Manufacturing Operations at Diageo, overseeing a network that contributed to 65% of Diageo India’s business.Prior to that, he held key leadership roles at Avery Dennison, Mondelez, Hindustan Unilever, United Phosphorus, Asian Paints, and DCW Ltd. Baskaran brings deep knowledge in Production Planning, Project Management, HSE, TPM, and Plant Engineering. A strong advocate of continuous improvement, he is a Certified Energy Manager (BEE), Certified TPM Instructor (JIPM), DuPont Certified Safety Trainer, and APICS-certified in Supply Chain Management.He holds a B.E. in Mechanical Engineering from Thiagarajar College of Engineering, Madurai. Outside of work, he enjoys playing badminton and listening to music.', 'SHPCO', 'https://www.linkedin.com/authwall?trk=gf&trkInfo=AQG9xUjmUMPqtAAAAZfJcABQBATYN730hfFV3xy6c5otHO1yUgN73C9ZsnRhUEomhBTxPkwYcMeGVZjOi4g4FMu0oIjYtDaLG3ORDdFVuYCkhtijYDAMYFj38_5fTwZzXlCXh44=&original_referer=http://148.72.26.123/&sessionRedirect=https%3A%2F%2Fwww.linkedin.com%2Fin%2Fbaskaran-thiagarajan%2F%3ForiginalSubdomain%3Din', 'uploads/baskaran-thiagarajan.webp', '1', '2025-07-01 16:14:00', '2025-07-02 10:11:02'),
(11, 'Samrat Dasgupta', 'Samrat Dasgupta leads Supply Chain - Packaging & Automation at Packfora, bringing over 18 years of experience across FMCG, F&B, and industrial manufacturing. A techno-commercial leader, he specializes in packaging automation, supply chain optimization, and high-capex project delivery. With deep expertise in E2E value chains, from packaging design to sourcing, machine installation and logistics optimization, Samrat has successfully led the implementation of multiple high-speed automated lines across geographies.He is known for driving packaging value engineering, digital transformation, and cost-saving initiatives, while managing P&L and leading cross-functional, multicultural teams. Samrat holds a B.E. and an MBA-PGBM from IIM Indore and is Lean IPD and Machine Safety certified.', 'SHPCO', 'https://www.linkedin.com/authwall?trk=gf&trkInfo=AQGB7n6e6u4FBwAAAZfJcEK4ULJcvL9U2wu1Hqhth19JJxr2keMhlcahBwfkMFObO_FQ4SFy_dLyknNLVIKPDoNxHLEj357If_vAAcGaEM9mQ8IUezqHkmJl5uu2slh1puWyDGQ=&original_referer=https://www.linkedin.com/in/samrat-dasgupta-1326583a/&sessionRedirect=https%3A%2F%2Fwww.linkedin.com%2Fin%2Fsamrat-dasgupta-1326583a%2F%3Foriginal_referer%3Dhttp%253A%252F%252F148.72.26.123%252F', 'uploads/samrat-dasgupta.webp', '1', '2025-07-01 16:14:00', '2025-07-02 10:11:37'),
(12, 'Sheryll Umagtang', 'Sheryll Umagtang is a seasoned packaging professional with over 20 years of cross-functional experience spanning Packaging Innovation, Quality Assurance, Supplier Qualification, and Procurement. Her career spans multiple industries, including personal care, food & beverage, and spirits through key roles at Unilever, Diageo, Nutri Asia, and now Packfora.At Packfora, Sheryll partners with leading global and regional brands to deliver innovative packaging solutions that strike a balance between performance, sustainability, cost, and consumer appeal. She is skilled in managing projects from ideation to execution, defining specifications, collaborating closely with suppliers, and ensuring smooth, market-ready launches. She holds a degree in Chemical Engineering from the University of the Philippines Diliman.Outside of her professional life, Sheryll enjoys creative pursuits like painting, exploring mindfulness through reflective reading, cooking, and taking long walks — simple routines that bring her clarity, joy, and a sense of balance.', 'Food, Pharma & CHC', 'https://www.linkedin.com/authwall?trk=gf&trkInfo=AQEJqZcTwFKmBgAAAZfJcLvQmjCxFKBjNWfuqC5mP6GTvUni2Ls-CSfuVCx4GdQ45OxQDP7xq_wBeg7ocGcAgwpO-T_uR7RHG2T5bzOXTF2sjAmfvofA4fXBLxBj7YsHx6ntD_4=&original_referer=http://148.72.26.123/&sessionRedirect=https%3A%2F%2Fwww.linkedin.com%2Fin%2Fsheryll-umagtang-174439216%2F', 'uploads/sheryll-umagtang.webp', '1', '2025-07-01 16:16:14', '2025-07-02 10:11:52'),
(13, 'Rodney Pease', 'Rodney Pease is a seasoned packaging engineering professional with extensive experience in the food & beverage industry. Over the years, he has built a strong track record in driving innovation, operational excellence, and sustainable packaging solutions across consumer product segments.Rodney is highly skilled in packaging equipment, continuous improvement, mechanics, and sustainable materials—combining technical depth with a strategic business mindset. His career highlights include leading teams of packaging professionals, optimizing operations, and identifying growth opportunities through key partnerships and market insights. Known for his ability to align packaging strategy with business goals, Rodney has consistently delivered impactful, future-ready solutions.', 'Food, Pharma & CHC', 'https://www.linkedin.com/authwall?trk=gf&trkInfo=AQF4aTsym0gHigAAAZfJcQnwiw8vZb2IQx2bDN6SJxWoaV_-p7GwAdbgXs-6ZC-PVynwIqtkGcWzPOrNboa2Ky2hlRK75PVQHI4_lCgyf5gAonZ5Fp5AO_iVWuHnLvb5lwCWEgI=&original_referer=http://148.72.26.123/&sessionRedirect=https%3A%2F%2Fwww.linkedin.com%2Fin%2Frodney-pease-2768a850', 'uploads/rodney-pease.webp', '1', '2025-07-01 16:16:14', '2025-07-02 10:12:12'),
(14, 'Micheal Harris', 'Michael Harris is a seasoned packaging engineering leader with over 20 years of experience across the CPG, pharmaceutical, and food & beverage industries. At Packfora, he leads strategic packaging initiatives for major North American clients, with a strong focus on innovation, supplier collaboration, and cross-functional execution.His career includes key roles at Barry-Wehmiller Design Group, James Ross Consulting, Church & Dwight, CITGO, Pinnacle Foods, and Kraft Foods, where he managed global packaging development and product launches. Michael’s strengths lie in launching new products, optimizing materials, and building supplier relationships that deliver cost and sustainability gains.He holds a Packaging B.S. from Michigan State and an MBA from Davenport University. He enjoys reading, philosophy, travel, and parenting his 1.5-year-old son.', 'Foods, Pharma & CHC', 'https://www.linkedin.com/authwall?trk=gf&trkInfo=AQF4aTsym0gHigAAAZfJcQnwiw8vZb2IQx2bDN6SJxWoaV_-p7GwAdbgXs-6ZC-PVynwIqtkGcWzPOrNboa2Ky2hlRK75PVQHI4_lCgyf5gAonZ5Fp5AO_iVWuHnLvb5lwCWEgI=&original_referer=http://148.72.26.123/&sessionRedirect=https%3A%2F%2Fwww.linkedin.com%2Fin%2Frodney-pease-2768a850', 'uploads/micheal-harris.webp', '1', '2025-07-01 16:16:14', '2025-07-02 10:12:36'),
(15, 'Chinmay Vasavada', 'Chinmay Vasavda is a strategic HR leader with over 18 years of experience across FMCG, chemicals, and consulting sectors. Passionate about building agile, future-ready organizations, he brings deep expertise in global HR business partnering, M&A integration, organization transformation, and capability building.His career spans leading companies like Unilever, VVF Limited, and Sampat International, where he drove people-first strategies and led initiatives in digital HR, leadership development, and inclusive culture. Chinmay has worked across India, the US, Europe, Southeast Asia, and MENA, partnering with diverse functions from R&D to Sales and Finance. A technically trained professional turned HR expert, he thrives on enabling purposeful talent ecosystems in complex, multicultural environments.', 'Director - People & Culture', 'https://www.linkedin.com/in/chinmay-vasavada-9956651b/?originalSubdomain=in&original_referer=http%3A%2F%2F148.72.26.123%2F', 'uploads/chinmay-vasavada.webp', '1', '2025-07-01 16:16:14', '2025-07-02 10:12:56'),
(16, 'Indra Jeevanandam', 'Indra Jeevanandam has over 12 years of experience in financial planning, pricing, profitability management, and cash flow optimization. At Packfora, she supports the Food & Pharma Business Unit by embedding pricing discipline, enhancing P&L transparency, forecasting revenue pipelines, and enabling cash flow predictability. Indra works closely with leadership and cross-functional teams to align financial strategies with business goals, ensuring clarity and accountability across operations.Her previous roles span leading organizations like Datamatics, VFS Global, Travelport, and Tresorie, where she managed receivables, fund flows, and financial reporting across diverse entities. Known for her calm, collaborative style, Indra excels at building financial systems that support agility and empowering non-finance teams with actionable insights.Outside work, she finds joy in travel, dance, and community service, while staying grounded through spiritual reflection.', 'Finance Business Partner', 'https://www.linkedin.com/authwall?trk=gf&trkInfo=AQHt9YQJmJhJAAAAAZfJciMwukSv17-BZQXX8rLxNgwalYGrW7TEo9atjw7zj_qIM_sMIIKk81fYyP6QF2x9nZRq8ErC3u7217yP88-349gXd7iAlrrgGjXwDIhw7IDQ5TwTdj4=&original_referer=http://148.72.26.123/&sessionRedirect=https%3A%2F%2Fwww.linkedin.com%2Fin%2Findra-kartik-3a9582201%2F%3ForiginalSubdomain%3Din', 'uploads/indra-jeevanandam.webp', '1', '2025-07-01 16:16:14', '2025-07-02 10:13:35');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_life_at_packfora`
--

CREATE TABLE `tbl_life_at_packfora` (
  `id` int(11) NOT NULL,
  `image` text DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `is_delete` enum('1','0') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_life_at_packfora`
--

INSERT INTO `tbl_life_at_packfora` (`id`, `image`, `video`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'uploads/1750674560_cherrie-thumbnail.webp', 'uploads/cherrie3.mp4', '1', '2025-06-02 14:38:36', '2025-06-23 15:59:20'),
(2, 'uploads/1750674601_joel-thumbnail.webp', 'uploads/joel.mp4', '1', '2025-06-02 14:48:07', '2025-06-23 16:00:01'),
(3, 'uploads/1750674250_sheryll-thumbnail.webp', 'uploads/sheryll.mp4', '1', '2025-06-02 14:48:14', '2025-06-23 15:54:23'),
(4, 'uploads/1750674651_supriya-thumbnail.webp', 'uploads/supriya.mp4', '1', '2025-06-02 14:48:25', '2025-06-23 16:00:51'),
(5, 'uploads/1750674527_aries-thumbnail.webp', 'uploads/Aries.mp4', '1', '2025-06-02 14:48:32', '2025-06-23 15:58:47'),
(6, 'uploads/1750674690_thomas-thumbnail.webp', 'uploads/tom_mp4.mp4', '1', '2025-06-02 14:48:47', '2025-06-23 16:01:30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_market_trends`
--

CREATE TABLE `tbl_market_trends` (
  `id` int(11) NOT NULL,
  `fk_service_id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_delete` enum('1','0') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_market_trends`
--

INSERT INTO `tbl_market_trends` (`id`, `fk_service_id`, `title`, `description`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 2, '40%', 'of the planet\'s plastic waste originates from packaging materials.', '1', '2025-06-05 10:58:58', '2025-06-05 10:58:58'),
(2, 2, '14.5MT.', 'of plastic containers and packaging were generated in the U.S. in 2018.', '1', '2025-06-05 10:59:43', '2025-06-05 10:59:43'),
(3, 2, '09%', 'of the 9.2 billion tons of plastic produced have only been recycled properly.', '1', '2025-06-05 14:31:04', '2025-06-05 14:31:04'),
(4, 2, '31.3%', 'of glass containers were recycled in the U.S. in 2018.', '1', '2025-06-05 14:31:19', '2025-06-05 14:31:35'),
(5, 3, '$212.81', 'billion is the projected value of the global logistics automation market by 2032.', '1', '2025-06-05 15:38:15', '2025-06-05 15:39:39'),
(6, 3, '80%', 'of warehouses continue to operate manually, indicating substantial missed opportunities.', '1', '2025-06-05 15:38:32', '2025-06-05 15:38:32');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_optimize_image`
--

CREATE TABLE `tbl_optimize_image` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `is_delete` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_optimize_image`
--

INSERT INTO `tbl_optimize_image` (`id`, `image`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'uploads/icon_1751525959_1.webp', 1, '2025-07-03 12:29:19', '2025-07-03 12:29:19');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_optimize_packaging`
--

CREATE TABLE `tbl_optimize_packaging` (
  `id` int(11) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `is_delete` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_optimize_packaging`
--

INSERT INTO `tbl_optimize_packaging` (`id`, `icon`, `description`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'uploads/icon_1751525959_1.png', 'Identify stress points and failure risks early', 1, '2025-07-03 12:29:19', '2025-07-03 12:29:19'),
(2, 'uploads/icon_1751525959_11.png', 'Accelerate decision-making with data', 1, '2025-07-03 12:29:19', '2025-07-03 12:29:19'),
(3, 'uploads/icon_1751525959_12.png', 'Build smarter, lighter, more sustainable packs', 1, '2025-07-03 12:29:19', '2025-07-03 12:29:19');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_our_leaders`
--

CREATE TABLE `tbl_our_leaders` (
  `id` int(11) NOT NULL,
  `fk_service_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `link` text DEFAULT NULL,
  `image` longtext DEFAULT NULL,
  `is_delete` enum('1','0') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_our_leaders`
--

INSERT INTO `tbl_our_leaders` (`id`, `fk_service_id`, `name`, `designation`, `link`, `image`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 1, 'Brijesh Sounderrajan', 'Talent Flex', 'https://www.linkedin.com/in/brijesh-sounderrajan-5378277/?original_referer=http%3A%2F%2F148.72.26.123%2F', 'uploads/brijesh1.webp', '1', '2025-06-04 16:56:15', '2025-07-09 12:38:21'),
(2, 1, 'Pradeep Nair', 'Foods, Pharma & CHC', 'https://www.linkedin.com/authwall?trk=gf&trkInfo=AQF3qYIOUjNz7AAAAZfuAdkgGrAqNiE7jDQmuI3R58d5V03wtpjBzowlGZKFZ2oE0Pz-ZS3D9DFGdOG98nrbF55UwOp8TCWmZFYqBREEPzUJttB-GTrz7jvlm34c4K8pVmrroko=&original_referer=http://148.72.26.123/&sessionRedirect=https%3A%2F%2Fwww.linkedin.com%2Fin%2Fpradeep-nair-7b0175119%2F', 'uploads/pradeep1.webp', '1', '2025-06-04 17:02:13', '2025-07-09 12:36:37'),
(3, 1, 'Prachi Balchandani', 'Packaging Engineer', 'https://www.linkedin.com/in/prachibalchandani/', 'uploads/prachi1.webp', '1', '2025-06-04 17:02:49', '2025-07-09 12:38:05'),
(4, 1, 'Annette Blackaasss', 'Packaging Engineer', NULL, 'uploads/team-04.webp', '0', '2025-06-04 17:03:48', '2025-07-09 12:36:00'),
(5, 5, 'Hitesh Shenoy', 'VP & BU Lead - Growth - Foods & Pharma', 'https://www.linkedin.com/in/hitesh-shenoy-2a84492/?originalSubdomain=sg', 'uploads/hitesh.webp', '1', '2025-06-27 09:51:51', '2025-06-27 09:51:51'),
(6, 5, 'Chirag Master', 'VP & BU Lead - Growth, Delivery - SHPCO, Talent Flex & Mold Management Services', 'https://www.linkedin.com/in/chirag-master-54364bb/?originalSubdomain=in', 'uploads/chirag.webp', '1', '2025-06-27 09:52:45', '2025-06-27 09:52:45'),
(7, 5, 'Tom Oravez', 'Foods, Pharma & CHC (USA)', 'https://www.linkedin.com/in/tom-oravez/', 'uploads/tom.webp', '1', '2025-06-27 09:53:25', '2025-06-27 09:53:25'),
(8, 5, 'Sheryll Umagtang', 'Foods, Pharma & CHC (SEA)', 'https://www.linkedin.com/in/sheryll-umagtang-174439216/', 'uploads/sheryll.webp', '1', '2025-06-27 09:55:41', '2025-06-27 09:55:41'),
(9, 5, 'Micheal Harris', 'Foods, Pharma & CHC (USA)', 'https://www.linkedin.com/in/michael-l-harris-41a9897/', 'uploads/micheal.webp', '1', '2025-06-27 09:56:26', '2025-06-27 09:56:26'),
(10, 4, 'Tom Oravez', 'Foods, Pharma & CHC (USA)', 'https://www.linkedin.com/in/tom-oravez/', 'uploads/tom_(1).webp', '1', '2025-06-27 12:50:23', '2025-06-27 12:53:23'),
(11, 4, 'Prashant Sukhtankar', 'Foods, Pharma & CHC', 'https://www.linkedin.com/in/prashant-sukhtankar-70a90a18/?originalSubdomain=in', 'uploads/prashant.webp', '1', '2025-06-27 12:51:56', '2025-06-27 12:53:21'),
(12, 4, 'Aunjna Agarvval', 'Foods, Pharma & CHC', 'https://www.linkedin.com/in/aunjna-agarvval-743b90204/', 'uploads/aunjna.webp', '1', '2025-06-27 12:52:54', '2025-06-27 12:53:19'),
(13, 4, 'Avinash Singh', 'SHPCO', 'https://www.linkedin.com/in/avinash-singh-68345356/', 'uploads/avinash.webp', '1', '2025-06-27 12:56:40', '2025-06-27 12:56:40'),
(14, 8, 'Chirag Master', 'VP & BU Lead - Growth, Delivery - sHPCO, Talent Flex & Mold Management Services', 'https://www.linkedin.com/in/chirag-master-54364bb/?originalSubdomain=in', 'uploads/chirag_(2).webp', '1', '2025-07-01 10:54:07', '2025-07-01 10:54:07'),
(15, 8, 'Minoti Banerjee', 'SHPCO', 'https://www.linkedin.com/in/minoti-banerjee/?original_referer=http%3A%2F%2Flocalhost%2F', 'uploads/minoti.webp', '1', '2025-07-01 10:54:47', '2025-07-01 10:54:47'),
(16, 8, 'Saikat Jana', 'SHPCO', 'https://www.linkedin.com/in/saikat-jana-048a2a13b/', 'uploads/saiket.webp', '1', '2025-07-01 10:55:53', '2025-07-01 10:55:53');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_our_offering`
--

CREATE TABLE `tbl_our_offering` (
  `id` bigint(20) NOT NULL,
  `fk_service_id` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `image` longtext DEFAULT NULL,
  `is_delete` enum('1','0') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_our_offering`
--

INSERT INTO `tbl_our_offering` (`id`, `fk_service_id`, `title`, `description`, `image`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 1, 'Capacity', 'We provide qualified talent with enhanced skill set to complement your packaging team.', 'uploads/capacity5.webp', '1', '2025-06-04 10:27:12', '2025-06-04 10:27:12'),
(2, 1, 'Capability', 'We offer end-to-end packaging value chain understanding and structured skill upgrades.', 'uploads/capability.webp', '1', '2025-06-04 10:28:57', '2025-06-04 10:28:57'),
(3, 1, 'Flexibility', 'We support multiple sites and global operations across geographies and time zones.', 'uploads/flexibility.webp', '1', '2025-06-04 10:29:28', '2025-06-04 10:51:46'),
(4, 2, 'Future-Proof Your Business with Sustainable Packaging', 'Sustainability isn\'t just about compliance-it\'s about growth, efficiency, and brand leadership. We help you eliminate waste, lower emissions, and transition to circular economy models that secure your business for the future.', 'uploads/future-proof-your-business-with-sustainable-packaging.webp', '1', '2025-06-05 12:39:21', '2025-06-05 12:50:08'),
(5, 2, 'R&D in Sustainable Packaging: Smarter Materials, Less Waste', 'Leverage scientific research and advanced materials to make packaging lighter, stronger, and more sustainable without compromising performance.  Plastic-Light: Reduce plastic use while optimizing functionality Smart Plastics: Shift to recycled, bio-based, or biodegradable alternatives Zero Plastic: Explore innovative non-plastic solutions for a fully sustainable future', 'uploads/RD-in-sustainable-packaging.webp', '1', '2025-06-05 12:51:50', '2025-06-05 12:51:50'),
(6, 2, 'Mastering Sustainability Compliance: Stay Ahead of Regulations', 'Global regulations on plastic waste, recyclability, and sustainability are evolving fast. We provide expert insights and compliance frameworks that keep you ahead of legal changes-ensuring smooth, risk-free operations.', 'uploads/mastering-sustainability-compliance.webp', '1', '2025-06-05 12:52:15', '2025-06-05 12:52:15'),
(7, 2, 'Science-Backed Circularity: Optimize Every Decision', 'We use Life Cycle Assessment (LCA), Carbon Footprinting, and AI-powered analytics to help you:  Choose the most sustainable materials Reduce environmental impact while maintaining cost-effectiveness Improve waste management and recyclability across the supply chain', 'uploads/science-backed-circularity.webp', '1', '2025-06-05 12:52:49', '2025-06-05 12:52:49'),
(8, 2, 'Strategic Sustainability Consulting: Future-Proof Your Brand', 'A winning sustainability strategy goes beyond materials. We provide end-to-end consulting to align your packaging with consumer expectations, regulatory trends, and industry best practices-driving long-term success.', 'uploads/strategic-sustainability-consulting.webp', '1', '2025-06-05 12:53:23', '2025-06-05 12:53:23'),
(9, 2, 'Discover the Future of Sustainable Packaging', 'Experience the future of sustainable packaging at our exclusive industry fairs. Discover innovations, network with experts, and stay ahead of market trends.', 'uploads/discover-the-future-of-sustainable-packaging.webp', '1', '2025-06-05 12:53:48', '2025-06-05 12:53:48'),
(10, 2, 'Market Intelligence: Stay Competitive with Data-Driven Insights', 'Don\'t follow the trends-stay ahead of them. Our real-time sustainability market intelligence helps you spot opportunities, anticipate shifts, and gain a competitive advantage in an evolving industry.', 'uploads/market-intelligence.webp', '1', '2025-06-05 12:54:14', '2025-06-05 12:54:14'),
(11, 3, 'Manufacturing Excellence', 'Lean Transformations Site Master Planning Demand Vs Capacity Analysis De-Bottlenecking', 'uploads/manufacturing-excellence.webp', '1', '2025-06-06 10:01:41', '2025-06-09 16:33:08'),
(12, 3, 'Packaging Automation', 'Packaging Technology Selection Material - Machine Interface Affordable Automation Installation & Line Trials', 'uploads/packaging-automation.webp', '1', '2025-06-06 10:03:05', '2025-06-06 10:03:05'),
(13, 3, 'Industrial Digitization', 'Advanced QMS Simulation Solutions Real Time Visualization Virtual Reality in Packaging', 'uploads/industrial-digitization.webp', '1', '2025-06-06 10:03:36', '2025-06-06 10:03:36'),
(14, 3, 'End-to-End Management', 'Business Cases Project Management And Control Make vs Source Load Ability Analysis', 'uploads/end-to-end-management.webp', '1', '2025-06-06 10:04:01', '2025-06-06 10:05:58'),
(15, 7, 'Packaging Innovation', 'End-to-end, fast-tracked product and packaging development powered by digital tools for rapid prototyping and agile execution.\r\nMock-ups. \r\nAesthetic Prototypes. \r\nFunctional Prototypes. \r\nPilot Mold Trials. \r\nAssembly & Finishing. \r\nDriving creativity through innovation fairs and collaborative ideation.', 'uploads/creative-design.webp', '1', '2025-06-16 11:09:08', '2025-06-27 10:59:51'),
(16, 8, 'Sourcing & Design-to-Value (DTV)', 'Foundational Strategies Spend Analytics & Market Intelligence Strategic & Tactical Sourcing (Short & Long-Term) Supplier Pricing Review & Benchmarking Contract Lifecycle Management Driving Business Goals Through Smart Procurement Advanced Optimization Levers Spec Optimization & Material Alternatives Standardization & Complexity Reduction Value Chain Assessment for End-to-End Efficiency', 'uploads/sourcing-and-dtv.webp', '1', '2025-06-16 14:09:51', '2025-06-16 14:16:04'),
(17, 7, 'Packaging Engineering', 'Expertise in 2D & 3D packaging design.\r\nDigital simulation for performance optimization.\r\nScalable and efficient packaging manufacturing.\r\nFocus on innovation, sustainability, and cost-effectiveness.\r\nParametric CAD development: DFM, DFA and DFMEA.\r\nManufacturing Drawings.', 'uploads/design-led-research.webp', '1', '2025-06-27 10:39:31', '2025-06-27 11:00:36'),
(18, 7, 'Transit & Distribution Modelling', 'Comprehensive transit and distribution simulations.\r\nTesting aligned with ISTA scenarios and global standards.\r\nEnsures product protection, minimizes material waste.\r\nSupports reliability across diverse supply chain conditions.', 'uploads/design-validation.webp', '1', '2025-06-27 10:39:58', '2025-06-27 11:01:54'),
(19, 7, 'Channel-Specific Solutions', 'Tailored packaging for e-commerce and D2C.\r\nOptimized for protection, efficiency, and cost.\r\nDesigned to enhance digital brand experience.', 'uploads/engineering-excellence.webp', '1', '2025-06-27 10:40:30', '2025-06-27 11:02:18'),
(20, 9, 'Data Migration for PLM Deployment', 'Supporting smooth transitions from scattered data to a single digital source of truth\r\n\r\nBuild packaging data models and templates.\r\nValidate data with sites and suppliers.\r\nPrepare structured, migration-ready datasets.', 'uploads/data-migration.webp', '1', '2025-07-01 12:03:37', '2025-07-01 12:36:59'),
(21, 9, 'Post-PLM Change Management', 'Managing packaging data updates across the product lifecycle with precision and speed\r\n\r\nCentralized spec management teams\r\nAligned with global standards and workflows\r\nOn-time, audit-ready updates across SKUs', 'uploads/change-management.webp', '1', '2025-07-01 12:06:00', '2025-07-01 12:37:06'),
(22, 9, 'Portfolio Assessment & Value Creation', 'Using specification data as a lever for simplification, sustainability, and savings\r\n\r\nIdentify duplication, complexity, and gaps\r\nEnable reporting across functions (Regulatory, Procurement, Sustainability)\r\nDrive decisions through validated insights', 'uploads/assesment.webp', '1', '2025-07-01 12:07:16', '2025-07-01 12:37:13'),
(23, 9, 'Digitization & Process Automation', 'Laying the groundwork for real-time visibility and future-ready operations\r\n\r\nAutomated audit mechanisms and quality checks\r\nDigital dashboards for tracking and governance', 'uploads/digitisation.webp', '1', '2025-07-01 12:08:34', '2025-07-01 12:37:18');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_our_promise`
--

CREATE TABLE `tbl_our_promise` (
  `id` bigint(20) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `image` longtext DEFAULT NULL,
  `is_delete` enum('1','0') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_our_promise`
--

INSERT INTO `tbl_our_promise` (`id`, `title`, `description`, `image`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Veritable Expertise', 'We bring unparalleled knowledge and experience to every aspect of packaging, ensuring that your solutions are crafted with precision and expertise.', 'uploads/veritable-expertise.webp', '1', '2025-06-17 10:35:09', '2025-06-17 10:37:10'),
(2, 'Above & Beyond', 'Our dedication goes above and beyond mere promises. We are committed to delivering results that exceed your expectations, every time.', 'uploads/above-beyond.webp', '1', '2025-06-17 10:35:56', '2025-06-17 10:35:56'),
(3, 'Deep & Meaningful Relationships', 'We prioritize building lasting partnerships with our clients. Trust, collaboration, and mutual success are at the heart of everything we do.', 'uploads/deep-meaningful-relationships.webp', '1', '2025-06-17 10:36:21', '2025-06-17 10:36:21');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pillars_intro`
--

CREATE TABLE `tbl_pillars_intro` (
  `id` int(11) NOT NULL,
  `main_title` varchar(255) NOT NULL,
  `subtitle` text NOT NULL,
  `sub_heading` varchar(255) NOT NULL,
  `is_delete` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_pillars_intro`
--

INSERT INTO `tbl_pillars_intro` (`id`, `main_title`, `subtitle`, `sub_heading`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Our Pillars of Impact Enablement', 'We\'ve built a capability stack that allows us to deliver outcomes across every packaging decision point:', '1. Science-Backed Approach', 1, '2025-07-03 12:29:18', '2025-07-03 12:29:18');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_resourcing_model`
--

CREATE TABLE `tbl_resourcing_model` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `image` longtext DEFAULT NULL,
  `is_delete` enum('1','0') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_resourcing_model`
--

INSERT INTO `tbl_resourcing_model` (`id`, `title`, `description`, `image`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Onshore', 'Model offers In-house resourcing for clients on a global scale at client\'s location.', 'uploads/onshore2.webp', '1', '2025-06-04 13:51:26', '2025-06-04 13:51:26'),
(2, 'Offshore', 'Model offers resourcing for clients in an efficient way for workstreams that can be managed virtually.', 'uploads/offshore.webp', '1', '2025-06-04 13:56:06', '2025-06-04 13:56:06'),
(3, 'Hybrid', 'Model offers resourcing for clients that provides the flexibility of offering best of both worlds.', 'uploads/hybrid.webp', '1', '2025-06-04 13:56:31', '2025-06-04 14:07:29');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_science_backed`
--

CREATE TABLE `tbl_science_backed` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `is_delete` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_science_backed`
--

INSERT INTO `tbl_science_backed` (`id`, `title`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Model performance', 1, '2025-07-03 12:29:18', '2025-07-03 12:29:18'),
(2, 'Minimize risk', 1, '2025-07-03 12:29:19', '2025-07-03 12:29:19'),
(3, 'Move faster', 1, '2025-07-03 12:29:19', '2025-07-03 12:29:19');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_services`
--

CREATE TABLE `tbl_services` (
  `id` bigint(20) NOT NULL,
  `service_name` varchar(100) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `image` text DEFAULT NULL,
  `link` text DEFAULT NULL,
  `is_delete` enum('1','0') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_services`
--

INSERT INTO `tbl_services` (`id`, `service_name`, `description`, `image`, `link`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Talent Flex', 'Get the right expertise, when and where you need it. Talent Flex helps you stay ahead by bridging skill gaps, enhancing productivity, and enabling businesses to manage complex packaging priorities.', 'uploads/talent-flexx.webp', 'talent-flex.php', '1', '2025-06-04 09:52:14', '2025-06-23 09:58:54'),
(2, 'Sustainability', 'We help you stay ahead with smart, sustainable solutions that drive growth while protecting the planet.Packfora\'s solutions have consistently helped global brands achieve their environmental and business goals.', 'uploads/sustainability.webp', 'sustainability.php', '1', '2025-06-04 09:52:14', '2025-06-23 09:58:47'),
(3, 'Supply Chain Automation', 'Transform your Supply Chain Automation today focus on Affordability, Scalability, & Digital Backbone with our customised solutions', 'uploads/supply-chain-automation.webp', 'supply-chain-automation.php', '1', '2025-06-04 09:52:14', '2025-06-23 09:58:38'),
(4, 'Product Innovation', NULL, NULL, NULL, '1', '2025-06-04 09:52:14', '2025-06-04 09:52:33'),
(5, 'Design to Value', 'Design cost-effective packaging solutions that align with evolving industry trends and consumer expectations.', 'uploads/design-to-value.webp', 'design-to-value.php', '1', '2025-06-04 09:52:14', '2025-06-23 09:59:00'),
(6, 'MaxMold', 'MaxMold is a smart, secure mold lifecycle platform that brings together end -to-end workflow intelligence, real-time monitoring, and expert-built automation.', 'uploads/maxmold.webp', 'maxmold.php', '1', '2025-06-04 09:54:05', '2025-06-23 10:54:01'),
(7, 'Packaging Innovation & Engineering', 'Pushing the boundaries of packaging with next-gen innovations—leveraging rapid prototyping, sustainable materials, and design innovation.', 'uploads/packaging-innovation-engineering.webp', 'packaging-innovation-and-engineering.php', '1', '2025-06-04 09:54:05', '2025-06-23 09:59:08'),
(8, 'Packaging Procurement', 'Packaging Spend typically accounts for ~ 5% to max 15% of the total procurement spend of an organization. With the right approach, we can reduce costs, improve efficiency, and enhance brand impact.', 'uploads/packaging-procurement.webp', 'packaging-procurement.php', '1', '2025-06-04 09:54:05', '2025-06-23 10:00:35'),
(9, 'Specification Management', 'We understand the complexities of packaging specification management and deliver digital solutions that ensure accuracy, compliance, and operational efficiency', 'uploads/specification-management.webp', 'specification-management.php', '1', '2025-06-04 09:54:05', '2025-06-23 10:59:07');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_service_banner_video`
--

CREATE TABLE `tbl_service_banner_video` (
  `id` bigint(20) NOT NULL,
  `fk_service_id` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `sub_title` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `video` longtext DEFAULT NULL,
  `is_delete` enum('1','0') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_service_banner_video`
--

INSERT INTO `tbl_service_banner_video` (`id`, `fk_service_id`, `title`, `sub_title`, `description`, `video`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 1, 'Talent Flex', 'Elevate Your Team Capability', '77% of businesses globally reported difficulty finding the skilled talent they need. Talent Flex helps you stay ahead by bridging skill gaps, enhancing productivity, and enabling businesses to manage complex packaging priorities.', 'uploads/talent-flex1.mp4', '1', '2025-06-03 16:46:03', '2025-06-04 17:59:56'),
(2, 2, 'Sustainability', 'Sustainability is the New Core of Packaging', 'Stricter regulations, plastic bans, and growing demand for eco-friendly products are reshaping the packaging industry. Sustainability is not just a requirement but an opportunity to deliver competitive advantage. Our approach helps you achieve both environmental impact and business performance.', 'uploads/sustainability.mp4', '1', '2025-06-05 09:15:54', '2025-06-27 14:20:50'),
(3, 3, 'Supply Chain Automation', 'Automate. Streamline. Optimize.', 'Supply Chain Automation is designed to simplify and enhance the entire supply chain process, from procurement to delivery. By integrating advanced automation technology, we enable businesses to operate with greater speed, efficiency, and precision across all levels of their supply chain.', 'uploads/supply-chain-automation.mp4', '1', '2025-06-05 15:16:25', '2025-06-05 15:17:04'),
(4, 7, 'Packaging Innovation and Engineering', 'Inspire. Innovate. Impact.', 'We use design thinking principles and real consumer insights to develop solutions that go beyond aesthetics or functionality. Our approach ensures that design and developmental impact is not restricted to Innovation but also straddles across efficiency and sustainability.', 'uploads/innovation-and-engineering.mp4', '1', '2025-06-16 10:39:21', '2025-06-27 10:37:57'),
(5, 8, 'Packaging Procurement', 'Optimise Your Packaging', 'Packaging Spend typically accounts for ~ 5% to max 15% of the total procurement spend of an organization. With the right approach, we can reduce costs, improve efficiency, and enhance brand impact.', 'uploads/packaging-procurement.mp4', '1', '2025-06-16 13:48:00', '2025-06-16 13:49:58'),
(6, 5, 'Design to Value', 'Smarter Packaging. Shining Impact.', 'We believe that packaging is a strategic business weapon and our Design to Value (DTV) creates impact similarly by blending innovation & efficiency to create packaging solutions that optimize costs, enhance consumer experience, and future-proof your business.', 'uploads/dtv.webm', '1', '2025-06-26 16:14:57', '2025-06-26 16:14:57'),
(7, 9, 'Specification Management', 'The hidden system behind Packaging Success', 'In high speed, multi SKU environments, specification mismanagement quietly erodes speed, compliance and revenue. Without high data accuracy or structured analysis for continuous improvement, even small inconsistencies in data, versions or approvals can create serious disruption. We bring structure, visibility and intelligence to packaging specs, turning them from a bottleneck into a competitive edge.', 'uploads/specification-management.webm', '1', '2025-07-01 11:30:50', '2025-07-01 11:37:25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shine_with_us`
--

CREATE TABLE `tbl_shine_with_us` (
  `id` bigint(20) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `image` longtext NOT NULL,
  `is_delete` enum('1','0') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_shine_with_us`
--

INSERT INTO `tbl_shine_with_us` (`id`, `title`, `description`, `image`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Diversity, Equity & Inclusion', 'We\'re creating a workplace where different perspectives are not just welcomed but celebrated. Because we believe diversity sparks innovation, equity builds trust, and inclusion creates space for everyone to thrive.', 'uploads/diversity-equity-inclusion.webp', '1', '2025-06-02 09:42:46', '2025-06-02 10:13:43'),
(2, 'Learning & Development', 'We invest in our employees\' professional growth through structured learning, leadership development, and hands-on exposure to the packaging value chain.', 'uploads/learning-development.webp', '1', '2025-06-02 10:14:15', '2025-06-02 10:14:15'),
(3, 'Employee Well-being', 'We prioritize the well-being of our employees and their families by creating a healthy work environment and offering meaningful support programs.', 'uploads/employee-well-being.webp', '1', '2025-06-02 10:14:38', '2025-06-02 10:24:58'),
(4, 'Global Exposure', 'Our employees gain exposure to global projects and leadership development initiatives, opening doors to new career opportunities and professional advancement.', 'uploads/global-exposure.webp', '1', '2025-06-02 10:15:38', '2025-06-02 10:25:02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slider`
--

CREATE TABLE `tbl_slider` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` text DEFAULT NULL,
  `button_text` varchar(255) DEFAULT NULL,
  `button_link` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `slide_order` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `is_delete` enum('1','0') NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_slider`
--

INSERT INTO `tbl_slider` (`id`, `title`, `subtitle`, `button_text`, `button_link`, `image`, `slide_order`, `status`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Unlock Unimaginable Business Impact Using Packaging as a Business Weapon', '', 'Learn more about us', 'why-packfora.php', NULL, 1, 1, '1', NULL, NULL),
(2, 'School of Packaging', 'Sharpen your packaging expertise with<br>industry-leading training.', 'Learn More About our Training Program', 'javascript:void(0)', './uploads/packfora-wh-logo.webp', 2, 1, '1', NULL, NULL),
(3, 'Whitepaper 2024', 'Stay ahead with cutting-edge packaging insights.', 'Download Your Copy Now!', 'packforum-2024.php', './uploads/packforum.webp', 3, 1, '1', NULL, NULL),
(4, 'Packaging Maturity Index', 'Assess where you stand and discover new<br>growth opportunities.', 'Click Below to Check Yours', 'javascript:void(0)', NULL, 4, 1, '1', NULL, NULL),
(5, 'End-to-End Intelligence. Strategic Insights. Maximum Value.', 'Digitalise your Mold Management', 'Explore More', 'maxmold.php', './uploads/maxmold-logo1.png', 5, 1, '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_smart_to_circular`
--

CREATE TABLE `tbl_smart_to_circular` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `is_delete` enum('1','0') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_smart_to_circular`
--

INSERT INTO `tbl_smart_to_circular` (`id`, `title`, `image_name`, `image`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Future Forces', 'Evolving Regulations', 'uploads/evolving-regulations.webp', '1', '2025-06-03 08:24:46', '2025-06-03 14:04:44'),
(2, 'Future Forces', 'Smart Supply Chain', 'uploads/smart-supply-chain.webp', '1', '2025-06-03 08:26:07', '2025-06-03 14:04:44'),
(3, 'Future Forces', 'Smart Commerce', 'uploads/smart-commerce.webp', '1', '2025-06-03 08:27:11', '2025-06-03 14:04:44'),
(4, 'Future Forces', 'Next-Gen Recycling', 'uploads/next-gen-recycling.webp', '1', '2025-06-03 08:27:45', '2025-06-03 14:04:44'),
(5, 'New Values', 'Blurred Boundaries', 'uploads/blurred-boundaries.webp', '1', '2025-06-03 08:28:17', '2025-06-03 14:04:44'),
(6, 'New Values', 'Global Market Shifts', 'uploads/globa-market-shifts.webp', '1', '2025-06-03 08:28:45', '2025-06-03 14:04:44'),
(7, 'New Values', 'Inclusivity & Diversity', 'uploads/inclusivit-diversity.webp', '1', '2025-06-03 08:29:13', '2025-06-03 14:04:44'),
(8, 'New Values', 'Refill Revolution', 'uploads/refill-revolution.webp', '1', '2025-06-03 08:29:48', '2025-06-03 14:29:59');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_story_behind_maxmold`
--

CREATE TABLE `tbl_story_behind_maxmold` (
  `id` int(11) NOT NULL,
  `image` longtext DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `is_delete` enum('1','0') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_story_behind_maxmold`
--

INSERT INTO `tbl_story_behind_maxmold` (`id`, `image`, `description`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'uploads/founders.webp', 'MaxMold was born out of lived frustration—and a deep belief that things could be better.  Our two founders, Dahyalal Pandya and Ramaiah Muthusubramanian, spent years on the ground, managing the chaos that comes with mold failure: urgent fixes, missed timelines, and the helplessness of not knowing what went wrong until it was too late.  They didn’t just want a better solution—they needed one.  Inspired by structured systems in industries like aerospace and automotive, they began applying scientific principles to mold management—and saw the impact immediately. But it still relied on manual effort and personal discipline.  That’s when the bigger vision took shape: what if we could turn this know-how into a platform? One that brings structure, foresight, and intelligence into a space that’s long been reactive and invisible.  That vision became MaxMold.', '1', '2025-06-20 10:59:00', '2025-06-24 12:46:44');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student_talent_economy`
--

CREATE TABLE `tbl_student_talent_economy` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `image` longtext DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_student_talent_economy`
--

INSERT INTO `tbl_student_talent_economy` (`id`, `title`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Building tomorrow\'s leaders, today.', 'We love working with students and early-career professionals who bring curiosity, energy, and bold ideas to the table. Whether you\'re joining us through our Graduate or Management Trainee Programs, or as part of our scholarship network — Packfora is built to nurture emerging talent.', 'uploads/1748843239_student-talent-economy.webp', '2025-06-02 11:17:19', '2025-06-02 11:39:21');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_success_stories`
--

CREATE TABLE `tbl_success_stories` (
  `id` bigint(20) NOT NULL,
  `fk_service_id` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `image` longtext DEFAULT NULL,
  `is_delete` enum('1','0') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_success_stories`
--

INSERT INTO `tbl_success_stories` (`id`, `fk_service_id`, `title`, `description`, `image`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 1, 'Mold Management for a Global QSR Chain', 'Read how we streamlined mold management, enhancing efficiency and turnaround speed—securing a 24-month contract extension.', 'uploads/mould-management-for-a-global-QSR-chain.webp', '1', '2025-06-04 15:31:32', '2025-06-04 15:31:32'),
(2, 1, 'Lab & Prototyping Management for FMCG', 'Explore how we digitized lab operations, cutting prototyping time by 60%, accelerating product launches, and driving continuous innovation.', 'uploads/lab-and-prototyping-management-for-FMCG.webp', '1', '2025-06-04 15:33:37', '2025-06-04 15:34:14'),
(3, 2, 'Digitization & Innovationssss', 'We leverage AI, automation, and real-time data to ensure efficient, innovative, and sustainable packaging solutions that benefit your business, our team, and the planet.', 'uploads/we-do-03.png', '0', '2025-06-05 14:53:26', '2025-06-27 17:28:23'),
(4, 2, 'Global Spirits Leader Cuts Packaging Waste & Boosts Sustainability Without Compromising Luxury', NULL, 'uploads/global-spirit.webp', '1', '2025-06-05 14:56:50', '2025-06-05 14:56:50'),
(5, 2, 'Revolutionizing Personal Care Packaging: A Sustainability Breakthrough for a Global FMCG Giant', NULL, 'uploads/personal-care.webp', '1', '2025-06-05 14:57:12', '2025-06-05 14:57:12'),
(6, 2, 'Navigating Africa\'s Evolving Packaging Regulations: A Compliance Success Story', NULL, 'uploads/africa.webp', '1', '2025-06-05 14:57:44', '2025-06-05 14:57:44'),
(7, 3, 'Adhesive Supply Chain Technology & Investment Choices', 'A Market Leader in Adhesives wanted to develop Supply Chain Automation plan to increase production capabilities and revamp existing packaging operations for achieving end-to-end value chain unlock.', 'uploads/adhesive-SC-technology-and-investment-choices.webp', '1', '2025-06-06 14:57:22', '2025-06-06 15:25:11'),
(8, 3, 'F&B Packaging Operations', 'A leading coffee manufacturer wanted to streamline the existing packaging operations, enhance productivity & reduce labor intensive operations.', 'uploads/FB-packaging-operations.webp', '1', '2025-06-06 15:02:34', '2025-06-06 15:24:17'),
(9, 5, 'Fresh Produce Packaging Reinvented', 'Redesigned corrugated boxes for a global produce brand, increasing strength by 21% with zero additional cost, ensuring optimal air circulation.', 'uploads/fresh-food-packaging-reinvented.webp', '1', '2025-06-16 09:34:55', '2025-06-16 10:06:07'),
(10, 7, 'Global Health Company', 'Delivered a comprehensive sustainability agenda, developing an ambitious program targeting 2030 goals.', 'uploads/global-health.webp', '1', '2025-06-16 12:17:18', '2025-06-16 12:18:46'),
(11, 8, 'Unlock Embedded Cost through Should Cost Modelling', 'Optimized packaging costs by building Should Cost Models, mapping the value chain, and identifying negotiation levers. Linked conversion costs to market dynamics like power, labour, and interest rates while estimating real-time wastage—empowering the client to unlock 3-4% savings on total spend.', 'uploads/unlock-embedded-cost-through-should-cost-modelling.webp', '1', '2025-06-16 15:03:44', '2025-06-16 15:03:44'),
(12, 8, 'Cost Model Analysis to unlock Savings opportunities', 'By benchmarking costs for aerosol cans, cartons, corrugates, and laminates, we uncovered pricing gaps, identified competitive suppliers, optimized specifications, and introduced automation—unlocking 13% in savings through smarter negotiations.', 'uploads/cost-model-analysis-to-unlock-savings-opportunities.webp', '1', '2025-06-16 15:05:59', '2025-06-16 15:06:24'),
(13, NULL, 'Triple Bottom Line Approach', 'We integrate People, Planet and Profit into every packaging solution. Balancing impact and profitability.', 'uploads/we-do-01.png', '0', '2025-06-17 09:27:40', '2025-06-17 09:28:49'),
(14, 5, 'Productivity Savings for High-Volume Packaging', 'Optimized fruit box specifications, reducing inventory by 23% and unlocking $8.4M in annual savings.', 'uploads/productivity-saving-for-high-volume.webp', '1', '2025-06-26 17:14:16', '2025-06-26 17:14:16'),
(15, 5, 'Sustainable Frozen Food Packaging Transformation', 'Transitioned from non-recyclable laminated plastic to fossil-free, recyclable pouches—maintaining performance while enhancing sustainability.', 'uploads/sustainable-frozen-food-packaging.webp', '1', '2025-06-26 17:16:17', '2025-06-26 17:16:17'),
(16, 5, 'Thermoformed PP Bowl Optimization', 'Achieved up to 9% reduction in plastic consumption through advanced material optimization, lowering costs without compromising strength.', 'uploads/thermoformed-PP-otimization.webp', '1', '2025-06-26 17:17:30', '2025-06-26 17:17:30'),
(17, 5, 'Corrugate Cost-Saving Pipeline', 'Built a $4.1M annual savings roadmap for a leading CPG brand, halving implementation time while improving manufacturability.', 'uploads/corrugate-cost-saving-pipeline.webp', '1', '2025-06-26 17:19:16', '2025-06-26 17:19:16'),
(18, 5, 'ISTA-Test Protocol Development for India', 'Developed localized ISTA-equivalent testing protocols to minimize Defects Per Million Opportunities (DPMO), driving packaging innovation and process efficiency.', 'uploads/ISTA-test.webp', '1', '2025-06-26 17:20:09', '2025-06-26 17:20:09'),
(19, 7, 'Leading CPG Manufacturer', 'Achieved $90M in savings through packaging innovations and strategic partnerships.', 'uploads/leading-CPG.webp', '1', '2025-06-27 12:00:42', '2025-06-27 12:00:42'),
(20, 7, 'FMCG Giant', 'Centralized and digitized lab operations, reducing design and prototyping time by 60%.', 'uploads/FMCG-giant.webp', '1', '2025-06-27 12:02:07', '2025-06-27 12:02:07'),
(21, 2, 'Transforming Fresh Produce Packaging: How a Global Brand Reduced Waste & Maximized Shelf Life', NULL, 'uploads/transform1.webp', '1', '2025-06-27 17:29:25', '2025-06-27 17:29:25'),
(22, 9, 'Streamlined specification workflows across multiple categories and markets - improving speed, govern', NULL, 'uploads/streamlined-specification.webp', '1', '2025-07-01 14:43:10', '2025-07-01 14:45:14'),
(23, 9, 'Enabled global specification harmonization across brands — reducing manual rework and accelerating c', NULL, 'uploads/global-specification.webp', '1', '2025-07-01 14:44:40', '2025-07-01 14:44:40');

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

-- --------------------------------------------------------

--
-- Table structure for table `tbl_value_chain_expertise`
--

CREATE TABLE `tbl_value_chain_expertise` (
  `id` int(11) NOT NULL,
  `fk_section_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `is_delete` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_value_chain_expertise`
--

INSERT INTO `tbl_value_chain_expertise` (`id`, `fk_section_id`, `title`, `description`, `is_active`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 1, 'Consumer', 'We enable packaging choices that enhance product experience, brand equity, and market competitiveness.', 1, 1, '2025-07-08 13:18:17', '2025-07-09 09:41:04'),
(2, 1, 'Brand', 'We ensure packaging aligns with real-world consumer expectations — from functionality and usability to sustainability.', 1, 1, '2025-07-08 13:18:17', '2025-07-09 09:41:04'),
(3, 1, 'Brand Owner Supply Chain', 'We optimize how packaging flows through manufacturing, warehousing, and logistics — balancing cost, agility, and carbon impact.', 1, 1, '2025-07-08 13:18:17', NULL),
(4, 1, 'Supplier Supply Chain', 'We help brands work smarter with suppliers and converters — driving material selection, lead time optimization, and supply resilience.', 1, 1, '2025-07-08 13:18:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_value_chain_section`
--

CREATE TABLE `tbl_value_chain_section` (
  `id` int(11) NOT NULL,
  `main_title` varchar(255) NOT NULL,
  `main_description` text NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `is_delete` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_value_chain_section`
--

INSERT INTO `tbl_value_chain_section` (`id`, `main_title`, `main_description`, `is_active`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, '3. End-to-End Value Chain Expertise', 'Packaging decisions impact every part of the value chain — and we understand those interconnections deeply. We bring expertise across the entire ecosystem:', 1, 1, '2025-07-08 13:18:16', '2025-07-09 09:46:31');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_video_banner`
--

CREATE TABLE `tbl_video_banner` (
  `id` bigint(20) NOT NULL,
  `fk_service_id` int(11) DEFAULT NULL,
  `video` longtext DEFAULT NULL,
  `is_delete` enum('1','0') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_video_banner`
--

INSERT INTO `tbl_video_banner` (`id`, `fk_service_id`, `video`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 1, 'uploads/packforum-usa-coverage.webm', '1', '2025-06-03 10:04:14', '2025-06-04 17:54:03');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_whitepaper_download`
--

CREATE TABLE `tbl_whitepaper_download` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `company` varchar(100) DEFAULT NULL,
  `role` varchar(100) DEFAULT NULL,
  `industry` varchar(100) DEFAULT NULL,
  `country` varchar(100) NOT NULL,
  `optin` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_why_people_choose_packfora`
--

CREATE TABLE `tbl_why_people_choose_packfora` (
  `id` bigint(20) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `image` longtext DEFAULT NULL,
  `is_delete` enum('1','0') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_why_people_choose_packfora`
--

INSERT INTO `tbl_why_people_choose_packfora` (`id`, `title`, `description`, `image`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Work Your Way', 'Whether you\'re on-site, remote, or working across time zones — flexibility is built into the way we work.', 'uploads/work-your-way.webp', '1', '2025-06-02 10:42:54', '2025-06-02 10:42:54'),
(2, 'Second Chances, Fresh Starts', 'We support professionals returning after a career break because talent doesn\'t come with an expiry date.', 'uploads/second-chances-fresh-starts.webp', '1', '2025-06-02 10:43:25', '2025-06-02 10:43:25'),
(3, 'Spousal Careers', 'We believe when one person thrives, families thrive too. That\'s why we offer dual-career opportunities for spouses and partners.', 'uploads/spousal-careers.webp', '0', '2025-06-02 10:43:47', '2025-06-23 14:52:40'),
(4, 'Performance That Gets Recognized', 'We celebrate outcomes and reward effort — with feedback, recognition, and opportunities to grow.', 'uploads/performance-that-gets-recognized.webp', '1', '2025-06-02 10:44:22', '2025-06-02 10:46:07');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_work_with_technocarts`
--

CREATE TABLE `tbl_work_with_technocarts` (
  `id` bigint(20) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `is_delete` enum('1','0') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_work_with_technocarts`
--

INSERT INTO `tbl_work_with_technocarts` (`id`, `title`, `description`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Brand Owners', 'The minds behind category-defining brands.', '1', '2025-06-02 13:48:28', '2025-06-02 13:48:28'),
(2, 'Subject Matter Experts (SMEs)', 'Technical specialists driving deep impact.', '1', '2025-06-02 13:51:02', '2025-06-02 13:51:02'),
(3, 'Producers & Converters', 'Partners who bring big ideas to life.', '1', '2025-06-02 13:52:35', '2025-06-02 13:52:35'),
(4, 'Design Houses', 'Creatives who fuse form with function.', '1', '2025-06-02 13:52:54', '2025-06-02 13:52:54'),
(5, 'Technology Leaders like Dassault Systèmes', 'Tools that keep us future-ready.', '1', '2025-06-02 13:53:16', '2025-06-26 14:39:57');

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
-- Indexes for table `tbl_blogs`
--
ALTER TABLE `tbl_blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_built_reliability`
--
ALTER TABLE `tbl_built_reliability`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_case_study`
--
ALTER TABLE `tbl_case_study`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_case_study_business_impact`
--
ALTER TABLE `tbl_case_study_business_impact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_case_study_objectives`
--
ALTER TABLE `tbl_case_study_objectives`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_case_study_solutions`
--
ALTER TABLE `tbl_case_study_solutions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_case_study_solution_header`
--
ALTER TABLE `tbl_case_study_solution_header`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_case_study_tags`
--
ALTER TABLE `tbl_case_study_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_contact_us`
--
ALTER TABLE `tbl_contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_discover_benefits`
--
ALTER TABLE `tbl_discover_benefits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_event_slider`
--
ALTER TABLE `tbl_event_slider`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `tbl_featured_speakers`
--
ALTER TABLE `tbl_featured_speakers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_global_culture`
--
ALTER TABLE `tbl_global_culture`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_global_dialogue`
--
ALTER TABLE `tbl_global_dialogue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_holistic_model_levers`
--
ALTER TABLE `tbl_holistic_model_levers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_holistic_model_sections`
--
ALTER TABLE `tbl_holistic_model_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_holistic_model_strategies`
--
ALTER TABLE `tbl_holistic_model_strategies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_how_we_do_it`
--
ALTER TABLE `tbl_how_we_do_it`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_impact_boxes`
--
ALTER TABLE `tbl_impact_boxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_impact_enabled`
--
ALTER TABLE `tbl_impact_enabled`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_impact_sections`
--
ALTER TABLE `tbl_impact_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_knowledge_centre`
--
ALTER TABLE `tbl_knowledge_centre`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_leadership_team`
--
ALTER TABLE `tbl_leadership_team`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_life_at_packfora`
--
ALTER TABLE `tbl_life_at_packfora`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_market_trends`
--
ALTER TABLE `tbl_market_trends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_optimize_image`
--
ALTER TABLE `tbl_optimize_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_optimize_packaging`
--
ALTER TABLE `tbl_optimize_packaging`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_our_leaders`
--
ALTER TABLE `tbl_our_leaders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_our_offering`
--
ALTER TABLE `tbl_our_offering`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_our_promise`
--
ALTER TABLE `tbl_our_promise`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pillars_intro`
--
ALTER TABLE `tbl_pillars_intro`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_resourcing_model`
--
ALTER TABLE `tbl_resourcing_model`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_science_backed`
--
ALTER TABLE `tbl_science_backed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_services`
--
ALTER TABLE `tbl_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_service_banner_video`
--
ALTER TABLE `tbl_service_banner_video`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_shine_with_us`
--
ALTER TABLE `tbl_shine_with_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_slider`
--
ALTER TABLE `tbl_slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_smart_to_circular`
--
ALTER TABLE `tbl_smart_to_circular`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_story_behind_maxmold`
--
ALTER TABLE `tbl_story_behind_maxmold`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_student_talent_economy`
--
ALTER TABLE `tbl_student_talent_economy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_success_stories`
--
ALTER TABLE `tbl_success_stories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_value_chain_expertise`
--
ALTER TABLE `tbl_value_chain_expertise`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_section_id` (`fk_section_id`);

--
-- Indexes for table `tbl_value_chain_section`
--
ALTER TABLE `tbl_value_chain_section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_video_banner`
--
ALTER TABLE `tbl_video_banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_whitepaper_download`
--
ALTER TABLE `tbl_whitepaper_download`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_why_people_choose_packfora`
--
ALTER TABLE `tbl_why_people_choose_packfora`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_work_with_technocarts`
--
ALTER TABLE `tbl_work_with_technocarts`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `current_opening`
--
ALTER TABLE `current_opening`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `our_clients`
--
ALTER TABLE `our_clients`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `tbl_blogs`
--
ALTER TABLE `tbl_blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_built_reliability`
--
ALTER TABLE `tbl_built_reliability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_case_study`
--
ALTER TABLE `tbl_case_study`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_case_study_business_impact`
--
ALTER TABLE `tbl_case_study_business_impact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_case_study_objectives`
--
ALTER TABLE `tbl_case_study_objectives`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_case_study_solutions`
--
ALTER TABLE `tbl_case_study_solutions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_case_study_solution_header`
--
ALTER TABLE `tbl_case_study_solution_header`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_case_study_tags`
--
ALTER TABLE `tbl_case_study_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_contact_us`
--
ALTER TABLE `tbl_contact_us`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_discover_benefits`
--
ALTER TABLE `tbl_discover_benefits`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_event_slider`
--
ALTER TABLE `tbl_event_slider`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_featured_speakers`
--
ALTER TABLE `tbl_featured_speakers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_global_culture`
--
ALTER TABLE `tbl_global_culture`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_global_dialogue`
--
ALTER TABLE `tbl_global_dialogue`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_holistic_model_levers`
--
ALTER TABLE `tbl_holistic_model_levers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_holistic_model_sections`
--
ALTER TABLE `tbl_holistic_model_sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_holistic_model_strategies`
--
ALTER TABLE `tbl_holistic_model_strategies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_how_we_do_it`
--
ALTER TABLE `tbl_how_we_do_it`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_impact_boxes`
--
ALTER TABLE `tbl_impact_boxes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_impact_enabled`
--
ALTER TABLE `tbl_impact_enabled`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_impact_sections`
--
ALTER TABLE `tbl_impact_sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_knowledge_centre`
--
ALTER TABLE `tbl_knowledge_centre`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_leadership_team`
--
ALTER TABLE `tbl_leadership_team`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_life_at_packfora`
--
ALTER TABLE `tbl_life_at_packfora`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_market_trends`
--
ALTER TABLE `tbl_market_trends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_optimize_image`
--
ALTER TABLE `tbl_optimize_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_optimize_packaging`
--
ALTER TABLE `tbl_optimize_packaging`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_our_leaders`
--
ALTER TABLE `tbl_our_leaders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_our_offering`
--
ALTER TABLE `tbl_our_offering`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_our_promise`
--
ALTER TABLE `tbl_our_promise`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_pillars_intro`
--
ALTER TABLE `tbl_pillars_intro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_resourcing_model`
--
ALTER TABLE `tbl_resourcing_model`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_science_backed`
--
ALTER TABLE `tbl_science_backed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_services`
--
ALTER TABLE `tbl_services`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_service_banner_video`
--
ALTER TABLE `tbl_service_banner_video`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_shine_with_us`
--
ALTER TABLE `tbl_shine_with_us`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_slider`
--
ALTER TABLE `tbl_slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_smart_to_circular`
--
ALTER TABLE `tbl_smart_to_circular`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_story_behind_maxmold`
--
ALTER TABLE `tbl_story_behind_maxmold`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_student_talent_economy`
--
ALTER TABLE `tbl_student_talent_economy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_success_stories`
--
ALTER TABLE `tbl_success_stories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_value_chain_expertise`
--
ALTER TABLE `tbl_value_chain_expertise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_value_chain_section`
--
ALTER TABLE `tbl_value_chain_section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_video_banner`
--
ALTER TABLE `tbl_video_banner`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_whitepaper_download`
--
ALTER TABLE `tbl_whitepaper_download`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_why_people_choose_packfora`
--
ALTER TABLE `tbl_why_people_choose_packfora`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_work_with_technocarts`
--
ALTER TABLE `tbl_work_with_technocarts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_case_study_objectives`
--
ALTER TABLE `tbl_case_study_objectives`
  ADD CONSTRAINT `tbl_case_study_objectives_ibfk_1` FOREIGN KEY (`fk_case_study_id`) REFERENCES `tbl_case_study` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_value_chain_expertise`
--
ALTER TABLE `tbl_value_chain_expertise`
  ADD CONSTRAINT `tbl_value_chain_expertise_ibfk_1` FOREIGN KEY (`fk_section_id`) REFERENCES `tbl_value_chain_section` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
