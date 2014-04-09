
	<div id="main">
		<?php include("$BASE_DIR/include/$template/header.php"); ?>
        <div id="container">
        	<?php include("include/topmenu.php"); ?>
            <div id="column-left">
				<!-- last winner -->
            	<?php include("include/lastwinner.php"); ?>
                <?php include("include/bidpackage.php"); ?>
                <img src="include/addons/icons/quibids-1.0/credit-cards.gif" alt="" />
			</div><!-- /column-left-->
            
            <div id="column-right">
				<?php include("include/searchbox.php"); ?>
                <div id="title-category-content">
                    <?php include("include/categorymenu.php"); ?>
                    <p class="bid-title"><strong><?=$SITE_NM;?> - <?php echo NEWS; ?></strong></p>
                </div><!-- /title-category-content -->
            	<div class="rounded_corner">
                	<div class="content">
                    	<?
						if($totalnews>0)
						{
							while($objnews = db_fetch_array($rsselnews))
							{
						?>
							<p>
                            	<a href="news.php?nid=<?=$objnews["id"];?>"><h2 style="display:inline;"><?=stripslashes($objnews["news_title"]);?></h2></a>
                                &nbsp;&nbsp;(<strong class="normal_text"><?php echo NEWS_DATE; ?>: <?=arrangedate($objnews["news_date"]);?></strong>)
                                <br />
								<?=stripslashes(choose_short_desc($objnews["news_short_content"],250));?><a href="news.php?nid=<?=$objnews["id"];?>" class="linkmore1"><?php echo MORE;?></a>
                            </p>
                            <br />
						<?
							}
						?>
                         <!-- start page number-->
                
                        <div class="clear">&nbsp;</div>
                        <?php if($totalpage>1){ ?>
                        <div class="pagenumber" align="right">
                            <ul>
                            <?
                            if($PageNo>1)
                            {
                                  $PrevPageNo = $PageNo-1;
                            
                            ?>
                              <li><a href="allnews.php?pgno=<?=$PrevPageNo; ?>">&lt; <?php echo PREVIOUS_PAGE; ?></a></li>
                            <?php 
                            }
                            ?>
                            
                            <?
                            if($PageNo<$totalpage)
                            {
                             $NextPageNo = 	$PageNo + 1;
                            ?>
                              <li><a id="next" href="allnews.php?pgno=<?=$NextPageNo;?>"><?php echo NEXT_PAGE;?> &gt;</a></li>
                            <?
                               }
                            ?>
                            </ul>
                        </div>		
                        <?php } ?><!--page number-->      
                        
                            
                        <?
                        }
                        else
                        {
                        ?>
                        <div align="center" style="height: 220px; padding-top: 30px;"><?php echo NO_NEWS_TO_DISPLAY; ?></div>
                        <div style="height: 100px;">&nbsp;</div>
                        <?
                        }
                        ?>
                    </div>                                
                </div>				                
			</div><!-- /column-right -->	
		</div><!-- /container -->
		<?php include("$BASE_DIR/include/$template/footer.php"); ?>
	</div><!-- /main -->


