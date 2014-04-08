<?php

if(!function_exists('payout_splash')){


	function payout_splash($email, $userid){
	  global $BASE_DIR;
	  require("$BASE_DIR/config/config.inc.php");
		if(db_num_rows(db_query("select * from email_leads where email = '$email'"))>=1){

			$data = db_fetch_array(db_query("select * from email_leads where email = '$email' limit 1"));

			$ba = new Bidaccount();	

					
			$ba->insert($userid, 1, $data['points_to_give'], 'Reward for Pre-registering', $data['type_to_give']);
			db_query("delete from email_leads where email = '$email' limit 1");

		}
	}
}