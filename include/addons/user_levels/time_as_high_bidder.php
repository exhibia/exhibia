<?php

	    $now = date("Y-m-d H:i:s");
	  
	  
	  
	  $time_as_bidder = 0;

	  $max_time_as_high_bidder = db_fetch_object(db_query("select * from user_ranking_rules where row_to_match = 'time_as_high_bidder' order by min_amount desc limit 1"));
	

	  $bid_info = db_fetch_array(db_query("select sum(bidding_time) from bid_account where user_id = $userid"));
	  
	  $time_as_bidder = $bid_info[0];
	 
	

	  echo db_error();
	  
	      $sql = "select * from user_ranking_rules where min_amount <= '" . $time_as_bidder . "' and row_to_match = 'time_as_high_bidder' order by min_amount desc limit 1";
	    
	      $qry = db_query($sql);
	      
	      $row = db_fetch_array($qry);
	     
	      $high = $row;
	      
	      $this->setUserLevels($userid, $row);
	  $level_data[$i] = $row;
	  
	  
	  
	  $time_as_bidder = number_format($time_as_bidder, 0, '', '');
	
	  
	
	  if($time_as_bidder >= number_format($max_time_as_high_bidder->min_amount, 0, '', '')){
	  $level_data[$i]['maxed_out'] = 'Congratulations you have maxed out!';
	  
	  
	  }else{	      
	      
	     $next_sql = db_query("select * from user_ranking_rules where row_to_match = 'time_as_high_bidder' and min_amount > '" . $time_as_bidder . "' order by min_amount asc limit 1");
	     $rowhb = db_fetch_array($next_sql);
	
	     $temp_spent = $this->secondsToTime($time_as_bidder);
	  
	
	    $level_data[$i]['current_time'] = $now;
	    $level_data[$i]['time_as_high_bidder'] = $time_as_bidder;
	  
	  
	    
	   // $level_data[$i]['time_as_high_bidder'] = $time_as_bidder['d'] . ':' . $time_as_bidder['h'] . ':' . $time_as_bidder['m'] . ':' . $time_as_bidder['s'];
	    $next =  number_format($rowhb['min_amount'],0, '', '') - number_format($time_as_bidder,0, '', '');
	    $next = $this->secondsToTime($next);
	    
	    $level_data[$i]['min_amount'] = $temp_spent['d'] . ':' . $temp_spent['h'] . ':' . $temp_spent['m'] . ':' . $temp_spent['s'];
	    
	    
	    $level_data[$i]['next']['min_amount'] = $next['d'] . ':' . $next['h'] . ':' . $next['m'] . ':' . $next['s'];
	    
	    
	    $level_data[$i]['next']['needed']=  $next['d'] . ':' . $next['h'] . ':' . $next['m'] . ':' . $next['s'];
	    
	    $level_data[$i]['next']['row_to_match'] = str_replace("time", "", str_replace("_", " ", $rowhb['row_to_match']));
	    
	    $level_data[$i]['next']['free_bids_awarded'] = $rowhb['free_bids_awarded'];
	    $level_data[$i]['next']['bids_awarded'] = $rowhb['bids_awarded'];
	    $level_data[$i]['next']['rank_name'] = $rowhb['rank_name'];	  
      }
