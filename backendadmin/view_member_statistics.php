<?php
session_start();
$active = "Users";
include("connect.php");
include("security.php");
include("functions.php");
ini_set('display_errors', 1);
function UseBidStatus($userid) {
    $sqlbidstatus = "select SUM(bid_count) as bidcount from bid_account where bid_flag='d' and user_id='" . $userid . "' and (bidding_type='s' or bidding_type='b')";
    $resbidstatus = db_query($sqlbidstatus) or die(db_error());
    $totalbidcount = db_num_rows($resbidstatus);
    if ($totalbidcount > 0) {
        $rowbidcount = db_fetch_array($resbidstatus);
        $bidcount = $rowbidcount['bidcount'] == '' ? 0 : $rowbidcount['bidcount'];
    } else {
        $bidcount = 0;
    }
    return $bidcount;
}

function getSpinnerCredits($userid) {
    $sqlbidcount = "select SUM(bid_count) as bidcount from bid_account where bid_flag='c' and user_id='" . $userid . "' and recharge_type='sm'";
    $resbidcount = db_query($sqlbidcount) or die(db_error());
    $totalbidcount = db_num_rows($resbidcount);
    if ($totalbidcount > 0) {
        $rowbidcount = db_fetch_array($resbidcount);
        $bidcount = $rowbidcount['bidcount'] == '' ? 0 : $rowbidcount['bidcount'];
    } else {
        $bidcount = 0;
    }
    return $bidcount;
}

function UserPurchaseBid($userid) {
    $sqlbidcount = "select SUM(bid_count) as bidcount from bid_account where bid_flag='c' and user_id='" . $userid . "' and recharge_type='re'";
    $resbidcount = db_query($sqlbidcount) or die(db_error());
    $totalbidcount = db_num_rows($resbidcount);
    if ($totalbidcount > 0) {
        $rowbidcount = db_fetch_array($resbidcount);
        $bidcount = $rowbidcount['bidcount'] == '' ? 0 : $rowbidcount['bidcount'];
    } else {
        $bidcount = 0;
    }
    return $bidcount;
}

function UserAdminBid($userid) {
    $sqlbidcount = "select SUM(bid_count) as bidcount from bid_account where bid_flag='c' and user_id='" . $userid . "' and recharge_type='ad'";
    $resbidcount = db_query($sqlbidcount) or die(db_error());
    $totalbidcount = db_num_rows($resbidcount);
    if ($totalbidcount > 0) {
        $rowbidcount = db_fetch_array($resbidcount);
        $bidcount = $rowbidcount['bidcount'] == '' ? 0 : $rowbidcount['bidcount'];
    } else {
        $bidcount = 0;
    }
    return $bidcount;
}

function UserAdminBidFr($userid) {
    $sqlbidcount = "select SUM(bid_count) as bidcount from free_account where bid_flag='c' and user_id='" . $userid . "'";
    $resbidcount = db_query($sqlbidcount) or die(db_error());
    $totalbidcount = db_num_rows($resbidcount);
    if ($totalbidcount > 0) {
        $rowbidcount = db_fetch_array($resbidcount);
        $bidcount = $rowbidcount['bidcount'] == '' ? 0 : $rowbidcount['bidcount'];
    } else {
        $bidcount = 0;
    }
    return $bidcount;
}

function UserReferralBid($userid) {
    $sqlbidcount = "select SUM(bid_count) as bidcount from bid_account where bid_flag='c' and user_id='" . $userid . "' and recharge_type='af'";
    $resbidcount = db_query($sqlbidcount) or die(db_error());
    $totalbidcount = db_num_rows($resbidcount);
    if ($totalbidcount > 0) {
        $rowbidcount = db_fetch_array($resbidcount);
        $bidcount = $rowbidcount['bidcount'] == '' ? 0 : $rowbidcount['bidcount'];
    } else {
        $bidcount = 0;
    }
    return $bidcount;
}

function UserWelcomeBid($userid) {
    $sqlbidcount = "select SUM(bid_count) as bidcount from bid_account where bid_flag='c' and user_id='" . $userid . "' and recharge_type='fr'";
    $resbidcount = db_query($sqlbidcount) or die(db_error());
    $totalbidcount = db_num_rows($resbidcount);
    if ($totalbidcount > 0) {
        $rowbidcount = db_fetch_array($resbidcount);
        $bidcount = $rowbidcount['bidcount'] == '' ? 0 : $rowbidcount['bidcount'];
    } else {
        $bidcount = 0;
    }
    return $bidcount;
}

function GetWonAuctionStatus($au_id, $au_status, $uid) {
    if ($au_status == "3") {
        $sqlwonauctstat = "select * from won_auctions where auction_id='" . $au_id . "' and userid='" . $uid . "'";
        $reswonauctstat = db_query($sqlwonauctstat) or die(db_error());
        if (0 < db_num_rows($reswonauctstat)) {
            return "<font color='green'>Won</font>";
        } else {
            return "<font color='red'>Lost</font>";
        }
    } else {
        return "-";
    }
}

