<?php

/* common function */
if (file_exists('common/securityfilter.php')) {
    include_once 'common/securityfilter.php';
} else {
    include_once '../common/securityfilter.php';
}

function chkInput($data, $type='s', $length=0) {
    $data = RemoveXSS($data);
    $data = trim(htmlspecialchars_decode($data, ENT_QUOTES));
    $res = NULL;

    switch ($type) {
        case 's':
            $sql_syntax = array("insert", "select", "update", "delete", "grant", "privileges", "create", " or ", " and ");
            $delimiters = array("`", ";");

            $res = str_ireplace($sql_syntax, '', $data);
            $res = str_ireplace($delimiters, '', $res);

            if ($length > 0) {
                $res = substr($res, 0, $length);

                $slashed_res = addslashes($res);
                $nlen = strlen($slashed_res);
                $res = $nlen > $length ? addslashes(substr($res, 0, ($length * 2 - $nlen))) : $slashed_res;
            } else {
                $res = addslashes($res);
            }
            break;
        case 'i':
            $res = is_numeric($data) && is_int((int) $data) ? number_format($data, 0, '.', '') : 0;
            break;
    }

    return $res;
}

function SendWinnerMail($auctionid) {
    global $SITE_URL, $Currency, $adminemailadd, $SITE_NM;
    $qrysel = "select * from won_auctions w left join auction a on w.auction_id=a.auctionID left join registration r on w.userid=r.id " .
            " left join products p on a.productID=p.productID where w.auction_id='" . $auctionid . "'";
    $ressel = db_query($qrysel);
    $objsel = db_fetch_object($ressel);
    db_free_result($ressel);

    if ($objsel->fixedpriceauction == 1) {
        $winprice = $objsel->auc_fixed_price;
    } elseif ($objsel->offauction == 1) {
        $winprice = "0.00";
    } else {
        $winprice = $objsel->auc_final_price;
    }

    $content1 = "<table border='0' cellpadding='3' cellspacing='0' width='100%' align='center' class='style13'>";
    $content1 .= "<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>" .
            "<td>Dear " . strtoupper($objsel->firstname) . ", </td></tr><tr><td height='10'></td></tr>";
    $content1 .= "<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>" .
            "<td>Congratulations! You have won the following item through " . $SITE_NM . ".</td>" .
            "</tr><tr><td height='10'></td></tr>";
    $content1 .= "<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>" .
            "<td>AuctionID: " . $auctionid . "</td></tr>";
    $content1 .= "<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>" .
            "<td>Auction Item Name: " . $objsel->name . "</td></tr>";
    $content1 .= "<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>" .
            "<td>Winning Price: " . $Currency . number_format($winprice, 2) . "</td></tr>";
    $content1 .= "<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>" .
            "<td>Date You Won The Item: " . arrangedate(substr($objsel->won_date, 0, 10)) . "</td></tr><tr><td height='10'></td></tr>";
    $content1 .= "<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>" .
            "<td>You must Accept or Deny the Auction Winning within 7 days from auction won date.</td></tr>";
    $content1 .= "<tr style='font-size: 12px;font-family: Arial, Helvetica, sans-serif;color: #333333;'>" .
            "<td>To Accept or Deny this auction win please click here:<br>" .
            "<a href='" . $SITE_URL . "wonauctionaccept.php?winid=" . base64_encode($auctionid) . "'>" .
            $SITE_URL . "wonauctionaccept.php?winid=" . base64_encode($auctionid) . "</a></td></tr></table>";

    $subject = "Auction Closed and YOU WON!";
    $from = $adminemailadd;
    $email = $objsel->email;
    SendHTMLMail2($email, $subject, $content1, $from);
}

function arrangedate($date) {
    $year = substr($date, 0, 4);
    $month = substr($date, 5, 2);
    $day = substr($date, 8, 2);

    return ($month . "-" . $day . "-" . $year);
}

function SendHTMLMail2($to, $subject, $mailcontent, $from) {
    $array = split("@", $from, 2);
    $SERVER_NAME = $array[1];
    $username = $array[0];
    $headers = "From: $username@$SERVER_NAME\nReply-To:$username@$SERVER_NAME\nX-Mailer: PHP\n";

    $limite = "_parties_" . md5(uniqid(rand()));

    $headers .= "Date: " . date("l j F Y, G:i") . "\n";
    $headers .= "MIME-Version: 1.0\n";
    $headers .= "Content-Type: text/html;\n";
    $headers .= " boundary=\"----=$limite\"\n\n";

    mail($to, $subject, $mailcontent, $headers);
}

function Makeentryinlog($sessionstarttime, $sessionendtime, $time, $globalcounter) {
    $logcontent = "Counter:" . $globalcounter .
            "\nServer Time:" . date("d/m/Y H:i:s", $time) .
            "\nStart Time:" . date("d/m/Y H:i:s", $sessionstarttime) .
            "\nEnd Time:" . date("d/m/Y H:i:s", $sessionendtime) .
            "\n----------------------------------------------";

    $fp = fopen("auctionpause.log", "a");
    fwrite($fp, $logcontent);
    fclose($fp);
}

function CheckTimeGreater($starthour, $startmin, $startsec, $endhour, $endmin, $endsec) {
    if ($starthour > $endhour)
        return 1;
    if ($starthour < $endhour)
        return 2;
    if ($startmin > $endmin)
        return 1;
    if ($startmin < $endmin)
        return 2;
    if ($startsec > $endsec)
        return 1;
    if ($startsec < $endsec)
        return 2;
}

