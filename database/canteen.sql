-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 12, 2020 at 05:41 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `canteen`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_mst`
--

CREATE TABLE `admin_mst` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_mst`
--

INSERT INTO `admin_mst` (`username`, `password`) VALUES
('vedant', '12345'),
('sourav', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `catg_mst`
--

CREATE TABLE `catg_mst` (
  `category_id` varchar(5) NOT NULL,
  `category_name` varchar(20) NOT NULL,
  PRIMARY KEY  (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `catg_mst`
--

INSERT INTO `catg_mst` (`category_id`, `category_name`) VALUES
('', ''),
('1', 'South Indian'),
('2', 'Sweet & Baverages'),
('3', 'Chinese'),
('4', 'Panjabi'),
('5', 'Italian'),
('6', 'Other Fast Food');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `Name` varchar(250) NOT NULL,
  `Email` varchar(250) NOT NULL,
  `Mobile` varchar(250) NOT NULL,
  `Subject` varchar(250) NOT NULL,
  `Message` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`Name`, `Email`, `Mobile`, `Subject`, `Message`) VALUES
('CHANDAN KUMAR', 'ckj40856@gmail.com', '9487810674', 'sa', ''),
('CHANDAN KUMAR', 'ckj40856@gmail.com', '9487810674', 'sa', ''),
('BIRJU KUMAR', 'ckj40856@gmail.com', '8903079750', 'asd', 'asdasdasd'),
('CHANDAN KUMAR', 'ckj40856@gmail.com', '9487810674', 'asd', 'hfgdsfsx'),
('vedant', 'vedant@gmail.com', '2351251234', 'asfdg', 'saetbertbwe se ser aer asd asd asd asg WSD GAWRG ASG ASF ASDG ASDG AS ASDF A tyj drt rtjh srth srth srtsrt srth ');

-- --------------------------------------------------------

--
-- Table structure for table `cust_mst`
--

CREATE TABLE `cust_mst` (
  `CU_ID` varchar(5) NOT NULL,
  `username` varchar(30) NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contact` varchar(30) NOT NULL,
  `address` varchar(50) NOT NULL,
  `city` varchar(20) default NULL,
  `state` varchar(15) NOT NULL,
  `pin` varchar(6) NOT NULL,
  `password` varchar(30) NOT NULL,
  PRIMARY KEY  (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cust_mst`
--

INSERT INTO `cust_mst` (`CU_ID`, `username`, `fullname`, `email`, `contact`, `address`, `city`, `state`, `pin`, `password`) VALUES
('1', 'birju', 'BIRJU KUMAR', 'bkm123r@gmail.com', '8903079750', 'Pondicherry University, SRK HOSTEL ROOM NUMBER-59,', 'valsad', 'gujarat', '231123', 'Birju123@'),
('2', 'ckumar', 'CHANDAN KUMAR', 'ckj40856@gmail.com', '9487810674', 'Pondicherry University, SRK HOSTEL ROOM NUMBER-59,', 'valsad', 'gujarat', '231123', 'Ckumar123@'),
('', 'gabbar', 'gabbar', 'gabbar@sholey.com', '1234567891', '396001', '', '', '', '12345'),
('', 'jaydesai', 'jay', 'jay@gmail.com', '1234567890', 'valsad padi', 'valhad', 'gujarat', '123456', '1234'),
('3', 'nidha', 'nidha', 'nidha@gmail.com', '998696572', 'Maharashtra', 'valsad', 'gujarat', '231123', 'suhail'),
('4', 'pratheek083', 'Pratheek Shiri', 'pratheek@gmail.com', '8779546521', 'Hyderabad', 'valsad', 'gujarat', '231123', 'pratheek'),
('5', 'rakshithk00', 'Rakshith Kotian', 'rakshith@gmail.com', '9547123658', 'Gujarath', 'valsad', 'gujarat', '231123', 'rakshith'),
('', 'surtya', 'suresh', 'shurya@singham.in', '6516115264', 'suryanagar', 'suryacity', 'suryarajya', '123456', '12345'),
('6', 'vedantdesai', 'Vedant Desai', 'vedant@gmail.com', '1234567890', 'valsad', 'valsad', 'gujarat', '231123', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `food_mst`
--

CREATE TABLE `food_mst` (
  `F_ID` int(30) NOT NULL auto_increment,
  `name` varchar(30) NOT NULL,
  `price` int(30) NOT NULL,
  `description` varchar(200) NOT NULL,
  `food_category` varchar(5) NOT NULL,
  `images_path` varchar(200) NOT NULL,
  `options` varchar(10) NOT NULL default 'ENABLE',
  PRIMARY KEY  (`F_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=134 ;

--
-- Dumping data for table `food_mst`
--

INSERT INTO `food_mst` (`F_ID`, `name`, `price`, `description`, `food_category`, `images_path`, `options`) VALUES
(81, 'Vada Pav', 20, 'Hot Vada In Pav  ', '1', 'images\\vadapav.jpg', 'ENABLE'),
(84, 'Samosa', 20, '4 Samosa With Chutney ', '6', 'images\\samosa.jpg', 'ENABLE'),
(85, 'Veg Cheese PIzza', 200, 'Pizza With Vegetables & cheese', '5', 'images\\Vegpiza.jpg', 'ENABLE'),
(86, 'Margarita Pizza', 250, 'Pizza With Lots cheese', '5', 'images\\plainpiza.jpg', 'ENABLE'),
(124, 'Manchurian', 110, 'Veg Manchurian Dry', '3', 'images/manchurian.jpg', 'ENABLE'),
(125, 'Paneer Tikka', 120, 'Grilled Paneer with vegies', '4', 'images/paneer.jpg', 'ENABLE'),
(128, 'Pasta', 150, 'White Sous pasta', '5', 'images/pasta.jpg', 'ENABLE'),
(132, '', 0, '', '', '', 'ENABLE'),
(133, '', 0, '', '', '', 'ENABLE');

-- --------------------------------------------------------

--
-- Table structure for table `order_dtl`
--

CREATE TABLE `order_dtl` (
  `order_ID` int(30) NOT NULL auto_increment,
  `F_ID` varchar(30) NOT NULL,
  `foodname` varchar(30) NOT NULL,
  `price` varchar(30) NOT NULL,
  `quantity` varchar(30) NOT NULL,
  `order_date` date NOT NULL,
  `username` varchar(30) NOT NULL,
  `CAT_ID` varchar(30) NOT NULL,
  PRIMARY KEY  (`order_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `order_dtl`
--

INSERT INTO `order_dtl` (`order_ID`, `F_ID`, `foodname`, `price`, `quantity`, `order_date`, `username`, `CAT_ID`) VALUES
(1, '86', 'Margarita Pizza', '250', '1', '2020-04-10', 'vedantdesai', ''),
(2, '84', 'Samosa', '20', '1', '2020-04-10', 'vedantdesai', ''),
(3, '84', 'Samosa', '20', '1', '2020-04-10', 'vedantdesai', ''),
(4, '85', 'Veg Cheese PIzza', '200', '1', '2020-04-10', 'vedantdesai', '');

-- --------------------------------------------------------

--
-- Table structure for table `order_mst`
--

CREATE TABLE `order_mst` (
  `order_id` int(30) NOT NULL auto_increment,
  `user_id` varchar(30) NOT NULL,
  PRIMARY KEY  (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `order_mst`
--

