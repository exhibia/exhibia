
<?php
include('../config/config.inc.php');


if(in_array('slider', $addons)){
$addon = 'slider';
include('../common/sitesetting.php');


if(db_num_rows(db_query("select * from sitesetting where name='slider_settings'")) == 0){

  db_query("insert into sitesetting (id, name, value) values(null, 'slider_settings', 'effect:\'fade\'');");
  db_query("insert into sitesetting (id, name, value) values(null, 'slider_settings', 'color:blue');");
  db_query("insert into sitesetting (id, name, value) values(null, 'slider_settings', 'controls:true');");
  db_query("insert into sitesetting (id, name, value) values(null, 'slider_settings', 'links:true');");
  db_query("insert into sitesetting (id, name, value) values(null, 'slider_settings', 'changeSpeed:1200');");
}
$valid_rows = "select * from nav_conditionals where menu_name = 'addons' and link_name = '$addon'";
			$sql_check =db_fetch_array($valid_rows);
			
	      if(db_num_rows(db_query($valid_rows)) == 0){
		if(file_exists('include/addons/' . $addon . '/'. $template . '/' . 'index.php')){
		
		include('include/addons/' . $addon . '/'. $template . '/' . 'index.php');
		
		}else{
		    include("include/addons/$addon/index.php");
		    
		    }
		}else{
		
		
		if(check_addons_conditionals($sql_check, $addon) >= 1){
		
		if(file_exists('include/addons/' . $addon . '/'. $template . '/' . 'index.php')){
		
		include('include/addons/' . $addon . '/'. $template . '/' . 'index.php');
		
		}else{
		
		  include("include/addons/$addon/index.php");
		  }

	      }
	  }

    }

if(in_array('design_suite', $addons) & $admin >= 1){
		
		    include("include/addons/design_suite/ADDONS/edit_addons.php");
		
		}
?>

