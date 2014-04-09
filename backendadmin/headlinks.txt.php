<?php

$HeadLinksArray = array(
    //it should be not more then 6 or less then 1
    array("Home", "innerhome.php", 0, ""),
    array("Database", "innerdatabase.php", 1, "database.txt.php"),
    array("Auctions", "innerstore.php", 1, "store.txt.php"),
    array("CMS", "innerstatic.php", 1, "static.txt.php"),
    array("Forum", "innerforum.php", 1, "forum.txt.php"),
    array("Report", "innerreport.php", 1, "report.txt.php"),
    array("Users", "innerusers.php", 1, "users.txt.php"),
    array('Email', 'inneremail.php', 1, 'email.txt.php'),
    array('Live Support', '../include/addons/livesupport/admin.php', 1, '','_blank'),
    array('Plugin','innerplugin.php',1,'plugin.txt.php'),
    array('Payment','innerpayment.php',1,'payment.txt.php'),
   
    array("Admin User", "inneraccount.php", 1, "account.txt.php")
);


if(!empty($_SESSION['user_level']) & is_numeric($_SESSION['user_level'])){
    $m = 0;
    foreach($HeadLinksArray as $menu_key =>  $menu_value){
      if(db_num_rows(db_query("select * from user_levels where allowed_pages like '%" . getcwd() . "/" .$HeadLinksArray[$menu_key][1] . "%' and id = '$_SESSION[user_level]'")) == 0){
	
		    unset($HeadLinksArray[$menu_key]);
      }
		  $m++;
    }
}
foreach($addons as $addon){
    if(file_exists($BASE_DIR . "/include/addons/$addon/headlinks.txt.php")){
	include_once($BASE_DIR . "/include/addons/$addon/headlinks.txt.php");
    }
}
?>