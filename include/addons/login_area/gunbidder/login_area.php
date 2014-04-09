<?php

if($template != 'wavee' & $template != 'sticky'){
?>
<div id="login-area">

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

 
  
<?
if (!isset($_SESSION["userid"])) {
?>


        <form  name="f1" action="<?php echo $SITE_URL;?>password.php" method="post" accept-charset="utf-8" id="login-form">
          
           
                <input type="text" name="username" value="username" onfocus="_delete_login_fields(this, 'username', this.value);" id="username" />
                <input type="password" name="password" onfocus="_delete_login_fields(this, 'password', this.value);" value="password" id="password" />
                <button type="submit" id="login_button_top" title="<?php echo LOGIN; ?>"><?php echo LOGIN; ?></button>
                <div class="clear"></div>
               <span> 
                <ul style="list-type:none;">
		  <li>
		      <a href="forgotpassword.php" /><?php echo FORGOT_PASSWORD;?></a>
		  </li>
		  <li>&nbsp;|&nbsp;</li>
		  <li>
		      <a href="registration.php" /><?php echo REGISTER;?></a>
		  </li>
		</ul>
		</span>
            
        </form><!-- /login-form -->

<?
    } else {
        $resbal = db_query("select final_bids, free_bids from registration where id=" . $_SESSION["userid"]);
        $objbal = db_fetch_object($resbal);
?>
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
                   
<?php echo WELCOME; ?>&nbsp;<strong><?= getUserName($_SESSION["userid"]); ?></strong>
<br />
                    &nbsp;<?php echo AVAILABLE_BIDS; ?>:&nbsp;<strong><span id="bids_count"><?= $objbal->final_bids; ?></span></strong>
                    &nbsp;<?php echo FREE_BIDS; ?>:&nbsp;<strong><span id="free_bids_count"><?= $objbal->free_bids != "" ? $objbal->free_bids : "0"; ?></span></strong>
                
                
                
                </span>
                           <!--<span><a  id="logoutButton" href="logout.php">Logout</a></span>-->
            </p>
        </div>				
<?
                    db_free_result($resbal);
                }
?>

    </div><!-- /login-area -->
<?php } ?>


<script>
$('#login_button_top').qtip({content : { text: $('#login_button_top').attr('title') } });
</script>