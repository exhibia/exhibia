                   <div id="horizontal-auctions-box" class="auctions-box" style="display:block;">
                    <h2>last bidder wins</h2>
				<?php include('include/addons/auction_boxes/exhibia/auctions_index.php'); ?>
                   </div><!-- /auctions-box -->
                    <div class="clear"></div>
                       <?php include 'include/advertisemain.php'; ?>
				<div id="categories_escroe">
				    <h2>funding exhibits</h2><p>get bids by funding items</p>
				      <ul>
					  <?php
					 $sqlc = "select distinct cat.name, cat.categoryID from auction left join categories cat on cat.categoryID = auction.categoryID where auction.escroe=1 and auction.auc_status=2";
					if(!empty($_REQUEST['cat'])){
					    $sqlc .= " and auction.categoryID='$_REQUEST[cat]'";
					    $active = $_REQUEST['cat'];
					}else{
					    $active = 1;
					}
					$i = 1;
					  $qryc = db_query($sqlc);
					  while($rowc = db_fetch_array($qryc)){
					    $cats[$i] = $rowc['categoryID'];
					      ?><li id="cat_<?php echo $i; ?>"><a href="javascript:;" onclick="get_escrow(<?php echo $rowc['categoryID']; ?>, $(this).parent().attr('id'))"><?php echo $rowc['name']; ?></a></li><?php
					  $i++;
					  }
					  echo db_error();
					  ?>
				      </ul>
				      <script>
					$('#cat_<?php echo $active; ?>').addClass('active');
				      </script>
				</div>
		     <div id="escroe_results">
			<?php
				require($BASE_DIR . '/include/addons/auction_boxes/exhibia/auctions_index_bottom.php');
			?>
		     </div>
