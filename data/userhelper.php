<?php
 /*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
    require_once $BASE_DIR . '/common/dbmysql.php';
    require_once $BASE_DIR . '/data/bidpack.php';
    require_once $BASE_DIR . '/data/registration.php';
    require_once $BASE_DIR . '/data/coupon.php';
    require_once $BASE_DIR . '/data/usercoupon.php';
    require_once $BASE_DIR . '/data/usercouponhistory.php';
    require_once $BASE_DIR . '/data/auction.php';
    require_once $BASE_DIR . '/data/userproduct.php';
    require_once $BASE_DIR . '/data/bidaccount.php';
    require_once $BASE_DIR . '/data/freeaccount.php';
    require_once $BASE_DIR . '/data/auctionpausemanagement.php';
    require_once $BASE_DIR . '/sendmail.php';
    require_once $BASE_DIR . '/email.php';
    require_once $BASE_DIR . '/common/constvariable.php';
 /**
 * Description of userbuy
 *
 *
 */
class UserHelper {
    private $db;
    //put your code here
    public function __construct($db) {
        if ($db == null) {
            $this->db = new DBMysql();
        } else {
            $this->db = $db;
        }
    }
    function processOrder($orderid, $payamount) {
	$this->db->executeQuery("CREATE TABLE if not exists `user_product` (
				  `id` int(11) NOT NULL auto_increment,
				  `productid` int(11) NOT NULL default '0',
				  `userid` int(11) NOT NULL default '0',
				  `price` float(20,2) NOT NULL default '0.00',
				  `status` int(11) NOT NULL default '0' COMMENT '1,payment,2 sent product',
				  `buydate` datetime NOT NULL default '0000-00-00 00:00:00',
				  `sess_id` text NOT NULL,
				  `quantity` varchar(20) default NULL,
				  `option1` varchar(20) default NULL,
				  `option2` varchar(20) default NULL,
				  `option3` varchar(20) default NULL,
				  `option4` varchar(20) default NULL,
				  `folder` text,
				  PRIMARY KEY  (`id`),
				  KEY `productid` (`productid`),
				  KEY `userid` (`userid`)
				) ENGINE=MyISAM AUTO_INCREMENT=327 DEFAULT CHARSET=latin1;");
        $sql = "select * from payment_order where orderid='$orderid'";
        $result = $this->db->executeQuery($sql);
        if (db_num_rows($result) > 0) {
            $row = db_fetch_array($result);
            $payfor = $row['payfor'];
            $data = $row['data'];
            $userid = $row['userid'];
            $amount = $row['amount'];
            if ($payfor == PAYFOR_BUYBID) {
                $itemdata = json_decode($data);
                $bidpackid = $itemdata->bidpackid;
                $usercouponid = $itemdata->userCouponid;
                $couponId = $itemdata->couponid;
                $shippingcharge = 0;
		  if (isset($itemdata->shippingcharge)) {
		      $shippingcharge = $itemdata->shippingcharge;
		  }
		  
		  require( dirname(dirname(__FILE__)) . "/include/addons/escrow_auctions/userhelper.php");
		          
                  $this->db->executeQuery("INSERT INTO payment_order_history(orderid,userid,amount,shippingcharge,itemid,itemname,itemdescription,payfor,paymentway,datetime, auction_id) values('" . $row['orderid'] . "','" . $row['userid'] . "','" .$row['amount'] . "','" .$row['shippingcharge'] . "','" .$row['itemid'] . "','" . addslashes($row['itemname']) . "','" . addslashes($row['itemdescription']) . "','" . addslashes($row['payfor']) . "','" . addslashes($row['paymentway']) . "',NOW(), $bidpackid);");
		  $addons = db_fetch_array(db_query("select distinct(value) from sitesetting where name = 'addons'"));
                $this->buybids($orderid, $userid, $bidpackid, $usercouponid, $couponId);
            } else if ($payfor == PAYFOR_BUYITNOW) {
                $itemdata = json_decode($data);
                $auctionid = $itemdata->auctionid;
                $this->buyitnow($orderid, $auctionid, $userid);
                $shippingcharge = 0;
		  if (isset($itemdata->shippingcharge)) {
		      $shippingcharge = $itemdata->shippingcharge;
		  }
		  $this->db->executeQuery("INSERT INTO payment_order_history(orderid,userid,amount,shippingcharge,itemid,itemname,itemdescription,payfor,paymentway,datetime, auction_id ) values('" . addslashes($row['orderid']) . "','" . $row['userid'] . "','" .$row['amount'] . "','" .$row['shippingcharge'] . "','" .$row['itemid'] . "', '" . addslashes($row['itemname']) . "','" . addslashes($row['itemdescription']) . "','" . addslashes($row['payfor']) . "','" . addslashes($row['paymentway']) . "',NOW(), $auctionid);");
		  echo db_error();
		  $data = db_fetch_array($this->db->executeQuery("select * from auction where auctionID = '$row[auction_id]'"));
		  $this->db->executeQuery("insert into user_product(id, productid, userid, price, status, buydate, record_id, invoiceid) values(null, '$data[productID]', '$row[userid]', '$row[amount]', '3', '$row[datetime]', $row[id], '$row[orderid]');");
		  $record = db_insert_id();
		  $shipping = db_fetch_array($this->db->executeQuery("select shipping_id, productID from auction where auctionID= $auctionid"));
		  $this->db->executeQuery("insert into shippingstatus(id, shippingtypeid, adddate, orderid, ordertype) values(null, $shipping[shipping_id], '$row[datetime]',  '$record',  2) ");
		  echo db_error();
            if(!empty($_REQUEST['debug'])){
 		echo db_error();
            }
		  $addons = db_fetch_array(db_query("select distinct(value) from sitesetting where name = 'addons'"));
             } else if ($payfor == PAYFOR_REDEMPTION) {
                $itemdata = json_decode($data);
                $redemid = $itemdata->redemid;
                $shippingcharge = 0;
		  if (isset($itemdata->shippingcharge)) {
		      $shippingcharge = $itemdata->shippingcharge;
		  }
		  $this->db->executeQuery("INSERT INTO payment_order_history(orderid,userid,amount,shippingcharge,itemid,itemname,itemdescription,payfor,paymentway,datetime, auction_id) values('" . $row['orderid'] . "','" . $row['userid'] . "','" .$row['amount'] . "','" .$row['shippingcharge'] . "','" .$row['itemid'] . "','" . addslashes($row['itemname']) . "','" . addslashes($row['itemdescription']) . "','" . addslashes($row['payfor']) . "','" . addslashes($row['paymentway']) . "',NOW(), $redemid);");
		  $this->db->executeQuery("insert into user_product(id, productid, userid, price, status, buydate, record_id, invoiceid) values(null, '$row[itemid]', '$row[userid]', '$row[amount]', '3', '$row[datetime]', $row[id], '$row[orderid]');"); 
		  $shipping = db_fetch_array($this->db->executeQuery("select redem_shipping from redemption where id = $reredemid"));
		  $this->db->executeQuery("insert into shippingstatus(id, shippingtypeid, adddate, orderid, ordertype) values(null, $shipping[shipping_id], '$row[datetime]',  '$shipping[0]',  6) ");
		  $addons = db_fetch_array($this->db->executeQuery("select distinct(value) from sitesetting where name = 'addons'"));
                 $this->redempayment($orderid, $redemid, $userid);
            } else if ($payfor == PAYFOR_WONAUCTION) {
                $itemdata = json_decode($data);
                $wonaucid = $itemdata->wonaucid;
                $uservoucherid = $itemdata->usevoucherid;
		  $shippingcharge = 0;
		  if (isset($itemdata->shippingcharge)) {
		      $shippingcharge = $itemdata->shippingcharge;
		  }
		  $this->db->executeQuery("delete from payment_order_history where auction_id = $wonaucid and userid = $userid");
                  $this->db->executeQuery("INSERT INTO payment_order_history(orderid,userid,amount,shippingcharge,itemid,itemname,itemdescription,payfor,paymentway,datetime,auction_id) values('" . $row['orderid'] . "','" . $row['userid'] . "','" .$row['amount'] . "','" .$row['shippingcharge'] . "','" .$row['itemid'] . "','" . addslashes($row['itemname']) . "','" . addslashes($row['itemdescription']) . "','" . addslashes($row['payfor']) . "','" . addslashes($row['paymentway']) . "',NOW(), $wonaucid);");
		  $addons = db_fetch_array(db_query("select distinct(value) from sitesetting where name = 'addons'"));
		  $shipping = db_fetch_array(db_query("select shipping_id, w.id from auction left join won_auctions w on w.auction_id=auction.auctionID where auctionID= $wonaucid"));
		  $this->db->executeQuery("insert into shippingstatus(id, shippingtypeid, adddate, orderid, ordertype) values(null, $shipping[shipping_id], '$row[datetime]',  '$shipping[id]',  1) ");
		  $this->db->executeQuery("insert into user_product(id, productid, userid, price, status, buydate, record_id, invoiceid) values(null, '$row[itemid]', '$row[userid]', '$row[amount]', '3', '$row[datetime]', $row[id], '$row[orderid]');");
                  $this->paywonauction($wonaucid, $uservoucherid, $userid, $orderid, $amount);
            }
        }
    }

