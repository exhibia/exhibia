
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
                            <h1><?php echo VOUCHERS; ?></h1>
                            <div class="clear"></div>

                            <div id="myqb-auctions">
                                <div id="myqb-auctions-head">
                                    <div id="price_title" style="width:80px;text-align: center;"><?php echo DATE; ?></div>
                                    <div id="price_title" style="width:240px;text-align: left;"><?php echo VOUCHER_LABEL; ?></div>
                                    <div id="price_title" style="width:70px;text-align: center;"><?php echo AMOUNT; ?></div>
                                    <div id="price_title" style="width:100px;text-align: center;"><?php echo COMBINABLE; ?></div>
                                    <div id="price_title" style="width:80px;text-align: center;"><?php echo AUCTION; ?></div>
                                    <div id="price_title" style="width:70px;text-align: center;"><?php echo STATUS; ?></div>
                                    <div id="price_title" style="width:70px;text-align: center;"><?php echo VALID_TO; ?></div>
                                </div>

                                <?php
                                if ($total > 0) {
                                    $a = 1;
                                    while ($obj = db_fetch_array($ressel)) {
                                        $status = "";

                                        if ($obj["used_auction"] != "") {
                                            $qryauc = "select *,p." . $lng_prefix . "name as name from auction a left join products p on a.productID=p.productID where a.auctionID='" . $obj["used_auction"] . "'";
                                            $resauc = db_query($qryauc);
                                            $objauc = db_fetch_array($resauc);
                                        }
                                ?>


                                        <div class="live-auction" style="background-color: white;">

                                            <div class="price-bidder" style="width:80px;text-align: center;font-size:12px;color:#555;">
                                                
                                                    <?php echo arrangedate(substr($obj["issuedate"], 0, 10)); ?>
                                               
                                            </div>
                                            <div class="price-bidder" style="width:240px;font-size:12px;text-align: left;color:#2cab00;">
                                               

                                            <?php if ($obj["voucher_status"] == 1 || $obj["voucher_status"] == 2) {
                                            ?>
                                            <?php echo $obj["voucher_desc"]; ?>
                                            <?php } else {
                                            ?>
                                            <?php echo $obj["voucher_desc"]; ?>
                                            <?php } ?>
                                           
                                    </div>

                                    <div class="price-bidder" style="width:70px;text-align: center;font-size:12px;color:#555;">
                                        
                                            <?php echo $obj["voucher_type"] == 2 ? $Currency . $obj["bids_amount"] : substr($obj["bids_amount"], 0, strpos($obj["bids_amount"], ".", 1)) . "&nbsp;" . BIDS; ?> <?php echo $CurrencyName;?>
                                        
                                    </div>

                                    <div class="price-bidder" style="width:100px;text-align: center;font-size:12px;color:#2cab00;">
                                       
                                            <?php echo $obj["combinable"] == 1 ? YES : NO; ?>
                                        
                                    </div>

                                    <div class="price-bidder" style="width:80px;text-align: center;font-size:12px;color:#555;">
                                       
                                            <?php if ($obj["used_auction"] != "") {
                                            ?>
                                                <a href="viewproduct.php?aid=<?php echo $objauc["auctionID"]; ?>" class="darkblue-12-link">
                                                <?php echo stripslashes($objauc["name"]); ?>
                                            </a>
                                            <?php } else {
                                            ?>
                                                --
                                            <?php } ?>
                                       
                                    </div>

                                    <div class="price-bidder" style="width:70px;text-align: center;font-size:12px;color:#2cab00;">
                                        
                                            <?php if ($obj["voucher_status"] == '1') {
                                            ?>
                                            <?php echo USED; ?>
                                            <?php } elseif ($obj["voucher_status"] == '2') {
                                            ?>
                                            <?php echo EXPIRED; ?>
                                            <?php } else {
                                            ?>
                                            <?php echo RUNNING; ?>
                                            <?php } ?>
                                       
                                    </div>

                                    <div class="price-bidder" style="width:70px;text-align: center;font-size:12px;color:#555;">
                                        
                                            <?php echo $obj["expirydate"] != "0000-00-00 00:00:00" ? arrangedate(substr($obj["expirydate"], 0, 10)) : "--"; ?>
                                        
                                    </div>

                                </div>

                                <?php $i++;
                                        } ?>

                                <?php } else {
                                ?>

                                        <br/><center><h3><?php echo NO_VOUCHERS_TO_DISPLAY; ?></h3></center>
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
                                                        <div style="margin-top: 15px;" id="pagenumber_display"><?php echo TOTAL . ' ' . $totalv . ' ' . RESULTS ?>, <?php echo $PageNo . ' ' . OF . ' ' . $totalpage . ' ' . PAGES; ?> </div>
                                                    </td>
                                                    <td width="30">&nbsp;</td>
                                                    <td valign="middle">
                                                        <span id="pagination">
                                                        <?php if ($PageNo > 1) {
                                                        ?>
                                                            <a style="width: 50px;" id="prev" href="vouchers.php?pgno=<?php echo $PageNo - 1; ?>"><?php echo PREVIOUS; ?></a>
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
                                                            <a href="vouchers.php?pgno=<?php echo $page; ?>" class="<?php echo $page == $PageNo ? 'selected' : ''; ?>"><?php echo $page; ?></a>&nbsp;
                                                        <?php } ?>


                                                        <?php if ($PageNo < $totalpage) {
                                                        ?>
                                                            <a id="next" href="vouchers.php?pgno=<?php echo $PageNo + 1; ?>"><?php echo NEXT; ?></a>
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
 
