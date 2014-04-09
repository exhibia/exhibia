<?php
$i = 1;

      $co = '';
      $replicate_all = db_num_rows(db_query("select * from products where categoryID = '$categoryID'")) * $replicate;
      
      
      
      while($i <= $replicate_all){
	$qry_product = db_query("select * from products where categoryID = '$categoryID' order by productID");
	while($row_product = db_fetch_array($qry_product)){
	 if($debug == true){
	      ?><pre><?php
		  print_r($row_product);
	      ?></pre><?php
	      }
	      $productID = $row_product['productID'];
	  if($replicate_all > 1 & $_REQUEST['replicate_delay'] > 0){
		  $auc_end_time_array = explode(":", $auc_end_time);
		  $i_min = $auc_end_time_array[1] + $_REQUEST['replicate_delay'];
		  $futuretstamp = $futuretstamp + (60 * $_REQUEST['replicate_delay']);
		  
		  if($i_min < 60){
		      if(strlen($i_min) == 1){
			  $i_min = '0' . $i_min;
		      }
		      $auc_end_time = $auc_end_time_array[0] . ":" . $i_min . ":" . $auc_end_time_array[2];
		  }else{
		      $i_min = $i_min - 59;
		      if(strlen($i_min) == 1){
			  $i_min = '0' . $i_min;
		      }
		      $i_hour = $auc_end_time_array[0] + 1;
		      if(strlen($i_hour) == 1){
			  $i_hour = '0' . $i_hour;
		      }
		      if($i_hour >= 24){
			$i_hour = $_hour - 24;
			$auc_end_time =  $i_hour . ":" . $i_min . ":" . $auc_end_time_array[2];
			$tomorrow = date('m-d-Y',strtotime($auc_end_date . "+1 days"));
			$auc_end_date = $tomorrow;
		      }else{
			$auc_end_time = $i_hour . ":" . $i_min . ":" . $auc_end_time_array[2];
		      
		      }
		  }
	   if(empty($newendminute)){
		  
		  $newendminute = $aucendminutes + $_REQUEST['replicate_delay'];
	      }else{
		  
		  $newendminute = $newendminute + $_REQUEST['replicate_delay'];
	      }
	      $auc_due_time = getHours($aucstartdate, $aucenddate, $aucstarthour, $aucendhour, $aucstartmin, $newendminute , $aucstartsec, $aucendsec);
	    }
	    $qryins = "Insert into auction
	    (categoryID,productID,auc_start_price,auc_fixed_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,fixedpriceauction,pennyauction,nailbiterauction,
	    offauction,nightauction,openauction,time_duration,auc_recurr,total_time,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,use_free,allowbuynow,buynowprice,uniqueauction,
	    reverseauction,halfbackauction,tax1,tax2,relist,seatauction,minseats,maxseats,seatbids,lockauction,locktype,locktime,lockprice,bidpack, cashauction, reserve, beginner_auction, bids_to_take, silentauction, escroe, escroe_bids, escroe_bids_min)";
	    $qryins
	    .= "values('$categoryID','$productID',$auc_start_price,$auc_fixed_price,'','$auc_start_date','$auc_end_date','$auc_start_time','$auc_end_time','$auc_status',";
	    $qryins .= "'$auc_type','$fpa','$pa','$nba','$off','$na' , '$oa','$duration','$auc_recu','$auc_due_time','$shippingmethod','$futuretstamp',";
	    $qryins .= "'$productQty','$minimumaucprice','$minwinprice','$useonlyfree','$allowbuynow','$buynowprice','$uniqueauction','$reverseauction','$halfback',";
	    $qryins .= "'$tax1','$tax2','$relist','$seatauction','$minseats','$maxseats','$seatbids','$lockauction', '$locktype', '$locktime','$lockprice','$bidpack',";
	    $qryins .= "'$cashauction', '$reserve', '$beginner_auction', '$_POST[bids_to_take]', '$silentauction', '$escroe', '$escroe_bids', '$escroe_bids_min')";
	    if($replicate >= 1 & $_REQUEST['replicate_delay'] >= 0 & $debug == true){
	         echo $qryins . "<br />";

	    }
	      db_query($qryins) ;
	      echo db_error();
	      $auctionID = db_insert_id();
	      if ($auc_status == 2) {
		  //add extra 2 second when use timer dealy
		  if (Sitesetting::isEnableTimerDelay() == true) {
		      $auc_due_time+=2;
		  }
		  $qry = "Insert into auc_due_table (auction_id,auc_due_time,auc_due_price) values($auctionID,'$auc_due_time','$auc_start_price')";
		  if($debug == true){
		      echo $qry . '<br />';
		  }
		  //die();

		  db_query($qry) ;
		  //initRunningTable($auctionID);
		  
		  if(!empty($_POST['similar_product_input'])){
		  $similar = '';
		  
		  foreach($_POST['similar_product_input'] as $key => $value){
		      $similar = $similar . "," . $value;
		  }
		$similar = ltrim($similar, ",");
		
		      db_query("insert into similar_products values(null, '$auctionID', '$similar');");
		    
		  
		    }
	      }
	      $i++; 
	    }
     
      }