function begin() {
    //db_query("BEGIN");
}

function commit() {
    //db_query("COMMIT");
}

function rollback() {
    //db_query("ROLLBACK");
}

/* end common function */

function getLeftTime($auctionid) {
    $sql = "select auc_due_time from auc_due_table where auction_id='$auctionid'";
    $result = db_query($sql);
    return db_result($result, 0);
}

/* update record function */

function UpdateAuction($auctionid) {
    $qryselchk = "select use_free,uniqueauction,halfbackauction,cashauction,reserve from auction where auctionID='" . $auctionid . "'";
    $resselchk = db_query($qryselchk);
    $objselchk = db_fetch_array($resselchk);
$cashauction = $objselchk['cashauction'];
$reserve = $objselchk['reserve'];
    $fprice = '';
    $user = '';
    if ($objselchk['uniqueauction'] == false) {
        if ($objselchk["use_free"] == "1") {
            $qrysel = "select * from free_account where auction_id='$auctionid' and bid_flag='d' order by id desc limit 0,1";
        } else {
            $qrysel = "select * from bid_account where auction_id='$auctionid' and bid_flag='d' order by id desc limit 0,1";
        }
        $ressel = db_query($qrysel);
        $objsel = db_fetch_object($ressel);
        $user = $objsel->user_id;
        $fprice = $objsel->bidding_price;
    } else {
        $qryselu = "select userid, bidprice, count(bidprice) as bidcount from unique_bid  where auctionid=$auctionid group by bidprice  order by count(bidprice), bidprice limit 0,1;";
        $resselu = db_query($qryselu);
        $objselu = db_fetch_object($resselu);
        if ($objselu->bidcount == 1) {
            $user = $objselu->userid;
            $fprice = $objselu->bidprice;
        }
    }

    if ($fprice == "") {
        $qr = "select * from auction where auctionID='$auctionid'";
        $r = db_query($qr);
        $ob = db_fetch_object($r);
        $fixprice = $ob->auc_start_price;

        $pricenew = $fixprice;

        $fprice = $pricenew;
    }

    if (getLeftTime($auctionid) > 0) {
        return;
    }

    begin();

    $qryupd = "update auction set auc_status='3', buy_user='$user', auc_final_price='$fprice',auc_final_end_date=NOW() where auctionID='$auctionid'";
    $result3 = db_query($qryupd);
    if (!$result3) {
        rollback();
        return;
    }

    $qryins = "Insert into won_auctions (auction_id,userid,won_date) values('$auctionid','$user',NOW())";
    $result4 = db_query($qryins);
    if (!$result4) {
        rollback();
        return;
    }

    if ($objselchk['halfbackauction'] == true) {
        $accounttable = "";
        $discount = Sitesetting::getDiscountOfHalfback();
        if ($objselchk["use_free"] == "1") {
            $accounttable = 'free_account';
        } else {
            $accounttable = 'bid_account';
        }
        $halfsql = "select count(id) as bidaccount,user_id from $accounttable where auction_id='$auctionid' and user_id!='$user' and bid_flag='d' group by user_id";
        $halfret = db_query($halfsql);

        while ($halfobj = db_fetch_array($halfret)) {
            //$usql="select final_bids,free_bids from registration where id='$userid'";
            $halfbidcount = round($halfobj['bidaccount'] * $discount / 100);
if(empty($cashauction)){
            if ($objselchk["use_free"] == "1") {
                $upsql = "update registration set free_bids=free_bids+{$halfbidcount} where id='{$halfobj['user_id']}'";
                db_query($upsql);
            } else {
                $upsql = "update registration set final_bids=final_bids+{$halfbidcount} where id='{$halfobj['user_id']}'";
                db_query($upsql);
            }
}
        }
        db_free_result($halfret);
    }

//    if($objselchk['uniqueauction'] == true){
//        $qrydel="delete from unique_bid where auctionid=$auctionid";
//        db_query($qrydel);
//    }
    if (setEndAuction($auctionid) == false) {
        rollback();
        return;
    }

    commit();
    UpdateHighButlers($auctionid, $fprice);
    AddRecurrAuction($auctionid);
    if ($user != "") {
        SendWinnerMail($auctionid);
    }
}

function AddRecurrAuction($aucid) {
    $ressel = db_query("select * from auction where auctionID=" . $aucid);
    $objsel = db_fetch_object($ressel);
    db_free_result($ressel);

    if ($objsel->recurr_count > 0) {
        $localtime = time();
        $startdate = date("Y-m-d", $localtime);
        $enddate = date("Y-m-d", $localtime + $objsel->total_time);
        $starttime = date("H:i:s", $localtime);
        $endtime = date("H:i:s", $localtime + $objsel->total_time);
        $futuretstamp = strtotime(date("Y-m-d H:i:s", $localtime + $objsel->total_time));

        begin();
        $qryins = "Insert into auction (categoryID, productID, auc_start_price, auc_start_date, auc_end_date, auc_start_time, auc_end_time," .
                " auc_status, auc_fixed_price, fixedpriceauction, pennyauction, nailbiterauction, offauction, nightauction, openauction,cashauction,reserve" .
                " time_duration, total_time, pause_status, shipping_id, future_tstamp, recurr_count) " .
                "values (" . $objsel->categoryID . ", " . $objsel->productID . ", '" . $objsel->auc_start_price . "', '" . $startdate . "', '" . $enddate . "', " .
                " '" . $starttime . "', '" . $endtime . "', '2', '" . $objsel->auc_fixed_price . "', " . $objsel->fixedpriceauction . ", " .
                " " . $objsel->pennyauction . ", " . $objsel->nailbiterauction . ", " . $objsel->offauction . ", " . $objsel->nightauction . ", " .
                " " . $objsel->openauction . ", '" . $objsel->time_duration . "', " . $objsel->total_time . ", " . $objsel->pause_status . ", " .
                " " . $objsel->shipping_id . ", '" . $futuretstamp . "', " . ($objsel->recurr_count - 1) . ", '" .$objselchk->cashauction . "', '" . $objselchk->reserve . "' )";
        if (!db_query($qryins)) {
            rollback();
            return;
        }
        $newauctionid = db_insert_id();

        $qryins1 = "Insert into auc_due_table (auction_id, auc_due_time, auc_due_price) " .
                "values (" . $newauctionid . ", " . $objsel->total_time . ", '" . $objsel->auc_start_price . "')";
        if (!db_query($qryins1)) {
            rollback();
            return;
        }
        if (initRunningTable($newauctionid) == false) {
            rollback();
            return;
        }
        commit();
    }
}

