<?php

/* * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include("config/connect.php");
include("sendmail.php");
include("functions.php");
include_once 'common/constvariable.php';
require_once 'data/userhelper.php';
include_once 'data/paygateway.php';
echo "OK";
$fp = fopen("paymentasia.log", "a");
fwrite($fp, $_REQUEST['successcode'] + '+++' + $_REQUEST['Ref']);
fclose($fp);
if (isset($_REQUEST['successcode'])) {
    $successcode = $_REQUEST['successcode'];
    if ($successcode == '0') {
        $ref = $_REQUEST['Ref'];
        $pos = strpos($ref, '_');
        $orderid = substr($ref, $pos + 1);
        $amount=$_REQUEST['Amt'];
        $userhelper = new UserHelper(null);
        $userhelper->processOrder($orderid, $amount);
        //header('HTTP/1.0 200 OK');
    } else {
        $fp = fopen("paymentasia.log", "a");
        $USER1 = base64_decode($_REQUEST['Ref']);
        $logcontent = "{$_REQUEST['successcode']}\t{$_REQUEST['RESPMSG']}\t{$USER1}\r\n";
        fwrite($fp, $logcontent);
        fclose($fp);
    }
}
?>
