<div class="main_menu_holder">
                        <ul id="menu">
                            <!-- Home -->
                            <li style="width: 109px;">
                            <!--[if lte IE 6]><a href="<?php echo $SITE_URL;?>#nogo"><table><tr><td><![endif]-->
                                <dl style="width: 109px;" class="main_menu">
                                    <dt class="one"><a href="<?php echo $SITE_URL;?>index.php"><?php echo HOME ?></a></dt>
                                </dl>
                                <!--[if lte IE 6]></td></tr></table></a><![endif]-->
                            </li>
                            <!-- Home -->

                            <!-- Home -->
                            <li style="width: 109px;">
                            <!--[if lte IE 6]><a href="<?php echo $SITE_URL;?>#nogo"><table><tr><td><![endif]-->
                                <dl style="width: 109px;" class="main_menu">
                                    <dt class="one"><a href="<?php echo $SITE_URL;?>myaccount.php"><?php echo MY_BIDS ?></a></dt>
                                </dl>
                                <!--[if lte IE 6]></td></tr></table></a><![endif]-->
                            </li>
                            <!-- Home -->

                    <?php if (isset($_SESSION["userid"])) {
                    ?>
                        <!-- Home -->
                        <li style="width: 109px;">
                        <!--[if lte IE 6]><a href="<?php echo $SITE_URL;?>#nogo"><table><tr><td><![endif]-->
                            <dl style="width: 109px;" class="main_menu">
                                <dt class="one"><a href="<?php echo $SITE_URL;?>buybids.php"><?php echo BUY_BID ?></a></dt>
                            </dl>
                            <!--[if lte IE 6]></td></tr></table></a><![endif]-->
                        </li>
                        <!-- Home -->
                    <?php } else {
                    ?>
                        <!-- Home -->
                        <li style="width: 109px;">
                        <!--[if lte IE 6]><a href="<?php echo $SITE_URL;?>#nogo"><table><tr><td><![endif]-->
                            <dl style="width: 109px;" class="main_menu">
                                <dt class="one"><a href="<?php echo $SITE_URL;?>registration.php"><?php echo REGISTER ?></a></dt>
                            </dl>
                            <!--[if lte IE 6]></td></tr></table></a><![endif]-->
                        </li>
                        <!-- Home -->
                    <?php } ?>

        <?php if(db_num_rows(db_query("select * from sitesetting where name = 'redemption' and value = '1'")) >= 1){
        ?>
                    <!-- Home -->
                    <li style="width: 109px;">
                    <!--[if lte IE 6]><a href="<?php echo $SITE_URL;?>#nogo"><table><tr><td><![endif]-->
                        <dl style="width: 109px;" class="main_menu">
                            <dt class="one"><a href="<?php echo $SITE_URL;?>redemption.php"><?php echo REDEMPTION ?></a></dt>
                        </dl>
                        <!--[if lte IE 6]></td></tr></table></a><![endif]-->
                    </li>
                    <!-- Home -->
	<?php } ?>
	
                    <!-- Home -->
                    <li style="width: 109px;">
                    <!--[if lte IE 6]><a href="<?php echo $SITE_URL;?>#nogo"><table><tr><td><![endif]-->
                        <dl style="width: 109px;" class="main_menu">
                            <dt class="one"><a href="<?php echo $SITE_URL;?>community.php"><?php echo COMMUNITY ?></a></dt>
                        </dl>
                        <!--[if lte IE 6]></td></tr></table></a><![endif]-->
                    </li>
                    <!-- Home -->
        <?php if(db_num_rows(db_query("select * from sitesetting where name = 'forums' and value = '1'")) >= 1){
        ?>
                    <!-- Home -->
                    <li style="width: 109px;">
                    <!--[if lte IE 6]><a href="<?php echo $SITE_URL;?>#nogo"><table><tr><td><![endif]-->
                        <dl style="width: 109px;" class="main_menu">
                            <dt class="one"><a href="<?php echo $SITE_URL;?>forum/index.php"><?php echo FORUM ?></a></dt>
                        </dl>
                        <!--[if lte IE 6]></td></tr></table></a><![endif]-->
                    </li>
                    <!-- Home -->
         <?php } ?>

                    <!-- Register -->
                    <li style="width: 109px;">
                    <!--[if lte IE 6]><a href="<?php echo $SITE_URL;?>#nogo"><table><tr><td><![endif]-->
                        <dl style="width: 109px;" class="main_menu">
                            <dt class="two">
                                <a href="<?php echo $SITE_URL;?>help.php"><?php echo HELP; ?></a></dt>
                        </dl>
                        <!--[if lte IE 6]></td></tr></table></a><![endif]-->
                    </li>
                    <!-- Register -->
                </ul>

            </div>
        </div><!-- MAIN MENU -->