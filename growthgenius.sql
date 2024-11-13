-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2024 at 01:22 PM
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
-- Database: `growthgenius`
--

-- --------------------------------------------------------

--
-- Table structure for table `digital_marketing`
--

CREATE TABLE `digital_marketing` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `marketing_type` varchar(50) NOT NULL,
  `campaign_objectives` text DEFAULT NULL,
  `target_audience` text DEFAULT NULL,
  `budget` decimal(10,2) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `digital_marketing`
--

INSERT INTO `digital_marketing` (`id`, `first_name`, `last_name`, `company_name`, `email`, `marketing_type`, `campaign_objectives`, `target_audience`, `budget`, `start_date`, `end_date`) VALUES
(1, 'Harsh', 'Rana', 'Glide technology', 'hr810004@gmail.com', 'digital', 'hi', 'hdadea', 90000.00, '2024-11-13', '2024-11-29');

-- --------------------------------------------------------

--
-- Table structure for table `email_marketing`
--

CREATE TABLE `email_marketing` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `company` varchar(100) NOT NULL,
  `campaign_name` varchar(100) NOT NULL,
  `subject_line` varchar(150) NOT NULL,
  `email_content` text NOT NULL,
  `target_audience` text DEFAULT NULL,
  `send_date` date NOT NULL,
  `send_time` time NOT NULL,
  `success_rate` decimal(5,2) DEFAULT NULL,
  `budget` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `email_marketing`
--

INSERT INTO `email_marketing` (`id`, `first_name`, `last_name`, `email`, `company`, `campaign_name`, `subject_line`, `email_content`, `target_audience`, `send_date`, `send_time`, `success_rate`, `budget`) VALUES
(1, 'Harsh', 'Rana', 'hr810004@gmail.com', 'Glide technology', 'email', 'subject to email marketing', 'hi this is test mail', 'young people', '2024-11-06', '15:22:00', 80.00, 90000.00);

-- --------------------------------------------------------

--
-- Table structure for table `keyword_targeting`
--

CREATE TABLE `keyword_targeting` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `keywords` text NOT NULL,
  `audience_interest` varchar(255) DEFAULT NULL,
  `competitor_keywords` text DEFAULT NULL,
  `organic_traffic_increase` tinyint(1) DEFAULT 0,
  `conversion_rate_improvement` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keyword_targeting`
--

INSERT INTO `keyword_targeting` (`id`, `first_name`, `last_name`, `company_name`, `email`, `keywords`, `audience_interest`, `competitor_keywords`, `organic_traffic_increase`, `conversion_rate_improvement`) VALUES
(1, 'Harsh', 'Rana', 'Glide technology', 'hr810004@gmail.com', 'hasd , hadshas , hiada', 'young and new gen people', 'hi , hello , marketing', 1, 1),
(2, 'Harsh', 'Rana', 'Glide technology', 'hr810004@gmail.com', '', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `marketing_reports`
--

CREATE TABLE `marketing_reports` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `company` varchar(100) NOT NULL,
  `business_goals` text NOT NULL,
  `target_audience` text DEFAULT NULL,
  `marketing_channels` text DEFAULT NULL,
  `reporting_frequency` enum('weekly','monthly','quarterly') NOT NULL,
  `report_format` enum('pdf','excel') NOT NULL,
  `budget` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `marketing_reports`
--

INSERT INTO `marketing_reports` (`id`, `first_name`, `last_name`, `email`, `company`, `business_goals`, `target_audience`, `marketing_channels`, `reporting_frequency`, `report_format`, `budget`) VALUES
(1, 'Harsh', 'Rana', 'hr810004@gmail.com', 'Glide technology', 'hi', 'young people', 'social media', 'weekly', 'pdf', 8000.00);

-- --------------------------------------------------------

--
-- Table structure for table `market_research`
--

CREATE TABLE `market_research` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `strategy_description` text DEFAULT NULL,
  `techniques` text DEFAULT NULL,
  `budget` decimal(10,2) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `market_research`
--

INSERT INTO `market_research` (`id`, `first_name`, `last_name`, `company_name`, `email`, `strategy_description`, `techniques`, `budget`, `start_date`, `end_date`) VALUES
(1, 'Harsh', 'Rana', 'Glide technology', 'hr810004@gmail.com', 'fdsfsj', 'hii', 90000.00, '2024-11-13', '2024-11-27');

-- --------------------------------------------------------

--
-- Table structure for table `seo_requests`
--

CREATE TABLE `seo_requests` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `company` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `website` varchar(255) NOT NULL,
  `seo_goals` text NOT NULL,
  `target_keywords` text NOT NULL,
  `budget` varchar(50) NOT NULL,
  `timeline` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seo_requests`
--

INSERT INTO `seo_requests` (`id`, `first_name`, `last_name`, `company`, `email`, `contact_number`, `website`, `seo_goals`, `target_keywords`, `budget`, `timeline`) VALUES
(2, 'Harsh', 'Rana', 'Glide technology', 'hr810004@gmail.com', '9727347935', 'https://chatgpt.com/', 'fdsjsdh', 'hdsjfh', '90000', '2 days');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(5) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `company` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `company`, `email`, `password`) VALUES
(7, 'Harsh', 'Rana', 'Glide technology', 'hr810004@gmail.com', '$2y$10$3ymUhke1Ow7w/SN8AGIvTe2xfnHVoiCq2J270YME.uGbIxudGrHmK'),
(8, 'Haard', 'Patel', 'Cognizant', 'haardpatel22@pdpu.com', '$2y$10$DKbhJePxkwcRNpxQjrj0d.rDnnnSp4WyBpxsZ6pmExkPl482i7qtC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `digital_marketing`
--
ALTER TABLE `digital_marketing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_marketing`
--
ALTER TABLE `email_marketing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keyword_targeting`
--
ALTER TABLE `keyword_targeting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marketing_reports`
--
ALTER TABLE `marketing_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `market_research`
--
ALTER TABLE `market_research`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seo_requests`
--
ALTER TABLE `seo_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `digital_marketing`
--
ALTER TABLE `digital_marketing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `email_marketing`
--
ALTER TABLE `email_marketing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `keyword_targeting`
--
ALTER TABLE `keyword_targeting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `marketing_reports`
--
ALTER TABLE `marketing_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `market_research`
--
ALTER TABLE `market_research`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `seo_requests`
--
ALTER TABLE `seo_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
