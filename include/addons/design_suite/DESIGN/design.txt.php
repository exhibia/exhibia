<?php



db_query("CREATE TABLE IF NOT EXISTS `stylesheets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page` text not null,
  `template` text NOT NULL,
  `element` text NOT NULL,
  `property` text NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `index` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;");

db_query("CREATE TABLE IF NOT EXISTS `templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  
  `template` text NOT NULL,
  `created_by` text NOT NULL,
  `modified` datetime not null,
  PRIMARY KEY (`id`),
  KEY `index` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;");
if(db_num_rows(db_query("select template from templates")) == 0){


    db_query("insert into templates values(null, 'beezid', 'PennyAuctionSoft', '" . date("Y-m-d H:i:s") . "'), (null, 'qbids', 'PennyAuctionSoft', '" . date("Y-m-d H:i:s") . "'), (null, 'bidcactus', 'PennyAuctionSoft', '" . date("Y-m-d H:i:s") . "'), (null, 'wavee', 'PennyAuctionSoft', '" . date("Y-m-d H:i:s") . "'), (null, 'bigdeal', 'PennyAuctionSoft', '" . date("Y-m-d H:i:s") . "'), (null, 'zipbids', 'PennyAuctionSoft', '" . date("Y-m-d H:i:s") . "'), (null, 'upbid', 'PennyAuctionSoft', '" . date("Y-m-d H:i:s") . "'), (null, 'zeebid', 'PennyAuctionSoft', '" . date("Y-m-d H:i:s") . "');");


}
echo db_error();
if(db_num_rows(db_query("select template from stylesheets")) == 0){


    $sql = db_query("select * from templates");

	while($row = db_fetch_array($sql)){

	      include("DESIGN/templates.sql.php");

	  }


}
echo db_error();
$MainLinksArray = array (
        // (item name, link, haschild)
        array ("Design Suite", "#", 1),
        
        /*array ("Shipping Management", "#", 1),
        array ("Manage Newsletter", "#", 1),
        array ("Manage Communities", "#", 1),
        array("Coupon Manage","#",1)*/
);
/*element 3, dashboard class, 4. horizontal  submenu class*/
$ChildLinksArray = array (
        // (subitem name, script name, item's position)
        array ("Logo", "designsuite.php?page=logo.php", 0,'design1','sm1'),
        array ("Templates", "designsuite.php?page=background.php", 0,'design2','sm1'),
        array ("Style Sheets", "designsuite.php?page=stylesheets.php", 0,'design3','sm2'),
        array ("JQuery", "designsuite.php?page=managejquery.php", 0,'design4','sm3'),
    /*    array ("Profit and Loss Reporting", "pandl.php", 1,'database5','sm1'),
    
        array ("Manage Users", "manage_members.php", 2,'database','sm1'),
        array ("Add Users", "addmembers.php", 2,'database','sm1'),
        array ("Add Bid Pack", "addbidpack.php", 2,'database6','sm1'),
        array ("Manage Bid Pack", "managebidpack.php", 2,'database7','sm1'),
        array ("Add Shipping Charge", "addshippingcharge.php", 3,'database8','sm1'),
        array ("Manage Shipping Charge", "manageshippingcharge.php", 3,'database9','sm1'),
        array ("Add Newsletter", "newsletter.php",4,'database10','sm1'),
        array ("Manage Newsletter", "manageNewsletters.php",4,'database11','sm1'),
        array ("Add Community", "addcommunity.php", 5,'database12','sm1'),
        array ("Manage Community", "managecommunity.php", 5,'database13','sm1'),
        array("Add Coupon","addcoupon.php",2,'database14','sm1'),
        array("Manage Coupon","managecoupon.php",2,'database15','sm1'),
        array("List Universal Coupon","listuniversalcoupon.php",2,'database16','sm1')*/
);
?>