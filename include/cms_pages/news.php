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
                <div id="column-left">
                    <!-- last winner -->
                    <?php include("include/leftside.php"); ?>
                </div><!-- /column-left-->
<div class="tab-area">
                <div id="column-right">
                    <?php include("include/searchbox.php"); ?>
                    <div id="title-category-content">
                        <?php include("include/categorymenu.php"); ?>
                        <p class="bid-title"><strong><?=$SITE_NM;?> - <?php echo NEWS; ?></strong></p>
                    </div><!-- /title-category-content -->
                    <div class="rounded_corner">
                        <div class="content">
                            <h2><?=$objsel["news_title"];?></h2>
                            <br/>
                            <p>
                                <?=$objsel["news_long_content"];?>
                            </p>
                        </div>
                    </div>
                </div><!-- /column-right -->
             </div>
            </div><!-- /container -->
            <?php include("footer.php"); ?> 
