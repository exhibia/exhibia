<?php
if(empty($menu)){
?>

<?php
$addon = 'top_menu';

$valid_rows = "select * from nav_conditionals where menu_name = 'addons' and link_name = '$addon'";
			$sql_check =db_fetch_array($valid_rows);
			
if(db_num_rows(db_query($valid_rows)) == 0){
?>


<?php

include($BASE_DIR . "/include/addons/topmenu/$template/top_menu.php");

?>

<?php
}else{
if(check_addons_conditionals($sql_check, 'top_menu') >= 1){
?>


<?php

include($BASE_DIR . "/include/addons/topmenu/$template/top_menu.php");


?>


<?php
}
}
}
if(in_array('design_suite', $addons) & $admin >= 1){
		
		    include("include/addons/design_suite/ADDONS/edit_addons.php");
		
		}
?>

