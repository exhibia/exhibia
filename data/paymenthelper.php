<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if(!class_exists('DBMysql')){
    if (file_exists('common/dbmysql.php')) {
	require_once 'common/dbmysql.php';
    } else {
	require_once '../common/dbmysql.php';
    }
}
if(!class_exists('Guid')){
    if (file_exists('common/guid.class.php')) {
	include_once 'common/guid.class.php';
    } else {
	include_once '../common/guid.class.php';
    }
}
if(!class_exists('Coupon')){
    require_once 'data/coupon.php';
}

if(!class_exists('UserCoupon')){
    require_once 'data/usercoupon.php';
}
if(!class_exists('Auction')){
    require_once 'data/auction.php';
}
if(!function_exists('SendHtmlMail')){
    include_once 'common/constvariable.php';
    require_once 'data/auctionpausemanagement.php';
    require_once "sendmail.php";
    require_once "functions.php";
    require_once "email.php";
}
/**
 * Description of paymenthelper
 *
 * @author fedora
 */
class taxClass{

    function default_tax($product_data, $location_data){
      if(!empty($location_data)){
	      if(db_num_rows(db_query("select * from taxclass where country = '$location_data[delivery_country]' and enable = '1'")) >= 1){
		    $tax_data = db_fetch_array(db_query("select * from taxclass where country = '$location_data[delivery_country]' limit 1"));
			if($tax_data['enable'] == 1){
			    $tax[1] = $product_data['price'] * ($tax_data['percent'] / 100);
			}else{
			    $tax[1] = '0.00';
			}
		  }else{
		    $tax[1] = '0.00';
	      }
	  }else{
	    $tax[1] = '0.00';
	  }
	    return $tax;    
    }
  
    function us_tax($product_data, $location_data){
    $tax = array();
     if(!empty($location_data)){
	if(strlen($location_data['delivery_state']) == 2){
	    $st = db_fetch_array(db_query("select stname from usstates where stcode = '" . addslashes($location_data['delivery_state']) . "'" ));
	    $location_data['delivery_state'] = $st['stname'];
	}
	      if(db_num_rows(db_query("select * from taxclass where country = '$location_data[delivery_country]' and state = '$location_data[delivery_state]' and enable = '1'")) >= 1){
		    $tax_data = db_fetch_array(db_query("select * from taxclass where country = '$location_data[delivery_country]' and state = '$location_data[delivery_state]' limit 1"));
			if($tax_data['enable'] == 1){
			    $tax[0] = $product_data['price'] * ($tax_data['percent'] / 100);
			    $tax[1] = $product_data['price'] * ($tax_data['percent2'] / 100);
			}else{
			    $tax[0] = '0.00';
			    $tax[1] = '0.00';
			}
		  }else{
		    $tax[0] = '0.00';
		    $tax[1] = '0.00';
	      }
	  }else{
	    $tax[0] = '0.00';
	    $tax[1] = '0.00';
	  }
	    return $tax;
      }

