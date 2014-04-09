<?php
require_once("../../../../config/config.inc.php");
db_connect($DBSERVER, $USERNAME, $PASSWORD);
db_select_db($DATABASENAME);



if(!empty($_REQUEST['position'])){


    $sortables = json_decode($_REQUEST['sortables']);
    $menu = str_replace("_ul", "", $_REQUEST['position']);
    if(empty($_REQUEST['is_page'])){
	
	//$sortables = array_reverse($sortables);
    }
    $a = 1;
      foreach($sortables as $key => $value){
	      $menu_index = $key;
	    
	      if(!empty($value)){
		//  if(empty($_REQUEST['is_page'])){
		      $name = str_replace("sortable-", "", $value);
		    if(db_query("update page_areas set  menu = '$menu', menu_index = '$menu_index' where name = '$name' and page='$_REQUEST[page]'")){
		      
			echo "Updated order for $name in $menu for " . basename($_REQUEST['page']) . "<br />";
		    
		    }else{
		    echo db_error();
		    }
	    
		
	  
	  /*   }else{
	      $name = str_replace("sortable-", "", $value);
	      $a++; 
	      db_query("delete from page_areas where page = '$_REQUEST[page]' and is_page = '1' and menu = '$menu' and name = '$name'");
	      db_query("insert into page_areas ( id, name, description, menu, menu_index, invisible, page, is_page) values(null, '$name', '', '$menu', '$key', '1', '$_REQUEST[page]', 1);");   
	   // echo "Updated order for $name in $menu for " . basename($_REQUEST['page']) . "<br />";
	    echo db_error();
	}*/
      }
    }
}
