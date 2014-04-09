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
            
             <?php if($msg == 1) {?>
                <div class="clear">&nbsp;</div>
                <div class="clear">&nbsp;</div>
                <div class="clear">&nbsp;</div>
                <div class="greenfont" style="text-align:center"><b><?php echo REPLY_SUBMITED_SUCCESSFULLY; ?></b></div>
                    <?php }?>

                <div class="forummain">
                    <div class="clear">&nbsp;</div>

                    <div style="height:40px;margin:10px 0 0 20px;">
                        <div style="padding-top:5px;float:left;">
                            <a href="forums.php" class="darkblue-12-link"><?php echo FORUM; ?></a>&nbsp;>> &nbsp;
                            <a href="forum_detail.php?fid=<?php echo $forum_id;?>" class="darkblue-12-link"><?php echo stripslashes($forumname);?></a>&nbsp;>>&nbsp;<span class="greymenuforum">
                                <?php echo wordwrap(stripslashes($tcontent),70,"\n",1);?></span>
                        </div>
                        <div style="float:right">
                            <?php if($user !="") {?>
                            <button class="forummainbutton1" onclick="javascript: window.location.href='postreply.php?tid=<?php echo $topic_id?>'" ><?php echo POST_REPLY; ?></button>

                                <?php } else { ?>
                            <button class="forummainbutton1"  onclick="GiveAlert('1','<?php echo $topic_id;?>');" ><?php echo POST_REPLY; ?></button>
                                <?php } ?>


                        </div>
                    </div>
                    <div class="clear"></div>

                    <div class="forummaintitle"><?php echo FORUM_CONTENT; ?></div>

                    <div class="content">
                        <?php echo wordwrap(stripslashes(GetValueWithSmileys($topic_body)),142,"\n",1);?>
                    </div>
                    <br />

                    <div class="forumsubmain">
                        <div class="cat_sub_heading" style=" height:20px; padding-top:13px;">
                            <div style="width:160px;float:left; color:#FFFFFF; padding-left: 10px;"><?php echo AUTHOR; ?></div>
                            <div style=" color:#FFFFFF;"><?php echo MESSAGE; ?></div>
                        </div>
                        <?php
                        if(!$_GET['pgno']) {
                            $PageNo = 1;
                        }
                        else {
                            $PageNo = $_GET['pgno'];
                        }

                        $StartRow =   $PRODUCTSPERPAGE * ($PageNo-1);

                        $selectTopic = "select * from forum_reply fr left join registration rg on fr.reply_user = rg.id where fr.reply_status = '0' and fr.topicid = '".$topic_id."' order by fr.reply_time desc";
                        $result1 =db_query($selectTopic);

                        $totalrows=db_num_rows($result1);
                        $totalpages=ceil($totalrows/$PRODUCTSPERPAGE);
                        $selectTopic .= " LIMIT $StartRow,$PRODUCTSPERPAGE";
                        $resultTopic = db_query($selectTopic);
                        echo db_error();

                        $totalTopic = db_num_rows($resultTopic);

                        if($totalTopic>0) {
                            while($topicRow=db_fetch_object($resultTopic)) {


                                ?>
                        <div class="forumbox">
                            <div class="forumauthor">
                                <div><?php echo stripslashes($topicRow->username);?></div>
                                <div class="clear">&nbsp;</div>

                            </div>
                            <div class="forumviewmessage">
                                <div>Posted:<?php echo date("M d, Y", stripslashes($topicRow->reply_time));?>&nbsp;&nbsp;<?php echo date("h:i A", stripslashes($topicRow->reply_time));?></div>
                                <div style="padding-top:10px;word-wrap: break-word;">
                                            <?php echo wordwrap(stripslashes(GetValueWithSmileys($topicRow->reply_body)),110,"\n",1);?>
                                </div>

                            </div>
                        </div>
                                <?php
                            }
                            ?>
                            <?php } else {?>
                        <div class="forumtitletext" style="text-align:center; ">
                            <?php echo NO_MESSAGE_TO_DISPLAY; ?>
                        </div>
                            <?php } ?>
                    </div>
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
                        <a class="darkblue-12-link" href="viewmessage.php?pgno=1&tid=<?php echo $topic_id?>">&lt;&lt;&nbsp;</a>
                                <?php } else { ?><span class="darkblue-12-b">&lt;&lt;&nbsp;</span>
                                <?php } ?>

                            <?php if($_GET["pgno"]!="" && $_GET["pgno"]>1) {
                                $previouspage = $_GET["pgno"]-1;  ?>
                        <a class="darkblue-12-link" href="viewmessage.php?pgno=<?=$previouspage;?>&tid=<?php echo $topic_id?>">&lt;&nbsp;</a>|&nbsp;
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
                        <a href="viewmessage.php?pgno=<?=$i;?>&tid=<?php echo $topic_id?>" class="darkblue-12-link"><?=$i;?></a><?php if($i<$endrow) { ?>&nbsp;|<?php } ?>
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
                        |&nbsp;<a class="darkblue-12-link" href="viewmessage.php?pgno=<?=$nextpage;?>&tid=<?php echo $topic_id?>">&gt;&nbsp;</a>
                                <?php } else { ?>
                	|&nbsp;<span class="darkblue-12-b">&gt;&nbsp;</span>
                                <?php } ?>

                            <?php if($_GET["pgno"]<$totalpages) { ?>
                        <a class="darkblue-12-link" href="viewmessage.php?pgno=<?=$totalpages;?>&tid=<?php echo $topic_id?>">&gt;&gt;&nbsp;</a>
                                <?php } else { ?>
                        <span class="darkblue-12-b">&gt;&gt;&nbsp;</span>
                                <?php } ?>

                    </div>
                    <div class="clear">&nbsp;</div>
                        <?php } ?>
                    <div class="clear"></div>
                    <div style="float:right;margin-bottom:10px;">
                        <?php if($user !="") {?>
                        <button class="forummainbutton1" onclick="javascript: window.location.href='postreply.php?tid=<?php echo $topic_id?>'" ><?php echo POST_REPLY; ?></button>

                            <?php } else { ?>
                        <button class="forummainbutton1"  onclick="GiveAlert('1','<?php echo $topic_id;?>');" ><?php echo POST_REPLY; ?></button>
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
 
