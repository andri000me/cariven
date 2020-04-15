-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 15, 2020 at 11:33 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cariven`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `booking_id` varchar(5) NOT NULL,
  `attend` int(11) NOT NULL,
  `takeOf_certificate` int(11) NOT NULL,
  `attend_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `certificate_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` int(11) NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  `account_number` varchar(30) NOT NULL,
  `account_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `bank_name`, `account_number`, `account_name`) VALUES
(1, 'BNI', '2222222', 'CARIVEN ID'),
(2, 'BCA', '5555555', 'CARIVEN ID');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` varchar(5) NOT NULL,
  `event` int(11) NOT NULL,
  `ticket` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `qrcode` varchar(10) DEFAULT NULL,
  `status` set('booking','paid','approved','rejected','expired') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `event`, `ticket`, `user`, `qrcode`, `status`, `created_at`) VALUES
('06SCT', 5, 5, 16, '06SCT.png', 'approved', '2020-03-25 05:52:57'),
('08ZF2', 7, 8, 13, '08ZF2.png', 'approved', '2020-03-25 05:46:29'),
('0CBJ7', 9, 12, 24, '0CBJ7.png', 'approved', '2020-03-25 06:05:09'),
('0HKDV', 9, 12, 25, '0HKDV.png', 'approved', '2020-03-25 06:06:56'),
('1A2BD', 1, 4, 17, '1A2BD.png', 'approved', '2020-03-23 09:45:15'),
('1M9JZ', 1, 3, 27, '1M9JZ.png', 'approved', '2020-03-25 06:11:18'),
('1QMMX', 8, 9, 25, '1QMMX.png', 'approved', '2020-03-25 06:06:03'),
('2LI3H', 8, 9, 13, '2LI3H.png', 'approved', '2020-03-25 05:46:03'),
('2YYII', 1, 3, 20, '2YYII.png', 'approved', '2020-03-25 05:57:57'),
('3QQ6R', 6, 6, 26, '3QQ6R.png', 'approved', '2020-03-25 06:08:54'),
('423KX', 6, 6, 12, '423KX.png', 'approved', '2020-03-25 05:45:15'),
('4ITMN', 6, 6, 14, '4ITMN.png', 'approved', '2020-03-25 05:51:26'),
('6596T', 9, 12, 2, '6596T.png', 'approved', '2020-03-25 05:43:39'),
('69POX', 5, 5, 24, '69POX.png', 'approved', '2020-03-25 06:04:59'),
('6KO1H', 1, 3, 25, '6KO1H.png', 'approved', '2020-03-25 06:07:08'),
('6N59H', 9, 12, 17, '6N59H.png', 'approved', '2020-03-25 05:54:37'),
('8V36B', 7, 7, 23, '8V36B.png', 'approved', '2020-03-25 06:01:23'),
('94GX3', 8, 9, 14, '94GX3.png', 'approved', '2020-03-25 05:50:26'),
('9E8DG', 5, 5, 20, '9E8DG.png', 'approved', '2020-03-25 05:57:43'),
('AEPI3', 1, 3, 13, 'AEPI3.png', 'approved', '2020-03-25 05:47:00'),
('AWM69', 6, 6, 23, 'AWM69.png', 'approved', '2020-03-25 06:01:09'),
('BD4OD', 8, 9, 16, 'BD4OD.png', 'approved', '2020-03-25 05:52:10'),
('BS4UN', 8, 9, 19, 'BS4UN.png', 'approved', '2020-03-25 05:56:07'),
('BUQGN', 8, 11, 27, 'BUQGN.png', 'approved', '2020-03-25 06:10:50'),
('CF2ON', 7, 7, 14, 'CF2ON.png', 'approved', '2020-03-25 05:48:41'),
('CTK5T', 9, 12, 12, 'CTK5T.png', 'approved', '2020-03-25 05:44:57'),
('ENAG8', 5, 5, 17, 'ENAG8.png', 'approved', '2020-03-25 05:54:23'),
('EYQNN', 7, 7, 19, 'EYQNN.png', 'approved', '2020-03-25 05:55:40'),
('F2BSM', 8, 9, 20, 'F2BSM.png', 'approved', '2020-03-25 05:57:16'),
('F69ZC', 8, 9, 17, 'F69ZC.png', 'approved', '2020-03-25 05:53:50'),
('FRQ1V', 9, 12, 27, 'FRQ1V.png', 'approved', '2020-03-25 06:11:43'),
('G09TZ', 1, 3, 21, 'G09TZ.png', 'approved', '2020-03-25 05:59:34'),
('H865V', 6, 6, 21, 'H865V.png', 'approved', '2020-03-25 05:59:22'),
('HATKS', 1, 3, 12, 'HATKS.png', 'approved', '2020-03-23 07:45:49'),
('HVCCM', 9, 12, 23, 'HVCCM.png', 'approved', '2020-03-25 06:03:29'),
('IOOCQ', 5, 5, 26, 'IOOCQ.png', 'approved', '2020-03-25 06:09:05'),
('JAX3A', 5, 5, 23, 'JAX3A.png', 'approved', '2020-03-25 06:01:49'),
('L5BUK', 8, 9, 14, NULL, 'rejected', '2020-03-25 05:49:09'),
('L647B', 1, 3, 2, 'L647B.png', 'approved', '2020-03-25 05:41:03'),
('LW72X', 5, 5, 13, 'LW72X.png', 'approved', '2020-03-25 05:45:51'),
('LXZ6Z', 6, 6, 16, 'LXZ6Z.png', 'approved', '2020-03-25 05:52:43'),
('MEDL3', 5, 5, 25, 'MEDL3.png', 'approved', '2020-03-25 06:06:45'),
('N501T', 1, 4, 16, NULL, 'rejected', '2020-03-23 08:06:10'),
('O42XM', 7, 7, 2, 'O42XM.png', 'approved', '2020-03-25 05:42:53'),
('O6A98', 8, 9, 23, 'O6A98.png', 'approved', '2020-03-25 06:00:43'),
('PP1KY', 8, 9, 24, 'PP1KY.png', 'approved', '2020-03-25 06:04:27'),
('Q4Y0S', 9, 12, 21, 'Q4Y0S.png', 'approved', '2020-03-25 05:59:12'),
('QK9JN', 5, 5, 12, 'QK9JN.png', 'approved', '2020-03-25 11:00:30'),
('QL8Y7', 5, 5, 2, 'QL8Y7.png', 'approved', '2020-03-25 05:42:35'),
('S6JYN', 6, 6, 27, 'S6JYN.png', 'approved', '2020-03-25 06:12:04'),
('SGODA', 1, 4, 16, 'SGODA.png', 'approved', '2020-03-23 09:26:41'),
('SQI09', 6, 6, 24, 'SQI09.png', 'approved', '2020-03-25 06:05:21'),
('VGOPP', 7, 7, 26, 'VGOPP.png', 'approved', '2020-03-25 06:08:25'),
('VK7D8', 6, 6, 19, 'VK7D8.png', 'approved', '2020-03-25 05:56:40'),
('VUT9M', 5, 5, 14, 'VUT9M.png', 'approved', '2020-03-25 05:49:34'),
('W9S9X', 8, 9, 21, 'W9S9X.png', 'approved', '2020-03-25 05:58:44'),
('Y7HKA', 9, 12, 20, 'Y7HKA.png', 'approved', '2020-03-25 05:58:19'),
('YNPB1', 1, 3, 26, 'YNPB1.png', 'approved', '2020-03-25 06:07:47'),
('ZRX5L', 5, 5, 19, 'ZRX5L.png', 'approved', '2020-03-25 05:56:49'),
('ZUXYW', 8, 11, 12, 'ZUXYW.png', 'approved', '2020-03-25 11:00:02');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`) VALUES
(1, 'Jakarta'),
(2, 'Solo'),
(3, 'Semarang');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `publisher` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `location` text NOT NULL,
  `city` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `certificate` tinyint(1) NOT NULL DEFAULT 0,
  `background_certificate` varchar(30) DEFAULT 'certif-bg-default.png',
  `image` varchar(30) DEFAULT 'default-event.png',
  `status` set('draft','submitted','approved','rejected') NOT NULL DEFAULT 'draft',
  `status_description` text DEFAULT NULL,
  `total_income` int(11) DEFAULT NULL,
  `submitted_time` datetime DEFAULT NULL,
  `validated_time` datetime DEFAULT NULL,
  `validated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `publisher`, `category`, `title`, `slug`, `description`, `start_time`, `end_time`, `location`, `city`, `type`, `certificate`, `background_certificate`, `image`, `status`, `status_description`, `total_income`, `submitted_time`, `validated_time`, `validated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Java Jazz 2021', 'java-jazz-2021', '<p>Quisque vel enim scelerisque, sodales lacus sed, imperdiet felis. Cras consequat convallis elit, eget venenatis turpis volutpat quis. Curabitur sagittis aliquet ligula nec pharetra. Morbi quam dolor, rhoncus eu tortor non, egestas mollis mauris. Proin elementum ac dui sed tempus. Aliquam tincidunt volutpat augue ac efficitur. Fusce eget lectus non elit luctus tempus. Morbi vitae hendrerit est. Mauris fringilla nibh in felis dictum, eu lacinia leo fringilla. Nullam rutrum, risus nec iaculis varius, urna orci interdum diam, vel iaculis orci risus ut enim. Phasellus massa justo, consectetur non eros commodo, egestas luctus felis. Curabitur gravida nisl ac semper pulvinar. Etiam vitae dictum tellus. Etiam viverra ornare nibh scelerisque efficitur. Suspendisse vestibulum hendrerit euismod.</p>', '2020-03-26 19:00:00', '2020-03-26 23:00:00', 'JIE Kemayoran', 1, 1, 0, '1-certificate.jpg', '1584812029.png', 'approved', 'OK', 4268000, NULL, '2020-03-20 22:10:07', 10, '2020-02-29 06:04:04', '2020-03-25 06:13:46'),
(5, 1, 4, 'Seminar Nasional Industri Kreatif 4.0', 'seminar-nasional-industri-kreatif-4.0', '<p>Curabitur tincidunt vel urna in vehicula. In facilisis, dui in eleifend euismod, lectus purus dignissim purus, ac luctus magna orci sit amet risus. Nam bibendum nibh eu sem varius, id ullamcorper risus placerat. Quisque blandit elit vel sodales porta. Duis condimentum sem vitae mattis aliquet. Nulla vitae pharetra sapien. Fusce a diam nec magna suscipit finibus imperdiet ut justo. Maecenas rutrum elit ut mauris condimentum, vel porttitor mauris placerat. Nunc nec tristique lectus. Sed finibus nulla libero, vel dapibus magna efficitur lobortis. Vestibulum viverra sed elit et imperdiet. Vivamus sit amet felis quam. Quisque justo diam, luctus id justo auctor, interdum maximus metus.</p>', '2020-06-24 08:00:00', '2020-06-24 00:00:00', 'Auditorium UNS', 2, 0, 1, '5-certificate.png', '1584812274.png', 'approved', 'OK', NULL, '2020-03-22 12:42:58', '2020-03-22 00:49:18', 10, '2020-03-21 17:37:54', '2020-03-21 17:55:39'),
(6, 1, 5, 'Opening Sea Games 2021', 'opening-sea-games-2021', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed accumsan placerat finibus. Cras viverra nulla turpis, ut molestie nunc maximus nec. Vestibulum nisl tortor, accumsan ut eros in, condimentum accumsan dui. Vivamus arcu ligula, vestibulum eu eleifend non, fermentum at elit. Nunc gravida sapien quis lacus gravida, sed consequat diam lacinia. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rhoncus varius lacus nec imperdiet. In efficitur gravida rhoncus.</p>\r\n<p>Quisque vel enim scelerisque, sodales lacus sed, imperdiet felis. Cras consequat convallis elit, eget venenatis turpis volutpat quis. Curabitur sagittis aliquet ligula nec pharetra. Morbi quam dolor, rhoncus eu tortor non, egestas mollis mauris. Proin elementum ac dui sed tempus. Aliquam tincidunt volutpat augue ac efficitur. Fusce eget lectus non elit luctus tempus. Morbi vitae hendrerit est. Mauris fringilla nibh in felis dictum, eu lacinia leo fringilla. Nullam rutrum, risus nec iaculis varius, urna orci interdum diam, vel iaculis orci risus ut enim. Phasellus massa justo, consectetur non eros commodo, egestas luctus felis. Curabitur gravida nisl ac semper pulvinar. Etiam vitae dictum tellus. Etiam viverra ornare nibh scelerisque efficitur. Suspendisse vestibulum hendrerit euismod.</p>', '2021-04-02 18:00:00', '2021-04-02 23:00:00', 'Stadion Gelora Bung Karno', 1, 0, 0, 'certif-bg-default.png', '1584813522.jpg', 'approved', 'OK', NULL, '2020-03-22 12:59:12', '2020-03-22 00:59:24', 10, '2020-03-21 17:58:42', '2020-03-21 18:06:09'),
(7, 15, 4, 'Business Growing in 3 Month', 'business-growing-in-3-month', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Placerat orci nulla pellentesque dignissim enim sit. Hac habitasse platea dictumst quisque sagittis purus. Lectus arcu bibendum at varius vel pharetra vel turpis nunc. Massa placerat duis ultricies lacus sed turpis tincidunt id aliquet. Diam ut venenatis tellus in metus. Et ultrices neque ornare aenean euismod. Nunc consequat interdum varius sit amet mattis vulputate enim. Eget lorem dolor sed viverra ipsum nunc aliquet bibendum enim. Volutpat blandit aliquam etiam erat velit. Praesent tristique magna sit amet purus gravida quis blandit. Ultrices tincidunt arcu non sodales neque sodales ut etiam. Proin nibh nisl condimentum id venenatis a condimentum vitae. Mi ipsum faucibus vitae aliquet nec ullamcorper sit amet risus. Nibh cras pulvinar mattis nunc sed blandit.</p>\r\n<p>Mauris pharetra et ultrices neque. Enim sed faucibus turpis in eu mi bibendum. Laoreet sit amet cursus sit. Habitant morbi tristique senectus et netus. At quis risus sed vulputate odio. Ornare lectus sit amet est placerat in egestas erat. Magna ac placerat vestibulum lectus mauris ultrices eros. Fringilla phasellus faucibus scelerisque eleifend. Id diam maecenas ultricies mi. Elit duis tristique sollicitudin nibh sit amet. Neque egestas congue quisque egestas. Elementum integer enim neque volutpat ac tincidunt. Commodo elit at imperdiet dui accumsan. Consequat mauris nunc congue nisi vitae suscipit.</p>\r\n<p>Nunc sed id semper risus. Et odio pellentesque diam volutpat. Egestas egestas fringilla phasellus faucibus. Magna etiam tempor orci eu lobortis elementum. Justo nec ultrices dui sapien eget mi proin. Sed libero enim sed faucibus turpis. Commodo sed egestas egestas fringilla phasellus. Pretium lectus quam id leo in vitae turpis massa. Mi bibendum neque egestas congue quisque egestas diam in arcu. Pellentesque dignissim enim sit amet venenatis. Massa vitae tortor condimentum lacinia quis vel eros. Vel facilisis volutpat est velit egestas. Varius sit amet mattis vulputate enim. Laoreet sit amet cursus sit amet. Ut morbi tincidunt augue interdum velit euismod. Eu consequat ac felis donec et. Porttitor rhoncus dolor purus non enim praesent elementum facilisis leo. Vel fringilla est ullamcorper eget nulla facilisi etiam dignissim. Risus viverra adipiscing at in tellus integer feugiat.</p>', '2020-12-09 08:00:00', '2020-12-09 14:00:00', 'Aula Pemkab Sukoharjo', 2, 1, 1, '7-certificate.png', '1584974136.jpg', 'approved', 'OK', 407000, '2020-03-23 09:51:38', '2020-03-23 21:52:26', 10, '2020-03-23 14:35:36', '2020-03-25 06:13:22'),
(8, 15, 2, 'Grow in Tech Faster', 'grow-in-tech-faster', '<p>Est ullamcorper eget nulla facilisi etiam dignissim diam quis enim. Interdum velit laoreet id donec ultrices tincidunt arcu non. Elementum pulvinar etiam non quam lacus suspendisse faucibus interdum posuere. Quam pellentesque nec nam aliquam. Diam phasellus vestibulum lorem sed risus ultricies tristique nulla aliquet. Egestas sed tempus urna et pharetra pharetra massa massa. Lectus proin nibh nisl condimentum id. Aliquam faucibus purus in massa. Vel eros donec ac odio tempor orci. Eget velit aliquet sagittis id. Tortor dignissim convallis aenean et tortor at. A scelerisque purus semper eget duis at tellus at urna. Consequat interdum varius sit amet mattis vulputate enim nulla aliquet. At elementum eu facilisis sed odio morbi. Morbi tristique senectus et netus et malesuada fames ac turpis. Fermentum iaculis eu non diam phasellus vestibulum lorem sed risus. Donec pretium vulputate sapien nec sagittis aliquam malesuada.</p>\r\n<p>At augue eget arcu dictum varius duis at. Mauris nunc congue nisi vitae suscipit tellus. Morbi tristique senectus et netus et malesuada fames. Quam viverra orci sagittis eu volutpat. Aenean euismod elementum nisi quis eleifend quam adipiscing. Auctor eu augue ut lectus arcu bibendum. Facilisis leo vel fringilla est ullamcorper eget nulla facilisi. Aliquam sem et tortor consequat id. Porttitor massa id neque aliquam. Ut pharetra sit amet aliquam id diam maecenas. Ipsum suspendisse ultrices gravida dictum fusce ut placerat. Leo duis ut diam quam nulla porttitor. Faucibus in ornare quam viverra orci sagittis eu. Praesent tristique magna sit amet. Id semper risus in hendrerit. Tincidunt dui ut ornare lectus sit. Imperdiet sed euismod nisi porta lorem mollis aliquam ut porttitor. Eu ultrices vitae auctor eu augue.</p>', '2020-09-17 09:00:00', '2020-09-17 15:00:00', 'Laboratorium Komptutasi Pemkab Sukoharjo', 2, 1, 1, '8-certificate.png', '1584975843.jpg', 'approved', 'OK', 1270700, '2020-03-23 10:08:36', '2020-03-23 22:08:52', 10, '2020-03-23 15:04:03', '2020-03-25 11:00:57'),
(9, 22, 2, 'Refreshing the Soul', 'refreshing-the-soul', '<p>Morbi tincidunt ornare massa eget egestas purus viverra. Suspendisse faucibus interdum posuere lorem ipsum dolor sit amet. Massa sapien faucibus et molestie ac feugiat. Mi eget mauris pharetra et ultrices neque ornare aenean. Consequat id porta nibh venenatis cras sed felis eget velit. Eu tincidunt tortor aliquam nulla facilisi cras fermentum odio. Pulvinar proin gravida hendrerit lectus a. Ac odio tempor orci dapibus. Enim nunc faucibus a pellentesque sit amet. Aliquam etiam erat velit scelerisque. Varius duis at consectetur lorem donec massa sapien faucibus et. A diam maecenas sed enim ut.</p>\r\n<p>Netus et malesuada fames ac turpis egestas sed. Augue ut lectus arcu bibendum at varius vel pharetra. Auctor augue mauris augue neque gravida in. Velit laoreet id donec ultrices tincidunt arcu non. Quisque non tellus orci ac auctor augue mauris. Fermentum iaculis eu non diam. Enim nec dui nunc mattis enim ut tellus elementum sagittis. Vitae ultricies leo integer malesuada nunc vel. Enim ut tellus elementum sagittis. Habitant morbi tristique senectus et netus et malesuada fames. Cursus vitae congue mauris rhoncus aenean vel elit scelerisque. Vitae sapien pellentesque habitant morbi tristique senectus et netus et. Nibh sed pulvinar proin gravida. Quis commodo odio aenean sed. Odio eu feugiat pretium nibh. Nibh praesent tristique magna sit amet purus. Purus sit amet volutpat consequat mauris nunc congue nisi vitae. Dignissim sodales ut eu sem integer.</p>', '2020-12-31 06:00:00', '2020-12-31 11:00:00', 'Waduk Gajah Mungkur', 2, 0, 0, 'certif-bg-default.png', '1584977802.jpg', 'approved', 'OK', NULL, '2020-03-23 10:37:13', '2020-03-23 22:37:25', 10, '2020-03-23 15:36:42', '2020-03-23 15:37:25');

-- --------------------------------------------------------

--
-- Table structure for table `event_category`
--

CREATE TABLE `event_category` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event_category`
--

