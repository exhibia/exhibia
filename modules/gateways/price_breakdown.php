					<?php
					if($template != 'quibids-1.0' & $template != 'quibids-1.5'){
					?>
					<h2><?php echo PAYMENT_INFORMATION; ?></h2>
					<?php } ?>
					<table width="480">
                                                <tbody>
                                                  <tr valign="top">
                                                        <td align="left" colspan="5"><?php echo YOUR_POSTAL_ADDRESS; ?>:</td>
                                                   </tr>
                                                   <tr valign="top">
                                                        <td align="left" colspan="5" width="480">
                                                           
								  <?php echo $user->delivery_addressline1; ?><br/>
								  <?php echo $user->delivery_addressline2; ?><br/>
								  <?php echo $user->delivery_city . ", " . $user->delivery_state . " " . $user->delivery_country . " " . $user->delivery_postcode; ?>
								<br/>
								<small>Please verify your shipping address before proceeding</small>
							    
							</td>
						    </tr>

                                                    <tr>
                                                        <td align="left"><strong><?php echo PRODUCT_NAME; ?></strong></td>
                                                        <td width="60" align="left"><strong><?php echo PRICE; ?></strong></td>
                                                        <td width="100" align="right"><strong><?php include($BASE_DIR . "/modules/gateways/taxes.php"); ?></strong></td>
                                                        <td width="80" align="right"><strong><?php echo SHIPPING ?></strong></td>
                                                        <td width="60" align="right"><strong><?php echo BUY_PRICE ?></strong></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="5"><hr style="color: silver;"/></td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left"><?php echo $pname; ?></td>
                                                        <td align="left"><?php echo $Currency. number_format($buynowprice['start_price'],2);?></td>
                                                        <td align="right"><?php echo $Currency . number_format($taxamount, 2); ?></td>
                                                        <td align="right"><?php echo $Currency . number_format($buynowprice['shipping'], 2); ?></td>
                                                        
                                                        <td align="right"><span id="info_cost"><?php echo $Currency . number_format($buynowprice['total'], 2); ?></span></td>
                                                    </tr>
                                                    

                                                    <tr>
                                                        <td colspan="5" align="right">
                                                            <strong><u><?php echo TOTAL_PACKAGE_COST; ?>:</u> <span id="info_cost"><?php echo $Currency . number_format($buynowprice['total'], 2); ?></span></strong>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>