<?php


function totalPostOnTopic($topicid) {
global $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
    $resultTopic = db_query("select count(*) as totaltopic from forum_reply where reply_status = 0 and topicid = $topicid") or die(db_error());

    if (db_num_rows($resultTopic) > 0) {
        $totaltopic = db_result($resultTopic, 0, 0);
        db_free_result($resultTopic);

        return $totaltopic;
    } else {
        return 0;
    }
}


