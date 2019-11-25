-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 25, 2019 at 08:28 AM
-- Server version: 5.7.26
-- PHP Version: 5.6.40

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
-- Table structure for table `usertoken`
--

DROP TABLE IF EXISTS `usertoken`;
CREATE TABLE IF NOT EXISTS `usertoken` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` varchar(45) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expiryDate` datetime NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `disabled` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usertoken`
--

INSERT INTO `usertoken` (`id`, `userId`, `token`, `expiryDate`, `created`, `modified`, `disabled`) VALUES
(1, 'MolleeC14ca', '12c5173ee306551ca88860d26f7c1b7096feda2a26849daa6ee4fbc9d568e09103092806bb7ad90bbceb00a66e46b9889a57b5d1af15f29e9a2566961ecdd34e', '2019-11-25 14:20:46', '2019-11-25 09:20:46', NULL, 0),
(2, 'CorbyH298e', '14e3ecc124df8ad4ccdde84e5a213f500a81bd1951d5384ec30087f7e30bf48d97164eab9d8c04cd928aa496538f808866bb3c8394f7313ffb078bc8d16d4dce', '2019-11-18 19:25:40', '2019-11-18 14:25:40', NULL, 0),
(3, 'MatthewBbe2d', '25f85747c6458a8a277bd412b307b8b376328519263a052d6e2a418aca62a717a0509300c9eb82676ee410b4e0d7c4bebbb0843832d3286d43a89c34e567f6df', '2019-11-25 15:15:42', '2019-11-25 10:15:42', NULL, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `usertoken`
--
ALTER TABLE `usertoken`
  ADD CONSTRAINT `usertoken_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