function setEndAuction($aid) {
    $date = date('Y-m-d H:i:s', time() + 60 * 60 * 6);
    $sql = "update auction_running set auc_status=3, deldate='$date' where auctionID='$aid'";
    db_query($sql);
    return true;
}

function clearEndedTable() {

    $date = date('Y-m-d H:i:s');
    $sqlsel = "select auctionID from auction_running where auc_status=3 and deldate<='$date'";
    $result = db_query($sqlsel);
    while ($obj = db_fetch_array($result)) {
        begin();
        $aid = $obj['auctionID'];

        $delsql = "delete from auction_run_status where auctionid='$aid'";
        if (!db_query($delsql)) {
            rollback();
            continue;
        }

        $delsql = "delete from bid_account_bidding where auction_id='$aid'";
        if (!db_query($delsql)) {
            rollback();
            continue;
        }

        $delsql = "delete from free_account_bidding where auction_id='$aid'";
        if (!db_query($delsql)) {
            rollback();
            continue;
        }
        $delsql = "delete from auction_running where auctionID='$aid'";
        if (!db_query($delsql)) {
            rollback();
            continue;
        }

        commit();
    }


    return true;
}

function initRunningTable($aid) {
    $sqlsel = "select * from auction where auctionID='$aid'";
    $result = db_query($sqlsel);
    if (db_num_rows($result) > 0) {
        $auction = db_fetch_array($result);
        $sqlins = "insert into auction_running(auctionID,productID,auc_start_price,auc_status,pause_status,time_duration,use_free,fixedpriceauction,
            pennyauction,nailbiterauction,offauction,nightauction,openauction,reverseauction,uniqueauction,halfbackauction,seatauction,minseats,maxseats,
            seatbids,lockauction,locktype,locktime,lockprice,relist,cashauction,reserve) values('{$auction['auctionID']}','{$auction['productID']}','{$auction['auc_start_price']}','{$auction['auc_status']}','{$auction['pause_status']}','{$auction['time_duration']}','{$auction['use_free']}','{$auction['fixedpriceauction']}',
            '{$auction['pennyauction']}','{$auction['nailbiterauction']}','{$auction['offauction']}','{$auction['nightauction']}','{$auction['openauction']}','{$auction['reverseauction']}','{$auction['uniqueauction']}','{$auction['halfbackauction']}','{$auction['seatauction']}','{$auction['minseats']}','{$auction['maxseats']}',
            '{$auction['seatbids']}','{$auction['lockauction']}','{$auction['locktype']}','{$auction['locktime']}','{$auction['lockprice']}','{$auction['relist']}','{$action['cashauction']}', '{$aucton['reserve']}')";
        if (!db_query($sqlins)) {
            return false;
        }

        $sqlins2 = "insert into auction_run_status(auctionid,lefttime,newprice,heighuseravatar,heighuser,uniqueauction,lowbidcount,seatauction,seatauctionnow,seatcount,minseats)
            values('{$auction['auctionID']}','{$auction['total_time']}','{$auction['auc_start_price']}','','[]','{$auction['uniqueauction']}','0','{$auction['seatauction']}','{$auction['seatauction']}','0','{$auction['minseats']}')";
        if (!db_query($sqlins2)) {
            return false;
        }
    }
    return true;
}

function FutureAuctionManage() {
    $localtime = time();

    $sqlsel = "select auctionID, total_time, auc_start_price from auction where future_tstamp<=$localtime and auc_status='1'";
    $result = db_query($sqlsel);
    while ($auc = db_fetch_array($result)) {
        begin();
        $sqlins = "insert into auc_due_table (auction_id, auc_due_time, auc_due_price) values('{$auc['auctionID']}','{$auc['total_time']}','{$auc['auc_start_price']}')";
        if (!db_query($sqlins)) {
            rollback();
            echo "test4Failed";
            return;
        }

        $upsql = "update auction set auc_status='2' where auctionID='{$auc['auctionID']}'";
        if (!db_query($upsql)) {
            rollback();
            echo "test5Failed";
            return;
        }

        if (initRunningTable($auc['auctionID']) == false) {
            rollback();
            return;
        }

        commit();
    }
}

