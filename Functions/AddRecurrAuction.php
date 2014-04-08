<?php
if(!function_exists('dbase')){
include_once('Functions/dbase.php');
}

function AddRecurrAuction($aucid) {
global $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
    $ressel = db_query("select * from auction where auctionID=" . $aucid);
    $objsel = db_fetch_object($ressel);
    db_free_result($ressel);

    if ($objsel->recurr_count > 0) {
        $localtime = time();
        $startdate = date("Y-m-d", $localtime);
        $enddate = date("Y-m-d", $localtime + $objsel->total_time);
        $starttime = date("H:i:s", $localtime);
        $endtime = date("H:i:s", $localtime + $objsel->total_time);
        $futuretstamp = strtotime(date("Y-m-d H:i:s", $localtime + $objsel->total_time));

        begin();
        $qryins = "Insert into auction (categoryID, productID, auc_start_price, auc_start_date, auc_end_date, auc_start_time, auc_end_time," .
                " auc_status, auc_fixed_price, fixedpriceauction, pennyauction, nailbiterauction, offauction, nightauction, openauction," .
                " time_duration, total_time, pause_status, shipping_id, future_tstamp, recurr_count) " .
                "values (" . $objsel->categoryID . ", " . $objsel->productID . ", '" . $objsel->auc_start_price . "', '" . $startdate . "', '" . $enddate . "', " .
                " '" . $starttime . "', '" . $endtime . "', '2', '" . $objsel->auc_fixed_price . "', " . $objsel->fixedpriceauction . ", " .
                " " . $objsel->pennyauction . ", " . $objsel->nailbiterauction . ", " . $objsel->offauction . ", " . $objsel->nightauction . ", " .
                " " . $objsel->openauction . ", '" . $objsel->time_duration . "', " . $objsel->total_time . ", " . $objsel->pause_status . ", " .
                " " . $objsel->shipping_id . ", '" . $futuretstamp . "', " . ($objsel->recurr_count - 1) . ")";
        if (!db_query($qryins)) {
            rollback();
            echo "Failed";
        }
        $newauctionid = db_insert_id();

        $qryins1 = "Insert into auc_due_table (auction_id, auc_due_time, auc_due_price) " .
                "values (" . $newauctionid . ", " . $objsel->total_time . ", '" . $objsel->auc_start_price . "')";
        if (!db_query($qryins1)) {
            rollback();
            echo "Failed";
        }
        commit();
    }
}