
        <div id="main">

            	<?php if(empty($header)){ include_once($BASE_DIR . '/include/' . $template . '/header.php'); } ?>

            <div id="container">

                <?php if(empty($nav_menu)) { include_once($BASE_DIR . "/include/topmenu.php"); } ?>
	 <div class="tab-area">
            <?php include("searchbox.php"); ?>
            <div id="title-category-content">
                <?php include("categorymenu.php"); ?>
                <p class="bid-title"><strong><?=$SITE_NM;?> - <?php echo FORUM; ?></strong> </p>
            </div><!-- /title-category-content -->        
            
            	<div class="greymenuforum" style="height:24px;padding-top:5px;width:430px;float:left;"><?php echo FORUM; ?></div>
            	<div class="forumsubmain">
                    <div class="forumtitle"><?php echo FORUMS; ?></div>
                    <div class="forumtitletopic"><?php echo TOPICS; ?></div>
                    <div class="forumtitlepost"><?php echo POSTS; ?></div>
                    <div class="forumtitlelastpost"><?php echo LAST_POST; ?></div>
                    
                    <?php
					
					if(!$_GET['pgno'])
					{
						$PageNo = 1;
					}
					else
					{
						$PageNo = $_GET['pgno'];
					}
					
					$StartRow = $PRODUCTSPERPAGE * ($PageNo-1);
					
					$selectForum = "select * from forum_categories fc left join  forums fm on fc.category_id = fm.forums_category where fc.status = '0' and fm.forum_status = '0' order by fc.category_id,fm.forums_id desc";
					
					$result =db_query($selectForum);
					
					$totalrows = db_num_rows($result);
					$totalpages = ceil($totalrows/$PRODUCTSPERPAGE);
					$selectForum .= " LIMIT $StartRow,$PRODUCTSPERPAGE";
					$resultForum = db_query($selectForum) or die(db_error());
					
					$total = db_num_rows($resultForum);
					$k = 0;
					if($total > 0){
					while($forumRow = db_fetch_object($resultForum))
					{
						$lastuser = lastPostOnForum($forumRow->forums_id);
						$lasttopic = explode("|",$lastuser);
						$last_user = $lasttopic[0];
						$lastdate_time = $lasttopic[1];
						if($forumRow->category_name!=$oldcatname)
						{
							$k = 0;
						}
						?>
						<?php if($k == 0){ ?>
						<div class="cat_sub_heading">
							<?php echo stripslashes($forumRow->category_name);?>
						</div>
						<?php } ?>
							<div class="forumtitletext">
								<div>
									<a href="forum_detail.php?fid=<?php echo $forumRow->forums_id;?>" class="darkblue-12-link"><?php echo stripslashes($forumRow->forums_name);?></a></div>
								<div style="padding-top:5px;">	
								<?php echo wordwrap(stripslashes(GetValueWithSmileys(choose_short_desc($forumRow->forums_description,100))),80,"\n",1);?>
								</div>
							</div>
							<div class="forumtitletopictext"><?php echo stripslashes(totalTopicOnForum($forumRow->forums_id));?></div>
							<div class="forumtitleposttext"><?php echo stripslashes(totalPostOnForum($forumRow->forums_id));?></div>
							<div class="forumtitlelastposttext">
							<?php if($last_user !=""){?>
							<div><?php echo date("M d, Y", stripslashes($lastdate_time));?>&nbsp;&nbsp;<?php echo date("h:i A", stripslashes($lastdate_time));?></div>
							<div style="padding-top:5px;">By:&nbsp;<?php echo stripslashes($last_user);?></div>
							<?php } else {?>
								<div style="padding-top:5px;"><?php echo FORUM_IS_EMPTY;?></div>
							<?php } ?>
							</div>
							<?php 	
								$oldcatname = stripslashes($forumRow->category_name);
							$k++;
								} 
							}
							else
							{	
							?>
							<div class="clear"></div>
							<div align="center" style=" padding-bottom:15px;padding-top:15px;"><?php echo NO_FORUM_TO_DISPLAY;?></div>
					<?php } ?>
                </div>
                
                <div class="clear">&nbsp;</div>
			
			<?php if($totalpages>1){  ?>
			<div class="com_imagetext" style="width:845px;" align="center">
            	<?
					if($totalpages>10 && $_GET["pgno"]!="")
					{
						$startloop = $_GET["pgno"];
						if(($totalpages-$_GET["pgno"])<9)
						{
							$startloop = $totalpages-9;
						}
					}
					else
					{
						$startloop = 1;
					}
					
					if($totalpages>10) { $endrow = $startloop + 9; } 
					else { $endrow = $totalpages; }
					if($endrow>$totalpages)
					{
						$endrow = $totalpages;	
					}
				?>
                	<?php if($_GET["pgno"]>1 && $_GET["pgno"]!="" ){ ?>
	                	<a class="darkblue-12-link" href="index.php?pgno=1">&lt;&lt;&nbsp;</a>
	                    <?php } else { ?><span class="darkblue-12-b">&lt;&lt;&nbsp;</span>
                    <?php } ?>
                    
					<?php if($_GET["pgno"]!="" && $_GET["pgno"]>1) { $previouspage = $_GET["pgno"]-1;  ?>
        	            <a class="darkblue-12-link" href="index.php?pgno=<?=$previouspage;?>">&lt;&nbsp;</a>|&nbsp;
    	                <?php } else { ?><span class="darkblue-12-b">&lt;&nbsp;</span>|
                    <?php } ?>

				<?
					if(!$_GET["pgno"]) { $matchpgno = 1 ; } else { $matchpgno = $_GET["pgno"]; }
					for($i=$startloop;$i<=$endrow;$i++)
					{
						if($matchpgno!=$i)
						{
				?>
	                	<a href="index.php?pgno=<?=$i;?>" class="darkblue-12-link"><?=$i;?></a><?php if($i<$endrow){ ?>&nbsp;|<?php } ?>
					<?
                    	}
						else
						{
                    ?>
                    	<span class="red-text-12-b"><?=$i;?></span><?php if($i<$endrow){ ?>&nbsp;|<?php } ?>
                    <?
						}
					?>
                <?php } ?>
            
                <?php if($_GET["pgno"]<$totalpages){ if(!$_GET["pgno"]) { $nextpage = 2; } else { $nextpage = $_GET["pgno"] + 1;} ?>
                |&nbsp;<a class="darkblue-12-link" href="index.php?pgno=<?=$nextpage;?>">&gt;&nbsp;</a>
                <?php } else { ?>
                	|&nbsp;<span class="darkblue-12-b">&gt;&nbsp;</span>
                <?php } ?>
                
                <?php if($_GET["pgno"]<$totalpages) { ?>
	                <a class="darkblue-12-link" href="index.php?pgno=<?=$totalpages;?>">&gt;&gt;&nbsp;</a>
                <?php } else { ?>
                	<span class="darkblue-12-b">&gt;&gt;&nbsp;</span>
                <?php } ?>

			</div>
            <?php } ?>
            </div>
        </div>
        <?php include("footer.php");?>
    </div> 
