-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2023 at 11:47 PM
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
(1, '2022-2023', '2022-08-14', '2023-05-03', 1, '2023-03-14 12:30:59', '2023-03-14 14:06:06');

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
(5, 'College of Liberal Arts', 'CLA');

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

--
-- Dumping data for table `local_payment`
--

INSERT INTO `local_payment` (`id`, `student_id`, `fee_schedule_id`, `payment_amount`, `collected_by`, `payment_date`, `payment_details`, `created_at`, `updated_at`, `receipt_number`, `payment_fee_amount`, `payment_status`, `payment_remaining`, `payment_add`, `payment_image`) VALUES
(1, 202234212, 12, 300, 'Bryan COE', '2023-03-28 23:30:39', '{\"receipt\":\"WMSULocal202303282330392638\",\"student_id\":\"202234212\",\"name\":\"Gregory Yames\",\"college\":\"College of Engineering\",\"program\":\"Civil Engineering\",\"yearlevel\":\"2nd Year\",\"type\":\"Local\",\"feename\":\"CSC\",\"amount\":321,\"totalamount\":\"300\",\"collected_by\":\"Bryan COE\",\"payment_date\":\"2023-03-28 23:30:39\"}', '2023-03-28 21:30:39', '2023-03-28 21:30:39', 'WMSULocal202303282330392638', 321, 0, 21, 0, 'Gregory YamesWMSULocal202303282330392638.jpg');

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
  `semester_duration` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`id`, `semester_name`, `semester_duration`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '1st Semester', 4, 1, '2023-03-14 11:19:07', '2023-03-14 14:05:18'),
(2, '2nd Semester', 4, 1, '2023-03-14 11:20:23', '2023-03-14 14:05:18');

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
  `outstanding_balance` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `first_name`, `last_name`, `student_email`, `year_level`, `college_id`, `program_id`, `payment_status`, `outstanding_balance`) VALUES
(201503664, 'Bryan Christian', 'Sevilla', 'sl201503664@wmsu.edu.ph', '3rd Year', 1, 8, NULL, 0),
(202234212, 'Gregory', 'Yames', 'yames@wmsu.edu.ph', '2nd Year', 2, 5, NULL, -21);

-- --------------------------------------------------------

--
-- Table structure for table `university_fee`
--

