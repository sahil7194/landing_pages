-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2019 at 06:06 PM
-- Server version: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_orders`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(19) DEFAULT NULL,
  `created_date` varchar(10) DEFAULT NULL,
  `total` decimal(5,1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_name`, `created_date`, `total`) VALUES
(1, 'Arti Bhalla', '2019-09-17', '50.0'),
(2, 'Ujjwal Luthra', '2019-09-18', '56.0'),
(3, 'Ritansh Aggarwal', '2019-09-19', '89.0'),
(4, 'Aakash Aggarwal', '2019-09-20', '56.0'),
(5, 'ANANT KAUSHIK', '2019-09-21', '657.0'),
(6, 'Gourav', '2019-09-22', '545.8'),
(7, 'Ankit Lakhwani', '2019-09-23', '667.2'),
(8, 'Prem Sood', '2019-09-24', '788.6'),
(9, 'Nitisha Bhandari', '2019-09-25', '910.0'),
(10, 'Anand Singh Chauhan', '2019-09-26', '1031.4'),
(11, 'Anmol Anand', '2019-09-27', '1152.8'),
(12, 'Anshul Bindal', '2019-09-28', '1274.2'),
(13, 'Anjum Jain', '2019-09-29', '1395.6'),
(14, 'Nisha Mangal', '2019-09-30', '1517.0'),
(15, 'Kush Proothi', '2019-10-01', '1638.4'),
(16, 'Ashutosh suri', '2019-10-02', '1759.8'),
(17, 'Akshat Daral', '2019-10-03', '1881.2'),
(18, 'Jimmy Marothia', '2019-10-04', '2002.6'),
(19, 'Ayush', '2019-10-05', '2124.0'),
(20, 'Lalit Dagar', '2019-10-06', '2245.4'),
(21, 'Yash C', '2019-10-07', '2366.8'),
(22, 'Chankit Drall', '2019-10-08', '2488.2'),
(23, 'Preksh', '2019-10-09', '2609.6'),
(24, 'Jai Randhawa', '2019-10-10', '2731.0'),
(25, 'Pooja Gogia', '2019-10-11', '2852.4'),
(26, 'Harshit Mulchandani', '2019-10-12', '2973.8'),
(27, 'KUL SINGH', '2019-10-13', '3095.2'),
(28, 'Rohan Gupta', '2019-10-14', '3216.6'),
(29, 'Preeti Lamba', '2019-10-15', '3338.0'),
(30, 'Vivek Sinha', '2019-10-16', '3459.4'),
(31, 'M U D I TJ A I N', '2019-10-17', '3580.8'),
(32, 'Saurabh Makhija', '2019-10-18', '3702.2'),
(33, 'Gagan Takkar', '2019-10-19', '3823.6'),
(34, 'Anjoo Kurseja', '2019-10-20', '3945.0'),
(35, 'Mokshi Mahajan', '2019-10-21', '4066.4'),
(36, 'Kanchan Nagpal', '2019-10-22', '4187.8'),
(37, 'Radha Bhardwaj', '2019-10-23', '4309.2'),
(38, 'Kavita Jaisinghani', '2019-10-24', '4430.6'),
(39, 'Dilip Rawat', '2019-10-25', '4552.0');

-- --------------------------------------------------------

--
-- Table structure for table `orders_product`
--

CREATE TABLE `orders_product` (
  `id` int(11) NOT NULL,
  `order_id` int(2) DEFAULT NULL,
  `quantity` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders_product`
--

INSERT INTO `orders_product` (`id`, `order_id`, `quantity`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 1),
(4, 2, 1),
(5, 2, 1),
(6, 3, 1),
(7, 3, 1),
(8, 4, 1),
(9, 4, 1),
(10, 4, 2),
(11, 5, 2),
(12, 5, 2),
(13, 5, 3),
(14, 5, 3),
(15, 6, 3),
(16, 6, 3),
(17, 7, 3),
(18, 8, 1),
(19, 9, 1),
(20, 10, 1),
(21, 11, 1),
(22, 11, 1),
(23, 12, 1),
(24, 12, 1),
(25, 12, 2),
(26, 13, 2),
(27, 14, 2),
(28, 15, 2),
(29, 16, 2),
(30, 17, 2),
(31, 18, 1),
(32, 19, 1),
(33, 20, 1),
(34, 21, 3),
(35, 22, 4),
(36, 23, 3),
(37, 24, 3),
(38, 25, 3),
(39, 26, 3),
(40, 27, 2),
(41, 28, 4),
(42, 29, 3),
(43, 30, 3),
(44, 31, 3),
(45, 32, 3),
(46, 33, 3),
(47, 34, 1),
(48, 35, 1),
(49, 36, 1),
(50, 37, 1),
(51, 38, 1),
(52, 39, 1),
(53, 40, 1),
(54, 41, 1),
(55, 42, 1),
(56, 43, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_product`
--
ALTER TABLE `orders_product`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
