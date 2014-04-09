
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
                            <h1><?php echo MY_COUPON; ?></h1>
                            <div class="clear"></div>

                            <div id="myqb-auctions">
                                <div id="myqb-auctions-head">                                    
                                    <div id="price_title" style="width:140px;text-align: center;"><?php echo TITLE; ?></div>
                                    <div id="price_title" style="width:70px;text-align: center;"><?php echo DISCOUNT; ?></div>
                                    <div id="price_title" style="width:100px;text-align: center;"><?php echo FREE_BIDS; ?></div>
                                    <div id="price_title" style="width:80px;text-align: center;"><?php echo INDATE; ?></div>
                                    <div id="price_title" style="width:70px;text-align: center;"><?php echo ASSIGN_DATE; ?></div>
                                    <div id="price_title" style="width:250px;text-align: center;"><?php echo COUPON_CODE; ?></div>
                                </div>

                                <?php
                                if ($total > 0) {
                                    $a = 1;
                                    while ($obj = db_fetch_object($ressel)) {
                                ?>


                                        <div class="live-auction" style="background-color: white;">

                                            <div class="price-bidder" style="width:140px;font-size:14px;padding-left:10px;text-align: left;color:#2cab00;">
                                        <?php echo stripslashes($obj->title); ?>
                                    </div>

                                    <div class="price-bidder" style="width:70px;text-align: center;font-size:12px;color:#2cab00;">

                                        <?php echo $obj->discount; ?>

                                    </div>

                                    <div class="price-bidder" style="width:100px;text-align: center;font-size:12px;color:#2cab00;">

                                        <?php echo $obj->freebids; ?>

                                    </div>

                                    <div class="price-bidder" style="width:80px;text-align: center;font-size:12px;color:#2cab00;">
                                        <?php echo arrangedate($obj->startdate) . '<br/>' . arrangedate($obj->enddate); ?>

                                    </div>

                                    <div class="price-bidder" style="width:70px;text-align: center;font-size:12px;color:#2cab00;">
<?php echo arrangedate($obj->assigndate); ?>

                                    </div>

                                    <div class="price-bidder" style="width:250px;text-align: center;font-size:12px;color:#2cab00;">

                                        <?php echo $obj->uniqueid; ?>

                                    </div>

                                </div>

                                <?php $i++;
                                    } ?>

                                <?php } else {
                                ?>

                                    <br/><center><h3><?php echo NO_COUPON_TO_DISPLAY; ?></h3></center>
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
                                                        <div style="margin-top: 15px;" id="pagenumber_display"><?php echo TOTAL . ' ' . $totalauc . ' ' . RESULTS ?>, <?php echo $PageNo . ' ' . OF . ' ' . $totalpage . ' ' . PAGES; ?> </div>
                                                    </td>
                                                    <td width="30">&nbsp;</td>
                                                    <td valign="middle">
                                                        <span id="pagination">
                                                        <?php if ($PageNo > 1) {
                                                        ?>
                                                            <a style="width: 50px;" id="prev" href="mycoupon.php?pgno=<?php echo $PageNo - 1; ?>"><?php echo PREVIOUS; ?></a>
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
                                                            <a href="mycoupon.php?pgno=<?php echo $page; ?>" class="<?php echo $page == $PageNo ? 'selected' : ''; ?>"><?php echo $page; ?></a>&nbsp;
                                                        <?php } ?>


                                                        <?php if ($PageNo < $totalpage) {
                                                        ?>
                                                            <a id="next" href="mycoupon.php?pgno=<?php echo $PageNo + 1; ?>"><?php echo NEXT; ?></a>
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

