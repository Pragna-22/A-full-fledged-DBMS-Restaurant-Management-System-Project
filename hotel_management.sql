-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2019 at 05:59 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `food_category`
--

CREATE TABLE `food_category` (
  `fcid` int(11) NOT NULL,
  `ftid` int(11) DEFAULT NULL,
  `fcat_name` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_category`
--

INSERT INTO `food_category` (`fcid`, `ftid`, `fcat_name`) VALUES
(1, 1, 'Italian'),
(2, 2, 'Italian'),
(3, 1, 'Indian'),
(4, 2, 'Indian'),
(5, 1, 'Continental'),
(6, 2, 'Continental'),
(7, 1, 'Mexican'),
(8, 2, 'Mexican'),
(9, 1, 'Thai'),
(10, 2, 'Thai');

-- --------------------------------------------------------

--
-- Table structure for table `food_item`
--

CREATE TABLE `food_item` (
  `fid` int(11) NOT NULL,
  `fcid` int(11) DEFAULT NULL,
  `food_item_name` varchar(40) DEFAULT NULL,
  `food_price` int(11) DEFAULT NULL,
  `available` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_item`
--

INSERT INTO `food_item` (`fid`, `fcid`, `food_item_name`, `food_price`, `available`) VALUES
(1, 1, 'Vegetable Pasta', 150, 8),
(2, 1, 'Mushroom Pasta', 150, 4),
(3, 1, 'Veg loaded Pizza', 300, 7),
(4, 1, 'Cheese Corn Pizza', 500, 0),
(5, 1, 'Mushroom Pizza', 400, 2),
(6, 3, 'Paneer Steak', 200, 0),
(7, 3, 'Idly', 20, 79),
(8, 2, 'Non Veg Lasangna', 100, 6),
(9, 1, 'Veg Cheese_Fondue', 110, 10),
(10, 2, 'Non Veg Cheese_Fondue', 110, 10),
(11, 5, 'Veg Sandwich', 120, 10),
(12, 6, 'Non Veg Sandwich', 110, 5),
(13, 7, 'Veg Swiss_tacco', 120, 4),
(14, 8, 'Non Veg Swiss_tacco', 170, 10),
(15, 9, 'Thai Curry', 190, 10);

-- --------------------------------------------------------

--
-- Table structure for table `food_type`
--

CREATE TABLE `food_type` (
  `ftid` int(11) NOT NULL,
  `ftype_name` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_type`
--

INSERT INTO `food_type` (`ftid`, `ftype_name`) VALUES
(1, 'Vegetarian'),
(2, 'Non Vegetarian'),
(3, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `last_order`
--

CREATE TABLE `last_order` (
  `order_no` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `last_order`
--

INSERT INTO `last_order` (`order_no`) VALUES
(13);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `fid` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `Order_date` varchar(20) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `manager_id` int(11) DEFAULT NULL,
  `order_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_id`, `uid`, `fid`, `price`, `quantity`, `Order_date`, `status`, `manager_id`, `order_no`) VALUES
(4, 4, 1, 300, 2, '2019-10-26', 1, NULL, 1),
(5, 4, 7, 200, 10, '2019-10-26', 1, NULL, 1),
(6, 3, 2, 600, 4, '2019-10-26', 2, NULL, 2),
(7, 3, 5, 1200, 3, '2019-10-26', 2, NULL, 2),
(10, 3, 6, 1200, 6, '2019-10-27', 2, NULL, 2),
(11, 3, 7, 140, 7, '2019-10-27', 2, NULL, 3),
(12, 3, 4, 1500, 3, '2019-10-27', 2, NULL, 4),
(13, 3, 5, 2000, 5, '2019-10-27', 1, NULL, 5),
(14, 3, 3, 900, 3, '2019-10-27', 2, NULL, 6),
(15, 3, 4, 3000, 6, '2019-10-27', 2, NULL, 6),
(16, 17, 2, 300, 2, '2019-10-31', 2, NULL, 12),
(17, 17, 4, 500, 1, '2019-10-31', 2, NULL, 12),
(18, 17, 13, 720, 6, '2019-10-31', 2, NULL, 12),
(19, 17, 8, 400, 4, '2019-10-31', 2, NULL, 12),
(20, 17, 12, 550, 5, '2019-10-31', 2, NULL, 12);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `name` char(100) NOT NULL,
  `password` varchar(20) DEFAULT NULL,
  `confirmPassword` varchar(20) DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  `phoneNumber` bigint(11) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `email`, `name`, `password`, `confirmPassword`, `role`, `phoneNumber`, `address`) VALUES
(3, 'karthy.vit@gmail.com', 'Karthik Kumar R', 'admin', 'admin', 2, 9994069122, 'Bangalore'),
(4, 'Pragna@gmail.com', 'Pragna', 'admin', 'admin', 1, 878787878, 'Bangalore'),
(5, 'alice@gmail.com', 'Alice', 'alice', 'alice', 2, 9845088610, 'Boston'),
(6, 'brenda@gmail.com', 'Brenda', 'brenda', 'brenda', 2, 7022804610, 'California'),
(7, 'camilia', 'Camilia', 'camilia', 'camilia', 2, 8105390404, 'Florida'),
(8, 'dick@gmail.com', 'Dick', 'dick', 'dick', 2, 9880646382, 'Gerorjia'),
(9, 'emily@gmail.com', 'Emily', 'emily', 'emily', 2, 9998046453, 'Illinois'),
(10, 'harry@gmail.com', 'Harry', 'harry', 'harry', 2, 9125674320, 'Lousiana'),
(11, 'jhon@gmail.com', 'Jhon', 'jhon', 'jhon', 2, 9845088370, 'Maryland'),
(12, 'lucy@gmail.com', 'Lucy', 'lucy', 'lucy', 2, 7890321675, 'New Jersy'),
(13, 'peter@gmail.com', 'Peter', 'peter', 'peter', 2, 8741234450, 'Ohio'),
(14, 'rachel@gmail.com', 'Rachel', 'rachel', 'rachel', 2, 7022704251, 'Pensylvenia'),
(15, 'stephen@@gmail.com', 'Stephen', 'stephen', 'stephen', 2, 9954321986, 'Texas'),
(16, 'zara@gmail.com', 'Zara', 'zara', 'zara', 2, 7789456321, 'Washington'),
(17, 'ariana.richard@gmail.com', 'Ariana', 'ariana', 'ariana', 1, 9954321968, 'Sanfransisco'),
(18, 'brown_bennet@gmail.com', 'Brown', 'brown', 'brown', 1, 9845083999, 'Sanjose'),
(19, 'erica_joy@hotmail.com', 'Erica', 'ERICA', 'ERICA', 1, 9735846030, 'Orange_Count'),
(20, 'fana1112@gmail.com', 'Fana', 'fana', 'fana', 1, 9626608061, 'Irvine'),
(21, 'geroge_311@yahoo.com', 'George', 'george', 'george', 1, 9517370092, 'Downtown'),
(22, 'harriot.jw@gmail.com', 'Harriot', 'harriot', 'harriot', 1, 9408132123, 'River_Side'),
(23, 'joseph.jose@gmail.com', 'Joseph', 'joseph', 'joseph', 1, 9298894154, 'Houston'),
(24, 'kevinjohn@gmail.com', 'Kevin', 'kevin', 'kevin', 1, 9189656185, 'Arlington'),
(25, 'lindliverpool@gmail.com', 'Linda', 'linda', 'linda', 1, 9080418216, 'Seattale'),
(26, 'mary2000@gmail.com', 'Mary', 'mary', 'mary', 1, 8971180247, 'Santa_Monica'),
(27, 'nancydrew@hotmail.com', 'Nancy', 'nancy', 'nancy', 1, 8861942278, 'Indiana'),
(28, 'sara8888@gmail.com', 'Sara', 'sara', 'sara', 1, 8752704309, 'Bloomington');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `food_category`
--
ALTER TABLE `food_category`
  ADD PRIMARY KEY (`fcid`);

--
-- Indexes for table `food_item`
--
ALTER TABLE `food_item`
  ADD PRIMARY KEY (`fid`);

--
-- Indexes for table `food_type`
--
ALTER TABLE `food_type`
  ADD PRIMARY KEY (`ftid`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `food_category`
--
ALTER TABLE `food_category`
  MODIFY `fcid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `food_item`
--
ALTER TABLE `food_item`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `food_type`
--
ALTER TABLE `food_type`
  MODIFY `ftid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
