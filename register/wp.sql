-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2021 at 07:46 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wp`
--

-- --------------------------------------------------------

--
-- Table structure for table `users_web`
--

CREATE TABLE `users_web` (
  `id_user` int(11) NOT NULL,
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `code` char(40) COLLATE utf8_unicode_ci NOT NULL,
  `registration_expires` datetime NOT NULL,
  `active` smallint(1) NOT NULL DEFAULT 0,
  `code_password` char(40) COLLATE utf8_unicode_ci NOT NULL,
  `new_password_expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users_web`
--

INSERT INTO `users_web` (`id_user`, `username`, `firstname`, `lastname`, `password`, `email`, `code`, `registration_expires`, `active`, `code_password`, `new_password_expires`) VALUES
(1, 'john', 'John', 'Malkowich', '$2y$10$Lrtl9YZAjyjp8ptP6Jg4CeRd3PXHcBff2et007wuj7Cce97SZ0zfq', 'john@gmail.com', '', '2021-04-17 21:53:58', 1, '', '2021-04-17 21:53:58');

-- --------------------------------------------------------

--
-- Table structure for table `user_email_failure`
--

CREATE TABLE `user_email_failure` (
  `id_user_email_failure` int(11) NOT NULL,
  `id_user_web` int(11) NOT NULL,
  `date_time_added` datetime NOT NULL,
  `date_time_tried` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users_web`
--
ALTER TABLE `users_web`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `user_email_failure`
--
ALTER TABLE `user_email_failure`
  ADD PRIMARY KEY (`id_user_email_failure`),
  ADD KEY `id_user_web` (`id_user_web`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users_web`
--
ALTER TABLE `users_web`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_email_failure`
--
ALTER TABLE `user_email_failure`
  MODIFY `id_user_email_failure` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_email_failure`
--
ALTER TABLE `user_email_failure`
  ADD CONSTRAINT `user_email_failure_ibfk_1` FOREIGN KEY (`id_user_web`) REFERENCES `users_web` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
