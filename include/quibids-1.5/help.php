
        <a name="top"></a>
        <div id="pagewidth">
            <!-- ============= Header =============  -->
            <?php include("$BASE_DIR/include/$template/header.php"); ?>
            <!-- ============= End Header =============  -->
            <div id="wrapper" class="clearfix">
                <div id="maincol">
                    <div id="auction-listing">
                        <div id="live-auctions">
                            <h2 id="faq-head"><?php echo HELP_TOPICS; ?></h2>
                            <div id="faq-wrap">
                                <div id="faqs">
                                    <div id="faq-top"></div>
                                    <!-- ============= FAQs =============  -->
                                    <div id="questions">

                                        <table width="100%">
                                            <tbody>
                                                <tr>                                                   
                                                    <td valign="top">
                                                        <h2><img alt="" id="headerImage" src="css/quibids-1.5/8.png"/><?php echo HELP_TOPICS; ?></h2>
                                                    </td>

                                                </tr>
                                            </tbody>
                                        </table>

                                        <div id="h2bg"></div>

                                        <?php
                                        $qr2 = "select *," . $lng_prefix . "que_content as que_content," . $lng_prefix . "que_title as que_title from faq order by parent_topic,id";
                                        $resqr2 = db_query($qr2);
                                        $totalqr = db_num_rows($resqr2);
                                        $counterans = 1;
                                        while ($v = db_fetch_array($resqr2)) {
                                            if ($counterans == $shoansanswer) {
                                        ?>

                                                <div id="answer_<?php echo $counterans; ?>">
                                                    <a name="15"></a>
                                                    <h3>
                                                <?php echo stripslashes($v["que_title"]); ?>
                                            </h3>
                                            <div class="response">
                                                <p>
                                                    <?php echo stripslashes($v["que_content"]); ?>
                                                    <br/><br/>
                                                </p>
                                                <a href="#top">Back To Top</a>
                                            </div>
                                        </div>
                                        <?php } else {
                                        ?>

                                                    <div id="answer_<?php echo $counterans; ?>" style="display:none">
                                                        <a name="15"></a><h3><?php echo stripslashes($v["que_title"]); ?></h3>
                                                        <div class="response">
                                                            <p>
                                                                                                <?=stripslashes($v["que_content"]); ?> <br/><br/>
                                                </p>
                                                <a href="#top">Back To Top</a>
                                            </div>
                                        </div>

                                        <?php } $counterans++;
                                            } ?>

                                        </div>
                                        <!-- ============= End FAQs =============  -->
                                        <div id="faqs-end"></div>
                                    </div>
                                </div>

                                <!-- ============= Left Navigation =============  -->
                            <?php
                                            $qrys = "select * from helptopic order by topic_id";
                                            $ress = db_query($qrys);
                                            $totals = db_num_rows($ress);
                                            $counter = 1;
                                            $countersub = 1;
                                            while ($totals > 0 && $rows = db_fetch_array($ress)) {
                            ?>
                                                <div id="left-nav">
                                                    <h2><?php echo stripslashes($rows["topic_title"]); ?></h2>
                                                    <ul>
                                    <?php
                                                $qr = "select * from faq where parent_topic='" . $rows["topic_id"] . "' order by id";
                                                $resqr = db_query($qr);
                                                $totalqr = db_num_rows($resqr);

                                                while ($totalqr > 0 && $rowsqr = db_fetch_array($resqr)) {
                                    ?>
                                                    <li id="subque_<?php echo $countersub ?>">
                                                        <a href="javascript: ShowAnsTitle('<?php echo $countersub; ?>')"  class="linkmay_2"><?php echo stripslashes($rowsqr["que_title"]); ?></a>
                                                    </li>

                                    <?php
                                                    $countersub++;
                                                }
                                    ?>
                                            </ul>
                                        </div>

                                        <br/><br/>&nbsp;<br/><br/>
                            <?php
                                                $counter++;
                                            }
                            ?>


                                            <!-- ============= End Left Navigation =============  -->

                                            <div class="clear"></div>
                                            <div id="faqs-end-bg"> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="wrap-end"></div>

                        </div>

        <?php include("$BASE_DIR/include/$template/footer.php") ?>
        <label id="GetGlobalID" style="display: none;"></label>
        <label id="GetGlobalAnsID" style="display: none;"><?php echo $shoansanswer; ?></label>
    

