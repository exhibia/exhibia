
        
        <?php if($template != 'quibids-2.0'){ ?>
        <div id="main">
           
            	 <?php include_once('header.php'); ?>
	<?php }else{ ?>
        <div id="main">
            	 <?php include_once('include/' . $template . '/header.php'); ?>
		

	
	<?php } ?>
	
		  <div id="container" class="wrapper">
		      
		      <?php

			    load_addon_by_position('container', $addons, $admin);
			?>

			      
		  </div>
		 
		       
        </div>
            
        <div style="display:none;">
            <?php
            $avatardb = new Avatar(null);
            $avatarresult = $avatardb->selectAll();
            while ($avatar = db_fetch_object($avatarresult)) {
            ?>
                <img alt="" src="uploads/avatars/<?php echo $avatar->avatar; ?>"/>
            <?php } ?>

	 </div>

       