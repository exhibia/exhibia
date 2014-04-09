        <div id="main">
            <?php  include("header.php"); ?>
            <div id="container">
                <?php  include("include/topmenu.php"); ?>
                <div class="tab-area">
                <div id="column-right">
                    <?php  include("include/searchbox.php"); ?>
                    <div id="title-category-content">
                        <?php  include("include/categorymenu.php"); ?>
                        <p class="bid-title"><strong><?=$SITE_NM;?> - <?php echo MY_COUPON_HISTORY; ?></strong></p>
                    </div><!-- /title-category-content -->
                    <div>
                        <?php  if($total>0) {

                            ?>

                        <table class="table1">
                            <thead>
                                <tr valign="center">
                                    <th><?php echo TITLE; ?></th>
                                    <th style="text-align:center;"><?php echo DISCOUNT;?></th>
                                    <th style="text-align:center;"><?php echo FREE_BIDS; ?></th>
                                    <th style="text-align:center;"><?php echo USE_DATE;?></th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php
                                    $i=1;
                                    $a = 1;
                                    while($obj = db_fetch_object($ressel)) {
                                        if($i%2==0) {
                                            $class = "even";
                                        }
                                        else {
                                            $class = "odd";
                                        }
                                        ?>
                                <tr class="<?=$class;?>">
                                    <td class="vcenter"><?php echo stripslashes($obj->title); ?></td>
                                    <td class="normal_text vcenter hcenter">
                                                <?php echo $obj->discount; ?>
                                    </td>
                                    <td class="normal_text vcenter hcenter"><?php echo $obj->freebids; ?></td>
                                    <td class="normal_text vcenter hcenter"><?php echo arrangedate($obj->usedate); ?></td>
                                </tr>
                                        <?php
                                        $i++;
                                        $a++;
                                        if($a==3) {
                                            $a=1;
                                        }
                                    }
                                    db_free_result($ressel);
                                    ?>
                            </tbody>
                        </table>
                        <div class="clear">&nbsp;</div>
                            <?php  if($totalpage>1) { ?>
                        <div class="pagenumber" align="right">
                            <ul>
                                        <?php
                                        if($PageNo>1) {
                                            $PrevPageNo = $PageNo-1;

                                            ?>
                                <li><a href="mycoupon.php?pgno=<?=$PrevPageNo; ?>">&lt; <?php echo PREVIOUS_PAGE; ?></a></li>
                                            <?php
                                        }
                                        ?>

                                        <?php
                                        if($PageNo<$totalpage) {
                                            $NextPageNo = 	$PageNo + 1;
                                            ?>
                                <li><a id="next" href="mycoupon.php?pgno=<?=$NextPageNo;?>"><?php echo NEXT_PAGE; ?> &gt;</a></li>
                                            <?php
                                        }
                                        ?>
                            </ul>
                        </div>
                                <?php  } ?><!--page number-->
                            <?php  } else {?>
                        <div class="clear" style="height: 20px;">&nbsp;</div>
                        <div class="darkblue-14" align="center"><?php echo NO_COUPON_TO_DISPLAY; ?></div>
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
        </div> <!--end main--> 
