<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include("config/connect.php");
include("sendmail.php");
include("functions.php");
include_once 'common/constvariable.php';
require_once 'data/userhelper.php';
include_once 'data/paygateway.php';

$paygateway = new PayGateway(null);
$pagseguro = $paygateway->getPagseguro();

define('TOKEN', $pagseguro->getToken());

//$logfile=dirname(__FILE__).'/pagseguro.log';
//
//$fp = fopen($logfile, "a");
//$logcontent = TOKEN ." notify\r\n";
//fwrite($fp, $logcontent);
//fclose($fp);

$payfor = '';
$itemid = '';
$orderid = '';
$success = false;

include('lib/pagseguro/retorno.php');

function retorno_automatico($VendedorEmail, $TransacaoID, $Referencia, $TipoFrete, $ValorFrete, $Anotacao, $DataTransacao, $TipoPagamento, $StatusTransacao, $CliNome, $CliEmail, $CliEndereco, $CliNumero, $CliComplemento, $CliBairro, $CliCidade, $CliEstado, $CliCEP, $CliTelefone, $produtos, $NumItens) {
//    global $logfile;
//    $fp = fopen($logfile, "a");
//    $logcontent = $Referencia . ',' . $StatusTransacao .','.$ValorFrete. "\r\n";
//    fwrite($fp, $logcontent);
//    fclose($fp);
    global $payfor, $itemid, $success, $orderid;
    $sql = "select itemid,payfor from payment_order where orderid='$Referencia'";
    $result = db_query($sql);
    $order = db_fetch_array($result);
    $payfor = $order['payfor'];
    $itemid = $order['itemid'];
    $orderid = $Referencia;


    $paygateway = new PayGateway(null);
    $pagseguro = $paygateway->getPagseguro();

    if (in_array($StatusTransacao, array('Completo', 'Aprovado'))) {
        $userhelper = new UserHelper(null);
        $userhelper->processOrder($Referencia, '');
        $success = true;
    } elseif ($StatusTransacao == "Cancelado") {
        $success = false;
    }
}

if ($success) {
    header("location:payment_success.php?payfor=$payfor&itemid=$itemid");
} else {
    header("location:payment_unsuccess.php?payfor=$payfor&orderid=$orderid");
}
?>
