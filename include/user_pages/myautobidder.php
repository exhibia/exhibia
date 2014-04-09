
        <div id="main">

            	<?php if(empty($header)){ include_once($BASE_DIR . '/include/' . $template . '/header.php'); } ?>

            <div id="container">

                <?php if(empty($nav_menu)) { include_once($BASE_DIR . "/include/topmenu.php"); } ?>
	 <div class="tab-area">
                <div id="column-right">

                    <?php include_once($BASE_DIR . "/include/searchbox.php"); ?>

                    <div id="title-category-content">

                        <?php include_once($BASE_DIR . "/include/categorymenu.php"); ?>
                <p class="bid-title"><em><?php echo MY_ACTIVE_AUTOBIDDER; ?></em></p>
            </div><!-- /title-category-content -->
            <div id="mybids-box" class="content">	
            <?
                
            if($total>0)
            {						
                while($obj = db_fetch_array($ressel))
            	{
            ?>				
            <div class="bid-box">
                <div class="bid-image">
                    <a href="<?php echo SEOSupport::getProductUrl($obj["name"], $obj["auctionID"], 'n'); ?>">
                        <img src="<?=$UploadImagePath;?>products/thumbs_small/thumbsmall_<?=$obj["picture1"];?>" alt="" width="118" height="100" border="0"/>
                    </a>
                    <img src="img/buttons/btn_closezoom.png" style="cursor: pointer;" onclick="DeleteBidButler1('<?=$obj["id"]?>');"/>                    
                </div><!-- /bid-image -->
                <div class="bid-content">
                    <h2><a href="<?php echo SEOSupport::getProductUrl($obj["name"], $obj["auctionID"], 'l'); ?>"><?=stripslashes($obj["name"]);?></a></h2>
                    <h3><?php echo DESCRIPTION; ?>:</h3>
                    <p><?=choose_short_desc(str_replace("<br>", "", strip_tags(stripslashes($obj["short_desc"]))),110);?><a href="<?php echo SEOSupport::getProductUrl($obj["name"], $obj["auctionID"], 'n'); ?>"><?php echo MORE; ?></a></p>
                    
                </div><!-- /bid-content -->
                <div class="bid-countdown">
                	<br />
                    <p>
                    	<strong><?php echo START_PRICE; ?>:</strong><?=$Currency.number_format($obj["butler_start_price"],2);?>
                    </p>
                    <br />
                    <p>
                    	<strong><?php echo END_PRICE; ?>:</strong><?=$Currency.number_format($obj["butler_end_price"],2);?>
                    </p>
                    <br />
                    <p id="placebidsbut_<?=$obj["id"];?>">
                    	<strong><?php echo PLACE_BID; ?>:</strong><?=$obj["butler_bid"];?>
                    </p>
                    <br />
                </div><!-- /bid-countdown -->
            </div><!-- /bid-box -->
            <?php } ?>
            
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
                      <li><a href="myaccount.php?pgno=<?=$PrevPageNo; ?>">&lt; <?php echo PREVIOUS_PAGE; ?></a></li>
                    <?php 
                    }
                    ?>
                    
                    <?php
                    if($PageNo<$totalpage)
                    {
                     $NextPageNo = 	$PageNo + 1;
                    ?>
                      <li><a id="next" href="myaccount.php?pgno=<?=$NextPageNo;?>"><?php echo NEXT_PAGE; ?> &gt;</a></li>
                    <?php
                       }
                    ?>
                    </ul>
                </div>		
                <?php } ?><!--page number-->                    
            
            <?php }else{?>
            <div class="clear" style="height: 20px;">&nbsp;</div>
            <div align="center"><?php echo YOU_DONT_CURRENTLY_HAVE_ANY_AUTOBIDDERS; ?></div>
            <div class="clear" style="height: 20px;">&nbsp;</div>
            <?	}	?>                    
                
            </div><!-- /content -->
        </div><!-- /column-right -->
        <div id="column-left">
            <?php include("leftside.php"); ?>
            <?php include("include/bidpackage.php"); ?>
            <img src="img/icons/credit-cards.gif" alt="" />
        </div><!-- /column-left -->
        </div>
	</div><!-- /container -->
  
  <?php include("footer.php"); ?>
 
