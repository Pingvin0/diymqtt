-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2020 at 10:59 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `diymqtt`
--

-- --------------------------------------------------------

--
-- Table structure for table `channelmsg`
--

CREATE TABLE `channelmsg` (
  `id` int(11) NOT NULL,
  `channel_id` int(11) NOT NULL,
  `msg` varchar(30) COLLATE utf8mb4_bin NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `channelmsg`
--

INSERT INTO `channelmsg` (`id`, `channel_id`, `msg`, `time`) VALUES
(1, 18, 'Szia', '2020-01-27 22:46:22'),
(2, 18, 'Sziahe', '2020-01-27 22:46:27'),
(3, 18, 'Sziahe', '2020-01-27 22:48:25'),
(4, 18, '0', '2020-01-27 22:54:12');

-- --------------------------------------------------------

--
-- Table structure for table `channels`
--

CREATE TABLE `channels` (
  `id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_bin NOT NULL,
  `owner` int(11) NOT NULL,
  `API_KEY` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `active` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `channels`
--

INSERT INTO `channels` (`id`, `name`, `owner`, `API_KEY`, `active`) VALUES
(1, 'Teszt', 1, '8de6b06f7d4912fb', 0),
(2, 'ESP32', 1, 'bc137c2e1ab3442d', 0),
(3, 'ESP32', 1, 'b24c80fac490d1c7', 0),
(4, 'asdasd', 1, '308b8bdec49cf6af', 0),
(5, 'dsad', 1, 'bf84edb5b15a9cb9', 0),
(6, 'asdasd', 1, '34bc60598fe8c1da', 0),
(7, 'qweqwe', 1, '2658963da544ba37', 0),
(8, 'qweqwe', 1, 'cc868c89c50c39a7', 0),
(9, 'asdasdasda', 1, 'a40671b831ee257a', 0),
(10, 'eweqwe', 1, '64757e0a69f85a36', 0),
(11, 'eweqwe', 1, '04e6db720e1b9b6d', 0),
(12, 'eweqwe', 1, 'b31500eb56ba6641', 0),
(13, 'eweqwe', 1, 'fb1ff2a33f131632', 0),
(14, 'eweqwe', 1, '934ffe8b84ef324e', 0),
(15, 'eweqwe', 1, 'fc289374ca456e62', 0),
(16, 'asdasd', 1, '0c7e45f50eae51d4', 0),
(17, 'asdasd', 1, 'fa5695bf644edb0c', 0),
(18, 'asd3123', 1, '5657fd8987e7883b', 1);

-- --------------------------------------------------------

--
-- Table structure for table `passrecovery`
--

CREATE TABLE `passrecovery` (
  `id` int(11) NOT NULL,
  `token_hash` varchar(65) COLLATE utf8mb4_bin NOT NULL,
  `foruid` int(11) NOT NULL,
  `used` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(15) COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(120) COLLATE utf8mb4_bin NOT NULL,
  `register_date` datetime NOT NULL DEFAULT current_timestamp(),
  `admin` int(1) NOT NULL,
  `id` int(11) NOT NULL,
  `banned` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `register_date`, `admin`, `id`, `banned`) VALUES
('Pingvin0', '$2y$10$sCvJzGb.1QzdgYwIpSqRYOjC2so4xvT3OkmndCoPvQ5440ynItPqq', '2020-01-20 20:08:12', 1, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `channelmsg`
--
ALTER TABLE `channelmsg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `channels`
--
ALTER TABLE `channels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `API_KEY` (`API_KEY`);

--
-- Indexes for table `passrecovery`
--
ALTER TABLE `passrecovery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `channelmsg`
--
ALTER TABLE `channelmsg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `channels`
--
ALTER TABLE `channels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `passrecovery`
--
ALTER TABLE `passrecovery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
