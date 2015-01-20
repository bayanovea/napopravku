-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 20, 2015 at 06:26 AM
-- Server version: 5.5.41-log
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `napopravku`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE IF NOT EXISTS `doctors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `speciality_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `doctors_ibfk_1` (`speciality_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `name`, `last_name`, `speciality_id`) VALUES
(1, 'Врач', 'Врачевский 1', 1),
(2, 'Врач', 'Врачевский 2', 4),
(3, 'Врач', 'Врачевский 3', 2),
(4, 'Врач', 'Врачевский 4', 6),
(5, 'Врач', 'Врачевский 5', 2),
(6, 'Врач', 'Врачевский 6', 3),
(7, 'Врач', 'Врачевский 7', 4),
(8, 'Врач', 'Врачевский 8', 2),
(9, 'Врач', 'Врачевский 9', 1),
(10, 'Врач', 'Врачевский 10', 5),
(11, 'Врач', 'Врачевский 11', 6),
(12, 'Врач', 'Врачевский 12', 1),
(13, 'Врач', 'Врачевский 13', 3),
(14, 'Врач', 'Врачевский 14', 2),
(15, 'Врач', 'Врачевский 15', 1),
(16, 'Врач', 'Врачевский 16', 6),
(17, 'Врач', 'Врачевский 17', 4),
(18, 'Врач', 'Врачевский 18', 5),
(19, 'Врач', 'Врачевский 19', 3);

-- --------------------------------------------------------

--
-- Table structure for table `receptions`
--

CREATE TABLE IF NOT EXISTS `receptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) NOT NULL,
  `date` varchar(12) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `doctor_id` (`doctor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `receptions`
--

INSERT INTO `receptions` (`id`, `user_id`, `doctor_id`, `date`, `active`) VALUES
(1, 1, 2, '1421582400', 1),
(2, 1, 3, '1421596800', 1),
(3, 2, 1, '1421600400', 1),
(4, 3, 4, '1421661600', 1),
(5, 4, 6, '1421668800', 1),
(6, 1, 1, '1421672400', 1),
(7, 2, 5, '1421683200', 1),
(8, 3, 1, '1421686800', 1),
(9, 4, 2, '1421773200', 1),
(10, 1, 3, '1421834400', 1),
(11, 1, 5, '1421838000', 1),
(12, 2, 6, '1421841600', 1),
(13, 1, 2, '1421845200', 1),
(14, 1, 3, '1421848800', 1),
(15, 4, 1, '1421852400', 1),
(16, 4, 3, '1421856000', 1),
(17, 4, 6, '1421859600', 1),
(18, 1, 5, '1421920800', 1),
(19, 1, 4, '1421924400', 1),
(20, 2, 3, '1421928000', 1),
(21, 1, 2, '1421931600', 1),
(23, 2, 3, '1421938800', 1),
(26, 4, 9, '1421672400', 1),
(33, 2, 14, '1421935200', 1),
(45, 2, 14, '1421938800', 1),
(47, 1, 14, '1421942400', 1);

-- --------------------------------------------------------

--
-- Table structure for table `speciality`
--

CREATE TABLE IF NOT EXISTS `speciality` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `speciality`
--

INSERT INTO `speciality` (`id`, `name`) VALUES
(1, 'Венеролог'),
(2, 'Вирусолог'),
(3, 'Гепатолог'),
(4, 'Диагност'),
(5, 'Кардиолог'),
(6, 'Косметолог');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `login`, `password`) VALUES
(1, 'Имя 1', 'Фамилия 1', 'login1', 'password1'),
(2, 'Имя 2', 'Фамилия 2', 'login2', 'password2'),
(3, 'Имя 3', 'Фамилия 3', 'login3', 'password3'),
(4, 'Имя 4', 'Фамилия 4', 'login4', 'password4');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_ibfk_1` FOREIGN KEY (`speciality_id`) REFERENCES `speciality` (`id`);

--
-- Constraints for table `receptions`
--
ALTER TABLE `receptions`
  ADD CONSTRAINT `receptions_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`),
  ADD CONSTRAINT `receptions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
