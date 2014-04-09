<?php

include("config/connect.php");
include("sendmail.php");
include("functions.php");
include("email.php");
require_once 'data/userhelper.php';
include_once 'data/paygateway.php';
include_once 'common/constvariable.php';

if (isset($_REQUEST['etat'])) {
    if ($_REQUEST['etat'] == 'ok') {
        $USER1 = base64_decode($_REQUEST['divers']);
        $data = explode('|', $USER1);
        $fp = fopen("paysitecash.log", "a");
$str = '';
foreach($_REQUEST as $key => $value){

$str .= $key . " = " . $value . "\n";
}




        $payfor = $data[0];
        $orderid = $data[1];
        $itemid = $data[2];


        $logcontent = "succesful transaction\n date: " . date("Y-m-d h:i:s") . "\n" . $str . "\n" . "payfor=" . $data[0] . "\n". "orderid=" . $data[1] . "\n" . "userid=" . $data[2] . "\n" . $USER1 . '\r\n';
        fwrite($fp, $logcontent);
        fclose($fp);


        $amount=$_REQUEST['montant'];

        $userhelper = new UserHelper(null);
        $userhelper->processOrder($orderid, $amount);



        header('HTTP/1.0 200 OK');
    
    } else {




        $USER1 = base64_decode($_REQUEST['divers']);
        $data = explode('|', $USER1);
        $payfor = $data[0];
        $orderid = $data[1];
        $itemid = $data[2];

$str = '';
foreach($_REQUEST as $key => $value){

$str .= $key . " = " . $value . "\n";
}
        $fp = fopen("paysitecash.log", "a");

       $logcontent = "$_REQUEST[etat] request\n date: " . date("Y-m-d h:i:s") . "\n"  . $str . "{$_REQUEST['RESULT']}\t{$_REQUEST['RESPMSG']}\t{$USER1}\r\n";
        fwrite($fp, $logcontent);
        fclose($fp);




switch($_REQUEST['etat']){


case 'refund':




mail("administrateur@antilles-enchere.com", "Refund Request", "A refund request was initiated for $_REQUEST[email] \n with transactionID $orderid\n ProductId $itemid[2]\n...do with this request what you wish\n a sensible and responsible person would request the item back at the very least before providing a refund");

mail("$email", "We have recieved your refund request and looking it over", "If we find that we erred and you are are do a refund then we will happily provide it.\nIn most cases we will request the return of the merchandise before crediting your Credit Card\n And will be in touch with you in any case to better understand why tou were disappointed\nWe value our clients and do our best to please them.");

        header('HTTP/1.0 200 OK');



break;
case 'wait':
$msg = WAITING_FOR_CONFIRMATION_FROM_PAYSITE;

        header('HTTP/1.0 200 OK');


break;
case 'chargeback':
$msg = RECIEVED_CHARGEBACK_REQUEST;
mail("administrateur@antilles-enchere.com", "Chargeback Request", "A request for a chargeback was initiated for $_REQUEST[email] \n with transactionID $orderid\n ProductId $itemid[2]\n...do with this request what you wish\n a sensible and responsible person would request the item back at the very least before providing a refund");

mail("$email", "We have recieved your request for a chargeback and are looking it over", "If we find that we erred and you are are do a refund then we will happily provide it.\nIn most cases we will request the return of the merchandise before crediting your Credit Card\n And will be in touch with you in any case to better understand why tou were disappointed\nWe value our clients and do our best to please them.");


        header('HTTP/1.0 200 OK');

break;
case 'appeal':
$msg = APPEAL_RECIEVED;
mail("administrateur@antilles-enchere.com", "Appeal Request", "A request for an appeal was initiated for $_REQUEST[email] \n with transactionID $orderid\n ProductId $itemid[2]\n...do with this request what you wish\n a sensible and responsible person would request the item back at the very least before providing a refund");

mail("$email", "We have recieved your request for an appeal and are looking it over", "If we find that we erred and you are are do a refund then we will happily provide it.\nIn most cases we will request the return of the merchandise before crediting your Credit Card\n And will be in touch with you in any case to better understand why tou were disappointed\nWe value our clients and do our best to please them.");


        header('HTTP/1.0 200 OK');

break;


case 'ko':

        header('HTTP/1.0 200 OK');
      

break;



}
    }
}

?>