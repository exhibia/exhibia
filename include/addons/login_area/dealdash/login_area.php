<?php
if($template != 'wavee' & $template != 'sticky'){
?>
<div id="login-area">

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
       <div id="twitter-area">
            <h5><?php echo TWITTER; ?></h5>
            <p><?php echo FOLLOW_US_TO_KNOW_ABOUT_LATEST_PRODUCTS_AND_DEALS; ?></p>
        </div>
     	<?php
	      foreach($addons as $key => $value){

		if(file_exists("include/addons/$value/login_area.php")){

		    include_once("include/addons/$value/login_area.php");

		}


	      }
	  ?>
  
<?
if (!isset($_SESSION["userid"])) {
?>
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

        <form  name="f1" action="<?php echo $SITE_URL;?>password.php" method="post" accept-charset="utf-8" id="login-form">
            <p>
                <input type="text" name="username" value="username" onfocus="_delete_login_fields(this, 'username', this.value);" id="username" />
                <input type="password" name="password" onfocus="_delete_login_fields(this, 'password', this.value);" value="password" id="password" />
                <button type="submit"><?php echo LOGIN; ?></button>
            </p>
        </form><!-- /login-form -->

<?
    } else {
        $resbal = db_query("select final_bids, free_bids from registration where id=" . $_SESSION["userid"]);
        $objbal = db_fetch_object($resbal);
?>
        <div id="login-form">
            <p>
                <span id="userinfo">
<?php echo WELCOME; ?>&nbsp;<strong><?= getUserName($_SESSION["userid"]); ?></strong>
                    &nbsp;<?php echo AVAILABLE_BIDS; ?>:&nbsp;<strong><span id="bids_count"><?= $objbal->final_bids; ?></span></strong>
                    &nbsp;<?php echo FREE_BIDS; ?>:&nbsp;<strong><span id="free_bids_count"><?= $objbal->free_bids != "" ? $objbal->free_bids : "0"; ?></span></strong>
                </span>
                <button id="btn_logout" onclick="javascript: window.location.href='<?php echo $SITE_URL; ?>logout.php'" type="submit"><?php echo LOGOUT; ?></button>
                                <!--<span><a  id="logoutButton" href="logout.php">Logout</a></span>-->
            </p>
        </div>				
<?
                    db_free_result($resbal);
                }
?>

    </div><!-- /login-area -->
<?php } ?>