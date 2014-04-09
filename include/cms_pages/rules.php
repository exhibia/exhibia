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
                                <h1>Site Rules</h1>
			
								<ol class="site-rules">
						
							<li>Only one account is allowed per person.</li>
							<li>Collusion, defined as two or more users working together in a QuiBids auction, is prohibited and can result in disabled accounts and canceled orders.</li>
							<li>Only 12 wins are allowed per account over a 28 day time period.</li>
							<li>Only 1 win of the same product with a value price of over $285.00 is allowed over a 28 day time period <em>(e.g. you can only win a certain Playstation once every 28 days)</em>.</li>
							<li>Only 12 wins are allowed per day.</li>
							<li>Only 1 win is allowed per 28 days on items with a value price $1,000.00 or greater.</li>
							<li>No bots of any kind are allowed when using the site.</li>
							<li>QuiBids employees and their family members <em>(defined as parents, spouse, siblings and children)</em> and any person residing in the same household as employees may not under any circumstances participate in QuiBids auctions.</li>
							<li>A user may only post one review per product. Users must be logged into their account and have made a purchase to comment on the product. Only reviews pertaining to the product and not the auction experience, customer service, shipping and handling, or delivery will be accepted. To learn more about posting reviews, please visit the <a href='/en/help/rules_reviews.php'>Reviews Rules page</a>.</li>
											</ol>
					<p class="disclaimer">
						
							<strong>Important:</strong> Please note that breaking these rules (e.g. by creating multiple accounts for one 
							person or by using bots) violates our terms & conditions and will result in the disabling of all of that 
							customer’s accounts. Any items won while in violation of the terms & conditions are not valid and will not 
							be fulfilled. Further, refunds will only be processed for the amounts paid for these items and not for any 
							bids used to win these items while violating the terms & conditions.
											</p>
                </div><!--end column-right-->
               
                <div id="column-left">
                
           <?php
              if(db_num_rows(db_query("select * from registration where id = '$_SESSION[userid]' and admin_user_flag >= 1")) >= 1 & $ds_enabled == true){
              
              ?>
              <h2 onclick="javascript: add_helptopic('<?php echo basename($_SERVER['PHP_SELF']);?>');">Edit Help Topic</h2>
              
              
              <?php
              }
              ?>
                    <div id="navigationBox" class="box">
                        <h3><?php echo HELP_TOPICS; ?></h3>

                        <div class="box-content">
                            <ul>
                                <?php
                                $qrys = "select * from helptopic order by topic_id";
                                $ress = db_query($qrys);
                                $totals = db_num_rows($ress);
                                $counter = 1;
                                $countersub = 1;
                                while($rows = db_fetch_array($ress)) {
                                    ?>
                                <li id="help_header_<?=$counter;?>"><h5><a href="javascript: ShowMainTitle('<?=$counter;?>')"><?=stripslashes($rows["topic_title"]);?></a></h5></li>
                                <li class="help_links" id="subtitle_<?=$counter;?>" <?=$counter==$showanstitle?"":"style='display: none;'";?>>
                                    <ul>
                                            <?php
                                            $qr = "select * from faq where parent_topic='".$rows["topic_id"]."' order by id";
                                            $resqr = db_query($qr);
                                            $totalqr = db_num_rows($resqr);

                                            while($rowsqr = db_fetch_array($resqr)) {
                                                ?>
                                        <li id='subque_<?=$countersub?>'><a href="javascript: ShowAnsTitle('<?=$countersub;?>')"  class="linkmay_2"><?=stripslashes($rowsqr["que_title"]);?></a></li>
                                                <?
                                                $countersub++;
                                            }
                                            ?>
                                    </ul>
                                </li>
                                    <?php
                                    $counter++;
                                }
                                ?>
                            </ul>
                        </div><!-- /box-content -->

                    </div><!-- /navigationBox -->
        
                </div><!-- /column-left -->
                </div>
            </div><!--end container-->

            <?php include("footer.php"); ?>
        </div> 
