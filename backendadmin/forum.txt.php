<?php
  $MainLinksArray = array (
	array("Forum Category Mgmt","#",1),
	array("Forum Management","#",1),
 );
  
  
    /*element 3, dashboard class, 4. horizontal  submenu class*/
   $ChildLinksArray = array(
	array("Add Category","addforumcat.php",0,'forums1','sm1'),
	array("Manage Category","manageforumcategory.php",0,'forums2','sm1'),
	array("Add Forums","addforum.php",1,'forums3','sm1'),
	array("Manage Forums","manageforum.php",1,'forums4','sm1'),
	array("Manage Topics","managetopics.php",1,'forums5','sm1'),
	array("Manage Reply","managereply.php",1,'forums6','sm1'),
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