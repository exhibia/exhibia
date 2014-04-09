<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<?php
/* * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
@session_start();
include("config/connect.php");
include("sendmail.php");
include("functions.php");
include("email.php");
require_once 'data/userhelper.php';
include_once 'data/paygateway.php';
include_once 'common/constvariable.php';

if (isset($_REQUEST['_RESULT'])) {
    if ($_REQUEST['_RESULT'] >= 0) {
        $USER1 = base64_decode($_REQUEST['VARIABLE1']);
        $data = explode('|', $USER1);
//        $fp = fopen("mygate.log", "a");
//        $logcontent = $USER1 . '\r\n';
//        fwrite($fp, $logcontent);
//        fclose($fp);

        $payfor = $data[0];
        $orderid = $data[1];
        $itemid = $data[2];

        $userhelper = new UserHelper(null);
        $userhelper->processOrder($customvar, '');

        header('HTTP/1.0 200 OK');
        header("location:payment_success.php?payfor=$payfor&itemid=$itemid");
    } else {
//        $fp = fopen("mygate.log", "a");
//        $USER1 = base64_decode($_REQUEST['USER1']);
//        $logcontent = "{$_REQUEST['RESULT']}\t{$_REQUEST['RESPMSG']}\t{$USER1}\r\n";
//        fwrite($fp, $logcontent);
//        fclose($fp);
        header("location: payment_unsuccess.php");
    }
}