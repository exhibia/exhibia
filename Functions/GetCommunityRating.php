<?php
function GetCommunityRating($comid) {
global $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
    $resrating = db_query("select thumb_up, thumb_down from community_comment where id=$comid");
    $objrating = db_fetch_array($resrating);
    db_free_result($resrating);

    $totalrating = $objrating["thumb_up"] + $objrating["thumb_down"];

    if ($totalrating != "" && $totalrating != "0") {
        $thumbuprating = number_format((($objrating["thumb_up"] / $totalrating) * 100), 2);
        $thumbdownrating = number_format((($objrating["thumb_down"] / $totalrating) * 100), 2);
    } else {
        $thumbuprating = "0.00";
        $thumbdownrating = "0.00";
    }
    return ($thumbuprating . "|" . $thumbdownrating);
}