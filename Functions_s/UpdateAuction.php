<?php

function UpdateAuction($auctionid) {
global $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
    $qryselchk = "select use_free,uniqueauction,halfbackauction,cashauction,reserve from auction where auctionID='" . $auctionid . "'";
    echo  $qryselchk;
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
echo "update auction set auc_status='3', buy_user='$user', auc_final_price='$fprice',auc_final_end_date=NOW() where auctionID='$auctionid'";
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
