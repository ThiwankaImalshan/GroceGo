-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2024 at 05:04 PM
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
-- Database: `grocgo`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`) VALUES
(1, 'vegetables'),
(2, 'fruits');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(60) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `availability` varchar(50) DEFAULT NULL,
  `top` tinyint(1) DEFAULT NULL,
  `subcategory_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `price`, `image`, `description`, `availability`, `top`, `subcategory_id`) VALUES
('fru1001', 'Organic Mango', 1700.00, NULL, 'Fresh organic mango', NULL, NULL, 4),
('fru1002', 'Organic Papaya', 570.00, NULL, 'Fresh organic papaya', 'out of stock', 1, 4),
('fru1003', 'Organic Pineapple', 1248.00, NULL, 'Fresh organic pineapple', NULL, NULL, 4),
('fru1004', 'Organic Watermelon', 330.00, NULL, 'Fresh organic watermelon', NULL, 1, 4),
('fru2001', 'Apple', 2290.00, NULL, 'Fresh apples', NULL, NULL, 5),
('fru2002', 'Banana-Ambul', 310.00, NULL, 'Fresh bananas', NULL, NULL, 5),
('fru2003', 'Orange', 1720.00, NULL, 'Fresh oranges', NULL, NULL, 5),
('fru2004', 'Strawberry', 1250.00, NULL, 'Fresh strawberry', 'out of stock', NULL, 5),
('veg1001', 'Organic Carrot', 900.00, NULL, 'Fresh organic carrot', 'in stock', NULL, 1),
('veg1002', 'Organic Green Beans', 460.00, NULL, 'Fresh organic green beans', 'out of stock', NULL, 1),
('veg1003', 'Organic Sweet Potato', 570.00, NULL, 'Fresh organic sweet potato', 'in stock', NULL, 1),
('veg2001', 'Potato', 410.00, NULL, 'Fresh potato', NULL, NULL, 2),
('veg2002', 'Salad Leaves', 170.00, NULL, 'Fresh salad leaves', NULL, NULL, 2),
('veg2003', 'Lime', 960.00, NULL, 'Fresh lime', 'out of stock', NULL, 2),
('veg2004', 'Kekiri', 90.00, NULL, 'Fresh kekiri', NULL, 1, 2),
('veg2005', 'Bringles', 320.00, NULL, 'Fresh bringles', NULL, 1, 2),
('veg2006', 'Cabbage', 230.00, NULL, 'Fresh cabbage', NULL, 1, 2),
('veg3001', 'Gotukola Packet', 130.00, NULL, 'Fresh gotukola packet', NULL, NULL, 3),
('veg3002', 'Kankun Packet', 130.00, NULL, 'Fresh kankun packet', NULL, NULL, 3),
('veg3003', 'Mukunuwenna Packet', 130.00, NULL, 'Fresh Mukunuwenna', NULL, NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `subcategory_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`subcategory_id`, `name`, `category_id`) VALUES
(1, 'Organic', 1),
(2, 'Inorganic', 1),
(3, 'Packets', 1),
(4, 'Organic', 2),
(5, 'Inorganic', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `subcategory_id` (`subcategory_id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`subcategory_id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `subcategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`subcategory_id`);

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
