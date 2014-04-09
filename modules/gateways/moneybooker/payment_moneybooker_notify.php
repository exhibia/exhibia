<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include("config/connect.php");
include("sendmail.php");
include("functions.php");
include("email.php");
require_once 'data/userhelper.php';
include_once 'data/paygateway.php';

$paygateway = new PayGateway(null);
$mbinfo = $paygateway->getMoneyBooker();


if (isset($_POST['transaction_id']) && isset($_POST['status']) && isset($_POST['md5sig'])) {
    //$testfp = @fopen('test.txt', 'a');
    $md5pass = true;
    if ($mbinfo->getSecretword() != '') {
        //fwrite($testfp,"{$_POST['merchant_id']}-{$_POST['transaction_id']}-{$mbinfo->getSecretword()}-{$_POST['mb_amount']}-{$_POST['mb_currency']}-{$_POST['status']}-\r\n");
        //fwrite($testfp,"MD5:{$_POST['md5sig']}");
        $md5_string = $_POST['merchant_id'] . $_POST['transaction_id'] . strtoupper(md5(strtolower($mbinfo->getSecretword()))) . $_POST['mb_amount'] . $_POST['mb_currency'] . $_POST['status'];
        $result_of_md5 = strtoupper(md5($md5_string));
        if ($result_of_md5 == $_POST['md5sig']) {
            $md5pass = true;
        } else {
            $md5pass = false;
        }
    }

    if ($md5pass == true) {


        $amount = $_POST['mb_amount'];
        //fwrite($testfp, 'md5pass' . "\r\n");
        //fclose($testfp);

        switch ($_POST['status']) {
            case '2': {
                    //fwrite($testfp, $root . "\r\n");
                    $orderid = $_POST['orderid'];
                    $userhelper = new UserHelper(null);
                    $userhelper->processOrder($orderid, $amount);
                    break;
                }
            case '0': //pending
                break;
            case '-1': //cancelled
                break;
            case '-2': //Declined
                break;
            case '-3': //chargeback
                break;
        }
    } else {
//        $testfp = @fopen('test.txt', 'a');
//        fwrite($testfp, 'md5 error:' . $result_of_md5 . '\tmd5sig:' . $_POST['md5sig'] . "\r\n");
//        fclose($testfp);
    }

    header('HTTP/1.0 200 OK');
} else {
//    $testfp = @fopen('test.txt', 'a');
//    fwrite($testfp, 'post missing' . "\r\n");
//    fclose($testfp);
}
?>
