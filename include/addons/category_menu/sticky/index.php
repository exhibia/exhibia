 <?php
 if(empty($cat_menu)){
 
 $cat_menu = 'set';
 
 
 ?>
    <select name="category" id="category" style="">
                    <option value="allauctions.php?aid=2"><?php echo ALL_CATEGORIES; ?></option>
                    <option value="allauctions.php?aid=2"><?php echo ALL_LIVE_AUCTIONS; ?> (<?php echo checkaucstatus(2); ?>)</option>
                    <option value="allauctions.php?aid=4"><?php echo REVERSE_AUCTION_W; ?> (<?php echo $adb->getReverseCount(); ?>)</option>
                    <option value="allauctions.php?aid=5"><?php echo LOWEST_UNIQUE_AUCTION_W; ?> (<?php echo $adb->getLowestUniqueCount(); ?>)</option>
                    <?php
                    $resc = db_query("select categoryID as cid, name, (select count(*) from auction where categoryID=cid and auc_status='2') as cnt from categories where status=1");
                    while (( $cat = db_fetch_array($resc))) {
                    ?>
                        <option value="allauctions.php?id=<?php echo $cat["cid"]; ?>">&nbsp;&nbsp;&nbsp;<?= htmlspecialchars(stripcslashes($cat["name"]), ENT_QUOTES); ?> (<?php echo $cat["cnt"]; ?>)</option>
                    <?php
                    }
                    db_free_result($resc);
                    ?>
                    <option value="allauctions.php?aid=1"><?php echo FUTURE_AUCTIONS; ?> (<?php echo checkaucstatus(1); ?>)</option>
                    <option value="allauctions.php?aid=3"><?php echo ENDED_AUCTIONS; ?> (<?php echo checkaucstatus(3); ?>)</option>
                </select> 
<?php } ?>