CREATE TABLE `university_fee` (
  `id` int(11) NOT NULL,
  `university_fee_type` varchar(12) NOT NULL DEFAULT 'University',
  `university_name` varchar(50) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `university_fee`
--

INSERT INTO `university_fee` (`id`, `university_fee_type`, `university_name`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'University', 'CSB', 'Bryan', '2023-03-15 04:11:11', '2023-03-15 04:11:11'),
(2, 'University', 'WMSU Palaro', 'Bryan', '2023-03-15 06:59:04', '2023-03-15 06:59:04'),
(3, 'University', 'WMSU Boracay', 'Bryan', '2023-03-17 19:28:28', '2023-03-17 19:28:28');

-- --------------------------------------------------------

--
-- Table structure for table `university_fee_schedule`
--

CREATE TABLE `university_fee_schedule` (
  `id` int(11) NOT NULL,
  `university_fee_id` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `university_start_date` date NOT NULL,
  `university_end_date` date NOT NULL,
  `university_amount` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` varchar(50) DEFAULT NULL,
  `is_current` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `university_fee_schedule`
--

INSERT INTO `university_fee_schedule` (`id`, `university_fee_id`, `academic_year_id`, `semester_id`, `university_start_date`, `university_end_date`, `university_amount`, `is_active`, `created_at`, `updated_at`, `created_by`, `is_current`) VALUES
(2, 1, 1, 2, '2022-01-01', '2022-05-01', 420, 1, '2023-03-15 06:57:49', '2023-03-15 06:57:49', 'Bryan', 1),
(3, 2, 1, 2, '2022-01-01', '2022-05-01', 320, 1, '2023-03-15 06:59:34', '2023-03-15 06:59:34', 'Bryan', 1),
(4, 3, 1, 2, '2023-01-01', '2023-05-01', 300, 1, '2023-03-27 00:08:23', '2023-03-27 00:08:23', 'Bryan COE', 1);

-- --------------------------------------------------------

--
-- Table structure for table `university_payment`
--

CREATE TABLE `university_payment` (
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

--
-- Dumping data for table `university_payment`
--

INSERT INTO `university_payment` (`id`, `student_id`, `fee_schedule_id`, `payment_amount`, `collected_by`, `payment_date`, `payment_details`, `created_at`, `updated_at`, `receipt_number`, `payment_fee_amount`, `payment_status`, `payment_remaining`, `payment_add`, `payment_image`) VALUES
(21, 201503664, 3, 320, 'Bryan The Officer', '2023-03-28 23:26:36', '{\"receipt\":\"WMSU202303282326369226\",\"student_id\":\"201503664\",\"name\":\"Bryan Christian Sevilla\",\"college\":\"College of Computing Studies\",\"program\":\"Computer Science\",\"yearlevel\":\"3rd Year\",\"type\":\"University\",\"feename\":\"WMSU Palaro\",\"amount\":320,\"totalamount\":\"320\",\"collected_by\":\"Bryan The Officer\",\"payment_date\":\"2023-03-28 23:26:36\"}', '2023-03-28 21:26:36', '2023-03-28 21:26:36', 'WMSU202303282326369226', 320, 1, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `university_payment_history`
--

CREATE TABLE `university_payment_history` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `fee_schedule_id` int(11) DEFAULT NULL,
  `payment_status` varchar(20) DEFAULT 'paid',
  `payment_amount` int(11) DEFAULT NULL,
  `payment_date` datetime DEFAULT NULL,
  `process_by` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(3, 'offiCER102', 'Bryan COE', 'Mayor', '$2y$10$tg5vM966F/2G7Oiw223sfOAK9RJ0C86lXM2uXwKDdsnqxJbJAtJh.', 2, 2, '2023-03-14 14:08:20', '2023-03-14 14:16:04');

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
  ADD KEY `program_id` (`program_id`);

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
  ADD KEY `academic_year_id` (`academic_year_id`),
  ADD KEY `semester_id` (`semester_id`);

--
-- Indexes for table `university_payment`
--
ALTER TABLE `university_payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_payment_students` (`student_id`),
  ADD KEY `fk_payment_university_fee_schedule` (`fee_schedule_id`);

--
-- Indexes for table `university_payment_history`
--
ALTER TABLE `university_payment_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `fee_schedule_id` (`fee_schedule_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `colleges`
--
ALTER TABLE `colleges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- AUTO_INCREMENT for table `university_fee`
--
ALTER TABLE `university_fee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `university_fee_schedule`
--
ALTER TABLE `university_fee_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `university_payment`
--
ALTER TABLE `university_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `university_payment_history`
--
ALTER TABLE `university_payment_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`college_id`) REFERENCES `colleges` (`id`),
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`);

--
-- Constraints for table `university_fee_schedule`
--
ALTER TABLE `university_fee_schedule`
  ADD CONSTRAINT `university_fee_schedule_ibfk_1` FOREIGN KEY (`university_fee_id`) REFERENCES `university_fee` (`id`),
  ADD CONSTRAINT `university_fee_schedule_ibfk_2` FOREIGN KEY (`academic_year_id`) REFERENCES `academic_year` (`id`),
  ADD CONSTRAINT `university_fee_schedule_ibfk_3` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`id`);

--
-- Constraints for table `university_payment`
--
ALTER TABLE `university_payment`
  ADD CONSTRAINT `fk_payment_students` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `fk_payment_university_fee_schedule` FOREIGN KEY (`fee_schedule_id`) REFERENCES `university_fee_schedule` (`id`);

--
-- Constraints for table `university_payment_history`
--
ALTER TABLE `university_payment_history`
  ADD CONSTRAINT `university_payment_history_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `university_payment_history_ibfk_2` FOREIGN KEY (`fee_schedule_id`) REFERENCES `university_fee_schedule` (`id`);

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
