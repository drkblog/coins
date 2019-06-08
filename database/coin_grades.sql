-- phpMyAdmin SQL Dump
-- version 4.0.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 08, 2019 at 11:04 AM
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
-- Dumping data for table `coin_grades`
--

INSERT INTO `coin_grades` (`id`, `name`, `acronym`, `position`, `description`) VALUES
(1, 'Prueba', 'PROOF', 15, 'Es un método de fabricación, y no un grado de conservación. La acuñación se realiza de manera especial, con cuños especialmente tratados. El proceso de acuñación de este tipo de piezas, es mucho más lento y preciso de lo habitual, en el cual, como mínimo se golpea la misma pieza dos o más veces. Como resultado se obtiene una moneda de gran belleza, con el fondo (campo) espejo y relieves mate. Generalmente hecha para coleccionistas.'),
(2, 'MS-66', 'FDC', 30, 'Mint State: perfect and 100% luster, the highest level on the Sheldon Scale. '),
(12, 'MS-68', 'FDC', 28, 'Mint State: perfect and 100% luster, the highest level on the Sheldon Scale.  '),
(3, 'MS-60', 'UNC', 45, 'Mint State: completely un-circulated condition. Coins in this grade are ugly, dinged-up, bag-marked, ill-toned specimens, but they are in mint condition and free of any wear!'),
(4, 'XF-45', 'XF', 75, '90% of design. Legends and devices are clear and sharp, with slight wear on the high points, and great eye appeal.'),
(5, 'VF-30', 'VF', 90, '75% of design. Legends are clear, devices show all detail with little wear; high points are lightly worn.'),
(26, 'VF-25', 'VF', 91, '75% of design. Clearly readable but lightly worn legends, devices show good detail, rims are clean, but the whole coin shows moderate wear on the high points and a little wear below.'),
(27, 'VF-20', 'VF', 92, '75% of design. Clearly readable but lightly worn legends, devices show good detail, rims are clean, but the whole coin shows moderate wear on the high points and a little wear below.'),
(6, 'F-15', 'F', 105, '50% of design. Distinct rim, all legends readable, clear devices showing some detail, but the whole coin is moderately, but evenly worn.'),
(32, 'FR-2', 'FR', 199, 'Type and date are barely discernable, but otherwise the coin is damaged or extremely worn.'),
(7, 'VG-10', 'VG', 120, '25% of design. Full rim with clearly discernable devices and features. Most legends are readable clearly, but the whole coin is still significantly worn.'),
(8, 'G-6', 'G', 135, 'Good: 10% of design.  Coin has a full rim plus major devices and features are clearly outlined. Heavy wear.'),
(9, 'P-1', 'P', 200, 'Poor: you should guess it is a coin. The type is barely discernable, but little else, due to the coin being badly damaged or worn smooth.'),
(10, 'AU-50', 'AU', 60, '95% of design and some luster. Sharp legends and devices show only a trace of wear on the highest points. There must be some remaining mint luster.'),
(22, 'AU-55', 'AU', 58, '95% of design and some luster. Sharp legends and devices show only a hint of wear on the high points. Remaining mint luster must be at least half; great eye appeal.'),
(11, 'MS-67', 'FDC', 29, 'Mint State: perfect and 100% luster, the highest level on the Sheldon Scale.  '),
(23, 'AU-58', 'AU', 57, '95% of design and some luster. Virtually uncirculated, except for minor wear marks on high points. Nearly all mint luster must be present, and must have outstanding eye appeal.'),
(21, 'AU-53', 'AU', 59, '95% of design and some luster. Sharp legends and devices show only a trace of wear on the highest points. There must be some remaining mint luster.'),
(24, 'XF-40', 'XF', 76, '90% of design. Legends are sharp, devices are clear with slight but obvious wear on the high points.'),
(25, 'VF-35', 'VF', 89, '75% of design. Legends are clear, devices show all detail with little wear; high points are lightly worn.'),
(28, 'F-12', 'F', 106, '50% of design. Distinct rim, all legends readable, clear devices showing some detail, but the whole coin is moderately, but evenly worn.'),
(29, 'VG-8', 'VG', 121, '25% of design.  Full rim with clearly discernable devices and features. Most legends are readable clearly, but the whole coin is still significantly worn.'),
(30, 'G-4', 'G', 136, 'Good: 10% of design. Major devices and features are evident as outlines. although the coin overall is heavily worn.'),
(31, 'AG-3', 'AG', 190, 'About good: Type and date are discernable, although some spots may be worn out. Some lettering should be apparent, if not necessarily readable.'),
(13, 'MS-69', 'FDC', 27, 'Mint State: perfect and 100% luster, the highest level on the Sheldon Scale.'),
(14, 'MS-70', 'FDC', 26, 'Mint State: perfect and 100% luster, the highest level on the Sheldon Scale.'),
(15, 'MS-65', 'BU', 31, 'Mint State: perfect, with luster, the highest level on the Sheldon Scale.'),
(16, 'MS-64', 'BU', 32, 'Mint State: perfect, with luster, the highest level on the Sheldon Scale.'),
(17, 'MS-63', 'BU', 33, 'Mint State: perfect, with luster, the highest level on the Sheldon Scale.'),
(18, 'MS-62', 'BU', 34, 'Mint State: perfect, with luster, the highest level on the Sheldon Scale.'),
(19, 'MS-61', 'BU', 35, 'Mint State: perfect, with luster, the highest level on the Sheldon Scale.');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
