 
	<div id="main">
		<?php include("header.php"); ?>
        <div id="container">
        	<?php include("include/topmenu.php"); ?>
            <div id="column-left">
				<!-- last winner -->
            	<?php include("leftside.php"); ?>
			</div><!-- /column-left-->
            
            <div id="column-right">
				
                
            	
                	<div class="content">
                	<?php include("include/searchbox.php"); ?>
				<?php include("include/categorymenu.php"); ?>
                	
                	<div id="title-category-content">
                    
			      <p class="bid-title"><strong><?php echo $SITE_NM;?> - <?php echo NEWS; ?></strong></p>
			</div><!-- /title-category-content -->
                    	<?php
						if($totalnews>0)
						{
							while($objnews = db_fetch_array($rsselnews))
							{
						?>
							<p>
                            	<a href="news.php?nid=<?php echo $objnews["id"];?>"><h2 style="display:inline;"><?php echo stripslashes($objnews["news_title"]);?></h2></a>
                                &nbsp;&nbsp;(<strong class="normal_text"><?php echo NEWS_DATE; ?>: <?php echo arrangedate($objnews["news_date"]);?></strong>)
                                <br />
								<?php echo stripslashes(choose_short_desc($objnews["news_short_content"],250));?><a href="news.php?nid=<?php echo $objnews["id"];?>" class="linkmore1"><?php echo MORE;?></a>
                            </p>
                            <br />
						<?php
							}
						?>
                         <!-- start page number-->
                
                        <div class="clear">&nbsp;</div>
                        <?php if($totalpage>1){ ?>
                        <div class="pagenumber" align="right">
                            <ul>
                            <?php
                            if($PageNo>1)
                            {
                                  $PrevPageNo = $PageNo-1;
                            
                            ?>
                              <li><a href="allnews.php?pgno=<?php echo $PrevPageNo; ?>">&lt; <?php echo PREVIOUS_PAGE; ?></a></li>
                            <?php 
                            }
                            ?>
                            
                            <?php
                            if($PageNo<$totalpage)
                            {
                             $NextPageNo = 	$PageNo + 1;
                            ?>
                              <li><a id="next" href="allnews.php?pgno=<?php echo $NextPageNo;?>"><?php echo NEXT_PAGE;?> &gt;</a></li>
                            <?php
                               }
                            ?>
                            </ul>
                        </div>		
                        <?php } ?><!--page number-->      
                        
                            
                        <?php
                        }
                        else
                        {
                        ?>
                        <div align="center" style="height: 220px; padding-top: 30px;"><?php echo NO_NEWS_TO_DISPLAY; ?></div>
                        <div style="height: 100px;">&nbsp;</div>
                        <?php
                        }
                        ?>
                    </div>                                
                		                
			</div><!-- /column-right -->	
		</div><!-- /container -->
		<?php include("footer.php"); ?>
	</div><!-- /main -->