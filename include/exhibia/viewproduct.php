<style>
.single #column-left {
  float: left!important;
  width: 990px;
}


.single #column-right {
  float: right;
  margin-left: 10px !important;
  width: 280px;
}
</style>
        
        <?php if($template != 'quibids-2.0'){ ?>
        <div id="main">
           
            	 <?php include_once('header.php'); ?>
	<?php }else{ ?>
        <div id="main">
            	 <?php include_once('include/' . $template . '/header.php'); ?>
		

	
	<?php } ?>
	
		  <div id="container" class="wrapper">
		     <div id="column-left">
		      <?php include("$BASE_DIR/include/addons/auction_boxes/$template/viewproduct.php"); ?>
		     </div>
		     <div id="column-right">
		     <?php include("$BASE_DIR/include/$template/column-right.php"); ?>
		     </div>
			      
		  </div>
		 
		<?php include("$BASE_DIR/include/$template/footer.php"); ?>       
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

       