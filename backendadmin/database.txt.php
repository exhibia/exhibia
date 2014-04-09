<?php
$MainLinksArray = array (
        // (item name, link, haschild)
        array ("Product Category Management", "#", 1),
        array ("Products Management", "#", 1),
        /*array ("Manage Users", "#", 1),*/
        array ("Bid Pack Management", "#", 1),
        array ("Shipping Management", "#", 1),
        /*,
        array("Coupon Manage","#",1)*/
);
/*element 3, dashboard class, 4. horizontal  submenu class*/
$ChildLinksArray = array (
        // (subitem name, script name, item's position)
        array ("Add Category", "addcategory.php", 0,'database1','sm1'),
        array ("Manage Category", "managecat.php", 0,'database2','sm1'),
        array ("Add Products", "addproducts.php", 1,'database3','sm1'),
        array ("Manage Products", "manageproducts.php", 1,'database4','sm1'),
        array ("Profit and Loss Reporting", "pandl.php", 1,'database5','sm1'),
    /*
        array ("Manage Users", "manage_members.php", 2,'database','sm1'),
        array ("Add Users", "addmembers.php", 2,'database','sm1'),*/
        array ("Add Bid Pack", "addbidpack.php", 2,'database6','sm1'),
        array ("Manage Bid Pack", "managebidpack.php", 2,'database7','sm1'),
        
        array ("Add Shipping Charge", "addshippingcharge.php", 3,'database8','sm1'),
        array ("Manage Shipping Charge", "manageshippingcharge.php", 3,'database9','sm1'),


       
);
        
        
       
        
        array_push($ChildLinksArray, array("Manage Shipping Type","manageshippingtype.php",3,'database15','sm1'));
        array_push($ChildLinksArray, array("Add Shipping Type","addshippingtype.php",3,'database15','sm1'));
if(!empty($_SESSION['user_level']) & is_numeric($_SESSION['user_level'])){
$m = 0;
foreach($ChildLinksArray as $menu_key =>  $menu_value){

    
   
    
	   if(db_num_rows(db_query("select * from user_levels where allowed_pages like '%" . getcwd() . "/" .$ChildLinksArray[$menu_key][1] . "%' and id = '$_SESSION[user_level]'")) == 0){
    
		
    
	    $ChildLinksArray[$m] =  array($ChildLinksArray[$menu_key][0], "#", $ChildLinksArray[$menu_key][2], 'unauthorised', $ChildLinksArray[$menu_key][4]);
    
    }


$m++;


}

}

foreach($addons as $key => $value){

if(file_exists("$BASE_DIR/include/addons/$value/backendadmin/database.txt.php")){

  include("$BASE_DIR/include/addons/$value/backendadmin/database.txt.php");

}


}
?>