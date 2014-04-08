<?php


function UpdateCompleteButlers($auc_id, $aucusefree) {
global $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
    if ($aucusefree == 1) {
        $qrysel = "select productID, user_id, bidding_price from free_account ba left join auction a on a.auctionId=ba.auction_id where ba.auction_id=$auc_id and bid_flag='d' order by id desc limit 0,1";
    } else {
        $qrysel = "select productID, user_id, bidding_price from bid_account  ba left join auction a on a.auctionId=ba.auction_id where ba.auction_id=$auc_id and bid_flag='d' order by id desc limit 0,1";
    }
    $ressel = db_query($qrysel);
    if (db_num_rows($ressel) > 0) {
        $productID = db_result($ressel, 0, 0);
        $user = db_result($ressel, 0, 1);
        $fprice = db_result($ressel, 0, 2);
    }
    db_free_result($ressel);


    $resbutler = db_query("select used_bids, butler_bid, user_id, id from bidbutler where auc_id=$auc_id and (butler_end_price<'$fprice' or butler_bid=used_bids) and butler_status=0");
    while (( $obj = db_fetch_object($resbutler))) {
        $usedbids = $obj->used_bids;
        $placebids = $obj->butler_bid;
        $userid = $obj->user_id;
        $id = $obj->id;

        begin();

        if (!db_query("update bidbutler set butler_status=1 where id=" . $id)) {
            rollback();
            echo "Failed";
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
                echo "Failed";
            }

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
                echo "Failed";
            }
        }
        commit();
    }
    db_free_result($resbutler);
}



function UpdateHighButlers($auc_id, $fprice) {
global $db;
    $qrybutler = "select * from bidbutler where auc_id='$auc_id' and (butler_start_price>'$fprice' or butler_bid>used_bids) and butler_status='0'";
    $resbutler = db_query($qrybutler);
    $totalbutler = db_num_rows($resbutler);

    $qryauc = "select * from auction where auctionID='$auc_id'";
    $resauc = db_query($qryauc);
    $objauc = db_fetch_object($resauc);

    while (( $obj = db_fetch_object($resbutler))) {
        $usedbids = $obj->used_bids;
        $placebids = $obj->butler_bid;
        $userid = $obj->user_id;
        $id = $obj->id;

        begin();
        if (!db_query("update bidbutler set butler_status='1' where id='$id'")) {
            rollback();
            echo "Failed";
        }

        $savebids1 = $placebids - $usedbids;

        if ($objauc->use_free == 1) {
            $qryins = "Insert into free_account (user_id,bidpack_buy_date,bid_count,auction_id,product_id,bid_flag) values('$userid',NOW(),'$savebids1','" . $auc_id . "','" . $objauc->productID . "','b')";
        } else {
            $qryins = "Insert into bid_account (user_id,bidpack_buy_date,bid_count,auction_id,product_id,bid_flag) values('$userid',NOW(),'$savebids1','" . $auc_id . "','" . $objauc->productID . "','b')";
        }
        if (!db_query($qryins)) {
            rollback();
            echo "Failed";
        }

        $rs = db_query("select * from registration where id='$userid'");
        $objre = db_fetch_object($rs);

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
            echo "Failed";
        }
        commit();
    }
}
