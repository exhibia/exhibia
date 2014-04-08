<?php

function lastPostOnForum($forumid) {
global $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
    $selectUser = "select username, topic_time from forum_topic ft left join registration rg on ft.topic_starter = rg.id where ft.topic_status = 0 and ft.forum_id = $forumid order by ft.topic_id desc limit 0, 1";
    $resultUser = db_query($selectUser) or die(db_error());
    $Row = db_fetch_object($resultUser);
    db_free_result($resultUser);
    if ($Row != false) {
        return ($Row->username . "|" . $Row->topic_time);
    } else {
        return ("|");
    }
}