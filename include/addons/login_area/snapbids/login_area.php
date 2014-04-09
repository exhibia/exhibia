 <?php if (!isset($_SESSION["userid"])) {
        ?>
        <div id="login">
        

  
  
 
            <form method="post" action="<?php echo $SITE_URL;?>password.php">
	
	     
		
                <span>
                    <input name="username" value="username" onfocus="_delete_login_fields(this, 'username', this.value);" id="username" class="gray"/>
                </span>
                <span>
                    <input type="password" name="password" onfocus="_delete_login_fields(this, 'password', this.value);" value="password" id="password" class="gray"/>
                </span>
                <input type="submit" id="login-btn" value="<?php echo LOGIN; ?>" />
          
            </form>
            <div id="login-links">
                <?php echo FORGOT_PASSOWRD; ?>&nbsp;<a href="<?php echo $SITE_URL;?>forgotpassword.php"><?php echo CLICK_HERE; ?></a>
                <?php echo NOT_A_MEMBER; ?>&nbsp;<a href="<?php echo $SITE_URL;?>registration.php"><?php echo SIGN_UP_NOW; ?></a>
            </div>
        </div>

        <?php
    } else {
        $resbal = db_query("select final_bids, free_bids from registration where id=" . $_SESSION["userid"]);
        $objbal = db_fetch_object($resbal);
        
        
        $query = "select * from registration left join avatar a on a.id=registration.avatarid where registration.id = $_SESSION[userid]";

	$row = db_fetch_object(db_query("$query"));
        ?>

        <div id="loged">
        <img class="avatar" src="uploads/avatars/<?php echo $row->avatar; ?>" width="20" height="20" alt="image description" />
            <span id="bids_no">
                <span id="bids_count" style="display:inline;"><?php echo $objbal->final_bids; ?></span> <?php echo AVAILABLE_BIDS; ?>
                <span id="free_bids_count" style="display:inline;"><?php echo $objbal->free_bids != "" ? $objbal->free_bids : "0"; ?></span> <?php echo FREE_BIDS; ?>
            </span>
       <div class="clear" style="min-height:15px;"></div>
            <strong id="user" style="padding-left:30px;"><?php echo getUserName($_SESSION["userid"]); ?></strong>
            <a href="<?php echo $SITE_URL;?>logout.php"><?php echo LOGOUT; ?></a>
            <br />
        </div>
        <?php
        db_free_result($resbal);
    }
    ?> 
