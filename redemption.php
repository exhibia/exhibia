<?php
include("config/connect.php");
include("functions.php");
include_once 'common/seosupport.php';

$changeimage = "redemption";
$uid = $_SESSION["userid"];

$PRODUCTSPERPAGE_REDEEM = 8;

if(!$_GET['pgno']) {
    $PageNo = 1;
}
else {
    $PageNo = $_GET['pgno'];
}

$currentdate = date("Y-m-d");

$qrysel = "select * from redemption red left join products p on red.product_id=p.productID where (red.redem_startdate='".$currentdate."' and red.redem_enddate>='".$currentdate."') or (red.redem_startdate<='".$currentdate."' and red.redem_enddate>='".$currentdate."')";
$ressel = db_query($qrysel);
$totalpro = db_num_rows($ressel);
$totalpage=ceil($totalpro/$PRODUCTSPERPAGE_REDEEM);

if($totalpage>=1) {
    $startrow=$PRODUCTSPERPAGE_REDEEM*($PageNo-1);
    $qrysel .=" LIMIT $startrow,$PRODUCTSPERPAGE_REDEEM";
    $ressel = db_query($qrysel);
    $totalpro=db_num_rows($ressel);
}
?>
<?php
if(empty($dont_show_left)){
$dont_show_left = array();
}
//Uncomment items below to remove them from ALL PAGES for ALL TEMPLATES SO LONG AS THEY ARE 100% USING THE NORMAL FRAMEWORK...IF NOT THEN LETS FIX THAT FIRST
//Skinny column
//$dont_show_left[] = 'testimonials';
//$dont_show_left[] = 'last_winner';
//$dont_show_left[] = 'right_social';
//$dont_show_left[] = 'coupon_menu';
//$dont_show_left[] = 'bidpack_menu';
//$dont_show_left[] = 'user_menu';
//$dont_show_left[] = 'help_menu';
//$dont_show_left[] = 'faq_menu';
//$dont_show_left[] = 'top_menu';
//$dont_show_left[] = 'search_box';
//$dont_show_left[] = 'category_menu';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
      <?php include("page_headers.php"); ?>
    </head>

    <body class="single">
         <?php
         
     
	      if(file_exists("include/$template/user_pages/$_SERVER[PHP_SELF]")){
		include("include/$template/user_pages/$_SERVER[PHP_SELF]");
		
		
		}else{
		if(file_exists("include/$template/product_pages/$_SERVER[PHP_SELF]")){
		
			include("include/$template/product_pages/$_SERVER[PHP_SELF]");
			
		  }else{
			    include("include/user_pages/$_SERVER[PHP_SELF]");
			    
		  }
		
		}
		


	  ?>
        
    </body>
</html>
