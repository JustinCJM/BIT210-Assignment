-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2023 at 06:39 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `travurr_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerID` int(5) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `username` varchar(30) NOT NULL,
  `pwd` varchar(30) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contactno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerID`, `fullName`, `username`, `pwd`, `gender`, `email`, `contactno`) VALUES
(1, 'John Smith', 'PassportPioneer', '0rCe6sJyFr', 'male', 'PassportPioneer@gmail.com', 123453232),
(2, 'Jane Doe', 'JourneyQuester', 'O1xd0rCkBR', 'female', 'JourneyQuester@gmail.com', 12789657),
(3, 'Aliya Nuha', 'VagabondVentures', 'MyEtKCFSFW', 'female', 'VagabondVentures@gmail.com', 125678542);

-- --------------------------------------------------------

--
-- Table structure for table `merchant`
--

CREATE TABLE `merchant` (
  `merchantID` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `pwd` varchar(30) NOT NULL DEFAULT substr(md5(rand()),1,8),
  `default_pwd` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contactNo` varchar(255) DEFAULT NULL,
  `shopName` varchar(100) NOT NULL,
  `merchDescription` varchar(255) NOT NULL,
  `regStatus` varchar(40) NOT NULL DEFAULT 'PENDING',
  `tmoID` int(5) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `merchant`
--

INSERT INTO `merchant` (`merchantID`, `username`, `pwd`, `default_pwd`, `email`, `contactNo`, `shopName`, `merchDescription`, `regStatus`, `tmoID`) VALUES
(1, 'TravelersTroves', 'JM8u65qcAe', '', 'TravelersTroves@gmail.com', '0125678432', 'Travelers Troves Co', 'Welcome to Travelers Troves Co, where the spirit of adventure meets curated elegance. Explore our carefully selected collection of travel plans, perfect for your next holiday.', 'ACTIVE', 1),
(2, 'HorizonHavenHub', 'jjfF4BolDI', '', 'HorizonHaven@gmail.com', '0167894562', 'Horizon Haven Hub', 'Discover the world through Horizon Haven Hub, your go-to destination for travel trips essentials. Immerse yourself in a carefully curated selection of wanderlust-worthy items that combine adventure and mystery.', 'ACTIVE', 1),
(3, 'GlobeGoodsGallery', '6uhOHATcxz', '', 'GlobeGoods@gmail.com', '0198765981', 'Globe Goods Gallery', 'At Globe Goods Gallery, we believe that the journey is just as important as the destination. Step into a world of travel, where each plan is handpicked to ignite your sense of wanderlust.', 'ACTIVE', 1);

-- --------------------------------------------------------

--
-- Table structure for table `merch_documents`
--

CREATE TABLE `merch_documents` (
  `documentID` int(11) NOT NULL,
  `merchantID` int(11) DEFAULT NULL,
  `document_name` varchar(255) NOT NULL,
  `document_path` varchar(255) NOT NULL,
  `upload_date` datetime DEFAULT curtime(),
  `doc_description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `merch_documents`
--

INSERT INTO `merch_documents` (`documentID`, `merchantID`, `document_name`, `document_path`, `upload_date`, `doc_description`) VALUES
(1, 1, 'TravelersTroves_TravelersTrove-BusinessLicense.png', 'pdfuploads/TravelersTroves_TravelersTrove-BusinessLicense.png', '2023-11-16 22:15:56', 'Travelers Troves business license'),
(2, 2, 'HorizonHavenHub_HorizonHaven-BusinessLicense.pdf', 'pdfuploads/HorizonHavenHub_HorizonHaven-BusinessLicense.pdf', '2023-11-16 22:22:54', 'HorizonHavenHub business license'),
(3, 3, 'GlobeGoodsGallery_GlobeGoodsGallery-BusinessLicense.pdf', 'pdfuploads/GlobeGoodsGallery_GlobeGoodsGallery-BusinessLicense.pdf', '2023-11-16 22:26:36', 'Globe Goods Gallery Business License');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` int(11) NOT NULL,
  `orderDate` datetime NOT NULL DEFAULT current_timestamp(),
  `orderStatus` varchar(30) NOT NULL,
  `billingAddress` varchar(255) NOT NULL,
  `totalAmount` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `customerID` int(11) NOT NULL,
  `productID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderID`, `orderDate`, `orderStatus`, `billingAddress`, `totalAmount`, `quantity`, `customerID`, `productID`) VALUES
