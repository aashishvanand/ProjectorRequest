-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 21, 2017 at 11:00 PM
-- Server version: 5.7.17-0ubuntu0.16.04.1
-- PHP Version: 7.0.13-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projector`
--

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `sno` int(11) NOT NULL,
  `date` date NOT NULL,
  `hour` int(2) NOT NULL,
  `staffcode` varchar(5) NOT NULL,
  `requesttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `projector` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`sno`, `date`, `hour`, `staffcode`, `requesttime`, `projector`) VALUES
(1, '2017-01-19', 1, 'cs01', '2017-01-19 16:50:20', 'epson'),
(2, '2017-01-19', 3, 'cs01', '2017-01-19 16:55:41', 'epson'),
(3, '2017-01-20', 2, 'cs01', '2017-01-19 16:55:49', 'epson'),
(4, '2017-01-22', 2, 'cs05', '2017-01-19 16:56:09', 'epson'),
(5, '2017-01-22', 6, 'cs888', '2017-01-21 08:59:58', 'epson'),
(6, '2017-01-22', 1, 'cs888', '2017-01-21 09:01:40', 'epson'),
(7, '2017-01-23', 1, 'cs888', '2017-01-21 09:02:36', 'dell'),
(8, '2017-01-23', 2, 'cs888', '2017-01-21 09:03:03', 'epson'),
(9, '2017-01-22', 1, 'cs123', '2017-01-21 09:34:49', 'canon'),
(10, '2017-01-24', 1, 'cs123', '2017-01-21 09:35:13', 'canon'),
(11, '2017-01-25', 1, 'cs123', '2017-01-21 16:32:46', 'epson'),
(12, '2017-01-25', 2, 'cs123', '2017-01-21 16:36:13', 'hp');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`sno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
