
        <div id="main">

            	<?php if(empty($header)){ include_once($BASE_DIR . '/include/' . $template . '/header.php'); } ?>

            <div id="container">

                <?php if(empty($nav_menu)) { include_once($BASE_DIR . "/include/topmenu.php"); } ?>
                <div class="tab-area">
                <div id="column-right">
                    <?php include("include/searchbox.php"); ?>
                    <div id="title-category-content">
                        <?php include("include/categorymenu.php"); ?>
                        <p class="bid-title"><strong><?php echo $SITE_NM; ?> - <?php echo REDEMPTION;?></strong></p>
                    </div><!-- /title-category-content -->
                    <div id="mybids-box" class="content">
                        <?
                        if($totalpro>0) {
                            $i = 1;
                            while($obj = db_fetch_array($ressel)) {

			    if($obj['category_id'] == '1'){

 $rowB = db_fetch_array(db_query("select * from bidpack where id = '" . $obj['product_id'] . "' limit 1"));
	    $obj['name'] = $rowB['bidpack_name'];
             $obj['price'] = $rowB['bidpack_price'];
            $obj['picture1'] = $rowB['bidpack_banner'];
            $obj['picture2'] = $rowB['bidpack_banner2'];
            $obj['picture3'] = $rowB['bidpack_banner3'];
            $obj['picture4'] = $rowB['bidpack_banner4'];

			    }
                                if($i==4) {
                                    $classname = "redembox2";
                                } else {
                                    $classname = "redembox";
                                }
                                ?>
                        <div class="bid-box">
                            <div class="bid-image">
                                <a href="<?php echo SEOSupport::getRedeemUrl($obj["name"], $obj["id"]); ?>">
                                    <img src="<?=$UploadImagePath;?>products/thumbs_big/thumbbig_<?=$obj["picture1"];?>" alt="" width="118" height="100" border="0"/>
                                </a>

                            </div><!-- /bid-image -->
                            <div class="bid-content">
                                <h2><a href="<?php echo SEOSupport::getRedeemUrl($obj["name"], $obj["id"]); ?>"><?=$obj["name"];?></a></h2>
                                <p>
                                    <strong><?php echo PRODUCT_PRICE; ?>:</strong><?=$Currency.$obj["price"];?>
                                </p>
                                <p>
                                    <strong><?php echo REDEMPTION_POINTS; ?>:</strong><?=$obj["redem_points"];?>
                                </p>
                                <p>
                                    <strong><?php echo EXPERATION_DATE; ?>:</strong><?php echo arrangedate($obj["redem_enddate"]);?>
                                </p>
                            </div><!-- /bid-content -->
                            <div class="bid-redem">
                                        <?php if($obj["redem_qty"]>$obj["redem_soldqty"]) { ?>
                                            <?php if ( $uid == 0 ) { ?>
                                <a class="button" onclick="window.location.href='login.php'" onmouseout="$(this).text('<?php echo REDEEM;?>')" onmouseover="$(this).text('<?php echo LOGIN; ?>')"><?php echo REDEEM;?></a>

                                                <?php } else { ?>
                                <a class="button" onclick="window.location.href='<?php echo SEOSupport::getRedeemUrl($obj["name"], $obj["id"]); ?>'"><?php echo REDEEM;?></a>

                                                <?php } ?>                                            
                                            <?php } else { ?>
                                <a class="button" ><?php echo SOLD;?></a>
                                            <?php } ?>
                            </div><!-- /bid-redem -->
                        </div><!-- /bid-box -->
                                <?php } ?>

                        <!-- start page number-->

                        <div class="clear">&nbsp;</div>
                            <?php if($totalpage>1) { ?>
                        <div class="pagenumber" align="right">
                            <ul>
                                        <?
                                        if($PageNo>1) {
                                            $PrevPageNo = $PageNo-1;

                                            ?>
                                <li><a href="redemption.php?pgno=<?=$PrevPageNo; ?>">&lt; <?php echo PREVIOUS_PAGE; ?></a></li>
                                            <?
                                        }
                                        ?>

                                        <?
                                        if($PageNo<$totalpage) {
                                            $NextPageNo = 	$PageNo + 1;
                                            ?>
                                <li><a id="next" href="redemption.php?pgno=<?=$NextPageNo;?>"><?php echo NEXT_PAGE;?> &gt;</a></li>
                                            <?
                                        }
                                        ?>
                            </ul>
                        </div>
                                <?php } ?><!--page number-->

                            <?php }else {?>
                        <div class="clear" style="height: 20px;">&nbsp;</div>
                        <div align="center"><?php echo NO_REDEMPTION_TO_DISPLAY;?></div>
                        <div class="clear" style="height: 20px;">&nbsp;</div>
                            <?	}	?>

                    </div><!-- /content -->
                </div><!-- /column-right -->
                <div id="column-left">
                    <?php include("leftside.php"); ?>
                </div><!-- /column-left -->
                </div>
            </div><!-- /container -->

            <?php include("footer.php"); ?> 