(1, '2023-10-16 10:55:18', 'REVIEWED', '24, Jalan House, Petaling Jaya 47810 Selangor', 260.00, 2, 1, 4),
(2, '2023-10-30 12:55:18', 'REVIEWED', '24, Jalan House, Petaling Jaya 47810 Selangor', 100.00, 2, 1, 5),
(3, '2023-11-11 12:42:18', 'REVIEWED', '24, Jalan House, Petaling Jaya 47810 Selangor', 159.98, 2, 1, 6),
(4, '2023-10-01 13:45:18', 'REVIEWED', '24, Jalan House, Petaling Jaya 47810 Selangor', 600.00, 6, 1, 7),
(5, '2023-11-17 18:55:43', 'REVIEWED', '24, Jalan House, Petaling Jaya 47810 Selangor', 359.97, 3, 1, 8),
(6, '2023-11-21 12:32:45', 'REVIEWED', '24, Jalan House, Petaling Jaya 47810 Selangor', 400.00, 4, 1, 9),
(7, '2023-11-07 14:20:12', 'REVIEWED', '3, Jalan Kenyalang, 60000 Kuala Lumpur', 650.00, 5, 2, 4),
(8, '2023-10-10 13:18:08', 'REVIEWED', '3, Jalan Kenyalang, 60000 Kuala Lumpur', 200.00, 4, 2, 5),
(9, '2023-10-27 21:18:44', 'REVIEWED', '3, Jalan Kenyalang, 60000 Kuala Lumpur', 159.98, 2, 2, 6),
(10, '2023-11-01 23:19:33', 'REVIEWED', '3, Jalan Kenyalang, 60000 Kuala Lumpur', 300.00, 3, 2, 7),
(11, '2023-11-10 00:20:34', 'REVIEWED', '3, Jalan Kenyalang, 60000 Kuala Lumpur', 599.95, 5, 2, 8),
(12, '2023-11-14 10:22:24', 'REVIEWED', '3, Jalan Kenyalang, 60000 Kuala Lumpur', 200.00, 4, 2, 9),
(13, '2023-10-03 10:25:33', 'REVIEWED', '11 Jalan Firma 2/1 Kawasan Perindustrian Tebrau, Johor Bahru, 81100 Johor', 130.00, 1, 3, 4),
(14, '2023-10-14 00:27:14', 'REVIEWED', '11 Jalan Firma 2/1 Kawasan Perindustrian Tebrau, Johor Bahru, 81100 Johor', 150.00, 3, 3, 5),
(15, '2023-10-31 13:28:47', 'REVIEWED', '11 Jalan Firma 2/1 Kawasan Perindustrian Tebrau, Johor Bahru, 81100 Johor', 319.96, 4, 3, 6),
(16, '2023-11-01 14:29:38', 'REVIEWED', '11 Jalan Firma 2/1 Kawasan Perindustrian Tebrau, Johor Bahru, 81100 Johor', 500.00, 5, 3, 7),
(17, '2023-11-10 03:30:47', 'REVIEWED', '11 Jalan Firma 2/1 Kawasan Perindustrian Tebrau, Johor Bahru, 81100 Johor', 119.99, 1, 3, 8),
(18, '2023-11-14 13:31:43', 'REVIEWED', '11 Jalan Firma 2/1 Kawasan Perindustrian Tebrau, Johor Bahru, 81100 Johor', 200.00, 4, 3, 9),
(19, '2023-11-09 01:08:12', 'AWAITING REFUND', '24, Jalan House, Petaling Jaya 47810 Selangor', 50.00, 1, 1, 5),
(20, '2023-11-09 12:08:12', 'AWAITING REFUND', '24, Jalan House, Petaling Jaya 47810 Selangor', 79.99, 1, 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productID` int(9) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `productPrice` double NOT NULL,
  `category` varchar(50) NOT NULL,
  `prodLocation` varchar(50) NOT NULL,
  `prodDescription` varchar(255) NOT NULL,
  `merchantID` int(5) NOT NULL,
  `quantitySold` int(11) DEFAULT 0,
  `totalRating` int(11) DEFAULT 0,
  `avgRating` decimal(6,1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productID`, `productName`, `productPrice`, `category`, `prodLocation`, `prodDescription`, `merchantID`, `quantitySold`, `totalRating`, `avgRating`) VALUES
