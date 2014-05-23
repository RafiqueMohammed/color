-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 23, 2014 at 01:41 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `color_prediction`
--
CREATE DATABASE IF NOT EXISTS `color_prediction` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `color_prediction`;

-- --------------------------------------------------------

--
-- Table structure for table `color_code`
--

CREATE TABLE IF NOT EXISTS `color_code` (
  `color_id` int(11) NOT NULL AUTO_INCREMENT,
  `code_name` varchar(50) NOT NULL,
  `hex_code` varchar(7) NOT NULL,
  `primary_color` varchar(50) NOT NULL,
  PRIMARY KEY (`color_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='color information table' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `color_code`
--

INSERT INTO `color_code` (`color_id`, `code_name`, `hex_code`, `primary_color`) VALUES
(1, 'RED', '#FF0000', 'Red'),
(2, 'GREEN', '#00FF00', 'Green');

-- --------------------------------------------------------

--
-- Table structure for table `predictions`
--

CREATE TABLE IF NOT EXISTS `predictions` (
  `prediction_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Unique Identifier',
  `p-day` int(2) NOT NULL COMMENT 'Day of Prediction ',
  `p-month` int(2) NOT NULL COMMENT 'Month of Prediction ',
  `p-year` int(2) NOT NULL COMMENT 'Year of Prediction ',
  `p-date` date NOT NULL COMMENT 'Full date of Prediction ',
  `b-day` int(2) NOT NULL COMMENT 'Day of Birthday',
  `b-month` int(11) NOT NULL COMMENT 'Month of Birthday',
  `b-year` int(11) NOT NULL COMMENT 'Year of Birthday',
  `b-date` date NOT NULL COMMENT 'Full Birthday',
  `p-for` enum('F','H','R') NOT NULL COMMENT 'Prediction For',
  `color-code` int(11) NOT NULL COMMENT 'fk_id to master color table',
  PRIMARY KEY (`prediction_id`),
  KEY `color-code` (`color-code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Main Table of Color Predictions' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `predictions`
--

INSERT INTO `predictions` (`prediction_id`, `p-day`, `p-month`, `p-year`, `p-date`, `b-day`, `b-month`, `b-year`, `b-date`, `p-for`, `color-code`) VALUES
(1, 23, 5, 2014, '2014-05-23', 28, 4, 1970, '2014-05-01', 'R', 2),
(2, 23, 5, 2014, '2014-05-23', 28, 4, 1970, '2014-05-01', 'F', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `predictions`
--
ALTER TABLE `predictions`
  ADD CONSTRAINT `fk_color_code` FOREIGN KEY (`color-code`) REFERENCES `color_code` (`color_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
