-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 30, 2019 at 11:08 PM
-- Server version: 5.7.21
-- PHP Version: 7.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `abj_apartments`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `displayname` varchar(255) NOT NULL,
  `accesslevel` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `password_recovery_code` varchar(255) DEFAULT NULL,
  `blocked` tinyint(1) NOT NULL DEFAULT '0',
  `blocked_reason` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `displayname`, `accesslevel`, `created_at`, `updated_at`, `password_recovery_code`, `blocked`, `blocked_reason`) VALUES
(5, 'akalo', '$2y$10$566AwmEgSHOegfT21Y11SO6PmqOxzR9AiU4UFwuT1lFSbtg4EL6jm', 'Prince AK', 1, '2017-05-05 02:16:38', '2018-05-17 13:31:06', NULL, 0, ''),
(6, 'peter', '$2y$10$oez/fmkMrLMfKko/utOzKOT8S7kCNpAP2gvjgw5Y.GQ26wcRLwvXW', 'Peter', 2, '2017-10-06 21:09:29', '2018-05-17 13:31:06', NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blacklisted_ips`
--

DROP TABLE IF EXISTS `blacklisted_ips`;
CREATE TABLE IF NOT EXISTS `blacklisted_ips` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `blacklisted_ip` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `circles`
--

DROP TABLE IF EXISTS `circles`;
CREATE TABLE IF NOT EXISTS `circles` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `user_one` bigint(255) NOT NULL,
  `user_two` bigint(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `action_user` bigint(255) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `circles`
--

INSERT INTO `circles` (`id`, `user_one`, `user_two`, `status`, `action_user`, `created_at`, `updated_at`) VALUES
(8, 5, 29, 1, 29, '2018-12-25 05:04:39', '2019-01-03 07:03:22');

-- --------------------------------------------------------

--
-- Table structure for table `circle_records`
--

DROP TABLE IF EXISTS `circle_records`;
CREATE TABLE IF NOT EXISTS `circle_records` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `user_one` bigint(255) NOT NULL,
  `user_two` bigint(255) NOT NULL,
  `action` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `circle_records`
--

INSERT INTO `circle_records` (`id`, `user_one`, `user_two`, `action`, `created_at`, `updated_at`) VALUES
(9, 29, 5, 1, '2019-01-03 07:05:38', '2019-01-03 07:05:38'),
(8, 5, 29, 0, '2018-12-25 05:04:39', '2018-12-25 05:04:39');

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

DROP TABLE IF EXISTS `days`;
CREATE TABLE IF NOT EXISTS `days` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `day` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `errors`
--

DROP TABLE IF EXISTS `errors`;
CREATE TABLE IF NOT EXISTS `errors` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `page` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `estates`
--

DROP TABLE IF EXISTS `estates`;
CREATE TABLE IF NOT EXISTS `estates` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `realtor_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location_id` int(255) NOT NULL,
  `water_source` varchar(255) NOT NULL,
  `facilities` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `estates`
--

INSERT INTO `estates` (`id`, `realtor_id`, `name`, `location_id`, `water_source`, `facilities`, `description`, `created_at`, `updated_at`) VALUES
(1, 42, 'Nelson Mandela Garden, Galadimawa District', 24, 'N/A', 'first class shopping mall (Horiland Mall), hospital, International School, hotel, bank, fueling station, sport complex', '<p>This luxury estate is situated in a prime area of the city and is part of the 3rd Development Phase of Abuja master plan. The Development-Control-Approved-Building-Plan for the estate consists of 42 units of 4bedrooms Detached Duplex with BQ- Types A 33units of 5bedroom detached duplex with BQ- Type B, 12units of 4Bedrooms Terrace duplex, 2units of 3Bedroom Bungalows Fully Detached with BQ 4units of 3Bedroom Bungalows Semi Detached with BQ.</p>', '2017-06-15 06:38:37', '2018-05-17 13:36:10'),
(2, 53, 'Ipent 6 Estate', 24, 'Bore Hole', '', '<p>A plot of land in a well developed estate Through Gudu or Apo Shopright, at Gaduwa.<br />It is a build-able plot for 5-bedroom fully detached duplex, 2 bedroom BQ and a paint House at Legislative Villa (Ipent VI Estate) The owner of this plot bought the plot for 25million naira from Ipent Estate Developers and i have the documents with me. all he wants is a serious buyer to will pay 20million Naire only (due to some financial issues). contact me for original copy.<br />People are already living in the estate. <br /><br />Plot: B8<br />5-bedroom Duplex<br />2bedroon BQ<br /><br />The facilities of the estate includes;<br />* Tarred Road<br />* Quality Landscape<br />* Adequate Car parking<br />* Estate Management<br />* PHCN Supply<br />* Street Light Supply<br />* Paved Walk-ways<br />* Neighbourhood Centre<br />* Police Post<br />* Security Personnel<br />* Children Playground<br /><br />Marketed by PROMETHEUS SOLUTIONS<br /><br />FOR MORE INFORMATION PLEASE CONTACT US<br />Phone 09098756825 or 07033385434<br />Email: <br />Website: replaced_link<br />Corporate Head Office: Suite D86/90, Efab Shopping Mall Extension, opp. FCDA, Area11, Garki-Abuja. <br /><br />RC: 2434487<br />PROMETHEUS LIMITED<br />Your Real Estate Solutions&hellip;</p>', '2017-08-21 06:26:59', '2018-05-17 13:36:10'),
(3, 53, 'Ipent 5 Estate', 4, 'N/A', 'The Facilities of the Estate includes: * Tarred Road * Quality Landscape * Adequate Car parking * Estate Management * PHCN Supply * Street Light Supply * Paved Walk-ways * Neighborhood Centre * Police Post * Security Personnel * Children Playground', '<p>A plot of land in a well developed estate after charley Boys Gwarinpa</p>\r\n<p>A well located build-able plot for 4-bedroom fully detached duplex with 2-bedrooms BQ and enough car packing space at Ipent 7 Estate.</p>\r\n<p>People are already living in the estate.</p>\r\n<p>&nbsp;</p>\r\n<p>Plot: 323, 324, 325, and 326</p>\r\n<p>4-bedroom Duplex</p>\r\n<p>600sqm</p>\r\n<p>2bedroon BQ</p>\r\n<p>&nbsp;</p>\r\n<p><strong>The Facilities of the Estate includes:</strong></p>\r\n<p>* Tarred Road</p>\r\n<p>* Quality Landscape</p>\r\n<p>* Adequate Car parking</p>\r\n<p>* Estate Management</p>\r\n<p>* PHCN Supply</p>\r\n<p>* Street Light Supply</p>\r\n<p>* Paved Walk-ways</p>\r\n<p>* Neighborhood Centre</p>\r\n<p>* Police Post</p>\r\n<p>* Security Personnel</p>\r\n<p>* Children Playground</p>\r\n<p>&nbsp;</p>\r\n<p>Marketed By PROMETHEUS SOLUTIONS&hellip;</p>\r\n<p><strong>FOR MORE INFORMATION PLEASE CONTACT US</strong></p>\r\n<p><strong>Phone:</strong> +234-9098756825 or +234-7033385434</p>\r\n<p><strong>Office: </strong>Suite D86/90, Efab Shopping Mall, Area11, Garki-Abuja.</p>\r\n<p><strong>Email:</strong><a href=\"mailto:prometheussolutions1@gmail.com\">prometheussolutions1@gmail.com</a></p>\r\n<p><strong>Website:</strong> www.prometheusrealty.com</p>\r\n<p><strong>Corporate Head Office:</strong> Suite D86/90, Efab Shopping Mall Extension, opp. FCDA, Area11, Garki-Abuja.&nbsp;</p>\r\n<p><strong>&nbsp;</strong></p>\r\n<p><strong>RC: 2434487</strong></p>\r\n<p><strong>PROMETHEUS LIMITED</strong></p>\r\n<p><em>Your Real Estate Solutions&hellip;</em></p>', '2017-10-01 15:25:42', '2018-05-17 13:36:10'),
(4, 53, 'Ipent 7 Estate', 4, 'Bore Hole', 'The Facilities of the Estate includes: * Tarred Road * Quality Landscape * Adequate Car parking * Estate Management * PHCN Supply * Street Light Supply * Paved Walk-ways * Neighborhood Centre * Police Post * Security Personnel * Children Playground', '<p>Appealing 4-Bedroom Carcass Duplex &amp; 2-Bedrooms BQ at Ipent 7 Estate, Gwarinpa-FCT Abuja</p>\r\n<p>Description: This delightful duplex derives attraction from its scintillating finishes that gives an occupant a sensation of semi-heaven living. This is because the property is in between luxurious houses in an alluring and secured environment.</p>\r\n<p>This duplex is made up of 3 bedrooms (all rooms are en-suite) upstairs while down stairs has 1 bedroom (en-suite), spacious parlor, kitchen, store, dinning area, and a guest toilet. Its compound has a 2 bedrooms en-suite BQ with a kitchen and then a security house which is beside the entrance of the house. The compound is large enough to accommodate from 6 to 8 cars.</p>\r\n<p>LOCATIONS: This property is situated at No. 44, Alikum Street, Ipent 7 Estate, Gwarinpa-FCT Abuja.</p>\r\n<p>&nbsp;</p>\r\n<p>Marketed By PROMETHEUS SOLUTIONS&hellip;</p>\r\n<p><strong>FOR MORE INFORMATION PLEASE CONTACT US</strong></p>\r\n<p><strong>Phone:</strong> +234-9098756825 or +234-7033385434</p>\r\n<p><strong>Office: </strong>Suite D86/90, Efab Shopping Mall, Area11, Garki-Abuja.</p>\r\n<p><strong>Email:</strong><a href=\"mailto:prometheussolutions1@gmail.com\">prometheussolutions1@gmail.com</a></p>\r\n<p><strong>Website:</strong> www.prometheusrealty.com</p>\r\n<p><strong>Corporate Head Office:</strong> Suite D86/90, Efab Shopping Mall Extension, opp. FCDA, Area11, Garki-Abuja.</p>\r\n<p><strong>&nbsp;</strong></p>\r\n<p><strong>RC: 2434487</strong></p>\r\n<p><strong>PROMETHEUS LIMITED</strong></p>\r\n<p><em>Your Real Estate Solutions&hellip;</em></p>\r\n<p>&nbsp;</p>', '2017-10-01 15:56:21', '2018-05-17 13:36:10'),
(8, 42, 'New Birth Estate', 7, 'Water Board', 'Security, Estate transformer, concrete road, recreational centers, hospital', 'This is a very comfortable estate, with neighbor friendly surroundings', '2019-01-20 13:54:46', '2019-01-20 13:54:46');

-- --------------------------------------------------------

--
-- Table structure for table `estate_comments`
--

DROP TABLE IF EXISTS `estate_comments`;
CREATE TABLE IF NOT EXISTS `estate_comments` (
  `id` bigint(255) NOT NULL,
  `estate_id` bigint(255) NOT NULL,
  `realtor_id` bigint(255) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `estate_likes`
--

DROP TABLE IF EXISTS `estate_likes`;
CREATE TABLE IF NOT EXISTS `estate_likes` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `estate_id` bigint(255) NOT NULL,
  `realtor_id` bigint(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `estate_photos`
--

DROP TABLE IF EXISTS `estate_photos`;
CREATE TABLE IF NOT EXISTS `estate_photos` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `estate_id` int(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `main` tinyint(2) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=224 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `estate_photos`
--

INSERT INTO `estate_photos` (`id`, `estate_id`, `photo`, `title`, `main`, `created_at`, `updated_at`) VALUES
(122, 1, '4bedroomterraceduplexwithbq.jpg', '4bedroom terrace', 1, '2018-05-17 13:14:14', '2018-05-17 13:14:14'),
(123, 1, '3BedroomSemi-detachedBungalowwithBQ.jpg', '3 bedroom semidetached', 0, '2018-05-17 13:14:14', '2018-05-17 13:14:14'),
(124, 1, '5bedroomfullydetachedduplexwithBQ-TypeB.jpg', '5 bedroom fully detached', 0, '2018-05-17 13:14:14', '2018-05-17 13:14:14'),
(125, 1, '4bedroomfullydetachedduplexwithBQ-TypeA.jpg', '4 bedroom duplex fully detached', 0, '2018-05-17 13:14:14', '2018-05-17 13:14:14'),
(127, 2, '3_bedroom_semi-detached.jpg', '3_bedroom_semi-detached', 0, '2018-05-17 13:14:14', '2018-05-17 13:14:14'),
(142, 2, 'Slide1.JPG', 'Distress!! 5 bedrooms Duplex with 2 bedrroms BQ and a Pent house, at legislative VIlla, Gaduwa -Abuja', 0, '2018-05-17 13:14:14', '2018-05-17 13:14:14'),
(202, 3, 'Slide1.JPG', 'Plot', 0, '2018-05-17 13:14:14', '2018-05-17 13:14:14'),
(203, 3, 'Slide2.JPG', 'Second Plot', 0, '2018-05-17 13:14:14', '2018-05-17 13:14:14'),
(204, 3, 'Slide3.JPG', 'Road by left', 0, '2018-05-17 13:14:14', '2018-05-17 13:14:14'),
(205, 3, 'Slide4.JPG', 'Road by right', 0, '2018-05-17 13:14:14', '2018-05-17 13:14:14'),
(206, 3, 'Slide5.JPG', 'Nieghboorhood', 0, '2018-05-17 13:14:14', '2018-05-17 13:14:14'),
(207, 3, 'GoogleMap.JPG', 'Road map', 0, '2018-05-17 13:14:14', '2018-05-17 13:14:14'),
(208, 3, 'realestatesolutions.jpg', 'Prometheus Solutions', 0, '2018-05-17 13:14:14', '2018-05-17 13:14:14'),
(214, 4, 'Slide1.JPG', 'Carcass', 0, '2018-05-17 13:14:14', '2018-05-17 13:14:14'),
(215, 4, 'Slide2.JPG', 'Compound', 0, '2018-05-17 13:14:14', '2018-05-17 13:14:14'),
(216, 4, 'Slide3.JPG', 'Side compound', 0, '2018-05-17 13:14:14', '2018-05-17 13:14:14'),
(217, 4, 'Slide4.JPG', 'BQ', 0, '2018-05-17 13:14:14', '2018-05-17 13:14:14'),
(218, 4, 'Slide5.JPG', 'Tarred Road by right', 0, '2018-05-17 13:14:14', '2018-05-17 13:14:14'),
(219, 4, 'Ipent7Estate.jpg', 'Road map', 0, '2018-05-17 13:14:14', '2018-05-17 13:14:14'),
(220, 4, 'WORK.jpg', 'Prometheus Solutions', 0, '2018-05-17 13:14:14', '2018-05-17 13:14:14'),
(221, 8, '1547996086-IMG_20170121_151842.jpg', NULL, 0, '2019-01-20 13:54:48', '2019-01-20 13:54:48'),
(222, 8, '1547996088-IMG_20170121_151345.jpg', NULL, 0, '2019-01-20 13:54:52', '2019-01-20 13:54:52'),
(223, 8, '1547996092-IMG_20170121_151459.jpg', NULL, 0, '2019-01-20 13:54:55', '2019-01-20 13:54:55');

-- --------------------------------------------------------

--
-- Table structure for table `estate_traffic`
--

DROP TABLE IF EXISTS `estate_traffic`;
CREATE TABLE IF NOT EXISTS `estate_traffic` (
  `id` int(255) NOT NULL,
  `viewer_id` int(255) DEFAULT NULL,
  `estate_id` int(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

DROP TABLE IF EXISTS `feedbacks`;
CREATE TABLE IF NOT EXISTS `feedbacks` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `feedback` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `visible` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

DROP TABLE IF EXISTS `followers`;
CREATE TABLE IF NOT EXISTS `followers` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `realtor_id` int(255) NOT NULL,
  `follower_id` int(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `houses`
--

DROP TABLE IF EXISTS `houses`;
CREATE TABLE IF NOT EXISTS `houses` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `estate_id` int(255) NOT NULL DEFAULT '0',
  `units` int(255) DEFAULT '0',
  `location_id` int(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `status` varchar(5) DEFAULT 'rent',
  `house_type_id` int(255) DEFAULT NULL,
  `price` int(20) DEFAULT NULL,
  `rooms` varchar(3) DEFAULT NULL,
  `bedrooms` tinyint(2) NOT NULL DEFAULT '1',
  `bathrooms` varchar(2) DEFAULT NULL,
  `toilets` varchar(2) DEFAULT NULL,
  `price_range_id` int(255) DEFAULT NULL,
  `purpose` varchar(255) DEFAULT NULL,
  `facilities` varchar(255) DEFAULT NULL,
  `water_source` varchar(255) DEFAULT NULL,
  `sale_plan` text,
  `description` text,
  `available` tinyint(1) NOT NULL DEFAULT '1',
  `agent_fee` varchar(50) DEFAULT NULL,
  `service_charge` int(50) DEFAULT NULL,
  `site_id` int(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=145 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `houses`
--

INSERT INTO `houses` (`id`, `estate_id`, `units`, `location_id`, `title`, `status`, `house_type_id`, `price`, `rooms`, `bedrooms`, `bathrooms`, `toilets`, `price_range_id`, `purpose`, `facilities`, `water_source`, `sale_plan`, `description`, `available`, `agent_fee`, `service_charge`, `site_id`, `created_at`, `updated_at`) VALUES
(99, 0, 0, 19, '3 Bedroom Duplex', 'rent', 4, 1000000, '8', 3, '3', '3', 6, 'residential', 'sitout', 'Bore Hole', '  	  ', 'Moderate house in industrial area', 1, '100000', 0, NULL, '2017-04-15 16:29:55', '2018-05-17 12:41:12'),
(100, 0, 0, 2, '10 Nwangene close', 'rent', 6, 5000000, '5', 4, '3', '2', 6, 'residential', NULL, 'N/A', '  	  ', 'This is a very nice house', 1, '100000', 1000, NULL, '2017-05-04 17:57:21', '2018-05-17 12:41:12'),
(101, 0, 0, NULL, NULL, 'rent', NULL, NULL, '1', 1, '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, 0, '0', 0, NULL, '2017-05-04 18:17:47', '2018-05-17 12:41:12'),
(106, 0, 0, 7, '4 Units of 2 Bedroom ', 'sale', 4, 48000000, '6', 2, '2', '2', 6, 'residential', 'water', 'Water Board', 'Negotiable, to be negotiated with the seller     ', 'A nice collection of houses in a lively settlement in the FCT      ', 1, '4800000', 0, NULL, '2017-06-11 15:02:36', '2018-11-09 09:25:49'),
(107, 1, 42, 24, '4 Bedroom Fully Detached Duplex', 'sale', 10, 65000000, '6', 4, '4', '5', 6, 'residential', NULL, 'N/A', '<p>Fully completed units goes for 65,000,000 naira while Carcass (roof level) goes for 45,000,000 naira per a unit.</p>\r\n<p>&nbsp;</p>', '<p>Full description of the house:</p>\r\n<ul>\r\n<li>1 Room Boys Quarter Attached behind the Main Building.</li>\r\n<li>3 Rooms and a Living Room upstairs.</li>\r\n<li>1 Room and a Living Room Downstairs.</li>\r\n<li>All Rooms are En Suite.</li>\r\n<li>Guest Toilet.</li>\r\n</ul>', 0, '0', 0, NULL, '2017-06-18 12:06:48', '2018-12-08 05:16:12'),
(108, 1, 4, 24, '3Bedroom Semi-detached Bungalow with BQ', 'sale', 5, 35000000, '9', 3, '3', '4', 6, 'residential', 'Boys Quarters, All rooms en suite', 'N/A', '<p>Fully completed unit at N35</p>\r\n<p>Carcass (roof level) at N25m</p>', '<p>3 Room and Living Room Apartment, All Rooms En Suite with a Guest Toilet</p>\r\n<p>A luxery home with lots of active and secure environment</p>', 1, '0', 0, NULL, '2017-06-19 12:18:43', '2018-05-17 12:41:12'),
(109, 1, 12, 24, '4bedroom terrace duplex with bq', 'sale', 11, 55000000, '12', 4, '4', '5', 6, 'residential', '2 Sitting rooms, all rooms en suite', 'N/A', '<p>Fully completed unit at N55m</p>\r\n<p>Carcass (roof level) at N40m</p>', '<p>3 Room and Living Room at the Top Apartment and 1 Room and Living Room at the Bottom Apartment. All Rooms En Suite with a Guest Toilet</p>\r\n<p>This is a very luxurous apartment that it built to taste</p>', 1, '0', 0, NULL, '2017-06-19 12:30:27', '2018-05-17 12:41:12'),
(110, 1, 33, 24, '5bedroom fully detached duplex with BQ- Type B', 'sale', 10, 110000000, '14', 5, '5', '6', 7, 'residential', 'All Rooms en suite, 2 sitting rooms, attached 1 room boys quarters', 'N/A', '<p>Fully completed unit at N110m</p>\r\n<p>Carcass (roof level) at N65m</p>', '<p>4 Rooms and A Living Room Upstairs with 1 Room and A Living Room Downstairs. All Rooms En-Suite with a Guest Toilet</p>\r\n<p>1 Room Boys Quarter Attached Behind the Main Building</p>\r\n<p>A very luxurous apartments for a large family, in a vibrant estate and environment</p>', 1, '0', 0, NULL, '2017-06-19 12:42:56', '2018-05-17 12:41:12'),
(111, 0, 0, 13, '9 Jere Street', 'rent', 7, 500000, '1', 1, '1', '1', 3, 'commercial', NULL, 'N/A', NULL, '<p>office room</p>', 1, '50000', 0, NULL, '2017-06-22 13:57:10', '2018-05-17 12:41:12'),
(112, 0, 0, 24, '4bedroom fully detached duplex', 'sale', 10, 66000000, '5', 4, '5', '5', 6, 'residential', 'Swimming pool, long tennis court', 'N/A', '<p>Outright sale or come up with your own payment plan or through mortgage banks.</p>', '<p>Located along airport road, with a good access road.</p>', 1, '1750000', 10000, NULL, '2017-06-22 21:33:21', '2018-05-17 12:41:12'),
(113, 0, 0, 7, '4bedroom Duplex', 'sale', 4, 45000000, '', 4, '', '', 6, 'residential', '', NULL, '45 Million Asking Price	     ', '', 1, '', 0, NULL, '2017-07-09 12:08:16', '2018-05-17 12:41:12'),
(114, 0, 0, 18, '2bedroom stand alone bungalow at Guzape Asokoro', 'rent', 8, 1600000, NULL, 2, NULL, NULL, NULL, 'residential', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2017-07-26 19:22:07', '2018-05-17 12:41:12'),
(115, 0, 0, 4, '3 Bedroom Bungalow ', 'sale', 3, 37000000, '', 3, '', '', 6, 'residential', '', NULL, '   	         ', '<p>A very classy house in the biggest estate in west Africa</p>\r\n<p>Has a pent house with impeccable view</p>', 1, '', 0, NULL, '2017-08-25 03:16:23', '2018-05-17 12:41:12'),
(116, 0, 0, 17, '3bedroom fully detached bungalow @ Nicon junction, katampe district Abuja.', 'rent', 9, 1200000, NULL, 3, NULL, NULL, NULL, 'residential', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, '2017-08-30 20:04:45', '2018-05-17 12:41:12'),
(117, 0, 0, 17, '3bedroom fully detached bungalow @ Nicon junction, katampe district Abuja.', 'rent', 9, 1200000, '', 3, '', '3', 6, 'residential', '', NULL, '  	     ', '<p>This is a renovated 3 Bedroom Bungalow with 3toilets and bathroom</p>\r\n<p>located at katampe district opposite Nicain Junction Maitama</p>', 1, '', 0, NULL, '2017-08-30 20:04:59', '2018-05-17 12:41:12'),
(118, 0, 0, 7, '2 Bedroom Bungalow Duplex ', 'sale', 3, 15000000, NULL, 2, NULL, NULL, NULL, 'residential', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2017-08-31 07:42:41', '2018-05-17 12:41:12'),
(119, 0, 0, 4, 'Newly Built 4-Bedroom Duplex & 2-Bedrooms BQ at Ipent 7 Estate, Gwarinpa-FCT Abuja', 'sale', 4, 60000, '', 4, '', '', 1, 'residential', '', NULL, '  	     ', '<p>Appealing 4-Bedroom Duplex &amp; 2-Bedrooms BQ at Ipent 7 Estate, Gwarinpa-FCT Abuja</p>\r\n<p>Description: This delightful duplex derives attraction from its scintillating finishes that gives an occupant a sensation of semi-heaven living.&nbsp; This is because the property is in between luxurious houses in an alluring and secured environment.</p>\r\n<p>This duplex is made up of 3 bedrooms (all rooms are en-suite) upstairs while down stairs has 1 bedroom (en-suite), spacious parlor, kitchen, store, dinning area, and a guest toilet. Its compound has a 2 bedrooms en-suite BQ with a kitchen and then a security house which is beside the entrance of the house. The compound is large enough to accommodate from 6 to 8 cars.</p>\r\n<p>LOCATIONS: This property is situated at No. 44, Alikum Street, Ipent 7 Estate, Gwarinpa-FCT Abuja.</p>\r\n<p>&nbsp;</p>\r\n<p>Marketed By PROMETHEUS SOLUTIONS&hellip;</p>\r\n<p><strong>FOR MORE INFORMATION PLEASE CONTACT US</strong></p>\r\n<p><strong>Phone:</strong> +234-9098756825 or +234-7033385434</p>\r\n<p><strong>Office: </strong>Suite D86/90, Efab Shopping Mall, Area11, Garki-Abuja.</p>\r\n<p><strong>Email:</strong><a href=\"mailto:prometheussolutions1@gmail.com\">prometheussolutions1@gmail.com</a></p>\r\n<p><strong>Website:</strong> www.prometheusrealty.com</p>\r\n<p><strong>Corporate Head Office:</strong> Suite D86/90, Efab Shopping Mall Extension, opp. FCDA, Area11, Garki-Abuja.&nbsp;</p>\r\n<p><strong>&nbsp;</strong></p>\r\n<p><strong>RC: 2434487</strong></p>\r\n<p><strong>PROMETHEUS LIMITED</strong></p>\r\n<p><em>Your Real Estate Solutions&hellip;</em></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', 1, '5', 0, NULL, '2017-09-10 08:45:02', '2018-05-17 12:41:12'),
(120, 0, 0, 1, 'Letter of allocation ', 'sale', 2, 20000000, NULL, 3, NULL, NULL, NULL, 'residential', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2017-09-14 10:46:37', '2018-05-17 12:41:12'),
(121, 0, 0, 23, 'Newly Built Fully Serviced 3Bedroom Flat', 'rent', 2, 2200000, NULL, 3, NULL, NULL, NULL, 'residential', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2017-09-18 11:36:56', '2018-05-17 12:41:12'),
(122, 0, 0, 23, 'Newly Built', 'rent', 2, 2200000, '5', 3, '3', '3', 6, 'residential', 'Fully Serviced, 250KVA Central Generator', NULL, '  	     ', '<p>This is a Newly Bult Fully Serviced 3Bedroom Flat with BQ</p>\r\n<p>All Rooms en suite with bathtubs.</p>\r\n<p>It is serviced with AC, 250KVA Central Generator</p>\r\n<p>For maximum Comfort, just pay and move in</p>', 1, '220000', 300000, NULL, '2017-09-18 11:51:49', '2018-05-17 12:41:12'),
(123, 0, 0, 25, 'Newly Built 3Bedroom Flat For Sale', 'sale', 2, 60000000, '7', 3, '4', '4', 6, 'residential', 'Tarred Road, Pave areas, green areas, borehole, Dedicated ransformer, Fitted Wadropes, heaters, bathtub', NULL, '60Million Per Unit\r\nDetails to be discussed with Agent/Owner	     ', '<p>This is a newly Built 3Bedroom Flat with 1Bedroom Guest Chalet all en suite</p>\r\n<p>Located at Jahi District of the Federl Capital Territory</p>\r\n<p>Facilities include Tarred Road, Pave Areas, Green Areas, Borehole, Dedicated Transformer, etc</p>\r\n<p>All Rooms come fitted with wadrobes, heaters and bathtubs.</p>', 1, '', 0, NULL, '2017-09-18 12:07:16', '2018-05-17 12:41:12'),
(124, 0, 0, 26, '2 Bedroom Flat at katampe', 'rent', 2, 1000000, '7', 2, '2', '3', 6, 'residential', 'Dedicated Transformer, Central Generator, Cabinet, Store', NULL, '  	     ', '<p>A neat 2 Bedroom Flat at Katampe District of the Federal Capital Territory, Tipper garage after Minister hill</p>\r\n<p>It has 3 Toilets, has kitchen cabinet, store and sitting room.</p>\r\n<p>Serviced with Central Generator and Dedicated transformer.</p>\r\n<p>Price: 1Million(Negotiable)</p>\r\n<p>Agency and Legal Fees applies</p>', 1, '', 300000, NULL, '2017-09-18 12:25:44', '2018-05-17 12:41:12'),
(125, 0, 0, 25, '3 bedroom Flat at Jahi', 'rent', 2, 1600000, '7', 3, '', '4', 6, 'residential', 'Massive Kitchen, Cabinet and store', NULL, '  	     ', '<p>A New and Preciously built 3 Bedroom Flat at Jahi with all room en suite&nbsp;</p>\r\n<p>It has spacious sitting room with dinning, visitors toilet, massive kitchen with cabinet and store</p>\r\n<p>Legal Fees applies</p>', 1, '160000', 300000, NULL, '2017-09-18 12:55:19', '2018-05-17 12:41:12'),
(126, 0, 0, 25, '3 Bedroom Serviced Flat at Jahi', 'rent', 2, 3000000, '8', 3, '', '4', 6, 'residential', 'Central Generator, AC, Dedicated transformer, Electric Fence', NULL, '  	     ', '<p>This is a Newly Built and serviced 3Bedroom flat with 4toilets all en suite with bathtubs except children room.</p>\r\n<p>It is serviced with central generator and AC, Dedicated transformer, Electric Fence, etc</p>\r\n<p>3million Per Annum includes service charge</p>\r\n<p>Agency and Legal Fees apply</p>\r\n<p>Just Pay and Move In</p>', 1, '', 0, NULL, '2017-09-18 13:16:07', '2018-05-17 12:41:12'),
(127, 0, 0, 7, 'OFFER OF ONE BEDROOM FLAT FOR SALE', 'sale', 2, 10000000, NULL, 1, NULL, NULL, NULL, 'residential', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2017-09-21 12:48:22', '2018-05-17 12:41:12'),
(128, 0, 0, 10, '11Units of one bedroom flat and 5 Shops at Mararaba, Abuja', 'sale', 2, 30000000, '11', 11, '11', '11', 6, 'residential', '', 'Water Board', '  	     ', '<p>11 units of 1 bedroom flat in a spacious compound. Each unit is en-suite and has its own balcony, kitchen, parlor, and a spacious bedroom. This property has its own gate and also have 5 shops attached to it from the outside. The owner wants to sell this property in order to complete a project at his home town. The rooms are spacious and Each unit is being rented at N120,000.00 (One hundred - twenty thousand naira only).</p>\r\n<p>Therefore: N120,000.00 X 11 = N1,320.000.00 (One million - three hundred thousand - twenty thousand only) While each of the five (5) shops are rented out at N70,000.00 (Seventy thousand naira only).</p>\r\n<p>Therefore:</p>\r\n<p>N70,000.00 X 5 = N350,000.00 (Three hundred - fifty thousand naira only)</p>\r\n<p>&nbsp;</p>\r\n<p>Total = N1,320.000.00 + N350,000.00 = N1,670.000.00 Yearly rent</p>\r\n<p>(One million-six hundred thousand-seventy thousand naira only)</p>\r\n<p>&nbsp;</p>\r\n<p><strong>LOCATION</strong></p>\r\n<p>This property is located at: House No. 10, Tudun wada, behind Zamfara Mosque, Off Nyanya Keffi Express Road (through <strong>Royal Dream Hotel</strong>), Mararaba.</p>\r\n<p>Don&rsquo;t miss this lucrative investment opportunity!</p>\r\n<p>&nbsp;</p>\r\n<p><strong>FOR MORE INFORMATION &amp; INSPECTION PLEASE CONTACT US</strong></p>\r\n<p><strong>Phone:</strong> +234-9098756825 or +234-7033385434</p>\r\n<p>Office: Suite D86/90, Efab Shopping Mall, Area11, Garki-Abuja</p>\r\n<p><strong>Email:</strong><a href=\"mailto:prometheussolutions1@gmail.com\">prometheussolutions1@gmail.com</a></p>\r\n<p><strong>Website:</strong> www.prometheusrealty.com</p>\r\n<p><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong></p>\r\n<p><strong>RC: 2434487</strong></p>\r\n<p><strong>PROMETHEUS LIMITED</strong></p>\r\n<p><em>Your Real Estate Solutions&hellip;</em></p>', 1, '5', 0, NULL, '2017-10-01 15:36:32', '2018-05-17 12:41:12'),
(129, 0, 0, 4, ': Appealing 4-Bedroom Carcass Duplex & 2-Bedrooms BQ at Ipent 7 Estate, Gwarinpa-FCT Abuja', 'sale', 10, 35000000, NULL, 4, NULL, NULL, NULL, 'residential', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2017-10-01 16:02:11', '2018-05-17 12:41:12'),
(130, 0, 0, 4, 'Executive 9 Bedroom Duplex at Citec Villa-Gwarinpa, FCT-Abuja', 'sale', 10, 250000000, '9', 9, '9', '9', 7, 'residential', '', 'Bore Hole', '  	     ', '<p>An appealing 9 bedroom duplex in an alluring environment of Citec Villa, Gwarinpa estate.</p>\r\n<p>The ground floor has three (3) parlours and a toilet for guest. The ground floor also has three (3) bedrooms (all rooms en-suite) and a Dinning area.</p>\r\n<p>Upstairs, has up to six (6) very spacious bedrooms (all rooms are en-suite with shower cubicle and Jacuzzi) each room has a dressing/clothing area and some has a balcony (including Mater&rsquo;s bedroom).</p>\r\n<p>The whole duplex is painted with dulux paints with POP and pillars and the owner of this property wants to sell this house with all the furniture if you are interested and if u are not, then you can buy it without the furniture at a lesser price. Below is the feature of the house:</p>\r\n<p>The duplex as a two (2) bedroom chalet, security house, an outside bar, laundry room, a skylight, spilt A.C, big generator, LCD screen, chairs, overhead tank &amp; borehole, central water heater, a car port, electric wire fence, a built-in sound system among others.</p>\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>\r\n<p><strong>LOCATIONS</strong></p>\r\n<p>The Duplex is situated at: House No. 805D, 444 Crescent, off 4<sup>th</sup> Avenue, Gwarinpa Estate, FCT Abuja-Nigeria.</p>\r\n<p>&nbsp;</p>\r\n<p>Marketed By PROMETHEUS SOLUTIONS&hellip;</p>\r\n<p><strong>FOR MORE INFORMATION PLEASE CONTACT US</strong></p>\r\n<p><strong>Phone:</strong> +234-9098756825 or +234-7033385434</p>\r\n<p><strong>Office: </strong>Suite D86/90, Efab Shopping Mall, Area11, Garki-Abuja.</p>\r\n<p><strong>Email:</strong><a href=\"mailto:prometheussolutions1@gmail.com\">prometheussolutions1@gmail.com</a></p>\r\n<p><strong>Website:</strong> www.prometheusrealty.com</p>\r\n<p><strong>Corporate Head Office:</strong> Suite D86/90, Efab Shopping Mall Extension, opp. FCDA, Area11, Garki-Abuja.&nbsp;</p>\r\n<p><strong>&nbsp;</strong></p>\r\n<p><strong>RC: 2434487</strong></p>\r\n<p><strong>PROMETHEUS LIMITED</strong></p>\r\n<p><em>Your Real Estate Solutions&hellip;</em></p>\r\n<p>&nbsp;</p>', 1, '5', 0, NULL, '2017-10-01 16:07:44', '2018-05-17 12:41:12'),
(131, 0, 0, 4, 'A 6-Bedroom Carcass Duplex & 2-Bedrooms BQ at Ipent 7 Estate, Gwarinpa-FCT Abuja', 'sale', 10, 75000000, NULL, 6, NULL, NULL, NULL, 'residential', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2017-10-01 16:46:57', '2018-05-17 12:41:12'),
(132, 0, 0, 26, 'Regent Service Apartments', 'sale', 6, 29000000, '9', 3, '3', '4', 6, 'residential', 'Private Parking and a General Car Parking; Laundry, Gym, Children’s Play Ground', NULL, 'N29,000,000 (Lumpsum)\r\n\r\n* Initial Installment\r\n30%: N8,700,000\r\n* Second Installment\r\n30%: N8,700,000\r\n* Third Installment\r\n20%: N5,800,000\r\n* Forth Installment\r\n20%: N5,800,000', '<p>Beautifully and Functionally designed 3 Bedroom Block of Flats</p>\r\n<p>All rooms ensuite with high quality bathroom Fittings</p>\r\n<ul>\r\n<li>An Exquisite Living<br />R o o m , K i t c h e n ,<br />Store and Guest<br />Toilet</li>\r\n<li>Private Parking</li>\r\n<li>General Parking</li>\r\n<li>Gym + Laundry</li>\r\n<li>Children&rsquo;s Play<br />Ground</li>\r\n<li>Services</li>\r\n<li>Security.</li>\r\n</ul>', 1, '', 0, NULL, '2017-10-01 19:35:59', '2018-05-17 12:41:12'),
(133, 0, 0, 9, 'Lounge for sale, Kuje-Abuja', 'sale', 9, 120000000, '10', 6, '6', '6', 7, 'commercial', 'Other features include:      Generator house     2 borehole     Store for drinks     An office with two rooms inside     A staff toilet     A customers toilet     3 very big store rooms which can be converted to 6 large rooms     Just to mention few', 'Bore Hole', '  	     ', '<p>A beautiful lounge for sale in a private environment of Kuje. The lounge has a very large compound that can take more than 12 cars; it has a fish pond &amp; Suya section and a security room by the entrance. This lounge also has a restaurant and kitchen. This lounge has a modern grill bar, a very large event hall with more than 500 seats with a flaming and decoration. Just by the side, there is a 3bedroom flat with 4 toilets with a Jacuzzi, kitchen, parlor and a dinning area.</p>\r\n<p>There is also a smoothie bar just by the left hand and another bar with 54 seats and 20 tables.</p>\r\n<p>Other features include:</p>\r\n<ul>\r\n<li>Generator house</li>\r\n<li>2 borehole</li>\r\n<li>Store for drinks</li>\r\n<li>An office with two rooms inside</li>\r\n<li>A staff toilet</li>\r\n<li>A customers toilet</li>\r\n<li>3 very big store rooms which can be converted to 6 large rooms</li>\r\n<li>Just to mention few</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p>Location: No, 6, Pashion street, opp. Union Homes, Kuchiyako Layout, Kuje-FCT Abuja.</p>\r\n<p>This is a good deal as the lounge is presently functional. Please contact me as soon as possible&hellip; dnt miss this investment opportunity I&rsquo;m telling this as a real estate consultant with more than 10 years of experience.</p>\r\n<p>&nbsp;</p>\r\n<p>Marketed By PROMETHEUS SOLUTIONS&hellip;</p>\r\n<p><strong>FOR MORE INFORMATION PLEASE CONTACT US</strong></p>\r\n<p><strong>Phone:</strong> +234-9098756825 or +234-7033385434</p>\r\n<p><strong>Office: </strong>Suite D86/90, Efab Shopping Mall, Area11, Garki-Abuja.</p>\r\n<p><strong>Email:</strong><a href=\"mailto:prometheussolutions1@gmail.com\">prometheussolutions1@gmail.com</a></p>\r\n<p><strong>Website:</strong> www.prometheusrealty.com</p>\r\n<p><strong>Corporate Head Office:</strong> Suite D86/90, Efab Shopping Mall Extension, opp. FCDA, Area11, Garki-Abuja.</p>\r\n<p><strong>&nbsp;</strong></p>\r\n<p><strong>RC: 2434487</strong></p>\r\n<p><strong>PROMETHEUS SOLUTIONS LIMITED</strong></p>\r\n<p><em>Your Real Estate Solutions&hellip;</em></p>', 1, '5', 0, NULL, '2017-10-03 09:55:30', '2018-05-17 12:41:12'),
(134, 0, 0, 24, 'Distress sale!!! 6bedrooms fully Detached Carcass Duplex in Gaduwa', 'sale', 10, 25000000, '6', 6, '5', '5', 6, 'residential', '', 'Water Board', '  	     ', '<p>A delightful 6bedrroms fully detached carcass duplex with a big space for BQ in a mini estate at Gaduwa. According to the architectural design of this building, all rooms are en-suit and it has a large parlor, a dining area, kitchen and store.</p>\r\n<p>All infrastructural fees have been paid for and the documents are intact.</p>\r\n<p>The estate is known as DOLZ BROWN ESTATE, it&rsquo;s a mini and quite estate with not more than 34 houses and the estate is 90% occupied just behind Ipent 6 estate (Legislative Villa) at Gaduwa District, Abuja.</p>\r\n<p>LOCATIONS: This property is situated at No. 44, Alikum Street, DOLIZ BROWN ESTATE, Gaduwa,FCT-Abuja.</p>\r\n<p>&nbsp;</p>\r\n<p>Marketed By PROMETHEUS SOLUTIONS&hellip;</p>\r\n<p><strong>FOR MORE INFORMATION PLEASE CONTACT US</strong></p>\r\n<p><strong>Phone:</strong> +234-9098756825 or +234-7033385434</p>\r\n<p><strong>Office: </strong>Suite D86/90, Efab Shopping Mall, Area11, Garki-Abuja.</p>\r\n<p><strong>Email:</strong><a href=\"mailto:prometheussolutions1@gmail.com\">prometheussolutions1@gmail.com</a></p>\r\n<p><strong>Website:</strong> www.prometheusrealty.com</p>\r\n<p><strong>Corporate Head Office:</strong> Suite D86/90, Efab Shopping Mall Extension, opp. FCDA, Area11, Garki-Abuja.</p>\r\n<p><strong>&nbsp;</strong></p>\r\n<p><strong>RC: 2434487</strong></p>\r\n<p><strong>PROMETHEUS LIMITED</strong></p>\r\n<p><em>Your Real Estate Solutions&hellip;</em></p>', 1, '5', 0, NULL, '2017-10-03 10:26:17', '2018-05-17 12:41:12'),
(135, 0, 0, 22, 'A 4-bedrooms Semi-Detached Duplex with BQin a Mini Estate, Wuye', 'sale', 7, 45000000, NULL, 4, NULL, NULL, NULL, 'residential', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2017-10-03 10:49:29', '2018-05-17 12:41:12'),
(136, 0, 0, 20, 'A Two Wings Uncompleted Duplex, Kado, FCT Abuja', 'sale', 7, 60000000, '6', 6, '6', '6', 6, 'residential', '', 'Bore Hole', '  	     ', '<p>This duplex is divided into two. The first wing upstairs has a specious 3 bedrooms (all rooms are en-suite) and a parlor, while down stairs has a very big parlor, kitchen, store, dinning area, visitor&rsquo;s toilet, and a room (en-suite).</p>\r\n<p>The second wing upstairs has two bedrooms (all rooms are en-suite) while down stairs has parlor, visitors toilet, kitchen, and a store.</p>\r\n<p>This structure is on a land big enough to pack from 8-10 cars. There is a security house by the entrance.</p>\r\n<p>Therefore, the property has: 6 rooms and 7 toilets</p>\r\n<p>LOCATIONS: This property is situated at No. 9, Ajumgobia F.I.A Close, opposite Corn Oil, Kado Estate-FCT Abuja.</p>\r\n<p>&nbsp;</p>\r\n<p>Marketed by PROMETHEUS SOLUTIONS&hellip;</p>\r\n<p><strong>FOR MORE INFORMATION PLEASE CONTACT US</strong></p>\r\n<p><strong>Phone:</strong> +234-9098756825 or +234-7033385434</p>\r\n<p><strong>Office: </strong>Suite D86/90, Efab Shopping Mall, Area11, Garki-Abuja.</p>\r\n<p><strong>Email:</strong><a href=\"mailto:prometheussolutions1@gmail.com\">prometheussolutions1@gmail.com</a></p>\r\n<p><strong>Website:</strong> www.prometheusrealty.com</p>\r\n<p><strong>&nbsp;</strong></p>\r\n<p><strong>RC: 2434487</strong></p>\r\n<p><strong>PROMETHEUS LIMITED</strong></p>\r\n<p><em>Your Real Estate Solutions&hellip;</em></p>', 1, '5', 0, NULL, '2017-10-03 10:54:14', '2018-05-17 12:41:12'),
(137, 0, 0, 12, 'A newly renovated 3-bedrooms Terrace Duplex with 2-bedrooms BQ, Wuse II-Abuja', 'sale', 11, 80000000, '5', 3, '4', '3', 6, 'residential', '', 'Bore Hole', '  	     ', '<p>This is a corner piece terrace duplex that is located in the heart of town with just few meters away from Wuse market and central area. The terrace was just renovated, it has 3-bedrooms (all rooms are en-suite) and a detached 2-bedroom BQ and a space for garden behind it.</p>\r\n<p>Location: No. 15 A, ECDA Quarters, off Ibrahim Hashim Street, Wuse-FCT Abuja.</p>\r\n<p>Marketed by PROMETHEUS SOLUTIONS&hellip;</p>\r\n<p><strong>FOR MORE INFORMATION PLEASE CONTACT US</strong></p>\r\n<p><strong>Phone:</strong> +234-9098756825 or +234-7033385434</p>\r\n<p><strong>Office: </strong>Suite D86/90, Efab Shopping Mall, Area11, Garki-Abuja.</p>\r\n<p><strong>Email:</strong><a href=\"mailto:prometheussolutions1@gmail.com\">prometheussolutions1@gmail.com</a></p>\r\n<p><strong>Website:</strong> www.prometheusrealty.com</p>\r\n<p><strong>&nbsp;</strong></p>\r\n<p><strong>RC: 2434487</strong></p>\r\n<p><strong>PROMETHEUS SOLUTIONS</strong></p>\r\n<p><em>Your Real Estate Solutions&hellip;</em></p>', 1, '5', 0, NULL, '2017-10-05 08:58:18', '2018-05-17 12:41:12'),
(142, 4, 0, 4, '3 Bedroom Terrace Duplex', 'sale', 11, 120000, NULL, 3, NULL, NULL, NULL, 'residential', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2017-10-30 23:12:38', '2018-05-17 12:41:12'),
(143, 0, 0, 26, '4Bedroom Duplex', 'rent', 4, 1500000, NULL, 4, NULL, NULL, NULL, 'residential', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2017-11-01 09:07:10', '2018-05-17 12:41:12'),
(144, 8, 5, 7, '4 Bedroom bungalow', 'sale', 3, 20000000, NULL, 4, NULL, NULL, NULL, 'residential', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2019-01-20 14:37:38', '2019-01-20 14:37:38');

-- --------------------------------------------------------

--
-- Table structure for table `house_comments`
--

DROP TABLE IF EXISTS `house_comments`;
CREATE TABLE IF NOT EXISTS `house_comments` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `house_id` int(2) NOT NULL,
  `realtor_id` bigint(255) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `house_facilities`
--

DROP TABLE IF EXISTS `house_facilities`;
CREATE TABLE IF NOT EXISTS `house_facilities` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `facility` varchar(255) NOT NULL,
  `house_id` int(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `house_group`
--

DROP TABLE IF EXISTS `house_group`;
CREATE TABLE IF NOT EXISTS `house_group` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `group` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `house_likes`
--

DROP TABLE IF EXISTS `house_likes`;
CREATE TABLE IF NOT EXISTS `house_likes` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `realtor_id` int(255) NOT NULL,
  `house_id` int(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `house_photos`
--

DROP TABLE IF EXISTS `house_photos`;
CREATE TABLE IF NOT EXISTS `house_photos` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `house_id` int(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `main` tinyint(2) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=283 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `house_photos`
--

INSERT INTO `house_photos` (`id`, `house_id`, `photo`, `title`, `main`, `created_at`, `updated_at`) VALUES
(106, 99, '39104152_46977-brand-new-4-bedroom-duplex-with-bq-for-rent-in-semi-detached-duplexes-for-rent--jabi-abuja-nigeria.jpg', 'Front View', 1, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(107, 99, 'kitchen.jpg', 'Kitchen', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(108, 100, 'Kitchen.jpg', 'house 1', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(109, 100, 'IMG-20170601-WA0003.jpg', 'house 2', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(110, 101, 'IMG_00001781.jpg', 'Gate', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(111, 101, 'IMG_00001782.jpg', 'Front', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(118, 106, 'IMG-20170605-WA0007.jpg', 'A front View', 0, '2018-05-17 13:17:08', '2018-11-09 08:23:18'),
(119, 106, 'IMG-20170605-WA0004.jpg', 'Kitchen', 0, '2018-05-17 13:17:08', '2018-11-09 08:36:15'),
(120, 106, 'IMG-20170605-WA0006.jpg', 'Sitting room', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(121, 106, 'IMG-20170605-WA0010.jpg', 'Compound', 1, '2018-05-17 13:17:08', '2018-11-09 08:36:15'),
(126, 107, '4_bedrooms_detached.jpg', '4 bedroom duplex', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(128, 108, '3BedroomSemi-detachedBungalowwithBQ.jpg', 'Architectural View', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(129, 109, '4bedroomterraceduplexwithbq.jpg', 'Architectural View', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(130, 110, '5bedroomfullydetachedduplexwithBQ-TypeB.jpg', 'Architectural View', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(131, 111, '20161021_151230.jpg', 'asdasd', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(132, 111, 'images.jpg', 'asdasd', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(133, 112, 'IMG_20161026_150118.jpg', 'Carcass level', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(134, 113, 'IMG-20170703-WA0008.jpg', 'Front View', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(135, 113, 'FrontView.jpg', 'Front Entrance', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(136, 113, 'Kitchen-1.jpg', 'Kitchen', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(137, 113, 'Bedroom.jpg', 'Sitting Room', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(138, 113, 'Bathroom.jpg', 'Bathroom', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(139, 114, 'IMG-20170726-WA0010.jpg', 'Front view', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(140, 114, 'IMG-20170726-WA0006.jpg', 'Kitchen', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(141, 114, 'IMG-20170726-WA0008.jpg', 'Bathroom', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(143, 115, 'IMG-20170822-WA0004.jpg', 'Front View ', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(144, 115, 'IMG-20170822-WA0006.jpg', 'Neighborhood view ', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(145, 115, 'IMG-20170822-WA0005.jpg', 'Backyard', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(146, 115, 'IMG-20170822-WA0003.jpg', 'Parlor', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(147, 115, 'IMG-20170822-WA0002.jpg', 'Kitchen ', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(148, 115, 'IMG-20170822-WA0001.jpg', 'Restroom', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(150, 118, 'IMG-20170601-WA0003.jpg', 'Front View', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(151, 118, 'IMG-20170601-WA0005.jpg', 'Sitting Room', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(152, 118, 'IMG-20170601-WA0007.jpg', 'Bedroom', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(153, 118, 'IMG-20170601-WA0004.jpg', 'Kitchen', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(154, 119, 'Slide1.JPG', 'Front view', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(155, 119, 'Slide3.JPG', 'Compound', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(156, 119, 'Slide12.JPG', 'BQ', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(157, 119, 'Slide6.JPG', 'Parlor', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(158, 119, 'Slide15.JPG', 'Environment', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(159, 120, 'YayaleEstate.jpg', 'FOR SALE', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(160, 121, 'IMG-20170918-WA0007.jpg', 'Front View', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(161, 122, 'IMG-20170918-WA0007.jpg', 'Outside View', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(162, 122, 'IMG-20170918-WA0012.jpg', 'Front View', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(163, 122, 'IMG-20170918-WA0015.jpg', 'Parlor', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(164, 122, 'IMG-20170918-WA0014.jpg', 'Kitchen', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(165, 122, 'IMG-20170918-WA0011.jpg', 'Bedroom', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(166, 122, 'IMG-20170918-WA0002.jpg', 'Bedroom', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(167, 122, 'IMG-20170918-WA0006.jpg', 'Wadrobe', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(168, 122, 'IMG-20170918-WA0003.jpg', 'Toilet', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(169, 122, 'IMG-20170918-WA0001.jpg', 'Toilet', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(170, 122, 'IMG-20170918-WA0009.jpg', 'Front Gate', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(171, 123, 'IMG-20170918-WA0017.jpg', 'Compound View', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(172, 123, 'IMG-20170918-WA0021.jpg', 'Sitting Room', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(173, 123, 'IMG-20170918-WA0022.jpg', 'Kitchen', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(174, 123, 'IMG-20170918-WA0025.jpg', 'Bedroom Wadrobe', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(175, 123, 'IMG-20170918-WA0019.jpg', 'Rest Room', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(176, 124, 'IMG-20170918-WA0037.jpg', 'Sitting Room', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(177, 124, 'IMG-20170918-WA0031.jpg', 'Kitchen', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(178, 124, 'IMG-20170918-WA0038.jpg', 'Corridor', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(179, 124, 'IMG-20170918-WA0034.jpg', 'Bathroom', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(180, 124, 'IMG-20170918-WA0029.jpg', 'Generator Set', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(181, 124, 'IMG-20170918-WA0030.jpg', '', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(182, 125, 'IMG-20170918-WA0044.jpg', 'Front View', 1, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(183, 125, 'IMG-20170918-WA0046.jpg', 'Bathroom', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(184, 125, 'IMG-20170918-WA0039.jpg', 'Bedroom', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(185, 125, 'IMG-20170918-WA0042.jpg', 'Sitting Room', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(186, 125, 'IMG-20170918-WA0047.jpg', 'Untitled', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(187, 126, 'IMG-20170918-WA0049.jpg', 'Front View', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(188, 126, 'IMG-20170918-WA0050.jpg', 'Untitled', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(189, 126, 'IMG-20170918-WA0048.jpg', 'Untitled', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(190, 117, 'IMG-20170918-WA0060.jpg', '', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(191, 117, 'IMG-20170918-WA0061.jpg', '', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(192, 117, 'IMG-20170918-WA0062.jpg', '', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(193, 117, 'IMG-20170918-WA0063.jpg', '', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(194, 117, 'IMG-20170918-WA0064.jpg', '', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(195, 117, 'IMG-20170918-WA0070.jpg', '', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(196, 127, 'BricksCity9.jpg', 'FOR SALE', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(197, 127, 'BricksCity1.jpg', 'Front View ', 1, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(198, 127, 'BricksCity3.jpg', 'Bedroom Toilet ', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(199, 127, 'BricksCity7.jpg', 'Visitors Toilet ', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(200, 127, 'BricksCity6.jpg', 'Sitting Room View ', 1, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(201, 127, 'BricksCity5.jpg', 'Bedroom View ', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(209, 128, 'Slide1.JPG', 'Compound', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(210, 128, 'Slide2.JPG', 'Flat 1', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(211, 128, 'Slide3.JPG', 'Compound ', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(212, 128, 'Slide5.JPG', 'Shops', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(213, 128, 'WORK.jpg', 'Prometheus Solutions', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(221, 129, 'Slide1.JPG', 'Front view', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(222, 129, 'Slide2.JPG', 'Compound', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(223, 129, 'Slide4.JPG', 'BQ', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(224, 129, 'Ipent7Estate.jpg', 'Road map', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(225, 129, 'WORK.jpg', 'Prometheus Solutions', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(226, 130, 'Slide1.JPG', 'Untitled', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(227, 130, 'Slide3.JPG', 'Untitled', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(228, 130, 'Slide4.JPG', 'Untitled', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(229, 130, 'Slide7.JPG', 'Untitled', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(230, 130, 'WORK.jpg', 'Untitled', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(231, 131, 'Slide1.JPG', 'Front view', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(232, 131, 'Slide3.JPG', 'Compound', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(233, 131, 'Slide7.JPG', 'inside', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(234, 131, 'Slide6.JPG', 'BQ', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(235, 131, 'Ipent7Estate.jpg', 'Road map', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(236, 132, 'img.jpg', 'Front View Plan', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(237, 132, 'IMG_3948.JPG', '', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(238, 132, 'IMG_3949.JPG', '', 1, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(239, 132, 'IMG_3950.JPG', '', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(240, 132, 'IMG_3951.JPG', '', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(241, 132, 'IMG_3952.JPG', '', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(242, 133, 'Slide2.JPG', 'Front view', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(243, 133, 'Slide4.JPG', 'Compound', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(244, 133, 'Slide5.JPG', 'Side compound', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(245, 133, 'Slide7.JPG', 'Fish spot', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(246, 133, 'Slide8.JPG', 'Security house', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(247, 133, 'Slide10.JPG', 'Restaurant', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(248, 133, 'Slide11.JPG', 'Lodge', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(249, 133, 'Slide12.JPG', 'Sitting room', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(250, 133, 'Slide13.JPG', 'Smoothy spot', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(251, 133, 'Slide14.JPG', 'Bar ', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(252, 133, 'Slide15.JPG', 'Inside bar', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(253, 133, 'Slide17.JPG', 'Inside bar', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(254, 133, 'Slide18.JPG', 'Sides', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(255, 133, 'Slide19.JPG', 'reception', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(256, 134, 'Slide1.JPG', 'Front view', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(257, 134, 'Slide2.JPG', 'Street', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(258, 134, 'Slide3.JPG', 'Back side', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(259, 134, 'Slide4.JPG', 'Back side', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(260, 134, 'Slide5.JPG', 'Public swimming pool', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(261, 135, 'Slide1.JPG', 'Front view', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(262, 135, 'Slide2.JPG', 'Side view', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(263, 135, 'Slide3.JPG', 'Mini estate', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(264, 135, 'Slide6.JPG', 'Up view', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(265, 135, 'Slide4.JPG', 'Up view', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(266, 136, 'Slide1.JPG', 'Front view', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(267, 136, 'Slide3.JPG', 'Side view', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(268, 136, 'Slide5.JPG', 'Compound', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(269, 136, 'Slide10.JPG', 'Inside', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(270, 136, 'Slide11.JPG', 'Untitled', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(271, 137, 'Slide1.JPG', 'Front view', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(272, 137, 'Slide5.JPG', 'back side', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(273, 137, 'Slide6.JPG', 'back side', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(274, 137, 'Slide4.JPG', 'BQ', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(275, 137, 'Slide9.JPG', 'Palor', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(276, 137, 'Slide10.JPG', 'Kitchen', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(277, 137, 'Slide15.JPG', 'Room', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(278, 137, 'Slide14.JPG', 'Toilet', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(279, 142, 'Slide5.JPG', 'Front View', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(280, 143, 'Slide2.JPG', 'Untitled', 0, '2018-05-17 13:17:08', '2018-05-17 13:17:08'),
(281, 144, '1547998658-IMG_20161230_124031.jpg', 'Garden', 0, '2019-01-20 14:37:41', '2019-01-20 14:37:41'),
(282, 144, '1547998661-IMG-20180826-WA0003.jpg', 'Best View', 0, '2019-01-20 14:37:41', '2019-01-20 14:37:41');

-- --------------------------------------------------------

--
-- Table structure for table `house_traffic`
--

DROP TABLE IF EXISTS `house_traffic`;
CREATE TABLE IF NOT EXISTS `house_traffic` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `counter` int(255) NOT NULL,
  `house_id` int(255) NOT NULL,
  `logged_in` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `house_types`
--

DROP TABLE IF EXISTS `house_types`;
CREATE TABLE IF NOT EXISTS `house_types` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `house_types`
--

INSERT INTO `house_types` (`id`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Self-Contain', '2018-05-17 12:53:48', '2018-05-17 12:53:48'),
(2, 'Flat', '2018-05-17 12:53:48', '2018-05-17 12:53:48'),
(3, 'Bungalow Duplex', '2018-05-17 12:53:48', '2018-05-17 12:53:48'),
(4, 'Duplex', '2018-05-17 12:53:48', '2018-05-17 12:53:48'),
(5, 'Semi-detached Bungalow', '2018-05-17 12:53:48', '2018-05-17 12:53:48'),
(6, 'Service Apartment', '2018-05-17 12:53:48', '2018-05-17 12:53:48'),
(7, 'Semi-detached Duplex', '2018-05-17 12:53:48', '2018-05-17 12:53:48'),
(8, 'Fully-detached Bungalow', '2018-05-17 12:53:48', '2018-05-17 12:53:48'),
(9, 'Fully-detached Bungalow', '2018-05-17 12:53:48', '2018-05-17 12:53:48'),
(10, 'Fully-detached Duplex', '2018-05-17 12:53:48', '2018-05-17 12:53:48'),
(11, 'Terrace Duplex', '2018-05-17 12:53:48', '2018-05-17 12:53:48'),
(12, 'office', '2018-05-17 12:53:48', '2018-05-17 12:53:48');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
CREATE TABLE IF NOT EXISTS `locations` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Apo', '2018-05-17 13:02:36', '2018-05-17 13:02:36'),
(2, 'Bwari', '2018-05-17 13:02:36', '2018-05-17 13:02:36'),
(3, 'Garki', '2018-05-17 13:02:36', '2018-05-17 13:02:36'),
(4, 'Gwarimpa', '2018-05-17 13:02:36', '2018-05-17 13:02:36'),
(5, 'Jabi', '2018-05-17 13:02:36', '2018-05-17 13:02:36'),
(6, 'Kado', '2018-05-17 13:02:36', '2018-05-17 13:02:36'),
(7, 'Kubwa', '2018-05-17 13:02:36', '2018-05-17 13:02:36'),
(8, 'Life Camp', '2018-05-17 13:02:36', '2018-05-17 13:02:36'),
(9, 'Lugbe', '2018-05-17 13:02:36', '2018-05-17 13:02:36'),
(10, 'Mararaba', '2018-05-17 13:02:36', '2018-05-17 13:02:36'),
(11, 'Nyanya', '2018-05-17 13:02:36', '2018-05-17 13:02:36'),
(12, 'Wuse', '2018-05-17 13:02:36', '2018-05-17 13:02:36'),
(13, 'Garki II', '2018-05-17 13:02:36', '2018-05-17 13:02:36'),
(14, 'Utako', '2018-05-17 13:02:36', '2018-05-17 13:02:36'),
(16, 'Wuse 2', '2018-05-17 13:02:36', '2018-05-17 13:02:36'),
(17, 'Maitama', '2018-05-17 13:02:36', '2018-05-17 13:02:36'),
(18, 'Asokoro', '2018-05-17 13:02:36', '2018-05-17 13:02:36'),
(19, 'Idu', '2018-05-17 13:02:36', '2018-05-17 13:02:36'),
(20, 'Kado', '2018-05-17 13:02:36', '2018-05-17 13:02:36'),
(21, 'Bwari', '2018-05-17 13:02:36', '2018-05-17 13:02:36'),
(22, 'Wuye', '2018-05-17 13:02:36', '2018-05-17 13:02:36'),
(23, 'Mabuishi', '2018-05-17 13:02:36', '2018-05-17 13:02:36'),
(24, 'Galadimawa', '2018-05-17 13:02:36', '2018-05-17 13:02:36'),
(25, 'Jahi', '2018-05-17 13:02:36', '2018-05-17 13:02:36'),
(26, 'Katampe', '2018-05-17 13:02:36', '2018-05-17 13:02:36');

-- --------------------------------------------------------

--
-- Table structure for table `managers`
--

DROP TABLE IF EXISTS `managers`;
CREATE TABLE IF NOT EXISTS `managers` (
  `manager_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `sender_id` bigint(20) DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `receiver_id` bigint(20) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `related` varchar(10) DEFAULT NULL,
  `related_id` bigint(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `received_at` int(255) DEFAULT NULL,
  `read` tinyint(1) NOT NULL DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `name`, `phone`, `email`, `receiver_id`, `title`, `message`, `related`, `related_id`, `created_at`, `received_at`, `read`, `updated_at`) VALUES
(1, 5, NULL, NULL, NULL, 53, NULL, 'I like this house', 'house', 100, '2018-11-14 10:58:34', NULL, 0, '2018-11-14 10:58:34');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `page_id` int(255) NOT NULL,
  `pagename` varchar(255) NOT NULL,
  `pageurl` varchar(255) NOT NULL,
  `admin` int(2) NOT NULL DEFAULT '0',
  `page_order` int(10) NOT NULL DEFAULT '-1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `partner_emails`
--

DROP TABLE IF EXISTS `partner_emails`;
CREATE TABLE IF NOT EXISTS `partner_emails` (
  `email_id` bigint(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `partner_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `potential_realtors`
--

DROP TABLE IF EXISTS `potential_realtors`;
CREATE TABLE IF NOT EXISTS `potential_realtors` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `bb` varchar(10) DEFAULT NULL,
  `website_id` int(255) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `source` varchar(255) NOT NULL,
  `communication` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=96 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `potential_realtors`
--

INSERT INTO `potential_realtors` (`id`, `name`, `address`, `email`, `bb`, `website_id`, `date`, `source`, `communication`) VALUES
(34, 'Derek', NULL, NULL, NULL, NULL, '2017-08-12 06:51:31', 'friend', ''),
(35, 'Elijah Ogunsanya & Associates ', NULL, NULL, NULL, 1, '2017-09-26 09:39:26', 'website', NULL),
(36, 'Segun kareem', NULL, NULL, NULL, 1, '2017-09-26 10:09:21', 'website', NULL),
(37, 'Above Ventures', NULL, NULL, NULL, 1, '2017-09-26 10:10:09', 'website', NULL),
(38, 'Synergy Real Properties Nig Ltd', 'Suite 14, Tolse Plaza, Franca Afegbua Crescent Behind Apo Legistlative Quarters Zone D Abuja', NULL, NULL, 1, '2017-10-12 12:16:50', 'website', NULL),
(39, 'Saba', NULL, NULL, NULL, 3, '2017-10-12 12:18:04', 'website', NULL),
(40, 'Mayowa', NULL, NULL, NULL, 5, '2017-10-12 12:20:11', 'website', NULL),
(41, 'Sam Onah Consulting', 'Suite A34, 3rd Floor, Abraham Plaza beside ABC transport Utako ', NULL, NULL, 5, '2017-10-12 12:22:09', 'website', NULL),
(42, 'MLS Properties', 'Suite 201, 1473 Inner Block Street By CoolFM', NULL, NULL, 5, '2017-10-12 12:23:09', 'website', NULL),
(43, 'Gbenga ', NULL, NULL, NULL, 3, '2017-10-12 12:24:29', 'website', NULL),
(44, 'Sammie', NULL, NULL, NULL, 3, '2017-10-12 12:25:08', 'website', NULL),
(45, 'Mr Greatness', NULL, NULL, NULL, 3, '2017-10-12 12:25:33', 'website', NULL),
(46, 'Apro Global Real Estate', NULL, NULL, NULL, 3, '2017-10-12 12:26:08', 'website', NULL),
(47, 'Anthony', NULL, NULL, NULL, 3, '2017-10-12 12:26:39', 'website', NULL),
(48, 'Morris Jerry', NULL, NULL, NULL, 3, '2017-10-12 12:29:10', 'website', NULL),
(49, 'Ken', NULL, NULL, NULL, 3, '2017-10-12 12:30:09', 'website', NULL),
(50, 'Dotun or Abiodun', NULL, NULL, NULL, 3, '2017-10-12 12:30:39', 'website', NULL),
(58, 'Patrick Ogungbola', NULL, NULL, NULL, 6, '2017-11-06 10:13:52', 'website', NULL),
(52, 'Tolulope', NULL, NULL, NULL, 3, '2017-10-12 12:31:38', 'website', NULL),
(53, 'Clamshell Management Consult Ltd', NULL, NULL, NULL, 3, '2017-10-12 12:32:24', 'website', NULL),
(54, 'Fracan Group', NULL, NULL, NULL, 3, '2017-10-12 12:33:00', 'website', NULL),
(55, 'Immobillare', NULL, NULL, NULL, 3, '2017-10-12 12:33:31', 'website', NULL),
(56, 'Ehiz', NULL, NULL, NULL, 3, '2017-10-12 12:36:55', 'website', NULL),
(59, 'ABUJA PROPERTIES', NULL, NULL, NULL, 6, '2017-11-06 10:21:29', 'website', NULL),
(60, 'Eugene Okafor', NULL, NULL, NULL, 6, '2017-11-06 10:30:38', 'website', NULL),
(61, 'Proponent Properties Limited', NULL, NULL, NULL, 6, '2017-11-06 10:35:11', 'website', NULL),
(62, 'Yusuf Abdulrahaman', NULL, NULL, NULL, 6, '2017-11-06 10:43:41', 'website', NULL),
(63, 'Niyi Fadoju', NULL, NULL, NULL, 6, '2017-11-06 10:45:17', 'website', NULL),
(64, 'CHIBUZOR OGUGUA ', 'Suite B9, Dansarari plaza, 5 Zinguinchor street, Wuse Zone 4., Abuja', NULL, NULL, 4, '2017-11-20 10:23:08', 'website', NULL),
(65, 'Phil-Henshaw Properties', 'Suite 2 Hilltop Annex, Hilltop Plaza Plot 2189, House No. 13, Gwani Street, Near Pioneer Hotel, Zone 4, Wuse, Abuja', NULL, NULL, 4, '2017-11-20 10:25:42', 'website', NULL),
(66, 'ROT ULTIMATE', 'Suite 3, 3rd floor, Standard Plaza, Aminu Kano Crescent, Wuse 2,, Abuja', NULL, NULL, 4, '2017-11-20 10:28:08', 'website', NULL),
(67, 'Muyiwa Olumilua & Associates', 'Suite 16, Hill Top Plaza, Gwani Cresent, Wuse Zone 4, Abuja, Abuja', NULL, NULL, 4, '2017-11-20 10:30:09', 'website', NULL),
(68, 'Desmond Umoru Consulting', '3015 Garnet Suites Ambeez Plaza, plot 2121 Wuse Zone 5. Abuja, FCT, ABUJA', NULL, NULL, 4, '2017-11-20 10:35:15', 'website', NULL),
(69, 'Temitope Olaitan & Co', '6 Beside Skye Bank, Gadonasko Road Kubwa, Abuja', NULL, NULL, 4, '2017-11-20 10:37:41', 'website', NULL),
(70, 'Ubosi Eleh & Co', 'Federal Mortgage Bank of Nigeria Building, 2nd Floor Wing B, CBD, Abuja, Abuja', NULL, NULL, 4, '2017-11-20 10:40:15', 'website', NULL),
(71, 'Your Agent: Helen Davies', 'Koton Karfe Close Off Oyo Street, Area 2, Garki, Abuja (FCT)', NULL, NULL, 4, '2017-11-20 10:43:44', 'website', NULL),
(72, 'Dennis Ogugua', 'Afri-Investment House, Aguiyi Ironsi Street,Maitama, FCT, Abuja, Abuja', NULL, NULL, 4, '2017-11-20 10:47:01', 'website', NULL),
(73, 'Obi Udeh & Co', 'Suite 51, God\'s Own Plaza, No.4, Takum Street, Area 11, Garki, Abuja', NULL, NULL, 4, '2017-11-20 10:49:12', 'website', NULL),
(74, 'Mustapha Tobiloba', NULL, NULL, NULL, 6, '2017-12-14 08:58:04', 'website', NULL),
(75, 'Beverly & Sam Properties', NULL, NULL, NULL, 5, '2017-12-14 09:53:08', 'website', NULL),
(76, 'Wellpro Development', NULL, NULL, NULL, 5, '2017-12-14 09:56:27', 'website', NULL),
(77, 'Recta Ventures Nig Ltd', NULL, NULL, NULL, 5, '2017-12-14 10:04:43', 'website', NULL),
(78, 'St. Dyke Consulting', NULL, NULL, NULL, 5, '2017-12-14 10:06:22', 'website', NULL),
(79, 'Hoods Prolifics Ltd', NULL, NULL, NULL, 5, '2017-12-14 10:10:20', 'website', NULL),
(80, 'El Muazu Ventures', NULL, NULL, NULL, 1, '2017-12-14 10:15:55', 'website', NULL),
(81, 'Olaleye Olatunji and Partners', NULL, NULL, NULL, 1, '2017-12-14 11:24:27', 'website', NULL),
(82, 'Y-Bims Reality', NULL, NULL, NULL, 1, '2017-12-14 11:26:42', 'website', NULL),
(83, 'Underwood Homes Ltd', NULL, NULL, NULL, 1, '2017-12-14 11:30:01', 'website', NULL),
(84, 'Habitat Multi Concept Solutions', NULL, NULL, NULL, 1, '2017-12-14 11:32:01', 'website', NULL),
(85, 'Clement', NULL, NULL, NULL, 3, '2017-12-18 19:59:14', 'website', NULL),
(86, 'Emmanuel', NULL, NULL, NULL, 3, '2017-12-18 20:01:22', 'website', NULL),
(87, 'George Oladayo', NULL, NULL, NULL, 3, '2017-12-18 20:02:04', 'website', NULL),
(88, 'Tundegodson Properties Ltd', NULL, NULL, NULL, 3, '2017-12-18 20:03:09', 'website', NULL),
(89, 'chucks', NULL, NULL, NULL, 3, '2017-12-18 20:04:45', 'website', NULL),
(90, 'Olaleye, Olatunji And Partners ', 'Suite 305, Nwukpabi Plaza, Plot 14, Waziri Ibrahim, Gudu, Abuja, Nigeria', NULL, NULL, 1, '2017-12-18 20:51:21', 'website', NULL),
(91, 'Nwofor Emmanuel & Co', 'Suite 3015, Anbeez Plaza, Plot 2121 Ndola Square, Zone 5, Wuse, Abuja', NULL, NULL, 1, '2017-12-18 20:58:41', 'website', NULL),
(92, 'Afronal Nigeria Limited', 'Plot 351, Stotage Area Mini Estate, Karu, F.c.t., Nigeria', NULL, NULL, 1, '2017-12-18 21:01:54', 'website', NULL),
(93, 'Habitat Multiconcept Solutions Ltd', 'Md1/73, Amino Kano Crescent, Wuse Ii, Abuja, Nigeria ', NULL, NULL, 1, '2017-12-18 21:35:07', 'website', NULL),
(94, 'Formula One Properties Ltd', '9 Ubiaja Crescent, Garki 2, Abuja, Nigeria', NULL, NULL, 1, '2017-12-18 21:39:06', 'website', NULL),
(95, 'Ricosino Property Investment Ltd', 'No. 56, Shagari Road, Arewa Avenue, Bwari, Abuja, Nigeria', NULL, NULL, 1, '2017-12-18 21:41:20', 'website', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `potential_realtors_phones`
--

DROP TABLE IF EXISTS `potential_realtors_phones`;
CREATE TABLE IF NOT EXISTS `potential_realtors_phones` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `realtor_id` int(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `whatsapp` tinyint(1) NOT NULL DEFAULT '0',
  `status` varchar(255) NOT NULL DEFAULT 'not verified',
  `status_msg` varchar(255) NOT NULL DEFAULT 'not called',
  `called` int(11) NOT NULL DEFAULT '0',
  `texted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=110 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `potential_realtors_phones`
--

INSERT INTO `potential_realtors_phones` (`id`, `realtor_id`, `phone`, `whatsapp`, `status`, `status_msg`, `called`, `texted`) VALUES
(27, 34, '08056342197', 0, 'not verified', 'not called', 0, 0),
(25, 34, '08130222255', 0, 'not verified', 'not called', 0, 0),
(28, 35, '07032259691', 0, 'not verified', 'not called', 0, 0),
(29, 36, '08023360799', 0, 'not verified', 'not called', 0, 0),
(30, 37, '08167546525', 0, 'not verified', 'not called', 0, 0),
(31, 37, '08158742264', 0, 'not verified', 'not called', 0, 0),
(32, 38, '08089246354', 0, 'not verified', 'not called', 0, 0),
(33, 39, '07065514161', 0, 'not verified', 'not called', 0, 0),
(34, 40, '08039012945', 0, 'not verified', 'not called', 0, 0),
(35, 40, '07080655400', 0, 'not verified', 'not called', 0, 0),
(36, 41, '08036411845', 0, 'not verified', 'not called', 0, 0),
(37, 42, '07056144444', 0, 'not verified', 'not called', 0, 0),
(38, 43, '08035347514', 0, 'not verified', 'not called', 0, 0),
(39, 44, '07037925195', 0, 'not verified', 'not called', 0, 0),
(40, 45, '08135148470', 0, 'not verified', 'not called', 0, 0),
(41, 46, '08051595336', 0, 'not verified', 'not called', 0, 0),
(42, 47, '08035584623', 0, 'not verified', 'not called', 0, 0),
(43, 48, '08034791927', 0, 'not verified', 'not called', 0, 0),
(44, 49, '07036917033', 0, 'not verified', 'not called', 0, 0),
(45, 50, '08162865869', 0, 'not verified', 'not called', 0, 0),
(53, 58, '08177766110', 0, 'not verified', 'not called', 0, 0),
(47, 52, '08157347776', 0, 'not verified', 'not called', 0, 0),
(48, 53, '08037024476', 0, 'not verified', 'not called', 0, 0),
(49, 54, '08063628972', 0, 'not verified', 'not called', 0, 0),
(50, 55, '08059357805', 0, 'not verified', 'not called', 0, 0),
(51, 56, '08156551720', 0, 'not verified', 'not called', 0, 0),
(54, 58, '08177766112', 0, 'not verified', 'not called', 0, 0),
(55, 58, '08177766113', 0, 'not verified', 'not called', 0, 0),
(56, 58, '08177766115', 0, 'not verified', 'not called', 0, 0),
(57, 58, '08032065685', 0, 'not verified', 'not called', 0, 0),
(58, 59, '08063933400', 0, 'not verified', 'not called', 0, 0),
(59, 59, '08033249800', 0, 'not verified', 'not called', 0, 0),
(60, 60, '08068071335', 0, 'not verified', 'not called', 0, 0),
(61, 61, '08058468786', 0, 'not verified', 'not called', 0, 0),
(62, 61, '08030718979', 0, 'not verified', 'not called', 0, 0),
(63, 62, '08039562455', 0, 'not verified', 'not called', 0, 0),
(65, 63, '08033203838', 0, 'not verified', 'not called', 0, 0),
(66, 63, '08055864552', 0, 'not verified', 'not called', 0, 0),
(67, 64, '08033207337', 0, 'not verified', 'not called', 0, 0),
(68, 65, '08033114523', 0, 'not verified', 'not called', 0, 0),
(69, 65, '08036234538', 0, 'not verified', 'not called', 0, 0),
(70, 66, '08034039283', 0, 'not verified', 'not called', 0, 0),
(71, 66, '08055243512', 0, 'not verified', 'not called', 0, 0),
(72, 67, '08052110448', 0, 'not verified', 'not called', 0, 0),
(73, 67, '08033158430', 0, 'not verified', 'not called', 0, 0),
(74, 68, '08099138643', 0, 'not verified', 'not called', 0, 0),
(75, 69, '08065668830', 0, 'not verified', 'not called', 0, 0),
(76, 70, '08075559872', 0, 'not verified', 'not called', 0, 0),
(77, 71, '08033082277', 0, 'not verified', 'not called', 0, 0),
(78, 72, '08034494451', 0, 'not verified', 'not called', 0, 0),
(79, 73, '08053696323', 0, 'not verified', 'not called', 0, 0),
(80, 74, '08182437036', 0, 'not verified', 'not called', 0, 0),
(81, 74, '07082634581', 0, 'not verified', 'not called', 0, 0),
(82, 75, '08038156271', 0, 'not verified', 'not called', 0, 0),
(83, 76, '08185520099', 0, 'not verified', 'not called', 0, 0),
(84, 77, '08099290842', 0, 'not verified', 'not called', 0, 0),
(85, 78, '08033263439', 0, 'not verified', 'not called', 0, 0),
(86, 79, '08025833334', 0, 'not verified', 'not called', 0, 0),
(87, 79, '08172867955', 0, 'not verified', 'not called', 0, 0),
(88, 79, '08181600444', 0, 'not verified', 'not called', 0, 0),
(89, 80, '08173724299', 0, 'not verified', 'not called', 0, 0),
(90, 80, '08106600637', 0, 'not verified', 'not called', 0, 0),
(91, 81, '08023304854', 0, 'not verified', 'not called', 0, 0),
(92, 81, '08106600637', 0, 'not verified', 'not called', 0, 0),
(93, 82, '08173129197', 0, 'not verified', 'not called', 0, 0),
(94, 83, '08139120600', 0, 'not verified', 'not called', 0, 0),
(95, 84, '08063647009', 0, 'not verified', 'not called', 0, 0),
(96, 85, '08039718347', 0, 'not verified', 'not called', 0, 0),
(97, 86, '09099045590', 0, 'not verified', 'not called', 0, 0),
(98, 87, '08184321505', 0, 'not verified', 'not called', 0, 0),
(99, 88, '09061158545', 0, 'not verified', 'not called', 0, 0),
(100, 89, '08051788236', 0, 'not verified', 'not called', 0, 0),
(101, 90, '08033176863', 0, 'not verified', 'not called', 0, 0),
(102, 91, '08062410093', 0, 'not verified', 'not called', 0, 0),
(103, 92, '08095457696', 0, 'not verified', 'not called', 0, 0),
(104, 93, '09098604100', 0, 'not verified', 'not called', 0, 0),
(105, 93, '08173594407', 0, 'not verified', 'not called', 0, 0),
(106, 94, '07053009827', 0, 'not verified', 'not called', 0, 0),
(107, 94, '07084979809', 0, 'not verified', 'not called', 0, 0),
(108, 95, '08142436766', 0, 'not verified', 'not called', 0, 0),
(109, 95, '09052396539', 0, 'not verified', 'not called', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `potential_realtor_responses`
--

DROP TABLE IF EXISTS `potential_realtor_responses`;
CREATE TABLE IF NOT EXISTS `potential_realtor_responses` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `realtor_id` int(255) NOT NULL,
  `response` text NOT NULL,
  `action_taken` text NOT NULL,
  `response_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `action_date` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `price_ranges`
--

DROP TABLE IF EXISTS `price_ranges`;
CREATE TABLE IF NOT EXISTS `price_ranges` (
  `price_range_id` int(255) NOT NULL,
  `minimum` int(255) NOT NULL,
  `maximum` bigint(255) NOT NULL,
  `display` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `price_ranges`
--

INSERT INTO `price_ranges` (`price_range_id`, `minimum`, `maximum`, `display`) VALUES
(1, 0, 250000, 'N250,000 and Below'),
(2, 250000, 400000, 'N250,000 - N400,000'),
(3, 400000, 600000, 'N400,000 - N600,000'),
(4, 600000, 800000, 'N600,000 - N800,000'),
(5, 800000, 1000000, 'N800,000 - N1,000,000'),
(6, 1000000, 100000000, 'N1,000,000 - N100,000,000'),
(7, 100000000, 500000000, 'N100,000,000 - N500,000,000'),
(8, 500000000, 1000000000, 'N500,000,000 - N1,000,000,000'),
(9, 1000000000, 1000000000000000, 'N1billion and Above');

-- --------------------------------------------------------

--
-- Table structure for table `promos`
--

DROP TABLE IF EXISTS `promos`;
CREATE TABLE IF NOT EXISTS `promos` (
  `promo_id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `duration` varchar(100) DEFAULT NULL,
  `description` text NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`promo_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promos`
--

INSERT INTO `promos` (`promo_id`, `name`, `duration`, `description`, `added_at`) VALUES
(1, 'Zizix6 Promo', NULL, 'In Partnership with Zizix6, building low cost websites for Abuja Apartments Realtors', '2018-01-14 10:24:56');

-- --------------------------------------------------------

--
-- Table structure for table `promo_codes`
--

DROP TABLE IF EXISTS `promo_codes`;
CREATE TABLE IF NOT EXISTS `promo_codes` (
  `code_id` bigint(255) NOT NULL AUTO_INCREMENT,
  `promo_id` int(255) NOT NULL,
  `code` varchar(10) NOT NULL,
  `claimed` tinyint(1) NOT NULL DEFAULT '0',
  `realtor_id` int(255) DEFAULT NULL,
  `added_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`code_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promo_codes`
--

INSERT INTO `promo_codes` (`code_id`, `promo_id`, `code`, `claimed`, `realtor_id`, `added_at`) VALUES
(16, 1, 'x7pfbtv', 0, 69, '2018-01-29 11:42:55'),
(15, 1, '7q2ifvu', 0, 68, '2018-01-29 11:39:07'),
(17, 1, 'bzi5lax', 0, 70, '2018-01-29 11:45:22'),
(18, 1, 'csdpla0', 0, 71, '2018-01-29 14:06:32'),
(19, 1, 'btiksxo', 0, 72, '2018-01-29 14:15:47');

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

DROP TABLE IF EXISTS `properties`;
CREATE TABLE IF NOT EXISTS `properties` (
  `property_id` int(100) NOT NULL,
  `location` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `status` varchar(5) NOT NULL,
  `house_type_id` varchar(100) NOT NULL,
  `price` int(20) NOT NULL,
  `manager_id` int(255) NOT NULL,
  `description` text NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `realtors`
--

DROP TABLE IF EXISTS `realtors`;
CREATE TABLE IF NOT EXISTS `realtors` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `biz_name` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `profile_name` varchar(255) DEFAULT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(20) DEFAULT NULL,
  `parent_id` int(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `sec_question` varchar(255) DEFAULT NULL,
  `sec_answer` varchar(255) DEFAULT NULL,
  `pin` varchar(10) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `created` int(255) DEFAULT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '1',
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `email_confirmation` varchar(255) NOT NULL DEFAULT '1',
  `visible` int(1) DEFAULT '1',
  `blocked` tinyint(1) DEFAULT '0',
  `blocked_reason` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `remember_token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `realtor_id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `realtors`
--

INSERT INTO `realtors` (`id`, `biz_name`, `firstname`, `lastname`, `profile_name`, `profile_photo`, `password`, `type`, `parent_id`, `address`, `email`, `twitter`, `sec_question`, `sec_answer`, `pin`, `website`, `created`, `activated`, `verified`, `email_confirmation`, `visible`, `blocked`, `blocked_reason`, `created_at`, `updated_at`, `remember_token`) VALUES
(5, 'derek', 'Derek', 'Halims', 'derek', '5.jpg', '$2y$10$bpbxe3a4wwRUPeDbvHKf4eolffIvuJlpGO5c4dR7VlSSNAmJ2PvwC', 'agent', 0, NULL, 'derekhalims@gmail.com', NULL, 'Whats your nickname', 'derek', NULL, NULL, 1489787851, 1, 1, '1', 1, 0, NULL, '2018-05-17 13:20:24', '2018-05-17 13:20:24', 'xe7us4FafUX8H2cGv4YeLD9BGkf7u1298SEk4cfujOts7XYYIL2y9LbaelRH'),
(6, 'Adron homes', 'Ajirotutu', 'Folashade', 'Bidemite', '6.jpg', '', 'agent', 0, NULL, 'Shadebidemi@gmail.com', NULL, 'My name', 'Shade', 'D8C29B5C', NULL, 149150435, 1, 0, '1', 1, 0, NULL, '2018-05-17 13:20:24', '2018-05-17 13:20:24', NULL),
(7, 'ADRON HOMES', 'JOSADE', 'ADEKUNLE', 'Jobanty', '7.jpg', '', 'agent', 0, NULL, 'herdey4u@gmail.com', NULL, 'my pet', 'lion', '', NULL, 1491600129, 1, 0, '1', 1, 0, NULL, '2018-05-17 13:20:24', '2018-05-17 13:20:24', NULL),
(29, NULL, 'Akachukwu', 'Aneke', 'Princeak', '29.jpg', '$2y$10$KRF3JH2qI9VTzDq4PtEtD.KI8PM4LhHsnZhFdVpDpM3aPqZ/.AkI6', 'agent', 0, '8 Charles Street Maitama Abuja', 'akalodave@gmail.com', 'daprinceak', 'My Favorite Color', 'Blue', '', NULL, 1492272068, 1, 0, '1', 1, 0, NULL, '2018-05-17 13:20:24', '2018-05-17 13:20:24', NULL),
(30, 'Emmy', 'Nnaemeka', 'Okoli', 'popsy', '30.jpg', '$2y$10$A7tSM5yTt4yNxHAnAjeEMexCpMM00Hdw2V5ajLFzkX22IlR5EQqja', 'agent', 0, '12 Adikpo Close 313 Road, FHA Kubwa', 'akalojob@gmail.com', NULL, 'my Nickname', 'Popsy', '', NULL, 1492365317, 1, 0, '1', 0, 0, NULL, '2018-05-17 13:20:24', '2018-05-17 13:20:24', NULL),
(34, 'hasadiq', 'abubakar sadiq', 'halilulah', 'abubakarsadiqhalilulah', '34.jpg', '$2y$10$4cadFyLgaz5zaNSivi2Li.hTMzrEE0tHu7hZ986K5hTa2Ws3K8.z6', 'agent', 0, 'NO. 43B 3rd avenue junction, Gwarinpa, Abuja', 'hasadiq42009@yahoo.com', NULL, 'what is my name', 'sadiq', '', NULL, 1493291978, 1, 0, '1', 1, 0, NULL, '2018-05-17 13:20:24', '2018-05-17 13:20:24', NULL),
(35, 'RealestNigeria', 'Emeka', 'Emeghebo', 'RealestNigeria', '35.jpg', '$2y$10$6MfUSQNz3/Pe1bObhcLpxezwq9JA3dw1IhhavfXm/dx9ntangl7Si', 'agent', 0, 'Behind Sabongari Police Station, Bwari Abuja', 'emesonreigns@gmail.com', NULL, 'Mother\'s Name? ', 'Grace', '', NULL, 1493662836, 1, 0, '1', 1, 0, NULL, '2018-05-17 13:20:24', '2018-05-17 13:20:24', NULL),
(36, '', 'Okoli', 'Nnaemeka', 'Hexane', '36.jpg', '$2y$10$jzUbxu1yYdM0uzukf0LPhO4BNJxb4AwyQ.LVkF63E5IOI6q2G66YS', 'agent', 0, '29/11B Abakaliki Road', 'okolinnaemeka227@gmail.com', NULL, 'My nickname', 'Kacey', '', NULL, 1493921388, 1, 0, '1', 0, 0, NULL, '2018-05-17 13:20:24', '2018-05-17 13:20:24', NULL),
(40, 'NATURE PROPERTIES', 'NAATURE PROPERTIES', NULL, 'NATURE', NULL, '$2y$10$hleNHnWPo9Ph7gHyFEmmFebYNs6U0ZoyV11Hema72npRKm8Obnlfu', 'company', 0, 'Abuja', 'naturesystemsnigeria@gmail.com', NULL, NULL, NULL, NULL, NULL, 1496614804, 1, 0, '1', 1, 0, NULL, '2018-05-17 13:20:24', '2018-05-17 13:20:24', NULL),
(41, 'Pirotti Projects Limited', NULL, NULL, 'PALMS', NULL, '$2y$10$IbhcRFUFBy/dJYgQnrz2JuONhoidDgSqAEAp6W898D1OFy/OuKLjS', 'company', 0, NULL, 'femiadebodun@gmail.com', NULL, NULL, NULL, NULL, NULL, 1497443922, 1, 0, '1', 1, 0, NULL, '2018-05-17 13:20:24', '2018-05-17 13:20:24', NULL),
(42, 'A&G Estate Development', NULL, NULL, 'A&G', 'AGLogo.jpg', '$2y$10$aIaeitep2wfT5hJYaB1NsekyDi0kM6aYPNQl1x.Osum4rZtJNlaMS', 'company', 0, NULL, 'agestatedev@gmail.com', NULL, NULL, NULL, NULL, NULL, 1497508093, 1, 1, '1', 1, 0, NULL, '2018-05-17 13:20:24', '2018-05-17 13:20:24', NULL),
(43, 'ajebutter estate ltd', NULL, NULL, 'ajebo', NULL, '$2y$10$YWKS6LSeqEGEOdmqkmyCBOsxAieZW8ovSv8ibtjPTNdv9hsWM19Am', 'company', 0, NULL, 'ajebo@gmail.com', NULL, NULL, NULL, NULL, NULL, 1497631087, 1, 0, '1', 0, 0, NULL, '2018-05-17 13:20:24', '2018-05-17 13:20:24', NULL),
(45, 'Goldspot', 'Goldie', 'Ellanor', 'goldie', NULL, '$2y$10$GTPXeDMfxWoOE01lZwggfeYDOlY7a2xteBVaCkS43W.OdR9VE1q/C', 'agent', 0, NULL, 'goldie@gmail.com', NULL, NULL, NULL, NULL, NULL, 1497633657, 1, 0, '1', 0, 0, NULL, '2018-05-17 13:20:24', '2018-05-17 13:20:24', NULL),
(47, 'Alex Innovations', NULL, NULL, 'Alexinnovate', NULL, '$2y$10$7EtXnxet8jMnD1GTbjWqwuAKeat3TldUR84VDQEZNcEeIPDT03E/W', 'company', 0, NULL, 'emmyalexjnr@gmail.com', NULL, NULL, NULL, NULL, NULL, 1497797509, 1, 0, '1', 0, 0, NULL, '2018-05-17 13:20:24', '2018-05-17 13:20:24', NULL),
(48, '', 'BLESSING', 'EKELEME', 'BLESSING', NULL, '$2y$10$7.n96v6cgfsOHBZ6jzqop.N3bWsIsxfSZb9sS0hRaIt7Hjov8u/6e', 'agent', 0, NULL, 'blessing.obike@yahoo.com', NULL, NULL, NULL, NULL, NULL, 1498129843, 1, 0, '1', 0, 0, NULL, '2018-05-17 13:20:24', '2018-05-17 13:20:24', NULL),
(49, 'CNE Graphics Studio', 'Chuks', 'Ezeilo', 'CNE', 'images.jpg', '$2y$10$lV3ychCusGZHYYWAvkFvu.iSEVIu0mfm249amU3dAQovsTgLeZ2sK', 'agent', 0, NULL, 'chuksezeilo@gmail.com', NULL, NULL, NULL, NULL, NULL, 1498137890, 1, 0, '1', 0, 0, NULL, '2018-05-17 13:20:24', '2018-05-17 13:20:24', NULL),
(50, 'PLACES WITH SPACES PROPERTY CONSULTANCY', NULL, NULL, 'CONCEPT', 'IMG_20161113_083747.jpg', '$2y$10$mMy3f7BEjOOeS4pDsIXvPun4S5awQlifuauoPbRePhYmWQpnFHt8e', 'company', 0, NULL, 'chukzyconcept@gmail.com', NULL, NULL, NULL, NULL, NULL, 1498166073, 1, 0, '1', 1, 0, NULL, '2018-05-17 13:20:24', '2018-05-17 13:20:24', NULL),
(51, 'Larrykes', 'Larrykes', 'LarrykesGB', 'Larrykes', NULL, '$2y$10$wMuomDNM2O2JcMXIFgyLaeFzmF2ksXMBpWEjRPJoEy7MW10o5CrUi', 'agent', 0, NULL, 'ti.ne.d.o.l@artquery.info', NULL, NULL, NULL, NULL, NULL, 1500920893, 1, 0, '1', 0, 0, NULL, '2018-05-17 13:20:24', '2018-05-17 13:20:24', NULL),
(52, 'Chinelo Okeke building service', 'Chinelo', 'Okeke', 'Sweetestchi', NULL, '$2y$10$qIv6eX/jjMeCRwtasxCli.NE7axi3gVRaZRDe0ih4N9cqTsKmmz06', 'agent', 0, NULL, 'lovelyanyanwuchi@yahoo.com', NULL, NULL, NULL, NULL, NULL, 1501748113, 1, 0, '1', 1, 0, NULL, '2018-05-17 13:20:24', '2018-05-17 13:20:24', NULL),
(53, 'Prometheus Solutions', NULL, NULL, 'Abubakar', 'WORK.jpg', '$2y$10$cklwPOd3SsZ5Y1XIV.PNq.I3LYMiFosai1EJHJGr2bvm3jc/aWX.u', 'company', 0, 'Suite D86/90, Efab Shopping Mall, Area 11, Garki-Abuja', 'prometheussolutions1@gmail.com', NULL, NULL, NULL, NULL, NULL, 1502711943, 1, 1, '1', 1, 0, NULL, '2018-05-17 13:20:24', '2018-05-17 13:20:24', NULL),
(54, '', 'Usman', 'Danjuma', 'UsmanA', NULL, '$2y$10$XXmZzxBa65zJTUTHDrl0y.fcUY3jshD5Pd8KuSYEX3oQ2L3If9r2q', 'agent', 0, NULL, 'u.abdanj@gmail.com', NULL, NULL, NULL, NULL, NULL, 1504077903, 1, 1, '1', 1, 0, NULL, '2018-05-17 13:20:24', '2018-05-17 13:20:24', NULL),
(55, '', 'Idiege', 'Titus', 'Honesty', 'IMG_20170705_101652.jpg', '$2y$10$sDz.HGDa7q/cf2xWrhilNe.vCGbE96xhYYrP8mYL5u5Dtxe3tWoZS', 'agent', 0, NULL, 'proftesco931@gmail.com', NULL, NULL, NULL, NULL, NULL, 1504122167, 1, 1, '1', 1, 0, NULL, '2018-05-17 13:20:24', '2018-05-17 13:20:24', NULL),
(56, '', 'Abdussalam ', 'Farouk ', 'Abdussalamf', NULL, '$2y$10$7ep5Y2ZbLoBYkKyg0IXH9OUfIJ5Xk38NqMkeBwKmekwpElPdHUuZ2', 'agent', 0, NULL, 'abdulaminu001@yahoo.com', NULL, NULL, NULL, NULL, NULL, 1504510977, 1, 0, '1', 1, 0, NULL, '2018-05-17 13:20:24', '2018-05-17 13:20:24', NULL),
(58, 'Sylva Property ', 'Sylvanus ', 'Ingwu', 'SylvaRose', NULL, '$2y$10$qK6vkabtMEPv.fhA0C4ufeUWQZk5OSEmQ1qY.AijcoLGBqYMrmVyy', 'agent', 0, NULL, 'sylvarose11@gmail.com', NULL, NULL, NULL, NULL, NULL, 1505385707, 1, 1, '1', 1, 0, NULL, '2018-05-17 13:20:24', '2018-05-17 13:20:24', NULL),
(59, 'John John Estate management/Developer', 'Okere', 'James Onyewuchi ', 'JohnJohnEstateManagement/Developer', NULL, '$2y$10$iW3uwm5uD8SjYkrgjKGFCu4LPuQM3GrlIZ2XRPnW3BZwCvM1Os.Oq', 'agent', 0, NULL, 'jamesonyewuchiokere@gmail.com', NULL, NULL, NULL, NULL, NULL, 1506442902, 1, 1, '1', 1, 0, NULL, '2018-05-17 13:20:24', '2018-05-17 13:20:24', NULL),
(60, 'Manuelgog', 'Manuelgog', 'ManuelgogOR', 'Manuelgog', NULL, '$2y$10$nGgAwbKrJuy8I.wZlNtIOemAQyiWsmoQflD9jp6aL8efiseF379hy', 'agent', 0, NULL, 'manueladova@mail.ru', NULL, NULL, NULL, NULL, NULL, 1506745862, 1, 0, '1', 0, 0, NULL, '2018-05-17 13:20:24', '2018-05-17 13:20:24', NULL),
(61, 'IHM Regency', NULL, NULL, 'IHM', NULL, '$2y$10$0F6OBPw/XWo2pJXYOstqNeJzsMOGktOdZvDoXH4IaYKoy2rFxyEWy', 'company', 0, NULL, 'akaloforex@gmail.com', NULL, NULL, NULL, NULL, NULL, 1506882752, 1, 0, '1', 0, 0, NULL, '2018-05-17 13:20:24', '2018-05-17 13:20:24', NULL),
(62, 'ViboPoope', 'ViboPoope', 'Carter ', 'ViboPoope', NULL, '$2y$10$VdwjV2LkI1WAdoj0HCPPkOkJrPGaoueimxKA7.hdWe5P4bFQ1LhYC', 'agent', 0, NULL, 'qiewo4p@1syn.info', NULL, NULL, NULL, NULL, NULL, 1507288785, 1, 0, '1', 0, 0, NULL, '2018-05-17 13:20:24', '2018-05-17 13:20:24', NULL),
(63, 'Doveland Properties ', 'Isaac ', 'Anthony ', 'DovelandProperties', NULL, '$2y$10$afn7US4pV7J2lrIom/NbtOZuA9yN3igYLLrqgFxn.ddhIHLY2sy7m', 'agent', 0, NULL, 'isaacitodo1@gmail.com', NULL, NULL, NULL, NULL, NULL, 1507810820, 1, 0, '1', 1, 0, NULL, '2018-05-17 13:20:24', '2018-05-17 13:20:24', NULL),
(64, 'MissBee', 'Beauty ', 'Ogar', 'MissBee', NULL, '$2y$10$tzBPhwVCnJpAAmJ8SxS4sO0PXR9rNQHTe3SuwxsSg09NGw.oaCSaq', 'agent', 0, NULL, 'Beautyogar72@gmail.com', NULL, NULL, NULL, NULL, NULL, 1507877758, 1, 0, '1', 1, 0, NULL, '2018-05-17 13:20:24', '2018-05-17 13:20:24', NULL),
(72, 'Zizix6', 'Aegon', 'Targaryen', 'PrinceAeg', NULL, '$2y$10$etI/1OnbrcKw5gjIZLFCCeLPb7qzOOVWYRhUQKI0zhWRQwQkkVU4q', 'agent', 0, NULL, 'zizix6@gmail.com', NULL, NULL, NULL, NULL, NULL, 1517235347, 1, 0, '1', 1, 0, NULL, '2018-05-17 13:20:24', '2018-05-17 13:20:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `realtor_houses`
--

DROP TABLE IF EXISTS `realtor_houses`;
CREATE TABLE IF NOT EXISTS `realtor_houses` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `house_id` int(255) NOT NULL,
  `realtor_id` int(255) NOT NULL,
  `available` tinyint(1) NOT NULL DEFAULT '1',
  `shared` tinyint(1) NOT NULL DEFAULT '0',
  `shared_with` int(255) NOT NULL DEFAULT '0',
  `sharer_id` int(255) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `realtor_houses`
--

INSERT INTO `realtor_houses` (`id`, `house_id`, `realtor_id`, `available`, `shared`, `shared_with`, `sharer_id`, `created_at`, `updated_at`) VALUES
(34, 99, 29, 1, 0, 0, 0, '2017-04-15 15:29:55', '2017-04-15 15:29:55'),
(35, 100, 29, 1, 0, 0, 0, '2017-05-04 16:57:21', '2017-05-04 16:57:21'),
(36, 101, 36, 1, 0, 0, 0, '2017-05-04 17:17:47', '2017-05-04 17:17:47'),
(41, 106, 5, 1, 0, 0, 0, '2017-06-11 14:02:36', '2017-06-11 14:02:36'),
(42, 107, 42, 1, 0, 0, 0, '2017-06-18 11:06:48', '2017-06-18 11:06:48'),
(43, 108, 42, 1, 0, 0, 0, '2017-06-19 11:18:43', '2017-06-19 11:18:43'),
(44, 109, 42, 1, 0, 0, 0, '2017-06-19 11:30:27', '2017-06-19 11:30:27'),
(45, 110, 42, 1, 0, 0, 0, '2017-06-19 11:42:56', '2017-06-19 11:42:56'),
(46, 111, 49, 1, 0, 0, 0, '2017-06-22 12:57:10', '2017-06-22 12:57:10'),
(47, 112, 50, 1, 0, 0, 0, '2017-06-22 20:33:21', '2017-06-22 20:33:21'),
(48, 113, 5, 1, 0, 0, 0, '2017-07-09 11:08:16', '2017-07-09 11:08:16'),
(49, 114, 50, 1, 0, 0, 0, '2017-07-26 18:22:07', '2017-07-26 18:22:07'),
(50, 115, 5, 1, 0, 2, 0, '2017-08-25 02:16:23', '2019-01-09 14:36:39'),
(51, 116, 55, 1, 0, 0, 0, '2017-08-30 19:04:45', '2017-08-30 19:04:45'),
(52, 117, 55, 1, 0, 0, 0, '2017-08-30 19:04:59', '2017-08-30 19:04:59'),
(53, 118, 5, 1, 0, 0, 0, '2017-08-31 06:42:41', '2017-08-31 06:42:41'),
(54, 119, 53, 1, 0, 0, 0, '2017-09-10 07:45:03', '2017-09-10 07:45:03'),
(55, 120, 58, 1, 0, 0, 0, '2017-09-14 09:46:37', '2017-09-14 09:46:37'),
(56, 121, 29, 1, 0, 0, 0, '2017-09-18 10:36:56', '2017-09-18 10:36:56'),
(57, 122, 55, 1, 0, 0, 0, '2017-09-18 10:51:49', '2017-09-18 10:51:49'),
(58, 123, 55, 1, 0, 0, 0, '2017-09-18 11:07:16', '2017-09-18 11:07:16'),
(59, 124, 55, 1, 0, 0, 0, '2017-09-18 11:25:44', '2017-09-18 11:25:44'),
(60, 125, 55, 1, 0, 0, 0, '2017-09-18 11:55:19', '2017-09-18 11:55:19'),
(61, 126, 55, 1, 0, 0, 0, '2017-09-18 12:16:07', '2017-09-18 12:16:07'),
(62, 127, 58, 1, 0, 0, 0, '2017-09-21 11:48:22', '2017-09-21 11:48:22'),
(63, 128, 53, 1, 0, 0, 0, '2017-10-01 14:36:33', '2017-10-01 14:36:33'),
(64, 129, 53, 1, 0, 0, 0, '2017-10-01 15:02:11', '2017-10-01 15:02:11'),
(65, 130, 53, 1, 0, 0, 0, '2017-10-01 15:07:44', '2017-10-01 15:07:44'),
(66, 131, 53, 1, 0, 0, 0, '2017-10-01 15:46:57', '2017-10-01 15:46:57'),
(67, 132, 56, 1, 0, 0, 0, '2017-10-01 18:35:59', '2017-10-01 18:35:59'),
(68, 133, 53, 1, 0, 0, 0, '2017-10-03 08:55:32', '2017-10-03 08:55:32'),
(69, 134, 53, 1, 0, 0, 0, '2017-10-03 09:26:17', '2017-10-03 09:26:17'),
(70, 135, 53, 1, 0, 0, 0, '2017-10-03 09:49:29', '2017-10-03 09:49:29'),
(71, 136, 53, 1, 0, 0, 0, '2017-10-03 09:54:14', '2017-10-03 09:54:14'),
(72, 137, 53, 1, 0, 0, 0, '2017-10-05 07:58:19', '2017-10-05 07:58:19'),
(73, 142, 53, 1, 0, 0, 0, '2017-11-01 08:16:56', '2017-11-01 08:16:56'),
(74, 143, 53, 1, 0, 0, 0, '2017-11-01 08:16:56', '2017-11-01 08:16:56'),
(78, 115, 29, 1, 1, 0, 5, '2019-01-09 12:49:44', '2019-01-09 14:36:39'),
(79, 144, 42, 1, 0, 0, 0, '2019-01-20 14:37:38', '2019-01-20 14:37:38');

-- --------------------------------------------------------

--
-- Table structure for table `realtor_phones`
--

DROP TABLE IF EXISTS `realtor_phones`;
CREATE TABLE IF NOT EXISTS `realtor_phones` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `phone` varchar(20) NOT NULL,
  `realtor_id` int(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `phone_id` (`id`),
  KEY `phone_id_2` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `realtor_phones`
--

INSERT INTO `realtor_phones` (`id`, `phone`, `realtor_id`, `created_at`, `updated_at`) VALUES
(23, '07039775298', 29, '2018-05-17 13:26:09', '2018-05-17 13:26:09'),
(24, '08130222255', 5, '2018-05-17 13:26:09', '2018-05-17 13:26:09'),
(25, '08176537042', 6, '2018-05-17 13:26:09', '2018-05-17 13:26:09'),
(26, '08060096740', 7, '2018-05-17 13:26:09', '2018-05-17 13:26:09'),
(27, '08039249293', 30, '2018-05-17 13:26:09', '2018-05-17 13:26:09'),
(28, '0813022225', 33, '2018-05-17 13:26:09', '2018-05-17 13:26:09'),
(29, '08064769459', 34, '2018-05-17 13:26:09', '2018-05-17 13:26:09'),
(30, '08067679775', 35, '2018-05-17 13:26:09', '2018-05-17 13:26:09'),
(31, '08039249293', 36, '2018-05-17 13:26:09', '2018-05-17 13:26:09'),
(33, '09093241553', 38, '2018-05-17 13:26:09', '2018-05-17 13:26:09'),
(34, '07039775298', 39, '2018-05-17 13:26:09', '2018-05-17 13:26:09'),
(35, '08071239555', 40, '2018-05-17 13:26:09', '2018-05-17 13:26:09'),
(36, '08020690678', 41, '2018-05-17 13:26:09', '2018-05-17 13:26:09'),
(37, '07036308330', 42, '2018-05-17 13:26:09', '2018-05-17 13:26:09'),
(38, '07039775298', 43, '2018-05-17 13:26:09', '2018-05-17 13:26:09'),
(39, '09080200933', 44, '2018-05-17 13:26:09', '2018-05-17 13:26:09'),
(40, '08054345678', 45, '2018-05-17 13:26:09', '2018-05-17 13:26:09'),
(41, '08037156161', 46, '2018-05-17 13:26:09', '2018-05-17 13:26:09'),
(42, '08062977023', 47, '2018-05-17 13:26:09', '2018-05-17 13:26:09'),
(43, '08030771993', 48, '2018-05-17 13:26:09', '2018-05-17 13:26:09'),
(44, '8033173299', 49, '2018-05-17 13:26:09', '2018-05-17 13:26:09'),
(45, '07036308330', 50, '2018-05-17 13:26:09', '2018-05-17 13:26:09'),
(46, '89659838344', 51, '2018-05-17 13:26:09', '2018-05-17 13:26:09'),
(47, '08160244633', 52, '2018-05-17 13:26:09', '2018-05-17 13:26:09'),
(48, '08095402982', 54, '2018-05-17 13:26:09', '2018-05-17 13:26:09'),
(49, '09098756825', 53, '2018-05-17 13:26:09', '2018-05-17 13:26:09'),
(50, '08173871106', 55, '2018-05-17 13:26:09', '2018-05-17 13:26:09'),
(51, '08135328758', 56, '2018-05-17 13:26:09', '2018-05-17 13:26:09'),
(52, '86886955532', 57, '2018-05-17 13:26:09', '2018-05-17 13:26:09'),
(53, '08088311813', 58, '2018-05-17 13:26:09', '2018-05-17 13:26:09'),
(54, '08036343767', 59, '2018-05-17 13:26:09', '2018-05-17 13:26:09'),
(55, '81912264628', 60, '2018-05-17 13:26:09', '2018-05-17 13:26:09'),
(56, '08135328758', 61, '2018-05-17 13:26:09', '2018-05-17 13:26:09'),
(57, '84134933226', 62, '2018-05-17 13:26:09', '2018-05-17 13:26:09'),
(58, '08067175940 ', 63, '2018-05-17 13:26:09', '2018-05-17 13:26:09'),
(59, '07032726453', 64, '2018-05-17 13:26:09', '2018-05-17 13:26:09'),
(61, '08063498777', 68, '2018-05-17 13:26:09', '2018-05-17 13:26:09'),
(62, '08063498777', 69, '2018-05-17 13:26:09', '2018-05-17 13:26:09'),
(63, '08063498777', 70, '2018-05-17 13:26:09', '2018-05-17 13:26:09'),
(64, '08063498777', 71, '2018-05-17 13:26:09', '2018-05-17 13:26:09'),
(65, '08063498777', 72, '2018-05-17 13:26:09', '2018-05-17 13:26:09');

-- --------------------------------------------------------

--
-- Table structure for table `realtor_traffic`
--

DROP TABLE IF EXISTS `realtor_traffic`;
CREATE TABLE IF NOT EXISTS `realtor_traffic` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `counter` int(255) NOT NULL,
  `realtor_id` int(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shared_houses`
--

DROP TABLE IF EXISTS `shared_houses`;
CREATE TABLE IF NOT EXISTS `shared_houses` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `house_id` int(255) NOT NULL,
  `realtor_id` int(255) NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `share_requests`
--

DROP TABLE IF EXISTS `share_requests`;
CREATE TABLE IF NOT EXISTS `share_requests` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `shared_id` bigint(255) NOT NULL,
  `sharer_id` bigint(255) NOT NULL,
  `house_id` bigint(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
CREATE TABLE IF NOT EXISTS `tickets` (
  `ticket_id` bigint(20) NOT NULL,
  `realtor_id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(50) NOT NULL DEFAULT 'pending',
  `resolved_time` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

DROP TABLE IF EXISTS `tokens`;
CREATE TABLE IF NOT EXISTS `tokens` (
  `token_id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) NOT NULL,
  `shared_by` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`token_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tokens`
--

INSERT INTO `tokens` (`token_id`, `token`, `shared_by`, `created_at`, `updated_at`) VALUES
(1, '0e7175ee390d49750089a8103a2a2eff', 'zizix6', '2018-01-29 10:23:24', '2018-01-29 10:23:24');

-- --------------------------------------------------------

--
-- Table structure for table `traffic`
--

DROP TABLE IF EXISTS `traffic`;
CREATE TABLE IF NOT EXISTS `traffic` (
  `traffic_id` int(255) NOT NULL,
  `viewer_id` int(255) DEFAULT NULL,
  `realtor_id` int(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `websites`
--

DROP TABLE IF EXISTS `websites`;
CREATE TABLE IF NOT EXISTS `websites` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `website` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `websites`
--

INSERT INTO `websites` (`id`, `website`) VALUES
(1, 'nigeriapropertycentre.com'),
(2, 'zulwa.com'),
(3, 'olx.com'),
(4, 'Jumia.com'),
(5, 'privateproperty.com'),
(6, 'property24.com.ng');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
