<?php



require_once $BASE_DIR . '/include/addons/bingo/bingo.txt.php';


if(!empty($_REQUEST['page'])){

require_once $BASE_DIR . '/include/addons/bingo/backendadmin/' . $_REQUEST['page'];

 }else{ ?>
		  <!--[if !IE]>start section content<![endif]-->
                            <div class="section_content">
                                <!--[if !IE]>start section content top<![endif]-->
                                <div class="sct">
                                    <div class="sct_left">
                                        <div class="sct_right">
                                            <div class="sct_left">
                                                <div class="sct_right">
                                                    <!--[if !IE]>start dashboard menu<![endif]-->
                                                    <div class="dashboard_menu_wrapper">
                                                        <ul class="dashboard_menu">
                                                            <?php
                                                         //   echo $BASE_DIR . '/include/addons/bingo/bingo.txt.php';
                                                            
                                                            $ChildLinksSize = sizeof($ChildLinksArray);
                                                            for ( $j=0; $j<$ChildLinksSize; $j++ ) {
                                                                $subTitle=$ChildLinksArray[$j][0];
                                                                $subHref=$ChildLinksArray[$j][1];
                                                                $subclass=$ChildLinksArray[$j][3];
                                                                ?>
                                                            <li><a href="<?php echo $subHref; ?>" class="<?php echo $subclass; ?>"><span><?php echo $subTitle; ?></span></a></li>
                                                                <?php } /*end sub for*/?>
                                                        </ul>
                                                    </div>
                                                    <!--[if !IE]>end dashboard menu<![endif]-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--[if !IE]>end section content top<![endif]-->
                                <!--[if !IE]>start section content bottom<![endif]-->
                                <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>
                                <!--[if !IE]>end section content bottom<![endif]-->

                            </div>
                            <!--[if !IE]>end section content<![endif]-->
  <?php } 
  
  //}
  
  ?>
        
                 