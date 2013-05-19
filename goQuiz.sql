-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 19, 2013 at 11:19 AM
-- Server version: 5.1.44
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `goQuizBase`
--
CREATE DATABASE `goQuizBase` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `goQuizBase`;

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `school` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `title` varchar(40) DEFAULT NULL,
  `forename` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `class` varchar(15) DEFAULT NULL,
  `year` int(4) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `type` int(1) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `Form` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `email`, `school`, `username`, `password`, `title`, `forename`, `surname`, `class`, `year`, `created`, `modified`, `type`, `ip_address`, `Form`) VALUES
(1, 'jhooton@arrowsmith.wigan.sch.uk', 'Admin', 'jmhooton', '92233c65e3908734b050ea32e14ade054ac7dfd1', 'Mr', 'Jonathan', 'Hooton', '', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '10.10.1.104', NULL),
(3, 'test', 'Testing', 'test', '576f2afcdca7238248dd1939e21d2bf0ee6432e8', 'Mr', 'Test', 'Test', 'test', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '127.0.0.1', 'test'),
(4, 'test', 'Testing', 'test2', 'd38f0d81d08e734b1c974110c6692c9367bca3b3', 'Mr', 'Test', 'Test', 'test', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, '127.0.0.1', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `question_id` int(11) DEFAULT NULL,
  `answer` text,
  `image` varchar(245) DEFAULT NULL,
  `correct` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `answer`, `image`, `correct`) VALUES
(13, 4, ' Number of checkouts available ', NULL, 1),
(12, 4, 'Number of available trolleys', NULL, 0),
(11, 4, 'Time spent queueing', NULL, 0),
(5, 3, ' Temperature (degrees F) ', NULL, 0),
(6, 3, 'Min Temperature', NULL, 0),
(7, 3, 'Max temperature', NULL, 0),
(8, 3, 'Temperature (degrees C)', NULL, 0),
(9, 4, 'Number of people waiting', NULL, 1),
(10, 4, 'Average queue length', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `assign`
--

CREATE TABLE IF NOT EXISTS `assign` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qid` int(5) NOT NULL,
  `assign` varchar(50) NOT NULL,
  `assign_type` varchar(10) NOT NULL DEFAULT 'class',
  `attempts` int(3) NOT NULL,
  `assigned_by` int(6) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `assign`
--

INSERT INTO `assign` (`id`, `qid`, `assign`, `assign_type`, `attempts`, `assigned_by`, `start_date`, `end_date`) VALUES
(4, 1, 'test', 'class', 2, 1, '2013-05-02', '2013-05-03'),
(5, 1, '1', 'class', 2, 1, '2013-05-05', '2013-05-06'),
(6, 1, '1', 'class', 2, 1, '2013-05-07', '2013-05-08'),
(7, 1, '1', 'class', 1, 1, '2013-05-09', '2013-05-10');

-- --------------------------------------------------------

--
-- Table structure for table `instances`
--

CREATE TABLE IF NOT EXISTS `instances` (
  `instance_id` int(11) NOT NULL AUTO_INCREMENT,
  `assign_id` int(6) NOT NULL,
  `user_id` int(11) NOT NULL,
  `finished` tinyint(1) NOT NULL,
  `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`instance_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `instances`
--

INSERT INTO `instances` (`instance_id`, `assign_id`, `user_id`, `finished`, `start_time`) VALUES
(38, 6, 1, 1, '2013-05-07 11:48:14');

-- --------------------------------------------------------

--
-- Table structure for table `question-types`
--

CREATE TABLE IF NOT EXISTS `question-types` (
  `typeid` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(150) NOT NULL,
  PRIMARY KEY (`typeid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `question-types`
--

INSERT INTO `question-types` (`typeid`, `type`) VALUES
(1, 'free response'),
(2, 'multiple choice'),
(3, 'multiple correct');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `quiz_id` int(11) DEFAULT NULL,
  `type` int(1) DEFAULT NULL,
  `question` text,
  `image` varchar(245) DEFAULT NULL,
  `options` varchar(245) DEFAULT NULL,
  `order` int(100) NOT NULL,
  `level` decimal(10,1) NOT NULL DEFAULT '3.1',
  `questiontime` int(6) NOT NULL DEFAULT '300' COMMENT 'Question time in Seconds',
  `answerreveal` int(4) NOT NULL DEFAULT '30' COMMENT 'In seconds how long before the answers are revealed',
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `quiz_id`, `type`, `question`, `image`, `options`, `order`, `level`, `questiontime`, `answerreveal`, `updated`) VALUES
(3, 1, 2, 'Helen has created a chart to show the highest and lowest temperature measured each day during a week in June.<br>\nWhich one of the following labels should she add to the Y (vertical) axis?&nbsp;', NULL, NULL, 2, 3.1, 100, 5, '0000-00-00 00:00:00'),
(4, 1, 3, 'You have used a spreadsheet to calculate the average length of a supermarket checkout queue. Which two of the following INPUTS were essential to your model?', NULL, NULL, 3, 3.1, 300, 5, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE IF NOT EXISTS `quizzes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `max_questions` int(11) NOT NULL DEFAULT '-1',
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `author_id`, `name`, `max_questions`, `password`) VALUES
(1, 1, 'ICT Baseline Testing', -1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE IF NOT EXISTS `results` (
  `instance_id` int(10) NOT NULL,
  `question_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `correct` tinyint(1) NOT NULL,
  `recorded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`instance_id`, `question_id`, `user_id`, `answer`, `correct`, `recorded`) VALUES
(38, 1, 1, '1', 1, '2013-05-07 11:48:22'),
(38, 3, 1, '8', 1, '2013-05-07 11:48:31'),
(38, 4, 1, '13|#|9', 1, '2013-05-07 11:48:51');
