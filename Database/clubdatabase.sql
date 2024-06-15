-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 15, 2024 at 09:26 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clubdatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `Award`
--

CREATE TABLE `Award` (
  `award_id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `award_name` varchar(200) NOT NULL,
  `award_category` varchar(100) NOT NULL,
  `description` varchar(50) DEFAULT NULL,
  `match_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Awards`
--

CREATE TABLE `Awards` (
  `award_id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `award_name` varchar(200) NOT NULL,
  `award_category` varchar(100) NOT NULL,
  `description` varchar(50) DEFAULT NULL,
  `match_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Awards`
--

INSERT INTO `Awards` (`award_id`, `player_id`, `award_name`, `award_category`, `description`, `match_id`) VALUES
(1, 26, 'Man of the Match', 'Performance', 'Best performance of the match', 25),
(2, 27, 'Most Sixes', 'Performance', 'Most Sixes in an Innigs', 23);

-- --------------------------------------------------------

--
-- Table structure for table `Captaincy`
--

CREATE TABLE `Captaincy` (
  `captain_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Club`
--

CREATE TABLE `Club` (
  `club_id` int(11) NOT NULL,
  `club_name` varchar(50) NOT NULL,
  `location` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Club`
--

INSERT INTO `Club` (`club_id`, `club_name`, `location`) VALUES
(3, 'Ashulia Club', 'Ashulia'),
(4, 'Bashundhara Club', 'Bashundhara'),
(5, 'Bashabo Club', 'Bashabo');

-- --------------------------------------------------------

--
-- Table structure for table `Coaches`
--

CREATE TABLE `Coaches` (
  `coach_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `specialization` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Contracts`
--

CREATE TABLE `Contracts` (
  `contract_id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `total_amount` int(11) DEFAULT NULL,
  `terms` text DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `club_id` int(11) DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Contracts`
--

INSERT INTO `Contracts` (`contract_id`, `player_id`, `total_amount`, `terms`, `start_date`, `end_date`, `club_id`, `team_id`) VALUES
(14, 26, 2000, '3 years', '2024-12-22', '2026-12-20', 3, 1),
(15, 27, 10000, '5 years', '2024-05-27', '2029-05-27', 4, 5),
(16, 28, 5000, '3 years', '2024-05-27', '2027-05-27', 3, 2),
(18, 30, 7000, '2 Years', '2024-05-31', '2026-08-31', 5, 3),
(22, 34, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Enrols`
--

CREATE TABLE `Enrols` (
  `player_id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Injuries`
--

CREATE TABLE `Injuries` (
  `injury_id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `description` varchar(50) NOT NULL,
  `recovery_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Installment`
--

CREATE TABLE `Installment` (
  `installment_id` int(11) NOT NULL,
  `installment_amount` decimal(12,2) DEFAULT NULL,
  `installment_date` date DEFAULT NULL,
  `contract_id` int(11) DEFAULT NULL,
  `payment_status` varchar(50) NOT NULL DEFAULT 'Due'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Installment`
--

INSERT INTO `Installment` (`installment_id`, `installment_amount`, `installment_date`, `contract_id`, `payment_status`) VALUES
(12, 2000.00, '2024-02-12', 14, 'Paid'),
(13, 10000.00, '2024-05-27', 15, 'Paid'),
(14, 5000.00, '2024-05-29', 16, 'Paid'),
(15, 7000.00, '2024-05-30', 18, 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `Joins`
--

CREATE TABLE `Joins` (
  `player_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Login`
--

CREATE TABLE `Login` (
  `login_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` char(64) NOT NULL,
  `usertype` varchar(50) NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Login`
--

INSERT INTO `Login` (`login_id`, `username`, `password`, `usertype`, `created_at`) VALUES
(1, 'saif', '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9', 'admin', '2024-05-17 11:14:54'),
(2, 'humayra', 'becf77f3ec82a43422b7712134d1860e3205c6ce778b08417a7389b43f2b4661', 'admin', '2024-05-17 11:20:52');

-- --------------------------------------------------------

--
-- Table structure for table `Matches`
--

CREATE TABLE `Matches` (
  `match_id` int(11) NOT NULL,
  `match_date` date NOT NULL,
  `home_team_id` int(11) NOT NULL,
  `away_team_id` int(11) NOT NULL,
  `result` varchar(50) DEFAULT NULL,
  `venue_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Matches`
--

INSERT INTO `Matches` (`match_id`, `match_date`, `home_team_id`, `away_team_id`, `result`, `venue_id`) VALUES
(23, '2024-05-20', 4, 5, 'Baridhara Wins', 1),
(24, '2024-05-21', 5, 4, 'Baridhara Wins', 2),
(25, '2024-05-22', 1, 5, 'Ashulia Wins', 3),
(26, '2024-05-23', 2, 4, 'Savar Wins', 1),
(27, '2024-05-18', 3, 2, 'Bashabo Wins', 3),
(28, '2024-05-31', 3, 5, 'Bashabo Wins', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Medical_Staff`
--

CREATE TABLE `Medical_Staff` (
  `staff_id` int(11) NOT NULL,
  `staff_name` varchar(100) NOT NULL,
  `specialization` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Player`
--

CREATE TABLE `Player` (
  `player_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `age` int(11) DEFAULT NULL CHECK (`age` > 12)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Player`
--

INSERT INTO `Player` (`player_id`, `first_name`, `middle_name`, `last_name`, `email`, `phone_number`, `nationality`, `dob`, `age`) VALUES
(26, 'Shakib', ' Al', 'Hasan', 'shakib@gmail.com  ', '123456789', 'Bangladeshi', '1987-03-05', 34),
(27, 'Tamim', 'Iqbal', 'Khan', 'tamim@gmail.com   ', '987654321', 'Bangladeshi', '1989-03-20', 35),
(28, 'Liton ', 'Kumar', 'Das', 'das@gmail.com     ', '778899001', 'Bangladeshi', '1993-02-25', 29),
(30, 'Mashrafee', 'Bin', 'Mortaza', 'mash@gmail.com ', '1770589276', 'Bangladeshi', '1983-10-05', 40),
(34, 'Sadia', 'Afrin', 'Apu', 'sadia.afrin@northsouth.edu', '01987533', 'Bangladeshi', '1995-04-04', 28);

-- --------------------------------------------------------

--
-- Table structure for table `Player_Education`
--

CREATE TABLE `Player_Education` (
  `player_id` int(11) NOT NULL,
  `degree` varchar(100) NOT NULL,
  `institution` varchar(200) NOT NULL,
  `passing_year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Player_Education`
--

INSERT INTO `Player_Education` (`player_id`, `degree`, `institution`, `passing_year`) VALUES
(26, 'BBA', 'Dhaka University', 2009),
(27, 'BBA', 'Dhaka University', 2011),
(28, 'CSE', 'National University', 2016),
(30, 'EEE', 'BRAC University', 2005),
(34, 'Bachelor of Science', 'North South University', 2021);

-- --------------------------------------------------------

--
-- Table structure for table `Player_Login`
--

CREATE TABLE `Player_Login` (
  `login_id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `usertype` varchar(50) NOT NULL DEFAULT 'player',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Player_Login`
--

INSERT INTO `Player_Login` (`login_id`, `player_id`, `username`, `password`, `usertype`, `created_at`) VALUES
(8, 26, 'shakib', '12345', 'player', '2024-05-26 10:26:12'),
(9, 27, 'tamim', 'tamim123', 'player', '2024-05-26 18:12:49'),
(10, 28, 'das', 'das123', 'player', '2024-05-26 18:22:31'),
(12, 30, 'mash', 'mash123', 'player', '2024-05-29 23:19:16'),
(16, 34, 'sadia123', '4a2295303f30f1236a1f2dc21debbdd7d239b69d07be3dc078ed5c3821b6d4d0', 'player', '2024-05-30 02:53:24');

-- --------------------------------------------------------

--
-- Table structure for table `Player_Training`
--

CREATE TABLE `Player_Training` (
  `player_id` int(11) NOT NULL,
  `academy` varchar(200) NOT NULL,
  `specialization` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Player_Training`
--

INSERT INTO `Player_Training` (`player_id`, `academy`, `specialization`) VALUES
(26, 'BCB Academy', 'All-rounder'),
(27, 'BCB Academy', 'Batsman'),
(28, 'BKSP', 'Batsman'),
(30, 'BKSP', 'Bowler'),
(34, 'BKSP', 'All-rounder');

-- --------------------------------------------------------

--
-- Table structure for table `Registration`
--

CREATE TABLE `Registration` (
  `registration_id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Registration`
--

INSERT INTO `Registration` (`registration_id`, `player_id`, `registration_date`) VALUES
(10020, 26, '2024-05-26 10:26:12'),
(10021, 27, '2024-05-26 18:12:49'),
(10022, 28, '2024-05-26 18:22:31'),
(10024, 30, '2024-05-29 23:19:16'),
(10028, 34, '2024-05-30 02:53:24');

-- --------------------------------------------------------

--
-- Table structure for table `Scorer`
--

CREATE TABLE `Scorer` (
  `scorer_id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `runs` int(11) DEFAULT 0,
  `wickets` int(11) DEFAULT 0,
  `catches` int(11) DEFAULT 0,
  `match_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Scorer`
--

INSERT INTO `Scorer` (`scorer_id`, `player_id`, `runs`, `wickets`, `catches`, `match_id`) VALUES
(2, 26, 105, 4, 2, 25),
(3, 27, 68, 1, 1, 24),
(6, 28, 59, 3, 2, 26),
(7, 30, 20, 6, 1, 28);

-- --------------------------------------------------------

--
-- Table structure for table `Social_Media`
--

CREATE TABLE `Social_Media` (
  `account_id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `platform` varchar(50) NOT NULL,
  `followers` int(11) DEFAULT 0,
  `content` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Sponsors`
--

CREATE TABLE `Sponsors` (
  `sponsor_id` int(11) NOT NULL,
  `sponsor_name` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Team`
--

CREATE TABLE `Team` (
  `team_id` int(11) NOT NULL,
  `team_name` varchar(50) NOT NULL,
  `club_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Team`
--

INSERT INTO `Team` (`team_id`, `team_name`, `club_id`) VALUES
(1, 'Ashulia Team', 3),
(2, 'Savar Team', 3),
(3, 'Bashabo Team', 5),
(4, 'Baridhara Team', 5),
(5, 'Malibag Team', 4);

-- --------------------------------------------------------

--
-- Table structure for table `Tournaments`
--

CREATE TABLE `Tournaments` (
  `tournament_id` int(11) NOT NULL,
  `tournament_name` varchar(200) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Venue`
--

CREATE TABLE `Venue` (
  `venue_id` int(11) NOT NULL,
  `venue_name` varchar(200) NOT NULL,
  `location` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Venue`
--

INSERT INTO `Venue` (`venue_id`, `venue_name`, `location`) VALUES
(1, 'Mirpur', 'Dhaka'),
(2, 'MCG', 'Australia'),
(3, 'Lords', 'England');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Award`
--
ALTER TABLE `Award`
  ADD PRIMARY KEY (`award_id`),
  ADD KEY `player_id` (`player_id`),
  ADD KEY `award` (`match_id`);

--
-- Indexes for table `Awards`
--
ALTER TABLE `Awards`
  ADD PRIMARY KEY (`award_id`),
  ADD KEY `player_id` (`player_id`),
  ADD KEY `match_id` (`match_id`);

--
-- Indexes for table `Captaincy`
--
ALTER TABLE `Captaincy`
  ADD PRIMARY KEY (`captain_id`,`player_id`,`team_id`,`start_date`),
  ADD KEY `team_id` (`team_id`),
  ADD KEY `player_id` (`player_id`);

--
-- Indexes for table `Club`
--
ALTER TABLE `Club`
  ADD PRIMARY KEY (`club_id`);

--
-- Indexes for table `Coaches`
--
ALTER TABLE `Coaches`
  ADD PRIMARY KEY (`coach_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `Contracts`
--
ALTER TABLE `Contracts`
  ADD PRIMARY KEY (`contract_id`),
  ADD KEY `player_id` (`player_id`),
  ADD KEY `fk_constraint_name` (`club_id`),
  ADD KEY `fk_constraint_name2` (`team_id`);

--
-- Indexes for table `Enrols`
--
ALTER TABLE `Enrols`
  ADD PRIMARY KEY (`player_id`,`club_id`,`start_date`),
  ADD KEY `club_id` (`club_id`);

--
-- Indexes for table `Injuries`
--
ALTER TABLE `Injuries`
  ADD PRIMARY KEY (`injury_id`);

--
-- Indexes for table `Installment`
--
ALTER TABLE `Installment`
  ADD PRIMARY KEY (`installment_id`),
  ADD KEY `new_foreign_key_name` (`contract_id`);

--
-- Indexes for table `Joins`
--
ALTER TABLE `Joins`
  ADD PRIMARY KEY (`player_id`,`team_id`,`start_date`),
  ADD KEY `team_id` (`team_id`);

--
-- Indexes for table `Login`
--
ALTER TABLE `Login`
  ADD PRIMARY KEY (`login_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `Matches`
--
ALTER TABLE `Matches`
  ADD PRIMARY KEY (`match_id`),
  ADD KEY `venue_id` (`venue_id`),
  ADD KEY `home_team_id` (`home_team_id`),
  ADD KEY `away_team_id` (`away_team_id`);

--
-- Indexes for table `Medical_Staff`
--
ALTER TABLE `Medical_Staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `Player`
--
ALTER TABLE `Player`
  ADD PRIMARY KEY (`player_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone_number` (`phone_number`);

--
-- Indexes for table `Player_Education`
--
ALTER TABLE `Player_Education`
  ADD PRIMARY KEY (`player_id`,`degree`,`institution`,`passing_year`);

--
-- Indexes for table `Player_Login`
--
ALTER TABLE `Player_Login`
  ADD PRIMARY KEY (`login_id`),
  ADD KEY `player_id` (`player_id`);

--
-- Indexes for table `Player_Training`
--
ALTER TABLE `Player_Training`
  ADD PRIMARY KEY (`player_id`,`academy`,`specialization`);

--
-- Indexes for table `Registration`
--
ALTER TABLE `Registration`
  ADD PRIMARY KEY (`registration_id`),
  ADD KEY `player_id` (`player_id`);

--
-- Indexes for table `Scorer`
--
ALTER TABLE `Scorer`
  ADD PRIMARY KEY (`scorer_id`),
  ADD KEY `player_id` (`player_id`),
  ADD KEY `match_id` (`match_id`);

--
-- Indexes for table `Social_Media`
--
ALTER TABLE `Social_Media`
  ADD PRIMARY KEY (`account_id`),
  ADD KEY `player_id` (`player_id`);

--
-- Indexes for table `Sponsors`
--
ALTER TABLE `Sponsors`
  ADD PRIMARY KEY (`sponsor_id`),
  ADD UNIQUE KEY `sponsor_name` (`sponsor_name`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone_number` (`phone_number`);

--
-- Indexes for table `Team`
--
ALTER TABLE `Team`
  ADD PRIMARY KEY (`team_id`),
  ADD KEY `fk_name` (`club_id`);

--
-- Indexes for table `Tournaments`
--
ALTER TABLE `Tournaments`
  ADD PRIMARY KEY (`tournament_id`),
  ADD UNIQUE KEY `tournament_name` (`tournament_name`);

--
-- Indexes for table `Venue`
--
ALTER TABLE `Venue`
  ADD PRIMARY KEY (`venue_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Award`
--
ALTER TABLE `Award`
  MODIFY `award_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Awards`
--
ALTER TABLE `Awards`
  MODIFY `award_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Club`
--
ALTER TABLE `Club`
  MODIFY `club_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Coaches`
--
ALTER TABLE `Coaches`
  MODIFY `coach_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Contracts`
--
ALTER TABLE `Contracts`
  MODIFY `contract_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `Injuries`
--
ALTER TABLE `Injuries`
  MODIFY `injury_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Installment`
--
ALTER TABLE `Installment`
  MODIFY `installment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `Login`
--
ALTER TABLE `Login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Matches`
--
ALTER TABLE `Matches`
  MODIFY `match_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `Medical_Staff`
--
ALTER TABLE `Medical_Staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Player`
--
ALTER TABLE `Player`
  MODIFY `player_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `Player_Login`
--
ALTER TABLE `Player_Login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `Registration`
--
ALTER TABLE `Registration`
  MODIFY `registration_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10029;

--
-- AUTO_INCREMENT for table `Scorer`
--
ALTER TABLE `Scorer`
  MODIFY `scorer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `Social_Media`
--
ALTER TABLE `Social_Media`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Sponsors`
--
ALTER TABLE `Sponsors`
  MODIFY `sponsor_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Team`
--
ALTER TABLE `Team`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Tournaments`
--
ALTER TABLE `Tournaments`
  MODIFY `tournament_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Venue`
--
ALTER TABLE `Venue`
  MODIFY `venue_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Award`
--
ALTER TABLE `Award`
  ADD CONSTRAINT `award` FOREIGN KEY (`match_id`) REFERENCES `Award` (`award_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `award_ibfk_1` FOREIGN KEY (`player_id`) REFERENCES `Player` (`player_id`) ON DELETE CASCADE;

--
-- Constraints for table `Awards`
--
ALTER TABLE `Awards`
  ADD CONSTRAINT `awards_ibfk_1` FOREIGN KEY (`player_id`) REFERENCES `Player` (`player_id`),
  ADD CONSTRAINT `awards_ibfk_2` FOREIGN KEY (`match_id`) REFERENCES `Matches` (`match_id`) ON DELETE CASCADE;

--
-- Constraints for table `Captaincy`
--
ALTER TABLE `Captaincy`
  ADD CONSTRAINT `captaincy_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `Team` (`team_id`),
  ADD CONSTRAINT `captaincy_ibfk_2` FOREIGN KEY (`player_id`) REFERENCES `Player` (`player_id`) ON DELETE CASCADE;

--
-- Constraints for table `Contracts`
--
ALTER TABLE `Contracts`
  ADD CONSTRAINT `contracts_ibfk_1` FOREIGN KEY (`player_id`) REFERENCES `Player` (`player_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_constraint_name` FOREIGN KEY (`club_id`) REFERENCES `Club` (`club_id`),
  ADD CONSTRAINT `fk_constraint_name2` FOREIGN KEY (`team_id`) REFERENCES `Team` (`team_id`);

--
-- Constraints for table `Enrols`
--
ALTER TABLE `Enrols`
  ADD CONSTRAINT `enrols_ibfk_1` FOREIGN KEY (`player_id`) REFERENCES `Player` (`player_id`),
  ADD CONSTRAINT `enrols_ibfk_2` FOREIGN KEY (`club_id`) REFERENCES `Club` (`club_id`) ON DELETE CASCADE;

--
-- Constraints for table `Installment`
--
ALTER TABLE `Installment`
  ADD CONSTRAINT `new_foreign_key_name` FOREIGN KEY (`contract_id`) REFERENCES `Contracts` (`contract_id`) ON DELETE CASCADE;

--
-- Constraints for table `Joins`
--
ALTER TABLE `Joins`
  ADD CONSTRAINT `joins_ibfk_1` FOREIGN KEY (`player_id`) REFERENCES `Player` (`player_id`),
  ADD CONSTRAINT `joins_ibfk_2` FOREIGN KEY (`team_id`) REFERENCES `Team` (`team_id`) ON DELETE CASCADE;

--
-- Constraints for table `Matches`
--
ALTER TABLE `Matches`
  ADD CONSTRAINT `matches_ibfk_1` FOREIGN KEY (`venue_id`) REFERENCES `Venue` (`venue_id`),
  ADD CONSTRAINT `matches_ibfk_2` FOREIGN KEY (`home_team_id`) REFERENCES `Team` (`team_id`),
  ADD CONSTRAINT `matches_ibfk_3` FOREIGN KEY (`away_team_id`) REFERENCES `Team` (`team_id`) ON DELETE CASCADE;

--
-- Constraints for table `Player_Education`
--
ALTER TABLE `Player_Education`
  ADD CONSTRAINT `player_education_ibfk_1` FOREIGN KEY (`player_id`) REFERENCES `Player` (`player_id`) ON DELETE CASCADE;

--
-- Constraints for table `Player_Login`
--
ALTER TABLE `Player_Login`
  ADD CONSTRAINT `player_login_ibfk_1` FOREIGN KEY (`player_id`) REFERENCES `Player` (`player_id`) ON DELETE CASCADE;

--
-- Constraints for table `Player_Training`
--
ALTER TABLE `Player_Training`
  ADD CONSTRAINT `player_training_ibfk_1` FOREIGN KEY (`player_id`) REFERENCES `Player` (`player_id`) ON DELETE CASCADE;

--
-- Constraints for table `Registration`
--
ALTER TABLE `Registration`
  ADD CONSTRAINT `registration_ibfk_1` FOREIGN KEY (`player_id`) REFERENCES `Player` (`player_id`) ON DELETE CASCADE;

--
-- Constraints for table `Scorer`
--
ALTER TABLE `Scorer`
  ADD CONSTRAINT `match_id` FOREIGN KEY (`match_id`) REFERENCES `Matches` (`match_id`),
  ADD CONSTRAINT `scorer_ibfk_1` FOREIGN KEY (`player_id`) REFERENCES `Player` (`player_id`) ON DELETE CASCADE;

--
-- Constraints for table `Social_Media`
--
ALTER TABLE `Social_Media`
  ADD CONSTRAINT `social_media_ibfk_1` FOREIGN KEY (`player_id`) REFERENCES `Player` (`player_id`) ON DELETE CASCADE;

--
-- Constraints for table `Team`
--
ALTER TABLE `Team`
  ADD CONSTRAINT `fk_name` FOREIGN KEY (`club_id`) REFERENCES `Club` (`club_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
