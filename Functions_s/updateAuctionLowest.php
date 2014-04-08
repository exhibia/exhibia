<?php


function updateAuctionLowest($auctionid, $leftiem, $usefree, $topuserid, $topusername, $topbidercount, $isupdatetime) {
global $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
    try {
        $arrTopuser = array();
        $topavatar = getAvatar($topuserid);
        $sqlcount = "select count(*) from unique_bid where auctionid=$auctionid";
        $rescount = db_query($sqlcount);
        $uniquecount = db_result($rescount, 0);

        if ($topbidercount <= 1) {
            if ($topusername == '') {
                $heightuser = '[]';
            } else {
                array_push($arrTopuser, $topusername);
                $heightuser = json_encode($arrTopuser);
            }
        } else {
            if ($usefree == 1) {
                $sqlsel = "select username from free_account_bidding where auction_id='$auctionid' order by id desc limit 0,$topbidercount";
            } else {
                $sqlsel = "select username from bid_account_bidding where auction_id='$auctionid' order by id desc limit 0,$topbidercount";
            }

            $result = db_query($sqlsel) or die(db_error());
            if (db_num_rows($result) > 0) {
                while ($obj = db_fetch_array($result)) {
                    array_push($arrTopuser, $obj['username']);
                }
                $heightuser = json_encode($arrTopuser);
            } else {
                $heightuser = '[]';
            }
        }
        $upsql = "update auction_run_status set heighuser='$heightuser',lowbidcount='$uniquecount',heighuseravatar='$topavatar'";
        if ($isupdatetime) {
            $upsql.=",lefttime='$leftiem'";
        }
        $upsql .= " where auctionid='$auctionid'";
        db_query($upsql);
    } catch (Exception $e) {
        return false;
    }
}