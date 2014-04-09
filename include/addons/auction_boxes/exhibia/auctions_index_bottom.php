		<?php
	
		ini_set('display_errors', 1);
		if(empty($BASE_DIR)){
		    require("../../../../config/connect.php");
		    include("$BASE_DIR/common/Security.php");
		    include("$BASE_DIR/common/seosupport.php");
		    include("$BASE_DIR/Functions/cornerImag.php");
		    include("$BASE_DIR/Functions/chkInput.php");
		    include("$BASE_DIR/Functions/msort.php");
		    
		}
		    $total_per_ini = 10;
		    $max_pages = 100;
		    $items_per_page = 10;

		    $id = ( $id == 0 && $aid > 0 ) ? $aid : $id;

		    if (!empty($_REQUEST['PageNo'])) {
			//$PageNo = chkInput($_REQUEST['PageNo'], 'i');
			$PageNo = $_REQUEST['PageNo'];
		    } else {
			$PageNo = 0;
		    }
		    
		    $from = $PageNo * 10;
		    $to = $from + $items_per_page;
		    if($from < 0){
			$from = 0;
		    }
                    $totalauc2 = 0;
                   

                           // if ($co != "") {
                        $qryauc2 = "select adt.auc_due_price,adt.auc_due_time,a.auctionID,a.productID as productID,a.categoryID as categoryID,auc_start_price,auc_final_price,auc_start_date,auc_end_date,auc_start_time,auc_end_time,auc_status,auc_type,auc_recurr,buy_user, auc_fixed_price,fixedpriceauction,pennyauction,nailbiterauction,offauction,nightauction,openauction,time_duration,auc_final_end_date,total_time,pause_status,shipping_id,future_tstamp,recurr_count,auction_min_price,min_win_price,use_free,allowbuynow,buynowprice,beginner_auction,reverseauction,uniqueauction,lockauction,halfbackauction,seatauction,cashauction,reserve,minseats,maxseats,seatbids,bidpack,a.tax1,a.tax2,bidpack_name,bidpack_banner,bidpack_price,price,p.name,p.picture1,a.escroe_bids,a.escroe, (select count(id) from unique_bid u where u.auctionid=a.auctionID) as ubidcount,(select count(id) from auction_seat st where st.auction_id=a.auctionID) as seatcount from auction a left join products p on a.productID=p.productID and a.bidpack=0 left join bidpack b on b.id=a.productID and a.bidpack=1 left join auc_due_table adt on a.auctionID=adt.auction_id where a.escroe=1 ";
                        if(!empty($_REQUEST['cat'])){
			  $qryauc2 .= " and a.categoryID='$_REQUEST[cat]' ";
			}
                        $totalauc2 = db_num_rows(db_query($qryauc2));
                        //echo $qryauc2;
                       

                                $resauc2 = db_query($qryauc2);

                                
				
				
				
			$total_pages = ceil($totalauc2 / 10);
			
                        $co = "";
                        $exhibits = array();
                        
                        if ($totalauc2 > 0) {
                     
				echo '<div class="clear';
                                echo ' mid_bar';
			        echo '" style="height:30px;display:block;">';
			        echo '<img src="img/previous.png" class="previous" id="previous" onclick="retrieve_auctions(';  	  
			        
			           
				    $Prev = $PageNo - 1;
				    if($Prev < 1){
				      $Prev = 0;
				    }
				   
				    
			        echo $Prev;
			        
			        if(!empty($_REQUEST['cat'])){
				    echo ", '" . $_REQUEST['cat'] . "'";
				}
				echo ');" />';
			        
			        echo '<img src="img/next.png" class="next" id="next"  onclick="retrieve_auctions(';
				
				$Next = $PageNo + 1;
				      if($Next > $total_pages){
					$Next = 1;
				      }
				echo $Next;
			        if(!empty($_REQUEST['cat'])){
				    echo ", '" . $_REQUEST['cat'] . "'";
				}
				echo ');" />';
				
				echo '</div>'; 
                            $rowindex = 0;
                            $is_first = TRUE;
                            $i = 0;
                            //echo $qryauc2 . " limit $from, $to";
                          $qryauc2 .= " order by a.escroe_bids desc ";
		          $resauc3 = db_query($qryauc2 . " limit $from, $to");
		          if(db_num_rows($resauc3) ==0){
			      $resauc3 = db_query($qryauc2 . " limit 0, 10");
		          }
                            while (( $objauc = db_fetch_array($resauc3))) {
                     
				$exhibits[$i] = $objauc;
				
					      $escrow_data = db_fetch_array(db_query("select sum(bids_pledged) as bids, count(user_id) as backers from auction_escrow where auction_id = '$objauc[auctionID]' and completed = '1'"));
					 
						  $backers = $escrow_data['backers'];
						 
						  $bids_needed = number_format($objauc['escroe_bids'],0) - number_format($escrow_data['bids'], 0);
						
						  $percent_funded = (number_format($escrow_data['bids'], 0)/number_format($objauc['escroe_bids'],0))*100;
						 
						  $exhibits[$i]['percent_funded'] = number_format(floor($percent_funded), 0);
						 
						
				$i++;
                            }
                            echo db_error();
		      $exhibits = msort($exhibits, 'percent_funded', SORT_DESC);
		      
			    $m = count($exhibits) - 1;
                            while ($m >= 0) {
                        
				$objauc = $exhibits[$m];
				
                                $co .= ( $is_first ? $objauc["auctionID"] : "," . $objauc["auctionID"]);
                                $is_first = FALSE;
                                $cornerImag = cornerImag($objauc);
                                $seatauction = $objauc['seatauction'];
                                if ($seatauction == true && $objauc['seatcount'] >= $objauc['minseats']) {
                                    $seatauction = false;
                                }
                                $pname = $objauc['bidpack'] ? $objauc['bidpack_name'] : $objauc['name'];
                                $picture = $objauc['bidpack'] ? $objauc['bidpack_banner'] : $objauc['picture1'];
                                $price = $objauc['bidpack'] ? $objauc['bidpack_price'] : $objauc['price'];
                        ?>
                           <div class="auction-item <?php echo (++$rowindex) % 4 == 0 ? 'last' : ''; ?>" title="<?php echo $objauc["auctionID"]; ?>" id="auction_<?php echo $objauc["auctionID"]; ?>" onclick="<?php echo $objauc["auc_due_price"]; ?>">
                              <h2 class="productname">
                                <?php if ($objauc['uniqueauction'] == false) {
                             
                                ?>
                                    <a href="<?php echo SEOSupport::getProductUrl($pname, $objauc["auctionID"], 'n'); ?>"><?php echo stripslashes($pname); ?></a>
                                <?php } else {
                           
                                ?>
                                    <a href="<?php echo SEOSupport::getProductUrl($pname, $objauc["auctionID"], 'l'); ?>"><?php echo stripslashes($pname); ?></a>
                                <?php } ?>
                            </h2>

                            <?php if ($objauc['uniqueauction'] == false) {
                            ?>
                                   <a href="<?php echo SEOSupport::getProductUrl($pname, $objauc["auctionID"], 'n'); ?>">
                                        <img src="<?php echo $UploadImagePath; ?>products/thumbs_big/thumbbig_<?php echo $picture; ?>" alt="" class="bidimagebox" border="0" />
                                    </a>
                            <?php } else {
                            ?>
                                    <a href="<?php echo SEOSupport::getProductUrl($pname, $objauc["auctionID"], 'l'); ?>">
                                        <img src="<?php echo $UploadImagePath; ?>products/thumbs_big/thumbbig_<?php echo $picture; ?>" alt="" class="bidimagebox" border="0" />
                                    </a>
                           <?php } ?>
                         <div class="clear"></div>
                           <div class="escroe_data">
			      <span class="pin_icon blue_star" id="watch_<?php echo $objauc["auctionID"]; ?>">
				<img  src="img/blue_star.png" />
			      </span>
			      <span id="funders_<?php echo $objauc["auctionID"]; ?>" class="funders">
				  <span id="funders_count_<?php echo $objauc["auctionID"]; ?>">0</span> backers
			      </span>
			      <span id="funders_percent_<?php echo $objauc["auctionID"]; ?>" class="funders_percent">0%</span>
			      <span id="funders_bar_<?php echo $objauc["auctionID"]; ?>" class="funders_bar"><span></span></span>
                          </div>
                            <?php if ($_SESSION['userid'] == 0) {
                            ?>
                                        <a id="image_main_<?php echo $objauc["auctionID"]; ?>" class="button_fund full-width" onclick="window.location.href='login.php'" onmouseout="$(this).text('<?php echo $seatauction == true ? BUY_A_SEAT : 'FUND'; ?>')" onmouseover="$(this).text('<?php echo LOGIN; ?>')"><?php echo $seatauction == true ? BUY_A_SEAT : 'FUND'; ?></a>
                            <?php } else {
                                     if ($seatauction == true) {
                            ?>
                                            <div id="seat_button_<?php echo $objauc["auctionID"]; ?>">
                                                <a id="image_main_<?php echo $objauc["auctionID"]; ?>" class="button_fund butseat-button-link" name="getseat.php?prid=<?php echo $objauc["productID"]; ?>&aid=<?php echo $objauc["auctionID"]; ?>&uid=<?php echo $_SESSION['userid']; ?>"><?php echo BUY_A_SEAT; ?></a>
                                            </div>
                            <?php } ?>

                                        <div id="normal_button_<?php echo $objauc["auctionID"]; ?>" style="display:<?php echo $seatauction == true ? 'none' : 'block'; ?>">
                                <?php if ($objauc['uniqueauction'] == true) {
                                ?>
                                            <a id="image_main_<?php echo $objauc["auctionID"]; ?>" class="button_fund ubid-button-link" rel="<?php echo $objauc["auctionID"]; ?>" name="getuniquebid.php?prid=<?php echo $objauc["productID"]; ?>&aid=<?php echo $objauc["auctionID"]; ?>&uid=<?php echo $_SESSION['userid']; ?>"><?php echo 'FUND'; ?></a>

                                <?php } else {
                                ?>
                                            <a id="image_main_<?php echo $objauc["auctionID"]; ?>" href="javascript:;" onclick="add_funds('add_funds.php?uid=<?php echo $_SESSION['userid'];?>&aid=<?php echo $objauc["auctionID"]; ?>');" class="button_fund bid-button-link" ><?php echo 'FUND'; ?></a>
                                <?php } ?>
                                        </div>
                            <?php } ?>
                                </div><!-- /auction-item -->
                        <?php 
				$m--;
                              }
                            } else {
                        ?>
                                <div style="height: 45px; clear: both;">&nbsp;</div>

                                <div align="center" class="darkblue-14"><?php echo NO_LIVE_AUCTIONS_TO_DISPLAY; ?></div>

                                <div style="height: 15px;clear: both;">&nbsp;</div>
                        <?php
                            }
                            db_free_result($resauc);
                        ?>
                            <div class="clear"></div> 
		       