-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2024 at 05:56 AM
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
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categories_name` varchar(17) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `subcategories_name` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `products_id` int(11) NOT NULL,
  `products_name` varchar(24) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `products_price` decimal(5,1) DEFAULT NULL,
  `products_image` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `products_description` varchar(38) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `products_availability` varchar(12) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `products_top` varchar(4) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categories_name`, `subcategories_name`, `products_id`, `products_name`, `products_price`, `products_image`, `products_description`, `products_availability`, `products_top`) VALUES
('vegetables', 'Organic', 1, 'Organic Carrot', 800.0, 'product img/Organic Carrot.jpg', 'Fresh organic carrot', 'in stock', NULL),
('vegetables', 'Organic', 2, 'Organic Green Beans', 460.0, 'product img/Organic Green Beans.jpg', 'Fresh organic green beans', 'out of stock', NULL),
('vegetables', 'Organic', 3, 'Organic Sweet Potato', 570.0, 'product img/Organic Sweet Potato.jpg', 'Fresh organic sweet potato', 'in stock', NULL),
('vegetables', 'Inorganic', 4, 'Potato', 410.0, 'product img/Potato.png', 'Fresh potato', NULL, NULL),
('vegetables', 'Inorganic', 5, 'Salad Leaves', 170.0, 'product img/Salad Leaves.jpeg', 'Fresh salad leaves', NULL, NULL),
('vegetables', 'Inorganic', 6, 'Lime', 960.0, 'product img/Lime.jpg', 'Fresh lime', 'out of stock', NULL),
('vegetables', 'Inorganic', 7, 'Kekiri', 90.0, 'product img/Kekiri.jpg', 'Fresh kekiri', NULL, 'True'),
('vegetables', 'Inorganic', 8, 'Bringles', 320.0, 'product img/Bringles.png', 'Fresh bringles', NULL, ''),
('vegetables', 'Inorganic', 9, 'Cabbage', 230.0, 'product img/Cabbage.jpg', 'Fresh cabbage', NULL, 'True'),
('vegetables', 'Packets', 10, 'Gotukola Packet', 130.0, 'product img/Gotukola Packet.jpeg', 'Fresh gotukola packet', NULL, NULL),
('vegetables', 'Packets', 11, 'Kankun Packet', 130.0, 'product img/Kankun Packet.jpg', 'Fresh kankun packet', NULL, NULL),
('vegetables', 'Packets', 12, 'Mukunuwenna Packet', 130.0, 'product img/Mukunuwenna Packet.jpeg', 'Fresh Mukunuwenna', NULL, NULL),
('fruits', 'Organic', 13, 'Organic Mango', 1000.0, 'product img/Organic Mango.jpg', 'Fresh organic mango', NULL, NULL),
('fruits', 'Organic', 14, 'Organic Papaya', 570.0, 'product img/Organic Papaya.jpg', 'Fresh organic papaya', 'out of stock', 'True'),
('fruits', 'Organic', 15, 'Organic Pineapple', 1000.0, 'product img/Organic Pineapple.jpg', 'Fresh organic pineapple', NULL, NULL),
('fruits', 'Organic', 16, 'Organic Watermelon', 330.0, 'product img/Organic Watermelon.jpg', 'Fresh organic watermelon', NULL, 'True'),
('fruits', 'Inorganic', 17, 'Apple', 1000.0, 'product img/apple.jpg', 'Fresh apples', NULL, NULL),
('fruits', 'Inorganic', 18, 'Banana-Ambul', 310.0, 'product img/Banana.jpg', 'Fresh bananas', NULL, NULL),
('fruits', 'Inorganic', 19, 'Orange', 1000.0, 'product img/Orange.jpg', 'Fresh oranges', NULL, NULL),
('fruits', 'Inorganic', 20, 'Strawberry', 1000.0, 'product img/Strawberry.jpg', 'Fresh strawberry', 'out of stock', NULL),
('meats', 'Fresh Meat', 21, 'Chicken', 1300.0, 'product img/Chicken Skinless.jpg', 'Fresh chicken thigh skinless', NULL, NULL),
('meats', 'Fresh Meat', 22, 'Pork', 1000.0, 'product img/Pork Boneless.jpg', 'Fresh curry pork rind on boneless', NULL, NULL),
('meats', 'Fresh Meat', 23, 'Chicken Wings', 1000.0, 'product img/Chicken Wings.jpg', 'Fresh chicken wings', NULL, 'True'),
('meats', 'Processed Meat Serve Over', 24, 'Pork Boneless', 1000.0, 'product img/Pork Millennium Ham Boneless.jpg', 'Fresh Pork Millennium Ham Boneless', NULL, NULL),
('meats', 'Processed Meat Serve Over', 25, 'Pork Smoked Leg', 1000.0, 'product img/Pork Smoked Leg Of Ham.jpg', 'Fresh Pork Smoked Leg Of Ham', NULL, NULL),
('meats', 'Processed Meat Serve Over', 26, 'Chicken Ham', 1000.0, 'product img/Honey Glazed Chicken Ham.jpg', 'Fresh Honey Glazed Chicken Ham', NULL, NULL),
('meats', 'Frozen Chicken', 27, 'Whole Chicken', 1000.0, 'product img/Bairaha Whole Chicken.jpg', 'Fresh Bairaha Whole Chicken', NULL, NULL),
('meats', 'Frozen Chicken', 28, 'Chicken Skinless', 1000.0, 'product img/Bairaha Pre Cut Chicken Skinless.jpg', 'Fresh Bairaha Pre Cut Chicken Skinless', NULL, NULL),
('meats', 'Frozen Chicken', 29, 'Roasted Turkey', 1000.0, 'product img/Roasted Turkey.jpg', 'Fresh Roasted Turkey', NULL, NULL),
('fish', 'Fresh Sea Food', 30, 'Sudaya', 490.0, 'product img/Sudaya.jpg', 'Fresh Sudaya', NULL, NULL),
('fish', 'Fresh Sea Food', 31, 'Alagoduwa', 1000.0, 'product img/Alagoduwa.jpg', 'Fresh Alagoduwa', NULL, NULL),
('fish', 'Fresh Sea Food', 32, 'Thalapath', 1000.0, 'product img/Thalapath.jpg', 'Fresh thalapath small', NULL, 'True'),
('rice', 'Local Rice', 33, 'Nadu 5Kg', 1000.0, 'product img/Araliya Nadu 5Kg.jpeg', 'Araliya nadu rice 5Kg', NULL, 'True'),
('rice', 'Local Rice', 34, 'Samba 5Kg', 1000.0, 'product img/Araliya Samba 5Kg.jpeg', 'Araliya samba rice 5Kg', NULL, NULL),
('rice', 'Local Rice', 35, 'Nadu 10Kg', 1000.0, 'product img/Araliya Nadu 10Kg.jpeg', 'Araliya nadu rice 10Kg', NULL, NULL),
('rice', 'Imported Rice', 36, 'Basmathi 5Kg', 1000.0, 'product img/Basmathi 5Kg.jpg', 'Basmathi rice 5Kg', NULL, NULL),
('rice', 'Imported Rice', 37, 'Basmathi 1Kg', 650.0, 'product img/Basmathi 1Kg.jpg', 'Basmathi rice 1Kg', NULL, NULL),
('beverages', 'Juices & Carbonates', 38, 'Coca Cola 1.5L', 400.0, 'product img/Coca Cola Pet 1.5L.jpg', 'Coca Cola Pet 1.5L', NULL, NULL),
('beverages', 'Juices & Carbonates', 39, 'Orange Crush 1.5L', 380.0, 'product img/Orange Crush 1.5L.jpg', 'Orange Crush 1.5L', NULL, NULL),
('beverages', 'Juices & Carbonates', 40, 'Necto 1L', 270.0, 'product img/Necto 1L.jpg', 'Necto 1L', NULL, NULL),
('beverages', 'Malt Drink', 41, 'Horlicks 175g', 560.0, 'product img/Horlicks Original Pack 175g.jpg', 'Horlicks Original Pack 175g', NULL, NULL),
('beverages', 'Malt Drink', 42, 'Milo 400g', 890.0, 'product img/Milo Packet 400g.jpg', 'Milo Packet 400g', NULL, NULL),
('beverages', 'Malt Drink', 43, 'Nestomalt 175g', 390.0, 'product img/Nestomalt Actigen Pkt 175g.jpg', 'Nestomalt Actigen Pkt 175g', NULL, NULL),
('beverages', 'Sports & Energy Drinks', 44, 'Red Bull 250ml', 900.0, 'product img/Red Bull Energy Drink 250ml.jpg', 'Red Bull Energy Drink 250ml', NULL, NULL),
('beverages', 'Milk & Creamers', 45, 'Anchor Milk Powder 200g', 555.0, 'product img/Anchor Full Cream Milk Powder 200g.jpg', 'Anchor Full Cream Milk Powder 200g', NULL, NULL),
('beverages', 'Milk & Creamers', 46, 'Ratthi Milk Powder 200g', 555.0, 'product img/Ratthi Full Cream Milk Powder 200g.jpg', 'Ratthi Full Cream Milk Powder 200g', NULL, NULL),
('beverages', 'Water', 47, 'Scan Water 500ml', 80.0, 'product img/Scan Mineral Water 500ml.jpg', 'Scan Mineral Water 500ml', NULL, NULL),
('chilled', 'Desserts', 48, 'Richlife Set Kiri 450g', 380.0, 'product img/Richlife Set Kiri 450g.jpg', 'Richlife Set Kiri 450g', NULL, NULL),
('chilled', 'Desserts', 49, 'Richlife Set Kiri 900ml', 650.0, 'product img/Richlife Set Kiri 900ml.jpg', 'Richlife Set Kiri 900ml', NULL, NULL),
('chilled', 'Cheese', 50, 'Happy Cow Cheese', 1000.0, 'product img/Cheese Portion Regular 200g.jpg', 'H/Cow Cheese Portion Regular 200g', NULL, NULL),
('chilled', 'Yoghurt', 51, 'Richlife Yoghurt', 80.0, 'product img/Richlife Set Yoghurt 80ml.jpg', 'Richlife Set Yoghurt 80ml', NULL, 'True'),
('chilled', 'Yoghurt', 52, 'Kotmale Yoghurt Drink', 160.0, 'product img/Kotmale Yoghurt Drink 180ml.jpg', 'Kotmale Yoghurt Drink 180ml', NULL, NULL),
('grocery', 'Pasta & Noodles', 53, 'Kottu Mee Chicken 78g', 117.0, 'product img/Prima Kottu Mee Chicken 78g.jpg', 'Prima Kottu Mee Chicken 78g', NULL, NULL),
('grocery', 'Pasta & Noodles', 54, 'Instant Noodles 325g', 351.0, 'product img/Prima Instant Noodles 325g.jpg', 'Prima Instant Noodles 325g', NULL, NULL),
('grocery', 'Pasta & Noodles', 55, 'Plain Noodles 400g', 330.0, 'product img/Harischandra Plain Noodles 400g.jpg', 'Harischandra Plain Noodles 400g', NULL, NULL),
('grocery', 'Snacks', 56, 'Cocktail Mixture 100g', 285.0, 'product img/Cocktail Mixture 100g.jpg', 'Cocktail Mixture 100g', NULL, NULL),
('grocery', 'Snacks', 57, 'Pop Classic 10g', 60.0, 'product img/Pop Classic 10g.jpg', 'Pop Classic 10g', NULL, NULL),
('grocery', 'Snacks', 58, 'Jumbo Peanut 35g', 150.0, 'product img/Scan Jumbo Peanut 35g.jpg', 'Scan Jumbo Peanut 35g', NULL, NULL),
('grocery', 'Cerials', 59, 'Yahaposha 500g', 348.0, 'product img/Yahaposha 500g.jpg', 'Yahaposha 500g', NULL, NULL),
('grocery', 'Cerials', 60, 'Corn Flakes 250g', 699.0, 'product img/Corn Flakes 250g.jpg', 'Corn Flakes 250g', NULL, NULL),
('grocery', 'Cerials', 61, 'Samaposha 200g', 185.0, 'product img/Samaposha 200g.jpg', 'Samaposha 200g', NULL, NULL),
('grocery', 'Oils', 62, 'Coconut Oil 1L', 1000.0, 'product img/Fortune Coconut Oil 1L.jpg', 'Fortune Coconut Oil 1L', NULL, NULL),
('grocery', 'Oils', 63, 'Cooking Oil 1L', 1000.0, 'product img/Marina Cooking Oil 1L.jpg', 'Marina Cooking Oil 1L', NULL, NULL),
('grocery', 'Oils', 64, 'Fortune Vegetable Oil 2L', 1000.0, 'product img/Fortune Vegetable Oil 2L.jpg', 'Fortune Vegetable Oil 2L', NULL, NULL),
('grocery', 'Sauces', 65, 'Chillie Garlic Sauce', 442.0, 'product img/Kist Chillie Garlic Sauce 375g.jpg', 'Kist Chillie Garlic Sauce 375g', NULL, NULL),
('grocery', 'Sauces', 66, 'Md Tomato Sauce', 426.0, 'product img/Md Tomato Sauce 400g.jpg', 'Md Tomato Sauce 400g', NULL, NULL),
('grocery', 'Sauces', 67, 'Oyster Sauce 385g', 510.0, 'product img/Edinborough Oyster Sauce 385g.jpg', 'Edinborough Oyster Sauce 385g', NULL, NULL),
('grocery', 'Flour', 68, 'Hopper Flour 400g', 220.0, 'product img/Mdk Hopper Flour 400g.jpg', 'Mdk Hopper Flour 400g', NULL, NULL),
('grocery', 'Flour', 69, 'Atta Flour 1kg', 590.0, 'product img/Mogrills Atta Flour 1kg.jpg', 'Mogrills Atta Flour 1kg', NULL, NULL),
('grocery', 'Flour', 70, 'Undu Flour 200g', 558.0, 'product img/Ruhunu Undu Flour 200g.jpg', 'Ruhunu Undu Flour 200g', NULL, NULL),
('grocery', 'Biscuits', 71, 'Lemon Puff 200g', 250.0, 'product img/Maliban Lemon Puff 200g.jpg', 'Maliban Lemon Puff 200g', NULL, NULL),
('grocery', 'Biscuits', 72, 'Ginger Biscuit 85g', 120.0, 'product img/Munchee Ginger Biscuit 85g.jpg', 'Munchee Ginger Biscuit 85g', NULL, NULL),
('grocery', 'Biscuits', 73, 'Maliban Cream Cracker', 140.0, 'product img/Maliban Smart Cream Crackers 125g.jpg', 'Maliban Smart Cream Crackers 125g', NULL, NULL),
('grocery', 'Biscuits', 74, 'Marie Chocolate', 100.0, 'product img/Munchee Marie Chocolate 90g.jpg', 'Munchee Marie Chocolate 90g', NULL, NULL),
('grocery', 'Biscuits', 75, 'Gem Biscuits', 120.0, 'product img/Munchee Gem Biscuits 100g.jpg', 'Munchee Gem Biscuits 100g', NULL, NULL),
('grocery', 'Sugar', 76, 'White Sugar', 265.0, 'product img/White Sugar Bulk.jpg', 'White Sugar Bulk', NULL, NULL),
('grocery', 'Sugar', 77, 'Brown Sugar Bulk', 440.0, 'product img/Brown Sugar Bulk.jpg', 'Brown Sugar Bulk', NULL, NULL),
('grocery', 'Eggs', 78, 'Medium Eggs 10S', 643.0, 'product img/Medium Eggs 10S.jpg', 'Medium Eggs 10S', NULL, NULL),
('grocery', 'Eggs', 79, 'Brown Egg 10S', 649.0, 'product img/Brown Egg 10S.jpg', 'Brown Egg 10S', NULL, NULL),
('pharmacy', 'Skin & Hair Care', 80, 'Olive Oil 28ml', 480.0, 'product img/Olive Oil 28ml.jpg', 'Olive Oil 28ml', NULL, NULL),
('pharmacy', 'First Aid', 81, 'Dettol 60ml', 210.0, 'product img/Dettol Liquid Small 60ml.jpg', 'Dettol Liquid Small 60ml', NULL, NULL),
('pharmacy', 'First Aid', 82, 'Dettol Plaster 10S', 200.0, 'product img/Dettol Plaster 10S.jpg', 'Dettol Plaster 10S', NULL, NULL),
('pharmacy', 'First Aid', 83, 'Cotton Wool 30g', 395.0, 'product img/Cotton Wool 30g.jpg', 'Cotton Wool 30g', NULL, NULL),
('pharmacy', 'Lifestyle & Wellbeing', 84, 'Five Herbals 100g', 160.0, 'product img/Five Herbals 100g.jpg', 'Five Herbals 100g', NULL, NULL),
('pharmacy', 'Lifestyle & Wellbeing', 85, 'Polpala 50g', 125.0, 'product img/Polpala 50g.jpg', 'Polpala 50g', NULL, NULL),
('bakery production', 'Bakery', 86, 'Sandwich Bread', 280.0, 'product img/Sandwich Bread 450g.jpg', 'Sandwich Bread 450g', NULL, NULL),
('bakery production', 'Bakery', 87, 'Roast Bread', 135.0, 'product img/Roast Bread.jpg', 'Roast Bread', NULL, NULL),
('bakery production', 'Bakery', 88, 'Chocolate Muffin', 250.0, 'product img/Chocolate Muffin.jpg', 'Chocolate Muffin', NULL, NULL),
('homeware', 'Tools', 89, 'Paint Brush', 550.0, 'product img/Paint Brush 2 Inch.jpg', 'Paint Brush 2 Inch', NULL, NULL),
('homeware', 'Tools', 90, 'Steel Brush Plastic', 668.0, 'product img/Steel Brush Plastic.jpg', 'Steel Brush Plastic', NULL, NULL),
('homeware', 'Tools', 91, 'Insulating Tape 2Inch', 195.0, 'product img/Insulating Tape 2Inch.jpg', 'Insulating Tape 2Inch', NULL, NULL),
('homeware', 'Kitchenware', 92, 'Tea Spoon', 330.0, 'product img/Tea Spoon.jpg', 'Tea Spoon', NULL, NULL),
('homeware', 'Kitchenware', 93, 'Non Stick Spoon', 1000.0, 'product img/Non Stick Spoon.jpg', 'Non Stick Spoon', NULL, NULL),
('homeware', 'Kitchenware', 94, 'Serving Fork', 400.0, 'product img/Serving Fork.jpg', 'Serving Fork', NULL, NULL),
('homeware', 'General Needs', 95, 'Candle Pack', 305.0, 'product img/Tealight Candle Pack 8S 2H Burn.jpg', 'Tealight Candle Pack 8S 2H Burn', NULL, NULL),
('homeware', 'General Needs', 96, 'Panasonic AA Battery', 780.0, 'product img/Panasonic Battery 6T 2B Aa.jpg', 'Panasonic Al/Battery 6T/2B-Aa', NULL, NULL),
('homeware', 'Greeting Cards', 97, 'Greeting Cards', 360.0, 'product img/Tycoon Greeting Cards 60Rp.jpg', 'Tycoon Greeting Cards 60Rp', NULL, NULL),
('homeware', 'Books & Stationry', 98, 'Single Rule Book 120Pgs', 140.0, 'product img/Atlas Single Rule Exe. Book 120Pgs.jpg', 'Atlas Single Rule Exe. Book 120Pgs', NULL, NULL),
('homeware', 'Books & Stationry', 99, 'Atlas Blue Pens', 85.0, 'product img/Atlas Chooty 11 3In Pac Blue.jpg', 'Atlas Chooty 11 3In Pac Blue', NULL, NULL),
('homeware', 'Books & Stationry', 100, 'Atlas Glue 50ml', 75.0, 'product img/Atlas Glue Bottle 50ml.jpg', 'Atlas Glue Bottle 50ml', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(60) NOT NULL,
  `customer_photo` varchar(60) NOT NULL,
  `customer_email` varchar(60) NOT NULL,
  `customer_phone` int(60) NOT NULL,
  `customer_password` varchar(60) NOT NULL,
  `customer_from` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_name`, `customer_photo`, `customer_email`, `customer_phone`, `customer_password`, `customer_from`) VALUES
(1, 'Thiwanka', 'Person1.png', 'thiwanka@gmail.com', 766123456, '12345', ''),
(2, 'Amal', 'Person2.png', 'amal@gmail.com', 751234567, '12345', ''),
(4, 'Kamal', '', 'kamal@gmail.com', 712345678, '12345', '');

-- --------------------------------------------------------

--
-- Table structure for table `delivers`
--

CREATE TABLE `delivers` (
  `deliver_id` int(11) NOT NULL,
  `deliver_name` varchar(60) NOT NULL,
  `deliver_password` varchar(60) NOT NULL,
  `deliver_email` varchar(60) NOT NULL,
  `delivery_contact` varchar(60) NOT NULL,
  `deliver_photo` varchar(60) NOT NULL,
  `deliver_vehicle` varchar(60) NOT NULL,
  `deliver_numplate` varchar(60) NOT NULL,
  `deliver_from` varchar(60) NOT NULL,
  `deliver_status` varchar(60) NOT NULL,
  `order_id` int(60) NOT NULL,
  `confirmation_code` varchar(32) DEFAULT NULL,
  `confirmed` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivers`
--

INSERT INTO `delivers` (`deliver_id`, `deliver_name`, `deliver_password`, `deliver_email`, `delivery_contact`, `deliver_photo`, `deliver_vehicle`, `deliver_numplate`, `deliver_from`, `deliver_status`, `order_id`, `confirmation_code`, `confirmed`) VALUES
(1001, 'Kasun', '12345', 'kasun@gmail.com', '0712345678', 'Person1.png', 'Threewheeler', '', 'Colombo', 'assigned', 70, NULL, 0),
(1002, 'Manel', '12345', 'manel@gmail.com', '0766123456', 'profile_66a4cbd7ef9e78.95228954.jpg', 'Bike', 'NumPlate.png', 'Panadura', 'assigned', 64, NULL, 0),
(1003, 'Pramod', '12345', 'pramod@gmail.com', '0712345678', 'Person3.jpg', 'Truck', '', 'Dehiwala', 'assigned', 87, NULL, 0),
(1004, 'Tharusha', '12345', 'tharusha@gmail.com', '0766123456', 'ProfilePic1.jpg', 'Threewheeler', '', 'Kelaniya', 'assigned', 70, NULL, 0),
(1005, 'Lakshan', '12345', 'lakshan@gmail.com', '0712345678', 'ProfilePic2.avif', 'Truck', '', 'Gampaha', 'available', 0, NULL, 0),
(1006, 'Roshan', '12345', 'roshan@gmail.com', '0766123456', 'ProfilePic4.jpg', 'Bike', '', 'Malabe', 'assigned', 88, NULL, 0),
(1012, 'Thiwanka', '12345', 'thiwankaimalshan64@gmail.com', '0710441234', 'DefaultPro.png', 'Threewheeler', '', 'Colombo', 'assigned', 80, '18f1d0ec640968034414fb2cf8896db8', 1),
(1013, 'Imalshan', '12345', 'thiwankaimalshan2001@gmail.com', '0710445678', 'DefaultPro.png', 'Bike', '', 'Dehiwala', '', 0, '0378d187a70855aaaede2198edf8be92', 1),
(1015, 'Anura', '12345', 'thiwankaimalshan64@gmail.com', '0712345678', 'DefaultPro.png', 'Truck', '', 'Gampaha', '', 0, 'f7a35c46baa723bf46781c10f2409d5e', 0),
(1017, 'Kamindu', '12345', 'thiwankaimalshan64@gmail.com', '0712345678', 'DefaultPro.png', 'Threewheeler', '', 'Colombo', '', 0, '5708cbe80905115816bd405b431a609f', 0),
(1019, 'Silva', '12345', 'thiwankaimalshan64@gmail.com', '0710441234', 'DefaultPro.png', 'Bike', '', 'Kelaniya', 'unavailable', 0, '944a0f859859b1b2142770564d773b5e', 1);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_details`
--

CREATE TABLE `delivery_details` (
  `delivery_id` int(11) NOT NULL,
  `delivery_name` varchar(60) NOT NULL,
  `delivery_price` int(60) NOT NULL,
  `delivery_payment` varchar(60) NOT NULL,
  `delivery_status` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery_details`
--

INSERT INTO `delivery_details` (`delivery_id`, `delivery_name`, `delivery_price`, `delivery_payment`, `delivery_status`) VALUES
(1, 'Apple', 100, 'Paid', 'Delivered'),
(2, 'Banana', 200, 'Due', 'Pending'),
(3, 'Mango', 300, 'Paid', 'Return'),
(4, 'Grapes', 400, 'Due', 'In Progress');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_name` varchar(60) NOT NULL,
  `order_email` varchar(60) NOT NULL,
  `order_phone` int(60) NOT NULL,
  `order_price` int(60) NOT NULL,
  `order_deliveryCharge` int(60) NOT NULL,
  `order_payment` varchar(60) NOT NULL,
  `order_status` varchar(60) NOT NULL,
  `order_address` varchar(100) NOT NULL,
  `order_city` varchar(60) NOT NULL,
  `order_postal_code` int(60) NOT NULL,
  `order_details` varchar(1000) NOT NULL,
  `order_deliver` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_name`, `order_email`, `order_phone`, `order_price`, `order_deliveryCharge`, `order_payment`, `order_status`, `order_address`, `order_city`, `order_postal_code`, `order_details`, `order_deliver`) VALUES
