


        <div id="pagewidth">
            

                
            <!-- ============= Header =============  -->
            <?php include("$BASE_DIR/include/$template/header.php"); ?>
            <div id="wrapper" class="clearfix" >
	      <div id="maincol">
                    <div id="auction-listing">
                    
                    <!-- ============= Login =============  -->
                    <div id="login-register">
                        <h2><?php echo LOGIN; ?></h2>
                        <div id="new-to">
                            <h3><?php echo NEW_TO; ?> <?php echo $SITE_NM; ?></h3>
                            <p>
                               <?php echo LOGIN_TEXT;?> </p>
                            <a href="registration.php" id="register-now"><?php echo REGISTER_NOW?>!</a> </div>
                        <div id="login-form">
                            <form  name="f1" method="post" action="password.php">
                                <?php if (isset($_GET["err"])){?>
                                <div class="error">
                                    <?php
                                    if($_GET["err"]==1) {
                                        ?>
                                    <strong><?php echo INVALID_USERNAME_PASSWORD; ?>.</strong>
                                        <?php
                                    }elseif($_GET['err']==2) {
                                        ?>
                                    <strong><?php echo YOUR_ACCOUNT_IS_SUSPENDED_BY; ?><?php echo $SITE_NM;?>.</strong>
                                        <?php
                                    }elseif($_GET['err']==3) {
                                        ?>
                                    <strong><?php echo YOUR_ACCOUNT_IS_DELETED_BY; ?><?=$SITE_NM;?>.</strong>
                                        <?php
                                    }elseif($_GET['err']==4) {
                                        ?>
                                    <strong><?php echo PLEASE_ENTER_USERNAME_AND_PASSWORD; ?></strong>
                                        <?php
                                    }elseif($_GET['err']==5) {
                                        ?>
                                    <strong><?php echo PLEASE_ENTER_PASSWORD; ?></strong>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <?php } ?>
                                <label><?php echo USERNAME; ?>:</label>
                                <input name="username" id="username" type="text"/>
                                <label><?php echo PASSWORD;?>:</label>
                                <input name="password" id="password" type="password"/>
                                <div class="wraps">
                                    <table width="220">
                                        <tbody>
                                            <tr>
                                                <td align="left">
                                                    <a href="forgotpassword.php"><?php echo FORGOT_PASSOWRD; ?></a>                                                    
                                                </td>
                                                <td align="right">
                                                    <a href="registration.php"><?php echo SIGN_UP_NOW; ?></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br/>
                                    <input name="login" value="<?php echo LOGIN;?>" class="button" type="submit"/>
                                </div>
                            </form>
                        </div>
                        <div class="clear"></div>
                        <div id="login-register-end"></div>
                    </div>
                    <!-- ============= End End-login =============  -->
                </div>
            </div>
            <div id="wrap-end">

            </div>
        </div>

        <?php include("$BASE_DIR/include/$template/footer.php") ?>
    

