
 <?php if(Sitesetting::isEnableAvatar()){ $avatar_enabled = 'yes'; } ?>
 <?php if(!empty($_SESSION['userid'])){ ?>
 
<div id="left-nav" class="left-nav">
 
       
       
                <strong><?php echo AUCTIONS; ?></strong>
                <?php echo get_menu('user_menu1'); ?>
            
                <strong><?php echo ACCOUNT; ?></strong>
                <?php echo get_menu('user_menu2'); ?>
            
                <strong><?php echo DETAIL; ?></strong>
                <?php echo get_menu('user_menu3'); ?>
            
                <strong><?php echo COUPON; ?></strong>
                <?php echo get_menu('user_menu4'); ?>
            
        
        <?php
        
       
     
      
      
                    foreach($addons as $key => $value){
                    
		      if(file_exists("include/addons/$value/user_links.php")){
			include_once("include/addons/$value/user_links.php");
		      
		      }
                    }
        ?>
      
</div><!-- /navigationBox --> 
<?php  

}
?>