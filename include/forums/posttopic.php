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
                        <span class="greymenuforum"><a href="forum_detail.php?fid=<?php echo $fid;?>"><?php echo stripslashes($row->forums_name);?></a></span>

                    </div>
                    <br/>

                    <div class="forummaintitle"><?php echo ENTER_YOUR_NEW_TOPIC; ?></div>

                    <div class="content">
                        <form name="postthread" action="#" method="post" onsubmit="return Check();">
                            <div style="width:140px;padding-top:30px;padding-left:5px;height:29px; float:left; text-align:right"><?php echo SUBJECT; ?>:</div>
                            <div style="padding-top:25px; padding-left:5px; padding-bottom:5px;width:698px; float:left;">
                                <input type="text" name="title" class="logintextboxclas" maxlength="200" />
                            </div>
                            <div class="clear"></div>
                            <div style="width:140px; padding-top:105px; padding-left:5px;height:20px; float:left; text-align:right"><?php echo CONTENT; ?>:</div>
                            <div style="padding-top:5px; padding-left:5px; padding-bottom:5px;width:650px; float:left;">
                                <textarea name="post_body" rows="12" cols="80" class="forummessage"></textarea>
                            </div>
                            
                            <div style="width:435px;padding-left:160px;">
                                <?php
                                $smileyspath = "../images/smileys/";
                                foreach($smileysname as $key => $value) {
                                    ?>
                                <a href='javascript:PutSmileys(" <?=$value;?> ");'><img src="<?=$smileyspath.$key;?>" border="0" alt=""/></a>
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="clear">&nbsp;</div>
                            <div class="clear">&nbsp;</div>

                            <div align="center">
                                <button class="forummainbutton1" ><?php echo POST_TOPIC; ?></button>
                                <input type="hidden" name="submit" value="Submit" />

                                <input type="hidden" name="forumid" value="<?php echo $fid;?>"/>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
            <?
            include("footer.php");
            ?>
        </div> 
