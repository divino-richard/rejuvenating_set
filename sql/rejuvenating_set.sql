-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2022 at 06:12 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rejuvenating_set`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` varchar(255) NOT NULL,
  `brand_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_name`) VALUES
('62c64b6373879', 'Skin Perfection'),
('62c64b876ecd5', 'Herskin'),
('62c64ba391d2a', 'Vault Beauty');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `cart_id` varchar(255) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`cart_id`, `customer_id`, `product_id`, `quantity`) VALUES
('62ca122ddb6bc', '62c6439515803', '62c76c7878e07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phonenumber` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `fname`, `lname`, `email`, `password`, `address`, `phonenumber`) VALUES
('62c6439515803', 'Ria', 'Quirong', 'ria@gmail.com', '123', 'San Agustine, S.D.S', 9506866597),
('62ca23df5c1a0', 'Jane', 'Publico', 'jane@gmail.com', '123', 'Lianga S.D.S', 9348574221);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employee_id` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `fname`, `lname`, `position`, `email`, `password`) VALUES
('62c7b29275e8f', 'John', 'Doe', 'seller', 'john@gmail.com', '123'),
('62ca209deecda', 'Jonny', 'Doe', 'seller', 'jonny@gmail.com', '123'),
('8a8a86ef-fd95-11ec-b17b-5c260a3f45f6', 'Mary Grace', 'Salinas', 'admin', 'admin@dev.com', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` varchar(255) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `quantity` int(50) NOT NULL,
  `amount` int(255) NOT NULL,
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `product_id`, `quantity`, `amount`, `order_status`) VALUES
('62ca12998fa36', '62c6439515803', '62c76c7878e07', 1, 6140, 'On Process'),
('62ca140b6909d', '62c6439515803', '62c76d3f26a1e', 2, 12140, 'Delivered');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` varchar(255) NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `brand_id` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `buying_price` int(255) NOT NULL,
  `selling_price` int(255) NOT NULL,
  `qty_in_stock` int(255) NOT NULL,
  `product_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `employee_id`, `brand_id`, `product_image`, `product_name`, `buying_price`, `selling_price`, `qty_in_stock`, `product_description`) VALUES
('62c65ea690773', '62c7b29275e8f', '62c64ba391d2a', 'product_62ca46f953725.jpg', 'Cream of VB', 600, 700, 120, '...'),
('62c76c7878e07', '62c7b29275e8f', '62c64b876ecd5', 'product_62c76c787831e.jpeg', 'Toner of 7 days', 500, 600, 120, '...'),
('62c76d3f26a1e', '62c7b29275e8f', '62c64b6373879', 'product_62c76d3f26505.jpeg', 'Set SP', 5000, 6000, 120, '...'),
('62c76db3dc653', '62ca209deecda', '62c64b6373879', 'product_62c76db3dbee4.jpg', 'Toner SP', 5000, 6000, 25, '...'),
('62ca4b94e3357', '62ca209deecda', '62c64ba391d2a', 'product_62ca4b94e27b1.jpg', 'BV set', 1500, 1700, 200, '...'),
('62ca4bdc777dc', '62ca209deecda', '62c64ba391d2a', 'product_62ca4bdc76895.jpeg', 'Soap of VB ', 500, 600, 100, '...'),
('62ca4c23acb0e', '62ca209deecda', '62c64b6373879', 'product_62ca4c23aba66.jpeg', 'Soap SP', 500, 600, 300, '...'),
('62ca4cb7c38f5', '62ca209deecda', '62c64ba391d2a', 'product_62ca4cb7c2a9a.jpg', 'toner of VB', 500, 600, 300, '...'),
('62ca4d645325c', '62c7b29275e8f', '62c64b876ecd5', 'product_62ca4d6451c1f.jpg', '7days HS', 2000, 2500, 150, '...'),
('62ca4dcc53ee2', '62c7b29275e8f', '62c64b876ecd5', 'product_62ca4dcc2d257.jpeg', 'Nightcream of 7days', 500, 600, 150, '...'),
('62ca4e38e91f1', '', '62c64b876ecd5', 'product_62ca4e38e464e.jpg', 'Soap of 7 days', 1233, 2344, 123, '...'),
('62ca4e821625d', '', '62c64b6373879', 'product_62ca4e820fe9d.jpeg', 'SP Set', 2000, 2500, 80, '...');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `brand_id` (`brand_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
