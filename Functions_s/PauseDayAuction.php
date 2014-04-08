<?php



function PauseDayAuction() {
global $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
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
