
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
                            <h1><?php echo $status == 1 ? MY_BUYNOW_LIST : MY_BUYNOW_HISTORY; ?></h1>
                            <div class="clear"></div>

                            <div id="myqb-auctions">
                                <div id="myqb-auctions-head">
                                    <div id="product_title" style="width:270px;"><?php echo PRODUCTS; ?></div>
                                    <div id="price_title" style="width:130px;"><?php echo PRICE; ?></div>
                                    <div id="price_title" style="width:80px;"><?php echo BUY_DATE; ?></div>
                                    <div id="countdown_title" style="width:90px;"><?php echo STATUS; ?></div>
                                </div>

                                <?php
                                if ($totalauc > 0) {
                                    $counter = 1;
                                    $i = 1;

                                    while ($obj = db_fetch_object($ressel)) {
                                        $buydate = $obj->buydate;
                                ?>

                                        <div>
                                            <div class="live-auction" style="background-color: white;">

                                                <div class="live-a-content" style="width:300px;padding-left:10px;">
                                                    <h2>
                                                        <a><?php echo stripslashes($obj->name); ?></a>
                                                    </h2>
                                            <?php if ($obj->ssid != '' && $obj->status == 1) {
                                            ?>
                                                    <br/>
                                                    <br/>
                                                    <a href="" style="text-align:center;float:left;" class="loginfirst" onclick="return sentconfirm('mybuynow.php?sent=<?php echo $obj->id; ?>&status=<?php echo $status; ?>&pgno=<?php echo $PageNo; ?>')">
                                                <?php echo ARCHIVE; ?>
                                            </a>
                                            <?php } ?>
                                        </div>
                                        <div class="price-bidder" style="width:120px;">
                                            <label><?php echo $Currency . $obj->price; ?></label>
                                        </div>

                                        <div class="price-bidder" style="width:120px;text-align: center;">
                                            <label style="font-size:12px;">
                                                <?php echo arrangedate(substr($buydate, 0, 10)) . "<br/>" . substr($buydate, 11); ?>
                                            </label>

                                        </div>

                                        <div class="countdown" style="width:120px;text-align: center;color:#2cab00;font-size:12px;">
                                            <?php if ($obj->status == 1) {
 ?>
                                                    <label style="font-size:12px;"><?php echo PAYMENT_COMPLETE; ?></label>
<?php } ?>

                                                <span style="font-size:11px;font-weight:normal;">
                                                    <br/>
<?php if ($obj->ssid != '') { ?>

                                                    <a href="<?php echo $obj->sturl; ?>"><img alt="" width="120" src="uploads/other/<?php echo $obj->stlogoimage; ?>" border="0"/></a><br/>
                                                <?php echo TRACK_NUMBER; ?>:<br/>
                                                <?php echo $obj->tracknumber; ?>
<?php } ?>
                                            </span>
                                        </div>

                                        <div class="clear"></div>
                                    </div>

                                </div>

                                <?php $i++;
                                            } ?>

                                <?php } else { ?>

                                            <br/><center><h3><?php echo NO_BUYNOW_TO_DISPLAY; ?></h3></center>
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
                                                            <a style="width: 50px;" id="prev" href="mybuynow.php?pgno=<?php echo $PageNo - 1; ?>&status=<?php echo $status; ?>"><?php echo PREVIOUS; ?></a>
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
                                                            <a href="mybuynow.php?pgno=<?php echo $page; ?>&status=<?php echo $status; ?>" class="<?php echo $page == $PageNo ? 'selected' : ''; ?>"><?php echo $page; ?></a>&nbsp;
                                                        <?php } ?>


                                                        <?php if ($PageNo < $totalpage) {
 ?>
                                                            <a id="next" href="mybuynow.php?pgno=<?php echo $PageNo + 1; ?>&status=<?php echo $status; ?>"><?php echo NEXT; ?></a>
<?php } else { ?>
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

<?php include 'footer.php' ?>

