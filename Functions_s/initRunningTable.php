<?php

function initRunningTable($aid) {
global  $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
    $sqlsel = "select * from auction where auctionID='$aid'";
  
    $result = db_query($sqlsel);
    if (db_num_rows($result) > 0) {
      if(db_num_rows(db_query("select * from auction_running where auctionID = '$aid'")) == 0){
        $auction = db_fetch_array($result);
        $sqlins = "insert into auction_running(auctionID,productID,auc_start_price,auc_status,pause_status,time_duration,use_free,fixedpriceauction,
            pennyauction,nailbiterauction,offauction,nightauction,openauction,reverseauction,uniqueauction,halfbackauction,seatauction,minseats,maxseats,
            seatbids,lockauction,locktype,locktime,lockprice,relist,cashauction,reserve, bids_to_take) values('{$auction['auctionID']}','{$auction['productID']}','{$auction['auc_start_price']}','{$auction['auc_status']}','{$auction['pause_status']}','{$auction['time_duration']}','{$auction['use_free']}','{$auction['fixedpriceauction']}',
            '{$auction['pennyauction']}','{$auction['nailbiterauction']}','{$auction['offauction']}','{$auction['nightauction']}','{$auction['openauction']}','{$auction['reverseauction']}','{$auction['uniqueauction']}','{$auction['halfbackauction']}','{$auction['seatauction']}','{$auction['minseats']}','{$auction['maxseats']}',
            '{$auction['seatbids']}','{$auction['lockauction']}','{$auction['locktype']}','{$auction['locktime']}','{$auction['lockprice']}','{$auction['relist']}','{$action['cashauction']}', '{$aucton['reserve']}', '{$aucton['bids_to_take']}')";
       
        
        if (!db_query($sqlins)) {
        echo db_error();
            return false;
        }

        $sqlins2 = "insert into auction_run_status(auctionid,lefttime,newprice,heighuseravatar,heighuser,uniqueauction,lowbidcount,seatauction,seatauctionnow,seatcount,minseats)
            values('{$auction['auctionID']}','{$auction['total_time']}','{$auction['auc_start_price']}','','[]','{$auction['uniqueauction']}','0','{$auction['seatauction']}','{$auction['seatauction']}','0','{$auction['minseats']}')";
       
       if (!db_query($sqlins2)) {
            return false;
        }
       }
    }
   
    return true;
}
