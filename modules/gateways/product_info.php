
                                <?php
                                $shipping = getshipping($obj->shipping_id);
                                $taxamount = 0;
                                if (Sitesetting::isEnableTax() == true) {
                                    if ($obj->tax1 != 0) {
                                        $taxamount +=$obj->auc_final_price * $obj->tax1 / 100;
                                    }
                                    if ($obj->tax2 != 0) {
                                        $taxamount +=$obj->auc_final_price * $obj->tax2 / 100;
                                    }
                                }

                                if ($voucherid != "" && $_REQUEST["novoucher"] == "") {
                                    $qryvou = "select * from vouchers where id='" . $voucherid . "'";
                                    $resvou = db_query($qryvou);
                                    $objvou = db_fetch_object($resvou);

                                    $amt1 = $amount - $objvou->bids_amount;
                                    if ($amt1 >= 0) {
                                        $voucheramount = $objvou->bids_amount;
                                    } else {
                                        $voucheramount = $amount;
                                    }
                                }
                                ?>
                                <h2><?php echo $obj->name; ?></h2>


                                <div id="bid-packs">

                                    <p>
<?php echo $obj->short_desc; ?>
                                    </p>
                                    <div style="text-align:center;">
                                        <img src="<?php echo $UploadImagePath; ?>products/<?php echo $obj->picture1; ?>" alt="" width="280" height="250" />
                                    </div>

                                </div>


                                <div id="payment-method" style="text-align:left;">
                                    <?php include($BASE_DIR . "/modules/gateways/price_breakdown_auction.php"); ?>
                                </div>