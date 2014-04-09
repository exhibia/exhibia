<?php
ini_set('display_errors', 1);
ini_set('max_execution_time', 300);
include("../../../config/config.inc.php");


db_connect($DBSERVER, $USERNAME, $PASSWORD);


db_select_db($DATABASENAME);



    @db_query("alter table auction_running add column autolister tinyint(1) null default '0'");
    @db_query("alter table auction add column autolister tinyint(1) null default '0'");




function FutureAuctionManage($auctionid) {
    $localtime = time();
      include("../../../config/config.inc.php");


      db_connect($DBSERVER, $USERNAME, $PASSWORD);


      db_select_db($DATABASENAME);


    $sqlsel = "select auctionID, total_time, auc_start_price from auction where future_tstamp<=$localtime and auc_status='1' and auctionID = '$auctionid' limit 1";
    $result = db_query($sqlsel);
    while ($auc = db_fetch_array($result)) {
        begin();
        $sqlins = "insert into auc_due_table (auction_id, auc_due_time, auc_due_price) values('{$auc['auctionID']}','{$auc['total_time']}','{$auc['auc_start_price']}')";
        if (!db_query($sqlins)) {
            rollback();
            echo "test4Failed";
            return;
        }

        $upsql = "update auction set auc_status='2' where auctionID='{$auc['auctionID']}'";
        if (!db_query($upsql)) {
            rollback();
            echo "test5Failed";
            return;
        }

        if (initRunningTable($auc['auctionID']) == false) {
            rollback();
            return;
        }

        commit();
    }
}

  if(!function_exists('Relist')){
 function initRunningTable($aid) {
 
    $localtime = time();
      include("../../../config/config.inc.php");


      db_connect($DBSERVER, $USERNAME, $PASSWORD);


      db_select_db($DATABASENAME);   

    
    $sqlsel = "select * from auction where auctionID='$aid'";
    $result = db_query($sqlsel);
    if (db_num_rows($result) > 0) {
        $auction = db_fetch_array($result);
        $sqlins = "insert into auction_running(auctionID,productID,auc_start_price,auc_status,pause_status,time_duration,use_free,fixedpriceauction,
            pennyauction,nailbiterauction,offauction,nightauction,openauction,reverseauction,uniqueauction,halfbackauction,seatauction,minseats,maxseats,
            seatbids,lockauction,locktype,locktime,lockprice,relist,cashauction,reserve, autolister) values('{$auction['auctionID']}','{$auction['productID']}','{$auction['auc_start_price']}','{$auction['auc_status']}','{$auction['pause_status']}','{$auction['time_duration']}','{$auction['use_free']}','{$auction['fixedpriceauction']}',
            '{$auction['pennyauction']}','{$auction['nailbiterauction']}','{$auction['offauction']}','{$auction['nightauction']}','{$auction['openauction']}','{$auction['reverseauction']}','{$auction['uniqueauction']}','{$auction['halfbackauction']}','{$auction['seatauction']}','{$auction['minseats']}','{$auction['maxseats']}',
            '{$auction['seatbids']}','{$auction['lockauction']}','{$auction['locktype']}','{$auction['locktime']}','{$auction['lockprice']}','{$auction['relist']}','{$action['cashauction']}', '{$aucton['reserve']}', 1)";
        if (!db_query($sqlins)) {
            return false;
        }

        $sqlins2 = "insert into auction_run_status(auctionid,lefttime,newprice,heighuseravatar,heighuser,uniqueauction,lowbidcount,seatauction,seatauctionnow,seatcount,minseats)
            values('{$auction['auctionID']}','{$auction['total_time']}','{$auction['auc_start_price']}','','[]','{$auction['uniqueauction']}','0','{$auction['seatauction']}','{$auction['seatauction']}','0','{$auction['minseats']}')";
        if (!db_query($sqlins2)) {
            return false;
	}
    }
    return true;
}

