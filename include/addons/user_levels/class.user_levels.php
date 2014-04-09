<?php

class Userlevel {


    
    public function get_ranking_list(){
    global $BASE_DIR;
    include_once("$BASE_DIR/config/config.inc.php");
    db_query("delete from user_ranking where userid = 0 or rank_name = '';");
    db_query("alter table user_ranking modify column rank_name text not null");
    db_query("alter table user_ranking modify column userid int(11) not null");
      $user_levels =  array();
	$sql = db_query("select distinct(row_to_match) from user_ranking_rules");
	while($row = db_fetch_array($sql)){
	    
		$sql2 = db_query("select distinct(rank_name), id from user_ranking_rules where row_to_match = '$row[row_to_match]' order by min_amount asc");
		while($row2 = db_fetch_array($sql2)){
		
		    $user_levels[$row['row_to_match']][$row2['id']] = $row2['rank_name'];
		
		    
		
		}
	
	}
	return $user_levels;
	
    }
       public function get_ranking_list_for_user($user_id){
       global $BASE_DIR;
	include_once("$BASE_DIR/config/config.inc.php");
           db_query("delete from user_ranking where userid = 0 or rank_name = '';");
	    db_query("alter table user_ranking modify column rank_name text not null");
	   db_query("alter table user_ranking modify column userid int(11) not null");
    
     
	$sql = db_query("select distinct row_to_match, id from user_ranking_rules");
	while($row = db_fetch_array($sql)){
		$sql2 = db_query("select rank_name from user_ranking where rank_id = '$row[id]' and userid = $user_id");
		while($row2 = db_fetch_array($sql2)){
		
		    $str = $str . $row2['rank_name'] . ",";
		
		    
		
		}
	
	}
	return rtrim($str, ",");
	
    } 
    public function selectById($userid, $bidflag='d', $rechargetype='') {
	global $BASE_DIR;
	include_once("$BASE_DIR/config/config.inc.php");
        $sql = "select * from bid_account where user_id='$userid'";
        if ($bidflag != '') {
            $sql = $sql . " and bid_flag='$bidflag'";
        }
        if ($rechargetype != '') {
            $sql = $sql . " and recharge_type='$rechargetype'";
        }
        return db_query($sql);
    }
    public function getUsedBids($userid){
	global $BASE_DIR;
	include_once("$BASE_DIR/config/config.inc.php");
	$bids = 0;
	$sql = "select sum(bid_count) from bid_account where user_id='$userid' and auction_id != '' and bid_flag = 'd'";
	
	$bids = db_result(db_query($sql), 0);
	
	return $bids;
	echo db_error();
    
    }
    public function getBidsBought($userid){
	global $BASE_DIR;
	include_once("$BASE_DIR/config/config.inc.php");
	$bids = 0;
	$sql = "select sum(bid_count) from bid_account where user_id='$userid' and bidpack_id >0";
	
	$bids = db_fetch_array(db_query($sql));
	return $bids[0];
	echo db_error();
    
    }
    public function getRefered($userid){
	global $BASE_DIR;
	include_once("$BASE_DIR/config/config.inc.php");
	$bids = 0;
	$sql = "select sponser from registration where sponser='$userid' and id != $userid";
	
	$bids = db_num_rows(db_query($sql));
	
	return $bids;
	echo db_error();    
    
    
    }
    public function auctionsWon($userid){
	global $BASE_DIR;
	include_once("$BASE_DIR/config/config.inc.php");
	$bids = 0;
	$sql = "select count(*) from won_auctions2 left join won_auctions w on w.auction_id = won_auctions2.auction_id where w.userid=$userid";
	$bids = db_result(db_query($sql), 0);
	return $bids;
	echo db_error();
    }
    public function getTotalSpent($userid){
	global $BASE_DIR;
	include_once("$BASE_DIR/config/config.inc.php");
	$bids = 0.00;
	$sql = "select distinct itemid, sum(amount) from payment_order_history where userid = $userid";

	$bids = db_fetch_array(db_query($sql));
	echo db_error();
	
	return $bids[1];
    }
   
