<?
session_start();
$active="Report";
include_once("admin.config.inc.php");
include("connect.php");
include("functions.php");
include("security.php");

$aid = $_GET["aid"];

if($aid!="") {
    $qrysel = "select * from auction a left join products p on a.productID=p.productID and a.bidpack=0 left join bidpack b on a.productID=b.id and a.bidpack=1 left join registration r on a.buy_user=r.id  where a.auctionID='$aid'";
    $ressel = db_query($qrysel);
    $total = db_num_rows($ressel);
    $obj = db_fetch_object($ressel);

    if($obj->fixedpriceauction=="1") {
        $type = "Fixed Price Auction";
    }
    if($obj->pennyauction=="1") {
        if($type=="") {
            $type = "Cent Auction";
        } else {
            $type .= ", Cent Auction";
        }
    }

    if($obj->nailbiterauction=="1") {
        if($type=="") {
            $type = "NailBiter Auction";
        } else {
            $type .= ", NailBiter Auction";
        }
    }

    if($obj->offauction=="1") {
        if($type=="") {
            $type = "100% Off Auction";
        } else {
            $type .= ", 100% Off Auction";
        }
    }

    if($obj->nightauction=="1") {
        if($type=="") {
            $type = "Night Auction";
        } else {
            $type .= ", Night Auction";
        }
    }

    if($obj->openauction=="1") {
        if($type=="") {
            $type = "Open Auction";
        } else {
            $type .= ", Open Auction";
        }
    }


    if($obj->time_duration=="none") {
        $duration = "Default";
    }
    elseif($obj->time_duration=="10sa") {
        $duration = "10 Second Auction";
    }
    elseif($obj->time_duration=="15sa") {
        $duration = "15 Second Auction";
    }
    elseif($obj->time_duration=="20sa") {
        $duration = "20 Second Auction";
    }

    if($obj->auc_status=="2" || $obj->auc_status=="1") {
        $status = "<font color='red'>Active</font>";
    }
    elseif($obj->auc_status=="4") {
        $status = "<font color='green'>Pending</font>";
    }
    elseif($obj->auc_status=="3") {
        $status = "<font color='blue'>Sold</font>";
    }

    $numberbids = explode("|",GetBidsDetails($aid));
    $biddingprice = $numberbids[0]*0.50;

    if($obj->fixedpriceauction=="1") {
        $priceauc = $obj->auc_fixed_price;
        $prodprice = $obj->price;
        $prloss = $priceauc + $biddingprice - $prodprice;
    }
    elseif($obj->offauction=="1") {
        $priceauc = 0.01;
        $prodprice = $obj->price;
        $prloss = $priceauc + $biddingprice - $prodprice;
    }
    else {
        $priceauc = $obj->auc_final_price;
        $prodprice = $obj->price;
        $prloss = $priceauc + $biddingprice - $prodprice;
    }

    if($prloss<0) {
        $prloss1 = "<font color='red'>-".$Currency.number_format(substr($prloss,1),2)."</font>";
    }
    else {
        $prloss1 = "<font color='green'>".$Currency.number_format($prloss,2)."</font>";
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="imagetoolbar" content="no" />
        <title>Auction Details-<?php echo $ADMIN_MAIN_SITE_NAME ?></title>
        <link media="screen" rel="stylesheet" type="text/css" href="css/admin.css"  />
        <link type="text/css" href="css/cupertino/ui.all.css" rel="stylesheet" />
        <!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
        <script type="text/javascript" src="js/behaviour.js"></script>    
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
                                <h2>Auction Details</h2>
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

                                                    <!--[if !IE]>start forms<![endif]-->
                                                    <form name="f1" action="" method="post" onsubmit="return Check(this)" class="search_form general_form">
                                                        <!--[if !IE]>start fieldset<![endif]-->
                                                        <fieldset>
                                                            <!--[if !IE]>start forms<![endif]-->
                                                            <div class="forms">
                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Auction Name:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper_custom">
                                                                            <span class="msg_detail"><?=stripslashes($obj->bidpack?$obj->bidpack_name:$obj->name);;?></span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Auction Type:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper_custom">
                                                                            <span class="msg_detail"><?=$type;?></span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Auction Status:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper_custom">
                                                                            <span  class="msg_detail"><?=$status;?></span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Auction Duration:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper_custom">
                                                                            <span class="msg_detail"><?=$duration;?></span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Auction Start Date:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper_custom">
                                                                            <span class="msg_detail"><?=ChangeDateFormatSlash($obj->auc_start_date);?></span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Auction End Date:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper_custom">
                                                                            <span class="msg_detail">
                                                                            <?php if($obj->auc_status=="3") {
                                                                                $enddate = $obj->auc_final_end_date;
                                                                            }
                                                                            else {
                                                                                $enddate = $obj->auc_end_date;
                                                                            }?>
                                                                            <?=ChangeDateFormatSlash($enddate);?>
                                                                            </span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Auction Start Price:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper_custom">
                                                                            <span class="msg_detail"><?=$Currency.$obj->auc_start_price;?></span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Auction Fixed Price:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper_custom">
                                                                            <span class="msg_detail"><?=$Currency.$obj->auc_fixed_price;?></span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Auction End Price:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper_custom">
                                                                            <span  class="msg_detail"><?=$Currency.$obj->auc_final_price;?></span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Winner:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper_custom">
                                                                            <span class="msg_detail"><?=$obj->username;?></span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <!--[if !IE]>end row<![endif]-->

                                                                <!--[if !IE]>start row<![endif]-->
                                                                <div class="row">
                                                                    <label>Profit/Loss:</label>
                                                                    <div class="inputs">
                                                                        <span class="input_wrapper_custom">
                                                                            <span class="msg_detail"><?=$prloss1;?></span>
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
                        if($obj->use_free==1) {
                            $qry = "select *,sum(bid_count) as bidcount from free_account ba left join registration r on ba.user_id=r.id where auction_id='$aid' and bid_flag='d' group by user_id";
                        }
                        else {
                            $qry = "select *,sum(bid_count) as bidcount from bid_account ba left join registration r on ba.user_id=r.id where auction_id='$aid' and bid_flag='d' group by user_id";
                        }
                        $re = db_query($qry);
                        $total = db_num_rows($re);
                        if($obj->auc_status=="3" || $obj->auc_status=="2") {
                            ?>
                        <!--[if !IE]>start section<![endif]-->
                        <div class="section table_section">
                            <!--[if !IE]>start title wrapper<![endif]-->

                            <div class="title_wrapper">
                                <h2>
                                    Bidding History
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
                                                    <div  id="product_list">
                                                        <!--[if !IE]>start table_wrapper<![endif]-->
                                                        <div class="table_wrapper">
                                                            <div class="table_wrapper_inner">
                                                                    <?php if($total==0) { ?>
                                                                <ul class="system_messages">
                                                                    <li class="blue"><span class="ico"></span><strong class="system_title">No Bidding History To Display..</strong></li>
                                                                </ul>
                                                                        <?php }else {?>
                                                                <table cellpadding="0" cellspacing="0" width="100%">
                                                                    <tbody>
                                                                        <tr>
                                                                            <th>User Name</th>
                                                                            <th>First Name</th>
                                                                            <th>Email Address</th>
                                                                            <th style="text-align:center;">Single Bids</th>
                                                                            <th style="text-align:center;">AutoBidders</th>
                                                                            <th style="text-align:center;">Placed Bids</th>
                                                                        </tr>
                                                                                <?
                                                                                $i=1;
                                                                                while($ob = db_fetch_object($re)) {
                                                                                    if($ob->admin_user_flag=='1') {
                                                                                        $clsname = " class='a' ";
                                                                                    }
                                                                                    else {
                                                                                        $clsname = "";
                                                                                    }

                                                                                    if ($colorflg==1) {
                                                                                        $colorflg=0;
                                                                                        echo "<TR bgcolor=\"#f4f4f4\" ".$clsname."> ";
                                                                                    }else {
                                                                                        $colorflg=1;
                                                                                        echo "<TR ".$clsname.">";
                                                                                    }

                                                                                    if($obj->use_free==1) {
                                                                                        $qrb = "select *,sum(bid_count) as butlerbid from free_account where auction_id='$aid' and user_id='".$ob->user_id."' and bidding_type='b' group by user_id";
                                                                                    }
                                                                                    else {
                                                                                        $qrb = "select *,sum(bid_count) as butlerbid from bid_account where auction_id='$aid' and user_id='".$ob->user_id."' and bidding_type='b' group by user_id";
                                                                                    }
                                                                                    $rb = db_query($qrb);
                                                                                    $butler = db_fetch_object($rb);

                                                                                    if($obj->use_free==1) {
                                                                                        $qrb1 = "select *,sum(bid_count) as singlebid from free_account where auction_id='$aid' and user_id='".$ob->user_id."' and bidding_type='s' group by user_id";
                                                                                    }
                                                                                    else {
                                                                                        $qrb1 = "select *,sum(bid_count) as singlebid from bid_account where auction_id='$aid' and user_id='".$ob->user_id."' and bidding_type='s' group by user_id";
                                                                                    }
                                                                                    $rb1 = db_query($qrb1);
                                                                                    $butler1 = db_fetch_object($rb1);

                                                                                    $totalbids = $ob->bidcount + $bids;
                                                                                    $butlerbids = $butler->butlerbid + $butbids;
                                                                                    $singlebids = $butler1->singlebid + $singbids;
                                                                                    ?>
                                                                        <tr class="<?php echo ($i ==1 )?'first':'second'; ?>">
                                                                            <td><?=$ob->username;?></td>
                                                                            <td><?=$ob->firstname; ?></td>
                                                                            <td><?=$ob->email;?></td>
                                                                            <td style="text-align:center;"><?=$butler1->singlebid!=""?$butler1->singlebid:"0";?></td>
                                                                            <td style="text-align:center;"><?=$butler->butlerbid!=""?$butler->butlerbid:"0";?></td>
                                                                            <td style="text-align:center;"><?=$ob->bidcount;?></td>

                                                                        </tr>
                                                                                    <?php
                                                                                    $bids = $totalbids;
                                                                                    $butbids = $butlerbids;
                                                                                    $singbids = $singlebids;
                                                                                    $i=$i*-1;
                                                                                }
                                                                                ?>

                                                                        <tr>
                                                                            <th colspan="3" style="text-align:right;">Total Bids:</th>
                                                                            <td align="center"><?=$singlebids;?></td>
                                                                            <td align="center"><?=$butlerbids;?></td>
                                                                            <td align="center" nowrap="nowrap"><?=$totalbids;?><?php /*?><br />(<?=$numberbids[0]!=""?$numberbids[0]:"0";?> + <font class="a"><?=$numberbids[1]!=""?$numberbids[1]:"0";?></font>)<?php */?></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                        <?php }?>
                                                            </div>
                                                        </div>
                                                        <!--[if !IE]>end table_wrapper<![endif]-->
                                                    </div>


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

                            <?php } ?>

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