-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 03, 2013 at 11:54 AM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `renew_sis`
--

-- --------------------------------------------------------

--
-- Table structure for table `fee_m_canceled`
--

CREATE TABLE IF NOT EXISTS `fee_m_canceled` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accYear` int(4) NOT NULL,
  `studentId` int(11) NOT NULL,
  `admissionCat` int(2) NOT NULL,
  `currencyType` int(2) NOT NULL,
  `installmentId` int(2) NOT NULL,
  `amount` double(18,2) NOT NULL,
  `fine` double NOT NULL,
  `paymentDate` date NOT NULL,
  `modeOfPament` int(1) NOT NULL,
  `bankName` int(2) NOT NULL,
  `bankDetails` varchar(250) NOT NULL,
  `ddChequeNo` varchar(30) NOT NULL,
  `ddChequeDate` date NOT NULL,
  `clearedDate` date NOT NULL,
  `amountCleared` double(18,2) NOT NULL,
  `remarks` text NOT NULL,
  `receipt` varchar(20) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `fee_m_canceled`
--


-- --------------------------------------------------------

--
-- Table structure for table `fee_m_collect`
--

CREATE TABLE IF NOT EXISTS `fee_m_collect` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accYear` int(4) NOT NULL,
  `studentId` int(11) NOT NULL,
  `admissionCat` int(2) NOT NULL,
  `currencyType` int(2) NOT NULL,
  `installmentId` int(2) NOT NULL,
  `amount` double(18,2) NOT NULL,
  `fine` double NOT NULL,
  `paymentDate` date NOT NULL,
  `modeOfPament` int(1) NOT NULL,
  `bankName` int(2) NOT NULL,
  `bankDetails` varchar(250) NOT NULL,
  `ddChequeNo` varchar(30) NOT NULL,
  `ddChequeDate` date NOT NULL,
  `clearedDate` date NOT NULL,
  `amountCleared` double(18,2) NOT NULL,
  `remarks` text NOT NULL,
  `receipt` varchar(20) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `fee_m_collect`
--

