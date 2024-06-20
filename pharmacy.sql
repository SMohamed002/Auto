-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2024 at 10:57 PM
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
-- Database: `pharmacy`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT sysdate(),
  `deleted` char(1) NOT NULL DEFAULT 'N',
  `qty` double NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `item_id`, `client_id`, `created_at`, `deleted`, `qty`, `updated_at`) VALUES
(6, 4, 3, '2024-05-14 06:28:00', 'Y', 3, NULL),
(7, 5, 3, '2024-05-14 06:58:24', 'Y', 2, NULL),
(8, 11, 3, '2024-05-14 06:58:48', 'Y', 2, NULL),
(9, 6, 3, '2024-05-14 08:17:56', 'Y', 1, NULL),
(10, 8, 3, '2024-05-14 08:18:04', 'Y', 2, NULL),
(11, 7, 3, '2024-05-14 10:03:32', 'Y', 1, '2024-05-14 11:27:42'),
(12, 5, 3, '2024-05-14 10:03:33', 'Y', 4, '2024-05-14 11:27:42'),
(13, 9, 4, '2024-05-14 14:31:45', 'Y', 12, NULL),
(14, 5, 4, '2024-05-14 14:31:47', 'Y', 2, NULL),
(15, 5, 4, '2024-05-14 14:33:41', 'Y', 10, '2024-05-14 14:33:45'),
(16, 11, 5, '2024-05-14 14:51:28', 'Y', 2, '2024-05-14 14:54:22'),
(17, 8, 5, '2024-05-14 14:51:38', 'Y', 1, NULL),
(18, 9, 5, '2024-05-14 14:52:38', 'Y', 5, '2024-05-14 14:54:22'),
(19, 4, 5, '2024-05-14 14:52:59', 'Y', 1, NULL),
(20, 4, 5, '2024-05-14 14:53:42', 'Y', 1, '2024-05-14 14:54:22'),
(21, 9, 3, '2024-05-17 21:10:15', 'Y', 1, '2024-05-17 21:10:55'),
(22, 4, 3, '2024-05-17 21:11:09', 'Y', 1, '2024-05-17 23:53:39'),
(23, 5, 3, '2024-05-17 21:11:12', 'Y', 1, '2024-05-17 23:53:38'),
(24, 6, 3, '2024-05-17 21:11:13', 'Y', 1, '2024-05-17 23:56:49'),
(25, 10, 3, '2024-05-17 21:11:18', 'Y', 92, '2024-05-17 21:21:26');

-- --------------------------------------------------------

--
-- Table structure for table `cats`
--

