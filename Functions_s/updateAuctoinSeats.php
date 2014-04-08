<?php

function updateAuctoinSeats($auctionid, $newtime, $minseats, $isupdatetime) {
global $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
    $sql = "select count(id) from auction_seat where auction_id=$auctionid";
    $seatauctionnow = 1;
    $result = db_query($sql);
    $seatcount = db_result($result, 0);
    if ($seatcount >= $minseats) {
        $seatauctionnow = 0;
    }

    $upsql = "update auction_run_status set seatcount='$seatcount',seatauctionnow='$seatauctionnow'";
    if ($isupdatetime) {
        $upsql.=",lefttime='$newtime'";
    }
    $upsql.=" where auctionid='$auctionid'";

    db_query($upsql);
}