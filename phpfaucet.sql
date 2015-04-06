-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 24, 2015 at 07:48 AM
-- Server version: 5.5.42-cll
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `phpfaucet`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_config`
--

CREATE TABLE IF NOT EXISTS `tbl_config` (
  `config_id` int(11) NOT NULL AUTO_INCREMENT,
  `header` varchar(200) COLLATE utf8_persian_ci NOT NULL,
  `value` varchar(200) COLLATE utf8_persian_ci NOT NULL,
  PRIMARY KEY (`config_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=18 ;

--
-- Dumping data for table `tbl_config`
--

INSERT INTO `tbl_config` (`config_id`, `header`, `value`) VALUES
(1, 'referral_percent', '60'),
(2, 'timer', '1'),
(3, 'currency', 'mBTC'),
(4, 'donate_type', 'USD'),
(5, 'donate_min', '0.001'),
(6, 'privkey', 's9TDkk9hIef4SAMa989ZKEu4cZQeP78t'),
(7, 'verkey', 'YfjtYBZvK92LSnx6rTrFoiAVMwVEU3xy'),
(8, 'hashkey', 'jvYrCIEHDgvYkuF2VSE29m1fpF6TX5Ld'),
(9, 'pusername', 'wilan'),
(10, 'papiname', 'phpfaucet'),
(11, 'ppassword', 'php123'),
(12, 'STORE_NAME', 'phpfaucetsci'),
(13, 'asmoneymin', '1'),
(14, 'currencymin', '1'),
(15, 'minimum_donate', '4'),
(16, 'sci_username', 'a'),
(17, 'sci_pass', 'dsad');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_donate`
--

CREATE TABLE IF NOT EXISTS `tbl_donate` (
  `donate` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `amount` int(10) unsigned NOT NULL,
  `date` int(4) unsigned NOT NULL,
  `link` text COLLATE utf8_persian_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`donate`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prize`
--

CREATE TABLE IF NOT EXISTS `tbl_prize` (
  `prize_id` int(11) NOT NULL AUTO_INCREMENT,
  `prize` float NOT NULL,
  `chance` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`prize_id`),
  KEY `chance` (`chance`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tbl_prize`
--

INSERT INTO `tbl_prize` (`prize_id`, `prize`, `chance`) VALUES
(7, 1, 1),
(16, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaction`
--

CREATE TABLE IF NOT EXISTS `tbl_transaction` (
  `trans_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_Id` int(10) unsigned NOT NULL,
  `amount` int(10) unsigned NOT NULL,
  `date` int(4) unsigned NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`trans_id`),
  KEY `user_Id` (`user_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ausername` varchar(200) COLLATE utf8_persian_ci NULL,
  `username` varchar(200) COLLATE utf8_persian_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_persian_ci NOT NULL,
  `address` varchar(300) COLLATE utf8_persian_ci NULL,
  `parent_id` int(11) unsigned DEFAULT NULL,
  `reset` int(11) NOT NULL DEFAULT '0',
  `ip` int(10) unsigned NULL,
  `credit` decimal(10,8) NULL DEFAULT '0',
  PRIMARY KEY (`user_id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=14 ;



-- --------------------------------------------------------

--
-- Table structure for table `tbl_withdrawal`
--

CREATE TABLE IF NOT EXISTS `tbl_withdrawal` (
  `withdrawal_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `amount` float unsigned NOT NULL,
  `fee` int(11) NOT NULL,
  `date` int(4) DEFAULT NULL,
  `type` tinyint(1) NOT NULL,
  `wallet` varchar(300) COLLATE utf8_persian_ci NOT NULL,
  `reccode` varchar(200) COLLATE utf8_persian_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`withdrawal_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_withdrawal`
--

INSERT INTO `tbl_withdrawal` (`withdrawal_id`, `user_id`, `amount`, `fee`, `date`, `type`, `wallet`, `reccode`, `status`) VALUES
(3, 13, 0.89, 0, NULL, 1, '', '167457', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  ADD CONSTRAINT `tbl_transaction_ibfk_1` FOREIGN KEY (`user_Id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD CONSTRAINT `tbl_user_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE SET NULL;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
