<?php
@db_query("CREATE TABLE IF NOT EXISTS `connections` (
  `id` bigint(20) NOT NULL auto_increment,

  `domain` varchar(200) default NULL,
  `joined` varchar(200) NOT NULL,
  `inviter` varchar(255) default NULL,
  `time` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;");

@db_query("CREATE TABLE IF NOT EXISTS `lobby` (
  `id` bigint(20) NOT NULL auto_increment,

  `domain` varchar(200) default NULL,
  `username` varchar(200) NOT NULL,
  `room` varchar(255) default NULL,
  `time` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;");

@db_query("CREATE TABLE IF NOT EXISTS `lobby_messages` (
  `id` bigint(20) NOT NULL auto_increment,

  `domain` varchar(200) default NULL,
  `recipient` varchar(200) NOT NULL,
  `sender` varchar(255) default NULL,
  `message` text not null,
  `time` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;");
@db_query("CREATE TABLE IF NOT EXISTS `in_game` (
  `id` bigint(20) NOT NULL auto_increment,

  `domain` varchar(200) default NULL,
  `username` varchar(200) NOT NULL,
  `room` varchar(255) default NULL,
 
  `time` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;");

@db_query("CREATE TABLE IF NOT EXISTS `game_results` (
  `id` bigint(20) NOT NULL auto_increment,

  `domain` varchar(200) default NULL,
  `username` varchar(200) NOT NULL,
  `room` varchar(255) default NULL,
  `game` varchar(255) default NULL,
  `result` varchar(255) default null,
  `gameID` varchar(255) default null,
  `moves` varchar(500) default null,
  `time` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;");


@db_query("alter table lobby_messages add column alert_type text null;");
@db_query("alter table connections add column timestamp NOT NULL default CURRENT_TIMESTAMP");