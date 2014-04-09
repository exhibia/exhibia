<?php
if(in_array('advertising', $addons)){
  if(in_array('advertising_main', $addons)){
  $addon = 'advertising_main';
  $valid_rows = "select * from nav_conditionals where menu_name = 'addons' and link_name = '$addon'";
			$sql_check =db_fetch_array($valid_rows);
			
	      if(db_num_rows(db_query($valid_rows)) == 0){

		    include("include/addons/$addon/index.php");
		}else{
		
		
		if(check_addons_conditionals($sql_check, $addon) >= 1){
		
		
		
		  include("include/addons/$addon/index.php");

	      }
	  }

    }
 }
if(in_array('design_suite', $addons) & $admin >= 1){
		$addon = 'advertising_main';
		    include("include/addons/design_suite/ADDONS/edit_addons.php");
		
		}
?>
