        <div id="main">
            <?php include("header.php"); ?>
            <div id="container">
                <?php include("include/topmenu.php"); ?>
                <div id="column-left">
                    <?php include('leftside.php'); ?>
                </div><!-- /column-left-->

                <div id="column-right">
                    <div id="registerBox" class="content">
                        <h2><span><?php echo FORGET_PASSWORD; ?></span></h2>

                        <div class="rounded_corner">
                            <?php
                            if($_POST["email"]!="" && $total>0 && $obj->account_status!='0') {
                                ?>
                            <p style="margin-left: 25pt;">
                                <p><?php echo AN_EMAIL_WAS_SENT_TO; ?> : <?=$email;?></p>
                                <br />
                                <p><a href="index.php"><?php echo HOME; ?></a></p>
                            </p>
                                <?php
                            }
                            else {
                                ?>
                            <form style="background:#ffffff;" name="forgot" method="post" action="forgotpassword.php" onsubmit="return check();">								<br />
                                <br />
                                    <?php if($msg==1) {?>
                                <p style="margin-left: 25pt;" class="redfont"><b><?php echo SORRY_WE_DIDNT_FIND_YOUR_EMAIL_ADDRESS_IN_OUR_SYSTEM; ?></b></p>
                                <br />
                                        <?php } elseif($msg==2) { ?>
                                <p style="margin-left: 25pt;" class="redfont"><b><?php echo THIS_ACCOUNT_IS_NOT_VERIFIED_YET_PLEASE_VERIFY_FIRST; ?></b></p>
                                <br />
                                        <?php } ?>
                                <div style="margin-left: 25pt;">
                                    <p class="normal_text"><B><?php echo YOU_HAVE_FORGOTTEN_YOUR_LOGIN_DATA; ?></B></p>
                                    <br />
                                    <p class="normal_text"><b><?php echo NO_PROBLEM_JUST_ENTER_YOUR_EMAIL_AND_WE_WILL_SEND_THE_INFORMATION_TO_YOUR_EMAIL_ACCOUNT; ?></b></p>
                                    <br />
                                    <p class="normal_text"><b><?php echo YOUR_EMAIL;?> : </b></p>
                                    <br />                                    
                                    <p>
                                        <input type="text" name="email" size="50" class="logintextboxclas" />
                                        <br />
                                        <br />
                                        <button class="button77" type="submit"><?php echo SUBMIT; ?></button>
                                        <input type="hidden" name="submit" value="SUBMIT" />
                                        <br />
                                    </p>
                                </div>
                                <br />       
                                <br /> 
                            </form>
                                <?
                            }
                            ?>
                        </div>                    


                    </div><!-- /content -->

                </div><!-- /column-right -->
            </div><!-- /container -->
            <?php include("footer.php"); ?>
        </div><!-- /main --> 
