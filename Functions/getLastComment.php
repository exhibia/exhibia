<?php
function getLastComment($commid) {
global $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
    $rescomm = db_query("select user_id from community_comment where community_id='$commid' order by id desc limit 0, 1");
    $uid = 0;
    if (db_num_rows($rescomm) > 0) {
        $uid = db_result($rescomm, 0, 0);
    }
    db_free_result($rescomm);
    return $uid;
}
