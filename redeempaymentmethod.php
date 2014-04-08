<?php
include("config/connect.php");
include("session.php");
include("functions.php");
include_once 'data/paygateway.php';
include_once 'common/constvariable.php';

$payGateway = new PayGateway(null);
$gateways = $payGateway->get_em_all(1);

$uid = $_SESSION["userid"];
$changeimage = "myaccount";

if(!empty($_GET['pu'])){

$redid = base64_decode($_GET["pu"]);
}else{
$redid = base64_decode($_GET["redemid"]);
}
$qrysel = "select * from redemption r left join products p on r.product_id=p.productID left join shipping s on r.redem_shipping=s.id where r.id='" . $redid . "'";

$ressel = db_query($qrysel);
$objsel = db_fetch_array($ressel);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php include("page_headers.php"); ?>
        <script type="text/javascript">
        
            function setname(name)
            {
                var temp = document.getElementById('bidpackname'+name).value;
                document.getElementById('bidpackname').innerHTML = temp;
            }


            function check()
            {
                if(document.f2.c_name.value=="")
                {
                    alert("<?php echo PLEASE_ENTER_YOUR_CARD_NAME; ?>");
                    document.f2.c_name.focus();
                    return false;
                }

                if (ccCardNumber(document.f2.c_no.value) == false) {
                    alert("<?php echo CREDIT_CARD_NUMBER_INVALID; ?>")
                    document.f2.c_no.focus();
                    return false;
                }

                if (document.f2.c_cvv_no.value.length < 3) {
                    alert("<?php echo YOUR_CREDIT_CARD_CCV_INVALID; ?>");
                    document.f2.c_cvv_no.focus();
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

            $(document).ready(function(){

                $("#checkoutform").submit(function(){

                    if(ccCardNumber($("#creditCardNumber").val())==false){
                        alert("<?php echo CREDIT_CARD_NUMBER_INVALID; ?>");
                        $("#creditCardNumber").focus();
                        return false;
                    }
                    if($("#cvv2Number").val().length<3){
                        alert("<?php echo YOUR_CREDIT_CARD_CCV_INVALID; ?>");
                        $("#cvv2Number").focus();
                        return false;
                    }
                    return true;
                });
            });



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
    </body>
</html>
