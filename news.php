<?php
include("config/connect.php");
include("functions.php");

$newsid = $_GET["nid"];
if($newsid=="") {
    header("location: index.php");
    exit;
}
$qrysel = "select * from news where id='".$newsid."'";
$ressel = db_query($qrysel);
$objsel = db_fetch_array($ressel);
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
	      if(file_exists("include/$template/cms_pages/$_SERVER[PHP_SELF]")){
		include("include/$template/cms_pages/$_SERVER[PHP_SELF]");
		}else{
		
		include("include/cms_pages/$_SERVER[PHP_SELF]");
		
		}
		


	  ?>
        
    </body>
</html>