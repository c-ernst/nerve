-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2017 at 12:58 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nerve`
--

-- --------------------------------------------------------

--
-- Table structure for table `challenge`
--

CREATE TABLE `challenge` (
  `id` int(8) NOT NULL,
  `id_player` int(8) NOT NULL,
  `id_watcher` int(8) NOT NULL,
  `duration` int(6) NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 NOT NULL,
  `flag` int(8) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `accepted` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `completed` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `confirmation` varchar(128) CHARACTER SET utf8 NOT NULL,
  `value` int(8) NOT NULL,
  `id_sponsor` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `challenge`
--

INSERT INTO `challenge` (`id`, `id_player`, `id_watcher`, `duration`, `description`, `flag`, `created`, `accepted`, `completed`, `confirmation`, `value`, `id_sponsor`) VALUES
(7, 2, 5, 10, 'Iss einen L?ffel Zimt', 3100, '2017-06-20 09:54:20', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, 0),
(8, 2, 4, 180, 'Streichel Hess\' Bauch', 3100, '2017-06-20 09:54:20', '2017-06-20 10:00:00', '0000-00-00 00:00:00', '', 0, 0),
(9, 5, 2, 100, 'Kauf dir ein Auto', 3100, '2017-06-20 09:54:20', '2017-06-20 18:00:00', '0000-00-00 00:00:00', '', 0, 0),
(11, 2, 5, 20, 'Verbrenn deinen Hund', 3100, '2017-06-20 09:54:20', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, 0),
(12, 2, 2, 600, 'Leck deinen Ellbogen', 3100, '2017-06-20 10:49:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0, 0),
(16, 2, 2, 5, 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam', 3100, '2017-06-20 16:28:11', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 25, 0),
(17, 2, 2, 120, 'Bau ein Haus', 3100, '2017-06-20 18:05:41', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 15, 0),
(18, 2, 4, 10, 'Iss eine Chilischote', 3100, '2017-06-20 18:51:27', '2017-06-20 19:00:00', '0000-00-00 00:00:00', '', 60, 0),
(19, 2, 4, 100, 'Schau auf die Uhr', 3100, '2017-06-20 19:22:20', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 10, 0),
(20, 5, 4, 600, 'Lutsch mir die Dinger', 3100, '2017-06-20 19:27:55', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 10, 0),
(21, 12, 5, 40, 'Kraule Schönbergers Haare', 3100, '2017-06-20 19:33:45', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 15, 0),
(22, 5, 4, 120, 'Bau eine Sandburg', 3100, '2017-06-24 23:10:43', '2017-06-25 00:22:44', '2017-06-25 01:39:04', 'youtube.com/test', 10, 0),
(23, 5, 4, 5, 'Gib Carsten einen Zungenkuss', 3100, '2017-06-24 23:44:20', '2017-06-25 01:30:03', '0000-00-00 00:00:00', '', 25, 0),
(24, 5, 4, 5, 'Trink einen Liter Milch in 5 Minuten', 3100, '2017-06-25 01:49:55', '2017-06-25 01:50:02', '2017-06-25 01:51:10', 'Test', 15, 0),
(25, 5, 4, 1, 'Test', 3100, '2017-06-25 02:29:41', '2017-06-25 02:29:46', '2017-06-25 02:29:53', 'confirmed', 105, 0),
(26, 12, 4, 10, 'Hau Markus eine rein', 3100, '2017-06-25 02:31:41', '2017-06-25 02:31:53', '2017-06-25 02:31:55', '', 1005, 0),
(27, 12, 4, 10, 'Trink 250ml Milch durch die Nase', 2000, '2017-06-25 03:28:50', '2017-06-25 04:14:38', '0000-00-00 00:00:00', '', 15, 0),
(30, 5, 2, 180, 'Gib mir 100 Token', 2000, '2017-06-25 04:59:15', '2017-06-25 05:23:04', '0000-00-00 00:00:00', '', 105, 0),
(31, 14, 4, 180, 'Reg dich nicht auf', 1500, '2017-06-25 05:02:53', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 500, 0),
(32, 5, 2, 300, 'Reg mich nicht auf', 1000, '2017-06-25 05:42:34', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 15, 0);

-- --------------------------------------------------------

--
-- Table structure for table `challenge_votes`
--

CREATE TABLE `challenge_votes` (
  `id` int(11) NOT NULL,
  `id_challenge` int(11) NOT NULL,
  `id_member` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `challenge_votes`
--

INSERT INTO `challenge_votes` (`id`, `id_challenge`, `id_member`) VALUES
(18, 30, 4),
(19, 31, 4);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int(8) NOT NULL,
  `username` varchar(48) NOT NULL,
  `promo` varchar(48) NOT NULL,
  `vname` varchar(48) NOT NULL,
  `nname` varchar(48) NOT NULL,
  `email` varchar(48) NOT NULL,
  `fb` varchar(48) DEFAULT NULL,
  `street` varchar(48) CHARACTER SET utf8 NOT NULL,
  `streetnr` varchar(48) NOT NULL,
  `postcode` varchar(48) NOT NULL,
  `country` varchar(48) NOT NULL,
  `paypal` varchar(48) NOT NULL,
  `type` int(8) NOT NULL,
  `token` int(10) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `username`, `promo`, `vname`, `nname`, `email`, `fb`, `street`, `streetnr`, `postcode`, `country`, `paypal`, `type`, `token`, `password`) VALUES
(2, 'cher', 'http://www.youtube.com/krassertyp', 'Christoph', 'Ernst', 'cher0006@stud.hs-kl.de', NULL, 'Fröhnstrasse', '13', '669534', 'Deutschland', 'no-money@gmx.de', 2338, 4880, '$2y$10$cNba726/UyPM6KrrSkKwweI4Z.aBvEwOQZ49voGabz8YKA0toDZJW'),
(4, 'moha', 'Nein!', 'Moritz', 'Hauk', 'moha@hs-kl.de', NULL, 'Musterstrasse', '123', '12345', 'Germany', '', 1001, 0, '$2y$10$uM.6Sa4agdhnotyNeDqefuOloA3h4dbPWyFkzPexraT9fu4P53ryu'),
(5, 'mame', 'http://www.youtube.com/katzenvideos', 'Markus', 'Merker', 'mame@hs-kl.de', NULL, 'Geilostrasse', '69', '696969', 'Deutschland', '', 1337, NULL, '$2y$10$DPtjXFwFbsy411pvS38NJe7z45iUv0j2QIS.ghwzRvzNfR7DEcdFC'),
(12, 'alfr', 'http://www.youtube.com/kleinundsuess', 'Alena', 'Fries', 'alfr@hs-kl.de', NULL, 'Musterstrasse', '123', '12345', 'Deutschland', 'alfr@paypal.com', 1337, NULL, '$2y$10$Do32NYzvOZFi01Q6kSt4k..CgqmwYyk90hy.bhxjuJqSHliq5z4Fe'),
(13, 'caki', '', '', '', 'caki@hs-kl.de', NULL, '', '', '', '', '', 1337, NULL, '$2y$10$z3WlpetD1wViHvQ78830JOOIFximgDR/ABZc8ij670.t.kcD89MYG'),
(14, 'chdu', '', '', '', 'chdu@hs-kl.de', NULL, '', '', '', '', '', 1337, NULL, '$2y$10$vA3vByUxKSsLRhN8szB9Vej47BYkSGIwxy5bP0IL8oueHC6o8he9C');

-- --------------------------------------------------------

--
-- Table structure for table `sponsor`
--

CREATE TABLE `sponsor` (
  `id` int(8) NOT NULL,
  `name` varchar(48) NOT NULL,
  `email` varchar(48) NOT NULL,
  `fb` varchar(48) NOT NULL,
  `street` varchar(48) NOT NULL,
  `streetnr` varchar(48) NOT NULL,
  `postcode` varchar(48) NOT NULL,
  `country` varchar(48) NOT NULL,
  `paypal` varchar(48) NOT NULL,
  `first_place` varchar(48) CHARACTER SET utf8 NOT NULL,
  `second_place` varchar(48) CHARACTER SET utf8 NOT NULL,
  `third_place` varchar(48) CHARACTER SET utf8 NOT NULL,
  `start` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `logo_url` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sponsor`
--

INSERT INTO `sponsor` (`id`, `name`, `email`, `fb`, `street`, `streetnr`, `postcode`, `country`, `paypal`, `first_place`, `second_place`, `third_place`, `start`, `end`, `logo_url`) VALUES
(3, 'Pepsi', 'office@pepsi.com', 'facebook.com/pepsi', 'Pepsistrasse', '1337', '12345', 'Deutschland', 'money@pepsi.com', 'Einen Jahresvorrat Pepsi', '€ 300', '€ 200', '2017-06-25 00:39:26', '2017-06-30 00:34:15', 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e9/Pepsi_logo_2008.svg/1280px-Pepsi_logo_2008.svg.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `challenge`
--
ALTER TABLE `challenge`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `challenge_votes`
--
ALTER TABLE `challenge_votes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sponsor`
--
ALTER TABLE `sponsor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `challenge`
--
ALTER TABLE `challenge`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `challenge_votes`
--
ALTER TABLE `challenge_votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `sponsor`
--
ALTER TABLE `sponsor`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
