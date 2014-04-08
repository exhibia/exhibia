<?php
include("config/connect.php");
include("session.php");
include("functions.php");

include_once('data/registration.php');
include_once('data/avatar.php');

$changeimage = "myaccount";
$uid = $_SESSION["userid"];
if(!empty($_REQUEST['avatarid'])){
db_query("update registration set avatarid = '$_GET[avatarid]' where id = $_SESSION[userid]");
}

$regdb = new Registration(null);
$avatardb = new Avatar(null);

$regresult = $regdb->selectById($uid);
$regobj = db_fetch_object($regresult);

$myavatarid = $regobj->avatarid;

$avatarresult = $avatardb->selectAll();

//echo db_num_rows($avatarresult);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
      <?php include("page_headers.php"); ?>
      
    </head>

    <body class="single">
      <?php
         
         
	      foreach($addons as $key => $value){

		if(file_exists("include/addons/$value/$template/top_bar.php")){
		
		    include("include/addons/$value/$template/top_bar.php");
		}else
		if(file_exists("include/addons/$value/top_bar.php")){
		

		    include_once("include/addons/$value/top_bar.php");

		}


	      }
	     
	      if(file_exists($BASE_DIR . "/include/$template/user_pages/" . basename($_SERVER['PHP_SELF'])  )  ) {
	     
		include($BASE_DIR . "/include/$template/user_pages/" . basename($_SERVER['PHP_SELF']));
		}else{
		
		include($BASE_DIR . "/include/user_pages/" . basename($_SERVER['PHP_SELF']));
		
		}


	  ?>

        
    </body>
</html>
