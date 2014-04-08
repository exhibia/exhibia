<?php
if(!function_exists('SendHTMLMail3')){
  function SendHTMLMail3($to, $subject, $mailcontent, $from) {
    global $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
    $array = explode("@", $from, 2);
    $SERVER_NAME = $array[1];
    $username = $array[0];
    $headers = "From: $array[0]@$array[1]\r\nReply-To:$username@$SERVER_NAME\r\n";
    $headers .= "To: $to \r\n";
    $headers .= "Return-Path: $array[0]@$array[1]\r\n";
    $headers .= "X-Mailer: Drupal\r\n";
    $headers .= "Date: " . date("l j F Y, G:i") . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $objsel = db_fetch_array(db_query("select * from registration where email = '$to'"));
    
    $subject = str_replace("[[SITE_NM]]", $SITE_NM, $subject);
    $subject = str_replace("[[SITE_URL]]", $SITE_URL, $subject);
    $subject = str_replace("[[auctionid]]", base64_encode($objsel['auctionID']), $subject);
    $subject = str_replace("[[auctioned]]", base64_encode($objsel['auctionID']), $subject);
    $subject = str_replace("[[won_date]]", arrangedate(substr($objsel['won_date'], 0, 10)), $subject);
    $subject = str_replace("[[currency]]", $Currency, $subject);
    $subject = str_replace("[[winprice]]", number_format($winprice, 2), $subject);
    $subject = str_replace("[[firstname]]", $objsel['firstname'], $subject);
    $subject = str_replace("[[name]]", $objsel['name'], $subject);
    
    $mailcontent = str_replace("[[SITE_NM]]", $SITE_NM, $mailcontent);
    $mailcontent = str_replace("[[SITE_URL]]", $SITE_URL, $mailcontent);
    $mailcontent = str_replace("[[auctionid]]", base64_encode($objsel['auctionID']), $mailcontent);
    $mailcontent = str_replace("[[auctioned]]", base64_encode($objsel['auctionID']), $mailcontent);
    $mailcontent = str_replace("[[won_date]]", arrangedate(substr($objsel['won_date'], 0, 10)), $mailcontent);
    $mailcontent = str_replace("[[currency]]", $Currency, $mailcontent);
    $mailcontent = str_replace("[[winprice]]", number_format($winprice, 2), $mailcontent);
    $mailcontent = str_replace("[[firstname]]", $objsel['firstname'], $mailcontent);
    $mailcontent = str_replace("[[name]]", $objsel['name'], $mailcontent);
   
    mail($to, $subject, "<html><body>" . $mailcontent . "</body></html>", $headers, '-f' . $array[0] . '@' . $array[1]);
  }
}
if(!function_exists('SendSeatMail')){
function SendSeatMail($auctionid, $user_info) {
    global $SITE_URL, $Currency, $adminemailadd, $SITE_NM, $DATABASENAME, $USERNAME, $PASSWORD, $DBSERVER, $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
		@db_query("CREATE TABLE IF NOT EXISTS `seat_emails` (
				      `id` bigint(20) unsigned NOT NULL auto_increment,
				      `auction_id` varchar(200) not null,
				      `username` varchar(200) not null,
				     
				      PRIMARY KEY  (`id`)
				      
				    ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;");
    if(db_num_rows(db_query("select * from seat_emails where auction_id = '$auctionid' and username = '$user_info[username]'")) == 0){
	    $objsel = db_fetch_array(db_query("select * from auction left join products p on auction.productID = p.productID where  auctionID=$auctionid"));    
	    $email_template = db_fetch_array(db_query("select * from emailtemplate where name = 'seat_auction_started' limit 1"));
		$content2 = str_replace("[[SITE_NM]]", $SITE_NM, $email_template['subject']);
		$content2 = str_replace("[[SITE_URL]]", $SITE_URL, $content2);
		$content2 = str_replace("[[auctionid]]", base64_encode($objsel['auctionID']), $content2);
		$content2 = str_replace("[[auctioned]]", base64_encode($objsel['auctionID']), $content2);
		$content2 = str_replace("[[currency]]", $Currency, $content2);
		$content2 = str_replace("[[winprice]]", number_format($winprice, 2), $content2);
		$content2 = str_replace("[[firstname]]", $user_info['firstname'], $content2);
		$content2 = str_replace("[[name]]", $objsel['name'], $content2);

		$content1 = str_replace("[[SITE_NM]]", $SITE_NM, $email_template['content']);
		$content1 = str_replace("[[SITE_URL]]", $SITE_URL, $content1);
		$content1 = str_replace("[[auctionid]]", base64_encode($objsel['auctionID']), $content1);
		$content1 = str_replace("[[auctioned]]", base64_encode($objsel['auctionID']), $content1);
		$content1 = str_replace("[[currency]]", $Currency, $content1);
		$content1 = str_replace("[[firstname]]", $objsel['firstname'], $content1);
		$content1 = str_replace("[[name]]", $objsel['name'], $content1);
		
		db_query("insert into seat_emails values(null, '$auctionid', '" . addslashes($user_info['username']) . "')");
		$from = $adminemailadd;
		$subject = $content2; 
		$email = $objsel['email'];
		SendHTMLMail3($user_info['email'], $subject, $content1, $from);
	  }
    }
}

if(!function_exists('SendFundedMail')){
function SendFundedMail($auctionid, $user_info) {
    global $SITE_URL, $Currency, $adminemailadd, $SITE_NM, $DATABASENAME, $USERNAME, $PASSWORD, $DBSERVER, $BASE_DIR, $adminemailadd;
    require("$BASE_DIR/config/connect.php");
    $from = $adminemailadd;
	
    if(db_num_rows(db_query("select * from seat_emails where auction_id = '$auctionid' and user_id = '$user_info[id]'")) == 0){
	    $objsel = db_fetch_array(db_query("select * from auction left join products p on auction.productID = p.productID where  auction.auctionID=$auctionid"));    
	    $email_template = db_fetch_array(db_query("select * from emailtemplate where name = 'funded_auction_started' limit 1"));
		$content2 = str_replace("[[SITE_NM]]", $SITE_NM, $email_template['subject']);
		$content2 = str_replace("[[SITE_URL]]", $SITE_URL, $content2);
		$content2 = str_replace("[[auctionid]]", base64_encode($objsel['auctionID']), $content2);
		$content2 = str_replace("[[auctioned]]", base64_encode($objsel['auctionID']), $content2);
		$content2 = str_replace("[[currency]]", $Currency, $content2);
		$content2 = str_replace("[[winprice]]", number_format($winprice, 2), $content2);
		$content2 = str_replace("[[firstname]]", $user_info['firstname'], $content2);
		$content2 = str_replace("[[username]]", $user_info['username'], $content2);
		$content2 = str_replace("[[lastname]]", $user_info['lastname'], $content2);
		$content2 = str_replace("[[name]]", $objsel['name'], $content2);
		$content2 = str_replace("[[email]]", $user_info['email'], $content2);
		$content2 = str_replace("[[description]]", $objsel['description'], $content2);
		
		
		$content1 = str_replace("[[SITE_NM]]", $SITE_NM, $email_template['content']);
		$content1 = str_replace("[[SITE_URL]]", $SITE_URL, $content1);
		$content1 = str_replace("[[auctionid]]", base64_encode($objsel['auctionID']), $content1);
		$content1 = str_replace("[[auctioned]]", base64_encode($objsel['auctionID']), $content1);
		$content1 = str_replace("[[currency]]", $Currency, $content1);
		$content1 = str_replace("[[firstname]]", $objsel['firstname'], $content1);
		$content1 = str_replace("[[lastname]]", $user_info['lastname'], $content1);
		$content1 = str_replace("[[username]]", $user_info['lastname'], $content1);
		$content1 = str_replace("[[email]]", $user_info['email'], $content1);
		$content1 = str_replace("[[name]]", $objsel['name'], $content1);
		$content1 = str_replace("[[description]]", $objsel['description'], $content1);
	
		db_query("insert into seat_emails values(null, '$auctionid', '" . addslashes($user_info['username']) . "')");
		$from = $adminemailadd;
		$subject = $content2; 
		
		SendHTMLMail3($user_info['email'], $subject, $content1, $from);
	 }
    }
}