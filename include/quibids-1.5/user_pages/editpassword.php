
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

                            <h1><?php echo CHANGE_PASSWORD; ?></h1>
                            <div style="width: 550px;">
                                <form name="newpassword" method="post" action="" onsubmit="return check()">

                                    <p>
                                        <br/>
                                        <?php if (!empty($message)) {
                                        ?>
                                        <?php echo $message; ?>
                                        <?php } ?>
                                    </p>


                                    <table width="500" cellpadding="4" cellspacing="4">
                                        <tbody>
                                            
                                            <tr>
                                                <td>
                                                    <strong><?php echo PLEASE_ENTER_YOUR_NEW_PASSWORD; ?>:</strong>
                                                </td>
                                                <td>
                                                    <input type="password" name="newpass" size="30" maxlength="50"/>
                                                </td></tr>

                                            <tr>
                                                <td><strong><?php echo PLEASE_RETYPE_YOUR_NEW_PASSWORD; ?>:</strong></td>
                                                <td>
                                                    <input type="password" name="cnfnewpass" size="30" maxlength="50"/>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td></td>
                                                <td>
                                                    <input name="sendem" value="Change Password" class="buttonr" type="submit"/>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </form>
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

