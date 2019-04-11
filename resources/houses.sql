-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 08, 2019 at 09:34 AM
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
-- Database: `abuja_apartments`
--

-- --------------------------------------------------------

--
-- Table structure for table `houses`
--

DROP TABLE IF EXISTS `houses`;
CREATE TABLE IF NOT EXISTS `houses` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
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
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=144 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `houses`
--

INSERT INTO `houses` (`id`, `estate_id`, `realtor_id`, `units`, `location_id`, `title`, `status`, `house_type_id`, `price`, `rooms`, `bedrooms`, `bathrooms`, `toilets`, `price_range_id`, `purpose`, `facilities`, `water_source`, `sale_plan`, `description`, `available`, `agent_fee`, `service_charge`, `site_id`, `created_at`, `updated_at`) VALUES
(99, 0, 29, 0, 19, '3 Bedroom Duplex', 'rent', 4, 1000000, '8', 3, '3', '3', 6, 'residential', 'sitout', 'Bore Hole', '  	  ', 'Moderate house in industrial area', 1, '100000', 0, NULL, '2017-04-15 16:29:55', '2018-05-17 12:41:12'),
(100, 0, 29, 0, 2, '10 Nwangene close', 'rent', 6, 5000000, '5', 4, '3', '2', 6, 'residential', NULL, 'N/A', '  	  ', 'This is a very nice house', 1, '100000', 1000, NULL, '2017-05-04 17:57:21', '2018-05-17 12:41:12'),
(101, 0, 36, 0, NULL, NULL, 'rent', NULL, NULL, '1', 1, '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, 0, '0', 0, NULL, '2017-05-04 18:17:47', '2018-05-17 12:41:12'),
(106, 0, 5, 0, 7, '4 Units of 2 Bedroom ', 'sale', 4, 48000000, '6', 2, '2', '2', 6, 'residential', 'water', 'Water Board', 'Negotiable, to be negotiated with the seller     ', 'A nice collection of houses in a lively settlement in the FCT      ', 1, '4800000', 0, NULL, '2017-06-11 15:02:36', '2018-11-09 09:25:49'),
(107, 1, 42, 42, 24, '4 Bedroom Fully Detached Duplex', 'sale', 10, 65000000, '6', 4, '4', '5', 6, 'residential', NULL, 'N/A', '<p>Fully completed units goes for 65,000,000 naira while Carcass (roof level) goes for 45,000,000 naira per a unit.</p>\r\n<p>&nbsp;</p>', '<p>Full description of the house:</p>\r\n<ul>\r\n<li>1 Room Boys Quarter Attached behind the Main Building.</li>\r\n<li>3 Rooms and a Living Room upstairs.</li>\r\n<li>1 Room and a Living Room Downstairs.</li>\r\n<li>All Rooms are En Suite.</li>\r\n<li>Guest Toilet.</li>\r\n</ul>', 0, '0', 0, NULL, '2017-06-18 12:06:48', '2018-12-08 05:16:12'),
(108, 1, 42, 4, 24, '3Bedroom Semi-detached Bungalow with BQ', 'sale', 5, 35000000, '9', 3, '3', '4', 6, 'residential', 'Boys Quarters, All rooms en suite', 'N/A', '<p>Fully completed unit at N35</p>\r\n<p>Carcass (roof level) at N25m</p>', '<p>3 Room and Living Room Apartment, All Rooms En Suite with a Guest Toilet</p>\r\n<p>A luxery home with lots of active and secure environment</p>', 1, '0', 0, NULL, '2017-06-19 12:18:43', '2018-05-17 12:41:12'),
(109, 1, 42, 12, 24, '4bedroom terrace duplex with bq', 'sale', 11, 55000000, '12', 4, '4', '5', 6, 'residential', '2 Sitting rooms, all rooms en suite', 'N/A', '<p>Fully completed unit at N55m</p>\r\n<p>Carcass (roof level) at N40m</p>', '<p>3 Room and Living Room at the Top Apartment and 1 Room and Living Room at the Bottom Apartment. All Rooms En Suite with a Guest Toilet</p>\r\n<p>This is a very luxurous apartment that it built to taste</p>', 1, '0', 0, NULL, '2017-06-19 12:30:27', '2018-05-17 12:41:12'),
(110, 1, 42, 33, 24, '5bedroom fully detached duplex with BQ- Type B', 'sale', 10, 110000000, '14', 5, '5', '6', 7, 'residential', 'All Rooms en suite, 2 sitting rooms, attached 1 room boys quarters', 'N/A', '<p>Fully completed unit at N110m</p>\r\n<p>Carcass (roof level) at N65m</p>', '<p>4 Rooms and A Living Room Upstairs with 1 Room and A Living Room Downstairs. All Rooms En-Suite with a Guest Toilet</p>\r\n<p>1 Room Boys Quarter Attached Behind the Main Building</p>\r\n<p>A very luxurous apartments for a large family, in a vibrant estate and environment</p>', 1, '0', 0, NULL, '2017-06-19 12:42:56', '2018-05-17 12:41:12'),
(111, 0, 49, 0, 13, '9 Jere Street', 'rent', 7, 500000, '1', 1, '1', '1', 3, 'commercial', NULL, 'N/A', NULL, '<p>office room</p>', 1, '50000', 0, NULL, '2017-06-22 13:57:10', '2018-05-17 12:41:12'),
(112, 0, 50, 0, 24, '4bedroom fully detached duplex', 'sale', 10, 66000000, '5', 4, '5', '5', 6, 'residential', 'Swimming pool, long tennis court', 'N/A', '<p>Outright sale or come up with your own payment plan or through mortgage banks.</p>', '<p>Located along airport road, with a good access road.</p>', 1, '1750000', 10000, NULL, '2017-06-22 21:33:21', '2018-05-17 12:41:12'),
(113, 0, 5, 0, 7, '4bedroom Duplex', 'sale', 4, 45000000, '', 4, '', '', 6, 'residential', '', NULL, '45 Million Asking Price	     ', '', 1, '', 0, NULL, '2017-07-09 12:08:16', '2018-05-17 12:41:12'),
(114, 0, 50, 0, 18, '2bedroom stand alone bungalow at Guzape Asokoro', 'rent', 8, 1600000, NULL, 2, NULL, NULL, NULL, 'residential', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2017-07-26 19:22:07', '2018-05-17 12:41:12'),
(115, 0, 5, 0, 4, '3 Bedroom Bungalow ', 'sale', 3, 37000000, '', 3, '', '', 6, 'residential', '', NULL, '   	         ', '<p>A very classy house in the biggest estate in west Africa</p>\r\n<p>Has a pent house with impeccable view</p>', 1, '', 0, NULL, '2017-08-25 03:16:23', '2018-05-17 12:41:12'),
(116, 0, 55, 0, 17, '3bedroom fully detached bungalow @ Nicon junction, katampe district Abuja.', 'rent', 9, 1200000, NULL, 3, NULL, NULL, NULL, 'residential', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, '2017-08-30 20:04:45', '2018-05-17 12:41:12'),
(117, 0, 55, 0, 17, '3bedroom fully detached bungalow @ Nicon junction, katampe district Abuja.', 'rent', 9, 1200000, '', 3, '', '3', 6, 'residential', '', NULL, '  	     ', '<p>This is a renovated 3 Bedroom Bungalow with 3toilets and bathroom</p>\r\n<p>located at katampe district opposite Nicain Junction Maitama</p>', 1, '', 0, NULL, '2017-08-30 20:04:59', '2018-05-17 12:41:12'),
(118, 0, 5, 0, 7, '2 Bedroom Bungalow Duplex ', 'sale', 3, 15000000, NULL, 2, NULL, NULL, NULL, 'residential', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2017-08-31 07:42:41', '2018-05-17 12:41:12'),
(119, 0, 53, 0, 4, 'Newly Built 4-Bedroom Duplex & 2-Bedrooms BQ at Ipent 7 Estate, Gwarinpa-FCT Abuja', 'sale', 4, 60000, '', 4, '', '', 1, 'residential', '', NULL, '  	     ', '<p>Appealing 4-Bedroom Duplex &amp; 2-Bedrooms BQ at Ipent 7 Estate, Gwarinpa-FCT Abuja</p>\r\n<p>Description: This delightful duplex derives attraction from its scintillating finishes that gives an occupant a sensation of semi-heaven living.&nbsp; This is because the property is in between luxurious houses in an alluring and secured environment.</p>\r\n<p>This duplex is made up of 3 bedrooms (all rooms are en-suite) upstairs while down stairs has 1 bedroom (en-suite), spacious parlor, kitchen, store, dinning area, and a guest toilet. Its compound has a 2 bedrooms en-suite BQ with a kitchen and then a security house which is beside the entrance of the house. The compound is large enough to accommodate from 6 to 8 cars.</p>\r\n<p>LOCATIONS: This property is situated at No. 44, Alikum Street, Ipent 7 Estate, Gwarinpa-FCT Abuja.</p>\r\n<p>&nbsp;</p>\r\n<p>Marketed By PROMETHEUS SOLUTIONS&hellip;</p>\r\n<p><strong>FOR MORE INFORMATION PLEASE CONTACT US</strong></p>\r\n<p><strong>Phone:</strong> +234-9098756825 or +234-7033385434</p>\r\n<p><strong>Office: </strong>Suite D86/90, Efab Shopping Mall, Area11, Garki-Abuja.</p>\r\n<p><strong>Email:</strong><a href=\"mailto:prometheussolutions1@gmail.com\">prometheussolutions1@gmail.com</a></p>\r\n<p><strong>Website:</strong> www.prometheusrealty.com</p>\r\n<p><strong>Corporate Head Office:</strong> Suite D86/90, Efab Shopping Mall Extension, opp. FCDA, Area11, Garki-Abuja.&nbsp;</p>\r\n<p><strong>&nbsp;</strong></p>\r\n<p><strong>RC: 2434487</strong></p>\r\n<p><strong>PROMETHEUS LIMITED</strong></p>\r\n<p><em>Your Real Estate Solutions&hellip;</em></p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', 1, '5', 0, NULL, '2017-09-10 08:45:02', '2018-05-17 12:41:12'),
(120, 0, 58, 0, 1, 'Letter of allocation ', 'sale', 2, 20000000, NULL, 3, NULL, NULL, NULL, 'residential', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2017-09-14 10:46:37', '2018-05-17 12:41:12'),
(121, 0, 29, 0, 23, 'Newly Built Fully Serviced 3Bedroom Flat', 'rent', 2, 2200000, NULL, 3, NULL, NULL, NULL, 'residential', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2017-09-18 11:36:56', '2018-05-17 12:41:12'),
(122, 0, 55, 0, 23, 'Newly Built', 'rent', 2, 2200000, '5', 3, '3', '3', 6, 'residential', 'Fully Serviced, 250KVA Central Generator', NULL, '  	     ', '<p>This is a Newly Bult Fully Serviced 3Bedroom Flat with BQ</p>\r\n<p>All Rooms en suite with bathtubs.</p>\r\n<p>It is serviced with AC, 250KVA Central Generator</p>\r\n<p>For maximum Comfort, just pay and move in</p>', 1, '220000', 300000, NULL, '2017-09-18 11:51:49', '2018-05-17 12:41:12'),
(123, 0, 55, 0, 25, 'Newly Built 3Bedroom Flat For Sale', 'sale', 2, 60000000, '7', 3, '4', '4', 6, 'residential', 'Tarred Road, Pave areas, green areas, borehole, Dedicated ransformer, Fitted Wadropes, heaters, bathtub', NULL, '60Million Per Unit\r\nDetails to be discussed with Agent/Owner	     ', '<p>This is a newly Built 3Bedroom Flat with 1Bedroom Guest Chalet all en suite</p>\r\n<p>Located at Jahi District of the Federl Capital Territory</p>\r\n<p>Facilities include Tarred Road, Pave Areas, Green Areas, Borehole, Dedicated Transformer, etc</p>\r\n<p>All Rooms come fitted with wadrobes, heaters and bathtubs.</p>', 1, '', 0, NULL, '2017-09-18 12:07:16', '2018-05-17 12:41:12'),
(124, 0, 55, 0, 26, '2 Bedroom Flat at katampe', 'rent', 2, 1000000, '7', 2, '2', '3', 6, 'residential', 'Dedicated Transformer, Central Generator, Cabinet, Store', NULL, '  	     ', '<p>A neat 2 Bedroom Flat at Katampe District of the Federal Capital Territory, Tipper garage after Minister hill</p>\r\n<p>It has 3 Toilets, has kitchen cabinet, store and sitting room.</p>\r\n<p>Serviced with Central Generator and Dedicated transformer.</p>\r\n<p>Price: 1Million(Negotiable)</p>\r\n<p>Agency and Legal Fees applies</p>', 1, '', 300000, NULL, '2017-09-18 12:25:44', '2018-05-17 12:41:12'),
(125, 0, 55, 0, 25, '3 bedroom Flat at Jahi', 'rent', 2, 1600000, '7', 3, '', '4', 6, 'residential', 'Massive Kitchen, Cabinet and store', NULL, '  	     ', '<p>A New and Preciously built 3 Bedroom Flat at Jahi with all room en suite&nbsp;</p>\r\n<p>It has spacious sitting room with dinning, visitors toilet, massive kitchen with cabinet and store</p>\r\n<p>Legal Fees applies</p>', 1, '160000', 300000, NULL, '2017-09-18 12:55:19', '2018-05-17 12:41:12'),
(126, 0, 55, 0, 25, '3 Bedroom Serviced Flat at Jahi', 'rent', 2, 3000000, '8', 3, '', '4', 6, 'residential', 'Central Generator, AC, Dedicated transformer, Electric Fence', NULL, '  	     ', '<p>This is a Newly Built and serviced 3Bedroom flat with 4toilets all en suite with bathtubs except children room.</p>\r\n<p>It is serviced with central generator and AC, Dedicated transformer, Electric Fence, etc</p>\r\n<p>3million Per Annum includes service charge</p>\r\n<p>Agency and Legal Fees apply</p>\r\n<p>Just Pay and Move In</p>', 1, '', 0, NULL, '2017-09-18 13:16:07', '2018-05-17 12:41:12'),
(127, 0, 58, 0, 7, 'OFFER OF ONE BEDROOM FLAT FOR SALE', 'sale', 2, 10000000, NULL, 1, NULL, NULL, NULL, 'residential', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2017-09-21 12:48:22', '2018-05-17 12:41:12'),
(128, 0, 53, 0, 10, '11Units of one bedroom flat and 5 Shops at Mararaba, Abuja', 'sale', 2, 30000000, '11', 11, '11', '11', 6, 'residential', '', 'Water Board', '  	     ', '<p>11 units of 1 bedroom flat in a spacious compound. Each unit is en-suite and has its own balcony, kitchen, parlor, and a spacious bedroom. This property has its own gate and also have 5 shops attached to it from the outside. The owner wants to sell this property in order to complete a project at his home town. The rooms are spacious and Each unit is being rented at N120,000.00 (One hundred - twenty thousand naira only).</p>\r\n<p>Therefore: N120,000.00 X 11 = N1,320.000.00 (One million - three hundred thousand - twenty thousand only) While each of the five (5) shops are rented out at N70,000.00 (Seventy thousand naira only).</p>\r\n<p>Therefore:</p>\r\n<p>N70,000.00 X 5 = N350,000.00 (Three hundred - fifty thousand naira only)</p>\r\n<p>&nbsp;</p>\r\n<p>Total = N1,320.000.00 + N350,000.00 = N1,670.000.00 Yearly rent</p>\r\n<p>(One million-six hundred thousand-seventy thousand naira only)</p>\r\n<p>&nbsp;</p>\r\n<p><strong>LOCATION</strong></p>\r\n<p>This property is located at: House No. 10, Tudun wada, behind Zamfara Mosque, Off Nyanya Keffi Express Road (through <strong>Royal Dream Hotel</strong>), Mararaba.</p>\r\n<p>Don&rsquo;t miss this lucrative investment opportunity!</p>\r\n<p>&nbsp;</p>\r\n<p><strong>FOR MORE INFORMATION &amp; INSPECTION PLEASE CONTACT US</strong></p>\r\n<p><strong>Phone:</strong> +234-9098756825 or +234-7033385434</p>\r\n<p>Office: Suite D86/90, Efab Shopping Mall, Area11, Garki-Abuja</p>\r\n<p><strong>Email:</strong><a href=\"mailto:prometheussolutions1@gmail.com\">prometheussolutions1@gmail.com</a></p>\r\n<p><strong>Website:</strong> www.prometheusrealty.com</p>\r\n<p><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong></p>\r\n<p><strong>RC: 2434487</strong></p>\r\n<p><strong>PROMETHEUS LIMITED</strong></p>\r\n<p><em>Your Real Estate Solutions&hellip;</em></p>', 1, '5', 0, NULL, '2017-10-01 15:36:32', '2018-05-17 12:41:12'),
(129, 0, 53, 0, 4, ': Appealing 4-Bedroom Carcass Duplex & 2-Bedrooms BQ at Ipent 7 Estate, Gwarinpa-FCT Abuja', 'sale', 10, 35000000, NULL, 4, NULL, NULL, NULL, 'residential', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2017-10-01 16:02:11', '2018-05-17 12:41:12'),
(130, 0, 53, 0, 4, 'Executive 9 Bedroom Duplex at Citec Villa-Gwarinpa, FCT-Abuja', 'sale', 10, 250000000, '9', 9, '9', '9', 7, 'residential', '', 'Bore Hole', '  	     ', '<p>An appealing 9 bedroom duplex in an alluring environment of Citec Villa, Gwarinpa estate.</p>\r\n<p>The ground floor has three (3) parlours and a toilet for guest. The ground floor also has three (3) bedrooms (all rooms en-suite) and a Dinning area.</p>\r\n<p>Upstairs, has up to six (6) very spacious bedrooms (all rooms are en-suite with shower cubicle and Jacuzzi) each room has a dressing/clothing area and some has a balcony (including Mater&rsquo;s bedroom).</p>\r\n<p>The whole duplex is painted with dulux paints with POP and pillars and the owner of this property wants to sell this house with all the furniture if you are interested and if u are not, then you can buy it without the furniture at a lesser price. Below is the feature of the house:</p>\r\n<p>The duplex as a two (2) bedroom chalet, security house, an outside bar, laundry room, a skylight, spilt A.C, big generator, LCD screen, chairs, overhead tank &amp; borehole, central water heater, a car port, electric wire fence, a built-in sound system among others.</p>\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>\r\n<p><strong>LOCATIONS</strong></p>\r\n<p>The Duplex is situated at: House No. 805D, 444 Crescent, off 4<sup>th</sup> Avenue, Gwarinpa Estate, FCT Abuja-Nigeria.</p>\r\n<p>&nbsp;</p>\r\n<p>Marketed By PROMETHEUS SOLUTIONS&hellip;</p>\r\n<p><strong>FOR MORE INFORMATION PLEASE CONTACT US</strong></p>\r\n<p><strong>Phone:</strong> +234-9098756825 or +234-7033385434</p>\r\n<p><strong>Office: </strong>Suite D86/90, Efab Shopping Mall, Area11, Garki-Abuja.</p>\r\n<p><strong>Email:</strong><a href=\"mailto:prometheussolutions1@gmail.com\">prometheussolutions1@gmail.com</a></p>\r\n<p><strong>Website:</strong> www.prometheusrealty.com</p>\r\n<p><strong>Corporate Head Office:</strong> Suite D86/90, Efab Shopping Mall Extension, opp. FCDA, Area11, Garki-Abuja.&nbsp;</p>\r\n<p><strong>&nbsp;</strong></p>\r\n<p><strong>RC: 2434487</strong></p>\r\n<p><strong>PROMETHEUS LIMITED</strong></p>\r\n<p><em>Your Real Estate Solutions&hellip;</em></p>\r\n<p>&nbsp;</p>', 1, '5', 0, NULL, '2017-10-01 16:07:44', '2018-05-17 12:41:12'),
(131, 0, 53, 0, 4, 'A 6-Bedroom Carcass Duplex & 2-Bedrooms BQ at Ipent 7 Estate, Gwarinpa-FCT Abuja', 'sale', 10, 75000000, NULL, 6, NULL, NULL, NULL, 'residential', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2017-10-01 16:46:57', '2018-05-17 12:41:12'),
(132, 0, 56, 0, 26, 'Regent Service Apartments', 'sale', 6, 29000000, '9', 3, '3', '4', 6, 'residential', 'Private Parking and a General Car Parking; Laundry, Gym, Children’s Play Ground', NULL, 'N29,000,000 (Lumpsum)\r\n\r\n* Initial Installment\r\n30%: N8,700,000\r\n* Second Installment\r\n30%: N8,700,000\r\n* Third Installment\r\n20%: N5,800,000\r\n* Forth Installment\r\n20%: N5,800,000', '<p>Beautifully and Functionally designed 3 Bedroom Block of Flats</p>\r\n<p>All rooms ensuite with high quality bathroom Fittings</p>\r\n<ul>\r\n<li>An Exquisite Living<br />R o o m , K i t c h e n ,<br />Store and Guest<br />Toilet</li>\r\n<li>Private Parking</li>\r\n<li>General Parking</li>\r\n<li>Gym + Laundry</li>\r\n<li>Children&rsquo;s Play<br />Ground</li>\r\n<li>Services</li>\r\n<li>Security.</li>\r\n</ul>', 1, '', 0, NULL, '2017-10-01 19:35:59', '2018-05-17 12:41:12'),
(133, 0, 53, 0, 9, 'Lounge for sale, Kuje-Abuja', 'sale', 9, 120000000, '10', 6, '6', '6', 7, 'commercial', 'Other features include:      Generator house     2 borehole     Store for drinks     An office with two rooms inside     A staff toilet     A customers toilet     3 very big store rooms which can be converted to 6 large rooms     Just to mention few', 'Bore Hole', '  	     ', '<p>A beautiful lounge for sale in a private environment of Kuje. The lounge has a very large compound that can take more than 12 cars; it has a fish pond &amp; Suya section and a security room by the entrance. This lounge also has a restaurant and kitchen. This lounge has a modern grill bar, a very large event hall with more than 500 seats with a flaming and decoration. Just by the side, there is a 3bedroom flat with 4 toilets with a Jacuzzi, kitchen, parlor and a dinning area.</p>\r\n<p>There is also a smoothie bar just by the left hand and another bar with 54 seats and 20 tables.</p>\r\n<p>Other features include:</p>\r\n<ul>\r\n<li>Generator house</li>\r\n<li>2 borehole</li>\r\n<li>Store for drinks</li>\r\n<li>An office with two rooms inside</li>\r\n<li>A staff toilet</li>\r\n<li>A customers toilet</li>\r\n<li>3 very big store rooms which can be converted to 6 large rooms</li>\r\n<li>Just to mention few</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p>Location: No, 6, Pashion street, opp. Union Homes, Kuchiyako Layout, Kuje-FCT Abuja.</p>\r\n<p>This is a good deal as the lounge is presently functional. Please contact me as soon as possible&hellip; dnt miss this investment opportunity I&rsquo;m telling this as a real estate consultant with more than 10 years of experience.</p>\r\n<p>&nbsp;</p>\r\n<p>Marketed By PROMETHEUS SOLUTIONS&hellip;</p>\r\n<p><strong>FOR MORE INFORMATION PLEASE CONTACT US</strong></p>\r\n<p><strong>Phone:</strong> +234-9098756825 or +234-7033385434</p>\r\n<p><strong>Office: </strong>Suite D86/90, Efab Shopping Mall, Area11, Garki-Abuja.</p>\r\n<p><strong>Email:</strong><a href=\"mailto:prometheussolutions1@gmail.com\">prometheussolutions1@gmail.com</a></p>\r\n<p><strong>Website:</strong> www.prometheusrealty.com</p>\r\n<p><strong>Corporate Head Office:</strong> Suite D86/90, Efab Shopping Mall Extension, opp. FCDA, Area11, Garki-Abuja.</p>\r\n<p><strong>&nbsp;</strong></p>\r\n<p><strong>RC: 2434487</strong></p>\r\n<p><strong>PROMETHEUS SOLUTIONS LIMITED</strong></p>\r\n<p><em>Your Real Estate Solutions&hellip;</em></p>', 1, '5', 0, NULL, '2017-10-03 09:55:30', '2018-05-17 12:41:12'),
(134, 0, 53, 0, 24, 'Distress sale!!! 6bedrooms fully Detached Carcass Duplex in Gaduwa', 'sale', 10, 25000000, '6', 6, '5', '5', 6, 'residential', '', 'Water Board', '  	     ', '<p>A delightful 6bedrroms fully detached carcass duplex with a big space for BQ in a mini estate at Gaduwa. According to the architectural design of this building, all rooms are en-suit and it has a large parlor, a dining area, kitchen and store.</p>\r\n<p>All infrastructural fees have been paid for and the documents are intact.</p>\r\n<p>The estate is known as DOLZ BROWN ESTATE, it&rsquo;s a mini and quite estate with not more than 34 houses and the estate is 90% occupied just behind Ipent 6 estate (Legislative Villa) at Gaduwa District, Abuja.</p>\r\n<p>LOCATIONS: This property is situated at No. 44, Alikum Street, DOLIZ BROWN ESTATE, Gaduwa,FCT-Abuja.</p>\r\n<p>&nbsp;</p>\r\n<p>Marketed By PROMETHEUS SOLUTIONS&hellip;</p>\r\n<p><strong>FOR MORE INFORMATION PLEASE CONTACT US</strong></p>\r\n<p><strong>Phone:</strong> +234-9098756825 or +234-7033385434</p>\r\n<p><strong>Office: </strong>Suite D86/90, Efab Shopping Mall, Area11, Garki-Abuja.</p>\r\n<p><strong>Email:</strong><a href=\"mailto:prometheussolutions1@gmail.com\">prometheussolutions1@gmail.com</a></p>\r\n<p><strong>Website:</strong> www.prometheusrealty.com</p>\r\n<p><strong>Corporate Head Office:</strong> Suite D86/90, Efab Shopping Mall Extension, opp. FCDA, Area11, Garki-Abuja.</p>\r\n<p><strong>&nbsp;</strong></p>\r\n<p><strong>RC: 2434487</strong></p>\r\n<p><strong>PROMETHEUS LIMITED</strong></p>\r\n<p><em>Your Real Estate Solutions&hellip;</em></p>', 1, '5', 0, NULL, '2017-10-03 10:26:17', '2018-05-17 12:41:12'),
(135, 0, 53, 0, 22, 'A 4-bedrooms Semi-Detached Duplex with BQin a Mini Estate, Wuye', 'sale', 7, 45000000, NULL, 4, NULL, NULL, NULL, 'residential', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2017-10-03 10:49:29', '2018-05-17 12:41:12'),
(136, 0, 53, 0, 20, 'A Two Wings Uncompleted Duplex, Kado, FCT Abuja', 'sale', 7, 60000000, '6', 6, '6', '6', 6, 'residential', '', 'Bore Hole', '  	     ', '<p>This duplex is divided into two. The first wing upstairs has a specious 3 bedrooms (all rooms are en-suite) and a parlor, while down stairs has a very big parlor, kitchen, store, dinning area, visitor&rsquo;s toilet, and a room (en-suite).</p>\r\n<p>The second wing upstairs has two bedrooms (all rooms are en-suite) while down stairs has parlor, visitors toilet, kitchen, and a store.</p>\r\n<p>This structure is on a land big enough to pack from 8-10 cars. There is a security house by the entrance.</p>\r\n<p>Therefore, the property has: 6 rooms and 7 toilets</p>\r\n<p>LOCATIONS: This property is situated at No. 9, Ajumgobia F.I.A Close, opposite Corn Oil, Kado Estate-FCT Abuja.</p>\r\n<p>&nbsp;</p>\r\n<p>Marketed by PROMETHEUS SOLUTIONS&hellip;</p>\r\n<p><strong>FOR MORE INFORMATION PLEASE CONTACT US</strong></p>\r\n<p><strong>Phone:</strong> +234-9098756825 or +234-7033385434</p>\r\n<p><strong>Office: </strong>Suite D86/90, Efab Shopping Mall, Area11, Garki-Abuja.</p>\r\n<p><strong>Email:</strong><a href=\"mailto:prometheussolutions1@gmail.com\">prometheussolutions1@gmail.com</a></p>\r\n<p><strong>Website:</strong> www.prometheusrealty.com</p>\r\n<p><strong>&nbsp;</strong></p>\r\n<p><strong>RC: 2434487</strong></p>\r\n<p><strong>PROMETHEUS LIMITED</strong></p>\r\n<p><em>Your Real Estate Solutions&hellip;</em></p>', 1, '5', 0, NULL, '2017-10-03 10:54:14', '2018-05-17 12:41:12'),
(137, 0, 53, 0, 12, 'A newly renovated 3-bedrooms Terrace Duplex with 2-bedrooms BQ, Wuse II-Abuja', 'sale', 11, 80000000, '5', 3, '4', '3', 6, 'residential', '', 'Bore Hole', '  	     ', '<p>This is a corner piece terrace duplex that is located in the heart of town with just few meters away from Wuse market and central area. The terrace was just renovated, it has 3-bedrooms (all rooms are en-suite) and a detached 2-bedroom BQ and a space for garden behind it.</p>\r\n<p>Location: No. 15 A, ECDA Quarters, off Ibrahim Hashim Street, Wuse-FCT Abuja.</p>\r\n<p>Marketed by PROMETHEUS SOLUTIONS&hellip;</p>\r\n<p><strong>FOR MORE INFORMATION PLEASE CONTACT US</strong></p>\r\n<p><strong>Phone:</strong> +234-9098756825 or +234-7033385434</p>\r\n<p><strong>Office: </strong>Suite D86/90, Efab Shopping Mall, Area11, Garki-Abuja.</p>\r\n<p><strong>Email:</strong><a href=\"mailto:prometheussolutions1@gmail.com\">prometheussolutions1@gmail.com</a></p>\r\n<p><strong>Website:</strong> www.prometheusrealty.com</p>\r\n<p><strong>&nbsp;</strong></p>\r\n<p><strong>RC: 2434487</strong></p>\r\n<p><strong>PROMETHEUS SOLUTIONS</strong></p>\r\n<p><em>Your Real Estate Solutions&hellip;</em></p>', 1, '5', 0, NULL, '2017-10-05 08:58:18', '2018-05-17 12:41:12'),
(142, 4, 53, 0, 4, '3 Bedroom Terrace Duplex', 'sale', 11, 120000, NULL, 3, NULL, NULL, NULL, 'residential', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2017-10-30 23:12:38', '2018-05-17 12:41:12'),
(143, 0, 53, 0, 26, '4Bedroom Duplex', 'rent', 4, 1500000, NULL, 4, NULL, NULL, NULL, 'residential', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, '2017-11-01 09:07:10', '2018-05-17 12:41:12');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;