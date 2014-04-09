<?php
include("../../../config/config.inc.php");
include("$BASE_DIR/Functions/update_users_bids.php");
@db_query("CREATE TABLE IF NOT EXISTS `api_credentials` (
  `id` bigint(20) NOT NULL auto_increment,

  `domain` varchar(200) default NULL,
  `remote_server` varchar(200) default null,
  `api_token` varchar(200) default null,
  `time` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;");
if(db_num_rows(db_query("select * from api_credentials where domain = '$domain' and remote_server = '$remote_server'")) == 0){
    db_query("insert into api_credentials values(null, '" . str_replace("www.", "", $_SERVER['SERVER_NAME']) . "', 'pennyauctionsoftdemo.com', '" . md5('pennyauctionsoft.com') . "', NOW());");

}
function api_credentials($remote_server, $token, $BASE_DIR){
  include("$BASE_DIR/config.inc.php");
  $remote_server = 'pennyauctionsoftdemo.com';
  
  if(db_num_rows(db_query("select * from api_credentials where remote_server = '$remote_server' and api_token = '$token'")) >= 1){
  
      return true;
  }else{
      return false;
  }


}




//print_r($_REQUEST);
if(!empty($_REQUEST['api_token']) & api_credentials('pennyauctionsoftdemo.com', $_REQUEST['api_token'], $BASE_DIR) == true){

	$game = $_REQUEST['game'];
	$objreg = db_fetch_array(db_query("select * from registration where username = '$_REQUEST[username]' order by id desc limit 1"));
	$userid = $objreg['id'];


      if($_REQUEST['check'] == 'true'){
 
	    $data = get_users_bids($userid);
	    
	    
	   
	    
	    if($_REQUEST['take_from'] == 'free_bids'){
	    
		if($_REQUEST['take'] > $data['free_bids']){
		  
		  $data['error'] = 'Not Enough Free Bids';
		
		}
	    
	    
	    }else{
	    
		if($_REQUEST['take'] > $data['final_bids']){
		  
		  $data['error'] = 'Not Enough Bids';
		
		}
	    
	    
	    
	    }
      
	  echo json_encode($data);
	  die();     
      
      }else{
      if($_REQUEST['take_bids'] == 'true'){

	  $bids_type = $_REQUEST['take_from'];
	  $bonusbid = $_REQUEST['take'];
	  
	  
		  $reason = "For playing $game => $_REQUEST[gameID]";
		   
		  if ($bids_type == 'final_bids') {
		    if(db_num_rows(db_query("select * from bid_account where credit_description = '$reason' and user_id = '$userid'")) == 0){
		      $final_bids = $objreg["final_bids"];
		      $totalbids = $final_bids + $bonusbid;

		      $qryupd = "update registration set final_bids='" . $totalbids . "' where id='$userid'";
		      db_query($qryupd) or die(db_error());

		      $qryins = "Insert into bid_account (user_id,bidpack_buy_date,bid_count,bid_flag,recharge_type,credit_description) values('$userid',NOW(),'" . $bonusbid . "','d','games','" . $reason . "')";
		      db_query($qryins) or die(db_error());
		    }
		  } else {
		     if(db_num_rows(db_query("select * from free_account where credit_description = '$reason' and user_id = '$userid'")) == 0){
		   
		      $final_bids = $objreg["free_bids"];
		      $totalbids = $final_bids + $bonusbid;

		      $qryupd = "update registration set free_bids='" . $totalbids . "' where id='$userid'";
		      db_query($qryupd) or die(db_error());

		      $qryins = "Insert into free_account (user_id,bidpack_buy_date,bid_count,bid_flag,recharge_type,credit_description) values('$userid',NOW(),'" . $bonusbid . "','d','games','" . $reason . "')";
		      db_query($qryins) or die(db_error());
		      
		    }
		  }

	    update_users_bids($userid);
	  $data = get_users_bids($userid);
	   echo json_encode($data);
	  
	

      }else
      if(!empty($_REQUEST['reward'])){
	      $game = $_REQUEST['game'];
	      
	      $bids_type = $_REQUEST['take_from'];
	      $bonusbid = $_REQUEST['take'];	      
	      
	      
	      
	      	 if ($bids_type == 'final_bids') {
		    if(db_num_rows(db_query("select * from bid_account where credit_description = '$reason' and user_id = '$userid'")) == 0){
		      $final_bids = $objreg["final_bids"];
		      $totalbids = $final_bids - $bonusbid;

		      $qryupd = "update registration set final_bids='" . $totalbids . "' where id='$userid'";
		      db_query($qryupd) or die(db_error());

		      $qryins = "Insert into bid_account (user_id,bidpack_buy_date,bid_count,bid_flag,recharge_type,credit_description) values('$userid',NOW(),'" . $bonusbid . "','d','games','" . $reason . "')";
		      db_query($qryins) or die(db_error());
		    }
		  } else {
		     if(db_num_rows(db_query("select * from free_account where credit_description = '$reason' and user_id = '$userid'")) == 0){
		   
		      $final_bids = $objreg["free_bids"];
		      $totalbids = $final_bids - $bonusbid;

		      $qryupd = "update registration set free_bids='" . $totalbids . "' where id='$userid'";
		      db_query($qryupd) or die(db_error());

		      $qryins = "Insert into free_account (user_id,bidpack_buy_date,bid_count,bid_flag,recharge_type,credit_description) values('$userid',NOW(),'" . $bonusbid . "','d','games','" . $reason . "')";
		      db_query($qryins) or die(db_error());
		      
		    }
		  }
	      $bids_type = $_REQUEST['reward_with'];
	      $bonusbid = $_REQUEST['reward'];
	  
	
		  $reason = "For winning $game => $_REQUEST[gameID]";
		
		  $objreg = db_fetch_array(db_query("select * from registration where username = '$_REQUEST[username]' order by id desc limit 1"));
		  $userid = $objreg['id'];
		 
		 echo db_error();
		  if ($bids_type == 'final_bids') {
		  
		     if(db_num_rows(db_query("select * from bid_account where credit_description = '$reason' and user_id = '$userid'")) == 0){
		   
		      $final_bids = $objreg["final_bids"];
		      $totalbids = $final_bids + $bonusbid;

		      $qryupd = "update registration set final_bids='" . $totalbids . "' where id='" . $userid . "'";
		 
		      db_query($qryupd) or die(db_error());

		      $qryins = "Insert into bid_account (user_id,bidpack_buy_date,bid_count,bid_flag,recharge_type,credit_description) values('$userid',NOW(),'" . $bonusbid . "','c','games','" . $reason . "')";
		   
		      db_query($qryins) or die(db_error());
		    }
		  } else {
		    if(db_num_rows(db_query("select * from free_account where credit_description = '$reason' and user_id = '$userid'")) == 0){
		   
		      $final_bids = $objreg["free_bids"];
		      $totalbids = $final_bids + $bonusbid;

		      $qryupd = "update registration set free_bids='" . $totalbids . "' where id='" . $userid . "'";
		      db_query($qryupd) or die(db_error());

		      $qryins = "Insert into free_account (user_id,bidpack_buy_date,bid_count,bid_flag,recharge_type,credit_description) values('$userid',NOW(),'" . $bonusbid . "','c','games','" . $reason . "')";
		      db_query($qryins) or die(db_error());
		      
		     }
		  }

	  update_users_bids($userid);
	  $data = get_users_bids($userid);
	 
	  echo json_encode($data);

      }
  }

}