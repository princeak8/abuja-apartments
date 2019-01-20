-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2018 at 03:58 PM
-- Server version: 5.7.9
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `abuja_apa`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `displayname` varchar(255) NOT NULL,
  `accesslevel` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `blocked` tinyint(1) NOT NULL DEFAULT '0',
  `blocked_reason` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `username`, `password`, `displayname`, `accesslevel`, `created`, `blocked`, `blocked_reason`) VALUES
(5, 'akalo', '$2y$10$566AwmEgSHOegfT21Y11SO6PmqOxzR9AiU4UFwuT1lFSbtg4EL6jm', 'Prince AK', 1, '2017-05-05 02:16:38', 0, ''),
(6, 'peter', '$2y$10$oez/fmkMrLMfKko/utOzKOT8S7kCNpAP2gvjgw5Y.GQ26wcRLwvXW', 'Peter', 2, '2017-10-06 21:09:29', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blacklisted_ips`
--

DROP TABLE IF EXISTS `blacklisted_ips`;
CREATE TABLE IF NOT EXISTS `blacklisted_ips` (
  `blacklisted_ip_id` int(255) NOT NULL,
  `blacklisted_ip` varchar(255) NOT NULL,
  `blacklist_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `circles`
--

DROP TABLE IF EXISTS `circles`;
CREATE TABLE IF NOT EXISTS `circles` (
  `circle_id` bigint(255) NOT NULL,
  `requester_id` int(255) NOT NULL,
  `accepter_id` int(255) NOT NULL,
  `request_sent` int(255) NOT NULL,
  `request_accepted` int(255) DEFAULT NULL,
  `accepted` tinyint(4) NOT NULL DEFAULT '0',
  `declined` tinyint(1) NOT NULL DEFAULT '0',
  `request_declined` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` bigint(255) NOT NULL,
  `type` varchar(10) NOT NULL,
  `type_id` bigint(255) NOT NULL,
  `realtor_id` bigint(255) NOT NULL,
  `comment` text NOT NULL,
  `comment_added` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

DROP TABLE IF EXISTS `days`;
CREATE TABLE IF NOT EXISTS `days` (
  `day_id` int(255) NOT NULL,
  `day` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `errors`
--

DROP TABLE IF EXISTS `errors`;
CREATE TABLE IF NOT EXISTS `errors` (
  `error_id` bigint(255) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `page` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`error_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `estates`
--

DROP TABLE IF EXISTS `estates`;
CREATE TABLE IF NOT EXISTS `estates` (
  `estate_id` int(255) NOT NULL AUTO_INCREMENT,
  `realtor_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location_id` int(255) NOT NULL,
  `water_source` varchar(255) NOT NULL,
  `facilities` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`estate_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `estates`
--

INSERT INTO `estates` (`estate_id`, `realtor_id`, `name`, `location_id`, `water_source`, `facilities`, `description`, `added`) VALUES
(1, 42, 'Nelson Mandela Garden, Galadimawa District', 24, 'N/A', 'first class shopping mall (Horiland Mall), hospital, International School, hotel, bank, fueling station, sport complex', '<p>This luxury estate is situated in a prime area of the city and is part of the 3rd Development Phase of Abuja master plan. The Development-Control-Approved-Building-Plan for the estate consists of 42 units of 4bedrooms Detached Duplex with BQ- Types A 33units of 5bedroom detached duplex with BQ- Type B, 12units of 4Bedrooms Terrace duplex, 2units of 3Bedroom Bungalows Fully Detached with BQ 4units of 3Bedroom Bungalows Semi Detached with BQ.</p>', '2017-06-15 06:38:37'),
(2, 53, 'Ipent 6 Estate', 24, 'Bore Hole', '', '<p>A plot of land in a well developed estate Through Gudu or Apo Shopright, at Gaduwa.<br />It is a build-able plot for 5-bedroom fully detached duplex, 2 bedroom BQ and a paint House at Legislative Villa (Ipent VI Estate) The owner of this plot bought the plot for 25million naira from Ipent Estate Developers and i have the documents with me. all he wants is a serious buyer to will pay 20million Naire only (due to some financial issues). contact me for original copy.<br />People are already living in the estate. <br /><br />Plot: B8<br />5-bedroom Duplex<br />2bedroon BQ<br /><br />The facilities of the estate includes;<br />* Tarred Road<br />* Quality Landscape<br />* Adequate Car parking<br />* Estate Management<br />* PHCN Supply<br />* Street Light Supply<br />* Paved Walk-ways<br />* Neighbourhood Centre<br />* Police Post<br />* Security Personnel<br />* Children Playground<br /><br />Marketed by PROMETHEUS SOLUTIONS<br /><br />FOR MORE INFORMATION PLEASE CONTACT US<br />Phone 09098756825 or 07033385434<br />Email: <br />Website: replaced_link<br />Corporate Head Office: Suite D86/90, Efab Shopping Mall Extension, opp. FCDA, Area11, Garki-Abuja. <br /><br />RC: 2434487<br />PROMETHEUS LIMITED<br />Your Real Estate Solutions&hellip;</p>', '2017-08-21 06:26:59'),
(3, 53, 'Ipent 5 Estate', 4, 'N/A', 'The Facilities of the Estate includes: * Tarred Road * Quality Landscape * Adequate Car parking * Estate Management * PHCN Supply * Street Light Supply * Paved Walk-ways * Neighborhood Centre * Police Post * Security Personnel * Children Playground', '<p>A plot of land in a well developed estate after charley Boys Gwarinpa</p>\r\n<p>A well located build-able plot for 4-bedroom fully detached duplex with 2-bedrooms BQ and enough car packing space at Ipent 7 Estate.</p>\r\n<p>People are already living in the estate.</p>\r\n<p>&nbsp;</p>\r\n<p>Plot: 323, 324, 325, and 326</p>\r\n<p>4-bedroom Duplex</p>\r\n<p>600sqm</p>\r\n<p>2bedroon BQ</p>\r\n<p>&nbsp;</p>\r\n<p><strong>The Facilities of the Estate includes:</strong></p>\r\n<p>* Tarred Road</p>\r\n<p>* Quality Landscape</p>\r\n<p>* Adequate Car parking</p>\r\n<p>* Estate Management</p>\r\n<p>* PHCN Supply</p>\r\n<p>* Street Light Supply</p>\r\n<p>* Paved Walk-ways</p>\r\n<p>* Neighborhood Centre</p>\r\n<p>* Police Post</p>\r\n<p>* Security Personnel</p>\r\n<p>* Children Playground</p>\r\n<p>&nbsp;</p>\r\n<p>Marketed By PROMETHEUS SOLUTIONS&hellip;</p>\r\n<p><strong>FOR MORE INFORMATION PLEASE CONTACT US</strong></p>\r\n<p><strong>Phone:</strong> +234-9098756825 or +234-7033385434</p>\r\n<p><strong>Office: </strong>Suite D86/90, Efab Shopping Mall, Area11, Garki-Abuja.</p>\r\n<p><strong>Email:</strong><a href="mailto:prometheussolutions1@gmail.com">prometheussolutions1@gmail.com</a></p>\r\n<p><strong>Website:</strong> www.prometheusrealty.com</p>\r\n<p><strong>Corporate Head Office:</strong> Suite D86/90, Efab Shopping Mall Extension, opp. FCDA, Area11, Garki-Abuja.&nbsp;</p>\r\n<p><strong>&nbsp;</strong></p>\r\n<p><strong>RC: 2434487</strong></p>\r\n<p><strong>PROMETHEUS LIMITED</strong></p>\r\n<p><em>Your Real Estate Solutions&hellip;</em></p>', '2017-10-01 15:25:42'),
(4, 53, 'Ipent 7 Estate', 4, 'Bore Hole', 'The Facilities of the Estate includes: * Tarred Road * Quality Landscape * Adequate Car parking * Estate Management * PHCN Supply * Street Light Supply * Paved Walk-ways * Neighborhood Centre * Police Post * Security Personnel * Children Playground', '<p>Appealing 4-Bedroom Carcass Duplex &amp; 2-Bedrooms BQ at Ipent 7 Estate, Gwarinpa-FCT Abuja</p>\r\n<p>Description: This delightful duplex derives attraction from its scintillating finishes that gives an occupant a sensation of semi-heaven living. This is because the property is in between luxurious houses in an alluring and secured environment.</p>\r\n<p>This duplex is made up of 3 bedrooms (all rooms are en-suite) upstairs while down stairs has 1 bedroom (en-suite), spacious parlor, kitchen, store, dinning area, and a guest toilet. Its compound has a 2 bedrooms en-suite BQ with a kitchen and then a security house which is beside the entrance of the house. The compound is large enough to accommodate from 6 to 8 cars.</p>\r\n<p>LOCATIONS: This property is situated at No. 44, Alikum Street, Ipent 7 Estate, Gwarinpa-FCT Abuja.</p>\r\n<p>&nbsp;</p>\r\n<p>Marketed By PROMETHEUS SOLUTIONS&hellip;</p>\r\n<p><strong>FOR MORE INFORMATION PLEASE CONTACT US</strong></p>\r\n<p><strong>Phone:</strong> +234-9098756825 or +234-7033385434</p>\r\n<p><strong>Office: </strong>Suite D86/90, Efab Shopping Mall, Area11, Garki-Abuja.</p>\r\n<p><strong>Email:</strong><a href="mailto:prometheussolutions1@gmail.com">prometheussolutions1@gmail.com</a></p>\r\n<p><strong>Website:</strong> www.prometheusrealty.com</p>\r\n<p><strong>Corporate Head Office:</strong> Suite D86/90, Efab Shopping Mall Extension, opp. FCDA, Area11, Garki-Abuja.</p>\r\n<p><strong>&nbsp;</strong></p>\r\n<p><strong>RC: 2434487</strong></p>\r\n<p><strong>PROMETHEUS LIMITED</strong></p>\r\n<p><em>Your Real Estate Solutions&hellip;</em></p>\r\n<p>&nbsp;</p>', '2017-10-01 15:56:21');

-- --------------------------------------------------------

--
-- Table structure for table `estate_traffic`
--

DROP TABLE IF EXISTS `estate_traffic`;
CREATE TABLE IF NOT EXISTS `estate_traffic` (
  `traffic_id` int(255) NOT NULL,
  `viewer_id` int(255) DEFAULT NULL,
  `estate_id` int(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `failed_logins`
--

DROP TABLE IF EXISTS `failed_logins`;
CREATE TABLE IF NOT EXISTS `failed_logins` (
  `failed_login_id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `attempts` int(10) NOT NULL,
  `last_time` varchar(255) NOT NULL,
  `login_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `failed_logins`
--

INSERT INTO `failed_logins` (`failed_login_id`, `username`, `attempts`, `last_time`, `login_date`) VALUES
(4, 'akalo', 0, '1505741141', ''),
(5, 'Bidemite', 2, '1492275448', ''),
(6, 'rick', 1, '1492559600', ''),
(7, 'princeak', 3, '1508828240', ''),
(8, 'hasadiq42009@yahoo.com', 2, '1493292328', ''),
(9, 'hasadiq', 1, '1493292377', ''),
(10, 'derek', 0, '1500101898', ''),
(11, '''=''''or''@gmail.com', 1, '1496850317', ''),
(12, '''=''''or''', 1, '1496850331', ''),
(13, 'admin', 1, '1496850335', ''),
(14, 'A&G', 0, '1497742361', ''),
(15, 'a7G', 1, '1497873735', ''),
(16, 'zeany', 1, '1499975702', ''),
(17, 'tin.edol.@artquery.info', 1, '1500920930', ''),
(18, 't.i.n.e.d.ol.@artquery.info', 1, '1500974751', ''),
(19, 't.ine.dol.@artquery.info', 1, '1501063164', ''),
(20, 'chukzyconcept@gmail.com', 0, '1501096442', ''),
(21, 'tined.o.l.@artquery.info', 1, '1501163880', ''),
(22, 't.i.n.edo.l.@artquery.info', 1, '1501233713', ''),
(23, 'u.abdanj@gmail.com', 0, '1504077964', '');

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

DROP TABLE IF EXISTS `feedbacks`;
CREATE TABLE IF NOT EXISTS `feedbacks` (
  `feedback_id` int(255) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `feedback` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `visible` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`feedback_id`, `fullname`, `email`, `phone`, `feedback`, `created`, `visible`) VALUES
(1, 'Elisa Brown', 'ieowlp@qqqdatxre.com', 'Elisa Brown', 'This is a message to the Home - Houses admin. Your website is missing out on at least 300 visitors per day. Our traffic system will  dramatically increase your traffic to your website: http://pcgroup.com.uy/15 - We offer 500 free targeted visitors during our free trial period and we offer up to 30,000 targeted visitors per month. Hope this helps :)', '2017-04-24 08:20:14', 1),
(2, 'Elisa Brown', 'tyjrorhhot@jpzxow.com', 'Elisa Brown', 'I discovered your Home - Houses page and noticed you could have a lot more traffic. I have found that the key to running a website is making sure the visitors you are getting are interested in your subject matter. We can send you targeted traffic and we let you try it for free. Get over 1,000 targeted visitors per day to your website. Check it out here: http://shorturl.van.ee/h -                                                                                                                                                 Unsubscribe here:http://acortarurl.es/8y', '2017-04-29 00:34:44', 1),
(3, 'Elisa Brown', 'izfiyjl@dsfqvcffpvk.com', 'Elisa Brown', 'I came across your Home - Houses website and wanted to let you know that we have decided to open our POWERFUL and PRIVATE website traffic system to the public for a limited time! You can sign up for our targeted traffic network with a free trial as we make this offer available again. If you need targeted traffic that is interested in your subject matter or products start your free trial today: http://tdil.co/3p', '2017-05-03 14:14:14', 1),
(4, 'Elisa Brown', 'iaduozrzdd@znxiqpeut.com', 'Elisa Brown', 'I came across your Home - Houses website and wanted to let you know that we have decided to open our POWERFUL and PRIVATE web traffic system to the public for a limited time! You can sign up for our targeted traffic network with a free trial as we make this offer available again. If you need targeted traffic that is interested in your subject matter or products start your free trial today: http://priscilarodrigues.com.br/url/v', '2017-05-07 04:49:57', 1),
(5, 'Chelsea Wallace', 'pzomvrkcz@watwowsefzm.com', 'Chelsea Wallace', 'I came across your Home - Houses website and wanted to let you know that we have decided to open our POWERFUL and PRIVATE web traffic system to the public for a limited time! You can sign up for our targeted traffic network with a free trial as we make this offer available again. If you need targeted traffic that is interested in your subject matter or products start your free trial today: http://tdil.co/3p																				Unsubscribe here: http://acortarurl.es/97', '2017-05-12 18:30:53', 1),
(6, 'Chelsea Wallace', 'ztttifhjm@zwjykx.com', 'Chelsea Wallace', 'I came across your Home - Houses website and wanted to let you know that we have decided to open our POWERFUL and PRIVATE website traffic system to the public for a limited time! You can sign up for our targeted traffic network with a free trial as we make this offer available again. If you need targeted traffic that is interested in your subject matter or products start your free trial today: http://tdil.co/3p																				Unsubscribe here: http://tdil.co/5p', '2017-05-28 02:06:37', 1),
(7, 'Chelsea Wallace', 'kxabwae@onmqqahctlb.com', 'Chelsea Wallace', 'This is a comment to the Home - Houses webmaster. Your website is missing out on at least 300 visitors per day. Our traffic system will  dramatically increase your traffic to your site: http://tdil.co/3p - We offer 500 free targeted visitors during our free trial period and we offer up to 30,000 targeted visitors per month. Hope this helps :)																				Unsubscribe here: http://tdil.co/5p', '2017-05-31 15:40:35', 1),
(8, 'Sarah Hughes', 'ytiodfu@qzkprykgk.com', 'Sarah Hughes', 'This is a comment to the Home - Houses webmaster. Your website is missing out on at least 300 visitors per day. Our traffic system will  dramatically increase your traffic to your site: http://tdil.co/3p - We offer 500 free targeted visitors during our free trial period and we offer up to 30,000 targeted visitors per month. Hope this helps :)																				Unsubscribe here: http://tdil.co/5p', '2017-06-14 04:37:36', 1),
(9, 'Ann Weaver', 'zycyyxgfazp@rfdmum.com', 'Ann Weaver', 'This is a message to the Home - Houses admin. Your website is missing out on at least 300 visitors per day. Our traffic system will  dramatically increase your traffic to your site: http://tdil.co/3p - We offer 500 free targeted visitors during our free trial period and we offer up to 30,000 targeted visitors per month. Hope this helps :)																				Unsubscribe here: http://priscilarodrigues.com.br/url/11', '2017-06-17 17:37:34', 1),
(10, 'Ann Weaver', 'ltdhrpqqi@lcrksbv.com', 'Ann Weaver', 'This is a message to the Home - Houses admin. Your website is missing out on at least 300 visitors per day. Our traffic system will  dramatically increase your traffic to your website: http://stpicks.com/27 - We offer 500 free targeted visitors during our free trial period and we offer up to 30,000 targeted visitors per month. Hope this helps :)																				Unsubscribe here: http://priscilarodrigues.com.br/url/11', '2017-06-20 20:26:00', 1),
(11, 'Ann Weaver', 'sbkxjdf@zfrstyt.com', 'Ann Weaver', 'This is a comment to the Home - Houses admin. Your website is missing out on at least 300 visitors per day. Our traffic system will  dramatically increase your traffic to your site: http://stpicks.com/27 - We offer 500 free targeted visitors during our free trial period and we offer up to 30,000 targeted visitors per month. Hope this helps :)																				Unsubscribe here: http://priscilarodrigues.com.br/url/11', '2017-06-29 19:18:51', 1),
(12, 'Ann Weaver', 'mqtuxf@mjwpoyaq.com', 'Ann Weaver', 'I came across your Home - Houses website and wanted to let you know that we have decided to open our POWERFUL and PRIVATE website traffic system to the public for a limited time! You can sign up for our targeted traffic network with a free trial as we make this offer available again. If you need targeted traffic that is interested in your subject matter or products start your free trial today: http://v-doc.co/nm/jkfq0																				Unsubscribe here: http://priscilarodrigues.com.br/url/11', '2017-07-05 20:54:56', 1);

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

DROP TABLE IF EXISTS `followers`;
CREATE TABLE IF NOT EXISTS `followers` (
  `follow_id` bigint(255) NOT NULL,
  `realtor_id` int(255) NOT NULL,
  `follower_id` int(255) NOT NULL,
  `followed_at` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `houses`
--

DROP TABLE IF EXISTS `houses`;
CREATE TABLE IF NOT EXISTS `houses` (
  `house_id` bigint(255) NOT NULL AUTO_INCREMENT,
  `estate_id` int(255) NOT NULL DEFAULT '0',
  `realtor_id` bigint(255) NOT NULL,
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
  `added` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`house_id`)
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `houses`
--

INSERT INTO `houses` (`house_id`, `estate_id`, `realtor_id`, `units`, `location_id`, `title`, `status`, `house_type_id`, `price`, `rooms`, `bedrooms`, `bathrooms`, `toilets`, `price_range_id`, `purpose`, `facilities`, `water_source`, `sale_plan`, `description`, `available`, `agent_fee`, `service_charge`, `site_id`, `added`) VALUES
(99, 0, 29, 0, 19, '3 Bedroom Duplex', 'rent', 4, 1000000, '8', 3, '3', '3', 6, 'residential', 'sitout', 'Bore Hole', '  	  ', 'Moderate house in industrial area', 1, '100000', 0, NULL, '2017-04-15 16:29:55'),
(100, 0, 29, 0, 2, '10 Nwangene close', 'rent', 6, 5000000, '5', 4, '3', '2', 6, 'residential', NULL, 'N/A', '  	  ', 'This is a very nice house', 1, '100000', 1000, NULL, '2017-05-04 17:57:21'),
(101, 0, 36, 0, NULL, NULL, 'rent', NULL, NULL, '1', 1, '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, 0, '0', 0, NULL, '2017-05-04 18:17:47'),
(106, 0, 5, 0, 7, '4 Units of 2 Bedroom ', 'sale', 4, 48000000, '6', 2, '2', '2', 6, 'residential', 'water', 'Water Board', 'Negotiable, to be negotiated with the seller     ', 'A nice collection of houses in a lively settlement in the FCT      ', 1, '4800000', 0, NULL, '2017-06-11 15:02:36'),
(107, 1, 42, 42, 24, '4 Bedroom Fully Detached Duplex', 'sale', 10, 65000000, '6', 4, '4', '5', 6, 'residential', NULL, 'N/A', '<p>Fully completed units goes for 65,000,000 naira while Carcass (roof level) goes for 45,000,000 naira per a unit.</p>\r\n<p>&nbsp;</p>', '<p>Full description of the house:</p>\r\n<ul>\r\n<li>1 Room Boys Quarter Attached behind the Main Building.</li>\r\n<li>3 Rooms and a Living Room upstairs.</li>\r\n<li>1 Room and a Living Room Downstairs.</li>\r\n<li>All Rooms are En Suite.</li>\r\n<li>Guest Toilet.</li>\r\n</ul>', 1, '0', 0, NULL, '2017-06-18 12:06:48'),
(108, 1, 42, 4, 24, '3Bedroom Semi-detached Bungalow with BQ', 'sale', 5, 35000000, '9', 3, '3', '4', 6, 'residential', 'Boys Quarters, All rooms en suite', 'N/A', '<p>Fully completed unit at N35</p>\r\n<p>Carcass (roof level) at N25m</p>', '<p>3 Room and Living Room Apartment, All Rooms En Suite with a Guest Toilet</p>\r\n<p>A luxery home with lots of active and secure environment</p>', 1, '0', 0, NULL, '2017-06-19 12:18:43'),
(109, 1, 42, 12, 24, '4bedroom terrace duplex with bq', 'sale', 11, 55000000, '12', 4, '4', '5', 6, 'residential', '2 Sitting rooms, all rooms en suite', 'N/A', '<p>Fully completed unit at N55m</p>\r\n<p>Carcass (roof level) at N40m</p>', '<p>3 Room and Living Room at the Top Apartment and 1 Room and Living Room at the Bottom Apartment. All Rooms En Suite with a Guest Toilet</p>\r\n<p>This is a very luxurous apartment that it built to taste</p>', 1, '0', 0, NULL, '2017-06-19 12:30:27'),
(110, 1, 42, 33, 24, '5bedroom fully detached duplex with BQ- Type B', 'sale', 10, 110000000, '14', 5, '5', '6', 7, 'residential', 'All Rooms en suite, 2 sitting rooms, attached 1 room boys quarters', 'N/A', '<p>Fully completed unit at N110m</p>\r\n<p>Carcass (roof level) at N65m</p>', '<p>4 Rooms and A Living Room Upstairs with 1 Room and A Living Room Downstairs. All Rooms En-Suite with a Guest Toilet</p>\r\n<p>1 Room Boys Quarter Attached Behind the Main Building</p>\r\n<p>A very luxurous apartments for a large family, in a vibrant estate and environment</p>', 1, '0', 0, NULL, '2017-06-19 12:42:56'),
(111, 0, 49, 0, 13, '9 Jere Street', 'rent', 7, 500000, '1', 1, '1', '1', 3, 'commercial', NULL, 'N/A', NULL, '<p>office room</p>', 1, '50000', 0, NULL, '2017-06-22 13:57:10'),
(112, 0, 50, 0, 24, '4bedroom fully detached duplex', 'sale', 10, 66000000, '5', 4, '5', '5', 6, 'residential', 'Swimming pool, long tennis court', 'N/A', '<p>Outright sale or come up with your own payment plan or through mortgage banks.</p>', '<p>Located along airport road, with a good access road.</p>', 1, '1750000', 10000, NULL, '2017-06-22 21:33:21'),
(113, 0, 5, 0, 7, '4bedroom Duplex', 'sale', 4, 45000000, '', 4, '', '', 6, 'residential', '', NULL, '45 Million Asking Price	     ', '', 1, '', 0, NULL, '2017-07-09 12:08:16'),
(114, 0, 50, 0, 18, '2bedroom stand alone bungalow at Guzape Asokoro', 'rent', 8, 1600000, NULL, 2, NULL, NULL, NULL, 'residential', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2017-07-26 19:22:07'),
(115, 0, 5, 0, 4, '3 Bedroom Bungalow ', 'sale', 3, 37000000, '', 3, '', '', 6, 'residential', '', NULL, '   	         ', '<p>A very classy house in the biggest estate in west Africa</p>\r\n<p>Has a pent house with impeccable view</p>', 1, '', 0, NULL, '2017-08-25 03:16:23'),
(116, 0, 55, 0, 17, '3bedroom fully detached bungalow @ Nicon junction, katampe district Abuja.', 'rent', 9, 1200000, NULL, 3, NULL, NULL, NULL, 'residential', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, '2017-08-30 20:04:45'),
(117, 0, 55, 0, 17, '3bedroom fully detached bungalow @ Nicon junction, katampe district Abuja.', 'rent', 9, 1200000, '', 3, '', '3', 6, 'residential', '', NULL, '  	     ', '<p>This is a renovated 3 Bedroom Bungalow with 3toilets and bathroom</p>\r\n<p>located at katampe district opposite Nicain Junction Maitama</p>', 1, '', 0, NULL, '2017-08-30 20:04:59'),
(118, 0, 5, 0, 7, '2 Bedroom Bungalow Duplex ', 'sale', 3, 15000000, NULL, 2, NULL, NULL, NULL, 'residential', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2017-08-31 07:42:41'),
(119, 0, 53, 0, 4, 'Newly Built 4-Bedroom Duplex & 2-Bedrooms BQ at Ipent 7 Estate, Gwarinpa-FCT Abuja', 'sale', 4, 60000, '', 4, '', '', 1, 'residential', '', NULL, '  	     ', '<p>Appealing 4-Bedroom Duplex &amp; 2-Bedrooms BQ at Ipent 7 Estate, Gwarinpa-FCT Abuja</p>\r\n<p>Description: This delightful duplex derives attraction from its scintillating finishes that gives an occupant a sensation of semi-heaven living.&nbsp; This is because the property is in between luxurious houses in an alluring and secured environment.</p>\r\n<p>This duplex is made up of 3 bedrooms (all rooms are en-suite) upstairs while down stairs has 1 bedroom (en-suite), spacious parlor, kitchen, store, dinning area, and a guest toilet. Its compound has a 2 bedrooms en-suite BQ with a kitchen and then a security house which is beside the entrance of the house. The compound is large enough to accommodate from 6 to 8 cars.</p>\r\n<p>LOCATIONS: This property is situated at No. 44, Alikum Street, Ipent 7 Estate, Gwarinpa-FCT Abuja.</p>\r\n<p>&nbsp;</p>\r\n<p>Marketed By PROMETHEUS SOLUTIONS&hellip;</p>\r\n<p><strong>FOR MORE INFORMATION PLEASE CONTACT US</strong></p>\r\n<p><strong>Phone:</strong> +234-9098756825 or +234-7033385434</p>\r\n<p><strong>Office: </strong>Suite D86/90, Efab Shopping Mall, Area11, Garki-Abuja.</p>\r\n<p><strong>Email:</strong><a href="mailto:prometheussolutions1@gmail.com">prometheussolutions1@gmail.com</a></p>\r\n<p><strong>Website:</strong> www.prometheusrealty.com</p>\r\n<p><strong>Corporate Head Office:</strong> Suite D86/90, Efab Shopping Mall Extension, opp. FCDA, Area11, Garki-Abuja.&nbsp;</p>\r\n<p><strong>&nbsp;</strong></p>\r\n<p><strong>RC: 2434487</strong></p>\r\n<p><strong>PROMETHEUS LIMITED</strong></p>\r\n<p><em>Your Real Estate Solutions&hellip;</em></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', 1, '5', 0, NULL, '2017-09-10 08:45:02'),
(120, 0, 58, 0, 1, 'Letter of allocation ', 'sale', 2, 20000000, NULL, 3, NULL, NULL, NULL, 'residential', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2017-09-14 10:46:37'),
(121, 0, 29, 0, 23, 'Newly Built Fully Serviced 3Bedroom Flat', 'rent', 2, 2200000, NULL, 3, NULL, NULL, NULL, 'residential', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2017-09-18 11:36:56'),
(122, 0, 55, 0, 23, 'Newly Built', 'rent', 2, 2200000, '5', 3, '3', '3', 6, 'residential', 'Fully Serviced, 250KVA Central Generator', NULL, '  	     ', '<p>This is a Newly Bult Fully Serviced 3Bedroom Flat with BQ</p>\r\n<p>All Rooms en suite with bathtubs.</p>\r\n<p>It is serviced with AC, 250KVA Central Generator</p>\r\n<p>For maximum Comfort, just pay and move in</p>', 1, '220000', 300000, NULL, '2017-09-18 11:51:49'),
(123, 0, 55, 0, 25, 'Newly Built 3Bedroom Flat For Sale', 'sale', 2, 60000000, '7', 3, '4', '4', 6, 'residential', 'Tarred Road, Pave areas, green areas, borehole, Dedicated ransformer, Fitted Wadropes, heaters, bathtub', NULL, '60Million Per Unit\r\nDetails to be discussed with Agent/Owner	     ', '<p>This is a newly Built 3Bedroom Flat with 1Bedroom Guest Chalet all en suite</p>\r\n<p>Located at Jahi District of the Federl Capital Territory</p>\r\n<p>Facilities include Tarred Road, Pave Areas, Green Areas, Borehole, Dedicated Transformer, etc</p>\r\n<p>All Rooms come fitted with wadrobes, heaters and bathtubs.</p>', 1, '', 0, NULL, '2017-09-18 12:07:16'),
(124, 0, 55, 0, 26, '2 Bedroom Flat at katampe', 'rent', 2, 1000000, '7', 2, '2', '3', 6, 'residential', 'Dedicated Transformer, Central Generator, Cabinet, Store', NULL, '  	     ', '<p>A neat 2 Bedroom Flat at Katampe District of the Federal Capital Territory, Tipper garage after Minister hill</p>\r\n<p>It has 3 Toilets, has kitchen cabinet, store and sitting room.</p>\r\n<p>Serviced with Central Generator and Dedicated transformer.</p>\r\n<p>Price: 1Million(Negotiable)</p>\r\n<p>Agency and Legal Fees applies</p>', 1, '', 300000, NULL, '2017-09-18 12:25:44'),
(125, 0, 55, 0, 25, '3 bedroom Flat at Jahi', 'rent', 2, 1600000, '7', 3, '', '4', 6, 'residential', 'Massive Kitchen, Cabinet and store', NULL, '  	     ', '<p>A New and Preciously built 3 Bedroom Flat at Jahi with all room en suite&nbsp;</p>\r\n<p>It has spacious sitting room with dinning, visitors toilet, massive kitchen with cabinet and store</p>\r\n<p>Legal Fees applies</p>', 1, '160000', 300000, NULL, '2017-09-18 12:55:19'),
(126, 0, 55, 0, 25, '3 Bedroom Serviced Flat at Jahi', 'rent', 2, 3000000, '8', 3, '', '4', 6, 'residential', 'Central Generator, AC, Dedicated transformer, Electric Fence', NULL, '  	     ', '<p>This is a Newly Built and serviced 3Bedroom flat with 4toilets all en suite with bathtubs except children room.</p>\r\n<p>It is serviced with central generator and AC, Dedicated transformer, Electric Fence, etc</p>\r\n<p>3million Per Annum includes service charge</p>\r\n<p>Agency and Legal Fees apply</p>\r\n<p>Just Pay and Move In</p>', 1, '', 0, NULL, '2017-09-18 13:16:07'),
(127, 0, 58, 0, 7, 'OFFER OF ONE BEDROOM FLAT FOR SALE', 'sale', 2, 10000000, NULL, 1, NULL, NULL, NULL, 'residential', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2017-09-21 12:48:22'),
(128, 0, 53, 0, 10, '11Units of one bedroom flat and 5 Shops at Mararaba, Abuja', 'sale', 2, 30000000, '11', 11, '11', '11', 6, 'residential', '', 'Water Board', '  	     ', '<p>11 units of 1 bedroom flat in a spacious compound. Each unit is en-suite and has its own balcony, kitchen, parlor, and a spacious bedroom. This property has its own gate and also have 5 shops attached to it from the outside. The owner wants to sell this property in order to complete a project at his home town. The rooms are spacious and Each unit is being rented at N120,000.00 (One hundred - twenty thousand naira only).</p>\r\n<p>Therefore: N120,000.00 X 11 = N1,320.000.00 (One million - three hundred thousand - twenty thousand only) While each of the five (5) shops are rented out at N70,000.00 (Seventy thousand naira only).</p>\r\n<p>Therefore:</p>\r\n<p>N70,000.00 X 5 = N350,000.00 (Three hundred - fifty thousand naira only)</p>\r\n<p>&nbsp;</p>\r\n<p>Total = N1,320.000.00 + N350,000.00 = N1,670.000.00 Yearly rent</p>\r\n<p>(One million-six hundred thousand-seventy thousand naira only)</p>\r\n<p>&nbsp;</p>\r\n<p><strong>LOCATION</strong></p>\r\n<p>This property is located at: House No. 10, Tudun wada, behind Zamfara Mosque, Off Nyanya Keffi Express Road (through <strong>Royal Dream Hotel</strong>), Mararaba.</p>\r\n<p>Don&rsquo;t miss this lucrative investment opportunity!</p>\r\n<p>&nbsp;</p>\r\n<p><strong>FOR MORE INFORMATION &amp; INSPECTION PLEASE CONTACT US</strong></p>\r\n<p><strong>Phone:</strong> +234-9098756825 or +234-7033385434</p>\r\n<p>Office: Suite D86/90, Efab Shopping Mall, Area11, Garki-Abuja</p>\r\n<p><strong>Email:</strong><a href="mailto:prometheussolutions1@gmail.com">prometheussolutions1@gmail.com</a></p>\r\n<p><strong>Website:</strong> www.prometheusrealty.com</p>\r\n<p><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong></p>\r\n<p><strong>RC: 2434487</strong></p>\r\n<p><strong>PROMETHEUS LIMITED</strong></p>\r\n<p><em>Your Real Estate Solutions&hellip;</em></p>', 1, '5', 0, NULL, '2017-10-01 15:36:32'),
(129, 0, 53, 0, 4, ': Appealing 4-Bedroom Carcass Duplex & 2-Bedrooms BQ at Ipent 7 Estate, Gwarinpa-FCT Abuja', 'sale', 10, 35000000, NULL, 4, NULL, NULL, NULL, 'residential', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2017-10-01 16:02:11'),
(130, 0, 53, 0, 4, 'Executive 9 Bedroom Duplex at Citec Villa-Gwarinpa, FCT-Abuja', 'sale', 10, 250000000, '9', 9, '9', '9', 7, 'residential', '', 'Bore Hole', '  	     ', '<p>An appealing 9 bedroom duplex in an alluring environment of Citec Villa, Gwarinpa estate.</p>\r\n<p>The ground floor has three (3) parlours and a toilet for guest. The ground floor also has three (3) bedrooms (all rooms en-suite) and a Dinning area.</p>\r\n<p>Upstairs, has up to six (6) very spacious bedrooms (all rooms are en-suite with shower cubicle and Jacuzzi) each room has a dressing/clothing area and some has a balcony (including Mater&rsquo;s bedroom).</p>\r\n<p>The whole duplex is painted with dulux paints with POP and pillars and the owner of this property wants to sell this house with all the furniture if you are interested and if u are not, then you can buy it without the furniture at a lesser price. Below is the feature of the house:</p>\r\n<p>The duplex as a two (2) bedroom chalet, security house, an outside bar, laundry room, a skylight, spilt A.C, big generator, LCD screen, chairs, overhead tank &amp; borehole, central water heater, a car port, electric wire fence, a built-in sound system among others.</p>\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>\r\n<p><strong>LOCATIONS</strong></p>\r\n<p>The Duplex is situated at: House No. 805D, 444 Crescent, off 4<sup>th</sup> Avenue, Gwarinpa Estate, FCT Abuja-Nigeria.</p>\r\n<p>&nbsp;</p>\r\n<p>Marketed By PROMETHEUS SOLUTIONS&hellip;</p>\r\n<p><strong>FOR MORE INFORMATION PLEASE CONTACT US</strong></p>\r\n<p><strong>Phone:</strong> +234-9098756825 or +234-7033385434</p>\r\n<p><strong>Office: </strong>Suite D86/90, Efab Shopping Mall, Area11, Garki-Abuja.</p>\r\n<p><strong>Email:</strong><a href="mailto:prometheussolutions1@gmail.com">prometheussolutions1@gmail.com</a></p>\r\n<p><strong>Website:</strong> www.prometheusrealty.com</p>\r\n<p><strong>Corporate Head Office:</strong> Suite D86/90, Efab Shopping Mall Extension, opp. FCDA, Area11, Garki-Abuja.&nbsp;</p>\r\n<p><strong>&nbsp;</strong></p>\r\n<p><strong>RC: 2434487</strong></p>\r\n<p><strong>PROMETHEUS LIMITED</strong></p>\r\n<p><em>Your Real Estate Solutions&hellip;</em></p>\r\n<p>&nbsp;</p>', 1, '5', 0, NULL, '2017-10-01 16:07:44'),
(131, 0, 53, 0, 4, 'A 6-Bedroom Carcass Duplex & 2-Bedrooms BQ at Ipent 7 Estate, Gwarinpa-FCT Abuja', 'sale', 10, 75000000, NULL, 6, NULL, NULL, NULL, 'residential', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2017-10-01 16:46:57'),
(132, 0, 56, 0, 26, 'Regent Service Apartments', 'sale', 6, 29000000, '9', 3, '3', '4', 6, 'residential', 'Private Parking and a General Car Parking; Laundry, Gym, Children’s Play Ground', NULL, 'N29,000,000 (Lumpsum)\r\n\r\n* Initial Installment\r\n30%: N8,700,000\r\n* Second Installment\r\n30%: N8,700,000\r\n* Third Installment\r\n20%: N5,800,000\r\n* Forth Installment\r\n20%: N5,800,000', '<p>Beautifully and Functionally designed 3 Bedroom Block of Flats</p>\r\n<p>All rooms ensuite with high quality bathroom Fittings</p>\r\n<ul>\r\n<li>An Exquisite Living<br />R o o m , K i t c h e n ,<br />Store and Guest<br />Toilet</li>\r\n<li>Private Parking</li>\r\n<li>General Parking</li>\r\n<li>Gym + Laundry</li>\r\n<li>Children&rsquo;s Play<br />Ground</li>\r\n<li>Services</li>\r\n<li>Security.</li>\r\n</ul>', 1, '', 0, NULL, '2017-10-01 19:35:59'),
(133, 0, 53, 0, 9, 'Lounge for sale, Kuje-Abuja', 'sale', 9, 120000000, '10', 6, '6', '6', 7, 'commercial', 'Other features include:      Generator house     2 borehole     Store for drinks     An office with two rooms inside     A staff toilet     A customers toilet     3 very big store rooms which can be converted to 6 large rooms     Just to mention few', 'Bore Hole', '  	     ', '<p>A beautiful lounge for sale in a private environment of Kuje. The lounge has a very large compound that can take more than 12 cars; it has a fish pond &amp; Suya section and a security room by the entrance. This lounge also has a restaurant and kitchen. This lounge has a modern grill bar, a very large event hall with more than 500 seats with a flaming and decoration. Just by the side, there is a 3bedroom flat with 4 toilets with a Jacuzzi, kitchen, parlor and a dinning area.</p>\r\n<p>There is also a smoothie bar just by the left hand and another bar with 54 seats and 20 tables.</p>\r\n<p>Other features include:</p>\r\n<ul>\r\n<li>Generator house</li>\r\n<li>2 borehole</li>\r\n<li>Store for drinks</li>\r\n<li>An office with two rooms inside</li>\r\n<li>A staff toilet</li>\r\n<li>A customers toilet</li>\r\n<li>3 very big store rooms which can be converted to 6 large rooms</li>\r\n<li>Just to mention few</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p>Location: No, 6, Pashion street, opp. Union Homes, Kuchiyako Layout, Kuje-FCT Abuja.</p>\r\n<p>This is a good deal as the lounge is presently functional. Please contact me as soon as possible&hellip; dnt miss this investment opportunity I&rsquo;m telling this as a real estate consultant with more than 10 years of experience.</p>\r\n<p>&nbsp;</p>\r\n<p>Marketed By PROMETHEUS SOLUTIONS&hellip;</p>\r\n<p><strong>FOR MORE INFORMATION PLEASE CONTACT US</strong></p>\r\n<p><strong>Phone:</strong> +234-9098756825 or +234-7033385434</p>\r\n<p><strong>Office: </strong>Suite D86/90, Efab Shopping Mall, Area11, Garki-Abuja.</p>\r\n<p><strong>Email:</strong><a href="mailto:prometheussolutions1@gmail.com">prometheussolutions1@gmail.com</a></p>\r\n<p><strong>Website:</strong> www.prometheusrealty.com</p>\r\n<p><strong>Corporate Head Office:</strong> Suite D86/90, Efab Shopping Mall Extension, opp. FCDA, Area11, Garki-Abuja.</p>\r\n<p><strong>&nbsp;</strong></p>\r\n<p><strong>RC: 2434487</strong></p>\r\n<p><strong>PROMETHEUS SOLUTIONS LIMITED</strong></p>\r\n<p><em>Your Real Estate Solutions&hellip;</em></p>', 1, '5', 0, NULL, '2017-10-03 09:55:30'),
(134, 0, 53, 0, 24, 'Distress sale!!! 6bedrooms fully Detached Carcass Duplex in Gaduwa', 'sale', 10, 25000000, '6', 6, '5', '5', 6, 'residential', '', 'Water Board', '  	     ', '<p>A delightful 6bedrroms fully detached carcass duplex with a big space for BQ in a mini estate at Gaduwa. According to the architectural design of this building, all rooms are en-suit and it has a large parlor, a dining area, kitchen and store.</p>\r\n<p>All infrastructural fees have been paid for and the documents are intact.</p>\r\n<p>The estate is known as DOLZ BROWN ESTATE, it&rsquo;s a mini and quite estate with not more than 34 houses and the estate is 90% occupied just behind Ipent 6 estate (Legislative Villa) at Gaduwa District, Abuja.</p>\r\n<p>LOCATIONS: This property is situated at No. 44, Alikum Street, DOLIZ BROWN ESTATE, Gaduwa,FCT-Abuja.</p>\r\n<p>&nbsp;</p>\r\n<p>Marketed By PROMETHEUS SOLUTIONS&hellip;</p>\r\n<p><strong>FOR MORE INFORMATION PLEASE CONTACT US</strong></p>\r\n<p><strong>Phone:</strong> +234-9098756825 or +234-7033385434</p>\r\n<p><strong>Office: </strong>Suite D86/90, Efab Shopping Mall, Area11, Garki-Abuja.</p>\r\n<p><strong>Email:</strong><a href="mailto:prometheussolutions1@gmail.com">prometheussolutions1@gmail.com</a></p>\r\n<p><strong>Website:</strong> www.prometheusrealty.com</p>\r\n<p><strong>Corporate Head Office:</strong> Suite D86/90, Efab Shopping Mall Extension, opp. FCDA, Area11, Garki-Abuja.</p>\r\n<p><strong>&nbsp;</strong></p>\r\n<p><strong>RC: 2434487</strong></p>\r\n<p><strong>PROMETHEUS LIMITED</strong></p>\r\n<p><em>Your Real Estate Solutions&hellip;</em></p>', 1, '5', 0, NULL, '2017-10-03 10:26:17'),
(135, 0, 53, 0, 22, 'A 4-bedrooms Semi-Detached Duplex with BQin a Mini Estate, Wuye', 'sale', 7, 45000000, NULL, 4, NULL, NULL, NULL, 'residential', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2017-10-03 10:49:29'),
(136, 0, 53, 0, 20, 'A Two Wings Uncompleted Duplex, Kado, FCT Abuja', 'sale', 7, 60000000, '6', 6, '6', '6', 6, 'residential', '', 'Bore Hole', '  	     ', '<p>This duplex is divided into two. The first wing upstairs has a specious 3 bedrooms (all rooms are en-suite) and a parlor, while down stairs has a very big parlor, kitchen, store, dinning area, visitor&rsquo;s toilet, and a room (en-suite).</p>\r\n<p>The second wing upstairs has two bedrooms (all rooms are en-suite) while down stairs has parlor, visitors toilet, kitchen, and a store.</p>\r\n<p>This structure is on a land big enough to pack from 8-10 cars. There is a security house by the entrance.</p>\r\n<p>Therefore, the property has: 6 rooms and 7 toilets</p>\r\n<p>LOCATIONS: This property is situated at No. 9, Ajumgobia F.I.A Close, opposite Corn Oil, Kado Estate-FCT Abuja.</p>\r\n<p>&nbsp;</p>\r\n<p>Marketed by PROMETHEUS SOLUTIONS&hellip;</p>\r\n<p><strong>FOR MORE INFORMATION PLEASE CONTACT US</strong></p>\r\n<p><strong>Phone:</strong> +234-9098756825 or +234-7033385434</p>\r\n<p><strong>Office: </strong>Suite D86/90, Efab Shopping Mall, Area11, Garki-Abuja.</p>\r\n<p><strong>Email:</strong><a href="mailto:prometheussolutions1@gmail.com">prometheussolutions1@gmail.com</a></p>\r\n<p><strong>Website:</strong> www.prometheusrealty.com</p>\r\n<p><strong>&nbsp;</strong></p>\r\n<p><strong>RC: 2434487</strong></p>\r\n<p><strong>PROMETHEUS LIMITED</strong></p>\r\n<p><em>Your Real Estate Solutions&hellip;</em></p>', 1, '5', 0, NULL, '2017-10-03 10:54:14'),
(137, 0, 53, 0, 12, 'A newly renovated 3-bedrooms Terrace Duplex with 2-bedrooms BQ, Wuse II-Abuja', 'sale', 11, 80000000, '5', 3, '4', '3', 6, 'residential', '', 'Bore Hole', '  	     ', '<p>This is a corner piece terrace duplex that is located in the heart of town with just few meters away from Wuse market and central area. The terrace was just renovated, it has 3-bedrooms (all rooms are en-suite) and a detached 2-bedroom BQ and a space for garden behind it.</p>\r\n<p>Location: No. 15 A, ECDA Quarters, off Ibrahim Hashim Street, Wuse-FCT Abuja.</p>\r\n<p>Marketed by PROMETHEUS SOLUTIONS&hellip;</p>\r\n<p><strong>FOR MORE INFORMATION PLEASE CONTACT US</strong></p>\r\n<p><strong>Phone:</strong> +234-9098756825 or +234-7033385434</p>\r\n<p><strong>Office: </strong>Suite D86/90, Efab Shopping Mall, Area11, Garki-Abuja.</p>\r\n<p><strong>Email:</strong><a href="mailto:prometheussolutions1@gmail.com">prometheussolutions1@gmail.com</a></p>\r\n<p><strong>Website:</strong> www.prometheusrealty.com</p>\r\n<p><strong>&nbsp;</strong></p>\r\n<p><strong>RC: 2434487</strong></p>\r\n<p><strong>PROMETHEUS SOLUTIONS</strong></p>\r\n<p><em>Your Real Estate Solutions&hellip;</em></p>', 1, '5', 0, NULL, '2017-10-05 08:58:18'),
(142, 4, 53, 0, 4, '3 Bedroom Terrace Duplex', 'sale', 11, 120000, NULL, 3, NULL, NULL, NULL, 'residential', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2017-10-30 23:12:38'),
(143, 0, 53, 0, 26, '4Bedroom Duplex', 'rent', 4, 1500000, NULL, 4, NULL, NULL, NULL, 'residential', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2017-11-01 09:07:10');

-- --------------------------------------------------------

--
-- Table structure for table `house_comments`
--

DROP TABLE IF EXISTS `house_comments`;
CREATE TABLE IF NOT EXISTS `house_comments` (
  `house_comment_id` int(255) NOT NULL,
  `house_id` int(2) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `house_facilities`
--

DROP TABLE IF EXISTS `house_facilities`;
CREATE TABLE IF NOT EXISTS `house_facilities` (
  `facility_id` bigint(255) NOT NULL,
  `facility` varchar(255) NOT NULL,
  `house_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `house_group`
--

DROP TABLE IF EXISTS `house_group`;
CREATE TABLE IF NOT EXISTS `house_group` (
  `group_id` int(255) NOT NULL,
  `group` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `house_traffic`
--

DROP TABLE IF EXISTS `house_traffic`;
CREATE TABLE IF NOT EXISTS `house_traffic` (
  `traffic_id` int(255) NOT NULL,
  `viewer_id` int(255) DEFAULT NULL,
  `house_id` int(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `house_types`
--

DROP TABLE IF EXISTS `house_types`;
CREATE TABLE IF NOT EXISTS `house_types` (
  `house_type_id` int(255) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `house_types`
--

INSERT INTO `house_types` (`house_type_id`, `type`) VALUES
(1, 'Self-Contain'),
(2, 'Flat'),
(3, 'Bungalow Duplex'),
(4, 'Duplex'),
(5, 'Semi-detached Bungalow'),
(6, 'Service Apartment'),
(7, 'Semi-detached Duplex'),
(8, 'Fully-detached Bungalow'),
(9, 'Fully-detached Bungalow'),
(10, 'Fully-detached Duplex'),
(11, 'Terrace Duplex'),
(12, 'office');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `like_id` bigint(255) NOT NULL,
  `realtor_id` int(255) NOT NULL,
  `type_id` int(255) NOT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'house',
  `liked_at` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`like_id`, `realtor_id`, `type_id`, `type`, `liked_at`) VALUES
(10, 53, 113, 'house', 1502881967),
(11, 53, 106, 'house', 1502882102),
(12, 53, 105, 'house', 1502882302);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
CREATE TABLE IF NOT EXISTS `locations` (
  `location_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`location_id`, `name`) VALUES
(1, 'Apo'),
(2, 'Bwari'),
(3, 'Garki'),
(4, 'Gwarimpa'),
(5, 'Jabi'),
(6, 'Kado'),
(7, 'Kubwa'),
(8, 'Life Camp'),
(9, 'Lugbe'),
(10, 'Mararaba'),
(11, 'Nyanya'),
(12, 'Wuse'),
(13, 'Garki II'),
(14, 'Utako'),
(16, 'Wuse 2'),
(17, 'Maitama'),
(18, 'Asokoro'),
(19, 'Idu'),
(20, 'Kado'),
(21, 'Bwari'),
(22, 'Wuye'),
(23, 'Mabuishi'),
(24, 'Galadimawa'),
(25, 'Jahi'),
(26, 'Katampe');

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
  `message_id` int(255) NOT NULL,
  `sender_id` bigint(20) DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `receiver_id` bigint(20) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `related` varchar(10) DEFAULT NULL,
  `related_id` bigint(255) DEFAULT NULL,
  `sent_at` int(255) DEFAULT NULL,
  `received_at` int(255) DEFAULT NULL,
  `read` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Table structure for table `photos`
--

DROP TABLE IF EXISTS `photos`;
CREATE TABLE IF NOT EXISTS `photos` (
  `photo_id` int(255) NOT NULL AUTO_INCREMENT,
  `target_id` int(255) NOT NULL,
  `target` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `main` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`photo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=281 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`photo_id`, `target_id`, `target`, `photo`, `title`, `main`) VALUES
(106, 99, 'house', '39104152_46977-brand-new-4-bedroom-duplex-with-bq-for-rent-in-semi-detached-duplexes-for-rent--jabi-abuja-nigeria.jpg', 'Front View', 0),
(107, 99, 'house', 'kitchen.jpg', 'Kitchen', 0),
(108, 100, 'house', '5jungle_hotel_dubai.JPG', 'house 1', 0),
(109, 100, 'house', '1Dubai-Opera-House2.JPG', 'house 2', 0),
(110, 101, 'house', 'IMG_00001781.jpg', 'Gate', 0),
(111, 101, 'house', 'IMG_00001782.jpg', 'Front', 0),
(118, 106, 'house', 'IMG-20170605-WA0007.jpg', 'A front View', 0),
(119, 106, 'house', 'IMG-20170605-WA0004.jpg', 'Kitchen', 0),
(120, 106, 'house', 'IMG-20170605-WA0006.jpg', 'Sitting room', 0),
(121, 106, 'house', 'IMG-20170605-WA0010.jpg', 'Compound', 0),
(122, 1, 'estate', '4bedroomterraceduplexwithbq.jpg', '4bedroom terrace', 1),
(123, 1, 'estate', '3BedroomSemi-detachedBungalowwithBQ.jpg', '3 bedroom semidetached', 0),
(124, 1, 'estate', '5bedroomfullydetachedduplexwithBQ-TypeB.jpg', '5 bedroom fully detached', 0),
(125, 1, 'estate', '4bedroomfullydetachedduplexwithBQ-TypeA.jpg', '4 bedroom duplex fully detached', 0),
(126, 107, 'house', '4_bedrooms_detached.jpg', '4 bedroom duplex', 0),
(127, 2, 'estate', '3_bedroom_semi-detached.jpg', '3_bedroom_semi-detached', 0),
(128, 108, 'house', '3BedroomSemi-detachedBungalowwithBQ.jpg', 'Architectural View', 0),
(129, 109, 'house', '4bedroomterraceduplexwithbq.jpg', 'Architectural View', 0),
(130, 110, 'house', '5bedroomfullydetachedduplexwithBQ-TypeB.jpg', 'Architectural View', 0),
(131, 111, 'house', '20161021_151230.jpg', 'asdasd', 0),
(132, 111, 'house', 'images.jpg', 'asdasd', 0),
(133, 112, 'house', 'IMG_20161026_150118.jpg', 'Carcass level', 0),
(134, 113, 'house', 'IMG-20170703-WA0008.jpg', 'Front View', 0),
(135, 113, 'house', 'FrontView.jpg', 'Front Entrance', 0),
(136, 113, 'house', 'Kitchen-1.jpg', 'Kitchen', 0),
(137, 113, 'house', 'Bedroom.jpg', 'Sitting Room', 0),
(138, 113, 'house', 'Bathroom.jpg', 'Bathroom', 0),
(139, 114, 'house', 'IMG-20170726-WA0010.jpg', 'Front view', 0),
(140, 114, 'house', 'IMG-20170726-WA0006.jpg', 'Kitchen', 0),
(141, 114, 'house', 'IMG-20170726-WA0008.jpg', 'Bathroom', 0),
(142, 2, 'estate', 'Slide1.JPG', 'Distress!! 5 bedrooms Duplex with 2 bedrroms BQ and a Pent house, at legislative VIlla, Gaduwa -Abuja', 0),
(143, 115, 'house', 'IMG-20170822-WA0004.jpg', 'Front View ', 0),
(144, 115, 'house', 'IMG-20170822-WA0006.jpg', 'Neighborhood view ', 0),
(145, 115, 'house', 'IMG-20170822-WA0005.jpg', 'Backyard', 0),
(146, 115, 'house', 'IMG-20170822-WA0003.jpg', 'Parlor', 0),
(147, 115, 'house', 'IMG-20170822-WA0002.jpg', 'Kitchen ', 0),
(148, 115, 'house', 'IMG-20170822-WA0001.jpg', 'Restroom', 0),
(150, 118, 'house', 'IMG-20170601-WA0003.jpg', 'Front View', 0),
(151, 118, 'house', 'IMG-20170601-WA0005.jpg', 'Sitting Room', 0),
(152, 118, 'house', 'IMG-20170601-WA0007.jpg', 'Bedroom', 0),
(153, 118, 'house', 'IMG-20170601-WA0004.jpg', 'Kitchen', 0),
(154, 119, 'house', 'Slide1.JPG', 'Front view', 0),
(155, 119, 'house', 'Slide3.JPG', 'Compound', 0),
(156, 119, 'house', 'Slide12.JPG', 'BQ', 0),
(157, 119, 'house', 'Slide6.JPG', 'Parlor', 0),
(158, 119, 'house', 'Slide15.JPG', 'Environment', 0),
(159, 120, 'house', 'YayaleEstate.jpg', 'FOR SALE', 0),
(160, 121, 'house', 'IMG-20170918-WA0007.jpg', 'Front View', 0),
(161, 122, 'house', 'IMG-20170918-WA0007.jpg', 'Outside View', 0),
(162, 122, 'house', 'IMG-20170918-WA0012.jpg', 'Front View', 0),
(163, 122, 'house', 'IMG-20170918-WA0015.jpg', 'Parlor', 0),
(164, 122, 'house', 'IMG-20170918-WA0014.jpg', 'Kitchen', 0),
(165, 122, 'house', 'IMG-20170918-WA0011.jpg', 'Bedroom', 0),
(166, 122, 'house', 'IMG-20170918-WA0002.jpg', 'Bedroom', 0),
(167, 122, 'house', 'IMG-20170918-WA0006.jpg', 'Wadrobe', 0),
(168, 122, 'house', 'IMG-20170918-WA0003.jpg', 'Toilet', 0),
(169, 122, 'house', 'IMG-20170918-WA0001.jpg', 'Toilet', 0),
(170, 122, 'house', 'IMG-20170918-WA0009.jpg', 'Front Gate', 0),
(171, 123, 'house', 'IMG-20170918-WA0017.jpg', 'Compound View', 0),
(172, 123, 'house', 'IMG-20170918-WA0021.jpg', 'Sitting Room', 0),
(173, 123, 'house', 'IMG-20170918-WA0022.jpg', 'Kitchen', 0),
(174, 123, 'house', 'IMG-20170918-WA0025.jpg', 'Bedroom Wadrobe', 0),
(175, 123, 'house', 'IMG-20170918-WA0019.jpg', 'Rest Room', 0),
(176, 124, 'house', 'IMG-20170918-WA0037.jpg', 'Sitting Room', 0),
(177, 124, 'house', 'IMG-20170918-WA0031.jpg', 'Kitchen', 0),
(178, 124, 'house', 'IMG-20170918-WA0038.jpg', 'Corridor', 0),
(179, 124, 'house', 'IMG-20170918-WA0034.jpg', 'Bathroom', 0),
(180, 124, 'house', 'IMG-20170918-WA0029.jpg', 'Generator Set', 0),
(181, 124, 'house', 'IMG-20170918-WA0030.jpg', '', 0),
(182, 125, 'house', 'IMG-20170918-WA0044.jpg', 'Front View', 0),
(183, 125, 'house', 'IMG-20170918-WA0046.jpg', 'Bathroom', 0),
(184, 125, 'house', 'IMG-20170918-WA0039.jpg', 'Bedroom', 0),
(185, 125, 'house', 'IMG-20170918-WA0042.jpg', 'Sitting Room', 0),
(186, 125, 'house', 'IMG-20170918-WA0047.jpg', 'Untitled', 0),
(187, 126, 'house', 'IMG-20170918-WA0049.jpg', 'Front View', 0),
(188, 126, 'house', 'IMG-20170918-WA0050.jpg', 'Untitled', 0),
(189, 126, 'house', 'IMG-20170918-WA0048.jpg', 'Untitled', 0),
(190, 117, 'house', 'IMG-20170918-WA0060.jpg', '', 0),
(191, 117, 'house', 'IMG-20170918-WA0061.jpg', '', 0),
(192, 117, 'house', 'IMG-20170918-WA0062.jpg', '', 0),
(193, 117, 'house', 'IMG-20170918-WA0063.jpg', '', 0),
(194, 117, 'house', 'IMG-20170918-WA0064.jpg', '', 0),
(195, 117, 'house', 'IMG-20170918-WA0070.jpg', '', 0),
(196, 127, 'house', 'BricksCity9.jpg', 'FOR SALE', 0),
(197, 127, 'house', 'BricksCity1.jpg', 'Front View ', 1),
(198, 127, 'house', 'BricksCity3.jpg', 'Bedroom Toilet ', 0),
(199, 127, 'house', 'BricksCity7.jpg', 'Visitors Toilet ', 0),
(200, 127, 'house', 'BricksCity6.jpg', 'Sitting Room View ', 1),
(201, 127, 'house', 'BricksCity5.jpg', 'Bedroom View ', 0),
(202, 3, 'estate', 'Slide1.JPG', 'Plot', 0),
(203, 3, 'estate', 'Slide2.JPG', 'Second Plot', 0),
(204, 3, 'estate', 'Slide3.JPG', 'Road by left', 0),
(205, 3, 'estate', 'Slide4.JPG', 'Road by right', 0),
(206, 3, 'estate', 'Slide5.JPG', 'Nieghboorhood', 0),
(207, 3, 'estate', 'GoogleMap.JPG', 'Road map', 0),
(208, 3, 'estate', 'realestatesolutions.jpg', 'Prometheus Solutions', 0),
(209, 128, 'house', 'Slide1.JPG', 'Compound', 0),
(210, 128, 'house', 'Slide2.JPG', 'Flat 1', 0),
(211, 128, 'house', 'Slide3.JPG', 'Compound ', 0),
(212, 128, 'house', 'Slide5.JPG', 'Shops', 0),
(213, 128, 'house', 'WORK.jpg', 'Prometheus Solutions', 0),
(214, 4, 'estate', 'Slide1.JPG', 'Carcass', 0),
(215, 4, 'estate', 'Slide2.JPG', 'Compound', 0),
(216, 4, 'estate', 'Slide3.JPG', 'Side compound', 0),
(217, 4, 'estate', 'Slide4.JPG', 'BQ', 0),
(218, 4, 'estate', 'Slide5.JPG', 'Tarred Road by right', 0),
(219, 4, 'estate', 'Ipent7Estate.jpg', 'Road map', 0),
(220, 4, 'estate', 'WORK.jpg', 'Prometheus Solutions', 0),
(221, 129, 'house', 'Slide1.JPG', 'Front view', 0),
(222, 129, 'house', 'Slide2.JPG', 'Compound', 0),
(223, 129, 'house', 'Slide4.JPG', 'BQ', 0),
(224, 129, 'house', 'Ipent7Estate.jpg', 'Road map', 0),
(225, 129, 'house', 'WORK.jpg', 'Prometheus Solutions', 0),
(226, 130, 'house', 'Slide1.JPG', 'Untitled', 0),
(227, 130, 'house', 'Slide3.JPG', 'Untitled', 0),
(228, 130, 'house', 'Slide4.JPG', 'Untitled', 0),
(229, 130, 'house', 'Slide7.JPG', 'Untitled', 0),
(230, 130, 'house', 'WORK.jpg', 'Untitled', 0),
(231, 131, 'house', 'Slide1.JPG', 'Front view', 0),
(232, 131, 'house', 'Slide3.JPG', 'Compound', 0),
(233, 131, 'house', 'Slide7.JPG', 'inside', 0),
(234, 131, 'house', 'Slide6.JPG', 'BQ', 0),
(235, 131, 'house', 'Ipent7Estate.jpg', 'Road map', 0),
(236, 132, 'house', 'img.jpg', 'Front View Plan', 0),
(237, 132, 'house', 'IMG_3948.JPG', '', 0),
(238, 132, 'house', 'IMG_3949.JPG', '', 1),
(239, 132, 'house', 'IMG_3950.JPG', '', 0),
(240, 132, 'house', 'IMG_3951.JPG', '', 0),
(241, 132, 'house', 'IMG_3952.JPG', '', 0),
(242, 133, 'house', 'Slide2.JPG', 'Front view', 0),
(243, 133, 'house', 'Slide4.JPG', 'Compound', 0),
(244, 133, 'house', 'Slide5.JPG', 'Side compound', 0),
(245, 133, 'house', 'Slide7.JPG', 'Fish spot', 0),
(246, 133, 'house', 'Slide8.JPG', 'Security house', 0),
(247, 133, 'house', 'Slide10.JPG', 'Restaurant', 0),
(248, 133, 'house', 'Slide11.JPG', 'Lodge', 0),
(249, 133, 'house', 'Slide12.JPG', 'Sitting room', 0),
(250, 133, 'house', 'Slide13.JPG', 'Smoothy spot', 0),
(251, 133, 'house', 'Slide14.JPG', 'Bar ', 0),
(252, 133, 'house', 'Slide15.JPG', 'Inside bar', 0),
(253, 133, 'house', 'Slide17.JPG', 'Inside bar', 0),
(254, 133, 'house', 'Slide18.JPG', 'Sides', 0),
(255, 133, 'house', 'Slide19.JPG', 'reception', 0),
(256, 134, 'house', 'Slide1.JPG', 'Front view', 0),
(257, 134, 'house', 'Slide2.JPG', 'Street', 0),
(258, 134, 'house', 'Slide3.JPG', 'Back side', 0),
(259, 134, 'house', 'Slide4.JPG', 'Back side', 0),
(260, 134, 'house', 'Slide5.JPG', 'Public swimming pool', 0),
(261, 135, 'house', 'Slide1.JPG', 'Front view', 0),
(262, 135, 'house', 'Slide2.JPG', 'Side view', 0),
(263, 135, 'house', 'Slide3.JPG', 'Mini estate', 0),
(264, 135, 'house', 'Slide6.JPG', 'Up view', 0),
(265, 135, 'house', 'Slide4.JPG', 'Up view', 0),
(266, 136, 'house', 'Slide1.JPG', 'Front view', 0),
(267, 136, 'house', 'Slide3.JPG', 'Side view', 0),
(268, 136, 'house', 'Slide5.JPG', 'Compound', 0),
(269, 136, 'house', 'Slide10.JPG', 'Inside', 0),
(270, 136, 'house', 'Slide11.JPG', 'Untitled', 0),
(271, 137, 'house', 'Slide1.JPG', 'Front view', 0),
(272, 137, 'house', 'Slide5.JPG', 'back side', 0),
(273, 137, 'house', 'Slide6.JPG', 'back side', 0),
(274, 137, 'house', 'Slide4.JPG', 'BQ', 0),
(275, 137, 'house', 'Slide9.JPG', 'Palor', 0),
(276, 137, 'house', 'Slide10.JPG', 'Kitchen', 0),
(277, 137, 'house', 'Slide15.JPG', 'Room', 0),
(278, 137, 'house', 'Slide14.JPG', 'Toilet', 0),
(279, 142, 'house', 'Slide5.JPG', 'Front View', 0),
(280, 143, 'house', 'Slide2.JPG', 'Untitled', 0);

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
(73, 'Obi Udeh & Co', 'Suite 51, God''s Own Plaza, No.4, Takum Street, Area 11, Garki, Abuja', NULL, NULL, 4, '2017-11-20 10:49:12', 'website', NULL),
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
  `realtor_id` int(255) NOT NULL AUTO_INCREMENT,
  `biz_name` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `profile_name` varchar(255) DEFAULT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(20) DEFAULT NULL,
  `parent_id` int(255) NOT NULL DEFAULT '0',
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
  PRIMARY KEY (`realtor_id`),
  UNIQUE KEY `realtor_id` (`realtor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `realtors`
--

INSERT INTO `realtors` (`realtor_id`, `biz_name`, `firstname`, `lastname`, `profile_name`, `profile_photo`, `password`, `type`, `parent_id`, `address`, `email`, `twitter`, `sec_question`, `sec_answer`, `pin`, `website`, `created`, `activated`, `verified`, `email_confirmation`, `visible`, `blocked`, `blocked_reason`) VALUES
(5, 'derek', 'Derek', 'Halims', 'derek', '5.jpg', '$2y$10$bpbxe3a4wwRUPeDbvHKf4eolffIvuJlpGO5c4dR7VlSSNAmJ2PvwC', 'agent', 0, NULL, 'derekhalims@gmail.com', NULL, 'Whats your nickname', 'derek', NULL, NULL, 1489787851, 1, 1, '1', 1, 0, NULL),
(6, 'Adron homes', 'Ajirotutu', 'Folashade', 'Bidemite', '6.jpg', '', 'agent', 0, NULL, 'Shadebidemi@gmail.com', NULL, 'My name', 'Shade', 'D8C29B5C', NULL, 149150435, 1, 0, '1', 1, 0, NULL),
(7, 'ADRON HOMES', 'JOSADE', 'ADEKUNLE', 'Jobanty', '7.jpg', '', 'agent', 0, NULL, 'herdey4u@gmail.com', NULL, 'my pet', 'lion', '', NULL, 1491600129, 1, 0, '1', 1, 0, NULL),
(29, NULL, 'Akachukwu', 'Aneke', 'Princeak', '29.jpg', '$2y$10$KRF3JH2qI9VTzDq4PtEtD.KI8PM4LhHsnZhFdVpDpM3aPqZ/.AkI6', 'agent', 0, '8 Charles Street Maitama Abuja', 'akalodave@gmail.com', 'daprinceak', 'My Favorite Color', 'Blue', '', NULL, 1492272068, 1, 0, '1', 1, 0, NULL),
(30, 'Emmy', 'Nnaemeka', 'Okoli', 'popsy', '30.jpg', '$2y$10$A7tSM5yTt4yNxHAnAjeEMexCpMM00Hdw2V5ajLFzkX22IlR5EQqja', 'agent', 0, '12 Adikpo Close 313 Road, FHA Kubwa', 'akalojob@gmail.com', NULL, 'my Nickname', 'Popsy', '', NULL, 1492365317, 1, 0, '1', 0, 0, NULL),
(34, 'hasadiq', 'abubakar sadiq', 'halilulah', 'abubakarsadiqhalilulah', '34.jpg', '$2y$10$4cadFyLgaz5zaNSivi2Li.hTMzrEE0tHu7hZ986K5hTa2Ws3K8.z6', 'agent', 0, 'NO. 43B 3rd avenue junction, Gwarinpa, Abuja', 'hasadiq42009@yahoo.com', NULL, 'what is my name', 'sadiq', '', NULL, 1493291978, 1, 0, '1', 1, 0, NULL),
(35, 'RealestNigeria', 'Emeka', 'Emeghebo', 'RealestNigeria', '35.jpg', '$2y$10$6MfUSQNz3/Pe1bObhcLpxezwq9JA3dw1IhhavfXm/dx9ntangl7Si', 'agent', 0, 'Behind Sabongari Police Station, Bwari Abuja', 'emesonreigns@gmail.com', NULL, 'Mother''s Name? ', 'Grace', '', NULL, 1493662836, 1, 0, '1', 1, 0, NULL),
(36, '', 'Okoli', 'Nnaemeka', 'Hexane', '36.jpg', '$2y$10$jzUbxu1yYdM0uzukf0LPhO4BNJxb4AwyQ.LVkF63E5IOI6q2G66YS', 'agent', 0, '29/11B Abakaliki Road', 'okolinnaemeka227@gmail.com', NULL, 'My nickname', 'Kacey', '', NULL, 1493921388, 1, 0, '1', 0, 0, NULL),
(40, 'NATURE PROPERTIES', 'NAATURE PROPERTIES', NULL, 'NATURE', NULL, '$2y$10$hleNHnWPo9Ph7gHyFEmmFebYNs6U0ZoyV11Hema72npRKm8Obnlfu', 'company', 0, 'Abuja', 'naturesystemsnigeria@gmail.com', NULL, NULL, NULL, NULL, NULL, 1496614804, 1, 0, '1', 1, 0, NULL),
(41, 'Pirotti Projects Limited', NULL, NULL, 'PALMS', NULL, '$2y$10$IbhcRFUFBy/dJYgQnrz2JuONhoidDgSqAEAp6W898D1OFy/OuKLjS', 'company', 0, NULL, 'femiadebodun@gmail.com', NULL, NULL, NULL, NULL, NULL, 1497443922, 1, 0, '1', 1, 0, NULL),
(42, 'A&G Estate Development', NULL, NULL, 'A&G', 'AGLogo.jpg', '$2y$10$aIaeitep2wfT5hJYaB1NsekyDi0kM6aYPNQl1x.Osum4rZtJNlaMS', 'company', 0, NULL, 'agestatedev@gmail.com', NULL, NULL, NULL, NULL, NULL, 1497508093, 1, 1, '1', 1, 0, NULL),
(43, 'ajebutter estate ltd', NULL, NULL, 'ajebo', NULL, '$2y$10$YWKS6LSeqEGEOdmqkmyCBOsxAieZW8ovSv8ibtjPTNdv9hsWM19Am', 'company', 0, NULL, 'ajebo@gmail.com', NULL, NULL, NULL, NULL, NULL, 1497631087, 1, 0, '1', 0, 0, NULL),
(45, 'Goldspot', 'Goldie', 'Ellanor', 'goldie', NULL, '$2y$10$GTPXeDMfxWoOE01lZwggfeYDOlY7a2xteBVaCkS43W.OdR9VE1q/C', 'agent', 0, NULL, 'goldie@gmail.com', NULL, NULL, NULL, NULL, NULL, 1497633657, 1, 0, '1', 0, 0, NULL),
(47, 'Alex Innovations', NULL, NULL, 'Alexinnovate', NULL, '$2y$10$7EtXnxet8jMnD1GTbjWqwuAKeat3TldUR84VDQEZNcEeIPDT03E/W', 'company', 0, NULL, 'emmyalexjnr@gmail.com', NULL, NULL, NULL, NULL, NULL, 1497797509, 1, 0, '1', 0, 0, NULL),
(48, '', 'BLESSING', 'EKELEME', 'BLESSING', NULL, '$2y$10$7.n96v6cgfsOHBZ6jzqop.N3bWsIsxfSZb9sS0hRaIt7Hjov8u/6e', 'agent', 0, NULL, 'blessing.obike@yahoo.com', NULL, NULL, NULL, NULL, NULL, 1498129843, 1, 0, '1', 0, 0, NULL),
(49, 'CNE Graphics Studio', 'Chuks', 'Ezeilo', 'CNE', 'images.jpg', '$2y$10$lV3ychCusGZHYYWAvkFvu.iSEVIu0mfm249amU3dAQovsTgLeZ2sK', 'agent', 0, NULL, 'chuksezeilo@gmail.com', NULL, NULL, NULL, NULL, NULL, 1498137890, 1, 0, '1', 0, 0, NULL),
(50, 'PLACES WITH SPACES PROPERTY CONSULTANCY', NULL, NULL, 'CONCEPT', 'IMG_20161113_083747.jpg', '$2y$10$mMy3f7BEjOOeS4pDsIXvPun4S5awQlifuauoPbRePhYmWQpnFHt8e', 'company', 0, NULL, 'chukzyconcept@gmail.com', NULL, NULL, NULL, NULL, NULL, 1498166073, 1, 0, '1', 1, 0, NULL),
(51, 'Larrykes', 'Larrykes', 'LarrykesGB', 'Larrykes', NULL, '$2y$10$wMuomDNM2O2JcMXIFgyLaeFzmF2ksXMBpWEjRPJoEy7MW10o5CrUi', 'agent', 0, NULL, 'ti.ne.d.o.l@artquery.info', NULL, NULL, NULL, NULL, NULL, 1500920893, 1, 0, '1', 0, 0, NULL),
(52, 'Chinelo Okeke building service', 'Chinelo', 'Okeke', 'Sweetestchi', NULL, '$2y$10$qIv6eX/jjMeCRwtasxCli.NE7axi3gVRaZRDe0ih4N9cqTsKmmz06', 'agent', 0, NULL, 'lovelyanyanwuchi@yahoo.com', NULL, NULL, NULL, NULL, NULL, 1501748113, 1, 0, '1', 1, 0, NULL),
(53, 'Prometheus Solutions', NULL, NULL, 'Abubakar', 'WORK.jpg', '$2y$10$cklwPOd3SsZ5Y1XIV.PNq.I3LYMiFosai1EJHJGr2bvm3jc/aWX.u', 'company', 0, 'Suite D86/90, Efab Shopping Mall, Area 11, Garki-Abuja', 'prometheussolutions1@gmail.com', NULL, NULL, NULL, NULL, NULL, 1502711943, 1, 1, '1', 1, 0, NULL),
(54, '', 'Usman', 'Danjuma', 'UsmanA', NULL, '$2y$10$XXmZzxBa65zJTUTHDrl0y.fcUY3jshD5Pd8KuSYEX3oQ2L3If9r2q', 'agent', 0, NULL, 'u.abdanj@gmail.com', NULL, NULL, NULL, NULL, NULL, 1504077903, 1, 1, '1', 1, 0, NULL),
(55, '', 'Idiege', 'Titus', 'Honesty', 'IMG_20170705_101652.jpg', '$2y$10$sDz.HGDa7q/cf2xWrhilNe.vCGbE96xhYYrP8mYL5u5Dtxe3tWoZS', 'agent', 0, NULL, 'proftesco931@gmail.com', NULL, NULL, NULL, NULL, NULL, 1504122167, 1, 1, '1', 1, 0, NULL),
(56, '', 'Abdussalam ', 'Farouk ', 'Abdussalamf', NULL, '$2y$10$7ep5Y2ZbLoBYkKyg0IXH9OUfIJ5Xk38NqMkeBwKmekwpElPdHUuZ2', 'agent', 0, NULL, 'abdulaminu001@yahoo.com', NULL, NULL, NULL, NULL, NULL, 1504510977, 1, 0, '1', 1, 0, NULL),
(58, 'Sylva Property ', 'Sylvanus ', 'Ingwu', 'SylvaRose', NULL, '$2y$10$qK6vkabtMEPv.fhA0C4ufeUWQZk5OSEmQ1qY.AijcoLGBqYMrmVyy', 'agent', 0, NULL, 'sylvarose11@gmail.com', NULL, NULL, NULL, NULL, NULL, 1505385707, 1, 1, '1', 1, 0, NULL),
(59, 'John John Estate management/Developer', 'Okere', 'James Onyewuchi ', 'JohnJohnEstateManagement/Developer', NULL, '$2y$10$iW3uwm5uD8SjYkrgjKGFCu4LPuQM3GrlIZ2XRPnW3BZwCvM1Os.Oq', 'agent', 0, NULL, 'jamesonyewuchiokere@gmail.com', NULL, NULL, NULL, NULL, NULL, 1506442902, 1, 1, '1', 1, 0, NULL),
(60, 'Manuelgog', 'Manuelgog', 'ManuelgogOR', 'Manuelgog', NULL, '$2y$10$nGgAwbKrJuy8I.wZlNtIOemAQyiWsmoQflD9jp6aL8efiseF379hy', 'agent', 0, NULL, 'manueladova@mail.ru', NULL, NULL, NULL, NULL, NULL, 1506745862, 1, 0, '1', 0, 0, NULL),
(61, 'IHM Regency', NULL, NULL, 'IHM', NULL, '$2y$10$0F6OBPw/XWo2pJXYOstqNeJzsMOGktOdZvDoXH4IaYKoy2rFxyEWy', 'company', 0, NULL, 'akaloforex@gmail.com', NULL, NULL, NULL, NULL, NULL, 1506882752, 1, 0, '1', 0, 0, NULL),
(62, 'ViboPoope', 'ViboPoope', 'Carter ', 'ViboPoope', NULL, '$2y$10$VdwjV2LkI1WAdoj0HCPPkOkJrPGaoueimxKA7.hdWe5P4bFQ1LhYC', 'agent', 0, NULL, 'qiewo4p@1syn.info', NULL, NULL, NULL, NULL, NULL, 1507288785, 1, 0, '1', 0, 0, NULL),
(63, 'Doveland Properties ', 'Isaac ', 'Anthony ', 'DovelandProperties', NULL, '$2y$10$afn7US4pV7J2lrIom/NbtOZuA9yN3igYLLrqgFxn.ddhIHLY2sy7m', 'agent', 0, NULL, 'isaacitodo1@gmail.com', NULL, NULL, NULL, NULL, NULL, 1507810820, 1, 0, '1', 1, 0, NULL),
(64, 'MissBee', 'Beauty ', 'Ogar', 'MissBee', NULL, '$2y$10$tzBPhwVCnJpAAmJ8SxS4sO0PXR9rNQHTe3SuwxsSg09NGw.oaCSaq', 'agent', 0, NULL, 'Beautyogar72@gmail.com', NULL, NULL, NULL, NULL, NULL, 1507877758, 1, 0, '1', 1, 0, NULL),
(72, 'Zizix6', 'Aegon', 'Targaryen', 'PrinceAeg', NULL, '$2y$10$etI/1OnbrcKw5gjIZLFCCeLPb7qzOOVWYRhUQKI0zhWRQwQkkVU4q', 'agent', 0, NULL, 'zizix6@gmail.com', NULL, NULL, NULL, NULL, NULL, 1517235347, 1, 0, '1', 1, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `realtor_houses`
--

DROP TABLE IF EXISTS `realtor_houses`;
CREATE TABLE IF NOT EXISTS `realtor_houses` (
  `realtor_house_id` bigint(255) NOT NULL AUTO_INCREMENT,
  `house_id` int(255) NOT NULL,
  `realtor_id` int(255) NOT NULL,
  `sharer_id` int(255) DEFAULT '0',
  `approved` tinyint(1) NOT NULL DEFAULT '1',
  `added` int(11) NOT NULL,
  PRIMARY KEY (`realtor_house_id`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `realtor_houses`
--

INSERT INTO `realtor_houses` (`realtor_house_id`, `house_id`, `realtor_id`, `sharer_id`, `approved`, `added`) VALUES
(34, 99, 29, 0, 1, 1492273795),
(35, 100, 29, 0, 1, 1493920641),
(36, 101, 36, 0, 1, 1493921867),
(41, 106, 5, 0, 1, 1497193356),
(42, 107, 42, 0, 1, 1497787608),
(43, 108, 42, 0, 1, 1497874723),
(44, 109, 42, 0, 1, 1497875427),
(45, 110, 42, 0, 1, 1497876176),
(46, 111, 49, 0, 1, 1498139830),
(47, 112, 50, 0, 1, 1498167201),
(48, 113, 5, 0, 1, 1499602096),
(49, 114, 50, 0, 1, 1501096927),
(50, 115, 5, 0, 1, 1503630983),
(51, 116, 55, 0, 1, 1504123485),
(52, 117, 55, 0, 1, 1504123499),
(53, 118, 5, 0, 1, 1504165361),
(54, 119, 53, 0, 1, 1505033103),
(55, 120, 58, 0, 1, 1505385997),
(56, 121, 29, 0, 1, 1505734616),
(57, 122, 55, 0, 1, 1505735509),
(58, 123, 55, 0, 1, 1505736436),
(59, 124, 55, 0, 1, 1505737544),
(60, 125, 55, 0, 1, 1505739319),
(61, 126, 55, 0, 1, 1505740567),
(62, 127, 58, 0, 1, 1505998102),
(63, 128, 53, 0, 1, 1506872193),
(64, 129, 53, 0, 1, 1506873731),
(65, 130, 53, 0, 1, 1506874064),
(66, 131, 53, 0, 1, 1506876417),
(67, 132, 56, 0, 1, 1506886559),
(68, 133, 53, 0, 1, 1507024532),
(69, 134, 53, 0, 1, 1507026377),
(70, 135, 53, 0, 1, 1507027769),
(71, 136, 53, 0, 1, 1507028054),
(72, 137, 53, 0, 1, 1507193899),
(73, 142, 53, 0, 1, 1509527816),
(74, 143, 53, 0, 1, 1509527816);

-- --------------------------------------------------------

--
-- Table structure for table `realtor_phones`
--

DROP TABLE IF EXISTS `realtor_phones`;
CREATE TABLE IF NOT EXISTS `realtor_phones` (
  `phone_id` bigint(255) NOT NULL AUTO_INCREMENT,
  `phone` varchar(20) NOT NULL,
  `realtor_id` int(255) NOT NULL,
  PRIMARY KEY (`phone_id`),
  UNIQUE KEY `phone_id` (`phone_id`),
  KEY `phone_id_2` (`phone_id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `realtor_phones`
--

INSERT INTO `realtor_phones` (`phone_id`, `phone`, `realtor_id`) VALUES
(23, '07039775298', 29),
(24, '08130222255', 5),
(25, '08176537042', 6),
(26, '08060096740', 7),
(27, '08039249293', 30),
(28, '0813022225', 33),
(29, '08064769459', 34),
(30, '08067679775', 35),
(31, '08039249293', 36),
(33, '09093241553', 38),
(34, '07039775298', 39),
(35, '08071239555', 40),
(36, '08020690678', 41),
(37, '07036308330', 42),
(38, '07039775298', 43),
(39, '09080200933', 44),
(40, '08054345678', 45),
(41, '08037156161', 46),
(42, '08062977023', 47),
(43, '08030771993', 48),
(44, '8033173299', 49),
(45, '07036308330', 50),
(46, '89659838344', 51),
(47, '08160244633', 52),
(48, '08095402982', 54),
(49, '09098756825', 53),
(50, '08173871106', 55),
(51, '08135328758', 56),
(52, '86886955532', 57),
(53, '08088311813', 58),
(54, '08036343767', 59),
(55, '81912264628', 60),
(56, '08135328758', 61),
(57, '84134933226', 62),
(58, '08067175940 ', 63),
(59, '07032726453', 64),
(61, '08063498777', 68),
(62, '08063498777', 69),
(63, '08063498777', 70),
(64, '08063498777', 71),
(65, '08063498777', 72);

-- --------------------------------------------------------

--
-- Table structure for table `realtor_traffic`
--

DROP TABLE IF EXISTS `realtor_traffic`;
CREATE TABLE IF NOT EXISTS `realtor_traffic` (
  `traffic_id` int(255) NOT NULL,
  `viewer_id` int(255) DEFAULT NULL,
  `realtor_id` int(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
