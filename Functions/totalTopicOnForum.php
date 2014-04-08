<?php

function totalTopicOnForum($id) {
global $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
    $result = db_query("select count(*) as totaltopic from forum_topic where topic_status = 0 and forum_id = $id") or die(db_error());

    if (db_num_rows($result) > 0) {

        $totaltopic = db_result($result, 0, 0);
        db_free_result($result);

        return $totaltopic;
    } else {
        return 0;
    }
}