function PauseDayAuction() {
    begin();
    db_query("update auction_running set pause_status=1 where auc_status='2' and nightauction=0") or die(db_error());
    $sql = "select auctionID from auction_running where auc_status='2' and nightauction=0 and pause_status=1";
    $result = db_query($sql);
    while ($obj = db_fetch_array($result)) {
        $aid = $obj['auctionID'];
        $upsql1 = "update auction set pause_status=1 where auctionID='$aid'";
        if (!db_query($upsql1)) {
            rollback();
            return;
        }

        $upsql2 = "update auction_run_status set pause_status=1 where auctionID='$aid'";
        if (!db_query($upsql2)) {
            rollback();
            return;
        }
    }
    commit();
}

function RunDayAuction() {
    begin();
    db_query("update auction_running set pause_status=0 where auc_status='2' and pause_status=1") or die(db_error());
    $sql = "select auctionID from auction_running where auc_status='2' and pause_status=0";
    $result = db_query($sql);
    while ($obj = db_fetch_array($result)) {
        $aid = $obj['auctionID'];
        $upsql1 = "update auction set pause_status=0 where auctionID='$aid'";
        if (!db_query($upsql1)) {
            rollback();
            return;
        }

        $upsql2 = "update auction_run_status set pause_status=0 where auctionID='$aid'";
        if (!db_query($upsql2)) {
            rollback();
            return;
        }
    }
    commit();
}

function UpdateHighButlers($auc_id, $fprice) {
    $qrybutler = "select * from bidbutler where auc_id='$auc_id' and (butler_start_price>'$fprice' or butler_bid>used_bids) and butler_status='0'";
    $resbutler = db_query($qrybutler);
    $totalbutler = db_num_rows($resbutler);

    $qryauc = "select * from auction where auctionID='$auc_id'";
    $resauc = db_query($qryauc);
    $objauc = db_fetch_object($resauc);
$cashauction = $objauc->cashauction;
$reserve = $objauc->reserve;
    while (( $obj = db_fetch_object($resbutler))) {
        $usedbids = $obj->used_bids;
        $placebids = $obj->butler_bid;
        $userid = $obj->user_id;
        $id = $obj->id;

        begin();
        if (!db_query("update bidbutler set butler_status='1' where id='$id'")) {
            rollback();
            echo "test6Failed";
            return;
        }

        $savebids1 = $placebids - $usedbids;
if(empty($cashauction)){
        if ($objauc->use_free == 1) {
            $qryins = "Insert into free_account (user_id,bidpack_buy_date,bid_count,auction_id,product_id,bid_flag) values('$userid',NOW(),'$savebids1','" . $auc_id . "','" . $objauc->productID . "','b')";
        } else {
            $qryins = "Insert into bid_account (user_id,bidpack_buy_date,bid_count,auction_id,product_id,bid_flag) values('$userid',NOW(),'$savebids1','" . $auc_id . "','" . $objauc->productID . "','b')";
        }

        if (!db_query($qryins)) {
            rollback();
            echo "test7Failed";
            return;
        }
}
        $rs = db_query("select * from registration where id='$userid'");
        $objre = db_fetch_object($rs);
if(empty($cashauction)){
        if ($objauc->use_free == 1) {
            $user_fid = $objre->id;
            $finalbids = $objre->free_bids + $savebids1;

            $updreg = "update registration set free_bids='$finalbids' where id='$userid'";
        } else {
            $user_fid = $objre->id;
            $finalbids = $objre->final_bids + $savebids1;

            $updreg = "update registration set final_bids='$finalbids' where id='$userid'";
        }

        if (!db_query($updreg)) {
            rollback();
            echo "test8Failed";
            return;
        }
}
        commit();
    }
}

/* end update record function */


/* update butler function */

