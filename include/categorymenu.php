<?php 

if(in_array('category_menu', $addons) & !isset($cat_menu)){
include_once 'data/auction.php';
$adb=new Auction(null);
$cat_menu = 'true';
$addon = 'category_menu';

$valid_rows = "select * from nav_conditionals where menu_name = 'addons' and link_name = '$addon'";
			$sql_check =db_fetch_array($valid_rows);
			
	      if(db_num_rows(db_query($valid_rows)) == 0){

		    if(file_exists("include/addons/$addon/$template/index.php")){
			include_once("include/addons/$addon/$template/index.php");
		    
		    }else{
			include_once("include/addons/$addon/index.php");
			}
		}else{
		
		
		if(check_addons_conditionals($sql_check, $addon) >= 1){
		
		
		
		  include_once("include/addons/$addon/index.php");

	      }
	  }


} 

if(in_array('design_suite', $addons) & $admin >= 1){
		
		    include_once("include/addons/design_suite/ADDONS/edit_addons.php");
		
		}
?>  