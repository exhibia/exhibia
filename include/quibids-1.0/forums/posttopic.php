        <div id="pagewidth">
            <!-- ============= Header =============  -->
            <?php include $BASE_DIR . '/include/' . $template . '/header.php'; ?>
            <!-- ============= End Header =============  -->

              <div id="wrapper" class="clearfix">
                <div id="maincol">
                    <!-- ============= MyQuibids nav =============  -->
                    <ul id="myqb-nav">
                        <li ><a href="forums.php" class="active"><span><?php echo FORUM; ?></span></a></li>
                    </ul>
                    <!-- ============= End MyQuibids nav =============  -->
                    <!-- ============= MyQuibids wrap =============  -->
                    <div id="myqb-wrap">
                        <div id="myqb" style="position:relative;left:-180px;">
                        
                        
            <div id="title-category-content">
                <?php include("$BASE_DIR/include/$template/categorymenu.php"); ?>
                <p class="bid-title"><strong><?=$SITE_NM;?> - <?php echo FORUM; ?></strong> </p>
            </div><!-- /title-category-content -->        
            
          <div class="forummain">
                    <div style="padding-top:5px;margin:10px 0 0 20px;">
                        <a href="forums.php"><?php echo FORUM; ?></a>&nbsp;>> &nbsp;
                        <span class="greymenuforum"><a href="forum_detail.php?fid=<?php echo $fid;?>"><?php echo stripslashes($row->forums_name);?></a></span>

                    </div>
                    <br/>

                    <div class="forummaintitle"><?php echo ENTER_YOUR_NEW_TOPIC; ?></div>

             <form name="postthread" action="posttopic.php" method="post" onsubmit="return CheckForum();">
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
				<input type="hidden" name="fid" value="<?php echo $fid;?>"/>
                                <input type="hidden" name="forumid" value="<?php echo $fid;?>"/>
                            </div>
                        </form>
                    </div>
                               </div>
                        <!-- ============= Left Navigation =============  -->

                        

                                                <!-- ============= End Left Navigation =============  -->
                                                <div class="clear"></div>
                                                <div id="myqb-end"></div>
                                            </div>
                                            <!-- ============= End MyQuibids wrap =============  -->
                                        </div>
                                    </div>
                                    <div id="wrap-end"></div>
                                </div> <!--end pagewidth-->

        <?php include $BASE_DIR . '/include/' . $template . '/footer.php' ?>
 
