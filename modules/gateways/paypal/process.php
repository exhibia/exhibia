<?php include("../../../config/config.inc.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title><?= $AllPageTitle; ?></title>
        <?php include("$BASE_DIR/page_headers.php"); ?>
        <script type="text/javascript">
            function frmnew()
            {
                document._xclick.submit();
            }
        </script>
    </head>

    <body onload="frmnew();" style="text-align:center;">
    <img src="<?php echo $SITE_URL;?>img/exhibia_logo.png" />
        <?php
        $paygateway = new PayGateway(null);
        $paypalInfo = $paygateway->getPaypal();
        $businessid = $paypalInfo->getBusinessId(); //getPaypalInfo(1);
        ?>
        <?php
        if ($paypalInfo->isTestMode() == true) {
            $actionUrl = "https://www.sandbox.paypal.com/cgi-bin/webscr";
        } else {
            $actionUrl = "https://www.paypal.com/us/cgi-bin/webscr";
        }
        ?>
	<h2>Redirecting you to Paypal shortly</h2>
        <form name="_xclick" id="payment_form" action="<?php echo $actionUrl; ?>" method="post">

            <input type="hidden" name="cmd" value="_xclick" />
            <input type="hidden" name="business" value="<?php echo $businessid; ?>"/>
            <input type="hidden" name="notify_url" value="<?php echo $SITE_URL; ?>modules/gateways/paypal/payment_paypal_notify.php?custom=<?php echo $orederid;?>"/>
            <input type="hidden" name="return" value="<?php echo $SITE_URL; ?>/index.php?module=cart&action=payment_success&payfor=<?php echo $payfor; ?>&itemid=<?php echo $_SESSION['sess_id']; ?>"/>
            <input type="hidden" name="cancel_return" value="<?php echo $SITE_URL; ?>/index.php?module=cart&action=payment_unsuccess&payfor=<?php echo $payfor; ?>&itemid=<?php echo $_SESSION['sess_id']; ?>"/>
            <input type="hidden" name="currency_code" value="<?php echo $CurrencyName; ?>" />
            <input type="hidden" name="item_name" value="<?php echo $itemdescription; ?>"/>
            <input type="hidden" name="amount" value="<?php echo $amount; ?>"/>
            <input type="hidden" name="custom" value="<?php echo $orderid; ?>" />
            
        </form>
        <h3> Or <a href="javascript:;" onclick="$('#payment_form').submit();">click here</a> if you are not redirected</h3>
    </body>
</html>