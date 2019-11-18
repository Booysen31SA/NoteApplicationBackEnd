-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 18, 2019 at 01:31 PM
-- Server version: 5.7.26
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `note-application`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` varchar(45) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `title` varchar(45) NOT NULL,
  `firstName` varchar(45) NOT NULL,
  `lastName` varchar(45) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `gender` varchar(45) NOT NULL,
  `mobileNumber` varchar(45) NOT NULL,
  `telephoneNumber` varchar(45) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `userGroupId` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `disabled` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `userGroupId` (`userGroupId`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `userId`, `password`, `title`, `firstName`, `lastName`, `dateOfBirth`, `gender`, `mobileNumber`, `telephoneNumber`, `email`, `userGroupId`, `created`, `modified`, `disabled`) VALUES
(1, 'MolleeC14ca', '5f4dcc3b5aa765d61d8327deb882cf99', 'Ms', 'Mollee', 'Carstairs', '1955-08-23', 'Female', '828-817-2296', '(740) 3601206', 'mcarstairs0@sourceforge.net', 2, '2016-02-15 15:17:46', '2018-11-06 15:01:55', 0),
(2, 'CorbyH298e', '5f4dcc3b5aa765d61d8327deb882cf99', 'Rev', 'Corby', 'Hayth', '1983-08-31', 'Male', '332-916-0364', '(882) 4030237', 'chayth1@ustream.tv', 1, '2015-11-25 03:35:20', NULL, 0),
(3, 'ascsaa2690', '696d29e0940a4957748fe3fc9efd22a3', 'Ms', 'ascsa', 'ascas', '1955-08-23', 'Female', '828-817-2236', '(740) 3601206', 'mcarstairs0@sourceforge.nets', 2, '2019-11-05 16:41:17', '2018-11-06 15:01:55', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`userGroupId`) REFERENCES `usergroup` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
