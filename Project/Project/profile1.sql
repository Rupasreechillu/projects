-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 02, 2024 at 03:59 PM
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
-- Database: `profile1`
--

-- --------------------------------------------------------

--
-- Table structure for table `career`
--

CREATE TABLE `career` (
  `ID` int(11) NOT NULL,
  `STUDIED` varchar(100) DEFAULT NULL,
  `UNIVERSITY` varchar(100) DEFAULT NULL,
  `PERCENTAGE` decimal(5,2) DEFAULT NULL,
  `PASSED_OUT_YEAR` int(11) DEFAULT NULL,
  `SPECIALIZATION` varchar(100) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `career`
--

INSERT INTO `career` (`ID`, `STUDIED`, `UNIVERSITY`, `PERCENTAGE`, `PASSED_OUT_YEAR`, `SPECIALIZATION`, `user_email`) VALUES
(10, 'SSC', 'Board of Secondary Education, Andhra Pradesh', 73.67, 2006, '-', '214g1a32c1@srit.ac.in'),
(11, 'Diploma', 'SBTET', 69.57, 2008, 'Computer Engineering', '214g1a32c1@srit.ac.in'),
(12, 'B. Tech', 'JNTUA', 63.72, 2011, 'Computer Science and Engineering', '214g1a32c1@srit.ac.in'),
(23, '3234', '242', 24.00, 1903, '232', 'vdurga400@gmail.com'),
(24, 'INTER', 'ATP', 100.00, 2021, 'MATHEMATICS', 'vijayadurga1649@gmail.com'),
(26, 'BTECH', 'JNTUH', 95.00, 6, 'Computer Engineering', 'vijayadurga1649@gmail.com'),
(28, 'M.Tech', 'JNTUA', 89.00, 2013, 'CSE', '214g1a32c1@srit.ac.in');

-- --------------------------------------------------------

--
-- Table structure for table `experience`
--

CREATE TABLE `experience` (
  `ID` int(11) NOT NULL,
  `DESIGNATION` varchar(100) DEFAULT NULL,
  `DEPARTMENT` varchar(100) DEFAULT NULL,
  `ORGANIZATION_NAME` varchar(100) DEFAULT NULL,
  `START_DATE` date DEFAULT NULL,
  `END_DATE` date DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `experience`
--

INSERT INTO `experience` (`ID`, `DESIGNATION`, `DEPARTMENT`, `ORGANIZATION_NAME`, `START_DATE`, `END_DATE`, `user_email`) VALUES
(1, 'Doctor', 'Cardiologist', 'ZENZO', '2024-03-03', '2024-03-15', '214g1a32c1@srit.ac.in'),
(5, 'CHINTHA', 'CSE(DS)', 's', '2024-03-21', '2024-03-21', '214g1a32c1@srit.ac.in'),
(6, 'CHINTHA', 'IT', 'ZENZO', '2024-03-25', '2024-03-25', NULL),
(10, 'save', 'jlgljg', 'SRIT', '2024-03-07', '2024-03-28', 'vdurga400@gmail.com'),
(16, 'TEACHER', 'MATHS', 'GOVT', '2022-12-05', '2024-04-25', '214g1a32c1@srit.ac.in');

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE `membership` (
  `ID` int(11) NOT NULL,
  `MEMBERSHIP_ID` varchar(50) DEFAULT NULL,
  `MEMBERSHIP_NAME` varchar(100) DEFAULT NULL,
  `M_TYPE` varchar(50) DEFAULT NULL,
  `LINK` varchar(200) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `membership`
--

INSERT INTO `membership` (`ID`, `MEMBERSHIP_ID`, `MEMBERSHIP_NAME`, `M_TYPE`, `LINK`, `user_email`) VALUES
(1, '8003', 'IEEE2', 'AnnualLifetime', 'https://www.youtube.com/', '214g1a32c1@srit.ac.in'),
(3, '11', '221', 'Lifetime', '', '214g1a32c1@srit.ac.in'),
(6, '1133', 'IEEE', '131113131331', 'http://localhost/project/subjects.php', 'vdurga400@gmail.com'),
(9, '5645', 'IEI', 'ANNUAL', '', '214g1a32c1@srit.ac.in');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `otp` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`id`, `email`, `token`, `created_at`, `otp`) VALUES
(5, '214g1a32c1@srit.ac.in', '785bd668c80cfffaa9aab47b636c6992', '2024-04-01 13:44:20', '60326'),
(32, 'vdurga400@gmail.com', '0c745c9ec79403a305ae74ad3389efc6', '2024-03-25 14:15:38', '22134'),
(36, 'vijayadurga1649@gmail.com', 'a7aed8a493d52235701cb31fa60ed622', '2024-04-01 15:20:57', '66363');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `designation` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `name`, `email`, `mobile`, `address`, `designation`) VALUES
(4, 'CHINTHA VIJAYA DURGA', '214g1a32c1@srit.ac.in', '63029077222', 'ATP', 'Student'),
(5, '', 'vdurga400@gmail.com', '', '', ''),
(6, 'VIJAYA DURGA ', 'vijayadurga1649@gmail.com', '9951010056', '1-4-128', '1234'),
(7, 'VIJAYA DURGA ', '214g1a3294@srit.ac.in', '09951010056', '2-1-446', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `research`
--

CREATE TABLE `research` (
  `ID` int(11) NOT NULL,
  `TYPE` enum('CONFERENCE','BOOKS','BOOK CHAPTER','OTHER') DEFAULT NULL,
  `TITLE` varchar(100) DEFAULT NULL,
  `PUBLISHER_NAME` varchar(100) DEFAULT NULL,
  `NATIONAL_INTERNATIONAL` varchar(50) DEFAULT NULL,
  `ISSN_ISBN` varchar(50) DEFAULT NULL,
  `VOLUME` varchar(50) DEFAULT NULL,
  `MONTH` varchar(20) DEFAULT NULL,
  `YEAR` int(11) DEFAULT NULL,
  `LINK` varchar(200) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `research`
--

INSERT INTO `research` (`ID`, `TYPE`, `TITLE`, `PUBLISHER_NAME`, `NATIONAL_INTERNATIONAL`, `ISSN_ISBN`, `VOLUME`, `MONTH`, `YEAR`, `LINK`, `user_email`) VALUES
(4, 'CONFERENCE', '7977', '113', '13131', '64644', 'ABC', '', 1919, '', '214g1a32c1@srit.ac.in'),
(5, 'BOOK CHAPTER', 'CLOUD COMPUTING', 'Durga', '-', '65574', '-', '-', 2018, '', '214g1a32c1@srit.ac.in'),
(11, 'CONFERENCE', '12', '1', '1', '111', '1', '1', 1911, '1', 'vdurga400@gmail.com'),
(14, 'BOOKS', 'ML', '-', '-', '698986', '-', '-', 8779, '', '214g1a32c1@srit.ac.in');

-- --------------------------------------------------------

--
-- Table structure for table `subjects_taught`
--

CREATE TABLE `subjects_taught` (
  `ID` int(11) NOT NULL,
  `SUBJECT_NAME` varchar(100) DEFAULT NULL,
  `YEAR` int(11) DEFAULT NULL,
  `SEMESTER` varchar(20) DEFAULT NULL,
  `ACADEMIC_YEAR` varchar(20) DEFAULT NULL,
  `ORGANIZATION` varchar(100) DEFAULT NULL,
  `PASS_PERCENTAGE` decimal(5,2) DEFAULT NULL,
  `FEEDBACK` varchar(200) DEFAULT NULL,
  `LINK` varchar(200) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects_taught`
--

INSERT INTO `subjects_taught` (`ID`, `SUBJECT_NAME`, `YEAR`, `SEMESTER`, `ACADEMIC_YEAR`, `ORGANIZATION`, `PASS_PERCENTAGE`, `FEEDBACK`, `LINK`, `user_email`) VALUES
(1, 'BEEE', 2021, '1-2', '2021-2022', 'SKU', 95.00, 'EXCELLENT', 'http://localhost/project/edit-subjects.php', '214g1a32c1@srit.ac.in'),
(6, 'EEE', 1911, '11', '12223', '2312', 99.00, 'Good', 'http://localhost/project/subjects.php', '214g1a32c1@srit.ac.in'),
(7, 'EEE', 1913, '2132', '11', '2312', 13.00, 'EXCELLENT', 'http://localhost/project/subjects.php', 'vdurga400@gmail.com'),
(10, 'Physics', 2021, '1-1', '2021-2022', 'SRIT', 97.00, '', '', '214g1a32c1@srit.ac.in');

-- --------------------------------------------------------

--
-- Table structure for table `upskilling`
--

CREATE TABLE `upskilling` (
  `ID` int(11) NOT NULL,
  `TYPE` enum('FDP','STTP','WORKSHOP','OTHER') DEFAULT NULL,
  `FROM_DATE` date DEFAULT NULL,
  `TO_DATE` date DEFAULT NULL,
  `DEPARTMENT` varchar(100) DEFAULT NULL,
  `ORGANIZED_BY` varchar(100) DEFAULT NULL,
  `LINK` varchar(200) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `upskilling`
--

INSERT INTO `upskilling` (`ID`, `TYPE`, `FROM_DATE`, `TO_DATE`, `DEPARTMENT`, `ORGANIZED_BY`, `LINK`, `user_email`) VALUES
(2, 'OTHER', '2020-12-06', '2024-03-31', 'MCSDM', 'SRIT', 'https://www.youtube.com/', '214g1a32c1@srit.ac.in'),
(3, 'FDP', '2024-03-21', '2024-03-21', 'MCSDM', 'ABC Organization', '', '214g1a32c1@srit.ac.in'),
(6, 'FDP', '2024-03-04', '2024-03-13', 'CSD', 'SRIT', '1', 'vdurga400@gmail.com'),
(9, 'STTP', '2024-04-17', '2024-04-30', 'CSE', 'SRIT', '', '214g1a32c1@srit.ac.in');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`) VALUES
(1, 'VIJAYA DURGA', 'CHINTHA', '214g1a32c1@srit.ac.in', 'Chitti@123'),
(18, 'vd', 'c', 'vdurga400@gmail.com', '$2y$10$TslIsPqCgAZ3clzBZgYjDuNAX0NNDdnWhhT2enEjbafSp2pN9d0ha'),
(36, 'vijaya ', 'CHINTHA', 'vijayadurga1649@gmail.com', 'Satya@123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `career`
--
ALTER TABLE `career`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_user_email` (`user_email`);

--
-- Indexes for table `experience`
--
ALTER TABLE `experience`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_user_email1` (`user_email`);

--
-- Indexes for table `membership`
--
ALTER TABLE `membership`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_user_email5` (`user_email`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `research`
--
ALTER TABLE `research`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_user_email2` (`user_email`);

--
-- Indexes for table `subjects_taught`
--
ALTER TABLE `subjects_taught`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_user_email4` (`user_email`);

--
-- Indexes for table `upskilling`
--
ALTER TABLE `upskilling`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_user_email3` (`user_email`);

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
-- AUTO_INCREMENT for table `career`
--
ALTER TABLE `career`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `experience`
--
ALTER TABLE `experience`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `membership`
--
ALTER TABLE `membership`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `research`
--
ALTER TABLE `research`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `subjects_taught`
--
ALTER TABLE `subjects_taught`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `upskilling`
--
ALTER TABLE `upskilling`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `career`
--
ALTER TABLE `career`
  ADD CONSTRAINT `fk_user_email` FOREIGN KEY (`user_email`) REFERENCES `users` (`email`);

--
-- Constraints for table `experience`
--
ALTER TABLE `experience`
  ADD CONSTRAINT `fk_user_email1` FOREIGN KEY (`user_email`) REFERENCES `users` (`email`);

--
-- Constraints for table `membership`
--
ALTER TABLE `membership`
  ADD CONSTRAINT `fk_user_email5` FOREIGN KEY (`user_email`) REFERENCES `users` (`email`);

--
-- Constraints for table `research`
--
ALTER TABLE `research`
  ADD CONSTRAINT `fk_user_email2` FOREIGN KEY (`user_email`) REFERENCES `users` (`email`);

--
-- Constraints for table `subjects_taught`
--
ALTER TABLE `subjects_taught`
  ADD CONSTRAINT `fk_user_email4` FOREIGN KEY (`user_email`) REFERENCES `users` (`email`);

--
-- Constraints for table `upskilling`
--
ALTER TABLE `upskilling`
  ADD CONSTRAINT `fk_user_email3` FOREIGN KEY (`user_email`) REFERENCES `users` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
