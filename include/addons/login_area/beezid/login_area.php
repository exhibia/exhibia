          <?php
                    if (!isset($_SESSION["userid"])) {
            ?>
                        <div style="" id="uCheckRegister">
                            <!-- LOGIN BOX -->
                            <div id="login-form">
                                <div style="padding: 10px;">
                                    <!-- LOGIN FORM -->
                                    <form method="post" action="password.php">

                                        <div class="f_left">
                                            <input style="width: 150px; padding: 2px;" maxlength="16" type="text" name="username" value="username" onfocus="_delete_login_fields(this, 'username', this.value);" id="username">
                                        </div>
                                        <div class="f_left padding_left_5">
                                            <input style="width: 150px; padding: 2px;" type="password" name="password" onfocus="_delete_login_fields(this, 'password', this.value);" value="password" id="password" >
                                        </div>
                                        <div class="f_left padding_top_2">

                                        </div>
                                        <div class="f_left padding_left_5 cursor_hand">
                                            <input value="<?php echo LOGIN; ?>" class="common_login_btn" type="submit">
                                        </div>
                                        <div class="clear"></div>

                                    </form>
                                    <!-- LOGIN FORM -->
                                </div>
                            </div>
                        </div>

            <?php
                    } else {
                        $resbal = db_query("select final_bids, free_bids from registration where id=" . $_SESSION["userid"]);
                        $objbal = db_fetch_object($resbal);
            ?>
                        <div id="uCheckLogged">
                            <!-- LOGIN BOX -->
                            <div id="login-form">
                                <div style="">
                                    <!-- USER INFO -->

                                    <div class="f_left common_login_box_login_name"><span style="color: rgb(95, 120, 171);">Welcome: </span><span id="userFName" style="color: rgb(77, 77, 77);"><?php echo getUserName($_SESSION["userid"]); ?></span></div>
                                    <div class="f_left padding_top_5"><img src="<?php echo $SITE_URL;?>img/pages/common/common_login_arrow.png" alt=""></div>
                                    <div class="f_left padding_left_5 padding_top_7">
                                        <div style="cursor: pointer;" id="l_invite_friends" class="btn_login_box_invite_friend_normal">
                                        </div>
                                    </div>
                                    <div class="f_left cursor_hand common_login_box_exit"><a href="<?php echo $SITE_URL;?>logout.php">Logout</a></div>
                                    <div class="clear"></div>

                                    <!-- /USER INFO -->
                                </div>
                            </div>
                        </div>
            <?php
                        db_free_result($resbal);
                    }
            ?>