CREATE TABLE `cats` (
  `id` int(11) NOT NULL,
  `name` varchar(350) NOT NULL,
  `notes` text DEFAULT NULL,
  `deleted` char(1) NOT NULL DEFAULT 'N',
  `created_at` datetime NOT NULL DEFAULT sysdate(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cats`
--

INSERT INTO `cats` (`id`, `name`, `notes`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 'dfkgjh', '', 'Y', '2024-05-14 01:57:31', '2024-05-14 03:09:03'),
(2, 'gfhkjfgkh', '', 'Y', '2024-05-14 01:57:32', '2024-05-14 01:58:08'),
(3, 'sdfgdfg', '', 'Y', '2024-05-14 02:09:00', '2024-05-14 03:09:00'),
(4, 'ghukkghfjghj', '', 'Y', '2024-05-14 02:09:04', '2024-05-14 03:08:58'),
(5, 'Group 1', '', 'N', '2024-05-14 03:09:34', NULL),
(6, 'Group 2', '', 'N', '2024-05-14 03:09:36', '2024-05-17 21:37:43'),
(7, 'Group 3', '', 'N', '2024-05-14 03:13:56', NULL),
(8, 'Group 4', '', 'N', '2024-05-14 03:14:38', NULL),
(9, 'Group 5', '', 'N', '2024-05-14 14:24:27', NULL),
(10, 'Group 6', '', 'N', '2024-05-14 14:43:21', '2024-05-17 21:37:35');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `f_name` varchar(150) DEFAULT NULL,
  `l_name` varchar(150) DEFAULT NULL,
  `username` varchar(350) DEFAULT NULL,
  `pass` varchar(550) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `deleted` char(1) NOT NULL DEFAULT 'N',
  `blocled` char(1) NOT NULL DEFAULT 'N',
  `created_at` datetime NOT NULL DEFAULT sysdate(),
  `updated_at` datetime DEFAULT NULL,
  `email` varchar(750) DEFAULT NULL,
  `blocked` char(1) NOT NULL DEFAULT 'N',
  `phone` varchar(25) DEFAULT NULL,
  `govern` varchar(600) DEFAULT NULL,
  `city` varchar(720) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `mob` varchar(25) DEFAULT NULL,
  `add_mob` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `f_name`, `l_name`, `username`, `pass`, `notes`, `deleted`, `blocled`, `created_at`, `updated_at`, `email`, `blocked`, `phone`, `govern`, `city`, `address`, `mob`, `add_mob`) VALUES
(3, 'Admin', 'User', 'admin', '$2y$10$F.AUIq/vUy7u9CpAI.HU9OrlsYhwBRcu6egHVJUrYizp0bvlXUT1.', '', 'N', 'N', '2024-05-14 05:12:39', '2024-05-17 21:10:08', 'admin@admin.com', 'N', '54514514515', 'Giza', 'Haram', 'Address AddressAddress', '655465461514', ''),
(4, 'new', 'Client', 'client', '$2y$10$n5tgvxKgiL.nH8sZOCBH1ubw109WhaL.yaBqiFiVCV8nCbm.PZbbu', '', 'N', 'N', '2024-05-14 14:29:22', '2024-05-14 14:30:38', 'client', 'N', NULL, 'Giza', 'Haram', 'Haram, Giza , Egypt', '54564564565', ''),
(5, 'client', 'new', 'newclient', '$2y$10$6JCtRvah01OS0ZI2sUNF2.XOcJpdF3SNMK0Nx716F42F2Rx8JUAKS', '', 'N', 'N', '2024-05-14 14:49:19', '2024-05-14 14:54:17', 'new', 'N', NULL, 'Giza', 'Haram', 'Giza, Haram , Egypt', '54965456454', ''),
(6, 'dfg', 'dfg', 'sdfs', '$2y$10$F.AUIq/vUy7u9CpAI.HU9OrlsYhwBRcu6egHVJUrYizp0bvlXUT1.', NULL, 'N', 'N', '2024-06-06 01:32:46', NULL, 'dfgh@dghffgh.cg', 'N', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(350) NOT NULL,
  `email` varchar(650) NOT NULL,
  `phone` varchar(450) NOT NULL,
  `msg` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT sysdate(),
  `deleted` char(1) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `phone`, `msg`, `created_at`, `deleted`) VALUES
(3, 'فلان الفلاني', 'mail@mail.com', '05644564567', 'Comment or Message', '2024-05-14 14:28:51', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `job_title` varchar(550) NOT NULL,
  `img_path` varchar(650) NOT NULL,
  `img_name` varchar(350) NOT NULL,
  `fb_link` varchar(1500) DEFAULT NULL,
  `x_link` varchar(1500) DEFAULT NULL,
  `insta_link` varchar(1500) DEFAULT NULL,
  `wp_link` varchar(1500) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `deleted` char(1) NOT NULL DEFAULT 'N',
  `created_at` datetime NOT NULL DEFAULT sysdate(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `name`, `job_title`, `img_path`, `img_name`, `fb_link`, `x_link`, `insta_link`, `wp_link`, `notes`, `deleted`, `created_at`, `updated_at`) VALUES
(9, 'Dr. Reem Skaik', 'Specialist of Oral and Dental Medicine and Cosmetic Dentistry - USA', '/uploads/doctors/9/1715623204.jpg', 'doctor-reem.jpg', '', '', '', '', '', 'Y', '2024-05-13 00:00:00', '2024-05-14 14:23:01'),
(10, 'Dr. Karim Al-Jamal', 'Dentist', '/uploads/doctors/10/1715623223.jpg', 'ourteam-1.jpg', '', '', '', '', '', 'N', '2024-05-13 00:00:00', NULL),
(11, 'Dr. Laura Martiniz', 'Pharmatic', '/uploads/doctors/11/1715623244.jpg', 'ourteam-4.jpg', '', '', '', '', '', 'N', '2024-05-13 00:00:00', NULL),
(12, 'Drs. Amany', 'Midical Assistant', '/uploads/doctors/12/1715623256.jpg', 'ourteam-3.jpg', '', '', '', '', '', 'N', '2024-05-13 00:00:00', '2024-05-13 22:15:58'),
(13, 'dfjghlkjdgfh', 'klj;jkl', '/uploads/doctors/13/1715636748.jpg', '31-18-scaled.jpg', '', '', '', '', '', 'Y', '2024-05-14 00:45:48', '2024-05-14 00:47:43'),
(14, 'dfjghlkjdgfh', 'klj;jkl', '/uploads/doctors/14/1715636748.jpg', '31-18-scaled.jpg', '', '', '', '', '', 'Y', '2024-05-14 00:45:48', '2024-05-14 00:47:41'),
(15, 'dfgjh', 'fghjfghj', '/uploads/doctors/15/1715636871.jpg', 'Amaryl.jpg', '', '', '', '', '', 'Y', '2024-05-14 00:47:51', '2024-05-14 00:48:25'),
(16, 'dfkjgh', 'fghjgfhj', '/uploads/doctors/16/1715636899.jpg', 'Gast-Reg.jpg', '', '', '', '', 'ghkjkjl', 'Y', '2024-05-14 00:48:19', '2024-05-14 00:48:23'),
(17, 'jjkl', 'fghjgfhj', '/uploads/doctors/17/1715638313.jpg', 'll.jpg', '', '', '', '', 'hmhgkj', 'Y', '2024-05-14 00:53:39', '2024-05-14 01:12:02'),
(18, 'fgkhjhgjhj', 'dfgdfgh', '/uploads/doctors/18/1715641487.jpg', '19f637d9-0274-0d70-bf9f-e390a21bea02.jpg', '', '', '', '', 'fghghj', 'Y', '2024-05-14 02:02:39', '2024-05-14 02:04:51'),
(19, 'hj;lh;l', 'ghkjhj', '/uploads/doctors/19/1715641501.jpg', 'AUGMENTIN.jpg', 'fghfghj', 'cghgfhj', 'fghjfhj', '567678789545', 'fghjghkj\r\n', 'Y', '2024-05-14 02:05:01', '2024-05-14 02:08:18'),
(20, 'Anoth Doctor', 'Dentist', '/uploads/doctors/20/1715686843.jpg', 'Gast-Reg.jpg', '', '', '', '', '', 'Y', '2024-05-14 14:23:31', '2024-05-14 14:40:58');

-- --------------------------------------------------------

--
-- Table structure for table `news_emails`
--

CREATE TABLE `news_emails` (
  `id` int(11) NOT NULL,
  `email` varchar(950) NOT NULL,
  `deleted` char(1) NOT NULL DEFAULT 'N',
  `created_at` datetime NOT NULL DEFAULT sysdate(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `news_emails`
--

INSERT INTO `news_emails` (`id`, `email`, `deleted`, `created_at`, `updated_at`) VALUES
(6, 'me@me.com', 'N', '2024-05-13 16:45:22', NULL),
(7, 'mohab@mai.cmo', 'N', '2024-05-14 01:37:34', NULL),
(8, 'gf@hdgf.com', 'N', '2024-05-14 01:41:01', NULL),
(9, 'dfg@df.co', 'N', '2024-05-14 01:41:19', NULL),
(10, 'fgh@fg.com', 'N', '2024-05-14 01:41:21', NULL),
(11, 'dhgf@dnfbfhjg.com', 'N', '2024-05-14 01:41:25', NULL),
(12, 'kghffj@fkgj.com', 'N', '2024-05-14 01:41:28', NULL),
(13, 'fhgH@dfkg.com', 'N', '2024-05-14 01:41:31', NULL),
(14, 'dfgdfgh@fgkj.com', 'N', '2024-05-14 01:41:37', NULL),
(15, 'kdfgjdfkj@dfjgh.com', 'N', '2024-05-14 01:41:43', NULL),
(16, 'dfgfk@dfkgjk.com', 'N', '2024-05-14 01:41:51', NULL),
(17, 'medfg@me.com', 'N', '2024-05-14 14:28:06', NULL),
(18, 'dhfgdfkjgme@me.com', 'N', '2024-05-14 14:46:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders_dt`
--

CREATE TABLE `orders_dt` (
  `id` int(11) NOT NULL,
  `hd_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `qty` double NOT NULL,
  `price` double NOT NULL,
  `item_name` varchar(650) NOT NULL,
  `deleted` char(1) NOT NULL DEFAULT 'N',
  `cncld` char(1) NOT NULL DEFAULT 'N',
  `created_at` datetime NOT NULL DEFAULT sysdate(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `orders_dt`
--

INSERT INTO `orders_dt` (`id`, `hd_id`, `item_id`, `qty`, `price`, `item_name`, `deleted`, `cncld`, `created_at`, `updated_at`) VALUES
(1, 3, 7, 1, 149, 'Camphoplex', 'N', 'N', '2024-05-14 11:27:42', NULL),
(2, 3, 5, 4, 354, 'Elbaluran', 'N', 'N', '2024-05-14 11:27:42', NULL),
(3, 4, 5, 10, 354, 'Elbaluran', 'N', 'N', '2024-05-14 14:33:45', NULL),
(4, 5, 11, 2, 68, 'Tegretol CR', 'N', 'N', '2024-05-14 14:54:22', NULL),
(5, 5, 9, 5, 28.5, 'Sanolifox', 'N', 'N', '2024-05-14 14:54:22', NULL),
(6, 5, 4, 1, 99, 'Hypercapt', 'N', 'N', '2024-05-14 14:54:22', NULL),
(7, 6, 6, 1, 70, 'Deviart Zinc', 'N', 'N', '2024-05-17 23:56:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders_hd`
--

CREATE TABLE `orders_hd` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `doc_date` date NOT NULL DEFAULT sysdate(),
  `payer` varchar(950) NOT NULL,
  `govern` varchar(350) NOT NULL,
  `city` varchar(450) NOT NULL,
  `mob` varchar(25) NOT NULL,
  `add_mob` varchar(25) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT sysdate(),
  `updated_at` datetime DEFAULT NULL,
  `deleted` char(1) NOT NULL DEFAULT 'N',
  `cncld` char(1) NOT NULL DEFAULT 'N',
  `address` varchar(950) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `orders_hd`
--

INSERT INTO `orders_hd` (`id`, `client_id`, `doc_date`, `payer`, `govern`, `city`, `mob`, `add_mob`, `notes`, `created_at`, `updated_at`, `deleted`, `cncld`, `address`) VALUES
(3, 3, '2024-05-14', 'Admin User', 'Giza', 'Haram', '655465461514', '', NULL, '2024-05-14 11:27:42', '2024-05-14 12:52:11', 'N', 'N', NULL),
(4, 4, '2024-05-14', 'new Client', 'Giza', 'Haram', '54564564565', '', NULL, '2024-05-14 14:33:45', '2024-05-14 14:34:27', 'N', 'Y', 'Haram, Giza , Egypt'),
(5, 5, '2024-05-14', 'client new', 'Giza', 'Haram', '54965456454', '', NULL, '2024-05-14 14:54:21', NULL, 'N', 'N', 'Giza, Haram , Egypt'),
(6, 3, '2024-05-17', 'Admin User', 'Giza', 'Haram', '655465461514', '', NULL, '2024-05-17 23:56:49', NULL, 'N', 'N', 'Address AddressAddress');

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `id` int(11) NOT NULL,
  `file_name` varchar(450) DEFAULT NULL,
  `file_path` varchar(950) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT sysdate(),
  `updated_at` datetime DEFAULT NULL,
  `deleted` char(1) NOT NULL DEFAULT 'N',
  `notes` text DEFAULT NULL,
  `is_ordered` char(1) NOT NULL DEFAULT 'N',
  `is_done` char(1) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`id`, `file_name`, `file_path`, `created_at`, `updated_at`, `deleted`, `notes`, `is_ordered`, `is_done`) VALUES
(2, '19f637d9-0274-0d70-bf9f-e390a21bea02.jpg', '/uploads/prescriptions/2/1715672528.jpg', '2024-05-14 10:42:08', '2024-05-14 10:48:01', 'Y', 'ghjghjghk', 'N', 'N'),
(3, 'brand-2.png', '/uploads/prescriptions/3/1715672546.png', '2024-05-14 10:42:26', '2024-05-14 10:47:56', 'Y', '', 'N', 'N'),
(4, 'Betaserc.jpg', '/uploads/prescriptions/4/1715672887.jpg', '2024-05-14 10:48:07', '2024-05-14 10:48:14', 'Y', 'hgfghjdhjdfghj', 'N', 'N'),
(5, 'Amaryl.jpg', '/uploads/prescriptions/5/1715686255.jpg', '2024-05-14 14:30:55', '2024-05-14 14:51:09', 'Y', '', 'N', 'N'),
(6, 'apteka.jpg', '/uploads/prescriptions/6/1715686271.jpg', '2024-05-14 14:31:11', '2024-05-14 14:51:11', 'Y', 'روشتة الدكتور', 'N', 'N'),
(7, 'AUGMENTIN.jpg', '/uploads/prescriptions/7/1715687441.jpg', '2024-05-14 14:50:41', '2024-05-14 14:51:00', 'Y', 'روشتة للمراجعة\r\nسيبيبل', 'N', 'N'),
(8, '31-18-scaled-removebg-preview (1).png', '/uploads/prescriptions/8/1715687447.png', '2024-05-14 14:50:47', '2024-05-14 14:50:57', 'Y', '', 'N', 'N'),
(9, 'Screens.jpg', '/uploads/prescriptions/9/1717626788.jpg', '2024-06-06 01:33:08', '2024-06-16 23:56:10', 'N', 'hgj', 'N', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `actv_ing` varchar(650) DEFAULT NULL,
  `p_desc` text DEFAULT NULL,
  `price` double NOT NULL,
  `dose` varchar(350) DEFAULT NULL,
  `img_path` varchar(950) DEFAULT NULL,
  `img_path_p` varchar(950) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `deleted` char(1) NOT NULL DEFAULT 'N',
  `created_at` datetime NOT NULL DEFAULT sysdate(),
  `updated_at` datetime DEFAULT NULL,
  `cat_id` int(11) NOT NULL,
  `img_name` varchar(650) DEFAULT NULL,
  `img_name_p` varchar(650) DEFAULT NULL,
  `qty` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `actv_ing`, `p_desc`, `price`, `dose`, `img_path`, `img_path_p`, `notes`, `deleted`, `created_at`, `updated_at`, `cat_id`, `img_name`, `img_name_p`, `qty`) VALUES
(2, 'fgkhj', 'dfkjgh', 'dkjghgfkj\r\ndfghjhgfdh\r\ndfgkhj', 565, 'dfjhggfkjhf', '/uploads/products/2/main1715644285.jpg', '/uploads/products/2/second1715644285.jpg', 'ghhjkh', 'Y', '2024-05-14 02:51:25', '2024-05-14 02:52:06', 1, 'AUGMENTIN.jpg', 'AUGMENTIN.jpg', NULL),
(3, 'Augmantine', 'hjkhiluipo', 'hjlkji;lo;\r\nfghjfghj\r\nfdghj\r\ng', 550, 'hjfg', '/uploads/products/3/main1715645178.jpg', '/uploads/products/3/main1715645170.jpg', '', 'Y', '2024-05-14 02:52:33', '2024-05-14 03:06:22', 4, 'Flumox.jpg', '31-18-scaled.jpg', NULL),
(4, 'Hypercapt', '', '', 99, '5 mg/5 ml oral solution - 100ml', '/uploads/products/4/main1715645443.jpg', '/uploads/products/4/second1715645443.jpg', '', 'N', '2024-05-14 03:10:43', NULL, 5, 'product1 (1).jpg', 'product1 (1).jpg', NULL),
(5, 'Elbaluran', '', '', 354, '60 mg - 30 Tab Coated', '/uploads/products/5/main1715645488.jpg', '/uploads/products/5/second1715645488.jpg', '', 'N', '2024-05-14 03:11:28', NULL, 6, 'product2 (1).jpg', 'product2 (1).jpg', NULL),
(6, 'Deviart Zinc', '', '', 70, '50 mg - 30pcs', '/uploads/products/6/main1715645578.jpg', '/uploads/products/6/second1715645578.jpg', '', 'N', '2024-05-14 03:12:58', '2024-05-17 23:55:03', 5, 'product3 (1).jpg', 'product3 (1).jpg', 0),
(7, 'Camphoplex', '', 'Massage Spray - 150 Ml\r\nMassage Spray - 150 Ml\r\nMassage Spray - 150 Ml\r\nCamphoplex\r\nCamphoplex', 149, 'Massage Spray - 150 Ml', '/uploads/products/7/main1715645618.jpg', '/uploads/products/7/second1715645618.jpg', '', 'N', '2024-05-14 03:13:37', NULL, 5, 'product4 (1).jpg', 'product4 (1).jpg', NULL),
(8, 'Senseplex', '', '', 59, 'Mouthwash -250ml', '/uploads/products/8/main1715645668.jpg', '/uploads/products/8/second1715645668.jpg', '', 'N', '2024-05-14 03:14:28', NULL, 7, 'product5 (1).jpg', 'product5 (1).jpg', NULL),
(9, 'Sanolifox', '', '', 28.5, '15mg/ml-5ml', '/uploads/products/9/main1715645715.jpg', '/uploads/products/9/second1715645715.jpg', '', 'N', '2024-05-14 03:15:15', NULL, 8, 'product6 (1).jpg', 'product6 (1).jpg', NULL),
(10, 'Panadol Advance', '', '', 62, '500mg 48pcs with enteric coating', '/uploads/products/10/main1715645746.jpg', '/uploads/products/10/second1715645746.jpg', '', 'N', '2024-05-14 03:15:46', '2024-05-17 21:21:11', 8, 'product7 (1).jpg', 'product7 (1).jpg', 55),
(11, 'Tegretol CR', '', '', 68, '400 mg 20/Pieces', '/uploads/products/11/main1715645796.jpg', '/uploads/products/11/second1715645796.jpg', '', 'N', '2024-05-14 03:16:36', '2024-05-17 21:09:26', 7, 'product8 (1).jpg', 'product8 (1).jpg', 520);

-- --------------------------------------------------------

--
-- Table structure for table `rate_us`
--

CREATE TABLE `rate_us` (
  `id` int(11) NOT NULL,
  `name` varchar(350) NOT NULL,
  `stars` int(11) NOT NULL,
  `msg` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT sysdate(),
  `deleted` char(1) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `rate_us`
--

INSERT INTO `rate_us` (`id`, `name`, `stars`, `msg`, `created_at`, `deleted`) VALUES
(6, 'Lamiaa Ezzat', 5, 'The excellent doctor... very, very smart and completely immaterial.', '2024-05-14 10:10:57', 'N'),
(7, 'Nelly Hossam', 5, 'The offers you can get here are beyond what other platforms offer. Customer service, including returns,\r\n              is also very convenient.', '2024-05-14 10:11:19', 'N'),
(8, 'Zena Eslam', 5, 'Respected, calm and intelligent doctor.', '2024-05-14 10:11:29', 'N'),
(9, 'Mariam Hamed', 5, 'Doctor Aya is the one who treated me she is really good the prices are slightly high but they are worth it.', '2024-05-14 10:11:47', 'N'),
(10, 'Nehal Omran', 5, 'A good, respectful and understanding doctor.', '2024-05-14 10:11:56', 'N'),
(11, 'Radwa Mohamed', 5, 'Wonderful doctor.', '2024-05-14 10:12:07', 'N'),
(12, 'Lana Saad', 5, 'After a lot of research, I am the best doctor in Egypt.', '2024-05-14 10:12:18', 'N'),
(13, 'Fatma Tarek', 5, 'The excellent doctor... very, very smart and completely immaterial.', '2024-05-14 10:12:30', 'N'),
(14, 'Omnia Ahmed', 5, 'Good and comfortable doctor.', '2024-05-14 10:12:41', 'N'),
(15, 'Zenab Diaa', 5, 'Excellent doctor.', '2024-05-14 10:12:58', 'N'),
(16, 'Lana Saad', 5, 'The welcoming staff were very helpful and pleasant.\r\nDr. Ahmed is super professional and super nice.', '2024-05-14 10:13:09', 'N'),
(17, 'فلان الفلاني', 3, 'موقع حلو', '2024-05-14 14:27:20', 'N'),
(18, 'انا شخص ما', 4, 'تقييم للموقع', '2024-05-14 14:47:32', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `email` varchar(650) DEFAULT NULL,
  `phone` varchar(25) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `deleted` char(1) NOT NULL DEFAULT 'N',
  `created_at` datetime NOT NULL DEFAULT sysdate(),
  `updated_at` datetime DEFAULT NULL,
  `pass` varchar(650) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `phone`, `notes`, `deleted`, `created_at`, `updated_at`, `pass`) VALUES
(1, 'admin', 'admin@admin.com', '', '', 'N', '2024-05-13 16:19:35', '2024-05-17 21:54:50', '$2y$10$JOL8yM8Z3nQBLRGvdoG13eH7.PrmTqXJ1/csmMoHs6ZuegBLwk57m');

-- --------------------------------------------------------

--
-- Table structure for table `v_items`
--

CREATE TABLE `v_items` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT sysdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `v_items`
--

INSERT INTO `v_items` (`id`, `item_id`, `client_id`, `created_at`) VALUES
(1, 9, 3, '2024-05-14 05:20:16'),
(2, 9, 3, '2024-05-14 05:20:23'),
(3, 6, 3, '2024-05-14 05:21:14'),
(4, 4, 3, '2024-05-14 05:39:37'),
(5, 4, 3, '2024-05-14 05:39:45'),
(6, 4, 3, '2024-05-14 05:40:31'),
(7, 4, 3, '2024-05-14 05:41:27'),
(8, 4, 3, '2024-05-14 05:41:52'),
(9, 4, 3, '2024-05-14 05:46:56'),
(10, 4, 3, '2024-05-14 05:46:58'),
(11, 4, 3, '2024-05-14 05:49:57'),
(12, 4, 3, '2024-05-14 05:50:31'),
(13, 4, 3, '2024-05-14 05:50:50'),
(14, 4, 3, '2024-05-14 05:50:57'),
(15, 10, 3, '2024-05-14 05:52:05'),
(16, 10, 3, '2024-05-14 05:52:07'),
(17, 10, 3, '2024-05-14 05:52:35'),
(18, 10, 3, '2024-05-14 05:52:37'),
(19, 10, 3, '2024-05-14 05:52:38'),
(20, 10, 3, '2024-05-14 05:53:09'),
(21, 10, 3, '2024-05-14 05:58:12'),
(22, 10, 3, '2024-05-14 05:58:14'),
(23, 10, 3, '2024-05-14 05:58:16'),
(24, 10, 3, '2024-05-14 05:58:21'),
(25, 10, 3, '2024-05-14 06:05:45'),
(26, 10, 3, '2024-05-14 06:06:42'),
(27, 10, 3, '2024-05-14 06:06:57'),
(28, 10, 3, '2024-05-14 06:08:05'),
(29, 6, 3, '2024-05-14 06:08:17'),
(30, 6, 3, '2024-05-14 06:08:39'),
(31, 9, 3, '2024-05-14 06:08:43'),
(32, 8, 3, '2024-05-14 06:08:49'),
(33, 8, 3, '2024-05-14 06:08:51'),
(34, 8, 3, '2024-05-14 06:09:45'),
(35, 8, 3, '2024-05-14 06:09:49'),
(36, 8, 3, '2024-05-14 06:09:54'),
(37, 8, 3, '2024-05-14 06:10:30'),
(38, 8, 3, '2024-05-14 06:12:43'),
(39, 8, 3, '2024-05-14 06:12:49'),
(40, 8, 3, '2024-05-14 06:13:58'),
(41, 8, 3, '2024-05-14 06:14:08'),
(42, 8, 3, '2024-05-14 06:14:16'),
(43, 8, 3, '2024-05-14 06:16:11'),
(44, 8, 3, '2024-05-14 06:16:16'),
(45, 8, 3, '2024-05-14 06:16:18'),
(46, 8, 3, '2024-05-14 06:16:23'),
(47, 8, 3, '2024-05-14 06:16:54'),
(48, 8, 3, '2024-05-14 06:17:21'),
(49, 8, 3, '2024-05-14 06:17:35'),
(50, 8, 3, '2024-05-14 06:17:37'),
(51, 8, 3, '2024-05-14 06:17:40'),
(52, 8, 3, '2024-05-14 06:17:50'),
(53, 8, 3, '2024-05-14 06:19:09'),
(54, 8, 3, '2024-05-14 06:19:22'),
(55, 8, 3, '2024-05-14 06:19:37'),
(56, 8, 3, '2024-05-14 06:20:10'),
(57, 8, 3, '2024-05-14 06:20:18'),
(58, 8, 3, '2024-05-14 06:20:50'),
(59, 8, 3, '2024-05-14 06:20:52'),
(60, 8, 3, '2024-05-14 06:20:55'),
(61, 8, 3, '2024-05-14 06:21:33'),
(62, 8, 3, '2024-05-14 06:21:39'),
(63, 8, 3, '2024-05-14 06:21:42'),
(64, 8, 3, '2024-05-14 06:23:42'),
(65, 8, 3, '2024-05-14 06:23:45'),
(66, 8, 3, '2024-05-14 06:23:50'),
(67, 8, 3, '2024-05-14 06:24:22'),
(68, 8, 3, '2024-05-14 06:24:25'),
(69, 11, 3, '2024-05-14 06:24:30'),
(70, 11, 3, '2024-05-14 06:24:32'),
(71, 11, 3, '2024-05-14 06:24:33'),
(72, 4, 3, '2024-05-14 06:26:00'),
(73, 4, 3, '2024-05-14 06:26:02'),
(74, 4, 3, '2024-05-14 06:26:04'),
(75, 4, 3, '2024-05-14 06:26:06'),
(76, 4, 3, '2024-05-14 06:26:08'),
(77, 4, 3, '2024-05-14 06:26:09'),
(78, 4, 3, '2024-05-14 06:26:10'),
(79, 4, 3, '2024-05-14 06:26:11'),
(80, 4, 3, '2024-05-14 06:26:12'),
(81, 4, 3, '2024-05-14 06:26:13'),
(82, 4, 3, '2024-05-14 06:27:56'),
(83, 4, 3, '2024-05-14 06:28:00'),
(84, 4, 3, '2024-05-14 06:28:02'),
(85, 4, 3, '2024-05-14 06:28:03'),
(86, 4, 3, '2024-05-14 06:28:05'),
(87, 4, 3, '2024-05-14 06:40:17'),
(88, 4, 3, '2024-05-14 06:40:25'),
(89, 6, 3, '2024-05-14 06:40:29'),
(90, 6, 3, '2024-05-14 06:40:31'),
(91, 11, 3, '2024-05-14 06:40:36'),
(92, 11, 3, '2024-05-14 06:40:37'),
(93, 11, 3, '2024-05-14 06:40:42'),
(94, 5, 3, '2024-05-14 06:53:50'),
(95, 5, 3, '2024-05-14 06:53:52'),
(96, 4, 3, '2024-05-14 06:53:57'),
(97, 4, 3, '2024-05-14 06:53:58'),
(98, 11, 3, '2024-05-14 06:54:02'),
(99, 11, 3, '2024-05-14 06:54:04'),
(100, 7, 3, '2024-05-14 06:59:38'),
(101, 8, 3, '2024-05-14 06:59:39'),
(102, 5, 3, '2024-05-14 06:59:40'),
(103, 6, 3, '2024-05-14 06:59:41'),
(104, 7, 3, '2024-05-14 06:59:44'),
(105, 8, 3, '2024-05-14 06:59:46'),
(106, 5, 3, '2024-05-14 06:59:50'),
(107, 6, 3, '2024-05-14 06:59:56'),
(108, 5, 4, '2024-05-14 14:31:27'),
(109, 5, 4, '2024-05-14 14:31:29'),
(110, 9, 4, '2024-05-14 14:31:36'),
(111, 9, 4, '2024-05-14 14:31:37'),
(112, 9, 4, '2024-05-14 14:33:13'),
(113, 9, 4, '2024-05-14 14:33:18'),
(114, 5, 4, '2024-05-14 14:33:37'),
(115, 5, 4, '2024-05-14 14:33:41'),
(116, 9, 5, '2024-05-14 14:52:30'),
(117, 9, 5, '2024-05-14 14:52:33'),
(118, 9, 5, '2024-05-14 14:52:38'),
(119, 4, 5, '2024-05-14 14:52:56'),
(120, 4, 5, '2024-05-14 14:52:59'),
(121, 4, 5, '2024-05-14 14:53:19'),
(122, 4, 5, '2024-05-14 14:53:22'),
(123, 10, 3, '2024-05-17 21:21:17'),
(124, 10, 3, '2024-05-17 21:21:20');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT sysdate(),
  `deleted` char(1) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `item_id`, `client_id`, `created_at`, `deleted`) VALUES
(4, 4, 3, '2024-05-14 06:26:04', 'Y'),
(5, 6, 3, '2024-05-14 06:40:31', 'Y'),
(6, 11, 3, '2024-05-14 06:40:37', 'Y'),
(7, 5, 3, '2024-05-14 06:53:52', 'Y'),
(8, 4, 3, '2024-05-14 06:53:58', 'Y'),
(9, 11, 3, '2024-05-14 06:54:04', 'Y'),
(10, 7, 3, '2024-05-14 06:59:43', 'Y'),
(11, 8, 3, '2024-05-14 06:59:46', 'Y'),
(12, 5, 3, '2024-05-14 06:59:49', 'Y'),
(13, 6, 3, '2024-05-14 06:59:56', 'Y'),
(14, 5, 4, '2024-05-14 14:31:29', 'N'),
(15, 9, 4, '2024-05-14 14:31:37', 'N'),
(16, 9, 5, '2024-05-14 14:52:32', 'Y'),
(17, 4, 5, '2024-05-14 14:53:21', 'N');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_item_fk` (`item_id`),
  ADD KEY `cart_client_fk` (`client_id`);

--
-- Indexes for table `cats`
--
ALTER TABLE `cats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_emails`
--
ALTER TABLE `news_emails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_dt`
--
ALTER TABLE `orders_dt`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_dt_hd_fk` (`hd_id`),
  ADD KEY `orders_dt_item_fk` (`item_id`);

--
-- Indexes for table `orders_hd`
--
ALTER TABLE `orders_hd`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_hd_client_fk` (`client_id`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_cat_fk` (`cat_id`);

--
-- Indexes for table `rate_us`
--
ALTER TABLE `rate_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `v_items`
--
ALTER TABLE `v_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_item_fk` (`item_id`),
  ADD KEY `items_client_fk` (`client_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlist_item_fk` (`item_id`),
  ADD KEY `wishlist_client_fk` (`client_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `cats`
--
ALTER TABLE `cats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `news_emails`
--
ALTER TABLE `news_emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `orders_dt`
--
ALTER TABLE `orders_dt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders_hd`
--
ALTER TABLE `orders_hd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `rate_us`
--
ALTER TABLE `rate_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `v_items`
--
ALTER TABLE `v_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_client_fk` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `cart_item_fk` FOREIGN KEY (`item_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `orders_dt`
--
ALTER TABLE `orders_dt`
  ADD CONSTRAINT `orders_dt_hd_fk` FOREIGN KEY (`hd_id`) REFERENCES `orders_hd` (`id`),
  ADD CONSTRAINT `orders_dt_item_fk` FOREIGN KEY (`item_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `orders_hd`
--
ALTER TABLE `orders_hd`
  ADD CONSTRAINT `orders_hd_client_fk` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_cat_fk` FOREIGN KEY (`cat_id`) REFERENCES `cats` (`id`);

--
-- Constraints for table `v_items`
--
ALTER TABLE `v_items`
  ADD CONSTRAINT `items_client_fk` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `items_item_fk` FOREIGN KEY (`item_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_client_fk` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `wishlist_item_fk` FOREIGN KEY (`item_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
