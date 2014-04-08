<?php

function getTotalPlaceBids($aid) {
global $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
    $qrysel = "select *,sum(bid_count) as totalbid from bid_account where auction_id='$aid' and ((bid_flag='d' and bidding_type='s') or (bid_flag='s')) and user_id='" . $_SESSION["userid"] . "' group by auction_id";
    $ressel = db_query($qrysel);
    $obj = db_fetch_object($ressel);

    $qrysel1 = "select *,sum(butler_bid) as butlerbid from bidbutler where auc_id='$aid' and user_id='" . $_SESSION["userid"] . "' group by auc_id";
    $ressel1 = db_query($qrysel1);
    $obj1 = db_fetch_object($ressel1);

    $qrysel2 = "select *,sum(bid_count) as savebid from bid_account where auction_id='$aid' and bid_flag='b' and user_id='" . $_SESSION["userid"] . "' group by auction_id";
    $ressel2 = db_query($qrysel2);
    $obj2 = db_fetch_object($ressel2);

    $qrysel3 = "select *,sum(bid_count) as wonpaybid from bid_account where auction_id='" . $aid . "' and bid_flag='d' and user_id='" . $_SESSION["userid"] . "' and bidding_type='w' group by auction_id";
    $ressel3 = db_query($qrysel3);
    $obj3 = db_fetch_object($ressel3);

    $totalbid = $obj->totalbid;
    $butlerbid = $obj1->butlerbid;
    $savebid = $obj2->savebid;
    $wonpaybid = $obj3->wonpaybid;

    return (($butlerbid + $totalbid + $wonpaybid) - $savebid);
}