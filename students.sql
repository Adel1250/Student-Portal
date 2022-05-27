-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2022 at 09:48 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student-portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(4) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `gpa` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `username`, `password`, `email`, `gpa`) VALUES
(6234, 'mariam', '6855fddfdc611b6e7778e712fd7245a4', 'mariam@edu.com', '2.10'),
(6253, 'ramy', 'a46c5de3a5314f730c37814106135110', 'ramy@edu.com', '0.00'),
(6297, 'adel', 'cf5db12eb900dc8d639bb39239d8d9dc', 'adel@edu.com', '3.35'),
(6376, 'aya', '68f80a65d2cf05f3780e012701e07e12', 'aya@gmail.com', '2.57'),
(6511, 'karim', 'b8920970984f4520877be62372addf43', 'karim@edu.com', '0.00'),
(6666, 'samy', 'd2a7774d2a9e86bc9fecbf6eac35411a', 'samy@edu.com', '0.00'),
(6723, 'ahmed', '73d1ef8e4c183276f5c99b6ef965d0d7', 'ahmed@edu.com', '2.30'),
(6731, 'omar', '14aaa31ccb63f5ed18ebb0e5cf50433c', 'omar@edu.com', '0.00'),
(6781, 'kamal', '51a17e16cfd9a8651b49ad826e166fc7', 'kamal@edu.com', '0.00'),
(6991, 'nour', '2b373ed065e35d35cfe05a0e0edfd923', 'nour@edu.com', '0.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
