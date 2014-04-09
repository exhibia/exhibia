
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
                            <h1><?php echo MY_ACTIVE_AUTOBIDDER; ?></h1>
                            <div class="clear"></div>

                            <div id="myqb-auctions">
                                <div id="myqb-auctions-head">
                                    <div id="product_title"><?php echo PRODUCTS; ?></div>
                                    <div id="price_title"><?php echo AUTO_BIDDER; ?></div>
                                    <div id="countdown_title"><?php echo DELETE; ?></div>
                                </div>

                                <?php
                                if ($totalauc > 0) {
                                    $counter = 1;
                                    while ($obj = db_fetch_array($ressel)) {
                                ?>

                                        <div>
                                            <div class="live-auction" style="background-color: white;">
                                                <a href="viewproduct.php?aid=<?php echo $obj["auctionID"]; ?>" class="thumb" style="background-image: url(<?=$UploadImagePath;?>products/thumbs_small/thumbsmall_<?php echo $obj["picture1"];?>);"></a>
                                                <div class="live-a-content" style="width:300px;">
                                                    <h2>
                                                        <a href="viewproduct.php?aid=<?php echo $obj["auctionID"]; ?>"><?php echo stripslashes($obj["name"]); ?></a>
                                                    </h2>
                                                    <p><?php echo stripslashes($obj['short_desc']); ?></p>
                                                </div>
                                                <div class="price-bidder" style="width:150px;font-size:12px;text-align: left;">
                                                    <label><?php echo START_PRICE; ?>:&nbsp;<strong><?=$Currency.number_format($obj["butler_start_price"],2);?></strong></label>
                                                    <br/><br/>
                                                    <label><?php echo END_PRICE; ?>:&nbsp;<strong><?=$Currency.number_format($obj["butler_end_price"],2);?></strong></label>
                                                    <br/><br/>
                                                    <label id="placebidsbut_<?=$obj["id"];?>"><?php echo PLACE_BID; ?>:&nbsp;<strong><?php echo $obj["butler_bid"];?></strong></label>
                                                </div>
                                                <div class="countdown" style="width:100px;">
                                                   
                                                    <div class="buttonoffset">
                                                        <a class="loginfirst" onclick="DeleteBidButler1('<?php echo $obj["id"]?>');return false;"><?php echo DELETE; ?></a>
                                                    </div>
                                                </div>

                                                <div class="clear"></div>
                                            </div>

                                        </div>

                                <?php } ?>

                                <?php } else {
                                ?>

                                    <br/><center><h3><?php echo YOU_DONT_CURRENTLY_HAVE_ANY_AUTOBIDDERS; ?></h3></center>
                                <?php
                                }
                                db_free_result($ressel);
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
                                                            <a style="width: 50px;" id="prev" href="myautobidder.php?pgno=<?php echo $PageNo - 1; ?>"><?php echo PREVIOUS; ?></a>
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
                                                            <a href="myautobidder.php?pgno=<?php echo $page; ?>" class="<?php echo $page == $PageNo ? 'selected' : ''; ?>"><?php echo $page; ?></a>&nbsp;
                                                        <?php } ?>


                                                        <?php if ($PageNo < $totalpage) {
                                                        ?>
                                                            <a id="next" href="myautobidder.php?pgno=<?php echo $PageNo + 1; ?>"><?php echo NEXT; ?></a>
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

 
