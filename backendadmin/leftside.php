<?php
//print_r($HeadLinksArray);
if(strlen($submenufile)<=0) {
    include_once 'design.txt.php';
    $HeaderLinksSize = sizeof($HeadLinksArray);
    $submenufile='';
    for($i=0;$i<$HeaderLinksSize;$i++) {
        if($active==$LinkTitle) {
            $submenufile=$HeadLinksArray[10][3];
            break;
        }
    }
}

    include_once 'design.txt.php';
$currentPage = $_SERVER["REQUEST_URI"];
$MainLinksSize = sizeof($MainLinksArray);
for($i=0;$i<$MainLinksSize;$i++) {
    ?>
<!--[if !IE]>start section<![endif]-->
<div class="section">
    <!--[if !IE]>start title wrapper<![endif]-->
    <div class="title_wrapper">
        <h4><?php echo $MainLinksArray[$i][0]; ?></h4>
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
                                    $ChildLinksSize = sizeof($ChildLinksArray);
                                    $arrSubMenu=array();

                                    for($j=0;$j<$ChildLinksSize;$j++) {
                                        if($ChildLinksArray[$j][2]==$i) {
                                            array_push($arrSubMenu, $ChildLinksArray[$j]);
                                        }
                                    }
                                    $subSize=count($arrSubMenu);
                                    for($j=0;$j<$subSize;$j++) {
                                        $linkTitle=$arrSubMenu[$j][0];
                                        $linkHref=$arrSubMenu[$j][1];
                                        $target=isset($arrSubMenu[$j][5])?$arrSubMenu[$j][5]:'';
                                        if(!empty($_SESSION['user_level']) & db_num_rows(db_query("select * from user_levels where allowed_pages like '%" . getcwd() . "/$linkHref%'")) >= 1){
                                        ?>
                                <li class="<?php echo $j+1==$subSize?'last':''; ?>"><a target="<?php echo $target; ?>" href="<?php echo $linkHref; ?>" class="<?php echo strpos($currentPage,$linkHref)!=false?'selected':''; ?>"><?php echo $linkTitle; ?></a></li>
                                        <?php 
					    }else{
					    
					    
					        ?>
                                <li class="<?php echo $j+1==$subSize?'last':''; ?>"><a target="<?php echo $target; ?>" href="<?php echo $linkHref; ?>" class="<?php echo strpos($currentPage,$linkHref)!=false?'selected':''; ?>"><?php echo $linkTitle; ?></a></li>
                                        <?php 
					    
					    
					    
					    
					    }
                                        
                                        }?>
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
    <?php } ?>

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
