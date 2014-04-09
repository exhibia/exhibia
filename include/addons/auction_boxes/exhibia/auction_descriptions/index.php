
                            <ul class="nav-button">
                        <?php if ($obj['openauction'] == 1) {
                        ?>
                            <li>
                                <a href="" onmouseover="javascript:showhide_auctype(5,'over');" onmouseout="javascript:showhide_auctype(5,'out');">
                                    <img src="<?php echo $SITE_URL;?>img/icons/open.gif" alt="" />
                                </a>
                            </li>
                        <?php } ?>

                        <?php if ($obj['offauction'] == 1) {
                        ?>
                            <li>
                                <a href="" onmouseover="javascript:showhide_auctype(2,'over');" onmouseout="javascript:showhide_auctype(2,'out');">
                                    <img src="<?php echo $SITE_URL;?>img/icons/off.png" alt="" />
                                </a>
                            </li>
                        <?php } ?>

                        <?php if ($obj['fixedpriceauction'] == 1) {
                        ?>
                            <li>
                                <a href=""  onmouseover="javascript:showhide_auctype(1,'over');" onmouseout="javascript:showhide_auctype(1,'out');">
                                    <img src="<?php echo $SITE_URL;?>img/icons/fixedauction.png" alt="" />
                                </a>
                            </li>
                        <?php } ?>

                        <?php if ($obj['pennyauction'] == 1) {
                        ?>
                            <li>
                                <a href="" onmouseover="javascript:showhide_auctype(3,'over');" onmouseout="javascript:showhide_auctype(3,'out');">
                                    <img src="<?php echo $SITE_URL;?>img/icons/cent.png" alt="" />
                                </a>
                            </li>
                        <?php } ?>

                        <?php if ($obj['nightauction'] == 1) {
                        ?>
                            <li>
                                <a href="" onmouseover="javascript:showhide_auctype(4,'over');" onmouseout="javascript:showhide_auctype(4,'out');">
                                    <img src="<?php echo $SITE_URL;?>img/icons/night.png" alt="" />
                                </a>
                            </li>
                        <?php } ?>

                        <?php if ($obj['nailbiterauction'] == 1) {
                        ?>
                            <li>
                                <a href="" onmouseover="javascript:showhide_auctype(6,'over');" onmouseout="javascript:showhide_auctype(6,'out');">
                                    <img src="<?php echo $SITE_URL;?>img/icons/nailbiter.gif" alt="" />
                                </a>
                            </li>
                        <?php } ?>

                        <?php if ($obj['uniqueauction'] == 1) {
                        ?>
                            <li>
                                <a href="" onmouseover="javascript:showhide_auctype(7,'over');" onmouseout="javascript:showhide_auctype(7,'out');">
                                    <img src="<?php echo $SITE_URL;?>img/icons/revealauction.png" alt="" />
                                </a>
                            </li>
                        <?php } ?>

                        <?php if ($obj['reverseauction'] == 1) {
                        ?>
                            <li>
                                <a href="" onmouseover="javascript:showhide_auctype(8,'over');" onmouseout="javascript:showhide_auctype(8,'out');">
                                    <img src="<?php echo $SITE_URL;?>img/icons/reverseauction.png" alt="" />
                                </a>
                            </li>
                        <?php } ?>

                        <?php if ($obj['halfbackauction'] == 1) {
                        ?>
                            <li>
                                <a href="" onmouseover="javascript:showhide_auctype(9,'over');" onmouseout="javascript:showhide_auctype(9,'out');">
    <!--                                    <img src="<?php echo $SITE_URL;?>img/icons/reverseauction.png" alt="" />-->
                                </a>
                            </li>
                        <?php } ?>

                        <?php if ($obj['use_free'] == 1) {
                        ?>
                            <li>
                                <a href="" onmouseover="javascript:showhide_auctype(10,'over');" onmouseout="javascript:showhide_auctype(10,'out');">
                                    <img src="<?php echo $SITE_URL;?>img/icons/freepoints.png" alt="" />
                                </a>
                            </li>
                        <?php } ?>

                        <?php if ($obj['seatauction'] == 1) {
                        ?>
                            <li>
                                <a href="" onmouseover="javascript:showhide_auctype(11,'over');" onmouseout="javascript:showhide_auctype(11,'out');">
                                    <img src="<?php echo $SITE_URL;?>img/icons/seatedlauction.png" alt="" />
                                </a>
                            </li>
                        <?php } ?>

                        <?php if ($obj['lockauction'] == 1) {
                        ?>
                            <li>
                                <a href="" onmouseover="javascript:showhide_auctype(12,'over');" onmouseout="javascript:showhide_auctype(12,'out');">
                                    <img src="<?php echo $SITE_URL;?>img/icons/locked.jpg" alt="" />
                                </a>
                            </li>
                        <?php } ?>

                        <!--
                        <li><a href=""><img src="<?php echo $SITE_URL;?>img/icons/ico-2.gif" alt="" /></a></li>
                        <li><a href=""><img src="<?php echo $SITE_URL;?>img/icons/off.gif" alt="" /></a></li>
                        -->
                    </ul>

                    <div id="auction_type1" style="display:none;" class="auctiontype_panel">
                        <div class="auctiontype-detail-body auction-image2">
                            <div style="color:#000000; font-weight:bold; text-align:center; font-size:1.3em;"><?php echo FIXED_PRICE_AUCTION; ?></div>
                            <div style="text-align:center; padding:5px;"><?php echo IF_YOU_WIN_A_FIX_PRICE_AUCTION; ?></div>

                        </div>
                    </div>

                    <div id="auction_type2" style="display: none;" class="auctiontype_panel">

                        <div class="auctiontype-detail-body auction-image2">
                            <div style="color:#000000; font-weight:bold; text-align:center; font-size:1.3em;"><?php echo OFF_100; ?></div>
                            <div style="text-align:center; padding:5px;"><?php echo WHERE_AN_AUCTION_IS_MARKED_100OFF; ?></div>

                        </div>
                    </div>

                    <div id="auction_type3" style="display:none;" class="auctiontype_panel">
                        <div class="auctiontype-detail-body auction-image2">
                            <div style="color:#000000; font-weight:bold; text-align:center; font-size:1.3em;"><?php echo ONE_CENT_AUCTION; ?></div>

                            <div style="text-align:center; padding:5px;"><?php echo WITH_EVERY_BID_THE_PRICE_IS_RAISE; ?></div>

                        </div>
                    </div>

                    <div id="auction_type4" style="display:none;" class="auctiontype_panel">
                        <div class="auctiontype-detail-body auction-image2">
                            <div style="color:#000000; font-weight:bold; text-align:center; font-size:1.3em;"><?php echo NIGHT_AUCTION; ?></div>
                            <div style="text-align:center; padding:5px;"><?php echo WHERE_AN_AUCTION_IS_MARKED_NIGHT_AUCTINS; ?></div>

                        </div>

                    </div>
                    <div id="auction_type5" style="display:none;" class="auctiontype_panel">
                        <div class="auctiontype-detail-body auction-image2">
                            <div style="color:#000000; font-weight:bold; text-align:center; font-size:1.3em;"><?php echo BEGINNERS_AUCTIONS; ?></div>
                            <div style="text-align:center; padding:5px;"><?php echo A_BEGINNERS_AUCTION_IS_A_SPECIAL_AUCTION; ?></div>
                        </div>
                    </div>

                    <div id="auction_type6" style="display:none;" class="auctiontype_panel">
                        <div class="auctiontype-detail-body auction-image2">
                            <div style="color:#000000; font-weight:bold; text-align:center; font-size:1.3em;"><?php echo OPEN_AUCTION; ?></div>
                            <div style="text-align:center; padding:5px;"><?php echo WHERE_AN_AUCTION_IS_MARKED_OPEN_AUCTION; ?></div>

                        </div>
                    </div>

                    <div id="auction_type7" style="display:none;" class="auctiontype_panel">
                        <div class="auctiontype-detail-body auction-image2">
                            <div style="color:#000000; font-weight:bold; text-align:center; font-size:1.3em;"><?php echo LOWEST_UNIQUE_AUCTION_W; ?></div>
                            <div style="text-align:center; padding:5px;"><?php echo LOWEST_UNIQUE_AUCTION_DESCRIPTION; ?></div>

                        </div>
                    </div>

                    <div id="auction_type8" style="display:none;" class="auctiontype_panel">
                        <div class="auctiontype-detail-body auction-image2">
                            <div style="color:#000000; font-weight:bold; text-align:center; font-size:1.3em;"><?php echo REVERSE_AUCTION_W; ?></div>
                            <div style="text-align:center; padding:5px;"><?php echo REVERSE_AUCTION_DESCRIPTION; ?></div>

                        </div>
                    </div>

                    <div id="auction_type9" style="display:none;" class="auctiontype_panel">
                        <div class="auctiontype-detail-body auction-image2">
                            <div style="color:#000000; font-weight:bold; text-align:center; font-size:1.3em;"><?php echo HALF_BACK_BID_AUCTION_W; ?></div>
                            <div style="text-align:center; padding:5px;"><?php echo HALF_BACK_BID_AUCTION_DESCRIPTION; ?></div>

                        </div>
                    </div>

                    <div id="auction_type10" style="display:none;" class="auctiontype_panel">
                        <div class="auctiontype-detail-body auction-image2">
                            <div style="color:#000000; font-weight:bold; text-align:center; font-size:1.3em;"><?php echo FREE_POINT_AUCTION_W; ?></div>
                            <div style="text-align:center; padding:5px;"><?php echo FREE_POINT_AUCTION_DESCRIPTION; ?></div>

                        </div>
                    </div>

                    <div id="auction_type11" style="display:none;" class="auctiontype_panel">
                        <div class="auctiontype-detail-body auction-image2">
                            <div style="color:#000000; font-weight:bold; text-align:center; font-size:1.3em;"><?php echo SEATS_AVAILABLE; ?></div>
                            <div style="text-align:center; padding:5px;"><?php echo SEAT_AUCTION_DESCRIPTION; ?></div>

                        </div>
                    </div>

                    <div id="auction_type12" style="display:none;" class="auctiontype_panel">
                        <div class="auctiontype-detail-body auction-image2">
                            <div style="color:#000000; font-weight:bold; text-align:center; font-size:1.3em;"><?php echo LOCK_AVAILABLE; ?></div>
                            <div style="text-align:center; padding:5px;">
                                <?php echo LOCK_AUCTION_DESCRIPTION; ?>

                            </div>

                        </div>
                    </div>