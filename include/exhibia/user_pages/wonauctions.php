 
        <div id="main">
            <?php include("header.php"); ?>
            <div id="container">
                <?php include("include/topmenu.php"); ?>
                <div class="tab-area">
                <div id="column-right">
                    <?php include("include/searchbox.php"); ?>
                    <div id="title-category-content">
                        <?php include("include/categorymenu.php"); ?>
                        <p class="bid-title"><em><?php echo WON_AUCTIONS; ?></em></p>
                    </div><!-- /title-category-content -->
                    <div id="mybids-box" class="content">
                        <?
                        if ($total > 0) {
                        ?>
                            <div class="may_imagetext">
                                <div class="may_textimage"><?php echo IMAGE; ?></div>
                                <div class="may_description"><?php echo DESCRIPTION; ?></div>
                                <div class="may_textprise"><?php echo PRICE; ?></div>
                                <div class="may_textbidder"><?php echo ACCEPT_DENIED; ?></div>
                                <div class="may_countdown"><?php echo PAYMENT; ?></div>
                            </div>
                        <?
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

                                $cornerImag = cornerImag($obj);

                               

                                

                                $pname = $obj['bidpack'] ? $obj['bidpack_name'] : $obj['name'];
                                $picture = $obj['bidpack'] ? $obj['bidpack_banner'] : $obj['picture1'];
                                $price = $obj['bidpack'] ? $obj['bidpack_price'] : $obj['price'];
                                $short_desc = $obj['bidpack'] ? "{$obj['bid_size']} Bids and {$obj['freebids']} Freebids" : $obj['short_desc'];
                                /* 					$wonfullDays = floor($dateDiff/(60*60*24));
                                  if ($wonfullDays>0) {
                                  $new_status_won = "Expire";
                                  } else {
                                  $new_status_won = "Running";
                                  } */
                        ?>
                                <div class="may_bidbox">
                            <?php if ($cornerImag != '') {
                            ?>
                                    <div class="corner_imagev2">
                                        <img src="img/icons/<?php echo $cornerImag; ?>"  alt=""/>
                                    </div>
                            <?php } ?>
                                <div class="smollimagebox">
                                <?php if ($obj['uniqueauction'] == false) {
 ?>
                                    <a href="<?php echo SEOSupport::getProductUrl($pname, $obj["auctionID"], 'n'); ?>">
                                        <img src="<?php echo $UploadImagePath; ?>products/thumbs_small/thumbsmall_<?php echo $picture; ?>" alt="product"  border="0" />
                                    </a>
<?php } else { ?>
                                    <a href="<?php echo SEOSupport::getProductUrl($pname, $obj["auctionID"], 'l'); ?>">
                                        <img src="<?php echo $UploadImagePath; ?>products/thumbs_small/thumbsmall_<?php echo $picture; ?>" alt="product"  border="0" />
                                    </a>
<?php } ?>
                            </div>
                            <div class="may_drestext">
                                <span>
<?php if ($obj['uniqueauction'] == false) { ?>
                                    <a href="<?php echo SEOSupport::getProductUrl($pname, $obj["auctionID"], 'n'); ?>" class="prodtitle"><?php echo stripslashes($pname); ?></a>
<?php } else { ?>
                                    <a href="<?php echo SEOSupport::getProductUrl($pname, $obj["auctionID"], 'l'); ?>" class="prodtitle"><?php echo stripslashes($pname); ?></a>
<?php } ?>

                                </span>
                                <br />
                                <br />
                                <?php echo stripslashes(choose_short_desc($short_desc, 90)); ?>
<?php if ($obj['uniqueauction'] == false) { ?>
                                    <a href="<?php echo SEOSupport::getProductUrl($pname, $obj["auctionID"], 'n'); ?>" class="linkmore1"><?php echo MORE; ?></a>
<?php } else { ?>
                                    <a href="<?php echo SEOSupport::getProductUrl($pname, $obj["auctionID"], 'l'); ?>" class="linkmore1"><?php echo MORE; ?></a>
<?php } ?>
                            </div>
                            <div class="prisebox" align="center">

                                <span class="style3" style="font-size:9px;">
<?php echo AUCTION_PRICE; ?>:<?php echo $Currency . number_format($finalprice, 2); ?>
                                </span><br />
<span><?php include("modules/gateways/taxes.php"); ?></span><br />
                                <span class="style3" style="font-size:9px;">
<?php echo DELIVERY_CHARGE; ?>:<?php echo $Currency . $objshipping["shippingcharge"]; ?>
                                </span><br/>

                                <span class="style3" style="font-size:11px;">
<?php echo TOTAL_PRICE; ?>:<?php echo $Currency . number_format(($objshipping["shippingcharge"]) + $finalprice + $taxamount, 2); ?>
                                </span>

                            </div>
                            <div class="bidderbox" align="center" id="wonacceptdenied_<?php echo $obj["auction_id"] ?>" style="width: 103px; padding-left: 2px;">
                                <span><?php if ($obj['accept_denied'] == "Accepted") {
?><font class="greenfont"><b><?php echo ACCEPTED; ?></b></font><?php } elseif ($obj['accept_denied'] == "Denied") {
?><font class="red-text-12-b"><?php echo DENIED; ?></font><?
                                } else {
                                    if ($new_status == "Running") {
?><a href="javascript:void(0)" onclick="javascript:OpenAcceptdeniedPopup('acceptordenied.php?auctionid=<?= $obj["auction_id"]; ?>','','width=150,height=100')" class="darkblue-12-link"><?php echo CLICK_HERE; ?></a><br /><span class="normal_text"><?php echo LAST_DATE_TO_ACCEPT; ?>(<?= AcceptDateFunction(substr($obj["won_date"], 0, 10)); ?>)</span><?php } else {
?><span class="red-text-12-b"><?php echo AUCTION_ACCEPT_PERIOD_IS_OVER; ?></span><?
                                    }
                                }
?></span>
                            </div>
                            <div class="countbox" align="center">
<?php if ($obj['accept_denied'] == "Accepted" && $obj['payment_date'] == '0000-00-00 00:00:00') { ?>
                                    <span id="makepayment_<?= $obj["auction_id"] ?>">
                                    <?php if ($new_status_won == "Running") {
                                    ?>
                                    <?php if ($totalvou > 0) { ?>
                                            <a class="buttonmake1" name="makepayment" onclick="window.location.href='choosevoucher.php?winid=<?= base64_encode($finalprice . "&" . $obj["auctionID"]); ?>'"><?php echo MAKE_PAYMENT; ?></a>
                                    <?php } else {
                                    ?>
                                            <a class="buttonmake1" name="makepayment" onclick="window.location.href='paymentmethod.php?winid=<?= base64_encode($finalprice . "&" . $obj["auctionID"]); ?>'"><?php echo MAKE_PAYMENT; ?></a>
                                    <?php } ?>
                                    <?php } else {
                                    ?><span class="overpaymenttext"><?php echo AUCTION_PAYMENT; ?><br /><?php echo PERIOD_IS_OVER; ?></span><?php } ?></span>
                                    <?php } elseif ($obj['payment_date'] != '0000-00-00 00:00:00') {
                                    ?>
                                <div align="center">
                                    <span  style="font-size:12px;" id="wonpayment">
                                        <b><?php $paydate = arrangedate(substr($obj['payment_date'], 0, 10)); ?><?= $paydate ?><br /><?= substr($obj['payment_date'], 11) ?><br/><br/>
                                            <?php if ($obj['ssid'] != '') {
                                            ?>
                                                <span style="font-size:11px;">
                                                    <a href="<?php echo $obj['sturl']; ?>"><img alt="" src="uploads/other/<?php echo $obj['stlogoimage']; ?>" border="0"/></a><br/>
                                                <?php echo TRACK_NUMBER; ?>:<br/>
                                                <?php echo $obj['tracknumber']; ?>
                                            </span>
                                            <?php } else {
                                            ?>
                                                <span class="greenfont">
                                                    <strong><?php echo PAID . NOT_SHIPPED; ?></strong>
                                                </span>
                                            <?php } ?>
                                        </b>
                                    </span>
                                </div>
                                <?php } else {
                                ?>
                                            <span id="paymentdate_<?= $obj["auction_id"]; ?>" style="visibility: hidden;"></span>
                                            <span style="visibility:hidden;" id="makepayment_<?= $obj["auction_id"] ?>">
                                    <?php if ($totalvou > 0) {
                                    ?>
                                                <a class="buttonmake1" name="makepayment" value="Make Payment" onclick="window.location.href='choosevoucher.php?winid=<?= base64_encode($finalprice . "&" . $obj["auctionID"]); ?>'"><?php echo MAKE_PAYMENT; ?></a>
                                    <?php } else {
                                    ?>
                                                <a class="buttonmake1" name="makepayment" value="Make Payment" onclick="window.location.href='paymentmethod.php?winid=<?= base64_encode($finalprice . "&" . $obj["auctionID"]); ?>'"><?php echo MAKE_PAYMENT; ?></a>
                                    <?php } ?>
                                        </span>
                                <?php } ?>
                                    </div>
                                </div>
                        <?
                                        $counter++;
                                    }
                        ?>
                                    <!-- start page number-->

                                    <div class="clear">&nbsp;</div>
                        <?php if ($totalpage > 1) {
                        ?>
                                        <div class="pagenumber" align="right">
                                            <ul>
                                <?
                                        if ($PageNo > 1) {
                                            $PrevPageNo = $PageNo - 1;
                                ?>
                                            <li><a href="wonauctions.php?pgno=<?= $PrevPageNo;
                                ?>">&lt; <?php echo PREVIOUS_PAGE; ?></a></li>
                                    <?
                                        }
                                    ?>

                                <?
                                        if ($PageNo < $totalpage) {
                                            $NextPageNo = $PageNo + 1;
                                ?>
                                            <li><a id="next" href="wonauctions.php?pgno=<?= $NextPageNo;
                                ?>"><?php echo NEXT_PAGE; ?> &gt;</a></li>
                                    <?
                                        }
                                    ?>
                                </ul>
                            </div>
                        <?php } ?><!--page number-->
                        <?
                                } else {
                        ?>
                                    <div class="clear" style="height: 20px;">&nbsp;</div>
                                    <div class="darkblue-14" align="center"><?php echo SORRY_YOU_DONT_WON_ANY_AUCTION_YET; ?></div>
                                    <div class="clear" style="height: 20px;">&nbsp;</div>
                        <?
                                }
                        ?>

                            </div><!-- /content -->
                        </div><!-- /column-right -->
                        <div id="column-left">
			    <?php include("leftside.php"); ?>
                    
                             
                            </div><!-- /column-left -->
                            </div>
                        </div><!-- /container -->

              <?php include("include/footer.php"); ?>
        