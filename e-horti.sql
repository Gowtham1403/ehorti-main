-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2023 at 07:43 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-horti`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `product_id` varchar(10) NOT NULL,
  `customer_email` varchar(200) NOT NULL,
  `seller_email` varchar(200) NOT NULL,
  `customer_msg` varchar(255) NOT NULL,
  `seller_msg` varchar(255) NOT NULL,
  `request` varchar(5) NOT NULL,
  `msg_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `customer-info`
--

CREATE TABLE `customer-info` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `street_name` varchar(50) NOT NULL,
  `district` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `pincode` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `otp` varchar(20) NOT NULL,
  `token` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer-info`
--

INSERT INTO `customer-info` (`id`, `name`, `gender`, `mobile`, `email`, `password`, `street_name`, `district`, `state`, `pincode`, `status`, `otp`, `token`) VALUES
(1, 'thiru', 'Male', '1122334455', 'thiru@gmail.com', 'thiru@123', 'thathaneri,aruldaspuram', 'madurai', 'Tamilnadu', '625018', 'ACTIVE', '182102', '6faa61e3e43b1ff3ac9596409659e97f'),
(2, 'ramdhanush', 'Male', '1122334455', 'ram@gmail.com', 'ram@123', 'anna nagar', 'madurai', 'Tamilnadu', '625003', 'INACTIVE', '395356', '318eda6ee901cfedf8a6b21b41c60cb7'),
(3, 'stalin', 'Male', '1122334455', 'stalin@gmail.com', 'stalin@123', 'vasantha nagar', 'madurai', 'Tamilnadu', '625003', 'ACTIVE', '857953', 'b12c651ba51ff612908b86e5fb14ccf9'),
(5, 'viswa', 'Male', '1122234445', 'viswa@gmail.com', 'viswa@123', 'thambaram', 'chennai', 'Tamilnadu', '62509', 'INACTIVE', '330130', '04567168af4d9e781de86c3eb05b9977'),
(6, 'ravi', 'Male', '1122334455', 'ravi@gmail.com', 'ravi@123', 'thiru-vi-ka nagar,perambur', 'chennai', 'Tamilnadu', '635001', 'INACTIVE', '481474', '8dc5331e56e23ea61964bc0035dc2d8b'),
(7, '', '', '', 'sit@gmail.com', 'sit@123', '', '', '', '', 'ACTIVE', '244504', 'ea5b8ef9a86e6741e9ea3b74338a8b20');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `orderId` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `pid` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `userId` varchar(255) NOT NULL,
  `amount_quantity` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `order_time` varchar(255) NOT NULL,
  `user_mobile` int(11) NOT NULL,
  `payment_mobile` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `purchase-post`
--

CREATE TABLE `purchase-post` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `post_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `seller-post`
--

CREATE TABLE `seller-post` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `seller-name` varchar(50) NOT NULL,
  `name` varchar(20) NOT NULL,
  `product-img` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `price` varchar(50) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `posted_time` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `seller-post`
--

INSERT INTO `seller-post` (`id`, `email`, `seller-name`, `name`, `product-img`, `category`, `price`, `quantity`, `unit`, `description`, `posted_time`) VALUES
(36, 'thiru@gmail.com', 'thiru', 'carrot', 'post-image/WhatsApp Image 2022-02-14 at 3.34.20 PM (1).jpeg', 'Vegetables', '30', '10', 'KG', 'fresh carrot\n', '2022-02-14 15:36:26'),
(37, 'thiru@gmail.com', 'thiru', 'guva', 'post-image/WhatsApp Image 2022-02-14 at 3.34.20 PM.jpeg', 'Fruits', '60', '10', 'KG', '', '2022-02-14 15:37:35'),
(38, 'thiru@gmail.com', 'thiru', 'potato', 'post-image/WhatsApp Image 2022-02-14 at 3.34.21 PM (1).jpeg', 'Vegetables', '20', '5', 'KG', '', '2022-02-14 15:38:03'),
(39, 'thiru@gmail.com', 'thiru', 'tomato', 'post-image/WhatsApp Image 2022-02-14 at 3.34.21 PM.jpeg', 'Vegetables', '15', '10', 'KG', '', '2022-02-14 15:38:40'),
(40, 'thiru@gmail.com', 'thiru', 'brinjal', 'post-image/WhatsApp Image 2022-02-14 at 3.39.23 PM.jpeg', 'Vegetables', '10', '15', 'KG', '', '2022-02-14 15:40:02'),
(41, 'thiru@gmail.com', 'thiru', 'apple', 'post-image/WhatsApp Image 2022-02-14 at 3.40.44 PM.jpeg', 'Fruits', '110', '10', 'KG', '', '2022-02-14 15:41:08'),
(42, 'thiru@gmail.com', 'thiru', 'onion', 'post-image/WhatsApp Image 2022-02-14 at 3.42.16 PM.jpeg', 'Vegetables', '10', '15', 'KG', '', '2022-02-14 15:42:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer-info`
--
ALTER TABLE `customer-info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase-post`
--
ALTER TABLE `purchase-post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seller-post`
--
ALTER TABLE `seller-post`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `customer-info`
--
ALTER TABLE `customer-info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase-post`
--
ALTER TABLE `purchase-post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `seller-post`
--
ALTER TABLE `seller-post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