    function deleteOrder($orderid) {
        $sql = "delete from payment_order where orderid='$orderid'";
    }
     /**
     * update the user's coupons and bids after payment
     */
    function buybids($orderid, $userid, $bidpackid, $userCouponId, $couponId) {
       $this->db->begin();
        $bidpackdb = new Bidpack($this->db);
        $resBidpack = $bidpackdb->selectById($bidpackid);
        $bidpack = db_fetch_object($resBidpack);
        $creditdesc = "Bid Pack:&nbsp;&nbsp;" . $bidpack->bidpack_name . "&nbsp;" . $bidpack->bid_size . " bids for: " . $Currency . $bidpack->bid_price;
        $userdb = new Registration($this->db);
        $resUser = $userdb->selectById($userid);
        $user = db_fetch_object($resUser);
        $bidAcountdb = new Bidaccount($this->db);
        $freebids = $bidpack->freebids;
        if ($couponid != -1) {
            $coupondb = new Coupon($this->db);
            $couponQuery = $coupondb->selectById($couponid);
            if ($couponQuery != false) {
                $coupon = db_fetch_object($couponQuery);
                $freebids+=$coupon->freebids;
            }
        }
        if ($user->sponser != "0" && $user->sponser != "") {
            $bidunitprice=1;
            $sqlss = "select * from sitesetting where name='bidprice';";
            $resultss = db_query($resultss);
            if (db_num_rows($resultss) > 0) {
                $obj = db_fetch_object($resultss);
                $bidunitprice = $obj->value;
                db_free_result($resultss);
            }
            $resaff = $userdb->selectById($user->sponser);
            $objaff = db_fetch_object($resaff);
            $fbid = $objaff->final_bids;
            $apmdb = new Auctionpausemanagement($this->db);
            $resbonus = $apmdb->selectById(2);
            $objbonus = db_fetch_object($resbonus);
            $rowbonus = ($bidpack->bid_price * $objbonus->referral_bids) / 100;
            $actualbonus = ceil($rowbonus / $bidunitprice);
            $bonusbids = $actualbonus;
            $finalbids = $fbid + $bonusbids;
            if ($bonusbids > 0) {
                $userdb->updateBids($user->sponser, $finalbids);
                $bidAcountdb->insertForSponser($user->sponser, $bonusbids, $userid);
            }
        }
        $bidAcountdb->insert($userid, $bidpackid, $bidpack->bid_size, $creditdesc);
        $freeAccountdb = new Freeaccount($this->db);
        $freeAccountdb->insert($userid, $bidpackid, $freebids);
        if ($user->final_bids > 0) {
            $bal = $user->final_bids;
            $new = $bidpack->bid_size;
            $final = $bal + $new;
        } else {
            $final = $bidpack->bid_size;
        }
        if ($freebids > 0) {
            $freebal = $user->free_bids;
            $finalfree = $freebal + $freebids;
        } else {
            $finalfree = $user->free_bids;
        }
        $userdb->updateBids($userid, $final, $finalfree);
        if ($userCouponId != -1) {
            $ucdb = new UserCoupon($this->db);
            $historydb = new UserCouponHistory($this->db);
            $ucquery = $ucdb->selectById($userCouponId);
            if ($ucquery != FALSE) {
                $uc = db_fetch_object($ucquery);
                $historydb->insert($uc->regid, $uc->couponid, $uc->uniqueid);
                $ucdb->delete($uc->id);
            }
        }

        $this->deleteOrder($orderid);
        $this->db->commit();
    }

