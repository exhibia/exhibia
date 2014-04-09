<?php

/* * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include("config/connect.php");
include("sendmail.php");
include("functions.php");
include("email.php");
include_once 'common/constvariable.php';
require_once 'data/userhelper.php';

if (isset($_REQUEST['RESULT'])) {
    if ($_REQUEST['RESULT'] == '0') {
        $USER1 = $_REQUEST['USER1'];
        $amount=$_REQUEST['AMOUNT'];
        $orderid = $USER1;
        $fp = fopen("payflowlink.log", "a");
        $logcontent = $USER1 . '\r\n';
        fwrite($fp, $logcontent);
        fclose($fp);
        $userhelper = new UserHelper(null);
        $userhelper->processOrder($orderid, $amount);

        header('HTTP/1.0 200 OK');
    } else {
        $fp = fopen("payflowlink.log", "a");
        $USER1 = base64_decode($_REQUEST['USER1']);
        $logcontent = "{$_REQUEST['RESULT']}\t{$_REQUEST['RESPMSG']}\t{$USER1}\r\n";
        fwrite($fp, $logcontent);
        fclose($fp);
    }
}
?>