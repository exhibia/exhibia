<?php

include("config/connect.php");
include("session.php");
include("functions_s.php");
//to force a single bid butler per user change the variable below to no
$allow_multi_butler = 'yes';
 
 
$aid = $_GET["aid"];
$user = $_SESSION["userid"];
$bidsp = $_GET["bidsp"];
$bidep = $_GET["bidep"];
$totb = $_GET["totb"];
$uid = $_SESSION['userid'];

if ($user != "" && $aid != "") {

    if (allowWinInWeek($user) == false) {
        echo '[{"result":"unsuccess","message":"' . MESSAGE_REACHED_TO_WEEK_LIMIT . '"}]';
        exit;
    }

    if (allowWinInMonth($user) == false) {
        echo '[{"result":"unsuccess","message":"' . MESSAGE_REACHED_TO_MONTH_LIMIT . '"}]';
        exit;
    }

    $qryselauc = "select use_free from auction where auctionID='" . $aid . "'";
    $resselauc = db_query($qryselauc);
    $objselauc = db_fetch_array($resselauc);

    if ($objselauc["use_free"] == 1) {
        $qrybid = "select * from free_account where auction_id='$aid' and bid_flag='d' order by id desc limit 0,1";
    } else {
        $qrybid = "select * from bid_account where auction_id='$aid' and bid_flag='d' order by id desc limit 0,1";
    }

    $resbid = db_query($qrybid);
    $objbid = db_fetch_object($resbid);
    $runprice = $objbid->bidding_price;

    $q = "select * from auc_due_table adt left join auction a on adt.auction_id=a.auctionID left join auction_management am on a.time_duration=am.auc_manage where auction_id=$aid";
    $r = db_query($q);
    $ob = db_fetch_object($r);

    if ($ob->lockauction == true) {
        if (($ob->locktype == 1 && $ob->locktime >= $ob->auc_due_time) || ($ob->locktype == 2 && (($ob->reverseauction == false && $ob->lockprice <= $ob->auc_due_price) || ($ob->reverseauction == true && $ob->lockprice >= $ob->auc_due_price)))) {
            if ($ob->use_free == 1) {
                $qrybids = "select count(*) from free_account where auction_id='" . $aid . "' and user_id='$user' and bid_flag='d' order by id desc limit 0,1";
            } else {
                $qrybids = "select count(*) from bid_account where auction_id='" . $aid . "' and user_id='$user' and bid_flag='d' order by id desc limit 0,1";
            }

            $bidsresult = db_query($qrybids);
            if (db_result($bidsresult, 0) < 1) {
                echo '[{"result":"unsuccess","message":"' . MESSAGE_LOCK_AUCTION . '"}]';
                exit;
            }
        }
    }

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

    if ($runprice == "") {
        $qryprc = "select * from auc_due_table where auction_id='$aid'";
        $resprc = db_query($qryprc);
        $objprc = db_fetch_object($resprc);
        $runprice = $objprc->auc_due_price;
    }

//	if(floatval($runprice)>=floatval($bidsp))
//	{
//		echo '[{"result":"unsuccessprice"}]';
//		exit;
//	}

    $qrys = "select * from registration where id='$user'";
    $res = db_query($qrys);
    $ob = db_fetch_object($res);
    if ($objselauc["use_free"] == 1) {
        $fb = $ob->free_bids;
        if ($fb <= 0 || $fb < $totb) {
            echo '[{"result":"unsuccess","message":"' . MESSAGE_DONT_HAVE_FREE_POINTS . '"}]';
            exit;
        }
    }
	 else
	 {
		//////////////////////////////////////////////////////////////////////////////////
		/// Begin Bugfix
		/// Clear Idea Technology
		/// Trent Raber
		/// 2012-05-02
		///
		/// Correcting any areas where the final bids are compared to 0 ( == ).  Replacing them
		/// with <= 0
		//////////////////////////////////////////////////////////////////////////////////

        $fb = $ob->final_bids;
        if ($fb <= 0 || $fb < $totb) {
            echo '[{"result":"unsuccess","message":"' . MESSAGE_DONT_HAVE_FINAL_POINTS . '"}]';
            exit;
        }

		//////////////////////////////////////////////////////////////////////////////////
		/// End Bugfix
		//////////////////////////////////////////////////////////////////////////////////

    }

    if(db_num_rows(db_query("select * from bidbutler where user_id = $uid and auc_id = $aid")) >= 1 & $allow_multi_butler == 'no'){
    
	$qryins = "update bidbutler set butler_start_price = '$bidsp', butler_end_price = '$bidep', butler_bid = '$totbid' where user_id = $uid and auc_id = $aid";
    
    }else{
	$qryins = "insert into bidbutler (auc_id,user_id,butler_start_price,butler_end_price,butler_bid,butler_status,place_date) values('$aid','$user','$bidsp','$bidep','$totb','0',NOW())";
   
    }
    db_query($qryins) or die(db_error());
    $id = db_insert_id();

    $qryselreg = "select * from registration where id='$user'";
    $resselreg = db_query($qryselreg);
    $objreg = db_fetch_object($resselreg);

    if ($objselauc["use_free"] == 1) {
        $fbids = $objreg->free_bids;
        $finalbids = $fbids;
        //$qryupd = "update registration set free_bids='$finalbids' where id='$user'";
    } else {
        $fbids = $objreg->final_bids;
        $finalbids = $fbids;
        //$qryupd = "update registration set final_bids='$finalbids' where id='$user'";
    }
   // db_query($qryupd) or die(db_error());

    $qrysel = "select * from bidbutler where user_id='$user' and auc_id='$aid' and butler_status='0' order by id desc limit 0,20";
    $ressel = db_query($qrysel);
    $total = db_num_rows($ressel);

    for ($i = 1; $i <= $total; $i++) {
        $obj = db_fetch_object($ressel);
        if ($i == 1) {
            $bidbutler = '{"bidbutler":{"startprice":"' . number_format($obj->butler_start_price, 2) . '","endprice":"' . number_format($obj->butler_end_price, 2) . '","bids":"' . $obj->butler_bid . '","id":"' . $obj->id . '"}}';
        } else {
            $bidbutler .= ',{"bidbutler":{"startprice":"' . number_format($obj->butler_start_price, 2) . '","endprice":"' . number_format($obj->butler_end_price, 2) . '","bids":"' . $obj->butler_bid . '","id":"' . $obj->id . '"}}';
        }
    }
    echo '{"butlerslength":[' . $bidbutler . ']}';
}
?>