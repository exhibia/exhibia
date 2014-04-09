<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$MainLinksArray = array(
    array("General", "#", 1),
    array("Inviter", "#", 1),    
);


/* element 3, dashboard class, 4. horizontal  submenu class */
$ChildLinksArray = array(
    array("General Setting", "plugingeneral.php", 0, 'plugin1', 'sm1'),
    array("Online Users", "onlineuser.php", 0, 'plugin2', 'sm1'),
    array("Ban IP", "banipaddress.php", 0, 'plugin3', 'sm1'),
    array("Live Support", "$SITE_URL/include/addons/livesupport/admin.php", 0, 'plugin4', 'sm1','_blank'),
   // array("Inviter Setting", "invitersetting.php", 1, 'plugin5', 'sm1'),
    array("Email", "get_addon.php?addon=emailer", 1, 'plugin5', 'sm1'),
    array("Comet Chat", "get_addon.php?addon=cometchat&selected=Plugin", 1, 'plugin5', 'sm1'),
);
if(!empty($_SESSION['user_level']) & is_numeric($_SESSION['user_level'])){
$m = 0;
foreach($ChildLinksArray as $menu_key =>  $menu_value){

    
   
    
	   if(db_num_rows(db_query("select * from user_levels where allowed_pages like '%" . getcwd() . "/" .$ChildLinksArray[$menu_key][1] . "%' and id = '$_SESSION[user_level]'")) == 0){
    
		
    
	    $ChildLinksArray[$m] =  array($ChildLinksArray[$menu_key][0], "#", $ChildLinksArray[$menu_key][2], 'unauthorised', $ChildLinksArray[$menu_key][4]);
    
    }


$m++;


}

}
?>
