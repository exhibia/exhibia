<?php


	
	
function start_autolister($starttime,$DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME, $records = null){
global $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
db_query("update auction set auc_status = '3' where auc_end_date <= '1999-01-01';");

    if(empty($records)){
      $records = 1;
    }
$colors = new Colors_CLI();
    


    $db = db_connect($DBSERVER, $USERNAME, $PASSWORD);


    db_select_db($DATABASENAME, $db);
      
      
    
    $start = '';
    
     $Sql = db_query("select * from autolister where recuurences > '0' order by sort, timestamp, id asc");
      
	$auctionid = '';
	
	$run = 1;
	  while($row = db_fetch_array($Sql)){
	  
	
	  
		
	      
			$max_auctions = db_fetch_array(db_query("select * from autolister_settings where setting = 'max_auctions' limit 1"));
		      
			
			$rowP = db_fetch_array(db_query("select * from products where productID = '$row[productID]' limit 1"));
			
			
			$prev_row = db_fetch_array(db_query("select * from auction order by auctionID desc limit 1"));
			
			      
			
			if(db_num_rows(db_query("select * from auction where autolister >= 1 and auc_status = '2'")) < $max_auctions['value']){

			    $new_auction = db_fetch_array(db_query("select * from autolister where auction_id = 'waitting' or auction_id = '' or auction_id = 'NULL' order by id asc limit 1"));
			
			    $auctionid = start_all_now($row, $rowP, $prev_row, $DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME);
			
			
			}else{
		/*$run++;
		    if($run == $max_auctions[2]){
		      $records++;
		    }			
		*/	
			  $auctionid = makeAuctionTime($row, $starttime, $records, $DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME);
		}
		if(!empty($auctionid)){
		
		    db_query("update autolister set auction_id = '$auctionid' where id = $row[id] limit 1");
		
		}
			
	      echo db_error();
	 

	 

	  }
	  db_free_result($row);
  echo db_error();
      return $records;
      
      }
