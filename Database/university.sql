-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2025 at 02:47 AM
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
-- Database: `university`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'HarvardIT', '$2a$12$W0UYo5KHZx.5hf..BQoALuBQHh0VH0unT/OqvqQtHSA25ECa.jTOi');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id_course` int(10) UNSIGNED NOT NULL,
  `course_code` varchar(20) NOT NULL,
  `course_name` varchar(20) NOT NULL,
  `course_credits` int(11) NOT NULL,
  `course_major` varchar(40) DEFAULT NULL,
  `semester` varchar(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses_enrollments`
--

CREATE TABLE `courses_enrollments` (
  `course_enrollment_id` int(10) UNSIGNED NOT NULL,
  `student_name` varchar(50) NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `course_code` varchar(20) NOT NULL,
  `course_name` varchar(20) NOT NULL,
  `semester` varchar(30) NOT NULL,
  `credits` int(11) NOT NULL,
  `enroll_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enrollements`
--

CREATE TABLE `enrollements` (
  `id_enrollment` int(10) UNSIGNED NOT NULL,
  `student_name` varchar(50) NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `course_name` varchar(20) NOT NULL,
  `semester` varchar(30) NOT NULL,
  `date_enrolled` datetime NOT NULL DEFAULT current_timestamp(),
  `id_course` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `majors`
--

CREATE TABLE `majors` (
  `major_name` varchar(40) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `semester_name` varchar(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `semester_enrollments`
--

CREATE TABLE `semester_enrollments` (
  `enrollment_id` int(11) NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `student_name` varchar(50) NOT NULL,
  `student_major` varchar(50) NOT NULL,
  `student_email` varchar(50) NOT NULL,
  `semester` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_profile` varchar(70) NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `major` varchar(40) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id_course`),
  ADD UNIQUE KEY `course_code` (`course_code`),
  ADD UNIQUE KEY `course_name` (`course_name`),
  ADD KEY `course_major` (`course_major`),
  ADD KEY `semester` (`semester`);

--
-- Indexes for table `courses_enrollments`
--
ALTER TABLE `courses_enrollments`
  ADD PRIMARY KEY (`course_enrollment_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `course_code` (`course_code`),
  ADD KEY `semester` (`semester`);

--
-- Indexes for table `enrollements`
--
ALTER TABLE `enrollements`
  ADD PRIMARY KEY (`id_enrollment`),
  ADD KEY `enrollements_ibfk_1` (`student_id`),
  ADD KEY `id_course` (`id_course`),
  ADD KEY `enrollements_ibfk_3` (`semester`);

--
-- Indexes for table `majors`
--
ALTER TABLE `majors`
  ADD PRIMARY KEY (`major_name`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`semester_name`);

--
-- Indexes for table `semester_enrollments`
--
ALTER TABLE `semester_enrollments`
  ADD PRIMARY KEY (`enrollment_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `student_major` (`student_major`),
  ADD KEY `student_email` (`student_email`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `email_2` (`email`),
  ADD UNIQUE KEY `email_3` (`email`),
  ADD KEY `major` (`major`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id_course` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `courses_enrollments`
--
ALTER TABLE `courses_enrollments`
  MODIFY `course_enrollment_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `enrollements`
--
ALTER TABLE `enrollements`
  MODIFY `id_enrollment` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `semester_enrollments`
--
ALTER TABLE `semester_enrollments`
  MODIFY `enrollment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`course_major`) REFERENCES `majors` (`major_name`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `courses_ibfk_2` FOREIGN KEY (`semester`) REFERENCES `semesters` (`semester_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `courses_enrollments`
--
ALTER TABLE `courses_enrollments`
  ADD CONSTRAINT `courses_enrollments_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `courses_enrollments_ibfk_2` FOREIGN KEY (`course_code`) REFERENCES `courses` (`course_code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `enrollements`
--
ALTER TABLE `enrollements`
  ADD CONSTRAINT `enrollements_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `enrollements_ibfk_2` FOREIGN KEY (`id_course`) REFERENCES `courses` (`id_course`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `enrollements_ibfk_3` FOREIGN KEY (`semester`) REFERENCES `semesters` (`semester_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `semester_enrollments`
--
ALTER TABLE `semester_enrollments`
  ADD CONSTRAINT `semester_enrollments_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `semester_enrollments_ibfk_2` FOREIGN KEY (`student_major`) REFERENCES `majors` (`major_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `semester_enrollments_ibfk_3` FOREIGN KEY (`student_email`) REFERENCES `students` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`major`) REFERENCES `majors` (`major_name`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