(4, 'Legoland Malaysia', 130, 'Theme Park', 'Johor Bahru', 'Embark on a whimsical journey with our enchanting trip to LEGOLAND Malaysia, where imagination and creativity come to life in a vibrant world of colorful bricks.', 2, 77, 14, 4.7),
(5, 'Melaka Tour', 50, 'Tour', 'Melaka', '\"Embark on a captivating journey through time with our Melaka tour, a UNESCO World Heritage city that unfolds like a living history book. Discover the rich tapestry of cultures that have shaped this charming Malaysian gem.', 2, 32, 14, 4.7),
(6, 'Lost World of Tambun', 79.99, 'Water Park', 'Ipoh', 'Embark on an extraordinary adventure to the Lost World of Tambun, a premier theme park and resort nestled amidst the lush landscapes of Ipoh, Malaysia. Enveloped by natural beauty, this unique destination seamlessly blends thrilling attractions with a tou', 2, 49, 15, 5.0),
(7, 'Skytropolis Indoor Theme Park', 100, 'Theme Park', 'Genting Highland', 'Step into a world of exhilarating fun and enchantment at Skytropolis Indoor Theme Park, nestled high in the cool mountain air of Genting Highlands. Our specially crafted experience invites you to a thrilling adventure inside Asia\'s first Fox-themed indoor', 1, 38, 15, 5.0),
(8, 'District 21', 119.99, 'Theme Park', 'Putrajaya', '\"Embark on an urban adventure like no other at District 21, a one-of-a-kind indoor adventure park located in the heart of Kuala Lumpur. This adrenaline-fueled destination offers an immersive experience where physical challenges and excitement meet futuris', 1, 67, 15, 5.0),
(9, 'Langkawi Cable Car', 50, 'Tour', 'Langkawi', 'Ascend to the heights of natural beauty with the Langkawi Cable Car, a breathtaking journey that offers panoramic views of the lush rainforest, majestic mountains, and the stunning Andaman Sea', 1, 99, 13, 4.3);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `imageID` int(11) NOT NULL,
  `productID` int(11) DEFAULT NULL,
  `image_name` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `display` int(50) NOT NULL DEFAULT 1,
  `image_upload_date` datetime DEFAULT curtime()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`imageID`, `productID`, `image_name`, `image_path`, `display`, `image_upload_date`) VALUES
