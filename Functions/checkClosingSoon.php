<?php
function checkClosingSoon() {
global $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
    $qryauc = "select count(*) from auction a left join auc_due_table adt on a.auctionID=adt.auction_id where adt.auc_due_time<=60 and auc_status='2'";
    $rs = db_query($qryauc);
    return db_result($rs, 0);
}
?>
 
