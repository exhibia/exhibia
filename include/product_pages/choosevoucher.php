  <div id="main">
            <?php
            include("header.php");
            ?>
            <div id="container">
                <?php include("include/topmenu.php"); ?>

                <div id="column-right">

                    <?php include("include/searchbox.php"); ?>
                    <div id="title-category-content">
                        <?php include("include/categorymenu.php"); ?>
                        <p class="bid-title"><em><?=$SITE_NM;?> - <?php echo MAKE_PAYMENT; ?></em></p>
                    </div><!-- /title-category-content -->

                    <div class="rounded_corner">
                        <div class="content">
                            <form name="f1" action="paymentmethod.php" method="post" onsubmit="return Check();">
                                <div style="margin-left: 20px;">
                                    <p>
                                        <span class="normal_text"><b><?php echo PLEASE_SELECT_VOUCHER; ?> : </b></span>
                                        <select name="voucher" id="voucher" onchange="TotalCountAmount(this.value)">
                                            <option value="none"><?php echo SELECT_ONE; ?></option>
                                            <?php
                                            while($obj = db_fetch_object($resvou)) {
                                                ?>
                                            <option value="<?=$obj->voucherid;?>,<?=$obj->useruseid;?>,<?=$obj->bids_amount;?>,2"><?=$obj->voucher_title;?></option>
                                                <?php } ?>
                                        </select>
                                    </p>
                                    <br /><br />
                                    <p>
                                        <input type="checkbox" name="novoucher" value="novoucher" id="chk_novoucher" onclick="HideVoucher();" />
                                        <label for="chk_novoucher"><?php echo IF_YOU_DONT_WANT_TO_USE_YOUR_VOUCHER; ?></label>
                                    </p>
                                    <br /><br /><br /><br />

                                    <h2><?php echo AUCTION_DETAILS; ?>:</h2>
                                    <br />

                                    <div>
                                        <div style="float:left;">
                                            <b><?=stripslashes($objauc->name);?></b>
                                        </div>
                                        <div style="float:right;width:100px;padding-right:20px;text-align:right">
                                            &nbsp;<?=$Currency;?>&nbsp;<span id="auctionamount"><?=number_format($expwin[0],2) ?></span>
                                        </div>
                                        <div id="vouchercontent" style="display:none">
                                            <div style="float:left;"><b><?php echo VOUCHER_AMOUNT; ?> (Maximum <?=$Currency;?>	<span id="dispvoucheramount"></span>)</b></div>
                                            <div style="float:right;width:100px;padding-right:20px; text-align:right">-&nbsp;<?=$Currency;?>&nbsp;<span id="amountvoucher"><?=number_format($obj->bids_amount,2) ?></span></div>
                                        </div>
                                    </div>
                                    <div class="clear">&nbsp;</div>
                                    <div class="hline"></div>
                                    <div>
                                        <div style="float:left;" class="normal_text"><strong><?php echo SUBTOTAL; ?></strong></div>
                                        <div style="float: right;width:100px;padding-right:20px;text-align:right" class="normal_text">&nbsp;<?=$Currency;?>&nbsp;<span id="sub_final_amount"><?=number_format($expwin[0],2) ?></span></div>
                                    </div>
                                    <div class="clear">&nbsp;</div>
                                    <div>
                                        <div  class="normal_text" style="float:left;"><b><?php echo SHIPPING_CHARGE; ?></b></div>
                                        <div style="float:right; width:100px;padding-right:20px;text-align:right;">+&nbsp;<?=$Currency;?>&nbsp;<span id="shippingamount"><?=number_format($objauc->shippingcharge,2) ?></span></div>
                                    </div>
                                    <div class="clear">&nbsp;</div>
                                    <div class="hline"></div>
                                    <div>
                                        <div class="normal_text" style="float:left;"><b><?php echo TOTAL_PAYMENT; ?></b></div>
                                        <div style="float:right; width:100px;padding-right:20px; text-align:right">&nbsp;<?=$Currency;?>&nbsp;<span id="final_amount"><?=number_format($finalamount,2) ?></span></div>
                                        <input type="hidden" value="<?=$winid;?>" name="winid" />
                                    </div>
                                    <div style="margin-left: 120px; padding-top: 35px;">
                                        <button class="button140"><?php echo MAKE_PAYMENT; ?></button>
                                    </div>
                                </div>
                            </form>
                        </div><!--end content-->
                    </div>
                </div>
                <div id="column-left">
                    <?php include("leftside.php"); ?>
                    
                </div><!-- /column-left -->
            </div>

            <?php
            include("footer.php");
            ?>
        </div> 
