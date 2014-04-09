   <div id="main">
            <?php if(empty($header)){ include_once($BASE_DIR . '/include/' . $template . '/header.php'); } ?>
            <div id="container">
                <?php include("topmenu.php"); ?>
                <?php include("searchbox.php"); ?>
                <div id="title-category-content">
                    <?php include("categorymenu.php"); ?>
                    <p class="bid-title"><strong><?=$SITE_NM;?> - <?php echo FORUM; ?></strong></p>
                </div><!-- /title-category-content -->
              
                <div class="forummain">
                    <div style="padding-top:5px;">
                        <a href="index.php"><?php echo FORUM; ?></a>&nbsp;>> &nbsp;
                        <a href="forum_detail.php?fid=<?php echo $forum_id;?>" class="darkblue-12-link"><?php echo stripslashes($forumname);?></a>&nbsp;>> &nbsp;
                        <span class="greymenuforum"><a href="viewmessage.php?tid=<?php echo $topic_id;?>"><?php echo wordwrap(stripslashes($topictitle),120,"\n",1);?></a></span>
                    </div>
                    <br/>

                    <div class="forummaintitle"><?php echo ENTER_YOUR_REPLY; ?></div>

                    <div class="content">
                        <form name="f1" action="postreply.php" method="POST" onsubmit="return CheckForum();">
                            <div style="width:142px; padding-top:105px; padding-left:5px;height:20px; float:left; text-align:right"><?php echo MESSAGE; ?>:</div>
                            <div style="padding-top:5px; padding-left:5px; padding-bottom:5px;width:650px; float:left;">
                                <textarea name="post_body" class="forummessage" rows="15" cols="70"></textarea>
                            </div>
                            <div align="left" style="padding-top:10px; padding-left: 145px;width: 435px; height: auto; float:left;">
                                <?
                                foreach ($smileysname as $key => $value) {
                                    ?>
                                <a href='javascript:PutSmileys(" <?=$value;?> ")'><img src="../images/smileys/<?=$key;?>" border="0" alt=""/></a>
                                    <?
                                }
                                ?>
                            </div>
                            <div class="clear">&nbsp;</div>
                            <div class="clear">&nbsp;</div>
                            <div align="center">
                                <input type="hidden" name="submit" value="Submit" />
                                <button class="forummainbutton1" ><?php echo POST_REPLY; ?></button>
                            </div>

                        </form>
                    </div>

                </div>

            </div>
            <?
            include("footer.php");
            ?>
        </div>