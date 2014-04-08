<?php
function checkaucstatus($status) {
global $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
    if ($status == "2") {
        $qryauc = "select count(*) from auction a left join auc_due_table adt on a.auctionID=adt.auction_id where adt.auc_due_time!=0 and auc_status='$status' and a.uniqueauction=0";
    } elseif ($status == 3) {
        $qryauc = "select count(*) from auction where auc_status='$status' and auc_final_end_date>='" . CreateSelEndDate() . "' and auc_final_end_date<='" . date("Y-m-d") . " 23:59:59' and uniqueauction=0";
    } else {
        $qryauc = "select count(*) from auction where auc_status='$status'";
    }
    $rsauc = db_query($qryauc);
    $totalauc = db_result($rsauc, 0);
    db_free_result($rsauc);

    return $totalauc;
}
