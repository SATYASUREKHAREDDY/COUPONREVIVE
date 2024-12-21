-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2024 at 03:29 PM
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
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `coupon_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `coupon_price` int(11) NOT NULL,
  `processed` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `coupon_id`, `coupon_name`, `coupon_price`, `processed`) VALUES
(102, 5, 1234578, 'ajio', 50, 1),
(108, 4, 1234602, 'Ott play', 90, 1),
(109, 9, 1234579, 'mama earth', 70, 1),
(121, 4, 1234604, 'Domino', 80, 1);

-- --------------------------------------------------------

--
-- Table structure for table `confirmed`
--

CREATE TABLE `confirmed` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `coupon_price` int(11) NOT NULL,
  `processed` tinyint(1) DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `confirmed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `confirmed`
--

INSERT INTO `confirmed` (`id`, `user_id`, `item_id`, `coupon_id`, `coupon_price`, `processed`, `timestamp`, `confirmed_at`) VALUES
(102, 5, 102, 1234578, 50, 1, '2024-07-10 13:12:13', '2024-07-17 09:54:20'),
(103, 4, 108, 1234602, 90, 1, '2024-07-14 11:58:53', '2024-07-17 09:54:20'),
(104, 9, 109, 1234579, 70, 1, '2024-07-15 04:03:22', '2024-07-17 09:54:20'),
(109, 4, 121, 1234604, 80, 1, '2024-07-17 12:53:02', '2024-07-17 12:53:02');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `message` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`name`, `email`, `message`) VALUES
('siri', 'sirisha@gmail.com', 'weruiqwrhkjrnfkjsfnoiwe');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `coupon_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `coupon_name` varchar(255) DEFAULT NULL,
  `coupon_category` text NOT NULL,
  `coupon_description` text DEFAULT NULL,
  `coupon_code` varchar(30) NOT NULL,
  `coupon_price` int(11) NOT NULL,
  `coupon_validity` date NOT NULL,
  `coupon_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`coupon_id`, `user_id`, `coupon_name`, `coupon_category`, `coupon_description`, `coupon_code`, `coupon_price`, `coupon_validity`, `coupon_image`) VALUES
