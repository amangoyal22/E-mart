-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2017 at 07:43 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `emart`
--
CREATE DATABASE IF NOT EXISTS `emart` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `emart`;

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE `books` (
  `userid` int(11) NOT NULL,
  `b_id` int(11) NOT NULL,
  `b_name` varchar(100) NOT NULL,
  `b_author` varchar(100) NOT NULL,
  `b_image` varchar(100) NOT NULL,
  `b_edition` varchar(100) NOT NULL,
  `b_desc` varchar(100) NOT NULL,
  `b_price` int(100) NOT NULL,
  `b_mobile` bigint(10) DEFAULT NULL,
  `b_rating` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`userid`, `b_id`, `b_name`, `b_author`, `b_image`, `b_edition`, `b_desc`, `b_price`, `b_mobile`, `b_rating`) VALUES
(1, 3, 'zFds', 'bhjsfuysgi', 'upload/zFdsws_Funny_Graffiti_Black___White_1600x1200.jpg', '944', '549849', 848, 48849, 0),
(1, 4, 'asdg', 'sgrge', 'upload/_asdg_Screenshot (11).png', '48', 'dsasdgvs', 4848, 21659649, 0),
(1, 5, 'sggasgghdh', 'dfnkjnlfshud', 'upload/1_sggasgghdh_Screenshot (12).png', '6', 'jhbdskfufsku', 559, 9874561233, 2),
(1, 8, 'edewd', '4545', 'upload/1_edewd_539381.jpg', '454', '455454545', 4554, 4545, 0),
(1, 9, '448', '84848', 'upload/1_448_526885.jpg', '4848', '848', 448, 484, 0),
(1, 10, 'RD', 'RD', 'upload/1_RD_ugmonk-bag-2.jpg', '2', 'Books For YOU', 450, 97900, 0),
(10, 11, 'RUUUU', 'RUUUU', 'upload/10_RUUUU_ugmonk-bag-2.jpg', '2', 'amangoyal', 1, 9790052239, 0);

-- --------------------------------------------------------

--
-- Table structure for table `electronics`
--

DROP TABLE IF EXISTS `electronics`;
CREATE TABLE `electronics` (
  `userid` int(11) NOT NULL,
  `e_id` int(11) NOT NULL,
  `e_name` varchar(100) NOT NULL,
  `e_desc` varchar(1000) NOT NULL,
  `e_mobile` bigint(10) DEFAULT NULL,
  `e_image` varchar(1000) NOT NULL,
  `e_price` int(100) NOT NULL,
  `e_rating` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `electronics`
--

INSERT INTO `electronics` (`userid`, `e_id`, `e_name`, `e_desc`, `e_mobile`, `e_image`, `e_price`, `e_rating`) VALUES
(1, 10, 'aman', '77787878', 788888, 'upload/1_aman_3.jpg', 78, 2);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE `feedback` (
  `user_id` int(11) NOT NULL,
  `feedback` varchar(200) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `market`
--

DROP TABLE IF EXISTS `market`;
CREATE TABLE `market` (
  `sellerid` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `buyerid` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `Category` varchar(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `market`
--

INSERT INTO `market` (`sellerid`, `product_id`, `buyerid`, `status`, `Category`) VALUES
(1, 4, 3, 1, 'books'),
(1, 3, 2, 1, 'books'),
(1, 5, NULL, 0, 'books'),
(1, 10, 2, 1, 'electronics'),
(1, 10, 2, 1, 'books'),
(10, 11, NULL, 0, 'books');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `f_name` varchar(100) NOT NULL,
  `l_name` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `f_name`, `l_name`, `email`, `password`) VALUES
(1, 'Aman', 'Goyal', 'aman.goyalvit@gmail.com', '1289'),
(2, 'A', 'a', 'aman.g@v.com', 'aman'),
(10, 'a', 'a', 'aman.g@vit.com', 'aaaa'),
(11, 'Aman', 'Goyal', 'amana.3@gmail.com', 'aaa'),
(13, 'a', 'asdd', 'a@gm.com', 'aaa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`b_id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `electronics`
--
ALTER TABLE `electronics`
  ADD PRIMARY KEY (`e_id`),
  ADD UNIQUE KEY `e_name` (`e_name`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `market`
--
ALTER TABLE `market`
  ADD KEY `buyerid` (`buyerid`),
  ADD KEY `sellerid` (`sellerid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`,`email`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `electronics`
--
ALTER TABLE `electronics`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `electronics`
--
ALTER TABLE `electronics`
  ADD CONSTRAINT `electronics_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
