<div id="hd">

    <div id="topsection">
        <div id="logo" onclick="document.location='index.php'"></div>
        <div id="headerRight">
 
        
            <div id="heartbeat" style="width: 1px; height: 1px;">
            
            </div>
        </div>
        <div id="headeritems">
                  <?php
if(empty($languages)){
$languages = 'set';
?>
	<ul id="list-lenguages" style="position:absolute;top:10px;left:-100px;">
            <?php
            $langsel="select language,flag from language where enable=1";
            $langres=  db_query($langsel);
            while($langitem=  db_fetch_array($langres)){
            ?>
            <li><a href="<?php echo $SITE_URL;?>language.php?lang=<?php echo $langitem['language']; ?>&url=<?php echo $_SERVER['PHP_SELF']; ?>"><img src="<?php echo str_replace("uploads/", "", $UploadImagePath);
?>img/icons/<?php echo $langitem['flag']; ?>" alt="" /></a></li>
            <?php }?>
        </ul><!-- /list-lenguages -->
      <?php } ?>
            <div id="nav">
              <?php

if(in_array('topmenu', $addons)){
?>

    
   <?php 
	  echo get_menu('top_menu'); 
    ?>

<?php
}
?>

            </div>
   
            <div id="headerLogin">
                <?php
                if (!isset($_SESSION["userid"])) {
                ?>
                    <form name="f1" action="password.php" method="post" accept-charset="utf-8" id="login-form">
                                				<?php echo USERNAME; ?>: <input type="text" name="username" value="username" onfocus="_delete_login_fields(this, 'username', this.value);" id="username" class="loginInput"/>
                                				<?php echo PASSWORD; ?>: <input type="password" name="password" onfocus="_delete_login_fields(this, 'password', this.value);" value="password" id="password" class="loginInput"/>
                        <input name="btnlogin" src="css/bidcacti-classic/buttons/login_button.gif" type="image"/>
                    </form>
                <?php
                } else {
                    $resbal = db_query("select final_bids, free_bids from registration where id=" . $_SESSION["userid"]);

                    $objbal = db_fetch_object($resbal);
                ?>
                <?php echo WELCOME; ?>&nbsp;<?= getUserName($_SESSION["userid"]); ?>
                    | <?php echo AVAILABLE_BIDS; ?>:&nbsp;<span id="bids_count"><?= $objbal->final_bids; ?></span>
                    | <?php echo FREE_BIDS; ?>:&nbsp;<span id="free_bids_count"><?= $objbal->free_bids != "" ? $objbal->free_bids : "0"; ?></span>
                    | <a href="logout.php"><?php echo LOGOUT; ?></a>
                <?php
                    db_free_result($resbal);
                }
                ?>
            </div>
        </div>
        <div>
            <div id="headerhelp">
                <?php echo ALL_CATEGORIES; ?>
                <select id="auc_cat">
                    <option value="allauctions.php?aid=2"><?php echo ALL_LIVE_AUCTIONS; ?> (<?php echo checkaucstatus(2); ?>)</option>
                    <!--<option value="allauctions.php?aid=4"><?php // echo REVERSE_AUCTION_W;?> (<?php // echo $adb->getReverseCount();?>)</option>-->
            <!--<option value="allauctions.php?aid=5"><?php //echo LOWEST_UNIQUE_AUCTION_W;?> (<?php // echo $adb->getLowestUniqueCount();?>)</option>-->
                    <?php
                    $resc = db_query("select categoryID as cid, name, (select count(*) from auction where categoryID=cid and auc_status='2') as cnt from categories where status=1");
                    while (( $cat = db_fetch_array($resc))) {
                    ?>
                        <option value="allauctions.php?id=<?php echo $cat["cid"]; ?>"><?= htmlspecialchars(stripcslashes($cat["name"]), ENT_QUOTES); ?> (<?php echo $cat["cnt"]; ?>)</option>
                    <?php
                    }
                    db_free_result($resc);
                    ?>
                    <option value="allauctions.php?aid=1"><?php echo FUTURE_AUCTIONS; ?> (<?php echo checkaucstatus(1); ?>)</option>
                    <option value="allauctions.php?aid=3"><?php echo ENDED_AUCTIONS; ?> (<?php echo checkaucstatus(3); ?>)</option>
                </select>
            </div>
            <div id="mcafee">

                <div id="support_container">
                    <?php online1(); ?>
                </div>
            </div>
            <div class="clearfloat"></div>
        </div>
    </div>
</div> 