function placeAdminBidder($aucid, $newtime, $aucusefree) {
    global $adminautobidtype, $topbidercount;
    $rettime = $newtime;

    if ($newtime >= 0) {

        $sqlc = "select count(*) from bidbutler b inner join registration r on r.id=b.user_id where auc_id=$aucid and butler_bid>used_bids and butler_status=0 and admin_user_flag='1'";
        $retc = db_query($sqlc);
        if (db_result($retc, 0) <= 0) {
            UpdateCompleteButlers($aucid, $aucusefree);
            return $rettime;
        }


        $aucSql = "select pennyauction, auc_plus_price, auc_plus_time, max_plus_time, productID, auc_start_price,uniqueauction,reverseauction,lockauction,locktype,lockprice,locktime " .
                "from auction_running a left join auction_management am on a.time_duration=am.auc_manage " .
                "where a.auctionID=$aucid and a.pause_status=0 and auc_status=2";
        $aucResult = db_query($aucSql);

        if (db_num_rows($aucResult) > 0) {
            //when have auction to bid
            $auc = db_fetch_object($aucResult);
            $plusprice = ( $auc->pennyauction == 1 ) ? 0.50 : ($auc->auc_plus_price == 0 ? 0.50 : $auc->auc_plus_price);

            $pid = $auc->productID;

            if ($newtime < $auc->max_plus_time) {
                $ntime = $auc->max_plus_time + 2;
            } else {
                $ntime = $newtime;
            }

            if ($aucusefree == 1) {
                $topbidQry = "select user_id, bidding_price " .
                        "from free_account_bidding " .
                        "where auction_id=$aucid order by id desc limit 0,1";
            } else {
                $topbidQry = "select user_id, bidding_price " .
                        "from bid_account_bidding " .
                        "where auction_id=$aucid order by id desc limit 0,1";
            }
            $topbidQryResult = db_query($topbidQry);

            if (db_num_rows($topbidQryResult) > 0) {
                //when have user bid,get the current price and top user
                $topbid = db_fetch_object($topbidQryResult);
                $price = ( $topbid->bidding_price == "" ) ? ( ( $auc->auc_start_price != "" ) ? $auc->auc_start_price : "0.00" ) : $topbid->bidding_price;
                $topUserid = $topbid->user_id;
            } else {
                //when no user bid
                $topUserid = 0;
                $price = ($auc->auc_start_price != "") ? $auc->auc_start_price : "0.00";
            }
            db_free_result($topbidQryResult);

            if ($auc->reverseauction == true) {
                $newprice = $price - $plusprice;
            } else {
                $newprice = $price + $plusprice;
            }

            if ($auc->reverseauction == false) {
                $andbulterwhere = "butler_start_price<='$newprice' and butler_end_price>='$newprice'";
            } else {
                $andbulterwhere = "butler_start_price>='$newprice' and butler_end_price<='$newprice'";
            }



            $butlerQry = "select b.id as id, user_id,username,position, used_bids, butler_bid, butler_end_price,admin_user_flag " .
                    "from bidbutler b inner join registration r on r.id=b.user_id where auc_id=$aucid and $andbulterwhere and butler_bid>used_bids and butler_status=0 and user_id>'$topUserid' and admin_user_flag='1' order by user_id asc limit 0,1";
            $buylerResult = db_query($butlerQry);
            if (db_num_rows($buylerResult) <= 0) {
                $butlerQry = "select b.id as id, user_id,username,position, used_bids, butler_bid, butler_end_price,admin_user_flag " .
                        "from bidbutler b inner join registration r on r.id=b.user_id where auc_id=$aucid and $andbulterwhere and butler_bid>used_bids and butler_status=0 and user_id<'$topUserid' and admin_user_flag='1' order by user_id asc limit 0,1";
                $buylerResult = db_query($butlerQry);
            }
            //when have user to autobid
            if (db_num_rows($buylerResult) > 0) {
                $buyler = db_fetch_object($buylerResult);

                $username = $buyler->user_id;

                $placedbids = $buyler->butler_bid;
                $usedbids = $buyler->used_bids;
                $id = $buyler->id;

                if ($auc->lockauction == true) {
                    if (($auc->locktype == 1 && $auc->locktime >= $newtime) || ($auc->locktype == 2 && (($auc->reverseauction == false && $auc->lockprice <= $price) || ($auc->reverseauction == true && $auc->lockprice >= $price)))) {
                        if ($aucusefree == 1) {
                            $qrybids = "select count(*) from free_account_bidding where auction_id='" . $aucid . "' and user_id='$username' order by id desc limit 0,1";
                        } else {
                            $qrybids = "select count(*) from bid_account_bidding where auction_id='" . $aucid . "' and user_id='$username' order by id desc limit 0,1";
                        }

                        $bidsresult = db_query($qrybids);
                        if (db_result($bidsresult, 0) < 1) {
                            return $newtime;
                        }
                    }
                }

//                $bidtype = 'b';
//                if ($buyler->admin_user_flag == '1') {
//                    $bidtype = $adminautobidtype;
//                }
                $bidtype = $adminautobidtype;
                begin();

                $uptsql = "update auc_due_table set auc_due_price='$newprice' ";
                if ($ntime != $newtime) {
                    $uptsql.=",auc_due_time='$ntime' ";
                }
                $uptsql.=" where auction_id=$aucid";

                if (!db_query($uptsql)) {
                    rollback();
                    echo "test9Failed";
                    return $rettime;
                }

                if ($aucusefree == 1) {
                    $qryins = "Insert into free_account (user_id,bidpack_buy_date,bid_count,auction_id,product_id,bid_flag,bidding_price,bidding_type,bidding_time)  values('$username',NOW(),'1','$aucid','$pid','d','$newprice','$bidtype','$ntime')";
                    $qryins1 = "Insert into free_account_bidding(user_id,bidpack_buy_date,bid_count,auction_id,bidding_price,bidding_type,username,position) values('$username',NOW(),'1','$aucid',$newprice,'$bidtype','{$buyler->username}','{$buyler->position}')";
                } else {
                    $qryins = "Insert into bid_account  (user_id,bidpack_buy_date,bid_count,auction_id,product_id,bid_flag,bidding_price,bidding_type,bidding_time)  values('$username',NOW(),'1','$aucid','$pid','d','$newprice','$bidtype','$ntime')";
                    $qryins1 = "Insert into bid_account_bidding(user_id,bidpack_buy_date,bid_count,auction_id,bidding_price,bidding_type,username,position) values('$username',NOW(),'1','$aucid',$newprice,'$bidtype','{$buyler->username}','{$buyler->position}')";
                }
                if (!db_query($qryins)) {
                    rollback();
                    echo "test10Failed";
                    return $rettime;
                }

                if (!db_query($qryins1)) {
                    rollback();
                    echo "test11Failed";
                    return $rettime;
                }



                if (!db_query("update bidbutler set used_bids=used_bids+1 where id=$id")) {
                    rollback();
                    echo "test12Failed";
                    return $rettime;
                }

                if (!$auc->uniqueauction) {
                    updateAuctionBidding($aucid, $ntime, $newprice, $aucusefree, $username, $buyler->username, $topbidercount, $ntime != $newtime);
                }

                commit();

                $rettime = $ntime;
            }
            db_free_result($buylerResult);
        }

        db_free_result($aucResult);
    }
    //UpdateCompleteButlers($aucid, $aucusefree);
    return $rettime;
}

