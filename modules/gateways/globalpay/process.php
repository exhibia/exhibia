<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title><?= $AllPageTitle; ?></title>
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript">
            function frmnew()
            {
                document._xclick.submit();
            }
        </script>
    </head>

    <body onload="frmnew();">
<?php
$user = db_fetch_object(db_query("select * from registration where id = '$_SESSION[userid]'"));
//print_r($user);
?>

        <?php
        $paygateway = new PayGateway(null);
        $paypalInfo = $paygateway->getGlobalPay();
        $businessid = $paypalInfo->getBusinessId(); //getPaypalInfo(1);
        ?>
        <?php
        if ($paypalInfo->isTestMode() == true) {
            $actionUrl = "https://demo.globalpay.com.ng/globalpay_demo/paymentgatewaycapture.aspx";
        } else {
            $actionUrl = "https://www.globalpay.com.ng/Paymentgatewaycapture.aspx";
        }
     
        ?>

	  <form name="_xclick" action="<?php echo $actionUrl; ?>" method="post">

            <input type="hidden" name="cmd" value="_xclick" />
            <input type="hidden" name="merchantid" value="<?php echo $businessid; ?>"/>
	    <input type="hidden" name="names" value="<?php echo $user->firstname . ' ' . $user->lastname; ?>"/>
	    <input type="hidden" name="email_address" value="<?php echo $user->email; ?>"/>
	    <input type="hidden" name="phone_number" value="<?php echo $user->phone; ?>"/>
	    
	    
	    <input type="hidden" name="return" value="<?php echo $SITE_URL; ?>/index.php?description=<?php echo urlencode($itemdescription);?>&amount=<?php echo $amount;?>&trans_id=<?php echo $invoice_id; ?>&module=cart&action=payment_success&payfor=<?php echo $payfor; ?>&itemid=<?php echo $orderid; ?>"/>
	    <input type="hidden" name="notify" value="<?php echo $SITE_URL; ?>/index.php?description=<?php echo urlencode($itemdescription);?>&amount=<?php echo $amount;?>&trans_id=<?php echo $invoice_id; ?>&module=cart&action=payment_success&payfor=<?php echo $payfor; ?>&itemid=<?php echo $orderid; ?>"/>
	    
	    
            <input type="hidden" name="notify_url" value="<?php echo $SITE_URL; ?>modules/gateways/paypal/payment_globalpayl_notify.php"/>
            <input type="hidden" name="return_url" value="<?php echo $SITE_URL; ?>/index.php?description=<?php echo urlencode($itemdescription);?>&amount=<?php echo $amount;?>&trans_id=<?php echo $invoice_id; ?>&module=cart&action=payment_success&payfor=<?php echo $payfor; ?>&itemid=<?php echo $orderid; ?>"/>
            <input type="hidden" name="cancel_url" value="<?php echo $SITE_URL; ?>/index.php?module=cart&action=payment_unsuccess&payfor=<?php echo $payfor; ?>&itemid=<?php echo $orderid; ?>"/>
            <input type="hidden" name="currency" value="<?php echo $CurrencyName; ?>" />
            <input type="hidden" name="item_name" value="<?php echo $itemdescription; ?>"/>
            <input type="hidden" name="amount" value="<?php echo $amount; ?>"/>
            <input type="hidden" name="merch_txnref" value="<?php echo $orderid; ?>" />
        </form>
    </body>
            <script type="hidden/javascript">
            $(document).ready(function(){
               $( "form:first" ).submit();
            });
        </script>
</html>