-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2019 at 10:50 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rota`
--

-- --------------------------------------------------------

--
-- Table structure for table `officerauthentication`
--

CREATE TABLE `officerauthentication` (
  `ID` int(11) NOT NULL,
  `officerID` int(10) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `officerauthentication`
--

INSERT INTO `officerauthentication` (`ID`, `officerID`, `userName`, `password`) VALUES
(1, 32608135, 'oscar', 'oscar'),
(2, 32608135, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `rotausersduty`
--

CREATE TABLE `rotausersduty` (
  `ID` int(10) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `dutyDate` date NOT NULL,
  `morningDuty` varchar(255) NOT NULL,
  `morningVenue` varchar(255) NOT NULL,
  `afternoonDuty` varchar(255) NOT NULL,
  `afternoonVenue` varchar(255) NOT NULL,
  `morningStatus` enum('pending','active','ended','') NOT NULL DEFAULT 'pending',
  `afternoonStatus` enum('pending','active','ended','') NOT NULL DEFAULT 'pending',
  `comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rotausersduty`
--

INSERT INTO `rotausersduty` (`ID`, `userName`, `dutyDate`, `morningDuty`, `morningVenue`, `afternoonDuty`, `afternoonVenue`, `morningStatus`, `afternoonStatus`, `comment`) VALUES
(1, 'Oscar Hazard', '2019-03-18', 'editing', 'Staffroom', 'meeting master himself', 'Flamingo hotel', 'pending', 'pending', 'Cool'),
(2, 'Osacar', '2019-03-19', 'kjhjkh', 'lkjhkjh', 'jkhjk', 'hjlkjlk', 'pending', 'pending', 'jlkjkljlk'),
(3, 'Osacar', '2019-03-11', 'Oscar', 'Hazard', 'kjhaijhkj', 'gighikhkj', 'pending', 'pending', 'jkhkjlh'),
(4, 'Osacar', '2019-03-11', 'kjhjkh', 'kjhkjhjk', 'hkjhlkj', 'kjhbkjhjkl', 'pending', 'pending', 'kbhjkh'),
(5, 'Osacar', '2019-03-11', 'hjgvbhk', 'kjhkl', 'hkl', 'hlkhjl', 'pending', 'pending', 'lkhnklh'),
(6, 'Osacar', '2019-03-11', 'ghjkh', 'hljkhljk', 'hjkhkljh', 'kjhjkh', 'pending', 'pending', 'hljhkl'),
(7, 'Osacar', '2019-03-13', 'Editting', 'Staffroom', 'meeting', 'Other place', 'pending', 'pending', 'This is another test of the system'),
(8, 'oscar', '2019-03-19', 'Sweep', 'classroom', 'watchin', 'theater', 'pending', 'pending', ''),
(9, 'oscar', '2019-03-20', 'catwalking', 'parade', 'sleepingq', 'bed', 'pending', 'pending', ''),
(10, 'Osacar', '2019-03-19', 'cleaning', 'laundry', 'running', 'field', 'pending', 'pending', 'hahahha'),
(11, 'Osacar', '2019-03-20', 'cleaning', 'Staffroom', 'running', 'Other place', 'pending', 'pending', 'hgjk'),
(12, 'oscar', '2019-03-21', 'hiuyhio', 'Staffroom', 'running', 'kjhjkh', 'pending', 'pending', 'jkhjlknkl'),
(13, 'oscar', '2019-03-21', 'sleep', 'bed', 'hazarddjkhojkl', 'master', 'pending', 'pending', 'hjgaihdolsafjdla');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `officerauthentication`
--
ALTER TABLE `officerauthentication`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `rotausersduty`
--
ALTER TABLE `rotausersduty`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `officerauthentication`
--
ALTER TABLE `officerauthentication`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rotausersduty`
--
ALTER TABLE `rotausersduty`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
