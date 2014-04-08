<?php

function getLeftTime($auctionid) {
global $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
    $sql = "select auc_due_time from auc_due_table where auction_id='$auctionid'";
    $result = db_query($sql);
    return db_result($result, 0);
}