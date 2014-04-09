<?php
if(in_array('latest_news', $addons)){
$addon = 'latest_news';

$valid_rows = "select * from nav_conditionals where menu_name = 'addons' and link_name = '$addon'";
			$sql_check =db_fetch_array($valid_rows);
			
if(db_num_rows(db_query($valid_rows)) == 0){

	  include("include/addons/latest_news/index.php");

	}else{





    }
}
if(in_array('design_suite', $addons) & $admin >= 1){
		$addon = 'latest_news';
		    include("include/addons/design_suite/ADDONS/edit_addons.php");
		
		}


?>

