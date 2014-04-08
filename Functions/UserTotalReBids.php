<?php


function UserTotalReBids($uid) {
global $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
    $resrembid = db_query("select final_bids from registration where id=$uid");

    if (db_num_rows($resrembid) > 0) {
        $penbids = db_result($resrembid, 0, 0);
        db_free_result($resrembid);

        return $penbids;
    } else {
        return 0;
    }
}