<?php
$MainLinksArray = array (
	array ("Static Management", "#", 1),
	array ("Manage Help Topic", "#", 1),
	array ("Manage FAQ", "#", 1),
	array ("Manage News", "#", 1),
    array("Manage Social","#",1),
    array("Community", "#", 1),
    array("Newsletter", "#", 1)
);
  /*element 3, dashboard class, 4. horizontal  submenu class*/
$ChildLinksArray = array (
	array ("Terms &amp; Conditions", "staticpages.php?id=terms", 0,'cms1','sm1'),
	array ("About Us", "staticpages.php?id=aboutus", 0,'cms2','sm1'),
	array ("Contact", "staticpages.php?id=contact", 0,'cms3','sm1'),
	array ("Privacy", "staticpages.php?id=privacy", 0,'cms4','sm1'),
	array ("Jobs", "staticpages.php?id=jobs", 0,'cms5','sm1'),
	array ("Miscellaneous", "staticpages.php?id=miscellaneous", 0,'cms5','sm1'),
	array ("Welcome", "staticpages.php?id=welcome", 0,'cms5','sm1'),
	array ("Minors", "staticpages.php?id=minors", 0,'cms5','sm1'),
	array ("Affiliates", "staticpages.php?id=affiliates", 0,'cms5','sm1'),
	array ("Add Help Topic", "addhelptopic.php", 1,'cms6','sm1'),
	array ("Manage Help Topic", "managehelptopic.php", 1,'cms7','sm1'),
	array ("Add FAQ", "addFAQ.php", 2,'cms8','sm1'),
	array ("Manage FAQ", "manageFAQ.php", 2,'cms9','sm1'),
	array ("Add News", "addnews.php", 3,'cms10','sm1'),
	array ("Manage News", "managenews.php", 3,'cms11','sm1'),
	array("Add Social","addsocial.php",4,'cms12','sm1'),
	array("Manage Social","managesocial.php",4,'cms13','sm1'),
        array ("Add Community", "addcommunity.php", 5,'database12','sm1'),
        array ("Manage Community", "managecommunity.php", 5,'database13','sm1'),
        array ("Add Newsletter", "newsletter.php",6,'database10','sm1'),
        array ("Manage Newsletter", "manageNewsletters.php",6,'database11','sm1'),
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