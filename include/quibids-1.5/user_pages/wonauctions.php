
        <div id="pagewidth">
            <!-- ============= Header =============  -->
            <?php include $BASE_DIR . '/include/' . $template . '/header.php'; ?>
            <!-- ============= End Header =============  -->

              <div id="wrapper" class="clearfix" >
                <div id="maincol">
                    <!-- ============= MyQuibids nav =============  -->
                    <ul id="myqb-nav">
                        <li ><a href="myaccount.php" class="active"><span><?php echo 'MY ACCOUNT'; ?></span></a></li>
                    </ul>
                    <!-- ============= End MyQuibids nav =============  -->
                    <!-- ============= MyQuibids wrap =============  -->
                    <div id="myqb-wrap">
                        <div id="myqb">

                            <!-- ============= Recently Won Auctions =============  -->
                            <h1><?php echo WON_AUCTIONS; ?></h1>
                            <div class="clear"></div>

                            <div id="myqb-auctions">
                                <div id="myqb-auctions-head">
                                    <div id="product_title" style="width:280px;"><?php echo PRODUCTS; ?></div>
                                    <div id="price_title" style="width:130px;"><?php echo PRICE; ?></div>
                                    
                                    <div id="countdown_title" style="width:90px;"><?php echo PAYMENT; ?></div>
                                </div>

                                <?php
                                if ($totalauc > 0) {
                                    $counter = 1;
                                    while ($obj = db_fetch_array($ressel)) {
                                        $qryshipping = "select * from shipping where id='" . $obj["shipping_id"] . "'";
                                        $resshipping = db_query($qryshipping);
                                        $objshipping = db_fetch_array($resshipping);

                                        if ($obj["fixedpriceauction"] == "1") {
                                            $finalprice = $obj["auc_fixed_price"];
                                        } elseif ($obj["offauction"] == "1") {
                                            $finalprice = "0.00";
                                        } else {
                                            $finalprice = $obj["auc_final_price"];
                                        }

                                        $expiry = AcceptDateFunctionStatus($obj["won_date"]);

                                        $todaytime = time();
                                        $expirytime = mktime($expiry["Hour"], $expiry["Min"], $expiry["Sec"], $expiry["Month"], $expiry["Day"], $expiry["Year"]);
                                        $dateDiff = $todaytime - $expirytime;

                                        if ($todaytime > $expirytime) {
                                            $new_status = "Expire";
                                        } else {
                                            $new_status = "Running";
                                        }

                                        /* 					$fullDays = floor($dateDiff/(60*60*24));
                                          if ($fullDays>0) {
                                          $new_status = "Expire";
                                          } else {
                                          $new_status = "Running";
                                          } */

                                        $expirywon = AcceptDateFunctionStatus($obj["accept_date"]);

                                        $todaywontime = time();
                                        $expirywontime = mktime($expirywon["Hour"], $expirywon["Min"], $expirywon["Sec"], $expirywon["Month"], $expirywon["Day"], $expirywon["Year"]);
                                        $wondateDiff = $todaywontime - $expirywontime;

                                        if ($todaywontime > $expirywontime) {
                                            $new_status_won = "Expire";
                                        } else {
                                            $new_status_won = "Running";
                                        }
                                       $wonfullDays = floor($dateDiff/(60*60*24));
                                          if ($wonfullDays>0) {
                                          $new_status_won = "Expire";
                                          } else {
                                          $new_status_won = "Running";
                                          } 
                                ?>

                                        <div>
                                            <div class="live-auction" style="background-color: white;">
                                                <a href="viewproduct.php?aid=<?php echo $obj["auctionID"]; ?>" class="thumb" style="background-image: url(<?php echo $UploadImagePath; ?>products/thumbs_small/thumbsmall_<?php echo $obj["picture1"]; ?>);"></a>
                                                <div class="live-a-content" style="width:200px;">
                                                    <h2>
                                                        <a href="viewproduct.php?aid=<?php echo $obj["auctionID"]; ?>"><?php echo stripslashes($obj["name"]); ?></a>
                                                    </h2>
                                                    <br/>
                                                    <p><?php echo stripslashes($obj['short_desc']); ?></p>
                                                </div>
                                                <div class="price-bidder" style="width:120px;">
                                                    <label><?php echo $Currency.number_format($finalprice,2);?></label>
                                                    <span><?php echo $Currency.$objshipping["shippingcharge"];?>&nbsp;<?php echo DELIVERY_CHARGE;?></span>
                                                    <span><?php include("modules/gateways/taxes.php"); ?></span>
                                                </div>

                                                

                                                <div class="countdown" style="width:120px;text-align: center;color:#2cab00;padding-top:36px; margin-left:81px;">

<?php if($obj['payment_date']!='0000-00-00 00:00:00') {?>
                                <label style="font-size:12px;" id="wonpayment">
                                        <?php $paydate = arrangedate(substr($obj['payment_date'],0,10)); ?><?php echo $paydate?><br />
                                        <?php echo substr($obj['payment_date'],11)?><br/>                                       

                                        <?php if ($obj['ssid'] != '') {
                                            ?>
                                                <span style="font-size:11px;font-weight:normal;">
                                                <a href="<?php echo $obj['sturl']; ?>"><img alt="" width="120" src="uploads/other/<?php echo $obj['stlogoimage']; ?>" border="0"/></a><br/>
                                                <?php echo TRACK_NUMBER; ?>:<br/>
                                                <?php echo $obj['tracknumber']; ?>
                                            </span>
                                            <?php } else {
                                            ?>
                                                <span class="greenfont">
                                                    <strong><?php echo PAID .'<br/>'. NOT_SHIPPED; ?></strong>
                                                </span>
                                            <?php } ?>



                                </label>
                                            <?php }else { ?>
                                                    
                                <label style="font-size:12px;" id="makepayment_<?php echo $obj["auction_id"]?>">
                                                <?php if($new_status_won=="Running") { ?>
                                                    <?php if($totalvou>0) { ?>
                                    <a class="loginfirst" name="makepayment" onclick="window.location.href='choosevoucher.php?winid=<?php echo base64_encode($finalprice."&".$obj["auctionID"]);?>'"><?php echo MAKE_PAYMENT;?></a>
                                                        <?php } else { ?>
                                    <a class="loginfirst" name="makepayment" onclick="window.location.href='paymentmethod.php?winid=<?php echo base64_encode($finalprice."&".$obj["auctionID"]);?>'"><?php echo MAKE_PAYMENT;?></a>
                                                        <?php } ?>
                                                    <?php } else { ?>
                                    
                                                        <?php echo AUCTION_PAYMENT; ?><br />
                                                        <?php echo PERIOD_IS_OVER; ?>
                                                        <?php } ?>

                                </label>
                                            <?php } ?>
                                                </div>

                                                <div class="clear"></div>
                                            </div>

                                        </div>

                                <?php $counter++; } ?>

                                <?php } else {
 ?>

                                    <br/><center><h3><?php echo SORRY_YOU_DONT_WON_ANY_AUCTION_YET; ?></h3></center>
                                <?php
                                }
                                db_free_result($ressel);
                                ?>
                                <div id="live-auctions-end">

                                    <?php if ($totalpage > 0) { ?>
                                        <table align="right">
                                            <tbody>
                                                <tr>
                                                    <td valign="middle">
                                                        <div style="margin-top: 15px;" id="pagenumber_display"><?php echo TOTAL . ' ' . $total . ' ' . AUCTIONS ?>, <?php echo $PageNo . ' ' . OF . ' ' . $totalpage . ' ' . PAGES; ?> </div>
                                                    </td>
                                                    <td width="30">&nbsp;</td>
                                                    <td valign="middle">
                                                        <span id="pagination">
                                                        <?php if ($PageNo > 1) {
 ?>
                                                            <a style="width: 50px;" id="prev" href="wonauctions.php?pgno=<?php echo $PageNo - 1; ?>"><?php echo PREVIOUS; ?></a>
<?php } else { ?>
                                                            <a style="width: 50px;" id="prev"><span style="color: rgb(192, 192, 192);"><?php echo PREVIOUS; ?></span></a>
<?php } ?>

                                                        &nbsp;

                                                        <?php
                                                        $pagestart = $PageNo - 3;
                                                        if ($pagestart < 1) {
                                                            $pagestart = 1;
                                                        }

                                                        $pageend = $pagestart + 7;
                                                        if ($pageend > $totalpage) {
                                                            $pageend = $totalpage;
                                                        }

                                                        for ($page = $pagestart; $page <= $pageend; $page++) {
                                                        ?>
                                                            <a href="wonauctions.php?pgno=<?php echo $page; ?>" class="<?php echo $page == $PageNo ? 'selected' : ''; ?>"><?php echo $page; ?></a>&nbsp;
<?php } ?>


                                                        <?php if ($PageNo < $totalpage) { ?>
                                                            <a id="next" href="wonauctions.php?pgno=<?php echo $PageNo + 1; ?>"><?php echo NEXT; ?></a>
                                                        <?php } else {
                                                        ?>
                                                            <a id="next"><span style="color: rgb(192, 192, 192);"><?php echo NEXT; ?></span></a>
                                                        <?php } ?>

                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <?php } ?>

                                                </div>
                                            </div>
                                            <!-- ============= /Recently Won Auctions =============  -->


                                        </div>
                                        <!-- ============= Left Navigation =============  -->

                        <?php include $BASE_DIR . '/include/' . $template . '/mybid_nav.php'; ?>

                                                    <!-- ============= End Left Navigation =============  -->
                                                    <div class="clear"></div>
                                                    <div id="myqb-end"></div>
                                                </div>
                                                <!-- ============= End MyQuibids wrap =============  -->
                                            </div>
                                        </div>
                                        <div id="wrap-end"></div>
                                    </div> <!--end pagewidth-->

        <?php include $BASE_DIR . '/include/' . $template . '/footer.php' ?>
