-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2024 at 09:15 AM
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
-- Database: `cafe`
--

-- --------------------------------------------------------

--
-- Table structure for table `cartchild`
--

CREATE TABLE `cartchild` (
  `ch_id` int(10) NOT NULL,
  `mt_id` int(10) NOT NULL,
  `f_id` int(10) NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cartchild`
--

INSERT INTO `cartchild` (`ch_id`, `mt_id`, `f_id`, `quantity`) VALUES
(58, 17, 29, 1),
(59, 17, 27, 1),
(60, 18, 15, 2),
(61, 18, 18, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cartmaster`
--

CREATE TABLE `cartmaster` (
  `cm_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `cart_status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cartmaster`
--

INSERT INTO `cartmaster` (`cm_id`, `user_id`, `cart_status`) VALUES
(17, 43, 0),
(18, 44, 0);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryid` int(11) NOT NULL,
  `catname` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryid`, `catname`) VALUES
(4, 'FAST MEAL'),
(5, 'SIDE DISH'),
(6, 'DESSERTS'),
(7, 'BEVERAGES');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `fb_id` int(10) NOT NULL,
  `f_id` int(10) NOT NULL,
  `message` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `username` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `login_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`, `status`, `login_status`) VALUES
('admin', 'admin', 'admin', 1),
('ashkar@gmail.com', 'asdfg', 'customer', 1),
('ashna@gmail.com', '1212', 'customer', 1),
('dennis@gmail.com', 'poiuyt', 'waiter', 1),
('donjoseph@gmail.com', 'uiouio', 'staff', 1),
('lucas@gmail.com', 'sesg', 'Chef', 1),
('mariya@gmail.com', '9878', 'Chef', 1),
('neym@gmail.com', 'ghjkl', 'waiter', 1),
('roymathew@gmail.com', 'plmplm', 'staff', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `f_id` int(20) NOT NULL,
  `f_name` varchar(50) NOT NULL,
  `size` varchar(20) NOT NULL,
  `quantity` int(20) NOT NULL,
  `price` float NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `pay_id` int(11) NOT NULL,
  `reservation_id` int(11) NOT NULL,
  `paymemt_date` datetime NOT NULL,
  `paid_amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`pay_id`, `reservation_id`, `paymemt_date`, `paid_amount`) VALUES
(13, 14, '2024-01-01 00:00:00', 150.00),
(14, 15, '2024-01-02 00:00:00', 165.00);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productid` int(11) NOT NULL,
  `categoryid` int(1) NOT NULL,
  `productname` varchar(30) NOT NULL,
  `quantity` varchar(20) NOT NULL,
  `type` varchar(30) NOT NULL,
  `price` double NOT NULL,
  `photo` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productid`, `categoryid`, `productname`, `quantity`, `type`, `price`, `photo`) VALUES
(14, 4, 'Chicken Sandwich ', '15', 'non veg', 100, 'upload/Chicken Sandwich_1639237538.png'),
(15, 4, 'Hamburger', '3', 'non veg', 70, 'upload/Hamburger_1639237617.png'),
(18, 7, 'Bottled Water', '49', ' ', 25, 'upload/Bottled Water_1639224773.png'),
(19, 7, 'Iced Tea', '20', '', 30, 'upload/Iced Tea_1639224837.png'),
(20, 6, 'Pancakes', '4', '', 75, 'upload/Pancakes_1639222870.png'),
(21, 4, 'Fried Chicken with Rice', '10', 'non veg', 70, 'upload/Fried Chicken_1639237577.png'),
(22, 4, 'Fish Sandwich ', '29', 'non veg', 100, 'upload/Fish Sandwich_1639237561.png'),
(23, 7, 'Orange Juice', '48', '', 40, 'upload/Orange Juice_1639224726.png'),
(26, 6, 'Brownies', '53', '', 50, 'upload/Brownies_1639222921.png'),
(27, 4, 'Hash Brown', '44', '', 110, 'upload/Hash Brown_1639237648.png'),
(28, 5, 'French Fries', '9', 'veg', 55, 'upload/French Fries_1639318054.png'),
(29, 5, 'Macaroni Salad', '19', 'veg', 40, 'upload/Macaroni Salad_1639318197.png'),
(30, 5, 'Onion Rings ', '33', 'veg', 65, 'upload/Onion Rings_1639318263.png'),
(31, 7, 'Shampagne', '50', '', 90, 'upload/kevin-kelly-PPneSBqfCCU-unsplash_1698474271.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `purchaseid` int(11) NOT NULL,
  `customer` varchar(50) NOT NULL,
  `total` double NOT NULL,
  `date_purchase` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_detail`
--

CREATE TABLE `purchase_detail` (
  `pdid` int(11) NOT NULL,
  `purchaseid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `purchase_detail`
--

INSERT INTO `purchase_detail` (`pdid`, `purchaseid`, `productid`, `quantity`) VALUES
(13, 8, 15, 2),
(14, 8, 17, 2),
(15, 8, 18, 2),
(16, 9, 15, 3),
(17, 10, 16, 1),
(18, 10, 23, 1),
(19, 11, 16, 1),
(20, 14, 22, 2),
(21, 15, 22, 2),
(22, 15, 26, 1),
(23, 16, 14, 3),
(24, 16, 26, 2),
(25, 16, 19, 4);

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `c_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phn` text NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`c_id`, `name`, `email`, `phn`, `password`) VALUES
(43, 'ashkar', 'ashkar@gmail.com', '8137880612', 'asdfg'),
(44, 'ashna nourin', 'ashna@gmail.com', '9867987667', '1212');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reservation_id` int(11) NOT NULL,
  `reservation_date` varchar(50) NOT NULL,
  `cm_id` int(11) NOT NULL,
  `table_id` int(11) NOT NULL,
  `slot_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`reservation_id`, `reservation_date`, `cm_id`, `table_id`, `slot_id`) VALUES
