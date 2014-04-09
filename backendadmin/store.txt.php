<?php

$MainLinksArray = array(
    array("Auction Management", "#", 0),
    array("Auction Time Management", "#", 1),
    array("Manage Redemption Products", "#", 2),
    array("Credit/Debit Bids Management", "#", 3),
    array("Manage Referral Bonus", "#", 4),
    //array("Manage Vouchers", "#", 1),
   // array('Manage Shipping Type', '#', 1),
);

/* element 3, dashboard class, 4. horizontal  submenu class */

$ChildLinksArray = array(
    array("Add Auction", "addauction.php", 0, 'store1', 'sm1'),
    array("Manage Auction", "manageauction.php", 0, 'store2', 'sm1'),

    array("Unsold Auction", "unsoldauction.php", 0, 'store4', 'sm1'),

    array("Manage Auction Settings", "manageauctiontime.php", 1, 'store6', 'sm1'),
    array("Pause Auction Management", "manageauctionpause.php", 1, 'store7', 'sm1'),
    array("Add Redemption", "addredemption.php", 2, 'store8', 'sm1'),
    array("Manage Redemption", "manageredemption.php", 2, 'store9', 'sm1'),
    array("Referral Commission", "managereferralbid.php", 3, 'store10', 'sm1'),
    array("Add Voucher", "addvoucher.php", 4, 'store11', 'sm1'),
    array("Manage Vouchers", "managevoucher.php", 4, 'store12', 'sm1'),
    array("Issue Voucher", "voucherissue.php", 4, 'store13', 'sm1'),
   //array('Add Shipping Type', 'addshippingtype.php', 5, 'store14', 'sm1'),
   //array('Manage Shipping Type', 'manageshippingtype.php', 5, 'store15', 'sm1'),
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