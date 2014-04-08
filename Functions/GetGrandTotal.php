<?php
function GetGrandTotal($uid) {
global $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
    $qrygrandtotal = "select SUM(commission) as grandcommission, SUM(amount) as grandamount, trans_status from affiliate_transaction where user_id=$uid group by user_id,trans_status";
    $resgrandtotal = db_query($qrygrandtotal);

    $totalcommission = 0;
    $totalamount = 0;
    while (( $rowgrandtotal = db_fetch_array($resgrandtotal))) {
        if ($rowgrandtotal['trans_status'] == "C") {
            $totalcommission = $totalcommission + $rowgrandtotal['grandcommission'];
            $totalamount = $totalamount + $rowgrandtotal['grandamount'];
        } elseif ($rowgrandtotal['trans_status'] == "D") {
            $totalcommission = $totalcommission - $rowgrandtotal['grandcommission'];
            $totalamount = $totalamount - $rowgrandtotal['grandamount'];
        }
    }
    db_free_result($resgrandtotal);

    return ($totalamount . "|" . $totalcommission);
}