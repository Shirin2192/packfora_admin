-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2025 at 02:41 PM
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
(10, 3, 'Supply Chain Resilience', 'Improved adaptability to market shifts and disruptions.', 'uploads/supply-chain-resilience.png', '1', '2025-06-06 10:52:58', '2025-06-06 10:54:35');

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
(3, 'Culture', 'Diverse, inclusive, and deeply collaborative', 'uploads/culture.png', '1', '2025-06-02 12:21:10', '2025-06-02 13:41:19');

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
-- Table structure for table `tbl_life_at_packfora`
--

CREATE TABLE `tbl_life_at_packfora` (
  `id` int(11) NOT NULL,
  `video` varchar(255) DEFAULT NULL,
  `is_delete` enum('1','0') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_life_at_packfora`
--

INSERT INTO `tbl_life_at_packfora` (`id`, `video`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'uploads/cherrie3.mp4', '1', '2025-06-02 14:38:36', '2025-06-02 14:39:00'),
(2, 'uploads/joel.mp4', '1', '2025-06-02 14:48:07', '2025-06-02 14:48:07'),
(3, 'uploads/sheryll.mp4', '1', '2025-06-02 14:48:14', '2025-06-02 14:48:14'),
(4, 'uploads/supriya.mp4', '1', '2025-06-02 14:48:25', '2025-06-02 14:48:25'),
(5, 'uploads/Aries.mp4', '1', '2025-06-02 14:48:32', '2025-06-02 14:48:32'),
(6, 'uploads/tom_mp4.mp4', '1', '2025-06-02 14:48:47', '2025-06-02 16:08:36');

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
-- Table structure for table `tbl_our_leaders`
--

CREATE TABLE `tbl_our_leaders` (
  `id` int(11) NOT NULL,
  `fk_service_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `image` longtext DEFAULT NULL,
  `is_delete` enum('1','0') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_our_leaders`
--

INSERT INTO `tbl_our_leaders` (`id`, `fk_service_id`, `name`, `designation`, `image`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 1, 'Annette Black', 'Packaging Engineer', 'uploads/team-011.webp', '1', '2025-06-04 16:56:15', '2025-06-04 16:56:15'),
(2, 1, 'Annette Blacka', 'Packaging Engineer', 'uploads/team-02.webp', '1', '2025-06-04 17:02:13', '2025-06-04 17:02:13'),
(3, 1, 'Annette Blackaa', 'Packaging Engineer', 'uploads/team-03.webp', '1', '2025-06-04 17:02:49', '2025-06-04 17:02:49'),
(4, 1, 'Annette Blackaasss', 'Packaging Engineer', 'uploads/team-04.webp', '1', '2025-06-04 17:03:48', '2025-06-04 17:14:28');

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
(11, 3, 'Manufacturing Excellence', 'Lean Transformations Site Master Planning Demand Vs Capacity Analysis De-Bottlenecking', 'uploads/manufacturing-excellence.webp', '1', '2025-06-06 10:01:41', '2025-06-06 10:06:37'),
(12, 3, 'Packaging Automation', 'Packaging Technology Selection Material - Machine Interface Affordable Automation Installation & Line Trials', 'uploads/packaging-automation.webp', '1', '2025-06-06 10:03:05', '2025-06-06 10:03:05'),
(13, 3, 'Industrial Digitization', 'Advanced QMS Simulation Solutions Real Time Visualization Virtual Reality in Packaging', 'uploads/industrial-digitization.webp', '1', '2025-06-06 10:03:36', '2025-06-06 10:03:36'),
(14, 3, 'End-to-End Management', 'Business Cases Project Management And Control Make vs Source Load Ability Analysis', 'uploads/end-to-end-management.webp', '1', '2025-06-06 10:04:01', '2025-06-06 10:05:58');

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
-- Table structure for table `tbl_services`
--

CREATE TABLE `tbl_services` (
  `id` bigint(20) NOT NULL,
  `service_name` varchar(100) DEFAULT NULL,
  `is_delete` enum('1','0') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_services`
--

INSERT INTO `tbl_services` (`id`, `service_name`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Talent Flex', '1', '2025-06-04 09:52:14', '2025-06-04 09:52:22'),
(2, 'Sustainability', '1', '2025-06-04 09:52:14', '2025-06-04 09:52:26'),
(3, 'Supply Chain Automation', '1', '2025-06-04 09:52:14', '2025-06-04 09:52:29'),
(4, 'Product Innovation', '1', '2025-06-04 09:52:14', '2025-06-04 09:52:33'),
(5, 'Design to Value', '1', '2025-06-04 09:52:14', '2025-06-04 09:52:40'),
(6, 'Mold Management', '1', '2025-06-04 09:54:05', '2025-06-04 09:54:05'),
(7, 'Packaging Innovation & Engineering', '1', '2025-06-04 09:54:05', '2025-06-04 09:54:05'),
(8, 'Packaging Procurement', '1', '2025-06-04 09:54:05', '2025-06-04 09:54:05'),
(9, 'Specification Managemen', '1', '2025-06-04 09:54:05', '2025-06-04 09:54:05');

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
(2, 2, 'Sustainability', 'Sustainability is the New Core of Packaging', 'Stricter regulations, plastic bans, and growing demand for eco-friendly products are reshaping packaging industry sustainability is not just a requirement, but also a competitive advantage. We help you stay ahead with smart, sustainable solutions that drive growth while protecting the planet.', 'uploads/sustainability.mp4', '1', '2025-06-05 09:15:54', '2025-06-05 09:18:17'),
(3, 3, 'Supply Chain Automation', 'Automate. Streamline. Optimize.', 'Supply Chain Automation is designed to simplify and enhance the entire supply chain process, from procurement to delivery. By integrating advanced automation technology, we enable businesses to operate with greater speed, efficiency, and precision across all levels of their supply chain.', 'uploads/supply-chain-automation.mp4', '1', '2025-06-05 15:16:25', '2025-06-05 15:17:04');

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
(3, 2, 'Transforming Fresh Produce Packaging: How a Global Brand Reduced Waste & Maximized Shelf Life', NULL, 'uploads/transform.webp', '1', '2025-06-05 14:53:26', '2025-06-05 14:53:26'),
(4, 2, 'Global Spirits Leader Cuts Packaging Waste & Boosts Sustainability Without Compromising Luxury', NULL, 'uploads/global-spirit.webp', '1', '2025-06-05 14:56:50', '2025-06-05 14:56:50'),
(5, 2, 'Revolutionizing Personal Care Packaging: A Sustainability Breakthrough for a Global FMCG Giant', NULL, 'uploads/personal-care.webp', '1', '2025-06-05 14:57:12', '2025-06-05 14:57:12'),
(6, 2, 'Navigating Africa\'s Evolving Packaging Regulations: A Compliance Success Story', NULL, 'uploads/africa.webp', '1', '2025-06-05 14:57:44', '2025-06-05 14:57:44'),
(7, 3, 'Adhesive Supply Chain Technology & Investment Choices', 'A Market Leader in Adhesives wanted to develop Supply Chain Automation plan to increase production capabilities and revamp existing packaging operations for achieving end-to-end value chain unlock.', 'uploads/adhesive-SC-technology-and-investment-choices.webp', '1', '2025-06-06 14:57:22', '2025-06-06 15:25:11'),
(8, 3, 'F&B Packaging Operations', 'A leading coffee manufacturer wanted to streamline the existing packaging operations, enhance productivity & reduce labor intensive operations.', 'uploads/FB-packaging-operations.webp', '1', '2025-06-06 15:02:34', '2025-06-06 15:24:17');

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
(3, 'Spousal Careers', 'We believe when one person thrives, families thrive too. That\'s why we offer dual-career opportunities for spouses and partners.', 'uploads/spousal-careers.webp', '1', '2025-06-02 10:43:47', '2025-06-02 10:43:47'),
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
(5, 'Technology Leaders like Dassault Systèmes', 'Tools that keep us future-ready.', '1', '2025-06-02 13:53:16', '2025-06-02 13:53:16');

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
-- Indexes for table `tbl_resourcing_model`
--
ALTER TABLE `tbl_resourcing_model`
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
-- Indexes for table `tbl_smart_to_circular`
--
ALTER TABLE `tbl_smart_to_circular`
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
-- Indexes for table `tbl_video_banner`
--
ALTER TABLE `tbl_video_banner`
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
-- AUTO_INCREMENT for table `tbl_discover_benefits`
--
ALTER TABLE `tbl_discover_benefits`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
-- AUTO_INCREMENT for table `tbl_our_leaders`
--
ALTER TABLE `tbl_our_leaders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_our_offering`
--
ALTER TABLE `tbl_our_offering`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_resourcing_model`
--
ALTER TABLE `tbl_resourcing_model`
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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_shine_with_us`
--
ALTER TABLE `tbl_shine_with_us`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_smart_to_circular`
--
ALTER TABLE `tbl_smart_to_circular`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_student_talent_economy`
--
ALTER TABLE `tbl_student_talent_economy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_success_stories`
--
ALTER TABLE `tbl_success_stories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_video_banner`
--
ALTER TABLE `tbl_video_banner`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
