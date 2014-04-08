<?php
function GetUserFreeBids($useid) {
global $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
    $ressel1 = db_query("select free_bids from registration where id=$useid");

    if (db_num_rows($ressel1) > 0) {

        $freebids = db_result($ressel1, 0, 0);
        db_free_result($ressel1);

        return $freebids;
    } else {
        return 0;
    }
}