INSERT INTO `fee_m_collect` (`id`, `accYear`, `studentId`, `admissionCat`, `currencyType`, `installmentId`, `amount`, `fine`, `paymentDate`, `modeOfPament`, `bankName`, `bankDetails`, `ddChequeNo`, `ddChequeDate`, `clearedDate`, `amountCleared`, `remarks`, `receipt`, `status`) VALUES
(9, 2012, 12, 1, 1, 1, 245000.00, 0, '2012-12-21', 3, 2, '', '102010', '2012-12-21', '2012-12-24', 245000.00, '', 'CS/FR/9', 1),
(8, 2012, 2, 3, 2, 1, 20000.00, 0, '2012-12-21', 1, 0, '', '', '0000-00-00', '2012-12-21', 1096962.61, 'fee collected ', 'CS/FR/1', 1),
(10, 2012, 6, 1, 1, 1, 245000.00, 0, '2012-12-21', 3, 2, '', '120122', '2012-12-21', '2012-12-24', 245000.00, '', 'CS/FR/10', 1),
(11, 2012, 3, 3, 2, 1, 20000.00, 0, '2012-12-21', 1, 0, '', '', '0000-00-00', '2012-12-21', 1097162.61, '', 'CS/FR/11', 1),
(12, 2012, 617, 3, 2, 1, 20000.00, 0, '2012-12-21', 1, 0, '', '', '0000-00-00', '2012-12-21', 1097162.61, '', 'CS/FR/12', 1),
(13, 2012, 4, 3, 2, 1, 20000.00, 0, '2012-12-21', 1, 0, '', '', '0000-00-00', '2012-12-21', 1097162.61, '', 'CS/FR/13', 1),
(14, 2012, 8, 3, 2, 1, 20000.00, 0, '2012-12-21', 1, 0, '', '', '0000-00-00', '2012-12-21', 1097162.61, '', 'CS/FR/14', 1),
(15, 2012, 10, 1, 1, 1, 245000.00, 0, '2012-12-23', 3, 2, 'mg road', '102001', '2012-12-23', '2012-12-24', 245000.00, '', 'CS/FR/15', 1),
(16, 2012, 9, 3, 2, 1, 20000.00, 0, '2012-12-24', 1, 0, '', '', '0000-00-00', '2012-12-24', 1096962.61, '', 'CS/FR/16', 1),
(17, 2012, 11, 3, 2, 1, 20000.00, 0, '2012-12-24', 1, 0, '', '', '0000-00-00', '2012-12-24', 1096962.61, '', 'CS/FR/17', 1),
(18, 2012, 5, 1, 1, 1, 245000.00, 0, '2012-12-24', 3, 2, 'sample', '120123', '2012-12-24', '2012-12-24', 245000.00, '', 'CS/FR/18', 1),
(19, 2012, 512, 4, 3, 1, 16000.00, 0, '2012-12-26', 1, 0, '', '', '0000-00-00', '2012-12-26', 0.00, '', 'CS/FR/19', 1),
(21, 2012, 513, 3, 2, 1, 20000.00, 0, '2012-12-28', 1, 0, '', '', '2012-12-28', '0000-00-00', 0.00, 'adfadfasdf', 'CS/FR/20', 1),
(22, 2012, 513, 3, 2, 2, 5000.00, 0, '2012-12-28', 2, 0, '', '', '2012-12-28', '0000-00-00', 0.00, '', 'CS/FR/22', 1),
(23, 2012, 5, 1, 1, 2, 47000.00, 0, '2013-01-03', 1, 0, '', '', '2013-01-03', '2013-01-03', 47000.00, '', 'CS/FR/23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `fee_m_conversion_rate`
--

CREATE TABLE IF NOT EXISTS `fee_m_conversion_rate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `c_date` date NOT NULL,
  `native_currency` int(2) NOT NULL,
  `currency` int(2) NOT NULL,
  `conversion_rate` double NOT NULL,
  `bankCharges` double NOT NULL,
  `remarks` text NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `fee_m_conversion_rate`
--

INSERT INTO `fee_m_conversion_rate` (`id`, `c_date`, `native_currency`, `currency`, `conversion_rate`, `bankCharges`, `remarks`, `status`) VALUES
(9, '2012-12-21', 1, 2, 0.0182305, 0.005, '', 1),
(8, '2012-12-21', 1, 3, 0.0137696, 0.005, '', 1),
(10, '2012-12-24', 1, 2, 0.0182305, 0.005, '', 1),
(11, '2012-12-24', 1, 3, 0.0137696, 0.005, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `fee_m_currency_code`
--

CREATE TABLE IF NOT EXISTS `fee_m_currency_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  `description` varchar(50) NOT NULL,
  `code` varchar(350) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `fee_m_currency_code`
--

INSERT INTO `fee_m_currency_code` (`id`, `name`, `description`, `code`, `status`) VALUES
(1, 'INR', 'Rupee', '<img alt=''rupee'' src=''http://upload.wikimedia.org/wikipedia/commons/thumb/e/ee/Indian_Rupee_symbol.svg/10px-Indian_Rupee_symbol.svg.png''>', 1),
(2, 'USD', 'Dollar', '<b>&#36;</b>', 1),
(3, 'EUR', 'Euro', '<b>€</b>', 1),
(4, 'GBP', 'Pounds', '<b>£</b>', 1);

-- --------------------------------------------------------

--
-- Table structure for table `fee_m_descrption`
--

CREATE TABLE IF NOT EXISTS `fee_m_descrption` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` varchar(35) NOT NULL,
  `accyear` year(4) NOT NULL,
  `class` int(3) NOT NULL,
  `adm_cat` int(3) NOT NULL,
  `no_of_instal` int(2) DEFAULT '0',
  `currency` int(2) NOT NULL,
  `no_of_student` int(4) DEFAULT '0',
  `status` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `fee_m_descrption`
--

INSERT INTO `fee_m_descrption` (`id`, `uid`, `accyear`, `class`, `adm_cat`, `no_of_instal`, `currency`, `no_of_student`, `status`) VALUES
(14, '84b62ade40fd6ed72907ccbd33b3bb18', 2012, 1, 4, 4, 3, 0, 1),
(13, '1fbe88113f97aa0379d241da3d347613', 2012, 1, 1, 4, 1, 0, 1),
(12, '24d9080b1b94e572eef1fa645c1fa738', 2012, 1, 3, 4, 2, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `fee_m_descrption_head_total`
--

CREATE TABLE IF NOT EXISTS `fee_m_descrption_head_total` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` varchar(35) NOT NULL,
  `head_id` int(2) NOT NULL,
  `amount` float(18,2) NOT NULL,
  `sts` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `fee_m_descrption_head_total`
--

INSERT INTO `fee_m_descrption_head_total` (`id`, `uid`, `head_id`, `amount`, `sts`) VALUES
(1, '24d9080b1b94e572eef1fa645c1fa738', 1, 16000.00, 1),
(2, '24d9080b1b94e572eef1fa645c1fa738', 2, 2000.00, 1),
(3, '24d9080b1b94e572eef1fa645c1fa738', 3, 2500.00, 1),
(4, '24d9080b1b94e572eef1fa645c1fa738', 4, 2000.00, 1),
(5, '24d9080b1b94e572eef1fa645c1fa738', 5, 2500.00, 1),
(6, '24d9080b1b94e572eef1fa645c1fa738', 6, 0.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `fee_m_descrption_inst_total`
--

CREATE TABLE IF NOT EXISTS `fee_m_descrption_inst_total` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` varchar(35) NOT NULL,
  `inst_id` int(2) NOT NULL,
  `amount` float(18,2) NOT NULL,
  `f_due_date` date NOT NULL,
  `t_due_date` date NOT NULL,
  `sts` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `fee_m_descrption_inst_total`
--

INSERT INTO `fee_m_descrption_inst_total` (`id`, `uid`, `inst_id`, `amount`, `f_due_date`, `t_due_date`, `sts`) VALUES
(9, '24d9080b1b94e572eef1fa645c1fa738', 1, 20000.00, '0000-00-00', '0000-00-00', 1),
(10, '1fbe88113f97aa0379d241da3d347613', 1, 245000.00, '0000-00-00', '0000-00-00', 1),
(11, '84b62ade40fd6ed72907ccbd33b3bb18', 1, 16000.00, '0000-00-00', '0000-00-00', 1),
(12, '1fbe88113f97aa0379d241da3d347613', 2, 47000.00, '2012-12-21', '2012-12-27', 1),
(13, '24d9080b1b94e572eef1fa645c1fa738', 2, 5000.00, '0000-00-00', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `fee_m_descrption_val`
--

CREATE TABLE IF NOT EXISTS `fee_m_descrption_val` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` varchar(35) NOT NULL,
  `fee_head` int(11) NOT NULL,
  `inst_id` int(11) NOT NULL,
  `amount` float(18,2) NOT NULL,
  `sts` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=165 ;

--
-- Dumping data for table `fee_m_descrption_val`
--

INSERT INTO `fee_m_descrption_val` (`id`, `uid`, `fee_head`, `inst_id`, `amount`, `sts`) VALUES
(103, '24d9080b1b94e572eef1fa645c1fa738', 2, 3, 0.00, 1),
(102, '24d9080b1b94e572eef1fa645c1fa738', 2, 2, 1000.00, 1),
(101, '24d9080b1b94e572eef1fa645c1fa738', 2, 1, 1000.00, 1),
(100, '24d9080b1b94e572eef1fa645c1fa738', 1, 4, 0.00, 1),
(99, '24d9080b1b94e572eef1fa645c1fa738', 1, 3, 0.00, 1),
(98, '24d9080b1b94e572eef1fa645c1fa738', 1, 2, 1000.00, 1),
(97, '24d9080b1b94e572eef1fa645c1fa738', 1, 1, 15000.00, 1),
(104, '24d9080b1b94e572eef1fa645c1fa738', 2, 4, 0.00, 1),
(105, '24d9080b1b94e572eef1fa645c1fa738', 3, 1, 1500.00, 1),
(106, '24d9080b1b94e572eef1fa645c1fa738', 3, 2, 1000.00, 1),
(107, '24d9080b1b94e572eef1fa645c1fa738', 3, 3, 0.00, 1),
(108, '24d9080b1b94e572eef1fa645c1fa738', 3, 4, 0.00, 1),
(109, '24d9080b1b94e572eef1fa645c1fa738', 4, 1, 1000.00, 1),
(110, '24d9080b1b94e572eef1fa645c1fa738', 4, 2, 1000.00, 1),
(111, '24d9080b1b94e572eef1fa645c1fa738', 4, 3, 0.00, 1),
(112, '24d9080b1b94e572eef1fa645c1fa738', 4, 4, 0.00, 1),
(113, '24d9080b1b94e572eef1fa645c1fa738', 5, 1, 1500.00, 1),
(114, '24d9080b1b94e572eef1fa645c1fa738', 5, 2, 1000.00, 1),
(115, '24d9080b1b94e572eef1fa645c1fa738', 5, 3, 0.00, 1),
(116, '24d9080b1b94e572eef1fa645c1fa738', 5, 4, 0.00, 1),
(117, '1fbe88113f97aa0379d241da3d347613', 1, 1, 150000.00, 1),
(118, '1fbe88113f97aa0379d241da3d347613', 1, 2, 200.00, 1),
(119, '1fbe88113f97aa0379d241da3d347613', 1, 3, 0.00, 1),
(120, '1fbe88113f97aa0379d241da3d347613', 1, 4, 0.00, 1),
(121, '1fbe88113f97aa0379d241da3d347613', 2, 1, 15000.00, 1),
(122, '1fbe88113f97aa0379d241da3d347613', 2, 2, 30000.00, 1),
(123, '1fbe88113f97aa0379d241da3d347613', 2, 3, 0.00, 1),
(124, '1fbe88113f97aa0379d241da3d347613', 2, 4, 0.00, 1),
(125, '1fbe88113f97aa0379d241da3d347613', 3, 1, 20000.00, 1),
(126, '1fbe88113f97aa0379d241da3d347613', 3, 2, 5000.00, 1),
(127, '1fbe88113f97aa0379d241da3d347613', 3, 3, 0.00, 1),
(128, '1fbe88113f97aa0379d241da3d347613', 3, 4, 0.00, 1),
(129, '1fbe88113f97aa0379d241da3d347613', 4, 1, 50000.00, 1),
(130, '1fbe88113f97aa0379d241da3d347613', 4, 2, 6000.00, 1),
(131, '1fbe88113f97aa0379d241da3d347613', 4, 3, 0.00, 1),
(132, '1fbe88113f97aa0379d241da3d347613', 4, 4, 0.00, 1),
(133, '1fbe88113f97aa0379d241da3d347613', 5, 1, 10000.00, 1),
(134, '1fbe88113f97aa0379d241da3d347613', 5, 2, 5000.00, 1),
(135, '1fbe88113f97aa0379d241da3d347613', 5, 3, 0.00, 1),
(136, '1fbe88113f97aa0379d241da3d347613', 5, 4, 0.00, 1),
(137, '84b62ade40fd6ed72907ccbd33b3bb18', 1, 1, 12000.00, 1),
(138, '84b62ade40fd6ed72907ccbd33b3bb18', 1, 2, 0.00, 1),
(139, '84b62ade40fd6ed72907ccbd33b3bb18', 1, 3, 0.00, 1),
(140, '84b62ade40fd6ed72907ccbd33b3bb18', 1, 4, 0.00, 1),
(141, '84b62ade40fd6ed72907ccbd33b3bb18', 2, 1, 1000.00, 1),
(142, '84b62ade40fd6ed72907ccbd33b3bb18', 2, 2, 0.00, 1),
(143, '84b62ade40fd6ed72907ccbd33b3bb18', 2, 3, 0.00, 1),
(144, '84b62ade40fd6ed72907ccbd33b3bb18', 2, 4, 0.00, 1),
(145, '84b62ade40fd6ed72907ccbd33b3bb18', 3, 1, 1000.00, 1),
(146, '84b62ade40fd6ed72907ccbd33b3bb18', 3, 2, 0.00, 1),
(147, '84b62ade40fd6ed72907ccbd33b3bb18', 3, 3, 0.00, 1),
(148, '84b62ade40fd6ed72907ccbd33b3bb18', 3, 4, 0.00, 1),
(149, '84b62ade40fd6ed72907ccbd33b3bb18', 4, 1, 1000.00, 1),
(150, '84b62ade40fd6ed72907ccbd33b3bb18', 4, 2, 0.00, 1),
(151, '84b62ade40fd6ed72907ccbd33b3bb18', 4, 3, 0.00, 1),
(152, '84b62ade40fd6ed72907ccbd33b3bb18', 4, 4, 0.00, 1),
(153, '84b62ade40fd6ed72907ccbd33b3bb18', 5, 1, 1000.00, 1),
(154, '84b62ade40fd6ed72907ccbd33b3bb18', 5, 2, 0.00, 1),
(155, '84b62ade40fd6ed72907ccbd33b3bb18', 5, 3, 0.00, 1),
(156, '84b62ade40fd6ed72907ccbd33b3bb18', 5, 4, 0.00, 1),
(157, '1fbe88113f97aa0379d241da3d347613', 6, 1, 0.00, 1),
(158, '1fbe88113f97aa0379d241da3d347613', 6, 2, 800.00, 1),
(159, '1fbe88113f97aa0379d241da3d347613', 6, 3, 0.00, 1),
(160, '1fbe88113f97aa0379d241da3d347613', 6, 4, 0.00, 1),
(161, '24d9080b1b94e572eef1fa645c1fa738', 6, 1, 0.00, 1),
(162, '24d9080b1b94e572eef1fa645c1fa738', 6, 2, 0.00, 1),
(163, '24d9080b1b94e572eef1fa645c1fa738', 6, 3, 0.00, 1),
(164, '24d9080b1b94e572eef1fa645c1fa738', 6, 4, 0.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `fee_m_head_inst_collected`
--

CREATE TABLE IF NOT EXISTS `fee_m_head_inst_collected` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(50) NOT NULL,
  `accYear` int(4) NOT NULL,
  `instId` int(2) NOT NULL,
  `receipt` varchar(20) NOT NULL,
  `studentId` int(11) NOT NULL,
  `feeHead` int(2) NOT NULL,
  `totalAmount` double(18,2) NOT NULL,
  `totalConverted` double(18,2) NOT NULL,
  `currency` int(2) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `fee_m_head_inst_collected`
--

INSERT INTO `fee_m_head_inst_collected` (`id`, `uid`, `accYear`, `instId`, `receipt`, `studentId`, `feeHead`, `totalAmount`, `totalConverted`, `currency`, `status`) VALUES
(1, '24d9080b1b94e572eef1fa645c1fa738', 2012, 1, 'CS/FR/20', 513, 1, 15000.00, 0.00, 0, 1),
(2, '24d9080b1b94e572eef1fa645c1fa738', 2012, 1, 'CS/FR/20', 513, 2, 1000.00, 0.00, 0, 1),
(3, '24d9080b1b94e572eef1fa645c1fa738', 2012, 1, 'CS/FR/20', 513, 3, 1500.00, 0.00, 0, 1),
(4, '24d9080b1b94e572eef1fa645c1fa738', 2012, 1, 'CS/FR/20', 513, 4, 1000.00, 0.00, 0, 1),
(5, '24d9080b1b94e572eef1fa645c1fa738', 2012, 1, 'CS/FR/20', 513, 5, 1500.00, 0.00, 0, 1),
(6, '24d9080b1b94e572eef1fa645c1fa738', 2012, 1, 'CS/FR/20', 513, 6, 0.00, 0.00, 0, 1),
(7, '24d9080b1b94e572eef1fa645c1fa738', 2012, 2, 'CS/FR/22', 513, 1, 1000.00, 0.00, 0, 1),
(8, '24d9080b1b94e572eef1fa645c1fa738', 2012, 2, 'CS/FR/22', 513, 2, 1000.00, 0.00, 0, 1),
(9, '24d9080b1b94e572eef1fa645c1fa738', 2012, 2, 'CS/FR/22', 513, 3, 1000.00, 0.00, 0, 1),
(10, '24d9080b1b94e572eef1fa645c1fa738', 2012, 2, 'CS/FR/22', 513, 4, 1000.00, 0.00, 0, 1),
(11, '24d9080b1b94e572eef1fa645c1fa738', 2012, 2, 'CS/FR/22', 513, 5, 1000.00, 0.00, 0, 1),
(12, '24d9080b1b94e572eef1fa645c1fa738', 2012, 2, 'CS/FR/22', 513, 6, 0.00, 0.00, 0, 1),
(13, '1fbe88113f97aa0379d241da3d347613', 2012, 2, 'CS/FR/23', 5, 1, 200.00, 0.00, 0, 1),
(14, '1fbe88113f97aa0379d241da3d347613', 2012, 2, 'CS/FR/23', 5, 2, 30000.00, 0.00, 0, 1),
(15, '1fbe88113f97aa0379d241da3d347613', 2012, 2, 'CS/FR/23', 5, 3, 5000.00, 0.00, 0, 1),
(16, '1fbe88113f97aa0379d241da3d347613', 2012, 2, 'CS/FR/23', 5, 4, 6000.00, 0.00, 0, 1),
(17, '1fbe88113f97aa0379d241da3d347613', 2012, 2, 'CS/FR/23', 5, 5, 5000.00, 0.00, 0, 1),
(18, '1fbe88113f97aa0379d241da3d347613', 2012, 2, 'CS/FR/23', 5, 6, 800.00, 0.00, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `fee_m_head_total`
--

CREATE TABLE IF NOT EXISTS `fee_m_head_total` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(50) NOT NULL,
  `accYear` int(4) NOT NULL,
  `studentId` int(11) NOT NULL,
  `feeHead` int(2) NOT NULL,
  `feeTotalAmount` double(18,2) NOT NULL,
  `oneTime` int(1) NOT NULL,
  `totalCollected` double(18,2) NOT NULL,
  `refund` int(1) NOT NULL,
  `refundAmount` double(18,2) NOT NULL,
  `cleared` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `fee_m_head_total`
--

INSERT INTO `fee_m_head_total` (`id`, `uid`, `accYear`, `studentId`, `feeHead`, `feeTotalAmount`, `oneTime`, `totalCollected`, `refund`, `refundAmount`, `cleared`, `status`) VALUES
(1, '24d9080b1b94e572eef1fa645c1fa738', 2012, 513, 1, 15000.00, 2, 0.00, 0, 0.00, 0, 1),
(2, '24d9080b1b94e572eef1fa645c1fa738', 2012, 513, 2, 1000.00, 2, 0.00, 0, 0.00, 0, 1),
(3, '24d9080b1b94e572eef1fa645c1fa738', 2012, 513, 3, 1500.00, 2, 0.00, 0, 0.00, 0, 1),
(4, '24d9080b1b94e572eef1fa645c1fa738', 2012, 513, 4, 1000.00, 1, 0.00, 1, 0.00, 0, 1),
(5, '24d9080b1b94e572eef1fa645c1fa738', 2012, 513, 5, 1500.00, 1, 0.00, 0, 0.00, 0, 1),
(6, '24d9080b1b94e572eef1fa645c1fa738', 2012, 513, 6, 0.00, 2, 0.00, 0, 0.00, 0, 1),
(7, '24d9080b1b94e572eef1fa645c1fa738', 2012, 513, 1, 16000.00, 2, 1000.00, 0, 0.00, 0, 1),
(8, '24d9080b1b94e572eef1fa645c1fa738', 2012, 513, 2, 2000.00, 2, 1000.00, 0, 0.00, 0, 1),
(9, '24d9080b1b94e572eef1fa645c1fa738', 2012, 513, 3, 2500.00, 2, 1000.00, 0, 0.00, 0, 1),
(10, '24d9080b1b94e572eef1fa645c1fa738', 2012, 513, 4, 2000.00, 1, 1000.00, 1, 0.00, 0, 1),
(11, '24d9080b1b94e572eef1fa645c1fa738', 2012, 513, 5, 2500.00, 1, 1000.00, 0, 0.00, 0, 1),
(12, '24d9080b1b94e572eef1fa645c1fa738', 2012, 513, 6, 0.00, 2, 0.00, 0, 0.00, 0, 1),
(13, '1fbe88113f97aa0379d241da3d347613', 2012, 5, 1, 0.00, 2, 200.00, 0, 0.00, 0, 1),
(14, '1fbe88113f97aa0379d241da3d347613', 2012, 5, 2, 0.00, 2, 30000.00, 0, 0.00, 0, 1),
(15, '1fbe88113f97aa0379d241da3d347613', 2012, 5, 3, 0.00, 2, 5000.00, 0, 0.00, 0, 1),
(16, '1fbe88113f97aa0379d241da3d347613', 2012, 5, 4, 0.00, 1, 6000.00, 1, 0.00, 0, 1),
(17, '1fbe88113f97aa0379d241da3d347613', 2012, 5, 5, 0.00, 1, 5000.00, 0, 0.00, 0, 1),
(18, '1fbe88113f97aa0379d241da3d347613', 2012, 5, 6, 0.00, 2, 800.00, 0, 0.00, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `fee_type`
--

CREATE TABLE IF NOT EXISTS `fee_type` (
  `fee_id` int(11) NOT NULL AUTO_INCREMENT,
  `fee_name` varchar(100) NOT NULL DEFAULT '',
  `catid` int(3) DEFAULT NULL,
  `refund` int(11) DEFAULT '1',
  `status` int(11) DEFAULT '1',
  `ftype` int(1) DEFAULT '1',
  PRIMARY KEY (`fee_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `fee_type`
--

INSERT INTO `fee_type` (`fee_id`, `fee_name`, `catid`, `refund`, `status`, `ftype`) VALUES
(1, 'Tution Fee', NULL, 0, 1, 2),
(2, 'Lab Fee', NULL, 0, 1, 2),
(3, 'Transport Fee', NULL, 0, 1, 2),
(4, 'Deposit', NULL, 1, 1, 1),
(5, 'Maintanance fee', NULL, 0, 1, 1),
(6, 'Library', NULL, 0, 1, 2);
