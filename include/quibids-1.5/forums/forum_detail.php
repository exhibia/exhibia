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
                   
                    <div style="height:40px;">
                        <div style="padding-top:5px;float:left;margin:10px 0 0 20px;">
                            <a href="forums.php"><?php echo FORUM; ?></a>&nbsp;>> &nbsp;
                            <span class="greymenuforum"><?php echo stripslashes($rowforum->forums_name);?></span>
                        </div>
                        <div style="float:right;">
                            <?php if($user !="") {?>
                            <button class="forummainbutton1" onclick="javascript: window.location.href='posttopic.php?fid=<?php echo $forum_id;?>'" ><?php echo POST_TOPIC; ?></button>

                                <?php } else { ?>
                            <button class="forummainbutton1"  onclick="GiveAlert('1','<?php echo $forum_id?>');" ><?php echo POST_TOPIC; ?></button>
                                <?php } ?>
                        </div>
                    </div>

                    <div class="forummaintitle"><?php echo FORUM_CONTENT; ?></div>

                    <div class="content">
                        <?php echo wordwrap(stripslashes(GetValueWithSmileys($rowforum->forums_description)),145,"\n",1);?>
                    </div>

                    <br />

                    <div class="forumsubmain">
                        <div class="forumtitle"><?php echo FORUMS; ?></div>
                        <div class="forumtitletopic"><?php echo TOPICS; ?></div>
                        <div class="forumtitlepost"><?php echo POSTS; ?></div>
                        <div class="forumtitlelastpost"><?php echo LAST_POST; ?></div>
                        <?php

                        if(!$_GET['pgno']) {
                            $PageNo = 1;
                        }
                        else {
                            $PageNo = $_GET['pgno'];
                        }

                        $StartRow =   $PRODUCTSPERPAGE * ($PageNo-1);

                        $selectTopic = "select * from forum_topic where topic_status = '0' and forum_id = '".$rowforum->forums_id."' order by topic_time desc";
                        $result1 =db_query($selectTopic);

                        $totalrows=db_num_rows($result1);
                        $totalpages=ceil($totalrows/$PRODUCTSPERPAGE);
                        $selectTopic .= " LIMIT $StartRow,$PRODUCTSPERPAGE";
                        $resultTopic = db_query($selectTopic) or die(db_error());

                        $total = db_num_rows($resultTopic);
                        if($total>0) {
                            while($topicRow=db_fetch_object($resultTopic)) {
                                $lastuser = lastPostOnTopic($topicRow->topic_id);
                                $lasttopic = explode("|",$lastuser);
                                $last_user = $lasttopic[0];
                                $lastdate_time = $lasttopic[1];

                                $topicStarter = topicStarter($topicRow->topic_id);
                                $topic = explode("|",$topicStarter);
                                $start_user = $topic[0];
                                $startdate_time = $topic[1];
                                $fcontent = wordwrap($topicRow->topic_title, 45, "<br />",1);
//							$fcontent = wordwrap(,75,"\n");
                                ?>

                        <div class="forumtitletext">
                            <a href="viewmessage.php?tid=<?php echo $topicRow->topic_id;?>" class="darkblue-12-link">
                                        <?php echo stripslashes("$fcontent\n");?>
                            </a>
                        </div>
                        <div class="forumtitletopictext">
                                    <?php echo stripslashes(totalPostOnTopic($topicRow->topic_id));?>
                        </div>
                        <div class="forumtitleposttext">
                                    <?php if($last_user!="") { ?>
                            <div>
                                            <?php echo date("M d, Y", stripslashes($lastdate_time));?>&nbsp;&nbsp;<?php echo date("h:i A", stripslashes($lastdate_time));?>
                            </div>

                            <div style="padding-top:5px;">
                                <?php echo BY; ?>:&nbsp;<?php echo stripslashes($last_user);?>
                            </div>
                                        <?php } else {?>
                            <div align="center">---</div>
                                        <?php }?>
                        </div>
                        <div class="forumtitlelastposttext">
                            <div>
                                        <?php echo date("M d, Y", stripslashes($startdate_time));?>&nbsp;&nbsp;<?php echo date("h:i A", stripslashes($startdate_time));?>
                            </div>
                            <div style="padding-top:5px;"><?php echo BY; ?>:&nbsp;<?php echo stripslashes($start_user);?></div>
                        </div>
		       
                                <?php
                            }

                        } else {
                            ?>
                            
                        </div>
                        <div class="forumtitletext" ><?php echo NO_TOPIC_TO_DISPLAY; ?></div>
                        
                        <div class="forumtitletopictext">0</div>
<div class="forumtitleposttext">0</div>
<div class="forumtitlelastposttext">
<div style="padding-top:5px;">Forum is Empty</div>
</div>


                            <?php
                        }
                        ?>
                   
                    <div class="clear">&nbsp;</div>
                    <?php if($totalpages>1) {  ?>
                    <div class="com_imagetext" style="width:845px;" align="center">
                            <?
                            if($totalpages>10 && $_GET["pgno"]!="") {
                                $startloop = $_GET["pgno"];
                                if(($totalpages-$_GET["pgno"])<9) {
                                    $startloop = $totalpages-9;
                                }
                            }
                            else {
                                $startloop = 1;
                            }

                            if($totalpages>10) {
                                $endrow = $startloop + 9;
                            }
                            else {
                                $endrow = $totalpages;
                            }
                            if($endrow>$totalpages) {
                                $endrow = $totalpages;
                            }
                            ?>
                            <?php if($_GET["pgno"]>1 && $_GET["pgno"]!="" ) { ?>
                        <a class="darkblue-12-link" href="forum_detail.php?pgno=1&fid=<?php echo $forum_id?>">&lt;&lt;&nbsp;</a>
                                <?php } else { ?><span class="darkblue-12-b">&lt;&lt;&nbsp;</span>
                                <?php } ?>

                            <?php if($_GET["pgno"]!="" && $_GET["pgno"]>1) {
                                $previouspage = $_GET["pgno"]-1;  ?>
                        <a class="darkblue-12-link" href="forum_detail.php?pgno=<?=$previouspage;?>&fid=<?php echo $forum_id?>">&lt;&nbsp;</a>|&nbsp;
                                <?php } else { ?><span class="darkblue-12-b">&lt;&nbsp;</span>|
                                <?php } ?>

                            <?
                            if(!$_GET["pgno"]) {
                                $matchpgno = 1 ;
                            } else {
                                $matchpgno = $_GET["pgno"];
                            }
                            for($i=$startloop;$i<=$endrow;$i++) {
                                if($matchpgno!=$i) {
                                    ?>
                        <a href="forum_detail.php?pgno=<?=$i;?>&fid=<?php echo $forum_id?>" class="darkblue-12-link"><?=$i;?></a><?php if($i<$endrow) { ?>&nbsp;|<?php } ?>
                                    <?
                                }
                                else {
                                    ?>
                        <span class="red-text-12-b"><?=$i;?></span><?php if($i<$endrow) { ?>&nbsp;|<?php } ?>
                                    <?
                                }
                                ?>
                                <?php } ?>

                            <?php if($_GET["pgno"]<$totalpages) {
                                if(!$_GET["pgno"]) {
                                    $nextpage = 2;
                                } else {
                                    $nextpage = $_GET["pgno"] + 1;
                                } ?>
                        |&nbsp;<a class="darkblue-12-link" href="forum_detail.php?pgno=<?=$nextpage;?>&fid=<?php echo $forum_id?>">&gt;&nbsp;</a>
                                <?php } else { ?>
                        |&nbsp;<span class="darkblue-12-b">&gt;&nbsp;</span>
                                <?php } ?>

                            <?php if($_GET["pgno"]<$totalpages) { ?>
                        <a class="darkblue-12-link" href="forum_detail.php?pgno=<?=$totalpages;?>&fid=<?php echo $forum_id?>">&gt;&gt;&nbsp;</a>
                                <?php } else { ?>
                        <span class="darkblue-12-b">&gt;&gt;&nbsp;</span>
                                <?php } ?>

                    </div>
                    <div class="clear">&nbsp;</div>
                        <?php } ?>

                    <div style="float:right;margin-bottom:10px;">
                        <?php if($user !="") {?>
                        <button class="forummainbutton1" onclick="javascript: window.location.href='posttopic.php?fid=<?php echo $forum_id;?>'" ><?php echo POST_TOPIC; ?></button>

                            <?php } else { ?>
                        <button class="forummainbutton1"  onclick="GiveAlert('1','<?php echo $forum_id?>');" ><?php echo POST_TOPIC; ?></button>
                            <?php } ?>
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
 
