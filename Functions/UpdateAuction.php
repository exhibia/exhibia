<?php

function UpdateAuction($auctionid) {
global $BASE_DIR;
$colors =new Colors_CLI();
 echo $colors->getColoredString("*****Updating auction date for $auctionid ****** ", "red") . "\n";
	  
    require("$BASE_DIR/config/config.inc.php");
    $qryselchk = "select use_free from auction where auctionID='" . $auctionid . "'";
    $resselchk = db_query($qryselchk);
    $objselchk = db_fetch_array($resselchk);

    if ($objselchk["use_free"] == "1") {
        $qrysel = "select * from free_account where auction_id='$auctionid' and bid_flag='d' order by id desc limit 0,1";
    } else {
        $qrysel = "select * from bid_account where auction_id='$auctionid' and bid_flag='d' order by id desc limit 0,1";
    }
    $ressel = db_query($qrysel);
    $objsel = db_fetch_object($ressel);
    $user = $objsel->user_id;
    $fprice = $objsel->bidding_price;

    if ($fprice == "") {
        $qr = "select * from auction where auctionID='$auctionid'";
        $r = db_query($qr);
        $ob = db_fetch_object($r);
        $fixprice = $ob->auc_start_price;

        $pricenew = $fixprice;

        $fprice = $pricenew;
    }

    begin();
    $qryupd = "update auction set auc_status='3', buy_user='$user', auc_final_price='$fprice',auc_final_end_date=NOW() where auctionID='$auctionid'";
    $result3 = db_query($qryupd);
    if (!$result3) {
        rollback();
        echo "Failed auction status";
    }
    
    if(db_num_rows(db_query("select * from won_auctions where auction_id = '$auctionid' and (userid = '$user' or userid='0')")) == 0){
    if(!empty($user)){
    echo "Insert into won_auctions (auction_id,userid,won_date) values('$auctionid','$user',NOW())";
    $qryins = "Insert into won_auctions (auction_id,userid,won_date) values('$auctionid','$user',NOW())";
    $result4 = db_query($qryins);
    if (!$result4) {
        rollback();
        echo "Failed won_auctions";
    }
    }else{
    echo "Insert into won_auctions (auction_id,userid,won_date) values('$auctionid','0',NOW())";
    $qryins = "Insert into won_auctions (auction_id,userid,won_date) values('$auctionid','0',NOW())";
    $result4 = db_query($qryins);
    if (!$result4) {
        rollback();
        echo "Failed won_auctions";
    }    
    
    
    
    }
    }
    

    
    
    echo mysql_error();
    commit();
    UpdateHighButlers($auctionid, $fprice);
    AddRecurrAuction($auctionid);
    if ($user != "") {
        SendWinnerMail($auctionid);
    }


    /*
      $resselchk = db_query("select use_free, auc_start_price from auction where auctionID=$auctionid");
      if ( db_result($resselchk, 0, 0) == "1" ) {
      $qrysel = "select user_id, bidding_price from free_account where auction_id=$auctionid and bid_flag='d' order by id desc limit 0,1";
      } else {
      $qrysel = "select user_id, bidding_price from bid_account  where auction_id=$auctionid and bid_flag='d' order by id desc limit 0,1";
      }

      $ressel = db_query($qrysel);
      $user   = db_result($ressel, 0, 0);
      $fprice = db_result($ressel, 0, 1);
      db_free_result($ressel);

      $fprice = ( $fprice == "" ) ? db_result($resselchk, 0, 1) : $fprice;
      db_free_result($resselchk);

      begin();
      if ( !db_query("update auction set auc_status='3', buy_user=$user, auc_final_price='$fprice', auc_final_end_date=NOW() where auctionID=$auctionid") ) {
      rollback();
      echo "Failed";
      }

      if ( !db_query("Insert into won_auctions (auction_id, userid, won_date) values ($auctionid, $user, NOW())") ) {
      rollback();
      echo "Failed";
      }
      commit();

      UpdateHighButlers($auctionid, $fprice);
      AddRecurrAuction($auctionid);

      if ( $user != "" ) SendWinnerMail($auctionid);
     */
}