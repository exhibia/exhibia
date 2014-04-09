							<td>
							    <ul style="float:right;padding-left:40px;width:220px;">
							    <h4><?php echo BUY_NOW;?> &nbsp;<?php echo AND_GET;?></h4>
							    <li>
							    <em id="bids_back_<?= $obj["auctionID"]; ?>" style="float:right;">0</em> <?php echo BIDS;?><?php echo BACK;?></li>
							    <li><?php echo AND_TXT; ?> <em style="float:right;" id="free_bids_<?= $obj["auctionID"]; ?>">0</em> <?php echo FREE_BIDS;?> <?php echo BACK;?></li>
							    <li>  <img class="bid-button-link" style="float:right;" src="img/buttons/btn_buitnow.png" id="buynow_<?= $obj["auctionID"]; ?>" style="cursor: pointer;border:none;" onclick="window.location.href='<?php echo $SITE_URL; ?>buyitnow.php?auctionId=<?= $obj["auctionID"]; ?>&uid=<?= $uid; ?>'" /></li>
							    </ul> 
							</td>
