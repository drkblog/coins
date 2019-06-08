-- phpMyAdmin SQL Dump
-- version 4.0.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 08, 2019 at 11:07 AM
-- Server version: 5.1.73
-- PHP Version: 5.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `drk`
--

--
-- Dumping data for table `coin_acos`
--

INSERT INTO `coin_acos` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(1, NULL, NULL, NULL, 'controllers', 1, 128),
(2, 1, NULL, NULL, 'Pages', 2, 15),
(3, 2, NULL, NULL, 'display', 3, 4),
(4, 2, NULL, NULL, 'add', 5, 6),
(5, 2, NULL, NULL, 'edit', 7, 8),
(6, 2, NULL, NULL, 'index', 9, 10),
(7, 2, NULL, NULL, 'view', 11, 12),
(8, 2, NULL, NULL, 'delete', 13, 14),
(9, 1, NULL, NULL, 'Users', 16, 33),
(10, 9, NULL, NULL, 'login', 17, 18),
(11, 9, NULL, NULL, 'logout', 19, 20),
(12, 9, NULL, NULL, 'index', 21, 22),
(13, 9, NULL, NULL, 'view', 23, 24),
(14, 9, NULL, NULL, 'add', 25, 26),
(15, 9, NULL, NULL, 'edit', 27, 28),
(16, 9, NULL, NULL, 'delete', 29, 30),
(17, 1, NULL, NULL, 'Types', 34, 49),
(18, 17, NULL, NULL, 'index', 35, 36),
(19, 17, NULL, NULL, 'view', 37, 38),
(20, 17, NULL, NULL, 'add', 39, 40),
(21, 17, NULL, NULL, 'edit', 41, 42),
(22, 17, NULL, NULL, 'delete', 43, 44),
(23, 1, NULL, NULL, 'Denominations', 50, 61),
(24, 23, NULL, NULL, 'index', 51, 52),
(25, 23, NULL, NULL, 'view', 53, 54),
(26, 23, NULL, NULL, 'add', 55, 56),
(27, 23, NULL, NULL, 'edit', 57, 58),
(28, 23, NULL, NULL, 'delete', 59, 60),
(29, 1, NULL, NULL, 'Countries', 62, 73),
(30, 29, NULL, NULL, 'index', 63, 64),
(31, 29, NULL, NULL, 'view', 65, 66),
(32, 29, NULL, NULL, 'add', 67, 68),
(33, 29, NULL, NULL, 'edit', 69, 70),
(34, 29, NULL, NULL, 'delete', 71, 72),
(35, 1, NULL, NULL, 'Coins', 74, 89),
(36, 35, NULL, NULL, 'index', 75, 76),
(37, 35, NULL, NULL, 'view', 77, 78),
(38, 35, NULL, NULL, 'add', 79, 80),
(39, 35, NULL, NULL, 'edit', 81, 82),
(40, 35, NULL, NULL, 'delete', 83, 84),
(41, 1, NULL, NULL, 'Emissions', 90, 103),
(42, 41, NULL, NULL, 'index', 91, 92),
(43, 41, NULL, NULL, 'view', 93, 94),
(44, 41, NULL, NULL, 'add', 95, 96),
(45, 41, NULL, NULL, 'edit', 97, 98),
(46, 41, NULL, NULL, 'delete', 99, 100),
(47, 1, NULL, NULL, 'Grades', 104, 115),
(48, 47, NULL, NULL, 'index', 105, 106),
(49, 47, NULL, NULL, 'view', 107, 108),
(50, 47, NULL, NULL, 'add', 109, 110),
(51, 47, NULL, NULL, 'edit', 111, 112),
(52, 47, NULL, NULL, 'delete', 113, 114),
(53, 1, NULL, NULL, 'Groups', 116, 127),
(54, 53, NULL, NULL, 'index', 117, 118),
(55, 53, NULL, NULL, 'view', 119, 120),
(56, 53, NULL, NULL, 'add', 121, 122),
(57, 53, NULL, NULL, 'edit', 123, 124),
(58, 53, NULL, NULL, 'delete', 125, 126),
(59, 9, NULL, NULL, 'init_permissions', 31, 32),
(60, 17, NULL, NULL, 'duplicate', 45, 46),
(61, 35, NULL, NULL, 'duplicate', 85, 86),
(62, 35, NULL, NULL, 'changeType', 87, 88),
(63, 41, NULL, NULL, 'forCountry', 101, 102),
(64, 17, NULL, NULL, 'forEmission', 47, 48);

--
-- Dumping data for table `coin_aros`
--

INSERT INTO `coin_aros` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(1, NULL, 'Group', 1, NULL, 1, 4),
(2, NULL, 'Group', 2, NULL, 5, 10),
(3, NULL, 'Group', 3, NULL, 11, 14),
(4, 1, 'User', 1, NULL, 2, 3),
(5, 2, 'User', 2, NULL, 6, 7),
(6, 3, 'User', 3, NULL, 12, 13),
(7, 2, 'User', 4, NULL, 8, 9);

--
-- Dumping data for table `coin_aros_acos`
--

INSERT INTO `coin_aros_acos` (`id`, `aro_id`, `aco_id`, `_create`, `_read`, `_update`, `_delete`) VALUES
(37, 3, 36, '1', '1', '1', '1'),
(36, 3, 1, '-1', '-1', '-1', '-1'),
(35, 2, 11, '1', '1', '1', '1'),
(34, 2, 47, '1', '1', '1', '1'),
(33, 2, 23, '1', '1', '1', '1'),
(32, 2, 41, '1', '1', '1', '1'),
(31, 2, 29, '1', '1', '1', '1'),
(30, 2, 17, '1', '1', '1', '1'),
(29, 2, 35, '1', '1', '1', '1'),
(28, 2, 1, '-1', '-1', '-1', '-1'),
(27, 1, 1, '1', '1', '1', '1'),
(38, 3, 18, '1', '1', '1', '1'),
(39, 3, 11, '1', '1', '1', '1'),
(40, 3, 37, '1', '1', '1', '1'),
(41, 3, 19, '1', '1', '1', '1'),
(42, 3, 30, '1', '1', '1', '1'),
(43, 3, 31, '1', '1', '1', '1'),
(44, 3, 42, '1', '1', '1', '1'),
(45, 3, 43, '1', '1', '1', '1'),
(46, 3, 24, '1', '1', '1', '1'),
(47, 3, 25, '1', '1', '1', '1'),
(48, 3, 48, '1', '1', '1', '1'),
(49, 3, 49, '1', '1', '1', '1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
