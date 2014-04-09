<?php
if(empty($dont_show_left)){
$dont_show_left = array();
}
//Uncomment items below to remove them from ALL PAGES for ALL TEMPLATES SO LONG AS THEY ARE 100% USING THE NORMAL FRAMEWORK...IF NOT THEN LETS FIX THAT FIRST
//Skinny column
//$dont_show_left[] = 'testimonials';
//$dont_show_left[] = 'last_winner';
//$dont_show_left[] = 'right_social';
//$dont_show_left[] = 'coupon_menu';
//$dont_show_left[] = 'bidpack_menu';
//$dont_show_left[] = 'user_menu';
//$dont_show_left[] = 'help_menu';
$dont_show_left[] = 'faq_menu';
//$dont_show_left[] = 'top_menu';
//$dont_show_left[] = 'search_box';
//$dont_show_left[] = 'category_menu';

?> 
        <div id="main">
            <?php include("header.php"); ?>
            <div id="container">
                <?php include("include/topmenu.php"); ?>
	    <div class="tab-area">
                <div id="column-right">

                    <?php include("include/searchbox.php"); ?>
                    <div id="title-category-content">
                        <?php include("include/categorymenu.php"); ?>
                        <p class="bid-title"><strong><?=$SITE_NM;?> - <?php echo COMMENTS; ?></strong></p>
                    </div><!-- /title-category-content -->

                    <div class="rounded_corner">
                            <div id="contactForm" style="float:right;">
                                <?php  if($uid=="") { ?>
                                <a href='javascript: GiveAlert(1);' class='darkblue-12-link' id="Addcomment" name="<?=$_GET['com_id'];?>"><?php echo ADD_COMMENT; ?></a>
                                    <?php  } else {
                                    if($totalCheckRow>0) { ?>
                                <a href='javascript: GiveAlert(2);' class='darkblue-12-link' id="Addcomment" name="<?=$_GET['com_id'];?>"><?php echo ADD_COMMENT; ?></a>
                                        <?php  } else {  ?>
                                <a href='#' onclick="" class='contact' id="addcomment" name="<?=$_GET['com_id'];?>"><?php echo ADD_COMMENT; ?></a>
                                        <?php  } ?>
                                    <?php  } ?>
                            </div>
                            <div>
                                <div style="float:left; width: 150px;"> <img src="uploads/community/popup/popup_<?php echo $rowcommunity->picture1;?>" border="0" vspace="15"/> </div>
                                <div style="padding-top:15px;padding-left:10px; width:550px; text-align:left;">
                                    <div class="darkblue-14"><?php echo $rowcommunity->title;?></div>
                                    
                                    <div style=" font-size:13px;padding-top:15px;"><?php echo TOTAL_COMMENT; ?>:&nbsp;<span id="commtotalcomment"><?php echo getTotalComment($rowcommunity->id);?></span></div>
                                    <div style="padding-top:15px;"><?php echo LAST_COMMENT_POST_BY;?>:&nbsp;
                                        <?php $last = getLastComment($rowcommunity->id); ?>
                                        <span id="commlastuser">
                                            <?php
                                            $printuname = getUserName($last);
                                            if($printuname!="") {
                                                echo $printuname;
                                            } else {
                                                echo "---";
                                            };
                                            ?>
                                        </span></div>
                                </div>
                                
                                <div class="clear">&nbsp;</div>
                                <div> <?php echo stripslashes($rowcommunity->com_long_desc);?> </div>
                            </div>
                            <?php
                            $selectComment = "select *,cc.id as commid from community_comment cc left join registration rg on cc.user_id = rg.id where community_id = '".$comid."' order by com_date desc";

                            $result =db_query($selectComment);

                            $totalrows=db_num_rows($result);
                            $totalpages=ceil($totalrows/$PRODUCTSPERPAGE);

                            $selectComment .= " LIMIT $StartRow,$PRODUCTSPERPAGE";
                            $resultComment = db_query($selectComment) or die(db_error());
                            $total = db_num_rows($resultComment);

                            ?>
                            <div>&nbsp;</div>
                            <div id="showComment">
                                <?php
                                while($crow = db_fetch_object($resultComment)) {
                                    $communityrating = explode("|",GetCommunityRating($crow->commid));
                                    $commentdate = date("M d, Y", $crow->com_date);
                                    $commenttime = date ("h:i A",$crow->com_date);

                                    ?>
                                <div class="commentdate"> <?php echo $commentdate;?>&nbsp;&nbsp;<?php echo $commenttime?> </div>
                                <div class="commentbox">
                                    <div class="commentdesc">
                                        <div><span><?php echo USER; ?>:</span><?php echo getUserName($crow->user_id);?></div>
                                        <div class="clear">&nbsp;</div>
                                        <div><span><?php echo JOIN_DATE; ?>:&nbsp;</span> <?php echo arrangedate($crow->registration_date);?></div>
                                    </div>
                                    <div class="commentdetail"><?php echo stripslashes($crow->com_description);?>
                                        <div style="float: left; padding-top: 5px; width: 50px; padding-top: 20px;"><?php echo RATE_IT; ?>: </div>
                                        <div style="padding-top: 15px;">
                                                <?php  if($uid!="") { ?>
                                            <div style="float: left; width: 120px;">
                                                <div style="float: left; width: 28px;"><img src="img/thumbup_01.png" align="left" border="0" style="cursor: pointer;" onclick="GiveRating('0','<?=$crow->commid;?>')" /></div>
                                                <div class="thumb_uprate">
                                                    <div style="padding-top: 4px;"><span id="thumbuprateup_<?=$crow->commid;?>">
                                                                    <?=$communityrating[0];?>
                                                        </span>%</div>
                                                </div>
                                            </div>
                                            <div style="float: left; width: 120px;">
                                                <div style="float: left; width: 28px;"><img src="img/thumbdown_01.png" align="left" border="0" style="cursor: pointer;" onclick="GiveRating('1','<?=$crow->commid;?>')" /></div>
                                                <div class="thumb_downrate">
                                                    <div style="padding-top: 4px;"><span id="thumbupratedown_<?=$crow->commid;?>">
                                                                    <?=$communityrating[1];?>
                                                        </span>%</div>
                                                </div>
                                            </div>
                                                    <?php  } else { ?>
                                            <div style="float: left; width: 120px;">
                                                <div style="float: left; width: 28px;"><img src="img/thumbup_01.png" align="left" border="0" style="cursor: pointer;" onclick="GiveAlert(1)" /></div>
                                                <div class="thumb_uprate">
                                                    <div style="padding-top: 4px;"><span id="thumbuprateup_<?=$crow->commid;?>">
                                                                    <?=$communityrating[0];?>
                                                        </span>%</div>
                                                </div>
                                            </div>
                                            <div style="float: left; width: 120px;">
                                                <div style="float: left; width: 28px;"><img src="img/thumbdown_01.png" align="left" border="0" style="cursor: pointer;" onclick="GiveAlert(1)" /></div>
                                                <div class="thumb_downrate">
                                                    <div style="padding-top: 4px;"><span id="thumbupratedown_<?=$crow->commid;?>">
                                                                    <?=$communityrating[1];?>
                                                        </span>%</div>
                                                </div>
                                            </div>
                                                    <?php  } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="clear">&nbsp;</div>
                                    <?php } ?>
                                </div>     
            </div><!-- /content -->
        </div><!-- /column-right -->
        <div id="column-left">
            <?php  include("leftside.php"); ?>
        </div><!-- /column-left -->
        </div>
    </div><!-- /container -->
  
  <?php  include("footer.php"); ?>
            <span id="checkuserrating" style="display: none;">
                <?=getUserRating($_SESSION["userid"],$_GET['com_id']);?>
            </span> <span id="commentposted" style="display: none">0</span> </div> 
