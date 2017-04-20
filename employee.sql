-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2017 at 09:16 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `employee`
--

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `city_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `state_id` bigint(20) NOT NULL,
  `city_name` varchar(255) NOT NULL,
  PRIMARY KEY (`city_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `state_id`, `city_name`) VALUES
(1, 1, 'Ahmedabad'),
(2, 1, 'Surat'),
(3, 1, 'Vadodara'),
(4, 1, 'Rajkot'),
(5, 2, 'Nagpur'),
(6, 2, 'Thane'),
(7, 2, 'Pimpri-Chinchwad'),
(8, 2, 'Nashik'),
(9, 2, 'Mumbai'),
(10, 2, 'Pune'),
(11, 3, 'Chennai'),
(12, 3, 'Coimbatore'),
(13, 3, 'Madurai'),
(14, 3, 'Tiruchirappalli'),
(15, 4, 'Ludhiana'),
(16, 4, 'Bathinda'),
(17, 4, 'Hoshiarpur'),
(18, 4, 'Fazilka');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `employee_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `department_id` bigint(20) NOT NULL,
  `employee_name` varchar(255) NOT NULL,
  `employee_salary` float NOT NULL,
  `gender` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 for male, 0 for female',
  `state_id` bigint(20) NOT NULL,
  `city_id` bigint(20) NOT NULL,
  `address` text NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`employee_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `department_id`, `employee_name`, `employee_salary`, `gender`, `state_id`, `city_id`, `address`, `created_date`) VALUES
(1, 3, 'Tejas', 2000, 1, 1, 1, 'Sola Complex', '2017-04-20 13:44:09'),
(2, 1, 'Samarth', 3600, 1, 1, 1, 'Sola Complex', '2017-04-20 13:44:09'),
(3, 1, 'Sam', 4000, 1, 1, 1, 'Sola Complex', '2017-04-20 13:44:09'),
(4, 2, 'Darshan', 5000, 1, 1, 1, 'Sola Complex', '2017-04-20 13:44:09'),
(5, 2, 'Shah', 6000, 1, 1, 1, 'Sola Complex', '2017-04-20 13:44:09'),
(6, 4, 'Pinal', 10000, 1, 1, 1, 'Sola Complex', '2017-04-20 13:44:09'),
(7, 5, 'Ravi', 3000, 1, 1, 1, 'Sola Complex', '2017-04-20 13:44:09'),
(8, 1, 'Kruti', 5000, 0, 2, 5, 'NAGPUR', '2017-04-20 17:31:28'),
(9, 1, 'Raju', 1000, 1, 3, 12, 'Coimbatore', '2017-04-20 17:32:35'),
(10, 1, 'Chandu', 1500, 1, 4, 15, 'Ludhiana', '2017-04-20 17:33:18'),
(11, 4, 'Kanak', 2500, 0, 3, 11, 'Chennai', '2017-04-20 17:34:42'),
(12, 2, 'Sanjay', 1800, 1, 2, 9, 'Daisar', '2017-04-20 17:45:44'),
(13, 3, 'Ankita', 1300, 0, 1, 1, 'Gota', '2017-04-20 17:46:20');

-- --------------------------------------------------------

--
-- Table structure for table `emp_department`
--

CREATE TABLE IF NOT EXISTS `emp_department` (
  `department_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(255) NOT NULL,
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `emp_department`
--

INSERT INTO `emp_department` (`department_id`, `department_name`) VALUES
(1, 'Dept1'),
(2, 'Dept2'),
(3, 'Dept3'),
(4, 'Dept4'),
(5, 'Dept5');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE IF NOT EXISTS `state` (
  `state_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `state_name` varchar(255) NOT NULL,
  PRIMARY KEY (`state_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`state_id`, `state_name`) VALUES
(1, 'Gujarat'),
(2, 'Maharashtra'),
(3, 'Tamilnadu'),
(4, 'Punjab');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
