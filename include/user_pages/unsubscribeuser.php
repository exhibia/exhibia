<div id="main">
  <?php include("header.php"); ?>
  	 <div id="container">
        <?php include("include/topmenu.php"); ?>
        <div class="tab-area">
        <div id="column-right">
			<?php include("include/searchbox.php"); ?>
            <div id="title-category-content">
                <?php include("include/categorymenu.php"); ?>
                <p class="bid-title"><strong><?php echo $SITE_NM;?> - <?php echo CLOSE_ACCOUNT; ?></strong></p>
            </div><!-- /title-category-content -->
            <div class="rounded_corner">	
                <div class="content">
                    <p><h2><?php echo CLOSE_YOUR; ?> <?php echo $SITE_NM;?> <?php echo ACCOUNT; ?></h2></p>
                    
                    <br />

                    <p><strong style="color:red;font-size:larger;"><?php echo IMPORTANT; ?>:</strong> <?php echo IF_YOU_CLOSE_YOUR_ACCOUNT_YOU_WONT_BE_ABLE_TO; ?> <?php echo $SITE_NM;?> <?php echo USING_THIS_EMAIL_ADDRESS_FOR_TWO_MONTHS; ?>
                    </p>
                    
                    <br />

                    <form name="unsubscribe" action="" method="post" onsubmit="return check();">
    
                    <p><input type="checkbox" name="unsubscribecheck" value="unsubscribe" class="register-box-row-checkbox" />&nbsp;&nbsp;<?php echo I_WANT_TO_CLOSE_MY; ?> <?php echo $SITE_NM;?> <?php echo ACCOUNT; ?>
                    </p>
    
    				<br />
                    
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;
                    <button class="button77" type="submit" value="Close" name="submitimage"><?php echo CLOSE; ?></button>
                   
                    </p>    
                    <input type="hidden" name="submit" value="submit" />
                    </form>
                </div>
            </div><!-- /content -->
        </div><!-- /column-right -->
        <div id="column-left">
            <?php include("leftside.php"); ?>
          
       
        </div><!-- /column-left -->
        </div>
	</div><!-- /container -->
  
  <?php include("footer.php"); ?>
 