    public function setUserLevels($userid, $level_data){
	global $BASE_DIR;
	include_once("$BASE_DIR/config/config.inc.php");
	$sql = "select * from bid_account where user_id = $userid and credit_description = 'For reaching user rank of $level_data[rank_name]' or recharge_type = '$level_data[id]'";
	
	if(db_num_rows(db_query($sql)) == 0){
	
	    $sql = "insert into bid_account values(null, '$userid', '', NOW(), $level_data[bids_awarded], '',  '',  'c', '0.00', '', '$level_data[id]', '', '', 'For reaching user rank of " . addslashes($level_data['rank_name']) . "');";
	   
	    db_query($sql);
	   
	
	}
	$sql = "select * from free_account where user_id = $userid and credit_description = 'For reaching user rank of $level_data[rank_name]' or recharge_type = '$level_data[id]'";
	
	if(db_num_rows(db_query($sql)) == 0){
	
	    $sql = "insert into free_account values(null, '$userid', '', NOW(), $level_data[free_bids_awarded], '',  '',  'c', '0.00', '', '$level_data[id]', '', '', 'For reaching user rank of " . addslashes($level_data['rank_name']) . "');"; 
	    db_query($sql);
	
	}
	
	$sql = "insert into user_ranking values(null, '$userid', '" . addslashes($level_data['rank_name']) . "', '$level_data[id]', '$level_data[rank_image]');";
	
	db_query($sql);
	
    
    }
    public function deleteUserRanks($userid){
	global $BASE_DIR;
	include_once("$BASE_DIR/config/config.inc.php");
	$sql = "delete from user_ranking where userid = $userid";
	db_query($sql);
    }
    public function timeAsHighBidder($userid, $auction_id = false, $now = false, $last = false, $time_spent = 0){
	global $BASE_DIR;
	include_once("$BASE_DIR/config/config.inc.php");
      $sql = "select * from bid_account_bidding where user_id = $userid";
     
	  $sql .= " and auction_id = $auction_id";
	  if(!empty($last)){
	      $sql .= " and id > $last";
	    }
	 $max_time_as_high_bidder = db_fetch_object(db_query("select * from user_ranking_rules where row_to_match = 'time_as_high_bidder' order by min_amount desc limit 1"));
	 if($time_spent >= $max_time_as_high_bidder->min_amount){
	  return $time_spent;
	 
	 
	 }else{
	    if(db_num_rows(db_query($sql)) >= 1){
	   
	
	
	    $sql = "select bidpack_buy_date, auction_id, id from bid_account_bidding where bid_account_bidding.user_id=$userid and auction_id = $auction_id";
	    if(!empty($last)){
	      $sql .= " and id > $last"; 
	    }
	    
	      $sql .= " order by id asc limit 1";
	 
	    $qry = db_query($sql);
	    
	    while($row = db_fetch_array($qry)){
	    
		
		
		if(db_num_rows(db_query("select bidpack_buy_date, id from bid_account_bidding where bid_account_bidding.user_id!=$userid and auction_id = $row[1] and id > '$row[2]'")) >=1){
	
	
		      $sql2 = "select bidpack_buy_date, id from bid_account_bidding where bid_account_bidding.user_id!=$userid and auction_id = $row[1] and id > '$row[2]' order by id asc limit 1";
		     
		      
		      $qry2 = db_query($sql2);
		      
		
				while($row2 = db_fetch_array($qry2)){
				
				    
				  
					$time1 = strtotime($row[0]);
					$time2 = strtotime($row2[0]);
					$interval = number_format($time1, 0 , '', '') - number_format($time2, 0 , '', '');

					  $time_diff = number_format($interval, 0, '', '');
					  $time_spent = $time_diff + $time_spent;
					 
				   $time_spent = $time_spent + ((strtotime($row2[0]) - 10) - (strtotime($row[0]) - 10));
				    $sql3 = db_query("select * from bid_account_bidding where auction_id = $row[auction_id] and id > $row2[id] and user_id = $userid order by id asc limit 1");
				    
				    if(db_num_rows($sql3) >0){
				  
				    $time_spent = $this->timeAsHighBidder($userid, $row[1], $now, $row2[1], $time_spent);
					
				    
				    }
				
				}
		  }else{
		  if(in_array($now, $_SESSION['auction_id'])){
		  $_SESSION['auction_id'][] = $now;
		  //echo date("Y-m-d H:i:s");
		    if(db_num_rows(db_query("select * from auction where auc_status = 2 and auctionID = $row[auction_id]")) > 0){
		    $obj = db_query("select `timestamp`, `bidpack_buy_date`, `id` from bid_account_bidding where bid_account_bidding.user_id=$userid and auction_id = $row[auction_id] order by id desc limit 1");
		    
			$lastbid = db_fetch_object($obj);
			if($lastbid->timestamp >= strtotime("2013-01-01 00:00:00")){
			//$time_spent = (time() - strtotime($lastbid[0])) + $time_spent;
			  $time1 = strtotime($now);
			  $time2 = $lastbid->timestamp;
			  $interval = $time1 - $time2;

			     $time_diff =$interval;
					  $time_spent = $time_diff + $time_spent;
			}
			  
			 
		    }
		  }
		  }
	    }
	    echo db_error();
	 
	    
	
	    
	    return $time_spent;
	    
	    
	 }else{
	    return 0;
	 
	 }
    }
    
    }
    public function secondsToTime($inputSeconds) {

    $secondsInAMinute = 60;
    $secondsInAnHour  = 60 * $secondsInAMinute;
    $secondsInADay    = 24 * $secondsInAnHour;

    // extract days
    $days = floor($inputSeconds / $secondsInADay);

    // extract hours
    $hourSeconds = $inputSeconds % $secondsInADay;
    $hours = floor($hourSeconds / $secondsInAnHour);

    // extract minutes
    $minuteSeconds = $hourSeconds % $secondsInAnHour;
    $minutes = floor($minuteSeconds / $secondsInAMinute);

    // extract the remaining seconds
    $remainingSeconds = $minuteSeconds % $secondsInAMinute;
    $seconds = ceil($remainingSeconds);

    // return the final array
    $obj = array(
        'd' => (int) $days,
        'h' => (int) $hours,
        'm' => (int) $minutes,
        's' => (int) $seconds,
    );
    foreach($obj as $key => $value){
    if(strlen($obj[$key]) == 1){
	$obj[$key] = '0' . $obj[$key];
    }
    }
    
    return $obj;
}
    public function json_result($userid, $auction_id = false){
	global $BASE_DIR;
	include_once("$BASE_DIR/config/config.inc.php");
    ini_set('date.timezone', 'America/New_York');
    date_default_timezone_set('America/New York');
	$bids_used = $this->getUsedBids($userid);
	
	$bids_bought = $this->getBidsBought($userid);
	
	
	$friends_refered = $this->getRefered($userid);
	$dollars_spent = $this->getTotalSpent($userid);
	$auctions_won = $this->auctionsWon($userid);

	$level_data = array();
	
	$level_data = array("used_bids" => $bids_used, "purchased_bids" => $bids_bought, "friends_refered" => $friends_refered, "auctions_won" => $auctions_won, "dollars_spent" => $dollars_spent, 'level_data_out' => array());
	
	$this->deleteUserRanks($userid);
	
	foreach($level_data as $key => $value){
	    if(!is_array($level_data[$key])){
	    $sql = "select * from user_ranking_rules where min_amount <= " . $value . " and row_to_match = '" . $key . "' order by min_amount desc limit 1";

		$qry = db_query($sql);
	    $i = 0;
		while($row = db_fetch_array($qry)){
		   
			$level_data['level_data_out'][$i] = $row;
			$this->setUserLevels($userid, $row);
		   $i++; 
		}
		
		}
	  
	  }
	   $sql = "select * from user_ranking left join user_ranking_rules r on r.id=user_ranking.rank_id where userid = $userid";
	  $qry = db_query($sql);
	  $i = 0;
	  while($row = db_fetch_array($qry)){
	      $level_data[$i] = $row;
	 
		    $next_sql = db_query("select * from user_ranking_rules where row_to_match = '$row[row_to_match]' and min_amount > '$row[min_amount]' and row_to_match != 'time_as_high_bidder' limit 1");
		    
	   //   if(db_num_rows(db_query("select * from user_ranking_rules where row_to_match = '$row[row_to_match]' and min_amount > '$row[min_amount]'")) >=1){
		
		$level_data[$i]['next'] = db_fetch_array($next_sql);
		if(is_array($level_data[$i]['next'])){  
		switch($row['row_to_match']){
		    case('used_bids'):
		   
			$level_data[$i]['next']['needed'] = number_format($level_data[$i]['next']['min_amount'],0) - number_format($bids_used,0);
		    break;
		    case('purchased_bids'):
			$level_data[$i]['next']['needed'] = number_format($level_data[$i]['next']['min_amount'], 0) - number_format($bids_bought, 0);
		    break;
		    case('dollars_spent'):
			$level_data[$i]['next']['needed'] = number_format($level_data[$i]['next']['min_amount'],2, '.', '') - number_format($dollars_spent,2, '.', '');
		    break;
		    case('friends_refered'):
			$level_data[$i]['next']['needed'] = number_format($level_data[$i]['next']['min_amount'],0) - number_format($friends_refered,0);
		    break;
		    case('auctions_won'):
			$level_data[$i]['next']['needed'] = number_format($level_data[$i]['next']['min_amount'],0) - number_format($auctions_won,0);
		    break;
		    
	      }
	      
	      $level_data[$i]['next']['row_to_match'] = str_replace("_", " ", $level_data[$i]['next']['row_to_match']);
	      $level_data[$i]['next']['rank_name'] = $level_data[$i]['next']['rank_name'];
	      
	      
	      }else{
	      
	     
	      $max = db_fetch_array(db_query("select min_amount, rank_name from user_ranking_rules where row_to_match = '$row[row_to_match]' order by min_amount desc limit 1"));
		
		$level_data[$i]['bids_awarded'] = '';
		$level_data[$i]['free_bids_awarded'] = '';
		$level_data[$i]['next']['free_bids_awarded'] = '';
		$level_data[$i]['next']['bids_awarded'] = '';
		$level_data[$i]['rank_name'] = $max['rank_name'];
		 $level_data[$i]['next']['rank_name'] = $level_data[$i]['rank_name'];
		 $level_data[$i]['maxed_out'] = 'Congratulations you have maxed out!'; 
	      
	      }
	    //}
	      
		    
	  $i++;
	  }
	 

	  
	  
	 require("time_as_high_bidder.php");
	  
	 
	  return $level_data;
    }
  
}
