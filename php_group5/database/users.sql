-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2024 at 08:36 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `users`
--

-- --------------------------------------------------------

--
-- Table structure for table `grade_level`
--

CREATE TABLE `grade_level` (
  `id` int(11) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grade_level`
--

INSERT INTO `grade_level` (`id`, `year`) VALUES
(1, 7),
(2, 8),
(3, 9),
(4, 10);

-- --------------------------------------------------------

--
-- Table structure for table `grading_config`
--

CREATE TABLE `grading_config` (
  `id` int(11) NOT NULL,
  `written_work_percentage` int(3) NOT NULL,
  `performance_task_percentage` int(3) NOT NULL,
  `quarterly_assessment_percentage` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `section_name` varchar(255) NOT NULL,
  `section_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `section_name`, `section_type`) VALUES
(14, 'DAHLIA', 'Regular'),
(15, 'BALLOON FLOWER', 'Regular');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `grade_level` int(11) NOT NULL,
  `is_science` tinyint(1) NOT NULL DEFAULT 0,
  `section_name` varchar(255) NOT NULL,
  `grade_level_id` int(11) NOT NULL,
  `section_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `student_name`, `grade_level`, `is_science`, `section_name`, `grade_level_id`, `section_id`) VALUES
(32, 'gabrielle facalarin', 10, 0, '', 4, 14),
(33, 'neil ramos', 10, 0, '', 4, 14),
(34, 'lestyn de jesus', 10, 0, '', 4, 14),
(35, 'adrian zoleta', 10, 0, '', 4, 14),
(36, 'emil calabio', 10, 0, '', 4, 14),
(37, 'leonard flores', 7, 0, '', 1, 15);

-- --------------------------------------------------------

--
-- Table structure for table `student_grades`
--

CREATE TABLE `student_grades` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `written_work` decimal(5,2) DEFAULT NULL,
  `performance_task` decimal(5,2) DEFAULT NULL,
  `quarterly_assessment` decimal(5,2) DEFAULT NULL,
  `total_grade` decimal(5,2) NOT NULL,
  `subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_grades`
--

INSERT INTO `student_grades` (`id`, `student_id`, `written_work`, `performance_task`, `quarterly_assessment`, `total_grade`, `subject_id`) VALUES
(37, 32, 85.00, 86.00, 89.00, 86.30, 1),
(38, 32, 89.00, 89.00, 88.00, 88.80, 2),
(39, 32, 88.00, 87.00, 85.00, 86.90, 3),
(40, 32, 89.00, 88.00, 87.00, 88.00, 4),
(41, 32, 91.00, 90.00, 91.00, 90.50, 5),
(42, 32, 87.00, 88.00, 85.00, 87.10, 6),
(43, 32, 85.00, 84.00, 83.00, 84.10, 7),
(44, 32, 88.00, 89.00, 87.00, 88.30, 8),
(45, 33, 86.00, 88.00, 89.00, 87.60, 1),
(46, 33, 88.00, 88.00, 89.00, 88.20, 2),
(47, 33, 89.00, 87.00, 88.00, 87.80, 3),
(48, 33, 86.00, 88.00, 87.00, 87.20, 4),
(49, 33, 87.00, 88.00, 90.00, 88.10, 5),
(50, 33, 88.00, 89.00, 87.00, 88.30, 6),
(51, 33, 87.00, 87.00, 88.00, 87.20, 7),
(52, 33, 88.00, 87.00, 86.00, 87.10, 8),
(53, 34, 88.00, 87.00, 86.00, 87.10, 1),
(54, 34, 88.00, 89.00, 88.00, 88.50, 2),
(55, 34, 87.00, 86.00, 86.00, 86.30, 3),
(56, 34, 89.00, 88.00, 90.00, 88.70, 4),
(57, 34, 87.00, 89.00, 89.00, 88.40, 5),
(58, 34, 89.00, 88.00, 86.00, 87.90, 6),
(59, 34, 85.00, 85.00, 84.00, 84.80, 7),
(60, 34, 87.00, 87.00, 88.00, 87.20, 8),
(61, 35, 87.00, 88.00, 87.00, 87.50, 1),
(62, 35, 89.00, 90.00, 89.00, 89.50, 2),
(63, 35, 87.00, 87.00, 89.00, 87.40, 3),
(64, 35, 89.00, 90.00, 90.00, 89.70, 4),
(65, 35, 90.00, 94.00, 98.00, 93.60, 5),
(66, 35, 88.00, 89.00, 88.00, 88.50, 6),
(67, 35, 85.00, 85.00, 87.00, 85.40, 7),
(68, 35, 87.00, 87.00, 89.00, 87.40, 8),
(69, 36, 89.00, 89.00, 90.00, 89.20, 1),
(70, 36, 90.00, 90.00, 90.00, 90.00, 2),
(71, 36, 89.00, 88.00, 89.00, 88.50, 3),
(72, 36, 91.00, 93.00, 94.00, 92.00, 4),
(73, 36, 89.00, 91.00, 90.00, 90.20, 5),
(74, 36, 88.00, 88.00, 87.00, 87.80, 6),
(75, 36, 88.00, 89.00, 88.00, 88.50, 7),
(76, 36, 89.00, 88.00, 88.00, 88.30, 8),
(77, 37, 99.00, 99.00, 99.00, 99.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `subject_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_name`) VALUES
(1, 'Mapeh'),
(2, 'Science'),
(3, 'TLE'),
(4, 'Math'),
(5, 'English'),
(6, 'Filipino'),
(7, 'ESP'),
(8, 'AP'),
(9, 'Research'),
(11, 'IPT1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('student','teacher','admin') NOT NULL DEFAULT 'student'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `role`) VALUES
(17, 'John Gabrielle M. Facalarin', 'teacher@gmail.com', '$2y$10$KRKE0R3zbPmiuYEsakzAuuZsRVRGvKRgFZ4Oj6JxTP3i1CUOw.6q6', 'teacher'),
(22, 'John Gabrielle M. Facalarin', 'gabby@gmail.com', '$2y$10$xM3yPyvFss1hmrslw5n0nuSQ3usEAVthIU8.ohYIOXkeek5B/TZPq', 'teacher');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `grade_level`
--
ALTER TABLE `grade_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grading_config`
--
ALTER TABLE `grading_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `student_grades`
--
ALTER TABLE `student_grades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `grade_level`
--
ALTER TABLE `grade_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `grading_config`
--
ALTER TABLE `grading_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `student_grades`
--
ALTER TABLE `student_grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `student_grades`
--
ALTER TABLE `student_grades`
  ADD CONSTRAINT `student_grades_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
