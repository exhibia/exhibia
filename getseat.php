<?php

include("config/connect.php");
include("functions_s.php");
include("session.php");

if ($_SERVER["HTTP_X_REQUESTED_WITH"] != "XMLHttpRequest") {
   // exit;
}

if ($_GET["prid"] != "" && $_GET["uid"] && $_GET["aid"]) {

    $prid = chkInput($_GET["prid"], 'i');
    $uid = $_SESSION["userid"];
    $aid = chkInput($_GET["aid"], 'i');




    $sql = "select seatauction, minseats,auc_due_time,auc_due_price,auc_plus_time,max_plus_time, maxseats,seatbids,use_free,pause_status,auc_status, auctionID,(select count(id) from auction_seat st where st.auction_id=a.auctionID) as seatcount from auction_running a left join auc_due_table adt on adt.auction_id=a.auctionID left join auction_management am on a.time_duration=am.auc_manage where a.auctionID=$aid";

    $result = db_query($sql);
    $ob = db_fetch_object($result);
     if(db_num_rows(db_query("select beginner_auction from auction where auctionID = '" . $ob->auction_id . "' and beginner_auction = 1")) >= 1){
//echo "select * from won_auctions where userid = $_SESSION[userid]";
	    if(db_num_rows(db_query("select * from won_auctions where userid = $_SESSION[userid]"))>=1){
	    
		echo '[{"result":"unsuccess","message":"' . str_replace("'", "", str_replace("\"", "", ONLY_NEW_USERS_ARE_ALLOWED_TO_BID_ON_BEGINNER_AUCTIONS)) . '"}]';
                die();
                exit;
	    
	    }
	
    }
	
    if ($ob->seatauction == false) {
        echo '[{"result":"unsuccess","message":"' . MESSAGE_IS_NOT_SEAT_AUCTION . '"}]';
        exit;
    }
//
//    if ($ob->seatcount < $ob->minseats) {
//        echo '[{"result":"unsuccess|3"}]';
//        exit;
//    }

    if ($ob->maxseats != 0 && $ob->seatcount > $ob->maxseats) {
        echo '[{"result":"unsuccess","message":"' . MESSAGE_REACHED_MAXIMUM_SEAT . '"}]';
        exit;
    }

    //alread have the seat
    $sql1 = "select count(*) from auction_seat where auction_id='$aid' and user_id='$uid'";
    $result1 = db_query($sql1);
    if (db_result($result1, 0) > 0) {
        echo '[{"result":"unsuccess","message":"' . MESSAGE_ALREADY_HAVE_SEAT_AUCTION . '"}]';
        exit;
    }
    db_free_result($result1);

    $qrysel = "select final_bids,free_bids from registration where id=$uid";
    $ressel = db_query($qrysel);
    $obj = db_fetch_object($ressel);

    if ($ob->use_free == 1) {
        $bal = $obj->free_bids;
        $useonlyfree = 1;
    } else {
        $bal = $obj->final_bids;
        $useonlyfree = 0;
    }

	 //////////////////////////////////////////////////////////////////////////
	 // StartBugFix
	 //
	 // Clear Idea Technology, Inc. - Lee Jones
	 // 2012-04-23
	 //
	 // Task Id: 6925
	 //
	 // Aution seats can be purchased without enough available bids.
	 // 
	 // The balance was being compared  if == seatbids. The assumption is that
	 // the purchase should be rejected if the balance is LESS THAN seatbids.
	 //
	 //////////////////////////////////////////////////////////////////////////
	 
	 /*
    if ($bal == $ob->seatbids && $ob->use_free == 1) {
        echo '[{"result":"unsuccess","message":"' . MESSAGE_DONT_HAVE_FREE_POINTS . '"}]';
        exit;
    }
	 
    if ($bal == $ob->seatbids && $ob->use_free == 0) {
        echo '[{"result":"nobids","message":"' . MESSAGE_DONT_HAVE_FINAL_POINTS . '"}]';
        exit;
    }
	 */

	if ($bal < $ob->seatbids && $ob->use_free == 1) 
	{
		echo '[{"result":"unsuccess","message":"' . MESSAGE_DONT_HAVE_FREE_POINTS . '"}]';
		exit;
	}
	 
	if ($bal < $ob->seatbids && $ob->use_free == 0) 
	{
		echo '[{"result":"nobids","message":"' . MESSAGE_DONT_HAVE_FINAL_POINTS . '"}]';
		exit;
	}

	 //////////////////////////////////////////////////////////////////////////
	 // EndBugFix
	 //////////////////////////////////////////////////////////////////////////
	
    if ($ob->pause_status != '1' && $ob->auc_status == '2') {
        $oldtime = $ob->auc_due_time;
        /* Change for plus or minus random timer */
        //$plustime = rand($ob->auc_plus_time, $ob->max_plus_time);

        $oldprice = $ob->auc_due_price;
        $newprice = $oldprice;

        if ($oldtime < $ob->max_plus_time) {
            $newtime = $ob->max_plus_time + 2;
        } else {
            $newtime = $oldtime;
        }

        $usql = "Insert into auction_seat(user_id,auction_id) values('$uid','$aid')";

        /* End for plus or minus random timer */

        begin();

        $qrycount = "select auc_due_time,auc_status,pause_status from auc_due_table adt left join auction_running a on adt.auction_id=a.auctionID where a.auctionID=$aid";

        $rescount = db_query($qrycount);
        $resobj = db_fetch_array($rescount);
        if ($resobj['auc_due_time'] == 0 || $resobj['auc_status'] != 2 || $resobj['pause_status'] == 1) {
            rollback();
            echo '[{"result":"unsuccess","message":"' . MESSAGE_AUCTION_ENDED . '"}]';
            exit;
        }
        db_query($usql);

        if ($newtime != $oldtime) {
            $qupd = "update auc_due_table set auc_due_time=$newtime where auction_id=$aid";
            $result1 = db_query($qupd);

            if (!$result1) {
                rollback();
                echo "Failed1";
                exit;
            }
        }

        if ($ob->use_free == 1) {

            $final_bal = $bal - $ob->seatbids;

            $qryupd = "update registration set free_bids=" . $final_bal . " where id=$uid";
            $result2 = db_query($qryupd);
            //end bidmanagement
            if (!$result2) {
                rollback();
                echo "Failed2";
                exit;
            }

            $qryins = "Insert into free_account (user_id,bidpack_buy_date,bid_count,auction_id,product_id,bid_flag,bidding_price,bidding_type,bidding_time) values('$uid','" . date("Y-m-d H:i:s", time()) . "','{$ob->seatbids}','$aid','$prid','s',$newprice,''," . $oldtime . ")";
            $result3 = db_query($qryins);

            if (!$result3) {
                rollback();
                echo "Failed3";
                exit;
            }
        } else {

            $final_bal = $bal - $ob->seatbids;

            $qryupd = "update registration set final_bids=" . $final_bal . " where id=$uid";
            $result2 = db_query($qryupd);
            //end bidmanagement
            if (!$result2) {
                rollback();
                echo "Failed5";
                exit;
            }

            $qryins = "Insert into bid_account (user_id,bidpack_buy_date,bid_count,auction_id,product_id,bid_flag,bidding_price,bidding_type,bidding_time) values('$uid','" . date("Y-m-d H:i:s", time()) . "','{$ob->seatbids}','$aid','$prid','s',$newprice,''," . $oldtime . ")";

            echo $qryins;
            $result3 = db_query($qryins) or die(db_error());

            if (!$result3) {
                rollback();
                echo "Failed6";
                exit;
            }
        }

        updateAuctoinSeats($aid, $newtime, $ob->minseats, $newtime != $oldtime);

        commit();
        echo '[{"result":"success","message":"' . RELOAD_PAGE . '"}]';
        echo '[{"result":"success","freebids":"' . $useonlyfree . '","bids":"' . $ob->seatbids . '"}]';
    }

    db_free_result($result);

}
?>
