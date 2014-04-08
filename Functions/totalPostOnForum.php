<?php

function totalPostOnForum($forumid) {
global $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
    $selectPost = "select count(*) as totalpost from forum_reply fr left join forum_topic ft on fr.topicid = ft.topic_id where fr.reply_status = 0 and ft.topic_status = 0 and ft.forum_id = $forumid";
 $resultPost = db_query($selectPost) or die(db_error());

    if (db_num_rows($resultPost) > 0) {
        $totalpost = db_result($resultPost, 0, 0);
        db_free_result($resultPost);

        return $totalpost;
    } else {
        return 0;
    }
}
