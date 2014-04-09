<?php


    include_once("$BASE_DIR/include/addons/user_levels/class.user_levels.php");
    
    if(basename($_SERVER['PHP_SELF']) != 'getbid.php'){
	$user_level = new Userlevel();
	
	$str .= $user_level->json_result($_SESSION['userid']);

    }else{
	
	$user_level = new Userlevel();
	
	//echo $user_level->json_result($_SESSION['userid']);
    
    }