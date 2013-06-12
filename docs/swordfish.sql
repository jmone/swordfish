-- phpMyAdmin SQL Dump
-- version 3.4.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 13, 2013 at 01:18 AM
-- Server version: 5.1.60
-- PHP Version: 5.3.25

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `swordfish`
--

-- --------------------------------------------------------

--
-- Table structure for table `default_dict`
--

CREATE TABLE IF NOT EXISTS `default_dict` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `word` char(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `word` (`word`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ext_dict`
--

CREATE TABLE IF NOT EXISTS `ext_dict` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `word` char(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `word` (`word`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `search_favorite`
--

CREATE TABLE IF NOT EXISTS `search_favorite` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `text` varchar(200) NOT NULL,
  `dateline` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `stop_word`
--

CREATE TABLE IF NOT EXISTS `stop_word` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `word` char(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `word` (`word`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `stop_word`
--

INSERT INTO `stop_word` (`id`, `word`) VALUES
(1, '的'),
(2, '一个'),
(3, '了'),
(4, '在'),
(5, '自己'),
(6, '是'),
(7, '和'),
(8, '会'),
(9, '都'),
(10, '没有'),
(11, '着');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  `password` varchar(100) NOT NULL,
  `dateline` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `dateline`) VALUES
(1, 'jmone2006@126.com', '95d297d18efa0670acd32bc6a1544ff7', 1371051063),
(4, 'jim@exephp.com', 'ee6af8dbc8b2af80581246966eaeea44', 1371057338),
(3, 'admin@exephp.com', '41759c4b6e9e56a8ab18191b98d03030', 1371051181),
(5, 'jiangming@xiaomi.com', '3855771f0912e76294305e43080d93ef', 1371057409);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
