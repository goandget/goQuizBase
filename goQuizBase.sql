-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 11, 2013 at 03:29 PM
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `email`, `school`, `username`, `password`, `title`, `forename`, `surname`, `class`, `year`, `created`, `modified`, `type`, `ip_address`) VALUES
(1, 'jhooton@arrowsmith.wigan.sch.uk', 'Admin', 'jmhooton', '92233c65e3908734b050ea32e14ade054ac7dfd1', 'Mr', 'Jonathan', 'Hooton', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, '10.10.1.104');

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
(1, 1, 'Handwrite the message', NULL, 0),
(2, 1, 'Wait until she sees the student', NULL, 0),
(3, 1, 'Borrow a PC to type up the note', NULL, 0),
(4, 1, 'Ask the ICT Technician to fix her PC quickly', NULL, 1),
(5, 3, 'Temperature (degrees F)', NULL, 0),
(6, 3, 'Min Temperature', NULL, 0),
(7, 3, 'Max temperature', NULL, 0),
(8, 3, 'Temperature (degrees C)', NULL, 1),
(9, 4, 'Number of people waiting', NULL, 1),
(10, 4, 'Average queue length', NULL, 0),
(11, 4, 'Time spent queueing', NULL, 0),
(12, 4, 'Number of available trolleys', NULL, 0),
(13, 4, 'Number of checkouts', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `instances`
--

CREATE TABLE IF NOT EXISTS `instances` (
  `instance_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `finished` tinyint(1) NOT NULL,
  `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`instance_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `instances`
--

INSERT INTO `instances` (`instance_id`, `user_id`, `finished`, `start_time`) VALUES
(10, 1, 1, '2013-04-11 14:41:48'),
(9, 1, 1, '2013-04-11 14:39:25'),
(8, 1, 1, '2013-04-11 14:38:28'),
(7, 1, 1, '2013-04-11 14:37:35'),
(6, 1, 1, '2013-04-11 14:11:40'),
(11, 1, 1, '2013-04-11 14:52:55'),
(12, 1, 0, '2013-04-11 14:56:22');

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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `quiz_id`, `type`, `question`, `image`, `options`, `order`, `level`, `questiontime`, `answerreveal`) VALUES
(1, 1, 2, 'Mrs Watson, an English teacher, needs to get a short messages to a student urgently. Her PC is not working. <br />\r\nWhat should she do?', NULL, NULL, 1, 3.1, 100, 5),
(3, 1, 2, 'Helen has created a chart to show the highest and lowest temperature measured each day during a week in June.<br />\r\nWhich one of the following labels should she add to the Y (vertical) axis? ', NULL, NULL, 2, 3.1, 100, 5),
(4, 1, 3, 'You have used a spreadsheet to calculate the average length of a supermarket checkout queue. Which two of the following INPUTS were essential to your model?', NULL, NULL, 3, 3.1, 300, 5);

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
(1, 1, 1, '2', 0, '2013-01-23 01:32:47'),
(1, 2, 1, 'Test', 0, '2013-01-23 01:33:01'),
(1, 1, 1, '1', 1, '2013-01-23 01:44:35'),
(1, 2, 1, 'test', 0, '2013-01-23 01:44:48'),
(1, 1, 1, '1', 1, '2013-01-23 01:46:53'),
(1, 2, 1, '1', 0, '2013-01-23 01:47:09'),
(1, 1, 1, '2', 0, '2013-01-23 01:51:16'),
(1, 2, 1, 'me', 0, '2013-01-23 01:51:21'),
(1, 1, 1, '1', 1, '2013-01-23 01:51:58'),
(1, 2, 1, 'me', 0, '2013-01-23 01:52:01'),
(1, 2, 1, 'me', 0, '2013-01-23 01:52:56'),
(2, 1, 1, '2', 0, '2013-01-23 01:53:08'),
(2, 2, 1, '2', 0, '2013-01-23 01:53:15'),
(3, 2, 1, 'Test', 0, '2013-04-11 12:42:33'),
(4, 2, 1, 'Help', 0, '2013-04-11 12:48:44'),
(5, 1, 1, '0', 0, '2013-04-11 13:19:26'),
(5, 2, 1, '', 0, '2013-04-11 13:19:41'),
(6, 1, 1, '0', 0, '2013-04-11 14:11:52'),
(7, 1, 1, '0', 0, '2013-04-11 14:37:46'),
(8, 1, 1, '0', 0, '2013-04-11 14:38:39'),
(9, 1, 1, '3', 0, '2013-04-11 14:39:36'),
(10, 1, 1, '4', 1, '2013-04-11 14:41:57'),
(10, 1, 1, '4', 1, '2013-04-11 14:46:42'),
(10, 3, 1, '8', 1, '2013-04-11 14:46:52'),
(10, 4, 1, '0', 0, '2013-04-11 14:51:53'),
(11, 1, 1, '4', 1, '2013-04-11 14:53:04'),
(11, 3, 1, '8', 1, '2013-04-11 14:53:12'),
(11, 4, 1, '9', 1, '2013-04-11 14:53:55'),
(12, 1, 1, '4', 1, '2013-04-11 14:56:32'),
(12, 3, 1, '8', 1, '2013-04-11 14:56:47'),
(12, 3, 1, '8', 1, '2013-04-11 15:09:06');
