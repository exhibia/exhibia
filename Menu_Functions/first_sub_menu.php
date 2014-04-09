<?php

function first_sub_menu($menu_id, $design_m_r, $m_settings, $admin_not, $l, $c, $m, $edit, $show_me, $edit_row, $m_shown = false){
	$z=$c +1;
	$m_shown = array();
	$unique = uniqid();
	

?>
	<li >
	    <?php 
	   
		 echo $edit_row['name'];
	   
	   
	    $edit_links = db_query("select distinct " . $m_settings['table']['select'][0] . " from " . $m_settings['table'][2] . " where parent = '$edit_row[id]'");
		if(db_num_rows($edit_links) >= 1 | $_SESSION['admin'] >= 1){
			$m = 0;
		    while($row_links = db_fetch_array($edit_links)){ //second sub
		    if(!in_array($m_shown)){
			//$m_shown[] = $row_links['name'];
			
			}
			 $m++;
			    get_tree_menu($menu_id, $design_m_r, $m_settings, $admin_not, $l, $c, $m, $edit, $show_me, $edit_row, $row_links, $edit_links);
			 
			 
		
	      }
	      
					 
	 }
	
// 	 
      ?>
	    
	</li>
<?php
 
}
