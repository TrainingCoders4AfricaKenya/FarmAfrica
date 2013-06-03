-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 03, 2013 at 10:38 PM
-- Server version: 5.5.31
-- PHP Version: 5.3.10-1ubuntu3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `farmAfricaNotification`
--

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `notificationID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `notificationType` varchar(30) NOT NULL,
  `status` int(11) unsigned NOT NULL,
  `dateCreated` datetime NOT NULL,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modifiedBy` int(11) unsigned NOT NULL,
  PRIMARY KEY (`notificationID`),
  UNIQUE KEY `categoryName` (`notificationType`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sms`
--

CREATE TABLE IF NOT EXISTS `sms` (
  `smsID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `senderNo` varchar(50) NOT NULL,
  `receiverNo` varchar(50) NOT NULL,
  `message` varchar(100) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `modifiedBy` int(11) unsigned NOT NULL,
  PRIMARY KEY (`smsID`),
  UNIQUE KEY `senderNo` (`senderNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
