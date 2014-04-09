 
<?php if (!isset($_SESSION["userid"])) {
?>
    <div id="login">
             <?php
if(empty($languages)){
$languages = 'set';
?>
	<ul id="list-lenguages">
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
       
        <form method="post" action="password.php">
            <span>
                <input name="username" value="username" onfocus="_delete_login_fields(this, 'username', this.value);" id="username" class="gray"/>
            </span>
            <span>
                <input type="password" name="password" onfocus="_delete_login_fields(this, 'password', this.value);" value="password" id="password" class="gray"/>
            </span>
            <button type="submit" id="login-btn"><?php echo LOGIN; ?></button>
        </form>
        <div id="login-links">
<?php echo FORGOT_PASSOWRD; ?> <a href="forgotpassword.php"><?php echo CLICK_HERE; ?></a>
            <?php echo NOT_A_MEMBER; ?><a href="registration.php"><?php echo SIGN_UP_NOW; ?></a>
        </div>
    </div>

<?php
        } else {
            $resbal = db_query("select final_bids, free_bids from registration where id=" . $_SESSION["userid"]);
            $objbal = db_fetch_object($resbal);
?>

            <div id="loged">
                      <?php
if(empty($languages)){
$languages = 'set';
?>
	<ul id="list-lenguages">
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
       
                <span id="bids">
                    <label id='bids_count'><?php echo $objbal->final_bids; ?></label> <?php echo AVAILABLE_BIDS; ?>
                    <label id='free_bids_count'><?php if(!empty($objbal->free_bids)){ echo $objbal->free_bids; }else{ echo "0"; } ?></label> <?php echo FREE_BIDS; ?>
                </span>
                <div style="min-height:15px;"></div>
                <strong id="user" style="padding-left:25px;"><?php echo getUserName($_SESSION["userid"]); ?></strong>
                <a href="logout.php"><?php echo LOGOUT; ?></a>
                <br />
            </div>
<?php
            db_free_result($resbal);
        }
?>
 
        <div class="clear"></div>
        <ul id="nav">
            <li id="all-cats">
                <select id="auc_cat">
                    <option value="allauctions.php?aid=2"><?php echo ALL_CATEGORIES; ?></option>
                    <option value="allauctions.php?aid=2"><?php echo ALL_LIVE_AUCTIONS; ?> (<?php echo checkaucstatus(2); ?>)</option>
<?php
        $resc = db_query("select categoryID as cid, name, (select count(*) from auction where categoryID=cid and auc_status='2') as cnt from categories where status=1");
        while (( $cat = db_fetch_array($resc))) {
?>
                <option value="allauctions.php?id=<?php echo $cat["cid"]; ?>"><?=htmlspecialchars(stripcslashes($cat["name"]), ENT_QUOTES); ?> (<?php echo $cat["cnt"]; ?>)</option>
<?php
            }
            db_free_result($resc);
?>
                <option value="allauctions.php?aid=1"><?php echo FUTURE_AUCTIONS; ?> (<?php echo checkaucstatus(1); ?>)</option>
                <option value="allauctions.php?aid=3"><?php echo ENDED_AUCTIONS; ?> (<?php echo checkaucstatus(3); ?>)</option>
            </select>
        </li>
        <li class="menuitem"><a href="index.php" class="<?php echo $currentPage == 'index.php' ? 'active' : ''; ?>"><span><?php echo HOME ?></span></a></li>
        <li class="menuitem"><a href="myaccount.php" class="<?php echo $currentPage == 'myaccount.php' ? 'active' : ''; ?>"><span><?php echo MY_BIDS; ?></span></a></li>
<?php if (!isset($_SESSION["userid"])) { ?>
            <li class="menuitem"><a href="registration.php" class="<?php echo $currentPage == 'registration.php' ? 'active' : ''; ?>"><span><?php echo REGISTER; ?></span></a></li>
<?php } else { ?>
                    <li class="menuitem"><a href="buybids.php" class="<?php echo $currentPage == 'buybids.php' ? 'active' : ''; ?>"><span><?php echo BUY_BID; ?></span></a></li>
<?php } ?>



<?php if (isset($_SESSION["userid"])) { ?>

<?php if(db_num_rows(db_query("select * from sitesetting where name = 'redemption' and value = '1'")) >= 1){
        ?>
                <li class="menuitem"><a href="redemption.php" class="<?php echo $currentPage == 'redemption.php' ? 'active' : ''; ?>"><span><?php echo REDEMPTION; ?></span></a></li>
<?php } ?>

<?php if(db_num_rows(db_query("select * from sitesetting where name = 'community' and value = '1'")) >= 1){
        ?>
		<li class="menuitem"><a href="community.php" class="<?php echo $currentPage == 'community.php' ? 'active' : ''; ?>"><span><?php echo COMMUNITY; ?></span></a></li>
<?php } ?>
<?php if(db_num_rows(db_query("select * from sitesetting where name = 'forum' and value = '1'")) >= 1){
        ?>
            <li class="menuitem"><a href="forum.php" class="<?php echo $currentPage == 'forum.php' ? 'active' : ''; ?>"><span><?php echo FORUM; ?></span></a></li>   
<?php } ?>
<?php }else{ ?>

		<li class="menuitem"><a href="registration.php"><span><?php echo REGISTER_NOW; ?></span></a></li>

<?php } ?>
		<li class="menuitem last"><a href="help.php" class="<?php echo $currentPage == 'help.php' ? 'active' : ''; ?>"><span><?php echo HELP; ?></span></a></li>
    </ul>
 
