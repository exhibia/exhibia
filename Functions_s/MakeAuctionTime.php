<?php

function makeAuctionTime($row, $starttime, $records, $DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME){
if(empty($records)){
$records = 1;
}
global $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
      
      
@db_query("alter table autolister add column auction_id varchar(20) null");
$colors = new Colors_CLI();

     


     
  			$max_auctions = db_fetch_array(db_query("select * from autolister_settings where setting = 'max_auctions' limit 1"));
		      
		
			$rowP = db_fetch_array(db_query("select * from products where productID = '$row[productID]' limit 1"));
			
			
			
			
//	echo "Limiting Auto Lister to $max_auctions[2] at a time\n\n\n";
		$now = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));	
		
	echo $now;
	die();
		$max_to_list = $max_auctions[2];	    
			    
			if(!empty($row['start_now'])){
			
				    $auctionid = start_all_now($row, $rowP, $DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME);
				    //if set to start now
			
			}else{
			    
			    
			    
			    
		$prev_auto_result = db_fetch_array(db_query("select start_every from auction, autolister where autolister.auction_id = auction.auctionID and auction.auctionID != '$row[auction_id]' order by auction.auctionID desc limit 1"));
					
			    
			    
			    if( db_num_rows(db_query("select * from auction_running where autolister >= '1' and auc_status = '2'")) < $max_to_list){
//need to test limiting auctions	

					      echo $colors->getColoredString("****ALERT THIS AUCTION STARTS NOW TO FILL UP THE AUCTION RESULTS OF $max_to_list*****", "red") . "\n\n";
						
						
						
						
						
				    $auctionid = start_all_now($row, $rowP, $DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME);
				    //we need more auctions so do the default and start this one until they are full
				
			         }else{
			         
			         
				    //	print_r($prev_row);
				    
				  if( get_start_time($row) >= $now){
				  
				      $auctionid = start_all_now($row, $rowP, $DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME);
				  
				  
			}else{
				  
			$auctionid = 'waitting';
				  
		    }
					      
	  
	  
	      }
 
 
 
	}

	db_query("update autolister set auction_id = 'waitting' where id = '$row[id]'");
	db_free_result();
	usleep(200);
	
	if(!empty($auctionid)){
	return $auctionid;
	}else{
	return '';
	}

}