    function buyitnow($orderid, $auctionid, $userid) {
    require( str_replace("/data", "", dirname(__FILE__)) . "/config/config.inc.php");
        if ($auctionid != "" && $auctionid != 0) {
            $this->db->begin();
            $auctiondb = new Auction($this->db);
            $result = $auctiondb->selectByAuctionId($auctionid);
            if(!empty($_REQUEST['debug'])){
            echo "<br />Debug information for Buy Now Sale<br /><br />";
            }
            $auction = db_fetch_object($result);
            $updb = new UserProduct($this->db);
            $updb->insert($auction->productID, $userid, $auctiondb->getBuynowPrice($userid, $auctionid));
            if(!empty($_REQUEST['debug'])){
		print_r($updb);
            }
                    $sql = db_query("select distinct(value) from sitesetting where name = 'addons'");
		    while($addons = db_fetch_array($sql)){
			if($_REQUEST['debug'] == 'true'){
			    print_r($addons);
			}
			$value = $addons['value'];
			  if(file_exists($BASE_DIR . "/include/addons/$value/processOrder.php")){
			      if(db_num_rows(db_query("select * from won_auctions where auction_id = '$auctionid' and userid = '$userid'")) == 0){
					  db_query("insert into won_auctions values(null, $auctionid, 'Paid', '$userid', NOW(), NOW(), NOW(), '', 'Paid');");
					  echo db_error();
				      }
			    $wonaucid = $auctionid;
			    $selectqry = "select a.auctionID,a.productID as productID,a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,
			    auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,
			    use_free,firstname,addressline1,addressline2,lastname,username,city,state,postcode,phone,allowbuynow,buynowprice,reverseauction,uniqueauction,halfbackauction,bidpack,tax1,tax2,bidpack_name,bidpack_banner,bidpack_price,price,bid_size,freebids ,p.name,p.picture1,short_desc
			    from auction a left join products p on a.productID=p.productID left join bidpack b on b.id=a.productID left join registration r on r.id=a.buy_user where a.auctionID='" . $wonaucid . "'";
			    $resselectqry = db_query($selectqry);
			    $rowauction = db_fetch_array($resselectqry);
		            echo db_error();
				  include_once($BASE_DIR . "/include/addons/$value/processOrder.php");
				  $emailsent = 'true';
			      }
				      $aid = $auctionid;
				      if(file_exists($BASE_DIR . "/include/addons/$value/userhelper.php")){
					  include($BASE_DIR . "/include/addons/$value/userhelper.php");
				      }
			      }
            $this->deleteOrder($orderid);
            $this->db->commit();
        }
    }

