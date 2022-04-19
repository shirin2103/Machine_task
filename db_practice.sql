-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2022 at 11:49 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_practice`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `id` bigint(20) NOT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `product_price` double DEFAULT NULL,
  `product_desccription` longtext DEFAULT NULL,
  `product_image` longtext DEFAULT NULL,
  `del_status` enum('1','0') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `product_name`, `product_price`, `product_desccription`, `product_image`, `del_status`, `created_at`, `updated_at`) VALUES
(1, 'TEst', 100, 'test', ',http://localhost/task/uploads/products/625e732b718af.png,http://localhost/task/uploads/products/625e72d59267b.jpeg,http://localhost/task/uploads/products/625e729dbf9f1.png,http://localhost/task/uploads/products/625e729dc29ab.jpg,http://localhost/task/uploads/products/625e729dc5d6d.png,http://localhost/task/uploads/products/625e5e4bcfd81.png,http://localhost/task/uploads/products/625e5e4bd3cfc.png,http://localhost/task/uploads/products/625e5e4bd609c.png,http://localhost/task/uploads/products/625e5e4bd7280.png', '1', '2022-04-19 12:31:31', '2022-04-19 14:01:26'),
(2, 'testww', 100, 'test', 'http://localhost/task/uploads/products/625e7982625a0.png,http://localhost/task/uploads/products/625e7982635d4.png,http://localhost/task/uploads/products/625e798264318.png', '1', '2022-04-19 14:27:38', '2022-04-19 14:27:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
