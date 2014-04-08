<?php

//if(!function_exists('Relist')){
function Relist($auctionid) {
global $BASE_DIR;
include($BASE_DIR . "/config/config.inc.php");
$colors = new Colors_CLI();
echo $colors->getColoredString("*****RELISTING AUCTION $auctionid*******", "cyan") ."\n";
//if(db_num_rows(db_query("select * from auction where auc_status = 2")) < 20){
    $sql = "select * from auction where auctionID='$auctionid'";
    
    $result = db_query($sql);
    //if (db_num_rows($result) > 0) {
        $obj = db_fetch_array($result);
        $interval = strtotime($obj['auc_end_date'] . ' ' . $obj['auc_end_time']) - strtotime($obj['auc_start_date'] . ' ' . $obj['auc_start_time']);
        $now = time();
        $startdate = date('Y-m-d', $now);
        $starttime = date('H:i:s', $now);
        $enddate = date('Y-m-d', $now + $interval);
        $endtime = date('H:i:s', $now + $interval);
	$qryins = "Insert into auction (null, categoryID,productID,auc_start_price,auc_fixed_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,time_duration,auc_recurr,total_time,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,use_free,allowbuynow,buynowprice,uniqueauction,reverseauction,halfbackauction,tax1,tax2,relist,bidpack,reserve, cashauction, minseats, maxseats , free_seats, seatauction, escroe, escroe_bids) values('{$obj['auction_id']}'{$obj['categoryID']}','{$obj['productID']}',{$obj['auc_start_price']},{$obj['auc_fixed_price']},'','$startdate','$enddate','$starttime','$endtime','2','{$obj['auc_type']}','{$obj['fixedpriceauction']}','{$obj['pennyauction']}','{$obj['nailbiterauction']}','{$obj['offauction']}','{$obj['nightauction']}','{$obj['openauction']}','{$obj['time_duration']}','{$obj['auc_recurr']}','$interval','{$obj['shipping_id']}','$now','{$obj['recurr_count']}','{$obj['auction_min_price']}', '" . $obj['min_win_price'] . "','{$obj['use_free']}','{$obj['allowbuynow']}','{$obj['buynowprice']}','{$obj['uniqueauction']}','{$obj['reverseauction']}','{$obj['halfbackauction']}','{$obj['tax1']}','{$obj['tax2']}','{$obj['relist']}','{$obj['bidpack']}', '{$obj['reserve']}', '{$obj['cashauction']}', '{$obj['minseats']}', '{$obj['maxseats']}', '{$obj['free_seats']}', '{$obj['seatauction']}', '{$obj['escroe']}', '{$obj['escroe_bids']}')";


	db_query($qryins);


        $newid = db_insert_id();
        $qry = "Insert into auc_due_table (auction_id,auc_due_time,auc_due_price) values($newid,'$interval','{$obj['auc_start_price']}')";
        db_query($qry);
        initRunningTable($newid);
   // }
  // }
}

//}