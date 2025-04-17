-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2025 at 03:54 PM
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
-- Database: `f1_tickets`
--

-- --------------------------------------------------------

--
-- Table structure for table `races`
--

CREATE TABLE `races` (
  `id` int(11) NOT NULL,
  `round_number` int(11) NOT NULL,
  `country` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `race_date` date NOT NULL,
  `track` varchar(150) NOT NULL,
  `track_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `races`
--

INSERT INTO `races` (`id`, `round_number`, `country`, `city`, `race_date`, `track`, `track_image`) VALUES
(2, 2, 'China', 'Shanghai', '2025-03-23', 'Shanghai International Circuit', 'China.AVIF'),
(4, 4, 'Bahrain', 'Sakhir', '2025-04-13', 'Bahrain International Circuit', 'Bahrain.AVIF'),
(5, 5, 'Saudi Arabia', 'Jeddah', '2025-04-20', 'Jeddah Street Circuit', 'Saudi.AVIF'),
(6, 6, 'USA', 'Miami', '2025-05-04', 'Miami International Autodrome', 'Miami.AVIF'),
(7, 7, 'Italy', 'Imola', '2025-05-16', 'Imola Circuit', 'Italy.AVIF'),
(8, 8, 'Monaco', 'Monaco', '2025-05-25', 'Circuit de Monaco', 'Monaco.AVIF'),
(9, 9, 'Spain', 'Barcelona', '2025-06-01', 'Circuit de Barcelona-Catalunya', 'Spain.AVIF'),
(10, 10, 'Canada', 'Montreal', '2025-06-15', 'Circuit Gilles Villeneuve', 'Canada.AVIF'),
(11, 11, 'Austria', 'Spielberg', '2025-06-29', 'Red Bull Ring', 'Austria.AVIF');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `race_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `seats_reserved` int(11) NOT NULL,
  `approved` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `race_id`, `full_name`, `email`, `seats_reserved`, `approved`) VALUES
(5, 4, 'Tringa ', 'ffetahu@gmail.com', 3, 1),
(6, 4, 'Tringellima', 'tfetahu@gmail.com', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `role`) VALUES
(1, '', 'tringa@gmail.com', '$2y$10$RxIEVIK6JUDk7YsnUKY36O5wxhuqCxjjpRsdZY74fSZjkRjwpRkMC', 'user'),
(2, 'Tringa ', 'tringafetahu@gmail.com', '$2y$10$0QiAF8woGvqPo6DvsCamB.txaHxX5hJebgj380jxmhuHyQGhLIQbW', 'admin'),
(4, 'Tringa', 'ffetahu@gmail.com', '$2y$10$ge095//27rH/SkqH7.yRD.qQZ/gYpCgnMFunG6ieByqT7b8ae2sn6', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `races`
--
ALTER TABLE `races`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `race_id` (`race_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `races`
--
ALTER TABLE `races`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`race_id`) REFERENCES `races` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
