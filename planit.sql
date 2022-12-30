-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2022 at 11:09 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `planit`
--

-- --------------------------------------------------------

--
-- Table structure for table `planner`
--

CREATE TABLE `planner` (
  `planner_id` int(3) NOT NULL,
  `plannerName` varchar(40) NOT NULL,
  `email_id` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `planner`
--

INSERT INTO `planner` (`planner_id`, `plannerName`, `email_id`) VALUES
(1, '15 days trip', 'ayeshaaamir2001@gmail.com'),
(1, 'Study', 'bismaimran23@hotmail.com'),
(1, 'Finals', 'eesha.ansari@gmail.com'),
(1, 'Beach Party', 'hasnainali@outlook.com'),
(1, 'Assignments', 'hebanaveed08@hotmail.com'),
(1, 'Physics Assignment', 'izmaaziz.02@gmail.com'),
(1, 'House cleaning', 'minhalzaib10@gmail.com'),
(2, 'Software for XCompany', 'ayeshaaamir2001@gmail.com'),
(2, 'Mids Prep', 'bismaimran23@hotmail.com'),
(2, 'AI Assignment', 'hebanaveed08@hotmail.com'),
(2, 'Dubai Trip', 'izmaaziz.02@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `taskID` int(3) NOT NULL,
  `planner_id` int(3) NOT NULL,
  `email_id` varchar(40) NOT NULL,
  `taskName` varchar(20) NOT NULL,
  `taskDescription` varchar(50) NOT NULL,
  `startTask` date NOT NULL,
  `endTask` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`taskID`, `planner_id`, `email_id`, `taskName`, `taskDescription`, `startTask`, `endTask`) VALUES
(1, 1, 'ayeshaaamir2001@gmail.com', 'Destination 1', 'Murree', '2022-02-03', '2022-02-04'),
(1, 1, 'bismaimran23@hotmail.com', 'Physics Quiz 1', 'study for the quiz ', '2022-02-10', '2022-02-12'),
(1, 1, 'eesha.ansari@gmail.com', 'Paper 1', 'CS-101', '2022-02-03', '2022-02-04'),
(1, 1, 'hasnainali@outlook.com', 'Arrival', 'have to be on time', '2022-02-17', '2022-02-18'),
(1, 1, 'hebanaveed08@hotmail.com', 'AI Assignment', 'perceptron', '2022-02-10', '2022-02-11'),
(1, 1, 'izmaaziz.02@gmail.com', 'Research', 'look up material', '2022-02-03', '2022-02-04'),
(1, 1, 'minhalzaib10@gmail.com', 'Room 1', 'Declutter extra material', '2022-02-16', '2022-02-17'),
(1, 2, 'ayeshaaamir2001@gmail.com', 'SRS', 'requirements', '2022-02-03', '2022-02-04'),
(1, 2, 'bismaimran23@hotmail.com', 'Course 1', 'complete course 1', '2022-02-03', '2022-02-05'),
(1, 2, 'hebanaveed08@hotmail.com', 'Research', 'learn perceptron', '2022-02-02', '2022-02-03'),
(1, 2, 'izmaaziz.02@gmail.com', 'Sharjah', 'explore sharjah', '2022-02-11', '2022-02-12'),
(2, 1, 'ayeshaaamir2001@gmail.com', 'Destination 2', 'Nathia Gali', '2022-02-04', '2022-02-05'),
(2, 1, 'bismaimran23@hotmail.com', 'Past Paper', 'attempt for practice', '2022-02-13', '2022-02-14'),
(2, 1, 'eesha.ansari@gmail.com', 'Paper 2', 'CS-50', '2022-02-05', '2022-02-07'),
(2, 1, 'hebanaveed08@hotmail.com', 'SE project', 'project remaining work and submission', '2022-02-12', '2022-02-15'),
(2, 1, 'izmaaziz.02@gmail.com', 'Compile', 'combine material', '2022-02-06', '2022-02-11'),
(2, 1, 'minhalzaib10@gmail.com', 'Paint walls', 'change wall colour', '2022-02-18', '2022-02-25'),
(2, 2, 'ayeshaaamir2001@gmail.com', 'Design', 'Design frontend', '2022-02-05', '2022-02-07'),
(2, 2, 'bismaimran23@hotmail.com', 'Course 2', 'complete difficult course', '2022-02-06', '2022-02-10'),
(2, 2, 'izmaaziz.02@gmail.com', 'Downtown dubai', 'explore restaurants', '2022-02-13', '2022-02-16'),
(3, 1, 'ayeshaaamir2001@gmail.com', 'Destination 3', 'Kashmir', '2022-02-06', '2022-02-09'),
(3, 1, 'bismaimran23@hotmail.com', 'Quiz', 'attempt quiz', '2022-02-15', '2022-02-16'),
(3, 1, 'eesha.ansari@gmail.com', 'Paper 3', 'CS-110', '2022-02-08', '2022-02-11'),
(3, 1, 'hebanaveed08@hotmail.com', 'CA CEP', 'research and submission', '2022-02-16', '2022-02-17'),
(3, 1, 'izmaaziz.02@gmail.com', 'Recheck', 'proofread', '2022-02-12', '2022-02-13'),
(3, 1, 'minhalzaib10@gmail.com', 'New furniture', 'shift new furniture', '2022-03-04', '2022-03-07'),
(3, 2, 'bismaimran23@hotmail.com', 'Course 3', 'complete easiest course', '2022-02-11', '2022-02-12'),
(3, 2, 'izmaaziz.02@gmail.com', 'Ferrari world', 'ferrari world for 2 days', '2022-02-17', '2022-02-18'),
(4, 1, 'eesha.ansari@gmail.com', 'Paper 4', 'CS-90', '2022-02-12', '2022-02-13'),
(4, 1, 'hebanaveed08@hotmail.com', 'PS assignment', 'collection and analysing', '2022-02-24', '2022-02-25');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `email_id` varchar(40) NOT NULL,
  `firstName` varchar(10) NOT NULL,
  `lastName` varchar(10) NOT NULL,
  `contact` varchar(12) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`email_id`, `firstName`, `lastName`, `contact`, `password`) VALUES
