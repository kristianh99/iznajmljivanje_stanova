-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2021 at 07:36 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `real_estate`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` int(11) NOT NULL,
  `image` varchar(40) NOT NULL,
  `location` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `rent_start` date NOT NULL,
  `rent_end` date NOT NULL,
  `price` varchar(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT 0,
  `property_type` int(11) NOT NULL,
  `rented_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `image`, `location`, `description`, `rent_start`, `rent_end`, `price`, `user_id`, `active`, `property_type`, `rented_by`) VALUES
(10, '956.jpg', 'Subotica', 'asdasdasdasdasd', '2021-07-20', '2021-07-21', '50', 8, 1, 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `ads_id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `userid` int(11) NOT NULL,
  `comment_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `ads_id`, `code`, `userid`, `comment_date`) VALUES
(1, 'e', 10, '22', 2, '2021-08-01');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `seen` int(2) NOT NULL DEFAULT 0,
  `message` varchar(255) NOT NULL,
  `new_conversation` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `property_types`
--

CREATE TABLE `property_types` (
  `ID` int(11) NOT NULL,
  `property_type` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `property_types`
--

INSERT INTO `property_types` (`ID`, `property_type`) VALUES
(3, 'Kuća'),
(4, 'Stan');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `firstname` varchar(40) NOT NULL,
  `lastname` varchar(40) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` int(11) NOT NULL,
  `code` char(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `registration_expires` datetime NOT NULL,
  `active` smallint(1) NOT NULL DEFAULT 0,
  `code_password` char(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `new_password_expires` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `email`, `firstname`, `lastname`, `phone`, `password`, `user_type`, `code`, `registration_expires`, `active`, `code_password`, `new_password_expires`) VALUES
(1, 'vktrnagy64@gmail.com', 'vktrnagy64@gmail.com', 'Teszt', 'Teszte', '0123456', '$2y$10$Uf4FNw8jRNbVcd6dG2N55.H9IOVmgZuezEp/Fpbfoh.8SyfWykMwu', 1, 'QmmfrxzCxyarwzOgurvvhEbvyfdbFrlcbliMayqw', '2021-07-16 22:22:37', 1, NULL, NULL),
(2, 'henriettaangelovity@gmail.com', 'henriettaangelovity@gmail.com', 'heniq', 'heni', '0123456', '$2y$10$woVTLEjEYFse8KhZ9Dw/m..ygnDff2sU98tTY3k62ZTvTX0MMoOUS', 2, 'YtbfwiXxgylbCnjhktYwbzgmSubnrcWxxqyoDsys', '2021-07-26 16:10:19', 0, NULL, NULL),
(8, 'va@asd.com', 'va@asd.com', 'heniq', 'heni', '0123456', '$2y$10$mnVACVs7S0pNs7HffkCa0.xS7tpMegPn4Pifoi7N6I.VZfD4U/4nS', 3, 'KooyxkliYuinxjniZqlgmtfsYvgwmgueZdsqpjjr', '2021-07-26 21:15:30', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `ID` int(11) NOT NULL,
  `user_type` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`ID`, `user_type`) VALUES
(1, 'admin'),
(2, 'user'),
(3, 'guest');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_types`
--
ALTER TABLE `property_types`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `user_type` (`user_type`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `property_types`
--
ALTER TABLE `property_types`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ads`
--
ALTER TABLE `ads`
  ADD CONSTRAINT `Property_type` FOREIGN KEY (`property_type`) REFERENCES `property_types` (`ID`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `User_type` FOREIGN KEY (`user_type`) REFERENCES `user_types` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
