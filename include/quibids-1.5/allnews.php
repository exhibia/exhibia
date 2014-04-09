
        <div id="pagewidth">
            <!-- ============= Header =============  -->
            <?php include("$BASE_DIR/include/$template/header.php"); ?>
            <!-- ============= End Header =============  -->

            <div id="wrapper" class="clearfix">
                <div id="maincol">
                    <div id="auction-listing">
                        <div id="live-auctions">
                            <div id="live-auctions-head">
                                <h2><?php echo NEWS; ?></h2>
                            </div>

                            <h3><?php echo NEWS; ?> (<?php echo $total . ' ' . RESULTS ?>)</h3>
                            <div id="live-th">
                                <div id="product_title">&nbsp;</div>
                                <div id="price_title">&nbsp;</div>
                                <div id="countdown_title">&nbsp;</div>
                            </div>

                            <?php
                            if ($totalnews > 0) {
                                $i = 1;
                                while($objnews = db_fetch_array($rsselnews)){
                            ?>
                                    <div id="livespot_1">
                                        <div class="live-auction" id="auction_964929334" style="background-color: white;">                                            
                                            <div class="live-a-content" style="padding-left:20px;">
                                                <h2>
                                                    <a href="news.php?nid=<?=$objnews["id"];?>"><?=stripslashes($objnews["news_title"]);?></a>
                                                </h2>
                                                <p><?=stripslashes(choose_short_desc($objnews["news_short_content"],250));?></p>                                                
                                            </div>

                                            <div class="price-bidder">
                                                
                                    </div>

                                    <div class="countdown">
                                        <span style="font-size:12px;font-weight:normal;"><?=arrangedate($objnews["news_date"]);?></span>
                                    </div>

                                    <div class="clear"></div>

                                </div>
                            </div>

                            <?php
                                    }
                                }
                                db_free_result($rsselnews);
                            ?>


                                <div id="live-auctions-end">
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
                                                        <a style="width: 50px;" id="prev" href="allnews.php?pgno=<?php echo $PageNo - 1; ?>"><?php echo PREVIOUS; ?></a>
                                                    <?php } else {
                                                    ?>
                                                        <a style="width: 50px;" id="prev"><span style="color: rgb(192, 192, 192);"><?php echo PREVIOUS; ?></span></a>
                                                    <?php } ?>

                                                    &nbsp;

                                                    <?php
                                                    $pagestart=$PageNo-3;
                                                    if($pagestart<1){
                                                        $pagestart=1;
                                                    }

                                                    $pageend=$pagestart+7;
                                                    if($pageend>$totalpage){
                                                        $pageend=$totalpage;
                                                    }

                                                    for($page=$pagestart;$page<=$pageend;$page++){

                                                    ?>
                                                    <a href="allnews.php?pgno=<?php echo $page; ?>" class="<?php echo $page==$PageNo?'selected':''; ?>"><?php echo $page;?></a>&nbsp;
                                                    <?php }?>


                                                    <?php if ($PageNo < $totalpage) {
                                                    ?>
                                                        <a id="next" href="allnews.php?pgno=<?php echo $PageNo + 1; ?>"><?php echo NEXT; ?></a>
                                                    <?php } else {
                                                    ?>
                                                        <a id="next"><span style="color: rgb(192, 192, 192);"><?php echo NEXT; ?></span></a>
                                                    <?php } ?>

                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="wrap-end"></div>
        </div>

        <?php include("$BASE_DIR/include/$template/footer.php") ?>
    

