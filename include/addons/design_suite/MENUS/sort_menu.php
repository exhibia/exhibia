<?php
require_once("../../../../config/config.inc.php");
db_connect($DBSERVER, $USERNAME, $PASSWORD);
db_select_db($DATABASENAME);



if(!empty($_REQUEST['position'])){


    $sortables = json_decode($_REQUEST['sortables']);
    $menu = $_REQUEST['position'];
    
      foreach($sortables as $key => $value){
	      $menu_index = $key;
	    
	      if(!empty($value)){
	      
		$name = str_replace("sortable-", "", $value);
		if(db_query("update navigation set menu_name = '$_REQUEST[menu_name]', sort = '$menu_index' where name = '$name'")){
		
		  echo "Updated order for $name in $_REQUEST[menu_name] for " . basename($_REQUEST['page']) . "<br />";
	      
	      }else{
	      echo db_error();
	      }
      
	  }
      
}
}
