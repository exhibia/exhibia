 
 <!-- TOP PART 2 CONTENT -->
                    <div style="width: 239px; float: right;">
                        <!-- Categories -->
                        <div class="common_categories">
                <?php
                    include_once 'data/auction.php';
                    $adb = new Auction(null);
                ?>
                    <ul id="common_categories">
                        <!-- Home -->
                        <li style="width: 109px;">
                                <!--[if lte IE 6]><a href="<?php echo $SITE_URL;?>#"><table><tr><td><![endif]-->
                            <dl>
                                <dt class="one"><span><?php echo ALL_CATEGORIES; ?></span></dt>
                                <dd><a href="<?php echo $SITE_URL;?>allauctions.php?aid=2"><?php echo ALL_LIVE_AUCTIONS; ?> (<?php echo checkaucstatus(2); ?>)</a></dd>
                                <dd><a href="<?php echo $SITE_URL;?>allauctions.php?aid=4"><?php echo REVERSE_AUCTION_W; ?> (<?php echo $adb->getReverseCount(); ?>)</a></dd>
                                <dd><a href="<?php echo $SITE_URL;?>allauctions.php?aid=5"><?php echo LOWEST_UNIQUE_AUCTION_W; ?> (<?php echo $adb->getLowestUniqueCount(); ?>)</a></dd>
                            <?php
                            $resc = db_query("select categoryID as cid, name, (select count(*) from auction where categoryID=cid and auc_status='2') as cnt from categories where status=1");
                            while (( $cat = db_fetch_array($resc))) {
                            ?>
                                <dd><a href="<?php echo $SITE_URL;?>allauctions.php?id=<?= $cat["cid"]; ?>" style="padding-left: 23px;"><?php echo htmlspecialchars(stripcslashes($cat["name"]), ENT_QUOTES); ?> (<?php echo $cat["cnt"]; ?>)</a></dd>
                            <?php
                            }
                            db_free_result($resc);
                            ?>
                            <dd><a href="<?php echo $SITE_URL;?>allauctions.php?aid=1"><?php echo FUTURE_AUCTIONS; ?> (<?php echo checkaucstatus(1); ?>)</a></dd>
                            <dd><a href="<?php echo $SITE_URL;?>allauctions.php?aid=3"><?php echo ENDED_AUCTIONS; ?> (<?php echo checkaucstatus(3); ?>)</a></dd>
                            <dd class="last"><div>&nbsp;</div></dd>		</dl>
                        <!--[if lte IE 6]></td></tr></table></a><![endif]-->
                    </li>
                    <!-- Home -->
                </ul>
            </div>     <!-- Categories -->