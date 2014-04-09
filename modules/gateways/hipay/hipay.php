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


        <?php


$xml ="<?xml version='1.0' encoding='utf-8' ?>
<order>
    <userAccountId>1626186</userAccountId>
    <currency>EUR</currency>
    <label>Achat pack antilles enchere</label>
    <ageGroup>ALL</ageGroup>
    <categoryId>618</categoryId>
    <urlAcquital><![CDATA[$SITE_URL/modules/gateways/hipay/payment_hipay_notify.php]]></urlAcquital>
    <urlOk><![CDATA[$SITE_URL/modules/gateways/hipay/payment_success.php?payfor=".$payfor."&itemid=".$itemid."]]></urlOk>
    <urlKo><![CDATA[$SITE_URL/modules/gateways/hipay/payment_unsuccess.php?payfor=".$payfor."&orderid=".$orderid."]]></urlKo>
    <urlCancel><![CDATA[$SITE_URL/modules/gateways/hipay/payment_unsuccess.php?payfor=".$payfor."&orderid=".$orderid."]]></urlCancel>
    <urlInstall><![CDATA[$SITE_URL/install.php]]></urlInstall>
    <urlLogo><![CDATA[$SITE_URL/img/logo.png]]></urlLogo>

    <!-- optional -->
    <locale>fr_FR</locale>

    <data>
        <nom1>".$userobj['username']."</nom1>
        <nom2>".$orderid."</nom2>
        <nom3>".$payfor."</nom3>
    </data>
    <items>
        <item id='1'>
            <name>".$itemdescription."</name>
            <infos>".$itemdescription."</infos>
            <amount>".$amount."</amount>
            <categoryId>618</categoryId>
            <quantity>1</quantity>
            <reference>id pack</reference>
        </item>
    </items>
</order>";
 /*
 * Var $data contain the XML string describing your order
 */
 $data = trim($xml);

// your website Hipay key
$signKey ="096198bffd8b9dd0695a0f7c2704b30a";
$encodedData = base64_encode($data);
$md5Sign = md5($encodedData.$signKey);
// $md5Sign now contains signed datas

?>
<body onload="frmnew();">
<form name='_xclick'  action='https://payment.hipay.com/index/form/' method='post' >
    <input type='hidden' name='mode' value='MODE_B' />
    <input type='hidden' name='website_id' value='20919' />
    <input type='hidden' name='sign' value="<?php echo $md5Sign ?>" />
    <input type='hidden' name='data' value="<?php echo $encodedData ?>" />
</form>


    </body>
</html>