<?php



function clearEndedTable() {
global $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
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