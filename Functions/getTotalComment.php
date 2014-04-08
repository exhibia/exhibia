<?php

function getTotalComment($commid) {
global $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
    $rescomm = db_query("select count(*) from community_comment where community_id=$commid") or die(db_error());
    if (db_num_rows($rescomm) > 0) {
        $totalcomm = db_result($rescomm, 0, 0);
        db_free_result($rescomm);
        return $totalcomm;
    } else {
        return 0;
    }
}