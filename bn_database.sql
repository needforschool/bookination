-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 12, 2020 at 11:19 AM
-- Server version: 5.7.30
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookination`
--

-- --------------------------------------------------------

--
-- Table structure for table `bn_contact`
--

CREATE TABLE `bn_contact` (
  `id` int(11) NOT NULL,
  `mail` varchar(160) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bn_reminders`
--

CREATE TABLE `bn_reminders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vaccine_id` int(11) NOT NULL,
  `last_injection` date NOT NULL,
  `reminder` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bn_users`
--

CREATE TABLE `bn_users` (
  `id` int(11) NOT NULL,
  `mail` int(160) NOT NULL,
  `password` int(250) NOT NULL,
  `token` int(255) NOT NULL,
  `firstname` int(100) NOT NULL,
  `lastname` int(100) NOT NULL,
  `birthdate` date NOT NULL,
  `gender` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bn_vaccines`
--

CREATE TABLE `bn_vaccines` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mandatory` tinyint(1) NOT NULL,
  `frequency` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bn_contact`
--
ALTER TABLE `bn_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bn_reminders`
--
ALTER TABLE `bn_reminders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reminder_user_id` (`user_id`),
  ADD KEY `reminder_vaccines_id` (`vaccine_id`);

--
-- Indexes for table `bn_users`
--
ALTER TABLE `bn_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bn_vaccines`
--
ALTER TABLE `bn_vaccines`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bn_contact`
--
ALTER TABLE `bn_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bn_reminders`
--
ALTER TABLE `bn_reminders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bn_users`
--
ALTER TABLE `bn_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bn_vaccines`
--
ALTER TABLE `bn_vaccines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bn_reminders`
--
ALTER TABLE `bn_reminders`
  ADD CONSTRAINT `reminder_user_id` FOREIGN KEY (`user_id`) REFERENCES `bn_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reminder_vaccines_id` FOREIGN KEY (`vaccine_id`) REFERENCES `bn_vaccines` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
