-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 28, 2012 at 09:12 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mycloud`
--

-- --------------------------------------------------------

--
-- Table structure for table `docs`
--

CREATE TABLE IF NOT EXISTS `docs` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `path` varchar(256) NOT NULL,
  `type` varchar(20) NOT NULL,
  `uid` varchar(255) NOT NULL,
  PRIMARY KEY (`idx`,`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `docs`
--


-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `path` varchar(256) NOT NULL,
  `type` varchar(20) NOT NULL,
  `uid` varchar(255) NOT NULL,
  PRIMARY KEY (`idx`,`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `images`
--


-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE IF NOT EXISTS `media` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `path` varchar(256) NOT NULL,
  `type` varchar(20) NOT NULL,
  `uid` varchar(255) NOT NULL,
  PRIMARY KEY (`idx`,`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `media`
--


-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usr` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `pass` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `uid` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `regIP` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `dt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `usr` (`usr`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `usr`, `pass`, `email`, `uid`, `regIP`, `dt`) VALUES
(1, 'admin', 'admin', 'admin@admin.com', 'abcdef', '', '0000-00-00 00:00:00'),
(2, 'test', 'cbf2c36c44708e0e8d928c08c3672dfc', 'test@test.com', '', '::1', '2012-10-27 14:28:37'),
(3, 'ankit', '5ae9366a61b47075e83d2155ad3a04c0', 'ankit@ankit.com', '18254508d3dd7201a98.31437372', '::1', '2012-10-28 19:44:23'),
(4, 'happy', 'aae598739303830ed2eefe6bc887a4f2', 'happy@happy.com', '17212508d3e280c47e2.52124432', '::1', '2012-10-28 19:45:44');

-- --------------------------------------------------------

--
-- Table structure for table `misc`
--

CREATE TABLE IF NOT EXISTS `misc` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `path` varchar(256) NOT NULL,
  `type` varchar(20) NOT NULL,
  `uid` varchar(255) NOT NULL,
  PRIMARY KEY (`idx`,`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `misc`
--


-- --------------------------------------------------------

--
-- Table structure for table `url`
--

CREATE TABLE IF NOT EXISTS `url` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(50) NOT NULL,
  `tag_url` varchar(1024) NOT NULL,
  `uid` varchar(255) NOT NULL,
  PRIMARY KEY (`idx`,`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `url`
--

INSERT INTO `url` (`idx`, `tag_name`, `tag_url`, `uid`) VALUES
(4, 'happy', 'def@def.com', 'abcdef'),
(3, 'ankit', 'abc@abc.com', 'abcdef'),
(5, 'jacob', 'ghi@ghi.com', 'abcdef'),
(6, 'google', 'google.com', 'abcdef'),
(7, 'codesmart', 'codechef.com', 'abcdef');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
