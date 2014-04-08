<?php


if(!function_exists('preregister')){


      function preregister($user_array, $points_to_give, $type_of_points){
	global $BASE_DIR;
	require("$BASE_DIR/config/config.inc.php");
	  db_query("insert into email_leads values(null, '" . addslashes($user_array['firstname']) . "', '" . addslashes($user_array['lastname']) . "', '" . addslashes($user_array['email']) . "', '$points_to_give', '$type_of_points');");

	    



      }

}