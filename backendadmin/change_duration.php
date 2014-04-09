<?php
include("../config/config.inc.php");

if(empty($_REQUEST['aid']) | empty($_REQUEST['time'])){
  echo "error encountered please check your settings";
  exit;
}else{
  $obj = db_fetch_object(db_query("select * from auction left join products p on p.productID = auction.productID where auctionID = '$_REQUEST[aid]'"));
  db_query("update auction set time_duration = '$_REQUEST[time]' where auctionID = '$_REQUEST[aid]'");
  db_query("update auction_running set time_duration = '$_REQUEST[time]' where auctionID = '$_REQUEST[aid]'");
  
  echo "success";
  $qry = db_query("select * from comet_users");
    while($row = db_fetch_array($qry)){
    $tstamp = time();
 
      db_query("insert into cometchat_announcements (`id`, `announcement`, `time`, `to`) values(null, 'Auction Duration has been changed to " . str_replace('sa', ' Seconds', $_REQUEST['time']) . " for <a href=\"viewproduct.php?aid=" . $obj->auctionID . "\">" . $obj->name . "</a>', '$tstamp', '$row[userid]');");
      db_query("insert into cometchat_chatroommessages(`id`, `userid`, `chatroomid`, `message`, `sent`) values(null, '1', '1', '<span style=\"color:red;font-weight:bold;\">Auction Duration has been changed to " . str_replace('sa', ' Seconds', $_REQUEST['time']) . " for <a href=\"viewproduct.php?aid=" . $obj->auctionID . "\">#" . $obj->auctionID . ' ' . $obj->name . "</a></p>', NOW());");
      echo db_error();
      db_query("insert into cometchat(`id`, `from`, `to`, `message`) values(null, '1', '$row[userid]', '<span style=\"color:red;font-weight:bold;\">Auction Duration has been changed to " . str_replace('sa', ' Seconds', $_REQUEST['time']) . " for <a href=\"viewproduct.php?aid=" . $obj->auctionID . "\">#" . $obj->auctionID . ' ' . $obj->name . "</a></p>');");
      echo db_error();
    }
    
}
