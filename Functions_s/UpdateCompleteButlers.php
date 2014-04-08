<?php

/*
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
*/