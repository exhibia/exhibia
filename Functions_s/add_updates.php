<?php

function add_updates($auctionid, $row, $DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME){

    

    db_connect($DBSERVER, $USERNAME, $PASSWORD);


    db_select_db($DATABASENAME, $db);
    
				if($row['allow_buy_now'] >= '1'){
					  $update = "update auction set allowbuynow = '$row[allow_buy_now]', buynowprice =  '$row[buynowprice]' where auctionID = '$auctionid'";				      
				      
				      
				      }else{
					  $update = "update auction set allowbuynow = '0', buynowprice =  '0' where auctionID = '$auctionid'";
				      
				      
				      }
				    
		db_query($update);
		db_free_result();
		usleep(100);
	//	echo "\t" . $update . "\n\n";
				      
	}
	

	  