INSERT INTO `event_category` (`id`, `name`) VALUES
(1, 'Musik'),
(2, 'Workshop'),
(4, 'Seminar'),
(5, 'Olahraga');

-- --------------------------------------------------------

--
-- Table structure for table `inboxes`
--

CREATE TABLE `inboxes` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `reply_message` text DEFAULT NULL,
  `reply_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `replied_at` timestamp NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inboxes`
--

INSERT INTO `inboxes` (`id`, `name`, `email`, `content`, `is_read`, `reply_message`, `reply_by`, `created_at`, `replied_at`) VALUES
(10, 'lord', 'lord@gmail.com', 'testi ketiga', 1, '<p>Pertanyaan:<br>\r\ntesti ketiga<br>\r\n<br>\r\nJawaban:</p>\r\n\r\n<p>masuk</p>\r\n', 10, '2019-04-27 15:01:20', '2019-05-02 02:09:53'),
(11, 'Afifa Nomita', 'afifanomita@gmail.com', 'Kenapa saya tidak bisa lebih dari satu tiket dalam satu akun?', 1, NULL, NULL, '2019-05-22 06:43:05', NULL),
(13, 'Chania', 'chania@gmail.com', 'untuk publikasi event apakah ada biayanya gan ?', 1, '<p>untuk publikasi tidak dipungut biaya apapun. terimakasih sudah menggunakan cariven.com :)</p>\r\n', 10, '2019-03-05 03:07:00', '2019-04-16 08:41:21'),
(14, 'Zefanya', 'jecupa@easyemail.info', 'untuk pendaftaran event apakah bisa OTS?', 1, '<p>tergantung publisher kak :)</p>\r\n', 10, '2019-03-05 03:07:00', '2019-04-16 09:49:35'),
(15, 'Chania', 'chania.eva@gmail.com', 'apakah pembayaran bisa menggunakan teknologi fintech (misal: ovo, gopay, dll) ?', 1, '<p>Pertanyaan:<br>\r\napakah pembayaran bisa menggunakan teknologi fintech (misal: ovo, gopay, dll) ?<br>\r\n<br>\r\nJawaban:</p>\r\n\r\n<p>untuk metode pembayaran tergantung pihak publisher kak. terimakasih</p>\r\n\r\n<p>- dani</p>\r\n', 10, '2019-05-10 11:32:21', '2019-05-16 15:22:54'),
(16, 'zefa', 'danikristianto21@gmail.com', 'testi message kedua', 1, '<p>Pertanyaan:<br>\r\ntesti message kedua<br>\r\n<br>\r\nJawaban:</p>\r\n\r\n<p>oke masuk</p>\r\n', 10, '2019-04-27 15:00:12', '2020-03-17 14:37:47'),
(17, 'Kris', 'kris@gmail.com', 'tessti message', 1, NULL, NULL, '2019-04-27 14:56:37', NULL),
(18, 'Dinenda', 'Dinendatejo@gmail.com', 'Kok kaya gini mas saya susah ngaksesnya gapaham cara makenya bahasanya bingung mas mohon pencerahan', 1, NULL, NULL, '2019-05-22 06:10:59', NULL),
(19, 'David Villa', 'david@gmail.com', 'berapa lama proses jadi publisher diapprove?', 0, NULL, NULL, '2020-03-25 06:18:33', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `category` int(11) NOT NULL,
  `image` varchar(50) NOT NULL,
  `views_count` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `slug`, `content`, `category`, `image`, `views_count`, `created_by`, `created_at`, `updated_at`) VALUES
