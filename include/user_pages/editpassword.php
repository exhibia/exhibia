<div id="main">
  <?php include("header.php"); ?>
  	 <div id="container">
        <?php include("include/topmenu.php"); ?>
        <div class="tab-area">
        <div id="column-right">
			<?php include("include/searchbox.php"); ?>
            <div id="title-category-content">
                <?php include("include/categorymenu.php"); ?>
                <p class="bid-title"><strong><?=$SITE_NM;?> - <?php echo CHANGE_PASSWORD; ?></strong></p>
            </div><!-- /title-category-content -->
            <div class="rounded_corner">	
                <div class="content" >
                    <form name="newpassword" method="post" action="" onsubmit="return check()">                    
                        <?php if($msg=="1"){ ?>                            
                        	<br />
                            <p class="greenfont" style="margin-left: 40px;"><?php echo YOUR_PASSWORD_HAS_BEEN_CHANGED; ?></p>
                        <?php } ?>
                        <br />
                        <p><h2><?php echo CHANGE_YOUR_PASSWORD;?></h2></p>
                        <br />
                        <p><?php echo PLEASE_ENTER_YOUR_NEW_PASSWORD; ?></p>
                        <p>
                        <input type="password" name="newpass" size="30" maxlength="50" class="logintextboxclas" />
                        </p>
                        <br />
                        <p><?php echo PLEASE_RETYPE_YOUR_NEW_PASSWORD; ?></p>
                        <p>
                        	<input type="password" name="cnfnewpass" size="30" maxlength="50" class="logintextboxclas" />
                        </p>
                        <br />
                        <p style="padding-left: 25px;">
                        	<button class="button77" type="submit" value="image" name="image"><?php echo SUBMIT; ?></button>
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
</div> <!--end main--> 
