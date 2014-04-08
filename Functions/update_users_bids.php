<?php

function update_users_bids($uid, $type='sum'){
global $BASE_DIR;
    require("$BASE_DIR/config/config.inc.php");
				$his_bids = db_fetch_array(db_query("select $type(bid_count) from free_account where user_id = $uid and bid_flag = 'c'"));
				$used_bids = db_fetch_array(db_query("select $type(bid_count) from free_account where user_id = $uid and bid_flag = 'd'"));
			
				$bids = str_replace("-", "", $his_bids[0]) - str_replace("-", "", $used_bids[0]);
				if($bids < 0 ){
				$bids = 0;
				}
				$qryupd = "update registration set free_bids='" . $bids . "' where id='$uid'";
				db_query($qryupd) or die(db_error());


				$his_bids = db_fetch_array(db_query("select $type(bid_count) from bid_account where user_id = $uid and bid_flag = 'c'"));
				$used_bids = db_fetch_array(db_query("select $type(bid_count) from bid_account where user_id = $uid and bid_flag = 'd'"));
				$bids = str_replace("-", "", $his_bids[0]) - str_replace("-", "", $used_bids[0]);
				if($bids < 0 ){
				$bids = 0;
				}
				
			
				$qryupd = "update registration set final_bids='" . $bids . "' where id='$uid'";
				db_query($qryupd) or die(db_error());
				
				
}
function get_users_bids($uid){
global $db;
    $bids = db_fetch_array(db_query("select free_bids, final_bids from registration where id = $uid"));
    
    return $bids;

}