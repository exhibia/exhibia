<?php

include("config/connect.php");
include("data/uniquebid.php");

include("functions_s.php");
include("session.php");

if ($_SERVER["HTTP_X_REQUESTED_WITH"] != "XMLHttpRequest") {
   // exit;
}
 
if ($_GET["prid"] != "" & !empty($_SESSION["userid"]) & !empty($_GET["aid"]) & !empty($_GET['bidprice'])) {
    $prid = $_GET["prid"];
    $uid = $_SESSION["userid"];
    $aid = $_GET["aid"];
   
$bids_to_take = db_fetch_object(db_query("select bids_to_take from auction where auctionID = $aid limit 1"));
$bids_to_take = $bids_to_take->bids_to_take;


    if (allowWinInWeek($uid) == false) {
        echo '[{"result":"unsuccess","message":"' . MESSAGE_REACHED_TO_WEEK_LIMIT . '"}]';
        exit;
    }

    if (allowWinInMonth($uid) == false) {
        echo '[{"result":"unsuccess","message":"' . MESSAGE_REACHED_TO_MONTH_LIMIT . '"}]';
        exit;
    }

    $price = $_GET['bidprice'];

    $q = "select * from auc_due_table adt left join auction_running a on adt.auction_id=a.auctionID left join auction_management am on a.time_duration=am.auc_manage where auction_id=$aid";
    $r = db_query($q);
    $ob = db_fetch_object($r);
     if(db_num_rows(db_query("select beginner_auction from auction where auctionID = '" . $ob->auction_id . "' and beginner_auction = 1")) >= 1){
//echo "select * from won_auctions where userid = $_SESSION[userid]";
	    if(db_num_rows(db_query("select * from won_auctions where userid = $_SESSION[userid]"))>=1){
	    
		echo '[{"result":"unsuccess","message":"' . str_replace("'", "", str_replace("\"", "", ONLY_NEW_USERS_ARE_ALLOWED_TO_BID_ON_BEGINNER_AUCTIONS)) . '"}]';
                die();
                exit;
	    
	    }
	
      }
	
    $useonlyfree = $ob->use_free;

    if ($ob->seatauction == true) {
        $seatqry = "select count(*) from auction_seat where auction_id=$aid";
        $seatret = db_query($seatqry);
        $seatcount = db_result($seatret, 0);
        db_free_result($seatret);
        if ($seatcount < $ob->minseats) {
            echo '[{"result":"unsuccess","message":"' . MESSAGE_NOT_REACHED_TO_MIN_SEATS . '"}]';
            exit;
        }

        $seatqry1 = "select count(*) from auction_seat where auction_id='$aid' and user_id='$uid'";
        $seatret1 = db_query($seatqry1);
        if (db_result($seatret1, 0) <= 0) {
            echo '[{"result":"unsuccess","message":"' . MESSAGE_DONT_HAVE_SEAT . '"}]';
            exit;
        }
    }

    $uniquedb = new UniqueBid(null);
    if ($uniquedb->isExistByUserPrice($uid, $aid, $price) == true) {
        echo '[{"result":"unsuccess","message":"' . MESSAGE_HAVE_AUCTION_WITH_SAME_RPICE . '"}]';
        //echo '[{"result":"existbid|' . $useonlyfree . '"}]';
        exit;
    }

    //for bid management for minus

    $qrysel = "select final_bids,free_bids,username,position from registration where id=$uid";
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
	// 2012-04-25
	//
	// Task Id: 6925
	//
	// Aution seats can be purchased without enough available bids.
	// 
	// The balance was being compared  if == 0.
	// It is now being compared to <= to prevent use with negative bids. 
	//
	//////////////////////////////////////////////////////////////////////////

	if( $bal <= 0 && $ob->use_free == 1) 
	{
		echo '[{"result":"unsuccess","message":"' . MESSAGE_DONT_HAVE_FREE_POINTS . '"}]';
		exit;
	}
	if( $bal <= 0 && $ob->use_free == 0 )
	{
		echo '[{"result":"nobids","message":"' . MESSAGE_DONT_HAVE_FINAL_POINTS . '"}]';
		exit;
	}

	//////////////////////////////////////////////////////////////////////////
	// EndBugFix
	//////////////////////////////////////////////////////////////////////////

    if ($ob->pause_status != '1' && $ob->auc_status == '2') {
        $oldtime = $ob->auc_due_time;
        $oldprice = $ob->auc_due_price;
        /* Change for plus or minus random timer */
        //$plustime = rand($ob->auc_plus_time, $ob->max_plus_time);

        $newprice = $oldprice;

        if ($oldtime < $ob->max_plus_time) {
            $newtime = $ob->max_plus_time + 2;
        } else {
            $newtime = $oldtime;
        }

        $nowdate = date('Y-m-d H:i:s');
        $usql = "Insert into unique_bid(auctionid,userid,bidprice,adddate) values('$aid','$uid','$price',NOW())";

        /* End for plus or minus random timer */
        begin();

        db_query($usql);

        $qupd = "update auc_due_table set auc_due_price=$newprice";
        if ($newtime != $oldtime) {
            $qupd.=",auc_due_time=$newtime ";
        }
        $qupd.=" where auction_id=$aid";
        $result1 = db_query($qupd);

        if (!$result1) {
            rollback();
            echo "Failed";
            exit;
        }
        if ($ob->use_free == 1) {

            $final_bal = $bal - 1;

            $qryupd = "update registration set free_bids=" . $final_bal . " where id=$uid";
            $result2 = db_query($qryupd);
            //end bidmanagement
            if (!$result2) {
                rollback();
                echo "Failed";
                exit;
            }

            $qryins1 = "Insert into free_account_bidding(user_id,bidpack_buy_date,bid_count,auction_id,bidding_price,bidding_type,username,position) values('$uid','" . date("Y-m-d H:i:s", time()) . "','$bids_to_take','$aid',$newprice,'s','{$obj->username}','{$obj->position}')";
            $result = db_query($qryins1);
            if (!$result) {
                rollback();
                echo "Failed";
                exit;
            }

            $qryins = "Insert into free_account (user_id,bidpack_buy_date,bid_count,auction_id,product_id,bid_flag,bidding_price,bidding_type,bidding_time) values('$uid','" . date("Y-m-d H:i:s", time()) . "','$bids_to_take','$aid','$prid','d',$newprice,'s'," . $oldtime . ")";
            $result3 = db_query($qryins);

            if (!$result3) {
                rollback();
                echo "Failed";
                exit;
            }
        } else {

            $final_bal = $bal - $bids_to_take;

            $qryupd = "update registration set final_bids=" . $final_bal . " where id=$uid";
            $result2 = db_query($qryupd);
            //end bidmanagement
            if (!$result2) {
                rollback();
                echo "Failed";
                exit;
            }

            $qryins1 = "Insert into bid_account_bidding(user_id,bidpack_buy_date,bid_count,auction_id,bidding_price,bidding_type,username,position) values('$uid','" . date("Y-m-d H:i:s", time()) . "','$bids_to_take','$aid',$newprice,'s','{$obj->username}','{$obj->position}')";
            $result = db_query($qryins1);
            if (!$result) {
                rollback();
                echo "Failed";
                exit;
            }

            $qryins = "Insert into bid_account (user_id,bidpack_buy_date,bid_count,auction_id,product_id,bid_flag,bidding_price,bidding_type,bidding_time) values('$uid','" . date("Y-m-d H:i:s", time()) . "','$bids_to_take','$aid','$prid','d',$newprice,'s'," . $oldtime . ")";
            $result3 = db_query($qryins);

            if (!$result3) {
                rollback();
                echo "Failed";
                exit;
            }
        }
        updateAuctionLowest($aid, $newtime, $ob->use_free, $uid, $obj->username, $topbidercount, $oldtime != $newtime);
        commit();
        echo '[{"result":"success","freebids":"' . $useonlyfree . '","bids":"1"}]';
    }
}

?>