-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2018 at 05:06 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `decoders`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

CREATE TABLE `candidate` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `usn` varchar(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `year` varchar(11) NOT NULL,
  `branch` varchar(11) NOT NULL,
  `cgpa` varchar(11) NOT NULL,
  `image` varchar(50) NOT NULL,
  `resume` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `candidate`
--

INSERT INTO `candidate` (`id`, `name`, `usn`, `email`, `phone`, `year`, `branch`, `cgpa`, `image`, `resume`) VALUES
(29, 'Mitesh Vishwakarma', '1SI15CS059', 'mitesh.vishwakarma@gmail.com', '9738160729', '1st Year', 'CSE', '9.40', 'title.jpg', 'new.pdf'),
(30, 'Lokesh Kumar Gupta', '1SI15CS053', 'lkshgupta@gmail.com', '7795767332', '2nd Year', 'CSE', '10', 'lokesh.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `candidate_name` varchar(50) NOT NULL,
  `reviewer1` varchar(30) NOT NULL,
  `reviewer2` varchar(30) NOT NULL,
  `action` varchar(10) NOT NULL,
  `comments` varchar(200) NOT NULL,
  `recommend_to` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `candidate_name`, `reviewer1`, `reviewer2`, `action`, `comments`, `recommend_to`) VALUES
(2, 'Lokesh Kumar Gupta', 'rishav', 'bruce', 'recommend', 'sldkgns kjghsfog', 'alfred'),
(3, 'Lokesh Kumar Gupta', 'rishav', 'bruce', 'recommend', 'sldkgns kjghsfog', 'alfred'),
(4, 'Lokesh Kumar Gupta', 'rishav', 'bruce', 'recommend', 'sldkgns kjghsfog', 'alfred');

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `id` int(11) NOT NULL,
  `usn` varchar(30) NOT NULL,
  `score1` float NOT NULL,
  `score2` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scores`
--

INSERT INTO `scores` (`id`, `usn`, `score1`, `score2`) VALUES
(1, '1SI15CS059', 20.02, 20.33),
(2, '1SI15CS053', 20.33, 50.33);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(25, 'mitesh', '$2y$10$KLMNOPCBARQPZYXPOIUYROjqp.uRrMHj2042YzAnWd61F1wddsiya'),
(26, 'wilson', '$2y$10$KLMNOPCBARQPZYXPOIUYRODam3HD1qtWJenHXdFmKd2ABEuFzDb5W'),
(27, 'peter', '$2y$10$KLMNOPCBARQPZYXPOIUYRODam3HD1qtWJenHXdFmKd2ABEuFzDb5W'),
(28, 'bruce', '$2y$10$KLMNOPCBARQPZYXPOIUYROyYvhAAPrF2WjBZelz1mwkTDu2x0AiUO'),
(29, 'alfred', '$2y$10$KLMNOPCBARQPZYXPOIUYRODam3HD1qtWJenHXdFmKd2ABEuFzDb5W'),
(30, 'rishav', '$2y$10$KLMNOPCBARQPZYXPOIUYRODam3HD1qtWJenHXdFmKd2ABEuFzDb5W'),
(31, 'admin', '$2y$10$KLMNOPCBARQPZYXPOIUYROrV2D0jjFJKBjfL51VXtdnFg4WujEb1O'),
(32, 'mdn', '$2y$10$KLMNOPCBARQPZYXPOIUYROmb8JU3sVVc1w7xJ4tQuFliIWKTShzje'),
(33, 'Kush', '$2y$10$KLMNOPCBARQPZYXPOIUYROBDzXDJz5yGeoApxVytWyZNsy/ZLiajG'),
(34, 'newUser', '$2y$10$KLMNOPCBARQPZYXPOIUYRODam3HD1qtWJenHXdFmKd2ABEuFzDb5W'),
(35, 'aayush', '$2y$10$KLMNOPCBARQPZYXPOIUYROJqSIJtuZljcWG0esNUPvnZ.eKvxt5Jy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidate`
--
ALTER TABLE `candidate`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usn` (`usn`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usn` (`usn`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidate`
--
ALTER TABLE `candidate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
