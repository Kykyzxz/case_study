-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2025 at 09:23 AM
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
  `year_created` date NOT NULL,
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
(9, 'sdjkj', 'akjsdkj', '0000-00-00', 'akakj', 'kjakj', 'kjakj', 'kjkj', 'Landscape', 'aakjajakj', '1765348722_69391572f157b.png', 'National');

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
(3, 3, 6, 'pogi ko pre omg', '2025-12-10 07:56:47', '2025-12-10 07:56:47');

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
(2, 'TESTING TESTING', 'testing@gmail.com', 'grabegrabegrabe'),
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
  MODIFY `artwork_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `artwork_comments`
--
ALTER TABLE `artwork_comments`
  MODIFY `comment_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `artwork_likes`
--
ALTER TABLE `artwork_likes`
  MODIFY `like_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
