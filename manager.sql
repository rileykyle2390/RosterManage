-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2020 at 02:40 AM
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
-- Database: `manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `coach`
--

CREATE TABLE `coach` (
  `last_name` varchar(20) NOT NULL,
  `teamID` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coach`
--

INSERT INTO `coach` (`last_name`, `teamID`, `first_name`) VALUES
('Kingsbury', 2, 'Kliff'),
('Taylor', 1, 'Zac');

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `managerID` int(11) NOT NULL,
  `teamID` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`managerID`, `teamID`, `first_name`, `last_name`) VALUES
(1, 1, 'Mike', 'Brown'),
(2, 2, 'Steve', 'Keim');

-- --------------------------------------------------------

--
-- Table structure for table `player`
--

CREATE TABLE `player` (
  `playerID` int(10) UNSIGNED NOT NULL,
  `number` int(10) UNSIGNED NOT NULL,
  `teamID` int(10) UNSIGNED NOT NULL,
  `age` int(10) UNSIGNED NOT NULL,
  `experience` int(10) UNSIGNED NOT NULL,
  `college` varchar(30) CHARACTER SET utf8 NOT NULL,
  `height` varchar(5) CHARACTER SET utf8 NOT NULL,
  `weight` int(10) UNSIGNED NOT NULL,
  `position` varchar(4) CHARACTER SET utf8 NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `picture` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `player`
--

INSERT INTO `player` (`playerID`, `number`, `teamID`, `age`, `experience`, `college`, `height`, `weight`, `position`, `first_name`, `last_name`, `picture`) VALUES
(1, 4, 1, 30, 8, 'Texas A&M', '5-9', 210, 'K', 'Randy', 'Bullock', 'https://static.clubs.nfl.com/image/private/t_thumb_squared_2x/f_auto/bengals/mlq9cacnwys3jyr29pyc.jpg'),
(2, 14, 1, 32, 9, 'Texas Christian', '6-2', 220, 'QB', 'Andy', 'Dalton', 'https://static.clubs.nfl.com/image/private/t_thumb_squared_2x/f_auto/bengals/evzci5wn5ytzjjxc23tl.jpg'),
(3, 18, 1, 31, 9, 'Georgia', '6-4', 210, 'WR', 'A.J.', 'Green', 'https://static.clubs.nfl.com/image/private/t_thumb_squared_2x/f_auto/bengals/ouuz0wumam8froyuxv2d.jpg'),
(4, 25, 1, 28, 7, 'North Carolina', '5-9', 205, 'HB', 'Giovanni', 'Bernard', 'https://static.clubs.nfl.com/image/private/t_thumb_squared_2x/f_auto/bengals/gh1fmzovrod6suib3rul.jpg'),
(5, 27, 1, 30, 8, 'Alabama', '6-2', 190, 'CB', 'Dre', 'Kirkpatrick', 'https://static.clubs.nfl.com/image/private/t_thumb_squared_2x/f_auto/bengals/qlfuys6o36ztraxqpgrg.jpg'),
(6, 28, 1, 23, 3, 'Oklahoma', '6-1', 220, 'HB', 'Joe', 'Mixon', 'https://static.clubs.nfl.com/image/private/t_thumb_squared_2x/f_auto/bengals/fcwse1oumaizk6uqnztc.jpg'),
(7, 30, 1, 22, 2, 'Wake Forest', '6-1', 200, 'S', 'Jessie', 'Bates III', 'https://static.clubs.nfl.com/image/private/t_thumb_squared_2x/f_auto/bengals/iwfegboegy8w0kovcv3b.jpg'),
(8, 32, 2, 24, 4, 'Washington', '5-10', 195, 'S', 'Budda', 'Baker', 'https://static.clubs.nfl.com/image/private/t_editorial_landscape_6_desktop/f_auto/cardinals/qnezmuegqsa1lbvldate.jpg'),
(9, 83, 1, 25, 4, 'Pittsburgh', '6-2', 203, 'WR', 'Tyler', 'Boyd', 'https://static.clubs.nfl.com/image/private/t_thumb_squared_2x/f_auto/bengals/twx0xw8bftxsqbu94ano.jpg'),
(10, 96, 1, 30, 10, 'Florida', '6-6', 285, 'DE', 'Carlos', 'Dunlap', 'https://static.clubs.nfl.com/image/private/t_thumb_squared_2x/f_auto/bengals/mxhk9fcuyena3pqjqdss.jpg'),
(11, 97, 1, 31, 11, 'Georgia', '6-1', 300, 'DT', 'Geno', 'Atkins', 'https://static.clubs.nfl.com/image/private/t_thumb_squared_2x/f_auto/bengals/dgsnj9f7wn6q1xhjpycm.jpg'),
(12, 18, 2, 23, 2, 'Iowa State', '6-5', 227, 'WR', 'Hakeem', 'Butler', 'https://static.clubs.nfl.com/image/private/t_editorial_landscape_6_desktop/f_auto/cardinals/ah0llwpqztnafsqkgge8.jpg'),
(13, 41, 2, 26, 5, 'Alabama', '6-1', 211, 'RB', 'Kenyan', 'Drake', 'https://static.clubs.nfl.com/image/private/t_editorial_landscape_6_desktop/f_auto/cardinals/hbnvarrtsrxfdmxq4hoi.jpg'),
(14, 5, 2, 25, 4, 'Arizona State', '6-0', 202, 'K', 'Zane', 'Gonzalez', 'https://static.clubs.nfl.com/image/private/t_editorial_landscape_6_desktop/f_auto/cardinals/pxcisc8rog3uvqjsotqg.jpg'),
(15, 10, 2, 27, 7, 'Clemson', '6-1', 212, 'WR', 'DeAndre', 'Hopkins', 'https://static.clubs.nfl.com/image/private/t_editorial_landscape_6_desktop/f_auto/cardinals/dnsq98i8mtwk9qdsneh0.jpg'),
(16, 13, 2, 23, 3, 'Texas A&M', '5-11', 200, 'WR', 'Christian', 'Kirk', 'https://static.clubs.nfl.com/image/private/t_editorial_landscape_6_desktop/f_auto/cardinals/wlvnuslsxujnijgw3rup.jpg'),
(17, 1, 2, 22, 2, 'Oklahoma', '5-10', 207, 'QB', 'Kyler', 'Murray', 'https://static.clubs.nfl.com/image/private/t_editorial_landscape_6_desktop/f_auto/cardinals/qcrq0eqmx9lsmqyjchiv.jpg'),
(18, 94, 2, 22, 2, 'Boston College', '6-4', 281, 'DE', 'Zach', 'Allen', 'https://static.clubs.nfl.com/image/private/t_editorial_landscape_6_desktop/f_auto/cardinals/fq7a0ociisnm6dl8lesn.jpg'),
(19, 3, 2, 24, 1, 'Murray State', '6-4', 221, 'QB', 'Drew', 'Anderson', 'https://static.clubs.nfl.com/image/private/t_editorial_landscape_6_desktop/f_auto/cardinals/pgm3m7txotmcvzjaweha.jpg'),
(20, 82, 2, 25, 4, 'Wis.-Platteville', '6-6', 220, 'TE', 'Dan', 'Arnold', 'https://static.clubs.nfl.com/image/private/t_editorial_landscape_6_desktop/f_auto/cardinals/mzpzhfykfgqfzsmyt5kd.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `player_user_fans`
--

CREATE TABLE `player_user_fans` (
  `likeID` int(11) NOT NULL,
  `playerID` int(10) UNSIGNED NOT NULL,
  `userID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `teamID` int(10) UNSIGNED NOT NULL,
  `location` varchar(40) NOT NULL,
  `name` varchar(30) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`teamID`, `location`, `name`) VALUES
(1, 'Cincinnati', 'Bengals'),
(2, 'Arizona', 'Cardinals');

-- --------------------------------------------------------

--
-- Table structure for table `trades`
--

CREATE TABLE `trades` (
  `tradeID` int(11) NOT NULL,
  `teamIDIn` int(11) NOT NULL,
  `teamIDOut` int(11) NOT NULL,
  `playerIDIn` int(11) NOT NULL,
  `playerIDOut` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(10) UNSIGNED NOT NULL,
  `teamID` int(10) UNSIGNED DEFAULT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(10) NOT NULL,
  `first_name` varchar(40) NOT NULL,
  `last_name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `teamID`, `email`, `password`, `role`, `first_name`, `last_name`) VALUES
(1, NULL, 'coeseier@gmail.com', '$2y$10$30YcvjBX7l6hOfx43Hq8VeotZk6V/09IE.w73TNxxVRQCeCaobJTK', 'user', 'User', 'Esmeier'),
(2, 1, 'brown@bengals.com', '$2y$10$1FzOB.hnoj37XEQ36AD3QeAbGsmviNoa9iraFMMBV8qMrD7W.GUkm', 'gm', 'Mike', 'Brown'),
(3, 2, 'kliff@cardinals.com', '$2y$10$ShzTSZsK3MizKorFoEr2ve0WYeoDg1UmBiI987nkwRrzcZzL4uzFG', 'hc', 'Kliff', 'Kingsbury'),
(4, 2, 'steve@cardinals.com', '$2y$10$lY1dil.LDj4VBCHUpvuqPOY6i.FPMMJkCIoGaGKziDVnRNe./MMd6', 'gm', 'Steve', 'Keim'),
(5, 1, 'taylor@bengals.com', '$2y$10$CTuzuMNqQIiXfWnL2KvWb.1sP53XpPGZM3Ron/i7exlBlwv1dz8HC', 'hc', 'Zac', 'Taylor'),
(6, NULL, 'esmeier@rostermanager.com', '$2y$10$oTsCJxv4pG633ieaG39eN.73Dwgk865AkYdusgpanHKsAVlhdc9we', 'su', 'Cody', 'Esm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coach`
--
ALTER TABLE `coach`
  ADD PRIMARY KEY (`last_name`),
  ADD KEY `teamID` (`teamID`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`managerID`),
  ADD KEY `teamID` (`teamID`);

--
-- Indexes for table `player`
--
ALTER TABLE `player`
  ADD PRIMARY KEY (`playerID`) USING BTREE,
  ADD KEY `teamID` (`teamID`);

--
-- Indexes for table `player_user_fans`
--
ALTER TABLE `player_user_fans`
  ADD PRIMARY KEY (`likeID`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`teamID`);

--
-- Indexes for table `trades`
--
ALTER TABLE `trades`
  ADD PRIMARY KEY (`tradeID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `managerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `player`
--
ALTER TABLE `player`
  MODIFY `playerID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `player_user_fans`
--
ALTER TABLE `player_user_fans`
  MODIFY `likeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `teamID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `trades`
--
ALTER TABLE `trades`
  MODIFY `tradeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `coach`
--
ALTER TABLE `coach`
  ADD CONSTRAINT `coach_ibfk_1` FOREIGN KEY (`teamID`) REFERENCES `team` (`teamID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `manager`
--
ALTER TABLE `manager`
  ADD CONSTRAINT `manager_ibfk_1` FOREIGN KEY (`teamID`) REFERENCES `team` (`teamID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `player`
--
ALTER TABLE `player`
  ADD CONSTRAINT `player_ibfk_1` FOREIGN KEY (`teamID`) REFERENCES `team` (`teamID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