(20, 4, 'Legoland Malaysia_legoland-image1.jpg', 'productUploads/Legoland Malaysia_legoland-image1.jpg', 1, '2023-11-16 23:11:12'),
(21, 4, 'Legoland Malaysia_legoland-image2.jpg', 'productUploads/Legoland Malaysia_legoland-image2.jpg', 0, '2023-11-16 23:11:12'),
(22, 4, 'Legoland Malaysia_legoland-image3.jpg', 'productUploads/Legoland Malaysia_legoland-image3.jpg', 0, '2023-11-16 23:11:12'),
(23, 4, 'Legoland Malaysia_legoland-image4.jpg', 'productUploads/Legoland Malaysia_legoland-image4.jpg', 0, '2023-11-16 23:11:12'),
(24, 4, 'Legoland Malaysia_legoland-image5.jpg', 'productUploads/Legoland Malaysia_legoland-image5.jpg', 0, '2023-11-16 23:11:12'),
(25, 5, 'Melaka Tour_melaka-image1.jpg', 'productUploads/Melaka Tour_melaka-image1.jpg', 1, '2023-11-16 23:16:26'),
(26, 5, 'Melaka Tour_melaka-image2.jpg', 'productUploads/Melaka Tour_melaka-image2.jpg', 0, '2023-11-16 23:16:26'),
(27, 5, 'Melaka Tour_melaka-image3.jpg', 'productUploads/Melaka Tour_melaka-image3.jpg', 0, '2023-11-16 23:16:26'),
(28, 5, 'Melaka Tour_melaka-image4.jpg', 'productUploads/Melaka Tour_melaka-image4.jpg', 0, '2023-11-16 23:16:26'),
(29, 5, 'Melaka Tour_melaka-image5.jpg', 'productUploads/Melaka Tour_melaka-image5.jpg', 0, '2023-11-16 23:16:26'),
(30, 6, 'Lost World of Tambun_tambun-image2.jpg', 'productUploads/Lost World of Tambun_tambun-image2.jpg', 1, '2023-11-16 23:21:49'),
(31, 6, 'Lost World of Tambun_tambun-image1.jpg', 'productUploads/Lost World of Tambun_tambun-image1.jpg', 0, '2023-11-16 23:21:49'),
(32, 6, 'Lost World of Tambun_tambun-image3.jpg', 'productUploads/Lost World of Tambun_tambun-image3.jpg', 0, '2023-11-16 23:21:49'),
(33, 6, 'Lost World of Tambun_tambun-image4.jpg', 'productUploads/Lost World of Tambun_tambun-image4.jpg', 0, '2023-11-16 23:21:49'),
(34, 6, 'Lost World of Tambun_tambun-image5.jpeg', 'productUploads/Lost World of Tambun_tambun-image5.jpeg', 0, '2023-11-16 23:21:49'),
(35, 7, 'Skytropolis Indoor Theme Park_sky-image1.jpg', 'productUploads/Skytropolis Indoor Theme Park_sky-image1.jpg', 1, '2023-11-16 23:34:29'),
(36, 7, 'Skytropolis Indoor Theme Park_sky-image2.jpg', 'productUploads/Skytropolis Indoor Theme Park_sky-image2.jpg', 0, '2023-11-16 23:34:29'),
(37, 7, 'Skytropolis Indoor Theme Park_sky-image3.jpg', 'productUploads/Skytropolis Indoor Theme Park_sky-image3.jpg', 0, '2023-11-16 23:34:29'),
(38, 7, 'Skytropolis Indoor Theme Park_sky-image4.jpg', 'productUploads/Skytropolis Indoor Theme Park_sky-image4.jpg', 0, '2023-11-16 23:34:29'),
(39, 7, 'Skytropolis Indoor Theme Park_sky-image5.jpg', 'productUploads/Skytropolis Indoor Theme Park_sky-image5.jpg', 0, '2023-11-16 23:34:29'),
(40, 8, 'District 21_district21-image1.jpg', 'productUploads/District 21_district21-image1.jpg', 1, '2023-11-16 23:39:07'),
(41, 8, 'District 21_district21-image2.jpg', 'productUploads/District 21_district21-image2.jpg', 0, '2023-11-16 23:39:07'),
(42, 8, 'District 21_district21-image3.jpg', 'productUploads/District 21_district21-image3.jpg', 0, '2023-11-16 23:39:07'),
(43, 8, 'District 21_district21-image4.jpg', 'productUploads/District 21_district21-image4.jpg', 0, '2023-11-16 23:39:07'),
(44, 8, 'District 21_district21-image5.jpg', 'productUploads/District 21_district21-image5.jpg', 0, '2023-11-16 23:39:07'),
(45, 9, 'Langkawi Cable Car_langkawicc-image1.jpg', 'productUploads/Langkawi Cable Car_langkawicc-image1.jpg', 1, '2023-11-16 23:42:48'),
(46, 9, 'Langkawi Cable Car_langkawicc-image2.jpg', 'productUploads/Langkawi Cable Car_langkawicc-image2.jpg', 0, '2023-11-16 23:42:48'),
(47, 9, 'Langkawi Cable Car_langkawicc-image3.jpg', 'productUploads/Langkawi Cable Car_langkawicc-image3.jpg', 0, '2023-11-16 23:42:48'),
(48, 9, 'Langkawi Cable Car_langkawicc-image4.cms', 'productUploads/Langkawi Cable Car_langkawicc-image4.cms', 0, '2023-11-16 23:42:48'),
(49, 9, 'Langkawi Cable Car_langkawicc-image5.jpeg', 'productUploads/Langkawi Cable Car_langkawicc-image5.jpeg', 0, '2023-11-16 23:42:48');

-- --------------------------------------------------------

--
-- Table structure for table `refunds`
--