    function redempayment($orderid, $redemId, $userid) {
        if ($redemId != "" && $redemId != 0) {
            $this->db->begin();
            $qryred1 = "select * from redemption r left join shipping s on r.redem_shipping=s.id where r.id='" . $redemId . "'";
            $resred1 = $this->db->executeQuery($qryred1); //db_query($qryred1);
            $objred1 = db_fetch_array($resred1);
            $qryins = "Insert into redemption_order(user_id,redem_id,pur_date) values ('" . $userid . "','" . $redemId . "',NOW())";
            //db_query($qryins) or die(db_error());
            $this->db->executeQuery($qryins);
            $qryupd = "update redemption set redem_soldqty=redem_soldqty+1 where id='" . $redemId . "'";
            //db_query($qryupd) or die(db_error());
            $this->db->executeQuery($qryupd);
            $qryins1 = "Insert into free_account (user_id,bidpack_buy_date,bid_count,bid_flag,credit_description,redemption_id) values('" . $userid . "',NOW(),'" . $objred1["redem_points"] . "','d','Used in redeem product','" . $redemId . "')";
            //db_query($qryins1) or die(db_error());
            $this->db->executeQuery($qryins1);
            $qryupd1 = "update registration set free_bids=free_bids-" . $objred1["redem_points"] . " where id='" . $userid . "'";
            //db_query($qryupd1) or die(db_error());
            $this->db->executeQuery($qryupd1);
            $this->deleteOrder($orderid);
            $this->db->commit();
        }
    }

