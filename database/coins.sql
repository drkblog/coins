-- phpMyAdmin SQL Dump
-- version 4.0.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 07, 2019 at 09:52 PM
-- Server version: 5.1.73
-- PHP Version: 5.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `drk`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`drk`@`localhost` FUNCTION `regex_replace`(pattern VARCHAR(1000),replacement VARCHAR(1000),original VARCHAR(1000)) RETURNS varchar(1000) CHARSET latin1
    DETERMINISTIC
BEGIN 
 DECLARE temp VARCHAR(1000); 
 DECLARE ch VARCHAR(1); 
 DECLARE i INT;
 SET i = 1;
 SET temp = '';
 IF original REGEXP pattern THEN 
  loop_label: LOOP 
   IF i>CHAR_LENGTH(original) THEN
    LEAVE loop_label;  
   END IF;
   SET ch = SUBSTRING(original,i,1);
   IF NOT ch REGEXP pattern THEN
    SET temp = CONCAT(temp,ch);
   ELSE
    SET temp = CONCAT(temp,replacement);
   END IF;
   SET i=i+1;
  END LOOP;
 ELSE
  SET temp = original;
 END IF;
 RETURN temp;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `coin_acos`
--

CREATE TABLE IF NOT EXISTS `coin_acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=65 ;

-- --------------------------------------------------------

--
-- Table structure for table `coin_aros`
--

CREATE TABLE IF NOT EXISTS `coin_aros` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `coin_aros_acos`
--

CREATE TABLE IF NOT EXISTS `coin_aros_acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `aro_id` int(10) NOT NULL,
  `aco_id` int(10) NOT NULL,
  `_create` varchar(2) COLLATE utf8_spanish2_ci NOT NULL DEFAULT '0',
  `_read` varchar(2) COLLATE utf8_spanish2_ci NOT NULL DEFAULT '0',
  `_update` varchar(2) COLLATE utf8_spanish2_ci NOT NULL DEFAULT '0',
  `_delete` varchar(2) COLLATE utf8_spanish2_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ARO_ACO_KEY` (`aro_id`,`aco_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=50 ;

-- --------------------------------------------------------

--
-- Table structure for table `coin_coins`
--

CREATE TABLE IF NOT EXISTS `coin_coins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `type_id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `mint_mark` varchar(10) CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL,
  `grade_id` int(11) NOT NULL,
  `comment` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `file_type` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `file_size` int(11) DEFAULT NULL,
  `restored` tinyint(1) NOT NULL DEFAULT '0',
  `cleaned` tinyint(1) NOT NULL DEFAULT '0',
  `dirty` tinyint(1) NOT NULL DEFAULT '0',
  `damaged` tinyint(1) NOT NULL DEFAULT '0',
  `possible_error` tinyint(1) NOT NULL DEFAULT '0',
  `for_sale` tinyint(1) NOT NULL DEFAULT '0',
  `value` decimal(10,2) NOT NULL DEFAULT '0.00',
  `bought_for` decimal(10,2) NOT NULL DEFAULT '0.00',
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `year` (`year`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=714 ;

-- --------------------------------------------------------

--
-- Table structure for table `coin_countries`
--

CREATE TABLE IF NOT EXISTS `coin_countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=210 ;

-- --------------------------------------------------------

--
-- Table structure for table `coin_denominations`
--

CREATE TABLE IF NOT EXISTS `coin_denominations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `value` decimal(6,3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=36 ;

-- --------------------------------------------------------

--
-- Table structure for table `coin_emissions`
--

CREATE TABLE IF NOT EXISTS `coin_emissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `start_year` int(11) NOT NULL,
  `end_year` int(11) DEFAULT NULL,
  `description` text COLLATE utf8_spanish2_ci NOT NULL,
  `country_id` int(11) NOT NULL,
  `territory_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=75 ;

-- --------------------------------------------------------

--
-- Table structure for table `coin_grades`
--

CREATE TABLE IF NOT EXISTS `coin_grades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `acronym` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `position` int(11) NOT NULL,
  `description` text COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `position` (`position`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=33 ;

-- --------------------------------------------------------

--
-- Table structure for table `coin_groups`
--

CREATE TABLE IF NOT EXISTS `coin_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `coin_territories`
--

CREATE TABLE IF NOT EXISTS `coin_territories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `country_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `country_id` (`country_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `coin_types`
--

CREATE TABLE IF NOT EXISTS `coin_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` decimal(10,2) NOT NULL,
  `start_year` int(11) NOT NULL,
  `end_year` int(11) DEFAULT NULL,
  `mint_mark` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `commemorative` tinyint(1) NOT NULL DEFAULT '0',
  `error` tinyint(1) NOT NULL DEFAULT '0',
  `country_id` int(11) NOT NULL,
  `territory_id` int(11) DEFAULT NULL,
  `emission_id` int(11) NOT NULL,
  `denomination_id` int(11) NOT NULL,
  `km` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `comment` text COLLATE utf8_spanish2_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `diameter` decimal(5,2) DEFAULT NULL,
  `weight` decimal(5,2) DEFAULT NULL,
  `thickness` decimal(5,2) DEFAULT NULL,
  `mintage` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `km` (`km`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=586 ;

-- --------------------------------------------------------

--
-- Table structure for table `coin_users`
--

CREATE TABLE IF NOT EXISTS `coin_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `password` char(40) COLLATE utf8_spanish2_ci NOT NULL,
  `group_id` int(11) NOT NULL,
  `public_catalog` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=5 ;
