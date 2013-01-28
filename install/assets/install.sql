-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 25, 2013 at 12:46 PM
-- Server version: 5.5.29
-- PHP Version: 5.3.10-1ubuntu3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `arrownet`
--
DROP DATABASE `arrownet`;
CREATE DATABASE `arrownet` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `arrownet`;

-- --------------------------------------------------------

--
-- Table structure for table `senregister_needs`
--

DROP TABLE IF EXISTS `senregister_needs`;
CREATE TABLE IF NOT EXISTS `senregister_needs` (
  `Need` varchar(15) NOT NULL,
  `Description` longtext,
  `createdtime` datetime NOT NULL,
  `modifiedtime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `senregister_strategies`
--

DROP TABLE IF EXISTS `senregister_strategies`;
CREATE TABLE IF NOT EXISTS `senregister_strategies` (
  `need` varchar(15) NOT NULL,
  `strategy` varchar(245) NOT NULL,
  `createdtime` datetime NOT NULL,
  `modifiedtime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sims_attendance`
--

DROP TABLE IF EXISTS `sims_attendance`;
CREATE TABLE IF NOT EXISTS `sims_attendance` (
  `UPN` varchar(30) NOT NULL,
  `Mark` varchar(2) NOT NULL,
  `Mark date` date NOT NULL,
  `AM/PM` varchar(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sims_classes`
--

DROP TABLE IF EXISTS `sims_classes`;
CREATE TABLE IF NOT EXISTS `sims_classes` (
  `UPN` varchar(50) NOT NULL,
  `Class` varchar(20) NOT NULL DEFAULT '',
  `Teacher` varchar(145) DEFAULT NULL,
  `Subject` varchar(50) DEFAULT NULL,
  `Subject code` varchar(20) DEFAULT NULL,
  `Staff Code` varchar(3) DEFAULT NULL,
  `Period` varchar(10) NOT NULL DEFAULT '',
  `Day name` varchar(15) NOT NULL DEFAULT '',
  `Room` varchar(245) DEFAULT NULL,
  `Staff ID` varchar(11) DEFAULT NULL,
  `Short Name` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sims_senneeds`
--

DROP TABLE IF EXISTS `sims_senneeds`;
CREATE TABLE IF NOT EXISTS `sims_senneeds` (
  `UPN` varchar(50) NOT NULL,
  `SEN Status` varchar(145) DEFAULT NULL,
  `Need type` varchar(245) DEFAULT NULL,
  `Need type code` varchar(15) DEFAULT NULL,
  `Description` varchar(245) DEFAULT NULL,
  `Need ID` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sims_staff`
--

DROP TABLE IF EXISTS `sims_staff`;
CREATE TABLE IF NOT EXISTS `sims_staff` (
  `ai` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(10) NOT NULL,
  `Preferred Forename` varchar(145) NOT NULL,
  `Middle Name(s)` varchar(245) DEFAULT NULL,
  `Legal Surname` varchar(145) NOT NULL,
  `Gender` varchar(1) DEFAULT NULL,
  `Staff Code` varchar(4) DEFAULT NULL,
  `ID` int(11) DEFAULT NULL,
  `PN Preferred Surname` varchar(145) DEFAULT NULL,
  PRIMARY KEY (`ai`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=148 ;

-- --------------------------------------------------------

--
-- Table structure for table `system_timetable`
--

DROP TABLE IF EXISTS `system_timetable`;
CREATE TABLE IF NOT EXISTS `system_timetable` (
  `period` varchar(15) NOT NULL,
  `day` varchar(4) NOT NULL,
  `starttime` time NOT NULL,
  `endtime` time NOT NULL,
  PRIMARY KEY (`period`),
  KEY `period` (`period`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `system_users`
--

DROP TABLE IF EXISTS `system_users`;
CREATE TABLE IF NOT EXISTS `system_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(15) DEFAULT NULL,
  `first_name` varchar(32) NOT NULL,
  `middlename` varchar(145) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `recoverPassword` varchar(40) DEFAULT NULL,
  `NTLMAuth` varchar(245) DEFAULT NULL,
  `type` int(1) NOT NULL,
  `workemail` varchar(245) DEFAULT NULL,
  `homeemail` varchar(245) DEFAULT NULL,
  `simsid` varchar(50) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `created` date NOT NULL,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4621 ;

-- --------------------------------------------------------

--
-- Table structure for table `system_users_old`
--

DROP TABLE IF EXISTS `system_users_old`;
CREATE TABLE IF NOT EXISTS `system_users_old` (
  `upn` varchar(45) NOT NULL,
  `username` varchar(145) DEFAULT NULL,
  `forename` varchar(145) DEFAULT NULL,
  `middlename` varchar(145) DEFAULT NULL,
  `surname` varchar(145) DEFAULT NULL,
  `house` varchar(25) DEFAULT NULL,
  `year` int(4) DEFAULT NULL,
  `simsyearofentry` int(4) DEFAULT NULL,
  `network` varchar(15) DEFAULT NULL,
  `type` varchar(15) DEFAULT 'student',
  `title` varchar(15) NOT NULL,
  `email` varchar(245) DEFAULT NULL,
  `sex` varchar(1) DEFAULT NULL,
  `staffcode` varchar(3) DEFAULT NULL,
  `staffsimsid` int(10) DEFAULT NULL,
  `workemail` varchar(145) DEFAULT NULL,
  `homeemail` varchar(145) DEFAULT NULL,
  `SimsID` int(10) DEFAULT NULL,
  `sentAccess` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`upn`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `system_usertypes`
--

DROP TABLE IF EXISTS `system_usertypes`;
CREATE TABLE IF NOT EXISTS `system_usertypes` (
  `utid` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(15) NOT NULL,
  `authtype` varchar(15) NOT NULL,
  `createdtime` datetime NOT NULL,
  `modifiedtime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`utid`),
  KEY `utid` (`utid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