(3, 'Maret Greget', 'maret-greget', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed accumsan placerat finibus. Cras viverra nulla turpis, ut molestie nunc maximus nec. Vestibulum nisl tortor, accumsan ut eros in, condimentum accumsan dui. Vivamus arcu ligula, vestibulum eu eleifend non, fermentum at elit. Nunc gravida sapien quis lacus gravida, sed consequat diam lacinia. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rhoncus varius lacus nec imperdiet. In efficitur gravida rhoncus.</p>\r\n\r\n<p>Quisque vel enim scelerisque, sodales lacus sed, imperdiet felis. Cras consequat convallis elit, eget venenatis turpis volutpat quis. Curabitur sagittis aliquet ligula nec pharetra. Morbi quam dolor, rhoncus eu tortor non, egestas mollis mauris. Proin elementum ac dui sed tempus. Aliquam tincidunt volutpat augue ac efficitur. Fusce eget lectus non elit luctus tempus. Morbi vitae hendrerit est. Mauris fringilla nibh in felis dictum, eu lacinia leo fringilla. Nullam rutrum, risus nec iaculis varius, urna orci interdum diam, vel iaculis orci risus ut enim. Phasellus massa justo, consectetur non eros commodo, egestas luctus felis. Curabitur gravida nisl ac semper pulvinar. Etiam vitae dictum tellus. Etiam viverra ornare nibh scelerisque efficitur. Suspendisse vestibulum hendrerit euismod.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris ex diam, blandit quis vestibulum venenatis, iaculis at diam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vestibulum eu consectetur est, nec egestas metus. Quisque imperdiet mauris ac tellus facilisis, non lobortis nibh pellentesque. Duis in justo hendrerit eros rhoncus mattis. Vivamus pharetra ligula at ipsum ullamcorper sollicitudin. Nam quis laoreet urna, non interdum quam. Donec semper massa sed maximus posuere. Sed hendrerit convallis leo a porttitor. Duis molestie nisi fringilla vulputate porttitor. Vestibulum efficitur ultrices magna, ac accumsan ligula blandit quis.</p>', 2, '1584806522.png', 2, 10, '2020-03-19 13:26:44', '2020-03-23 08:29:25'),
(4, 'Fitur baru cariven', 'fitur-baru-cariven', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed accumsan placerat finibus. Cras viverra nulla turpis, ut molestie nunc maximus nec. Vestibulum nisl tortor, accumsan ut eros in, condimentum accumsan dui. Vivamus arcu ligula, vestibulum eu eleifend non, fermentum at elit. Nunc gravida sapien quis lacus gravida, sed consequat diam lacinia. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rhoncus varius lacus nec imperdiet. In efficitur gravida rhoncus.</p>\r\n\r\n<p>Curabitur tincidunt vel urna in vehicula. In facilisis, dui in eleifend euismod, lectus purus dignissim purus, ac luctus magna orci sit amet risus. Nam bibendum nibh eu sem varius, id ullamcorper risus placerat. Quisque blandit elit vel sodales porta. Duis condimentum sem vitae mattis aliquet. Nulla vitae pharetra sapien. Fusce a diam nec magna suscipit finibus imperdiet ut justo. Maecenas rutrum elit ut mauris condimentum, vel porttitor mauris placerat. Nunc nec tristique lectus. Sed finibus nulla libero, vel dapibus magna efficitur lobortis. Vestibulum viverra sed elit et imperdiet. Vivamus sit amet felis quam. Quisque justo diam, luctus id justo auctor, interdum maximus metus.</p>\r\n\r\n<p>Nulla pellentesque elit sed enim ornare faucibus. Suspendisse sapien nisi, maximus vitae viverra in, ultrices tincidunt ipsum. Quisque imperdiet blandit eleifend. Proin elementum, nisl ac mattis consectetur, nulla nisi vestibulum ante, ornare ultricies velit nulla ac tellus. Fusce pellentesque libero in consectetur luctus. Mauris consectetur varius mauris vitae suscipit. Fusce luctus, sem eu sollicitudin feugiat, urna libero rhoncus odio, a congue mi nunc et risus. Integer quis consequat sapien. Suspendisse potenti.</p>', 1, '1584806842.jpg', 5, 10, '2020-03-21 16:07:22', '2020-03-25 06:24:21');

-- --------------------------------------------------------

--
-- Table structure for table `news_category`
--

CREATE TABLE `news_category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news_category`
--

INSERT INTO `news_category` (`id`, `name`) VALUES
(1, 'Pengumuman'),
(2, 'Promo');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `booking_id` varchar(5) NOT NULL,
  `destination_bank` int(11) NOT NULL,
  `account_name` varchar(50) NOT NULL,
  `message` varchar(50) NOT NULL,
  `image` varchar(30) NOT NULL,
  `status` enum('submitted','approved','rejected','') NOT NULL DEFAULT 'submitted',
  `status_description` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `validated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `booking_id`, `destination_bank`, `account_name`, `message`, `image`, `status`, `status_description`, `created_at`, `validated_at`) VALUES
(3, 'HATKS', 2, 'Dinenda Tejo Arum', 'tessss', '1584949575.jpg', 'approved', 'OK', '2020-03-23 07:46:15', '2020-03-23 15:54:31'),
(4, 'N501T', 1, 'Angga Dian Permana Putra', 'mohon segera di proses, tks', '1584952663.jpg', 'rejected', 'Nama Akun Bank Pengirim Tidak Sesuai', '2020-03-23 08:37:47', '2020-03-23 16:05:36'),
(5, 'SGODA', 2, 'Dinenda Tejo Arum', 'segera di proses. trims', '1584955623.jpg', 'approved', 'OK', '2020-03-23 09:27:03', '2020-03-23 16:27:22'),
(6, '1A2BD', 1, 'Ash Allukal Abdul Qodar', 'mohon diproses', '1584956744.jpg', 'approved', 'OK', '2020-03-23 09:45:44', '2020-03-23 16:45:55'),
(7, 'L647B', 2, 'Chania Evangelista', 'sudah di transfer', '1585114924.jpg', 'approved', 'OK', '2020-03-25 05:42:04', '2020-03-25 12:44:07'),
(8, 'O42XM', 1, 'Chania Evangelista', '', '1585114987.jpg', 'approved', 'OK', '2020-03-25 05:43:07', '2020-03-25 12:44:14'),
(9, '2LI3H', 2, 'Desti Septiana', '', '1585115178.jpg', 'approved', 'OK', '2020-03-25 05:46:18', '2020-03-25 12:47:24'),
(10, '08ZF2', 1, 'Desti Septiana', '', '1585115200.jpg', 'approved', 'OK', '2020-03-25 05:46:40', '2020-03-25 12:47:35'),
(11, 'AEPI3', 1, 'Desti Septiana', '', '1585115230.jpg', 'approved', 'OK', '2020-03-25 05:47:10', '2020-03-25 12:47:30'),
(12, 'CF2ON', 2, 'Destia Hanasah', '', '1585115335.jpg', 'approved', 'OK', '2020-03-25 05:48:55', '2020-03-25 12:49:50'),
(13, 'L5BUK', 2, 'Destia Khasanah', '', '1585115365.jpg', 'rejected', 'Nominal Transfer Tidak Sesuai', '2020-03-25 05:49:25', '2020-03-25 12:50:07'),
(14, '94GX3', 1, 'Destia Khasanah', '', '1585115437.jpg', 'approved', 'OK', '2020-03-25 05:50:37', '2020-03-25 12:50:45'),
(15, 'BD4OD', 2, 'Angga Dian Permana Putra', '', '1585115542.jpg', 'approved', 'OK', '2020-03-25 05:52:22', '2020-03-25 12:53:09'),
(16, 'F69ZC', 2, 'Ash Allukal Abdul Qodar', '', '1585115642.jpg', 'approved', 'OK', '2020-03-25 05:54:02', '2020-03-25 12:54:44'),
(17, 'EYQNN', 1, 'Alief Nugraha', '', '1585115756.jpg', 'approved', 'OK', '2020-03-25 05:55:56', '2020-03-25 13:12:35'),
(18, 'BS4UN', 2, 'Alief Nugraha', '', '1585115781.jpg', 'approved', 'OK', '2020-03-25 05:56:21', '2020-03-25 13:13:59'),
(19, 'F2BSM', 1, 'Arifah Intan Yulita', '', '1585115851.jpg', 'approved', 'OK', '2020-03-25 05:57:31', '2020-03-25 13:13:53'),
(20, '2YYII', 2, 'Arifah Intan Yulita', '', '1585115889.jpg', 'approved', 'OK', '2020-03-25 05:58:09', '2020-03-25 13:13:46'),
(21, 'W9S9X', 1, 'Desi Wulandari', '', '1585115940.jpg', 'approved', 'OK', '2020-03-25 05:59:00', '2020-03-25 13:13:40'),
(22, 'G09TZ', 1, 'Desi Wulandari', '', '1585115985.jpg', 'approved', 'OK', '2020-03-25 05:59:45', '2020-03-25 13:13:33'),
(23, 'O6A98', 1, 'Bernando Mahulae', '', '1585116057.jpg', 'approved', 'OK', '2020-03-25 06:00:57', '2020-03-25 13:13:27'),
(24, '8V36B', 1, 'Bernando Mahulae', '', '1585116096.jpg', 'approved', 'OK', '2020-03-25 06:01:36', '2020-03-25 13:13:22'),
(25, 'PP1KY', 2, 'Amin Rochmat Choironi', '', '1585116287.jpg', 'approved', 'OK', '2020-03-25 06:04:47', '2020-03-25 13:13:16'),
(26, '1QMMX', 1, 'Afifa Nomita Dewi', '', '1585116381.jpg', 'approved', 'OK', '2020-03-25 06:06:21', '2020-03-25 13:13:10'),
(27, '6KO1H', 2, 'Afifa Nomita Dewi', '', '1585116436.jpg', 'approved', 'OK', '2020-03-25 06:07:16', '2020-03-25 13:13:04'),
(28, 'YNPB1', 1, 'Albert Deo Hesa Kesuma', '', '1585116488.jpg', 'approved', 'OK', '2020-03-25 06:08:08', '2020-03-25 13:12:59'),
(29, 'VGOPP', 2, 'Albert Deo Hesa Kusuma', '', '1585116513.jpg', 'approved', 'OK', '2020-03-25 06:08:33', '2020-03-25 13:12:53'),
(30, 'BUQGN', 1, 'Aoron Sulistyono', '', '1585116666.jpg', 'approved', 'OK', '2020-03-25 06:11:06', '2020-03-25 13:12:47'),
(31, '1M9JZ', 1, 'Aoron Sulistyono', '', '1585116691.jpg', 'approved', 'OK', '2020-03-25 06:11:31', '2020-03-25 13:12:41'),
(32, 'ZUXYW', 2, 'Dinenda Tejo Arum', '', '1585134017.jpg', 'approved', 'OK', '2020-03-25 11:00:17', '2020-03-25 18:00:57');

-- --------------------------------------------------------

--
-- Table structure for table `payment_history`
--

CREATE TABLE `payment_history` (
  `id` int(11) NOT NULL,
  `event` int(11) NOT NULL,
  `booking_id` varchar(5) NOT NULL,
  `ticket_price` int(11) NOT NULL,
  `fee_admin` int(11) NOT NULL,
  `final_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_history`
--

INSERT INTO `payment_history` (`id`, `event`, `booking_id`, `ticket_price`, `fee_admin`, `final_price`) VALUES
(7, 1, 'HATKS', 350000, 10500, 339500),
(8, 1, 'SGODA', 100000, 3000, 97000),
(9, 1, '1A2BD', 100000, 3000, 97000),
(10, 1, 'L647B', 350000, 10500, 339500),
(11, 7, 'O42XM', 75000, 3000, 72000),
(12, 8, '2LI3H', 100000, 3000, 97000),
(13, 1, 'AEPI3', 350000, 10500, 339500),
(14, 7, '08ZF2', 50000, 3000, 47000),
(15, 7, 'CF2ON', 75000, 3000, 72000),
(16, 8, '94GX3', 100000, 3000, 97000),
(17, 8, 'BD4OD', 100000, 3000, 97000),
(18, 8, 'F69ZC', 100000, 3000, 97000),
(19, 7, 'EYQNN', 75000, 3000, 72000),
(20, 1, '1M9JZ', 350000, 10500, 339500),
(21, 8, 'BUQGN', 155000, 4650, 150350),
(22, 7, 'VGOPP', 75000, 3000, 72000),
(23, 1, 'YNPB1', 350000, 10500, 339500),
(24, 1, '6KO1H', 350000, 10500, 339500),
(25, 8, '1QMMX', 100000, 3000, 97000),
(26, 8, 'PP1KY', 100000, 3000, 97000),
(27, 7, '8V36B', 75000, 3000, 72000),
(28, 8, 'O6A98', 100000, 3000, 97000),
(29, 1, 'G09TZ', 350000, 10500, 339500),
(30, 8, 'W9S9X', 100000, 3000, 97000),
(31, 1, '2YYII', 350000, 10500, 339500),
(32, 8, 'F2BSM', 100000, 3000, 97000),
(33, 8, 'BS4UN', 100000, 3000, 97000),
(34, 8, 'ZUXYW', 155000, 4650, 150350);

-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

CREATE TABLE `publishers` (
  `id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `business_number` varchar(13) CHARACTER SET utf8mb4 NOT NULL,
  `business_email` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `short_bio` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `location` varchar(160) CHARACTER SET utf8mb4 NOT NULL,
  `image` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `tdup` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `status` set('submitted','approved','rejected','') DEFAULT NULL,
  `status_description` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `publishers`
--

INSERT INTO `publishers` (`id`, `name`, `business_number`, `business_email`, `short_bio`, `location`, `image`, `tdup`, `status`, `status_description`, `created_at`, `updated_at`) VALUES
(1, 'Daniel EO\'s', '0211231235', 'daniel.events@yahoo.com', 'Facing the world with creativity events in new dim', 'Sunter, Jakarta Utara', '1_dk.png', '1582900823.pdf', 'approved', 'OK', '2020-02-28 14:40:23', '2020-03-25 05:31:37'),
(15, 'Amals Event Organizer', '02719901234', 'amals.eo@gmail.com', 'Mastering in developing people by event and worksh', 'Mojolaban, Sukoharjo', '1584961303.png', '1584961303.png', 'approved', 'OK', '2020-03-23 11:01:43', '2020-03-23 14:31:22'),
(22, 'Radya Family', '0271311223', 'radya.fams@gmail.com', 'Even Organizer foucing is arts and culture', 'Selogiri, Wonogiri', '1584977541.png', '1584977541.png', 'approved', 'OK', '2020-03-23 15:32:21', '2020-03-23 15:32:35');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` varchar(3) NOT NULL,
  `role_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `event` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` varchar(50) NOT NULL,
  `quota` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `event`, `name`, `description`, `quota`, `price`, `created_at`, `updated_at`) VALUES
(3, 1, 'VVIP Pre-Sale', 'VVIP special for Pre-Sale', 142, 350000, '2020-02-29 09:31:24', '2020-03-25 06:11:18'),
(4, 1, 'North Standing', 'Standing north of stage', 748, 100000, '2020-02-29 09:34:05', '2020-03-23 09:45:15'),
(5, 5, 'Umum', 'Tiket untuk umum', 288, 0, '2020-03-21 17:39:58', '2020-03-25 11:00:30'),
(6, 6, 'Umum', 'tiket untuk umum', 29991, 0, '2020-03-21 17:59:07', '2020-03-25 06:12:04'),
(7, 7, 'VIP with lauch', 'vip ticket with lauch', 95, 75000, '2020-03-23 14:44:52', '2020-03-25 06:08:25'),
(8, 7, 'General', 'General only have snack', 49, 50000, '2020-03-23 14:45:35', '2020-03-25 05:46:29'),
(9, 8, 'Pre-Sale 1', 'Presale pertama', 0, 100000, '2020-03-23 15:04:50', '2020-03-25 06:10:25'),
(11, 8, 'Pre-Sale 2', 'Presale kedua', 18, 155000, '2020-03-23 15:06:00', '2020-03-25 11:00:02'),
(12, 9, 'General', 'Tiket umum untuk siapa saja', 91, 0, '2020-03-23 15:37:09', '2020-03-25 06:11:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone_number` varchar(13) NOT NULL,
  `short_bio` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `profile_picture` varchar(50) NOT NULL DEFAULT 'default.png',
  `role` varchar(3) NOT NULL DEFAULT 'usr',
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `status_description` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `phone_number`, `short_bio`, `address`, `profile_picture`, `role`, `status`, `status_description`, `created_at`, `updated_at`) VALUES
(1, 'dani@gmail.com', 'c129b324aee662b04eccf68babba85851346dff9', 'Dani Kris', '082387045706', 'Pejuang baru', 'Sunter Jaya Barat No 7', '1_1584808492.jpg', 'usr', 1, NULL, '2020-02-25 09:59:20', '2020-03-21 16:34:52'),
(2, 'chania.eva@gmail.com', 'c129b324aee662b04eccf68babba85851346dff9', 'Chania Evangelista', '082318241284', NULL, NULL, 'default.png', 'usr', 1, NULL, '2020-02-26 15:45:49', '2020-03-25 05:40:30'),
(10, 'admin@cariven.id', 'c129b324aee662b04eccf68babba85851346dff9', 'Admin', '02718704570', NULL, NULL, 'default.png', 'adm', 1, NULL, '2020-03-16 15:59:10', '2020-03-16 15:59:33'),
(11, 'manager@cariven.id', 'c129b324aee662b04eccf68babba85851346dff9', 'Manager', '082387045704', NULL, NULL, 'default.png', 'man', 1, NULL, '2020-03-16 15:59:10', '2020-03-16 15:59:33'),
(12, 'dinendatejo@gmail.com', 'c129b324aee662b04eccf68babba85851346dff9', 'Dinenda Tejo Arum', '085726647183', NULL, NULL, 'default.png', 'usr', 1, NULL, '2020-03-21 18:32:31', '2020-03-21 18:32:31'),
(13, 'destiseptiana@gmail.com', 'c129b324aee662b04eccf68babba85851346dff9', 'Desti Septiana', '089665750288', NULL, NULL, 'default.png', 'usr', 1, NULL, '2020-03-21 18:32:31', '2020-03-21 18:32:31'),
(14, 'destianurhasanah@gmail.com', 'c129b324aee662b04eccf68babba85851346dff9', 'Destia Nur Hasanah', '081548191447', NULL, NULL, 'default.png', 'usr', 1, NULL, '2020-03-21 18:32:31', '2020-03-21 18:32:31'),
(15, 'amalia_ku@gmail.com', 'c129b324aee662b04eccf68babba85851346dff9', 'Amalia Kurniawati Utami', '081236217165', '', '', '15_1584976264.jpg', 'usr', 1, NULL, '2020-03-21 18:32:31', '2020-03-23 15:11:04'),
(16, 'anggadian@gmail.com', 'c129b324aee662b04eccf68babba85851346dff9', 'Angga Dian Permana Putra', '085655611277', NULL, NULL, 'default.png', 'usr', 1, NULL, '2020-03-21 18:32:31', '2020-03-25 06:25:24'),
(17, 'abdulqodar2311@gmail.com', 'c129b324aee662b04eccf68babba85851346dff9', 'Ash Allukal Abdul Qodar', '0878835422483', NULL, NULL, 'default.png', 'usr', 1, NULL, '2020-03-21 18:32:31', '2020-03-21 18:32:31'),
(18, 'apriliakd@gmail.com', 'c129b324aee662b04eccf68babba85851346dff9', 'Aprilia Kusuma Dewi', '082325290779', NULL, NULL, 'default.png', 'usr', 1, NULL, '2020-03-21 18:32:31', '2020-03-21 18:32:31'),
(19, 'alief.23@gmail.com', 'c129b324aee662b04eccf68babba85851346dff9', 'Alief Surya Nugraha', '081575195344', NULL, NULL, 'default.png', 'usr', 1, NULL, '2020-03-21 18:32:31', '2020-03-21 18:32:31'),
(20, 'arifaintanyulita@gmail.com', 'c129b324aee662b04eccf68babba85851346dff9', 'Arifah Intan Yulita', '085728434099', NULL, NULL, 'default.png', 'usr', 1, NULL, '2020-03-21 18:32:31', '2020-03-21 18:32:31'),
(21, 'desiwulandari@gmail.com', 'c129b324aee662b04eccf68babba85851346dff9', 'Desi Wulandari', '089521565748', NULL, NULL, 'default.png', 'usr', 1, NULL, '2020-03-21 18:32:31', '2020-03-21 18:32:31'),
(22, 'annisaradya@gmail.com', 'c129b324aee662b04eccf68babba85851346dff9', 'Annisa Radya Suryandari', '082242777079', NULL, NULL, 'default.png', 'usr', 1, NULL, '2020-03-21 18:32:31', '2020-03-21 18:32:31'),
(23, 'bernandomahulae@gmail.com', 'c129b324aee662b04eccf68babba85851346dff9', 'Bernando Haybet Mahulae', '085270721625', NULL, NULL, 'default.png', 'usr', 1, NULL, '2020-03-21 18:32:31', '2020-03-21 18:32:31'),
(24, 'aminrohmat168@gmail.com', 'c129b324aee662b04eccf68babba85851346dff9', 'Amin Rohmat Choironi', '085647118117', NULL, NULL, 'default.png', 'usr', 1, NULL, '2020-03-21 18:32:31', '2020-03-25 06:25:31'),
(25, 'afifanomita@gmail.com', 'c129b324aee662b04eccf68babba85851346dff9', 'Afifa Nomita Dewi', '085642054578', NULL, NULL, 'default.png', 'usr', 1, NULL, '2020-03-21 18:32:31', '2020-03-21 18:32:31'),
(26, 'albertdeoo@gmail.com', 'c129b324aee662b04eccf68babba85851346dff9', 'Albert Deo Hesa Kusuma', '085780335583', NULL, NULL, 'default.png', 'usr', 1, NULL, '2020-03-21 18:32:31', '2020-03-21 18:32:31'),
(27, 'aoron_sulistyono98@gmail.com', 'c129b324aee662b04eccf68babba85851346dff9', 'Aoron Sulistyono', '085702411281', NULL, NULL, 'default.png', 'usr', 1, NULL, '2020-03-21 18:32:31', '2020-03-21 18:32:31'),
(29, 'jane_evelin@gmail.com', 'c129b324aee662b04eccf68babba85851346dff9', 'Jane', '082312341234', NULL, NULL, 'default.png', 'usr', 1, NULL, '2020-03-25 06:30:09', '2020-03-25 06:30:09');

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(20) DEFAULT NULL,
  `web_browser` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `ip_address`, `web_browser`, `created_at`) VALUES
