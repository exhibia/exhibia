

<?php 
if(empty($_SESSION['userid'])){
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
        
        
<div class="promo">
        <div id="top-sign-up">
                               
            <a href="<?php echo $SITE_URL;?>registration.php"><?php echo REGISTER;?></a><br style="clear:both;">
        </div>
        <div id="promo-sign-up">
            <div id="top-sign-in"><a onclick="javascript: slideSignIn();" id="sign-in-button"><?php  echo LOGIN;?></a>
                <div id="top-sign-in-box-holder">
                    <div id="top-sign-in-box">
                        <form method="post" action="<?php echo $SITE_URL;?>password.php" id="login-form">
                            <div>Username</div>
                            <div style="margin-top:37px;"><?php echo PASSWORD;?></div>

                            <input type="text" autocomplete="off" onfocus="_delete_login_fields(this, 'username', this.value);" name="username" id="login-username">
                            <input type="password" onfocus="_delete_login_fields(this, 'password', this.value);" name="password" id="login-password">

                            <div style="margin-top: 10px;">
                            
                                <input type="submit" value="<?php echo SUBMIT;?>" class="button">
                                
                        
                            </div>
                        </form>
                        <div style="margin-top: 20px;"><a href="<?php echo $SITE_URL;?>forgotpassword.php">Forgotten username or password</a></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php }else{ ?> 
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
      
      
        <div id="login-form">
            <p>
            
            
                                        
                <span id="userinfo">
                      <?php
                       $obja = db_fetch_array(db_query("select *, avatar from registration left join avatar a on registration.avatarid=a.id where registration.id=$_SESSION[userid]"));
                                                   if (Sitesetting::isEnableAvatar()) {

                                                       $avatarPath = $UploadImagePath . "avatars/default.png";

                                                       if ($obja['avatar'] != '') {
                                                           $tmppath = $BASE_DIR . "/uploads/" . "avatars/" . $obja["avatar"];
							    
                                                           if (file_exists($tmppath)) { 
                                                               $avatarPath = $SITE_URL . "uploads/" . "avatars/" . $obja["avatar"];
                                                           }
                                                       }
                                                       ?>
                                                       <img alt="" src="<?php echo $avatarPath; ?>"/>
                                                       <?php
                                                       
                                                  }
                                        ?>
                
                
                <button id="btn_logout"  id="login_button_top" title="<?php echo LOGOUT; ?>" onclick="javascript: window.location.href='<?php echo $SITE_URL; ?>logout.php'" type="submit"><?php echo LOGOUT; ?></button>
<span class="user_points_data">              
<?php echo WELCOME; ?>&nbsp;<strong><?= getUserName($_SESSION["userid"]); ?></strong>
<br />
                    &nbsp;<?php echo AVAILABLE_BIDS; ?>:&nbsp;<strong><span id="bids_count"><?= $objbal->final_bids; ?></span></strong>
<br />
                    &nbsp;<?php echo FREE_BIDS; ?>:&nbsp;<strong><span id="free_bids_count"><?= $objbal->free_bids != "" ? $objbal->free_bids : "0"; ?></span></strong>
                
                
</span>            
                </span>
                           <!--<span><a  id="logoutButton" href="logout.php">Logout</a></span>-->
            </p>
        </div>	




<?php } ?>