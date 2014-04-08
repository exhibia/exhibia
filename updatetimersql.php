<?php

include("config/connect.php");
include_once 'common/sitesetting.php';
include("functions_s.php");

$sqlsel = "select * from auction a left join auc_due_table ad on ad.auction_id=a.auctionID where a.pause_status=0 and a.auc_status=2 and ad.auc_due_time!=0";
$aucresult = db_query($sqlsel);
while ($auc = db_fetch_array($aucresult)) {
    $sqlc = "select count(*) from auction_running where auctionID='{$auc['auctionID']}'";
    $resc = db_query($sqlc);
    if (db_result($resc, 0) > 0)
        continue;

    begin();

    if (!initRunningTable($auc['auctionID'])) {
        rollback();
        continue;
    }

    if ($auc['use_free'] == 1) {
        $bidaccountsql = "select user_id,bidpack_buy_date,bid_count,auction_id,bidding_price,bidding_type,username,position from free_account fa left join registration r on r.id=fa.user_id where auction_id='{$auc['auctionID']}' and fa.bid_flag='d' order by fa.id";
    } else {
        $bidaccountsql = "select user_id,bidpack_buy_date,bid_count,auction_id,bidding_price,bidding_type,username,position from bid_account ba left join registration r on r.id=ba.user_id where auction_id='{$auc['auctionID']}' and ba.bid_flag='d' order by ba.id";
    }


    $bidresult = db_query($bidaccountsql);
    $topuserid = '';
    $topusername = '';
    $topbidprice = $auc['auc_due_price'];
    while ($biditem = db_fetch_array($bidresult)) {
        if ($auc['use_free'] == 1) {
            $qryins1 = "Insert into free_account_bidding(user_id,bidpack_buy_date,bid_count,auction_id,bidding_price,bidding_type,username,position)
    values('{$biditem['user_id']}','{$biditem['bidpack_buy_date']}','{$biditem['bid_count']}','{$biditem['auction_id']}','{$biditem['bidding_price']}','{$biditem['bidding_type']}','{$biditem['username']}','{$biditem['position']}')";
        } else {
            $qryins1 = "Insert into bid_account_bidding(user_id,bidpack_buy_date,bid_count,auction_id,bidding_price,bidding_type,username,position)
    values('{$biditem['user_id']}','{$biditem['bidpack_buy_date']}','{$biditem['bid_count']}','{$biditem['auction_id']}','{$biditem['bidding_price']}','{$biditem['bidding_type']}','{$biditem['username']}','{$biditem['position']}')";
        }
        $topuserid = $biditem['user_id'];
        $topusername = $biditem['username'];
        $topbidprice=$biditem['bidding_price'];

        db_query($qryins1);
    }

    if ($auc['seatauction']) {
        updateAuctoinSeats($auc['auctionID'], $auc['auc_due_time'], $auc['minseats'],true);
    }


    if ($auc['uniqueauction']) {
        if (!updateAuctionLowest($auc['auctionID'], $auc['auc_due_time'], $auc['use_free'], $topuserid, $topusername, $topbidercount,true)) {
            rollback();
        }
    } else {
        updateAuctionBidding($auc['auctionID'], $auc['auc_due_time'], $topbidprice, $auc['use_free'], $topuserid, $topusername, $topbidercount,true);
    }

    commit();
}
?>
