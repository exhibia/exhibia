<!--[if !IE]>start section<![endif]-->
<div class="section">
    <!--[if !IE]>start title wrapper<![endif]-->
    <div class="title_wrapper">
        <h2>Main Menu</h2>
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
                            <ul class="sidebar_menu">
                                <?php
                                include_once 'headlinks.txt.php';

                                $HeaderLinksSize = sizeof($HeadLinksArray);
                                $submenufile='';
                                for($i=0;$i<$HeaderLinksSize;$i++) {

                                    $LinkTitle = $HeadLinksArray[$i][0];
                                    $HREF = $HeadLinksArray[$i][1];
                                    ?>
                                    <?php if($active==$LinkTitle) {
                                        $submenufile=$HeadLinksArray[$i][3];
                                    }
                                    
                                     if(!empty($_SESSION['user_level']) & is_numeric($_SESSION['user_level'])){
                                 
                                     if(db_num_rows(db_query("select * from user_levels where allowed_pages like '%" . getcwd() . "/$HREF%' and id = '$_SESSION[user_level]'")) >= 1){
                                    
                                        ?>
					<li class="<?php echo ($i+1==$HeaderLinksSize)?'last':''; ?>"><a href="<?php echo $HREF; ?>" class="<?php echo $active==$LinkTitle?'selected':''; ?>"><?php echo $LinkTitle; ?></a></li>
                                        <?php 
                                        
                                        }else{
                                        ?>
                                        <li class="unauthorised2"><a target="<?php echo $target; ?>" href="#" class="unauthorised2"><?php echo $linkTitle; ?></a></li>
                                        
                                        <?php
                                        
                                        }
					    }else{
                                    ?>
                                    
                                    
                                    
                                <li class="<?php echo ($i+1==$HeaderLinksSize)?'last':''; ?>"><a href="<?php echo $HREF; ?>" class="<?php echo $active==$LinkTitle?'selected':''; ?>"><?php echo $LinkTitle; ?></a></li>
    
                                    <?php  
                                    
					}
                                    
                                    } 
                                    
                                    ?>
                            </ul>
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

<!--[if !IE]>start quick info<![endif]-->
<!--
<div class="quick_info">
    <div class="quick_info_top">
        <h2>Quick info</h2>
    </div>
    <div class="quick_info_content">
        <dl>
            <dt>12 products</dt>
            <dd>avaiting approval</dd>
        </dl>
        <dl>
            <dt>228 sales</dt>
            <dd>in the last 24 hours</dd>
        </dl>
        <dl>
            <dt>18 users</dt>
            <dd>currently online</dd>
        </dl>
        <dl>
            <dt>15.2%</dt>
            <dd>increase in traffic this month</dd>
        </dl>
    </div>
    <span class="quick_info_bottom"></span>
</div>
-->
<!--[if !IE]>end quick info<![endif]-->