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
                        <a href="forum_detail.php?fid=<?php echo $forum_id;?>" class="darkblue-12-link"><?php echo stripslashes($forumname);?></a>&nbsp;>> &nbsp;
                        <span class="greymenuforum"><a href="viewmessage.php?tid=<?php echo $topic_id;?>"><?php echo wordwrap(stripslashes($topictitle),120,"\n",1);?></a></span>
                    </div>
                    <br/>

                    <div class="forummaintitle"><?php echo ENTER_YOUR_REPLY; ?></div>

                  
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
                             <input type="hidden" name="tid" value="<?php echo $_REQUEST['tid'];?>" />
                                <input type="hidden" name="submit" value="Submit" />
                                <button class="forummainbutton1" ><?php echo POST_REPLY; ?></button>
                            </div>

                        </form>
                    </div>


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
 