(14, '2024-01-16', 17, 3, 8),
(15, '2024-01-18', 18, 4, 6);

-- --------------------------------------------------------

--
-- Table structure for table `table`
--

CREATE TABLE `table` (
  `t_id` int(10) NOT NULL,
  `t_name` varchar(20) NOT NULL,
  `place` varchar(100) NOT NULL,
  `capacity` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table`
--

INSERT INTO `table` (`t_id`, `t_name`, `place`, `capacity`) VALUES
(1, 'A 1', 'LEFT TOP CORNER OF THE CAFE AND NEXT TO WINDOW', 2),
(2, 'A 2', 'BETWEEN A 1 AND A 3 AND NEXT TO WINDOW', 4),
(3, 'A 3', 'LEFT BOTTOM CORNER OF THE CAFE AND NEXT TO WINDOW', 2),
(4, 'B 1', 'MIDDLE TOP OF THE CAFE AND BETWEEN A 1 AND C 1', 4),
(5, 'B 2', 'MIDDLE  OF THE CAFE AND BETWEEN A 2 AND C 2', 5),
(6, 'B 3', 'MIDDLE BOTTOM OF THE CAFE AND BETWEEN A 3 AND C 3 AND NEXT TO DOOR', 6),
(7, 'C 1', 'RIGHT TOP CORNER OF THE CAFE AND NEXT TO THE WINDOW', 4),
(8, 'C 2', 'BETWEEN C 1 AND C3 AND NEXT TO THE WINDOW', 6),
(9, 'C 3', 'RIGHT BOTTOM CORNER OF THE CAFE AND NEXT TO THE WINDOW', 4);

-- --------------------------------------------------------

--
-- Table structure for table `table_list`
--

CREATE TABLE `table_list` (
  `t_id` int(10) NOT NULL,
  `t_name` varchar(20) NOT NULL,
  `place` varchar(100) NOT NULL,
  `capacity` int(20) NOT NULL,
  `table_status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_list`
--

INSERT INTO `table_list` (`t_id`, `t_name`, `place`, `capacity`, `table_status`) VALUES
(1, 'A 1', 'LEFT TOP CORNER OF THE CAFE AND NEXT TO WINDOW', 2, 1),
(2, 'A 2', 'BETWEEN A 1 AND A 3 AND NEXT TO WINDOW', 4, 1),
(3, 'A 3', 'LEFT BOTTOM CORNER OF THE CAFE AND NEXT TO WINDOW', 2, 1),
(4, 'B 1', 'MIDDLE TOP OF THE CAFE AND BETWEEN A 1 AND C 1', 4, 1),
(5, 'B 2', 'MIDDLE  OF THE CAFE AND BETWEEN A 2 AND C 2', 5, 1),
(6, 'B 3', 'MIDDLE BOTTOM OF THE CAFE AND BETWEEN A 3 AND C 3 AND NEXT TO DOOR', 6, 1),
(7, 'C 1', 'RIGHT TOP CORNER OF THE CAFE AND NEXT TO THE WINDOW', 4, 1),
(8, 'C 2', 'BETWEEN C 1 AND C3 AND NEXT TO THE WINDOW', 6, 1),
(9, 'C 3', 'RIGHT BOTTOM CORNER OF THE CAFE AND NEXT TO THE WINDOW', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `timeslot`
--

CREATE TABLE `timeslot` (
  `slotid` int(11) NOT NULL,
  `timeSlot` varchar(100) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timeslot`
--

INSERT INTO `timeslot` (`slotid`, `timeSlot`, `status`) VALUES
(1, '10:00 AM - 11:00 AM', 1),
(2, '11:00 AM - 12:00 PM', 1),
(3, '12:00 PM - 1:00 PM', 1),
(4, '1:00 PM - 2:00 PM', 1),
(5, '2:00 PM - 3:00 PM', 1),
(6, '3:00 PM - 4:00 PM', 1),
(7, '4:00 PM - 5:00 PM', 1),
(8, '5:00 PM - 6:00 PM', 1),
(9, '6:00 PM - 7:00 PM', 1),
(10, '7:00 PM - 8:00 PM', 1),
(11, '8:00 PM - 9:00 PM', 1),
(12, '9:00 PM - 10:00 PM', 1),
(13, '10:00 PM - 11:00 PM', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `u_id` int(10) NOT NULL,
  `u_name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phn` varchar(10) NOT NULL,
  `address` varchar(50) NOT NULL,
  `doj` date NOT NULL,
  `exp` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `u_name`, `email`, `phn`, `address`, `doj`, `exp`, `password`, `type`) VALUES
(25, 'roy mathew', 'roymathew@gmail.com', '9857678990', 'abraham villa,kottayam,kerala', '2023-12-01', '1 year experience in plazaa hotel', 'plmplm', 'staff'),
(26, 'don joseph', 'donjoseph@gmail.com', '8524896290', 'viskas villa ,ponjassery,ernakulam', '2023-09-01', 'nothing', 'uiouio', 'staff'),
(27, 'lucas', 'lucas@gmail.com', '8524896290', '14 th flath no atlas,kottayam,kerala', '2023-01-01', 'experienced 5 years in al-reem', 'sesg', 'chef'),
(28, 'mariya', 'mariya@gmail.com', '9867987667', '14 th flath no atlas,kottayam,kerala', '2023-12-01', 'experienced 5 years in al-reem', '9878', 'chef'),
(29, 'neymar', 'neym@gmail.com', '9447899117', 'abraham villa,kottayam,kerala', '2023-07-06', 'experienced 5 years in al-reem', 'ghjkl', 'waiter'),
(30, 'dennis', 'dennis@gmail.com', '8796459012', 'bethlehem,ernakulam', '2022-01-12', 'nothing', 'poiuyt', 'waiter');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cartchild`
--
ALTER TABLE `cartchild`
  ADD PRIMARY KEY (`ch_id`),
  ADD KEY `mt_id` (`mt_id`),
  ADD KEY `f_id` (`f_id`);

--
-- Indexes for table `cartmaster`
--
ALTER TABLE `cartmaster`
  ADD PRIMARY KEY (`cm_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryid`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`fb_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`pay_id`),
  ADD KEY `reservation_id` (`reservation_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productid`),
  ADD KEY `categoryid` (`categoryid`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchaseid`);

--
-- Indexes for table `purchase_detail`
--
ALTER TABLE `purchase_detail`
  ADD PRIMARY KEY (`pdid`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `cm_id` (`cm_id`),
  ADD KEY `slot_id` (`slot_id`),
  ADD KEY `table_id` (`table_id`);

--
-- Indexes for table `table`
--
ALTER TABLE `table`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `table_list`
--
ALTER TABLE `table_list`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `timeslot`
--
ALTER TABLE `timeslot`
  ADD PRIMARY KEY (`slotid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cartchild`
--
ALTER TABLE `cartchild`
  MODIFY `ch_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `cartmaster`
--
ALTER TABLE `cartmaster`
  MODIFY `cm_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `fb_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `f_id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `pay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchaseid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `purchase_detail`
--
ALTER TABLE `purchase_detail`
  MODIFY `pdid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `table`
--
ALTER TABLE `table`
  MODIFY `t_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cartchild`
--
ALTER TABLE `cartchild`
  ADD CONSTRAINT `cartchild_ibfk_1` FOREIGN KEY (`mt_id`) REFERENCES `cartmaster` (`cm_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cartchild_ibfk_2` FOREIGN KEY (`f_id`) REFERENCES `product` (`productid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cartmaster`
--
ALTER TABLE `cartmaster`
  ADD CONSTRAINT `cartmaster_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `register` (`c_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`reservation_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`categoryid`) REFERENCES `category` (`categoryid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `register`
--
ALTER TABLE `register`
  ADD CONSTRAINT `register_ibfk_1` FOREIGN KEY (`email`) REFERENCES `login` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`email`) REFERENCES `login` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
