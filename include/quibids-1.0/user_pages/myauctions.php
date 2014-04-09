
       <div id="pagewidth">
            <!-- ============= Header =============  -->
            <?php include $BASE_DIR . '/include/' . $template . '/header.php'; ?>
            <!-- ============= End Header =============  -->

            <div id="wrapper" class="clearfix">
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
                            <h1><?php echo AUCTIONS_YOU_ARE_BIDDING_ON; ?></h1>
                            <div class="clear"></div>

                            <div id="myqb-auctions">
                                <div id="myqb-auctions-head">
                                    <div id="product_title"><?php echo PRODUCTS; ?></div>
                                    <div id="price_title"><?php echo PRICE; ?></div>
                                    <div id="countdown_title"><?php echo COUNTDOWN; ?></div>
                                </div>

                                <?php
                                                if ($totalauc > 0) {
                                                    $counter = 1;
                                                    while ($obj = db_fetch_array($resselauc)) {
                                ?>

                                                        <div class="auction-item" title="<?php echo $obj["auctionID"]; ?>" id="auction_<?php echo $obj["auctionID"]; ?>">
                                                            <div class="live-auction" style="background-color: white;">
                                                                <a href="viewproduct.php?aid=<?php echo $obj["auctionID"]; ?>" class="thumb" style="background-image: url(<?php echo $UploadImagePath; ?>products/thumbs_small/thumbsmall_<?php echo $obj["picture1"]; ?>);"></a>
                                                                <div class="live-a-content">
                                                                    <h2>
                                                                        <a href="viewproduct.php?aid=<?php echo $obj["auctionID"]; ?>"><?php echo stripslashes($obj["name"]); ?></a>
                                                                    </h2><br />
                                                                    <p><?php echo stripslashes($obj['short_desc']); ?></p>
                                                                </div>
                                                                <div class="price-bidder">
                                                                    <label><?php echo $Currency;?><font id="price_index_page_<?php echo $obj["auctionID"]; ?>">---</font> <?php echo $CurrencyName;?></label>


                                                                    <span style="text-decoration:none;"><p id="value_index_page_<?php echo $obj["auctionID"]; ?>"><?php echo $Currency . $obj['price']; ?> <?php echo $CurrencyName;?></p></span>
                                                                    <label class="winner" id="product_bidder_<?php echo $obj["auctionID"]; ?>">---</label>
                                                                </div>
                                                                <div class="countdown">
                                                                    <label class="timer time-left" id="counter_index_page_<?php echo $obj["auctionID"]; ?>">
                                                                        <script language='javascript' type='text/javascript'>
                                                                            document.getElementById('counter_index_page_<?php echo $obj["auctionID"]; ?>').innerHTML = calc_counter_from_time('<?php echo $obj["auc_due_time"]; ?>');
                                                                        </script>
                                                                    </label>
                                                                    <div class="buttonoffset">
                        
                                                                        <a id="image_main_<?php echo $obj["auctionID"]; ?>" class="loginfirst bid-button-link" name="getbid.php?prid=<?php echo $obj["productID"]; ?>&aid=<?php echo $obj["auctionID"]; ?>&uid=<?php echo $uid; ?>"><?php echo PLACE_BID; ?></a>


                                                                    </div>
                                                                </div>

                                                                <div class="clear"></div>
                                                            </div>

                                                        </div>

                                <?php } ?>

                                <?php } else {
                                ?>

                                                    <br/><center><h3><?php echo YOU_ARE_NOT_BIDDING_ON_ANY_AUCTIONS; ?></h3></center>
                                <?php
                                                }
                                                db_free_result($resselauc);
                                ?>
                                                <div id="live-auctions-end">

                                    <?php if ($totalpage > 0) {
                                    ?>
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
                                                            <a style="width: 50px;" id="prev" href="myauctions.php?pgno=<?php echo $PageNo - 1; ?>"><?php echo PREVIOUS; ?></a>
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
                                                            <a href="myauctions.php?pgno=<?php echo $page; ?>" class="<?php echo $page == $PageNo ? 'selected' : ''; ?>"><?php echo $page; ?></a>&nbsp;
                                                        <?php } ?>


                                                        <?php if ($PageNo < $totalpage) {
                                                        ?>
                                                            <a id="next" href="myauctions.php?pgno=<?php echo $PageNo + 1; ?>"><?php echo NEXT; ?></a>
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
  