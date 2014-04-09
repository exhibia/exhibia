<?php

$MainLinksArray = array(
    array("Admin Setting", "#", 1),
    array("Free Points Setting", "#", 1),
    array("Manage Minimum Bid Price", "#", 1),
    array("Advertise Manage", "#", 1),
    array("Manage Upgrades", "#", 1),
);


/* element 3, dashboard class, 4. horizontal  submenu class */
$ChildLinksArray = array(
    array("Admin Password", "editaccount.php", 0, 'account1', 'sm1'),
    array("Site Setting", "sitesetting.php", 0, 'account2', 'sm1'),
    array("Configuration", "configuration.php", 0, 'tools', 'sm1'),
    array("Language Setting", "languagesetting.php", 0, 'account3', 'sm1'),
    
    array("Login Free Points", "loginfreepoints.php", 1, 'account4', 'sm1'),
    array("Rating Free Points", "ratingfreepoints.php", 1, 'account5', 'sm1'),
    array("Welcome Bid Points", "regfreepoints.php", 1, 'account6', 'sm1'),


    array("Manage Advertise Position", "manageadvertposition.php", 3, 'account8', 'sm1'),
    array("Manage Advertise Group", "manageadvertgroup.php", 3, 'account9', 'sm1'),
    array("Add Advertise Group", "addadvertgroup.php", 3, 'account10', 'sm1'),
    array("Manage Minimum Bid Price", "generalsetting.php", 2, 'd2', 'sm1'),
    array("Install / Enable Upgrade", "upgrades.php", 4, 'upgrades', 'sm1'),
);

if(!empty($_SESSION['user_level']) & is_numeric($_SESSION['user_level']) & $_SESSION['username'] != 'admin'){
$m = 0;
foreach($ChildLinksArray as $menu_key =>  $menu_value){

    
   
    
	   if(db_num_rows(db_query("select * from user_levels where allowed_pages like '%" . getcwd() . "/" .$ChildLinksArray[$menu_key][1] . "%' and id = '$_SESSION[user_level]'")) == 0){
    
		
    
	    $ChildLinksArray[$m] =  array($ChildLinksArray[$menu_key][0], "#", $ChildLinksArray[$menu_key][2], 'unauthorised', $ChildLinksArray[$menu_key][4]);
    
    }


$m++;


}

}
?>