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
                        <p class="bid-title"><em><?php echo PAYMENT_FAILED; ?></em></p>
                    </div><!-- /title-category-content -->

                    <div class="rounded_corner">
                        <div class="content">
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
                        </div><!--end content-->
                    </div>
                </div>
                <div id="column-left">
<?php include("leftside.php"); ?>

                            </div><!-- /column-left -->
                        </div>

            <?
                                include("footer.php");
            ?>
        </div> 
