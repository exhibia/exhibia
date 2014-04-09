
<div id="topgray">
    <div style="width: 998px; margin: auto;">
        <div style="width: 350px; float: left; font-size: 14px; padding-top: 10px"> Buy Brand New Products for up to <span style="font-size: 20px; color: #CF0; font-weight: bold"> 99%</span> off</div>

        <!-- LOGIN BOX -->
        <?php
        if (!isset($_SESSION["userid"])) {
        ?>
        
            <div style="width: 575px; height: 48px; float: right; font-size: 14px; background-image: url(img/newtopgraydarkbg.gif); background-repeat: no-repeat; text-align: center; padding-top: 7px; padding-left: 60px;">
                <form  name="f1" action="password.php" method="post" accept-charset="utf-8" id="login-form">
                    <input name="username" value="username" onfocus="_delete_login_fields(this, 'username', this.value);" id="username" class="logbox"/>
                    <input name="password" onfocus="_delete_login_fields(this, 'password', this.value);" value="password" id="password" class="logbox"/>
                    <button class="searchbutton" type="submit"><?php echo LOGIN; ?></button>
                    <div style="float: left"> &nbsp;&nbsp;&nbsp;<a href="forgotpassword.php"><?php echo FORGOT_PASSWORD; ?></a> &nbsp;&nbsp;&nbsp;&nbsp;<a href="registration.php"><?php echo SIGN_UP; ?></a></div>

                </form>
            </div>
        <?php
        } else {
            $resbal = db_query("select final_bids, free_bids from registration where id=" . $_SESSION["userid"]);
            $objbal = db_fetch_object($resbal);
        ?>

            <div style="width: 585px; height: 48px; float: right; font-size: 14px; background-image: url(img/newtopgraydarkbg.gif); background-repeat: no-repeat; text-align: center; padding-top: 7px; padding-left: 50px;">
                <div class="logout" style="height: 0px;">
                    <a href="myaccount.php"><img src="img/bar_myupbids.png" border="0"></a>&nbsp;&nbsp;
                    <a href="buybids.php"><img src="img/bar_buybids.png" border="0"></a>&nbsp;&nbsp;
                    <a href="logout.php">
                        <img src="img/bar_logout.png" border="0">
                    </a>
                </div>
                <div class="membertop">Hey,<span class="side_2px bold" style="margin-left: 5px;"><?php echo $_SESSION["username"]; ?></span>&nbsp;-&nbsp;You have <strong>
                        <span class="bid-balance" id="bids_count"> <?php echo $objbal->final_bids;?></span></strong>
                    <?php echo BIDS; ?>+<strong><span class="bid-balance" id="free_bids_count"><?php echo $objbal->free_bids != "" ? $objbal->free_bids : "0"; ?></span></strong> <?php echo FREE_BIDS;?> remaining</div>

            </div>

<!--
            <div style="width: 575px; height: 43px; float: right; font-size: 14px; background-image: url(img/newtopgraydarkbg.gif); background-repeat: no-repeat; text-align: left; padding-top: 12px; padding-left: 60px;">

                <img src="img/one.gif" width="23" height="23" align="absmiddle" />
                <a><?php echo AVAILABLE_BIDS; ?>:<span id="bids_count"><?php echo $objbal->final_bids; ?></span></a>
                &nbsp;&nbsp;&nbsp;
                <img src="img/one.gif" width="23" height="23" align="absmiddle" />
                <a><?php echo FREE_BIDS; ?>:<span id="free_bids_count"><?= $objbal->free_bids != "" ? $objbal->free_bids : "0"; ?></span></a>
                &nbsp;&nbsp;&nbsp;
                <img src="img/dollar.gif" width="23" height="23" align="absmiddle" /> <a href="buybids.php"><?php echo BUY_BIDS; ?></a>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="logout.php"><?php echo LOGOUT; ?></a>
                

            </div>
-->

        <?php
            db_free_result($resbal);
        }
        ?>
       
    </div>
    

</div>
<script language='javascript'>UpdateLoginLogout();</script>