CREATE TABLE `refunds` (
  `refundID` int(3) NOT NULL,
  `refundStatus` varchar(255) DEFAULT 'AWAITING REFUND',
  `refundDescription` varchar(255) NOT NULL,
  `refundDate` datetime DEFAULT current_timestamp(),
  `orderID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `refunds`
--

INSERT INTO `refunds` (`refundID`, `refundStatus`, `refundDescription`, `refundDate`, `orderID`) VALUES
(1, 'REJECTED', 'I was drunk.', '2023-11-17 01:13:33', 19),
(4, 'AWAITING REFUND', 'My ticket to Ipoh is damaged and I can not make it. TY.', '2023-11-17 01:38:16', 20);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `reviewID` int(11) NOT NULL,
  `reviewDate` datetime NOT NULL DEFAULT current_timestamp(),
  `comments` varchar(255) DEFAULT NULL,
  `rating` int(1) NOT NULL,
  `orderID` int(11) DEFAULT NULL,
  `productID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`reviewID`, `reviewDate`, `comments`, `rating`, `orderID`, `productID`) VALUES
(1, '2023-11-17 00:49:25', 'Absolutely magical experience at Legoland! Our trip was nothing short of a five-star adventure from start to finish. The attention to detail in the Lego creations throughout the park is truly awe-inspiring.', 5, 1, 4),
(2, '2023-11-17 00:51:12', 'We had a great time exploring Melaka! The rich historical charm of the city, with its vibrant colors and diverse cultural influences, made for a memorable trip.', 4, 2, 5),
(3, '2023-11-17 00:52:03', 'Our visit to the Lost World of Tambun was a delightful adventure! The park\'s combination of thrilling rides, engaging attractions, and the natural beauty of its surroundings offered a unique and enjoyable experience.', 5, 3, 6),
(4, '2023-11-17 00:57:56', 'Our visit to Skytropolis Indoor Theme Park was a thrilling experience! The park\'s wide array of indoor rides and attractions provided hours of excitement for visitors of all ages.', 5, 4, 7),
(5, '2023-11-17 00:58:30', 'District 21 is an absolute gem for thrill-seekers and adventure enthusiasts! Our visit to this indoor theme park was nothing short of a five-star experience. The adrenaline-pumping activities, from challenging obstacle courses to heart-racing rides, kept ', 5, 5, 8),
(6, '2023-11-17 00:58:52', 'Langkawi Cable Car offers a breathtaking and unparalleled experience, earning a well-deserved five-star rating. The journey begins with a scenic ride up the lush mountains, providing panoramic views of the stunning Langkawi archipelago.', 5, 6, 9),
(7, '2023-11-17 01:00:32', 'Legoland Malaysia is a fantastic destination for families and Lego enthusiasts, earning a solid four-star rating from our visit. The park\'s themed areas, intricate Lego creations, and engaging rides offer a unique and enjoyable experience.', 4, 7, 4),
(8, '2023-11-17 01:01:22', 'Our Melaka tour was an exceptional five-star experience that exceeded all expectations. The city\'s rich historical and cultural tapestry unfolded before us, creating a journey filled with awe and appreciation.', 5, 8, 5),
(9, '2023-11-17 01:02:05', 'Our visit to the Lost World of Tambun was nothing short of a five-star adventure! This unique theme park seamlessly blends natural wonders with thrilling attractions, creating an unforgettable experience.', 5, 9, 6),
(10, '2023-11-17 01:02:25', 'Skytropolis Indoor Theme Park is a five-star delight for thrill-seekers and family fun enthusiasts alike. The variety of indoor rides and attractions offer an exhilarating experience, ensuring there\'s something for everyone. ', 5, 10, 7),
(11, '2023-11-17 01:02:56', 'District 21 deserves every bit of its five-star rating for delivering an unparalleled adventure experience. This indoor theme park is an absolute thrill-seeker\'s paradise, offering a unique and exciting array of activities.', 5, 11, 8),
(12, '2023-11-17 01:03:19', 'Langkawi Cable Car is a spectacular five-star attraction that offers an unforgettable journey to breathtaking heights. The scenic ride up the lush mountains provides panoramic views of the stunning Langkawi archipelago, creating a mesmerizing experience f', 5, 12, 9),
(13, '2023-11-17 01:04:26', 'Legoland Malaysia is a five-star wonderland for families and Lego enthusiasts alike. From the moment you step into the park, the attention to detail in the Lego creations and themed areas creates a magical and immersive experience.', 5, 13, 4),
(14, '2023-11-17 01:04:55', 'Our Melaka tour was a delightful four-star experience, offering a fascinating glimpse into the city\'s rich history and cultural heritage. The UNESCO World Heritage sites, including Jonker Street and A Famosa, provided captivating insights into Melaka\'s di', 5, 14, 5),
(15, '2023-11-17 01:05:15', 'The Lost World of Tambun is a phenomenal five-star destination that seamlessly blends natural wonders with exhilarating attractions. From the moment we stepped into the park, the lush surroundings and captivating atmosphere set the stage for an unforgetta', 5, 15, 6),
(16, '2023-11-17 01:05:33', 'Skytropolis Indoor Theme Park earns a well-deserved five-star rating for providing an exhilarating and immersive experience. From the moment we stepped into the park, the vibrant atmosphere and exciting array of indoor rides captivated our senses.', 5, 16, 7),
(17, '2023-11-17 01:05:52', 'District 21 is an absolute five-star gem that offers a thrilling and unique adventure experience. From the moment you step into this urban adventure park, the adrenaline starts pumping, and the excitement is palpable.', 5, 17, 8),
(18, '2023-11-17 01:06:12', 'Our experience at the Langkawi Cable Car was a three-star adventure. The breathtaking views of the Langkawi archipelago from the cable car were undeniably impressive, and the SkyBridge at the top offered stunning photo opportunities.', 3, 18, 9);

