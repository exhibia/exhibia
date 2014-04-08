<?
include("config/connect.php");
include("session.php");
include("functions.php");

$uid = $_SESSION["userid"];
$changeimage = "myaccount";
$redid = $_GET["rid"];

if ($redid == "") {
    header("location: redemption.php");
    exit;
}

$qrysel = "select * from redemption re left join products p on re.product_id=p.productID left join shipping s on re.redem_shipping=s.id where re.id='" . $redid . "'";
$ressel = db_query($qrysel);
$obj = db_fetch_array($ressel);
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
        <?php include('page_headers.php'); ?>
        <script language="javascript" type="text/javascript">
            function CheckForPay(commid)
            {
                
                if(commid!="")
                {
                    if(Number(document.getElementById('userfreebids').innerHTML)<Number(document.getElementById('redemptionpoints').innerHTML))
                    {
                        showAlertBox("<?php echo YOU_DO_NOT_HAVE_SUFFICIENT_POINTS_IN_YOUR_ACCOUNT_TO_REDEEM_THIS_PRODUCT; ?>");
                        return false;
                    }
                    else
                    {
                        window.location.href = 'redeempaymentmethod.php?pu=' + commid
                    }
                }
            }
        </script>
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
	      if(file_exists("include/$template/product_pages/$_SERVER[PHP_SELF]")){
		include("include/$template/product_pages/$_SERVER[PHP_SELF]");
		}else{
		
		include("include/product_pages/$_SERVER[PHP_SELF]");
		
		}
		


	  ?>
	  
	       <span id="userfreebids" style="display: none;"><?= GetUserFreeBids($_SESSION["userid"]); ?></span>
    </body>
</html>