   function getTaxes($product_data, $location_data){
	  switch($location_data['delivery_country']){
	      case('US'):
		  $tax = $this->us_tax($product_data, $location_data);
	      break;
	      case('CA'):
		  $tax = $this->us_tax($product_data, $location_data);
	      break;
	      default;
		  $tax = $this->default_tax($product_data, $location_data);
   
	 }
	 return $tax;
   }
}
class PaymentHelper {
    //put your code here
    private $db;
    //put your code here
    public function __construct($db) {
        if ($db == null) {
            $this->db = new DBMysql();
        } else {
            $this->db = $db;
        }
    }
   function getTax($product_data, $location_data = null){
	 $taxClass = new taxClass();
	 $tax = $taxClass->getTaxes($product_data, $location_data);
	return $tax;    
   }
    function getBuybidPayment($userid, $bidpackid, $couponcode, $paymentway) {
        $item = new PaymentItem();
        $qrysel = "select * from bidpack where id='$bidpackid'";
      
        $ressel = $this->db->executeQuery($qrysel);
        $total = db_num_rows($ressel);

        $freebids = 0;
        $description = '';
        if ($total > 0) {
            $rowauctionname = db_fetch_array($ressel);
            $bidpackname = stripslashes($rowauctionname['bidpack_name']);
            $amt = $rowauctionname['bidpack_price'];
            $freebids = $rowauctionname['freebids'];
            $userCouponid = -1;
            $couponid = -1;
            if ($couponcode != '') {
                $uniqueId = $couponcode;
                $userCoupondb = new UserCoupon($this->db);
                $result = $userCoupondb->selectByUniqueId($userid, $uniqueId);
                if ($result == false || db_num_rows($result) < 1) {
                    return FALSE;
                } else {
                    $userCoupon = db_fetch_object($result);
                    $userCouponid = $userCoupon->id;
                    $couponid = $userCoupon->couponid;
                    $amt = $amt * (1 - $userCoupon->discount / 100);
                    $freebids+=$userCoupon->freebids;
                }
            }
            $description = $bidpackname . " ({$rowauctionname['bid_size']} Bids + {$freebids} Free Bids)";
            $item->amount = $amt;
            $item->itemid = $bidpackid;
            $item->itemname = $bidpackname;
            $item->itemdescription = $description;
            $item->payfor = PAYFOR_BUYBID;
            $item->userid = $userid;
            $item->paymentway = $paymentway;
            $data = new stdClass();
            $data->bidpackid = $bidpackid;
            $data->userCouponid = $userCouponid;
            $data->couponid = $couponid;
            $item->data = $data;
            $this->saveOrder($item);
            include("include/addons/escrow_auctions/payment.php");
            return $item;
        } else {
            return FALSE;
        }
    }
    function getshipping($aid){
    
	  $shipping = 0.00;
	      $sql = $this->db->executeQuery("select shippingcharge from auction left join shipping s on s.id=auction.shipping_id where auctionID = '$aid' ");
	      if(db_num_rows($sql) >= 1){
	      
		  $shipping_c = db_fetch_object($sql);
		  if($shipping_c->shippingcharge > $shipping){
		      $shipping = $shipping_c->shippingcharge;
		  }
	  
	      }
	  echo db_error();
	  return $shipping;
    }
    
        function getTotalPrice($auctionid, $userid) {
        $item = new PaymentItem();
        $auctiondb = new Auction(null);
        $ressel = $auctiondb->selectByAuctionId($auctionid);
        $total = db_num_rows($ressel);
        $auction = db_fetch_object($ressel);
	$shipping = $this->getshipping($auctionid);
        if ($total > 0 && $auction->allowbuynow) {
            if ($auction->allowbuynow == false) {
                return FALSE;
            } else {
                  $productname = stripslashes($auction->bidpack ? $auction->bidpack_name: $auction->name);
                  $amt = $auctiondb->getBuynowPrice($userid, $auctionid);
                  $taxamount = 0;
                  $qrysel = "select * from auction where auctionID='" . $auctionid . "'";
		  $ressel = db_query($qrysel) or die(db_error());
		  $total = db_num_rows($ressel);
            $rowauctionname = db_fetch_array($ressel);
            if (Sitesetting::isEnableTax() == true) {
			$payment = new paymentHelper();
			$p_item = db_fetch_array(db_query("select * from products where productID = $rowauctionname[productID]"));
			$user_info = db_fetch_array(db_query("select * from registration left join countries c on registration.country = c.countryId where id = '$_SESSION[userid]'"));
			$user_info['country'] = $user_info['iso'];
			$taxes = $payment->getTax($p_item, $user_info);
			$taxamount = $taxes[1] + $taxes[2];
		    }
		$amt=$amt + $taxamount + $shipping;
                return $amt;
            }
	}
    }
    function getBuyitnowPayment($userid, $auctionid, $paymentway) {
  
        $item = new PaymentItem();
        $auctiondb = new Auction(null);
        $ressel = $auctiondb->selectByAuctionId($auctionid);
        $total = db_num_rows($ressel);
        $auction = db_fetch_object($ressel);
	$shipping = $this->getshipping($auctionid);
	
        if ($total > 0 && $auction->allowbuynow) {
            if ($auction->allowbuynow == false) {
                return FALSE;
            } else {
                $productname = stripslashes($auction->bidpack ? $auction->bidpack_name: $auction->name);
                $amt = $auctiondb->getBuynowPrice($userid, $auctionid);
                $taxamount = 0;
                $qrysel = "select * from auction where auctionID='" . $auctionid . "'";
		$ressel = db_query($qrysel) or die(db_error());
		$total = db_num_rows($ressel);
		$rowauctionname = db_fetch_array($ressel);
                $item->amount = number_format($amt['total'], 2, '.', '');
                $item->itemid = $auctionid;
                $item->itemname = $productname;
                $item->itemdescription = $auction->bidpack ? "$productname ({$auction->bid_size} Bids and {$auction->freebids} Freebids)" : $productname;
                $item->payfor = PAYFOR_BUYITNOW;
                $item->userid = $userid;
                $item->paymentway = $paymentway;
                $data = new stdClass();
                $data->auctionid = $auctionid;
                $data->userid = $userid;
                $data->tax1 = $amt['tax1'];
                $data->tax2 = $amt['tax2'];
                $item->data = $data;
                $this->saveOrder($item);
                return $item;
            }
        } else {
            return FALSE;
        }
    }