function AddBidButler($aucid, $newtime, $aucusefree) {
    global $adminautobidtype, $topbidercount;
    $rettime = $newtime;
    if ($newtime >= 0) {
        $sqlc = "select count(*) from bidbutler b inner join registration r on r.id=b.user_id where auc_id=$aucid and butler_bid>used_bids and butler_status=0 and admin_user_flag='0'";
        $retc = db_query($sqlc);
        if (db_result($retc, 0) <= 0) {
            UpdateCompleteButlers($aucid, $aucusefree);
            return -1;
        }

        $aucSql = "select pennyauction, auc_plus_price, auc_plus_time, max_plus_time, productID, auc_start_price,uniqueauction,reverseauction,lockauction,locktype,lockprice,locktime " .
                "from auction_running a inner join auction_management am on a.time_duration=am.auc_manage " .
                "where a.auctionID=$aucid and a.pause_status=0 and auc_status=2";
        $aucResult = db_query($aucSql);

        if (db_num_rows($aucResult) > 0) {
            //when have auction to bid
            $auc = db_fetch_object($aucResult);
            $plusprice = ( $auc->pennyauction == 1 ) ? 0.50 : ($auc->auc_plus_price == 0 ? 0.50 : $auc->auc_plus_price);

            $pid = $auc->productID;

            if ($newtime < $auc->max_plus_time) {
                $ntime = $auc->max_plus_time + 2;
            } else {
                $ntime = $newtime;
            }

            if ($aucusefree == 1) {
                $topbidQry = "select user_id, bidding_price " .
                        "from free_account_bidding " .
                        "where auction_id=$aucid order by id desc limit 0,1";
            } else {
                $topbidQry = "select user_id, bidding_price " .
                        "from bid_account_bidding " .
                        "where auction_id=$aucid order by id desc limit 0,1";
            }
            $topbidQryResult = db_query($topbidQry);

            if (db_num_rows($topbidQryResult) > 0) {
                //when have user bid,get the current price and top user
                $topbid = db_fetch_object($topbidQryResult);
                $price = ( $topbid->bidding_price == "" ) ? ( ( $auc->auc_start_price != "" ) ? $auc->auc_start_price : "0.00" ) : $topbid->bidding_price;
                $topUserid = $topbid->user_id;
            } else {
                //when no user bid
                $topUserid = 0;
                $price = ($auc->auc_start_price != "") ? $auc->auc_start_price : "0.00";
            }
            db_free_result($topbidQryResult);

            if ($auc->reverseauction == true) {
                $newprice = $price - $plusprice;
            } else {
                $newprice = $price + $plusprice;
            }

            if ($auc->reverseauction == false) {
                $andbulterwhere = "butler_start_price<='$newprice' and butler_end_price>='$newprice'";
            } else {
                $andbulterwhere = "butler_start_price>='$newprice' and butler_end_price<='$newprice'";
            }

            $butlerQry = "select b.id as id, user_id,username,position, used_bids, butler_bid, butler_end_price,admin_user_flag " .
                    "from bidbutler b inner join registration r on r.id=b.user_id where auc_id=$aucid and $andbulterwhere and butler_bid>used_bids and butler_status=0 and user_id>'$topUserid' and admin_user_flag='0' order by user_id asc limit 0,1";
            $buylerResult = db_query($butlerQry);
            if (db_num_rows($buylerResult) <= 0) {
                $butlerQry = "select b.id as id, user_id,username,position, used_bids, butler_bid, butler_end_price,admin_user_flag " .
                        "from bidbutler b inner join registration r on r.id=b.user_id where auc_id=$aucid and $andbulterwhere and butler_bid>used_bids and butler_status=0 and user_id<'$topUserid' and admin_user_flag='0' order by user_id asc limit 0,1";
                $buylerResult = db_query($butlerQry);
            }

            //when have user to autobid
            if (db_num_rows($buylerResult) > 0) {
                $buyler = db_fetch_object($buylerResult);

                $username = $buyler->user_id;

                $placedbids = $buyler->butler_bid;
                $usedbids = $buyler->used_bids;
                $id = $buyler->id;

                if ($auc->lockauction == true) {
                    if (($auc->locktype == 1 && $auc->locktime >= $newtime) || ($auc->locktype == 2 && (($auc->reverseauction == false && $auc->lockprice <= $price) || ($auc->reverseauction == true && $auc->lockprice >= $price)))) {
                        if ($aucusefree == 1) {
                            $qrybids = "select count(*) from free_account_bidding where auction_id='" . $aucid . "' and user_id='$username' order by id desc limit 0,1";
                        } else {
                            $qrybids = "select count(*) from bid_account_bidding where auction_id='" . $aucid . "' and user_id='$username' order by id desc limit 0,1";
                        }

                        $bidsresult = db_query($qrybids);
                        if (db_result($bidsresult, 0) < 1) {
                            return $rettime;
                        }
                    }
                }

                $bidtype = 'b';
//                if ($buyler->admin_user_flag == '1') {
//                    $bidtype = $adminautobidtype;
//                }

                begin();
                $uptsql = "update auc_due_table set auc_due_price='$newprice' ";
                if ($ntime != $newtime) {
                    $uptsql.=",auc_due_time='$ntime' ";
                }
                $uptsql.=" where auction_id=$aucid";

                if (!db_query($uptsql)) {
                    rollback();
                    echo "test13Failed";
                    return -1;
                }

                if ($aucusefree == 1) {
                    $qryins = "Insert into free_account (user_id,bidpack_buy_date,bid_count,auction_id,product_id,bid_flag,bidding_price,bidding_type,bidding_time)  values('$username',NOW(),'1','$aucid','$pid','d','$newprice','$bidtype','$ntime')";
                    $qryins1 = "Insert into free_account_bidding(user_id,bidpack_buy_date,bid_count,auction_id,bidding_price,bidding_type,username,position) values('$username',NOW(),'1','$aucid',$newprice,'$bidtype','{$buyler->username}','{$buyler->position}')";
                } else {
                    $qryins = "Insert into bid_account  (user_id,bidpack_buy_date,bid_count,auction_id,product_id,bid_flag,bidding_price,bidding_type,bidding_time)  values('$username',NOW(),'1','$aucid','$pid','d','$newprice','$bidtype','$ntime')";
                    $qryins1 = "Insert into bid_account_bidding(user_id,bidpack_buy_date,bid_count,auction_id,bidding_price,bidding_type,username,position) values('$username',NOW(),'1','$aucid',$newprice,'$bidtype','{$buyler->username}','{$buyler->position}')";
                }
                if (!db_query($qryins)) {
                    rollback();
                    echo "test14Failed";
                    return -1;
                }

                if (!db_query($qryins1)) {
                    rollback();
                    echo "test15Failed";
                    return -1;
                }


                if (!db_query("update bidbutler set used_bids=used_bids+1 where id=$id")) {
                    rollback();
                    echo "test16Failed";
                    return -1;
                }

                if (!$auc->uniqueauction) {
                    updateAuctionBidding($aucid, $ntime, $newprice, $aucusefree, $username, $buyler->username, $topbidercount, $ntime != $newtime);
                }

                commit();
            } else {
                return -1;
            }
            db_free_result($buylerResult);

            $rettime = $ntime;
        } else {
            return -1;
        }

        db_free_result($aucResult);
    } else {
        return -1;
    }

    //UpdateCompleteButlers($aucid, $aucusefree);
    return $rettime;
}

