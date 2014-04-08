<?php

function updateAuctionBidding($auctionid, $lefttime, $newprice, $usefree, $topuserid, $topusername, $topbidercount, $isupdatetime = false) {
global $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
    $arrTopuser = array();
    $topavatar = getAvatar($topuserid);
    if ($topbidercount <= 1) {
        if ($topusername != '') {
            array_push($arrTopuser, $topusername);
            $heightuser = json_encode($arrTopuser);
        } else {
            $heightuser = '[]';
        }
    } else {
        if ($usefree == 1) {
            $sqlsel = "select username from free_account_bidding where auction_id='$auctionid'";
        } else {
            $sqlsel = "select username from bid_account_bidding where auction_id='$auctionid'";
        }

        $result = db_query($sqlsel);
        if (db_num_rows($result) > 0) {
         $result = db_query($sqlsel . " order by id desc limit 0,$topbidercount");
            while ($obj = db_fetch_array($result)) {
                array_push($arrTopuser, $obj['username']);
            }
            $heightuser = json_encode($arrTopuser);
        } else {
            $heightuser = '[]';
        }
    }
   // $newprice = $newprice - '0.01';
    $upsql = "update auction_run_status set newprice='$newprice',heighuser='$heightuser',heighuseravatar='$topavatar'";
    
    if ($isupdatetime) {
        $upsql.=",lefttime='$lefttime'";
    }
    $upsql .= " where auctionid='$auctionid'";
    
    db_query($upsql);
}