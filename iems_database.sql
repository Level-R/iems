-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2025 at 03:37 PM
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
-- Database: `iems_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `user_id`, `profile_image`, `created_at`) VALUES
(1, 1, 'admin_1.jpg', '2025-07-30 06:39:07');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `class_name` varchar(100) NOT NULL,
  `class_code` varchar(20) NOT NULL,
  `section` varchar(10) DEFAULT NULL,
  `class_teacher` varchar(100) DEFAULT NULL,
  `room_number` varchar(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `id` int(11) NOT NULL,
  `section` varchar(10) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `section_teacher` varchar(100) DEFAULT NULL,
  `room_number` varchar(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `section`, `class_id`, `section_teacher`, `room_number`, `created_at`, `updated_at`) VALUES
(1, 'A', NULL, NULL, NULL, '2025-08-12 07:17:10', '2025-08-12 07:17:10'),
(2, 'B', NULL, NULL, NULL, '2025-08-12 07:17:10', '2025-08-12 07:17:10');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `student_id` varchar(20) DEFAULT NULL,
  `roll_number` varchar(10) DEFAULT NULL,
  `class` varchar(100) DEFAULT NULL,
  `section` varchar(10) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `session_year` year(4) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT 'Other',
  `blood_group` varchar(5) DEFAULT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `national_id` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `permanent_address` text DEFAULT NULL,
  `guardian_name` varchar(100) DEFAULT NULL,
  `guardian_phone` varchar(20) DEFAULT NULL,
  `guardian_relation` varchar(50) DEFAULT NULL,
  `admission_date` date DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `user_id`, `student_id`, `roll_number`, `class`, `section`, `department`, `session_year`, `date_of_birth`, `gender`, `blood_group`, `religion`, `national_id`, `address`, `permanent_address`, `guardian_name`, `guardian_phone`, `guardian_relation`, `admission_date`, `photo`) VALUES
(1, 3, '212010078', '2120', 'bachelor of science', 'A', 'Computer Science and Engineering (CSE)', '2025', '2000-03-17', 'Male', 'b+', 'Islam', '215456987856', 'Feni, Noakhali.', 'Mohakhali, dhaka.', 'Md. Habib rahman', '01866450125', 'Brother', '2025-08-02', NULL),
(2, 15, '212010079', '2121', 'bachelor of arts', 'A', 'English', '2025', '2002-08-20', 'Male', 'O-', 'Islam', '21356245124', 'Sunapur, Noakhali', 'Mirpur-10,dhaka', 'Mr. Nazmul haque', '01638526895', 'Father', '2024-08-28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `gender` enum('Male','Female','Other') DEFAULT 'Other',
  `qualification` varchar(100) DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL,
  `subject_speciality` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `permanent_address` text DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `blood_group` varchar(5) DEFAULT NULL,
  `national_id` varchar(50) DEFAULT NULL,
  `experience_years` int(11) DEFAULT 0,
  `date_of_birth` date DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `position` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `user_id`, `gender`, `qualification`, `department`, `subject_speciality`, `address`, `permanent_address`, `profile_pic`, `blood_group`, `national_id`, `experience_years`, `date_of_birth`, `joining_date`, `created_at`, `updated_at`, `position`) VALUES
(4, 15, '', 'bachelor of BA', '', '', NULL, NULL, 'default.png', NULL, NULL, 0, NULL, '0000-00-00', '2025-08-04 15:46:10', '2025-08-04 15:46:10', ''),
(6, 18, 'Male', 'Bsc in', 'EEE', 'Electric', '', '', '/iems/uploads/profile_pics/1754837285_IMG-20250807-WA0002 (1).jpg', '', '1083268102', 0, '0000-00-00', '2025-08-04', '2025-08-04 16:51:24', '2025-08-10 14:48:05', 'Junior'),
(7, 22, 'Male', 'bachelor of BA', 'Economics', 'Math', '', '', '/iems/uploads/profile_pics/1754455904_admin.jpg', '', '2154569878545', 0, '0000-00-00', '2025-08-05', '2025-08-05 08:47:16', '2025-08-06 04:51:44', 'Junior'),
(8, 23, 'Male', 'bachelor of Science', 'EEE', 'Robotics', '', '', '/iems/uploads/profile_pics/1755004867_admin.png', '', '215456987809', 3, '0000-00-00', '2025-08-05', '2025-08-05 08:51:24', '2025-08-12 13:21:07', 'Senior');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','teacher','student','moderator','accounts') NOT NULL DEFAULT 'student',
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_token_expires` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('Active','Inactive','Retired','On Leave','graduated','expelled') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `username`, `email`, `phone_number`, `password`, `role`, `reset_token`, `reset_token_expires`, `created_at`, `updated_at`, `status`) VALUES
(1, 'abdur rahman', 'roky', 'admin', 'quickrcustomerservice@gmail.com', '01866751015', '$2y$10$Ih1Qy/PKOLxQCo5ua4PQy.QzQnC0ICQ7K71Eoe810LCXAAMXFViKK', 'admin', NULL, NULL, '2025-07-28 08:28:18', '2025-07-28 08:28:18', 'Active'),
(3, 'Rakib', 'Hossain', 'student1', 'vacahe7033@kurbieh.com', '01866751017', '$2y$10$lNJY/qgdCxyJaTIrnwUu7.0ua7tJ9bLuFpbzznTr/KHezb/XDfI/q', 'student', NULL, NULL, '2025-08-03 13:14:48', '2025-08-03 13:14:48', 'Active'),
(15, 'Md. emam', 'Hossain', 'student2', 'vacahea7033@kurbieh.com', '0186675101', '$2y$10$wlwcumwSJS6fDmpDdX.uiOTHyrFKn.zUc7rzP3zC1RJTqncUf1luO', 'student', NULL, NULL, '2025-08-04 15:46:10', '2025-08-04 15:46:10', 'Active'),
(18, 'Abdus Samad', 'Masud', 'teacher5', 'helal.splbd1@gmail.com', '01866751021', '$2y$10$B0he.lwtauCfSu6tAK8yjuaDzmUUU.FMkzqeK9f/NMrAmh12k1LUa', 'teacher', NULL, NULL, '2025-08-04 16:51:24', '2025-08-04 16:51:24', 'Active'),
(22, 'Mr. didar', 'Hossain', 'teacher6', 'mrdidar.teacher6@gmail.com', '01866751022', '$2y$10$h09ffjM5n9MHifwqiXnum.lBpg7NJOQzoRLq33Cd010sZxx8HO0BC', 'teacher', NULL, NULL, '2025-08-05 08:47:16', '2025-08-06 13:57:27', 'Active'),
(23, 'Md. Harunur', 'Rashid', 'teacher7', 'teacher7@gmail.com', '01866751023', '$2y$10$HPySxF7awWAkyX8QaDuNGeCcpz5Jjza8vXbP2ksBmUjo.07IL6SlC', 'teacher', NULL, NULL, '2025-08-05 08:51:24', '2025-08-12 13:21:07', 'Inactive');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `class_code` (`class_code`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_id` (`student_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD UNIQUE KEY `national_id` (`national_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone_number` (`phone_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `section`
--
ALTER TABLE `section`
  ADD CONSTRAINT `section_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
