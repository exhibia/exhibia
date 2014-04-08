<?php

/* end update butler function */

/**
 * is allowed the win account is overflow
 * @param <type> $userid
 */
function allowWinInWeek($userid) {
    include_once 'common/sitesetting.php';

    $limitweek = Sitesetting::getWinLimitPerWeek();
    if ($limitweek == 0) {
        return true;
    }
    $sql = "select count(*) from won_auctions where userid='$userid' and week(won_date)=week(now());";
    $result = db_query($sql);
    $count = db_result($result, 0);
    if ($count >= $limitweek) {
        return false;
    } else {
        return true;
    }
}

