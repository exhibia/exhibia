<?php

include("config/connect.php");

include("functions.php");


$staticvar = "about";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

    <head>

        <?php include('page_headers.php'); ?>

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
	       $page = 'aboutus.php';
	      if(file_exists("include/$template/cms_pages/introduction.php")){
	  
		include("include/$template/cms_pages/introduction.php");
		}else{
		
		include("include/cms_pages/introduction.php");
		
		}
	  ?>
	
    </body>
</html>