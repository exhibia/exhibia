
        <div id="pagewidth">
             <?php include("$BASE_DIR/include/$template/header.php"); ?>
            <div id="wrapper" class="clearfix">
                <?php //include("include/topmenu.php"); ?>

                <div id="maincol">

                    <?php //include("include/searchbox.php"); ?>
                    <div id="live-auctions">
                        <?php //include("include/categorymenu.php"); ?>
                        <p class="live-auctions-head"><em><?php echo PAYMENT_FAILED; ?></em></p>
                    </div><!-- /title-category-content -->

                  
                       <div style="min-height:300px;padding:20px;">
                            <p class="normal_text" align="center">
                                <?php if (isset($_GET['msg'])) {
                                ?>
                                <?php echo $_GET['msg']; ?>
                                <?php
                                } else {
                                    if ($payfor == PAYFOR_BUYBID) {
                                ?>
                                <?php echo SORRY_YOUR_PAYMENT_PROCESS_WAS_NOT_SUCCESFULL; ?><br /><a href="buybids.php" class="darkblue-12-link"><strong><?php echo CLICK_HERE; ?></strong></a> <?php echo TO_GO_BACK; ?>.

                                <?php } else if ($payfor == PAYFOR_BUYITNOW) {
                                ?>

                                <?php echo SORRY_YOUR_PAYMENT_PROCESS_WAS_NOT_SUCCESFULL; ?><br /><a href="index.php" class="darkblue-12-link"><strong><?php echo CLICK_HERE; ?></strong></a> <?php echo TO_GO_BACK; ?>.

                                <?php } else if ($payfor == PAYFOR_REDEMPTION) {
 ?>
                                <?php echo SORRY_YOUR_PAYMENT_PROCESS_WAS_NOT_SUCCESFULL; ?><br /><a href="redemption.php" class="darkblue-12-link"><strong><?php echo CLICK_HERE; ?></strong></a> <?php echo TO_GO_BACK; ?>
                                
                                <?php } else if ($payfor == PAYFOR_WONAUCTION) {
                              
 ?>
                                <?php echo SORRY_YOUR_PAYMENT_PROCESS_WAS_NOT_SUCCESFULL; ?><br /><a href="wonauctions.php" class="darkblue-12-link"><strong><?php echo CLICK_HERE; ?></strong></a> <?php echo TO_GO_BACK; ?>.

                                <?php } else {
                                ?>
                                <?php echo SORRY_YOUR_PAYMENT_PROCESS_WAS_NOT_SUCCESFULL; ?><br />.
<?php } ?>
<?php } ?>
                            </p>
                       <!--end content-->
                    </div>
                </div>
                <div id="column-left">
<?php //include("leftside.php"); ?>
<?php //include("include/bidpackage.php"); ?>
                               <!---<img src="img/icons/credit-cards.gif" alt="" /> --->
                            </div><!-- /column-left -->
                        </div>

             <?php include("$BASE_DIR/include/$template/footer.php"); ?>
        </div>
    