-- --------------------------------------------------------

--
-- Table structure for table `tourism_ministry_officer`
--

CREATE TABLE `tourism_ministry_officer` (
  `tmoID` int(5) NOT NULL,
  `username` varchar(30) NOT NULL,
  `pwd` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tourism_ministry_officer`
--

INSERT INTO `tourism_ministry_officer` (`tmoID`, `username`, `pwd`, `email`) VALUES
(1, 'TourOfficer', 'abc123', 'tourOfficer@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerID`),
  ADD UNIQUE KEY `fullName` (`fullName`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `pwd` (`pwd`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `merchant`
--
ALTER TABLE `merchant`
  ADD PRIMARY KEY (`merchantID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `pwd` (`pwd`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `shopName` (`shopName`),
  ADD UNIQUE KEY `address` (`contactNo`),
  ADD KEY `tmoID` (`tmoID`);

--
-- Indexes for table `merch_documents`
--
ALTER TABLE `merch_documents`
  ADD PRIMARY KEY (`documentID`),
  ADD KEY `merchantID` (`merchantID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `customerID` (`customerID`),
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productID`),
  ADD UNIQUE KEY `productName` (`productName`),
  ADD KEY `merchantID` (`merchantID`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`imageID`),
  ADD KEY `merchantID` (`productID`);

--
-- Indexes for table `refunds`
--
ALTER TABLE `refunds`
  ADD PRIMARY KEY (`refundID`),
  ADD KEY `orderID` (`orderID`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`reviewID`),
  ADD KEY `orderID` (`orderID`),
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `tourism_ministry_officer`
--
ALTER TABLE `tourism_ministry_officer`
  ADD PRIMARY KEY (`tmoID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `pwd` (`pwd`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `merchant`
--
ALTER TABLE `merchant`
  MODIFY `merchantID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `merch_documents`
--
ALTER TABLE `merch_documents`
  MODIFY `documentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productID` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `imageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `refunds`
--
ALTER TABLE `refunds`
  MODIFY `refundID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reviewID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tourism_ministry_officer`
--
ALTER TABLE `tourism_ministry_officer`
  MODIFY `tmoID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `merchant`
--
ALTER TABLE `merchant`
  ADD CONSTRAINT `merchant_ibfk_1` FOREIGN KEY (`tmoID`) REFERENCES `tourism_ministry_officer` (`tmoID`) ON DELETE SET NULL;

--
-- Constraints for table `merch_documents`
--
ALTER TABLE `merch_documents`
  ADD CONSTRAINT `merch_documents_ibfk_1` FOREIGN KEY (`merchantID`) REFERENCES `merchant` (`merchantID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customer` (`customerID`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`) ON DELETE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`merchantID`) REFERENCES `merchant` (`merchantID`) ON DELETE CASCADE;

--
-- Constraints for table `refunds`
--
ALTER TABLE `refunds`
  ADD CONSTRAINT `refunds_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`) ON DELETE SET NULL,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
