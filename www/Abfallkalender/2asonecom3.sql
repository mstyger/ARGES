-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- Host: mysql.2asone.com
-- Generation Time: Dec 01, 2013 at 06:22 PM
-- Server version: 5.0.84-log
-- PHP Version: 5.2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `2asonecom3`
--

-- --------------------------------------------------------

--
-- Table structure for table `abfalllocation`
--

CREATE TABLE IF NOT EXISTS `abfalllocation` (
  `location_id` int(5) NOT NULL auto_increment,
  `place_id` int(5) NOT NULL,
  `type_id` int(5) NOT NULL,
  `street` varchar(255) collate latin1_german1_ci NOT NULL,
  `streetnumber` int(5) NOT NULL,
  `descriptionver` varchar(255) collate latin1_german1_ci NOT NULL,
  `openingtime` varchar(255) collate latin1_german1_ci NOT NULL,
  PRIMARY KEY  (`location_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `abfalllocation`
--

INSERT INTO `abfalllocation` (`location_id`, `place_id`, `type_id`, `street`, `streetnumber`, `descriptionver`, `openingtime`) VALUES
(1, 27, 1, 'Hauptstrasse', 26, 'Dump here anytime', '08:00 - 17:00'),
(2, 35, 6, 'Schweizerweg', 4, 'You have to pay', '07:15 - 21:00'),
(3, 4, 7, 'Bernstrasse', 14, 'Only oak', '12:00 - 14:00');

-- --------------------------------------------------------

--
-- Table structure for table `abfalltype`
--

CREATE TABLE IF NOT EXISTS `abfalltype` (
  `type_id` int(5) NOT NULL auto_increment,
  `abfalltype` varchar(255) collate latin1_german1_ci NOT NULL,
  `description` varchar(255) collate latin1_german1_ci NOT NULL,
  PRIMARY KEY  (`type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `abfalltype`
--

INSERT INTO `abfalltype` (`type_id`, `abfalltype`, `description`) VALUES
(1, 'Glass', 'Some description'),
(2, 'String', 'Something'),
(7, 'Wood', 'gfgdrfgdfgd'),
(6, 'water', 'Stuff');

-- --------------------------------------------------------

--
-- Table structure for table `place`
--

CREATE TABLE IF NOT EXISTS `place` (
  `place_id` int(5) NOT NULL auto_increment,
  `place_name` varchar(255) collate latin1_german1_ci NOT NULL,
  `plz` varchar(10) collate latin1_german1_ci NOT NULL,
  PRIMARY KEY  (`place_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci AUTO_INCREMENT=36 ;

--
-- Dumping data for table `place`
--

INSERT INTO `place` (`place_id`, `place_name`, `plz`) VALUES
(27, 'Pfaeffikon', '8088'),
(4, 'Rumlang', '8135'),
(35, 'Berlin', '8000'),
(34, 'Zurich', '1000');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
