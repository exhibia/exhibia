
        <div id="main">

            	<?php if(empty($header)){ include_once($BASE_DIR . '/include/' . $template . '/header.php'); } ?>

            <div id="container">

                <?php if(empty($nav_menu)) { include_once($BASE_DIR . "/include/topmenu.php"); } ?>
        	 <div class="tab-area">
                 <div id="column-right">

                    <?php include_once($BASE_DIR . "/include/searchbox.php"); ?>

                    <div id="title-category-content">

                        <?php include_once($BASE_DIR . "/include/categorymenu.php"); ?>

                        <p class="bid-title"><em><?php echo AUCTIONS_YOU_ARE_BIDDING_ON; ?></em></p>

                    </div><!-- /title-category-content -->

                    <div id="mybids-box" class="content">
                   
			      <?php
                                include($BASE_DIR . "/include/addons/games-client/index.php");
                              ?>
                            

                        </div>

                       
                                     


                                    </div><!-- /content --> 


                                </div><!-- /column-right -->



                                <div id="column-left">

					    <?php include("leftside.php"); ?>

                  

                                   

                                    </div><!-- /column-left -->
				</div>
				test
			  </div><!-- /container -->
			   </div>
                               </div>
                        </div>
                       </div>
                      </div>
                      </div>
                      </div>
                      </div>
                      </div>
                      </div>
                      </div>
                    <div style="clear:both;"></div>
                 <?php include($BASE_DIR . '/include/' . $template . '/footer.php'); ?>
                                                                    

      
 