    function paywonauction($wonaucid, $uservoucherid, $userid, $orderid, $amount) {
        require( str_replace("/data", "", dirname(__FILE__)) . "/config/config.inc.php");
        $this->db->begin();
        if ($uservoucherid != "") {
            $qryupdvou = "update user_vouchers set voucher_status='1',used_auction='" . $wonaucid . "' where id='" . $uservoucherid . "'";
            db_query($qryupdvou) or die(db_error());
        }
        if ($wonaucid != "" && $wonaucid != 0) {
            $updateqry = "update won_auctions set payment_date='" . date("Y-m-d H:i:s", time()) . "' where auction_id='" . $wonaucid . "' and userid='" . $userid . "'";
            db_query($updateqry) or die(db_error());
            $selectqry = "select a.auctionID,a.productID as productID,a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,use_free,firstname,addressline1,addressline2,lastname,username,city,state,email,postcode,phone,allowbuynow,buynowprice,reverseauction,uniqueauction,halfbackauction,bidpack,tax1,tax2,bidpack_name,bidpack_banner,bidpack_price,price,bid_size,freebids ,p.name,p.picture1,short_desc from auction a left join products p on a.productID=p.productID left join bidpack b on b.id=a.productID left join registration r on r.id=$userid where a.auctionID='" . $wonaucid . "'";
            $resselectqry = db_query($selectqry) or die(db_error());
            if (db_num_rows($resselectqry) > 0) {
                $rowauction = db_fetch_array($resselectqry);
                $auctionname = $rowauction['bidpack'] ? $rowauction['bidpack_name'] : $rowauction['name'];
                $firstname = $rowauction['firstname'];
                if ($rowauction['fixedpriceauction'] == 1) {
                    $auctionprice = $rowauction['auc_fixed_price'];
                } elseif ($rowauction["offauction"] == 1) {
                    $auctionprice = "0.00";
                } else {
                    $auctionprice = $rowauction['auc_final_price'];
                }
                //when the auction is a bid pack aution
                if (!empty($rowauction['bidpack_name'])) {
                    $this->insertBidpack($rowauction['productID'], $userid);
                }
                $useremail = $rowauction['email'];
                if ($rowauction['uniqueauction']) {
                    $auctionlink = '[<a href="' . $SITE_URL . 'viewproduct_lowest.php?pid=' . $rowauction['productID'] . '&aid=' . $rowauction['auctionID'] . '" style="text-decoration:none">&nbsp;Click Here&nbsp;</a>]';
                } else {
                    $auctionlink = '[<a href="' . $SITE_URL . 'viewproduct.php?pid=' . $rowauction['productID'] . '&aid=' . $rowauction['auctionID'] . '" style="text-decoration:none">&nbsp;Click Here&nbsp;</a>]';
                }
            }
            $this->db->commit();
            $emailcont = getEmailContent(7);
            $subject = getEmailSubject(7);
            $emailcont1 = sprintf($emailcont, $firstname, $auctionname, $auctionprice, $auctionlink);
            $from = $adminemailadd;
            $cust_email = $useremail;
		  $sql = db_query("select distinct(value) from sitesetting where name = 'addons'");
		  while($addons = db_fetch_array($sql)){
			    $value = $addons['value'];
		      if(file_exists($BASE_DIR . "/include/addons/$value/processOrder.php")){
			      include($BASE_DIR . "/include/addons/$value/processOrder.php");
			      $emailsent = 'true';
		      }else if(file_exists("../include/addons/$value/processOrder.php")){
			      include("../include/addons/$value/processOrder.php");
			      $emailsent = 'true';
		      }
			  $aid = $wonaucid;
			  if(file_exists($BASE_DIR . "/include/addons/$value/userhelper.php")){
			      include($BASE_DIR . "/include/addons/$value/userhelper.php");
			  }
		  }
          	echo db_error();
		
		if(empty($emailsent)){
		     SendHTMLMail($cust_email, $subject, $emailcont1, $from);
		}
		
		$this->deleteOrder($orderid);
            $wonEmailSubject = "New Winner({$rowauction['buy_user']}) Paid";
            $wonEmailContent = "Auction Details Below <br />" . 'Name: ' . $rowauction['firstname'] . ' ' . $rowauction['lastname'] . '<br /> Address: ' . $rowauction['addressline1'] . '<br/>' . $rowauction['addressline2'] . '<br />' . $rowauction['city'] . ' ' . $rowauction['state'] . ', ' . $rowauction['postcode'] . '<br />Phone: ' . $rowauction['phone'] . '<br />Date: ' . date('Y-m-d H:i:s') . '<br /> Amount: ' . $amount . '<br />Action Name: ' . $auctionname . '<br /> Auction ID: ' . $wonaucid . '<br /> Auction End Date: ' . $rowauction['auc_final_end_date'] . '<br /> Winner:' . $rowauction['username'];
            SendHTMLMail($from, $wonEmailSubject, $wonEmailContent, $from);
	  } else {
	      $this->db->commit();
	  }
        }
        private function insertBidpack($bidpackid, $userid) {
        $bidpackdb = new Bidpack($this->db);
        $resBidpack = $bidpackdb->selectById($bidpackid);
        $bidpack = db_fetch_object($resBidpack);
        $creditdesc = "Won Bid Pack:&nbsp;&nbsp;" . $bidpack->bidpack_name . "&nbsp;" . $bidpack->bid_size . " bids for: " . $Currency . $bidpack->bid_price;
        $userdb = new Registration($this->db);
        $resUser = $userdb->selectById($userid);
        $user = db_fetch_object($resUser);
        $bidAcountdb = new Bidaccount($this->db);
//        $qr = "select * from bid_account where user_id='".$uid."' and bid_flag='c' and recharge_type='re'";
//        $rs = db_query($qr);
//        $totalrecharge = db_num_rows($rs);
        //PennyAuctionSoft add
        $freebids = $bidpack->freebids;
        //end PennyAuctionSoft add
        //recharge type re for recharge
        //recharge type af for affiliate
        //recharge type ad for admin
        //if($totalrecharge=="0" && $user->sponser!="0")
//        if ($user->sponser != "0" && $user->sponser != "") {
//            $resaff = $userdb->selectById($user->sponser);
//            $objaff = db_fetch_object($resaff);
//            $fbid = $objaff->final_bids;
//
//            $apmdb = new Auctionpausemanagement($this->db);
//            $resbonus = $apmdb->selectById(2);
//            $objbonus = db_fetch_object($resbonus);
//            $rowbonus = ($bidpack->bid_price * $objbonus->referral_bids) / 100;
//            $actualbonus = ceil($rowbonus / 0.5);
//            $bonusbids = $actualbonus;
//            $finalbids = $fbid + $bonusbids;
//
//            if ($bonusbids > 0) {
//                $userdb->updateBids($user->sponser, $finalbids);
//                $bidAcountdb->insertForSponser($user->sponser, $bonusbids, $userid);
//            }
//        }
        $bidAcountdb->insertWonPack($userid, $bidpackid, $bidpack->bid_size, $creditdesc);
        $freeAccountdb = new Freeaccount($this->db);
        $freeAccountdb->insertWonPack($userid, $bidpackid, $freebids);
        //end bid_account
        if ($user->final_bids > 0) {
            $bal = $user->final_bids;
            $new = $bidpack->bid_size;
            $final = $bal + $new;
        } else {
            $final = $bidpack->bid_size;
        }
        if ($freebids > 0) {
            $freebal = $user->free_bids;
            $finalfree = $freebal + $freebids;
        } else {
            $finalfree = $user->free_bids;
        }
        $userdb->updateBids($userid, $final, $finalfree);
    }

}

?>
