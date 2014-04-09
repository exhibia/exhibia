CREATE TABLE IF NOT EXISTS `addressbook` (
  `EID` bigint(20) unsigned NOT NULL auto_increment,
  `UID` bigint(20) unsigned NOT NULL,
  `Display` char(50) default NULL,
  `E_Mail` char(100) NOT NULL,
  `Info` char(255) default NULL,
  `pa_username` text NOT NULL,
  PRIMARY KEY  (`EID`),
  UNIQUE KEY `EID` (`EID`),
  KEY `EID_2` (`EID`,`UID`,`Display`,`E_Mail`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(30) NOT NULL default 'admin',
  `pass` varchar(30) NOT NULL default 'admin',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `advertgroup` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL default '0',
  `width` int(11) NOT NULL default '0',
  `height` int(11) NOT NULL default '0',
  `stretch` tinyint(3) NOT NULL default '0',
  `delay` int(11) NOT NULL default '2000',
  `effect` varchar(20) NOT NULL default 'random',
  `positionid` int(11) NOT NULL default '0',
  `actived` tinyint(3) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `advertposition` (
  `id` int(11) NOT NULL auto_increment,
  `position` varchar(30) NOT NULL default '0',
  `active` tinyint(3) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `advertslide` (
  `id` int(11) NOT NULL auto_increment,
  `groupid` int(11) NOT NULL default '0',
  `image` varchar(255) NOT NULL default '',
  `url` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `affiliate_transaction` (
  `aff_id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL default '0',
  `referer_id` int(11) NOT NULL default '0',
  `amount` double(2,2) NOT NULL default '0.00',
  `commission` double(2,2) NOT NULL default '0.00',
  `bid_pack_title` varchar(255) NOT NULL default '0',
  `buy_date` date NOT NULL default '0000-00-00',
  `trans_status` char(1) NOT NULL default 'C',
  PRIMARY KEY  (`aff_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `afilliate_links` (
  `id` int(11) NOT NULL auto_increment,
  `addon_value` text NOT NULL,
  `aff_id` text NOT NULL,
  `referal_code` text NOT NULL,
  `affContactId` int(11) default NULL,
  `affID` int(11) default NULL,
  `userid` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `index` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `archive` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `message` varchar(2000) NOT NULL,
  `user` varchar(100) NOT NULL,
  `convoID` int(11) NOT NULL,
  `time` varchar(100) NOT NULL,
  `class` varchar(20) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `auction` (
  `auctionID` int(11) NOT NULL auto_increment,
  `categoryID` int(11) NOT NULL default '0',
  `productID` int(11) NOT NULL default '0',
  `auc_start_price` decimal(5,2) NOT NULL default '0.00',
  `auc_final_price` decimal(5,2) NOT NULL default '0.00',
  `auc_start_date` date NOT NULL default '0000-00-00',
  `auc_end_date` date NOT NULL default '0000-00-00',
  `auc_start_time` varchar(20) NOT NULL default '',
  `auc_end_time` varchar(20) NOT NULL default '',
  `auc_status` varchar(20) NOT NULL default '',
  `auc_type` varchar(50) NOT NULL default '',
  `auc_recurr` varchar(20) NOT NULL default '',
  `buy_user` int(10) NOT NULL default '0',
  `auc_fixed_price` decimal(5,2) NOT NULL default '0.00',
  `fixedpriceauction` int(11) NOT NULL default '0',
  `pennyauction` int(11) NOT NULL default '0',
  `nailbiterauction` int(11) NOT NULL default '0',
  `offauction` int(11) NOT NULL default '0',
  `nightauction` int(11) NOT NULL default '0',
  `openauction` int(11) NOT NULL default '0',
  `time_duration` varchar(10) NOT NULL default '',
  `auc_final_end_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `total_time` int(20) NOT NULL default '0',
  `pause_status` int(2) NOT NULL default '0',
  `shipping_id` int(11) NOT NULL default '0',
  `future_tstamp` double NOT NULL default '0',
  `recurr_count` int(11) NOT NULL default '0',
  `auction_min_price` decimal(5,2) NOT NULL default '0.00',
  `min_win_price` decimal(5,2) NOT NULL default '0.00',
  `use_free` enum('0','1') NOT NULL default '0',
  `allowbuynow` int(11) NOT NULL default '0',
  `buynowprice` decimal(5,2) NOT NULL default '0.00',
  `reverseauction` tinyint(3) NOT NULL default '0',
  `uniqueauction` tinyint(3) NOT NULL default '0',
  `halfbackauction` tinyint(3) NOT NULL default '0',
  `seatauction` tinyint(3) NOT NULL default '0',
  `lockauction` tinyint(3) NOT NULL default '0',
  `locktype` int(11) NOT NULL default '1' COMMENT '1 time 2 price',
  `locktime` int(11) NOT NULL default '0',
  `lockprice` decimal(5,2) NOT NULL default '0.00',
  `bidpack` tinyint(3) NOT NULL default '0',
  `tax1` decimal(5,2) default '0.00',
  `tax2` decimal(5,2) default '0.00',
  `relist` tinyint(3) NOT NULL default '0',
  `minseats` int(11) NOT NULL default '0',
  `maxseats` int(11) NOT NULL default '0',
  `seatbids` int(11) NOT NULL default '0',
  `reserve` decimal(5,2) default NULL,
  `cashauction` varchar(20) default NULL,
  `autolister` tinyint(1) default '0',
  `special_price` varchar(20) default NULL,
  `specialauction` varchar(20) default NULL,
  `allow_multi_bid` tinyint(1) NOT NULL default '0',
  `free_seats` varchar(20) default NULL,
  `beginner_auction` tinyint(1) default '0' null,
  PRIMARY KEY  (`auctionID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14753 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `auction_management` (
  `id` int(11) NOT NULL auto_increment,
  `auc_title` varchar(255) NOT NULL default '',
  `auc_plus_price` decimal(5,2) NOT NULL default '0.00',
  `auc_plus_time` int(20) NOT NULL default '0',
  `max_plus_time` int(11) NOT NULL default '0',
  `auc_manage` varchar(20) NOT NULL default '',
  `picture` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `auction_pause_management` (
  `id` int(11) NOT NULL auto_increment,
  `pause_start_time` time NOT NULL default '00:00:00',
  `pause_end_time` time NOT NULL default '00:00:00',
  `auction_end` enum('0','1') NOT NULL default '0',
  `referral_bids` int(10) NOT NULL default '0',
  `pause_start_timestamp` double NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `auction_running` (
  `id` int(11) NOT NULL auto_increment,
  `auctionID` int(11) NOT NULL,
  `productID` int(11) NOT NULL default '0',
  `auc_start_price` decimal(5,2) NOT NULL default '0.00',
  `auc_status` int(10) NOT NULL default '0',
  `pause_status` int(10) NOT NULL default '0',
  `time_duration` varchar(11) NOT NULL default '',
  `use_free` int(10) NOT NULL default '0',
  `fixedpriceauction` int(10) NOT NULL default '0',
  `pennyauction` int(10) NOT NULL default '0',
  `nailbiterauction` int(10) NOT NULL default '0',
  `offauction` int(10) NOT NULL default '0',
  `nightauction` int(10) NOT NULL default '0',
  `openauction` int(10) NOT NULL default '0',
  `reverseauction` int(10) NOT NULL default '0',
  `uniqueauction` int(10) NOT NULL default '0',
  `halfbackauction` int(10) NOT NULL default '0',
  `seatauction` int(10) NOT NULL default '0',
  `minseats` int(10) NOT NULL default '0',
  `maxseats` int(10) NOT NULL default '0',
  `seatbids` int(10) NOT NULL default '0',
  `lockauction` int(10) NOT NULL default '0',
  `locktype` int(10) NOT NULL default '0',
  `locktime` int(10) NOT NULL default '0',
  `lockprice` decimal(5,2) NOT NULL default '0.00',
  `relist` int(10) NOT NULL default '0',
  `deldate` datetime default NULL,
  `reserve` decimal(5,2) default NULL,
  `cashauction` varchar(20) default NULL,
  `autolister` tinyint(1) default '0',
  `beginner_auction` tinyint(1) default '0' null,
  PRIMARY KEY  (`id`),
  KEY `auctionID` (`auctionID`),
  KEY `productID` (`productID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14887 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `auction_run_status` (
  `id` int(11) NOT NULL auto_increment,
  `auctionID` int(11) NOT NULL,
  `lefttime` int(11) NOT NULL default '0',
  `newprice` decimal(5,2) NOT NULL default '0.00',
  `heighuseravatar` varchar(1000) NOT NULL default '0',
  `heighuser` varchar(255) NOT NULL default '',
  `pause_status` int(11) NOT NULL default '0',
  `uniqueauction` int(10) NOT NULL default '0',
  `lowbidcount` int(10) NOT NULL default '0',
  `seatauction` int(10) NOT NULL default '0',
  `seatauctionnow` int(10) NOT NULL default '1',
  `seatcount` int(10) NOT NULL default '0',
  `minseats` int(10) NOT NULL default '0',
  `auction_message` varchar(200) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `auctionid` (`auctionID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14985 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `auction_seat` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL default '0',
  `auction_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `auction_id` (`auction_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `auc_due_table` (
  `id` int(11) NOT NULL auto_increment,
  `auction_id` int(11) NOT NULL default '0',
  `auc_due_time` int(20) NOT NULL default '0',
  `auc_due_price` decimal(5,2) NOT NULL default '0.00',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `auction_id_2` (`auction_id`),
  KEY `auction_id` (`auction_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14887 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `autolister` (
  `id` int(11) NOT NULL auto_increment,
  `sort` int(11) default NULL,
  `timestamp` text NOT NULL,
  `productID` int(11) NOT NULL,
  `aucstartprice` text,
  `tax1` text,
  `tax2` text,
  `shippingmethod` text,
  `buynowprice` text,
  `start_every` int(11) default NULL,
  `run_for` int(11) default NULL,
  `recur_force` text,
  `recuurences` int(11) default NULL,
  `allow_buy_now` tinyint(1) default NULL,
  `nailbiterauction` tinyint(1) default NULL,
  `offauction` tinyint(1) default NULL,
  `uniqueauction` tinyint(1) default NULL,
  `openauction` tinyint(1) default NULL,
  `pa` tinyint(1) default NULL,
  `fixedpriceauction` tinyint(1) default NULL,
  `reverseauction` tinyint(1) default NULL,
  `auction_id` varchar(20) default NULL,
  `cashauction` tinyint(1) default NULL,
  `halfback` tinyint(1) default NULL,
  `stagger` tinyint(1) default '0',
  `start_now` varchar(20) default NULL,
  `reserve` varchar(20) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34212 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `autolister_settings` (
  `id` int(11) NOT NULL auto_increment,
  `setting` varchar(20) NOT NULL,
  `value` varchar(20) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `avatar` (
  `id` int(10) NOT NULL auto_increment,
  `avatar` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=107 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `bidbutler` (
  `id` int(11) NOT NULL auto_increment,
  `auc_id` int(11) NOT NULL default '0',
  `user_id` int(11) NOT NULL default '0',
  `butler_start_price` decimal(5,2) NOT NULL default '0.00',
  `butler_end_price` decimal(5,2) NOT NULL default '0.00',
  `butler_bid` int(11) NOT NULL default '0',
  `used_bids` int(11) NOT NULL default '0',
  `butler_status` int(3) NOT NULL default '0',
  `place_date` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  KEY `auc_id` (`auc_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1015 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `bidpack` (
  `id` int(11) NOT NULL auto_increment,
  `bidpack_name` varchar(100) NOT NULL default '',
  `bid_size` int(10) NOT NULL default '0',
  `bid_price` decimal(5,2) NOT NULL default '0.00',
  `bidpack_price` decimal(5,2) NOT NULL default '0.00',
  `bidpack_banner` varchar(255) NOT NULL default '',
  `freebids` int(11) NOT NULL default '0',
  `free_point_title` varchar(255) NOT NULL default '',
  `bidpack_banner2` varchar(255) NOT NULL default '',
  `bidpack_banner3` varchar(255) NOT NULL default '',
  `bidpack_banner4` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `bid_account` (
  `id` int(1) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL default '0',
  `bidpack_id` int(11) NOT NULL default '0',
  `bidpack_buy_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `bid_count` int(20) NOT NULL default '0',
  `auction_id` int(11) NOT NULL default '0',
  `product_id` int(11) NOT NULL default '0',
  `bid_flag` varchar(10) NOT NULL default '',
  `bidding_price` decimal(5,2) NOT NULL default '0.00',
  `bidding_type` varchar(10) NOT NULL default '',
  `recharge_type` varchar(10) NOT NULL default '',
  `referer_id` int(10) NOT NULL default '0',
  `bidding_time` int(11) NOT NULL default '0',
  `credit_description` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `auction_id` (`auction_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33105 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `bid_account_bidding` (
  `id` int(10) NOT NULL auto_increment,
  `auction_id` int(10) NOT NULL default '0',
  `user_id` bigint(20) NOT NULL default '0',
  `bid_count` int(10) NOT NULL default '0',
  `username` varchar(50) NOT NULL default '0',
  `position` varchar(50) NOT NULL default '0',
  `bidding_price` decimal(5,2) default '0.00',
  `bidding_type` varchar(4) NOT NULL default '',
  `bidpack_buy_date` datetime NOT NULL,
  `topbidder` int(11) NOT NULL,
  `timestamp` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `auction_id` (`auction_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31363 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `categories` (
  `categoryID` int(11) NOT NULL auto_increment,
  `language_id` int(11) NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `products_count` int(11) NOT NULL default '0',
  `description` text NOT NULL,
  `picture` varchar(100) NOT NULL default '',
  `status` int(11) NOT NULL default '0',
  `set_and_forget` tinyint(1) default '0',
  `vendor_reqired` varchar(20) default NULL,
  PRIMARY KEY  (`categoryID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `community` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `com_short_desc` text NOT NULL,
  `com_long_desc` text NOT NULL,
  `com_date` double NOT NULL default '0',
  `picture1` varchar(255) NOT NULL default '',
  `status` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `community_comment` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL default '0',
  `community_id` int(11) NOT NULL default '0',
  `com_description` text NOT NULL,
  `com_date` double NOT NULL default '0',
  `thumb_up` int(11) NOT NULL default '0',
  `thumb_down` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `community_rating` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL default '0',
  `comment_id` int(11) NOT NULL default '0',
  `status` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `config` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `clientRefresh` int(5) NOT NULL default '2000',
  `adminRefresh` int(5) NOT NULL default '2000',
  `convoRefresh` int(5) NOT NULL default '3500',
  `inactive` int(5) NOT NULL default '3000',
  `end` int(5) NOT NULL default '3000',
  `remove` int(5) NOT NULL default '3000',
  `title` varchar(200) NOT NULL,
  `offlineMessage` varchar(1000) NOT NULL,
  `loginMessage` varchar(1000) NOT NULL,
  `welcome` varchar(500) NOT NULL,
  `leaveAMessage` varchar(1000) NOT NULL,
  `thankYouMessage` varchar(1000) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `countries` (
  `countryId` int(11) NOT NULL auto_increment,
  `iso` char(2) NOT NULL default '',
  `printable_name` varchar(80) NOT NULL default '',
  `iso3` char(3) default NULL,
  `numcode` smallint(6) default NULL,
  `default_pos` bigint(11) default NULL,
  `disabled` smallint(1) default null,
  PRIMARY KEY  (`countryId`),
  KEY `iso` (`iso`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=240 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `custom_content` (
  `id` text,
  `content` longblob
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `emailtemplate` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL default '',
  `subject` varchar(200) NOT NULL default '',
  `content` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `faq` (
  `id` int(11) NOT NULL auto_increment,
  `parent_topic` int(11) NOT NULL default '0',
  `que_title` varchar(255) NOT NULL default '',
  `que_content` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `forums` (
  `forums_id` int(11) NOT NULL auto_increment,
  `forums_category` int(11) NOT NULL default '0',
  `forums_name` varchar(100) NOT NULL default '',
  `forums_description` text NOT NULL,
  `forum_status` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`forums_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `forum_categories` (
  `category_id` int(11) NOT NULL auto_increment,
  `category_order` int(11) NOT NULL default '0',
  `category_name` varchar(50) NOT NULL default '',
  `status` enum('0','1') NOT NULL default '0',
  PRIMARY KEY  (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;
-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `forum_reply` (
  `reply_id` int(11) NOT NULL auto_increment,
  `topicid` int(11) NOT NULL default '0',
  `reply_body` text NOT NULL,
  `reply_user` int(11) NOT NULL default '0',
  `reply_time` double NOT NULL default '0',
  `reply_status` int(11) NOT NULL default '0',
  PRIMARY KEY  (`reply_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `forum_topic` (
  `topic_id` int(11) NOT NULL auto_increment,
  `forum_id` int(11) NOT NULL default '0',
  `topic_title` varchar(255) NOT NULL default '',
  `topic_body` text NOT NULL,
  `topic_starter` int(11) NOT NULL default '0',
  `topic_time` double NOT NULL default '0',
  `topic_status` int(11) NOT NULL default '0',
  PRIMARY KEY  (`topic_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `free_account` (
  `id` int(1) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL default '0',
  `bidpack_id` int(11) NOT NULL default '0',
  `bidpack_buy_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `bid_count` int(20) NOT NULL default '0',
  `auction_id` int(11) NOT NULL default '0',
  `product_id` int(11) NOT NULL default '0',
  `bid_flag` varchar(10) NOT NULL default '',
  `bidding_type` varchar(10) NOT NULL default '',
  `bidding_price` decimal(5,2) NOT NULL default '0.00',
  `recharge_type` varchar(10) NOT NULL default '',
  `credit_description` text NOT NULL,
  `redemption_id` int(11) NOT NULL default '0',
  `bidding_time` double NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `auction_id` (`auction_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1520 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `free_account_bidding` (
  `id` int(11) NOT NULL auto_increment,
  `auction_id` int(10) NOT NULL default '0',
  `user_id` bigint(20) NOT NULL default '0',
  `bid_count` int(10) NOT NULL default '0',
  `username` varchar(50) NOT NULL default '',
  `position` varchar(50) NOT NULL default '',
  `bidding_price` decimal(5,2) default '0.00',
  `bidding_type` varchar(4) NOT NULL default '',
  `bidpack_buy_date` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `auction_id` (`auction_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=81 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `games_won` (
  `id` int(11) NOT NULL auto_increment,
  `userid` varchar(30) NOT NULL default 'admin',
  `game` varchar(30) NOT NULL default 'admin',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `general_setting` (
  `id` int(11) NOT NULL auto_increment,
  `min_bid_price` decimal(5,2) NOT NULL default '0.00',
  `login_flag` enum('0','1') collate latin1_general_ci NOT NULL default '0',
  `login_points` int(11) NOT NULL default '0',
  `reg_message` varchar(255) collate latin1_general_ci NOT NULL,
  `reg_bidpoint` int(10) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `helptopic` (
  `topic_id` int(11) NOT NULL auto_increment,
  `topic_title` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`topic_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `infusion_log` (
  `id` int(11) NOT NULL auto_increment,
  `userid` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `action_taken` text NOT NULL,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `data` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=210 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `language` (
  `id` int(10) NOT NULL auto_increment,
  `language` varchar(50) NOT NULL default '',
  `languagename` varchar(50) NOT NULL default '',
  `enable` tinyint(3) NOT NULL default '0',
  `flag` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `languages` (
  `id` int(11) NOT NULL auto_increment,
  `language` varchar(50) NOT NULL,
  `constant` text NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `language_choices` (
  `id` int(11) NOT NULL auto_increment,
  `abbrev` text NOT NULL,
  `country` text NOT NULL,
  `lang_text` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `index` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `leads` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `transcript` varchar(10000) NOT NULL,
  `date` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `lobby` (
  `id` int(11) NOT NULL auto_increment,
  `userid` int(11) NOT NULL,
  `in_game` varchar(30) NOT NULL default '',
  `timestamp` datetime NOT NULL,
  `status` varchar(30) NOT NULL default 'waitting',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `login_logout` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL default '0',
  `ipaddress` varchar(50) NOT NULL default '',
  `login_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `logout_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `load_time` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 PACK_KEYS=0 AUTO_INCREMENT=12125 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `member_news` (
  `id` int(11) NOT NULL auto_increment,
  `news_title` varchar(100) NOT NULL default '',
  `news_date` date NOT NULL default '0000-00-00',
  `news_short_content` text NOT NULL,
  `news_long_content` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `navigation` (
  `id` int(11) NOT NULL auto_increment,
  `menu_name` varchar(30) NOT NULL,
  `link` varchar(300) NOT NULL,
  `link_text` text NOT NULL,
  `enabled` tinyint(1) NOT NULL default '1',
  `created_by` text,
  `sort` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=70 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `nav_conditionals` (
  `id` int(11) NOT NULL auto_increment,
  `menu_name` text,
  `link_name` text,
  `conditional_type` text,
  `conditional_operator` text,
  `conditional_val` text,
  `affected_table` text,
  `table_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=58 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL auto_increment,
  `news_title` varchar(100) NOT NULL default '',
  `news_date` date NOT NULL default '0000-00-00',
  `news_short_content` text NOT NULL,
  `news_long_content` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `newsletter_email` (
  `id` int(11) NOT NULL auto_increment,
  `date` date NOT NULL default '0000-00-00',
  `subject` varchar(255) NOT NULL default '',
  `content` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `online` (
  `oid` int(10) unsigned NOT NULL auto_increment,
  `user` varchar(255) NOT NULL default '',
  `page` varchar(500) NOT NULL,
  `time` int(10) unsigned NOT NULL,
  `ip` varchar(20) NOT NULL,
  PRIMARY KEY  (`oid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=282607 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `page_areas` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(30) NOT NULL default 'admin',
  `description` varchar(300) NOT NULL default 'admin',
  `menu` text NOT NULL,
  `menu_index` int(11) NOT NULL,
  `invisible` int(1) default NULL,
  `page` text,
  `is_page` int(1) default NULL,
  `created_by` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `page_areas_components` (
  `id` int(11) NOT NULL auto_increment,
  `parent` int(11) default NULL,
  `name` varchar(30) NOT NULL default 'admin',
  `php_replace_vals` text,
  `link` text NOT NULL,
  `link_text` text NOT NULL,
  `ajax_container` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `payment_order` (
  `id` int(10) NOT NULL auto_increment,
  `orderid` varchar(50) NOT NULL,
  `userid` int(10) NOT NULL,
  `amount` decimal(5,2) NOT NULL default '0.00',
  `itemid` int(10) NOT NULL,
  `itemname` varchar(100) NOT NULL default '',
  `itemdescription` varchar(200) NOT NULL default '',
  `payfor` varchar(30) NOT NULL default '',
  `data` varchar(1000) NOT NULL default '',
  `status` int(10) NOT NULL default '0',
  `paymentway` varchar(50) NOT NULL default '0',
  `datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  `sess_id` varchar(200) NOT NULL,
  `auction_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=789 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `payment_order_history` (
  `id` int(10) NOT NULL auto_increment,
  `orderid` varchar(50) NOT NULL default '',
  `userid` int(11) NOT NULL default '0',
  `amount` decimal(5,2) NOT NULL default '0.00',
  `shippingcharge` decimal(5,2) NOT NULL default '0.00',
  `itemid` int(11) NOT NULL default '0',
  `itemname` varchar(100) NOT NULL default '',
  `itemdescription` varchar(200) NOT NULL default '',
  `payfor` varchar(30) NOT NULL default '',
  `paymentway` varchar(50) NOT NULL default '',
  `datetime` datetime NOT NULL,
  `sess_id` varchar(500) default NULL,
  `insert_id` varchar(500) default NULL,
  `auction_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `userid` (`userid`),
  KEY `itemid` (`itemid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=412 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `paypal_info` (
  `id` int(11) NOT NULL auto_increment,
  `business_id` varchar(100) NOT NULL default '',
  `token` varchar(255) NOT NULL default '',
  `enabled` tinyint(4) NOT NULL default '1',
  `testmode` tinyint(4) NOT NULL default '1',
  `name` varchar(255) NOT NULL,
  `additional1` varchar(255) default NULL,
  `additional2` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `pluginsetting` (
  `id` int(10) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL default '',
  `option1` varchar(200) NOT NULL default '',
  `option2` varchar(200) NOT NULL default '',
  `option3` varchar(200) NOT NULL default '',
  `option4` varchar(1000) NOT NULL default '',
  `option5` varchar(1000) NOT NULL default '',
  `option6` varchar(1000) NOT NULL default '',
  `option7` varchar(200) NOT NULL default '',
  `option8` varchar(200) NOT NULL default '',
  `option9` varchar(200) NOT NULL default '',
  `option10` varchar(200) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `products` (
  `productID` int(11) NOT NULL auto_increment,
  `categoryID` int(11) NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `custmer_rating` decimal(5,2) NOT NULL default '0.00',
  `price` decimal(5,2) NOT NULL default '0.00',
  `enabled` int(10) NOT NULL default '0',
  `product_code` varchar(25) NOT NULL default '',
  `short_desc` varchar(255) NOT NULL default '',
  `long_desc` text NOT NULL,
  `picture1` varchar(255) NOT NULL default '',
  `picture_thumb` varchar(255) NOT NULL default '',
  `picture2` varchar(255) NOT NULL default '',
  `picture3` varchar(255) NOT NULL default '',
  `picture4` varchar(255) NOT NULL default '',
  `picture_popup` varchar(255) NOT NULL default '',
  `metatags` text NOT NULL,
  `metadescription` text NOT NULL,
  `actual_cost` decimal(5,2) NOT NULL default '0.00',
  `product_qty` int(11) NOT NULL default '0',
  `qty_flag` enum('0','1') NOT NULL default '0',
  `winner_title` varchar(255) NOT NULL default '',
  `msrp` varchar(20) default NULL,
  `default_tx1` varchar(20) default NULL,
  `default_tx2` varchar(20) default NULL,
  `default_shippingmethod` varchar(20) default NULL,
  `featured` varchar(1) default NULL,
  `special_type` varchar(1) default NULL,
  `sub_cat` int(20) default NULL,
  `features` text,
  `sess_id` varchar(20) default NULL,
  `manufacturer` varchar(20) default NULL,
  `manufacturer_logo` varchar(20) default NULL,
  `product_type` varchar(200) default NULL,
  `sub_category` int(11) default NULL,
  `download_url` longtext,
  `enable_tax` tinyint(1) default NULL,
  `set_and_forget` tinyint(1) default '0',
  `default_reserve` varchar(20) default NULL,
  `enable_reserve` tinyint(1) default '0',
  `vendor` varchar(20) default NULL,
  `free_points` varchar(20) default NULL,
  `bid_points` varchar(20) default NULL,
  `credit_back` varchar(20) default NULL,
  PRIMARY KEY  (`productID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=219 ;

-- NEXT_QUERY --

INSERT INTO `categories` VALUES (19,1,'Test Auctions',2,'','',1,0,NULL);

-- NEXT_QUERY --

INSERT INTO `products` VALUES (null,19,'bid pack 25',0.00,53.00,1,'89uff43jh9n','start off small get more later','start off small get more later','1_1377057490_bid_65.png','','','','','','more, later, get, small, off, start','start off small get more later',1.00,0,'0','','15','0','0','7',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'',0,NULL,'5','65',''),(null,19,'Bid Pack 100',0.00,70.00,1,'ljh[9o4','you cant play without bids.. get started now..','you cant play without bids.. get started now..','1_1377057609_bids_100.png','','','','','','get, started, now, bids, without, cant, play, you','you cant play without bids.. get started now..',6.00,0,'0','','100','0','0','7',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'',0,NULL,'5','100','');

-- NEXT_QUERY --

INSERT INTO `auction` VALUES (14753,19,219,0.01,0.00,'2013-08-21','2013-08-21','14:34:51','15:14:00','2','','',0,0.00,0,0,0,0,0,0,'none','0000-00-00 00:00:00',2349,0,7,1377095691,0,0.00,0.00,'',1,53.00,0,0,0,0,0,1,0,0.00,0,0.00,0.00,1,0,0,0,0.00,'',0,NULL,NULL,0,NULL,0),(14754,19,220,0.01,0.00,'2013-08-21','2013-08-24','15:13:35','00:00:00','2','','',0,0.00,0,0,0,0,0,0,'10sa','0000-00-00 00:00:00',204385,0,7,1377098015,0,0.00,0.00,'',0,0.00,0,0,0,0,0,1,0,0.00,0,0.00,0.00,1,0,0,0,0.00,'',0,NULL,NULL,0,NULL,0),(14755,19,219,0.01,0.00,'2013-08-21','2013-08-22','15:38:04','01:38:04','2','','',0,0.00,0,1,0,0,0,0,'20sa','0000-00-00 00:00:00',36000,0,7,1377099484,0,0.00,0.00,'',1,53.00,0,0,0,0,0,1,0,0.00,0,0.00,0.00,1,0,0,0,0.00,'0',1,NULL,NULL,0,NULL,0),(14756,19,220,0.01,0.00,'2013-08-21','2013-08-22','15:38:04','11:38:04','2','','',0,0.00,0,1,0,0,0,0,'20sa','0000-00-00 00:00:00',72000,0,7,1377099484,0,0.00,0.00,'',1,70.00,0,0,0,0,0,1,0,0.00,0,0.00,0.00,1,0,0,0,0.00,'0',1,NULL,NULL,0,NULL,0);

-- NEXT_QUERY --

INSERT INTO `auction_running` VALUES (14887,14755,219,0.01,2,0,'20sa',0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0.00,1,NULL,0.00,'',1,0),(14888,14756,220,0.01,2,0,'20sa',0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0.00,1,NULL,0.00,'',1,0);

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `product_ratings` (
  `id` int(11) NOT NULL auto_increment,
  `productid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `stars` int(11) NOT NULL default '1',
  `text` longtext,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `product_types` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(20) NOT NULL,
  `addon_directory` varchar(20) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `product_types_data` (
  `id` int(11) NOT NULL auto_increment,
  `product_type` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `value` varchar(20) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `redemption` (
  `id` int(11) NOT NULL auto_increment,
  `category_id` int(11) NOT NULL default '0',
  `product_id` int(11) NOT NULL default '0',
  `redem_qty` int(11) NOT NULL default '0',
  `redem_points` int(11) NOT NULL default '0',
  `redem_startdate` date NOT NULL default '0000-00-00',
  `redem_enddate` date NOT NULL default '0000-00-00',
  `redem_soldqty` int(11) NOT NULL default '0',
  `redem_shipping` int(6) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `redemption_order` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL default '0',
  `redem_id` int(11) NOT NULL default '0',
  `pur_date` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `refer_points` (
  `id` int(11) NOT NULL auto_increment,
  `dsipensed` int(11) NOT NULL,
  `bid_points` text NOT NULL,
  `userid` text NOT NULL,
  `reason` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `index` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=84 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `refer_points_admin` (
  `id` int(11) NOT NULL auto_increment,
  `num_times_to_dispense` int(11) NOT NULL,
  `bid_points` text NOT NULL,
  `retrieve_condition` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `index` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `registration` (
  `id` int(10) NOT NULL auto_increment,
  `username` varchar(100) default NULL,
  `firstname` varchar(100) default NULL,
  `lastname` varchar(100) default NULL,
  `sex` varchar(10) default NULL,
  `birth_date` varchar(50) default NULL,
  `addressline1` varchar(255) default NULL,
  `addressline2` varchar(255) default NULL,
  `city` varchar(100) default NULL,
  `state` varchar(100) default NULL,
  `country` varchar(100) default NULL,
  `postcode` varchar(50) default NULL,
  `phone` varchar(50) default NULL,
  `email` varchar(150) default NULL,
  `password` varchar(50) default NULL,
  `delivery_name` varchar(100) default NULL,
  `delivery_addressline1` varchar(255) default NULL,
  `delivery_addressline2` varchar(255) default NULL,
  `delivery_city` varchar(100) default NULL,
  `delivery_state` varchar(100) default NULL,
  `delivery_country` varchar(100) default NULL,
  `delivery_postcode` varchar(50) default NULL,
  `delivery_phone` varchar(50) default NULL,
  `terms_condition` int(5) default NULL,
  `privacy` int(5) default NULL,
  `newsletter` int(5) default NULL,
  `account_status` int(2) default NULL,
  `newsletter_email` varchar(100) default NULL,
  `final_bids` int(11) default NULL,
  `member_status` enum('0','1') default NULL,
  `user_delete_flag` varchar(10) default NULL,
  `sponser` int(11) default NULL,
  `registration_date` date default NULL,
  `registration_ip` varchar(100) default NULL,
  `verifycode` varchar(255) default NULL,
  `admin_user_flag` int(11) default NULL,
  `dummy_time` double default NULL,
  `free_bids` int(11) default NULL,
  `avatarid` int(11) default NULL,
  `position` varchar(50) default NULL,
  `infusion_id` text,
  `afilliate` int(11) default NULL,
  `vendors` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `reserve_emails` (
  `auction_id` int(11) NOT NULL,
  `recipient` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` int(11) NOT NULL auto_increment,
  `userID` varchar(200) NOT NULL,
  `convoID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `initiated` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `ended` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `answered` int(11) NOT NULL,
  `contact` varchar(3) NOT NULL default 'no',
  `hide` varchar(3) NOT NULL default 'no',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `settings_array` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL default '0',
  `text` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `shipping` (
  `id` int(11) NOT NULL auto_increment,
  `shippingcharge` double(5,2) NOT NULL default '0.00',
  `shipping_title` varchar(255) NOT NULL default '',
  `description` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `shippingstatus` (
  `id` int(10) NOT NULL auto_increment,
  `shippingtypeid` int(10) NOT NULL default '0',
  `orderid` varchar(200) NOT NULL default '0',
  `ordertype` int(10) NOT NULL default '0' COMMENT '1: won auction 2:buy it now',
  `tracknumber` varchar(100) NOT NULL default '',
  `adddate` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=262 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `sitesetting` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(200) NOT NULL,
  `value` varchar(255) default NULL,
  `license_key` text,
  `status` int(1) NOT NULL,
  `license` varchar(200) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1855 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `social_support` (
  `id` int(10) NOT NULL auto_increment,
  `socialname` varchar(50) NOT NULL default '',
  `socialpath` varchar(255) NOT NULL default '',
  `socialurl` varchar(255) NOT NULL default '',
  `actived` tinyint(3) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `static_pages` (
  `id` int(11) NOT NULL auto_increment,
  `page` varchar(300) not null,
  `content` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `style_sheets` (
  `id` int(11) NOT NULL auto_increment,
  `template` text NOT NULL,
  `page` text,
  `selector` varchar(200) default NULL,
  `property` text,
  `value` text,
  `type` varchar(20) default NULL,
  `human_name` varchar(200) default NULL,
  `human_description` varchar(200) default NULL,
  `editable` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3152 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `sub_categories` (
  `id` int(11) NOT NULL auto_increment,
  `category` varchar(20) NOT NULL,
  `name` longtext,
  `status` varchar(1) NOT NULL,
  `description` longtext,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `taxclass` (
  `id` int(11) NOT NULL auto_increment,
  `country` varchar(150) NOT NULL,
  `state` varchar(150) NOT NULL,
  `percent` varchar(5) NOT NULL,
  `enable` tinyint(1) default NULL,
  `f_tax` varchar(5) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `templates` (
  `id` int(11) NOT NULL auto_increment,
  `template` text NOT NULL,
  `template_description` varchar(500) NOT NULL,
  `created_by` text NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `index` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=69 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `template_pointer` (
  `id` int(11) NOT NULL auto_increment,
  `template_name` text NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `index` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `testimonials` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL default '0',
  `picture` text,
  `date` date NOT NULL,
  `text` text NOT NULL,
  `status` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `transcript` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `message` varchar(2000) NOT NULL,
  `user` varchar(100) NOT NULL,
  `convoID` int(11) NOT NULL,
  `time` varchar(100) NOT NULL,
  `class` varchar(20) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `captcha_codes` (
  `id` int(11) NOT NULL auto_increment,
  `captcha_code` varchar(200) not null,
  `ip_address` int(11) NOT NULL,
  `datetime` varchar(200) NOT NULL,

  PRIMARY KEY  (`id`)
  
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `unique_bid` (
  `id` int(11) NOT NULL auto_increment,
  `auctionid` int(11) NOT NULL default '0',
  `userid` int(11) NOT NULL default '0',
  `bidprice` decimal(5,2) NOT NULL default '0.00',
  `adddate` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `auctionid` (`auctionid`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- NEXT_QUERY --

CREATE TABLE `userdata` (
  `UID` bigint(20) unsigned NOT NULL auto_increment,
  `Username` char(50) NOT NULL,
  `DisplayName` char(50) default NULL,
  `Signature` char(255) default NULL,
  PRIMARY KEY  (`UID`),
  UNIQUE KEY `UID` (`UID`,`Username`),
  KEY `UID_2` (`UID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `admin` varchar(3) NOT NULL,
  `available` varchar(3) NOT NULL default 'no',
  `keepAlive` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `user_coupon_history` (
  `id` int(11) NOT NULL auto_increment,
  `regid` int(11) default NULL,
  `couponid` int(11) default NULL,
  `usedate` date default NULL,
  `uniqueid` varchar(50) default NULL,
  PRIMARY KEY  (`id`),
  KEY `regid` (`regid`),
  KEY `couponid` (`couponid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `user_levels` (
  `id` int(11) NOT NULL auto_increment,
  `admin_level` varchar(50) NOT NULL default '0',
  `allowed_pages` longblob,
  `addons` longblob,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `user_vouchers` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL default '0',
  `voucherid` int(11) NOT NULL default '0',
  `issuedate` datetime NOT NULL default '0000-00-00 00:00:00',
  `expirydate` datetime NOT NULL default '0000-00-00 00:00:00',
  `used_auction` varchar(20) NOT NULL default '',
  `voucher_status` int(11) NOT NULL default '0',
  `voucher_desc` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 PACK_KEYS=0 AUTO_INCREMENT=83 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `usstates` (
  `id` int(11) NOT NULL auto_increment,
  `stname` varchar(255) default NULL,
  `stcode` varchar(255) default NULL,
  `country` varchar(2) default null,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=68 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `vendors` (
  `id` int(11) NOT NULL auto_increment,
  `company_name` varchar(50) NOT NULL default '0',
  `address1` varchar(100) default NULL,
  `city` varchar(100) default NULL,
  `state` varchar(100) default NULL,
  `country` varchar(100) default NULL,
  `zipcode` varchar(100) default NULL,
  `email` varchar(100) default NULL,
  `phone` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `vouchers` (
  `id` int(11) NOT NULL auto_increment,
  `voucher_title` varchar(255) NOT NULL default '',
  `combinable` enum('0','1') NOT NULL default '0',
  `bids_amount` decimal(5,2) NOT NULL default '0.00',
  `newuser_flag` enum('0','1') NOT NULL default '0',
  `validity` float NOT NULL default '0',
  `voucher_type` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 PACK_KEYS=0 AUTO_INCREMENT=5 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `watchlist` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL default '0',
  `auc_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `auc_id` (`auc_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `similar_products_bids` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `auctionID` bigint(20) unsigned NOT NULL,
  `productID` bigint(20) NOT NULL,
  `userid` int(11) default NULL,
  `bid_price` varchar(20) default NULL,
  `datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=638 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `shippingtype` (
  `id` int(10) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL default '',
  `logoimage` varchar(255) NOT NULL default '',
  `url` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `similar_products` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `auctionID` bigint(20) unsigned NOT NULL,
  `productID` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `won_auctions` (
  `id` int(11) NOT NULL auto_increment,
  `auction_id` int(11) NOT NULL default '0',
  `accept_denied` varchar(100) NOT NULL default '',
  `userid` int(11) NOT NULL default '0',
  `won_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `accept_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `payment_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `referral_userid` int(11) NOT NULL default '0',
  `order_status` int(6) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `auction_id_2` (`auction_id`),
  KEY `auction_id` (`auction_id`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2900 ;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `won_auctions2` (
  `id` int(11) NOT NULL auto_increment,
  `auction_id` int(11) NOT NULL default '0',
  `accept_denied` varchar(100) NOT NULL default '',
  `userid` int(11) NOT NULL default '0',
  `won_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `accept_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `payment_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `referral_userid` int(11) NOT NULL default '0',
  `order_status` int(6) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `auction_id` (`auction_id`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=704 ;

-- NEXT_QUERY --

CREATE TABLE `user_ranking_rules` (
  `id` int(11) NOT NULL auto_increment,
  `row_to_match` varchar(50) NOT NULL default '0',
  `rank_name` varchar(200) NOT NULL,
  `min_amount` text,
  `rank_image` text,
  `bids_awarded` int(11) default NULL,
  `free_bids_awarded` int(11) default NULL,
   `allow_multiple` int(1) null,
   `preference` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- NEXT_QUERY --

CREATE TABLE `user_ranking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` varchar(50) NOT NULL DEFAULT '0',
  `rank_name` varchar(200) not null,
  `rank_id` int(11) not null default '0',
  `rank_image` text null,
   PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- NEXT_QUERY --

INSERT INTO `addressbook` (`EID`, `UID`, `Display`, `E_Mail`, `Info`, `pa_username`) VALUES
(null, 1, 'demo', 'edward.goodnow@gmail.com', '{"0":"3","id":"3","1":"demo","username":"demo","2":"Edward","firstname":"Edward","3":"Goodnow","lastname":"Goodnow","4":"Male","sex":"Male","5":"02-03-1954","birth_date":"02-03-1954","6":"605 Union St","addressline1":"605 Union St","7":"","addressline2":"', 'Edward Goodnow'),
(null, 1, 'joelsteele', 'buywithjoel@gmail.com', '{"0":"2","id":"2","1":"joelsteele","username":"joelsteele","2":"Joel","firstname":"Joel","3":"Asadoorian","lastname":"Asadoorian","4":"Male","sex":"Male","5":"12-16-1976","birth_date":"12-16-1976","6":"91a hall rd.","addressline1":"91a hall rd.","7":"","a', 'Joel Asadoorian');

-- NEXT_QUERY --

INSERT INTO `admin` (`id`, `username`, `pass`) VALUES
(null, 'admin', 'admin');

-- NEXT_QUERY --

INSERT INTO `advertgroup` (`id`, `name`, `width`, `height`, `stretch`, `delay`, `effect`, `positionid`, `actived`) VALUES
(null, 'BannerWide', 192, 267, 0, 3000, 'random', 2, 1),
(null, 'Horizontal Main', 699, 110, 0, 3000, 'random', 1, 1),
(null, 'Banner Left', 130, 150, 0, 3000, 'random', 3, 0),
(null, 'Banner Right', 135, 180, 0, 3000, 'random', 4, 0),
(null, 'Main2', 699, 80, 0, 3000, 'rain', 1, 0);

-- NEXT_QUERY --

INSERT INTO `advertposition` (`id`, `position`, `active`) VALUES
(null, 'Horizontal Main', 1),
(null, 'Banner Wide', 1),
(null, 'Banner Left', 1),
(null, 'Banner Right', 1);

-- NEXT_QUERY --

INSERT INTO `auction_management` (`id`, `auc_title`, `auc_plus_price`, `auc_plus_time`, `max_plus_time`, `auc_manage`, `picture`) VALUES
(null, 'Default', 0.01, 30, 5, 'none', 'clock.php?time=30'),
(null, '20-Second Auction', 0.01, 20, 5, '20sa', 'clock.php?time=20'),
(null, '13-Second Auction', 0.01, 13, 5, '15sa', 'clock.php?time=13'),
(null, '10-Second Auction', 0.01, 10, 5, '10sa', 'clock.php?time=10'),
(null, '15-Second Auction', 0.01, 15, 5, '15sa', 'clock.php?time=15');

-- NEXT_QUERY --


INSERT INTO `auction_pause_management` (`id`, `pause_start_time`, `pause_end_time`, `auction_end`, `referral_bids`, `pause_start_timestamp`) VALUES
(null, '00:00:00', '00:00:00', '0', 0, 1355720400),
(null, '00:00:00', '00:00:00', '0', 0, 0),
(null, '00:00:00', '00:00:00', '0', 50, 0),
(null, '00:00:00', '00:00:00', '0', 146, 0);

-- NEXT_QUERY --

CREATE TABLE `user_product` (
  `id` int(11) NOT NULL auto_increment,
  `productid` int(11) NOT NULL default '0',
  `userid` int(11) NOT NULL default '0',
  `price` float(20,2) NOT NULL default '0.00',
  `status` int(11) NOT NULL default '0' COMMENT '1,payment,2 sent product',
  `buydate` datetime NOT NULL default '0000-00-00 00:00:00',
  `sess_id` text NULL,
  `quantity` varchar(20) default NULL,
  `option1` varchar(20) default NULL,
  `option2` varchar(20) default NULL,
  `option3` varchar(20) default NULL,
  `option4` varchar(20) default NULL,
  `folder` text,
  PRIMARY KEY  (`id`),
  KEY `productid` (`productid`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM AUTO_INCREMENT=327 DEFAULT CHARSET=latin1;

-- NEXT_QUERY --

INSERT INTO `autolister_settings` (`id`, `setting`, `value`) VALUES
(null, 'test', '10'),
(null, 'max_auctions', '10'),
(null, 'submit', 'Submit Query'),
(null, 'allowbuynow', '1'),
(null, 'reserve', '1'),
(null, 'runtime', '600'),
(null, 'delay', '60'),
(null, 'allowbuynow', '1'),
(null, 'bidpacks', '1');

-- NEXT_QUERY --

INSERT INTO `avatar` (`id`, `avatar`) VALUES
(null, '1274709724_026.png'),
(null, '1274709957_029.png'),
(null, '1274710053_030.png'),
(null, '1274710060_031.png'),
(null, '1274710065_035.png'),
(null, '1274710069_038.png'),
(null, '1274710074_043.png'),
(null, '1274710078_245.png'),
(null, '1274710084_286.png'),
(null, '1274710090_357.png'),
(null, '1274710093_401.png'),
(null, '1274710097_542.png'),
(null, '1274710107_alien.png'),
(null, '1274710114_Ambulance.png'),
(null, '1274710121_arrow.png'),
(null, '1274710127_Asimo.png'),
(null, '1274710135_atom.png'),
(null, '1274710142_BlackHeart.png'),
(null, '1274710150_BlueRobot.png'),
(null, '1274710156_BondSuit.png'),
(null, '1274710164_Briefcase.png'),
(null, '1274710170_Butterfly.png'),
(null, '1274710191_cat.png'),
(null, '1274710223_cat2.png'),
(null, '1274710231_catdroid.png'),
(null, '1274710237_Chain.png'),
(null, '1274710245_Chess.png'),
(null, '1274710252_CircleDesign.png'),
(null, '1274710260_CopBadge.png'),
(null, '1274710271_Cowboy.png'),
(null, '1274710277_DaBomb.png'),
(null, '1274710287_default.png'),
(null, '1274710294_default2.png'),
(null, '1274710301_default3.png'),
(null, '1274710308_devil.png'),
(null, '1274710315_dinosaur.png'),
(null, '1274710322_Dog.png'),
(null, '1274710334_Donkey.png'),
(null, '1274710343_Doughboy.png'),
(null, '1274710350_Dragonfly.png'),
(null, '1274710359_Drama.png'),
(null, '1274710365_drone.png'),
(null, '1274710375_elephant.png'),
(null, '1274710388_Feather.png'),
(null, '1274710401_firebird.png'),
(null, '1274710411_Flower.png'),
(null, '1274710426_Forklift.png'),
(null, '1274710435_Frog.png'),
(null, '1274710440_Globe.png'),
(null, '1274710449_Guitar.png'),
(null, '1274710458_Gun.png'),
(null, '1274710465_Headphones.png'),
(null, '1274710475_Helmet.png'),
(null, '1274710482_Key.png'),
(null, '1274710491_Kong.png'),
(null, '1274710498_Ladybug.png'),
(null, '1274710508_Lizard.png'),
(null, '1274710517_maclogo.png'),
(null, '1274710525_MagicHat.png'),
(null, '1274710534_Magnet.png'),
(null, '1274710542_MinerHat.png'),
(null, '1274710551_monkey.png'),
(null, '1274710562_Monopoly.png'),
(null, '1274710571_Motorcycle.png'),
(null, '1274710578_Pacman.png'),
(null, '1274710587_Patriot.png'),
(null, '1274710596_Pen.png'),
(null, '1274710606_Penguin.png'),
(null, '1274710614_Perfume.png'),
(null, '1274710622_Phoenix.png'),
(null, '1274710632_Plane.png'),
(null, '1274710640_Porsche.png'),
(null, '1274710650_Pumpkin.png'),
(null, '1274710660_PurpleTruck.png'),
(null, '1274710670_Rabbit.png'),
(null, '1274710679_record.png'),
(null, '1274710688_RedHeart.png'),
(null, '1274710697_RoboDog.png'),
(null, '1274710709_Robot.png'),
(null, '1274710718_Scream.png'),
(null, '1274710730_shadowman.png'),
(null, '1274710740_Shark.png'),
(null, '1274711304_Sheriff.png'),
(null, '1274711312_Sherlock.png'),
(null, '1274711322_SherlockBomb.png'),
(null, '1274711340_Smiley.png'),
(null, '1274711351_Snowman.png'),
(null, '1274711359_Spaceship.png'),
(null, '1274711369_Speakerbox.png'),
(null, '1274711376_StopWatch.png'),
(null, '1274711386_Submarine.png'),
(null, '1274711393_Sushi.png'),
(null, '1274711399_Taxi.png'),
(null, '1274711412_Truck.png'),
(null, '1274711419_UFO.png'),
(null, '1274711427_Umbrella.png'),
(null, '1274711434_Watch.png'),
(null, '1274711441_WhiteAlien.png'),
(null, '1274711448_WhiteBeard.png');

-- NEXT_QUERY --

INSERT INTO `bidpack` (`id`, `bidpack_name`, `bid_size`, `bid_price`, `bidpack_price`, `bidpack_banner`, `freebids`, `free_point_title`, `bidpack_banner2`, `bidpack_banner3`, `bidpack_banner4`) VALUES
(null, 'Bid Pack 25', 25, 14.75, 14.75, '1372808524_pasbidpacksmall.png', 0, '', '', '', ''),
(null, 'Bid Pack 50', 50, 29.00, 29.00, '1372808559_pasbidpacklight.png', 0, '', '', '', ''),
(null, 'Bid Pack 100', 100, 57.00, 57.00, '1372809125_pasbidpackMEDIUM.png', 0, '', '', '', ''),
(null, 'BidPack 250', 250, 140.00, 140.00, '1372809166_pasbidpackLARGE.png', 0, '', '', '', ''),
(null, 'BidPack 500', 500, 275.00, 275.00, '1369756150_bp-500.png', 0, '', '', '', '');

-- NEXT_QUERY --

INSERT INTO `countries` (`countryId`, `iso`, `printable_name`, `iso3`, `numcode`) VALUES
(null, 'AF', 'Afghanistan', 'AFG', 4),
(null, 'AL', 'Albania', 'ALB', 8),
(null, 'DZ', 'Algeria', 'DZA', 12),
(null, 'AS', 'American Samoa', 'ASM', 16),
(null, 'AD', 'Andorra', 'AND', 20),
(null, 'AO', 'Angola', 'AGO', 24),
(null, 'AI', 'Anguilla', 'AIA', 660),
(null, 'AQ', 'Antarctica', NULL, NULL),
(null, 'AG', 'Antigua and Barbuda', 'ATG', 28),
(null, 'AR', 'Argentina', 'ARG', 32),
(null, 'AM', 'Armenia', 'ARM', 51),
(null, 'AW', 'Aruba', 'ABW', 533),
(null, 'AU', 'Australia', 'AUS', 36),
(null, 'AT', 'Austria', 'AUT', 40),
(null, 'AZ', 'Azerbaijan', 'AZE', 31),
(null, 'BS', 'Bahamas', 'BHS', 44),
(null, 'BH', 'Bahrain', 'BHR', 48),
(null, 'BD', 'Bangladesh', 'BGD', 50),
(null, 'BB', 'Barbados', 'BRB', 52),
(null, 'BY', 'Belarus', 'BLR', 112),
(null, 'BE', 'Belgium', 'BEL', 56),
(null, 'BZ', 'Belize', 'BLZ', 84),
(null, 'BJ', 'Benin', 'BEN', 204),
(null, 'BM', 'Bermuda', 'BMU', 60),
(null, 'BT', 'Bhutan', 'BTN', 64),
(null, 'BO', 'Bolivia', 'BOL', 68),
(null, 'BA', 'Bosnia and Herzegovina', 'BIH', 70),
(null, 'BW', 'Botswana', 'BWA', 72),
(null, 'BV', 'Bouvet Island', NULL, NULL),
(null, 'BR', 'Brazil', 'BRA', 76),
(null, 'IO', 'British Indian Ocean Territory', NULL, NULL),
(null, 'BN', 'Brunei Darussalam', 'BRN', 96),
(null, 'BG', 'Bulgaria', 'BGR', 100),
(null, 'BF', 'Burkina Faso', 'BFA', 854),
(null, 'BI', 'Burundi', 'BDI', 108),
(null, 'KH', 'Cambodia', 'KHM', 116),
(null, 'CM', 'Cameroon', 'CMR', 120),
(null, 'CA', 'Canada', 'CAN', 124),
(null, 'CV', 'Cape Verde', 'CPV', 132),
(null, 'KY', 'Cayman Islands', 'CYM', 136),
(null, 'CF', 'Central African Republic', 'CAF', 140),
(null, 'TD', 'Chad', 'TCD', 148),
(null, 'CL', 'Chile', 'CHL', 152),
(null, 'CN', 'China', 'CHN', 156),
(null, 'CX', 'Christmas Island', NULL, NULL),
(null, 'CC', 'Cocos (Keeling) Islands', NULL, NULL),
(null, 'CO', 'Colombia', 'COL', 170),
(null, 'KM', 'Comoros', 'COM', 174),
(null, 'CG', 'Congo', 'COG', 178),
(null, 'CD', 'Congo, the Democratic Republic of the', 'COD', 180),
(null, 'CK', 'Cook Islands', 'COK', 184),
(null, 'CR', 'Costa Rica', 'CRI', 188),
(null, 'CI', 'Cote D''Ivoire', 'CIV', 384),
(null, 'HR', 'Croatia', 'HRV', 191),
(null, 'CU', 'Cuba', 'CUB', 192),
(null, 'CY', 'Cyprus', 'CYP', 196),
(null, 'CZ', 'Czech Republic', 'CZE', 203),
(null, 'DK', 'Denmark', 'DNK', 208),
(null, 'DJ', 'Djibouti', 'DJI', 262),
(null, 'DM', 'Dominica', 'DMA', 212),
(null, 'DO', 'Dominican Republic', 'DOM', 214),
(null, 'EC', 'Ecuador', 'ECU', 218),
(null, 'EG', 'Egypt', 'EGY', 818),
(null, 'SV', 'El Salvador', 'SLV', 222),
(null, 'GQ', 'Equatorial Guinea', 'GNQ', 226),
(null, 'ER', 'Eritrea', 'ERI', 232),
(null, 'EE', 'Estonia', 'EST', 233),
(null, 'ET', 'Ethiopia', 'ETH', 231),
(null, 'FK', 'Falkland Islands (Malvinas)', 'FLK', 238),
(null, 'FO', 'Faroe Islands', 'FRO', 234),
(null, 'FJ', 'Fiji', 'FJI', 242),
(null, 'FI', 'Finland', 'FIN', 246),
(null, 'FR', 'France', 'FRA', 250),
(null, 'GF', 'French Guiana', 'GUF', 254),
(null, 'PF', 'French Polynesia', 'PYF', 258),
(null, 'TF', 'French Southern Territories', NULL, NULL),
(null, 'GA', 'Gabon', 'GAB', 266),
(null, 'GM', 'Gambia', 'GMB', 270),
(null, 'GE', 'Georgia', 'GEO', 268),
(null, 'DE', 'Germany', 'DEU', 276),
(null, 'GH', 'Ghana', 'GHA', 288),
(null, 'GI', 'Gibraltar', 'GIB', 292),
(null, 'GR', 'Greece', 'GRC', 300),
(null, 'GL', 'Greenland', 'GRL', 304),
(null, 'GD', 'Grenada', 'GRD', 308),
(null, 'GP', 'Guadeloupe', 'GLP', 312),
(null, 'GU', 'Guam', 'GUM', 316),
(null, 'GT', 'Guatemala', 'GTM', 320),
(null, 'GN', 'Guinea', 'GIN', 324),
(null, 'GW', 'Guinea-Bissau', 'GNB', 624),
(null, 'GY', 'Guyana', 'GUY', 328),
(null, 'HT', 'Haiti', 'HTI', 332),
(null, 'HM', 'Heard Island and Mcdonald Islands', NULL, NULL),
(null, 'VA', 'Holy See (Vatican City State)', 'VAT', 336),
(null, 'HN', 'Honduras', 'HND', 340),
(null, 'HK', 'Hong Kong', 'HKG', 344),
(null, 'HU', 'Hungary', 'HUN', 348),
(null, 'IS', 'Iceland', 'ISL', 352),
(null, 'IN', 'India', 'IND', 356),
(null, 'ID', 'Indonesia', 'IDN', 360),
(null, 'IR', 'Iran, Islamic Republic of', 'IRN', 364),
(null, 'IQ', 'Iraq', 'IRQ', 368),
(null, 'IE', 'Ireland', 'IRL', 372),
(null, 'IL', 'Israel', 'ISR', 376),
(null, 'IT', 'Italy', 'ITA', 380),
(null, 'JM', 'Jamaica', 'JAM', 388),
(null, 'JP', 'Japan', 'JPN', 392),
(null, 'JO', 'Jordan', 'JOR', 400),
(null, 'KZ', 'Kazakhstan', 'KAZ', 398),
(null, 'KE', 'Kenya', 'KEN', 404),
(null, 'KI', 'Kiribati', 'KIR', 296),
(null, 'KP', 'Korea, Democratic People''s Republic of', 'PRK', 408),
(null, 'KR', 'Korea, Republic of', 'KOR', 410),
(null, 'KW', 'Kuwait', 'KWT', 414),
(null, 'KG', 'Kyrgyzstan', 'KGZ', 417),
(null, 'LA', 'Lao People''s Democratic Republic', 'LAO', 418),
(null, 'LV', 'Latvia', 'LVA', 428),
(null, 'LB', 'Lebanon', 'LBN', 422),
(null, 'LS', 'Lesotho', 'LSO', 426),
(null, 'LR', 'Liberia', 'LBR', 430),
(null, 'LY', 'Libyan Arab Jamahiriya', 'LBY', 434),
(null, 'LI', 'Liechtenstein', 'LIE', 438),
(null, 'LT', 'Lithuania', 'LTU', 440),
(null, 'LU', 'Luxembourg', 'LUX', 442),
(null, 'MO', 'Macao', 'MAC', 446),
(null, 'MK', 'Macedonia, the Former Yugoslav Republic of', 'MKD', 807),
(null, 'MG', 'Madagascar', 'MDG', 450),
(null, 'MW', 'Malawi', 'MWI', 454),
(null, 'MY', 'Malaysia', 'MYS', 458),
(null, 'MV', 'Maldives', 'MDV', 462),
(null, 'ML', 'Mali', 'MLI', 466),
(null, 'MT', 'Malta', 'MLT', 470),
(null, 'MH', 'Marshall Islands', 'MHL', 584),
(null, 'MQ', 'Martinique', 'MTQ', 474),
(null, 'MR', 'Mauritania', 'MRT', 478),
(null, 'MU', 'Mauritius', 'MUS', 480),
(null, 'YT', 'Mayotte', NULL, NULL),
(null, 'MX', 'Mexico', 'MEX', 484),
(null, 'FM', 'Micronesia, Federated States of', 'FSM', 583),
(null, 'MD', 'Moldova, Republic of', 'MDA', 498),
(null, 'MC', 'Monaco', 'MCO', 492),
(null, 'MN', 'Mongolia', 'MNG', 496),
(null, 'MS', 'Montserrat', 'MSR', 500),
(null, 'MA', 'Morocco', 'MAR', 504),
(null, 'MZ', 'Mozambique', 'MOZ', 508),
(null, 'MM', 'Myanmar', 'MMR', 104),
(null, 'NA', 'Namibia', 'NAM', 516),
(null, 'NR', 'Nauru', 'NRU', 520),
(null, 'NP', 'Nepal', 'NPL', 524),
(null, 'NL', 'Netherlands', 'NLD', 528),
(null, 'AN', 'Netherlands Antilles', 'ANT', 530),
(null, 'NC', 'New Caledonia', 'NCL', 540),
(null, 'NZ', 'New Zealand', 'NZL', 554),
(null, 'NI', 'Nicaragua', 'NIC', 558),
(null, 'NE', 'Niger', 'NER', 562),
(null, 'NG', 'Nigeria', 'NGA', 566),
(null, 'NU', 'Niue', 'NIU', 570),
(null, 'NF', 'Norfolk Island', 'NFK', 574),
(null, 'MP', 'Northern Mariana Islands', 'MNP', 580),
(null, 'NO', 'Norway', 'NOR', 578),
(null, 'OM', 'Oman', 'OMN', 512),
(null, 'PK', 'Pakistan', 'PAK', 586),
(null, 'PW', 'Palau', 'PLW', 585),
(null, 'PS', 'Palestinian Territory, Occupied', NULL, NULL),
(null, 'PA', 'Panama', 'PAN', 591),
(null, 'PG', 'Papua New Guinea', 'PNG', 598),
(null, 'PY', 'Paraguay', 'PRY', 600),
(null, 'PE', 'Peru', 'PER', 604),
(null, 'PH', 'Philippines', 'PHL', 608),
(null, 'PN', 'Pitcairn', 'PCN', 612),
(null, 'PL', 'Poland', 'POL', 616),
(null, 'PT', 'Portugal', 'PRT', 620),
(null, 'PR', 'Puerto Rico', 'PRI', 630),
(null, 'QA', 'Qatar', 'QAT', 634),
(null, 'RE', 'Reunion', 'REU', 638),
(null, 'RO', 'Romania', 'ROM', 642),
(null, 'RU', 'Russian Federation', 'RUS', 643),
(null, 'RW', 'Rwanda', 'RWA', 646),
(null, 'SH', 'Saint Helena', 'SHN', 654),
(null, 'KN', 'Saint Kitts and Nevis', 'KNA', 659),
(null, 'LC', 'Saint Lucia', 'LCA', 662),
(null, 'PM', 'Saint Pierre and Miquelon', 'SPM', 666),
(null, 'VC', 'Saint Vincent and the Grenadines', 'VCT', 670),
(null, 'WS', 'Samoa', 'WSM', 882),
(null, 'SM', 'San Marino', 'SMR', 674),
(null, 'ST', 'Sao Tome and Principe', 'STP', 678),
(null, 'SA', 'Saudi Arabia', 'SAU', 682),
(null, 'SN', 'Senegal', 'SEN', 686),
(null, 'CS', 'Serbia and Montenegro', NULL, NULL),
(null, 'SC', 'Seychelles', 'SYC', 690),
(null, 'SL', 'Sierra Leone', 'SLE', 694),
(null, 'SG', 'Singapore', 'SGP', 702),
(null, 'SK', 'Slovakia', 'SVK', 703),
(null, 'SI', 'Slovenia', 'SVN', 705),
(null, 'SB', 'Solomon Islands', 'SLB', 90),
(null, 'SO', 'Somalia', 'SOM', 706),
(null, 'ZA', 'South Africa', 'ZAF', 710),
(null, 'GS', 'South Georgia and the South Sandwich Islands', NULL, NULL),
(null, 'ES', 'Spain', 'ESP', 724),
(null, 'LK', 'Sri Lanka', 'LKA', 144),
(null, 'SD', 'Sudan', 'SDN', 736),
(null, 'SR', 'Suriname', 'SUR', 740),
(null, 'SJ', 'Svalbard and Jan Mayen', 'SJM', 744),
(null, 'SZ', 'Swaziland', 'SWZ', 748),
(null, 'SE', 'Sweden', 'SWE', 752),
(null, 'CH', 'Switzerland', 'CHE', 756),
(null, 'SY', 'Syrian Arab Republic', 'SYR', 760),
(null, 'TW', 'Taiwan, Province of China', 'TWN', 158),
(null, 'TJ', 'Tajikistan', 'TJK', 762),
(null, 'TZ', 'Tanzania, United Republic of', 'TZA', 834),
(null, 'TH', 'Thailand', 'THA', 764),
(null, 'TL', 'Timor-Leste', NULL, NULL),
(null, 'TG', 'Togo', 'TGO', 768),
(null, 'TK', 'Tokelau', 'TKL', 772),
(null, 'TO', 'Tonga', 'TON', 776),
(null, 'TT', 'Trinidad and Tobago', 'TTO', 780),
(null, 'TN', 'Tunisia', 'TUN', 788),
(null, 'TR', 'Turkey', 'TUR', 792),
(null, 'TM', 'Turkmenistan', 'TKM', 795),
(null, 'TC', 'Turks and Caicos Islands', 'TCA', 796),
(null, 'TV', 'Tuvalu', 'TUV', 798),
(null, 'UG', 'Uganda', 'UGA', 800),
(null, 'UA', 'Ukraine', 'UKR', 804),
(null, 'AE', 'United Arab Emirates', 'ARE', 784),
(null, 'GB', 'United Kingdom', 'GBR', 826);

-- NEXT_QUERY --

INSERT INTO `countries` (`countryId`, `iso`, `printable_name`, `iso3`, `numcode`, `default_pos`) VALUES
(null, 'US', 'United States', 'USA', 840, 1);

-- NEXT_QUERY --

INSERT INTO `countries` (`countryId`, `iso`, `printable_name`, `iso3`, `numcode`) VALUES
(null, 'UM', 'United States Minor Outlying Islands', NULL, NULL),
(null, 'UY', 'Uruguay', 'URY', 858),
(null, 'UZ', 'Uzbekistan', 'UZB', 860),
(null, 'VU', 'Vanuatu', 'VUT', 548),
(null, 'VE', 'Venezuela', 'VEN', 862),
(null, 'VN', 'Viet Nam', 'VNM', 704),
(null, 'VG', 'Virgin Islands, British', 'VGB', 92),
(null, 'VI', 'Virgin Islands, U.s.', 'VIR', 850),
(null, 'WF', 'Wallis and Futuna', 'WLF', 876),
(null, 'EH', 'Western Sahara', 'ESH', 732),
(null, 'YE', 'Yemen', 'YEM', 887),
(null, 'ZM', 'Zambia', 'ZMB', 894),
(null, 'ZW', 'Zimbabwe', 'ZWE', 716);

-- NEXT_QUERY --

INSERT INTO `emailtemplate` (`id`, `name`, `subject`, `content`) VALUES
(null, 'acceptauction_notpay', 'Claim Your Won Auction Item!', 'Claim Your Won Auction Item!, this is the details of the auction'),
(null, 'acceptauction_pay', 'Claim Your Won Auction Item!', 'Claim Your Won Auction Item! 茂录艗 this is the details'),
(null, 'denyauction', 'Congratulations You Won an Auction', 'Congratulations You Won an Auction, you deny the auction'),
(null, 'registration', 'Welcome to our auction', 'Welcome to our auction, this is your details'),
(null, 'affiliate', 'Have you heard of this?', 'Have you heard of this?&nbsp; This is the details'),
(null, 'wonauction', 'Congratulations You Won!', '<table align="center" border="0" cellpadding="3" cellspacing="0" class="style13" width="100%"><tbody><tr style="font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;"><td>Dear [[firstname]],</td></tr><tr><td height="10">&nbsp;</td></tr><tr style="font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;"><td>Congratulations! You have won the following item through [[SITE_NM]].</td></tr><tr><td height="10">&nbsp;</td></tr><tr style="font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;"><td>AuctionID: [[auctionid_plain]],</td></tr><tr style="font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;"><td>Auction Item Name: [[name]]</td></tr><tr style="font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;"><td>Winning Price: [[currency]][[winprice]],</td></tr><tr style="font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;"><td>Date You Won The Item: [[won_date]],</td></tr><tr><td height="10">&nbsp;</td></tr><tr style="font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;"><td>To Accept or Deny this auction win please click here:<a href="[[SITE_URL]]wonauctions.php?vcode=[[verifycode]]&winid=[[auctioned]]">[[SITE_URL]]wonauctions.php?vcode=[[verifycode]]&winid=[[auctionid]])</a></td></tr></tbody></table>'),
(null, 'feedback', 'Question about', 'Feedback'),
(null, 'forgetpassword', 'Your Information', 'Your Password Information'),
(null, 'newsletter', 'Thanks for subscribing to our newsletter', 'Thanks for subscribing to our newsletter, '),
(null, 'inviter', 'test', 'testtest');

-- NEXT_QUERY --

INSERT INTO `navigation` (`id`, `menu_name`, `link`, `link_text`, `enabled`, `created_by`, `sort`) VALUES
(null, 'design_menu', '<a>', 'Edit Styles', 1, 'PAS', NULL),
(null, 'design_menu', '<a class="prevented" href="#">', 'Edit Content', 1, 'PAS', NULL),
(null, 'top_menu', '<a href="[[SITE_URL]]index.php">', '[[HOME]]', 1, 'PAS', NULL),
(null, 'design_menu', '<a  class="prevented">', 'Replace Values', 1, 'PAS', NULL),
(null, 'design_menu', '<a  onclick="javascript: ajax_PAS(''backendadmin/sitesetting.php?ajax=true'', ''get=sliderform'', ''get'',''css-editor'');" class="prevented">', 'Site Settings', 1, 'PAS', NULL),
(null, 'design_menu', '<a  onclick="javascript: ajax_PAS(''backendadmin/configuration.php?ajax=true'', ''get=sliderform'', ''get'',''css-editor'');" class="prevented">', 'Configuration', 1, 'PAS', NULL),
(null, 'top_menu', '<a href="[[SITE_URL]]myaccount.php">', '[[MY_BIDS]]', 1, 'PAS', NULL),
(null, 'top_menu', '<a href="[[SITE_URL]]registration.php">', '[[REGISTER]]', 1, 'PAS', NULL),
(null, 'top_menu', '<a href="[[SITE_URL]]buybids.php">', '[[BUY_BIDS]]', 1, 'PAS', NULL),
(null, 'top_menu', '<a href="redemption.php">', '[[REDEMPTION]]', 1, 'PAS', NULL),
(null, 'top_menu', '<a href="[[SITE_URL]]community.php">', '[[COMMUNITY]]', 1, 'PAS', NULL),
(null, 'top_menu', '<a href="[[SITE_URL]]/forums.php">', '[[FORUMS]]', 1, 'PAS', NULL),
(null, 'top_menu', '<a href="[[SITE_URL]]/help.php">', '[[HELP]]', 1, 'PAS', NULL),
(null, 'footer_menu', '<a href="[[SITE_URL]]/aboutus.php">', '[[ABOUT_US]]', 1, 'PAS', NULL),
(null, 'footer_menu', '<a href="[[SITE_URL]]/terms.php">', '[[TERMS_CONDITIONS]]', 1, NULL, NULL),
(null, 'footer_menu', '<a href="[[SITE_URL]]/contact.php">', '[[CONTACT_US]]', 1, 'PAS', NULL),
(null, 'footer_menu', '<a href="[[SITE_URL]]/privacy.php">', '[[PRIVACY]]', 1, 'PAS', NULL),
(null, 'footer_menu', '<a href="[[SITE_URL]]/help.php">', '[[HELP]]', 1, 'PAS', NULL),
(null, 'footer_menu', '<a href="[[SITE_URL]]/jobs.php">', '[[JOBS]]', 1, 'PAS', NULL),
(null, 'user_menu1', '<a href="[[SITE_URL]]myauctions.php">', '[[MY_AUCTIONS]]', 1, 'PAS', NULL),
(null, 'user_menu1', '<a href="[[SITE_URL]]myaccount.php">', '[[MY_ACCOUNT]]', 1, 'PAS', NULL),
(null, 'user_menu1', '<a href="[[SITE_URL]]myautobidder.php">', '[[MY_AUTOBIDDER]]', 1, 'PAS', NULL),
(null, 'top_menu', '<a href="help.php">', 'help', 0, 'PAS', NULL),
(null, 'new', '<a href="about.php">', '[[ABOUT_US]]', 1, 'PAS', NULL),
(null, 'design_menu', '<a class="prevented" onclick="javascript: ajax_PAS(''include/addons/design_suite/DESIGN/logo.php?type=logo'', ''get=sliderform'', ''get'',''css-editor'');">', 'Change Logo', 1, 'PAS', NULL),
(null, 'user_menu1', '<a href="[[SITE_URL]]watchauctions.php">', '[[WATCHED_AUCTIONS]]', 1, 'PAS', NULL),
(null, 'user_menu1', '<a href="[[SITE_URL]]wonauctions.php">', '[[WON_AUCTIONS]]', 1, 'PAS', NULL),
(null, 'user_menu1', '<a href="[[SITE_URL]]mybuynow.php?status=1">', '[[MY_BUY_NOW_LIST]]', 1, 'PAS', NULL),
(null, 'user_menu1', '<a href="[[SITE_URL]]mybuynow.php?status=2">', '[[MY_BUY_NOW_HISTORY]]', 1, 'PAS', NULL),
(null, 'user_menu2', '<a href="[[SITE_URL]]buybids.php">', '[[BUY_BIDS]]', 1, 'PAS', NULL),
(null, 'user_menu2', '<a href="[[SITE_URL]]bidhistory.php">', '[[BID_ACCOUNT]]', 1, 'PAS', NULL),
(null, 'user_menu2', '<a href="[[SITE_URL]]vouchers.php">', '[[VOUCHERS]]', 1, 'PAS', NULL),
(null, 'user_menu2', '<a href="[[SITE_URL]]redemption.php">', '[[REDEMPTION]]', 1, 'PAS', NULL),
(null, 'user_menu2', '<a href="[[SITE_URL]]affiliate.php">', '[[REFERRAL]]', 1, 'PAS', NULL),
(null, 'user_menu3', '<a href="[[SITE_URL]]mydetails.php">', '[[MY_DETAILS]]', 1, 'PAS', NULL),
(null, 'user_menu3', '<a href="[[SITE_URL]]myavatar.php">', '[[MY_AVATAR]]', 1, 'PAS', NULL),
(null, 'user_menu3', '<a href="[[SITE_URL]]editpassword.php">', '[[CHANGE_PASSWORD]]', 1, 'PAS', NULL),
(null, 'user_menu3', '<a href="[[SITE_URL]]unsubscribeuser.php">', '[[CLOSE_ACCOUNT]]', 1, 'PAS', NULL),
(null, 'user_menu3', '<a href="[[SITE_URL]]newsletter.php">', '[[NEWSLETTER]]', 1, 'PAS', NULL),
(null, 'user_menu4', '<a href="[[SITE_URL]]mycoupon.php">', '[[MY_COUPON]]', 1, 'PAS', NULL),
(null, 'user_menu4', '<a href="[[SITE_URL]]couponhistory.php">', '[[COUPON_HISTORY]]', 1, 'PAS', NULL),
(null, 'design_menu', '<a href="javascript:;" onclick="media_gallery();">', 'Media Gallery', 1, 'PAS', 0);

-- NEXT_QUERY --

INSERT INTO `nav_conditionals` (`id`, `menu_name`, `link_name`, `conditional_type`, `conditional_operator`, `conditional_val`, `affected_table`, `table_id`) VALUES
(null, 'top_menu', '[[LOGIN]]', '_SESSION[\'userid\']', 'empty', '0', 'navigation', 19),
(null, 'top_menu', '[[REGISTER]]', '_SESSION[\'userid\']', '<', '1', 'navigation', 11),
(null, 'top_menu', '[[MY_BIDS]]', '_SESSION[\'username\']', '!empty', '1367179951', 'navigation', 14),
(null, 'top_menu', '[[BUY_BIDS]]', '_SESSION[\'userid\']', '!empty', '1', 'navigation', 13),
(null, 'top_menu', '[[LOGIN]]', 'GLOBALS[\'template\']', '!=', 'wavee', 'navigation', 19);

-- NEXT_QUERY --

INSERT INTO `page_areas` (`id`, `name`, `description`, `menu`, `menu_index`, `invisible`, `page`, `is_page`, `created_by`) VALUES
(null, 'Edit Left Column', 'admin', 'design_menu', 3, 1, NULL, NULL, 'PAS'),
(null, 'Edit Right Column', 'admin', 'design_menu', 3, 1, NULL, NULL, 'PAS'),
(null, 'Edit Page Header', 'Work on an area of the page', 'design_menu', 3, 1, NULL, NULL, 'PAS'),
(null, 'Replace Values', 'Quickly Replace Colors, Images, Gradients or Text', 'design_menu', 6, 1, NULL, NULL, 'PAS'),
(null, 'lastwinner', '', 'column-right', 1, 1, 'index.php', NULL, 'PAS'),
(null, 'Edit Body Area', 'admin', 'design_menu', 3, 1, NULL, NULL, 'PAS'),
(null, 'Edit Footer', 'admin', 'design_menu', 3, 1, NULL, NULL, 'PAS'),
(null, 'rightsocial', '', 'column-right', 4, 1, 'index.php', NULL, 'PAS'),
(null, 'rightnews', '', 'column-right', 5, 1, 'index.php', NULL, 'PAS'),
(null, 'bidpackage', '', 'column-right', 3, 1, 'index.php', NULL, 'PAS'),
(null, 'testimonials', '', 'column-right', 2, 1, 'index.php', NULL, 'PAS'),
(null, 'advertisebannerwide', '', 'column-right', 7, 1, 'index.php', NULL, 'PAS'),
(null, 'advertisebannernarrow', '', 'column-right', 6, 1, 'index.php', NULL, 'PAS'),
(null, 'advertisebannerwide', '', 'column-left', 2, 1, 'myaccount.php', NULL, 'PAS'),
(null, 'advertisebannernarrow', '', 'column-left', 3, 1, 'myaccount.php', NULL, 'PAS'),
(null, 'advertising', '', 'column-left', 4, 1, 'myaccount.php', NULL, 'PAS'),
(null, 'rightsocial', '', 'column-left', 6, 1, 'myaccount.php', NULL, 'PAS'),
(null, 'rightnews', '', 'column-left', 5, 1, 'myaccount.php', NULL, 'PAS'),
(null, 'user_menu', '', 'column-left', 0, 1, 'myaccount.php', NULL, 'PAS'),
(null, 'testimonials', '', 'column-left', 7, 1, 'myaccount.php', NULL, 'PAS'),
(null, 'bidpackage', '', 'column-left', 8, 1, 'myaccount.php', NULL, 'PAS'),
(null, 'lastwinner', '', 'column-left', 9, 1, 'myaccount.php', NULL, 'PAS'),
(null, 'advertisebannerwide', '', 'column-left', 1, 1, 'myauctions.php', NULL, 'PAS'),
(null, 'advertisebannernarrow', '', 'column-left', 3, 1, 'myauctions.php', NULL, 'PAS'),
(null, 'advertising', '', 'column-left', 4, 1, 'myauctions.php', NULL, 'PAS'),
(null, 'rightsocial', '', 'column-left', 5, 1, 'myauctions.php', NULL, 'PAS'),
(null, 'rightnews', '', 'column-left', 6, 1, 'myauctions.php', NULL, 'PAS'),
(null, 'user_menu', '', 'column-left', 0, 1, 'myauctions.php', NULL, 'PAS'),
(null, 'testimonials', '', 'column-left', 7, 1, 'myauctions.php', NULL, 'PAS'),
(null, 'bidpackage', '', 'column-left', 8, 1, 'myauctions.php', NULL, 'PAS'),
(null, 'lastwinner', '', 'column-left', 9, 1, 'myauctions.php', NULL, 'PAS'),
(null, 'advertisebannerwide', '', 'column-left', 2, 1, 'myavatar.php', NULL, 'PAS'),
(null, 'advertisebannernarrow', '', 'column-left', 5, 1, 'myavatar.php', NULL, 'PAS'),
(null, 'advertising', '', 'column-left', 3, 1, 'myavatar.php', NULL, 'PAS'),
(null, 'rightsocial', '', 'column-left', 4, 1, 'myavatar.php', NULL, 'PAS'),
(null, 'rightnews', '', 'column-left', 6, 1, 'myavatar.php', NULL, 'PAS'),
(null, 'user_menu', '', 'column-left', 0, 1, 'myavatar.php', NULL, 'PAS'),
(null, 'testimonials', '', 'column-left', 7, 1, 'myavatar.php', NULL, 'PAS'),
(null, 'bidpackage', '', 'column-left', 8, 1, 'myavatar.php', NULL, 'PAS'),
(null, 'lastwinner', '', 'column-left', 9, 1, 'myavatar.php', NULL, 'PAS'),
(null, 'advertisebannerwide', '', 'column-left', 4, 1, 'myautobidder.php', NULL, 'PAS'),
(null, 'advertisebannernarrow', '', 'column-left', 1, 1, 'myautobidder.php', NULL, 'PAS'),
(null, 'advertising', '', 'column-left', 2, 1, 'myautobidder.php', NULL, 'PAS'),
(null, 'rightsocial', '', 'column-left', 5, 1, 'myautobidder.php', NULL, 'PAS'),
(null, 'rightnews', '', 'column-left', 10, 1, 'myautobidder.php', NULL, 'PAS'),
(null, 'user_menu', '', 'column-left', 0, 1, 'myautobidder.php', NULL, 'PAS'),
(null, 'testimonials', '', 'column-left', 6, 1, 'myautobidder.php', NULL, 'PAS'),
(null, 'bidpackage', '', 'column-left', 7, 1, 'myautobidder.php', NULL, 'PAS'),
(null, 'lastwinner', '', 'column-left', 9, 1, 'myautobidder.php', NULL, 'PAS'),
(null, 'advertisebannerwide', '', 'column-left', 4, 1, 'mybidbutler.php', NULL, 'PAS'),
(null, 'advertisebannernarrow', '', 'column-left', 2, 1, 'mybidbutler.php', NULL, 'PAS'),
(null, 'advertising', '', 'column-left', 3, 1, 'mybidbutler.php', NULL, 'PAS'),
(null, 'rightsocial', '', 'column-left', 5, 1, 'mybidbutler.php', NULL, 'PAS'),
(null, 'rightnews', '', 'column-left', 6, 1, 'mybidbutler.php', NULL, 'PAS'),
(null, 'user_menu', '', 'column-left', 0, 1, 'mybidbutler.php', NULL, 'PAS'),
(null, 'testimonials', '', 'column-left', 7, 1, 'mybidbutler.php', NULL, 'PAS'),
(null, 'bidpackage', '', 'column-left', 8, 1, 'mybidbutler.php', NULL, 'PAS'),
(null, 'lastwinner', '', 'column-left', 9, 1, 'mybidbutler.php', NULL, 'PAS'),
(null, 'advertisebannerwide', '', 'column-left', 1, 6, 'mybuynow.php', NULL, 'PAS'),
(null, 'advertisebannernarrow', '', 'column-left', 1, 7, 'mybuynow.php', NULL, 'PAS'),
(null, 'advertising', '', 'column-left', 1, 8, 'mybuynow.php', NULL, 'PAS'),
(null, 'rightsocial', '', 'column-left', 1, 3, 'mybuynow.php', NULL, 'PAS'),
(null, 'rightnews', '', 'column-left', 1, 4, 'mybuynow.php', NULL, 'PAS'),
(null, 'user_menu', '', 'column-left', 0, 2, 'mybuynow.php', NULL, 'PAS'),
(null, 'testimonials', '', 'column-left', 1, 9, 'mybuynow.php', NULL, 'PAS'),
(null, 'bidpackage', '', 'column-left', 1, 5, 'mybuynow.php', NULL, 'PAS'),
(null, 'lastwinner', '', 'column-left', 1, 1, 'mybuynow.php', NULL, 'PAS'),
(null, 'advertisebannerwide', '', 'column-left', 1, 6, 'mycoupon.php', NULL, 'PAS'),
(null, 'advertisebannernarrow', '', 'column-left', 1, 7, 'mycoupon.php', NULL, 'PAS'),
(null, 'advertising', '', 'column-left', 1, 6, 'mycoupon.php', NULL, 'PAS'),
(null, 'rightsocial', '', 'column-left', 1, 3, 'mycoupon.php', NULL, 'PAS'),
(null, 'rightnews', '', 'column-left', 1, 4, 'mycoupon.php', NULL, 'PAS'),
(null, 'user_menu', '', 'column-left', 0, 2, 'mycoupon.php', NULL, 'PAS'),
(null, 'testimonials', '', 'column-left', 1, 9, 'mycoupon.php', NULL, 'PAS'),
(null, 'bidpackage', '', 'column-left', 1, 5, 'mycoupon.php', NULL, 'PAS'),
(null, 'lastwinner', '', 'column-left', 1, 1, 'mycoupon.php', NULL, 'PAS'),
(null, 'advertisebannerwide', '', 'column-left', 1, 6, 'mydetails.php', NULL, 'PAS'),
(null, 'advertisebannernarrow', '', 'column-left', 1, 7, 'mydetails.php', NULL, 'PAS'),
(null, 'advertising', '', 'column-left', 1, 6, 'mydetails.php', NULL, 'PAS'),
(null, 'rightsocial', '', 'column-left', 1, 3, 'mydetails.php', NULL, 'PAS'),
(null, 'rightnews', '', 'column-left', 1, 4, 'mydetails.php', NULL, 'PAS'),
(null, 'user_menu', '', 'column-left', 0, 2, 'mydetails.php', NULL, 'PAS'),
(null, 'testimonials', '', 'column-left', 1, 9, 'mydetails.php', NULL, 'PAS'),
(null, 'bidpackage', '', 'column-left', 1, 5, 'mydetails.php', NULL, 'PAS'),
(null, 'lastwinner', '', 'column-left', 1, 1, 'mydetails.php', NULL, 'PAS'),
(null, 'advertisebannerwide', '', 'column-left', 1, 6, 'myredemption.php', NULL, 'PAS'),
(null, 'advertisebannernarrow', '', 'column-left', 1, 7, 'myredemption.php', NULL, 'PAS'),
(null, 'advertising', '', 'column-left', 1, 6, 'myredemption.php', NULL, 'PAS'),
(null, 'rightsocial', '', 'column-left', 1, 3, 'myredemption.php', NULL, 'PAS'),
(null, 'rightnews', '', 'column-left', 1, 4, 'myredemption.php', NULL, 'PAS'),
(null, 'user_menu', '', 'column-left', 0, 2, 'myredemption.php', NULL, 'PAS'),
(null, 'testimonials', '', 'column-left', 1, 9, 'myredemption.php', NULL, 'PAS'),
(null, 'bidpackage', '', 'column-left', 1, 5, 'myredemption.php', NULL, 'PAS'),
(null, 'lastwinner', '', 'column-left', 1, 1, 'myredemption.php', NULL, 'PAS'),
(null, 'advertisebannerwide', '', 'column-left', 1, 6, 'news.php', NULL, 'PAS'),
(null, 'advertisebannernarrow', '', 'column-left', 1, 7, 'news.php', NULL, 'PAS'),
(null, 'advertising', '', 'column-left', 1, 6, 'news.php', NULL, 'PAS'),
(null, 'rightsocial', '', 'column-left', 1, 3, 'news.php', NULL, 'PAS'),
(null, 'rightnews', '', 'column-left', 1, 4, 'news.php', NULL, 'PAS'),
(null, 'user_menu', '', 'column-left', 0, 2, 'news.php', NULL, 'PAS'),
(null, 'testimonials', '', 'column-left', 1, 9, 'news.php', NULL, 'PAS'),
(null, 'bidpackage', '', 'column-left', 1, 5, 'news.php', NULL, 'PAS'),
(null, 'lastwinner', '', 'column-left', 1, 1, 'news.php', NULL, 'PAS'),
(null, 'advertisebannerwide', '', 'column-left', 1, 6, 'newsletter.php', NULL, 'PAS'),
(null, 'advertisebannernarrow', '', 'column-left', 1, 7, 'newsletter.php', NULL, 'PAS'),
(null, 'advertising', '', 'column-left', 1, 6, 'newsletter.php', NULL, 'PAS'),
(null, 'rightsocial', '', 'column-left', 1, 3, 'newsletter.php', NULL, 'PAS'),
(null, 'rightnews', '', 'column-left', 1, 4, 'newsletter.php', NULL, 'PAS'),
(null, 'user_menu', '', 'column-left', 0, 2, 'newsletter.php', NULL, 'PAS'),
(null, 'testimonials', '', 'column-left', 1, 9, 'newsletter.php', NULL, 'PAS'),
(null, 'bidpackage', '', 'column-left', 1, 5, 'newsletter.php', NULL, 'PAS'),
(null, 'lastwinner', '', 'column-left', 1, 1, 'newsletter.php', NULL, 'PAS'),
(null, 'advertisebannerwide', '', 'column-left', 2, 6, 'redemption.php', NULL, 'PAS'),
(null, 'advertisebannernarrow', '', 'column-left', 3, 7, 'redemption.php', NULL, 'PAS'),
(null, 'advertising', '', 'column-left', 4, 6, 'redemption.php', NULL, 'PAS'),
(null, 'rightsocial', '', 'column-left', 5, 3, 'redemption.php', NULL, 'PAS'),
(null, 'rightnews', '', 'column-left', 6, 4, 'redemption.php', NULL, 'PAS'),
(null, 'user_menu', '', 'column-left', 0, 2, 'redemption.php', NULL, 'PAS'),
(null, 'testimonials', '', 'column-left', 7, 9, 'redemption.php', NULL, 'PAS'),
(null, 'bidpackage', '', 'column-left', 8, 5, 'redemption.php', NULL, 'PAS'),
(null, 'lastwinner', '', 'column-left', 9, 1, 'redemption.php', NULL, 'PAS'),
(null, 'advertisebannerwide', '', 'column-left', 1, 6, 'redemptiondetail.php', NULL, 'PAS'),
(null, 'advertisebannernarrow', '', 'column-left', 1, 7, 'redemptiondetail.php', NULL, 'PAS'),
(null, 'advertising', '', 'column-left', 1, 6, 'redemptiondetail.php', NULL, 'PAS'),
(null, 'rightsocial', '', 'column-left', 1, 3, 'redemptiondetail.php', NULL, 'PAS'),
(null, 'rightnews', '', 'column-left', 1, 4, 'redemptiondetail.php', NULL, 'PAS'),
(null, 'user_menu', '', 'column-left', 0, 2, 'redemptiondetail.php', NULL, 'PAS'),
(null, 'testimonials', '', 'column-left', 1, 9, 'redemptiondetail.php', NULL, 'PAS'),
(null, 'bidpackage', '', 'column-left', 1, 5, 'redemptiondetail.php', NULL, 'PAS'),
(null, 'lastwinner', '', 'column-left', 1, 1, 'redemptiondetail.php', NULL, 'PAS'),
(null, 'advertisebannerwide', '', 'column-left', 1, 6, 'redemptiondetail.php', NULL, 'PAS'),
(null, 'advertisebannernarrow', '', 'column-left', 1, 7, 'redemptiondetail.php', NULL, 'PAS'),
(null, 'advertising', '', 'column-left', 1, 6, 'registration.php', NULL, 'PAS'),
(null, 'rightsocial', '', 'column-left', 1, 3, 'registration.php', NULL, 'PAS'),
(null, 'rightnews', '', 'column-left', 1, 4, 'registration.php', NULL, 'PAS'),
(null, 'testimonials', '', 'column-left', 1, 9, 'registration.php', NULL, 'PAS'),
(null, 'bidpackage', '', 'column-left', 1, 5, 'registration.php', NULL, 'PAS'),
(null, 'lastwinner', '', 'column-left', 1, 1, 'registration.php', NULL, 'PAS'),
(null, 'advertisebannerwide', '', 'column-left', 1, 6, 'redemptiondetail.php', NULL, 'PAS'),
(null, 'advertisebannernarrow', '', 'column-left', 1, 7, 'redemptiondetail.php', NULL, 'PAS'),
(null, 'advertising', '', 'column-left', 2, 6, 'allauctions.php', NULL, 'PAS'),
(null, 'rightsocial', '', 'column-left', 1, 3, 'allauctions.php', NULL, 'PAS'),
(null, 'rightnews', '', 'column-left', 3, 4, 'allauctions.php', NULL, 'PAS'),
(null, 'testimonials', '', 'column-left', 4, 9, 'allauctions.php', NULL, 'PAS'),
(null, 'bidpackage', '', 'column-left', 5, 5, 'allauctions.php', NULL, 'PAS'),
(null, 'lastwinner', '', 'column-left', 6, 1, 'allauctions.php', NULL, 'PAS'),
(null, 'advertisebannerwide', '', 'column-left', 1, 6, 'allnews.php', NULL, 'PAS'),
(null, 'advertisebannernarrow', '', 'column-left', 1, 7, 'allnews.php', NULL, 'PAS'),
(null, 'advertising', '', 'column-left', 1, 6, 'allnews.php', NULL, 'PAS'),
(null, 'rightsocial', '', 'column-left', 1, 3, 'allnews.php', NULL, 'PAS'),
(null, 'rightnews', '', 'column-left', 1, 4, 'allnews.php', NULL, 'PAS'),
(null, 'testimonials', '', 'column-left', 1, 9, 'allnews.php', NULL, 'PAS'),
(null, 'bidpackage', '', 'column-left', 1, 5, 'allnews.php', NULL, 'PAS'),
(null, 'lastwinner', '', 'column-left', 1, 1, 'allnews.php', NULL, 'PAS'),
(null, 'user_menu', '', 'column-left', 0, 2, 'allnews.php', NULL, 'PAS'),
(null, 'advertisebannerwide', '', 'column-left', 13, 6, 'bidhistory.php', NULL, 'PAS'),
(null, 'advertisebannernarrow', '', 'column-left', 14, 7, 'bidhistory.php', NULL, 'PAS'),
(null, 'advertising', '', 'column-left', 15, 6, 'bidhistory.php', NULL, 'PAS'),
(null, 'rightsocial', '', 'column-left', 16, 3, 'bidhistory.php', NULL, 'PAS'),
(null, 'rightnews', '', 'column-left', 17, 4, 'bidhistory.php', NULL, 'PAS'),
(null, 'testimonials', '', 'column-left', 18, 9, 'bidhistory.php', NULL, 'PAS'),
(null, 'bidpackage', '', 'column-left', 19, 5, 'bidhistory.php', NULL, 'PAS'),
(null, 'lastwinner', '', 'column-left', 20, 1, 'bidhistory.php', NULL, 'PAS'),
(null, 'user_menu', '', 'column-left', 0, 2, 'bidhistory.php', NULL, 'PAS'),
(null, 'advertisebannerwide', '', 'column-left', 2, 6, 'watchauctions.php', NULL, 'PAS'),
(null, 'advertisebannernarrow', '', 'column-left', 3, 7, 'watchauctions.php', NULL, 'PAS'),
(null, 'advertising', '', 'column-left', 4, 6, 'watchauctions.php', NULL, 'PAS'),
(null, 'rightsocial', '', 'column-left', 5, 3, 'watchauctions.php', NULL, 'PAS'),
(null, 'rightnews', '', 'column-left', 6, 4, 'watchauctions.php', NULL, 'PAS'),
(null, 'testimonials', '', 'column-left', 7, 9, 'watchauctions.php', NULL, 'PAS'),
(null, 'bidpackage', '', 'column-left', 8, 5, 'watchauctions.php', NULL, 'PAS'),
(null, 'lastwinner', '', 'column-left', 9, 1, 'watchauctions.php', NULL, 'PAS'),
(null, 'user_menu', '', 'column-left', 0, 2, 'watchauctions.php', NULL, 'PAS'),
(null, 'advertisebannerwide', '', 'column-left', 1, 6, 'wonauctions.php', NULL, 'PAS'),
(null, 'advertisebannernarrow', '', 'column-left', 1, 7, 'wonauctions.php', NULL, 'PAS'),
(null, 'advertising', '', 'column-left', 1, 6, 'wonauctions.php', NULL, 'PAS'),
(null, 'rightsocial', '', 'column-left', 1, 3, 'wonauctions.php', NULL, 'PAS'),
(null, 'rightnews', '', 'column-left', 1, 4, 'wonauctions.php', NULL, 'PAS'),
(null, 'testimonials', '', 'column-left', 1, 9, 'wonauctions.php', NULL, 'PAS'),
(null, 'bidpackage', '', 'column-left', 1, 5, 'wonauctions.php', NULL, 'PAS'),
(null, 'lastwinner', '', 'column-left', 1, 1, 'wonauctions.php', NULL, 'PAS'),
(null, 'user_menu', '', 'column-left', 0, 2, 'wonauctions.php', NULL, 'PAS'),
(null, 'advertisebannerwide', '', 'column-left', 1, 6, 'wonauctionaccept.php', NULL, 'PAS'),
(null, 'advertisebannernarrow', '', 'column-left', 1, 7, 'wonauctionaccept.php', NULL, 'PAS'),
(null, 'advertising', '', 'column-left', 1, 6, 'wonauctionaccept.php', NULL, 'PAS'),
(null, 'rightsocial', '', 'column-left', 1, 3, 'wonauctionaccept.php', NULL, 'PAS'),
(null, 'rightnews', '', 'column-left', 1, 4, 'wonauctionaccept.php', NULL, 'PAS'),
(null, 'testimonials', '', 'column-left', 1, 9, 'wonauctionaccept.php', NULL, 'PAS'),
(null, 'bidpackage', '', 'column-left', 1, 5, 'wonauctionaccept.php', NULL, 'PAS'),
(null, 'lastwinner', '', 'column-left', 1, 1, 'wonauctionaccept.php', NULL, 'PAS'),
(null, 'user_menu', '', 'column-left', 0, 2, 'wonauctionaccept.php', NULL, 'PAS'),
(null, 'advertisebannerwide', '', 'column-left', 2, 6, 'vouchers.php', NULL, 'PAS'),
(null, 'advertisebannernarrow', '', 'column-left', 3, 7, 'vouchers.php', NULL, 'PAS'),
(null, 'advertising', '', 'column-left', 4, 6, 'vouchers.php', NULL, 'PAS'),
(null, 'rightsocial', '', 'column-left', 5, 3, 'vouchers.php', NULL, 'PAS'),
(null, 'rightnews', '', 'column-left', 6, 4, 'vouchers.php', NULL, 'PAS'),
(null, 'testimonials', '', 'column-left', 7, 9, 'vouchers.php', NULL, 'PAS'),
(null, 'bidpackage', '', 'column-left', 8, 5, 'vouchers.php', NULL, 'PAS'),
(null, 'lastwinner', '', 'column-left', 9, 1, 'vouchers.php', NULL, 'PAS'),
(null, 'user_menu', '', 'column-left', 0, 2, 'vouchers.php', NULL, 'PAS'),
(null, 'advertisebannerwide', '', 'column-left', 2, 6, 'unsubscribeuser.php', NULL, 'PAS'),
(null, 'advertisebannernarrow', '', 'column-left', 3, 7, 'unsubscribeuser.php', NULL, 'PAS'),
(null, 'advertising', '', 'column-left', 4, 6, 'unsubscribeuser.php', NULL, 'PAS'),
(null, 'rightsocial', '', 'column-left', 5, 3, 'unsubscribeuser.php', NULL, 'PAS'),
(null, 'rightnews', '', 'column-left', 6, 4, 'unsubscribeuser.php', NULL, 'PAS'),
(null, 'testimonials', '', 'column-left', 7, 9, 'unsubscribeuser.php', NULL, 'PAS'),
(null, 'bidpackage', '', 'column-left', 8, 5, 'unsubscribeuser.php', NULL, 'PAS'),
(null, 'lastwinner', '', 'column-left', 9, 1, 'unsubscribeuser.php', NULL, 'PAS'),
(null, 'user_menu', '', 'column-left', 0, 2, 'unsubscribeuser.php', NULL, 'PAS'),
(null, 'advertisebannerwide', '', 'column-left', 2, 6, 'terms.php', NULL, 'PAS'),
(null, 'advertisebannernarrow', '', 'column-left', 3, 7, 'terms.php', NULL, 'PAS'),
(null, 'advertising', '', 'column-left', 4, 6, 'terms.php', NULL, 'PAS'),
(null, 'rightsocial', '', 'column-left', 5, 3, 'terms.php', NULL, 'PAS'),
(null, 'rightnews', '', 'column-left', 6, 4, 'terms.php', NULL, 'PAS'),
(null, 'testimonials', '', 'column-left', 7, 9, 'terms.php', NULL, 'PAS'),
(null, 'bidpackage', '', 'column-left', 8, 5, 'terms.php', NULL, 'PAS'),
(null, 'lastwinner', '', 'column-left', 9, 1, 'terms.php', NULL, 'PAS'),
(null, 'help_menu', '', 'column-left', 1, 2, 'terms.php', NULL, 'PAS'),
(null, 'advertisebannerwide', '', 'column-left', 2, 6, 'privacy.php', NULL, 'PAS'),
(null, 'advertisebannernarrow', '', 'column-left', 3, 7, 'privacy.php', NULL, 'PAS'),
(null, 'advertising', '', 'column-left', 4, 6, 'privacy.php', NULL, 'PAS'),
(null, 'rightsocial', '', 'column-left', 5, 3, 'privacy.php', NULL, 'PAS'),
(null, 'rightnews', '', 'column-left', 6, 4, 'privacy.php', NULL, 'PAS'),
(null, 'testimonials', '', 'column-left', 7, 9, 'privacy.php', NULL, 'PAS'),
(null, 'bidpackage', '', 'column-left', 8, 5, 'privacy.php', NULL, 'PAS'),
(null, 'lastwinner', '', 'column-left', 9, 1, 'privacy.php', NULL, 'PAS'),
(null, 'help_menu', '', 'column-left', 1, 2, 'privacy.php', NULL, 'PAS'),
(null, 'advertisebannerwide', '', 'column-left', 2, 6, 'payment_unsuccess.php', NULL, 'PAS'),
(null, 'advertisebannernarrow', '', 'column-left', 3, 7, 'payment_unsuccess.php', NULL, 'PAS'),
(null, 'advertising', '', 'column-left', 4, 6, 'payment_unsuccess.php', NULL, 'PAS'),
(null, 'rightsocial', '', 'column-left', 5, 3, 'payment_unsuccess.php', NULL, 'PAS'),
(null, 'rightnews', '', 'column-left', 6, 4, 'payment_unsuccess.php', NULL, 'PAS'),
(null, 'testimonials', '', 'column-left', 7, 9, 'payment_unsuccess.php', NULL, 'PAS'),
(null, 'bidpackage', '', 'column-left', 8, 5, 'payment_unsuccess.php', NULL, 'PAS'),
(null, 'lastwinner', '', 'column-left', 9, 1, 'payment_unsuccess.php', NULL, 'PAS'),
(null, 'user_menu', '', 'column-left', 0, 2, 'payment_unsuccess.php', NULL, 'PAS'),
(null, 'user_menu', '', 'column-left', 0, 2, 'payment_success.php', NULL, 'PAS'),
(null, 'advertisebannerwide', '', 'column-left', 1, 6, 'payment_success.php', NULL, 'PAS'),
(null, 'advertisebannernarrow', '', 'column-left', 1, 7, 'payment_success.php', NULL, 'PAS'),
(null, 'advertising', '', 'column-left', 1, 6, 'payment_success.php', NULL, 'PAS'),
(null, 'rightsocial', '', 'column-left', 1, 3, 'payment_success.php', NULL, 'PAS'),
(null, 'rightnews', '', 'column-left', 1, 4, 'payment_success.php', NULL, 'PAS'),
(null, 'testimonials', '', 'column-left', 1, 9, 'payment_success.php', NULL, 'PAS'),
(null, 'bidpackage', '', 'column-left', 1, 5, 'payment_success.php', NULL, 'PAS'),
(null, 'lastwinner', '', 'column-left', 1, 1, 'payment_success.php', NULL, 'PAS'),
(null, 'user_menu', '', 'column-left', 0, 2, 'jobs.php', NULL, 'PAS'),
(null, 'advertisebannerwide', '', 'column-left', 1, 6, 'jobs.php', NULL, 'PAS'),
(null, 'advertisebannernarrow', '', 'column-left', 1, 7, 'jobs.php', NULL, 'PAS'),
(null, 'advertising', '', 'column-left', 1, 6, 'jobs.php', NULL, 'PAS'),
(null, 'rightsocial', '', 'column-left', 1, 3, 'jobs.php', NULL, 'PAS'),
(null, 'rightnews', '', 'column-left', 1, 4, 'jobs.php', NULL, 'PAS'),
(null, 'testimonials', '', 'column-left', 1, 9, 'jobs.php', NULL, 'PAS'),
(null, 'bidpackage', '', 'column-left', 1, 5, 'jobs.php', NULL, 'PAS'),
(null, 'lastwinner', '', 'column-left', 1, 1, 'jobs.php', NULL, 'PAS'),
(null, 'user_menu', '', 'column-left', 0, 2, 'inviter.php', NULL, 'PAS'),
(null, 'advertisebannerwide', '', 'column-left', 1, 6, 'inviter.php', NULL, 'PAS'),
(null, 'advertisebannernarrow', '', 'column-left', 1, 7, 'inviter.php', NULL, 'PAS'),
(null, 'advertising', '', 'column-left', 1, 6, 'inviter.php', NULL, 'PAS'),
(null, 'rightsocial', '', 'column-left', 1, 3, 'inviter.php', NULL, 'PAS'),
(null, 'rightnews', '', 'column-left', 1, 4, 'inviter.php', NULL, 'PAS'),
(null, 'testimonials', '', 'column-left', 1, 9, 'inviter.php', NULL, 'PAS'),
(null, 'bidpackage', '', 'column-left', 1, 5, 'inviter.php', NULL, 'PAS'),
(null, 'lastwinner', '', 'column-left', 1, 1, 'inviter.php', NULL, 'PAS'),
(null, 'user_menu', '', 'column-left', 0, 2, 'inviterwrapper.php', NULL, 'PAS'),
(null, 'advertisebannerwide', '', 'column-left', 1, 6, 'inviterwrapper.php', NULL, 'PAS'),
(null, 'advertisebannernarrow', '', 'column-left', 1, 7, 'inviterwrapper.php', NULL, 'PAS'),
(null, 'advertising', '', 'column-left', 1, 6, 'inviterwrapper.php', NULL, 'PAS'),
(null, 'rightsocial', '', 'column-left', 1, 3, 'inviterwrapper.php', NULL, 'PAS'),
(null, 'rightnews', '', 'column-left', 1, 4, 'inviterwrapper.php', NULL, 'PAS'),
(null, 'testimonials', '', 'column-left', 1, 9, 'inviterwrapper.php', NULL, 'PAS'),
(null, 'bidpackage', '', 'column-left', 1, 5, 'inviterwrapper.php', NULL, 'PAS'),
(null, 'lastwinner', '', 'column-left', 1, 1, 'inviterwrapper.php', NULL, 'PAS'),
(null, 'faq_menu', '', 'column-left', 1, 2, 'help.php', NULL, 'PAS'),
(null, 'advertisebannerwide', '', 'column-left', 1, 6, 'help.php', NULL, 'PAS'),
(null, 'advertisebannernarrow', '', 'column-left', 1, 7, 'help.php', NULL, 'PAS'),
(null, 'advertising', '', 'column-left', 1, 6, 'help.php', NULL, 'PAS'),
(null, 'rightsocial', '', 'column-left', 1, 3, 'help.php', NULL, 'PAS'),
(null, 'rightnews', '', 'column-left', 1, 4, 'help.php', NULL, 'PAS'),
(null, 'testimonials', '', 'column-left', 1, 9, 'help.php', NULL, 'PAS'),
(null, 'bidpackage', '', 'column-left', 1, 5, 'help.php', NULL, 'PAS'),
(null, 'lastwinner', '', 'column-left', 1, 1, 'help.php', NULL, 'PAS'),
(null, 'user_menu', '', 'column-left', 0, 2, 'forgotpassword.php', NULL, 'PAS'),
(null, 'advertisebannerwide', '', 'column-left', 1, 6, 'forgotpassword.php', NULL, 'PAS'),
(null, 'advertisebannernarrow', '', 'column-left', 1, 7, 'forgotpassword.php', NULL, 'PAS'),
(null, 'advertising', '', 'column-left', 1, 6, 'forgotpassword.php', NULL, 'PAS'),
(null, 'rightsocial', '', 'column-left', 1, 3, 'forgotpassword.php', NULL, 'PAS'),
(null, 'rightnews', '', 'column-left', 1, 4, 'forgotpassword.php', NULL, 'PAS'),
(null, 'testimonials', '', 'column-left', 1, 9, 'forgotpassword.php', NULL, 'PAS'),
(null, 'bidpackage', '', 'column-left', 1, 5, 'forgotpassword.php', NULL, 'PAS'),
(null, 'lastwinner', '', 'column-left', 1, 1, 'forgotpassword.php', NULL, 'PAS'),
(null, 'user_menu', '', 'column-left', 0, 2, 'feedback.php', NULL, 'PAS'),
(null, 'advertisebannerwide', '', 'column-left', 1, 6, 'feedback.php', NULL, 'PAS'),
(null, 'advertisebannernarrow', '', 'column-left', 1, 7, 'feedback.php', NULL, 'PAS'),
(null, 'advertising', '', 'column-left', 1, 6, 'feedback.php', NULL, 'PAS'),
(null, 'rightsocial', '', 'column-left', 1, 3, 'feedback.php', NULL, 'PAS'),
(null, 'rightnews', '', 'column-left', 1, 4, 'feedback.php', NULL, 'PAS'),
(null, 'testimonials', '', 'column-left', 1, 9, 'feedback.php', NULL, 'PAS'),
(null, 'bidpackage', '', 'column-left', 1, 5, 'feedback.php', NULL, 'PAS'),
(null, 'lastwinner', '', 'column-left', 1, 1, 'feedback.php', NULL, 'PAS'),
(null, 'user_menu', '', 'column-left', 0, 2, 'emailconfirmsuccess.php', NULL, 'PAS'),
(null, 'advertisebannerwide', '', 'column-left', 1, 6, 'emailconfirmsuccess.php', NULL, 'PAS'),
(null, 'advertisebannernarrow', '', 'column-left', 1, 7, 'emailconfirmsuccess.php', NULL, 'PAS'),
(null, 'advertising', '', 'column-left', 1, 6, 'emailconfirmsuccess.php', NULL, 'PAS'),
(null, 'rightsocial', '', 'column-left', 1, 3, 'emailconfirmsuccess.php', NULL, 'PAS'),
(null, 'rightnews', '', 'column-left', 1, 4, 'emailconfirmsuccess.php', NULL, 'PAS'),
(null, 'testimonials', '', 'column-left', 1, 9, 'emailconfirmsuccess.php', NULL, 'PAS'),
(null, 'bidpackage', '', 'column-left', 1, 5, 'emailconfirmsuccess.php', NULL, 'PAS'),
(null, 'lastwinner', '', 'column-left', 1, 1, 'emailconfirmsuccess.php', NULL, 'PAS'),
(null, 'user_menu', '', 'column-left', 0, 2, 'editpassword.php', NULL, 'PAS'),
(null, 'advertisebannerwide', '', 'column-left', 1, 6, 'editpassword.php', NULL, 'PAS'),
(null, 'advertisebannernarrow', '', 'column-left', 1, 7, 'editpassword.php', NULL, 'PAS'),
(null, 'advertising', '', 'column-left', 1, 6, 'editpassword.php', NULL, 'PAS'),
(null, 'rightsocial', '', 'column-left', 1, 3, 'editpassword.php', NULL, 'PAS'),
(null, 'rightnews', '', 'column-left', 1, 4, 'editpassword.php', NULL, 'PAS'),
(null, 'testimonials', '', 'column-left', 1, 9, 'editpassword.php', NULL, 'PAS'),
(null, 'bidpackage', '', 'column-left', 1, 5, 'editpassword.php', NULL, 'PAS'),
(null, 'lastwinner', '', 'column-left', 1, 1, 'editpassword.php', NULL, 'PAS'),
(null, 'user_menu', '', 'column-left', 0, 2, 'coupon.php', NULL, 'PAS'),
(null, 'advertisebannerwide', '', 'column-left', 1, 6, 'coupon.php', NULL, 'PAS'),
(null, 'advertisebannernarrow', '', 'column-left', 1, 7, 'coupon.php', NULL, 'PAS'),
(null, 'advertising', '', 'column-left', 1, 6, 'coupon.php', NULL, 'PAS'),
(null, 'rightsocial', '', 'column-left', 1, 3, 'coupon.php', NULL, 'PAS'),
(null, 'rightnews', '', 'column-left', 1, 4, 'coupon.php', NULL, 'PAS'),
(null, 'testimonials', '', 'column-left', 1, 9, 'coupon.php', NULL, 'PAS'),
(null, 'bidpackage', '', 'column-left', 1, 5, 'coupon.php', NULL, 'PAS'),
(null, 'lastwinner', '', 'column-left', 1, 1, 'coupon.php', NULL, 'PAS'),
(null, 'user_menu', '', 'column-left', 0, 2, 'couponhistory.php', NULL, 'PAS'),
(null, 'advertisebannerwide', '', 'column-left', 1, 6, 'couponhistory.php', NULL, 'PAS'),
(null, 'advertisebannernarrow', '', 'column-left', 1, 7, 'couponhistory.php', NULL, 'PAS'),
(null, 'advertising', '', 'column-left', 1, 6, 'couponhistory.php', NULL, 'PAS'),
(null, 'rightsocial', '', 'column-left', 1, 3, 'couponhistory.php', NULL, 'PAS'),
(null, 'rightnews', '', 'column-left', 1, 4, 'couponhistory.php', NULL, 'PAS'),
(null, 'testimonials', '', 'column-left', 1, 9, 'couponhistory.php', NULL, 'PAS'),
(null, 'bidpackage', '', 'column-left', 1, 5, 'couponhistory.php', NULL, 'PAS'),
(null, 'lastwinner', '', 'column-left', 1, 1, 'couponhistory.php', NULL, 'PAS'),
(null, 'user_menu', '', 'column-left', 0, 2, 'contact.php', NULL, 'PAS'),
(null, 'advertisebannerwide', '', 'column-left', 3, 6, 'contact.php', NULL, 'PAS'),
(null, 'advertisebannernarrow', '', 'column-left', 4, 7, 'contact.php', NULL, 'PAS'),
(null, 'advertising', '', 'column-left', 5, 6, 'contact.php', NULL, 'PAS'),
(null, 'rightsocial', '', 'column-left', 6, 3, 'contact.php', NULL, 'PAS'),
(null, 'rightnews', '', 'column-left', 7, 4, 'contact.php', NULL, 'PAS'),
(null, 'testimonials', '', 'column-left', 8, 9, 'contact.php', NULL, 'PAS'),
(null, 'bidpackage', '', 'column-left', 9, 5, 'contact.php', NULL, 'PAS'),
(null, 'lastwinner', '', 'column-left', 10, 1, 'contact.php', NULL, 'PAS'),
(null, 'help_menu', '', 'column-left', 1, 1, 'contact.php', NULL, 'PAS'),
(null, 'user_menu', '', 'column-left', 0, 2, 'community.php', NULL, 'PAS'),
(null, 'advertisebannerwide', '', 'column-left', 1, 6, 'community.php', NULL, 'PAS'),
(null, 'advertisebannernarrow', '', 'column-left', 1, 7, 'community.php', NULL, 'PAS'),
(null, 'advertising', '', 'column-left', 1, 6, 'community.php', NULL, 'PAS'),
(null, 'rightsocial', '', 'column-left', 1, 3, 'community.php', NULL, 'PAS'),
(null, 'rightnews', '', 'column-left', 1, 4, 'community.php', NULL, 'PAS'),
(null, 'testimonials', '', 'column-left', 1, 9, 'community.php', NULL, 'PAS'),
(null, 'bidpackage', '', 'column-left', 1, 5, 'community.php', NULL, 'PAS'),
(null, 'lastwinner', '', 'column-left', 1, 1, 'community.php', NULL, 'PAS'),
(null, 'user_menu', '', 'column-left', 0, 2, 'comment.php', NULL, 'PAS'),
(null, 'help_menu', '', 'column-left', 1, 2, 'comment.php', NULL, 'PAS'),
(null, 'faq_menu', '', 'column-left', 1, 2, 'comment.php', NULL, 'PAS'),
(null, 'advertisebannerwide', '', 'column-left', 1, 6, 'comment.php', NULL, 'PAS'),
(null, 'advertisebannernarrow', '', 'column-left', 1, 7, 'comment.php', NULL, 'PAS'),
(null, 'advertising', '', 'column-left', 1, 6, 'comment.php', NULL, 'PAS'),
(null, 'rightsocial', '', 'column-left', 1, 3, 'comment.php', NULL, 'PAS'),
(null, 'rightnews', '', 'column-left', 1, 4, 'comment.php', NULL, 'PAS'),
(null, 'testimonials', '', 'column-left', 1, 9, 'comment.php', NULL, 'PAS'),
(null, 'bidpackage', '', 'column-left', 1, 5, 'comment.php', NULL, 'PAS'),
(null, 'lastwinner', '', 'column-left', 1, 1, 'comment.php', NULL, 'PAS'),
(null, 'user_menu', '', 'column-left', 0, 2, 'choosevoucher.php', NULL, 'PAS'),
(null, 'help_menu', '', 'column-left', 1, 2, 'choosevoucher.php', NULL, 'PAS'),
(null, 'faq_menu', '', 'column-left', 1, 2, 'choosevoucher.php', NULL, 'PAS'),
(null, 'advertisebannerwide', '', 'column-left', 1, 6, 'choosevoucher.php', NULL, 'PAS'),
(null, 'advertisebannernarrow', '', 'column-left', 1, 7, 'choosevoucher.php', NULL, 'PAS'),
(null, 'advertising', '', 'column-left', 1, 6, 'choosevoucher.php', NULL, 'PAS'),
(null, 'rightsocial', '', 'column-left', 1, 3, 'choosevoucher.php', NULL, 'PAS'),
(null, 'rightnews', '', 'column-left', 1, 4, 'choosevoucher.php', NULL, 'PAS'),
(null, 'testimonials', '', 'column-left', 1, 9, 'choosevoucher.php', NULL, 'PAS'),
(null, 'bidpackage', '', 'column-left', 1, 5, 'choosevoucher.php', NULL, 'PAS'),
(null, 'lastwinner', '', 'column-left', 1, 1, 'choosevoucher.php', NULL, 'PAS'),
(null, 'user_menu', '', 'column-left', 0, 2, 'buyitnow.php', NULL, 'PAS'),
(null, 'help_menu', '', 'column-left', 1, 2, 'buyitnow.php', NULL, 'PAS'),
(null, 'faq_menu', '', 'column-left', 1, 2, 'buyitnow.php', NULL, 'PAS'),
(null, 'advertisebannerwide', '', 'column-left', 1, 6, 'buyitnow.php', NULL, 'PAS'),
(null, 'advertisebannernarrow', '', 'column-left', 1, 7, 'buyitnow.php', NULL, 'PAS'),
(null, 'advertising', '', 'column-left', 1, 6, 'buyitnow.php', NULL, 'PAS'),
(null, 'rightsocial', '', 'column-left', 1, 3, 'buyitnow.php', NULL, 'PAS'),
(null, 'rightnews', '', 'column-left', 1, 4, 'buyitnow.php', NULL, 'PAS'),
(null, 'testimonials', '', 'column-left', 1, 9, 'buyitnow.php', NULL, 'PAS'),
(null, 'bidpackage', '', 'column-left', 1, 5, 'buyitnow.php', NULL, 'PAS'),
(null, 'lastwinner', '', 'column-left', 1, 1, 'buyitnow.php', NULL, 'PAS'),
(null, 'user_menu', '', 'column-left', 0, 2, 'buybids.php', NULL, 'PAS'),
(null, 'help_menu', '', 'column-left', 1, 2, 'buybids.php', NULL, 'PAS'),
(null, 'faq_menu', '', 'column-left', 1, 2, 'buybids.php', NULL, 'PAS'),
(null, 'advertisebannerwide', '', 'column-left', 1, 6, 'buybids.php', NULL, 'PAS'),
(null, 'advertisebannernarrow', '', 'column-left', 1, 7, 'buybids.php', NULL, 'PAS'),
(null, 'advertising', '', 'column-left', 1, 6, 'buybids.php', NULL, 'PAS'),
(null, 'rightsocial', '', 'column-left', 1, 3, 'buybids.php', NULL, 'PAS'),
(null, 'rightnews', '', 'column-left', 1, 4, 'buybids.php', NULL, 'PAS'),
(null, 'testimonials', '', 'column-left', 1, 9, 'buybids.php', NULL, 'PAS'),
(null, 'bidpackage', '', 'column-left', 1, 5, 'buybids.php', NULL, 'PAS'),
(null, 'lastwinner', '', 'column-left', 1, 1, 'buybids.php', NULL, 'PAS'),
(null, 'user_menu', '', 'column-left', 0, 2, 'bidhistory.php', NULL, 'PAS'),
(null, 'help_menu', '', 'column-left', 11, 2, 'bidhistory.php', NULL, 'PAS'),
(null, 'faq_menu', '', 'column-left', 12, 2, 'bidhistory.php', NULL, 'PAS'),
(null, 'advertisebannerwide', '', 'column-left', 13, 6, 'bidhistory.php', NULL, 'PAS'),
(null, 'advertisebannernarrow', '', 'column-left', 14, 7, 'bidhistory.php', NULL, 'PAS'),
(null, 'advertising', '', 'column-left', 15, 6, 'bidhistory.php', NULL, 'PAS'),
(null, 'rightsocial', '', 'column-left', 16, 3, 'bidhistory.php', NULL, 'PAS'),
(null, 'rightnews', '', 'column-left', 17, 4, 'bidhistory.php', NULL, 'PAS'),
(null, 'testimonials', '', 'column-left', 18, 9, 'bidhistory.php', NULL, 'PAS'),
(null, 'bidpackage', '', 'column-left', 19, 5, 'bidhistory.php', NULL, 'PAS'),
(null, 'lastwinner', '', 'column-left', 20, 1, 'bidhistory.php', NULL, 'PAS'),
(null, 'user_menu', '', 'column-left', 0, 2, 'affiliate.php', NULL, 'PAS'),
(null, 'help_menu', '', 'column-left', 1, 2, 'affiliate.php', NULL, 'PAS'),
(null, 'faq_menu', '', 'column-left', 1, 2, 'affiliate.php', NULL, 'PAS'),
(null, 'advertisebannerwide', '', 'column-left', 1, 6, 'affiliate.php', NULL, 'PAS'),
(null, 'advertisebannernarrow', '', 'column-left', 1, 7, 'affiliate.php', NULL, 'PAS'),
(null, 'advertising', '', 'column-left', 1, 6, 'affiliate.php', NULL, 'PAS'),
(null, 'rightsocial', '', 'column-left', 1, 3, 'affiliate.php', NULL, 'PAS'),
(null, 'rightnews', '', 'column-left', 1, 4, 'affiliate.php', NULL, 'PAS'),
(null, 'testimonials', '', 'column-left', 1, 9, 'affiliate.php', NULL, 'PAS'),
(null, 'bidpackage', '', 'column-left', 1, 5, 'affiliate.php', NULL, 'PAS'),
(null, 'lastwinner', '', 'column-left', 1, 1, 'affiliate.php', NULL, 'PAS'),
(null, 'user_menu', '', 'column-left', 0, 2, 'aboutus.php', NULL, 'PAS'),
(null, 'help_menu', '', 'column-left', 1, 2, 'aboutus.php', NULL, 'PAS'),
(null, 'faq_menu', '', 'column-left', 3, 2, 'aboutus.php', NULL, 'PAS'),
(null, 'advertisebannerwide', '', 'column-left', 4, 6, 'aboutus.php', NULL, 'PAS'),
(null, 'advertisebannernarrow', '', 'column-left', 5, 7, 'aboutus.php', NULL, 'PAS'),
(null, 'advertising', '', 'column-left', 6, 6, 'aboutus.php', NULL, 'PAS'),
(null, 'rightsocial', '', 'column-left', 7, 3, 'aboutus.php', NULL, 'PAS'),
(null, 'rightnews', '', 'column-left', 8, 4, 'aboutus.php', NULL, 'PAS'),
(null, 'testimonials', '', 'column-left', 9, 9, 'aboutus.php', NULL, 'PAS'),
(null, 'bidpackage', '', 'column-left', 10, 5, 'aboutus.php', NULL, 'PAS'),
(null, 'lastwinner', '', 'column-left', 11, 1, 'aboutus.php', NULL, 'PAS'),
(null, 'column-left', '', 'container', 1, 1, '*', NULL, 'PAS'),
(null, 'column-right', '', 'container', 1, 1, '*', NULL, 'PAS'),
(null, 'steps_box', '', 'column-left', 11, 1, 'index.php', NULL, 'PAS'),
(null, 'slider', '', 'column-left', 5, 1, 'index.php', NULL, 'PAS'),
(null, 'auction_boxes', '', 'column-left', 23, 1, 'index.php', NULL, 'PAS'),
(null, 'Auction Boxes', 'admin', 'design_menu', 3, 1, NULL, NULL, 'PAS'),
(null, 'auction_boxes', '', 'container', 1, 1, 'viewproduct.php', 1, 'PAS'),
(null, 'auction_boxes', '', 'container', 1, 1, 'viewproduct_lowest.php', 1, 'PAS'),
(null, 'Main Slider', 'admin', 'design_menu', 4, 1, '', 0, 'PAS');

-- NEXT_QUERY --

INSERT INTO `social_support` (`id`, `socialname`, `socialpath`, `socialurl`, `actived`) VALUES
(null, 'facebook', '1296145635_facebook.png', 'http://www.facebook.com/pennyauctionsoft', 1),
(null, 'Digg', '1296145669_digg.png', 'http://www.digg.com/pennyauctionsoft', 1),
(null, 'linkedin', '1296145714_linkedin.png', 'http://www.linkedin.com', 0),
(null, 'myspace', '1296145733_myspace.png', 'http://www.myspace.com', 0),
(null, 'stumbleupon', '1296145777_stumbleupon.png', 'http://www.stumbleupon.com/pennyauctionsoft', 1),
(null, 'twitter', '1296145795_twitter.png', 'http://www.twitter.com/pennyauctionsoft', 1),
(null, 'youtube', '1296145811_youtube.png', 'http://www.youtube.com/pennyauctionsoft', 1);

-- NEXT_QUERY --

INSERT INTO `settings_array` (`id`, `name`, `text`) VALUES
(null, 'ADMIN_MAIN_SITE_NAME', 'Site Full Name'),
(null, 'SITE_NM', 'Site Short Name'),
(null, 'AllPageTitle', 'Default Page Title'),
(null, 'MetaTagskeywords', 'Default Keywords'),
(null, 'MetaTagsdescripton', 'Default Site Description'),
(null, 'defaultlanguage', 'Default Language(overridden in language settings'),
(null, 'Currency', 'Currency Symbol'),
(null, 'CurrencyName', 'Currency Text'),
(null, 'PlusPointValue', 'Plus Point Value'),
(null, 'googleverification', 'Google Key'),
(null, 'customtags', 'Extra Meta Tags'),
(null, 'PRODUCTSPERPAGE', 'Products Per Page(not effective in all templates)'),
(null, 'PRODUCTSPERPAGE_MYACCOUNT', 'Products Per Page for Account Pages(not effective in all templates)'),
(null, 'template', 'Your Site Layout');

-- NEXT_QUERY --

INSERT INTO `sitesetting` (`id`, `name`, `value`, `license_key`, `status`, `license`) VALUES
(null, 'adminemail', 'support@pennyauctionsoft.com', NULL, 1, NULL),
(null, 'bidprice', '.10', NULL, 1, NULL),
(null, 'maxdiscount', '10', NULL, 1, NULL),
(null, 'avatarfeature', '1', NULL, 1, NULL),
(null, 'lastaucseconds', '20', NULL, 1, NULL),
(null, 'winpermonth', '100', NULL, 1, NULL),
(null, 'winperweek', '100', NULL, 1, NULL),
(null, 'seourl', '1', NULL, 1, NULL),
(null, 'timerdelay', '1', NULL, 1, NULL),
(null, 'taxenable', '1', NULL, 1, NULL),
(null, 'inviter', '0', NULL, 1, NULL),
(null, 'featuredcount', '20', NULL, 1, NULL),
(null, 'autobidsecond', '0', NULL, 1, NULL),
(null, 'adminautobidder', '1', NULL, 1, NULL),
(null, 'adminbidtype', '0', NULL, 1, NULL),
(null, 'halfback', '50', NULL, 1, NULL),
(null, 'flashbanner', '1', NULL, 1, NULL),
(null, 'leavetimeout', '5', NULL, 1, NULL),
(null, 'livemap', '', NULL, 1, NULL),
(null, 'defaultlanguage', 'english', NULL, 1, NULL),
(null, 'social', '1', NULL, 1, NULL),
(null, 'allowadminbid', '1', NULL, 1, NULL),
(null, 'refreshrate', '1000', NULL, 1, NULL),
(null, 'reftimeout', '3000', NULL, 1, NULL),
(null, 'dateformat', 'm/d/Y', NULL, 1, NULL),
(null, 'version', 'multi_coupon:6.5.1', NULL, 1, NULL),
(null, 'max_discount', '75', NULL, 1, NULL),
(null, 'multiple_coupon', '1', NULL, 1, NULL),
(null, 'version', 'common:6.5.1', NULL, 1, NULL),
(null, 'version', 'infusion:6.5.1', NULL, 1, NULL),
(null, 'version', 'design_suite:6.5.1', NULL, 1, NULL),
(null, 'version', 'autolister:6.5.1', NULL, 1, NULL),
(null, 'version', 'uploader:6.5.1', NULL, 1, NULL),
(null, 'version', 'facebook:6.5.1', NULL, 1, NULL),
(null, 'version', 'tutorials:6.5.1', NULL, 1, NULL),
(null, 'version', 'backend:6.5.1', NULL, 1, NULL),
(null, 'version', 'notifications:6.5.1', NULL, 1, NULL),
(null, 'redemption', '1', NULL, 1, NULL),
(null, 'slider_buttons', 'yellow', NULL, 0, NULL);

-- NEXT_QUERY --

INSERT INTO `sitesetting` (`id`, `name`, `value`, `license_key`, `status`, `license`) VALUES
(null, 'afilliate_progr', 'infusion', '231bb97fa1f22a8f2e249db5658e9f5f', 0, NULL),
(null, 'version', 'set_and_forget:6.5.1', NULL, 1, NULL),
(null, 'guest', '', NULL, 1, NULL),
(null, 'resettime', '60', NULL, 1, NULL),
(null, 'reservetext', 'RESERVE NOT MET', NULL, 1, NULL),
(null, 'aggregate', '1', NULL, 1, NULL),
(null, 'prompt_confirm', 'disabled::', NULL, 0, NULL),
(null, 'version', 'vendors:6.5.1', NULL, 1, NULL),
(null, 'master_settings', 'ADMIN_MAIN_SITE_NAME:Penny Auction Soft Dev Server', NULL, 1, NULL),
(null, 'master_settings', 'SITE_NM:Penny Auction Soft Dev Server', NULL, 1, NULL),
(null, 'master_settings', 'AllPageTitle:Penny Auction Soft Dev Server', NULL, 1, NULL),
(null, 'master_settings', 'MetaTagskeywords:swoopo clone,swoopo site, telebid action script', NULL, 1, NULL),
(null, 'master_settings', 'MetaTagsdescripton: Win every day products like ipods, furnature, electronics and gift cards for up to 96% off of retail.', NULL, 1, NULL),
(null, 'master_settings', 'defaultlanguage:english', NULL, 1, NULL),
(null, 'master_settings', 'Currency:$', NULL, 1, NULL),
(null, 'master_settings', 'CurrencyName:USD', NULL, 1, NULL),
(null, 'master_settings', 'PlusPointValue:50', NULL, 1, NULL),
(null, 'master_settings', 'googleverification:ZX14317801374018374', NULL, 1, NULL),
(null, 'master_settings', 'customtags:', NULL, 1, NULL),
(null, 'master_settings', 'PRODUCTSPERPAGE:10', NULL, 1, NULL),
(null, 'master_settings', 'PRODUCTSPERPAGE_MYACCOUNT:5', NULL, 1, NULL),
(null, 'master_settings', 'SiteCity:', NULL, 1, NULL),
(null, 'master_settings', 'SiteState:', NULL, 1, NULL),
(null, 'master_settings', 'SiteCountry:', NULL, 1, NULL),
(null, 'version', 'award_points:6.5.1', NULL, 1, NULL),
(null, 'version', 'livesupport:6.5.1', NULL, 1, NULL),
(null, 'version', 'whosonline:6.5.1', NULL, 1, NULL),
(null, 'version', 'topmenu:6.5.1', NULL, 1, NULL),
(null, 'version', 'login_area:6.5.1', NULL, 1, NULL),
(null, 'version', 'testimonials:6.5.1', NULL, 1, NULL),
(null, 'version', 'emailer:6.5.1', NULL, 1, NULL),
(null, 'addons', 'custom_content', '', 1, NULL),
(null, 'addons', 'uploader', '', 1, NULL),
(null, 'addons', 'award_points', '', 1, NULL),
(null, 'addons', 'testimonials', '', 1, NULL),
(null, 'addons', 'livesupport', '', 1, NULL),
(null, 'addons', 'whosonline', '', 1, NULL);

-- NEXT_QUERY --

INSERT INTO `sitesetting` (`id`, `name`, `value`, `license_key`, `status`, `license`) VALUES
(null, 'addons', 'topmenu', '', 1, NULL),
(null, 'addons', 'login_area', '', 1, NULL),
(null, 'addons', 'multi_coupon', '', 1, NULL),
(null, 'version', 'custom_content:6.5.1', NULL, 0, NULL),
(null, 'version', 'blank_page:6.5.1', NULL, 0, NULL),
(null, 'addons', 'steps_box', '', 1, NULL),
(null, 'addons', 'maps', '', 1, NULL),
(null, 'addons', 'advertising', '', 1, NULL),
(null, 'addons', 'advertising_narrow', '', 1, NULL),
(null, 'addons', 'advertising_wide', '', 1, NULL),
(null, 'addons', 'advertising_main', '', 1, NULL),
(null, 'addons', 'bidpack_menu', '', 1, NULL),
(null, 'addons', 'category_menu', '', 1, NULL),
(null, 'addons', 'coupon_side_menu', '', 1, NULL),
(null, 'addons', 'last_winner', '', 1, NULL),
(null, 'addons', 'latest_news', '', 1, NULL),
(null, 'addons', 'right_social', '', 1, NULL),
(null, 'addons', 'search_box', '', 1, NULL),
(null, 'addons', 'emailer', '', 1, NULL),
(null, 'addons', 'steps_bid', '', 1, NULL),
(null, 'addons', 'user_menu', '', 1, NULL),
(null, 'addons', 'help_menu', '', 1, NULL),
(null, 'addons', 'faq_menu', '', 1, NULL),
(null, 'addons', 'slider', '', 1, NULL),
(null, 'icons', 'pas', '', 0, ''),
(null, 'addons', 'auction_descriptions', '', 1, 'free'),
(null, 'addons', 'autolister', '', 0, NULL),
(null, 'addons', 'banner', '', 1, ''),
(null, 'addons', 'blank_page', '', 1, NULL),
(null, 'addons', 'auction_boxes', '', 1, NULL),
(null, 'addons', 'top_auctions', '', 1, 'free'),
(null, 'version', 'steps_box:6.5.1', NULL, 0, NULL),
(null, 'version', 'advertising:6.5.1', NULL, 0, NULL),
(null, 'version', 'advertising_narrow:6.5.1', NULL, 0, NULL),
(null, 'version', 'advertising_wide:6.5.1', NULL, 0, NULL),
(null, 'version', 'advertising_main:6.5.1', NULL, 0, NULL),
(null, 'version', 'bidpack_menu:6.5.1', NULL, 0, NULL);

-- NEXT_QUERY --

INSERT INTO `page_areas` VALUES (null,'Edit Left Column','admin','design_menu',3,0,NULL,NULL,'PAS'),(null,'Edit Right Column','admin','design_menu',3,0,NULL,NULL,'PAS'),(null,'Edit Page Header','Work on an area of the page','design_menu',3,0,NULL,NULL,'PAS'),(null,'Replace Values','Quickly Replace Colors, Images, Gradients or Text','design_menu',6,0,NULL,NULL,'PAS'),(null,'lastwinner','','column-right',1,0,'index.php',NULL,'PAS'),(null,'Edit Body Area','admin','design_menu',3,0,NULL,NULL,'PAS'),(null,'Edit Footer','admin','design_menu',3,0,NULL,NULL,'PAS'),(null,'rightsocial','','column-right',4,0,'index.php',NULL,'PAS'),(null,'rightnews','','column-right',5,0,'index.php',NULL,'PAS'),(null,'bidpackage','','column-right',3,0,'index.php',NULL,'PAS'),(null,'testimonials','','column-right',2,0,'index.php',NULL,'PAS'),(null,'advertisebannerwide','','column-right',7,0,'index.php',NULL,'PAS'),(null,'advertisebannernarrow','','column-right',6,0,'index.php',NULL,'PAS'),(null,'advertisebannerwide','','column-left',2,0,'myaccount.php',NULL,'PAS'),(null,'advertisebannernarrow','','column-left',3,0,'myaccount.php',NULL,'PAS'),(null,'advertising','','column-left',4,0,'myaccount.php',NULL,'PAS'),(null,'rightsocial','','column-left',6,0,'myaccount.php',NULL,'PAS'),(null,'rightnews','','column-left',5,0,'myaccount.php',NULL,'PAS'),(null,'user_menu','','column-left',0,0,'myaccount.php',NULL,'PAS'),(null,'testimonials','','column-left',7,0,'myaccount.php',NULL,'PAS'),(null,'bidpackage','','column-left',8,0,'myaccount.php',NULL,'PAS'),(null,'lastwinner','','column-left',9,0,'myaccount.php',NULL,'PAS'),(null,'advertisebannerwide','','column-left',1,0,'myauctions.php',NULL,'PAS'),(null,'advertisebannernarrow','','column-left',3,0,'myauctions.php',NULL,'PAS'),(null,'advertising','','column-left',4,0,'myauctions.php',NULL,'PAS'),(null,'rightsocial','','column-left',5,0,'myauctions.php',NULL,'PAS'),(null,'rightnews','','column-left',6,0,'myauctions.php',NULL,'PAS'),(null,'user_menu','','column-left',0,0,'myauctions.php',NULL,'PAS'),(null,'testimonials','','column-left',7,0,'myauctions.php',NULL,'PAS'),(null,'bidpackage','','column-left',8,0,'myauctions.php',NULL,'PAS'),(null,'lastwinner','','column-left',9,0,'myauctions.php',NULL,'PAS'),(null,'advertisebannerwide','','column-left',2,0,'myavatar.php',NULL,'PAS'),(null,'advertisebannernarrow','','column-left',5,0,'myavatar.php',NULL,'PAS'),(null,'advertising','','column-left',3,0,'myavatar.php',NULL,'PAS'),(null,'rightsocial','','column-left',4,0,'myavatar.php',NULL,'PAS'),(null,'rightnews','','column-left',6,0,'myavatar.php',NULL,'PAS'),(null,'user_menu','','column-left',0,0,'myavatar.php',NULL,'PAS'),(null,'testimonials','','column-left',7,0,'myavatar.php',NULL,'PAS'),(null,'bidpackage','','column-left',8,0,'myavatar.php',NULL,'PAS'),(null,'lastwinner','','column-left',9,0,'myavatar.php',NULL,'PAS'),(null,'advertisebannerwide','','column-left',4,0,'myautobidder.php',NULL,'PAS'),(null,'advertisebannernarrow','','column-left',1,0,'myautobidder.php',NULL,'PAS'),(null,'advertising','','column-left',2,0,'myautobidder.php',NULL,'PAS'),(null,'rightsocial','','column-left',5,0,'myautobidder.php',NULL,'PAS'),(null,'rightnews','','column-left',10,0,'myautobidder.php',NULL,'PAS'),(null,'user_menu','','column-left',0,0,'myautobidder.php',NULL,'PAS'),(null,'testimonials','','column-left',6,0,'myautobidder.php',NULL,'PAS'),(null,'bidpackage','','column-left',7,0,'myautobidder.php',NULL,'PAS'),(null,'lastwinner','','column-left',9,0,'myautobidder.php',NULL,'PAS'),(null,'advertisebannerwide','','column-left',4,0,'mybidbutler.php',NULL,'PAS'),(null,'advertisebannernarrow','','column-left',2,0,'mybidbutler.php',NULL,'PAS'),(null,'advertising','','column-left',3,0,'mybidbutler.php',NULL,'PAS'),(null,'rightsocial','','column-left',5,0,'mybidbutler.php',NULL,'PAS'),(null,'rightnews','','column-left',6,0,'mybidbutler.php',NULL,'PAS'),(null,'user_menu','','column-left',0,0,'mybidbutler.php',NULL,'PAS'),(null,'testimonials','','column-left',7,0,'mybidbutler.php',NULL,'PAS'),(null,'bidpackage','','column-left',8,0,'
mybidbutler.php',NULL,'PAS'),(null,'lastwinner','','column-
left',9,0,'mybidbutler.php',NULL,'PAS'),(null,'advertisebannerwide','','column-left',1,0,'mybuynow.php',NULL,'PAS'),(null,'advertisebannernarrow','','column-left',1,0,'mybuynow.php',NULL,'PAS'),(null,'advertising','','column-left',1,0,'mybuynow.php',NULL,'PAS'),(null,'rightsocial','','column-left',1,0,'mybuynow.php',NULL,'PAS'),(null,'rightnews','','column-left',1,0,'mybuynow.php',NULL,'PAS'),(null,'user_menu','','column-left',0,0,'mybuynow.php',NULL,'PAS'),(null,'testimonials','','column-left',1,0,'mybuynow.php',NULL,'PAS'),(null,'bidpackage','','column-left',1,0,'mybuynow.php',NULL,'PAS'),(null,'lastwinner','','column-left',1,0,'mybuynow.php',NULL,'PAS'),(null,'advertisebannerwide','','column-left',1,0,'mycoupon.php',NULL,'PAS'),(null,'advertisebannernarrow','','column-left',1,0,'mycoupon.php',NULL,'PAS'),(null,'advertising','','column-left',1,0,'mycoupon.php',NULL,'PAS'),(null,'rightsocial','','column-left',1,0,'mycoupon.php',NULL,'PAS'),(null,'rightnews','','column-left',1,0,'mycoupon.php',NULL,'PAS'),(null,'user_menu','','column-left',0,0,'mycoupon.php',NULL,'PAS'),(null,'testimonials','','column-left',1,0,'mycoupon.php',NULL,'PAS'),(null,'bidpackage','','column-left',1,0,'mycoupon.php',NULL,'PAS'),(null,'lastwinner','','column-left',1,0,'mycoupon.php',NULL,'PAS'),(null,'advertisebannerwide','','column-left',1,0,'mydetails.php',NULL,'PAS'),(null,'advertisebannernarrow','','column-left',1,0,'mydetails.php',NULL,'PAS'),(null,'advertising','','column-left',1,0,'mydetails.php',NULL,'PAS'),(null,'rightsocial','','column-left',1,0,'mydetails.php',NULL,'PAS'),(null,'rightnews','','column-left',1,0,'mydetails.php',NULL,'PAS'),(null,'user_menu','','column-left',0,0,'mydetails.php',NULL,'PAS'),(null,'testimonials','','column-left',1,0,'mydetails.php',NULL,'PAS'),(null,'bidpackage','','column-left',1,0,'mydetails.php',NULL,'PAS'),(null,'lastwinner','','column-left',1,0,'mydetails.php',NULL,'PAS'),(null,'advertisebannerwide','','column-left',1,0,'myredemption.php',NULL,'PAS'),(null,'advertisebannernarrow','','column-left',1,0,'myredemption.php',NULL,'PAS'),(null,'advertising','','column-left',1,0,'myredemption.php',NULL,'PAS'),(null,'rightsocial','','column-left',1,0,'myredemption.php',NULL,'PAS'),(null,'rightnews','','column-left',1,0,'myredemption.php',NULL,'PAS'),(null,'user_menu','','column-left',0,0,'myredemption.php',NULL,'PAS'),(null,'testimonials','','column-left',1,0,'myredemption.php',NULL,'PAS'),(null,'bidpackage','','column-left',1,0,'myredemption.php',NULL,'PAS'),(null,'lastwinner','','column-left',1,0,'myredemption.php',NULL,'PAS'),(null,'advertisebannerwide','','column-left',1,0,'news.php',NULL,'PAS'),(null,'advertisebannernarrow','','column-left',1,0,'news.php',NULL,'PAS'),(null,'advertising','','column-left',1,0,'news.php',NULL,'PAS'),(null,'rightsocial','','column-left',1,0,'news.php',NULL,'PAS'),(null,'rightnews','','column-left',1,0,'news.php',NULL,'PAS'),(null,'user_menu','','column-left',0,0,'news.php',NULL,'PAS'),(null,'testimonials','','column-left',1,0,'news.php',NULL,'PAS'),(null,'bidpackage','','column-left',1,0,'news.php',NULL,'PAS'),(null,'lastwinner','','column-left',1,0,'news.php',NULL,'PAS'),(null,'advertisebannerwide','','column-left',1,0,'newsletter.php',NULL,'PAS'),(null,'advertisebannernarrow','','column-left',1,0,'newsletter.php',NULL,'PAS'),(null,'advertising','','column-left',1,0,'newsletter.php',NULL,'PAS'),(null,'rightsocial','','column-left',1,0,'newsletter.php',NULL,'PAS'),(null,'rightnews','','column-left',1,0,'newsletter.php',NULL,'PAS'),(null,'user_menu','','column-left',0,0,'newsletter.php',NULL,'PAS'),(null,'testimonials','','column-left',1,0,'newsletter.php',NULL,'PAS'),(null,'bidpackage','','column-left',1,0,'newsletter.php',NULL,'PAS'),(null,'lastwinner','','column-left',1,0,'newsletter.php',NULL,'PAS'),(null,'advertisebannerwide','','column-left',2,0,'redemption.php',NULL,'PAS'),(null,'advertisebannernarrow','','column-left',3,0,'redemption.php',NULL,'PAS'),(null,'advertising','','column-left',4,0,'redemption.php',NULL,'PAS'),(null,'rightsocial','','column-left',5,0,'
redemption.php',NULL,'PAS'),(null,'rightnews','','column-left',6,0,'
redemption.php',NULL,'PAS'),(null,'user_menu','','column-left',0,0,'redemption.php',NULL,'PAS'),(null,'testimonials','','column-left',7,0,'redemption.php',NULL,'PAS'),(null,'bidpackage','','column-left',8,0,'redemption.php',NULL,'PAS'),(null,'lastwinner','','column-left',9,0,'redemption.php',NULL,'PAS'),(null,'advertisebannerwide','','column-left',1,0,'redemptiondetail.php',NULL,'PAS'),(null,'advertisebannernarrow','','column-left',1,0,'redemptiondetail.php',NULL,'PAS'),(null,'advertising','','column-left',1,0,'redemptiondetail.php',NULL,'PAS'),(null,'rightsocial','','column-left',1,0,'redemptiondetail.php',NULL,'PAS'),(null,'rightnews','','column-left',1,0,'redemptiondetail.php',NULL,'PAS'),(null,'user_menu','','column-left',0,0,'redemptiondetail.php',NULL,'PAS'),(null,'testimonials','','column-left',1,0,'redemptiondetail.php',NULL,'PAS'),(null,'bidpackage','','column-left',1,0,'redemptiondetail.php',NULL,'PAS'),(null,'lastwinner','','column-left',1,0,'redemptiondetail.php',NULL,'PAS'),(null,'advertisebannerwide','','column-left',1,0,'redemptiondetail.php',NULL,'PAS'),(null,'advertisebannernarrow','','column-left',1,0,'redemptiondetail.php',NULL,'PAS'),(null,'advertising','','column-left',1,0,'registration.php',NULL,'PAS'),(null,'rightsocial','','column-left',1,0,'registration.php',NULL,'PAS'),(null,'rightnews','','column-left',1,0,'registration.php',NULL,'PAS'),(null,'testimonials','','column-left',1,0,'registration.php',NULL,'PAS'),(null,'bidpackage','','column-left',1,0,'registration.php',NULL,'PAS'),(null,'lastwinner','','column-left',1,0,'registration.php',NULL,'PAS'),(null,'advertisebannerwide','','column-left',1,0,'redemptiondetail.php',NULL,'PAS'),(null,'advertisebannernarrow','','column-left',1,0,'redemptiondetail.php',NULL,'PAS'),(null,'advertising','','column-left',2,0,'allauctions.php',NULL,'PAS'),(null,'rightsocial','','column-left',1,0,'allauctions.php',NULL,'PAS'),(null,'rightnews','','column-left',3,0,'allauctions.php',NULL,'PAS'),(null,'testimonials','','column-left',4,0,'allauctions.php',NULL,'PAS'),(null,'bidpackage','','column-left',5,0,'allauctions.php',NULL,'PAS'),(null,'lastwinner','','column-left',6,0,'allauctions.php',NULL,'PAS'),(null,'advertisebannerwide','','column-left',1,0,'allnews.php',NULL,'PAS'),(null,'advertisebannernarrow','','column-left',1,0,'allnews.php',NULL,'PAS'),(null,'advertising','','column-left',1,0,'allnews.php',NULL,'PAS'),(null,'rightsocial','','column-left',1,0,'allnews.php',NULL,'PAS'),(null,'rightnews','','column-left',1,0,'allnews.php',NULL,'PAS'),(null,'testimonials','','column-left',1,0,'allnews.php',NULL,'PAS'),(null,'bidpackage','','column-left',1,0,'allnews.php',NULL,'PAS'),(null,'lastwinner','','column-left',1,0,'allnews.php',NULL,'PAS'),(null,'user_menu','','column-left',0,0,'allnews.php',NULL,'PAS'),(null,'advertisebannerwide','','column-left',13,0,'bidhistory.php',NULL,'PAS'),(null,'advertisebannernarrow','','column-left',14,0,'bidhistory.php',NULL,'PAS'),(null,'advertising','','column-left',15,0,'bidhistory.php',NULL,'PAS'),(null,'rightsocial','','column-left',16,0,'bidhistory.php',NULL,'PAS'),(null,'rightnews','','column-left',17,0,'bidhistory.php',NULL,'PAS'),(null,'testimonials','','column-left',18,0,'bidhistory.php',NULL,'PAS'),(null,'bidpackage','','column-left',19,0,'bidhistory.php',NULL,'PAS'),(null,'lastwinner','','column-left',20,0,'bidhistory.php',NULL,'PAS'),(null,'user_menu','','column-left',0,0,'bidhistory.php',NULL,'PAS'),(null,'advertisebannerwide','','column-left',2,0,'watchauctions.php',NULL,'PAS'),(null,'advertisebannernarrow','','column-left',3,0,'watchauctions.php',NULL,'PAS'),(null,'advertising','','column-left',4,0,'watchauctions.php',NULL,'PAS'),(null,'rightsocial','','column-left',5,0,'watchauctions.php',NULL,'PAS'),(null,'rightnews','','column-left',6,0,'watchauctions.php',NULL,'PAS'),(null,'testimonials','','column-left',7,0,'watchauctions.php',NULL,'PAS'),(null,'bidpackage','','column-left',8,0,'watchauctions.php',NULL,'PAS'),(null,'lastwinner','','column-left',9,0,'watchauctions.php',NULL,'PAS'),(null,'user_menu','','column-left',
0,0,'watchauctions.php',NULL,'PAS'),(null,'
advertisebannerwide','','column-left',1,0,'wonauctions.php',NULL,'PAS'),(null,'advertisebannernarrow','','column-left',1,0,'wonauctions.php',NULL,'PAS'),(null,'advertising','','column-left',1,0,'wonauctions.php',NULL,'PAS'),(null,'rightsocial','','column-left',1,0,'wonauctions.php',NULL,'PAS'),(null,'rightnews','','column-left',1,0,'wonauctions.php',NULL,'PAS'),(null,'testimonials','','column-left',1,0,'wonauctions.php',NULL,'PAS'),(null,'bidpackage','','column-left',1,0,'wonauctions.php',NULL,'PAS'),(null,'lastwinner','','column-left',1,0,'wonauctions.php',NULL,'PAS'),(null,'user_menu','','column-left',0,0,'wonauctions.php',NULL,'PAS'),(null,'advertisebannerwide','','column-left',1,0,'wonauctionaccept.php',NULL,'PAS'),(null,'advertisebannernarrow','','column-left',1,0,'wonauctionaccept.php',NULL,'PAS'),(null,'advertising','','column-left',1,0,'wonauctionaccept.php',NULL,'PAS'),(null,'rightsocial','','column-left',1,0,'wonauctionaccept.php',NULL,'PAS'),(null,'rightnews','','column-left',1,0,'wonauctionaccept.php',NULL,'PAS'),(null,'testimonials','','column-left',1,0,'wonauctionaccept.php',NULL,'PAS'),(null,'bidpackage','','column-left',1,0,'wonauctionaccept.php',NULL,'PAS'),(null,'lastwinner','','column-left',1,0,'wonauctionaccept.php',NULL,'PAS'),(null,'user_menu','','column-left',0,0,'wonauctionaccept.php',NULL,'PAS'),(null,'advertisebannerwide','','column-left',2,0,'vouchers.php',NULL,'PAS'),(null,'advertisebannernarrow','','column-left',3,0,'vouchers.php',NULL,'PAS'),(null,'advertising','','column-left',4,0,'vouchers.php',NULL,'PAS'),(null,'rightsocial','','column-left',5,0,'vouchers.php',NULL,'PAS'),(null,'rightnews','','column-left',6,0,'vouchers.php',NULL,'PAS'),(null,'testimonials','','column-left',7,0,'vouchers.php',NULL,'PAS'),(null,'bidpackage','','column-left',8,0,'vouchers.php',NULL,'PAS'),(null,'lastwinner','','column-left',9,0,'vouchers.php',NULL,'PAS'),(null,'user_menu','','column-left',0,0,'vouchers.php',NULL,'PAS'),(null,'advertisebannerwide','','column-left',2,0,'unsubscribeuser.php',NULL,'PAS'),(null,'advertisebannernarrow','','column-left',3,0,'unsubscribeuser.php',NULL,'PAS'),(null,'advertising','','column-left',4,0,'unsubscribeuser.php',NULL,'PAS'),(null,'rightsocial','','column-left',5,0,'unsubscribeuser.php',NULL,'PAS'),(null,'rightnews','','column-left',6,0,'unsubscribeuser.php',NULL,'PAS'),(null,'testimonials','','column-left',7,0,'unsubscribeuser.php',NULL,'PAS'),(null,'bidpackage','','column-left',8,0,'unsubscribeuser.php',NULL,'PAS'),(null,'lastwinner','','column-left',9,0,'unsubscribeuser.php',NULL,'PAS'),(null,'user_menu','','column-left',0,0,'unsubscribeuser.php',NULL,'PAS'),(null,'advertisebannerwide','','column-left',2,0,'terms.php',NULL,'PAS'),(null,'advertisebannernarrow','','column-left',3,0,'terms.php',NULL,'PAS'),(null,'advertising','','column-left',4,0,'terms.php',NULL,'PAS'),(null,'rightsocial','','column-left',5,0,'terms.php',NULL,'PAS'),(null,'rightnews','','column-left',6,0,'terms.php',NULL,'PAS'),(null,'testimonials','','column-left',7,0,'terms.php',NULL,'PAS'),(null,'bidpackage','','column-left',8,0,'terms.php',NULL,'PAS'),(null,'lastwinner','','column-left',9,0,'terms.php',NULL,'PAS'),(null,'help_menu','','column-left',1,0,'terms.php',NULL,'PAS'),(null,'advertisebannerwide','','column-left',2,0,'privacy.php',NULL,'PAS'),(null,'advertisebannernarrow','','column-left',3,0,'privacy.php',NULL,'PAS'),(null,'advertising','','column-left',4,0,'privacy.php',NULL,'PAS'),(null,'rightsocial','','column-left',5,0,'privacy.php',NULL,'PAS'),(null,'rightnews','','column-left',6,0,'privacy.php',NULL,'PAS'),(null,'testimonials','','column-left',7,0,'privacy.php',NULL,'PAS'),(null,'bidpackage','','column-left',8,0,'privacy.php',NULL,'PAS'),(null,'lastwinner','','column-left',9,0,'privacy.php',NULL,'PAS'),(null,'help_menu','','column-left',1,0,'privacy.php',NULL,'PAS'),(null,'advertisebannerwide','','column-left',2,0,'payment_unsuccess.php',NULL,'PAS'),(null,'advertisebannernarrow','','column-left',3,0,'payment_unsuccess.php',NULL,'PAS'),(null,'advertising','','column-left',4,0,'payment_
unsuccess.php',NULL,'PAS'),(null,'rightsocial','','column-
left',5,0,'payment_unsuccess.php',NULL,'PAS'),(null,'rightnews','','column-left',6,0,'payment_unsuccess.php',NULL,'PAS'),(null,'testimonials','','column-left',7,0,'payment_unsuccess.php',NULL,'PAS'),(null,'bidpackage','','column-left',8,0,'payment_unsuccess.php',NULL,'PAS'),(null,'lastwinner','','column-left',9,0,'payment_unsuccess.php',NULL,'PAS'),(null,'user_menu','','column-left',0,0,'payment_unsuccess.php',NULL,'PAS'),(null,'user_menu','','column-left',0,0,'payment_success.php',NULL,'PAS'),(null,'advertisebannerwide','','column-left',1,0,'payment_success.php',NULL,'PAS'),(null,'advertisebannernarrow','','column-left',1,0,'payment_success.php',NULL,'PAS'),(null,'advertising','','column-left',1,0,'payment_success.php',NULL,'PAS'),(null,'rightsocial','','column-left',1,0,'payment_success.php',NULL,'PAS'),(null,'rightnews','','column-left',1,0,'payment_success.php',NULL,'PAS'),(null,'testimonials','','column-left',1,0,'payment_success.php',NULL,'PAS'),(null,'bidpackage','','column-left',1,0,'payment_success.php',NULL,'PAS'),(null,'lastwinner','','column-left',1,0,'payment_success.php',NULL,'PAS'),(null,'user_menu','','column-left',0,0,'jobs.php',NULL,'PAS'),(null,'advertisebannerwide','','column-left',1,0,'jobs.php',NULL,'PAS'),(null,'advertisebannernarrow','','column-left',1,0,'jobs.php',NULL,'PAS'),(null,'advertising','','column-left',1,0,'jobs.php',NULL,'PAS'),(null,'rightsocial','','column-left',1,0,'jobs.php',NULL,'PAS'),(null,'rightnews','','column-left',1,0,'jobs.php',NULL,'PAS'),(null,'testimonials','','column-left',1,0,'jobs.php',NULL,'PAS'),(null,'bidpackage','','column-left',1,0,'jobs.php',NULL,'PAS'),(null,'lastwinner','','column-left',1,0,'jobs.php',NULL,'PAS'),(null,'user_menu','','column-left',0,0,'inviter.php',NULL,'PAS'),(null,'advertisebannerwide','','column-left',1,0,'inviter.php',NULL,'PAS'),(null,'advertisebannernarrow','','column-left',1,0,'inviter.php',NULL,'PAS'),(null,'advertising','','column-left',1,0,'inviter.php',NULL,'PAS'),(null,'rightsocial','','column-left',1,0,'inviter.php',NULL,'PAS'),(null,'rightnews','','column-left',1,0,'inviter.php',NULL,'PAS'),(null,'testimonials','','column-left',1,0,'inviter.php',NULL,'PAS'),(null,'bidpackage','','column-left',1,0,'inviter.php',NULL,'PAS'),(null,'lastwinner','','column-left',1,0,'inviter.php',NULL,'PAS'),(null,'user_menu','','column-left',0,0,'inviterwrapper.php',NULL,'PAS'),(null,'advertisebannerwide','','column-left',1,0,'inviterwrapper.php',NULL,'PAS'),(null,'advertisebannernarrow','','column-left',1,0,'inviterwrapper.php',NULL,'PAS'),(null,'advertising','','column-left',1,0,'inviterwrapper.php',NULL,'PAS'),(null,'rightsocial','','column-left',1,0,'inviterwrapper.php',NULL,'PAS'),(null,'rightnews','','column-left',1,0,'inviterwrapper.php',NULL,'PAS'),(null,'testimonials','','column-left',1,0,'inviterwrapper.php',NULL,'PAS'),(null,'bidpackage','','column-left',1,0,'inviterwrapper.php',NULL,'PAS'),(null,'lastwinner','','column-left',1,0,'inviterwrapper.php',NULL,'PAS'),(null,'faq_menu','','column-left',1,0,'help.php',NULL,'PAS'),(null,'advertisebannerwide','','column-left',1,0,'help.php',NULL,'PAS'),(null,'advertisebannernarrow','','column-left',1,0,'help.php',NULL,'PAS'),(null,'advertising','','column-left',1,0,'help.php',NULL,'PAS'),(null,'rightsocial','','column-left',1,0,'help.php',NULL,'PAS'),(null,'rightnews','','column-left',1,0,'help.php',NULL,'PAS'),(null,'testimonials','','column-left',1,0,'help.php',NULL,'PAS'),(null,'bidpackage','','column-left',1,0,'help.php',NULL,'PAS'),(null,'lastwinner','','column-left',1,0,'help.php',NULL,'PAS'),(null,'user_menu','','column-left',0,0,'forgotpassword.php',NULL,'PAS'),(null,'advertisebannerwide','','column-left',1,0,'forgotpassword.php',NULL,'PAS'),(null,'advertisebannernarrow','','column-left',1,0,'forgotpassword.php',NULL,'PAS'),(null,'advertising','','column-left',1,0,'forgotpassword.php',NULL,'PAS'),(null,'rightsocial','','column-left',1,0,'forgotpassword.php',NULL,'PAS'),(null,'rightnews','','column-left',1,0,'forgotpassword.php',NULL,'PAS'),(null,'testimonials','','column-left',1,0,'
forgotpassword.php',NULL,'PAS'),(null,'bidpackage','','column-left'
,1,0,'forgotpassword.php',NULL,'PAS'),(null,'lastwinner','','column-left',1,0,'forgotpassword.php',NULL,'PAS'),(null,'user_menu','','column-left',0,0,'feedback.php',NULL,'PAS'),(null,'advertisebannerwide','','column-left',1,0,'feedback.php',NULL,'PAS'),(null,'advertisebannernarrow','','column-left',1,0,'feedback.php',NULL,'PAS'),(null,'advertising','','column-left',1,0,'feedback.php',NULL,'PAS'),(null,'rightsocial','','column-left',1,0,'feedback.php',NULL,'PAS'),(null,'rightnews','','column-left',1,0,'feedback.php',NULL,'PAS'),(null,'testimonials','','column-left',1,0,'feedback.php',NULL,'PAS'),(null,'bidpackage','','column-left',1,0,'feedback.php',NULL,'PAS'),(null,'lastwinner','','column-left',1,0,'feedback.php',NULL,'PAS'),(null,'user_menu','','column-left',0,0,'emailconfirmsuccess.php',NULL,'PAS'),(null,'advertisebannerwide','','column-left',1,0,'emailconfirmsuccess.php',NULL,'PAS'),(null,'advertisebannernarrow','','column-left',1,0,'emailconfirmsuccess.php',NULL,'PAS'),(null,'advertising','','column-left',1,0,'emailconfirmsuccess.php',NULL,'PAS'),(null,'rightsocial','','column-left',1,0,'emailconfirmsuccess.php',NULL,'PAS'),(null,'rightnews','','column-left',1,0,'emailconfirmsuccess.php',NULL,'PAS'),(null,'testimonials','','column-left',1,0,'emailconfirmsuccess.php',NULL,'PAS'),(null,'bidpackage','','column-left',1,0,'emailconfirmsuccess.php',NULL,'PAS'),(null,'lastwinner','','column-left',1,0,'emailconfirmsuccess.php',NULL,'PAS'),(null,'user_menu','','column-left',0,0,'editpassword.php',NULL,'PAS'),(null,'advertisebannerwide','','column-left',1,0,'editpassword.php',NULL,'PAS'),(null,'advertisebannernarrow','','column-left',1,0,'editpassword.php',NULL,'PAS'),(null,'advertising','','column-left',1,0,'editpassword.php',NULL,'PAS'),(null,'rightsocial','','column-left',1,0,'editpassword.php',NULL,'PAS'),(null,'rightnews','','column-left',1,0,'editpassword.php',NULL,'PAS'),(null,'testimonials','','column-left',1,0,'editpassword.php',NULL,'PAS'),(null,'bidpackage','','column-left',1,0,'editpassword.php',NULL,'PAS'),(null,'lastwinner','','column-left',1,0,'editpassword.php',NULL,'PAS'),(null,'user_menu','','column-left',0,0,'coupon.php',NULL,'PAS'),(null,'advertisebannerwide','','column-left',1,0,'coupon.php',NULL,'PAS'),(null,'advertisebannernarrow','','column-left',1,0,'coupon.php',NULL,'PAS'),(null,'advertising','','column-left',1,0,'coupon.php',NULL,'PAS'),(null,'rightsocial','','column-left',1,0,'coupon.php',NULL,'PAS'),(null,'rightnews','','column-left',1,0,'coupon.php',NULL,'PAS'),(null,'testimonials','','column-left',1,0,'coupon.php',NULL,'PAS'),(null,'bidpackage','','column-left',1,0,'coupon.php',NULL,'PAS'),(null,'lastwinner','','column-left',1,0,'coupon.php',NULL,'PAS'),(null,'user_menu','','column-left',0,0,'couponhistory.php',NULL,'PAS'),(null,'advertisebannerwide','','column-left',1,0,'couponhistory.php',NULL,'PAS'),(null,'advertisebannernarrow','','column-left',1,0,'couponhistory.php',NULL,'PAS'),(null,'advertising','','column-left',1,0,'couponhistory.php',NULL,'PAS'),(null,'rightsocial','','column-left',1,0,'couponhistory.php',NULL,'PAS'),(null,'rightnews','','column-left',1,0,'couponhistory.php',NULL,'PAS'),(null,'testimonials','','column-left',1,0,'couponhistory.php',NULL,'PAS'),(null,'bidpackage','','column-left',1,0,'couponhistory.php',NULL,'PAS'),(null,'lastwinner','','column-left',1,0,'couponhistory.php',NULL,'PAS'),(null,'user_menu','','column-left',0,0,'contact.php',NULL,'PAS'),(null,'advertisebannerwide','','column-left',3,0,'contact.php',NULL,'PAS'),(null,'advertisebannernarrow','','column-left',4,0,'contact.php',NULL,'PAS'),(null,'advertising','','column-left',5,0,'contact.php',NULL,'PAS'),(null,'rightsocial','','column-left',6,0,'contact.php',NULL,'PAS'),(null,'rightnews','','column-left',7,0,'contact.php',NULL,'PAS'),(null,'testimonials','','column-left',8,0,'contact.php',NULL,'PAS'),(null,'bidpackage','','column-left',9,0,'contact.php',NULL,'PAS'),(null,'lastwinner','','column-left',10,0,'contact.php',NULL,'PAS'),(null,'help_menu','','column-left',1,0,'contact.php',NULL,'PAS'),(null,'user_
menu','','column-left',0,0,'community.php',NULL,'PAS'),(null,'
advertisebannerwide','','column-left',1,0,'community.php',NULL,'PAS'),(null,'advertisebannernarrow','','column-left',1,0,'community.php',NULL,'PAS'),(null,'advertising','','column-left',1,0,'community.php',NULL,'PAS'),(null,'rightsocial','','column-left',1,0,'community.php',NULL,'PAS'),(null,'rightnews','','column-left',1,0,'community.php',NULL,'PAS'),(null,'testimonials','','column-left',1,0,'community.php',NULL,'PAS'),(null,'bidpackage','','column-left',1,0,'community.php',NULL,'PAS'),(null,'lastwinner','','column-left',1,0,'community.php',NULL,'PAS'),(null,'user_menu','','column-left',0,0,'comment.php',NULL,'PAS'),(null,'help_menu','','column-left',1,0,'comment.php',NULL,'PAS'),(null,'faq_menu','','column-left',1,0,'comment.php',NULL,'PAS'),(null,'advertisebannerwide','','column-left',1,0,'comment.php',NULL,'PAS'),(null,'advertisebannernarrow','','column-left',1,0,'comment.php',NULL,'PAS'),(null,'advertising','','column-left',1,0,'comment.php',NULL,'PAS'),(null,'rightsocial','','column-left',1,0,'comment.php',NULL,'PAS'),(null,'rightnews','','column-left',1,0,'comment.php',NULL,'PAS'),(null,'testimonials','','column-left',1,0,'comment.php',NULL,'PAS'),(null,'bidpackage','','column-left',1,0,'comment.php',NULL,'PAS'),(null,'lastwinner','','column-left',1,0,'comment.php',NULL,'PAS'),(null,'user_menu','','column-left',0,0,'choosevoucher.php',NULL,'PAS'),(null,'help_menu','','column-left',1,0,'choosevoucher.php',NULL,'PAS'),(null,'faq_menu','','column-left',1,0,'choosevoucher.php',NULL,'PAS'),(null,'advertisebannerwide','','column-left',1,0,'choosevoucher.php',NULL,'PAS'),(null,'advertisebannernarrow','','column-left',1,0,'choosevoucher.php',NULL,'PAS'),(null,'advertising','','column-left',1,0,'choosevoucher.php',NULL,'PAS'),(null,'rightsocial','','column-left',1,0,'choosevoucher.php',NULL,'PAS'),(null,'rightnews','','column-left',1,0,'choosevoucher.php',NULL,'PAS'),(null,'testimonials','','column-left',1,0,'choosevoucher.php',NULL,'PAS'),(null,'bidpackage','','column-left',1,0,'choosevoucher.php',NULL,'PAS'),(null,'lastwinner','','column-left',1,0,'choosevoucher.php',NULL,'PAS'),(null,'user_menu','','column-left',0,0,'buyitnow.php',NULL,'PAS'),(null,'help_menu','','column-left',1,0,'buyitnow.php',NULL,'PAS'),(null,'faq_menu','','column-left',1,0,'buyitnow.php',NULL,'PAS'),(null,'advertisebannerwide','','column-left',1,0,'buyitnow.php',NULL,'PAS'),(null,'advertisebannernarrow','','column-left',1,0,'buyitnow.php',NULL,'PAS'),(null,'advertising','','column-left',1,0,'buyitnow.php',NULL,'PAS'),(null,'rightsocial','','column-left',1,0,'buyitnow.php',NULL,'PAS'),(null,'rightnews','','column-left',1,0,'buyitnow.php',NULL,'PAS'),(null,'testimonials','','column-left',1,0,'buyitnow.php',NULL,'PAS'),(null,'bidpackage','','column-left',1,0,'buyitnow.php',NULL,'PAS'),(null,'lastwinner','','column-left',1,0,'buyitnow.php',NULL,'PAS'),(null,'user_menu','','column-left',0,0,'buybids.php',NULL,'PAS'),(null,'help_menu','','column-left',1,0,'buybids.php',NULL,'PAS'),(null,'faq_menu','','column-left',1,0,'buybids.php',NULL,'PAS'),(null,'advertisebannerwide','','column-left',1,0,'buybids.php',NULL,'PAS'),(null,'advertisebannernarrow','','column-left',1,0,'buybids.php',NULL,'PAS'),(null,'advertising','','column-left',1,0,'buybids.php',NULL,'PAS'),(null,'rightsocial','','column-left',1,0,'buybids.php',NULL,'PAS'),(null,'rightnews','','column-left',1,0,'buybids.php',NULL,'PAS'),(null,'testimonials','','column-left',1,0,'buybids.php',NULL,'PAS'),(null,'bidpackage','','column-left',1,0,'buybids.php',NULL,'PAS'),(null,'lastwinner','','column-left',1,0,'buybids.php',NULL,'PAS'),(null,'user_menu','','column-left',0,0,'bidhistory.php',NULL,'PAS'),(null,'help_menu','','column-left',11,0,'bidhistory.php',NULL,'PAS'),(null,'faq_menu','','column-left',12,0,'bidhistory.php',NULL,'PAS'),(null,'advertisebannerwide','','column-left',13,0,'bidhistory.php',NULL,'PAS'),(null,'advertisebannernarrow','','column-left',14,0,'bidhistory.php',NULL,'PAS'),(null,'advertising','','column-left',15,0,'bidhistory.php',NULL,'PAS'),(null,'rightsocial','','column-left',16,0,'
bidhistory.php',NULL,'PAS'),(null,'rightnews','','column-left',17,0,'bidhistory.php',NULL,'PAS'),(null,'testimonials','','column-left',18,0,'bidhistory.php',NULL,'PAS'),(null,'bidpackage','','column-left',19,0,'bidhistory.php',NULL,'PAS'),(null,'lastwinner','','column-left',20,0,'bidhistory.php',NULL,'PAS'),(null,'user_menu','','column-left',0,0,'affiliate.php',NULL,'PAS'),(null,'help_menu','','column-left',1,0,'affiliate.php',NULL,'PAS'),(null,'faq_menu','','column-left',1,0,'affiliate.php',NULL,'PAS'),(null,'advertisebannerwide','','column-left',1,0,'affiliate.php',NULL,'PAS'),(null,'advertisebannernarrow','','column-left',1,0,'affiliate.php',NULL,'PAS'),(null,'advertising','','column-left',1,0,'affiliate.php',NULL,'PAS'),(null,'rightsocial','','column-left',1,0,'affiliate.php',NULL,'PAS'),(null,'rightnews','','column-left',1,0,'affiliate.php',NULL,'PAS'),(null,'testimonials','','column-left',1,0,'affiliate.php',NULL,'PAS'),(null,'bidpackage','','column-left',1,0,'affiliate.php',NULL,'PAS'),(null,'lastwinner','','column-left',1,0,'affiliate.php',NULL,'PAS'),(null,'user_menu','','column-left',0,0,'aboutus.php',NULL,'PAS'),(null,'help_menu','','column-left',1,0,'aboutus.php',NULL,'PAS'),(null,'faq_menu','','column-left',3,0,'aboutus.php',NULL,'PAS'),(null,'advertisebannerwide','','column-left',4,0,'aboutus.php',NULL,'PAS'),(null,'advertisebannernarrow','','column-left',5,0,'aboutus.php',NULL,'PAS'),(null,'advertising','','column-left',6,0,'aboutus.php',NULL,'PAS'),(null,'rightsocial','','column-left',7,0,'aboutus.php',NULL,'PAS'),(null,'rightnews','','column-left',8,0,'aboutus.php',NULL,'PAS'),(null,'testimonials','','column-left',9,0,'aboutus.php',NULL,'PAS'),(null,'bidpackage','','column-left',10,0,'aboutus.php',NULL,'PAS'),(null,'lastwinner','','column-left',11,0,'aboutus.php',NULL,'PAS'),(null,'column-left','','container',1,0,'*',NULL,'PAS'),(null,'column-right','','container',1,0,'*',NULL,'PAS'),(null,'steps_box','','column-left',11,0,'index.php',NULL,'PAS'),(null,'slider','','column-left',5,0,'index.php',NULL,'PAS'),(null,'auction_boxes','','column-left',23,0,'index.php',NULL,'PAS'),(null,'Auction Boxes','admin','design_menu',3,0,NULL,NULL,'PAS'),(null,'auction_boxes','','container',1,0,'viewproduct.php',1,'PAS'),(null,'auction_boxes','','container',1,0,'viewproduct_lowest.php',1,'PAS'),(null,'Main Slider','admin','design_menu',4,0,'',0,'PAS');

-- NEXT_QUERY --

INSERT INTO `sitesetting` (`id`, `name`, `value`, `license_key`, `status`, `license`) VALUES
(null, 'version', 'category_menu:6.5.1', NULL, 0, NULL),
(null, 'version', 'coupon_side_menu:6.5.1', NULL, 0, NULL),
(null, 'version', 'last_winner:6.5.1', NULL, 0, NULL),
(null, 'version', 'latest_news:6.5.1', NULL, 0, NULL),
(null, 'version', 'right_social:6.5.1', NULL, 0, NULL),
(null, 'version', 'search_box:6.5.1', NULL, 0, NULL),
(null, 'version', 'maps:6.5.1', NULL, 0, NULL),
(null, 'version', 'forum:6.5.1', NULL, 0, NULL),
(null, 'version', 'user_menu:6.5.1', NULL, 0, NULL),
(null, 'version', 'help_menu:6.5.1', NULL, 0, NULL),
(null, 'version', 'faq_menu:6.5.1', NULL, 0, NULL),
(null, 'version', 'auction_descriptions:6.5.1', NULL, 0, NULL),
(null, 'version', 'auction_boxes:6.5.1', NULL, 0, NULL),
(null, 'version', 'banner:6.5.1', NULL, 0, NULL),
(null, 'version', 'slider:6.5.1', NULL, 0, NULL),
(null, 'version', 'top_auctions:6.5.1', NULL, 0, NULL),
(null, 'addons', 'top_bar', '', 1, NULL),
(null, 'version', 'top_bar:6.5.1', NULL, 0, NULL),
(null, 'addons', 'forum', '', 1, NULL),
(null, 'slider_settings', 'effect:''fade''', NULL, 0, NULL),
(null, 'slider_settings', 'color:blue', NULL, 0, NULL),
(null, 'slider_settings', 'controls:boxes', NULL, 0, NULL),
(null, 'slider_settings', 'links:boxes', NULL, 0, NULL),
(null, 'slider_settings', 'changeSpeed:1200', NULL, 0, NULL),
(null, 'slider_settings', 'buttonset:red', NULL, 0, NULL),
(null, 'slider_settings', 'changeSpeed:1200', NULL, 0, NULL),
(null, 'slider_settings', 'links:boxes', NULL, 0, NULL),
(null, 'slider_settings', 'slider_id:', NULL, 0, NULL),
(null, 'slider_settings', 'buttonset:gray', NULL, 0, NULL),
(null, 'slider_settings', 'changeSpeed:1200', NULL, 0, NULL),
(null, 'slider_settings', 'links:bullets', NULL, 0, NULL),
(null, 'slider_settings', 'buttonset:green', NULL, 0, NULL),
(null, 'slider_settings', 'changeSpeed:1200', NULL, 0, NULL),
(null, 'slider_settings', 'links:bullets', NULL, 0, NULL),
(null, 'slider_settings', 'buttonset:purple', NULL, 0, NULL),
(null, 'slider_settings', 'changeSpeed:1200', NULL, 0, NULL),
(null, 'slider_settings', 'links:bullets', NULL, 0, NULL),
(null, 'slider_settings', 'buttonset:yellow', NULL, 0, NULL),
(null, 'slider_settings', 'buttonset:transparent', NULL, 0, NULL),
(null, 'slider_settings', 'changeSpeed:1200', NULL, 0, NULL),
(null, 'slider_settings', 'links:bullets', NULL, 0, NULL),
(null, 'slider_settings', 'buttonset:transparent', NULL, 0, NULL),
(null, 'slider_settings', 'changeSpeed:1200', NULL, 0, NULL);

-- NEXT_QUERY --

INSERT INTO `sitesetting` (`id`, `name`, `value`, `license_key`, `status`, `license`) VALUES
(null, 'slider_settings', 'links:bullets', NULL, 0, NULL),
(null, 'version', 'steps_bid:6.5.1', NULL, 0, NULL),
(null, 'slider_settings', 'changeSpeed:1200', NULL, 0, NULL),
(null, 'slider_settings', 'links:false', NULL, 0, NULL),
(null, 'reservetext_limit', '5', '', 0, ''),
(null, 'reservetext_limit', '5', '', 0, ''),
(null, 'fireworks', '1', NULL, 0, NULL),
(null, 'gavel', '1', NULL, 0, NULL),
(null, 'version', 'user_levels:6.5.1', NULL, 0, NULL),
(null, 'addons', 'similar', '', 1, 'free'),
(null, 'version', 'similar:6.5.1', NULL, 0, NULL),
(null, 'version', 'games:6.5.1', NULL, 0, NULL),
(null, 'master_game_settings:which_to_use', 'free_', NULL, 0, NULL),
(null, 'master_game_settings:allow_user_bid_price', '', NULL, 0, NULL),
(null, 'master_game_settings:price_per_bid', '10', NULL, 0, NULL),
(null, 'games:slots:cherry', '3:3', NULL, 0, NULL),
(null, 'games:slots:cherry', '2:2', NULL, 0, NULL),
(null, 'games:slots:cherry', '1:0', NULL, 0, NULL),
(null, 'games:slots:seven', '1:0', NULL, 0, NULL),
(null, 'games:slots:seven', '3:2', NULL, 0, NULL),
(null, 'games:slots:seven', '2:1', NULL, 0, NULL),
(null, 'games:slots:orange', '1:0', NULL, 0, NULL),
(null, 'games:slots:orange', '3:1', NULL, 0, NULL),
(null, 'games:slots:orange', '2:0', NULL, 0, NULL),
(null, 'games:slots:grape', '1:0', NULL, 0, NULL),
(null, 'games:slots:grape', '2:0', NULL, 0, NULL),
(null, 'games:slots:grape', '3:1', NULL, 0, NULL),
(null, 'games:slots:bar', '1:0', NULL, 0, NULL),
(null, 'games:slots:bar', '2:0', NULL, 0, NULL),
(null, 'games:slots:bar', '3:1', NULL, 0, NULL),
(null, 'games:slots:lemon', '1:0', NULL, 0, NULL),
(null, 'games:slots:lemon', '2:0', NULL, 0, NULL),
(null, 'games:slots:lemon', '3:1', NULL, 0, NULL),
(null, 'games:slots:bell', '1:0', NULL, 0, NULL),
(null, 'games:slots:bell', '2:0', NULL, 0, NULL),
(null, 'games:slots:bell', '3:1', NULL, 0, NULL),
(null, 'games:slots:watermelon', '1:0', NULL, 0, NULL),
(null, 'games:slots:watermelon', '2:0', NULL, 0, NULL),
(null, 'games:slots:watermelon', '3:1', NULL, 0, NULL),
(null, 'games:slots:orange', '1:0', NULL, 0, NULL),
(null, 'games:slots:orange', '3:1', NULL, 0, NULL),
(null, 'games:slots:orange', '2:0', NULL, 0, NULL),
(null, 'games:slots:grape', '1:0', NULL, 0, NULL),
(null, 'games:slots:grape', '2:0', NULL, 0, NULL);

-- NEXT_QUERY --

INSERT INTO `sitesetting` (`id`, `name`, `value`, `license_key`, `status`, `license`) VALUES
(null, 'games:slots:grape', '3:1', NULL, 0, NULL),
(null, 'games:slots:bar', '1:0', NULL, 0, NULL),
(null, 'games:slots:bar', '2:0', NULL, 0, NULL),
(null, 'games:slots:bar', '3:1', NULL, 0, NULL),
(null, 'games:slots:lemon', '1:0', NULL, 0, NULL),
(null, 'games:slots:lemon', '2:0', NULL, 0, NULL),
(null, 'games:slots:lemon', '3:1', NULL, 0, NULL),
(null, 'games:slots:bell', '1:0', NULL, 0, NULL),
(null, 'games:slots:bell', '2:0', NULL, 0, NULL),
(null, 'games:slots:bell', '3:1', NULL, 0, NULL),
(null, 'games:slots:watermelon', '1:0', NULL, 0, NULL),
(null, 'games:slots:watermelon', '2:0', NULL, 0, NULL),
(null, 'games:slots:watermelon', '3:1', NULL, 0, NULL),
(null, 'games:slots:orange', '1:0', NULL, 0, NULL),
(null, 'games:slots:orange', '3:1', NULL, 0, NULL),
(null, 'games:slots:orange', '2:0', NULL, 0, NULL),
(null, 'games:slots:grape', '1:0', NULL, 0, NULL),
(null, 'games:slots:grape', '2:0', NULL, 0, NULL),
(null, 'games:slots:grape', '3:1', NULL, 0, NULL),
(null, 'games:slots:bar', '1:0', NULL, 0, NULL),
(null, 'games:slots:bar', '2:0', NULL, 0, NULL),
(null, 'games:slots:bar', '3:1', NULL, 0, NULL),
(null, 'games:slots:lemon', '1:0', NULL, 0, NULL),
(null, 'games:slots:lemon', '2:0', NULL, 0, NULL),
(null, 'games:slots:lemon', '3:1', NULL, 0, NULL),
(null, 'games:slots:bell', '1:0', NULL, 0, NULL),
(null, 'games:slots:bell', '2:0', NULL, 0, NULL),
(null, 'games:slots:bell', '3:1', NULL, 0, NULL),
(null, 'games:slots:watermelon', '1:0', NULL, 0, NULL),
(null, 'games:slots:watermelon', '2:0', NULL, 0, NULL),
(null, 'games:slots:watermelon', '3:1', NULL, 0, NULL),
(null, 'reserve_icon', '1', NULL, 0, NULL),
(null, 'price_color', '', NULL, 0, NULL),
(null, 'aggregate', '1', NULL, 0, NULL),
(null, 'aggregate', '1', NULL, 0, NULL),
(null, 'sold_color', '', NULL, 0, NULL),
(null, 'games', 'connect4', NULL, 0, NULL),
(null, 'master_game_settings:give_bids_back_on_win', '0', NULL, 0, NULL),
(null, 'master_game_settings:which_to_pay_out', '', NULL, 0, NULL),
(null, 'forum', '0', NULL, 0, NULL),
(null, 'addons', 'user_levels', '', 0, NULL);

-- NEXT_QUERY --

INSERT INTO `sitesetting` values(null, 'price_color', 'black', '', '', ''), 
(null,  'sold_color', 'red', '', '', ''),
(null,  'color', 'black', '', '', '');

-- NEXT_QUERY --

INSERT INTO `static_pages` VALUES
(null, 'terms', '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;Terms of Use</p>\r \r <p>&nbsp;</p>\r \r <p>The effective date is congruent with the time the purchase is made via the web cart found at <a href="http://www.pennyauctionsoft.com/">www.pennyauctionsoft.com</a> and include all features and service based on the actual plan purchased within that cart. The buyer agrees to all of the following terms.</p>\r \r <p>1.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Definitions</p>\r \r <p style="margin-left:.75in;">a.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Diy- Stand for do it yourself. Any package purchased with this in the title will be required to install and design their website completely on their own. Support will be limited to the predesigned and included installation cd and predesigned help modules</p>\r \r <p style="margin-left:.75in;">b.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Support- communication with one of&nbsp; <a href="http://www.pennyauctionsoft.com/">www.pennyauctionsoft.com</a>&nbsp; team via chat or email</p>\r \r <p style="margin-left:.75in;">c.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Pro-or professional - your software will come with an unlimited license and support.</p>\r \r <p style="margin-left:.75in;">d.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Unlimited lisence- the abilty for one user to install our software on an unlimited amount of domains owned directly by the purchaser/buyer. All additional domains will be verified by a <a href="http://www.pennyauctionsoft.com/">www.pennyauctionsoft.com</a> representative prior to the issuance of a new license. The buyer may not under any circumstances resell lease or otherwise make available the software and or code and or script without the acknowledge consent of <a href="http://www.pennyauctionsoft.com/">www.pennyauctionsoft.com</a> .</p>\r \r <p style="margin-left:.75in;">e.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; License- the ability to use our software on one domain.</p>\r \r <p style="margin-left:.75in;">f.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Standard- a version that does not come with support and is limited to one license.</p>\r \r <p style="margin-left:.75in;">g.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Programming -any work preformed that requires a change in the software, additional modules, changes in the admin side of the site, css coding , adding functions not included in the site, adding payment gateways not included in the site</p>\r \r <p style="margin-left:.75in;">h.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Enhanced- includes design</p>\r \r <p style="margin-left:.75in;">i.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Encrypted- all of the software is locked and cannot be edited.</p>\r \r <p style="margin-left:.75in;">j.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Unencrypted- the functioning portion of the software is open to see and to develop. However the license panel and the ability to add additional domains remains encrypted and cannot be changed or seen.</p>\r \r <p style="margin-left:.75in;">k.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Installation- <a href="http://www.pennyauctionsoft.com/">www.pennyauctionsoft.com</a> will transfer your chosen software on an approved server or our own pas server. (server must meet software requirements) ask support for details. When installation is included it is based on installing the software 1 time and 1 time only. Additional installs will be billed accordingly.</p>\r \r <p>2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="http://www.pennyauctionsoft.com/">www.pennyauctionsoft.com</a> will supply support in the following manner if it is so called for based on the package that has been purchased.</p>\r \r <p style="margin-left:168.75pt;">&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Covered by Support</strong>:<br />\r <br />\r Our support will cover common software related issues such as:</p>\r \r <p style="margin-left:191.25pt;">o&nbsp;&
nbsp;&
nbsp; updating product versions</p>\r \r <p style="margin-left:191.25pt;">o&nbsp;&nbsp;&nbsp; Feature questions</p>\r \r <p style="margin-left:191.25pt;">o&nbsp;&nbsp;&nbsp; Basic setup questions</p>\r \r <p style="margin-left:191.25pt;">o&nbsp;&nbsp;&nbsp; Software errors</p>\r \r <p style="margin-left:191.25pt;">o&nbsp;&nbsp;&nbsp; One time instructional on setting up an auction.</p>\r \r <p style="margin-left:191.25pt;">o&nbsp;&nbsp;&nbsp; If you purchase a Standard CD package without buying our support package you will not receive any support what-so-ever</p>\r \r <p style="margin-left:168.75pt;">&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Not Covered by Support:</strong>:<br />\r <br />\r Our support coverage does not cover:</p>\r \r <p style="margin-left:191.25pt;">o&nbsp;&nbsp;&nbsp; Older product versions</p>\r \r <p style="margin-left:191.25pt;">o&nbsp;&nbsp;&nbsp; Assistance or Creation of any sort of modification done to the package which includes editing the PHP core source code, CSS, Images and HTML layout.</p>\r \r <p style="margin-left:191.25pt;">o&nbsp;&nbsp;&nbsp; Server related issues including improper hosting configuration</p>\r \r <p style="margin-left:191.25pt;">o&nbsp;&nbsp;&nbsp; Browser or computer issues</p>\r \r <p style="margin-left:191.25pt;">o&nbsp;&nbsp;&nbsp; Non software related issues</p>\r \r <p style="margin-left:191.25pt;">o&nbsp;&nbsp;&nbsp; SSL Certificate installs</p>\r \r <p style="margin-left:191.25pt;">o&nbsp;&nbsp;&nbsp; 3rd party products or plug-ins</p>\r \r <p style="margin-left:191.25pt;">o&nbsp;&nbsp;&nbsp; Design work or modifications (these can be done as paid services)</p>\r \r <p style="margin-left:191.25pt;">o&nbsp;&nbsp;&nbsp; Second site installations or upgrades (these can be done but are paid)</p>\r \r <p style="margin-left:191.25pt;">o&nbsp;&nbsp;&nbsp; Custom modifications or template changes done by third parties void your support (we cannot support coding modifications done by third parties)</p>\r \r <p><br />\r <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Methods of Support:</strong></p>\r \r <p style="margin-left:168.75pt;">&nbsp;</p>\r \r <p style="margin-left:168.75pt;">&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Product Documentation</strong><br />\r <br />\r The manual should be your first stop for information. It is consistently updated by our support team and provides all the configuration and how-to steps you need in order to get your system up and running quickly.</p>\r \r <p style="margin-left:168.75pt;">&nbsp;</p>\r \r <p style="margin-left:168.75pt;">&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Helpdesk Product Support </strong><br />\r <br />\r The priority help desk is available to all clients with up-to-date membership accounts. The help desk should be used when you are unable to find answers to your questions using the Free Resources. All tickets are first reviewed by our dedicated 1st level support team. Tickets that require further assistance will be escalated to 2nd and 3rd level support depending on the type of issues.</p>\r \r <p style="margin-left:168.75pt;">&nbsp;</p>\r \r <p style="margin-left:168.75pt;">&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Phone Support</strong><br />\r We will provide a toll free number after purchase ( only offered with an enhanced version of the software or better)</p>\r \r <p style="margin-left:168.75pt;">&nbsp;</p>\r \r <p style="margin-left:168.75pt;">&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Supported Methods of Support</strong><br />\r Direct email support, Phone support, live chat (Our site) and IM.</p>\r \r <p style="margin-left:168.75pt;">&nbsp;</p>\r \r <p style="margin-left:168.75pt;">&middot;&nbsp;&nbsp;&nbsp;&
nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Reasons for not providing support</strong></p>\r \r <p style="margin-left:191.25pt;">o&nbsp;&nbsp;&nbsp; Support requested is for an unsupported area or non-script related area.</p>\r \r <p style="margin-left:191.25pt;">o&nbsp;&nbsp;&nbsp; Abuse of support representatives. We do not allow any abuse from clients to our support representatives in any way. If a situation occurs you will be given a reminder and then if the issue continues ticket options will be removed from your account.</p>\r \r <p style="margin-left:191.25pt;">o&nbsp;&nbsp;&nbsp; Invalid license or account.</p>\r \r <p style="margin-left:191.25pt;">o&nbsp;&nbsp;&nbsp; If you launch a Paypal dispute or chargeback your support will automatically be terminated.</p>\r \r <p style="margin-left:191.25pt;">o&nbsp;&nbsp;&nbsp; We are not responsible for any incompatible hosting and do not provide support for hosting and server configurations. It is your responsibility to secure hosting that is compatible with our script</p>\r \r <p style="margin-left:191.25pt;">o&nbsp;&nbsp;&nbsp; &nbsp;</p>\r \r <p style="margin-left:168.75pt;">&nbsp;</p>\r \r <p style="margin-left:168.75pt;">&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Procedure of Support</strong><br />\r <br />\r Listed below are methods taken by our Pennyauctionsoft Support Staff when an issue may arise and you need technical help to solve it.</p>\r \r <p style="margin-left:191.25pt;">o&nbsp;&nbsp;&nbsp; Check if server meets all the requirements found on requirements page.</p>\r \r <p style="margin-left:191.25pt;">o&nbsp;&nbsp;&nbsp; Do a check if any of the default files have been modified. If any of the files have been modified client must <strong>backup</strong> their site and upload the default script files.</p>\r \r <p style="margin-left:191.25pt;">o&nbsp;&nbsp;&nbsp; Do a check to make sure all the files/folders are in place and all permissions are set correctly to each of the folders.</p>\r \r <p style="margin-left:191.25pt;">o&nbsp;&nbsp;&nbsp; Compare issues(s) with our live demo found on demo page.</p>\r \r <p style="margin-left:191.25pt;">o&nbsp;&nbsp;&nbsp; Turn on PHP &quot;error reporting&quot;.</p>\r \r <p style="margin-left:168.75pt;"><br />\r If the above steps do not help solve the case for the client the case is then sent to the developers to look over and fix.</p>\r \r <p style="margin-left:168.75pt;">&nbsp;</p>\r \r <p style="margin-left:168.75pt;">&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Install / Upgrade Service Policy</strong></p>\r \r <p style="margin-left:191.25pt;">o&nbsp;&nbsp;&nbsp; &ldquo; Pro License&quot; owners get 12 months of support.</p>\r \r <p style="margin-left:191.25pt;">o&nbsp;&nbsp;&nbsp; &quot;Discounted License&quot; owners get support under the span of their validity.</p>\r \r <p style="margin-left:191.25pt;">o&nbsp;&nbsp;&nbsp; Client must have a valid license.</p>\r \r <p style="margin-left:191.25pt;">o&nbsp;&nbsp;&nbsp; Client must run the latest up to date version.</p>\r \r <p style="margin-left:191.25pt;">o&nbsp;&nbsp;&nbsp; Upgrades generally will lose all changes to the existing site. We will not save or preserve site changes or database entrees when requesting an upgrade.</p>\r \r <p style="margin-left:168.75pt;">&nbsp;</p>\r \r <p style="margin-left:168.75pt;">&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Support Period</strong><br />\r <br />\r We offer a service to install or upgrade your software package. This service includes only the install of our product and no other 3rd party software or plug-ins. This also does not include installing any of the software requirements on the server. It is the client&#39;s responsibility to have the proper server requirements and if they do not our support staff will contact them with what they are missing. We recommend you use our hosting as it is 100% compatible with our software.<br />\r <br />\r If an upgrade service is purchased our staff will only upgrade a 
client&#39;s site if it is fully functional and is using an older version of our scripts. Our technicians cannot upgrade a client&#39;s site if for example an attempt was already made by the client&#39;s side and it failed. Starting from an unknown point of the upgrade routine is unreliable and will only cause more instability in the future. For a proper professional upgrade we must work from A-Z to complete it. If such a case does come up the client will be asked to restore their site to its previous functional state and we can then perform the professional service.</p>\r \r <p style="margin-left:168.75pt;">&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; By purchasing our software you accept these above terms.</p>\r \r <p style="margin-left:168.75pt;">&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Professional versions purchased can have additional licenses added by contacting support.</p>\r \r <p style="margin-left:168.75pt;">&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Our licensing system will scan additional domain who is information and if it finds a non matching who is name information the license will automatically be disabled.</p>\r \r <p style="margin-left:168.75pt;">&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; In order to qualify for our free support services you agree that you will keep your website up to date, current patches applied. If your site is not current and up to date with PAS updates and patches your support is void.</p>\r \r <p>3.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; System requirements</p>\r \r <p style="margin-left:168.75pt;">&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>100MB</strong> Web-Space</p>\r \r <p style="margin-left:168.75pt;">&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Apache</strong> Web Server</p>\r \r <p style="margin-left:168.75pt;">&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>PHP 5</strong>.x +</p>\r \r <p style="margin-left:168.75pt;">&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>1 MySQL</strong> Database - MySQL 5.0 +</p>\r \r <p style="margin-left:168.75pt;">&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>GD2</strong>+, <strong>CURL</strong></p>\r \r <p style="margin-left:168.75pt;">&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>IonCube</strong></p>\r \r <p style="margin-left:168.75pt;">&middot;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Cpanel/WHM (Server)</strong></p>\r \r <p>4.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Licensing.</p>\r \r <p>&nbsp;</p>\r \r <p style="margin-left:1.0in;">a.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; The buyer will be provided with a license key that can be used for one domain name.</p>\r \r <p style="margin-left:1.0in;">b.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; In case the buyer buys a package that provides unlimited licenses each license will be approved by <a href="http://www.pennyauctionsoft.com/">www.pennyauctionsoft.com</a> , and must be registered and owned by the original buyer.</p>\r \r <p style="margin-left:1.0in;">c.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; To add additional licenses the buyer must contact <a href="http://www.pennyauctionsoft.com/">www.pennyauctionsoft.com</a> via phone or support, licenses are not automatically generated.</p>\r \r <p style="margin-left:1.0in;">d.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Any violation of the licensing agreement will result in immediate termination of all licenses owned by the buyer and a charge of $700.00 per occurrence. No refunds will be issued for the buyers original purchase.</p>\r \r <p style="margin-left:1.0in;">&nbsp;</p>\r \r <p>5.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Responsibilities of&nbsp; <a href="http://www.pennyauctionsoft.com/">www.pennyauctionsoft.com</a></p>\r \r <p style="margin-left:1.5in;">a.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Be knowledgeable of the software and possible problems</p>\r \r <p style="margin-left:1.5in;">b.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Identify errors with the software(pro version only)</p>\r \r <p style="
margin-left:1.5in;">c.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Provide timely support during and after the sale.( When include in a purchased package)</p>\r \r <p style="margin-left:1.5in;">d.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Provide a functioning software based on all other terms</p>\r \r <p style="margin-left:1.5in;">e.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Provide a license and download area where the software can be accessed</p>\r \r <p style="margin-left:1.5in;">f.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Provide a cd containing a complete version of the software.(pro versions only)</p>\r \r <p style="margin-left:1.5in;">g.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Provide free updates upon request and availability</p>\r \r <p style="margin-left:1.5in;">h.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Provide installation instructions.</p>\r \r <p>6.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Privacy</p>\r \r <p style="margin-left:1.5in;">a.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; We won&#39;t sell or give away your name, mail address, phone number, email address, credit card number or any other information to anyone.</p>\r \r <p style="margin-left:1.5in;">b.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; We&#39;ll use the latest security measures to protect your information from unauthorized users.</p>\r \r <p style="margin-left:1.5in;">c.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; We will ask you when we need information that personally identifies you (personal information) or allows us to contact you. Generally this information is requested when you purchase our software packages. We use your Personal Information for four primary purposes:<br />\r <br />\r * To process and activate your order<br />\r * To identify you<br />\r * To help us support you and/or your Business.<br />\r * To alert you to product upgrades, special offers, updated information and other new services from Pennyauctionsoft</p>\r \r <p style="margin-left:1.5in;">d.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Your information will never be sold to a third party.</p>\r \r <p style="margin-left:1.5in;">e.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="http://www.pennyauctionsoft.com/">www.pennyauctionsoft.com</a>&nbsp; may contact the buyer with offers, support , or additional product via email.</p>\r \r <p>7.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Installation</p>\r \r <p style="margin-left:.75in;"><strong>a.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong>Installations will be preformed in the order in which your order was received. In most cases installation will be completed within 24 hours of <a href="http://www.pennyauctionsoft.com/">www.pennyauctionsoft.com</a>&nbsp; receiving the following information that must be provided by the buyer. <strong>&ndash; </strong></p>\r \r <p style="margin-left:2.0in;">1.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>Root login/password and IP address for your server. The server must have Centos 5 installed and WHM/Cpanel as a hosting panel.</strong></p>\r \r <p style="margin-left:2.0in;"><strong>2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong><strong>&nbsp;Your domain name (www.yoursite.com) and your domain registration panel login and password (to setup nameservers).</strong></p>\r \r <p style="margin-left:2.0in;">&nbsp;</p>\r \r <p style="margin-left:.75in;">b.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Prior to installation all hosts must be approved by <a href="http://www.pennyauctionsoft.com/">www.pennyauctionsoft.com</a></p>\r \r <p style="margin-left:.75in;">c.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Some packages will include the installation of a ssl certificate. In such case the certificate must be provide by the buyer.(penny auction soft does not provide ssl certificates.</p>\r \r <p style="margin-left:.75in;">d.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Installations will not be guaranteed to work on all hosts.</p>\r \r <p style="margin-left:.75in;">e.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Installations that require more than 4 hours time will be billed at $85.00 per hour</p>\r \r <p style="margin-left:.75in;">&nbsp;</p>\r \r <p>8.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Design</p>\r \r <p style="margin-left:.75in;">a.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; The buyer 
must provide a logo(a logo can be provided by penny auction soft for an additional fee)</p>\r \r <p style="margin-left:.75in;">b.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Any design package purchased will include up to 10 hours of design work.</p>\r \r <p style="margin-left:.75in;">c.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Design work will include, color design, logo installation, custom text provided by the buyer, and social networking linking.</p>\r \r <p style="margin-left:.75in;">d.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Design work that exceeds 10 hours will be billed at $75.00 per hour.( the client will be notified prior to incurring any additional charges.</p>\r \r <p style="margin-left:.75in;">e.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; All logos and text must be supplied by the buyer in a format requested by the assigned designer.</p>\r \r <p>9.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Guarantees</p>\r \r <p style="margin-left:.75in;">a.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="http://www.pennyauctionsoft.com/">www.pennyauctionsoft.com</a> guarantees that our software will function properly as advertise on the site.</p>\r \r <p style="margin-left:.75in;">b.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; We guarantee to fix any glitches due to software failure at no charge.</p>\r \r <p style="margin-left:.75in;">c.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; We guarantee delivery of our cd within 14 days</p>\r \r <p style="margin-left:.75in;">d.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; We guarantee timely response as support</p>\r \r <p style="margin-left:.75in;">e.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; The following will void any guarantee :</p>\r \r <p style="margin-left:2.0in;">1.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Any modifications to the software, script, or design, not preformed by us.</p>\r \r <p style="margin-left:2.0in;">2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Non payment or charge backs</p>\r \r <p style="margin-left:2.0in;">3.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Violations of the license terms</p>\r \r <p style="margin-left:2.0in;">4.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Domains not parked at&nbsp; <a href="http://www.godaddy.com/">www.godaddy.com</a></p>\r \r <p style="margin-left:2.0in;">5.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Unapproved hosts or hosting issues</p>\r \r <p>10.&nbsp;&nbsp;&nbsp; Templates</p>\r \r <p>&nbsp;</p>\r \r <p style="margin-left:.75in;">a. &nbsp; &nbsp; &nbsp;Templates may not be reproduced by the customer at any time ever under a $20,000.00 penalty or more but no less.</p>\r \r <p style="margin-left:.75in;">b. &nbsp; &nbsp; &nbsp;Some templates may not have all of the features. do to spacing and lack of compatability.</p>\r \r <p style="margin-left:.75in;">&nbsp;</p>\r \r <p style="margin-left:.5in;">11.&nbsp;&nbsp;&nbsp; CUSTOM MODIFICATIONS AND DESIGN</p>\r \r <p style="margin-left:.75in;">a.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; By purchasing our script you agree that you will be responsible for any custom modifications made to the script. We will not support any custom modifications made by third party developers or template designers. If you choose to have us design a template for you or logo this template becomes your intellectual property or design, however, if the design is a direct clone of another established site, we retain the right to resell this template.<br />\r <br />\r If you have a modification or function programmed by our team we reserve the right to resell these modifications if these functions or modifications will compliment the overall script performance. Penny Auction Soft reserves the right of resale in this case</p>\r \r <p style="margin-left:.75in;">b.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; All custom programming will be presented by the buyer and a proposal will be generated by <a href="http://www.pennyauctionsoft.com/">www.pennyauctionsoft.com</a>&nbsp; on a case by case basis.</p>\r \r <p style="margin-left:.75in;">&nbsp;</p>\r \r <p>12.&nbsp;&nbsp;&nbsp; Refunds</p>\r \r <p>&nbsp;</p>\r \r <p style="margin-left:.75in;">a.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;We <strong>do not </strong>accept returns on our product because along with your 
software purchase a digital download is offered making it impossible to return the code.</p>\r \r <p style="margin-left:.75in;">b.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; All sales are final and non refundable under any circumstance.</p>\r \r <p style="margin-left:.75in;">&nbsp;</p>\r \r <p>13.&nbsp;&nbsp;&nbsp; Shipping</p>\r \r <p style="margin-left:.75in;">a.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; We ship all orders by Fedex ground or Express post (depending if Fedex delivers to your area). All shipment will be delivered with no signature required .</p>\r \r <p style="margin-left:.75in;">b.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; There is a $25.00 shipping and handling fee added</p>\r \r <p style="margin-left:.75in;">&nbsp;</p>\r \r <p>14.&nbsp;&nbsp;&nbsp; Hosting and monthly billing</p>\r \r <p style="margin-left:.75in;">a.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Any purchase that is based on a monthly subscription will be automatically withdrawn based on your provided payment method on the day of the month that you have purchased the product and every month thereafter until you cancel</p>\r \r <p style="margin-left:.75in;">b.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; In order to stop automatic billing a 20 day notice prior to the next billing date must be made via verifiable email or buy physical email.</p>\r \r <p style="margin-left:.75in;">c.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; In the event of insufficient funds we may try to re submit the payment request within ten days and a 10% penalty will be automatically assessed to you.</p>\r \r <p style="margin-left:.75in;">d.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; After ten days of non-payment your account will be terminated. (your license will remain in effect however)</p>\r \r <p style="margin-left:.75in;">e.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Pas is not responsible for lost data due to non payment</p>\r \r <p style="margin-left:.75in;">&nbsp;</p>\r \r <p>15.&nbsp;&nbsp;&nbsp; Governing law</p>\r \r <p style="margin-left:.75in;">a.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; This contract shall be based on new hampshire usa law.</p>\r \r <p style="margin-left:.75in;">&nbsp;</p>\r \r <p>16.&nbsp;&nbsp;&nbsp; Arbitration</p>\r \r <p style="margin-left:.75in;">a.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; In the event that a dispute cannot be resolved via a mutual understanding it is agreed upon that court proceeding will be waived and that a licensed arbitrator from the state new hampshire will be mutually agreed upon to resolve any issues. Judgments deemed by the arbitrator will be set forth as ordered.</p>\r \r <p style="margin-left:.75in;">b . &nbsp; &nbsp;notice of proceedings will be delivered to the address given within the users account &nbsp;and during registration.. no other notice will be needed</p>\r \r <p style="margin-left:.75in;">&nbsp;</p>\r \r <p style="margin-left:.75in;">&nbsp;</p>\r \r <p>17.&nbsp;&nbsp;&nbsp; The buyer&rsquo;s purchase of any product from <a href="http://www.pennyauctionsoft.com/">www.pennyauctionsoft.com</a>&nbsp; constitutes an agreement to all the terms and conditions set forth in this contract by the buyer.</p>\r '),
(null, 'aboutus', '<p class="pageTitle" style="margin: 0px; padding: 5px 0px 10px; font-family: Oxygen, sans-serif; font-weight: bold; text-transform: uppercase;"><tt><samp><q><span style="color: rgb(null, 0, 0); font-size: 15px; line-height: 20px;">In 2011 vintage iron holding purchased penny auction soft. When we got the the penny auction software, we quickly realized that it had been neglected for many years. Many of the templates had been neglected and were in serious need of an upgrade. Users had been neglected and the previous owner was not servicing the needs of the clients. Support was sub-par at best and clients were not happy. Despite the Terrible treatment of the previous owner&rsquo;s clients we realized we had a great software and most importantly it worked even under the most extreme conditions a penny auction software needed to operate on. So we got started rebuilding off of an&nbsp;amazing base</span></q></samp></tt><span style="font-size: 15px; font-weight: normal; line-height: 20px;">I</span></p>\r \r <p class="pageTitle" style="margin: 0px; padding: 5px 0px 10px; font-family: Oxygen, sans-serif; font-weight: bold; text-transform: uppercase;"><span style="font-size: 15px; font-weight: normal; line-height: 20px;">n 2012 we began a massive undertaking of going through the software with a fine tooth comb, try to find all of the flaws and bugs starting with the company&rsquo;s flagship auction software BID CATI which was originally it was built as a swoopo or telebids clone. It was based as a php penny auction with some ajax and java functions. We were happy to see that the software was not built in php cake which is almost guaranteed to fail after only a 100 or so users are on the your site. First we upgraded the system to accommodate more users by expanding the system reliance on java and updating the php to the most recent version of php and html5. Then we started picking apart the entire system module by module, upgrading reporting, statistics , user management, payment modules. Then we did something pretty radical we converted all of the text and many of the functions to work in a database format making it easy edit and change colors buttons and wide array of images.</span></p>\r \r <p style="margin: 0px; padding: 0px 0px 13px; font-family: Oxygen, sans-serif; font-size: 15px; line-height: 20px;"><tt>Then we went through and added 4 additional auction types. You sea so many other penny auction software&rsquo;s focus on upgrading their auto bidders, so the new site owners can scam there users and bid against them. We left the auto bidders in the software as an option, but instead of enhancing them we decided to focus creating auctions that were both fair for the users but also did not break the new penny auction site owners bank. Owners now get some great exclusives like reserve auctions.</tt></p>\r \r <p style="margin: 0px; padding: 0px 0px 13px; font-family: Oxygen, sans-serif; font-size: 15px; line-height: 20px;"><tt>We didn&rsquo;t stop there though. We added amazing features like facebook login features, design suite,(simply the most power full penny auction software upgrade in the industry), a well documents tool tip and help section, and a super fast auto lister module that allows you to list 100&rsquo;s of auctions in minutes.</tt></p>\r \r <p style="margin: 0px; padding: 0px 0px 13px; font-family: Oxygen, sans-serif; font-size: 15px; line-height: 20px;"><tt>Now we can seriously say we have the most power full penny auction software in the industry with our goal being to supply our customers with not only the best auction software but also with the best customer service. Our team is made up of the most dedicated people in the industry. We currently employ 1 full time master programmer, 1 full time regular programmer, 2 designers, and a full time customer support professional.</tt></p>\r \r <h6 style="margin: 0px; padding: 15px 0px; font-size: 19px; color: rgb(null, 84, 79); font-family: Oxygen, sans-serif;">Our office location is&hellip;</h6>\r \r <div class="location" style="padding-bottom: 
15px; color: rgb(null, 0, 0); font-family: Arial, Helvetica, sans-serif; line-height: 12px;">\r <p style="margin: 0px; padding: 3px 0px; font-family: Oxygen, sans-serif; font-size: 15px; font-weight: bold; line-height: 20px; color: rgb(null, 63, 112);">Penny auction soft</p>\r \r <p style="margin: 0px; padding: 3px 0px; font-family: Oxygen, sans-serif; font-size: 15px; font-weight: bold; line-height: 20px; color: rgb(null, 63, 112);">111a Loundon Rd</p>\r \r <p style="margin: 0px; padding: 3px 0px; font-family: Oxygen, sans-serif; font-size: 15px; font-weight: bold; line-height: 20px; color: rgb(null, 63, 112);">Concord NH, 03053</p>\r \r <p style="margin: 0px; padding: 3px 0px; font-family: Oxygen, sans-serif; font-size: 15px; font-weight: bold; line-height: 20px; color: rgb(null, 63, 112);">Sincerely, Joel M Asadoorian CEO of operations</p>\r </div>\r '),
(null, 'contact', '<h1>&nbsp;</h1>\r \r <p><strong><font size="4">Email or Call us Direct at:&nbsp;</font></strong></p>\r \r <p><strong><font size="4">support@pennyauctionsoft.com</font></strong></p>\r \r <p><font size="4"><strong>Phone:800-230-9197</strong></font></p>\r \r <p><font size="3">&nbsp;</font></p>\r '),
(null, 'privacy',  '<p>&nbsp;</p>\r \r <p class="MsoNormal">.<span style="line-height: 1.6em;">Please read this Privacy Policy before using the &ldquo;Pas</span><span style="line-height: 1.6em;">&rdquo; website or submitting any personal information. By using the &ldquo;pas&rdquo; website, you accept and consent to the practices described in this Privacy Policy. By your continued use you expressly consent to our collection, storage, use and disclosure of your personal information as described in this Privacy Policy. If you do not agree with these practices you are free to discontinue your use of the &ldquo;pas&rdquo; website at any time.</span></p>\r \r <p class="MsoNormal">&nbsp;</p>\r \r <p class="MsoNormal">If you have questions about our privacy policy, please email us at <a href="mailto:support@biddersparadise.com">support@bpennyauctyinsoft.com</a> &nbsp;</p>\r \r <p class="MsoNormal">&nbsp;</p>\r \r <p class="MsoNormal">Data Collection</p>\r \r <p class="MsoNormal">&nbsp;You may visit &ldquo;pas&rdquo; at any time without intentionally revealing any personal information about yourself. However, when you visit our website, we may collect and store your computer and connection information, statistics on page views, traffic to and from &ldquo;pas&rdquo;, advertisement data, IP address and standard web log information and information from other companies, such as demographic and navigation data.</p>\r \r <p class="MsoNormal">&nbsp;</p>\r \r <p class="MsoNormal">For you to actively participate in &ldquo;pas&rdquo; we do need some of your personal information. Once you provide us with your required personal information, you are no longer anonymous. In providing us with your personal information, you consent to the transfer and storage of such information on our servers.</p>\r \r <p class="MsoNormal">&nbsp;</p>\r \r <p class="MsoNormal">When you register on &ldquo;pas&rdquo;, we will collect the following required information: email address, first and last name, date of birth, and password; all transactional information based on your activities on &ldquo;pas&rdquo;; shipping, billing and other information relating to any purchase or shipping; any correspondence sent to us; financial information, such as your credit card information; and other supplemental information from third parties.</p>\r \r <p class="MsoNormal">&nbsp;</p>\r \r <p class="MsoNormal">Use of Data</p>\r \r <p class="MsoNormal">&nbsp;</p>\r \r <p class="MsoNormal">&nbsp;Our purpose for collecting personal information is to provide you with a safe, efficient, and customized experience. By signing up, you agree that we may use your personal information to: provide the services and customer support you request; resolve disputes, collect fees, and troubleshoot problems; prevent potentially prohibited or illegal activities, and enforce our Terms &amp; Conditions; customize, measure and improve our services, content and advertising; inform you about our services, targeted marketing, service updates, and promotions; and compare information and verify it with third parties for accuracy.</p>\r \r <p class="MsoNormal">&nbsp;</p>\r \r <p class="MsoNormal">Disclosure of Personal Data</p>\r \r <p class="MsoNormal">&bull; We may disclose personal information to respond to legal requirements, enforce our Terms &amp; Conditions and Privacy Policy, respond to claims that a listing or other content violates the rights of others, or protect anyone&#39;s rights, property, or safety. This information will be disclosed under applicable laws and regulations.</p>\r \r <p class="MsoNormal">&bull; We may also share your personal information with third parties assisting our business operations under contract, including but not limited to fraud investigations and debt collection, with law enforcement or other governmental officials if required by law, and with other business entities, should we plan to merge with or be acquired by that business entity.</p>\r \r <p class="MsoNormal">&bull; We do not share your personal information with third party advertisers.</p>\r \r <p class="
MsoNormal">&nbsp;</p>\r \r <p class="MsoNormal">Your Information on &ldquo;pas&rdquo;</p>\r \r <p class="MsoNormal">When visiting &ldquo;pas&rdquo; from a public or shared computer, certain information about you, such as your user name, may also be visible to others who may use that computer after your use. It is your responsibility to ensure private information is removed from the public or shared computer should you choose to use one.</p>\r \r <p class="MsoNormal">&nbsp;</p>\r \r <p class="MsoNormal">Access, Review and Change of Personal Data</p>\r \r <p class="MsoNormal">&nbsp;You can access, review and change most of your personal information by logging on to &ldquo;pas&rdquo; at any time. However, some of your personal information can only be changed by contacting our Customer Service. Accurate information is required for billing and delivery purposes. You are required to promptly update your personal information if changes occur or information is inaccurate.</p>\r \r <p class="MsoNormal">&nbsp;</p>\r \r <p class="MsoNormal">Use of Cookies at our Website</p>\r \r <p class="MsoNormal">&ldquo;pas&rdquo; uses so-called &quot;cookies&quot;, which are files that are stored on your computer that can be retrieved to assist in customizing your experience with the online service. The information saved supports the functionality of the site, for example, by keeping track of your visual preferences or controlling the frequency of &quot;pop-up&quot; windows. You are free to prevent cookies from being saved on your hard drive by adjusting the corresponding settings in your browser. However, turning off these settings may result in limited functionality.</p>\r \r <p class="MsoNormal">&nbsp;</p>\r \r <p class="MsoNormal">Security Measures</p>\r \r <p class="MsoNormal">&nbsp;Your &ldquo;pas&rdquo; account and profile and the information contained therein are password protected. Please note that you are not permitted to provide your password to anyone else. &ldquo;pas&rdquo; will never ask for your password in e-mail or over the phone. Please remember to log out of your account and to close your Internet browser window when you leave the &ldquo;pas&rdquo; site; this is especially important if you use a PC in public locations. We assume no liability for the abuse of login data and passwords used.</p>\r \r <p class="MsoNormal">&nbsp;</p>\r \r <p class="MsoNormal">&ldquo;pas&rdquo;treats data as an asset that must be highly protected. We use security measures to protect your personal information against unauthorized access and disclosure. However, although we work very hard to protect your privacy, we do not promise, and you should not expect, that your personal information or private communications will always remain private.</p>\r \r <p class="MsoNormal">&nbsp;</p>\r \r <p class="MsoNormal">Protection from Web Crawlers or Spam</p>\r \r <p class="MsoNormal">&ldquo;pas&rdquo;assures you that we will use your e-mail address with your express consent only for the purposes stated in the help Terms &amp; Conditions. We will not rent or sell your e-mail address to third parties, and we will prevent your e-mail address from being recorded by &quot;web crawlers&quot; or &quot;web spiders&quot; to the best of our ability. If you believe that your e-mail address has been recorded in this way.</p>\r \r <p class="MsoNormal">&nbsp;</p>\r \r <p class="MsoNormal">Children</p>\r \r <p class="MsoNormal">&ldquo;pas&rdquo; is sensitive to the need to protect the privacy of children who use the Internet. &ldquo;pas&rdquo; does not knowingly collect or solicit personally identifiable information from or about children under the age of eighteen (18) consistent with and exceeding the requirements of the Children&#39;s Online Privacy Protection Act. If we discover or are otherwise notified that we have received any such information from a child in violation of this policy, we will delete that information. If you are under the age of eighteen (18), please do not attempt to provide any personally identifiable information on our Sites. If you believe that &
ldquo;pas&rdquo; has any information from or about a child under the age of eighteen, please contact us immediately by clicking on &quot;Contact Us&quot; and sending us an e-mail and we will take appropriate steps to remove such information from our files.</p>\r \r <p class="MsoNormal">&nbsp;</p>\r \r <p class="MsoNormal">Please review the privacy policy of other sites you or your children elect to link to through &ldquo;pas&rdquo; for the children&#39;s privacy policy of those sites &ldquo;pas&rdquo; is not responsible for the privacy policy or other content of any other website, including sites that are co-branded.</p>\r \r <p class="MsoNormal">&nbsp;</p>\r \r <p class="MsoNormal">Notice of Privacy Rights to Missouri Residents</p>\r \r <p class="MsoNormal">Missouri law requires that we provide you with a summary of your privacy rights under the Missouri Online Privacy Protection Act (the &quot;Act&quot;) and the Missouri Business and Professions Code. As required by the Act, we provide you with the categories of personally identifiable information that we collect through this website and the categories of third party persons or entities with whom such personally identifiable information may be shared for direct marketing purposes at your request.</p>\r \r <p class="MsoNormal">&nbsp;</p>\r \r <p class="MsoNormal">Missouri law requires us to inform you, at your request, (1) the categories of personally identifiable information we collect and what third parties we share that information with; (2) the names and addresses of those third parties; and (3) examples of the products marketed by those companies. The Act further requires us to allow you to control who you do not want us to share that information with. To obtain this information, please send a request by email or standard mail to the address found below.</p>\r \r <p class="MsoNormal">&nbsp;</p>\r \r <p class="MsoNormal">When contacting us, please indicate your name, address, email address, and what personally identifiable information you do not want us to share with third parties. The request should be sent to the attention of our legal department, and labeled &quot;Missouri Customer Choice Notice.&quot; Please allow thirty (30) days for a response. Also, please note that there is no charge for controlling the sharing of your personally identifiable information or requesting this notice.</p>\r \r <p>&nbsp;</p>\r '),
(null, 'jobs', '<p>PennyAuctionSoft,  We are currently looking for affiliate marketers, earn a at least 25% of each bidpack purchase you refer. &nbsp;The best long term payout in the industry.<span style="white-space: pre" class="Apple-tab-span">	</span></p><p>&nbsp;</p><p>Ready to learn more?&nbsp;Use the &quot;contact us&quot; page to to write or call us today. &nbsp;</p><p>&nbsp;</p>'),
(null, 'welcome', '<p> <style type="text/css"> .style1 { 	color: #000080; } </style> </p><p><font size="2"><strong>Welcome to Penny Auction Soft, home of  &quot;The Most Addictive Auctions On The Internet!&quot;&nbsp; Our auctions work a little bit differently - but once you&rsquo;ve bid and won a few items, we know you&rsquo;ll love them.<br /><br />                  There&rsquo;s a  few key things that are different from other auctions you might have used  online:</strong></font>                    </p>                 <p class="style1"><font size="2"><strong>So let&#39;s take a look at how it works:</strong></font></p><p><font size="2"><strong>1.&nbsp; All of the Items on Penny Auction Soft are Brand New and come with the full Manufacturers Warranty. </strong></font></p><p><font size="2"><strong>2.&nbsp; Each item starts with a a Bidding Price of just 10 cents.&nbsp; There is no reserve price for the auctions.</strong><br /></font><font size="2"><strong><br />3.&nbsp; Every time a bid is placed the price on the item goes up just 10 cents!</strong><br /></font><font size="2"><strong>When a bid is placed in the last few minutes of an auction, we extend the auction time by up to 20 seconds.</strong><br /></font><font size="2"><strong><br />4.&nbsp; When the Countdown clock gets to Zero, whoever is the bidder that placed the final bid, wins the auction and can now purchase the item for the price of their Auction!&nbsp; Check out The Awesome Deals People Are Getting on the winners page! </strong><br /></font><font size="2"><strong><br />5.&nbsp; There is a small charge for each bid, which allows us to offer the most awesome deals on the internet!</strong></font></p><ol> </ol><p>&nbsp;</p><hr size="2" width="100%" /><p>&nbsp;</p><p><strong><font size="3">4 Different Types Of Auctions </font></strong></p><p><font size="2"><strong>1.&nbsp; Set Price Auctions -</strong> Set Price Auctions are exactly what they sound like.&nbsp; Basically, the price of the item is set and no matter what the bid price goes to, the winner will only pay the Set Price for that item.&nbsp; So, let&#39;s say the Sony Vaio Laptop is a Set Price Auction with a Set Price of just $20.00.&nbsp; The bidding will start at 10 Cents and for every bid placed the price goes up 10 cents and up to 20 secondsis added to the countdown clock.&nbsp; Even if the final bid comes in at $450.00, the winner will still only pay the $20.00 Set Price for the Sony Vaio Laptop!</font></p><p><font size="2"><strong>2.&nbsp; Totally Free Auctions -</strong>&nbsp; These auctions are totally free to the winner.&nbsp; No matter what the winning bid price is, the winner will not pay anything for that item.&nbsp; <strong>It&#39;s Totally Free!</strong> </font></p><p><font size="2"><strong>3.&nbsp; One Cent Auctions -</strong> On One Cent Auctions, instead of the item starting at 10 cents and going up 10 cents with each bid, Once Cent Auction Items start at just 1 Cent and with every bid placed, go up just 1 cent. </font></p><p><font size="2"><strong>4.&nbsp; Night Auctions -</strong>&nbsp; These are set auctions that only run for a limited amount of time at night.</font></p><p>&nbsp;</p>'),
(null, 'affiliates', '<p><font size="4"><font size="2">Introducing. . .</font> </font></p><p><font size="4">The Refer A Friend and Win Affiliate Program! (Patent Pending)</font></p><p><font size="3">Want to increase your chances to win?&nbsp; Want Extra Cash Every Month?</font></p><p><strong><font size="3">Here&#39;s how it works.</font></strong></p><p><font size="2"><strong><font size="3">1.&nbsp; Refer A Friend and When Your Friend Wins - You WIN TOO!</font><br /></strong>When you Register for Free as a Auction Member you also automatically are enrolled in the Refer A Friend and Win Affiliate Program.</font></p><p><font size="2">Using the tools in the Member Section every Member that you refer to Penny Auction Soft will permanently be linked to you in our system! <strong>If ANY of your referred friends EVER wins an Auction, YOU WIN THE SAME AUCTION!&nbsp; </strong>Have 10 friends? Refer them for Free and you just increased your chances to win by Ten Times!&nbsp; There is NO Limit to the number of referrals you can Have!</font></p><p><strong><font size="3">2.&nbsp; Earn Extra Cash Every Day!</font></strong><font size="2"><br />Who doesn&#39;t want a few extra bucks every day?&nbsp; How about earning a part time or full time income online?&nbsp; In addition to winning the same items that any of your referrals win, as an Affiliate you also <strong>earn a full 10% of all the revenue generated by your referrals when they purchase bids!</strong>&nbsp; You earn this every month, for the life of the customer! &nbsp;</font> </p><hr size="2" width="100%" /><p>&nbsp;<font size="2"><strong>Register Now For Free!</strong></font></p>');

-- NEXT_QUERY --

INSERT INTO `static_pages` VALUES (null, 'miscellaneous', '<p><strong>Miscellaneous:</strong></p>\r\n\r\n<p>Members and users may only access those portions of the Site specifically made available to Members and users. Under no circumstances are Members or users permitted to use or attempt to use the Site or any portion thereof to violate its security or the security of systems accessible through it.&nbsp;Will not be responsible for any loss or damage incurred as the result of unauthorized interception or decryption of information transmitted to or from LazyBids.</p>\r\n\r\n<p>Each Member and user agrees not to engage in unsportsmanlike conduct or otherwise abuse the Services by conduct that is or may be detrimental to the interests of&nbsp;LazyBids or other Members or users.&nbsp; Any Member or user suspected of engaging in any fraudulent, abusive, manipulative or illegal activity may have their Account terminated and all Bids cancelled in LazyBids sole discretion, and the Member or user may be referred to appropriate law enforcement agencies. LazyBids reserves the right, but not the obligation, to monitor your access to and use of the Site and the Services.&nbsp; Members and users, among other things, shall not: (a) use automated means to place or accumulate Bids; (b) manipulate or interfere with the Services or any affiliated program in any way; (c) present false or misleading information; (d) obtain or use Bids in violation of these Terms of Use or that were erroneously credited to a Member&#39;s or user&#39;s Account; or (e) assist another individual or entity in conducting fraudulent, abusive, manipulative or illegal activity.</p>\r\n'),
(null, 'minors', '<p>We are committed to protecting children&#39;s privacy on the Internet and we comply fully with the Children&#39;s Online Privacy Protection Act (COPPA). We do not knowingly collect personally identifiable information from children under the age of 13. Our products are not intended for anyone less than 18 years of age and by ordering from our site, you are representing that you are an adult.</p><p>Your Consent</p><p>By using our websites, you consent to our use of information that is collected or submitted as described in this online privacy policy. We may change or add to this privacy policy so we encourage you to review it periodically. We will include the date the privacy policy was last updated.</p><p>Security</p><p>Our Commitment to Data Security</p><p>We have appropriate physical, electronic and procedural security safeguards to protect and secure the information we collect.</p><p>Secure Sockets Layering (SSL)</p><p>We utilize the latest and most secure version of Secure Sockets Layer (SSL) encryption technology. This technology safeguards your personal information and guarantees privacy. It encrypts all of your personal information, including payment information, name, email address and mailing address, so that it cannot be read as the information travels over the Internet. SSL technology is the industry standard for secure online transactions.</p>');

-- NEXT_QUERY --

INSERT INTO `faq` VALUES (null,2,'How do I bid Here?','Pick an auction What will it be? A brand new 42&quot; plasma TV? The latest notebook computer? Or maybe a new leather handbag? Pick your product and go for it! You&#39;ll always find a selection of our most exciting auctions on the homepage, or you can browse through the categories to find just what you&#39;re looking for. '),
(null,4,'I"ve just won an auction. What now?','<p>First, Congratulations - Well done on winning the auction! Confirming your win Once the auction has ended, you?ll be automatically transferred to a page where we?ll ask you to confirm that you still want the item and explain what to do next. You&#39;ll have the opportunity to redeem any vouchers you may have and will be told how to pay the final amount. We&#39;ll also contact you via e-mail to explain how to do all this. </p><p>Just remember to confirm that you still want the item within 7 days of the end of the auction. If you still haven?t confirmed within 21 days, we?ll assume that you?ve changed your mind and no longer want to buy the item. Paying for the item you won Just as for your bids, you can pay for your item via PayPal. Please make sure that you pay within 7 days of the end of the auction. We?ll confirm your payment via e-mail and arrange for the item to be shipped to you. </p>'),(null,5,'Substitute items','Substitute items  On rare occasions we are no longer able to source the specific item detailed in the auction. When this happens, we will contact you and offer to send you an equivalent item of at least equal value. Many of the products we sell are high-technology items that have a short life-cycle, so often this will mean an upgrade to the newer version of the item'),
(null,2,'How does the AutoBidder work?','<p>Don&#39;t have time to be online to bid on your favorite auction?&nbsp; Set up an AutoBidder to bid on the item for you!&nbsp; Just let the AutoBidder know what item you want to bid on, how many bids you are willing to place and the price range you want to bid in and the AutoBidder will do the rest and place the bids for you!&nbsp; The Autobids are always placed in the last 10 seconds of an auction, so you won&#39;t waste any bids! </p><p>&nbsp;</p>'),(null,5,'Delivery Charges','The delivery charges for each item are shown on the auction description page. The charges shown are for delivery to US addresses. We can deliver items to other countries at an additional expense.');

-- NEXT_QUERY --

INSERT INTO `forum_categories` (`category_id`, `category_order`, `category_name`, `status`) VALUES
(null, 0, 'Stories', '0'),
(null, 0, 'Bidding to win', '0');

-- NEXT_QUERY --

INSERT INTO `helptopic` VALUES (null,'Bidding'),(null,'Auctions'),(null,'Delivery & Shipping');

-- NEXT_QUERY --

INSERT INTO `general_setting` (`id`, `min_bid_price`, `login_flag`, `login_points`, `reg_message`, `reg_bidpoint`) VALUES
(1, '0.55', '0', 0, '', 0),
(2, '0.00', '', 1, '', 0),
(3, '0.00', '1', 1, '', 0),
(4, '0.00', '0', 0, 'Get 10 Free Bids On Registration!!!', 10);

-- NEXT_QUERY --

INSERT INTO `templates` (`id`, `template`, `template_description`, `created_by`, `modified`) VALUES
(null, 'wavee', '', 'Penny Auction Soft', '2013-05-12 03:14:18'),
(null, 'sticky', '', 'Penny Auction Soft', '2013-05-12 03:14:26'),
(null, 'falconbids', '', 'Penny Auction Soft', '2013-05-12 03:14:34'),
(null, 'pas', '', 'Penny Auction Soft', '2013-05-12 03:14:40'),
(null, 'gunbidder', '', 'Penny Auction Soft', '2013-05-12 03:43:13'),
(null, 'beezid', '', 'Penny Auction Soft', '2013-05-12 03:43:13'),
(null, 'snapbids', '', 'Penny Auction Soft', '2013-05-12 03:43:13'),
(null, 'dealdash', '', 'Penny Auction Soft', '2013-05-12 03:43:13'),
(null, 'quibids-2.0', '', 'Penny Auction Soft', '2013-05-12 03:43:13');

-- NEXT_QUERY --

INSERT INTO `testimonials` (`id`, `user_id`, `picture`, `date`, `text`, `status`) VALUES
(null, 1, 'regTestimonial1.jpg', '2013-02-05', 'PennyAuctionSoftis great My grandsons wanted iPods for Christmas, but I am out of work. Through Penny Auction Soft, I was able to get them, one for as little as $2.82; plus I won $475 in gift cards, one for as little as $0.60', 1),
(null, 1, 'regTestimonial2.jpg', '2013-02-05', 'There couldn''t be a happier Panny Auctioner than me right now My husband and I really needed a getaway. Luckily, I won 2 Visa gift cards totaling $150 These gift cards will give my husband and I the much needed weekend away. I can''t wait to share this with him', 1),
(null, 1, 'regTestimonial3.jpg', '2013-02-05', 'As I was bidding, my roommate was asking me how it was going. Gazing at the screen, I watched the timer read "3...2...1... SOLD" winning me this VIZIO 32" HDTV for $2.60. Answering his question, I did some awesomeair kicks to liberate my adrenaline', 1),
(null, 1, 'regTestimonial4.jpg', '2013-02-05', 'For my friend''s 23rd birthday, I gave her a 32GB iPod Touch that I won on Penny Auction Boutique. She was so excited when she got it that she showed everybody. When she shared how I got it for $15 and received it three days later, they couldn''t believe it If you are a fan of exciting auctions, this is the site for you', 1);

-- NEXT_QUERY --

INSERT INTO `userdata` VALUES (null,'support@pennyauctionsoft.com','support@pennyauctionsoft.com',NULL);

-- NEXT_QUERY --

INSERT INTO `users` (`id`, `name`, `password`, `username`, `email`, `admin`, `available`, `keepAlive`) VALUES
(null, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin', 'contact@pennyauctionsoft.com', 'Yes', 'no', 1374650193),
(null, 'edward.goodnow', 'b7a875fc1ea228b9061041b7cec4bd3c52ab3ce3', 'edwardgoodnow', 'edward.goodnow@gmail.com', 'No', 'no', 1354616181);

-- NEXT_QUERY --

INSERT INTO `user_levels` (`id`, `admin_level`, `allowed_pages`, `addons`) VALUES
(null, 'designer', '', NULL),
(null, 'auctioneer', 0x2f686f6d652f70656e6e7961756374696f6e736f667464656d6f2f7075626c69635f68746d6c2f6261636b656e6461646d696e2f696e6e657273746f72652e7068702c2f686f6d652f70656e6e7961756374696f6e736f667464656d6f2f7075626c69635f68746d6c2f6261636b656e6461646d696e2f61646461756374696f6e2e7068702c2f686f6d652f70656e6e7961756374696f6e736f667464656d6f2f7075626c69635f68746d6c2f6261636b656e6461646d696e2f6d616e61676561756374696f6e2e7068702c2f686f6d652f70656e6e7961756374696f6e736f667464656d6f2f7075626c69635f68746d6c2f6261636b656e6461646d696e2f736f6c6461756374696f6e2e7068702c2f686f6d652f70656e6e7961756374696f6e736f667464656d6f2f7075626c69635f68746d6c2f6261636b656e6461646d696e2f756e736f6c6461756374696f6e2e7068702c2f686f6d652f70656e6e7961756374696f6e736f667464656d6f2f7075626c69635f68746d6c2f6261636b656e6461646d696e2f6d616e6167656275796e6f772e7068702c2c2f686f6d652f70656e6e7961756374696f6e736f667464656d6f2f7075626c69635f68746d6c2f6261636b656e6461646d696e2f6d6573736167652e7068702c2f686f6d652f70656e6e7961756374696f6e736f667464656d6f2f7075626c69635f68746d6c2f6261636b656e6461646d696e2f696e6465782e7068702c2f686f6d652f70656e6e7961756374696f6e736f667464656d6f2f7075626c69635f68746d6c2f6261636b656e6461646d696e2f696e6e6572686f6d652e706870, NULL),
(null, 'Vendor', 0x2f686f6d652f70656e6e7961756374696f6e736f667464656d6f2f7075626c69635f68746d6c2f6261636b656e6461646d696e2f61646461756374696f6e2e7068702c2f686f6d652f70656e6e7961756374696f6e736f667464656d6f2f7075626c69635f68746d6c2f6261636b656e6461646d696e2f61646470726f64756374732e7068702c2f686f6d652f70656e6e7961756374696f6e736f667464656d6f2f7075626c69635f68746d6c2f6261636b656e6461646d696e2f67625f76656e646f722e7068702c2f686f6d652f70656e6e7961756374696f6e736f667464656d6f2f7075626c69635f68746d6c2f6261636b656e6461646d696e2f696e6e65726163636f756e742e7068702c2f686f6d652f70656e6e7961756374696f6e736f667464656d6f2f7075626c69635f68746d6c2f6261636b656e6461646d696e2f696e6e657264617461626173652e7068702c2f686f6d652f70656e6e7961756374696f6e736f667464656d6f2f7075626c69635f68746d6c2f6261636b656e6461646d696e2f696e6e6572656d61696c2e7068702c2f686f6d652f70656e6e7961756374696f6e736f667464656d6f2f7075626c69635f68746d6c2f6261636b656e6461646d696e2f696e6e6572666f72756d2e7068702c2f686f6d652f70656e6e7961756374696f6e736f667464656d6f2f7075626c69635f68746d6c2f6261636b656e6461646d696e2f696e6e65727061796d656e742e7068702c2f686f6d652f70656e6e7961756374696f6e736f667464656d6f2f7075626c69635f68746d6c2f6261636b656e6461646d696e2f696e6e6572706c7567696e2e7068702c2f686f6d652f70656e6e7961756374696f6e736f667464656d6f2f7075626c69635f68746d6c2f6261636b656e6461646d696e2f696e6e65727265706f72742e7068702c2f686f6d652f70656e6e7961756374696f6e736f667464656d6f2f7075626c69635f68746d6c2f6261636b656e6461646d696e2f696e6e65727374617469632e7068702c2f686f6d652f70656e6e7961756374696f6e736f667464656d6f2f7075626c69635f68746d6c2f6261636b656e6461646d696e2f696e6e657273746f72652e7068702c2f686f6d652f70656e6e7961756374696f6e736f667464656d6f2f7075626c69635f68746d6c2f6261636b656e6461646d696e2f696e6e657275736572732e7068702c2f686f6d652f70656e6e7961756374696f6e736f667464656d6f2f7075626c69635f68746d6c2f6261636b656e6461646d696e2f696e6465782e7068702c2f686f6d652f70656e6e7961756374696f6e736f667464656d6f2f7075626c69635f68746d6c2f6261636b656e6461646d696e2f696e6e6572686f6d652e7068702c2f686f6d652f70656e6e7961756374696f6e736f667464656d6f2f7075626c69635f68746d6c2f6261636b656e6461646d696e2f6d6573736167652e706870, NULL);

-- NEXT_QUERY --

INSERT INTO `usstates` (`id`, `stname`, `stcode`, `country`) VALUES
(1, 'Alabama', 'AL', 'US'),
(2, 'Alaska', 'AK', 'US'),
(3, 'Arizona', 'AZ', 'US'),
(4, 'Arkansas', 'AR', 'US'),
(5, 'California', 'CA', 'US'),
(6, 'Colorado', 'CO', 'US'),
(7, 'Connecticut', 'CT', 'US'),
(8, 'Delaware', 'DE', 'US'),
(9, 'District Of Columbia', 'DC', 'US'),
(10, 'Florida', 'FL', 'US'),
(11, 'Georgia', 'GA', 'US'),
(12, 'Idaho', 'ID', 'US'),
(13, 'Illinois', 'IL', 'US'),
(14, 'Indiana', 'IN', 'US'),
(15, 'Iowa', 'IA', 'US'),
(16, 'Kansas', 'KS', 'US'),
(17, 'Kentucky', 'KY', 'US'),
(18, 'Louisiana', 'LA', 'US'),
(19, 'Maine', 'ME', 'US'),
(21, 'Maryland', 'MD', 'US'),
(22, 'Massachusetts', 'MA', 'US'),
(23, 'Michigan', 'MI', 'US'),
(24, 'Minnesota', 'MN', 'US'),
(25, 'Mississippi', 'MS', 'US'),
(26, 'Missouri', 'MO', 'US'),
(27, 'Montana', 'MT', 'US'),
(28, 'Nebraska', 'NE', 'US'),
(29, 'Nevada', 'NV', 'US'),
(30, 'New Hampshire', 'NH', 'US'),
(31, 'New Jersey', 'NJ', 'US'),
(32, 'New Mexico', 'NM', 'US'),
(33, 'New York', 'NY', 'US'),
(34, 'North Carolina', 'NC', 'US'),
(35, 'North Dakota', 'ND', 'US'),
(36, 'Ohio', 'OH', 'US'),
(37, 'Oklahoma', 'OK', 'US'),
(38, 'Oregon', 'OR', 'US'),
(39, 'Pennsylvania', 'PA', 'US'),
(40, 'Rhode Island', 'RI', 'US'),
(41, 'South Carolina', 'SC', 'US'),
(42, 'South Dakota', 'SD', 'US'),
(43, 'Tennessee', 'TN', 'US'),
(44, 'Texas', 'TX', 'US'),
(45, 'Utah', 'UT', 'US'),
(46, 'Vermont', 'VT', 'US'),
(47, 'Virginia', 'VA', 'US'),
(48, 'Washington', 'WA', 'US'),
(49, 'West Virginia', 'WV', 'US'),
(50, 'Wisconsin', 'WI', 'US'),
(51, 'Wyoming', 'WY', 'US'),
(52, 'Alberta', 'AB', 'CA'),
(53, 'British Columbia', 'BC', 'CA'),
(54, 'Manitoba', 'MB', 'CA'),
(55, 'Newfoundland and Labrador', 'NL', 'CA'),
(56, 'Northwest Territories', 'NT', 'CA'),
(57, 'Nova Scotia', 'NS', 'CA'),
(58, 'Nunavut', 'NU', 'CA'),
(59, 'Ontario', 'ON', 'CA'),
(60, 'Quebec', 'QB', 'CA'),
(61, 'New Brunswick', 'NB', 'CA'),
(62, 'Prince Edward Island', 'PEI', 'CA'),
(63, 'Saskatchewan', 'SK', 'CA'),
(64, 'Yukon', 'YK', 'CA');

-- NEXT_QUERY --

INSERT INTO `shippingtype` (`id`, `name`, `logoimage`, `url`) VALUES
(null, 'DHL', '1276332822_dhl_logo.gif', 'http://www.dhl.com/'),
(null, 'UPS', '1276333065_glo_ups_brandmark.gif', 'http://www.ups.com'),
(null, 'FedEx', '1276333115_express_logo.gif', 'http://fedex.com/');

-- NEXT_QUERY --

INSERT INTO `shipping` (`id`, `shippingcharge`, `shipping_title`, `description`) VALUES
(null, 3.00, 'USPS Shipping Charge (S)', '<p>Small Items such as Gift Cards and items fitting inside a 6&quot;x9&quot; padded envelope</p>\r '),
(null, 0.00, 'Free Shipping', NULL),
(null, 15.99, 'Parcel Force upto 10kg', NULL),
(null, 7.00, 'USPS Shipping Charge (M)', NULL),
(null, 10.00, 'Standard USPS L', ''),
(null, 0.00, 'none', NULL);


-- NEXT_QUERY --

INSERT INTO `vouchers` (`id`, `voucher_title`, `combinable`, `bids_amount`, `newuser_flag`, `validity`, `voucher_type`) VALUES
(null, 'test voucher', '1', 7.00, '0', 5, '2');

-- NEXT_QUERY --

INSERT INTO `page_areas_components` (`id`, `parent`, `name`, `php_replace_vals`, `link`, `link_text`, `ajax_container`) VALUES
(null, 3, 'Main Carousel', '', 'javascript: edit_slider(\'SLIDER1\');', 'Add / Edit Images', 'css-editor'),
(null, 3, 'Main Carousel', 'select id from languages where language = ''english'' and constant = ''SLIDER1'' and value != '''' limit 1', 'javascript: edit_slider(\'SLIDER1\');', 'Edit Content', 'css-editor'),
(null, 3, 'Main Carousel', '', 'javascript: edit_slider(\'SLIDER1\');', 'Edit Slider Effects', 'css-editor'),
(null, 5, 'Page Header', NULL, 'javascript: get_editor(''#header'', ''id'', ''css-editor'');', 'Edit Styles', ''),
(null, 5, 'Page Header', '', 'javascript: change_logo();', 'Logo', 'css-editor'),
(null, 5, 'Main Navigation', '', 'javascript: get_editor(''#navigation'', ''id'', ''css-editor'');', 'Edit Styles', 'css-editor'),
(null, 628, 'Edit Left Column', NULL, 'javascript: get_editor(''#left-column'', ''id'', ''css-editor'');', 'Edit Styles', ''),
(null, 626, 'Look and Feel', NULL, 'javascript: change_template();', 'Template', ''),
(null, 626, 'Look and Feel', NULL, 'javascript: get_editor(''#container'', ''id'', ''css-editor'');', 'Edit Styles', ''),
(null, 648, 'Slider Images', '', 'javascript: ajax_PAS(''include/addons/design_suite/uploader.php?for=flash_banner'', '''', ''get'', ''css-editor'');', 'EditSlider Images', ''),
(null, 629, 'Edit Right Column', NULL, 'javascript: get_editor(''#right-column'', ''id'', ''css-editor'');', 'Edit Styles', ''),
(null, 5, 'User Navigation', '', 'javascript: get_editor(''#navigationBox'', ''id'', ''css-editor'');', 'Edit Styles', 'css-editor'),
(null, 626, 'User Interface', NULL, 'javascript: edit_icons();', 'Change Icons', ''),
(null, 648, 'Slider Styles', NULL, 'javascript:edit_slider_colors(''slider_box'');', 'Edit Effects', ''),
(null, 648, 'Slider Styles', '', 'javascript: get_editor(''#slider_box'', ''id'', ''css-editor'');', 'Edit Styles', ''),
(null, 626, 'User Interface', NULL, 'javascript: change_buttons();', 'Change Buttons', ''),
(null, 627, 'Edit Styles', NULL, 'javascript: get_editor(''#foot'', ''id'', ''css-editor'');', 'Edit Styles', ''),
(null, 631, 'Edit Styles', NULL, 'javascript: edit_slider(\'SLIDER1\');', '', ''),
(null, 633, 'Generic Styling', NULL, 'javascript: get_editor(''.auction-item'', ''class'', ''css-editor'');', 'Edit Styles', ''),
(null, 633, 'Horizontal Boxes', NULL, 'javascript: get_editor(''#horizontal-auctions-box'', ''id'', ''css-editor'');', 'Edit Styles', ''),
(null, 633, 'Vertical Boxes', NULL, 'javascript: get_editor(''#vertical-auctions-box'''', ''id'', ''css-editor'');', 'Edit Styles', ''),
(null, 633, 'Top Auctions', NULL, 'javascript: get_editor(''#bid-products'', ''id'', ''css-editor'');', 'Edit Styles', ''),
(null, 6, 'Replace Values', NULL, 'javascript: edit_slider(\'SLIDER1\');', 'Replace Colors', ''),
(null, 6, 'Replace Values', NULL, 'javascript: edit_slider(\'SLIDER1\');', 'Replace Text', ''),
(null, 6, 'Replace Values', NULL, 'javascript: edit_slider(\'SLIDER1\');', 'Replace Gradient', ''),
(null, 638, 'Edit Constants', NULL, 'javascript: edit_slider(\'SLIDER1\');', 'Edit Constants', ''),
(null, 640, 'Sliders', NULL, 'javascript: edit_slider(\'SLIDER1\');', 'Main Slider', ''),
(null, 642, 'Top Slider', NULL, 'javascript: edit_slider(\'SLIDER1\');', 'Edit Styles', ''),
(null, 642, 'Top Slider', NULL, 'javascript: edit_slider(\'SLIDER1\');', 'Edit Custom Slide', '');

-- NEXT_QUERY --

INSERT INTO `paypal_info` (`id`, `business_id`, `token`, `enabled`, `testmode`, `name`, `additional1`, `additional2`) VALUES
(null, 'buywithjoel@gmail.com', '', 1, 0, 'paypal', '', ''),
(null, 'fedora_1274847084_biz_api1.gmail.com', '1274847091', 0, 0, 'paypalpro', 'AgeazcAgpszFqRoRWdC2nQEk7VS2AKWAtRzM4.hiRRW-9NLMIbYNg.vx', ''),
(null, '8vLAwF38qF', '6sYgn3u3Nx98r5Tb', 1, 0, 'authnet', '', ''),
(null, '811916768017153', '0O-piUExCbMGLiHX7-9k6A', 1, 0, 'googlecheckout', '', ''),
(null, 'payments@example.com', 'M3sptbam', 1, 0, 'moneybooker', '', ''),
(null, '', '', 0, 0, 'payflowlink', '', ''),
(null, '26984535', 'derek@wtshartabina.com', 0, 0, 'paymentasia', 'wtshsb', ''),
(null, '79958a8d-0c7b-4038-8e2e-8948e1d678e1', '', 0, 0, 'ccavenue', '', ''),
(null, '', '', 0, 0, 'mygate', '', ''),
(null, 'gringo_lhp@hotmail.com', '4E438E57BA044247ABA91DF7321EBB16', 0, 1, 'pagseguro', 'EN', ''),
(null, '', '', 0, 1, 'paysitecash', 'EN', ''),
(null, '2134', '096198bffd8b9dd0695a0f7c2704b30a', 0, 1, 'hipay', 'EN', '');

-- NEXT_QUERY --

INSERT INTO `refer_points_admin` (`id`, `num_times_to_dispense`, `bid_points`, `retrieve_condition`) VALUES
(null, 1, '0', 'For refering a friend'),
(null, 5, '10', 'Birthday');

-- NEXT_QUERY --

INSERT INTO `registration` (`id`, `username`, `firstname`, `lastname`, `sex`, `birth_date`, `addressline1`, `addressline2`, `city`, `state`, `country`, `postcode`, `phone`, `email`, `password`, `delivery_name`, `delivery_addressline1`, `delivery_addressline2`, `delivery_city`, `delivery_state`, `delivery_country`, `delivery_postcode`, `delivery_phone`, `terms_condition`, `privacy`, `newsletter`, `account_status`, `newsletter_email`, `final_bids`, `member_status`, `user_delete_flag`, `sponser`, `registration_date`, `registration_ip`, `verifycode`, `admin_user_flag`, `dummy_time`, `free_bids`, `avatarid`, `position`, `infusion_id`, `afilliate`, `vendors`) VALUES
(null, 'edward.goodnow.t', 'Edward', 'Goodnow', 'Male', '05-04-1956', '605 Union St', '', 'Manchester', 'New Hampshire', '226', '03104', '206-339-0569', 'edward.goodnow@gmail.com', 'letmein123', NULL, '', '', '', '', '', '', NULL, 1, 1, 0, 1, NULL, 10235, '0', '', 2, '2013-02-17', '72.73.80.253', 'a7deae6872b8f36b9f54886bfbe6f01f', 0, NULL, 6, 23, '42.9701,-71.4048', NULL, 0, NULL),
(null, 'joelsteele', 'Joel', 'Asadoorian', 'Male', '12-16-1976', '91a hall rd.', '', 'londonderry', 'New Hampshire', '226', '03053', '16034753668', 'buywithjoel@gmail.com', '24kgold', NULL, '', '', '', '', '', '', NULL, NULL, NULL, NULL, 1, NULL, 11837, '0', '', 2, NULL, NULL, 'c09b2a638cbee190a821492af80891e7', 0, NULL, 8, 6, '40.7619,-73.9763', NULL, 0, NULL);

-- NEXT_QUERY --

INSERT INTO `user_ranking_rules` (`id`, `row_to_match`, `rank_name`, `min_amount`, `rank_image`, `bids_awarded`, `free_bids_awarded`, `allow_multiple`, `preference`) VALUES
(null, 'purchased_bids', 'Novice', '0.00', 'yellow_chip.png', 0, 0, 1, 1),
(null, 'time_as_high_bidder', 'Beginner', '0.00', 'yellow_clock.png', 0, 0, 1, 2),
(null, 'used_bids', 'Beginner', '0.00', 'blonde_gavel.png', 0, 0, 1, 3),
(null, 'used_bids', 'Bid Master', '100.00', 'wood_gavel.png', 15, 10, 1, 4),
(null, 'auctions_won', 'Auction Sage', '2.00', 'blue_ribbon.png', 20, 12, 1, 5),
(null, 'auctions_won', 'Auction Genius', '5.00', 'red_ribbon.png', 30, 15, 1, 6),
(null, 'used_bids', 'Heavy Hitter', '200.00', 'green_gavel.png', 50, 15, 1, 7),
(null, 'dollars_spent', 'Shop a Holic', '200.00', 'yellow_dollar.png', 20, 10, 1, 8),
(null, 'dollars_spent', 'Major Gifter', '600.00', 'green_dollar.png', 40, 10, 1, 9),
(null, 'friends_refered', 'Extrovert', '3.00', 'friend_yellow.png', 20, 5, 1, 10),
(null, 'friends_refered', 'Life of the Party', '7.00', 'friend_green.png', 45, 7, 1, 11),
(null, 'friends_refered', 'Great Neighbor', '10.00', 'friend_blue.png', 50, 10, 1, 12),
(null, 'time_as_high_bidder', 'Bid Bunny', '24000.00', 'yellow_clock.png', 5, 5, 1, 14),
(null, 'time_as_high_bidder', 'Bid Guerilla', '48000.00', 'green_clock.png', 7, 5, 1, 15),
(null, 'time_as_high_bidder', 'Bid Assasin', '96000.00', 'red_clock.png', 9, 5, 1, 16),
(null, 'time_as_high_bidder', 'Bid Samurai', '192000.00', 'clock_blue.png', 12, 7, 1, 17),
(null, 'time_as_high_bidder', 'Bid Baron', '384000.00', 'gold_clock.png', 15, 7, 1, 18),
(null, 'used_bids', 'Auction Addict', '500.00', 'purple_gavel.png', 100, 50, 1, 19),
(null, 'dollars_spent', 'Daddy Warbucks', '5000.00', 'blue_dollar.png', 10, 20, 1, 21),
(null, 'auctions_won', 'Auction King', '30.00', 'gold_ribbon.png', 10, 5, 1, 22),
(null, 'friends_refered', 'Bid God', '786000.00', 'gold_clock.png', 20, 20, 1, 23),
(null, 'time_as_high_bidder', 'Bid Ninja', '7860000.00', 'gold_clock.png', 20, 20, 1, 22),
(null, 'purchased_bids', 'Guns a blazin', '100.00', 'yellow_chip.png', 5, 5, 1, 25),
(null, 'purchased_bids', 'In a groove', '200.00', 'purple_chip.png', 15, 7, 1, 26),
(null, 'used_bids', 'Ultimate', '2000.00', 'blue_gavel.png', 200, 50, 1, 43);

-- NEXT_QUERY --

INSERT INTO `config` VALUES (0,'support@dev.pennyauctionsoft.com',3000,3000,3000,20,30,3000,'Live Support Chat!','None of our representatives are available right now, although you are welcome to leave a message!','Please type your name to begin. Entering your email address is optional, although if you would like to be contacted in the future, please add your email address and tick the checkbox before starting your session.','Welcome, A representative will be with you shortly','None of our representatives are currently available.  Please use the form below to send us an email.','Thank you for your message.  We will be in touch as soon as possible!');

-- NEXT_QUERY --

INSERT INTO `language` (`id`, `language`, `languagename`, `enable`, `flag`) values (1,'english','English',1,'gb.gif');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', ' CONTACT_CUSTMER_SUPPORT', 'Contact Customer Service');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', ' CONTACT_CUSTOMER_SUPPORT', 'Contact Customer Service');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', ' Ending Auctions BID', 'These Auctions are ending soon');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', ' USE_DATE_COUPON_HISTORY', 'Date Used');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', '100offlarge', 'The winner of the this auction will get this product for free regardless of the final price.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', '100offsmall', 'The winner of the this auction will get this product for free regardless of the final price.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'ABOUTUS', 'About Us');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'ABOUT_US', 'About us');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'ABOUT_US_FOOTER', 'About Penny Auction Soft');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'ACCEPT', 'Accept');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'ACCEPTED', 'Accepted');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'ACCEPT_DENIED', 'Accept/Denied');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'ACCEPT_WON_AUCTION', 'Accept Won Auction');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'ACCOUNT', 'ACCOUNT');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'ADDITIONAL_INFORMATI', 'Additional Information');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'ADDRESS_LINE', 'Address line');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'ADD_AUCTION_TO_WATCH', 'Add auction to watchlist');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'ADD_AUCTION_TO_WATCHLIST', 'Add To Watchlist');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'ADD_COMMENT', 'Add Comment');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'AFFILIATES', 'affiliates');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'AFFILIATE_CODE', 'Affiliate Code');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'AFFILLIATE_FOOTER', 'Affilliates');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'AFTER_CLICKING_ON_CO', 'Note - After clicking on confirm button points will be automatically debited from your account.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'AFTER_PAYMENT_THE_BI', 'After payment the bids will be booked to your account');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'AFTER_PAYMENT_THE_BIDS_WILL_BE_BOOKED_TO_YOUR_ACCOUNT', 'After payment bids will be booked to your account');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'AFTER_PAYMENT_THE_PR', 'After payment the product,we will send it to you asap');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'ALL_AUCTIONS', 'All Auctions');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'ALL_CATEGORIES', 'All Categories');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'ALL_LIVE_AUCTIONS', 'All Live Auctions');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'ALL_PRICES_ARE_IN_US', 'All prices are in US Dollars');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'ALL_PRICES_ARE_IN_US_DOLLARS', 'All Prices Are In US Dollars');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'ALL_RIGHTS_RESERVED', 'All rights reserved');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'AMERICAN_EXPRESS', 'American Express');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'AMOUNT', 'AMOUNT');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'ANO_WATCHED_AUCTIONS_TO_DISPLAY', 'You Are Not Watching Any Auctions');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'ANTI_SPAM_TRAP_1_FIE', 'Anti-Spam Trap 1 Field Populated');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'ANTI_SPAM_TRAP_2_FIE', 'Anti-Spam Trap 2 Field Populated');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'ANY_QUESTIONS_LEFT', 'Any questions left?');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'AN_EMAIL_WAS_SENT_TO', 'An email was sent to');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'APPLY_COUPON', 'APPLY COUPON');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'APRIL', 'April');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'ARCHIVE', 'Archive');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'ASSIGN_DATE', 'Assign Date');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'ASSIGN_DATE_COUPON', 'Assigned');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'AUCTION', 'AUCTION');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'AUCTIONS', 'AUCTIONS');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'AUCTIONS_CLOSING_SOON', 'Auctions Closing Soon');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'AUCTIONS_WON', 'WINNERS!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'AUCTIONS_YOU_ARE_BID', 'Auctions you are bidding on');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'AUCTIONS_YOU_ARE_BIDDING_ON', 'Auctions You Are Bidding On');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'AUCTION_ACCEPT_PERIO', 'Auction accept period is over');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'AUCTION_ACCEPT_PERIOD_IS_OVER', 'Auction Payment Period is Over');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'AUCTION_ID', 'Auction ID');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'AUCTION_PAYMENT', 'Auction payment');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'AUCTION_PRICE', 'Auction Price');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'AUCTION_SUCCESSFULLY', 'Auction successfully added to your watchlist!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'AUCTION_SUCCESSFULLY_ADDED_TO_YOUR_WATCHLIST', 'Auction Successfully Added To Watchlist');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'AUCTION_TIPS', 'Auction Tips');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'AUCTION_TYPE', 'Auction Type');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'AUCTION_WILLBE_LOCKE', 'this auction will be locked when the %1$s reached at %2$s');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'AUGUST', 'August');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'AUTHOR', 'Author');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'AUTOBIDDER', 'User AutoBidder');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'AUTOBIDDER_ADDED', 'AutoBidder Added');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'AUTO_BIDDER', 'Auto Bidder');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'AVAILABLE_BIDS', 'Available Bids');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'AWESOME_PRIZES', 'Win Awesome Prizes at Amazing Prices');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'AWESOME_TEXT', 'We sell brand name new products every day at amazing low prices. Look at our homepage to see what products are up for auction right now, and if one catches your eye, follow the steps below to start winning bargains');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'A_BEGINNERS_AUCTION_', 'A Beginners Auction is a special auction exclusively for users who havenÃƒÂ‚Ã‚Å½t won before.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'BEGINNERS_AUCTIONS', 'Beginners Auctions');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'beginner_auction', 'Beginner Auctions - Limted to new users only.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'BEST_IN_INDUSRY', 'Best Customer Support in the Industry');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'BEST_IN_INDUSTRY', 'Best Customer Support and Service in the Industry');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'BE_AT_LEAST_6_CHARAC', 'Be at least 6 characters long');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'BID', 'Bid');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'BIDDER', 'Bidder');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'BIDDING', 'Bidding');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'BIDS', 'Bids');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'BIDS_AVAILABLE', 'Available Bids');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'BIDS_PAYMENT', 'Bids Payment');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'BIDS_TAB_HISTORY', 'Bid History');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'BID_ACCOUNT', 'Bid Account');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'BID_AND_WIN', 'Bid and Win');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'BID_CROC', 'Bid Croc');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'BID_FROM', 'Bid From');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'BID_HISTORY', 'Bid History');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'BID_NOW', 'BID NOW');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'BID_ON_CREDIT_PACKS', 'Bid On Credit Packs');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'BID_ON_ITEMS', 'Bid On Items');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'BID_O_MATIC', 'Bid-O-Matic');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'BID_O_MATIC_TITLE', 'Bid-O-Matic auctions let you bid even when you`re away from the computer!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'BID_PACK', 'Bid Pack');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'BID_PACKAGE', 'Bid Packages');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'BID_PRICE', 'Bids cost just $0.50 CAD Buy Bids to start participating in auctions.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'BID_SAFELY_ON', 'Bid Safely On');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'BID_TO', 'Bid To');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'BIRTH_DATE', 'Birth Date');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'blank', 'No Filter Auction - The per bid price is set by [[SITE_NM]] for this auction type, view it on the product page.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'BOOK_AUTOBIDDER', 'Book AutoBidder');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'BUY_A_BIDPACK', 'Buy a BidPack');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'BUY_A_SEAT', 'Buy A Seat');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'BUY_BID', 'Buy Bid');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'BUY_BIDS', 'Buy Bids');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'BUY_BIDS_PAYMENT', 'Buy Bids Payment');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'BUY_BIDS_SUCCESS', 'Buy Bids Success');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'BUY_DATE', 'Buy Date');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'BUY_IT_NOW', 'Buy It Now');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'BUY_NOW', 'Buy Now');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'BUY_PRICE', 'Buy Price');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'BUY_PRODUCT', 'Buy Product');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'BUY_PRODUCT_NOW', 'Buy Product now');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'BUY_THIS_PRODUCT_NOW', 'Buy This Product Now');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'BY', 'by');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'BY_VISA_OR_MASTERCAR', 'By Visa or Mastercard, or via PayPal');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'BY_VISA_OR_MASTERCARD_OR_VIA_PAYPAL', 'Checkout With Visa, MasterCard, American Express, PayPal or Discover Card');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'CAD', 'USD');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'CANCEL', 'Cancel');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'CARD_NUMBER', 'Card Number');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'CARD_TYPE', 'Card Type');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'CATEGORIES', 'Categories');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'centsmall', 'Cent Auction - prices go up one penny at a time');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'CERTAIN_INPUTS_HAVE_', 'Certain inputs have been populated beyond that which is allowed by the form. Therefore you must be trying to post remotely and are probably a spambot. Go away!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'CHANGE', 'Change');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'CHANGE_PASSWORD', 'Change Password');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'CHANGE_YOUR_PASSWORD', 'Change your password');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'CHECK_THIS_BOX_IF_YO', 'Check this box if you want a carbon copy of this email.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'CHECK_THIS_IF_YOU_WANT_CARBON_COPY_OF_THIS_EMAIL', 'Check This Box To Send A Copy Of This Email To Your Inbox');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'CHOOSE_A_BID_PACK', 'Choose A Bid Pack!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'CHOOSE_PAYMENT_METHO', 'Please choose your payment method');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'CHOOSE_PAYMENT_METHOD', 'Please choose a payment method');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'CHOOSE_PRODUCTS', 'Choose Products');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'CITY', 'City');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'CLICK_ACTIVE_YOUR_AC', 'please click on the link in the email and activate your account. Please note that this link is only valid for 48 hours.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'CLICK_BUTTON_TO_SUBM', 'Click Button to Submit Form');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'CLICK_HERE', 'Click Here');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'CLOSE', 'CLOSE');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'CLOSE_ACCOUNT', 'Close Account');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'CLOSE_YOUR', 'Close your');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'CLOSING_AUCTION', 'Closing Auctions');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'COMBINABLE', 'COMBINABLE');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'COMMENTS', 'Comments');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'COMMUNITY', 'Community');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'CONFIG_ACCCESS_NOT_A', 'Config Access Not Allowed');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'CONFIRM_TO_GOT_THE_P', 'do you got the product?');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'CONGRATULATIONS', 'Congratulations');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'CONTACT', 'Contact');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'CONTACT_CUSTMER_SUPPORT', 'Contact Customer Service');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'CONTACT_CUSTOMER_SER', 'Contact a Customer Service Agent Today');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'CONTACT_FOOTER', ' Contact Us');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'CONTACT_FORM', 'Contact Form');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'CONTACT_US', 'Contact us');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'CONTENT', 'Content');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'COPYRIGHT', 'Copyright © 2012 PennyAuctionSoft');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'COST_OF_BIDS', 'Cost Of Bids');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'COUNTDOWN', 'Countdown');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'COUNTRY', 'Country');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'COUPON', 'Coupon');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'COUPON_CODE', 'Coupon Code');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'COUPON_HISTORY', 'Coupon History');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'CREDIT_CARD_NUMBER_I', 'Your credit card number appears to be invalid. Please check your card number making sure that it contains no spaces or other punctuation');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'CUSTOMER_ID', 'Customer ID');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'CUSTOMER_SERVICE', 'Customer Service');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'CUSTOMER_SUPPORT', 'Exceptional Customer Support');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'CVV2_SECURITY_CODE', 'CVV2 Security Code');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'DATE', 'DATE');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'DATE_OF_BIRTH', 'Date of birth');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'DECEMBER', 'December');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'DECREASE', 'decrease ');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'DELETE', 'Delete');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'DELETE_SELECTED_AUCT', 'Delete selected auction from the list');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'DELETE_SELECTED_AUCTION_FROM_THE_LIST', 'Delete Selected Auctions From The Watchlist');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'DELIVERY_AND_SHIPPIN', 'Delivery and Shipping');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'DELIVERY_CHARGE', 'Delivery Charge');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'DELIVERY_COST', 'Delivery cost');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'DENIED', 'Denied');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'DESCRIPTION', 'Description');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'DETAIL', 'Detail');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'DETAILS', 'Details');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'DIALOG_TIMEOUT_CONTE', 'You have been inactive on this site for %1$s minutes, the timer has stopped. Please press ok to continue.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'DIALOG_TIMEOUT_CONTENT', 'Your Session Has Expired Please Click OK To Log Back In');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'DIALOG_TIMEOUT_TITLE', 'Time Out');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'DISCOUNT', 'Discount');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'DISCOUNT_COUPON', 'Discount');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'DISCOVER', 'Discover');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'DONT_WANT_TO_HEAR_AB', 'Don`t want to hear about our great deals any more?');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'DONT_WANT_TO_HEAR_ABOUT_OUR_GREAT_DEALS_ANY_MORE', 'I Don`t Want To Receive Your Newsletter Any More');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'DO_RESPECT_YOUR_PRIV', 'do respect your privacy.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'EMAIL_ADDRESS', 'Email Address');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'EMAIL_ADDRESS_MISMAT', 'Email address mismatch');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'EMAIL_CONFIRMATION', 'Email Confirmation');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'EMAIL_SEND_SUCCESSFU', 'Email send successfully');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'EMAIL_SENT_SUCCESSFU', 'Email sent successfully!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'EMAIL_SUPPORT', 'US Based Email Support');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'EMPTY_FIELDS', 'Empty Field(s)');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'ENDED', 'Ended');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'ENDED_AUCTIONS', 'Ended Auctions');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'ENDING_AUCTIONS', 'Ending Auctions');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'END_DATE', 'End Date');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'END_PRICE', 'End Price');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'ENTER', 'Enter');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'ENTER_ADDRESS', 'Enter Address');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'ENTER_A_COUPONCODE_P', 'Enter a coupon code please');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'ENTER_A_COUPON_CODE', 'ENTER A COUPON CODE');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'ENTER_EMAIL_ADDRESS_', 'Enter email address to invite (separeated by comma)');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'ENTER_EMAIL_ADDRESS_TO_INVITE', '
Please Enter Email Addresses To Invite
');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'ENTER_THE_CODE', 'Enter the code');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'ENTER_THE_COUPON_COD', 'Enter the coupon code please');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'ENTER_YOUR_NEW_TOPIC', 'Enter your new topic');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'ENTER_YOUR_REPLY', 'Enter your reply');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'EXCITING_PRODUCTS', 'Win Exciting Products');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'EXPERATION_DATE', 'Expiration date');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'EXPIRATION_DATE', 'Expiration date');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'EXPIRE', 'Expire');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'EXPIRED', 'Expired');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'EXPIRY_DATE', 'Expiry Date');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'FAQS', 'F.A.Q.s');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'FAQ_FOOTER', 'Frequently Asked Questions');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'FAQ__FOOTER', 'Frequently Asked Questions');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'FEATURED_AUCTIONS', 'Featured Auctions');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'FEBRUARY', 'February');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'FEEDBACK', 'Feedback');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'FEMALE', 'Female');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'FIELDS_WERE_NOT_FILL', 'The following “Required” fields were not filled in. Using your “Back” button, please go back and fill in all required fields.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'FILL_OUT_THE_FORM_BE', 'Fill out the form below');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'FILL_OUT_THE_FORM_BELOW', 'Fill Out The Form Below');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'FILL_YOUR_CREDIT_CAR', 'Please Fill In Your Credit Card Details');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'FILL_YOUR_CREDIT_CARD_DETAILS', 'Please fill in your credit card details');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'FINAL_BID', 'Bid Points');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'FINAL_BIDS', 'Total Bids');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'FINAL_PRICE', 'Final Price');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'FIRST_NAME', 'First Name ');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'FIRST_NAME_ON_CARD', 'First Name on Card');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'fixed', 'Fixed Price Auctions - Users bid for the ability to buy the product at a set price.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'FIXED_PRICE_AUCTION', 'Fixed Price Auction');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'FOLLOW_US', 'Follow Us');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'FOLLOW_US_ON', 'Follow Us On');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'FOLLOW_US_TO_KNOW_AB', 'Follow us to know about latest products and deals!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'FOLLOW_US_TO_KNOW_ABOUT_LATEST_PRODUCTS_AND_DEAL', 'Follow Us TO Know About Our Latest Products and Deals');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'FOLLOW_US_TO_KNOW_ABOUT_LATEST_PRODUCTS_AND_DEALS', 'Follow Us TO Know About Our Latest Deals');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'FOR1', 'For 1');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'FORGET_PASSWORD', 'Forget Password');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'FORGOTTEN', 'Forgotten');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'FORGOT_PASSOWRD', 'Forgot Password');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'FORGOT_PASSWORD', 'Forgot Password?');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'FORM_ID_FIELD', 'Form ID Field');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'FORUM', 'Forum');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'FORUMS', 'Forums');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'FORUM_CONTENT', 'Forum Content');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'FORUM_IS_EMPTY', 'Forum is Empty');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'FOR_THIS_CATEGORY', 'for this category');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'FREE_BIDS', 'Free Bids');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'FREE_BIDS_COUPON', 'Free Bids');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'FREE_POINTS', 'Earn Free Points');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'FREE_POINT_AUCTION_D', 'This is a Free Points Auction. Only Free points from your bid account can be used to bid on this auction.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'FREE_POINT_AUCTION_W', 'Free Point Auction');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'FREE_REGISTRATION', 'Free Registration');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'FROM_W', 'From');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'FULL_NAME', 'Full name');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'FUTURE_AUCTION', 'Future Auction');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'FUTURE_AUCTIONS', 'Future Auctions');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'GBP', 'USD');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'GENDER', 'Gender');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'GET_5_BID_POINTS_ON_', 'Get 5 Bid Points On Registration');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'GET_IN_TOUCH', 'Get in touch');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'GET_START_NOW', 'Join Now !!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'GRANT_THORTON_TEXT', 'Grant Thornton LLP examined our assertions about<br> bidding and shipping controls. View the report below');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'HALF_BACK_BID_AUCTIO', 'This auction will give you half your bids back if you do not win.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'HAVE_A_QUESTION', 'Have a Question?');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'HAVE_FUN_AND_GOOD_LU', 'Have fun and good luck');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'HAVE_YOU_ALREADY_REG', 'Have you already registered?');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'HELP', 'Help');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'HELP_FOOTER', 'Help');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'HELP_TOPICS', 'Help Topics');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'HERE', 'here');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'HERE_YOU_CAN_SEE_OUR', 'Here you can see our all live auctions');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'HIDE', 'Hide');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'HIGH_BIDDER', 'High bidder');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'HOME', 'Home');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'HOME_OF_THE_MOST_EXC', 'home of the most exciting auctions on the internet');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'HOME_OF_THE_MOST_EXCITING_AUCTIONS_ON_THE_INTERNET', 'Home Of The Most Exciting Auctions On The Internet');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'HONEST_BUSINESS', 'Honest Business');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'HOT_DEALS', 'Hot Deals');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'HOW_DOES_QBIDS_WORKS', 'How Does <font style="e;font-size -24px;color -red;"e;>QBIDS</font> Work?');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'HOW_IT_WORKS', 'How It Works');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'HOW_TO_BID', 'How To Bid');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'HOW_TO_BID!', 'How To Bid!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'HOW_TO_BID_CONTENT', 'To Get Started');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'HOW_WORKS', 'How it Works');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'IF_LAST', 'Simply click `Bid` on an auction. If you`re the last bidder, YOU WIN ');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'IF_YOU_CLOSE_YOUR_AC', 'if you close your account you won`t be able to re-register with');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'IF_YOU_CLOSE_YOUR_ACCOUNT_YOU_WONT_BE_ABLE_TO', 'If You Close Your Account You Will Not Be Able To Visit');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'IF_YOU_DONT_RECEIVE_', 'If you didn`t receive this email, try checking your spam filter. If that doesn`t work and you still haven`t received the email, or the stated address is incorrect');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'IF_YOU_HAVENT_GOT_A_', 'If you haven`t got a username or password, you can skip this step.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'IF_YOU_WIN_A_FIX_PRI', 'If you win a Fixed Price Auction, you only pay the price indicated in the heading of the auction (plus delivery costs), regardless of the level the bidding reaches.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'IMAGE', 'Image');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'IMPORTANT', 'Important');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'INCORRECT_COUPON_COD', 'Incorrect coupon code');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'INCREASE', 'increase ');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'INDATE', 'Indate');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'INDATE_COUPON', 'Expires');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'INDEPENDENT_EXAM_REP', 'Grant Thornton<p style="e;font-size -18px;"e;>Independent Examination Report<p>');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'INPUT_MAXLENGTH_VIOL', 'Input Maxlength Violation');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'INPUT_YOUR_PRICE', 'Input Your Price');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'INSTANT_CREDIT', 'Instant Credit');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'INSTEAD_OF', 'Instead of');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'INTERNATIONAL_AUCTIO', 'International auctions');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'INVALID_EMAIL_ADDRES', 'Invalid Email Address');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'INVALID_USERNAME_PAS', 'Invalid username and password');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'INVITE_A_FRIEND', 'Invite a friend');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'INVITE_A_FRIENDS', 'Invite Friends');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'INVITE_FREIND', 'Invite a Freind');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'INVITE_FREINDS', 'Invite a Freind');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'INVITE_FRIENDS', 'Invite a Freind');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'I_ACCEPT_PRIVACY', ' I accept the privacy conditions of');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'I_ACCEPT_TERMS', ' I accept the terms and conditions of');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'I_HAVE_READ_UNDERSTO', 'I have read, understood and accepted');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'I_HAVE_READ_UNDERSTOOD_AND_ACCEPTED ', 'I Have Read and Understand The Rules');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'I_WANT_TO_CLOSE_MY', 'Yes, I want to close my');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'JANUARY', 'January');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'JOBS', 'Jobs');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'JOBS_FOOTER', ' Jobs');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'JOIN_DATE', 'Join Date');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'JOIN_NOW', 'Join Now');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'JULY', 'July');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'JUNE', 'June');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'JUST_CLOSED_AUCTIONS', 'JUST ENDED');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'JUST_ENDED', 'Just Ended');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'LAST_COMMENT_POST_BY', 'Last Comment Post By');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'LAST_DATE_OF_AVAILIB', 'Last date of availibility');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'LAST_DATE_OF_AVAILIBILITY', 'Available Until');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'LAST_DATE_OF_AVAILIBILITY:', 'Last Date Available');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'LAST_DATE_TO_ACCEPT', 'Last Date to Accept');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'LAST_NAME', 'Last Name');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'LAST_NAME_ON_CARD', 'Last Name on Card');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'LAST_POST', 'Last Post');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'LAST_POST_BY', 'Last Post By');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'LATEST_NEWS', 'Latest News');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'LATEST_WINNERS', 'Our Latest Winners');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'LIMIT_PER_HOUSEHOLD', '*Limit 1 account per household!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'LIVE_AUCTION', 'Live Auction');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'LIVE_AUCTIONS', 'Live Auctions');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'LIVE_SUPPORT', 'Live Support');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'locked', 'Locked Auctions - Only users who got in before a specified time are allowed to participate.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'LOCK_AUCTION_DESCRIP', 'Lock auction will be locked at a certain point for new users to jump in. When the price reaches a certain amount the auction will then be locked and only those users who have placed at least 1 bid will be able to bid.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'LOCK_AVAILABLE', 'LOCK AUCTION');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'LOGIN', 'Login');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'LOGIN_AND_CONTACT_US', 'Login and contact us');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'LOGIN_INFORMATION', 'LOGIN Information');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'LOGIN_TEXT', 'Welcome to $SITE_NM, a fun and exciting, fast-paced auction website. Unlike other auction websites, on $SITE_NM you can win all sorts of popular products at incredibly low prices. First, you must register before you can participate in any of our auctions. Simply click the registration button below to get started');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'LOGOUT', 'Logout');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'lowestsmall', 'Place the lowest unique bid price and be the winner');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'LOWEST_UNIQUE_AUCTIO', 'The ÃƒÂ¢Ã¢Â‚Â¬Ã…Â“lowest uniqueÃƒÂ¢Ã¢Â‚Â¬Ã‚Â bid is the bid with the lowest price and only one bidder');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'LOWEST_UNIQUE_AUCTION', 'Lowest Unique Auction');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'LOWEST_UNIQUE_AUCTION_W', 'Lowest Unique Auction');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MAIN', 'Main');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MAKE', 'Make');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MAKE_PAYMENT', 'Make Payment');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MALE', 'Male');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MANAGING_MYACCOUNT', 'Managing Myaccount');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MARCH', 'March');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MASTERCARD', 'MasterCard');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MAY', 'May');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MESSAGE', 'Message');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MESSAGE_ALREADY_HAVE', 'You already have a seat for this auction');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MESSAGE_AUCTION_ENDE', 'This auction have been end already');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MESSAGE_BIDDING_IS_R', 'Your BidBuddy is running you can`t delete it!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MESSAGE_CONFIRM', 'Confirm Message');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MESSAGE_DONT_HAVE_FI', 'Please recharge your bidaccount!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MESSAGE_DONT_HAVE_FR', 'You don`t have sufficient free points in your account!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MESSAGE_DONT_HAVE_SE', 'You don`t have the seat for this auction!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MESSAGE_ENDPRICE_MUS', 'AutoBidder end price must greater than start price!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MESSAGE_ENTER_AUTOBI', 'Please enter AutoBidder bids!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MESSAGE_HAVE_AUCTION', 'You have already bid with this price');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MESSAGE_INVALID_PRIC', 'Invalid Price');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MESSAGE_IS_NOT_SEAT_', 'The auction is not a seat auction');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MESSAGE_LOCK_AUCTION', 'This is lock auction, you must a bidder before the auction locked!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MESSAGE_NOT_REACHED_', 'The seat is not reached to min seats!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MESSAGE_PLEASE_ENTER', 'The bids of the auto bid must more than one');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MESSAGE_REACHED_MAXI', 'The seats the auction is reached to the maximum seat');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MESSAGE_REACHED_TO_M', 'The count of your win auctions is reached to the month limit!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MESSAGE_REACHED_TO_W', 'The count of your win auctions is reached to the week limit');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MESSAGE_STARTPRICE_M', 'AutoBidder start price must greater than end price for reverse auction!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MESSAGE_TITLE', 'Alert Message');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MESSAGE_TOP_BIDDER', 'You are the top bidder');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MIKE_CHERIM', 'Mike Cherim');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MINORS', 'minors');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MORE', 'More');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MORE_AUCTIONS', 'More Auctions');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MORE_OPTIONS', 'MORE OPTIONS');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MY VOUCHERS', 'My Vouchers');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MY_ACCOUNT', 'My Account');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MY_ACTIVE_AUTOBIDDER', 'My active AutoBidder');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MY_ACTIVE_AUTOBIDDER_PAGE', 'My AutoBidders');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MY_AUCTIONS', 'My Auctions');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MY_AUTOBIDDER', 'My AutoBidder');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MY_AVATAR', 'My Avatar');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MY_BIDS', 'My Bids');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MY_BID_ACCOUNT', 'My Bid Account');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MY_BID_ACOUNT', 'My Bid Account');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MY_BUYNOW_HISTORY', 'My BuyNow History');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MY_BUYNOW_LIST', 'My BuyNow List');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MY_BUY_BIDS', 'My Bids ');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MY_BUY_NOW_HISTORY', 'My Buy Now History');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MY_BUY_NOW_LIST', 'My Buy Now List ');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MY_CONTROL_CENTER', 'My Control Center');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MY_COUPON', 'My Coupon');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MY_COUPON_HISTORY', 'My Coupon History');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MY_DETAILS', 'My Details');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MY_REDEMPTIONS', 'My Redemptions');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MY_REFERRAL', 'My Referrals');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MY_SNAPBIDS', 'My Account');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'MY_VOUCHERS', 'My Vouchers');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'nailbiter', 'Nailbiter Auctions - Absolutely no Bid Bots.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'NAME', 'Name');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'NAVIGATION', 'Navigation');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'NAVIGATION_FOOTER', 'LINKS');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'NEWS', 'News');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'NEWSLETTER', 'Newsletter');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'NEWS_DATE', 'News Date');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'NEW_BRAND_NAME_PRODU', 'New, brand name products and amazing prices');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'NEW_BRAND_NAME_PRODUCTS_AND_AMAZING_PRICES', 'New Brand Name Products At Amazing Prices');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'NEW_LETTERS', 'New Letters');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'NEW_TO', 'New to');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'NEW_USER_REGISTRATIO', 'New User Registration');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'NEW_USER_REGISTRATION', 'New User Registration');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'NEXT', 'Next');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'NEXT_PAGE', 'Next Page');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'NIGHT_AUCTION', 'Night auction');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'NO', 'No');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'NOTE_', '<strong>Note - </strong> The input below should <em>not</em> be filled in. It is a spam trap. Please ignore it. If you   populate this input, the   form will return an error.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'NOTE_CODE_AND_MARKUP', 'Note - Code and markup will be removed from all fields');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'NOT_A_MEMBER', 'Not a Member?');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'NOT_REGISTERED_WITH', 'Not registered with');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'NOT_SHIPPED', '(NOT SHIPPED)');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'NOVEMBER', 'November');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'NOW_PRODUCT_TO_SELEC', 'Now product to select to buy');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'NO_ACTIVE_AUTOBIDDER', 'No Active AutoBidders');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'NO_BIDS_PLACED', 'No Bids Placed!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'NO_BUYNOW_TO_DISPLAY', 'No Buy Now to display');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'NO_COUPON_TO_DISPLAY', 'No Coupon to display');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'NO_ENDED_AUCTION_TOD', 'No ended auction to display');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'NO_FORUM_TO_DISPLAY', 'No Forum to display');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'NO_FUTURE_AUCTION_TO', 'No future auction to display');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'NO_LIVE_AUCTIONS_TO_', 'No live auctions to display');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'NO_LIVE_AUCTIONS_TO_DISPLAY', 'No Live Auctions To  Display');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'NO_LIVE_AUCTION_TO_D', 'No live auction to display');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'NO_MESSAGE_TO_DISPLA', 'No Message To Display');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'NO_NEWS_TO_DISPLAY', 'No news to display');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'NO_PROBLEM_JUST_ENTE', 'No problem, just enter your email and we will send the information to your email account.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'NO_PROBLEM_JUST_ENTER_YOUR_EMAIL_AND_WE_WILL_SEND_THE_INFORMATION_TO_YOUR_EMAIL_ACCOUNT', 'No Problem! Just Enter Your Email Below and We Will Send It To You Right Away..');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'NO_REDEMPTION_TO_DIS', 'No redemption to display');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'NO_REDEMPTION_TO_DISPLAY', 'No Redemptions at This Time');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'NO_TOPIC_TO_DISPLAY', 'No Topic To Display ');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'NO_VOUCHERS_TO_DISPL', 'No vouchers to display');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'NO_WATCHED_AUCTIONS_', 'No watched auctions to display');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'NO_WATCHED_AUCTIONS_TO_DISPLAY', 'You are not watching any auctions');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'NO_WORRIES_THE_TEXT_', 'No worries, the text entered here is case-insensitive');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'OCTOBER', 'October');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'OFF', 'off');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'OFFLINE', 'Offline');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'OFF_100', '100% off');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'OFF_THE_RETAIL_PRICE', 'Off the Retail Price');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'OK', 'Ok');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'ONE', '1');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'ONE_CENT_AUCTION', '1 Cent auction');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'ONLINE', 'Online');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'ONLY_NEW_USERS_ARE_ALLOWED_TO_BID_ON_BEGINNER_AUCTIONS', 'Only news users are allowed to bid on beginner auctions');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'OPEN_AUCTION', 'Open Auction');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'OPTIONAL', 'Optional');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'OTHER_AUCTIONS', 'Other Auctions');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'OTHER_INFORMATION', 'Other Information');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'OUR_SITE', 'Our Site');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PACKAGE', 'Package');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PACKAGE_CONTENTS', 'Package Contents');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PAGES', 'Pages');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PAID', '(PAID)');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PASSWORD', 'Password');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PASSWORD_IS_TOO_SHOR', 'Password is too short');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PASSWORD_MISMATCH', 'Password mismatch');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PASSWORD_SECURITY', 'Password security');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PAYMENT', 'PAYMENT');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PAYMENTS_AND_PAYMENT', 'Payments and payment methods');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PAYMENT_CCAVENUE', 'Payment Via CCAvenue');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PAYMENT_COMPLETE', 'Payment Complete');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PAYMENT_FAILED', 'Payment Failed');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PAYMENT_GOOGLE', 'Pay with Google');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PAYMENT_GOOGLE_CHECK', 'Payment via google checkout');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PAYMENT_GOOGLE_CHECKOUT', 'Pay with Google');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PAYMENT_INFORMATION', 'PAYMENT INFORMATION');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PAYMENT_METHODS', 'Payment methods');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PAYMENT_MONEYBOOKER', 'Pay with MoneyBooker');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PAYMENT_MYGATE', 'Payment Via Mygate');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PAYMENT_PAGSEGURO', 'Payment Via Pagseguro');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PAYMENT_PAYPAL', 'Pay with PayPal');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PAYMENT_SUCCESS', 'Payment Success');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PAYMENT_VIA_MONEYBOO', 'Payment Via Moneybooder');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PAYMENT_VIA_MONEYBOOKER', 'Pay with MoneyBooker');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PAYMENT_VIA_PAYFLOWL', 'Payment Via Payflow Link');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PAYMENT_VIA_PAYMENTA', 'Payment Via Paymentasia');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PAY_SAFELY_ON', 'Pay Safely On');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PERIOD_IS_OVER', 'period is over');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PERSONAL_INFORMATION', 'Personal Information');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PHONE_NUMBER', 'Phone Number');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PICK_A_PRODUCT', 'Pick a product you want an HDTV a new iPhone, or a Bid Voucher ');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLACED_BIDS', 'Placed bids');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLACE_BID', 'Place Bid');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLACE_BIDS_AND_WIN', 'Place Bids And Win');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE', 'Please');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_ACCEPT_OUT_PR', 'Please accept Our Privacy Policy');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_ACCEPT_OUT_TE', 'Please accept Our Terms & Conditions');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_CHECK_YOUR_EM', 'Please check your email address. It has been entered incorrectly.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_CHOOSE_WHICH_', 'Please choose which BidPack you`d like to buy');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_CHOOSE_WHICH_BIDPACK', 'Please Choose a Bid Pack');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_CMPLETE_THE_F', 'please complete the following');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_CMPLETE_THE_FOLLOWING', 'Please Confirm The Following');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_CONFIRM_WON_A', 'Please confirm won auction');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_CONFIRM_YOUR_', 'Please confirm your registration');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_ENTER_ADDRESS', 'Please enter address');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_ENTER_AUCTION', 'Please enter auction ID');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_ENTER_CITY', 'Please enter city');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_ENTER_CONFIRM', 'Please enter confirm email address');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_ENTER_CORRECT', 'Please Enter Correct Security Code');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_ENTER_EMAIL', 'Please enter email address!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_ENTER_EMAILAD', 'Please enter emailaddress');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_ENTER_EMAIL_A', 'Please Enter Email Address');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_ENTER_FIRST_N', 'Please enter first name');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_ENTER_FIRST_NAME', 'Please Enter First Name');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_ENTER_LAST_NA', 'Please enter last name');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_ENTER_LAST_NAME', 'Please Enter Last Name');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_ENTER_MESSAGE', 'Please enter message!!!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_ENTER_NAME', 'Please Enter Name');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_ENTER_NEW_PAS', 'Please Enter New Password ');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_ENTER_PASSWOR', 'Please enter password');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_ENTER_PHONE_N', 'Please enter phone number');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_ENTER_POSTCOD', 'Please enter postcode');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_ENTER_SECURIT', 'Please Enter Security Code');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_ENTER_TOPIC_C', 'Please enter topic content!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_ENTER_TOPIC_T', 'Please enter topic title!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_ENTER_USERNAM', 'Please enter username');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_ENTER_VALID_E', 'Please enter valid email address');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_ENTER_VALID_EMAIL_ADDRESS', 'Please Enter A Valid Email Adress');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_ENTER_VALID_R', 'Please enter valid referrer code or skip it');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_ENTER_YOUR_CA', 'Please enter your card name');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_ENTER_YOUR_LO', 'Please enter your login data here');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_ENTER_YOUR_NE', 'Please enter your new password');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_ENTER_YOUR_NEW_PASSWORD', 'Please Enter Your New Password');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_MAKE_A_SELECT', 'Please make a selection');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_MAKE_A_SELECTION', 'Please Make A Selection');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_RETYPE_PASSWO', 'Please retype password');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_RETYPE_YOUR_N', 'Please retype your new password');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_RETYPE_YOUR_NEW_PASSWORD', 'Please Retype Your New Password');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_SELECT', 'Please select');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_SELECT_ACCEPT', 'Please select accept or denied!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_SELECT_BIRTH_', 'Please select birth date');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_SELECT_COUNTR', 'please select country');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_SELECT_COUNTRY', 'Please Select a Country');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_SELECT_STATE', 'please select state<');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_SELECT_SUBJEC', 'please select subject');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_SELECT_VOUCHE', 'Please select voucher');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_SELECT_YOUR_S', 'Please select your subject');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_TAKE_A_LOOK', 'Please take a look');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_VALID_EMAIL_A', 'Please enter valid email address');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLEASE_VALID_EMAIL_ADDRESS', 'Please Enter A Valid Email');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PLESE_CHECK_YOUR_INP', 'Please fill all the require filed');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'POINTS', 'Points');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'POSTAL_CODE', 'ZIP/Postal Code');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'POSTS', 'Posts');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'POST_REPLY', 'Post Reply');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'POST_TOPIC', 'Post Topic');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PREVIOUS', 'Previous');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PREVIOUS_PAGE', 'Previous Page');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PRICE', 'Price');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PRICE_BIDDER', 'Bid Price');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PRIVACY', 'Privacy');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PRIVACY_FOOTER', ' Privacy Policy');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PRIVACY_POLICY', 'Privacy Policy');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PRODUCT', 'Product');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'Products', 'PRODUCTS');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PRODUCT_DETAILS', 'PRODUCT DETAILS');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PRODUCT_NAME', 'Product Name');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PRODUCT_PAYMENT', 'Product Payment');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PRODUCT_PRICE', 'Product Price');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PRODUCT_SENT', 'Product sent');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PRVICAY_POLICY', 'Privacy Policy');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PURCHASED_BIDS', 'Purchased Bids');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'PURCHASE_PRICE', 'Purchase Price');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'QUESTIONS_ABOUT', 'Questions about');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'QUESTION_OR_CONCERN', 'Contact Customer Service');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'QUICK_HELP_LINKS', 'Quick Help Links');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'QUICK_LINKS', 'Quick Links');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'RATE_IT', 'Rate It');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'READ_MORE', 'Read More');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'REDEEM', 'Redeem');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'REDEMPTION', 'Redemption');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'REDEMPTION_DETAILS', 'Redemption Details');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'REDEMPTION_PAYMENT', 'Redemption payment');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'REDEMPTION_POINTS', 'Redemption Points');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'REFERRAL', 'Referral');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'REFER_A_FRIEND', 'Refer A Friend');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'REGISTER', 'Register');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'REGISTER_FOOTER', ' Register Now');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'REGISTER_FREE', 'Register Free!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'REGISTER_NOW', 'Register Now');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'REGISTER_NOW_ITS_FRE', 'REGISTER NOW IT`S FREE');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'REGISTRATION', 'Registration');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'REPLY_SUBMITED_SUCCE', 'Reply Submited Successfully !!!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'REPORT_ABUSE', 'Report Abuse');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'REQUIRED', 'Required');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'REQUIRED_FILED', 'this filed is required');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'REQUIRED_FILELD_MISS', 'Required Field(s) Missed');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'RESULTS', 'Results');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'RETAIL VALUE', 'RETAIL PRICE');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'RETAIL_VALUE', 'Retail Price');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'RETURE', 'Return');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'RETYPE_EMAIL_ADDRESS', 'Retype Email Address');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'RETYPE_PASSWORD', 'Retype Password');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'REVERSE_AUCTION', 'Reverse');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'REVERSE_AUCTION_DESC', 'The price will fall when you place a bid.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'REVERSE_AUCTION_W', 'Reverse Auction');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'REVIEW_PURCHASE', 'Review Your Purchase');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'RULES', 'Rules');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'RULES_FOOTER', 'Rules');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'RUNNING', 'Running');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'SAVINGS', 'Savings');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'SEARCH', 'Search');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'seated', 'Seated Auctions - Only users who first bought seats are allowed to participate.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'SEATS_AVAILABLE', 'SEATS AVAILABLE');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'SEAT_AUCTION_DESCRIP', 'Seated Auction will begin<br> when all seats are purchased');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'SEAT_AUCTION_DESCRIPTION', 'Auction Starts When The Seats Are Filled');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'SEAT_BIDS', 'Seat Bids');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'SECURE_AND_ACCESSIBL', 'Secure and Accessible');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'SECURE_PAYMENTS', 'Secure Checkout');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'SECURITY', 'Security');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'SELECT_ACCEPT_OR_DEN', 'Please Select Accepted or Denied!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'SELECT_BIRTHDAY_DATE', 'please select the Date of Birth');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'SELECT_CATEGORY', 'Select A Category');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'SELECT_MY_AVATAR', 'Select My Avatar');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'SELECT_ONE', 'select one');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'SELECT_THIS_PACKAGHE', 'Select this package');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'SEND', 'Send');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'SEPTEMBER', 'September');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'SHARE_THE_FUN_USING', 'Share The Fun Using');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'SHIPMENT_AND_RETURNS', 'Shipment and Returns');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'SHIPPED', '(SHIPPED)');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'SHIPPING', 'Shipping');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'SHIPPING_CHARGE', 'Shipping Charge');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'SHOW', 'Show');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'SHOW_YOUR_ALL_REDEMP', 'to show your all redemptions');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'SIGN_IN', 'Sign In');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'SIGN_UP_AND_BUY', 'Sign Up And Buy Bids');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'SIGN_UP_NOW', ' Sign Up Now');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'SINGLE_BID', 'Single Bid');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'SITE_NM', 'PennyAuctionSoft');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'SKIP_LOGIN', 'SKIP LOGIN');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'SLIDER1', '<div class="content how" id="howItWorks" style="background-image: url(img/how.jpg);height:250px;width:700px;"><h2 style="font-weight:bold;font-size:20px;margin-left:22px;color:#ee6300;">How Does [[SITE_NM]] Work?</h2><table colspan="3" style="position:absolute;left:50px;top:100px;" width="100%"><tbody><tr><td height="100%" style="color:#333333;" valign="top" width="33%"><div style="position:relative;top:30px;"><p style="font-weight:bold;font-size:13px;margin-top:-10px;margin-bottom:4px;">Signup and Buys Bids</p>Bids Cost Just <span style="color:red;">0.60 USD</span> Buy.<br />Bids bids to start participating<br />in auctions.</div></td><td height="100%" style="color:#333333;" valign="top" width="33%"><div style="position:relative;top:30px;"><p style="font-weight:bold;font-size:13px;margin-top:-10px;margin-bottom:4px;">Choose What?</p>Pick a Product you want -<br />an <span style="color:red;"> gift card of your choice<br />or a Bid Voucher.</span></div></td><td height="100%" style="color:#333333;" valign="top" width="33%"><div style="position:relative;top:5px;left:-10px;"><p style="font-weight:bold;font-size:13px;margin-bottom:2px;">Place Bids and Win!</p>Simply click <span style="color:red;">&quot;Bid&quot;</span>on an<br />auction. If you are<br />the last bidder<br /><span style="color:red;">YOU WIN!</span></div></td></tr><tr><td align="left" colspan="2" height="100%" valign="top"><h3 style="font-size:18px;font-weight:bold;text-align:center;position:relative;left:-50px;"
>Sign Up and <font style="color:red;font-size:18px;">Start Winning</font> Today!</h3></td><td colspan="1" height="100%" valign="middle"><div style="background-size:100% 100%;background-image:url(`img/login-btn-bg.png`);font-size:18px;background-repeat:no-repeat;color:white;font-weight:bold;text-align:center;position:relative;top:0px;left:-80px;">Register Now!</div></td></tr></tbody></table></div>');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'SLIDER2', '<div class="content bbb" id="audited" style="display: block;"><a href="contact.php" target="_new"></a></div>');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'SLIDER3', '<div class="content winners" id="winnersDaily"><div style="position:relative;top:15px;left:150px;color:white;font-size:32px;font-weight:bold;">There are 100&#39;s of <span style="font-size:36px;font-style:italic;color:white;">Winners</span><br />Every Day on <span style="font-size:36px;font-style:italic;color:white;">[[SITE_NM]]</span><ul style="list-style-type:none; position:relative;margin-left:150px;margin-top:20px;color:white;font-size:14px;"><li>Bid on Brand Name Ladies Apparel</li><li>Save up to 95% Off on our products.</li><li>Never Pay Retail Again!</li></ul></div></div>');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'SLIDER4', '<div class="content badges" id="badges" style="color: #383838;"><div style="position: relative; left: 300px; top: 20px; font-weight: bold; font-size: 22px; font-style: italic; max-width: 350px;"><span style="color: #f56300;">Earn Free Points</span> which show off your skill and award you with <span style="color: #f56300; font-size: 24px; margin-left: 100px;">Free Bids</span></div><div style="position: relative; top: 40px; left: 330px; font-size: 14px; font-weight: bold; color: #383838; max-width: 350px;">Points are a great way to gain experience,<br />set goals, and earn <span style="color: #f56300; font-style: italic; font-size: 15px;">Free Bids</span> for being a<br />valuable <span style="color: #f56300; font-style: italic; font-size: 15px;">[[SITE_NM]]</span> customer<br /><img alt="" src="img/login-slider.png" style="margin-top: 10px; margin-left: 50px;" /> </div></div> ');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'SLIDER5', '<div class="content support" id="support" style="display: block;"><a href="contact.php" class="signup"><h2 style="font-size:20px;"><a href="[[SITE_URL]]contact.php">[[SITE_NM]]</a><br /><span style="font-size: 16px;">The Best Customer Service In The Industry</span></h2><ul style="margin-top:40px;"><li>Quick and Easy Support</li><li>US Based Email Support</li><li>Best Customer Support in the Industry</li></ul></a></div>');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'SMS_BID', 'SMS Bid');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'SNAPBIDS_101', 'Snapbids 101');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'SOLD', 'sold');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'SORRY_WE_DIDNT_FIND_', 'Sorry, We didn`t find your email address in our system');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'SORRY_YOUR_PAYMENT_P', 'Sorry, Your Payment process was not succesfull');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'SORRY_YOU_DONT_WON_A', 'Sorry, you don`t won any auction yet');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'SORRY_YOU_DONT_WON_ANY_AUCTION_YET', 'You Have Not Won Any Auctions Yet');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'START', 'START');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'START_PRICE', 'Start Price');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'STATE', 'State');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'STATUS', 'Status');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'STAY_CONNECTED', 'Stay Connected');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'STEP_ONE', 'Step One');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'STEP_THREE', 'Step Three ');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'STEP_TWO', 'Step Two ');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'SUBJECT', 'Subject');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'SUBMIT', 'SUBMIT');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'SUBSCRIBE', 'SUBSCRIBE');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'SUBSCRIBE_TO_NEWSLET', 'Subscribe to newsletter ');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'SUBSCRIBE_TO_NEWSLETTER', 'Subscribe To Our Newsletter');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'SUBTOTAL', 'Subtotal');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'SUPPORT', 'Exceptional Customer Support');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'SUPPORT_US', 'Support Us');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'TAX_AMOUNT', 'Tax Amount');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'TEAM', 'Team');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'TECHNICAL_PROBLEMS', 'Technical Problems');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'TERMS_AND_CONDITIONS', 'Terms and Conditions');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'TERMS_CONDITIONS', 'Terms & Conditions');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'TERMS_CONDITIONS_FOO', ' Terms and Conditions');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'TERMS_CONDITIONS_FOOTER', 'Terms and Conditions');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'TEST_1', 'is great My grandsons wanted iPods for Christmas, but I am out of work. Through $SITE_NM, I was able to get them, one for as little as $2.82; plus I won $475 in gift cards, one for as little as $0.60');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'TEST_1_NAME', 'Thomas Cooper');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'TEST_2', 'There couldn`t be a happier Panny Auctioner than me right now My husband and I really needed a getaway. Luckily, I won 2 Visa gift cards totaling $150 These gift cards will give my husband and I the much needed weekend away.  I can`t wait to share this with him');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'TEST_2_NAME', 'Thomas C., Madison, WI');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'TEST_3', 'As I was bidding, my roommate was asking me how it was going. Gazing at the screen, I watched the timer read "e;3...2...1... SOLD"e; winning me this VIZIO 32"e; HDTV for $2.60. Answering his question, I did some awesomeair kicks to liberate my adrenaline');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'TEST_3_NAME', 'Cyril B.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'TEST_4', 'For my friend`s 23rd birthday, I gave her a 32GB iPod Touch that I won on Penny Auction Boutique. She was so excited when she got it that she showed everybody. When she shared how I got it for $15 and received it three days later, they couldn`t believe it If you are a fan of exciting auctions, this is the site for you');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'TEST_4_NAME', 'Jenny W.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'THANK_YOU_FOR_SUBSCR', 'Thank you for subscribing to our newsletter.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'THAT_S', 'That`s');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'THESE_AUCTIONS_ARE_A', 'test');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'THESE_AUCTIONS_ARE_ABOUT_TO_END', 'These auctions are about to end!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'THE_CHANCE_TO_WIN_AM', 'The chance to win amazing products at amazing prices');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'THE_CHANCE_TO_WIN_AMAZING_PRODUCTS_AT_AMAZING_PRICES', 'Win Amazing Products at Amazing Prices');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'THE_EMAIL_ADDRESS_AL', 'This Email Address Already Exists');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'THE_EMAIL_ADDRESS_YO', 'The email address you have submitted seems to be invalid. Using your “Back” button, please go back and check the address you entered. Please try not to worry,');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'THE_FOLLOWING_REQUIR', 'The following “Required”');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'THE_PRODUCT_DONT_ALL', 'The product don`t allow to buy it now');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'THE_WORTH_UP_TO_PRIC', 'The "e;worth up to"e; price reflects the manufacturers suggested retail price.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'THE_WORTH_UP_TO_PRICE_REFLECTS_THE_MANUFACTURERS_SUGGESTED_RETAIL_PRICE', 'The Worth Up To Price Reflects The Manufacturers Suggested Retail Price');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'THIS_ACCOUNT_IS_NOT_', 'This account is not verified yet. Please verify first.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'THIS_AUCTION_ENDED_O', 'This auction ended on');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'THIS_AUCTION_WILL_EN', 'This auction will end earliest on');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'THIS_AUCTION_WILL_END_LATEST_ON', 'This Auction is Scheduled To End ');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'THIS_CONFIRMS_YOUARE', 'This confirms you`re a human user');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'THIS_USERNAME_ALREAD', 'This Username Already Exists');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'THIS_USERNAME_ALREADY_EXISTS', 'This Username Already Exists');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'TITLE', 'Title');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'TITLE_COUPON', 'Title');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'TOPICS', 'Topics');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'TOPIC_SUBMITED_SUCCE', 'Topic Submited Successfully !!!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'TOTAL', 'Total');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'TOTAL_COMMENT', 'Total Comment');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'TOTAL_COST', 'Total Cost');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'TOTAL_PACKAGE_COST', 'Total Package Cost');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'TOTAL_PAYMENT', 'Total Payment');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'TOTAL_POST', 'Total Post');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'TOTAL_PRICE', 'Total Price');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'TOWN_CITY', 'Town/City');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'TO_AVOID_ABUSES_WE_D', 'To avoid abuses we do not allow you to edit your details once registered.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'TO_AVOID_ABUSES_WE_DONOT_ALLOW_YOU_TO_EDIT_YOUR_DETAILS_ONCE_REGISTEREDED', 'For Security Reasons We Do Not Allow You To Change These Details Once You Have Registered');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'TO_CONTINUE', 'to continue...');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'TO_FIND_AN_INCREDIBL', 'to find an incredible bargains.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'TO_FIND_INCREDIBLE_B', 'to find incredible bargains');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'TO_GO_BACK', 'to go back.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'TO_RECHARGE_ACCOUNT', 'to recharge your account.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'TO_REGISTER_WITH', 'To register with');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'TRACK_NUMBER', 'Track Number');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'TWITTER', 'Twitter');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'TYPE', 'Type');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'UNSUBSCRIBE', 'UNSUBSCRIBE');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'UNSUBSCRIBE_TO_NEWSL', 'Unsubscribe to newsletter');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'UNSUBSCRIBE_TO_NEWSLETTER', 'Unsunscribe To Our Newsletter');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'USD', 'USD');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'USD_ONLY', 'USD Only');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'USED', 'Used');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'USER', 'User');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'USERNAME', 'Username');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'USERNAME_IS_TOO_SHOR', 'Username is too short');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'USERNAME_OR_PASSWORD', 'username or password');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'USER_REMOVED', 'user removed');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'USE_DATE', 'Use Date');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'USE_DATE_COUPON_HISTORY', 'Date Used');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'USING_THIS_EMAIL_ADD', 'this email address for two months. Please also note that you will lose any bids you currently have in your account.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'USING_THIS_EMAIL_ADDRESS_FOR_TWO_MONTHS', 'Using This Email Address For Two Months');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'VALID_TO', 'VALID TO');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'VALUE', 'Value');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'VIEW_ALL_LIVE_AUCTIO', 'All Live Auctions');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'VIEW_ALL_LIVE_AUCTIONS', 'View Live Auctions');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'VISA', 'Visa');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'VOUCHERS', 'Vouchers');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'VOUCHER_LABEL', 'VOUCHER LABEL');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'WANT_US_TO_LET_YOU_K', 'Want us to let you know about new acutions and special offers?');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'WANT_US_TO_LET_YOU_KNOW_ABOUT_NEW_AUCTIONS_SPECIAL_OFFERS', 'Do You Want Us To Let You Know About New Auction And Special Offers');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'WATCHED_AUCTIONS', 'Watched Auctions');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'WELCOME', 'Welcome');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'WELCOME_BACK', 'Welcome Back');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'WELCOME_CONTENT', 'Check out our new Avatar feature located on the right. You will see this pop up next to your name on the auctions you bid on! Choose one if you have not already done so. Also, check out Penny Auction Soft where you will find amazing articles from bidding secrets to customer testimonials.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'WELCOME_TO', 'Welcome to');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'WE_ACCEPT', 'We Accept');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'WE_WILL_SEND_THE_PRO', 'We will send the product as soon as possible.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'WHAT_IS', 'What is ');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'WHERE_AN_AUCTION_IS_', 'An open auction is a regular auction. For every bid the price will be raised $0.10.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'WHO_JUST_WON', 'Who Just Won');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'WHY_ASK', 'Why ask');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'WIN', 'Win');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'WINNER', 'Winner');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'WINNERS', 'Hundreds of winers daily');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'WITHIN_DAYS_IN_THE_O', 'Within 14 days in the original packaging');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'WITHIN_DAYS_IN_THE_ORIGINAL_PACKAGING', 'Within 14 Days in Original Packaging');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'WITH_EACH_BID_PRICE_', 'With each bid the price will ');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'WITH_EACH_BID_PRICE_WILL', 'With Each Bid The Price Will');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'WITH_EVERY_BID_THE_P', 'With every bid the price is raised by only one cent instead of the usual $0.10');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'WON_AUCTIONS', 'Won Auctions');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'WON_AUCTION_PAYMENT', 'Won auction payment');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'WON_AUCTION_PAYMENT_', 'Won Auction Payment Received Succesfully');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'WORTH_UP_TO', 'Worth up to');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'YES', 'Yes');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'YES_I_WANT_TO_RECEIV', 'Yes, I want to receive');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'YES_I_WANT_TO_RECEIVE', 'Yes I want to Recieve');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'YOUR', 'Your');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'YOURE_WINNING_BID', 'Your winning bid');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'YOUR_ACCOUNT_IS_DELE', 'Your account is deleted by');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'YOUR_ACCOUNT_IS_SUSP', 'Your account is suspended by');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'YOUR_AFFILIATE_CODE', 'Your Affiliate Code');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'YOUR_AFFILIATE_URL', 'Your Affiliate URL');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'YOUR_AUTOBIDDER_IS_R', 'Your AutoBidder is running you can`t delete it!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'YOUR_CREDIT_CARD_CCV', 'Your Credit Card CCV/AMEX number appears to be invalid');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'YOUR_CURRENT_aCCOUNT', 'Your current bid account balance is not sufficient to bid on this auction<br >please recharge your account.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'YOUR_DATA', 'Your Data');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'YOUR_EMAIL', 'Your Email');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'YOUR_EMAIL_TO', 'Your Email to');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'YOUR_EMAIL_VERIFICAT', 'Your email verification is confirmed successfully');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'YOUR_PASSWORD_HAS_BE', 'Your password has been changed');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'YOUR_POSTAL_ADDRESS', 'Your Postal Address');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'YOUR_PRICE', 'Your Price');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'YOUR_THE', 'Your The');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'YOUR_TRANSACTION_FOR', 'Your transaction for redemption completed successfully!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'YOUR_TRANSACTION_HAS', 'Your transaction has completed successfully.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'YOUVE_WON', 'You`ve won!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'YOU_ARE_NOT_BIDDING_', 'You are not bidding on any auctions');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'YOU_ARE_NOT_BIDDING_ON_ANY_AUCTIONS', 'You are not biding on any auctions');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'YOU_CANT_GIVE_RATING', 'You can not give rating more than one time on per community!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'YOU_CAN_BID_NOW', 'You can Bid now.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'YOU_DONOT_HAVE_ANY_R', 'You do not have any redemptions in your account yet');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'YOU_DONT_CURRENTLY_H', 'You don`t currently have any AutoBidders');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'YOU_DONT_CURRENTLY_HAVE_ANY_AUTOBIDDERS', 'You Do Not Currently Have Any AutoBiders');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'YOU_DO_NOT_HAVE_ANY_', 'You do not have any bids in your account yet');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'YOU_DO_NOT_HAVE_SUFF', 'You do not have sufficient points in your account to redeem this product');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'YOU_DO_NOT_HAVE_SUFFICIENT_POINTS_IN_YOUR_ACCOUNT_TO_REDEEM_THIS_PRODUCT', 'You do not have sufficient points in your account to redeem this product');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'YOU_HAVE_ALREADY_ACC', 'You have already accept/denied this auction!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'YOU_HAVE_CHOOSEN', 'You have choosen');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'YOU_HAVE_CURRENTLY_S', 'You have currently selected');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'YOU_HAVE_CURRENTLY_SELECTED', 'Current Selection');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'YOU_HAVE_FORGOTTEN_Y', 'You have forgotten your login data?');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'YOU_HAVE_FORGOTTEN_YOUR_LOGIN_DATA', 'You Have Forgotten Your Login Information?');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'YOU_HAVE_PURCHASED', 'You have purchased');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'YOU_HAVE_UNSUBSCRIBE', 'Your have unsubscribed from our newsletter ...');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'YOU_MUST_BE_LOGGED_I', 'You must be logged-in to do that! Do you wish to login?');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'YOU_POPULATED_A_SPAM', 'You populated a spam trap anti-spam input that is meant to confuse automated spam-sending machines. If you accidently entered data in this field, using your “Back” button, please go back and remove it before submitting this form. Sorry for the confusion.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', 'ZIP_CODE', 'ZIP Code');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', '[[BID_SAFELY_ON]]', 'Bid Safely On');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', '[[HOME]]', 'Home');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', '[[HOW_WORKS]]', 'How it Works');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', '[[PLEASE_SELECT_COUNTRY]]', 'Please Select a Country');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', '[[PRVICAY_POLICY]]', 'Privacy Policy');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', '[[STAY_CONNECTED]]', 'Stay Connected');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'english', '[[WHAT_IS]]', 'What is ');

-- NEXT_QUERY --

INSERT INTO `language` (`id`, `language`, `languagename`, `enable`, `flag`) values (2,'french','French',1,'fr.gif');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', '', 'Error: Invalid request');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'ABOUTUS', 'Qui sommes-nous');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'ABOUT_US', 'À propos de nous');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'ABOUT_US_FOOTER', 'À propos de Penny Soft enchères');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'ACCEPT', 'accepter');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'ACCEPTED', 'acceptée');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'ACCEPT_DENIED', 'Accepter / Refusé');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'ACCEPT_WON_AUCTION', 'Accepter enchère remportée');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'ACCOUNT', 'COMPTE');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'ADD', 'Ajouter');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'ADDITIONAL_INFORMATI', 'Informations complémentaires');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'ADDITIONAL_INFORMATION', 'Informations complémentaires');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'ADDRESS_LINE', 'Adresse ligne');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'ADD_AUCTION_TO_WATCH', 'Ajouter aux enchères à la liste');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'ADD_AUCTION_TO_WATCHLIST', 'Ajouter à la liste');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'ADD_COMMENT', 'Ajouter un commentaire');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'AFFILIATES', 'Affiliés');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'AFFILIATE_CODE', 'Affiliate Code');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'AFFILLIATE_FOOTER', 'AFFILIES');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'AFTER_CLICKING_ON_CO', 'Remarque - Après avoir cliqué sur confirment points de boutons sera automatiquement débité de votre compte.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'AFTER_CLICKING_ON_CONFIRM_BUTTON_POINTS_WILL_BE_AUTOMATICALLY_DEBITED_FROM_YOUR_ACCOUNT', 'Note: Après avoir cliqué sur ce bouton, vous serez automatiquement débité.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'AFTER_PAYMENT_THE_BI', 'Après paiement des soumissions seront réservés à votre compte');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'AFTER_PAYMENT_THE_BIDS_WILL_BE_BOOKED_TO_YOUR_ACCOUNT', 'Après règlement, les enchèrent seront ajouter dans votre compte');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'AFTER_PAYMENT_THE_PR', 'Après paiement du produit, nous allons vous le faire parvenir dès que possible');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'AFTER_PAYMENT_THE_PRODUCT_WE_WILL_SEND_IT', 'Après réception de votre paiement, nous ferons parvenir le produit le plus rapidement');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'ALL_AUCTIONS', 'Enchères');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'ALL_CATEGORIES', 'toutes les catégories');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'ALL_LIVE_AUCTIONS', 'Tous les Enchères en Direct');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'ALL_PRICES_ARE_IN_US', 'Tous les prix sont en dollars américains');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'ALL_PRICES_ARE_IN_US_DOLLARS', 'Tous les prix sont en dollars américains');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'ALL_RIGHTS_RESERVED', 'Tous droits réservés');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'AMERICAN_EXPRESS', 'american Express');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'AMOUNT', 'MONTANT');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'ANO_WATCHED_AUCTIONS_TO_DISPLAY', 'Vous ne regardez pas toutes les enchères');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'ANTI_SPAM_TRAP_1_FIE', 'Anti -Spam Trap 1 Champ Peuplé');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'ANTI_SPAM_TRAP_1_FIELD_POPULATED', 'Trap Anti-Spam Emplacement 1');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'ANTI_SPAM_TRAP_2_FIE', 'Anti-Spam Piège 2 Champ Peuplé');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'ANTI_SPAM_TRAP_2_FIELD_POPULATED', 'Trap Anti-Spam Emplacement 2');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'AN_EMAIL_WAS_SENT_TO', 'Un e-mail a été envoyé à');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'APPLY_COUPON', 'APPLIQUER COUPON');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'APRIL', 'Avril');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'ARCHIVE', 'Archive');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'ASSIGN_DATE_COUPON', 'assigné');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'AUCTION', 'VENTE AUX ENCHÈRES');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'AUCTIONS', 'ENCHÈRES');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'AUCTIONS_CLOSING_SOON', 'Enchères : bientôt clos');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'AUCTIONS_YOU_ARE_BID', 'Enchères vous offrez sur');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'AUCTIONS_YOU_ARE_BIDDING_ON', 'Enchères Vous offrez sur');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'AUCTION_ACCEPT_PERIO', 'Enchères de acceptent période est terminée');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'AUCTION_ACCEPT_PERIOD_IS_OVER', 'Enchères Période de paiement terminée');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'AUCTION_DETAILS', 'Détails de la vente');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'AUCTION_ID', 'ID Enchère');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'AUCTION_SUCCESSFULLY', 'Enchères ajouté à votre liste !');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'AUCTION_SUCCESSFULLY_ADDED_TO_YOUR_WATCHLIST', 'Vente aux enchères ajouté avec succès à la liste');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'AUCTION_TIPS', 'Conseils aux enchères');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'AUCTION_TYPE', 'Type de vente');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'AUCTION_WILLBE_LOCKE', 'cette vente aux enchères sera verrouillée lorsque le % 1 $ s atteint à % 2 $ s');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'AUGUST', 'Août');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'AUTHOR', 'auteur');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'AUTOBIDDER', 'Autobidder utilisateur');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'AUTOBIDDER_ADDED', 'Autobidder Ajouté');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'AUTO_BIDDER', 'Offrant Auto');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'AVAILABLE_BIDS', 'Les offres disponibles');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'AWESOME_PRIZES', 'Gagner des prix exceptionnels à des prix incroyables');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'AWESOME_TEXT', 'Nous vendons nom de marque de nouveaux produits tous les jours à bas prix étonnant . ');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'BEGINNERS_AUCTIONS', 'Enchère débutant');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'BE_AT_LEAST_6_CHARAC', 'Soyez au moins 6 caractères');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'BE_AT_LEAST_6_CHARACTERS_LONG', 'Be at least 6 characters long');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'BID', 'offre');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'BIDDER', 'soumissionnaire');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'BIDDING', 'enchères');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'BIDS', 'Enchères');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'BIDS_AVAILABLE', 'Les offres disponibles');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'BIDS_PAYMENT', 'Les offres de paiement');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'BID_AND_WIN', 'Soumissionner et gagnez');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'BID_CROC', 'soumissionner Croc');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'BID_FROM', 'offre De');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'BID_NOW', 'Offrez');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'BID_ON_CREDIT_PACKS', 'Offre sur les paquets de crédit');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'BID_O_MATIC', 'Bid- O- Matic');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'BID_PACK', 'Crédits Pack');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'BID_PACKAGE', 'Offre Forfaits');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'BID_PRICE', 'Les offres ne coûte que $ 0,50 CAD Acheter offres de commencer à participer aux enchères .');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'BID_SAFELY_ON', 'Soumissionner en toute sécurité sur');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'BID_TO', 'Pour soumissionner');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'BIRTH_DATE', 'date de naissance');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'blank', 'No Filter Auction - The per bid price is set by [[SITE_NM]] for this auction type, view it on the product page.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'BOOK_AUTOBIDDER', 'livre Autobidder');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'BUY_A_BIDPACK', 'Acheter un BidPack');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'BUY_A_SEAT', 'Acheter un siège');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'BUY_BID', 'Acheter Offre');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'BUY_BIDS', 'Acheter offres');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'BUY_BIDS_PAYMENT', 'Achetez des crédits de paiement');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'BUY_BIDS_SUCCESS', 'Achetez des crédits succès');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'BUY_NOW', 'Acheter maintenant');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'BUY_PRICE', 'Acheter Prix');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'BUY_PRODUCT', 'Acheter ce produit');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'BUY_PRODUCT_NOW', 'Acheter ce produit maintenant');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'BUY_THIS_PRODUCT_NOW', 'Acheter ce produit maintenant');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'BY', 'par');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'BY_VISA_OR_MASTERCAR', 'By Visa ou Mastercard, ou via PayPal');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'BY_VISA_OR_MASTERCARD_OR_VIA_PAYPAL', 'Commander avec Visa, MasterCard , American Express, PayPal ou Discover Card');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'CAD', 'USD');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'CANCEL', 'résilier');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'CARD_NUMBER', 'Numéro de la carte');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'CARD_TYPE', 'Type de carte');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'CATEGORIES', 'catégories');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'centsmall', 'vente aux enchères cent de test');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'CERTAIN_INPUTS_HAVE_', 'Certaines entrées ont été remplies au-delà de ce qui est autorisé par la forme . ');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'CERTAIN_INPUTS_HAVE_BEEN_POPULATED_BEYOND_THAT_WHICH_IS_ALLOWED', 'Nombre d`entrées ont été remplies au delà de ce qui est permis. Vous avez des spams trap anti-spams, vous devez être un spambot !');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'CHANGE', 'changer');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'CHANGE_PASSWORD', 'modifier mot de passe');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'CHANGE_YOUR_PASSWORD', 'Changez votre mot de passe');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'CHECK_THIS_BOX_IF_YO', 'Cochez cette case si vous souhaitez une copie de cet e-mail .');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'CHECK_THIS_BOX_IF_YOU_WANT_CARBON_COPY_OF_THIS_EMAIL', 'Consulter cette boite et voyez si vous voyez votre email.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'CHOOSE_A_BID_PACK', 'Choisissez un pack soumission !');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'CHOOSE_PAYMENT_METHOD', 'Sélectionnez votre mode de paiement');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'CHOOSE_PRODUCTS', 'Choisissez des produits');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'CITY', 'ville');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'CLICK_ACTIVE_YOUR_ACCOUNT', 'please click on the link in the email and activate your account. Please note that this link is only valid for 48 hours.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'CLICK_BUTTON_TO_SUBM', 'Cliquez bouton pour envoyer le formulaire');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'CLICK_BUTTON_TO_SUBMIT_FORM', 'Cliquez ici pour valider');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'CLICK_HERE', 'Cliquez ici');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'CLOSE', 'PROCHE');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'CLOSE_ACCOUNT', 'Fermer le compte');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'CLOSE_YOUR', 'Fermez votre');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'COMBINABLE', 'COMBINABLE');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'COMMENTS', 'commentaires');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'COMMUNITY', 'communauté');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'CONFIG_ACCCESS_NOT_A', 'Config accès non autorisés');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'CONFIG_ACCCESS_NOT_ALLOWED', 'Accès non autorisé !');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'CONFIRM_TO_GOT_THE_P', 'que tu as produit ?');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'CONGRATULATIONS', 'Félicitations');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'CONTACT', 'Contactez');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'CONTACT_CUSTMER_SUPPORT', 'Contactez le service client');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'CONTACT_FOOTER', 'Contactez-nous');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'CONTACT_FORM', 'Formulaire de contact');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'CONTACT_US', 'Contactez-nous');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'CONTENT', 'Content');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'COPYRIGHT', 'Copyright © 2012 PennyAuctionSoft');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'COST_OF_BIDS', 'Coût des enchères');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'COUNTDOWN', 'compte à rebours');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'COUNTRY', 'pays');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'COUPON', 'coupon');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'COUPON_CODE', 'Coupon Code');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'COUPON_HISTORY', 'Historique du coupon');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'CREDIT_CARD_NUMBER_I', 'Votre numéro de carte de crédit semble être invalide. ');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'CREDIT_CARD_NUMBER_INVALID', 'Le numéro de votre carte semble invalide. Merci de vérifier votre numéro de carte sans espace ni ponctuation!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'CUSTOMER_ID', 'Numéro de client');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'CUSTOMER_SERVICE', 'Service à la clientèle');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'CUSTOMER_SUPPORT', 'Soutien à la clientèle exceptionnel');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'CVV2_SECURITY_CODE', 'CVV2 le code de sécurité');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'DATE', 'DATE');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'DATE_OF_BIRTH', 'Date de naissance');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'DECEMBER', 'Décembre');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'DECREASE', 'réduire');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'DELETE', 'supprimer');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'DELETE_SELECTED_AUCT', 'Supprimer vente aux enchères sélectionné parmi la liste');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'DELIVERY_AND_SHIPPIN', 'Livraison et expédition');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'DELIVERY_AND_SHIPPING', 'Transport et frais de ports');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'DELIVERY_CHARGE', 'Frais de livraison');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'DELIVERY_COST', 'Frais de livraison');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'DENIED', 'refusé');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'DESCRIPTION', 'Description');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'DETAIL', 'détail');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'DETAILS', 'Détails');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'DIALOG_TIMEOUT_CONTE', 'Vous avez été inactif sur ce site pour% 1 $ s minutes , le chronomètre est arrêté . ');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'DIALOG_TIMEOUT_CONTENT', 'Votre session a expiré Cliquez sur OK pour vous reconnecter');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'DIALOG_TIMEOUT_TITLE', 'Time Out');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'DISCOUNT', 'réduction');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'DISCOUNT_COUPON', 'réduction');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'DISCOVER', 'découvrir');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'DONT_WANT_TO_HEAR_AB', 'Je ne veux pas entendre parler de nos offres plus?');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'DONT_WANT_TO_HEAR_ABOUT_OUR_GREAT_DEALS_ANY_MORE', 'Je ne veux pas recevoir votre newsletter Any More');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'DO_RESPECT_YOUR_PRIV', 'ne respectent votre vie privée.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'DO_RESPECT_YOUR_PRIVACY', 'par respect de la confidentialité.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'EMAIL_ADDRESS', 'Adresse Email');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'EMAIL_ADDRESS_MISMAT', 'Adresse e-mail décalage');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'EMAIL_ADDRESS_MISMATCH', 'Email address mismatch!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'EMAIL_CONFIRMATION', 'Adresse e-mail de confirmation');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'EMAIL_SEND_SUCCESSFU', 'Envoyer à envoyer avec succès');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'EMAIL_SEND_SUCCESSFULLY', 'Email envoyé!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'EMAIL_SENT_SUCCESSFU', 'Email envoyé avec succès !');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'EMAIL_SENT_SUCCESSFULLY', 'Courrier envoy� avec succ�s!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'EMAIL_SUPPORT', 'US Based Email Support');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'EMPTY_FIELDS', 'Champ vide (s)');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'ENDED', 'terminé');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'ENDED_AUCTIONS', 'Enchères terminées');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'ENDING_AUCTIONS', 'u003cspan style=');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'END_DATE', 'Date de fin');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'END_PRICE', 'fin Prix');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'ENTER', 'Entrez');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'ENTER_ADDRESS', 'Adresse');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'ENTER_A_COUPONCODE_PLEASE', 'Entrez votre code coupon !');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'ENTER_A_COUPON_CODE', 'ENTRER un code promo');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'ENTER_EMAIL_ADDRESS_TO_INVITE', 'u003ch2u003e Veuillez saisir des adresses de courriel pour inviter u003c/ h2u003e');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'ENTER_THE_CODE', 'Entrez le code');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'ENTER_THE_COUPON_CODE_PLEASE', 'Entrer votre code coupon');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'ENTER_YOUR_NEW_TOPIC', 'Entrez votre nouveau sujet');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'ENTER_YOUR_REPLY', 'Entrez votre réponse');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'EXCITING_PRODUCTS', 'Gagnez produits passionnants');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'EXPERATION_DATE', 'Date d`expiration');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'EXPIRE', 'Expirez');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'EXPIRED', 'expiré');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'EXPIRY_DATE', 'Date expiration');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'FAQS', 'F.A.Q.s');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'FAQ_FOOTER', 'Foire aux questions');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'FAQ__FOOTER', 'Foire aux questions');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'FEATURED_AUCTIONS', 'Enchères en vedette');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'FEBRUARY', 'février');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'FEEDBACK', 'réaction');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'FEMALE', 'Femme');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'FIELDS_WERE_NOT_FILLED_IN', 'Certains champs ne sont pas correctement rempli, merci de retourner en arrière et de remplir tous les champs.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'FILL_OUT_THE_FORM_BE', 'Remplissez le formulaire ci-dessous');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'FILL_OUT_THE_FORM_BELOW', 'Remplissez le formulaire ci-dessous');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'FILL_YOUR_CREDIT_CARD_DETAILS', 'Veuillez fournir vos coordonnées bancaires');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'FINAL_BID', 'Points de soumission');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'FINAL_BIDS', 'Total des soumissions');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'FINAL_PRICE', 'Prix ​​final');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'FIRST_NAME', 'Prénom');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'FIRST_NAME_ON_CARD', 'Prénom sur la carte');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'FIXED_PRICE_AUCTION', 'Prix ​​fixe Enchères');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'FOLLOW_US', 'Suivez-nous');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'FOLLOW_US_TO_KNOW_AB', 'Suivez-nous savoir sur les derniers produits et offres !');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'FOLLOW_US_TO_KNOW_ABOUT_LATEST_PRODUCTS_AND_DEAL', 'Suivez -nous pour connaître nos derniers produits et offres');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'FOLLOW_US_TO_KNOW_ABOUT_LATEST_PRODUCTS_AND_DEALS', 'Suivez-nous pour connaître nos dernières offres');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'FOR1', 'pour 1');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'FORGET_PASSWORD', 'Mot de passe oublié');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'FORGOTTEN', 'Mot');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'FORGOT_PASSOWRD', 'Mot de passe oublié');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'FORGOT_PASSWORD', 'Mot de passe oublié ?');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'FORM_ID_FIELD', 'Formulaire ID terrain');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'FORUM', 'Forum');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'FORUMS', 'forums');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'FORUM_CONTENT', 'Contenu du Forum');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'FORUM_IS_EMPTY', 'Forum est vide');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'FOR_THIS_CATEGORY', 'pour cette catégorie');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'FREE_BIDS', 'Enchères gratuites');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'FREE_BIDS_COUPON', 'Enchères gratuites');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'FREE_POINTS', 'Gagnez des points gratuits');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'FREE_POINT_AUCTION_W', 'Gratuit Point de Vente');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'FREE_REGISTRATION', 'Inscription gratuite');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'FROM_W', 'à partir de');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'FULL_NAME', 'nom et prénom');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'FUTURE_AUCTION', 'enchères avenir');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'FUTURE_AUCTIONS', 'Enchères à venir');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'GBP', 'USD');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'GENDER', 'sexe');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'GET_5_BID_POINTS_ON_REGISTRATION', 'Get 5 Bid Points On Registration!!!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'GET_IN_TOUCH', 'Entrez en contact');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'HALF_BACK_BID_AUCTIO', 'Cette vente va vous donner la moitié de vos enchères en arrière si vous ne gagnez pas .');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'HAVE_A_QUESTION', 'Vous avez une question ?');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'HAVE_FUN_AND_GOOD_LU', 'Amusez-vous et bonne chance');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'HAVE_FUN_AND_GOOD_LUCK', 'Bonne chance!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'HAVE_YOU_ALREADY_REG', 'Avez-vous déjà enregistré?');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'HAVE_YOU_ALREADY_REGISTERED', 'Etes vous enregistré ?');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'HELP', 'Aide');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'HELP_FOOTER', 'Aide');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'HERE', 'ici');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'HERE_YOU_CAN_SEE_OUR', 'Ici vous pouvez voir toutes nos enchères en direct');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'HERE_YOU_CAN_SEE_OUR_ALL_LIVE_AUCTIONS', 'Vous pouvez voir ici toutes les ventes en cours');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'HIDE', 'Hide');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'HIGH_BIDDER', 'enchérisseur');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'HOME', 'maison');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'HOME_OF_THE_MOST_EXC', 'maison de ventes aux enchères les plus excitantes sur Internet');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'HOME_OF_THE_MOST_EXCITING_AUCTIONS_ON_THE_INTERNET', 'Accueil des adjudications les plus intéressants sur Internet');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'HONEST_BUSINESS', 'affaires honnête');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'HOT_DEALS', 'Hot Deals');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'HOW_DOES_QBIDS_WORKS', 'Comment fonctionne u003cfont style=');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'HOW_IT_WORKS', 'u003cstrongu003e Comment ça marche? u003c/ strongu003e');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'HOW_WORKS', 'Comment ça marche?');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'IF_LAST', 'Il suffit de cliquer «offre» sur une vente aux enchères . ');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'IF_YOU_CLOSE_YOUR_AC', 'si vous fermez votre compte, vous ne serez pas en mesure de ré-enregistrer avec');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'IF_YOU_CLOSE_YOUR_ACCOUNT_YOU_WONT_BE_ABLE_TO', 'Si vous fermez votre compte vous ne serez pas en mesure de visiter');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'IMAGE', 'IMAGE');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'IMPORTANT', 'Important');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'INCORRECT_COUPON_COD', 'Code promo incorrect');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'INCORRECT_COUPON_CODE', 'Code coupon incorrect!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'INCREASE', 'augmenter');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'INDATE', 'Indate');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'INDATE_COUPON', 'Expire');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'INDEPENDENT_EXAM_REP', 'Grant Thornton u003cp style=');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'INPUT_MAXLENGTH_VIOL', 'Entrée Maxlength Violation');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'INPUT_MAXLENGTH_VIOLATION', 'Violation du nombre d`entrée');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'INPUT_YOUR_PRICE', 'Entrée Votre prix');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'INSTANT_CREDIT', 'crédit instantané');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'INSTEAD_OF', 'au lieu de');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'INTERNATIONAL_AUCTIO', 'ventes aux enchères internationales');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'INTERNATIONAL_AUCTIONS', 'Vente internationales');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'INVALID_EMAIL_ADDRES', 'Adresse mail invalide');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'INVALID_EMAIL_ADDRESS', 'Adresse email invalide');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'INVALID_USERNAME_PASSWORD', 'Utilisateur ou mot de passe invalide');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'INVITE_A_FRIENDS', 'inviter des amis');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'INVITE_FREIND', 'Inviter un Freind');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'INVITE_FREINDS', 'Inviter un Freind');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'INVITE_FRIENDS', 'Inviter un Freind');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'I_HAVE_READ_UNDERSTOOD_AND_ACCEPTED', 'I have read, understood and accepted');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'I_WANT_TO_CLOSE_MY', 'Oui , je veux fermer mon');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'JOINT_DATE', 'Date d`arrivé');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'JOIN_DATE', 'Date d`ajout');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'LAST_COMMENT_POST_BY', 'Dernier message par Commentaire');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'LAST_DATE_OF_AVAILIB', 'Dernière date de disponibilité');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'LAST_DATE_OF_AVAILIBILITY', 'Date maximum de disponibilité');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'LAST_DATE_OF_AVAILIBILITY:', 'Dernière date disponible');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'LAST_NAME', 'Prénom');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'LAST_NAME_ON_CARD', 'Nom sur la carte');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'LAST_POST', 'Dernier message');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'LAST_POST_BY', 'Dernier message par');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'LATEST_NEWS', 'dernières Nouvelles');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'LATEST_WINNERS', 'Nos derniers gagnants');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'LIMIT_PER_HOUSEHOLD', '* Limite de 1 compte par foyer !');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'LIVE_AUCTION', 'enchère en direct');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'LIVE_AUCTIONS', 'Enchères en Direct');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'LIVE_SUPPORT', 'Soutien en direct');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'LOCK_AUCTION_DESCRIP', 'Vente aux enchères de verrouillage sera bloqué à un certain point pour les nouveaux utilisateurs de sauter dedans lorsque le prix atteint un certain montant de la vente aux enchères sera alors verrouillé et seuls les utilisateurs qui ont passé au moins 1 offre sera en mesure de soumissionner .');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'LOCK_AVAILABLE', 'BLOCAGE AUX ENCHÈRES');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'LOGIN', 'Connexion');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'LOGIN_AND_CONTACT_US', 'Connectez-vous et contactez-nous');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'LOGIN_INFORMATION', 'Informations de connexion');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'LOGOUT', 'Déconnexion');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'LOWEST_UNIQUE_AUCTIO', 'Le ÃƒÂ ¢ Ã ¢ Â , Â ¬ Ã ... Â ');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'LOWEST_UNIQUE_AUCTION', 'Prix ​​Unique Auction');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'LOWEST_UNIQUE_AUCTION_W', 'Prix ​​Unique Auction');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'MAIN', 'principal');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'MAKE', 'Assurez-vous');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'MAKE_PAYMENT', 'Effectuer un paiement');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'MALE', 'Homme');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'MANAGING_MYACCOUNT', 'Gestion Myaccount');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'MARCH', 'mars');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'MASTERCARD', 'MasterCard');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'MAY', 'mai');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'MESSAGE', 'un message');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'MESSAGE_ALREADY_HAVE', 'Vous avez déjà un siège pour cette vente aux enchères');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'MESSAGE_AUCTION_ENDE', 'Cette enchère a été déjà fin');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'MESSAGE_BIDDING_IS_R', 'Votre BidBuddy est en marche, vous ne pouvez pas le supprimer !');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'MESSAGE_CONFIRM', 'Un message de confirmation');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'MESSAGE_ENDPRICE_MUS', 'Autobidder prix final doit être supérieur au prix de départ !');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'MESSAGE_HAVE_AUCTION', 'Vous avez déjà fait une offre à ce prix');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'MESSAGE_INVALID_PRIC', 'invalide Prix');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'MESSAGE_REACHED_MAXI', 'Les sièges de la vente aux enchères est atteint pour le siège au maximum');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'MESSAGE_REACHED_TO_M', 'Le nombre de vos enchères victoire est atteinte de la limite de mois !');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'MESSAGE_REACHED_TO_W', 'Le nombre de vos enchères victoire est atteinte de la limite de semaine');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'MESSAGE_STARTPRICE_M', 'Autobidder prix de départ doit être supérieur au prix de fin de vente aux enchères inversée !');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'MESSAGE_TOP_BIDDER', 'Vous êtes le plus offrant');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'MIKE_CHERIM', 'Mike Cherim');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'MINORS', 'mineurs');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'MORE', 'plus');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'MORE_AUCTIONS', 'plus Enchères');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'MORE_OPTIONS', 'AUTRES OPTIONS');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'MY VOUCHERS', 'mes bons');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'MY_ACCOUNT', 'mon compte');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'MY_ACTIVE_AUTOBIDDER', 'Mon Autobidder actif');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'MY_ACTIVE_AUTOBIDDER_PAGE', 'mes AutoBidders');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'MY_AUCTIONS', 'mes enchères');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'MY_AUTOBIDDER', 'mon Autobidder');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'MY_AVATAR', 'My Avatar');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'MY_BIDS', 'mes enchères');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'MY_BUYNOW_HISTORY', 'Mon historique de BuyNow');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'MY_BUYNOW_LIST', 'Ma liste de BuyNow');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'MY_BUY_BIDS', 'mes enchères');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'MY_BUY_NOW_HISTORY', 'Mon Acheter Histoire');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'MY_BUY_NOW_LIST', 'Mon Acheter Liste');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'MY_CONTROL_CENTER', 'Mon Control Center');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'MY_COUPON', 'mon coupon');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'MY_COUPON_HISTORY', 'Mon historique de coupon');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'MY_DETAILS', 'mes détails');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'MY_REDEMPTIONS', 'mes Rachats');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'MY_REFERRAL', 'mes Parrainages');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'MY_SNAPBIDS', 'mon compte');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'MY_VOUCHERS', 'mes bons');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'NAME', 'nom');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'NAVIGATION', 'Navigation');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'NAVIGATION_FOOTER', 'LIENS');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'NEWS', 'nouvelles');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'NEWS_DATE', 'Nouvelles Date');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'NEW_BRAND_NAME_PRODU', 'De nouveaux produits de marque et des prix incroyables');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'NEW_BRAND_NAME_PRODUCTS_AND_AMAZING_PRICES', 'Nouveaux produits de marque à Amazing prix');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'NEW_LETTERS', 'nouvelles lettres');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'NEW_TO', 'nouveau à');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'NEW_USER_REGISTRATION', 'New User Registration');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'NEXT', 'Suivant');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'NEXT_PAGE', 'page suivante');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'NIGHT_AUCTION', 'Enchère nocturne');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'NO', 'Non');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'NOTE_', 'Note: Cette entrée n`a doit pas être remplie. C`est une trap à spam, Merci de l`ignorer. Si vous enregistrer quelque chose, vous rencontrerez une erreur.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'NOTE_CODE_AND_MARKUP', 'Note - le code et le balisage seront retirés de tous les domaines');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'NOTE_CODE_AND_MARKUP_WILL_BE_REMOVED_FROM_ALL_FIELDS', 'Note: Code et markup ont étés effacés !');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'NOT_A_MEMBER', 'Pas encore membre?');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'NOT_REGISTERED_WITH', 'Non inscrit');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'NOT_SHIPPED', '( Pas livré )');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'NOVEMBER', 'Novembre');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'NOW_PRODUCT_TO_SELECT_TO_BUY', 'Nouveaux produits selectionnés en vente !');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'NO_ACTIVE_AUTOBIDDER', 'Pas AutoBidders actifs');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'NO_BIDS_PLACED', 'Aucune offre placée !');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'NO_BUYNOW_TO_DISPLAY', 'Aucune Acheter à afficher');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'NO_COUPON_TO_DISPLAY', 'Aucun coupon pour afficher');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'NO_ENDED_AUCTION_TODISPLAY', 'Aucun des ench�res pour afficher');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'NO_FORUM_TO_DISPLAY', 'Non Forum pour afficher');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'NO_FUTURE_AUCTION_TO', 'No future vente aux enchères à afficher');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'NO_FUTURE_AUCTION_TO_DISPLAY', 'Pas d`adjudication futures pour afficher');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'NO_LIVE_AUCTIONS_TO_', 'Pas de ventes aux enchères en direct à afficher');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'NO_LIVE_AUCTIONS_TO_DISPLAY', 'Pas d`enchère en cours');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'NO_LIVE_AUCTION_TO_D', 'Pas de vente aux enchères en direct à afficher');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'NO_LIVE_AUCTION_TO_DISPLAY', 'Aucune vente en direct � afficher');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'NO_MESSAGE_TO_DISPLA', 'Aucun message à afficher');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'NO_NEWS_TO_DISPLAY', 'Pas de nouvelles à afficher');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'NO_PROBLEM_JUST_ENTER_YOUR_EMAIL_AND_WE_WILL_SEND_THE_INFORMATION_TO_YOUR_EMAIL_ACCOUNT', 'Aucun soucis, entrez votre email ici et nous vous ferons parvenir les informations sur votre compte.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'NO_REDEMPTION_TO_DISPLAY', 'Pas de rachats en ce moment');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'NO_TOPIC_TO_DISPLAY', 'Pas de rubrique à afficher');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'NO_VOUCHERS_TO_DISPL', 'Aucune pièce justificative à afficher');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'NO_VOUCHERS_TO_DISPLAY', 'Aucun bons disponible');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'NO_WATCHED_AUCTIONS_', 'Pas de ventes aux enchères regardé à afficher');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'NO_WORRIES_THE_TEXT_', 'Pas de soucis, le texte entré ici est insensible à la casse');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'NO_WORRIES_THE_TEXT_ENTERED_HERE_IS_CASE_INSENSITIVE', 'Le texte entré ici est insensible à la casse, pas d`inquiétude');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'OCTOBER', 'octobre');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'OFF', 'off');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'OFFLINE', 'Hors ligne');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'OFF_100', '100% off');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'OFF_THE_RETAIL_PRICE', 'Sur le prix de détail');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'OK', 'Ok');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'ONE', '1');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'ONE_CENT_AUCTION', 'Enchère à 1 Cent');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'ONLINE', 'En ligne');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'OPEN_AUCTION', 'ouvert aux enchères');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'OPTIONAL', 'optionnel');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'OTHER_INFORMATION', 'autres informations');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'OUR_SITE', 'notre site');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PACKAGE', 'package');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PAGES', 'Pages');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PAID', '(Payant)');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PASSWORD', 'mot de passe');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PASSWORD_IS_TOO_SHOR', 'Mot de passe est trop court');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PASSWORD_IS_TOO_SHORT', 'Password is too short');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PASSWORD_MISMATCH', 'Mot de passe erroné');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PASSWORD_SECURITY', 'sécurité Mot de passe');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PAYMENT', 'PAIEMENT');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PAYMENTS_AND_PAYMENT', 'Les paiements et les modalités de paiement');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PAYMENTS_AND_PAYMENT_METHODS', 'Méthode de paiement et paiement');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PAYMENT_CCAVENUE', 'Paiement Via CCAvenue');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PAYMENT_COMPLETE', 'paiement complet');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PAYMENT_FAILED', 'paiement échoué');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PAYMENT_GOOGLE_CHECK', 'Les paiements via Google Checkout');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PAYMENT_GOOGLE_CHECKOUT', 'Paiement via google');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PAYMENT_INFORMATION', 'INFORMATIONS RELATIVES AU PAIEMENT');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PAYMENT_METHODS', 'Modes de paiement');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PAYMENT_MYGATE', 'Paiement Via mygate');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PAYMENT_PAGSEGURO', 'Paiement Via Pagseguro');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PAYMENT_SUCCESS', 'Succès de paiement');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PAYMENT_VIA_MONEYBOO', 'Paiement Via moneybooder');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PAYMENT_VIA_PAYFLOWL', 'Paiement par Payflow Link');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PAYMENT_VIA_PAYMENTA', 'Paiement Via Paymentasia');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PAY_SAFELY_ON', 'Payez en toute sécurité sur');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PERIOD_IS_OVER', 'période est terminée');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PERSONAL_INFORMATION', 'Renseignements personnels');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PHONE_NUMBER', 'Numéro de téléphone');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PICK_A_PRODUCT', 'Choisissez un produit que vous voulez un téléviseur HD un nouvel iPhone , ou un bon de candidature');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLACED_BIDS', 'Swoggi');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLACE_BID', 'Placer une Offre');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLACE_BIDS_AND_WIN', 'Faire des offres et de gagner');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLEASE', 'S`il vous plait');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLEASE_ACCEPT_OUT_PRIVACY_POLICY', 'Please accept Our Privacy Policy!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLEASE_ACCEPT_OUT_TERMS_CONDITIONS', 'Please accept Our Terms & Conditions!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLEASE_CHECK_YOUR_EMAIL_ADDRESS_AGAIN', 'Merci de vérifier votre adresse email. Elle n`a pas été rentrée correctement.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLEASE_CHOOSE_WHICH_', 'Veuillez indiquer qui BidPack vous souhaitez acheter');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLEASE_CHOOSE_WHICH_BIDPACK', 'Choisissez le type de pack d`enchères que vous souhaitez avoir');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLEASE_CMPLETE_THE_FOLLOWING', 'please complete the following');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLEASE_CONFIRM_YOUR_REGISTRATION', 'Please confirm your registration!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLEASE_ENTER_ADDRESS', 'Please enter address!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLEASE_ENTER_AUCTION_ID', 'Entrer votre ID Auction');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLEASE_ENTER_CITY', 'Please enter city!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLEASE_ENTER_CONFIRM_EMAIL_ADDRESS', 'Please enter confirm email address!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLEASE_ENTER_CONFIRM_NEW_PASSWORD', 'Entrez de nouveau votre mot de passe!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLEASE_ENTER_CORRECT_SECURITY_CODE', 'Please Enter Correct Security Code!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLEASE_ENTER_EMAIL', 'S`il vous pla�t entrez l`adresse e-mail!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLEASE_ENTER_EMAILADDRESS', 'Please enter emailaddress!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLEASE_ENTER_EMAILADDRESS_TO_SUBSCRIBE', 'Entrez votre adresse email pour vous inscrire !');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLEASE_ENTER_EMAILADDRESS_TO_UNSUBSCRIBE', 'Entrez votre adresse email pour vous désinscrire !');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLEASE_ENTER_EMAIL_ADDRESS', 'Entrez votre adresse email!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLEASE_ENTER_FIRST_NAME', 'Please enter first name!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLEASE_ENTER_LAST_NAME', 'Please enter last name!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLEASE_ENTER_MESSAGECONTENT', 'Entrez votre message!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLEASE_ENTER_NAME', 'Entrez votre nom!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLEASE_ENTER_NEW_PASSWORD', 'Entrez votre nouveau mot de passe.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLEASE_ENTER_PASSWORD', 'Please enter password');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLEASE_ENTER_PHONE_NUMBER', 'Please enter phone number!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLEASE_ENTER_POSTCODE', 'Please enter postcode!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLEASE_ENTER_SECURITY_CODE', 'Please Enter Security Code!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLEASE_ENTER_USERNAME', 'Please enter username!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLEASE_ENTER_USERNAME_AND_PASSWORD', 'Merci d`enregistrer votre nom d`utilisateur et votre mot de passe');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLEASE_ENTER_VALID_EMAIL', 'S`il vous pla�t entrez l`adresse e-mail valide!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLEASE_ENTER_VALID_EMAIL_ADDRESS', 'Entrez votre adresse email !');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLEASE_ENTER_VALID_REFERRER_CODE_OR_SKIP_IT', 'Please enter valid referrer code or skip it!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLEASE_ENTER_YOUR_CARD_NAME', 'Entrez le nom du porteur de la carte!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLEASE_ENTER_YOUR_LOGIN_DATA_HERE', 'Entrez votre nom d`utilisateur ici');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLEASE_ENTER_YOUR_NEW_PASSWORD', 'Entrez votre nouveau mot de passe');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLEASE_MAKE_A_SELECTION', 'Veuillez selectionner');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLEASE_RETYPE_PASSWORD', 'Please retype password!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLEASE_RETYPE_YOUR_NEW_PASSWORD', 'Retapez votre nouveau mot de passe');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLEASE_SELECT', 'Choisir s`il vous pla�t');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLEASE_SELECT_BIRTH_DATE', 'Please select birth date!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLEASE_SELECT_COUNTRY', 'please select country');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLEASE_SELECT_STATE', 'please select state<');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLEASE_SELECT_SUBJECT', 'Sélectionnez un sujet');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLEASE_SELECT_VOUCHER', 'Merci de sélectionner un bon');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLEASE_SELECT_YOUR_SUBJECT', 'Entrez votre sujet!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLEASE_TAKE_A_LOOK', 'Consultez');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLEASE_VALID_EMAIL_ADDRESS', 'Please enter valid email address!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PLESE_CHECK_YOUR_INPUT', 'Please fill all the require filed');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'POINTS', 'Points');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'POSTAL_CODE', 'ZIP / Code postal');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'POSTS', 'messages');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'POST_REPLY', 'poster une réponse');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'POST_TOPIC', 'Message Sujet');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PREVIOUS', 'précédent');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PREVIOUS_PAGE', 'page Précédente');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PRICE', 'prix');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PRICE_BIDDER', 'Cours acheteur');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PRIVACY', 'Protection des données');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PRIVACY_FOOTER', 'Politique de confidentialité');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PRIVACY_POLICY', 'Politique de confidentialité');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PRODUCT', 'produit');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'Products', 'PRODUITS');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PRODUCT_DETAILS', 'DÉTAILS DU PRODUIT');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PRODUCT_NAME', 'Nom du produit');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PRODUCT_PAYMENT', 'Paiement du produit');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PRODUCT_PRICE', 'Prix ​​du produit');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PRODUCT_SENT', 'produit envoyé');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PRVICAY_POLICY', 'Politique de confidentialité');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'PURCHASED_BIDS', 'Les offres achetées');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'QUESTIONS_ABOUT', 'A propos de');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'RATE_IT', 'Notez-le');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'READ_MORE', 'En savoir plus');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'REDEEM', 'Échangez');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'REDEMPTION', 'Redemption');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'REDEMPTION_DETAILS', 'Détails de rachat');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'REDEMPTION_PAYMENT', 'Paiement de rachat');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'REDEMPTION_POINTS', 'Points de rachat');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'REFERRAL', 'renvoi');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'REFER_A_FRIEND', 'Parrainer un ami');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'REGISTER', 'Inscrivez-vous');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'REGISTER_FOOTER', 'Inscrivez-vous maintenant');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'REGISTER_FREE', 'Inscrivez-vous!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'REGISTER_NOW', 'Inscrivez-vous maintenant');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'REGISTRATION', 'Inscription');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'REPLY_SUBMITED_SUCCE', 'Répondre Envoyé avec succès !');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'REPORT_ABUSE', 'Signaler un abus');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'REQUIRED', 'demandé');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'REQUIRED_FILED', 'ce dépôt est exigé');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'REQUIRED_FILELD_MISS', 'Champ obligatoire (s) manqué');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'REQUIRED_FILELD_MISSED', 'Champs requis');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'RESULTS', 'résultats');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'RETAIL VALUE', 'PRIX DE DÉTAIL');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'RETAIL_VALUE', 'Prix ​​de détail');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'RETURE', 'retour');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'RETYPE_EMAIL_ADDRESS', 'Confirmer votre Email');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'RETYPE_PASSWORD', 'Retaper le mot de passe');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'REVERSE_AUCTION', 'Inversez');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'REVERSE_AUCTION_DESC', 'Le prix va baisser lorsque vous placez une offre .');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'REVERSE_AUCTION_W', 'enchères inversées');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'RULES', 'règles');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'RULES_FOOTER', 'règles');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'RUNNING', 'courir');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'SAVINGS', 'économies');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'SEARCH', 'Rechercher');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'SEATS_AVAILABLE', 'Places disponibles');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'SEAT_AUCTION_DESCRIP', 'Enchères assis débutera u003cbru003e lorsque tous les sièges sont achetés');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'SEAT_AUCTION_DESCRIPTION', 'Les enchères commencent lorsque les sièges sont remplis');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'SEAT_BIDS', 'Les offres de sécurité');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'SECURE_AND_ACCESSIBL', 'Sécurité et accessibilité');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'SECURE_AND_ACCESSIBLE', 'Sécurisé et accessible');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'SECURE_PAYMENTS', 'paiement sécurisé');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'SECURITY', 'sécurité');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'SELECT_ACCEPT_OR_DENIED', 'Choisir accepter ou refuser!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'SELECT_BIRTHDAY_DATE', 'please select the Date of birth');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'SELECT_CATEGORY', 'Choisissez une catégorie');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'SELECT_MY_AVATAR', 'Sélectionnez My Avatar');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'SELECT_ONE', 'sélectionner une');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'SELECT_THIS_PACKAGHE', 'Sélectionnez ce forfait');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'SEND', 'Envoyer');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'SEPTEMBER', 'Septembre');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'SHARE_THE_FUN_USING', 'Partager le plaisir utilisation');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'SHIPMENT_AND_RETURNS', 'Livraison et retours');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'SHIPPED', '(Livré )');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'SHIPPING', 'Livraison');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'SHIPPING_CHARGE', 'Frais de port');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'SHOW', 'montrer');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'SHOW_YOUR_ALL_REDEMP', 'pour montrer vos rachats tous');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'SIGN_IN', 'Connexion');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'SIGN_UP_AND_BUY', 'Inscrivez-vous et acheter offres');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'SIGN_UP_NOW', 'Inscrivez-vous maintenant');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'SINGLE_BID', 'Offre unique');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'SITE_NM', 'PennyAuctionSoft');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'SKIP_LOGIN', 'Sauter Connexion');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'SMS_BID', 'Offre SMS');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'SNAPBIDS_101', 'Snapbids 101');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'SOLD', 'vendus');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'SORRY_YOUR_PAYMENT_PROCESS_WAS_NOT_SUCCESFULL', 'Désolé, votre paiement n`a pas été accepté');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'SORRY_YOU_DONT_WON_ANY_AUCTION_YET', 'Vous avez remporté aucune Enchères Pourtant,');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'START', 'DÉMARRAGE');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'START_PRICE', 'Prix ​​de départ');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'STATE', 'Etat');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'STATUS', 'statut');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'STAY_CONNECTED', 'Restez connecté');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'STEP_ONE', 'Première étape');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'STEP_THREE', 'Troisième étape');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'STEP_TWO', 'Deuxième étape');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'SUBJECT', 'sujet');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'SUBMIT', 'SOUMETTRE');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'SUBSCRIBE', 'ABONNEZ-VOUS');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'SUBSCRIBE_TO_NEWSLET', 'Inscription à la newsletter');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'SUBSCRIBE_TO_NEWSLETTER', 'Abonnez-vous à notre newsletter');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'SUBTOTAL', 'Total partiel');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'SUPPORT', 'Soutien à la clientèle exceptionnel');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'SUPPORT_US', 'Soutenez -nous');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'TAX_AMOUNT', 'Tax Amount');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'TEAM', 'équipe');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'TECHNICAL_PROBLEMS', 'problèmes techniques');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'TERMS_AND_CONDITIONS', 'Termes et Conditions');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'TERMS_CONDITIONS', 'Conditions générales');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'TERMS_CONDITIONS_FOO', 'Termes et Conditions');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'TERMS_CONDITIONS_FOOTER', 'Termes et Conditions');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'TEST_1', 'est grand Mes petits-fils voulaient iPod pour Noël , mais je suis sans travail . ');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'TEST_1_NAME', 'Thomas Cooper');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'TEST_2_NAME', 'Thomas C. , Madison, WI');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'TEST_3_NAME', 'Cyril B.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'TEST_4_NAME', 'Jenny W.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'THANK_YOU_FOR_SUBSCR', 'Merci de vous abonnant à notre newsletter.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'THANK_YOU_FOR_SUBSCRIBING_TO_OUR_NEWSLETTER', 'Merci de votre inscription à notre newsletter.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'THESE_AUCTIONS_ARE_A', 'essai');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'THESE_AUCTIONS_ARE_ABOUT_TO_END', 'Ces enchères vont bientôt se terminer !');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'THE_CHANCE_TO_WIN_AM', 'La chance de gagner des produits étonnants à des prix incroyables');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'THE_CHANCE_TO_WIN_AMAZING_PRODUCTS_AT_AMAZING_PRICES', 'Gagner des produits étonnants à des prix incroyables');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'THE_EMAIL_ADDRESS_AL', 'Cette adresse email existe déjà');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'THE_EMAIL_ADDRESS_ALREADY_EXISTS', 'This Email Address Already Exists!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'THE_EMAIL_ADDRESS_YOU_HAVE_SUBMITTED_SEEMS_TO_BE_INVALID', 'L`adresse que vous nous avez fourni est invalide. Merci de retourner en arrière et de vérifier votre adresse email.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'THE_FOLLOWING_REQUIR', 'La «nécessaire» ci-dessous');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'THE_FOLLOWING_REQUIRED', 'Champs requis');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'THE_PRODUCT_DONT_ALLOW_TO_BUY_IT_NOW', 'Le produit n`est pas en vente !');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'THE_WORTH_UP_TO_PRIC', 'La « valeur maximale de « prix reflète les prix suggéré de détail.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'THE_WORTH_UP_TO_PRICE_REFLECTS_THE_MANUFACTURERS_SUGGESTED_RETAIL_PRICE', 'L`indication de la valeur pouvant aller jusque et fourni par le constructeur en prix moyen constaté.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'THIS_AUCTION_WILL_EN', 'Cette enchère se termine plus tôt le');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'THIS_AUCTION_WILL_END_LATEST_ON', 'Cette vente devrait se terminer');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'THIS_CONFIRMS_YOUARE', 'Cela confirme que vous êtes un utilisateur humain');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'THIS_USERNAME_ALREADY_EXISTS', 'This Username Already Exists!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'TITLE', 'Titre');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'TITLE_COUPON', 'Titre');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'TOPICS', 'sujets');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'TOPIC_SUBMITED_SUCCE', 'Sujet Envoyé avec succès !');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'TOTAL', 'totale');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'TOTAL_COMMENT', 'Commentaire totale');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'TOTAL_COST', 'Coût total');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'TOTAL_PACKAGE_COST', 'Coût total du forfait');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'TOTAL_PAYMENT', 'paiement total');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'TOTAL_POST', 'total pour le');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'TOTAL_PRICE', 'Prix ​​total');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'TOWN_CITY', 'Town / Ville');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'TO_AVOID_ABUSES_WE_D', 'Pour éviter les abus , nous ne vous permettons pas de modifier vos coordonnées une fois enregistré.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'TO_AVOID_ABUSES_WE_DONOT_ALLOW_YOU_TO_EDIT_YOUR_DETAILS_ONCE_REGISTEREDED', 'Pour des raisons de sécurité, nous ne vous permet pas de modifier ces données Une fois que vous avez enregistré');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'TO_CONTINUE', 'pour continuer ...');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'TO_FIND_AN_INCREDIBL', 'Pour trouver un aubaines incroyables.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'TO_FIND_INCREDIBLE_B', 'de trouver des aubaines incroyables');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'TO_FIND_INCREDIBLE_BARGAINS', 'pour trouver des offres incroyables');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'TO_GO_BACK', 'pour revenir .');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'TO_RECHARGE_ACCOUNT', 'pour recharger votre compte.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'TO_REGISTER_WITH', 'Pour vous inscrire à');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'TRACK_NUMBER', 'Numéro de piste');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'TWITTER', 'Twitter');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'TYPE', 'catégorie');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'UNSUBSCRIBE', 'DÉSABONNEMENT');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'UNSUBSCRIBE_TO_NEWSL', 'Se désabonner à la newsletter');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'UNSUBSCRIBE_TO_NEWSLETTER', 'Unsunscribe à notre newsletter');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'USD', 'USD');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'USD_ONLY', 'Seulement USD');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'USED', 'utilisé');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'USER', 'utilisateur');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'USERNAME', 'Username');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'USERNAME_IS_TOO_SHORT', 'Username is too short!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'USERNAME_OR_PASSWORD', 'Nom d`utilisateur ou mot de passe');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'USER_REMOVED', 'retiré utilisateur');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'USE_DATE', 'utiliser la date');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'USING_THIS_EMAIL_ADD', 'Cette adresse email pendant deux mois. ');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'USING_THIS_EMAIL_ADDRESS_FOR_TWO_MONTHS', 'En utilisant cette adresse email pendant deux mois');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'VALID_TO', 'Validation de');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'VALUE', 'valeur');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'VIEW_ALL_LIVE_AUCTIO', 'Tous les Enchères en Direct');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'VIEW_ALL_LIVE_AUCTIONS', 'Voir Live Auctions');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'VISA', 'Visa');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'VOUCHERS', 'bons');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'VOUCHER_AMOUNT', 'Montant du bon');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'VOUCHER_LABEL', 'LABEL DE BON');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'WANT_US_TO_LET_YOU_K', 'Voulez que nous vous informons sur les nouvelles acutions et offres spéciales ?');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'WANT_US_TO_LET_YOU_KNOW_ABOUT_NEW_AUCTIONS_SPECIAL_OFFERS', 'Pensez- vous que nous vous informer sur New enchères et les offres spéciales');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'WATCHED_AUCTIONS', 'Enchères regardé');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'WELCOME', 'accueil');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'WELCOME_BACK', 'Welcome Back');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'WELCOME_CONTENT', 'Découvrez notre nouvelle fonctionnalité Avatar situé sur la droite. ');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'WELCOME_TO', 'Bienvenue à');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'WE_ACCEPT', 'nous acceptons');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'WE_WILL_SEND_THE_PRO', 'Nous allons envoyer le produit dès que possible.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'WHAT_IS', 'Ce qui est');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'WHERE_AN_AUCTION_IS_', 'Une enchère ouverte est une enchère régulière. ');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'WHO_JUST_WON', 'Qui vient de remporter');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'WHY_ASK', 'Pourquoi demander');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'WIN', 'gagner');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'WINNER', 'gagnant');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'WINNERS', 'Des centaines de u003cstrongu003e de winers quotidien u003c/ strongu003e');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'WITH_EACH_BID_PRICE_', 'Avec chaque enchère le prix sera');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'WITH_EACH_BID_PRICE_WILL', 'Après chaque offre , le prix sera');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'WON_AUCTIONS', 'Enchères gagnées');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'WORTH_UP_TO', 'Valeur pouvant aller jusque');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'YES', 'Oui');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'YES_I_WANT_TO_RECEIV', 'Oui, je veux recevoir des');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'YES_I_WANT_TO_RECEIVE', 'Oui je veux recevoirÂ');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'YOUR', 'votre');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'YOUR_ACCOUNT_IS_DELE', 'Votre compte est supprimé par');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'YOUR_ACCOUNT_IS_DELETED_BY', 'Votre compte a été supprimé par');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'YOUR_ACCOUNT_IS_SUSP', 'Votre compte est suspendu par');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'YOUR_ACCOUNT_IS_SUSPENDED_BY', 'Votre compte a été suspendu par');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'YOUR_AFFILIATE_CODE', 'Votre Code d`affiliation');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'YOUR_AFFILIATE_URL', 'Votre URL affili�e');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'YOUR_AUTOBIDDER_IS_R', 'Votre Autobidder fonctionne, vous ne pouvez pas le supprimer !');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'YOUR_CREDIT_CARD_CCV', 'Votre carte CCV / AMEX nombre de crédit semble être invalide');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'YOUR_CREDIT_CARD_CCV_INVALID', 'Votre numéro CCV/AMEX semble invalide !');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'YOUR_DATA', 'vos données');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'YOUR_EMAIL', 'votre e-mail');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'YOUR_EMAIL_TO', 'Votre e-mail à');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'YOUR_EMAIL_VERIFICAT', 'La vérification de votre e-mail est confirmé avec succès');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'YOUR_EMAIL_VERIFICATION_IS_CONFIRMED_SUCCESSFULLY', 'Votre confirmation d`email s`est déroulé correctement');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'YOUR_PASSWORD_HAS_BE', 'Votre mot de passe a été changé');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'YOUR_PASSWORD_HAS_BEEN_CHANGED', 'Votre mot de passe a été changé !');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'YOUR_POSTAL_ADDRESS', 'Votre adresse postale');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'YOUR_PRICE', 'votre prix');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'YOUR_THE', 'vous le');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'YOUR_TRANSACTION_FOR', 'Votre transaction de rachat complété avec succès !');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'YOUR_TRANSACTION_HAS', 'Votre transaction a été complétée avec succès.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'YOU_ARE_NOT_BIDDING_', 'Vous ne pouvez enchérir sur les ventes aux enchères');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'YOU_CAN_BID_NOW', 'Vous pouvez enchérir maintenant .');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'YOU_CAN_ONLY_POST_ONE_COMMENT_ON_PER_COMMUNITY', 'Vous pouvez poster qu`un seul commentaire par lot !');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'YOU_DONT_CURRENTLY_HAVE_ANY_AUTOBIDDERS', 'Vous ne dispose pas actuellement de AutoBiders');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'YOU_DO_NOT_HAVE_ANY_BIDS', 'Vous n`avez pas d`offres dans votre compte pour le moment');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'YOU_DO_NOT_HAVE_SUFFICIENT_POINTS_IN_YOUR_ACCOUNT_TO_REDEEM_THIS_PRODUCT', 'Vous n`avez pas assez de points sur votre compte pour échanger ce produit !');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'YOU_HAVE_ALREADY_ACC', 'Vous avez déjà accepter / refuser cette vente aux enchères !');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'YOU_HAVE_CHOOSEN', 'Vous avez choisi');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'YOU_HAVE_CURRENTLY_S', 'Vous avez sélectionné');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'YOU_HAVE_CURRENTLY_SELECTED', 'sélection actuelle');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'YOU_HAVE_FORGOTTEN_Y', 'Vous avez oublié votre mot de passe?');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'YOU_HAVE_FORGOTTEN_YOUR_LOGIN_DATA', 'Vous avez perdu votre nom d`utilisateur ?');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'YOU_HAVE_PURCHASED', 'Vous avez acheté');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'YOU_HAVE_UNSUBSCRIBE', 'Votre suis désabonné de la newsletter ...');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'YOU_HAVE_UNSUBSCRIBED_FROM_OUR_NEWSLETTER', 'Vous avez été désincrit de notre newsletter.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'YOU_MUST_BE_LOGGED_I', 'Vous devez être connecté pour pouvoir faire ça! ');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'YOU_MUST_BE_LOGGED_TODO_THAT', 'Vous devez être connecter pour effectuer cette action, souhaitez vous vous connecter ?');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'YOU_POPULATED_A_SPAM', 'Vous peuplées un piège entrée anti- spam Spam qui vise à confondre machines envoi de pourriels automatisés. ');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'YOU_POPULATED_A_SPAM_TRAP_ANTI_SPAM_INPUT_SO_YOU_MUST_BE_A_SPAMBOT', 'Vous avez des spams trap anti-spams, vous devez être un spambot !');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'YOU_POPULATED_A_SPAM_TRAP_ANTI_SPAM_INPUT_THAT_IS_MEANT_TO_CONFUSE', 'Vous avez des pièges anti-spams qui vise à confondre les spams. Si vous avez rempli ce champs incorrectement, utilisez le bouton pour revenir et remplissez de nouveau correctement.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'french', 'ZIP_CODE', 'ZIP Code');

-- NEXT_QUERY --

INSERT INTO `language` (`id`, `language`, `languagename`, `enable`, `flag`) values (4,'german','German',1,'de.gif');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'ABOUTUS', 'About Us');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'ADD', 'Agregar');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'ADDRESS_LINE', 'Direccion');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'ADD_COMMENT', 'Agregar Comentario');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'AFFILIATES', 'affiliates');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'AFFILIATE_CODE', 'Codigo de Afiliacion');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'AFTER_PAYMENT_THE_BIDS_WILL_BE_BOOKED_TO_YOUR_ACCOUNT', 'Despues del pago sus Bids seran abonados a su cuenta');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'AFTER_PAYMENT_THE_PRODUCT_WE_WILL_SEND_IT', 'Despues del pago del producto, se lo enviaremos a usted lo antes posible');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'ALL_AUCTIONS', 'Todas Las Subastas');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'AMERICAN_EXPRESS', 'American Express');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'ANTI_SPAM_TRAP_1_FIELD_POPULATED', 'Anti-Spam Trap 1 Field Populated');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'ANTI_SPAM_TRAP_2_FIELD_POPULATED', 'Anti-Spam Trap 2 Field Populated');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'AN_EMAIL_WAS_SENT_TO', 'Un correo electr�nico fue enviado a');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'APPLY_COUPON', 'APLICAR CUPON');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'AUCTION_DETAILS', 'Detalles de la Subasta');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'AUCTION_TYPE', 'Tipo de Subasta');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'BE_AT_LEAST_6_CHARACTERS_LONG', 'Debe tener por lo menos 6 caracteres');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'BIDS', 'Bids');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'BIDS_PAYMENT', 'Pago de Bids');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'BID_NOW', 'BID AHORA');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'BID_PACK', 'Bid Pack');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'BUY_A_BIDPACK', 'Comprar BidPack');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'BUY_BID', 'Comprar Bids');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'BUY_BIDS', 'Comprar Bids');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'BUY_PRICE', 'Precio de Compra');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'BUY_PRODUCT', 'Comprar Producto');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'BUY_PRODUCT_NOW', 'Comprar Producto Ahora');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'CANCEL', 'Cancelar');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'CARD_NUMBER', 'Numero de Tarjeta');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'CARD_TYPE', 'Tipo de Tarjeta');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'CERTAIN_INPUTS_HAVE_BEEN_POPULATED_BEYOND_THAT_WHICH_IS_ALLOWED', 'Certain inputs have been populated beyond that which is allowed by the form. Therefore you must be trying to post remotely and are probably a spambot. Go away!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'CHECK_THIS_BOX_IF_YOU_WANT_CARBON_COPY_OF_THIS_EMAIL', 'Marque esta casilla si desea una copia de este e-mail.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'CHOOSE_PAYMENT_METHOD', 'Por favor, elija su metodo de pago');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'CITY', 'Ciudad');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'CLICK_ACTIVE_YOUR_ACCOUNT', 'por favor haga clic en el enlace en el correo electronico para activar su cuenta. Tenga en cuenta que este enlace solo es valido durante 48 horas.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'CLICK_BUTTON_TO_SUBMIT_FORM', 'Click en el Bot�n para enviar el formulario');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'CLICK_HERE', 'Click aqui');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'CONFIG_ACCCESS_NOT_ALLOWED', 'No se permite el acceso de configuracion!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'CONTACT_FORM', 'Formad de Contacto');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'CONTACT_US', 'Contactanos');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'COUNTDOWN', 'Cuenta Regresiva');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'COUNTRY', 'Pais');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'CREDIT_CARD_NUMBER_INVALID', 'Su numero de tarjeta de credito parece ser invalido. Por favor verifique su tarjeta  N�mero asegurandose de que no contiene espacios ni otros puntos!!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'CVV2_SECURITY_CODE', 'CVV2 Codigo de Seguridad');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'DATE', 'FECHA');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'DATE_OF_BIRTH', 'Fecha de Nacimiento');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'DESCRIPTION', 'DESCRIPCION');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'DISCOUNT', 'Descuento');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'DISCOVER', 'Discover');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'DO_RESPECT_YOUR_PRIVACY', 'Respetamos su privacidad.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'EMAIL_ADDRESS', 'Direccion de Email');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'EMAIL_ADDRESS_MISMATCH', 'Email no concuerdan!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'EMAIL_SENT_SUCCESSFULLY', 'Email enviado con exito!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'EMPTY_FIELDS', 'Campo vacio(s)');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'ENDED', 'Finalizadas');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'ENDED_AUCTIONS', 'Subastas Finalizadas');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'END_DATE', 'Fecha de finalizacion');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'ENTER_ADDRESS', 'Ingrese Direccion');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'ENTER_A_COUPONCODE_PLEASE', 'Por favor Ingrese Codigo del Cupon !');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'ENTER_A_COUPON_CODE', 'INGRESE CODIGO DEL CUPON');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'ENTER_EMAIL_ADDRESS_TO_INVITE', 'Introduzca la direcciones de correo electr�nico para invitar (separadas por comas)');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'ENTER_THE_CODE', 'ingrese codigo');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'ENTER_THE_COUPON_CODE_PLEASE', 'Ingrese su numero de cupon');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'EXPERATION_DATE', 'Fecha de Vencimiento');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'EXPIRY_DATE', 'Fechad de Vencimiento');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'FEATURED_AUCTIONS', 'Subastas Destacadas');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'FIELDS_WERE_NOT_FILLED_IN', 'Los siguientes “Requeridos” los campos no estaban llenos . Usando su “atras” boton, porfavor regrese y llene todos los campos requeridos.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'FILL_OUT_THE_FORM_BELOW', 'Llena el siguiente formulario');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'FILL_YOUR_CREDIT_CARD_DETAILS', 'Por favor, llene sus datos de tarjeta de credito');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'FIRST_NAME', 'Nombre');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'FIRST_NAME_ON_CARD', 'Nombre que aparece en la tarjeta');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'FORGET_PASSWORD', 'Olvido su password');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'FORGOTTEN', 'Ha olvidado?');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'FORM_ID_FIELD', 'Campo de ID ');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'FOR_THIS_CATEGORY', 'para esta categoria');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'FREE_BIDS', 'Bids Gratis');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'FREE_REGISTRATION', 'Registro Gratis');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'FULL_NAME', 'Nombre Completo');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'FUTURE_AUCTION', 'Subastas Futuras');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'FUTURE_AUCTIONS', 'Subastaas Futuras');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'GBP', 'GBP');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'GET_5_BID_POINTS_ON_REGISTRATION', 'Obten 5 Bids Cuando te registres!!!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'HAVE_YOU_ALREADY_REGISTERED', 'Ya estas Registrado?');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'HIGH_BIDDER', 'Bidder mas Alto');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'HOME', 'Home');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'HOME_OF_THE_MOST_EXCITING_AUCTIONS_ON_THE_INTERNET', 'Sito de las subastas mas emocionantes en el Internet');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'IMAGE', 'IMAGEN');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'INCORRECT_COUPON_CODE', 'Codigo de Cupon Invalido!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'INPUT_MAXLENGTH_VIOLATION', 'Input Maxlength Violation');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'INSTEAD_OF', 'En lugar de');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'INVALID_EMAIL_ADDRESS', 'Email Invalido');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'INVALID_USERNAME_PASSWORD', 'Nombre de usuario y password Invalido');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'INVITE_A_FRIENDS', 'Invita a un amigo');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'I_HAVE_READ_UNDERSTOOD_AND_ACCEPTED', 'He leido, entendido y acepto de');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'JOINT_DATE', 'Fecha de Ingreso');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'LAST_DATE_OF_AVAILIBILITY', 'Ultima fecha de disponibilidad');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'LAST_NAME', 'Apellidos');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'LAST_NAME_ON_CARD', 'Apellido que aparece en la tarjeta');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'LIVE_AUCTION', 'Subastas en Vivo');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'LIVE_AUCTIONS', 'Subastas En Vivo');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'LOGIN', 'Ingreso');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'LOGIN_INFORMATION', 'Informacion de Acceso');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'MAKE_PAYMENT', 'Efectuar pago');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'MASTERCARD', 'MasterCard');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'MESSAGE', 'Mensaje');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'MIKE_CHERIM', 'Mike Cherim');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'MINORS', 'minors');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'MORE', 'More');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'MORE_AUCTIONS', 'Mas Subastas');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'NEWS', 'News');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'NEWS_DATE', 'fecha de noticias');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'NEW_BRAND_NAME_PRODUCTS_AND_AMAZING_PRICES', 'Nuevo, Productos de Marca a Precios Increibles');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'NEW_TO', 'Nuevo en');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'NEW_USER_REGISTRATION', 'Registro de Nuevo Usuario');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'NOTE_', 'Nota: La entrada a continuacion deben not rellenar. Es una trampa de spam. Por favor, pasar por alto. Si rellena esta entrada, se puede devolver un error.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'NOTE_CODE_AND_MARKUP_WILL_BE_REMOVED_FROM_ALL_FIELDS', 'Note: Code and markup will be removed from all fields!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'NOW_PRODUCT_TO_SELECT_TO_BUY', 'Seleecione el producto que desea Comprar !');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'NO_ENDED_AUCTION_TODISPLAY', 'No hay Subastas Finalizadas que mostrar');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'NO_FUTURE_AUCTION_TO_DISPLAY', 'No hay Subastas Futuras qeu mostrar');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'NO_LIVE_AUCTIONS_TO_DISPLAY', 'No hay Subastas en Vivo que mostar');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'NO_LIVE_AUCTION_TO_DISPLAY', 'No hay Subastas en Vivo que Mostrar');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'NO_NEWS_TO_DISPLAY', 'No hay noticias que mostrar');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'NO_PROBLEM_JUST_ENTER_YOUR_EMAIL_AND_WE_WILL_SEND_THE_INFORMATION_TO_YOUR_EMAIL_ACCOUNT', 'No hay problema, simplemente introduzca su email y le enviaremos la informacion a su cuenta de correo electronico.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'NO_REDEMPTION_TO_DISPLAY', 'No hay amortizacion para mostrar');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'NO_WORRIES_THE_TEXT_ENTERED_HERE_IS_CASE_INSENSITIVE', 'No se preocupe, el texto introducido aqui exiten mayusculas y minusculas');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'OFF', 'menos');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'OPTIONAL', 'Opcional');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'PASSWORD', 'Password');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'PASSWORD_IS_TOO_SHORT', 'Password es muy corto !!!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'PASSWORD_MISMATCH', '');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'PASSWORD_SECURITY', 'Password de seguridad');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'PAYMENT_GOOGLE_CHECKOUT', 'Pago via google checkout');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'PERSONAL_INFORMATION', 'Informacion Personal');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'PHONE_NUMBER', 'Telefono');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'PLACED_BIDS', 'Bids colocados');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'PLEASE_ACCEPT_OUT_PRIVACY_POLICY', 'Por favor acepte nuestras Politicas de Privacidad!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'PLEASE_ACCEPT_OUT_TERMS_CONDITIONS', 'Por favor acepte nuestros Terminos & Condiciones!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'PLEASE_CHOOSE_WHICH_BIDPACK', 'Por Favos selecione el BidPack que desea comprar');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'PLEASE_CMPLETE_THE_FOLLOWING', 'Por favor complete el siguiente Formulario');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'PLEASE_CONFIRM_YOUR_REGISTRATION', 'Por favor confirmar su registro!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'PLEASE_ENTER_ADDRESS', 'Por favor ingrese direccion!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'PLEASE_ENTER_CITY', 'Por favor ingrese ciudad!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'PLEASE_ENTER_CONFIRM_EMAIL_ADDRESS', 'Por favor re-ingrese Email!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'PLEASE_ENTER_CONFIRM_NEW_PASSWORD', 'Por favor confirme nuevo Password !!!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'PLEASE_ENTER_CORRECT_SECURITY_CODE', 'Por favor, introduzca el codigo de seguridad correcto!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'PLEASE_ENTER_EMAIL', 'Por favor ingrese su Email!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'PLEASE_ENTER_EMAILADDRESS', 'Por favor ingrese Email!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'PLEASE_ENTER_EMAIL_ADDRESS', 'por favor ingrese direccion de Email!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'PLEASE_ENTER_FIRST_NAME', 'Por favor ingrese Nombre!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'PLEASE_ENTER_LAST_NAME', 'Por favor ingrese apellidos!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'PLEASE_ENTER_NEW_PASSWORD', 'Por Favor Ingrese nuevo Password !!!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'PLEASE_ENTER_PASSWORD', 'Por favor ingrese password');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'PLEASE_ENTER_PHONE_NUMBER', 'Por favor ingrese Numero de Telefono!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'PLEASE_ENTER_POSTCODE', 'Por favor ingrese Codigo Postal!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'PLEASE_ENTER_SECURITY_CODE', 'Por favor ingrese codigo de seguridad!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'PLEASE_ENTER_USERNAME', 'Por favor ingrese nombre de usuario!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'PLEASE_ENTER_USERNAME_AND_PASSWORD', 'Por favor ingrese nombre de usuario y password');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'PLEASE_ENTER_VALID_EMAIL', 'Por favor ingrese un Email valido!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'PLEASE_ENTER_VALID_EMAIL_ADDRESS', 'Por favor ingrese direccion de Email valida!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'PLEASE_ENTER_VALID_REFERRER_CODE_OR_SKIP_IT', 'Por favor, introduzca el codigo de referentes validos o salta esto!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'PLEASE_ENTER_YOUR_CARD_NAME', 'Por favor ingrese su nombre de la tarjeta!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'PLEASE_ENTER_YOUR_LOGIN_DATA_HERE', 'Por favor, introduzca sus datos de acceso aqui');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'PLEASE_MAKE_A_SELECTION', 'Por favor haga una selecci�n');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'PLEASE_RETYPE_PASSWORD', 'Por favor re-ingrese password!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'PLEASE_SELECT_BIRTH_DATE', 'Por favor ingrese fecha de nacimiento!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'PLEASE_SELECT_COUNTRY', 'Seleccione Pais');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'PLEASE_SELECT_STATE', 'Selecione Estado<');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'PLEASE_SELECT_VOUCHER', 'Selecione el bono');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'PLEASE_VALID_EMAIL_ADDRESS', 'Por favor ingrese Email valido!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'PLESE_CHECK_YOUR_INPUT', 'Por favor llene todo los campos requeridos');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'POSTAL_CODE', 'Codigo Postal');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'PRIVACY', 'Privacidad');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'PRODUCT_DETAILS', 'Detalle del produnto');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'PRODUCT_NAME', 'Nombre del Producto');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'PRODUCT_PRICE', 'Precio del Producto');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'PURCHASED_BIDS', 'Bids comprados');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'REDEMPTION', 'Amortizar');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'REDEMPTION_POINTS', 'Puntos para amortizar');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'REFER_A_FRIEND', 'Recomiende a un Amigo');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'REGISTER', 'Registro');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'REGISTER_NOW', 'Registrate Ahora!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'REQUIRED', 'Requerido');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'REQUIRED_FILED', 'Este campo es requerido');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'REQUIRED_FILELD_MISSED', 'Campo Obligatorio(s) Perdidos');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'RESULTS', 'Resultados');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'RETYPE_EMAIL_ADDRESS', 'Re-ingrese Direccion de Email');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'RETYPE_PASSWORD', 'Re-ingrese Password');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'SECURE_AND_ACCESSIBLE', 'Seguro y accesible');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'SELECT_BIRTHDAY_DATE', 'por favor seleccione fecha de nacimiento');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'SELECT_ONE', 'selecione uno');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'SELECT_THIS_PACKAGHE', 'Seleccione este paquete');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'SEND', 'ENVIAR');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'SHIPPING_CHARGE', 'Cargo del Envio');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'SORRY_YOUR_PAYMENT_PROCESS_WAS_NOT_SUCCESFULL', 'Lo sentimos, el proceso de pago no fue exitoso');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'START', 'COMENZO');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'STATE', 'Estado');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'STATUS', 'ESTADO');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'SUBJECT', 'Asunto');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'SUBMIT', 'ENVIAR');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'SUBTOTAL', 'Subtotal');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'TAX_AMOUNT', 'Tax Amount');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'THESE_AUCTIONS_ARE_ABOUT_TO_END', 'estas subastas estan a punto de finalizar');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'THE_CHANCE_TO_WIN_AMAZING_PRODUCTS_AT_AMAZING_PRICES', 'Gana productos Sorprendentes a Precios Sorprendentes');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'THE_EMAIL_ADDRESS_ALREADY_EXISTS', 'Esta direccion de correo electronico ya existe!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'THE_EMAIL_ADDRESS_YOU_HAVE_SUBMITTED_SEEMS_TO_BE_INVALID', 'La direccion de correo electronico que ha enviado parece ser invalida. Usando su “Atras” boton, por favor, regrese y compruebe la direccion que ha ingresado. Por favor, trate de no preocuparse,');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'THE_FOLLOWING_REQUIRED', 'Los siguientes “Requeridos”');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'THE_PRODUCT_DONT_ALLOW_TO_BUY_IT_NOW', 'El Producto no se permiten comprar ahora!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'THE_WORTH_UP_TO_PRICE_REFLECTS_THE_MANUFACTURERS_SUGGESTED_RETAIL_PRICE', 'El "e;valor de hasta"e; precio refleja el precio de venta sugerido por los fabricantes.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'THIS_USERNAME_ALREADY_EXISTS', 'Este nombre de usuario ya existe!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'TITLE', 'Titulo');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'TOTAL_PAYMENT', 'Total del pago');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'TOWN_CITY', 'Municipio/Ciudad');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'TO_GO_BACK', 'para regresar');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'TO_REGISTER_WITH', 'Para inscribirse en');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'USD', 'MXN');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'USD_ONLY', 'Solo MXN');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'USER', 'Usuario');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'USERNAME', 'Nombre de Ususario');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'USERNAME_IS_TOO_SHORT', 'Nombre de usuario muy corto!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'USERNAME_OR_PASSWORD', 'Nombre de usuario o password');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'VALUE', 'Valor');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'VISA', 'Visa');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'VOUCHER_AMOUNT', 'Monto del bono');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'WHY_ASK', 'por que pregunta');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'WORTH_UP_TO', 'Vale la pena hasta');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'YES_I_WANT_TO_RECEIVE', 'Si, quiero recibir');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'YOUR_ACCOUNT_IS_DELETED_BY', 'Su cuenta se elimina por');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'YOUR_ACCOUNT_IS_SUSPENDED_BY', 'Su cuenta ha sido suspendida por');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'YOUR_AFFILIATE_CODE', 'Su c�digo de afilicion');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'YOUR_AFFILIATE_URL', 'Su URL afiliado');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'YOUR_CREDIT_CARD_CCV_INVALID', 'Su numero de tarjeta de credito CCV / AMEX  parece ser invalido!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'YOUR_EMAIL', 'Su Email');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'YOUR_POSTAL_ADDRESS', 'Su direccion postal');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'YOU_DO_NOT_HAVE_ANY_BIDS', 'Usted no tiene ningun Bid en su cuenta aun');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'YOU_DO_NOT_HAVE_SUFFICIENT_POINTS_IN_YOUR_ACCOUNT_TO_REDEEM_THIS_PRODUCT', 'Usted no tiene suficientes puntos en su cuenta para canjear este producto!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'YOU_HAVE_CHOOSEN', 'Usted ha selecionado');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'YOU_HAVE_CURRENTLY_SELECTED', 'Usted ha seleccionado');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'YOU_HAVE_FORGOTTEN_YOUR_LOGIN_DATA', 'Ha olvidado sus datos de acceso?');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'YOU_POPULATED_A_SPAM_TRAP_ANTI_SPAM_INPUT_SO_YOU_MUST_BE_A_SPAMBOT', 'You populated a spam trap anti-spam input so you must be a spambot. Go away!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'YOU_POPULATED_A_SPAM_TRAP_ANTI_SPAM_INPUT_THAT_IS_MEANT_TO_CONFUSE', 'You populated a spam trap anti-spam input that is meant to confuse automated spam-sending machines. If you accidently entered data in this field, using your “Back” button, please go back and remove it before submitting this form. Sorry for the confusion.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'german', 'ZIP_CODE', 'Codigo Postal');

-- NEXT_QUERY --

INSERT INTO `language` (`id`, `language`, `languagename`, `enable`, `flag`) values (5,'portugues','Portugues',1,'br.gif');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', '', '');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'ABOUT_US', 'Quem somos');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'ACCEPT', 'Aceitar');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'ACCEPT_DENIED', 'Aceitar/Rejeitar');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'ACCEPT_WON_AUCTION', 'Aceitar o leilão vencido');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'ADD', 'Adicionar');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'ADDITIONAL_INFORMATION', 'Informações adicionais');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'ADDRESS_LINE', 'Complemento');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'ADD_COMMENT', 'Adicionar comentário');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'AFFILIATE_CODE', 'Código de afiliado');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'AFTER_CLICKING_ON_CONFIRM_BUTTON_POINTS_WILL_BE_AUTOMATICALLY_DEBITED_FROM_YOUR_ACCOUNT', 'Nota: após clicar no botão de confirmar os pontos serão automaticamente debitados da sua conta.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'AFTER_PAYMENT_THE_BIDS_WILL_BE_BOOKED_TO_YOUR_ACCOUNT', 'Após o pagamento os lances serão creditados em sua conta');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'AFTER_PAYMENT_THE_PRODUCT_WE_WILL_SEND_IT', 'Após o pagamento do produto, estaremos providenciando o envio imediato');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'ALL_AUCTIONS', 'Todos os Leilões');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'AMERICAN_EXPRESS', 'American Express');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'AMOUNT', 'QUANTIA');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'ANTI_SPAM_TRAP_1_FIELD_POPULATED', 'Anti-Spam Trap 1 campo popular');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'ANTI_SPAM_TRAP_2_FIELD_POPULATED', 'Anti-Spam Trap 2 Field Populated');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'AN_EMAIL_WAS_SENT_TO', 'Email enviado para');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'APPLY_COUPON', 'CONFIRME O CUPOM');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'AUCTION', 'LEILÃO');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'AUCTIONS', 'Leilões');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'AUCTION_DETAILS', 'Detalhes do leilão');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'AUCTION_TYPE', 'Tipo de leilão');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'BE_AT_LEAST_6_CHARACTERS_LONG', 'deve conter no mínimo 6 dígitos');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'BIDDING', 'Lances');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'BIDS', 'Lances');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'BIDS_PAYMENT', 'Pagamento dos Lances');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'BID_NOW', 'DAR LANCE');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'BID_PACK', 'Pacote de Lances');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'BUY_A_BIDPACK', 'Comprar pacote de lances');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'BUY_BID', 'Comprar Lance');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'BUY_BIDS', 'Compre Lances');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'BUY_PRICE', 'Preço de Compra');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'BUY_PRODUCT', 'Comprar produto');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'BUY_PRODUCT_NOW', 'Compre Agora');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'CANCEL', 'CANCELAR');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'CARD_NUMBER', 'Número do cartão');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'CARD_TYPE', 'Cartão tipo');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'CERTAIN_INPUTS_HAVE_BEEN_POPULATED_BEYOND_THAT_WHICH_IS_ALLOWED', 'Certain inputs have been populated beyond that which is allowed by the form. Therefore you must be trying to post remotely and are probably a spambot. Go away!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'CHANGE_PASSWORD', 'Altere a senha');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'CHANGE_YOUR_PASSWORD', 'Altere sua senha');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'CHECK_THIS_BOX_IF_YOU_WANT_CARBON_COPY_OF_THIS_EMAIL', 'Marque aqui, caso queira que uma cópia seja enviada para seu email.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'CHOOSE_PAYMENT_METHOD', 'Escolha uma forma de pagamento');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'CITY', 'Cidade');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'CLICK_ACTIVE_YOUR_ACCOUNT', 'por favor clique no link enviado. Você tem apenas 48 horas para confirmar seu cadastro.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'CLICK_BUTTON_TO_SUBMIT_FORM', 'Clique no botao para enviar formulário');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'CLICK_HERE', 'Clique aqui');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'COMBINABLE', 'COMPATÍVEL');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'COMMENTS', 'Comentários');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'COMMUNITY', 'Comunidade');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'CONFIG_ACCCESS_NOT_ALLOWED', 'Configuração de acesso não permitida!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'CONGRATULATIONS', 'PARABÉNS!!!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'CONTACT_FORM', 'Formulário de contato');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'CONTACT_US', 'Contato');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'COUNTDOWN', 'Contador');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'COUNTRY', 'País');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'CREDIT_CARD_NUMBER_INVALID', 'Cartão inválido. Certifique-se de não estar inserindo caracteres extras');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'CUSTOMER_SERVICE', 'Serviço ao consumidor');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'CVV2_SECURITY_CODE', 'CVV2 Código de segurança');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'DATE', 'DATA');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'DATE_OF_BIRTH', 'Data de Nascimento');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'DELIVERY_AND_SHIPPING', 'Entregas');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'DENIED', 'Rejeitar');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'DESCRIPTION', 'DESCRIÇÃO');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'DISCOUNT', 'Desconto');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'DISCOVER', 'Discover');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'DONT_WANT_TO_HEAR_ABOUT_OUR_GREAT_DEALS_ANY_MORE', '"e;Não deseja receber mais notícias sobre nossas ofertas e muito mais?"e;');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'DO_RESPECT_YOUR_PRIVACY', 'Nós respeitamos sua privacidade.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'EMAIL_ADDRESS', 'Email');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'EMAIL_ADDRESS_MISMATCH', 'Email não confere!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'EMAIL_CONFIRMATION', 'Email de confirmação');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'EMAIL_SEND_SUCCESSFULLY', 'Email enviado com sucesso!!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'EMAIL_SENT_SUCCESSFULLY', 'Email enviado!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'EMPTY_FIELDS', 'Campo(s) vazio(s)');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'ENDED', 'Encerrado');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'ENDED_AUCTIONS', 'Leilões Finalizados');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'END_DATE', 'Término');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'ENTER_ADDRESS', 'Endereço');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'ENTER_A_COUPONCODE_PLEASE', 'Entre com o código do cupom!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'ENTER_A_COUPON_CODE', 'ENTRE COM O CÓDIGO DO CUPOM');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'ENTER_EMAIL_ADDRESS_TO_INVITE', 'Digite o email de quem gostaria de convidar ');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'ENTER_THE_CODE', 'Entre com o código');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'ENTER_THE_COUPON_CODE_PLEASE', 'Entre com o código do produto');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'EXPERATION_DATE', 'Data que Expira');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'EXPIRED', 'Expirado');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'EXPIRY_DATE', 'Data em que expira');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'FEATURED_AUCTIONS', 'Dados do leilão');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'FEEDBACK', 'Feedback');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'FIELDS_WERE_NOT_FILLED_IN', 'O seguinte “é necessário” campos não preenchidos. Usando seu “Voltar” botão, Por favor preencha todos os campos.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'FILL_OUT_THE_FORM_BELOW', 'Preencha o formulário abaixo');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'FILL_YOUR_CREDIT_CARD_DETAILS', 'Por favor preencha os detalhes do seu cartão de crédito');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'FIRST_NAME', 'Primeiro Nome');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'FIRST_NAME_ON_CARD', 'Primeiro nome');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'FORGET_PASSWORD', 'Esqueci minha senha');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'FORGOTTEN', 'Esqueci');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'FORGOT_PASSWORD', 'Esqueceu sua Senha?');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'FORM_ID_FIELD', 'Campo de ID do formulário');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'FOR_THIS_CATEGORY', 'para esta categoria');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'FREE_BIDS', 'Lances Gr�tis');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'FREE_REGISTRATION', 'Registre-se Grátis');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'FULL_NAME', 'Nome completo');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'FUTURE_AUCTION', 'Leilão Futuro');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'FUTURE_AUCTIONS', 'Leilões Futuros');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'GBP', 'BRL');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'GET_5_BID_POINTS_ON_REGISTRATION', 'Ganhe 5 pontos ao registrar-se!!!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'GET_IN_TOUCH', 'Fique Ligado');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'HAVE_FUN_AND_GOOD_LUCK', 'Divirta-se e boa sorte!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'HAVE_YOU_ALREADY_REGISTERED', 'Você já se registrou?');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'HERE', 'AQUI');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'HERE_YOU_CAN_SEE_OUR_ALL_LIVE_AUCTIONS', 'Aqui você vê todos os leilões ativos');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'HIGH_BIDDER', 'Maior lance');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'HOME', 'Home');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'HOME_OF_THE_MOST_EXCITING_AUCTIONS_ON_THE_INTERNET', 'Os melhores leilões da internet');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'IF_YOU_DONT_RECEIVE_THIS_EMAIL', '"e;Caso não receba o email, verifique sua caixa de spam.se mesmo assim ainda não tiver recebido o email verifique se o email digitado está correto"e;');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'IF_YOU_HAVENT_GOT_A_USERNAME_OR_PASSWORD', '"e;Se você nao possui um usuário e senha, você pode pular esta etapa."e;');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'IMAGE', 'IMAGEM');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'INCORRECT_COUPON_CODE', 'Código do cupom inválido!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'INPUT_MAXLENGTH_VIOLATION', 'Input Maxlength Violation');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'INSTEAD_OF', 'ao invés de');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'INTERNATIONAL_AUCTIONS', 'Leilões Internacionais');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'INVALID_EMAIL_ADDRESS', 'Email inválido');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'INVALID_USERNAME_PASSWORD', 'Nome/senha de usuário inválidos');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'INVITE_A_FRIENDS', 'Convidar amigos');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'I_HAVE_READ_UNDERSTOOD_AND_ACCEPTED', 'Eu li e Concordo');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'JOINT_DATE', 'Cadastrado em');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'JOIN_DATE', 'Data de cadastro');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'LAST_COMMENT_POST_BY', 'Último cometário postado por');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'LAST_DATE_OF_AVAILIBILITY', 'Último dua disponível');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'LAST_NAME', 'Último Nome');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'LAST_NAME_ON_CARD', 'Segundo nome');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'LAST_POST_BY', 'Última postagem feita por');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'LIVE_AUCTION', 'Leilão ativo');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'LIVE_AUCTIONS', 'Leilões Ativos');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'LOGIN', 'Login');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'LOGIN_AND_CONTACT_US', 'Faça o login e entre em contato');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'LOGIN_INFORMATION', 'Dados para login');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'MAKE', 'Faça');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'MAKE_PAYMENT', 'Realizar  Pagamento');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'MANAGING_MYACCOUNT', 'Minha conta');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'MASTERCARD', 'MasterCard');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'MESSAGE', 'Mensagem');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'MIKE_CHERIM', 'Mike Cherim');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'MORE', 'Mais');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'MORE_AUCTIONS', 'Mais leilões');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'MY_COUPON_HISTORY', 'Hist�rico de Cupons');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'NAME', 'Nome');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'NEWS', 'Notícias');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'NEWS_DATE', 'Data da notícia');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'NEW_BRAND_NAME_PRODUCTS_AND_AMAZING_PRICES', 'Produtos Novos, com garantia e preços incríveis');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'NEW_LETTERS', 'NewsLetter');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'NEW_TO', 'Novo');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'NEW_USER_REGISTRATION', 'Registro de novo usuário');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'NOTE_', 'Nota: A informação abaixo não foi preenchida. Este é um anti spam. Por favor ignore. If you populate this input, the form will return an error.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'NOTE_CODE_AND_MARKUP_WILL_BE_REMOVED_FROM_ALL_FIELDS', 'Nota: notas serão removidas de todos os campos!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'NOT_REGISTERED_WITH', 'Não registrado');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'NOW_PRODUCT_TO_SELECT_TO_BUY', 'Selecione o produto para comprar');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'NO_COUPON_TO_DISPLAY', 'Nenhum Cupom para ser exibido');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'NO_ENDED_AUCTION_TODISPLAY', 'Nenhum leilão finalizado para exibir');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'NO_FUTURE_AUCTION_TO_DISPLAY', 'Nenhum leilão futuro para exibir');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'NO_LIVE_AUCTIONS_TO_DISPLAY', 'Nenhum leilão ativo');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'NO_LIVE_AUCTION_TO_DISPLAY', 'Não existem leilões para exibir');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'NO_NEWS_TO_DISPLAY', 'Nenhuma notícia para exibir');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'NO_PROBLEM_JUST_ENTER_YOUR_EMAIL_AND_WE_WILL_SEND_THE_INFORMATION_TO_YOUR_EMAIL_ACCOUNT', 'Digite seu Email e enviaremos as informações para que possa acessar sua conta.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'NO_REDEMPTION_TO_DISPLAY', 'Nenhum resgate para ser exibído');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'NO_VOUCHERS_TO_DISPLAY', 'Nenhum cupom para exibir');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'NO_WORRIES_THE_TEXT_ENTERED_HERE_IS_CASE_INSENSITIVE', 'Não se preocupe, o texto digitado não diferencia maiúsculas e minúsculas');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'OFF', 'Off');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'OPTIONAL', 'Opcional');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PASSWORD', 'Senha');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PASSWORD_IS_TOO_SHORT', 'Senha muito curta!!!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PASSWORD_MISMATCH', 'Senhas não conferem!!!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PASSWORD_SECURITY', 'Senha de segurança');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PAYMENTS_AND_PAYMENT_METHODS', 'Pagametos e Formas de Pagamento');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PAYMENT_GOOGLE_CHECKOUT', 'Pagamento via google checkout');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PERSONAL_INFORMATION', 'Informações pessoais');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PHONE_NUMBER', 'Telefone');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PLACED_BIDS', 'Lances Dados');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PLEASE', 'Por Favor');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PLEASE_ACCEPT_OUT_PRIVACY_POLICY', 'Aceitar nossa Política de Privacidade!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PLEASE_ACCEPT_OUT_TERMS_CONDITIONS', 'Aceitar nossos Termos e Condições!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PLEASE_CHECK_YOUR_EMAIL_ADDRESS_AGAIN', 'Email inválido.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PLEASE_CHECK_YOUR_INPUT', 'Preencha todos os campos necessários');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PLEASE_CHOOSE_WHICH_BIDPACK', 'Escolha qual pacote de lances você gostaria de comprar');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PLEASE_CMPLETE_THE_FOLLOWING', 'Complete o seguinte');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PLEASE_CONFIRM_YOUR_REGISTRATION', 'Por favor confirme seu registro!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PLEASE_ENTER_ADDRESS', 'Endereço!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PLEASE_ENTER_AUCTION_ID', 'Por favor forneça o ID do leilão');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PLEASE_ENTER_CITY', 'Cidade!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PLEASE_ENTER_CONFIRM_EMAIL_ADDRESS', 'confirme seu email!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PLEASE_ENTER_CONFIRM_NEW_PASSWORD', 'Por favor, confirme sua senha!!!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PLEASE_ENTER_CORRECT_SECURITY_CODE', 'Favor informar o código de segurança válido!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PLEASE_ENTER_EMAIL', 'Insira o endereço de e-mail!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PLEASE_ENTER_EMAILADDRESS', 'Endereço de email!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PLEASE_ENTER_EMAILADDRESS_TO_SUBSCRIBE', 'Indique um endereço de email para se inscrever!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PLEASE_ENTER_EMAILADDRESS_TO_UNSUBSCRIBE', 'Indique o endereço de email que não deseja mais estar inscrito!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PLEASE_ENTER_EMAIL_ADDRESS', 'Digite o email!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PLEASE_ENTER_FIRST_NAME', 'Primeiro nome!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PLEASE_ENTER_LAST_NAME', 'Último nome!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PLEASE_ENTER_MESSAGECONTENT', 'Digite o conteúdo da mensagem!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PLEASE_ENTER_NAME', 'Forneça o Nome!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PLEASE_ENTER_NEW_PASSWORD', 'Digite uma nova senha !!!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PLEASE_ENTER_PASSWORD', 'Digite sua senha');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PLEASE_ENTER_PHONE_NUMBER', 'Telefone!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PLEASE_ENTER_POSTCODE', 'CEP!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PLEASE_ENTER_SECURITY_CODE', 'Digite o código de segurança!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PLEASE_ENTER_USERNAME', 'Usuário!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PLEASE_ENTER_USERNAME_AND_PASSWORD', 'Entre com seu usuário e senha');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PLEASE_ENTER_VALID_EMAIL', 'Por favor entre com um email válido!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PLEASE_ENTER_VALID_EMAIL_ADDRESS', 'Por favor, insira o endereço de email válido!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PLEASE_ENTER_VALID_REFERRER_CODE_OR_SKIP_IT', 'Entre com o código de indicação ou pule esta parte!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PLEASE_ENTER_YOUR_CARD_NAME', 'Digite seu nome como está no cartão!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PLEASE_ENTER_YOUR_LOGIN_DATA_HERE', 'Favor enviar seus dados de acesso');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PLEASE_ENTER_YOUR_NEW_PASSWORD', 'Entre com sua Senha');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PLEASE_MAKE_A_SELECTION', 'Por favor selecione');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PLEASE_RETYPE_PASSWORD', 'Digite a senha novamente!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PLEASE_RETYPE_YOUR_NEW_PASSWORD', 'Entre com a Senha novamente');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PLEASE_SELECT', 'Por favor selecione');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PLEASE_SELECT_BIRTH_DATE', 'Selecione a Data de Nascimento');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PLEASE_SELECT_COUNTRY', 'Selecione o país');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PLEASE_SELECT_STATE', 'Selecione o estado<');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PLEASE_SELECT_SUBJECT', 'Selecione um assunto');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PLEASE_SELECT_VOUCHER', 'Entre com seu cupom');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PLEASE_SELECT_YOUR_SUBJECT', 'Selecione o Assunto!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PLEASE_TAKE_A_LOOK', 'Dê uma olhada');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PLEASE_VALID_EMAIL_ADDRESS', 'Entre com um email válido!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'POINTS', 'Pontos');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'POSTAL_CODE', 'CEP');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PRIVACY', 'Privacidade');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PRODUCT_DETAILS', 'Detalhes do Produto');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PRODUCT_NAME', 'Nome do Produto');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PRODUCT_PRICE', 'Preço do produto');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'PURCHASED_BIDS', 'Lances Comprados');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'QUESTIONS_ABOUT', 'Questões sobre');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'RATE_IT', 'Avaliação');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'REDEEM', '"e;Redeem"e;');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'REDEMPTION', 'Resgatar');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'REDEMPTION_DETAILS', 'Detalhes do Resgate');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'REDEMPTION_PAYMENT', 'Resgate de pagamentos');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'REDEMPTION_POINTS', 'Resgate de pontos');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'REFER_A_FRIEND', 'Indique um amigo');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'REGISTER', 'Registrar');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'REGISTER_NOW', 'Registre-se!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'REGISTRATION', 'Registro');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'REPORT_ABUSE', 'Reportar Abuso');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'REQUIRED', 'Requerido');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'REQUIRED_FILED', 'Campo é obrigatório');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'REQUIRED_FILELD_MISSED', 'Campo(s) em branco');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'RESULTS', 'Resultados');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'RETYPE_EMAIL_ADDRESS', 'Digite o email novamente');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'RETYPE_PASSWORD', 'Digite a Senha novamente');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'RUNNING', 'Ativo');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'SECURE_AND_ACCESSIBLE', 'Segurança e acessibilidade');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'SELECT_ACCEPT_OR_DENIED', 'Por favor selecione aceitar ou rejeitar!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'SELECT_BIRTHDAY_DATE', 'Data de Nascimento');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'SELECT_ONE', 'Selecione um');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'SELECT_THIS_PACKAGHE', 'Selecione este Pacote');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'SEND', 'ENVIAR');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'SHIPPING_CHARGE', 'Valor do envio');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'SKIP_LOGIN', 'Pular login');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'SORRY_WE_DIDNT_FIND_YOUR_EMAIL_ADDRESS_IN_OUR_SYSTEM', '"e;Não encontramos seu email no sistema!"e;');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'SORRY_YOUR_PAYMENT_PROCESS_WAS_NOT_SUCCESFULL', 'Lamentamos, mas seu pagamento não foi processado');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'START', 'INÍCIO');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'STATE', 'Estado');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'STATUS', 'STATUS');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'SUBJECT', 'Assunto');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'SUBMIT', 'Enviar');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'SUBSCRIBE', 'ASSINAR');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'SUBSCRIBE_TO_NEWSLETTER', 'Assinar newsletter ');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'SUBTOTAL', 'Subtotal');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'TEAM', 'Time');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'TECHNICAL_PROBLEMS', 'Problemas técnicos');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'THANK_YOU_FOR_SUBSCRIBING_TO_OUR_NEWSLETTER', 'Obrigado por assinar nossa newsletter.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'THESE_AUCTIONS_ARE_ABOUT_TO_END', 'Estes leilões estão próximos de finalizar');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'THE_CHANCE_TO_WIN_AMAZING_PRODUCTS_AT_AMAZING_PRICES', 'Adquira produtos por preços incríveis');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'THE_EMAIL_ADDRESS_ALREADY_EXISTS', 'Este email já existe!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'THE_EMAIL_ADDRESS_YOU_HAVE_SUBMITTED_SEEMS_TO_BE_INVALID', 'Email inválido. Usando o seu “Voltar” botão, por favor volte e tente novamente,');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'THE_FOLLOWING_REQUIRED', 'O seguinte “é necessário”');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'THE_PRODUCT_DONT_ALLOW_TO_BUY_IT_NOW', 'Não é permitido comprar esse produto agora!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'THE_WORTH_UP_TO_PRICE_REFLECTS_THE_MANUFACTURERS_SUGGESTED_RETAIL_PRICE', 'O valor do produto é baseado no valor sugerido pelo fabricante.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'THIS_ACCOUNT_IS_NOT_VERIFIED_YET_PLEASE_VERIFY_FIRST', '"e;Esta conta não foi verificada. Favor primeiro verificá-la."e;');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'THIS_CONFIRMS_YOUARE_A_HUMAN_USER', '"e;Isto confirma que você não é uma bot de spam"e;');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'THIS_USERNAME_ALREADY_EXISTS', 'Este nome de usuário já existe!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'TITLE', 'T�tulo');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'TOTAL_COMMENT', 'Total de comentários');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'TOTAL_PAYMENT', 'Total');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'TOTAL_POST', 'Total de postagens');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'TOWN_CITY', 'Cidade');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'TO_CONTINUE', 'continue...');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'TO_FIND_INCREDIBLE_BARGAINS', 'para achar produtos incríveis');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'TO_GO_BACK', 'Voltar');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'TO_REGISTER_WITH', 'Para registrar-se');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'UNSUBSCRIBE', 'Desmarcar');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'UNSUBSCRIBE_TO_NEWSLETTER', 'Não receber newsletter');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'USD', 'BRL');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'USD_ONLY', 'Apenas em Real');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'USED', 'Usado');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'USER', 'Usuário');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'USERNAME', 'Usuário');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'USERNAME_IS_TOO_SHORT', 'Nome de usuário muito curto!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'USERNAME_OR_PASSWORD', 'Usuário ou Senha');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'USE_DATE', 'Data de Uso');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'VALID_TO', 'VALIDO POR');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'VALUE', 'Valor');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'VISA', 'Visa');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'VOUCHERS', 'Cupons');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'VOUCHER_AMOUNT', 'Valor do Cupom');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'VOUCHER_LABEL', 'Título do Cupom');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'WANT_US_TO_LET_YOU_KNOW_ABOUT_NEW_AUCTIONS_SPECIAL_OFFERS', 'Deseja ser informado sobre novos leilões e ofertas especiais?');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'WELCOME_TO', 'Error: Invalid request');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'WE_HAVE_SENT_AN_EMAIL_TO', '"e;Foi enviado um email para"e;');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'WE_HAVE_SENT_YOU_A_VERIFICATION_EMAIL_COTAINING_YOUR', '"e;Foi enviado um email para verificação contendo os dados de seu login e o link de confirmação."e;');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'WHY_ASK', 'Por que perguntar');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'WORTH_UP_TO', 'Valor acima de');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'YES_I_WANT_TO_RECEIVE', 'Sim, Desejo receber');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'YOUR', 'Seu');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'YOUR_ACCOUNT_IS_DELETED_BY', 'Conta foi deletada por');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'YOUR_ACCOUNT_IS_SUSPENDED_BY', 'Conta foi suspensa por');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'YOUR_AFFILIATE_CODE', 'Seu código de afiliado');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'YOUR_AFFILIATE_URL', 'Sua URL de afiliado');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'YOUR_CREDIT_CARD_CCV_INVALID', 'O seu cartão CCV/AMEX apresenta um número inválido!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'YOUR_EMAIL', 'Seu Email');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'YOUR_EMAIL_TO', 'Seu Email para');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'YOUR_EMAIL_VERIFICATION_IS_CONFIRMED_SUCCESSFULLY', 'Seu Email foi confirmado com sucesso');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'YOUR_PASSWORD_HAS_BEEN_CHANGED', 'Sua senha foi alterada!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'YOUR_POSTAL_ADDRESS', 'Seu endereço');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'YOUR_THE', 'Seu');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'YOU_CANT_GIVE_RATING_MORE_THEN_ONE_TIME_ON_PER_COMMUNITY', '"e;você não pode avaliar mais de um post por comunidade"e;');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'YOU_CANT_GIVE_RATING_ON_YOUR_POSTED_COMMENT', '"e;Você não pode avaliar seu próprio post!"e;');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'YOU_CAN_ONLY_POST_ONE_COMMENT_ON_PER_COMMUNITY', 'Você só pode postar um comentário por comunidade!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'YOU_DO_NOT_HAVE_ANY_BIDS', 'Você não possui nenhum lance em sua conta');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'YOU_DO_NOT_HAVE_SUFFICIENT_POINTS_IN_YOUR_ACCOUNT_TO_REDEEM_THIS_PRODUCT', 'Você não tem pontos suficientes na suaconta para este produto!!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'YOU_HAVE_CHOOSEN', 'Você escolheu');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'YOU_HAVE_CURRENTLY_SELECTED', 'Você selecionou');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'YOU_HAVE_FORGOTTEN_YOUR_LOGIN_DATA', 'Esqueceu seus dados de acesso?');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'YOU_HAVE_UNSUBSCRIBED_FROM_OUR_NEWSLETTER', 'você optou por não receber mais nossa newsletter');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'YOU_MUST_BE_LOGGED_TODO_THAT', 'é necessário estar logado para utilizar essa função! Gostaria de fazer agora?');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'YOU_POPULATED_A_SPAM_TRAP_ANTI_SPAM_INPUT_SO_YOU_MUST_BE_A_SPAMBOT', 'You populated a spam trap anti-spam input so you must be a spambot. Go away!');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'YOU_POPULATED_A_SPAM_TRAP_ANTI_SPAM_INPUT_THAT_IS_MEANT_TO_CONFUSE', 'You populated a spam trap anti-spam input that is meant to confuse automated spam-sending machines. If you accidently entered data in this field, using your “Back” button, please go back and remove it before submitting this form. Sorry for the confusion.');

-- NEXT_QUERY --

INSERT INTO `languages` (id, `language`, `constant`, `value`) VALUES(null, 'portugues', 'ZIP_CODE', 'CEP');

-- NEXT_QUERY --

insert into languages values(null, 'english', 'reversesmall', 'Reverse Auction - prices go down with each bid');

-- NEXT_QUERY --

insert into paypal_info (id, name, enabled) values(null, 'dalpay', '1'), (null, 'dalpaydirect', '1'), (null, 'globalpay', 1);

-- NEXT_QUERY --

insert into languages values(null, 'english', 'CHECK_THIS_BOX_IF_YOU_WANT_CARBON_COPY_OF_THIS_EMAIL', 'Check this box to recieve an email copy of this email');

-- NEXT_QUERY --

insert into languages values(null, 'english', 'BUY_SEAT', 'Buy Seat');

-- NEXT_QUERY --

insert into languages values(null, 'english', 'MESSAGE_ALREADY_HAVE_SEAT_AUCTION', 'You already have a seat for this auction');

-- NEXT_QUERY --

insert into languages values(null, 'english', 'seatedd-small', 'Seated Auction - Timers do not start until seats are filled, only users who have bought seats are allowed to bid');

-- NEXT_QUERY --

alter table shippingstatus add column status varchar(200) null;

-- NEXT_QUERY --

alter table auction add column relisted_from int(22) null;

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `auction_escrow` (
  `id` int(11) NOT NULL auto_increment,
  `auction_id` int(11) not null,
  `user_id` int(11) NOT NULL default '0',
  `bidpack_id` int(11) not null,
  `bids_pledged` int(11) not null,
  `time` datetime not null,
  `transaction_id` varchar(500) null default '',
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ; 

-- NEXT_QUERY --

alter table bidpack add column bid_bonus_percent decimal(3,2) null default '0.00';

-- NEXT_QUERY --

CREATE TABLE IF NOT EXISTS `social_avatar` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL default '0',
  `facebook` varchar(200) default '' null,
  `google` varchar(200) default '' null,
  `twitter` varchar(200) default '' null,
  `pointer` varchar(200) default '' null,
  `time` datetime not null,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ; 