   <div id="main">
            <?php include("header.php"); ?>
            <div id="container">
                <?php include("include/topmenu.php"); ?>
                
                <div class="tab-area">
                <div id="column-right">
                    <?php include("include/searchbox.php"); ?>
                    <div id="title-category-content">
                        <?php include("include/categorymenu.php"); ?>
                        <p class="bid-title"><strong><?=$SITE_NM;?> - <?php echo VOUCHERS; ?></strong></p>
                    </div><!-- /title-category-content -->
                    <div>
                        <?php if($total>0) {

                            ?>

                        <table class="table1">
                            <thead>
                                <tr>
                                    <th><?php echo DATE;?></th>
                                    <th><?php echo VOUCHER_LABEL; ?></th>
                                    <th><?php echo AMOUNT;?></th>
                                    <th><?php echo COMBINABLE; ?></th>
                                    <th><?php echo AUCTION;?></th>
                                    <th><?php echo STATUS; ?></th>
                                    <th><?php echo VALID_TO; ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?
                                    $i=1;
                                    $a = 1;
                                    while($obj = db_fetch_array($ressel)) {
                                        $status = "";
                                        if($i%2==0) {
                                            $class = "even";
                                        }
                                        else {
                                            $class = "odd";
                                        }
                                        if($obj["used_auction"]!="") {
                                            $qryauc = "select *,p.".$lng_prefix."name as name from auction a left join products p on a.productID=p.productID where a.auctionID='".$obj["used_auction"]."'";
                                            $resauc = db_query($qryauc);
                                            $objauc = db_fetch_array($resauc);
                                        }
                                        ?>
                                <tr class="<?=$class;?>">

                                    <td align="center"><b><?=arrangedate(substr($obj["issuedate"],0,10));?></b></td>

                                    <td width="180px;">
                                                <?php if($obj["voucher_status"]==1 || $obj["voucher_status"]==2) {?>
                                        <span class="normal_text"><strike><b><?=$obj["voucher_desc"];?></b></strike></span>
                                                    <?php } else { ?>
                                        <span class="normal_text"><b><?=$obj["voucher_desc"];?></b></span>
                                                    <?php } ?>
                                    </td>

                                    <td align="center">
                                        <span class="normal_text">
                                                    <?=$obj["voucher_type"]==2?$Currency.$obj["bids_amount"]:substr($obj["bids_amount"],0,strpos($obj["bids_amount"],".",1))."&nbsp;"." Bids";?>
                                        </span>
                                    </td>

                                    <td align="center">
                                        <span class="normal_text">
                                                    <?=$obj["combinable"]==1?YES:NO; ?>
                                        </span>
                                    </td>

                                    <td align="center">
                                                <?php if($obj["used_auction"]!="") { ?>
                                        <a href="<?php echo SEOSupport::getProductUrl($obj["name"], $obj["auctionID"], 'n'); ?>" class="darkblue-12-link"><?=stripslashes($objauc["name"]);?></a>
                                                    <?php } else { ?>
                                        --
                                                    <?php } ?>
                                    </td>

                                    <td align="center">
                                        <span class="normal_text">
                                                    <?php if($obj["voucher_status"]=='1') {?>
                            	<?php echo USED; ?>
                                                        <?php } elseif($obj["voucher_status"]=='2') { ?>
                            	<?php echo EXPIRED; ?>
                                                        <?php } else { ?>
                            	<?php echo RUNNING; ?>
                                                        <?php } ?>
                                        </span>
                                    </td>

                                    <td align="center">
                                        <span class="normal_text">
                                            <b><?=$obj["expirydate"]!="0000-00-00 00:00:00"?arrangedate(substr($obj["expirydate"],0,10)):"--";?></b>
                                        </span>
                                    </td>

                                </tr>
                                        <?
                                        $i++;
                                        $a++;
                                        if($a==3) {
                                            $a=1;
                                        }
                                    }
                                    ?>
                            </tbody>
                        </table>
                            <?php } else {?>
                        <div class="clear" style="height: 20px;">&nbsp;</div>
                        <div class="darkblue-14" align="center"><?php echo NO_VOUCHERS_TO_DISPLAY; ?></div>
                        <div class="clear" style="height: 20px;">&nbsp;</div>
                            <?php  }?>

                    </div><!-- /content -->
                </div><!-- /column-right -->
                <div id="column-left">
                    <?php include("leftside.php"); ?>
                   
                </div><!-- /column-left -->
                </div>
            </div><!-- /container -->

            <?php include("footer.php"); ?> 
