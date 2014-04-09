<?php



function get_basic_links($menu_id, $design_m_r, $m_settings, $admin_not, $l, $c, $m, $edit, $show_me, $edit_row, $row_links, $edit_links2, $unique){
 if(db_num_rows($edit_links2) >= 1){
 //if(db_num_rows($edit_links2) > 1){
?>
	    <ul>
														
      <?php
      //}
	   
		 while($row_links2 = db_fetch_array($edit_links2)){ //final saub
		   $replaces = explode(':', $row_links2['php_replace_vals']);
			      foreach($replaces as $r => $v){
				if(preg_match('/select/i', $v)){
														
				 $sql_f = db_fetch_array(db_query($v));
														   
				}
			  }
													      
		?>
		 
		<?php
		    
			    $row_links2 = replace_menu_values($row_links2, $edit, $menu_id);
			    
				 menu_link($row_links2, $edit, $menu_id);
				
			
			    if($row_links2['link_text'] == 'Edit Styles' & $menu_id == 'design_menu'){
			    
			    
			    $selector = explode("'", $row_links2['link']);
	
			    
			    $sql = db_query("select distinct selector, type, human_name from style_sheets where template = '$_SESSION[template]' and selector like '$selector[1]%'");
			   
			
			
		      
	
		  }
		  
	     
		 ?>
	    </ul>
										     		  
    <?php
    
	  
      }
	 
}
}
