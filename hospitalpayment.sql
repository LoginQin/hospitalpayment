-- phpMyAdmin SQL Dump
-- version 3.3.7
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2011 年 05 月 16 日 11:51
-- 服务器版本: 5.0.90
-- PHP 版本: 5.2.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `hospitalpayment`
--

-- --------------------------------------------------------

--
-- 表的结构 `bills`
--

CREATE TABLE IF NOT EXISTS `bills` (
  `register_id` int(11) default NULL,
  `time` datetime default NULL,
  `patient_name` varchar(30) default NULL,
  `toll_collector` smallint(6) default NULL,
  `doctor_id` int(11) default NULL,
  `total_price` float default NULL,
  KEY `time` (`time`),
  KEY `register_id` (`register_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='收费票据表';

--
-- 转存表中的数据 `bills`
--

INSERT INTO `bills` (`register_id`, `time`, `patient_name`, `toll_collector`, `doctor_id`, `total_price`) VALUES
(38, '2011-05-16 19:44:35', NULL, 0, NULL, 50),
(37, '2011-05-16 19:38:33', NULL, 0, NULL, 50),
(36, '2011-05-16 19:19:32', NULL, 0, NULL, 50);

-- --------------------------------------------------------

--
-- 表的结构 `doctors`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `doctors`
--

INSERT INTO `doctors` (`id`, `name`, `duty`, `office_id`, `sign_name`, `password`) VALUES
(1, 'login', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `doctors_visiting`
--

CREATE TABLE IF NOT EXISTS `doctors_visiting` (
  `id` int(11) NOT NULL default '0' COMMENT '挂号id',
  `doctor_id` int(11) default NULL,
  `name` varchar(30) character set latin1 default NULL,
  `illness` text character set latin1,
  `prescription_id` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `Index_3` (`name`),
  KEY `FK_docvisiting_doc` (`doctor_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='就诊表';

--
-- 转存表中的数据 `doctors_visiting`
--

INSERT INTO `doctors_visiting` (`id`, `doctor_id`, `name`, `illness`, `prescription_id`) VALUES
(1, NULL, 'login', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `medicines`
--

CREATE TABLE IF NOT EXISTS `medicines` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(12) default NULL,
  `price` float default NULL,
  `remaining_count` int(11) default NULL COMMENT '剩余数量',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='药品信息' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `medicines`
--

INSERT INTO `medicines` (`id`, `name`, `price`, `remaining_count`) VALUES
(2, 'Lo', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `offices`
--

CREATE TABLE IF NOT EXISTS `offices` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(30) default NULL,
  `category` varchar(10) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='科室' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `offices`
--


-- --------------------------------------------------------

--
-- 表的结构 `patients`
--

CREATE TABLE IF NOT EXISTS `patients` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(30) NOT NULL,
  `gender` set('男','女') NOT NULL default '男' COMMENT '性别',
  `age` smallint(6) NOT NULL COMMENT '年龄',
  `illness` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='病人表' AUTO_INCREMENT=10067 ;

--
-- 转存表中的数据 `patients`
--

INSERT INTO `patients` (`id`, `name`, `gender`, `age`, `illness`) VALUES
(10066, 'AAAA', '男', 25, ''),
(10065, 'LoginDL', '女', 3, ''),
(10064, '王志明', '男', 23, '');

-- --------------------------------------------------------

--
-- 表的结构 `prescribes`
--

CREATE TABLE IF NOT EXISTS `prescribes` (
  `id` int(11) NOT NULL auto_increment,
  `register_id` smallint(6) default NULL COMMENT '挂号ID',
  `patient_name` varchar(30) default NULL COMMENT '病人名称',
  `doctor_name` varchar(30) default NULL COMMENT '医生姓名',
  `medicine` varchar(50) default NULL COMMENT '处方',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='处方表' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `prescribes`
--


-- --------------------------------------------------------

--
-- 表的结构 `registers`
--

CREATE TABLE IF NOT EXISTS `registers` (
  `id` int(11) NOT NULL auto_increment,
  `patient_id` int(11) default NULL COMMENT '挂号病人',
  `patient_name` varchar(32) default NULL,
  `price` float default NULL COMMENT '实收挂号价钱',
  `time` datetime default NULL COMMENT '挂号时间',
  `user_id` int(11) default NULL COMMENT '经手人id',
  `username` varchar(30) default NULL COMMENT '经手人姓名',
  PRIMARY KEY  (`id`),
  KEY `time` (`time`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='挂号表' AUTO_INCREMENT=39 ;

--
-- 转存表中的数据 `registers`
--

INSERT INTO `registers` (`id`, `patient_id`, `patient_name`, `price`, `time`, `user_id`, `username`) VALUES
(38, 10066, 'AAAA', 50, '2011-05-16 19:44:35', 1, 'Login'),
(37, 10065, 'LoginDL', 50, '2011-05-16 19:38:33', 2, 'Qin'),
(36, 10064, '王志明', 50, '2011-05-16 19:19:32', 2, 'Qin');

-- --------------------------------------------------------

--
-- 表的结构 `takemedicines`
--

CREATE TABLE IF NOT EXISTS `takemedicines` (
  `id` int(11) NOT NULL auto_increment,
  `prescribe_id` int(11) default NULL,
  `name` varchar(12) character set utf8 default NULL,
  `count` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `prescribe_id` (`prescribe_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=ucs2 COMMENT='取药表' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `takemedicines`
--


-- --------------------------------------------------------

--
-- 表的结构 `tariff`
--

CREATE TABLE IF NOT EXISTS `tariff` (
  `id` int(11) NOT NULL auto_increment,
  `name` char(32) NOT NULL COMMENT '收费名称',
  `price` float NOT NULL COMMENT '收费价格',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='收费价目表' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `tariff`
--

INSERT INTO `tariff` (`id`, `name`, `price`) VALUES
(2, '挂号', 50),
(3, 'B超', 100);

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(30) NOT NULL,
  `password` char(32) NOT NULL,
  `power` smallint(6) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `power`) VALUES
(1, 'Login', '123', 2),
(2, 'Qin', '123', 0),
(3, 'Qin', '123', 2),
(4, 'Edit2', 'Edit3', 2),
(5, '中文', 'Edit3', 2),
(6, 'Edit2', 'Edit3', 2),
(7, 'Edit2', 'Edit3', 2),
(8, 'Edit2', 'Edit3', 2),
(9, 'Qin', '123', 0);
