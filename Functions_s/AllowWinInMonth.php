<?php

function allowWinInMonth($userid) {
    include_once 'common/sitesetting.php';
    $limitmonth = Sitesetting::getWinLimitPerMonth();
    if ($limitmonth == 0) {
        return true;
    }
    $sql = "select count(*) from won_auctions where userid='$userid' and month(won_date)=month(now());";
    $result = db_query($sql);
    $count = db_result($result, 0);
    if ($count >= $limitmonth) {
        return false;
    } else {
        return true;
    }
}

