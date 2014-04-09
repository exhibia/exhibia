<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$MainLinksArray = array(
    array("Payment Setting", "#", 1),
    array("Order", "#", 1),
    array("Taxes", "#", 1)
);


/* element 3, dashboard class, 4. horizontal  submenu class */
$ChildLinksArray = array(
    array("Payment Setting", "paypalsetting.php", 0, 'payment1', 'sm1'),
    array("Pending Orders", "peddingorder.php", 1, 'payment2', 'sm1'),
    array("Paid Orders", "paidorders.php", 1, 'payment2', 'sm1'),
    array("Sold Auctions", "soldauction.php", 1, 'store3', 'sm1'),
    array("Manage Buy Now", "managebuynow.php", 1, 'store5', 'sm1'),
    array("Sold Redemptions", "soldredemptions.php", 1, 'store5', 'sm1'),
    array("Sold Bid Packs", "soldbidpacks.php", 1, 'store5', 'sm1'),
);

 array_push($ChildLinksArray, array("Manage Taxes","managetax.php",2,'database15','sm1'));
 
 
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
