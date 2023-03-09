-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2023 at 07:42 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wmsu`
--

-- --------------------------------------------------------

--
-- Table structure for table `colleges`
--

CREATE TABLE `colleges` (
  `id` int(11) NOT NULL,
  `college_name` varchar(50) NOT NULL,
  `college_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `colleges`
--

INSERT INTO `colleges` (`id`, `college_name`, `college_code`) VALUES
(1, 'College of Computing Studies', 'CCS'),
(2, 'College of Engineering', 'COE'),
(3, 'College of Nursing', 'CN');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`) VALUES
(1, 'admin'),
(2, 'officer'),
(3, 'collector');

-- --------------------------------------------------------

--
-- Table structure for table `school_year`
--

CREATE TABLE `school_year` (
  `id` int(11) NOT NULL,
  `school_year_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `school_year`
--

INSERT INTO `school_year` (`id`, `school_year_name`) VALUES
(1, '2022-2023');

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `id` int(11) NOT NULL,
  `semester_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`id`, `semester_name`) VALUES
(1, '1st sem'),
(2, '2nd sem');

-- --------------------------------------------------------

--
-- Table structure for table `university_fee`
--

CREATE TABLE `university_fee` (
  `id` int(11) NOT NULL,
  `university_type` varchar(50) NOT NULL DEFAULT 'University',
  `university_amount` int(11) NOT NULL,
  `university_name` varchar(50) NOT NULL,
  `created_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `university_fee`
--

INSERT INTO `university_fee` (`id`, `university_type`, `university_amount`, `university_name`, `created_by`) VALUES
(1, 'University', 200, 'WMSU Palaro', 'Bryan'),
(2, 'University', 420, 'WMSU Boracay', 'Bryan');

-- --------------------------------------------------------

--
-- Table structure for table `university_fee_schedule`
--

CREATE TABLE `university_fee_schedule` (
  `id` int(11) NOT NULL,
  `university_fee_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `school_year_id` int(11) NOT NULL,
  `university_start_date` date NOT NULL,
  `university_end_date` date NOT NULL,
  `created_by` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `university_fee_schedule`
--

INSERT INTO `university_fee_schedule` (`id`, `university_fee_id`, `semester_id`, `school_year_id`, `university_start_date`, `university_end_date`, `created_by`) VALUES
(1, 1, 1, 1, '2023-03-11', '2023-04-20', 'Bryan'),
(2, 2, 2, 1, '2023-03-17', '2023-03-30', 'Bryan');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_username` varchar(50) NOT NULL,
  `user_fullname` varchar(50) NOT NULL,
  `user_position` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `college_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_username`, `user_fullname`, `user_position`, `user_password`, `role_id`, `college_id`) VALUES
(1, 'adMin101', 'Bryan', 'President', '$2y$10$9lSPgrM/5rCbXrHZz1s6R.atAJGxcnq4ffRt5ecpCFYh6cj3HTeTK', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `colleges`
--
ALTER TABLE `colleges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_year`
--
ALTER TABLE `school_year`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `university_fee`
--
ALTER TABLE `university_fee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `university_fee_schedule`
--
ALTER TABLE `university_fee_schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `university_fee_id` (`university_fee_id`),
  ADD KEY `semester_id` (`semester_id`),
  ADD KEY `school_year_id` (`school_year_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `college_id` (`college_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `colleges`
--
ALTER TABLE `colleges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `school_year`
--
ALTER TABLE `school_year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `university_fee`
--
ALTER TABLE `university_fee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `university_fee_schedule`
--
ALTER TABLE `university_fee_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `university_fee_schedule`
--
ALTER TABLE `university_fee_schedule`
  ADD CONSTRAINT `university_fee_schedule_ibfk_1` FOREIGN KEY (`university_fee_id`) REFERENCES `university_fee` (`id`),
  ADD CONSTRAINT `university_fee_schedule_ibfk_2` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`id`),
  ADD CONSTRAINT `university_fee_schedule_ibfk_3` FOREIGN KEY (`school_year_id`) REFERENCES `school_year` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`college_id`) REFERENCES `colleges` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
