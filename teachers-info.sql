-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2023 at 08:13 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `teachers-info`
--

-- --------------------------------------------------------

--
-- Table structure for table `collage_info`
--

CREATE TABLE `collage_info` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `mail` int(11) NOT NULL,
  `phone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `collage_info`
--

INSERT INTO `collage_info` (`id`, `name`, `mail`, `phone`) VALUES
(8, 'wdadzxd', 54984, 44454545),
(9, 'sda', 266, 6565),
(10, 'dsads', 3545, 65465),
(11, 'nidal', 156456, 545),
(12, 'SDFSDF', 6464, 6464),
(13, 'assdasda', 5646, 45454),
(14, '\'', 656, 65);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `collage_info`
--
ALTER TABLE `collage_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `collage_info`
--
ALTER TABLE `collage_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
