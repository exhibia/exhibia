				    <h2><?php echo PAYMENT_INFORMATION; ?></h2>

                                    <table width="430">
                                        <tbody>
                                            <tr>
                                                <td align="left"><strong><?php echo PRODUCT; ?></strong></td>
                                                <td width="130" align="right"><strong><?php echo COUNT; ?></strong></td>
                                                <td width="130" align="right"><strong><?php echo PRICE; ?></strong></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"><hr style="color: silver;"/></td>
                                            </tr>
                                            <tr>
                                                <td align="left"><?php echo $obj->name; ?></td>
                                                <td width="130" align="right">1</td>
                                                <td align="right"><?php echo $Currency; ?><?php echo number_format($obj->auc_final_price, 2); ?></td>
                                            </tr>
                                            <tr>
                                                <?php include($BASE_DIR . "/modules/gateways/taxes.php"); ?>
                                            </tr>
<?php if ($_REQUEST["novoucher"] == "") { ?>
                                            <tr>
                                                <td align="left"><?php echo VOUCHER_AMOUNT; ?></td>
                                                <td width="130" align="right">&nbsp;</td>
                                                <td align="right">-<?php echo $Currency . number_format($voucheramount, 2); ?></td>
                                            </tr>
<?php } ?>
                                            <tr>
                                                <td align="left"><?php echo SHIPPING_CHARGE; ?></td>
                                                <td width="130" align="right">&nbsp;</td>
                                                <td align="right"><?php echo $Currency . number_format($shipping, 2); ?></td>
                                            </tr>
                                            <tr>
                                                <td id="coupon_title"></td>
                                                <td id="coupon_bids" align="center"></td>
                                                <td id="coupon_cost" align="right"></td>
                                            </tr>
                                            <tr>
                                                <td><br/></td>
                                            </tr>

                                            <tr>
                                                <td colspan="4" align="right">
                                                    <strong><u><?php echo TOTAL_PACKAGE_COST; ?>:</u> <span id="info_cost"><?php echo $Currency; ?><?php echo number_format($obj->auc_final_price + $taxamount + $shipping - $voucheramount, 2); ?></span></strong>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
