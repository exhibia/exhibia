<?php

 function start_all_now($row, $rowP, $prev_row, $DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME, $starttime = false, $endtime = false){
      global $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");

      
      

$colors = new Colors_CLI();

			if(!$starttime){
			    $starttime = strtotime(date("Y-m-d H:i:s"));
			 }
			 
			 
			    $startdate = date("Y-m-d H:i:s", $starttime);

			    $start_readable_date = explode(" ", $startdate);			    
			    
			    
			 if(!$endtime){  
			 
			
			    $endtime = ($row['run_for'] * 60) + $starttime;
			  }
			  
			  
			if($row['stagger'] == '1'){
        		
			    $prev_auto_result = db_fetch_array(db_query("select auc_end_date, auc_end_time from auction where auc_status = '2' order by auctionID desc limit 1"));
			     
			     if((empty($prev_auto_result[0]) | empty($prev_auto_result[1])) | ($prev_auto_result[0] == '0000-00-00' | $prev_auto_result[1] == '00:00:00')){//there are no auctions
				$prev_auto_result[0] = date("Y-m-d");
				$prev_auto_result[1] = date("H:i:s");
			      
			      }
				  $endtime = strtotime($prev_auto_result[0] . " " . $prev_auto_result[1]);
				  
				  if(!empty($prev_row['start_every'])){
				      $stagger = $prev_row['start_every'];
				    }else{
				      $stagger = 0;
				    }
				  
				  
				  $endtime = ($row['run_for'] * 60) + $endtime; 
					    //echo $colors->getColoredString("THIS IS EXPERIMENTAL USE AT YOUR OWN RISK*****", "red") . "\n\n\n";
					    
					    
			 }else{
			
			  $prev_auto_result = db_fetch_array(db_query("select auc_end_date, auc_end_time from auction where auc_status = '2' order by auctionID desc limit 1"));
			  
			  
			      if((empty($prev_auto_result[0]) | empty($prev_auto_result[1])) | ($prev_auto_result[0] == '0000-00-00' | $prev_auto_result[1] == '00:00:00')){//there are no auctions
				$prev_auto_result[0] = date("Y-m-d");
				
				$prev_auto_result[1] = date("H:i:s");
			      
			      }
			   
			       if(!empty($prev_row['start_every'])){
				      $stagger = $prev_row['start_every'];
				    }else{
				      $stagger = 60;
				    }
				    
				    if(!$starttime){
					$starttime = strtotime(date("Y-m-d H:i:s"));
				    }
			 
			 if(!empty($row['start_now'])){
			 $starttime = time();
			 
			 
			 }
			 
			 
				  $endtime = strtotime($prev_auto_result[0] . " " . $prev_auto_result[1]);
				  
				  if(!empty($prev_row['start_every'])){
				      $stagger = $prev_row['start_every'];
				    }else{
				      $stagger = 0;
				    }
				  
				  
				  $endtime = ($row['run_for'] * 60) + $endtime; 		 
			 }
			 
			 
			 
			    $enddate = date("Y-m-d H:i:s", $endtime);
			   
			    $end_readable_date = explode(" ", $enddate);	  
		      
		  
	  
	  

				      $diff = $endtime - $now;

				      
				     
			  
			

					
					
					
				$auctionid = insert_auction($row, $rowP, $DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME);
				db_query("update autolister set auction_id = '$auctionid' where id = $row[id] limit 1");
				
				
				add_time_to_auction($auctionid, $starttime, $start_readable_date, $end_readable_date, $DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME);
				
			if($row['allow_buy_now'] >= '1'){
					  $update = "update auction set allowbuynow = '1', buynowprice =  '$row[buynowprice]' where auctionID = '$auctionid'";				      
				      
				      
				      }else{
					  $update = "update auction set allowbuynow = '0', buynowprice =  '0' where auctionID = '$auctionid'";
				      
				      
				      } 
				   db_query($update);
				   
				   
			if($row['reserve'] != ''){
			
			 $update = "update auction set reserve = '$row[reserve]' where auctionID = '$auctionid'";
			
			
			}
		                db_query($update);
		                
				FutureAuctionManage2($auctionid, $starttime, $DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME); 
		
		
		$recuurences = $row['recuurences'] - 1;
				
		 db_query("update autolister set recuurences = '$recuurences' where id = $row[id] limit 1");	
		 db_free_result();
		
		 return $auctionid;
}
  