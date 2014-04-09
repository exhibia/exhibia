
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
                            <h1><?php echo WATCHED_AUCTIONS; ?></h1>
                            <div class="clear"></div>

                            <div id="myqb-auctions">
                                <div id="myqb-auctions-head">
                                    <div id="product_title"><?php echo PRODUCTS; ?></div>
                                    <div id="price_title"><?php echo PRICE; ?></div>
                                    <div id="countdown_title"><?php echo COUNTDOWN; ?></div>
                                </div>

                                <?php if ($totalauc > 0) {
                                ?>
                                    <form name="watchauc" method="post" action="watchauctions.php">
                                    <?php
                                    $counter = 1;
                                    while ($obj = db_fetch_array($ressel)) {
                                        if ($obj["auc_status"] == 2) {
                                            if ($counter == 1) {
                                                $arr = $obj["auctionID"];
                                                $prr = $obj["auc_due_price"];
                                            } else {
                                                $arr .= "," . $obj["auctionID"];
                                                $prr .= "," . $obj["auc_due_price"];
                                            }
                                            $counter++;
                                        }
                                        $qryuname = "select * from bid_account ba left join registration r on ba.user_id=r.id where ba.auction_id=" . $obj["auctionID"] . " and bid_flag='d' order by ba.id desc limit 0,1";
                                        $resuname = db_query($qryuname);
                                        //$totalname = db_num_rows($resuname);
                                        //$objname = db_fetch_object($resuname);
                                        $username = $objname->username;
                                    ?>

                                        <div class="auction-item" title="<?php echo $obj["auctionID"]; ?>" id="auction_<?php echo $obj["auctionID"]; ?>">
                                            <div class="live-auction" style="background-color: white;">
                                                <a href="viewproduct.php?aid=<?php echo $obj["auctionID"]; ?>" class="thumb" style="background-image: url(<?php echo $UploadImagePath; ?>products/thumbs_small/thumbsmall_<?php echo $obj["picture1"]; ?>);"></a>
                                                <div class="live-a-content">
                                                    <h2>
                                                        <a href="viewproduct.php?aid=<?php echo $obj["auctionID"]; ?>"><?php echo stripslashes($obj["name"]); ?></a>
                                                    </h2>
                                                    <p><?php echo stripslashes($obj['short_desc']); ?></p>
                                                </div>
                                                <div class="price-bidder">

                                                <?php if ($obj["auc_status"] == 2) {
                                                ?>

                                                    <label id="price_index_page_<?php echo $obj["auctionID"]; ?>">---</label>
                                                <?php } elseif ($obj["auc_status"] == 3) {
                                                ?>
                                                    <label id="price_index_page_<?php echo $obj["auctionID"]; ?>"><?=$Currency; ?><?=number_format($obj["auc_due_price"], 2); ?></label>
                                                <?php } else {
                                                ?>
                                                    <label id="price_index_page_<?php echo $obj["auctionID"]; ?>"><?=$Currency; ?><?=number_format($obj["auc_start_price"], 2); ?></label>
                                                <?php } ?>

                                                <span id="value_index_page_<?php echo $obj["auctionID"]; ?>"><?php echo $Currency . $obj['price']; ?></span>

                                                <?php if ($obj["auc_status"] == 2) {
                                                ?>
                                                    <label class="winner" id="product_bidder_<?php echo $obj["auctionID"]; ?>">---</label>
                                                <?php } elseif ($obj["auc_status"] == 3) {
                                                ?>
                                                    <label class="winner" id="product_bidder_<?php echo $obj["auctionID"]; ?>"><?php echo $username != "" ? $username : "---"; ?></label>
                                                <?php } else {
                                                ?>
                                                    <label class="winner" id="product_bidder_<?php echo $obj["auctionID"]; ?>">---</label>
                                                <?php } ?>

                                            </div>
                                            <div class="countdown">

                                                <?php if ($obj["auc_status"] == 2) {
                                                ?>
                                                    <label class="timer time-left" id="counter_index_page_<?php echo $obj["auctionID"]; ?>">
                                                        <script language='javascript' type='text/javascript'>
                                                            document.getElementById('counter_index_page_<?php echo $obj["auctionID"]; ?>').innerHTML = calc_counter_from_time('<?php echo $obj["auc_due_time"]; ?>');
                                                        </script>
                                                    </label>
                                                <?php } elseif ($obj["auc_status"] == 1) {
                                                ?>
                                                    <label class="timer time-left" id="counter_index_page_<?php echo $obj["auctionID"]; ?>">--:--:--</label>
                                                <?php } else {
                                                ?>
                                                    <label class="timer time-left" id="counter_index_page_<?php echo $obj["auctionID"]; ?>"><?php echo ENDED; ?></label>
                                                <?php } ?>

                                                <div class="buttonoffset">
                                                    <?php if ($obj["auc_status"] == 2) {
                                                    ?>
                                                        <a id="image_main_<?php echo $obj["auctionID"]; ?>" class="loginfirst bid-button-link" name="getbid.php?prid=<?php echo $obj["productID"]; ?>&aid=<?php echo $obj["auctionID"]; ?>&uid=<?php echo $uid; ?>"><?php echo PLACE_BID; ?></a>
                                                    <?php } elseif ($obj["auc_status"] == 3) {
                                                    ?>
                                                        <a id="image_main_<?php echo $obj["auctionID"]; ?>" class="bidonsold"><?php echo SOLD; ?></a>
                                                    <?php } elseif ($obj["auc_status"] == 1) {
                                                    ?>
                                                        <a id="image_main_<?php echo $obj["auctionID"]; ?>" class="loginfirst"><?php echo PLACE_BID; ?></a>
                                                    <?php } ?>
                                                    <input type="checkbox" value="<?=$obj["wid"]; ?>" name="delauction[]" />
                                                </div>
                                            </div>

                                            <div class="clear"></div>
                                        </div>

                                    </div>

                                    <?php } ?>
                                            </form>
                                <?php } else {
                                ?>

                                                <br/><center><h3><?php echo NO_WATCHED_AUCTIONS_TO_DISPLAY; ?></h3></center>
                                <?php
                                            }
                                            db_free_result($ressel);
                                ?>
                                            <div id="live-auctions-end">

                                    <?php if ($totalpage > 0) {
 ?>
                                                <table align="right" valign="middle">
                                                    <tbody>
                                                        <tr>
                                                            <td width="100" style="text-align:left;">
                                                                <a class="loginfirst" onclick="deleteauc();" style="text-align:center;"><?php echo DELETE; ?></a>
                                                            </td>
                                                            <td width="30">&nbsp;</td>
                                                            <td width="200" valign="middle" align="right">
                                                                <div style="margin-top: 15px;" id="pagenumber_display"><?php echo TOTAL . ' ' . $total . ' ' . AUCTIONS ?>, <?php echo $PageNo . ' ' . OF . ' ' . $totalpage . ' ' . PAGES; ?> </div>
                                                            </td>
                                                            <td width="30">&nbsp;</td>
                                                            <td valign="middle" width="50%" align="right">
                                                                <span id="pagination">
<?php if ($PageNo > 1) { ?>
                                                        <a style="width: 50px;" id="prev" href="watchauctions.php?pgno=<?php echo $PageNo - 1; ?>"><?php echo PREVIOUS; ?></a>
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
                                                            <a href="watchauctions.php?pgno=<?php echo $page; ?>" class="<?php echo $page == $PageNo ? 'selected' : ''; ?>"><?php echo $page; ?></a>&nbsp;
<?php } ?>


                                                        <?php if ($PageNo < $totalpage) { ?>
                                                            <a id="next" href="watchauctions.php?pgno=<?php echo $PageNo + 1; ?>"><?php echo NEXT; ?></a>
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

