<?php

$MainLinksArray = array(
    array("View Reports", "#", 1),
    array('Quick Order View','#',1),
);

/* element 3, dashboard class, 4. horizontal  submenu class */
//****************************************************************?
//****************************************************************?
$ChildLinksArray = array(
    //array("Product Viewed","productsviewedreport.php",0),
    array("Productwise Report", "productwisereport.php", 0, 'reports1', 'sm1'),
    array("Auctionwise Report", "auctionwisereport.php", 0, 'reports2', 'sm1'),
    array("Financial Report", "finincialreport.php", 0, 'reports3', 'sm1'),
    array("Affiliate Report", "affiliatereport.php", 0, 'reports4', 'sm1'),
    array("Registration Report", "registrationreport.php", 0, 'reports5', 'sm1'),
    array("Referral Report", "reverse_registrationreport.php", 0, 'reports5a', 'sm1'),
    array("Login/Logout Report", "perhourreport.php", 0, 'reports6', 'sm1'),
    array("Won Auction Order","order_wonauction.php",1,'reports7','sm1'),
    array("But it Now Order","order_buyitnow.php",1,'reports8','sm1'),
     array ("Profit and Loss Reporting", "pandl.php", 1,'database5','sm1'),
);

foreach($addons as $key => $value){

    if(file_exists("../include/addons/$value/$value" . "_pages/$value" . "_reports.php")){
     array_push($ChildLinksArray, array(ucfirst($value) . " Reports", "get_addon.php?selected=Report&addon=" . $value ."/$value" . "_pages/$value" . "_reports" , 0, $value, 'sm1'));
     
    }
     
}
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