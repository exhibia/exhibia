<?php
$paygateway = new PayGateway(null);
$payflowLink = $paygateway->getPayflowLink();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title></title>
        <script type="text/javascript">
            function frmnew()
            {
                document._xclick.submit();
            }
        </script>
    </head>

    <body onload="frmnew();">
        <form method="POST" name="_xclick" action="https://payflowlink.paypal.com">
            <input type="hidden" name="LOGIN" value="<?php echo $payflowLink->getLogin(); ?>"/>
            <input type="hidden" name="PARTNER" value="<?php echo $payflowLink->getParter(); ?>"/>
            <input type="hidden" name="TYPE" value="S"/>
            <input type="hidden" name="AMOUNT" value="<?php echo $amount; ?>"/>
            <input type="hidden" name="NAMETOSHIP" value="<?php echo $itemname; ?>"/>
            <input type="hidden" name="DESCRIPTION" value="<?php echo $itemdescription; ?>"/>
            <input type="hidden" name="USER1" value="<?php echo $orderid; ?>"/>
        </form>
    </body>
</html>