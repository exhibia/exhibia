
        <div id="main">

            	<?php if(empty($header)){ include_once($BASE_DIR . '/include/' . $template . '/header.php'); } ?>

            <div id="container">

                <?php if(empty($nav_menu)) { include_once($BASE_DIR . "/include/topmenu.php"); } ?>
	 <div class="tab-area">
                <div id="column-right">

                    <?php include_once($BASE_DIR . "/include/searchbox.php"); ?>

                    <div id="title-category-content">

                        <?php include_once($BASE_DIR . "/include/categorymenu.php"); ?>
                                                <p class="bid-title"><strong><?=$SITE_NM; ?> - <?php echo SELECT_MY_AVATAR; ?></strong></p>
                                            </div><!-- /title-category-content -->
                                            <div class="rounded_corner">
                                                <div class="content">
                                                    <div style="padding-left: 25px;"><h2><?php echo YOUR_DATA; ?>: </h2></div>
                                                    <br />

                                                    <div class="avatarlist">
                                <?php while ($avatar = db_fetch_object($avatarresult)) { ?>
                                                                <div class="avatar_outter <?php echo $myavatarid==$avatar->id?'selected':''; ?>">
                                                                    <a href="myaccount.php?avatarid=<?php echo $avatar->id;?>"><img alt="" src="uploads/avatars/<?php echo $avatar->avatar; ?>"/></a>
                                                                </div>
                                <?php } ?>
                                                            </div>
                                                            <div class="clear"></div>

                                                        </div>
                                                    </div><!-- /content -->
                                                </div><!-- /column-right -->
                                                <div id="column-left">
                    <?php include("leftside.php"); ?>
                    <?php include("include/bidpackage.php"); ?>
                                       
                                    </div><!-- /column-left -->
                                    </div>
                                </div><!-- /container -->

            <?php include("footer.php"); ?> 
