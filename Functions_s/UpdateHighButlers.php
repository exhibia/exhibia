<?php
function UpdateHighButlers($auc_id, $fprice) {
global $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
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
