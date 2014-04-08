<?php
function getPostcomment($commid, $userid) {
global $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
    $qrycom = "select registration_date, count(*) as cnt from community_comment cc left join registration r on r.id=cc.user_id where community_id=$commid and user_id=$userid";
    $rescom = db_query($qrycom);
    $objcom = db_fetch_array($rescom);
    db_free_result($rescom);

    return ($objcom["cnt"] . "|" . $objcom["registration_date"]);
}