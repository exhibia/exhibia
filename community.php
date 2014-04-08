<?php
include("config/connect.php");

include("session.php");

include("functions.php");

include_once('data/registration.php');
include_once('common/sitesetting.php');
include_once('data/avatar.php');
include_once 'common/seosupport.php';

        
	$changeimage = "community";	

	if(!$_GET['pgno'])
	{
		$PageNo = 1;
	}
	else
	{
		$PageNo = $_GET['pgno'];
	}
	
	
	$StartRow =   $PRODUCTSPERPAGE * ($PageNo-1);
	
	
	$selectCommunity = "select * from community where status='0' order by com_date desc";
	$result =db_query($selectCommunity);
	
	$totalrows=db_num_rows($result);
	$totalpages=ceil($totalrows/$PRODUCTSPERPAGE);
	$selectCommunity .= " LIMIT $StartRow,$PRODUCTSPERPAGE";
	$resultCommunity = db_query($selectCommunity) or die(db_error());
	
	$total = db_num_rows($resultCommunity);
	
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
	      if(file_exists($BASE_DIR . "/include/$template/cms_pages/" . basename($_SERVER['PHP_SELF'])  )  ) {
		include($BASE_DIR . "/include/$template/cms_pages/" . basename($_SERVER['PHP_SELF']));
		}else{
		
		include($BASE_DIR . "/include/cms_pages/" . basename($_SERVER['PHP_SELF']));
		
		}
		


	  ?>
</body>
</html>
