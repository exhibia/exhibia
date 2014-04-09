test  <div id="main">
            <?php include("header.php"); ?>
            <div id="container">
                <?php include("include/topmenu.php"); ?>
                <div class="tab-area">
                <div id="column-right">
                    <?php include("include/searchbox.php"); ?>
                    <div id="title-category-content">
                        <?php include("include/categorymenu.php"); ?>
                        
                        <?php
                        
                        }
                        
                        if ($total != 0) {
                        ?>
                            <p class="bid-title"><strong><?php echo  $SITE_NM; ?> - <?php echo PURCHASED_BIDS; ?></strong></p>
                        <?php
                        } else if ($totalself != 0) {
                        ?>
                            <p class="bid-title"><strong><?php echo  $SITE_NM; ?> - <?php echo FREE_BIDS; ?></strong></p>
                        <?php
                        } else if ($total1 != 0) {
                        ?>
                            <p class="bid-title"><strong><?php echo  $SITE_NM; ?> - <?php echo PLACED_BIDS; ?></strong></p>
                        <?php } ?>
                    </div><!-- /title-category-content -->

                    <?php
                        if ($total != 0) {
                    ?>
                            <div class="rounded_corner">
                                <div class="may_imagetext">
                                    <div class="buybiddate"><?php echo DATE; ?></div>
                                    <div class="buybiddesc"><?php echo DESCRIPTION; ?></div>
                                    <div class="buybidbids"><?php echo BIDS; ?></div>
                                </div>
                                <div class="clear"></div>
                                <div class="buybidbox">
                            <?php
                            $a = 1;
                            $i = 1;
                            while ($obj = db_fetch_array($rssel)) {
                                if ($a == 1) {
                                    $class = "buybids-row-even";
                                } else {
                                    $class = "buybids-row-odd";
                                }
                                $date = substr($obj["bidpack_buy_date"], 0, 10);
                            ?>
                                <div class="<?php echo  $class; ?>" <?php echo  $i == $total ? "style='border-bottom: 0px;'" : "" ?>>
                                    <div class="buybiddate"><strong><?php echo  arrangedate($date) . "<br>" . substr($obj["bidpack_buy_date"], 11); ?></strong></div>
                                    <div class="buybiddesc"><strong><span class="normal_text"><?php echo  $obj["credit_description"]; ?></span></strong></div>
                                    <div class="buybidbids" align="center">
                                    <?
                                    if ($obj["bid_count"] > 0) {
                                    ?>
                                        <span class="greenfont"><b>+<?php echo  $obj["bid_count"]; ?></b></span>
                                    <?
                                    } else {
                                    ?>
                                        <span class="red-text-12-b"><?php echo  $obj["bid_count"]; ?></span>
                                    <?
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                                    $a++;
                                    $i++;
                                    if ($a == 3) {
                                        $a = 1;
                                    }
                                }
                            ?>
                            </div>
                            <div class="clear">&nbsp;</div>
                        <?php if ($totalpage > 1) {
                        ?>
                                    <div class="pagenumber">
                                        <ul>
                                <?php
                                    if ($PageNo > 1) {
                                        $PrevPageNo = $PageNo - 1;
                                ?>
                                        <li><a href="bidhistory.php?pgno=<?php echo  $PrevPageNo; ?>">&lt; <?php echo PREVIOUS_PAGE; ?></a></li>
                                <?php
                                    }
                                ?>

                                <?php
                                    if ($PageNo < $totalpage) {
                                        $NextPageNo = $PageNo + 1;
                                ?>
                                        <li><a id="next" href="bidhistory.php?pgno=<?php echo  $NextPageNo; ?>"><?php echo NEXT_PAGE; ?> &gt;</a></li>
                                <?php
                                    }
                                ?>
                                </ul>
                            </div>
                        <?php } ?>
                            </div>
                    <?php } ?>

                    <?php
                            if ($totalself != 0) {
                    ?>
                                <p class="bid-title"><strong><?php echo  $SITE_NM; ?> - <?php echo FREE_BIDS; ?></strong></p>
                                <div class="rounded_corner">
                                    <div class="may_imagetext">
                                        <div class="buybiddate"><?php echo DATE; ?></div>
                                        <div class="buybiddesc"><?php echo DESCRIPTION; ?></div>
                                        <div class="buybidbids"><?php echo BIDS; ?></div>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="buybidbox">
                            <?php
                                $a = 1;
                                $i = 1;
                                while ($objself = db_fetch_array($resself)) {
                                    if ($a == 1) {
                                        $class = "buybids-row-even";
                                    } else {
                                        $class = "buybids-row-odd";
                                    }
                                    $date = substr($objself["bidpack_buy_date"], 0, 10);
                            ?>
                                    <div class="<?php echo  $class; ?>" <?php echo  $i == $totalself ? "style='border-bottom: 0px;'" : "" ?>>
                                        <div class="buybiddate"><strong><?php echo  arrangedate($date) . "<br>" . substr($objself["bidpack_buy_date"], 11); ?></strong></div>
                                        <div class="buybiddesc"><strong><span class="normal_text"><?php echo  $objself["credit_description"]; ?><?php echo  $objself["bidpack_name"] != "" ? "&nbsp;(" . $objself["bidpack_name"] . ")" : ""; ?><?php echo  $objself["redemption_id"] != "0" ? GetRedemptionName($objself["redemption_id"]) : ""; ?><?php echo  $objself["auction_id"] != "0" ? "Placed on auction" . GetAuctionName($objself["auction_id"]) : "" ?></span></strong></div>
                                <?php if ($objself["bid_flag"] == 'c') {
                                ?>
                                        <div class="buybidbids" align="center">
                                    <?php
                                        if ($objself["bid_count"] > 0) {
                                    ?>
                                            <span class="greenfont"><b>+<?php echo  $objself["bid_count"]; ?></b></span>
                                    <?php
                                        } else {
                                    ?>
                                            <span class="red-text-12-b">-<?php echo  $objself["bid_count"]; ?></span>
                                    <?php
                                        }
                                    ?>
                                    </div>
                                <?php } else {
                                ?>
                                        <div class="buybidbids" align="center">
                                            <span class="red-text-12-b">-<?php echo  $objself["auction_id"] != "0" ? $objself["placebids"] : $objself["bid_count"]; ?></span>
                                        </div>
                                <?php } ?>
                                </div>
                                <div class="clear"></div>
                            <?php
                                    $a++;
                                    $i++;
                                    if ($a == 3) {
                                        $a = 1;
                                    }
                                }
                            ?>
                            </div>
                            <div class="clear">&nbsp;</div>
                        <?php if ($totalpagesselfmain > 1) {
                        ?>
                                    <div class="pagenumber">
                                        <ul>
                                <?php
                                    if ($PageNo2 > 1) {
                                        $PrevPageNo2 = $PageNo2 - 1;
                                ?>
                                        <li><a href="bidhistory.php?pgno2=<?php echo  $PrevPageNo2; ?>">&lt; <?php echo PREVIOUS_PAGE; ?></a></li>
                                <?php
                                    }
                                ?>

                                <?php
                                    if ($PageNo2 < $totalpagesselfmain) {
                                        $NextPageNo2 = $PageNo2 + 1;
                                ?>
                                        <li><a id="next" href="bidhistory.php?pgno2=<?php echo  $NextPageNo2; ?>"><?php echo NEXT_PAGE; ?> &gt;</a></li>
                                <?php
                                    }
                                ?>
                                </ul>
                            </div>
                        <?php } ?>
                            </div>
                    <?php
                            }
                    ?>


                    <?php
                            if ($total1 != 0) {
                    ?>
                                <p class="bid-title"><strong><?php echo  $SITE_NM; ?> - <?php echo PLACED_BIDS; ?></strong></p>
                                <div class="rounded_corner">
                                    <div class="may_imagetext">
                                        <div class="may_textimage"><?php echo IMAGE; ?></div>
                                        <div class="may_description"><?php echo DESCRIPTION; ?></div>
                                        <div class="may_textprise"><?php echo START; ?></div>
                                        <div class="may_textbidder"><?php echo STATUS; ?></div>
                                        <div class="may_countdown" style="width: 70px;"><?php echo BIDS; ?></div>
                                    </div>
                        <?php
                                $i = 1;
                                while ($obj1 = db_fetch_array($rssel1)) {
                                    $startdate = substr($obj1["auc_start_date"], 0, 10);
                                    if ($obj1["aucstatus"] == 1) {
                                        $status = FUTURE_AUCTION;
                                    } elseif ($obj1["aucstatus"] == 2) {
                                        $status = LIVE_AUCTION;
                                    } elseif ($obj1["aucstatus"] == 3) {
                                        $status = ENDED;
                                    }
                                    $pname = $obj1['bidpack'] ? $obj1['bidpack_name'] : $obj1['name'];
                                    $picture = $obj1['bidpack'] ? $obj1['bidpack_banner'] : $obj1['picture1'];
                                    $price = $obj1['bidpack'] ? $obj1['bidpack_price'] : $obj1['price'];
                                    $short_desc = $obj1['bidpack'] ? "{$obj1['bid_size']} Bids and {$obj1['freebids']} Freebids" : $obj1['short_desc'];
                        ?>
                                    <div class="may_bidbox">
                                        <div class="smollimagebox"><a href="<?php echo SEOSupport::getProductUrl($pname, $obj1["auctionID"], $obj1['uniqueauction']==true?'l':'n'); ?>"><img src="<?php echo  $UploadImagePath; ?>products/thumbs_small/thumbsmall_<?php echo  $picture; ?>" border="0" /></a></div>
                                        <div class="may_drestext">
                                            <span class="style2"><a class="prodtitle" href="<?php echo SEOSupport::getProductUrl($pname, $obj1["auctionID"],  $obj1['uniqueauction']==true?'l':'n'); ?>"><?php echo  $pname; ?></a></span><br /><br /><?php echo  choose_short_desc(stripslashes($short_desc), 110); ?><a href="<?php echo SEOSupport::getProductUrl($pname, $obj1["auctionID"],  $obj1['uniqueauction']==true?'l':'n'); ?>" class="blackmore"><?php echo MORE; ?></a>
                                        </div>
                                        <div class="prisebox" style="font-size: 12px; padding-top: 16px;"><?php echo  arrangedate($startdate); ?></div>
                                        <div class="countbox" style="font-size: 12px;" align="center"><?php echo  $status; ?></div>
                                        <div class="counbitbut" style="width: 30px; padding-top: 18px;" align="center">
                                            <span class="red-text-12-b">-<?php echo  getTotalPlaceBids($obj1["auctionID"]); ?></span>
                                        </div>
                                        <div style="width: 20px; float: left; padding-top: 20px;">
                                            <img src="images/icon_gbkplus.gif" onclick="BidHistoryPlus('bidd<?php echo  $obj1["auctionID"]; ?>','plusimage<?php echo  $obj1["auctionID"]; ?>','minusimage<?php echo  $obj1["auctionID"]; ?>');" id="plusimage<?php echo  $obj1["auctionID"]; ?>" align="right"/>
                                            <img src="images/icon_gbkminus.gif" onclick="BidHistoryMinus('bidd<?php echo  $obj1["auctionID"]; ?>','plusimage<?php echo  $obj1["auctionID"]; ?>','minusimage<?php echo  $obj1["auctionID"]; ?>');" id="minusimage<?php echo  $obj1["auctionID"]; ?>" style="display: none;" align="right"/>
                                        </div>
                                        <div id="bidd<?php echo  $obj1["auctionID"]; ?>" style="width: 680px; float: right; margin-top: -43px; padding-right: 28px; display:none; ">
                                            <div id="detailsimage"></div>
                                            <div id="bidhistory_bid_history">
                                                <div id="historytop"></div>
                                                <div id="historydetails">
                                        <?php getBidHistory($obj1["auctionID"], $uid) ?>
                                    </div>
                                    <div id="historybot"></div>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <?php
                                    }
                        ?>
                                    <div class="clear">&nbsp;</div>
                        <?php if ($totalpage1 > 1) {
 ?>
                                        <div class="pagenumber">
                                            <ul>
                                <?php
                                        if ($PageNo1 > 1) {
                                            $PrevPageNo1 = $PageNo1 - 1;
                                ?>
                                            <li><a href="bidhistory.php?pgNo=<?php echo  $PrevPageNo1; ?>">&lt; <?php echo PREVIOUS_PAGE; ?></a></li>
                                <?php
                                        }
                                ?>

                                <?php
                                        if ($PageNo1 < $totalpagesselfmain) {
                                            $NextPageNo1 = $PageNo1 + 1;
                                ?>
                                            <li><a id="next" href="bidhistory.php?pgNo=<?php echo  $NextPageNo1; ?>"><?php echo NEXT_PAGE; ?> &gt;</a></li>
                                <?php
                                        }
                                ?>
                                    </ul>
                                </div>
<?php } ?>
                                </div>
                    <?php } else { ?>
                                    <div style="height: 30px;">&nbsp;</div>
                                    <div align="center" class="darkblue-14"><?php echo YOU_DO_NOT_HAVE_ANY_BIDS; ?></div>
                                    <div style="height: 20px;">&nbsp;</div>
                    <?php } ?>

                            </div><!-- /column-right -->
                            <?php if(empty($_REQUEST['admin_pass'])){
                            ?>
                            <div id="column-left">
                    <?php include("leftside.php"); ?>
                  
                            </div><!-- /column-left -->
                            </div>
                        </div><!-- /container -->

            <?php include("footer.php"); ?>
        </div> <!--end main--> 
