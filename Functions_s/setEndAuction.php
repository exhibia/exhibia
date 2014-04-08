<?php

function setEndAuction($aid) {
global $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
    $date = date('Y-m-d H:i:s', time() + 60 * 60 * 6);
    $sql = "update auction_running set auc_status=3, deldate='$date' where auctionID='$aid'";
    db_query($sql);
    return true;
}