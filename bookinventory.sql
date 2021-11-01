-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2021 at 02:42 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookinventory`
--

CREATE TABLE `bookinventory` (
  `product_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `detail` varchar(200) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(200) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookinventory`
--

INSERT INTO `bookinventory` (`product_id`, `name`, `detail`, `price`, `image`, `quantity`) VALUES
(1, 'The Secret', 'In this powerful book you learn the secrets of the law of attraction and how to apply them in your own life to achieve your greatest success.', 100, 'the_secret.jpg', 5),
(2, 'Why We Sleep', 'I have been fascinated by sleep for as long as I can remember, reading countless books and studies on the subject. When I found out that Walker, a British scientist and professor of neuroscience and p', 170, 'why_we_sleep.jpg', 0),
(3, 'Change Your Life And Keep The Change', 'Change Your Life And Keep The Change', 19, 'Change_Your_Life.jpg', 5),
(4, 'You Are What You Think', '365 musings and reflections drawn from the work of international best-selling author and beloved spiritual teacher, Dr. Wayne W. Dyer.', 29, 'you_are_what_you_think.jpg', 9),
(5, 'Attitude Is Everything', 'Attitude Is Everything: Change Your Attitude... Change Your Life!', 22, 'attitude_is_everything.jpg', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookinventory`
--
ALTER TABLE `bookinventory`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookinventory`
--
ALTER TABLE `bookinventory`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