('ayeshaaamir2001@gmail.com', 'Izma', 'Aamir', '0333-3395271', 'Aa123456@'),
('bismaimran23@hotmail.com', 'Bisma', 'Imran', '0344-1234876', 'Bisimran!6'),
('eesha.ansari@gmail.com', 'Eesha', 'Ansari', '0321-9807611', 'Ansar1235#'),
('hasnainali@outlook.com', 'Hasnain', 'Ali', '0333-1234621', 'aliHasnain1@'),
('hebanaveed08@hotmail.com', 'Heba', 'Naveed', '0321-4568231', 'Naveedh12!'),
('izmaaziz.02@gmail.com', 'Izma', 'Aziz', '0323-2789901', 'Aziz2#izma'),
('minhalzaib10@gmail.com', 'Minhal', 'Zaib', '0331-7802341', 'Zaibminhal1@'),
('sadafjawedf@gmail.com', 'Sadaf', 'Jawed', '0321-4567331', 'Jsjawed@1'),
('sameena@gmail.com', 'Sameen', 'Aziz', '0321-4569931', 'SamAziz123%'),
('taha123@gmail.com', 'Taha', 'Aamir', '0321-8899221', 'aamirTaha12$');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `planner`
--
ALTER TABLE `planner`
  ADD PRIMARY KEY (`planner_id`,`email_id`),
  ADD KEY `PLANNERUSER_FK` (`email_id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`taskID`,`planner_id`,`email_id`),
  ADD KEY `TASKPLANNER_FK` (`planner_id`),
  ADD KEY `USER_FK` (`email_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `planner`
--
ALTER TABLE `planner`
  ADD CONSTRAINT `PLANNERUSER_FK` FOREIGN KEY (`email_id`) REFERENCES `user` (`email_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `TASKPLANNER_FK` FOREIGN KEY (`planner_id`) REFERENCES `planner` (`planner_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `USER_FK` FOREIGN KEY (`email_id`) REFERENCES `user` (`email_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
