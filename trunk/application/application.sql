-- phpMyAdmin SQL Dump
-- version 2.6.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generato il: 31 Mag, 2008 at 11:20 AM
-- Versione MySQL: 4.1.9
-- Versione PHP: 4.3.10
-- 
-- Database: `ci`
-- 

-- --------------------------------------------------------

-- 
-- Struttura della tabella `ci_blocks`
-- 

CREATE TABLE `ci_blocks` (
  `id` int(11) NOT NULL auto_increment,
  `area` int(11) NOT NULL default '0',
  `theme` varchar(50) NOT NULL default '',
  `weight` tinyint(4) NOT NULL default '0',
  `module` varchar(50) NOT NULL default '',
  `method` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=105 ;

-- 
-- Dump dei dati per la tabella `ci_blocks`
-- 

INSERT INTO `ci_blocks` VALUES (103, 1, 'default', 0, 'blog', 'tag_cloud');
INSERT INTO `ci_blocks` VALUES (102, 1, 'default', 0, 'blog', 'latest_items');


-- --------------------------------------------------------

-- 
-- Struttura della tabella `ci_navigation`
-- 

CREATE TABLE `ci_navigation` (
  `id` int(11) NOT NULL auto_increment,
  `parent_id` int(11) NOT NULL default '0',
  `active` tinyint(1) NOT NULL default '0',
  `weight` int(11) NOT NULL default '0',
  `title` varchar(100) NOT NULL default '',
  `uri` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `active` (`active`),
  KEY `weight` (`weight`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- 
-- Dump dei dati per la tabella `ci_navigation`
-- 

INSERT INTO `ci_navigation` VALUES (1, 0, 1, 1, 'Home', '');
INSERT INTO `ci_navigation` VALUES (3, 0, 1, 3, 'About', 'about');
INSERT INTO `ci_navigation` VALUES (5, 0, 1, 2, 'Blog', 'blog');

-- --------------------------------------------------------

-- 
-- Struttura della tabella `ci_pages`
-- 

CREATE TABLE `ci_pages` (
  `id` int(11) NOT NULL auto_increment,
  `active` tinyint(1) NOT NULL default '0',
  `uri` varchar(40) NOT NULL default '',
  `menu_title` varchar(100) NOT NULL default '',
  `title` varchar(255) NOT NULL default '',
  `meta_keywords` varchar(255) default NULL,
  `meta_description` varchar(255) default NULL,
  `body` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `uri` (`uri`),
  KEY `active` (`active`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- 
-- Dump dei dati per la tabella `ci_pages`
-- 

INSERT INTO `ci_pages` VALUES (1, 1, 'home', 'Home', 'What is a Content Management System?', 'Blaze, CMS', 'Welcome to the Blaze CMS site ...', '<p>A content management system (CMS) is a program used to create a framework for the content of a Web site. CMSes are deployed primarily for interactive use by a potentially large number of contributors. For example, the software for the website Wikipedia is based on a wiki, which is a particular type of content management system. As used in this article, Content Management means Web Content Management. Other related forms of content management are listed below.<br /><br />The content managed includes computer files, image media, audio files, electronic documents and web content. The idea behind a CMS is to make these files available inter-office, as well as over the web. A CMS would most often be used as an archive as well. Many companies use a CMS to store files in a non-proprietary form. Companies use a CMS to share files with ease, as most systems use server-based software, even further broadening file availability. As shown below, many CMSs include a feature for Web Content, and some have a feature for a "workflow process".<br /><br />"Workflow" is the idea of moving an electronic document along for either approval, or for adding content. Some CMSs will easily facilitate this process with email notification, and automated routing. This is ideally a collaborative creation of documents. A CMS facilitates the organization, control, and publication of a large body of documents and other content, such as images and multimedia resources.<br /><br />A Web content management system is a CMS with additional features to ease the tasks required to publish web content to web sites.</p>');
-- --------------------------------------------------------

-- 
-- Struttura della tabella `ci_sessions`
-- 

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL default '0',
  `ip_address` varchar(16) NOT NULL default '0',
  `user_agent` varchar(50) NOT NULL default '',
  `last_activity` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dump dei dati per la tabella `ci_sessions`
-- 


-- --------------------------------------------------------

-- 
-- Struttura della tabella `ci_settings`
-- 

DROP TABLE IF EXISTS `ci_settings`;
CREATE TABLE `ci_settings` (
  `id` tinyint(4) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `value` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- 
-- Dump dei dati per la tabella `ci_settings`
-- 

INSERT INTO `ci_settings` VALUES (1, 'site_name', 'Codeigniter CMS');
INSERT INTO `ci_settings` VALUES (2, 'meta_keywords', 'CMS, CodeIgniter');
INSERT INTO `ci_settings` VALUES (3, 'meta_description', 'Yet another CMS with Codeigniter');
INSERT INTO `ci_settings` VALUES (4, 'cache', '0');
INSERT INTO `ci_settings` VALUES (5, 'cache_time', '300');
INSERT INTO `ci_settings` VALUES (6, 'theme', 'default');
INSERT INTO `ci_settings` VALUES (7, 'template', 'index');
        
-- --------------------------------------------------------

-- 
-- Struttura della tabella `ci_users`
-- 

CREATE TABLE `ci_users` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(30) NOT NULL default '',
  `password` varchar(40) NOT NULL default '',
  `email` varchar(255) NOT NULL default '',
  `status` enum('active','disabled') NOT NULL default 'active',
  PRIMARY KEY  (`id`),
  KEY `username` (`username`),
  KEY `password` (`password`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- Dump dei dati per la tabella `ci_users`
-- 

        