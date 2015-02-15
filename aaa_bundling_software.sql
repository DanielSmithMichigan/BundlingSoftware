-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2015 at 02:09 AM
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
  `final_price` float DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL,
  `created_date` timestamp NOT NULL,
  `modified_date` timestamp NOT NULL,
  `bundle_warranty` varchar(100) NOT NULL,
  PRIMARY KEY (`bundle_no`),
  KEY `user_no` (`user_no`,`created_date`,`modified_date`),
  KEY `user_no_2` (`user_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=90 ;

--
-- Dumping data for table `bundles`
--

INSERT INTO `bundles` (`bundle_no`, `user_no`, `bundle_name`, `final_price`, `deleted`, `created_date`, `modified_date`, `bundle_warranty`) VALUES
(83, 3, 'Economy', NULL, 1, '2015-02-14 03:55:49', '2015-02-14 03:55:49', ''),
(84, 3, 'Value', NULL, 1, '2015-02-14 03:20:21', '2015-02-14 03:20:21', ''),
(85, 3, 'Economy Duplicate', NULL, 1, '2015-02-14 03:23:34', '2015-02-14 03:23:34', ''),
(86, 3, 'Economy Duplicate', 1.56, 1, '2015-02-14 03:23:37', '2015-02-14 03:23:37', ''),
(87, 3, 'Economy', NULL, 1, '2015-02-14 03:56:19', '0000-00-00 00:00:00', '1 Week'),
(88, 3, 'Value', 18, 1, '2015-02-14 03:58:18', '2015-02-14 03:58:18', ' 1 Year'),
(89, 3, NULL, NULL, 0, '2015-02-14 04:01:18', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `bundle_parts`
--

CREATE TABLE IF NOT EXISTS `bundle_parts` (
  `bundle_part_no` int(11) NOT NULL AUTO_INCREMENT,
  `bundle_no` int(11) NOT NULL,
  `part_no` int(11) NOT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'primary',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`bundle_part_no`),
  KEY `bundle_no` (`bundle_no`,`part_no`),
  KEY `bundle_no_2` (`bundle_no`),
  KEY `part_no` (`part_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=498 ;

--
-- Dumping data for table `bundle_parts`
--

INSERT INTO `bundle_parts` (`bundle_part_no`, `bundle_no`, `part_no`, `type`, `deleted`) VALUES
(48, 2, 1, 'primary', 0),
(49, 1, 1, 'primary', 1),
(50, 1, 1, 'primary', 1),
(51, 1, 1, 'primary', 1),
(52, 1, 1, 'primary', 1),
(53, 1, 1, 'primary', 1),
(54, 1, 1, 'primary', 1),
(55, 1, 2, 'primary', 1),
(56, 1, 1, 'primary', 1),
(57, 1, 1, 'primary', 1),
(58, 1, 2, 'primary', 1),
(59, 1, 3, 'primary', 1),
(60, 1, 3, 'primary', 1),
(61, 1, 2, 'primary', 1),
(62, 1, 1, 'primary', 1),
(63, 1, 1, 'primary', 1),
(64, 1, 2, 'primary', 1),
(65, 1, 2, 'primary', 1),
(66, 1, 2, 'primary', 1),
(67, 2, 1, 'primary', 0),
(68, 2, 1, 'primary', 0),
(69, 2, 1, 'primary', 0),
(70, 2, 1, 'primary', 0),
(71, 2, 1, 'primary', 0),
(72, 2, 1, 'primary', 0),
(73, 2, 1, 'primary', 0),
(74, 2, 2, 'primary', 0),
(75, 2, 2, 'primary', 0),
(76, 1, 1, 'primary', 1),
(77, 1, 1, 'primary', 1),
(78, 1, 1, 'primary', 1),
(79, 1, 2, 'primary', 1),
(80, 1, 2, 'primary', 1),
(81, 1, 2, 'primary', 1),
(82, 1, 1, 'primary', 1),
(83, 1, 3, 'primary', 1),
(84, 1, 2, 'primary', 1),
(85, 1, 2, 'primary', 1),
(86, 1, 2, 'primary', 1),
(87, 1, 3, 'primary', 1),
(88, 4, 1, 'primary', 0),
(89, 4, 1, 'primary', 0),
(90, 4, 3, 'primary', 0),
(91, 4, 2, 'primary', 0),
(92, 4, 3, 'primary', 0),
(93, 6, 1, 'primary', 0),
(94, 6, 2, 'primary', 0),
(95, 7, 3, 'primary', 0),
(96, 7, 3, 'primary', 0),
(97, 7, 3, 'primary', 0),
(98, 7, 3, 'primary', 0),
(99, 18, 1, 'primary', 0),
(100, 18, 2, 'primary', 0),
(102, 19, 3, 'primary', 0),
(103, 19, 3, 'primary', 0),
(104, 19, 3, 'primary', 0),
(105, 19, 3, 'primary', 0),
(109, 6, 3, 'primary', 0),
(110, 6, 3, 'primary', 0),
(111, 6, 2, 'primary', 0),
(112, 6, 2, 'primary', 0),
(113, 6, 3, 'primary', 0),
(114, 20, 1, 'primary', 1),
(115, 20, 2, 'primary', 1),
(116, 20, 3, 'primary', 1),
(117, 20, 2, 'primary', 1),
(118, 20, 3, 'primary', 1),
(119, 20, 2, 'primary', 1),
(120, 20, 3, 'primary', 1),
(121, 20, 2, 'primary', 1),
(122, 20, 2, 'primary', 1),
(123, 20, 2, 'primary', 1),
(124, 20, 2, 'primary', 1),
(125, 20, 2, 'primary', 1),
(126, 21, 1, 'primary', 0),
(127, 21, 3, 'primary', 0),
(128, 21, 3, 'primary', 0),
(129, 21, 3, 'primary', 0),
(133, 20, 0, 'primary', 1),
(134, 20, 0, 'primary', 1),
(135, 20, 0, 'primary', 1),
(136, 20, 0, 'primary', 1),
(137, 20, 0, 'primary', 1),
(138, 20, 0, 'primary', 1),
(139, 20, 0, 'primary', 1),
(140, 20, 3, 'primary', 1),
(141, 20, 0, 'primary', 1),
(142, 20, 2, 'primary', 1),
(143, 20, 2, 'primary', 1),
(144, 20, 2, 'primary', 1),
(145, 20, 2, 'primary', 1),
(146, 20, 3, 'primary', 1),
(147, 20, 0, 'primary', 1),
(148, 20, 0, 'primary', 1),
(149, 20, 1, 'primary', 1),
(150, 20, 3, 'primary', 1),
(151, 20, 2, 'primary', 1),
(152, 20, 1, 'primary', 1),
(153, 20, 1, 'primary', 1),
(154, 20, 1, 'primary', 1),
(155, 20, 1, 'primary', 1),
(156, 20, 1, 'primary', 1),
(157, 20, 1, 'primary', 1),
(158, 20, 1, 'primary', 1),
(159, 20, 1, 'primary', 1),
(160, 20, 1, 'primary', 1),
(161, 20, 1, 'primary', 1),
(162, 20, 1, 'primary', 1),
(163, 20, 1, 'primary', 1),
(164, 20, 1, 'primary', 1),
(165, 20, 1, 'primary', 1),
(166, 20, 1, 'primary', 1),
(167, 20, 3, 'primary', 1),
(168, 20, 3, 'primary', 1),
(169, 20, 3, 'primary', 1),
(170, 20, 3, 'primary', 1),
(171, 20, 3, 'primary', 1),
(172, 20, 3, 'primary', 1),
(173, 20, 3, 'primary', 1),
(174, 20, 3, 'primary', 1),
(175, 20, 3, 'primary', 1),
(176, 20, 3, 'primary', 1),
(177, 20, 3, 'primary', 1),
(178, 20, 3, 'primary', 1),
(179, 20, 3, 'primary', 1),
(180, 20, 3, 'primary', 1),
(181, 20, 3, 'primary', 1),
(182, 20, 3, 'primary', 1),
(183, 20, 3, 'primary', 1),
(184, 20, 3, 'primary', 1),
(185, 20, 3, 'primary', 1),
(186, 20, 3, 'primary', 1),
(187, 20, 3, 'primary', 1),
(188, 20, 3, 'primary', 1),
(189, 20, 1, 'primary', 0),
(190, 20, 2, 'primary', 0),
(191, 20, 3, 'primary', 0),
(192, 20, 2, 'primary', 0),
(193, 20, 1, 'primary', 0),
(194, 20, 2, 'primary', 0),
(195, 20, 2, 'primary', 0),
(196, 23, 1, 'primary', 0),
(197, 23, 1, 'primary', 0),
(198, 23, 2, 'primary', 0),
(199, 23, 2, 'primary', 0),
(200, 27, 3, 'primary', 0),
(201, 27, 1, 'primary', 0),
(202, 27, 2, 'primary', 0),
(203, 27, 1, 'primary', 0),
(204, 28, 2, 'primary', 0),
(205, 28, 2, 'primary', 0),
(206, 28, 2, 'primary', 0),
(207, 29, 3, 'primary', 0),
(208, 29, 3, 'primary', 0),
(209, 29, 2, 'primary', 0),
(210, 29, 2, 'primary', 0),
(211, 68, 2, 'primary', 1),
(212, 68, 1, 'primary', 0),
(213, 68, 3, 'primary', 1),
(214, 68, 3, 'primary', 1),
(215, 68, 3, 'primary', 1),
(216, 68, 3, 'primary', 0),
(217, 70, 1, 'primary', 0),
(218, 70, 2, 'primary', 0),
(219, 70, 3, 'primary', 0),
(220, 70, 3, 'primary', 1),
(221, 70, 3, 'primary', 0),
(222, 70, 3, 'primary', 0),
(224, 68, 3, 'primary', 0),
(225, 71, 1, 'primary', 1),
(226, 71, 3, 'primary', 1),
(227, 71, 3, 'primary', 1),
(228, 71, 3, 'primary', 1),
(229, 71, 3, 'primary', 0),
(230, 71, 3, 'primary', 0),
(231, 71, 3, 'primary', 0),
(232, 71, 3, 'primary', 0),
(233, 71, 3, 'primary', 0),
(234, 71, 3, 'primary', 0),
(235, 71, 3, 'primary', 0),
(236, 71, 3, 'primary', 0),
(237, 71, 3, 'primary', 0),
(238, 71, 3, 'primary', 0),
(239, 71, 3, 'primary', 0),
(240, 71, 3, 'primary', 0),
(241, 71, 3, 'primary', 0),
(242, 71, 3, 'primary', 0),
(243, 71, 3, 'primary', 0),
(244, 71, 3, 'primary', 0),
(245, 71, 3, 'primary', 0),
(246, 71, 3, 'primary', 0),
(247, 71, 3, 'primary', 0),
(248, 71, 3, 'primary', 0),
(249, 71, 3, 'primary', 0),
(250, 71, 1, 'primary', 0),
(251, 71, 2, 'primary', 0),
(252, 72, 1, 'primary', 0),
(253, 72, 2, 'primary', 0),
(254, 72, 3, 'primary', 0),
(255, 73, 1, 'primary', 0),
(256, 73, 1, 'primary', 1),
(257, 73, 2, 'primary', 0),
(258, 73, 2, 'primary', 0),
(259, 73, 3, 'primary', 0),
(260, 73, 3, 'primary', 0),
(261, 73, 3, 'primary', 0),
(262, 73, 3, 'primary', 0),
(263, 73, 1, 'primary', 1),
(264, 73, 1, 'primary', 0),
(265, 73, 1, 'primary', 0),
(266, 73, 1, 'primary', 0),
(267, 73, 1, 'secondary', 0),
(268, 73, 1, 'secondary', 0),
(269, 73, 3, 'secondary', 0),
(270, 73, 3, 'secondary', 0),
(271, 73, 1, 'primary', 0),
(272, 73, 1, 'primary', 0),
(273, 73, 1, 'primary', 0),
(274, 73, 1, 'primary', 0),
(275, 73, 1, 'primary', 0),
(276, 73, 1, 'primary', 0),
(277, 73, 1, 'primary', 0),
(278, 73, 1, 'primary', 0),
(279, 73, 1, 'primary', 0),
(280, 73, 1, 'primary', 0),
(281, 74, 1, 'primary', 0),
(282, 74, 1, 'primary', 0),
(283, 74, 1, 'primary', 0),
(284, 74, 1, 'primary', 0),
(285, 74, 1, 'secondary', 0),
(286, 74, 1, 'secondary', 0),
(287, 74, 1, 'primary', 0),
(288, 74, 1, 'primary', 0),
(289, 74, 1, 'primary', 0),
(290, 74, 1, 'primary', 0),
(291, 74, 1, 'primary', 0),
(292, 74, 1, 'primary', 0),
(293, 74, 1, 'primary', 0),
(294, 74, 1, 'primary', 0),
(295, 74, 1, 'primary', 0),
(296, 74, 1, 'primary', 0),
(297, 74, 2, 'primary', 0),
(298, 74, 2, 'primary', 0),
(299, 74, 3, 'primary', 0),
(300, 74, 3, 'primary', 0),
(301, 74, 3, 'primary', 0),
(302, 74, 3, 'primary', 0),
(303, 74, 3, 'secondary', 0),
(304, 74, 3, 'secondary', 0),
(312, 75, 1, 'primary', 0),
(313, 75, 1, 'primary', 0),
(314, 75, 1, 'primary', 0),
(315, 75, 1, 'primary', 0),
(316, 75, 1, 'secondary', 0),
(317, 75, 1, 'secondary', 0),
(318, 75, 1, 'primary', 0),
(319, 75, 1, 'primary', 0),
(320, 75, 1, 'primary', 0),
(321, 75, 1, 'primary', 0),
(322, 75, 1, 'primary', 0),
(323, 75, 1, 'primary', 0),
(324, 75, 1, 'primary', 0),
(325, 75, 1, 'primary', 0),
(326, 75, 1, 'primary', 0),
(327, 75, 1, 'primary', 0),
(328, 75, 2, 'primary', 0),
(329, 75, 2, 'primary', 0),
(330, 75, 3, 'primary', 0),
(331, 75, 3, 'primary', 0),
(332, 75, 3, 'primary', 0),
(333, 75, 3, 'primary', 0),
(334, 75, 3, 'secondary', 0),
(335, 75, 3, 'secondary', 0),
(343, 76, 1, 'primary', 1),
(344, 76, 1, 'primary', 1),
(345, 76, 3, 'secondary', 1),
(346, 76, 2, 'primary', 1),
(347, 76, 1, 'secondary', 1),
(348, 76, 1, 'primary', 1),
(349, 76, 1, 'secondary', 1),
(350, 76, 3, 'primary', 1),
(351, 76, 3, 'secondary', 1),
(352, 76, 2, 'primary', 1),
(353, 76, 2, 'primary', 1),
(354, 76, 2, 'secondary', 1),
(355, 76, 2, 'secondary', 1),
(356, 76, 1, 'primary', 1),
(357, 76, 1, 'secondary', 1),
(358, 76, 3, 'primary', 1),
(359, 76, 3, 'primary', 1),
(360, 76, 3, 'secondary', 1),
(361, 76, 3, 'secondary', 1),
(362, 76, 2, 'primary', 1),
(363, 76, 2, 'primary', 1),
(364, 76, 2, 'primary', 1),
(365, 76, 2, 'secondary', 1),
(366, 76, 2, 'secondary', 1),
(367, 76, 2, 'secondary', 1),
(368, 76, 1, 'primary', 0),
(369, 76, 1, 'secondary', 1),
(370, 76, 2, 'primary', 0),
(371, 76, 2, 'primary', 0),
(372, 76, 2, 'secondary', 1),
(373, 76, 2, 'secondary', 1),
(374, 76, 3, 'primary', 0),
(375, 76, 3, 'primary', 1),
(376, 76, 3, 'primary', 1),
(377, 76, 3, 'secondary', 0),
(378, 76, 3, 'secondary', 0),
(379, 76, 3, 'secondary', 0),
(380, 77, 1, 'primary', 0),
(381, 77, 3, 'primary', 0),
(382, 77, 2, 'primary', 0),
(383, 79, 3, 'primary', 1),
(384, 79, 3, 'primary', 1),
(385, 79, 3, 'primary', 1),
(386, 79, 3, 'primary', 1),
(387, 79, 1, 'primary', 1),
(388, 79, 3, 'primary', 1),
(389, 79, 1, 'primary', 0),
(390, 79, 1, 'primary', 0),
(391, 79, 3, 'primary', 0),
(392, 79, 2, 'primary', 0),
(393, 79, 2, 'secondary', 0),
(394, 80, 3, 'primary', 0),
(395, 80, 3, 'secondary', 0),
(396, 80, 2, 'primary', 0),
(397, 80, 3, 'primary', 0),
(398, 80, 3, 'primary', 0),
(399, 80, 3, 'primary', 0),
(400, 80, 3, 'primary', 0),
(401, 81, 2, 'primary', 0),
(402, 81, 3, 'primary', 0),
(403, 81, 3, 'secondary', 0),
(404, 81, 3, 'primary', 0),
(405, 81, 3, 'primary', 0),
(406, 81, 3, 'primary', 0),
(407, 81, 3, 'primary', 0),
(408, 0, 2, 'primary', 0),
(409, 0, 3, 'primary', 0),
(410, 0, 3, 'secondary', 0),
(411, 0, 3, 'primary', 0),
(412, 0, 3, 'primary', 0),
(413, 0, 3, 'primary', 0),
(414, 0, 3, 'primary', 0),
(415, 0, 2, 'primary', 0),
(416, 0, 3, 'primary', 0),
(417, 0, 3, 'secondary', 0),
(418, 0, 3, 'primary', 0),
(419, 0, 3, 'primary', 0),
(420, 0, 3, 'primary', 0),
(421, 0, 3, 'primary', 0),
(422, 0, 2, 'primary', 0),
(423, 0, 3, 'primary', 0),
(424, 0, 3, 'secondary', 0),
(425, 0, 3, 'primary', 0),
(426, 0, 3, 'primary', 0),
(427, 0, 3, 'primary', 0),
(428, 0, 3, 'primary', 0),
(429, 82, 2, 'primary', 1),
(430, 82, 3, 'primary', 1),
(431, 82, 3, 'secondary', 1),
(432, 82, 3, 'primary', 1),
(433, 82, 3, 'primary', 1),
(434, 82, 3, 'primary', 1),
(435, 82, 3, 'primary', 1),
(436, 82, 2, 'primary', 1),
(437, 82, 2, 'primary', 1),
(438, 82, 2, 'primary', 1),
(439, 82, 2, 'primary', 1),
(440, 82, 2, 'primary', 1),
(441, 82, 2, 'primary', 1),
(442, 82, 3, 'primary', 0),
(443, 83, 3, 'primary', 0),
(444, 83, 3, 'primary', 1),
(445, 83, 3, 'secondary', 0),
(446, 83, 1, 'primary', 0),
(447, 83, 1, 'primary', 0),
(448, 84, 1, 'primary', 0),
(449, 84, 1, 'primary', 0),
(450, 84, 3, 'primary', 0),
(451, 84, 3, 'secondary', 0),
(455, 85, 1, 'primary', 0),
(456, 85, 1, 'primary', 0),
(457, 85, 3, 'primary', 0),
(458, 85, 3, 'secondary', 0),
(462, 86, 1, 'primary', 0),
(463, 86, 1, 'primary', 0),
(464, 86, 3, 'primary', 0),
(465, 86, 3, 'secondary', 0),
(469, 87, 3, 'primary', 1),
(470, 87, 3, 'primary', 1),
(471, 87, 3, 'secondary', 1),
(472, 87, 3, 'primary', 0),
(473, 87, 3, 'primary', 0),
(474, 87, 1, 'primary', 1),
(475, 87, 1, 'secondary', 0),
(476, 87, 1, 'secondary', 0),
(477, 87, 1, 'secondary', 0),
(478, 87, 1, 'secondary', 0),
(479, 87, 1, 'secondary', 0),
(480, 87, 1, 'secondary', 0),
(481, 87, 1, 'secondary', 0),
(482, 87, 1, 'secondary', 0),
(483, 88, 1, 'secondary', 0),
(484, 88, 1, 'secondary', 0),
(485, 88, 1, 'secondary', 0),
(486, 88, 1, 'secondary', 0),
(487, 88, 1, 'secondary', 0),
(488, 88, 1, 'secondary', 0),
(489, 88, 1, 'secondary', 0),
(490, 88, 1, 'secondary', 0),
(491, 88, 3, 'primary', 0),
(492, 88, 3, 'primary', 0);

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
  `price_primary` float NOT NULL,
  `price_secondary` float NOT NULL,
  PRIMARY KEY (`part_no`),
  KEY `part_key` (`part_no`,`part_num`,`appliance`,`brand`,`part_type`),
  KEY `part_type` (`part_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `parts`
--

INSERT INTO `parts` (`part_no`, `part_num`, `appliance`, `brand`, `part_type`, `part_description`, `price_primary`, `price_secondary`) VALUES
(1, '00001', 'Washer', 'GE', 'Ignition', 'Bulb', 1.22, 0.5),
(2, '00002', 'Dryer', 'Whirlpool', 'Ignition', 'Fuse', 3.44, 1.2),
(3, '00003', 'Dryer', 'GE', 'Ignition', 'Element', 4.59, 1.56);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=103 ;

--
-- Dumping data for table `part_uses`
--

INSERT INTO `part_uses` (`part_use_no`, `use_count`, `user_no`, `part_no`) VALUES
(1, 25, 2, 2),
(2, 36, 2, 3),
(10, 10, 2, 0),
(26, 23, 2, 1),
(27, 3, 1, 1),
(28, 25, 1, 3),
(53, 2, 1, 2),
(54, 42, 3, 1),
(56, 27, 3, 2),
(58, 41, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_no` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) NOT NULL,
  PRIMARY KEY (`user_no`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_no`, `user_name`) VALUES
(2, 'AimeeShulman'),
(1, 'DanSmith'),
(4, 'EdCopp'),
(3, 'JimSmith');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
