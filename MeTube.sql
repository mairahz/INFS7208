-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 30, 2020 at 07:06 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `MeTube`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `commentID` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `videoID` int(11) NOT NULL,
  `comment` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentID`, `username`, `videoID`, `comment`) VALUES
(1, 'tata', 42, 'Good'),
(2, '192.168.64.1', 42, 'hmm');

-- --------------------------------------------------------

--
-- Table structure for table `favourite_videos`
--

CREATE TABLE `favourite_videos` (
  `username` varchar(30) NOT NULL,
  `videoID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `favourite_videos`
--

INSERT INTO `favourite_videos` (`username`, `videoID`) VALUES
('tata', 42),
('tata', 43);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notificationID` int(11) NOT NULL,
  `owner` varchar(30) NOT NULL,
  `commentor` varchar(30) NOT NULL,
  `videoID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `username` varchar(30) NOT NULL,
  `question` varchar(300) NOT NULL,
  `answer` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`username`, `question`, `answer`) VALUES
('tata', 'What is the last name of the teacher who first gave you your first failing grade?', 'tata'),
('tata', 'What is the name of the person you first kissed?', 'tata');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `tag_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `verify_code` char(20) NOT NULL,
  `verified` char(1) NOT NULL DEFAULT 'N',
  `password` varchar(100) NOT NULL,
  `gender` char(1) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `dp` varchar(30) NOT NULL DEFAULT '4517876.png',
  `endpoint` varchar(600) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `email`, `verify_code`, `verified`, `password`, `gender`, `birthdate`, `dp`, `endpoint`) VALUES
(9, 'tata', 'nor_umairah@hotmail.com', 'b53490f1c4f5f80d6d8f', 'Y', '$2y$10$3l1HHqOsULHGF95oKyTWd.eSefY3ROhPhMZxE9IwHk2NQar0Vc2Oa', NULL, NULL, '4517876.png', '{\"endpoint\":\"https://fcm.googleapis.com/fcm/send/eauzGjKHduI:APA91bFMw5xCLJCPj24jMO5tvOiO8J6597bUWZr2ejiGv0kNeoha47fUqYKk-cO88cpoef0d8cWOvPKngfnpO_z27ZwY9VimDfb-uCcH2N6MK1ExzM9T1zodolRP-L2DDdaVc518qxls\",\"expirationTime\":null,\"keys\":{\"p256dh\":\"BCxnMnU2L9jgW5-NPjrw3v-LSPvLCW66bNYHbbrF5P_3iKGJSOgnZnwPFCDrIL8wrrtFlH5m75uiUtDUS_gnA7Q\",\"auth\":\"Mr2rexKayGCOc3KHQKPIkw\"}}');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `videoID` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `video` varchar(30) NOT NULL,
  `thumbnail` varchar(30) DEFAULT NULL,
  `title` varchar(30) NOT NULL,
  `des` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`videoID`, `username`, `video`, `thumbnail`, `title`, `des`) VALUES
(42, '', '1588256404.mp4', '1588256402.jpeg', 'BTS - ON', 'ON MV'),
(43, '', '1588256551.mp4', '1588256543.jpeg', 'BTS - ON 2', 'dsf'),
(44, '', '1588262437.mp4', '1588262437.jpeg', 'HOHO', 'HOHOHOHOHOHOH'),
(45, 'chim', '1588262495.mp4', '1588262491.jpeg', 'HMMHMMH', 'MHMHMHM'),
(46, 'tata', '', '1589544885.jpeg', 'Dont wanna cry', 'Seventeen');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentID`);

--
-- Indexes for table `favourite_videos`
--
ALTER TABLE `favourite_videos`
  ADD PRIMARY KEY (`username`,`videoID`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notificationID`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`username`,`question`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tag_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `verify_code` (`verify_code`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`videoID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notificationID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `videoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
