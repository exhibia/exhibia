<?php


@db_query("CREATE TABLE if not exists `lobby` (
  `id` int(11) NOT NULL auto_increment,
  `userid` int(11) not null,
  `in_game` varchar(30) NOT NULL default '',
  `timestamp` datetime not null,
  `status` varchar(30) NOT NULL default 'waitting',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;");


@db_query("CREATE TABLE if not exists `games_won` (
  `id` int(11) NOT NULL auto_increment,
  `userid` varchar(30) NOT NULL default 'admin',
  `game` varchar(30) NOT NULL default 'admin',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;");
@db_query("
CREATE TABLE IF NOT EXISTS `game_categories` (
  `categoryID` int(11) NOT NULL auto_increment,
  `language_id` int(11) NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `games_count` int(11) NOT NULL default '0',
  `description` text NOT NULL,
  `picture` varchar(100) NOT NULL default '',
  `status` int(11) NOT NULL default '0',
  `set_and_forget` tinyint(1) default '0',
  `vendor_reqired` varchar(20) default NULL,
  PRIMARY KEY  (`categoryID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;");
@db_query("alter table game_categories add column picture1 text");
@db_query("alter table game_categories add column picture2 text");
@db_query("alter table game_categories add column picture3 text");
@db_query("alter table game_categories add column picture4 text");


@db_query("
CREATE TABLE IF NOT EXISTS `games` (
  `gameID` int(11) NOT NULL auto_increment,
  `categoryID` int(11) NOT NULL,
  `language_id` int(11) NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `description` text NOT NULL,
  `min_players` int(2) not null,
  `max_players` int(2) not null,
  `url` text null,
  `picture1` varchar(100) NOT NULL default '',
  `picture2` varchar(100) NOT NULL default '',
  `picture3` varchar(100) NOT NULL default '',
  `status` int(11) NOT NULL default '0',
  `set_and_forget` tinyint(1) default '0',
  `vendor_reqired` varchar(20) default NULL,
  PRIMARY KEY  (`gameID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;");