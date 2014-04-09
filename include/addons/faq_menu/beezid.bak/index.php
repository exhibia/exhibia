 
 <div><img src="img/pages/common/img_left_header.gif" alt="Beezid Help"/></div>
                        <div style="width: 259px; background-color: rgb(255, 255, 255);">
                            <!-- menu part 1 -->
                            <div class="mC">
                                <?php
                                $qrys = "select * from helptopic order by topic_id";
                                $ress = db_query($qrys);
                                $totals = db_num_rows($ress);
                                $counter = 1;
                                $countersub = 1;
                                while ($rows = db_fetch_array($ress)) {
                                ?>
                                    <div id="help_header_<?= $counter; ?>" class="mH" onclick="javascript: ShowMainTitle('<?= $counter; ?>');"><?php echo stripslashes($rows["topic_title"]); ?></div>
                                    <div id="subtitle_<?= $counter; ?>" <?= $counter == $showanstitle ? "" : "style='display: none;'"; ?> class="mL">
                                    <?php
                                    $qr = "select * from faq where parent_topic='" . $rows["topic_id"] . "' order by id";
                                    $resqr = db_query($qr);
                                    $totalqr = db_num_rows($resqr);

                                    while ($rowsqr = db_fetch_array($resqr)) {
                                    ?>
                                        <a id='subque_<?= $countersub ?>' href="javascript: ShowAnsTitle('<?= $countersub; ?>')" class="mO"><?= stripslashes($rowsqr["que_title"]); ?></a>
                                    <?php
                                        $countersub++;
                                    }
                                    ?>
                                </div>
                                <?php
                                    $counter++;
                                }
                                ?>


                            </div>
                        </div>