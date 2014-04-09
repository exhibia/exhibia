<?php
/*CREATE TABLE IF NOT EXISTS `auction_escrow` (
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
*/
  
      $row = db_fetch_array(db_query("select * from bidpack where id = '" . $data->bidpackid . "'"));
      
      db_query("insert into auction_escrow values(null, '$_REQUEST[fund_id]', '" . $item->userid . "', '" . $data->bidpackid . "', '$row[bid_size]', NOW(), '" . $item->orderid . "', '0');"); 
      echo db_error();