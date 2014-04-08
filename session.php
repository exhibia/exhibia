<?php

        
        if(!empty($_GET['admin_pass'])){
        
	      if(db_num_rows(db_query("select * from admin where pass = '$_GET[admin_pass]'")) == 0){
			header("location: {$SITE_URL}login.php");
			exit;
	      
	      }else{
		 
		  $_SESSION['userid'] = $_REQUEST['uid'];

	      }
        }else{
	    if($_SESSION["userid"]==""){
		    header("location: {$SITE_URL}login.php");
		    exit;
	    }
}

	
?>