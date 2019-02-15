-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 06, 2019 at 12:49 AM
-- Server version: 5.7.17-log
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `geolocate`
--

-- --------------------------------------------------------

--
-- Table structure for table `eventarea`
--

CREATE TABLE `eventarea` (
  `event_id` int(11) UNSIGNED ZEROFILL NOT NULL,
  `locate_url` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `event_title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `event_des` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `event_link` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `event_Latitude` decimal(18,15) NOT NULL,
  `event_Longitude` decimal(18,15) NOT NULL,
  `event_icon` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `event_pic` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `event_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `highadmin`
--

CREATE TABLE `highadmin` (
  `user_id` int(5) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `LoginStatus` int(1) NOT NULL,
  `LastUpdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `highadmin`
--

INSERT INTO `highadmin` (`user_id`, `name`, `email`, `password`, `LoginStatus`, `LastUpdate`) VALUES
(1, 'SystemAdmin', 'SystemAdmin@info.com', '0ac5a99209a978323b0686cd8ae8cbb0', 0, '2017-06-06 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `location_id` int(11) NOT NULL,
  `Latitude` decimal(18,15) NOT NULL,
  `Longitude` decimal(18,15) NOT NULL,
  `Zoom` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `maplocate`
--

CREATE TABLE `maplocate` (
  `locate_id` int(11) UNSIGNED ZEROFILL NOT NULL,
  `locate_province` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `locate_title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `locate_des` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `locate_Latitude` decimal(18,15) NOT NULL,
  `locate_Longitude` decimal(18,15) NOT NULL,
  `locate_zoom` int(5) NOT NULL,
  `locate_url` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `locate_icon` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `locate_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `officeradmin`
--

CREATE TABLE `officeradmin` (
  `user_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `user` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `officeradmin`
--

INSERT INTO `officeradmin` (`user_id`, `name`, `user`, `email`, `password`, `LastUpdate`) VALUES
(00002, 'Napat Natawaruk', 'YuiiNapat', 'Napat@exotravel.com', '64bddc3ca51ad547e43f8e65cb5e2318', '2017-06-07 07:30:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eventarea`
--
ALTER TABLE `eventarea`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `highadmin`
--
ALTER TABLE `highadmin`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `maplocate`
--
ALTER TABLE `maplocate`
  ADD PRIMARY KEY (`locate_id`);

--
-- Indexes for table `officeradmin`
--
ALTER TABLE `officeradmin`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eventarea`
--
ALTER TABLE `eventarea`
  MODIFY `event_id` int(11) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `highadmin`
--
ALTER TABLE `highadmin`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `maplocate`
--
ALTER TABLE `maplocate`
  MODIFY `locate_id` int(11) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `officeradmin`
--
ALTER TABLE `officeradmin`
  MODIFY `user_id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
