<?php

function FutureAuctionManage() {
global $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
    $localtime = time();

    begin();
    $query = "insert into auc_due_table (auction_id, auc_due_time, auc_due_price) " .
            "select auctionID, total_time, auc_start_price from auction where future_tstamp<=$localtime and auc_status='1'";
    if (!db_query($query)) {
        rollback();
        echo "Failed";
    }

    if (!db_query("update auction set auc_status='2' where future_tstamp<=$localtime and auc_status='1'")) {
        rollback();
        echo "Failed";
    }
    commit();
}