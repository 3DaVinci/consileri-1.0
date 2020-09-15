-- phpMyAdmin SQL Dump
-- version 2.11.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 02, 2009 at 01:59 AM
-- Server version: 4.1.25
-- PHP Version: 5.2.8


SET NAMES utf8;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `dacons_ads`
--

DROP TABLE IF EXISTS `dacons_ads`;
CREATE TABLE IF NOT EXISTS `dacons_ads` (
  `id` int(11) NOT NULL auto_increment,
  `text` text NOT NULL,
  `link` text NOT NULL,
  `hits` int(11) NOT NULL default '0',
  `clicks` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `dacons_ads`
--


-- --------------------------------------------------------

--
-- Table structure for table `dacons_cities`
--

DROP TABLE IF EXISTS `dacons_cities`;
CREATE TABLE IF NOT EXISTS `dacons_cities` (
  `id` int(11) NOT NULL auto_increment,
  `name` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=257 ;

--
-- Dumping data for table `dacons_cities`
--


-- --------------------------------------------------------

--
-- Table structure for table `dacons_companies`
--

DROP TABLE IF EXISTS `dacons_companies`;
CREATE TABLE IF NOT EXISTS `dacons_companies` (
  `id` int(11) NOT NULL auto_increment,
  `name` text,
  `site` text,
  `email` text,
  `isClient` int(1) default NULL,
  `manager` int(11) default NULL,
  `relations` int(2) default NULL,
  `phone` text,
  `address` text,
  `city_id` int(10) default NULL,
  `viewed` int(11) default '0',
  `viewed_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `about` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `manager` (`manager`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16309 ;

--
-- Dumping data for table `dacons_companies`
--

-- --------------------------------------------------------

--
-- Table structure for table `dacons_companies_labels`
--

DROP TABLE IF EXISTS `dacons_companies_labels`;
CREATE TABLE IF NOT EXISTS `dacons_companies_labels` (
  `company_id` int(11) NOT NULL default '0',
  `label_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`company_id`,`label_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dacons_companies_labels`
--

-- --------------------------------------------------------

--
-- Table structure for table `dacons_company_properties`
--

DROP TABLE IF EXISTS `dacons_company_properties`;
CREATE TABLE IF NOT EXISTS `dacons_company_properties` (
  `id` int(11) NOT NULL auto_increment,
  `INN` varchar(12) default NULL,
  `KPP` varchar(11) default NULL,
  `settlementAccount` varchar(22) default NULL,
  `bank` text,
  `BIK` varchar(11) default NULL,
  `account` varchar(22) default NULL,
  `OKPO` varchar(10) default NULL,
  `OKONH` varchar(7) default NULL,
  `OGRN` varchar(15) default NULL,
  `OKVED` varchar(7) default NULL,
  `additionalText` text,
  `company_id` int(11) default NULL,
  `cname` text NOT NULL,
  `director` text NOT NULL,
  `address` text NOT NULL,
  `num` smallint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16372 ;

--
-- Dumping data for table `dacons_company_properties`
--

-- --------------------------------------------------------

--
-- Table structure for table `dacons_customers`
--

DROP TABLE IF EXISTS `dacons_customers`;
CREATE TABLE IF NOT EXISTS `dacons_customers` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(25) default NULL,
  `GMT` tinyint(2) NOT NULL default '0',
  `master` tinyint(1) NOT NULL default '0',
  `reg_date` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=313 ;

--
-- Dumping data for table `dacons_customers`
--

INSERT INTO `dacons_customers` (`id`, `name`, `GMT`, `master`, `reg_date`) VALUES
(312, 'Ваша компания', 3, 0, '2008-10-09 16:15:16');

-- --------------------------------------------------------

--
-- Table structure for table `dacons_desktop`
--

DROP TABLE IF EXISTS `dacons_desktop`;
CREATE TABLE IF NOT EXISTS `dacons_desktop` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `window` varchar(50) default NULL,
  `x` int(10) default NULL,
  `y` int(10) default NULL,
  `text` text,
  `user` int(10) unsigned default NULL,
  `fixed` int(1) unsigned default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `dacons_desktop`
--


-- --------------------------------------------------------

--
-- Table structure for table `dacons_events`
--

DROP TABLE IF EXISTS `dacons_events`;
CREATE TABLE IF NOT EXISTS `dacons_events` (
  `id` int(11) NOT NULL auto_increment,
  `date` datetime default '0000-00-00 00:00:00',
  `name` text,
  `comment` text,
  `company_id` int(10) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20912 ;

--
-- Dumping data for table `dacons_events`
--

-- --------------------------------------------------------

--
-- Table structure for table `dacons_export_pendingdata`
--

DROP TABLE IF EXISTS `dacons_export_pendingdata`;
CREATE TABLE IF NOT EXISTS `dacons_export_pendingdata` (
  `customer_id` int(11) NOT NULL default '0',
  `ids` text NOT NULL,
  PRIMARY KEY  (`customer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dacons_export_pendingdata`
--


-- --------------------------------------------------------

--
-- Table structure for table `dacons_export_status`
--

DROP TABLE IF EXISTS `dacons_export_status`;
CREATE TABLE IF NOT EXISTS `dacons_export_status` (
  `customer_id` int(11) NOT NULL default '0',
  `status` enum('none','panding','done') NOT NULL default 'none',
  `email` text,
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `date_next` datetime NOT NULL default '0000-00-00 00:00:00',
  `date_old` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`customer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dacons_export_status`
--


-- --------------------------------------------------------

--
-- Table structure for table `dacons_favorite_companies`
--

DROP TABLE IF EXISTS `dacons_favorite_companies`;
CREATE TABLE IF NOT EXISTS `dacons_favorite_companies` (
  `company_id` int(11) NOT NULL default '0',
  `user_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`company_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dacons_favorite_companies`
--


-- --------------------------------------------------------

--
-- Table structure for table `dacons_forummessages`
--

DROP TABLE IF EXISTS `dacons_forummessages`;
CREATE TABLE IF NOT EXISTS `dacons_forummessages` (
  `id` int(11) NOT NULL auto_increment,
  `topic_id` int(11) NOT NULL default '0',
  `text` text NOT NULL,
  `date` datetime default '0000-00-00 00:00:00',
  `user_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `topic_id` (`topic_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=78 ;

--
-- Dumping data for table `dacons_forummessages`
--


-- --------------------------------------------------------

--
-- Table structure for table `dacons_forumtopics`
--

DROP TABLE IF EXISTS `dacons_forumtopics`;
CREATE TABLE IF NOT EXISTS `dacons_forumtopics` (
  `id` int(11) NOT NULL auto_increment,
  `name` text NOT NULL,
  `desc` text NOT NULL,
  `created` timestamp NOT NULL default '0000-00-00 00:00:00',
  `user_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `dacons_forumtopics`
--


-- --------------------------------------------------------

--
-- Table structure for table `dacons_groups`
--

DROP TABLE IF EXISTS `dacons_groups`;
CREATE TABLE IF NOT EXISTS `dacons_groups` (
  `id` int(11) NOT NULL auto_increment,
  `name` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `dacons_groups`
--


-- --------------------------------------------------------

--
-- Table structure for table `dacons_groups_rights`
--

DROP TABLE IF EXISTS `dacons_groups_rights`;
CREATE TABLE IF NOT EXISTS `dacons_groups_rights` (
  `id` int(11) NOT NULL auto_increment,
  `group_id` int(11) default NULL,
  `right_id` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `dacons_groups_rights`
--


-- --------------------------------------------------------

--
-- Table structure for table `dacons_history`
--

DROP TABLE IF EXISTS `dacons_history`;
CREATE TABLE IF NOT EXISTS `dacons_history` (
  `id` int(11) NOT NULL auto_increment,
  `company_id` int(11) default NULL,
  `updated` datetime default '0000-00-00 00:00:00',
  `user_id` int(11) default NULL,
  `locked` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41422 ;

--
-- Dumping data for table `dacons_history`
--


-- --------------------------------------------------------

--
-- Table structure for table `dacons_labels`
--

DROP TABLE IF EXISTS `dacons_labels`;
CREATE TABLE IF NOT EXISTS `dacons_labels` (
  `id` int(11) NOT NULL auto_increment,
  `name` text,
  `parent_id` int(11) NOT NULL default '0',
  `customer_id` int(11) NOT NULL default '0',
  `picture` varchar(20) NOT NULL default '',
  `viewed` int(11) NOT NULL default '0',
  `viewed_date` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7880 ;

--
-- Dumping data for table `dacons_labels`
--

INSERT INTO `dacons_labels` (`id`, `name`, `parent_id`, `customer_id`, `picture`, `viewed`, `viewed_date`) VALUES
(7851, 'ABC-анализ', 0, 312, 'label0.jpg', 0, '0000-00-00 00:00:00'),
(7852, 'A', 7851, 312, 'label0.jpg', 1, '2008-11-11 14:36:32'),
(7853, 'B', 7851, 312, 'label0.jpg', 0, '0000-00-00 00:00:00'),
(7854, 'C', 7851, 312, 'label0.jpg', 0, '0000-00-00 00:00:00'),
(7855, 'Тип клиента', 0, 312, 'label0.jpg', 0, '0000-00-00 00:00:00'),
(7856, 'Перспективный', 7855, 312, 'label0.jpg', 1, '2008-11-11 14:36:35'),
(7857, 'Пустышка', 7855, 312, 'label0.jpg', 0, '0000-00-00 00:00:00'),
(7858, 'Постоянный', 7855, 312, 'label0.jpg', 0, '0000-00-00 00:00:00'),
(7859, 'Имиджевый', 7855, 312, 'label0.jpg', 0, '0000-00-00 00:00:00'),
(7860, 'Прибыльный', 7855, 312, 'label0.jpg', 0, '0000-00-00 00:00:00'),
(7861, 'Отрасль', 0, 312, 'label0.jpg', 0, '0000-00-00 00:00:00'),
(7862, 'Реклама', 7861, 312, 'label0.jpg', 0, '0000-00-00 00:00:00'),
(7863, 'Недвижимость', 7861, 312, 'label0.jpg', 0, '0000-00-00 00:00:00'),
(7864, 'Услуги', 7861, 312, 'label0.jpg', 0, '0000-00-00 00:00:00'),
(7865, 'Продукты питания', 7861, 312, 'label0.jpg', 0, '0000-00-00 00:00:00'),
(7866, 'Промышленность', 7861, 312, 'label0.jpg', 0, '0000-00-00 00:00:00'),
(7867, 'Кроме клиентов', 0, 312, 'label0.jpg', 0, '0000-00-00 00:00:00'),
(7868, 'Партнеры', 7867, 312, 'label0.jpg', 0, '0000-00-00 00:00:00'),
(7869, 'Подрядчики', 7867, 312, 'label0.jpg', 0, '0000-00-00 00:00:00'),
(7870, 'Поставщики', 7867, 312, 'label0.jpg', 0, '0000-00-00 00:00:00'),
(7871, 'Конкуренты', 7867, 312, 'label0.jpg', 0, '0000-00-00 00:00:00'),
(7872, 'Откуда клиент', 0, 312, 'label0.jpg', 0, '0000-00-00 00:00:00'),
(7873, 'Партнеры', 7872, 312, 'label0.jpg', 0, '0000-00-00 00:00:00'),
(7874, 'Подрядчики', 7872, 312, 'label0.jpg', 0, '0000-00-00 00:00:00'),
(7875, 'Поставщики', 7872, 312, 'label0.jpg', 0, '0000-00-00 00:00:00'),
(7876, 'Конкуренты', 7872, 312, 'label0.jpg', 0, '0000-00-00 00:00:00'),
(7877, 'Отношения', 0, 312, 'label0.jpg', 0, '0000-00-00 00:00:00'),
(7878, ':-)', 7877, 312, 'label0.jpg', 0, '0000-00-00 00:00:00'),
(7879, ':-(', 7877, 312, 'label0.jpg', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `dacons_loginwaiting`
--

DROP TABLE IF EXISTS `dacons_loginwaiting`;
CREATE TABLE IF NOT EXISTS `dacons_loginwaiting` (
  `ip` varchar(15) NOT NULL default '',
  `count` int(11) NOT NULL default '0',
  `endBlocking` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dacons_loginwaiting`
--


-- --------------------------------------------------------

--
-- Table structure for table `dacons_mreminders`
--

DROP TABLE IF EXISTS `dacons_mreminders`;
CREATE TABLE IF NOT EXISTS `dacons_mreminders` (
  `id` int(11) NOT NULL auto_increment,
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `text` text NOT NULL,
  `customer_id` int(11) NOT NULL default '0',
  `company_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=364 ;

--
-- Dumping data for table `dacons_mreminders`
--


-- --------------------------------------------------------

--
-- Table structure for table `dacons_mreminders_companies`
--

DROP TABLE IF EXISTS `dacons_mreminders_companies`;
CREATE TABLE IF NOT EXISTS `dacons_mreminders_companies` (
  `customer_id` int(11) NOT NULL default '0',
  `company_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`customer_id`,`company_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dacons_mreminders_companies`
--


-- --------------------------------------------------------

--
-- Table structure for table `dacons_people`
--

DROP TABLE IF EXISTS `dacons_people`;
CREATE TABLE IF NOT EXISTS `dacons_people` (
  `id` int(11) NOT NULL auto_increment,
  `fio` text,
  `email` text,
  `comment` text,
  `phone` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=57766 ;

--
-- Dumping data for table `dacons_people`
--

-- --------------------------------------------------------

--
-- Table structure for table `dacons_people_company`
--

DROP TABLE IF EXISTS `dacons_people_company`;
CREATE TABLE IF NOT EXISTS `dacons_people_company` (
  `id` int(11) NOT NULL auto_increment,
  `person_id` int(11) default NULL,
  `company_id` int(11) default NULL,
  `appointment` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=57766 ;

--
-- Dumping data for table `dacons_people_company`
--

-- --------------------------------------------------------

--
-- Table structure for table `dacons_people_event`
--

DROP TABLE IF EXISTS `dacons_people_event`;
CREATE TABLE IF NOT EXISTS `dacons_people_event` (
  `id` int(11) NOT NULL auto_increment,
  `person_id` int(11) NOT NULL default '0',
  `event_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `dacons_people_event`
--


-- --------------------------------------------------------

--
-- Table structure for table `dacons_phones`
--

DROP TABLE IF EXISTS `dacons_phones`;
CREATE TABLE IF NOT EXISTS `dacons_phones` (
  `id` int(11) NOT NULL auto_increment,
  `phone` text,
  `type` int(1) default NULL,
  `comment` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `dacons_phones`
--


-- --------------------------------------------------------

--
-- Table structure for table `dacons_phones_companies`
--

DROP TABLE IF EXISTS `dacons_phones_companies`;
CREATE TABLE IF NOT EXISTS `dacons_phones_companies` (
  `id` int(11) NOT NULL auto_increment,
  `phone_id` int(11) default NULL,
  `company_id` int(11) default NULL,
  `person_id` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `dacons_phones_companies`
--


-- --------------------------------------------------------

--
-- Table structure for table `dacons_phone_type`
--

DROP TABLE IF EXISTS `dacons_phone_type`;
CREATE TABLE IF NOT EXISTS `dacons_phone_type` (
  `id` int(11) NOT NULL auto_increment,
  `name` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `dacons_phone_type`
--


-- --------------------------------------------------------

--
-- Table structure for table `dacons_reminders`
--

DROP TABLE IF EXISTS `dacons_reminders`;
CREATE TABLE IF NOT EXISTS `dacons_reminders` (
  `id` int(11) NOT NULL auto_increment,
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `text` text NOT NULL,
  `user_id` int(11) NOT NULL default '0',
  `company_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1722 ;

--
-- Dumping data for table `dacons_reminders`
--


-- --------------------------------------------------------

--
-- Table structure for table `dacons_reminderspool`
--

DROP TABLE IF EXISTS `dacons_reminderspool`;
CREATE TABLE IF NOT EXISTS `dacons_reminderspool` (
  `id` int(11) NOT NULL auto_increment,
  `text` text NOT NULL,
  `company_id` int(11) NOT NULL default '0',
  `date` datetime NOT NULL default '2000-01-01 00:00:00',
  `manager_id` int(11) NOT NULL default '0',
  `visibility` enum('sm','own','common') NOT NULL default 'own',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2558 ;

--
-- Dumping data for table `dacons_reminderspool`
--

-- --------------------------------------------------------

--
-- Table structure for table `dacons_reminders_companies`
--

DROP TABLE IF EXISTS `dacons_reminders_companies`;
CREATE TABLE IF NOT EXISTS `dacons_reminders_companies` (
  `user_id` int(11) NOT NULL default '0',
  `company_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`user_id`,`company_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dacons_reminders_companies`
--


-- --------------------------------------------------------

--
-- Table structure for table `dacons_rights`
--

DROP TABLE IF EXISTS `dacons_rights`;
CREATE TABLE IF NOT EXISTS `dacons_rights` (
  `id` int(11) NOT NULL auto_increment,
  `name` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `dacons_rights`
--


-- --------------------------------------------------------

--
-- Table structure for table `dacons_sendemails`
--

DROP TABLE IF EXISTS `dacons_sendemails`;
CREATE TABLE IF NOT EXISTS `dacons_sendemails` (
  `id` int(11) NOT NULL auto_increment,
  `subject` text NOT NULL,
  `email` text NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=178 ;

--
-- Dumping data for table `dacons_sendemails`
--


-- --------------------------------------------------------

--
-- Table structure for table `dacons_stats`
--

DROP TABLE IF EXISTS `dacons_stats`;
CREATE TABLE IF NOT EXISTS `dacons_stats` (
  `date` date NOT NULL default '0000-00-00',
  `weekNum` int(11) NOT NULL default '0',
  `year` varchar(4) NOT NULL default '',
  `registrations` int(11) NOT NULL default '0',
  `pages` int(11) NOT NULL default '0',
  PRIMARY KEY  (`date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



-- --------------------------------------------------------

--
-- Table structure for table `dacons_statsbycompanies`
--

DROP TABLE IF EXISTS `dacons_statsbycompanies`;
CREATE TABLE IF NOT EXISTS `dacons_statsbycompanies` (
  `weekNum` int(11) NOT NULL default '0',
  `year` varchar(4) NOT NULL default '0',
  `pages` int(11) NOT NULL default '0',
  `customer_id` int(11) NOT NULL default '0',
  `companies` int(11) NOT NULL default '0',
  PRIMARY KEY  (`weekNum`,`year`,`customer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Table structure for table `dacons_users`
--

DROP TABLE IF EXISTS `dacons_users`;
CREATE TABLE IF NOT EXISTS `dacons_users` (
  `id` int(11) NOT NULL auto_increment,
  `username` text,
  `password` text,
  `nickname` text,
  `customer_id` int(11) NOT NULL default '0',
  `email` text,
  `subscribed` enum('0','1') NOT NULL default '0',
  `is_super_user` int(1) NOT NULL default '0',
  `is_admin` int(1) NOT NULL default '0',
  `readonly` int(1) NOT NULL default '0',
  `location` int(11) NOT NULL default '0',
  `location_exp` datetime NOT NULL default '0000-00-00 00:00:00',
  `help` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=502;

--
-- Dumping data for table `dacons_users`
--

INSERT INTO `dacons_users` (`id`, `username`, `password`, `nickname`, `customer_id`, `email`, `subscribed`, `is_super_user`, `is_admin`, `readonly`, `location`, `location_exp`, `help`) VALUES
(499, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'Администратор', 312, '', '0', 1, 1, 0, 0, '0000-00-00 00:00:00', 'a:16:{i:1;b:1;i:2;b:1;i:3;b:0;i:4;b:0;i:5;b:0;i:6;b:0;i:7;b:0;i:8;b:1;i:9;b:1;i:10;b:1;i:11;b:1;i:12;b:0;i:13;b:0;i:14;b:1;i:15;b:1;i:0;b:1;}');

DROP TABLE IF EXISTS `dacons_uploads`;
CREATE TABLE `dacons_uploads` (
  `id` int(11) NOT NULL auto_increment,
  `original_name` text NOT NULL,
  `filename` text NOT NULL,
  `company_id` int(11) NOT NULL,
  `comment` text,
  `size` text NOT NULL,
  `type` int(11) NOT NULL default '0',
  `date` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251;
