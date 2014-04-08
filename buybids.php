<?php
ini_set('display_errors', 1);
include("config/connect.php");
include("session.php");
include_once("functions.php");

include_once 'data/paygateway.php';
include_once 'common/constvariable.php';


$uid = $_SESSION["userid"];
$changeimage = "buybids";

if ($_POST["paymentmethod"] != "") {
    $paymentmethod = $_POST["paymentmethod"];
    if ($paymentmethod == "paypal") {
        header("location: buybidspayment.php?bpid=" . $_POST["bidpackid"]);
        exit;
    } elseif ($paymentmethod == "creditcard") {
        header("location: checkout.php?bpid=" . $_POST["bidpackid"]);
        exit;
    }
}

$qrysel = "select *," . $lng_prefix . "bidpack_banner as bidpack_banner," . $lng_prefix . "bidpack_name as bidpack_name from bidpack order by id";
$rssel = db_query($qrysel);
$totalbpack = db_num_rows($rssel);
if ($totalbpack > 0) {
    $selected = ceil($totalbpack / 2);
}


$payGateway = new PayGateway(null);
$gateways = $payGateway->get_em_all(1);




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
<script src="js/payment.js"></script>
<style>
	.coupon {
	border:1px dashed black;
	border-radius: 4px;
	padding:10px 10px 10px 10px;
	color:black;
	
	}
	#couponinfo {
	margin-left:-25px;
	}
	</style>
        <script type="text/javascript">
         

            function check()
            {
                if(document.f2.c_name.value=="")
                {
                    showAlertBox("<?php echo PLEASE_ENTER_YOUR_CARD_NAME; ?>");
                    document.f2.c_name.focus();
                    return false;
                }

                if (ccCardNumber(document.f2.creditCardNumber.value) == false) {
                    showAlertBox("<?php echo CREDIT_CARD_NUMBER_INVALID; ?>")
                    document.f2.creditCardNumber.focus();
                    return false;
                }

                if (document.f2.cvv2Number.value.length < 3) {
                    showAlertBox("<?php echo YOUR_CREDIT_CARD_CCV_INVALID; ?>");
                    document.f2.cvv2Number.focus();
                    return false;
                }
            }

            function ccCardNumber(cardNumber) {
                var cardTotal=0;
                var dnum=0;
                var test=0;
                if (cardNumber.length < 13) { return (false); }
                else
                {
                    for ( i = cardNumber.length; i >= 1 ;  i--)	{
                        test=test+1;
                        num = cardNumber.charAt(i-1);
                        if ((test % 2) != 0) cardTotal=cardTotal+parseInt(num)
                        else {
                            dnum=parseInt(num)*2;
                            if (dnum >= 10) cardTotal=cardTotal+1+dnum-10
                            else cardTotal=cardTotal+dnum;
                        }
                    }
                    if ((cardTotal % 10) != 0){ return (false); }else{ return(true); }
                }
            }

	      
            

        </script>
    </head>
 <?php 
                          foreach (array_keys($addons, 'help_menu', true) as $key) {
				  unset($addons[$key]);
			      }

                          foreach (array_keys($addons, 'faq_menu', true) as $key) {
				  unset($addons[$key]);
			      }			      ?>
    <body <?php if ($_POST["buybids"] == "" && $_GET["pkg"] == "") { ?> onload="setname(<?php echo $selected; ?>);"<?php } ?>  class="single">
               <?php
        
         
	      foreach($addons as $key => $value){

		if(file_exists("include/addons/$value/$template/top_bar.php")){
		
		    include("include/addons/$value/$template/top_bar.php");
		}else
		if(file_exists("include/addons/$value/top_bar.php")){
		

		    include_once("include/addons/$value/top_bar.php");

		}


	      }
	      
	      
	      
	      
	      if(file_exists($BASE_DIR . "/include/$template/product_pages/" . basename($_SERVER['PHP_SELF'])  )  ) {
	   
		include($BASE_DIR . "/include/$template/product_pages/" . basename($_SERVER['PHP_SELF']));
		}else{
		
		include($BASE_DIR . "/include/product_pages/" . basename($_SERVER['PHP_SELF']));
		
		}
		


	 ?>
	 
 
    <?php
    if(!empty($_REQUEST['errors'])){
    ?>
    <div id="payment_errors" style="display:none;">
    <?php
    echo $errors;
    ?>
    </div>
    <script>
	$('#payment_errors').dialog({ modal: true });
    </script>
    <?php
    }
    ?>
    
    </body>
   
</html>
