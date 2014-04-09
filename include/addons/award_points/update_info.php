<?php
$final_bids = '';
$seat_bids = '';
$bid_points = '';
$free_points = '';

if(!empty($obj['allowbuynow'])){

    if(db_num_rows(db_query("select * from products where productID = '" . $obj['productID'] . "' and credit_back >= '1'")) >=1){
    
	$spent_bids = db_fetch_array(db_query("select sum(bid_count) from bid_account where auction_id = '" . $aucdata->id  . "' and user_id = '" . $_SESSION['userid'] . "'"));
	
	$final_bids = $spent_bids[0];
	  
    
    //Bids Back go here
    }
    if(db_num_rows(db_query("select * from products where productID = '" . $obj['productID'] . "' and bid_points != ''")) >=1){
    //reward point go here
	$bid_points = db_fetch_array(db_query("select bid_points from products where productID = '" . $obj['productID'] . "'"));
	$bid_points = $bid_points[0];
    
    }
    
  if(db_num_rows(db_query("select * from products where productID = '" . $obj['productID'] . "' and free_points != ''")) >=1){
    //reward point go here
 	$free_points = db_fetch_array(db_query("select free_points from products where productID = '" . $obj['productID'] . "'"));
	$free_points = $free_points[0];   
    
    }
    
    
    $aucdata->bids_back = $final_bids + $seat_bids + $bid_points;
    $aucdata->free_points = $free_points;
}





