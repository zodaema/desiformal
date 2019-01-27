-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- โฮสต์: localhost
-- เวลาในการสร้าง: 
-- รุ่นของเซิร์ฟเวอร์: 5.0.51
-- รุ่นของ PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- ฐานข้อมูล: `desiformal`
-- 

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `account`
-- 

CREATE TABLE `account` (
  `userid` int(10) NOT NULL auto_increment,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY  (`userid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- dump ตาราง `account`
-- 

INSERT INTO `account` VALUES (1, 'zodaema', 'fb2952a88b4332af022491679c59a4cf', 1);

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `portfolio`
-- 

CREATE TABLE `portfolio` (
  `id` int(15) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `client` varchar(100) NOT NULL,
  `link` varchar(200) NOT NULL,
  `smallpic` varchar(100) NOT NULL,
  `fullpic` varchar(100) NOT NULL,
  `dates` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `queue`
-- 

CREATE TABLE `queue` (
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `queue` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `queue`
-- 