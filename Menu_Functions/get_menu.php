
<?php


function get_menu($menu_id, $edit = null){
ini_set('display_errors', 1);

$m_settings = get_menu_settings($menu_id);




//if(!empty($_COOKIE['design_suite'])){
//$edit = '';
//}


?>
	      <ul <?php if(count($m_settings['menu_class']) >= 1 & !empty($m_settings['menu_class'][0])){ ?> class="<?php foreach($m_settings['menu_class'] as $k => $v){ echo $v . ' '; }?>"<?php } ?>><!-- outer -->
		      <?php
			  $l = 0;
			  $c = 0;
			  
			  $admin_not = "and enabled = '1'";
			 
		    
			   $show_me == 'true';
			  
			      $design_m = db_query("select link, link_text, id, menu_name from navigation where menu_name = '$menu_id' $admin_not order by sort, id asc");
			   
			      while($design_m_r = db_fetch_array($design_m)){
			      
				
			      
			      $valid_rows = "select * from nav_conditionals where menu_name = '$menu_id' and affected_table = 'navigation' and link_name = '$design_m_r[link_text]'";
			     // echo $valid_rows;
			    //  echo $valid_rows;
			      
			      if(db_num_rows(db_query($valid_rows)) == 0){
			      $l++;
			      $c++;
			 
				   $show_me = 'true';
			     
				}else{
			   
					    if(check_menu_conditionals($design_m_r, 'navigation', $design_m_r['id'], $menu_id) >= 1){
					      $l++;
						$c++;
					    //main loop
			      
				      
					      $show_me = 'true';
				  
					    }else{
					
					
					      $show_me = 'false';
				       }
				
			   }
			   
			   if($design_m_r['link_text'] == "[[FORUMS]]" | $design_m_r['link_text'] == "[[COMMUNITY]]" | $design_m_r['link_text'] == "[[REDEMPTION]]"){
			   
				switch($design_m_r['link_text']){
				
				  case('[[FORUMS]]'):
				      if(db_num_rows(db_query("select * from sitesetting where name = 'forum' and value = 1")) >= 1){
					  $show_me = $show_me;
					  
				      
				      }else{
					  $show_me = 'false';
				      
				      }
				  break;
				  case('[[REDEMPTION]]'):
				  if(db_num_rows(db_query("select * from sitesetting where name = 'redemption' and value = 1")) >= 1){
					   $show_me = $show_me;
				      
				      }else{
					  $show_me = 'false';
				      
				      }
				  break;
				  case('[[COMMUNITY]]'):
				  if(db_num_rows(db_query("select * from sitesetting where name = 'community' and value = 1")) >= 1){
					   $show_me = $show_me;
				      
				      }else{
					  $show_me = 'false';
				      
				      }
				  break;
				
				
				}
			      
			   
			   }
		
				$design_m_r = replace_menu_values($design_m_r, '');
							 
				  menu_start($menu_id, $design_m_r, $m_settings, '', $l, $c, $m, '', $show_me);
			      
			      
						  
			      }
			      
			       
			
			?>
		  </ul>
<?php
	bottom_switch($menu_id);
	 
      return $menu;
}
?>

