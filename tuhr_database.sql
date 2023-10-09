-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2023 at 11:34 AM
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
-- Database: `tuhr_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customerID` int(5) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `username` varchar(30) NOT NULL,
  `pwd` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `billingAddress` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `merchants`
--

CREATE TABLE `merchants` (
  `merchantID` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `shopName` varchar(100) NOT NULL,
  `merchDescription` varchar(255) DEFAULT NULL,
  `regStatus` varchar(50) NOT NULL,
  `tmoID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` int(9) NOT NULL,
  `orderDate` datetime NOT NULL DEFAULT curtime(),
  `orderStatus` varchar(30) NOT NULL,
  `billingAddress` varchar(255) NOT NULL,
  `totalAmount` int(6) NOT NULL,
  `customerID` int(11) NOT NULL,
  `merchantID` int(11) NOT NULL,
  `productID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productID` int(9) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `productPrice` float NOT NULL,
  `category` varchar(30) NOT NULL,
  `prodLocation` varchar(50) NOT NULL,
  `prodDescription` varchar(255) NOT NULL,
  `maxQuantity` int(5) DEFAULT NULL,
  `merchantID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `refund_request`
--

CREATE TABLE `refund_request` (
  `refundID` int(9) NOT NULL,
  `refundDate` datetime NOT NULL DEFAULT curtime(),
  `refundReason` varchar(100) NOT NULL,
  `refundComemnt` varchar(255) NOT NULL,
  `refundStatus` varchar(50) NOT NULL,
  `customerID` int(11) NOT NULL,
  `orderID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `reviewID` int(10) NOT NULL,
  `reviewDate` date NOT NULL DEFAULT curdate(),
  `comment` varchar(255) DEFAULT NULL,
  `rating` int(1) NOT NULL,
  `orderID` int(11) NOT NULL,
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
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customerID`),
  ADD UNIQUE KEY `customerID` (`customerID`),
  ADD UNIQUE KEY `fullName` (`fullName`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `pwd` (`pwd`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `merchants`
--
ALTER TABLE `merchants`
  ADD PRIMARY KEY (`merchantID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `address` (`address`),
  ADD UNIQUE KEY `shopName` (`shopName`),
  ADD KEY `tmoID` (`tmoID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `customerID` (`customerID`),
  ADD KEY `merchantID` (`merchantID`),
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productID`),
  ADD UNIQUE KEY `productName` (`productName`),
  ADD UNIQUE KEY `merchantID` (`merchantID`);

--
-- Indexes for table `refund_request`
--
ALTER TABLE `refund_request`
  ADD PRIMARY KEY (`refundID`),
  ADD UNIQUE KEY `orderID` (`orderID`),
  ADD KEY `customerID` (`customerID`);

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
  ADD UNIQUE KEY `tmoID` (`tmoID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `pwd` (`pwd`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customerID` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `merchants`
--
ALTER TABLE `merchants`
  MODIFY `merchantID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productID` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `refund_request`
--
ALTER TABLE `refund_request`
  MODIFY `refundID` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reviewID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tourism_ministry_officer`
--
ALTER TABLE `tourism_ministry_officer`
  MODIFY `tmoID` int(5) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `merchants`
--
ALTER TABLE `merchants`
  ADD CONSTRAINT `merchants_ibfk_1` FOREIGN KEY (`tmoID`) REFERENCES `tourism_ministry_officer` (`tmoID`) ON DELETE SET NULL;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customers` (`customerID`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`merchantID`) REFERENCES `merchants` (`merchantID`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`productID`) REFERENCES `products` (`productID`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`merchantID`) REFERENCES `merchants` (`merchantID`) ON DELETE CASCADE;

--
-- Constraints for table `refund_request`
--
ALTER TABLE `refund_request`
  ADD CONSTRAINT `refund_request_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customers` (`customerID`) ON DELETE CASCADE,
  ADD CONSTRAINT `refund_request_ibfk_2` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`) ON DELETE NO ACTION,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `products` (`productID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
