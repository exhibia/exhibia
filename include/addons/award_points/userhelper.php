<?php

            @db_query("alter table payment_order add column auction_id int(11) not null");
            @db_query("alter table payment_order_history add column auction_id int(11) not null");
            
            
$sql = "select p.free_points, p.bid_points,p.credit_back,payment_order.userid, p.name, a.productID, p.productID from payment_order  left join registration r on r.id=payment_order.userid left join auction a on a.auctionID=payment_order.auction_id left join products p on p.productID=a.productID where auction_id='$aid'";

    $order_info = db_fetch_array(db_query($sql));
    echo db_error();
    if($_REQUEST['debug'] == 'true'){
	//print_r($order_info);
    
    }
    
    if(!empty($order_info['free_points'])){
   
		$qryupdbid = "Insert into free_account (user_id,bidpack_buy_date,bid_count,bid_flag,recharge_type,credit_description) values('" . $order_info['userid'] . "',NOW(),'" . $order_info['free_points'] . "','c','fr','For buying / Winning $order_info[name]')";
		echo $qryupdbid;
		db_query($qryupdbid);
			    
		  $free_bids_count = db_fetch_array(db_query("select sum(bid_count) from free_account where user_id = '$order_info[userid]'"));
		  $free_bids_count = $free_bids_count[0];
		  
		$qryupdreg = "update registration set free_bids='" . $free_bids_count . "' where id='" . $order_info["userid"] . "'";
                db_query($qryupdreg) or die(db_error());   
    
    }
    if(!empty($order_info['bid_points'])){
            
                  
		  
		            $qryupdbid = "Insert into bid_account (user_id,bidpack_buy_date,bid_count,bid_flag,recharge_type,credit_description) values('" . $order_info['userid'] . "',NOW(),'" . $order_info['bid_points'] . "','c','fr','For buying / Winning $order_info[name]')";
			    db_query($qryupdbid);
			    echo $qryupdbid;
		    $bids_count = db_fetch_array(db_query("select sum(bid_count) from bid_account where user_id = '$order_info[userid]'"));
		    $bids_count = $bids_count[0];
		    
                    $qryupdreg = "update registration set final_bids='" . $bids_count . "' where id='" . $order_info["userid"] . "'";
                    db_query($qryupdreg) or die(db_error());  
    
    
    
    }    
    
    if(!empty($order_info['credit_back']) & empty($this_is_auction)){
    
	  $spent_bids = db_fetch_array(db_query("select sum(bid_count), bidding_type, bid_flag, auction_id from bid_account where auction_id = '$aid' and user_id = '$order_info[userid]'"));
	  
	  $qryupdbid = "Insert into bid_account (user_id,bidpack_buy_date,bid_count,bid_flag,recharge_type,credit_description) values('" . $order_info['userid'] . "',NOW(),'" . $spent_bids[0] . "','c','fr','Credit back For buying / Winning $order_info[name]')";
	  db_query($qryupdbid);
			    
	    	
		  
		    $bids_count = db_fetch_array(db_query("select sum(bid_count) from bid_account where user_id = '$order_info[userid]'"));
		    $bids_count = $bids_count[0];
		    
                    $qryupdreg = "update registration set final_bids='" . $bids_count . "' where id='" . $order_info["userid"] . "'";
                    db_query($qryupdreg) or die(db_error());   
    
    
    }    

    


