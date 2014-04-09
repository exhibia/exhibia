<?php include_once('common/sitesetting.php'); ?>
 <?php if(Sitesetting::isEnableAvatar()){ $avatar_enabled = 'yes'; } ?>
 <?php if(!empty($_SESSION['userid'])){ ?>
 
 <?php if(file_exists($BASE_DIR . "/include/addons/user_menu/$template/user_menu.php")){
 
 include($BASE_DIR . "/include/addons/user_menu/$template/user_menu.php");
 
 }else{
 ?>
<div id="navigationBox" class="box">
    <h3><?php echo NAVIGATION; ?></h3>
    <div class="box-content">
       
       <ul>
            <li>
                <h5><?php echo AUCTIONS; ?></h5>
                <?php echo get_menu('user_menu1'); ?>
            </li>
            <li>
                <h5><?php echo ACCOUNT; ?></h5>
                <?php echo get_menu('user_menu2'); ?>
            </li>
            <li>
                <h5><?php echo DETAIL; ?></h5>
                <?php echo get_menu('user_menu3'); ?>
            </li>
            <li>
                <h5><?php echo COUPON; ?></h5>
                <?php echo get_menu('user_menu4'); ?>
            </li>
        
        <?php
        
       
     
      
      
                    foreach($addons as $key => $value){
                    
		      if(file_exists("include/addons/$value/user_links.php")){
			include_once("include/addons/$value/user_links.php");
		      
		      }
                    }
        ?>
        </ul>
    </div><!-- /box-content -->
</div><!-- /navigationBox --> 
<?php } 

}
?>