    function getRedemptionPayment($userid, $redemid, $paymentway) {
        $qrysel = "select * from redemption r left join products p on r.product_id=p.productID left join shipping s on r.redem_shipping=s.id where r.id='$redemid'";
        $ressel = db_query($qrysel);
        $total = db_num_rows($ressel);
        if ($total > 0) {
            $item = new PaymentItem();
            $rowauctionname = db_fetch_array($ressel);
            $itemname = stripslashes($rowauctionname['name']);
            $amt = $rowauctionname['shippingcharge'];
            $item->amount = number_format($amt, 2, '.', '');
            $item->itemid = $redemid;
            $item->itemname = $itemname;
            $item->itemdescription = $itemname;
            $item->payfor = PAYFOR_REDEMPTION;
            $item->userid = $userid;
            $item->paymentway = $paymentway;
            $data = new stdClass();
            $data->redemid = $redemid;
            $data->userid = $userid;
            $item->data = $data;
            $this->saveOrder($item);
            return $item;
        } else {
            return FALSE;
        }
    }

    function getWonAuctionPayment($userid, $waucid, $amt, $voucherid, $usevoucherid, $novoucher, $paymentway) {
        $item = new PaymentItem();
        $notsendshipping = 0;
        $itemamount = $amt;
        if ($voucherid != "" && $novoucher == "") {
            $qryvou = "select * from vouchers where id='" . $voucherid . "'";
            $resvou = db_query($qryvou);
            $objvou = db_fetch_object($resvou);
            $amt1 = $amt - $objvou->bids_amount;
            if ($amt1 > 0) {
                $amt = $amt1;
            } else {
                $amt = "0.00";
            }
        }
        $qrysel = "select * from won_auctions w left join auction a on w.auction_id=a.auctionID left join products p on a.productID=p.productID and a.bidpack=0 left join bidpack b on b.id=a.productID and a.bidpack=1 where w.userid='" . $userid . "' and a.auctionID='" . $waucid . "'";
        $ressel = db_query($qrysel) or die(db_error());
        $total = db_num_rows($ressel);
        if ($total > 0) {
            $rowauctionname = db_fetch_array($ressel);
            $auctionname = $rowauctionname['bidpack'] ? ($rowauctionname['bidpack_name']."({$rowauctionname['bid_size']} Bids and {$rowauctionname['freebids']} Freebids)") : $rowauctionname['name'];
            $shipping = getshipping($rowauctionname['shipping_id']);
            if ($amt <= 0) {
                $amt = $shipping;
                $notsendshipping = 1;
            }
            $paymethod = $_POST['paymentmethod'];
            if ($amt <= 0) {
                if ($usevoucherid != "") {
                    $qryupdvou = "update user_vouchers set voucher_status='1',used_auction='" . $waucid . "' where id='" . $usevoucherid . "'";
                    db_query($qryupdvou) or die(db_error());
                }
                if ($waucid != "" && $waucid != 0) {
                    $updateqry = "update won_auctions set payment_date='" . date("Y-m-d H:i:s", time()) . "' where auction_id='" . $waucid . "' and userid='" . $userid . "'";
                    db_query($updateqry) or die(db_error());
                }
                $selectqry = "select * from auction a left join products p on a.productID=p.productID left join registration r on r.id=a.buy_user where a.auctionID='" . $waucid . "'";
                $resselectqry = db_query($selectqry) or die(db_error());
                if (0 < db_num_rows($resselectqry)) {
                    $rowauction = db_fetch_array($resselectqry);
                    $auctionname = $rowauction['name'];
                    $firstname = $rowauction['firstname'];
                    if ($rowauction['fixedpriceauction'] == 1) {
                        $auctionprice = $rowauction['auc_fixed_price'];
                    } elseif ($rowauction["offauction"] == 1) {
                        $auctionprice = "0.00";
                    } else {
                        $auctionprice = $rowauction['auc_final_price'];
                    }
                    $useremail = $rowauction['email'];
                    $auctionlink = '[<a href="' . $SITE_URL . 'viewproduct.php?pid=' . $rowauction['productID'] . '&aid=' . $rowauction['auctionID'] . '" style="text-decoration:none">&nbsp;Click Here&nbsp;</a>]';
                }

                $emailcont = getEmailContent(7);
                $subject = getEmailSubject(7);
                $emailcont1 = sprintf($emailcont, $firstname, $auctionname, $auctionprice, $auctionlink);
                $from = $adminemailadd;
                $cust_email = $useremail;
                SendHTMLMail($cust_email, $subject, $emailcont1, $from);
                if($paymethod != '100percentoff'){
		    header("location: payment_success.php?payfor=" . PAYFOR_WONAUCTION . "&itemid=$waucid");
		    return FALSE;
                }
            }
            $taxamount = 0;
            if (Sitesetting::isEnableTax() == true) {
                      $p_item = db_fetch_array(db_query("select * from products where productID = $rowauctionname[productid]"));
		      $userid = $_SESSION['userid'];
		      $tax_data = $rowauctionname;
		      $tax_data['price'] = $rowauctionname['auc_final_price'];
                      $taxes = $this->getTax($tax_data , $_REQUEST);
                      $taxamount = $taxes[0] + $taxes[1];
            }
            $amt+=$taxamount;
            if ($notsendshipping == 0) {
                $amt+=$shipping;
            }
            $amt = number_format($amt, 2, '.', '');
            $item->amount = $amt;
            $item->itemid = $waucid;
            $item->itemname = $auctionname;
            $item->itemdescription = $auctionname;
            $item->payfor = PAYFOR_WONAUCTION;
            $item->userid = $userid;
            $item->paymentway = $paymentway;
            $data = new stdClass();
            $data->wonaucid = $waucid;
            $data->userid = $userid;
            $data->usevoucherid = $usevoucherid;
            $data->shippingcharge=$shipping;
            $data->tax1=$taxes[0];
            $data->tax2=$taxes[1];
            $item->data = $data;
            $this->saveOrder($item);
            return $item;
        } else {
            return FALSE;
        }
     }

