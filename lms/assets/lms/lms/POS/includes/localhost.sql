-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 22, 2011 at 05:30 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `retailpos`
--
CREATE DATABASE `retailpos` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `retailpos`;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `company_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(1000) NOT NULL,
  `company_address1` varchar(1000) NOT NULL,
  `company_address2` varchar(1000) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `phone_num1` int(15) NOT NULL,
  `phone_num2` int(15) NOT NULL,
  `phone_num3` int(15) NOT NULL,
  `website` varchar(100) NOT NULL,
  `fax` int(15) NOT NULL,
  `compny_sname` varchar(20) NOT NULL,
  `tin_number` varchar(20) NOT NULL,
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_id`, `company_name`, `company_address1`, `company_address2`, `email_id`, `phone_num1`, `phone_num2`, `phone_num3`, `website`, `fax`, `compny_sname`, `tin_number`) VALUES
(1, 'customersquare', '#123, 3rd cross , 2nd main,', '2nd stage, Indhiranagar, Bangalore-560010', 'temp@gmail.com', 2147483647, 222222, 2147483647, 'testweb.com', 34543, 'sssss', '11111');

-- --------------------------------------------------------

--
-- Table structure for table `customer_info`
--

CREATE TABLE IF NOT EXISTS `customer_info` (
  `CUSTOMER_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `CUSTOMER_NAME` varchar(150) NOT NULL,
  `CUSTOMER_PHONE` varchar(50) DEFAULT NULL,
  `CUSTOMER_EMAIL` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`CUSTOMER_ID`),
  UNIQUE KEY `CUSTOMER_ID` (`CUSTOMER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `customer_info`
--


-- --------------------------------------------------------

--
-- Table structure for table `customer_receipts`
--

CREATE TABLE IF NOT EXISTS `customer_receipts` (
  `RECEIPT_ID` bigint(20) unsigned NOT NULL,
  `CUSTOMER_ID` bigint(20) unsigned NOT NULL,
  `NET_AMOUNT` bigint(10) unsigned DEFAULT NULL,
  `DATE_OF_PURCHASE` datetime DEFAULT NULL,
  `USER_NAME` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`RECEIPT_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_receipts`
--


-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `PRODUCT_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `PRODUCT_NAME` varchar(200) NOT NULL,
  `AMOUNT` bigint(20) unsigned DEFAULT NULL,
  `PRODUCT_CODE` varchar(20) NOT NULL,
  `QUANTITY` bigint(20) DEFAULT '1',
  `CATEGORY` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`PRODUCT_ID`),
  UNIQUE KEY `PRODUCT_ID` (`PRODUCT_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`PRODUCT_ID`, `PRODUCT_NAME`, `AMOUNT`, `PRODUCT_CODE`, `QUANTITY`, `CATEGORY`) VALUES
(27, 'GearBox1', 10001, '1', 1048, 1),
(28, 'Hair Spa', 1250, '2', 1, 2),
(30, 'test product 1', 1000, '3', 149, 1),
(31, 'ABC', 1000, '4', 1285, 1),
(32, 'ssss', 10000, '123', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `receipt_details`
--

CREATE TABLE IF NOT EXISTS `receipt_details` (
  `RECEIPT_ID` bigint(20) DEFAULT '0',
  `SL_NO` bigint(20) DEFAULT NULL,
  `PRODUCT_ID` bigint(10) unsigned DEFAULT NULL,
  `PRODUCT_NAME` varchar(100) DEFAULT NULL,
  `QUANTITY` int(10) unsigned DEFAULT NULL,
  `AMOUNT` bigint(20) DEFAULT NULL,
  `TAX` float DEFAULT NULL,
  `DISCOUNT` float DEFAULT NULL,
  `PAYABLE` float DEFAULT NULL,
  `USER_NAME` varchar(50) DEFAULT NULL,
  `DATE_OF_PURCHASE` date DEFAULT NULL,
  `TIME_OF_PURCHASE` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `receipt_details`
--

INSERT INTO `receipt_details` (`RECEIPT_ID`, `SL_NO`, `PRODUCT_ID`, `PRODUCT_NAME`, `QUANTITY`, `AMOUNT`, `TAX`, `DISCOUNT`, `PAYABLE`, `USER_NAME`, `DATE_OF_PURCHASE`, `TIME_OF_PURCHASE`) VALUES
(1, 2, 3, 'test product 1', 13, 1000, 1177.54, 390, 12610, '12', '2011-07-18', '00:00:16'),
(1, 3, 3, 'test product 1', 13, 1000, 1177.54, 390, 12610, '12', '2011-07-18', '00:00:16'),
(2, 2, 1, 'GearBox1', 1, 10001, 896.55, 400.04, 9600.96, '12', '2011-07-18', '00:00:04'),
(3, 2, 1, 'GearBox1', 4, 10001, 3586.22, 1600.16, 38403.8, '12', '2011-07-18', '00:00:05'),
(3, 3, 1, 'GearBox1', 4, 10001, 3586.22, 1600.16, 38403.8, '0', '2011-07-18', '00:00:05'),
(3, 4, 1, 'GearBox1', 44, 10001, 3944.44, 1760, 42240, '0', '2011-07-18', '00:00:05'),
(3, 5, 3, 'test product 1', 1, 1000, 89.65, 40, 960, '0', '2011-07-18', '00:00:05'),
(4, 2, 1, 'GearBox1', 1, 10001, 924.57, 100.01, 9900.99, '12', '2011-07-20', '00:00:21'),
(5, 2, 1, 'GearBox1', 1, 10001, 915.23, 200.02, 9800.98, '10', '2011-07-20', '00:00:00'),
(6, 2, 1, 'GearBox1', 10, 10001, 8965.54, 4000.4, 96009.6, '13', '2011-07-20', '00:00:02'),
(6, 3, 3, 'test product 1', 3, 1000, 268.94, 120, 2880, '13', '2011-07-20', '00:00:02');

-- --------------------------------------------------------

--
-- Table structure for table `receipt_totals`
--

CREATE TABLE IF NOT EXISTS `receipt_totals` (
  `RECEIPT_ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `TOTAL_QUANTITY` bigint(20) DEFAULT NULL,
  `TOTAL_AMOUNT` float DEFAULT NULL,
  `TOTAL_TAX` float DEFAULT NULL,
  `TOTAL_DISCOUNT` float DEFAULT NULL,
  `TOTAL_PAYABLE` float DEFAULT NULL,
  `USER_NAME` varchar(50) DEFAULT NULL,
  `DATE_OF_PURCHASE` date DEFAULT NULL,
  `TIME_OF_PURCHASE` time NOT NULL,
  PRIMARY KEY (`RECEIPT_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `receipt_totals`
--

INSERT INTO `receipt_totals` (`RECEIPT_ID`, `TOTAL_QUANTITY`, `TOTAL_AMOUNT`, `TOTAL_TAX`, `TOTAL_DISCOUNT`, `TOTAL_PAYABLE`, `USER_NAME`, `DATE_OF_PURCHASE`, `TIME_OF_PURCHASE`) VALUES
(2, 1, 10001, 896.55, 400.04, 9600.96, '12', '2011-07-18', '00:00:04'),
(3, 53, 31003, 11206.5, 5000.32, 120008, '12', '2011-07-18', '00:00:05'),
(4, 1, 10001, 924.57, 100.01, 9900.99, '12', '2011-07-20', '00:00:21'),
(5, 1, 10001, 915.23, 200.02, 9800.98, '12', '2011-07-20', '00:00:00'),
(6, 0, 0, 0, 0, 0, '12', '0000-00-00', '00:00:00'),
(7, 0, 0, 0, 0, 0, '13', '2011-07-21', '00:00:00'),
(12, 26, 2000, 2355.08, 780, 25220, '13', '2011-07-18', '00:00:16');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `SERVICE_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `SERVICE_NAME` varchar(200) NOT NULL,
  `AMOUNT` bigint(20) unsigned DEFAULT NULL,
  `SERVICE_CODE` varchar(20) NOT NULL,
  `QUANTITY` bigint(20) unsigned DEFAULT NULL,
  `CATEGORY` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`SERVICE_ID`),
  UNIQUE KEY `SERVICE_ID` (`SERVICE_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`SERVICE_ID`, `SERVICE_NAME`, `AMOUNT`, `SERVICE_CODE`, `QUANTITY`, `CATEGORY`) VALUES
(1, 'Hair Coloring', 15000, '1', 1, 2),
(2, 'Facial Bleach1', 80001, '2', 1, 2),
(3, 'Manicure2', 1200012, '3', 1, 2),
(4, 'test service 1', 1200, '4', 10, 2);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `SETTING_ID` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `SETTING_NAME` varchar(50) NOT NULL DEFAULT '0',
  `SETTING_VALUE` float DEFAULT '0',
  PRIMARY KEY (`SETTING_ID`),
  UNIQUE KEY `SETTING_ID` (`SETTING_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`SETTING_ID`, `SETTING_NAME`, `SETTING_VALUE`) VALUES
(1, 'SERVICE TAX', 10.3);

-- --------------------------------------------------------

--
-- Table structure for table `temp_rec`
--

CREATE TABLE IF NOT EXISTS `temp_rec` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `description` double NOT NULL,
  `qty` double NOT NULL,
  `amount` double NOT NULL,
  `subTotal` double NOT NULL,
  `discountAmount` double NOT NULL,
  `serviceTaxAmount` double NOT NULL,
  `total` double NOT NULL,
  `attendedBy` int(25) NOT NULL,
  `username` int(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `temp_rec`
--

INSERT INTO `temp_rec` (`id`, `description`, `qty`, `amount`, `subTotal`, `discountAmount`, `serviceTaxAmount`, `total`, `attendedBy`, `username`) VALUES
(1, 2, 1, 80001, 69629.16, 3200.04, 7171.8, 76800.96, 0, 0),
(2, 3, 1, 1200012, 1055314.27, 36000.36, 108697.37, 1164011.64, 0, 0),
(3, 1, 1, 15000, 13055.3, 600, 1344.7, 14400, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `USER_ID` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `USER_NAME` varchar(20) NOT NULL DEFAULT '0',
  `PASSWORD` varchar(100) NOT NULL DEFAULT '0',
  `FIRST_NAME` varchar(100) NOT NULL DEFAULT '0',
  `LAST_NAME` varchar(100) DEFAULT '0',
  `PRIVILEGE_ID` tinyint(3) unsigned DEFAULT '0',
  `PHONE` varchar(20) DEFAULT NULL,
  `EMAIL` varchar(75) DEFAULT NULL,
  `ADDRESS` varchar(300) DEFAULT NULL,
  `AGE` int(3) NOT NULL,
  `SEX` int(2) NOT NULL,
  PRIMARY KEY (`USER_ID`),
  UNIQUE KEY `USER_ID` (`USER_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`USER_ID`, `USER_NAME`, `PASSWORD`, `FIRST_NAME`, `LAST_NAME`, `PRIVILEGE_ID`, `PHONE`, `EMAIL`, `ADDRESS`, `AGE`, `SEX`) VALUES
(12, 'anilxyz', '81dc9bdb52d04dc20036dbd8313ed055', 'Demo', 'Manager', 2, NULL, NULL, NULL, 0, 0),
(16, 'Jyothi', '827ccb0eea8a706c4c34a16891f84e7b', 'jyothi11', 'patil11', 1, '8888888888888', 'jyothipati123123@gmail.com', 'Thoughtw', 33, 2),
(17, 'kumar', '81dc9bdb52d04dc20036dbd8313ed055', 'jyothi', 'patil', 1, '9916162699', 'dreamjyothi143@gmail.com', 'Bangalore', 12, 1),
(19, 'dfg', '81dc9bdb52d04dc20036dbd8313ed055', 'jyothi', 'patil', 2, '345', 'dfdf', '4534dfd', 45, 2);
