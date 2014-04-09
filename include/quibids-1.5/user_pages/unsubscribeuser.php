
        <div id="pagewidth">
            <!-- ============= Header =============  -->
            <?php include $BASE_DIR . '/include/' . $template . '/header.php'; ?>
            <!-- ============= End Header =============  -->
              <div id="wrapper" class="clearfix" >
                <div id="maincol">
                    <!-- ============= MyQuibids nav =============  -->
                    <ul id="myqb-nav">
                        <li ><a href="myaccount.php" class="active"><span><?php echo 'MY ACCOUNT'; ?></span></a></li>
                    </ul>
                    <!-- ============= End MyQuibids nav =============  -->
                    <!-- ============= MyQuibids wrap =============  -->
                    <div id="myqb-wrap">
                        <div id="myqb">

                            <h1><?php echo CLOSE_ACCOUNT; ?></h1>
                            <div style="width: 550px;">


                                <p><h2><?php echo CLOSE_YOUR; ?> <?php echo $SITE_NM; ?> <?php echo ACCOUNT; ?></h2></p>

                                <br />

                                <p><strong style="color:red;font-size:larger;"><?php echo IMPORTANT; ?>:</strong> <?php echo IF_YOU_CLOSE_YOUR_ACCOUNT_YOU_WONT_BE_ABLE_TO; ?> <?php echo $SITE_NM; ?> <?php echo USING_THIS_EMAIL_ADDRESS_FOR_TWO_MONTHS; ?>
                                </p>

                                <br />

                                <table width="100%">
                                    <tbody>
                                        <tr>
                                            <td valign="middle">
                                                <input type="checkbox" name="unsubscribecheck" value="unsubscribe" class="register-box-row-checkbox" />
                                                &nbsp;&nbsp;<?php echo I_WANT_TO_CLOSE_MY; ?> <?php echo $SITE_NM; ?> <?php echo ACCOUNT; ?>
                                            </td>
                                            
                                        </tr>
                                        <tr>
                                            <td valign="middle" align="center">
                                                <input name="sendem" value="<?php echo CLOSE; ?>" class="buttonr" type="submit"/>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                            <!-- ============= /Recently Won Auctions =============  -->


                        </div>
                        <!-- ============= Left Navigation =============  -->

                        <?php include $BASE_DIR . '/include/' . $template . '/mybid_nav.php'; ?>

                        <!-- ============= End Left Navigation =============  -->
                        <div class="clear"></div>
                        <div id="myqb-end"></div>
                    </div>
                    <!-- ============= End MyQuibids wrap =============  -->
                </div>
            </div>
            <div id="wrap-end"></div>
        </div> <!--end pagewidth-->

        <?php include $BASE_DIR . '/include/' . $template . '/footer.php' ?>
   