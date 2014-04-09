<?php
if(in_array('search_box', $addons)){
$addon = 'search_box';

$valid_rows = "select * from nav_conditionals where menu_name = 'addons' and link_name = '$addon'";
			$sql_check =db_fetch_array($valid_rows);
			
if(db_num_rows(db_query($valid_rows)) == 0){
?>
<script type="text/javascript">
function CheckSearch()
{
	if(document.searchform.searchtext.value=="")
		return false;
	else
		return true; 
}
</script>

 <form accept-charset="utf-8" id="searchForm" name="searchform" action="<?php echo $SITE_URL;?>allauctions.php" onsubmit="return CheckSearch();" method="post">       
    <input type="text" name="searchtext" id="keywords" value="<?=htmlspecialchars(stripcslashes($searchdata), ENT_QUOTES);?>"/>
    <button type="submit"><?php echo SEARCH; ?></button>
</form>
<?php

}else{
	    if(check_addons_conditionals($sql_check, $addon) >= 1){
?>
<script type="text/javascript">
function CheckSearch()
{
	if(document.searchform.searchtext.value=="")
		return false;
	else
		return true; 
}
</script>

 <form accept-charset="utf-8" id="searchForm" name="searchform" action="<?php echo $SITE_URL;?>allauctions.php" onsubmit="return CheckSearch();" method="post">       
    <input type="text" name="searchtext" id="keywords" value="<?=htmlspecialchars(stripcslashes($searchdata), ENT_QUOTES);?>"/>
    <button type="submit"><?php echo SEARCH; ?></button>
</form>
<?php






	  }
    }

}
if(in_array('design_suite', $addons) & $admin >= 1){
		
		    include("include/addons/design_suite/ADDONS/edit_addons.php");
		
		}


?> 
