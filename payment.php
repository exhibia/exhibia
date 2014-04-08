<?php
//5.4 versions of php seem to report strict warnings even when disabled the below supresses them
error_reporting(0);
include("config/connect.php");
include("session.php");
include_once('common/seosupport.php');
include($BASE_DIR . '/common/constvariable.php');
require_once 'data/auction.php';
require_once 'data/auctionpausemanagement.php';
require_once "sendmail.php";
require_once "functions.php";
require_once "email.php";
include_once 'data/paygateway.php';
include_once 'data/paymenthelper.php';
include_once 'data/userhelper.php';
$ignore_input = array('addressline2', 'delivery_addressline2');
db_query("drop index auction_id on payment_order");
if($_POST['payfor'] != PAYFOR_BUYBID){
$errors = '';
  foreach($_POST as $key => $value){
      if($value == '' & !in_array($key, $ignore_input)){
	  if($key != 'delivery_addressline2' & $key != 'addressline2' & $key != 'address2' & $key != 'voucher' & $key != 'coupon' & $key != 'novoucher'){
	      $errors = $errors . "<li>$key can not be empty</li>";
	  }
      }
    }
}
if(!empty($errors)){
header("location: $_SERVER[HTTP_REFERER]&errors=" . urlencode("<ul>" . $errors . "</ul>"));
die();
}
function getMultiDiscount($price, $coupon_array, $DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME){
$db = db_connect($DBSERVER, $USERNAME, $PASSWORD);
if (!$db) {
    die('Could not connect: ' . db_error());
}
db_select_db($DATABASENAME, $db);
  $final_price = $price;
  $sql_disc = db_fetch_object(db_query("select * from sitesetting where name = 'max_discount' limit 1"));
  $max_discount = $price * $sql_disc;
  $max_discount = $final_price - $max_discount;
  foreach($coupon_array as $key => $value){
      $this_coupon = db_fetch_object(db_query("select coupon.id, discount, operand, max_overall from coupon, user_coupon where uniqueid = '$value' and coupon.id = user_coupon.couponid and user_coupon.regid = $_SESSION[userid] limit 1"));
	  if($this_coupon->operand == "$"){
	      $final_price = $final_price - $this_coupon->discount;
	  }else{
	      $final_price = ($final_price * ((100-$this_coupon->discount) / 100));
	  }
	      if($this_coupon->max_overall <= 1){
		  if(!isset($debug)){
		    db_query("delete from coupon where id='" . $this_coupon->id . "'");
		    db_query("delete from user_coupon where couponid='" . $this_coupon->id . "'");
		}
	      }else{
	       if(!isset($debug)){
		  db_query("update coupon set max_overall = '" . $this_coupon->max_overall - 1 . "' where id='" . $this_coupon->id . "'");
	      }
	      
	   }
      }
	return number_format($final_price, 2);
}
if (isset($_POST['payfor'])) {
    if(!empty($_REQUEST['paymentmethod'])){
	$paymentpage = $_REQUEST['paymentmethod'];
    }else{
	$paymentpage = $_REQUEST['paymentpage'];
    }
    $itemid = '';
    $orderid = '';
    $itemname = '';
    $itemdescription = '';
    $amount = 0;
    $payfor = $_POST['payfor'];
    $userid = $_SESSION['userid'];
    if($_POST['payfor'] == PAYFOR_BUYBID) {
        $itemid = base64_decode(chkInput($_REQUEST['bidpackid'], 's'));
        $paymentHelper = new PaymentHelper(null);
        if(!is_array($_REQUEST['couponcode'])){
		$payItem = $paymentHelper->getBuybidPayment($userid, $itemid, chkInput($_POST['couponcode'], 's'), $paymentpage);
	  }else{
	       $payItem = $paymentHelper->getBuybidPayment($userid, $itemid, '', $paymentpage); 
	  }
        if($payItem != FALSE) {
            $orderid = $payItem->orderid;
            $itemname = $payItem->itemname;
          if(!is_array($_REQUEST['couponcode'])){
            $amount = $payItem->amount;
           }else{
           $amount = getMultiDiscount($payItem->amount, $_REQUEST['couponcode'], $DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME);
          }
            $itemdescription = $payItem->itemdescription;
        } else {
            header("location: buybids.php");
            exit;
        }
        
    }else if ($_POST['payfor'] == PAYFOR_WONAUCTION) {
        $winid = base64_decode(chkInput($_REQUEST['winid'], 's'));
        $voucheridinfo = explode(",", chkInput($_REQUEST["voucher"], 's'));
        $voucherid = $voucheridinfo[0];
        $usevoucherid = $voucheridinfo[1];
        $snew = explode("&", $winid);
        $amt = $snew[0];
        $waucid = $snew[1];
        $novoucher = chkInput($_REQUEST['novoucher'], 's');
        $paymentHelper = new PaymentHelper(null);
        $paymentHelper->updateAddress($_SESSION['userid']);
         if(!is_array($_POST['couponcode'])){
	            $payItem = $paymentHelper->getWonAuctionPayment($userid, $waucid, $amt, $voucherid, $usevoucherid, $novoucher, $paymentpage);
	  }else{
	            $payItem = $paymentHelper->getWonAuctionPayment($userid, $waucid, $amt, $voucherid, $usevoucherid, $novoucher, $paymentpage); 
	  }
        if ($payItem != FALSE) {
            $orderid = $payItem->orderid;
            $itemname = $payItem->itemname;
		if(!is_array($_POST['couponcode'])){
		    $amount = $payItem->amount;
		  }else{
		  $amount = getMultiDiscount($payItem->amount, $_REQUEST['couponcode'], $DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME);
		  }
            $itemdescription = $payItem->itemdescription;
        } else {
            header("location: wonauctions.php");
            exit;
        }
    }else if ($_POST['payfor'] == PAYFOR_BUYITNOW) {
        $itemid = base64_decode(chkInput($_REQUEST['auctionId'], 's'));
        $paymentHelper = new PaymentHelper(null);
	$paymentHelper->updateAddress($_SESSION['userid']);
       if(!is_array($_POST['couponcode'])){
	      $payItem = $paymentHelper->getBuyitnowPayment($userid, $itemid, $paymentpage);
	  }else{
	             $payItem = $paymentHelper->getBuyitnowPayment($userid, $itemid, $paymentpage);
	}
        if ($payItem != FALSE) {
            $orderid = $payItem->orderid;
            $itemname = $payItem->itemname;
		if(!is_array($_POST['couponcode'])){
		  $amount = $payItem->amount;
		}else{
		$amount = getMultiDiscount($payItem->amount, $_REQUEST['couponcode'], $DBSERVER, $USERNAME, $PASSWORD, $DATABASENAME);
		}
            $itemdescription = $payItem->itemdescription;
        } else {
            header("location: index.php");
            exit;
        }
    } if ($_POST['payfor'] == PAYFOR_REDEMPTION) {
       $itemid = base64_decode(chkInput($_REQUEST['redemid'], 's'));
        $paymentHelper = new PaymentHelper(null);
        $payItem = $paymentHelper->getRedemptionPayment($userid, $itemid, $paymentpage);
        if ($payItem != FALSE) {
            $orderid = $payItem->orderid;
            $itemname = $payItem->itemname;
            $amount = $payItem->amount;
            $itemdescription = $payItem->itemdescription;
            if ($amount == 0) {
                $userhelper = new UserHelper(null);
                $userhelper->processOrder($orderid, $amount);
                header("location: payment_success.php?payfor=" . PAYFOR_REDEMPTION . "&itemid=$itemid");
                exit;
            }
        } else {
            header("location: redemption.php");
            exit;
        }
    }
	if($amount < 1.00 & ($_POST['paymentmethod'] == 'dalpay' & $_POST['paymentmethod'] == 'dalpaydirect')){
	    $amount = 1.00;
	}
	if(empty($errors)){ 
	    if(!empty($_POST['paymentmethod'])){ 
		    $invoice_id = $orderid;
		    require("$BASE_DIR/modules/gateways/$_POST[paymentmethod]/process.php");
	    }else{
		    $invoice_id = $orderid;
		    require("$BASE_DIR/modules/gateways/$paymentpage/process.php");
	    }
	} else {
	    header("location: $_SERVER[HTTP_REFERER]&errors=" . urlencode("<ul>" . $errors . "</ul>"));  die(); 
	}
    }
