-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Ago 06, 2010 as 06:17 PM
-- Versão do Servidor: 5.1.36
-- Versão do PHP: 5.2.11

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `eprofissionalizando`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_banner`
--

CREATE TABLE IF NOT EXISTS `jos_banner` (
  `bid` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL DEFAULT '0',
  `type` varchar(90) NOT NULL DEFAULT 'banner',
  `name` text NOT NULL,
  `alias` varchar(255) NOT NULL DEFAULT '',
  `imptotal` int(11) NOT NULL DEFAULT '0',
  `impmade` int(11) NOT NULL DEFAULT '0',
  `clicks` int(11) NOT NULL DEFAULT '0',
  `imageurl` varchar(100) NOT NULL DEFAULT '',
  `clickurl` varchar(200) NOT NULL DEFAULT '',
  `date` datetime DEFAULT NULL,
  `showBanner` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `editor` varchar(150) DEFAULT NULL,
  `custombannercode` text,
  `catid` int(10) unsigned NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `sticky` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tags` text NOT NULL,
  `params` text NOT NULL,
  PRIMARY KEY (`bid`),
  KEY `viewbanner` (`showBanner`),
  KEY `idx_banner_catid` (`catid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `jos_banner`
--

INSERT INTO `jos_banner` (`bid`, `cid`, `type`, `name`, `alias`, `imptotal`, `impmade`, `clicks`, `imageurl`, `clickurl`, `date`, `showBanner`, `checked_out`, `checked_out_time`, `editor`, `custombannercode`, `catid`, `description`, `sticky`, `ordering`, `publish_up`, `publish_down`, `tags`, `params`) VALUES
(1, 1, 'banner', 'OSM 1', 'osm-1', 0, 43, 0, 'osmbanner1.png', 'http://www.opensourcematters.org', '2004-07-07 15:31:29', 1, 0, '0000-00-00 00:00:00', '', '', 13, '', 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
(2, 1, 'banner', 'OSM 2', 'osm-2', 0, 49, 0, 'osmbanner2.png', 'http://www.opensourcematters.org', '2004-07-07 15:31:29', 1, 0, '0000-00-00 00:00:00', '', '', 13, '', 0, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_bannerclient`
--

CREATE TABLE IF NOT EXISTS `jos_bannerclient` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `contact` text NOT NULL,
  `email` varchar(255) NOT NULL DEFAULT '',
  `extrainfo` text NOT NULL,
  `checked_out` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out_time` time DEFAULT NULL,
  `editor` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `jos_bannerclient`
--

INSERT INTO `jos_bannerclient` (`cid`, `name`, `contact`, `email`, `extrainfo`, `checked_out`, `checked_out_time`, `editor`) VALUES
(1, 'Open Source Matters', 'Administrator', 'admin@opensourcematters.org', '', 0, '00:00:00', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_bannertrack`
--

CREATE TABLE IF NOT EXISTS `jos_bannertrack` (
  `track_date` date NOT NULL,
  `track_type` int(10) unsigned NOT NULL,
  `banner_id` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jos_bannertrack`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_categories`
--

CREATE TABLE IF NOT EXISTS `jos_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `title` text NOT NULL,
  `name` text NOT NULL,
  `alias` varchar(255) NOT NULL DEFAULT '',
  `image` varchar(255) NOT NULL DEFAULT '',
  `section` varchar(150) NOT NULL DEFAULT '',
  `image_position` varchar(90) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `editor` varchar(150) DEFAULT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `count` int(11) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cat_idx` (`section`,`published`,`access`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Extraindo dados da tabela `jos_categories`
--

INSERT INTO `jos_categories` (`id`, `parent_id`, `title`, `name`, `alias`, `image`, `section`, `image_position`, `description`, `published`, `checked_out`, `checked_out_time`, `editor`, `ordering`, `access`, `count`, `params`) VALUES
(2, 0, 'Joomla! Specific Links', '', 'joomla-specific-links', 'clock.jpg', 'com_weblinks', 'left', 'A selection of links that are all related to the Joomla! Project.', 1, 0, '0000-00-00 00:00:00', NULL, 1, 0, 0, ''),
(4, 0, 'Joomla!', '', 'joomla', '', 'com_newsfeeds', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 2, 0, 0, ''),
(5, 0, 'General', '', 'general', '', 'com_newsfeeds', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 6, 0, 0, ''),
(6, 0, 'Linux', '', 'linux', '', 'com_newsfeeds', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 1, 0, 0, ''),
(12, 0, 'Contacts', '', 'contacts', '', 'com_contact_details', 'left', 'Contact Details for this Web site', 1, 0, '0000-00-00 00:00:00', NULL, 0, 0, 0, ''),
(13, 0, 'Joomla', '', 'joomla', '', 'com_banner', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 0, 0, 0, ''),
(15, 0, 'Features', '', 'features', '', 'com_content', 'left', '', 0, 0, '0000-00-00 00:00:00', NULL, 6, 0, 0, ''),
(17, 0, 'Benefits', '', 'benefits', '', 'com_content', 'left', '', 0, 0, '0000-00-00 00:00:00', NULL, 4, 0, 0, ''),
(18, 0, 'Platforms', '', 'platforms', '', 'com_content', 'left', '', 0, 0, '0000-00-00 00:00:00', NULL, 3, 0, 0, ''),
(19, 0, 'Other Resources', '', 'other-resources', '', 'com_weblinks', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 2, 0, 0, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_components`
--

CREATE TABLE IF NOT EXISTS `jos_components` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL DEFAULT '',
  `link` varchar(255) NOT NULL DEFAULT '',
  `menuid` int(11) unsigned NOT NULL DEFAULT '0',
  `parent` int(11) unsigned NOT NULL DEFAULT '0',
  `admin_menu_link` varchar(255) NOT NULL DEFAULT '',
  `admin_menu_alt` text NOT NULL,
  `option` varchar(50) NOT NULL DEFAULT '',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `admin_menu_img` varchar(255) NOT NULL DEFAULT '',
  `iscore` tinyint(4) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  `enabled` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `parent_option` (`parent`,`option`(32))
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Extraindo dados da tabela `jos_components`
--

INSERT INTO `jos_components` (`id`, `name`, `link`, `menuid`, `parent`, `admin_menu_link`, `admin_menu_alt`, `option`, `ordering`, `admin_menu_img`, `iscore`, `params`, `enabled`) VALUES
(1, 'Banners', '', 0, 0, '', 'Banner Management', 'com_banners', 0, 'js/ThemeOffice/component.png', 0, 'track_impressions=0\ntrack_clicks=0\ntag_prefix=\n\n', 1),
(2, 'Banners', '', 0, 1, 'option=com_banners', 'Active Banners', 'com_banners', 1, 'js/ThemeOffice/edit.png', 0, '', 1),
(3, 'Clients', '', 0, 1, 'option=com_banners&c=client', 'Manage Clients', 'com_banners', 2, 'js/ThemeOffice/categories.png', 0, '', 1),
(4, 'Web Links', 'option=com_weblinks', 0, 0, '', 'Manage Weblinks', 'com_weblinks', 0, 'js/ThemeOffice/component.png', 0, 'show_comp_description=1\ncomp_description=\nshow_link_hits=1\nshow_link_description=1\nshow_other_cats=1\nshow_headings=1\nshow_page_title=1\nlink_target=0\nlink_icons=\n\n', 1),
(5, 'Links', '', 0, 4, 'option=com_weblinks', 'View existing weblinks', 'com_weblinks', 1, 'js/ThemeOffice/edit.png', 0, '', 1),
(6, 'Categories', '', 0, 4, 'option=com_categories&section=com_weblinks', 'Manage weblink categories', '', 2, 'js/ThemeOffice/categories.png', 0, '', 1),
(7, 'Contacts', 'option=com_contact', 0, 0, '', 'Edit contact details', 'com_contact', 0, 'js/ThemeOffice/component.png', 1, 'contact_icons=0\nicon_address=\nicon_email=\nicon_telephone=\nicon_fax=\nicon_misc=\nshow_headings=1\nshow_position=1\nshow_email=0\nshow_telephone=1\nshow_mobile=1\nshow_fax=1\nbannedEmail=\nbannedSubject=\nbannedText=\nsession=1\ncustomReply=0\n\n', 1),
(8, 'Contacts', '', 0, 7, 'option=com_contact', 'Edit contact details', 'com_contact', 0, 'js/ThemeOffice/edit.png', 1, '', 1),
(9, 'Categories', '', 0, 7, 'option=com_categories&section=com_contact_details', 'Manage contact categories', '', 2, 'js/ThemeOffice/categories.png', 1, '', 1),
(10, 'Polls', 'option=com_poll', 0, 0, 'option=com_poll', 'Manage Polls', 'com_poll', 0, 'js/ThemeOffice/component.png', 0, '', 1),
(11, 'News Feeds', 'option=com_newsfeeds', 0, 0, '', 'News Feeds Management', 'com_newsfeeds', 0, 'js/ThemeOffice/component.png', 0, '', 1),
(12, 'Feeds', '', 0, 11, 'option=com_newsfeeds', 'Manage News Feeds', 'com_newsfeeds', 1, 'js/ThemeOffice/edit.png', 0, '', 1),
(13, 'Categories', '', 0, 11, 'option=com_categories&section=com_newsfeeds', 'Manage Categories', '', 2, 'js/ThemeOffice/categories.png', 0, '', 1),
(14, 'User', 'option=com_user', 0, 0, '', '', 'com_user', 0, '', 1, '', 1),
(15, 'Search', 'option=com_search', 0, 0, 'option=com_search', 'Search Statistics', 'com_search', 0, 'js/ThemeOffice/component.png', 1, 'enabled=0\n\n', 1),
(16, 'Categories', '', 0, 1, 'option=com_categories&section=com_banner', 'Categories', '', 3, '', 1, '', 1),
(17, 'Wrapper', 'option=com_wrapper', 0, 0, '', 'Wrapper', 'com_wrapper', 0, '', 1, '', 1),
(18, 'Mail To', '', 0, 0, '', '', 'com_mailto', 0, '', 1, '', 1),
(19, 'Media Manager', '', 0, 0, 'option=com_media', 'Media Manager', 'com_media', 0, '', 1, 'upload_extensions=bmp,csv,doc,epg,gif,ico,jpg,odg,odp,ods,odt,pdf,png,ppt,swf,txt,xcf,xls,BMP,CSV,DOC,EPG,GIF,ICO,JPG,ODG,ODP,ODS,ODT,PDF,PNG,PPT,SWF,TXT,XCF,XLS\nupload_maxsize=10000000\nfile_path=images\nimage_path=images/stories\nrestrict_uploads=1\nallowed_media_usergroup=3\ncheck_mime=1\nimage_extensions=bmp,gif,jpg,png\nignore_extensions=\nupload_mime=image/jpeg,image/gif,image/png,image/bmp,application/x-shockwave-flash,application/msword,application/excel,application/pdf,application/powerpoint,text/plain,application/x-zip\nupload_mime_illegal=text/html\nenable_flash=1\n\n', 1),
(20, 'Articles', 'option=com_content', 0, 0, '', '', 'com_content', 0, '', 1, 'show_noauth=0\nshow_title=1\nlink_titles=1\nshow_intro=1\nshow_section=0\nlink_section=1\nshow_category=0\nlink_category=1\nshow_author=1\nshow_create_date=1\nshow_modify_date=1\nshow_item_navigation=0\nshow_readmore=1\nshow_vote=0\nshow_icons=1\nshow_pdf_icon=1\nshow_print_icon=1\nshow_email_icon=1\nshow_hits=1\nfeed_summary=0\nfilter_groups=29|18|19|20|21|30|23|24\nfilter_type=BL\nfilter_tags=\nfilter_attritbutes=\n\n', 1),
(21, 'Configuration Manager', '', 0, 0, '', 'Configuration', 'com_config', 0, '', 1, '', 1),
(22, 'Installation Manager', '', 0, 0, '', 'Installer', 'com_installer', 0, '', 1, '', 1),
(23, 'Language Manager', '', 0, 0, '', 'Languages', 'com_languages', 0, '', 1, 'site=pt-BR\nadministrator=pt-BR\n\n', 1),
(24, 'Mass mail', '', 0, 0, '', 'Mass Mail', 'com_massmail', 0, '', 1, 'mailSubjectPrefix=\nmailBodySuffix=\n\n', 1),
(25, 'Menu Editor', '', 0, 0, '', 'Menu Editor', 'com_menus', 0, '', 1, '', 1),
(27, 'Messaging', '', 0, 0, '', 'Messages', 'com_messages', 0, '', 1, '', 1),
(28, 'Modules Manager', '', 0, 0, '', 'Modules', 'com_modules', 0, '', 1, '', 1),
(29, 'Plugin Manager', '', 0, 0, '', 'Plugins', 'com_plugins', 0, '', 1, '', 1),
(30, 'Template Manager', '', 0, 0, '', 'Templates', 'com_templates', 0, '', 1, '', 1),
(31, 'User Manager', '', 0, 0, '', 'Users', 'com_users', 0, '', 1, 'allowUserRegistration=0\nnew_usertype=Registered\nuseractivation=1\nfrontend_userparams=1\n\n', 1),
(32, 'Cache Manager', '', 0, 0, '', 'Cache', 'com_cache', 0, '', 1, '', 1),
(33, 'Control Panel', '', 0, 0, '', 'Control Panel', 'com_cpanel', 0, '', 1, '', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_contact_details`
--

CREATE TABLE IF NOT EXISTS `jos_contact_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `alias` varchar(255) NOT NULL DEFAULT '',
  `con_position` text,
  `address` text,
  `suburb` text,
  `state` text,
  `country` text,
  `postcode` varchar(255) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `misc` mediumtext,
  `image` varchar(255) DEFAULT NULL,
  `imagepos` varchar(60) DEFAULT NULL,
  `email_to` varchar(255) DEFAULT NULL,
  `default_con` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `published` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `catid` int(11) NOT NULL DEFAULT '0',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `mobile` varchar(255) NOT NULL DEFAULT '',
  `webpage` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `catid` (`catid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `jos_contact_details`
--

INSERT INTO `jos_contact_details` (`id`, `name`, `alias`, `con_position`, `address`, `suburb`, `state`, `country`, `postcode`, `telephone`, `fax`, `misc`, `image`, `imagepos`, `email_to`, `default_con`, `published`, `checked_out`, `checked_out_time`, `ordering`, `params`, `user_id`, `catid`, `access`, `mobile`, `webpage`) VALUES
(1, 'Name 1', 'name-1', 'Position', 'Street', 'Suburb', 'State', 'Country', 'Zip Code', 'Telephone', 'Fax', 'Miscellanous info', 'articles.jpg', 'top', 'email@email.com', 0, 1, 62, '2008-12-15 15:46:45', 1, 'show_name=1\nshow_position=1\nshow_email=1\nshow_street_address=1\nshow_suburb=1\nshow_state=1\nshow_postcode=1\nshow_country=1\nshow_telephone=1\nshow_mobile=1\nshow_fax=1\nshow_webpage=1\nshow_misc=1\nshow_image=1\nallow_vcard=1\ncontact_icons=0\nicon_address=\nicon_email=\nicon_telephone=\nicon_mobile=\nicon_fax=\nicon_misc=\nshow_email_form=1\nemail_description=1\nshow_email_copy=1\nbanned_email=\nbanned_subject=\nbanned_text=', 0, 12, 0, '', ''),
(2, 'Name 2', 'name-2', '', 'Street Address', 'Town', 'State', 'Country', 'Postal Code', 'Telephone', 'Fax', 'Informations', 'clock.jpg', NULL, '', 0, 1, 0, '0000-00-00 00:00:00', 2, 'show_name=1\nshow_position=1\nshow_email=1\nshow_street_address=1\nshow_suburb=1\nshow_state=1\nshow_postcode=1\nshow_country=1\nshow_telephone=1\nshow_mobile=1\nshow_fax=1\nshow_webpage=1\nshow_misc=1\nshow_image=1\nallow_vcard=1\ncontact_icons=0\nicon_address=\nicon_email=\nicon_telephone=\nicon_mobile=\nicon_fax=\nicon_misc=\nshow_email_form=1\nemail_description=\nshow_email_copy=1\nbanned_email=\nbanned_subject=\nbanned_text=', 0, 12, 0, 'Mobile Phone', 'http://Web URL');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_content`
--

CREATE TABLE IF NOT EXISTS `jos_content` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `alias` varchar(255) NOT NULL DEFAULT '',
  `title_alias` text NOT NULL,
  `introtext` mediumtext NOT NULL,
  `fulltext` mediumtext NOT NULL,
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `sectionid` int(11) unsigned NOT NULL DEFAULT '0',
  `mask` int(11) unsigned NOT NULL DEFAULT '0',
  `catid` int(11) unsigned NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` text NOT NULL,
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `images` text NOT NULL,
  `urls` text NOT NULL,
  `attribs` text NOT NULL,
  `version` int(11) unsigned NOT NULL DEFAULT '1',
  `parentid` int(11) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `access` int(11) unsigned NOT NULL DEFAULT '0',
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  `metadata` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_section` (`sectionid`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`state`),
  KEY `idx_catid` (`catid`),
  KEY `idx_createdby` (`created_by`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=82 ;

--
-- Extraindo dados da tabela `jos_content`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_content_frontpage`
--

CREATE TABLE IF NOT EXISTS `jos_content_frontpage` (
  `content_id` int(11) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`content_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jos_content_frontpage`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_content_rating`
--

CREATE TABLE IF NOT EXISTS `jos_content_rating` (
  `content_id` int(11) NOT NULL DEFAULT '0',
  `rating_sum` int(11) unsigned NOT NULL DEFAULT '0',
  `rating_count` int(11) unsigned NOT NULL DEFAULT '0',
  `lastip` varchar(150) NOT NULL DEFAULT '',
  PRIMARY KEY (`content_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jos_content_rating`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_core_acl_aro`
--

CREATE TABLE IF NOT EXISTS `jos_core_acl_aro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section_value` varchar(240) NOT NULL DEFAULT '0',
  `value` varchar(240) NOT NULL DEFAULT '',
  `order_value` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `hidden` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `__section_value_value_aro` (`section_value`(100),`value`(100)),
  KEY `jos_gacl_hidden_aro` (`hidden`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Extraindo dados da tabela `jos_core_acl_aro`
--

INSERT INTO `jos_core_acl_aro` (`id`, `section_value`, `value`, `order_value`, `name`, `hidden`) VALUES
(10, 'users', '62', 0, 'Administrator', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_core_acl_aro_groups`
--

CREATE TABLE IF NOT EXISTS `jos_core_acl_aro_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `lft` int(11) NOT NULL DEFAULT '0',
  `rgt` int(11) NOT NULL DEFAULT '0',
  `value` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `jos_gacl_parent_id_aro_groups` (`parent_id`),
  KEY `jos_gacl_lft_rgt_aro_groups` (`lft`,`rgt`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Extraindo dados da tabela `jos_core_acl_aro_groups`
--

INSERT INTO `jos_core_acl_aro_groups` (`id`, `parent_id`, `name`, `lft`, `rgt`, `value`) VALUES
(17, 0, 'ROOT', 1, 22, 'ROOT'),
(28, 17, 'USERS', 2, 21, 'USERS'),
(29, 28, 'Public Frontend', 3, 12, 'Public Frontend'),
(18, 29, 'Registered', 4, 11, 'Registered'),
(19, 18, 'Author', 5, 10, 'Author'),
(20, 19, 'Editor', 6, 9, 'Editor'),
(21, 20, 'Publisher', 7, 8, 'Publisher'),
(30, 28, 'Public Backend', 13, 20, 'Public Backend'),
(23, 30, 'Manager', 14, 19, 'Manager'),
(24, 23, 'Administrator', 15, 18, 'Administrator'),
(25, 24, 'Super Administrator', 16, 17, 'Super Administrator');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_core_acl_aro_map`
--

CREATE TABLE IF NOT EXISTS `jos_core_acl_aro_map` (
  `acl_id` int(11) NOT NULL DEFAULT '0',
  `section_value` varchar(230) NOT NULL DEFAULT '0',
  `value` varchar(100) NOT NULL,
  PRIMARY KEY (`acl_id`,`section_value`,`value`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jos_core_acl_aro_map`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_core_acl_aro_sections`
--

CREATE TABLE IF NOT EXISTS `jos_core_acl_aro_sections` (
  `section_id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(230) NOT NULL DEFAULT '',
  `order_value` int(11) NOT NULL DEFAULT '0',
  `name` varchar(230) NOT NULL DEFAULT '',
  `hidden` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`section_id`),
  UNIQUE KEY `jos_gacl_value_aro_sections` (`value`),
  KEY `jos_gacl_hidden_aro_sections` (`hidden`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Extraindo dados da tabela `jos_core_acl_aro_sections`
--

INSERT INTO `jos_core_acl_aro_sections` (`section_id`, `value`, `order_value`, `name`, `hidden`) VALUES
(10, 'users', 1, 'Users', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_core_acl_groups_aro_map`
--

CREATE TABLE IF NOT EXISTS `jos_core_acl_groups_aro_map` (
  `group_id` int(11) NOT NULL DEFAULT '0',
  `section_value` varchar(240) NOT NULL DEFAULT '',
  `aro_id` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `group_id_aro_id_groups_aro_map` (`group_id`,`section_value`,`aro_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jos_core_acl_groups_aro_map`
--

INSERT INTO `jos_core_acl_groups_aro_map` (`group_id`, `section_value`, `aro_id`) VALUES
(25, '', 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_core_log_items`
--

CREATE TABLE IF NOT EXISTS `jos_core_log_items` (
  `time_stamp` date NOT NULL DEFAULT '0000-00-00',
  `item_table` varchar(50) NOT NULL DEFAULT '',
  `item_id` int(11) unsigned NOT NULL DEFAULT '0',
  `hits` int(11) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jos_core_log_items`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_core_log_searches`
--

CREATE TABLE IF NOT EXISTS `jos_core_log_searches` (
  `search_term` text NOT NULL,
  `hits` int(11) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jos_core_log_searches`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_groups`
--

CREATE TABLE IF NOT EXISTS `jos_groups` (
  `id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `name` varchar(150) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jos_groups`
--

INSERT INTO `jos_groups` (`id`, `name`) VALUES
(0, 'Public'),
(1, 'Registered'),
(2, 'Special');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_menu`
--

CREATE TABLE IF NOT EXISTS `jos_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menutype` varchar(225) DEFAULT NULL,
  `name` text,
  `alias` varchar(255) NOT NULL DEFAULT '',
  `link` text,
  `type` varchar(150) NOT NULL DEFAULT '',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `parent` int(11) unsigned NOT NULL DEFAULT '0',
  `componentid` int(11) unsigned NOT NULL DEFAULT '0',
  `sublevel` int(11) DEFAULT '0',
  `ordering` int(11) DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `pollid` int(11) NOT NULL DEFAULT '0',
  `browserNav` tinyint(4) DEFAULT '0',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `utaccess` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  `lft` int(11) unsigned NOT NULL DEFAULT '0',
  `rgt` int(11) unsigned NOT NULL DEFAULT '0',
  `home` int(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `componentid` (`componentid`,`menutype`,`published`,`access`),
  KEY `menutype` (`menutype`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=200 ;

--
-- Extraindo dados da tabela `jos_menu`
--

INSERT INTO `jos_menu` (`id`, `menutype`, `name`, `alias`, `link`, `type`, `published`, `parent`, `componentid`, `sublevel`, `ordering`, `checked_out`, `checked_out_time`, `pollid`, `browserNav`, `access`, `utaccess`, `params`, `lft`, `rgt`, `home`) VALUES
(1, 'mainmenu', 'Joomla || subline possible', 'joomla', 'index.php?option=com_content&view=frontpage', 'component', 1, 0, 20, 0, 5, 62, '2010-07-12 12:35:37', 0, 0, 0, 3, 'num_leading_articles=1\nnum_intro_articles=6\nnum_columns=1\nnum_links=4\norderby_pri=\norderby_sec=front\nmulti_column_order=1\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=Welcome to the Frontpage\nshow_page_title=0\npageclass_sfx=columnwidth-200\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(135, 'mainmenu', 'Category List', 'category-list', 'index.php?option=com_content&view=category&id=29', 'component', 1, 156, 20, 2, 4, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'display_num=10\nshow_headings=1\nshow_date=1\ndate_format=\nfilter=1\nfilter_type=title\norderby_sec=\nshow_pagination=1\nshow_pagination_limit=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(136, 'mainmenu', 'Section List', 'section-list', 'index.php?option=com_content&view=section&id=4', 'component', 1, 156, 20, 2, 3, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=1\nshow_description_image=1\nshow_categories=1\nshow_empty_categories=0\nshow_cat_num_articles=1\nshow_category_description=1\norderby=\norderby_sec=\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(11, 'othermenu', 'Joomla! Home', 'joomla-home', 'http://www.joomla.org', 'url', 1, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, 'menu_image=-1\n\n', 0, 0, 0),
(12, 'othermenu', 'Joomla! Forums', 'joomla-forums', 'http://forum.joomla.org', 'url', 1, 0, 0, 0, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, 'menu_image=-1\n\n', 0, 0, 0),
(13, 'othermenu', 'Joomla! Help', 'joomla-help', 'http://help.joomla.org', 'url', 1, 0, 0, 0, 3, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, 'menu_image=-1\n\n', 0, 0, 0),
(20, 'usermenu', 'Your Details', 'your-details', 'index.php?option=com_user&view=user&task=edit', 'component', 1, 0, 14, 0, 1, 0, '0000-00-00 00:00:00', 0, 0, 1, 3, '', 0, 0, 0),
(24, 'usermenu', 'Logout', 'logout', 'index.php?option=com_user&view=login', 'component', 1, 0, 14, 0, 4, 0, '0000-00-00 00:00:00', 0, 0, 1, 3, '', 0, 0, 0),
(90, 'othermenu', 'Level 2', 'level-2', 'index.php?option=com_content&view=article&id=48', 'component', 1, 89, 20, 1, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(134, 'mainmenu', 'Section Blog', 'section-blog', 'index.php?option=com_content&view=section&layout=blog&id=4', 'component', 1, 156, 20, 2, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=1\nshow_description_image=1\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=order\nmulti_column_order=1\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=1\nlink_section=\nshow_category=1\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(171, 'mainmenu', 'ZOO', 'zoo', 'index.php?option=com_content&view=article&id=59', 'component', 1, 0, 20, 0, 3, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=columns-2 columnwidth-225\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(86, 'mainmenu', 'Separator || separator', 'separator', '', 'separator', 0, 0, 0, 0, 6, 62, '2008-07-08 10:39:29', 0, 0, 0, 0, 'menu_image=-1\n\n', 0, 0, 0),
(87, 'mainmenu', 'Level 2', 'level-2', 'index.php?option=com_content&view=article&id=48', 'component', 1, 86, 20, 1, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=0\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(88, 'mainmenu', 'Level 2', 'level-2', 'index.php?option=com_content&view=article&id=48', 'component', 1, 86, 20, 1, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=0\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(89, 'othermenu', 'Sample Levels', 'deeper-levels-examples', 'index.php?option=com_content&view=article&id=48', 'component', 1, 0, 20, 0, 4, 62, '2007-12-21 16:40:26', 0, 0, 0, 0, 'show_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(48, 'mainmenu', 'Web Links', 'web-links', 'index.php?option=com_weblinks&view=categories', 'component', 1, 158, 4, 2, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'image=-1\nimage_align=right\nshow_feed_link=1\nshow_comp_description=1\ncomp_description=\nshow_link_hits=1\nshow_link_description=1\nshow_other_cats=1\nshow_headings=1\ntarget=\nlink_icons=\npage_title=Weblinks\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(49, 'mainmenu', 'News Feeds', 'news-feeds', 'index.php?option=com_newsfeeds&view=categories', 'component', 1, 158, 11, 2, 3, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_limit=1\nshow_comp_description=1\ncomp_description=\nimage=-1\nimage_align=right\nshow_headings=1\nshow_name=1\nshow_articles=1\nshow_link=1\nshow_cat_description=1\nshow_cat_items=1\nshow_feed_image=1\nshow_feed_description=1\nshow_item_description=1\nfeed_word_count=0\npage_title=Newsfeeds\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(145, 'mainmenu', 'Category Blog', 'category-blog', 'index.php?option=com_content&view=category&layout=blog&id=29', 'component', 1, 156, 20, 2, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_description=1\nshow_description_image=1\nnum_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=order\nmulti_column_order=1\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=1\nlink_section=\nshow_category=1\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(51, 'usermenu', 'Submit an Article', 'submit-an-article', 'index.php?option=com_content&view=article&layout=form', 'component', 1, 0, 20, 0, 2, 0, '0000-00-00 00:00:00', 0, 0, 1, 0, '', 0, 0, 0),
(52, 'usermenu', 'Submit a Web Link', 'submit-a-web-link', 'index.php?option=com_weblinks&view=weblink&layout=form', 'component', 1, 0, 4, 0, 3, 0, '0000-00-00 00:00:00', 0, 0, 1, 0, '', 0, 0, 0),
(53, 'mainmenu', 'Home', 'home', 'index.php?option=com_content&view=frontpage', 'component', 1, 0, 20, 0, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'num_leading_articles=1\nnum_intro_articles=4\nnum_columns=2\nnum_links=4\norderby_pri=\norderby_sec=front\nmulti_column_order=1\nshow_pagination=2\nshow_pagination_results=1\nshow_feed_link=1\nshow_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=0\npageclass_sfx=columns-2 columnwidth-200 custom-nobox\nmenu_image=-1\nsecure=0\n\n', 0, 0, 1),
(54, 'mainmenu', 'Template', 'template', 'index.php?option=com_content&view=article&id=45', 'component', 1, 0, 20, 0, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=0\npageclass_sfx=columnwidth-310\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(55, 'mainmenu', 'Typography', 'typography', 'index.php?option=com_content&view=article&id=46', 'component', 1, 152, 20, 2, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=0\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(156, 'mainmenu', 'Content || All com_content views', 'content--all-comcontent-views', '', 'separator', 1, 1, 0, 1, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'menu_image=-1\n\n', 0, 0, 0),
(157, 'mainmenu', 'Contact || All com_contact views', 'contact--all-comcontact-views', '', 'separator', 1, 1, 0, 1, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'menu_image=-1\n\n', 0, 0, 0),
(158, 'mainmenu', 'Other Components || Remaining component views', 'other-components-remaining-component-views', '', 'separator', 1, 1, 0, 1, 3, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'menu_image=-1\n\n', 0, 0, 0),
(58, 'mainmenu', 'Module Variations', 'module-variations', 'index.php?option=com_content&view=article&id=58', 'component', 1, 152, 20, 2, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=1\nshow_create_date=1\nshow_modify_date=1\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=1\nshow_pdf_icon=1\nshow_print_icon=1\nshow_email_icon=1\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=0\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(91, 'othermenu', 'Level 2', 'level-2', 'index.php?option=com_content&view=article&id=48', 'component', 1, 89, 20, 1, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(92, 'othermenu', 'Level 3', 'level-3', 'index.php?option=com_content&view=article&id=48', 'component', 1, 91, 20, 2, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(93, 'othermenu', 'Level 4', 'level-4', 'index.php?option=com_content&view=article&id=48', 'component', 1, 92, 20, 3, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(94, 'othermenu', 'Level 2', 'level-2', 'index.php?option=com_content&view=article&id=48', 'component', 1, 89, 20, 1, 3, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(95, 'othermenu', 'Accordion A', 'accordion-a', '', 'separator', 1, 0, 0, 0, 5, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'menu_image=-1\n\n', 0, 0, 0),
(96, 'othermenu', 'Level 2', 'level-2', 'index.php?option=com_content&view=article&id=48', 'component', 1, 95, 20, 1, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(97, 'othermenu', 'Level 2', 'level-2', 'index.php?option=com_content&view=article&id=48', 'component', 1, 95, 20, 1, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(98, 'othermenu', 'Level 2', 'level-2', 'index.php?option=com_content&view=article&id=48', 'component', 1, 95, 20, 1, 3, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(99, 'othermenu', 'Accordion B', 'accordion-b', '', 'separator', 1, 0, 0, 0, 6, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'menu_image=-1\n\n', 0, 0, 0),
(100, 'othermenu', 'Level 2', 'level-2', 'index.php?option=com_content&view=article&id=48', 'component', 1, 99, 20, 1, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(101, 'othermenu', 'Level 2', 'level-2', 'index.php?option=com_content&view=article&id=48', 'component', 1, 99, 20, 1, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(107, 'mainmenu', 'Level 2', 'level-2', '', 'separator', 1, 86, 0, 1, 3, 62, '2008-07-10 15:21:21', 0, 0, 0, 0, 'menu_image=-1\n\n', 0, 0, 0),
(108, 'mainmenu', 'Level 3', 'level-3', 'index.php?option=com_content&view=article&id=48', 'component', 1, 107, 20, 2, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=0\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(123, 'topmenu', 'News', 'news', 'index.php?option=com_content&view=frontpage&Itemid=1', 'url', 1, 0, 0, 0, 3, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'menu_image=-1\n\n', 0, 0, 0),
(124, 'topmenu', 'Features', 'features', 'index.php?option=com_content&view=article&id=18:joomla-features&catid=29:the-cms&Itemid=145', 'url', 1, 0, 0, 0, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'menu_image=-1\n\n', 0, 0, 0),
(125, 'topmenu', 'About Joomla!', 'about-joomla', 'index.php?option=com_content&view=article&id=1:welcome-to-joomla&catid=29:the-cms&Itemid=145', 'url', 1, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'menu_image=-1\n\n', 0, 0, 0),
(138, 'mainmenu', 'Poll', 'poll', 'index.php?option=com_poll&view=poll&id=14', 'component', 1, 158, 10, 2, 4, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'page_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(140, 'mainmenu', 'Contact Category', 'contact-category', 'index.php?option=com_contact&view=category&catid=12', 'component', 1, 157, 7, 2, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'display_num=20\nimage=clock.jpg\nimage_align=left\nshow_limit=1\nshow_feed_link=1\ncontact_icons=\nicon_address=\nicon_email=\nicon_telephone=\nicon_mobile=\nicon_fax=\nicon_misc=\nshow_headings=\nshow_position=\nshow_email=\nshow_telephone=\nshow_mobile=\nshow_fax=\nallow_vcard=\nbanned_email=\nbanned_subject=\nbanned_text=\nvalidate_session=\ncustom_reply=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(141, 'mainmenu', 'Contact Item', 'contact-item', 'index.php?option=com_contact&view=contact&id=1', 'component', 1, 157, 7, 2, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_contact_list=1\nshow_category_crumb=1\ncontact_icons=\nicon_address=\nicon_email=\nicon_telephone=\nicon_mobile=\nicon_fax=\nicon_misc=\nshow_headings=\nshow_position=\nshow_email=\nshow_telephone=\nshow_mobile=\nshow_fax=\nallow_vcard=\nbanned_email=\nbanned_subject=\nbanned_text=\nvalidate_session=\ncustom_reply=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(142, 'mainmenu', 'Login', 'login', 'index.php?option=com_user&view=login', 'component', 1, 158, 14, 2, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_login_title=1\nheader_login=\nlogin=\nlogin_message=1\ndescription_login=1\ndescription_login_text=\nimage_login=\nimage_login_align=right\nshow_logout_title=1\nheader_logout=\nlogout=\nlogout_message=1\ndescription_logout=1\ndescription_logout_text=\nimage_logout=articles.jpg\npage_title=\nshow_page_title=0\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0),
(166, 'frontpagemenu', 'Template', 'template', 'index.php?option=com_content&view=article&id=45&Itemid=54', 'url', 1, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'menu_image=-1\n\n', 0, 0, 0),
(167, 'frontpagemenu', 'Icons', 'icons', 'index.php?option=com_content&view=article&id=73&Itemid=193', 'url', 1, 0, 0, 0, 3, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'menu_image=-1\n\n', 0, 0, 0),
(168, 'frontpagemenu', 'ZOO', 'zoo', 'index.php?option=com_content&view=article&id=59&Itemid=171', 'url', 1, 0, 0, 0, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'menu_image=-1\n\n', 0, 0, 0),
(169, 'frontpagemenu', 'Joomla', 'joomla', 'index.php?option=com_content&view=frontpage&Itemid=1', 'url', 1, 0, 0, 0, 4, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'menu_image=-1\n\n', 0, 0, 0),
(152, 'mainmenu', 'Warp5 || Template Framework', 'warp-slick-template-framework', 'index.php?option=com_content&view=article&id=45&Itemid=54', 'url', 1, 54, 0, 1, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'menu_image=icon_warp5.png\n\n', 0, 0, 0),
(193, 'mainmenu', 'Icons', 'icons', 'index.php?option=com_content&view=article&id=73', 'component', 1, 0, 20, 0, 4, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'show_noauth=\nshow_title=\nlink_titles=\nshow_intro=\nshow_section=\nlink_section=\nshow_category=\nlink_category=\nshow_author=\nshow_create_date=\nshow_modify_date=\nshow_item_navigation=\nshow_readmore=\nshow_vote=\nshow_icons=\nshow_pdf_icon=\nshow_print_icon=\nshow_email_icon=\nshow_hits=\nfeed_summary=\npage_title=\nshow_page_title=1\npageclass_sfx=\nmenu_image=-1\nsecure=0\n\n', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_menu_types`
--

CREATE TABLE IF NOT EXISTS `jos_menu_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menutype` varchar(225) NOT NULL DEFAULT '',
  `title` text NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menutype` (`menutype`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `jos_menu_types`
--

INSERT INTO `jos_menu_types` (`id`, `menutype`, `title`, `description`) VALUES
(1, 'mainmenu', 'Main Menu', 'The main menu for the site'),
(2, 'usermenu', 'User Menu', 'A Menu for logged in Users'),
(3, 'topmenu', 'Top Menu', 'Top level navigation'),
(4, 'othermenu', 'Other Menu', 'Additional links'),
(5, 'frontpagemenu', 'Frontpage Menu', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_messages`
--

CREATE TABLE IF NOT EXISTS `jos_messages` (
  `message_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id_from` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id_to` int(10) unsigned NOT NULL DEFAULT '0',
  `folder_id` int(10) unsigned NOT NULL DEFAULT '0',
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `state` int(11) NOT NULL DEFAULT '0',
  `priority` int(1) unsigned NOT NULL DEFAULT '0',
  `subject` text NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`message_id`),
  KEY `useridto_state` (`user_id_to`,`state`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `jos_messages`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_messages_cfg`
--

CREATE TABLE IF NOT EXISTS `jos_messages_cfg` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `cfg_name` text NOT NULL,
  `cfg_value` text NOT NULL,
  UNIQUE KEY `idx_user_var_name` (`user_id`,`cfg_name`(100))
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jos_messages_cfg`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_migration_backlinks`
--

CREATE TABLE IF NOT EXISTS `jos_migration_backlinks` (
  `itemid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `url` text NOT NULL,
  `sefurl` text NOT NULL,
  `newurl` text NOT NULL,
  PRIMARY KEY (`itemid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jos_migration_backlinks`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_modules`
--

CREATE TABLE IF NOT EXISTS `jos_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `position` varchar(150) DEFAULT NULL,
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `module` varchar(150) DEFAULT NULL,
  `numnews` int(11) NOT NULL DEFAULT '0',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `showtitle` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `params` text NOT NULL,
  `iscore` tinyint(4) NOT NULL DEFAULT '0',
  `client_id` tinyint(4) NOT NULL DEFAULT '0',
  `control` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `published` (`published`,`access`),
  KEY `newsfeeds` (`module`,`published`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=243 ;

--
-- Extraindo dados da tabela `jos_modules`
--

INSERT INTO `jos_modules` (`id`, `title`, `content`, `ordering`, `position`, `checked_out`, `checked_out_time`, `published`, `module`, `numnews`, `access`, `showtitle`, `params`, `iscore`, `client_id`, `control`) VALUES
(1, 'Main Menu', '', 1, 'menu', 0, '0000-00-00 00:00:00', 1, 'mod_mainmenu', 0, 0, 1, 'menutype=mainmenu\nmenu_style=list\nstartLevel=0\nendLevel=3\nshowAllChildren=1\nwindow_open=\nshow_whitespace=0\ncache=0\ntag_id=\nclass_sfx=menu-dropdown\nmoduleclass_sfx=menu\nmaxdepth=10\nmenu_images=0\nmenu_images_align=0\nmenu_images_link=0\nexpand_menu=0\nactivate_parent=0\nfull_active_id=0\nindent_image=0\nindent_image1=\nindent_image2=\nindent_image3=\nindent_image4=\nindent_image5=\nindent_image6=\nspacer=\nend_spacer=\n\n', 1, 0, ''),
(2, 'Login', '', 1, 'login', 0, '0000-00-00 00:00:00', 1, 'mod_login', 0, 0, 1, '', 1, 1, ''),
(3, 'Popular', '', 3, 'cpanel', 0, '0000-00-00 00:00:00', 1, 'mod_popular', 0, 2, 1, '', 0, 1, ''),
(4, 'Recent added Articles', '', 4, 'cpanel', 0, '0000-00-00 00:00:00', 1, 'mod_latest', 0, 2, 1, 'ordering=c_dsc\nuser_id=0\ncache=0\n\n', 0, 1, ''),
(5, 'Menu Stats', '', 5, 'cpanel', 0, '0000-00-00 00:00:00', 1, 'mod_stats', 0, 2, 1, '', 0, 1, ''),
(6, 'Unread Messages', '', 1, 'header', 0, '0000-00-00 00:00:00', 1, 'mod_unread', 0, 2, 1, '', 1, 1, ''),
(7, 'Online Users', '', 2, 'header', 0, '0000-00-00 00:00:00', 1, 'mod_online', 0, 2, 1, '', 1, 1, ''),
(8, 'Toolbar', '', 1, 'toolbar', 0, '0000-00-00 00:00:00', 1, 'mod_toolbar', 0, 2, 1, '', 1, 1, ''),
(9, 'Quick Icons', '', 1, 'icon', 0, '0000-00-00 00:00:00', 1, 'mod_quickicon', 0, 2, 1, '', 1, 1, ''),
(10, 'Logged in Users', '', 2, 'cpanel', 0, '0000-00-00 00:00:00', 1, 'mod_logged', 0, 2, 1, '', 0, 1, ''),
(11, 'Footer', '', 0, 'footer', 0, '0000-00-00 00:00:00', 1, 'mod_footer', 0, 0, 1, '', 1, 1, ''),
(12, 'Admin Menu', '', 1, 'menu', 0, '0000-00-00 00:00:00', 1, 'mod_menu', 0, 2, 1, '', 0, 1, ''),
(13, 'Admin SubMenu', '', 1, 'submenu', 0, '0000-00-00 00:00:00', 1, 'mod_submenu', 0, 2, 1, '', 0, 1, ''),
(14, 'User Status', '', 1, 'status', 0, '0000-00-00 00:00:00', 1, 'mod_status', 0, 2, 1, '', 0, 1, ''),
(15, 'Title', '', 1, 'title', 0, '0000-00-00 00:00:00', 1, 'mod_title', 0, 2, 1, '', 0, 1, ''),
(16, 'Polls || Vote for your favorite CMS', '', 13, 'right', 0, '0000-00-00 00:00:00', 1, 'mod_poll', 0, 0, 1, 'id=14\nmoduleclass_sfx=icon-users\ncache=1\ncache_time=900\n\n', 0, 0, ''),
(17, 'User Menu', '', 8, 'left', 0, '0000-00-00 00:00:00', 1, 'mod_mainmenu', 0, 1, 1, 'menutype=usermenu\nmenu_style=list\nstartLevel=0\nendLevel=5\nshowAllChildren=0\nwindow_open=\nshow_whitespace=0\ncache=0\ntag_id=\nclass_sfx=\nmoduleclass_sfx=menu\nmaxdepth=10\nmenu_images=0\nmenu_images_align=0\nmenu_images_link=0\nexpand_menu=0\nactivate_parent=0\nfull_active_id=0\nindent_image=0\nindent_image1=\nindent_image2=\nindent_image3=\nindent_image4=\nindent_image5=\nindent_image6=\nspacer=\nend_spacer=\n\n', 1, 0, ''),
(18, 'Login Form || Login to Member Area', '', 14, 'right', 0, '0000-00-00 00:00:00', 1, 'mod_login', 0, 0, 1, 'cache=0\nmoduleclass_sfx=icon-lock\npretext=\nposttext=\nlogin=\nlogout=\ngreeting=1\nname=0\nusesecure=0\n\n', 1, 0, ''),
(19, 'Latest News', '', 0, 'maintop', 0, '0000-00-00 00:00:00', 1, 'mod_latestnews', 0, 0, 1, 'count=5\nordering=c_dsc\nuser_id=0\nshow_front=1\nsecid=\ncatid=\nmoduleclass_sfx=\ncache=1\ncache_time=900\n\n', 1, 0, ''),
(20, 'Statistics', '', 14, 'left', 0, '0000-00-00 00:00:00', 0, 'mod_stats', 0, 0, 0, 'serverinfo=1\nsiteinfo=1\ncounter=1\nincrease=0\nmoduleclass_sfx=\ncache=0\ncache_time=900\n\n', 0, 0, ''),
(21, 'Who''s Online', '', 6, 'right', 62, '2010-07-20 17:30:50', 1, 'mod_whosonline', 0, 0, 1, 'cache=0\nshowmode=0\nmoduleclass_sfx=style-box color-highlight\n\n', 0, 0, ''),
(22, 'Popular', '', 2, 'maintop', 0, '0000-00-00 00:00:00', 1, 'mod_mostread', 0, 0, 1, 'moduleclass_sfx=\nshow_front=1\ncount=5\ncatid=\nsecid=\ncache=1\ncache_time=900\n\n', 0, 0, ''),
(23, 'Archive', '', 15, 'left', 0, '0000-00-00 00:00:00', 0, 'mod_archive', 0, 0, 1, 'count=10\nmoduleclass_sfx=\ncache=1\n\n', 1, 0, ''),
(24, 'Sections', '', 16, 'left', 0, '0000-00-00 00:00:00', 0, 'mod_sections', 0, 0, 1, 'count=5\nmoduleclass_sfx=\ncache=1\ncache_time=900\n\n', 1, 0, ''),
(26, 'Related Items', '', 17, 'left', 0, '0000-00-00 00:00:00', 0, 'mod_related_items', 0, 0, 1, '', 0, 0, ''),
(27, 'Search', '', 1, 'search', 0, '0000-00-00 00:00:00', 0, 'mod_search', 0, 0, 0, 'moduleclass_sfx=\nwidth=20\ntext=\nbutton=1\nbutton_pos=right\nimagebutton=\nbutton_text=\ncache=1\ncache_time=900\n\n', 0, 0, ''),
(29, 'Top Menu', '', 1, 'toolbarleft', 0, '0000-00-00 00:00:00', 1, 'mod_mainmenu', 0, 0, 0, 'menutype=topmenu\nmenu_style=list\nstartLevel=0\nendLevel=0\nshowAllChildren=0\nwindow_open=\nshow_whitespace=0\ncache=0\ntag_id=\nclass_sfx=\nmoduleclass_sfx=menu\nmaxdepth=10\nmenu_images=0\nmenu_images_align=0\nmenu_images_link=0\nexpand_menu=0\nactivate_parent=0\nfull_active_id=0\nindent_image=0\nindent_image1=-1\nindent_image2=-1\nindent_image3=-1\nindent_image4=-1\nindent_image5=-1\nindent_image6=-1\nspacer=\nend_spacer=\n\n', 1, 0, ''),
(32, 'Wrapper', '', 18, 'left', 0, '0000-00-00 00:00:00', 0, 'mod_wrapper', 0, 0, 1, '', 0, 0, ''),
(33, 'Footer', '', 3, 'footer', 0, '0000-00-00 00:00:00', 0, 'mod_footer', 0, 0, 0, 'cache=1\n\n', 1, 0, ''),
(34, 'Feed Display', '', 19, 'left', 0, '0000-00-00 00:00:00', 0, 'mod_feed', 0, 0, 1, '', 1, 0, ''),
(35, 'Breadcrumbs', '', 1, 'breadcrumbs', 0, '0000-00-00 00:00:00', 1, 'mod_breadcrumbs', 0, 0, 1, 'showHome=1\nhomeText=Home\nshowLast=1\nseparator=\nmoduleclass_sfx=\ncache=0\n\n', 1, 0, ''),
(36, 'Syndication', '', 6, 'left', 0, '0000-00-00 00:00:00', 0, 'mod_syndicate', 0, 0, 0, 'cache=0\ntext=Feed Entries\nformat=rss\nmoduleclass_sfx=\n\n', 1, 0, ''),
(42, 'Sub Menu', '', 12, 'right', 62, '2010-07-20 17:27:07', 1, 'mod_mainmenu', 0, 0, 1, 'menutype=mainmenu\nmenu_style=list\nstartLevel=1\nendLevel=5\nshowAllChildren=0\nwindow_open=\nshow_whitespace=0\ncache=0\ntag_id=\nclass_sfx=menu-accordion images-off\nmoduleclass_sfx=style-menu\nmaxdepth=10\nmenu_images=0\nmenu_images_align=0\nmenu_images_link=0\nexpand_menu=0\nactivate_parent=0\nfull_active_id=0\nindent_image=0\nindent_image1=\nindent_image2=\nindent_image3=\nindent_image4=\nindent_image5=\nindent_image6=\nspacer=\nend_spacer=\n\n', 0, 0, ''),
(177, 'Footer Menu', '', 1, 'footer', 62, '2009-11-27 10:18:08', 1, 'mod_mainmenu', 0, 0, 0, 'menutype=topmenu\nmenu_style=list\nstartLevel=0\nendLevel=0\nshowAllChildren=0\nwindow_open=\nshow_whitespace=0\ncache=0\ntag_id=\nclass_sfx=\nmoduleclass_sfx=menu\nmaxdepth=10\nmenu_images=0\nmenu_images_align=0\nmenu_images_link=0\nexpand_menu=0\nactivate_parent=0\nfull_active_id=0\nindent_image=0\nindent_image1=-1\nindent_image2=-1\nindent_image3=-1\nindent_image4=-1\nindent_image5=-1\nindent_image6=-1\nspacer=\nend_spacer=\n\n', 0, 0, ''),
(41, 'Welcome to Joomla!', '<div style="padding: 5px"><p>Congratulations on choosing Joomla! as your content management system. We hope you are able to create a successful Web site with our program and maybe you will be able to give something back to the community later.</p><p>To make your start with Joomla! as smooth as possible, we want to give you some pointers to documentation, common questions and help on securing your server. A good place to start is the &quot;<a href="http://forum.joomla.org/index.php/topic,47524.0.html" target="_blank">Absolute Beginners Guide to Joomla!</a>&quot;.</p><p>For your most common questions the best place to start looking for answers is the <a href="http://help.joomla.org/component/option,com_easyfaq/Itemid,268/" target="_blank">Frequently Asked Questions (FAQ)</a> area.  If you are stuck on a particular screen in the Administration area of Joomla! (which is where you are now), then try clicking on the Help toolbar button which you will find on almost all screens.  This will take you to a page about that screen on our <a href="http://help.joomla.org" target="_blank">Help Site</a>.  If you still have questions then take a look on our <a href="http://forum.joomla.org" target="_blank">forum</a> which is most likely the biggest resource on Joomla! there is and you will find almost every question answered at least once, so please try using the search function before asking your question.</p><p>Security is a big concern for us, which is why we would like you to subscribe to the <a href="http://forum.joomla.org/index.php/board,8.0.html" target="_blank">announcement forum</a> (by clicking on the Notify button) to always get the latest information on new releases for Joomla! You should also read the <a href="http://help.joomla.org/component/option,com_easyfaq/task,view/id,167/Itemid,268/" target="_blank">Joomla! Administrator''s Security Checklist</a> and regularly check the <a href="http://forum.joomla.org/index.php/board,267.0.html" target="_blank">security forum</a>.</p><p>We hope you have much fun and success with Joomla! and hope to see you in the forum among the hundreds and thousands of contributors.</p><p>Your Joomla! team.<img alt="Smile" border="0" src="../plugins/editors/tinymce/jscripts/tiny_mce/plugins/emotions/images/smiley-smile.gif" title="Smile" /></p><p>P.S.: To remove this message, delete the &quot;Welcome to Joomla!&quot; Module in the Administrator screen of the Module Manager (on the Extensions menu).  Here is a <a href="index.php?option=com_modules&amp;client=1">quick link</a> to this screen.</p></div>', 1, 'cpanel', 0, '0000-00-00 00:00:00', 1, 'mod_custom', 0, 2, 1, 'moduleclass_sfx=\n\n', 1, 1, ''),
(46, 'YOOlogin (Default)', '', 1, 'content1', 0, '0000-00-00 00:00:00', 1, 'mod_yoo_login', 0, 0, 0, 'style=default\npretext=\nposttext=\nlogin=\nlogout=\ngreeting=1\ntext_mode=input\nlogin_button=icon\nlogout_button=text\nauto_remember=1\nlost_password=1\nlost_username=1\nregistration=1\nmoduleclass_sfx=\ncache=0\ncache_time=900\n\n', 0, 0, ''),
(156, 'Validating Code', '<p>This template validates to XHTML and CSS web standards and is designed to be compatible with all modern browsers.</p>\r\n<p>\r\n  <img class="correct-png" style="margin-right: 10px" src="images/yootheme/browser_firefox.png" alt="Firefox 3.0+" title="Firefox 3.0+" width="20" height="20" />\r\n  <img class="correct-png" style="margin-right: 10px" src="images/yootheme/browser_ie7.png" alt="Internet Explorer 7+" title="Internet Explorer 7+" width="20" height="20" />\r\n  <img class="correct-png" style="margin-right: 10px" src="images/yootheme/browser_safari.png" alt="Safari 3.1+" title="Safari 3.1+" width="20" height="20" />\r\n  <img class="correct-png" style="margin-right: 10px" src="images/yootheme/browser_opera.png" alt="Opera 9.5+" title="Opera 9.5+" width="20" height="20" />\r\n  <img class="correct-png" style="margin-right: 10px" src="images/yootheme/browser_camino.png" alt="Camino 1.0+" title="Camino 1.0+" width="20" height="20" />\r\n  <img class="correct-png" style="margin-right: 10px" src="images/yootheme/browser_konqueror.png" alt="Konqueror" title="Konqueror" width="20" height="20" />\r\n  <img class="correct-png" style="margin-right: 10px" src="images/yootheme/browser_chrome.png" alt="Chrome 1.0+" title="Chrome 1.0+" width="20" height="20" />\r\n</p>', 11, 'right', 62, '2010-07-20 17:29:04', 1, 'mod_custom', 0, 0, 1, 'moduleclass_sfx=\n\n', 0, 0, ''),
(155, 'Javascript Library', 'All client side effects use the JavaScript framework <a href="http://www.mootools.net" target="_blank">MooTools</a> which offers most reliable functionality and compact size!', 10, 'right', 62, '2010-07-20 17:29:08', 1, 'mod_custom', 0, 0, 1, 'moduleclass_sfx=\n\n', 0, 0, ''),
(56, 'Login || module position', '', 2, 'menu', 0, '0000-00-00 00:00:00', 1, 'mod_yoo_login', 0, 0, 0, 'style=niftyquick\npretext=\nposttext=\nlogin=\nlogout=\ngreeting=1\ntext_mode=input\nlogin_button=icon\nlogout_button=icon\nauto_remember=1\nlost_password=1\nlost_username=1\nregistration=1\nmoduleclass_sfx=dropdownwidth-310\ncache=0\ncache_time=900\n\n', 0, 0, ''),
(176, 'ZOO 2.0', '<a href="http://zoo.yootheme.com" target="_blank" style="display: block; text-align: center;">\r\n<img class="correct-png" src="images/yootheme/icon_zoo.png" alt="A flexible and powerful content application builder to manage your content" title="A flexible and powerful content application builder to manage your content" width="140" height="130" />\r\n</a>\r\n<p>A flexible and powerful content application builder to manage your content. Get <a href="http://zoo.yootheme.com" target="_blank">ZOO 2.0</a>.</p>', 8, 'right', 0, '0000-00-00 00:00:00', 1, 'mod_custom', 0, 0, 1, 'moduleclass_sfx=style-box\n\n', 0, 0, ''),
(68, 'Left 1', 'Lorem ipsum dolor sit amet. Used Module Class Suffix: <em class="box">style-line</em> <em class="box">color-highlight</em> <em class="box">icon-mail</em>', 11, 'left', 0, '0000-00-00 00:00:00', 1, 'mod_custom', 0, 0, 1, 'moduleclass_sfx=style-box color-highlight icon-mail\n\n', 0, 0, ''),
(180, 'Polaroid', 'Lorem ipsum dolor sit amet consect adipisic elit. Used Module Class Suffix: style-polaroid', 13, 'left', 0, '0000-00-00 00:00:00', 1, 'mod_custom', 0, 0, 1, 'moduleclass_sfx=style-polaroid\n\n', 0, 0, ''),
(182, 'Left 2', 'Lorem ipsum dolor sit amet. Used Module Class Suffix: <em class="box">style-line</em> <em class="box">color-dark</em> <em class="box">icon-twitter</em>', 12, 'left', 0, '0000-00-00 00:00:00', 1, 'mod_custom', 0, 0, 1, 'moduleclass_sfx=style-box color-dark icon-twitter\n\n', 0, 0, ''),
(89, 'Top Block || Sub Title', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Used Module Class Suffix: <em class="box">style-glass</em>', 0, 'topblock', 0, '0000-00-00 00:00:00', 1, 'mod_custom', 0, 0, 1, 'moduleclass_sfx=style-glass\n\n', 0, 0, ''),
(72, 'Logo', '<p><a class="logo-icon correct-png" href="index.php" title="Home"></a></p>', 0, 'logo', 62, '2010-08-05 19:17:07', 0, 'mod_custom', 0, 0, 0, 'moduleclass_sfx=\n\n', 0, 0, ''),
(136, 'Sample Flags', '<img src="images/yootheme/toolbar_flags.png" class="correct-png" width="123" height="15" alt="Languages" style="margin-top: 6px;" />', 1, 'toolbarright', 0, '0000-00-00 00:00:00', 0, 'mod_custom', 0, 0, 0, 'moduleclass_sfx=\n\n', 0, 0, ''),
(122, 'Warp5 Framework', 'This template is based on the fast and powerful Warp5 framework. We provide a comprehensive documentation how everything work.\r\n\r\n<p class="readmore"><a class="readmore" href="http://warp.yootheme.com/documentation" target="_blank">Take a look...</a></p>', 2, 'right', 0, '0000-00-00 00:00:00', 1, 'mod_custom', 0, 0, 1, 'moduleclass_sfx=\n\n', 0, 0, ''),
(123, 'Module System', 'The module system provides a clear grid for Joomla modules and a wide diversity of templates for module variations.\r\n\r\n<p class="readmore"><a class="readmore" href="http://warp.yootheme.com/module-system" target="_blank">Read more...</a></p>', 5, 'right', 0, '0000-00-00 00:00:00', 0, 'mod_custom', 0, 0, 1, 'moduleclass_sfx=\n\n', 0, 0, ''),
(82, 'Footer', 'Validates to <a href="http://validator.w3.org/check?uri=http://demo.yootheme.com/aug10" target="_blank">XHTML 1.0</a> and <a href="http://jigsaw.w3.org/css-validator/validator?uri=http://demo.yootheme.com/aug10&amp;profile=css3" target="_blank">CSS 3</a><br/>\r\nCopyright &copy; 2010 <a href="http://www.yootheme.com" target="_blank">YOOtheme</a>', 2, 'footer', 0, '0000-00-00 00:00:00', 1, 'mod_custom', 0, 0, 1, 'moduleclass_sfx=\n\n', 0, 0, ''),
(83, 'Main Top 1', 'Lorem ipsum dolor sit amet, consectetur. Used Module Class Suffix: <em class="box">style-box</em> <em class="box">icon-lock</em>', 3, 'maintop', 0, '0000-00-00 00:00:00', 1, 'mod_custom', 0, 0, 1, 'moduleclass_sfx=style-box icon-lock\n\n', 0, 0, ''),
(87, 'Other Menu', '', 4, 'contentright', 0, '0000-00-00 00:00:00', 1, 'mod_mainmenu', 0, 0, 1, 'menutype=othermenu\nmenu_style=list\nstartLevel=0\nendLevel=5\nshowAllChildren=0\nwindow_open=\nshow_whitespace=0\ncache=0\ntag_id=\nclass_sfx=menu-accordion\nmoduleclass_sfx=style-menu\nmaxdepth=10\nmenu_images=0\nmenu_images_align=0\nmenu_images_link=0\nexpand_menu=0\nactivate_parent=0\nfull_active_id=0\nindent_image=0\nindent_image1=\nindent_image2=\nindent_image3=\nindent_image4=\nindent_image5=\nindent_image6=\nspacer=\nend_spacer=\n\n', 0, 0, ''),
(84, 'Main Top 2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt. Used Module Class Suffix: <em class="box">style-box</em> <em class="box">icon-download</em>', 4, 'maintop', 0, '0000-00-00 00:00:00', 1, 'mod_custom', 0, 0, 1, 'moduleclass_sfx=style-box icon-download\n\n', 0, 0, ''),
(85, 'Main Bottom 1', 'Lorem ipsum dolor sit amet, consectetur. Used Module Class Suffix: <em class="box">style-box</em> <em class="box">icon-message</em>', 0, 'mainbottom', 0, '0000-00-00 00:00:00', 1, 'mod_custom', 0, 0, 1, 'moduleclass_sfx=style-box icon-message\n\n', 0, 0, ''),
(86, 'Main Bottom 2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt. Used Module Class Suffix: <em class="box">style-box</em> <em class="box">icon-users</em>', 2, 'mainbottom', 0, '0000-00-00 00:00:00', 1, 'mod_custom', 0, 0, 1, 'moduleclass_sfx=style-box icon-users\n\n', 0, 0, ''),
(117, 'YOOcarousel (Frontpage)', '', 6, 'top', 0, '0000-00-00 00:00:00', 0, 'mod_yoo_carousel', 0, 0, 0, 'catid=35\nstyle=slideshow\nmodule_width=800\nmodule_height=250\ntab_width=200\nautoplay=once\nslide_interval=6000\ntransition_duration=300\ntransition_effect=crossfade\ncontrol_panel=none\nrotate_action=mouseover\nrotate_duration=300\nrotate_effect=crossfade\nbuttons=1\norder=o_asc\nreadmore=0\nitems=10\nmoduleclass_sfx=style-blank\ncache=0\ncache_time=900\n\n', 0, 0, ''),
(175, 'Teamlog', '<a href="http://teamlog.yootheme.com" target="_blank" style="display: block; text-align: center;">\r\n<img class="correct-png" src="images/yootheme/icon_teamlog.png" alt="Web based Time Tracking Solution for Joomla! 1.5 focused on simplicity" title="Web based Time Tracking Solution for Joomla! 1.5 focused on simplicity" width="140" height="150" />\r\n</a>\r\n<p>Web based Time Tracking Solution for Joomla! 1.5 focused on simplicity. Get the <a href="http://teamlog.yootheme.com" target="_blank">Teamlog extension</a> for free.</p>', 9, 'right', 0, '0000-00-00 00:00:00', 1, 'mod_custom', 0, 0, 1, 'moduleclass_sfx=style-box color-dark\n\n', 0, 0, ''),
(125, 'YOOsearch', '', 2, 'search', 62, '2010-06-16 13:15:47', 1, 'mod_yoo_search', 0, 0, 0, 'style=default\nbox_width=280\nchar_limit=130\nres_limit=6\ncat_limit=6\ncategories={cat\\ntitle=[YOOtheme]\\nimage=[yootheme/yoosearch/yootheme.png]\\nurl=[http://www.yootheme.com]\\nkeywords=[yootheme, template, templates, themes, theme]\\n}The YOOtheme template club for Joomla 1.0 and 1.5 offers stylish templates with professional Web 2.0 features.{/cat}\\n\\n{cat\\ntitle=[YOOtools]\\nimage=[yootheme/yoosearch/yootools.png]\\nurl=[http://www.yootools.com]\\nkeywords=[yootheme, yootools, features, feature, yoospotlight, yooreflection, yoolightbox, yoocarousel, yooaccordion, yooslider, yoodrawer, yooscroller, yoomaps, yoosearch, yooeffects, yootoppanel, yoologin, yootooltip, yoosnapshots, spotlight, reflection, lightbox, carousel, accordion, slider, drawer, scroller, maps, search, effects, toppanel, login, tooltip, snapshots]}The YOOtools are new YOOtheme extensions for Joomla 1.0 and 1.5. Exclusive YOOtheme modules, compontent and plugins!{/cat}\\n\\n{cat\\ntitle=[Typography]\\nurl=[index.php?option=com_content&view=article&id=46&Itemid=55]\\nimage=[yootheme/yoosearch/typography.png]\\nkeywords=[typography, joomla, style, stylings, HTML, tag]\\n}Take a look at the typography, the style guide and learn all about the possible HTML tag stylings of this YOOtheme templates.{/cat}\\n\\n{cat\\ntitle=[Layout]\\nimage=[yootheme/yoosearch/layout.png]\\nurl=[index.php?option=com_content&view=article&id=47&Itemid=56]\\nkeywords=[layout, joomla, module, position, positions, variation, variations]\\n}Take a look at the layout options and all possible module positions and variations of this YOOtheme template.{/cat}\\n\\n{cat\\ntitle=[Joomla]\\nimage=[yootheme/yoosearch/joomla.png]\\nurl=[index.php?option=com_content&view=frontpage&Itemid=1]\\nkeywords=[joomla]\\n}Take a look at how this YOOtheme template styles the Joomla core articles, components and modules.{/cat}\nmoduleclass_sfx=-blank\ncache=0\ncache_time=900\n\n', 0, 0, ''),
(124, 'Menu System', 'The menu system enhances Joomla''s menu functions to create clearly arranged interfaces even for comprehensive sites.\r\n\r\n<p class="readmore"><a class="readmore" href="http://warp.yootheme.com/menu-system" target="_blank">Read more...</a></p>', 4, 'right', 0, '0000-00-00 00:00:00', 0, 'mod_custom', 0, 0, 1, 'moduleclass_sfx=\n\n', 0, 0, ''),
(134, 'YOOiecheck', '', 2, 'absolute', 0, '0000-00-00 00:00:00', 1, 'mod_yoo_iecheck', 0, 0, 0, 'message=You are using Internet Explorer 6. Please upgrade your browser to increase safety and your browsing experience. Choose one of the following links to download a modern browser:\nfirefox=1\nsafari=1\nopera=1\nie=1\nmoduleclass_sfx=-blank\n\n', 0, 0, ''),
(151, 'Fireworks Files', '<div style="overflow: hidden;">\r\n<img height="40" width="42" align="right" src="/YOOtheme/Templates/Next/Website/images/yootheme/top_fireworks.png" alt="Fully sliced Fireworks .png files" title="Fully sliced Fireworks .png files" style="margin-left: 10px;" class="correct-png"/>Fully sliced Fireworks PNGs for customizations.\r\n</div>', 6, 'maintop', 0, '0000-00-00 00:00:00', 0, 'mod_custom', 0, 0, 1, 'moduleclass_sfx=\n\n', 0, 0, ''),
(150, 'YOOtools', '<div style="overflow: hidden">\r\n<img class="correct-png" style="margin-left: 10px;" width="55" height="42" align="right" title="Native version for Joomla 1.5" alt="Native version for Joomla 1.5" src="images/yootheme/top_yootools.png" />This template is fully compatible with all <a href="http://www.yootools.com" target="_blank">YOOtools</a>\r\n</div>', 7, 'maintop', 0, '0000-00-00 00:00:00', 0, 'mod_custom', 0, 0, 1, 'moduleclass_sfx=\n\n', 0, 0, ''),
(178, 'Feeds', '<a class="twitter" title="Follow us on Twitter" href="http://twitter.com/yootheme" target="_blank"><img height="25" width="25" alt="Follow us on Twitter" src="images/yootheme/toolbar_twitter.png" class="correct-png" /></a>\r\n<a class="rss" title="Subscribe to our RSS feed" href="http://www.yootheme.com/rss" target="_blank"><img height="25" width="25" alt="Subscribe to our RSS feed" src="images/yootheme/toolbar_feed.png" class="correct-png" /></a>', 0, 'toolbarright', 0, '0000-00-00 00:00:00', 1, 'mod_custom', 0, 0, 0, 'moduleclass_sfx=\n\n', 0, 0, ''),
(168, 'Latest YOOtheme Tweet', '', 1, 'headerright', 0, '0000-00-00 00:00:00', 1, 'mod_yoo_tweet', 0, 0, 0, 'style=single\nfrom_user=yootheme\nto_user=\nref_user=\nhashtag=\nword=\nimage=0\nauthor=0\ndate=0\nimage_size=42\nnum_tweets=5\nmoduleclass_sfx=style-headerbar\ncache=0\ncache_time=15\n\n', 0, 0, ''),
(183, 'Frontpage Menu', '', 1, 'right', 0, '0000-00-00 00:00:00', 1, 'mod_mainmenu', 0, 0, 1, 'menutype=frontpagemenu\nmenu_style=list\nstartLevel=0\nendLevel=0\nshowAllChildren=0\nwindow_open=\nshow_whitespace=0\ncache=0\ntag_id=\nclass_sfx=menu-accordion\nmoduleclass_sfx=style-menu\nmaxdepth=10\nmenu_images=0\nmenu_images_align=0\nmenu_images_link=0\nexpand_menu=0\nactivate_parent=0\nfull_active_id=0\nindent_image=0\nindent_image1=\nindent_image2=\nindent_image3=\nindent_image4=\nindent_image5=\nindent_image6=\nspacer=\nend_spacer=\n\n', 0, 0, ''),
(228, 'Frontpage Movie', '<a href="http://zoo.yootheme.com/app-bundle/movie" target="_blank" style="display: block; text-align: center; text-decoration: none;">\r\n	<img src="images/yootheme/home_zoo_movie.png" width="100" height="85" alt="Create great review resource of your favorite movies" title="Create great review resource of your favorite movies" />\r\n	<span style="display: block; font-size: 16px; line-height: 18px; text-transform: uppercase; margin-top: 5px;">Movie<br />Database</span>\r\n</a>', 4, 'top', 0, '0000-00-00 00:00:00', 1, 'mod_custom', 0, 0, 0, 'moduleclass_sfx=style-glass\n\n', 0, 0, ''),
(190, 'ZOO Not Included', '<div class="alert">The displayed content is part of the app bundle for ZOO 2.0 and only shown for demonstration purpose. The app bundle is NOT included when purchasing this template. However you can download ZOO 2.0 at <a href="http://zoo.yootheme.com" target="_blank">http://zoo.yootheme.com</a>.</div>', 2, 'topblock', 62, '2010-06-25 09:36:50', 1, 'mod_custom', 0, 0, 0, 'moduleclass_sfx=style-blank\n\n', 0, 0, ''),
(212, 'ZOO 2.0 News', '<ul class="links" style="margin: 0;">\r\n<li><a href="http://www.yootheme.com/blog/item/root/zoo-20-beta-released" target="_blank">Complete feature list</a></li>\r\n<li><a href="http://www.yootheme.com/blog/item/root/native-comments-for-zoo-20" target="_blank">Native comment system</a></li>\r\n<li><a href="http://www.yootheme.com/blog/item/root/zoo-20-frequently-asked-questions" target="_blank">Frequently Asked Questions</a></li>\r\n<li><a href="http://www.yootheme.com/blog/item/root/zoo-20-element-updates" target="_blank">Element Updates</a></li>\r\n<li><a href="http://www.yootheme.com/blog/item/root/zoo-20-usability" target="_blank">Usability Improvements</a></li>\r\n<li><a href="http://www.yootheme.com/blog/item/root/the-zoo-20-app-concept" target="_blank">The App Concept</a></li>\r\n<li><a href="http://www.yootheme.com/blog/item/root/announcing-zoo-20" target="_blank">Announcing ZOO 2.0</a></li>\r\n</ul>', 3, 'right', 62, '2010-07-20 17:28:30', 1, 'mod_custom', 0, 0, 1, 'moduleclass_sfx=\n\n', 0, 0, ''),
(224, 'Native Tools for ZOO', '', 5, 'top', 62, '2010-07-22 13:38:02', 1, 'mod_yoo_scroller', 0, 0, 0, 'catid=36\nstyle=blank-h\nmodule_width=798\nmodule_height=180\nslide_size=159\nslide_interval=4000\nautoplay=1\norder=o_asc\nreadmore=0\nitems=8\nmoduleclass_sfx=style-glass\ncache=0\ncache_time=900\n\n', 0, 0, ''),
(225, 'Frontpage Cookbook', '<a href="http://zoo.yootheme.com/app-bundle/cookbook" target="_blank" style="display: block; text-align: center; text-decoration: none;">\r\n	<img src="images/yootheme/home_zoo_cookbook.png" width="100" height="85" alt="Create a great online Cookbook" title="Create a great online Cookbook" />\r\n	<span style="display: block; font-size: 16px; line-height: 18px; text-transform: uppercase; margin-top: 5px;">Online<br />Cookbook</span>\r\n</a>', 3, 'top', 0, '0000-00-00 00:00:00', 1, 'mod_custom', 0, 0, 0, 'moduleclass_sfx=style-glass\n\n', 0, 0, ''),
(226, 'Frontpage Business', '<a href="http://zoo.yootheme.com/app-bundle/business" target="_blank" style="display: block; text-align: center; text-decoration: none;">\r\n	<img src="images/yootheme/home_zoo_business.png" width="100" height="85" alt="Manage companies and their employees" title="Manage companies and their employees" />\r\n	<span style="display: block; font-size: 16px; line-height: 18px; text-transform: uppercase; margin-top: 5px;">Business<br />Directory</span>\r\n</a>', 2, 'top', 0, '0000-00-00 00:00:00', 1, 'mod_custom', 0, 0, 0, 'moduleclass_sfx=style-glass\n\n', 0, 0, ''),
(227, 'Frontpage Product', '<a href="http://zoo.yootheme.com/app-bundle/product" target="_blank" style="display: block; text-align: center; text-decoration: none;">\r\n	<img src="images/yootheme/home_zoo_product.png" width="100" height="85" alt="Clearly arranged catalog with many built-in features" title="Clearly arranged catalog with many built-in features" />\r\n	<span style="display: block; font-size: 16px; line-height: 18px; text-transform: uppercase; margin-top: 5px;">Product<br />Catalog</span>\r\n</a>', 0, 'top', 0, '0000-00-00 00:00:00', 1, 'mod_custom', 0, 0, 0, 'moduleclass_sfx=style-glass\n\n', 0, 0, ''),
(238, 'High quality icon sets', '<ul class="hoverbox" style="margin: 0;">\r\n<li>\r\n	<a href="http://icons.yootheme.com/icon-club#set6" target="_blank">\r\n		<span class="title">Homepage Icon Set</span>\r\n		<span class="subtitle">16 icons released in July 2010</span>\r\n	</a>\r\n</li>\r\n<li>\r\n	<a href="http://icons.yootheme.com/icon-club#set5" target="_blank">\r\n		<span class="title">Contact Icon Set</span>\r\n		<span class="subtitle">10 icons released in July 2010</span>\r\n	</a>\r\n</li>\r\n<li>\r\n	<a href="http://icons.yootheme.com/icon-club#set4" target="_blank">\r\n		<span class="title">Community Icon Set</span>\r\n		<span class="subtitle">12 icons released in July 2010</span>\r\n	</a>\r\n</li>\r\n<li>\r\n	<a href="http://icons.yootheme.com/icon-club#set3" target="_blank">\r\n		<span class="title">Actions Icon Set</span>\r\n		<span class="subtitle">16 icons released in July 2010</span>\r\n	</a>\r\n</li>\r\n<li>\r\n	<a href="http://icons.yootheme.com/icon-club#set2" target="_blank">\r\n		<span class="title">Symbols Icon Set</span>\r\n		<span class="subtitle">24 icons released in July 2010</span>\r\n	</a>\r\n</li>\r\n</ul>', 7, 'right', 0, '0000-00-00 00:00:00', 1, 'mod_custom', 0, 0, 0, 'moduleclass_sfx=\n\n', 0, 0, ''),
(239, 'Icon Set Homepage', '<a href="http://icons.yootheme.com/icon-club#set6" target="_blank" style="display: block; text-align: center; text-decoration: none;">\r\n	<img src="images/yootheme/icons_set06.png" width="128" height="85" alt="Homepage Icon Set" />\r\n	<span style="display: block; font-size: 16px; line-height: 18px; text-transform: uppercase; margin-top: 5px;">Homepage<br />Icon Set</span>\r\n</a>', 7, 'top', 0, '0000-00-00 00:00:00', 1, 'mod_custom', 0, 0, 0, 'moduleclass_sfx=style-glow color-templatecolor\n\n', 0, 0, ''),
(240, 'Icon Set Community', '<a href="http://icons.yootheme.com/icon-club#set4" target="_blank" style="display: block; text-align: center; text-decoration: none;">\r\n	<img src="images/yootheme/icons_set04.png" width="128" height="85" alt="Community Icon Set" />\r\n	<span style="display: block; font-size: 16px; line-height: 18px; text-transform: uppercase; margin-top: 5px;">Community<br />Icon Set</span>\r\n</a>', 8, 'top', 0, '0000-00-00 00:00:00', 1, 'mod_custom', 0, 0, 0, 'moduleclass_sfx=style-glow color-templatecolor\n\n', 0, 0, ''),
(241, 'Icon Set Actions', '<a href="http://icons.yootheme.com/icon-club#set3" target="_blank" style="display: block; text-align: center; text-decoration: none;">\r\n	<img src="images/yootheme/icons_set03.png" width="128" height="85" alt="Actions Icon Set" />\r\n	<span style="display: block; font-size: 16px; line-height: 18px; text-transform: uppercase; margin-top: 5px;">Actions<br />Icon Set</span>\r\n</a>', 9, 'top', 0, '0000-00-00 00:00:00', 1, 'mod_custom', 0, 0, 0, 'moduleclass_sfx=style-glow color-templatecolor\n\n', 0, 0, ''),
(242, 'Icon Set Symbols', '<a href="http://icons.yootheme.com/icon-club#set2" target="_blank" style="display: block; text-align: center; text-decoration: none;">\r\n	<img src="images/yootheme/icons_set02.png" width="128" height="85" alt="Symbols Icon Set" />\r\n	<span style="display: block; font-size: 16px; line-height: 18px; text-transform: uppercase; margin-top: 5px;">Symbols<br />Icon Set</span>\r\n</a>', 10, 'top', 0, '0000-00-00 00:00:00', 1, 'mod_custom', 0, 0, 0, 'moduleclass_sfx=style-glow color-templatecolor\n\n', 0, 0, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_modules_menu`
--

CREATE TABLE IF NOT EXISTS `jos_modules_menu` (
  `moduleid` int(11) NOT NULL DEFAULT '0',
  `menuid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`moduleid`,`menuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jos_modules_menu`
--

INSERT INTO `jos_modules_menu` (`moduleid`, `menuid`) VALUES
(1, 0),
(16, 1),
(16, 48),
(16, 49),
(16, 134),
(16, 135),
(16, 136),
(16, 138),
(16, 140),
(16, 141),
(16, 142),
(16, 145),
(16, 156),
(16, 157),
(16, 158),
(17, 1),
(18, 1),
(18, 48),
(18, 49),
(18, 134),
(18, 135),
(18, 136),
(18, 138),
(18, 140),
(18, 141),
(18, 142),
(18, 145),
(18, 156),
(18, 157),
(18, 158),
(19, 1),
(21, 53),
(22, 1),
(27, 0),
(29, 0),
(32, 0),
(33, 0),
(34, 0),
(35, 0),
(36, 0),
(39, 43),
(39, 44),
(39, 45),
(39, 46),
(39, 47),
(40, 0),
(42, 1),
(42, 48),
(42, 49),
(42, 134),
(42, 135),
(42, 136),
(42, 138),
(42, 140),
(42, 141),
(42, 142),
(42, 145),
(42, 156),
(42, 157),
(42, 158),
(46, 0),
(56, 0),
(68, 58),
(72, 0),
(82, 0),
(83, 58),
(84, 58),
(85, 58),
(86, 58),
(87, 11),
(87, 12),
(87, 13),
(87, 89),
(87, 90),
(87, 91),
(87, 92),
(87, 93),
(87, 94),
(87, 95),
(87, 96),
(87, 97),
(87, 98),
(87, 99),
(87, 100),
(87, 101),
(89, 58),
(117, 53),
(122, 53),
(123, 53),
(124, 53),
(125, 0),
(134, 0),
(136, 0),
(150, 53),
(151, 53),
(155, 54),
(155, 152),
(156, 54),
(156, 152),
(168, 53),
(175, 54),
(175, 152),
(175, 171),
(176, 54),
(176, 152),
(176, 171),
(177, 0),
(178, 0),
(180, 58),
(182, 58),
(183, 53),
(190, 185),
(190, 186),
(190, 188),
(190, 189),
(190, 190),
(190, 191),
(212, 53),
(224, 171),
(225, 53),
(226, 53),
(227, 53),
(228, 53),
(238, 53),
(239, 193),
(240, 193),
(241, 193),
(242, 193);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_newsfeeds`
--

CREATE TABLE IF NOT EXISTS `jos_newsfeeds` (
  `catid` int(11) NOT NULL DEFAULT '0',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `alias` varchar(255) NOT NULL DEFAULT '',
  `link` text NOT NULL,
  `filename` varchar(200) DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `numarticles` int(11) unsigned NOT NULL DEFAULT '1',
  `cache_time` int(11) unsigned NOT NULL DEFAULT '3600',
  `checked_out` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `rtl` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `published` (`published`),
  KEY `catid` (`catid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `jos_newsfeeds`
--

INSERT INTO `jos_newsfeeds` (`catid`, `id`, `name`, `alias`, `link`, `filename`, `published`, `numarticles`, `cache_time`, `checked_out`, `checked_out_time`, `ordering`, `rtl`) VALUES
(4, 1, 'Joomla! - Official News', 'joomla-official-news', 'http://www.joomla.org/index.php?option=com_rss_xtd&feed=RSS2.0&type=com_frontpage&Itemid=1', '', 1, 5, 3600, 0, '0000-00-00 00:00:00', 8, 0),
(4, 2, 'Joomla! - Community News', 'joomla-community-news', 'http://www.joomla.org/index.php?option=com_rss_xtd&feed=RSS2.0&type=com_content&task=blogcategory&id=0&Itemid=33', '', 1, 5, 3600, 0, '0000-00-00 00:00:00', 9, 0),
(6, 3, 'Linux Today', 'linux-today', 'http://linuxtoday.com/backend/my-netscape.rdf', '', 1, 3, 3600, 0, '0000-00-00 00:00:00', 1, 0),
(5, 4, 'Business News', 'business-news', 'http://headlines.internet.com/internetnews/bus-news/news.rss', '', 1, 3, 3600, 0, '0000-00-00 00:00:00', 2, 0),
(5, 5, 'Web Developer News', 'web-developer-news', 'http://headlines.internet.com/internetnews/wd-news/news.rss', '', 1, 3, 3600, 0, '0000-00-00 00:00:00', 3, 0),
(6, 6, 'Linux Central:New Products', 'linux-central-news-products', 'http://linuxcentral.com/backend/lcnew.rdf', '', 1, 3, 3600, 0, '0000-00-00 00:00:00', 4, 0),
(6, 7, 'Linux Central:Best Selling', 'linux-central-best-selling', 'http://linuxcentral.com/backend/lcbestns.rdf', '', 1, 3, 3600, 0, '0000-00-00 00:00:00', 5, 0),
(6, 8, 'Linux Central:Daily Specials', 'linux-central-daily-specials', 'http://linuxcentral.com/backend/lcspecialns.rdf', '', 1, 3, 3600, 0, '0000-00-00 00:00:00', 6, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_plugins`
--

CREATE TABLE IF NOT EXISTS `jos_plugins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `element` text NOT NULL,
  `folder` varchar(100) NOT NULL DEFAULT '',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `published` tinyint(3) NOT NULL DEFAULT '0',
  `iscore` tinyint(3) NOT NULL DEFAULT '0',
  `client_id` tinyint(3) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_folder` (`published`,`client_id`,`access`,`folder`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- Extraindo dados da tabela `jos_plugins`
--

INSERT INTO `jos_plugins` (`id`, `name`, `element`, `folder`, `access`, `ordering`, `published`, `iscore`, `client_id`, `checked_out`, `checked_out_time`, `params`) VALUES
(1, 'Authentication - Joomla', 'joomla', 'authentication', 0, 1, 1, 1, 0, 0, '0000-00-00 00:00:00', ''),
(2, 'Authentication - LDAP', 'ldap', 'authentication', 0, 2, 0, 1, 0, 0, '0000-00-00 00:00:00', 'host=\nport=389\nuse_ldapV3=0\nnegotiate_tls=0\nno_referrals=0\nauth_method=bind\nbase_dn=\nsearch_string=\nusers_dn=\nusername=\npassword=\nldap_fullname=fullName\nldap_email=mail\nldap_uid=uid\n\n'),
(3, 'Authentication - GMail', 'gmail', 'authentication', 0, 4, 0, 0, 0, 0, '0000-00-00 00:00:00', ''),
(4, 'Authentication - OpenID', 'openid', 'authentication', 0, 3, 0, 0, 0, 0, '0000-00-00 00:00:00', ''),
(5, 'User - Joomla!', 'joomla', 'user', 0, 0, 1, 0, 0, 0, '0000-00-00 00:00:00', 'autoregister=1\n\n'),
(6, 'Search - Content', 'content', 'search', 0, 1, 1, 1, 0, 0, '0000-00-00 00:00:00', 'search_limit=50\nsearch_content=1\nsearch_uncategorised=1\nsearch_archived=1\n\n'),
(7, 'Search - Contacts', 'contacts', 'search', 0, 3, 1, 1, 0, 0, '0000-00-00 00:00:00', 'search_limit=50\n\n'),
(8, 'Search - Categories', 'categories', 'search', 0, 4, 1, 0, 0, 0, '0000-00-00 00:00:00', 'search_limit=50\n\n'),
(9, 'Search - Sections', 'sections', 'search', 0, 5, 1, 0, 0, 0, '0000-00-00 00:00:00', 'search_limit=50\n\n'),
(10, 'Search - Newsfeeds', 'newsfeeds', 'search', 0, 6, 1, 0, 0, 0, '0000-00-00 00:00:00', 'search_limit=50\n\n'),
(11, 'Search - Weblinks', 'weblinks', 'search', 0, 2, 1, 1, 0, 0, '0000-00-00 00:00:00', 'search_limit=50\n\n'),
(12, 'Content - Pagebreak', 'pagebreak', 'content', 0, 10000, 1, 1, 0, 0, '0000-00-00 00:00:00', 'enabled=1\ntitle=1\nmultipage_toc=1\nshowall=1\n\n'),
(13, 'Content - Rating', 'vote', 'content', 0, 4, 1, 1, 0, 0, '0000-00-00 00:00:00', ''),
(14, 'Content - Email Cloaking', 'emailcloak', 'content', 0, 5, 1, 0, 0, 0, '0000-00-00 00:00:00', 'mode=1\n\n'),
(15, 'Content - Code Hightlighter (GeSHi)', 'geshi', 'content', 0, 5, 0, 0, 0, 0, '0000-00-00 00:00:00', ''),
(16, 'Content - Load Module', 'loadmodule', 'content', 0, 6, 1, 0, 0, 0, '0000-00-00 00:00:00', 'enabled=1\nstyle=0\n\n'),
(17, 'Content - Page Navigation', 'pagenavigation', 'content', 0, 2, 1, 1, 0, 0, '0000-00-00 00:00:00', 'position=1\n\n'),
(18, 'Editor - No Editor', 'none', 'editors', 0, 0, 1, 1, 0, 0, '0000-00-00 00:00:00', ''),
(19, 'Editor - TinyMCE 2.0', 'tinymce', 'editors', 0, 0, 1, 1, 0, 0, '0000-00-00 00:00:00', 'theme=advanced\ncleanup=1\ncleanup_startup=0\nautosave=0\ncompressed=0\nrelative_urls=1\ntext_direction=ltr\nlang_mode=0\nlang_code=en\ninvalid_elements=applet\ncontent_css=1\ncontent_css_custom=\nnewlines=0\ntoolbar=top\nhr=1\nsmilies=1\ntable=1\nstyle=1\nlayer=1\nxhtmlxtras=0\ntemplate=0\ndirectionality=1\nfullscreen=1\nhtml_height=550\nhtml_width=750\npreview=1\ninsertdate=1\nformat_date=%Y-%m-%d\ninserttime=1\nformat_time=%H:%M:%S\n\n'),
(20, 'Editor - XStandard Lite 2.0', 'xstandard', 'editors', 0, 0, 1, 1, 0, 0, '0000-00-00 00:00:00', ''),
(21, 'Editor Button - Image', 'image', 'editors-xtd', 0, 0, 1, 0, 0, 0, '0000-00-00 00:00:00', ''),
(22, 'Editor Button - Pagebreak', 'pagebreak', 'editors-xtd', 0, 0, 1, 0, 0, 0, '0000-00-00 00:00:00', ''),
(23, 'Editor Button - Readmore', 'readmore', 'editors-xtd', 0, 0, 1, 0, 0, 0, '0000-00-00 00:00:00', ''),
(24, 'XML-RPC - Joomla', 'joomla', 'xmlrpc', 0, 7, 0, 1, 0, 0, '0000-00-00 00:00:00', ''),
(25, 'XML-RPC - Blogger API', 'blogger', 'xmlrpc', 0, 7, 0, 1, 0, 0, '0000-00-00 00:00:00', 'catid=1\nsectionid=0\n\n'),
(27, 'System - SEF', 'sef', 'system', 0, 1, 1, 0, 0, 0, '0000-00-00 00:00:00', ''),
(28, 'System - Debug', 'debug', 'system', 0, 2, 1, 0, 0, 0, '0000-00-00 00:00:00', 'queries=1\nmemory=1\nlangauge=1\n\n'),
(29, 'System - Legacy', 'legacy', 'system', 0, 3, 0, 1, 0, 0, '0000-00-00 00:00:00', 'route=0\n\n'),
(30, 'System - Cache', 'cache', 'system', 0, 4, 0, 1, 0, 0, '0000-00-00 00:00:00', 'browsercache=0\ncachetime=15\n\n'),
(31, 'System - Log', 'log', 'system', 0, 5, 0, 1, 0, 0, '0000-00-00 00:00:00', ''),
(32, 'System - Remember Me', 'remember', 'system', 0, 6, 1, 1, 0, 0, '0000-00-00 00:00:00', ''),
(33, 'System - Backlink', 'backlink', 'system', 0, 7, 0, 1, 0, 0, '0000-00-00 00:00:00', ''),
(35, 'YOOeffects', 'yoo_effects', 'system', 0, 0, 1, 0, 0, 62, '2008-03-27 22:08:03', 'lightbox=1\nreflection=1\nspotlight=1\ngzip=1\n'),
(37, 'ZOO Search', 'zoosearch', 'search', 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', 'search_limit=50\n'),
(38, 'System - Mootools Upgrade', 'mtupgrade', 'system', 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_polls`
--

CREATE TABLE IF NOT EXISTS `jos_polls` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `alias` varchar(255) NOT NULL DEFAULT '',
  `voters` int(9) NOT NULL DEFAULT '0',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `access` int(11) NOT NULL DEFAULT '0',
  `lag` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Extraindo dados da tabela `jos_polls`
--

INSERT INTO `jos_polls` (`id`, `title`, `alias`, `voters`, `checked_out`, `checked_out_time`, `published`, `access`, `lag`) VALUES
(14, 'Joomla! is used for?', 'joomla-is-used-for', 11, 0, '0000-00-00 00:00:00', 1, 0, 86400);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_poll_data`
--

CREATE TABLE IF NOT EXISTS `jos_poll_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pollid` int(11) NOT NULL DEFAULT '0',
  `text` text NOT NULL,
  `hits` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `pollid` (`pollid`,`text`(1))
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Extraindo dados da tabela `jos_poll_data`
--

INSERT INTO `jos_poll_data` (`id`, `pollid`, `text`, `hits`) VALUES
(1, 14, 'Community Sites', 2),
(2, 14, 'Public Brand Sites', 3),
(3, 14, 'eCommerce', 1),
(4, 14, 'Blogs', 0),
(5, 14, 'Intranets', 0),
(6, 14, 'Photo and Media Sites', 2),
(7, 14, 'All of the Above!', 3),
(8, 14, '', 0),
(9, 14, '', 0),
(10, 14, '', 0),
(11, 14, '', 0),
(12, 14, '', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_poll_date`
--

CREATE TABLE IF NOT EXISTS `jos_poll_date` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `vote_id` int(11) NOT NULL DEFAULT '0',
  `poll_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `poll_id` (`poll_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Extraindo dados da tabela `jos_poll_date`
--

INSERT INTO `jos_poll_date` (`id`, `date`, `vote_id`, `poll_id`) VALUES
(1, '2006-10-09 13:01:58', 1, 14),
(2, '2006-10-10 15:19:43', 7, 14),
(3, '2006-10-11 11:08:16', 7, 14),
(4, '2006-10-11 15:02:26', 2, 14),
(5, '2006-10-11 15:43:03', 7, 14),
(6, '2006-10-11 15:43:38', 7, 14),
(7, '2006-10-12 00:51:13', 2, 14),
(8, '2007-05-10 19:12:29', 3, 14),
(9, '2007-05-14 14:18:00', 6, 14),
(10, '2007-06-10 15:20:29', 6, 14),
(11, '2007-07-03 12:37:53', 2, 14);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_poll_menu`
--

CREATE TABLE IF NOT EXISTS `jos_poll_menu` (
  `pollid` int(11) NOT NULL DEFAULT '0',
  `menuid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pollid`,`menuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jos_poll_menu`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_sections`
--

CREATE TABLE IF NOT EXISTS `jos_sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `name` text NOT NULL,
  `alias` varchar(255) NOT NULL DEFAULT '',
  `image` text NOT NULL,
  `scope` varchar(50) NOT NULL DEFAULT '',
  `image_position` varchar(90) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `count` int(11) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_scope` (`scope`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `jos_sections`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_session`
--

CREATE TABLE IF NOT EXISTS `jos_session` (
  `username` varchar(150) DEFAULT '',
  `time` varchar(14) DEFAULT '',
  `session_id` varchar(200) NOT NULL DEFAULT '0',
  `guest` tinyint(4) DEFAULT '1',
  `userid` int(11) DEFAULT '0',
  `usertype` varchar(150) DEFAULT '',
  `gid` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `client_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `data` longtext,
  PRIMARY KEY (`session_id`(64)),
  KEY `whosonline` (`guest`,`usertype`),
  KEY `userid` (`userid`),
  KEY `time` (`time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jos_session`
--

INSERT INTO `jos_session` (`username`, `time`, `session_id`, `guest`, `userid`, `usertype`, `gid`, `client_id`, `data`) VALUES
('', '1281111305', 'c0a2ccbffc13460af0bbc1a237fcf8c9', 1, 0, '', 0, 0, '__default|a:8:{s:22:"session.client.browser";s:88:"Mozilla/5.0 (Windows; U; Windows NT 5.1; pt-BR; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8";s:15:"session.counter";i:4;s:8:"registry";O:9:"JRegistry":3:{s:17:"_defaultNameSpace";s:7:"session";s:9:"_registry";a:1:{s:7:"session";a:1:{s:4:"data";O:8:"stdClass":0:{}}}s:7:"_errors";a:0:{}}s:4:"user";O:5:"JUser":19:{s:2:"id";i:0;s:4:"name";N;s:8:"username";N;s:5:"email";N;s:8:"password";N;s:14:"password_clear";s:0:"";s:8:"usertype";N;s:5:"block";N;s:9:"sendEmail";i:0;s:3:"gid";i:0;s:12:"registerDate";N;s:13:"lastvisitDate";N;s:10:"activation";N;s:6:"params";N;s:3:"aid";i:0;s:5:"guest";i:1;s:7:"_params";O:10:"JParameter":7:{s:4:"_raw";s:0:"";s:4:"_xml";N;s:9:"_elements";a:0:{}s:12:"_elementPath";a:1:{i:0;s:72:"C:\\wamp\\www\\e-profissionalizando\\libraries\\joomla\\html\\parameter\\element";}s:17:"_defaultNameSpace";s:8:"_default";s:9:"_registry";a:1:{s:8:"_default";a:1:{s:4:"data";O:8:"stdClass":0:{}}}s:7:"_errors";a:0:{}}s:9:"_errorMsg";N;s:7:"_errors";a:0:{}}s:13:"session.token";s:32:"a137bd41335faa2615d866fe97052c72";s:19:"session.timer.start";i:1281104525;s:18:"session.timer.last";i:1281106734;s:17:"session.timer.now";i:1281111305;}'),
('', '1281111304', '46b1296e48f1a5a6ac4b6097a7bb8f58', 1, 0, '', 0, 1, '__default|a:8:{s:15:"session.counter";i:4;s:19:"session.timer.start";i:1281095950;s:18:"session.timer.last";i:1281106734;s:17:"session.timer.now";i:1281111304;s:22:"session.client.browser";s:88:"Mozilla/5.0 (Windows; U; Windows NT 5.1; pt-BR; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8";s:8:"registry";O:9:"JRegistry":3:{s:17:"_defaultNameSpace";s:7:"session";s:9:"_registry";a:1:{s:7:"session";a:1:{s:4:"data";O:8:"stdClass":0:{}}}s:7:"_errors";a:0:{}}s:4:"user";O:5:"JUser":19:{s:2:"id";i:0;s:4:"name";N;s:8:"username";N;s:5:"email";N;s:8:"password";N;s:14:"password_clear";s:0:"";s:8:"usertype";N;s:5:"block";N;s:9:"sendEmail";i:0;s:3:"gid";i:0;s:12:"registerDate";N;s:13:"lastvisitDate";N;s:10:"activation";N;s:6:"params";N;s:3:"aid";i:0;s:5:"guest";i:1;s:7:"_params";O:10:"JParameter":7:{s:4:"_raw";s:0:"";s:4:"_xml";N;s:9:"_elements";a:0:{}s:12:"_elementPath";a:1:{i:0;s:72:"C:\\wamp\\www\\e-profissionalizando\\libraries\\joomla\\html\\parameter\\element";}s:17:"_defaultNameSpace";s:8:"_default";s:9:"_registry";a:1:{s:8:"_default";a:1:{s:4:"data";O:8:"stdClass":0:{}}}s:7:"_errors";a:0:{}}s:9:"_errorMsg";N;s:7:"_errors";a:0:{}}s:13:"session.token";s:32:"dae0c650c6164e3ef4dbf2711d742123";}');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_stats_agents`
--

CREATE TABLE IF NOT EXISTS `jos_stats_agents` (
  `agent` varchar(255) NOT NULL DEFAULT '',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `hits` int(11) unsigned NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jos_stats_agents`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_templates_menu`
--

CREATE TABLE IF NOT EXISTS `jos_templates_menu` (
  `template` text NOT NULL,
  `menuid` int(11) NOT NULL DEFAULT '0',
  `client_id` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`menuid`,`client_id`,`template`(255))
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `jos_templates_menu`
--

INSERT INTO `jos_templates_menu` (`template`, `menuid`, `client_id`) VALUES
('eprof', 0, 0),
('khepri', 0, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_users`
--

CREATE TABLE IF NOT EXISTS `jos_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `username` varchar(150) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  `usertype` varchar(75) NOT NULL DEFAULT '',
  `block` tinyint(4) NOT NULL DEFAULT '0',
  `sendEmail` tinyint(4) DEFAULT '0',
  `gid` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `registerDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lastvisitDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `activation` varchar(100) NOT NULL DEFAULT '',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usertype` (`usertype`),
  KEY `idx_name` (`name`(255)),
  KEY `gid_block` (`gid`,`block`),
  KEY `username` (`username`),
  KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=63 ;

--
-- Extraindo dados da tabela `jos_users`
--

INSERT INTO `jos_users` (`id`, `name`, `username`, `email`, `password`, `usertype`, `block`, `sendEmail`, `gid`, `registerDate`, `lastvisitDate`, `activation`, `params`) VALUES
(62, 'Administrator', 'admin', 'leo.lima.web@gmail.com', 'f989cc8ddad3d6cf8b5a4473bd11a7da:Ubx9HNHl2q6yS1l17xKehEO5XOTW70CL', 'Super Administrator', 0, 1, 25, '2010-08-05 11:42:46', '2010-08-05 19:39:19', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `jos_weblinks`
--

CREATE TABLE IF NOT EXISTS `jos_weblinks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `catid` int(11) NOT NULL DEFAULT '0',
  `sid` int(11) NOT NULL DEFAULT '0',
  `title` text NOT NULL,
  `alias` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(250) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `hits` int(11) NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `archived` tinyint(1) NOT NULL DEFAULT '0',
  `approved` tinyint(1) NOT NULL DEFAULT '1',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `catid` (`catid`,`published`,`archived`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `jos_weblinks`
--

INSERT INTO `jos_weblinks` (`id`, `catid`, `sid`, `title`, `alias`, `url`, `description`, `date`, `hits`, `published`, `checked_out`, `checked_out_time`, `ordering`, `archived`, `approved`, `params`) VALUES
(1, 2, 0, 'Joomla!', 'joomla', 'http://www.joomla.org', 'Home of Joomla!', '2005-02-14 15:19:02', 3, 1, 0, '0000-00-00 00:00:00', 1, 0, 1, 'target=0'),
(2, 2, 0, 'php.net', 'php', 'http://www.php.net', 'The language that Joomla! is developed in', '2004-07-07 11:33:24', 6, 1, 0, '0000-00-00 00:00:00', 3, 0, 1, ''),
(3, 2, 0, 'MySQL', 'mysql', 'http://www.mysql.com', 'The database that Joomla! uses', '2004-07-07 10:18:31', 1, 1, 0, '0000-00-00 00:00:00', 5, 0, 1, ''),
(4, 2, 0, 'OpenSourceMatters', 'opensourcematters', 'http://www.opensourcematters.org', 'Home of OSM', '2005-02-14 15:19:02', 11, 1, 0, '0000-00-00 00:00:00', 2, 0, 1, 'target=0'),
(5, 2, 0, 'Joomla! - Forums', 'joomla-forums', 'http://forum.joomla.org', 'Joomla! Forums', '2005-02-14 15:19:02', 4, 1, 0, '0000-00-00 00:00:00', 4, 0, 1, 'target=0'),
(6, 2, 0, 'Ohloh Tracking of Joomla!', 'ohloh-tracking-of-joomla', 'http://www.ohloh.net/projects/20', 'Objective reports from Ohloh about Joomla''s development activity. Joomla! has some star developers with serious kudos.', '2007-07-19 09:28:31', 1, 1, 0, '0000-00-00 00:00:00', 6, 0, 1, 'target=0\n\n');
