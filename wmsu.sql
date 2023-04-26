-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2023 at 11:50 PM
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
-- Table structure for table `academic_year`
--

CREATE TABLE `academic_year` (
  `id` int(11) NOT NULL,
  `academic_name` varchar(50) NOT NULL,
  `academic_start_date` date NOT NULL,
  `academic_end_date` date NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `academic_year`
--

INSERT INTO `academic_year` (`id`, `academic_name`, `academic_start_date`, `academic_end_date`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '2022-2023', '2022-08-14', '2023-05-03', 1, '2023-03-14 12:30:59', '2023-03-14 14:06:06'),
(2, '2024-2025', '2024-08-15', '2025-04-30', 1, '2023-04-09 21:07:10', '2023-04-09 21:07:10');

-- --------------------------------------------------------

--
-- Table structure for table `colleges`
--

CREATE TABLE `colleges` (
  `id` int(11) NOT NULL,
  `college_name` varchar(50) NOT NULL,
  `college_code` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `colleges`
--

INSERT INTO `colleges` (`id`, `college_name`, `college_code`) VALUES
(1, 'College of Computing Studies', 'CCS'),
(2, 'College of Engineering', 'COE'),
(3, 'College of Nursing', 'CN'),
(5, 'College of Liberal Arts', 'CLA'),
(6, 'College of Pogi', 'CP');

-- --------------------------------------------------------

--
-- Table structure for table `fee_options`
--

CREATE TABLE `fee_options` (
  `id` int(11) NOT NULL,
  `option_name` varchar(50) NOT NULL,
  `option_value` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `local_fee`
--

CREATE TABLE `local_fee` (
  `id` int(11) NOT NULL,
  `local_fee_type` varchar(50) DEFAULT 'Local',
  `local_name` varchar(50) NOT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `college_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `local_fee`
--

INSERT INTO `local_fee` (`id`, `local_fee_type`, `local_name`, `created_by`, `created_at`, `updated_at`, `college_id`) VALUES
(1, 'Local', 'CSC', 'Bryan COE', '2023-03-15 15:22:50', '2023-03-15 15:22:50', 2),
(2, 'Local', 'Gender Club', 'Bryan COE', '2023-03-15 19:13:39', '2023-03-15 19:13:39', 2);

-- --------------------------------------------------------

--
-- Table structure for table `local_fee_schedule`
--

CREATE TABLE `local_fee_schedule` (
  `id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `college_id` int(11) NOT NULL,
  `local_fee_id` int(11) NOT NULL,
  `local_amount` int(11) NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `local_start_date` date DEFAULT NULL,
  `local_end_date` date DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_current` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `local_fee_schedule`
--

INSERT INTO `local_fee_schedule` (`id`, `semester_id`, `academic_year_id`, `college_id`, `local_fee_id`, `local_amount`, `is_active`, `local_start_date`, `local_end_date`, `created_by`, `created_at`, `updated_at`, `is_current`) VALUES
(11, 1, 1, 2, 1, 231, 1, '2022-08-01', '2022-12-01', 'Bryan COE', '2023-03-15 19:36:46', '2023-03-15 19:36:46', 1),
(12, 2, 1, 2, 1, 321, 1, '2023-01-01', '2023-05-01', 'Bryan COE', '2023-03-15 19:36:54', '2023-03-15 19:36:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `local_payment`
--

CREATE TABLE `local_payment` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `fee_schedule_id` int(11) NOT NULL,
  `payment_amount` int(11) NOT NULL,
  `collected_by` varchar(100) NOT NULL,
  `payment_date` datetime NOT NULL,
  `payment_details` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `receipt_number` varchar(50) NOT NULL,
  `payment_fee_amount` int(11) NOT NULL,
  `payment_status` tinyint(1) NOT NULL DEFAULT 1,
  `payment_remaining` int(11) NOT NULL DEFAULT 0,
  `payment_add` int(11) NOT NULL DEFAULT 0,
  `payment_image` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` int(11) NOT NULL,
  `program_name` varchar(50) NOT NULL,
  `college_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `program_name`, `college_id`) VALUES
(5, 'Civil Engineering', 2),
(7, 'Computer Engineering', 2),
(8, 'Computer Science', 1),
(9, 'Information Technology', 1);

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
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `id` int(11) NOT NULL,
  `semester_name` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`id`, `semester_name`, `created_at`, `updated_at`) VALUES
(1, '1st Semester', '2023-03-14 11:19:07', '2023-03-14 14:05:18'),
(2, '2nd Semester', '2023-03-14 11:20:23', '2023-03-14 14:05:18');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `student_email` varchar(50) NOT NULL,
  `year_level` varchar(20) NOT NULL,
  `college_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `payment_status` varchar(10) DEFAULT NULL,
  `outstanding_balance` int(11) NOT NULL DEFAULT 0,
  `academic_year_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `first_name`, `last_name`, `student_email`, `year_level`, `college_id`, `program_id`, `payment_status`, `outstanding_balance`, `academic_year_id`) VALUES
(201503664, 'Bryan Christian', 'Sevilla', 'sl201503664@wmsu.edu.ph', '3rd Year', 1, 8, NULL, 0, 2),
(202234212, 'Gregory', 'Yames', 'yames@wmsu.edu.ph', '2nd Year', 2, 5, NULL, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `university_fees`
--

CREATE TABLE `university_fees` (
  `id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `fee_type` varchar(20) NOT NULL DEFAULT 'University',
  `fee_name` varchar(100) NOT NULL,
  `fee_amount` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `university_fees`
--

INSERT INTO `university_fees` (`id`, `academic_year_id`, `semester_id`, `fee_type`, `fee_name`, `fee_amount`, `start_date`, `end_date`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'University', 'WMSU Boracay', 320, '2023-04-25', '2025-07-10', 'Bryan', '2023-04-09 23:16:37', '2023-04-09 23:16:37'),
(14, 2, 2, 'University', 'wdaw', 2133, '2023-04-01', '2023-04-29', 'Bryan', '2023-04-10 22:35:16', '2023-04-10 22:35:16'),
(15, 2, 2, 'University', 'test1', 213, '2023-04-01', '2023-04-15', 'Bryan', '2023-04-10 22:39:38', '2023-04-10 22:39:38'),
(16, 2, 1, 'University', 'Wmsu Boracay', 300, '2023-04-05', '2023-05-04', 'Bryan', '2023-04-26 13:02:47', '2023-04-26 13:02:47');

-- --------------------------------------------------------

--
-- Table structure for table `university_paid`
--

CREATE TABLE `university_paid` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `university_fee_id` int(11) NOT NULL,
  `paid_amount` int(11) NOT NULL,
  `university_status` varchar(50) DEFAULT 'Paid',
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `collected_by` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `university_partial`
--

CREATE TABLE `university_partial` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `university_fee_id` int(11) NOT NULL,
  `partial_amount` int(11) NOT NULL,
  `university_status` varchar(50) DEFAULT 'Partial',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `university_pending`
--

CREATE TABLE `university_pending` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `university_fee_id` int(11) NOT NULL,
  `pending_amount` int(11) NOT NULL,
  `university_status` varchar(20) DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `university_pending`
--

INSERT INTO `university_pending` (`id`, `student_id`, `university_fee_id`, `pending_amount`, `university_status`, `created_at`, `updated_at`) VALUES
(5, 201503664, 15, 213, 'Pending', '2023-04-10 22:39:38', '2023-04-10 22:39:38'),
(7, 201503664, 16, 300, 'Pending', '2023-04-26 13:02:47', '2023-04-26 13:02:47'),
(8, 202234212, 16, 300, 'Pending', '2023-04-26 13:02:47', '2023-04-26 13:02:47');

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
  `college_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_username`, `user_fullname`, `user_position`, `user_password`, `role_id`, `college_id`, `created_at`, `updated_at`) VALUES
(1, 'adMin101', 'Bryan', 'President', '$2y$10$9lSPgrM/5rCbXrHZz1s6R.atAJGxcnq4ffRt5ecpCFYh6cj3HTeTK', 1, 1, '2023-03-14 14:08:20', '2023-03-14 14:16:04'),
(2, 'offiCER101', 'Bryan The Officer', 'Mayor', '$2y$10$gRTuUjQvgmTOMaLlI4aljOEdGXsBNlW1F3mAmTFvVzKrK6PkJJx9G', 2, 1, '2023-03-14 14:08:20', '2023-03-14 14:16:04'),
(3, 'offiCER102', 'Bryan COE', 'Mayor', '$2y$10$tg5vM966F/2G7Oiw223sfOAK9RJ0C86lXM2uXwKDdsnqxJbJAtJh.', 2, 2, '2023-03-14 14:08:20', '2023-03-14 14:16:04'),
(4, 'collector1', 'Barack Obama', 'Assistant', '$2y$10$/s3wBtRDnYSENuZHdgtgF.PpqmkcxqSvlnoSwj385ep8HgDVaXQbm', 3, 1, '2023-04-08 21:20:50', '2023-04-08 21:20:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_year`
--
ALTER TABLE `academic_year`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colleges`
--
ALTER TABLE `colleges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fee_options`
--
ALTER TABLE `fee_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `local_fee`
--
ALTER TABLE `local_fee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `college_id` (`college_id`);

--
-- Indexes for table `local_fee_schedule`
--
ALTER TABLE `local_fee_schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `semester_id` (`semester_id`),
  ADD KEY `academic_year_id` (`academic_year_id`),
  ADD KEY `college_id` (`college_id`),
  ADD KEY `local_fee_id` (`local_fee_id`);

--
-- Indexes for table `local_payment`
--
ALTER TABLE `local_payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `fee_schedule_id` (`fee_schedule_id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_programs_college_id` (`college_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `college_id` (`college_id`),
  ADD KEY `program_id` (`program_id`),
  ADD KEY `fk_students_academic_year` (`academic_year_id`);

--
-- Indexes for table `university_fees`
--
ALTER TABLE `university_fees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `academic_year_id` (`academic_year_id`),
  ADD KEY `semester_id` (`semester_id`);

--
-- Indexes for table `university_paid`
--
ALTER TABLE `university_paid`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `university_fee_id` (`university_fee_id`);

--
-- Indexes for table `university_partial`
--
ALTER TABLE `university_partial`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `university_fee_id` (`university_fee_id`);

--
-- Indexes for table `university_pending`
--
ALTER TABLE `university_pending`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `university_fee_id` (`university_fee_id`);

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
-- AUTO_INCREMENT for table `academic_year`
--
ALTER TABLE `academic_year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `colleges`
--
ALTER TABLE `colleges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `fee_options`
--
ALTER TABLE `fee_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `local_fee`
--
ALTER TABLE `local_fee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `local_fee_schedule`
--
ALTER TABLE `local_fee_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `local_payment`
--
ALTER TABLE `local_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `university_fees`
--
ALTER TABLE `university_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `university_paid`
--
ALTER TABLE `university_paid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `university_partial`
--
ALTER TABLE `university_partial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `university_pending`
--
ALTER TABLE `university_pending`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `local_fee`
--
ALTER TABLE `local_fee`
  ADD CONSTRAINT `local_fee_ibfk_1` FOREIGN KEY (`college_id`) REFERENCES `colleges` (`id`);

--
-- Constraints for table `local_fee_schedule`
--
ALTER TABLE `local_fee_schedule`
  ADD CONSTRAINT `local_fee_schedule_ibfk_1` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`id`),
  ADD CONSTRAINT `local_fee_schedule_ibfk_2` FOREIGN KEY (`academic_year_id`) REFERENCES `academic_year` (`id`),
  ADD CONSTRAINT `local_fee_schedule_ibfk_3` FOREIGN KEY (`college_id`) REFERENCES `colleges` (`id`),
  ADD CONSTRAINT `local_fee_schedule_ibfk_4` FOREIGN KEY (`local_fee_id`) REFERENCES `local_fee` (`id`);

--
-- Constraints for table `local_payment`
--
ALTER TABLE `local_payment`
  ADD CONSTRAINT `local_payment_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `local_payment_ibfk_2` FOREIGN KEY (`fee_schedule_id`) REFERENCES `local_fee_schedule` (`id`);

--
-- Constraints for table `programs`
--
ALTER TABLE `programs`
  ADD CONSTRAINT `fk_programs_college_id` FOREIGN KEY (`college_id`) REFERENCES `colleges` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `fk_students_academic_year` FOREIGN KEY (`academic_year_id`) REFERENCES `academic_year` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`college_id`) REFERENCES `colleges` (`id`),
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`);

--
-- Constraints for table `university_fees`
--
ALTER TABLE `university_fees`
  ADD CONSTRAINT `university_fees_ibfk_1` FOREIGN KEY (`academic_year_id`) REFERENCES `academic_year` (`id`),
  ADD CONSTRAINT `university_fees_ibfk_2` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`id`);

--
-- Constraints for table `university_paid`
--
ALTER TABLE `university_paid`
  ADD CONSTRAINT `university_paid_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `university_paid_ibfk_2` FOREIGN KEY (`university_fee_id`) REFERENCES `university_fees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `university_partial`
--
ALTER TABLE `university_partial`
  ADD CONSTRAINT `university_partial_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `university_partial_ibfk_2` FOREIGN KEY (`university_fee_id`) REFERENCES `university_fees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `university_pending`
--
ALTER TABLE `university_pending`
  ADD CONSTRAINT `university_pending_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `university_pending_ibfk_2` FOREIGN KEY (`university_fee_id`) REFERENCES `university_fees` (`id`) ON DELETE CASCADE;

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
