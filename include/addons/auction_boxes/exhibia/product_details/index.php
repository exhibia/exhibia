                                    <div id="payment-information">
                                           <h3><?php echo PRODUCT_DETAILS; ?>:</h3>

                                           <div class="pro_detail">
                                               <div class="statictitle"><?= htmlspecialchars(stripslashes($pname), ENT_QUOTES); ?></div>
                                               <div class="clear">&nbsp;</div>
                                                <div id="pr_long_desc_<?php echo $obj['productID']; ?>" <?php if($_SESSION['admin'] >= 1){ ?> contenteditable="true" <?php } ?>><?= stripslashes($long_desc); ?></div>
                                               
                                            
                                           </div>
                                       </div>


                                       <div id="payment-information2">
                                           <h3><?php echo PAYMENT_INFORMATION; ?>:</h3>
                                           <ul>
                                               <li><strong><?php echo PAYMENT_METHODS; ?>:</strong> &raquo; <?php echo BY_VISA_OR_MASTERCARD_OR_VIA_PAYPAL; ?></li>
                                               <li><strong><?php echo DELIVERY_COST; ?>:</strong> &raquo; <?php echo $Currency . $obj['shippingcharge']; ?></li>
                        <?php if (Sitesetting::isEnableTax() == true) {
 ?>
                                                   <li>
                                                       <strong><?php echo TAX_AMOUNT; ?>:</strong> &raquo; <span id="product_taxamount_<?php echo $obj['auctionID'] ?>">---</span>
                                                       <input type="hidden" id="product_tax1_<?php echo $obj['auctionID']; ?>" value="<?php echo $obj['tax1']; ?>"/>
                                                       <input type="hidden" id="product_tax2_<?php echo $obj['auctionID']; ?>" value="<?php echo $obj['tax2']; ?>"/>
                                                   </li>
<?php } ?>
                                               <li><strong><?php echo RETURE; ?>:</strong> &raquo; <?php echo WITHIN_DAYS_IN_THE_ORIGINAL_PACKAGING; ?></li>
                                               <li><strong><?php echo ANY_QUESTIONS_LEFT; ?></strong> &raquo; <a href="contact.php"><?php echo CONTACT_US; ?></a></li>
                                           </ul>
                                       </div><!-- /payment-information -->
                                       <p><img src="<?php echo $SITE_URL;?>img/icons/credit-cards.gif" alt="" /></p>