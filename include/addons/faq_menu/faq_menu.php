<?php
if(!in_array('faq_menu', $dont_show)){
?>
	<div id="navigationBox" class="box">
                        <h3><?php echo HELP_TOPICS; ?></h3>

                        <div class="box-content">
                              <ul>
                                <?php
                                $qrys = "select * from helptopic order by topic_id";
                                $ress = db_query($qrys);
                                $totals = db_num_rows($ress);
                                $counter = 1;
                                $countersub = 1;
                                while($rows = db_fetch_array($ress)) {
                                    ?>
                                <li id="help_header_<?=$counter;?>"><h5><a href="javascript: ShowMainTitle('<?=$counter;?>')"><?=stripslashes($rows["topic_title"]);?></a></h5></li>
                                <li id="subtitle_<?=$counter;?>" <?=$counter==$showanstitle?"":"style='display: none;'";?>>
                                    <ul>
                                            <?php
                                            $qr = "select * from faq where parent_topic='".$rows["topic_id"]."' order by id";
                                            $resqr = db_query($qr);
                                            $totalqr = db_num_rows($resqr);

                                            while($rowsqr = db_fetch_array($resqr)) {
                                                ?>
                                        <li id='subque_<?=$countersub?>'><a href="javascript: ShowAnsTitle('<?=$countersub;?>')"  class="linkmay_2"><?=stripslashes($rowsqr["que_title"]);?></a></li>
                                                <?
                                                $countersub++;
                                            }
                                            ?>
                                    </ul>
                                </li>
                                    <?php
                                    $counter++;
                                }
                                ?>
                            </ul>
                            
                              <?php 
				  echo get_menu('help_menu'); 
				?>
                        </div><!-- /box-content -->

                    </div><!-- /navigationBox --> 
<?php } ?>