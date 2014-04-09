
        <div id="pagewidth">
            <!-- ============= Header =============  -->
            <?php include $BASE_DIR . '/include/' . $template . '/header.php'; ?>
            <!-- ============= End Header =============  -->

              <div id="wrapper" class="clearfix">
                <div id="maincol">
                    <!-- ============= MyQuibids nav =============  -->
                    <ul id="myqb-nav">
                        <li ><a href="myaccount.php" class="active"><span><?php echo 'MY ACCOUNT'; ?></span></a></li>
                    </ul>
                    <!-- ============= End MyQuibids nav =============  -->
                    <!-- ============= MyQuibids wrap =============  -->
                    <div id="myqb-wrap">
                        <div id="myqb">

                            <!-- ============= Recently Won Auctions =============  -->
                            <table>
                                <tbody>
                                    <tr>
                                        <td width="70%">
                                            <h2><?php echo MY_DETAILS; ?></h2>
                                            <div class="clear"></div>
<?php
$uid = $_SESSION["userid"];
$qr = "select * from registration r left join countries c on r.country=c.countryId where id='" . $uid . "'";

$rs = db_query($qr);
$total = db_num_rows($rs);
$row = db_fetch_array($rs);
?>
                                            <p></p>
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td width="140"><strong><?php echo CUSTOMER_ID; ?>:</strong></td>
                                                        <td><?php echo $row['id'];?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong><?php echo USERNAME; ?>:</strong></td>
                                                        <td><?php echo $row['username'];?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong><?php echo GENDER; ?>:</strong></td>
                                                        <td><?php echo $row['sex'];?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong><?php echo FIRST_NAME; ?>:</strong></td>
                                                        <td><?php echo $row['firstname'];?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong><?php echo LAST_NAME; ?>:</strong></td>
                                                        <td><?php echo $row['lastname'];?></td>
                                                    </tr>

                                                    <tr>
                                                        <td><strong><?php echo BIRTH_DATE; ?>:</strong></td>
                                                        <td><?php echo arrangedate2($row['birth_date']);?></td>
                                                    </tr>

                                                    <tr>
                                                        <td><strong><?php echo EMAIL_ADDRESS; ?>:</strong></td>
                                                        <td><?php echo $row['email'];?></td>
                                                    </tr>

                                                    <tr>
                                                        <td><strong><?php echo COUNTRY; ?>:</strong></td>
                                                        <td><?php echo $row['printable_name'];?></td>
                                                    </tr>

                                                    <tr>
                                                        <td><br/></td>
                                                    </tr>


                                                </tbody>
                                            </table>

                                            <p>
                                                <i>
                                                    <?php echo TO_AVOID_ABUSES_WE_DONOT_ALLOW_YOU_TO_EDIT_YOUR_DETAILS_ONCE_REGISTEREDED; ?>
                                                </i>
                                            </p>
                                            <br/>

                                        </td>
                                        <td width="20">&nbsp;</td>

                                        <td valign="top" width="130">
                                            <div id="avatarBox">
                                                <?php
                                                $regsql = "select * from registration where id=$uid";
                                                $regresult = db_query($regsql);
                                                $reg = db_fetch_object($regresult);
                                                db_free_result($regresult);

                                                $avatardb = new Avatar(null);
                                                $avatarresult = $avatardb->selectById($reg->avatarid);

                                                $avatarfile = 'uploads/avatars/default.png';

                                                if (db_num_rows($avatarresult) > 0) {
                                                    $avatar = db_fetch_object($avatarresult);
                                                    $tempfile = 'uploads/avatars/' . $avatar->avatar;
                                                    if (file_exists($tempfile)) {
                                                        $avatarfile = $tempfile;
                                                    }
                                                } ?>

                                                <h2 class="myAvatar"><span><?php echo MY_AVATAR; ?></span></h2>
                                                <a href="myavatar.php"><img class="img" border="0" alt="" src="<?php echo $avatarfile; ?>"></img></a>

                                                <a href="myavatar.php" class="change"><?php echo CHANGE; ?></a>

                                                <h2 class="bidsAvailable"><span>Bids Available</span></h2>
                                                <span class="bids"><?php echo FINAL_BID; ?>:<strong><?php echo $reg->final_bids; ?></strong></span>
                                                <span class="bids"><?php echo FREE_BIDS; ?>:<strong><?php echo $reg->free_bids; ?></strong></span>

                                            </div>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>

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
 