function InitiateAuction($auctionid) {

$localtime = time();


	include("../../../config/config.inc.php");


	db_connect($DBSERVER, $USERNAME, $PASSWORD);


	db_select_db($DATABASENAME);
	
	
  $sql = "select * from auction where auctionID='$auctionid' and future_tstamp>=$localtime";
    $result = db_query($sql);
    if (db_num_rows($result) > 0) {
        $obj = db_fetch_array($result);
        $interval = strtotime($obj['auc_end_date'] . ' ' . $obj['auc_end_time']) - strtotime($obj['auc_start_date'] . ' ' . $obj['auc_start_time']);
        $now = time();
        $startdate = $obj['auc_start_date'];
        $starttime = $obj['auc_start_time'];
        $enddate =  $obj['auc_end_date'];
        $endtime =  $obj['auc_end_time'];
	



       
        $qry = "Insert into auc_due_table (auction_id,auc_due_time,auc_due_price) values($auctionid,'$interval','{$obj['auc_start_price']}')";
        db_query($qry);

    }
            
}

}  
    
    $starttime = time();
    $start = '';
    
    $i = 0;
    
    $prev_time = 0;
    
    while($i < 1){
    
     $Sql = db_query("select * from autolister where recuurences > 0 order by timestamp, sort, id, autolister.productID asc");
      
	$r = 1;
      
	  while($row = db_fetch_array($Sql)){
	  
	  
	  $max_auctions = db_fetch_array(db_query("select * from autolister_settings where setting = 'max_auctions' limit 1"));
	  
	  if(db_num_rows(db_query("select * from auction_running where autolister = '1'")) < $max_auctions[2]){
	  
	  
	  
	  $rowP = db_fetch_array(db_query("select * from products where productID = '$row[productID]' limit 1"));
	  
	  
	  $prev_row = db_fetch_array(db_query("select * from auction order by auctionID desc limit 1"));
	  
	  
	  $recuurences = $row['recuurences'] - 1;
	  db_query("update autolister set recuurences = '$recuurences' where id = $row[id] limit 1");  
	  
		//echo "inserting $rowP[name] for $row[timestamp]\n\n";
	  
			  $qryins = "Insert into auction(auctionID, categoryID, productID, auc_start_price,  fixedpriceauction, pennyauction, nailbiterauction, offauction, openauction, uniqueauction, reverseauction, shipping_id, tax1, tax2, reserve, auc_status, use_free, autolister, halfbackauction, cashauction)";

			  if($row['reserve'] == '' | $row['reserve'] == 'null'){
			    $row['reserve'] = '0.00';
			  
			  }
			  if($row['tax1'] == '' | $row['tax1'] == 'null'){
			    $row['tax1'] = '0';
			  
			  }
			  if($row['tax2'] == '' | $row['tax2'] == 'null'){
			    $row['tax2'] = '0';
			  
			  }
			  $qryins .= "values(null, '$rowP[categoryID]', '$row[productID]', '$row[aucstartprice]', '$row[fixedpriceauction]', '$row[pa]', '$row[nailbiterauction]', '$row[offauction]', '$row[openauction]', '$row[uniqueauction]', '$row[reverseauction]', '$row[shippingmethod]', '$row[tax1]', '$row[tax2]', '$row[reserve]', '1', '', 1, '$row[halfbackauction]', '$row[cashauction]');";
					   
		 
		 
		 
			db_query($qryins);
			
			
			

			
	  $auctionid = db_insert_id();
	  
	  

		 
				      if($row['allow_buy_now'] >= '1'){
					  $update = "update auction set
						  allowbuynow = '$row[allow_buy_now]',
						  buynowprice =  '$row[buynowprice]'
						  
						  where auctionID = '$auctionid'";				      
				      
				      
				      }else{
					  $update = "update auction set
					      allowbuynow = '0',
					      buynowprice =  '0'
					      
					      where auctionID = '$auctionid'";
				      
				      
				      }
		  db_query($update);
		  
		  if(is_array($prev_row) & !empty($prev_row['auc_start_date'])){
		  
			    $last_start_time = $prev_row['auc_start_date'] . " " . $prev_row['auc_start_time'];
			    $last_end_time = $prev_row['auc_end_date'] . " " . $prev_row['auc_end_time'];
			    
			    $starttime = strtotime($last_end_time);
			if(!empty($row['stagger'])){
			
			
			
			}
			echo date("Y-m-d H:i:s", $starttime) . "\n";
			echo ($row['run_for'] * 60) . "\n";
			
			    $startdate = date("Y-m-d H:i:s", $starttime);
			    $start_readable_date = explode(" ", $startdate);			    
			    
			    
			    
			    $endtime = ($row['run_for'] * 60) + $starttime;
			    
			    $enddate = date("Y-m-d H:i:s", $endtime);
			    $end_readable_date = explode(" ", $enddate);	  
		  
		  }else{
		  
			    $starttime = time();
		  
			    $startdate = date("Y-m-d H:i:s");
			    $start_readable_date = explode(" ", $startdate);
			    
			    
			    
			    
			    $endtime = ($row['run_for'] * 60) + $starttime;
			    
			    $enddate = date("Y-m-d H:i:s", $endtime);
			    $end_readable_date = explode(" ", $enddate);
			
			}
	  
	  
			
			
					$update = "update auction set auc_start_date = '$start_readable_date[0]', auc_start_time = '$start_readable_date[1]', auc_end_date = '$end_readable_date[0]', auc_end_time = '$end_readable_date[1]',  future_tstamp = '" . $endtime . "', time_duration = '20sa' where auctionID = '$auctionid' limit 1";
					
					db_query($update);
					 echo date("Y-m-d H:i:s", $endtime);
					
				
					  
					
					
					
				      $now = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));
				      $diff = $endtime - $now;
				      echo "$endtime - $now = " . $diff . "\n";
					    
					if( $starttime > $now){
					      
					  
					  
					      $update = "update auction set
					      total_time = '-" . $endtime . "',
					      auc_status = '1'
					      where auctionID = '$auctionid' limit 1";
					      
					      }else{
					      
					      $update = "update auction set
					      total_time = '" . $diff . "',
					      auc_status = '2'
					      where auctionID = '$auctionid' limit 1";
					      
					      
					      
					      }
					    echo $update . "\n";
					    

		
	      db_query($update);
	      echo db_error();
	      
	  initRunningTable($auctionid);
	  InitiateAuction($auctionid);
					    if($r == 2){
					   //die();
					    }
					    $r++;
	  
	    }
      
      
      
      
      
      echo db_error();
      }
      
      }
      
?>