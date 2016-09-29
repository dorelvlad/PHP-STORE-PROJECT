-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2015 at 03:14 PM
-- Server version: 5.6.15-log
-- PHP Version: 5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `coachleatherware`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorii`
--

CREATE TABLE IF NOT EXISTS `categorii` (
  `id_categorie` int(4) NOT NULL AUTO_INCREMENT,
  `denumire_categorie` varchar(100) NOT NULL,
  `activ` int(1) NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `categorii`
--

INSERT INTO `categorii` (`id_categorie`, `denumire_categorie`, `activ`) VALUES
(1, 'Men', 1),
(2, 'Woman', 1),
(6, 'For everyone', 1);

-- --------------------------------------------------------

--
-- Table structure for table `produse`
--

CREATE TABLE IF NOT EXISTS `produse` (
  `id_produs` int(4) NOT NULL AUTO_INCREMENT,
  `denumire` varchar(100) NOT NULL,
  `pret` double(5,2) NOT NULL,
  `cantitate` int(5) NOT NULL,
  `id_subcategorie` int(4) NOT NULL,
  `data_in` datetime NOT NULL,
  `activ` int(1) NOT NULL,
  PRIMARY KEY (`id_produs`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `produse`
--

INSERT INTO `produse` (`id_produs`, `denumire`, `pret`, `cantitate`, `id_subcategorie`, `data_in`, `activ`) VALUES
(6, 'prod2', 180.00, 8, 11, '2015-07-13 21:50:59', 1),
(7, 'prod1', 120.00, 4, 15, '2015-07-13 21:51:23', 1),
(8, 'prod3', 123.00, 6, 10, '2015-07-13 21:51:37', 1),
(13, 'prod4', 340.00, 23, 15, '2015-07-13 21:35:06', 1),
(14, 'prod5', 400.00, 25, 19, '2015-07-13 21:40:26', 1),
(15, 'prod6', 340.00, 21, 26, '2015-07-13 21:51:47', 1),
(17, 'prod7', 400.00, 21, 13, '2015-07-13 22:03:03', 1),
(18, 'prod8', 234.00, 12, 26, '2015-07-14 14:39:40', 1),
(25, 'prod9', 240.00, 33, 20, '2015-07-18 14:42:51', 1);

-- --------------------------------------------------------

--
-- Table structure for table `subcategorii`
--

CREATE TABLE IF NOT EXISTS `subcategorii` (
  `id_subcategorie` int(4) NOT NULL AUTO_INCREMENT,
  `den_subcateg` varchar(100) NOT NULL,
  `id_categorie` int(4) NOT NULL,
  `activ` int(1) NOT NULL,
  PRIMARY KEY (`id_subcategorie`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `subcategorii`
--

INSERT INTO `subcategorii` (`id_subcategorie`, `den_subcateg`, `id_categorie`, `activ`) VALUES
(4, 'Bags', 1, 1),
(10, 'Wallets', 1, 1),
(11, 'Shoes', 1, 1),
(12, 'Ready-to-wear', 1, 1),
(13, 'Accesories', 1, 1),
(14, 'Belts', 1, 1),
(15, 'Watches', 1, 1),
(16, 'Sunglasses', 1, 1),
(17, 'Travel', 1, 1),
(18, 'Bags', 2, 1),
(19, 'Wallets', 2, 1),
(20, 'Wristlets', 2, 1),
(21, 'Shoes', 2, 1),
(22, 'Ready-to-wear', 2, 1),
(23, 'Accesories', 2, 1),
(24, 'Watches', 2, 1),
(25, 'Sunglasses', 2, 1),
(26, 'Travel', 2, 1),
(27, 'Bags', 6, 1),
(28, 'Wallets', 6, 1),
(30, 'Accessories', 6, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nume` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `parola` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nume`, `email`, `parola`) VALUES
(3, 'Dorel Vlad', 'redwarrior07@yahoo.com', '58be84e35d0f83b1fa69b115651b0ba1'),
(4, 'Mihaela Istrate', 'mihaelaistrate18@yahoo.com', 'ae2b74c875617ebae7d3385e4f2e4492');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
