<?php

if (!$_REQUEST['pgNo']) {
    $PageNo1 = 1;
} else {
    $PageNo1 = $_REQUEST['pgNo'];
}

$qrysel1 = "select a.auctionID,a.productID as productID,a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_type,auc_recurr,buy_user,
        auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,
        use_free,allowbuynow,buynowprice,reverseauction,uniqueauction,halfbackauction,bidpack,tax1,tax2,bidpack_name,bidpack_banner,bidpack_price,price,bid_size,freebids ,p.name,p.picture1,short_desc,sum(ba.bid_count) as bidcount, a.auc_status as aucstatus from bid_account ba left join products p on ba.product_id=p.productID left join auction a on ba.auction_id=a.auctionID left join bidpack b on b.id=a.productID where user_id='$uid' and bidding_type!='m' and (ba.bid_flag='d' or ba.bid_flag='b' or ba.bid_flag='s') group by ba.auction_id order by ba.id desc";
       
$rssel1 = db_query($qrysel1);
$total1 = db_num_rows($rssel1);

$totalpage1 = ceil($total1 / $PRODUCTSPERPAGE_MYACCOUNT);

if ($totalpage1 >= 1) {
    $startrow = $PRODUCTSPERPAGE_MYACCOUNT * ($PageNo1 -1);
    $qrysel1.=" LIMIT $startrow,$PRODUCTSPERPAGE_MYACCOUNT";
    //echo $sql;
    $rssel1 = db_query($qrysel1);
    $total1 = db_num_rows($rssel1);
}




$totalpagesselfmain = ($totalpagesself + $totalpagesself2);

if ($totalpagesselfmain >= 1) {
    $startrow = $PRODUCTSPERPAGE_MYACCOUNT * ($PageNo2 - 1);
    if ($qryflag1 == 1) {
        $startrow = $PRODUCTSPERPAGE_MYACCOUNT * ((($PageNo2 - $totalpagesself)) - 1);
    }

}
    $qryself.=" LIMIT $startrow,$PRODUCTSPERPAGE_MYACCOUNT";
    //echo $sql;
    $resself = db_query($qryself);
    $totalself = db_num_rows($resself);

 if ($total1 > 0) {
                                    ?>
                                                        <br/>
                                                        <br/>
                                                        <h1><?php echo PLACED_BIDS; ?></h1>
                                                        <br/>

                                                        <div id="myqb-auctions">
                                                            <div id="myqb-auctions-head">
                                                                <div id="thumbheader">&nbsp;</div>
                                                                <div id="product_title"><?php echo PRODUCTS; ?></div>
                                                                <div id="price_title"><?php echo "BID TYPE"; ?></div>
                                                                <div id="countdown_title"><?php echo COUNTDOWN; ?></div>
                                                            </div>

                                                            <div id="myqb-auction-body">
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
                                                            $cornerImag = cornerImag($obj1);
                                            ?>

                                                            <div class="auction-item" title="<?php echo $obj1["auctionID"]; ?>" id="auction_<?php echo $obj1["auctionID"]; ?>">
                                                                <div class="live-auction" style="background-color: white;">
                                                    <?php if ($cornerImag != '') {
                                                    ?>
                                                                <div class="corner_imagev1">
                                                                    <img src="../img/icons/<?php echo $cornerImag; ?>"  alt=""/>
                                                                </div>
                                                    <?php } ?>
                                                            <a href="../viewproduct.php?aid=<?php echo $obj1["auctionID"]; ?>" class="thumb" style="background-image: url('<?php echo $UploadImagePath; ?>products/thumbs_small/thumbsmall_<?php echo $obj1["picture1"]; ?>');"></a>
                                                            <div class="live-a-content">
                                                                <h2>
                                                                    <a href="../viewproduct.php?aid=<?php echo $obj1["auctionID"]; ?>"><?php echo stripslashes($obj1["name"]); ?></a>
                                                                </h2>
                                                                <br/>
                                                                <p><?php echo stripslashes($obj1['short_desc']); ?></p>
                                                            </div>
                                                            <div class="price-bidder" style="margin:-75px 0 0 270px;">
                                                                <label style="font-size:13px;"><?php echo $status; ?></label>
                                                                <br/><br/>
                                                                <label class="winner"><?php echo arrangedate($startdate); ?></label>
                                                            </div>
                                                            <div class="countdown">
                                                                <div class="buttonoffset">
                                                                    <img alt="" src="../images/icon_gbkplus.gif" onclick="BidHistoryPlus('bidd<?php echo $obj1["auctionID"]; ?>','plusimage<?php echo $obj1["auctionID"]; ?>','minusimage<?php echo $obj1["auctionID"]; ?>');" id="plusimage<?php echo $obj1["auctionID"]; ?>" style="cursor:pointer;" align="right"/>
                                                                    <img alt="" src="../images/icon_gbkminus.gif" onclick="BidHistoryMinus('bidd<?php echo $obj1["auctionID"]; ?>','plusimage<?php echo $obj1["auctionID"]; ?>','minusimage<?php echo $obj1["auctionID"]; ?>');" id="minusimage<?php echo $obj1["auctionID"]; ?>" style="display: none;z-index: 1000;cursor:pointer;" align="right"/>

                                                                </div>
                                                                <label class="timer time-left">
                                                                    -<?php echo getTotalPlaceBids($obj1["auctionID"], $uid); ?>
                                                                </label>

                                                                <div id="bidd<?php echo $obj1["auctionID"]; ?>" style="margin-top: -10px;margin-left:-170px; padding-right: 10px; display:none; ">
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
                                            
                                            </div>
                                              <div id="pagination-container2">

                                            <?php if ($totalpage1 > 0) { ?>

                                                                <span id="pagination">
                                                <?php if ($PageNo1 > 1) {
                                                ?>
                                                                    <a id="prev" href="javascript:;" onclick="bidhistory('member_stats.php?pgNo=<?php echo $PageNo1 - 1; ?>&uid=<?php echo $uid;?>');"><?php echo PREVIOUS; ?></a>
                                                <?php } else {
                                                ?>
                                                                    <a id="prev"><span><?php echo PREVIOUS; ?></span></a>
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
                                                                    <a href="javascript:;" onclick="bidhistory('member_stats.php?pgNo=<?php echo $page; ?>&uid=<?php echo $uid;?>');" class="<?php echo $page == $PageNo1 ? 'selected' : ''; ?>"><?php echo $page; ?></a>&nbsp;
                                                <?php } ?>


                                                <?php if ($PageNo < $totalpage) {
                                                ?>
                                                                    <a id="next" href="javascript:;" onclick="bidhistory('member_stats.php?pgNo=<?php echo $PageNo1 + 1; ?>&uid=<?php echo $uid;?>');"><?php echo NEXT; ?></a>
                                                <?php } else {
                                                ?>
                                                                    <a id="next"><span><?php echo NEXT; ?></span></a>
                                                <?php } ?>

                                                            </span>

                                            <?php } else {
 ?>
						    </div>
                                                                <div class="live-auction">
                                                                    <h4><?php echo YOU_DO_NOT_HAVE_ANY_BIDS; ?></h4>
                                                                </div>
                                            <?php
                                                            }
                                                            db_free_result($rssel1);
                                                            
                                                            
                                                            }
                                            ?>
                                                        
                                                      
                                            