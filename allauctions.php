<?php
include("config/connect.php");
include("functions.php");
include_once 'common/seosupport.php';
$uid = $_SESSION["userid"];

$searchdata = "";
if (isset($_POST["searchtext"]) && $_POST["searchtext"] != "")
    $searchdata = $_POST["searchtext"];
if (isset($_GET["st"]) && $_GET["st"] != "")
    $searchdata = $_GET["st"];
    
    
   
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
      <?php include("page_headers.php"); ?>
    </head>

 
    <body onload="OnloadPage();" class="single">
      
          <?php
	      foreach($addons as $key => $value){

		if(file_exists("include/addons/$value/$template/top_bar.php")){
		
		    include("include/addons/$value/$template/top_bar.php");
		}else
		if(file_exists("include/addons/$value/top_bar.php")){
		

		    include_once("include/addons/$value/top_bar.php");

		}


	      }
	      
	      if(file_exists($BASE_DIR . "/include/$template/" . basename($_SERVER['PHP_SELF']))){
		include($BASE_DIR . "/include/$template/" . basename($_SERVER['PHP_SELF']));
		}else{
		
		include($BASE_DIR . "/include/" . basename($_SERVER['PHP_SELF']));
		
		}
	  ?>
    </body>
</html>