function UpdateCompleteButlers($auc_id, $aucusefree) {
    if ($aucusefree == 1) {
        $qrysel = "select productID, user_id, bidding_price from free_account ba left join auction a on a.auctionId=ba.auction_id where ba.auction_id=$auc_id and bid_flag='d' order by id desc limit 0,1";
    } else {
        $qrysel = "select productID, user_id, bidding_price from bid_account  ba left join auction a on a.auctionId=ba.auction_id where ba.auction_id=$auc_id and bid_flag='d' order by id desc limit 0,1";
    }
    $ressel = db_query($qrysel);
    if (db_num_rows($ressel) >= 1) {
        $productID = db_result($ressel, 0, 0);
        $user = db_result($ressel, 0, 1);
        $fprice = db_result($ressel, 0, 2);
        db_free_result($ressel);

        $resbutler = db_query("select used_bids, butler_bid, user_id, id from bidbutler b join auction a on a.auctionID=b.auc_id where auc_id=$auc_id and ( (reverseauction=0 and butler_end_price<'$fprice' or reverseauction=1 and butler_end_price>'$fprice' ) or butler_bid=used_bids) and butler_status=0");
        while (( $obj = db_fetch_object($resbutler))) {
            $usedbids = $obj->used_bids;
            $placebids = $obj->butler_bid;
            $userid = $obj->user_id;
            $id = $obj->id;

            begin();

            if (!db_query("update bidbutler set butler_status=1 where id=" . $id)) {
                rollback();
                echo "testFailed";
                return;
            }

            if ($placebids > $usedbids) {
                $savebids = $placebids - $usedbids;

                if ($aucusefree == 1) {
                    $qryins = "Insert into free_account (user_id,bidpack_buy_date,bid_count,auction_id,product_id,bid_flag) values($userid,NOW(),$savebids,$auc_id,$productID,'b')";
                } else {
                    $qryins = "Insert into bid_account  (user_id,bidpack_buy_date,bid_count,auction_id,product_id,bid_flag) values($userid,NOW(),$savebids,$auc_id,$productID,'b')";
                }
                if (!db_query($qryins)) {
                    rollback();
                    echo "test2Failed";
                    return;
                }
if(empty($cashauction)){
                $rs = db_query("select free_bids, final_bids from registration where id=" . $userid);
                if ($aucusefree == 1) {
                    $finalbids = db_result($rs, 0, 0) + $savebids;
                    $updreg = "update registration set free_bids='$finalbids' where id=$userid";
                } else {
                    $finalbids = db_result($rs, 0, 1) + $savebids;
                    $updreg = "update registration set final_bids='$finalbids' where id=$userid";
                }

                db_free_result($rs);

                if (!db_query($updreg)) {
                    rollback();
                    echo "test3Failed";
                    return;
                }
}
            }
            commit();
        }
        db_free_result($resbutler);
    }
}

