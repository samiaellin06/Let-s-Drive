-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2019 at 07:31 PM
-- Server version: 5.6.24
-- PHP Version: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `letsdrive`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `UserName` varchar(50) NOT NULL DEFAULT '',
  `Pass` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`UserName`, `Pass`) VALUES
('admin1', 'e00cf25ad42683b3df678c61f42c6bda'),
('admin2', 'c84258e9c39059a89ab77d846ddab909');

-- --------------------------------------------------------

--
-- Table structure for table `bookcar`
--

CREATE TABLE IF NOT EXISTS `bookcar` (
  `D` date DEFAULT NULL,
  `T` time DEFAULT NULL,
  `Duration` double DEFAULT NULL,
  `HomeAddress` varchar(100) DEFAULT NULL,
  `Phone` varchar(12) DEFAULT NULL,
  `PickUpPoint` varchar(50) DEFAULT NULL,
  `DropOffPoint` varchar(50) DEFAULT NULL,
  `Price` double DEFAULT NULL,
  `License_image` varchar(255) DEFAULT NULL,
  `CarID` int(11) DEFAULT NULL,
  `Username` varchar(50) DEFAULT NULL,
  `bookid` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookcar`
--

INSERT INTO `bookcar` (`D`, `T`, `Duration`, `HomeAddress`, `Phone`, `PickUpPoint`, `DropOffPoint`, `Price`, `License_image`, `CarID`, `Username`, `bookid`) VALUES
('2030-08-19', '00:00:11', 3, 'Mirpur', '0123456789', 'Mirpur', 'Notun Bazar', 1500, 'Capture.PNG', 2, 'salehabir15', 5),
('2030-08-19', '00:00:11', 3, 'Mirpur', '12345678', 'Mirpur', 'NotunBazar', 1500, 'Driving_Licence.png', 2, 'salehabir15', 6);

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE IF NOT EXISTS `cars` (
  `CarId` int(11) NOT NULL DEFAULT '0',
  `CarName` varchar(50) DEFAULT NULL,
  `Type` varchar(50) DEFAULT NULL,
  `Seats` int(11) DEFAULT NULL,
  `Price` double DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`CarId`, `CarName`, `Type`, `Seats`, `Price`, `Quantity`, `Image`) VALUES
(1, 'Toyota Aqua 2013 Hybrid', 'Hatchback', 5, 1500, 5, 'Aqua.jpg'),
(2, 'Toyota Vitz 2013', 'Hatchback', 5, 1500, 4, 'Vitz.jpg\r\n'),
(3, 'Toyota Probox 2012', 'Hatchback', 5, 1500, 4, 'Probox.jpg'),
(4, 'Toyota X Corolla 2006', 'Sedan', 5, 2000, 5, 'XCorolla.jpg'),
(5, 'Toyota Axio 2012', 'Sedan', 5, 2200, 4, 'Axio.jpg'),
(6, 'Nissan Sunny 2008', 'Sedan', 5, 2100, 5, 'Sunny.jpg'),
(7, 'Toyota Allion 2016', 'Sedan', 5, 2800, 4, 'Allion.jpg'),
(8, 'Toyota Premio 2016', 'Sedan', 5, 2800, 4, 'Premio.jpg'),
(9, 'Honda Viezel 2013', 'Mini SUV', 5, 3000, 3, 'Viezel.jpg'),
(10, 'Mazda Axela 2010', 'Sedan', 5, 3500, 2, 'Mazda.jpg'),
(11, 'Toyota Noah X 2012', 'Mini Van', 7, 3500, 2, 'Noah.jpg\r\n'),
(12, 'Toyota Hiace Super GL', 'Mini Van', 11, 3200, 5, 'HiaceSuperGL.jpg'),
(13, 'hiace', 'van', 11, 3000, 3, 'Hiace.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `CreditCard` int(11) NOT NULL,
  `Pin` varchar(255) NOT NULL,
  `Amount` double NOT NULL,
  `PayId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subscribecar`
--

CREATE TABLE IF NOT EXISTS `subscribecar` (
  `Date` date DEFAULT NULL,
  `Time` time DEFAULT NULL,
  `Months` int(11) DEFAULT NULL,
  `HomeAddress` varchar(100) DEFAULT NULL,
  `Phone` varchar(12) DEFAULT NULL,
  `PickUpPoint` varchar(50) DEFAULT NULL,
  `DropOffPoint` varchar(50) DEFAULT NULL,
  `Price` double DEFAULT NULL,
  `License_image` varchar(255) DEFAULT NULL,
  `CarID` int(11) DEFAULT NULL,
  `Username` varchar(50) DEFAULT NULL,
  `subid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `UserName` varchar(50) NOT NULL DEFAULT '',
  `Email` varchar(50) DEFAULT NULL,
  `Pass` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserName`, `Email`, `Pass`) VALUES
('abir', 'abir@gmail.com', '202cb962ac59075b964b07152d234b70'),
('abir1', 'abir1@gmail.com', '202cb962ac59075b964b07152d234b70'),
('salehabir15', 'salehabir15@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b'),
('samiaellin', 'ellins45@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`UserName`);

--
-- Indexes for table `bookcar`
--
ALTER TABLE `bookcar`
  ADD PRIMARY KEY (`bookid`), ADD KEY `CarID` (`CarID`), ADD KEY `Username` (`Username`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`CarId`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`PayId`);

--
-- Indexes for table `subscribecar`
--
ALTER TABLE `subscribecar`
  ADD PRIMARY KEY (`subid`), ADD KEY `CarID` (`CarID`), ADD KEY `Username` (`Username`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookcar`
--
ALTER TABLE `bookcar`
  MODIFY `bookid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `PayId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `subscribecar`
--
ALTER TABLE `subscribecar`
  MODIFY `subid` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookcar`
--
ALTER TABLE `bookcar`
ADD CONSTRAINT `bookcar_ibfk_1` FOREIGN KEY (`CarID`) REFERENCES `cars` (`CarId`),
ADD CONSTRAINT `bookcar_ibfk_2` FOREIGN KEY (`Username`) REFERENCES `user` (`UserName`);

--
-- Constraints for table `subscribecar`
--
ALTER TABLE `subscribecar`
ADD CONSTRAINT `subscribecar_ibfk_1` FOREIGN KEY (`CarID`) REFERENCES `cars` (`CarId`),
ADD CONSTRAINT `subscribecar_ibfk_2` FOREIGN KEY (`Username`) REFERENCES `user` (`UserName`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
