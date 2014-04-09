<?php


function replace_menu_values($design_m_r, $edit= '', $menu_id){
#########################################################################################
###   Used To Change Array Values Into Constant or Variable by matching BB Style Code ###
###   THIS CAN MOST LIKELY BE USED ELSEWHERE TOO                                      ###
#########################################################################################
    if(empty($edit)){
    
      foreach($design_m_r as $key => $value){
     
	  $match = preg_match_all("#\[\[(.*)]]#i", $value, $matches);
	    foreach($matches[0] as $m => $r){
	  
		//if(constant($matches[1][0]) != $matches[1][0]){
		
		   $design_m_r[$key] = str_replace($matches[0][0], constant($matches[1][0]), $design_m_r[$key]);
		//}
		
				
	    }
      }
    }
    return $design_m_r;
  
}



