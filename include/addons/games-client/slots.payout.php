<?php
ini_set('display_errors', 1);

$_SESSION['userid'] = $_REQUEST['userid'];
include("../../../../config/config.inc.php");
include("$BASE_DIR//include/addons/games-clientconfig.inc.php");
include("config.inc.php");
include("$BASE_DIR/Functions/update_users_bids.php");

$fruits_in = explode(",", $_REQUEST['final']);
$fruits_out = array();

    $count=0;
    foreach ($fruits_in as $key => $value){
	$value = $value - 1;
	
	if(array_key_exists($fruits[$value], $fruits_out)){
	
	  
	  $count = $fruits_out[$fruits[$value]]['count'] + 1;
	  $fruits_out[$fruits[$value]] = array('count' => $count, 'multiplier' => $payouts[$fruits[$value]][$count], 'payout' => $_REQUEST['bids'] * $payouts[$fruits[$value]][$count], 'id' => $value + 1);
	  
	  
	}else{
	
	   
	    $count = 1;
	    $fruits_out[$fruits[$value]] = array('count' => $count, 'multiplier' => $payouts[$fruits[$value]][$count], 'payout' => $_REQUEST['bids'] * $payouts[$fruits[$value]][$count], 'id' => $value + 1 );
	    
	    
	  
	}
	
	
    
    
    }
    
    
	
    $payout = 0;
    $fruits_out['winners_a'] = '';
    
    foreach($fruits_out as $key => $value){
	$payout = $payout + $fruits_out[$key]['payout'];
	if($fruits_out[$key]['payout'] > 0){
	
	  if(empty($fruits_out['winners_a'])){
	    $fruits_out['winners_a'] = $fruits_out[$key]['id'];
	    
	   }else{
	   
	      $fruits_out['winners_a'] = $fruits_out['winners_a'] . ',' . $fruits_out[$key]['id'];
	    
	   
	   }
	}
    }
$fruits_out['winners_a'] = '"' . $fruits_out['winners_a'] . '"';

//Delete the bids used first
		      
//Get Bids and payout table
			  
	  if($payout != 0 ){
		      $payout = $payout;
		      $bids = $payout;
		      $operand = 'add';
		      $flag = 'c';
		      $fruits_out['payout'] = $payout;
		      
		$fruits_out['success'] = true;
	  }else{
		      $bids = $_REQUEST['bids'];
		      $operand = 'subtract';
		      $flag = 'd';
		$fruits_out['success'] = false;
	  }		 
		 
   
$fruits_out['operand'] = $operand;
$fruits_out['flag'] = $flag;
$fruits_out['bids'] = $bids;

$uid = $_GET['userid'];

$obj = db_fetch_object(db_query("select * from registration where id = $uid"));



	if($master_game_settings['give_bids_back_on_win'] == 0 | ($master_game_settings['give_bids_back_on_win'] == 1 & $flag != 'c')){ 

		      $qryins1 = "Insert into $table_selector" . "account_bidding(user_id, bidpack_buy_date, bid_count, recharge_type,username,position,topbidder, `timestamp`) values('$uid','" . date("Y-m-d H:i:s", time()) . "','$_REQUEST[bids]', 'd','{$obj->username}','{$obj->position}', '$uid', " . time() . ")";
		      $result = db_query($qryins1);
		     

		      $qryins = "Insert into $table_selector" . "account (user_id, bidpack_buy_date, bid_count, bid_flag,bidding_type) values('$uid','" . date("Y-m-d H:i:s", time()) . "','$_REQUEST[bids]', 'd', 's')";
		      $result3 = db_query($qryins);

		      $qryupd = "update registration set $table_selector" . "bids=$table_selector" . "bids-" . $_REQUEST['bids'] . " where id=$uid";
		      $result2 = db_query($qryupd);
		      
		}      
		      
		      

	if($payout > 0){
	if($operand == 'add'){	      
		
		    $qryins1 = "Insert into $table_selector_po" . "account_bidding(user_id, bidpack_buy_date, bid_count, recharge_type,username,position,topbidder, `timestamp`) values('$uid','" . date("Y-m-d H:i:s", time()) . "','$bids' 'c','{$obj->username}','{$obj->position}', '$uid', " . time() . ")";
		      $result = db_query($qryins1);
		      

		      $qryins = "Insert into $table_selector_po" . "account (user_id, bidpack_buy_date, bid_count, bid_flag,bidding_type) values('$uid','" . date("Y-m-d H:i:s", time()) . "','$bids', 'c', 's')";
		      $result3 = db_query($qryins);

		$qryupd = "update registration set $table_selector_two_po" . "bids=$table_selector_two_po" . "bids+" . $bids . " where id=$uid";
		$result2 = db_query($qryupd);
	
	}
               
      }		
update_users_bids($uid, 'sum');
$qry = db_query("select final_bids" . " from registration where id = $uid");		      
$fruits_out['final_bids'] = db_result($qry, 0);

$qry = db_query("select free_bids" . " from registration where id = $uid");
$fruits_out['free_bids'] = db_result($qry, 0);



echo json_encode($data = array($fruits_out));
