 
        <div id="main">
            <?php include("header.php"); ?>
            <div id="container">
                <?php include("include/topmenu.php"); ?>
                <div class="tab-area">
                <div id="column-right">
                    <?php include("include/searchbox.php"); ?>
                    <div id="title-category-content">
                        <?php include("include/categorymenu.php"); ?>
                        <p class="bid-title"><em><?php echo $SITE_NM; ?>-<?php echo WATCHED_AUCTIONS; ?></em></p>
                    </div><!-- /title-category-content -->
                    <div id="mybids-box" class="content">
                        <?
                        if ($total > 0) {
                        ?><form name="watchauc" method="post" action="watchauctions.php">
                            <?
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

                               $cornerImag = cornerImag();

                                    $seatauction = $obj['seatauction'];
                                    if ($seatauction == true && $obj['seatcount'] >= $obj['minseats']) {
                                        $seatauction = false;
                                    }
                                $pname = $obj['bidpack'] ? $obj['bidpack_name'] : $obj['name'];
                                $picture = $obj['bidpack'] ? $obj['bidpack_banner'] : $obj['picture1'];
                                $price = $obj['bidpack'] ? $obj['bidpack_price'] : $obj['price'];
                                $short_desc = $obj['bidpack'] ? "{$obj['bid_size']} Bids and {$obj['freebids']} Freebids" : $obj['short_desc'];
                            ?>
                                <div class="bid-box">
                                <?php if ($cornerImag != '') {
                                ?>
                                    <div class="corner_imagev1">
                                        <img src="img/icons/<?php echo $cornerImag; ?>"  alt=""/>
                                    </div>
                                <?php } ?>
                                <div class="bid-image">
                                    <?php if ($obj['uniqueauction'] == false) {
 ?>
                                        <a href="<?php echo SEOSupport::getProductUrl($pname, $obj["auctionID"], 'n'); ?>">
                                            <img src="<?= $UploadImagePath; ?>products/thumbs_small/thumbsmall_<?= $picture; ?>" alt="" width="118" height="100" border="0"/>
                                        </a>
                                    <?php } else { ?>
                                        <a href="<?php echo SEOSupport::getProductUrl($pname, $obj["auctionID"], 'l'); ?>">
                                            <img src="<?= $UploadImagePath; ?>products/thumbs_small/thumbsmall_<?= $picture; ?>" alt="" width="118" height="100" border="0"/>
                                        </a>
                                    <?php } ?>

                                    <?php if ($obj["auc_status"] == 2) {
                                    ?>
                             <?php if ($seatauction == true) {
                                ?>
                                        <div id="seat_button_<?php echo $obj["auctionID"]; ?>">
                                            <a id="image_main_<?php echo $obj["auctionID"]; ?>" class="button butseat-button-link" name="getseat.php?prid=<?php echo $obj["productID"]; ?>&aid=<?php echo $obj["auctionID"]; ?>&uid=<?php echo $uid; ?>"><?php echo BUY_A_SEAT; ?></a>
                                        </div>
                                <?php } ?>

                                    <div id="normal_button_<?php echo $obj["auctionID"]; ?>" style="display:<?php echo $seatauction == true ? 'none' : 'block'; ?>">
                                    <?php if ($obj['uniqueauction'] == false) {
                                    ?>
                                        <a id="image_main_<?php echo $obj["auctionID"]; ?>" class="button bid-button-link" name="getbid.php?prid=<?php echo $obj["productID"]; ?>&aid=<?php echo $obj["auctionID"]; ?>&uid=<?php echo $uid; ?>"><?php echo PLACE_BID; ?></a>

                                    <?php } else {
                                    ?>
                                        <a id="image_main_<?php echo $obj["auctionID"]; ?>" rel="<?php echo $obj["auctionID"]; ?>" class="button ubid-button-link" name="getuniquebid.php?prid=<?php echo $obj["productID"]; ?>&aid=<?php echo $obj["auctionID"]; ?>&uid=<?php echo $uid; ?>"><?php echo PLACE_BID; ?></a>
                                    <?php } ?>
                                </div>
<?php
//Buy it now

if($obj["allowbuynow"]==true)
{
if(empty($_SESSION['userid'])){
?>

<a id="image_main_<?php echo $obj["auctionID"]; ?>" class="button butseat-button-link" onclick="window.location.href='login.php'" onmouseout="$(this).text('<?php echo BUY_NOW. " @ " . $Currency . $obj["buynowprice"];?>')" onmouseover="$(this).text('<?php echo LOGIN; ?>')"><?php echo BUY_NOW . " @ ".$Currency . $obj["buynowprice"]; ?></a>

<?php
}else{
?>
<a id="image_main_<?php echo $obj["auctionID"]; ?>" style="font-size:10px;" class="button butseat-button-link" href="buyitnow.php?auctionId=<?php echo $obj["auctionID"]; ?>&uid=<?php echo $uid; ?>"
onmouseout="$(this).text('<?php echo BUY_NOW. " @ " . $Currency . $obj["buynowprice"];?>')"
onmouseover="$(this).html($('#bids_back_html_<?php echo $obj['auctionID']; ?>').html());">
<?php echo BUY_NOW . " @ ".$Currency . $obj["buynowprice"]; ?>
</a>
<div style="display:none;" id="bids_back_html_<?php echo $obj['auctionID']; ?>">
<?php echo AND_GET;?> <em id='bids_back_<?= $obj["auctionID"]; ?>'>0</em> <?php echo BIDS;?> <?php echo AND_TXT; ?> <em id='free_bids_<?= $obj["auctionID"]; ?>'>0</em> <?php echo FREE_BIDS;?> <?php echo BACK;?>
</div>

<?php
}
}
else
{
?>
<!--<p style="color:red;"><?php echo BUY_IT_NOW_UNAVAILABLE;?></p>-->
<?php
}
?>
                            </div><!-- /bid-image -->
                            <div class="bid-content">
                                <h2>
<?php if ($obj['uniqueauction'] == false) { ?>
                                    <a href="<?php echo SEOSupport::getProductUrl($pname, $obj["auctionID"], 'n'); ?>"><?= stripslashes($pname); ?></a>
<?php } else { ?>
                                    <a href="<?php echo SEOSupport::getProductUrl($pname, $obj["auctionID"], 'l'); ?>"><?= stripslashes($pname); ?></a>
<?php } ?>
                                    <?php } elseif ($obj["auc_status"] == 3) {
                                    ?>
                                        <img src="img/buttons/btn-sold_119.png" border="0" id="image_main_<?= $obj["auctionID"]; ?>" style="cursor: pointer" />
                                    <?php } elseif ($obj["auc_status"] == 1) {
                                    ?>
                                        <img src="img/buttons/btn_placebid_119.png" border="0" id="image_main_<?= $obj["auctionID"]; ?>" style="cursor: pointer" />
                                    <?php } ?>
                                    <div class="watchextdelete" style="text-align:center;"><input type="checkbox" value="<?= $obj["wid"]; ?>" name="delauction[]" /></div>
                                </div><!-- /bid-image -->
                                <div class="bid-content">
                                    <h2>
                                        <?php if ($obj['uniqueauction'] == false) {
                                        ?>
                                            <a href="<?php echo SEOSupport::getProductUrl($pname, $obj["auctionID"], 'n'); ?>"><?= stripslashes($pname); ?></a>
                                        <?php } else {
                                        ?>
                                            <a href="<?php echo SEOSupport::getProductUrl($pname, $obj["auctionID"], 'l'); ?>"><?= stripslashes($pname); ?></a>
                                        <?php } ?>


                                    </h2>
                                    <h3><?php echo DESCRIPTION; ?>:</h3>
                                    <p><?= choose_short_desc(stripslashes($short_desc), 110); ?>
                                        <?php if ($obj['uniqueauction'] == false) {
                                        ?>
                                            <a href="<?php echo SEOSupport::getProductUrl($pname, $obj["auctionID"], 'n'); ?>"><?php echo MORE; ?></a>
                                        <?php } else {
                                        ?>
                                            <a href="<?php echo SEOSupport::getProductUrl($pname, $obj["auctionID"], 'l'); ?>"><?php echo MORE; ?></a>
                                        <?php } ?>
                                    </p>
                                    <p class="bidder">
                                        <?php if ($obj["auc_status"] == 2) {
                                        ?>
                                            <span class="auction-item" title="<?= $obj["auctionID"]; ?>" id="auction_<?= $obj["auctionID"]; ?>"></span>
                                        <?php if ($obj['uniqueauction'] == false) {
                                        ?>
                                                <strong><?php echo HIGH_BIDDER; ?>:</strong> <span id="product_bidder_<?= $obj["auctionID"]; ?>">---</span>
                                        <?php } else {
                                        ?>
                                                <input id="lowestprice_<?php echo $obj["auctionID"]; ?>"  <?php echo $uid == 0 ? 'disabled' : ''; ?> name="lowestprice_<?php echo $obj["auctionID"]; ?>"/>
                                        <?php } ?>
                                        <?php } elseif ($obj["auc_status"] == 3) {
                                        ?>
                                            <strong><?php echo HIGH_BIDDER; ?>:</strong>
                                            <span class="bidderfont" id="product_bidder_<?= $obj["auctionID"]; ?>"><?= $username != "" ? $username : "---"; ?></span>
                                        <?php } else {
                                        ?>
                                            <strong><?php echo HIGH_BIDDER; ?>:</strong>
                                            <span class="bidderfont" id="product_bidder_<?= $obj["auctionID"]; ?>">---</span>
                                        <?php } ?>
                                    </p>
                                </div><!-- /bid-content -->
                                <div class="bid-countdown">
                                    <?php if ($seatauction) {
                                ?>
                                            <div class="seat_panel" id="seat_panel_<?php echo $obj["auctionID"]; ?>">
                                                <div class="seat_bar" id="seat_bar_<?php echo $obj["auctionID"]; ?>">
                                                </div>

                                                <div class="seat_count">
                                                    <span id="seat_count_<?php echo $obj["auctionID"]; ?>">-</span>/<span><?php echo $obj['minseats']; ?></span>
                                                </div>
                                                <div class="seat_text1"><?php echo SEATS_AVAILABLE; ?></div>
                                                <div class="seat_text2">
                                        <?php echo SEAT_AUCTION_DESCRIPTION; ?>
                                        </div>
                                        <div class="seat_text3">
                                        <?php echo FROM_W; ?>:<span><?php echo $Currency . $obj['auc_start_price'] ?></span>&nbsp;&nbsp;
                                        <?php echo SEAT_BIDS; ?>:<span><?php echo $obj['seatbids'] ?></span>
                                        </div>
                                        <p class="instead"><?php echo INSTEAD_OF; ?> <?= $Currency . number_format($price, 2); ?></p>
                                    </div>

                                <?php }
                                ?>
                                    <div id="normal_panel_<?php echo $obj["auctionID"]; ?>" style="display:<?php echo $seatauction == true ? 'none' : 'block'; ?>">
                                    <p class="timerbox"><?php echo COUNTDOWN; ?> <strong>
                                            <?php if ($obj["auc_status"] == 2) {
                                            ?>
                                                <span class="countfont" id="counter_index_page_<?= $obj["auctionID"]; ?>">
                                                <?
                                                echo "<script language=javascript>
    
                                  document.getElementById('counter_index_page_" . $obj["auctionID"] . "').innerHTML = calc_counter_from_time('" . $obj["auc_due_time"] . "');
    
                                 </script>";
                                                ?>
                                            </span>
                                            <?php } elseif ($obj["auc_status"] == 1) {
                                            ?>
                                                <span class="countfont" id="counter_index_page_<?= $obj["auctionID"]; ?>">--:--:--</span>
                                            <?php } else {
                                            ?>
                                                <span class="countfont"><?php echo ENDED; ?></span>
                                            <?php } ?>
                                        </strong>
                                    </p>
                                    <p class="instead">
                                        <strong>
                                            <?php if ($obj["auc_status"] == 2) {
                                            ?>
                                                <div class="auction-item" title="<?= $obj["auctionID"]; ?>" id="auction_<?= $obj["auctionID"]; ?>"></div>
                                            <?php if ($obj['uniqueauction'] == false) {
                                            ?>
                                                    <strong><span id="currencysymbol_<?= $obj["auctionID"]; ?>"></span><span id="price_index_page_<?= $obj["auctionID"]; ?>">---</span></strong>
                                            <?php } else {
                                            ?>
                                                    <strong><span id="ubid_index_page_<?= $obj["auctionID"]; ?>">---</span>&nbsp;<?php echo BIDS; ?></strong>
                                            <?php } ?>
                                            <?php } elseif ($obj["auc_status"] == 3) {
                                            ?>
                                                <span id="price_index_page_<?= $obj["auctionID"]; ?>"><?= $Currency; ?><?= number_format($obj["auc_due_price"], 2); ?></span><br />
                                            <?php } else {
                                            ?>
                                                <span id="price_index_page_<?= $obj["auctionID"]; ?>"><?= $Currency; ?><?= number_format($obj["auc_start_price"], 2); ?></span><br />
                                            <?php } ?>
                                        </strong>
                                    </p>
                                    </div>
                                </div><!-- /bid-countdown -->
                            </div><!-- /bid-box -->
                            <?php } ?>
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
                                                <li><a href="myaccount.php?pgno=<?= $PrevPageNo;
                                    ?>">&lt; <?php echo PREVIOUS_PAGE; ?></a></li>
                                        <?
                                            }
                                        ?>
                                        <?
                                            if ($PageNo < $totalpage) {
                                                $NextPageNo = $PageNo + 1;
                                        ?>
                                            <li><a id="next" href="myaccount.php?pgno=<?= $NextPageNo;
                                        ?>"><?php echo NEXT_PAGE; ?> &gt;</a></li>
                                        <?
                                            }
                                        ?>
                                    </ul>
                                </div>
                            <?php } ?><!--page number-->
                                        <div style="width: 320px; float:left; text-align: right;"><b><?php echo DELETE_SELECTED_AUCTION_FROM_THE_LIST; ?> &raquo; <a class="blue_link" onclick="deleteauc();" style="cursor: pointer"><?php echo DELETE; ?></a></b></div>
                                    </form>
                        <?php } else {
                        ?>
                                        <div class="clear" style="height: 20px;">&nbsp;</div>
                                        <div align="center"><?php echo NO_WATCHED_AUCTIONS_TO_DISPLAY; ?></div>
                                        <div class="clear" style="height: 20px;">&nbsp;</div>
                        <?php } ?>
                                </div><!-- /content -->
                            </div><!-- /column-right -->
                            <div id="column-left">
                    <?php include("leftside.php"); ?>
                 
                           
                                </div><!-- /column-left -->
                                </div>
                            </div><!-- /container -->
            <?php include("include/footer.php"); ?>
        