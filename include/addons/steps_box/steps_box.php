<!-- ============= Steps =============  -->
<div class="clear"></div>
                    <div id="steps">
                    <?php
                    if(in_array('steps_bid', $addons) & $template != 'pas' & $template != 'falconbids'){
                    ?>
                        <div id="bid-win">
                            <div class="bid-win-text">
                                <span><?php echo BID_NOW; ?></span><br/>
                                <div><?php echo EXCITING_PRODUCTS; ?></div>
                            </div>                           

                            <a href="registration.php" id="register_btn">
                                <?php echo REGISTER; ?>
                            </a>
                        </div>
                  <?php } ?>
                        <ul>
                            <li id="step1">
			      
			      <p id="step1-p1"><?php echo STEP_ONE;?></p>
                                <p id="step1-p2"><?php echo BUY_BIDS;?></p>
                                <span id="step1-span"><?php echo BID_PRICE;?></span>
                            </li>
                            <li id="step2">
			      <p id="step2-p1"><?php echo STEP_TWO;?></p>
                                <p id="step2-p2"><?php echo CHOOSE_PRODUCTS;?></p>
                                <span id="step2-span"><?php echo PICK_A_PRODUCT;?></span>
                            </li>
                            <li id="step3">
			      <p id="step3-p1"><?php echo STEP_THREE;?></p>
                                <p id="step3-p2"><?php echo BID_AND_WIN;?></p>
                                <span id="step3-span"><?php echo IF_LAST;?></span>
                            </li>
                        </ul>
                    </div>
                    <!-- ============= End Steps =============  -->