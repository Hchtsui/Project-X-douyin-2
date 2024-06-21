-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2024 at 10:38 AM
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
-- Database: `douyin`
--
CREATE DATABASE IF NOT EXISTS `douyin` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `douyin`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'All'),
(2, 'funny'),
(3, 'educational');

-- --------------------------------------------------------

--
-- Table structure for table `categories_videos`
--

DROP TABLE IF EXISTS `categories_videos`;
CREATE TABLE `categories_videos` (
  `categories_id` int(11) NOT NULL,
  `videos_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240619225609', '2024-06-19 22:56:20', 454),
('DoctrineMigrations\\Version20240620111812', '2024-06-20 11:18:20', 305),
('DoctrineMigrations\\Version20240620114033', '2024-06-20 11:40:41', 452);

-- --------------------------------------------------------

--
-- Table structure for table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`) VALUES
(1, '#educational');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`) VALUES
(1, '302139184@student.rocmondriaan.nl', '[\"ROLE_USER\",\"ROLE_EMPLOYEE\"]', '$2y$13$NSMFrGgZ78N9kECPUNwzl.QNh/irRrDghGFCkcPwbqh/tGigCvTwe'),
(2, 'henry@gmail.com', '{\"1\":\"ROLE_USER\",\"0\":\"ROLE_ADMIN\",\"2\":\"ROLE_EMPLOYEE\"}', '$2y$13$O.k/7bIAQO5Jadk1ft2gD.42yUnlGxiFdHI1tBHY23oUsWgDADbYW');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

DROP TABLE IF EXISTS `videos`;
CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `name` longtext DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `tag` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `name`, `description`, `url`, `tag`) VALUES
(1, 'Tiktok', 'learning', 'https://www.youtube.com/embed/RzotwAImsas?si=7A4mks_axxt3cyxT', '#Educational'),
(11, 'joe mama', 'ahwww jaaaa', 'https://www.youtube.com/embed/T-o_S4EInOg?si=LnFJPq-9uAsUBPZP', '#Funny'),
(12, 'How TikTok\'s Algorithm Figures You Out | WSJ', 'The Wall Street Journal created dozens of automated accounts that watched hundreds of thousands of videos to reveal how the the TikTok algorithm knows you so well.\r\n\r\nA Wall Street Journal investigation found that TikTok only needs one important piece of information to figure out what you want: the amount of time you linger over a piece of content. Every second you hesitate or rewatch, the app is tracking you. \r\n\r\nPhoto illustration: Laura Kammermann/The Wall Street Journal\r\n\r\nWSJ video investigations use visual evidence to reveal the truth behind the most important stories of the day.\r\n\r\nInside TikTok’s Highly Secretive Algorithm\r\nThis WSJ video investigation reveals how the video-centric social network is so good at figuring out interests you never expressly tell it.', 'https://www.youtube.com/embed/nfczi2cI6Cs?si=0g7WXjaYO_cVPRQe', '#Educational');

-- --------------------------------------------------------

--
-- Table structure for table `videos_tags`
--

DROP TABLE IF EXISTS `videos_tags`;
CREATE TABLE `videos_tags` (
  `videos_id` int(11) NOT NULL,
  `tags_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `video_category`
--

DROP TABLE IF EXISTS `video_category`;
CREATE TABLE `video_category` (
  `videos_id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `video_category`
--

INSERT INTO `video_category` (`videos_id`, `categories_id`) VALUES
(1, 1),
(1, 3),
(11, 1),
(11, 2),
(12, 1),
(12, 3);

-- --------------------------------------------------------

--
-- Table structure for table `video_tag`
--

DROP TABLE IF EXISTS `video_tag`;
CREATE TABLE `video_tag` (
  `videos_id` int(11) NOT NULL,
  `tags_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `video_tag`
--

INSERT INTO `video_tag` (`videos_id`, `tags_id`) VALUES
(1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories_videos`
--
ALTER TABLE `categories_videos`
  ADD PRIMARY KEY (`categories_id`,`videos_id`),
  ADD KEY `IDX_21C35A0AA21214B7` (`categories_id`),
  ADD KEY `IDX_21C35A0A763C10B2` (`videos_id`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos_tags`
--
ALTER TABLE `videos_tags`
  ADD PRIMARY KEY (`videos_id`,`tags_id`),
  ADD KEY `IDX_CD9528D2763C10B2` (`videos_id`),
  ADD KEY `IDX_CD9528D28D7B4FB4` (`tags_id`);

--
-- Indexes for table `video_category`
--
ALTER TABLE `video_category`
  ADD PRIMARY KEY (`videos_id`,`categories_id`),
  ADD KEY `IDX_AECE2B7D763C10B2` (`videos_id`),
  ADD KEY `IDX_AECE2B7DA21214B7` (`categories_id`);

--
-- Indexes for table `video_tag`
--
ALTER TABLE `video_tag`
  ADD PRIMARY KEY (`videos_id`,`tags_id`),
  ADD KEY `IDX_F9107287763C10B2` (`videos_id`),
  ADD KEY `IDX_F91072878D7B4FB4` (`tags_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories_videos`
--
ALTER TABLE `categories_videos`
  ADD CONSTRAINT `FK_21C35A0A763C10B2` FOREIGN KEY (`videos_id`) REFERENCES `videos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_21C35A0AA21214B7` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `videos_tags`
--
ALTER TABLE `videos_tags`
  ADD CONSTRAINT `FK_CD9528D2763C10B2` FOREIGN KEY (`videos_id`) REFERENCES `videos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_CD9528D28D7B4FB4` FOREIGN KEY (`tags_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `video_category`
--
ALTER TABLE `video_category`
  ADD CONSTRAINT `FK_AECE2B7D763C10B2` FOREIGN KEY (`videos_id`) REFERENCES `videos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_AECE2B7DA21214B7` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `video_tag`
--
ALTER TABLE `video_tag`
  ADD CONSTRAINT `FK_F9107287763C10B2` FOREIGN KEY (`videos_id`) REFERENCES `videos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_F91072878D7B4FB4` FOREIGN KEY (`tags_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