(1234578, 4, 'ajio', 'Fashion&Clothing', 'Min 50% off + Flat 250 Extra off* + Free shipping', 'IJFRZY5UTFKM1GR', 50, '2024-07-31', 'uploads1/idwdLmOYr2.png'),
(1234579, 4, 'mama earth', 'Beauty', 'Flat 100% Cashback*  on mamaearth', 'P1C7A102TXC5XREI', 70, '2024-07-31', 'uploads1/mamaearth-logo-large.png'),
(1234587, 8, 'Renee', 'Beauty', 'Flat 25% off* on all products on Renee website', 'ABCD1234', 50, '2025-03-05', 'uploads1/co2.jpg'),
(1234589, 8, 'BBlunt', 'Beauty', 'Flat 30% off on all products on BBlunt website', 'ABCD7845', 70, '2025-09-02', 'uploads1/co13.jpg'),
(1234590, 8, 'zanducare', 'Beauty', 'flat 60% off on all products on zenducare', 'DHIE1234', 50, '2024-09-26', 'uploads1/co5.jpg'),
(1234591, 8, 'Audible', 'Others', 'Get 2 months Audible premium plus on audible website', 'FHRU347667', 100, '2025-08-27', 'uploads1/coupon.jpg'),
(1234592, 8, 'Myntra', 'Fashion&Clothing', 'Flat 20% off* on spend of Rs.500 from Nykaa', 'NYKAA2637', 80, '2025-07-03', 'uploads1/co3.jpg'),
(1234593, 8, 'GRT', 'Beauty', 'Get Rs.500 off on orders above Rs.2000 from GRT', 'GRTY1278', 120, '2025-03-04', 'uploads1/co12.jpg'),
(1234594, 8, 'Ponds', 'Beauty', 'Upto 20% off on products from PONDS website', 'POND2847', 60, '2025-08-05', 'uploads1/co15.jpg'),
(1234595, 4, 'ajio', 'Fashion&Clothing', 'Min 50% off and free shipping on Ajio website ', 'LENS4576', 80, '2025-07-08', 'uploads1/co9.jpg'),
(1234596, 4, 'Icruze', 'Fashion&Clothing', 'Flat Rs.11000 off on combo of headphones on Icruze', 'ICRU3678', 150, '2025-06-02', 'uploads1/co10.jpg'),
(1234597, 4, 'Puma', 'Fashion&Clothing', 'Flat 40% off + Extra 10% off at PUMA sale', 'PUMA3678', 80, '2025-09-10', 'uploads1/co7.jpg'),
(1234598, 4, 'Amazon prime', 'Others', 'Get flat 15% cashback on amazon prime ', 'PRIM2855', 60, '2025-05-06', 'uploads1/co11.jpg'),
(1234599, 5, 'myntra', 'Fashion&Clothing', 'Get flat Rs.400* Extra off on Myntra website', 'MYHU2738', 70, '2024-11-02', 'uploads1/co8.jpg'),
(1234600, 5, 'Aqualogica', 'Beauty', 'BUY 3 pay for 2 extra 5% off on Aqualogica', 'AGUR2735', 50, '2024-07-08', 'uploads1/co14.jpg'),
(1234601, 5, 'Red Rail', 'Others', 'Flat Rs.80 off on train tickect bookings', 'BYRU2643', 70, '2025-08-04', 'uploads1/c1 (4).jpg'),
(1234602, 5, 'Ott play', 'Others', 'Enjoy 40 OTT\'s at just Rs.149 using OTTplay', 'OFTD3652', 90, '2024-09-12', 'uploads1/c1 (2).jpg'),
(1234603, 9, 'Zepto', 'Food', 'Flat Rs.75 off + 50 Zepto Cash(New Users Only)', 'GRYU3627', 70, '2024-09-11', 'uploads1/co16.jpg'),
(1234604, 8, 'Domino\'s', 'Food', 'Flat 20% Off upto Rs.100 on min order Rs.500', 'GEDJ2733', 80, '2024-10-15', 'uploads1/co17.png'),
(1234605, 9, 'Pizza Hut', 'Food', '25% Off upto RS.300 on min order of Rs.400', 'CVEH6578', 50, '2024-08-21', 'uploads1/co18.jpg'),
(1234606, 8, 'myntra', 'Fashion&Clothing', 'Flat 40% on orders above Rs.2500', 'ETyh2635', 80, '2024-08-10', 'uploads1/coup1.jpeg'),
(1234607, 5, 'Tiggle', 'Food', '55% Dark Iced Chocolate at RS.1 on TIZZLE APP', 'DDVE6478', 40, '2024-07-30', 'uploads1/co19.jpg'),
(1234608, 8, 'Araku Coffee INDIA', 'Food', 'Flat 10% Off on products on min order of Rs.100 ', 'DEGT3256', 50, '2024-08-22', 'uploads1/co20.jpg'),
(1234609, 4, 'Chokhi Dhani', 'Food', 'chili Garlic chutney+Mango chutney at Rs.335', 'FRBU3546', 50, '2024-07-29', 'uploads1/co21.png'),
(1234610, 8, 'pluckk', 'Food', 'Flat 305 off + 25% cashback(First order only)', 'DDVE6443', 60, '2024-08-29', 'uploads1/co22.jpg'),
(1234611, 9, 'Himalayan Gatherer', 'Food', 'Winter white Honey(450 grams) at Rs.325', 'GEYT4637', 70, '2024-10-03', 'uploads1/co23.jpg'),
(1234612, 9, 'ZEE5', 'Others', '6 months subscription deal on ZEE5', 'VDEH2836', 60, '2024-07-30', 'uploads1/co25.jpg'),
(1234613, 8, 'Nykaa', 'Beauty', 'EXtra 20% Off on min order of Rs.149 on Nykaa', 'DEHT2039', 50, '2024-09-07', 'uploads1/co24.png'),
(1234614, 5, 'The Hindu', 'Others', '1 month premium digital access of The Hindu', 'DEHY2354', 50, '2024-07-29', 'uploads1/co26.jpg'),
(1234615, 4, 'Jiosaavn', 'Others', '1 month subscription for Jiosaavn', 'DEGY2345', 50, '2024-11-20', 'uploads1/co27.jpg'),
(1234616, 8, 'Boat', 'Fashion&Clothing', 'calling Boat smart watch at R2.1899 ', 'FDET2780', 100, '2024-09-21', 'uploads1/co29.jpg'),
(1234617, 5, 'Fastrack', 'Fashion&Clothing', 'Flat 60% off on minimum order of RS.500', 'CVEH6578', 40, '2024-09-16', 'uploads1/co28.jpg'),
(1234618, 9, 'Noise', 'Fashion&Clothing', 'Noise buds VS402 at Rs.1199 no min order', 'FRBU3546', 100, '2024-08-29', 'uploads1/co30.jpg'),
(1234619, 9, 'Ott play', 'Others', 'Sony liv & 39 Ott\'s at Rs.99 on Ott Play', 'VDERY2635', 80, '2024-12-05', 'uploads1/co31.jpg'),
(1234620, 9, 'Puma', 'Fashion&Clothing', 'Flat 40% Off + Extra 10% off on puma ', 'DDVE6478', 100, '2024-11-20', 'uploads1/co32.jpg'),
(1234621, 8, 'W', 'Fashion&Clothing', 'Flat 50% Off + EXtra 10% Off on min order of RS.1499', 'GEDJ2733', 120, '2024-07-31', 'uploads1/co33.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `review_table`
--

CREATE TABLE `review_table` (
  `review_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_rating` int(1) NOT NULL CHECK (`user_rating` between 1 and 5),
  `user_review` text NOT NULL,
  `datetime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review_table`
--

INSERT INTO `review_table` (`review_id`, `user_name`, `user_rating`, `user_review`, `datetime`) VALUES
(1, 'surekha', 3, 'good', 1717687171),
(2, 'siri', 3, 'average', 1721016306);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `contact` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `address` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `contact`, `address`) VALUES
(4, 'surekha', 'lakshmiessurekha@gmail.com', 'mssreddy', '8519945319', 'ongole'),
(5, 'Satya', 'satyasurekhareddymarthala@gmail.com', 'satya123', '8519945319', 'kakinada'),
(8, 'navya', 'madirinavyasri@gmail.com', 'minnu@2624', '7893389102', 'vjy'),
(9, 'siri', 'sirisha@gmail.com', 'siri1', '9392447182', 'ap');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `fk_coupon` (`user_id`),
  ADD KEY `fk_couponid` (`coupon_id`);

--
-- Indexes for table `confirmed`
--
ALTER TABLE `confirmed`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `fk_confirmed` (`coupon_id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`coupon_id`),
  ADD KEY `fk_coupons` (`user_id`);

--
-- Indexes for table `review_table`
--
ALTER TABLE `review_table`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `confirmed`
--
ALTER TABLE `confirmed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `coupon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1234622;

--
-- AUTO_INCREMENT for table `review_table`
--
ALTER TABLE `review_table`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_coupon` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_couponid` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`coupon_id`);

--
-- Constraints for table `confirmed`
--
ALTER TABLE `confirmed`
  ADD CONSTRAINT `confirmed_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `cart` (`id`),
  ADD CONSTRAINT `confirmed_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_confirmed` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`coupon_id`);

--
-- Constraints for table `coupons`
--
ALTER TABLE `coupons`
  ADD CONSTRAINT `fk_coupons` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
