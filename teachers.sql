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
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `username` varchar(20) DEFAULT NULL,
  `teacher_password` varchar(100) DEFAULT NULL,
  `cid` int(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `tid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`username`, `teacher_password`, `cid`, `email`, `tid`) VALUES
('salama', '7b2f04d62ba55b3446e1398d6016c39d', 2, 'salama@edu.com', 2),
('hossam', 'a92e512369d49967e42287b7972b24dd', 1, 'hossam@edu.com', 3),
('yousry', '776a2934a5fb835933b567450e840757', 3, 'yousry@gmail.com', 4),
('layla', '5de7c015d605d6ee58fa636e7140000a', 4, 'layla@edu.com', 5),
('hanya', '8e0b7192f14fc84fd2bea92eadacebef', 5, 'hanya@edu.com', 6),
('keshk', '621581976bdc504a719283b14ce0e620', 6, 'keshk@edu.com', 7),
('mongui', '8ccceb613354b9304b639f67510d3f8c', 7, 'mongui@edu.com', 8),
('nahla', '3740d1fbf474dc4ea9bd6763afe82bf3', 8, 'nahla@edu.com', 9),
('mervat', 'd301f3b796b8e2e2b13baac6633e85c5', 9, 'mervat@edu.com', 10),
('noha', 'ef944c8fcce0e2647144a668ff5010f0', 10, 'noha@edu.com', 11),
('sallam', 'b354ed52315949d16030f57403448a26', 11, 'sallam@gmail.com', 14);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`tid`),
  ADD KEY `cid` (`cid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `courses` (`cid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
