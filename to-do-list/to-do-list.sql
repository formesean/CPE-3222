-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2025 at 03:33 AM
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
-- Database: `to-do-list`
--

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('pending','completed') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `user_id`, `title`, `description`, `status`, `created_at`, `updated_at`) VALUES
(5, 2, 'Task 1', 'Task 1 Description', 'completed', '2025-05-17 01:02:08', '2025-05-17 01:02:42'),
(6, 2, 'Task 2', 'Task 2 Description', 'pending', '2025-05-17 01:02:14', '2025-05-17 01:02:49'),
(7, 2, 'Task 3', 'Task 3 Description', 'pending', '2025-05-17 01:02:20', '2025-05-17 01:02:20'),
(8, 2, 'Task 4', 'Task 4 Description', 'pending', '2025-05-17 01:02:27', '2025-05-17 01:02:27'),
(9, 2, 'Task 5', 'Task 5 Description', 'completed', '2025-05-17 01:02:31', '2025-05-17 01:02:51'),
(10, 2, 'Task 6', 'Task6 Description', 'pending', '2025-05-17 01:02:37', '2025-05-17 01:02:37'),
(12, 2, 'Yes', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse sagittis sit amet massa ut tempus. Etiam id diam nisl. Praesent iaculis a nunc et pretium. Donec a tincidunt ante, in sodales lacus. Curabitur sollicitudin dui dui, sed varius magna sodales ac. In sem elit, laoreet sit amet luctus quis, ultricies at velit. Fusce viverra odio ex, id ultrices dui tincidunt eget.\r\n\r\nMaecenas lectus velit, convallis ut eleifend et, porta nec ligula. Phasellus vestibulum, elit ut fermentum interdum, purus sem pharetra tellus, non aliquam ante ipsum feugiat eros. Nunc pellentesque arcu eu venenatis pharetra. Nam sed odio est. Ut vulputate, mi quis laoreet sollicitudin, augue felis fringilla nibh, sed feugiat ante risus ut nunc. Aliquam id metus congue, suscipit diam vitae, ultrices justo. Vestibulum interdum orci nulla, et dictum ex auctor id.', 'pending', '2025-05-17 01:14:25', '2025-05-17 01:14:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', 'password', '2025-05-16 23:48:29'),
(2, 'parmesean', '1234', '2025-05-16 23:54:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
