-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2015 at 02:54 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `aaa_bundling_software`
--

-- --------------------------------------------------------

--
-- Table structure for table `bundles`
--

CREATE TABLE IF NOT EXISTS `bundles` (
  `bundle_no` int(11) NOT NULL AUTO_INCREMENT,
  `user_no` int(11) NOT NULL,
  `bundle_name` varchar(50) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL,
  `created_date` timestamp NOT NULL,
  `modified_date` timestamp NOT NULL,
  `bundle_warranty` varchar(100) NOT NULL,
  PRIMARY KEY (`bundle_no`),
  KEY `user_no` (`user_no`,`created_date`,`modified_date`),
  KEY `user_no_2` (`user_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=71 ;

--
-- Dumping data for table `bundles`
--

INSERT INTO `bundles` (`bundle_no`, `user_no`, `bundle_name`, `deleted`, `created_date`, `modified_date`, `bundle_warranty`) VALUES
(1, 1, 'First Bundle', 1, '2014-12-28 19:22:29', '2014-12-28 19:22:29', ''),
(2, 1, 'Second Bundle', 1, '2014-12-29 23:46:07', '2014-12-29 23:46:07', ''),
(3, 1, NULL, 1, '2015-01-21 00:23:54', '0000-00-00 00:00:00', ''),
(4, 1, NULL, 1, '2015-01-21 00:27:03', '0000-00-00 00:00:00', ''),
(5, 1, NULL, 1, '2015-01-21 00:27:07', '0000-00-00 00:00:00', ''),
(6, 1, 'Economy', 1, '2015-01-21 00:27:08', '0000-00-00 00:00:00', ''),
(7, 1, 'Value', 1, '2015-01-25 22:09:47', '0000-00-00 00:00:00', ''),
(8, 1, 'First Bundle Duplicate', 1, '2015-01-25 22:44:37', '2015-01-25 22:44:37', ''),
(9, 1, 'Second Bundle Duplicate', 1, '2015-01-25 22:44:37', '2015-01-25 22:44:37', ''),
(10, 1, NULL, 1, '2015-01-25 22:44:37', '2015-01-25 22:44:37', ''),
(11, 1, NULL, 1, '2015-01-25 22:44:37', '2015-01-25 22:44:37', ''),
(12, 1, NULL, 1, '2015-01-25 22:44:37', '2015-01-25 22:44:37', ''),
(13, 1, NULL, 1, '2015-01-25 22:44:37', '2015-01-25 22:44:37', ''),
(14, 1, NULL, 1, '2015-01-25 22:44:37', '2015-01-25 22:44:37', ''),
(15, 1, NULL, 1, '2015-01-25 22:47:19', '2015-01-25 22:47:19', ''),
(16, 1, NULL, 1, '2015-01-25 22:50:17', '2015-01-25 22:50:17', ''),
(17, 1, NULL, 1, '2015-01-25 22:52:26', '2015-01-25 22:52:26', ''),
(18, 1, NULL, 1, '2015-01-25 22:52:40', '2015-01-25 22:52:40', ''),
(19, 1, NULL, 1, '2015-01-25 22:52:44', '2015-01-25 22:52:44', ''),
(20, 2, 'Economy', 1, '2015-01-29 01:03:32', '0000-00-00 00:00:00', ''),
(21, 2, 'Value', 1, '2015-01-30 00:56:35', '2015-01-30 00:56:35', ''),
(22, 2, NULL, 1, '2015-01-30 01:05:14', '0000-00-00 00:00:00', ''),
(23, 2, 'Economy', 1, '2015-01-30 01:06:15', '0000-00-00 00:00:00', ''),
(24, 2, NULL, 1, '2015-01-30 01:12:11', '0000-00-00 00:00:00', ''),
(25, 2, NULL, 1, '2015-01-30 01:12:40', '0000-00-00 00:00:00', ''),
(26, 2, 'First Bundle', 1, '2015-01-30 01:12:47', '0000-00-00 00:00:00', ''),
(27, 2, 'Value', 1, '2015-01-30 01:12:51', '0000-00-00 00:00:00', ''),
(28, 2, 'Economy', 1, '2015-01-30 01:13:46', '0000-00-00 00:00:00', ''),
(29, 2, 'New Title', 1, '2015-01-30 01:48:43', '0000-00-00 00:00:00', ''),
(30, 2, NULL, 1, '2015-02-02 00:54:21', '0000-00-00 00:00:00', ' 1 Year'),
(31, 2, NULL, 1, '2015-02-02 00:56:22', '2015-02-02 00:56:22', ' 3 Months'),
(32, 2, NULL, 1, '2015-02-02 01:16:03', '2015-02-02 01:16:03', ''),
(33, 2, NULL, 1, '2015-02-02 01:16:34', '2015-02-02 01:16:34', ' 1 Year'),
(34, 2, NULL, 1, '2015-02-02 01:28:35', '0000-00-00 00:00:00', ''),
(35, 2, NULL, 1, '2015-02-02 01:29:01', '0000-00-00 00:00:00', ''),
(36, 2, NULL, 1, '2015-02-02 01:29:14', '0000-00-00 00:00:00', ''),
(37, 2, NULL, 1, '2015-02-02 01:29:23', '0000-00-00 00:00:00', ''),
(38, 2, NULL, 1, '2015-02-02 01:29:29', '0000-00-00 00:00:00', ''),
(39, 2, NULL, 1, '2015-02-02 01:30:13', '0000-00-00 00:00:00', ''),
(40, 2, NULL, 1, '2015-02-02 01:30:14', '0000-00-00 00:00:00', ''),
(41, 2, NULL, 1, '2015-02-02 01:30:33', '0000-00-00 00:00:00', ''),
(42, 2, NULL, 1, '2015-02-02 01:30:33', '0000-00-00 00:00:00', ''),
(43, 2, NULL, 1, '2015-02-02 01:30:33', '0000-00-00 00:00:00', ''),
(44, 2, NULL, 1, '2015-02-02 01:31:18', '0000-00-00 00:00:00', ''),
(45, 2, NULL, 1, '2015-02-02 01:31:18', '0000-00-00 00:00:00', ''),
(46, 2, NULL, 1, '2015-02-02 01:32:00', '0000-00-00 00:00:00', ''),
(47, 2, NULL, 1, '2015-02-02 01:32:01', '0000-00-00 00:00:00', ''),
(48, 2, NULL, 1, '2015-02-02 01:32:01', '0000-00-00 00:00:00', ''),
(49, 2, NULL, 1, '2015-02-02 01:32:24', '0000-00-00 00:00:00', ''),
(50, 2, NULL, 1, '2015-02-02 01:32:24', '0000-00-00 00:00:00', ''),
(51, 2, NULL, 1, '2015-02-02 01:32:24', '0000-00-00 00:00:00', ''),
(52, 2, NULL, 1, '2015-02-02 01:32:25', '0000-00-00 00:00:00', ''),
(53, 2, NULL, 1, '2015-02-02 01:32:27', '0000-00-00 00:00:00', ''),
(54, 2, NULL, 1, '2015-02-02 01:32:27', '0000-00-00 00:00:00', ''),
(55, 2, NULL, 1, '2015-02-02 01:32:27', '0000-00-00 00:00:00', ''),
(56, 2, NULL, 1, '2015-02-02 01:32:27', '0000-00-00 00:00:00', ''),
(57, 2, NULL, 1, '2015-02-02 01:32:57', '0000-00-00 00:00:00', ''),
(58, 2, NULL, 1, '2015-02-02 01:32:58', '0000-00-00 00:00:00', ''),
(59, 2, NULL, 1, '2015-02-02 01:32:58', '0000-00-00 00:00:00', ''),
(60, 2, NULL, 1, '2015-02-02 01:33:23', '0000-00-00 00:00:00', ''),
(61, 2, NULL, 1, '2015-02-02 01:33:23', '0000-00-00 00:00:00', ''),
(62, 2, NULL, 1, '2015-02-02 01:33:23', '0000-00-00 00:00:00', ''),
(63, 2, NULL, 1, '2015-02-02 01:33:26', '0000-00-00 00:00:00', ''),
(64, 2, NULL, 1, '2015-02-02 01:33:26', '0000-00-00 00:00:00', ''),
(65, 2, NULL, 1, '2015-02-02 01:33:27', '0000-00-00 00:00:00', ''),
(66, 2, NULL, 1, '2015-02-02 01:33:27', '0000-00-00 00:00:00', ''),
(67, 2, NULL, 1, '2015-02-02 01:33:27', '0000-00-00 00:00:00', ''),
(68, 2, 'First Bundle', 0, '2015-02-02 01:36:42', '0000-00-00 00:00:00', ' 1 Year'),
(69, 2, NULL, 1, '2015-02-02 01:38:59', '0000-00-00 00:00:00', ''),
(70, 2, 'Second Bundle', 0, '2015-02-02 01:39:03', '2015-02-02 01:39:03', ' 1 Month');

-- --------------------------------------------------------

--
-- Table structure for table `bundle_parts`
--

CREATE TABLE IF NOT EXISTS `bundle_parts` (
  `bundle_part_no` int(11) NOT NULL AUTO_INCREMENT,
  `bundle_no` int(11) NOT NULL,
  `part_no` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`bundle_part_no`),
  KEY `bundle_no` (`bundle_no`,`part_no`),
  KEY `bundle_no_2` (`bundle_no`),
  KEY `part_no` (`part_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=225 ;

--
-- Dumping data for table `bundle_parts`
--

INSERT INTO `bundle_parts` (`bundle_part_no`, `bundle_no`, `part_no`, `deleted`) VALUES
(48, 2, 1, 0),
(49, 1, 1, 1),
(50, 1, 1, 1),
(51, 1, 1, 1),
(52, 1, 1, 1),
(53, 1, 1, 1),
(54, 1, 1, 1),
(55, 1, 2, 1),
(56, 1, 1, 1),
(57, 1, 1, 1),
(58, 1, 2, 1),
(59, 1, 3, 1),
(60, 1, 3, 1),
(61, 1, 2, 1),
(62, 1, 1, 1),
(63, 1, 1, 1),
(64, 1, 2, 1),
(65, 1, 2, 1),
(66, 1, 2, 1),
(67, 2, 1, 0),
(68, 2, 1, 0),
(69, 2, 1, 0),
(70, 2, 1, 0),
(71, 2, 1, 0),
(72, 2, 1, 0),
(73, 2, 1, 0),
(74, 2, 2, 0),
(75, 2, 2, 0),
(76, 1, 1, 1),
(77, 1, 1, 1),
(78, 1, 1, 1),
(79, 1, 2, 1),
(80, 1, 2, 1),
(81, 1, 2, 1),
(82, 1, 1, 1),
(83, 1, 3, 1),
(84, 1, 2, 1),
(85, 1, 2, 1),
(86, 1, 2, 1),
(87, 1, 3, 1),
(88, 4, 1, 0),
(89, 4, 1, 0),
(90, 4, 3, 0),
(91, 4, 2, 0),
(92, 4, 3, 0),
(93, 6, 1, 0),
(94, 6, 2, 0),
(95, 7, 3, 0),
(96, 7, 3, 0),
(97, 7, 3, 0),
(98, 7, 3, 0),
(99, 18, 1, 0),
(100, 18, 2, 0),
(102, 19, 3, 0),
(103, 19, 3, 0),
(104, 19, 3, 0),
(105, 19, 3, 0),
(109, 6, 3, 0),
(110, 6, 3, 0),
(111, 6, 2, 0),
(112, 6, 2, 0),
(113, 6, 3, 0),
(114, 20, 1, 1),
(115, 20, 2, 1),
(116, 20, 3, 1),
(117, 20, 2, 1),
(118, 20, 3, 1),
(119, 20, 2, 1),
(120, 20, 3, 1),
(121, 20, 2, 1),
(122, 20, 2, 1),
(123, 20, 2, 1),
(124, 20, 2, 1),
(125, 20, 2, 1),
(126, 21, 1, 0),
(127, 21, 3, 0),
(128, 21, 3, 0),
(129, 21, 3, 0),
(133, 20, 0, 1),
(134, 20, 0, 1),
(135, 20, 0, 1),
(136, 20, 0, 1),
(137, 20, 0, 1),
(138, 20, 0, 1),
(139, 20, 0, 1),
(140, 20, 3, 1),
(141, 20, 0, 1),
(142, 20, 2, 1),
(143, 20, 2, 1),
(144, 20, 2, 1),
(145, 20, 2, 1),
(146, 20, 3, 1),
(147, 20, 0, 1),
(148, 20, 0, 1),
(149, 20, 1, 1),
(150, 20, 3, 1),
(151, 20, 2, 1),
(152, 20, 1, 1),
(153, 20, 1, 1),
(154, 20, 1, 1),
(155, 20, 1, 1),
(156, 20, 1, 1),
(157, 20, 1, 1),
(158, 20, 1, 1),
(159, 20, 1, 1),
(160, 20, 1, 1),
(161, 20, 1, 1),
(162, 20, 1, 1),
(163, 20, 1, 1),
(164, 20, 1, 1),
(165, 20, 1, 1),
(166, 20, 1, 1),
(167, 20, 3, 1),
(168, 20, 3, 1),
(169, 20, 3, 1),
(170, 20, 3, 1),
(171, 20, 3, 1),
(172, 20, 3, 1),
(173, 20, 3, 1),
(174, 20, 3, 1),
(175, 20, 3, 1),
(176, 20, 3, 1),
(177, 20, 3, 1),
(178, 20, 3, 1),
(179, 20, 3, 1),
(180, 20, 3, 1),
(181, 20, 3, 1),
(182, 20, 3, 1),
(183, 20, 3, 1),
(184, 20, 3, 1),
(185, 20, 3, 1),
(186, 20, 3, 1),
(187, 20, 3, 1),
(188, 20, 3, 1),
(189, 20, 1, 0),
(190, 20, 2, 0),
(191, 20, 3, 0),
(192, 20, 2, 0),
(193, 20, 1, 0),
(194, 20, 2, 0),
(195, 20, 2, 0),
(196, 23, 1, 0),
(197, 23, 1, 0),
(198, 23, 2, 0),
(199, 23, 2, 0),
(200, 27, 3, 0),
(201, 27, 1, 0),
(202, 27, 2, 0),
(203, 27, 1, 0),
(204, 28, 2, 0),
(205, 28, 2, 0),
(206, 28, 2, 0),
(207, 29, 3, 0),
(208, 29, 3, 0),
(209, 29, 2, 0),
(210, 29, 2, 0),
(211, 68, 2, 1),
(212, 68, 1, 0),
(213, 68, 3, 1),
(214, 68, 3, 1),
(215, 68, 3, 1),
(216, 68, 3, 0),
(217, 70, 1, 0),
(218, 70, 2, 0),
(219, 70, 3, 0),
(220, 70, 3, 1),
(221, 70, 3, 0),
(222, 70, 3, 0),
(224, 68, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ip_addresses`
--

CREATE TABLE IF NOT EXISTS `ip_addresses` (
  `primary_key` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(20) NOT NULL,
  `user_no` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL,
  PRIMARY KEY (`primary_key`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ip_addresses`
--

INSERT INTO `ip_addresses` (`primary_key`, `ip_address`, `user_no`, `timestamp`) VALUES
(1, '127.0.0.1', 1, '2014-12-13 17:14:58');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `menu_item_no` int(11) NOT NULL AUTO_INCREMENT,
  `menu_item_name` varchar(20) NOT NULL,
  `menu_item_display` varchar(40) NOT NULL,
  `glyphicon` varchar(30) NOT NULL,
  PRIMARY KEY (`menu_item_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_item_no`, `menu_item_name`, `menu_item_display`, `glyphicon`) VALUES
(1, 'create_bundles', 'Create Bundles', 'document-add'),
(2, 'user_login', 'Login', 'user'),
(3, 'customer_view', 'Present To Customer', 'document-text');

-- --------------------------------------------------------

--
-- Table structure for table `parts`
--

CREATE TABLE IF NOT EXISTS `parts` (
  `part_no` int(11) NOT NULL AUTO_INCREMENT,
  `part_num` varchar(50) DEFAULT NULL,
  `appliance` varchar(50) DEFAULT NULL,
  `brand` varchar(50) DEFAULT NULL,
  `part_type` varchar(50) DEFAULT NULL,
  `part_description` text,
  `price` float NOT NULL,
  PRIMARY KEY (`part_no`),
  KEY `part_key` (`part_no`,`part_num`,`appliance`,`brand`,`part_type`),
  KEY `part_type` (`part_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `parts`
--

INSERT INTO `parts` (`part_no`, `part_num`, `appliance`, `brand`, `part_type`, `part_description`, `price`) VALUES
(1, '00001', 'Washer', 'GE', 'Ignition', 'Bulb', 1.22),
(2, '00002', 'Dryer', 'Whirlpool', 'Ignition', 'Fuse', 3.44),
(3, '00003', 'Dryer', 'GE', 'Ignition', 'Element', 4.59);

-- --------------------------------------------------------

--
-- Table structure for table `part_uses`
--

CREATE TABLE IF NOT EXISTS `part_uses` (
  `part_use_no` int(11) NOT NULL AUTO_INCREMENT,
  `use_count` int(11) NOT NULL,
  `user_no` int(11) NOT NULL,
  `part_no` int(11) NOT NULL,
  PRIMARY KEY (`part_use_no`),
  UNIQUE KEY `force_unique` (`user_no`,`part_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `part_uses`
--

INSERT INTO `part_uses` (`part_use_no`, `use_count`, `user_no`, `part_no`) VALUES
(1, 25, 2, 2),
(2, 36, 2, 3),
(10, 10, 2, 0),
(26, 23, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_no` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) NOT NULL,
  PRIMARY KEY (`user_no`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_no`, `user_name`) VALUES
(2, 'AimeeShulman'),
(1, 'DanSmith');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
