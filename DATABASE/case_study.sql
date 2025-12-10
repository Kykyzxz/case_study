-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2025 at 04:50 PM
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
-- Database: `case_study`
--

-- --------------------------------------------------------

--
-- Table structure for table `artwork`
--

CREATE TABLE `artwork` (
  `artwork_id` int(11) NOT NULL,
  `artwork_title` varchar(255) NOT NULL,
  `artist` varchar(255) NOT NULL,
  `year_created` varchar(50) DEFAULT NULL,
  `artwork_desc` text NOT NULL,
  `medium` varchar(255) NOT NULL,
  `dimension` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `orientation` varchar(255) NOT NULL,
  `artist_desc` text NOT NULL,
  `image` varchar(500) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artwork`
--

INSERT INTO `artwork` (`artwork_id`, `artwork_title`, `artist`, `year_created`, `artwork_desc`, `medium`, `dimension`, `category`, `orientation`, `artist_desc`, `image`, `status`) VALUES
(3, 'new testing', 'test', '0000-00-00', 'testestetsestes', 'testetstest', 'testest', 'catetegoryy', 'Landscape', 'testetstss', '1765113228_69357d8cb6705.jfif', 'National'),
(4, 'Renz nato', 'renz pilar', '0000-00-00', 'tite', 'testing', 'testing', 'giggigig', 'Landscape', 'tite', 'artwork_1765170877_69365ebde2161.png', 'Local'),
(6, 'Artwork namin to', 'artist', '0000-00-00', 'lorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lore', 'Acrylic', '29 x 29', 'Abstract', 'Portrait', 'lorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lorelorem lorem lore', '1765348563_693914d32909a.jpg', 'National'),
(7, 'hello helllo', 'hello', '0000-00-00', 'hello', 'hello', 'hello', 'hello', 'Landscape', 'hello', '1765348625_6939151111969.png', 'National'),
(8, 'artworkartworkartwork', 'aokoakokaok', '0000-00-00', 'kjakjakjakj', 'okaokaok', 'okoakoak', 'okaokaoko', 'Landscape', 'kjakjkajkaj', '1765348683_6939154ba40fe.JPG', 'National'),
(9, 'sdjkj', 'akjsdkj', '0000-00-00', 'akakj', 'kjakj', 'kjakj', 'kjkj', 'Landscape', 'aakjajakj', '1765348722_69391572f157b.png', 'National'),
(10, 'ASD', 'ASD', '2025', 'ASD', 'ASD', 'ASD', 'Neo-Impressionism', 'Landscape', 'ASD', '1765368629_69396335c976e.png', 'National');

-- --------------------------------------------------------

--
-- Table structure for table `artwork_comments`
--

CREATE TABLE `artwork_comments` (
  `comment_id` int(10) UNSIGNED NOT NULL,
  `artwork_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `comment_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artwork_comments`
--

INSERT INTO `artwork_comments` (`comment_id`, `artwork_id`, `user_id`, `comment_text`, `created_at`, `updated_at`) VALUES
(1, 8, 4, 'hello nagcomment ako guys', '2025-12-10 07:44:53', '2025-12-10 07:44:53'),
(2, 8, 6, 'this is a very good artwork very arman', '2025-12-10 07:47:08', '2025-12-10 07:47:08'),
(3, 3, 6, 'pogi ko pre omg', '2025-12-10 07:56:47', '2025-12-10 07:56:47'),
(4, 6, 4, 'first first', '2025-12-10 09:48:38', '2025-12-10 09:48:38'),
(5, 9, 6, 'omg this art is very nice', '2025-12-10 10:48:44', '2025-12-10 10:48:44'),
(6, 9, 6, 'wowowow grabe the design is very nice talaga and the art is very nice', '2025-12-10 10:49:00', '2025-12-10 10:49:00'),
(7, 9, 6, 'omg', '2025-12-10 10:49:10', '2025-12-10 10:49:10'),
(8, 9, 6, 'omg responsive batong comment', '2025-12-10 10:49:19', '2025-12-10 10:49:19'),
(9, 9, 6, 'grab egrabe diko alam if responsive to', '2025-12-10 10:49:33', '2025-12-10 10:49:33'),
(10, 7, 4, 'grabe ang dila koyang', '2025-12-10 11:52:49', '2025-12-10 11:52:49'),
(11, 4, 4, 'di naman si renz yan eh niloloko niyoko', '2025-12-10 11:56:41', '2025-12-10 11:56:41'),
(12, 11, 4, 'wow grabe tulog si koyang', '2025-12-10 13:42:35', '2025-12-10 13:42:35'),
(13, 3, 4, 'is it overflowing na', '2025-12-10 15:24:37', '2025-12-10 15:24:37'),
(14, 3, 4, 'overflowing ba talaga siya', '2025-12-10 15:25:13', '2025-12-10 15:25:13'),
(15, 3, 4, 'pogi pogi ni luis here', '2025-12-10 15:25:22', '2025-12-10 15:25:22'),
(16, 3, 4, 'bakit di nagsscroll isa panga', '2025-12-10 15:25:35', '2025-12-10 15:25:35'),
(17, 3, 4, 'yan scrollable naba yung comments', '2025-12-10 15:25:49', '2025-12-10 15:25:49'),
(18, 3, 4, 'omg ayan na scrollable na siya taena nice one', '2025-12-10 15:47:14', '2025-12-10 15:47:14');

-- --------------------------------------------------------

--
-- Table structure for table `artwork_likes`
--

CREATE TABLE `artwork_likes` (
  `like_id` int(11) UNSIGNED NOT NULL,
  `artwork_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artwork_likes`
--

INSERT INTO `artwork_likes` (`like_id`, `artwork_id`, `user_id`, `created_at`) VALUES
(6, 3, 4, '2025-12-10 08:27:02'),
(8, 7, 4, '2025-12-10 08:27:11'),
(9, 8, 4, '2025-12-10 08:27:13'),
(11, 6, 6, '2025-12-10 10:48:30'),
(12, 7, 6, '2025-12-10 10:48:32'),
(13, 4, 4, '2025-12-10 11:56:55'),
(14, 3, 6, '2025-12-10 12:53:30'),
(15, 10, 6, '2025-12-10 12:53:32'),
(16, 6, 4, '2025-12-10 13:12:06'),
(17, 11, 4, '2025-12-10 13:56:46'),
(18, 10, 4, '2025-12-10 14:18:31');

-- --------------------------------------------------------

--
-- Table structure for table `artwork_logs`
--

CREATE TABLE `artwork_logs` (
  `log_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `artwork_id` int(11) NOT NULL,
  `action_type` enum('view','like','unlike','comment') NOT NULL,
  `action_details` text DEFAULT NULL,
  `total_likes` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artwork_logs`
--

INSERT INTO `artwork_logs` (`log_id`, `user_id`, `artwork_id`, `action_type`, `action_details`, `total_likes`, `created_at`) VALUES
(1, 4, 6, 'unlike', 'Unliked artwork', 0, '2025-12-10 09:48:21'),
(2, 4, 6, 'comment', 'Commented: first first', 0, '2025-12-10 09:48:38'),
(3, 6, 6, 'like', 'Liked artwork', 1, '2025-12-10 10:48:30'),
(4, 6, 7, 'like', 'Liked artwork', 2, '2025-12-10 10:48:32'),
(5, 6, 3, 'unlike', 'Unliked artwork', 1, '2025-12-10 10:48:34'),
(6, 6, 9, 'comment', 'Commented: omg this art is very nice', 1, '2025-12-10 10:48:44'),
(7, 6, 9, 'comment', 'Commented: wowowow grabe the design is very nice talaga and the art is very nice', 1, '2025-12-10 10:49:00'),
(8, 6, 9, 'comment', 'Commented: omg', 1, '2025-12-10 10:49:10'),
(9, 6, 9, 'comment', 'Commented: omg responsive batong comment', 1, '2025-12-10 10:49:19'),
(10, 6, 9, 'comment', 'Commented: grab egrabe diko alam if responsive to', 1, '2025-12-10 10:49:33'),
(11, 6, 9, 'view', 'Viewed artwork', 1, '2025-12-10 11:14:41'),
(12, 4, 7, 'view', 'Viewed artwork', 2, '2025-12-10 11:24:55'),
(13, 4, 9, 'view', 'Viewed artwork', 1, '2025-12-10 11:35:08'),
(14, 4, 9, 'view', 'Viewed artwork', 1, '2025-12-10 11:35:15'),
(15, 4, 9, 'view', 'Viewed artwork', 1, '2025-12-10 11:45:49'),
(16, 4, 7, 'view', 'Viewed artwork', 2, '2025-12-10 11:52:39'),
(17, 4, 7, 'comment', 'Commented: grabe ang dila koyang', 2, '2025-12-10 11:52:49'),
(18, 4, 4, 'view', 'Viewed artwork', 0, '2025-12-10 11:56:29'),
(19, 4, 4, 'comment', 'Commented: di naman si renz yan eh niloloko niyoko', 0, '2025-12-10 11:56:41'),
(20, 4, 4, 'like', 'Liked artwork', 1, '2025-12-10 11:56:55'),
(21, 4, 9, 'view', 'Viewed artwork', 1, '2025-12-10 11:57:59'),
(22, 4, 9, 'view', 'Viewed artwork', 1, '2025-12-10 12:09:52'),
(23, 4, 10, 'view', 'Viewed artwork', 0, '2025-12-10 12:10:43'),
(24, 4, 10, 'view', 'Viewed artwork', 0, '2025-12-10 12:12:18'),
(25, 4, 10, 'view', 'Viewed artwork', 0, '2025-12-10 12:21:46'),
(26, 4, 9, 'view', 'Viewed artwork', 1, '2025-12-10 12:25:51'),
(27, 4, 10, 'view', 'Viewed artwork', 0, '2025-12-10 12:28:45'),
(28, 4, 9, 'view', 'Viewed artwork', 1, '2025-12-10 12:28:53'),
(29, 4, 10, 'view', 'Viewed artwork', 0, '2025-12-10 12:31:09'),
(30, 4, 10, 'view', 'Viewed artwork', 0, '2025-12-10 12:34:02'),
(31, 4, 10, 'view', 'Viewed artwork', 0, '2025-12-10 12:52:32'),
(32, 6, 3, 'like', 'Liked artwork', 2, '2025-12-10 12:53:30'),
(33, 6, 10, 'like', 'Liked artwork', 1, '2025-12-10 12:53:32'),
(34, 4, 6, 'like', 'Liked artwork', 2, '2025-12-10 13:12:06'),
(35, 4, 11, 'view', 'Viewed artwork', 0, '2025-12-10 13:42:21'),
(36, 4, 11, 'comment', 'Commented: wow grabe tulog si koyang', 0, '2025-12-10 13:42:35'),
(37, 4, 9, 'unlike', 'Unliked artwork', 0, '2025-12-10 13:42:49'),
(38, 4, 11, 'like', 'Liked artwork', 1, '2025-12-10 13:56:46'),
(39, 4, 3, 'view', 'Viewed artwork', 2, '2025-12-10 14:08:56'),
(40, 4, 10, 'like', 'Liked artwork', 2, '2025-12-10 14:18:31'),
(41, 4, 10, 'view', 'Viewed artwork', 2, '2025-12-10 14:49:36'),
(42, 4, 3, 'view', 'Viewed artwork', 2, '2025-12-10 14:57:02'),
(43, 4, 3, 'view', 'Viewed artwork', 2, '2025-12-10 15:24:26'),
(44, 4, 3, 'comment', 'Commented: is it overflowing na', 2, '2025-12-10 15:24:37'),
(45, 4, 3, 'comment', 'Commented: overflowing ba talaga siya', 2, '2025-12-10 15:25:13'),
(46, 4, 3, 'comment', 'Commented: pogi pogi ni luis here', 2, '2025-12-10 15:25:22'),
(47, 4, 3, 'comment', 'Commented: bakit di nagsscroll isa panga', 2, '2025-12-10 15:25:35'),
(48, 4, 3, 'comment', 'Commented: yan scrollable naba yung comments', 2, '2025-12-10 15:25:49'),
(49, 4, 3, 'comment', 'Commented: omg ayan na scrollable na siya taena nice one', 2, '2025-12-10 15:47:14');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `feedback_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `name`, `email`, `feedback_desc`) VALUES
(3, 'tite tite tite', 'tite@gmail.com', 'latest bato weh'),
(4, 'weh ba weh ba omg latest nga', 'grabe@gmail.com', 'grabegraegrabe'),
(5, 'testing whistleblower', 'testing@gmail.com', 'efedfedfedefedf'),
(8, 'Luis Armann Barba', 'armann@gmail.com', 'feedback to guys andito kami sa hey hideout brew coffee shop');

-- --------------------------------------------------------

--
-- Table structure for table `user_acc`
--

CREATE TABLE `user_acc` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_acc`
--

INSERT INTO `user_acc` (`user_id`, `fullname`, `password`, `email`) VALUES
(4, 'kyran solomon', '$2y$10$sOBPIpgJmKGwba7c90shaens8VZ42q2.HA.rG6fAk15Sfa0blektG', 'kyransolomon5@gmail.com'),
(5, 'admin', '$2y$10$kVM825nxFUfuwmIRfB8qnOeTG.S..EvdQpiIWlCGuI480Lko964sO', 'admin@gmail.com'),
(6, 'Luis Armann Barba', '$2y$10$E4LR.aZVNXziJDFXnGwNEuSnP4K2WT.rvk7QszAA5UHm7mI5BLQmS', 'arman@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artwork`
--
ALTER TABLE `artwork`
  ADD PRIMARY KEY (`artwork_id`);

--
-- Indexes for table `artwork_comments`
--
ALTER TABLE `artwork_comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `artwork_likes`
--
ALTER TABLE `artwork_likes`
  ADD PRIMARY KEY (`like_id`),
  ADD UNIQUE KEY `unique_like` (`artwork_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `artwork_logs`
--
ALTER TABLE `artwork_logs`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_artwork_id` (`artwork_id`),
  ADD KEY `idx_action_type` (`action_type`),
  ADD KEY `idx_created_at` (`created_at`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `user_acc`
--
ALTER TABLE `user_acc`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artwork`
--
ALTER TABLE `artwork`
  MODIFY `artwork_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `artwork_comments`
--
ALTER TABLE `artwork_comments`
  MODIFY `comment_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `artwork_likes`
--
ALTER TABLE `artwork_likes`
  MODIFY `like_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `artwork_logs`
--
ALTER TABLE `artwork_logs`
  MODIFY `log_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_acc`
--
ALTER TABLE `user_acc`
  MODIFY `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
