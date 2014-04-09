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
  <?php  include("header.php"); ?>
     <div id="container">
        <?php  include("include/topmenu.php"); ?>
        <div class="tab-area">
        <div id="column-right">
            <?php  include("include/searchbox.php"); ?>
            <div id="title-category-content">
                <?php  include("include/categorymenu.php"); ?>
                <p class="bid-title"><strong><?php echo $SITE_NM; ?> - <?php echo COMMUNITY; ?></strong></p>
            </div><!-- /title-category-content -->
            <div id="mybids-box" class="content">	
            <?php 
				while($row = db_fetch_object($resultCommunity))
				{
					$com_date = $row->com_date;
					$date = date("d",$com_date);
					$month = date("m",$com_date);
					$year = date("Y",$com_date);
					$totalcomment = getTotalComment($row->id);
			?>	
                <div class="bid-box">
                    <div class="bid-image">
                        <a href="comment.php?com_id=<?php echo $row->id;?>">
                            <img src="uploads/community/thumb/thumb_<?php echo $row->picture1;?>" alt="" width="118" height="100" border="0"/>
                        </a>
                        
                    </div><!-- /bid-image -->
                    <div class="bid-content">
                    	<p>
                        	<a href="comment.php?com_id=<?php echo $row->id;?>"><h2><?php echo stripslashes($row->title);?></h2></a>
                        </p>
                        <p>
                        	<?php echo choose_short_desc(stripslashes($row->com_short_desc),100);?>
                            <a href="comment.php?com_id=<?php echo $row->id;?>" class="blackmore"><?php echo MORE; ?></a>
                        </p>
                    </div><!-- /bid-content -->
                    <div class="bid-countdown">
                    	<p>
                       	<?php if($totalcomment > 0){?>
							<span><strong><?php echo TOTAL_POST; ?>:</strong><?php echo $totalcomment;?></span><br /><br />
							<span><strong><?php echo LAST_POST_BY ?>:</strong><?php $last = getLastComment($row->id); echo getUserName($last);?></span>
						<?php } ?>
                        </p>
                    </div><!-- /bid-countdown -->
                </div><!-- /bid-box -->
               	<?php } ?>
            
                <!-- start page number-->
                
              	<div class="clear">&nbsp;</div>
				<?php if($totalpages>1){  ?>
				<div class="com_imagetext" align="center">
            	<?php
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
				<?php  if($_GET["pgno"]>1 && $_GET["pgno"]!="" ){ ?>
                    <a class="darkblue-12-link" href="community.php?pgno=1">&lt;&lt;&nbsp;</a>
                    <?php  } else { ?><span class="darkblue-12-b">&lt;&lt;&nbsp;</span>
                <?php  } ?>
                
                <?php  if($_GET["pgno"]!="" && $_GET["pgno"]>1) { $previouspage = $_GET["pgno"]-1;  ?>
                    <a class="darkblue-12-link" href="community.php?pgno=<?=$previouspage;?>">&lt;&nbsp;</a>|&nbsp;
                    <?php  } else { ?><span class="darkblue-12-b">&lt;&nbsp;</span>|
                <?php  } ?>

				<?php
				if(!$_GET["pgno"]) { $matchpgno = 1 ; } else { $matchpgno = $_GET["pgno"]; }
				for($i=$startloop;$i<=$endrow;$i++)
				{
						if($matchpgno!=$i)
						{
				?>
						<a href="community.php?pgno=<?=$i;?>" class="darkblue-12-link"><?=$i;?></a><?php  if($i<$endrow){ ?>&nbsp;|<?php  } ?>
						<?
						}
						else
						{
						?>
						<span class="red-text-12-b"><?=$i;?></span><?php  if($i<$endrow){ ?>&nbsp;|<?php  } ?>
						<?
						}
						?>
                <?php  } ?>
            
					<?php  if($_GET["pgno"]<$totalpages){ if(!$_GET["pgno"]) { $nextpage = 2; } else { $nextpage = $_GET["pgno"] + 1;} ?>
                    |&nbsp;<a class="darkblue-12-link" href="community.php?pgno=<?=$nextpage;?>">&gt;&nbsp;</a>
                    <?php  } else { ?>
                        |&nbsp;<span class="darkblue-12-b">&gt;&nbsp;</span>
                    <?php  } ?>
                    
                    <?php  if($_GET["pgno"]<$totalpages) { ?>
                        <a class="darkblue-12-link" href="community.php?pgno=<?=$totalpages;?>">&gt;&gt;&nbsp;</a>
                    <?php  } else { ?>
                        <span class="darkblue-12-b">&gt;&gt;&nbsp;</span>
                    <?php  } ?>

                </div>
                <?php } ?>                             
          
            </div><!-- /content -->
        </div><!-- /column-right -->
        <div id="column-left">
            <?php  include("leftside.php"); ?>
        </div><!-- /column-left -->
        </div>
    </div><!-- /container -->
  </div> <!--end main--> 
  <?php  include("footer.php"); ?>

