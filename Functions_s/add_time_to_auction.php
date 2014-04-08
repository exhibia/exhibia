<?php

function add_time_to_auction($auctionid, $starttime, $start_readable_date, $end_readable_date, $DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME){
				
      db_connect($DBSERVER, $USERNAME, $PASSWORD);


      db_select_db($DATABASENAME, $db);				
				
					  $update = "update auction set auc_start_date = '$start_readable_date[0]', 
					auc_start_time = '$start_readable_date[1]', auc_end_date = '$end_readable_date[0]', 
					auc_end_time = '$end_readable_date[1]',  
					future_tstamp = '" . $starttime . "', time_duration = '20sa' where auctionID = '$auctionid' limit 1";
					
					db_query($update);
					//echo $update;
					db_free_result();
					usleep(100);
					
}
