<?php
function getUserRating($userid, $commid) {
global $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
    $resrat = db_query("select count(*) from community_rating where user_id=$userid and comment_id=$commid");

    if (db_num_rows($resrat) > 0) {
        $totalrat = db_result($resrat, 0, 0);
        db_free_result($resrat);

        return $totalrat;
    } else {
        return 0;
    }
}