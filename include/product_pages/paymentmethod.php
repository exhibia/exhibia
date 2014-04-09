       <div id="main">
            <?
            include("header.php");
            ?>
            <div id="container">
                <?php include("include/topmenu.php"); ?>

		    <div id="column-right">

			  <?php include("include/searchbox.php"); ?>
			  <div id="title-category-content">
			      <?php include("include/categorymenu.php"); ?>
			      <p class="bid-title"><strong><?= $SITE_NM; ?> - Make Payment</strong></p>
			  </div><!-- /title-category-content -->
                    <div id="buybids-box" class="content">
                        <div id="buybidBox">
                           
                           
                           <?php include($BASE_DIR . "/modules/gateways/paymentmethod.php"); ?>
                           
                        
			 </div>    
		    </div>
                      
                   
                    <div id="column-left">
                    <?php include("leftside.php"); ?>
                    <?php include("include/bidpackage.php"); ?>
                                    <img src="img/icons/credit-cards.gif" alt="" />
                                </div><!-- /column-left -->
                            </div>
                        

            <?
                                    include("footer.php");
            ?>
        </div>