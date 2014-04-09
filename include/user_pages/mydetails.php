
        <div id="main">

            	<?php if(empty($header)){ include_once($BASE_DIR . '/include/' . $template . '/header.php'); } ?>

            <div id="container">

                <?php if(empty($nav_menu)) { include_once($BASE_DIR . "/include/topmenu.php"); } ?>
	 <div class="tab-area">
                <div id="column-right">

                    <?php include_once($BASE_DIR . "/include/searchbox.php"); ?>

                    <div id="title-category-content">

                        <?php include_once($BASE_DIR . "/include/categorymenu.php"); ?>
                <p class="bid-title"><strong><?=$SITE_NM;?> - <?php echo MY_DETAILS; ?></strong></p>
            </div><!-- /title-category-content -->
            <div class="rounded_corner">	
                <div class="content">
                	<div style="padding-left: 25px;"><h2><?php echo YOUR_DATA; ?>: </h2></div>
                    <br />
                    
                	<div class="detailslist">
                    	
                    	<p>
                        	<strong><?php echo CUSTOMER_ID; ?> :</strong><?php echo $detail['id'];?>
                        </p>
                        
                        <p>
                        	<strong><?php echo USERNAME; ?> :</strong><?=$detail['username'];?>
                        </p>
                        
                        <p>
                        	<strong><?php echo GENDER; ?> :</strong><?=$detail['sex'];?>
                        </p>
                        
                        <p>
                        	<strong><?php echo FIRST_NAME; ?>:</strong><?=$detail['firstname'];?>
                        </p>
                        
                        <p>
                        	<strong><?php echo LAST_NAME; ?> :</strong><?=$detail['lastname'];?>
                        </p>
                        
                        <p>
                        	<strong><?php echo BIRTH_DATE; ?> :</strong><?=arrangedate2($detail['birth_date']);?>
                        </p>
                        
                        <p>
                        	<strong><?php echo EMAIL_ADDRESS; ?> :</strong><?=$detail['email'];?>
                        </p>
                        
                        <p>
                        	<strong><?php echo COUNTRY; ?> :</strong><?=$detail['printable_name'];?>
                        </p>
                        
                        <p>
                        	<?php echo TO_AVOID_ABUSES_WE_DONOT_ALLOW_YOU_TO_EDIT_YOUR_DETAILS_ONCE_REGISTEREDED; ?>
                        </p>
                    </div>
                   
                </div>
            </div><!-- /content -->
        </div><!-- /column-right -->
        <div id="column-left">
            <?php include("leftside.php"); ?>
            <?php include("include/bidpackage.php"); ?>
          
        </div><!-- /column-left -->
        </div>
	</div><!-- /container -->
  
  <?php include("footer.php"); ?> 
