-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 26, 2022 at 01:40 AM
-- Server version: 10.5.12-MariaDB
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id18552630_sensor`
--

-- --------------------------------------------------------

--
-- Table structure for table `dht22`
--

CREATE TABLE `dht22` (
  `id` int(11) NOT NULL,
  `sensor_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datetime` datetime NOT NULL,
  `temperature` float NOT NULL,
  `humidity` float NOT NULL,
  `room` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mq135`
--

CREATE TABLE `mq135` (
  `id` int(11) NOT NULL,
  `sensor_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datetime` datetime NOT NULL,
  `quality` int(10) NOT NULL,
  `room` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `name`) VALUES
('A101', 'A101'),
('A102', 'A102'),
('A202', 'A202'),
('A203', 'A203');

-- --------------------------------------------------------

--
-- Table structure for table `room_detail`
--

CREATE TABLE `room_detail` (
  `id` int(11) NOT NULL,
  `room_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room_detail`
--

INSERT INTO `room_detail` (`id`, `room_id`, `user_id`) VALUES
(1, 'A101', 'nqdinhm10'),
(2, 'A202', 'nguyennhi0200');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userEmail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userPhone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userPass` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int(10) NOT NULL,
  `status` int(10) NOT NULL DEFAULT 0,
  `code` mediumint(50) NOT NULL,
  `pstatus` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `userName`, `userEmail`, `userPhone`, `userPass`, `image`, `level`, `status`, `code`, `pstatus`) VALUES
('nguyennhi0200', 'Nguyễn Thị Yến Nhi', 'nguyennhi0200@gmail.com', '0522944955', 'e10adc3949ba59abbe56e057f20f883e', '3ebe17c5c3.jpg', 1, 0, 0, ''),
('nqdinhm10', 'Nguyễn Quan Dinh', 'nqdinhm10@gmail.com', '0987939081', '7813384ab02fb324726a636f9d9a5889', 'b8b38040ca.jpg', 0, 0, 0, ''),
('nqdinhm101', 'Nguyễn Quan Dinh1', 'nqdinhm110@gmail.com', '0987939082', 'e10adc3949ba59abbe56e057f20f883e', 'd7ed47cf05.', 2, 0, 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dht22`
--
ALTER TABLE `dht22`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room` (`room`);

--
-- Indexes for table `mq135`
--
ALTER TABLE `mq135`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room` (`room`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_detail`
--
ALTER TABLE `room_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dht22`
--
ALTER TABLE `dht22`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `mq135`
--
ALTER TABLE `mq135`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room_detail`
--
ALTER TABLE `room_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dht22`
--
ALTER TABLE `dht22`
  ADD CONSTRAINT `dht22_ibfk_1` FOREIGN KEY (`room`) REFERENCES `room` (`id`);

--
-- Constraints for table `mq135`
--
ALTER TABLE `mq135`
  ADD CONSTRAINT `mq135_ibfk_1` FOREIGN KEY (`room`) REFERENCES `room` (`id`);

--
-- Constraints for table `room_detail`
--
ALTER TABLE `room_detail`
  ADD CONSTRAINT `room_detail_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`userId`),
  ADD CONSTRAINT `room_detail_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