(1, '::1', 'Chrome', '2019-03-15 05:43:43'),
(2, '::1', 'Edge', '2019-03-15 05:44:05'),
(3, '::1', 'Opera', '2019-03-15 06:07:05'),
(4, '::1', 'Firefox', '2019-03-15 06:08:27'),
(5, '::1', 'Chrome', '2019-03-15 06:08:45'),
(6, '::1', 'Chrome', '2019-03-15 06:25:10'),
(7, '::1', 'Chrome', '2019-03-15 06:25:13'),
(8, '::1', 'Chrome', '2019-03-15 06:25:39'),
(9, '::1', 'Chrome', '2019-03-15 06:26:59'),
(10, '::1', 'Chrome', '2019-03-15 06:27:06'),
(11, '::1', 'Chrome', '2019-03-15 06:27:37'),
(12, '::1', 'Chrome', '2019-03-15 06:28:31'),
(13, '::1', 'Chrome', '2019-03-15 06:29:02'),
(14, '::1', 'Chrome', '2019-03-15 06:38:33'),
(15, '::1', 'Chrome', '2019-03-15 06:42:01'),
(16, '::1', 'Chrome', '2019-03-15 06:43:06'),
(17, '::1', 'Chrome', '2019-03-16 15:11:26'),
(18, '::1', 'Chrome', '2019-03-17 11:42:32'),
(19, '::1', 'Chrome', '2019-03-18 05:24:19'),
(20, '::1', 'Chrome', '2019-03-18 06:11:00'),
(21, '::1', 'Chrome', '2019-03-18 06:11:03'),
(22, '::1', 'Chrome', '2019-03-18 06:11:04'),
(23, '::1', 'Chrome', '2019-03-18 06:11:05'),
(24, '::1', 'Chrome', '2019-03-18 06:11:05'),
(25, '::1', 'Edge', '2019-03-18 06:11:30'),
(26, '::1', 'Chrome', '2019-03-19 01:45:17'),
(27, '::1', 'Chrome', '2019-03-20 12:54:32'),
(28, '::1', 'Chrome', '2019-03-20 12:54:39'),
(29, '::1', 'Chrome', '2019-03-21 01:09:18'),
(30, '::1', 'Chrome', '2019-03-21 01:09:38'),
(31, '::1', 'Chrome', '2019-03-21 01:09:40'),
(32, '::1', 'Chrome', '2019-03-21 01:09:40'),
(33, '::1', 'Chrome', '2019-03-21 01:09:41'),
(34, '::1', 'Chrome', '2019-03-21 01:09:41'),
(35, '::1', 'Chrome', '2019-03-21 01:09:42'),
(36, '::1', 'Chrome', '2019-03-21 01:09:48'),
(37, '::1', 'Chrome', '2019-03-21 01:09:48'),
(38, '::1', 'Chrome', '2019-03-21 01:09:49'),
(39, '::1', 'Chrome', '2019-03-21 07:33:53'),
(40, '::1', 'Chrome', '2019-03-21 07:34:05'),
(41, '::1', 'Chrome', '2019-03-21 07:44:41'),
(42, '::1', 'Chrome', '2019-03-22 10:40:43'),
(43, '::1', 'Chrome', '2019-03-22 10:40:59'),
(44, '::1', 'Chrome', '2019-03-22 10:41:41'),
(45, '::1', 'Chrome', '2019-03-22 10:44:55'),
(46, '::1', 'Chrome', '2019-03-22 10:46:21'),
(47, '::1', 'Chrome', '2019-03-22 10:47:17'),
(48, '::1', 'Chrome', '2019-03-23 13:58:43'),
(49, '::1', 'Chrome', '2019-03-25 08:38:40'),
(50, '::1', 'Chrome', '2019-03-26 03:18:14'),
(51, '::1', 'Chrome', '2019-03-28 13:19:43'),
(52, '::1', 'Chrome', '2019-03-29 04:20:17'),
(53, '::1', 'Chrome', '2019-04-01 15:16:15'),
(54, '::1', 'Chrome', '2019-04-01 17:36:20'),
(55, '::1', 'Chrome', '2019-04-03 10:44:55'),
(56, '::1', 'Chrome', '2019-04-04 10:50:25'),
(57, '::1', 'Chrome', '2019-04-04 17:09:29'),
(58, '::1', 'Chrome', '2019-04-09 10:32:20'),
(59, '::1', 'Chrome', '2019-04-10 07:00:03'),
(60, '::1', 'Chrome', '2019-04-11 06:21:46'),
(61, '::1', 'Chrome', '2019-04-12 03:08:07'),
(62, '::1', 'Chrome', '2019-04-13 00:41:33'),
(63, '::1', 'Chrome', '2019-04-14 04:10:28'),
(64, '::1', 'Chrome', '2019-04-15 10:44:57'),
(65, '::1', 'Chrome', '2019-04-18 04:56:37'),
(66, '::1', 'Chrome', '2019-04-19 01:48:52'),
(67, '::1', 'Chrome', '2019-04-20 07:47:20'),
(68, '::1', 'Chrome', '2019-04-22 09:02:03'),
(69, '::1', 'Chrome', '2019-04-23 12:09:04'),
(70, '::1', 'Chrome', '2019-04-24 01:34:57'),
(71, '::1', 'Chrome', '2019-04-24 17:34:02'),
(72, '::1', 'Chrome', '2019-04-26 03:16:30'),
(73, '::1', 'Chrome', '2019-04-27 14:40:16'),
(74, '::1', 'Chrome', '2019-04-28 11:59:59'),
(75, '::1', 'Chrome', '2019-04-29 14:45:13'),
(76, '::1', 'Chrome', '2019-04-30 02:31:45'),
(77, '::1', 'Chrome', '2019-05-01 13:35:56'),
(78, '::1', 'Chrome', '2019-05-02 13:31:55'),
(79, '::1', 'Chrome', '2019-05-03 06:06:27'),
(80, '::1', 'Chrome', '2019-05-04 01:19:34'),
(81, '::1', 'Chrome', '2019-05-05 04:55:44'),
(82, '::1', 'Chrome', '2019-05-08 09:48:26'),
(83, '::1', 'Chrome', '2019-05-09 05:19:03'),
(84, '::1', 'Chrome', '2019-05-09 10:16:22'),
(85, '::1', 'Edge', '2019-05-10 10:42:32'),
(86, '::1', 'Chrome', '2019-05-11 12:31:02'),
(87, '::1', 'Chrome', '2019-05-12 06:40:06'),
(88, '::1', 'Chrome', '2019-05-13 06:20:52'),
(89, '::1', 'Chrome', '2019-05-14 04:31:18'),
(90, '::1', 'Chrome', '2019-05-15 04:36:04'),
(91, '::1', 'Chrome', '2019-05-16 09:15:17'),
(92, '::1', 'Chrome', '2019-05-17 05:44:12'),
(93, '::1', 'Chrome', '2019-05-18 06:44:50'),
(94, '::1', 'Chrome', '2019-05-19 03:31:20'),
(95, '::1', 'Chrome', '2019-05-20 05:53:43'),
(96, '::1', 'Edge', '2019-05-20 06:31:05'),
(97, '::1', 'Chrome', '2019-05-21 09:09:17'),
(98, '10.11.6.39', 'Chrome', '2019-05-22 05:48:03'),
(99, '10.11.6.39', 'Chrome', '2019-05-22 06:12:56'),
(100, '10.11.6.39', 'Firefox', '2019-05-22 06:13:17'),
(101, '10.11.6.39', 'Chrome', '2019-05-22 06:13:58'),
(102, '10.11.6.39', 'Chrome', '2019-05-22 06:14:33'),
(103, '10.11.6.39', 'Chrome', '2019-05-22 06:14:34'),
(104, '10.11.6.39', 'Chrome', '2019-05-22 06:14:35'),
(105, '10.11.6.39', 'Chrome', '2019-05-22 06:14:36'),
(106, '10.11.6.39', 'Firefox', '2019-05-22 06:15:37'),
(107, '10.11.6.39', 'Firefox', '2019-05-22 06:15:50'),
(108, '10.11.6.39', 'Firefox', '2019-05-22 06:15:57'),
(109, '10.11.6.39', 'Firefox', '2019-05-22 06:16:29'),
(110, '10.11.6.39', 'Firefox', '2019-05-22 06:16:42'),
(111, '10.11.6.39', 'Firefox', '2019-05-22 06:16:52'),
(112, '10.11.6.39', 'Firefox', '2019-05-22 06:17:25'),
(113, '10.11.6.39', 'Firefox', '2019-05-22 06:24:25'),
(114, '10.11.6.39', 'Firefox', '2019-05-22 06:24:42'),
(115, '10.11.6.39', 'Firefox', '2019-05-22 06:24:50'),
(116, '10.11.6.39', 'Firefox', '2019-05-22 06:25:00'),
(117, '10.11.6.39', 'Firefox', '2019-05-22 06:26:09'),
(118, '10.11.6.39', 'Firefox', '2019-05-22 06:26:40'),
(119, '10.11.6.39', 'Firefox', '2019-05-22 06:26:47'),
(120, '10.11.6.39', 'Firefox', '2019-05-22 06:26:52'),
(121, '10.11.6.39', 'Firefox', '2019-05-22 06:27:05'),
(122, '10.11.6.39', 'Firefox', '2019-05-22 06:27:21'),
(123, '10.11.6.39', 'Firefox', '2019-05-22 06:27:24'),
(124, '10.11.6.39', 'Firefox', '2019-05-22 06:27:57'),
(125, '10.11.6.39', 'Firefox', '2019-05-22 06:28:08'),
(126, '10.11.6.39', 'Chrome', '2019-05-22 06:28:48'),
(127, '::1', 'Chrome', '2019-05-22 10:52:33'),
(128, '::1', 'Chrome', '2019-05-23 04:41:40'),
(129, '::1', 'Chrome', '2019-05-24 01:15:42'),
(130, '::1', 'Chrome', '2019-05-25 06:05:54'),
(131, '::1', 'Chrome', '2019-05-26 04:45:22'),
(132, '::1', 'Chrome', '2019-05-27 07:01:35'),
(133, '::1', 'Chrome', '2019-05-28 06:00:51'),
(134, '::1', 'Chrome', '2019-05-29 04:55:23'),
(135, '127.0.0.1', 'Firefox', '2019-06-15 13:48:01'),
(136, '127.0.0.1', 'Firefox', '2019-06-15 17:01:42'),
(137, '::1', 'Chrome', '2019-06-19 10:33:20'),
(138, '::1', 'Chrome', '2019-06-20 07:05:36'),
(139, '::1', 'Firefox', '2019-09-14 02:22:00'),
(140, '::1', 'Firefox', '2019-09-15 06:36:50'),
(141, '127.0.0.1', 'Firefox', '2019-09-17 00:52:37'),
(142, '::1', 'Firefox', '2019-09-17 02:25:49'),
(143, '127.0.0.1', 'Firefox', '2019-09-20 11:56:31'),
(144, '::1', 'Firefox', '2019-09-21 01:49:49'),
(145, '127.0.0.1', 'Firefox', '2020-02-22 23:26:43'),
(146, '127.0.0.1', 'Firefox', '2020-02-24 06:52:03'),
(147, '127.0.0.1', 'Firefox', '2020-02-25 00:06:47'),
(148, '127.0.0.1', 'Firefox', '2020-03-25 10:58:06'),
(149, '127.0.0.1', 'Firefox', '2020-04-15 08:05:24');

-- --------------------------------------------------------

--
-- Table structure for table `withdraws`
--

CREATE TABLE `withdraws` (
  `id` int(11) NOT NULL,
  `event` int(11) NOT NULL,
  `link` varchar(255) NOT NULL,
  `message` varchar(100) DEFAULT NULL,
  `status` set('submitted','approved','rejected') NOT NULL DEFAULT 'submitted',
  `status_description` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `validated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_category`
--
ALTER TABLE `event_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inboxes`
--
ALTER TABLE `inboxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_category`
--
ALTER TABLE `news_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_history`
--
ALTER TABLE `payment_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `publishers`
--
ALTER TABLE `publishers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraws`
--
ALTER TABLE `withdraws`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `event_category`
--
ALTER TABLE `event_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `inboxes`
--
ALTER TABLE `inboxes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `news_category`
--
ALTER TABLE `news_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `payment_history`
--
ALTER TABLE `payment_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `withdraws`
--
ALTER TABLE `withdraws`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
