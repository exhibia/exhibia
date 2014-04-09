<?php
if(empty($dont_show)){
$dont_show = array();
}
//Uncomment items below to remove them from this page for this template only

//Skinny column
$dont_show[] = 'testimonials';
$dont_show[] = 'last_wiinner';
$dont_show[] = 'right_social';
$dont_show[] = 'coupon_menu';
//$dont_show[] = 'bidpack_menu';
$dont_show[] = 'user_menu';
$dont_show[] = 'help_menu';
$dont_show[] = 'faq_menu';
//$dont_show[] = 'top_menu';
//$dont_show[] = 'search_box';
//$dont_show[] = 'category_menu';

//Wide column
//$dont_show[] = 'auction_boxes';
//$dont_show[] = 'top_menu';
//$dont_show[] = 'search_box';
//$dont_show[] = 'steps_box';

?>
	<div id="main">
            <?php include("header.php"); ?>
            <div id="container">
                <?php include("include/topmenu.php"); ?>
                 <div class="tab-area">
                <div id="column-right">
                    <?php include("include/searchbox.php"); ?>

                    <?php
                    $qr2 = "select *,".$lng_prefix."que_content as que_content,".$lng_prefix."que_title as que_title from faq order by parent_topic,id";
                    $resqr2 = db_query($qr2);
                    $totalqr = db_num_rows($resqr2);
                    $counterans = 1;
                    while($v=db_fetch_array($resqr2)) {
                        if($counterans==$shoansanswer) {
                            ?>
                    <div class="entry help_entry" id="answer_<?=$counterans;?>">
                        <h2 id="help-title"><?=stripslashes($v["que_title"]);?></h2>
                        <p><?=stripslashes($v["que_content"]);?></p>
                    </div><!-- /entry -->
                            <?php
                        }
                        else {
                            ?>
                    <div class="entry help_entry" id="answer_<?=$counterans;?>" style="display:none">
                        <h2 id="help-title"><?=stripslashes($v["que_title"]);?></h2>
                        <p><?=stripslashes($v["que_content"]);?></p>
                    </div><!-- /entry -->
                            <?php
                        }
                        $counterans++;
                    }
                    
                  if($_REQUEST['pt'] == 'affilliate'){

			if(db_num_rows(db_query("select * from sitesetting where name = 'afilliate_progr' and value!= 'PAS' limit 1")) >0){
			    $program = db_fetch_array(db_query("select * from sitesetting where name = 'afilliate_progr' and value!= 'PAS' limit 1"));
			    
			    include("include/addons/$program[2]/squeeze_page.php");
			    $showanstitle = 4;
				$shoansanswer = 7;   
    
    
			    }else{
    //PAS affilliate code goes here
    
    
			    }

		    }

                    ?>
                </div><!--end column-right-->
               
                <div id="column-left">
                
           <?php
              if(db_num_rows(db_query("select * from registration where id = '$_SESSION[userid]' and admin_user_flag >= 1")) >= 1){
              
              ?>
             <!-- <h2 onclick="javascript: add_helptopic('<?php echo basename($_SERVER['PHP_SELF']);?>');">Edit Help Topic</h2> -->
              
              
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
        <?php  load_addon_by_position('column-left', $addons, $admin, basename($_SERVER['PHP_SELF']), $dont_show); ?>
                </div><!-- /column-left -->
                </div>
            </div><!--end container-->

            <?php include("footer.php"); ?>
        </div> 
