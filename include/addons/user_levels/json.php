<?php

if(!empty($_SESSION['userid'])){

    include_once("$BASE_DIR/include/addons/user_levels/class.user_levels.php");
    

    if($_SESSION['lasttime'] < time()){
    $_SESSION['lasttime'] = time();
     $user_level = new Userlevel();
    
     $level_str = $user_level->json_result($_SESSION['userid']);
   
   
   //foreach($level_str as $key => $value){
   
     $aucdata->user_levels = $level_str;
   
    
     
   //}
   
   }
}
   ?>
 