function GetSeatBidsForUser($uid) {
    
        $sqlseatbidstat = "select * from auction_seat, auction where auction_seat.user_id = $uid and auction_seat.auction_id = auction.auctionID order by auction_seat.id desc";
        
 //       echo $sqlseatbidstat;
        $resseatbidstat = db_query($sqlseatbidstat);// or die(db_error());
        $tot_bids = 0;
        $tot_price = 0;
         while($data = db_fetch_array($resseatbidstat)){
         
       ?><tr>
       <?php 
	      $dataB = db_fetch_array(db_query("select * from bid_account where user_id = $uid and auction_id = $data[auction_id] and bid_flag = 's' limit 1"));
	      
	      $dataP = db_fetch_array(db_query("select * from products where productID = $data[productID] limit 1"));
       
       ?>
       <td><?php echo $data['auction_id']; ?></td>
       <td><?php echo $data['productID'];?> : <?php echo $dataP['name'];?></td>
       <td><?php  echo $dataB['bidpack_buy_date'];?></td>
       <td>
	    <?php echo $dataB['bid_count']; $tot_bids = $tot_bids + $dataB['bid_count']; ?> * 
	    <?php echo $dataB['bidding_price']; ?> = $
	    <?php 
	    
	    $fprice = $dataB['bid_count'] * $dataB['bidding_price']; 
	    $tot_price = number_format($tot_price + $fprice, 2);
	    echo number_format($fprice, 2);
	    ?> 
       
       </td>

       <td>
	  <?php
	    if($data['auc_final_end_date'] == '0000-00-00 00:00:00'){
	    echo "Still Running";
	    }else{
	    $qrysel = "select w.auction_id, accept_denied,won_date,accept_date,payment_date,order_status,tracknumber,a.auctionID,a.productID as productID,a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user,
        auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,
        use_free,allowbuynow,buynowprice,reverseauction,uniqueauction,lockauction,halfbackauction,bidpack,tax1,tax2,bidpack_name,bidpack_banner,bidpack_price,price,bid_size,freebids ,p.name,p.picture1,short_desc,ss.id as ssid,st.url as sturl,st.logoimage as stlogoimage from won_auctions w left join auction a on w.auction_id=a.auctionID left join products p on a.productID=p.productID left join bidpack b on b.id=a.productID left join shippingstatus ss on ss.orderid=w.id and ss.ordertype=1 left join shippingtype st on st.id=ss.shippingtypeid where w.userid=$uid and w.auction_id = $data[auction_id] and a.auctionID = $data[auctionID] limit 1";
        if(db_num_rows(db_query($qrysel)) >= 1){
        echo "Won";
        
        }else{
        
        
        echo "Lost";
        
        }
	    
	    }
	    
	    ?>
       </td>
     
	  </tr>
       <?php
         }
         ?>
          <tr> <td></td><td></td><td></td><td>Totals: <?php echo $tot_bids . " : $" . number_format($tot_price, 2); ?></td><td></td></tr>
          <?php
     
}
function getTotalSeatBids($uid){

        $sqlseatbidstat = "select * from auction_seat, auction where auction_seat.user_id = $uid and auction_seat.auction_id = auction.auctionID order by auction_seat.id desc";
        
 //       echo $sqlseatbidstat;
        $resseatbidstat = db_query($sqlseatbidstat);// or die(db_error());
        $tot_bids = 0;
        $tot_price = 0;
         while($data = db_fetch_array($resseatbidstat)){
         
      
	      $dataB = db_fetch_array(db_query("select * from bid_account where user_id = $uid and auction_id = $data[auction_id] and bid_flag = 's' limit 1"));
	      
	      $dataP = db_fetch_array(db_query("select * from products where productID = $data[productID] limit 1"));
       
	    $tot_bids = $tot_bids + $dataB['bid_count']; 
	    
	    $fprice = $dataB['bid_count'] * $dataB['bidding_price']; 
	    $tot_price = number_format($tot_price + $fprice, 2);

	    
	    }
	    

         
         ?>
         Totals: <?php echo $tot_bids . " : $" . number_format($tot_price, 2); ?>
          <?php



}
if (isset($_GET['uid'])) {
    $u_id = chkInput($_GET['uid'], 'i');
    $sqlquery = "select * from registration where id='" . $u_id . "' order by id";
    $resquery = db_query($sqlquery) or die(db_error());
    $rowquery = db_fetch_array($resquery);

    $purchasedBids = UserPurchaseBid($u_id);
    $signUpBonus = UserWelcomeBid($u_id);
    $adminCredits = UserAdminBid($u_id);
    $adminCreditsFree = UserAdminBidFr($u_id);
    $spinnerCredits = getSpinnerCredits($u_id);
    $referralCredits = UserReferralBid($u_id);

    $totalCredits = $purchasedBids + $signUpBonus + $adminCredits + $spinnerCredits + $referralCredits;
    $usedCredits = UseBidStatus($u_id);
    $remaining = $totalCredits - $usedCredits;
} else {
    header('location:manage_members.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title>View user Statistics-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <link type="text/css" href="css/cupertino/ui.all.css" rel="stylesheet" />
        <link type="text/css" href="css/cupertino/jquery-ui-1.7.3.custom.css" rel="stylesheet" />

        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>
        <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/ui/jquery-ui-1.7.2.custom.min.js"></script>
	<script type="text/javascript" src="js/ui/ui.accordion.min.js"></script>
        <script type="text/javascript">
            function OpenPopup(url){
                window.open(url,'popupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=yes,copyhistory=no,width=700,height=475,screenX=150,screenY=200,top=200,left=200')
            }
            $(document).ready(function(){
                $("#accordion").accordion({ header: "h3",autoHeight: false,fillSpace: true });
            });
        </script>
    </head>

    <body>
        <!--[if !IE]>start wrapper<![endif]-->
        <div id="wrapper">
            <!--[if !IE]>start head<![endif]-->
            <div id="head">
                <?php include('include/header.php'); ?>
            </div>
            <!--[if !IE]>end head<![endif]-->

            <!--[if !IE]>start content<![endif]-->
            <div id="content">
                <!--[if !IE]>start page<![endif]-->
                <div id="page">
                    <div class="inner">
                        <!--[if !IE]>start section<![endif]-->
                        <div class="section">
                            <!--[if !IE]>start title wrapper<![endif]-->
                            <div class="title_wrapper">
                                <h2>View user Statistics</h2>
                                <span class="title_wrapper_left"></span>
                                <span class="title_wrapper_right"></span>
                            </div>
                            <!--[if !IE]>end title wrapper<![endif]-->
                            <!--[if !IE]>start section content<![endif]-->
                            <div class="section_content">
                                <!--[if !IE]>start section content top<![endif]-->
                                <div class="sct">
                                    <div class="sct_left">
                                        <div class="sct_right">
                                            <div class="sct_left">
                                                <div class="sct_right">

                                                    <h3>User Details</h3>
                                                    <!--[if !IE]>start forms<![endif]-->
                                                    <form action="" method="post" onsubmit="return Check(this)" class="search_form general_form">
                                                        <!--[if !IE]>start fieldset<![endif]-->
                                                        <fieldset>
                                                            <!--[if !IE]>start forms<![endif]-->
                                                            <div class="forms">
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Username:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper_custom">
                                                                            <span class="msg_detail"><?= $rowquery['username']; ?></span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Name:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper_custom">
                                                                            <span class="msg_detail"><?= $rowquery['firstname'] . ' ' . $rowquery['lastname']; ?></span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Birthdate:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper_custom">
                                                                            <span  class="msg_detail"><?= arrangedate2($rowquery['birth_date']); ?></span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>City:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper_custom">
                                                                            <span class="msg_detail"><?= $rowquery['city']; ?></span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <?
                                                                $country = $rowquery['country'];
                                                                $qrycou = "select * from countries";
                                                                $rescou = db_query($qrycou);
                                                                while ($cou = db_fetch_array($rescou)) {
                                                                    if ($country == $cou["countryId"]) {
                                                                        $country = $cou["printable_name"];
                                                                    }
                                                                }
                                                                ?>

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Country:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper_custom">
                                                                            <span class="msg_detail"><?= $country; ?></span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Email:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper_custom">
                                                                            <span class="msg_detail">
                                                                                <?= $rowquery['email']; ?>
                                                                            </span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                            </div>
                                                            <!--[if !IE]>end forms<![endif]-->

                                                        </fieldset>
                                                        <!--[if !IE]>end fieldset<![endif]-->
                                                    </form>
                                                    <!--[if !IE]>end forms<![endif]-->




                                                    <h3>Bidding Details</h3>
                                                    <!--[if !IE]>start forms<![endif]-->
                                                    <form action="" method="post" onsubmit="return Check(this)" class="search_form general_form">
                                                        <!--[if !IE]>start fieldset<![endif]-->
                                                        <fieldset>
                                                            <!--[if !IE]>start forms<![endif]-->
                                                            <div class="forms">
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row" style="height:650px;">
                                                                    <div id="accordion">
                                                                        <div>
                                                                            <h3><a href="#">Purchased bids: <span class="msg_detail" style="color:green;">+<strong><?php echo $purchasedBids; ?></strong></span></a></h3>
                                                                            <div>
                                                                                <div  id="product_list">
                                                                                    <div class="table_wrapper">
                                                                                        <div class="table_wrapper_inner">
                                                                                            <?php
                                                                                            $sqlpb = "select bidpack_name,bid_size,freebids,bidpack_price,bidpack_buy_date from bid_account ba inner join bidpack bp on bp.id=ba.bidpack_id where bid_flag='c' and user_id='" . $u_id . "' and recharge_type='re'";

                                                                                            $retpb=  db_query($sqlpb);
                                                                                            ?>
                                                                                            <table cellpadding="0" cellspacing="0" width="100%">
                                                                                                <thead>
                                                                                                    <tr>
                                                                                                        <th>Bid Pack Name</th>
                                                                                                        <th style="text-align:center;">Final Bids</th>
                                                                                                        <th style="text-align:center;">Free Bids</th>
                                                                                                        <th style="text-align:center;">Price</th>
                                                                                                        <th style="text-align:center;">Date</th>
                                                                                                    </tr>
                                                                                                </thead>
                                                                                                <tbody>
                                                                                                    <?php
                                                                                                    while($pbobj= db_fetch_array($retpb)){
                                                                                                    ?>
                                                                                                    <tr>
                                                                                                        <td><?php echo $pbobj['bidpack_name'] ?></td>
                                                                                                        <td style="text-align:center;"><?php echo $pbobj['bid_size'] ?></td>
                                                                                                        <td style="text-align:center;"><?php echo $pbobj['freebids'] ?></td>
                                                                                                        <td style="text-align:center;"><?php echo $pbobj['bidpack_price'] ?></td>
                                                                                                        <td style="text-align:center;"><?php echo arrangedate(substr($pbobj['bidpack_buy_date'], 0, 10)) . " " . substr($pbobj['bidpack_buy_date'], 11); ?></td>
                                                                                                    </tr>
                                                                                                    <?php }?>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div>
                                                                            <h3><a href="#">Sign up bonus: <span class="msg_detail" style="color:green;">+<strong><?php echo $signUpBonus; ?></strong></span></a></h3>
                                                                            <div>
                                                                                <div  id="product_list">
                                                                                    <div class="table_wrapper">
                                                                                        <div class="table_wrapper_inner">
                                                                                            <?php
                                                                                            $sqlsb = "select bid_count,bidpack_buy_date,credit_description from bid_account where bid_flag='c' and user_id='" . $u_id . "' and recharge_type='fr'";

                                                                                            $retsb=  db_query($sqlsb);
                                                                                            ?>
                                                                                            <table cellpadding="0" cellspacing="0" width="100%">
                                                                                                <thead>
                                                                                                    <tr>
                                                                                                        <th>Description</th>
                                                                                                        <th style="text-align:center;">Bids</th>
                                                                                                        <th style="text-align:center;">Date</th>
                                                                                                    </tr>
                                                                                                </thead>
                                                                                                <tbody>
                                                                                                    <?php
                                                                                                    while($sbobj= db_fetch_array($retsb)){
                                                                                                    ?>
                                                                                                    <tr>
                                                                                                        <td><?php echo $sbobj['credit_description'] ?></td>
                                                                                                        <td style="text-align:center;"><?php echo $sbobj['bid_count'] ?></td>
                                                                                                        <td style="text-align:center;"><?php echo arrangedate(substr($sbobj['bidpack_buy_date'], 0, 10)) . " " . substr($sbobj['bidpack_buy_date'], 11); ?></td>
                                                                                                    </tr>
                                                                                                    <?php }?>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div>
                                                                            <h3><a href="#">Admin credits: <span class="msg_detail" style="color:green;">+<strong><?php echo $adminCredits; ?></strong></span></a></h3>
                                                                            <div>
                                                                                <div  id="product_list">
                                                                                    <div class="table_wrapper">
                                                                                        <div class="table_wrapper_inner">
                                                                                            <?php
										  //          $sqlac = "select bid_count,bidpack_buy_date,credit_description from bid_account where bid_flag='c' and user_id='" . $_REQUEST['uid'] . "' and recharge_type='ad'";
    $wherecase = '';
 

    $sqlac = "select user_id,bid_count,bidpack_buy_date,credit_description from bid_account where bid_flag='c' and recharge_type='ad' and user_id = $_REQUEST[uid]";
                                                                                            $retac=  db_query($sqlac);
                                                                                            ?>
                                                                                            <table cellpadding="0" cellspacing="0" width="100%">
                                                                                                <thead>
                                                                                                    <tr>
                                                                                                        <th>Description</th>
                                                                                                        <th style="text-align:center;">Bids</th>
                                                                                                        <th style="text-align:center;">Date</th>
                                                                                                    </tr>
                                                                                                </thead>
                                                                                                <tbody>
                                                                                                    <?php
                                                                                                    while($acobj= db_fetch_array($retac)){
                                                                                                    ?>
                                                                                                    <tr>
                                                                                                        <td><?php echo $acobj['credit_description'] ?></td>
                                                                                                        <td style="text-align:center;"><?php echo $acobj['bid_count'] ?></td>
                                                                                                        <td style="text-align:center;"><?php echo arrangedate(substr($acobj['bidpack_buy_date'], 0, 10)) . " " . substr($acobj['bidpack_buy_date'], 11); ?></td>
                                                                                                    </tr>
                                                                                                    <?php }
												    echo  db_error();
												    ?>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div>
                                                                            <h3><a href="#">Admin Free Points: <span class="msg_detail" style="color:green;">+<strong><?php echo $adminCreditsFree; ?></strong></span></a></h3>
                                                                            <div>
                                                                                <div  id="product_list">
                                                                                    <div class="table_wrapper">
                                                                                        <div class="table_wrapper_inner">
                                                                                            <?php
										  //          $sqlac = "select bid_count,bidpack_buy_date,credit_description from bid_account where bid_flag='c' and user_id='" . $_REQUEST['uid'] . "' and recharge_type='ad'";
    $wherecase = '';
 

    $sqlac = "select user_id,bid_count,bidpack_buy_date,credit_description, recharge_type from free_account where bid_flag='c' and user_id = $_REQUEST[uid] ";
                                                                                            $retac=  db_query($sqlac);
                                                                                            ?>
                                                                                            <table cellpadding="0" cellspacing="0" width="100%">
                                                                                                <thead>
                                                                                                    <tr>
                                                                                                        <th>Description</th>
                                                                                                        <th style="text-align:center;">Bids</th>
                                                                                                        <th style="text-align:center;">Date</th>
                                                                                                    </tr>
                                                                                                </thead>
                                                                                                <tbody>
                                                                                                    <?php
                                                                                                    while($acobj= db_fetch_array($retac)){
												 
                                                                                                    ?>
                                                                                                    <tr>
                                                                                                        <td><?php echo $acobj['credit_description'] ?></td>
                                                                                                        <td style="text-align:center;"><?php echo $acobj['bid_count'] ?></td>
                                                                                                        <td style="text-align:center;"><?php echo arrangedate(substr($acobj['bidpack_buy_date'], 0, 10)) . " " . substr($acobj['bidpack_buy_date'], 11); ?></td>
                                                                                                    </tr>
                                                                                                    <?php }
												    echo  db_error();
												    ?>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div>
                                                                            <h3><a href="#" style="color:green;">Referral Bonus: <span  class="msg_detail" style="color:green;">+<strong><?php echo $referralCredits; ?></strong></span></a></h3>
                                                                            <div>
                                                                                <div  id="product_list">
                                                                                    <div class="table_wrapper">
                                                                                        <div class="table_wrapper_inner" style="margin-top:10px;">
                                                                                            <?php
                                                                                            $sqlrb = "select bid_count,bidpack_buy_date,credit_description from bid_account where bid_flag='c' and user_id='" . $u_id . "' and recharge_type='af'";

                                                                                            $retrb=  db_query($sqlrb);
                                                                                            ?>
                                                                                            <table cellpadding="0" cellspacing="0" width="100%" style="margin-top:120px;">
                                                                                              
                                                                                                    <tr>
                                                                                                        <th>Description</th>
                                                                                                        <th style="text-align:center;">Bids</th>
                                                                                                        <th style="text-align:center;">Date</th>
                                                                                                    </tr>
                                                                                               
                                                                                               
                                                                                                    <?php
                                                                                                    while($rbobj= db_fetch_array($retrb)){
                                                                                                    ?>
                                                                                                    <tr>
                                                                                                        <td><?php echo $rbobj['credit_description'] ?></td>
                                                                                                        <td style="text-align:center;"><?php echo $rbobj['bid_count'] ?></td>
                                                                                                        <td style="text-align:center;"><?php echo arrangedate(substr($rbobj['bidpack_buy_date'], 0, 10)) . " " . substr($rbobj['bidpack_buy_date'], 11); ?></td>
                                                                                                    </tr>
                                                                                                    <?php }?>
                                                                                               
                                                                                            </table>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
								      
                                                                <!--[if !IE]>end row<![endif]-->

                                                                        <div>
                                                                            <h3><a href="#" style="color:green;">Seat Bids: <span  class="msg_detail" style="color:green;">-<strong><?php echo getTotalSeatBids($_REQUEST['uid']); ?></strong></span></a></h3>
                                                                            <div>
                                                                                <div  id="product_list">
                                                                                    <div class="table_wrapper">
                                                                                        <div class="table_wrapper_inner" style="margin-top:10px;">
                                                                                          
                                                                                            <table cellpadding="0" cellspacing="0" width="100%" style="margin-top:120px;">
                                                                                              
                                                                                                    <tr>
                                                                                                        <th>Auction Id</th>
                                                                                                        <th style="text-align:center;">Product Details</th>
                                                                                                        <th style="text-align:center;">Date</th>
                                                                                                        <th style="text-align:center;">Bid Info</th>
                                                                                                        <th style="text-align:center;">Result</th>
                                                                                                    </tr>
                                                                                               
                                                                                               
                                                                                                <?php GetSeatBidsForUser($_REQUEST['uid']); 
    
	      
												?>
                                                                                            </table>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
								      </div>
								    </div>


                                                               <div >
                                                                 <div>
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Total=</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper_custom">
                                                                            <span class="msg_detail" style="color:red;"><strong><?php echo $totalCredits; ?></strong></span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Used=</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper_custom">
                                                                            <span class="msg_detail" style="color:red;"><strong>-<?php echo $usedCredits; ?></strong></span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Remaining=</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper_custom">
                                                                            <span class="msg_detail" style="color:red;"><strong><?php echo $remaining; ?></strong></span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                            </div>
                                                            <!--[if !IE]>end forms<![endif]-->

                                                        </fieldset>
                                                        <!--[if !IE]>end fieldset<![endif]-->
                                                    </form>
                                                    <!--[if !IE]>end forms<![endif]-->

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--[if !IE]>end section content top<![endif]-->
                                <!--[if !IE]>start section content bottom<![endif]-->
                                <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>
                                <!--[if !IE]>end section content bottom<![endif]-->

                            </div>
                            <!--[if !IE]>end section content<![endif]-->
                        </div>
                        <!--[if !IE]>end section<![endif]-->

                        <?php
                                                                                // calculation for order
                                                                                if ($_REQUEST['order']) {
                                                                                    $order = $_REQUEST['order'];
                                                                                }
//calculation for page no
                                                                                if (!$_GET['pgno']) {
                                                                                    $PageNo = 1;
                                                                                } else {
                                                                                    $PageNo = $_GET['pgno'];
                                                                                }
                        ?>
			
                                                                                <!--[if !IE]>start section<![endif]-->
                                                                                <div class="section table_section">
                                                                                    <!--[if !IE]>start title wrapper<![endif]-->

                                                                                    <div class="title_wrapper">
                                                                                        <h2>
                                                                                            Auction Bidding Details
                                                                                        </h2>
                                                                                        <span class="title_wrapper_left"></span>
                                                                                        <span class="title_wrapper_right"></span>
                                                                                    </div>

                                                                                    <!--[if !IE]>end title wrapper<![endif]-->
                                                                                    <!--[if !IE]>start section content<![endif]-->
                                                                                    <div class="section_content">
                                                                                        <!--[if !IE]>start section content top<![endif]-->
                                                                                        <div class="sct">
                                                                                            <div class="sct_left">
                                                                                                <div class="sct_right">
                                                                                                    <div class="sct_left">
                                                                                                        <div class="sct_right">
                                                                                                            <div class="categoryorder">
                                                                                                                <span><a href="view_member_statistics.php?uid=<?= $_GET['uid']; ?>">All</a></span><span class="sp">|</span>
                                                                                                                <span><a href="view_member_statistics.php?order=A&uid=<?= $_GET['uid']; ?>">A</a></span><span class="sp">|</span>
                                                                                                                <span><a href="view_member_statistics.php?order=B&uid=<?= $_GET['uid']; ?>">B</a></span><span class="sp">|</span>
                                                                                                                <span><a href="view_member_statistics.php?order=C&uid=<?= $_GET['uid']; ?>">C</a></span><span class="sp">|</span>
                                                                                                                <span><a href="view_member_statistics.php?order=D&uid=<?= $_GET['uid']; ?>">D</a></span><span class="sp">|</span>
                                                                                                                <span><a href="view_member_statistics.php?order=E&uid=<?= $_GET['uid']; ?>">E</a></span><span class="sp">|</span>
                                                                                                                <span><a href="view_member_statistics.php?order=F&uid=<?= $_GET['uid']; ?>">F</a></span><span class="sp">|</span>
                                                                                                                <span><a href="view_member_statistics.php?order=G&uid=<?= $_GET['uid']; ?>">G</a></span><span class="sp">|</span>
                                                                                                                <span><a href="view_member_statistics.php?order=H&uid=<?= $_GET['uid']; ?>">H</a></span><span class="sp">|</span>
                                                                                                                <span><a href="view_member_statistics.php?order=I&uid=<?= $_GET['uid']; ?>">I</a></span><span class="sp">|</span>
                                                                                                                <span><a href="view_member_statistics.php?order=J&uid=<?= $_GET['uid']; ?>">J</a></span><span class="sp">|</span>
                                                                                                                <span><a href="view_member_statistics.php?order=K&uid=<?= $_GET['uid']; ?>">K</a></span><span class="sp">|</span>
                                                                                                                <span><a href="view_member_statistics.php?order=L&uid=<?= $_GET['uid']; ?>">L</a></span><span class="sp">|</span>
                                                                                                                <span><a href="view_member_statistics.php?order=M&uid=<?= $_GET['uid']; ?>">M</a></span><span class="sp">|</span>
                                                                                                                <span><a href="view_member_statistics.php?order=N&uid=<?= $_GET['uid']; ?>">N</a></span><span class="sp">|</span>
                                                                                                                <span><a href="view_member_statistics.php?order=O&uid=<?= $_GET['uid']; ?>">O</a></span><span class="sp">|</span>
                                                                                                                <span><a href="view_member_statistics.php?order=P&uid=<?= $_GET['uid']; ?>">P</a></span><span class="sp">|</span>
                                                                                                                <span><a href="view_member_statistics.php?order=Q&uid=<?= $_GET['uid']; ?>">Q</a></span><span class="sp">|</span>
                                                                                                                <span><a href="view_member_statistics.php?order=R&uid=<?= $_GET['uid']; ?>">R</a></span><span class="sp">|</span>
                                                                                                                <span><a href="view_member_statistics.php?order=S&uid=<?= $_GET['uid']; ?>">S</a></span><span class="sp">|</span>
                                                                                                                <span><a href="view_member_statistics.php?order=T&uid=<?= $_GET['uid']; ?>">T</a></span><span class="sp">|</span>
                                                                                                                <span><a href="view_member_statistics.php?order=U&uid=<?= $_GET['uid']; ?>">U</a></span><span class="sp">|</span>
                                                                                                                <span><a href="view_member_statistics.php?order=V&uid=<?= $_GET['uid']; ?>">V</a></span><span class="sp">|</span>
                                                                                                                <span><a href="view_member_statistics.php?order=W&uid=<?= $_GET['uid']; ?>">W</a></span><span class="sp">|</span>
                                                                                                                <span><a href="view_member_statistics.php?order=X&uid=<?= $_GET['uid']; ?>">X</a></span><span class="sp">|</span>
                                                                                                                <span><a href="view_member_statistics.php?order=Y&uid=<?= $_GET['uid']; ?>">Y</a></span><span class="sp">|</span>
                                                                                                                <span><a href="view_member_statistics.php?order=Z&uid=<?= $_GET['uid']; ?>">Z</a></span>
                                                                                                            </div>

                                                                                                            <div  id="product_list">
                                                                                                                <!--[if !IE]>start table_wrapper<![endif]-->
                                                                                                                <div class="table_wrapper">
                                                                                                                    <div class="table_wrapper_inner">
                                                                <?php
                                                                                $auctionbid = "select p.name as pname,a.auctionID as aucid,a.auc_status as aucstat,Date_format(a.auc_start_date,'%d/%m/%Y') as aucstartdate,Date_format(a.auc_final_end_date,'%d/%m/%Y') as aucfinalenddate,SUM(b.bid_count) as bidtotal,a.bidpack as is_bid_pack,a.productID as product_id from bid_account b left join auction a on b.auction_id=a.auctionID left join products p on a.productID=p.productID where b.user_id='" . $rowquery['id'] . "' and bid_flag='d' and p.name like '$order%' group by a.auctionID order by bidtotal desc";
                                                                                $resauctionbid = db_query($auctionbid) or die(db_error());
                                                                                $PRODUCTSPERPAGE = 10;
                                                                                $resauctionbid = db_query($auctionbid);
                                                                                $total = db_num_rows($resauctionbid);
                                                                                $totalpage = ceil($total / $PRODUCTSPERPAGE);
//echo $totalpage;
                                                                                if ($totalpage >= 1) {
                                                                                    $startrow = $PRODUCTSPERPAGE * ($PageNo - 1);
                                                                                    $auctionbid.=" LIMIT $startrow,$PRODUCTSPERPAGE";
//echo $sql;
                                                                                    $resauctionbid = db_query($auctionbid);
                                                                                    $totalauctionbid = db_num_rows($resauctionbid);
                                                                                }
                                                                                if ($totalauctionbid <= 0) {
                                                                ?>
                                                                                    <ul class="system_messages">
                                                                                        <li class="blue"><span class="ico"></span><strong class="system_title">No Auction Bidding Details To Display.</strong></li>
                                                                                    </ul>
                                                                <?php } else {
                                                                ?>
                                                                                    <table cellpadding="0" cellspacing="0" width="100%">
                                                                                        <tbody>
                                                                                            <tr>
												<th>Auction Id</th>
                                                                                                <th>Auction Name</th>
                                                                                                <th style="text-align:center;">Start Date</th>
                                                                                                <th style="text-align:center;">End Date</th>
                                                                                                <th style="text-align:center;">Auction Status</th>
                                                                                                <th style="text-align:center;">Bid Placed</th>
                                                                                                <th style="text-align:center;">Bid Status</th>
                                                                                            </tr>
                                                                        <?
                                                                                    $i = 1;
                                                                                    while ($rowauctionbid = db_fetch_array($resauctionbid))
																												{
																													//////////////////////////////////////////////////////////////////////////////////
																													/// Begin Bugfix
																													/// Clear Idea Technology
																													/// Trent Raber
																													/// 2012-05-03
																													/// Fix to display the correct product name in the Bidding Details area
																													//////////////////////////////////////////////////////////////////////////////////

																													if( $rowauctionbid['is_bid_pack'] > 0 )
																													{
																														$sSql = "SELECT * FROM bidpack WHERE `id`='".$rowauctionbid['product_id']."'";

																														$aBidPack = db_fetch_array( db_query( $sSql ) );

																														$sProdName = $aBidPack['bidpack_name'];
																													}
																													else
																													{
																														$sProdName = $rowauctionbid['pname'];
																													}
																													//////////////////////////////////////////////////////////////////////////////////
																													/// End Bugfix
																													//////////////////////////////////////////////////////////////////////////////////
                                                                        ?>
                                                                                        <tr class="<?php echo ($i == 1 ) ? 'first' : 'second'; ?>">
											  <td><?php echo $rowauctionbid['aucid'];?> </td>
                                                                                            <td><?= $sProdName ?></td>
                                                                                            <td style="text-align:center;"><?= $rowauctionbid['aucstartdate'] == "00/00/0000" ? "-" : $rowauctionbid['aucstartdate']; ?></td>
                                                                                            <td style="text-align:center;"><?= $rowauctionbid['aucfinalenddate'] == "00/00/0000" ? "-" : $rowauctionbid['aucfinalenddate']; ?></td>
                                                                                            <td style="text-align:center;">
                                                                                <?
                                                                                        if ($rowauctionbid['aucstat'] == 1) {
                                                                                            echo "<font color=green>Pending</font>";
                                                                                        }
                                                                                        if ($rowauctionbid['aucstat'] == 2) {
                                                                                            echo "<font color=red>Running</font>";
                                                                                        }
                                                                                        if ($rowauctionbid['aucstat'] == 3) {
                                                                                            echo "<font color=blue>Sold</font>";
                                                                                        }
                                                                                ?>
                                                                                    </td>
                                                                                    <td style="text-align:center;"><?= $rowauctionbid['bidtotal']; ?></td>
                                                                                    <td style="text-align:center;"><?= GetWonAuctionStatus($rowauctionbid['aucid'], $rowauctionbid['aucstat'], $rowquery['id']) ?></td>

                                                                                </tr>
                                                                        <?php
                                                                                        $i = $i * -1;
                                                                                    }
                                                                        ?>

                                                                                </tbody>
                                                                            </table>
                                                                <?php } ?>
                                                                            </div>
                                                                        </div>
                                                                        <!--[if !IE]>end table_wrapper<![endif]-->
                                                                    </div>

                                                    <?php if ($total) {
                                                    ?>
                                                                                    <!--[if !IE]>start pagination<![endif]-->
                                                                                    <div class="pagination">
                                                                                        <span class="page_no">Page <?php echo $PageNo; ?> of <?php echo $totalpage; ?></span>
                                                                                        <ul class="pag_list">
                                                            <?php
                                                                                    if ($PageNo > 1) {
                                                                                        $PrevPageNo = $PageNo - 1;
                                                            ?>
                                                                                        <li><a href="view_member_statistics.php?pgno=<?= $PrevPageNo; ?>&order=<?= $order ?>&uid=<?= $_GET['uid']; ?>" class="button light_blue_btn"><span><span>PREVIOUS</span></span></a> </li>
                                                            <?php } ?>

                                                            <?php
                                                                                    $pageFrom = $PageNo - 3 < 1 ? 1 : $PageNo - 3;
                                                                                    $pageTo = $PageNo + 3 > $totalpage ? $totalpage : $PageNo + 3;
                                                                                    for ($i = $pageFrom; $i <= $pageTo; $i++) {
                                                            ?>
                                                            <?php if ($i == $PageNo) {
 ?>
                                                                                            <li><a href="view_member_statistics.php?pgno=<?= $i; ?>&order=<?= $order ?>&uid=<?= $_GET['uid']; ?>" class="current_page"><span><span><?php echo $i; ?></span></span></a></li>
                                                            <?php } else { ?>
                                                                                            <li><a href="view_member_statistics.php?pgno=<?= $i; ?>&order=<?= $order ?>&uid=<?= $_GET['uid']; ?>"><?php echo $i; ?></a></li>
                                                            <?php
                                                                                        }
                                                                                    }
                                                            ?>
                                                            <?php
                                                                                    if ($PageNo < $totalpage) {
                                                                                        $NextPageNo = $PageNo + 1;
                                                            ?>
                                                                                        <li><a href="view_member_statistics.php?pgno=<?= $NextPageNo; ?>&order=<?= $order ?>&uid=<?= $_GET['uid']; ?>" class="button light_blue_btn"><span><span>NEXT</span></span></a> </li>
                                                            <?php } ?>
                                                                                </ul>

                                                                            </div>
                                                                            <!--[if !IE]>end pagination<![endif]-->
                                                    <?php } ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--[if !IE]>end section content top<![endif]-->
                                                            <!--[if !IE]>start section content bottom<![endif]-->
                                                            <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>
                                                            <!--[if !IE]>end section content bottom<![endif]-->

                                                        </div>
                                                        <!--[if !IE]>end section content<![endif]-->
                                                    </div>
                                                    <!--[if !IE]>end section<![endif]-->

                                                </div>
                                            </div>
                                            <!--[if !IE]>end page<![endif]-->
                                            <!--[if !IE]>start sidebar<![endif]-->
                                            <div id="sidebar">
                                                <div class="inner">
                        <?php include 'include/leftside.php' ?>
                                                                            </div>
                                                                        </div>
                                                                        <!--[if !IE]>end sidebar<![endif]-->

                                                                    </div>
                                                                    <!--[if !IE]>end content<![endif]-->

                                                                </div>
                                                                <!--[if !IE]>end wrapper<![endif]-->

                                                                <!--[if !IE]>start footer<![endif]-->
                                                                <div id="footer">
                                                                    <div id="footer_inner">
                <?php include 'include/footer.php'; ?>
            </div>
        </div>
        <!--[if !IE]>end footer<![endif]-->

    </body>
</html>