<?php
if(!empty($_SESSION['userid'])){


    if(empty($level_str)){
    $level_str = '';
    }
    
  include_once("$BASE_DIR/include/addons/user_levels/class.user_levels.php");
    
    
   $user_level = new Userlevel();
  
   $level_str = $user_level->json_result($_SESSION['userid']);
    
    
}