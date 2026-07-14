-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2025 at 06:10 PM
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
-- Database: `medical`
--

-- --------------------------------------------------------

--
-- Table structure for table `leave_requests`
--

CREATE TABLE `leave_requests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `reason` text NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `doctor_approval` enum('pending','approved') DEFAULT 'pending',
  `dean_approval` enum('pending','approved') DEFAULT 'pending',
  `hod_approval` enum('pending','approved') DEFAULT 'pending',
  `teacher_approval` enum('pending','approved') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leave_requests`
--

INSERT INTO `leave_requests` (`id`, `user_id`, `start_date`, `end_date`, `reason`, `status`, `doctor_approval`, `dean_approval`, `hod_approval`, `teacher_approval`, `created_at`, `updated_at`) VALUES
(1, 6, '2025-05-15', '2025-05-17', 'Medical leave due to flu', 'pending', 'pending', 'pending', 'pending', 'pending', '2025-05-09 15:07:46', '2025-05-11 14:24:00'),
(2, 6, '2025-06-10', '2025-06-12', 'Medical leave for surgery recovery', 'pending', 'pending', 'pending', 'pending', 'pending', '2025-05-09 15:07:46', '2025-05-11 14:24:00'),
(3, 7, '2025-05-20', '2025-05-22', 'Medical leave due to food poisoning', 'pending', 'pending', 'pending', 'pending', 'pending', '2025-05-09 15:07:46', '2025-05-11 14:24:00'),
(4, 8, '2025-06-05', '2025-06-07', 'Medical leave for dental surgery recovery', 'pending', 'pending', 'pending', 'pending', 'pending', '2025-05-09 15:07:46', '2025-05-11 14:24:00'),
(5, 9, '2025-05-10', '2025-05-12', 'Medical leave due to fever', 'pending', 'pending', 'pending', 'pending', 'pending', '2025-05-09 15:07:46', '2025-05-11 14:24:00'),
(6, 10, '2025-05-18', '2025-05-20', 'Medical leave due to eye surgery recovery', 'pending', 'pending', 'pending', 'pending', 'pending', '2025-05-09 15:07:46', '2025-05-11 14:24:00'),
(7, 11, '2025-06-15', '2025-06-17', 'Medical leave due to back pain', 'pending', 'pending', 'pending', 'pending', 'pending', '2025-05-09 15:07:46', '2025-05-11 14:24:00'),
(8, 12, '2025-06-10', '2025-06-12', 'Medical leave for personal illness', 'pending', 'pending', 'pending', 'pending', 'pending', '2025-05-09 15:07:46', '2025-05-11 14:24:00'),
(9, 1, '2025-05-23', '2025-05-28', 'due to backpain', 'pending', 'pending', 'pending', 'pending', 'pending', '2025-05-09 18:38:45', '2025-05-11 14:24:00'),
(10, 17, '2025-05-12', '2025-05-15', 'Viral Fever', 'pending', 'pending', 'pending', 'pending', 'pending', '2025-05-10 07:02:55', '2025-05-11 14:24:00'),
(11, 17, '2025-05-17', '2025-05-20', 'flu and cold', 'pending', 'pending', 'pending', 'pending', 'pending', '2025-05-10 07:08:55', '2025-05-11 14:24:00');

-- --------------------------------------------------------

--
-- Table structure for table `medical_history`
--

CREATE TABLE `medical_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `doctor_name` varchar(255) NOT NULL,
  `diagnosis` text NOT NULL,
  `prescription` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medical_history`
--

