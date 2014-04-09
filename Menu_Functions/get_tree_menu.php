<?php

function get_tree_menu($menu_id, $design_m_r, $m_settings, $admin_not, $l, $c, $m, $edit, $show_me, $edit_row, $row_links, $edit_links){
  
	  $edit_links2 = db_query("select * from " . $m_settings['table'][2] . " where " . $m_settings['table']['select'][0] . " = '$row_links[name]'");
			if(db_num_rows($edit_links2) >= 1 | !empty($_SESSION['admin'])){
			  
				get_basic_links($menu_id, $design_m_r, $m_settings, $admin_not, $l, $c, $m, $edit, $show_me, $edit_row, $row_links, $edit_links2);
			    
			    
			    
			}
	
	
	 
	 
	
}


