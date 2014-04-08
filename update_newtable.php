<?php
include("config/connect.php");
include_once 'common/sitesetting.php';
include("functions_s.php");

$sqltab="CREATE TABLE IF NOT EXISTS `auction_running` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `auctionID` int(11) NOT NULL DEFAULT '0',
  `productID` int(11) NOT NULL DEFAULT '0',
  `auc_start_price` float(11,2) NOT NULL DEFAULT '0.00',
  `auc_status` int(10) NOT NULL DEFAULT '0',
  `pause_status` int(10) NOT NULL DEFAULT '0',
  `time_duration` varchar(11) NOT NULL DEFAULT '',
  `use_free` int(10) NOT NULL DEFAULT '0',
  `fixedpriceauction` int(10) NOT NULL DEFAULT '0',
  `pennyauction` int(10) NOT NULL DEFAULT '0',
  `nailbiterauction` int(10) NOT NULL DEFAULT '0',
  `offauction` int(10) NOT NULL DEFAULT '0',
  `nightauction` int(10) NOT NULL DEFAULT '0',
  `openauction` int(10) NOT NULL DEFAULT '0',
  `reverseauction` int(10) NOT NULL DEFAULT '0',
  `uniqueauction` int(10) NOT NULL DEFAULT '0',
  `halfbackauction` int(10) NOT NULL DEFAULT '0',
  `seatauction` int(10) NOT NULL DEFAULT '0',
  `minseats` int(10) NOT NULL DEFAULT '0',
  `maxseats` int(10) NOT NULL DEFAULT '0',
  `seatbids` int(10) NOT NULL DEFAULT '0',
  `lockauction` int(10) NOT NULL DEFAULT '0',
  `locktype` int(10) NOT NULL DEFAULT '0',
  `locktime` int(10) NOT NULL DEFAULT '0',
  `lockprice` float(11,2) NOT NULL DEFAULT '0.00',
  `relist` int(10) NOT NULL DEFAULT '0',
  `deldate` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;";

db_query($sqltab) or die(db_error());

$sqltab1="CREATE TABLE IF NOT EXISTS `auction_run_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `auctionid` int(11) NOT NULL DEFAULT '0',
  `lefttime` int(11) NOT NULL DEFAULT '0',
  `newprice` float(11,2) NOT NULL DEFAULT '0.00',
  `heighuseravatar` varchar(1000) NOT NULL DEFAULT '0',
  `heighuser` varchar(50) NOT NULL DEFAULT '',
  `pause_status` int(11) NOT NULL DEFAULT '0',
  `uniqueauction` int(10) NOT NULL DEFAULT '0',
  `lowbidcount` int(10) NOT NULL DEFAULT '0',
  `seatauction` int(10) NOT NULL DEFAULT '0',
  `seatauctionnow` int(10) NOT NULL DEFAULT '1',
  `seatcount` int(10) NOT NULL DEFAULT '0',
  `minseats` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;";
db_query($sqltab1) or die(db_error());

$sqltab2="CREATE TABLE IF NOT EXISTS `bid_account_bidding` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `auction_id` int(10) NOT NULL DEFAULT '0',
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `bid_count` int(10) NOT NULL DEFAULT '0',
  `username` varchar(50) NOT NULL DEFAULT '0',
  `position` varchar(50) NOT NULL DEFAULT '0',
  `bidding_price` float(11,2) DEFAULT '0.00',
  `bidding_type` varchar(4) NOT NULL DEFAULT '',
  `bidpack_buy_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;";
db_query($sqltab2) or die(db_error());

$sqltab3="CREATE TABLE IF NOT EXISTS `free_account_bidding` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `auction_id` int(10) NOT NULL DEFAULT '0',
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `bid_count` int(10) NOT NULL DEFAULT '0',
  `username` varchar(50) NOT NULL DEFAULT '',
  `position` varchar(50) NOT NULL DEFAULT '',
  `bidding_price` float(11,2) DEFAULT '0.00',
  `bidding_type` varchar(4) NOT NULL DEFAULT '',
  `bidpack_buy_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
db_query($sqltab3) or die(db_error());
?>