INSERT INTO `medical_history` (`id`, `user_id`, `doctor_name`, `diagnosis`, `prescription`, `created_at`) VALUES
(1, 6, 'Dr. Emily White', 'Flu, fever, and fatigue', 'Flu medication and bed rest for 3 days', '2025-05-09 15:07:46'),
(2, 7, 'Dr. Alex Brown', 'Food poisoning and dehydration', 'Hydration therapy and rest for 2 days', '2025-05-09 15:07:46'),
(3, 8, 'Dr. Mary Black', 'Dental surgery recovery', 'Painkillers and oral hygiene management', '2025-05-09 15:07:46'),
(4, 9, 'Dr. Emily White', 'Fever with cold symptoms', 'Rest and flu medications', '2025-05-09 15:07:46'),
(5, 10, 'Dr. Alex Brown', 'Eye surgery recovery', 'Post-surgery eye care and medications', '2025-05-09 15:07:46'),
(6, 11, 'Dr. Emily White', 'Severe back pain', 'Muscle relaxants and bed rest for 1 week', '2025-05-09 15:07:46'),
(7, 12, 'Dr. Mary Black', 'Personal illness', 'Rest and medication for flu symptoms', '2025-05-09 15:07:46');

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`id`, `user_id`, `file_name`, `file_path`, `created_at`) VALUES
(1, 6, 'medical_certificate_sarah.pdf', '/uploads/medical_certificate_sarah.pdf', '2025-05-09 15:07:46'),
(2, 7, 'medical_certificate_alice.pdf', '/uploads/medical_certificate_alice.pdf', '2025-05-09 15:07:46'),
(3, 8, 'dental_surgery_certificate_sophia.pdf', '/uploads/dental_surgery_certificate_sophia.pdf', '2025-05-09 15:07:46'),
(4, 9, 'fever_certificate_tom.pdf', '/uploads/fever_certificate_tom.pdf', '2025-05-09 15:07:46'),
(5, 10, 'eye_surgery_certificate_james.pdf', '/uploads/eye_surgery_certificate_james.pdf', '2025-05-09 15:07:46'),
(6, 11, 'back_pain_certificate_henry.pdf', '/uploads/back_pain_certificate_henry.pdf', '2025-05-09 15:07:46'),
(7, 12, 'flu_certificate_olivia.pdf', '/uploads/flu_certificate_olivia.pdf', '2025-05-09 15:07:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('student','doctor','teacher','hod','dean') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'John Doe', 'john.doe@student.com', 'password123', 'student', '2025-05-09 15:07:46', '2025-05-09 15:07:46'),
(2, 'Dr. Emily White', 'emily.white@doctor.com', 'doctorpass', 'doctor', '2025-05-09 15:07:46', '2025-05-09 15:07:46'),
(3, 'Robert Lee', 'robert.lee@teacher.com', 'teacherpass', 'teacher', '2025-05-09 15:07:46', '2025-05-09 15:07:46'),
(4, 'Clara Black', 'clara.black@hod.com', 'hodpass', 'hod', '2025-05-09 15:07:46', '2025-05-09 15:07:46'),
(5, 'James Green', 'james.green@dean.com', 'deanpass', 'dean', '2025-05-09 15:07:46', '2025-05-09 15:07:46'),
(6, 'Sarah Connor', 'sarah.connor@student.com', 'password123', 'student', '2025-05-09 15:07:46', '2025-05-09 15:07:46'),
(7, 'Alice Williams', 'alice.williams@student.com', 'password123', 'student', '2025-05-09 15:07:46', '2025-05-09 15:07:46'),
(8, 'Dr. Alex Brown', 'alex.brown@doctor.com', 'doctorpass', 'doctor', '2025-05-09 15:07:46', '2025-05-09 15:07:46'),
(9, 'David Smith', 'david.smith@teacher.com', 'teacherpass', 'teacher', '2025-05-09 15:07:46', '2025-05-09 15:07:46'),
(10, 'Sophia Green', 'sophia.green@hod.com', 'hodpass', 'hod', '2025-05-09 15:07:46', '2025-05-09 15:07:46'),
(11, 'Michael Davis', 'michael.davis@dean.com', 'deanpass', 'dean', '2025-05-09 15:07:46', '2025-05-09 15:07:46'),
(12, 'Tom White', 'tom.white@student.com', 'password123', 'student', '2025-05-09 15:07:46', '2025-05-09 15:07:46'),
(13, 'Dr. Mary Black', 'mary.black@doctor.com', 'doctorpass', 'doctor', '2025-05-09 15:07:46', '2025-05-09 15:07:46'),
(14, 'James Wilson', 'james.wilson@teacher.com', 'teacherpass', 'teacher', '2025-05-09 15:07:46', '2025-05-09 15:07:46'),
(15, 'Olivia Taylor', 'olivia.taylor@hod.com', 'hodpass', 'hod', '2025-05-09 15:07:46', '2025-05-09 15:07:46'),
(16, 'Henry Clark', 'henry.clark@dean.com', 'deanpass', 'dean', '2025-05-09 15:07:46', '2025-05-09 15:07:46'),
(17, 'Mahima Singh', 'mahima1@gmail.com', 'mahima123', 'student', '2025-05-10 05:48:48', '2025-05-10 05:48:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `medical_history`
--
ALTER TABLE `medical_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

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
-- AUTO_INCREMENT for table `leave_requests`
--
ALTER TABLE `leave_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `medical_history`
--
ALTER TABLE `medical_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD CONSTRAINT `leave_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `medical_history`
--
ALTER TABLE `medical_history`
  ADD CONSTRAINT `medical_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `uploads`
--
ALTER TABLE `uploads`
  ADD CONSTRAINT `uploads_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