    /**
     * save order to database
     * @param <type> $item
     */
    function saveOrder($item) {
        $data = json_encode($item->data);
        $this->db->executeQuery("delete from payment_order where itemid = '" . $item->itemid . "'");
        $dt = date('Y-m-d H:i:s');
        $user = db_fetch_array($this->db->executeQuery("select * from registration where id = '" . $item->userid . "'"));
        $qry = "insert into payment_order ( id, orderid, userid, amount, itemid, itemname, itemdescription, payfor, data, paymentway, datetime, auction_id) values(null, '" . $item->orderid . "','" . $item->userid . "','" . $item->amount . "','" . $item->itemid . "','" . addslashes($item->itemname) . "','" . addslashes($item->itemdescription) . "','" . addslashes($item->payfor) . "','$data','" . $item->paymentway . "','$dt', '" . $item->itemid . "')";
        $this->db->executeQuery($qry);
	$this->db->executeQuery("CREATE TABLE IF NOT EXISTS `tax_records` ( `id` int(11) NOT NULL auto_increment, `invoiceid` varchar(250) default NULL, `userid` int(20) NOT NULL, `tax` decimal(20, 2) NOT NULL default '0.00', `state` varchar(200) default null, `country` varchar(200) default null, PRIMARY KEY  (`id`)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;");
	$this->db->executeQuery("alter table tax_records add column st_tax decimal(20, 2) not null default '0.00'");
	$this->db->executeQuery("insert into tax_records values(null, '" . $item->orderid . "','" . $item->userid . "', '" . number_format($item->data->tax1,2) . "', '$user[delivery_state]', '$user[delivery_country]', '" . number_format($item->data->tax2,2) . "')");
      	 echo db_error();
     }
    function updateAddress($userid){
	foreach($_POST as $key => $value){
	  if(preg_match('/delivery_/', $key)){
	      db_query("update registration set $key = '" . addslashes($value) . "' where id = '$userid'");
	      db_query("update registration set " . str_replace('delivery_', '', $key) . " = '" . addslashes($value) . "' where id = '$userid'");
	   }else{
	      if($key == 'firstname' | $key == 'lastname'){
		  db_query("update registration set delivery_name = '" . addslashes($_POST['firstname'] . ' ' . $_POST['lastname']) . "' where id = '$userid'");			
	      }
	   }
	}
    }
}

/**
 * the information of the item
 */
class PaymentItem {

    public $orderid;
    public $amount;
    public $itemid;
    public $itemname;
    public $itemdescription;
    public $paymentway;
    public $payfor;
    public $data;
    public $userid;

    public function __construct() {
        $guid = new Guid();
        $this->orderid = $guid->toString();
    }

}

?>
