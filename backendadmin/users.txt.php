<?php

$MainLinksArray = array(
    // (item name, link, haschild)
    array("Manage Users", "#", 1),
    array("Auto Bidder", "#", 1),
    array("Avatar Manage", "#", 1),
    array("Credit/Debit Bids Management", "#", 1),
    array("Coupons", "#", 1),
);
/* element 3, dashboard class, 4. horizontal  submenu class */
$ChildLinksArray = array(
    array("Manage Users", "manage_members.php", 0, 'users1', 'sm1'),
    array("Add Users", "addmembers.php", 0, 'users2', 'sm1'),
    
    
    
    
    
    array("IP Address History","ipaddresshistory.php",0,'users3','sm1'),
    array("Manage Admin User Levels","edit_user_levels.php",0,'users4','sm1'),
   
    array("Manage Bidding Users", "managebiddinguser.php", 1, 'users4', 'sm1'),
    array("Create Admin AutoBidder", "addbiddinguser.php", 1, 'users5', 'sm1'),
    
    array("Manage Admin AutoBidder", "manageautobidder.php", 1, 'users6', 'sm1'),
    array("Add Admin AutoBidder", "addautobidder.php", 1, 'users7', 'sm1'),
    
    array("Manage User Avatars", "manageavatar.php", 2, 'users8', 'sm1'),

    //array("Manage Prize Table",'manageprizetable.php',3,'users','sm1'),

    array("Credit/Debit Bids", "addbonusbid.php", 3, 'users9', 'sm1'),
    array("Credit/Debit Bids Report", "admincreditreport.php", 3, 'users10', 'sm1'),
    array("Add / Delete / Edit Coupon","managecoupon.php",4,'database14','sm1'),
    array("List Universal Coupon","listuniversalcoupon.php",4,'database16','sm1')

   // array("Auto Credits", "autocredits.php", 3, 'users11', 'sm1'),
);

foreach($addons as $key => $value){

    if(file_exists("../include/addons/$value/add" . "$value.php")){
     array_push($ChildLinksArray, array("Add " . ucfirst($value), "get_addon.php?selected=Users&addon=" . $value , 0, $value, 'sm1'));
     
    }
     
}
$m = 0;
if(!empty($_SESSION['user_level']) & $_SESSION['username'] != 'admin'  & is_numeric($_SESSION['user_level'])){

foreach($ChildLinksArray as $menu_key =>  $menu_value){

    
   
    
	   if(db_num_rows(db_query("select * from user_levels where allowed_pages like '%" . getcwd() . "/" .$ChildLinksArray[$menu_key][1] . "%' and id = '$_SESSION[user_level]'")) == 0){
    
		
    
	    $ChildLinksArray[$m] =  array($ChildLinksArray[$menu_key][0], "#", $ChildLinksArray[$menu_key][2], 'unauthorised', $ChildLinksArray[$menu_key][4]);
    
    }


$m++;


}

}

if(in_array('user_levels', $addons)){

array_push($ChildLinksArray, array("User Badge Settings", "editchangerank.php", 0, 'users2', 'sm1'));
$m++;

}
?>