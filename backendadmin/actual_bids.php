<?php

ini_set('display_errors', 1);	 


$changeimage = "myaccount";


if (!$_REQUEST['pgno']) {
    $PageNo = 1;
} else {
    $PageNo = $_REQUEST['pgno'];
}

$qrysel = "select *,credit_description as credit_description from bid_account ba left join bidpack b on ba.bidpack_id=b.id where user_id=$uid and ba.bid_flag='c' order by ba.id desc";

$rssel = db_query($qrysel);
$total = db_num_rows($rssel);
$totalpage = ceil($total / $PRODUCTSPERPAGE_MYACCOUNT);

if ($totalpage >= 1) {
  $startrow = $PRODUCTSPERPAGE_MYACCOUNT * ($PageNo - 1);
    $qrysel.=" LIMIT $startrow,$PRODUCTSPERPAGE_MYACCOUNT";
  
    $rssel = db_query($qrysel);
    $total = db_num_rows($rssel);  
}
echo db_error();
    
      if ($total > 0) {
                                    ?>
                                        <!-- ============= Recently Won Auctions =============  -->
                                        <h1><?php echo PURCHASED_BIDS; ?></h1>
                                        <br/>

                                        <div id="myqb-auctions">
                                            <div id="myqb-auctions-head">
                                             <div id="product_title"><?php echo DESCRIPTION; ?></div>
                                                <div id="price_title"><?php echo DATE; ?></div>
                                                <div id="price_title"><?php echo BIDS; ?></div>
                                            </div>

                                            <div id="myqb-auction-body">
                                            <?php
                                            $i = 1;
                                         
                                            while ($objself = db_fetch_array($rssel)) {

                                                $date = substr($objself["bidpack_buy_date"], 0, 10);
                                            ?>

                                                <div>
                                                    <div class="live-auction" style="background:url(../img/myQuibids-bids-bg.png);height:60px;">

                                                        <div class="live-a-content" >
                                                        <?php echo $objself["credit_description"]; ?>
                                                    </div>
                                                    <div class="price-bidder">
                                                        <?php echo arrangedate($date) . "<br/>" . substr($objself["bidpack_buy_date"], 11); ?>
                                                    </div>

                                                    <div class="countdown">
                                                        <?php
                                                        if ($objself["bid_count"] > 0) {
                                                        ?>
                                                            <span class="greenfont">+<?php echo $objself["bid_count"]; ?></span>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <span class="redfont"><?php echo $objself["bid_count"];
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

                                                </div>
                                                <div id="pagination-container2">

                                            <?php if ($totalpage > 0) {
                                            ?>

                                                        <span id="pagination">
                                                <?php if ($PageNo > 1) {
                                                ?>
                                                            <a id="prev" href="javascript:;" onclick="bidhistory('member_stats.php?pgno=<?php echo $PageNo - 1; ?>&uid=<?php echo $uid;?>');"><?php echo PREVIOUS; ?></a>
                                                <?php } else {
                                                ?>
                                                            <a id="prev"><span><?php echo PREVIOUS; ?></span></a>
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
                                                            <a href="javascript:;" onclick="bidhistory('member_stats.php?pgno=<?php echo $page; ?>&uid=<?php echo $uid;?>');" class="<?php echo $page == $PageNo ? 'selected' : ''; ?>"><?php echo $page; ?></a>&nbsp;
                                                <?php } ?>


                                                <?php if ($PageNo < $totalpage) {
                                                ?>
                                                            <a id="next" href="javascript:;" onclick="bidhistory('member_stats.php?pgno=<?php echo $PageNo + 1; ?>&uid=<?php echo $uid;?>');"><?php echo NEXT; ?></a>
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
                                                
                                                db_free_result($rssel);