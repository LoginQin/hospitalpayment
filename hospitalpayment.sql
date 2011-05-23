-- phpMyAdmin SQL Dump
-- version 3.3.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 23, 2011 at 06:19 AM
-- Server version: 5.0.90
-- PHP Version: 5.2.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hospitalpayment`
--

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE IF NOT EXISTS `bills` (
  `register_id` int(11) default NULL,
  `time` datetime default NULL,
  `patient_name` varchar(30) default NULL,
  `toll_collector` smallint(6) default NULL,
  `doctor_id` int(11) default NULL,
  `tariffs` varchar(100) default NULL COMMENT '收费项目id集',
  `total_price` float default NULL,
  KEY `time` (`time`),
  KEY `register_id` (`register_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='收费票据表';

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE IF NOT EXISTS `doctors` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(30) default NULL,
  `duty` varchar(30) default NULL,
  `office_id` int(11) default NULL,
  `sign_name` char(32) default NULL COMMENT '登陆名称（可能是工号）',
  `password` char(32) default NULL COMMENT '登陆密码',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `sign_name` (`sign_name`),
  KEY `Index_2` (`name`),
  KEY `FK_offic_doc` (`office_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `doctors_visiting`
--

CREATE TABLE IF NOT EXISTS `doctors_visiting` (
  `id` int(11) default NULL COMMENT '挂号id',
  `doctor_id` int(11) default NULL,
  `name` varchar(30) default NULL COMMENT '患者姓名',
  `illness` text,
  `prescription_id` int(11) default NULL,
  `time` datetime default NULL COMMENT '就诊时间',
  KEY `Index_3` (`name`),
  KEY `FK_docvisiting_doc` (`doctor_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='就诊表';

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE IF NOT EXISTS `medicines` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(12) default NULL,
  `price` float default NULL,
  `remaining_count` int(11) unsigned default NULL COMMENT '剩余数量',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='药品信息' AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `offices`
--

CREATE TABLE IF NOT EXISTS `offices` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(30) default NULL,
  `category` varchar(10) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='科室' AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE IF NOT EXISTS `patients` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(30) NOT NULL,
  `gender` set('男','女') NOT NULL default '男' COMMENT '性别',
  `age` smallint(6) unsigned NOT NULL COMMENT '年龄',
  `illness` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='病人表' AUTO_INCREMENT=10073 ;

-- --------------------------------------------------------

--
-- Table structure for table `prescribes`
--

CREATE TABLE IF NOT EXISTS `prescribes` (
  `id` int(11) NOT NULL auto_increment,
  `register_id` smallint(6) default NULL COMMENT '挂号ID',
  `patient_name` varchar(30) default NULL COMMENT '病人名称',
  `doctor_name` varchar(30) default NULL COMMENT '医生姓名',
  `medicine` varchar(50) default NULL COMMENT '处方',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='处方表' AUTO_INCREMENT=22 ;

-- --------------------------------------------------------

--
-- Table structure for table `registers`
--

CREATE TABLE IF NOT EXISTS `registers` (
  `id` int(11) NOT NULL auto_increment,
  `patient_id` int(11) default NULL COMMENT '挂号病人',
  `patient_name` varchar(32) default NULL,
  `price` float default NULL COMMENT '实收挂号价钱',
  `time` datetime default NULL COMMENT '挂号时间',
  `user_id` int(11) default NULL COMMENT '经手人id',
  `username` varchar(30) default NULL COMMENT '经手人姓名',
  `state` tinyint(3) unsigned NOT NULL COMMENT '状态0未处理1处理',
  PRIMARY KEY  (`id`),
  KEY `time` (`time`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='挂号表' AUTO_INCREMENT=47 ;

-- --------------------------------------------------------

--
-- Table structure for table `takemedicines`
--

CREATE TABLE IF NOT EXISTS `takemedicines` (
  `id` int(11) NOT NULL auto_increment,
  `prescribe_id` int(11) default NULL,
  `name` varchar(12) character set utf8 default NULL,
  `count` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `prescribe_id` (`prescribe_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=ucs2 COMMENT='取药表' AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `tariff`
--

CREATE TABLE IF NOT EXISTS `tariff` (
  `id` int(11) NOT NULL auto_increment,
  `name` char(32) NOT NULL COMMENT '收费名称',
  `price` float NOT NULL COMMENT '收费价格',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='收费价目表' AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(30) NOT NULL,
  `password` char(32) NOT NULL,
  `power` smallint(6) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=10 ;
