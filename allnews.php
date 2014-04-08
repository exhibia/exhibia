<?php
	include("config/connect.php");
	include("functions.php");
        if(!$_GET['pgno'])
	{
		$PageNo = 1;
	}
	else
	{
		$PageNo = $_GET['pgno'];
	}
	$qrysel = "select * from news order by news_date desc ";
	$rssel = db_query($qrysel);
	$totalnews = db_num_rows($rssel);
	$totalpage=ceil($totalnews/$PRODUCTSPERPAGE);
	if($totalpage>=1)
	{
	$startrow=$PRODUCTSPERPAGE*($PageNo-1);
	$qrysel.=" LIMIT $startrow,$PRODUCTSPERPAGE";
	//echo $sql;
	$rsselnews=db_query($qrysel);
	$totalnews=db_num_rows($rsselnews);
	}
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
	  
	      if(file_exists("include/$template/$_SERVER[PHP_SELF]")){
		include("include/$template/$_SERVER[PHP_SELF]");
		}else{
		
		include("include/$_SERVER[PHP_SELF]");
		
		}
	  ?>
</body>
</html>