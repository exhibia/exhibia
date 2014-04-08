<?php

	  
function FutureAuctionManage2($auctionid, $localtime, $DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME) {
    global $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");


    $sqlsel = "select * from auction where auctionID = '$auctionid'";
    $result = db_query($sqlsel);
    $auc = db_fetch_array($result);
        
        $aid = $auctionid;
        
        $now = time();

        if($auc['future_tstamp'] <= $now){
        


	    $sqlsel = "select * from auction where auctionID='$aid'";
	    
	    
	    $result = db_query($sqlsel);
	 
	    
		echo "\tAuction time reached => auction added to running table \n\n\n";
		
		
		$auction = db_fetch_array($result);
		$sqlins = "insert into auction_running(auctionID,productID,auc_start_price,auc_status,pause_status,time_duration,use_free,fixedpriceauction,
		    pennyauction,nailbiterauction,offauction,nightauction,openauction,reverseauction,uniqueauction,halfbackauction,seatauction,minseats,maxseats,
		    seatbids,lockauction,locktype,locktime,lockprice,relist,cashauction,reserve, autolister) values('{$auction['auctionID']}','{$auction['productID']}','{$auction['auc_start_price']}','{$auction['auc_status']}','{$auction['pause_status']}','{$auction['time_duration']}','{$auction['use_free']}','{$auction['fixedpriceauction']}',
		    '{$auction['pennyauction']}','{$auction['nailbiterauction']}','{$auction['offauction']}','{$auction['nightauction']}','{$auction['openauction']}','{$auction['reverseauction']}','{$auction['uniqueauction']}','{$auction['halfbackauction']}','{$auction['seatauction']}','{$auction['minseats']}','{$auction['maxseats']}',
		    '{$auction['seatbids']}','{$auction['lockauction']}','{$auction['locktype']}','{$auction['locktime']}','{$auction['lockprice']}','{$auction['relist']}','{$action['cashauction']}', '{$aucton['reserve']}', '1')";
		db_query($sqlins);
		
		
		
	    $auc['total_time'] = strtotime($auc['auc_end_date'] . " " . $auc['auc_end_time']) - $localtime;
	    db_query("update auction set total_time = '$auc[total_time]' where auctionID = $auctionid");
	    
		$sqlins2 = "insert into auction_run_status(auctionid,lefttime,newprice,heighuseravatar,heighuser,uniqueauction,lowbidcount,seatauction,seatauctionnow,seatcount,minseats)
		    values('{$auction['auctionID']}','{$auction['total_time']}','{$auction['auc_start_price']}','','[]','{$auction['uniqueauction']}','0','{$auction['seatauction']}','{$auction['seatauction']}','0','{$auction['minseats']}')";
		db_query($sqlins2);
	 
	   
	    
	    $sqlins = "insert into auc_due_table (auction_id, auc_due_time, auc_due_price) values('{$auc['auctionID']}','{$auc['total_time']}','{$auc['auc_start_price']}')";
	    db_query($sqlins); 

	    $upsql = "update auction set auc_status='2' where auctionID='$auctionid'";
	      db_query($upsql);
	    $upsql = "update auction_running set auc_status='2' where auctionID='$auctionid'";
	      db_query($upsql);
	  
	  
       }else{
       
       
	    $auc['total_time'] = strtotime($auc['auc_end_date'] . " " . $auc['auc_end_time']) - $localtime;
	    db_query("update auction set total_time = '$auc[total_time]' where auctionID = $auctionid");
	    
		$auction = db_fetch_array($result);
		$sqlins = "insert into auction_running(auctionID,productID,auc_start_price,auc_status,pause_status,time_duration,use_free,fixedpriceauction,
		    pennyauction,nailbiterauction,offauction,nightauction,openauction,reverseauction,uniqueauction,halfbackauction,seatauction,minseats,maxseats,
		    seatbids,lockauction,locktype,locktime,lockprice,relist,cashauction,reserve, autolister) values('{$auction['auctionID']}','{$auction['productID']}','{$auction['auc_start_price']}','{$auction['auc_status']}','{$auction['pause_status']}','{$auction['time_duration']}','{$auction['use_free']}','{$auction['fixedpriceauction']}',
		    '{$auction['pennyauction']}','{$auction['nailbiterauction']}','{$auction['offauction']}','{$auction['nightauction']}','{$auction['openauction']}','{$auction['reverseauction']}','{$auction['uniqueauction']}','{$auction['halfbackauction']}','{$auction['seatauction']}','{$auction['minseats']}','{$auction['maxseats']}',
		    '{$auction['seatbids']}','{$auction['lockauction']}','{$auction['locktype']}','{$auction['locktime']}','{$auction['lockprice']}','{$auction['relist']}','{$action['cashauction']}', '{$aucton['reserve']}', '1')";
		db_query($sqlins);

		$sqlins2 = "insert into auction_run_status(auctionid,lefttime,newprice,heighuseravatar,heighuser,uniqueauction,lowbidcount,seatauction,seatauctionnow,seatcount,minseats)
		    values('{$auction['auctionID']}','{$auction['total_time']}','{$auction['auc_start_price']}','','[]','{$auction['uniqueauction']}','0','{$auction['seatauction']}','{$auction['seatauction']}','0','{$auction['minseats']}')";
		db_query($sqlins2);
		
		
	  echo "\tAuction time not yet reached\n\n\n";
	  db_query("update auction set auc_status = '1' where auctionID = '$auctionid'");
	  $upsql = "update auction_running set auc_status='1' where auctionID='$auctionid'";
	      db_query($upsql);
	  
       }
       db_free_result();
       usleep(100);
       
     
}	  