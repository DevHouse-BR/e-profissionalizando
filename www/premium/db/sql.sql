-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generatie Tijd: 11 Jun 2008 om 13:55
-- Server versie: 5.0.45
-- PHP Versie: 5.2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `rapiddow_testrs`
--

-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `ads`
--

CREATE TABLE `ads` (
  `aID` int(255) NOT NULL auto_increment,
  `link` varchar(255) NOT NULL,
  `visits` varchar(255) NOT NULL default '0',
  `type` varchar(255) NOT NULL default 'tradedoubler',
  PRIMARY KEY  (`aID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Gegevens worden uitgevoerd voor tabel `ads`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `band`
--

CREATE TABLE `band` (
  `prem` text NOT NULL,
  `bw` bigint(10) NOT NULL default '0',
  `disabled` varchar(225) NOT NULL,
  `id` int(255) NOT NULL auto_increment,
  `type` varchar(255) NOT NULL default 'free',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Gegevens worden uitgevoerd voor tabel `band`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `credittransactions`
--

CREATE TABLE `credittransactions` (
  `Id` int(255) NOT NULL auto_increment,
  `pin` varchar(255) NOT NULL,
  `credits` varchar(255) NOT NULL,
  `destinationid` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  PRIMARY KEY  (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Gegevens worden uitgevoerd voor tabel `credittransactions`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `downloadkey`
--

CREATE TABLE `downloadkey` (
  `Id` int(255) NOT NULL auto_increment,
  `URL` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `active` varchar(255) NOT NULL default '0',
  `date` varchar(255) NOT NULL,
  PRIMARY KEY  (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Gegevens worden uitgevoerd voor tabel `downloadkey`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `downloads`
--

CREATE TABLE `downloads` (
  `dID` mediumint(255) NOT NULL auto_increment,
  `IP` varchar(255) NOT NULL default '',
  `count` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`dID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Gegevens worden uitgevoerd voor tabel `downloads`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `extra`
--

CREATE TABLE `extra` (
  `number` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden uitgevoerd voor tabel `extra`
--

INSERT INTO `extra` VALUES('0');

-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `extradl`
--

CREATE TABLE `extradl` (
  `adId` varchar(255) NOT NULL,
  `IP` varchar(255) NOT NULL,
  `click` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden uitgevoerd voor tabel `extradl`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `gebruikers`
--

CREATE TABLE `gebruikers` (
  `Id` int(11) NOT NULL auto_increment,
  `name` varchar(255) character set latin1 NOT NULL,
  `email` varchar(255) character set latin1 NOT NULL,
  `active` varchar(255) character set latin1 NOT NULL,
  `activationkey` varchar(255) character set latin1 NOT NULL,
  `disabled` varchar(255) character set latin1 NOT NULL,
  `password` varchar(255) character set latin1 NOT NULL,
  PRIMARY KEY  (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Gegevens worden uitgevoerd voor tabel `gebruikers`
--

INSERT INTO `gebruikers` VALUES(1, 'testaccount', 'klaas.vanaudenaerde@gmail.com', '0', 'I1ghuPh27PIexaS2p8U839M9gJLMDbPu', '', 'f3dab2b0599b6ad415c494e63b7bdeed');
INSERT INTO `gebruikers` VALUES(2, 'zeekapitein', 'zeekapitein@gmail.com', '0', 'ABTX9GvTJzNZIBBxMDQRsgt0M9noeO7F', '', '82d240aa20d45f202d79af879d3bd744');
INSERT INTO `gebruikers` VALUES(3, 'fjppitta', 'fjppitta@gmail.com', '0', 'iLG3yOTRJkVCqN0jeMULaog2jmRPJTHS', '', '5fd069b04994db4f3595e88b2664a7b1');
INSERT INTO `gebruikers` VALUES(4, 'iboot', 'iboot2@gmail.com', '0', 'AX5C6ILWKMRdBi4JomtEGWspJz4yFfNp', '', '371ab955fdc11c44c980779c3135b155');
INSERT INTO `gebruikers` VALUES(5, 'powerlogic', 'anakayam.us@gmail.com', '0', 'uvkj4hEH3dIzrZ4NTLaAlQbzkWyelPL6', '', 'e10adc3949ba59abbe56e057f20f883e');
INSERT INTO `gebruikers` VALUES(6, 'jayz', 'jrrumingan@gmail.com', '0', 'kCYJAExqTjoYmRGErxcmdFtLZpdcsmc3', '', '016aa3df6055ffe17589319ffb5d92c9');
INSERT INTO `gebruikers` VALUES(7, 'NwS', 'thomashard007@hotmail.com', '0', 'usRM5lWhXXXoK0ltq9se3XxfyFeMJtjd', '', '668091b9a9f86b359eb881404729a812');
INSERT INTO `gebruikers` VALUES(8, 'Rixcz', 'rixcz@seznam.cz', '0', 'hohBF4P4Pq0aX8l95GO9hSeRsGxrPGYW', '', 'a45958517604f5cd90d6ee51ad9cfdb6');

-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `historydl`
--

CREATE TABLE `historydl` (
  `Id` int(255) NOT NULL auto_increment,
  `rsurl` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `session` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `pin` varchar(255) NOT NULL,
  `regenerate` varchar(255) NOT NULL default '0',
  `time` varchar(255) NOT NULL,
  PRIMARY KEY  (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Gegevens worden uitgevoerd voor tabel `historydl`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `lastdownloads`
--

CREATE TABLE `lastdownloads` (
  `lastdl` varchar(255) NOT NULL,
  `extradl` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Gegevens worden uitgevoerd voor tabel `lastdownloads`
--

INSERT INTO `lastdownloads` VALUES('0', '0');

-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `payment`
--

CREATE TABLE `payment` (
  `pID` int(255) NOT NULL auto_increment,
  `PIN` varchar(255) NOT NULL default '',
  `Valid` varchar(255) NOT NULL default '',
  `email` varchar(255) NOT NULL default '',
  `transaction` varchar(255) NOT NULL,
  `done` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY  (`pID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Gegevens worden uitgevoerd voor tabel `payment`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `phone`
--

CREATE TABLE `phone` (
  `phID` int(255) NOT NULL auto_increment,
  `PIN` varchar(255) NOT NULL,
  `validation` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `revenue` varchar(255) NOT NULL,
  PRIMARY KEY  (`phID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Gegevens worden uitgevoerd voor tabel `phone`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `ref`
--

CREATE TABLE `ref` (
  `refID` int(255) NOT NULL auto_increment,
  `refIP` varchar(255) NOT NULL,
  `pinID` varchar(255) NOT NULL,
  `refTime` varchar(255) NOT NULL,
  PRIMARY KEY  (`refID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Gegevens worden uitgevoerd voor tabel `ref`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `refbuy`
--

CREATE TABLE `refbuy` (
  `Id` int(255) NOT NULL auto_increment,
  `IP` varchar(255) NOT NULL,
  `transaction` varchar(255) character set latin1 collate latin1_spanish_ci NOT NULL,
  `refid` varchar(255) NOT NULL,
  `credits` varchar(255) NOT NULL,
  PRIMARY KEY  (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Gegevens worden uitgevoerd voor tabel `refbuy`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `search`
--

CREATE TABLE `search` (
  `Id` int(255) NOT NULL auto_increment,
  `searchtext` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  PRIMARY KEY  (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Gegevens worden uitgevoerd voor tabel `search`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `servers`
--

CREATE TABLE `servers` (
  `Id` int(10) NOT NULL auto_increment,
  `ServerLink` varchar(255) default NULL,
  `active` char(1) default '1',
  `type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `IPadress` varchar(255) NOT NULL,
  `harddisable` varchar(255) NOT NULL,
  PRIMARY KEY  (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Gegevens worden uitgevoerd voor tabel `servers`
--

INSERT INTO `servers` VALUES(1, 'url.domain.com', '1', 'free', 'servername', 'IP addres of the server', '0');

-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `status`
--

CREATE TABLE `status` (
  `AccountID` int(255) NOT NULL auto_increment,
  `bandwidth` varchar(255) NOT NULL default '',
  `status` varchar(255) NOT NULL default '',
  `type` varchar(255) NOT NULL,
  PRIMARY KEY  (`AccountID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Gegevens worden uitgevoerd voor tabel `status`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `today`
--

CREATE TABLE `today` (
  `tID` int(255) NOT NULL auto_increment,
  `file` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  PRIMARY KEY  (`tID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Gegevens worden uitgevoerd voor tabel `today`
--


-- --------------------------------------------------------

--
-- Tabel structuur voor tabel `users`
--

CREATE TABLE `users` (
  `Id` int(255) NOT NULL auto_increment,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `credits` varchar(255) NOT NULL default '0',
  `type` varchar(255) NOT NULL default 'free',
  `active` int(1) NOT NULL default '0',
  `activatekey` varchar(255) character set latin1 collate latin1_spanish_ci NOT NULL,
  `changepasskey` varchar(255) NOT NULL,
  `newpassword` varchar(255) NOT NULL,
  PRIMARY KEY  (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Gegevens worden uitgevoerd voor tabel `users`
--

