-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2017 at 05:37 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.0.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cakeforum`
--

-- --------------------------------------------------------

--
-- Table structure for table `phinxlog`
--

CREATE TABLE `phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phinxlog`
--

INSERT INTO `phinxlog` (`version`, `migration_name`, `start_time`, `end_time`, `breakpoint`) VALUES
(20171103125904, 'Initial', '2017-11-03 07:29:04', '2017-11-03 07:29:04', 0);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `body` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `topic_id`, `user_id`, `body`, `created`, `modified`) VALUES
(1, 1, 1, 'Demo Post ', '2017-11-03 15:35:33', '2017-11-03 15:35:33'),
(2, 1, 2, 'Post 2 on demo title', '2017-11-04 10:24:02', '2017-11-04 10:24:02'),
(3, 2, 3, 'post on firoz topic a regular user', '2017-11-08 07:54:26', '2017-11-08 07:54:26'),
(5, 2, 3, 'Post 2 ', '2017-11-08 08:29:31', '2017-11-08 08:29:31');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(225) NOT NULL,
  `visibility` int(1) NOT NULL COMMENT '1 for visible, 2 for hidden',
  `created` datetime NOT NULL,
  `modified` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `user_id`, `title`, `visibility`, `created`, `modified`) VALUES
(1, 1, 'Demo Title', 1, '2017-11-03 15:34:51', '2017-11-03'),
(2, 3, 'Topic by firoz regular user', 1, '2017-11-05 10:58:00', '2017-11-08'),
(3, 1, 'Demo title 2 ', 2, '2017-11-06 12:48:22', '2017-11-06'),
(4, 3, 'firoz topic ', 2, '2017-11-07 12:10:28', '2017-11-07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` int(15) NOT NULL,
  `role` int(1) NOT NULL COMMENT '1 for admin, 2 for regular user',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `full_name`, `email`, `phone`, `role`, `created`, `modified`) VALUES
(1, 'Kriti', '$2y$10$IIqsDx59hwndhPMpY.RSb.HyiAFu5QyroyE4sYbioyL0yIN.0v9Ci', 'Kriti Sanon', 'kriti@test.com', 2147483647, 2, '2017-11-03 14:52:27', '2017-11-04 11:02:10'),
(2, 'Dia', '$2y$10$/w8auvMkIjzoN/XM3PaIr.uH5XABmXK2UsaU3ZjBXtxDk9QBaWB.W', 'Dia Bhatia', 'dia@test.com', 2147483647, 1, '2017-11-03 17:57:05', '2017-11-03 17:57:05'),
(3, 'Firoz', '$2y$10$8rdoQ1IzT/AiBzFhNndrYen/99oSR21xM9czX/0xiiAea/sBsIwJ.', 'Firoz Baksh', 'firoz@test.com', 2147483647, 1, '2017-11-05 10:51:45', '2017-11-05 10:51:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `phinxlog`
--
ALTER TABLE `phinxlog`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