function updateAuctionBidding($auctionid, $leftiem, $newprice, $usefree, $topuserid, $topusername, $topbidercount, $isupdatetime) {

    $arrTopuser = array();
    $topavatar = getAvatar($topuserid);
    if ($topbidercount <= 1) {
        if ($topusername != '') {
            array_push($arrTopuser, $topusername);
            $heightuser = json_encode($arrTopuser);
        } else {
            $heightuser = '[]';
        }
    } else {
        if ($usefree == 1) {
            $sqlsel = "select username from free_account_bidding where auction_id='$auctionid' order by id desc limit 0,$topbidercount";
        } else {
            $sqlsel = "select username from bid_account_bidding where auction_id='$auctionid' order by id desc limit 0,$topbidercount";
        }

        $result = db_query($sqlsel);
        if (db_num_rows($result) > 0) {
            while ($obj = db_fetch_array($result)) {
                array_push($arrTopuser, $obj['username']);
            }
            $heightuser = json_encode($arrTopuser);
        } else {
            $heightuser = '[]';
        }
    }
    $upsql = "update auction_run_status set newprice='$newprice',heighuser='$heightuser',heighuseravatar='$topavatar'";
    if ($isupdatetime) {
        $upsql.=",lefttime='$leftiem'";
    }
    $upsql .= " where auctionid='$auctionid'";
    db_query($upsql);
}

function updateAuctionLowest($auctionid, $leftiem, $usefree, $topuserid, $topusername, $topbidercount, $isupdatetime) {
    try {
        $arrTopuser = array();
        $topavatar = getAvatar($topuserid);
        $sqlcount = "select count(*) from unique_bid where auctionid=$auctionid";
        $rescount = db_query($sqlcount);
        $uniquecount = db_result($rescount, 0);

        if ($topbidercount <= 1) {
            if ($topusername == '') {
                $heightuser = '[]';
            } else {
                array_push($arrTopuser, $topusername);
                $heightuser = json_encode($arrTopuser);
            }
        } else {
            if ($usefree == 1) {
                $sqlsel = "select username from free_account_bidding where auction_id='$auctionid' order by id desc limit 0,$topbidercount";
            } else {
                $sqlsel = "select username from bid_account_bidding where auction_id='$auctionid' order by id desc limit 0,$topbidercount";
            }

            $result = db_query($sqlsel) or die(db_error());
            if (db_num_rows($result) > 0) {
                while ($obj = db_fetch_array($result)) {
                    array_push($arrTopuser, $obj['username']);
                }
                $heightuser = json_encode($arrTopuser);
            } else {
                $heightuser = '[]';
            }
        }
        $upsql = "update auction_run_status set heighuser='$heightuser',lowbidcount='$uniquecount',heighuseravatar='$topavatar'";
        if ($isupdatetime) {
            $upsql.=",lefttime='$leftiem'";
        }
        $upsql .= " where auctionid='$auctionid'";
        db_query($upsql);
    } catch (Exception $e) {
        return false;
    }
}

function updateAuctoinSeats($auctionid, $newtime, $minseats, $isupdatetime) {
    $sql = "select count(id) from auction_seat where auction_id=$auctionid";
    $seatauctionnow = 1;
    $result = db_query($sql);
    $seatcount = db_result($result, 0);
    if ($seatcount >= $minseats) {
        $seatauctionnow = 0;
    }

    $upsql = "update auction_run_status set seatcount='$seatcount',seatauctionnow='$seatauctionnow'";
    if ($isupdatetime) {
        $upsql.=",lefttime='$newtime'";
    }
    $upsql.=" where auctionid='$auctionid'";

    db_query($upsql);
}

function getAvatar($userid) {
    global $UploadImagePath;
    $sqlsel = "select a.avatar from avatar a left join registration r on r.avatarid=a.id where r.id='$userid'";

    $result = db_query($sqlsel);
    $avatar = $UploadImagePath . 'avatars/default.png';

    if (db_num_rows($result) > 0) {
        $obj = db_fetch_array($result);
        if ($obj['avatar'] != '') {
            $tempAvatar = $UploadImagePath . 'avatars/' . $obj['avatar'];
            if (file_exists($tempAvatar)) {
                $avatar = $tempAvatar;
            }
        }
        db_free_result($result);
    }

    return $avatar;
}

/* end update butler function */

/**
 * is allowed the win account is overflow
 * @param <type> $userid
 */
function allowWinInWeek($userid) {
    include_once 'common/sitesetting.php';

    $limitweek = Sitesetting::getWinLimitPerWeek();
    if ($limitweek == 0) {
        return true;
    }
    $sql = "select count(*) from won_auctions where userid='$userid' and week(won_date)=week(now());";
    $result = db_query($sql);
    $count = db_result($result, 0);
    if ($count >= $limitweek) {
        return false;
    } else {
        return true;
    }
}

function allowWinInMonth($userid) {
    include_once 'common/sitesetting.php';
    $limitmonth = Sitesetting::getWinLimitPerMonth();
    if ($limitmonth == 0) {
        return true;
    }
    $sql = "select count(*) from won_auctions where userid='$userid' and month(won_date)=month(now());";
    $result = db_query($sql);
    $count = db_result($result, 0);
    if ($count >= $limitmonth) {
        return false;
    } else {
        return true;
    }
}

function secondToTimer($second) {
    $s = $second % 60;
    $m = floor($second / 60) % 60;
    $h = floor(floor($second / 60) / 60) % 60;
    return $h . ':' . $m . ':' . $s;
}

function microtime_float() {
    list($usec, $sec) = explode(" ", microtime());
    return ((float) $usec + (float) $sec);
}

function GetUserIDFromCode($vercode) {
    $ressel = db_query("select id, account_status from registration where verifycode='$vercode'");
    $objsel = db_fetch_object($ressel);
    db_free_result($ressel);

    if ($objsel->account_status == 0)
        return $objsel->id;
}

?>
