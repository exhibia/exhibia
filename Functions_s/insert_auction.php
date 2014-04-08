<?php

 function insert_auction($row, $rowP, $DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME){
  global $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
  
  $colors = new Colors_CLI();





    db_select_db($DATABASENAME, $db);



    @db_query("alter table auction_running add column autolister tinyint(1) null default '0'");
    @db_query("alter table auction add column autolister tinyint(1) null default '0'");
    
      
 
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
					   
		 
		 
	//	 echo $qryins . "\n\n";
			db_query($qryins);
			
			      $auctionid = db_insert_id();
			     echo $colors->getColoredString("!!!!!!!!ADDED AUCTIONID => $auctionid !!!!!!!!!!", "blue")."\n";
			     db_free_result();
			     usleep(100);
			      return $auctionid;
			      
	}
