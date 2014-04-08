<?php

function lastPostOnTopic($topic_id) {
global $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
    $selectlast = "select username, reply_time from forum_reply fr left join registration rg on fr.reply_user = rg.id where fr.reply_status = 0 and fr.topicid = $topic_id order by fr.reply_id desc limit 0, 1";

   $resultlast = db_query($selectlast);
    
    $row = db_fetch_object($resultlast);
    
    echo db_error();
    
    db_free_result($resultlast);
    if ($row != false) {
        return ($row->username . "|" . $row->reply_time);
    } else {
        return ("|");
    }
}



