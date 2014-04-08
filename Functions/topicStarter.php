<?php
function topicStarter($topic_id) {
global $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
    $selectStarter = "select topic_time, username from forum_topic ft left join registration rg on ft.topic_starter = rg.id where ft.topic_status = 0 and ft.topic_id = $topic_id";
    $resultStarter = db_query($selectStarter) or die(db_error());
    $row = db_fetch_object($resultStarter);
    db_free_result($resultStarter);

    if ($row != false) {
        return ($row->username . "|" . $row->topic_time);
    } else {
        return ("|");
    }
}