<?php



function initUpdateTime() {

$colors = new Colors_CLI();

    global $auction_pause_status, $newpauseglobalcounter, $totalauctpassel, $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
    $qry = "select * from auction_pause_management where id='1'";
    $rs = db_query($qry);
    $total = db_num_rows($rs);
    $ob = db_fetch_object($rs);
    $st = explode(":", $ob->pause_start_time);
    $et = explode(":", $ob->pause_end_time);
        echo $colors->getColoredString("****ALERT CHECKING PAUSED AUCTIONS****", "red") . "\n";
    $querysel = "select auctionId from auction_running where auc_status='2' and pause_status='1' limit 0,1";
    $resultsel = db_query($querysel) or die(db_error());
    $totalauctpassel = db_num_rows($resultsel);

    if ($totalauctpassel > 0) {
        $_SESSION["starttime"] = $ob->pause_start_timestamp;
        $auction_pause_status = 1;
           echo $colors->getColoredString("!!!!!!!!!AUCTIONS ARE PAUSED!!!!!!", "brown") . "\n";
            echo $colors->getColoredString("!!!!!!!!!OUTPUT WILL NOT DISPLAY UNTIL THEY RESTART!!!!!!", "purple") . "\n";
        //fetch from query which is set when auction is actually paused.
    } else {
    
	 echo $colors->getColoredString("!!!!!!!!!AUCTIONS ARE LIVE!!!!!!", "green") . "\n";
 
 
	$_SESSION["starttime"] = mktime($st[0], $st[1], $st[2], date("m"), date("d"), date("Y"));
    }

    if (CheckTimeGreater($st[0], $st[1], $st[2], $et[0], $et[1], $et[2]) == 1) {
        if ($totalauctpassel > 0) {
            if (date("Y-m-d") > date("Y-m-d", $_SESSION["starttime"])) {
                $_SESSION["endtime"] = mktime($et[0], $et[1], $et[2], date("m"), date("d"), date("Y"));
            } else {
                $_SESSION["endtime"] = mktime($et[0], $et[1], $et[2], date("m"), date("d") + 1, date("Y"));
            }
            // if server date is greater then timestamp date then dont add one day otherwise add one day in date.
        } else {
            $_SESSION["endtime"] = mktime($et[0], $et[1], $et[2], date("m"), date("d") + 1, date("Y"));
        }
    } else {
        $_SESSION["endtime"] = mktime($et[0], $et[1], $et[2], date("m"), date("d"), date("Y"));
    }
    return $auction_pause_status;
}
