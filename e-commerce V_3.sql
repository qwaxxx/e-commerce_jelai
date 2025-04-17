-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2025 at 01:24 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-commerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `addcarts`
--

CREATE TABLE `addcarts` (
  `addcart_id` int(11) NOT NULL,
  `addcart_batch_id` int(10) NOT NULL,
  `addcart_user_id` int(10) NOT NULL,
  `addcart_prod_id` int(10) NOT NULL,
  `addcart_pcs` int(10) NOT NULL,
  `addcart_price` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addcarts`
--

INSERT INTO `addcarts` (`addcart_id`, `addcart_batch_id`, `addcart_user_id`, `addcart_prod_id`, `addcart_pcs`, `addcart_price`) VALUES
(18, 150621, 15, 11, 2, 30000),
(19, 150621, 15, 12, 2, 20999);

-- --------------------------------------------------------

--
-- Table structure for table `billing_orders`
--

CREATE TABLE `billing_orders` (
  `billing_order_id` int(11) NOT NULL,
  `billing_user_id` int(10) NOT NULL,
  `billing_temp_id` int(10) NOT NULL,
  `billing_fname` varchar(255) NOT NULL,
  `billing_lname` varchar(255) NOT NULL,
  `billing_email` varchar(255) NOT NULL,
  `billing_street_village_purok` varchar(255) NOT NULL,
  `billing_baranggay` varchar(255) NOT NULL,
  `billing_city` varchar(255) NOT NULL,
  `billing_province` varchar(255) NOT NULL,
  `billing_country` varchar(255) NOT NULL,
  `billing_postal` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `billing_orders`
--

INSERT INTO `billing_orders` (`billing_order_id`, `billing_user_id`, `billing_temp_id`, `billing_fname`, `billing_lname`, `billing_email`, `billing_street_village_purok`, `billing_baranggay`, `billing_city`, `billing_province`, `billing_country`, `billing_postal`) VALUES
(9, 15, 0, 'kill', 'last', 'eraoflorenciaforsale@gmail.com', 'purok-7', 'punta', 'pana-on', 'Misamis Occidental', 'Philippines', 7205);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_user_id` int(10) NOT NULL,
  `order_billing_id` int(10) NOT NULL,
  `order_batch_id` int(10) NOT NULL,
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_user_id`, `order_billing_id`, `order_batch_id`, `order_status`) VALUES
(11, 15, 9, 150621, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expires` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `prod_id` int(11) NOT NULL,
  `prod_name` varchar(255) NOT NULL,
  `prod_description` varchar(255) NOT NULL,
  `prod_stock` int(10) NOT NULL,
  `prod_price` int(10) NOT NULL,
  `prod_picture` varchar(255) NOT NULL,
  `user_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`prod_id`, `prod_name`, `prod_description`, `prod_stock`, `prod_price`, `prod_picture`, `user_id`) VALUES
(11, 'IdeaPad', 'Slim 1 i15 Gen 7', 120, 30000, 'uploads/IdeaPadSlim1i15Gen 7.png', 9),
(12, 'Yoga 7', ' 2-in-1 14\'Gen 9-2', 50, 20999, 'uploads/Yoga 7 2-in-1 14\'Gen 9-2.png', 8);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_type` enum('admin','seller','customer') NOT NULL,
  `create_on` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`, `create_on`) VALUES
(7, 'ray', 'raymart.poras@gmail.com', '$2y$10$UxaNquZEqk/sboAJ.9/v/.XTLJTXcY0MH6KBHhmFlZlM/Txkmh9w6', 'customer', '2025-04-18 03:00:50'),
(8, 'seller', 'seller@gmail.com', '$2y$10$UDaS4VSbpy/6agSDMJ6NKOagGCRjQVNWvmeZm41vT4FC/gkmqyB8.', 'seller', '2025-04-18 03:03:00'),
(9, 'seller 2', 'seller2@gmail.com', '$2y$10$3TGAHAHB9KOkRa4YnFbuWOlWQFaDKv5FBP8d6p/KJZkyjNvZx7RXu', 'seller', '2025-04-18 03:27:50'),
(15, 'killie', 'eraoflorenciaforsale@gmail.com', '$2y$10$ZPq1B0wOrl.M6ZuLYSvSEeh4dECtXPX/XnbDLfbmbM4R6YHbeseF2', 'customer', '2025-04-18 07:17:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addcarts`
--
ALTER TABLE `addcarts`
  ADD PRIMARY KEY (`addcart_id`);

--
-- Indexes for table `billing_orders`
--
ALTER TABLE `billing_orders`
  ADD PRIMARY KEY (`billing_order_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addcarts`
--
ALTER TABLE `addcarts`
  MODIFY `addcart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `billing_orders`
--
ALTER TABLE `billing_orders`
  MODIFY `billing_order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
