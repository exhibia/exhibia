<style>
#column-right > div {
border: 2px solid #D6EBEE;
border-radius: 10px;
margin-left: -20px;
width: 780px !important;
margin-top: 5px;
}
</style>
        <div id="main">

            	<?php if(empty($header)){ include_once($BASE_DIR . '/include/' . $template . '/header.php'); } ?>

            <div id="container">

                <?php if(empty($nav_menu)) { include_once($BASE_DIR . "/include/topmenu.php"); } ?>
	 <div class="tab-area">
                <div id="column-right">

                    <?php include_once($BASE_DIR . "/include/searchbox.php"); ?>

                    <div id="title-category-content">

                        <?php include_once($BASE_DIR . "/include/categorymenu.php"); ?>
                        <p class="bid-title"><strong><?=$SITE_NM; ?> - <?php echo $status == 1 ? MY_BUYNOW_LIST : MY_BUYNOW_HISTORY; ?></strong></p>
                    </div><!-- /title-category-content -->
                    <div>
                        <?php if ($total > 0) {
                        ?>

                            <table class="table1">
                                <thead>
                                    <tr valign="center">
                                        <th><?php echo PRODUCT; ?></th>
                                        <th style="text-align:center;"><?php echo PRICE; ?></th>
                                        <th style="text-align:center;"><?php echo BUY_DATE; ?></th>
                                        <th style="text-align:center;"><?php echo STATUS; ?></th>
                                        <th style="text-align:center;"><?php echo SHIPPING; ?></th>
                                        <?php if($status!=2){ ?>
                                        <th style="text-align:center;"></th>
                                        <?php }?>
                                    </tr>
                                </thead>
                                <tbody>
                                <?
                                $i = 1;

                                while ($obj = db_fetch_object($ressel)) {
                                    if ($i % 2 == 0) {
                                        $class = "even";
                                    } else {
                                        $class = "odd";
                                    }
                                    $buydate = $obj->buydate;
                                ?>
                                    <tr valign="center" class="<?=$class;
                                ?>">
                                    <td class="normal_text vcenter"><?php echo stripslashes($obj->name); ?></td>
                                    <td class="normal_text vcenter hcenter">
                                        <?php echo $obj->price; ?>
                                    </td>
                                    <td class="normal_text vcenter hcenter">
                                        <?php echo arrangedate(substr($buydate, 0, 10)) . "<br/>" . substr($buydate, 11); ?>
                                    </td>


                                    <td class="normal_text vcenter hcenter">
                                        <?php if ($obj->status == 1) {
                                        ?>
                                            <span class="redfont"><?php echo PAYMENT_COMPLETE; ?></span>
                                        <?php } ?>

                                        
                                    </td>

                                    <td class="normal_text vcenter hcenter">
                                      <!--  <?php if ($obj->ssid != '') {
                                        ?>
                                           
                                            <a href="<?php echo $obj->sturl; ?>"><img alt="" src="uploads/other/<?php echo $obj->stlogoimage; ?>" border="0"/></a><br/>
                                        <?php echo TRACK_NUMBER; ?>:<br/>
                                        <?php echo $obj->tracknumber; ?>
                                        <?php } ?>-->
							    <?php 
                                                            if($obj->tracknumber == ''){ $obj->tracknumber = 'Not Shipped'; $obj->stlogoimage = 'blank.png'; $obj->sturl = 'help.php'; } 
                                                            
                                                            ?>

                                                                <a href="<?php echo $obj->sturl; ?>"><img alt="" width="120" height="40" src="uploads/other/<?php echo $obj->stlogoimage; ?>" border="0"/></a><br/>
                                                            <?php echo TRACK_NUMBER; ?>:<br/>
                                                            <?php echo $obj->tracknumber; ?>
                                    </td>

                                    <?php if($status!=2){ ?>
                                    <td class="normal_text vcenter hcenter">
                                        <?php if ($obj->ssid != '' && $obj->status==1) {
                                        ?>
                                            <a href="" onclick="return sentconfirm('mybuynow.php?sent=<?php echo $obj->id; ?>&status=<?php echo $status; ?>&pgno=<?php echo $PageNo; ?>')">
                                            <?php echo ARCHIVE; ?>
                                        </a>
                                        <?php } ?>
                                    </td>
                                    <?php }?>

                                </tr>
                                <?php
                                        $i++;
                                    }
                                    db_free_result($ressel);
                                ?>
                                </tbody>
                            </table>
                            <div class="clear">&nbsp;</div>
                        <?php if ($totalpage > 1) {
                        ?>
                                        <div class="pagenumber" align="right">
                                            <ul>
                                <?php
                                        if ($PageNo > 1) {
                                            $PrevPageNo = $PageNo - 1;
                                ?>
                                            <li><a href="mybuynow.php?pgno=<?=$PrevPageNo;
                                ?>&status=<?php echo $status; ?>">&lt; <?php echo PREVIOUS_PAGE; ?></a></li>
                                    <?
                                   }
                                    ?>

                                <?
                                   if ($PageNo < $totalpage) {
                                       $NextPageNo = $PageNo + 1;
                                ?>
                                       <li><a id="next" href="mybuynow.php?pgno=<?=$NextPageNo;
                                ?>&status=<?php echo $status; ?>"><?php echo NEXT_PAGE; ?> &gt;</a></li>
                                    <?
                                   }
                                    ?>
                            </ul>
                        </div>
                        <?php } ?><!--page number-->
                        <?php } else {
 ?>
                               <div class="clear" style="height: 20px;">&nbsp;</div>
                               <div class="darkblue-14" align="center"><?php echo NO_BUYNOW_TO_DISPLAY; ?></div>
                               <div class="clear" style="height: 20px;">&nbsp;</div>
<?php } ?>

                       </div><!-- /content -->
                   </div><!-- /column-right -->
                   <div id="column-left">
                    <?php include("leftside.php"); ?>
<?php include("include/bidpackage.php"); ?>
                           <img src="img/icons/credit-cards.gif" alt="" />
                       </div><!-- /column-left -->
                       </div>
                   </div><!-- /container -->

<?php include("include/footer.php"); ?>