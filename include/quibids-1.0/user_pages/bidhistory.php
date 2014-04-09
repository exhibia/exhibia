
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
                            <?php if ($totalpb > 0) {
                            ?>
                                <!-- ============= Recently Won Auctions =============  -->
                                <h1><?php echo PURCHASED_BIDS; ?></h1>
                                <div class="clear"></div>

                                <div id="myqb-auctions">
                                    <div id="myqb-auctions-head">
                                        <div id="product_title" style="width:130px;"><?php echo DATE; ?></div>
                                        <div id="price_title" style="width:400px;"><?php echo DESCRIPTION; ?></div>
                                        <div id="price_title" style="width:120px;text-align:right;"><?php echo BIDS; ?></div>
                                    </div>

                                <?php
                                $i = 1;
                                while ($obj = db_fetch_array($rssel)) {

                                    $date = substr($obj["bidpack_buy_date"], 0, 10);
                                ?>

                                    <div>
                                        <div class="live-auction" style="background-color: white;">

                                            <div class="live-a-content" style="width:130px;padding:10px;font-size:13px;">
                                            <?php echo arrangedate($date) . "<br/>" . substr($obj["bidpack_buy_date"], 11); ?>
                                        </div>
                                        <div class="price-bidder" style="width:400px;">
                                            <div style="font-size:13px;"><?php echo $obj["credit_description"]; ?></div>
                                        </div>

                                        <div class="countdown" style="width:120px;text-align: right;color:#2cab00;">
                                            <?php
                                            if ($obj["bid_count"] > 0) {
                                            ?>
                                                <span class="greenfont">+<?php echo $obj["bid_count"]; ?></span>
                                            <?php
                                            } else {
                                            ?>
                                                <span class="redfont"><?php echo $obj["bid_count"];
                                            ?></span>
                                            <?php
                                            }
                                            ?>
                                        </div>

                                        <div class="clear"></div>
                                    </div>

                                </div>

                                <?php $i++;
                                        } ?>


                                        <div id="live-auctions-end">

                                    <?php if ($totalpage > 0) {
                                    ?>
                                            <table align="right">
                                                <tbody>
                                                    <tr>
                                                        <td valign="middle">
                                                            <div style="margin-top: 15px;" id="pagenumber_display"><?php echo TOTAL . ' ' . $totalpb . ' ' . RESULTS ?>, <?php echo $PageNo . ' ' . OF . ' ' . $totalpage . ' ' . PAGES; ?> </div>
                                                        </td>
                                                        <td width="30">&nbsp;</td>
                                                        <td valign="middle">
                                                            <span id="pagination">
                                                        <?php if ($PageNo > 1) {
                                                        ?>
                                                            <a style="width: 50px;" id="prev" href="bidhistory.php?pgno=<?php echo $PageNo - 1; ?>"><?php echo PREVIOUS; ?></a>
                                                        <?php } else {
                                                        ?>
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
                                                            <a href="bidhistory.php?pgno=<?php echo $page; ?>" class="<?php echo $page == $PageNo ? 'selected' : ''; ?>"><?php echo $page; ?></a>&nbsp;
                                                        <?php } ?>


                                                        <?php if ($PageNo < $totalpage) {
                                                        ?>
                                                            <a id="next" href="bidhistory.php?pgno=<?php echo $PageNo + 1; ?>"><?php echo NEXT; ?></a>
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
                            <?php
                                                }
                                                db_free_result($rssel);
                            ?>


                            <?php if ($totalself > 0) {
                            ?>
                                                    <!-- ============= Recently Won Auctions =============  -->

                                                    <!--begin free bid-->
                                                    <h1><?php echo FREE_BIDS; ?></h1>
                                                    <div class="clear"></div>

                                                    <div id="myqb-auctions">
                                                        <div id="myqb-auctions-head">
                                                            <div id="product_title" style="width:130px;"><?php echo DATE; ?></div>
                                                            <div id="price_title" style="width:400px;"><?php echo DESCRIPTION; ?></div>
                                                            <div id="price_title" style="width:120px;text-align:right;"><?php echo BIDS; ?></div>
                                                        </div>

                                <?php
                                                    $i = 1;
                                                    while ($objself = db_fetch_array($resself)) {

                                                        $date = substr($objself["bidpack_buy_date"], 0, 10);
                                ?>

                                                        <div>
                                                            <div class="live-auction" style="background-color: white;">

                                                                <div class="live-a-content" style="width:130px;padding:10px;font-size:13px;">
                                            <?php echo arrangedate($date) . "<br/>" . substr($objself["bidpack_buy_date"], 11); ?>
                                                    </div>
                                                    <div class="price-bidder" style="width:400px;">
                                                        <div style="font-size:13px;">
                                                <?php echo $objself["credit_description"]; ?>
                                                <?php echo $objself["bidpack_name"] != "" ? "&nbsp;(" . $objself["bidpack_name"] . ")" : ""; ?>
                                                <?php echo $objself["redemption_id"] != "0" ? GetRedemptionName($objself["redemption_id"]) : ""; ?>
                                                <?php echo $objself["auction_id"] != "0" ? "Placed on auction" . GetAuctionName($objself["auction_id"]) : "" ?>
                                                    </div>
                                                </div>

                                                <div class="countdown" style="width:120px;text-align: right;color:#2cab00;">
                                            <?php if ($objself["bid_flag"] == 'c') {
                                            ?>
                                            <?php
                                                            if ($objself["bid_count"] > 0) {
                                            ?>
                                                                <span class="greenfont"><b>+<?=$objself["bid_count"];
                                            ?></b></span>
                                            <?php
                                        } else {
                                            ?>
                                            <span class="redfont">-<?php echo $objself["bid_count"];
                                            ?></span>
                                            <?php
                                        }
                                            ?>
                                            <?php } else {
                                            ?>
                                            <span class="redfont">-<?php echo $objself["auction_id"] != "0" ? $objself["placebids"] : $objself["bid_count"]; ?></span>
                                            <?php } ?>
                                        </div>

                                        <div class="clear"></div>
                                    </div>

                                </div>

                                <?php $i++;
                                    } ?>


                                    <div id="live-auctions-end">

                                    <?php if ($totalpagesselfmain > 0) {
                                    ?>
                                        <table align="right">
                                            <tbody>
                                                <tr>
                                                    <td valign="middle">
                                                        <div style="margin-top: 15px;" id="pagenumber_display"><?php echo TOTAL . ' ' . ($totaltmp1 + $totaltmp2) . ' ' . RESULTS ?>, <?php echo $PageNo2 . ' ' . OF . ' ' . $totalpagesselfmain . ' ' . PAGES; ?> </div>
                                                    </td>
                                                    <td width="30">&nbsp;</td>
                                                    <td valign="middle">
                                                        <span id="pagination">
                                                        <?php if ($PageNo2 > 1) {
                                                        ?>
                                                            <a style="width: 50px;" id="prev" href="bidhistory.php?pgno2=<?php echo $PageNo2 - 1; ?>"><?php echo PREVIOUS; ?></a>
                                                        <?php } else {
                                                        ?>
                                                            <a style="width: 50px;" id="prev"><span style="color: rgb(192, 192, 192);"><?php echo PREVIOUS; ?></span></a>
                                                        <?php } ?>

                                                        &nbsp;

                                                        <?php
                                                        $pagestart = $PageNo2 - 3;
                                                        if ($pagestart < 1) {
                                                            $pagestart = 1;
                                                        }

                                                        $pageend = $pagestart + 7;
                                                        if ($pageend > $totalpagesselfmain) {
                                                            $pageend = $totalpagesselfmain;
                                                        }

                                                        for ($page = $pagestart; $page <= $pageend; $page++) {
                                                        ?>
                                                            <a href="bidhistory.php?pgno2=<?php echo $page; ?>" class="<?php echo $page == $PageNo2 ? 'selected' : ''; ?>"><?php echo $page; ?></a>&nbsp;
                                                        <?php } ?>


                                                        <?php if ($PageNo2 < $totalpage) {
                                                        ?>
                                                            <a id="next" href="bidhistory.php?pgno2=<?php echo $PageNo2 + 1; ?>"><?php echo NEXT; ?></a>
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
                            <?php
                                                }
                                                db_free_result($resself);
                            ?>

                                                <!--end free bid-->

                                                <!-- place bid-->

                            <?php
                                                if ($total1 > 0) {
                            ?>
                                                    <h1><?php echo PLACED_BIDS; ?></h1>
                                                    <div class="clear"></div>

                                                    <div id="myqb-auctions">
                                                        <div id="myqb-auctions-head">
                                                            <div id="product_title"><?php echo PRODUCTS; ?></div>
                                                            <div id="price_title"><?php echo PRICE; ?></div>
                                                            <div id="countdown_title"><?php echo COUNTDOWN; ?></div>
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
                                ?>

                                                        <div class="auction-item" title="<?php echo $obj1["auctionID"]; ?>" id="auction_<?php echo $obj1["auctionID"]; ?>">
                                                            <div class="live-auction" style="background-color: white;">
                                                                <a href="viewproduct.php?aid=<?php echo $obj1["auctionID"]; ?>" class="thumb" style="background-image: url(<?php echo $UploadImagePath; ?>products/thumbs_small/thumbsmall_<?php echo $obj1["picture1"]; ?>);"></a>
                                                                <div class="live-a-content">
                                                                    <h2>
                                                                        <a href="viewproduct.php?aid=<?php echo $obj1["auctionID"]; ?>"><?php echo stripslashes($obj1["name"]); ?></a>
                                                                    </h2>
                                                                    <br/>
                                                                    <p><?php echo stripslashes($obj1['short_desc']); ?></p>
                                                                </div>
                                                                <div class="price-bidder">
                                                                    <label style="font-size:13px;"><?php echo $status; ?></label>
                                                                    <br/><br/>
                                                                    <label class="winner"><?php echo arrangedate($startdate); ?></label>
                                                                </div>
                                                                <div class="countdown">
                                                                    <div class="buttonoffset">
                                                                        <img alt="" src="images/icon_gbkplus.gif" onclick="BidHistoryPlus('bidd<?php echo $obj1["auctionID"]; ?>','plusimage<?php echo $obj1["auctionID"]; ?>','minusimage<?php echo $obj1["auctionID"]; ?>');" id="plusimage<?php echo $obj1["auctionID"]; ?>" style="cursor:pointer;" align="right"/>
                                                                        <img alt="" src="images/icon_gbkminus.gif" onclick="BidHistoryMinus('bidd<?php echo $obj1["auctionID"]; ?>','plusimage<?php echo $obj1["auctionID"]; ?>','minusimage<?php echo $obj1["auctionID"]; ?>');" id="minusimage<?php echo $obj1["auctionID"]; ?>" style="display: none;z-index: 1000;cursor:pointer;" align="right"/>

                                                                    </div>
                                                                    <label class="timer time-left">
                                                                        -<?php echo getTotalPlaceBids($obj1["auctionID"]); ?>
                                                                    </label>
                                                                    
                                                                    <div id="bidd<?php echo $obj1["auctionID"]; ?>" style="float: right; margin-top: -10px; padding-right: 10px; display:none; ">
                                                                        <div id="detailsimage"></div>
                                                                        <div id="bidhistory_bid_history">
                                                                            <div id="historytop"></div>
                                                                            <div id="historydetails">
                                                        <?php getBidHistory($obj1["auctionID"], $uid) ?>
                                                    </div>
                                                    <div id="historybot"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="clear"></div>
                                    </div>

                                </div>

                                <?php } ?>

                                <?php } else {
                                ?>

                                                    <br/><center><h3><?php echo YOU_DO_NOT_HAVE_ANY_BIDS; ?></h3></center>
                                <?php
                                                }
                                                db_free_result($rssel1);
                                ?>
                                                <div id="live-auctions-end">

                                    <?php if ($totalpage1 > 0) {
                                    ?>
                                                    <table align="right">
                                                        <tbody>
                                                            <tr>
                                                                <td valign="middle">
                                                                    <div style="margin-top: 15px;" id="pagenumber_display"><?php echo TOTAL . ' ' . $totalfree . ' ' . RESULTS ?>, <?php echo $PageNo1 . ' ' . OF . ' ' . $totalpage1 . ' ' . PAGES; ?> </div>
                                                                </td>
                                                                <td width="30">&nbsp;</td>
                                                                <td valign="middle">
                                                                    <span id="pagination">
                                                        <?php if ($PageNo1 > 1) {
                                                        ?>
                                                            <a style="width: 50px;" id="prev" href="bidhistory.php?pgNo=<?php echo $PageNo1 - 1; ?>"><?php echo PREVIOUS; ?></a>
                                                        <?php } else {
                                                        ?>
                                                            <a style="width: 50px;" id="prev"><span style="color: rgb(192, 192, 192);"><?php echo PREVIOUS; ?></span></a>
                                                        <?php } ?>

                                                        &nbsp;

                                                        <?php
                                                        $pagestart = $PageNo1 - 3;
                                                        if ($pagestart < 1) {
                                                            $pagestart = 1;
                                                        }

                                                        $pageend = $pagestart + 7;
                                                        if ($pageend > $totalpage1) {
                                                            $pageend = $totalpage1;
                                                        }

                                                        for ($page = $pagestart; $page <= $pageend; $page++) {
                                                        ?>
                                                            <a href="bidhistory.php?pgNo=<?php echo $page; ?>" class="<?php echo $page == $PageNo1 ? 'selected' : ''; ?>"><?php echo $page; ?></a>&nbsp;
                                                        <?php } ?>


                                                        <?php if ($PageNo < $totalpage) {
                                                        ?>
                                                            <a id="next" href="bidhistory.php?pgNo=<?php echo $PageNo1 + 1; ?>"><?php echo NEXT; ?></a>
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

                                            <!-- end place bid-->


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
  