(62, 'Amal Nishantha', 'amalnishantha@gmail.com', 761234567, 1770, 150, 'Paid', 'Delivered', 'No 10, Walmert Road, Colombo 10.', 'colombo 10', 1000, '[{\"product_id\":\"39\",\"quantity\":2},{\"product_id\":\"40\",\"quantity\":3}]', 'Manel'),
(63, 'Kamindu Mendis', 'kamindumendis@gmail.com', 112345678, 550, 150, 'Paid', 'Delivered', 'No 10, Kawdana Road, Dehiwala.', 'kawdana', 10350, '[{\"product_id\":\"9\",\"quantity\":2},{\"product_id\":\"7\",\"quantity\":1}]', 'Kasun'),
(64, 'Nayanathara Alwiz', 'nayanatharaalwiz@gmail.com', 112345678, 180, 100, 'Paid', 'Delivered', 'No 10, Waidya Road, Dehiwala.', 'dehiwala', 10370, '[{\"product_id\":\"7\",\"quantity\":2}]', 'Manel'),
(65, 'Adithya Gamlath', 'adithyagamlath@gmail.com', 112345678, 380, 100, 'Due', 'Pending', 'No 10, Fonseka Road, Panadura.', 'fonseka rd', 10400, '[{\"product_id\":\"7\",\"quantity\":2}]', 'Kasun'),
(66, 'Gauri Amasha', 'gauriamasha@gmail.com', 112345678, 180, 200, 'Due', 'Pending', 'No 10, Station Road, Bambalapitiya.', 'bambalapitiya - colombo', 300, '[{\"product_id\":\"7\",\"quantity\":2}]', ''),
(67, 'Himasha Sewmini', 'himashasewmini', 712345678, 1980, 200, 'Paid', 'Delivered', 'No, 460, Galle Road, Colombo', 'bambalapitiya - colombo', 300, '[{\"product_id\":\"7\",\"quantity\":2},{\"product_id\":\"33\",\"quantity\":1},{\"product_id\":\"37\",\"quantity\":1}]', 'Manel'),
(68, 'Arawinda Silva', 'arawindasilva@gmail.com', 712345678, 2240, 200, 'Due', 'Pending', 'No, 100, Waragoda Road, Kelaniya', 'waragoda', 11300, '[{\"product_id\":\"7\",\"quantity\":1},{\"product_id\":\"33\",\"quantity\":2}]', ''),
(69, 'Arawinda Silva', 'arawindasilva@gmail.com', 712345678, 2290, 150, 'Due', 'Pending', 'No 100, Waragoda Road, Kelaniya', 'waragoda', 11400, '[{\"product_id\":\"7\",\"quantity\":1},{\"product_id\":\"33\",\"quantity\":2}]', 'Manel'),
(70, 'Arawinda Silva', 'arawindasilva@gmail.com', 712345678, 2290, 150, 'Due', 'Pending', 'No 100, Waragoda Road, Kelaniya', 'waragoda', 11400, '[{\"product_id\":\"7\",\"quantity\":1},{\"product_id\":\"33\",\"quantity\":2}]', ''),
(71, 'Sanjeewa Perera', 'sanjeewa.perera@gmail.com', 771234567, 2218, 180, 'Due', 'Pending', 'No. 123, Galle Road, Colombo 03', 'colombo 03', 300, '[{\"product_id\":\"82\",\"quantity\":1},{\"product_id\":\"81\",\"quantity\":1},{\"product_id\":\"83\",\"quantity\":1},{\"product_id\":\"89\",\"quantity\":1},{\"product_id\":\"90\",\"quantity\":1},{\"product_id\":\"91\",\"quantity\":1}]', ''),
(72, 'Sanjaya Perera', 'sanjaya.perera@gmail.com', 771234567, 1005, 200, 'Due', 'Pending', 'No. 123, Galle Road, Colombo 03', 'colombo 03', 300, '[{\"product_id\":\"82\",\"quantity\":1},{\"product_id\":\"81\",\"quantity\":1},{\"product_id\":\"83\",\"quantity\":1}]', ''),
(73, 'Sandanari Umayangana', 'sandanariproduction@gmail.com', 771234567, 1005, 130, 'Due', 'Pending', 'No. 123, Galle Road, Kollupitiya', 'kollupitiya', 300, '[{\"product_id\":\"82\",\"quantity\":1},{\"product_id\":\"81\",\"quantity\":1},{\"product_id\":\"83\",\"quantity\":1}]', ''),
(74, 'Asanka Fernando', 'thiwankaimalshan2001@gmail.com', 712345678, 725, 100, 'Due', 'Pending', 'No, 100, Niwadawa Road, Aruggoda.', 'aruggoda', 12524, '[{\"product_id\":\"81\",\"quantity\":1},{\"product_id\":\"83\",\"quantity\":1}]', ''),
(75, 'Supun Hansaka', 'supunhansaka@gmail.com', 701234567, 2060, 150, 'Due', 'Pending', 'No 100, Niwdawa Road, Pinwala', 'kompanyaweediya', 70016, '[{\"product_id\":\"1\",\"quantity\":1},{\"product_id\":\"3\",\"quantity\":2}]', '');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
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
(1, 'Organic Mango', 1700.00, NULL, 'Fresh organic mango', NULL, NULL, 4),
(2, 'Organic Papaya', 570.00, NULL, 'Fresh organic papaya', 'out of stock', 1, 4),
(3, 'Organic Pineapple', 1248.00, NULL, 'Fresh organic pineapple', NULL, NULL, 4),
(4, 'Organic Watermelon', 330.00, NULL, 'Fresh organic watermelon', NULL, 1, 4),
(5, 'Apple', 2290.00, NULL, 'Fresh apples', NULL, NULL, 5),
(6, 'Banana-Ambul', 310.00, NULL, 'Fresh bananas', NULL, NULL, 5),
(7, 'Orange', 1720.00, NULL, 'Fresh oranges', NULL, NULL, 5),
(8, 'Strawberry', 1250.00, NULL, 'Fresh strawberry', 'out of stock', NULL, 5),
(9, 'Organic Carrot', 900.00, NULL, 'Fresh organic carrot', 'in stock', NULL, 1),
(10, 'Organic Green Beans', 460.00, NULL, 'Fresh organic green beans', 'out of stock', NULL, 1),
(11, 'Organic Sweet Potato', 570.00, NULL, 'Fresh organic sweet potato', 'in stock', NULL, 1),
(12, 'Potato', 410.00, NULL, 'Fresh potato', NULL, NULL, 2),
(13, 'Salad Leaves', 170.00, NULL, 'Fresh salad leaves', NULL, NULL, 2),
(14, 'Lime', 960.00, NULL, 'Fresh lime', 'out of stock', NULL, 2),
(15, 'Kekiri', 90.00, NULL, 'Fresh kekiri', NULL, 1, 2),
(16, 'Bringles', 320.00, NULL, 'Fresh bringles', NULL, 1, 2),
(17, 'Cabbage', 230.00, NULL, 'Fresh cabbage', NULL, 1, 2),
(18, 'Gotukola Packet', 130.00, NULL, 'Fresh gotukola packet', NULL, NULL, 3),
(19, 'Kankun Packet', 150.00, NULL, 'Fresh Kankun', 'inStock', NULL, 3),
(20, 'Mukunuwenna Packet', 220.00, '665042235bd07.jpg', 'Fresh Mukunuwenna', 'inStock', NULL, 3);

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
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`products_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `delivers`
--
ALTER TABLE `delivers`
  ADD PRIMARY KEY (`deliver_id`);

--
-- Indexes for table `delivery_details`
--
ALTER TABLE `delivery_details`
  ADD PRIMARY KEY (`delivery_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

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
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `products_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `delivers`
--
ALTER TABLE `delivers`
  MODIFY `deliver_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1023;

--
-- AUTO_INCREMENT for table `delivery_details`
--
ALTER TABLE `delivery_details`
  MODIFY `delivery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

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
