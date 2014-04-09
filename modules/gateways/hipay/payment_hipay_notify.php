<?php
include("config/connect.php");
include("sendmail.php");
include("functions.php");
include("email.php");
require_once 'data/userhelper.php';
include_once 'data/paygateway.php';
include_once 'common/constvariable.php';


if (isset($_POST['xml'])) {

	$xml = stripslashes($_POST['xml']);
	$obj = new SimpleXMLElement(trim($xml));
	$status = $obj->result[0]->status;

	if (isset($obj->result[0]->merchantDatas)) {
	                    $d = $obj->result[0]->merchantDatas->children();
	                    foreach($d as $xml2) {
	                        if (preg_match('#^_aKey_#i',$xml2->getName())) {
	                                $indice = substr($xml2->getName(),6);
	                                $xml2 = (array)$xml2;
	                                $valeur = (string)$xml2[0];
	                                $merchantdatas[$indice]=$valeur;
	                        }
	                    }
	}

	if ($status=='ok') {

	$amount=$obj->result[0]->amount;
	$orderid=$merchantdatas['nom2'];

			$userhelper = new UserHelper(null);
	        $userhelper->processOrder($orderid, $amount);

	        header('HTTP/1.0 200 OK');
	}
}
?>