-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 04, 2013 at 12:49 AM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `greenweb_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `gold`
--

CREATE TABLE IF NOT EXISTS `gold` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cost` varchar(16) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `gold`
--

INSERT INTO `gold` (`id`, `cost`, `date`, `time`) VALUES
(19, '۱,۵۷.۸۰', '2013-02-28', '18:52:00'),
(17, '۱,۷۷.۸۰', '2013-01-15', '12:22:47'),
(18, '۱,۵۷۷.۸', '2013-02-23', '17:48:56'),
(20, '۵۷۷.۸۰', '2013-03-01', '18:53:37'),
(22, '۱,۵۷۷.۸۰', '2013-03-03', '21:57:20'),
(23, '۱,۵۸۱.۳۰', '2013-03-03', '23:13:16'),
(24, '۱,۵۸۱.۱۰', '2013-03-03', '23:15:29'),
(25, '۱,۵۸۱.۶۰', '2013-03-03', '23:24:07'),
(26, '۱,۵۸۱.۳۰', '2013-03-03', '23:38:31'),
(27, '۱,۵۸۱.۵۰', '2013-03-03', '23:39:11'),
(28, '۱,۵۸۱.۴۰', '2013-03-04', '00:41:36'),
(29, '۱,۵۸۱.۱۰', '2013-03-04', '00:43:33'),
(30, '۱,۵۸۱.', '2013-03-04', '00:47:32'),
(31, '۱,۵۸۱.۲۰', '2013-03-04', '00:48:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES
(1, 'qqqq', '343b1c4a3ea721b2d640fc8700db0f36', 'qqq@ee.ss'),
(2, 'eeww', 'e130e5e618f15cee7a519d8b7b8306a0', 'qqq@ee.ss'),
(5, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'admin@esn.ir'),
(6, 'myadmin', '70c9d3d094e3b1c331174946b7c93ec1', 'fdfsd@sd.ds');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
