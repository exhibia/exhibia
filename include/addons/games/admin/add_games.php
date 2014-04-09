  <?php $active = 'Games'; ?>
            <div id="content">
                <!--[if !IE]>start page<![endif]-->
                <div id="page">
                    <div class="inner">
                        <!--[if !IE]>start section<![endif]-->
                        <div class="section">
                        
                        <?php if(empty($_REQUEST['page'])){
                        ?>
                            <!--[if !IE]>start title wrapper<![endif]-->
                            <div class="title_wrapper">
                                <h2><?php echo $active; ?></h2>
                                <span class="title_wrapper_left"></span>
                                <span class="title_wrapper_right"></span>
                            </div>
                            <!--[if !IE]>end title wrapper<![endif]-->
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
                                                            include_once $BASE_DIR . '/include/addons/games/admin/games.txt.php';
                                                            $ChildLinksSize = sizeof($ChildLinksArray);
                                                            for ( $j=0; $j<$ChildLinksSize; $j++ ) {
                                                                $subTitle=$ChildLinksArray[$j][0];
                                                                $subHref=$ChildLinksArray[$j][1];
                                                                $subclass=$ChildLinksArray[$j][3];
                                                                $target='';
                                                                if(isset($ChildLinksArray[$j][5])){
                                                                    $target=$ChildLinksArray[$j][5];
                                                                }
                                                                ?>
                                                            <li><a target="<?php echo $target; ?>" href="<?php echo $subHref; ?>" class="<?php echo $subclass; ?>"><span><?php echo $subTitle; ?></span></a></li>
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
                        </div>
                        <!--[if !IE]>end section<![endif]-->

                           

                    </div>
                </div>
                <!--[if !IE]>end page<![endif]-->
                <!--[if !IE]>start sidebar<![endif]-->
                <div id="sidebar">
                    <div class="inner">
                   
                        <?php include 'include/leftside.php' ?>
                    </div>
                </div>
                <!--[if !IE]>end sidebar<![endif]-->

            </div>
            <!--[if !IE]>end content<![endif]-->

        </div>
        <!--[if !IE]>end wrapper<![endif]-->

        <!--[if !IE]>start footer<![endif]-->
        <div id="footer">
            <div id="footer_inner">
                <?php include 'include/footer.php'; ?>
            </div>
        </div>
        <!--[if !IE]>end footer<![endif]-->

            </div>
            <!--[if !IE]>end content<![endif]-->

             <?php }else{ 
                            
                            include($BASE_DIR . '/include/addons/games/' . $_REQUEST['page']); 
                            
                            }
                            ?>
     
