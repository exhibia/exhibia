<?php


if (!$_REQUEST['pgno2']) {
    $PageNo2 = 1;
} else {
    $PageNo2 = $_REQUEST['pgno2'];
}

$qryself_free = "select * from free_account fa left join bidpack b on fa.bidpack_id=b.id left join redemption r on fa.redemption_id=r.id where user_id='$uid' and bid_flag!='b' and auction_id='0' order by fa.id desc";

$resself_free = db_query($qryself_free);
$totalself_free = db_num_rows($resself_free);
$totalpagesself_free = ceil($totalself_free / $PRODUCTSPERPAGE_MYACCOUNT);
if ($totalself_free >= 1) {
    
   
}
$startrow1 = $PRODUCTSPERPAGE_MYACCOUNT * ($PageNo2 - 1);
    $qrysel_free1 = $qryself_free . " LIMIT $startrow1,$PRODUCTSPERPAGE_MYACCOUNT";
    //echo $sql;
   
    $resself_free1 = db_query($qrysel_free1);
    
    
$qryself2 = "select *,sum(bid_count) as placebids from free_account fa left join auction a on fa.auction_id=a.auctionID where user_id='$uid' and bid_flag!='b' and auction_id!='0' group by fa.auction_id order by fa.id desc";

if ($PageNo2 > $totalpagesself) {
    $qryself = $qryself2;
    $qryflag1 = 1;
}
$resself2 = db_query($qryself2);
$totalself2 = db_num_rows($resself2);
$totalpagesself2 = ceil($totalself2 / $PRODUCTSPERPAGE_MYACCOUNT);



if ($totalself_free > 0) {
                                    ?>
                                                    <!-- ============= Recently Won Auctions =============  -->

                                                    <!--begin free bid-->
                                                    <br/>
                                                    <br/>
                                                    <h1><?php echo FREE_BIDS; ?></h1>
                                                    <br/>


                                                    <div id="myqb-auctions">
                                                        <div id="myqb-auctions-head">
                                                        <div id="product_title" style="width:340px;margin-top:-15px;"><?php echo DESCRIPTION; ?></div>
                                                            <div id="price_title"><?php echo DATE; ?></div>
                                                            <div id="price_title"><?php echo BIDS; ?></div>
                                                        </div>
                                                        <div id="myqb-auction-body">
                                            <?php
                                                    $i = 1;
                                                    while ($objself = db_fetch_array($resself_free1)) {

                                                        $date = substr($objself["bidpack_buy_date"], 0, 10);
                                            ?>

                                                        <div>
                                                            <div class="live-auction" style="background:url(../img/myQuibids-bids-bg.png);height:60px;">

                                                                <div class="live-a-content">
                                                                    <div style="font-size:13px;">
                                                            <?php echo $objself["credit_description"]; ?>
                                                            <?php echo $objself["bidpack_name"] != "" ? "&nbsp;(" . $objself["bidpack_name"] . ")" : ""; ?>
                                                            <?php echo $objself["redemption_id"] != "0" ? GetRedemptionName($objself["redemption_id"]) : ""; ?>
                                                            <?php echo $objself["auction_id"] != "0" ? "Placed on auction" . GetAuctionName($objself["auction_id"]) : "" ?>
                                                        </div>

                                                    </div>
                                                    <div class="price-bidder">
                                                        <?php echo arrangedate($date) . "<br/>" . substr($objself["bidpack_buy_date"], 11); ?>
                                                        </div>

                                                        <div class="countdown">
                                                        <?php if ($objself["bid_flag"] == 'c') {
                                                        ?>
                                                        <?php
                                                                if ($objself["bid_count"] > 0) {
                                                        ?>
                                                                    <span class="greenfont"><b>+<?= $objself["bid_count"];
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
                                                        } 
                                                        echo db_error();
                                                        ?>
                                                    </div>

                                                    <div id="pagination-container2">

                                            <?php if ($totalpagesself_free > 0) {
                                            ?>

                                                            <span id="pagination">
                                                <?php if ($PageNo2 > 1) {
                                                ?>
                                                                <a id="prev" href="javascript:;" onclick="bidhistory('member_stats.php??pgno2=<?php echo $PageNo2 - 1; ?>&uid=<?php echo $uid;?>');"><?php echo PREVIOUS; ?></a>
                                                <?php } else {
                                                ?>
                                                                <a id="prev"><span><?php echo PREVIOUS; ?></span></a>
                                                <?php } ?>

                                                            &nbsp;

                                                <?php
                                                            $pagestart = $PageNo2 - 3;
                                                            if ($pagestart < 1) {
                                                                $pagestart = 1;
                                                            }

                                                            $pageend = $pagestart + 7;
                                                            if ($pageend > $totalpagesself_free) {
                                                                $pageend = $totalpagesself_free;
                                                            }

                                                            for ($page = $pagestart; $page <= $pageend; $page++) {
                                                ?>
                                                                <a href="javascript:;" onclick="bidhistory('member_stats.php?pgno2=<?php echo $page; ?>&uid=<?php echo $uid;?>');" class="<?php echo $page == $PageNo2 ? 'selected' : ''; ?>"><?php echo $page; ?></a>&nbsp;
                                                <?php } ?>


                                                <?php if ($PageNo2 < $totalpage) {
                                                ?>
                                                                <a id="next" href="javascript:;" onclick="bidhistory('member_stats.php?pgno2=<?php echo $PageNo2 + 1; ?>&uid=<?php echo $uid;?>');"><?php echo NEXT; ?></a>
                                                <?php } else {
                                                ?>
                                                                <a id="next"><span><?php echo NEXT; ?></span></a>
                                                <?php } ?>

                                                        </span>
                                            <?php } ?>

                                                    </div>

                                                </div>
                                    <?php
                                                    }
                                                    db_free_result($resself_free);