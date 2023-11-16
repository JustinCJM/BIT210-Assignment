-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2023 at 05:08 PM
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
(2, 'Saul Goodman', 'SaulMan', 'poi123', 'male', 'saulgoodman@gmail.com', 348973092),
(3, 'Rob bin Man', 'RobMan', 'poi', 'male', 'robman@gmail.com', 489379084),
(4, 'Mando Ling', 'Mando', 'wewe', 'male', 'justinchuosu@gmail.com', 3423424);

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
(28, 'Kylow', 'gtWY94!*', '', 'sdasda@gmail.com', '394872489', 'Travuhr', 'Goats!', 'ACTIVE', 1),
(30, 'SamW22', 'loRV41^%', '', 'chongjustin511@gmail.com', '0123826383', 'Shop Name', 'Description', 'PENDING', 1);

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
(6, 28, 'Kylowsunrom-185000.pdf', 'pdfuploads/Kylowsunrom-185000.pdf', '2023-10-17 22:56:42', 'Document to be reviewed!'),
(7, 30, 'SamW22Registration.pdf', 'pdfuploads/SamW22Registration.pdf', '2023-10-18 03:49:17', 'Documents to be reviewed');

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
  `quantity` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `merchantID` int(11) NOT NULL,
  `productID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderID`, `orderDate`, `orderStatus`, `billingAddress`, `totalAmount`, `quantity`, `customerID`, `merchantID`, `productID`) VALUES
(1, '2023-11-14 00:07:38', 'UNFULFILLED', 'Jalan Imbi, , 33263, Federal Territory of Putrajaya, Belgium', 39.90, 1, 4, 28, 27);

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
  `quantitySold` int(11) DEFAULT NULL,
  `totalRating` int(11) DEFAULT NULL,
  `avgRating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productID`, `productName`, `productPrice`, `category`, `prodLocation`, `prodDescription`, `merchantID`, `quantitySold`, `totalRating`, `avgRating`) VALUES
(26, 'Haunted House', 89.9, 'Experience', 'Kuala Lumpur', 'Get Spooked', 28, NULL, NULL, NULL),
(27, 'Skii Trip', 39.9, 'Sports', 'Kota Kinabalu', 'Skii Down', 28, NULL, NULL, NULL),
(28, 'Upside-Down Museum', 20, 'Experience', 'Penang', 'Upside-Down!', 28, NULL, NULL, NULL),
(29, 'Hiking Trip', 70.5, 'Sports', 'Broga Hill', 'Hiking', 28, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `imageID` int(11) NOT NULL,
  `productID` int(11) DEFAULT NULL,
  `image_name` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `image_upload_date` datetime DEFAULT curtime()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`imageID`, `productID`, `image_name`, `image_path`, `image_upload_date`) VALUES
(19, 26, 'Haunted House_bagus.png', 'productUploads/Haunted House_bagus.png', '2023-11-08 10:05:40'),
(20, 27, 'Skii Trip_edfrssdf.png', 'productUploads/Skii Trip_edfrssdf.png', '2023-11-08 10:06:12'),
(21, 28, 'Upside-Down Museum_adf.png', 'productUploads/Upside-Down Museum_adf.png', '2023-11-08 10:07:37'),
(22, 29, 'Hiking Trip_Screenshot 2023-01-08 174907.png', 'productUploads/Hiking Trip_Screenshot 2023-01-08 174907.png', '2023-11-08 10:08:57'),
(23, 31, 'KKK gathering with the bros_1200.png', 'productUploads/KKK gathering with the bros_1200.png', '2023-11-13 18:07:00');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `reviewID` int(11) NOT NULL,
  `reviewDate` datetime NOT NULL DEFAULT curtime(),
  `comments` varchar(255) DEFAULT NULL,
  `rating` int(1) NOT NULL,
  `orderID` int(11) DEFAULT NULL,
  `productID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'BobJohnson123', 'password321', 'bobjohnson@example.com');

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
  MODIFY `customerID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `merchant`
--
ALTER TABLE `merchant`
  MODIFY `merchantID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `merch_documents`
--
ALTER TABLE `merch_documents`
  MODIFY `documentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productID` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `imageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reviewID` int(11) NOT NULL AUTO_INCREMENT;

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
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`) ON DELETE SET NULL,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
